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
		$configuration->api_key = $inputs['api_key'];
		$configuration->number_cpus = $inputs['number_cpus'];
		$configuration->electricity_cost = $inputs['electricity_cost'];
		$configuration->fiat_currency_symbol = $inputs['fiat_currency_symbol'];	
		$configuration->crypto_currency_symbol = $inputs['crypto_currency_symbol'];
		$configuration->crypto_currency_name = $inputs['crypto_currency_name'];

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