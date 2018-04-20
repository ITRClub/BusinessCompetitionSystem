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


	public function detail($coinName='')
	{
		if($coinName==''){
			show_404();
		}
		
		// 生成并储存Token
		$token=sha1(session_id().md5(time()));
		$this->session->set_userdata('trans_token',$token);
		
		$this->load->view('transaction/detail',['coinName'=>$coinName,'token'=>$token]);
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
			die(returnApiData(403,'invaildToken'));
		}
		
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
		$coinBalance=$walletInfo['coin_balance'];
		$coinBalance=json_decode($coinBalance);
		
		if($type==1){
			// 买入
			$balance-=$money;
			$coinBalance[$coinName]+=$coinNum;
		}elseif($type==2){
			// 卖出
			$balance+=$money;
			$coinBalance[$coinName]-=$coinNum;
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
