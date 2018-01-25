<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['api_keys', 'number_cpus', 'electricity_cost', 'fiat_currency_symbol', 'crypto_currency_symbol'];
}
