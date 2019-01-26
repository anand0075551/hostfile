<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledger extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('ledger_model');
		$this->load->model('category_model');	
$this->load->model('user_model');			
$this->load->model('notification_model');
		check_auth(); //check is logged in.
	}

	public function index()
	{
		//restricted this area, only for admin
		permittedArea();
		$data['assets']  = $this->ledger_model->totalAssets();
	//	$data['debits']  = $this->ledger_model->totalDebits();
	//	$data['credits'] = $this->ledger_model->totalCredits();
		
		$data['debits']  = $this->ledger_model->ledgerDebit();
		$data['credits'] = $this->ledger_model->ledgerCredit();
		
		
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();
		
		theme('ledger_index', $data);
		
	}
	
		public function commission_index()
	{
		//restricted this area, only for admin
		permittedArea();
		$data['assets']  = $this->ledger_model->totalAssets();
		$data['debits']  = $this->ledger_model->totalDebits();
		$data['credits'] = $this->ledger_model->totalCredits();
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();
		
		
		theme('commission_index', $data);
	}
/**
	 * Get Main Account to Slect Sub-Account/Pay type
	 */

	public function validatePaytypeCodeApi(){
		$acct_id = $this->input->post('acct_id');
		$query = $this->db->get_where('acct_categories', ['id' => $acct_id]);
	
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $r);
		
		
			$data['status'] 		= 'true';
			$data['customerName']	= $r->first_name.' '.$r->last_name;
			$data['customerAddress']	= nl2br($r->street_address);
			$data['customerAddress']	.= '<br />Client Role : '.typeDbTableRow($r->rolename)->rolename;
			$data['customerAddress']	.= '<br />Contact No : '.$r->contactno ;
			$data['customerAddress']	.= ($r->passport_no = '') ?
										'<br /> Passport No : '. $r->passport_no :										
										'<br /> MyFair Account No : '. $r->account_no;
										'<br /> Adhaar Card No : '. $r->adhaar_no;
										
		}
		else{
			$data['status'] 			= 'false';
			$data['customerName']		= '';
			$data['customerAddress']	= '';
		}

		echo json_encode($data);
	}
/**
	 * Accounts Category add method
	 *
	 */

	public function add_acct_category(){
		//restricted this area, only for admin
		permittedArea();
if($user['role'] == 'admin')
		{
			$data['ledger1'] = $this->db->get_where('acct_categories', ['category_type' => 'Main']);
			
		}
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_acct_category') die('Error! sorry');

			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
			$this->form_validation->set_rules('visible', 'Access To Payspecifications', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->ledger_model->add_acct_category();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Accounts Category Created Successfully...!!!');
					redirect(base_url('ledger'));
				}
			}
		}
theme('add_acct_category');
	}
	/**
	 * Sub- Accounts Category add method
	 *
	 */

	public function add_acct_sub_category(){
		//restricted this area, only for admin
		permittedArea();
			//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		if($user['role'] == 'admin')
		{
			$data['ledger1'] = $this->db->get_where('acct_categories', ['category_type' => 'Main']);
			
		}
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_acct_sub_category') die('Error! sorry');

			$this->form_validation->set_rules('category_type', 'Accounts Type', 'required|trim');
			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
			$this->form_validation->set_rules('visible', 'Access To Payspecifications', 'required|trim');
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->ledger_model->add_acct_sub_category();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Sub-Accounts Created under Category Successfully...!!!');
					redirect(base_url('ledger'));
				}
			}
		}

//$mydata = $this->category_model->getmainCat();
//echo "<pre>";
//print_r($mydata);
//echo "</pre>";
//$data['row'] = $mydata;
	//$this->load->view('add_acct_sub_category',$data);
	//---$this->load->view('add_acct_sub_category');
		theme('add_acct_sub_category', $data);
	}


	
	/**
	 * Ledger add method
	 *
	 */

	public function add_ledger(){
		//restricted this area, only for admin
		permittedArea();
		permittedArea();
		$data['assets']  = $this->ledger_model->totalAssets();
		$data['debits']  = $this->ledger_model->totalDebits();
		$data['credits'] = $this->ledger_model->totalCredits();
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();
		
		
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];		
		if($user['role'] == 'admin')
		{
			
			$data['ledger1'] = $this->db->get_where('acct_categories', ['category_type' => 'Main']);
			$data['ledger2'] = $this->db->get_where('acct_categories', ['category_type' => 'Sub']);
		}		
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_ledger') die('Error! sorry');

			//$this->form_validation->set_rules('vouchers_name', 'Vouchers Name', 'required|trim');
		//	$this->form_validation->set_rules('capital', 'Company Capital','trim');
		//	$this->form_validation->set_rules('liabilities', 'Company liabilities', 'trim');			
			
			$this->form_validation->set_rules('pay_type', 'Sub-Accounts Type', 'required|trim'); 
			$this->form_validation->set_rules('trans_type', 'Transfer Type', 'required|trim'); 			
			$this->form_validation->set_rules('cash', 'Amount', 'required|trim');
		
			$this->form_validation->set_rules('remarks', 'Transaction Remarks', 'required|trim'); 				
		//	$this->form_validation->set_rules('userfile', 'Challan/Reciept', 'trim'); 	

			if($this->form_validation->run() == true)
			{
				$insert = $this->ledger_model->add_ledger();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Ledger A/C Added Successfully...!!!');
					redirect(base_url('ledger'));
				}
			}
		}


		theme('add_ledger', $data);
	}
	
	
	public function edit_ledger($id){
		//restricted this area, only for admin
		permittedArea();

		$data['ledger'] = singleDbTableRow($id,'ledger');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_ledger') die('Error! sorry');

		//	$this->form_validation->set_rules('capital', 'Company Capital','trim');
		//	$this->form_validation->set_rules('liabilities', 'Company liabilities', 'trim');			
		//	$this->form_validation->set_rules('cash', 'Company Cash', 'trim');
		//	$this->form_validation->set_rules('challan', 'Challan/Reciept', 'trim'); 
		//	$this->form_validation->set_rules('remarks', 'Transaction Remarks', 'required|trim'); 			
		

			if($this->form_validation->run() == true)
			{
				$insert = $this->ledger_model->edit_ledger($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Ledger Details Updated Successfully...!!!');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}

		theme('edit_ledger', $data);
	}

	
		/*Ledger View */
		public function ledger_view($id){
		//restricted this area, only for admin
		permittedArea();
		$data['ledger'] = singleDbTableRow($id,'ledger');
	
		theme('ledger_view', $data);
	}
/*********************************************************************************************************************/
	//Payspecifications Accounts Overview 



/*********************************************************************************************************************/	
	public function payspec_accounts(){
		//restricted this area, only for admin
		permittedArea();
		$data['assets']  = $this->ledger_model->totalAssets();
		$data['debits']  = $this->ledger_model->totalDebits(); 
		
		$data['totalPay_spec']  = $this->ledger_model->totalPay_spec();
		
		$data['credits'] = $this->ledger_model->totalCredits();
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();
		
		$data['cpaDebit'] = $this->ledger_model->cpaDebit();
		$data['cpaCredit'] = $this->ledger_model->cpaCredit();
		
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		if($user['role'] == 'admin')
		{
			$data['users'] = $this->db->get_where('acct_categories', ['category_type' => 'sub']);			
			$data['ledger1'] = $this->db->get_where('acct_categories', ['category_type' => 'Main']);
			$data['ledger2'] = $this->db->get_where('acct_categories', ['category_type' => 'Sub']);
		}		
		
			if($this->input->post())
		{
			if($this->input->post('submit') != 'payspec_accounts') die('Error! sorry');	
			
			$this->form_validation->set_rules('pay_type', 'From Sub-Accounts Type', 'required|trim'); 
			$this->form_validation->set_rules('to_pay_type', 'To Sub-Accounts Type', 'required|trim'); 
		//	$this->form_validation->set_rules('trans_type', 'Transfer Type', 'required|trim'); 			
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			$this->form_validation->set_rules('remarks', 'Transaction Remarks', 'required|trim'); 				
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->ledger_model->payspec_accounts();
			//	if($insert)
			//	{
			//		$this->session->set_flashdata('successMsg', 'Fund Transfer Between Pay Specifications Completed Successfully...!!!');
					redirect(base_url('ledger/payspec_view'));
			//	}
			}
		}
		
		
		theme('payspec_accounts',$data);
	}
	
	/* Rolewise Payspec Accounts. */
	
		public function rolewise_payspec(){
		//restricted this area, only for admin
		permittedArea();
				
		$data['roleDebit'] = $this->ledger_model->roleDebit();
		$data['roleCredit'] = $this->ledger_model->roleCredit();
		
		
		
		theme('rolewise_payspec',$data);
	}
	
	/*Rolewise json List */
	/**
	 * Payspecification Account list from db for Rolenames
	 * @return Json format
	 * usable only via API
	 */

	public function rolewise_payspecListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		//$queryCount = $this->ledger_model->ledgerListCount();
		
		//$query = $this->ledger_model->ledgerList($start, $limit);
		
		$queryCount = $this->ledger_model->role_Count();
		
		$query = $this->ledger_model->role_List($start, $limit);

		
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		if($query -> num_rows() > 0) 
{	
		foreach($query->result() as $r)
		{
			
			 $where_array = array( 'rolename' => $r->id, 'points_mode' => 'wallet');
			 $query2 = $this->db->select_sum('debit')->where($where_array)->get('accounts'); 
			 if($query2 -> num_rows() > 0) 
				{		
					foreach($query2->result() as $r2)
					{   $payspec_wal_debit = $r2->debit;
							if ($payspec_wal_debit == null)
							{ 
							$payspec_wal_debit = '0.00';
							}
					}
				}

            $where_array = array( 'rolename' => $r->id, 'points_mode' => 'wallet');
			 $query3 = $this->db->select_sum('credit')->where($where_array)->get('accounts'); 
			 if($query3 -> num_rows() > 0) 
				{		
					foreach($query3->result() as $r2)
					{   $payspec_wal_credit = $r2->credit;
						if  ($payspec_wal_credit == null)
						{
							$payspec_wal_credit = '0.00';
						}
					}
				}	
$bal = 		$payspec_wal_debit - 	$payspec_wal_credit;	
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('ledger/payspec_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
		
	
			$data['data'][] = array(
			  
		        $r->rolename ,//$pay_spec = ledgerDbTableRow($r->id)->name,				
				number_format($payspec_wal_debit, 2),		
				number_format($payspec_wal_credit, 2),		
				number_format($bal, 2),
				//$r->id // $r->remarks					
				
			);
		}
			
	
		
}
		else{
			$data['data'][] = array(
				'No Pay Specification Accounts are Created' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);

	}
/* Rolewise Payspec Accounts. */
	
		public function userwise_payspec(){
		//restricted this area, only for admin
		permittedArea();
				
		$data['userDebit'] = $this->ledger_model->userDebit();
		$data['userCredit'] = $this->ledger_model->userCredit();
		
			
		
		theme('userwise_payspec',$data);
	}	
	/*Userwise json List */
	/**
	 * Payspecification Account list from db for User wise
	 * @return Json format
	 * usable only via API
	 */

	public function userwise_payspecListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		//$queryCount = $this->ledger_model->ledgerListCount();
		
		//$query = $this->ledger_model->ledgerList($start, $limit);
		
		//$queryCount = $this->ledger_model->user_Count();
		
		//$query = $this->ledger_model->user_List($start, $limit);
      $queryCount = $this->user_model->userListCount();
		$query = $this->user_model->userList($limit, $start);
		
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		if($query -> num_rows() > 0) 
{	
		foreach($query->result() as $r)
		{
			
			 $where_array = array( 'user_id' => $r->id, 'points_mode' => 'wallet');
			 $query2 = $this->db->select_sum('debit')->where($where_array)->get('accounts'); 
			 if($query2 -> num_rows() > 0) 
				{		
					foreach($query2->result() as $r2)
					{   $payspec_wal_debit = $r2->debit;
							if ($payspec_wal_debit == null)
							{ 
							$payspec_wal_debit = '0.00';
							}
					}
				}

            $where_array = array( 'user_id' => $r->id, 'points_mode' => 'wallet');
			 $query3 = $this->db->select_sum('credit')->where($where_array)->get('accounts'); 
			 if($query3 -> num_rows() > 0) 
				{		
					foreach($query3->result() as $r2)
					{   $payspec_wal_credit = $r2->credit;
						if  ($payspec_wal_credit == null)
						{
							$payspec_wal_credit = '0.00';
						}
					}
				}	
$bal = 		$payspec_wal_debit - 	$payspec_wal_credit;	

if($r->rolename == 11 or $r->rolename == 12)
{
$username = $r->first_name.''.$r->last_name ;		
}else{
$username = $r->company_name;
}			
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('user/profile_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
		
		$data['data'][] = array(
			    $button,
			    $r->referral_code, 
		        $name= typeDbTableRow($r->rolename)->rolename ,	
				$username, 
				number_format($payspec_wal_debit, 2),		
				number_format($payspec_wal_credit, 2),		
				number_format($bal, 2),
				//$r->id // $r->remarks					
				
			);
		}
			
	
		
}
		else{
			$data['data'][] = array(
				'No Pay Specification Accounts are Created' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);

	}
/*Commission and Benefits View */
		public function payspec_view($id){
		//restricted this area, only for admin
		permittedArea();
		$data['assets']  = $this->ledger_model->totalAssets();
		$data['debits']  = $this->ledger_model->totalDebits(); 
		
		$data['totalPay_spec']  = $this->ledger_model->totalPay_spec();
		$data['payspec_totaldebit']  = $this->ledger_model->payspec_totaldebit($id);
		$data['payspec_totalcredit']  = $this->ledger_model->payspec_totalcredit($id);
		
		$data['credits'] = $this->ledger_model->totalCredits();
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();
		
		$data['ledger'] = singleDbTableRow($id,'acct_categories');
	
		theme('payspec_view', $data);
	}
/*********************************************************************************************************************/
	//Transfer Capital 

//Converting ledger cash to wallet

/*********************************************************************************************************************/
	public function transfer_capital(){
		//restricted this area, only for admin
		permittedArea();
		$data['assets']  = $this->ledger_model->totalAssets();
		$data['debits']  = $this->ledger_model->totalDebits(); 
		
		$data['totalPay_spec']  = $this->ledger_model->totalPay_spec();
		
		
		$data['assets']  = $this->ledger_model->totalAssets();
		$data['debits']  = $this->ledger_model->totalDebits();
		$data['credits'] = $this->ledger_model->totalCredits();
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();
		
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		if($user['role'] == 'admin')
		{
			$data['users'] = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
		}
		
		
			if($this->input->post())
		{
			if($this->input->post('submit') != 'transfer_capital') die('Error! sorry');	
			
			$this->form_validation->set_rules('from_pay_type', 'From Sub-Accounts Type', 'required|trim'); 
			$this->form_validation->set_rules('to_pay_type', 'To Sub-Accounts Type', 'required|trim'); 
		//	$this->form_validation->set_rules('trans_type', 'Transfer Type', 'required|trim'); 			
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			$this->form_validation->set_rules('remarks', 'Transaction Remarks', 'required|trim'); 				
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->ledger_model->transfer_capital();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Fund Transfer Between Pay Specifications Completed Successfully...!!!');
					redirect(base_url('ledger'));
				}
			}
		}
		
		
		theme('transfer_capital',$data);
	}
	
	public function cash_2wallet(){
	//restricted this area, only for admin
	//	permittedArea();
		$data['assets']  = $this->ledger_model->totalAssets();
		$data['debits']  = $this->ledger_model->totalDebits();
		$data['credits'] = $this->ledger_model->totalCredits();
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();


		if($this->input->post())
		{
			if($this->input->post('submit') != 'cash_2wallet') die('Error! sorry');


			$this->form_validation->set_rules('cash', 'Cash Convertable Amount', 'required|trim');
			//$this->form_validation->set_rules('pay_type', 'Payment Type', 'required|trim'); 
			$this->form_validation->set_rules('tranx_id', 'Transaction Remarks', 'required|trim'); 				
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->ledger_model->cash_2wallet();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Entered Cash Amount Turned to Wallet Points Successfully...!!!');
					redirect(base_url('ledger'));
				}
			}
		}

		theme('cash_2wallet', $data);
	}	
	
/* For Agent to take credit */


public function wallet_accounts(){
	//restricted this area, only for admin
		permittedArea();
		$data['earnings']  	    	= $this->ledger_model->totalEarning();
		$data['referralEarnings']	= $this->ledger_model->referralEarnings();
		$data['total_liabilities'] 	= $this->ledger_model->total_liabilities();
		$data['total_wallet']		= $this->ledger_model->total_wallet(); //User Total Wallet Points from Accounts Table

			$data['assets']  = $this->ledger_model->totalAssets();
		$data['debits']  = $this->ledger_model->totalDebits();
		$data['credits'] = $this->ledger_model->totalCredits();
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();
		

		if($this->input->post())
		{
			if($this->input->post('submit') != 'cash_2wallet') die('Error! sorry');


			$this->form_validation->set_rules('cash', 'Company Cash', 'required|trim');
			$this->form_validation->set_rules('pay_type', 'Payment Type', 'required|trim'); 
			$this->form_validation->set_rules('tranx_id', 'Transaction Remarks', 'required|trim'); 				
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->ledger_model->cash_2wallet();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Entered Cash Amount Turned to Wallet Points Successfully...!!!');
					redirect(base_url('ledger'));
				}
			}
		}

		theme('wallet_accounts', $data);
	}		
	/**
	 * Agent list from db
	 * @return Json format
	 * usable only via API
	 */

	public function ledgerListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->ledger_model->ledgerListCount();
		
		$query = $this->ledger_model->ledgerList($start, $limit);
					
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		if($query -> num_rows() > 0) 
{	
		foreach($query->result() as $r)
		{
			//VPA Display
			if ($r->points_mode == 'wallet')
			{
				$values = 'VPA';
			}else{
				$values = $r->points_mode;
			}
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('ledger/ledger_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('ledger/edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
	
			$data['data'][] = array(
			$button,
		        $pay_spec = ledgerDbTableRow($r->pay_type)->name,	
				number_format($r->debit, 2) ,
				number_format($r->credit, 2) ,
				$values, //$r->points_mode,
				//$r->first_name.' '.$r->last_name,
				$r->remarks					
				
			);
		}
		
}
		else{
			$data['data'][] = array(
				'There are no Ledger Accounts Available' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);

	}
/**
	 Userwise Indivisual Account Statement
	 */

	public function userAccountListJson(){
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		$role 	= $user['role'];

        
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->ledger_model->userAccountListCount();

		$query = $this->ledger_model->userAccountList($limit, $start);
		
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0) 
		{	
		foreach($query->result() as $r)
		{
			//CPA Display
		if( $role != 'admin')
		{	if ($r->points_mode == 'wallet')
			{
				$values = 'CPA';
			
			if ($r->tran_count != null)
			{
				$counts = $r->tran_count;
			}

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('account/balancesheet_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			//Get Decision who in online?
        if($user['role'] == 'admin')
        {
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
		}	
		
		
				$data['data'][] = array(
				$button,
                                $counts,
				date('d/m/Y h:i A', $r->created_at), //date format
				number_format($r->debit, 2),	
				number_format($r->credit, 2),	
				number_format($r->amount, 2),		
				$values, //$r->points_mode,					
				$r->tranx_id
				
			);
		}
		}else{
			
		if ($r->points_mode == 'wallet')
			{
				$values = 'CPA';
			}else{
				$values = $r->points_mode;
			}
			if ($r->tran_count != null)
			{
				$counts = $r->tran_count;
			}

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('account/balancesheet_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			//Get Decision who in online?
        if($user['role'] == 'admin')
        {
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
		}	
		
		
				$data['data'][] = array(
				$button,
                                $counts,
				date('d/m/Y h:i A', $r->created_at), //date format
				number_format($r->debit, 2),	
				number_format($r->credit, 2),	
				number_format($r->amount, 2),		
				$values, //$r->points_mode,					
				$r->tranx_id
				
			);
		}	
			
			
		}
		
		}
		else{
			$data['data'][] = array(
				'CPA Accounts are not yet updated' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);		

	}
/**
	 Userwise Indivisual Account Statement
	 */

	public function userAccountListJson2(){
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		$role 	= $user['role'];

        
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->ledger_model->userAccountListCount2();

		$query = $this->ledger_model->userAccountList2($limit, $start);
		
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0) 
		{	
		foreach($query->result() as $r)
		{
			
			if ($r->tran_count != null)
			{
				$counts = $r->tran_count;
			}

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('account/balancesheet_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			//Get Decision who in online?
        if($user['role'] == 'admin')
        {
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
		}	
		
		
				$data['data'][] = array(
				$button,
                                $counts,
				date('d/m/Y h:i A', $r->created_at), //date format
				number_format($r->debit, 2),	
				number_format($r->credit, 2),	
				number_format($r->amount, 2),		
				$r->points_mode,					
				$r->tranx_id
				
			);
		
		}
		}
		else{
			$data['data'][] = array(
				'Offer Accounts are not yet updated' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);		

	}

/**
	 Services Transaction Statement after Recharging Mobile
	 */

	public function services_transactionListJson(){
		$user = loggedInUserData();
		$userID = $user['user_id'];

		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->ledger_model->services_transactiontListCount();

		$query = $this->ledger_model->services_transactionList($limit, $start);
		
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0) 
		{	
		foreach($query->result() as $r)
		{
	
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('account/transactions_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('accounts/edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
			
				$data['data'][] = array(
				date('d/m/Y h:i A', $r->created_at), //date format
				$r->recharge_type,
				$r->recharge_no,	
				number_format($r->amount, 2),	
				$r->account_no,												
				$button
			);
		}
		}
		else{
			$data['data'][] = array(
				'Woff...!!! Services Transaction are not yet started' , '', '','', '','',''
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
		$userInfo = singleDbTableRow($id,'ledger');
		$categoryName = $userInfo->user_id;
		// add a activity
		create_activity("Deleted {$amount} ledger");
		//Now delete permanently
		$this->db->where('id', $id)->delete('ledger');
		return true;
	}

	/**
	 * Creating Commissions/Benefits/Credits/Debits for each role from Sub Accounts
	 *
	 */

	public function add_commissions(){
		//restricted this area, only for admin
		permittedArea();

		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		if($user['role'] == 'admin')
		{
			$data['main_account'] = $this->db->get_where('acct_categories', ['category_type' => 'main']);
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
			
			$data['main_account2'] = $this->db->get_where('acct_categories', ['category_type' => 'main']);
			$data['sub_account2']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
			
			$where_array = array ('type'=>'role_name', 'active'=>'1');
			$data['roles']		  = $this->db->get_where('role', $where_array);
			
		}
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_commission') die('Error! sorry');	
			
			$this->form_validation->set_rules('acct_id', 'Main Account', 'required|trim'); 		
			$this->form_validation->set_rules('sub_acct_id', 'Sub-Accounts Type', 'required|trim'); 
			$this->form_validation->set_rules('from_role', 'Seller', 'required|trim'); 			
			$this->form_validation->set_rules('to_role', 'Client', 'required|trim'); 						
			$this->form_validation->set_rules('commission', 'Commission Percentage', 'required|trim'); 
			$this->form_validation->set_rules('benefits', 'Benefits Percentage', 'required|trim'); 
			$this->form_validation->set_rules('sender_profit', 'Sender Profit Percentage', 'required|trim'); 
			$this->form_validation->set_rules('receiver_profit', 'Receiver Profit Percentage', 'required|trim'); 
			$this->form_validation->set_rules('sender_deduction', 'Sender Deduction Percentage', 'required|trim'); 
			$this->form_validation->set_rules('receiver_deduction', 'Receiver Deduction Percentage', 'required|trim'); 
			$this->form_validation->set_rules('points_mode', 'Points mode', 'required|trim'); 
			$this->form_validation->set_rules('remarks', 'Transaction Remarks', 'required|trim'); 				
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->ledger_model->add_commission();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Commissions & Benefits Created Successfully...!!!');
					redirect(base_url('ledger/commission_index'));					
				}
				else
					$this->session->set_flashdata('successMsg', 'Records Already Created...!!!');
					redirect(base_url('ledger/commission_index'));
			}
		}


		theme('add_commissions', $data);
	
	}
	
		
	public function edit_commissions($id){
		//restricted this area, only for admin
		permittedArea();

		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		if($user['role'] == 'admin')
		{
			$data['main_account'] = $this->db->get_where('acct_categories', ['category_type' => 'main']);
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
			
			$where_array = array ('type'=>'role_name', 'active'=>'1');
			$data['roles']		  = $this->db->get_where('role', $where_array);
				
			$data['commissions'] = singleDbTableRow($id,'commissions');
		}
		

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_commissions') die('Error! sorry');

			$this->form_validation->set_rules('commission', 'Commission Percentage', 'required|trim'); 
			$this->form_validation->set_rules('benefits', 'Benefits Percentage', 'required|trim'); 
			$this->form_validation->set_rules('sender_profit', 'Sender Profit Percentage', 'required|trim'); 
			$this->form_validation->set_rules('receiver_profit', 'Receiver Profit Percentage', 'required|trim'); 
			$this->form_validation->set_rules('sender_deduction', 'Sender Deduction Percentage', 'required|trim'); 
			$this->form_validation->set_rules('receiver_deduction', 'Receiver Deduction Percentage', 'required|trim'); 
			$this->form_validation->set_rules('points_mode', 'Points mode', 'required|trim'); 
			$this->form_validation->set_rules('remarks', 'Transaction Remarks', 'required|trim'); 		
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->ledger_model->edit_commissions($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Transactions Commissions Details Updated Successfully...!!!');
					//redirect($_SERVER['HTTP_REFERER']);
					redirect(base_url('ledger/commission_index'));
				}
			}
		}

		theme('edit_commissions', $data);
	}
	

/* Commission List Json */
	public function commissionListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->ledger_model->commissionListCount();
		
		$query = $this->ledger_model->commissionList($limit, $start);
		
				
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		IF ($query -> num_rows() > '0' )
		{
		foreach($query->result() as $r){
			if ($r->identity == 'Commission'){
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('ledger/commissions_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';			
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('ledger/edit_commissions/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
	
//    <th>Accounts</th>                           
 //   <th>Sub-Accounts</th>
 //   <th>From Role</th>	
//    <th>To Role</th>
//    <th>Commission in %</th>								
//    <th>Remarks</th>
//    <th>Action</th>

			$data['data'][] = array(
				$button,
				$pay_spec1 = ledgerDbTableRow($r->sub_acct_id)->name,
				$from_role = typeDbTableRow($r->from_role)->rolename,	
				$from_role = typeDbTableRow($r->to_role)->rolename,	
				$pay_spec2 = ledgerDbTableRow($r->sub_acct_id)->name,
				$r->benefits										
				
			);
		}}
		}
		else{
			$data['data'][] = array (
			'Commissions are not yet Created' , '', '','', '','','', '');
		}

		echo json_encode($data);

	}
		/*Commission and Benefits View */
		public function commissions_view($id){
		//restricted this area, only for admin
		permittedArea();
		$data['commissions'] = singleDbTableRow($id,'commissions');
	
		theme('commissions_view', $data);
	}
	
			/* Referral View List */
		public function referral_view($id){
		//restricted this area, only for admin
	//	permittedArea();
		$data['users'] = $this->db->get_where('users', ['role' => 'user']); 
		$data['profile'] = singleDbTableRow($id,'users');
		
		/*	$data['profile_Details'] = $this->db->query("select users.*, count(rerreral.id) as referralCount
								from users LEFT JOIN
								users as rerreral on users.referral_code = rerreral.referredByCode
								where users.id = {$id}"); 
	*/
		theme('referral_view', $data);
	}
	
	/*User Referral Commission and Benefits View */
		public function referral_commissions_view($id){
		//restricted this area, only for admin
		//permittedArea();
		$data['commissions'] = singleDbTableRow($id,'accounts');
	
		theme('referral_commissions_view', $data);
	}	
	
		/**
	 * This isApi for deleting an agent
	 */

	public function deleteCommission(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'commissions');
		$categoryName = $userInfo->user_id;
		// add a activity
		create_activity("Deleted {$id} commissions");
		//Now delete permanently
		$this->db->where('id', $id)->delete('commissions');
		return true;
	}
	
	/**
	 * Payspecification Account list from db
	 * @return Json format
	 * usable only via API
	 */

	public function payspecListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		//$queryCount = $this->ledger_model->ledgerListCount();
		
		//$query = $this->ledger_model->ledgerList($start, $limit);
		
		$queryCount = $this->ledger_model->pay_Count();
		
		$query = $this->ledger_model->pay_List($start, $limit);

		
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		if($query -> num_rows() > 0) 
{	
		foreach($query->result() as $r)
		{
			if ($r->parentid != 0)
			{
			 $where_array = array( 'pay_type' => $r->id, 'points_mode' => 'wallet');
			 $query2 = $this->db->select_sum('debit')->where($where_array)->get('ledger'); 
			 if($query2 -> num_rows() > 0) 
				{		
					foreach($query2->result() as $r2)
					{   $payspec_wal_debit = $r2->debit;
							if ($payspec_wal_debit == null)
							{ 
							$payspec_wal_debit = '0.00';
							}
					}
				}

            $where_array = array( 'pay_type' => $r->id, 'points_mode' => 'wallet');
			 $query3 = $this->db->select_sum('credit')->where($where_array)->get('ledger'); 
			 if($query3 -> num_rows() > 0) 
				{		
					foreach($query3->result() as $r2)
					{   $payspec_wal_credit = $r2->credit;
						if  ($payspec_wal_credit == null)
						{
							$payspec_wal_credit = '0.00';
						}
					}
				}	
$bal = 		$payspec_wal_debit - 	$payspec_wal_credit;	
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('ledger/payspec_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('ledger/edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
	
			$data['data'][] = array(
			    $button,
		       $pay_spec = ledgerDbTableRow($r->id)->name,				
			   number_format($payspec_wal_debit, 2),		
				number_format($payspec_wal_credit, 2),		
				number_format($bal, 2),
				//$r->id // $r->remarks					
				
			);
		}
			
		}
		
}
		else{
			$data['data'][] = array(
				'No Pay Specification Accounts are Created' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);

	}
	
/*********************************************************************************************************************/
	//Payspecifications Accounts Category Index Overview 



/*********************************************************************************************************************/	
	public function payspec_list(){
		//restricted this area, only for admin
		permittedArea();
		$data['assets']  = $this->ledger_model->totalAssets();
		$data['debits']  = $this->ledger_model->totalDebits(); 
		
		$data['totalPay_spec']  = $this->ledger_model->totalPay_spec();
		
		$data['credits'] = $this->ledger_model->totalCredits();
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();
		
		
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		if($user['role'] == 'admin')
		{
			$data['users'] = $this->db->get_where('acct_categories', ['category_type' => 'sub']);			
			$data['ledger1'] = $this->db->get_where('acct_categories', ['category_type' => 'Main']);
			$data['ledger2'] = $this->db->get_where('acct_categories', ['category_type' => 'Sub']);
		}		
		
			if($this->input->post())
		{
			if($this->input->post('submit') != 'payspec_accounts') die('Error! sorry');	
			
			$this->form_validation->set_rules('pay_type', 'From Sub-Accounts Type', 'required|trim'); 
			$this->form_validation->set_rules('to_pay_type', 'To Sub-Accounts Type', 'required|trim'); 
		//	$this->form_validation->set_rules('trans_type', 'Transfer Type', 'required|trim'); 			
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			$this->form_validation->set_rules('remarks', 'Transaction Remarks', 'required|trim'); 				
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->ledger_model->payspec_accounts();
			//	if($insert)
			//	{
			//		$this->session->set_flashdata('successMsg', 'Fund Transfer Between Pay Specifications Completed Successfully...!!!');
					redirect(base_url('ledger/payspec_view'));
			//	}
			}
		}
		
		
		theme('payspec_list',$data);
	}
	/**
	 * Payspecification Sub-Account list from db
	 * @return Json format
	 * usable only via API
	 */

	public function payspec_indexListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->category_model->payspec_ListCount();
		
		$query = $this->category_model->payspec_List($start, $limit);
		
					
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		if($query -> num_rows() > 0) 
{	
		foreach($query->result() as $r)
		{
			
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('ledger/payspec_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('ledger/edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
	
			$data['data'][] = array(
			    $button,
		        $pay_spec = ledgerDbTableRow($r->id)->name,	
				$pay_spec = ledgerDbTableRow($r->id)->name,	
				number_format($r->credit, 2),		
				number_format($r->amount, 2),
				//$r->first_name.' '.$r->last_name,
				$r->remarks					
				
			);
		}
		
}
		else{
			$data['data'][] = array(
				'No Pay Specification Accounts are Created' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);

	}

public function get_sub_account()
	{
		$id = $_POST['parent_id'];
		$query = $this->db->get_where('acct_categories', ['parentid' => $id]);
		$data = '<option value="">Deposit Sub-Accounts Type </option>';
		foreach($query->result() as $sub_account){
			$data.= '<option value="'.$sub_account->id.'">'.$sub_account->id.'-'.$sub_account->name.'</option>';
		}
		echo $data;
	}
	
}//last brace required