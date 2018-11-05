<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Penalties extends CI_Model {

    public function add($data){
        $this->db->insert('penalties', $data);
    }

    public function get($id){
        return $this->db->get_where('penalties', array('payments_id'=>$id))->result_array();
    }
    
}