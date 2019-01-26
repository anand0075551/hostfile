<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('agent_model');
		$this->load->model('ledger_model');
		$this->load->model('bank_model');
		$this->load->model('product_model');
		$this->load->model('notification_model');
		check_auth(); //check is logged in.
	}

	public function index()
	{
		//restricted this area, only for admin
		//permittedArea(); check agentListJson

		theme('agent_index');
	}
	/**
	 * Verify Consumer to Refer in Agent Group
	 */

	public function verify_agent(){
		//Wallet*****Loyality*****Discount*****Points///		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();	
		
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$user_referral_code = singleDbTableRow($user_id)->referral_code;	
		$user_account_no    = singleDbTableRow($user_id)->account_no;
		$user_rolename	    = singleDbTableRow($user_id)->rolename;	
		$user_email		    = singleDbTableRow($user_id)->email;	
		$user_fname		    = singleDbTableRow($user_id)->first_name;	
		$user_mobile	    = singleDbTableRow($user_id)->contactno;
		
		
		$data['ledgerDebit']  	= $this->ledger_model->ledgerDebit();
		$data['ledgerCredit']   = $this->ledger_model->ledgerCredit();		
		$data['debits'] 		= $this->ledger_model->totalDebits();
		$data['credits']		= $this->ledger_model->totalCredits();
		$data['wallet'] 		= $this->ledger_model->totalWallet();
		$data['usedwallet'] 	= $this->ledger_model->usedWallet();
		
		$data['countries'] = $this->db->get('countries');
		
		if($user_rolename == 11 || $user_rolename == 14){
			$where_array = array ('type' => 'role_name', 'permission_id' => '1');
		}
		else{
			$where_array = array ('type' => 'role_name', 'permission_id' => '1',  'parent' => '0');
		}
		
		
		$data['rolename'] = $this->db->where($where_array)->get('role');
		
		
		
	//	$where_array = array ('type' => 'role_name', 'permission_id' => '0');
	//	$data['allrole'] = $this->db->where($where_array)->get('role');
		
		$input_referralid = $this->input->post('referredByCode');
		
	
		if($this->input->post())
		{
			if($this->input->post('submit') != 'verify_agent') die('Error! sorry');

			
			//$this->form_validation->set_rules('licence', 'Valid Company Licence Number', //'required|trim|is_unique[otp_transactions.licence]');
			//$this->form_validation->set_rules('email', 'Email ID/Login ID', 'required|trim|is_unique[users.email]');
			//$this->form_validation->set_rules('name', 'Company Name', 'required|trim');
			$this->form_validation->set_rules('referredByCode', 'Consumer ID', 'required|trim');
				

			if($this->form_validation->run() == true)
			{
				$insert = $this->agent_model->otp_transactions();
				if($insert)
				{								
					$this->session->set_flashdata('successMsg', 'Please Inform to New Referrer to Complete Referral Payments...!');
					redirect(base_url('agent/referral_payments'));					
				}

			}
		}

		theme('verify_agent', $data);
	
}
	/**
	 * Add agent script
	 */

	public function add_agent($id){
			//restricted this area, only for admin
		//permittedArea(['admin', 'agent']);

		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		$user_contactno       = singleDbTableRow($userID)->contactno;
		$user_first_name      = singleDbTableRow($userID)->first_name;
		$user_referral_code   = singleDbTableRow($userID)->referral_code;

		$data['users'] = singleDbTableRow($id, 'otp_transactions');

												if($this->input->post()) 
													{
													//	if ($this->input->post('submit') != 'add_agent1') die('Error! sorry');
													
														if ($this->input->post('submit1') != 'add_agent2'); // die('Error! sorry');
														{
															$this->form_validation->set_rules('email', 'Login Email ID', 'required|trim|is_unique[users.email]');
															$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
															$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
$this->form_validation->set_rules('licence', 'Licence No', 'required');

															if($this->form_validation->run() == true)
															{
																$insert = $this->agent_model->add_agent($id);
																if($insert)
																{
																	$this->session->set_flashdata('successMsg', 'Agent Created Successfully...!!!');
																	redirect(base_url('account/my_referrals'));
																	
																		
																}else{$this->session->set_flashdata('errorMsg', 'Carefully Enter the OTP and Password Details');}

															}
														}
													}	
													
									
		theme('add_agent', $data);

	}
		
public function otp_tran_agent()
	{
		$id = $_GET['id'];
		$table_name = "otp_transactions";			
		$where_array = array('id' => $id);
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{		  
																	
					$key_id	  =  $r->key_id;
					$otp	  =  $r->otp;													
					$mobile = $r->sms_no;											
					$c_name	= $r->company_name;
					
					$insert = $this->product_model->sms_pay_wallet($key_id, $otp, $mobile, $c_name );
			}
		}
	}

	/**
	 * Agent list from db
	 * @return Json format
	 * usable only via API
	 */

	public function agentListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->agent_model->agentListCount();
		$query = $this->agent_model->agentList($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
if($query -> num_rows() > 0) 
{	foreach($query->result() as $r){
			$activeStatus = $r->active;
			//Status Button
			switch($activeStatus){
				case 0:
					$statusBtn = '<small class="label label-default"> Pending </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
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
					
				case 3 :
					
					$statusBtn = '<small class="label label-danger"> Deactivated By Admin </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Deactivate" value="3">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
			}

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('agent/profile_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';
		
			$button .= $blockUnblockBtn;
		
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				$button,
				$r->first_name.' '. $r->last_name,
				$statusBtn,
				$r->email,
				$from_role = typeDbTableRow($r->rolename)->rolename,
				$r->contactno,

				$r->referral_code
				
			);
		}
}
		else{
			$data['data'][] = array(
				'Consumers are not Available' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);

	}
	
	public function referral_payments()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('referral_payments');
	}

/**
	 * referral_paymentListJson list from db
	 * @return Json format
	 * usable only via API
	 */

	public function referral_paymentListJson(){
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		$rolename = singleDbTableRow($userID)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->agent_model->referral_PaymentListCount();
		$query = $this->agent_model->referral_PaymentList($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
if($query -> num_rows() > 0) 
{	foreach($query->result() as $r){
			$activeStatus = $r->active;
			//Status Button
			switch($activeStatus){
				case 0:
					$statusBtn = '<small class="label label-default"> Pending </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
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
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('agent/add_agent/'. $r->id).'" data-toggle="tooltip" title="View"> Proceed Payment
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= $blockUnblockBtn;
		if ($rolename == '11') //Super Admin Only
		{
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
		}
			$data['data'][] = array(
				$button,
					$statusBtn,	
			//	$r->company_name.' "Licence No-" '. $r->licence,
				
				$from_role = typeDbTableRow($r->sponsor_role)->rolename,
				$r->amount,		
					
			$r->fname,		
				$result2 = strtoupper (substr($from_role = typeDbTableRow($r->rolename)->rolename, 0, 3)).$r->referredByCode	
				
			);
		}
}
		else{
			$data['data'][] = array(
				'Referral Agent Payments are not Available' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);
	}
	
	
	/**
	 * This isApi for deleting the referral_PaymentList in Emergency
	 */

	public function referral_payee_deleteAjax(){
		permittedArea();
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity("Deleted {$fullName} from Referral Payments list");
		//Now delete permanently
		$this->db->where('id', $id)->delete('otp_transactions');
		return true;
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


	public function profile_view($id){
		//restricted this area, only for admin
		permittedArea();

		$data['profile_Details'] = $this->db->get_where('users', ['id' => $id]);

	/*	$data['profile_Details'] = $this->db->query("select users.*, count(rerreral.id) as referralCount
								from users LEFT JOIN
								users as rerreral on users.referral_code = rerreral.referredByCode
								where users.id = {$id}"); */

		theme('profile_view', $data);
	}

	
	/**
	 * Add Bank Branch Details
	 */

	public function add_bank(){
		//restricted this area, only for admin
		permittedArea();

		$data['countries'] = $this->db->get('countries');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_bank') die('Error! sorry');

			$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
			$this->form_validation->set_rules('contactno', 'Contact No.', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'required|trim');
			$this->form_validation->set_rules('profession', 'Profession', 'required|trim');
			$this->form_validation->set_rules('street_address', 'Street Address', 'required|trim');
			$this->form_validation->set_rules('gender', 'Gender', 'required');			
			$this->form_validation->set_rules('country', 'Country', 'required');

			if($this->form_validation->run() == true)
			{
				$insert = $this->agent_model->add_bank();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Bank Created Successfully...!!!');
					redirect(base_url('agent'));
				}

			}
		}

		theme('add_bank', $data);
	}
	
	
	public function get_user(){
		$ref_id = $_POST['ref_id'];
		//echo $ref_id;
		$data = $this->db->get_where('users', ['referral_code'=>$ref_id]);
		
		if($data->num_rows() > 0){
			foreach($data->result() as $row1)
			{
				$user = "<input type='hidden' id='user_id' value='".$row1->id."'>" ;
			}
			
			
			$user .= "<table class='table table-bordered'><thead><tr><th>Name</th><th>Email</th><th>Role Name</th></tr></thead>";
			$user .= "<tbody>";
			
			foreach($data->result() as $row)
			{
				$role = $row->rolename;
				$get_role = $this->db->get_where('role', ['id'=>$role]);
				
				foreach($get_role->result() as $rn)
				{
					$rolename = $rn->rolename;
				}
				$user .="<td>".$row->first_name." ".$row->last_name."</td><td>".$row->email."</td><td>".$rolename."</td>";
			}
			$user .="</tbody></table>";
		}
		else{
			$user ="<font color='red'>Please Enter a Valid Consumer ID.</font>";
		}
		
		
		echo $user;
	}
	
	
}
