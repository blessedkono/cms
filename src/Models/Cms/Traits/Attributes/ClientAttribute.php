<?php


namespace App\Models\Cms\Traits\Attributes;


use App\Models\System\Region;
use App\Repositories\System\DocumentResourceRepository;

trait ClientAttribute
{




    public function getClientLogoAttribute()
    {
        $document_resource = $this->documents()->where('document_id', 2)->first();
        $document_resource_repo = new DocumentResourceRepository();
        $client_logo = isset($document_resource) ? $document_resource_repo->getDocFullPathUrl($document_resource->pivot->id) : '';
        return $client_logo;
    }


    public function getClientTypeLabelAttribute(){
        switch ($this->iscompany){
            case 1;
                return "<span class='badge badge-pill badge-info' data-toggle='tooltip' data-html='true' title='" . trans('label.company') . "'>" .  trans('label.company') .  "</span>";
                break;
            case 0;
                return "<span class='badge badge-pill badge-primary' data-toggle='tooltip' data-html='true' title='" . trans('label.individual') . "'>" .  trans('label.individual') .  "</span>";
                break;

            default:

                break;

        }
    }


    /*Get client with external Id attribute*/
    public function getNameWithExternalIdAttribute()
    {
        $external_id = $this->external_id;
        if(isset($external_id)){
            return $this->name . ' - ' . $this->external_id;
        }else{
            return $this->name;
        }
    }


    /*Change status of a client*/
    public function getChangeStatusButtonAttribute()
    {

        if ($this->isactive == 1)
        {
            return link_to_route('operation.client.change_status',  trans('buttons.general.deactivate'), [$this->uuid], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('buttons.general.deactivate') , 'data-trans-text' => trans('alert.general.alert.deactivate'), 'class' => 'btn btn-info btn-xs award']);
        }else{
            return link_to_route('operation.client.change_status',  trans('buttons.general.activate'), [$this->uuid], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('buttons.general.activate') , 'data-trans-text' => trans('alert.general.alert.activate'), 'class' => 'btn btn-success btn-xs award']);
        }
    }





}
