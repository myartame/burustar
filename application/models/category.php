<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function get(){
		$category = $this->db->from('Category')->get()->result();
		foreach ($category as $value) {
			$value->list = $this->db->select('subject')->from('Series')->
				where('category_id', $value->id)->get()->result();
		}
		return $category;
	}
} 