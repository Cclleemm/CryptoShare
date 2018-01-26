<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuration;
use DB;

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
    public function index()
    {

        //Get Suprnova API key
        $api_key = DB::table('configurations')->take(1)->get()[0];

        //Get Hashrate
        $response = file_get_contents('https://xvg-x17.suprnova.cc/index.php?page=api&action=getuserhashrate&api_key='.$api_key->api_key);
        $response = json_decode($response);
        $hashrate = $response->getuserhashrate->data;

        //Get Balance
        $response = file_get_contents('https://xvg-x17.suprnova.cc/index.php?page=api&action=getuserbalance&api_key='.$api_key->api_key);
        $response = json_decode($response);
        $confirmed = $response->getuserbalance->data->confirmed;
        $unconfirmed = $response->getuserbalance->data->unconfirmed;



        $response = file_get_contents('https://api.coinmarketcap.com/v1/ticker/verge/?convert=EUR');
        $response = json_decode($response);
        $verge_price = $response[0]->price_eur;
        $verge_change = $response[0]->percent_change_24h;
        //Call Suprnova Server

        $infos = array('hashrate' => $hashrate, 'balanceConfirmed' => $confirmed, 'balanceUnconfirmed' => $unconfirmed, 'verge_price' => $verge_price, 'verge_change' => $verge_change, 'api_key' => $api_key);

        //Store variable

        return view('welcome')->with($infos);
    }
}
