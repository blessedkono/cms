<?php
namespace App\Http\Requests\Resource;

use App\Http\Requests\Request;
use App\Models\System\CodeValue;
use App\Repositories\Cms\ClientRepository;

class BlogRequest extends Request
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
        $action_type = $input['action_type'];
        switch ($action_type){
            case 1:
                /*When Adding*/
                $basic = [
                    'title' => 'required',
                    'content' => 'required',
                    'blog_categories' => 'nullable',
                    'publish_date' => 'nullable',
                    'publish_time' => 'nullable',
                    'isscheduled' => 'nullable',
                    'isactive' => 'nullable',
                ];
                break;
            case 2:
                /*When Editing*/
                $basic = [
                    'title' => 'required',
                    'content' => 'required',
                    'blog_categories' => 'nullable',
                    'publish_date' => 'nullable',
                    'publish_time' => 'nullable',
                    'isscheduled' => 'nullable',
                    'isactive' => 'nullable',

                ];
                break;
        }
        return array_merge( $basic, $optional);
    }




}
