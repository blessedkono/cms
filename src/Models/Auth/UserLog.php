<?php

namespace App\Models\Auth;

use App\Models\Auth\Attribute\UserLogAttribute;
use App\Models\Auth\Relationship\UserLogRelationship;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use UserLogAttribute, UserLogRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
