<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $fillable = ['name', 'thumbnail', 'shares', 'start_date', 'type', 'balance', 'wallet_address', 'email'];

    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/" . md5($this->email) . "?d=retro&s=100";
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction', 'recipient_id', 'id');
    }

    public function transactionsCryptoSum()
    {
        $transactions = $this->transactions()->get();
        $total = 0;

        foreach($transactions as $transaction){
            $total+=$transaction->crypto_amount_transfered;
        }

        return $total;
    }

    public function transactionsFiatSum()
    {
        $transactions = $this->transactions()->get();
        $total = 0;

        foreach($transactions as $transaction){
            $total+=$transaction->fiat_amount_transfered;
        }

        return $total;
    }
}
