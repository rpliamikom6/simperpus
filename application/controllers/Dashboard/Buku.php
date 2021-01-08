<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('login')){
			redirect(base_url('login'));
		}
		else{
			$this->load->model('Katalog_model');
			$this->load->model('Kategori_model');
			$this->load->model('Penerbit_model');
		}
	}
	
	public function index()
	{
		$data=array('content'=>'dashboard/buku');
		$data['buku']=$this->Katalog_model->get_data();
		$this->load->view('layout/wrapper', $data);
	}
	
	public function tambah()
	{
		switch($this->input->method()){
			case 'post':
				$data=$this->input->post();
				if($this->Katalog_model->add($data)){
					redirect(base_url('dashboard/buku'));
				}
				else{
					redirect(base_url('dashboard/buku'));
				}
				break;
			default:
				$data=array('content'=>'dashboard/buku_form');
				$data['penerbit']=$this->Penerbit_model->get_data();
				$data['kategori']=$this->Kategori_model->get_data();
				$this->load->view('layout/wrapper', $data);
		}
    }
	
	public function ubah($id=NULL)
	{
		switch($this->input->method()){
			case 'post':
				$data=$this->input->post();
				if($this->Katalog_model->edit($id,$data)){
					redirect(base_url('dashboard/buku'));
				}
				else{
					redirect(base_url('dashboard/buku'));
				}
				break;
			default:
				if(!isset($id)) show_404();
				$data=array('content'=>'dashboard/buku_form');
				$data['buku']=$this->Katalog_model->get_data($id,1);
				if($data['buku']->num_rows()){
					$data['buku']=$data['buku']->result_array()[0];
					$data['penerbit']=$this->Penerbit_model->get_data();
					$data['kategori']=$this->Kategori_model->get_data();
					$data['detail_buku']=$this->Katalog_model->get_detail_buku($id);
				}
				else{
					show_404();
				}
				$this->load->view('layout/wrapper', $data);
		}
	}

	public function hapus_detail($id_buku=NULL,$detail=NULL){
		if(!isset($id_buku) || !isset($detail)) show_404();

		if($this->Katalog_model->hapus_detail($id_buku,$detail)){
			$response['meta_data']=array(
				'message'=>'success',
				'code'=>200
			);
		}
		else{
			$response['meta_data']=array(
				'message'=>'error',
				'code'=>400
			);
		}
		http_response_code($response['meta_data']['code']);
		echo json_encode($response);
	}
	
	public function hapus($id=NULL){
		if(!isset($id)) show_404();

		if($this->Katalog_model->delete($id)){
			redirect(base_url('dashboard/buku'));
		}
		else{
			redirect(base_url('dashboard/buku'));
		}
	}
	
	public function detail($id=NULL){
		if(!isset($id)) show_404();
		$data=array('title'=>'Judul halaman','content'=>'detail');
		$this->load->view('layout/wrapper',$data);
	}
}
