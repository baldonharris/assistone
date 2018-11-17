<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loans extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')) redirect(base_url());
        $this->load->model('m_loans');
        $this->load->model('m_payments');
    }

    public function add_loan(){
        $errors = $this->validate('create');
        if(!empty($errors)){
            $toReturn = array('status'=>0, 'data'=>$errors);
        }else{
            $inputs = $this->format('create');
            $insert_loan = $this->m_loans->add($inputs);
            $insert_loan['total_interest_amount'] = $inputs['total_interest_amount'];
            $insert_loan['balance'] = $inputs['balance'];
            
            $toReturn = array('status'=>1, 'data'=>$insert_loan);
        }
        echo json_encode($toReturn);
    }
    
    public function update_loan(){
        if($this->input->post('status') == 'approved'){
            $errors = $this->validate('approved');
        }else{
            $errors = $this->validate('update');
        }
        
        if(!empty($errors)){
            $toReturn = array('status'=>0, 'data'=>$errors);
        }else{
            if($this->input->post('status') == 'approved'){
                $inputs = $this->format('approved');
                $this->calculate_payments($inputs);
            }else{
                $inputs = $this->format('update');
            }
            $this->m_loans->update($inputs);
            $toReturn = array('status'=>1, 'data'=>$inputs);
        }
        echo json_encode($toReturn);
    }
    
    private function calculate_payments($inputs){
        $payments = array();
        $base_date = $inputs['date_of_release'];
        for($x=0; $x<$inputs['number_of_terms']; $x++){
            if(date('j', strtotime($base_date)) >= 20 || date('j', strtotime($base_date)) >= 10 && date('j', strtotime($base_date)) <= 15){
                $base_date = date('Y-m-d', strtotime($base_date.' + 5 days'));
            }
            $day = date('j', strtotime($base_date));
            if($day < 15){
                $new_day = 15 - $day;
                $base_date = date('Y-m-d', strtotime($base_date.' + '.$new_day.' days'));		
            }else{
                $last_day = date('t', strtotime($base_date)) - $day;
                $base_date = date('Y-m-d', strtotime($base_date.' + '.$last_day.' days'));
            }
            $due_amount = round(($inputs['amount_loan'] + $inputs['total_interest_amount']) / $inputs['number_of_terms']);
            $due_amount_error = $due_amount - (($due_amount*$inputs['number_of_terms'])-($inputs['amount_loan']+$inputs['total_interest_amount']));
            array_push($payments, array(
                'loans_id'          => $inputs['id'],
                'due_date'          => $base_date,
                'due_amount'        => (($x==($inputs['number_of_terms']-1)) ? $due_amount_error : $due_amount),
                'running_balance'   => $inputs['balance']
            ));
        }
        if($payments[0]['due_amount'] < $payments[($inputs['number_of_terms']-1)]['due_amount']){
            $temp_first = $payments[0]['due_amount'];
            $payments[0]['due_amount'] = $payments[($inputs['number_of_terms']-1)]['due_amount'];
            $payments[($inputs['number_of_terms']-1)]['due_amount'] = $temp_first;
        }
        $this->m_payments->add($payments);
    }

    private function format($scenario = 'create' /* 0=add, 1=update */){
        $inputs = $this->input->post();
        $inputs['amount_loan'] = str_replace("₱ ", "", $inputs['amount_loan']);
        $inputs['amount_loan'] = str_replace(",", "", $inputs['amount_loan']);
        $inputs['interest_rate'] = str_replace(" %", "", $inputs['interest_rate']);
        $inputs['total_interest_amount'] = ($inputs['number_of_terms']/2) * ($inputs['interest_rate']/100) * $inputs['amount_loan'];
        $inputs['balance'] = ($inputs['total_interest_amount'] + $inputs['amount_loan']);
        
        if($scenario == 'create'){
            unset($inputs['id']);
        }
        return $inputs;
    }

    private function validate($scenario = 'create'){
        $this->form_validation->set_rules('date_of_application', 'Date of Application', 'required|callback_is_date_valid');
        $this->form_validation->set_rules('amount_loan', 'Amount Loan', 'required|callback_is_money_format');
        $this->form_validation->set_rules('interest_rate', 'Interest Rate', 'required|callback_is_money_format');
        $this->form_validation->set_rules('number_of_terms', 'Number of Terms', 'required|callback_is_money_format');
        
        if($scenario == 'approved'){
            $this->form_validation->set_rules('date_of_release', 'Date of Release', 'required|callback_is_date_valid');
        }

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
    
    public function is_date_valid($str){
        $error_counter = 0;
        $pieces = explode('-', $str);
        
        if($pieces[0] == '0000' || $pieces[1] == '00' || $pieces[2] == '00'){
            $this->form_validation->set_message('is_date_valid', 'Invalid date.');
            return FALSE;
        }
        return TRUE;
    }

}
