<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Effectivities extends CI_Model {

	public function add($data){
		$this->db->insert('effectivities', $data);
		$id = $this->db->insert_id();
		return array('id'=>$id);
	}
    
    public function update($data, $old_status, $where = NULL){
        if(!$where){
            $this->db->where('status', $old_status);
        }else{
            $this->db->where($where);
        }
        $this->db->update('effectivities', $data);
    }
    
    public function get($where = NULL){
        $this->db->order_by('e.id', 'DESC');
        $this->db->select('e.id, e.effectivity_date, e.submitted_date, e.status');
        if(!$where){
            return $this->db->get('effectivities as e')->result_array();
        }else{
            return $this->db->get_where('effectivities as e', $where)->result_array();
        }
    }

}