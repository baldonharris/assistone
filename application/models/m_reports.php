<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Reports extends CI_Model {
    
    public function get_raw_collection_statement($where = NULL){
        $this->db->order_by('p.id', 'ASC');
        $this->db->select('l.id as loan_id, p.id as payment_id, p.due_amount as payment_due_amount, p.actual_paid_date as payment_actual_paid_date, p.amount_paid, p.due_date');
        $this->db->join('payments as p', 'p.loans_id=l.id', 'left');
        if(!$where){
            return $this->db->get('loans as l')->result_array();
        }else{
            return $this->db->get_where('loans as l', $where)->result_array();
        }
    }

    public function get_collection_statement($where = NULL){
        $this->db->order_by('p.id', 'ASC');
        $this->db->select("l.id, p.id as payment_id, l.loan_id as loan_id, concat(c.firstname,' ',c.lastname) as customer_name, l.date_of_release, l.amount_loan, l.balance as current_balance, p.amount_paid");
        $this->db->join('customers as c', 'c.id=l.customer_id', 'left');
        $this->db->join('payments as p', 'p.loans_id=l.id', 'left');
        if(!$where){
            return $this->db->get('loans as l')->result_array();
        }else{
            return $this->db->get_where('loans as l', $where)->result_array();
        };
    }
    
    public function get_total_paid_amount($where = NULL){
        $this->db->order_by('p.id', 'ASC');
        $this->db->select('sum(p.amount_paid) as total_amount_paid');
        if(!$where){
            return $this->db->get('payments as p')->result_array();
        }else{
            return $this->db->get_where('payments as p', $where)->result_array();
        }
    }
    
}