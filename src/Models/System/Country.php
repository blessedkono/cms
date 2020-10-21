<?php

namespace App\Models\System;

use App\Models\System\Attribute\CountryAttribute;
use App\Models\System\Relationship\CountryRelationship;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use  CountryAttribute, CountryRelationship;

    protected $guarded = [];

}
