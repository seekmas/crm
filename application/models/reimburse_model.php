<?php

class reimburse_model extends CI_Model
{
	public function __construct()
	{

	}

	public function get_reimburse( $page , $offset , $order , $sort , $userId = 0)
	{
		if( $userId === 0)
			$where = '1';
		else 
			$where = 'userId = '.$userId;

		return $this->db->query('select top '.$offset.' epid,ename,explanation,total,isExpense,depart_confirm,financial_confirm from G_expense where epid not in ( select top '.($page-1)*$offset.' epid from G_expense where '.$where.'  order by '.$order.' '.$sort.') and '.$where.' order by '.$order.' '.$sort)->result_array();
	}

	public function total_reimburse( $userId = 0)
	{
		if( $userId === 0)
			$where = '';
		else 
			$where = 'userId = '.$userId;

		return $this->db->select('epid')->from('expense')->where($where)->get()->num_rows();
	}

	public function new_reimburse_item( $userId = 0)
	{

		$max = $this->db->select('max(eid) max')->from('expense_item')->get()->row_array();

		$new = array( 'eid'   => $max['max']+1 ,
					  'userId' => $userId ,
					  'epid'   => $this->input->post('epid') ,
					  'proid' => intval( $this->input->post('project')) , 
					  'oppid' => intval( $this->input->post('oppid')) , 
					  'costid' => $this->input->post('costid') , 
					  'RecDate' => date( 'Y-m-d' , strtotime( $this->input->post('RecDate'))) ,
					  'airfare' => floatval( $this->input->post('airfare')) ,
					  'hotels'  => floatval( $this->input->post('hotels')) ,
					  'meals'  => floatval( $this->input->post('meals')) ,
					  'transport' => floatval( $this->input->post('transport')) ,
					  'misc'      => floatval( $this->input->post('misc')) ,
					  'costid'    => intval( $this->input->post('costid')) , 
					  'explanation' => $this->input->post('explanation') , 
					  'type' => $this->input->post('type') ,
					  'createdate' => date('Y-m-d h:i:s') , 
		);

		$this->db->insert('expense_item' , $new);

		return $new['epid'];
	}

	public function get_department( $userId)
	{
		return $this->db->query('select epid,ename,explanation,total,isExpense,createdate from G_expense where (depart_confirm = 0 or depart_confirm is null) and department like '.$userId)->result_array();
	}

	public function get_financial( $userId)
	{
		return $this->db->query('select epid,ename,explanation,total,isExpense,createdate from G_expense where (financial_confirm = 0 or financial_confirm is null) and financial like '.$userId)->result_array();
	}

	public function get_general( $userId)
	{
		return $this->db->query('select epid,ename,explanation,total,isExpense,createdate from G_expense where (general_confirm = 0 or general_confirm is null) and general like '.$userId)->result_array();

	}

	public function add_reimburse()
	{

		$max = $this->db->select('max(epid) max')->from('expense')->get()->row_array();

		$_POST['epid'] =  $max['max']+1;
		
		return $this->db->insert('expense' , $_POST);
	}

	public function calculator( $id = 0)
	{

		$items = $this->db->select('airfare,meals,transport,hotels,misc')
						  ->where( array( 'epid' => ( $id ? $id : intval( $this->input->post('epid')))   ))
						  ->from('expense_item')
						  ->get()
						  ->result_array();


		$calc = array();
		foreach ($items as $item) {
			foreach ($item as $key => $value) {
				$calc['total'.ucwords( $key)] +=$value; 
			}
		}

		foreach ($calc as $c) {
			$total += $c;
		}

		$calc['total'] = $total;

		$this->db->where( array('epid' =>  $id ? $id : intval( $this->input->post('epid')) ))->update('expense' , $calc);
	}

	public function del_item( $eid , $userId)
	{

		$r = $this->db->select('epid')->from('expense_item')->where( array('userId' => $userId , 'eid' => $eid))->get()->row_array();

		$this->db->delete('expense_item'  , array('userId' => $userId , 'eid' => $eid));

		$this->calculator( $r['epid']);

		return $r['epid'];

	}

	public function get_item_by_id( $id)
	{
		return $this->db->where( array( 'eid' => $id))->get('expense_item')->row_array();
	}

	public function save_item()
	{
		$eid = $this->input->post('eid');
		unset( $_POST['eid']);
		$this->db->update('expense_item' , $_POST , array('eid' => $eid));

		return $this->input->post('epid');
	}

	public function save_report()
	{
		$epid = $this->input->post('epid');
		unset( $_POST['epid']);

		$this->db->where(array('epid' => $epid))->update('expense' , $_POST);
	}

	public function comfirm_reimburse( $type , $epid , $auth , $userId)
	{
		$this->db->where( array( $auth => $userId , 'epid' => $epid))
				 ->update('expense' , array($type.'_confirm' => 1));
	}

	public function isExpense_query( $epid)
	{
		$expense = $this->db->select('*')->from( 'expense')->where( array('epid' => $epid))->get()->row_array();
		
		if( $expense['depart_confirm'] && $expense['financial_confirm'])
		{
			$this->db->where( array('epid' => $epid))->update('expense' , array('isExpense' => 1));
		}
	}

	public function get_opportunity_by_keyword( $keyword)
	{
		return $this->db->select('oppId,oppname')->like( 'oppname' , $keyword)->from('opportunity')->get()->result_array();
	}

	public function get_project_by_keyword( $keyword)
	{
		return $this->db->select('projectId,projectName')->like( 'projectName' , $keyword)->from('project')->get()->result_array();
	}
}