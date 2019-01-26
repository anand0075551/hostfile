<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('category_model');
		$this->load->model('ledger_model');
		$this->load->model('product_model');
$this->load->model('notification_model');
		check_auth(); //check is logged in.
	}

	public function index()	{
		//restricted this area, only for admin
		permittedArea();

		theme('category_index');
	}

		/**
	 * Voucher Category add method
	 *
	 */

	public function add_category(){
		//restricted this area, only for admin
		permittedArea();

		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_category') die('Error! sorry');

			//$this->form_validation->set_rules('acct_id', 'Main Account', 'required|trim');
			$this->form_validation->set_rules('sub_acct_id', 'Sub-Accounts', 'required|trim');
			//$this->form_validation->set_rules('to_role', 'Role Name', 'required|trim');
			$this->form_validation->set_rules('voucher_name', 'Coupon/Voucher Name', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			$this->form_validation->set_rules('start_date', 'Start date', 'required|trim');			
			$this->form_validation->set_rules('commission', 'Commission Percentage', 'required|trim');
			$this->form_validation->set_rules('benefits', 'Benefits Percentage', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->category_model->add_category();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Voucher Category Created Successfully...!!!');
					redirect(base_url('category'));
				}
			}
		}


		theme('add_category');
	}
/**
	 * Accounts Category add method
	 *
	 */

	public function add_acct_category(){
		//restricted this area, only for admin
		permittedArea();

		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_acct_category') die('Error! sorry');

			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->category_model->add_acct_category();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Accounts Category Created Successfully...!!!');
					redirect(base_url('category/payspec_list'));
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
				$insert = $this->category_model->add_acct_sub_category();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Sub-Accounts Created under Category Successfully...!!!');
					redirect(base_url('category/payspec_list'));
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
	
	
	

//Edit Acc Sub Category/ Pay Specification
public function edit_payspec($id){
		//restricted this area, only for admin
		permittedArea();
			//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		if($user['role'] == 'admin')
		{
			$data['category'] = singleDbTableRow($id,'acct_categories');
		}
		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_payspec') die('Error! sorry');

			
			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
			$this->form_validation->set_rules('visible', 'Access To Payspecifications', 'required|trim');
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->category_model->edit_payspec($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Sub-Accounts Updated Successfully...!!!');
					redirect(base_url('category/payspec_list'));
				}
			}
		}

		theme('edit_payspec', $data);
	}	
	

	/**
	 * Agent list from db
	 * @return Json format
	 * usable only via API
	 */

	public function categoryListJson(){  //Wallet Ratio
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->category_model->categoryListCount();
		$query = $this->category_model->categoryList();
		/* $query = $this->db->query("select categories.*, users.first_name, users.last_name
				from categories LEFT JOIN users
				ON categories.added_by = users.id ORDER BY categories.id DESC Limit {$start}, {$limit}");*/

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
if($query->num_rows() > '0')
{
		foreach($query->result() as $r){

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('category/view_ratio/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
		//	$button .= '<a class="btn btn-info editBtn"  href="'.base_url('category/edit_ratio/'. $r->id).'" data-toggle="tooltip" title="Edit">
					//	<i class="fa fa-edit"></i> </a>';
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';

			$data['data'][] = array(
			    $button,
				$r->identity_id,
				'1:'.$r->alpha,
				'1:'.$r->beta,
				//date('d/m/Y h:i A', $r->created_at), //date format
				date( $r->start_date), //date format
				
				 $r->end_date //date format
				//$r->first_name.' '.$r->last_name,
				
			);
		}
}
	else{
			$data['data'][] = array (
			'Category is not yet Created' , '', '','', '','','', '');
		}
		echo json_encode($data);

	}


	public function edit($id){
		//restricted this area, only for admin
		permittedArea();

		$data['category'] = singleDbTableRow($id,'categories');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_category') die('Error! sorry');

			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
			$this->form_validation->set_rules('commission_percent', 'Commission', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->category_model->edit_category($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Category Updated Success');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}

		theme('edit_category', $data);
	}


	/**
	 * This isApi for deleting an agent
	 */

	public function deleteAjax(){ 
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'categories');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$categoryName} Category");
		//Now delete permanently
		$this->db->where('id', $id)->delete('categories');
		return true;
	}
	/**
	 * This isApi for deleting an agent
	 */

	public function delete_ratioAjax(){ 
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'points_ratio');
		$remarks = $userInfo->remarks;
		// add a activity
		create_activity("Deleted {$remarks} points_ratio");
		//Now delete permanently
		$this->db->where('id', $id)->delete('points_ratio');
		return true;
	}
	
	
	/**
	 * Create alpha, beta & gamma Points Ratio 
	 * order: wallet, loyality, discount
	 */

	public function points_ratio(){
		//restricted this area, only for admin
		permittedArea();

		if($this->input->post())
		{
			if($this->input->post('submit') != 'points_ratio') die('Error! sorry');

			$this->form_validation->set_rules('remarks', 'Description for New Change', 'required|trim');
			$this->form_validation->set_rules('start_date', 'Effective Start Date', 'required|trim');
			$this->form_validation->set_rules('alpha', 'Alpha Ratio', 'required|trim');
			$this->form_validation->set_rules('beta',  'Beta Ratio',  'required|trim');
			$this->form_validation->set_rules('gamma', 'Gamma Ratio', 'trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->category_model->points_ratio();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'New Points Ratio Created Successfully...!!!');
					redirect(base_url('category'));
				}
			}
		}
			theme('points_ratio');
	}
	
	//call function to view table page
	public function view_ratio($id){
		
		permittedArea();
		$data['points_ratio'] = singleDbTableRow($id,'points_ratio');
		
		theme('view_ratio', $data);
	}
	/**
	 * Mainatain Loyality and Discount Points Ratio 
	 *
	 */

	public function edit_ratio($id){
		//restricted this area, only for admin
		permittedArea();
			//$data['convertWallet']  = $this->ledger_model->convertWallet();
			$data['points_ratio'] = singleDbTableRow($id,'points_ratio');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_ratio') die('Error! sorry');

			$this->form_validation->set_rules('remarks', 'Description for New Change', 'required|trim');
			$this->form_validation->set_rules('start_date', 'Effective Start Date', 'required|trim');
			$this->form_validation->set_rules('alpha', 'Alpha Ratio', 'required|trim');
			$this->form_validation->set_rules('beta',  'Beta Ratio',  'required|trim');
			$this->form_validation->set_rules('gamma', 'Gamma Ratio', 'trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->category_model->edit_ratio($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Points Ratio Updated Successfully...!!!');
					redirect(base_url('category'));
				}
			}
		}
			theme('edit_ratio', $data);
	}
	
		/**
	 * Conver wallet_2dicount Points based on Points Ratio Table
	 *
	 */

	public function user_values_conversion(){
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
			if($this->input->post('submit') != 'wallet_to_discount') die('Error! sorry');
			
			$this->form_validation->set_rules('conv_type', 'Conversion Method', 'required|trim');
			$this->form_validation->set_rules('amount', 'Cash/Wallet', 'required|trim');
			$this->form_validation->set_rules('trans_type', 'Transaction Method', 'required|trim');
			$this->form_validation->set_rules('tranx_id', 'Transaction/Remarks', 'required|trim');
			//$this->form_validation->set_rules('loyality', 'Loyality Ratio', 'trim');
			//$this->form_validation->set_rules('discount', 'Discount Ratio', 'trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->category_model->wallet_to_discount();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Successfully Converted Your Selected Values ...!!!');
					redirect(base_url('category/user_values_conversion'));
				}
			}
		}
		theme('user_values_conversion', $data);
	}

/*********************************************************************************************************************/	
	public function payspec_list(){
		//restricted this area, only for admin
		permittedArea();
			
			
		theme('payspec_list');
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
			if($r->parentid != '0' )
			{
				 if ($r->visible == '0')
				 {
					 $visble = 'Admin';
				 }elseif ($r->visible == '1')
				 {
					  $visble = 'Agents';
				  }elseif ($r->visible == '2')
				  {
					   $visble = 'Consumers';
				  }
				  if ($r->ledger_type == '0')
				  {
					  $ledger_type = 'Incoming';
				  }elseif ($r->ledger_type == '1')
				  {
					  $ledger_type = 'Outgoing';
				  }
			//Action Button
			$button = '';
		//	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('ledger/payspec_view/'. $r->id).'" data-toggle="tooltip" title="View">
			//			<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-info editBtn"  href="'.base_url('category/edit_payspec/'. $r->id).'" data-toggle="tooltip" title="Edit">
						<i class="fa fa-edit"></i> </a>';
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
	
			$data['data'][] = array(
			   $button,
		       
				// $name= singleDbTableRow($r->added_by)->first_name
				$visble,
				 	
				 // $r->parentid,				
				$ledger_type,	

				$pay_spec = ledgerDbTableRow($r->parentid)->name,		
			$r->id,
				 $r->name
					 
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

}
