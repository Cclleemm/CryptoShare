<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigurationRequest;
use App\Repositories\ConfigurationRepository;
use Illuminate\Http\Request;

use App\Configuration;
use App\Processor\ApiProcessor;

class ConfigurationController extends Controller
{
    protected $configurationRepository;

    public function __construct(ConfigurationRepository $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;
    }

    public function index(ApiProcessor $apiprocessor)
    {
        //Get configuration from DB
        $configurations = Configuration::all();

        //Get list of 1000 coins from coinmarketcap.com
        $allCoins = $apiprocessor->getAllCoinsfromCoinMarketCap();

        return view('configuration.index', compact('configurations', 'allCoins'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(ConfigurationRequest $request)
    {
        if(Configuration::all()->count() == 0)
        {
            $inputs['api_key'] = $request->api_key;
            $inputs['number_cpus'] = $request->number_cpus;
            $inputs['electricity_cost'] = $request->electricity_cost;
            $inputs['fiat_currency_symbol'] = $request->fiat_currency_symbol; 
            $inputs['crypto_currency_symbol'] = $request->crypto_currency_symbol[0]['coin_symbol'];
            $inputs['crypto_currency_name'] = $request->crypto_currency_symbol[0]['coin_name'];

            $configuration = $this->configurationRepository->store($inputs);

            return redirect('configuration')->withOk("La configuration a été créé avec succés !");
        }
        else
        {
            return redirect('configuration')->withOk('Une configuration existe déja!');
        }

    }

    public function show($id)
    {
        $configuration = $this->configurationRepository->getById($id);

        return view('show',  compact('configuration'));
    }

    public function edit($id)
    {
        $configuration = $this->configurationRepository->getById($id);

        return view('edit',  compact('configuration'));
    }

    public function update(ConfigurationRequest $request, $id)
    {

        $inputs['api_key'] = $request->api_key;
        $inputs['number_cpus'] = $request->number_cpus;
        $inputs['electricity_cost'] = $request->electricity_cost;
        $inputs['fiat_currency_symbol'] = $request->fiat_currency_symbol; 

        $coin_info = explode('|', $request->crypto_currency_symbol);
        $inputs['crypto_currency_symbol'] = $coin_info[0];
        $inputs['crypto_currency_name'] = $coin_info[1]; 

        $this->configurationRepository->update($id, $inputs);
        
        return redirect('configuration')->withOk("La configuration a été modifié avec succés!");
    }

    public function destroy($id)
    {
        $this->configurationRepository->destroy($id);

        return back();
    }
}
