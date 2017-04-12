<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Effectivities extends CI_Model {

	public function add($data){
		$this->db->insert('effectivities', $data);
		$id = $this->db->insert_id();
		return array('id'=>$id);
	}
    
    public function update($data, $old_status){
        $this->db->where('status', $old_status);
        $this->db->update('effectivities', $data);
    }

}