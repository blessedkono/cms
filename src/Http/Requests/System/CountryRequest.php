<?php
namespace App\Http\Requests\System;

use App\Http\Requests\Request;
use App\Models\Sysdef\CodeValue;
use Illuminate\Validation\Rule;

class CountryRequest extends Request
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

        $input = $this->all();

        if($input['action_type'] == 1){
            /*When adding*/
            $basic = [
                'name' => 'required|max:191|unique:countries',
                'code' => 'required|max:8|unique:countries',
            ];
        }else{
            /*when editing*/
            $country_id = $input['country_id'];
            $basic =    [
                'name' => ['required','max:191',
                    Rule::unique('countries')->where(function ($query) use($country_id)  {
                        $query->where('id','<>', $country_id);
                    })
                ],

                'code' => ['required','max:8',
                    Rule::unique('countries')->where(function ($query) use($country_id)  {
                        $query->where('id','<>', $country_id);
                    })
                ],
            ];
        }

        return $basic;

    }
}
