<?php

namespace App\Models\System;

use App\Models\System\Attribute\CurrencyAttribute;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use CurrencyAttribute;

    protected $guarded =[];
}
