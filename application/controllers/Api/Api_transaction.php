<?php 
/**
 * C-交易API
 * @author Jerry Cheung <zhangjinghao@itrclub.com>
 * @copyright ITRClub 2017-2018
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_transaction extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function getCoinInfo($coinName)
	{
		$coinInfo=getCoinInfo($coinName);
		die(makeApiData(200,'success',$coinInfo));
	}

}
