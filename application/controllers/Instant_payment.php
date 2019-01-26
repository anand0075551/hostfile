<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instant_payment extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('instant_payment_model');
		$this->load->model('product_model');
		$this->load->model('ledger_model');
		$this->load->model('vouchers_model');
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
	

	
	
	
/************************************************************************************/
// * Pay wallet Approval
/************************************************************************************/

	
	
	public function instant_payment()
	{
		
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$rolename = singleDbTableRow($userID)->rolename;
		$role     = singleDbTableRow($userID)->role;
		if($rolename == '39' or $rolename == '21' or $role == 'admin')
		{
		
	//	permittedArea();
	
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
			if($this->input->post('submit') != 'receive_fund') die('Error! sorry');
			
			$this->form_validation->set_rules('business_type', 'Payspecification', 'required');
			$this->form_validation->set_rules('referredByCode', 'Consumer Code', 'required|trim');
			if($this->form_validation->run() == true)
			{
				$insert = $this->instant_payment_model->make_instant_payment();
				if($insert)
				{								
					$this->session->set_flashdata('successMsg', 'Payment Completed Successfully...!');
					redirect(base_url('instant_payment/index'));					
				}

			}
			
		}
		
		
		
		theme('instant_payment',$data);
	}
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
?>