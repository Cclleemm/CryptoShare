<?php

namespace App\Repositories;

use App\Transaction;

class TransactionRepository
{
    protected $transaction;

    public function __construct(Transaction $transaction)
	{
		$this->transaction = $transaction;
	}

	private function save(Transaction $transaction, Array $inputs)
	{
        $transaction->note = $inputs['note'];
        $transaction->crypto_amount_transfered = $inputs['crypto_amount_transfered'] ;
        $transaction->fiat_amount_transfered = $inputs['crypto_amount_transfered'] * 0.06 ; //TODO : dynamic coin value
        $transaction->recipient_id = $inputs['recipient_id'];

        $transaction->save();
	}

    public function getAll()
    {
        return $this->transaction->all();
    }

	public function getPaginate($n)
	{
		return $this->transaction->paginate($n);
	}

	public function store(Array $inputs)
	{
		$transaction = new $this->transaction;

		$this->save($transaction, $inputs);

		return $transaction;
	}

	public function getById($id)
	{
		return $this->transaction->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->save($this->getById($id), $inputs);
	}

	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

}