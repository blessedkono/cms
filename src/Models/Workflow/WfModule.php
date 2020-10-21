<?php

namespace App\Models\Workflow;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Workflow\Relationship\WfModuleRelationship;

class WfModule extends Model
{
    use WfModuleRelationship;

}