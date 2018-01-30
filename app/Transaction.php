<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['note', 'crypto_amount_transfered', 'fiat_amount_transfered', 'recipient_id'];

    public function recipient()
    {
        return $this->belongsTo('App\Recipient', 'recipient_id', 'id');
    }
}
