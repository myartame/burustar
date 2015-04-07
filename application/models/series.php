<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Series extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function get($series_id){
		return $this->db->from('Series')->where('id', $series_id)->
			get()->result();
	}

	public function list_get($series_id){
		return $this->db->select('id, subject, url, play_time')->from('Contents')->where('series_id', $series_id)->
			get()->result();
	}
}