<?php

namespace App\Http\Controllers;

use App\Recipient;
use Illuminate\Http\Request;
use App\Configuration;
use App\Recipient;
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
        $configuration = Configuration::take(1)->get();

        //Retrieve recipient
        $recipients = Recipient::all();

        if($configuration->count() > 0)
        {
            $configuration = $configuration[0];

            $poolData = $apiprocessor->getDatafromPool($configuration->api_key);
            $coinmarketcapData = $apiprocessor->getDatafromCoinMarketCap($configuration->crypto_currency_name, $configuration->fiat_currency_symbol);

            if($poolData && $coinmarketcapData)
            {
                $hashrate = number_format($poolData['hashrate']*0.001, 2);
                $balance = number_format($poolData['confirmed']+$poolData['unconfirmed'], 0);
                $coin_price = number_format($coinmarketcapData['coin_price'], 3);
                $balance_fiat = number_format(($poolData['confirmed']+$poolData['unconfirmed'])*$coinmarketcapData['coin_price'], 0);
                $coin_change = number_format($coinmarketcapData['coin_change'], 2);
                $recipients = Recipient::all();

                $infos = array('hashrate' => $hashrate, 
                                'balance' => $balance, 
                                'balance_fiat' => $balance_fiat,
                                'coin_price' => $coin_price, 
                                'coin_change' => $coin_change, 
                                'currency' => $configuration->fiat_currency_symbol, 
                                'coin_symbol' => $configuration->crypto_currency_symbol,
                                'recipients' => $recipients
                                );
                
                return view('welcome')->with($infos);            
            }
            else
            {
                return view('welcome')->with('error', 'Failed to connect to the API'); 
            }            
        }
        else
        {
            return view('welcome')->with('error', 'Failed to connect to the API, no configuration'); 
        }   

    }
}
