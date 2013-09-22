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
class Reimburse extends CI_Base {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('reimburse_model' , 'reimburse');
		$this->load->model('setting_model' , 'setting');
	}

	public function _button()
	{
		return array(
			'index'       => '所有报销' ,
			'opportunity' => '新建销售机会报销' ,
			'project'	  => '新建项目报销' , 
			'other'		  => '新建其它报销' ,
			'review'      => '审核报销' ,
		);
	}

	private function _program()
	{
		if( $this->input->post('create_item'))
		{
			$id = $this->reimburse->new_reimburse_item( $this->_G['userId']);

			$this->reimburse->calculator();

			redirect( site_url('reimburse/edit/'.$id));
		}

		if( $this->input->post('add_reimburse'))
		{
			unset( $_POST['add_reimburse']);
			unset( $_POST['keyword']);
			if( $this->reimburse->add_reimburse())
			{
				redirect( site_url('reimburse/index'));
			}
			else
			{
				redirect( site_url('gate/add_reimburse_fail'));
			}
		}

		if( $this->input->post('save_item'))
		{
			unset( $_POST['save_item']);
			$epid = $this->reimburse->save_item();
			redirect('reimburse/edit/'.$epid);
		}

		if( $this->input->post('save_report'))
		{
			unset( $_POST['save_report']);
			$this->reimburse->save_report();
		}

		if( $this->input->post('search_opportunity'))
		{
			return $this->reimburse->get_opportunity_by_keyword( trim( $this->input->post('keyword')));
		}

		if( $this->input->post('search_project'))
		{
			return $this->reimburse->get_project_by_keyword( trim( $this->input->post('keyword')));
		}
	}

	public function index( $page = 1 , $offset = 30 , $order = 'epid' , $sort = 'desc' )
	{

		$reimburse_list = $this->reimburse->get_reimburse( $page , $offset , $order , $sort , $this->_G['userId']);

		$total_number = $this->reimburse->total_reimburse( $this->_G['userId']);

		$this->layout->view('reimburse/index' , array( 
										               'reimburse_list' => $reimburse_list ,
										               'total_number' => $total_number ,
										               'page' => $page ,
										               'offset' => $offset , 
													 )
		);
	}

	public function edit( $id , $edit_id = 0)
	{
		$this->_program();
		
		$info = $this->setting->get_data_by_table_and_id( 'expense' , $id , 'epid');

		$items = $this->setting->get_data_by_table_and_id( 'expense_item'  , $id , 'epid');

		$cost_category = $this->setting->get_selection_key_value('costCategory' , 'costId' , 'costCategory');

		if( $edit_id >0)
		{
			$item = $this->reimburse->get_item_by_id( $edit_id);
		}
		else
		{
			$item = array();
		}

		$user_list  = $this->setting->get_selection_key_value('user' , 'userId' , 'userName');

		$this->layout->view('reimburse/edit' , array( 
			                                          'info'         	=> $info[0] , 
			                                          'items'        	=> $items , 
			                                          'cost_category'	=> $cost_category , 
			                                          'edit_item' 		=> $item , 
			                                          'user_list'   	=> $user_list , 
													)
		);
	}

	public function opportunity()
	{
		$result = $this->_program();

		//$opportunity = $this->setting->get_selection_key_value( 'opportunity' , 'oppId' , 'oppname');

		$this->layout->view('reimburse/opportunity' , array( /*'opportunity' => $opportunity ,*/ 'result'=>$result));
	}

	public function project()
	{
		$result = $this->_program();
		
		$project = $this->setting->get_selection_key_value( 'project' , 'projectId' , 'projectname');

		$this->layout->view('reimburse/project' , array('project' => $project , 'result' => $result));	
	}

	public function add_reimburse_for_project( $projectid)
	{

		$projectid = intval( $projectid);

		$this->_program();
		
		$project = $this->setting->get_selection_key_value( 'project' , 'projectId' , 'projectname');

		$this->layout->view('reimburse/project' , array('project' => $project , 'projectid' => $projectid));			
	}

	public function other()
	{
		$this->_program();

		$this->layout->view('reimburse/other');			
	}

	public function review()
	{
		$user = $this->get_my();

		$department = $this->reimburse->get_department( $user['userId']);

		$financial = $this->reimburse->get_financial( $user['userId']);

		$general = $this->reimburse->get_general( $user['userId']);

		$this->layout->view('reimburse/review' , array( 'department' => $department , 
													    'financial'  => $financial , 
													    'general'    => $general , 
			)
		);
	}

	public function del_item( $id)
	{

		$user = $this->get_my();

		$epid = $this->reimburse->del_item( $id , $user['userId']);

		redirect( site_url('reimburse/edit/'.$epid));
	}

	public function comfirm_reimburse( $type , $epid , $auth)
	{
		$user = $this->get_my();

		$this->reimburse->comfirm_reimburse( $type , $epid , $auth ,$user['userId']);

		$this->reimburse->isExpense_query( $epid);

		redirect( site_url('reimburse/review'));
	}

}