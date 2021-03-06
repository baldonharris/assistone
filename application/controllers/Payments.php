<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')) redirect(base_url());
		$this->load->model('m_loans');
        $this->load->model('m_payments');
		$this->load->model('m_penalties');
        $this->load->model('m_returns');
        $this->load->model('m_transactions');
        $this->load->model('m_buckets');
        $this->load->model('m_effectivities');
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
	
	public function payoff_information($mode = 0, $passed_id = 0){
		$id = (!$mode) ? $this->input->post('id') : $passed_id;
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
		
		if(!$mode){
			echo json_encode(array('status'=>1, 'data'=>$final_payoff_information));
		}else{
			return $final_payoff_information;
		}
    }

    public function get_payment(){
        $id = $this->input->post('id');
        $data = $this->m_payments->get($id);
        $check_index = 0;
        if($id != NULL){
            for($x=0; $x<count($data); $x++){
                if($data[$x]['amount_paid'] == 0){
                    $check_index = $x++;
                    break;
                }
            }
        }
        echo json_encode(array('status'=>1, 'data'=>$data));
    }
	
	public function calculate_penalty($data){
		$loan_details = $this->m_loans->get(array('id'=>$data['loans_id']));
		$interest_rate_by_two = ($loan_details[0]['interest_rate'])/100;
		return $data['penalty']*$interest_rate_by_two; 
	}
    
    public function calculate_returns($loans_id, $payments_id){
        $dummy_container = array();
        
        /* get things ready */
        
        $loan_info              = $this->m_loans->get(['id'=>$loans_id]);
        $transactions_involved  = $this->m_transactions->get('l.date_of_transaction <= "'.$loan_info[0]['date_of_release'].'"');
        $effectivity            = $this->m_effectivities->get(['status'=>'active'])[0];
        $buckets                = $this->m_buckets->get(['effectivities_id'=>$effectivity['id']]);
        
        $total_investments = 0;
        $divided_interest_amount = ($loan_info[0]['total_interest_amount'] / $loan_info[0]['number_of_terms']);
        
        foreach($transactions_involved as $transaction){
            $total_investments += $transaction['amount_transaction'];
        }
        
        foreach($buckets as $bucket){
            $planned_return = ($bucket['percentage']/100) * $divided_interest_amount;
            if($bucket['bucket_name'] != 'Investors'){
                array_push($dummy_container, array(
                    'loans_id'          =>  $loans_id,
                    'payments_id'       =>  $payments_id,
                    'investors_id'      =>  0,
                    'transactions_id'   =>  0,
                    'buckets_id'        =>  $bucket['id'],
                    'percentage'        =>  $bucket['percentage']/100,
                    'returns'           =>  $planned_return
                ));
            }else{
                foreach($transactions_involved as $transaction){
                    $transaction_percentage = ($transaction['amount_transaction']/$total_investments);
                    array_push($dummy_container, array(
                        'loans_id'          =>  $loans_id,
                        'payments_id'       =>  $payments_id,
                        'investors_id'      =>  $transaction['investor_id'],
                        'transactions_id'   =>  $transaction['id'],
                        'buckets_id'        =>  $bucket['id'],
                        'percentage'        =>  $transaction_percentage,
                        'returns'           =>  $transaction_percentage * $planned_return
                    ));
                };
            }
        }
        
        return $dummy_container;
    }
    
    public function add_payment(){ 
		$errors = $this->validate();
		if(!empty($errors)){
			$toReturn = array('status'=>0, 'data'=>$errors);
		}else{
			$current_due_amount         = str_replace(",", "", $this->input->post('current_due_amount'));
			$loans_id                   = $this->input->post('payment-loan-id');
			$payment_information        = $this->payoff_information(1, $loans_id);
			$data['actual_paid_date']   = $this->input->post('payment_actual_paid_date');
			$data['amount_paid']        = str_replace(",", "", str_replace("₱ ", "", $this->input->post('payment_amount_paid')));
			$data['payment_balance']    = str_replace(",", "", $this->input->post('payment_payment_balance'));
			$data['running_balance']    = str_replace(",", "", $this->input->post('payment_running_balance'));
			$data['id']                 = $this->input->post('id');
			
			$init_penalty_amt = $current_due_amount - $data['amount_paid'];
			
			if($init_penalty_amt > 0){
				$penalty = $this->calculate_penalty(array('loans_id'=>$loans_id, 'penalty'=>$init_penalty_amt));
				$this->m_penalties->add(array(
					'payments_id'	=>	($data['id']+1),
					'date'			=>	$data['actual_paid_date'],
					'description'	=>	"",
					'amount'		=>	$penalty
				));
				$next_payment = $this->m_payments->get(($data['id']+1), 1)[0];
				$this->m_payments->update(array(
					'id'				=>	($data['id']+1),
					'due_amount'		=>	($next_payment['due_amount']+($current_due_amount-$data['amount_paid'])+$penalty),
					'running_balance'	=>	($data['running_balance']+$penalty)
				));
			}
			$this->m_payments->update($data);
			$this->m_loans->update(array('id'=>$loans_id, 'balance'=>$data['running_balance']));
		
			$data['loans_id'] = $loans_id;

			if($data['amount_paid'] == $payment_information['payoff_amount']){
				$this->m_loans->update(array('id'=>$loans_id, 'balance'=>0.00));
			}
    
            // returns here
            $calculated_return = $this->calculate_returns($loans_id, $data['id']);
            $this->m_returns->add($calculated_return);
			
			$toReturn = array('status'=>1, 'data'=>$data);
		}
		echo json_encode($toReturn);
    }
	
	public function validate(){
		$this->form_validation->set_rules('payment_actual_paid_date', 'Pay Date', 'required');
		$this->form_validation->set_rules('payment_amount_paid', 'Amount Pay', 'required');
	
		if($this->form_validation->run() === FALSE){
			return $this->form_validation->error_array();
		}
		return array();
	}

}
