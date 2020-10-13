<?php


namespace App\Models\Cms\Traits\Relationships;


use App\Models\Cms\Category;

trait BlogRelationship
{

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
