<?php

namespace App\Repositories\Cms;

use App\Models\Cms\Client;
use App\Models\System\Region;
use App\Notifications\Cms\SendTestimonialLinkNotification;
use App\Repositories\BaseRepository;
use App\Repositories\System\DocumentResourceRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClientRepository extends BaseRepository
{
    const MODEL = Client::class;

    public function __construct()
    {

    }




    /*Insert/create Client*/
    public function store(array $input)
    {
        return DB::transaction(function() use($input){
            $client = $this->query()->create([
                'name' => $input['name'],
                'tin' => $input['tin'],
                'phone' => isset($input['phone']) ? phone_make($input['phone'], 'TZ') : $input['phone'],
                'telephone' => isset($input['telephone']) ? phone_make($input['telephone'], 'TZ') : $input['telephone'],
                'email' => $input['email'],
                'web' => $input['web'],
                'box_no' => $input['box_no'],
                'address' => $input['address'],
                'region_id'=> $input['region'],
                'contact_person' => $input['contact_person'],
                'contact_person_phone' => isset($input['contact_person_phone']) ? phone_make($input['contact_person_phone'], 'TZ') : $input['contact_person_phone'],
                'iscompany' => isset($input['iscompany'])? $input['iscompany']:0,
                'note' => $input['note'],
//                'external_id' => $input['external_id'],
            ]);
            /*Save document(s) attached*/
            $this->saveDocuments($client->id,$input);

            /*Reconcile*/

            return $client;
        });
    }

    /*Modify Client*/
    public function update(Model $client, array $input)
    {

        return DB::transaction(function() use($client,$input){
            $client->update([
                'name' => $input['name'],
                'tin' => $input['tin'],
                'phone' => isset($input['phone']) ? phone_make($input['phone'], 'TZ') : $input['phone'],
                'telephone' => isset($input['telephone']) ? phone_make($input['telephone'], 'TZ') : $input['telephone'],
                'email' => $input['email'],
                'web' => $input['web'],
                'box_no' => $input['box_no'],
                'address' => $input['address'],
                'region_id' => $input['region'],
                'contact_person' => $input['contact_person'],
                'contact_person_phone' => isset($input['contact_person_phone']) ? phone_make($input['contact_person_phone'], 'TZ') : $input['contact_person_phone'],
                'iscompany' => isset($input['iscompany'])? $input['iscompany']:0,
                'note' => $input['note'],
//                'external_id' => $input['external_id'],
            ]);
            /*Save document(s) attached*/
            $this->saveDocuments($client->id,$input);
            return $client;
        });
    }

    /*QUick add client from sale pages*/
    public function quickStoreFromSales(array $input)
    {
        return DB::transaction(function() use($input){
            $client = $this->query()->create([
                'name' => $input['name'],
                'iscompany' => isset($input['iscompany']) ? $input['iscompany'] : 0,
                'external_id' => $input['external_id'],
                'phone' => isset($input['phone']) ? phone_make($input['phone'], 'TZ') : $input['phone'],
                'max_loan_limit' => $input['max_loan_limit'],
                'station_id' => $input['station_id'],
                'user_id' => access()->id(),
            ]);
            return $client;
        });
    }




    /*Destroy / remove Client*/
    public function delete(Model $client)
    {
        /*remove*/
        $client->delete();
    }


    /*Update balance*/
    public function updateBalance($client_id, $new_balance)
    {
        $client = $this->find($client_id);
        $client->update([
            'loan_balance' => $new_balance
        ]);
    }

    public function getClientForLoanReconcile()
    {
        return $this->query()->has('creditors')->get();
    }

    /*query all expense*/
    public function getQueryAllClients()
    {

        return $this->query()
            ->select([
                DB::raw('clients.id as id'),
                DB::raw('clients.name as name'),
                DB::raw('clients.tin as tin'),
                DB::raw('clients.phone as phone'),
                DB::raw('clients.telephone as telephone'),
                DB::raw('clients.email as email'),
                DB::raw('clients.web as web'),
                DB::raw('clients.box_no as box_no'),
                DB::raw('clients.address as address'),
//                DB::raw('clients.region_id as region_id'),
                DB::raw('clients.note as note'),
//                DB::raw('clients.user_id as user_id'),
                DB::raw('clients.uuid as uuid'),
//                DB::raw('users.username as username'),


            ]);
//            ->leftjoin('users', 'users.id', '=', 'clients.user_id')
//            ->leftjoin('regions', 'regions.id', '=', 'clients.region_id');

    }

    /*Get all for Datatable Client*/
    public function getAllForDt()
    {
        $query = $this->getQueryAllClients();
        return $query;
    }

    /*Save document(s) attached on the form*/
    public function saveDocuments($client_id, array $input)
    {
        $document_resource_repo = new DocumentResourceRepository();
        if((request()->file('client_logo'))){
            $document_resource_repo->saveDocument($client_id,2,'client_logo', $input);
        }

    }


    /*Get for select*/
    public function getClientsForSelect($q, $page)
    {
        $resultCount = 15;
        $offset = ($page - 1) * $resultCount;
        $data['items'] = $this->regexColumnSearch(['name' => $q])->limit($resultCount)->offset($offset)->get()->toArray();
        $data['total_count'] = count($data['items']);
        return response()->json($data);
    }


    //send link to client to fill testimonial
    public function sendTestimonialLink($url,$client)
    {
        $client->notify(new SendTestimonialLinkNotification($url));
    }

}
