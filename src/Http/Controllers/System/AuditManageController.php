<?php

namespace nextbytetz\websitecms\Http\Controllers\System;



use App\DataTables\System\RetrieveSysdefGroupsDataTable;
use App\DataTables\System\RetrieveSysDefinitionsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\UpdateSysdefRequest;
use App\Models\System\Sysdef;
use App\Models\Sysdef\SysdefGroup;
use App\Repositories\System\AuditManageRepository;
use App\Repositories\System\JobManageRepository;
use App\Repositories\System\SysdefRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Models\Audit;
use Yajra\Datatables\Datatables;

class AuditManageController extends Controller
{

    protected $audit_manage_repo;

    public function __construct()
    {

        $this->audit_manage_repo = new AuditManageRepository();

        /*Permissions*/
//        $this->middleware('access.routeNeedsPermission:manage_system', ['only' => ['edit', 'update' ]]);
        $this->middleware('access.routeNeedsPermission:admin_menu', ['only' => ['index','searchPage', 'showAudit'  ]]);
    }




    /*Manage Audits*/
    public function index()
    {
        return view('admin/system/audit_manage/index');
    }




    public function searchPage()
    {
        $auditable_types = $this->audit_manage_repo->getAuditablesForSelect();
        return view('admin/system/audit_manage/search/index')
            ->with('auditable_types', $auditable_types);
    }


    /*Get audits for DataTable*/
    public function getForDt()
    {
        $data = $this->audit_manage_repo->getForDt()->orderBy('id', 'desc');
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('user', function($audit) {
                return isset($audit->user->fullname) ? $audit->user->fullname : '';
            })
            ->addColumn('auditable', function($audit) {
                return isset($audit->auditable->auditable_name) ? $audit->auditable->auditable_name :  $audit->auditable_type . '\\'.  $audit->auditable_id;
            })
            ->editColumn('old_values', function($audit) {
                return truncateString(json_encode($audit->old_values), 40);
            })
            ->editColumn('new_values', function($audit) {
                return truncateString(json_encode($audit->new_values), 40);
            })
            ->rawColumns([''])
            ->make(true);
    }




/*Show audit page*/
    public function showAudit($audit_id)
    {
        $audit = Audit::query()->find($audit_id);
        return view('admin/system/audit_manage/show')
            ->with('audit', $audit);
    }




}
