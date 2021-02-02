<?php

namespace nextbytetz\websitecms\Http\Controllers\System;

use App\DataTables\WorkflowTrackDataTable;
use App\Exceptions\GeneralException;
use App\Exceptions\WorkflowException;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\UpdateWorkflowRequest;
use App\Models\Auth\User;
use App\Models\System\Sysdef;
use App\Models\Workflow\WfGroupCategory;
use App\Models\Workflow\WfModule;
use App\Models\Workflow\WfModuleGroup;
use App\Models\Workflow\WfTrack;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Repositories\Workflow\WfModuleGroupRepository;
use App\Repositories\Workflow\WfDefinitionRepository;
use App\Repositories\Access\UserRepository;
use App\Models\Workflow\WfDefinition;
use App\Repositories\Workflow\WfModuleRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Workflow;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;


class workflowController extends Controller
{

    /**
     * @var
     */
    protected $moduleGroup;

    /**
     * @var WfDefinition
     */
    protected $definitions;

    /**
     * @var wf tracks
     */
    protected $wf_tracks;

    /**
     * @var
     */
    protected $users;

    /**
     * workflowController constructor.
     * @param WfModuleGroupRepository $moduleGroup
     * @param WfDefinitionRepository $definitions
     * @param UserRepository $users
     */
    public function __construct(WfModuleGroupRepository $moduleGroup, WfDefinitionRepository $definitions, UserRepository $users)
    {
        /* $this->middleware('access.routeNeedsPermission:assign_workflows'); */
        $this->moduleGroup = $moduleGroup;
        $this->definitions = $definitions;
        $this->users = $users;
        $this->wf_tracks = new WfTrackRepository();
    }


    /*Workflow settings menu*/
    public function index()
    {
        return view('admin/system/workflow/index/index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function defaults()
    {
        return view('backend.system.workflow.defaults')
            ->withGroups($this->moduleGroup->getAll())
            ->withUsers($this->users->getAll());
    }

    /**
     * @param WfDefinition $definition (Workflow definition id)
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers(WfDefinition $definition)
    {
        return response()
            ->json($definition->users->pluck("id")->all());
    }

    public function updateDefinitionUsers(WfDefinition $definition)
    {
        $this->definitions->updateDefinitionUsers($definition, ['users' => request()->input('users')]);
        return response()
            ->json(['success' => true]);
    }

    /**
     * @param $resource_id
     * @param $wf_module_group_id
     * @param $type
     * @return $this
     * @throws \App\Exceptions\GeneralException
     */
    public function getCompletedWfTracks($resource_id, $wf_module_group_id, $type)
    {
        $wf_tracks = $this->wf_tracks->getCompletedWfTracks($resource_id, $wf_module_group_id, $type);
        $module = (new WfModuleRepository())->getModuleInstance(['wf_module_group_id' => $wf_module_group_id, 'type' => $type]);
        return view("backend.includes.workflow.completed_tracks")
            ->with("wf_tracks", $wf_tracks)
            ->with("module", $module);
    }

    /**
     * @param $resource_id
     * @param $wf_module_group_id
     * @param $type
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Exception
     */
    public function getWfTracksForDatatable($resource_id, $wf_module_group_id, $type)
    {
        $data = $this->wf_tracks->getPendingWfTracksForDatatable($resource_id, $wf_module_group_id, $type);
//        return Datatables::of($this->wf_tracks->getPendingWfTracksForDatatable($resource_id, $wf_module_group_id, $type))
        return Datatables::of($data)
            ->editColumn('user_id', function($wf_track) {
                return $wf_track->username_formatted;
            })
            ->editColumn('receive_date', function ($wf_track) {
                return $wf_track->receive_date_formatted;
            })
            ->editColumn('forward_date', function ($wf_track) {
                return $wf_track->forward_date_formatted;
            })
            ->editColumn('status', function ($wf_track) {
                return $wf_track->status_narration;
            })
            ->editColumn('wf_definition_id', function ($wf_track) {
                return $wf_track->wfDefinition->level;
            })
            ->addColumn('action', function ($wf_track) {
                return $wf_track->status_narration;
            })
            ->addColumn('description', function ($wf_track) {
                return $wf_track->wfDefinition->description;
            })
            ->addColumn("aging", function ($wf_track) {
                return $wf_track->getAgingDays();
            })
            /*->addColumn("option", function ($wf_track) {
                return $wf_track->action_button;
            })*/
            ->rawColumns(['user_id'])
            ->make(true);
    }

    public static function getWfTracks($resource_id, WorkflowTrackDataTable $dataTable)
    {
        $dataTable->with('resource_id', $resource_id)->render('backend.includes.workflow_track');
    }

    /**
     * @param $resource_id
     * @param $wf_module_group_id
     * @return mixed
     * @throws \Exception
     */
    public function getDeactivatedWfTracksForDataTable($resource_id, $wf_module_group_id) {

        return Datatables::of($this->wf_tracks->getDeactivatedWfTracksForDataTable($resource_id, $wf_module_group_id))
            ->editColumn('user_id', function($wf_track) {
                return $wf_track->username_formatted;
            })
            ->editColumn('receive_date', function ($wf_track) {
                return $wf_track->receive_date_formatted;
            })
            ->editColumn('forward_date', function ($wf_track) {
                return !is_null($wf_track->forward_date) ? $wf_track->forward_date_formatted : ' ';
            })
            ->editColumn('status', function ($wf_track) {
                return $wf_track->status_narration;
            })
            ->editColumn('wf_definition_id', function ($wf_track) {
                return $wf_track->wfDefinition->level;
            })
            ->addColumn('action', function ($wf_track) {
                return $wf_track->status_narration;
            })
            ->addColumn('description', function ($wf_track) {
                return $wf_track->wfDefinition->description;
            })
            ->addColumn("aging", function ($wf_track) {
                return $wf_track->getAgingDays();
            })
            ->rawColumns(['user_id'])
            ->make(true);
    }



    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function getWorkflowModalContent()
    {
        $wf_track_id = request()->input("wf_track_id");
        $wf_track = $this->wf_tracks->find($wf_track_id);
        $resource_id = $wf_track->resource_id;
        $workflow = new Workflow(['wf_module_id' => $wf_track->wfDefinition->wfModule->id, 'resource_id' => $resource_id]);
        $wf_module = $wf_track->wfDefinition->wfModule;
        $wf_module_group_id = $wf_module->wf_module_group_id;
        $type = $wf_module->type;
        $assignStatus = $this->wf_tracks->assignStatus($wf_track_id);
        $wf_definition = $wf_track->wfDefinition;

        /*Action description*/
        $approved = $wf_track->wfDefinition->action_description;
        $statuses['0'] = '';
        if ($wf_definition->is_approval) {
            $statuses['1'] = $approved;
        } else {
            $statuses['1'] = $approved;
        }
        if ($workflow->currentLevel() <> 1) {
            $prevWfDefinition = $workflow->nextWfDefinition(-1, true);
            if ($prevWfDefinition->allow_rejection) {
                $statuses['2'] = "Reverse to level";
            }
        }
        /*end action*/

         return view("admin/system/workflow/modal/approval_model")
            ->with("assign_status", $assignStatus)
            ->with("wf_track", $wf_track)
            ->with("has_participated", $workflow->hasParticipated())
            ->with("user_has_access", $workflow->userHasAccess(access()->id(), $workflow->currentLevel()))
            ->with("previous_levels", $workflow->previousLevels())
            ->with("statuses", $statuses)
            ->with('has_to_assign', $workflow->hasToAssign());

    }



    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * Get workflow tracks contents
     */
    public function getWorkflowTrackContent()
    {
        $wf_track_id = request()->input("wf_track_id");
        $wf_track = $this->wf_tracks->find($wf_track_id);
        $resource = $wf_track->resource;
        $wf_done = isset($resource->wf_done) ? $resource->wf_done : 0;
        $resource_id = $wf_track->resource_id;
        $workflow = new Workflow(['wf_module_id' => $wf_track->wfDefinition->wfModule->id, 'resource_id' => $resource_id]);
        $wf_module = $wf_track->wfDefinition->wfModule;
        $wf_module_group_id = $wf_module->wf_module_group_id;
        $wf_definition = $wf_track->wfDefinition;
        $type = $wf_module->type;
//               $assignStatus = $this->wf_tracks->assignStatus($wf_track_id);
        $has_to_assign = $wf_definition->assign_next_user;
        /*Next users to assign*/
        $next_users = ($wf_definition->assign_next_user == 1) ? $this->wf_tracks->getNextUsersToAssignWf($wf_track) : [];
        /*end next users*/

        /*wf tracks*/
        $completed_tracks = $this->wf_tracks->getCompletedWfTracks($resource_id, $wf_module_group_id, $type)->get();
        $pending_tracks = $this->wf_tracks->getPendingWfTracksForDatatable($resource_id, $wf_module_group_id, $type);
        /*end tracks*/
        /*Action description*/
        $approved = $wf_track->wfDefinition->action_description;
        $statuses['0'] = '';
        if ($wf_definition->is_approval) {
            $statuses['1'] = $approved;
        } else {
            $statuses['1'] = $approved;
        }

//        $this->wf_tracks->updateDropDown($wf_track);;
        if ($workflow->currentLevel() <> 1) {
            $prevWfDefinition = $workflow->nextWfDefinition(-1, true);
            if ($prevWfDefinition->allow_rejection) {
                $statuses['2'] = "Reverse to level";
            }
        }

        /*end action*/
        return view("includes.workflow.workflow_contents")
//            ->with("assign_status", $assignStatus)
            ->with("wf_track", $wf_track)
            ->with("has_participated", $workflow->hasParticipated())
            ->with("user_has_access", $workflow->userHasAccess(access()->id(), $workflow->currentLevel()))
            ->with("previous_levels", $workflow->previousLevels())
            ->with("statuses", $statuses)
            ->with('has_to_assign', $has_to_assign)
            ->with('completed_tracks', $completed_tracks)
            ->with('pending_tracks', $pending_tracks)
            ->with('wf_done',$wf_done)
            ->with('next_users', $next_users);
    }


    /**
     * @param WfTrack $wf_track
     * @param UpdateWorkflowRequest $request
     * @return mixed
     * @throws GeneralException
     * @throws WorkflowException
     */
    public function updateWorkflow(WfTrack $wf_track, UpdateWorkflowRequest $request)
    {
        /*check if status = 1*/
//        $this->wf_tracks->checkIfWfStatusIsOne($wf_track);
        /*check if user has access right*/
        if ($wf_track->status) {
            throw new WorkflowException("This workflow has already been forwarded! Please reload the workflow table.");
        }
        $this->checkIfUserHasAccessOnUpdateWf($wf_track);
        $action = $request->input("action");
        $option_array = [];

        switch ($action) {
            case 'assign':
                $input = ['user_id' => access()->id(), 'assigned' => 1];
                $success = true;
                $message = trans('alert.system.workflow.assigned');
                break;
            case 'approve_reject':
                /*Status*/
                $status = $request->input("status");

                switch ($status) {
                    case 4:
                        $status = 1;
                        $option_array['release'] = 1;
                        break;
                    default:
                        $status = $status;
                        break;
                }

                /*end status*/

                $input = ['user_id' => access()->id(), 'next_user_id'=>request()->input("user"), 'status' => $status, 'comments' => $request->input("comments"), 'forward_date' => Carbon::now(),];
                if ($status == '2') {
                    $input['level'] = (string) $request->input("level");
                }

                $success = true;
                $message = trans('alert.system.workflow.updated');
                break;
        }

        $input = array_merge($input, $option_array );
        //Heavy Duty Call
        $this->wf_tracks->updateWorkflow($wf_track, $input, $action);
        return redirect()->back()->withFlashSuccess(__('label.administrator.system.workflow.app_next'));
    }





    public function pending()
    {
        $wf_module_groups = new WfModuleGroupRepository();
        $wf_modules = new WfModuleRepository();
        return view("admin/system/workflow/pending")
            ->with("wf_modules", $wf_modules->getAllActive()->pluck('name', 'id')->all())
            ->with("group_counts", $wf_modules->getActiveUser())
            ->with("state", "all")
            ->with("statuses", ['2' => 'All', '1' => 'Assigned to Me', '0' => 'Not Assigned', '3' => 'Assigned to User'])
//            ->with("unregistered_modules", $wf_modules->unregisteredMemberNotificationIds())
            ->with("users", $this->users->query()->where("id", "<>", access()->id())->get()->pluck('fullname', 'id'));
    }

    public function getPending()
    {
        $datatables = $this->wf_tracks->getForWorkflowDatatable();
        return $datatables->make(true);
    }

    public function myPending()
    {

        $wf_module_groups = new WfModuleGroupRepository();
        $wf_modules = new WfModuleRepository();
        return view("system/workflow/my_pending")
            ->with("wf_modules", $wf_modules->getAllActive()->pluck('name', 'id', 'id')->all())
            ->with("group_counts", $wf_modules->getActiveUser())
            ->with("unregistered_modules", $wf_modules->unregisteredMemberNotificationIds())
            ->with("state", "pending");
    }


    public function attended()
    {
        $wf_module_groups = new WfModuleGroupRepository();
        $wf_modules = new WfModuleRepository();
        return view("system/workflow/attended")
            ->with("wf_modules", $wf_modules->getAllActive()->pluck('name', 'id')->all())
            ->with("group_counts", $wf_modules->getMyAttendedActiveUser())
            ->with("state", "attended")
            ->with("statuses", ['1' => 'Attended by Me', '3' => 'Attended by User'])
            ->with("unregistered_modules", $wf_modules->unregisteredMemberNotificationIds())
            ->with("users", $this->users->query()->where("id", "<>", access()->id())->get()->pluck('name', 'id'));
    }


    /**
     * @return mixed
     * Allocate - Reallocate workflow to staff
     */
    public function allocation()
    {
        $wf_module_groups = new WfModuleGroupRepository();
        $wf_modules = new WfModuleRepository();
        return view("admin/system/workflow/allocation/allocation")
            ->with("wf_modules", $wf_modules->getAllActive()->pluck('name', 'id')->all())
            //->with("group_counts", $wf_modules->getActiveUser())
            ->with("state", "full")
            ->with("statuses", ['2' => 'All', '1' => 'Assigned to Me', '0' => 'Not Assigned', '3' => 'Assigned to User'])
            ->with("users", $this->users->getUsersForSelect());
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws WorkflowException
     */
    public function assignAllocation()
    {
        $input = request()->all();
        $this->wf_tracks->assignAllocation($input);
        return response()->json(['success' => true, 'message' => 'Success, user have been assigned to the selected resource(s)']);
    }



    /*Workflow defaults*/
    public function workflowDefaults()
    {
        $first_group_category = WfGroupCategory::query()->orderBy('name')->first();
        $group_categories = WfGroupCategory::query()->orderBy('name')->get();
        $wf_module_groups = WfModuleGroup::query()->orderBy('name')->get();
        $users = User::query()->get()->pluck('fullname', 'id');
        return view('admin/system/workflow/assign_default/assign_default')
            ->with('first_group_category',$first_group_category)
            ->with('group_categories', $group_categories)
            ->with('wf_module_groups', $wf_module_groups)
            ->with('users', $users);

    }


    public function assignWfDefaults()
    {

    }



    /**
     * @param Model $wf_track
     * Check if user has access on update Wf
     */
    public function checkIfUserHasAccessOnUpdateWf(Model $wf_track)
    {
//        if (access()->user()) {
//            $wf_track->resource->checkIfIsOwner();
//        } else {
            if(!($wf_track->checkIfHasRightCurrentWfTrackAction()))
            {
                /*User do not have access right for this level*/
                throw new GeneralException(__('exceptions.workflow.user_access_right'));
            }
//        }
    }


}
