<?php

namespace App\Http\Controllers\System;


use App\DataTables\System\RetrieveSysdefGroupsDataTable;
use App\DataTables\System\RetrieveSysDefinitionsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\UpdateSysdefRequest;
use App\Models\System\Sysdef;
use App\Models\Sysdef\SysdefGroup;
use App\Repositories\System\SysdefRepository;
use Illuminate\Http\Request;

class SysdefController extends Controller
{
    protected $sysdef;

    public function __construct()
    {
        $this->sysdefs = new SysdefRepository();

        /*Permissions*/
//        $this->middleware('access.routeNeedsPermission:manage_system', ['only' => ['edit', 'update' ]]);
//        $this->middleware('access.routeNeedsPermission:admin_menu', ['only' => ['index','getSysdefsForDataTable'  ]]);
    }

    /**
     * Display a listing of the Sysdef Group.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RetrieveSysdefGroupsDataTable $dataTable)
    {
        //
        return  $dataTable->render('admin/system/sysdef/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param Sysdef $sysdef
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Sysdef $sysdef)
    {
        return view('admin.system.sysdef.definition.edit')->with([
            'sysdef' => $sysdef,
            'route' => 'sysdef.update',
            'param' => $sysdef->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Sysdef $sysdef
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdateSysdefRequest $request, Sysdef $sysdef)
    {
        $input = $request->all();
        $this->sysdefs->update($input, $sysdef);
        return redirect()->route('sysdef.definitions',$sysdef->sysdef_group_id)->withFlashSuccess(__('alert.system.sysdef.updated'));
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get Sysdefs for datatable based on the group
     * @param SysdefGroup $sysdef_group
     * @param RetrieveSysDefinitionsDataTable $dataTable
     * @return mixed
     */
    public function getSysdefsForDataTable(SysdefGroup $sysdef_group, RetrieveSysDefinitionsDataTable $dataTable)
    {

        return  $dataTable->with('sysdef_group_id',$sysdef_group->id)->render('admin/system/sysdef/definition/index',['sysdef_group'=>$sysdef_group]);
    }

}
