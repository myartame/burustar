<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Series extends CI_Model{
	public function __construct(){
		parent::__construct();

		date_default_timezone_set('Asia/Seoul');
	}

	public function get($series_id, $kind = 'newest'){
		return $this->db->from('Series')->where('id', $series_id)->
			where('state', $kind)->get()->result();
	}

	public function list_get($kind = 'newest', $limit, $offset){
		$this->db->from('Series')->where('state', $kind)->
			order_by('id', 'DESC');
		if ($limit)
			$this->db->limit($limit, $offset);

		return $this->db->get()->result();
	}

	public function contents_list($series_id, $order){
		$current_time = date("Y-m-d H:m:s");

		$this->db->select('C.id, C.url')->
			from('Series_Contents AS S')->join('Contents AS C', 'S.contents_id = C.id')->
			where('S.series_id', $series_id)->where('start_time < ', $current_time)->
			where('end_time > ', $current_time);
		if ($order)
			$this->db->where('S.order <= ', $order - 1)->limit(3, 0);

		return $this->db->get()->result();
	}
}