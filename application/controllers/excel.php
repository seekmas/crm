<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once 'base.php';

class Excel extends CI_Base {


	public function index()
	{
		$contact = $this->db->query('select contactId , fname , lname ,  companyname , department , businessphone , email , city, createDate  from G_contacts')->result_array();

		var_dump( $contact);

		$this->layout->view('excel/index');
	}

}