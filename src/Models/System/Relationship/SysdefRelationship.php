<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 8/30/19
 * Time: 11:30 AM
 */

namespace App\Models\System\Relationship;


use App\Models\Sysdef\SysdefGroup;
use App\Models\System\Region;

trait SysdefRelationship
{

    public function sysdefGroup()
    {
        return $this->belongsTo(SysdefGroup::class);
    }
}
