<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Loans extends CI_Model {

    public function add($data){
        unset($data['total_payments']);
        $this->db->insert('loans', $data);
        $id = $this->db->insert_id();
        $loan_id = date('y').'-'.$data['customer_id'].'-'.str_pad($id, 4, "0", STR_PAD_LEFT);
        $this->db->update('loans', ['loan_id'=>$loan_id], 'id='.$id);
        return array('id'=>$id, 'loan_id'=>$loan_id);
    }

    public function get($where = NULL){
        $this->db->order_by('id', 'DESC');
        $this->db->select('l.id, l.loan_id, l.date_of_application, l.date_of_release, l.amount_loan, l.interest_rate, l.number_of_terms, l.total_interest_amount, l.balance');
        if(!$where){
            return $this->db->get('loans as l')->result_array();
        }else{
            return $this->db->get_where('loans as l', $where)->result_array();
        }
    }
}