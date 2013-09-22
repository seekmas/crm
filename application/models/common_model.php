<?php

class Common_model extends CI_Model
{

	public function remove_by_id($table , $pk , $id_value)
	{
		if( empty( $pk) || empty($id_value))
			return 0;

		return $this->db->where( array($pk => $id_value))->delete( $table);
	}

	public function save_changes( $set_id , $set_value)
	{	
		$save = array();
		foreach ($_POST as $key=>$po) {
			$save[$key] = trim( $po);
		}

		$this->db->update('companies' , $save , $set_id.' like \'%'.$set_value.'%\'');
	}

	public function record_exists( $table , $where)
	{
		return $this->db->where( $where) -> get( $table) ->num_rows();
	}

	public function get_username_by_id( $id)
	{
		$tmp = $this->db->select('username')->from('user')->get()->row_array();
		return $tmp['username'];
	}

}