<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')) redirect(base_url());
        $this->load->model('m_payments');
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
