<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Transactions extends CI_Model {

    public function add($data){
        $this->db->insert('transactions', $data);
        $id = $this->db->insert_id();
        $transaction_id = date('y').'-'.$data['investor_id'].'-'.str_pad($id, 4, "0", STR_PAD_LEFT);
        $this->db->update('transactions', ['transaction_id'=>$transaction_id], 'id='.$id);
        return array('id'=>$id, 'transaction_id'=>$transaction_id);
    }

    public function get($where = NULL, $summary_group_by = NULL){
        if(!$summary_group_by){
            $this->db->order_by('id', 'DESC');
            $this->db->select('l.id, l.transaction_id, l.investor_id, l.date_of_transaction, l.amount_transaction, l.type_transaction');   
        }else{
            $this->db->select($summary_group_by.'(l.date_of_transaction) as transaction_'.strtolower($summary_group_by).', SUM(amount_transaction) as transaction_amount');
            $this->db->group_by($summary_group_by.'(l.date_of_transaction)');
        }
        
        if(!$where){
            return $this->db->get('transactions as l')->result_array();
        }else{
            return $this->db->get_where('transactions as l', $where)->result_array();
        }
    }
	
	public function update($data){
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('id', $id);
		$this->db->update('transactions', $data);
	}
}