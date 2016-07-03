<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends MY_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')) redirect(base_url());
		$this->load->model('m_payments');
	}

	public function get_payment(){
		$id = $this->input->post('id');
		echo json_encode(array('status'=>1, 'data'=>$this->m_payments->get($id)));
	}

}
