<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {

    /**
     * @return bool
     */
//New Registration User
public function sms_new_consumer($sms_user)
	{		
	
			$mobile 		= singleDbTableRow($sms_user)->contactno;
			$fname  		= singleDbTableRow($sms_user)->first_name;
			$referral_code  = singleDbTableRow($sms_user)->referral_code;
			$email  		= singleDbTableRow($sms_user)->email;
			$company_name 	= singleDbTableRow($sms_user)->company_name;	
		if ( $company_name != null)

		{
			$cname = $company_name;
		}else{
			$cname = $fname;
		}			
			
			Include_once ('sendsms.php');		
			$message="Dear ".$cname.", Your ConsumerID is VOL".$referral_code." and Login ID is ".$email.". We confirm your Registration with 'Consumer1st'. Contact your Introducer to Activate your CPA(Consumer Personal Assistant) Account. -Team Consumer1st";
			/*	$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aaf4c7aeba262de430024464073430ce6", "ICAMPS");
			$sendsms->send_sms($mobile, $message, 'http://www.gyanguidecrm.com/fmd/QuickSms.php?branchid=12', 'xml');	*/
			
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');	
	}
	
//New Registration User
public function sms_new_agent($sms_user)
	{		
	//Invite New Agent with their Role Name
			$mobile 		= singleDbTableRow($sms_user)->contactno;
			$fname  		= singleDbTableRow($sms_user)->company_name;
			$referral_code  = singleDbTableRow($sms_user)->referral_code;
			$email  		= singleDbTableRow($sms_user)->email;
			$company_name 	= singleDbTableRow($sms_user)->company_name;	
		if ( $company_name != null)

		{
			$cname = $company_name;
		}else{
			$cname = $fname;
		}			
			Include_once ('sendsms.php');		
			$message="Dear ".$cname.", Your ConsumerID is VOL".$referral_code." and Login ID is ".$email.". We confirm your Registration with 'Consumer1st'. Contact your Introducer to Activate your CPA(Consumer1st Personal Assistant) Account. -Team Consumer1st";
			/*	$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aaf4c7aeba262de430024464073430ce6", "ICAMPS");
			$sendsms->send_sms($mobile, $message, 'http://www.gyanguidecrm.com/fmd/QuickSms.php?branchid=12', 'xml');	*/
			
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');	  	
	}
	
	//New Registration User from Chaitanya Foundations
public function sms_new_volunteer($mobile, $fname, $referral_code, $login_name, $password)
	{		
	
			$mobile 		= $mobile;
			$fname  		= $fname;
			$referral_code  = $referral_code;
			$email  		= $login_name;	
			$cname 			= $fname;
					
			
			Include_once ('sendsms.php');		
			$message="Dear ".$cname.", Your VolunteerID is VOL".$referral_code." and Credentials Login ID-".$email." Pass-'".$password."'. We confirm your Registration with 'Chaitanyafoundations.org'. -Team Chaitanya";
			
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');	
	}
	
	
//SMS For Agent Referrals.
	
	public function sms_pay_wallet( $key_id, $otp, $mobile, $fname)
	{	$activity = 'Agent Referral';				
			include_once 'sendsms.php';		
			$message=" Your OTP ".$otp." for Org/Comp name '".$fname."' sms reference Id '".$key_id."'.  'Team Consumer1st'.";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aaf4c7aeba262de430024464073430ce6", "ICAMPS");
			$sendsms->send_sms($mobile, $message, 'http://www.gyanguidecrm.com/fmd/QuickSms.php?branchid=12', 'xml');		
	}

// Accounts Update SMS for user Accounts	
//For Transactions *******"Recieve" and "Transfer"*********
	public function sms_accounts($sms_user, $tran, $sms_total, $pm_wallet )
	{		
	if ($sms_total > 0 )
	{
		$query1  	= $this->notification_model->total_debit($sms_user, $pm_wallet);
		if($query1-> num_rows() > 0) 
		{
			foreach ($query1->result() as $r1) 
			{
				$wal_debit			= $r1->debit;
			}
		}
			$query2    	= $this->notification_model->total_credit($sms_user, $pm_wallet);		
		if($query2-> num_rows() > 0) 
		{
			foreach ($query2->result() as $r2) 
			{
				$wal_credit			= $r2->credit;
			}
		}
				
		
		/* Available Balance Wallet,loyality and Discount Values */

		$wallet_balance    = ( $wal_debit - $wal_credit ) ;
	
			$fname = singleDbTableRow($sms_user)->first_name; 
			if ($tran == 1)
			{
				$text = 'added with '.$sms_total.'  ';
			}else
			{
				$text = 'deducted with '.$sms_total.' ';
			}
					
			$bal = number_format($wallet_balance, 2);
			$mobile 	  = singleDbTableRow($sms_user)->contactno;
			$company_name = singleDbTableRow($sms_user)->company_name;	
		if ( $company_name != null)

		{
			$cname = $company_name;
		}else{
			$cname = $fname;
		}			
			if ($pm_wallet == 'wallet')
			{
				$pm_wallet = 'CPA';
			}
			Include_once ('sendsms.php');		
			$message=" Dear ".$cname.", your account is ".$text." Values. Balance in 'CONSUMER1ST' A/C is ".$bal.' '.$pm_wallet." Values.";
		/*	$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aaf4c7aeba262de430024464073430ce6", "ICAMPS");
			$sendsms->send_sms($mobile, $message, 'http://www.gyanguidecrm.com/fmd/QuickSms.php?branchid=12', 'xml');	*/
		
		$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');	
		}
	}
	

	
	
	public function total_debit($sms_user, $pm_wallet){
       
			$account_no = singleDbTableRow($sms_user)->account_no;
 
		$table_name = "accounts";		
		$where_array = array('points_mode'=>$pm_wallet, 'account_no' =>$account_no);
		$query1 = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
		return $query1;
		
    }
	
	public function total_credit($sms_user, $pm_wallet){
       
			$account_no = singleDbTableRow($sms_user)->account_no;
 
		$table_name = "accounts";		
		$where_array = array('points_mode'=>$pm_wallet, 'account_no' =>$account_no);
		$query2 = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
		return $query2;
		
    }
	
//checking Deducter's Balance Amount.	
	public function sms_recieve_wallet($key_id, $otp, $mobile, $fname, $pay_to, $amount, $transaction_type )
	{	

	
	$user_data = $this->db->get_where('users', ['referral_code' => $pay_to]);
	foreach($user_data->result() as $deducter);
		
		{			
			$deducter_id  = $deducter->id;	
		}		
			$sms_user = $deducter_id;
			$pm_wallet 	= 'wallet';
			$query1  	= $this->notification_model->total_debit($sms_user, $pm_wallet);	
			if($query1-> num_rows() > 0) 
				{
					foreach ($query1->result() as $r1) 
					{
						$deducter_debit			= $r1->debit;
					}
				}
					$query2    	= $this->notification_model->total_credit($sms_user, $pm_wallet);		
				if($query2-> num_rows() > 0) 
				{
					foreach ($query2->result() as $r2) 
					{
						$deducter_credit			= $r2->credit;
					}
				}
						
				
				/* Available Balance Wallet,loyality and Discount Values */

				$deducter_balance    = ( $deducter_debit - $deducter_credit ) ;	
				
			if(	$transaction_type == 'Transfer' )
			{
				include 'sendsms.php';		
				$message=" Your OTP is ".$otp." for the transaction of '".$amount."' with '".$fname."' transaction ref Id is '".$key_id."'.  'Team Consumer1st'.";
				/*	$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aaf4c7aeba262de430024464073430ce6", "ICAMPS");
			$sendsms->send_sms($mobile, $message, 'http://www.gyanguidecrm.com/fmd/QuickSms.php?branchid=12', 'xml');	*/
		
		$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');	
			
			
			}elseif ( $transaction_type == 'Recieve' && $deducter_balance > $amount ) 
				{
						include 'sendsms.php';		
						$message=" Your OTP is ".$otp." for the transaction of '".$amount."' with '".$fname."' transaction ref Id is '".$key_id."'.  'Team Consumer1st'.";
					/*	$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aaf4c7aeba262de430024464073430ce6", "ICAMPS");
						$sendsms->send_sms($mobile, $message, 'http://www.gyanguidecrm.com/fmd/QuickSms.php?branchid=12', 'xml');	*/
						$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
						$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');	
						
						
			 /* include 'sendsms.php';		
			$message=" Your OTP is ".$otp." for the transaction of '".$amount."' with '".$fname."' sms reference Id is '".$key_id."'.  'Team Consumer1st'.";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');		
			
		/*	http://api-alerts.solutionsinfini.com/v3/?method=sms&api_key=Ad9e5XXXXXXXXXXXXX&to=997XXXXXXX&sender=INFXXX&message=Welcome%20to%messaging	
			
			http://api-alerts.solutionsinfini.com/v3/?method=sms&api_key=Aa505b0f65c9f5714d91b8c19d2a5f53f&to=9980569960&sender=CFIRST&message=Welcome%Anand
		*/	
			
				}			
	}
	
	// Accounts Update SMS for user Accounts	
//for the Cash Withdrawl Request Only
	public function sms_bank_withdrawl($sms_user, $tran, $sms_total, $pm_wallet )
	{		
	if ($sms_total > 0 )
	{
			$query1  	= $this->notification_model->total_debit($sms_user, $pm_wallet);
		if($query1-> num_rows() > 0) 
		{
			foreach ($query1->result() as $r1) 
			{
				$wal_debit			= $r1->debit;
			}
		}
			$query2    	= $this->notification_model->total_credit($sms_user, $pm_wallet);		
		if($query2-> num_rows() > 0) 
		{
			foreach ($query2->result() as $r2) 
			{
				$wal_credit			= $r2->credit;
			}
		}
				
		
		/* Available Balance Wallet,loyality and Discount Values */

		$wallet_balance    = ( $wal_debit - $wal_credit ) ;
	
			$fname = singleDbTableRow($sms_user)->first_name; 
			if ($tran == 1)
			{
				$text = 'added with '.$sms_total.' ';
			}else
			{
				$text = "deducted with '$sms_total' CPA Values. Payment Scheduled to your Bank Account. Please check your A/C after 48 hrs";
			}
					
			$bal = number_format($wallet_balance, 2);
			$mobile 	  = singleDbTableRow($sms_user)->contactno;
			$company_name = singleDbTableRow($sms_user)->company_name;	
		if ( $company_name != null)

		{
			$cname = $company_name;
		}else{
			$cname = $fname;
		}			
			if ($pm_wallet == 'wallet')
			{
				$pm_wallet = 'CPA';
			}
			Include_once ('sendsms.php');		
			$message=" Dear ".$cname.", your account is ".$text.". Balance in 'CONSUMER1ST' CPA A/C is ".$bal.' '.$pm_wallet." Values.";
			/*	$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aaf4c7aeba262de430024464073430ce6", "ICAMPS");
			$sendsms->send_sms($mobile, $message, 'http://www.gyanguidecrm.com/fmd/QuickSms.php?branchid=12', 'xml');	*/
		
		$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');		
		}
	}
	
	// Accounts Update SMS for user Accounts	
//for the Cash Deposit transactions Only
	public function sms_bank_deposit($sms_user, $tran, $sms_total, $pm_wallet )
	{		
	
	if ($sms_total > 0 )
	{
		$query1  	= $this->notification_model->total_debit($sms_user, $pm_wallet);
		if($query1-> num_rows() > 0) 
		{
			foreach ($query1->result() as $r1) 
			{
				$wal_debit			= $r1->debit;
			}
		}
			$query2    	= $this->notification_model->total_credit($sms_user, $pm_wallet);		
		if($query2-> num_rows() > 0) 
		{
			foreach ($query2->result() as $r2) 
			{
				$wal_credit			= $r2->credit;
			}
		}
				
		
		/* Available Balance Wallet,loyality and Discount Values */

		$wallet_balance    = ( $wal_debit - $wal_credit ) ;
	
			$fname = singleDbTableRow($sms_user)->first_name; 
			if ($tran == 1)
			{
				$text = 'added with '.$sms_total.' ';
			}else
			{
				$text = "deducted with '.$sms_total.' CPA Values";
			}
					
			$bal = number_format($wallet_balance, 2);
			$mobile 	  = singleDbTableRow($sms_user)->contactno;
			$company_name = singleDbTableRow($sms_user)->company_name;	
		if ( $company_name != null)

		{
			$cname = $company_name;
		}else{
			$cname = $fname;
		}			
			
			if ($pm_wallet == 'wallet')
			{
				$pm_wallet = 'CPA';
			}
			Include_once ('sendsms.php');		
			$message=" Dear ".$cname.", your account is ".$text.". Balance in 'CONSUMER1ST' CPA A/C is ".$bal.' '.$pm_wallet." Values.";
			/*	$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aaf4c7aeba262de430024464073430ce6", "ICAMPS");
			$sendsms->send_sms($mobile, $message, 'http://www.gyanguidecrm.com/fmd/QuickSms.php?branchid=12', 'xml');	*/
		
		$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');	
		}
	}

//SMS for User Deposit-- Approval Notification to Cash Dispatcher	
	public function sms_user_deposit($sms_user, $tran, $total_price, $pm_wallet )
	{		
	$sms_total = $total_price;
	if ($sms_total > 0 )
	{
		$fname 		  = singleDbTableRow($sms_user)->first_name;
		$lname 		  = singleDbTableRow($sms_user)->last_name;
		$user_mob 	  = singleDbTableRow($sms_user)->contactno;
		$company_name = singleDbTableRow($sms_user)->company_name;	
		if ( $company_name != null)

		{
			$cname = $company_name;
		}else{
			$cname = $fname;
		}			
			$mobile = $user_mob;		
			Include_once ('sendsms.php');		

			$message=" Dear ".$cname.", We have recieved your deposit request sum of ".$sms_total." for CPA recharge. We will notify soon after Approval.";
		
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');	



			$mobile = '8904977234';		
			Include_once ('sendsms.php');		
			$message=" Dear Cash Approver, User - ".$cname. ", has submitted Cash deposit for CPA request sum of ".$sms_total." Values.";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');	
			
			$mobile = '9980569960';		
			Include_once ('sendsms.php');		
			$message=" Dear Cash Approver, User - ".$cname. ", has submitted Cash deposit for CPA request sum of ".$sms_total." Values.";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');				
		}
	}
	
//SMS for User Withdrawl-- Approval Notification to Cash Dispatcher	
	public function sms_user_withdrawal($sms_user, $tran, $total_price, $pm_wallet )
	{		
	$sms_total = $total_price;
	if ($sms_total > 0 )
	{
		$fname 		= singleDbTableRow($sms_user)->first_name;
		$lname 		= singleDbTableRow($sms_user)->last_name;
		$rolename   = singleDbTableRow($sms_user)->rolename;
		$company_name = singleDbTableRow($sms_user)->company_name;	
		if ( $company_name != null)

		{
			$cname = $company_name;
		}else{
			$cname = $fname;
		}			
		$user_mob 	= singleDbTableRow($sms_user)->contactno;
			$mobile = $user_mob;		
			Include_once ('sendsms.php');		
		
			$message=" Dear ".$cname.", We have received your withdrawal request sum of ".$sms_total." . We will notify soon after Approval.";
		
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');	



			$mobile = '8904977234';		
			Include_once ('sendsms.php');		
			$message=" Dear Cash Approver, User - ".$cname.", has submitted Cash withdrawal request sum of ".$sms_total." CPA Values.";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');	
			
			$mobile = '9980569960';		
			Include_once ('sendsms.php');		
			$message=" Dear Cash Approver, User - ".$cname.", has submitted Cash withdrawal request sum of ".$sms_total." CPA Values.";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');				
		}
	}	
	//SMS for Referrals Income	
	public function sms_ref_accounts($sms_user, $tran, $sms_total, $pm_wallet )
	{		
	if ($sms_total > 0 )
	{
			$query1  	= $this->notification_model->total_debit($sms_user, $pm_wallet);
		if($query1-> num_rows() > 0) 
		{
			foreach ($query1->result() as $r1) 
			{
				$wal_debit			= $r1->debit;
			}
		}
			$query2    	= $this->notification_model->total_credit($sms_user, $pm_wallet);		
		if($query2-> num_rows() > 0) 
		{
			foreach ($query2->result() as $r2) 
			{
				$wal_credit			= $r2->credit;
			}
		}
				
		
		/* Available Balance Wallet,loyality and Discount Values */

		$wallet_balance    = ( $wal_debit - $wal_credit ) ;
	
			$fname = singleDbTableRow($sms_user)->first_name; 
			if ($tran == 1)
			{
				$text = 'added with '.$sms_total.'  ';
			}else
			{
				$text = 'deducted with '.$sms_total.' ';
			}
					
			$bal 		  = number_format($wallet_balance, 2);
			$mobile		  = singleDbTableRow($sms_user)->contactno;
			$company_name = singleDbTableRow($sms_user)->company_name;	
		if ( $company_name != null)

		{
			$cname = $company_name;
		}else{
			$cname = $fname;
		}			
			if ($pm_wallet == 'wallet')
			{
				$pm_wallet = 'CPA';
			}
			Include_once ('sendsms.php');		
			$message=" Dear ".$cname.", your account is ".$text." Offer ".$pm_wallet."Values. Balance in 'CONSUMER1ST' A/C is ".$bal.' '.$pm_wallet." Values.";
			/*	$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aaf4c7aeba262de430024464073430ce6", "ICAMPS");
			$sendsms->send_sms($mobile, $message, 'http://www.gyanguidecrm.com/fmd/QuickSms.php?branchid=12', 'xml');	*/
		
		$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');			
		}
	}
	
	
	//New Registration User
public function sms_ref_request($user_referral_code, $agent_referredCode, $role, $fees)
	{		
	        $table_name = "users";			
			$where_array = array('referral_code' => $agent_referredCode);
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$newagent_user_id 		 = $r->id;					
					$newagent_name    = $r->first_name.' '.$r->last_name;					
					$mobile1    = $r->contactno; 	
					
					$roleName = typeDbTableRow($role)->rolename;
				
			
			
			$table_name = "users";			
			$where_array = array('referral_code' => $user_referral_code);
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$refuser_id 	= $r->id;					
					$refuser_name   = $r->first_name.' '.$r->last_name;					
					$mobile2     = $r->contactno; 					
			
				

			Include_once ('sendsms.php');	
			$message="Dear ".$refuser_name.", Thank you for Sponsoring ".$newagent_name." for the role ".$roleName." .Please Inform ".$newagent_name." to login and complete the Referral Payment of CPA ".$fees." for the future benefits. - Team Cfirst";			
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile2, $message, 'http://www.consumer1st.in', 'xml');

			

			Include_once ('sendsms.php');		
			$message="Dear ".$newagent_name.", your Introduction request for ".$roleName." is Sponsored by ".$refuser_name.". Please login and complete the Referral Payment of CPA ".$fees.". - Team Cfirst";
			
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile1, $message, 'http://www.consumer1st.in', 'xml');

 					
				}
			}

			}
			}
	}
	
//New Agent user Registration Alert
public function new_agent_sms($agent_first_name, $row_password, $company_email, $company_role)
	{		
	       
			
		$roleName = typeDbTableRow($company_role)->rolename;
			$table_name = "users";			
			$where_array = array('email' => $company_email);
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
									
					$newagent_name    = $r->first_name.' '.$r->last_name;					
					$mobile1    = $r->contactno; 
					//$firm = 	$r->company_name; 				
					
					//$roleName = typeDbTableRow($role)->rolename;

			

			Include_once ('sendsms.php');		
			$message="Dear ".$agent_first_name.", Here is your Login details for the role ".$roleName." Email: ".$company_email.". Pass: ".$row_password.". Kindly Login and change your password Immediatiately- Team Cfirst";
			
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile1, $message, 'http://www.consumer1st.in', 'xml');

 					
				
				}
			}

			
	}	
	
	//Voucher Generation Alert
public function new_voucher($user_id)
	{		
	       
			$fname = singleDbTableRow($user_id)->first_name;
			$lname = singleDbTableRow($user_id)->last_name;
			$mobile = singleDbTableRow($user_id)->contactno;
			 
			$cname = $fname.' '.$lname;
			
		$roleName = typeDbTableRow($company_role)->rolename;
			

			

			Include_once ('sendsms.php');		
			$message="Dear ".$cname.", Congratulations! Special scheme Vouchers are generated for you. Kindly check the 'Vouchers' Section - Team Cfirst";
			
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');

 					
				
			

			
	}	
	
	
	
/************************************EM******************************************/
	public function EM_organiser($event,$phn,$budget,$name)
	{
			Include_once ('sendsms.php');
					
			$message1="Dear ".$name.", Your ConsumerID is VOL and Login ID is ".$event.". We confirm your Registration with 'Consumer1st'. Contact your Introducer to Activate your CPA(Consumer Personal Assistant) Account. -Team Consumer1st";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($phn, $message1, 'http://www.consumer1st.in', 'xml');
	}
	public function EM_invite($event,$number)
	{
			Include_once ('sendsms.php');
					
			$message1="Dear , Your ConsumerID is VOL and Login ID is ".$event.". We confirm your Registration with 'Consumer1st'. Contact your Introducer to Activate your CPA(Consumer Personal Assistant) Account. -Team Consumer1st";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($number, $message1, 'http://www.consumer1st.in', 'xml');
	}
	public function EM_send_invitation_sms($event,$event_name,$joined,$sms,$sms_msg)
	{
			Include_once ('sendsms.php');
					if(count($joined)>0)
					{
						$explode_user = explode(',',$joined);
						foreach($explode_user as $euser)
			 			{
							$get_name = $this->db->get_where('users', ['contactno'=>$euser]);
							foreach($get_name->result() as $nm);
							$name = $nm->first_name.' '.$nm->last_name;
							$message1="Dear ".$name.", Please find the updates for you are cordially Invited to ID: ".$event." and ".$event_name." hence ".$sms_msg.". Thank You. Team Cfirst.";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($euser, $message1, 'http://www.consumer1st.in', 'xml');
						}
					}
					/*if(count($selected)>0)
					{
						$explode_user = explode(',',$selected);
						foreach($explode_user as $euser)
			 			{
							$message1="Dear , Your ConsumerID is VOL and Login ID is ".$event.". We confirm your Registration with 'Consumer1st'. Contact your Introducer to Activate your CPA(Consumer Personal Assistant) Account. -Team Consumer1st";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($euser, $message1, 'http://www.consumer1st.in', 'xml');
						}
					}*/
					if(count($sms)>0)
					{
						$explode_user = explode(',',$sms);
						foreach($explode_user as $euser)
			 			{
							$message1="Dear , Please find the updates for you are cordially Invited to ID: ".$event." and ".$event_name." hence ".$sms_msg.". Thank You. Team Cfirst.";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($euser, $message1, 'http://www.consumer1st.in', 'xml');
						}
					}
			
	}
	public function EM_send_invitation_email($event,$joined,$selected,$start,$end,$email_msg,$event_name)
	{
			if(count($joined)>0)
					{
						$explode_user = explode(',',$joined);
						foreach($explode_user as $euser)
			 			{
							$get_name = $this->db->get_where('users', ['email'=>$euser]);
							foreach($get_name->result() as $nm);
							$name = $nm->first_name.' '.$nm->last_name;
							$HTMLrow = "Dear ".$name.", Please find the updates for you are cordially Invited to ID: ".$event." and ".$event_name." hence ".$sms_msg.". Thank You. Team Cfirst.";
		$HTMLrow .= '<table><tr>
                        <td style="padding:5px;text-align:center;">Event : '.$event.'</td>
                        <td style="padding:5px;text-align:center;">Event Start date '.$start.'</td>
                        <td style="padding:5px;text-align:center;">Event End date '.$end.'</td>
						
                    </tr></table>';
					 
			$adminEmail = get_option('default_email');
            $subject = 'Event Notification';
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($euser);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $HTMLrow;
            $this->email->message($message);
            $this->email->send();
						}
					}
					if(count($selected)>0)
					{
						$explode_user = explode(',',$selected);
						foreach($explode_user as $euser)
			 			{
							$get_name = $this->db->get_where('users', ['email'=>$euser]);
							foreach($get_name->result() as $nm);
							$name = $nm->first_name.' '.$nm->last_name;
							$HTMLrow = "Dear ".$name.", Please find the updates for you are cordially Invited to ID: ".$event." and ".$event_name." hence ".$sms_msg.". Thank You. Team Cfirst.";
		$HTMLrow .= '<table><tr>
                        <td style="padding:5px;text-align:center;">Event : '.$event.'</td>
                        <td style="padding:5px;text-align:center;">Event Start date '.$start.'</td>
                        <td style="padding:5px;text-align:center;">Event End date '.$end.'</td>
						
                    </tr></table>';
					 
			$adminEmail = get_option('default_email');
            $subject = 'Event Invitation';
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($euser);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $HTMLrow;
            $this->email->message($message);
            $this->email->send();
						}
					}
					
			
	}
	/************************************EM******************************************/
	
	/******************************Terms&Conditions**********************************/
	public function Term_OTP($term_ID,$user_phn,$otp,$first_name,$last_name)
	{
			Include_once ('sendsms.php');
			$message="Dear ".$first_name." ".$last_name.", Your ConsumerID is ".$term_ID." and Login ID is ".$otp.". We confirm your Registration with 'Consumer1st'. Contact your Introducer to Activate your CPA(Consumer Personal Assistant) Account. -Team Consumer1st";
		$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
		$sendsms->send_sms($user_phn, $message, 'http://www.consumer1st.in', 'xml');	
	}
	/******************************\.Terms&Conditions**********************************/
	
	
}//last brace required