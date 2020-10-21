<?php


namespace App\Repositories\System;


use App\Models\System\NewsletterSubscription;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class SubscriptionRepository extends BaseRepository
{
    const MODEL =NewsletterSubscription::class;



    public function store(array $input)
    {
        return  DB :: transaction(function() use ($input){
            $event = $this->query()->firstOrCreate([
                'email' =>$input['email'] ,
            ]);
            return $event;
        });
    }

}
