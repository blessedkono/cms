<?php


namespace Nextbyte\Cms\Models;


use App\Models\BaseModel\BaseModel;
use App\Models\Cms\Traits\Relationships\TestimonialRelationship;

class Testimonial extends BaseModel
{
    use TestimonialRelationship;
    protected $guarded = [];
}
