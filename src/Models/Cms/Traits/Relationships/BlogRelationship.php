<?php


namespace App\Models\Cms\Traits\Relationships;


use App\Models\Auth\User;
use App\Models\Cms\Category;
use App\Models\System\Document;

trait BlogRelationship
{

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }


    public function documents(){
        return $this->morphToMany(Document::class, 'resource', 'document_resource')->withPivot('id','name', 'description', 'ext', 'size', 'mime','isactive');
    }
}
