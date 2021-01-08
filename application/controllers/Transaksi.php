<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Transaksi_model');
		$this->load->model('Master_metode_pengiriman_model');
		if(!$this->session->userdata('login')){
			redirect(base_url('login'));
		}
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
					$data['metode_pengiriman']=$this->Master_metode_pengiriman_model->get_data();
				}
				else{
					unset($data['cart']);
				}
			}
		}
		$this->load->view('layout/wrapper', $data);
	}
	
	public function delete_item_cart($id_buku){
		if($this->session->userdata('cart')){
			$cart=$this->session->userdata('cart');
			$cart=array_diff($cart,array($id_buku));
			$this->session->set_userdata('cart',$cart);
		}
		redirect(base_url('transaksi/cart'));
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
	
	public function checkout(){
		if($this->session->userdata('cart')){
			$data=$this->input->post();
			$data['id_user']=$this->session->userdata('login')['id_user'];
			$cart=$this->session->userdata('cart');
			if($this->Transaksi_model->checkout($data,$cart)){
				redirect(base_url('transaksi/cart'));
			}
			else{
				redirect(base_url('transaksi/cart'));
			}
		}
		else{
			redirect(base_url('transaksi/cart'));
		}
	}
}
