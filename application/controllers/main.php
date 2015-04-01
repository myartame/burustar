<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Main extends REST_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->model('category', '', true);
	}

	public function index(){
	}

	public function category_get(){
		$this->response($this->category->get());
	}
}