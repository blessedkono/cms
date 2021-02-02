<?php


namespace Nextbyte\Cms\Http\Controllers\Cms;


use App\Models\BaseModel\BaseModel;
use App\Models\Cms\Traits\Attributes\FaqAttribute;
use App\Models\Cms\Traits\Relationships\FaqRelationship;
use Illuminate\Database\Eloquent\Model;

class Faq extends BaseModel
{
//    use FaqAttribute,FaqRelationship;
    protected $guarded = [];
}
