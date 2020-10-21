<?php


namespace App\Http\Requests\Resource;


use App\Http\Requests\Request;

class ClientTestimonialRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function Rules()
    {
        $input = $this->all();
        $basic = [];
        $optional = [];
        $array = [];
        $action_type = $input['action_type'];
        switch ($action_type){
            case 1:
                /*When Adding*/
                $basic = [
                    'client_id' => 'required',
                    'designation_id' => 'required',

                ];
                break;
            case 2:
                /*When Editing*/
                $basic = [
                    'client_id' => 'required',
                    'designation_id' => 'required',
                ];
                break;
        }
        return array_merge( $basic, $optional);
    }

    public function sanitize()
    {

    }

}
