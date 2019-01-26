<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('login');
		$this->load->model('notification_model');
        $this->load->model('product_model');
        $this->load->model('Clocking_model');
	}

	public function index()
	{
		//Redirect dashboard if logged-in
		if(is_logged_in()) redirect(base_url('dashboard'));

		$data = [
			'title'	=> 'Log In'
		];

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == true) {

			if ($this->input->post()) {
				//prevent CSRF
				if ($this->input->post('submitBtn') != 'submitBtn') die('You are not authorized to do this action');

				$check_auth = $this->login->authonication();

				if ($check_auth) {
					//redirect previously fail admin url
					if(redirect_auth_uri()) redirect(redirect_auth_uri());
					//redirect Dashboard
					redirect(base_url('dashboard'));
				} else {
					redirect(base_url());
				}
			}
		}


		$this->load->view('login', $data);
	}



	public function registerUser(){
		$data['title'] = 'Register';
		$data['countries'] = $this->db->get('countries');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];		
		

		//User Registration Form Processing...

		if($this->input->post())
		{
			if($this->input->post('submit') != 'userRegistration') die('Error! sorry');

			$this->form_validation->set_rules('referredByCode', 'Referral Code', 'required|trim|callback_referralCodeCheck');
			$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
			$this->form_validation->set_rules('contactno', 'Contact No.', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');			
			//$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'trim');
			//$this->form_validation->set_rules('rolename', 'Membership Type', 'required|trim');
			$this->form_validation->set_rules('postal_code', 'Postal Code', 'required|trim');
			$this->form_validation->set_rules('id_type', 'Govt ID', 'required|trim');
			$this->form_validation->set_rules('adhaar_no', 'Govt ID No', 'required|trim|is_unique[users.adhaar_no]');
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->login->registerUser();
				if($insert)
				{

					$email = $this->input->post('email');
					$newUserInfo = singleDbTableRow($email, 'users', 'email');
					$html = '<br />';
					$html .= 'Email : '.$email.'<br />';
					$html .= 'Password : '.$newUserInfo->row_pass.'<br />';
					$html .= 'Your Unique Referral ID : VOL'.$newUserInfo->referral_code.'<br /> <hr />';
					$html .= 'Please find email on your <strong>Inbox</strong> or  <strong>Spam</strong> folder';
	
					$this->session->set_flashdata('successMsg', 'Registration Successfully Completed...!!!, below are the credentials'. $html);
					redirect(base_url());
				}

			}
		}


		$this->load->view('registerUser', $data);
	}

	
	

	public function referralCodeCheck($referredByCode){
		$query = $this->db->get_where('users', ['referral_code' => $referredByCode]);
		if ($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('referralCodeCheck', 'The {field} field is not valid');
			return FALSE;
		}
	}

	/**
	 * Forgot password
	 */

	public function forgotPassword()
	{
		//Redirect dashboard if logged-in
		if(is_logged_in()) redirect(base_url('dashboard'));

		$data = [
			'title'	=> 'Password Retrieval'
		];

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

		if($this->form_validation->run() == true) {

			if ($this->input->post()) {
				//prevent CSRF
				if ($this->input->post('submitBtn') != 'submitBtn') die('You are not authorized to do this action');

				$get_password = $this->login->forgotPassword();

				if ($get_password) {
					redirect(base_url());
				} else {
					redirect(base_url());
				}
			}
		}

		$this->load->view('forgot_password', $data);
    }


	public function validateReferralCodeApi(){
		
		$referredByCode = $this->input->post('referredByCode');
		$query = $this->db->get_where('users', ['referral_code' => $referredByCode, 'role' => 'user', 'active' => '1']);
		if($query->num_rows() > 0){
			$return = 'true';
		}else{
			$return = 'false';
		}
		echo $return;
	}


public function uniqueReferralCodeApi(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code = singleDbTableRow($user_user_id)->referral_code;	
		
		$referredByCode = $this->input->post('referredByCode');
		
	if ($referredByCode != $user_referral_code )	
	{
		
                $query = $this->db->get_where('users', ['referral_code' => $referredByCode, 'rolename' => '12', 'active' => '1']);
		if($query->num_rows() > 0 )
		{
			
			$return = 'true';
			
		}else{
			$return = 'false';
		}
	}
		echo $return;
	}
	

	public function email_template(){
		$data['firstname'] = 'Buppy';
		$data['lastname'] = 'Hossain';
		$data['email'] = 'anand007555gmail.com.com';
		$data['userid'] = 8;

		$this->load->view('product_sell_email_tpl', $data);
	}


	
	public function htaccess(){
		unlink('.htaccess');
	
		$htaccess_code = 'RewriteEngine On
			RewriteCond %{REQUEST_URI} ^/system.*
			RewriteRule ^(.*)$ index.php?/$1 [L]
			RewriteCond %{REQUEST_FILENAME} !-f
			RewriteCond %{REQUEST_FILENAME} !-d
			RewriteRule ^(.+)$ index.php?/$1 [L]';
	
		$f = fopen(".htaccess", "a+");
		fwrite($f, $htaccess_code);
		fclose($f);
		
		redirect(base_url('dashboard'));
	
	}

public function switch_user($user_id){
	
		$status = $this->login->switch_user($user_id);
		if($status)
		{
			redirect(base_url('dashboard'));
		}
		
	}
	
//update root_id and remove...
	public function update_root(){
	
		//$status = $this->db->get_where('users',['rolename'=>12,'root_id'=>'']);
		$status = $this->db->get_where('users',['rolename'=>12,'root_id'=>'']);
		foreach($status->result() as $s){
			$this->db->where('referral_code', $s->referral_code)->update('users', ['root_id'=>$s->referral_code]);
		}
		redirect(base_url('dashboard'));
		
	}
//update root_id and remove...

//this is to switch to default menu
	public function default_menu() {
       $query = $this->db->where('id', 1)->update('menu_type', ['menu_type'=>'default_menu','admin_switch'=> '0' ]);
	   if($query){
		   redirect(base_url('dashboard'));
	   }
    }
	
	
	
	
	//this is to switch dynamic menu
	public function dynamic_menu() {
        $query = $this->db->where('id', 1)->update('menu_type', ['menu_type'=>'dynamic_menu' ,'admin_switch'=> '0']);
		if($query){
		   redirect(base_url('dashboard'));
	   }
    }
	
	
		//this is to switch dynamic menu
	public function default_admin_menu() {
        $query = $this->db->where('id', 1)->update('menu_type', ['admin_switch'=>'3']);
		if($query){
		   redirect(base_url('dashboard'));
	   }
    }
	
	
		//this is to switch dynamic menu
	public function dynamic_admin_menu() {
        $query = $this->db->where('id', 1)->update('menu_type', ['admin_switch'=>'4']);
		if($query){
		   redirect(base_url('dashboard'));
	   }
    }
	
//-------------------------- registerUser and login _chaitanya_ amit----------------------------------------------------------------//

	public function login_chaitanya()
	{
		//Redirect dashboard if logged-in
		if(is_logged_in()) redirect(base_url('dashboard'));

		$data = [
			'title'	=> 'Log In'
		];

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == true) {

			if ($this->input->post()) {
				//prevent CSRF
				if ($this->input->post('submitBtn') != 'submitBtn') die('You are not authorized to do this action');

				$check_auth = $this->login->authonication();

				if ($check_auth) {
					//redirect previously fail admin url
					if(redirect_auth_uri()) redirect(redirect_auth_uri());
					//redirect Dashboard
					redirect(base_url('dashboard'));
				} else {
					redirect(base_url());
				}
			}
		}


		$this->load->view('login_chaitanya', $data);
	}
	
	

public function registerUser_chaitanya(){
		$data['title'] = 'Register';
		$data['countries'] = $this->db->get('countries');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];		
		

		//User Registration Form Processing...

		if($this->input->post())
		{
			if($this->input->post('submit') != 'userRegistration') die('Error! sorry');

			//$this->form_validation->set_rules('referredByCode', 'Referral Code', 'required|trim|callback_referralCodeCheck');
			$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
			$this->form_validation->set_rules('contactno', 'Contact No.', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[users.email]');
			//$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			//$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');			
			//$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'trim');
			//$this->form_validation->set_rules('rolename', 'Membership Type', 'required|trim');
			$this->form_validation->set_rules('postal_code', 'Postal Code', 'required|trim');
			//$this->form_validation->set_rules('id_type', 'Govt ID', 'required|trim');
			//$this->form_validation->set_rules('adhaar_no', 'Govt ID No', 'required|trim|is_unique[users.adhaar_no]');
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->login->registerUser_chaitanya();
				if($insert)
				{

					$email = $this->input->post('email');
					$newUserInfo = singleDbTableRow($email, 'users', 'email');
					$html = '<br />';
					$html .= 'Email : '.$email.'<br />';
					$html .= 'Password : '.$newUserInfo->row_pass.'<br />';
					$html .= 'Your Unique Referral ID : VOL'.$newUserInfo->referral_code.'<br /> <hr />';
					$html .= 'Please find email on your <strong>Inbox</strong> or  <strong>Spam</strong> folder';
	
					$this->session->set_flashdata('successMsg', 'Registration Successfully Completed...!!!, below are the credentials'. $html);
					redirect(base_url());
				}

			}
		}


		$this->load->view('registerUser_chaitanya', $data);
	}
//------------------------------------------------------------end of Chaitanya------------------------------------------------------//	


	
	// Clocking begins--------------------------------------------------------------------------------------------
		public function accept_clocking()
		{
			$currentRolename = $_POST['currentRolename'];
			$user_id = $_POST['user_id'];

			//echo $cons_no;
			$sts = $this->Clocking_model->accept_clocking($currentRolename, $user_id);
				if($sts == true){
					$this->session->set_flashdata('successMsg', 'Now You Can Start Clock-in.');
					 redirect(base_url('dashboard'));
				}
		}	
			public function clock_in()
		{
			$currentRolename = $_POST['currentRolename'];
			$user_id = $_POST['user_id'];

			//echo $cons_no;
			$sts = $this->Clocking_model->clock_in($currentRolename, $user_id);
				if($sts == true){
					$this->session->set_flashdata('successMsg', 'Clock-in Successful!');
					 redirect(base_url('dashboard'));
				}
		}	
		
				public function clock_out()
		{
			$currentRolename = $_POST['currentRolename'];
			$user_id = $_POST['user_id'];

			//echo $cons_no;
			$sts = $this->Clocking_model->clock_out($currentRolename, $user_id);
				if($sts == true){
					$this->session->set_flashdata('successMsg', 'Clock-Out Successful!');
					 redirect(base_url('dashboard'));
				}
		}
	
	
	public function clocking_list()
{
//Visible only for Admin
//  permittedArea();
theme('clocking_list');
}
		public function clockingListJson(){

			$limit = $this->input->get('length');
			$start = $this->input->get('start');
			$queryCount = $this->Clocking_model->clocking_ListCount();
			$query = $this->Clocking_model->clocking_List($limit, $start);
			$draw = $this->input->get('draw');
			$data = [];
			$data['draw'] = $draw;
			$data['recordsTotal'] = $queryCount;
			$data['recordsFiltered'] = $queryCount;
			if($query -> num_rows() > 0)
			{   foreach($query->result() as $r){


					//Action Button
					$button = '';
					$user_info = $this->session->userdata('logged_user');
					$user_id = $user_info['user_id'];
					$currentRolename   = singleDbTableRow($user_id)->rolename;

					$query2 = $this->db->get_where('users', ['id' => $r->role_id,]);
					if ($query2->num_rows() > 0) {
							foreach ($query2->result() as $row2) {
							$un = $row2->first_name." ".$row2->last_name;
							}
						} else {
							$un =  " ";
					}
					$query3 = $this->db->get_where('role', ['id' => $r->role_name,]);
					if ($query3->num_rows() > 0) {
							foreach ($query3->result() as $row3) {
							$rn = $row3->rolename;
							}
						} else {
							$rn =  " ";
					}
					
					$cin = date("Y/m/d  H:i:s ", $r->clock_in);
					$cout = date("Y/m/d  H:i:s ", $r->clock_out);
					$date1 = new DateTime($cin);
					$date2 = new DateTime($cout);
					$interval = $date1->diff($date2);
					$day = $interval->d;
					$hr  = $interval->h;
					$min = $interval->i;
					$sec = $interval->s;
				if($currentRolename != 11)
				{
					$data['data'][] = array(

					$un,
					$rn,
					date("Y/m/d  H:i:s ", $r->clock_in),
					date("Y/m/d  H:i:s ", $r->clock_out),
					$hr.':'.$min.':'.$sec.'   <b>Hr</b>'
					
					);
				}
				if($currentRolename == 11){
				if(	$r->status == '0'){$s = 'In-Active';}else{$s = 'Active';}
				{	
					$data['data'][] = array(

					$un,
					$rn,
					date("Y/m/d  H:i:s ", $r->clock_in),
					date("Y/m/d  H:i:s ", $r->clock_out),
					$hr.':'.$min.':'.$sec.'   <b>Hr</b>',
					$s,
					$r->ip
					);
				}
			}}
			}
			else{
				
				$data['data'][] = array('No Data Available' , '', '', '', '', '', '' );
			
			}
			echo json_encode($data);
			}
	
	
	
	    public function role_clocking() {
        //restricted this area, only for admin
        permittedArea();

        theme('role_clocking');
    }
	
	
	 public function roleListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');


        $queryCount = $this->Clocking_model->roleListCount();


        $query = $this->Clocking_model->roleList($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {
$activeStatus = $r->status;
			//Status Button
			switch($activeStatus){
				case 0:
					$statusBtn = '<small class="label label-default"> Pending </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
				case 1 :
					$statusBtn = '<small class="label label-success"> Active </small>';
					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="2" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-lock" ></i> </button>';
					break;
				case 2 :
					$statusBtn = '<small class="label label-danger"> Blocked </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
					
				case 3 :
					
					$statusBtn = '<small class="label label-danger"> Deactivated By Admin </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Deactivate" value="0" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
			}

                //Action Button
                $button = '';
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
						$button .= $blockUnblockBtn;

						
				$query2 = $this->db->get_where('role', ['id' => $r->rolename,]);
				if ($query2->num_rows() > 0) {
				foreach ($query2->result() as $row2) {
				$un = $row2->rolename;
				}
				} else {
				$un =  " ";
				}

                $data['data'][] = array(
                    $button,
					$statusBtn,
                    $un
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Data', '', ''
            );
        }
        echo json_encode($data);
    }

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

		$this->db->where('id', $id)->update('clocking_role', ['status' => $buttonValue]);
		return true;
	}
	
	
	
		public function assign_clocking_to_role(){
		//restricted this area, only for admin
		permittedArea();
		
		$data['rolename'] = $this->db->get('role');
		if($this->input->post())
		{
			if($this->input->post('submit') != 'assign_clocking_to_role') die('Error! sorry');

			$this->form_validation->set_rules('role_id', 'Role Name', 'required|trim');
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->Clocking_model->assign_clocking_to_role();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Assigned Clocking Service Successfully');
					redirect(base_url('welcome/role_clocking'));
				}
			}
		}
      
		theme('assign_clocking_to_role',$data);
	}
	
	
			public function deleteAjax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity("Deleted Assignment");
		//Now delete permanently
		$this->db->where('id', $id)->delete('clocking_role');
		return true;
	}
	// Clocking ends--------------------------------------------------------------------------------------------
	
		
}//Last Brace Required