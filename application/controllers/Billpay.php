<?php  ini_set("allow_url_fopen", 1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Billpay extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('product_model');
		$this->load->model('ledger_model');
		$this->load->model('billpay_model');
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
	
/**
*RECHARGE
*/
//
public function landline_paymentListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->billpay_model->landline_PaymentListCount();
		$query = $this->billpay_model->landline_PaymentList($limit, $start);

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
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('billpay/process_landline_recharge/'. $r->id).'"  data-toggle="modal" data-target="#myModal1"  data-toggle="tooltip" title="View"> Proceed for Payment
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= $blockUnblockBtn;
		
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				$button,
				$r->sms_no,
				$r->service_category, //$r->payee_name,
				
				//$payspec = paytypeDbTableRow($r->pay_type)->name, //Anand
				number_format($r->amount, 2) ,				
		
						
				$statusBtn,			
				
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

	public function landline_payments()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('landline_payments');
	}
	public function process_landline_recharge($id){
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

		$data['users'] = singleDbTableRow($id, 'billpay_request');

		//Service Type
						if($this->input->post()) 
													{
													//	if ($this->input->post('submit') != 'add_agent1') die('Error! sorry');
													
														if ($this->input->post('submit1') == 'add_agent1'); // die('Error! sorry');
														{
															
															$this->form_validation->set_rules('otp', 'SMS OTP password ', 'required');

															if($this->form_validation->run() == true)
															{
																$sellProduct = $this->billpay_model->landline_payee_transfer($id);
																if($sellProduct){
																setFlashGoBack('successMsg', 'Recharge Successfull...!!!');
																		redirect(base_url('Account'));
																}
																else{
																	setFlashGoBack('errorMsg', 'Bill Pay went wrong! please try again later.');
																	redirect(base_url('Account'));
																}
														
															}
														}
													}	
																									
									
		theme('process_landline_recharge', $data);

	}
//
public function broadband_paymentListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->billpay_model->broadband_PaymentListCount();
		$query = $this->billpay_model->broadband_PaymentList($limit, $start);

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
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('billpay/process_broadband_recharge/'. $r->id).'"  data-toggle="modal" data-target="#myModal1"  data-toggle="tooltip" title="View"> Proceed for Payment
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= $blockUnblockBtn;
		
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				$button,
				$r->sms_no,
				$r->service_category, //$r->payee_name,
				
				//$payspec = paytypeDbTableRow($r->pay_type)->name, //Anand
				number_format($r->amount, 2) ,				
		
						
				$statusBtn,			
				
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

	public function broadband_payments()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('broadband_payments');
	}
	public function electricity_paymentListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->billpay_model->electricity_PaymentListCount();
		$query = $this->billpay_model->electricity_PaymentList($limit, $start);

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
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('billpay/process_electricity_recharge/'. $r->id).'"  data-toggle="modal" data-target="#myModal1"  data-toggle="tooltip" title="View"> Proceed for Payment
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= $blockUnblockBtn;
		
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				$button,
				$r->sms_no,
				$r->service_category, //$r->payee_name,
				
				//$payspec = paytypeDbTableRow($r->pay_type)->name, //Anand
				number_format($r->amount, 2) ,				
		
						
				$statusBtn,			
				
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

	public function electricity_payments()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('electricity_payments');
	}
	public function gas_paymentListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->billpay_model->electricity_PaymentListCount();
		$query = $this->billpay_model->electricity_PaymentList($limit, $start);

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
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('billpay/process_electricity_recharge/'. $r->id).'"  data-toggle="modal" data-target="#myModal1"  data-toggle="tooltip" title="View"> Proceed for Payment
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= $blockUnblockBtn;
		
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				$button,
				$r->sms_no,
				$r->service_category, //$r->payee_name,
				
				//$payspec = paytypeDbTableRow($r->pay_type)->name, //Anand
				number_format($r->amount, 2) ,				
		
						
				$statusBtn,			
				
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

	public function gas_payments()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('gas_payments');
	}
///////
public function postpaid_paymentListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->billpay_model->postpaid_PaymentListCount();
		$query = $this->billpay_model->postpaid_PaymentList($limit, $start);

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
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('billpay/process_postpaid_recharge/'. $r->id).'"  data-toggle="modal" data-target="#myModal1"  data-toggle="tooltip" title="View"> Proceed for Payment
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= $blockUnblockBtn;
		
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				$button,
				$r->sms_no,
				$r->service_category, //$r->payee_name,
				
				//$payspec = paytypeDbTableRow($r->pay_type)->name, //Anand
				number_format($r->amount, 2) ,				
		
						
				$statusBtn,			
				
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

	public function postpaid_payments()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('postpaid_payments');
	}
	public function process_postpaid_recharge($id){
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

		$data['users'] = singleDbTableRow($id, 'billpay_request');

		//Service Type
						if($this->input->post()) 
													{
													//	if ($this->input->post('submit') != 'add_agent1') die('Error! sorry');
													
														if ($this->input->post('submit1') == 'add_agent1'); // die('Error! sorry');
														{
															
															$this->form_validation->set_rules('otp', 'SMS OTP password ', 'required');

															if($this->form_validation->run() == true)
															{
																$sellProduct = $this->billpay_model->postpaid_payee_transfer($id);
																if($sellProduct){
																setFlashGoBack('successMsg', 'Recharge Successfull...!!!');
																		redirect(base_url('Account'));
																}
																else{
																	setFlashGoBack('errorMsg', 'Bill Pay went wrong! please try again later.');
																	redirect(base_url('Account'));
																}
														
															}
														}
													}	
																									
									
		theme('process_postpaid_recharge', $data);

	}
	public function process_broadband_recharge($id){
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

		$data['users'] = singleDbTableRow($id, 'billpay_request');

		//Service Type
						if($this->input->post()) 
													{
													//	if ($this->input->post('submit') != 'add_agent1') die('Error! sorry');
													
														if ($this->input->post('submit1') == 'add_agent1'); // die('Error! sorry');
														{
															
															$this->form_validation->set_rules('otp', 'SMS OTP password ', 'required');

															if($this->form_validation->run() == true)
															{
																$sellProduct = $this->billpay_model->broadband_payee_transfer($id);
																if($sellProduct){
																setFlashGoBack('successMsg', 'Recharge Successfull...!!!');
																		redirect(base_url('Account'));
																}
																else{
																	setFlashGoBack('errorMsg', 'Bill Pay went wrong! please try again later.');
																	redirect(base_url('Account'));
																}
														
															}
														}
													}	
																									
									
		theme('process_broadband_recharge', $data);

	}
	public function process_electricity_recharge($id){
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

		$data['users'] = singleDbTableRow($id, 'billpay_request');

		//Service Type
						if($this->input->post()) 
													{
													//	if ($this->input->post('submit') != 'add_agent1') die('Error! sorry');
													
														if ($this->input->post('submit1') == 'add_agent1'); // die('Error! sorry');
														{
															
															$this->form_validation->set_rules('otp', 'SMS OTP password ', 'required');

															if($this->form_validation->run() == true)
															{
																$sellProduct = $this->billpay_model->electricity_payee_transfer($id);
																if($sellProduct){
																setFlashGoBack('successMsg', 'Recharge Successfull...!!!');
																		redirect(base_url('Account'));
																}
																else{
																	setFlashGoBack('errorMsg', 'Bill Pay went wrong! please try again later.');
																	redirect(base_url('Account'));
																}
														
															}
														}
													}	
																									
									
		theme('process_electricity_recharge', $data);

	}
//
public function get_op_loc()
{
	 $mob=$_POST['mob'];
	 $xml = file_get_contents('https://joloapi.com/api/findoperator.php?userid=anand12345&key=897158551373092&mob='.$mob.'&type=json');
	 $json = json_decode($xml, true);
	
	if(isset($json['operator_code']))
	{
		$opt_id=$json['operator_code'];
		$operators = $this->db->get_where('operators', ['op_code' => $opt_id]);
		if($operators ->num_rows() >0)
		{
			foreach ($operators->result() as $op);
			$opt_name = $op->operator;
			$opt_id_api= $op->api_code;
		}
		else
		{
			$opt_name ='';
			$opt_id_api= '';
		}
		
		$loc_id=$json['circle_code'];
		$circles = $this->db->get_where('circles', ['c_code' => $loc_id]);
		if($circles ->num_rows() >0)
		{
			foreach ($circles->result() as $cir);
			$loc_name = $cir->circle;
			
		}
		//
		
		echo '<div class="form-group">
				<label for="firstName" class="col-md-3">Operator Type
					<span class="text-red">*</span>
				</label>
				<div class="col-md-9">
				
					 <select name="operator_id" class="form-control">
					 <option value="AT"'; if ($opt_id == 28) { echo "  selected"; } echo '>Airtel</option>
					 <option value="VF"'; if ($opt_id == 22) { echo "  selected"; }echo '>Vodafone</option>
					 <option value="BS"'; if ($opt_id == 3) { echo "  selected"; }echo '>BSNL</option>
					 <option value="BSS"'; if ($opt_id == 3) { echo "  selected"; }echo '>BSNL Special/Validity</option>
					 <option value="IDX"'; if ($opt_id == 8) { echo "  selected"; }echo '>Idea</option>
					 <option value="TD"'; if ($opt_id == 17) { echo "  selected"; }echo '>Docomo GSM</option>
					 <option value="TDS"'; if ($opt_id == 17) { echo "  selected"; }echo '>Docomo Special GSM</option>
					 <option value="TI"'; if ($opt_id == 18) { echo "  selected"; }echo '>Docomo CDMA</option>
					 <option value="RG"'; if ($opt_id == 13) { echo "  selected"; }echo '>Reliance GSM</option>
					 <option value="RL"'; if ($opt_id == 12) { echo "  selected"; }echo '>Reliance CDMA</option>
					 <option value="MS"'; if ($opt_id == 10) { echo "  selected"; }echo '>MTS</option>
					 <option value="AL"'; if ($opt_id == 1) { echo "  selected"; }echo '>Aircel</option>
					 <option value="UN"'; if ($opt_id == 19) { echo "  selected"; }echo '>Uninor</option>
					 <option value="UNS"'; if ($opt_id == 19) { echo "  selected"; }echo '>Uninor Special</option>
					 <option value="VD"'; if ($opt_id == 5) { echo "  selected"; }echo '>Videocon</option>
					 <option value="VDS"'; if ($opt_id == 5) { echo "  selected"; }echo '>Videocon Special</option>
					 <option value="MTD"'; if ($opt_id == 20) { echo "  selected"; }echo '>MTNL Delhi</option>
					 <option value="MTDS"'; if ($opt_id == 20) { echo "  selected"; }echo '>MTNL Delhi Special</option>
					 <option value="MTM"'; if ($opt_id == 6) { echo "  selected"; }echo '>MTNL Mumbai</option>
					 <option value="MTMS"'; if ($opt_id == 6) { echo "  selected"; }echo '>MTNL Mumbai Special</option>
					 <option value="TW"'; if ($opt_id == 1) { echo "  selected"; }echo '>Tata Walky</option>
					 ';
					

					echo '</select>
					<font color="#FF0000">  Please verify your operator before recharging</font>
				</div>
				
		</div>';
		echo '<div class="form-group">
				<label for="firstName" class="col-md-3">Location
					<span class="text-red">*</span>
				</label>
				<div class="col-md-9">
				
					 <input type="text" name="loc_name" id="loc_name" value="'.$loc_name.'" class="form-control" readonly>
    				<input type="hidden" name="loc_id" id="loc_id" value="'.$loc_id.'" readonly></td> 
					
				</div>
		</div>';
		 
		//
	
	}
	else
	{
		
		echo '<div class="form-group">
				<label for="firstName" class="col-md-3">Operator Type
					<span class="text-red">*</span>
				</label>
				<div class="col-md-9">
				
					 <select name="operator_id" class="form-control">
					 <option value="AT">Airtel</option>
					 <option value="VF">Vodafone</option>
					 <option value="BS">BSNL</option>
					 <option value="BSS">BSNL Special/Validity</option>
					 <option value="IDX">Idea</option>
					 <option value="TD">Docomo GSM</option>
					 <option value="TDS">Docomo Special GSM</option>
					 <option value="TI">Docomo CDMA</option>
					 <option value="RG">Reliance GSM</option>
					 <option value="RL">Reliance CDMA</option>
					 <option value="MS">MTS</option>
					 <option value="AL">Aircel</option>
					 <option value="UN">Uninor</option>
					 <option value="UNS">Uninor Special</option>
					 <option value="VD">Videocon</option>
					 <option value="VDS">Videocon Special</option>
					 <option value="MTD">MTNL Delhi</option>
					 <option value="MTDS">MTNL Delhi Special</option>
					 <option value="MTM">MTNL Mumbai</option>
					 <option value="MTMS">MTNL Mumbai Special</option>
					 <option value="TW">Tata Walky</option>
					 ';
					 

					echo '</select>
					
				</div>
		</div>';
		echo ' <input type="hidden" name="loc_name" id="loc_name" value="" readonly>
    			<input type="hidden" name="loc_id" id="loc_id" value="" readonly></td>';
		
	}
}
/*OFFER*/
public function get_mbl_offer()
{
	 $mob=$_POST['mob'];
	 $xml = file_get_contents('https://joloapi.com/api/findoperator.php?userid=anand12345&key=897158551373092&mob='.$mob.'&type=json');
	 $json = json_decode($xml, true);
	$cnt = 1;
	if(isset($json['operator_code']))
	{
		$opt_id=$json['operator_code'];
		$loc_id=$json['circle_code'];
		$operators = $this->db->get_where('operators', ['op_code' => $opt_id]);
		if($operators ->num_rows() >0)
		{
			foreach ($operators->result() as $op);
			$opt_name = $op->operator;
			$opt_id_api= $op->api_code;
		}
		else
		{
			$opt_name ='';
			$opt_id_api= '';
		}
		$circles = $this->db->get_where('circles', ['c_code' => $loc_id]);
		if($circles ->num_rows() >0)
		{
			foreach ($circles->result() as $cir);
			$loc_name = $cir->circle;
			
		}
	}
	//
	echo '<div class="box-header"><h3>'.$opt_name.' - '.$loc_name.' PLANS</h3></div>';
	echo '<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tup" data-toggle="tab">Top UP</a></li>
              <li><a href="#ftt" data-toggle="tab">Full Talktime</a></li>
              <li><a href="#2g" data-toggle="tab">2G</a></li>
			  <li><a href="#3g" data-toggle="tab">3G/4G</a></li>
			  <li><a href="#sms" data-toggle="tab">SMS</a></li>
			  <li><a href="#lsc" data-toggle="tab">Local/STD/ISD</a></li>
			  <li><a href="#rmg" data-toggle="tab">Roaming</a></li>
			  <li><a href="#otr" data-toggle="tab">Other</a></li>
             </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tup">';
$jsonxx = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=TUP&type=json');
		$someArray = json_decode($jsonxx, true);
		if (count($someArray) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray as $key => $value) {
		echo " <tr><td>" .$value["Detail"] . "</td> <td>" .$value["Amount"] . "</td> <td>" .$value["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="mbl'.$cnt.'" id="mbl'.$cnt.'" value="'.$value["Amount"].'">';
		echo'<input type="button" onclick="get_mbl_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo'</div>
              
              <div class="tab-pane" id="ftt">';
 $jsonxx1 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=FTT&type=json');
		$someArray1 = json_decode($jsonxx1, true);
		if (count($someArray1) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray1 as $key1 => $value1) {
		echo " <tr><td>" .$value1["Detail"] . "</td> <td>" .$value1["Amount"] . "</td> <td>" .$value1["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="mbl'.$cnt.'" id="mbl'.$cnt.'" value="'.$value1["Amount"].'">';
		echo'<input type="button" onclick="get_mbl_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo'</div>
             
              <div class="tab-pane" id="2g">';
               $jsonxx2 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=2G&type=json');
		$someArray2 = json_decode($jsonxx2, true);
		if (count($someArray2) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray2 as $key2 => $value2) {
		echo " <tr><td>" .$value2["Detail"] . "</td> <td>" .$value2["Amount"] . "</td> <td>" .$value2["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="mbl'.$cnt.'" id="mbl'.$cnt.'" value="'.$value2["Amount"].'">';
		echo'<input type="button" onclick="get_mbl_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo'</div>
              <div class="tab-pane" id="3g">';
			       $jsonxx3 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=3G&type=json');
		$someArray3 = json_decode($jsonxx3, true);
		if (count($someArray3) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray3 as $key3 => $value3) {
		echo " <tr><td>" .$value3["Detail"] . "</td> <td>" .$value3["Amount"] . "</td> <td>" .$value3["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="mbl'.$cnt.'" id="mbl'.$cnt.'" value="'.$value3["Amount"].'">';
		echo'<input type="button" onclick="get_mbl_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo'</div>
			  <div class="tab-pane" id="sms">';
                    $jsonxx4 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=SMS&type=json');
		$someArray4 = json_decode($jsonxx4, true);
		if (count($someArray4) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray4 as $key4 => $value4) {
		echo " <tr><td>" .$value4["Detail"] . "</td> <td>" .$value4["Amount"] . "</td> <td>" .$value4["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="mbl'.$cnt.'" id="mbl'.$cnt.'" value="'.$value4["Amount"].'">';
		echo'<input type="button" onclick="get_mbl_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo '</div>
			  <div class="tab-pane" id="lsc">';
                     $jsonxx5 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=LSC&type=json');
		$someArray5 = json_decode($jsonxx5, true);
		if (count($someArray5) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray5 as $key5 => $value5) {
		echo " <tr><td>" .$value5["Detail"] . "</td> <td>" .$value5["Amount"] . "</td> <td>" .$value5["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="mbl'.$cnt.'" id="mbl'.$cnt.'" value="'.$value5["Amount"].'">';
		echo'<input type="button" onclick="get_mbl_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo '</div>
			  <div class="tab-pane" id="rmg">';
                     $jsonxx6 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=RMG&type=json');
		$someArray6 = json_decode($jsonxx6, true);
		if (count($someArray6) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray6 as $key6 => $value6) {
		echo " <tr><td>" .$value6["Detail"] . "</td> <td>" .$value6["Amount"] . "</td> <td>" .$value6["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="mbl'.$cnt.'" id="mbl'.$cnt.'" value="'.$value6["Amount"].'">';
		echo'<input type="button" onclick="get_mbl_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo '</div>
			   <div class="tab-pane" id="otr">';
                    $jsonxx7 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=OTR&type=json');
		$someArray7 = json_decode($jsonxx7, true);
		if (count($someArray7) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray7 as $key7 => $value7) {
		echo " <tr><td>" .$value7["Detail"] . "</td> <td>" .$value7["Amount"] . "</td> <td>" .$value7["Validity"] . "</td> ";
		echo '<td><input type="hidden"  id="mbl'.$cnt.'" id="mbl'.$cnt.'" value="'.$value7["Amount"].'">';
		echo'<input type="button" onclick="get_mbl_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo '</div>
             
            </div>
            
          </div>';
	//
	
	
}
//
//
public function data_get_op_loc()
{
	 $mob=$_POST['mob'];
	 $xml = file_get_contents('https://joloapi.com/api/findoperator.php?userid=anand12345&key=897158551373092&mob='.$mob.'&type=json');
	 $json = json_decode($xml, true);
	
	if(isset($json['operator_code']))
	{
		$opt_id=$json['operator_code'];
		$operators = $this->db->get_where('operators', ['op_code' => $opt_id]);
		if($operators ->num_rows() >0)
		{
			foreach ($operators->result() as $op);
			$opt_name = $op->operator;
			$opt_id_api= $op->api_code;
		}
		else
		{
			$opt_name ='';
			$opt_id_api= '';
		}
		
		$loc_id=$json['circle_code'];
		$circles = $this->db->get_where('circles', ['c_code' => $loc_id]);
		if($circles ->num_rows() >0)
		{
			foreach ($circles->result() as $cir);
			$loc_name = $cir->circle;
			
		}
		//
		
		echo '<div class="form-group">
				<label for="firstName" class="col-md-3">Operator Type
					<span class="text-red">*</span>
				</label>
				<div class="col-md-9">
				
					 <select name="data_operator_id" class="form-control">
					 <option value="AT"'; if ($opt_id == 28) { echo "  selected"; } echo '>Airtel</option>
					 <option value="VF"'; if ($opt_id == 22) { echo "  selected"; }echo '>Vodafone</option>
					 <option value="BS"'; if ($opt_id == 3) { echo "  selected"; }echo '>BSNL</option>
					 <option value="BSS"'; if ($opt_id == 3) { echo "  selected"; }echo '>BSNL Special/Validity</option>
					 <option value="IDX"'; if ($opt_id == 8) { echo "  selected"; }echo '>Idea</option>
					 <option value="TD"'; if ($opt_id == 17) { echo "  selected"; }echo '>Docomo GSM</option>
					 <option value="TDS"'; if ($opt_id == 17) { echo "  selected"; }echo '>Docomo Special GSM</option>
					 <option value="TI"'; if ($opt_id == 18) { echo "  selected"; }echo '>Docomo CDMA</option>
					 <option value="RG"'; if ($opt_id == 13) { echo "  selected"; }echo '>Reliance GSM</option>
					 <option value="RL"'; if ($opt_id == 12) { echo "  selected"; }echo '>Reliance CDMA</option>
					 <option value="MS"'; if ($opt_id == 10) { echo "  selected"; }echo '>MTS</option>
					 <option value="AL"'; if ($opt_id == 1) { echo "  selected"; }echo '>Aircel</option>
					 <option value="UN"'; if ($opt_id == 19) { echo "  selected"; }echo '>Uninor</option>
					 <option value="UNS"'; if ($opt_id == 19) { echo "  selected"; }echo '>Uninor Special</option>
					 <option value="VD"'; if ($opt_id == 5) { echo "  selected"; }echo '>Videocon</option>
					 <option value="VDS"'; if ($opt_id == 5) { echo "  selected"; }echo '>Videocon Special</option>
					 <option value="MTD"'; if ($opt_id == 20) { echo "  selected"; }echo '>MTNL Delhi</option>
					 <option value="MTDS"'; if ($opt_id == 20) { echo "  selected"; }echo '>MTNL Delhi Special</option>
					 <option value="MTM"'; if ($opt_id == 6) { echo "  selected"; }echo '>MTNL Mumbai</option>
					 <option value="MTMS"'; if ($opt_id == 6) { echo "  selected"; }echo '>MTNL Mumbai Special</option>
					 <option value="TW"'; if ($opt_id == 1) { echo "  selected"; }echo '>Tata Walky</option>
					 ';
					

					echo '</select>
					<font color="#FF0000">  Please verify your operator before recharging</font>
				</div>
				
		</div>';
		echo '<div class="form-group">
				<label for="firstName" class="col-md-3">Location
					<span class="text-red">*</span>
				</label>
				<div class="col-md-9">
				
					 <input type="text" name="data_loc_name" id="loc_name" value="'.$loc_name.'" class="form-control" readonly>
    				<input type="hidden" name="data_loc_id" id="loc_id" value="'.$loc_id.'" readonly></td> 
					
				</div>
		</div>';
		 
		//
	
	}
	else
	{
		
		echo '<div class="form-group">
				<label for="firstName" class="col-md-3">Operator Type
					<span class="text-red">*</span>
				</label>
				<div class="col-md-9">
				
					 <select name="data_operator_id" class="form-control">
					 <option value="AT">Airtel</option>
					 <option value="VF">Vodafone</option>
					 <option value="BS">BSNL</option>
					 <option value="BSS">BSNL Special/Validity</option>
					 <option value="IDX">Idea</option>
					 <option value="TD">Docomo GSM</option>
					 <option value="TDS">Docomo Special GSM</option>
					 <option value="TI">Docomo CDMA</option>
					 <option value="RG">Reliance GSM</option>
					 <option value="RL">Reliance CDMA</option>
					 <option value="MS">MTS</option>
					 <option value="AL">Aircel</option>
					 <option value="UN">Uninor</option>
					 <option value="UNS">Uninor Special</option>
					 <option value="VD">Videocon</option>
					 <option value="VDS">Videocon Special</option>
					 <option value="MTD">MTNL Delhi</option>
					 <option value="MTDS">MTNL Delhi Special</option>
					 <option value="MTM">MTNL Mumbai</option>
					 <option value="MTMS">MTNL Mumbai Special</option>
					 <option value="TW">Tata Walky</option>
					 ';
					 

					echo '</select>
					
				</div>
		</div>';
		echo ' <input type="hidden" name="data_loc_name" id="loc_name" value="" readonly>
    			<input type="hidden" name="data_loc_id" id="loc_id" value="" readonly></td>';
		
	}
}
public function data_offer()
{
	 $mob=$_POST['mob'];
	 $xml = file_get_contents('https://joloapi.com/api/findoperator.php?userid=anand12345&key=897158551373092&mob='.$mob.'&type=json');
	 $json = json_decode($xml, true);
	$cnt = 1;
	if(isset($json['operator_code']))
	{
		$opt_id=$json['operator_code'];
		$loc_id=$json['circle_code'];
		$operators = $this->db->get_where('operators', ['op_code' => $opt_id]);
		if($operators ->num_rows() >0)
		{
			foreach ($operators->result() as $op);
			$opt_name = $op->operator;
			$opt_id_api= $op->api_code;
		}
		else
		{
			$opt_name ='';
			$opt_id_api= '';
		}
		$circles = $this->db->get_where('circles', ['c_code' => $loc_id]);
		if($circles ->num_rows() >0)
		{
			foreach ($circles->result() as $cir);
			$loc_name = $cir->circle;
			
		}
	}
	//
	echo '<div class="box-header"><h3>'.$opt_name.' - '.$loc_name.' PLANS</h3></div>';
	echo '<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tup" data-toggle="tab">Top UP</a></li>
              <li><a href="#ftt" data-toggle="tab">Full Talktime</a></li>
              <li><a href="#2g" data-toggle="tab">2G</a></li>
			  <li><a href="#3g" data-toggle="tab">3G/4G</a></li>
			  <li><a href="#sms" data-toggle="tab">SMS</a></li>
			  <li><a href="#lsc" data-toggle="tab">Local/STD/ISD</a></li>
			  <li><a href="#rmg" data-toggle="tab">Roaming</a></li>
			  <li><a href="#otr" data-toggle="tab">Other</a></li>
             </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tup">';
$jsonxx = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=TUP&type=json');
		$someArray = json_decode($jsonxx, true);
		if (count($someArray) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray as $key => $value) {
		echo " <tr><td>" .$value["Detail"] . "</td> <td>" .$value["Amount"] . "</td> <td>" .$value["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="data'.$cnt.'" id="data'.$cnt.'" value="'.$value["Amount"].'">';
		echo'<input type="button" onclick="get_data_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo'</div>
              
              <div class="tab-pane" id="ftt">';
 $jsonxx1 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=FTT&type=json');
		$someArray1 = json_decode($jsonxx1, true);
		if (count($someArray1) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray1 as $key1 => $value1) {
		echo " <tr><td>" .$value1["Detail"] . "</td> <td>" .$value1["Amount"] . "</td> <td>" .$value1["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="data'.$cnt.'" id="data'.$cnt.'" value="'.$value1["Amount"].'">';
		echo'<input type="button" onclick="get_data_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo'</div>
             
              <div class="tab-pane" id="2g">';
               $jsonxx2 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=2G&type=json');
		$someArray2 = json_decode($jsonxx2, true);
		if (count($someArray2) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray2 as $key2 => $value2) {
		echo " <tr><td>" .$value2["Detail"] . "</td> <td>" .$value2["Amount"] . "</td> <td>" .$value2["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="data'.$cnt.'" id="data'.$cnt.'" value="'.$value2["Amount"].'">';
		echo'<input type="button" onclick="get_data_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo'</div>
              <div class="tab-pane" id="3g">';
			       $jsonxx3 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=3G&type=json');
		$someArray3 = json_decode($jsonxx3, true);
		if (count($someArray3) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray3 as $key3 => $value3) {
		echo " <tr><td>" .$value3["Detail"] . "</td> <td>" .$value3["Amount"] . "</td> <td>" .$value3["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="data'.$cnt.'" id="data'.$cnt.'" value="'.$value3["Amount"].'">';
		echo'<input type="button" onclick="get_data_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo'</div>
			  <div class="tab-pane" id="sms">';
                    $jsonxx4 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=SMS&type=json');
		$someArray4 = json_decode($jsonxx4, true);
		if (count($someArray4) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray4 as $key4 => $value4) {
		echo " <tr><td>" .$value4["Detail"] . "</td> <td>" .$value4["Amount"] . "</td> <td>" .$value4["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="data'.$cnt.'" id="data'.$cnt.'" value="'.$value4["Amount"].'">';
		echo'<input type="button" onclick="get_data_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo '</div>
			  <div class="tab-pane" id="lsc">';
                     $jsonxx5 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=LSC&type=json');
		$someArray5 = json_decode($jsonxx5, true);
		if (count($someArray5) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray5 as $key5 => $value5) {
		echo " <tr><td>" .$value5["Detail"] . "</td> <td>" .$value5["Amount"] . "</td> <td>" .$value5["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="data'.$cnt.'" id="data'.$cnt.'" value="'.$value5["Amount"].'">';
		echo'<input type="button" onclick="get_data_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo '</div>
			  <div class="tab-pane" id="rmg">';
                     $jsonxx6 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=RMG&type=json');
		$someArray6 = json_decode($jsonxx6, true);
		if (count($someArray6) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray6 as $key6 => $value6) {
		echo " <tr><td>" .$value6["Detail"] . "</td> <td>" .$value6["Amount"] . "</td> <td>" .$value6["Validity"] . "</td>";
		echo '<td><input type="hidden"  id="data'.$cnt.'" id="data'.$cnt.'" value="'.$value6["Amount"].'">';
		echo'<input type="button" onclick="get_data_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo '</div>
			   <div class="tab-pane" id="otr">';
                    $jsonxx7 = file_get_contents('https://joloapi.com/api/findplan.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&cir='.$loc_id.'&typ=OTR&type=json');
		$someArray7 = json_decode($jsonxx7, true);
		if (count($someArray7) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity (days)</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray7 as $key7 => $value7) {
		echo " <tr><td>" .$value7["Detail"] . "</td> <td>" .$value7["Amount"] . "</td> <td>" .$value7["Validity"] . "</td> ";
		echo '<td><input type="hidden"  id="data'.$cnt.'" id="data'.$cnt.'" value="'.$value7["Amount"].'">';
		echo'<input type="button" onclick="get_data_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo '</div>
             
            </div>
            
          </div>';
	//
	
	
}
public function get_op_dth()
{
	 $mob=$_POST['mob'];
	 $xml = file_get_contents('https://joloapi.com/api/finddth.php?userid=anand12345&key=897158551373092&mob='.$mob.'&type=json');
	 $json = json_decode($xml, true);
	
	if(isset($json['operator_code']))
	{
		$opt_id=$json['operator_code'];
		$operators = $this->db->get_where('dth_operators', ['op_code' => $opt_id]);
		if($operators ->num_rows() >0)
		{
			foreach ($operators->result() as $op);
			$opt_name = $op->operator;
			
		}
		else
		{
			$opt_name ='';
			
		}
		
		
		//
		
		echo '<div class="form-group">
				<label for="firstName" class="col-md-3">Operator Type
					<span class="text-red">*</span>
				</label>
				<div class="col-md-9">
				
					 <select name="dth_opt" id="dth_opt"  class="form-control">
					 <option value="AD"'; if ($opt_id == 93) { echo "  selected"; } echo '> AIRTEL DTH</option>
					 <option value="SD" ';if ($opt_id == 98) { echo "  selected"; }echo '>SUN DIRECT DTH</option>
					 <option value="TS"'; if ($opt_id == 94) { echo "  selected"; }echo '>TATA SKY</option>
					 <option value="DT" '; if ($opt_id == 97) { echo "  selected"; }echo '>DISH TV</option>
					 <option value="BT" '; if ($opt_id == 96) { echo "  selected"; }echo '>RELIANCE BIG TV</option>
					 <option value="VT" '; if ($opt_id == 95) { echo "  selected"; }echo '>VIDEOCON D2H</option>
					 
				</select>
					<font color="#FF0000">  Please verify your operator before recharging</font>
				</div>
				
		</div>';
		echo '<div class="form-group">
				<label for="firstName" class="col-md-3">Location
					<span class="text-red">*</span>
				</label>
				<div class="col-md-9">
				
					 <input type="text" name="dth_loc_name" id="dth_loc_name" value="" class="form-control" >
    				<input type="hidden" name="dth_loc_id" id="dth_loc_id" value="" ></td> 
					
				</div>
		</div>';
		 
		//
	
	}
	else
	{
		
		echo '<div class="form-group">
				<label for="firstName" class="col-md-3">Operator Type
					<span class="text-red">*</span>
				</label>
				<div class="col-md-9">
				
					 <select name="dth_opt" id="dth_opt"  class="form-control">
                 <option value="AD"> AIRTEL DTH</option>
                 <option value="SD">SUN DIRECT DTH</option>
                 <option value="TS">TATA SKY</option>
                 <option value="DT">DISH TV</option>
                 <option value="BT">RELIANCE BIG TV</option>
                 <option value="VT">VIDEOCON D2H</option>
                 
			</select>
					
				</div>
		</div>';
		echo ' <input type="hidden" name="dth_loc_name" id="dth_loc_name" value="" readonly>
    			<input type="hidden" name="dth_loc_id" id="dth_loc_id" value="" readonly></td>';
		
	}
}
public function get_dth_offer()
{
	 $mob=$_POST['mob'];
	 $xml = file_get_contents('https://joloapi.com/api/finddth.php?userid=anand12345&key=897158551373092&mob='.$mob.'&type=json');
	 $json = json_decode($xml, true);
	
	if(isset($json['operator_code']))
	{
		$cnt = 1;
		$opt_id=$json['operator_code'];
		$operators = $this->db->get_where('dth_operators', ['op_code' => $opt_id]);
		if($operators ->num_rows() >0)
		{
			foreach ($operators->result() as $op);
			$opt_name = $op->operator;
			
		}
		else
		{
			$opt_name ='';
			
		}
		echo'<div class="tab-pane">';
		$jsonxx7 = file_get_contents('https://joloapi.com/api/findplandth.php?userid=anand12345&key=897158551373092&opt='.$opt_id.'&type=json');
		$someArray7 = json_decode($jsonxx7, true);
		if (count($someArray7) > 0) {
		echo "<table class='table table-hover'><thead><tr>
		<th>Detail</th>
		<th>Amount (Rs.)</th>
		<th>Validity</th>
		<th>Pick</th>
		</tr></thead><tbody>";
		foreach ($someArray7 as $key7 => $value7) {
		echo " <tr><td>" .$value7["Detail"] . "</td> <td>" .$value7["Amount"] . "</td> <td>" .$value7["Validity"] . "</td> ";
		echo '<td><input type="hidden"  id="dth'.$cnt.'" id="dth'.$cnt.'" value="'.$value7["Amount"].'">';
		echo'<input type="button" onclick="get_dth_offer('.$cnt.')" class="btn btn-warning" value="Pick"></td></tr>';
		$cnt ++;
		}
		echo "</tbody></table><br/>";
		}else{
		echo"No offer details available for this category";
		}
              echo '</div>';
	}
}
//
public function recharge(){
		//restricted this area, only for admin
	//	permittedArea();
	
		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();		
		
		//$data['users'] = $this->db->order_by('operator', 'asce')->get('operators');	
		$data['users'] = $this->db->order_by('id', 'asce')->get_where('services', ['service_type' => 'Prepaid Mobile']);	
		$data['circle'] = $this->db->order_by('c_id', 'desc')->get('circles');	
		
		if($this->input->post())
		{
			//Mobile
			if($this->input->post('submit') == 'recharge_mobile')
			{
		
				$this->form_validation->set_rules('recharge_no', '10 digit Recharge Number', 'required|trim');
				$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			
	
				if($this->form_validation->run() == true)
				{
					$insert = $this->billpay_model->billpay_request();
					if($insert)
					{
						$this->session->set_flashdata('successMsg', 'Please Proceed for Payment...!!!');
						redirect(base_url('billpay/recharge_payments'));
					}
				}
			}
			//DTH
			if($this->input->post('submit') == 'recharge_dth')
			{
		
				$this->form_validation->set_rules('dth_no', ' Recharge Number', 'required|trim');
				$this->form_validation->set_rules('dth_amount', 'Amount', 'required|trim');
			
	
				if($this->form_validation->run() == true)
				{
					$insert = $this->billpay_model->dth_billpay_request();
					if($insert)
					{
						$this->session->set_flashdata('successMsg', 'Please Proceed for Payment...!!!');
						redirect(base_url('billpay/recharge_payments'));
					}
				}
			}
			//DATACARD
			if($this->input->post('submit') == 'data_recharge')
			{
		
				$this->form_validation->set_rules('data_no', ' Recharge Number', 'required|trim');
				$this->form_validation->set_rules('data_amount', 'Amount', 'required|trim');
			
	
				if($this->form_validation->run() == true)
				{
					$insert = $this->billpay_model->data_billpay_request();
					if($insert)
					{
						$this->session->set_flashdata('successMsg', 'Please Proceed for Payment...!!!');
						redirect(base_url('billpay/recharge_payments'));
					}
				}
			}
			//POSTPAID
			if($this->input->post('submit') == 'post_recharge')
			{
		
				$this->form_validation->set_rules('post_no', ' Recharge Number', 'required|trim');
				$this->form_validation->set_rules('post_amount', 'Amount', 'required|trim');
				$this->form_validation->set_rules('post_acc', 'post_acc', 'required|trim');
			
	
				if($this->form_validation->run() == true)
				{
					$insert = $this->billpay_model->post_billpay_request();
					if($insert)
					{
						$this->session->set_flashdata('successMsg', 'Please Proceed for Payment...!!!');
						redirect(base_url('billpay/postpaid_payments'));
					}
				}
			}
			//LANDLINE
			if($this->input->post('submit') == 'land_recharge')
			{
		
				$this->form_validation->set_rules('land_no', ' Recharge Number', 'required|trim');
				$this->form_validation->set_rules('land_amount', 'Amount', 'required|trim');
				$this->form_validation->set_rules('land_acc', 'post_acc', 'required|trim');
				$this->form_validation->set_rules('land_std', 'post_acc', 'required|trim');
			
	
				if($this->form_validation->run() == true)
				{
					$insert = $this->billpay_model->land_billpay_request();
					if($insert)
					{
						$this->session->set_flashdata('successMsg', 'Please Proceed for Payment...!!!');
						redirect(base_url('billpay/landline_payments'));
					}
				}
			}
			//BROADBAND
			if($this->input->post('submit') == 'broad_recharge')
			{
		
				$this->form_validation->set_rules('broad_no', ' Recharge Number', 'required|trim');
				$this->form_validation->set_rules('broad_amount', 'Amount', 'required|trim');
				$this->form_validation->set_rules('broad_acc', 'post_acc', 'required|trim');
			
	
				if($this->form_validation->run() == true)
				{
					$insert = $this->billpay_model->broad_billpay_request();
					if($insert)
					{
						$this->session->set_flashdata('successMsg', 'Please Proceed for Payment...!!!');
						redirect(base_url('billpay/broadband_payments'));
					}
				}
			}
			//ELECTRICITY
			if($this->input->post('submit') == 'elec_recharge')
			{
		
				
				$this->form_validation->set_rules('elec_amount', 'Amount', 'required|trim');
				$this->form_validation->set_rules('elec_no', 'elec_no', 'required|trim');
			
	
				if($this->form_validation->run() == true)
				{
					$insert = $this->billpay_model->elec_billpay_request();
					if($insert)
					{
						$this->session->set_flashdata('successMsg', 'Please Proceed for Payment...!!!');
						redirect(base_url('billpay/electricity_payments'));
					}
				}
			}
			//GAS
			if($this->input->post('submit') == 'gas_recharge')
			{
		
				
				$this->form_validation->set_rules('gas_amount', 'Amount', 'required|trim');
				$this->form_validation->set_rules('gas_no', 'elec_no', 'required|trim');
			
	
				if($this->form_validation->run() == true)
				{
					$insert = $this->billpay_model->gas_billpay_request();
					if($insert)
					{
						$this->session->set_flashdata('successMsg', 'Please Proceed for Payment...!!!');
						redirect(base_url('billpay/gas_payments'));
					}
				}
			}
		}
		theme('recharge', $data);
	}	
/**
*\.ends
*/
	
	
	
/**
* Recharge Mobile Screen Input
*/

	public function recharge_mobile(){
		//restricted this area, only for admin
	//	permittedArea();
	
		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();		
		
		//$data['users'] = $this->db->order_by('operator', 'asce')->get('operators');	
		$data['users'] = $this->db->order_by('id', 'asce')->get_where('services', ['service_type' => 'Prepaid Mobile']);	
		$data['circle'] = $this->db->order_by('c_id', 'desc')->get('circles');	
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'recharge_mobile') die('Error! sorry');
			
		//	$this->form_validation->set_rules('operator_type', 'Recharge Type', 'required|trim');
		//	$this->form_validation->set_rules('recharge_no', '10 digit Recharge Number', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'trim');
		

			if($this->form_validation->run() == true)
			{
				$insert = $this->billpay_model->billpay_request();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Please Proceed for Payment...!!!');
					redirect(base_url('billpay/recharge_payments'));
				}
			}
		}
		theme('recharge_mobile', $data);
	}	

	/**
* Recharge Datacard Screen Input
*/

	public function recharge_datacard(){
		//restricted this area, only for admin
	//	permittedArea();
	
		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();		
		
		//$data['users'] = $this->db->order_by('operator', 'asce')->get('operators');	
		  $data['users'] = $this->db->order_by('id', 'asce')->get_where('services', ['service_type' => 'Datacard']);
      //  $data['users'] = $this->db->order_by('id', 'desc')->get('operators');			
		$data['circle'] = $this->db->order_by('c_id', 'desc')->get('circles');	
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'recharge_datacard') die('Error! sorry');
			
		//	$this->form_validation->set_rules('operator_type', 'Recharge Type', 'required|trim');
		//	$this->form_validation->set_rules('recharge_no', '10 digit Recharge Number', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'trim');
		

			if($this->form_validation->run() == true)
			{
				$insert = $this->billpay_model->billpay_request();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Please Proceed for Payment...!!!');
					redirect(base_url('billpay/recharge_payments'));
				}
			}
		}
		theme('recharge_datacard', $data);
	}	
	
		/**
* Recharge Datacard Screen Input
*/

	public function recharge_dth(){
		//restricted this area, only for admin
	//	permittedArea();
	
		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();		
		
		//$data['users'] = $this->db->order_by('operator', 'asce')->get('operators');	
		  $data['users'] = $this->db->order_by('id', 'asce')->get_where('services', ['service_type' => 'DTH']);
      //  $data['users'] = $this->db->order_by('id', 'desc')->get('operators');			
		$data['circle'] = $this->db->order_by('c_id', 'desc')->get('circles');	
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'recharge_dth') die('Error! sorry');
			
		//	$this->form_validation->set_rules('operator_type', 'Recharge Type', 'required|trim');
		//	$this->form_validation->set_rules('recharge_no', '10 digit Recharge Number', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'trim');
		

			if($this->form_validation->run() == true)
			{
				$insert = $this->billpay_model->billpay_request();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Please Proceed for Payment...!!!');
					redirect(base_url('billpay/recharge_payments'));
				}
			}
		}
		theme('recharge_dth', $data);
	}	
	
/**
* Postpaid Service Screen Input
*/
/**
* Postpaid Service Screen Input
*/

	public function Postpaid_mobile(){
		//restricted this area, only for admin
	//	permittedArea();
	//	$data['wallet']  	 	= $this->ledger_model->totalWallet();
	//	$data['usedwallet']  	= $this->ledger_model->usedWallet();		
		//$data['convertWallet']  = $this->ledger_model->convertWallet();
		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();		
		
		$data['users'] = $this->db->order_by('id', 'asce')->get_where('services', ['service_type' => 'Postpaid Mobile']);	
		$data['circle'] = $this->db->order_by('c_id', 'desc')->get('circles');	
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'Postpaid_mobile') die('Error! sorry');
			
		//	$this->form_validation->set_rules('operator_type', 'Recharge Type', 'required|trim');
		//	$this->form_validation->set_rules('recharge_no', '10 digit Recharge Number', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'trim');
		

			if($this->form_validation->run() == true)
			{
				$insert = $this->billpay_model->billpay_request();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Please Proceed for Payment...!!!');
					redirect(base_url('billpay/recharge_payments'));
				}
			}
		}
		theme('Postpaid_mobile', $data);
	}	
/**
* Postpaid Service Screen Input
*/

	public function Electricity(){
		//restricted this area, only for admin
	//	permittedArea();
	//	$data['wallet']  	 	= $this->ledger_model->totalWallet();
	//	$data['usedwallet']  	= $this->ledger_model->usedWallet();		
		//$data['convertWallet']  = $this->ledger_model->convertWallet();
		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();		
		
		$data['users'] = $this->db->order_by('operator', 'asce')->get('operators');	
		$data['circle'] = $this->db->order_by('c_id', 'desc')->get('circles');	
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'Electricity') die('Error! sorry');
			
		//	$this->form_validation->set_rules('operator_type', 'Recharge Type', 'required|trim');
		//	$this->form_validation->set_rules('recharge_no', '10 digit Recharge Number', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'trim');
		

			if($this->form_validation->run() == true)
			{
				$insert = $this->billpay_model->billpay_request();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Please Proceed for Payment...!!!');
					redirect(base_url('billpay/recharge_payments'));
				}
			}
		}
		theme('Electricity', $data);
	}	

/**
	 * recharge_paymentListJson list from db 'billpay_request'
	 * @return Json format
	 * usable only via API
	 */

	public function recharge_paymentListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->billpay_model->recharge_PaymentListCount();
		$query = $this->billpay_model->recharge_PaymentList($limit, $start);

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
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('billpay/process_recharge/'. $r->id).'"  data-toggle="modal" data-target="#myModal1"  data-toggle="tooltip" title="View"> Proceed for Payment
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('user/profile_edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
		//				<i class="fa fa-edit"></i> </a>';
		//	$button .= $blockUnblockBtn;
		
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
				$button,
				$r->sms_no,
				$r->service_category, //$r->payee_name,
				
				//$payspec = paytypeDbTableRow($r->pay_type)->name, //Anand
				number_format($r->amount, 2) ,				
		
						
				$statusBtn,			
				
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

	public function recharge_payments()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('recharge_payments');
	}

	public function process_recharge($id){
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

		$data['users'] = singleDbTableRow($id, 'billpay_request');

		//Service Type
						if($this->input->post()) 
													{
													//	if ($this->input->post('submit') != 'add_agent1') die('Error! sorry');
													
														if ($this->input->post('submit1') == 'add_agent1'); // die('Error! sorry');
														{
															
															$this->form_validation->set_rules('otp', 'SMS OTP password ', 'required');

															if($this->form_validation->run() == true)
															{
																$sellProduct = $this->billpay_model->payee_transfer($id);
																if($sellProduct){
																setFlashGoBack('successMsg', 'Recharge Successfull...!!!');
																		redirect(base_url('Account'));
																}
																else{
																	setFlashGoBack('errorMsg', 'Bill Pay went wrong! please try again later.');
																	redirect(base_url('Account'));
																}
														
															}
														}
													}	
																									
									
		theme('process_recharge', $data);

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
		create_activity("Deleted {$id} from Billpay Request");
		//Now delete permanently
		$this->db->where('id', $id)->delete('billpay_request');
		return true;
	}
	
	
	
	public function billpay_status()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('billpay_status');
	}
	/**
	 * billpay_statusListJson list from db 'billpay_status'
	 * @return Json format
	 * usable only via API
	 */

	public function billpay_statusListJson(){
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->billpay_model->billpay_statusListCount();
		$query = $this->billpay_model->billpay_statusList($limit, $start);

	//	$queryCount = $this->billpay_model->recharge_PaymentListCount();
	//	$query = $this->billpay_model->recharge_PaymentList($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
if($query -> num_rows() > 0) 
{	foreach($query->result() as $r){
				
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('billpay/process_recharge/'. $r->id).'" data-toggle="modal" data-target="#myModal"  data-toggle="tooltip" title="View"> Proceed for Payment
						<i class="fa fa-eye"></i> </a>';
		
			$data['data'][] = array(
				//$button,
					'<a  href="'.base_url('billpay/billpay_status_view/'. $r->id).'">'.$r->status,
				'<a  href="'.base_url('billpay/billpay_status_view/'. $r->id).'">'.$r->number,
				//'<a  href="'.base_url('billpay/billpay_status_view/'. $r->id).'">'.$r->error_code,					
				'<a  href="'.base_url('billpay/billpay_status_view/'. $r->id).'">'.$r->operator,				
				'<a  href="'.base_url('billpay/billpay_status_view/'. $r->id).'">'.$r->amount,					
				'<a  href="'.base_url('billpay/billpay_status_view/'. $r->id).'">'.$r->usertxn,
					'<a  href="'.base_url('billpay/billpay_status_view/'. $r->id).'">'.$r->operator_ref
				
			);
		}
}
		else{
			$data['data'][] = array(
				'No Records on your Recharge or Bill Payments' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);
	}	
/*Bill Pay Status View */
public function billpay_status_view($id){
		//restricted this area, only for admin
	//	permittedArea();
		$data['billpay'] = singleDbTableRow($id,'billpay_status');
	
		theme('billpay_status_view', $data);
		
		
		
		}
		
		
		
		
		
		
	public function view_billpaystatus($id)
	{
		//restricted this area, only for admin
		//permittedArea();
		
		$data['billpay_status'] = singleDbTableRow($id,'billpay_status');
	
		theme('view_billpaystatus', $data);
	}	
	
}//last brace required
 ?>