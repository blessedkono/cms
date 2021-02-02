<?php


namespace nextbytetz\websitecms\Http\Controllers\Cms;


use App\Http\Controllers\Controller;
use App\Models\Cms\Module;
use App\Models\Cms\ModuleFunctionalPart;
use App\Repositories\System\DocumentResourceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ModuleFunctionalPartController extends  Controller
{

    protected $module_functional_part_repo;
    /**
     *Construct Method for this class
     */
    public function __construct()
    {
        $this->module_functional_part_repo = new ModulefunctionalPartRepository();
    }

    /**
     *Open list all page of ModulefunctionalPart
     */
    public function index()
    {
        return view('cms.user_manual.module_functional.index');
    }

    /**
     *Open page for adding new ModulefunctionalPart
     * @param Module $module
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Module $module)
    {
        return view('cms.user_manual.module_functional_part.create')
            ->with('module',$module);
    }

    /**
     *Save new entry for ModulefunctionalPart
     * @param ModulefunctionalPartRequest $request
     * @return
     */
    public function store(ModulefunctionalPartRequest $request)
    {
        $input = $request->all();
        $module_functional_part = $this->module_functional_part_repo->store($input);
        return redirect()->route('cms.user_manual.module_functional_part.profile',['module_functional_part' =>$module_functional_part->id])->withFlashSuccess(__('alert.general.created'));
    }

    /**
     *Open page for modifying existing ModulefunctionalPart
     * @param ModuleFunctionalPart $module_functional_part
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ModulefunctionalPart $module_functional_part)
    {
        $attachments = $module_functional_part->documents()->where('document_id',3)->get();
        $modules= Module::query()->where('isactive',1)->pluck('name','id');
        return view('cms.user_manual.module_functional_part.edit')
            ->with('attachments', $attachments)
            ->with('module_functional_part', $module_functional_part)
            ->with('modules',$modules);
    }

    /**
     *Modify existing ModulefunctionalPart
     * @param ModulefunctionalPartRequest $request
     * @param ModuleFunctionalPart $module_functional_part
     * @return
     */
    public function update(ModulefunctionalPartRequest $request, ModulefunctionalPart $module_functional_part)
    {
        $input = $request->all();
        $module_functional_part = $this->module_functional_part_repo->update($module_functional_part, $input);
        return redirect()->route('cms.user_manual.module_functional_part.profile',['module_functional_part' => $module_functional_part->id])->withFlashSuccess(__('alert.general.updated'));
    }

    /**
     *Overview page to display data of ModulefunctionalPart
     * @param ModuleFunctionalPart $module_functional_part
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(ModulefunctionalPart $module_functional_part)
    {
        return view('cms.user_manual.module_functional_part.show')->with('module_functional_part', $module_functional_part);
    }

    /**
     *Open page to display data of ModulefunctionalPart
     * @param ModuleFunctionalPart $module_functional_part
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ModulefunctionalPart $module_functional_part)
    {
        return view('cms.user_manual.module_functional.show')->with('module_functional_part', $module_functional_part);
    }

    /**
     *delete/destroy ModulefunctionalPart
     * @param ModuleFunctionalPart $module_functional_part
     * @return
     */
    public function delete(ModulefunctionalPart $module_functional_part)
    {
        $module_id = $module_functional_part->module->id;
        $module_functional_part = $this->module_functional_part_repo->delete($module_functional_part);
        return redirect()->route('cms.user_manual.module_profile',$module_id)->withFlashSuccess(__('alert.general.deleted'));
    }


    //upload tempo pic file
    public function uploadTemporaryFiles(Request $request)
    {
        $input= $request->all();
        foreach ($input as $key => $value) {
            if (strpos($key, 'files') !== false) {
                (new DocumentResourceRepository())->saveDocument($input['functional_part_id'],1,'files',$input);
            }
        };
    }
    //get functional part row
    public function getFunctionalRowByAjax(Request $request)
    {
        $input = $request->all();
        $functional_part = ModuleFunctionalPart::find($input['functional_part_id']);
        return view('cms.user_manual.module_functional_part.includes.module_functional_row')
            ->with('functional_part',$functional_part);
    }

    //search module functional part
    public function getSearchFunctionalByAjax(Request $request)
    {
        $input = $request->all();
        $module_functional_parts = ModuleFunctionalPart::where('title','LIKE', '%' . $input['search_content'] . '%' )->orWhere('description','LIKE', '%' . $input['search_content'] . '%' )->get();
        return ($module_functional_parts);
    }


    /**
     *list all ModulefunctionalPart
     */
    public function getAllForDt()
    {
        $result_list = $this->module_functional_part_repo->getAllForDt();
        return DataTables::of($result_list)
            ->addIndexColumn()
            ->rawColumns([''])
            ->make(true);
    }


}
