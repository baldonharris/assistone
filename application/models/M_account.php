<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Account extends CI_Model {

	public function login($data){
		return $this->db->get_where('accounts', $data);
	}

	public function add($data){
		$this->db->insert('accounts', $data);
		$id = $this->db->insert_id();
		return array('id'=>$id);
	}

	public function update($id, $data){
		$this->db->where('id', $id);
		$this->db->update('accounts', $data);
	}

	public function check_username($username){
		$query = $this->db->get_where('accounts', array('username'=>$username));
		if($query->num_rows() == 0){
			return 1;
		}else{
			return 0;
		}
	}
}