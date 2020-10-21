<?php

namespace App\Repositories\System;

use App\Models\System\Region;
use App\Models\System\Sysdef;
use App\Models\Sysdef\SysdefGroup;
use App\Repositories\BaseRepository;
use App\Repositories\System\Traits\SystemLogoTrait;
use Illuminate\Support\Facades\DB;

class SysdefRepository extends BaseRepository
{
    use SystemLogoTrait;
    const MODEL = Sysdef::class;

    public function __construct()
    {

    }

    public function update(array $input, Sysdef $sysdef){
        return  DB :: transaction(function() use ($input, $sysdef){
            $sysdef->update([
                'value' =>$input['sysdef_value'] ,
            ]);
            return $sysdef;
        });
    }
}
