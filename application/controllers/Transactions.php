<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')) redirect(base_url());
        $this->load->model('m_transactions');
        $this->load->model('m_payments');
    }

    public function add_transaction(){
        $errors = $this->validate();
        if(!empty($errors)){
            $toReturn = array('status'=>0, 'data'=>$errors);
        }else{
            $payments = array();
            $inputs = $this->format(0);
            $insert_transaction = $this->m_transactions->add($inputs);
            $toReturn = array('status'=>1, 'data'=>$insert_transaction);
        }
        echo json_encode($toReturn);
    }

    private function format($mode = 0 /* 0=create, 1=update */){
        $inputs = $this->input->post();
        $inputs['amount_transaction'] = str_replace("₱ ", "", $inputs['amount_transaction']);
        $inputs['amount_transaction'] = str_replace(",", "", $inputs['amount_transaction']);
        return $inputs;
    }

    private function validate(){
        $this->form_validation->set_rules('date_of_transaction', 'Date of Transaction', 'required');
        $this->form_validation->set_rules('amount_transaction', 'Amount Loan', 'required|callback_is_money_format');

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
