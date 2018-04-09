<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__).'/Authorization.php');

/**
 * 首页控制器
 */
class Home extends Authorization {

	public function index()
	{
		$this->load->view('home_ui');
	}
}
