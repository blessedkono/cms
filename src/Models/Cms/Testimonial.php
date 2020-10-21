<?php


namespace App\Models\Cms;


use App\Models\BaseModel\BaseModel;
use App\Models\Cms\Traits\Relationships\TestimonialRelationship;

class Testimonial extends BaseModel
{
    use TestimonialRelationship;
    protected $guarded = [];
}
