<?php

class Pagination_pagination_module extends CI_Module{

	public function __construct()
	{
		parent::__construct();
		$this->load->module('pagination');
	}

	public function index( $total , $page , $offset)
	{	
		
		//var_dump( $_SERVER['QUERY_STRING']);
		//$config['cur_page'] = $page;
		$config['base_url'] = site_url() . '/' . $this->uri->segment(1) . '/' .$this->uri->segment(2) .'/';
		$config['total_rows'] = $total;
		$config['per_page'] = $offset;
		$this->pagination->initialize($config);
		$this->load->view('index' , array( 'total'   => $total,
											'page' 	 => $page,
											'offset' => $offset,
										 )
		);
	}
}