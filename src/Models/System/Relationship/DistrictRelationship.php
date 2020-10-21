<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 8/30/19
 * Time: 11:30 AM
 */

namespace App\Models\System\Relationship;


use App\Models\System\Region;

trait DistrictRelationship
{

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
