<?php
namespace App\Http\Requests\Resource;

use App\Http\Requests\Request;
use App\Models\System\CodeValue;
use App\Repositories\Cms\ClientRepository;

class ClientRequest extends Request
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
        $action_type = $input['action_type'];
        $resource_id = isset($input['client_id']) ? $input['client_id'] : null;
        $this->checkIfExists($action_type, $input,$resource_id);
        switch ($action_type){
            case 1:
                /*When Adding*/
                $basic = [
                    'name' => 'required|max:191|unique:clients',
                    'tin' => 'nullable|max:191',
                    'phone' => 'required|phone:TZ|max:191',
                    'telephone' => 'nullable|phone:TZ|max:191',
                    'email' => 'nullable|email|max:191',
                    'web' => 'nullable|max:191',
                    'box_no' => 'nullable|numeric',
                    'address' => 'nullable|max:191',
                    'region' => 'nullable',
                    'contact_person_phone' => 'nullable|phone:TZ|max:191',
                    'client_logo' => 'nullable|image|mimetypes:image/jpeg,image/pjpeg,image/png,image/bmp,image/x-windows-bm,x-portable-bitmapp,image/gif,image/tiff|max:'. (max_file_size_upload_kb()),
                    'externa_id' => 'nullable|max:191',

                ];
                break;
            case 2:
                /*When Editing*/
                $basic = [
                    'name' => 'required|max:191',
                    'tin' => 'nullable|max:191',
                    'phone' => 'required|phone:TZ|max:191',
                    'telephone' => 'nullable|phone:TZ|max:191',
                    'email' => 'nullable|email|max:191',
                    'web' => 'nullable|max:191',
                    'box_no' => 'nullable|numeric',
                    'address' => 'nullable|max:191',
                    'region' => 'nullable',
                    'contact_person_phone' => 'nullable|phone:TZ|max:191',
//                    'company_logo' => 'nullable|max:3072|image|mimetypes:image/jpeg,image/pjpeg,image/png,image/bmp,image/x-windows-bm,x-portable-bitmapp,image/gif,image/tiff',
                    'client_logo' => 'nullable|image|mimetypes:image/jpeg,image/pjpeg,image/png,image/bmp,image/x-windows-bm,x-portable-bitmapp,image/gif,image/tiff|max:'. (max_file_size_upload_kb()),

                    'externa_id' => 'nullable|max:191',

                ];
                break;
        }
        return array_merge( $basic, $optional);
    }

    public function sanitize()
    {
        $input = $this->all();
        $input['tin'] = isset($input['tin']) ? str_replace("-", "", $input['tin']) : null;
        $input['email'] = isset($input['email']) ? strtolower(trim($input['email'])) : null;
        $input['name'] = isset($input['name']) ? proper_case_word($input['name']): null;
        $input['externa_id'] = isset($input['externa_id']) ? proper_case_word(remove_extra_white_spaces($input['externa_id'])) : null;
        $this->replace($input);
        return $this->all();
    }


    /*check if exists*/
    public function checkIfExists($action_type,$input, $resource_id = null)
    {
        $where_input = [ 'name' => $input['name']];
        (new ClientRepository())->checkIfExistsGeneral($action_type, $where_input, $resource_id);
    }


}
