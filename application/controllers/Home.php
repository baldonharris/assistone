<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')) redirect(base_url());
        $this->load->model('m_loans');
        $this->load->model('m_transactions');
        $this->load->model('m_returns');
        $this->load->model('m_payments');
	}
    
    /* <Helper Functions> */
    
    private function segregate_data($passed_data, $summary_group_by){
        if($summary_group_by == 'Month'){
            $data = [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00];
            for($x=0; $x<count($passed_data); $x++){
                $data[$passed_data[$x]['month']-1] = $passed_data[$x]['amount'];
            }
        }else{
            $amounts = [];
            $years = [];
            foreach($passed_data as $year => $amount){
                array_push($years, $year);
                array_push($amounts, $amount);
            }
            $data = [
                'amounts'   =>  $amounts,
                'years'     =>  $years
            ];
        }
        
        return $data;
    }
    
    private function generate_graph_data($condition, $summary_group_by){
        $param = [
            'transaction_summary'       =>  [],
            'approved_loans_summary'    =>  [],
            'returns_summary'           =>  []
        ];
        
        if($summary_group_by == 'Month'){
            $param = [
                'transaction_summary'       =>  ['Year(date_of_transaction)'    =>  date('Y')],
                'approved_loans_summary'    =>  ['Year(date_of_release)'        =>  date('Y')],
                'returns_summary'           =>  ['Year(p.actual_paid_date)'     =>  date('Y')]
            ];
        }
        
        if(!$condition){
            return [
                'transaction_summary'       =>  $this->get_transactions(
                    $param['transaction_summary'],
                    $summary_group_by),
                'approved_loans_summary'    =>  $this->get_approved_loans(
                    $param['approved_loans_summary'],
                    $summary_group_by),
                'returns_summary'           =>  $this->get_returns(
                    $param['returns_summary'],
                    $summary_group_by
                    ),
            ];
        }else{
            return [
                'transaction_summary'       =>  $this->get_transactions(
                    array_merge($condition['transaction_summary'], $param['transaction_summary']),
                    $summary_group_by),
                'approved_loans_summary'    =>  $this->get_approved_loans(
                    array_merge($condition['approved_loans_summary'], $param['approved_loans_summary']),
                    $summary_group_by),
                'returns_summary'           =>  $this->get_returns(
                    array_merge($condition['returns_summary'], $param['returns_summary']),
                    $summary_group_by
                    ),
            ];
        }
    }
    
    /* </Helper Functions> */
    
    /* <Widget Functions> */
    
    private function get_total_loan_reservation_amount(){
        $current_loan_reservations = $this->m_loans->get(['status'=>'reserved', 'date_of_application >='=>date('Y-m-d')]);
        $expired_loan_reservations = $this->m_loans->get(['status'=>'reserved', 'date_of_application <'=>date('Y-m-d')]);
        
        $total_current_reservation_amount = 0;
        $total_expired_reservation_amount = 0;
        
        for($x=0; $x<count($current_loan_reservations); $x++){
            $total_current_reservation_amount += $current_loan_reservations[$x]['amount_loan'];
        }
        
        for($x=0; $x<count($expired_loan_reservations); $x++){
            $total_expired_reservation_amount += $expired_loan_reservations[$x]['amount_loan'];
        }
        
        return [
            'current_loan_reservation_amount'   =>  number_format($total_current_reservation_amount),
            'expired_loan_reservation_amount'   =>  number_format($total_expired_reservation_amount)
        ];
    }
    
    private function get_cash_on_hand(){
        $cash_on_hand = 0;
        
        $transactions = $this->m_transactions->get();
        $paid_payments = $this->m_payments->get(NULL, NULL, TRUE, 'actual_paid_date IS NOT NULL');
        $released_loans = $this->m_loans->get(['status'=>'approved']);
        
        for($x=0; $x<count($transactions); $x++){
            if($transactions[$x]['type_transaction'] == 'I'){
                $cash_on_hand += $transactions[$x]['amount_transaction'];
            }else{
                $cash_on_hand -= $transactions[$x]['amount_transaction'];
            }
        }
        
        for($x=0; $x<count($paid_payments); $x++){
            $cash_on_hand += $paid_payments[$x]['amount_paid'];
        }
        
        for($x=0; $x<count($released_loans); $x++){
            $cash_on_hand -= $released_loans[$x]['amount_loan'];
        }
        
        return ['total_cash_on_hand'=>number_format($cash_on_hand)];
        
    }
    
    /* </Widget Functions> */
    
    /* <Graph Functions> */
    
    private function get_transactions($condition, $summary_group_by){
        $investment_summary = $this->m_transactions->get(array_merge($condition, ['type_transaction'=>'I']), $summary_group_by);
        $withdrawal_summary = $this->m_transactions->get(array_merge($condition, ['type_transaction'=>'W']), $summary_group_by);
        
        if($summary_group_by == 'Month'){
            $data = [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00];
            for($i=0; $i<count($investment_summary); $i++){
                for($w=0; $w<count($withdrawal_summary); $w++){
                    if($investment_summary[$i]['transaction_month'] == $withdrawal_summary[$w]['transaction_month']){
                        $investment_summary[$i]['transaction_amount'] -= $withdrawal_summary[$w]['transaction_amount'];
                    }
                    $investment_summary[$i]['transaction_amount'] += 0.00;
                }
                $data[$investment_summary[$i]['transaction_month']-1] = $investment_summary[$i]['transaction_amount'];
            }
        }else{
            $transaction_amounts = [];
            $years = [];
            for($i=0; $i<count($investment_summary); $i++){
                for($w=0; $w<count($withdrawal_summary); $w++){
                    if($investment_summary[$i]['transaction_year'] == $withdrawal_summary[$w]['transaction_year']){
                        $investment_summary[$i]['transaction_amount'] -= $withdrawal_summary[$w]['transaction_amount'];
                    }
                    $investment_summary[$i]['transaction_amount'] += 0.00;
                }
                $transaction_amounts[$i] = $investment_summary[$i]['transaction_amount'];
                $years[$i] = $investment_summary[$i]['transaction_year'];
            }
            $data = [
                'transaction_amounts'   =>  $transaction_amounts,
                'transaction_years'     =>  $years
            ];
        }
        
        return $data;
    }
    
    private function get_approved_loans($condition, $summary_group_by){
        $approved_loans = $this->m_loans->get(array_merge($condition, ['status'=>'approved']), $summary_group_by);
        return $this->segregate_data($approved_loans, $summary_group_by);
    }
    
    private function get_returns($condition, $summary_group_by){
        $returns = $this->m_returns->get($condition, $summary_group_by);  
        return $this->segregate_data($returns, $summary_group_by);
    }
    
    /* </Graph Functions> */
    
    public function init_data(){
        $total_reservation_amount = $this->get_total_loan_reservation_amount();
        
        echo json_encode(
            array_merge(
                $this->get_total_loan_reservation_amount(),
                $this->get_cash_on_hand(),
                $this->generate_graph_data(NULL, 'Month')
            )
        );
    }

	public function index()
	{
        $total_reservation_amount = $this->get_total_loan_reservation_amount();
		$this->generate_page('home/index', [
            'js'    =>  ['angular/home.js']
        ]);
	}
}
