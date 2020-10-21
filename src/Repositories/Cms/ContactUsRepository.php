<?php
/**
 * Created by PhpStorm.
 * User: dontito
 * Date: 1/17/19
 * Time: 2:25 PM
 */

namespace App\Repositories\Cms;


use App\Models\Auth\User;
use App\Models\Cms\Inquiry;
use App\Notifications\Auth\UserNeedsConfirmation;
use App\Notifications\Cms\ContactUsNotification;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ContactUsRepository extends BaseRepository
{
    public function __construct()
    {

    }


    //store
    public function store(array $inputs)
    {
        DB::transaction(function ()use($inputs){
           $inquiry = Inquiry::query()->create([
               'name'=>$inputs['name'],
               'email'=>$inputs['email'],
               'subject'=>$inputs['subject'],
               'message'=>$inputs['message'],
           ]);

           return $inquiry;
        });

    }

    public function sendContactUsNotification($request)
    {
        $inputs = $request->all();
        $this->store($inputs);

        $variable =  (new User())->forceFill([
            'name'=>$request->get('name'),
            'user_email'=>$request->get('email'),
            'subject'=>$request->get('subject'),
            'email'=>'francistito07@gmail.com',
            'message'=>$request->get('message'),

        ]);
        $variable->notify(new ContactUsNotification($inputs));

    }


}
