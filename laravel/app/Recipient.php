<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $fillable = ['name', 'thumbnail', 'shares', 'start_date', 'type', 'balance', 'wallet_address'];
}
