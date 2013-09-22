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
class Client extends CI_Base {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('company_model' , 'company'); //加载 company model
	}

	public function _button()
	{
		return array( 'index' => '默认',
		);
	}

	/**
	* simple description : 本控制器内获取所有来自表单的数据 $_GET $_POST均杂在这里处理
	*
	* @package Gemba
	* @access private
	* @return mixed
	**/
	private function _program()
	{
		/**
		*
		*  simple description : 处理来自index的表单请求
		* 
		* @return string
		**/
		if( $this->input->get('search_company'))
		{

			unset( $_GET['search_company']);
			//return a string for sql where condition
			return $this->company->search();	
		}

	}

	/**
	*
	* simple description : 控制器的Action 
	* url: 				   http://localhost/index.php/company/index
	* 
	* @package Gemba
	* @param int $page //第$page页
	* @param int $offset //每页显示结果
	* @param string $order // where xxxx order by $order
	* @param string $sort // order by xx asc
	* @access public
	* @return null
	**/
	public function index( $page = 1 , $offset = 30 , $order = 'createDate' , $sort = 'desc') {

		$result = $this->_program();

		$where = $result  ?  ' and '. $result : '';

		$where .= ' and createUser='.$this->_G['userId'];

		$users = $this->company->get_users();

		$levels = $this->company->get_levels();

		$companies = $this->company->get_companies( $page , $offset , $order , $sort , $where);

		$total = $this->company->total_of_companies();

		$this->layout->view('client/index' , array( 'action' => __FUNCTION__ ,  
													 'companies'  => $companies ,
													 'users'      => $users,
													 'levels'     => $levels,
													 'flip' => array( 'total' => $total ,
													 				  'page'  => $page ,
													 				  'offset'=> $offset,
													  		   		)
													  )
		);
	}
}