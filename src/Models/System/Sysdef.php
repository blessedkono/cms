<?php

namespace App\Models\System;

use App\Models\System\Attribute\SysdefAttribute;
use App\Models\System\Relationship\SysdefRelationship;
use Illuminate\Database\Eloquent\Model;


class Sysdef extends Model
{
    //
    use SysdefAttribute, SysdefRelationship;

    public $timestamps = false;

    protected $guarded = [];

}
