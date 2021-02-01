<?php

namespace App\Http\Controllers\System;


use App\DataTables\System\RetrieveCodesDataTable;
use App\DataTables\System\RetrieveCodeValuesDataTable;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\CodeValueRequest;
use App\Models\System\Code;
use App\Models\System\CodeValue;
use App\Repositories\System\CodeRepository;
use App\Repositories\System\CodeValueRepository;
use Illuminate\Http\Request;

class CodeController extends Controller
{

    protected $codes;
    protected $code_values;

    public function __construct( ) {
        $this->codes = new CodeRepository();
        $this->code_values = new CodeValueRepository();

        /*Permissions*/
//        $this->middleware('access.routeNeedsPermission:manage_system', ['only' => ['codeValueCreate', 'codeValueStore', 'codeValueEdit', 'codeValueUpdate', 'codeValueDestroy', 'codeValueDeactivate', 'codeValueActivate' ]]);
//        $this->middleware('access.routeNeedsPermission:admin_menu', ['only' => ['index', 'getCodeValues' ]]);

    }

    /**
     * CODE METHODS ===================
     */

    /**
     * Display a listing of the resource.
     * @param RetrieveCodesDataTable $dataTable
     * @return mixed
     */
    public function index(RetrieveCodesDataTable $dataTable)
    {
        return  $dataTable->render('admin.system.code.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $code = $this->codes->create($request->all());
        return redirect()->route('backend.system.code.index')->withFlashSuccess(trans('alerts.backend.system.code_created'));
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
//        $code = $this->codes->findOrThrowException($id);
//        return view('backend/system/code/edit')
//            ->withCode($code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $id, Request $request)
    {
//        $code = $this->codes->update($id,$request->all());
//        return redirect()->route('backend.system.code.index')->withFlashSuccess(trans('alerts.backend.system.code_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * END CODE =====================
     */



    /**
     * CODE VALUE METHODS ===================
     */

    /**
     * @param $id
     * @param GetCodeValuesDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     * Get code values for selected code
     */

    public function getCodeValues(Code $code, RetrieveCodeValuesDataTable $dataTable)
    {
        return  $dataTable->with('code_id',$code->id)->render('admin/system/code/code_value/index',['code'=>$code]);
    }

    //index

    /**
     * Display a listing of the resource.
     */
    public function codeValueIndex()
    {

    }

    // create
    public function codeValueCreate(Code $code)
    {
        return view('admin.system.code.code_value.create')->with([
            'code' => $code,
        ]);
    }
    // store
    public function codeValueStore(CodeValueRequest $request, Code $code)
    {
        $input = $request->all();
        $this->code_values->store($input, $code);
        return redirect()->route('code.values', $code->id)->withFlashSuccess(trans(''));
    }
    // edit
    public function codeValueEdit($code_value)
    {

        $code_value = $this->code_values->find($code_value);
        return view('admin.system.code.code_value.edit')->with([
            'code_value' => $code_value,
            'lang' => null,
        ]);
    }

    // update
    public function codeValueUpdate(CodeValueRequest $request, $code_value)
    {
        $cv = $this->code_values->find($code_value);
        $input = $request->all();
        $this->code_values->update($input, $cv);
        return redirect()->route('code.values', $cv->code_id)->withFlashSuccess(trans('alert.system.code_value.updated'));
    }

    // deactivate
    public function codeValueDeactivate($code_value_id)
    {
        //
        $cv = $this->code_values->find($code_value_id);
        $this->code_values->activateDeactivate($cv,0);
        return redirect()->route('code.values', $cv->code_id)->withFlashSuccess(trans('alert.system.code_value.deactivated'));
    }


    // Activate
    public function codeValueActivate($code_value_id)
    {
        //
        $cv = $this->code_values->find($code_value_id)->withoutGlobalScopes()->first();
        $this->code_values->activateDeactivate($cv, 1);
        return redirect()->route('code.values', $cv->code_id)->withFlashSuccess(trans('alert.system.code_value.activated'));
    }

    //--end Code Values-----------

}
