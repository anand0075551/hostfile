<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Courier extends CI_Controller {
function __construct(){
parent:: __construct();
$this->load->model('notification_model');
$this->load->model('courier_model');
$this->load->model('earning_model');
$this->load->model('ledger_model');
$this->load->model('product_model');
$this->load->model('Bank_model');
check_auth(); //check is logged in.
}
		public function index()
				{
					//Visible only for Admin
					//  permittedArea();
					theme('courier_index');
				}

				
						public function cms_dashboard()
				{
					//Visible only for Admin
					//  permittedArea();
					theme('cms_dashboard');
				}
				
				
		public function add_courier()
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


		$data['wal_debit']      = $this->ledger_model->total_wallet_debit();
		$data['wal_credit']     = $this->ledger_model->total_wallet_credit();
		$data['loy_debit']      = $this->ledger_model->total_loyality_debit();
		$data['loy_credit']     = $this->ledger_model->total_loyality_credit();
		$data['dis_debit']      = $this->ledger_model->total_discount_debit();
		$data['dis_credit']     = $this->ledger_model->total_discount_credit();



		//permittedArea();

		$data['country'] = $this->db->group_by('country')->get('pincode');
		$data['user_Details'] = $this->db->get('users');
		//  $data['pincode'] = $this->db->get('pincode');
		$data['shipment_cost'] = $this->db->get('cms_shipment_cost');
		if($this->input->post())
		{
				if($this->input->post('submit') != 'add_courier') die('Error! sorry');
				$this->form_validation->set_rules('shipper_name', 'Shipper Name', 'trim|required');
				$this->form_validation->set_rules('shipper_phone', 'Shipper Phone', 'trim|required');
				$this->form_validation->set_rules('shipper_pincode', 'Shipper Pincode', 'trim|required');
				$this->form_validation->set_rules('reciever_name', 'Receiver Name', 'trim|required');
				$this->form_validation->set_rules('reciever_phone', 'Receiver Phone', 'trim|required');
				$this->form_validation->set_rules('reciever_pincode', 'Shipper Pincode', 'trim|required');
				$this->form_validation->set_rules('shipment_type', 'Shipmeny Type');
			//	$this->form_validation->set_rules('cost', 'Shipmeny Cost');





				$id     = $this->input->post('shipper_name');

				$sender_referral_code = singleDbTableRow($id)->referral_code;

				$get_user = $this->db->get_where('users', ['id' => $id]);
				foreach($get_user->result() as $user)
				{
						$user_acc_no = $user->account_no;
				}
				$user_debit = $this->db->select_sum('debit')->get_where('accounts', ['points_mode'=>'wallet', 'account_no' =>$user_acc_no]);
				foreach( $user_debit->result()      as $user_debit);
				$users_debit            = $user_debit->debit;
				// sum of credit
				$user_credit = $this->db->select_sum('credit')->get_where('accounts', ['points_mode'=>'wallet', 'account_no' =>$user_acc_no]);;
				foreach( $user_credit->result()     as $user_credit);
				$users_credit       = $user_credit->credit;

				$user_balance       = ( $users_debit - $users_credit ) ; //Available balance
				$biz_id = 5;
				
				
				
				
				$cost = $this->input->post('cost');
					
					if($cost == '')
					{
						$amount = '0' ;
						}
					else {$amount = $cost ;}
						
				if($user_balance < $amount)
				{
					//echo "Please increase Your Balance..!";
					$this->session->set_flashdata('errorMsg', 'Please increase Your CPA Balance..!');
					redirect(base_url('courier/add_courier'));
				}
				else{
				if($this->form_validation->run() == true)
				{       $biz_id = 5;
						$pay_by_referral_code   =   $sender_referral_code;  // Sender's referral_code, ex : 5559990001
						$pay_to_referral_code   =   singleDbTableRow($biz_id,'business_groups')->payment_reciever;// Receiver's referral_code, ex : 5164830972
						$amount_to_pay          =   $amount;            // Total amont to pay (or) transfer, ex : 100
						$pay_spec_type          =   singleDbTableRow($biz_id,'business_groups')->pay_type;                 // Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
						$transaction_remarks    =   $this->input->post('comments'); // remarks to insert into invoice table, ex : "Transfer Values";
						$pm_mode                =   'wallet';           // points_mode, ex : wallet, loyality, discount.


						$make_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);

						$insert = $this->courier_model->add_courier();
						if($insert && $make_payment)
						{
							$this->session->set_flashdata('successMsg', 'Courier Added Successfully');
							redirect(base_url('courier'));
						}
						}
				}
		}


		theme('add_courier',$data);
}
public function add_shipment_cost() {
	//permittedArea();
	$data['pincode'] = $this->db->get('pincode');
$data['country'] = $this->db->group_by('country')->get('pincode');
	if ($this->input->post()) {
		if ($this->input->post('submit') != 'add_shipment_cost')
		die('Error! sorry');
		$this->form_validation->set_rules('weight', 'weight', 'trim|required');
		$this->form_validation->set_rules('from_pincode', 'From Pincode', 'trim|required');
		$this->form_validation->set_rules('to_pincode', 'To Pincode', 'trim|required');
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required');

		if ($this->form_validation->run() == true) {
			$insert = $this->courier_model->add_shipment_cost();
			if ($insert) {
			$this->session->set_flashdata('successMsg', 'Shipment Cost Added Successfully');
			redirect(base_url('courier/shipment_cost_list'));
			}
		}
	}
	theme('add_shipment_cost', $data);
}
public function edit_courier($cid) {
	// permittedArea();
	
	$data['pincode'] = $this->db->get('pincode');
	$data['courier'] = singleDbTableRow1($cid, 'cms_courier');
	$data['courier_Details'] = $this->db->get_where('cms_courier', ['cid' => $cid]);
	if ($this->input->post()) {
		if ($this->input->post('submit') != 'edit_courier')
		die('Error! sorry');
		$this->form_validation->set_rules('weight', 'weight', 'trim|required');
		$this->form_validation->set_rules('quantity', 'quantity', 'trim|required');
				
				
				$id     = $this->input->post('shipper_name');

				$sender_referral_code = singleDbTableRow($id)->referral_code;

				$get_user = $this->db->get_where('users', ['id' => $id]);
				foreach($get_user->result() as $user)
				{
						$user_acc_no = $user->account_no;
				}
				$user_debit = $this->db->select_sum('debit')->get_where('accounts', ['points_mode'=>'wallet', 'account_no' =>$user_acc_no]);
				foreach( $user_debit->result()      as $user_debit);
				$users_debit            = $user_debit->debit;
				// sum of credit
				$user_credit = $this->db->select_sum('credit')->get_where('accounts', ['points_mode'=>'wallet', 'account_no' =>$user_acc_no]);;
				foreach( $user_credit->result()     as $user_credit);
				$users_credit       = $user_credit->credit;

				$user_balance       = ( $users_debit - $users_credit ) ; //Available balance
				$biz_id = 5;
				
				
				
				
				$cost = $this->input->post('shipping_cost');
					
					if($cost == '')
					{
						$amount = '0' ;
						}
					else {$amount = $cost ;}
						
				if($user_balance < $amount)
				{
					//echo "Please increase Your Balance..!";
					$this->session->set_flashdata('errorMsg', 'Please increase Your CPA Balance..!');
					redirect(base_url('courier/edit_courier'));
				}
				else{
						if($this->form_validation->run() == true){
				        $biz_id = 5;
						$pay_by_referral_code   =   $sender_referral_code;  // Sender's referral_code, ex : 5559990001
						$pay_to_referral_code   =   singleDbTableRow($biz_id,'business_groups')->payment_reciever;// Receiver's referral_code, ex : 5164830972
						$amount_to_pay          =   $amount;            // Total amont to pay (or) transfer, ex : 100
						$pay_spec_type          =   singleDbTableRow($biz_id,'business_groups')->pay_type;                 // Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
						$transaction_remarks    =   'Consumer at deliver Center Payment/ Successfully Pickup of Courier'; // remarks to insert into invoice table, ex : "Transfer Values";
						$pm_mode                =   'wallet';           // points_mode, ex : wallet, loyality, discount.


						$make_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);
			$insert = $this->courier_model->edit_courier($cid);
			if ($insert && $make_payment) {
				$this->session->set_flashdata('successMsg', 'Courier Updated Successfully...!!!');
				redirect(base_url('courier'));
			}
		}
	}
	}
	theme('edit_courier',$data);
}
public function edit_courier_cost($id) {
		// permittedArea();
		$data['country'] = $this->db->group_by('country')->get('pincode');
		$data['pincode'] = $this->db->get('pincode');
		$data['courier'] = singleDbTableRow($id, 'cms_shipment_cost');
		//          $data['courier_Details'] = $this->db->get_where('shipment_cost', ['id' => $id]);
		if ($this->input->post()) {
		if ($this->input->post('submit') != 'edit_courier_cost')
		die('Error! sorry');
		$this->form_validation->set_rules('weight', 'weight', 'trim|required');

		if ($this->form_validation->run() == true) {
			$insert = $this->courier_model->edit_courier_cost($id);
			if ($insert) {
				$this->session->set_flashdata('successMsg', 'Courier Updated Successfully...!!!');
				redirect(base_url('courier'));
			}
			}
		}
		theme('edit_courier_cost',$data);
}

	public function get_business_name()
	{
		$biz_id = $_POST['biz_id'];
		$query = $this->db->get_where('business_groups', ['id'=>$biz_id]);
		foreach($query->result() as $biz){
			echo "<input type='hidden' id='biz_name' value='".$biz->business_name."'>";
		}
	}

/**
* referral_paymentListJson list from db
* @return Json format
* usable only via API
*/
		public function view_courier($id){
				//restricted this area, only for admin
				//permittedArea(['admin', 'agent']);

				//Get Decision who in online?
				$user = loggedInUserData();
				$userID = $user['user_id'];


				$data['addcourier'] = $this->db->get_where('cms_courier', ['id' => $id]);

				theme('view_courier', $data);
		}
	public function my_courier_status($id)
	{

		$data['cid'] = $this->db->get_where('cms_courier', ['cons_no' => $id]);

		theme('my_courier_status',$data);
	}




public function update_status($id)
{
		//restricted this area, only for admin
		//permittedArea();

		$data['country'] = $this->db->group_by('country')->get('pincode');


		
		$data['cid'] = $this->db->order_by('id', 'asc')->get_where('cms_courier_status', ['cons_no' => $id]);




		if($this->input->post())
		{
		if($this->input->post('submit') != 'update_status') die('Error! sorry');
		$this->form_validation->set_rules('new_status', 'Status', 'required|trim');
		$this->form_validation->set_rules('pincode', 'pincode', 'required|trim');


		if($this->form_validation->run() == true)
		{
		$insert = $this->courier_model->update_status();
		if($insert)
		{
		$this->session->set_flashdata('successMsg', 'Courier status updated Successfully!');
							
							$user_info = $this->session->userdata('logged_user');
							$user_id = $user_info['user_id'];
							$currentUser = singleDbTableRow($user_id)->role;
							$rolename = singleDbTableRow($user_id)->rolename;
							if($rolename != 26){ 
							redirect(base_url('courier'));
							}
							 else {
							redirect(base_url('courier/pending_courier_list'));
							
							 } 
		}
		}
		}
		theme('update_status',$data);
}

		public function courier_delivered()
		{
			//Visible only for Admin
			//  permittedArea();
			theme('courier_delivered');
		}      
		public function shipment_delivery()
		{
			//Visible only for Admin
			//  permittedArea();
			theme('shipment_delivery');
		}
		public function courier_ListJson2(){

		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$queryCount = $this->courier_model->courier_ListCount2();
		$query = $this->courier_model->courier_List2($limit, $start);
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0)
		{   foreach($query->result() as $r){


				//Action Button
				$button = '';
				$user_info = $this->session->userdata('logged_user');
				$user_id = $user_info['user_id'];
				$currentRolename   = singleDbTableRow($user_id)->rolename;
				if ($currentRolename == '28')  {

					$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/view_couriers/'. $r->cid).'" data-toggle="tooltip" title="View">
					<i class="fa fa-eye"></i> </a>';

				}
				$query2 = $this->db->get_where('users', ['id' => $r->ship_name,]);
				if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
						$un = $row2->first_name." ".$row2->last_name;
				}
				} else {
					$un =  "No Data";
				}
			
				$query3 = $this->db->get_where('status', ['id' => $r->status,]);
				if ($query3->num_rows() > 0) {
					foreach ($query3->result() as $row3) {
						$status = $row3->status;
				}
				} else {
					$status =  "No Data";
				}
			
			
			  		$get_time = $this->db->get_where('cms_deliver', ['cid'=>$r->cons_no]);
		if($get_time->num_rows() > 0){
			foreach($get_time->result() as $t){
				$date_time = date('d M, Y h:i:s A', $t->assigned_at);
			}
		}
		else{
			$date_time = "Not Assigned Yet";
		}
				$data['data'][] = array(
				$button,
				$r->cons_no,
				$un,
				$r->rev_name,
				$status,
				$date_time

				);
		}
		}
		else{
				$data['data'][] = array(
				'No Data Available' , '', '','','',''
				);

		}
		echo json_encode($data);
		}
public function courier_ListJson3(){

		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$queryCount = $this->courier_model->courier_ListCount3();
		$query = $this->courier_model->courier_List3($limit, $start);
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0)
		{   foreach($query->result() as $r){


		//Action Button
		$button = '';
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentRolename   = singleDbTableRow($user_id)->rolename;
		if ($currentRolename == '28')  {

				$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/view_couriers/'. $r->cid).'" data-toggle="tooltip" title="View">
				<i class="fa fa-eye"></i> </a>';

		}

		$button .= '<a class="btn btn-danger editBtn"  href="'.base_url('courier/delivered_succesful/'. $r->cid).'" data-toggle="modal" data-target="#myModal" title="Courier delivered">Deliver
		<i class="fa fa-truck" ></i> </a>';

		$query2 = $this->db->get_where('users', ['id' => $r->ship_name,]);
		if ($query2->num_rows() > 0) {
		foreach ($query2->result() as $row2) {
				$un = $row2->first_name." ".$row2->last_name;
		}
		} else {
			$un =  " ";
		}
	//	 $date_time   =   singleDbTableRows1($r->cid,'cms_deliver')->assigned_at;
		$get_time = $this->db->get_where('cms_deliver', ['cid'=>$r->cons_no]);
		if($get_time->num_rows() > 0){
			foreach($get_time->result() as $t){
				$date_time = date('d M, Y h:i:s A', $t->assigned_at);
			}
		}
		else{
			$date_time = "Not Assigned Yet";
		}
		
		$query3 = $this->db->get_where('status', ['id' => $r->status,]);
				if ($query3->num_rows() > 0) {
					foreach ($query3->result() as $row3) {
						$status = $row3->status;
				}
				} else {
					$status =  "No Data";
				}
				
		$data['data'][] = array(
		$button,
		$r->cons_no,
		$un,
		$r->rev_name,

		$status,
		$date_time
		);
		}
}
else{
$data['data'][] = array(
'No Data Available' , '', '','', '', ''
);

}
echo json_encode($data);
}

	public function uniqueSmsCodeApi(){

		$user_info = $this->session->userdata('logged_user');
		$user_user_id = $user_info['user_id'];
		$user_referral_code = singleDbTableRow($user_user_id)->referral_code;

		$referredByCode = $this->input->post('referredByCode');
		$cons_no = $this->input->post('cons_no');
		if ($referredByCode != $user_referral_code )
		{
			$query = $this->db->get_where('cms_delivery_status', ['otp' => $referredByCode, 'cid' => $cons_no]);
			if($query->num_rows() > 0 )
			{

				$return = 'true';

			}else{
				$return = 'false';
			}
		}
		echo $return;
	}


	public function uniqueSmsCodeApi1(){

	$user_info = $this->session->userdata('logged_user');
	$user_user_id = $user_info['user_id'];
	$user_referral_code = singleDbTableRow($user_user_id)->referral_code;

	$referredByCode1 = $this->input->post('referredByCode1');
	$cons_no = $this->input->post('cons_no');
	if ($referredByCode1 != $user_referral_code )
	{
		$query = $this->db->get_where('cms_delivery_status', ['otp' => $referredByCode1, 'cid' => $cons_no]);
		if($query->num_rows() > 0 )
		{

			$return = 'true';

		}else{
				$return = 'false';
		}
	}
	echo $return;
	}

	
	
	
		public function uniqueSmsCodeApi2(){

	$user_info = $this->session->userdata('logged_user');
	$user_user_id = $user_info['user_id'];
	$user_referral_code = singleDbTableRow($user_user_id)->referral_code;

	$referredByCode2 = $this->input->post('referredByCode2');
	$cons_no = $this->input->post('cons_no');
	if ($referredByCode2 != $user_referral_code )
	{
		$query = $this->db->get_where('cms_delivery_status', ['otp' => $referredByCode2, 'cid' => $cons_no]);
		if($query->num_rows() > 0 )
		{

			$return = 'true';

		}else{
				$return = 'false';
		}
	}
	echo $return;
	}
	
	
public function assign_deliveryboy()
{

		//restricted this area, only for admin
		//permittedArea();

		$data['pincode'] = $this->db->get('pincode');

		if($this->input->post())
		{
		if($this->input->post('submit') != 'assign_deliveryboy') die('Error! sorry');
			$this->form_validation->set_rules('delivery_boy', 'Deliveryboy', 'required|trim');


			if($this->form_validation->run() == true)
			{
				$insert = $this->courier_model->assign_deliveryboy();
			if($insert)
			{
				$this->session->set_flashdata('successMsg', "Delivery Executive Assigned");
				redirect(base_url('courier'));
			}
			}
		}
		theme('assign_deliveryboy',$data);
}




	public function courier_tracking()
	{
		//restricted this area, only for admin
		//permittedArea();
		theme('courier_tracking');
	}

		public function courier_track_ListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$queryCount = $this->courier_model->courier_track_ListCount();

		$query = $this->courier_model->courier_List($limit, $start);
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0)
		{
		foreach($query->result() as $r){

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/view_track/'. $r->id).'" data-toggle="tooltip" title="View">
			<i class="fa fa-eye"></i> </a>';
			/*$button .= '<a class="btn btn-info editBtn"  href="'.base_url('add_shipment/edit_shipment/'. $r->id).'" data-toggle="tooltip" title="Edit">
			<i class="fa fa-edit"></i> </a>';
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
			<i class="fa fa-trash"></i> </a>'; */

			$data['data'][] = array(
			$button,
			$r->cons_no,
			$r->current_city,
			$r->status,
			$r->comments,
			$r->bk_time
			);
		}
		}else{
		$data['data'][]=array(
			'You have no Data' ,'','','','',''
		);
		}
			echo json_encode($data);
		}

		public function view_track($id){
			//restricted this area, only for admin
			permittedArea();

			$data['courier_track_Details'] = $this->db->get_where('tbl_courier_track', ['id' => $id]);

			theme('view_track', $data);
		}
//------------------------------------------------------------------------------------------
	public function courier_details()
	{
		//restricted this area, only for admin
		//permittedArea();
		theme('courier_details');
	}

		public function courier_ListJson(){
			
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentRolename   = singleDbTableRow($user_id)->rolename;


		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$queryCount = $this->courier_model->courier_ListCount();

		$query = $this->courier_model->courier_D_List($limit, $start);
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0)
		{
		foreach($query->result() as $r){


			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/view_couriers/'. $r->cid).'" data-toggle="tooltip" title="View">
			<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-warning editBtn" href="'.base_url('courier/my_courier_status/'. $r->cons_no).'" data-toggle="modal" data-target="#myModal" title="View">
			<i class="fa fa-truck"></i> Track</a>';


			if ($currentRolename != '26')  {
			$button .= '<a class="btn btn-success editBtn" href="'.base_url('courier/add_receiver/'. $r->cid).'" title="View">
			<i class="fa fa-user"></i>Receiver</a>';
			}


			$query = $this->db->get_where('users', ['id' => $r->assigned_to,]);
			if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
			$pm = $row->first_name." ".$row->last_name;
			}
			} else {
			$pm =  " ";
			}

			$query2 = $this->db->get_where('users', ['id' => $r->ship_name,]);
			if ($query2->num_rows() > 0) {
			foreach ($query2->result() as $row2) {
					$un = $row2->first_name." ".$row2->last_name;
			}
			} else {
				$un =  " ";
			}
			
			$query3 = $this->db->get_where('status', ['id' => $r->status,]);
			if ($query3->num_rows() > 0) {
			foreach ($query3->result() as $row3) {
					$status = $row3->status;
			}
			} else {
				$status =  "NO DATA";
			}
			
				$data['data'][] = array(
				$button,
				$r->cons_no,
				$status,
				'<b>Name:</b>'.$un.'<br><b>Number:</b>'.$r->phone.'<br><b>Address:</b>'.$r->s_add,
				'<b>Name:</b>'.$r->rev_name.'<br><b>Number:</b>'.$r->r_phone.'<br><b>Address:</b>'.$r->r_add,
				$r->book_date,
				$pm

			);
			//  }

			}
		}else{
		$data['data'][]=array(
		'You have no Data' ,'','','','','',''
		);
		}
		echo json_encode($data);
		}

	public function pickup_assigned_shipment_list()
	{
		//restricted this area, only for admin
		//permittedArea();
		theme('pickup_assigned_shipment_list');
	}
		public function pickup_assigned_shipment_ListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$queryCount = $this->courier_model->pickup_assigned_shipment_ListCount();

		$query = $this->courier_model->pickup_assigned_shipment_D_List($limit, $start);
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0)
		{
		foreach($query->result() as $r){

				//Action Button
				$button = '';
				$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/view_couriers/'. $r->cid).'" data-toggle="tooltip" title="View">
				<i class="fa fa-eye"></i> </a>';
				$button .= '<a class="btn btn-warning editBtn" href="'.base_url('courier/my_courier_status/'. $r->cons_no).'" data-toggle="modal" data-target="#myModal" title="View">
				<i class="fa fa-truck"></i> Track</a>';


				$query = $this->db->get_where('users', ['id' => $r->assigned_to,]);
				if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
				$pm = $row->first_name." ".$row->last_name;
				}
				} else {
				$pm =  " ";
				}

				$query2 = $this->db->get_where('users', ['id' => $r->ship_name,]);
				if ($query2->num_rows() > 0) {
				foreach ($query2->result() as $row2) {
				$un = $row2->first_name." ".$row2->last_name;
				}
				} else {
				$un =  " ";
				}
				$data['data'][] = array(
				$button,
				$r->cons_no,
				$r->status,
				$un,
				$r->phone,
				$r->r_add,
				$r->book_date,
				$pm

				);
				//  }

				}
		}else{
			$data['data'][]=array(
			'You have no Data' ,'','','','','','',''
			);
		}
		echo json_encode($data);
		}





	public function in_transit_shipment_list()
	{
		//restricted this area, only for admin
		//permittedArea();
		theme('in_transit_shipment_list');
	}
		public function in_transit_shipment_ListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$queryCount = $this->courier_model->in_transit_shipment_ListCount();

		$query = $this->courier_model->in_transit_shipment_D_List($limit, $start);
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0)
		{
		foreach($query->result() as $r){


			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/view_couriers/'. $r->cid).'" data-toggle="tooltip" title="View">
			<i class="fa fa-eye"></i> </a>';
			$button .= '<a class="btn btn-warning editBtn" href="'.base_url('courier/my_courier_status/'. $r->cons_no).'" data-toggle="modal" data-target="#myModal" title="View">
			<i class="fa fa-truck"></i> Track</a>';


			$query = $this->db->get_where('users', ['id' => $r->assigned_to,]);
			if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$pm = $row->first_name." ".$row->last_name;
			}
			} else {
				$pm =  " ";
			}

			$query2 = $this->db->get_where('users', ['id' => $r->ship_name,]);
			if ($query2->num_rows() > 0) {
			foreach ($query2->result() as $row2) {
			$un = $row2->first_name." ".$row2->last_name;
		}
		} else {
		$un =  " ";
		}
		$data['data'][] = array(
		$button,
		$r->cons_no,
		$r->status,
		$un,
		$r->phone,
		$r->r_add,
		$r->book_date,
		$pm

		);
		//  }

		}
		}else{
			$data['data'][]=array(
			'You have no Data' ,'','','','','','',''
			);
		}
			echo json_encode($data);
		}

		public function pickup_successful_shipment_list()
		{
			//restricted this area, only for admin
			//permittedArea();
			theme('pickup_successful_shipment_list');
		}
		public function pickup_successful_shipment_ListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$queryCount = $this->courier_model->pickup_successful_shipment_ListCount();

		$query = $this->courier_model->pickup_successful_shipment_D_List($limit, $start);
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0)
		{
		foreach($query->result() as $r){


		//Action Button
		$button = '';
		$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/view_couriers/'. $r->cid).'" data-toggle="tooltip" title="View">
		<i class="fa fa-eye"></i> </a>';
		$button .= '<a class="btn btn-warning editBtn" href="'.base_url('courier/my_courier_status/'. $r->cons_no).'" data-toggle="modal" data-target="#myModal" title="View">
		<i class="fa fa-truck"></i> Track</a>';


		$query = $this->db->get_where('users', ['id' => $r->assigned_to,]);
		if ($query->num_rows() > 0) {
		foreach ($query->result() as $row) {
		$pm = $row->first_name." ".$row->last_name;
		}
		} else {
		$pm =  " ";
		}

		$query2 = $this->db->get_where('users', ['id' => $r->ship_name,]);
		if ($query2->num_rows() > 0) {
		foreach ($query2->result() as $row2) {
		$un = $row2->first_name." ".$row2->last_name;
		}
		} else {
		$un =  " ";
		}
		$data['data'][] = array(
		$button,
		$r->cons_no,
		$r->status,
		$un,
		$r->phone,
		$r->r_add,
		$r->book_date,
		$pm

		);
		//  }

		}
		}else{
			$data['data'][]=array(
			'You have no Data' ,'','','','','','',''
			);
			}
		echo json_encode($data);
		}

	public function delivery_assigned_shipment_list()
	{
		//restricted this area, only for admin
		//permittedArea();
		theme('pickup_successful_shipment_list');
	}
		public function delivery_assigned_shipment_ListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$queryCount = $this->courier_model->delivery_assigned_shipment_ListCount();

		$query = $this->courier_model->delivery_assigned_shipment_D_List($limit, $start);
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0)
		{
				foreach($query->result() as $r){


				//Action Button
				$button = '';
				$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/view_couriers/'. $r->cid).'" data-toggle="tooltip" title="View">
				<i class="fa fa-eye"></i> </a>';
				$button .= '<a class="btn btn-warning editBtn" href="'.base_url('courier/my_courier_status/'. $r->cons_no).'" data-toggle="modal" data-target="#myModal" title="View">
				<i class="fa fa-truck"></i> Track</a>';
				//  $button .= $blockUnblockBtn;



				$query = $this->db->get_where('users', ['id' => $r->assigned_to,]);
				if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
				$pm = $row->first_name." ".$row->last_name;
				}
				} else {
				$pm =  " ";
				}

				$query2 = $this->db->get_where('users', ['id' => $r->ship_name,]);
				if ($query2->num_rows() > 0) {
				foreach ($query2->result() as $row2) {
				$un = $row2->first_name." ".$row2->last_name;
				}
				} else {
				$un =  " ";
				}
				$data['data'][] = array(
				$button,
				$r->cons_no,
				$r->status,
				$un,
				$r->phone,
				$r->r_add,
				$r->book_date,
				$pm

				);
				//  }

				}
		}else{
			$data['data'][]=array(
			'You have no Data' ,'','','','','','',''
		);
		}
		echo json_encode($data);
		}



		public function view_couriers($cid){
			//restricted this area, only for admin
			//  permittedArea();
			$data['courier_Details'] = $this->db->get_where('cms_courier', ['cid' => $cid]);
			theme('view_couriers', $data);
		}
//--------------------------Delivery Status----------------------------------------------------------------
	public function delivery_status()
	{
		//restricted this area, only for admin
		//permittedArea();
		theme('delivery_status');
	}

		public function delivery_ListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$queryCount = $this->courier_model->delivery_ListCount();

		$query = $this->courier_model->delivery_List($limit, $start);
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0)
		{
		foreach($query->result() as $r){

		//Action Button
		$button = '';
		$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/view_deliver/'. $r->id).'" data-toggle="tooltip" title="View">
		<i class="fa fa-eye"></i> </a>';


		$d_boy = $r->generated_by;
		$query = $this->db->get_where('users', ['id'=>$d_boy]);
		foreach($query->result() as $d)
		{
		$delivery_boy = $d->first_name.' '.$d->last_name;
		$delivery_ph = $d->contactno;
		$delivery_add = $d->street_address;
		}

		$data['data'][] = array(
		$button,
		$r->cid,
		$r->reciever_name,
		$delivery_boy,
		$delivery_ph,
		$delivery_add,
		$r->owner_name,
		$r->status,
		date("d M, Y",$r->generated_at)
		);
		}
		}else{
		$data['data'][]=array(
		'You have no Data' ,'','','','','','','',''
		);
		}
		echo json_encode($data);
		}

	public function view_deliver($id){
		//restricted this area, only for admin
		permittedArea();

		$data['delivery_status_list'] = $this->db->get_where('cms_delivery_status', ['id' => $id]);
		theme('view_deliver', $data);
	}
	public function view_shipment_cost($id){
		//restricted this area, only for admin
		//  permittedArea();

		$data['cost'] = $this->db->get_where('cms_shipment_cost', ['id' => $id]);
		theme('view_shipment_cost', $data);
	}
//--------------------------Courier Status----------------------------------------------------------------
		public function courier_status()
		{
			//restricted this area, only for admin
			//permittedArea();
			theme('courier_status');
		}

public function courier_st_ListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$queryCount = $this->courier_model->courier_st_ListCount();

		$query = $this->courier_model->courier_st_List($limit, $start);
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0)
		{
		foreach($query->result() as $r){

			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/courier_status_view/'. $r->id).'" data-toggle="tooltip" title="View">
			<i class="fa fa-eye"></i> </a>';


			$data['data'][] = array(
			$button,
			$r->cons_no,
			$r->current_pincode,
			$r->receiver_pincode,
			$r->current_location,
			$r->receiver_location,
			$r->status,
			$r->modified_at
			);
		}
		}else{
			$data['data'][]=array(
			'You have no Data' ,'','','','','','',''
			);
		}
		echo json_encode($data);
}

		public function courier_status_view($id){
				//restricted this area, only for admin
				permittedArea();

				$data['delivery_status'] = $this->db->get_where('cms_courier_status', ['id' => $id]);

				theme('courier_status_view', $data);
		}

public function save_otpauth()
{
		$cons_no = $_POST['cons_no'];
		$phone = $_POST['phone'];
		$ship_name = $_POST['ship_name'];
		
		$stsotp = $this->courier_model->save_otpauth($cons_no, $phone, $ship_name );
		if($stsotp == true){
				echo "Otp sent Successfully..!";
		}
}
public function save_otp()
{
		$cons_no = $_POST['cons_no'];
		$phone = $_POST['phone'];
		$ship_name = $_POST['ship_name'];
		$type = $_POST['type'];
		$receiver_pincode = $_POST['receiver_pincode'];
		$r_add = $_POST['r_add'];
		$name = $_POST['name'];
		$receiver_phone = $_POST['receiver_phone'];
		$relation = $_POST['relation'];
		$status = $_POST['status'];
		$referredByCode = $_POST['referredByCode'];
		$comment = $_POST['comment'];
		//echo $cons_no;
		$sts = $this->courier_model->save_otp($cons_no, $phone, $ship_name, $type, $receiver_pincode, $r_add, $name, $receiver_phone, $relation, $status, $referredByCode, $comment );
		if($sts == true){
				echo "Otp sent Successfully..!";
		}
}
public function save_otp_others()
{

		$cons_no = $_POST['cons_no'];
		$phone = $_POST['phone'];
		$ship_name = $_POST['ship_name'];
		$type = $_POST['type'];

		$id_number = $_POST['id_number'];
		$id_type = $_POST['id_type'];
		$receiver_pincode = $_POST['receiver_pincode'];
		$r_add = $_POST['r_add'];
		$name = $_POST['name'];
		$receiver_phone = $_POST['receiver_phone'];
		$relation = $_POST['relation'];
		$status = $_POST['status'];
		$referredByCode = $_POST['referredByCode'];
		$comment = $_POST['comment'];
		//  echo $cons_no;
		$sts = $this->courier_model->save_otp_others($cons_no, $phone, $ship_name, $type,$id_number, $id_type, $receiver_pincode, $r_add, $name, $receiver_phone, $relation, $status, $referredByCode, $comment );
		if($sts == true){
				echo "Otp sent Successfully..!";
		}
}

public function pending_courier_list()
{

//$data['tid'] = $this->db->get_where('ticket_list', ['ticket_no' => $id]);

theme('pending_courier_list');
}




		public function pendingListJson(){
				$limit = $this->input->get('length');
				$start = $this->input->get('start');
				$queryCount = $this->courier_model->dpendingListCount();

				$query = $this->courier_model->dpendingList($limit, $start);
				$draw = $this->input->get('draw');
				$data = [];
				$data['draw'] = $draw;
				$data['recordsTotal'] = $queryCount;
				$data['recordsFiltered'] = $queryCount;
				if($query -> num_rows() > 0)
				{
				foreach($query->result() as $r){


						if($r->status !=  "18" && $r->status != "15")
						{
								//Action Button
								$button = '';
								$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/view_couriers/'. $r->cid).'" data-toggle="tooltip" title="View">
								<i class="fa fa-eye"></i> </a>';


								$user_info = $this->session->userdata('logged_user');
								$user_id = $user_info['user_id'];
								$currentRolename   = singleDbTableRow($user_id)->rolename;
								if ($currentRolename == '11' || $currentRolename == '27')  {



								}
								$button .= '<a class="btn btn-warning editBtn" href="'.base_url('courier/my_courier_status/'. $r->cons_no).'" data-toggle="modal" data-target="#myModal" title="View">
								<i class="fa fa-truck"></i> Track</a>';

								$query = $this->db->get_where('pincode', ['id' => $r->shipper_pincode]);

								if ($query->num_rows() > 0) {
									foreach ($query->result() as $row) {
									$pincode =  $row->pincode;
									}
								} else {
										$pincode =  " ";
								}
								
							$query2 = $this->db->get_where('status', ['id' => $r->status]);

								if ($query2->num_rows() > 0) {
									foreach ($query2->result() as $row2) {
									$status =  $row2->status;
									}
								} else {
										$status =  "No Data";
								}
								
								


								$data['data'][] = array(
								$button,
								$r->cons_no,
								$r->rev_name,
								$r->r_phone,
								$r->r_add,
								$status 

								);
						}
						}
						}else{
						$data['data'][]=array(
						'You have no Data' ,'','','',''
						);
				}
				echo json_encode($data);
		}








	public function completed_courier_list()
	{

			theme('completed_courier_list');
	}




	public function completedListJson(){
			$limit = $this->input->get('length');
			$start = $this->input->get('start');
			$queryCount = $this->courier_model->cpendingListCount();

			$query = $this->courier_model->cpendingList($limit, $start);
			$draw = $this->input->get('draw');
			$data = [];
			$data['draw'] = $draw;
			$data['recordsTotal'] = $queryCount;
			$data['recordsFiltered'] = $queryCount;
			if($query -> num_rows() > 0)
			{
			foreach($query->result() as $r){



					//Action Button
					$button = '';
					$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/view_couriers/'. $r->cid).'" data-toggle="tooltip" title="View">
					<i class="fa fa-eye"></i> </a>';

					$button .= '<a class="btn btn-warning editBtn" href="'.base_url('courier/my_courier_status/'. $r->cons_no).'" data-toggle="modal" data-target="#myModal" title="View">
					<i class="fa fa-truck"></i> Track</a>';

					$query = $this->db->get_where('pincode', ['id' => $r->receiver_pincode,]);

					if ($query->num_rows() > 0) {
					foreach ($query->result() as $row) {
							$pincode =  $row->pincode;
					}
					} else {
							$pincode =  " ";
					}



					$data['data'][] = array(
					$button,
					$r->cons_no,
					$r->s_add,
					$pincode,
					$r->status,

					);

			}
			}else{
					$data['data'][]=array(
					'You have no Data' ,'','','',''
					);
			}
			echo json_encode($data);
	}











		public function new_added_courier_list()
		{

			theme('new_added_courier_list');
		}




public function newaddedListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$queryCount = $this->courier_model->pendingListCount();

		$query = $this->courier_model->pendingList($limit, $start);
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0)
		{
		foreach($query->result() as $r){

				//Action Button
				$button = '';
				$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/view_couriers/'. $r->cid).'" data-toggle="tooltip" title="View">
				<i class="fa fa-eye"></i> </a>';


				$user_info = $this->session->userdata('logged_user');
				$user_id = $user_info['user_id'];
				$currentRolename   = singleDbTableRow($user_id)->rolename;
				if ($currentRolename == '11' || $currentRolename == '27')  {



				}
				$button .= '<a class="btn btn-warning editBtn" href="'.base_url('courier/my_courier_status/'. $r->cons_no).'" data-toggle="modal" data-target="#myModal" title="View">
				<i class="fa fa-truck"></i> Track</a>';

				$query = $this->db->get_where('pincode', ['id' => $r->shipper_pincode]);

				if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
						$pincode =  $row->pincode;
				}
				} else {
				$pincode =  " ";
				}
				$data['data'][] = array(
				$button,
				$r->cons_no,
				$r->delivery_type,
				$r->rev_name,
				$r->r_phone,
				$r->r_add,

				);
		}
		}else{
			$data['data'][]=array(
			'You have no Data' ,'','','','',''
			);
		}
		echo json_encode($data);
}




public function shipment_cost_list()
{


theme('shipment_cost_list');
}


public function shipmentCostListJson(){



		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$queryCount = $this->courier_model->shipmentCostListCount();

		$query = $this->courier_model->shipmentCostList($limit, $start);
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0)
		{
		foreach($query->result() as $r){
			//Action Button
			$button = '';

			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('courier/view_shipment_cost/'. $r->id).'" data-toggle="tooltip" title="View">
			<i class="fa fa-eye"></i> </a>';

				$currentAuthDta = loggedInUserData();
				$currentUser = $currentAuthDta['role'];
				$user_info = $this->session->userdata('logged_user');
				$user_id = $user_info['user_id'];
				$currentRolename   = singleDbTableRow($user_id)->rolename;
			if ( $currentRolename == 11) {
				$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
				<i class="fa fa-trash"></i> </a>';
			}
			$query = $this->db->get_where('pincode', ['id' => $r->from_pin,]);

			if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$pincode =  $row->pincode;
			}
			} else {
				$pincode =  " ";
			}
				$query2 = $this->db->get_where('pincode', ['id' => $r->to_pin,]);

			if ($query2->num_rows() > 0) {
			foreach ($query2->result() as $row2) {
				$pincodes =  $row->pincode;
			}
		} else {
		$pincodes =  " ";
		}


		$data['data'][] = array(
		$button,
		$r->weight,

		$pincode,
		$pincodes,
		$r->amount,

		);

		}
		}else{
			$data['data'][]=array(
			'You have no Data' ,'','','',''
			);
		}
		echo json_encode($data);
}

public function deleteAjax(){
	$id = $this->input->post('id');
	//get deleted user info
	$userInfo = singleDbTableRow($id);
	$fullName = user_full_name($userInfo);
	// add a activity
	create_activity("Deleted {$id} from OTP Transactions");
	//Now delete permanently
	$this->db->where('id', $id)->delete('cms_shipment_cost');
	return true;
}




public function getstate()
{
	$country=$_POST['country'];
	//   echo $country;
	$query = $this->courier_model->state($country);
	echo "<option value=''>-Select-</option>";
	foreach($query->result() as $r)
	{
		echo "<option value='".$r->state."'>".$r->state."</option>";
	}
}
public function get_district()
{
	$state=$_POST['state'];

	$query = $this->courier_model->district($state);
	echo "<option value=''>-Select-</option>";
	foreach($query->result() as $r)
	{
	echo "<option value='".$r->district."'>".$r->district."</option>";
	}
}

public function get_location_id()
{
	$district=$_POST['district'];

	$query = $this->courier_model->location($district);
	echo "<option value=''>-Select-</option>";
	foreach($query->result() as $r)
	{
	echo "<option value='".$r->location."'>".$r->location."--".$r->pincode."</option>";
	}
}



public function get_pincode()
{
	$location=$_POST['location'];

	$query = $this->courier_model->pincode($location);
	echo "<option value=''>-Select-</option>";
	foreach($query->result() as $r)
	{
	echo "<option value='".$r->id."'>".$r->pincode."</option>";
	}
}


public function get_address_type()
{
	$address_type=$_POST['type'];

	$query = $this->courier_model->address_type($address_type);
	if($query)
	{
		echo 0;
	}
	else
	{
		echo 1;
	}
}










public function get_area()
{
		$location_id=$_POST['location_id'];
		// echo $categ;
		$pincode = $this->courier_model->area($location_id);


		if($pincode->num_rows() > 0)
		{
			foreach($pincode->result() as $c){
				$pincode_name = explode("," , $c->pincode);
				foreach($pincode_name as $pincode_id){
				
				$query = $this->db->group_by('pincode')->get_where('pincode', ['pincode'=>$pincode_id]);
				foreach($query->result() as $d)
				{
					echo "<option value='".$pincode_id."' selected>".$d->pincode."-".$d->location."-".$d->state."-".$d->state."</option>";
				}
				}
			}
		}
		else{
		echo "<option value=''>Select option</option>";
		}
}

public function add_receiver($cid) {
		//permittedArea();



		$data['res'] = singleDbTableRow1($cid,'cms_courier');

		if ($this->input->post()) {
			if ($this->input->post('submit') != 'add_receiver')
			die('Error! sorry');

			$this->form_validation->set_rules('cons_no', 'Name', 'trim|required|is_unique[cms_add_receiver.cons_no]');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('receiver_phone', 'Phone Number', 'trim|required');
			$this->form_validation->set_rules('relation', 'Relation Type', 'trim|required');
			$this->form_validation->set_rules('id_type', 'ID Type', 'trim|required');
			$this->form_validation->set_rules('id_number', 'ID Number', 'trim|required');

			if ($this->form_validation->run() == true) {
				$insert = $this->courier_model->add_receiver();
				if ($insert) {
				$this->session->set_flashdata('successMsg', 'Receiver Information Successfully');
				redirect(base_url('courier'));
				}
				else{$this->session->set_flashdata('errorMsg', 'Please increase Your CPA Balance..!'); }
			}
		}
		theme('add_receiver', $data);
}
public function delivered_succesful($cid)
{
		//restricted this area, only for admin
		//permittedArea();
		$data['res'] = singleDbTableRow1($cid,'cms_courier');
		$data['cms_delivery_status'] = singleDbTableRow1($cid,'cms_delivery_status');



		if($this->input->post())
		{
		if($this->input->post('submit') == 'delivered') 
		{
				$this->form_validation->set_rules('status', 'Status', 'required|trim');
				//Delivery Charges to Delevery executive from CMS Manager Accounts Manager

				if($this->form_validation->run() == true)
				{
					
				$user_info = $this->session->userdata('logged_user');
				$user_id = $user_info['user_id'];
				$currentUser = singleDbTableRow($user_id)->role;
				$referral_code = singleDbTableRow($user_id)->referral_code;
				$rolename = singleDbTableRow($user_id)->rolename;
				$shipping_cost    =  $this->input->post('shipping_cost');
				
				$biz_id = 5;
				$pay_by_referral_code   =   singleDbTableRow($biz_id,'business_groups')->payment_reciever;   // Sender's referral_code, ex : 5559990001
				$pay_to_referral_code   =    $referral_code;     // Receiver's referral_code, ex : 5164830972
				$amount_to_pay          =   $shipping_cost;           // Total amont to pay (or) transfer, ex : 100
				$pay_spec_type          =   singleDbTableRow($biz_id,'business_groups')->pay_type;               // Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
				$transaction_remarks    =   'Paid For Successfully Delivery';   // remarks to insert into invoice table, ex : "Transfer Values";
				$pm_mode                =   'wallet';           // points_mode, ex : wallet, loyality, discount.


				$make_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);


				$insert = $this->courier_model->delivered_self();
				$this->session->set_flashdata('successMsg', 'Courier Pickup/ Delivered Successfully!');
				redirect(base_url('courier/courier_delivered'));
				}

		}elseif($this->input->post('submit') == 'delivered2') {
		$this->form_validation->set_rules('status', 'status', 'required|trim');


		if($this->form_validation->run() == true)
		{
				$user_info = $this->session->userdata('logged_user');
				$user_id = $user_info['user_id'];
				$currentUser = singleDbTableRow($user_id)->role;
				$referral_code = singleDbTableRow($user_id)->referral_code;
				// If Current role is vendor counter delivery Payment for shipment cost will not be charged.
				$rolename = singleDbTableRow($user_id)->rolename;
				$biz_id = 5;
				$shipping_cost          =  $this->input->post('shipping_cost');
				//Delivery Charges to Delevery executive from CMS Manager Accounts Manager
				$pay_by_referral_code   =   singleDbTableRow($biz_id,'business_groups')->payment_reciever;   // Sender's referral_code, ex : 5559990001
				$pay_to_referral_code   =   $referral_code;     // Receiver's referral_code, ex : 5164830972
				$amount_to_pay          =   $shipping_cost;           // Total amont to pay (or) transfer, ex : 100
				$pay_spec_type          =    singleDbTableRow($biz_id,'business_groups')->pay_type;              // Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
				$transaction_remarks    =   'Paid For Successfully Delivery';   // remarks to insert into invoice table, ex : "Transfer Values";
				$pm_mode                =   'wallet';           // points_mode, ex : wallet, loyality, discount.


				$make_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);


				$insert = $this->courier_model->delivered_others();

				$this->session->set_flashdata('successMsg', 'Courier Pickup/ Delivered Successfully!');
				redirect(base_url('courier/courier_delivered'));
		}

		}
		}
theme('delivered_succesful',$data);
}



public function assign_delivery_executive($cid)
{

		$data['pincode'] = $this->db->get('pincode');

		$data['courier_Details'] = $this->db->get_where('cms_courier', ['cid' => $cid]);

		if($this->input->post())
		{
			if($this->input->post('submit') != 'assign_delivery_executive') die('Error! sorry');
			$this->form_validation->set_rules('delivery_boy', 'Deliveryboy', 'required|trim');


			if($this->form_validation->run() == true)
			{
				$insert = $this->courier_model->assign_delivery_executive($cid);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Delivery Executive Assigned Successfully');
					redirect(base_url('courier'));
				}
			}
		}
		theme('assign_delivery_executive',$data);

}

//Anuja------------------------
public function add_cms_role_payment()
	{
		 if ($this->input->post()) 
		    {
				if ($this->input->post('submit') != 'add_payment')
					die('Error! sorry');
				$this->form_validation->set_rules('transport_type', 'transport_type', 'required'); 
				$this->form_validation->set_rules('business_group', 'business_group', 'required');
				$this->form_validation->set_rules('cms_type', 'cms_type', 'required');
				$this->form_validation->set_rules('parcel_type', 'parcel_type', 'required');			
				$this->form_validation->set_rules('min_quantity', 'min_quantity', 'required'); 
				$this->form_validation->set_rules('max_quantity', 'max_quantity', 'required'); 
				$this->form_validation->set_rules('min_km', 'min_km', 'required'); 
				$this->form_validation->set_rules('max_km', 'max_km', 'required');
				$this->form_validation->set_rules('to_role', 'to_role', 'required'); 
				$this->form_validation->set_rules('from_role', 'from_role', 'required');
				$this->form_validation->set_rules('min_kg', 'min_kg', 'required');
				$this->form_validation->set_rules('max_kg', 'max_kg', 'required');
				$this->form_validation->set_rules('vehicle_type', 'vehicle_type', 'required'); 				
				$this->form_validation->set_rules('shipment_cost', 'shipment_cost', 'required'); 
				if ($this->form_validation->run() == true) {
					$insert = $this->courier_model->add_cms_role_payment();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'your data saved Successfully');
						redirect(base_url('Courier/cms_role_payment_list'));
					}
				}
			}
		theme('add_cms_role_payment');
	}
	 public function cms_role_payment_ListJson() 
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$transport_type    = $_POST['transport_type'];
		$business_group    = $_POST['business_group'];
		$cms_type          = $_POST['cms_type'];
		$parcel_type       = $_POST['parcel_type'];
		$sf_time           = $_POST['sf_time'];
		$st_time           = $_POST['st_time'];
		$limit             = $this->input->POST('length');
		$start             = $this->input->POST('start');

        $queryCount = $this->courier_model->cms_role_payment_ListCount($transport_type,$business_group,$cms_type,$parcel_type,$sf_time,$st_time);
        $query = $this->courier_model->cms_role_payment_List($limit, $start,$transport_type,$business_group,$cms_type,$parcel_type,$sf_time,$st_time);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {
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
				case 3 :
						if($currentUser =='admin')
						{
						$statusBtn = '<small class="label label-danger"> Blocked by Admin </small>';
						$blockUnblockBtn = '<button  class="btn btn-danger blockUnblock" id="'.$r->id.'"data-toggle="tooltip" title="Unblock User Account" value="1">
						<i class="fa fa-lock"></i> </button>';
						}else{
						$statusBtn = '<small class="label label-danger"> Blocked by Admin </small>';
						$blockUnblockBtn = '<button  class="btn btn-danger blockUnblock" id="'.$r->id.'"
						disabled data-toggle="tooltip" value="1">
						<i class="fa fa-lock"></i> </button>';
						}
						break;
					
			    }	 
                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Courier/view_cms_role_payment/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
				$button .= '<a class="btn btn-info editBtn" href="' . base_url('Courier/copy_cms_role_payment/' . $r->id) . '" data-toggle="tooltip" title="Copy">
						<i class="fa fa-copy"></i> </a>';
						
					$user_info = $this->session->userdata('logged_user');
								$user_id = $user_info['user_id'];
								$currentRolename   = singleDbTableRow($user_id)->rolename;
								if ($currentRolename == '11')  {	
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
				<i class="fa fa-trash"></i> </a>';
								}
				
				
				$button .= $blockUnblockBtn;
				
				$query = $this->db->get_where('role',['id'=>$r->to_role]);
								     if($query->num_rows()>0)
									 {								
										foreach($query->result() as $d)
										{
											$rolename = $d->rolename;
									 	}
									 }
									 else 
									 {
											 $rolename =  " ";
									 }
				$query1 = $this->db->get_where('role',['id'=>$r->from_role]);
								     if($query1->num_rows()>0)
									 {								
										foreach($query1->result() as $d)
										{
											$rolename1 = $d->rolename;
									 	}
									 }
									 else 
									 {
											 $rolename1 =  " ";
									 }
				$query2 = $this->db->get_where('business_groups',['id'=>$r->business_groups]);
								     if($query2->num_rows()>0)
									 {								
										foreach($query2->result() as $d)
										{
											$business_group = $d->business_name;
									 	}
									 }
									 else 
									 {
											 $business_group =  " ";
									 }
								
                $data['data'][] = array(
                    $button,
					$business_group,
				    $rolename1,
					$rolename,
					$r->transport_type,
					
					$r->cms_type,
					$r->delivery_type,
					$r->parcel_type,
					$r->min_quantity,
					$r->max_quantity,
					$r->min_volume,
					$r->max_volume,
			     	$r->min_kg,
					$r->max_kg,
					$r->min_km,
					$r->max_km,

                    

					$r->vehicle_type,
					$r->shipment_cost,
					$statusBtn
                );
            }
        } else {
            $data['data'][] = array(
                'Role payments are not Available' , '', '','', '','','','','','','','','','','','','','',''
            );
        }
        echo json_encode($data);
    }
		public function setBlockUnblock(){
		$id = $this->input->post('id');
		$buttonValue = $this->input->post('buttonValue');
		$status = $this->input->post('active');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		//Now delete permanently

		$this->db->where('id', $id)->update('cms_role_payment', ['active' => $buttonValue]);
		return true;
	}
	public function cms_role_payment_list()
	{
		theme('cms_role_payment_list');
	}
	
	public function deleteAjaxpayment() {
        $id = $this->input->post('id');
        $userInfo = singleDbTableRow($id, 'cms_role_payment');
        $categoryName = $userInfo->name;
        $this->db->where('id', $id)->delete('cms_role_payment');
        return true;
    }
	public function view_cms_role_payment($id) 
	{
        $data['profile'] = $this->db->get_where('cms_role_payment', ['id' => $id]);
        theme('view_cms_role_payment', $data);
    }
	
	public function edit_cms_role_payment($id) 
	{
	$data['cms'] = singleDbTableRow($id, 'cms_role_payment');
	
	if ($this->input->post()) 
		{
			if ($this->input->post('submit') != 'Update_cms_role_payment')
				die('Error! sorry');
				$this->form_validation->set_rules('transport_type', 'transport_type', 'required'); 
				$this->form_validation->set_rules('business_group', 'business_group', 'required');
				$this->form_validation->set_rules('cms_type', 'cms_type', 'required');
				$this->form_validation->set_rules('parcel_type', 'parcel_type', 'required');			
				$this->form_validation->set_rules('min_quantity', 'min_quantity', 'required'); 
				$this->form_validation->set_rules('max_quantity', 'max_quantity', 'required'); 
				$this->form_validation->set_rules('min_km', 'min_km', 'required'); 
				$this->form_validation->set_rules('max_km', 'max_km', 'required');
				$this->form_validation->set_rules('to_role', 'to_role', 'required'); 
				$this->form_validation->set_rules('from_role', 'from_role', 'required');
				$this->form_validation->set_rules('min_kg', 'min_kg', 'required');
				$this->form_validation->set_rules('max_kg', 'max_kg', 'required');
				$this->form_validation->set_rules('vehicle_type', 'vehicle_type', 'required'); 				
				$this->form_validation->set_rules('shipment_cost', 'shipment_cost', 'required'); 
			
			if ($this->form_validation->run() == true) {
				$insert = $this->courier_model->edit_cms_role_payment($id);
				if ($insert==true) {
					$this->session->set_flashdata('successMsg', 'Address details Updated Successfully...!!!');
					redirect(base_url('Courier/cms_role_payment_list'));
				}
			}
		}

        theme('edit_cms_role_payment', $data);
    }

	public function copy_cms_role_payment($id) 
	{
	$data['cms'] = singleDbTableRow($id, 'cms_role_payment');
	
	if ($this->input->post()) 
		{
			if ($this->input->post('submit') != 'copy_cms_role_payment')
				die('Error! sorry');
				$this->form_validation->set_rules('transport_type', 'transport_type', 'required'); 
				$this->form_validation->set_rules('business_group', 'business_group', 'required');
				$this->form_validation->set_rules('cms_type', 'cms_type', 'required');
				$this->form_validation->set_rules('parcel_type', 'parcel_type', 'required');			
				$this->form_validation->set_rules('min_quantity', 'min_quantity', 'required'); 
				$this->form_validation->set_rules('max_quantity', 'max_quantity', 'required'); 
				$this->form_validation->set_rules('min_km', 'min_km', 'required'); 
				$this->form_validation->set_rules('max_km', 'max_km', 'required');
				$this->form_validation->set_rules('to_role', 'to_role', 'required'); 
				$this->form_validation->set_rules('from_role', 'from_role', 'required');
				$this->form_validation->set_rules('min_kg', 'min_kg', 'required');
				$this->form_validation->set_rules('max_kg', 'max_kg', 'required');
				$this->form_validation->set_rules('vehicle_type', 'vehicle_type', 'required'); 				
				$this->form_validation->set_rules('shipment_cost', 'shipment_cost', 'required'); 
			
			if ($this->form_validation->run() == true) {
				$insert = $this->courier_model->add_cms_role_payment();
				if ($insert==true) {
					$this->session->set_flashdata('successMsg', 'Address details Updated Successfully...!!!');
					redirect(base_url('Courier/cms_role_payment_list'));
				}
			}
		}

        theme('copy_cms_role_payment', $data);
    }


public function cms_self_delivery($cid)
{
			//restricted this area, only for admin
			//permittedArea();
			$data['res'] = singleDbTableRow1($cid,'cms_courier');
			$data['cms_delivery_status'] = singleDbTableRow1($cid,'cms_delivery_status');




			if($this->input->post())
			{
			if($this->input->post('submit') == 'delivered') 
			{
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			$this->form_validation->set_rules('cons_no', 'Status', 'required|trim');
			//Delivery Charges to Delevery executive from CMS Manager Accounts Manager

			if($this->form_validation->run() == true)
			{
					$biz_id = 5;	
					$user_info = $this->session->userdata('logged_user');
					$user_id = $user_info['user_id'];
					$currentUser = singleDbTableRow($user_id)->role;
					$referral_code = singleDbTableRow($user_id)->referral_code;
					$rolename = singleDbTableRow($user_id)->rolename;
					$shipping_cost    =  $this->input->post('shipping_cost');
					$pay_by_referral_code   =   singleDbTableRow($biz_id,'business_groups')->payment_reciever;   // Sender's referral_code, ex : 5559990001
					$pay_to_referral_code   =    $referral_code;     // Receiver's referral_code, ex : 5164830972
					$amount_to_pay          =   $shipping_cost;           // Total amont to pay (or) transfer, ex : 100
					$pay_spec_type          =   singleDbTableRow($biz_id,'business_groups')->pay_type;               // Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
					$transaction_remarks    =   'Paid For Successfully Delivery';   // remarks to insert into invoice table, ex : "Transfer Values";
					$pm_mode                =   'wallet';           // points_mode, ex : wallet, loyality, discount.


					$make_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);


					$insert = $this->courier_model->delivered_self();
					$this->session->set_flashdata('successMsg', 'Courier Pickup/ Delivered Successfully!');
					redirect(base_url('courier/courier_delivered'));
			}

			}	elseif($this->input->post('submit') == 'delivered2') {
					$this->form_validation->set_rules('status', 'status', 'required|trim');


					if($this->form_validation->run() == true)
					{
						$biz_id = 5;	
						$user_info = $this->session->userdata('logged_user');
						$user_id = $user_info['user_id'];
						$currentUser = singleDbTableRow($user_id)->role;
						$referral_code = singleDbTableRow($user_id)->referral_code;
						$shipping_cost          =  $this->input->post('shipping_cost');
						//Delivery Charges to Delevery executive from CMS Manager Accounts Manager
						$pay_by_referral_code   =   singleDbTableRow($biz_id,'business_groups')->payment_reciever;   // Sender's referral_code, ex : 5559990001
						$pay_to_referral_code   =    $referral_code;     // Receiver's referral_code, ex : 5164830972
						$amount_to_pay          =   $shipping_cost;           // Total amont to pay (or) transfer, ex : 100
						$pay_spec_type          =   singleDbTableRow($biz_id,'business_groups')->pay_type;               // Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
						$transaction_remarks    =   'Paid For Successfully Delivery';   // remarks to insert into invoice table, ex : "Transfer Values";
						$pm_mode                =   'wallet';           // points_mode, ex : wallet, loyality, discount.


						$make_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);


						$insert = $this->courier_model->delivered_others();

						$this->session->set_flashdata('successMsg', 'Courier Pickup/ Delivered Successfully!');
						redirect(base_url('courier/courier_delivered'));
					}

			}
			}
			theme('cms_self_delivery',$data);
}


public function cms_pickup_delivery($cid)
{
			//restricted this area, only for admin
			//permittedArea();
			$data['res'] = singleDbTableRow1($cid,'cms_courier');
			$data['cms_delivery_status'] = singleDbTableRow1($cid,'cms_delivery_status');

				
	$data['pincode'] = $this->db->get('pincode');
	$data['courier'] = singleDbTableRow1($cid, 'cms_courier');
	$data['courier_Details'] = $this->db->get_where('cms_courier', ['cid' => $cid]);


			if($this->input->post())
			{
			if($this->input->post('submit') == 'pickup') 
			{
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			//Delivery Charges to Delevery executive from CMS Manager Accounts Manager

			if($this->form_validation->run() == true)
			{
					$biz_id = 5;	
					$user_info = $this->session->userdata('logged_user');
					$user_id = $user_info['user_id'];
					$currentUser = singleDbTableRow($user_id)->role;
					$referral_code = singleDbTableRow($user_id)->referral_code;
					$rolename = singleDbTableRow($user_id)->rolename;
					$shipping_cost          =  $this->input->post('shipping_cost');
					$pay_by_referral_code   =   singleDbTableRow($biz_id,'business_groups')->payment_reciever;   // Sender's referral_code, ex : 5559990001
					$pay_to_referral_code   =    $referral_code;     // Receiver's referral_code, ex : 5164830972
					$amount_to_pay          =   $shipping_cost;           // Total amont to pay (or) transfer, ex : 100
					$pay_spec_type          =   singleDbTableRow($biz_id,'business_groups')->pay_type;              // Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
					$transaction_remarks    =   'Paid For Successfully Delivery/Pickup';   // remarks to insert into invoice table, ex : "Transfer Values";
					$pm_mode                =   'wallet';           // points_mode, ex : wallet, loyality, discount.


					$make_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);


					$insert = $this->courier_model->delivered_self();
					$this->session->set_flashdata('successMsg', 'Courier Pickup/ Delivered Successfully!');
					redirect(base_url('courier/courier_delivered'));
			}

			}	elseif($this->input->post('submit') == 'pickup2') {
					$this->form_validation->set_rules('status', 'status', 'required|trim');


					if($this->form_validation->run() == true)
					{
						$biz_id = 5;	
						$user_info = $this->session->userdata('logged_user');
						$user_id = $user_info['user_id'];
						$currentUser = singleDbTableRow($user_id)->role;
						$referral_code = singleDbTableRow($user_id)->referral_code;
						$shipping_cost          =  $this->input->post('shipping_cost');
						//Delivery Charges to Delevery executive from CMS Manager Accounts Manager
						$pay_by_referral_code   =   singleDbTableRow($biz_id,'business_groups')->payment_reciever;   // Sender's referral_code, ex : 5559990001
						$pay_to_referral_code   =    $referral_code;     // Receiver's referral_code, ex : 5164830972
						$amount_to_pay          =   $shipping_cost;           // Total amont to pay (or) transfer, ex : 100
						$pay_spec_type          =   singleDbTableRow($biz_id,'business_groups')->pay_type;               // Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
						$transaction_remarks    =   'Paid For Successfully Delivery/Pickup';   // remarks to insert into invoice table, ex : "Transfer Values";
						$pm_mode                =   'wallet';           // points_mode, ex : wallet, loyality, discount.


						$make_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);


						$insert = $this->courier_model->delivered_others();

						$this->session->set_flashdata('successMsg', 'Courier Pickup/ Delivered Successfully!');
						redirect(base_url('courier/courier_delivered'));
					}

			}
			}
			theme('cms_pickup_delivery',$data);
}
























public function get_ship_cost(){

	$qty = $_POST['qty'];
	$weight = $_POST['weight'];
	$from_role = $_POST['from_role'];
	$to_role = $_POST['to_role'];

	
	$condition ="min_kg <= '".$weight."' AND max_kg >= '".$weight."' AND from_role = '".$from_role."' AND to_role            = '".$to_role."' AND active = '1' AND business_groups = '5' ";
				  
	$get_cost = $this->db->where($condition)->get('cms_role_payment');
	if($get_cost->num_rows() > 0){
		foreach($get_cost->result() as $cost);
			echo ($cost->shipment_cost) * $qty;
		
	}
	else{
		echo "0";
	}
}


public function get_ship_cost_sts(){

	$qty = $_POST['qty'];
	$weight = $_POST['weight'];
	$from_role = $_POST['from_role'];
	$to_role = $_POST['to_role'];

	
	$condition ="min_kg <= '".$weight."' AND max_kg >= '".$weight."' AND from_role = '".$from_role."' AND to_role            = '".$to_role."' AND active = '1' AND business_groups = '5' ";
				  
	$get_cost = $this->db->where($condition)->get('cms_role_payment');
	if($get_cost->num_rows() > 0){
		echo '';
	}
	else{
		echo "<font color='red'>Please Contact Support.</font>";
	}
}


}