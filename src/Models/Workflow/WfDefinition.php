<?php

namespace App\Models\Workflow;

use App\Models\Workflow\Attribute\WfDefinitionAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Workflow\Relationship\WfDefinitionRelationship;

class WfDefinition extends Model
{
    use WfDefinitionRelationship, WfDefinitionAccess, WfDefinitionAttribute;

}