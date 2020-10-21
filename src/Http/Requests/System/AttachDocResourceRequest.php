<?php
namespace App\Http\Requests\System;

use App\Http\Requests\Request;
use App\Models\Sysdef\CodeValue;
use Illuminate\Validation\Rule;

class AttachDocResourceRequest extends Request
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
        $optional = [];
        $array = [];
        $basic = [];
        $add = [];
        $edit = [];
        $action_type = $input['action_type'];
        $document_validation = $this->documentValidation($input);

        if($action_type == 1){
            /*When adding*/
            $add =  [
                'document_id' => 'required'
            ];

        }elseif($action_type == 2){
            /*edit*/

        }


        return array_merge($basic,$add, $edit, $optional, $document_validation);

    }



    public function messages()
    {
        return [
            'document_file.mimetypes' => 'Attach only allowed format!',
            'document_file.mimes' => 'Attach only allowed format!',
            'document_file.file' => 'Upload a valid file',
        ];
    }

    /**
     * @return array
     */
    public function sanitize()
    {
        /*Sanitize*/
        $input = $this->all();

        /*Sanitize here*/

        $this->replace($input);
        return $this->all();

    }


    /*Validate doc format*/
    public function documentValidation(array $input)
    {
        $document_validate = [];
        $extension_rules = null;
        $format_rules = null;
        $allowed_exts = unserialize($input['allowed_exts']);
        $allowed_formats = unserialize($input['allowed_formats']);//ms-word, pdf, excel, image

        /*Validate using extensions*/
        if(($allowed_exts)){

            $extension_rules = 'mimes:';
            /*Extensions have been specified*/
            foreach($allowed_exts as $ext){
                $extension_rules  = $extension_rules . $ext . ',';
            }
            $extension_rules = substr($extension_rules, 0, -1);
        }

        /*Validate using formats*/
        if(($allowed_formats)){
            $format_rules = 'mimetypes:';
            /*formats have been specified*/
            foreach($allowed_formats as $format){

                $validation_rule = $this->validationDocFormatRules($format);

                $format_rules  = $format_rules . $validation_rule . ',';
            }
            $format_rules = substr($format_rules, 0, -1);
        }

        $document_validate = [
            'document_file' => [
                'required',
                'file',
                (($allowed_exts)) ? $extension_rules : $format_rules,
                'max:'. (max_file_size_upload_kb()),
            ]
        ];

        return $document_validate;

    }


    public function validationDocFormatRules($format = null)
    {

        switch($format){

            case 'msword':
                return 'application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.wordprocessingml.template,application/vnd.ms-word.document.macroEnabled.12,application/vnd.ms-word.template.macroEnabled.12';
                break;

            case 'excel':
                return 'application/excel,application/x-excel,application/x-msexcel,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.spreadsheetml.template,application/vnd.ms-excel.sheet.macroEnabled.12,application/vnd.ms-excel.template.macroEnabled.12,application/vnd.ms-excel.addin.macroEnabled.12,application/vnd.ms-excel.sheet.binary.macroEnabled.12,application/octet-stream';
                break;

            case 'pdf':
                return 'application/pdf';
                break;

            case 'image':
                return 'mimetypes:application/pdf,image/png,image/tiff,image/x-tiff,image/bmp,image/x-windows-bmp,image/gif,image/x-icon,image/jpeg,image/pjpeg,image/x-portable-bitmap';
                break;

            default:
                return 'mimetypes:application/excel,application/x-excel,application/x-msexcel,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.spreadsheetml.template,application/vnd.ms-excel.sheet.macroEnabled.12,application/vnd.ms-excel.template.macroEnabled.12,application/vnd.ms-excel.addin.macroEnabled.12,application/vnd.ms-excel.sheet.binary.macroEnabled.12,application/octet-stream, application/pdf,image/png,image/tiff,image/x-tiff,image/bmp,image/x-windows-bmp,image/gif,image/x-icon,image/jpeg,image/pjpeg,image/x-portable-bitmap,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.wordprocessingml.template,application/vnd.ms-word.document.macroEnabled.12,application/vnd.ms-word.template.macroEnabled.12';
                break;
        }


    }

}
