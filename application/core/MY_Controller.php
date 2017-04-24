<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')) $this->load->view('login');
        $this->load->model('m_effectivities');
        
        if(!$this->session->userdata('init')){
            $this->init_effectivities();
            $this->session->set_userdata(array('init'=>true));
        }
	}
    
    private function init_effectivities(){
        $effectivity = $this->m_effectivities->get(['effectivity_date'=>date('Y-m-d'), 'status'=>'inactive']);
        if(count($effectivity) != 0){
            $this->m_effectivities->update(['status'=>'inactive'], 'active');
            $this->m_effectivities->update(['status'=>'active'], NULL, ['id'=>$effectivity[0]['id']]);
        }
    }
	
	public function print_array($my_array){
		echo "<pre>";
		print_r($my_array);
		echo "</pre>";
	}
	
	public function generate_page($page = NULL, $data = array()){
		if(!isset($data['page'])) $data['page'] = array('curr_page'=>0);
		if(!isset($data['set_sortby'])) $data['set_sortby'] = 1;
		if(!isset($data['set_orderby'])) $data['set_orderby'] = 2;
		if(!isset($data['set_display'])) $data['set_display'] = 0;
		if(!isset($data['css'])) $data['css'] = array();
		if(!isset($data['js'])) $data['js'] = array();
		if(!isset($data['data'])) $data['data'] = array();
		if(!isset($data['title'])) $data['title'] = "assistone";
		if(!isset($data['header'])) $data['header'] = "assistone";
		if(!isset($data['subheader'])) $data['subheader'] = "lending corporation";
		if(!$page) $page = 'template/template_body';

		$data['js'] = array_merge($data['js'], array('admin.js'));
        array_unshift($data['js'], 'angular/assistone.js', 'pnotify/pnotify.js');
		
		$this->load->view('template/template_header', $data);
		$this->load->view($page, $data);
		$this->load->view('template/template_footer', $data);
	}
}