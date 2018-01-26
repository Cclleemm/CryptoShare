<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuration;
use App\Processor\ApiProcessor;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ApiProcessor $apiprocessor)
    {
        //Retrieve configuration
        $configuration = Configuration::take(1)->get()[0];

        $poolData = $apiprocessor->getDatafromPool($configuration->api_key);
        $coinmarketcapData = $apiprocessor->getDatafromCoinMarketCap("verge", $configuration->fiat_currency_symbol);

        if($poolData && $coinmarketcapData)
        {
            $hashrate = number_format($poolData['hashrate']*0.001, 2);
            $balance = number_format($poolData['confirmed']+$poolData['unconfirmed'], 0);
            $verge_price = number_format($coinmarketcapData['verge_price'], 4);
            $balance_fiat = number_format(($poolData['confirmed']+$poolData['unconfirmed'])*$coinmarketcapData['verge_price'], 0);
            $verge_change = number_format($coinmarketcapData['verge_change'], 2);

            $infos = array('hashrate' => $hashrate, 
                            'balance' => $balance, 
                            'balance_fiat' => $balance_fiat,
                            'verge_price' => $verge_price, 
                            'verge_change' => $verge_change, 
                            'currency' => $configuration->fiat_currency_symbol, 
                            'coin_symbol' => $configuration->crypto_currency_symbol
                            );
            
            return view('welcome')->with($infos);            
        }
        else
        {
            return view('welcome')->with('error', 'Failed to connect to the API'); 
        }

    }
}
