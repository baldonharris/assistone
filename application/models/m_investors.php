<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Investors extends CI_Model {

	public function get_next($page, $set_sortby, $set_orderby, $set_display){
		if($set_sortby==1){
			$sort = 'c1.id';
		}else if($set_sortby==2){
			$sort = 'c1.firstname';
		}else{
			$sort = 'c1.lastname';
		}
		$order = ($set_orderby==1) ? 'ASC' : 'DESC';
		if($set_display==0){
			$this->db->where('c1.deleted_at IS NULL', FALSE, FALSE);
		}
		$this->db->order_by($sort, $order);
		$this->db->select('c1.id', FALSE);
		return $this->db->get('investors as c1', 10, $page)->num_rows();
	}

	public function get_prev($page, $set_sortby, $set_orderby, $set_display){
		if($set_sortby==1){
			$sort = 'c1.id';
		}else if($set_sortby==2){
			$sort = 'c1.firstname';
		}else{
			$sort = 'c1.lastname';
		}
		$order = ($set_orderby==1) ? 'ASC' : 'DESC';
		if($set_display==0){
			$this->db->where('c1.deleted_at IS NULL', FALSE, FALSE);
		}
		$this->db->order_by($sort, $order);
		$this->db->select('c1.id', FALSE);
		return $this->db->get('investors as c1', 10, $page)->num_rows();
	}

	public function get_investors_names($n=0, $start=0, $set_sortby, $set_orderby, $set_display, $guarantors=0){
		if($set_sortby==1){
			$sort = 'c1.id';
		}else if($set_sortby==2){
			$sort = 'c1.firstname';
		}else{
			$sort = 'c1.lastname';
		}
		$order = ($set_orderby==1) ? 'ASC' : 'DESC';
		if($set_display==0){
			$this->db->where('c1.deleted_at IS NULL', FALSE, FALSE);
		}
		$this->db->order_by($sort, $order);
		$this->db->select('c1.id, c1.investor_id, c1.firstname, c1.middlename, c1.lastname, c1.deleted_at', FALSE);
		if($n==0 && $start==0){
			return $this->db->get('investors as c1', ($guarantors) ? NULL : 10)->result_array();
		}else{
			return $this->db->get('investors as c1', $n, $start)->result_array();
		}
	}

	public function get($all = FALSE, $where = NULL){
		$this->db->order_by('id', 'DESC');
		$this->db->select('c1.id, c1.investor_id, c1.firstname, c1.middlename, c1.lastname, c1.mobilenumber, c1.address, c1.registered, c1.deleted_at, c1.display_picture, c1.complete_name', FALSE);
		if(!$where){
			if($all == FALSE){
				$this->db->where('c1.deleted_at IS NULL', FALSE, FALSE);
			}
			return $this->db->get('investors as c1')->result_array();
		}else{
			return $this->db->get_where('investors as c1', $where)->result_array();
		}
	}

	public function search($where){
		$this->db->order_by('id', 'DESC');
		$this->db->select('c1.id, c1.investor_id, c1.firstname, c1.middlename, c1.lastname, c1.deleted_at', FALSE);
		$this->db->like('c1.firstname', $where);
		$this->db->or_like('c1.middlename', $where);
		$this->db->or_like('c1.lastname', $where);
		$this->db->or_like('c1.investor_id', $where);
		$this->db->or_like('c1.complete_name', $where);
		return $this->db->get('investors as c1', 10)->result_array();
	}

	public function add($data){
		unset($data['id']);
		$this->db->insert('investors', $data);
		$id = $this->db->insert_id();
		$investor_id = date('y').'-'.str_pad($id, 4, "0", STR_PAD_LEFT);
		$this->db->update('investors', ['investor_id'=>$investor_id, 'complete_name'=>$investor_id.' | '.$data['firstname'].' '.$data['middlename'].' '.$data['lastname']], 'id='.$id);
		return array('id'=>$id, 'investor_id'=>$investor_id);
	}

	public function update($id, $data){
		$investor_id = date('y').'-'.str_pad($id, 4, "0", STR_PAD_LEFT);
		$data['complete_name'] = $investor_id.' | '.$data['firstname'].' '.$data['middlename'].' '.$data['lastname'];
		$this->db->where('id', $id);
		$this->db->update('investors', $data);
	}

	public function delete($id){
		date_default_timezone_set('Asia/Manila');
		$this->db->where('id', $id);
		$this->db->update('investors', ['deleted_at'=>date('Y-m-d G:i:s')]);
	}

	public function change_status($id, $status=0){
		date_default_timezone_set('Asia/Manila');
		$this->db->where('id', $id);
		$this->db->update('investors', ['deleted_at'=> (!$status) ? date('Y-m-d G:i:s') : NULL ]);
	}
}