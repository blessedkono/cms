<?php
namespace App\Http\Requests\System;

use App\Http\Requests\Request;
use App\Models\System\CodeValue;

class CodeValueRequest extends Request
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
        $code_values = CodeValue::query()->where('name', $this->get('code_name'))->first();

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'code_name' => 'required|unique:code_values,name',
                        'code_name_sw' => 'required',
                        'status' => 'required',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'code_name' => 'required|unique:code_values,name,'.$code_values->id,
                        'code_name_sw' => 'required',
                        'status' => 'required',
                    ];
                }
            default:break;
        }
    }
}
