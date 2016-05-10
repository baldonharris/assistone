<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('username')) $this->generate_page(NULL, ['title'=>'Welcome!']);
	}

	public function index()
	{
		;
	}
}
