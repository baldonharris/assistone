<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Account extends CI_Model {

	public function login($data){
		return $this->db->get_where('accounts', $data);
	}
}