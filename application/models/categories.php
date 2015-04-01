<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function get(){
		return $this->db->get('category')->result();
	}
}