<?php

namespace App\Models\System;

use App\Models\System\Attribute\ReportAttribute;
use App\Models\System\Relationship\ReportRelationship;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    use ReportRelationship, ReportAttribute;


}