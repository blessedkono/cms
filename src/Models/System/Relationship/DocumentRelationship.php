<?php

namespace App\Models\System\Relationship;

use App\Models\System\DocumentGroup;

trait DocumentRelationship
{

    /*Document group*/
    public function documentGroup()
    {
        return $this->belongsTo(DocumentGroup::class);
    }

}