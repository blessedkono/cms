<?php

namespace App\Models\Workflow\Relationship;



use App\Models\Sysdef\Designation;
use App\Models\Sysdef\Unit;
use App\Models\Workflow\WfModule;
use App\Models\Auth\User;


/**
 * Class WfDefinitionRelationship
 * @package App\Models\Workflow\Relationship
 */
trait WfDefinitionRelationship
{
    /**
     * @return mixed
     */
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    /**
     * @return mixed
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * @return mixed
     */
    public function wfModule()
    {
        return $this->belongsTo(WfModule::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class/*,'user_wf_definition','user_id','id'*/)->withTimestamps();
    }




}
