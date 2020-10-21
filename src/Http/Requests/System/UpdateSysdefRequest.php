<?php
namespace App\Http\Requests\System;

use App\Http\Requests\Request;

class UpdateSysdefRequest extends Request
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
        $data_type = $input['data_type'];
        $array =[];
        switch($data_type){
            case 'integer':
                $basic =[
                    'sysdef_value' => 'required|numeric|min:1'
                ];
                break;
            case 'smallInteger':
                $basic =[
                    'sysdef_value' => 'required|numeric|min:1'
                ];
                break;
            case 'numeric':
                $basic =[
                    'sysdef_value' => 'required|numeric|min:0'
                ];
                break;
            case 'text':
                $basic =[
                    'sysdef_value' => 'required|string',
                ];
                break;
            case 'string':
                $basic =[
                    'sysdef_value' => 'required|string',
                ];
                break;
            default:
                $basic =[
                    'sysdef_value' => 'required|string',
                ];
                break;
        }
        return array_merge($basic);
    }
}