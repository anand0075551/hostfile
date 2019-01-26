	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_info extends CI_Controller {

	function __construct(){
		parent:: __construct();
		
		$this->load->model('notification_model'); 
		$this->load->model('payment_model'); 
		$this->load->model('Ref_info_model');


		check_auth(); //check is logged in.
	}

	
	
public function ref_infomation()
	{
		
		theme('change_ref_info');	
	}
	
//listing
	public function referral_ListJson(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$role = singleDbTableRow($user_id)->rolename;
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Ref_info_model->ref_listcount();

		
		$query = $this->Ref_info_model->all_ref_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
		  {
			$cnt = 1;
			foreach($query->result() as $r){
					
				//Action Button
				$button = '';
				$button1 = '';
				$button2 = '';
				
				
				$button2 .= '<a class="btn btn-primary" href="'.base_url('user/profile_view/'. $r->id).'" title="status" ><i class="fa fa-eye" aria-hidden="true"></i> </a>';
				
				$button .= '<a class="btn btn-success" href="'.base_url('Ref_info/add_new_root_id/'. $r->id).'" data-toggle="modal" data-target="#root_id" title="status" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Root ID </a>';
				
				 $button1 =  ' <select name="'.$cnt.'status" class="form-control" id="'.$cnt.'status">
									<option value="">Select Status</option>
									<option value=0>Pending</option>
									<option value=1>Active</option>
									<option value=3>Inactive</option>
									<option value=2>Block by Admin</option>
								</select>';
				$button1 .='<input type="hidden" name ="'.$cnt.'aid" id ="'.$cnt.'aid" value="'.$r->id.'">';
				
				$button1 .= '<a class="btn btn-primary editBtn" href=""  data-toggle="tooltip" title="Status" onclick="change_status('.$cnt.')"><i class="fa fa-edit"></i> </a> ';
				

				if($r->active == 1){
					$sts = "<span class='label label-primary'> Active </span>";
				}
				elseif($r->active == 2)
				{
					$sts = '<span class="label label-danger">Inactive</span>';
				}elseif($r->active == 3){
				
					$sts ='<span class="label label-warning"> Block By Admin</span>';
				}
				elseif($r->active == 0){
				
					$sts ='<span class="label label-info">Pending</span>';
				}
				
				$get_role = $this->db->get_where('role',['id'=>$r->rolename]);
				foreach($get_role->result() as $r_name);
				
				
				$data['data'][] = array(
					$button2,			
					$r_name->rolename,			
					$r->referral_code,			
					$r->first_name."".$r->last_name,
					$r->contactno,
					$r->root_id,
					$button,
					$sts,
					$button1
				);
				$cnt ++;	
			}
		}
		else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','','','','','',''
				);
			}
			echo json_encode($data);
	}


//update_status	
public function update_status()
	{
				
		 $aid      =   $_POST['aid'];
         $status   =   $_POST['status'];
		
				
		$insert = $this->Ref_info_model->update_sts($aid, $status);
		if($insert)
		{
			$this->session->set_flashdata('successMsg', 'Status Updated Successfully...!!!');
			redirect(base_url('Ref_info/ref_infomation'));
		}
		
	}		
	
	
//Root ID addedd
public function add_new_root_id($id)
	{
		
	//root id	
		if($this->input->post('submit') == 'root_id') 
			{

				
				$insert = $this->Ref_info_model->assign_root_id();	
					
				$this->session->set_flashdata('successMsg', 'New Root ID Assigned Successfully');
				redirect(base_url('Ref_info/assigned_root_list'));
						
					
			}
		
		
		$data['root_id'] = $this->db->get_where('users', ['id' => $id]);		
		theme('assign_root',$data);	
	}		


	
	
	
//Assigned list.	
	
public function assigned_root_list()
	{
		
		theme('assigned_root_id_list');
	}	
	 	
		

//Assigned list...
	public function assigned_ListJson(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Ref_info_model->assigned_listcount();

		
		$query = $this->Ref_info_model->all_assigned_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
		  {
			foreach($query->result() as $r){
					
				$user_name = singleDbTableRow($r->user_name)->first_name.''.singleDbTableRow($r->user_name)->last_name;
				
								
				if($r->status == 1){
					$sts = "<span class='label label-success'> Active </span>";
				}
				elseif($r->status == 3)
				{
					$sts = '<span class="label label-danger">Deactive</span>';
				}else{
					
					$sts = '<span class="label label-info">'.$r->status.'</span>';
				
				}
				
				
				$data['data'][] = array(		
					singleDbTableRow($r->updated_by)->first_name.''.singleDbTableRow($r->updated_by)->last_name,			
					singleDbTableRow($r->role_name,'role')->rolename,			
					$r->referral_id,			
					$user_name,
					$r->contact_no,
					$r->current_root_id,
					$r->assign_root_id,
					$sts
				);
					
			}
		}
		else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','','','','',''
				);
			}
			echo json_encode($data);
	}

	
//Search Refferal List

	public function search_refferal_ListJson(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$role_name = $_POST['role_name'];
		$user_name = $_POST['user_name'];
		
		$queryCount = $this->Ref_info_model->search_ref_listcount($role_name,$user_name);

		
		$query = $this->Ref_info_model->refferal_List($limit, $start, $role_name,$user_name);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
		  {
			  $cnt = 1;
			foreach($query->result() as $r){
					
				//Action Button
				$button = '';
				$button1 = '';
							
				$button .= '<a class="btn btn-success" href="'.base_url('Ref_info/add_new_root_id/'. $r->id).'" data-toggle="modal" data-target="#root_id" title="status" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Root ID </a>';
				
				$button1 =  ' <select name="'.$cnt.'status" class="form-control" id="'.$cnt.'status">
									<option value="">Select Status</option>
									<option value=1>Active</option>
									<option value=3>Deactive</option>
									<option value=2>Block</option>
								</select>';
				$button1 .='<input type="hidden" name ="'.$cnt.'aid" id ="'.$cnt.'aid" value="'.$r->id.'">';
				
				$button1 .= '<a class="btn btn-primary editBtn" href=""  data-toggle="tooltip" title="Status" onclick="change_status('.$cnt.')"><i class="fa fa-edit"></i> </a> ';
				

				if($r->active == 1){
					$sts = "<span class='label label-primary'> Active </span>";
				}
				elseif($r->active == 3)
				{
					$sts = '<span class="label label-danger">Deactive</span>';
				}elseif($r->active == 2){
				
					$sts ='<span class="label label-warning"> Block </span>';
				}
				
				
				$get_role = $this->db->get_where('role',['id'=>$r->rolename]);
				foreach($get_role->result() as $r_name);
				
				
				$data['data'][] = array(
					$r_name->rolename,			
					$r->referral_code,			
					$r->first_name."".$r->last_name,
					$r->contactno,
					$r->root_id,
					$button,
					$button1,
					$sts
				);
				$cnt ++;		
			}
		}
		else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','','','','',''
				);
			}
			echo json_encode($data);
	}



//Search assigned Refferal List

	public function search_asssign_ListJson(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$role_name = $_POST['role_name'];
		$user_name = $_POST['user_name'];
		
		$queryCount = $this->Ref_info_model->search_new_ref_listcount($role_name,$user_name);

		
		$query = $this->Ref_info_model->assign_refferal_List($limit, $start, $role_name,$user_name);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
		  {
			foreach($query->result() as $r){
					
				$user_name = singleDbTableRow($r->user_name)->first_name.''.singleDbTableRow($r->user_name)->last_name;
				
				$status = singleDbTableRow($r->status,'status')->status;
				
				$status = singleDbTableRow($r->status,'status')->status;
				
				if($r->status == 1){
					$sts = "<span class='label label-success'> Active </span>";
				}
				elseif($r->status == 3)
				{
					$sts = '<span class="label label-danger">Deactive</span>';
				}else{
					
					$sts = '<span class="label label-info">'.$r->status.'</span>';
				
				}
				
				$data['data'][] = array(		
					singleDbTableRow($r->updated_by)->first_name.''.singleDbTableRow($r->updated_by)->last_name,			
					singleDbTableRow($r->role_name,'role')->rolename,			
					$r->referral_id,			
					$user_name,
					$r->contact_no,
					$r->current_root_id,
					$r->assign_root_id,
					$sts
				);
					
			}
		}
		else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','','','','',''
				);
			}
			echo json_encode($data);
	}

	
//Get User Name all list
public function get_ref_info(){
		$user_info = $this->session->userdata('logged_user');
		$current_ref = singleDbTableRow($user_id)->referral_code;
		$role = singleDbTableRow($user_id)->rolename;

		
		$rol_id = $_POST['rol_id'];
		
		$get_user_name = $this->db->get_where('users', ['rolename'=>$rol_id]);
		if($get_user_name->num_rows() > 0){
			echo "<option value=''>Choose User Name</option>";
			foreach($get_user_name->result() as $c){
				echo "<option value='".$c->id."'>".$c->first_name.''.$c->last_name."</option>";
			}
		}
	}	
	
	
//Get User Name Assigned list
public function get_ref_list(){
		$rol_id = $_POST['rol_id'];
		
		$get_user = $this->db->group_by('user_name')->get_where('ref_change', ['role_name'=>$rol_id]);
		if($get_user->num_rows() > 0){
			echo "<option value=''>Choose User Name</option>";
			foreach($get_user->result() as $u){
				echo "<option value='".$u->user_name."'>".singleDbTableRow($u->user_name)->first_name.''.singleDbTableRow($u->user_name)->last_name."</option>";
			}
		}
	}	

	
//role and referrals declaration 
	
 public function role_referral()
	{
		permittedArea();
		
		if($this->input->post('submit') == 'role_referral') 
			{
				$insert = $this->Ref_info_model->role_referral_dec();	
					
				$this->session->set_flashdata('successMsg', 'Role or Referral Declared Successfully');
				redirect(base_url('Ref_info/role_referral'));
						
			}
		theme('role_&_referral_declaration');
	}	
	 

//Role And Referral Declaration list

	 public function role_referral_ListJson(){
		
		permittedArea();
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->Ref_info_model->role_referral_listcount();

		
		$query = $this->Ref_info_model->role_referral_List();

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
		  {
			foreach($query->result() as $r){
					
				
				$data['data'][] = array(		
					$r->activity_type,
					singleDbTableRow($r->from_role,'role')->rolename,
					singleDbTableRow($r->to_role,'role')->rolename,
					$r->f_role_points,
					$r->t_role_points,
					$r->points_mode,
					$r->limit
				);
					
			}
		}
		else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','','','',''
				);
			}
			echo json_encode($data);
	}


//Role Transfer list

 public function role_transfer()
	{
		theme('role_transfer');
	}	
	 

//listing
	public function role_transfer_listjson(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$role = singleDbTableRow($user_id)->rolename;
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Ref_info_model->role_trans_listcount();

		
		$query = $this->Ref_info_model->role_trans_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query->num_rows() > 0) 
		  {
			foreach($query->result() as $r){
					
				//Action Button
				$button = '';
				
				//$get_rol = $this->db->get_where('role_refrral_declaration',['from_role'=>$role,'to_role'=>$r->rolename]);
				
				$get_rol = $this->db->get_where('role_refrral_declaration',['to_role'=>$r->rolename]);
				if($get_rol->num_rows() > 0){
				
					$button .= '<a class="btn btn-success" href="'.base_url('Ref_info/transfer_role/'. $r->id).'" data-toggle="modal" data-target="#transfer" title="transfer_role" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Transfer Role</a>';				
				}else{
					
					$button .= '<h5><span class="label label-success ">Not Aplicable</span></h5>';
					
				}			
				
				
				$data['data'][] = array(
					singleDbTableRow($r->rolename,'role')->rolename,			
					$r->referral_code,			
					$r->first_name.' '.$r->last_name,			
					$r->company_name,
					$button
				);
					
			}
		}
		else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','',''
				);
			}
			echo json_encode($data);
	}

	
	

//Searching For referral transfer

	public function search_role_transfer(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$role = singleDbTableRow($user_id)->rolename;
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$role_name = $_POST['role_name'];
		$user_name = $_POST['user_name'];
		

		$queryCount = $this->Ref_info_model->search_new_ref_transfer($role_name,$user_name);

		
		$query = $this->Ref_info_model->ref_transfer_List($limit, $start, $role_name,$user_name);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query->num_rows() > 0) 
		  {
			foreach($query->result() as $r){
					
				//Action Button
				$button = '';
				
				//$get_rol = $this->db->get_where('role_refrral_declaration',['from_role'=>$role,'to_role'=>$r->rolename]);
				
				$get_rol = $this->db->get_where('role_refrral_declaration',['to_role'=>$r->rolename]);
				if($get_rol->num_rows() > 0){
				
					$button .= '<a class="btn btn-success" href="'.base_url('Ref_info/transfer_role/'. $r->id).'" data-toggle="modal" data-target="#transfer" title="transfer_role" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Transfer Role</a>';				
				}else{
					
					$button .= '<h5><span class="label label-success ">Not Aplicable</span></h5>';
					
				}			
				
				
				$data['data'][] = array(
					singleDbTableRow($r->rolename,'role')->rolename,			
					$r->referral_code,			
					$r->first_name.' '.$r->last_name,			
					$r->company_name,
					$button
				);
					
			}
		}
		else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','',''
				);
			}
			echo json_encode($data);
	}
	

//Transfer Role 
public function transfer_role($id)
	{
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'role_transfer') die('Error! sorry');

			$this->form_validation->set_rules('referredByCode', 'Referral Code', 'trim');
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->Ref_info_model->role_trans();	
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Role Transfer Successfully');
					redirect(base_url('Ref_info/assign_role'));
				}
			}
		}
		
		$data['transfer'] = $this->db->get_where('users', ['id' => $id]);		
		theme('transfer_role_ref',$data);	
	}	
	

//get unique refferal code

public function uniqueReferralCodeApi(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code = singleDbTableRow($user_user_id)->referral_code;	
		
		$referredByCode = $this->input->post('referredByCode');
		
	if ($referredByCode != $user_referral_code )	
	{
		$query = $this->db->get_where('users', ['referral_code' => $referredByCode,'rolename'=>'12','active' => '1']);
		if($query->num_rows() > 0 )
		{
			$return = 'true';
			
		}else{
			$return = 'false';
		}
	}
		echo $return;
	}

	
//Assigned Role 
public function assign_role()
	{
		
		theme('assign_role');	
	}	
	


	
//listing
	public function assign_role_listjson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$role = singleDbTableRow($user_id)->rolename;
		$referral_code = singleDbTableRow($user_id)->referral_code;
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Ref_info_model->assign_role_listcount();

		
		$query = $this->Ref_info_model->assign_role_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
		  {
			foreach($query->result() as $r){
					
					//Action Button
					$button = '';
					
				
				if($r->status == 0){
					
					if($role == 12){
						
					$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Ref_info/accept_role_otp/?ref='. $r->referral_code.'&id='.$r->id).'" data-toggle="modal" data-target="#accept_role"  title="Accept"> Accept </a>&nbsp;&nbsp;&nbsp';
						
												
						$button .= '<a class="btn btn-info editBtn" href="'.base_url('Ref_info/cancel_role/'. $r->id).'"data-toggle="tooltip" title="Cancel"> Cancel </a>';
						
					}elseif($role == 11){
						
						$button .= '<h4><span class="label label-primary"><i class="fa fa-spinner fa-spin" style="font-size:19px"></i> Processing</span></h4>';
						
					}
									
				}
				elseif($r->status == 3){
					
					if($role == 11){
						
						$button .= '<a class="btn btn-warning" href="'.base_url('Ref_info/conform_role/?id='.$r->id.'&sender='.$r->sender_id.'&p_mode='.$r->points_mode.'&ch_amt='.$r->chargeable_amt).'" title="conform" ><i class="fa fa-bell-o" aria-hidden="true"></i> Conform </a>&nbsp;&nbsp;&nbsp;';
											
					}elseif($role == 12){
						
						$button .= '<h4><span class="label label-primary"><i class="fa fa-spinner fa-spin" style="font-size:19px"></i> Processing</span></h4>';
						
					}
					
				}
				elseif($r->status == 1){
					
					$button .= '<span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Completed</span>';
					
				}
				elseif($r->status == 2){
					
					$button .= '<span class="label label-danger"><i class="fa fa-times" aria-hidden="true"></i> Canceled</span>';
					
				}
				
				
				$sender = singleDbTableRow($r->created_by,'users')->first_name.' '.singleDbTableRow($r->created_by,'users')->last_name.' ( '.singleDbTableRow($r->sender_id,'users')->first_name.' '.singleDbTableRow($r->sender_id,'users')->last_name.' ) ';
  				
				$get_reciver = $this->db->get_where('users',['referral_code'=>$r->referral_code]);
				foreach($get_reciver->result() as $u);
				
				
					$data['data'][] = array(		
						date('d-m-Y',$r->created_at).' ('.date('h : m A',$r->created_at).' )',			
						$sender,			
						singleDbTableRow($r->role,'role')->rolename,
						$u->first_name.' '.$u->last_name,
						$r->req_amount,
						$r->chargeable_amt,
						$button
					);						
			}
		}
		else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','','','',''
				);
			}
			echo json_encode($data);
	}

	
	
//Accept The Role Pop up--------------

public function accept_role_otp()
	{	
		$id  			  = $_GET['id'];
		$ref	  		  = $_GET['ref'];
	
		$data['accept_otp'] = $this->db->get_where('users', ['referral_code'=>$ref]);
		$data['transfer_id'] = $this->db->get_where('role_transfer', ['id'=>$id]);
		theme('confirm_role_otp',$data);	
	}		

	
//Accept the role
public function accept_role(){
		
		$id				  = $_POST['sen_id'];
		$grand_total      = $_POST['grand_total'];
		$referral_code    = $_POST['referral_code'];
		//$points_mode   	  = $_POST['points_mode'];
		
		$insert = $this->Ref_info_model->accept_role_m($id, $referral_code, $grand_total);
		if($insert)
		{
			$this->session->set_flashdata('successMsg', 'Accept The Role.....!!!');
			redirect(base_url('Ref_info/assign_role'));
		}
	}

	
//Cancel the role
public function cancel_role($id){
		
		$insert = $this->Ref_info_model->cancel_role_m($id);
		if($insert)
		{
			$this->session->set_flashdata('successMsg', 'Canceled');
			redirect(base_url('Ref_info/assign_role'));
		}
	}

	
//Conform Role Update
public function conform_role()
	{
				
		$id  			  = $_GET['id'];
		$sender	  		  = $_GET['sender'];
		$points_mode	  = $_GET['p_mode'];
		$ch_amt			  = $_GET['ch_amt'];
		
		$insert = $this->Ref_info_model->update_user_role($id, $sender, $points_mode, $ch_amt);
		if($insert)
		{
			$this->session->set_flashdata('successMsg', 'New Role Assigned Successfully...!!!');
			redirect(base_url('Ref_info/assign_role'));
		}
		
	}		

//get user details	
public function get_user(){
		$ref_id = $_POST['ref_id'];
		//echo $ref_id;
		$data = $this->db->get_where('users', ['referral_code'=>$ref_id]);
		
		foreach($data->result() as $row1)
		{
			$user = "<input type='hidden' id='user_id' value='".$row1->id."'>" ;
		}
		
		
		$user .= "<table class='table table-bordered'><thead><tr><th>Name</th><th>Email</th><th>Role Name</th></tr></thead>";
		$user .= "<tbody>";
		
		foreach($data->result() as $row)
		{
			$user .="<td>".$row->first_name." ".$row->last_name."</td>";
			$user .= "<td>".$row->email."</td>";
			$role = $row->rolename;
			$get_role = $this->db->get_where('role', ['roleid'=>$role]);
			foreach($get_role->result() as $rn)
			{
				$rolename =  $rn->rolename;
			}
			$user .="<td>".$rolename."</td>";
		}
		$user .="</tbody></table>";
		echo $user;
	}

	
//get otp 	
public function send_otp()
	{
		
		$this->load->helper('string');
		$otp = random_string('numeric', 5);
		
		include_once('sendsms.php');
		
		$name = $_POST['name'];
		$ph_no = $_POST['ph_no'];
		
		$message="Dear ".$name.", please share the OTP ".$otp." with us to complete your order -Team Cfirst";
		$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
		$sendsms->send_sms($ph_no, $message, 'http://www.consumer1st.in', 'xml');
		
		echo $otp;
		
	}

	
	
}	