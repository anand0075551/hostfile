<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('product_model');
		$this->load->model('ledger_model');
		check_auth(); //check is logged in.
	}

	/**
	 * Listing all product
	 */

	public function index()
	{
		//restricted this area, only for admin
	//	permittedArea();

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
}
?>