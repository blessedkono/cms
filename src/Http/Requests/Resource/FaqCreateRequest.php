<?php
namespace App\Http\Requests\Resource;

use App\Http\Requests\Request;

class FaqCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = request()->all();
        $optional = [];
        $array =[];

        $basic = [
            'title' => 'required|max:150',
            'content'=>'required',
        ];

        /*Option service type*/
        if(array_key_exists('service_type', $input)){
            $array = [
                'service_type' => 'required',
            ];
            $optional = array_merge($array, $optional);
        }

        return array_merge($basic, $optional);

    }
}
