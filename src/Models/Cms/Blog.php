<?php


namespace App\Models\Cms;


use App\Models\BaseModel\BaseModel;
use App\Models\Cms\Traits\Attributes\BlogAttribute;
use App\Models\Cms\Traits\Relationships\BlogRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends BaseModel
{
    use SoftDeletes,BlogRelationship,BlogAttribute;

    protected $guarded = [];
}
