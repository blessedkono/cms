<?php

namespace App\Repositories\System;

use App\Models\System\Region;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegionRepository extends BaseRepository
{
    const MODEL = Region::class;

    public function getRegionByCode($hasc)
    {
        $region = $this->query()->where('hasc', $hasc)->first();
            return $region;
    }

    public function getRegionById($id)
    {
        $region = $this->query()->where('id', $id)->first();
        return $region;
    }

    public function getRegionsBycountryIdForDataTable($country_id)
    {
        return $this->query()->where('country_id',$country_id);
    }


    public function store(array $input,$country)
    {

        return  DB :: transaction(function() use ($input,$country){
            $next_id = Region::max('id') + 1;
            $region = $this->query()->create([
                'id' =>$next_id,
                'country_id' => $country->id,
                'name'=>$input['name'],
                'hasc' =>$input['hasc']
            ]);
            //Upload photos

            return $region;
        });
    }


    public function update(array $input,Model $region)
    {

        return  DB :: transaction(function() use ($input,$region){
//            $next_id = Region::max('id') + 1;
            $region->update([
//                'id' =>$next_id,
//                'country_id' => $country->id,
                'name'=>$input['name'],
                'hasc' =>$input['hasc']
            ]);
            //Upload photos

            return $region;
        });
    }

    /*Delete region - soft delete*/
    public function delete($region)
    {
        $region->delete();
    }

    public function deactivateRegion($region)
    {
        $region->isactive = 0;
        $region->save();
        return $region;

    }

    public function activateRegion($region)
    {
        $region->isactive = 1;
        $region->save();
        return $region;

    }
}