<?php


namespace App\Models\Cms\Traits\Attributes;


trait BlogCategoryAttribute
{

    public function getDeleteButtonAttribute(){
        return link_to_route('cms.category.delete',  __('buttons.general.crud.delete'), [$this->id], ['data-method' => 'delete', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.warning'), 'data-trans-text' => trans('alert.general.alert.delete'), 'class' => 'btn btn-danger btn-xs']);
    }

    public function getEditButtonAttribute(){
        return link_to_route('cms.category.edit', __('buttons.general.crud.edit'), [$this->id], ['class' => 'btn btn-warning btn-xs']);
    }

    public function getChangeStatusButtonAttribute()
    {

        if ($this->isactive == 1)
        {
            return link_to_route('cms.category.change_status',  trans('buttons.general.deactivate'), [$this->id], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('buttons.general.crud.delete') , 'data-trans-text' => trans('buttons.general.crud.delete'), 'class' => 'btn btn-info btn-xs award']);
        }else{
            return link_to_route('cms.category.change_status',  trans('buttons.general.activate'), [$this->id], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('buttons.general.crud.delete') , 'data-trans-text' => trans('buttons.general.crud.delete'), 'class' => 'btn btn-success btn-xs award']);
        }
    }


    public function getBlogCategoryStatusLabelAttribute()
    {
        switch ($this->isactive){
            case 0:
                return '<span class="badge badge-primary">'.trans('label.inactive'). '</span>';
                break;
            case 1;
                return '<span class="badge badge-success">'.trans('label.active'). '</span>';

                break;
                return '<span class="badge badge-primary">'.trans('label.deactive'). '</span>';
            default :

                break;
        }
    }
}
