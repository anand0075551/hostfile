<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher_redeem extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('vouchers_model');
		$this->load->model('product_model');
		$this->load->model('voucher_redeem_model');
		$this->load->model('ledger_model');
		$this->load->model('notification_model');
		$this->load->model('payment_model');
		check_auth(); //check is logged in.
	}

	/**
	 * Listing all product
	 */
	
	public function uniqueReferralCodeApi(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code = singleDbTableRow($user_user_id)->referral_code;	
		
		$referredByCode = $this->input->post('referredByCode');
		
		if ($referredByCode != $user_referral_code )	
		{
			$query = $this->db->get_where('users', ['referral_code' => $referredByCode,  'active' => '1']);
			if($query->num_rows() > 0 )
			{
				$return = 'true';
			}else{
				$return = 'false';
			}
		}
		echo $return;
	}
	
	public function index()
	{
		//restricted this area, only for admin
	//	permittedArea();
	// Jump to invoiceListJson

		theme('voucher_redeem_invoice');
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


		$queryCount = $this->voucher_redeem_model->invoiceListCount();

		$query = $this->voucher_redeem_model->invoiceList($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;


		if($query -> num_rows() > 0) {
			foreach ($query->result() as $r) {

				//Action Button
				$button = '';
				$button .= '<a class="btn btn-info editBtn"  href="' . base_url('voucher_redeem/invoice/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>
						 <a href="'.base_url('voucher_redeem/pdf_invoice/'.$r->id).'" class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> </a>
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

		$data['invoiceQuery'] = $this->voucher_redeem_model->getInvoiceDetails($id);
		$data['invoiceItem'] = $this->voucher_redeem_model->getAllItemByInvoice($id);

		theme('voucher_invoice', $data);
	}

	/**
	 * @param int $id
	 *
	 * Make invoice pdf
	 */


	public function pdf_invoice($id = 0){
		if($id == 0) setFlashGoBack('successMsg', 'Insufficient parameter');

		$data['invoiceQuery'] = $this->voucher_redeem_model->getInvoiceDetails($id);
		$data['invoiceItem'] = $this->voucher_redeem_model->getAllItemByInvoice($id);

		$this->load->library('pdf');
		$this->pdf->load_view('voucher_pdf_invoice', $data);
		$this->pdf->render();
		$this->pdf->stream("invoice-id-".$id."-at-".date('d-m-Y-h:i').".pdf");

	}



	
	
	/* Voucher_redeem statrst here */
	
	
	public function recieve_values()
	{
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
			if($this->input->post('submit') != 'receive_values') die('Error! sorry');
			
			
			$this->form_validation->set_rules('referredByCode', 'Consumer Code', 'required|trim');
			$this->form_validation->set_rules('voucher_type', 'voucher_type Code', 'required|trim');
			
			if($this->form_validation->run() == true)
			{
				$user_info = $this->session->userdata('logged_user');
				$user_id = $user_info['user_id'];
				$receiver_referral_code   = singleDbTableRow($user_id)->referral_code;
				
				$vouchers = $this->input->post('tranx_id');
				$vouchers .= "<br>Coupons Used : ";
				$voucher_id = $this->input->post('all_vouchers');
				$test = explode(',' , $voucher_id);
				foreach($test as $test2)
				{
					$vouchers .= $test2.", ";
				}
				
				
				$voucher_type = $this->input->post('voucher_type');
				if($voucher_type == "Food Coupon"){
					$pay_by_referral_code 	= 	'5559990001';
					$pay_to_referral_code 	= 	$receiver_referral_code;
					$amount_to_pay		  	=	$this->input->post('total_amount');		
					$pay_spec_type			=	'96';				
					$transaction_remarks	=	$vouchers;	
					$pm_mode				=	"wallet";
				}
				else{
					$pay_by_referral_code 	= 	'5559990001';	
					$pay_to_referral_code 	= 	$receiver_referral_code;
					$amount_to_pay		  	=	$this->input->post('total_amount');		
					$pay_spec_type			=	'66';				
					$transaction_remarks	=	$vouchers;	
					$pm_mode				=	"wallet";
				}
				
				$make_my_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);
				
				$insert = $this->voucher_redeem_model->vouchers_transactions();
				if($insert && $make_my_payment)
				{
					$this->session->set_flashdata('successMsg', 'Redeem Completed Successfully...!');
					redirect(base_url('voucher_redeem/'));
				}
				else{
					$this->session->set_flashdata('successMsg', 'Sorry.. Some Error Occured...!');
					redirect(base_url('voucher_redeem/recieve_values'));
				}	
			}
		}
		
		
		
		theme('voucher_redeem',$data);
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
	
	
	public function get_voucher(){
		$user_id = $_POST['user_id'];
		$voucher_type = $_POST['voucher_type'];
		
		$today_date = date("Y-m-d");
		
		$voucher = "<option value=''>Select Voucher</option>";
		
		$condition = " voucher_name = '".$voucher_type."' AND user_id = '".$user_id."' AND used = 'no' AND reserved='' AND reserved_at = 0 AND start_date <= '".$today_date."' ";
		
		$data = $this->db->order_by('id', 'desc')->where($condition)->get('vouchers');
		
		foreach($data->result() as $row1)
		{
			$desc = $row1->voucher_description; 
			if($desc == ""){
				$voc_desc = "";
			}
			else{
				$voc_desc = "(".$row1->voucher_description.")";
			}
			$voucher .=  "<option value='".$row1->voucher_id."'>".$row1->voucher_id." ".$voc_desc."</option>";      
		}
		echo $voucher;
	  
	}
	
	
	public function get_voucher_amount(){
		
		$v_id = $_POST['v_id'];
		//echo $v_id;
		$data = $this->db->get_where('vouchers', ['voucher_id'=>$v_id]);
		foreach($data->result() as $row1)
		{
			$v_amount = $row1->amount;
		}
		echo $v_amount;
	}
	
	public function make_payment()
	{
		if($this->input->post())
		{
			if($this->input->post('submit') != 'pay') die('Error! sorry');

			$this->form_validation->set_rules('payee_consumer_id', 'Payee Consumer ID', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->voucher_redeem_model->make_voucher_payment();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Payment Completed Successfully..!');
					redirect(base_url('voucher_redeem/make_payment'));
				}
			}
		}
		
		theme('pay_with_voucher');
	}
	
	public function user_payments_list()
	{
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->voucher_redeem_model->user_payments_list_count();

		
		$query = $this->voucher_redeem_model->user_payments_list($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
		  {
			foreach($query->result() as $r){
					
				if(singleDbTableRow($r->paid_to)->company_name != ""){
					$paid_to = singleDbTableRow($r->paid_to)->company_name;
				}
				else{
					$paid_to = singleDbTableRow($r->paid_to)->first_name." ".singleDbTableRow($r->paid_to)->last_name;
				}
				
				if($r->used == "no"){
					$status = '<small class="label label-danger"> Not Accepted </small>';
				}
				else{
					$status = '<small class="label label-success"> Accepted </small>';
				}
				
				$voucher_id = "";
				$test = explode(',' , $r->voucher_id);
				foreach($test as $test2)
				{
					$voucher_id .= $test2." | ";
				}
				
				if($r->modified_by != ""){
					if($r->modified_by == $r->paid_by){
						$order_status = "Cancled By Consumer";
					}
					elseif($r->modified_by == $r->paid_to && $r->used == 'yes'){
						$order_status = "Completed";
					}
					elseif($r->modified_by == $r->paid_to){
						$order_status = "Rejected By Restro-Vendor";
					}
				}
				else{
					$order_status = "Pending";
				}
				
				//Action Button
				$button = '';
				$button .= '<a class="btn btn-primary btn-sm" href="'.base_url('voucher_redeem/voucher_payment_details/'. $r->id).'" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a>';
				
				if($r->used == "no"){
					$button .= '<a class="btn btn-warning editBtn btn-sm" href="'.base_url('voucher_redeem/generate_token/'. $r->id).'" data-toggle="modal" data-target="#token_box" title="Token"><i class="fa fa-gift"></i> Token </a>';
					if($r->modified_by != ""){
						if($r->modified_by == $r->paid_by){
							$button .= '<a class="btn btn-danger disabled editBtn btn-sm" href="#" title="Cancled"><i class="fa fa-cutlery"></i> Cancled </a>';
						}
						elseif($r->modified_by == $r->paid_to){
							$button .= '<a class="btn btn-danger disabled editBtn btn-sm" href="#" title="Rejected"><i class="fa fa-cutlery"></i> Rejected </a>';
						}
					}
					else{
						$button .= '<a class="btn btn-danger editBtn btn-sm" href="'.base_url('voucher_redeem/cancle_order/'. $r->id).'" title="Cancle"><i class="fa fa-cutlery"></i> Cancle </a>';
					}
					
				}
				else{
					$button .= '<a class="btn btn-success editBtn btn-sm" href="'.base_url('voucher_redeem/generate_token/'. $r->id).'" data-toggle="modal" data-target="#token_box" title="Token"><i class="fa fa-gift"></i> Token </a>';
				}
				$data['data'][] = array(
					$button,
					date('d-M, Y', $r->created_at),					
					$r->token_no,					
				//	$voucher_id,					
					$r->voucher_description,					
					$r->amount,					
					$paid_to,
					$order_status,
					$status					
				);
					
			}
		}
		else{
		   $data['data'][]=array(
			 'You have no Data' ,'','','','','','','',''
			);
		}
		echo json_encode($data);
	}
	
	public function get_payee(){
		$ref_id = $_POST['ref_id'];
		//echo $ref_id;
		$data = $this->db->get_where('users', ['referral_code'=>$ref_id]);
		
		if($data->num_rows() > 0){
			foreach($data->result() as $row1)
			{
			$user = "<input type='hidden' name='user_id' id='user_id' value='".$row1->id."'>" ;
			}
			
			
			$user .= "<table class='table table-bordered'>";
			$user .= "<tbody>";
			
			foreach($data->result() as $row)
			{	if($row->company_name != ""){
					$user .="<tr><th>Payee Name</th><td>".$row->company_name."</td></tr>";
				}
				else{
					$user .="<tr><th>Payee Name</th><td>".$row->first_name." ".$row->last_name."</td></tr>";
				}
				$user .="<tr><th>Payee Email</th><td>".$row->email."</td></tr>";
			}
			$user .="</tbody></table>";
		}
		else{
			$user = "<font color='red'>Sorry ! User Doesn't Exit.</font>";
		}
		
		echo $user;
	}
	
	public function get_vouchers()
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$voc_type = $_POST['voc_type'];
		echo "<option value=''>Choose Vouchers</option>";
		$today_date = date("Y-m-d");
		$condition = " voucher_description = '".$voc_type."' AND user_id = '".$user_id."' AND used = 'no' AND reserved='' AND reserved_at = 0 AND start_date <= '".$today_date."' ";
		$get_vouchers = $this->db->where($condition)->get('vouchers');
		if($get_vouchers->num_rows() > 0){
			foreach($get_vouchers->result() as $voc){
				echo "<option value='".$voc->voucher_id."'>".$voc->voucher_id."</option>";
			}
		}
	}
	
	
	public function generate_token($id){
		if($this->input->post('submit') == 'transfer') {

				$this->form_validation->set_rules('to_user', 'Transfer To', 'required|trim');

				if($this->form_validation->run() == true)
				{
					$insert = $this->vouchers_model->transfer_voucher();	
					if($insert)
					{
						$this->session->set_flashdata('successMsg', 'Voucher Transfered Successfuly..!');
						redirect(base_url('vouchers/transferred_vouchers'));
					}	
				}
			}
		$data['voucher'] = $this->db->get_where('vouchers', ['id'=>$id]);
		theme('voucher_token', $data);
	}
	
	public function accept_voucher_payment()
	{
		theme('accept_voucher_payment');
	}
	
	public function vendor_receive_payments_list()
	{
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->voucher_redeem_model->vendor_receive_payments_list_count();

		
		$query = $this->voucher_redeem_model->vendor_receive_payments_list($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
		  {
			foreach($query->result() as $r){
					
				
				$paid_by = singleDbTableRow($r->paid_by)->first_name." ".singleDbTableRow($r->paid_by)->last_name;
				
				
				
				
				$voucher_id = "";
				$test = explode(',' , $r->voucher_id);
				foreach($test as $test2)
				{
					$voucher_id .= $test2." | ";
				}
				
				if($r->modified_by != ""){
					if($r->modified_by == $r->paid_by){
						$order_status = "Cancled By Consumer";
					}
					elseif($r->modified_by == $r->paid_to && $r->used == 'yes'){
						$order_status = "Completed";
					}
					elseif($r->modified_by == $r->paid_to){
						$order_status = "Rejected By Restro-Vendor";
					}
				}
				else{
					$order_status = "Pending";
				}
				
				if($r->service_type != ""){
					$service_type = $r->service_type;
				}
				else{
					$service_type = "Not Mentioned";
				}
				
				if($r->table_no != 0){
					$table_no = $r->table_no;
				}
				else{
					$table_no = "";
				}
				
				//Action Button
				$button = '';
				$button .= '<a class="btn btn-primary btn-sm" href="'.base_url('voucher_redeem/voucher_payment_details/'. $r->id).'" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a>';
				
				
				
				if($r->used == "no"){
					$status = '<small class="label label-danger"> Not Accepted </small>';
					
					if($r->modified_by != ""){
						if($r->modified_by == $r->paid_by){
							$button .= ' <a class="btn btn-warning editBtn btn-sm" href="'.base_url('voucher_redeem/generate_token/'. $r->id).'" data-toggle="modal" data-target="#token_box" title="Token"><i class="fa fa-gift"></i> Token </a>';
							
							$button .= '<a class="btn btn-danger disabled editBtn btn-sm" href="#" title="Cancle"><i class="fa fa-cutlery"></i> Cancled </a>';
						}
						elseif($r->modified_by == $r->paid_to){
							$button .= ' <a class="btn btn-warning editBtn btn-sm" href="'.base_url('voucher_redeem/generate_token/'. $r->id).'" data-toggle="modal" data-target="#token_box" title="Token"><i class="fa fa-gift"></i> Token </a>';

							$button .= '<a class="btn btn-danger disabled editBtn btn-sm" href="#" title="Cancle"><i class="fa fa-cutlery"></i> Rejected </a>';
						}
					}
					else{
						$button .= '<a class="btn btn-warning editBtn btn-sm" href="'.base_url('voucher_redeem/generate_token/'. $r->id).'" data-toggle="modal" data-target="#token_box" title="Accept"><i class="fa fa-money"></i> Accept </a>';
						
						$button .= '<a class="btn btn-danger editBtn btn-sm" href="'.base_url('voucher_redeem/reject_order/'. $r->id).'" title="Reject"><i class="fa fa-cutlery"></i> Reject </a>';
					}
					
					
				}
				else{
					$status = '<small class="label label-success"> Accepted </small>';
					$button .= ' <a class="btn btn-success editBtn btn-sm" href="'.base_url('voucher_redeem/generate_token/'. $r->id).'" data-toggle="modal" data-target="#token_box" title="Token"><i class="fa fa-gift"></i> Token </a>';
				}
				
				
					
				$data['data'][] = array(
					$button,
					date('d-M, Y', $r->created_at),					
					$r->token_no,					
				//	$voucher_id,					
					$r->voucher_description,					
					$r->amount,					
					$paid_by,
					$service_type,
					$table_no,
					$order_status,
					$status				
				);
					
			}
		}
		else{
		   $data['data'][]=array(
			 'You have no Data' ,'','','','','','','','',''
			);
		}
		echo json_encode($data);
	}
	
	public function accept_payment($id){
		$insert = $this->voucher_redeem_model->accept_payment($id);	
		if($insert)
		{
			$this->session->set_flashdata('successMsg', 'Payment Accepted Successfuly..!');
			redirect(base_url('voucher_redeem/accept_voucher_payment'));
		}
		else{
			$this->session->set_flashdata('errorMsg', 'Some Error Occured..!');
			redirect(base_url('voucher_redeem/accept_voucher_payment'));
		}
	}
	
	public function cancle_order($id){
		$insert = $this->voucher_redeem_model->cancle_order($id);	
		if($insert)
		{
			$this->session->set_flashdata('successMsg', 'Order Cancled Successfuly..!');
			redirect(base_url('voucher_redeem/make_payment'));
		}
		else{
			$this->session->set_flashdata('errorMsg', 'Some Error Occured..!');
			redirect(base_url('voucher_redeem/make_payment'));
		}
	}
	
	public function reject_order($id){
		$insert = $this->voucher_redeem_model->cancle_order($id);	
		if($insert)
		{
			$this->session->set_flashdata('successMsg', 'Order Rejecter Successfuly..!');
			redirect(base_url('voucher_redeem/accept_voucher_payment'));
		}
		else{
			$this->session->set_flashdata('errorMsg', 'Some Error Occured..!');
			redirect(base_url('voucher_redeem/accept_voucher_payment'));
		}
	}
	
	public function reset_token(){
		
		$reset = $this->voucher_redeem_model->reset_token();
		if($reset)
		{
			$this->session->set_flashdata('successMsg', 'Token Reset Done Successfuly..!');
			redirect(base_url('voucher_redeem/accept_voucher_payment'));
		}
		else{
			$this->session->set_flashdata('errorMsg', 'Some Error Occured..!');
			redirect(base_url('voucher_redeem/accept_voucher_payment'));
		}
	}
	
	public function token_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		
		$consumer    = $_POST['consumer'];
		$token_no    = $_POST['token_no'];
		$from_date   = $_POST['from_date'];
		$to_date     = $_POST['to_date'];
		$on_date     = $_POST['on_date'];
		
		$limit       = $this->input->POST('length');
		$start       = $this->input->POST('start');


		$queryCount = $this->voucher_redeem_model->search_token_ListCount($consumer, $token_no, $from_date, $to_date, $on_date);
		$query = $this->voucher_redeem_model->search_token_List($limit, $start, $consumer, $token_no, $from_date, $to_date, $on_date);
		
		$draw = $this->input->POST('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		
				
	if($query -> num_rows() > 0) 
		  {
			foreach($query->result() as $r){
					
				
				$paid_by = singleDbTableRow($r->paid_by)->first_name." ".singleDbTableRow($r->paid_by)->last_name;
				
				
				
				
				$voucher_id = "";
				$test = explode(',' , $r->voucher_id);
				foreach($test as $test2)
				{
					$voucher_id .= $test2." | ";
				}
				
				if($r->modified_by != ""){
					if($r->modified_by == $r->paid_by){
						$order_status = "Cancled By Consumer";
					}
					elseif($r->modified_by == $r->paid_to && $r->used == 'yes'){
						$order_status = "Completed";
					}
					elseif($r->modified_by == $r->paid_to){
						$order_status = "Rejected By Restro-Vendor";
					}
				}
				else{
					$order_status = "Pending";
				}
				
				if($r->service_type != ""){
					$service_type = $r->service_type;
				}
				else{
					$service_type = "Not Mentioned";
				}
				
				if($r->table_no != 0){
					$table_no = $r->table_no;
				}
				else{
					$table_no = "";
				}
				
				
				//Action Button
				$button = '';
				$button .= '<a class="btn btn-primary btn-sm" href="'.base_url('voucher_redeem/voucher_payment_details/'. $r->id).'" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a>';
				
				
				
				if($r->used == "no"){
					$status = '<small class="label label-danger"> Not Accepted </small>';
					
					if($r->modified_by != ""){
						if($r->modified_by == $r->paid_by){
							$button .= ' <a class="btn btn-warning editBtn btn-sm" href="'.base_url('voucher_redeem/generate_token/'. $r->id).'" data-toggle="modal" data-target="#token_box" title="Token"><i class="fa fa-gift"></i> Token </a>';
							
							$button .= '<a class="btn btn-danger disabled editBtn btn-sm" href="#" title="Cancle"><i class="fa fa-cutlery"></i> Cancled </a>';
						}
						elseif($r->modified_by == $r->paid_to){
							$button .= ' <a class="btn btn-warning editBtn btn-sm" href="'.base_url('voucher_redeem/generate_token/'. $r->id).'" data-toggle="modal" data-target="#token_box" title="Token"><i class="fa fa-gift"></i> Token </a>';

							$button .= '<a class="btn btn-danger disabled editBtn btn-sm" href="#" title="Cancle"><i class="fa fa-cutlery"></i> Rejected </a>';
						}
					}
					else{
						$button .= '<a class="btn btn-warning editBtn btn-sm" href="'.base_url('voucher_redeem/generate_token/'. $r->id).'" data-toggle="modal" data-target="#token_box" title="Accept"><i class="fa fa-money"></i> Accept </a>';
						
						$button .= '<a class="btn btn-danger editBtn btn-sm" href="'.base_url('voucher_redeem/reject_order/'. $r->id).'" title="Reject"><i class="fa fa-cutlery"></i> Reject </a>';
					}
				}
				else{
					$status = '<small class="label label-success"> Accepted </small>';
					$button .= ' <a class="btn btn-success editBtn btn-sm" href="'.base_url('voucher_redeem/generate_token/'. $r->id).'" data-toggle="modal" data-target="#token_box" title="Token"><i class="fa fa-gift"></i> Token </a>';
				}
				
				
					
				$data['data'][] = array(
					$button,
					date('d-M, Y', $r->created_at),					
					$r->token_no,					
				//	$voucher_id,					
					$r->voucher_description,					
					$r->amount,					
					$paid_by,
					$service_type,
					$table_no,
					$order_status,
					$status					
				);
					
			}
		}
		else{
		   $data['data'][]=array(
			 'You have no Data' ,'','','','','','','','',''
			);
		}
		echo json_encode($data);
	  }
	  
	  
	public function voucher_payment_details($id){
		//restricted this area, only for admin
	//	permittedArea();
		$data['vouchers'] = singleDbTableRow($id,'vouchers');
	
		theme('voucher_payment_details', $data);
	}
	
	public function get_voc_type()
	{
		$voc_type = $_POST['voc_type'];
		$payee_id = $_POST['payee_id'];
		
		$get_payee_role = $this->db->get_where('users', ['referral_code'=>$payee_id]);
		if($get_payee_role->num_rows() > 0){
			foreach($get_payee_role->result() as $role);
			$payee_role = $role->rolename;
			
			$query = $this->db->group_by('voucher_description')->get_where('vouchers', ['voucher_name'=>$voc_type, 'to_role'=>$payee_role]);
			$user = "<option value=''>Choose Option</option>";
			foreach($query->result() as $r)
			{
				$user.= "<option value='".$r->voucher_description."'>".$r->voucher_description."</option>";
			}
		}
		else{
			$user = "<option value=''>Choose Option</option>";
		}
		echo $user;
	}
	
	public function get_payble_voucher_type(){
		$payee_id = $this->input->post('referredByCode');
		
		$get_payee_role = $this->db->get_where('users', ['referral_code'=>$payee_id]);
		foreach($get_payee_role->result() as $role);
		$payee_role = $role->rolename;
		
		$condition = " to_role = '".$payee_role."' AND voucher_name != '24'";
		
		$get_voc_type = $this->db->group_by('voucher_name')->where($condition)->get_where('vouchers');
		if($get_voc_type->num_rows() > 0){
			echo "<option value=''>Choose Option</option>";
			foreach($get_voc_type->result() as $voc_type){
				echo "<option value='".$voc_type->voucher_name."'>".singleDbTableRow($voc_type->voucher_name, 'status')->status."</option>";
			}
		}
		else{
			echo "fail";
		}
	}
	
	public function get_payable_vouchers()
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		$voc_type = $_POST['voc_type'];
		$payee_id = $_POST['payee_id'];
		
		echo "<option value=''>Choose Option</option>";
		
		$get_payee_role = $this->db->get_where('users', ['referral_code'=>$payee_id]);
		if($get_payee_role->num_rows() > 0){
			foreach($get_payee_role->result() as $role);
			$payee_role = $role->rolename;
			
			$today_date = date("Y-m-d");
			$condition = " voucher_description = '".$voc_type."' AND user_id = '".$user_id."' AND used = 'no' AND reserved='' AND reserved_at = 0 AND start_date <= '".$today_date."' AND to_role = '".$payee_role."' ";
			$get_vouchers = $this->db->where($condition)->get('vouchers');
			if($get_vouchers->num_rows() > 0){
				foreach($get_vouchers->result() as $voc){
					echo "<option value='".$voc->voucher_id."'>".$voc->voucher_id."</option>";
				}
			}
		}
	}
	
}//last brace required
?>