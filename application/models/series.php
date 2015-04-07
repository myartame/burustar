<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Series extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function get($series_id){
		return $this->db->from('Series')->where('id', $series_id)->
			get()->result();
	}

	public function list_get($series_id, $order){
		$this->db->select('C.id, C.subject, C.url, C.play_time')->
			from('Series_Contents AS S')->join('Contents AS C', 'S.contents_id = C.id')->
			where('S.series_id', $series_id);
		if ($order)
			$this->db->where('S.order <= ', $order - 1)->limit(3, 0);
		return $this->db->get()->result();
	}
}