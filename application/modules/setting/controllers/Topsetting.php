<?php

class Setting_Topsetting_Module extends CI_Module {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index( $action='') {
		
		$this->load->view('index' , array('action' => $action));
	}

}