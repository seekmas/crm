<?php

class Project_model extends CI_Model
{

	public function get_projects( $userId = '' , $page , $offset , $order = 'projectId' , $sort = 'desc' , $field = '*' , $groupId = null)
	{
		$field = 'p.projectId,p.projectName,p.startDate,p.endDate,p.days,p.TotalUsedDays,p.Usedays_sales,p.totalPrice,p.TotalIncome,p.TotalTax,p.TotalProfit,p.createDate,p.person,u.userName , c.categoryname';

		$join = 'join G_user u on u.userId = p.person join G_category c on c.categoryId = p.type';

		$where = $userId ? ' and p.userId = '.$userId . ' ' : '';

		if( $groupId === 1)
			$where = '';

		$return = $this->db->query('select top '.$offset.' '.$field.' from G_project p '.$join.' where p.projectId not in (select top '.($page-1)*$offset.' projectId from G_project) '.$where.' order by p.'.$order.' ' .$sort);

		$list = $return->result_array();

		$return->free_result();

		return $list;
	}

	public function get_total_number_of_project( $userId , $groupId = null)
	{
		$where = array( 'person' => $userId);

		if( $groupId === 1)
			$where = array();

		return $this->db->where( $where)->get('project')->num_rows();
	}

	public function get_opportunity( $userId , $page , $offset , $groupId)
	{

		$join = 'left join G_companies c on c.companyId = op.account left join G_user u on u.userId = op.sales left join G_stage s on s.sid = op.stage left join G_products p on p.proId = op.productId';

		$where = 'and op.createUser = '.$userId;

		if( $groupId === 1 )
			$where ='';

		return $this->db->query('select top '.$offset.' op.oppId,op.oppname,op.level,op.createdate,op.expectDate,op.updatedate,op.status,c.companyName,c.companyId,u.userName,s.stage,p.productname from G_opportunity op '.$join.' where oppId not in (select top '.$offset*($page-1).' oppId from G_opportunity) '.$where.' order by oppid desc')->result_array();
	}

	public function get_companyinfo_by_opportunity_id( $id)
	{
		return $this->db->select('c.companyId,c.companyName')
				 		->from('opportunity op')
				 		->join('companies c' , 'op.account = c.companyId')
				 		->where( array('oppId' => $id))
				 		->get()->row_array();
	}

	public function get_total_number_of_opportunity( $userId , $groupId)
	{

		$where =  array( 'oppId' => $userId);

		if( $groupId === 1)
			$where = array();

		return $this->db->where( $where)->get('opportunity')->num_rows();
	}

	public function get_project_by_id( $id)
	{
		return $this->db->where( array('projectId' => $id))->get('project')->row_array();
	}

	public function add_opportunity( $userId)
	{
		$max = $this->db->select('max(oppid) last')->from('opportunity')->get()->row_array();

		$oppo = $this->db->where( array('oppname' => $this->input->post('oppname')))
				 		 ->get('opportunity')
				 		 ->num_rows();

		if( $oppo > 0)
			return 0;
		$data = array( 'oppId' => $max['last'] + 1 ,
					   'oppname' => trim( $this->input->post('oppname')) ,
					   'productId' => $this->input->post('productId') , 
					   'account'   => $this->input->post('account') , 
					   'description' => trim( $this->input->post('description')) , 
					   'sales'		=> $this->input->post('sales') ,
					   'source'		=> $this->input->post('source') ,
					   'other'		=> trim( $this->input->post('other')) ,
					   'cooperator'	=> $this->input->post('cooperator') ,
					   'assistant'	=> $this->input->post('assistant') , 
					   'stage'		=> $this->input->post('stage') ,
					   'excutive'	=> $this->input->post('excutive') , 
					   'expectDate' => trim( $this->input->post('expectDate')) ,
					   'price'		=> floatval( $this->input->post('price')) ,
					   'contract'	=> $this->input->post('contract') , 
					   'status'		=> $this->input->post('status') ,
					   'createdate'	=> date('Y-m-d h:i:s') ,
					   'createUser'	=> $userId ,

		);
		return $this->db->insert('opportunity' , $data);
	}

	public function add_history( $userId)
	{

		$max = $this->db->select('max(id) max')->from('history')->get()->row_array();

		$history = array(
			'id'		=> $max['max']+1 ,
			'type'		=> $this->input->post('type') , 
			'cid'		=> $this->input->post('cid') , 
			'history'	=> $this->input->post('history') , 
			'createuser'	=> $userId ,
			'createdate'    => date('Y-m-d h:i:s') , 
			'lang'          => 86 ,
		);

		$this->db->insert( 'history' , $history);
	}

	public function del_opportunity($oppid , $userId , $groupId = null)
	{
		return $this->db->delete('opportunity' , array('createUser' => $userId , 'oppId' => $oppid));
	}

	public function save_opportunity( $userId , $groupId)
	{
		$record = $this->db->where( array( 'oppId' => $this->input->post('oppId') , 'createUser' => $userId))->get('opportunity')->num_rows();
		if( $record || $groupId === 1)
		{
			$oppId = $this->input->post('oppId');
			unset( $_POST['oppId']);
			return $this->db->update( 'opportunity' , $_POST , array('oppId' => $oppId));
		}
		else
		{
			return 0;
		}
	}

	public function convert_opportunity( $oppId , $userId , $groupId)
	{
		$oppo = $this->db->select('o.* , c.logogram')
						 ->from('opportunity o')
						 ->where( array('oppId' => $oppId , 'createUser' => $userId))
						 ->join('category c' , 'c.categoryId = o.productId')
						 ->get();

		if( $oppo->num_rows())
		{	

			$max = $this->db->query('select * from G_project where projectId in ( select max(projectId) projectId from G_project)')->row_array();

			$opportunity = $oppo->row_array();
			$contractNo = preg_match('/-([^-].)?$/', $max['contractNo'] , $match);

			if( $match[1] >= 80)
				$match[1] = 0;
			

			$project = array(
				'projectId' 	=> $max['projectId']+1,
				'projectName' 	=> $opportunity['oppname'] , 
				'person'		=> $opportunity['sales'] ,
				'type'			=> $opportunity['productId'] , 
				'source'		=> strlen( $opportunity['other']) ? $opportunity['other'] : $opportunity['source'] ,
				'companyName'   => $opportunity['account'] ,
				'totalPrice'	=> intval( $opportunity['price']) , 
				'contractNo'    => $opportunity['contract'] . '-' . $opportunity['logogram'] . date('Y-m-d') . '-'. ( intval($match[1])+1),
				'descrption'	=> $opportunity['description'] , 
				'createDate'	=> date('Y-m-d h:i:s') , 
				'userId'		=> $userId , 
				'oppid'			=> $oppId , 
				'lang'			=> 86 , 
			);

			$this->db->insert('project' , $project);
			return $max['projectId']+1;
		}
		else
		{
			return 0;
		}
	}

	public function save_contract()
	{
		preg_match('/\.\S+$/', $_FILES['contract']['name'] , $match);

		$new = $this->input->post('contractNo').$match[0];
		
		move_uploaded_file( $_FILES['contract']['tmp_name'] , FCPATH.'/upload/contract/'.$new);

		return $new;
	}

	public function save_project( $contractFile)
	{
		$_POST['contractFile'] = $contractFile;

		$projectId = $this->input->post('projectId');
		unset( $_POST['projectId']);

		$this->db->update('project' , $_POST , array('projectId' => $projectId));
	}

	public function get_reimburseitem_by_projectid( $projectid)
	{
		
		return $this->db->where( array('proid' => $projectid))->get('expense_item')->result_array();
	}

	public function get_reimburse_by_projectid( $projectid)
	{
		return $this->db->where( array('proid' => $projectid))->get('expense')->row_array();
	}

	public function calc_project_profit( $projectid)
	{
		$project = $this->db->select('totalPrice')->from('project')->where( array('projectId' => $projectid))->get()->row_array();

		$expense = $this->db->select('total')->from('expense')->where( array('proid' => $projectid))->get()->result_array();

		$total_expense = 0;

		foreach ($expense as $money) {
			$total_expense += $money['total'];
		}

		$profit = $project['totalPrice'] - $total_expense;

		$this->db->where( array('projectId' => $projectid))->update(  'project' , array('totalIncome' => $profit));
	}

	public function search_project()
	{
		$where = array();

		$this->input->post('userName') ? $where ['p.userId'] = $this->input->post('userName') : '';

		$field = 'p.projectId,p.projectName,p.startDate,p.endDate,p.days,p.TotalUsedDays,p.Usedays_sales,p.totalPrice,p.TotalIncome,p.TotalTax,p.TotalProfit,p.createDate,p.person,u.userName , c.categoryname';

		return $this->db->select( $field)
				 		->from('project p')
						->like( 'projectname' , $this->input->post('projectname') , 'both')
				 		->or_where( $where)
				 		->join('G_user u' , 'u.userId = p.person' , 'left')
				 		->join('G_category c' , 'c.categoryId = p.type' , 'left')
				 		->get()
				 		->result_array();
	}

	public function get_project_by_opportunity( $oppId)
	{
		return $this->db->where( array('oppid' => $oppId))
				 ->get('project')
				 ->result_array();
	}

	public function save_history()
	{
		$this->db->where( array('id'=>$this->input->post('id')))
				 ->update('history' , array('history'=> trim( $this->input->post('history'))));
	}
}