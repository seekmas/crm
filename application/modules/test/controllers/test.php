<?php

class Test_test_module extends CI_Module
{
	public function index()
	{


		if( $this->input->post('posts'))
		{
			$uid = intval( $this->input->post('uid'));

			$list = $this->db->select('*')
							 ->from('expense_item')
							 ->where( 'userId='.$uid)
							 ->order_by('eid','desc')
							 ->get()->result_array();
		}

		$data = $this->db->select('userId,userName,')
				 		 ->from('user')
				 		 ->get()->result_array();


		$this->load->view('tester/test', array('data'=>$data , 'list'=>$list));
	}
}