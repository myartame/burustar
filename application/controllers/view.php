<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class View extends REST_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->model('contents', '', true);
	}

	public function index_get(){
		$this->load->view('view.html');
	}

	public function content_get(){
		$this->response($this->contents->detail_get($this->get('contents_id')));
	}

	public function step_get(){
		$this->response($this->contents->step_get($this->get('series_id'), $this->get('order')));
	}
}