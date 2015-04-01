<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function get(){
		$category = $this->db->get('category')->result();
		foreach ($category as $value) {
			$value->list = $this->db->where('category_id', 
				(int)$value->id)->get('category_list')->result();
		}
		return $category;
	}
} 

?>