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
class Project extends CI_Base {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('project_model' , 'project');
		$this->load->model('company_model' , 'company');
		$this->load->model('setting_model' , 'setting');
		$this->load->model('common_model' , 'common');
	}
	
	public function _button()
	{
		return array(
			'index' 		=> '项目列表' ,
			'opportunity' 	=> '销售机会列表' , 
			'add_oppo'      => '添加销售机会' ,
		);
	}

	private function _program()
	{
		if( $this->input->post('add_opportunity'))
		{
			unset( $_POST['add_opportunity']);
			$re = $this->project->add_opportunity( $this->_G['userId']);

			if( $re === 0)
				redirect( site_url('gate/oppo_exists'));
			else
				redirect( site_url('gate/oppo_ok'));
		}

		if( $this->input->post('add_history'))
		{
			$user = $this->get_my();
			$this->project->add_history( $user['userId']);
		}

		if( $this->input->post('save_opportunity'))
		{
			$user = $this->get_my();
			unset( $_POST['save_opportunity']);
			$re = $this->project->save_opportunity( $user['userId'] , $user['groupId']);
			if( $re)
				redirect( site_url('gate/oppo_change_ok'));
			else
				redirect( site_url('gate/oppo_change_fail'));

		}

		if( $this->input->post('save_project'))
		{

			if( isset( $_FILES['contract']) && $_FILES['contract']['error'] === 0)
			{
				$contractFile = $this->project->save_contract();
			}
			else
			{
				$contractFile = $this->input->post('contractFile');
			}
			unset( $_POST['save_project']);
			$this->project->save_project( $contractFile);
		}

		if( $this->input->post( 'search_project'))
		{
			return $this->project->search_project();
		}

		if( $this->input->post('save_history'))
		{
			$this->project->save_history();
		}
	}

	/**
	*
	* simple description : 控制器的Action 
	* url: 				   http://localhost/index.php/project/index
	* 
	* @package Gemba
	* @param int $page //第$page页
	* @param int $offset //每页显示结果
	* @param string $order // where xxxx order by $order
	* @param string $sort // order by xx asc
	* @access public
	* @return null
	**/
	public function index( $page = 1 , $offset = 30 , $order = 'createDate' , $sort = 'desc')
	{

		$return = $this->_program();

		$user = $this->get_my();

		$projects = $return ? $return : $this->project->get_projects( $user['userId'] , $page , $offset , $order , $sort , '*' , $user['groupId']);

		$user_list = $this->setting->get_selection_table( 'user' , 'userId' , 'userName' );

		$total = $this->project->get_total_number_of_project( $user['userId'] , $user['groupId']);

		$this->layout->view('project/index' , array( 'projects' => $projects ,
													 'total'    => $total ,
													 'page'     => $page ,
													 'offset'   => $offset , 
													 'userId'   => $user['userId'] ,
													 'user_list' => $user_list ,
						   )
		);
	}

	public function opportunity( $page = 1 , $offset = 30)
	{
		$user = $this->get_my();

		$opportunity = $this->project->get_opportunity( $user['userId'] , $page , $offset , $user['groupId'] );

		$total = $this->project->get_total_number_of_opportunity( $user['userId'] , $user['groupId']);

		$search = $this->company->get_by_tables( array('level','stage'));

		$this->layout->view('project/opportunity' , array( 'opportunity' => $opportunity ,
														   'total'       => $total ,
														   'page'        => $page ,
														   'offset'      => $offset , 
														   'search'      => $search , 
														 )
		);
	}

	public function edit_project( $projectId)
	{

		$this->_program();

		$projectId = intval( $projectId);

		$project = $this->project->get_project_by_id( $projectId);

		$type = $this->setting->get_selection_table( 'category' , 'categoryId' , 'categoryname');

		$company = $this->setting->get_selection_table( 'companies' , 'companyId' , 'companyname');

		$the_company = $this->setting->get_data_by_table_and_id( 'companies' , $project['companyName'] , 'companyId');

		$userName = $this->setting->get_data_by_table_and_id( 'user' , $project['userId'] , 'userId' );

		$receipt = $this->setting->get_data_by_table_and_id( 'receipt' , $project['projectId'] , 'projectId');

		$this->layout->view('project/edit_project', array( 'project' => $project , 
			                                               'type'    => $type ,
			                                               'company' => $company ,
			                                               'username'=> $userName ,
			                                               'the_company' => isset( $the_company[0]) ? $the_company[0] : array() , 
			                                               'receipt' => $receipt ,
														 )
		);
	}

	public function receipt( $id)
	{
		$id = intval( $id);

		$receipt = $this->setting->get_data_by_table_and_id('receipt' , $id , 'rid');

		$this->layout->view('project/receipt' , array('receipt' => $receipt));
	}

	public function add_oppo( $default = null)
	{

		$this->_program();

		$product = $this->setting->get_selection_table( 'products' , 'proId' , 'productname' );

		$user = $this->setting->get_selection_table( 'user' , 'userId' , 'userName' );

		$source = $this->setting->get_selection_table( 'source' , 'sid' , 'source' );

		$stage = $this->setting->get_selection_table( 'stage' , 'sid' , 'stage' , 'description');

		$company = $this->setting->get_selection_table( 'companies' , 'companyId' , 'companyname' );

		$this->layout->view('project/add_oppo' , array( 
			                                            'product'      => $product ,
			                                            'user'         => $user ,
			                                            'source'       => $source , 
			                                            'stage'        => $stage , 
			                                            'company'      => $company ,
			                                            'default' 	   => $default ,
													  )
		);
	}

	public function edit_opportunity( $id)
	{
		$this->_program();

		$id = intval( $id);

		$opportunity = $this->setting->get_data_by_table_and_id( 'opportunity' , $id , 'oppId' );

		$company = $this->project->get_companyinfo_by_opportunity_id( $id);

		$product = $this->setting->get_selection_table( 'category' , 'categoryId' , 'categoryname' );

		$user = $this->setting->get_selection_table( 'user' , 'userId' , 'userName' );

		$source = $this->setting->get_selection_table( 'source' , 'sid' , 'source' );

		$stage = $this->setting->get_selection_table( 'stage' , 'sid' , 'stage' , 'description');

		$level = $this->setting->get_selection_table( 'level' , 'lid' , 'level');

		$history = $this->setting->get_data_by_table_and_id( 'history' , $id , 'cid');

		$project = $this->project->get_project_by_opportunity( $id);

		$this->layout->view('project/edit_opportunity' , array( 'opportunity' => $opportunity[0] , 
																'product'	  => $product , 
																'user'		  => $user , 
																'source'	  => $source , 
																'stage'		  => $stage , 
																'company'     => $company ,
																'level'       => $level ,
																'history'     => $history ,
																'project'	  => $project , 
															  )
		);
	}

	public function del_opportunity( $oppid )
	{

		$user = $this->get_my();

		if( 1 !== $user['groupId'])
		{
			redirect('gate/operation_noright');
		}

		$oppid = intval( $oppid);

		$user = $this->get_my();

		$this->project->del_opportunity( $oppid , $user['userId']);

		redirect( isset( $_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : site_url());
	}

	public function convert_opportunity( $oppId)
	{
		$oppId = intval( $oppId);

		$user = $this->get_my();

		if( $projectId = $this->project->convert_opportunity( $oppId , $user['userId'] , $user['groupId']))
		{
			redirect( site_url('project/edit_project/'.$projectId));
		}
		else
		{
			redirect( site_url('gate/convert_opportunity_fail'));
		}

		$this->layout->view('project/convert');
	}

	public function project_reimburse( $projectid)
	{

		$projectid = intval( $projectid);

		$reimburse_item = $this->project->get_reimburseitem_by_projectid( $projectid);

		$this->layout->view('project/project_reimburse' , array('item' => $reimburse_item ,
																)
		);
	}

	public function calc( $projectid)
	{

		$projectid = intval( $projectid);
		$this->project->calc_project_profit( $projectid);

		redirect( site_url('project/edit_project/'.$projectid));
	}
}