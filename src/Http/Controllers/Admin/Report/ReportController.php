<?php

namespace nextbytetz\websitecms\Http\Controllers\Admin\Report;



use App\DataTables\Report\ReportsByGroupDataTable;
use App\DataTables\System\RetrieveSysdefGroupsDataTable;
use App\DataTables\System\RetrieveSysDefinitionsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\UpdateSysdefRequest;
use App\Models\System\ReportGroup;
use App\Models\System\Sysdef;
use App\Models\Sysdef\SysdefGroup;
use App\Repositories\System\SysdefRepository;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * ReportController constructor.
     */
    public function __construct()
    {
        $this->middleware('access.routeNeedsPermission:manage_system', ['only' => ['index' ]]);
    }


    public function index(){

        $report_groups = ReportGroup::query()->get();
        return view('admin/system/report/index')
            ->with('report_groups', $report_groups);
    }

    /**
     * @param $category_id
     * @param ReportsByTypeDataTable $dataTable
     * @return mixed
     * Open list of reports by type selected
     *
     */
    public function openReportsByGroup($group_id, ReportsByGroupDataTable $dataTable){

        $report_group_name = ReportGroup::query()->where('id', $group_id)->first()->name;
              return $dataTable->with([
            'group_id' => $group_id])->render('admin/system/report/reports_by_group', ['report_group' => $report_group_name]);
    }


}
