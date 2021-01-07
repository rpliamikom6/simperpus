<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Master_person_model');
	}
	
	public function index()
	{
		$data=array('content'=>'dashboard/user');
		$data['user']=$this->User_model->get_data();
		$this->load->view('layout/wrapper', $data);
	}
	
	public function tambah()
	{
		switch($this->input->method()){
			case 'post':
				$data=$this->input->post();
				if($this->User_model->add($data)){
					echo 'Berhasil';
				}
				else{
					echo 'Gagal';
				}
				break;
			default:
				$data=array('content'=>'dashboard/user_form');
				$data['master_person']=$this->Master_person_model->get_data();
				$this->load->view('layout/wrapper', $data);
			}
		}
		
		public function ubah($id=NULL)
		{
		switch($this->input->method()){
			case 'post':
				$data=$this->input->post();
				if($this->User_model->edit($id,$data)){
					echo 'Berhasil';
				}
				else{
					echo 'Gagal';
				}
				break;
				default:
				if(!isset($id)) show_404();
				$data=array('content'=>'dashboard/user_form');
				$data['user']=$this->User_model->get_data($id,1);
				if($data['user']->num_rows()){
					$data['user']=$data['user']->result_array()[0];
					$data['master_person']=$this->Master_person_model->get_data();
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

		if($this->User_model->delete($id)){
			echo "Berhasil";
		}
		else{
			echo "Gagal";
		}
	}
	
	public function detail($id=NULL){
		if(!isset($id)) show_404();
		$data=array('title'=>'Judul halaman','content'=>'detail');
		$this->load->view('layout/wrapper',$data);
	}
}
