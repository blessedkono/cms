<?php

namespace App\Models\Workflow\Attribute;

use App\Repositories\Workflow\WfDefinitionRepository;
use App\Repositories\Workflow\WfTrackRepository;
use App\Services\Workflow\Workflow;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

trait WfTrackAttribute
{

    public function getStatusNarrationBadgeAttribute()
    {
        $bagde = "";
        if ($this->status == 0) {
            $bagde = "<span class='badge badge-warning' style='font-size: 12px'>Pending</span>";
        } elseif ($this->status == 1) {
            $bagde = "<span class='badge badge-success' style='font-size: 12px'>".$this->wfDefinition->action_description."</span>";
        } else {
            $bagde = "<span class='badge badge-danger' style='font-size: 12px'>Rejected</span>";
        }
        return $bagde;
    }


    public function status()
    {
        return $this->status;
    }


    public function getReceiveDateFormattedAttribute()
    {
        return  Carbon::parse($this->receive_date)->format('d-M-Y g:i:s A');
    }

    public function getForwardDateFormattedAttribute()
    {
        $return = "";
        if (!is_null($this->forward_date)) {
            $return = Carbon::parse($this->forward_date)->format('d-M-Y g:i:s A');
        } else {
            $return = "-";
        }
        return $return;
    }

    public function getAssignStatusAttribute()
    {
        $return = "";
        if ($this->assigned) {
            //assigned
            $return = "<span class='badge badge-success white_color'>" . trans('label.assigned') . "</span>";
        } else {
            $return = "<span class='badge badge-info white_color'>" . trans('label.not_assigned') . "</span>";
        }
        return $return;
    }


    public function getAgingDays()
    {
        $wf_date = Carbon::parse($this->receive_date);
        $forward_date = Carbon::parse($this->forward_date);
        return $wf_date->diffInDays($forward_date);
    }


    public function getAgingDaysPendingLevel()
    {
        $wf_date = Carbon::parse($this->receive_date);
        $today = Carbon::parse('now');
        return $wf_date->diffInDays($today);
    }

    public function getUsernameFormattedAttribute()
    {

        if ($this->wfDefinition->designation->id == 7) {
            $return = "<span class='badge badge-success'><b>Company</b></span>";
        }else {
            $user_name = (isset($this->user_id)) ? (isset($this->users->staff) ? (' - ' . $this->users->staff->full_name) : '') : '';

            $return = "<span class='badge badge-success'><b>" . $this->wfDefinition->designation->name . "</b>  </span>  $user_name <br/><span class=''>" . $this->wfDefinition->designation->name . " - " . $this->wfDefinition->unit->name . "</span>";

        }
        return $return;
    }

    public function getUsernameCompletedFormattedAttribute()
    {
        $return = "";
        $return = "<b>" . $this->user->username . "</b>&nbsp;&nbsp;<span class=''>" . $this->wfDefinition->designation->name . " - " . $this->wfDefinition->unit->name . "</span>";
        return $return;
    }

    public function getUserDetailsAttribute()
    {
        return $this->user->username;
    }

    public function getCompanyDetailsAttribute()
    {
        return $this->application()->first()->company->name. "<br> TIN :".$this->application()->first()->company->tin_number;
    }

    public function getActionButtonAttribute()
    {
        $button = "";
        if ($this->status == 0 && $this->assigned == 0) {
            $button = $this->getAssignButtonAttribute();
        } elseif ($this->status == 0 && $this->assigned == 1 && $this->user_id == access()->id()) {
            $button = "Assigned";
        } else {
            return "assigned";
        }
        return $button;
    }

    public function getAssignButtonAttribute(){
        return link_to_route('workflow.assign.task',  __('label.self_assign'), [$this->id], ['data-method' => 'post', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.pvoc_apps'), 'data-trans-text' => trans('label.are_you_sure'), 'class' => 'btn btn-default']);
    }

    public function getAcceptButtonAttribute(){
        return link_to_route('staff.pvoc.acceptance',  __('label.receive'), [$this->uuid,'levelOne','Received'], ['data-method' => 'post', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.pvoc_apps'), 'data-trans-text' => trans('label.pvoc_conf'), 'class' => 'btn btn-success ']);
    }

    public function getApprovalButtonAttribute()
    {
        return "<a href='#exampleModalCenter' class='btn btn-success' data-toggle='modal' id='approve_modal'>
        Actions
        </a>";
    }

    public function getSelectButtonAttribute()
    {
        return "<a href='#' class='btn btn-success' data-toggle='modal' id='staff_modal'>Select Officer to Assign</a>";
    }

    public function getRejectButtonAttribute(){
        return link_to_route('staff.pvoc.rejection.form',  __('label.reject'), [$this->uuid], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.shortlist'), 'data-trans-text' => trans('alert.business.application.warning.shortlist'), 'class' => 'btn btn-danger ']);
    }

    public function getAssignTaskButtonAttribute(){
        return link_to_route('staff.pvoc.assign.officer',  __('label.assign_task'), [$this->uuid], ['data-method' => 'get', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.pvoc_apps'), 'data-trans-text' => trans('label.pvoc_conf'), 'class' => 'btn btn-warning']);
    }

    public function getEndoseButtonAttribute(){
        return link_to_route('staff.officer.application.endose',  __('label.endose'), [$this->uuid,'levelThree','Endosed'], ['data-method' => 'post', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.pvoc_apps'), 'data-trans-text' => trans('label.pvoc_conf'), 'class' => 'btn btn-success ']);
    }

    public function getApproveButtonAttribute(){
        return link_to_route('staff.application.approve',  __('label.approve'), [$this->uuid,'levelThree','Endosed'], ['data-method' => 'post', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.pvoc_apps'), 'data-trans-text' => trans('label.pvoc_conf'), 'class' => 'btn btn-success ']);
    }


    /**
     *
     * Check if user has access rights to process current workflow track
     */
    public function checkIfHasRightCurrentWfTrackAction()
    {
        $workflow = new Workflow(['wf_module_id' => $this->wfDefinition->wfModule->id, 'resource_id' => $this->resource_id]);
        $userAccess = $workflow->userHasAccess(access()->id(), $workflow->currentLevel());
        $hasparticipated = $workflow->hasParticipated();

        if(($userAccess) && (!$hasparticipated)){
            return true;
        }else{
            return false;
        }
    }

    /*Getting Previous Comment*/
    public function getCommentAttribute()
    {
        return (new WfTrackRepository())->find($this->parent_id)->comments;
    }


}
