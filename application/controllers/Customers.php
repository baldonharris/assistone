<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$this->generate_page('customers/listing', [
			'title'		=>'assistone | customers listing',
			'header'	=>'Customers',
			'subheader'	=>'Listing']);
	}
}
