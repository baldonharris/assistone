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
    
    public function get($where = [], $order = 'DESC'){
        $this->db->order_by('b.id', $order);
        $this->db->select('b.id, b.bucket_name, b.percentage, b.effectivities_id');
        if(!$where){
            return $this->db->get('buckets as b')->result_array();
        }else{
            return $this->db->get_where('buckets as b', $where)->result_array();
        }
    }

}