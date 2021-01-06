<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

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
    
    public function add_cart($id_buku,$redirect=NULL){
        if(!is_null(get_cookie('cart'))){
            $cart=get_cookie('cart');
        }

        set_cookie('cart','cookie_value','86400');
    }
}
