<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 权限检查类
 * 用于截停需要身份授权的页面访问请求
 * @package BCSApplication
 * @subpackage Authorization 类库
 * @copyright 2018 ITRClub All Rights Reserved
 * @author David Ding
 */
class Authorization extends CI_Controller {

	/**
	 * 构造函数
	 */
	public function __construct()
	{
		if (!session_id()) {
			session_start();
		}
		parent::__construct();
		if (!isset($_SESSION['account_name']) || !isset($_SESSION['session_token'])) {
			header('Location: '.config_item('base_url').'/user/login?returnUrl='.urlencode($_SERVER['REQUEST_URI']));
		}
	}
}
