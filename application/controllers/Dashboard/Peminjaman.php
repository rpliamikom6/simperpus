<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('login')){
			redirect(base_url('login'));
		}
		else{
			$this->load->model('Transaksi_model');
			$this->load->model('Master_metode_pengiriman_model');
		}
	}
	
	public function index()
	{
		$data=array('content'=>'dashboard/peminjaman');
		if($this->session->userdata('login')['is_admin']!=1){
			$data['peminjaman']=$this->Transaksi_model->get_data_by_user($this->session->userdata('login')['id_user']);
		}
		else{
			$data['peminjaman']=$this->Transaksi_model->get_data();
		}
		$this->load->view('layout/wrapper', $data);
	}

	public function detail($id=NULL){
		if(!isset($id)) show_404();
		$data=array('title'=>'Judul halaman','content'=>'dashboard/peminjaman_detail');
		$data['peminjaman']=$this->Transaksi_model->get_data($id,1);
		if(!$data['peminjaman']->num_rows()){
			show_404();
		}
		else{
			$data['peminjaman']=$data['peminjaman']->result_array()[0];
			if($data['items']=$this->Transaksi_model->get_detail($data['peminjaman']['id_transaksi'])){
				$data['metode_pengiriman']=$this->Master_metode_pengiriman_model->get_data();
				$this->load->view('layout/wrapper',$data);
			}
			else{
				show_404();
			}
		}
	}
	
	public function tambah()
	{
		if($this->session->userdata('login')['is_admin']!=1){
			redirect(base_url('dashboard/peminjaman'));
		}
		else{
			switch($this->input->method()){
				case 'post':
					$data=$this->input->post();
					if($this->Transaksi_model->add($data)){
						redirect(base_url('dashboard/peminjaman'));
					}
					else{
						redirect(base_url('dashboard/peminjaman'));
					}
					break;
				default:
					$data=array('content'=>'dashboard/peminjaman_form');
					$this->load->view('layout/wrapper', $data);
			}
		}
    }
	
	public function ubah($id=NULL)
	{
		if($this->session->userdata('login')['is_admin']!=1){
			redirect(base_url('dashboard/peminjaman'));
		}
		else{
			switch($this->input->method()){
				case 'post':
					$data=$this->input->post();
					if($this->Transaksi_model->edit($id,$data)){
						redirect(base_url('dashboard/peminjaman'));
					}
					else{
						redirect(base_url('dashboard/peminjaman'));
					}
					break;
				default:
					if(!isset($id)) show_404();
					$data=array('content'=>'dashboard/peminjaman_form');
					$data['peminjaman']=$this->Transaksi_model->get_data($id,1);
					if($data['peminjaman']->num_rows()){
						$data['peminjaman']=$data['peminjaman']->result_array()[0];
					}
					else{
						show_404();
					}
					$this->load->view('layout/wrapper', $data);
			}
		}
	}

	public function hapus_detail($id_buku=NULL,$detail=NULL){
		if($this->session->userdata('login')['is_admin']!=1){
			redirect(base_url('dashboard/peminjaman'));
		}
		else{
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
	}
	
	public function hapus($id=NULL){
		if($this->session->userdata('login')['is_admin']!=1){
			redirect(base_url('dashboard/peminjaman'));
		}
		else{
			if(!isset($id)) show_404();
	
			if($this->Transaksi_model->delete($id)){
				redirect(base_url('dashboard/peminjaman'));
			}
			else{
				redirect(base_url('dashboard/peminjaman'));
			}
		}
	}

	public function konfirmasi_peminjaman($id_transaksi=NULL,$status=NULL){
		if($this->session->userdata('login')['is_admin']!=1){
			redirect(base_url('dashboard/peminjaman'));
		}
		else{
			if(!isset($id_transaksi) || !isset($status)) show_404();
	
			if($this->Transaksi_model->konfirmasi_peminjaman($id_transaksi,$status)){
				redirect(base_url('dashboard/peminjaman/detail/'.$id_transaksi));
			}
			else{
				redirect(base_url('dashboard/peminjaman'));
			}
		}
	}

	public function konfirmasi_pengembalian($id_transaksi=NULL){
		if($this->session->userdata('login')['is_admin']!=1){
			redirect(base_url('dashboard/peminjaman'));
		}
		else{
			if(!isset($id_transaksi)) show_404();
	
			if($this->Transaksi_model->konfirmasi_pengembalian($id_transaksi)){
				redirect(base_url('dashboard/peminjaman/detail/'.$id_transaksi));
			}
			else{
				redirect(base_url('dashboard/peminjaman'));
			}
		}
	}

	public function konfirmasi_pengiriman($id_transaksi=NULL){
		if(!isset($id_transaksi)) show_404();

		if($this->Transaksi_model->konfirmasi_pengiriman($id_transaksi)){
			redirect(base_url('dashboard/peminjaman/detail/'.$id_transaksi));
		}
		else{
			redirect(base_url('dashboard/peminjaman'));
		}
	}

	public function input_resi_peminjaman($id_transaksi=NULL){
		if($this->session->userdata('login')['is_admin']!=1){
			redirect(base_url('dashboard/peminjaman'));
		}
		else{
			if(!isset($id_transaksi)) show_404();
	
			$resi=$this->input->post('resi_pengiriman');
	
			if($this->Transaksi_model->input_resi_peminjaman($id_transaksi,$resi)){
				redirect(base_url('dashboard/peminjaman/detail/'.$id_transaksi));
			}
			else{
				redirect(base_url('dashboard/peminjaman'));
			}
		}
	}

	public function input_resi_pengembalian($id_transaksi=NULL){
		if($this->session->userdata('login')['is_admin']==1){
			redirect(base_url('dashboard/peminjaman'));
		}
		else{
			if(!isset($id_transaksi)) show_404();
	
			$resi['id_metode_pengembalian']=$this->input->post('id_metode_pengembalian');
			$resi['resi_pengembalian']=$this->input->post('resi_pengembalian');
	
			if($this->Transaksi_model->input_resi_pengembalian($id_transaksi,$resi)){
				redirect(base_url('dashboard/peminjaman/detail/'.$id_transaksi));
			}
			else{
				redirect(base_url('dashboard/peminjaman'));
			}
		}
	}
}
