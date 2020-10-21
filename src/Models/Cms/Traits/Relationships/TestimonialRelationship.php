<?php


namespace App\Models\Cms\Traits\Relationships;


use App\Models\Cms\Client;
use App\Models\System\Designation;

trait TestimonialRelationship
{

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
