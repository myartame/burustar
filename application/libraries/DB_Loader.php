<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DB_Loader{
	private $_db_pool;
	private $_CI;

	public function __construct(){
		$this->_CI =& get_instance();

		$this->_db_pool = array(
			'ko' => $this->_CI->load->database('ko', true),
			'en' => $this->_CI->load->database('en', true)
		);
	}

	public function get($database_name){
		return $this->_db_pool[$database_name];
	}
}

?>