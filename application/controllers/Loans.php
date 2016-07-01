<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loans extends MY_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')) redirect(base_url());
		$this->load->model('m_loans');
	}

	public function add_loan(){
		$errors = $this->validate();
		if(!empty($errors)){
			$toReturn = array('status'=>0, 'data'=>$errors);
		}else{
			$inputs = $this->format(0);
			$insert_loan = $this->m_loans->add($inputs);
			$insert_loan['total_interest_amount'] = $inputs['total_interest_amount'];
			$insert_loan['balance'] = $inputs['balance'];
			$toReturn = array('status'=>1, 'data'=>$insert_loan);
		}
		echo json_encode($toReturn);
	}

	private function format($mode = 0 /* 0=create, 1=update */){
		$inputs = $this->input->post();
		$inputs['amount_loan'] = str_replace("₱ ", "", $inputs['amount_loan']);
		$inputs['amount_loan'] = str_replace(",", "", $inputs['amount_loan']);
		$inputs['interest_rate'] = str_replace(" %", "", $inputs['interest_rate']);
		$inputs['total_interest_amount'] = $inputs['number_of_terms'] * ($inputs['interest_rate']/100) * $inputs['amount_loan'];
		$inputs['total_payments'] = (!$mode) ? 0 : 1; // should change 1 later for the real total_payments
		$inputs['balance'] = ($inputs['total_interest_amount'] + $inputs['amount_loan']) - $inputs['total_payments'];
		return $inputs;
	}

	private function validate(){
		$this->form_validation->set_rules('date_of_application', 'Date of Application', 'required');
		$this->form_validation->set_rules('date_of_release', 'Date of Release', 'required');
		$this->form_validation->set_rules('amount_loan', 'Amount Loan', 'required|callback_is_money_format');
		$this->form_validation->set_rules('interest_rate', 'Interest Rate', 'required|callback_is_money_format');
		$this->form_validation->set_rules('number_of_terms', 'Number of Terms', 'required|callback_is_money_format');

		if($this->form_validation->run() === FALSE){
			return $this->form_validation->error_array();
		}
		return array();
	}

	public function is_money_format($str){
		$str = str_replace("₱ ", "", $str);
		$str = str_replace(" %", "", $str);

		if(preg_match("/\b\d{1,3}(?:,?\d{3})*(?:\.\d{2})?\b/", $str)){
			return TRUE;
		}

		$this->form_validation->set_message('is_money_format', 'Invalid format.');
		return FALSE;
	}

}
