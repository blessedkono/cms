<?php

namespace App\Repositories\System;

use App\Models\System\Currency;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CurrencyRepository extends BaseRepository
{
    const MODEL = Currency::class;


    public function getCurrencyByCode($code)
    {
        $currency = $this->query()->where('code', $code)->first();
            return $currency;
    }

    public  function  getCurrencyName($id){
        $currency = $this->query()->select('name')->where('id',$id)->first();
        return $currency->name;

    }
    public  function getCurrencyDisplaySymbol($id)
    {
        return $return = $this->query()->select('code')->where('id', $id)->first()->code;

    }

    public function createCurrency(array $input)
    {
        return DB::transaction(function () use($input) {
            $next_user_id = Currency::max('id') + 1;
           $currency =  $this->query()->create([
                'id' =>$next_user_id,
                'name' => $input['currency_name'],
                'code' => $input['currency_code'],
                'display_symbol' => $input['currency_symbol'],
                'decimal_places' => 2,
                'isdefault' => 0,
                'exch_rate' => '2288.40'
            ]);
           return $currency;
        });
    }

    public function updateCurrency(array $input, Model $currency)
    {
        return DB::transaction(function () use($input, $currency) {
            $currency->update([
                'name' => $input['currency_name'],
                'code' => $input['currency_code'],
                'display_symbol' => $input['currency_symbol'],
            ]);
        });
    }

}