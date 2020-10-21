<?php

namespace App\Models\System;

use App\Models\System\Attribute\DocumentGroupAttribute;
use App\Models\System\Relationship\DocumentGroupRelationship;
use Illuminate\Database\Eloquent\Model;

class DocumentGroup extends Model
{
    use DocumentGroupAttribute, DocumentGroupRelationship;


}
