<?php

namespace Nextbyte\Cms\Http\Controllers\Cms;

use App\Http\Controllers\Controller;

use App\Http\Requests\Resource\FaqCreateRequest;
use App\Models\Cms\Faq;
use Illuminate\Http\Request;
use Nextbyte\Cms\Repositories\Cms\FaqRepository;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{


    protected $faqs;

    public function __construct(){
        $this->faqs = new FaqRepository();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //\
        return view('cms::cms.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cms.faq.create.create');
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
        return redirect()->route('cms.faq.index')->withFlashSuccess(__('alert.system.faq.created'));
    }


    /**
     * @param Faq $faq
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Faq $faq)
    {
        return view('cms.faq.profile.profile')
            ->with('faq', $faq);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(){
        $faqs = $this->faqs->getAllByRank()->get();
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
        return view('cms.faq.edit.edit')
            ->with('faq', $faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FaqCreateRequest $request
     * @param Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function update(FaqCreateRequest $request, Faq $faq)
    {
        //
        $this->faqs->update($faq, $request->all());
        return redirect()->route('cms.faq.profile',$faq->uuid)->withFlashSuccess(__('alert.system.faq.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $user = access()->user();
        $this->faqs->delete($faq);
        return redirect()->route('cms.faq.index')->withFlashSuccess(__('alert.system.faq.deleted'));
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
            ->addColumn('actions', function ($faq) {
                return '<a href="'.route('cms.faq.profile', $faq->uuid).'">'.trans('label.view').'</a>'. link_to_route('cms.faq.edit', __('buttons.general.crud.edit'), [$faq->uuid], ['class' => 'btn btn-warning btn-xs']) .' '. link_to_route('cms.faq.delete',  __('buttons.general.crud.delete'), [$faq->uuid], ['data-method' => 'delete', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.warning'), 'data-trans-text' => trans('alert.system.faq.warning.delete'), 'class' => 'btn btn-danger btn-xs']);
            })
            ->addColumn('status', function ($faq) {
                return (isset($faq->isactive) ? '<span>'.trans('label.active').'</span>' : trans('label.inactive'));
            })
            ->rawColumns(['actions','status'])
            ->make();
    }

}
