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

    public function get($id, $mode = 0){
		$data = (!$mode) ? $this->db->get_where('payments', array('loans_id'=>$id))->result_array() : $this->db->get_where('payments', array('id'=>$id))->result_array();
        return $data;
    }
    
    public function update($data){
        $id = $data['id'];
        unset($data['id']);
        $this->db->where('id', $id);
        $this->db->update('payments', $data);
    }
}