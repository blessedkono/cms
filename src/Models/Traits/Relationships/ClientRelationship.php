<?php


namespace App\Models\Cms\Traits\Relationships;



use App\Models\Cms\Testimonial;
use App\Models\System\Document;
use App\Models\System\Region;

trait ClientRelationship
{


    public function region()
    {
        return $this->belongsTo(Region::class);
    }



    public function documents(){
        return $this->morphToMany(Document::class, 'resource', 'document_resource')->withPivot('id','name', 'description', 'ext', 'size', 'mime','isactive');
    }

    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }
}
