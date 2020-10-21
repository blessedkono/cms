<?php
namespace App\Http\Requests\System;

use App\Http\Requests\Request;
use App\Models\Sysdef\CodeValue;
use Illuminate\Validation\Rule;

class RegionRequest extends Request
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
                'name' => 'required|max:191|unique:regions',
                'hasc' => 'required|max:8|unique:regions',
            ];
        }else{
            /*when editing*/
            $region_id = $input['region_id'];
            $basic =    [
                'name' => ['required','max:191',
                    Rule::unique('regions')->where(function ($query) use($region_id)  {
                        $query->where('id','<>', $region_id);
                    })
                ],
                'hasc' => ['required','max:8',
                    Rule::unique('regions')->where(function ($query) use($region_id)  {
                        $query->where('id','<>', $region_id);
                    })
                ],
            ];

        }

        return $basic;
    }
}
