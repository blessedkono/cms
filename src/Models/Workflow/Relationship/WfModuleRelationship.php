<?php

namespace App\Models\Workflow\Relationship;

use App\Models\Workflow\WfDefinition;
use App\Models\Workflow\WfModuleGroup;

trait WfModuleRelationship
{

    /**
     * return @mixed
     */
    public function definitions(){
        return $this->hasMany(WfDefinition::class)->orderBy('level', 'asc');
    }

    public function wfModuleGroup() {
        return $this->belongsTo(WfModuleGroup::class);
    }

}