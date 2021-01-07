<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct(){
		$this->CI =& get_instance();
        parent ::__construct();
		if($this->session->userdata('login')){
			redirect(base_url('dashboard'));
		}
	}
	
	public function index()
	{
		$this->load->model('User_model');
		switch($this->input->method()){
			case 'post':
				// if($this->User_model->login($this->input->post('username'),$this->input->post('password'))){
				// 	$response=array('message'=>'success');
				// }
				// else{
				// 	$response=array('message'=>'error');
				// }
				// echo json_encode($response);


				// $curl = curl_init();

				// curl_setopt_array($curl, [
				// 	CURLOPT_URL => "http://mhsmobile.amikom.ac.id/login",
				// 	CURLOPT_RETURNTRANSFER => true,
				// 	CURLOPT_ENCODING => "",
				// 	CURLOPT_MAXREDIRS => 10,
				// 	CURLOPT_TIMEOUT => 30,
				// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				// 	CURLOPT_CUSTOMREQUEST => "POST",
				// 	CURLOPT_POSTFIELDS => "username=17.11.1337&keyword=33410",
				// 	CURLOPT_HTTPHEADER => [
				// 		"Accept-Encoding: gzip",
				// 		"Content-Type: application/x-www-form-urlencoded",
				// 		"User-Agent: @m!k0mXv=#neMob!le"
				// 	],
				// ]);

				// $response = curl_exec($curl);
				// $err = curl_error($curl);

				// curl_close($curl);

				// if ($err) {
				// 	echo "cURL Error #:" . $err;
				// }
				// else {
				// 	echo $response;
				// }
				if($this->User_model->login($this->input->post('username'),$this->input->post('password'))){
					redirect(base_url('dashboard'));
				}
				else{
					redirect(base_url('login'));
				}
				break;
			default:
				$data=array('content'=>'login');
				$this->load->view('layout/wrapper', $data);
		}
	}
}
