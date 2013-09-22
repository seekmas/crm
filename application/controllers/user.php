<?php
require_once 'base.php';

class User extends CI_Base
{

	/**
	*
	*
	*
	* @access public
	**/
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('string');
		$this->load->model('user_model' , 'user');
		$this->layout->setLayout('layout_login.php');
	}

	/**
	*
	*
	*
	* @access private
	**/
	private function _program()
	{

		if( $this->input->post('signin'))
		{
			$_csrf = $this->_get_csrf();
			$this->_update_csrf();

			if( $_csrf !== $this->input->post('HASHFORM'))
				return 'form_origin_error';
			 	//表单来路错误 csrf不是来自本站
			elseif ( time() - $this->input->post('LIMITTIME') > 600)
				//表单提交登录超时
				return 'form_post_timeout'; 

			$return = $this->user->authenticate();

			if( is_array( $return))
			{
				$this->_clean_cache( $return['userId']);

				$str = random_string('alnum', 16).'_'.$return['userId'];

				$this->session->set_userdata( 'user' , $str );

				$this->cache->file->save( $str , $return , 10800);

				redirect( base_url());
			}

			return $return;
		}

		if( $this->input->post('save_update'))
		{
			unset( $_POST['save_update']);
			return $this->user->save_update();
		}
	}

	/**
	*
	*
	*
	* @access private
	**/
	private function _update_csrf()
	{
		$hash =  random_string('alnum', 32);
		$this->session->set_userdata( 'hash' , $hash );
		return $hash;
	}

	/**
	*
	*
	*
	* @access private
	**/
	private function _get_csrf()
	{
		if(! $str = $this->session->userdata('hash'))
		{
			return $this->_update_csrf();
		}
		else 
		{
			return $str;
		}
	}
	/**
	*
	*
	*
	* @access private
	**/
	private function _clean_cache( $id)
	{
		$this->session->unset_userdata('user');


		$file = opendir( './application/cache/');
		while( $tmp = readdir( $file))
		{
			if(preg_match('/_'.$id.'$/', $tmp))
				unlink( './application/cache/'.$tmp);
		}
	}

	/**
	*
	*
	*
	* @access public
	**/
	public function index()
	{
		$status = $this->_program();

		$hash = $this->_get_csrf();
		
		$this->layout->view('user/index' , array( 'hash' => $hash ,
		 										  'status' =>  $status,
							)
		);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect( site_url());
	}

	public function profile()
	{

		$status = $this->_program();

		$status = $status ? $status : 0;

		$user = $this->get_my();
		
		$this->layout->setLayout('layout.php');

		$this->layout->view('user/profile' , array('user' => $user , 'status' => $status));
	}
}