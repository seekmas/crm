<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once 'base.php';
/**
* CodeIgniter
*
* An open source application development framework for PHP 5.2.4 or newer
*
* NOTICE OF LICENSE
*
* Licensed under the Academic Free License version 3.0
*
* This source file is subject to the Academic Free License (AFL 3.0) that is
* bundled with this package in the files license_afl.txt / license_afl.rst.
* It is also available through the world wide web at this URL:
* http://opensource.org/licenses/AFL-3.0
* If you did not receive a copy of the license and are unable to obtain it
* through the world wide web, please send an email to
* licensing@ellislab.com so we can send you a copy immediately.
*
* @package Gemba
* @author mot <446146366@qq.com>
* @copyright Copyright (c) 2013 - 2014, mot&michael, Inc.
* @license http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
* @since Version 1.0
* @filesource
*/
class Setting extends CI_Base {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('setting_model' , 'setting');


		if( $this->_G['groupId'] !== 1)
			redirect( site_url('gate/cannot_access'));
	}

	public function _button()
	{
		return array( 'index' => '设置' , 
		);
	}

	public function index() 
	{

		$this->layout->view('setting/index' , array('action' => __FUNCTION__));
	}

	/**
	* 
	* request handle
	* @access private
	* @param (string , string , mixed , integer)
	* @return null
	* @author mot.wu
	**/

	private function _program( $method , $action = null , $params = 0 , $primary_key)
	{
		if( isset( $action) && 'del_item' === $action)
		{
			$this->setting->del_setting_item( $method , intval( $params) , $primary_key);
			redirect( site_url('setting/'.$method.'/'));
		}
		else if( $this->input->post('create_item')) 
		{	
			unset( $_POST['create_item']);

			$package = array();
			foreach ($_POST as $key => $value) {
				$package[$key] = trim( $value);
 			}

			$this->setting->add_setting_item( $method , $package , $primary_key);
			redirect( site_url('setting/'.$method.'/'));
		}
		else if( $this->input->post('save'))
		{
			unset( $_POST['save']);

			$params = intval( $this->input->post('userId'));
			unset( $_POST[$primary_key]);
			$update = array();

			foreach ($_POST as $key => $value) {
				$update[$key] = trim( $value);
			}

			$this->setting->edit_setting_item( $method , $primary_key , $params , $update);
		}
	}

	/**
	*
	* @Industry Action
	* @access public
	* @param (string,integer)
	* @return void
	* @author mot.wu
	**/
	public function industry( $action = null , $params = 0) 
	{

		$this->_program( __FUNCTION__ , $action , $params ,'iid');
		$list = $this->setting->get_data_by_table( __FUNCTION__);
		$this->layout->view('setting/industry' , array('action' => __FUNCTION__ ? __FUNCTION__ : '' ,
														'list' => $list, )
		);
	}

	/**
	*
	* @Source Action
	* @access public
	* @param null
	* @return void
	* @author mot.wu
	**/
	public function source( $action = null , $params = 0) 
	{	
		$this->_program( __FUNCTION__ , $action , $params ,'sid');
		$list = $this->setting->get_data_by_table( __FUNCTION__);
		$this->layout->view('setting/source' , array('action' => __FUNCTION__ ? __FUNCTION__ : '' , 
												     'list'   => $list)
		);
	}

	/**
	*
	* @Country Action
	* @access public
	* @param null
	* @return void
	* @author mot.wu
	**/
	public function country( $action = null , $params = 0) 
	{
		$this->_program( __FUNCTION__ , $action , $params ,'cid');
		$list = $this->setting->get_data_by_table( __FUNCTION__);
		$this->layout->view('setting/country' , array('action' => __FUNCTION__ ? __FUNCTION__ : '' ,
													  'list'   => $list)
		);
	}

	/**
	*
	* @Province Action
	* @access public
	* @param null
	* @return void
	* @author mot.wu
	**/
	public function province( $action = null , $params = 0) 
	{

		$this->_program( __FUNCTION__ , $action , $params ,'id');
		$list = $this->setting->get_data_by_table( __FUNCTION__);
		$this->layout->view('setting/province' , array('action' => __FUNCTION__ ? __FUNCTION__ : '',
													   'list'   => $list)
		);
	}

	/**
	*
	* @Level Action
	* @access public
	* @param null
	* @return void
	* @author mot.wu
	**/
	public function level( $action = null , $params = 0) 
	{
		$this->_program( __FUNCTION__ , $action , $params ,'lid');
		$list = $this->setting->get_data_by_table( __FUNCTION__);
		$this->layout->view('setting/level' , array('action' => __FUNCTION__ ? __FUNCTION__ : '' ,
													'list' => $list)
		);
	}

	/**
	*
	* @SalesStage Action
	* @access public
	* @param null
	* @return void
	* @author mot.wu
	**/
	public function stage( $action = null , $params = 0) 
	{
		$this->_program( __FUNCTION__ , $action , $params ,'sid');
		$list = $this->setting->get_data_by_table( __FUNCTION__);
		$this->layout->view('setting/salesstage' , array('action' => __FUNCTION__ ? __FUNCTION__ : '',
														 'list' => $list)
		);
	}

	/**
	*
	* @Product Action
	* @access public
	* @param null
	* @return void
	* @author mot.wu
	**/
	public function category( $action = null , $params = 0) 
	{
		$this->_program( 'category' , $action , $params ,'categoryId');

		$list = $this->setting->get_data_by_table( 'category');
		$this->layout->view('setting/category' , array('action' => __FUNCTION__ ? __FUNCTION__ : '' , 
													  'list'   => $list)
		);
	}

	/**
	*
	* @UserList Action
	* @access public
	* @param null
	* @return void
	* @author mot.wu
	**/
	public function user( $action = null , $params = 0) 
	{
		$this->_program( __FUNCTION__ , $action , $params ,'userId');
		$list = $this->setting->get_data_by_table( __FUNCTION__);
		$groups = $this->setting->get_data_by_table( 'Group');
		$this->layout->view('setting/userlist' , array('action' => __FUNCTION__ ? __FUNCTION__ : '' , 
													   'list'   => $list , 
													   'groups' => $groups)
		);
	}

	/**
	*
	* @UserList Action
	* @access public
	* @param null
	* @return void
	* @author mot.wu
	**/
	public function group( $action = null , $params = 0) 
	{
		$this->_program( __FUNCTION__ , $action , $params ,'gid');
		$list = $this->setting->get_data_by_table( __FUNCTION__);

		$users = $this->setting->get_data_by_table('user');

		$this->layout->view('setting/usergroup' , array('action' => __FUNCTION__ ? __FUNCTION__ : '' , 
													    'list' 	 => $list ,
													    'users'  => $users,
													    )
		);
	}

	/**
	*
	* @access public
	* @param $id
	* @return void
	* @author mot.wu
	**/
	public function edit_user( $userId ,  $action = null , $params = 0)
	{

		$this->_program( 'user' , $action , $params ,'userId');

		$user = $this->setting->get_data_by_table_and_id( 'user' , $userId , 'userId');
		$groups = $this->setting->get_data_by_table( 'Group');
		$now_group = $this->setting->get_data_by_table_and_id( 'Group' , $user[0]['groupId'] , 'gid');

		$this->layout->view('setting/edit_user' , array('action' => __FUNCTION__ ? __FUNCTION__ : '' ,
														'user'   => $user[0],
														'groups' => $groups ,
														'now_group' => $now_group,
														)
		);	
	}

	public function remove( $table , $id , $primary_key)
	{
		$this->setting->remove( trim( $table) , intval( $id) , trim( $primary_key));

		redirect( site_url('setting/'.$table));
	}
}