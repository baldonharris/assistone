<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Customers extends CI_Model {

	public function get_customers_names(){
		$this->db->order_by('id', 'ASC');
		$this->db->select('c1.id, c1.customer_id, c1.firstname, c1.middlename, c1.lastname', FALSE);
		$this->db->where('c1.deleted_at IS NULL', FALSE, FALSE);
		return $this->db->get('customers as c1')->result_array();
	}

	public function get($where = NULL){
		$this->db->order_by('id', 'ASC');
		$this->db->select('c1.id, c1.customer_id, c1.firstname, c1.middlename, c1.lastname, c1.mobilenumber, c1.address, c1.registered, CONCAT(c2.firstname, " ", c2.lastname) as guarantor_name, c2.id as guarantor_id, c1.deleted_at, c1.display_picture', FALSE);
		$this->db->join('customers as c2', 'c2.id=c1.guarantor_customers_id', 'left');
		if(!$where){
			$this->db->where('c1.deleted_at IS NULL', FALSE, FALSE);
			return $this->db->get('customers as c1')->result_array();
		}else{
			return $this->db->get_where('customers as c1', $where)->result_array();
		}
	}

	public function add($data){
		$this->db->insert('customers', $data);
		$id = $this->db->insert_id();
		$customer_id = date('y').'-'.str_pad($id, 4, "0", STR_PAD_LEFT);
		$this->db->update('customers', ['customer_id'=>$customer_id], 'id='.$id);
		return array('id'=>$id, 'customer_id'=>$customer_id);
	}
}