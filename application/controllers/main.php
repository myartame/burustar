<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Main extends REST_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->model('category', '', true);
		$this->load->model('contents', '', true);
		$this->load->model('user', '', true);
		$this->load->model('series', '', true);
	}

	public function index_get(){
		$this->load->view('index.html');
	}

	public function category_get(){
		$this->response($this->category->get());
	}

	public function contents_get(){
		$this->response($this->contents->get($this->get('state'), 
			$this->get('limit'), $this->get('offset')));
	}

	public function search_get(){
		$this->response($this->contents->search($this->get('data')));
	}

	public function user_post(){
		$this->response('user', $this->user->add($this->post('email'),
			$this->post('password'), $this->post('facebook_token'),
			$this->post('level')) ? 201 : 400);
	}

	public function series_get(){
		$this->response($this->series->list_get($this->get('kind'),
			$this->get('limit'), $this->get('offset')));
	}
}