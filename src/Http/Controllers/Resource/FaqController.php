<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sysdef\FaqCreateRequest;
use App\Http\Requests\Sysdef\FaqUpdateRequest;
use App\Models\Sysdef\CodeValue;
use App\Models\Sysdef\Faq;
use App\Repositories\Cms\FaqRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{


    protected $faqs;

    public function __construct(){

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //\
        $faqs = (new FaqRepository())->getAllByRank();
        return view('system.faq.index')
            ->with('faqs',$faqs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('system.faq.create.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqCreateRequest $request)
    {
        $input = $request->all();
        $faq = $this->faqs->store($input);
        return redirect()->route('faq.profile',$faq->uuid)->withFlashSuccess(__('alert.system.faq.created'));
    }


    public function profile(Faq $faq)
    {
        return view('system.faq.profile.profile')
            ->with('faq', $faq);
    }

    public function search(){
//        $faqs = $this->faqs->getAllByRank();
        return view('system.faq.search.search')->with([
            'faqs' => $faqs,
        ]);
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Faq $faq)
    {
        return view('system.faq.edit.edit')
            ->with('faq', $faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqUpdateRequest $request, Faq $faq)
    {
        //
        $this->faqs->update($faq, $request->all());
        return redirect()->route('faq.profile',$faq->uuid)->withFlashSuccess(__('alert.system.faq.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $user = access()->user();
        $this->faqs->delete($faq);
        return redirect()->route('faq.index')->withFlashSuccess(__('alert.system.faq.deleted'));
    }


    /*Get FAQS by category*/
    public function categories(CodeValue $category)
    {
        return view('system.faq.search.search')->with([
            'faqs' => $this->faqs->getAllByService($category->id),
            'category' => $category,
            'category_name' => code_value()->name($category->id)
        ]);
    }



    /*Get FAQS by sub category*/
    public function getBySubCategory(CodeValue $sub_category)
    {
        return view('system.faq.search.search')->with([
            'faqs' => $this->faqs->getAllBySubService($sub_category->id),
            'category_' => $sub_category,
            'category_name' => code_value()->name($sub_category->id)
        ]);
    }



    /*Get FAQS which are general*/
    public function getGeneralFaqs()
    {
        return view('system.faq.search.search')->with([
            'faqs' => $this->faqs->getGeneralFaqs(),
            'category_name' => __('label.general'),
        ]);
    }



    public function getForAdminDataTable()
    {
        $faq = $this->faqs->getForAdminDataTable();
        return DataTables::of($faq)
            ->addIndexColumn()
            ->addColumn('user', function ($faq) {
                return $faq->user->name;
            })
            ->addColumn('actions', function ($faq) {
                return '<a href="'.route('faq.profile', $faq->uuid).'">'.trans('label.view').'</a> <br>'. link_to_route('faq.edit', __('buttons.general.crud.edit'), [$faq->uuid], ['class' => 'btn btn-warning btn-xs']) .' <br>'. link_to_route('faq.destroy',  __('buttons.general.crud.delete'), [$faq->uuid], ['data-method' => 'delete', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.warning'), 'data-trans-text' => trans('alert.system.faq.warning.delete'), 'class' => 'btn btn-danger btn-xs']);
            })
            ->addColumn('service', function ($faq) {
                return (isset($faq->logistic_service_sub_cv_id) ? '<span>'.$faq->logisticService->name.'</span>' : '')
                    . (isset($faq->logistic_service_sub_cv_id) ? '<p>' . $faq->logisticServiceCategory->name . '</p>' : '');
            })
            ->rawColumns(['actions','service'])
            ->make();
    }

}
