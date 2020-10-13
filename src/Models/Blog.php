<?php


namespace Nextbyte\Cms\Models;


use App\Models\BaseModel\BaseModel;
use App\Models\Cms\Traits\Relationships\BlogRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends BaseModel
{
    use SoftDeletes,BlogRelationship;

    protected $guarded = [];
}
