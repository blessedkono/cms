<?php

namespace App\Repositories\System;


use App\Models\System\Document;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Models\Audit;

class AuditManageRepository extends BaseRepository
{


    public function getAudits()
    {
        return Audit::query();
    }

    /*Get audits for Datatable*/
    public function getForDt()
    {
        $input = request()->all();
        $audits = $this->getAudits();
        /*Audit type*/
        if(isset($input['auditable_type'])){
            $audits = $audits->where('auditable_type', $input['auditable_type']);
        }

        /*event */
        if(isset($input['event'])){
            $audits = $audits->where('event', $input['event']);
        }
        return $audits;
    }


    /*Get AudiTables for select*/
    public function getAuditablesForSelect()
    {
        $auditables = Audit::query()->groupBy('auditable_type')->pluck('auditable_type','auditable_type');
        return $auditables;
    }


}