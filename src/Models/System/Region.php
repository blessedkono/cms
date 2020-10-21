<?php

namespace App\Models\System;

use App\Models\System\Traits\Attribute\RegionAttribute;
use App\Models\System\Traits\Relationship\RegionRelationship;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use RegionAttribute, RegionRelationship;

    protected $guarded = [];
}
