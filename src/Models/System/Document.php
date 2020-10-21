<?php

namespace App\Models\System;

use App\Models\System\Attribute\DocumentAttribute;
use App\Models\System\Relationship\DocumentRelationship;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use DocumentAttribute, DocumentRelationship;

}
