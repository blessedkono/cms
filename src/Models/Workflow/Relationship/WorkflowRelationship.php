<?php

namespace App\Models\Workflow\Relationship;

use App\Models\Application\Application;
use App\Models\Auth\User;
use App\Models\Member\Company\Company;
use App\Models\Workflow\WfDefinition;
use App\Models\Workflow\WfTrack;

trait WorkflowRelationship
{

    //Relation to workflows
    public function wfTracks(){
        return $this->morphMany(WfTrack::class, 'resource');
    }


}
