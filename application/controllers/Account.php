<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('earning_model');
		$this->load->model('ledger_model');
		$this->load->model('product_model');
		$this->load->model('Bank_model');
	
		check_auth(); //check is logged in.
	}

	/**
	 * Listing Of Account Summary for CPA
	 */

	public function index()
	{
		$data['earnings'] = $this->earning_model->totalEarning();
		$data['referralEarnings'] = $this->earning_model->referralEarnings();
		$data['withdrawal'] = $this->earning_model->withdrawal();
		
		$data['assets']  = $this->ledger_model->totalAssets();
		$data['debits']  = $this->ledger_model->totalDebits();
		$data['credits'] = $this->ledger_model->totalCredits();
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();

	//Wallet*****Loyality*****Discount*****Points
	
	//Ledger/userAccountListJson//		
	
	
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();	
		
		theme('balance_sheet', $data);
	}

	/**
	 * Listing Of Account Summary for offers
	 */

	public function balance_sheet_offers()
	{
		$data['earnings'] = $this->earning_model->totalEarning();
		$data['referralEarnings'] = $this->earning_model->referralEarnings();
		$data['withdrawal'] = $this->earning_model->withdrawal();
		
		$data['assets']  = $this->ledger_model->totalAssets();
		$data['debits']  = $this->ledger_model->totalDebits();
		$data['credits'] = $this->ledger_model->totalCredits();
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();

	//Wallet*****Loyality*****Discount*****Points///		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();	
		
		theme('balance_sheet_offers', $data);
	}
	
	
	/**
	 * User Commissions Index
	 *
	 */	
	public function transaction_commission_index()
	{
		//restricted this area, only for admin
		//permittedArea();
		$data['assets']  = $this->ledger_model->totalAssets();
		$data['debits']  = $this->ledger_model->totalDebits();
		$data['credits'] = $this->ledger_model->totalCredits();
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();
		
		
		theme('transaction_commission_index', $data);
	}	
	
	/**
	 * Service Transactions
	 *
	 */	
			public function services_transaction()
	{
		
	//Wallet*****Loyality*****Discount*****Points///		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();	
		
		
		theme('services_transaction', $data);
	}
/*Balance Sheet View */
public function balancesheet_view($id){
		//restricted this area, only for admin
	//	permittedArea();
		$data['accounts'] = singleDbTableRow($id, 'accounts');
	
		theme('balancesheet_view', $data);
	}	
/*Transactions View */
public function transactions_view($id){
		//restricted this area, only for admin
	//	permittedArea();
		$data['recharge'] = singleDbTableRow($id, 'recharge');
	
		theme('transactions_view', $data);
	}	
		
	
	/* Referrals User Commission List Json */
	public function commissionListJson(){
		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->ledger_model->referralUserCommissionListCount();		
		$query = $this->ledger_model->referralUserCommissionList($limit, $start);
	
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		IF ($query -> num_rows() > '0' )
		{
		foreach($query->result() as $r){
		
			//Action Button
			$button = '';
		//	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('ledger/referral_commissions_view/'.$r->id).'" data-toggle="tooltip" title="View">
		//				<i class="fa fa-eye"></i> </a>';			
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('ledger/edit_commissions/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
	
			$data['data'][] = array(
				date('d/m/Y h:i A', $r->created_at), //date format	
				$first_name   = singleDbTableRow($r->user_id)->first_name,
				$r->tranx_id,	
				$r->account_no,				
				$r->amount,		
				$r->points_mode,			
				$button
			);

		}
		}
		else{
			$data['data'][] = array (
			'Your Referral Candidate is not yet Started Doing Transactions...!!!' , '', '','', '','','', '');
		}

		echo json_encode($data);

	}
	
	
	/**
	 * @earningListJson from db
	 * @return Json format
	 * usable only via API
	 */

	public function earningListJson(){

		$user = loggedInUserData();
		$userID = $user['user_id'];


		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->earning_model->earningListCount();
		
			 $query = $this->earning_model->earningList($start, $limit);

	/*	//Get Decision who in online?
		if($user['role'] == 'admin')
		{
			$query = $this->db->query("select earnings.*, users.first_name as salesByFirstName, users.last_name as salesByLastName, users.role, users.id as userID from earnings
					LEFT JOIN invoice on earnings.invoice_id = invoice.id
					LEFT JOIN users on invoice.sales_by = users.id
					WHERE income_for = 'admin'
					ORDER BY earnings.id DESC Limit {$start}, {$limit}");
		}
		else{
			$query = $this->db->query("select earnings.*, users.first_name as salesByFirstName, users.last_name as salesByLastName, users.role, users.id as userID from earnings
					LEFT JOIN invoice on earnings.invoice_id = invoice.id
					LEFT JOIN users on invoice.sales_by = users.id
					WHERE user_id = {$userID}
					ORDER BY earnings.id DESC Limit {$start}, {$limit}");
		} */


		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		if($query -> num_rows() > 0) {
			foreach ($query->result() as $r) {
				$data['data'][] = array(
					'#' . $r->invoice_id,
					($r->amount != 0) ? amountFormat($r->amount) : '0.00',
					ucwords($r->income_type),
					'<a href="'.base_url('user/profile_view/'. $r->userID).'">'.ucwords($r->salesByFirstName.' '.$r->salesByLastName).'</a>',
					date('d/m/Y h:i A', $r->created_at)
				);
			}
		}
		else{
			$data['data'][] = array(
				'You have no earning' , '', '','',''
			);
		}

		echo json_encode($data);

	}




	public function earningSingleUserJson(){

		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$showFor = $this->input->get('showFor');

		$queryCount = $this->earning_model->singleUserEarningCount($showFor);

		$query  = $this->earning_model->singleUserEarning($start, $limit);

	/*	$query = $this->db->query("select earnings.* from earnings
					WHERE user_id = {$showFor}
					ORDER BY earnings.id DESC Limit {$start}, {$limit}");
	*/

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		if($query -> num_rows() > 0) {
			foreach ($query->result() as $r) {
				$data['data'][] = array(
					'#' . $r->invoice_id,
					($r->amount != 0) ? number_format($r->amount, 2) : '0.00',
					$r->income_type,
					date('d/m/Y h:i A', $r->created_at)
				);
			}
		}
		else{
			$data['data'][] = array(
				'You have no earning' , '', '',''
			);
		}

		echo json_encode($data);

	}


	/**
	 * Make Payment
	 */


	public function make_payment(){
		//restricted this area, only for admin
		//permittedArea();

		
//Customers selection existing form		
		$data['users'] = $this->db->order_by('id', 'desc')->get('users');

		if($this->input->post()) {
			if ($this->input->post('submit') != 'make_payment') die('Error! sorry');

			$payment = $this->earning_model->make_payment();
			if($payment){
				//redirect(base_url('product/invoice/'.$sellProduct));
				setFlashGoBack('successMsg', 'Payment Transferred Successfully !!!');
			}
			else{
				setFlashGoBack('errorMsg', 'Something went wrong! please try again later.');
			}

			//print_r($this->input->post());
		}

		theme('make_payment', $data);
	}

	/******************************************************************************************************************************************
	 * For Account Summary Transfer Points - Anand
	 */	
	public function ledger_details(){
		//restricted this area, only for admin
		//permittedArea();
		$data['earnings'] 		  = $this->earning_model->totalEarning();
		$data['referralEarnings'] = $this->earning_model->referralEarnings();
		$data['withdrawal'] 	  = $this->earning_model->withdrawal();


		if($this->input->post())
		{
			if($this->input->post('submit') != 'ledger_details') die('Error! sorry');

			$this->form_validation->set_rules('capital', 'Company Capital','trim');
			$this->form_validation->set_rules('liabilities', 'Company liabilities', 'trim');			
			$this->form_validation->set_rules('cash', 'Company Cash', 'trim');
			$this->form_validation->set_rules('pay_type', 'Payment Type', 'required|trim');
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->Earning_model->ledger_details();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Ledger A/C Updated Successfully...!!!');
					redirect(base_url('Account'));
				}
			}
		}
	
		theme('account_summary', $data); //calls initial screen
	}
	
	public function showListJson2(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		// Get user info from session
		$user 	= loggedInUserData();
		$showFor = $user['user_id'];
		$payeeInfo = singleDbTableRow($showFor);

		$queryCount = $this->earning_model->withdrawCount();

		//Get Decision who in online?
		if($user['role'] == 'admin')
		{
			$query = $this->db->query("select transaction.*, users.first_name as payeeFirstName, users.last_name as payeeLastName from transaction
					LEFT JOIN users ON transaction.pay_by = users.id
					WHERE transaction.pay_for = 'admin'
					ORDER BY transaction.id DESC Limit {$start}, {$limit}");
		}
		else{
			$query = $this->db->query("select transaction.*, users.first_name as payeeFirstName, users.last_name as payeeLastName, users.account_no as account_no from transaction
					LEFT JOIN users ON transaction.pay_by = users.id
					WHERE payee_id = {$showFor}
					ORDER BY transaction.id DESC Limit {$start}, {$limit}");
		}

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		if($query -> num_rows() > 0) {
			foreach ($query->result() as $r) {
				$data['data'][] = array(
					$r->account_no,
					user_full_name($payeeInfo),
					($r->amount != 0) ? number_format($r->amount, 2) : '0.00',
					$r->payeeFirstName.' '.$r->payeeLastName,
					$r->payment_method,
					
					date('d/m/Y h:i A', $r->created_at)
				);
			}
		}
		else{
			$data['data'][] = array(
				'You have no withdraw' , '', '',''
			);
		}

		echo json_encode($data2);
	}
//****Bank Account Number	
	public function showBankListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		// Get user info from session
		$user 	= loggedInUserData();
		$showFor = $user['user_id'];
		$payeeInfo = singleDbTableRow($showFor);

		$queryCount = $this->earning_model->withdrawCount();

		//Get Decision who in online?
		if($user['role'] == 'admin')
		{
			$query = $this->db->query("select transaction.*, users.first_name as payeeFirstName, users.last_name as payeeLastName from transaction
					LEFT JOIN users ON transaction.pay_by = users.id
					WHERE transaction.pay_for = 'admin'
					ORDER BY transaction.id DESC Limit {$start}, {$limit}");
		}
		else{
			$query = $this->db->query("select transaction.*, users.first_name as payeeFirstName, users.last_name as payeeLastName, users.account_no as account_no from transaction
					LEFT JOIN users ON transaction.pay_by = users.id
					WHERE payee_id = {$showFor}
					ORDER BY transaction.id DESC Limit {$start}, {$limit}");
		}

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		if($query -> num_rows() > 0) {
			foreach ($query->result() as $r) {
				$data['data'][] = array(
					$r->account_no,
					user_full_name($payeeInfo),
					($r->amount != 0) ? number_format($r->amount, 2) : '0.00',
					$r->payeeFirstName.' '.$r->payeeLastName,
					$r->payment_method,
					
					date('d/m/Y h:i A', $r->created_at)
				);
			}
		}
		else{
			$data['data'][] = array(
				'You have no withdraw' , '', '',''
			);
		}

		echo json_encode($data);
	}
	
	
	/**
	 * @param int $user_id
	 */

	public function addbank_balance($id){

		//restricted this area, only for admin
		permittedArea(['admin', 'agent']);

		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$currentUser   = singleDbTableRow($userID)->role;
		$rolename      = singleDbTableRow($userID)->rolename;
		
		//if($user['role'] == 'admin')
			if($rolename  == 11 or $rolename  == 22)
		{
			$data['users'] = $this->db->order_by('id', 'desc')->get_where('users', ['role' => 'agent']);
			$data['profile_Details'] = $this->db->query("select bank.*, count(rerreral.id) as referralCount
								from bank LEFT JOIN
								bank as rerreral on bank.referral_code = rerreral.referredByCode
								where bank.id = {$id}"); 
		}
		else
		{
			$data['users'] = $this->db->where('created_by', $userID)->order_by('id', 'desc')->get_where('users', ['role' => 'agent']);
		}


		$data['category'] = $this->db->order_by('name', 'asc')->get('categories');

		if($this->input->post()) {
			if ($this->input->post('submit') != 'addbank_balance') die('Error! sorry');

			$this->form_validation->set_rules('amount', 'Amount', 'required');	
			$this->form_validation->set_rules('account_no', 'Amount', 'trim');	
			$this->form_validation->set_rules('challan', 'Challan No', 'trim');	
			$this->form_validation->set_rules('trans_type', 'Deposit Transaction Type', 'required');	

			if($this->form_validation->run() == true)
			{
				$insert = $this->Bank_model->addbank_balance($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Transaction Completed Successfully!!!');
					redirect(base_url('bank'));
				}

			}
		}

		theme('addbank_balance', $data);

	}
/***********************************************End of Account Summary*******************************************************************************************
	
	/**
	 * @param int $user_id
	 */

	public function invoice($user_id = 0){

		//restricted this area, only for admin
		permittedArea();

		$data['earnings'] = $this->earning_model->singleTotalEarning($user_id);
		$data['referralEarnings'] = $this->earning_model->referralEarnings($user_id);
		$data['withdrawal'] = $this->earning_model->withdrawal($user_id);

		theme('single_user_invoice', $data);

	}

	/**
	 * withdrawal_payment()
	 */

	public function withdrawal_payment(){
		$data['earnings'] = $this->earning_model->totalEarning();
		$data['referralEarnings'] = $this->earning_model->referralEarnings();
		$data['withdrawal'] = $this->earning_model->withdrawal();

		theme('withdrawal_payment', $data);
	}


	public function withdrawListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		// Get user info from session
		$user 	= loggedInUserData();
		$showFor = $user['user_id'];
		$payeeInfo = singleDbTableRow($showFor);

		$queryCount = $this->earning_model->withdrawCount();

		//Get Decision who in online?
		if($user['role'] == 'admin')
		{
			$query = $this->db->query("select payment.*, users.first_name as payeeFirstName, users.last_name as payeeLastName from payment
					LEFT JOIN users ON payment.pay_by = users.id
					WHERE payment.pay_for = 'admin'
					ORDER BY payment.id DESC Limit {$start}, {$limit}");
		}
		else{
			$query = $this->db->query("select payment.*, users.first_name as payeeFirstName, users.last_name as payeeLastName from payment
					LEFT JOIN users ON payment.pay_by = users.id
					WHERE payee_id = {$showFor}
					ORDER BY payment.id DESC Limit {$start}, {$limit}");
		}

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		if($query -> num_rows() > 0) {
			foreach ($query->result() as $r) {
				$data['data'][] = array(
					user_full_name($payeeInfo),
					($r->amount != 0) ? number_format($r->amount, 2) : '0.00',
					$r->payeeFirstName.' '.$r->payeeLastName,
					$r->payment_method,
					date('d/m/Y h:i A', $r->created_at)
				);
			}
		}
		else{
			$data['data'][] = array(
				'You have no withdraw' , '', '',''
			);
		}

		echo json_encode($data);
	}



	/**
	 * Get agents sales and Commission Stats
	 * fixme Need to be complete It Search...
	 */

	public function agents_sales(){


		theme('agents_sales');

	}

	/**
	 * Return agent sales by given period
	 * Default to days income
	 * Remove number_format from amount.
	 * @agentSalesListJson()
	 */

	public function agentSalesListJson(){

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

		$queryCount = $this->db->query("select invoice.* from invoice
				WHERE DATE(FROM_UNIXTIME(invoice.created_at)) BETWEEN '{$fromDate}' and '{$toDate}'
				group by invoice.sales_by");



		$query = $this->db->query("select invoice.*, users.first_name as salesByFirstName, users.last_name as salesByLastName, users.role, users.id as userID,
 (SELECT sum(invoice.total_price) FROM invoice WHERE invoice.sales_by = users.id AND DATE(FROM_UNIXTIME(invoice.created_at)) BETWEEN '{$fromDate}' and '{$toDate}') totalSales,
 sum(earnings.amount) as totalCommission,
 sum(case earnings.income_for when 'agent' then earnings.amount else 0 END) as agentCommission,
 sum(case earnings.income_for when 'admin' then earnings.amount else 0 END) as adminCommission,
 sum(case earnings.income_for when 'user' then earnings.amount else 0 END) as userCommission,
 sum(case earnings.income_for when 'referralUser' then earnings.amount else 0 END) as referralUserCommission

	from invoice
	left join earnings on invoice.id = earnings.invoice_id
	left join users on invoice.sales_by = users.id

WHERE DATE(FROM_UNIXTIME(invoice.created_at)) BETWEEN '{$fromDate}' and '{$toDate}'
	group by invoice.sales_by
	ORDER BY invoice.created_at DESC Limit {$start}, {$limit}");


		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount->num_rows();
		$data['recordsFiltered'] = $queryCount->num_rows();

		if($query -> num_rows() > 0) {
			foreach ($query->result() as $r) {
				$data['data'][] = array(
					'<a href="'.base_url('user/profile_view/'. $r->userID).'" target="_blank">'.ucwords($r->salesByFirstName.' '.$r->salesByLastName).' </a>',
					($r->totalSales != 0) ? number_format($r->totalSales, 4) : '0.00',
					($r->totalCommission != 0) ? number_format($r->totalCommission, 4) : '0.00',
					($r->adminCommission != 0) ? number_format($r->adminCommission, 4) : '0.00',
					($r->agentCommission != 0) ? number_format($r->agentCommission, 4) : '0.00',
					($r->userCommission != 0) ? number_format($r->userCommission, 4) : '0.00',
					($r->referralUserCommission != 0) ? number_format($r->referralUserCommission, 4) : '0.00 '
				);
			}
		}
		else{
			$data['data'][] = array(
				'There have no sales' , '', '','', '','',''
			);
		}

		echo json_encode($data);
	}


	/**
	 * request_payment
	 */

	public function request_payment(){

		$user = loggedInUserData();
		$userID = $user['user_id'];

		$payment_method = $this->input->post('payment_method');
		$amount = $this->input->post('amount');

		if($this->input->post())
		{

			$this->form_validation->set_rules('amount', 'Amount', 'required');

			switch($payment_method)
			{
				case 'paypal' :
				case 'skrill' :
				case 'payoneer' :
					$this->form_validation->set_rules('payment_method_email', 'Payment Method Email', 'required');
					break;
				case 'bank':
					$this->form_validation->set_rules('currency', 'Currency', 'required');
					$this->form_validation->set_rules('account_name', 'Account Name', 'required');
					$this->form_validation->set_rules('iban', 'iBan', 'required');
					$this->form_validation->set_rules('swift', 'Swift', 'required');
					$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
					$this->form_validation->set_rules('bank_address', 'Bank Address', 'required');
					$this->form_validation->set_rules('bank_branch_name', 'Branch name', 'required');
					$this->form_validation->set_rules('bank_provenance', 'Bank State / Provenance / State', 'required');
					$this->form_validation->set_rules('bank_country', 'Bank Country', 'required');
					break;
			}

			if($this->form_validation->run() != false)
			{
				$post = $this->input->post() ;
				unset($post['submit']);
				$data = array_merge($post, ['status' => 'pending', 'request_by' => $userID, 'created_at'=> time(), 'updated_at' => time()]);

				$this->db->insert('payment_request', $data);
				create_activity('made a payment request for '. $amount);
				setFlashGoBack('successMsg', 'Payment Request Success');
			}

		}


		theme('request_payment');

	}


	public function requested_payment_list(){
		
		theme('requested_payment_list');
	}



	public function requestedPaymentListJson(){
		$limit = $this->input->get_post('length');
		$start = $this->input->get_post('start');

		// Get user info from session
		$user 	= loggedInUserData();
		$showFor = $user['user_id'];
		$payeeInfo = singleDbTableRow($showFor);

		$queryCount = $this->earning_model->withdrawCount();

		//Get Decision who in online?
		if($user['role'] == 'admin')
		{
			$query = $this->db->query("select payment_request.*, users.first_name as payeeFirstName, users.last_name as payeeLastName from payment_request
					LEFT JOIN users ON payment_request.request_by = users.id
					ORDER BY payment_request.id DESC Limit {$start}, {$limit}");
		}
		else{
			$query = $this->db->query("select payment_request.*, users.first_name as payeeFirstName, users.last_name as payeeLastName from payment_request
					LEFT JOIN users ON payment_request.request_by = users.id
					WHERE request_by = {$showFor}
					ORDER BY payment_request.id DESC Limit {$start}, {$limit}");
		}

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;

		if($query -> num_rows() > 0) {
			foreach ($query->result() as $r) {

				$details = '';
				$details .= $r->payment_method_email != ''? '<b>E-mail:</b> '. $r->payment_method_email.'<br />':'';
				$details .= $r->account_name != ''? '<b>A/C Name :</b> '. $r->account_name.'<br />':'';
				$details .= $r->iban != ''? '<b>IBAN :</b> '. $r->iban.'<br />':'';
				$details .= $r->swift != ''? '<b>Swift:</b> '. $r->swift.'<br />':'';
				$details .= $r->bank_name != ''? '<b>Bank Name:</b> '. $r->	bank_name.'<br />':'';
				$details .= $r->bank_address != ''? '<b>Bank Address:</b> '. nl2br($r->bank_address).'<br />':'';
				$details .= $r->bank_branch_name != ''? '<b>Branch Name:</b> '. $r->bank_branch_name.'<br />':'';
				$details .= $r->bank_provenance != ''? '<b>Bank State/ Provenance:</b>'. $r->bank_provenance.'<br />':'';
				$details .= $r->bank_country != ''? '<b>Bank Country:</b> '. $r->bank_country.'<br />':'';
				$details .= $r->status != ''? '<b>Status:</b> '. $r->status.'<br />':'';

				$checkedPending = $r->status == 'pending' ? 'checked':'';
				$checkedApprove = $r->status == 'approve' ? 'checked':'';
				$checkedDecline = $r->status == 'decline' ? 'checked':'';

				$action = '';
				//Get Decision who in online?
				if($user['role'] == 'admin') {
					$action .= '<form>';
					$action .= '<label><input type="radio" class="status" id="'.$r->id.'" name="status'.$r->id.'" value="pending" '.$checkedPending.' /> Pending </label> <br />
				<label><input type="radio" class="status" id="'.$r->id.'" name="status'.$r->id.'" value="approve" '.$checkedApprove.' /> Approve </label> <br />
				<label><input type="radio" class="status" id="'.$r->id.'" name="status'.$r->id.'" value="decline" '.$checkedDecline.' /> Decline </label>';
					$action .= '</form>';
				}


				$data['data'][] = array(
					'<a href="'.base_url('user/profile/'. $r->request_by).'" target="_blank">'.user_full_name($payeeInfo).'</a>',
					($r->amount != 0) ? $r->currency.' '.number_format($r->amount, 2) : '0.00',
					$r->payment_method,
					$details,
					$r->payeeFirstName.' '.$r->payeeLastName,
					$action,
					date('d/m/Y h:i A', $r->created_at)
				);
			}
		}
		else{
			$data['data'][] = array(
				'You have no requested payment' , '', '','','','',''
			);
		}

		echo json_encode($data);
	}


	public function setPaymentRequestStatus() {
		$paymentRequestID = $this->input->get_post('paymentRequestID');
		$value = $this->input->get_post('value');

		$this->db->where('id', $paymentRequestID)->update('payment_request', ['status' => $value]);
	}


	/**

	select invoice.*, users.first_name as salesByFirstName, users.last_name as salesByLastName, users.role, users.id as userID, sum(earnings.amount) as totalCommission, sum(case earnings.income_for when 'agent' then earnings.amount else 0 END) as agentCommission,
	sum(case earnings.income_for when 'admin' then earnings.amount else 0 END) as adminCommission,
	sum(case earnings.income_for when 'user' then earnings.amount else 0 END) as usertCommission,
	sum(case earnings.income_for when 'referralUser' then earnings.amount else 0 END) as referralUserCommission



	from invoice
	left join earnings on invoice.id = earnings.invoice_id
	left join users on invoice.sales_by = users.id
	group by invoice.sales_by

	select invoice.*, users.first_name as salesByFirstName, users.last_name as salesByLastName, users.role, users.id as userID, sum(earnings.amount) as totalCommission, sum(case earnings.income_for when 'agent' then earnings.amount else 0 END) as agentCommission,
	sum(case earnings.income_for when 'admin' then earnings.amount else 0 END) as adminCommission,
	sum(case earnings.income_for when 'user' then earnings.amount else 0 END) as usertCommission,
	sum(case earnings.income_for when 'referralUser' then earnings.amount else 0 END) as referralUserCommission,

	GROUP_CONCAT(DISTINCT invoice.id SEPARATOR ",") as listInvoice


	from invoice
	left join earnings on invoice.id = earnings.invoice_id
	left join users on invoice.sales_by = users.id
	group by invoice.sales_by



	 */
	/**
	 * Normal Transfer Wallet for any person
	 */

	public function transfer_wallet(){
				
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];

		if($user['role'] == 'admin')
		{
			$data['users'] = $this->db->order_by('id', 'desc')->get_where('users', ['active' => '1']);
		}
		elseif ($user['role'] == 'user')
		{
			$data['users'] = $this->db->order_by('id', 'desc')->get_where('users', ['role' => 'user']);
		}
		
		elseif ($user['role'] == 'agent')
		{
			$data['users'] = $this->db->where('created_by', $userID)->order_by('id', 'desc')->get_where('users', ['role' => 'agent']);
		}
		
		$data['client'] = $this->db->order_by('id', 'desc')->get_where('users', ['active' => '1']);
		
		$data['category'] = $this->db->where('parentid', '0')->order_by('id', 'asc')->get_where('acct_categories', ['visible' => '0']);

			$data['main_account'] = $this->db->get_where('acct_categories', ['category_type' => 'main']);
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
					//Wallet********Points///		


		if($this->input->post()) {
			if ($this->input->post('submit') != 'pay_wallet') die('Error! sorry');
			
			$this->form_validation->set_rules('price', 'Cost', 'required|trim'); 	
			

			$sellProduct = $this->product_model->pay_wallet();
			if($sellProduct){
				redirect(base_url('product/invoice/'.$sellProduct));
			}
			else{
				setFlashGoBack('errorMsg', 'Something went wrong! please try again later.');
			}

			//print_r($this->input->post());
		}
		
		theme('transfer_wallet', $data);
	}	 
	/**
	 * Get User Referrals
	 */

	public function my_referrals(){
				
		$data['assets']  = $this->ledger_model->totalAssets();
		$data['debits']  = $this->ledger_model->totalDebits();
		$data['credits'] = $this->ledger_model->totalCredits();
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();
		
		//Wallet*****Loyality*****Discount*****Points///		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();	
		
		$data['ledgerDebit']  	= $this->ledger_model->ledgerDebit();	
		$data['ledgerCredit']  	= $this->ledger_model->ledgerCredit();	
		
		theme('my_referrals', $data);
	}
	
	/**
	 * Get User Referrals
	 */

	public function referral_balance_sheet(){
		
		
		theme('referral_balance_sheet');
	}
	
/* User Commission List Json */
	public function referralListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->ledger_model->referralListCount();
		
		$query = $this->ledger_model->referralList($limit, $start);
		
				
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		IF ($query -> num_rows() > '0' )
		{
		  foreach($query->result() as $r)
			{   $activeStatus = $r->active;
				//Status Button
				switch($activeStatus)
				{
					case 0:
						$statusBtn = '<small class="label label-default"> Pending </small>';
						$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Approve User Account" value="1">
							<i class="fa fa-unlock-alt"></i> </button>';
						/*	$acct = $r->id;
							$this->login->user_approval($acct);
							*/
						break;
					case 1 :
						$statusBtn = '<small class="label label-success"> Active </small>';
						$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block User Account" value="2">
							<i class="fa fa-unlock-alt"></i> </button>';
							
						break;
					case 2 :
						$statusBtn = '<small class="label label-danger"> Blocked </small>';
						$blockUnblockBtn = '<button class="btn btn-danger blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock User Account" value="1">
							<i class="fa fa-lock"></i> </button>';
						break;
				}
			
			
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('user/profile_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
			$button .= $blockUnblockBtn;
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
	
			$data['data'][] = array(
				$button,
				$r->first_name.' '.$r->last_name,				
				$statusBtn,
				$r->email,
				$res = typeDbTableRow($r->rolename)->rolename,	
				$r->contactno,
				//$r->referral_code,	
				$result1 = strtoupper (substr($from_role	 = typeDbTableRow($r->rolename)->rolename, 0, 3)).$r->referral_code	
							
				
			);
	
			}
		
		
		
		
	}else {
			$data['data'][] = array (
			'You Have Not Referred any Friends/Relatives' , '', '','', '','','', '');
		}

		echo json_encode($data);
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
	
	
}
