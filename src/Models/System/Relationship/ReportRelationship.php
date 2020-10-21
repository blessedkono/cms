<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 8/5/19
 * Time: 10:43 AM
 */

namespace App\Models\System\Relationship;

use App\Models\System\District;
use App\Models\System\ReportGroup;
use App\Models\System\ReportType;


trait ReportRelationship
{

    /*RELATIONSHIP-------*/

    public function reportType(){
        return $this->belongsTo(ReportType::class);
    }

    public function reportGroup(){
        return $this->belongsTo(ReportGroup::class);
    }

    /*report groups*/
    public function reportGroups()
    {
        return $this->belongsToMany(ReportGroup::class, "report_group_report")->withTimestamps();
    }
}
