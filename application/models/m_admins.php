<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admins extends CI_Model {

	public function add($data){
		$this->db->insert('accounts', $data);
		$id = $this->db->insert_id();
		return array('id'=>$id);
	}

	public function update($id, $data){
		$this->db->where('id', $id);
		$this->db->update('accounts', $data);
	}
    
    public function get($where = NULL){
        $this->db->select('e.id, b.bucket_name, b.percentage, e.effectivity_date, e.submitted_date, e.status');
        $this->db->join('');
    }
}