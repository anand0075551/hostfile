<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {


    /**
     *  Authonication check here
     * @return bool
     */

 
///Test Api call function from Controller: user
 public function testAPI(){

       
        
	$name = $_GET['name'] ;
	$email= $_GET['email'];
	$mobile= $_GET['mobile'];
	$enqcourse= $_GET['enqcourse'];
	$course= $_GET['course'];
	$message= $_GET['message'];

//	echo  $course= $_GET['course']; we can display data for confirmation
//	echo $message= $_GET['message'];  */
	


        //set all data for inserting into database
        $data = [
            'name'      => $name,
            'email'     => $email,
            'mobile'    => $mobile,
            'mcourse' 	=> $enqcourse, 
            'course' 	=> $course,
            'message' 	=> $message
        ];

        $query = $this->db->insert('test', $data);
       
        if($query)
        {
            return true;
        }
        return false;
    }

 public function paymentAPI(){

       
 //Transaction for Customer sending wallet points       
$user_email   = $_GET['email'] ;
$amount       = $_GET['amount'] ;
$pay_spec_id  = $_GET['pay_spec'] ;
$pay_to       = 'smb@cfirst.co.in'; //smb@cfirstonline.com'; //$_GET['5382610497'] ;

$table_name = "users";			
		$where_array = array('email' => $user_email); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				//$payto_rolename		 = $r->rolename;	
				$user_referral_code   = $r->referral_code;	
		 $user_user_id       = $r->id;
		$user_rolename	     = $r->rolename;	
		$acct_email	    	 = $r->email;			
		$user_mobile         = $r->contactno;
		$user_fname          = $r->first_name.''.$r->last_name;
		$user_account_no     = $r->account_no; 
		//	}
		//}
		
/* $user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		
		*/
		$tran_type = 'Transfer'; //$this->input->post('transaction_type');	
	
		
//Get Individual Account transactions Id
		$acct_user = $user_user_id;
		$result_count  	= $this->product_model->get_tran_count($acct_user);
		if($result_count -> num_rows() > 0) 
			{	
				foreach ($result_count->result() as $r)
				{
					$value = $r->tran_count;  
					
					$count = $value + 1;
					
				}					
			}
//End of Individual Account transactions Id


				
		
        $this->load->helper('string'); //load string helper
	//   $otp  = random_string('numeric', 4);  //4 digits Unique OTP_code
		$otp  = $this->product_model->generatePIN();				   //4 digits Unique OTP_code
		
 
		
		$payee_referredCode = '5382610497'; //$this->input->post('referredByCode');

	if( $tran_type == 'Transfer' )  			//Recieve
	{
	$payby_consumer_id 	= $user_referral_code;  //Payer's Account			
	$payto_consumer_id 	= '5382610497'; //$this->input->post('referredByCode');
	$payby_rolename = $user_rolename;	
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payto_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payto_rolename		 = $r->rolename;	
			}
		}

	}else{
	$payby_consumer_id 	= $this->input->post('referredByCode');	 //Payer's Account	
	$payto_consumer_id 	= $user_referral_code;   	
	$payto_rolename = $user_rolename;
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payby_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payby_rolename		 = $r->rolename;	
			}
		}
	
}		
	
		
		
//*****************      //Payee's Consumer details    ***********************///		
		
		$table_name = "users";			
			$where_array = array('referral_code' => $payee_referredCode); 
		//	$where_array = array('referral_code' => $payto_userid); 
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$payee_user_id 		 = $r->id;
					$payee_rolename		 = $r->rolename;
					$payee_email		 = $r->email;
					$payee_first_name    = $r->first_name.' '.$r->last_name;
					$payee_last_name     = $r->last_name;             
				    $payee_gender        = $r->gender;
					$payee_dob			 = $r->date_of_birth;
					$payee_adhaar_no     = $r->adhaar_no;
					$payee_mobile        = $r->contactno;
					$payee_city_id       = $r->city_id;
				    $payee_country       = $r->country;
				    $payee_country_id    = $r->country_id;				   
					$payee_account_no    = $r->account_no;	
					$payee_photoName     = $r->photo;	
					$payee_pay_by		 = $r->referral_code;	               
				
				//SMS
				$sms_no 	 = $payee_mobile;  //Cross Authentication 
				$user_email  = $payee_email;
				$fname       = $payee_first_name;
				$pay_by		 = $payee_pay_by;
				$account_no  = $payee_account_no ; 

/******Automatically Payspecification will be Identified by two users **************/	

		$table_name = "commissions";
		$where_array = array('from_role' =>$payby_rolename, 'to_role' =>$payto_rolename, 'identity' =>'Commission');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
			
			
		$pay_type 			= $row->sub_acct_id;					//Ledger Deposit pay spec		
		$deduction_paytype	= $row->ded_paytype;		    //Ledger Deduction pay spec	
		$pay_from 			= $row->from_role;
		$pay_to 			= $row->to_role;
		
		}
	  $pay_type = '66';
		if (($count == null)) 
					{ $count = '0';}
		$key_id = $count;
		//OTP transaction Table
        $data1 = [
			'otp'					=> $otp,
			'key_id'				=> $key_id,
			'rolename'		        => $user_rolename,
		//  'sponsor_role'          => $this->input->post('sponsor_role'),
			'referredByCode'		=> $user_referral_code,
			'referral_code'			=> $payee_referredCode,
			'type'					=> 'pay_wallet',
			'transaction_type'		=> 'Transfer', //$this->input->post('transaction_type') ,			
        //  'company_name'			=> $company_name,
			'account_no'         	=> $user_account_no,
			'pay_by'				=> $payby_consumer_id,  //Payer's Account
			'payby_rolename'		=> $payby_rolename,
			'pay_to'				=> $payee_referredCode,  //Third party id
			'payto_rolename'		=> $payto_rolename,
		//	'commission'       		=> $commission,            
			'fname'         		=> $fname,			
			'amount'         		=> $amount,
			'points_mode' 			=> 'wallet',			
		//	'licence'				=> $company_licence,
			'from_cell'             => $user_mobile,
			'sms_no'				=> $sms_no,
			'to_cell'				=> $sms_no,
			'used'					=> 'yes',			
			'pay_type'         		=> $pay_type,
		//	'ded_paytype'         	=> $deduction_paytype,
			'tranx_id'				=> 'Invoice of CPA', //$this->input->post('tranx_id'),	
            'created_at'            => time(), 
            'modified_at'           => time()
        ];
	
		
       $query1 = $this->db->insert('otp_transactions', $data1);
   
        
        if($query1)
        {
           // create_activity('Added '.$data1['email'].' SMB Payment'  ); //create an activity

            return true;
        }
        return false;

		}				
	}
		
   	}
}
		
}
    







    
 //Api call from Cont:User To get a list of Pay Specifications
      public function payspec_List($start = 0, $limit = 0)
      {
       $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('acct_categories');
	 return $query;			 
	}
	
 //Api call from Cont: User/check_bal - To get a list of Pay Specifications
      public function check_bal ($start = 0, $limit = 0)
      {
       $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('acct_categories');
	 return $query;			 
	}	
	
//For the Total Debits	
     public function total_wallet_debit($email = 0)
     {
      $email = $_GET['email'];
		
                $table_name = "users";		
		$where_array = array('active'=>'1', 'email' =>$email);
		$user1 = $this->db->where($where_array )->get($table_name); 
		if($user1 ->result() > 0)
		{	foreach($user1 ->result() as $r)
			$userID = $r->id;
            	}
        //For User account Number    
	    $account_no = singleDbTableRow($userID)->account_no;
        
		//sum of total wallets available with Cash Dispatch-Role Name 'Wallet'
		
		$table_name = "accounts";
		$where_array = array('points_mode'=>'wallet', 'account_no' =>$account_no);
		$query1 = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
		return $query1;
		
    }
//For the Total Credits	
	public function total_wallet_credit($email = 0)
	{
         $email = $_GET['email'];
		
                $table_name = "users";		
		$where_array = array('active'=>'1', 'email' =>$email);
		$user1 = $this->db->where($where_array )->get($table_name); 
		if($user1 ->result() > 0)
		{	foreach($user1 ->result() as $r)
			$userID = $r->id;
            	}
			$account_no = singleDbTableRow($userID)->account_no;
        
		//sum of total wallets available with Cash Dispatch-Role Name 'Wallet'
		$table_name = "accounts";		 
		$where_array = array('points_mode'=>'wallet', 'account_no' =>$account_no);
		$query2 = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
		return $query2;
    }
	

///Test Mobile Api call function from Controller: user

 public function testAPI1(){

       
        
	 $name = $_POST['name'];
 $username = $_POST['username'];
 $password = $_POST['password'];
 $email = $_POST['email'];



        //set all data for inserting into database
        $data = [
            'name'        => $name,
            'username'    => $username,
            'password'    => $password,
            'email' 	  => $email
            
        ];

        $query = $this->db->insert('test1', $data);
       
        if($query)
        {
            return true;
        }
        return false;
    }
    
    
    //For the Total Debits	
     public function check_bal2_debit($email = 0)
	{
         $email = $_GET['email'];
		
                $table_name = "users";		
		$where_array = array('active'=>'1', 'email' =>$email);
					$user1 = $this->db->where($where_array )->get($table_name); 
					if($user1->num_rows() > 0)
					{	foreach($user1 ->result() as $r)
						$userID = $r->id;
							
					//For User account Number    
					$account_no = singleDbTableRow($userID)->account_no;
					
					//sum of total wallets available with Cash Dispatch-Role Name 'Wallet'
					
					$table_name = "accounts";
					$where_array = array('points_mode'=>'wallet', 'account_no' =>$account_no);
					$query1 = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
					return $query1;
					
	}else{
					return false;
				}
    }
//For the Total Credits	
	public function check_bal2_credit($email = 0)
	{
         $email = $_GET['email'];
		
                $table_name = "users";		
		$where_array = array('active'=>'1', 'email' =>$email);
				$user1 = $this->db->where($where_array )->get($table_name); 
				if($user1->num_rows() > 0)
				{	foreach($user1 ->result() as $r)
					$userID = $r->id;
				
					$account_no = singleDbTableRow($userID)->account_no;
				
				//sum of total wallets available with Cash Dispatch-Role Name 'Wallet'
				$table_name = "accounts";		 
				$where_array = array('points_mode'=>'wallet', 'account_no' =>$account_no);
				$query2 = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
				return $query2;
				}else{
					return false;
				}
		
    }  
 




//Restaurant Payments
public function paymentAPI_resto(){

 
       
 //Transaction for Customer sending wallet points       
$user_email   = $_GET['email'] ;	 //Amount Sender
$amount       = $_GET['amount'] ;	 //Total Amount
$pay_spec_id  = $_GET['pay_spec'] ;	 //Payspec ID
$order_id     = $_GET['order_id'] ;  //Reference ID
$pay_to       = $_GET['pay_to']; // 'smb@cfirst.co.in';  //$_GET['5382610497'] ;

		$table_name = "users";			
		$where_array = array('email' => $user_email); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				//$payto_rolename		 = $r->rolename;	
				$user_referral_code   = $r->referral_code;	
		 $user_user_id       = $r->id;
		$user_rolename	     = $r->rolename;	
		$acct_email	    	 = $r->email;			
		$user_mobile         = $r->contactno;
		$user_fname          = $r->first_name.''.$r->last_name;
		$user_account_no     = $r->account_no; 
		//	}
		//}
		
/* $user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		
		*/
		$tran_type = 'Transfer'; //$this->input->post('transaction_type');	
	
		
//Get Individual Account transactions Id
		$acct_user = $user_user_id;
		$result_count  	= $this->product_model->get_tran_count($acct_user);
		if($result_count -> num_rows() > 0) 
			{	
				foreach ($result_count->result() as $r)
				{
					$value = $r->tran_count;  
					
					$count = $value + 1;
					
				}					
			}
//End of Individual Account transactions Id


				
		
        $this->load->helper('string'); //load string helper
	//   $otp  = random_string('numeric', 4);  //4 digits Unique OTP_code
		$otp  = $this->product_model->generatePIN();				   //4 digits Unique OTP_code
		
 
if ($pay_to  == 'smb@cfirst.co.in')
{
$payee_referredCode = '5382610497'; 

}

else
{
     $payee_referredCode = '7432105869';  //Resto Finance Manager

}

	if( $tran_type == 'Transfer' )  			//Recieve
	{
	$payby_consumer_id 	= $user_referral_code;  //Payer's Account
			

	$payto_consumer_id 	= $payee_referredCode; //$this->input->post('referredByCode');


	$payby_rolename = $user_rolename;	
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payto_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payto_rolename		 = $r->rolename;	
			}
		}

	}else{
	$payby_consumer_id 	= $this->input->post('referredByCode');	 //Payer's Account	
	$payto_consumer_id 	= $user_referral_code;   	
	$payto_rolename = $user_rolename;
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payby_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payby_rolename		 = $r->rolename;	
			}
		}
	
}		
	
		
		
//*****************      //Payee's Consumer details    ***********************///		
		
		$table_name = "users";			
			$where_array = array('referral_code' => $payee_referredCode); 
		//	$where_array = array('referral_code' => $payto_userid); 
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$payee_user_id 		 = $r->id;
					$payee_rolename		 = $r->rolename;
					$payee_email		 = $r->email;
					$payee_first_name    = $r->first_name.' '.$r->last_name;
					$payee_last_name     = $r->last_name;             
				    $payee_gender        = $r->gender;
					$payee_dob			 = $r->date_of_birth;
					$payee_adhaar_no     = $r->adhaar_no;
					$payee_mobile        = $r->contactno;
					$payee_city_id       = $r->city_id;
				    $payee_country       = $r->country;
				    $payee_country_id    = $r->country_id;				   
					$payee_account_no    = $r->account_no;	
					$payee_photoName     = $r->photo;	
					$payee_pay_by		 = $r->referral_code;	               
				
				//SMS
				$sms_no 	 = $payee_mobile;  //Cross Authentication 
				$user_email  = $payee_email;
				$fname       = $payee_first_name;
				$pay_by		 = $payee_pay_by;
				$account_no  = $payee_account_no ; 

/******Automatically Payspecification will be Identified by two users **************/	

		$table_name = "commissions";
		$where_array = array('from_role' =>$payby_rolename, 'to_role' =>$payto_rolename, 'identity' =>'Commission');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
			
			
		$pay_type 			= $row->sub_acct_id;					//Ledger Deposit pay spec		
		$deduction_paytype	= $row->ded_paytype;		    //Ledger Deduction pay spec	
		$pay_from 			= $row->from_role;
		$pay_to 			= $row->to_role;
		
		}
if ($pay_to  == 'smb@cfirst.co.in')
{$pay_type = '66';
}else{
$pay_type = '78';
}
	  

		if (($count == null)) 
					{ $count = '0';}
		$key_id = $count;
		//OTP transaction Table
        $data1 = [
			'otp'					=> $otp,
			'key_id'				=> $key_id,
			'rolename'		        => $user_rolename,
		//  'sponsor_role'          => $this->input->post('sponsor_role'),
			'referredByCode'		=> $user_referral_code,
			'referral_code'			=> $payee_referredCode,
			'type'					=> 'pay_wallet',
			'transaction_type'		=> 'Transfer', //$this->input->post('transaction_type') ,			
        //  'company_name'			=> $company_name,
			'account_no'         	=> $user_account_no,
			'pay_by'				=> $payby_consumer_id,  //Payer's Account
			'payby_rolename'		=> $payby_rolename,
			'pay_to'				=> $payee_referredCode,  //Third party id
			'payto_rolename'		=> $payto_rolename,
		//	'commission'       		=> $commission,            
			'fname'         		=> $fname,			
			'amount'         		=> $amount,
			'points_mode' 			=> 'wallet',			
		//	'licence'				=> $company_licence,
			'from_cell'             => $user_mobile,
			'sms_no'				=> $sms_no,
			'to_cell'				=> $sms_no,
			'used'					=> 'yes',			
			'pay_type'         		=> $pay_type,
		//	'ded_paytype'         	=> $deduction_paytype,
			'tranx_id'				=> $order_id, //$this->input->post('tranx_id'),	
            'created_at'            => time(), 
            'modified_at'           => time()
        ];
	
		
       $query1 = $this->db->insert('otp_transactions', $data1);
   
        
        if($query1)
        {
           // create_activity('Added '.$data1['email'].' SMB Payment'  ); //create an activity

            return true;
        }
        return false;

		}				
	}
		
   	}
}
		
}

   
    }// End of Main call