<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function add($email, $password, $facebook_token, $level){
		$query = $this->db->from('User')->where('email', $email)->get()->result();

		if (!count($query)){
			$this->db->insert('User', array(
				'email' => $email,
				'password' => md5($password),
				'facebook_token' => $facebook_token,
				'level' => $level
			));
			return true;
		}
		else
			return false;
	}
}