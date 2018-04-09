<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * API访问处理类（主路由）
 * @package BCSApplication
 * @subpackage API/MainRouter 类库
 * @copyright 2018 ITRClub All Rights Reserved
 * @author David Ding
 */
class Api extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (!session_id()) {
			session_start();
		}
	}

	/**
	 * API默认路由方法
	 */
	public function index()
	{
		self::outjson(self::makeobj(200, 'Welcome to use BCS Api.', ''));
	}

	/**
	 * 用户异步登录请求处理方法
	 */
	public function signin()
	{
		$_SESSION['account_name'] = $_REQUEST['username'];
		$_SESSION['session_token'] = uniqid('bcs_');
		self::outjson(self::makeobj(200, 'Login successfully.', ''));
	}

	/**
	 * 用户异步注册请求处理方法
	 */
	public function signup()
	{
		exit();
		self::outjson(self::makeobj(200, 'Register successfully.', ''));
	}

	/**
	 * 用户异步注销请求处理方法
	 */
	public function signout() {
		session_destroy();
		self::outjson(self::makeobj(200, 'Logout successfully.', ''));
	}

	/**
	 * 组装标准化接口输出信息
	 * @param integer $code 响应状态码
	 * @param string $message 响应消息
	 * @param array $data 需返回的数据集合
	 * @return array 数据拼装结果
	 */
	private function makeobj($code = 0, $message = '', $data = array()) {
		$data = array(
			'code'	=>	$code,
			'message'	=>	$message,
			'data'	=>	$data,
			'requestId'	=>	date('YmdHis', time())
		);
		return $data;
	}

	/**
	 * JSON输出封装
	 * @param array $data 数据集合
	 * @return string
	 */
	private function outjson($data = array()) {
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}
