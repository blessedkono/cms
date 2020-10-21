<?php

namespace App\Repositories\Workflow;

use App\Events\ApproveWorkflow;
use App\Events\NewWorkflow;
use App\Events\RejectWorkflow;
use App\Exceptions\GeneralException;
use App\Exceptions\WorkflowException;
use App\Jobs\Notifications\SendSms;
use App\Models\Auth\User;
use App\Models\Workflow\WfModule;
use App\Models\Workflow\WfTrack;
use App\Repositories\BaseRepository;
use App\Services\Workflow\Workflow;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


/**
 * Class WfTrackRepository
 * @package App\Repositories\Backend\Workflow
 * @author Erick M. Chrysostom <e.chrysostom@nextbyte.co.tz>
 */
class WfTrackRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = WfTrack::class;

    public function __construct()
    {

    }

    /**
     * @param $resource_id
     * @param $module_id
     * @return mixed
     */
    public function getRecentResourceTrack($module_id, $resource_id)
    {
        $wf_track = $this->query()->where('resource_id', $resource_id)->whereHas('wfDefinition', function ($query) use ($module_id) {
            $query->where('wf_module_id', $module_id);
        })->orderBy('id','desc')->first();
        return $wf_track;
    }

    /**
     * @param $wf_definition_id
     * @return mixed
     */
    public function getWfTrackId($wf_definition_id)
    {
        $wf_track = $this->query()->where('wf_definition_id', $wf_definition_id)->orderBy('id', 'desc')->first();
        return $wf_track->id;
    }


    public function getNextWftrackByParentId($current_wf_track_id)
    {
        $next_wf_track = $this->query()->where('parent_id', $current_wf_track_id)->first();
        return $next_wf_track;
    }




    /**
     * @param $resource_id
     * @param $wf_module_group_id
     * @param null $type
     * @return mixed
     * @throws GeneralException
     */
    public function getWfTracks($resource_id, $wf_module_group_id, $type = NULL)
    {
        $wf_module = (new Workflow(['wf_module_group_id' => $wf_module_group_id, 'type' => $type]))->getModule();
        $wf_tracks = $this->query()->where('resource_id', $resource_id)->whereHas('wfDefinition', function ($query) use ($wf_module) {
            $query->whereHas('wfModule', function ($query) use ($wf_module)  {
                $query->where('id', $wf_module);
            });
        })->orderBy('id','asc')->get();
        return  $wf_tracks;
    }

    /**
     * @param $resource_id
     * @param $wf_module_group_id
     * @param null $type
     * @return mixed
     * @throws GeneralException
     */
    public function getPendingWfTracksForDatatable($resource_id, $wf_module_group_id, $type = NULL)
    {
        $wf_module = (new Workflow(['wf_module_group_id' => $wf_module_group_id, 'type' => $type]))->getModule();
        $wf_tracks = $this->query()->where('resource_id', $resource_id)->whereHas('wfDefinition', function ($query) use ($wf_module) {
            $query->whereHas('wfModule', function ($query) use ($wf_module)  {
                $query->where('id', $wf_module);
            });
        })->where("status", 0)->orderBy('id','asc')->get();
        return  $wf_tracks;
    }

    /**
     * @param $resource_id
     * @param $wf_module_group_id
     * @param null $type
     * @return mixed
     * @throws GeneralException
     */
    public function getCompletedWfTracks($resource_id, $wf_module_group_id, $type = NULL)
    {
        $wf_module = (new Workflow(['wf_module_group_id' => $wf_module_group_id, 'type' => $type]))->getModule();
        $wf_tracks = $this->query()->whereHas('users', function ($query){
//            $query->WhereHas("staff");
        })->where('resource_id', $resource_id)->whereHas('wfDefinition', function ($query) use ($wf_module) {
            $query->whereHas('wfModule', function ($query) use ($wf_module)  {
                $query->where('id', $wf_module);
            });
        })->whereIn("status", [1,2])->orderBy('id','asc');
        return  $wf_tracks;
    }


    /**
     * @param $resource_id
     * @param $wf_module_id
     * @return mixed
     * New Function
     */
    public function getCompletedWfTracksNew($resource_id, $wf_module_id)
    {
        $wf_module = $wf_module_id;
        $wf_tracks = $this->query()->whereHas('users', function ($query){
//            $query->WhereHas("staff");
        })->where('resource_id', $resource_id)->whereHas('wfDefinition', function ($query) use ($wf_module) {
            $query->whereHas('wfModule', function ($query) use ($wf_module)  {
                $query->where('id', $wf_module);
            });
        })->whereIn("status", [1,2])->orderBy('id','asc');
        return  $wf_tracks;
    }

    /*Get deactivated wf tracks for dataTable*/
    public function getDeactivatedWfTracksForDataTable($resource_id, $wf_module_group_id)
    {
        return $this->query()->onlyTrashed()->where('resource_id',$resource_id)->whereHas('wfDefinition', function ($query) use ($wf_module_group_id){
            $query->whereHas('wfModule', function ($query) use ($wf_module_group_id)  {
                $query->where('wf_module_group_id', $wf_module_group_id);
            });
        })->orderBy('id','asc');
    }


    public function hasParticipated($wf_module_id, $resource_id, $currentLevel)
    {
        $query = $this->query()->where(['resource_id' => $resource_id, 'user_id' => access()->id()])->whereHas("wfDefinition", function ($query) use ($wf_module_id, $currentLevel) {
            $query->where('wf_module_id', $wf_module_id)->where('level', '<>', $currentLevel)->where("allow_repeat_participate", 0);
        })->first();
        if (isset($query)) {
            $return = true;
        } else {
            //if already participated in another level, check
            $return = false;
        }
        return $return;
    }

    public function assignStatus($wf_track_id)
    {
        $wf_track = $this->find($wf_track_id);
        if ($wf_track->assigned == 0) {
            $return = trans("label.not_assigned");
            $status = false;
        } else {
            $return = trans("label.assigned", ['name' => $wf_track->user->name]);
            $status = true;
        }
        return ['text' => $return, 'status' => $status];
    }

    public function updateWorkflow(Model $wf_track, array $input, $action)
    {
        DB::transaction(function () use ($wf_track, $input, $action) {
            if ($action == 'approve_reject' And is_null($input['comments'])) {
                if ($wf_track->wfDefinition->is_approval) {
                    $input['comments'] = "Approved";
                } else {
                    $input['comments'] = "Recommended";
                }
            }

            if ($action == 'assign') {
                $user = access()->user();
                $wf_track->user_id = $input['user_id'];
                $wf_track->assigned = $input['assigned'];
                $wf_track->save();
//                $user->wfTracks()->save($wf_track);
            } else {
                /*Assigned flag*/
                $input['assigned'] = 1;
                $input_filtered = Arr::except($input, ['port_id']);//$input without port_id
                $wf_track->update($input_filtered);
            }


            /* Process the workflow level requirements */
            if ($action == 'approve_reject') {
                if ($input['status'] != 0) {
                    switch ($input['status']) {
                        case '1':
                            /* Workflow Approved */
                            event(new ApproveWorkflow($wf_track, $input));
                            //update user_id on new Workflow
//                            if (isset($input['next_user_id'])) {
//                                $this->updateNextUserWorkflowId($wf_track, $input['next_user_id']);
//                            }

                            break;
                        case '2':
                            /* Workflow Rejected */
                            event(new RejectWorkflow($wf_track, $input['level']));
                            //update user_id on new Workflow for rejection - Selected from workflow modal
//                            $this->updateNextUserWorkflowId($wf_track, $input['next_user_id']);

                            break;

                    }
                }
            }
            return true;
        });
    }

    /**
     * @param $resource_id
     * @param $wf_module_group_id
     * @throws GeneralException
     */
    public function checkIfCanInitiateAction($resource_id, $wf_module_group_id)
    {
        $input = ['resource_id' => $resource_id, 'wf_module_group_id' => $wf_module_group_id ];
        $workflow = new Workflow($input);
        $wf_track = $this->checkIfHasWorkflow($resource_id, $wf_module_group_id);
        $level = $workflow->currentLevel();

        if (is_null($wf_track) || (($wf_track->status == 0) && ($level == 1)) ){
            // initiate action
        }else{
            throw new GeneralException(trans('exceptions.backend.workflow.can_not_initiate_action'));
        }
    }

    /**
     * @param $resource_id
     * @param $wf_module_id
     * @return mixed
     * @throws GeneralException
     */
    public function checkIfHasWorkflow($resource_id, $wf_module_id)
    {
        $input = ['resource_id' => $resource_id, 'wf_module_id' => $wf_module_id ];
        $workflow = new Workflow($input);
        $wf_track = $workflow->currentWfTrack();
        return $wf_track;
    }


    /**
     * @param $resource_id
     * @param $wf_module_group_id
     * @throws GeneralException
     * @deprecated
     */
    public function initiateOrRestartWorkflow($resource_id, $wf_module_group_id)
    {
        if (is_null($this->checkIfHasWorkflow($resource_id, $wf_module_group_id))) {
            event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $resource_id]));
        }else{
            //event(new ApproveWorkflow($this->checkIfHasWorkflow($resource_id,$wf_module_group_id)));
        }
    }

    public function getWorkflowQuery()
    {
        $workflowQuery = $this->query()->select([
            DB::raw("wf_tracks.id"),
            DB::raw("wf_module_groups.id as module_group_id"),
            DB::raw("wf_module_groups.name as module_group"),
            DB::raw("wf_modules.id as module_id"),
            DB::raw("wf_modules.name as module"),
            DB::raw("wf_definitions.description"),
            DB::raw("wf_definitions.level"),
            DB::raw("wf_tracks.resource_id"),
            DB::raw("wf_tracks.receive_date"),
            DB::raw("wf_tracks.resource_type"),
            DB::raw("wf_tracks.status"),
            DB::raw("wf_tracks.assigned"),
            DB::raw("wf_tracks.parent_id as parent_id"),
            DB::raw("concat_ws(' ', coalesce(users.firstname, ''), coalesce(users.middlename, ''), coalesce(users.lastname, '')) as user"),
        ])
            ->join("wf_definitions", "wf_definitions.id", "=", "wf_tracks.wf_definition_id")
            ->join("wf_modules", "wf_modules.id", "=", "wf_definitions.wf_module_id")
            ->join("wf_module_groups", "wf_module_groups.id", "=", "wf_modules.wf_module_group_id")
            ->leftJoin("users", "users.id", "=", "wf_tracks.user_id");
        return $workflowQuery;
    }


    public function getPendingQuery()
    {
        $pendings = $this->getWorkflowQuery()
            ->whereHas("wfDefinition", function ($query) {
                $query->whereHas("users", function ($subQuery) {
                    $subQuery->whereIn("user_wf_definition.user_id", access()->allUsers());
                });
            })
            ->where(function ($query) {
                $query->where(['status' => 0])
                    ->orWhere(['assigned' => 0]);
            });
        return $pendings;
    }


    public function getRespondedQuery()
    {
        $pendings = $this->getWorkflowQuery()
            ->whereHas("wfDefinition", function ($query) {
                $query->whereHas("users", function ($subQuery) {
                    $subQuery->whereIn("user_wf_definition.user_id", access()->allUsers());
                });
            })
            ->where(function ($query) {
                $query->where(['wf_tracks.status' => 0])
                    ->orWhere(['assigned' => 0]);
            })/*->whereDate('receive_date', '<',Carbon::today())*/
            ->whereRaw("(select count(1) from wf_tracks w where w.resource_id = wf_tracks.resource_id and w.wf_definition_id = wf_tracks.wf_definition_id) > 1")
            ->whereRaw('coalesce(wf_tracks.port_id,wf_tracks.zone_id,2) = ?',[access()->user()->staff->wf_location_id])
            ->orderBy('receive_date', 'desc');
        return $pendings;
    }


    public function getAttendedQuery()
    {
        $attended = $this->getWorkflowQuery()
            ->where(function ($query) {
                $query->whereIn("status", [1,2])
                    ->where('user_id', access()->id());
            })
            ->orderBy('receive_date', 'desc');
        return $attended;
    }

    public function getMyAttendedQuery()
    {
        $attended = $this->getAttendedQuery()
            ->where(function ($query) {
                $query->where('user_id', access()->id());
            });
        return $attended;
    }

    public function getPendingGroupCount($id)
    {
        $pendings = $this->getPendingQuery();
        return $pendings->where("wf_module_groups.id", $id)->count();
    }

    public function getPendingModuleCount($id)
    {
        $pendings = $this->getPendingQuery();
        return $pendings->where("wf_modules.id", $id)->count();
    }



########################
    public function getRespondedModuleCount($id)
    {
        $pendings = $this->getRespondedQuery();
        return $pendings->where("wf_modules.id", $id)->count();
    }
    ###################



    public function getMyPendingGroupCount($id)
    {
        $pendings = $this->getPendingQuery()->whereIn("user_id", access()->allUsers());
        return $pendings->where("wf_module_groups.id", $id)->count();
    }

    public function getMyPendingModuleCount($id)
    {
        $pendings = $this->getPendingQuery()->whereIn("user_id", access()->allUsers());
        return $pendings->where("wf_modules.id", $id)->count();
    }

    public function getMyAttendedGroupCount($id)
    {
        $attended = $this->getMyAttendedQuery();
        return $attended->where("wf_module_groups.id", $id)->count();
    }

    public function getMyAttendedModuleCount($id)
    {
        $attended = $this->getMyAttendedQuery();
        return $attended->where("wf_modules.id", $id)->count();
    }

    public function getPendingCount()
    {
        $pendings = $this->getPendingQuery();
        return $pendings->count();
    }

    public function getMyPendingCount()
    {
        $pendings = $this->getPendingQuery()->whereIn("user_id", access()->allUsers());
        return $pendings->count();
    }

    public function getForWorkflowDatatable()
    {

        if (request()->has("state")) {
            $state = request()->input('state');

            switch ($state) {
                case "full":
                    $pendings = $this->getAllPendingQuery();
                    break;
                case "pending":
                    $pendings = $this->getPendingQuery();
                    break;
                case "assigned":
                    $pendings = $this->getPendingQuery()->whereIn("user_id", access()->allUsers());
                    break;
                case "attended":
                    $pendings = $this->getAttendedQuery();
                    break;

                default:
                                   $pendings = $this->getPendingQuery();
                    break;
            }
            switch ($state) {
                case "attended":
                    switch (request()->input("status")) {
                        case '1':
                            /* Attended by Me */
                            $pendings->where("user_id", access()->id());
                            break;
                        case '3':
                            /* Assigned to User */
                            $user_id = request()->input("user_id");
                            $pendings->where("user_id", $user_id);
                            break;
                        default:
                            /* Attended by Me */
                            $pendings->where("user_id", access()->id());
                            break;
                    }
                    break;
                case "assigned":
                    break;
                default:

                    switch (request()->input("status")) {
                        case '0':
                            /* Not Assigned */
                            $pendings->where("assigned", 0);
                            break;
                        case '1':
                            /* Assigned to Me */
                            $pendings->where("user_id", access()->id());
                            break;
                        case '2':
                            /* All */
                            break;
                        case '3':
                            /* Assigned to User */
                            $user_id = request()->input("user_id");
                            $pendings->where("user_id", $user_id);
                            break;
                        default:
                            break;
                    }
                    break;
            }


        } else {
            $pendings = $this->getPendingQuery();
        }

        $search = request()->input('search');

        $wf_module_id = request()->input('wf_module_id');


        if ($wf_module_id) {
            //Filter By Workflow Module Id
            $pendings->where("wf_modules.id", $wf_module_id);
        }
        $wf_module_group_id =isset($wf_module_id) ? (new WfModuleRepository())->getModuleGroupId($wf_module_id) : null;
//        $wf_module_group_id = request()->input('wf_module_group_id');


        if (true) {
            if (true) {
                switch ($wf_module_group_id) {
                    case '1':
                        if ($search != "") {

                        }
                        break;

                    default:

                }
            }
        }

        $datatables = app('datatables')
            ->of($pendings)
            ->addColumn("resource_name", function ($query) {
                return (isset($query->resource)) ? $query->resource->resource_name : "";
            })
            ->addColumn("receive_date_formatted", function ($query) {
                return $query->receive_date_formatted;
            })
            ->addColumn("assign_status", function ($query) {
                return $query->assign_status;
            })
            ->addColumn("resource_uuid", function ($query) {
                return (isset($query->resource->uuid)) ? $query->resource->uuid : null;
            })
            ->addColumn("status", function ($query) {
                return $query->resource->status;
            })
            ->rawColumns(['status', 'assign_status']);

        return $datatables;
    }

    /**
     * @param $from_module_id
     * @param $to_module_id
     * @return bool
     * @throws GeneralException
     */
    public function transferWorkflow($from_module_id, $to_module_id)
    {
        $wfTracks = $this->query()->whereHas("wfDefinition", function ($query) use ($from_module_id) {
            $query->where("wf_module_id", $from_module_id);
        })->get();
        $workflow = new Workflow(['wf_module_id' => $to_module_id]);
        foreach ($wfTracks as $wfTrack) {
            $level = $wfTrack->wfDefinition->level;
            $definition = $workflow->levelDefinition($level);
            $wfTrack->wf_definition_id = $definition;
            $wfTrack->save();
        }
        return true;
    }

    /**
     * @param $from_module_id
     * @param $to_module_id
     * @param $type
     * @throws GeneralException
     */
    public function transferResourceWorkflow($from_module_id, $to_module_id, $type)
    {
        $wfModuleRepo = new WfModuleRepository();
        $wfModule = $wfModuleRepo->query()->select(['wf_module_group_id'])->where(['type' => $type, 'id' => $to_module_id])->first();
        if (isset($wfModule)) {
            $wfTracks = $this->query()->whereHas("wfDefinition", function ($query) use ($from_module_id) {
                $query->where("wf_module_id", $from_module_id);
            });
            switch ($wfModule->wf_module_group_id) {
                case 4:
                    //Notification Rejection
                    $wfTracks = $wfTracks->whereIn('resource_id', function($query) use ($type) {
                        $query->select('id')->from('notification_reports')->where(['incident_type_id' => $type]);
                    });
                    break;
            }
            $wfTracks = $wfTracks->get();
            $workflow = new Workflow(['wf_module_id' => $to_module_id]);
            foreach ($wfTracks as $wfTrack) {
                $level = $wfTrack->wfDefinition->level;
                $definition = $workflow->levelDefinition($level);
                $wfTrack->wf_definition_id = $definition;
                $wfTrack->save();
            }
        }
    }



    /**
     * @param $resource
     * @param $module
     * @return bool
     * @description Check if the workflow resource have had a completed workflow module trip
     */
    public function checkIfExistWorkflowModule($resource, $module)
    {
        $return = false;
        $count = $this->query()->whereHas("wfDefinition", function ($query) use ($module) {
            $query->whereHas("wfModule", function ($query) use ($module) {
                $query->where("wf_modules.id", $module);
            });
        })->where("resource_id", $resource)->count();
        if ($count)
            $return = true;
        return $return;
    }

    /**
     * @param $resource
     * @param $module
     * @return bool
     */
    public function checkIfExistDeclinedWorkflowModule($resource, $module)
    {
        $return = false;
        $count = $this->query()->whereHas("wfDefinition", function ($query) use ($module) {
            $query->whereHas("wfModule", function ($query) use ($module) {
                $query->where("wf_modules.id", $module)->where("allow_decline", 1);
            });
        })->where("resource_id", $resource)->count();
        if ($count)
            $return = true;
        return $return;
    }

    ###################################################################################################



    public function getMyAccomplishedWfTracks()
    {
        return $this->query()->where('status', 1)->whereHas('wfDefinition', function ($query) {
            $query->whereHas('users', function ($subQuery) {
                $subQuery->where('users.id', access()->id());
            });
        });
    }



    /*update next user*/
    public function updateNextUserWorkflowId(WfTrack $wf_track,$next_user_id)
    {
        $current_status = $wf_track->status;

        switch($current_status){
            case 1:
                /*when approving*/
                $next_track = $this->query()->where('parent_id', $wf_track->id)->first();
                $next_track->update(['user_id'=>$next_user_id, 'assigned'=>1]);
                break;
            case 2:
                /*when Rejection*/
                $next_track = $this->query()->where('parent_id', $wf_track->id)->first();
                $next_track->update(['user_id'=>$next_user_id, 'assigned'=>1]);
                break;
        }

        return $next_track;
    }

    /*Get all pendings*/
    public function getAllPendingQuery()
    {
        $pendings = $this->getWorkflowQuery()
            ->where(function ($query) {
                $query->where(['status' => 0])
                    ->orWhere(['assigned' => 0]);
            });
        return $pendings;
    }

    /* Workflow Module id*/
    public function getPendingModule($id)
    {
        $pendings = $this->getAllPendingQuery();
        return $pendings->where("wf_modules.id", $id)->get();
    }


    /**
     * @param $wf_group_id
     * @param $resource_id
     * Get wf module id after workflow start
     * Works for workflow groups which correspond to one table
     * @return mixed
     */
    public function getWfModuleAfterWorkflowStart($wf_group_id, $resource_id)
    {
        $current_track = $this->query()->where('resource_id',$resource_id)->whereHas('wfDefinition', function($query) use($wf_group_id){
            $query->whereHas('wfModule', function($query) use($wf_group_id){
                $query->where('wf_module_group_id',$wf_group_id);
            });
        })->orderBy('id', 'desc')->first();
        $wf_module = $current_track->wfDefinition->wfModule;
        return $wf_module;
    }


    /**
     * @param Model $wf_track
     * @return mixed|null
     * @throws GeneralException
     * Get users to be selected for next wf track/level
     */
    public function getNextUsersToAssignWf(Model $wf_track)
    {
        $wf_module = $wf_track->wfDefinition->wfModule;
        $wf_module_group_id = $wf_module->wf_module_group_id;
        $wf_definition = $wf_track->wfDefinition;
        $users = null;
        switch($wf_module_group_id){
            case 1:
                break;
        }
        return $users;
    }



    /**
     * @param array $input
     * @return mixed
     * @throws WorkflowException
     */
    public function assignAllocation(array $input)
    {
        if (!$input['assigned_user']) {
            throw new WorkflowException("The user to assign the workflow has not been selected.");
        }
        return DB::transaction(function () use ($input) {
            if (isset($input['id']) And ($input['id'])) {
                $resources = $this->query()->find($input['id']);
                foreach ($resources as $resource) {
                    if (!$resource->status) {
                        $resource->user_id = $input['assigned_user'];
                        $resource->assigned = 1;
                        $resource->user_type = 'App\Models\Auth\User';
                        $resource->allocated = $input['assigned_user'];
                        $resource->save();
                    }
                }
            } else {
                throw new WorkflowException("Please select at least one workflow entry.");
            }
            return true;
        });
    }



    /**
     * @param $wf_module_id
     * @param $level
     * @return mixed
     */
    public function previousLevelUser($wf_module_id, $level, $resource_id)
    {
        $query = $this->query()->select(['allocated'])->where("resource_id", $resource_id)->whereHas("wfDefinition", function ($query) use ($wf_module_id, $level) {
            $query->whereHas("wfModule", function ($query) use ($wf_module_id) {
                $query->where("wf_modules.id", $wf_module_id);
            })->where("level", $level);
        })->orderByDesc("id")->limit(1)->first();
        return $query->allocated;
    }




}
