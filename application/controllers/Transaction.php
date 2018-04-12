<?php
/**
 * C-Transaction交易
 * @author SmallOysyer <zhangjinghao@itrclub.com>
 * @copyright ITRClub 2017-2018
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	$userId=1;

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$walletInfo=$this->Wallet_model->getInfo($this->userId);
		$this->load->view('transaction/index',['walletInfo'=>$walletInfo]);
	}


	/**
	 * 交易处理
	 * @access public
	 */
	public function toTransaction()
	{
		$type=$this->input->post('type');
		$coinName=$this->input->post('coinName');
		$coinNum=$this->input->post('coinNum');

		// 获取汇率并计算金额
		$exRate=getCoinExchangeRate($coinName.'usd');
		$money=$coinNum*$exRate;
		
		// 对钱包进行操作
		$walletInfo=$this->Wallet_model->getInfo($this->userId);
		$balance=$walletInfo['balance'];
		$coin_balance=$walletInfo['coin_balance'];
		$coin_balance=json_decode($coin_balance);
		
		if($type==1){
			// 买入
			$balance-=$money;
			$coin_balance[$coinName]+=$coinNum;
		}elseif($type==2){
			// 卖出
			$balance+=$money;
			$coin_balance[$coinName]-=$coinNum;
		}
		
		$status=$this->Wallet_model->updateInfo($walletInfo);
		
		if($status==true){
		
		}else{
		
		}
	}
}
