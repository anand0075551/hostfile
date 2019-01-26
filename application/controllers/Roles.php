<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Roles_model');
		$this->load->model('vouchers_model');

		check_auth(); //check is logged in.
	}

	public function roles_index()
	{
		//restricted this area, only for admin
		permittedArea();
		$data['roles'] = singleDbTableRow('roles');

		theme('roles_index', $data);
	}

	/**
	 * Assign Roles to User Type
	 *
	 */
	 
	public function authorizations_index(){
		//restricted this area, only for admin
		permittedArea();

		

		theme('authorizations_index');
	}
/**
	 * General/Private Voucher list from db
	 * @return Json format
	 * usable only via API
	 */

	public function vouchersListJson(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$fromDate = date('Y-m-d').' 00:00:00';
		$toDate = date('Y-m-d').' 23:59:59';

		if($this->input->get('dateRange') != '')
		{
			$dateRange = $this->input->get('dateRange');
			$dateRange = explode(' - ', $dateRange);
			$fromDate = $dateRange[0].' 00:00:00';
			$toDate = $dateRange[1].' 23:59:59';

		}
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->Roles_model->authorizationsListCount();
		$query = $this->Roles_model->authorizationsList($limit, $start);
	

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		IF ($query -> num_rows() > '0' )
		{
		foreach($query->result() as $r){
		//	if ($r->identity == 'Voucher'){
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('roles/authorizations_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			//$button .= '<a class="btn btn-info editBtn"  href="'.base_url('vouchers/edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
				//		<i class="fa fa-edit"></i> </a>';
			//$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
			//			<i class="fa fa-trash"></i> </a>';
	

			$data['data'][] = array(
				'<a  href="'.base_url('roles/authorizations_view/'. $r->id).'">'.$r->user,					
				'<a  href="'.base_url('roles/authorizations_view/'. $r->id).'">'.$r->usertype,		
				'<a  href="'.base_url('roles/authorizations_view/'. $r->id).'">'.$r->identity_id,
				'<a  href="'.base_url('roles/authorizations_view/'. $r->id).'">'.$r->modified_by."</a>",	
				$button
			);
		//}
		}
		}
		else{
			$data['data'][] = array (
			'Roles Are Not Available' , '', '','', '','','', '');
		}

		echo json_encode($data);

	}	
/*Authorizations View */
public function authorizations_view($id){
		//restricted this area, only for admin
	//	permittedArea();
		$data['authorizations'] = singleDbTableRow($id,'authorizations');
	
		theme('authorizations_view', $data);
	}	
	
	/* Edit Authorizations */
public function edit_authorizations($id){
		//restricted this area, only for admin
		permittedArea();

		$data['authorizations'] = singleDbTableRow($id,'authorizations');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_authorizations') die('Error! sorry');

		
			$this->form_validation->set_rules('usertype', 'User Type', 'required|trim');			

			if($this->form_validation->run() == true)
			{
				$insert = $this->Roles_model->edit_authorizations($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'To The Selected User Type, Roles Updated Successfully...!!!');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}

		theme('edit_authorizations', $data);
	}
	
	/**
	 * Assign Roles to User Type
	 *
	 */
	 
	public function create_authorizations(){
		//restricted this area, only for admin
		permittedArea();

		$data['rolename'] = $this->db->get_where('role', ['type' => 'role_name']);
		
		 $data['category'] = $this->db->get('countries');
		if($this->input->post())
		{
			if($this->input->post('submit') != 'create_authorizations') die('Error! sorry');
			
				
				$this->form_validation->set_rules('rolename', 'User Type', 'required|trim');
				$this->form_validation->set_rules('ledg_01', 'Ledger Overview	', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Roles_model->create_authorizations();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Authorizations Created Successfully!');
					redirect(base_url('roles/add_roles'));
				}

			}
		}

		theme('create_authorizations', $data);
	}
	/**
	 * roles add method
	 *
	 */
	 
	public function add_roles(){
		//restricted this area, only for admin
		permittedArea();

		$data['countries'] = $this->db->get('countries');
		 $data['category'] = $this->db->get('countries');
		 
		 	$data['sub_account1']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
			$data['sub_account2']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
		 $data['pay_spec'] = $this->db->get('acct_categories');
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_roles') die('Error! sorry');
			
			$this->form_validation->set_rules('type', 'Type Name', 'required|trim');
			$this->form_validation->set_rules('rolename', 'Role Name', 'required|trim');
			
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->Roles_model->add_roles();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'New Description against Selected Type Created Successfully!');
					redirect(base_url('admin_settings/all_roles'));
				}

			}
		}

		theme('add_roles');
	}
	
	/**
	 * Permission Group add method
	 *
	 */
	 
	public function add_permission(){
		//restricted this area, only for admin
		permittedArea();

		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_permission') die('Error! sorry');

			$this->form_validation->set_rules('group_name', 'Permission Group Name', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Roles_model->add_permission();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'New User-Role Created Successfully!');
					redirect(base_url('roles/add_roles'));
				}

			}
		}

		theme('add_permission');
	}
	/**
	 * Agent list from db
	 * @return Json format
	 * usable only via API
	 */

	public function rolesListJson(){
		
		$fromDate = date('Y-m-d').' 00:00:00';
		$toDate = date('Y-m-d').' 23:59:59';

		if($this->input->get('dateRange') != '')
		{
			$dateRange = $this->input->get('dateRange');
			$dateRange = explode(' - ', $dateRange);
			$fromDate = $dateRange[0].' 00:00:00';
			$toDate = $dateRange[1].' 23:59:59';

		}
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->roles_model->rolesListCount();

	/*	$query = $this->db->query("select roles.*, users.first_name, users.last_name
				from roles LEFT JOIN users
				ON roles.created_by = users.id ORDER BY roles.id DESC Limit {$start}, {$limit}"); */
		
		$query  = $this->roles_model->rolesList();
		echo $query ;
		
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		foreach($query->result() as $r){

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-info editBtn"  href="'.base_url('roles/edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
	
//<th>Name</th> Voucher_index.php at View
//	<th>Amount</th>
//	<th>E-Pin No</th>	
//	<th>Valid From</th>
//	<th>Epin Expires</th>								
//	<th>Added By</th>
//	<th width="20%">Action</th>

			$data['data'][] = array(
				$r->rolename,			
				$r->permission_id,
				$r->view,
				//$r->start_date,
				//$r->end_date,
				$r->first_name.' '.$r->last_name,								
				$button
			);
		}

		echo json_encode($data);
//Anand
	}


	public function edit($id){
		//restricted this area, only for admin
		permittedArea();

		$data['roles'] = singleDbTableRow($id,'roles');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_roles') die('Error! sorry');

			$this->form_validation->set_rules('roles_name', 'roles Name', 'required|trim');
		//	$this->form_validation->set_rules('commission_percent', 'Commission', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			$this->form_validation->set_rules('start_date', 'roles Valid Start Date', 'required|trim');
			$this->form_validation->set_rules('end_date', 'roles Valid End Date', 'required|trim');			

			if($this->form_validation->run() == true)
			{
				$insert = $this->roles_model->edit_roles($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Roles Updated Successfully...!!!');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}

		theme('edit_roles', $data);
	}


	/**
	 * This isApi for deleting an agent
	 */

	public function deleteAjax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'role');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$rolename} role");
		//Now delete permanently
		$this->db->where('id', $id)->delete('role');
		return true;
	}

	


}
