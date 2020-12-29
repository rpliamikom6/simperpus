<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
	}
	
	public function index()
	{
		$data=array('content'=>'home');
		$this->load->view('layout/wrapper', $data);
    }
    
    public function buku($id=Null){
        if(!isset($id)) show_404();
	}
	
	public function detail($id=NULL){
		if(!isset($id)) show_404();
		$data=array('title'=>'Judul halaman','content'=>'detail');
		$this->load->view('layout/wrapper',$data);
	}
}
