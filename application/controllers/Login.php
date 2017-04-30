<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('username')) redirect(base_url('home'));
	}

	public function index()
	{
		;
	}
}
