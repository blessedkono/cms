<?php


namespace App\Http\Controllers\Cms;


use App\Http\Requests\Request;

class ModulefunctionalPartRequest extends Request
{
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
                    'images' => 'nullable|image|mimetypes:image/jpeg,image/pjpeg,image/png,image/bmp,image/x-windows-bm,x-portable-bitmapp,image/gif,image/tiff',
                    'title' => 'required',
                    'description' => 'nullable',
                    'isactive' => 'nullable',
                    'navigation_link' => 'required',

                ];
                break;
            case 2:
                /*When Editing*/
                $basic = [
                    'images' => 'nullable|image|mimetypes:image/jpeg,image/pjpeg,image/png,image/bmp,image/x-windows-bm,x-portable-bitmapp,image/gif,image/tiff',
                    'title' => 'required',
                    'isactive' => 'nullable',
                    'description' => 'nullable',
                    'navigation_link' => 'required',

                ];
                break;
        }
        return array_merge( $basic, $optional);
    }


}
