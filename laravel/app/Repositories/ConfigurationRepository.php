<?php

namespace App\Repositories;

use App\Configuration;

class ConfigurationRepository
{

    protected $configuration;

    public function __construct(Configuration $configuration)
	{
		$this->configuration = $configuration;
	}

	private function save(Configuration $configuration, Array $inputs)
	{
		$configuration->name = $inputs['name'];
		$configuration->thumbnail = $inputs['thumbnail'];
		$configuration->shares = $inputs['shares'];
		$configuration->start_date = $inputs['start_date'];	
		$configuration->type = $inputs['type'];
		$configuration->balance = $inputs['balance'];
		$configuration->wallet_address = $inputs['wallet_address'];

		$configuration->save();
	}

	public function store(Array $inputs)
	{
		$configuration = new $this->configuration;		

		$this->save($configuration, $inputs);

		return $configuration;
	}

	public function getById($id)
	{
		return $this->configuration->findOrFail($id);
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