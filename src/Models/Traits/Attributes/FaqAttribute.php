<?php
/**
 * Created by PhpStorm.
 * User: dontito
 * Date: 12/17/18
 * Time: 5:51 PM
 */

namespace App\Models\Cms\Traits\Attributes;


trait FaqAttribute
{





    public function getDeleteButtonAttribute(){
        return link_to_route('cms.faq.delete',  __('buttons.general.crud.delete'), [$this->uuid], ['data-method' => 'delete', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.warning'), 'data-trans-text' => trans('alert.information.news.warning.delete'), 'class' => 'btn btn-danger btn-xs']);
    }

    public function getEditButtonAttribute()
    {
        return link_to_route('cms.faq.edit', __('buttons.general.crud.edit'), [$this->uuid], ['class' => 'btn btn-warning btn-xs']);
    }

        public function getDeleteFaqAttribute(){
            return link_to_route('cms.faq.delete',  __('label.crud.delete'), [$this->uuid], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.crud.delete') , 'data-trans-text' =>trans('alert.system.faq.warning.delete') , 'class' => 'btn btn-warning btn-xs']);
        }

}
