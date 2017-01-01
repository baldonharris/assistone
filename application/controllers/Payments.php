<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')) redirect(base_url());
		$this->load->model('m_loans');
        $this->load->model('m_payments');
    }
	
	public function recalculate_payment($inputs, $payoff_information=0){
		$payments = array();
		$inputs['total_interest_amount'] = ($inputs['number_of_terms']/2) * ($inputs['interest_rate']/100) * $inputs['amount_loan'];
		$base_date = $inputs['date_of_release'];
		$loan_essentials['total_interest_amount'] = $inputs['total_interest_amount'];
        $loan_essentials['balance'] = $inputs['balance'];
		
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
				'loans_id'          => (($payoff_information) ? $inputs['id'] : $loan_essentials['id']),
				'due_date'          => $base_date,
				'due_amount'        => (($x==($inputs['number_of_terms']-1)) ? $due_amount_error : $due_amount),
				'running_balance'   => (($payoff_information) ? (($x==($inputs['number_of_terms']-1)) ? $due_amount_error : $due_amount) : (($x==0) ? $loan_essentials['balance'] : 0.00))
			));
		}
		
		return $payments;
	}
	
	public function payoff_information(){
		$id = $this->input->post('id');
        $payments = $this->m_payments->get($id);
		$loan_info = $this->m_loans->get(array('id'=>$id));
		$total_payments_amount = 0;
		for($x=0; $x<count($payments); $x++){
			if(empty($payments[$x]['actual_paid_date'])){
				$new_number_of_terms = $x+1;
				break;
			}else{
				$total_payments_amount += $payments[$x]['amount_paid'];
			}
		}
		$loan_info[0]['number_of_terms'] = $new_number_of_terms;
		$payoff_information = $this->recalculate_payment($loan_info[0], 1);
		
		$total_payoff_information = 0;
		foreach($payoff_information as $sub_payoff){
			$total_payoff_information += $sub_payoff['due_amount'];
		}

		$final_payoff_information = array(
			'due_amount'		=> $total_payoff_information,
			'total_amount_paid' => $total_payments_amount,
			'payoff_amount'		=> $total_payoff_information - $total_payments_amount
		);
		
		echo json_encode(array('status'=>1, 'data'=>$final_payoff_information));
    }

    public function get_payment(){
        $id = $this->input->post('id');
        $data = $this->m_payments->get($id);
        $check_index = 0;
        for($x=0; $x<count($data); $x++){
            if($data[$x]['amount_paid'] == 0){
                $check_index = $x++;
                break;
            }
        }
        
        echo json_encode(array('status'=>1, 'data'=>$data));
    }
    
    public function add_payment(){     
        $data['actual_paid_date']   =   $this->input->post('payment_actual_paid_date');
        $data['amount_paid']        =   str_replace(",", "", str_replace("₱ ", "", $this->input->post('payment_amount_paid')));
        $data['payment_balance']    =   str_replace(",", "", $this->input->post('payment_payment_balance'));
        $data['running_balance']    =   str_replace(",", "", $this->input->post('payment_running_balance'));
        $data['id']                 =   $this->input->post('id');
        $this->m_payments->update($data);
        $this->m_payments->update(array('id'=>($data['id']+1),'running_balance'=>$data['running_balance']));
    }

}
