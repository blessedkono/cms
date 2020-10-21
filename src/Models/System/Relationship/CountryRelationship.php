<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 8/5/19
 * Time: 10:56 AM
 */

namespace App\Models\System\Relationship;


use App\Models\System\Region;

trait CountryRelationship
{
    /*Regions*/
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}