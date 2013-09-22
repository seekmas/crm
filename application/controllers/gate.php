<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once 'base.php';

class Gate extends CI_Base
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->layout->view('default/index');
	}

	public function cannot_access()
	{
		$this->layout->view( 'gate/alert' , array( 'info' => '不是管理员 无法进入设置' , 'return' => site_url()));
	}

	public function operation_ok()
	{
		$this->layout->view( 'gate/alert' , array( 'info' => '操作成功'));
	}

	public function operation_fail()
	{
		$this->layout->view( 'gate/alert' , array( 'info' => '操作失败'));
	}

	public function operation_noright()
	{
		$this->layout->view( 'gate/alert' , array( 'info' => '不是管理员 无权限修改/删除'));
	}

	public function oppo_exists()
	{
		$this->layout->view( 'gate/alert' , array( 'info' => '创建失败，已经存在同名的销售机会'));
	}

	public function oppo_ok()
	{
		$this->layout->view( 'gate/alert' , array( 'info' => '销售机会创建成功'));
	}

	public function create_contact_ok()
	{
		$this->layout->view( 'gate/alert' , array( 'info' => '联系人创建成功'));
	}

	public function oppo_change_ok()
	{
		$this->layout->view( 'gate/alert' , array( 'info' => '销售机会修改成功'));
	}

	public function oppo_change_fail()
	{
		$this->layout->view( 'gate/alert' , array( 'info' => '销售机会修改失败 : 您不是创建人 无法修改'));
	}

	public function convert_opportunity_fail()
	{
		$this->layout->view( 'gate/alert' , array( 'info' => '销售机会转成项目失败 : 您不是创建人 无法转换'));
	}

	public function add_reimburse_fail()
	{
		$this->layout->view( 'gate/alert' , array( 'info' => '添加报销失败'));
	}

	public function company_not_found()
	{
		$this->layout->view( 'gate/alert' , array( 'info' => '找不到该公司的资料,可能没有录入或者已经被删除'));
	}
}