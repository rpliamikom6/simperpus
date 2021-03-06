<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_metode_pengiriman extends CI_Controller {

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
				$this->load->model('Master_metode_pengiriman_model');
			}
		}
	}
	
	public function index()
	{
		$data=array('content'=>'dashboard/master_metode_pengiriman');
		$data['master_metode_pengiriman']=$this->Master_metode_pengiriman_model->get_data();
		$this->load->view('layout/wrapper', $data);
	}
	
	public function tambah()
	{
		switch($this->input->method()){
			case 'post':
				$data=$this->input->post();
				if($this->Master_metode_pengiriman_model->add($data)){
					redirect(base_url('dashboard/master_metode_pengiriman'));
				}
				else{
					redirect(base_url('dashboard/master_metode_pengiriman'));
				}
				break;
			default:
				$data=array('content'=>'dashboard/master_metode_pengiriman_form');
				$this->load->view('layout/wrapper', $data);
		}
    }
	
	public function ubah($id=NULL)
	{
		switch($this->input->method()){
			case 'post':
				$data=$this->input->post();
				if($this->Master_metode_pengiriman_model->edit($id,$data)){
					redirect(base_url('dashboard/master_metode_pengiriman'));
				}
				else{
					redirect(base_url('dashboard/master_metode_pengiriman'));
				}
				break;
			default:
				if(!isset($id)) show_404();
				$data=array('content'=>'dashboard/master_metode_pengiriman_form');
				$data['master_metode_pengiriman']=$this->Master_metode_pengiriman_model->get_data($id,1);
				if($data['master_metode_pengiriman']->num_rows()){
					$data['master_metode_pengiriman']=$data['master_metode_pengiriman']->result_array()[0];
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

		if($this->Master_metode_pengiriman_model->delete($id)){
			redirect(base_url('dashboard/master_metode_pengiriman'));
		}
		else{
			redirect(base_url('dashboard/master_metode_pengiriman'));
		}
	}
	
	public function detail($id=NULL){
		if(!isset($id)) show_404();
		$data=array('title'=>'Judul halaman','content'=>'detail');
		$this->load->view('layout/wrapper',$data);
	}
}
