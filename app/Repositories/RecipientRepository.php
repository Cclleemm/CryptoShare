<?php

namespace App\Repositories;

use App\Recipient;

class RecipientRepository
{
    protected $recipient;

    public function __construct(Recipient $recipient)
	{
		$this->recipient = $recipient;
	}

	private function save(Recipient $recipient, Array $inputs)
	{
		$recipient->name = $inputs['name'];
		$recipient->thumbnail = isset($inputs['thumbnail']) ? $inputs['thumbnail'] : '';
		$recipient->shares = $inputs['shares'];
		$start_date = $date = str_replace('/', '-', $inputs['start_date']);
		$recipient->start_date = date('Y-m-d', strtotime($start_date));;	
		$recipient->type = $inputs['type'];
		$recipient->balance = isset($inputs['balance']) ? $inputs['balance'] : '';
		$recipient->wallet_address = isset($inputs['wallet_address']) ? $inputs['wallet_address'] : '' ;

		$recipient->save();
	}

	public function getPaginate($n)
	{
		return $this->recipient->paginate($n);
	}

	public function store(Array $inputs)
	{
		$recipient = new $this->recipient;		

		$this->save($recipient, $inputs);

		return $recipient;
	}

	public function getById($id)
	{
		return $this->recipient->findOrFail($id);
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