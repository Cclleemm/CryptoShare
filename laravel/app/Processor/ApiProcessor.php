<?php 

namespace App\Processor;

class ApiProcessor
{
	public const POOLURL = "https://xvg-x17.suprnova.cc/";
	public const COINMARKETCAPURL = "https://api.coinmarketcap.com/";
	public const SSL_BYPASS = array(
    					"ssl"=>array(
        					"verify_peer"=>false,
        					"verify_peer_name"=>false,
    					),
				); 

    public function getDatafromPool($api_key)
	{
		//Get Hashrate
        $response = @file_get_contents(ApiProcessor::POOLURL.'index.php?page=api&action=getuserhashrate&api_key='.$api_key, false, stream_context_create(ApiProcessor::SSL_BYPASS));

        if($response)
        {
	        $response = json_decode($response);
	        $hashrate = $response->getuserhashrate->data;

	        //Get Balance
	        $response = @file_get_contents(ApiProcessor::POOLURL.'index.php?page=api&action=getuserbalance&api_key='.$api_key, false, stream_context_create(ApiProcessor::SSL_BYPASS));
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
	    $response = @file_get_contents(ApiProcessor::COINMARKETCAPURL.'v1/ticker/'.$coin_name.'/?convert='.$currency, false, stream_context_create(ApiProcessor::SSL_BYPASS));
        
        if($response)
        {
        	$response = json_decode($response);
	        switch($currency){
	        	case 'EUR' : $coin_price = $response[0]->price_eur;
	        	break;

	        	case 'USD' : $coin_price = $response[0]->price_usd;
	        	break;
	        }
	        $coin_change = $response[0]->percent_change_24h;	

	        return array('coin_price' => $coin_price, 'coin_change' => $coin_change);	
		}
		else
		{
			return false;
		}
	}

	public function getAllCoinsfromCoinMarketCap()
	{
		$response = @file_get_contents(ApiProcessor::COINMARKETCAPURL.'v1/ticker/?limit=1000', false, stream_context_create(ApiProcessor::SSL_BYPASS));

        if($response)
        {
	        return json_decode($response);	
		}
		else
		{
			return false;
		}
	}
}
