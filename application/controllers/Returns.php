<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returns extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')) redirect(base_url());
        $this->load->model('m_returns');
    }
    
    public function get_returns(){
        $id = $this->input->post('id');
        $data = $this->m_returns->get(['r.transactions_id'=>$id]);
        echo json_encode(array('status'=>1, 'data'=>$data));
    }

}
