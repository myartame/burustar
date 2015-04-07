<?php

class Contents extends CI_Model{
	public function __construct(){
		parent::__construct();

		date_default_timezone_set('Asia/Seoul');
	}

	public function get($state, $limit, $offset){
		$current_time = date("Y-m-s h:m:s");
		
		$contents = $this->db->select('id, subject, url, play_time')->from('Contents')->where('state', $state)->
			//where(sprintf('start_time <= %s and %s <= end_time', $current_time, $current_time))->
			limit($limit, $offset)->get()->result();
		foreach ($contents as $value) {
			$value->tag = $this->db->select('name')->from('tag')->
				where('contents_id', $value->id)->get()->result();
		}

		return $contents;
	}

	public function search($kind){

	}
}