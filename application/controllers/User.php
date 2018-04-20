<?php
/**
 * C-User用户
 * @author David Ding,Jerry Cheung
 * @copyright ITRClub 2017-2018
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		//$this->load->view('login_page');
	}


	public function login()
	{
		$this->load->view('user/login');
	}


	public function register()
	{
		// 生成并储存Token
		$token=sha1(session_id().md5(time()));
		$this->session->set_userdata('reg_token',$token);
		
		$this->load->view('user/register',['token'=>$token]);
	}


	/**
	 * 用户异步登录请求处理方法
	 */
	public function toLogin()
	{
		$phone=$this->input->post('phone');
		$password=$this->input->post('password');
		$captcha=$this->input->post('captcha');
		
		// 校验验证码有效性
		if($captcha!=$this->session->userdata('login_captcha')){
			unset($_SESSION['login_captcha']);
			die(returnApiData(1,'invaildCaptcha'));
		}
		
		$query=$this->db->query('SELECT * FROM user WHERE phone=?',[$phone]);
		if($query->num_rows()!=1){
			unset($_SESSION['login_captcha']);
			die(returnApiData(0,'invaildPwd'));
		}else{
			$info=$this->result_array();
			$info=$info[0];
			$password_indb=$info['password'];
			$salt=$info['salt'];
			$hashPassword=$this->encryptPassword($password,$salt);
			
			// 判断密码有效性
			if($hashPassword==$password_indb){
				// 更新用户最后登录时间
				$nowTime=date('Y-m-d H:i:s');
				$query2=$this->db->query('UPDATE user SET last_login_time=? WHERE phone=?',[$nowTime,$phone]);
				
				// 将用户资料存入session
				$this->session->set_userdata('userId',$info['id']);
				$this->session->set_userdata('realName',$info['real_name']);
				$this->session->set_userdata('isAdmin',$info['is_admin']);
				
				unset($_SESSION['login_captcha']);
				die(returnApiData(200,'success'));
			}else{
				unset($_SESSION['login_captcha']);
				die(returnApiData(0,'invaildPwd'));
			}
		}
	}


	/**
	 * 用户异步注册请求处理方法
	 */
	public function toRegister()
	{
		$this->load->helper('string');
		
		// 校验Token有效性
		$token=$this->input->post('token');
		if($token!=$this->session->userdata('reg_token')){
			die(returnApiData(403,'invaildToken'));
		}
		
		$teamName=$this->input->post('teamName');
		$realName=$this->input->post('realName');
		$phone=$this->input->post('phone');
		$password=$this->input->post('password');
		$phoneCaptcha=$this->input->post('phoneCaptcha');
		
		// 校验手机验证码有效性
		if($phoneCaptcha!=$this->session->userdata('reg_phoneCaptcha')){
			die(returnApiData(1,'invaildPhoneCaptcha'));
		}
		
		// 检查是否已存在此手机
		$sql1="SELECT id FROM user WHERE phone=?";
		$query1=$this->db->query($sql1,[$phone]);
		if($query1->num_rows()!=0){
			unset($_SESSION['reg_phoneCaptcha']);
			die(returnApiData(2,'havePhone'));
		}
		
		// 生成salt并加密
		$salt=random_string();
		$hashPassword=$this->safe->encryptPassword($password,$salt);
		
		$sql='INSERT INTO user(team_name,real_name,phone,password,salt) VALUES (?,?,?,?,?)';
		$query=$this->db->query($sql,[$teamName,$realName,$phone,$hashPassword,$salt]);
		$userId=$this->db->insert_id();
		
		$addWallet=$this->Wallet_model->add($userId);
		
		if($this->db->affected_rows()==1 && $addWallet==TRUE){
			unset($_SESSION['reg_phoneCaptcha']);
			die(returnApiData(200,'success'));
		}else{
			die(returnApiData(0,'failed'));
		}
	}
	
	
	public function logout()
	{
		$this->load->view('user/logout');
	}


	public function toLogout()
	{
		session_destroy();
		header('Location:'.base_url());
	}
	
	
	public function forgetPassword()
	{
		$this->load->view('user/forgetPwd');
	}
	
	public function sendPhoneCaptcha()
	{
	
	}
}
