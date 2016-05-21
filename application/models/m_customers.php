<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Customers extends CI_Model {

	public function get_next($page){
		$this->db->order_by('id', 'DESC');
		$this->db->select('c1.id', FALSE);
		$this->db->where('c1.deleted_at IS NULL', FALSE, FALSE);
		return $this->db->get('customers as c1', 10, $page)->num_rows();
	}

	public function get_prev($page){
		$this->db->order_by('id', 'DESC');
		$this->db->select('c1.id', FALSE);
		$this->db->where('c1.deleted_at IS NULL', FALSE, FALSE);
		return $this->db->get('customers as c1', 10, $page)->num_rows();
	}

	public function get_customers_names($n=0, $start=0){
		$this->db->order_by('id', 'DESC');
		$this->db->select('c1.id, c1.customer_id, c1.firstname, c1.middlename, c1.lastname, c1.deleted_at', FALSE);
		$this->db->where('c1.deleted_at IS NULL', FALSE, FALSE);
		if($n==0 && $start==0){
			return $this->db->get('customers as c1', 10)->result_array();
		}else{
			return $this->db->get('customers as c1', $n, $start)->result_array();
		}
	}

	public function get($all = FALSE, $where = NULL){
		$this->db->order_by('id', 'DESC');
		$this->db->select('c1.id, c1.customer_id, c1.firstname, c1.middlename, c1.lastname, c1.mobilenumber, c1.address, c1.registered, CONCAT(c2.customer_id, " | ", c2.firstname, " ", c2.lastname) as guarantor_name, c2.id as guarantor_id, c1.deleted_at, c1.display_picture, c1.complete_name', FALSE);
		$this->db->join('customers as c2', 'c2.id=c1.guarantor_customers_id', 'left');
		if(!$where){
			if($all == FALSE){
				$this->db->where('c1.deleted_at IS NULL', FALSE, FALSE);
			}
			return $this->db->get('customers as c1')->result_array();
		}else{
			return $this->db->get_where('customers as c1', $where)->result_array();
		}
	}

	public function search($where){
		$this->db->order_by('id', 'DESC');
		$this->db->select('c1.id, c1.customer_id, c1.firstname, c1.middlename, c1.lastname, c1.deleted_at', FALSE);
		$this->db->like('c1.firstname', $where);
		$this->db->or_like('c1.middlename', $where);
		$this->db->or_like('c1.lastname', $where);
		$this->db->or_like('c1.customer_id', $where);
		$this->db->or_like('c1.complete_name', $where);
		return $this->db->get('customers as c1', 10)->result_array();
	}

	public function add($data){
		unset($data['id']);
		$this->db->insert('customers', $data);
		$id = $this->db->insert_id();
		$customer_id = date('y').'-'.str_pad($id, 4, "0", STR_PAD_LEFT);
		$this->db->update('customers', ['customer_id'=>$customer_id, 'complete_name'=>$customer_id.' | '.$data['firstname'].' '.$data['middlename'].' '.$data['lastname']], 'id='.$id);
		return array('id'=>$id, 'customer_id'=>$customer_id);
	}

	public function update($id, $data){
		$this->db->where('id', $id);
		$this->db->update('customers', $data);
	}

	public function delete($id){
		date_default_timezone_set('Asia/Manila');
		$this->db->where('id', $id);
		$this->db->update('customers', ['deleted_at'=>date('Y-m-d G:i:s')]);
	}
}