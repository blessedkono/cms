<?php

namespace nextbytetz\websitecms\Http\Controllers\Cms;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\ClientTestimonialRequest;
use App\Models\Cms\Client;
use App\Models\Cms\Testimonial;
use App\Models\System\Designation;
use App\Repositories\Cms\ClientRepository;
use App\Repositories\Cms\ClientTestimonialRepository;
use App\Repositories\System\DocumentResourceRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientTestimonialController extends Controller
{
    //

    protected $client_testimonial_repo;
    /**
     *Construct Method for this class
     */
    public function __construct()
    {
        $this->client_testimonial_repo = new ClientTestimonialRepository();

    }



    /**
     *Open list all page of ClientTestimonial
     * @param Testimonial $client_testimonial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cms.testimonial.index');
    }

    /**
     *Open page for adding new ClientTestimonial
     */
    public function create()
    {

        $designations = Designation::all()->where('isactive',1)->pluck('name','id');
        return view('cms/testimonial/create/create')
            ->with('designations',$designations);
    }

    /**
     *Save new Amountentry for ClientTestimonial
     * @param ClientTestimonialRequest $request
     * @return
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $client_testimonial = $this->client_testimonial_repo->store($input);
        return redirect()->route('cms.testimonial.profile', $client_testimonial->uuid)->withFlashSuccess(__('alert.general.created'));
    }

    /**
     *Open page for modifying existing ClientTestimonial
     * @param Testimonial $client_testimonial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Testimonial $client_testimonial)
    {
        $clients = (new ClientRepository())->query()->where('id', $client_testimonial->client_id)->get()->pluck('name', 'id');
        $designations = Designation::all()->where('isactive',1)->pluck('name','id');
        return view('cms/testimonial/edit/edit')
            ->with('designations', $designations)
            ->with('clients', $clients)
            ->with('client_testimonial', $client_testimonial);
    }

    /**
     *Modify existing ClientTestimonial
     * @param ClientTestimonialRequest $request
     * @param Testimonial $client_testimonial
     * @return
     */
    public function update(Request $request, Testimonial $client_testimonial)
    {
        $input = $request->all();
        $client_testimonial = $this->client_testimonial_repo->update($client_testimonial, $input);
        return redirect()->route('cms.testimonial.profile',['client_testimonial' => $client_testimonial->uuid])->withFlashSuccess(__('alert.general.updated'));
    }

    /**
     *Overview page to display data of ClientTestimonial
     * @param Testimonial $client_testimonial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Testimonial $client_testimonial)
    {
        return view('cms/testimonial/profile')
            ->with('client_testimonial', $client_testimonial);

    }

    /**
     *Open page to display data of ClientTestimonial
     * @param Testimonial $client_testimonial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Testimonial $client_testimonial)
    {
        return view('operation/shift/discount/show')->with('client_testimonial', $client_testimonial);
    }

    /**
     *delete/destroy ClientTestimonial
     * @param Testimonial $client_testimonial
     * @return
     */
    public function delete(Testimonial $client_testimonial)
    {
        $client_testimonial = $this->client_testimonial_repo->delete($client_testimonial);
        return redirect()->route('cms.testimonial.index')->withFlashSuccess(__('alert.general.deleted'));
    }



    /*Store from shift*/
    public function storeFromShift(ClientTestimonialRequest $request)
    {
        $input = $request->all();
        $client = Client::query()->find($input['client_id']);
        $input['document_title'] =($client) ? ('Discount -' . $client->name) : '';
        $client_testimonial = $this->client_testimonial_repo->store($input);
        return redirect()->route('cms.testimonial.fill_for_shift', $client_testimonial->shift->uuid)->withFlashSuccess(__('alert.general.created'));
    }

    //change status
    public function changeStatus(Testimonial $client_testimonial)
    {
        $status = $client_testimonial->isactive;
        switch ($status){
            case 1;
                $this->client_testimonial_repo->changeStatus($client_testimonial,0);
                return redirect()->back()->withFlashSuccess(trans('alert.general.deactivated'));
                break;

            case 0:
                $this->client_testimonial_repo->changeStatus($client_testimonial,1);
                return redirect()->back()->withFlashSuccess(trans('alert.general.activated'));
                break;
            default :
                return redirect()->back();

                break;

        }
    }

    /**
     *list all ClientTestimonial
     */
    public function getAllForDt()
    {
        $result_list = $this->client_testimonial_repo->getAllForDt()->orderBy('id','desc');
        return DataTables::of($result_list)
            ->addIndexColumn()
            ->addColumn('client', function ($result_list)
            {
                return ($result_list->client->name) ;
            })
            ->addColumn('designation', function ($result_list)
            {
                return $result_list->designation->name ;
            })

            ->rawColumns([''])
            ->make(true);
    }


}
