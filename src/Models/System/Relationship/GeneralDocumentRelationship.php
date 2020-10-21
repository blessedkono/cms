<?php

namespace App\Models\System\Relationship;

use App\Models\System\Document;
use App\Models\System\DocumentGroup;

trait GeneralDocumentRelationship
{

    /*Relation to documents - Many to Many*/
    public function documents(){
        return $this->morphToMany(Document::class, 'resource', 'document_resource')->withPivot('id','name', 'description', 'ext', 'size', 'mime');
    }


}