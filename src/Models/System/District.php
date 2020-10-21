<?php

namespace App\Models\System;

use App\Models\System\Attribute\DistrictAttribute;
use App\Models\System\Relationship\DistrictRelationship;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use DistrictAttribute, DistrictRelationship;

    protected $guarded = [];
}
