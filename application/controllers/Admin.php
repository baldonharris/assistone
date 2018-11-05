<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')) redirect(base_url());
        $this->load->model('m_admins');
        $this->load->model('m_buckets');
        $this->load->model('m_effectivities');
    }
    
    public function index(){
        $this->generate_page('settings/view', [
            'title'         =>  'assistone | Admin Center',
            'header'        =>  'Admin',
            'subheader'     =>  'Center',
            'js'            =>  array('angular/admin.js')
        ]);
    }
    
    public function save_bucket(){
        $input_ef_date = $this->input->post('effectivity_date');
        $input_buckets = $this->input->post('buckets');
        $exploded_ed = explode("-", $input_ef_date);
        $now_date = date("Y-m-d");
        $ed = date("Y-m-d", mktime(0, 0, 0, $exploded_ed[1], $exploded_ed[2], $exploded_ed[0]));
        
        if(strtotime($ed) == strtotime($now_date)){
            $this->m_effectivities->update(array('status'=>'inactive'), 'active');
            $effectivity = $this->m_effectivities->add(array('effectivity_date'=>$input_ef_date, 'status'=>'active'));
        }else if(strtotime($ed) > strtotime($now_date)){
            $effectivity = $this->m_effectivities->add(array('effectivity_date'=>$input_ef_date));
        }
        
        for($x=0; $x<count($input_buckets); $x++){
            $input_buckets[$x] = array_merge($input_buckets[$x], array('effectivities_id'=>$effectivity['id']));
        }
        
        $added_buckets = $this->m_buckets->add_batch($input_buckets);
        
        $this->get_effectivities();
    }
    
    public function get_effectivities(){
        $effectivities = $this->m_effectivities->get();
        $final_effectivities = array();
        
        for($x=0; $x<count($effectivities); $x++){
            $buckets = $this->m_buckets->get(array('effectivities_id'=>$effectivities[$x]['id']));
            $effectivities[$x] = array_merge($effectivities[$x],
                                             [
                                                 'total_buckets'=>count($buckets),
                                                 'buckets'=>$buckets,
                                             ]);
        }
        
        echo json_encode($effectivities);
    }

}
