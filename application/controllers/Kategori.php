<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Kategori_model');
	}
	
	public function index()
	{
		$data=array('content'=>'kategori');
		$data['kategori']=$this->Kategori_model->get_data();
		$this->load->view('layout/wrapper', $data);
	}
}
