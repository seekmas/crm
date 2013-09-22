<?php

class MyHook
{
	private $c;

	public function __construct()
	{
		$this->c = &get_instance();
	}

	public function user_status()
	{

		if( FALSE !== stripos( $this->c->uri->uri_string() , 'module'))
			return ;

		if( $this->c->uri->segment(1) === 'user' || $this->c instanceof Rest_Controller)
			return ;

		if(! $this->c->get_my())
		{
			$this->c->session->unset_userdata('user');
			redirect( site_url('user'));
		}
		elseif(! $this->c->session->userdata('user')) 
		{
			redirect( site_url('user'));
		}
	}

	public function load_header()
	{
		//$this->c->load->view('common/header');
	}
}