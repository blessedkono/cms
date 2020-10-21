<?php
namespace App\Http\Requests\Report;

use App\Http\Requests\Request;
use App\Models\System\CodeValue;
use Illuminate\Validation\Rule;


class ReportDateFilterRequest extends Request
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
    public function Rules()
    {
        $input = $this->all();
        $basic = [];
        $optional = [];
        $array = [];

        $basic = [
            /*1.Date range*/
            'from_date' => 'sometimes|required|date|date_format:Y-n-j',
            'to_date' => 'sometimes|required|date|date_format:Y-n-j|after_or_equal:from_date',

            /*2 Monthly*/
            'search_month' => 'sometimes|required',
            'search_year' => 'sometimes|required',

            /*3. Search date*/
            'search_date' => 'sometimes|required|date|date_format:Y-n-j',


        ];
        return array_merge( $basic, $optional);
    }



    public function sanitize()
    {
        $input = $this->all();

        $input['from_date'] = isset($input['from_date']) ? standard_date_format($input['from_date']) : null;
        $input['to_date'] = isset($input['to_date']) ? standard_date_format($input['to_date']) : null;
        $input['search_date'] = isset($input['search_date']) ? standard_date_format($input['search_date']) : null;

        $this->replace($input);
        return $this->all();
    }


}
