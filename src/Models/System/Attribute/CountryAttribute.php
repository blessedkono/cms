<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 8/5/19
 * Time: 10:55 AM
 */

namespace App\Models\System\Attribute;


trait CountryAttribute
{



    /*---------Attribute -------------*/

    /*Get Country flag*/
    public function getFlagAttribute()
    {
        //return "<span title='" . $this->name . "'>".@include('includes.country_flag' .',' . '[' . 'country_flag' . '=>' . $this->code . ']') . "</span>";
        return view('admin/system/includes/country_flag')->with(['country_code' => $this->code, 'country_name' => $this->name]);
    }

    public function getViewButtonAttribute()
    {

        return '<a href="' . route('country.profile',$this->code) . '" class="btn btn-xs btn-warning" > ' . trans('buttons.general.view') . '</a> ';
    }

    public function getEditButtonAttribute()
    {

        return '<a href="' . route('country.edit',$this->code) . '" class="btn btn-xs btn-info" >' . trans('buttons.general.crud.edit') . '</a> ';
    }

    public function getDeleteButtonAttribute()
    {

        return link_to_route('country.delete',  __('buttons.general.crud.delete'), [$this->code], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('buttons.general.crud.delete') , 'data-trans-text' => trans('buttons.general.crud.delete'), 'class' => 'btn btn-primary btn-xs award']);
    }

    public function getDeactivateButtonAttribute()
    {


    }

    public function getActivateButtonAttribute()
    {

        if ($this->isactive == 1)
        {
            return link_to_route('country.deactivate_country',  trans('buttons.general.deactivate'), [$this->code], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('buttons.general.crud.delete') , 'data-trans-text' => trans('buttons.general.crud.delete'), 'class' => 'btn btn-danger btn-xs award']);
        }else{
            return link_to_route('country.activate_country',  trans('buttons.general.activate'), [$this->code], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('buttons.general.crud.delete') , 'data-trans-text' => trans('buttons.general.crud.delete'), 'class' => 'btn btn-success btn-xs award']);
        }

    }

    public function getActionsButtonAttribute()
    {

        return $this->getViewButtonAttribute(). $this->getEditButtonAttribute() . $this->getActivateButtonAttribute();
    }


}