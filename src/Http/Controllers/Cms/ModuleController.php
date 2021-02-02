<?php


namespace nextbytetz\websitecms\Http\Controllers\Cms;


use App\Http\Controllers\Controller;
use App\Models\Cms\Module;
use App\Models\Cms\ModuleGroup;
use App\Repositories\Cms\ModuleGroupRepository;
use App\Repositories\Cms\ModuleRepository;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    public function __construct()
    {

    }

    //create module group
    public function crateModule(ModuleGroup $module_group)
    {
        return view('cms.user_manual.module.create')
            ->with('module_group',$module_group);
    }

    //store user manual module group
    public function storeModule(Request $request)
    {
        $input = $request->all();
        $module = (new ModuleRepository())->store($input);
        return redirect()->route('cms.user_manual.modules_by_group',$input['module_group_id']);
    }
    //store user manual module group
    public function updateModule(Request $request,Module $module)
    {
        $input = $request->all();
        $module_update = (new ModuleRepository())->update($input,$module);
        return redirect()->route('cms.user_manual.module_profile',$module->id);
    }

    //edit module group
    public function editModule(Module $module)
    {
        $module_groups = (new ModuleGroupRepository())->queryActive()->pluck('name','id');
        return view('cms.user_manual.module.edit')
            ->with('module_groups',$module_groups)
            ->with('module',$module);
    }
    //delete module group
    public function deleteModule(Module $module)
    {
        if($module->moduleFunctionalParts()->count() > 0)
        {
            return redirect()->back();
        }else{
            (new ModuleRepository())->delete($module);
            return redirect()->route('cms.user_manual.module_groups');
        }

    }

}
