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
		$recipient->thumbnail = $inputs['thumbnail'];
		$recipient->shares = $inputs['shares'];
		$recipient->start_date = $inputs['start_date'];	
		$recipient->type = $inputs['type'];
		$recipient->balance = $inputs['balance'];

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