<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {



	function __construct(){
		parent:: __construct();
		$this->load->model('user_model');

		//check_auth(); //check is logged in.
	}

	public function index()
	{
		//Visible only for Admin
		permittedArea();

		theme('userIndex');
	}

	
	/**
	 * Get Current profile
	 */

	public function profile(){
		theme('profile');
	}
	/**
	 * Get Current Bank(Self)
	 */

	public function self_bank(){
		theme('self_bank');
	}
		/**
	 * Get Current profile
	 */

	public function bank_acct(){
		$data['users']=$this->user_model->bank_update();			
			theme('bank_index', $data);	
	}
	/**
	 * Bank Edit
	 * Action handle here...
	 */

	public function bank_acct_edit($id = 0){

		//get sure is admin if pass a profile ID
		if($id != 0) permittedArea();

		$data['profile_id'] = $id;

		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
		$this->form_validation->set_rules('contactno', 'Contact No.', 'required|trim');
		$this->form_validation->set_rules('gender', 'Gender', 'required|trim');
		$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'required|trim');
		$this->form_validation->set_rules('profession', 'Profession', 'required|trim');
		$this->form_validation->set_rules('street_address', 'Street Address', 'required|trim');

		if($this->form_validation->run() == true)
		{
			$update = $this->user_model->bank_update($id);
			if($update)
			{
				$this->session->set_flashdata('successMsg', 'Profile Updated Successfully');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}


		if($id != 0){
			theme('bank_acct_edit_common', $data);
		}else{
			theme('bank_acct_edit');
		}


	}
	/**
	 * Profile Edit
	 * Action handle here...
	 */

	public function profile_edit($id = 0){

		//get sure is admin if pass a profile ID
		
		$where_array = array ('type'=>'role_name', 'active'=>'1');
		$data['roles']		  = $this->db->get_where('role', $where_array);
			
			
		if($id != 0) permittedArea();

		$data['profile_id'] = $id;

		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
		$this->form_validation->set_rules('contactno', 'Contact No.', 'required|trim');
		$this->form_validation->set_rules('gender', 'Gender', 'required|trim');
		$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'trim');
		$this->form_validation->set_rules('profession', 'Profession', 'trim');
		$this->form_validation->set_rules('rolename', 'Authorization Type', 'required|trim');		
		$this->form_validation->set_rules('street_address', 'Street Address', 'trim');

		if($this->form_validation->run() == true)
		{
			$update = $this->user_model->profile_update($id);
			if($update)
			{
				$this->session->set_flashdata('successMsg', 'Profile Updated Successfully');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}


		if($id != 0){
			theme('profile_edit_common', $data);
		}else{
			theme('profile_edit');
		}


	}

	/**
	 * @param int $id
	 * get current users login log.
	 */

	public function log($id = 0){
		$data['logs'] = $this->user_model->get_log($id);
		if($id != 0) {
			//restricted this area, only for admin
			permittedArea();

			$data['logsOwner'] = get_profile_by_id($id);
		}else{
			$data['logsOwner'] = null;
		}
		theme('log', $data);
	}



	/**
	 * Agent list from db
	 * @return Json format
	 * usable only via API
	 */

	public function agentListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		//$queryCount = $this->user_model->agentListCount();
		//$query = $this->user_model->agentList($limit, $start);
		$queryCount = $this->user_model->userListCount();
		$query = $this->user_model->userList($limit, $start);
		
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		foreach($query->result() as $r){
			$activeStatus = $r->active;
			//Status Button
			switch($activeStatus){
				case 0:
					$statusBtn = '<small class="label label-default"> Pending </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Approve" value="1">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
				case 1 :
					$statusBtn = '<small class="label label-success"> Active </small>';
					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="2">
						<i class="fa fa-lock"></i> </button>';
					break;
				case 2 :
					$statusBtn = '<small class="label label-danger"> Blocked </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
			}

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('user/profile_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';
			$button .= $blockUnblockBtn;
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				$r->first_name.' '. $r->last_name,
				$r->email,
				$r->contactno,	
				$statusBtn,
				$r->referral_code,
				$r->referredByCode,

				$button
			);
		}

		echo json_encode($data);

	}

	/**
	 * This isApi for deleting an agent
	 */

	public function deleteAjax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity("Deleted {$fullName} from Agent");
		//Now delete permanently
		$this->db->where('id', $id)->delete('users');
		return true;
	}

	/**
	 * Set block or unblock through this api
	 */

	public function setBlockUnblock(){
		$id = $this->input->post('id');
		$buttonValue = $this->input->post('buttonValue');
		$status = $this->input->post('status');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity($status." {$fullName} from Agent");
		//Now delete permanently

		$this->db->where('id', $id)->update('users', ['active' => $buttonValue]);
		return true;
	}

	/**
	 * @param $id
	 * View User Profile
	 */

	public function profile_view($id){
		//restricted this area, only for admin
		permittedArea();

		//$data['profile_Details'] = $this->db->get_where('users', ['id' => $id]);
	//$data['vouchers'] = singleDbTableRow($id,'vouchers');
		$data['profile_Details'] = $this->db->query("select users.*, count(rerreral.id) as referralCount
								from users LEFT JOIN
								users as rerreral on users.referral_code = rerreral.referredByCode
								where users.id = {$id}"); 

		theme('profile_view', $data);
	}


	/**
	 * Change password method
	 *
	 * User able to change his password fom this section
	 */

	public function change_pass(){

		if($this->input->post())
		{
			if($this->input->post('submit') != 'changePassword') die('Error! sorry');

			$this->form_validation->set_rules('old_password', 'Old Password', 'required');
			$this->form_validation->set_rules('password', 'New Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'New Password Confirmation', 'required');

			if($this->form_validation->run() == true)
			{
				$insert = $this->user_model->changePassword();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Password Change Success');
					redirect(base_url('user/change_pass'));
				}

			}
		}


		theme('change_password');
	}

//Test code to check webservices

///Test Api call function sending to: user_model
public function test()
{
/*
echo $name = $_GET['name'];
echo  $email= $_GET['email'];
echo  $mobile= $_GET['mobile'];
echo  $enqcourse= $_GET['enqcourse'];
echo  $course= $_GET['course'];
 echo $message= $_GET['message'];

  $SQL="INSERT INTO test(name,email,mobile,mcourse,course,message)
                  values('$name','$email','$mobile','$enqcourse','$course','$message')";
mysql_query($SQL);*/

$insert = $this->user_model->testAPI();
				if($insert)
				{
					//$this->session->set_flashdata('successMsg', 'successssssssssss Anand Sagar');
					echo "successssssssssss Anand Sagar333";
				}


}

//Test Api call function from Mobile
public function test1()
{


$insert = $this->user_model->testAPI1();
				if($insert)
				{
					//$this->session->set_flashdata('successMsg', 'successssssssssss Anand Sagar');
					echo "Mobile successssssssssss Anand Sagar";
				}


}



//Api for payment
public function payment()
{


$insert = $this->user_model->paymentAPI();
				if($insert)
				{
					
					echo "'C1st'Your Payment Transfer has been Completed Successfully...!!!";
				}


}

//Api to Get Pay Specifications
 public function get_payspec()
    {
    $start = '0';
    $limit = '0';
    $query = $this->user_model->payspec_List($start, $limit);
    if($query -> num_rows() > 0) 
	{	
	foreach($query->result() as $r)
	  {
	    if ($r->category_type == 'sub')
	      {		
	        $data = 	$r->id.'-'.$r->name;						
		
		echo "<pre>";
		echo json_encode($data);
		echo "</pre>";
		} 
	  }

	}
     }


//Api to Check User Balance
 public function check_bal()
    {
    
    $query1  	= $this->user_model->total_wallet_debit();
    $query2  	= $this->user_model->total_wallet_credit();
		
    foreach( $query1->result() 		as $wal_debit); 
    $wal_debit		= $wal_debit->debit;
    
    foreach( $query2->result() 		as $wal_credit); 
    $wal_credit      	= $wal_credit->credit;
    
    
    $wallet_balance     = ( $wal_debit - $wal_credit ) ;
    
    $data = $wallet_balance;
   					
		
		echo "<pre>";
		echo json_encode($data);
		echo "</pre>";
	
     }

}