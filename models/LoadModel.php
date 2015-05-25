<?php
class LoadModel{
	public $error = array();
	public $img;
	public $pass;
	public $email;
	public $data = array();
	public $report = array();
	public $url;
	
	public function render($file) {
		ob_start();
		include_once($file);
		return ob_get_clean();
	}
}