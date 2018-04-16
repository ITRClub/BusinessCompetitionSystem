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
		$this->load->view('user/register');
	}


	/**
	 * 用户异步登录请求处理方法
	 */
	public function toLogin()
	{
		$this->input->post('phone');
		$this->input->post('password');
		$this->input->post('captcha');

		$_SESSION['account_name'] = $_REQUEST['username'];
		$_SESSION['session_token'] = uniqid('bcs_');
		die(returnApiData(200, 'Login successfully.', ''));
	}


	/**
	 * 用户异步注册请求处理方法
	 */
	public function toRegister()
	{
		$teamName=$this->input->post('teamName');
		$realName=$this->input->post('realName');
		$phone=$this->input->post('phone');
		$password=$this->input->post('password');
		$phoneCaptcha=$this->input->post('phoneCaptcha');
		
		// 校验手机验证码有效性
		if($phoneCaptcha!=$this->session->userdata('login_phoneCaptcha')){
			die(returnApiData(403,'invaildPhoneCaptcha'))
		}
		
		$sql2="SELECT id FROM user WHERE phone=?";
		$query2=$this->db->query($sql2,[$phone]);
		if($query2->num_rows()!=0){
			$ret=$this->ajax->returnData("2","havePhone");
			die($ret);
		}
		
		die(returnApiData(200,'success'));
	}


	/**
	 * 用户异步注销请求处理方法
	 */
	public function toLogout()
	{
		session_destroy();
		die(returnApiData(200, 'Logout successfully.', ''));
	}


	public function myWallet()
	{
		$walletInfo=$this->Wallet_model->getInfo($this->userId);
		$this->load->view('user/myWallet',['walletInfo'=>$walletInfo]);
	}
}
