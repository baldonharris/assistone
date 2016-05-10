<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_account');
	}

	public function login(){
		$input = $this->input->post();
		$input['password'] = md5($input['password']);
		$data = $this->m_account->login($input);
		if($data->num_rows()){
			$this->session->set_userdata($data->result_array()[0]);
			echo 1;
		}else{
			echo 0;
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}