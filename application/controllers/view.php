<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class View extends REST_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->model('contents', '', true);
	}

	public function index(){

	}

	public function content_get(){
		$this->response($this->contents->detail_get($this->get('contents_id')));
	}
}