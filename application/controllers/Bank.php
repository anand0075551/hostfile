<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Bank/agent_model');
		$this->load->model('user_model');
                $this->load->model('agent_model');
		$this->load->model('Bank_model');
		$this->load->model('ledger_model');
		$this->load->model('notification_model');
		check_auth(); //check is logged in.
	}

	public function index()
	{
		//restricted this area, only for admin
		//permittedArea() ;  bankListJson

		theme('bank_index');
	}

	/**
	 * Online Payment Transaction
	 */

	public function online_payment(){
		//restricted this area, only for admin
	//	permittedArea();

		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
	//	$data['users'] = $this->db->get_where('users', ['id' => $userID]);
		$data['users'] = singleDbTableRow($userID, 'users');
	//For Wallet Balance	
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'online_payment') die('Error! sorry');

		//	$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			

			if($this->form_validation->run() == true)
			{
			
			$insert = $this->Bank_model->online_payment();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Payment Transfer Scheduled !!!. Please check after 48hrs to reflect in your Rulets Account..!');
					redirect(base_url('account'));
				}

			}
		}

		theme('online_payment', $data);
	} 

	/**
	 * Agent list from db
	 * @return Json format
	 * usable only via API
	 */

	public function bankListJson(){
		
		$user = loggedInUserData();
		$userID = $user['user_id'];	
		$currentUser = singleDbTableRow($userID)->role;
		$rolename = singleDbTableRow($userID)->rolename;
			
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->Bank_model->bankListCount();
		$query = $this->Bank_model->bankList($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		IF ($query -> num_rows() > '0' )
		{
		foreach($query->result() as $r){
			$activeStatus = $r->active;
			//Status Button
			switch($activeStatus){
				case 0:
					$statusBtn = '<small class="label label-default"> Pending for Approval </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
				case 1 :
					$statusBtn = '<small class="label label-success"> Approved  </small>';
					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="2">
						<i class="fa fa-lock"></i> </button>';
						
						
					break;
				case 2 :
					$statusBtn = '<small class="label label-danger"> Blocked </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
			}
	//Get Decision who in online?
	//	if($user['role'] == 'admin')
			if($rolename == 11 or $rolename == 22 or $rolename == 24)
		{
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('bank/bank_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('bank/bank_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= $blockUnblockBtn;
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
		}else{
			//Action Button
			$button = 'Finance Team';
		}
		if( $r->transaction_type != 'deposit')
		{
			if( $r->company_name == 'Not Available' or $r->company_name == ' ' )
			{  $name = $r->first_name.' '.$r->last_name;
			}else{
				$name = $r->company_name;
			}
		}else{
			$name = $r->first_name.' '.$r->last_name;
		}
			$data['data'][] = array(	
				$button,			
				$name, //$r->first_name.' '.$r->last_name,				
				$r->transaction_type,
				$r->ifsc_code,
			    number_format($r->amount, 2) ,
				$r->tranx_id,
				//$r->email,
//				$r-->row_pass, replacing Password fields with Profession(Membership Type) display
				date('d/m/Y h:i A',$r->created_at),
				//$statusBtn,								
				 $r->active 		
				
			);
		}
	}
		else{
			$data['data'][] = array (
			'Deposit/Withdrawl Transactions are not Available...!!!' , '', '','', '','','', '');
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
		$this->db->where('id', $id)->delete('bank');
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

		$this->db->where('id', $id)->update('bank', ['active' => $buttonValue]);
		return true;
	}


	public function bank_view($id){
		//restricted this area, only for admin
	//	permittedArea();

		$data['profile_Details'] = $this->db->get_where('bank', ['id' => $id]);
	
	
/*
		$data['profile_Details'] = $this->db->query("select bank.*, count(rerreral.id) as referralCount
								from bank LEFT JOIN
								bank as rerreral on bank.referral_code = rerreral.referredByCode
								where bank.id = {$id}"); 
*/
		theme('bank_view', $data);
	}
	/**
	 * Add Bank Branch Details
	 */

	public function add_bankdeposit(){
		//restricted this area, only for admin
		//permittedArea();
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		//For Wallet Balance	
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
	
		$data['users'] = singleDbTableRow($userID, 'users');
		$data['countries'] = $this->db->get('countries');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_bankdeposit') die('Error! sorry');

			//Form fields Validation
			$this->form_validation->set_rules('amount', 'Deposited Amount', 'required|trim');
			$this->form_validation->set_rules('userfile', 'Reciept/Challan', 'trim');		
			$this->form_validation->set_rules('tranx_id', 'Transaction ID and Date', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Bank_model->add_bankdeposit();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Bank Deposit Challan Submitted Successfully... Please check your Email for "Rulest" Approval!!!');
					redirect(base_url('bank'));
				}

			}
		}

		theme('add_bankdeposit', $data);
	}
	
	/**
	 * Cash Withdrawl from Wallet Account
	 */

	public function cash_withdrawl(){
		//restricted this area, only for admin
		//permittedArea();
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		//For Wallet Balance	
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
	
		$data['users'] = singleDbTableRow($userID, 'users');
		$data['countries'] = $this->db->get('countries');
		
		$table_name = "role";		
		$where_array = array('type' => 'withdraw' );
		$data['reason'] = $this->db->where($where_array)->get($table_name);

		
					
		if($this->input->post())
		{
			if($this->input->post('submit') != 'cash_withdrawl') die('Error! sorry');

			//Form fields Validation
			$this->form_validation->set_rules('amount', 'Deposited Amount', 'required|trim');				
			$this->form_validation->set_rules('tranx_id', 'Transaction ID', 'required');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Bank_model->cash_withdrawl();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Request Submitted Successfully... Please check the Status in Bank Transaction Summary!!!');
					redirect(base_url('bank'));
				}

			}
		}

		theme('cash_withdrawl', $data);
	}
	/**
	 * Cash Withdrawl from Wallet Account
	 */

	public function cash_reimbursement(){
		//restricted this area, only for admin
		//permittedArea();
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		//For Wallet Balance	
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
	
		$data['users'] = singleDbTableRow($userID, 'users');
		$data['countries'] = $this->db->get('countries');
		
		$table_name = "role";		
		$where_array = array('type' => 'reimbursement' );
		$data['reason'] = $this->db->where($where_array)->get($table_name);

		$data['sub_account']  = $this->db->get_where('acct_categories', ['id' => '45']);
					
		if($this->input->post())
		{
			if($this->input->post('submit') != 'cash_reimbursement') die('Error! sorry');

			//Form fields Validation
			$this->form_validation->set_rules('amount', 'Reimbursement Amount', 'required|trim');				
			$this->form_validation->set_rules('tranx_id', 'Transaction ID', 'required');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Bank_model->cash_reimbursement();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Reimbursement Challan/Reciept Submitted Successfully... Please check your Email for Approval!!!');
					redirect(base_url('bank'));
				}

			}
		}

		theme('cash_reimbursement', $data);
	}

/**
	 * Get Current Bank(Self)
	 */

	public function self_bank(){
		theme('self_bank');
	}

	
	/**
	 * Profile Edit
	 * Action handle here...
	 */

	public function bank_edit($id = 0){

		//get sure is admin if pass a profile ID
		if($id != 0) permittedArea();

		$data['profile_id'] = $id;

		$this->form_validation->set_rules('bank_name', 'Bank Name', 'required|trim');	
		$this->form_validation->set_rules('bank_address', 'Bank Branch & Complete Address.', 'required|trim');				
		$this->form_validation->set_rules('bank_account', 'Bank Account No', 'required|matches[bankconf]');
		$this->form_validation->set_rules('bankconf', 'Bank Account No Confirmation', 'required');
		$this->form_validation->set_rules('ifsc_code', 'IFS Code.', 'required|trim');	
		$this->form_validation->set_rules('pan_no', 'PAN Number.', 'required|trim');	
		$this->form_validation->set_rules('bank_acc_type', 'A/C Type', 'required|trim');
		$this->form_validation->set_rules('contactno', 'Bank A/C Registered Mobile Number', 'required|trim');		
		
			

		if($this->form_validation->run() == true)
		{
			$update = $this->user_model->bank_update($id);
			if($update)
			{
				$this->session->set_flashdata('successMsg', 'Bank Details Updated Successfully');
				redirect(base_url('bank/self_bank'));
			}
		}


		if($id != 0){
			theme('bank_edit_common', $data);
		}else{
			theme('bank_edit');
		}


	}
	
	//Create Loan Schemes for the Customers
	public function create_loans() {
		//restricted this area, only for admin
		permittedArea();
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		if($user['role'] == 'admin')
		{
			//To Get Loan Type
			$where_array = array ('type'=>'loan_type', 'active'=>'1');
			$data['loan_type']		  = $this->db->get_where('role', $where_array);
			
			$data['main_account'] = $this->db->get_where('acct_categories', ['category_type' => 'main']);
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);			
			
			//To Get Client Role Type
			$where_array = array ('type'=>'role_name', 'active'=>'1');
			$data['roles']		  = $this->db->get_where('role', $where_array);
			
		}
		
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'create_loans') die('Error! sorry');

			$this->form_validation->set_rules('loan_name', 'Loan Scheme Name', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'trim'); 			
			$this->form_validation->set_rules('acct_id', 'Main Account', 'required|trim'); 		
			$this->form_validation->set_rules('sub_acct_id', 'Sub-Accounts Type', 'required|trim'); 
			$this->form_validation->set_rules('start_date', 'Voucher Start Date', 'required|trim'); 			
			$this->form_validation->set_rules('to_role', 'Client Role', 'required|trim'); 	
			 
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->Bank_model->create_loans();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'A New Loan Scheme is Created Successfully...!!!');
					redirect(base_url('bank/business_loans_index'));
				}
			}
		}

		theme('create_loans', $data);
		
	}
		public function business_loans_index() {
		
		
		theme('business_loans_index');
	}		

	
		public function view_loan_schemes($id) {
			$data['commissions'] = singleDbTableRow($id,'commissions');
		
		theme('view_loan_schemes', $data);
	}		
/**
	 * General/Private Voucher list from db
	 * @return Json format
	 * usable only via API
	 */

	public function businessLoansListJson(){
		
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

		$queryCount = $this->Bank_model->businessLoansListCount();
		$query = $this->Bank_model->businessLoansList($limit, $start);
	

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
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('bank/view_loan_schemes/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			//$button .= '<a class="btn btn-info editBtn"  href="'.base_url('vouchers/edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
				//		<i class="fa fa-edit"></i> </a>';
				if ($currentUser == 'admin'){
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}

			$data['data'][] = array(
				$loan_type = typeDbTableRow($r->type)->rolename,					
				$r->remarks,	
				$r->amount,
				$r->transferrable,
				$r->start_date,	
			//	$r->end_date,		
			//	$r->first_name.' '.$r->last_name,			
				$button
			);
		//}
		}
		}
		else{
			$data['data'][] = array (
			'Currently, Loan Schemes are not availbale to your Account' , '', '','', '','','', '');
		}

		echo json_encode($data);

	}
	/**
	 * Online Deposit
	 */

	public function temp_design(){
		
		
		theme('temp_design');
	}
	/* Loan Schemes Edit/Updated
	
	
	*/
		public function edit_loan_schemes($id){
		//restricted this area, only for admin
	//	permittedArea();

		$data['commissions'] = singleDbTableRow($id,'commissions');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_loan_schemes') die('Error! sorry');

			$this->form_validation->set_rules('remarks', 'Loan Name', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			$this->form_validation->set_rules('start_date', 'Start date', 'required|trim');			
			$this->form_validation->set_rules('end_date', 'End Date', 'trim');	
			$this->form_validation->set_rules('tenure', 'Tenure of Loan', 'required|trim');
					

			if($this->form_validation->run() == true)
			{
				$insert = $this->Bank_model->edit_loan_schemes($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Loan Schemes Updated Successfully...!!!');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}

		theme('edit_loan_schemes', $data);
	}
	
	/**
	 * Generate Vouchers(Display)
	 *
	 */

	public function generate_loans($id){
	//restricted this area, only for admin
	//	permittedArea();
		$data['total_wallet']			= $this->ledger_model->total_wallet();
		$data['total_wallet_debit']		= $this->ledger_model->total_wallet_debit();
		$data['total_wallet_credit']	= $this->ledger_model->total_wallet_credit();

		$data['commissions'] = singleDbTableRow($id,'commissions');
		$data['client'] = $this->db->get("users");

		if($this->input->post())
		{
			if($this->input->post('submit') != 'generate_loans') die('Error! sorry');

			$this->form_validation->set_rules('remarks', 'Loan Name', 'trim');
			$this->form_validation->set_rules('identity_id', 'Loan ID', 'trim');		
			$this->form_validation->set_rules('start_date', 'Start date', 'trim');			
			$this->form_validation->set_rules('end_date', 'End Date', 'trim');	
			$this->form_validation->set_rules('to_role', 'Role Name', 'trim');			
			$this->form_validation->set_rules('amount', 'Amount', 'trim');
			$this->form_validation->set_rules('tenure', 'Loan Tenure', 'trim');
			$this->form_validation->set_rules('period', 'Loan Period', 'trim');		
			$this->form_validation->set_rules('customerID', 'Beneficiary Name', 'required|trim');		
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->Bank_model->generate_loans($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Loan Scheme Geneated  Successfully...!!!');
					//redirect($_SERVER['HTTP_REFERER']);
					redirect(base_url('bank/business_loans_index'));
				}
			}
		}

		theme('generate_loans', $data);
	}	
/**
	 * Get Current Bank(Self)
	 */

	public function PayUMoney_form(){
		theme('PayUMoney_form');
	}



/*============================================*/
//Bank Details Report 
public function report_bank(){
		theme('report_bank');
	}
	
/*============================================*/


// Bank Details view button file


	
	 public function view_bank_report($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['Dashbord'] = $this->db->get_where('bank', ['id' => $id]);
        theme('view_bank_report', $data);
    }
/*================================================*/
//Bank Details Search

public function bank_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$contactno = $_POST['contactno'];
		$transaction_type = $_POST['transaction_type'];
		$ifsc_code = $_POST['ifsc_code'];
		$rolename = $_POST['rolename'];
		$referredByCode = $_POST['referredByCode'];
		$bank_ifscode = $_POST['bank_ifscode'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');


		$queryCount = $this->Bank_model->search_bank_ListCount($contactno,$transaction_type,$ifsc_code,$rolename,$referredByCode,$bank_ifscode,$sf_time,$st_time);
		

		$query = $this->Bank_model->search_bank_List($limit, $start ,$contactno,$transaction_type,$ifsc_code,$rolename,$referredByCode,$bank_ifscode,$sf_time,$st_time);
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
		
			   
              

               
		/*	$get_rolename = $this->db->get_where('role', ['id'=>$r->rolename]);
			foreach($get_rolename->result() as $p);
			$rolename = $p->rolename;*/
	
	$query2 = $this->db->get_where('users', ['id' => $r->created_by]);

					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$created_by =  $row2->first_name;
					}
					} else {
					$created_by =  " ";
					}
              
			   $button = '';
                $button.= '<a class="btn btn-primary editBtn" href="' . base_url('Bank/view_bank_report/'.$r->id) . '" data-toggle="tooltip" title="View">
					<i class="fa fa-eye"></i> </a>';
				 $data['data'][] = array(
				$button,
				
                $r->first_name,
                $r->last_name,
                
               $r->email,
			   
                $r->contactno,
                $r->tranx_id,
                $r->transaction_type,
               $r->ifsc_code,
			   
               $r->transaction_date,
               $r->postal_code,
               $r->adhaar_no,
				
				$r->passport_no,
				
                $r->rolename,
                $r->active,
                $r->referral_code,
               $r->account_no,
			   
               $r->amount,
                $r->referredByCode,
				
				 $r->challan,
                $r->company_name,
				
				$r->bank_name,
               $r->bank_acc_type,
               $r->bank_account,
               $r->bank_address,
			   
               $r->pan_no,
               $r->bank_ifscode,
                $created_by,
                date('d-m-Y H:i:s', $r->created_at),
                date('d-m-Y H:i:s', $r->modified_at) 
				 
                  
				
			);
		}
}
		else{
			$data['data'][] = array(
				'Records are not Available' , '', '','', '','','','','','','','','','','','','','','','','','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}
	
        public function get_total_amount(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$contactno = $_POST['contactno'];
		$transaction_type = $_POST['transaction_type'];
		$ifsc_code = $_POST['ifsc_code'];
		$rolename = $_POST['rolename'];
		$referredByCode = $_POST['referredByCode'];
		$bank_ifscode = $_POST['bank_ifscode'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
	
		
		
		
		
		$query = $this->Bank_model->get_total_amount($contactno,$transaction_type,$ifsc_code,$rolename,$referredByCode,$bank_ifscode,$sf_time,$st_time);

		if($query -> num_rows() > 0) 
	  {
		  $amount = 0;
		 foreach($query->result() as $r)
		{
			$amount = $amount + $r->amount;
		}
	  }
	  else
	  {
		  $amount = 0;
	  }
	  echo "<table class='table table-striped'>
	  <tr>
	
	  <th>Total No.of Transactions : </th>
	  <td>".$query -> num_rows()."</td>
	  </tr>
	  <tr>
	  <th>Total amount :</th>
	  <td> ".number_format($amount)."</td>
	  </tr>
	  </table>
	  ";
	}

	
	
	/*================================================*/
}//Last brace required
