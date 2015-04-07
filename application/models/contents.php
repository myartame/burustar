<?php defined('BASEPATH') OR exit('No direct script access allowed');

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

	public function search($kind, $data){
		if ($kind == 'contents'){
			return $this->db->from('Contents')->like('subject', $data)->
				or_like('content', $data)->get()->result();
		}
		else{
			return $this->db->select('C.id, C.subject, C.url, C.play_time')->
				from('Contents AS C')->join('Tag AS T', 'C.id = T.contents_id')->
				like('T.name', $data)->get()->result();
		}
	}

	public function detail_get($contents_id){
		$content = $this->db->select('C.id, C.subject, C.content, C.url, C.hits, S.order')->from('Contents AS C')->join('Series_Contents AS S', 'C.id = S.contents_id')->
			where('C.id', $contents_id)->get()->result();

		if ($content){
			$this->db->where('id', $contents_id)->update('Contents', array('hits' => $content[0]->hits + 1));
			return $content;
		}
	}
}