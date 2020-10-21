<?php

namespace App\Models\Workflow;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Workflow\Attribute\WfTrackAttribute;
use App\Models\Workflow\Relationship\WfTrackRelationship;

class WfTrack extends Model
{
    use WfTrackAttribute, WfTrackRelationship, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
        'resource_id',
        'assigned',
        'parent_id',
        'wf_definition_id',
        'receive_date',
        'forward_date',
        'comments',
        'user_type',
        'source',
        'resource_type',
        'allocated',
    ];

}
