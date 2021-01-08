<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Transaksi_model');
	}
	
	public function index()
	{
		$data=array('content'=>'kategori');
		$data['kategori']=$this->Transaksi_model->get_data();
		$this->load->view('layout/wrapper', $data);
	}

	public function cart(){
		$data=array('content'=>'cart');
		if($this->session->userdata('cart')){
			if($data['cart']=$this->Transaksi_model->get_cart($this->session->userdata('cart'))){
				if($data['cart']->num_rows()){
					$data['cart']=$data['cart']->result_array();
				}
				else{
					unset($data['cart']);
				}
			}
		}
		$this->load->view('layout/wrapper', $data);
	}
    
    public function add_cart($id_buku,$redirect=NULL){
		$i=0;
		if($this->session->userdata('cart')){
			$cart=$this->session->userdata('cart');
			if(in_array($id_buku,$cart)){
				echo "Batas peminjaman satu buku per judul per transaksi";
				exit;
			}
			$i=sizeof($cart);
		}
		$cart[$i]=$id_buku;
		$this->session->set_userdata('cart',$cart);
		if(isset($redirect)){
			redirect($redirect);
		}
		else{
			redirect(base_url('katalog'));
		}
    }
}
