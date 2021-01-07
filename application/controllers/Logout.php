<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	
	public function __construct(){
		$this->CI =& get_instance();
        parent ::__construct();
		if(!$this->session->userdata('login')){
			redirect(base_url('login'));
		}
	}
	
	public function index()
	{
		session_destroy();
		redirect(base_url('login'));
	}
}
