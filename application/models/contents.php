<?php

class Contents extends CI_Model{
	public function __construct(){
		parent::__construct();

		date_default_timezone_set('Asia/Seoul');
	}

	public function get($state, $limit, $offset){
		$current_time = date("Y-m-s h:m:s");
		return $this->db->select('id, subject, url, play_time')->from('Contents')->where('state', $state)->
			//where(sprintf('start_time <= %s and %s <= end_time', $current_time, $current_time))->
			limit($limit, $offset)->get()->result();
	}
}