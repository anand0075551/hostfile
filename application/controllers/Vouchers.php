<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vouchers extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('vouchers_model');
		$this->load->model('product_model');
		$this->load->model('ledger_model');
		check_auth(); //check is logged in.
	}

		/*General/Private Voucher Index */
	public function index()
	{
		//restricted this area, only for admin
		//permittedArea();

		theme('vouchers_index');
		
	}
	
		/*Business Voucher Index */
	public function business_voucher_index(){
		//restricted this area, only for admin
	//	permittedArea();
	
		theme('business_voucher_index');
	}
	
			/*Business Voucher Eligible List*/
	public function vouchers_eligible(){
		//restricted this area, only for admin
	//	permittedArea();
	
		theme('vouchers_eligible');
	}
	
		/*Check PIN status Index */
	public function check_pin_status(){
		//restricted this area, only for admin
	//	permittedArea();
	
		theme('check_pin_status');
	}
	/**
	 * Admin Business Vouchers add method
	 *
	 */

	public function add_vouchers(){
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
			
		}
		
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_vouchers') die('Error! sorry');

			$this->form_validation->set_rules('voucher_name', 'Voucher Name', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'trim'); 			
			$this->form_validation->set_rules('acct_id', 'Main Account', 'required|trim'); 		
			$this->form_validation->set_rules('sub_acct_id', 'Sub-Accounts Type', 'required|trim'); 
			$this->form_validation->set_rules('start_date', 'Voucher Start Date', 'required|trim'); 			
			$this->form_validation->set_rules('to_role', 'Client Role', 'required|trim'); 	
			//$this->form_validation->set_rules('commission', 'Commission Percentage', 'required|trim'); 
			//$this->form_validation->set_rules('benefits', 'Benefits Percentage', 'required|trim'); 
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->vouchers_model->add_vouchers();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Vouchers Created Successfully...!!!');
					redirect(base_url('vouchers/business_voucher_index'));
				}
			}
		}


		theme('add_vouchers', $data);
	}
	
	/**
	 * User Splitting Vouchers add method
	 *
	 */

	public function split_vouchers($id){
		//restricted this area, only for admin
	//	permittedArea();
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();	
		
		$data['accounts'] = singleDbTableRow('accounts');
		$data['commissions'] = singleDbTableRow($id,'commissions');
		$data['users'] = $this->db->get_where('users', ['role' => 'user']); 	
		
		
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		if($user['role'] == 'admin')
		{
			$data['main_account'] = $this->db->get_where('acct_categories', ['category_type' => 'main']);
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
			
			$where_array = array ('active'=>'1');
			$data['roles']		  = $this->db->get_where('users', $where_array);
			
		}
		
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'split_vouchers') die('Error! sorry');

			$this->form_validation->set_rules('voucher_name', 'Voucher Name', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'trim'); 			
			$this->form_validation->set_rules('acct_id', 'Main Account', 'required|trim'); 		
			$this->form_validation->set_rules('sub_acct_id', 'Sub-Accounts Type', 'required|trim'); 
			$this->form_validation->set_rules('start_date', 'Voucher Start Date', 'required|trim'); 			
			$this->form_validation->set_rules('to_role', 'Client Role', 'required|trim'); 	
			$this->form_validation->set_rules('beneficiary', 'Commission Percentage', 'required|trim'); 
			//$this->form_validation->set_rules('benefits', 'Benefits Percentage', 'required|trim'); 
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->vouchers_model->split_vouchers();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Split Vouchers Created Successfully...!!!');
					redirect(base_url('vouchers'));
				}
			}
		}


		theme('split_vouchers', $data);
	}
	
	/**
	 * User's Future Trading
	 * Adnavce Booking Vouchers
	 */

	public function advance_book_vouchers(){
		//restricted this area, only for admin
	//	permittedArea();
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		if($user['role'] == 'admin')
		{
			$data['main_account'] = $this->db->get_where('acct_categories', ['category_type' => 'main']);
			$data['sub_account']  = $this->db->get_where('acct_categories', ['category_type' => 'sub']);
			
			$where_array = array ('type'=>'role_name', 'active'=>'1');
			$data['roles']		  = $this->db->get_where('role', $where_array);
			
		}
		
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_reserve_ticket') die('Error! sorry');


					
			
			$this->form_validation->set_rules('sub_acct_id', 'Sub-Accounts Type', 'required|trim'); 
							
			$this->form_validation->set_rules('voucher_name', 'Voucher Name', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'trim'); 	
			$this->form_validation->set_rules('start_date', 'Voucher Start Date', 'required|trim'); 			

			

			if($this->form_validation->run() == true)
			{
				$insert = $this->vouchers_model->add_reserve_ticket();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Ticket Reserved Successfully...!!!');
					redirect(base_url('vouchers'));
				}
			}
		}


		theme('advance_book_vouchers', $data);
	}
	
	/**
	 * Private Vouchers PIN Create method
	 *
	 */

	public function create_vouchers($id){
		//restricted this area, only for admin
		//permittedArea();
		$data['total_wallet']			= $this->ledger_model->total_wallet();
		$data['total_wallet_debit']		= $this->ledger_model->total_wallet_debit();
		$data['total_wallet_credit']	= $this->ledger_model->total_wallet_credit();
		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();		
		
		$data['accounts'] = singleDbTableRow('accounts');
		$data['commissions'] = singleDbTableRow($id,'commissions');
		$data['users'] = $this->db->get_where('users', ['role' => 'user']); 	
		
			//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
			$data['client'] = $this->db->order_by('id', 'desc')->get_where('users', ['active' => '1']);	
		
		
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'create_vouchers') die('Error! sorry');
			
			
			$this->form_validation->set_rules('voucher_name', 'Voucher Name', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim'); 	
			$this->form_validation->set_rules('trans_type', 'Payment Mode', 'required|trim'); 				
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->vouchers_model->create_vouchers();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Vouchers PIN Created Successfully...!!!');
					redirect(base_url('vouchers'));
				}
			}
		}


		theme('create_vouchers', $data);
	}
	
	/**
	 * Create Private Vouchers PIN 
	 *
	 */

	public function private_vouchers(){
		//restricted this area, only for admin
		//permittedArea();
	
		
		$data['voc_debit']  	= $this->ledger_model->total_voucher_debit();
		$data['voc_credit']  	= $this->ledger_model->total_voucher_credit();
			
		
		$data['accounts'] = singleDbTableRow('accounts');
		
			//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		if($user['role'] == 'admin')
		{
			$data['voucher'] = $this->db->get_where('commissions', ['transferrable' => 'yes']); 
			
		}elseif($user['role'] == 'agent')
		{
			$data['voucher'] = $this->db->get_where('commissions', ['transferrable' => 'yes']);
			$data['private_vouchers'] = $this->db->get_where('vouchers', ['created_by' => $userID]);
			
		}elseif($user['role'] == 'user')
		{
			$data['voucher'] = $this->db->get_where('commissions', ['transferrable' => 'yes']);
			$data['private_vouchers'] = $this->db->get_where('vouchers', ['created_by' => $userID]);
		}
		
		
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'private_vouchers') die('Error! sorry');
			
			
			$this->form_validation->set_rules('voucher_name', 'Voucher Name', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim'); 			
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->vouchers_model->private_vouchers();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Personal Vouchers PIN Created Successfully...!!!');
					redirect(base_url('vouchers'));
				}
			}
		}


		theme('private_vouchers', $data);
	}
	
	/**
	 * Generate Vouchers(Display)
	 *
	 */

	public function generate_vouchers($id){
	//restricted this area, only for admin
	//	permittedArea();
		$data['total_wallet']			= $this->ledger_model->total_wallet();
		$data['total_wallet_debit']		= $this->ledger_model->total_wallet_debit();
		$data['total_wallet_credit']	= $this->ledger_model->total_wallet_credit();

		$data['commissions'] = singleDbTableRow($id,'commissions');
		//$data2['vouchers'] = singleDbTableRow($id,'vouchers');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'generate_vouchers') die('Error! sorry');

			$this->form_validation->set_rules('acct_id', 'Main Account', 'trim');
			$this->form_validation->set_rules('sub_acct_id', 'Sub-Accounts', 'trim');
			$this->form_validation->set_rules('to_role', 'Role Name', 'trim');
			$this->form_validation->set_rules('voucher_name', 'Coupon/Voucher Name', 'trim');
			$this->form_validation->set_rules('amount', 'Amount', 'trim');
			$this->form_validation->set_rules('start_date', 'Start date', 'trim');			
			$this->form_validation->set_rules('end_date', 'End Date', 'trim');	
			$this->form_validation->set_rules('commission', 'Commission Percentage', 'trim');
			$this->form_validation->set_rules('benefits', 'Benefits Percentage', 'trim');			

			if($this->form_validation->run() == true)
			{
				$insert = $this->vouchers_model->generate_vouchers($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Vouchers PIN ID Created Successfully...!!!');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}

		theme('generate_vouchers', $data);
	}

	/**
	 * General/Private Voucher list from db
	 * @return Json format
	 * usable only via API
	 */

	public function vouchersListJson(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->vouchers_model->vouchersListCount();
		$query = $this->vouchers_model->vouchersList($limit, $start);
	

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		IF ($query -> num_rows() > '0' )
		{
		foreach($query->result() as $r){
		$today_date = date("Y-m-d"); 
			if ($r->start_date > $today_date)
				{
						//Action Button
						$button = '';
						$button .= '<a class="btn btn-primary editBtn" href="'.base_url('vouchers/voucher_view/'. $r->id).'" data-toggle="tooltip" title="View">
									<i class="fa fa-eye"></i> </a>';
					
						$data['data'][] = array(
							$button,
							singleDbTableRow($r->voucher_name, 'status')->status,
							$r->voucher_id,
						//	number_format($r->amount, 2) ,
						//	$r->start_date,	 					
							$r->end_date		
						
							
						);
				}
		}
}
		else{
			$data['data'][] = array(
			'Vouchers are not available as on Today!' , '', '','', '','','', '');
		}

		echo json_encode($data);

	}
	
	/**
	 * Matured Vouchers Availble for redeem
	 */

	public function eligible_vouchersListJson(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->vouchers_model->vouchersListCount();
		$query = $this->vouchers_model->vouchersList($limit, $start);
	

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		IF ($query -> num_rows() > '0' )
		{
			foreach($query->result() as $r)
			{
		
			$today_date = date("Y-m-d"); 
			if ($r->start_date <= $today_date)
				{
					
					
					//Action Button
					$button = '';
					$button .= '<a class="btn btn-primary editBtn" href="'.base_url('vouchers/voucher_view/'. $r->id).'" data-toggle="tooltip" title="View">
								<i class="fa fa-eye"></i> </a>';
				
					$data['data'][] = array(
						$button,
						singleDbTableRow($r->voucher_name, 'status')->status,
						$r->voucher_id,
					//	number_format($r->amount, 2) ,
					//	$r->start_date,						
						$r->end_date		
					
						
					);
				}
			}
		}
		else{
			$data['data'][] = array(
			'Matured Vouchers are not available as on Today' , '', '','', '','','', '');
		}

		echo json_encode($data);

	}
	/**
	 * Secrete PIN Voucher list from db
	 * @return Json format
	 * usable only via API
	 */

	public function secretePinListJson(){
		
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

		$queryCount = $this->vouchers_model->vouchersListCount();
		$query = $this->vouchers_model->vouchersList($limit, $start);
	

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
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('vouchers/voucher_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			//$button .= '<a class="btn btn-info editBtn"  href="'.base_url('vouchers/edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
				//		<i class="fa fa-edit"></i> </a>';
			//$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
			//			<i class="fa fa-trash"></i> </a>';
	

			$data['data'][] = array(
				$button,
				'<a  href="'.base_url('vouchers/voucher_view/'. $r->id).'">'.$r->epin,					
				'<a  href="'.base_url('vouchers/voucher_view/'. $r->id).'">'.$r->type,	
				'<a  href="'.base_url('vouchers/voucher_view/'. $r->id).'">'.$r->voucher_name,
				'<a  href="'.base_url('vouchers/voucher_view/'. $r->id).'">'.$r->amount,
				'<a  href="'.base_url('vouchers/voucher_view/'. $r->id).'">'.$r->points_mode,	
				'<a  href="'.base_url('vouchers/voucher_view/'. $r->id).'">'.$r->used		
			//	'<a  href="'.base_url('vouchers/voucher_view/'. $r->id).'">'.$r->first_name.' '.$r->last_name,			
				
			);
		//}
		}
		}
		else{
			$data['data'][] = array (
			'Secrete PIN Vouchers are not Available' , '', '','', '','','', '');
		}

		echo json_encode($data);

	}
 /**
	 * This isApi for deleting an Private Voucher
	 */

	public function voucherDeleteAjax($id){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'vouchers');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$remarks} vouchers");
		//Now delete permanently
		$this->db->where('id', $id)->delete('vouchers');
		return true;
		
		theme('edit_vouchers', $data);
	}		
	//VoucherPINListjson
	
	public function vouchersPINListJson(){
		
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

		$queryCount = $this->vouchers_model->vouchersPINListCount();
		$query = $this->vouchers_model->vouchersPINList($limit, $start);
	

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		IF ($query -> num_rows() > '0' )
		{
		foreach($query->result() as $r){
			if ($r->identity == 'Voucher'){
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('vouchers/voucher_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			//$button .= '<a class="btn btn-info editBtn"  href="'.base_url('vouchers/edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
				//		<i class="fa fa-edit"></i> </a>';
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
	


			$data['data'][] = array(
				$r->remarks,	
				$r->amount,
				$r->start_date,	
				//$r->sub_acct_id,
				$r->commission,	
				//$r->benefits,		
				//$r->first_name.' '.$r->last_name,			
				$button
			);
		}}
		}
		else{
			$data['data'][] = array (
			'Commission details are not Available to you Account' , '', '','', '','','', '');
		}

		echo json_encode($data);

	}
	public function edit($id){
		//restricted this area, only for admin
	//	permittedArea();

		$data['commissions'] = singleDbTableRow($id,'commissions');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_vouchers') die('Error! sorry');

			$this->form_validation->set_rules('voucher_name', 'Coupon/Voucher Name', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			$this->form_validation->set_rules('start_date', 'Start date', 'required|trim');			
			$this->form_validation->set_rules('end_date', 'End Date', 'trim');	
			$this->form_validation->set_rules('commission', 'Commission Percentage', 'required|trim');
			$this->form_validation->set_rules('benefits', 'Benefits Percentage', 'required|trim');			

			if($this->form_validation->run() == true)
			{
				$insert = $this->vouchers_model->edit_vouchers($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Vouchers Updated Successfully...!!!');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}

		theme('edit_vouchers', $data);
	}

/**
	 * General/Private Voucher list from db
	 * @return Json format
	 * usable only via API
	 */

	public function businessVouchersListJson(){
		
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

		$queryCount = $this->vouchers_model->businessVouchersListCount();
		$query = $this->vouchers_model->businessVouchersList($limit, $start);
	

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
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('vouchers/business_voucher_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			//$button .= '<a class="btn btn-info editBtn"  href="'.base_url('vouchers/edit/'. $r->id).'" data-toggle="tooltip" title="Edit">
				//		<i class="fa fa-edit"></i> </a>';
				if ($currentUser == 'admin'){
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}

			$data['data'][] = array(
				$button,
				$r->type,					
				$r->remarks,	
				$r->amount,
				$r->transferrable,
				$r->start_date	
					
				
			);
		//}
		}
		}
		else{
			$data['data'][] = array (
			'Vouchers are not Available to your Account' , '', '','', '','','', '');
		}

		echo json_encode($data);

	}	
/*Business Voucher View */
public function business_voucher_view($id){
		//restricted this area, only for admin
	//	permittedArea();
	
	
	
	$data['total_wallet']			= $this->ledger_model->total_wallet();
		$data['total_wallet_debit']		= $this->ledger_model->total_wallet_debit();
		$data['total_wallet_credit']	= $this->ledger_model->total_wallet_credit();
		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();		
		
		$data['accounts'] = singleDbTableRow('accounts');		
		$data['users'] = $this->db->get_where('users', ['role' => 'user']); 	
		
		
		$data['commissions'] = singleDbTableRow($id,'commissions');
	
		theme('business_voucher_view', $data);
	}

/*Voucher View */
public function voucher_view($id){
		//restricted this area, only for admin
	//	permittedArea();
		$data['vouchers'] = singleDbTableRow($id,'vouchers');
	
		theme('voucher_view', $data);
	}

	/**
	 * This isApi for deleting an agent
	 */

	public function deleteAjax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'commissions');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$remarks} commissions");
		//Now delete permanently
		$this->db->where('id', $id)->delete('commissions');
		return true;
	}

 
	
	
	public function voucher_edit($id){
		//restricted this area, only for admin
		permittedArea();

		$data['commissions'] = singleDbTableRow($id,'commissions');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_vouchers') die('Error! sorry');

		//	$this->form_validation->set_rules('acct_id', 'Main Account', 'required|trim');
		//	$this->form_validation->set_rules('sub_acct_id', 'Sub-Accounts', 'required|trim');
		//	$this->form_validation->set_rules('to_role', 'Role Name', 'required|trim');
			$this->form_validation->set_rules('voucher_name', 'Coupon/Voucher Name', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			$this->form_validation->set_rules('start_date', 'Start date', 'required|trim');			
			$this->form_validation->set_rules('end_date', 'End Date', 'trim');	
			$this->form_validation->set_rules('commission', 'Commission Percentage', 'required|trim');
			$this->form_validation->set_rules('benefits', 'Benefits Percentage', 'required|trim');			

			if($this->form_validation->run() == true)
			{
				$insert = $this->vouchers_model->edit_vouchers($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Vouchers Updated Successfully...!!!');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}

		theme('edit_vouchers', $data);
	}



// Transfer Vouchers..........
	
	
	public function transfer_vouchers(){
		
		if($this->input->post('submit') == 'transfer') {

			$this->form_validation->set_rules('to_user', 'Transfer To', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->vouchers_model->transfer_voucher();	
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Vouchers Transfered Successfuly..!');
					redirect(base_url('vouchers/transferred_vouchers'));
				}	
			}
		}
		
		theme('transferrable_vouchers');
	}
	public function transferrable_vouchers_listjson(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->vouchers_model->transferrable_vouchers_ListCount();
		$query = $this->vouchers_model->transferrable_vouchers_List($limit, $start);
	

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		if ($query -> num_rows() > '0' )
		{
		foreach($query->result() as $r){
		$today_date = date("Y-m-d"); 
			
						//Action Button
						$button = '';
						$button .= '<a class="btn btn-primary editBtn btn-sm" href="'.base_url('vouchers/voucher_view/'. $r->id).'" data-toggle="tooltip" title="View">
									<i class="fa fa-eye"></i> </a>';
					
						$data['data'][] = array(
							$button,
							singleDbTableRow($r->voucher_name, 'status')->status,
							$r->voucher_description,
							$r->voucher_id,
							number_format($r->amount, 2) ,
							$r->start_date,						
							$r->end_date		
						
							
						);
				
		}
}
		else{
			$data['data'][] = array(
			'Vouchers are not available as on Today!' , '', '','', '','','');
		}

		echo json_encode($data);

	}
	
	public function voucher_transfer($id){
		
		$data['voucher'] = $this->db->get_where('vouchers', ['voucher_id'=>$id]);
		theme('transfer_vouchers', $data);
	}
	
		public function getuser()
	{
		$pay_to = $_POST['pay_to'];
		
		$query = $this->db->get_where('users', ['rolename'=>$pay_to]);
		$user = "<option value=''>Choose Option</option>";
		foreach($query->result() as $r)
		{
			$user.= "<option value='".$r->id."'>".$r->referral_code."-".$r->first_name." ".$r->last_name."</option>";
        
	   }
	   echo $user;
	
	}
	
	public function transferred_vouchers(){
		theme('transferred_vouchers');
	}
	public function transferred_vouchers_listjson(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->vouchers_model->transferred_vouchers_ListCount();
		$query = $this->vouchers_model->transferred_vouchers_List($limit, $start);
	

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		if ($query -> num_rows() > '0' )
		{
		foreach($query->result() as $r){
		$today_date = date("Y-m-d"); 
			
		//Action Button
		$button = '';
		$button .= '<a class="btn btn-primary editBtn btn-sm" href="'.base_url('vouchers/voucher_view/'. $r->id).'" data-toggle="tooltip" title="View">
					<i class="fa fa-eye"></i> </a>';
		
		$transferred_to = singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name;	
		
		$data['data'][] = array(
			$button,
			$r->voucher_description,
			$r->voucher_id,
			number_format($r->amount, 2) ,
			$r->start_date,						
			$r->end_date,		
			$transferred_to		
		);
				
		}
}
		else{
			$data['data'][] = array(
			'Vouchers are not transfrred yet!' , '', '','', '','','', '');
		}

		echo json_encode($data);

	}

	
// Voucher Report.................	
	
	public function all_voucher_report(){
		theme('all_vouchers');
	}
	
	
	public function all_vouchers_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$role   = singleDbTableRow($user_id)->rolename;
		
		
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->vouchers_model->all_vouchers_ListCount();
		$query = $this->vouchers_model->all_vouchers_List($limit, $start);
	

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		if ($query -> num_rows() > 0 )
		{
		foreach($query->result() as $r){
		$today_date = date("Y-m-d"); 
			
		//Action Button
		$button = '';
		$button .= '<a class="btn btn-primary editBtn btn-sm" href="'.base_url('vouchers/voucher_details/'. $r->id).'" data-toggle="tooltip" title="View">
					<i class="fa fa-eye"></i> </a>';
		
		if($r->transferred_to != 0){
			$transferred_to = singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name;	
		}
		else{
			$transferred_to = "Not Transferred Yet.";
		}
		if($r->used_by != 0){
			$used_by = singleDbTableRow($r->used_by)->first_name." ".singleDbTableRow($r->used_by)->last_name;	
		}
		else{
			if($r->transferred_to != 0){
				if(singleDbTableRow($r->transferred_to)->gender == 'male'){
					$used_by = "Transferred to ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name.",<br> But not used by him yet.";
				}
				elseif(singleDbTableRow($r->transferred_to)->gender == 'female'){
					$used_by = "Transferred to ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name.",<br> But not used by her yet.";
				}
				else{
					$used_by = "Transferred to ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name.",<br> But not used yet.";
				}
			}
			else{
				$used_by = "Not Used Yet";
			}
			
		}
		
		
		if($role == 11){
			$data['data'][] = array(
				$button,
				singleDbTableRow($r->user_id)->first_name." ".singleDbTableRow($r->user_id)->last_name,
				$r->email,
				$r->account_no,
				singleDbTableRow($r->voucher_name, 'status')->status,
				$r->voucher_id,
				number_format($r->amount, 2) ,
				$r->start_date,						
				$r->end_date,	
				$r->transferrable,	
				$transferred_to,	
				$r->used,	
				$used_by	
			);
		}
		else{
			$data['data'][] = array(
				$button,
				singleDbTableRow($r->voucher_name, 'status')->status,
				$r->voucher_id,
				number_format($r->amount, 2) ,
				$r->start_date,						
				$r->end_date,
				$r->transferrable,	
				$transferred_to,
				$r->used,	
				$used_by	
			);
		}
		
		
				
		}
}
		else{
			$data['data'][] = array(
			'Vouchers are not available as on Today!' , '', '','', '','','', '');
		}

		echo json_encode($data);

	}
	
	public function voucher_report_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$role   = singleDbTableRow($user_id)->rolename;
		
		$voc_type = $_POST['voc_type'];
		$maturation_type = $_POST['maturation_type'];
		$usage = $_POST['usage'];
		$transfarable = $_POST['transfarable'];
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];
		
		
	
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		
		
	
		$query = $this->vouchers_model->voucher_search($limit, $start, $voc_type, $maturation_type, $usage, $transfarable, $from_date, $to_date);
	
		echo ' 	<thead>
				<tr>
					<th width="8%">Action</th>';
				if($role == 11){
					echo '<th>Voucher Owner</th> ';
				}	
			echo	'<th>Voucher Type</th>       
					<th>Name</th>       										
					<th>Value</th>										
					<th>Valid From</th>	
					<th>Valid Till</th>	
					<th>Transferrable</th>											
					<th>Transferred To</th>											
					<th>Used</th>											
					<th>Used By</th>
				</tr>
				</thead>
				<tbody>';
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
				$button .= '<a class="btn btn-primary editBtn btn-sm" href="'.base_url('vouchers/voucher_details/'. $r->id).'" data-toggle="tooltip" title="View">
					<i class="fa fa-eye"></i> </a>';
					
					
				if($r->transferred_to != 0){
			$transferred_to = singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name;	
		}
		else{
			$transferred_to = "Not Transferred Yet.";
		}
		if($r->used_by != 0){
			$used_by = singleDbTableRow($r->used_by)->first_name." ".singleDbTableRow($r->used_by)->last_name;	
		}
		else{
			if($r->transferred_to != 0){
				if(singleDbTableRow($r->transferred_to)->gender == 'male'){
					$used_by = "Transferred to ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name.",<br> But not used by him yet.";
				}
				elseif(singleDbTableRow($r->transferred_to)->gender == 'female'){
					$used_by = "Transferred to ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name.",<br> But not used by her yet.";
				}
				else{
					$used_by = "Transferred to ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name.",<br> But not used yet.";
				}
			}
			else{
				$used_by = "Not Used Yet";
			}
			
		}
					
					
				echo ' <tr>
						<td>'.$button.'</td>';
				if($role == 11){
					echo '<td>'.singleDbTableRow($r->user_id)->first_name." ".singleDbTableRow($r->user_id)->last_name.'</td> ';
				}	
			echo	'<td>'.singleDbTableRow($r->voucher_name, 'status')->status.'</td>
						<td>'.$r->voucher_id.'</td>
						<td>'.number_format($r->amount, 2).'</td>
						<td>'.$r->start_date.'</td>
						<td>'.$r->end_date.'</td>
						<td>'.$r->transferrable.'</td>
						<td>'.$transferred_to.'</td>
						<td>'.$r->used.'</td>
						<td>'.$used_by.'</td>
					</tr>';
				
				}
		}
		else
		{
			echo '<tr><td colspan="2">No results found</td></tr>';
		}
		echo ' 	<tbody>
				<tfoot>
				<tr>
					<th>Action</th>';
				if($role == 11){
					echo '<th>Voucher Owner</th> ';
				}	
			echo	'<th>Voucher Type</th>       
					<th>Name</th>       										
					<th>Value</th>										
					<th>Valid From</th>	
					<th>Valid Till</th>	
					<th>Transferrable</th>											
					<th>Transferred To</th>											
					<th>Used</th>											
					<th>Used By</th>
				</tr>
				</tfoot>';
	

	}
	
	public function voucher_details($id){
		$data['vouchers'] = singleDbTableRow($id,'vouchers');
	
		theme('voucher_details', $data);
	}
	
	public function get_voc_name(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$voc_type = $_POST['voc_type'];
		echo "<option value=''>Choose option</option>";
		$get_voc_name = $this->db->group_by('voucher_description')->get_where('vouchers', ['voucher_name'=>$voc_type, 'user_id' =>$user_id, 'transferrable'=>'yes']);
		if($get_voc_name->num_rows() > 0){
			foreach($get_voc_name->result() as $voc_name){
				echo "<option value='".$voc_name->voucher_description."'>".$voc_name->voucher_description."</option>";
			}
		}
	}
	
	public function get_vouchers(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$voc_name = $_POST['voc_name'];
		echo "<option value=''>Choose option</option>";
		$get_vouchers = $this->db->get_where('vouchers', ['voucher_description'=>$voc_name, 'user_id' =>$user_id, 'transferrable'=>'yes', 'transferred_to'=>'0', 'paid_by'=>'0']);
		if($get_vouchers->num_rows() > 0){
			foreach($get_vouchers->result() as $voc_name){
				echo "<option value='".$voc_name->id."'>".$voc_name->voucher_id." (".number_format($voc_name->amount,2).")</option>";
			}
		}
	}
	
}
