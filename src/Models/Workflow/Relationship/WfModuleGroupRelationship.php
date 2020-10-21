<?php

namespace App\Models\Workflow\Relationship;

use App\Models\Workflow\WfGroupCategory;
use App\Models\Workflow\WfModule;
use App\Models\Workflow\WfDefinition;

trait WfModuleGroupRelationship
{

    /**
     * return @mixed
     */
    public function modules(){
        return $this->hasMany(WfModule::class)->orderBy("isactive", "desc")->orderBy('name', 'asc');
    }

    /**
     * return @mixed
     */
    public function wfDefinitions(){
        return $this->hasManyThrough(WfDefinition::class,WfModule::class);
    }

    /*Group category*/
    public function wfGroupCategory(){
        return $this->belongsTo(WfGroupCategory::class);
    }

}