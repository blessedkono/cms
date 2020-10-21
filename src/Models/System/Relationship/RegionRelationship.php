<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 8/5/19
 * Time: 10:43 AM
 */

namespace App\Models\System\Traits\Relationship;

use App\Models\System\District;
use App\Models\System\Zone;

trait RegionRelationship
{

    /*Districts*/
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
