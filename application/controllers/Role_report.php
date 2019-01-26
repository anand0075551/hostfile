<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_report extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Role_report_model');

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
				$insert = $this->Role_report_model->add_role();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'New Role Created Successfully...!!!');
					redirect(base_url('role/all_role'));
				}
			}
		}
      
       
		theme('add_role');
	}
	
	
	
	
 public function view_role($id){
		//restricted this area, only for admin
		permittedArea();

		$data['role_Details'] = $this->db->get_where('role', ['id' => $id]);
        
		theme('view_role', $data);
	}
	
	public function role_report_list()
	{
		$data['rolename'] = $this->db->get('role');
		
		theme('role_report_list', $data);
	}
	
	
	//Edit role
	
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
				$insert = $this->Role_report_model->edit_role($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Role Updated Successfully...!!!');
					redirect(base_url('role/all_role'));
				}
			}
		}

		theme('edit_role', $data);
	}
	
	//
	//Role function
	
	
	  public function get_user1()
     {
         $to_role=$_POST['to_role'];
         //echo $to_role;
         $query = $this->Role_report_model->get_user1($to_role);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->rolename."'>".$r->contactno.'-'.$r->first_name.' '.$r->last_name."</option>";
         } 

     }
	//
	 public function get_user2()
     {
         $to_role=$_POST['to_role'];
         //echo $to_role;
         $query = $this->Role_report_model->get_user2($to_role);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->id."'>".$r->id.'-'.$r->rolename."</option>";
         } 

     }
	//
	
	
	public function get_sub_account()
	{
		$id = $_POST['parent_id'];
		$query = $this->db->get_where('acct_categories', ['parentid' => $id]);
		$data = '<option value="">Deposit Sub-Accounts Type </option>';
		foreach($query->result() as $sub_account){
			
		echo  '<option value="'.$sub_account->id.'">'.$sub_account->id.'-'.$sub_account->name.'</option>';
	}
	}
	
	
public function Role_search_ListJson()
	{
	
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$assigned_role = $_POST['assigned_role'];
		$to_user1      = $_POST['to_user1'];
		
	
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');


		$queryCount = $this->Role_report_model->search_role_ListCount($assigned_role,$to_user1,$sf_time,$st_time);
		

		$query = $this->Role_report_model->search_role_List($limit, $start,$assigned_role,$to_user1,$sf_time,$st_time);
		
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
	if($query -> num_rows() > 0) 
	{
		foreach($query->result() as $r){
		  
				
			$query2 = $this->db->get_where('users', ['id' => $r->created_by]);

					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$created_by =  $row2->first_name.' '.$row2->last_name;
					}
					} else {
					$created_by =  " ";
					}
			
			   $button = '';
                $button.= '<a class="btn btn-primary editBtn" href="' . base_url('Role_report/view_role/'.$r->id) . '" data-toggle="tooltip" title="View">
					<i class="fa fa-eye"></i> </a>';
					
				
			
					
				 $data['data'][] = array(
					$button,
					$r->id,
					$r->rolename,
					$r->roleid,
				    $r->role_groups,
					$r->fees,
					$r->dedfees_payspec,
					$r->comfees_payspec,
					$r->com_per,
					$r->parent,
					$r->active,
					$r->permission_id,
					$r->type,
					$r->edit,
					$r->default,
					$created_by,	
					date('d-m-Y H:i:s', $r->created_at), 									
					date('d-m-Y H:i:s', $r->modified_at)
					
					
			);
		}
	}
		else{
			$data['data'][] = array(
				'No Role List Available' , '', '','', '','','','','','','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}

	
	
}