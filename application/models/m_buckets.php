<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Buckets extends CI_Model {

	public function add($data){
		$this->db->insert('buckets', $data);
		$id = $this->db->insert_id();
		return array('id'=>$id);
	}
    
    public function add_batch($data){
        return $this->db->insert_batch('buckets', $data);
    }

}