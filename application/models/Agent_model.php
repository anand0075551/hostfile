<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_model extends CI_Model {

   /**
     * @return bool
     */

    public function otp_transactions(){
			
        $user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code   = singleDbTableRow($user_user_id)->referral_code;	
		$user_account_no     = singleDbTableRow($user_user_id)->account_no;
		$user_rolename	     = singleDbTableRow($user_user_id)->rolename;
		$user_mobile         = singleDbTableRow($user_user_id)->contactno;
		$user_fname          = singleDbTableRow($user_user_id)->first_name;
		$user_lname          = singleDbTableRow($user_user_id)->last_name;
		$ref_name = $user_fname.' '.$user_lname;
        $this->load->helper('string'); //load string helper
		
		$agent_referredCode = $this->input->post('referredByCode');
		
	if ($agent_referredCode != $user_referral_code)	
    {    $otp  = random_string('numeric', 4);  //4 digits Unique OTP_code
		
        //check unique OTP_code

        $getOTP = $this->db->get_where('otp_transactions', ['otp'=> $otp]);
        if($getOTP -> num_rows() > 0)
        {
            for($i= 0; $getOTP->num_rows() > 0; $i++){
			             
			//   $otp  = strtoupper(random_string()); //comment next line for integer only
				$otp .= mt_rand(0, 9);
                $getOTP = $this->db->get_where('otp_transactions', ['otp'=> $otp]);
            }
        }
		
		
		//$company_name 		= $this->input->post('name');
		//$company_licence	= $this->input->post('licence');
		//$company_email 		= $this->input->post('email');		
		//$agent_cell 		= $this->input->post('contactno');
		//$agreed_per 		= $this->input->post('agreed_per');
		
		$sponsor_role = $this->input->post('sponsor_role');
		$deduction 	  = '0'; //$this->input->post('deduction');  //who is Paying Fees?
		
		
		
//*****************       Begin of   Sponsorship fees deduction     ***********************///		
		
		$table_name = "users";			
			$where_array = array('referral_code' => $agent_referredCode);
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$agent_user_id 		 = $r->id;
					$agent_rolename		 = $r->rolename;
					$agent_email		 = $r->email;
					$agent_first_name    = $r->first_name;
					$agent_last_name     = $r->last_name;             
				    $agent_gender        = $r->gender;
					$agent_dob			 = $r->date_of_birth;
					$agent_adhaar_no     = $r->adhaar_no;
					$agent_mobile        = $r->contactno;
					$agent_city_id       = $r->city_id;
				    $agent_country       = $r->country;
				    $agent_country_id    = $r->country_id;				   
					$agent_account_no    = $r->account_no;	
					$agent_photoName     = $r->photo;	
					$agent_pay_by		 = $r->referral_code;
					$agent_cell          = $r->contactno;
		
		$table_name = "role";
			$where_array = array('id' =>$sponsor_role);
			$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
		
				$fees = $row->fees;
				$pay_type			 = $row->dedfees_payspec;  //Fees to -Pay Specification 
				$ded_paytype	     = $row->comfees_payspec;  //Referal Commission from Payspec
				$com_per			 = $row->com_per;			//% value
				
				
				if ( $fees == '0' )
				{ $commission = '0';  //100
				}else{ 
					$commission = ( ($fees * $com_per ) / 100 );  //% of Fees is Referral Commission
				}
			
	//Fees Deduction
		 
	   if ($deduction == 'sponsor')  // Current User/Referrer
			{	
				
				
				//SMS
				$sms_no 	 = $agent_cell;   //Cross Authentication 
				$user_email  = $user_email;
				$fname       = $user_fname;
				$pay_by		 = $user_referral_code;
				$account_no  = $user_account_no ;   
				
				
				
			}else{                  //New agent's Consumer details
				
				//SMS
				$sms_no 	 = $user_mobile;  //Cross Authentication 
				$user_email  = $agent_email;
				$fname       = $agent_first_name;
				$pay_by		 = $agent_pay_by;
				$account_no  = $agent_account_no ; 
			}				
	$role = $this->input->post('sponsor_role');
	if ($agent_rolename	== '12')
	{	//OTP transaction Table
        $data1 = [
			'otp'					=> $otp,
		//	'key_id'				=> $this->input->post('key_id'),
			'rolename'		        => $user_rolename,
			'sponsor_role'          => $role ,
			'referredByCode'		=> $user_referral_code,
			'referral_code'			=> $agent_referredCode,
		//	'email'					=> $company_email,	
			'type'					=> 'referral',	
        //    'company_name'			=> $company_name,
		//	'account_no'         	=> $account_no,
			'pay_by'				=> $pay_by,
			'commission'       		=> $commission,            
			'fname'         		=> $ref_name,			
			'amount'         		=> $fees,	
			'points_mode' 			=> 'wallet',			
		//	'licence'				=> $company_licence,
			'from_cell'             => $user_mobile,
			'sms_no'				=> $agent_cell,
			'to_cell'				=> $agent_cell,
			'used'					=> 'yes',			
			'pay_type'         		=> $pay_type,
			'ded_paytype'         	=> $ded_paytype,
		//	'agreed_per'            => $agreed_per,
			'tranx_id'				=> 'Referral OTP',	
            'created_at'            => time(), 
            'modified_at'           => time()
        ];
	
		
       $query1 = $this->db->insert('otp_transactions', $data1);
   
      
	              
        if($query1)
        {
          
			$this->notification_model->sms_ref_request($user_referral_code, $agent_referredCode, $role, $fees );
            return true;
        }
        return false;

		}else{
		 $this->session->set_flashdata('errorMsg', 'Please Enter Consumer ID Only'); 
        redirect($_SERVER['HTTP_REFERER']); // redirect with error
		
	}
		}				
	}
	}	
   
			
	}else{
		 $this->session->set_flashdata('errorMsg', 'Do not Enter your ID'); 
        redirect($_SERVER['HTTP_REFERER']); // redirect with error
		
	}
	
	}
/**
     * Agent Referral Creation
     */

    public function add_agent($id){
	$table_name = "otp_transactions";			
		$where_array = array('id' => $id);
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{		  
																	
					$key_id_old	  =  $r->key_id;
					$otp_old	  =  $r->otp;
					$company_role =  $r->sponsor_role;
					$agreed_per   =  $r->agreed_per;
					
					$key_id_new	= $this->input->post('key_id');
					$otp_new	= $this->input->post('otp');
			}
		}
	if 	( $otp_new == $otp_old && $key_id_new == $key_id_old) 
	{
        $this->load->helper('string'); //load string helper

        $row_password   = $this->input->post('password');
        $password       = sha1($row_password);
        $referral_code  = random_string('numeric',10);  //10 digits Unique referral_code
	//	$account_no     = random_string('numeric',20);	//20 digits Account number	

        //check unique $referral_code

        $getReferral = $this->db->get_where('users', ['referral_code'=> $referral_code]);
        if($getReferral -> num_rows() > 0)
        {
            for($i= 0; $getReferral -> num_rows() > 0; $i++){               
				  //   $referral_code  = strtoupper(random_string()); //comment next line for integer only
				$referral_code .= mt_rand(0, 9);
                $getReferral = $this->db->get_where('users', ['referral_code'=> $referral_code]);
            }
        }
		//check unique $account_no

     

//Referral Users data Input Fields		
		$user_info 			= $this->session->userdata('logged_user');
        $creater_id 		= $user_info['user_id'];
		
		$referrerCode 		= $this->input->post('consumerCode');
		$agentCode			= $this->input->post('agentCode');
		$company_name 		= $this->input->post('company_name');
		$company_licence	= $this->input->post('licence');
		
		if ($company_licence == null){
			$company_licence = 'NA';
		}
		$agreed_per			= $this->input->post('agreed_per');
		if ($agreed_per == null)
		{
			$agreed_per = 0;
		}
		//$company_role		= $this->input->post('sponsor_role');	//Rolename
		$amount 	  		= $this->input->post('amount');			//Deduction Amount
		$company_phone 		= $this->input->post('contactno');	    //Phone	
		$company_email 		= $this->input->post('email');		    //New Login ID
//Referral/Sponsorer Consumer Data	
	$table_name = "users";			
			$where_array = array('referral_code' => $referrerCode);
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{	
					$referrer_id		    = $r->id;
					$referrer_first_name    = $r->first_name;
					$referrer_last_name     = $r->last_name;             
				    $referrer_email         = $r->email;
					$referrer_dob			= $r->date_of_birth;
					$referrer_adhaar_no     = $r->adhaar_no;
					$referrer_rolename      = $r->rolename;
				    $referrer_country       = $r->country;
				    $referrer_country_id    = $r->country_id;	
					$referrer_account_no    = $r->account_no;					
				}	
			}		
					
//New Agents Consumer Data	
	$table_name = "users";			
			$where_array = array('referral_code' => $agentCode);
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$agent_first_name    = $r->first_name;
					$agent_last_name     = $r->last_name;             
				    $agent_gender        = $r->gender;
					$agent_dob			 = $r->date_of_birth;
					$agent_id_type       = $r->id_type;
					$agent_adhaar_no     = $r->adhaar_no;
					$agent_account_no    = $r->account_no;
					$agent_city_id       = $r->city_id;
				    $agent_country       = $r->country;
				    $agent_country_id    = $r->country_id;		
					$agent_postal_code   = $r->postal_code;						
					$agent_photoName     = $r->photo;
					$agent_ref_code      = $r->referral_code;	
				}
			}
			$account_no =  $agent_country_id.$agent_postal_code.$company_role.$referral_code;			
						 //set all data for inserting into User database as Agent Role
						 
							$data = [
							    'root_id'			=> $agent_ref_code ,	
								'first_name'        => ucfirst ($agent_first_name),
								'last_name'         => ucfirst ($agent_last_name),
								'password'          => $password,
								'row_pass'          => $row_password,
								'email'             => strtolower($company_email),
								'contactno'         => $company_phone,
								'gender'            => $agent_gender,
								'company_name'		=> $company_name,
								'licence'	        => $company_licence,
								'agreed_per'		=> $agreed_per,
								'date_of_birth'     => $agent_dob,
								'id_type'			=> $agent_id_type,
								'adhaar_no'         => $agent_adhaar_no,
								'city_id'           => $agent_city_id,
								'country'           => $agent_country,
								'country_id'        => $agent_country_id,
								'postal_code'		=> $agent_postal_code,
								'role'              => 'agent', 
								'rolename'          => $company_role,
								'active'            => 1,
								'referral_code'     => $referral_code,   //New Agent Referral Code
								'account_no'        => $account_no,		 //New Agent Account No	
								'referredByCode'    => $referrerCode,
								'photo'             => $agent_photoName,
								'created_by'        => $creater_id,
								'created_at'        => time(),
								'modified_at'       => time()
							];

						   $query9 = $this->db->insert('users', $data);

if ($query9)
		{
		$this->notification_model->new_agent_sms($agent_first_name, $row_password, $company_email, $company_role );	
		}
	   
//*****************       Begin of   Sponsorship fees deduction     ***********************///	

		
	
	//get OTP Data
	
	$otp_data = $this->db->get_where('otp_transactions', ['id' => $id]);
		foreach($otp_data->result() as $otp);
		
		{
			
			$commission 		= $otp->commission;		//Commission Value
			$amount				= $otp->amount;
			$account_no 		= $otp->account_no;
			$pay_by				= $otp->pay_by;
			$paytype_commission = $otp->ded_paytype;	 //For Commssion
			$paytype_collection = $otp->pay_type;       //Collect Fees
		}
		
		
		$table_name = "users";			
			$where_array = array('referral_code' => $pay_by);      //Sponsorship fees Paying User 'Pay_by'
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$pay_by_userID		  = $r->id;
					$pay_by_first_name    = $r->first_name;
					$pay_by_last_name     = $r->last_name;             
				    $pay_by_email         = $r->email;
					$pay_by_dob			  = $r->date_of_birth;
					$pay_by_adhaar_no     = $r->adhaar_no;
					$pay_by_account_no    = $r->account_no;
					$pay_by_rolename      = $r->rolename;
				    $pay_by_country       = $r->country;
				    $pay_by_country_id    = $r->country_id;			
					$pay_by_photoName     = $r->photo;
				}
			}
// Sponsorship Fees Deduction-----------------------------------
	$tranx_id1 = 'One time Sponsorship Charges Deduction';

	//Get Individual Account transactions series Id	
$acct_user 		= $pay_by_userID;
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 
{	foreach ($result_count->result() as $r)
	{       $value 		= $r->tran_count;  	
			if ($value != null )	
			{ $tran_count = $value + 1;				
			}else
			{	$tran_count = '1';}
        $accounts1 = [
			'user_id'         		=> $pay_by_userID, 
			'account_no'         	=> $pay_by_account_no,
            'rolename'  			=> $pay_by_rolename,
			'email'					=> $pay_by_email,
			'debit'         		=> '0',            
			'credit'         		=> $amount	,			
			'amount'         		=> $amount	,	
			'points_mode' 			=> 'wallet',
			'used'					=> 'yes',
			'paid_to'				=> '00',
			'pay_type'         		=> $paytype_collection,  
			'tranx_id'				=> $tranx_id1,	
			'tran_count'			=> $tran_count,
            'created_at'            => time(), 
            'modified_at'           => time()
        ];
       $query1 = $this->db->insert('accounts', $accounts1);
	}
}	
	   //SMS
	   $tran = '0'; // "$tran = 1" if 'Credit' == 0 & no amount value -OR- "$tran = 0" if 'debit' == 0 & no amount value 
		$sms_user = $pay_by_userID;
		$total_price = $amount;
		$pm_wallet = 'wallet';
		$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
//Ledger Update Charges Collection
  
	    $today = date("Y/m/d");
		
	
        //set all data for inserting into database
        $ledger1 = [
            'user_id'         		=> $pay_by_userID,
            'invoice_id '  			=> 'Sponsorship',
			'account_no'         	=> $pay_by_account_no,
            'rolename'  			=> $pay_by_rolename,
			'email'					=> $pay_by_email,
            'credit'         		=> '0',
			'debit'         		=> $amount,
			'amount'         		=> $amount,	
			'points_mode' 			=> 'wallet',
            'count'         		=> 'yes',						
            'start_date'         	=> $today,					
			'pay_type'				=> $paytype_collection,
			'remarks'         		=> $tranx_id1,	
			'challan'				=> 'no_invoice.jpg',			
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query4 = $this->db->insert('ledger', $ledger1);	
//--------------------------------------------------------------

// Commission to Referrer    -----------------------------------
	$tranx_id2 = 'Sponsorship Offer';
	//Get Individual Account transactions series Id	
$acct_user 		= $referrer_id;
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 
{	foreach ($result_count->result() as $r)
	{       $value 		= $r->tran_count;  	
			if ($value != null )	
			{ $tran_count = $value + 1;				
			}else
			{	$tran_count = '1';}
        $accounts2 = [
			'user_id'         		=> $referrer_id, 
			'account_no'         	=> $referrer_account_no,
            'rolename'  			=> $referrer_rolename,
			'email'					=> $referrer_email,
			'debit'         		=> $commission,
			'credit'         		=> '0',            		
			'amount'         		=> $commission,	
			'points_mode' 			=> 'wallet',
			'used'					=> 'no',
			'paid_to'				=> '00',
			'pay_type'         		=> $paytype_commission,  
			'tranx_id'				=> $tranx_id2,	
			'tran_count'			=> $tran_count,
            'created_at'            => time(), 
            'modified_at'           => time()
        ];
       $query1 = $this->db->insert('accounts', $accounts2);
	}
}
	      //SMS
	   $tran = '1'; // "$tran = 1" if 'Credit' == 0 & no amount value -OR- "$tran = 0" if 'debit' == 0 & no amount value 
		$sms_user = $referrer_id;
		$total_price = $commission;
		$pm_wallet = 'wallet';
		$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
//Ledger Update Charges Collection
  
	    $today = date("Y/m/d");
		$remarks2 = 'Sponsorship Commission to Consumer';
	
        //set all data for inserting into database
        $ledger2 = [
            'user_id'         		=> $referrer_id,
            'invoice_id '  			=> 'Sponsorship Commission',
			'email'					=> $referrer_email,
			'account_no'         	=> $referrer_account_no,
            'rolename'  			=> $referrer_rolename,
            'credit'         		=> $commission,
			'debit'         		=> '0',
			'amount'         		=> $commission,	
			'points_mode' 			=> 'wallet',
            'count'         		=> 'yes',						
            'start_date'         	=> $today,					
			'pay_type'				=> $paytype_commission,
			'remarks'         		=> $remarks2,	
			'challan'				=> 'no_invoice.jpg',			
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query4 = $this->db->insert('ledger', $ledger2);	
//----------------------------------------------------------------  
      $data3 = [
           	'active'            => '1',            
            'modified_at'       => time()
        ];

       $query3 = $this->db->where('id', $id)->update('otp_transactions', $data3);
	
	if($amount != 0){
		if($query9){	
		
		//Voucher Generation Starts Here...
			//Referrer Data..
			$referred_by_code = $referrerCode;
			$get_referrer_data = $this->db->get_where('users', ['referral_code'=>$referred_by_code]);
			if($get_referrer_data->num_rows() > 0){
				foreach($get_referrer_data->result() as $r1);
				$referred_by_id 	= $r1->id;
				$referred_by_role 	= $r1->rolename;
				
				$this->agent_model->generate_voucher($referred_by_id, $amount);
			}
			
			//Referral Data..
			$referred_to_code = $referral_code;
			$get_referral_data = $this->db->get_where('users', ['referral_code'=>$referred_to_code]);
			if($get_referral_data->num_rows() > 0){
				foreach($get_referral_data->result() as $r2);
				$referred_to_id 	= $r2->id;
				
				$this->agent_model->generate_voucher($referred_to_id, $amount);
			}
		} 
	}
	   
	   
        if($query9)
        {
            create_activity('Added '.$data['email'].' as agent'); //create an activity
			
			$email = $company_email;
			
            $email_data = [
                'email'  => $email,
                'password'  => $row_password,
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');
            $subject = 'Congratulations for Being a part of Consumer1st Agent Group';
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail,  get_option('company_name'));
            $this->email->to($email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('email_new_agent', $email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
	
            return true;
        }
        return false;

						
	}
				
	}		

   

   /**
     * @return Agent List
     * Agent List Query
     */

    public function agentListCount(){
		$user = loggedInUserData();
	    $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       if ($role == 'admin')
       { 			
				$where_array = array('role' => 'agent');
				$query = $this->db->where($where_array )->count_all_results('users');		
			//$query = $this->db->where( 'active' , '1')->count_all_results('users');
	   }
	   else {
			$where_array = array('role' => 'agent', 'referredByCode' => $referral_code);
			$query = $this->db->where($where_array )->count_all_results('users');	
			//$query = $this->db->where('referredByCode', $referral_code )->count_all_results('users');	 
		}

        return $query;
    }

    public function agentList($limit = 0, $start = 0){
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       // $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'agent']);
				if ($role == 'admin')
			   { 					
						$table_name = "users";
						$where_array = array('role' => 'agent');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);						
			   }else {
					
						$table_name = "users";						
						$where_array = array('referredByCode'=>$referral_code);
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);						
			}
			return $query;
	}
 /**
     * @return Referral Payments List
     */

    public function referral_PaymentListCount(){
		$user = loggedInUserData();
	    $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       if ($role == 'admin')
       { 			
			$query = $this->db->where( 'type' , 'referral')->count_all_results('otp_transactions');
	   }
	   else {
			$query = $this->db->where('referredByCode', $referral_code )->count_all_results('otp_transactions');	 
		}

        return $query;
    }

    public function referral_PaymentList($limit = 0, $start = 0){
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       // $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'agent']);
				if ($role == 'admin')
			   { 					
						$table_name = "otp_transactions";
						$where_array = array('type' => 'referral');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);							
			   }else {
					
						$table_name = "otp_transactions";						
						$where_array = array('pay_by'=>$referral_code, 'active' => '0', 'type' => 'referral');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);						
			}
			return $query;
	}	
//OTP Recall
	public function otp_recall($limit = 0, $start = 0){
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
      
			$table_name = "otp_transactions";						
			$where_array = array('referral_code'=>$referral_code, 'type' => 'referral');
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);						

			return $query;
	}
	
	
/**
     * @return Bank List
     * BankList Query
     */

    public function bankListCount(){
//        $query = $this->db->where( 'role' , 'agent')->count_all_results('users');
        $query = $this->db->count_all_results('bank');
        return $query;
    }

    public function bankList($limit = 0, $start = 0){
//        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'agent']);
		 $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('bank');
        return $query;
    }



    /**
     * @param string $photo
     * Photo Resize
     */

    public function photoResize($photo = ''){
        $config['image_library'] = 'gd2';
        $config['source_image'] = $photo;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 20000;
        $config['height']       = 20000;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        unlink($photo); // delete original photo
    }

    public function add_bank(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $this->load->helper('string'); //load string helper

        $row_password   = $this->input->post('password');
        $password       = sha1($row_password);
       // $referral_code  = random_string('numeric',6);
		$bank_account_no     =  $this->input->post('account_no');	
		$IFSC_area_name		 =  $this->input->post('area_name');
		$bank_postal_code	 =  $this->input->post('postal_code');
        
        $email = $this->input->post('email');
        $country_id = $this->input->post('country');
        // get country name
        $country_query = $this->db->get_where('countries', ['id' => $country_id]);
        foreach($country_query->result() as $country);

        $photoName = '';

        //check user is selected photo
        if($_FILES['userfile']['name'] != '')
        {
            $upload_dir = './uploads/'; //Upload directory
            if( ! file_exists($upload_dir)) mkdir($upload_dir); //create directory if not found.
            $config['upload_path']          = $upload_dir;
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            }else
            {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'].'_thumb'.$upload_data['file_ext'];
                $fullPhoto = $upload_dir.$upload_data['file_name'];
                $this->photoResize($fullPhoto); // resize now
            }
        }

        //set all data for inserting into database
        $data = [
            'first_name'        => $this->input->post('first_name'),
            'last_name'         => $this->input->post('last_name'),
            'password'          => $password,
            'row_pass'          => $row_password,
            'email'             => $email,
            'contactno'         => $this->input->post('contactno'),
            'gender'            => $this->input->post('gender'),
            'date_of_birth'     => $this->input->post('date_of_birth'),
            'profession'        => $this->input->post('profession'),
            'street_address'    => $this->input->post('street_address'),
            'country'           => $country->country_name,
            'country_id'        => $country_id,
            'role'              => 'agent', 
//			'role'              => $this->input->post('role'),
            'active'            => 1,
//            'referral_code'     => $referral_code,
			'account_no'        => $bank_account_no,			
			'area_name'   		=> $IFSC_area_name, 
			'postal_code'   	=> $bank_postal_code,			
            'photo'             => $photoName,
            'created_by'        => $user_id,
            'created_at'        => time(),
            'modified_at'       => time()
        ];

       $query = $this->db->insert('bank', $data);

        if($query)
        {
            create_activity('Added '.$data['first_name'].' '. $data['last_name'].' as agent'); //create an activity

           

            return true;
        }
        return false;

    }
	
	public function generate_voucher($voucher_to_id, $amount){
		
	$voucher_to_role = singleDbTableRow($voucher_to_id)->rolename;
	$voucher_to_email = singleDbTableRow($voucher_to_id)->email;
	$voucher_to_acc_no = singleDbTableRow($voucher_to_id)->account_no;
	
		
	$get_voucher_permission = $this->db->get_where('voc_generate', ['business_name'=>20, 'to_role'=>$voucher_to_role]);
	if($get_voucher_permission->num_rows()>0){
		foreach($get_voucher_permission->result() as $v){
			$voucher_name 	= 	$v->voc_name;
			$percentage 	= 	$v->percentage;
			$splits 		= 	$v->no_of_split;
			$pay_type_to 	= 	$v->paytype_to;
			$pay_type 		= 	$v->pay_type;
			$voc_type		=	$v->voc_type;
			$start_date		=	$v->start_date;
			$end_date		=	$v->end_date;
		}
		
		$split_amt = ((($amount * $percentage )/ 100) / $splits);
		
		if($start_date != "0000-00-00"){
			$today_date = $start_date;
		}
		else{
			$today_date = date("Y-m-d");
		}
		
		if($end_date != "0000-00-00"){
			$voc_end_date = $end_date;
		}
		else{
			$voc_end_date = '2020-12-31';
		}
		
		if($voc_type != ""){
			$voucher_type = $voc_type;
		}
		else{
			$voucher_type = " month";
		}
		 
		for($i=1; $i<=$splits; $i++){
			
			$this->load->helper('string'); //load string helper	
			$Epin  = strtoupper(random_string());
			$getEpin = $this->db->get_where('vouchers', ['voucher_id'=> $Epin]);
			if($getEpin -> num_rows() > 0)
			{
				for($i= 0; $getEpin -> num_rows() > 0; $i++){
					$Epin  = strtoupper(random_string(10)); //comment next line for integer only
					//$Epin .= mt_rand(0, 9);
					$getEpin = $$this->db->get_where('vouchers', ['voucher_id'=> $Epin]);
				}
			}
			
			$new_date = $today_date;
			$monthlyDate = strtotime("+".$i.$voucher_type.$today_date);
			$monthly = date("Y-m-d", $monthlyDate);
			
		//Voucher End Date
			$new_end_date = $voc_end_date;
			$end_monthlyDate = strtotime("+".$i.$voucher_type.$voc_end_date);
			$end_monthly = date("Y-m-d", $end_monthlyDate);
			
			$datav = [
				'voucher_name' 			=> $voucher_name,
				'user_id'				=> $voucher_to_id,
				'account_no'			=> $voucher_to_acc_no,
				'email'					=> $voucher_to_email,
				'voucher_id' 			=> $Epin,
				'pay_type' 				=> $pay_type,
				'paytype_to' 			=> $pay_type_to,
				'amount'   				=> $split_amt, 
				'points_mode' 			=> 'wallet',	//points_mode
				'used'      			=> 'no',
				'start_date'  			=> $monthly,
				'end_date' 				=> $end_monthly,
				'commission'  			=> '0',
				'benefits' 				=> '0',
				'to_role' 				=> '0',							
			//	'created_by' 			=> '1',							
				'transferrable'			=> 'no',
				'created_at'            => time(),
				'modified_at'           => time()
			];

			$query5 = $this->db->insert('vouchers', $datav);
		}
	}
//Voucher_generation Ends Here..............
	}
}