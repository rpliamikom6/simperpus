<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Katalog extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Katalog_model');
	}
	
	public function index()
	{
		$data=array('content'=>'katalog');
		$data['home']=$this->Katalog_model->get_data();
		$this->load->view('layout/wrapper', $data);
	}
	
	public function kategori($id=NULL){
		if(!isset($id)) show_404();
		$data=array('content'=>'katalog');
		$data['books']=$this->Katalog_model->get_data($id);
		$this->load->view('layout/wrapper', $data);
	}
	
	public function detail($id=NULL){
		if(!isset($id)) show_404();
		$data=array('title'=>'Judul halaman','content'=>'detail');
		$data['katalog']=$this->Katalog_model->get_data($id);
		if($data['katalog']->num_rows()){
			$data['detail']=$this->Katalog_model->get_data_detail_buku($id);
			$this->load->view('layout/wrapper',$data);
		}
		else{
			echo show_404();
		}
	}
}
