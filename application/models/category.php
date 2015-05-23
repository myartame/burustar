<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function get($language){
		$current_db = $this->db_loader->get($language);

		$category = $current_db->from('Category')->get()->result();
		foreach ($category as $value) {
			$value->list = $current_db->select('id AS series_id, subject')->from('Series')->
				where('category_id', $value->id)->get()->result();
		}
		return $category;
	}
} 