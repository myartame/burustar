<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contents extends CI_Model{
	public function __construct(){
		parent::__construct();

		date_default_timezone_set('Asia/Seoul');
	}

	public function get($state, $limit, $offset){
		$current_time = date("Y-m-d H:m:s");
		
		$this->db->select('id, url, end_time')->from('Contents')->where('state', $state)->
			where('start_time < ', $current_time)->where('create_time >= ', date('Y-m-d H:m:s', strtotime('-7 days')));
		if ($limit)
			$this->db->limit($limit, $offset);
		$contents = $this->db->order_by('id', 'DESC')->get()->result();
		
		foreach ($contents as $key => $value) {
			if ($value->end_time != null && $value->end_time < $current_time){
				unset($contents[$key]);
			}
			else{
				$value->tag = $this->db->select('name')->from('tag')->
					where('contents_id', $value->id)->get()->result();
			}
		}

		return $contents;
	}

	public function search($kind, $data){
		$search_data = array();
		$current_time = date("Y-m-d h:m:s");

		$search_data['series'] = $this->db->select('id, subject, content, 
			thumbnail_url, round_thumbnail_url')->from('Series')->
			like('subject', $data)->or_like('content', $data)->get()->result();
		$search_data['contents'] = $this->db->select('C.id, C.subject, C.url, C.play_time')->from('Contents AS C')->
			join('Tag AS T', 'C.id = T.contents_id')->like('C.subject', $data)->
			or_like('C.content', $data)->or_like('T.name', $data)->
			where('start_time < ', $current_time)->where('end_time > ', 
			$current_time)->group_by('C.id')->get()->result();

		return $search_data;
	}

	public function detail_get($contents_id){
		$this->db->select('C.id, C.series_id, C.subject, C.content, C.url, C.hits, S.order')->from('Contents AS C')->join('Series_Contents AS S', 'C.id = S.contents_id')->
			where('C.id', $contents_id);

		if ($content){
			$this->db->where('id', $contents_id)->update('Contents', array('hits' => $content[0]->hits + 1));
			return $content;
		}
	}

	public function step_get($series_id, $order){
		return $this->db->select('contents_id')->from('Series_Contents')->
			where('series_id', $series_id)->where('order', $order)->get()->result();
	}
}