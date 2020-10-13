<?php

namespace Nextbyte\Cms\Http\Controllers\Cms;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;

use App\Http\Requests\Resource\ClientRequest;
use App\Models\Cms\Client;
use App\Repositories\Cms\ClientRepository;
use App\Repositories\System\DocumentResourceRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{

    /**
     * constructor.
     */
    protected $client_repo;
    public function __construct()
    {

        $this->client_repo = new ClientRepository();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        return view('cms.client.index');
    }

    /**
     *Open page for adding new Client
     */
    public function create()
    {
        return view('cms/client/create/create');
    }

    /**
     *Save new entry for Client
     * @param ClientRequest $request
     * @return
     */
    public function store(ClientRequest $request)
    {
            $input = $request->all();
            $client = $this->client_repo->store($input);
            return redirect()->route('cms.client.profile',['client' => $client->uuid])->withFlashSuccess(__('alert.general.created'));
    }


    /**
     *Quick add client from sales pages
     * @param AddClientModalRequest $request
     * @return
     */
    public function quickStoreFromSales(AddClientModalRequest $request)
    {
        $input = $request->all();
        $client = $this->client_repo->quickStoreFromSales($input);
        return redirect()->back()->withFlashSuccess(__('alert.general.created'));
    }


    /**
     *Open page for modifying existing Client
     * @param Client $client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Client $client)
    {

        $document_resource = $client->documents()->where('document_id', 1)->first();
        $document_resource_repo = new DocumentResourceRepository();
        $client_logo = isset($document_resource) ? $document_resource_repo->getDocFullPathUrl($document_resource->pivot->id) : '';
        return view('cms/client/edit/edit')->with('client', $client)
            ->with('client_logo',$client_logo);
    }

    /**
     *Modify existing Client
     * @param ClientRequest $request
     * @param Client $client
     * @return
     */
    public function update(ClientRequest $request, Client $client)
    {
        $input = $request->all();
        $client = $this->client_repo->update($client, $input);
        return redirect()->route('cms.client.profile',['client' => $client->uuid])->withFlashSuccess(__('alert.general.updated'));
    }

    /**
     *Overview page to display data of Client
     * @param Client $client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Client $client)
    {
        $document_resource = $client->documents()->where('document_id', 2)->first();
        $document_resource_repo = new DocumentResourceRepository();
        $client_logo = isset($document_resource) ? $document_resource_repo->getDocFullPathUrl($document_resource->pivot->id) : '';
        return view('cms/client/profile/profile')->with('client', $client)
            ->with('client_logo',$client_logo);
    }

    /**
     *Open page to display data of Client
     * @param Client $client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Client $client)
    {
        return view('operation/client/profile/profile')->with('client', $client);
    }

    /**
     *delete/destroy Client
     * @param Client $client
     * @return
     */
    public function delete(Client $client)
    {
        $client = $this->client_repo->delete($client);
        return redirect()->route('operation.client.index')->withFlashSuccess(__('alert.general.deleted'));
    }


    public function menu()
    {
        return view('operation.client.menu');
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * Get employees for select
     */
    public function getClientsForSelect()
    {
        $input = request()->all();
        return $this->client_repo->getClientsForSelect($input['q'], $input['page']);
    }






    /*change the status of a client*/
    public function changeStatus(Client $client)
    {
        $status = $client->isactive;
        switch ($status){
            case 1;
                $this->client_repo->changeStatus($client,0);
                return redirect()->back()->withFlashSuccess(trans('alert.general.deactivated'));
                break;

            case 0:
                $this->client_repo->changeStatus($client,1);
                return redirect()->back()->withFlashSuccess(trans('alert.general.activated'));
                break;
            default :
                return redirect()->back();

                break;

        }
    }


    /**
     *list all Client
     */
    public function getAllForDt()
    {
        $result_list = $this->client_repo->getAllForDt();
        return DataTables::of($result_list)
            ->addIndexColumn()

            ->addColumn('region', function ($tasks)
            {
                return isset($tasks->region_id)?$tasks->region:'';
            })

            ->rawColumns(['client_type', 'actions','region','max_loan'])
            ->make(true);
    }

}
