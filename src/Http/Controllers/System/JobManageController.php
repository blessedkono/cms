<?php

namespace App\Http\Controllers\System;


use App\DataTables\System\RetrieveSysdefGroupsDataTable;
use App\DataTables\System\RetrieveSysDefinitionsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\UpdateSysdefRequest;
use App\Models\System\Sysdef;
use App\Models\Sysdef\SysdefGroup;
use App\Repositories\System\JobManageRepository;
use App\Repositories\System\SysdefRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Models\Audit;
use Yajra\Datatables\Datatables;

class JobManageController extends Controller
{

    protected $job_manage_repo;

    public function __construct()
    {

        $this->job_manage_repo = new JobManageRepository();

        /*Permissions*/
        $this->middleware('access.routeNeedsPermission:manage_system', ['only' => ['deleteJob', 'deleteAllJobs', 'deleteFailedJob', 'deleteAllFailedJobs' ]]);
        $this->middleware('access.routeNeedsPermission:admin_menu', ['only' => ['index','viewActiveJobsPage', 'showJob', 'viewFailedJobsPage', 'showFailedJob'  ]]);
    }




    /*Manage Jobs*/
    public function index()
    {
        $count_jobs = $this->job_manage_repo->countJobs();
        $count_failed_jobs = $this->job_manage_repo->countFailedJobs();
        return view('admin/system/job_manage/index')
            ->with('count_jobs', $count_jobs)
            ->with('count_failed_jobs', $count_failed_jobs);
    }




    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * =====================START JOBS METHODS =============================
     */

    public function viewActiveJobsPage()
    {
        return view('admin/system/job_manage/active_jobs/index');
    }


    /*Get active jobs for Datatable*/
    public function getActiveJobsForDt()
    {
        $data = $this->job_manage_repo->getActiveJobsForDt()->orderBy('id')->orderBy('reserved_at');
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('payload', function($job) {
                return truncateString($job->payload, 120);
            })
            ->editColumn('reserved_at', function($job) {
                return $this->job_manage_repo->getDateFromInt($job->reserved_at);
            })
            ->editColumn('available_at', function ($job) {
                return $this->job_manage_repo->getDateFromInt($job->available_at);
            })
            ->editColumn('created_at', function ($job) {
                return $this->job_manage_repo->getDateFromInt($job->created_at);
            })
            ->rawColumns([''])
            ->make(true);
    }


    /*Show JOB info*/
    public function showJob($job_id)
    {
        $job = DB::table('jobs')->where('id', $job_id)->first();
        if(isset($job->id)){
            return view('admin/system/job_manage/active_jobs/show')
                ->with('job', $job);
        }else{
            /*return to job if do not exist*/
            return redirect()->route('system.job.index');
        }

    }

    /*delete selected*/
    public function deleteJob($job_id)
    {
        $this->job_manage_repo->deleteJob($job_id);
        return redirect()->route('system.job.index')->withFlashSuccess(__('alert.general.deleted'));
    }


    public function deleteAllJobs()
    {
        $this->job_manage_repo->deleteAllJobs();
        return redirect()->route('system.job.index')->withFlashSuccess(__('alert.general.deleted'));
    }


    /*-----End JOBS METHODS---------------------*/




    /**
     * ====================START FAILED JOS METHODS=============================
     */

    public function viewFailedJobsPage()
    {
           return view('admin/system/job_manage/failed_jobs/index');
    }


    public function getFailedJobsForDt()
    {
        $data = $this->job_manage_repo->getFailedJobsForDt()->orderBy('id', 'desc');
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('payload', function($job) {
                return truncateString($job->payload, 120);
            })
            ->editColumn('exception', function($job) {
                return truncateString($job->exception, 120);
            })
            ->rawColumns([''])
            ->make(true);
    }


    /*Show JOB info*/
    public function showFailedJob($failed_job_id)
    {
        $failed_job = DB::table('failed_jobs')->where('id', $failed_job_id)->first();
        if(isset($failed_job->id)){
            return view('admin/system/job_manage/failed_jobs/show')
                ->with('failed_job', $failed_job);
        }else{
            /*return to job if do not exist*/
            return redirect()->route('system.failed_job.index');
        }

    }

    /*delete selected*/
    public function deleteFailedJob($failed_job_id)
    {
        $this->job_manage_repo->deleteFailedJob($failed_job_id);
        return redirect()->route('system.failed_job.index')->withFlashSuccess(__('alert.general.deleted'));
    }


    public function deleteAllFailedJobs()
    {
        $this->job_manage_repo->deleteAllFailedJobs();
        return redirect()->route('system.failed_job.index')->withFlashSuccess(__('alert.general.deleted'));
    }



    /*--------End FAILED JOBS METHODS-------------------------------*/

}
