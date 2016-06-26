<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends MY_Controller {

	private $filename = NULL;

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')) redirect(base_url());
		$this->load->model('m_customers');
	}

	public function index(){
		redirect(base_url('customers/listing'));
	}

	public function listing($page=0, $set_sortby=1, $set_orderby=2, $set_display=0){
		$next = $this->m_customers->get_next( ($page+1)*10, $set_sortby, $set_orderby, $set_display);
		if($page!=0){
			$prev = $this->m_customers->get_prev( ($page-1)*10, $set_sortby, $set_orderby, $set_display );
			$status['prev'] = (!$prev) ? 0 : 1;
		}else{
			$status['prev'] = 0;
		}

		$status['next'] = (!$next) ? 0 : 1;

		if($page == 0){
			$data['customers'] = $this->m_customers->get_customers_names(0, 0, $set_sortby, $set_orderby, $set_display);
		}else{
			$data['customers'] = $this->m_customers->get_customers_names(10, ($page*10), $set_sortby, $set_orderby, $set_display);
		}

		$data['guarantors'] = $this->m_customers->get_customers_names(0, 0, 1, 0, 0, 1);
		
		$this->generate_page('customers/listing', [
			'set_sortby'	=>$set_sortby,
			'set_orderby'	=>$set_orderby,
			'set_display'	=>$set_display,
			'title'			=>'assistone | customers listing',
			'header'		=>'Customers',
			'subheader'		=>'Listing',
			'page'			=>array('curr_page'=>$page, 'status'=>$status),
			'data'			=>$data,
			'js'			=>array('customers.js')]);
	}

	public function search($page=0, $set_sortby=1, $set_orderby=2, $set_display=0){
		if(empty($this->input->post('search_'))){
			redirect(base_url('customers/listing/0'.$set_sorby.'/'.$set_orderby.'/'.$set_display));
		}else{
			$status['prev'] = $status['next'] = 0;
			$data['customers'] = $this->m_customers->search($this->input->post('search_'));
			$data['guarantors'] = $this->m_customers->get_customers_names(0, 0, 1, 0, 0, 1);
			$this->generate_page('customers/listing', [
				'set_sortby'	=>$set_sortby,
				'set_orderby'	=>$set_orderby,
				'set_display'	=>$set_display,
				'title'			=>'assistone | customers listing',
				'header'		=>'Customers',
				'subheader'		=>'Listing',
				'page'			=>array('curr_page'=>0, 'status'=>$status),
				'data'			=>$data,
				'js'			=>array('customers.js')]);
		}
	}

	public function get_customer(){
		$id = $this->input->post('id');
		if(empty($id)){
			echo json_encode($this->m_customers->get(TRUE));
		}else{
			echo json_encode($this->m_customers->get(FALSE, ['c1.id'=>$id]));
		}
	}

	public function change_customer_status($curr_page, $set_sortby, $set_orderby, $set_display, $id, $status){
		$this->m_customers->change_status($id, $status);
		redirect('customers/listing/'.$curr_page.'/'.$set_sortby.'/'.$set_orderby.'/'.$set_display);
	}

	public function update_customer(){
		$errors = $this->validate();
		if(!empty($errors)){
			$toReturn = array('status'=>0, 'data'=>$errors);
		}else{
			$inputs = $this->format();
			$id = $inputs['id'];
			unset($inputs['id']);
			$added = $this->m_customers->update($id, $inputs);
			$added['name'] = $inputs['firstname']." ".$inputs['lastname'];
			$toReturn = array('status'=>1, 'data'=>$added);
		}	
		echo json_encode($toReturn);
	}

	public function add_customer(){
		$errors = $this->validate();
		if(!empty($errors)){
			$toReturn = array('status'=>0, 'data'=>$errors);
		}else{
			$inputs = $this->format();
			$added = $this->m_customers->add($inputs);
			$added['name'] = $inputs['firstname']." ".$inputs['lastname'];
			$toReturn = array('status'=>1, 'data'=>$added);
		}	
		echo json_encode($toReturn);
	}

	public function validate(){
		$this->form_validation->set_rules('firstname', 'Firstname', 'required');
		$this->form_validation->set_rules('middlename', 'Middlename', 'required');
		$this->form_validation->set_rules('lastname', 'Lastname', 'required');
		$this->form_validation->set_rules('mobilenumber', 'Mobile Number', 'required');
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

	public function format($mode = 'create'){
		$input = $this->input->post();
		$input['firstname'] = ucwords($input['firstname']);
		$input['middlename'] = ucwords($input['middlename']);
		$input['lastname'] = ucwords($input['lastname']);
		$input['address'] = ucwords($input['address']);
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
}
