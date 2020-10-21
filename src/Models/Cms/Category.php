<?php


namespace App\Models\Cms;


use App\Models\BaseModel\BaseModel;
use App\Models\Cms\Traits\Attributes\BlogCategoryAttribute;
use App\Models\Cms\Traits\Relationships\BlogCategoryRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModel
{
    use  SoftDeletes,BlogCategoryRelationship,BlogCategoryAttribute;

    protected $guarded = [];
}
