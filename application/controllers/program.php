<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Program extends REST_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->model('series', '', true);
	}

	public function index_get(){
		$this->load->view('program.html');
	}

	public function series_get(){
		$this->response($this->series->get($this->get('series_id'),
			$this->get('kind')));
	}

	public function series_list_get(){
		$this->response($this->series->contents_list($this->get('series_id'),
			$this->get('order')));
	}
}