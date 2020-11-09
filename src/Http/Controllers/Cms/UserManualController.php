<?php


namespace App\Http\Controllers\Cms;


use App\Http\Controllers\Cms\traits\UserManualControllerTrait;
use App\Http\Controllers\Controller;
use App\Models\Cms\Module;
use App\Models\Cms\ModuleFunctionalPart;
use App\Models\Cms\ModuleGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserManualController extends Controller
{
    use UserManualControllerTrait;

    public function __construct()
    {

    }


    //user manual menu
    public function menu()
    {
        return view('cms.user_manual.menu');
    }

    //module groups
    public function moduleGroups()
    {
        $module_groups = ModuleGroup::query()->get();
        return view('cms.user_manual.menu')
            ->with('module_groups',$module_groups);

    }

    //create module group
    public function crateModuleGroup()
    {
        return view('');
    }

    //module by module group
    public function openModulesByGroup(ModuleGroup $module_group)
    {
        return view('cms.user_manual.module.index')
            ->with('module_group',$module_group);
    }
    //modules
    public function moduleProfile(Module $module)
    {
        return view('cms.user_manual.module.show.show')
            ->with('module',$module);
    }

    //get module details (row) by ajax
    public function getModuleRowByAjax(Request $request)
    {
        $input = $request->all();
        $module = Module::find($input['module_id']);
        return view('cms.user_manual.module.includes.module_article')
            ->with('module',$module);
    }




}
