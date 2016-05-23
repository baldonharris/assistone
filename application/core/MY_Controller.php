<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('username')) $this->load->view('login');
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
		
		$this->load->view('template/template_header', $data);
		$this->load->view($page, $data);
		$this->load->view('template/template_footer', $data);
	}
}