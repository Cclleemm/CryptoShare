<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $fillable = ['name', 'thumbnail', 'shares', 'start_date', 'type', 'balance', 'wallet_address'];

    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/" . md5("clement@raussin.com") . "?d=mm&s=100";
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction', 'recipient_id', 'id');
    }
}
