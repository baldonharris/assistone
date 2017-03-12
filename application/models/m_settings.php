<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Settings extends CI_Model {

    public function add($data){
        $this->db->insert('transactions', $data);
        $id = $this->db->insert_id();
        $transaction_id = date('y').'-'.$data['investor_id'].'-'.str_pad($id, 4, "0", STR_PAD_LEFT);
        $this->db->update('transactions', ['transaction_id'=>$transaction_id], 'id='.$id);
        return array('id'=>$id, 'transaction_id'=>$transaction_id);
    }

    public function get($where = NULL){
        $this->db->order_by('id', 'DESC');
        $this->db->select('l.id, l.transaction_id, l.investor_id, l.date_of_transaction, l.amount_transaction, l.type_transaction');
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