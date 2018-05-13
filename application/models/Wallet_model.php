<?php
/**
 * M-Wallet钱包
 * @author Jerry Cheung <zhangjinghao@itrclub.com>
 * @copyright ITRClub 2017-2018
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}


	/**
	 * 修改个人钱包信息
	 * @param Array 钱包信息
	 * @return Boolean 修改状态
	 */
	public function updateInfo($info)
	{
		$userId=$this->session->userdata('userId');
		
		$balance=$info['balance'];
		$coinBalance=$info['coin_balance'];
		
		$sql='UPDATE wallet SET balance=?,coin_balance=? WHERE user_id=?';
		$query=$this->db->query($sql,[$balance,$coinBalance,$userId]);

		if($this->db->affected_rows()==1){
			return true;
		}else{
			return false;
		}
	}


	/**
	 * 新增个人钱包
	 * @param Integer 用户ID
	 * @return Boolean 状态码
	 */
	public function add($userId)
	{
		
		$balance=$this->config->item('originBalance');
		$allCoinName=$this->config->item('allCoinName');
		
		foreach($allCoinName as $value){
			$coinBalance[$value]=0;
		}
		
		$coinBalance=json_encode($coinBalance);
		
		$sql="INSERT INTO wallet(user_id,balance,coin_balance) VALUES (?,?,?)";
		$query=$this->db->query($sql,[$userId,$balance,$coinBalance]);

		if($this->db->affected_rows()==1){
			return true;
		}else{
			return false;
		}
	}
	
	
	/**
	 * 获取个人钱包信息
	 * @return Array 个人钱包信息
	 */
	public function getInfo()
	{
		$userId=$this->session->userdata('userId');
		
		$sql="SELECT * FROM wallet WHERE user_id=?";
		$query=$this->db->query($sql,[$userId]);
		
		if($query->num_rows()==1){
			$list=$query->result_array();
			return $list[0];
		}else{
			return array();
		}
	}
}
