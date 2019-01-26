<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher_redeem_model extends CI_Model {

   
    public function invoiceListCount(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            $query = $this->db->count_all_results('invoice');
        }
        elseif($user['role'] == 'agent'){
            $query = $this->db->where('sales_by', $userID)->count_all_results('invoice');
        }
        elseif($user['role'] == 'user'){
			//$where_array = array ('sales_by' => $userID, 'customer_id' => $userID);
            $query = $this->db->where('sales_by', $userID)->count_all_results('invoice');       
        }
        return $query;
    }
	
	
	/**
     * @return Invoice data
     */
 
		
    public function invoiceList($limit = 0, $start = 0 ){
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$search = $this->input->get('search');
		$searchValue = $search['value'];

		$searchByID = '';
		//Get Decision who in online?
		if($user['role'] == 'admin')
		{
			if($searchValue != '')
			{
				$searchByID = " WHERE invoice.id = '{$searchValue}'";
			}

			$query = $this->db->query("select invoice.*, users.first_name as userFirstName,
				users.last_name as userLastName, users.street_address as userStreetAddress,
				agent.first_name as agentFirstName, agent.last_name as agentLastName,
				agent.street_address as agentStreetAddress
				from invoice LEFT JOIN users
				ON invoice.customer_id = users.id
				LEFT JOIN users AS agent ON invoice.sales_by = agent.id
				{$searchByID}
				ORDER BY invoice.id DESC Limit {$start}, {$limit}");
		}
		elseif($user['role'] == 'agent')
		{

			if($searchValue != '')
			{
				$searchByID = " AND invoice.id = '{$searchValue}'";
			}

			$query = $this->db->query("select invoice.*, users.first_name as userFirstName,
				users.last_name as userLastName, users.street_address as userStreetAddress,
				agent.first_name as agentFirstName, agent.last_name as agentLastName,
				agent.street_address as agentStreetAddress
				from invoice LEFT JOIN users
				ON invoice.customer_id = users.id
				LEFT JOIN users AS agent ON invoice.sales_by = agent.id
				WHERE invoice.customer_id = {$userID}  {$searchByID}
				ORDER BY invoice.id DESC Limit {$start}, {$limit}");

		}
		elseif($user['role'] == 'user')
		{
			if($searchValue != '')
			{
				$searchByID = " AND invoice.id = '{$searchValue}'";
			}

			$query = $this->db->query("select invoice.*, users.first_name as userFirstName,
				users.last_name as userLastName, users.street_address as userStreetAddress,
				agent.first_name as agentFirstName, agent.last_name as agentLastName,
				agent.street_address as agentStreetAddress
				from invoice LEFT JOIN users
				ON invoice.customer_id = users.id
				LEFT JOIN users AS agent ON invoice.sales_by = agent.id
				WHERE invoice.sales_by = {$userID}  {$searchByID}
				ORDER BY invoice.id DESC Limit {$start}, {$limit}");
		}
		
		return $query;
	}
	

    /**
     * @param int $id
     * @return mixed
     * Get invoice details
     *
     */

    public function getInvoiceDetails($id = 0){

        $query = $this->db->query("select invoice.*, users.first_name as userFirstName,
				users.last_name as userLastName,
				users.contactno as userContactNo, users.email as userEmail,
				users.street_address as userStreetAddress,

				agent.first_name as agentFirstName, agent.last_name as agentLastName,
				agent.contactno as agentContactNo, agent.email as agentEmail,
				agent.street_address as agentStreetAddress
				from invoice LEFT JOIN users
				ON invoice.customer_id = users.id
				LEFT JOIN users AS agent ON invoice.sales_by = agent.id WHERE invoice.id = {$id}");

        return $query;
    }

    /**
     * @param int $id
     * @return mixed
     * return all sales item by invoice id with category name
     */

    public function getAllItemByInvoice($id = 0){
      
        $query = $this->db->query("select sales_item.*, acct_categories.name as categoryName
                from sales_item LEFT JOIN acct_categories
                ON sales_item.category_id = acct_categories.id
                WHERE sales_item.invoice_id = {$id}");
        return $query;
		
    }

	public function vouchers_transactions(){
	
		$user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
	
		$data2 = [
			'used'			=>'yes',
			'reserved'		=> 'yes',
			'reserved_at'   => time(), 
            'reserved_by'   => $user_user_id
        ];
		
		$voucher_id = $this->input->post('all_vouchers');
		$test = explode(',' , $voucher_id);
		foreach($test as $test2)
		{
			
			$query3 = $this->db->where('voucher_id', $test2)->update('vouchers', $data2);
		}
		
        if($query3)
        {
            create_activity('Added '.$data2['reserved_by'].' as payee payment'  ); //create an activity

            return true;
        }
        return false;

	}

	public function make_voucher_payment(){
	
		$logged_user_info = $this->session->userdata('logged_user');
        $logged_user_id = $logged_user_info['user_id'];
		
		$payee_consumer_id = $this->input->post('payee_consumer_id');
		$get_payee = $this->db->get_where('users', ['referral_code'=>$payee_consumer_id]);
		foreach($get_payee->result() as $u);
		$to_user = $u->id;
		
		$voucher_name = $this->input->post('voucher_type');
		$voucher_description = $this->input->post('voc_type');
		$voucher_id = $this->input->post('all_vouchers');
		$user_id = $to_user;
		$email = singleDbTableRow($to_user)->email;
		$pay_type = 95;
		$paytype_to = 96;
		$account_no = singleDbTableRow($to_user)->account_no;
		$amount = $this->input->post('total_voc_amount');
		$points_mode = 'wallet';
		$to_role = singleDbTableRow($to_user)->rolename;;
		
		$service_type = $this->input->post('service_type');
		$table_no = $this->input->post('table_no');
		
		
		$limit = '1';	
		$start = '0';	
 	
		$result_count = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('vouchers', ['user_id'=>$user_id, 'reserved_by'=>$user_id, 'paid_to'=>$user_id]);	
		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       
				$value 	= $r->tran_count;
			}
			if($value == 0)
			{	
				$tran_count = 1;
			}
			else{
				$tran_count = $value + 1;
			}
		}
		else{
			$tran_count = 1;
		}
		
		$token_no = $tran_count;
		$start_date = date("Y-m-d"); 
		
		$data = [
			'voucher_name'			=>	$voucher_name,
			'voucher_description'	=> 	$voucher_description,
			'voucher_id'   			=> 	$voucher_id, 
            'user_id'   			=> 	$user_id,
            'email'   				=> 	$email,
            'pay_type'   			=> 	$pay_type,
            'paytype_to'   			=> 	$paytype_to,
            'account_no'   			=> 	$account_no,
            'amount'   				=> 	$amount,
            'points_mode'   		=> 	$points_mode,
            'loy_amt'   			=> 	0,
            'dis_amt'   			=> 	0,
            'used'   				=> 	'no',
			'start_date'  			=>  $start_date,
			'end_date' 				=>  '2020-12-31',
            'used_by'   			=> 	0,
            'used_for'   			=> 	'',
            'reserved'   			=> 	'yes',
            'reserved_at'   		=> 	time(),
            'reserved_by'   		=> 	$user_id,
            'to_role'   			=> 	$to_role,
            'created_by'   			=> 	$logged_user_id,
            'created_at'   			=> 	time(),
            'transferrable'   		=> 	'no',
            'paid_by'   			=> 	$logged_user_id,
            'paid_to'   			=> 	$user_id,
            'tran_count'   			=> 	$tran_count,
            'token_no'   			=> 	$token_no,
            'service_type'   		=> 	$service_type,
            'table_no'   			=> 	$table_no
		];
		
		$query = $this->db->insert('vouchers', $data);
		
		
		
		
		$data2 = [
			'used'				=> 	'yes',
			'used_by'			=> 	$logged_user_id,
			'paid_by'   			=> 	$logged_user_id,
            'paid_to'   			=> 	$user_id,
			'reserved'			=> 	'yes',
			'reserved_at'   	=> 	time(), 
            'reserved_by'  		=> 	$user_id,
            'modified_by'   	=> 	$user_id,
            'modified_at'   	=> 	time()
        ];
		
		
		$test = explode(',' , $voucher_id);
		foreach($test as $test2)
		{
			$query3 = $this->db->where('voucher_id', $test2)->update('vouchers', $data2);
		}
		
        if($query && $query3)
        {
            create_activity('Added '.$data['voucher_description'].' as voucher payment'  ); //create an activity

            return true;
        }
        return false;

	}
	
		
	public function user_payments_list_count(){
	//	$query = $this->db->where('digital','no')->count_all_results('smb_category');
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$query = $this->db->get_where('vouchers', ['created_by' => $user_id, 'paid_by' => $user_id])->num_rows();
        return $query;
    }

    public function user_payments_list($limit = 0, $start = 0){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
	
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('vouchers', ['created_by' => $user_id, 'paid_by' => $user_id]);
			
		return $query;
    }


	public function vendor_receive_payments_list_count(){
	//	$query = $this->db->where('digital','no')->count_all_results('smb_category');
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$query = $this->db->get_where('vouchers', ['user_id' => $user_id, 'paid_to' => $user_id])->num_rows();
        return $query;
    }

    public function vendor_receive_payments_list($limit = 0, $start = 0){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
	
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('vouchers', ['user_id' => $user_id, 'paid_to' => $user_id]);
			
		return $query;
    }
	
	public function accept_payment($id){
		
		$logged_user_info = $this->session->userdata('logged_user');
        $logged_user_id = $logged_user_info['user_id'];
		
		$get_details = $this->db->get_where('vouchers', ['id'=>$id]);
		
		if($get_details->num_rows() > 0){
			foreach($get_details->result() as $voucher);
			
			//Account Transaction Detail
			
			$pay_by_referral_code 	= 	'2398760145';	
			$pay_to_referral_code 	= 	singleDbTableRow($voucher->paid_to)->referral_code;;
			$amount_to_pay		  	=	$voucher->amount;		
			$pay_spec_type			=	'96';				
			$transaction_remarks	=	"Payment With Voucher";	
			$pm_mode				=	"wallet";
			
			$make_my_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);
			
			if($make_my_payment){
				
				$data = [
					'used'				=> 	'yes',
					'used_by'			=> 	$logged_user_id,
					'modified_by'   	=> 	$logged_user_id,
					'modified_at'   	=> 	time()
				];
				
				$update = $this->db->where('id', $id)->update('vouchers', $data);
			}
		}
		if($update){
			create_activity('Added '.$data['modified_by'].' as payee payment'  );
			return true;
		}
		return false;
	}
	
	
	public function cancle_order($id){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		$voucher_id = singleDbTableRow($id, 'vouchers')->voucher_id;
		
		$data = [
            'modified_by'   	=> 	$user_id,
            'modified_at'   	=> 	time()
        ];
		
		$query = $this->db->where('voucher_id', $voucher_id)->update('vouchers', $data);
		
		$data2 = [
			'used'				=> 	'no',
			'used_by'			=> 	0,
			'paid_by' 		  	=> 	0,
            'paid_to'   		=> 	0,
			'reserved'			=> 	'',
			'reserved_at'   	=> 	0, 
            'reserved_by'  		=> 	0,
            'modified_by'   	=> 	$user_id,
            'modified_at'   	=> 	time()
        ];
		
		
		$test = explode(',' , $voucher_id);
		foreach($test as $test2)
		{
			$query2 = $this->db->where('voucher_id', $test2)->update('vouchers', $data2);
		}
		if($query2){
			create_activity('Added '.$data['modified_by'].' as payee payment'  );
			return true;
		}
		return false;
	}
	
	
	public function reset_token(){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		$limit = '1';	
		$start = '0';	
 	
		$result_count = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('vouchers', ['user_id'=>$user_id, 'reserved_by'=>$user_id, 'paid_to'=>$user_id]);	
		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       
				$value 	= $r->tran_count;
			}
		}
		$condition = " user_id = '".$user_id."' AND paid_to = '".$user_id."' AND tran_count = '".$value."' ";
		$update = $this->db->where($condition)->update('vouchers', ['tran_count'=>0]);
		if($update){
			create_activity('Added '.$user_id.' as payee payment'  );
			return true;
		}
		return false;
	}
	
	public function search_token_ListCount($consumer, $token_no, $from_date, $to_date, $on_date){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$condition = "paid_to = ".$user_id." ";
		
		if($consumer !='')
		{
			if($condition != ""){
				$condition.=" AND paid_by = '".$consumer."'";
			}
			else{
				$condition.="paid_by = '".$consumer."'";
			}
		}
		
		if($token_no !='')
		{
			if($condition != ""){
				$condition.=" AND token_no = '".$token_no."'";
			}
			else{
				$condition.="token_no = '".$token_no."'";
			}
		}
		
		if($on_date !='')
		{
			$selected_date = new DateTime($on_date);
			$search_date = $selected_date->format('Y-m-d');
			
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(created_at)) = '".$search_date."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) = '".$search_date."'";
			}
		}
		
		if($from_date !='' && $to_date !='')
		{
			$start_fdt = new DateTime($from_date);
			$start_from = $start_fdt->format('Y-m-d');
			
			$start_tdt = new DateTime($to_date);
			$start_to = $start_tdt->format('Y-m-d');
			
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
		
		
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('vouchers'); 
		}
		else
		{
			$query = $this->db->count_all_results('vouchers'); 
		}
        return $query;
		
	}
	
	public function search_token_List($limit, $start, $consumer, $token_no, $from_date, $to_date, $on_date){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$condition = "paid_to = ".$user_id." ";
		
		if($consumer !='')
		{
			if($condition != ""){
				$condition.=" AND paid_by = '".$consumer."'";
			}
			else{
				$condition.="paid_by = '".$consumer."'";
			}
		}
		
		if($token_no !='')
		{
			if($condition != ""){
				$condition.=" AND token_no = '".$token_no."'";
			}
			else{
				$condition.="token_no = '".$token_no."'";
			}
		}
		
		if($on_date !='')
		{
			$selected_date = new DateTime($on_date);
			$search_date = $selected_date->format('Y-m-d');
			
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(created_at)) = '".$search_date."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) = '".$search_date."'";
			}
		}
		
		if($from_date !='' && $to_date !='')
		{
			$start_fdt = new DateTime($from_date);
			$start_from = $start_fdt->format('Y-m-d');
			
			$start_tdt = new DateTime($to_date);
			$start_to = $start_tdt->format('Y-m-d');
			
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
		
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('vouchers'); 
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('vouchers');	
		}
        
        return $query;
	}

}//Last Brace Required