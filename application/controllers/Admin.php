<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')) redirect(base_url());
        $this->load->model('m_reports');
    }
    
    public function index(){
        $this->generate_page('settings/view', [
            'title'         =>  'assistone | Admin Center',
            'header'        =>  'Admin',
            'subheader'     =>  'Center',
            'js'            =>  array('angular/admin.js')
        ]);
    }

}
