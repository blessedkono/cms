<?php


namespace App\Http\Controllers\Cms\traits;


use App\Models\Cms\Module;
use App\Models\Cms\ModuleFunctionalPart;
use Yajra\DataTables\DataTables;

trait UserManualControllerTrait
{

    //get module by group
    public function getModuleByGroup($group_id)
    {
        $result_list = Module::where('module_group_id',$group_id)->get();
        return DataTables::of($result_list)
            ->addIndexColumn()
            ->addColumn('status', function ($tasks)
            {
                return isset($tasks->isactive)?trans('label.active'):trans('label.inactive');
            })
            ->rawColumns([''])
            ->make(true);
    }
    //get module by group
    public function getModuleFuctionalParts($module_id)
    {
        $result_list = ModuleFunctionalPart::where('module_id',$module_id)->get();
        return DataTables::of($result_list)
            ->addIndexColumn()
            ->addColumn('status', function ($tasks)
            {
                return isset($tasks->isactive)?trans('label.active'):trans('label.inactive');
            })
            ->rawColumns([''])
            ->make(true);
    }
}
