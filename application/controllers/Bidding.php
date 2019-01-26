<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bidding extends CI_Controller 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('bidding_model');
		$this->load->model('courier_model');
		$this->load->model('earning_model');
		$this->load->model('ledger_model');
		$this->load->model('product_model');
		$this->load->model('Bank_model');
		$this->load->model('payment_model');
		$this->load->model('notification_model');

		check_auth(); //check is logged in.
	}
	/**
	 * Add/Register Bidding
	 */
	 public function get_state()
     {
         $country=$_POST['country'];
         $query = $this->bidding_model->get_state($country);
         $state = "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             $state .= "<option value='".$r->state."'>".$r->state."</option>";
         } 
		echo $state;
     }
	 public function get_district()
     {
         $state=$_POST['state'];
         $query = $this->bidding_model->get_district($state);
         $state = "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             $state .= "<option value='".$r->district."'>".$r->district."</option>";
         } 
		echo $state;
     }
	 public function get_location()
     {
         $district=$_POST['district'];
         $query = $this->bidding_model->get_location($district);
         $state = "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             $state .= "<option value='".$r->id."'>".$r->pincode."-".$r->location."</option>";
         } 
		echo $state;
     }
	public function add_bidding()
	{
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['category'] = $this->bidding_model->get_category();
		$data['countrys'] = $this->db->group_by('country')->get('pincode');
		
		if($this->input->post())
		{
			/* add stock */
			if($this->input->post('submit') == 'stock_add')
			{
				$this->form_validation->set_rules('location', 'location', 'required|trim');
				$this->form_validation->set_rules('category', 'category', 'required|trim');
				$this->form_validation->set_rules('sub_cat_id', 'sub_cat', 'required|trim');
				$this->form_validation->set_rules('product_id', 'Product', 'required|trim');
				$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
				//$this->form_validation->set_rules('amount_no', 'Per Number', 'required|trim');
				//$this->form_validation->set_rules('amount_measure', 'Amount', 'required|trim');
				$this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
				//$this->form_validation->set_rules('measure', 'Quantity', 'required|trim');	
				$balance=$this->input->post('balance');
				if($balance < 100)
				{
					$this->session->set_flashdata('errorMsg', ' Please increase Your CPA Balance..! ');
						redirect('bidding/add_bidding');
				}
				else if($this->form_validation->run() == true)
				{
					$add = $this->bidding_model->add();
					if($add)
					{
						/* paytype*/$get_paytype = $this->db->get_where('business_groups', ['id'=>24]);
				foreach($get_paytype->result() as $p);
				 $pay = $p->pay_type;/* */
						//$deduction = $this->bidding_model->account_deduction($userID,100,$insert);
						$reciever_ref   = singleDbTableRow(930)->referral_code;
						$sender_referral_code = singleDbTableRow($userID)->referral_code;
						//
						$pay_by_referral_code 	= 	$sender_referral_code;	// Sender's referral_code, ex : 5559990001
						$pay_to_referral_code 	= 	$reciever_ref;// Receiver's referral_code, ex : 5164830972
						$amount_to_pay		  	=	100;			// Total amont to pay (or) transfer, ex : 100
						$pay_spec_type			=	$pay;				// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
						$transaction_remarks	=	" Paid to CMS Account Manager for the  BIDDING Registration   ID-".$add;	
						$pm_mode				=	"wallet";			// points_mode, ex : wallet, loyality, discount.
						
						
						$insert = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);
						if($insert)
						{
						$this->session->set_flashdata('successMsg', ' your order registered successfully...!!!');
						redirect('bidding/add_bidding');
						}
					}
					else{
						echo "error";
						}
				}
			}
			/* Reg */
			if($this->input->post('reg') == 'reg_bidding')
			{
				$this->form_validation->set_rules('reg_category', 'rcategory', 'required|trim');
				$this->form_validation->set_rules('reg_sub_cat_id', 'rsub_cat', 'required|trim');
				$this->form_validation->set_rules('reg_product_id', 'rProduct', 'required|trim');
				$this->form_validation->set_rules('reg_amount_min', 'rAmount', 'required|trim');
				$this->form_validation->set_rules('reg_amount_max', 'rAmount', 'required|trim');	
				$balance=$this->input->post('balance');
				if($balance < 100)
				{
					$this->session->set_flashdata('errorMsg', ' Please increase Your CPA Balance..! ');
						redirect('bidding/add_bidding');
				}
				else if($this->form_validation->run() == true)
				{
					$add = $this->bidding_model->register();
					if($add)
					{
						/* paytype*/$get_paytype = $this->db->get_where('business_groups', ['id'=>24]);
				foreach($get_paytype->result() as $p);
				 $pay = $p->pay_type;/* */
						//$deduction = $this->bidding_model->account_deduction($userID,100,$insert);
						$reciever_ref   = singleDbTableRow(930)->referral_code;
						$sender_referral_code = singleDbTableRow($userID)->referral_code;
						//
						$pay_by_referral_code 	= 	$sender_referral_code;	// Sender's referral_code, ex : 5559990001
						$pay_to_referral_code 	= 	$reciever_ref;// Receiver's referral_code, ex : 5164830972
						$amount_to_pay		  	=	100;			// Total amont to pay (or) transfer, ex : 100
						$pay_spec_type			=	$pay;				// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
						$transaction_remarks	=	" Paid to CMS Account Manager for the  BIDDING Registration   ID-".$add;	
						$pm_mode				=	"wallet";			// points_mode, ex : wallet, loyality, discount.
						
						
						$insert = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);
						//
						if($insert)
						{
						$this->session->set_flashdata('successMsg', ' your order registered successfully...!!!');
						redirect('bidding/add_bidding');
						}
					}
					else{
						echo "error";
						}
				}
			}
			
		}
			
		theme('add_bidding', $data);
	}
	public function update_bidding()
	 {
		 $user = loggedInUserData();
		 $userID = $user['user_id'];
		 $amount=$_POST['amount'];
		 $quantity=$_POST['quantity'];
		 $bno=$_POST['bno'];
		 $ev=$_POST['ev'];
		 $prod=$_POST['prod'];
		 $query = $this->bidding_model->update_bidding($amount,$quantity,$bno,$ev,$prod); 
		 if($query)
		 {
			 $this->session->set_flashdata('successMsg', ' Updated...!!!');
		 }
	 }
	/**
	 * Sub Category
	 */
	 public function getsubcat()
	 {
		 $categ=$_POST['categ'];
		// echo $categ;
		 $query = $this->bidding_model->get_subcategory($categ);
		 echo "<option value=''>-Select-</option>";
		 foreach($query->result() as $r)
		 {
			 echo "<option value='".$r->id."'>".$r->sub_category_name."</option>";
		 }
		  
	 }
	 /**
	 * Product
	 */
	 public function getproduct()
	 {
		 $subcateg=$_POST['subcateg'];
		 
		 $query = $this->bidding_model->get_product($subcateg);
		 echo "<option value=''>-Select-</option>";
		 foreach($query->result() as $r)
		 {
			 echo "<option value='".$r->id."'>".$r->title."</option>";
		 }
		  
	 }
	 
	 /**
	 * Add Stock
	 */
	 public function add()
	{
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		if($this->input->post())
		{
			if($this->input->post('submit') != 'stock_add') die('Error! sorry');

			$this->form_validation->set_rules('category', 'category', 'required|trim');
		/*	$this->form_validation->set_rules('sub_cat_id', 'Sub Category Name', 'required|trim');
			$this->form_validation->set_rules('product_id', 'Product', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			$this->form_validation->set_rules('amount_no', 'Per Number', 'required|trim');
			$this->form_validation->set_rules('amount_measure', 'Amount', 'required|trim');
			$this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
			$this->form_validation->set_rules('measure', 'Quantity', 'required|trim');	*/

			if($this->form_validation->run() == true)
			{
				$insert = $this->bidding_model->add();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', ' Successfully...!!!');
					redirect(base_url('index'));
				}
				else{
					echo "error";
					}
			}
			else
			{
				echo "error";
			}
		//	theme('add_bidding');
		}
		
	}
	/* Confirm List */
	public function confirm_bidding_list()
	{
		$data['biddings'] = $this->bidding_model->confirm_bidding_list();
		theme('confirm_bidding_list', $data);
	}
	/* bidding_fund_release List */
	public function bidding_fund_release()
	{
		$data['biddings'] = $this->bidding_model->fund_release_list();
		theme('bidding_fund_release', $data);
	}
	//buyer review
	public function bidding_buyer_review($trackid)
	{
		//$data['details'] =$trackid;
		$data['details'] = $this->bidding_model->bidding_track_view($trackid);
		$data['seller'] = $this->bidding_model->bidding_track_user($trackid,'S');
		$data['buyer'] = $this->bidding_model->bidding_track_user($trackid,'B');
		$data['pincode'] = $this->db->get('pincode');
		$data['shipment_cost'] = $this->db->get('cms_shipment_cost');
		//add Courier
		if($this->input->post())
		{
			if($this->input->post('submit') != 'release') die('Error! sorry');

			$this->form_validation->set_rules('total_quantity', 'total_quantity');
			$this->form_validation->set_rules('fund', 'fund');
			
			$fund=$this->input->post('fund');
			$seller=$this->input->post('sellerid');
			$seller_ref   = singleDbTableRow($seller)->referral_code;
			$sender_referral_code = singleDbTableRow(930)->referral_code;
				if($this->form_validation->run() == true)
				{
					$add = $this->bidding_model->add_review($trackid);
					if($add)
					{
						/* paytype*/$get_paytype = $this->db->get_where('business_groups', ['id'=>24]);
				foreach($get_paytype->result() as $p);
				 $pay = $p->pay_type;/* */
						//
						$pay_by_referral_code 	= 	$sender_referral_code;	// Sender's referral_code, ex : 5559990001
						$pay_to_referral_code 	= 	$seller_ref;// Receiver's referral_code, ex : 5164830972
						$amount_to_pay		  	=	$fund;			// Total amont to pay (or) transfer, ex : 100
						$pay_spec_type			=	$pay;				// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
						$transaction_remarks	=	" Paid to CMS Account Manager for the  BIDDING  Track ID-".$trackid;	
						$pm_mode				=	"wallet";			// points_mode, ex : wallet, loyality, discount.
						
						
						$insert = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);
						//
						
						$this->session->set_flashdata('successMsg', 'Fund released  Successfully');
						redirect(base_url('bidding/bidding_fund_release'));
						
					}
				}
			
		}
		//
		theme('bidding_buyer_review',$data);
	}
	//Courier bidding_courier
	public function bidding_courier($trackid)
	{
		//$data['details'] =$trackid;
		$data['details'] = $this->bidding_model->bidding_track_view($trackid);
		$data['seller'] = $this->bidding_model->bidding_track_user($trackid,'S');
		$data['buyer'] = $this->bidding_model->bidding_track_user($trackid,'B');
		//$data['pincode'] = $this->db->get('pincode');
		$data['shipment_cost'] = $this->db->get('cms_shipment_cost');
		//add Courier
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_courier') die('Error! sorry');

			$this->form_validation->set_rules('ship_name', 'Shipper Name');
			$this->form_validation->set_rules('cost', 'cost');
			$total_amount = $this->input->post('total_amount');
			$seller_blnc = $this->input->post('seller_blnc');
			$buyer_blnc = $this->input->post('buyer_blnc');
			$amount = $this->input->post('cost');
			$buyer = $this->input->post('buyer');
			$consignment_no = $this->input->post('consignment_no');
			if($seller_blnc < $amount)
			{
				//echo "Please increase Your Balance..!";
				$this->session->set_flashdata('errorMsg', 'Seller Dont have sufficient CPA Balance..!');
				//redirect(base_url('courier/add_courier'));
			}
			else if($buyer_blnc < $total_amount)
			{
				//echo "Please increase Your Balance..!";
				$this->session->set_flashdata('errorMsg', 'Buyer Dont have sufficient CPA Balance..!');
				//redirect(base_url('courier/add_courier'));
			}
			else{
				if($this->form_validation->run() == true)
				{
					$insert = $this->courier_model->add_courier();
					if($insert)
					{
						$update = $this->bidding_model->update_track($trackid,$consignment_no);
						if($update )
						{
						$this->session->set_flashdata('successMsg', 'Courier Added Successfully');
						redirect(base_url('bidding/confirm_bidding_list'));
						}
					}
				}
			}
		}
		//
		theme('bidding_courier',$data);
	}
	/* Bidding List */
	public function bidding_list()
	{
		//$data['biddings'] = $this->bidding_model->bidding_list();
		theme('bidding_list');
	}
	public function bidding_ListJson(){
		//Get Decision who in online?
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$currentRolename   = singleDbTableRow($userID)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		
		$queryCount = $this->bidding_model->bidding_Count();
		$query = $this->bidding_model->bidding_List($limit, $start);

		$draw = $this->input->get('draw');
		
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
			if($query -> num_rows() > 0) 
			  {
				foreach($query->result() as $r)
				{
					/*Created by NAme */
					$query1 = $this->db->get_where('users', ['id' => $r->created_by]);
					if ($query1->num_rows() > 0) {
						foreach ($query1->result() as $row1) {
							$created_by = $row1->first_name.' '.$row1->last_name;
						}
					} else {
						 $created_by =  " ";
					}
					
					/*Category NAme */
					$query2 = $this->db->get_where('smb_category', ['id' => $r->category]);
					if ($query2->num_rows() > 0) {
						foreach ($query2->result() as $row2) {
							$category = $row2->category_name;
						}
					} else {
						 $category =  " ";
					}
					/*Sub Category NAme */
					$query3 = $this->db->get_where('smb_sub_category', ['id' => $r->sub_category]);
					if ($query3->num_rows() > 0) {
						foreach ($query3->result() as $row3) {
							$sub_category = $row3->sub_category_name;
						}
					} else {
						 $sub_category =  " ";
					}
					/*Product NAme */
					$query4 = $this->db->get_where('smb_product', ['id' => $r->product]);
					if ($query4->num_rows() > 0) {
						foreach ($query4->result() as $row4) {
							$product = $row4->title;
						}
					} else {
						 $product =  " ";
					}
					

			//Action Button
			$button = '';
        	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('bidding/bidding_view/'. $r->bidding_no).'" data-toggle="modal" data-target="#myModal1" title="View">
						<i class="fa fa-eye"></i> </a>';
			if(($currentRolename == 18 || $currentRolename == 11) && $r->approved ==0)
			{
		   $button .= ' 
		   <a  class="btn btn-warning blockUnblock" href="'.base_url('bidding/bidding_approve/'. $r->bidding_no).'" title="Aprrove Now">
			<i class="fa fa-edit"></i> </a>';
			}

					$data['data'][] = array(
					$button,
						$r->bidding_no,
						$created_by,
						$r->type,						
						date('d/m/Y h:i A',$r->created_at),
						$category,				
						$sub_category,											
						$product,	
						$r->amount				
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
	/* */
	public function my_biddings()
	{
		$data['biddings'] = $this->bidding_model->my_biddings();
		theme('my_biddings', $data);
	}
	/* Event List */
	public function bidding_events()
	{
		$data['events'] = $this->bidding_model->bidding_events();
		theme('bidding_events', $data);
	}
	
	/* event List */
	public function my_bidding_events()
	{
		$data['events'] = $this->bidding_model->my_bidding_events();
		theme('my_bidding_events',$data);
	}
	//offline
	public function set_offline_user($ev)
    {
		$logout=$this->bidding_model->set_offline_user($ev);
		if($logout)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function chatroom()
    {
		$ev = $_POST['ev'];
		//echo $ev;
		echo json_encode($ev);
	}
	/* chat */
	public function bidding_event_chat($ev)
	{
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		
		$table_name123="bidding_events";
		$where_array123 = " FIND_IN_SET('".$userID."', users) AND event_no='".$ev."'";
	  	$query123 = $this->db->where($where_array123 )->get($table_name123);
        if($query123->num_rows() > 0)
        {
		//
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		//set user as online
		$this->bidding_model->set_online_user($ev);
		
		$data['ev']=$ev;
		$data['details']=$this->bidding_model->user_event_details($ev);
		$data['users'] = $this->bidding_model->event_users($ev);
		$data['changes'] = $this->bidding_model->event_changes($ev);
		if($this->input->post())
		{
			/* send chat */
			if($this->input->post('add_chat') == 'add_chat')
			{

				
				$this->form_validation->set_rules('camount', 'famount', 'required|trim');
				$this->form_validation->set_rules('cquantity', 'fquantity', 'required|trim');
				
			
				if($this->form_validation->run() == true)
				{
					$insert = $this->bidding_model->send_chat($ev);
					if($insert)
					{
						$this->session->set_flashdata('successMsg', ' Request has been sent Successfully...!!!');
						
					}
					else{
						echo "error";
						}
				}
			}
			/* send freez request */
			if($this->input->post('freez') == 'freez')
			{

				$this->form_validation->set_rules('seller', 'seller', 'required|trim');
				$this->form_validation->set_rules('famount', 'famount', 'required|trim');
				$this->form_validation->set_rules('fquantity', 'fquantity', 'required|trim');
				
			
				if($this->form_validation->run() == true)
				{
					$insert = $this->bidding_model->send_freez_request($ev);
					if($insert)
					{
						$this->session->set_flashdata('successMsg', ' Request has been sent Successfully...!!!');
						
					}
					else{
						echo "error";
						}
				}
			}
			//Update bidding
			if($this->input->post('update') == 'update') 
			{

				$this->form_validation->set_rules('amount', 'amount', 'required|trim');
				$this->form_validation->set_rules('quantity', 'quantity', 'required|trim');
				
			
				if($this->form_validation->run() == true)
				{
					$insert = $this->bidding_model->update_bidding($ev);
					if($insert)
					{
						$this->session->set_flashdata('successMsg', ' Successfully Updated ...!!!');
						
					}
					else{
						echo "error";
						}
				}
			}
			//set user as offline
			if($this->input->post('logout') == 'logout')
			{
				$logout = $this->set_offline_user($ev);
				if($logout)
					{
						$this->session->set_flashdata('successMsg', ' Logout Successfully ...!!!');
						redirect('bidding/my_bidding_events');
						
					}
				
				
				
			}
		//	theme('add_bidding');
		}
		theme('bidding_event_chat',$data);
		}
		else
		{
			permittedArea();
		}
	}
	/* View */
	public function bidding_view($bno)
    {
		$data['bidding'] = $this->bidding_model->bidding_view($bno);
		$data['details'] = $this->bidding_model->bidding_view_details($bno);
		theme('bidding_view', $data);
        
    }
	public function bidding_event_view($eno)
    {
		$data['event'] = $this->bidding_model->event_view($eno);
		$data['products'] = $this->bidding_model->event_products();
		if($this->input->post())
		{
			if($this->input->post('submit') != 'upadte') die('Error! sorry');
			$this->form_validation->set_rules('elocation', 'elocation ', 'required|trim');
            $this->form_validation->set_rules('f_time', 'f_time ', 'required|trim');
			$this->form_validation->set_rules('t_time', 'f_time ', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$update = $this->bidding_model->update_event($eno);
				if($update)
				{
					$this->session->set_flashdata('successMsg', 'Updated Successfully!!!');
					redirect(base_url('bidding/bidding_events'));
				}
			}
			
		}
		theme('bidding_event_view', $data);
        
    }
	public function bidding_event_report_view($eno)
    {
		$data['event'] = $this->bidding_model->event_view($eno);
		$data['event_users'] = $this->bidding_model->list_event_users($eno);
		$data['users_chat'] = $this->bidding_model->users_chat($eno);
		$data['freez_request'] = $this->bidding_model->list_freez_request($eno);
		$data['event_track'] = $this->bidding_model->list_event_track($eno);
		
		theme('bidding_event_report_view', $data);
        
    }
	/*Freez  Request */
	public function freez_decline($cid)
	{
		$send = $this->bidding_model->freez_decline($cid);
		if($send)
		{
			redirect(base_url('bidding/bidding_event_chat/'.$send));
		}
			
	}
	public function bidding_freez_now($cid)
	{
		$where_array = array( 'id' => $cid );
		$table_name="bidding_user_chat";
		$query = $this->db->where($where_array )->get($table_name);
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$event_no=$row->event_no;
			}
		}
		$send = $this->bidding_model->bidding_freez_now($cid);
		if($send)
		{
			$this->session->set_flashdata('successMsg', 'Request has been sent Successfully!!!');
			redirect(base_url('bidding/bidding_event_chat/'.$send));
		}
		else
		{
			$this->session->set_flashdata('errorMsg', 'Sorry requested quantity not available!!!');
			redirect(base_url('bidding/bidding_event_chat/'.$event_no));
		}
			
	}
	/*Freez  Approve */
	public function bidding_freez_accept($fid)
	{
		$where_array = array( 'id' => $fid );
		$table_name="bidding_freez";
		$query1 = $this->db->where($where_array )->get($table_name);
		if($query1->num_rows() > 0)
		{
			foreach($query1->result() as $row)
			{
				$event_no=$row->event_no;
			}
		}
		$accept = $this->bidding_model->bidding_freez_accept($fid);
		if($accept)
		{
			$this->session->set_flashdata('successMsg', 'Accepted Successfully!!!');
			redirect(base_url('bidding/bidding_event_chat/'.$accept));
		}
		else
		{
			$this->session->set_flashdata('errorMsg', 'Sorry requested quantity not available!!!');
			redirect(base_url('bidding/bidding_event_chat/'.$event_no));
		}
			
	}

		
	/* Approve */
	public function bidding_approve($bno){
		
		$data['id'] = $bno;
		$data['event_managers'] = $this->bidding_model->get_EM();
			
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'approve') die('Error! sorry');
            $this->form_validation->set_rules('event_manager', 'event_manager ', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->bidding_model->bidding_approve($bno);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Approved Successfully!!!');
					redirect(base_url('bidding/bidding_list'));
				}
			}
			
		}

		theme('bidding_approve',$data);
	}
	public function create_bidding_event()
	{
		
		$data['products'] = $this->bidding_model->event_products();
		$data['countrys'] = $this->db->group_by('country')->get('pincode');
		if($this->input->post())
		{
			if($this->input->post('submit') != 'create') die('Error! sorry');
            $this->form_validation->set_rules('product', 'product ', 'required|trim');
			$this->form_validation->set_rules('elocation', 'elocation ', 'required|trim');
			$this->form_validation->set_rules('f_time', 'f_time ', 'required|trim');
			$this->form_validation->set_rules('t_time', 'f_time ', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->bidding_model->create_event();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Created Successfully!!!');
					redirect(base_url('bidding/bidding_list'));
				}
			}
			
		}
		
		theme('create_bidding_event',$data);
	}
	/**
	 * count
	 */
	 public function get_user_count()
	 {
		 $product=$_POST['product'];
		// echo $categ;
		 $result = $this->bidding_model->get_user_count($product);
		 echo '<input type="text" name="user_count" value="'.$result.'">';
	 }
	 
	 
	 
	 	public function get_shipper_location()
	{
		$shipper_pin = $_POST['shipper_pin'];
		if($shipper_pin != "")
		{
			$where_array = array('id' => $shipper_pin );
			$table = "pincode";
			$query = $this->db->where($where_array)->get($table);
			foreach($query->result() as $res)
			{
				
			echo	'<div class="form-group">
                            <label for="shipper_location" class="col-md-3">Location
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="shipper_location">
									<input type="text" name="shipper_location" id="location" class="form-control" value="'.$res->location.'" >
								</div>
								
                            </div>
                        </div>
						
						<div class="form-group">
						<label for="shipper_district" class="col-md-3">District
							<span class="text-red"></span>
						</label>
						<div class="col-md-9" >
							<div id="shipper_district">
								<input type="text" name="shipper_district" class="form-control" id="district" value="'.$res->district.'" >
							</div>
								
							</div>
						</div>
						
						<div class="form-group">
                            <label for="shipper_state" class="col-md-3">State
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="shipper_state">
									<input type="text" name="shipper_state" class="form-control" value="'.$res->state.'" >
								</div>
								
                            </div>
                        </div>';
				
				
				
			}
		}
		else{
			echo '<div class="form-group">
                            <label for="shipper_location" class="col-md-3">Location
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="shipper_location">
									<input type="text" name="shipper_location" class="form-control" value="" placeholder="Location">
								</div>
								
                            </div>
                        </div>
						
						<div class="form-group">
						<label for="shipper_district" class="col-md-3">District
							<span class="text-red"></span>
						</label>
						<div class="col-md-9" >
							<div id="shipper_district">
								<input type="text" name="shipper_district" class="form-control" value="" placeholder="District">
							</div>
								
							</div>
						</div>
						
						<div class="form-group">
                            <label for="shipper_state" class="col-md-3">State
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="shipper_state">
									<input type="text" name="shipper_state" class="form-control" value="" placeholder="State">
								</div>
								
                            </div>
                        </div>';
		}
		
	}
	public function bidding_event_report()
	{
		///* search n export */
		if($this->input->post())
		{
			///* search */
//			if($this->input->post('submit') == 'search')
//			{
//				$data['events'] = $this->bidding_model->event_search();
//			}
//			/*export */
//			else 
			if($this->input->post('submit') == 'csv')
			{
				$data['events'] = $this->bidding_model->export_to_csv();
			}
			else if($this->input->post('submit') == 'pdf')
			{
				$data['events'] = $this->bidding_model->export_to_pdf();
				
				$this->load->library('pdf');
				$this->pdf->load_view('bidding_event_pdf', $data);
				$this->pdf->render();
				$this->pdf->stream("Bidding Events-at-".date('d-m-Y-h:i').".pdf");
			}
			
		}
//		else
//		{
//		$data['events'] = $this->bidding_model->bidding_event_report();
//		}
		theme('bidding_event_report');
	}
	public function bidding_event__ListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		
		$queryCount = $this->bidding_model->bidding_ListCount();

		
		$query = $this->bidding_model->bidding_event_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
			if($query -> num_rows() > 0) 
			  {
				foreach($query->result() as $r)
				{
					//PRODUCT NAme
					$query1 = $this->db->get_where('smb_product', ['id' => $r->product,]);
					if ($query1->num_rows() > 0) {
						foreach ($query1->result() as $row) {
							$product = $row->title;
						}
					} else {
						 $product =  " ";
					}
					//Craeted by NAme
					$query2 = $this->db->get_where('users', ['id' => $r->created_by,]);
					if ($query2->num_rows() > 0) {
						foreach ($query2->result() as $row2) {
							$created_by = $row2->first_name.' '.$row2->last_name;
						}
					} else {
						 $created_by =  " ";
					}
					//Status
					if($r->status==1)
					{
						$status='Active';
					}
					else
					{
						$status='Inactive';
					}

			//Action Button
			$button = '';
        	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('bidding/bidding_event_report_view/'. $r->event_no).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

					$data['data'][] = array(
					$button,
						$r->event_no,
						$r->location,
						$created_by,						
						$product,
						count(explode(',',$r->users)),				
						$r->start_time,											
						$r->end_time,	
						$status					
								
				
					);
				}
		}else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','','','','','',''
			);
		}
				echo json_encode($data);

			}
	public function search__ListJson()
	{
		$location=$_POST['location'];
		$sf_time=$_POST['sf_time'];
		$st_time=$_POST['st_time'];
		$ef_time=$_POST['ef_time'];
		$et_time=$_POST['et_time'];
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		
		//
		$queryCount = $this->bidding_model->event_search_count($location,$sf_time,$st_time,$ef_time,$et_time);

		
		$query = $this->bidding_model->event_search($limit, $start,$location,$sf_time,$st_time,$ef_time,$et_time);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		//
		
      if($query -> num_rows() > 0) 
			  {
				foreach($query->result() as $r)
				{
					//PRODUCT NAme
					$query1 = $this->db->get_where('smb_product', ['id' => $r->product,]);
					if ($query1->num_rows() > 0) {
						foreach ($query1->result() as $row) {
							$product = $row->title;
						}
					} else {
						 $product =  " ";
					}
					//Craeted by NAme
					$query2 = $this->db->get_where('users', ['id' => $r->created_by,]);
					if ($query2->num_rows() > 0) {
						foreach ($query2->result() as $row2) {
							$created_by = $row2->first_name.' '.$row2->last_name;
						}
					} else {
						 $created_by =  " ";
					}
					//Status
					if($r->status==1)
					{
						$status='Active';
					}
					else
					{
						$status='Inactive';
					}

			//Action Button
			$button = '';
        	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('bidding/bidding_event_report_view/'. $r->event_no).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

					$data['data'][] = array(
					$button,
						$r->event_no,
						$r->location,
						$created_by,						
						$product,
						count(explode(',',$r->users)),				
						$r->start_time,											
						$r->end_time,	
						$status					
								
				
					);
				}
		}else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','','','','','',''
			);
		}
				echo json_encode($data);

	}
	public function search_productwise()
	{
		$bev=$_POST['bev'];
		$bprod=$_POST['bprod'];
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		
		//$queryCount = $this->bidding_model->bidding_ListCount();
		$query = $this->bidding_model->search_productwise($limit, $start,$bev,$bprod);
       echo ' <thead>
		<tr>
			<th>Action</th>
			<th>Event No.</th>
			<th>Created By</th>
			<th>Product</th>
			<th>Max Amount</th>
			<th>Min Amount</th>
			
		</tr>
		</thead>
		<tbody>';
		if($query -> num_rows() > 0) 
			  {
				foreach($query->result() as $r)
				{
					//PRODUCT NAme
					$query1 = $this->db->get_where('smb_product', ['id' => $r->confirmed_product]);
					if ($query1->num_rows() > 0) {
						foreach ($query1->result() as $row) {
							$product = $row->title;
						}
					} else {
						 $product =  " ";
					}
					//Craeted by NAme
					$query2 = $this->db->get_where('users', ['id' => $r->created_by,]);
					if ($query2->num_rows() > 0) {
						foreach ($query2->result() as $row2) {
							$created_by = $row2->first_name.' '.$row2->last_name;
						}
					} else {
						 $created_by =  " ";
					}
					//Status
					if($r->status==1)
					{
						$status='Active';
					}
					else
					{
						$status='Inactive';
					}

						//Action Button
						$button = '';
						$button .= '<a class="btn btn-primary editBtn" href="'.base_url('bidding/bidding_event_report_view/'. $r->event_no).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						echo ' <tr>
								<td>'.$button.'</td>
								<td>'.$r->event_no.'</td>
								<td>'.$created_by.'</td>
								<td>'.$product.'</td>
								<td>'.$r->confirmed_amount.'</td>
								<td>'.$r->confirmed_amount.'</td>
							</tr>';
						}
					}
					else
					{
			   			echo '<tr><td>No results found</td></tr>';
					}
	   
	   echo ' </tbody>

		<tfoot>
		<tr>
			<th>Action</th>
			<th>Event No.</th>
			<th>Created By</th>
			<th>Product</th>
			<th>Max Amount</th>
			<th>Min Amount</th>

		</tr>
		</tfoot>';
	}
	public function chat_history()
	{
		$bev=$_POST['bev'];
		$bprod=$_POST['bprod'];
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		
		//$queryCount = $this->bidding_model->bidding_ListCount();
		$query = $this->bidding_model->search_productwise($limit, $start,$bev,$bprod);
       
		if($query -> num_rows() > 0) 
		{
			foreach($query->result() as $r)
			{
				//
				echo '<h3 class="box-title" style="color:#3c8dbc"><strong>Chat History</strong></h3>';
				$users_chat = $this->bidding_model->users_chat($r->event_no);
				if(!empty($users_chat))
				{
					echo '<table class="table table-bordered table-striped table-hover">
						<thead>
                        <tr role="row">
                       		<th>No</th>
                            <th>Requested By</th>
                            <th>Requested Amount</th>
                            <th>Requested Quantity</th>
                            <th>Requested At</th>
                            <th>Freezed?</th>
                        </tr>
                        </thead>
                        <tbody>';
						$cnt2=1;
					foreach($users_chat as $chats) 
					{
					echo '<tr>
                        	<td>'.$cnt2.'</td>
                            <td>'.$chats['requested_by'].'</td>
                            <td>'. $chats['requested_amount'].'</td>
                            <td>'. $chats['requested_quantity'].'</td>
                            <td>'. date('d/m/Y h:i A',$chats['requested_at']).'</td>
                            <td>'. $chats['freez'].'</td>
                         </tr>';
						 $cnt2 ++; 
					 }
					 echo '</tbody>
                        </table>';
				}
				//
				//
				echo ' <h3 class="box-title" style="color:#3c8dbc"><strong>Freez Requests </strong></h3>';
				$freez_request = $this->bidding_model->list_freez_request($r->event_no);
				//$data['event_track'] = $this->bidding_model->list_event_track($eno);
				if(!empty($freez_request))
				{
					echo '<table class="table table-bordered table-striped table-hover">
						<thead>
                        <tr role="row">
                       		<th>No</th>
                            <th>Freez ID</th>
                            <th>Requested By</th>
                            <th>Requested To</th>
                            <th>Requested Amount</th>
                            <th>Requested Quantity</th>
                            <th>Requested At</th>
                            <th>Request Accept?</th>
                        </tr>
                        </thead>
                        <tbody>';
						$cnt3=1;
					foreach($freez_request as $requests) 
					{
					echo '<tr>
                        	<td>'.$cnt3.'</td>
                            <td>'. $requests['freez_id'].'</td>
                            <td>'. $requests['requested_by'].'</td>
                            <td>'. $requests['requested_to'].'</td>
                           <td>'. $requests['requested_amount'].'</td>
                           <td>'. $requests['requested_quantity'].'</td>
                           <td>'. date('d/m/Y h:i A',$requests['requested_at']).'</td>
                           <td>'. $requests['request_accept'].'</td>
                        </tr>';
						$cnt3 ++; 
					 }
					 echo '</tbody>
                        </table>';
				}
				//
				//
				echo ' <h3 class="box-title" style="color:#3c8dbc"><strong>Track</strong></h3>';
				$event_track = $this->bidding_model->list_event_track($r->event_no);
				if(!empty($event_track))
				{
					echo '<table class="table table-bordered table-striped table-hover">
						<thead>
                        <tr role="row">
                       		<th>No</th>
                            <th>Seller</th>
                            <th>Buyer</th>
                            <th>Confirmed By</th>
                            <th>Confirmed Amount</th>
                            <th>Confirmed Quantity</th>
                            <th>Release Fund?</th>
                        </tr>
                        </thead>
                        <tbody>';
						$cnt4=1;
					foreach($event_track as $tracks) 
					{
					echo '<tr>
                        	<td>'. $cnt4.'</td>
                            <td>'. $tracks['bidding_user_seller'].'</td>
                            <td>'. $tracks['bidding_user_buyer'].'</td>
                            <td>'. $tracks['confirmed_user'].'</td>
                           <td>'. $tracks['confirmed_amount'].'</td>
                           <td>'. $tracks['confirmed_quantity'].'</td>
                           <td>'. $tracks['release_fund'].'
                           <br>
                           Total_quantity :'. $tracks['total_quantity'].'<br>
                           Damaged :'. $tracks['damaged'].'<br>
                           Released Amount :'. $tracks['released_amount'].'<br>
                           
                           </td>
                          
                        </tr>';
						$cnt4 ++; 
					 }
					 echo '</tbody>
                        </table>';
				}
				//
			 }
		}
		else
		{
			echo '<tr><td>No results found</td></tr>';
		}
	   
	  
	}
	public function bidding_product_wise()
	{
		$data['bevents'] = $this->bidding_model->bidding_events();
		$data['bproducts'] = $this->bidding_model->bidding_event_products();
		theme('bidding_product_wise',$data);
	}
	public function bidding_user_report()
	{
		theme('bidding_user_report');
	}
	public function user_report()
	{
		
		$sf_time=$_POST['sf_time'];
		$st_time=$_POST['st_time'];
		$ef_time=$_POST['ef_time'];
		$et_time=$_POST['et_time'];
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		
		//
		$queryCount = $this->bidding_model->user_search_count($sf_time,$st_time,$ef_time,$et_time);

		
		$query = $this->bidding_model->user_search($limit, $start,$sf_time,$st_time,$ef_time,$et_time);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		//
		
      if($query -> num_rows() > 0) 
			  {
				foreach($query->result() as $r)
				{
					//PRODUCT NAme
					$query1 = $this->db->get_where('smb_product', ['id' => $r->product,]);
					if ($query1->num_rows() > 0) {
						foreach ($query1->result() as $row) {
							$product = $row->title;
						}
					} else {
						 $product =  " ";
					}
					//Craeted by NAme
					$query2 = $this->db->get_where('users', ['id' => $r->created_by,]);
					if ($query2->num_rows() > 0) {
						foreach ($query2->result() as $row2) {
							$created_by = $row2->first_name.' '.$row2->last_name;
						}
					} else {
						 $created_by =  " ";
					}
					//Status
					if($r->status==1)
					{
						$status='Active';
					}
					else
					{
						$status='Inactive';
					}

			//Action Button
			$button = '';
        	$button .= '<a class="btn btn-primary editBtn" href="'.base_url('bidding/bidding_user_report_view/'. $r->event_no).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

					$data['data'][] = array(
					$button,
						$r->event_no,
						$r->location,
						$created_by,						
						$product,
						count(explode(',',$r->users)),				
						$r->start_time,											
						$r->end_time,	
						$status					
								
				
					);
				}
		}else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','','','','','',''
			);
		}
				echo json_encode($data);

	}
	public function bidding_user_report_view($eno)
    {
		$data['event'] = $this->bidding_model->event_view($eno);
		$data['event_users'] = $this->bidding_model->list_event_users($eno);
		$data['users_chat'] = $this->bidding_model->users_chat($eno);
		$data['freez_request'] = $this->bidding_model->list_freez_request($eno);
		$data['event_track'] = $this->bidding_model->list_event_track($eno);
		
		theme('bidding_user_report_view', $data);
        
    }
}
?>