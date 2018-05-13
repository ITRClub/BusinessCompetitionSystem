<?php
/**
 * C-Transaction交易
 * @author Jerry Cheung <zhangjinghao@itrclub.com>
 * @copyright ITRClub 2017-2018
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public $userId;

	public function __construct(){
		parent::__construct();
		$this->userId=$this->session->userdata('userId');
	}


	/**
	 * 交易所主页
	 * @access public
	 */
	public function index()
	{
		$allCoinName=$this->config->item('allCoinName');
		$ret='array(';
		
		foreach($allCoinName as $value){
			$ret.='"'.$value.'",';
		}
		
		// 组装JS数组
		$ret=substr($ret,0,strlen($ret)-1);
		$ret.=');';
		
		$this->load->view('transaction/index',['allCoin'=>$ret]);
	}


	public function coinDetail($coinName='')
	{
		if($coinName==''){
			show_404();
		}
		
		// 生成并储存Token
		$token=sha1(session_id().md5(time()));
		$this->session->set_userdata('trans_token',$token);

		$allCoinCNName=$this->config->item('allCoinCNName');
		$allCoinENName=$this->config->item('allCoinENName');
		$allCoinDesc=$this->config->item('allCoinDesc');
		$coinCNName=$allCoinCNName[$coinName];
		$coinENName=$allCoinENName[$coinName];
		$coinDesc=$allCoinDesc[$coinName];

		if($this->session->userdata('isLogin')===1){
			$walletInfo=$this->Wallet_model->getInfo();
			$balance=$walletInfo['balance'];
		}else{
			$balance=0;
		}

		$this->load->view('transaction/coinDetail',['coinName'=>$coinName,'coinCNName'=>$coinCNName,'coinENName'=>$coinENName,'coinDesc'=>$coinDesc,'balance'=>$balance,'token'=>$token]);
	}


	/**
	 * 交易处理
	 * @access public
	 * @return json 交易是否成功
	 */
	public function toTransaction()
	{
		// 校验Token有效性
		$token=$this->input->post('token');
		if($token!=$this->session->userdata('trans_token')){
			die(makeApiData(403,'invaildToken'));
		}
		
		$type=$this->input->post('type');
		$coinName=$this->input->post('coinName');
		$coinNum=$this->input->post('coinNum');

		// 获取汇率并计算金额
		$coinInfo=getCoinInfo($coinName);
		$exRate=$coinInfo['last'];
		$money=$coinNum*$exRate;
		
		// 对钱包进行操作
		$walletInfo=$this->Wallet_model->getInfo();
		$balance=$walletInfo['balance'];
		$coinBalance=$walletInfo['coin_balance'];
		$coinBalance=json_decode($coinBalance,true);
		
		if($type==1){
			// 买入
			$balance-=$money;
			$coinBalance[$coinName]+=$coinNum;

			if($balance<0.00){
				die(makeApiData(2,'noBalance'));
			}
		}elseif($type==2){
			// 卖出
			$balance+=$money;
			$coinBalance[$coinName]-=$coinNum;

			if($coinBalance[$coinName]<0){
				die(makeApiData(3,'noCoinBalance'));
			}
		}
		
		$coinBalance=json_encode($coinBalance);
		$walletInfo['coin_balance']=$coinBalance;
		$walletInfo['balance']=$balance;
		$status=$this->Wallet_model->updateInfo($walletInfo);
		
		if($status===true){
			// 交易记录
			$this->db->query('INSERT INTO trans_log(type,user_id,coin_name,coin_num,unit_price,money,balance) VALUES (?,?,?,?,?,?,?)',[$type,$this->userId,$coinName,$coinNum,$exRate,$money,$balance]);
			die(makeApiData(200,'success'));
		}else{
			die(makeApiData(1,'transFailed',[]));
		}
	}
}
