<?php

namespace App\Models\Workflow\Relationship;

use App\Models\Application\Application;
use App\Models\Auth\User;
use App\Models\Member\Company\Company;
use App\Models\Workflow\WfDefinition;

trait WfTrackRelationship
{

    public function wfDefinition()
    {
        return $this->belongsTo(WfDefinition::class);
    }

    public function user()
    {
        return $this->morphTo();
    }

    /*public function resource()
    {
        return $this->morphTo()->withoutGlobalScopes();
    }*/



    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function resource()
    {
        return $this->morphTo()->withoutGlobalScopes();
    }
}
