<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Returns extends CI_Model {

    public function add($data){
        if(count($data) > 0){
            $this->db->insert_batch('returns', $data);
        }else{
            $this->db->insert('returns', $data);    
        }
        $id = $this->db->insert_id();
        return array('id'=>$id);
    }

    public function get($where = NULL){ // $conditions = array('where'=>$where, 'join_loans'=>false, 'join_payments'=>false, 'join_investors'=>false
        $this->db->order_by('id', 'DESC');
        $this->db->select('r.id, r.loans_id, r.payments_id, r.investors_id, r.transactions_id, r.returns, r.percentage, r.operation_fund, t.type_transaction, l.loan_id');
        $this->db->join('transactions as t', 't.id=r.transactions_id', 'left');
        $this->db->join('loans as l', 'l.id=r.loans_id', 'left');
        if(!$where){
            return $this->db->get('returns as r')->result_array();
        }else{
            return $this->db->get_where('returns as r', $where)->result_array();
        }
    }
	
	public function update($data){
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('id', $id);
		$this->db->update('transactions', $data);
	}
}