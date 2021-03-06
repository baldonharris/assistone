<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Investors extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')) redirect(base_url());
		$this->load->model('m_loans');
        $this->load->model('m_payments');
		$this->load->model('m_penalties');
		$this->load->model('m_investors');
        $this->load->model('m_transactions');
        $this->load->model('m_returns');
    }
	
	public function index(){
		redirect(base_url('investors/listing'));
	}
	
	public function listing($page=0, $set_sortby=1, $set_orderby=2, $set_display=0){
		$next = $this->m_investors->get_next( ($page+1)*10, $set_sortby, $set_orderby, $set_display);
		if($page!=0){
			$prev = $this->m_investors->get_prev( ($page-1)*10, $set_sortby, $set_orderby, $set_display );
			$status['prev'] = (!$prev) ? 0 : 1;
		}else{
			$status['prev'] = 0;
		}

		$status['next'] = (!$next) ? 0 : 1;

		if($page == 0){
			$data['investors'] = $this->m_investors->get_investors_names(0, 0, $set_sortby, $set_orderby, $set_display);
		}else{
			$data['investors'] = $this->m_investors->get_investors_names(10, ($page*10), $set_sortby, $set_orderby, $set_display);
		}

		$data['guarantors'] = $this->m_investors->get_investors_names(0, 0, 1, 0, 0, 1);
		
		$this->generate_page('investors/listing', [
			'title'			=>'assistone | investors listing',
			'header'		=>'Investors',
			'subheader'		=>'Listing',
			'page'			=>array('curr_page'=>$page, 'status'=>$status),
			'data'			=>$data,
			'css'			=>array('customers.css', 'investors.css'),
			'js'			=>array('loans.js', 'payments.js', 'investors.js', 'transactions.js')]);
	}
	
	public function get_investor(){
		$id = $this->input->post('id');
		if(empty($id)){
            echo json_encode(array(
                'investor_detail'	=>	$this->m_investors->get(TRUE),
                'transaction_detail'=>  $this->m_transactions->get(),
            ));
		}else{
            $transaction_detail = $this->m_transactions->get(['l.investor_id'=>$id]);
            $total_investment = 0;
            for($x=0; $x<count($transaction_detail); $x++){
                $total_investment += ($transaction_detail[$x]['type_transaction'] == 'I') ? $transaction_detail[$x]['amount_transaction'] : '';
            }
            
            $return_detail = $this->m_returns->get(['r.investors_id'=>$id]);
            $total_return = 0;
            for($x=0; $x<count($return_detail); $x++){
                if(!strcmp($return_detail[$x]['type_transaction'], "I")){
                    $total_return += $return_detail[$x]['returns'];    
                }else{
                    $total_return -= $return_detail[$x]['returns'];
                }
            }
            
			echo json_encode(array(
                'investor_detail'	      =>  $this->m_investors->get(FALSE, ['c1.id'=>$id]),
                'transaction_detail'      =>  $transaction_detail,
                'total_investment'        =>  $total_investment,
                'total_investment_return' =>  $total_return
            ));
		}
	}
	
	public function add_investor(){
		$errors = $this->validate();
		if(!empty($errors)){
			$toReturn = array('status'=>0, 'data'=>$errors);
		}else{
			$inputs = $this->format();
			$added = $this->m_investors->add($inputs);
			$added['name'] = $inputs['firstname']." ".$inputs['lastname'];
			$toReturn = array('status'=>1, 'data'=>$added);
		}	
		echo json_encode($toReturn);
	}
	
	public function update_investor(){
		$errors = $this->validate();
		if(!empty($errors)){
			$toReturn = array('status'=>0, 'data'=>$errors);
		}else{
			$inputs = $this->format();
			$id = $inputs['id'];
			unset($inputs['id']);
			$added = $this->m_investors->update($id, $inputs);
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
