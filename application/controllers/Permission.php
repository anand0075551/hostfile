<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('permission_model');

		check_auth(); //check is logged in.
	}

	public function index()
	{
		//restricted this area, only for admin
		permittedArea();

		theme('give_permission');
	}

	

	
	
			public function view_bg(){
		//restricted this area, only for admin
		permittedArea();

		$data['role'] = $this->db->get('role');
	//	if($this->input->post())
	//	{
	//		$this->form_validation->set_rules('userrole', 'Country', 'required');
	//	}

		theme('view_bg', $data);
	}
			
		public function edit_bg($id){
		//restricted this area, only for admin
		permittedArea();

		$data['business_groups'] = singleDbTableRow($id,'business_groups');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_bg') die('Error! sorry');

		$this->form_validation->set_rules('business_name', 'Group Name', 'required|trim');
		$this->form_validation->set_rules('sub_acct_id', 'Payment Account', 'required|trim');
		$this->form_validation->set_rules('recv_user', 'Payment Reciever', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->permission_model->edit_bg($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Business Group Name Updated Success');
					redirect(base_url('permission/view_edit_bg/'.$id));
				}
			}
		}

		theme('edit_bg', $data);
	}
	
	public function copy_bg($id){
		//restricted this area, only for admin
		permittedArea();

		$data['business_groups'] = singleDbTableRow($id,'business_groups');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_bg') die('Error! sorry');

		$this->form_validation->set_rules('business_name', 'Group Name', 'required|trim|is_unique[business_groups.business_name]');
		$this->form_validation->set_rules('sub_acct_id', 'Payment Account', 'required|trim');
		$this->form_validation->set_rules('recv_user', 'Payment Reciever', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->permission_model->copy_bg($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Business Group Coppied Successfully.');
					redirect(base_url('permission/view_bg'));
				}
			}
		}

		theme('copy_bg', $data);
	}
	
	
	
	
	public function add_menu_label(){
		//restricted this area, only for admin
		permittedArea();

		$data['role'] = $this->db->get('role');

		if($this->input->post())
		{
			$this->form_validation->set_rules('bussiness_name', 'Business Name', 'required|trim');

						if($this->form_validation->run() == true)
			{
				$insert = $this->permission_model->add_menu_label($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Label Created Success');
					redirect(base_url('permission/label_list'));
				}
			}
		}

		theme('add_menu_label', $data);
	}
	
				public function label_list(){
		//restricted this area, only for admin
		permittedArea();

	//	$data['role'] = $this->db->get('role');


		theme('label_list');
	}
	
	
					public function edit_menu_label($id){
		//restricted this area, only for admin
		permittedArea();

		$data['business_groups'] = singleDbTableRow($id,'business_groups');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_menu_label') die('Error! sorry');

		$this->form_validation->set_rules('business_name', 'Group Name', 'required|trim');
		//	$this->form_validation->set_rules('commission_percent', 'Commission', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->permission_model->edit_menu_label($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Business Group Name Updated Success');
					redirect(base_url('permission/view_bg'));
				}
			}
		}

		theme('edit_menu_label', $data);
	}		

	
	public function create_groups(){
		//restricted this area, only for admin
		permittedArea();

		if($this->input->post())
		{
			if($this->input->post('submit') != 'create_groups') die('Error! sorry');

			$this->form_validation->set_rules('business_name', 'Group Name', 'required|trim');
			$this->form_validation->set_rules('sub_acct_id', 'Payment Account', 'required|trim');
			$this->form_validation->set_rules('recv_user', 'Payment Reciever', 'required|trim');
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->permission_model->create_groups();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Group Created Success');
					redirect(base_url('permission/view_bg'));
				}
			}
		}


		theme('create_groups');
	}
	

	public function add_menu_permission(){
		//restricted this area, only for admin
		permittedArea();

		
		$data['role'] = $this->db->get('role');
		$data['bussiness_name'] = $this->db->get('business_label');
	//	$data['business_name'] = $this->db->get('bg_forms');
	//	$data['role_groups'] = $this->db->get('role_groups');
		if($this->input->post())
		{
			$this->form_validation->set_rules('userrole', 'Group Name', 'required');
			$this->form_validation->set_rules('business_name', 'Group Name', 'required');
		//	$this->form_validation->set_rules('status', 'Group Name', 'required');
						if($this->form_validation->run() == true)
			{
				$insert = $this->permission_model->add_menu_permission($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Group Status Updated Success');
					redirect(base_url('permission/view_permission'));
				}
			}
		}

		theme('add_menu_permission', $data);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	


	
	
	

	

	
	

	
	public function view_edit_bg($id){
		//restricted this area, only for admin
		permittedArea();

		$data['profile_Details'] = $this->db->get_where('business_groups', ['id' => $id]);

		/*$data['profile_Details'] = $this->db->query("select users.*, count(rerreral.id) as referralCount
								from users LEFT JOIN
								users as rerreral on users.referral_code = rerreral.referredByCode
								where users.id = {$id}");*/

		theme('view_edit_bg', $data);
	}

	

	

	
	
	
	
	
	
		


	




	public function delete2Ajax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'business_groups');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$categoryName} Role");
		//Now delete permanently
		$this->db->where('id', $id)->delete('business_groups');
		return true;
	}

	public function delete3Ajax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'business_label');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$categoryName} Role");
		//Now delete permanently
		$this->db->where('id', $id)->delete('business_label');
		return true;
	}

	
	
	


		public function bgListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->permission_model->bgListCount();		
		$query = $this->permission_model->bgList();

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
//if($query->num_row() > 0)
//{	
			foreach($query->result() as $r){
			if( $r->business_type == '0')
			{
				$type = 'Internal';
			}else{
				$type = 'External';
			}


			//Action Button
			$button = '';
		    $button .= '<a class="btn btn-primary editBtn" href="'.base_url('permission/view_edit_bg/'. $r->id).'"   data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a>';

			$button .= '<a class="btn btn-info editBtn" href="'.base_url('permission/copy_bg/'. $r->id).'"   data-toggle="tooltip" title="View"><i class="fa fa-copy"></i> </a>';
			
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i> </a>';
			
			
			if($r->sale_status == 1){
				$sts = '<small class="label label-success"> Active </small>';
				$button .= '<a class="btn btn-warning" href="'.base_url('permission/block_sale/'. $r->id).'"  data-toggle="tooltip" title="Block"><i class="fa fa-lock"></i> </a>';
			}
			else{
				$sts = '<small class="label label-danger"> Blocked </small>';
				$button .= '<a class="btn btn-success" href="'.base_url('permission/active_sale/'. $r->id).'"  data-toggle="tooltip" title="Block"><i class="fa fa-unlock-alt"></i> </a>';
			}
			
			$get_reciever = $this->db->get_where('users', ['referral_code'=>$r->payment_reciever]);
			if($get_reciever->num_rows()>0){
				foreach($get_reciever->result() as $rr);
				$payment_reciever = $rr->first_name.' '.$rr->last_name.' ('.$rr->referral_code.')';
			}
			else{
				$payment_reciever = "";
			}
			
			$get = $this->db->get_where('acct_categories', ['id'=>$r->pay_type]);
			if($get->num_rows()>0){
				foreach($get->result() as $g);
				$payment_acc = $g->name;
			}
			else{
				$payment_acc = "";
			}
			
			$data['data'][] = array(
				$button,
				$r->business_name,
				$payment_acc,
				$payment_reciever,
				$sts
			);
		}
//}else{

//}
		echo json_encode($data);


}	
	
			public function view_permission(){
		//restricted this area, only for admin
		permittedArea();

		$data['role'] = $this->db->get('role');
	//	if($this->input->post())
	//	{
	//		$this->form_validation->set_rules('userrole', 'Country', 'required');
	//	}

		theme('view_permission', $data);
	}
public function menuListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->permission_model->menuListCount();		
		$query = $this->permission_model->menuList();

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
//if($query->num_row() > 0)
//{	
		
		if($query -> num_rows() > 0) {	
foreach($query->result() as $r){
				$activeStatus = $r->status;
			//Status Button
		switch($activeStatus){
				case 0:
					$statusBtn = '<small class="label label-default"> Pending </small>';
					$blockUnblockBtn = '<button onClick="refreshPage()" class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Approve" value="1">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
				case 1 :
					$statusBtn = '<small class="label label-success"> Active </small>';
					$blockUnblockBtn = '<button onClick="refreshPage()" class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="2">
						<i class="fa fa-lock"></i> </button>';
					break;
				case 2 :
					$statusBtn = '<small class="label label-danger"> Inactive </small>';
					$blockUnblockBtn = '<button onClick="refreshPage()" class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Inactive" value="1">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
			}


			//Action Button
			$button = '';
		    $button .= '<a class="btn btn-primary editBtn" href="'.base_url('permission/view_permission_menu/'. $r->id).'"   data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			$button .= $blockUnblockBtn;
			

					
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
        					if($r->roleid !="11")
					{
		$query = $this->db->get_where('role', ['id' => $r->roleid,]);

                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        $biz_name = $row->rolename;
                                    }
                                } else {
                                     $biz_name =  " ";
                                } 
								
										$query2 = $this->db->get_where('business_label', ['id' => $r->business_name,]);

                                if ($query2->num_rows() > 0) {
                                    foreach ($query2->result() as $row2) {
                                        $b_name = $row2->bussiness_name;
                                    }
                                } else {
                                     $b_name =  " ";
                                }
								
			$data['data'][] = array(
			$button,
				$r->roleid."-".$biz_name,
				$b_name,
				$statusBtn,
			
			);
			}
		} }
		else{
			$data['data'][] = array(
				'You have Permission Created' , '', '', '', '', '', ''
			);
		}
		echo json_encode($data);
		
		
}	
	

		
	
/**
	 * Set block or unblock through this api
	 */

	public function setBlockUnblock(){
		$id = $this->input->post('id');
		$buttonValue = $this->input->post('buttonValue');
	//	$button_role_id = $this->input->post('button_role_id');
		$status = $this->input->post('status');

		//get deleted user info
	//	$userInfo = singleDbTableRow($id);
	//	$fullName = user_full_name($userInfo);
		// add a activity
	//	create_activity($status." {$fullName} from Agent");
		//Now delete permanently

		$this->db->where('id', $id)->update('menu_permission', ['status' => $buttonValue]);

		
		return true;
		
		/* Anand */
		//$this->db->where('id', $id)->update('role_groups', ['roleid' => $r->id]);
		//return true;
		
		
	}
	
	

 public function edit_permission($id) {
      
      // permittedArea();
		//$data['status'] = $this->db->get('status');
$data['role'] = $this->db->get('role');
        $data['permission'] = singleDbTableRow($id,'menu_permission');
$data['bussiness_name'] = $this->db->get('business_label');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_permission')
                die('Error! sorry');
			
			
						$this->form_validation->set_rules('userrole', 'Group Name', 'required');
						$this->form_validation->set_rules('business_name', 'Group Name', 'required'); 

            if ($this->form_validation->run() == true) {
                $insert = $this->permission_model->edit_permission($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Permission Updated Successfully...!!!');
                    redirect(base_url('permission/view_permission'));
                }
            }
        }

        theme('edit_permission', $data);
    }


			public function view_permission_menu($id){
		//restricted this area, only for admin
		permittedArea();
		$data['menu_Details'] = $this->db->get_where('menu_permission', ['id' => $id]);
		$data['role'] = $this->db->get('role');
	//	if($this->input->post())
	//	{
	//		$this->form_validation->set_rules('userrole', 'Country', 'required');
	//	}

		theme('view_permission_menu', $data);
	}

public function labelListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->permission_model->labelListCount();		
		$query = $this->permission_model->labelList();

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
//if($query->num_row() > 0)
//{	
		
			
foreach($query->result() as $r){

			//Action Button
			$button = '';
		    $button .= '<a class="btn btn-primary editBtn" href="'.base_url('permission/view_label/'. $r->id).'"   data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
		//	$button .= $blockUnblockBtn;
			

			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
 
		   
			$data['data'][] = array(
			$button,
			//	$r->roleid."-".$biz_name,
				
				$r->bussiness_name,
				$r->comments,
			
			
			);
		}

		echo json_encode($data);
		
		
}	


	public function view_label($id){
		//restricted this area, only for admin
		permittedArea();

		$data['business_label'] = $this->db->get_where('business_label', ['id' => $id]);

		/*$data['profile_Details'] = $this->db->query("select users.*, count(rerreral.id) as referralCount
								from users LEFT JOIN
								users as rerreral on users.referral_code = rerreral.referredByCode
								where users.id = {$id}");*/

		theme('view_label', $data);
	}
 public function edit_label($id) {
      
      // permittedArea();
		//$data['status'] = $this->db->get('status');
$data['role'] = $this->db->get('role');
        $data['business_label'] = singleDbTableRow($id,'business_label');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_label')
                die('Error! sorry');
			
			
						$this->form_validation->set_rules('bussiness_name', 'Group Name', 'required');
						

            if ($this->form_validation->run() == true) {
                $insert = $this->permission_model->edit_label($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Label Updated Successfully...!!!');
                    redirect(base_url('permission/label_list'));
                }
            }
        }

        theme('edit_label', $data);
    }

	public function get_sub_account()
	{
		$id = $_POST['parent_id'];
		$query = $this->db->get_where('acct_categories', ['parentid' => $id]);
		$data = '<option value="">Withdraw Sub-Accounts Type </option>';
		foreach($query->result() as $sub_account){
			$data.= '<option value="'.$sub_account->id.'">'.$sub_account->id.'-'.$sub_account->name.'</option>';
		}
		echo $data;
	}
	
	public function get_user()
	{
		$id = $_POST['role'];
		$query = $this->db->get_where('users', ['rolename' => $id]);
		$data = '<option value=""> Payment Reciever </option>';
		foreach($query->result() as $r){
			$data.= '<option value="'.$r->referral_code.'">'.$r->referral_code.'-'.$r->first_name.' '.$r->last_name.'</option>';
		}
		echo $data;
	}
	
	public function block_sale($id){
		 $update = $this->permission_model->block_sale($id);
		 if($update) {
			$this->session->set_flashdata('successMsg', 'Sales Blocked Successfully...!!!');
			redirect(base_url('permission/view_bg'));
		}
	}
	
	public function active_sale($id){
		 $update = $this->permission_model->active_sale($id);
		 if($update) {
			$this->session->set_flashdata('successMsg', 'Sales Activated Successfully...!!!');
			redirect(base_url('permission/view_bg'));
		}
	}

}