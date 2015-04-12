<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Series extends CI_Model{
	public function __construct(){
		parent::__construct();

		date_default_timezone_set('Asia/Seoul');
	}

	public function get($series_id){
		return $this->db->from('Series')->where('id', $series_id)->
			get()->result();
	}

	public function list_get($series_id, $order){
		$current_time = date("Y-m-d h:m:s");

		$this->db->select('C.id, C.subject, C.url, C.play_time')->
			from('Series_Contents AS S')->join('Contents AS C', 'S.contents_id = C.id')->
			where('S.series_id', $series_id)->where('start_time < ', $current_time)->
			where('end_time > ', $current_time);
		if ($order)
			$this->db->where('S.order <= ', $order - 1)->limit(3, 0);

		return $this->db->get()->result();
	}
}