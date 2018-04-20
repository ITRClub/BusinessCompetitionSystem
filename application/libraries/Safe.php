<?php
/**
 * L-安全类
 * @author Jerry Cheung <zhangjinghao@itrclub.com>
 * @copyright ITRClub 2017-2018
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Safe {

	protected $_CI;

	function __construct(){
		$this->_CI =& get_instance();
		$this->_CI->load->helper(array('url'));
	}
	
	
	public function encryptPassword($password,$salt){
		$hashSalt=base64_encode($salt);
		$hashPassword=md5($password);
		$ret=sha1($hashSalt.$hashPassword);
		
		return $ret;
	}

	
	/**
	 * 判断当前页面是否有权限访问
	 */
	public function checkPermission()
	{
		// 判断是否已经登录
		if($this->_CI->session->userdata('userId')!=NULL && $this->_CI->session->userdata('userId')>0){
			header("Location:".base_url('/'));
		}
		
		// 判断Ajax请求
		if($this->_CI->input->is_ajax_request()){
			return;
		}
		
		// 判断访问后台的权限
		if($this->_CI->uri->segment(1)=='admin' && $this->_CI->session->userdata('is_admin')!=1){
			header("Location:".base_url('/'));
		}
	}
}
