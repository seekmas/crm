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
* @package Gemba/crm
* @author mot <446146366@qq.com>
* @copyright Copyright (c) 2013 - 2014, mot&michael, Inc.
* @license http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
* @since Version 1.0
* @filesource
*/
class Company extends CI_Base {
	/**
	* simple description : 构造方法
	*
	* @package Gemba
	* @access public
	* @return null
	**/
	public function __construct() {
		parent::__construct(); //父类构造
		$this->load->model('company_model' , 'company'); //加载 company model
		$this->load->model('setting_model' , 'setting');
		$this->load->model('common_model' , 'common');
	}

	public function _button()
	{
		return array( 'index' 		=> '公司列表' ,
					  'add_company' => '添加公司资料' , 
					  'all_contact' => '联系人列表' ,
					  'add_contact' => '添加联系人' , 
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

		//test company's name existing
		if( $this->input->post('create_test'))
		{
			$result = $this->company->name_exist();

			$result['target'] = $this->input->post('companyname');

			return $result;
		}

		//build company profile
		if( $this->input->post('create_company_profile'))
		{
			$user = $this->get_my();
			$id = $this->company->create_company_profile( $user['userId']);

			redirect( site_url('company/edit_company/'.$id));
		}
		//edit company info
		if( $this->input->post('save_company'))
		{
			unset( $_POST['save_company']);
			$companyId = $_POST['companyId'];
			unset( $_POST['companyId']);
			$this->common->save_changes( 'companyId' , $companyId );
		}
		//add contact
		if( $this->input->post('add_contact'))
		{

			if( isset( $_FILES['idcard_photo']))
			{
				preg_match( '/(jpg)|(png)|(jpeg)|(gif)?$/', $_FILES['idcard_photo']['name'] , $match);

				if( $match)
				{
					$file = random_string('nozero', 8).'.'.$match[0];
					move_uploaded_file( $_FILES['idcard_photo']['tmp_name'], FCPATH.'/upload/idcard/'.$file);
				}
			}
			else
			{
				$file = '';
			}

			$user = $this->get_my();

			$rt = $this->company->add_contact( $user['userId'] ,  $file);

			if( $rt)
			{
				redirect('gate/create_contact_ok');
			}
		}

		if( $this->input->post('save_contact'))
		{
			unset( $_POST['save_contact']);
			$this->company->save_contact();
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
	* @param string $sort // order by column asc
	* @access public
	* @return null
	**/
	public function index( $page = 1 , $offset = 30 , $order = 'createDate' , $sort = 'desc') {

		$result = $this->_program();

		$where = $result  ?  ' and '. $result : '';

		$users = $this->company->get_users();

		$levels = $this->company->get_levels();

		$companies = $this->company->get_companies( $page , $offset , $order , $sort , $where);

		$total = $this->company->total_of_companies();

		$this->layout->view('company/index' , array( 'action' => __FUNCTION__ ,  
													 'companies'  => $companies ,
													 'users'      => $users,
													 'levels'     => $levels,
													 'flip' => array( 'total' => $total ,
													 				  'page'  => $page ,
													 				  'offset'=> $offset,
													  		   		) ,
													 'button_group' => $this->_button() , 
													  )
		);
	}

	/**
	* simple description : 控制器的Action 
	* url: 				   http://localhost/index.php/company/edit_company/$companyId
	* @package Gemba
	* @param string $companyId 
	* @access public
	* @return null
	**/
	public function edit_company( $companyId)
	{
		$this->_program();

		$companyId = '\''.trim( $companyId).'\'';

		$company_info = $this->company->get_data_by_table_and_id( 'companies' , $companyId , 'companyId' );

		if( empty( $company_info))
			redirect( 'gate/company_not_found');

		$properties = $this->company->get_by_tables( array( 'industry' , 'source' , 'country' , 'province' , 'level' ));

		$contacts = $this->company->get_contacts_by_companyname( $company_info['companyname']);

		$opportunity = $this->company->get_oppportunity_by_companyid( $companyId);

		$this->layout->view('company/edit_company' , array('info' 		 => $company_info ,
														   'properties'  => $properties ,
														   'opportunity' => $opportunity ,
														   'contacts'	 => $contacts ,
														  )
		);

	}

	public function add_company()
	{
		$status = $this->_program();

		$industry = $this->setting->get_selection_table('industry' , 'iid' , 'industry');

		$source = $this->setting->get_selection_table('source' , 'sid' , 'source');

		$country = $this->setting->get_selection_table('country' , 'cid' , 'country');

		$province = $this->setting->get_selection_table('province' , 'id' , 'province' , null ,'country = 1');

		$level = $this->setting->get_selection_table('level' , 'description' , 'level');

		$this->layout->view('company/add_company' , array( 'status' => $status , 
			                                               'industry' => $industry , 
			                                               'source' => $source , 
			                                               'country' => $country ,
			                                               'province' => $province , 
			                                               'level' => $level , 
						   )
		);
	}

	public function all_contact( $page = 1 , $offset = 30 ,  $order = 'contactId' , $sort = 'desc')
	{

		//$where = $this->_program();

		//$company = $this->setting->get_selection_table('companies' , 'companyId' , 'companyname');

		$contacts = $this->company->get_contacts( $page , $offset , $order , $sort) ;

		$total = $this->company->get_total_num_contacts();

		$this->layout->view('company/all_contact' , array( 'contacts' => $contacts ,
														   'pagination' => array( 'total' => $total , 
														   						  'page'  => $page ,
														   						  'offset'=> $offset ,  
														   						)
														 )
		);
	}

	public function edit_contact( $contactId)
	{

		$this->_program();

		$contactId = intval( $contactId);

		$profile = $this->company->get_contact_by_id( $contactId);

		$this->layout->view( 'company/edit_contact' , array('profile' => $profile));
	}

	public function del_company( $companyId)
	{

		$user = $this->get_my();

		if( 1 !== /*$this->common->record_exists( 'companies' , array('companyId' => $companyId , 'createUser' => $this->_G['userId'])) */ $user['groupId'])
		{
			return redirect('gate/operation_noright');
		}

		

		$st = $this->common->remove_by_id('companies' , 'companyId' , $companyId);

		if( $st)
			redirect( site_url('gate/operation_ok'));
		else
			redirect( site_url('gate/operation_fail'));
	}

	public function add_contact( $companyId = null)
	{

		$this->_program();

		if( $companyId)
		{
			$co = $this->setting->get_data_by_table_and_id( 'companies' , $companyId , 'companyId');
		}
		else
		{
			$list = $this->setting->get_selection_table('companies' , 'id' , 'companyname');
		}
		
		$this->layout->view('company/add_contact' , array('co' => isset( $co[0]) ? $co[0] : null , 
														  'company_list' => isset( $list) ? $list : null ,
														  )
		);
	}

	public function parse_name( $companyname)
	{
		$companyId = $this->company->get_companyid_by_name( trim( $companyname));

		redirect( site_url('company/edit_company/'.$companyId));
	}


}