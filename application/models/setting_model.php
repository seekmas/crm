<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


class Setting_model extends CI_Model {

	/**
	*
	* @access public
	* @param (string)
	* @return array
	**/
	public function get_data_by_table( $table) 
	{
		return $this->db->get( $table)->result_array();
	}

	/**
	*
	* @access public
	* @param (string , integer , string)
	* @return array
	**/
	public function get_data_by_table_and_id( $table , $id , $primary_key)
	{
		return $this->db->where( array( $primary_key => $id))->get( $table)->result_array();
	}

	/**
	*
	* @access public
	* @param (string , string , integer)
	* @return null
	**/
	public function del_setting_item( $module_name , $id , $primary_key)
	{
		$item = $this->db->select( $primary_key)->from( $module_name)->where( array($primary_key => $id))->get();

		if( $item->num_rows() > 0) 
		{
			$this->db->where( array( $primary_key => $id))->delete( $module_name);
		}
	}

	/**
	*
	* @access public
	* @param (string , array)
	* @return (null / string)
	**/
	public function add_setting_item( $module_name , $params , $primary_key)
	{
		$item = $this->db->select( $primary_key)->from( $module_name)->like( $params , '' , 'none')->get();

		if( $item->num_rows() === 0) 
		{
			$max_item =  $this->db->select('max('.$primary_key.') max_id')->from( $module_name)->get()->result_array();

			$params[$primary_key] = $max_item[0]['max_id']+1;

			$this->db->insert( $module_name , $params);
		}
		else 
		{
			return 'duplicate industry';
		}
	}

	/**
	*
	* @access public
	* @param (string , string , integer , array)
	* @return null
	**/
	public function edit_setting_item( $table , $primary_key , $params , $update_data)
	{
		$item = $this->db->select( $primary_key)->from( $table)->where( array($primary_key => $params))->get();

		if( $item->num_rows() > 0) 
		{	
			$this->db->where( array( $primary_key => $params))->update( $table , $update_data);
		}
		else
		{
			return 'not found';
		}
	}

	/**
	* simple description: 因为有大量的 <select></select> 表单 所以需要查询数据库一些固定的key value内容
	*
	* @access public
	* @param (string)
	* @return array
	**/
	public function get_selection_table( $table_name , $key_name , $value_name , $addon = null , $where = '1=1')
	{
		if( $addon)
			return $this->db->select( $key_name .' , '.$value_name .' , '.$addon )->where($where)->from( $table_name)->order_by($value_name)->get()->result_array();
		else
			return $this->db->select( $key_name .' , '.$value_name )->from( $table_name)->where($where)->order_by($value_name)->get()->result_array();
	}

	public function get_selection_key_value( $table_name , $key_name , $value_name )
	{
		$data = $this->get_selection_table( $table_name , $key_name , $value_name );
		$tmp = array();
		foreach ($data as $d) {
			$tmp[$d[$key_name]] = $d[$value_name];
		}
		return $tmp;
	}

	public function remove( $table , $id , $primary_key)
	{

		$ci = & get_instance();

		return $this->db->where( array($primary_key => $id))->delete( $table);
	}
}