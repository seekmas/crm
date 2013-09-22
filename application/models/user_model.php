<?php

class User_model extends CI_Model
{

	public function authenticate()
	{
		$username = trim( $this->input->post('username'));
		$password = $this->input->post('password');

		$user = $this->db->where( array( 'userName' => $username))
				 		 ->get('user');

		if( $user->num_rows() === 0)
		{
			return 'user_not_exist';
		}
		$user = $user->row_array();
		if( $password !== $user['passWord'])
		{
			return 'authenticate_failed';
		}
		return $user;
	}

	public function save_update()
	{
		

		if( trim( $this->input->post('newPass')) && trim( $this->input->post('newPass2')))
		{
			if( trim( $this->input->post('newPass')) === trim( $this->input->post('newPass2')))
			{
				$_POST['passWord'] = trim( $this->input->post('newPass'));
				
			}
		}

		unset( $_POST['newPass2']);unset( $_POST['newPass']);

		if( isset( $_FILES['photo']['tmp_name']))
		{
			move_uploaded_file( $_FILES['photo']['tmp_name'] , FCPATH . 'upload\photo\\'.$_POST['userId'].'.jpg');
		}	

		$this->_G = $_POST;

		$userId = $_POST['userId'];
		unset( $_POST['userId']);


		return $this->db->where( array( 'userId' => $userId))->update('user' , $_POST);
		
	}

}