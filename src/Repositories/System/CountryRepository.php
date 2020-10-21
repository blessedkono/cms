<?php

namespace App\Repositories\System;

use App\Models\System\Country;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CountryRepository extends BaseRepository
{
    const MODEL = Country::class;

    public function getCountryByCode($code)
    {
        return $this->query()->where('code', $code)->first();
    }

    public function store(array $input)
    {

        return  DB :: transaction(function() use ($input){
            $next_user_id = Country::max('id') + 1;
            $country = $this->query()->create([
                'id' =>$next_user_id,
                'name'=>$input['name'],
                'code' =>$input['code']
            ]);
            //Upload photos

            return $country;
        });
    }


    public function update(array $input,Model $country)
    {

        return  DB :: transaction(function() use ($input,$country){
            $country->update([
                'name'=>$input['name'],
                'code' =>$input['code']
            ]);
            //Upload photos

            return $country;
        });
    }


    /*Delete region - soft delete*/
    public function delete($country)
    {
        $country->delete();
    }

    public function deactivateCountry($country)
    {
        $country->isactive = 0;
        $country->save();
        return $country;

    }

    public function activateCountry($country)
    {
        $country->isactive = 1;
        $country->save();
        return $country;

    }

    public function getCountryById($id)
    {
        return $this->query()->where('id',$id)->first();
    }

    public function getCountriesForDataTable()
    {
        return $this->query();
    }

}