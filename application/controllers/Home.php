<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 首页控制器
 */
class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('index');
	}
}
