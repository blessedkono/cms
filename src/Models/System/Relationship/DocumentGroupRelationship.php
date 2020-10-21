<?php

namespace App\Models\System\Relationship;

use App\Models\System\Document;

trait DocumentGroupRelationship
{

    public function documents()
    {
        return $this->hasMany(Document::class)->where('isactive','=','1');
    }

}