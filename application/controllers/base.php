<?php
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
* @description base class for all controller
*/


class CI_Base extends CI_Controller
{
	
	protected $_G;

	public function __construct()
	{
		parent::__construct();

		$this->load->driver('cache');
		
		if( $this->session->userdata('user'))
			$this->_G = $this->get_my();
	}

	public function get_my()
	{
		$str = $this->session->userdata('user');
		return $this->cache->file->get( $str);
	}
	
	public function _button()
	{
		return array();
	}

	public function referer()
	{
		return isset( $_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : site_url();
	}

}