<?php
/**
 * Created by PhpStorm.
 * User: reubenwedson
 * Date: 9/4/19
 * Time: 3:44 PM
 */

namespace App\Models\System\Attribute;


trait CurrencyAttribute
{
    public function getViewButtonAttribute()
    {
        return '<a href="' . route('currency.view',$this->id) . '" class="btn btn-xs btn-warning" > ' . trans('buttons.general.view') . '</a> ';
    }

    public function getEditButtonAttribute()
    {
        return '<a href="' . route('currency.edit',$this->id) . '" class="btn btn-xs btn-info" >' . trans('buttons.general.crud.edit') . '</a> ';
    }

    public function getActionButtonsAttribute()
    {
        return $this->getViewButtonAttribute().' '. $this->getEditButtonAttribute();
    }
}