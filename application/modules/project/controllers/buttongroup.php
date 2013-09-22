<?php

class Project_buttongroup_module extends CI_Module
{
	public function index()
	{
		$this->load->view('index');
	}

	public function button()
	{
		$ci = & get_instance();

		$group_name = $ci->_button();

		$this->load->view('button' , array('group_name' => $group_name));
	}
}