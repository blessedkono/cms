<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 8/5/19
 * Time: 10:43 AM
 */

namespace App\Models\System\Traits\Attribute;


trait RegionAttribute
{




    public function getEditButtonAttribute()
    {

        return link_to_route('country.edit_region',  __('buttons.general.crud.edit'), [$this->hasc], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('buttons.general.crud.delete') , 'data-trans-text' => trans('buttons.general.crud.delete'), 'class' => 'btn btn-primary btn-xs award']);
    }

    public function getDeleteButtonAttribute()
    {

        return link_to_route('country.delete_region',  __('buttons.general.crud.delete'), [$this], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('buttons.general.crud.delete') , 'data-trans-text' => trans('buttons.general.crud.delete'), 'class' => 'btn btn-danger btn-xs award']);
    }

    public function getDeactivateButtonAttribute()
    {


    }

    public function getActivateButtonAttribute()
    {

        if ($this->isactive == 1)
        {
            return link_to_route('country.deactivate_region',  trans('buttons.general.deactivate'), [$this->hasc], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('buttons.general.crud.delete') , 'data-trans-text' => trans('buttons.general.crud.delete'), 'class' => 'btn btn-danger btn-xs award']);
        }else
        {
            return link_to_route('country.activate_region',  trans('buttons.general.activate'), [$this->hasc], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('buttons.general.crud.delete') , 'data-trans-text' => trans('buttons.general.crud.delete'), 'class' => 'btn btn-success btn-xs award']);
        }

    }

    public function getActionsButtonAttribute()
    {

        return  $this->getEditButtonAttribute(). $this->getActivateButtonAttribute();
    }

}