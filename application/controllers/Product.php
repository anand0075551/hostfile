<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('vouchers_model');
		$this->load->model('product_model');
		$this->load->model('ledger_model');
		$this->load->model('notification_model');
		check_auth(); //check is logged in.
	}

	/**
	 * Listing all product
	 */

	public function index()
	{
		//restricted this area, only for admin
	//	permittedArea();
	// Jump to invoiceListJson

		theme('all_invoice');
	}
	

	
	//FIXME Adding product

	/**
	 * Product NEw Sell page
	 */

	public function new_product_sell(){
		//restricted this area, only for admin
		permittedArea(['admin', 'agent']);

		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];

		if($user['role'] == 'admin')
		{
			
			$data['users'] = $this->db->order_by('id', 'desc')->get_where('users', ['active' => '1']);
		}
		else
		{
			$data['users'] = $this->db->where('created_by', $userID)->order_by('id', 'desc')->get_where('users', ['role' => 'agent']);
		}


		$data['category'] = $this->db->order_by('name', 'asc')->get('categories');

		if($this->input->post()) {
			if ($this->input->post('submit') != 'add_new_sell') die('Error! sorry');

			$sellProduct = $this->product_model->sell();
			if($sellProduct){
				redirect(base_url('product/invoice/'.$sellProduct));
			}
			else{
				setFlashGoBack('errorMsg', 'Something went wrong! please try again later.');
			}

			//print_r($this->input->post());
		}

			theme('new_product_sell', $data);
	}
	
/************************************************************************************/
// * Pay wallet Approval
/************************************************************************************/

	public function pay_approval(){
		
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
			
			if($user['role'] == 'admin')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
		}
		elseif ($user['role'] == 'agent')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
		}
		
		elseif ($user['role'] == 'user')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['visible' => '2']); 
		}
					//Wallet********Points///		


		if($this->input->post())
		{
			if ($this->input->post('submit') != 'pay_approval') die('Error! sorry');
			
			$this->form_validation->set_rules('price', 'Cost', 'required|trim'); 	
			$this->form_validation->set_rules('key_id', 'Transaction Remarks', 'required|trim');
			
		
		  if($this->form_validation->run() == true)
			{
				$insert = $this->product_model->otp_transactions();
				if($insert)
				{								
					$this->session->set_flashdata('successMsg', 'Please Check OTP Password to Complete Transaction Process...!');
					redirect(base_url('product/wallet_transaction'));					
				}

			}
		}	

			theme('pay_approval', $data);
	}
	
	
	/**
	 * Add agent script
	 */

	public function wallet_transaction(){
				
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
			
			if($user['role'] == 'admin')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
		}
		elseif ($user['role'] == 'agent')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
		}
		
		elseif ($user['role'] == 'user')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['visible' => '2']); 
		}
					//Wallet********Points///		


		if($this->input->post())
		{
			if ($this->input->post('submit') != 'wallet_transaction') die('Error! sorry');
			
			$this->form_validation->set_rules('price', 'Cost', 'required|trim'); 	
			$this->form_validation->set_rules('key_id', 'Transaction Remarks', 'required|trim');
			
		
		  if($this->form_validation->run() == true)
			{
				$insert = $this->product_model->otp_transactions();
				if($insert)
				{								
					$this->session->set_flashdata('successMsg', 'Please Check OTP Password to Complete Transaction Process...!');
					redirect(base_url('product'));					
				}

			}
		}			
		theme('wallet_transaction', $data);

	}
/************************************************************************************/
// * Pay wallet to Other Partners
/************************************************************************************/

	public function pay_wallet(){
		
			
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
			
			if($user['role'] == 'admin')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
		}
		elseif ($user['role'] == 'agent')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
		}
		
		elseif ($user['role'] == 'user')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['visible' => '2']); 
		}
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

			theme('pay_wallet', $data);
	}
	/************************************************************************************/
	// * Purchase Transaction of Any Pay Specifications(Business Account)
	/************************************************************************************/

	public function add_sales(){
		//restricted this area, only for admin
	//	permittedArea();
			
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
			if ($this->input->post('submit') != 'add_sales') die('Error! sorry');
			
			$this->form_validation->set_rules('price', 'Cost', 'required|trim'); 	
			

			$sellProduct = $this->product_model->add_sales();
			if($sellProduct){
				redirect(base_url('product/invoice/'.$sellProduct));
			}
			else{
				setFlashGoBack('errorMsg', 'Something went wrong! please try again later.');
			}

			//print_r($this->input->post());
		}

			theme('sales', $data);
	}
	/**
	 * Get validate customer ID
	 */

	public function validateCustomerCodeApi(){
		$customerID = $this->input->post('customerID');
		$query = $this->db->get_where('users', ['id' => $customerID]);
	
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $r);
		
		
			$data['status'] 		= 'true';
			$data['customerName']	= $r->first_name.' '.$r->last_name;
		//	$data['customerAddress']	= nl2br($r->street_address);
			$data['customerAddress']	= 'Client Role : '.typeDbTableRow($r->rolename)->rolename;
			$data['customerAddress']	.= '<br />SMS No : '.$r->contactno ;
			$data['customerAddress']	.= ($r->passport_no = '') ?
										'<br /> Passport No : '. $r->passport_no :										
										'<br /> Account No : '. $r->account_no;
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
	 * Get validate Transaction from Account
	 */

	public function validatePaymentCodeApi(){
		$customerID = $this->input->post('customerID');
		$query = $this->db->get_where('users', ['id' => $customerID]);
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $r);
			$data['status'] 		= 'true';
			$data['customerName']	= $r->first_name.' '.$r->last_name;
			$data['customerAddress']	= nl2br($r->street_address);
			$data['customerAddress']	.= '<br />Contact No : '.$r->contactno ;
			$data['customerAddress']	.= ($r->passport_no = '') ?
										'<br /> Passport No : '. $r->passport_no :
										//'<br /> MyFair Account No : '. $r->national_id;
										'<br /> MyFair Account No : '. $r->account_no;
										'<br /> Adhaar Card No : '. $r->national_id;
										
		}
		else{
			$data['status'] 			= 'false';
			$data['customerName']		= '';
			$data['customerAddress']	= '';
		}

		echo json_encode($data);
	}

	/**
	 * All invoice
	 * @invoice list
	 */

	public function all_invoice(){
		//theme('all_invoice');
	}




	/**
	 * @invoiceListJson from db
	 * @return Json format
	 * usable only via API
	 */

	public function invoiceListJson(){

		$user = loggedInUserData();
		$userID = $user['user_id'];


		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$search = $this->input->get('search');
		$searchValue = $search['value'];

		$searchByID = '';


		$queryCount = $this->product_model->invoiceListCount();

		$query = $this->product_model->invoiceList($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;


		if($query -> num_rows() > 0) {
			foreach ($query->result() as $r) {

				//Action Button
				$button = '';
				$button .= '<a class="btn btn-info editBtn"  href="' . base_url('product/invoice/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>
						 <a href="'.base_url('product/pdf_invoice/'.$r->id).'" class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> </a>
						';

				$data['data'][] = array(
				    $button,
					$r->id,
					$r->userFirstName . ' ' . $r->userLastName,
				//	$r->total_product,
				//	$r->total_price,
					$r->agentFirstName . ' ' . $r->agentLastName,
					date('d/m/Y h:i A', $r->created_at)
					
				);
			}
		}
		else{
			$data['data'][] = array(
				'Your Invoice are Not Yet Generated' , '', '', '', '', '', ''
			);
		}

		echo json_encode($data);

	}

	/**
	 * @param int $id
	 */

	//Todo Need to be check why setFlashGoBack() not work message.

	public function invoice($id = 0){
		if($id == 0) setFlashGoBack('successMsg', 'Insufficient parameter');

		$data['invoiceQuery'] = $this->product_model->getInvoiceDetails($id);
		$data['invoiceItem'] = $this->product_model->getAllItemByInvoice($id);

		theme('invoice', $data);
	}

	/**
	 * @param int $id
	 *
	 * Make invoice pdf
	 */


	public function pdf_invoice($id = 0){
		if($id == 0) setFlashGoBack('successMsg', 'Insufficient parameter');

		$data['invoiceQuery'] = $this->product_model->getInvoiceDetails($id);
		$data['invoiceItem'] = $this->product_model->getAllItemByInvoice($id);

		$this->load->library('pdf');
		$this->pdf->load_view('pdf_invoice', $data);
		$this->pdf->render();
		$this->pdf->stream("invoice-id-".$id."-at-".date('d-m-Y-h:i').".pdf");

	}



	
	
/**
* Recharge Mobile and Jolo-API
*
*/

	public function recharge_mobile(){
		//restricted this area, only for admin
	//	permittedArea();
		$data['wallet']  	 	= $this->ledger_model->totalWallet();
		$data['usedwallet']  	= $this->ledger_model->usedWallet();		
		$data['convertWallet']  = $this->ledger_model->convertWallet();
		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();		
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'recharge_mobile') die('Error! sorry');
			
			$this->form_validation->set_rules('recharge_type', 'Recharge Type', 'required|trim');
			$this->form_validation->set_rules('recharge_no', '10 digit Recharge Number', 'required|trim');
			$this->form_validation->set_rules('amount', 'Recharge Amount', 'required|trim');
		

			if($this->form_validation->run() == true)
			{
				$insert = $this->product_model->recharge_mobile();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Recharge Successfull...!!!');
					redirect(base_url('account'));
				}
			}
		}
		theme('recharge_mobile', $data);
	}			
/**
* Services- Prepaid
*
*/

	public function services_prepaid(){
		//restricted this area, only for admin
	//	permittedArea();
		$data['wallet']  	 	= $this->ledger_model->totalWallet();
		$data['usedwallet']  	= $this->ledger_model->usedWallet();		
		$data['convertWallet']  = $this->ledger_model->convertWallet();
		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();		
		
		$data['client'] = $this->db->order_by('id', 'asc')->get_where('services', ['service_type' => 'Prepaid Mobile']);
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'services_prepaid') die('Error! sorry');
			
			$this->form_validation->set_rules('recharge_type', 'Recharge Type', 'required|trim');
			$this->form_validation->set_rules('recharge_no', '10 digit Recharge Number', 'required|trim');
			$this->form_validation->set_rules('amount', 'Recharge Amount', 'required|trim');
		

			if($this->form_validation->run() == true)
			{
				$insert = $this->product_model->services_prepaid();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Recharge Successfull...!!!');
					redirect(base_url('account/services_transaction'));
				}
			}
		}
		theme('services_prepaid', $data);
	}
	
	//Booking Bus Functionality
public function booking_bus(){
		//restricted this area, only for admin
	//	permittedArea();
		$data['wallet']  	 	= $this->ledger_model->totalWallet();
		$data['usedwallet']  	= $this->ledger_model->usedWallet();		
		$data['convertWallet']  = $this->ledger_model->convertWallet();
		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();		
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'recharge_mobile') die('Error! sorry');
			
			$this->form_validation->set_rules('recharge_type', 'Recharge Type', 'required|trim');
			$this->form_validation->set_rules('recharge_no', '10 digit Recharge Number', 'required|trim');
			$this->form_validation->set_rules('amount', 'Recharge Amount', 'required|trim');
		

			if($this->form_validation->run() == true)
			{
				$insert = $this->product_model->recharge_mobile();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Recharge Successfull...!!!');
					redirect(base_url('account'));
				}
			}
		}
		theme('booking_bus', $data);
	}	
	
	/**
	 * Verify Consumer For Transfer Wallet Payment
	 */

	public function verify_payee(){
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
		
		//$data['rolename'] = $this->db->get_where('role', ['type' => 'role_name']); 	
		$where_array = array ('type' => 'role_name', 'permission_id' => '1');
		$data['rolename'] = $this->db->where($where_array)->get('role');
		
		$input_referralid = $this->input->post('referredByCode');
		
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
			
			if($user['role'] == 'admin')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
		}
		elseif ($user['role'] == 'agent')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
		}
		
		elseif ($user['role'] == 'user')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['visible' => '2']); 
		}
	
		if($this->input->post())
		{
			if($this->input->post('submit') != 'verify_payee') die('Error! sorry');

			
			$this->form_validation->set_rules('referredByCode', 'Payee ID', 'required|trim');
		//	$this->form_validation->set_rules('key_id', 'Key Code', 'required|trim');
		//	$this->form_validation->set_rules('pay_type', 'Business Category', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			$this->form_validation->set_rules('tranx_id', 'Transaction Remarks', 'required|trim');
			
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->product_model->otp_transactions();
				if($insert)
				{								
					$this->session->set_flashdata('successMsg', 'Please Check OTP Password to Complete Referral Process...!');
					redirect(base_url('product/payee_payments/'));					
				}

			}
		}

		theme('verify_payee', $data);
	
}

/**
	 * Verify Consumer For Transfer Wallet Payment
	 */

	public function recieve_verify_payee(){
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
		
		//$data['rolename'] = $this->db->get_where('role', ['type' => 'role_name']); 	
		$where_array = array ('type' => 'role_name', 'permission_id' => '1');
		$data['rolename'] = $this->db->where($where_array)->get('role');
		
		$input_referralid = $this->input->post('referredByCode');
		
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
			
			if($user['role'] == 'admin')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
		}
		elseif ($user['role'] == 'agent')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['visible' => '1']);
		}
		
		elseif ($user['role'] == 'user')
		{
			$data['sub_account']  = $this->db->get_where('acct_categories', ['visible' => '2']); 
		}
	
		if($this->input->post())
		{
			//if($this->input->post('submit') != 'verify_payee') die('Error! sorry');
			
			if($this->input->post('submit') != 'receive_verify_payee') die('Error! sorry');
			$this->form_validation->set_rules('referredByCode', 'Payee ID', 'required|trim');
		//	$this->form_validation->set_rules('key_id', 'Key Code', 'required|trim');
		//	$this->form_validation->set_rules('pay_type', 'Business Category', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			$this->form_validation->set_rules('tranx_id', 'Transaction Remarks', 'required|trim');
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->product_model->otp_transactions();
				if($insert)
				{								
					$this->session->set_flashdata('successMsg', 'Please Check OTP Password to Complete Referral Process...!');
					redirect(base_url('product/payee_payments/'));					
				}

			}
		}

		theme('recieve_verify_payee', $data);
	
}
/************************************

Proceeding for Payment Transfer/Receive
	 * Add agent script
	 */

	public function add_payee($id){
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
													
														if ($this->input->post('submit1') == 'add_agent1'); // die('Error! sorry');
														{
															
															$this->form_validation->set_rules('otp', 'SMS OTP password ', 'required');

															if($this->form_validation->run() == true)
															{
																$sellProduct = $this->product_model->payee_transfer($id);
																if($sellProduct){
																//redirect(base_url('product/invoice/'.$sellProduct));
																		redirect(base_url('product/'));
																}
																else{
																	setFlashGoBack('errorMsg', 'Something went wrong! please try again later.');
																}
														
															}
														}
													}	
																									
									
		theme('add_payee', $data);

	}
	
	public function otp_tran()
	{
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		$user_contactno       = singleDbTableRow($userID)->contactno;
		$user_first_name      = singleDbTableRow($userID)->first_name;
		$user_referral_code   = singleDbTableRow($userID)->referral_code;

		$data['users'] = singleDbTableRow($id, 'otp_transactions');
		
		$id = $_GET['id'];
		$table_name = "otp_transactions";			
		$where_array = array('id' => $id);
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{		  
																	
					$key_id	 	=  $r->key_id;
					$pay_to	  	=  $r->pay_to;
					$otp	  	=  $r->otp;
					$pay_type	=  $r->pay_type;
					if($pay_type == '66')
					{
					$mobile   =  $r->from_cell;
					}else{																		
					$mobile   =  $r->to_cell;
					}
					$fname	  =  $r->fname;
					$amount	  =  $r->amount;
		$transaction_type	  =  $r->transaction_type;
					
				//	$insert = $this->product_model->sms_pay_wallet($key_id, $otp, $mobile, $fname );
					$insert = $this->notification_model->sms_recieve_wallet($key_id, $otp, $mobile, $fname, $pay_to, $amount, $transaction_type);
					$this->session->set_flashdata('successMsg', 'Please Check OTP Password sent OTP SMS Number to Complete Transaction!');
	
			}
		}
		
		theme('add_payee', $data);
	}

public function payee_payments()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('payee_payments');
	}

	
/**
	 * referral_paymentListJson list from db
	 * @return Json format
	 * usable only via API
	 */

	public function payee_paymentListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->product_model->payee_PaymentListCount();
		$query = $this->product_model->payee_PaymentList($limit, $start);

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
			
			if ($r->transaction_type == 'Recieve')
			{
				$type = 'Receiving Values';
			}else{
				$type = 'Transferring Values';
			}
			
			if ($r->pay_type == '66')
			{
				$sms_no = $r->from_cell;
			}else{
				$sms_no = $r->to_cell;
			}

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('product/add_payee/'. $r->id).'" data-toggle="tooltip" title="View"> Proceed for Payment
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= $blockUnblockBtn;
		
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				$button,
				$r->fname,
				$sms_no, //$r->to_cell,
				number_format($r->amount, 2) ,
				$type,
			//	$from_role = typeDbTableRow($r->id)->rolename,
						
				$statusBtn,			
			//$result1 = strtoupper (substr($from_role	 = typeDbTableRow($r->rolename)->rolename, 0, 3)).$r->referral_code	,	
			//	$result2 = strtoupper (substr($from_role	 = typeDbTableRow($r->rolename)->rolename, 0, 3)).$r->referredByCode	
				
			);
		}
}
		else{
			$data['data'][] = array(
				'Payee Value Transfer Lists are not Available to Process' , '', '','', '','',''
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
		create_activity("Deleted {$id} from OTP Transactions");
		//Now delete permanently
		$this->db->where('id', $id)->delete('otp_transactions');
		return true;
	}
	
	
	public function completed_payments()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('completed_payments');
	}

	
/**
	 * referral_paymentListJson list from db
	 * @return Json format
	 * usable only via API
	 */

	public function payment_completedListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->product_model->completed_PaymentListCount();
		$query = $this->product_model->completed_PaymentList($limit, $start);

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
					$statusBtn = '<small class="label label-success"> Completed </small>';
					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="2">
						<i class="fa fa-lock"></i> </button>';
					break;
				case 2 :
					$statusBtn = '<small class="label label-danger"> Blocked </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
			}
			
			if ($r->transaction_type == 'Recieve')
			{
				$type = 'Receiving Values';
			}else{
				$type = 'Transferring Values';
			}

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('product/add_payee/'. $r->id).'" data-toggle="tooltip" title="View"> Proceed for Payment
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= $blockUnblockBtn;
		
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				
				$r->fname,
				$r->to_cell,
				number_format($r->amount, 2) ,
				$type,
			//	$from_role = typeDbTableRow($r->id)->rolename,
						
				$statusBtn,			
			//$result1 = strtoupper (substr($from_role	 = typeDbTableRow($r->rolename)->rolename, 0, 3)).$r->referral_code	,	
			//	$result2 = strtoupper (substr($from_role	 = typeDbTableRow($r->rolename)->rolename, 0, 3)).$r->referredByCode	
				
			);
		}
}
		else{
			$data['data'][] = array(
				'No Transactions ' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);
	}

public function uniqueReferralCodeApi2(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code = singleDbTableRow($user_user_id)->referral_code;	
		
		$referredByCode = $this->input->post('referredByCode');
		
	if ($referredByCode != $user_referral_code )	
	{
		
                $query = $this->db->get_where('users', ['referral_code' => $referredByCode, 'active' => '1']);
		if($query->num_rows() > 0 )
		{
			
			$return = 'true';
			
		}else{
			$return = 'false';
		}
	}
		echo $return;
		//$return = 'false';
	}
	
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
			$role = $row->rolename;
			$get_role = $this->db->get_where('role', ['id'=>$role]);
			
			foreach($get_role->result() as $rn)
			{
				$rolename = $rn->rolename;
			}
			$user .="<td>".$row->first_name." ".$row->last_name."</td><td>".$row->email."</td><td>".$rolename."</td>";
		}
		$user .="</tbody></table>";
		echo $user;
	}
	
}//last brace required
?>