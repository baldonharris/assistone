<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends MY_Controller {

	private $filename = NULL;

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')) redirect(base_url());
		$this->load->model('m_customers');
	}

	public function index()
	{
		$data['customers'] = $this->m_customers->get_customers_names();
		$this->generate_page('customers/listing', [
			'title'		=>'assistone | customers listing',
			'header'	=>'Customers',
			'subheader'	=>'Listing',
			'data'		=>$data,
			'js'		=>array('customers.js')]);
	}

	public function get_customer(){
		$id = $this->input->post('id');
		echo json_encode($this->m_customers->get(['c1.id'=>$id]));
	}

	public function add_customer(){
		$errors = $this->validate();
		if(!empty($errors)){
			echo json_encode($errors);
			return;
		}
		$added = $this->m_customers->add($this->format());
		echo json_encode($added);
	}

	public function validate(){
		$this->form_validation->set_rules('firstname', 'Firstname', 'required');
		$this->form_validation->set_rules('middlename', 'Middlename', 'required');
		$this->form_validation->set_rules('lastname', 'Lastname', 'required');
		$this->form_validation->set_rules('mobilenumber', 'Mobile Number', 'required|is_natural');
		$this->form_validation->set_rules('address', 'Address', 'required');
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

	public function format(){
		$input = $this->input->post();
		$input['firstname'] = ucwords($input['firstname']);
		$input['middlename'] = ucwords($input['middlename']);
		$input['lastname'] = ucwords($input['lastname']);
		$input['address'] = ucwords($input['address']);
		$input['display_picture'] = $this->filename;
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
			foreach(explode(',', $this->upload->display_errors('',',')) AS $err){
				if($err){
					$errors[] = $err;
				}
			}
			return $errors;
		}
		$file = $this->upload->data();
		return $file['file_name'];
	}
}
