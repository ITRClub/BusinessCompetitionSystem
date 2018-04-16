<?php
/**
 * C-Transaction交易
 * @author Jerry Cheung <zhangjinghao@itrclub.com>
 * @copyright ITRClub 2017-2018
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public $userId=1;

	public function __construct(){
		parent::__construct();
	}


	/**
	 * 交易所主页
	 * @access public
	 */
	public function index()
	{
		$coinName=array('btc','bch','eth','ltc','xrp');
		foreach($coinName as $value){
			$coinInfo[$value]=getCoinInfo($value);
		}
		
		// @TEST 测试API接口
		die(var_dump($coinInfo));
		//$this->load->view('transaction/index',['coinInfo'=>$coinInfo]);
	}


	public function detail($coinName='')
	{
		$coinInfo=getCoinInfo($coinName);

		// @TEST 测试API接口
		die(var_dump($coinInfo));
		//$this->load->view('transaction/detail',['coinName'=>$coinName,'coinInfo'=>$coinInfo]);
	}


	/**
	 * 交易处理
	 * @access public
	 * @return json 交易是否成功
	 */
	public function toTransaction()
	{
		$type=$this->input->post('type');
		$coinName=$this->input->post('coinName');
		$coinNum=$this->input->post('coinNum');

		// 获取汇率并计算金额
		$coinInfo=getCoinInfo($coinName);
		$exRate=$coinInfo['last'];
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
			// 交易记录
			$this->db->query('INSERT INTO trans_log(type,coin_name,coin_num,unit_price,money,balance)',[$type,$coinName,$coinNum,$exRate,$money,$balance]);
			// 回调
			die(returnApiData(200,'success'));
		}else{
			die(returnApiData(1,'transFailed'));
		}
	}
		
	/**
	 * 显示交易记录列表
	 * @access public
	 * @return view 交易记录列表
	 */
	public function showTransLog()
	{
		$query=$this->db->query("SELECT * FROM trans_log");
		$list=$query->result_array();

		$this->load->view('transaction/log',['list'=>$list]);
	}
}
