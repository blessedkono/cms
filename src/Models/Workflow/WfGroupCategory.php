<?php

namespace App\Models\Workflow;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Workflow\Relationship\WfModuleGroupRelationship;

class WfGroupCategory extends Model
{
    use SoftDeletes;

}