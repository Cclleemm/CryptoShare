<?php 

namespace App\Processor;

class ApiProcessor
{
	public const POOLURL = "https://xvg-x17.suprnova.cc/";
	public const COINMARKETCAPURL = "https://api.coinmarketcap.com/";

    public function getDatafromPool($api_key)
	{
		//Get Hashrate
        $response = @file_get_contents(ApiProcessor::POOLURL.'index.php?page=api&action=getuserhashrate&api_key='.$api_key);

        if($response)
        {
	        $response = json_decode($response);
	        $hashrate = $response->getuserhashrate->data;

	        //Get Balance
	        $response = @file_get_contents(ApiProcessor::POOLURL.'index.php?page=api&action=getuserbalance&api_key='.$api_key);
	        $response = json_decode($response);
	        $confirmed = $response->getuserbalance->data->confirmed;
	        $unconfirmed = $response->getuserbalance->data->unconfirmed;
			
			return array('hashrate' => $hashrate, 'confirmed' => $confirmed, 'unconfirmed' => $unconfirmed);        	
        }
        else
        {
        	return false;
        }

	}

	public function getDatafromCoinMarketCap($coin_name, $currency)
	{
	    $response = @file_get_contents(ApiProcessor::COINMARKETCAPURL.'v1/ticker/'.$coin_name.'/?convert='.$currency);
        
        if($response)
        {
	        $response = json_decode($response);
	        $verge_price = $response[0]->price_eur;
	        $verge_change = $response[0]->percent_change_24h;	

	        return array('verge_price' => $verge_price, 'verge_change' => $verge_change);	
		}
		else
		{
			return false;
		}
	}
}