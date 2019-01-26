<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Role_model');

		check_auth(); //check is logged in.
	}
	
	public function add_role(){
		//restricted this area, only for admin
		permittedArea();

		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_role') die('Error! sorry');

			
			$this->form_validation->set_rules('rolename', 'Role Name', 'required|trim|is_unique[role.rolename]');
            $this->form_validation->set_rules('role_groups', 'Role Groups', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Role_model->add_role();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'New Role Created Successfully...!!!');
					redirect(base_url('role/all_role'));
				}
			}
		}
      
       
		theme('add_role');
	}
	
	
	public function all_role()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('all_role');
	}
	
	public function roleListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Role_model->roleListCount();

		
		$query = $this->Role_model->roleList($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
      {
		foreach($query->result() as $r){
			
			if( $r->role_groups == 1)
			{
				$role_groups = 'Management';
			}elseif( $r->role_groups == 2)
			{
				$role_groups = 'Managers';
			}elseif( $r->role_groups == 3)
			{
				$role_groups = 'Agents';
			}elseif( $r->role_groups == 4)
			{
				$role_groups = 'Users';
			}

			//Action Button
			$button = '';
					$button .= '<a class="btn btn-primary editBtn" href="'.base_url('role/view_role/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			/*$button .= '<a class="btn btn-info editBtn"  href="'.base_url('add_shipment/edit_shipment/'. $r->id).'" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';*/
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>'; 
				
			$data['data'][] = array(
			$button,
			    $role_groups,				
				$r->rolename,
				$r->id				
			);
		}
}else{
	   $data['data'][]=array(
	     'You have no Data' ,'','','',''
	);
}
		echo json_encode($data);

	}
	
	
	public function view_role($id){
		//restricted this area, only for admin
		permittedArea();

		$data['role_Details'] = $this->db->get_where('role', ['id' => $id]);
        
		theme('view_role', $data);
	}
	
	public function edit_role($id){
		//restricted this area, only for admin
		permittedArea();
		$data['role'] = singleDbTableRow($id,'role');
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_role') die('Error! sorry');
            $this->form_validation->set_rules('rolename', 'Role Name ', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->Role_model->edit_role($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Role Updated Successfully...!!!');
					redirect(base_url('role/all_role'));
				}
			}
		}

		theme('edit_role', $data);
	}
	public function deleteAjax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'role');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$categoryName} Role");
		//Now delete permanently
		$this->db->where('id', $id)->delete('role');
		return true;
	}
	
	

}
?>