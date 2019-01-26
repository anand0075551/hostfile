<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business_module extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('user_model');

		check_auth(); //check is logged in.
	}

	public function index()
	{
		//Visible only for Admin
		permittedArea();

		theme('Business_userIndex');
	}
/**
	 * Agent/Customer List from db
	 * @return Json format
	 * usable only via API
	 */

	public function alluserListJson(){
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
			$button .= '<a class="btn btn-info editBtn"  href="'.base_url('Business_module/processAjax/'. $r->id).'" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';
		//	$button .= $blockUnblockBtn;
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Process Data with Other Business">
						<i class="fa fa-plane"></i> </a>';

			$data['data'][] = array(
			    $button,
				$r->first_name.' '. $r->last_name,
				$r->email,
				$r->contactno,	
				$statusBtn,
				$r->referral_code,
				$r->referredByCode				
			);
		}

		echo json_encode($data);

	}
	
/**
	 * This is Api for Sending User data with Other Business
	 */

	//public function deleteAjax(){
	public function processAjax($id){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity("Processed {$fullName} For SMB Business");
		//Now Process permanently
		//$this->db->where('id', $id)->delete('users');
		//$insert = $this->Api_Business_model->apiuser_create();
		
		$id = $this->input->post('id');
		$name = 'Anand'	;	
		$email ='email@gmail.com';
		$mobile = '9980569960';
		$enqcourse = '12';
		$enqcourse = '12';
		$course = '22';
		$message = 'City_message';
		$username =  "test";
		$password = "password";
		$ch = curl_init();
	//	curl_setopt($ch, CURLOPT_URL, "http://www.chaitanyatrust.com/currency/index.php/user/test?name=$name&email=$email&mobile=$mobile&enqcourse=$enqcourse&course=$course&message=$message");
		
		curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/A/active_shop/index.php/user/test?name=$name&email=$email&mobile=$mobile&enqcourse=$enqcourse&course=$course&message=$message");
		
		
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'X-JHWGDSHAGDAS: '.$username.':'.$password));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($ch);
		curl_close($ch);
		echo $data;
		
		
				if($data)
				{
					echo "User Record has been updated Successfully...!!!";
				}
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

	
	//Api for User Creation
public function apiuser_create()
{
		$insert = $this->Api_Business_model->apiuser_create();
				if($insert)
				{
					
					echo "Your Payment Transfer has been Completed Successfully...!!!";
				}


}
	
	/**
	 * Get Current profile
	 */

	public function profile(){
		theme('profile');
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

public function get_payspec()
    {
 /*	   
    $data = $this->db->where('parentid', '0')->order_by('id', 'asc')->get_where('acct_categories', ['visible' => '0']);

   echo " Hello <pre>"; 
    print_r ($data);
    echo "</pre>";x`
   
   $query = "select * from acct_categories order by id";

  $categories = $db->query($query);

  print_r($categories); */
   
    }

	//Api for payment transaction
public function payment()
{


$insert = $this->user_model->paymentAPI();
				if($insert)
				{
					
					echo "Your Payment Transfer has been Completed Successfully...!!!";
				}


}

}
