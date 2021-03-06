<?php
/**
 * C-UCenter用户中心
 * @author Jerry Cheung <zhangjinghao@itrclub.com>
 * @copyright ITRClub 2017-2018
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class UCenter extends CI_Controller {

	public $userId;

	public function __construct(){
		parent::__construct();
		$this->userId=$this->session->userdata('userId');
	}

	
	public function index()
	{
		$this->safe->checkLogin();

		$query=$this->db->query("SELECT COUNT(*) FROM trans_log WHERE user_id=?",[$this->userId]);
		$list=$query->result_array();
		$logCount=$list[0]['COUNT(*)'];

		$this->load->view('ucenter/index',['logCount'=>$logCount]);
	}
	
	
	/*public function myWallet()
	{
		$walletInfo=$this->Wallet_model->getInfo($this->userId);
		$this->load->view('user/myWallet',['walletInfo'=>$walletInfo]);
	}
	
	
	public function myProfile()
	{
		$query=$this->db->query('SELECT * FROM user WHERE id=?',[$this->userId]);
		$list=$query->result_array();
		$info=$list[0];
		
		$this->load->view('user/myProfile',['userInfo'=>$info]);
	}*/
	
	
	public function toUpdatePassword()
	{
		$this->load->helper('string');
		
		$oldPassword=$this->input->post('oldPassword');
		$newPassword=$this->input->post('newPassword');
		
		$sql1='SELECT password,salt FROM user WHERE id=?';
		$query=$this->db->query($sql1,[$this->userId]);
		$list=$query->result_array();
		$info=$list[0];
		$password_indb=$info['password'];
		$salt_indb=$info['salt'];
		$hashPassword1=$this->safe->encryptPassword($oldPassword,$salt_indb);
		
		if($hashPassword1!=$password_indb){
			die(makeApiData(1,'invaildOldPwd'));
		}
		
		$newSalt=random_string();
		$hashPassword2=$this->safe->encryptPassword($newPassword,$newSalt);
		
		$sql2='UPDATE user SET password=?,salt=? WHERE id=?';
		$query2=$this->db->query($sql2,[$hashPassword2,$newSalt]);
		
		if($this->db->affected_rows()==1){
			die(makeApiData(200,'success'));
		}else{
			die(makeApiData(0,'failed'));
		}
	}


	/**
	 * 显示交易记录列表
	 * @access public
	 * @return view 交易记录列表
	 */
	public function showTransactionLog()
	{
		$this->safe->checkLogin();

		$query=$this->db->query("SELECT * FROM trans_log WHERE user_id=?",[$this->userId]);
		$list=$query->result_array();

		$this->load->view('ucenter/transactionLog',['list'=>$list]);
	}
}
