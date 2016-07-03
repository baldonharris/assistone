<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Payments extends CI_Model {

	public function add($data){
		$this->db->insert_batch('payments', $data);
		$insert_id = array();
		for($x=0; $x<count($data); $x++){
			if($x==0){
				array_push($insert_id, $this->db->insert_id());
			}else{
				array_push($insert_id, ($this->db->insert_id() + $x));
			}
		}
		return $insert_id;
	}

	public function get($id){
		return $this->db->get_where('payments', array('loans_id'=>$id))->result_array();
	}
}