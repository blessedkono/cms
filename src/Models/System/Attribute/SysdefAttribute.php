<?php
namespace App\Models\System\Attribute;

trait SysdefAttribute
{
    /**
     * edit button for sysdef
     * @return string
     */
    public function getEditButtonAttribute() {
        return '<a href="' . route('sysdef.edit', $this->id) . '"  class="btn btn-xs btn-primary" ><i class="icon fa fa-edit" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i>'.' '. trans('buttons.general.crud.edit').'</a> ';
    }
}
