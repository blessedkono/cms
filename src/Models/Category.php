<?php


namespace Nextbyte\Cms\Models;


use App\Models\Cms\Traits\Attributes\BlogCategoryAttribute;
use App\Models\Cms\Traits\Relationships\BlogCategoryRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use  SoftDeletes,BlogCategoryRelationship,BlogCategoryAttribute;

    protected $guarded = [];
}
