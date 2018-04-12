<?php
/**
 * C-User用户
 * @author ddawx123,SmallOysyer
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
		$this->load->view('login_ui');
	}


	public function register()
	{
		$this->load->view('register_ui');
	}
}
