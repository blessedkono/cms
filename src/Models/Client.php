<?php


namespace Nextbyte\Cms\Models;


use App\Models\BaseModel\BaseModel;
use App\Models\Cms\Traits\Attributes\ClientAttribute;
use App\Models\Cms\Traits\Relationships\ClientRelationship;


class Client extends BaseModel
{
    use ClientAttribute,ClientRelationship;
    protected $guarded = [];
}
