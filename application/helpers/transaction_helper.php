<?php 
/**
 * H-Transaction交易
 * @author Jerry Cheung <zhangjinghao@itrclub.com>
 * @copyright ITRClub 2017-2018
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 获取某货币的汇率
 * @param String 币种名称
 * @return array 货币信息
 */
function getCoinInfo($coinName)
{
	$allowCurrencyPair=array('btcusd','btceur','eurusd','xrpusd','xrpeur','xrpbtc','ltcusd','ltceur','ltcbtc','ethusd','etheur','ethbtc','bchusd','bcheur','bchbtc');
	$currencyPair=$coinName.'usd';

	if(!in_array($currencyPair,$allowCurrencyPair)){
		return array();
	}

	$apiUrl='https://www.bitstamp.net/api/v2/ticker/'.$currencyPair;

	$curl=curl_init();
	curl_setopt($curl,CURLOPT_URL,$apiUrl);
	curl_setopt($curl,CURLOPT_HEADER,false);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	$data=curl_exec($curl);
	curl_close($curl);
	
	$data=json_decode($data,true);
	$last=$data['last'];
	$open=$data['open'];
	$extent=($last-$open)/$open*100;

	$ret['name']=$coinName;
	$ret['last']=$last;
	$ret['open']=$open;
	$ret['high']=$data['high'];
	$ret['low']=$data['low'];
	$ret['extent']=substr($extent,0,4).'%';

	return $ret;
}
