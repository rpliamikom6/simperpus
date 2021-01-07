<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('login')){
			redirect(base_url('login'));
		}
	}
	
	public function index()
	{
		$data=array('content'=>'dashboard/dashboard');
		$this->load->view('layout/wrapper', $data);
    }
	
	public function detail($id=NULL){
		if(!isset($id)) show_404();
		$data=array('title'=>'Judul halaman','content'=>'detail');
		$this->load->view('layout/wrapper',$data);
	}
}
