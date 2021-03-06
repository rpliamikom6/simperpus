<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('login')){
			redirect(base_url('login'));
		}
		else{
			if($this->session->userdata('login')['is_admin']!=1){
				redirect(base_url('dashboard'));
			}
			else{
				$this->load->model('Kategori_model');
			}
		}
	}
	
	public function index()
	{
		$data=array('content'=>'dashboard/kategori');
		$data['kategori']=$this->Kategori_model->get_data();
		$this->load->view('layout/wrapper', $data);
	}
	
	public function tambah()
	{
		switch($this->input->method()){
			case 'post':
				$data=$this->input->post();
				if($this->Kategori_model->add($data)){
					redirect(base_url('dashboard/kategori'));
				}
				else{
					redirect(base_url('dashboard/kategori'));
				}
				break;
			default:
				$data=array('content'=>'dashboard/kategori_form');
				$this->load->view('layout/wrapper', $data);
		}
    }
	
	public function ubah($id=NULL)
	{
		switch($this->input->method()){
			case 'post':
				$data=$this->input->post();
				if($this->Kategori_model->edit($id,$data)){
					redirect(base_url('dashboard/kategori'));
				}
				else{
					redirect(base_url('dashboard/kategori'));
				}
				break;
			default:
				if(!isset($id)) show_404();
				$data=array('content'=>'dashboard/kategori_form');
				$data['kategori']=$this->Kategori_model->get_data($id,1);
				if($data['kategori']->num_rows()){
					$data['kategori']=$data['kategori']->result_array()[0];
				}
				else{
					show_404();
				}
				$this->load->view('layout/wrapper', $data);
		}
	}
	
	public function hapus($id=NULL){
		if(!isset($id)) show_404();

		if($this->Kategori_model->delete($id)){
			redirect(base_url('dashboard/kategori'));
		}
		else{
			redirect(base_url('dashboard/kategori'));
		}
	}
}
