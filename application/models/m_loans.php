<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Loans extends CI_Model {

    public function add($data){
        $this->db->insert('loans', $data);
        $id = $this->db->insert_id();
        $loan_id = date('y').'-'.(($data['customer_id'] < 10) ? '0'.$data['customer_id'] : $data['customer_id']).'-'.str_pad($id, 4, "0", STR_PAD_LEFT);
        $this->db->update('loans', ['loan_id'=>$loan_id], 'id='.$id);
        return array('id'=>$id, 'loan_id'=>$loan_id);
    }

    public function get($where = NULL, $summary_group_by = NULL){
        if(!$summary_group_by){
            $this->db->order_by('id', 'DESC');
            $this->db->select('l.id, l.loan_id, l.date_of_application, l.date_of_release, l.amount_loan, l.interest_rate, l.number_of_terms, l.total_interest_amount, l.balance');
        }else{
            $this->db->select($summary_group_by.'(l.date_of_release) as '.strtolower($summary_group_by).', SUM(amount_loan) as amount');
            $this->db->group_by($summary_group_by.'(l.date_of_release)');
        }
        
        if(!$where){
            return $this->db->get('loans as l')->result_array();
        }else{
            return $this->db->get_where('loans as l', $where, false)->result_array();
        }
    }
	
	public function update($data){
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('id', $id);
		$this->db->update('loans', $data);
	}
}