<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	private $filename = NULL;

	public function __construct(){
		parent::__construct();
		$this->load->model('m_account');
	}

	public function update_admin(){
		$errors = $this->validate('update');
		if(!empty($errors)){
			$toReturn = array('status'=>0, 'data'=>$errors);
		}else{
			$inputs = $this->format('update');
			$id = $inputs['id'];
			unset($inputs['id']);
			$updated = $this->m_account->update($id, $inputs);
			$toReturn = array('status'=>1, 'data'=>$updated);
		}
		echo json_encode($toReturn);
	}

	public function add_admin(){
		$errors = $this->validate();
		if(!empty($errors)){
			$toReturn = array('status'=>0, 'data'=>$errors);
		}else{
			$inputs = $this->format();
			$added = $this->m_account->add($inputs);
			$toReturn = array('status'=>1, 'data'=>$added);
		}
		echo json_encode($toReturn);
	}

	public function validate($mode = 'create'){
		$this->form_validation->set_rules('fullname', 'Fullname', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username');
		if($mode == 'create'){
			$this->form_validation->set_rules('password', 'Password', 'required');
		}
		if(isset($_FILES['dp'])){
			$upload = $this->do_upload();
		}else{
			$upload = NULL;
		}

		if($this->form_validation->run() === FALSE || is_array($upload)){
			if(is_array($upload)){
				$errors = array_merge($upload, $this->form_validation->error_array());
			}else{
				$errors = $this->form_validation->error_array();
			}
			return $errors;
		}else{
			$this->filename = $upload;
			return array();
		}
	}

	public function check_username($username){
		if($username == $this->session->userdata('username')){
			return TRUE;
		}else{
			$return_value = $this->m_account->check_username($username);
			if(!$return_value){
				$this->form_validation->set_message('check_username', 'Username is already taken.');
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}

	public function format($mode = 'create'){
		$input = $this->input->post();
		$input['fullname'] = ucwords($input['fullname']);

		if($mode == 'create'){
			$input['password'] = md5($input['password']);
		}else{
			if(empty($input['password']) == false){
				$input['password'] = md5($input['password']);
			}else{
				unset($input['password']);
			}
		}

		if($this->filename != NULL){
			$input['display_picture'] = $this->filename;
		}
		unset($input['dp']);
		return $input;
	}

	public function do_upload(){
		$config['upload_path'] = 'assets/images';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '2048';
		$config['max_width'] = '2047';
		$config['max_height'] = '1536';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		$errors = array();

		if(!$this->upload->do_upload('dp')){
			return array('dp'=>'Please follow the specifications below.');
		}
		$file = $this->upload->data();
		return $file['file_name'];
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