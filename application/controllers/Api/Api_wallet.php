<?php 
/**
 * C-钱包API
 * @author Jerry Cheung <zhangjinghao@itrclub.com>
 * @copyright ITRClub 2017-2018
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_wallet extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function getInfo()
	{
		$walletInfo=$this->Wallet_model->getInfo();
		die(makeApiData(200,'success',$walletInfo));
	}

}
