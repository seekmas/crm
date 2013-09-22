<?php

class Company_model extends CI_Model {

	private $companies ;

	private $user;

	public function __construct()
	{
		$this->companies = 'G_companies';
		$this->user      = 'G_user';
	}

	/**
	*
	* @author mot.wu 
	* @access public
	* @return array
	**/
	public function get_companies( $page = 1 , $offset = 15 , $order = 'createDate' , $sort = 'desc' , $where = '')
	{
		if( trim($where))
			$offset = 10000;
		$query = $this->db->query('select top '.$offset.' c.id,c.companyId,c.level,c.companyname,c.email,c.phone,c.createDate , u.userName from '.$this->companies.' as c left join '.$this->user.' as u on c.createUser = u.userId  where c.id not in( select top '.($page-1)*$offset.' id from '.$this->companies.' order by '.$order.' '.$sort.') '.$where.' order by c.'.$order.' '.$sort);
		$result = $query->result_array();

		$query->free_result();

		return $result;
	}

	public function get_contacts( $page , $offset , $order , $sort , $where = '')
	{
		return $this->db->query('select top '.$offset.' contactId , fname , lname , position , companyname , department , businessphone , email , city, createDate  from G_contacts where contactId not in( select top '.($page-1)*$offset.' contactId from G_contacts '.$where.' order by '.$order.' '.$sort.') '.($where ? ' and '.$where : '').' order by '.$order.' '.$sort)->result_array();
	}

	public function get_total_num_contacts()
	{
		return $this->db->select('contactId')->from('contacts')->get()->num_rows();
	}

	public function get_contact_by_id( $contactId)
	{
		return $this->db->where( array('contactId' => $contactId))->get('contacts')->row_array();
	}

	public function total_of_companies()
	{
		return $this->db->get('companies')->num_rows();
	}

	public function get_users()
	{
		return $this->db->select('userId,userName,othername')->get('user')->result_array();
	}

	public function get_levels()
	{
		return $this->db->select('lid,level')->get('level')->result_array();
	}

	public function get_data_by_table_and_id( $table , $id , $primary_key = 'id')
	{
		return $this->db->where( $primary_key.' = '.$id)->get( $table)->row_array();
	}


	/**
	* 返回搜索的where条件
	*
	* @return string
	**/
	public function search()
	{
		$companyName = trim( $this->input->post('companyname'));

		foreach ($_GET as $key => $value) 
		{
			if( !trim( $value))
				continue;
			else if( 'companyname' === $key)
				$params[] =  $key . ' like \'%' . trim( $value) .'%\'';
			else
				$params[] =  $key . ' = \'' . trim( $value) .'\'';
		}

		if( empty( $params))
			return ;

		return implode($params, ' and ');
	}

	public function get_by_tables( $field)
	{
		$list = array();
		foreach ($field as $table) {
			$list[$table] = $this->db->get($table)->result_array();
		}
		return $list;
	}

	public function get_oppportunity_by_companyid( $companyid)
	{
		return $this->db->select('o.oppId,o.oppname,o.createdate,o.expectDate,o.updatedate,o.status,p.productname,s.stage,s.description,')
						->from('opportunity o')
						->where('account='.$companyid)
						->join('products p' , 'p.proId = o.productId')
						->join('stage s' , 's.sid = o.stage')
						->get()
						->result_array();
	}

	public function get_contacts_by_companyname( $companyname)
	{
		return $this->db->select('*')->from( 'contacts')->like('companyname' , $companyname , 'both')->get()->result_array();
	}

	public function name_exist()
	{
		$name = trim( $this->input->post('companyname'));

		return $this->db->select('companyId,companyName')->like('companyname' , $name , 'both')->get('companies')->result_array();
	}

	public function create_company_profile( $userId)
	{

		$companyId = random_string('alnum', 8).'-'.random_string('alnum', 4).'-'.random_string('alnum', 4).'-'.random_string('alnum', 16) ;

		$companyId = strtoupper( $companyId);

		$max = $this->db->select('max(id) max')->from('companies')->get()->row_array();

		$company = array(
			'id' => $max['max']+1,
			'companyId' => $companyId , 
			'companyname' => trim( $this->input->post('companyname')) , 
			'industry' => trim( $this->input->post('industry')),
			'source' => trim( $this->input->post('source')),
			'other' => trim( $this->input->post('other')),
			'employees' => trim( $this->input->post('employees')),
			'revenue' => trim( $this->input->post('revenue')),
			'background' => trim( $this->input->post('background')),
			'phone' => trim( $this->input->post('phone')),
			'fax'   => trim( $this->input->post('fax')),
			'email' => trim( $this->input->post('email')),
			'url' => trim( $this->input->post('url')),
			'country' => $this->input->post('country'),
			'province' => $this->input->post('province'),
			'city' => trim( $this->input->post('city')),
			'zip' => trim( $this->input->post('zip')),
			'address' => trim( $this->input->post('address')),
			'level' => $this->input->post('level'),
			'taxnumber' => trim( $this->input->post('taxnumber')),
			'invoicephone' => trim( $this->input->post('invoicephone')),
			'invoiceaddress' => trim( $this->input->post('invoiceaddress')),
			'bank' => trim( $this->input->post('bank')),
			'bankphone' => trim( $this->input->post('bankphone')),
			'bankaddress' => trim( $this->input->post('bankaddress')),
			'Active' => $this->input->post('active'),
			'createDate' => date('Y-m-d h:i:s'),
			'createUser' => $userId,
			'categoryId' => 1 ,
		);
		
		$this->db->insert( 'companies' , $company);

		$maxId = $this->db->select('max(contactId) max')->from('contacts')->get()->row_array();

		$contact = array(
			'contactId' => $maxId['max']+1 ,
			'fullname' => trim( $this->input->post('fname')) .' '. trim( $this->input->post('lname')) ,
			'fname' => trim( $this->input->post('fname')) ,
			'lname' => trim( $this->input->post('lname')) ,
			'position' => trim( $this->input->post('position')) ,
			'mobile' =>trim( $this->input->post('mobile')) ,
			'email' => trim( $this->input->post('cemail')) , 
			'companyname' => trim( $this->input->post('companyname')) ,
			'sex' => $this->input->post('sex') , 
			'businessphone' => trim( $this->input->post('businessphone')) , 
			'worklang' => $this->input->post('worklang') , 
			'assistance' => $this->input->post('assistance') ? trim( $this->input->post('assistance')) : '' , 
			'secretary' => $this->input->post('secretary') ? trim( $this->input->post('secretary')) : '' , 
			'background' => trim( $this->input->post('cbackground')) ,
			'subscribe' => 1 ,
			'createDate' => date('Y-m-d h:i:s') , 
			'createUser' => $userId,
		);

		$this->db->insert('contacts' , $contact);

		return $companyId;
	}

	public function add_contact( $userId , $idcard = null)
	{

		$maxId = $this->db->select('max(contactId) max')->from('contacts')->get()->row_array();

		$contact = array(
			'contactId' => $maxId['max']+1 ,
			'fullname' => trim( $this->input->post('fname').' '.$this->input->post('lname')) ,
			'fname' => trim( $this->input->post('fname')) , 
			'lname' => trim( $this->input->post('lname')) , 
			'position' => trim( $this->input->post('position')) ,
			'companyname' => trim( $this->input->post('companyname')) , 
			'sex' => $this->input->post('sex') , 
			'businessphone' => trim( $this->input->post('businessphone')) , 
			'email' => trim( $this->input->post('email')) ,
			'worklang' => $this->input->post('worklang') , 
			'weibo' => trim( $this->input->post('weibo')) ,
			'assistance' => trim( $this->input->post('assistance')) , 
			'secretary' => trim( $this->input->post('secretary')) , 
			'phone' => trim( $this->input->post('phone')) , 
			'createDate' => date('Y-m-d h:i:s') , 
			'createUser' => $userId , 
			'IDcard' => $idcard , 
			'subscribe' => 1 ,
		);

		return $this->db->insert( 'contacts' , $contact);
	}

	public function save_contact()
	{
		$contactId = $this->input->post('contactId');
		unset( $_POST['contactId']);

		$this->db->where( array('contactId' => $contactId))->update('contacts' , $_POST);
	}

	public function get_companyid_by_name( $name)
	{
		$comp = $this->db->select('companyId')->where( array('companyname'=>$name))->from('companies')->get()->row_array();

		return $comp['companyId'];
	}

}