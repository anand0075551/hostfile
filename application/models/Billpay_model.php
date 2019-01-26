<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billpay_model extends CI_Model {

  
	
	
/****************************************************************************************************************
			Billpay_request and OTP for Generating Recharge and  Bill Payments
			
*****************************************************************************************************************/

/**
*RECHARGE
**/
/************eeeeeee*******************************/
/****************************************************************************************/
public function landline_payee_transfer($id){
	
	$otp_data = $this->db->get_where('billpay_request', ['id' => $id]);
		foreach($otp_data->result() as $otp);
		
		{
			
			$paying_to  		= $otp->pay_to;		//Paying To Consumer ID
			$amount	    		= $otp->amount;		//Paying Amount	
			$paid_by			= $otp->pay_by;		//Paying By Consumer ID			
			$pay_type   		= $otp->pay_type;   //Pay Specification
			$tranx_id   		= $otp->tranx_id;
			$table_otp	   		= $otp->otp;
			$transaction_type 	= $otp->type;
			$active				= $otp->active;	
			$recharge_no 		= $otp->recharge_no;
			$operator_type 		= $otp->operator_type;
	     	$service_category   = $otp->service_category;
			$post_acc_no   = $otp->account_no;
			$std_code   = $otp->std_code;
			
			
		$user_otp = $this->input->post('otp');
//Very Important changing parties for send/receive based on Radio button selection		

			$pay_by = $paid_by;
			$pay_to = $paying_to;
		
//Checking OTP Authentication for the Transactions				
		if ($table_otp == $user_otp and $active == '0')
	{
/*-----------------------------------------------------------------------------------------------------*/		
		//$status = $this->billpay_model->process_recharge($pay_by, $user_otp);
		 
		 
			
		$myorderid = substr(number_format(time() * rand(),0,'',''),0,15);
		$opt = $operator_type; //$_POST['opt'];
		$mobile = $recharge_no; //$_POST['mobile'];
		$amount = $amount; //$_POST['amount'];
		
			$format='json';
			
		if ($pay_type == "70")
	//	if ($service_category == "recharge prepaid")
		{ 
		//	$mode='0';
		//	$key ='7add0404e7a711e6b49e04014a243c01';
			 // $key ='897158551373092';  //jolo
		//	$format='json';
			
					$ch = curl_init();
		            $timeout = 10; // set to zero for no timeout
					
					
					$format='json';
					
					
					$myurl=file_get_contents('https://joloapi.com/api/cbill.php?mode=1&userid=anand12345&key=897158551373092&operator=$opt&service=$mobile&amount=$amount&std=$std_code&ca=$post_acc_no&orderid=$myorderid&type=json');
					
				
					
	$json = json_decode($myurl, true);
		$status=$json['status'];
			
			
					
	
$dt=date('Y-m-d h:m:i');

if ($status == 'SUCCESS' )  //die('Please Re-check the number details again and Try After 2 minutes...!');		
{		

		$new_satus 			 =  $json['status']; 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];  
		$new_operator 		 = $json['operator']; 
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'Recharge Successful';// $json['message'];
		$new_time 			 = $dt;
		$new_error_code 	 =  $json['error_code'];	
	
	}elseif($status == 'FAILED')
{		$new_satus 			 = $status; 		 
		$new_txnid 			 = 'NA'; 
		$new_usertxn 		 = 'NA'; 
		$new_operator_ref 	 = 'NA'; 
		$new_operator 		 = $opt; 
		$new_country		 = 'NA'; 
		$new_number 		 = $mobile; 
		$new_amount 		 = $amount; 
		$new_amount_deducted = 'NA'; 
		$new_message 		 = 'Not Recharged';// $json['message'];
		$new_time 			 = $dt;
		$new_error_code 	 = $json['error_code']; 	
	
}elseif($status == 'PENDING')
{		$new_satus 			 =  $json['status']; 	 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];   
		$new_operator 		 = $json['operator'];
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'Pending';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';
		
} elseif($status == 'REVERSED')
{		$new_satus 			 =  $json['status']; 	 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];   
		$new_operator 		 = $json['operator'];
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'REVERSED';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';
} elseif($status == 'DISPUTE')
{		$new_satus 			 =  $json['status']; 	 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];   
		$new_operator 		 = $json['operator'];
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'DISPUTE';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';	
	
}

		
	   $billstatus = $this->billpay_model->billstatus($new_satus, $new_txnid, $new_usertxn, $new_operator_ref, $new_operator, $new_country, $new_number, $new_amount, $new_amount_deducted, $new_message,$new_time ,$new_error_code );
			
			

			
/*-----------------------------------------------------------------------------------------------------*/        
	if($status == 'SUCCESS' ) //or $status == 'PENDING')
		
	{
		$proceed = '01';
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
			
			$table_name = "users";			
			$where_array = array('referral_code' => $pay_to);      //Sponsorship fees Paying User 'pay_to'
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$pay_to_userID		  = $r->id;
					$pay_to_first_name    = $r->first_name;
					$pay_to_last_name     = $r->last_name;             
				    $pay_to_email         = $r->email;
					$pay_to_dob			  = $r->date_of_birth;
					$pay_to_adhaar_no     = $r->adhaar_no;
					$pay_to_account_no    = $r->account_no;
					$pay_to_rolename      = $r->rolename;
				    $pay_to_country       = $r->country;
				    $pay_to_country_id    = $r->country_id;			
					$pay_to_photoName     = $r->photo;
				}
			}
		
       $c_id = $pay_to_userID;
	   
       $customer_info = singleDbTableRow($c_id);

        
        //get customer referral Code
        $customer_referral_id = $customer_info->referral_code;
		$rolename 	  		  = $customer_info->rolename; //User type
		
        $customer_id = $customer_info->id;
		$account_no  = $customer_info->account_no;
		$role 		 = $customer_info->role;	
		
		
/****To create Invoice for Transactions*/

        //Get ID From currently logged in User
        $sales_by = $this->session->userdata('logged_user')['user_id'];
	
        $qty 			= '1'; 		//$this->input->post('qty');
        $productName 	= $tranx_id; //'Test Remarks' ; //$this->input->post('productName');
        $categories 	= $pay_type; //$this->input->post('categories');
        $itemCost 		= $amount; 	//$this->input->post('amount');

        $totalProduct = '1'; //count($qty);
		$itemPrice =  $itemCost  ;
		
        $invoiceData = [
            'total_product'         => $totalProduct,
			//'total_price'           => $itemPrice,			
            'customer_id'           => $customer_id,
            'customer_referral_id'  => $customer_referral_id,
            'sales_by'              => $pay_by_userID, //$sales_by,
            'created_at'            => time(),
            'modified_at'           => time(),
        ];

        $insertInvoice = $this->db->insert('invoice', $invoiceData);

        $invoice_id = $this->db->insert_id();

        // Get Each sales Item and insert to sales_item table

        $HTMLrow = '';

        for($i = 0; $i < $totalProduct; $i++)
        {
            $quantity = $qty[$i];


	        $categoryID 	= $categories;   	//payspecification ID
		    $product_name	= $productName;
            $price 			= $amount; 				//$itemPrice[$i] * $quantity;
            $total_price 	= $amount; 		//$price;


			$acct_id1 		= $pay_type; //$this->input->post('sub_account');
			$seller_info 	= $this->session->userdata('logged_user');
			$sellerID	 	= $pay_by_userID	; // 	$sales_by;
			$seller_role	= singleDbTableRow($sellerID)->rolename;
			
			$client_id 		= $pay_to_userID;
			$client_info 	= singleDbTableRow($client_id, 'users') ;		
						
			$client_role = $client_info->rolename;			
			
			$acct_id = $acct_id1;
			
		$commission_per1 = '0'; //$r->commission;
		$benefits_per1 = '0'; //$r->benefits;
			
			/*************************************************************************************/
            $sales_itemData = [
                'category_id'   => $acct_id,
                'product_name'  => $product_name,
                'invoice_id'    => $invoice_id,
                'qty'           => $quantity,
                'item_price'    => $price, //$itemPrice[$i],
                'price'         => $price,
				'commission'    => $commission_per1, //$commission,				
                'benefits'      => $benefits_per1,
                'created_at'    => time(),
                'modified_at'   => time(),
            ];

            $sales_itemInsert = $this->db->insert('sales_item', $sales_itemData);

			
            //HTML For Email
            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;">'.'1'.'</td>
                        <td style="padding:5px;text-align:center;">'.$product_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$amount.'</td>
                        <td style="padding:5px;text-align:center;">'.$quantity.'</td>
                        <td style="padding:5px;text-align:center;">'.$price.'</td>
                    </tr>';


        }
        //Anand Code starts here Section for Commision & Benefits
/**********************
 Table update Response To the Recieving Partner from the Money sender user
*************************/
		 $total_price = $amount; // array_sum($total_price);
			
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$sales_role =  $user['role'];	
		
		$referral_code = singleDbTableRow($pay_by_userID)->referral_code;
		$first_name1 = singleDbTableRow($pay_by_userID)->first_name;
		
		$c_account_no = singleDbTableRow($pay_to_userID)->account_no;
		
		$wallet_balance = $this->input->post('wallet_balance');
		
	
//Benefits details To the Recieving Partner for data retrival 

       // S E N D E R
//pay_by_userID is Seller/Current User who is sending money
		$pm_wallet 	   = 'wallet';		
		$acct_id 	   = $pay_type; //$this->input->post('sub_account');			
		$user_info 	   = $this->session->userdata('logged_user');
        $user_id 	   = $pay_by_userID;
		$email 		   = singleDbTableRow($pay_by_userID)->email;
		$currentUser   = singleDbTableRow($pay_by_userID)->role;
		$sel_ref_code  = singleDbTableRow($pay_by_userID)->referral_code;
		$sel_ref_by    = singleDbTableRow($pay_by_userID)->referredByCode;   //Key field to get 5 level Network
		$seller_role   = singleDbTableRow($pay_by_userID)->rolename;		
		
		$seller_rolename   = typeDbTableRow($seller_role)->rolename;     //Role Description
		$seller_account_no = singleDbTableRow($pay_by_userID)->account_no;	
		$seller_email      = singleDbTableRow($pay_by_userID)->email;	
		
		
		
		
		// R E C I E V E R
//pay_to_userID is Client/Beneficiary User	who is reciving money
		$client_id 		 = $pay_to_userID;
		$client_role  	 = singleDbTableRow($pay_to_userID)->rolename;	  // Role ID		
		$client_rolename = typeDbTableRow($client_role)->rolename;    //Role Description
		$client_email    = singleDbTableRow($pay_to_userID)->email;	
		$client_name  	 = singleDbTableRow($pay_to_userID)->first_name;	
		$clt_ref_code 	 = singleDbTableRow($pay_to_userID)->referral_code;	
		$clt_ref_by   	 = singleDbTableRow($pay_to_userID)->referredByCode; //Key field to get 5 level Network
		$agreed_per 	 = '0';
		$agreed_per      = singleDbTableRow($pay_to_userID)->agreed_per;
		
		
	// Insert data for Accounts-VPA debit "To the Recieving Partner"	
		$tranx_id1 		  = 'Paid by '.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id;

//Get Individual Account transactions series Id	
$acct_user 		= $c_id;
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 
{	foreach ($result_count->result() as $r)
	{       $value 		= $r->tran_count;  	
		    $tran_count = $value + 1;	
	}			
}if ($tran_count == null)
{	$tran_count = '1';}

//End of Individual Account transactions Id	
/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $c_id;
		$user_amount    = 0;
		$points_mode 	= $pm_wallet;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $total_price;
		
		
	
	//Recieving/Client/passive user
	   $accounts1 = [
            'user_id'      			=> $c_id,        //To the Recieving Partner  
			'email'         	    => $client_email,
			'account_no'         	=> $c_account_no,
            'rolename'  		    => $client_role,
			'paid_to'         		=> $user_id,      //From the Money sender user 
            'pay_type'         		=> $acct_id,      //Payspecification ID
			'debit'         		=> $total_price,
			'credit'         		=> '0',
			'amount'         		=> $user_amount, //$total_price,						
			'tranx_id'				=> $tranx_id1,
			'points_mode'           => $pm_wallet,
			'tran_count'			=> $tran_count,
			'used'					=> 'yes',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

	$this->db->insert('accounts', $accounts1);


	$tran = '1'; // 0- Credit 1- debit
	$sms_user = $c_id;
	$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
	
		
	//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
  
	$remarks1 = 'Ledger Update: Paid by'.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id;
		$ledger1 = [
            'user_id'         		=> $c_id,             	//To the Recieving Partner  
			'pay_type'				=> $acct_id, 			//Deduction Pay Specification	
			'account_no'         	=> $c_account_no,		//Member Account No
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
			'debit'         		=> $total_price,
			'credit'         		=> '0',
			'amount'         		=> $total_price,	
			'points_mode'           => $pm_wallet,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks1,             //Description
			'count'					=> 'yes',
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $this->db->insert('ledger', $ledger1);	
		
	
		
		$tranx_id2 = "Paid to '".$client_rolename.'-'.$client_name."' for the Invoice ID-".$invoice_id;
		
	//Sender/Seller/Active user
	
	
								$user_debit  	= $this->product_model->total_debit($userID, $points_mode);
								$user_credit  	= $this->product_model->total_credit($userID, $points_mode);
							
		
//Get Individual Account transactions Id
	
$acct_user 		= $user_id;		
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 
{	foreach ($result_count->result() as $r)
	{       $value 		= $r->tran_count;  					
			$tran_count = $value + 1;				
	}							
}
//End of Individual Account transactions Id	
		
/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $user_id;
		$user_amount    = 0;
		$points_mode 	= $pm_wallet;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $total_price;
		
	   $accounts2 = [
            'user_id'      			=> $user_id,        //From the Money sender user
			'email'         	    => $seller_email,
			'account_no'         	=> $seller_account_no,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,      // To the Recieving Partner  
            'pay_type'         		=> $acct_id,      //Payspecification ID
			'debit'         		=> '0',
			'credit'         		=> $total_price,
			'amount'         		=> $user_amount, //$total_price,						
			'tranx_id'				=> $tranx_id2,
			'points_mode'           => $pm_wallet,
			'tran_count'			=> $tran_count,
			'used'					=> 'yes',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

         $this->db->insert('accounts', $accounts2);
		
			$tran = '0'; // 0- Credit 1- debit
			$sms_user = $user_id;
			$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
			
	
	
		//Except Agent and Customer, recording rest of the transactions to Ledger
	if ($currentUser = 'admin' )	
	{   
		$remarks2 = "Ledger Update: Paid to '".$client_rolename.'-'.$client_name."' for the Invoice ID-".$invoice_id;
		$ledger2 = [
            'user_id'         		=> $user_id,             	//To the Recieving Partner  
			'pay_type'				=> $acct_id, 			    //Deduction Pay Specification	
			'account_no'         	=> $seller_account_no,		//Member Account No
			'email'					=> $seller_email,
			'rolename'  			=> $seller_role,
            'credit'         		=> $total_price,
			'debit'         		=> '0', 	
			'amount'         		=> $total_price, 
			'points_mode'           => 'wallet',
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks2,             //Description
			'count'					=> 'no',
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $this->db->insert('ledger', $ledger2);	
		
	}
	
/***********************************************************************************************/	
/* Updating OTP table as Data Processed													   */
/* 																							   */
/*																							   */
/***********************************************************************************************/
			 $data9 = [
           	'active'            => '1',            
            'modified_at'       => time()
        ];

       $query9 = $this->db->where('id', $id)->update('billpay_request', $data9);	
	   
/******Automatically Payspecification will be Identified and calculates the Percentage**************/	

		$table_name = "commissions";
			$where_array = array('sub_acct_id' =>$acct_id, 'from_role' =>$seller_role, 'to_role' =>$client_role, 'identity' =>'Commission');
			$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
		$points_mode    = $row->points_mode;
		$benefits_per   = $row->benefits;         
		$commission_per = $row->commission;      //Debit to Payspecification
		
		$deduction_paytype = $row->ded_paytype;		
		
		$profit_pm    	  = $row->profit_pm;
		$seller_profit    = $row->sender_profit;
		$client_profit    = $row->receiver_profit;
		
		$deduction_pm  	 = $row->deduction_pm;
		$seller_deduction = $row->sender_deduction;
		
		 if ($client_role == '13' && $agreed_per > 0 )
		 {
			 $client_deduction = $agreed_per;
		 }else{
			 $client_deduction = $row->receiver_deduction;
		 }
		
	//----------------------------------------------------------------------------------------------//
//*************************************//Profit to 'Seller'
		
        $seller_info = singleDbTableRow($pay_by_userID);
		$seller_account_no = $seller_info->account_no;  // $customer_info->referral_code;  
		$seller_benefits = (($total_price * $seller_profit) / '100' ) ; //Percentage value for Seller
		//Seller Loyality
		if ($seller_benefits != '0')
		{   $text5 = $seller_rolename.'- commission for Invoice ID-'.$invoice_id;
	
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_by_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_by_userID;
		$user_amount    = 0;
		$points_mode 	= $profit_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $seller_benefits;

										
	   $accounts5 = [
            'user_id'      			=> $pay_by_userID,          //From the Money sender user
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,           // To the Recieving Partner  
            'tranx_id'         		=> $text5,  	  //$pay_type,
			'credit'         		=> '0',
			'debit'         		=> $seller_benefits,
			'amount'         		=> $user_amount,	
			'points_mode'           => $profit_pm,
			'tran_count'			=> $tran_count,				
			'used'					=> 'no',
			'pay_type'				=> $acct_id,         //Debit from Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts5); 
		
		$sms_user = $pay_by_userID;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
		$sms_total = $seller_benefits;
		$pm_wallet = $profit_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );

						
		//Deduction of commission from Ledger Table with Respective Payspecification and passing the
		//same value to the respective Benefitiary
		   $remarks6 = $seller_rolename.'- commission for Invoice ID-'.$invoice_id;
        $data6 = [
            'user_id'         		=> $pay_by_userID,              //From the Money sender user
			'pay_type'				=> $deduction_paytype,   //Deduction from Pay Specification	
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
			'rolename'  			=> $seller_role,
            'credit'         		=> $seller_benefits,
			'debit'         		=> '0', 	
			'amount'         		=> $seller_benefits, 
			'points_mode'           => $profit_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks6,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data6);
		}
//----------------------------------------------------------------------------------------------//
//*************************************//Profit to 'Client'
	
	
	
	
	
	
//$deduction_paytype for Deduction
		$ded_payspec1 = "Commission Deducted from Pay Spec No -". $deduction_paytype ;
					
		
		$client_benefits = (($total_price * $client_profit) / '100' ) ; //Percentage value for Client
	if ($client_benefits != '0')	
	{	$tranx_id3 = $client_rolename.'- commission for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_to_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_to_userID;
		$user_amount    = 0;
		$points_mode 	= $profit_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $client_benefits;
		
	   $accounts3 = [
            'user_id'      			=> $pay_to_userID,          //To the Recieving Partner  
			'account_no'         	=> $c_account_no,
            'rolename'  			=> $client_role,
			'email'					=> $client_email,
			'paid_to'         		=> $userID,       //From the Money sender user 
            'tranx_id'         		=> $tranx_id3,
			'credit'         		=> '0',
			'debit'         		=> $client_benefits,
			'amount'         		=> $user_amount,	
			'points_mode'           => $profit_pm,	
			'tran_count'			=> $tran_count,
			'used'					=> 'no',
		    'pay_type'				=> $acct_id,         //Debit from Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts3); 
		$sms_user = $c_id;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
		$sms_total = $client_benefits;
		$pm_wallet = $profit_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
		
	//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
			$remarks4 = $client_rolename.'- commission for Invoice ID -'.$invoice_id; 
        $data4 = [
            'user_id'         		=> $pay_to_userID,             		//To the Recieving Partner  
			'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
			'account_no'         	=> $c_account_no,			//Member Account No
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
            'credit'         		=> $client_benefits,
			'debit'         		=> '0', 	
			'amount'         		=> $client_benefits, 
			'points_mode'           => $profit_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks4,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data4);
	}
//----------------------------------------------------------------------------------------------//	 
//*****************************/Commission from 'Sender'





        $seller_info = singleDbTableRow($pay_by_userID);
		$seller_account_no = $seller_info->account_no;  // $customer_info->referral_code;  
		$seller_commission = '0';
		$seller_commission = (($total_price * $seller_deduction) / '100' ) ; //Percentage value for Seller
	if($seller_commission  != '0')	
	{	//Seller Loyality
	   $text9 = 'Commission deducted from -'.$seller_rolename.'-for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_by_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_by_userID;
		$user_amount    = 0;
		$points_mode 	= $deduction_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $seller_commission;
		
	   $accounts9 = [
            'user_id'      			=> $pay_by_userID,          //From the Money sender user
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,           // To the Recieving Partner  
            'tranx_id'         		=> $text9,  	 
			'debit'         		=> '0',
			'credit'         		=> $seller_commission,
			'amount'         		=> $user_amount,	
			'points_mode'           => $deduction_pm,	
			'tran_count'			=> $tran_count,	
			'used'					=> 'yes',
			'pay_type'				=> $acct_id,		 //Deposit Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts9); 
		$sms_user = $pay_by_userID;								
		$tran = '0'; // "1" if 'Credit' == 0 & no amount value      -OR-                  *  "0" if 'debit' == 0 & no amount value 							
		$sms_total = $seller_commission;
		$pm_wallet = $deduction_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
						
		//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
		  $remarks10 = 'Commission deduction from -'.$seller_rolename.'-for Invoice ID -'.$invoice_id; 
        $data10 = [
            'user_id'         		=> $pay_by_userID,              //From the Money sender user
			'pay_type'				=> $acct_id,   //Deposit Pay Specification	
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
			'rolename' 			    => $seller_role,
            'debit'         		=> $seller_commission,
			'credit'         		=> '0', 	
			'amount'         		=> $seller_commission, 
			'points_mode'           => $deduction_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks10,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data10);	
	}	   
//----------------------------------------------------------------------------------------------//
//*****************************/Commission from 'Client' 





		$ded_payspec1 = "Benefits Deducted from Pay Spec No -". $acct_id ;
					
		$client_commission = '0';
		$client_commission = (($total_price * $client_deduction) / '100' ) ; //Percentage value for Client
		
	if($client_commission != '0')
	{	$tranx_id7 = 'Commission deduction from -'.$client_rolename.'-for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_to_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $pay_to_userID;
		$user_amount    = 0;
		$points_mode 	= $deduction_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $client_commission;
		
	   $accounts7 = [
            'user_id'      			=> $pay_to_userID,          //To the Recieving Partner  
			'account_no'         	=> $c_account_no,
            'rolename'  			=> $client_role,
			'email'					=> $client_email,
			'paid_to'         		=> $userID,       //From the Money sender user 
            'tranx_id'         		=> $tranx_id7,
			'debit'         		=> '0',
			'credit'         		=> $client_commission,
			'amount'         		=> $user_amount,	
			'points_mode'           => $deduction_pm,	
			'tran_count'			=> $tran_count,	
			'used'					=> 'yes',
		    'pay_type'				=> $acct_id, //Deposit Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts7); 
		$sms_user = $pay_to_userID;								
		$tran = '0'; // "1" if 'Credit' == 0 & no amount value      -OR-                  *  "0" if 'debit' == 0 & no amount value 							
		$sms_total = $client_commission;
		$pm_wallet = $deduction_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
			$remarks8 = 'Commission deduction from -'.$client_rolename.'-for Invoice ID -'.$invoice_id; 	
        $data8 = [
            'user_id'         		=> $pay_to_userID,             	 //To the Recieving Partner  
			'pay_type'				=> $acct_id, 			 //Deposit Pay Specification	
			'account_no'         	=> $c_account_no,
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
            'debit'         		=> $client_commission,
			'credit'         		=> '0', 	
			'amount'         		=> $client_commission, 
			'points_mode'           => $deduction_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks8,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data8);	


	}	
		$slr_ref_pm  	 = $row->slr_ref_pm;	
		$slr_ref_level1  = $row->slr_ref_level1;		
		$slr_ref_level2  = $row->slr_ref_level2;	
		$slr_ref_level3  = $row->slr_ref_level3;	
		$slr_ref_level4  = $row->slr_ref_level4;	
		$slr_ref_level5  = $row->slr_ref_level5;	
		
		$clt_ref_pm  	 = $row->clt_ref_pm;	
		$clt_ref_level1  = $row->clt_ref_level1;
		$clt_ref_level2  = $row->clt_ref_level2;	
		$clt_ref_level3  = $row->clt_ref_level3;	
		$clt_ref_level4  = $row->clt_ref_level4;	
		$clt_ref_level5  = $row->clt_ref_level5;
				
				
//Function to do multiple activity				
				
		$slr_ref_per_level1  = (($total_price * $slr_ref_level1) / '100' ) ; //Percentage value for slr_ref_level1	
		$slr_ref_per_level2  = (($total_price * $slr_ref_level2) / '100' ) ; //Percentage value for slr_ref_level2	
		$slr_ref_per_level3  = (($total_price * $slr_ref_level3) / '100' ) ; //Percentage value for slr_ref_level3	
		$slr_ref_per_level4  = (($total_price * $slr_ref_level4) / '100' ) ; //Percentage value for slr_ref_level4	
		$slr_ref_per_level5  = (($total_price * $slr_ref_level5) / '100' ) ; //Percentage value for slr_ref_level5	

		$clt_ref_per_level1  = (($total_price * $clt_ref_level1) / '100' ) ; //Percentage value for clt_ref_level1			
		$clt_ref_per_level2  = (($total_price * $clt_ref_level2) / '100' ) ; //Percentage value for clt_ref_level2			
		$clt_ref_per_level3  = (($total_price * $clt_ref_level3) / '100' ) ; //Percentage value for clt_ref_level3			
		$clt_ref_per_level4  = (($total_price * $clt_ref_level4) / '100' ) ; //Percentage value for clt_ref_level4			
		$clt_ref_per_level5  = (($total_price * $clt_ref_level5) / '100' ) ; //Percentage value for clt_ref_level5			


/*********   Begin of  'seller' Referrals Commision for Level 1        *********/

		$table_name = "users";
		$where_array = array('referral_code' =>$sel_ref_by, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id1 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_sl_ref2  =  $row->referredByCode;           // Next referral chain
				
				if($ref_id1!= 0)
				{
		   			if ($slr_ref_per_level1 != '0')
						{
								$text1 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ref_account_no = singleDbTableRow($ref_id1)->account_no;
								
								//Update Debit balance
								$userID = $ref_id1;	$user_amount = '0';	
								$points_mode = $slr_ref_pm;
								$user_debit  	= $this->product_model->total_debit($userID, $points_mode);
								$user_credit  	= $this->product_model->total_credit($userID, $points_mode);
								$user_balance = '0'; //$user_debit - $user_credit;
								$user_amount = $user_balance + $slr_ref_per_level1;
								
								//Get Individual Account transactions Id
								
								$acct_user 		= $ref_id1;		
								$result_count  	= $this->product_model->get_tran_count($acct_user);		
								if($result_count -> num_rows() > 0) 
								{	foreach ($result_count->result() as $r)
									{       $value 		= $r->tran_count;  					
											$tran_count = $value + 1;				
									}							
								}
								//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id1;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level1;
								$accounts_ref1 = [
									'user_id'      			=> $ref_id1,          //To the Recieving Partner  
									'account_no'         	=> $ref_account_no,									
									'rolename'  			=> $rolename,
									'email'					=> $email,
									'paid_to'         		=> $paid_to,       //From the Money sender user 
									'tranx_id'         		=> $text1,
									'credit'         		=> '0',
									'debit'         		=> $slr_ref_per_level1,
									'amount'         		=> $user_amount, //$slr_ref_per_level1,	
									'points_mode'           => $slr_ref_pm,	
									'tran_count'			=> $tran_count,	
									'used'					=> 'no',
									'pay_type'				=> $deduction_paytype, //$invoice_id,		
									'created_at'            => time(),
									'modified_at'           => time()
								];

								$this->db->insert('accounts', $accounts_ref1); 
								
								$sms_user = $ref_id1;								
								$tran = '1'; // 1 if 'Credit' == 0 and 0 if 'debit' == 0								
								$sms_total = $slr_ref_per_level1;
								$pm_wallet = $slr_ref_pm;
								$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
								
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ledger_ref1 = [
									'user_id'         		=> $ref_id1,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level1,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level1, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref1);
						}
				}
		
	/*********             Referrals Commision for Level 2                    *********/
					if( $next_sl_ref2!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_sl_ref2, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id2 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
								$next_sl_ref3  =  $row->referredByCode;   //Next referral chain
						     if($ref_id2!= 0)
								{
									if ($slr_ref_per_level2 != '0')
									{
										$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
										$ref_account_no = singleDbTableRow($ref_id2)->account_no;
										
									
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id2;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id2;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level2;
										$accounts_ref2 = [
											'user_id'      			=> $ref_id2,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $slr_ref_per_level2,
											'amount'         		=> $user_amount, //$slr_ref_per_level2,	
											'points_mode'           => $slr_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_ref2); 	
									
									$sms_user = $ref_id2;								
									$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
									$sms_total = $slr_ref_per_level2;
									$pm_wallet = $slr_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
									
									
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;
									$ledger_ref2 = [
									'user_id'         		=> $ref_id2,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level2,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level2, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref2);
									}
						        }
						
/*********             Referrals Commision for Level 3                    *********/
								if( $next_sl_ref3!= 0)     ////Next refferal is Available? Proceed
								{
										$table_name = "users";
											$where_array = array('referral_code' =>$next_sl_ref3, 'active' => '1');
											$query = $this->db->where($where_array )->get($table_name); 
											foreach ($query->result() as $row)
											{	
													$ref_id3 	= $row->id;		
													$rolename	= $row->rolename;
													$email      = $row->email;
													$paid_to	= $row->id;
													$next_sl_ref4  =  $row->referredByCode;   //Next refferall chain
												if($ref_id3!= 0)
												{
												if ($slr_ref_per_level3 != '0')
												{	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
													$ref_account_no = singleDbTableRow($ref_id3)->account_no;
													
													//Get Individual Account transactions Id
													
													$acct_user 		= $ref_id3;		
													$result_count  	= $this->product_model->get_tran_count($acct_user);		
													if($result_count -> num_rows() > 0) 
													{	foreach ($result_count->result() as $r)
														{       $value 		= $r->tran_count;  					
																$tran_count = $value + 1;				
														}							
													}
													//End of Individual Account transactions Id	
		

		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id3;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level3;
													$accounts_ref3 = [
														'user_id'      			=> $ref_id3,          //To the Recieving Part	ner  
														'account_no'         	=> $ref_account_no,
														'rolename'  			=> $rolename,
														'email'					=> $email,
														'paid_to'         		=> $paid_to,       //From the Money sender 	user 
														'tranx_id'         		=> $text2,
														'credit'         		=>	 '0',
														'debit'         		=> $slr_ref_per_level3,
														'amount'         		=> $user_amount, //$slr_ref_per_level3,	
														'points_mode'           => $slr_ref_pm,
														'tran_count'			=> $tran_count,															
														'used'					=> 	'no',
														'pay_type'				=> $deduction_paytype, //$invoice_	id,		
														'created_at'            => time(),
														'modified_at'           => time()
													];

														$this->db->insert('accounts', $accounts_ref3); 
														$sms_user = $ref_id3;								
														$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
														$sms_total = $slr_ref_per_level3;
														$pm_wallet = $slr_ref_pm;
														$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
														$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
													$ledger_ref3 = [
														'user_id'         		=> $ref_id3,             		//To the Recieving Partner  
														'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
														'account_no'         	=> $ref_account_no,			//Member Account No
														'email'					=> $email,
														'rolename'  			=> $rolename,
														'credit'         		=> $slr_ref_per_level3,
														'debit'         		=> '0', 	
														'amount'         		=> $slr_ref_per_level3, 
														'points_mode'           => $slr_ref_pm,
														'invoice_id '  			=> $invoice_id,		
														'challan' 				=> 'no_invoice.jpg',			
														'remarks'         		=> $remarks,
														'start_date'         	=> time(),		
														'created_at'            => time(),
														'modified_at'           => time()
													];

												   $query = $this->db->insert('ledger', $ledger_ref1);
												}	//End of DB update					
											}		 //End of Next Ref ID Not Available
										
				
/*********             Referrals Commision for Level 4                    *********/
	if( $next_sl_ref4!= 0)     ////Next refferal is Available? Proceed
		{
		$table_name = "users";
		$where_array = array('referral_code' =>$next_sl_ref4, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id4 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_sl_ref5  =  $row->referredByCode;   //Next refferall chain
		
				if($ref_id4!= 0)
				{		
				if ($slr_ref_per_level4 != '0')
				   {	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
						$ref_account_no = singleDbTableRow($ref_id4)->account_no;
						//Get Individual Account transactions Id
						
						$acct_user 		= $ref_id4;		
						$result_count  	= $this->product_model->get_tran_count($acct_user);		
						if($result_count -> num_rows() > 0) 
						{	foreach ($result_count->result() as $r)
							{       $value 		= $r->tran_count;  					
									$tran_count = $value + 1;				
							}							
						}
						//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id4;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level4;
		
						$accounts_ref4 = [
							'user_id'      			=> $ref_id4,          //To the Recieving Partner  
							'account_no'         	=> $ref_account_no,
							'rolename'  			    => $rolename,
							'email'					=> $email,
							'paid_to'         		=> $paid_to,       //From the Money sender user 
							'tranx_id'         		=> $text2,
							'credit'         		=> '0',
							'debit'         		=> $slr_ref_per_level4,
							'amount'         		=> $user_amount,	
							'points_mode'           => $slr_ref_pm,	
							'tran_count'			=> $tran_count,	
							'used'					=> 'no',
							'pay_type'				=> $deduction_paytype, //$invoice_id,		
							'created_at'            => time(),
							'modified_at'           => time()
					];

					$this->db->insert('accounts', $accounts_ref4); 	

					$sms_user = $ref_id4;								
					$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
					$sms_total = $slr_ref_per_level4;
					$pm_wallet = $slr_ref_pm;
					$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
					$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
												
					$ledger_ref4 = [
									'user_id'         		=> $ref_id4,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level4,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level4, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref4);
					}	//End of DB update					
				}		 //End of Next Ref ID Not Available
/*********             Referrals Commision for Level 5                    *********/
				if( $next_sl_ref5!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_sl_ref5, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id5 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
							//	$next_sl_ref4  =  $row->referredByCode;   //No  Next refferall chain
						
							if($ref_id5!= 0)
							{		
									if ($slr_ref_per_level5 != '0')
									{
									$text2 = 'Referrals Business loyalty for Invoice ID-'.$invoice_id;
									$ref_account_no = singleDbTableRow($ref_id5)->account_no;
									//Get Individual Account transactions Id
									
									$acct_user 		= $ref_id5;		
									$result_count  	= $this->product_model->get_tran_count($acct_user);		
									if($result_count -> num_rows() > 0) 
									{	foreach ($result_count->result() as $r)
										{       $value 		= $r->tran_count;  					
												$tran_count = $value + 1;				
										}							
									}
									//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id5;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level5;								
										$accounts_ref5 = [
											'user_id'      			=> $ref_id5,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			    => $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $slr_ref_per_level5,
											'amount'         		=> $user_amount,	
											'points_mode'           => $slr_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_ref5); 	
									$sms_user = $ref_id5;								
									$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
									$sms_total = $slr_ref_per_level5;
									$pm_wallet = $slr_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );	
									
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
					
									$ledger_ref5 = [
									'user_id'         		=> $ref_id5,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level5,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level5, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

									$query = $this->db->insert('ledger', $ledger_ref1);
									}		
							}
	
						}
	
					}
					}
				}
				}
			}
			}
		}
	}
	
/*************************End of Seller Ref Profit sharing**************************************************/




/*********          Begin of Client Ref Profit sharing Referrals Commision for Level 1             *********/

		$table_name = "users";
		$where_array = array('referral_code' =>$clt_ref_by, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id1 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_cl_ref2  =  $row->referredByCode;           // Next referral chain
				
				if($ref_id1!= 0)
				{
		   			if ($clt_ref_per_level1 != '0')
						{
								$text1 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ref_account_no = singleDbTableRow($ref_id1)->account_no;
								//Get Individual Account transactions Id
								
								$acct_user 		= $ref_id1;		
								$result_count  	= $this->product_model->get_tran_count($acct_user);		
								if($result_count -> num_rows() > 0) 
								{	foreach ($result_count->result() as $r)
									{       $value 		= $r->tran_count;  					
											$tran_count = $value + 1;				
									}							
								}
								//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id1;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level1;
		
								$accounts_clr_ref1 = [
									'user_id'      			=> $ref_id1,          //To the Recieving Partner  
									'account_no'         	=> $ref_account_no,
									'rolename'  			=> $rolename,
									'email'					=> $email,
									'paid_to'         		=> $paid_to,       //From the Money sender user 
									'tranx_id'         		=> $text1,
									'credit'         		=> '0',
									'debit'         		=> $clt_ref_per_level1,
									'amount'         		=> $user_amount,	
									'points_mode'           => $clt_ref_pm,	
									'tran_count'			=> $tran_count,	
									'used'					=> 'no',
									'pay_type'				=> $deduction_paytype, //$invoice_id,		
									'created_at'            => time(),
									'modified_at'           => time()
								];
								
					
								$this->db->insert('accounts', $accounts_clr_ref1);
								
								$sms_user = $ref_id1;								
								$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
								$sms_total = $clt_ref_per_level1;
								$pm_wallet = $clt_ref_pm;
								$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );


								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref1 = [
									'user_id'         		=> $ref_id1,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level1,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level1, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
						}
				}
		
	/*********             Referrals Commision for Level 2                    *********/
					if( $next_cl_ref2!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_cl_ref2, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id2 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
								$next_cl_ref3  =  $row->referredByCode;   //Next referral chain
						     if($ref_id2!= 0)
								{
									if ($clt_ref_per_level2 != '0')
									{
										$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
										$ref_account_no = singleDbTableRow($ref_id2)->account_no;
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id2;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id2;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level2;
		
										$accounts_clr_ref2 = [
											'user_id'      			=> $ref_id2,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $clt_ref_per_level2,
											'amount'         		=> $user_amount,	
											'points_mode'           => $clt_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_clr_ref2); 	
									
									$sms_user = $ref_id2;								
									$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
									$sms_total = $clt_ref_per_level2;
									$pm_wallet = $clt_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
								
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;									
								$ledger_clr_ref3 = [
									'user_id'         		=> $ref_id2,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level3,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level3, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
									}
						        }
						
/*********             Referrals Commision for Level 3                    *********/
								if( $next_cl_ref3!= 0)     ////Next refferal is Available? Proceed
								{
										$table_name = "users";
											$where_array = array('referral_code' =>$next_cl_ref3, 'active' => '1');
											$query = $this->db->where($where_array )->get($table_name); 
											foreach ($query->result() as $row)
											{	
													$ref_id3 	= $row->id;		
													$rolename	= $row->rolename;
													$email      = $row->email;
													$paid_to	= $row->id;
													$next_cl_ref4  =  $row->referredByCode;   //Next refferall chain
												if($ref_id3!= 0)
												{
												if ($clt_ref_per_level3 != '0')
												{	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
													$ref_account_no = singleDbTableRow($ref_id3)->account_no;
													//Get Individual Account transactions Id
													

													$acct_user 		= $ref_id3;		
													$result_count  	= $this->product_model->get_tran_count($acct_user);		
													if($result_count -> num_rows() > 0) 
													{	foreach ($result_count->result() as $r)
														{       $value 		= $r->tran_count;  					
																$tran_count = $value + 1;				
														}							
													}
													//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id3;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level3;
		
													$accounts_clr_ref3 = [
														'user_id'      			=> $ref_id3,          //To the Recieving Part	ner  
														'account_no'         	=> $ref_account_no,
														'rolename'  			=> $rolename,
														'email'					=> $email,
														'paid_to'         		=> $paid_to,       //From the Money sender 	user 
														'tranx_id'         		=> $text2,
														'credit'         		=>	 '0',
														'debit'         		=> $clt_ref_per_level3,
														'amount'         		=> $user_amount,	
														'points_mode'           => $clt_ref_pm,	
														'tran_count'			=> $tran_count,	
														'used'					=> 	'no',
														'pay_type'				=> $deduction_paytype, //$invoice_	id,		
														'created_at'            => time(),
														'modified_at'           => time()
													];

														$this->db->insert('accounts', $accounts_clr_ref3); 
														
														$sms_user = $ref_id3;								
														$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
														$sms_total = $clt_ref_per_level3;
														$pm_wallet = $clt_ref_pm;
														$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );

									
													$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;		
													$ledger_clr_ref3 = [
														'user_id'         		=> $ref_id3,             		//To the Recieving Partner  
														'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
														'account_no'         	=> $ref_account_no,			    //Member Account No
														'email'					=> $email,
														'rolename'  			=> $rolename,
														'credit'         		=> $clt_ref_per_level3,
														'debit'         		=> '0', 	
														'amount'         		=> $clt_ref_per_level3, 
														'points_mode'           => $clt_ref_pm,
														'invoice_id '  			=> $invoice_id,		
														'challan' 				=> 'no_invoice.jpg',			
														'remarks'         		=> $remarks,
														'start_date'         	=> time(),		
														'created_at'            => time(),
														'modified_at'           => time()
													];

												   $query = $this->db->insert('ledger', $ledger_clr_ref1);														
												}	//End of DB update					
											}		 //End of Next Ref ID Not Available
										
				
/*********             Referrals Commision for Level 4                    *********/
	if( $next_cl_ref4!= 0)     ////Next refferal is Available? Proceed
		{
		$table_name = "users";
		$where_array = array('referral_code' =>$next_cl_ref4, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id4 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_cl_ref5  =  $row->referredByCode;   //Next refferall chain
		
				if($ref_id4!= 0)
				{		
				if ($clt_ref_per_level4 != '0')
				   {	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
						$ref_account_no = singleDbTableRow($ref_id4)->account_no;
						//Get Individual Account transactions Id
						
						$acct_user 		= $ref_id4;		
						$result_count  	= $this->product_model->get_tran_count($acct_user);		
						if($result_count -> num_rows() > 0) 
						{	foreach ($result_count->result() as $r)
							{       $value 		= $r->tran_count;  					
									$tran_count = $value + 1;				
							}							
						}
						//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id4;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level4;
		
						$accounts_clr_ref4 = [
							'user_id'      			=> $ref_id4,          //To the Recieving Partner  
							'account_no'         	=> $ref_account_no,
							'rolename'  			    => $rolename,
							'email'					=> $email,
							'paid_to'         		=> $paid_to,       //From the Money sender user 
							'tranx_id'         		=> $text2,
							'credit'         		=> '0',
							'debit'         		=> $clt_ref_per_level4,
							'amount'         		=> $user_amount,	
							'points_mode'           => $clt_ref_pm,	
							'tran_count'			=> $tran_count,	
							'used'					=> 'no',
							'pay_type'				=> $deduction_paytype, //$invoice_id,		
							'created_at'            => time(),
							'modified_at'           => time()
					];

					$this->db->insert('accounts', $accounts_clr_ref4);

					$sms_user = $ref_id3;								
					$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
					$sms_total = $clt_ref_per_level3;
					$pm_wallet = $clt_ref_pm;
					$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref4 = [
									'user_id'         		=> $ref_id4,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level4,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level4, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);					
					}	//End of DB update					
				}		 //End of Next Ref ID Not Available
/*********             Referrals Commision for Level 5                    *********/
				if( $next_cl_ref5!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_cl_ref5, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id5 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
							//	$next_cl_ref4  =  $row->referredByCode;   //No  Next refferall chain
						
							if($ref_id5!= 0)
							{		
									if ($clt_ref_per_level5 != '0')
									{
									$text2 = 'Referrals Business loyalty for Invoice ID-'.$invoice_id;
									$ref_account_no = singleDbTableRow($ref_id5)->account_no;
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id5;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id5;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level5;

		
										$accounts_clr_ref5 = [
											'user_id'      			=> $ref_id5,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $clt_ref_per_level5,
											'amount'         		=> $user_amount,	
											'points_mode'           => $clt_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_clr_ref5); 	
									
									$sms_user = $ref_id5;								
									$tran = '1'; // "1" if 'Credit' == 0 & no amount value -OR- "0" if 'debit' == 0 & no amount value 							
									$sms_total = $clt_ref_per_level5;
									$pm_wallet = $clt_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
					
					
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref5 = [
									'user_id'         		=> $ref_id5,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level5,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level5, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
									}		
							}
	
						}
	
					}
					}
				}
				}
			}
			}
		}
	}
	
	
	
/*************************End of Client Ref Profit sharing***************************************/	


	
/***************************************************************************************
Business/Payspecification Commision for the Transaction Turnover

*********/
//Final Balance update	
		//$led_rulets2 = ($wallet_balance + $commission);
		
		

      		}    
		
//**********************************************************************************************************//
        //Determine if invoice insert success
        if($insertInvoice)
        {

           /**
                     * Send Email to customer Now
                     */



            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;" colspan="4">Total Price</td>
                        <td style="padding:5px;text-align:center;">'.$total_price.'</td>
                    </tr>';

            $email_data = [
                'userData'     => $customer_info,
                'tableRow'      => $HTMLrow
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');
            $subject = 'Hi '.user_full_name($customer_info).', your Transaction details @'.date('d-m-Y h:i a');
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($customer_info->email);
          //  $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('product_sell_email_tpl',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
            //Email END:



            return $invoice_id;
        }
        
		
}


}
//else{

            //set error message and go back
 //           setFlashGoBack('errorMsg', 'This Transaction Is Already Processed...!!!');
       
}
}

}
/***************************/
/*****eeee**/
/****************************************************************************************/
public function broadband_payee_transfer($id){
	
	$otp_data = $this->db->get_where('billpay_request', ['id' => $id]);
		foreach($otp_data->result() as $otp);
		
		{
			
			$paying_to  		= $otp->pay_to;		//Paying To Consumer ID
			$amount	    		= $otp->amount;		//Paying Amount	
			$paid_by			= $otp->pay_by;		//Paying By Consumer ID			
			$pay_type   		= $otp->pay_type;   //Pay Specification
			$tranx_id   		= $otp->tranx_id;
			$table_otp	   		= $otp->otp;
			$transaction_type 	= $otp->type;
			$active				= $otp->active;	
			$recharge_no 		= $otp->recharge_no;
			$operator_type 		= $otp->operator_type;
	     	$service_category   = $otp->service_category;
			$post_acc_no   = $otp->account_no;
			
			
		$user_otp = $this->input->post('otp');
//Very Important changing parties for send/receive based on Radio button selection		

			$pay_by = $paid_by;
			$pay_to = $paying_to;
		
//Checking OTP Authentication for the Transactions				
		if ($table_otp == $user_otp and $active == '0')
	{
/*-----------------------------------------------------------------------------------------------------*/		
		//$status = $this->billpay_model->process_recharge($pay_by, $user_otp);
		 
		 
			
		$myorderid = substr(number_format(time() * rand(),0,'',''),0,15);
		$opt = $operator_type; //$_POST['opt'];
		$mobile = $recharge_no; //$_POST['mobile'];
		$amount = $amount; //$_POST['amount'];
		
			$format='json';
			
		if ($pay_type == "70")
	//	if ($service_category == "recharge prepaid")
		{ 
		//	$mode='0';
		//	$key ='7add0404e7a711e6b49e04014a243c01';
			 // $key ='897158551373092';  //jolo
		//	$format='json';
			
					$ch = curl_init();
		            $timeout = 10; // set to zero for no timeout
					$std_code = '';
					$key ='ff705116ac2011e6b4bd04014a243c01';
					$format='json';
				$myurl=file_get_contents('https://request.apihit.com/v2/bill-pay?key='.$key.'&operator='.$opt.'&amount='.$amount.'&country=91&number='.$mobile.'-&account='.$post_acc_no.'&stdcode='.$std_code.'&usertxn='.$myorderid.'&format='.$format);	
					
	$json = json_decode($myurl, true);
		$status=$json['status'];
			
			
					
	
$dt=date('Y-m-d h:m:i');

if ($status == 'SUCCESS' )  //die('Please Re-check the number details again and Try After 2 minutes...!');		
{		

		$new_satus 			 =  $json['status']; 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];  
		$new_operator 		 = $json['operator']; 
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'Recharge Successful';// $json['message'];
		$new_time 			 = $dt;
		$new_error_code 	 =  $json['error_code'];	
	
	}elseif($status == 'FAILED')
{		$new_satus 			 = $status; 		 
		$new_txnid 			 = 'NA'; 
		$new_usertxn 		 = 'NA'; 
		$new_operator_ref 	 = 'NA'; 
		$new_operator 		 = $opt; 
		$new_country		 = 'NA'; 
		$new_number 		 = $mobile; 
		$new_amount 		 = $amount; 
		$new_amount_deducted = 'NA'; 
		$new_message 		 = 'Not Recharged';// $json['message'];
		$new_time 			 = $dt;
		$new_error_code 	 = $json['error_code']; 	
	
}elseif($status == 'PENDING')
{		$new_satus 			 =  $json['status']; 	 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];   
		$new_operator 		 = $json['operator'];
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'Pending';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';
		
} elseif($status == 'REVERSED')
{		$new_satus 			 =  $json['status']; 	 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];   
		$new_operator 		 = $json['operator'];
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'REVERSED';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';
} elseif($status == 'DISPUTE')
{		$new_satus 			 =  $json['status']; 	 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];   
		$new_operator 		 = $json['operator'];
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'DISPUTE';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';	
	
}

		
	   $billstatus = $this->billpay_model->billstatus($new_satus, $new_txnid, $new_usertxn, $new_operator_ref, $new_operator, $new_country, $new_number, $new_amount, $new_amount_deducted, $new_message,$new_time ,$new_error_code );
			
			

			
/*-----------------------------------------------------------------------------------------------------*/        
	if($status == 'SUCCESS' ) //or $status == 'PENDING')
		
	{
		$proceed = '01';
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
			
			$table_name = "users";			
			$where_array = array('referral_code' => $pay_to);      //Sponsorship fees Paying User 'pay_to'
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$pay_to_userID		  = $r->id;
					$pay_to_first_name    = $r->first_name;
					$pay_to_last_name     = $r->last_name;             
				    $pay_to_email         = $r->email;
					$pay_to_dob			  = $r->date_of_birth;
					$pay_to_adhaar_no     = $r->adhaar_no;
					$pay_to_account_no    = $r->account_no;
					$pay_to_rolename      = $r->rolename;
				    $pay_to_country       = $r->country;
				    $pay_to_country_id    = $r->country_id;			
					$pay_to_photoName     = $r->photo;
				}
			}
		
       $c_id = $pay_to_userID;
	   
       $customer_info = singleDbTableRow($c_id);

        
        //get customer referral Code
        $customer_referral_id = $customer_info->referral_code;
		$rolename 	  		  = $customer_info->rolename; //User type
		
        $customer_id = $customer_info->id;
		$account_no  = $customer_info->account_no;
		$role 		 = $customer_info->role;	
		
		
/****To create Invoice for Transactions*/

        //Get ID From currently logged in User
        $sales_by = $this->session->userdata('logged_user')['user_id'];
	
        $qty 			= '1'; 		//$this->input->post('qty');
        $productName 	= $tranx_id; //'Test Remarks' ; //$this->input->post('productName');
        $categories 	= $pay_type; //$this->input->post('categories');
        $itemCost 		= $amount; 	//$this->input->post('amount');

        $totalProduct = '1'; //count($qty);
		$itemPrice =  $itemCost  ;
		
        $invoiceData = [
            'total_product'         => $totalProduct,
			//'total_price'           => $itemPrice,			
            'customer_id'           => $customer_id,
            'customer_referral_id'  => $customer_referral_id,
            'sales_by'              => $pay_by_userID, //$sales_by,
            'created_at'            => time(),
            'modified_at'           => time(),
        ];

        $insertInvoice = $this->db->insert('invoice', $invoiceData);

        $invoice_id = $this->db->insert_id();

        // Get Each sales Item and insert to sales_item table

        $HTMLrow = '';

        for($i = 0; $i < $totalProduct; $i++)
        {
            $quantity = $qty[$i];


	        $categoryID 	= $categories;   	//payspecification ID
		    $product_name	= $productName;
            $price 			= $amount; 				//$itemPrice[$i] * $quantity;
            $total_price 	= $amount; 		//$price;


			$acct_id1 		= $pay_type; //$this->input->post('sub_account');
			$seller_info 	= $this->session->userdata('logged_user');
			$sellerID	 	= $pay_by_userID	; // 	$sales_by;
			$seller_role	= singleDbTableRow($sellerID)->rolename;
			
			$client_id 		= $pay_to_userID;
			$client_info 	= singleDbTableRow($client_id, 'users') ;		
						
			$client_role = $client_info->rolename;			
			
			$acct_id = $acct_id1;
			
		$commission_per1 = '0'; //$r->commission;
		$benefits_per1 = '0'; //$r->benefits;
			
			/*************************************************************************************/
            $sales_itemData = [
                'category_id'   => $acct_id,
                'product_name'  => $product_name,
                'invoice_id'    => $invoice_id,
                'qty'           => $quantity,
                'item_price'    => $price, //$itemPrice[$i],
                'price'         => $price,
				'commission'    => $commission_per1, //$commission,				
                'benefits'      => $benefits_per1,
                'created_at'    => time(),
                'modified_at'   => time(),
            ];

            $sales_itemInsert = $this->db->insert('sales_item', $sales_itemData);

			
            //HTML For Email
            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;">'.'1'.'</td>
                        <td style="padding:5px;text-align:center;">'.$product_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$amount.'</td>
                        <td style="padding:5px;text-align:center;">'.$quantity.'</td>
                        <td style="padding:5px;text-align:center;">'.$price.'</td>
                    </tr>';


        }
        //Anand Code starts here Section for Commision & Benefits
/**********************
 Table update Response To the Recieving Partner from the Money sender user
*************************/
		 $total_price = $amount; // array_sum($total_price);
			
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$sales_role =  $user['role'];	
		
		$referral_code = singleDbTableRow($pay_by_userID)->referral_code;
		$first_name1 = singleDbTableRow($pay_by_userID)->first_name;
		
		$c_account_no = singleDbTableRow($pay_to_userID)->account_no;
		
		$wallet_balance = $this->input->post('wallet_balance');
		
	
//Benefits details To the Recieving Partner for data retrival 

       // S E N D E R
//pay_by_userID is Seller/Current User who is sending money
		$pm_wallet 	   = 'wallet';		
		$acct_id 	   = $pay_type; //$this->input->post('sub_account');			
		$user_info 	   = $this->session->userdata('logged_user');
        $user_id 	   = $pay_by_userID;
		$email 		   = singleDbTableRow($pay_by_userID)->email;
		$currentUser   = singleDbTableRow($pay_by_userID)->role;
		$sel_ref_code  = singleDbTableRow($pay_by_userID)->referral_code;
		$sel_ref_by    = singleDbTableRow($pay_by_userID)->referredByCode;   //Key field to get 5 level Network
		$seller_role   = singleDbTableRow($pay_by_userID)->rolename;		
		
		$seller_rolename   = typeDbTableRow($seller_role)->rolename;     //Role Description
		$seller_account_no = singleDbTableRow($pay_by_userID)->account_no;	
		$seller_email      = singleDbTableRow($pay_by_userID)->email;	
		
		
		
		
		// R E C I E V E R
//pay_to_userID is Client/Beneficiary User	who is reciving money
		$client_id 		 = $pay_to_userID;
		$client_role  	 = singleDbTableRow($pay_to_userID)->rolename;	  // Role ID		
		$client_rolename = typeDbTableRow($client_role)->rolename;    //Role Description
		$client_email    = singleDbTableRow($pay_to_userID)->email;	
		$client_name  	 = singleDbTableRow($pay_to_userID)->first_name;	
		$clt_ref_code 	 = singleDbTableRow($pay_to_userID)->referral_code;	
		$clt_ref_by   	 = singleDbTableRow($pay_to_userID)->referredByCode; //Key field to get 5 level Network
		$agreed_per 	 = '0';
		$agreed_per      = singleDbTableRow($pay_to_userID)->agreed_per;
		
		
	// Insert data for Accounts-VPA debit "To the Recieving Partner"	
		$tranx_id1 		  = 'Paid by '.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id;

//Get Individual Account transactions series Id	
$acct_user 		= $c_id;
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 
{	foreach ($result_count->result() as $r)
	{       $value 		= $r->tran_count;  	
		    $tran_count = $value + 1;	
	}			
}if ($tran_count == null)
{	$tran_count = '1';}

//End of Individual Account transactions Id	
/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $c_id;
		$user_amount    = 0;
		$points_mode 	= $pm_wallet;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $total_price;
		
		
	
	//Recieving/Client/passive user
	   $accounts1 = [
            'user_id'      			=> $c_id,        //To the Recieving Partner  
			'email'         	    => $client_email,
			'account_no'         	=> $c_account_no,
            'rolename'  		    => $client_role,
			'paid_to'         		=> $user_id,      //From the Money sender user 
            'pay_type'         		=> $acct_id,      //Payspecification ID
			'debit'         		=> $total_price,
			'credit'         		=> '0',
			'amount'         		=> $user_amount, //$total_price,						
			'tranx_id'				=> $tranx_id1,
			'points_mode'           => $pm_wallet,
			'tran_count'			=> $tran_count,
			'used'					=> 'yes',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

	$this->db->insert('accounts', $accounts1);


	$tran = '1'; // 0- Credit 1- debit
	$sms_user = $c_id;
	$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
	
		
	//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
  
	$remarks1 = 'Ledger Update: Paid by'.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id;
		$ledger1 = [
            'user_id'         		=> $c_id,             	//To the Recieving Partner  
			'pay_type'				=> $acct_id, 			//Deduction Pay Specification	
			'account_no'         	=> $c_account_no,		//Member Account No
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
			'debit'         		=> $total_price,
			'credit'         		=> '0',
			'amount'         		=> $total_price,	
			'points_mode'           => $pm_wallet,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks1,             //Description
			'count'					=> 'yes',
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $this->db->insert('ledger', $ledger1);	
		
	
		
		$tranx_id2 = "Paid to '".$client_rolename.'-'.$client_name."' for the Invoice ID-".$invoice_id;
		
	//Sender/Seller/Active user
	
	
								$user_debit  	= $this->product_model->total_debit($userID, $points_mode);
								$user_credit  	= $this->product_model->total_credit($userID, $points_mode);
							
		
//Get Individual Account transactions Id
	
$acct_user 		= $user_id;		
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 
{	foreach ($result_count->result() as $r)
	{       $value 		= $r->tran_count;  					
			$tran_count = $value + 1;				
	}							
}
//End of Individual Account transactions Id	
		
/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $user_id;
		$user_amount    = 0;
		$points_mode 	= $pm_wallet;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $total_price;
		
	   $accounts2 = [
            'user_id'      			=> $user_id,        //From the Money sender user
			'email'         	    => $seller_email,
			'account_no'         	=> $seller_account_no,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,      // To the Recieving Partner  
            'pay_type'         		=> $acct_id,      //Payspecification ID
			'debit'         		=> '0',
			'credit'         		=> $total_price,
			'amount'         		=> $user_amount, //$total_price,						
			'tranx_id'				=> $tranx_id2,
			'points_mode'           => $pm_wallet,
			'tran_count'			=> $tran_count,
			'used'					=> 'yes',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

         $this->db->insert('accounts', $accounts2);
		
			$tran = '0'; // 0- Credit 1- debit
			$sms_user = $user_id;
			$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
			
	
	
		//Except Agent and Customer, recording rest of the transactions to Ledger
	if ($currentUser = 'admin' )	
	{   
		$remarks2 = "Ledger Update: Paid to '".$client_rolename.'-'.$client_name."' for the Invoice ID-".$invoice_id;
		$ledger2 = [
            'user_id'         		=> $user_id,             	//To the Recieving Partner  
			'pay_type'				=> $acct_id, 			    //Deduction Pay Specification	
			'account_no'         	=> $seller_account_no,		//Member Account No
			'email'					=> $seller_email,
			'rolename'  			=> $seller_role,
            'credit'         		=> $total_price,
			'debit'         		=> '0', 	
			'amount'         		=> $total_price, 
			'points_mode'           => 'wallet',
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks2,             //Description
			'count'					=> 'no',
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $this->db->insert('ledger', $ledger2);	
		
	}
	
/***********************************************************************************************/	
/* Updating OTP table as Data Processed													   */
/* 																							   */
/*																							   */
/***********************************************************************************************/
			 $data9 = [
           	'active'            => '1',            
            'modified_at'       => time()
        ];

       $query9 = $this->db->where('id', $id)->update('billpay_request', $data9);	
	   
/******Automatically Payspecification will be Identified and calculates the Percentage**************/	

		$table_name = "commissions";
			$where_array = array('sub_acct_id' =>$acct_id, 'from_role' =>$seller_role, 'to_role' =>$client_role, 'identity' =>'Commission');
			$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
		$points_mode    = $row->points_mode;
		$benefits_per   = $row->benefits;         
		$commission_per = $row->commission;      //Debit to Payspecification
		
		$deduction_paytype = $row->ded_paytype;		
		
		$profit_pm    	  = $row->profit_pm;
		$seller_profit    = $row->sender_profit;
		$client_profit    = $row->receiver_profit;
		
		$deduction_pm  	 = $row->deduction_pm;
		$seller_deduction = $row->sender_deduction;
		
		 if ($client_role == '13' && $agreed_per > 0 )
		 {
			 $client_deduction = $agreed_per;
		 }else{
			 $client_deduction = $row->receiver_deduction;
		 }
		
	//----------------------------------------------------------------------------------------------//
//*************************************//Profit to 'Seller'
		
        $seller_info = singleDbTableRow($pay_by_userID);
		$seller_account_no = $seller_info->account_no;  // $customer_info->referral_code;  
		$seller_benefits = (($total_price * $seller_profit) / '100' ) ; //Percentage value for Seller
		//Seller Loyality
		if ($seller_benefits != '0')
		{   $text5 = $seller_rolename.'- commission for Invoice ID-'.$invoice_id;
	
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_by_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_by_userID;
		$user_amount    = 0;
		$points_mode 	= $profit_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $seller_benefits;

										
	   $accounts5 = [
            'user_id'      			=> $pay_by_userID,          //From the Money sender user
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,           // To the Recieving Partner  
            'tranx_id'         		=> $text5,  	  //$pay_type,
			'credit'         		=> '0',
			'debit'         		=> $seller_benefits,
			'amount'         		=> $user_amount,	
			'points_mode'           => $profit_pm,
			'tran_count'			=> $tran_count,				
			'used'					=> 'no',
			'pay_type'				=> $acct_id,         //Debit from Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts5); 
		
		$sms_user = $pay_by_userID;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
		$sms_total = $seller_benefits;
		$pm_wallet = $profit_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );

						
		//Deduction of commission from Ledger Table with Respective Payspecification and passing the
		//same value to the respective Benefitiary
		   $remarks6 = $seller_rolename.'- commission for Invoice ID-'.$invoice_id;
        $data6 = [
            'user_id'         		=> $pay_by_userID,              //From the Money sender user
			'pay_type'				=> $deduction_paytype,   //Deduction from Pay Specification	
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
			'rolename'  			=> $seller_role,
            'credit'         		=> $seller_benefits,
			'debit'         		=> '0', 	
			'amount'         		=> $seller_benefits, 
			'points_mode'           => $profit_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks6,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data6);
		}
//----------------------------------------------------------------------------------------------//
//*************************************//Profit to 'Client'
	
	
	
	
	
	
//$deduction_paytype for Deduction
		$ded_payspec1 = "Commission Deducted from Pay Spec No -". $deduction_paytype ;
					
		
		$client_benefits = (($total_price * $client_profit) / '100' ) ; //Percentage value for Client
	if ($client_benefits != '0')	
	{	$tranx_id3 = $client_rolename.'- commission for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_to_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_to_userID;
		$user_amount    = 0;
		$points_mode 	= $profit_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $client_benefits;
		
	   $accounts3 = [
            'user_id'      			=> $pay_to_userID,          //To the Recieving Partner  
			'account_no'         	=> $c_account_no,
            'rolename'  			=> $client_role,
			'email'					=> $client_email,
			'paid_to'         		=> $userID,       //From the Money sender user 
            'tranx_id'         		=> $tranx_id3,
			'credit'         		=> '0',
			'debit'         		=> $client_benefits,
			'amount'         		=> $user_amount,	
			'points_mode'           => $profit_pm,	
			'tran_count'			=> $tran_count,
			'used'					=> 'no',
		    'pay_type'				=> $acct_id,         //Debit from Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts3); 
		$sms_user = $c_id;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
		$sms_total = $client_benefits;
		$pm_wallet = $profit_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
		
	//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
			$remarks4 = $client_rolename.'- commission for Invoice ID -'.$invoice_id; 
        $data4 = [
            'user_id'         		=> $pay_to_userID,             		//To the Recieving Partner  
			'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
			'account_no'         	=> $c_account_no,			//Member Account No
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
            'credit'         		=> $client_benefits,
			'debit'         		=> '0', 	
			'amount'         		=> $client_benefits, 
			'points_mode'           => $profit_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks4,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data4);
	}
//----------------------------------------------------------------------------------------------//	 
//*****************************/Commission from 'Sender'





        $seller_info = singleDbTableRow($pay_by_userID);
		$seller_account_no = $seller_info->account_no;  // $customer_info->referral_code;  
		$seller_commission = '0';
		$seller_commission = (($total_price * $seller_deduction) / '100' ) ; //Percentage value for Seller
	if($seller_commission  != '0')	
	{	//Seller Loyality
	   $text9 = 'Commission deducted from -'.$seller_rolename.'-for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_by_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_by_userID;
		$user_amount    = 0;
		$points_mode 	= $deduction_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $seller_commission;
		
	   $accounts9 = [
            'user_id'      			=> $pay_by_userID,          //From the Money sender user
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,           // To the Recieving Partner  
            'tranx_id'         		=> $text9,  	 
			'debit'         		=> '0',
			'credit'         		=> $seller_commission,
			'amount'         		=> $user_amount,	
			'points_mode'           => $deduction_pm,	
			'tran_count'			=> $tran_count,	
			'used'					=> 'yes',
			'pay_type'				=> $acct_id,		 //Deposit Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts9); 
		$sms_user = $pay_by_userID;								
		$tran = '0'; // "1" if 'Credit' == 0 & no amount value      -OR-                  *  "0" if 'debit' == 0 & no amount value 							
		$sms_total = $seller_commission;
		$pm_wallet = $deduction_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
						
		//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
		  $remarks10 = 'Commission deduction from -'.$seller_rolename.'-for Invoice ID -'.$invoice_id; 
        $data10 = [
            'user_id'         		=> $pay_by_userID,              //From the Money sender user
			'pay_type'				=> $acct_id,   //Deposit Pay Specification	
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
			'rolename' 			    => $seller_role,
            'debit'         		=> $seller_commission,
			'credit'         		=> '0', 	
			'amount'         		=> $seller_commission, 
			'points_mode'           => $deduction_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks10,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data10);	
	}	   
//----------------------------------------------------------------------------------------------//
//*****************************/Commission from 'Client' 





		$ded_payspec1 = "Benefits Deducted from Pay Spec No -". $acct_id ;
					
		$client_commission = '0';
		$client_commission = (($total_price * $client_deduction) / '100' ) ; //Percentage value for Client
		
	if($client_commission != '0')
	{	$tranx_id7 = 'Commission deduction from -'.$client_rolename.'-for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_to_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $pay_to_userID;
		$user_amount    = 0;
		$points_mode 	= $deduction_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $client_commission;
		
	   $accounts7 = [
            'user_id'      			=> $pay_to_userID,          //To the Recieving Partner  
			'account_no'         	=> $c_account_no,
            'rolename'  			=> $client_role,
			'email'					=> $client_email,
			'paid_to'         		=> $userID,       //From the Money sender user 
            'tranx_id'         		=> $tranx_id7,
			'debit'         		=> '0',
			'credit'         		=> $client_commission,
			'amount'         		=> $user_amount,	
			'points_mode'           => $deduction_pm,	
			'tran_count'			=> $tran_count,	
			'used'					=> 'yes',
		    'pay_type'				=> $acct_id, //Deposit Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts7); 
		$sms_user = $pay_to_userID;								
		$tran = '0'; // "1" if 'Credit' == 0 & no amount value      -OR-                  *  "0" if 'debit' == 0 & no amount value 							
		$sms_total = $client_commission;
		$pm_wallet = $deduction_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
			$remarks8 = 'Commission deduction from -'.$client_rolename.'-for Invoice ID -'.$invoice_id; 	
        $data8 = [
            'user_id'         		=> $pay_to_userID,             	 //To the Recieving Partner  
			'pay_type'				=> $acct_id, 			 //Deposit Pay Specification	
			'account_no'         	=> $c_account_no,
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
            'debit'         		=> $client_commission,
			'credit'         		=> '0', 	
			'amount'         		=> $client_commission, 
			'points_mode'           => $deduction_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks8,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data8);	


	}	
		$slr_ref_pm  	 = $row->slr_ref_pm;	
		$slr_ref_level1  = $row->slr_ref_level1;		
		$slr_ref_level2  = $row->slr_ref_level2;	
		$slr_ref_level3  = $row->slr_ref_level3;	
		$slr_ref_level4  = $row->slr_ref_level4;	
		$slr_ref_level5  = $row->slr_ref_level5;	
		
		$clt_ref_pm  	 = $row->clt_ref_pm;	
		$clt_ref_level1  = $row->clt_ref_level1;
		$clt_ref_level2  = $row->clt_ref_level2;	
		$clt_ref_level3  = $row->clt_ref_level3;	
		$clt_ref_level4  = $row->clt_ref_level4;	
		$clt_ref_level5  = $row->clt_ref_level5;
				
				
//Function to do multiple activity				
				
		$slr_ref_per_level1  = (($total_price * $slr_ref_level1) / '100' ) ; //Percentage value for slr_ref_level1	
		$slr_ref_per_level2  = (($total_price * $slr_ref_level2) / '100' ) ; //Percentage value for slr_ref_level2	
		$slr_ref_per_level3  = (($total_price * $slr_ref_level3) / '100' ) ; //Percentage value for slr_ref_level3	
		$slr_ref_per_level4  = (($total_price * $slr_ref_level4) / '100' ) ; //Percentage value for slr_ref_level4	
		$slr_ref_per_level5  = (($total_price * $slr_ref_level5) / '100' ) ; //Percentage value for slr_ref_level5	

		$clt_ref_per_level1  = (($total_price * $clt_ref_level1) / '100' ) ; //Percentage value for clt_ref_level1			
		$clt_ref_per_level2  = (($total_price * $clt_ref_level2) / '100' ) ; //Percentage value for clt_ref_level2			
		$clt_ref_per_level3  = (($total_price * $clt_ref_level3) / '100' ) ; //Percentage value for clt_ref_level3			
		$clt_ref_per_level4  = (($total_price * $clt_ref_level4) / '100' ) ; //Percentage value for clt_ref_level4			
		$clt_ref_per_level5  = (($total_price * $clt_ref_level5) / '100' ) ; //Percentage value for clt_ref_level5			


/*********   Begin of  'seller' Referrals Commision for Level 1        *********/

		$table_name = "users";
		$where_array = array('referral_code' =>$sel_ref_by, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id1 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_sl_ref2  =  $row->referredByCode;           // Next referral chain
				
				if($ref_id1!= 0)
				{
		   			if ($slr_ref_per_level1 != '0')
						{
								$text1 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ref_account_no = singleDbTableRow($ref_id1)->account_no;
								
								//Update Debit balance
								$userID = $ref_id1;	$user_amount = '0';	
								$points_mode = $slr_ref_pm;
								$user_debit  	= $this->product_model->total_debit($userID, $points_mode);
								$user_credit  	= $this->product_model->total_credit($userID, $points_mode);
								$user_balance = '0'; //$user_debit - $user_credit;
								$user_amount = $user_balance + $slr_ref_per_level1;
								
								//Get Individual Account transactions Id
								
								$acct_user 		= $ref_id1;		
								$result_count  	= $this->product_model->get_tran_count($acct_user);		
								if($result_count -> num_rows() > 0) 
								{	foreach ($result_count->result() as $r)
									{       $value 		= $r->tran_count;  					
											$tran_count = $value + 1;				
									}							
								}
								//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id1;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level1;
								$accounts_ref1 = [
									'user_id'      			=> $ref_id1,          //To the Recieving Partner  
									'account_no'         	=> $ref_account_no,									
									'rolename'  			=> $rolename,
									'email'					=> $email,
									'paid_to'         		=> $paid_to,       //From the Money sender user 
									'tranx_id'         		=> $text1,
									'credit'         		=> '0',
									'debit'         		=> $slr_ref_per_level1,
									'amount'         		=> $user_amount, //$slr_ref_per_level1,	
									'points_mode'           => $slr_ref_pm,	
									'tran_count'			=> $tran_count,	
									'used'					=> 'no',
									'pay_type'				=> $deduction_paytype, //$invoice_id,		
									'created_at'            => time(),
									'modified_at'           => time()
								];

								$this->db->insert('accounts', $accounts_ref1); 
								
								$sms_user = $ref_id1;								
								$tran = '1'; // 1 if 'Credit' == 0 and 0 if 'debit' == 0								
								$sms_total = $slr_ref_per_level1;
								$pm_wallet = $slr_ref_pm;
								$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
								
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ledger_ref1 = [
									'user_id'         		=> $ref_id1,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level1,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level1, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref1);
						}
				}
		
	/*********             Referrals Commision for Level 2                    *********/
					if( $next_sl_ref2!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_sl_ref2, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id2 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
								$next_sl_ref3  =  $row->referredByCode;   //Next referral chain
						     if($ref_id2!= 0)
								{
									if ($slr_ref_per_level2 != '0')
									{
										$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
										$ref_account_no = singleDbTableRow($ref_id2)->account_no;
										
									
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id2;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id2;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level2;
										$accounts_ref2 = [
											'user_id'      			=> $ref_id2,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $slr_ref_per_level2,
											'amount'         		=> $user_amount, //$slr_ref_per_level2,	
											'points_mode'           => $slr_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_ref2); 	
									
									$sms_user = $ref_id2;								
									$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
									$sms_total = $slr_ref_per_level2;
									$pm_wallet = $slr_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
									
									
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;
									$ledger_ref2 = [
									'user_id'         		=> $ref_id2,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level2,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level2, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref2);
									}
						        }
						
/*********             Referrals Commision for Level 3                    *********/
								if( $next_sl_ref3!= 0)     ////Next refferal is Available? Proceed
								{
										$table_name = "users";
											$where_array = array('referral_code' =>$next_sl_ref3, 'active' => '1');
											$query = $this->db->where($where_array )->get($table_name); 
											foreach ($query->result() as $row)
											{	
													$ref_id3 	= $row->id;		
													$rolename	= $row->rolename;
													$email      = $row->email;
													$paid_to	= $row->id;
													$next_sl_ref4  =  $row->referredByCode;   //Next refferall chain
												if($ref_id3!= 0)
												{
												if ($slr_ref_per_level3 != '0')
												{	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
													$ref_account_no = singleDbTableRow($ref_id3)->account_no;
													
													//Get Individual Account transactions Id
													
													$acct_user 		= $ref_id3;		
													$result_count  	= $this->product_model->get_tran_count($acct_user);		
													if($result_count -> num_rows() > 0) 
													{	foreach ($result_count->result() as $r)
														{       $value 		= $r->tran_count;  					
																$tran_count = $value + 1;				
														}							
													}
													//End of Individual Account transactions Id	
		

		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id3;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level3;
													$accounts_ref3 = [
														'user_id'      			=> $ref_id3,          //To the Recieving Part	ner  
														'account_no'         	=> $ref_account_no,
														'rolename'  			=> $rolename,
														'email'					=> $email,
														'paid_to'         		=> $paid_to,       //From the Money sender 	user 
														'tranx_id'         		=> $text2,
														'credit'         		=>	 '0',
														'debit'         		=> $slr_ref_per_level3,
														'amount'         		=> $user_amount, //$slr_ref_per_level3,	
														'points_mode'           => $slr_ref_pm,
														'tran_count'			=> $tran_count,															
														'used'					=> 	'no',
														'pay_type'				=> $deduction_paytype, //$invoice_	id,		
														'created_at'            => time(),
														'modified_at'           => time()
													];

														$this->db->insert('accounts', $accounts_ref3); 
														$sms_user = $ref_id3;								
														$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
														$sms_total = $slr_ref_per_level3;
														$pm_wallet = $slr_ref_pm;
														$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
														$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
													$ledger_ref3 = [
														'user_id'         		=> $ref_id3,             		//To the Recieving Partner  
														'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
														'account_no'         	=> $ref_account_no,			//Member Account No
														'email'					=> $email,
														'rolename'  			=> $rolename,
														'credit'         		=> $slr_ref_per_level3,
														'debit'         		=> '0', 	
														'amount'         		=> $slr_ref_per_level3, 
														'points_mode'           => $slr_ref_pm,
														'invoice_id '  			=> $invoice_id,		
														'challan' 				=> 'no_invoice.jpg',			
														'remarks'         		=> $remarks,
														'start_date'         	=> time(),		
														'created_at'            => time(),
														'modified_at'           => time()
													];

												   $query = $this->db->insert('ledger', $ledger_ref1);
												}	//End of DB update					
											}		 //End of Next Ref ID Not Available
										
				
/*********             Referrals Commision for Level 4                    *********/
	if( $next_sl_ref4!= 0)     ////Next refferal is Available? Proceed
		{
		$table_name = "users";
		$where_array = array('referral_code' =>$next_sl_ref4, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id4 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_sl_ref5  =  $row->referredByCode;   //Next refferall chain
		
				if($ref_id4!= 0)
				{		
				if ($slr_ref_per_level4 != '0')
				   {	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
						$ref_account_no = singleDbTableRow($ref_id4)->account_no;
						//Get Individual Account transactions Id
						
						$acct_user 		= $ref_id4;		
						$result_count  	= $this->product_model->get_tran_count($acct_user);		
						if($result_count -> num_rows() > 0) 
						{	foreach ($result_count->result() as $r)
							{       $value 		= $r->tran_count;  					
									$tran_count = $value + 1;				
							}							
						}
						//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id4;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level4;
		
						$accounts_ref4 = [
							'user_id'      			=> $ref_id4,          //To the Recieving Partner  
							'account_no'         	=> $ref_account_no,
							'rolename'  			    => $rolename,
							'email'					=> $email,
							'paid_to'         		=> $paid_to,       //From the Money sender user 
							'tranx_id'         		=> $text2,
							'credit'         		=> '0',
							'debit'         		=> $slr_ref_per_level4,
							'amount'         		=> $user_amount,	
							'points_mode'           => $slr_ref_pm,	
							'tran_count'			=> $tran_count,	
							'used'					=> 'no',
							'pay_type'				=> $deduction_paytype, //$invoice_id,		
							'created_at'            => time(),
							'modified_at'           => time()
					];

					$this->db->insert('accounts', $accounts_ref4); 	

					$sms_user = $ref_id4;								
					$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
					$sms_total = $slr_ref_per_level4;
					$pm_wallet = $slr_ref_pm;
					$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
					$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
												
					$ledger_ref4 = [
									'user_id'         		=> $ref_id4,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level4,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level4, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref4);
					}	//End of DB update					
				}		 //End of Next Ref ID Not Available
/*********             Referrals Commision for Level 5                    *********/
				if( $next_sl_ref5!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_sl_ref5, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id5 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
							//	$next_sl_ref4  =  $row->referredByCode;   //No  Next refferall chain
						
							if($ref_id5!= 0)
							{		
									if ($slr_ref_per_level5 != '0')
									{
									$text2 = 'Referrals Business loyalty for Invoice ID-'.$invoice_id;
									$ref_account_no = singleDbTableRow($ref_id5)->account_no;
									//Get Individual Account transactions Id
									
									$acct_user 		= $ref_id5;		
									$result_count  	= $this->product_model->get_tran_count($acct_user);		
									if($result_count -> num_rows() > 0) 
									{	foreach ($result_count->result() as $r)
										{       $value 		= $r->tran_count;  					
												$tran_count = $value + 1;				
										}							
									}
									//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id5;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level5;								
										$accounts_ref5 = [
											'user_id'      			=> $ref_id5,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			    => $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $slr_ref_per_level5,
											'amount'         		=> $user_amount,	
											'points_mode'           => $slr_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_ref5); 	
									$sms_user = $ref_id5;								
									$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
									$sms_total = $slr_ref_per_level5;
									$pm_wallet = $slr_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );	
									
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
					
									$ledger_ref5 = [
									'user_id'         		=> $ref_id5,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level5,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level5, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

									$query = $this->db->insert('ledger', $ledger_ref1);
									}		
							}
	
						}
	
					}
					}
				}
				}
			}
			}
		}
	}
	
/*************************End of Seller Ref Profit sharing**************************************************/




/*********          Begin of Client Ref Profit sharing Referrals Commision for Level 1             *********/

		$table_name = "users";
		$where_array = array('referral_code' =>$clt_ref_by, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id1 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_cl_ref2  =  $row->referredByCode;           // Next referral chain
				
				if($ref_id1!= 0)
				{
		   			if ($clt_ref_per_level1 != '0')
						{
								$text1 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ref_account_no = singleDbTableRow($ref_id1)->account_no;
								//Get Individual Account transactions Id
								
								$acct_user 		= $ref_id1;		
								$result_count  	= $this->product_model->get_tran_count($acct_user);		
								if($result_count -> num_rows() > 0) 
								{	foreach ($result_count->result() as $r)
									{       $value 		= $r->tran_count;  					
											$tran_count = $value + 1;				
									}							
								}
								//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id1;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level1;
		
								$accounts_clr_ref1 = [
									'user_id'      			=> $ref_id1,          //To the Recieving Partner  
									'account_no'         	=> $ref_account_no,
									'rolename'  			=> $rolename,
									'email'					=> $email,
									'paid_to'         		=> $paid_to,       //From the Money sender user 
									'tranx_id'         		=> $text1,
									'credit'         		=> '0',
									'debit'         		=> $clt_ref_per_level1,
									'amount'         		=> $user_amount,	
									'points_mode'           => $clt_ref_pm,	
									'tran_count'			=> $tran_count,	
									'used'					=> 'no',
									'pay_type'				=> $deduction_paytype, //$invoice_id,		
									'created_at'            => time(),
									'modified_at'           => time()
								];
								
					
								$this->db->insert('accounts', $accounts_clr_ref1);
								
								$sms_user = $ref_id1;								
								$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
								$sms_total = $clt_ref_per_level1;
								$pm_wallet = $clt_ref_pm;
								$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );


								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref1 = [
									'user_id'         		=> $ref_id1,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level1,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level1, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
						}
				}
		
	/*********             Referrals Commision for Level 2                    *********/
					if( $next_cl_ref2!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_cl_ref2, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id2 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
								$next_cl_ref3  =  $row->referredByCode;   //Next referral chain
						     if($ref_id2!= 0)
								{
									if ($clt_ref_per_level2 != '0')
									{
										$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
										$ref_account_no = singleDbTableRow($ref_id2)->account_no;
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id2;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id2;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level2;
		
										$accounts_clr_ref2 = [
											'user_id'      			=> $ref_id2,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $clt_ref_per_level2,
											'amount'         		=> $user_amount,	
											'points_mode'           => $clt_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_clr_ref2); 	
									
									$sms_user = $ref_id2;								
									$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
									$sms_total = $clt_ref_per_level2;
									$pm_wallet = $clt_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
								
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;									
								$ledger_clr_ref3 = [
									'user_id'         		=> $ref_id2,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level3,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level3, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
									}
						        }
						
/*********             Referrals Commision for Level 3                    *********/
								if( $next_cl_ref3!= 0)     ////Next refferal is Available? Proceed
								{
										$table_name = "users";
											$where_array = array('referral_code' =>$next_cl_ref3, 'active' => '1');
											$query = $this->db->where($where_array )->get($table_name); 
											foreach ($query->result() as $row)
											{	
													$ref_id3 	= $row->id;		
													$rolename	= $row->rolename;
													$email      = $row->email;
													$paid_to	= $row->id;
													$next_cl_ref4  =  $row->referredByCode;   //Next refferall chain
												if($ref_id3!= 0)
												{
												if ($clt_ref_per_level3 != '0')
												{	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
													$ref_account_no = singleDbTableRow($ref_id3)->account_no;
													//Get Individual Account transactions Id
													

													$acct_user 		= $ref_id3;		
													$result_count  	= $this->product_model->get_tran_count($acct_user);		
													if($result_count -> num_rows() > 0) 
													{	foreach ($result_count->result() as $r)
														{       $value 		= $r->tran_count;  					
																$tran_count = $value + 1;				
														}							
													}
													//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id3;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level3;
		
													$accounts_clr_ref3 = [
														'user_id'      			=> $ref_id3,          //To the Recieving Part	ner  
														'account_no'         	=> $ref_account_no,
														'rolename'  			=> $rolename,
														'email'					=> $email,
														'paid_to'         		=> $paid_to,       //From the Money sender 	user 
														'tranx_id'         		=> $text2,
														'credit'         		=>	 '0',
														'debit'         		=> $clt_ref_per_level3,
														'amount'         		=> $user_amount,	
														'points_mode'           => $clt_ref_pm,	
														'tran_count'			=> $tran_count,	
														'used'					=> 	'no',
														'pay_type'				=> $deduction_paytype, //$invoice_	id,		
														'created_at'            => time(),
														'modified_at'           => time()
													];

														$this->db->insert('accounts', $accounts_clr_ref3); 
														
														$sms_user = $ref_id3;								
														$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
														$sms_total = $clt_ref_per_level3;
														$pm_wallet = $clt_ref_pm;
														$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );

									
													$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;		
													$ledger_clr_ref3 = [
														'user_id'         		=> $ref_id3,             		//To the Recieving Partner  
														'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
														'account_no'         	=> $ref_account_no,			    //Member Account No
														'email'					=> $email,
														'rolename'  			=> $rolename,
														'credit'         		=> $clt_ref_per_level3,
														'debit'         		=> '0', 	
														'amount'         		=> $clt_ref_per_level3, 
														'points_mode'           => $clt_ref_pm,
														'invoice_id '  			=> $invoice_id,		
														'challan' 				=> 'no_invoice.jpg',			
														'remarks'         		=> $remarks,
														'start_date'         	=> time(),		
														'created_at'            => time(),
														'modified_at'           => time()
													];

												   $query = $this->db->insert('ledger', $ledger_clr_ref1);														
												}	//End of DB update					
											}		 //End of Next Ref ID Not Available
										
				
/*********             Referrals Commision for Level 4                    *********/
	if( $next_cl_ref4!= 0)     ////Next refferal is Available? Proceed
		{
		$table_name = "users";
		$where_array = array('referral_code' =>$next_cl_ref4, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id4 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_cl_ref5  =  $row->referredByCode;   //Next refferall chain
		
				if($ref_id4!= 0)
				{		
				if ($clt_ref_per_level4 != '0')
				   {	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
						$ref_account_no = singleDbTableRow($ref_id4)->account_no;
						//Get Individual Account transactions Id
						
						$acct_user 		= $ref_id4;		
						$result_count  	= $this->product_model->get_tran_count($acct_user);		
						if($result_count -> num_rows() > 0) 
						{	foreach ($result_count->result() as $r)
							{       $value 		= $r->tran_count;  					
									$tran_count = $value + 1;				
							}							
						}
						//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id4;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level4;
		
						$accounts_clr_ref4 = [
							'user_id'      			=> $ref_id4,          //To the Recieving Partner  
							'account_no'         	=> $ref_account_no,
							'rolename'  			    => $rolename,
							'email'					=> $email,
							'paid_to'         		=> $paid_to,       //From the Money sender user 
							'tranx_id'         		=> $text2,
							'credit'         		=> '0',
							'debit'         		=> $clt_ref_per_level4,
							'amount'         		=> $user_amount,	
							'points_mode'           => $clt_ref_pm,	
							'tran_count'			=> $tran_count,	
							'used'					=> 'no',
							'pay_type'				=> $deduction_paytype, //$invoice_id,		
							'created_at'            => time(),
							'modified_at'           => time()
					];

					$this->db->insert('accounts', $accounts_clr_ref4);

					$sms_user = $ref_id3;								
					$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
					$sms_total = $clt_ref_per_level3;
					$pm_wallet = $clt_ref_pm;
					$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref4 = [
									'user_id'         		=> $ref_id4,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level4,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level4, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);					
					}	//End of DB update					
				}		 //End of Next Ref ID Not Available
/*********             Referrals Commision for Level 5                    *********/
				if( $next_cl_ref5!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_cl_ref5, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id5 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
							//	$next_cl_ref4  =  $row->referredByCode;   //No  Next refferall chain
						
							if($ref_id5!= 0)
							{		
									if ($clt_ref_per_level5 != '0')
									{
									$text2 = 'Referrals Business loyalty for Invoice ID-'.$invoice_id;
									$ref_account_no = singleDbTableRow($ref_id5)->account_no;
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id5;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id5;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level5;

		
										$accounts_clr_ref5 = [
											'user_id'      			=> $ref_id5,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $clt_ref_per_level5,
											'amount'         		=> $user_amount,	
											'points_mode'           => $clt_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_clr_ref5); 	
									
									$sms_user = $ref_id5;								
									$tran = '1'; // "1" if 'Credit' == 0 & no amount value -OR- "0" if 'debit' == 0 & no amount value 							
									$sms_total = $clt_ref_per_level5;
									$pm_wallet = $clt_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
					
					
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref5 = [
									'user_id'         		=> $ref_id5,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level5,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level5, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
									}		
							}
	
						}
	
					}
					}
				}
				}
			}
			}
		}
	}
	
	
	
/*************************End of Client Ref Profit sharing***************************************/	


	
/***************************************************************************************
Business/Payspecification Commision for the Transaction Turnover

*********/
//Final Balance update	
		//$led_rulets2 = ($wallet_balance + $commission);
		
		

      		}    
		
//**********************************************************************************************************//
        //Determine if invoice insert success
        if($insertInvoice)
        {

           /**
                     * Send Email to customer Now
                     */



            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;" colspan="4">Total Price</td>
                        <td style="padding:5px;text-align:center;">'.$total_price.'</td>
                    </tr>';

            $email_data = [
                'userData'     => $customer_info,
                'tableRow'      => $HTMLrow
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');
            $subject = 'Hi '.user_full_name($customer_info).', your Transaction details @'.date('d-m-Y h:i a');
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($customer_info->email);
          //  $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('product_sell_email_tpl',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
            //Email END:



            return $invoice_id;
        }
        
		
}


}
//else{

            //set error message and go back
 //           setFlashGoBack('errorMsg', 'This Transaction Is Already Processed...!!!');
       
}
}

}
/***BBBB*/
public function electricity_payee_transfer($id){
	
	$otp_data = $this->db->get_where('billpay_request', ['id' => $id]);
		foreach($otp_data->result() as $otp);
		
		{
			
			$paying_to  		= $otp->pay_to;		//Paying To Consumer ID
			$amount	    		= $otp->amount;		//Paying Amount	
			$paid_by			= $otp->pay_by;		//Paying By Consumer ID			
			$pay_type   		= $otp->pay_type;   //Pay Specification
			$tranx_id   		= $otp->tranx_id;
			$table_otp	   		= $otp->otp;
			$transaction_type 	= $otp->type;
			$active				= $otp->active;	
			$recharge_no 		= $otp->recharge_no;
			$operator_type 		= $otp->operator_type;
	     	$service_category   = $otp->service_category;
			
			
			
		$user_otp = $this->input->post('otp');
//Very Important changing parties for send/receive based on Radio button selection		

			$pay_by = $paid_by;
			$pay_to = $paying_to;
		
//Checking OTP Authentication for the Transactions				
		if ($table_otp == $user_otp and $active == '0')
	{
/*-----------------------------------------------------------------------------------------------------*/		
		//$status = $this->billpay_model->process_recharge($pay_by, $user_otp);
		 
		 
			
		$myorderid = substr(number_format(time() * rand(),0,'',''),0,15);
		$opt = $operator_type; //$_POST['opt'];
		$mobile = $recharge_no; //$_POST['mobile'];
		$amount = $amount; //$_POST['amount'];
		
			$format='json';
			
		if ($pay_type == "70")
	//	if ($service_category == "recharge prepaid")
		{ 
		//	$mode='0';
		//	$key ='7add0404e7a711e6b49e04014a243c01';
			 // $key ='897158551373092';  //jolo
		//	$format='json';
			
					$ch = curl_init();
		            $timeout = 10; // set to zero for no timeout
					$std_code = '';
					$key ='ff705116ac2011e6b4bd04014a243c01';
					$format='json';
					$myurl=file_get_contents('https://request.apihit.com/v2/bill-pay?key='.$key.'&operator='.$opt.'&amount='.$amount.'&country=91&number='.$mobile.'- &format='.$format);
				
					
	$json = json_decode($myurl, true);
		$status=$json['status'];
			
			
					
	
$dt=date('Y-m-d h:m:i');

if ($status == 'SUCCESS' )  //die('Please Re-check the number details again and Try After 2 minutes...!');		
{		

		$new_satus 			 =  $json['status']; 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];  
		$new_operator 		 = $json['operator']; 
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'Recharge Successful';// $json['message'];
		$new_time 			 = $dt;
		$new_error_code 	 =  $json['error_code'];	
	
	}elseif($status == 'FAILED')
{		$new_satus 			 = $status; 		 
		$new_txnid 			 = 'NA'; 
		$new_usertxn 		 = 'NA'; 
		$new_operator_ref 	 = 'NA'; 
		$new_operator 		 = $opt; 
		$new_country		 = 'NA'; 
		$new_number 		 = $mobile; 
		$new_amount 		 = $amount; 
		$new_amount_deducted = 'NA'; 
		$new_message 		 = 'Not Recharged';// $json['message'];
		$new_time 			 = $dt;
		$new_error_code 	 = $json['error_code']; 	
	
}elseif($status == 'PENDING')
{		$new_satus 			 =  $json['status']; 	 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];   
		$new_operator 		 = $json['operator'];
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'Pending';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';
		
} elseif($status == 'REVERSED')
{		$new_satus 			 =  $json['status']; 	 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];   
		$new_operator 		 = $json['operator'];
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'REVERSED';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';
} elseif($status == 'DISPUTE')
{		$new_satus 			 =  $json['status']; 	 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];   
		$new_operator 		 = $json['operator'];
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'DISPUTE';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';	
	
}

		
	   $billstatus = $this->billpay_model->billstatus($new_satus, $new_txnid, $new_usertxn, $new_operator_ref, $new_operator, $new_country, $new_number, $new_amount, $new_amount_deducted, $new_message,$new_time ,$new_error_code );
			
			

			
/*-----------------------------------------------------------------------------------------------------*/        
	if($status == 'SUCCESS' ) //or $status == 'PENDING')
		
	{
		$proceed = '01';
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
			
			$table_name = "users";			
			$where_array = array('referral_code' => $pay_to);      //Sponsorship fees Paying User 'pay_to'
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$pay_to_userID		  = $r->id;
					$pay_to_first_name    = $r->first_name;
					$pay_to_last_name     = $r->last_name;             
				    $pay_to_email         = $r->email;
					$pay_to_dob			  = $r->date_of_birth;
					$pay_to_adhaar_no     = $r->adhaar_no;
					$pay_to_account_no    = $r->account_no;
					$pay_to_rolename      = $r->rolename;
				    $pay_to_country       = $r->country;
				    $pay_to_country_id    = $r->country_id;			
					$pay_to_photoName     = $r->photo;
				}
			}
		
       $c_id = $pay_to_userID;
	   
       $customer_info = singleDbTableRow($c_id);

        
        //get customer referral Code
        $customer_referral_id = $customer_info->referral_code;
		$rolename 	  		  = $customer_info->rolename; //User type
		
        $customer_id = $customer_info->id;
		$account_no  = $customer_info->account_no;
		$role 		 = $customer_info->role;	
		
		
/****To create Invoice for Transactions*/

        //Get ID From currently logged in User
        $sales_by = $this->session->userdata('logged_user')['user_id'];
	
        $qty 			= '1'; 		//$this->input->post('qty');
        $productName 	= $tranx_id; //'Test Remarks' ; //$this->input->post('productName');
        $categories 	= $pay_type; //$this->input->post('categories');
        $itemCost 		= $amount; 	//$this->input->post('amount');

        $totalProduct = '1'; //count($qty);
		$itemPrice =  $itemCost  ;
		
        $invoiceData = [
            'total_product'         => $totalProduct,
			//'total_price'           => $itemPrice,			
            'customer_id'           => $customer_id,
            'customer_referral_id'  => $customer_referral_id,
            'sales_by'              => $pay_by_userID, //$sales_by,
            'created_at'            => time(),
            'modified_at'           => time(),
        ];

        $insertInvoice = $this->db->insert('invoice', $invoiceData);

        $invoice_id = $this->db->insert_id();

        // Get Each sales Item and insert to sales_item table

        $HTMLrow = '';

        for($i = 0; $i < $totalProduct; $i++)
        {
            $quantity = $qty[$i];


	        $categoryID 	= $categories;   	//payspecification ID
		    $product_name	= $productName;
            $price 			= $amount; 				//$itemPrice[$i] * $quantity;
            $total_price 	= $amount; 		//$price;


			$acct_id1 		= $pay_type; //$this->input->post('sub_account');
			$seller_info 	= $this->session->userdata('logged_user');
			$sellerID	 	= $pay_by_userID	; // 	$sales_by;
			$seller_role	= singleDbTableRow($sellerID)->rolename;
			
			$client_id 		= $pay_to_userID;
			$client_info 	= singleDbTableRow($client_id, 'users') ;		
						
			$client_role = $client_info->rolename;			
			
			$acct_id = $acct_id1;
			
		$commission_per1 = '0'; //$r->commission;
		$benefits_per1 = '0'; //$r->benefits;
			
			/*************************************************************************************/
            $sales_itemData = [
                'category_id'   => $acct_id,
                'product_name'  => $product_name,
                'invoice_id'    => $invoice_id,
                'qty'           => $quantity,
                'item_price'    => $price, //$itemPrice[$i],
                'price'         => $price,
				'commission'    => $commission_per1, //$commission,				
                'benefits'      => $benefits_per1,
                'created_at'    => time(),
                'modified_at'   => time(),
            ];

            $sales_itemInsert = $this->db->insert('sales_item', $sales_itemData);

			
            //HTML For Email
            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;">'.'1'.'</td>
                        <td style="padding:5px;text-align:center;">'.$product_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$amount.'</td>
                        <td style="padding:5px;text-align:center;">'.$quantity.'</td>
                        <td style="padding:5px;text-align:center;">'.$price.'</td>
                    </tr>';


        }
        //Anand Code starts here Section for Commision & Benefits
/**********************
 Table update Response To the Recieving Partner from the Money sender user
*************************/
		 $total_price = $amount; // array_sum($total_price);
			
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$sales_role =  $user['role'];	
		
		$referral_code = singleDbTableRow($pay_by_userID)->referral_code;
		$first_name1 = singleDbTableRow($pay_by_userID)->first_name;
		
		$c_account_no = singleDbTableRow($pay_to_userID)->account_no;
		
		$wallet_balance = $this->input->post('wallet_balance');
		
	
//Benefits details To the Recieving Partner for data retrival 

       // S E N D E R
//pay_by_userID is Seller/Current User who is sending money
		$pm_wallet 	   = 'wallet';		
		$acct_id 	   = $pay_type; //$this->input->post('sub_account');			
		$user_info 	   = $this->session->userdata('logged_user');
        $user_id 	   = $pay_by_userID;
		$email 		   = singleDbTableRow($pay_by_userID)->email;
		$currentUser   = singleDbTableRow($pay_by_userID)->role;
		$sel_ref_code  = singleDbTableRow($pay_by_userID)->referral_code;
		$sel_ref_by    = singleDbTableRow($pay_by_userID)->referredByCode;   //Key field to get 5 level Network
		$seller_role   = singleDbTableRow($pay_by_userID)->rolename;		
		
		$seller_rolename   = typeDbTableRow($seller_role)->rolename;     //Role Description
		$seller_account_no = singleDbTableRow($pay_by_userID)->account_no;	
		$seller_email      = singleDbTableRow($pay_by_userID)->email;	
		
		
		
		
		// R E C I E V E R
//pay_to_userID is Client/Beneficiary User	who is reciving money
		$client_id 		 = $pay_to_userID;
		$client_role  	 = singleDbTableRow($pay_to_userID)->rolename;	  // Role ID		
		$client_rolename = typeDbTableRow($client_role)->rolename;    //Role Description
		$client_email    = singleDbTableRow($pay_to_userID)->email;	
		$client_name  	 = singleDbTableRow($pay_to_userID)->first_name;	
		$clt_ref_code 	 = singleDbTableRow($pay_to_userID)->referral_code;	
		$clt_ref_by   	 = singleDbTableRow($pay_to_userID)->referredByCode; //Key field to get 5 level Network
		$agreed_per 	 = '0';
		$agreed_per      = singleDbTableRow($pay_to_userID)->agreed_per;
		
		
	// Insert data for Accounts-VPA debit "To the Recieving Partner"	
		$tranx_id1 		  = 'Paid by '.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id;

//Get Individual Account transactions series Id	
$acct_user 		= $c_id;
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 
{	foreach ($result_count->result() as $r)
	{       $value 		= $r->tran_count;  	
		    $tran_count = $value + 1;	
	}			
}if ($tran_count == null)
{	$tran_count = '1';}

//End of Individual Account transactions Id	
/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $c_id;
		$user_amount    = 0;
		$points_mode 	= $pm_wallet;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $total_price;
		
		
	
	//Recieving/Client/passive user
	   $accounts1 = [
            'user_id'      			=> $c_id,        //To the Recieving Partner  
			'email'         	    => $client_email,
			'account_no'         	=> $c_account_no,
            'rolename'  		    => $client_role,
			'paid_to'         		=> $user_id,      //From the Money sender user 
            'pay_type'         		=> $acct_id,      //Payspecification ID
			'debit'         		=> $total_price,
			'credit'         		=> '0',
			'amount'         		=> $user_amount, //$total_price,						
			'tranx_id'				=> $tranx_id1,
			'points_mode'           => $pm_wallet,
			'tran_count'			=> $tran_count,
			'used'					=> 'yes',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

	$this->db->insert('accounts', $accounts1);


	$tran = '1'; // 0- Credit 1- debit
	$sms_user = $c_id;
	$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
	
		
	//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
  
	$remarks1 = 'Ledger Update: Paid by'.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id;
		$ledger1 = [
            'user_id'         		=> $c_id,             	//To the Recieving Partner  
			'pay_type'				=> $acct_id, 			//Deduction Pay Specification	
			'account_no'         	=> $c_account_no,		//Member Account No
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
			'debit'         		=> $total_price,
			'credit'         		=> '0',
			'amount'         		=> $total_price,	
			'points_mode'           => $pm_wallet,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks1,             //Description
			'count'					=> 'yes',
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $this->db->insert('ledger', $ledger1);	
		
	
		
		$tranx_id2 = "Paid to '".$client_rolename.'-'.$client_name."' for the Invoice ID-".$invoice_id;
		
	//Sender/Seller/Active user
	
	
								$user_debit  	= $this->product_model->total_debit($userID, $points_mode);
								$user_credit  	= $this->product_model->total_credit($userID, $points_mode);
							
		
//Get Individual Account transactions Id
	
$acct_user 		= $user_id;		
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 
{	foreach ($result_count->result() as $r)
	{       $value 		= $r->tran_count;  					
			$tran_count = $value + 1;				
	}							
}
//End of Individual Account transactions Id	
		
/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $user_id;
		$user_amount    = 0;
		$points_mode 	= $pm_wallet;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $total_price;
		
	   $accounts2 = [
            'user_id'      			=> $user_id,        //From the Money sender user
			'email'         	    => $seller_email,
			'account_no'         	=> $seller_account_no,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,      // To the Recieving Partner  
            'pay_type'         		=> $acct_id,      //Payspecification ID
			'debit'         		=> '0',
			'credit'         		=> $total_price,
			'amount'         		=> $user_amount, //$total_price,						
			'tranx_id'				=> $tranx_id2,
			'points_mode'           => $pm_wallet,
			'tran_count'			=> $tran_count,
			'used'					=> 'yes',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

         $this->db->insert('accounts', $accounts2);
		
			$tran = '0'; // 0- Credit 1- debit
			$sms_user = $user_id;
			$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
			
	
	
		//Except Agent and Customer, recording rest of the transactions to Ledger
	if ($currentUser = 'admin' )	
	{   
		$remarks2 = "Ledger Update: Paid to '".$client_rolename.'-'.$client_name."' for the Invoice ID-".$invoice_id;
		$ledger2 = [
            'user_id'         		=> $user_id,             	//To the Recieving Partner  
			'pay_type'				=> $acct_id, 			    //Deduction Pay Specification	
			'account_no'         	=> $seller_account_no,		//Member Account No
			'email'					=> $seller_email,
			'rolename'  			=> $seller_role,
            'credit'         		=> $total_price,
			'debit'         		=> '0', 	
			'amount'         		=> $total_price, 
			'points_mode'           => 'wallet',
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks2,             //Description
			'count'					=> 'no',
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $this->db->insert('ledger', $ledger2);	
		
	}
	
/***********************************************************************************************/	
/* Updating OTP table as Data Processed													   */
/* 																							   */
/*																							   */
/***********************************************************************************************/
			 $data9 = [
           	'active'            => '1',            
            'modified_at'       => time()
        ];

       $query9 = $this->db->where('id', $id)->update('billpay_request', $data9);	
	   
/******Automatically Payspecification will be Identified and calculates the Percentage**************/	

		$table_name = "commissions";
			$where_array = array('sub_acct_id' =>$acct_id, 'from_role' =>$seller_role, 'to_role' =>$client_role, 'identity' =>'Commission');
			$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
		$points_mode    = $row->points_mode;
		$benefits_per   = $row->benefits;         
		$commission_per = $row->commission;      //Debit to Payspecification
		
		$deduction_paytype = $row->ded_paytype;		
		
		$profit_pm    	  = $row->profit_pm;
		$seller_profit    = $row->sender_profit;
		$client_profit    = $row->receiver_profit;
		
		$deduction_pm  	 = $row->deduction_pm;
		$seller_deduction = $row->sender_deduction;
		
		 if ($client_role == '13' && $agreed_per > 0 )
		 {
			 $client_deduction = $agreed_per;
		 }else{
			 $client_deduction = $row->receiver_deduction;
		 }
		
	//----------------------------------------------------------------------------------------------//
//*************************************//Profit to 'Seller'
		
        $seller_info = singleDbTableRow($pay_by_userID);
		$seller_account_no = $seller_info->account_no;  // $customer_info->referral_code;  
		$seller_benefits = (($total_price * $seller_profit) / '100' ) ; //Percentage value for Seller
		//Seller Loyality
		if ($seller_benefits != '0')
		{   $text5 = $seller_rolename.'- commission for Invoice ID-'.$invoice_id;
	
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_by_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_by_userID;
		$user_amount    = 0;
		$points_mode 	= $profit_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $seller_benefits;

										
	   $accounts5 = [
            'user_id'      			=> $pay_by_userID,          //From the Money sender user
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,           // To the Recieving Partner  
            'tranx_id'         		=> $text5,  	  //$pay_type,
			'credit'         		=> '0',
			'debit'         		=> $seller_benefits,
			'amount'         		=> $user_amount,	
			'points_mode'           => $profit_pm,
			'tran_count'			=> $tran_count,				
			'used'					=> 'no',
			'pay_type'				=> $acct_id,         //Debit from Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts5); 
		
		$sms_user = $pay_by_userID;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
		$sms_total = $seller_benefits;
		$pm_wallet = $profit_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );

						
		//Deduction of commission from Ledger Table with Respective Payspecification and passing the
		//same value to the respective Benefitiary
		   $remarks6 = $seller_rolename.'- commission for Invoice ID-'.$invoice_id;
        $data6 = [
            'user_id'         		=> $pay_by_userID,              //From the Money sender user
			'pay_type'				=> $deduction_paytype,   //Deduction from Pay Specification	
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
			'rolename'  			=> $seller_role,
            'credit'         		=> $seller_benefits,
			'debit'         		=> '0', 	
			'amount'         		=> $seller_benefits, 
			'points_mode'           => $profit_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks6,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data6);
		}
//----------------------------------------------------------------------------------------------//
//*************************************//Profit to 'Client'
	
	
	
	
	
	
//$deduction_paytype for Deduction
		$ded_payspec1 = "Commission Deducted from Pay Spec No -". $deduction_paytype ;
					
		
		$client_benefits = (($total_price * $client_profit) / '100' ) ; //Percentage value for Client
	if ($client_benefits != '0')	
	{	$tranx_id3 = $client_rolename.'- commission for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_to_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_to_userID;
		$user_amount    = 0;
		$points_mode 	= $profit_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $client_benefits;
		
	   $accounts3 = [
            'user_id'      			=> $pay_to_userID,          //To the Recieving Partner  
			'account_no'         	=> $c_account_no,
            'rolename'  			=> $client_role,
			'email'					=> $client_email,
			'paid_to'         		=> $userID,       //From the Money sender user 
            'tranx_id'         		=> $tranx_id3,
			'credit'         		=> '0',
			'debit'         		=> $client_benefits,
			'amount'         		=> $user_amount,	
			'points_mode'           => $profit_pm,	
			'tran_count'			=> $tran_count,
			'used'					=> 'no',
		    'pay_type'				=> $acct_id,         //Debit from Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts3); 
		$sms_user = $c_id;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
		$sms_total = $client_benefits;
		$pm_wallet = $profit_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
		
	//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
			$remarks4 = $client_rolename.'- commission for Invoice ID -'.$invoice_id; 
        $data4 = [
            'user_id'         		=> $pay_to_userID,             		//To the Recieving Partner  
			'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
			'account_no'         	=> $c_account_no,			//Member Account No
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
            'credit'         		=> $client_benefits,
			'debit'         		=> '0', 	
			'amount'         		=> $client_benefits, 
			'points_mode'           => $profit_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks4,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data4);
	}
//----------------------------------------------------------------------------------------------//	 
//*****************************/Commission from 'Sender'





        $seller_info = singleDbTableRow($pay_by_userID);
		$seller_account_no = $seller_info->account_no;  // $customer_info->referral_code;  
		$seller_commission = '0';
		$seller_commission = (($total_price * $seller_deduction) / '100' ) ; //Percentage value for Seller
	if($seller_commission  != '0')	
	{	//Seller Loyality
	   $text9 = 'Commission deducted from -'.$seller_rolename.'-for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_by_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_by_userID;
		$user_amount    = 0;
		$points_mode 	= $deduction_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $seller_commission;
		
	   $accounts9 = [
            'user_id'      			=> $pay_by_userID,          //From the Money sender user
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,           // To the Recieving Partner  
            'tranx_id'         		=> $text9,  	 
			'debit'         		=> '0',
			'credit'         		=> $seller_commission,
			'amount'         		=> $user_amount,	
			'points_mode'           => $deduction_pm,	
			'tran_count'			=> $tran_count,	
			'used'					=> 'yes',
			'pay_type'				=> $acct_id,		 //Deposit Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts9); 
		$sms_user = $pay_by_userID;								
		$tran = '0'; // "1" if 'Credit' == 0 & no amount value      -OR-                  *  "0" if 'debit' == 0 & no amount value 							
		$sms_total = $seller_commission;
		$pm_wallet = $deduction_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
						
		//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
		  $remarks10 = 'Commission deduction from -'.$seller_rolename.'-for Invoice ID -'.$invoice_id; 
        $data10 = [
            'user_id'         		=> $pay_by_userID,              //From the Money sender user
			'pay_type'				=> $acct_id,   //Deposit Pay Specification	
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
			'rolename' 			    => $seller_role,
            'debit'         		=> $seller_commission,
			'credit'         		=> '0', 	
			'amount'         		=> $seller_commission, 
			'points_mode'           => $deduction_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks10,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data10);	
	}	   
//----------------------------------------------------------------------------------------------//
//*****************************/Commission from 'Client' 





		$ded_payspec1 = "Benefits Deducted from Pay Spec No -". $acct_id ;
					
		$client_commission = '0';
		$client_commission = (($total_price * $client_deduction) / '100' ) ; //Percentage value for Client
		
	if($client_commission != '0')
	{	$tranx_id7 = 'Commission deduction from -'.$client_rolename.'-for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_to_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $pay_to_userID;
		$user_amount    = 0;
		$points_mode 	= $deduction_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $client_commission;
		
	   $accounts7 = [
            'user_id'      			=> $pay_to_userID,          //To the Recieving Partner  
			'account_no'         	=> $c_account_no,
            'rolename'  			=> $client_role,
			'email'					=> $client_email,
			'paid_to'         		=> $userID,       //From the Money sender user 
            'tranx_id'         		=> $tranx_id7,
			'debit'         		=> '0',
			'credit'         		=> $client_commission,
			'amount'         		=> $user_amount,	
			'points_mode'           => $deduction_pm,	
			'tran_count'			=> $tran_count,	
			'used'					=> 'yes',
		    'pay_type'				=> $acct_id, //Deposit Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts7); 
		$sms_user = $pay_to_userID;								
		$tran = '0'; // "1" if 'Credit' == 0 & no amount value      -OR-                  *  "0" if 'debit' == 0 & no amount value 							
		$sms_total = $client_commission;
		$pm_wallet = $deduction_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
			$remarks8 = 'Commission deduction from -'.$client_rolename.'-for Invoice ID -'.$invoice_id; 	
        $data8 = [
            'user_id'         		=> $pay_to_userID,             	 //To the Recieving Partner  
			'pay_type'				=> $acct_id, 			 //Deposit Pay Specification	
			'account_no'         	=> $c_account_no,
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
            'debit'         		=> $client_commission,
			'credit'         		=> '0', 	
			'amount'         		=> $client_commission, 
			'points_mode'           => $deduction_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks8,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data8);	


	}	
		$slr_ref_pm  	 = $row->slr_ref_pm;	
		$slr_ref_level1  = $row->slr_ref_level1;		
		$slr_ref_level2  = $row->slr_ref_level2;	
		$slr_ref_level3  = $row->slr_ref_level3;	
		$slr_ref_level4  = $row->slr_ref_level4;	
		$slr_ref_level5  = $row->slr_ref_level5;	
		
		$clt_ref_pm  	 = $row->clt_ref_pm;	
		$clt_ref_level1  = $row->clt_ref_level1;
		$clt_ref_level2  = $row->clt_ref_level2;	
		$clt_ref_level3  = $row->clt_ref_level3;	
		$clt_ref_level4  = $row->clt_ref_level4;	
		$clt_ref_level5  = $row->clt_ref_level5;
				
				
//Function to do multiple activity				
				
		$slr_ref_per_level1  = (($total_price * $slr_ref_level1) / '100' ) ; //Percentage value for slr_ref_level1	
		$slr_ref_per_level2  = (($total_price * $slr_ref_level2) / '100' ) ; //Percentage value for slr_ref_level2	
		$slr_ref_per_level3  = (($total_price * $slr_ref_level3) / '100' ) ; //Percentage value for slr_ref_level3	
		$slr_ref_per_level4  = (($total_price * $slr_ref_level4) / '100' ) ; //Percentage value for slr_ref_level4	
		$slr_ref_per_level5  = (($total_price * $slr_ref_level5) / '100' ) ; //Percentage value for slr_ref_level5	

		$clt_ref_per_level1  = (($total_price * $clt_ref_level1) / '100' ) ; //Percentage value for clt_ref_level1			
		$clt_ref_per_level2  = (($total_price * $clt_ref_level2) / '100' ) ; //Percentage value for clt_ref_level2			
		$clt_ref_per_level3  = (($total_price * $clt_ref_level3) / '100' ) ; //Percentage value for clt_ref_level3			
		$clt_ref_per_level4  = (($total_price * $clt_ref_level4) / '100' ) ; //Percentage value for clt_ref_level4			
		$clt_ref_per_level5  = (($total_price * $clt_ref_level5) / '100' ) ; //Percentage value for clt_ref_level5			


/*********   Begin of  'seller' Referrals Commision for Level 1        *********/

		$table_name = "users";
		$where_array = array('referral_code' =>$sel_ref_by, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id1 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_sl_ref2  =  $row->referredByCode;           // Next referral chain
				
				if($ref_id1!= 0)
				{
		   			if ($slr_ref_per_level1 != '0')
						{
								$text1 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ref_account_no = singleDbTableRow($ref_id1)->account_no;
								
								//Update Debit balance
								$userID = $ref_id1;	$user_amount = '0';	
								$points_mode = $slr_ref_pm;
								$user_debit  	= $this->product_model->total_debit($userID, $points_mode);
								$user_credit  	= $this->product_model->total_credit($userID, $points_mode);
								$user_balance = '0'; //$user_debit - $user_credit;
								$user_amount = $user_balance + $slr_ref_per_level1;
								
								//Get Individual Account transactions Id
								
								$acct_user 		= $ref_id1;		
								$result_count  	= $this->product_model->get_tran_count($acct_user);		
								if($result_count -> num_rows() > 0) 
								{	foreach ($result_count->result() as $r)
									{       $value 		= $r->tran_count;  					
											$tran_count = $value + 1;				
									}							
								}
								//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id1;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level1;
								$accounts_ref1 = [
									'user_id'      			=> $ref_id1,          //To the Recieving Partner  
									'account_no'         	=> $ref_account_no,									
									'rolename'  			=> $rolename,
									'email'					=> $email,
									'paid_to'         		=> $paid_to,       //From the Money sender user 
									'tranx_id'         		=> $text1,
									'credit'         		=> '0',
									'debit'         		=> $slr_ref_per_level1,
									'amount'         		=> $user_amount, //$slr_ref_per_level1,	
									'points_mode'           => $slr_ref_pm,	
									'tran_count'			=> $tran_count,	
									'used'					=> 'no',
									'pay_type'				=> $deduction_paytype, //$invoice_id,		
									'created_at'            => time(),
									'modified_at'           => time()
								];

								$this->db->insert('accounts', $accounts_ref1); 
								
								$sms_user = $ref_id1;								
								$tran = '1'; // 1 if 'Credit' == 0 and 0 if 'debit' == 0								
								$sms_total = $slr_ref_per_level1;
								$pm_wallet = $slr_ref_pm;
								$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
								
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ledger_ref1 = [
									'user_id'         		=> $ref_id1,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level1,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level1, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref1);
						}
				}
		
	/*********             Referrals Commision for Level 2                    *********/
					if( $next_sl_ref2!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_sl_ref2, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id2 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
								$next_sl_ref3  =  $row->referredByCode;   //Next referral chain
						     if($ref_id2!= 0)
								{
									if ($slr_ref_per_level2 != '0')
									{
										$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
										$ref_account_no = singleDbTableRow($ref_id2)->account_no;
										
									
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id2;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id2;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level2;
										$accounts_ref2 = [
											'user_id'      			=> $ref_id2,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $slr_ref_per_level2,
											'amount'         		=> $user_amount, //$slr_ref_per_level2,	
											'points_mode'           => $slr_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_ref2); 	
									
									$sms_user = $ref_id2;								
									$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
									$sms_total = $slr_ref_per_level2;
									$pm_wallet = $slr_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
									
									
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;
									$ledger_ref2 = [
									'user_id'         		=> $ref_id2,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level2,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level2, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref2);
									}
						        }
						
/*********             Referrals Commision for Level 3                    *********/
								if( $next_sl_ref3!= 0)     ////Next refferal is Available? Proceed
								{
										$table_name = "users";
											$where_array = array('referral_code' =>$next_sl_ref3, 'active' => '1');
											$query = $this->db->where($where_array )->get($table_name); 
											foreach ($query->result() as $row)
											{	
													$ref_id3 	= $row->id;		
													$rolename	= $row->rolename;
													$email      = $row->email;
													$paid_to	= $row->id;
													$next_sl_ref4  =  $row->referredByCode;   //Next refferall chain
												if($ref_id3!= 0)
												{
												if ($slr_ref_per_level3 != '0')
												{	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
													$ref_account_no = singleDbTableRow($ref_id3)->account_no;
													
													//Get Individual Account transactions Id
													
													$acct_user 		= $ref_id3;		
													$result_count  	= $this->product_model->get_tran_count($acct_user);		
													if($result_count -> num_rows() > 0) 
													{	foreach ($result_count->result() as $r)
														{       $value 		= $r->tran_count;  					
																$tran_count = $value + 1;				
														}							
													}
													//End of Individual Account transactions Id	
		

		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id3;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level3;
													$accounts_ref3 = [
														'user_id'      			=> $ref_id3,          //To the Recieving Part	ner  
														'account_no'         	=> $ref_account_no,
														'rolename'  			=> $rolename,
														'email'					=> $email,
														'paid_to'         		=> $paid_to,       //From the Money sender 	user 
														'tranx_id'         		=> $text2,
														'credit'         		=>	 '0',
														'debit'         		=> $slr_ref_per_level3,
														'amount'         		=> $user_amount, //$slr_ref_per_level3,	
														'points_mode'           => $slr_ref_pm,
														'tran_count'			=> $tran_count,															
														'used'					=> 	'no',
														'pay_type'				=> $deduction_paytype, //$invoice_	id,		
														'created_at'            => time(),
														'modified_at'           => time()
													];

														$this->db->insert('accounts', $accounts_ref3); 
														$sms_user = $ref_id3;								
														$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
														$sms_total = $slr_ref_per_level3;
														$pm_wallet = $slr_ref_pm;
														$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
														$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
													$ledger_ref3 = [
														'user_id'         		=> $ref_id3,             		//To the Recieving Partner  
														'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
														'account_no'         	=> $ref_account_no,			//Member Account No
														'email'					=> $email,
														'rolename'  			=> $rolename,
														'credit'         		=> $slr_ref_per_level3,
														'debit'         		=> '0', 	
														'amount'         		=> $slr_ref_per_level3, 
														'points_mode'           => $slr_ref_pm,
														'invoice_id '  			=> $invoice_id,		
														'challan' 				=> 'no_invoice.jpg',			
														'remarks'         		=> $remarks,
														'start_date'         	=> time(),		
														'created_at'            => time(),
														'modified_at'           => time()
													];

												   $query = $this->db->insert('ledger', $ledger_ref1);
												}	//End of DB update					
											}		 //End of Next Ref ID Not Available
										
				
/*********             Referrals Commision for Level 4                    *********/
	if( $next_sl_ref4!= 0)     ////Next refferal is Available? Proceed
		{
		$table_name = "users";
		$where_array = array('referral_code' =>$next_sl_ref4, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id4 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_sl_ref5  =  $row->referredByCode;   //Next refferall chain
		
				if($ref_id4!= 0)
				{		
				if ($slr_ref_per_level4 != '0')
				   {	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
						$ref_account_no = singleDbTableRow($ref_id4)->account_no;
						//Get Individual Account transactions Id
						
						$acct_user 		= $ref_id4;		
						$result_count  	= $this->product_model->get_tran_count($acct_user);		
						if($result_count -> num_rows() > 0) 
						{	foreach ($result_count->result() as $r)
							{       $value 		= $r->tran_count;  					
									$tran_count = $value + 1;				
							}							
						}
						//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id4;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level4;
		
						$accounts_ref4 = [
							'user_id'      			=> $ref_id4,          //To the Recieving Partner  
							'account_no'         	=> $ref_account_no,
							'rolename'  			    => $rolename,
							'email'					=> $email,
							'paid_to'         		=> $paid_to,       //From the Money sender user 
							'tranx_id'         		=> $text2,
							'credit'         		=> '0',
							'debit'         		=> $slr_ref_per_level4,
							'amount'         		=> $user_amount,	
							'points_mode'           => $slr_ref_pm,	
							'tran_count'			=> $tran_count,	
							'used'					=> 'no',
							'pay_type'				=> $deduction_paytype, //$invoice_id,		
							'created_at'            => time(),
							'modified_at'           => time()
					];

					$this->db->insert('accounts', $accounts_ref4); 	

					$sms_user = $ref_id4;								
					$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
					$sms_total = $slr_ref_per_level4;
					$pm_wallet = $slr_ref_pm;
					$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
					$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
												
					$ledger_ref4 = [
									'user_id'         		=> $ref_id4,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level4,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level4, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref4);
					}	//End of DB update					
				}		 //End of Next Ref ID Not Available
/*********             Referrals Commision for Level 5                    *********/
				if( $next_sl_ref5!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_sl_ref5, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id5 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
							//	$next_sl_ref4  =  $row->referredByCode;   //No  Next refferall chain
						
							if($ref_id5!= 0)
							{		
									if ($slr_ref_per_level5 != '0')
									{
									$text2 = 'Referrals Business loyalty for Invoice ID-'.$invoice_id;
									$ref_account_no = singleDbTableRow($ref_id5)->account_no;
									//Get Individual Account transactions Id
									
									$acct_user 		= $ref_id5;		
									$result_count  	= $this->product_model->get_tran_count($acct_user);		
									if($result_count -> num_rows() > 0) 
									{	foreach ($result_count->result() as $r)
										{       $value 		= $r->tran_count;  					
												$tran_count = $value + 1;				
										}							
									}
									//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id5;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level5;								
										$accounts_ref5 = [
											'user_id'      			=> $ref_id5,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			    => $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $slr_ref_per_level5,
											'amount'         		=> $user_amount,	
											'points_mode'           => $slr_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_ref5); 	
									$sms_user = $ref_id5;								
									$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
									$sms_total = $slr_ref_per_level5;
									$pm_wallet = $slr_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );	
									
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
					
									$ledger_ref5 = [
									'user_id'         		=> $ref_id5,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level5,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level5, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

									$query = $this->db->insert('ledger', $ledger_ref1);
									}		
							}
	
						}
	
					}
					}
				}
				}
			}
			}
		}
	}
	
/*************************End of Seller Ref Profit sharing**************************************************/




/*********          Begin of Client Ref Profit sharing Referrals Commision for Level 1             *********/

		$table_name = "users";
		$where_array = array('referral_code' =>$clt_ref_by, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id1 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_cl_ref2  =  $row->referredByCode;           // Next referral chain
				
				if($ref_id1!= 0)
				{
		   			if ($clt_ref_per_level1 != '0')
						{
								$text1 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ref_account_no = singleDbTableRow($ref_id1)->account_no;
								//Get Individual Account transactions Id
								
								$acct_user 		= $ref_id1;		
								$result_count  	= $this->product_model->get_tran_count($acct_user);		
								if($result_count -> num_rows() > 0) 
								{	foreach ($result_count->result() as $r)
									{       $value 		= $r->tran_count;  					
											$tran_count = $value + 1;				
									}							
								}
								//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id1;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level1;
		
								$accounts_clr_ref1 = [
									'user_id'      			=> $ref_id1,          //To the Recieving Partner  
									'account_no'         	=> $ref_account_no,
									'rolename'  			=> $rolename,
									'email'					=> $email,
									'paid_to'         		=> $paid_to,       //From the Money sender user 
									'tranx_id'         		=> $text1,
									'credit'         		=> '0',
									'debit'         		=> $clt_ref_per_level1,
									'amount'         		=> $user_amount,	
									'points_mode'           => $clt_ref_pm,	
									'tran_count'			=> $tran_count,	
									'used'					=> 'no',
									'pay_type'				=> $deduction_paytype, //$invoice_id,		
									'created_at'            => time(),
									'modified_at'           => time()
								];
								
					
								$this->db->insert('accounts', $accounts_clr_ref1);
								
								$sms_user = $ref_id1;								
								$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
								$sms_total = $clt_ref_per_level1;
								$pm_wallet = $clt_ref_pm;
								$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );


								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref1 = [
									'user_id'         		=> $ref_id1,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level1,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level1, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
						}
				}
		
	/*********             Referrals Commision for Level 2                    *********/
					if( $next_cl_ref2!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_cl_ref2, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id2 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
								$next_cl_ref3  =  $row->referredByCode;   //Next referral chain
						     if($ref_id2!= 0)
								{
									if ($clt_ref_per_level2 != '0')
									{
										$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
										$ref_account_no = singleDbTableRow($ref_id2)->account_no;
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id2;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id2;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level2;
		
										$accounts_clr_ref2 = [
											'user_id'      			=> $ref_id2,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $clt_ref_per_level2,
											'amount'         		=> $user_amount,	
											'points_mode'           => $clt_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_clr_ref2); 	
									
									$sms_user = $ref_id2;								
									$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
									$sms_total = $clt_ref_per_level2;
									$pm_wallet = $clt_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
								
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;									
								$ledger_clr_ref3 = [
									'user_id'         		=> $ref_id2,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level3,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level3, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
									}
						        }
						
/*********             Referrals Commision for Level 3                    *********/
								if( $next_cl_ref3!= 0)     ////Next refferal is Available? Proceed
								{
										$table_name = "users";
											$where_array = array('referral_code' =>$next_cl_ref3, 'active' => '1');
											$query = $this->db->where($where_array )->get($table_name); 
											foreach ($query->result() as $row)
											{	
													$ref_id3 	= $row->id;		
													$rolename	= $row->rolename;
													$email      = $row->email;
													$paid_to	= $row->id;
													$next_cl_ref4  =  $row->referredByCode;   //Next refferall chain
												if($ref_id3!= 0)
												{
												if ($clt_ref_per_level3 != '0')
												{	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
													$ref_account_no = singleDbTableRow($ref_id3)->account_no;
													//Get Individual Account transactions Id
													

													$acct_user 		= $ref_id3;		
													$result_count  	= $this->product_model->get_tran_count($acct_user);		
													if($result_count -> num_rows() > 0) 
													{	foreach ($result_count->result() as $r)
														{       $value 		= $r->tran_count;  					
																$tran_count = $value + 1;				
														}							
													}
													//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id3;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level3;
		
													$accounts_clr_ref3 = [
														'user_id'      			=> $ref_id3,          //To the Recieving Part	ner  
														'account_no'         	=> $ref_account_no,
														'rolename'  			=> $rolename,
														'email'					=> $email,
														'paid_to'         		=> $paid_to,       //From the Money sender 	user 
														'tranx_id'         		=> $text2,
														'credit'         		=>	 '0',
														'debit'         		=> $clt_ref_per_level3,
														'amount'         		=> $user_amount,	
														'points_mode'           => $clt_ref_pm,	
														'tran_count'			=> $tran_count,	
														'used'					=> 	'no',
														'pay_type'				=> $deduction_paytype, //$invoice_	id,		
														'created_at'            => time(),
														'modified_at'           => time()
													];

														$this->db->insert('accounts', $accounts_clr_ref3); 
														
														$sms_user = $ref_id3;								
														$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
														$sms_total = $clt_ref_per_level3;
														$pm_wallet = $clt_ref_pm;
														$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );

									
													$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;		
													$ledger_clr_ref3 = [
														'user_id'         		=> $ref_id3,             		//To the Recieving Partner  
														'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
														'account_no'         	=> $ref_account_no,			    //Member Account No
														'email'					=> $email,
														'rolename'  			=> $rolename,
														'credit'         		=> $clt_ref_per_level3,
														'debit'         		=> '0', 	
														'amount'         		=> $clt_ref_per_level3, 
														'points_mode'           => $clt_ref_pm,
														'invoice_id '  			=> $invoice_id,		
														'challan' 				=> 'no_invoice.jpg',			
														'remarks'         		=> $remarks,
														'start_date'         	=> time(),		
														'created_at'            => time(),
														'modified_at'           => time()
													];

												   $query = $this->db->insert('ledger', $ledger_clr_ref1);														
												}	//End of DB update					
											}		 //End of Next Ref ID Not Available
										
				
/*********             Referrals Commision for Level 4                    *********/
	if( $next_cl_ref4!= 0)     ////Next refferal is Available? Proceed
		{
		$table_name = "users";
		$where_array = array('referral_code' =>$next_cl_ref4, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id4 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_cl_ref5  =  $row->referredByCode;   //Next refferall chain
		
				if($ref_id4!= 0)
				{		
				if ($clt_ref_per_level4 != '0')
				   {	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
						$ref_account_no = singleDbTableRow($ref_id4)->account_no;
						//Get Individual Account transactions Id
						
						$acct_user 		= $ref_id4;		
						$result_count  	= $this->product_model->get_tran_count($acct_user);		
						if($result_count -> num_rows() > 0) 
						{	foreach ($result_count->result() as $r)
							{       $value 		= $r->tran_count;  					
									$tran_count = $value + 1;				
							}							
						}
						//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id4;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level4;
		
						$accounts_clr_ref4 = [
							'user_id'      			=> $ref_id4,          //To the Recieving Partner  
							'account_no'         	=> $ref_account_no,
							'rolename'  			    => $rolename,
							'email'					=> $email,
							'paid_to'         		=> $paid_to,       //From the Money sender user 
							'tranx_id'         		=> $text2,
							'credit'         		=> '0',
							'debit'         		=> $clt_ref_per_level4,
							'amount'         		=> $user_amount,	
							'points_mode'           => $clt_ref_pm,	
							'tran_count'			=> $tran_count,	
							'used'					=> 'no',
							'pay_type'				=> $deduction_paytype, //$invoice_id,		
							'created_at'            => time(),
							'modified_at'           => time()
					];

					$this->db->insert('accounts', $accounts_clr_ref4);

					$sms_user = $ref_id3;								
					$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
					$sms_total = $clt_ref_per_level3;
					$pm_wallet = $clt_ref_pm;
					$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref4 = [
									'user_id'         		=> $ref_id4,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level4,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level4, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);					
					}	//End of DB update					
				}		 //End of Next Ref ID Not Available
/*********             Referrals Commision for Level 5                    *********/
				if( $next_cl_ref5!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_cl_ref5, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id5 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
							//	$next_cl_ref4  =  $row->referredByCode;   //No  Next refferall chain
						
							if($ref_id5!= 0)
							{		
									if ($clt_ref_per_level5 != '0')
									{
									$text2 = 'Referrals Business loyalty for Invoice ID-'.$invoice_id;
									$ref_account_no = singleDbTableRow($ref_id5)->account_no;
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id5;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id5;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level5;

		
										$accounts_clr_ref5 = [
											'user_id'      			=> $ref_id5,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $clt_ref_per_level5,
											'amount'         		=> $user_amount,	
											'points_mode'           => $clt_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_clr_ref5); 	
									
									$sms_user = $ref_id5;								
									$tran = '1'; // "1" if 'Credit' == 0 & no amount value -OR- "0" if 'debit' == 0 & no amount value 							
									$sms_total = $clt_ref_per_level5;
									$pm_wallet = $clt_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
					
					
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref5 = [
									'user_id'         		=> $ref_id5,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level5,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level5, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
									}		
							}
	
						}
	
					}
					}
				}
				}
			}
			}
		}
	}
	
	
	
/*************************End of Client Ref Profit sharing***************************************/	


	
/***************************************************************************************
Business/Payspecification Commision for the Transaction Turnover

*********/
//Final Balance update	
		//$led_rulets2 = ($wallet_balance + $commission);
		
		

      		}    
		
//**********************************************************************************************************//
        //Determine if invoice insert success
        if($insertInvoice)
        {

           /**
                     * Send Email to customer Now
                     */



            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;" colspan="4">Total Price</td>
                        <td style="padding:5px;text-align:center;">'.$total_price.'</td>
                    </tr>';

            $email_data = [
                'userData'     => $customer_info,
                'tableRow'      => $HTMLrow
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');
            $subject = 'Hi '.user_full_name($customer_info).', your Transaction details @'.date('d-m-Y h:i a');
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($customer_info->email);
          //  $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('product_sell_email_tpl',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
            //Email END:



            return $invoice_id;
        }
        
		
}


}
//else{

            //set error message and go back
 //           setFlashGoBack('errorMsg', 'This Transaction Is Already Processed...!!!');
       
}
}

}
/**EEE**/
///////
/****************************************************************************************/
public function postpaid_payee_transfer($id){
	
	$otp_data = $this->db->get_where('billpay_request', ['id' => $id]);
		foreach($otp_data->result() as $otp);
		
		{
			
			$paying_to  		= $otp->pay_to;		//Paying To Consumer ID
			$amount	    		= $otp->amount;		//Paying Amount	
			$paid_by			= $otp->pay_by;		//Paying By Consumer ID			
			$pay_type   		= $otp->pay_type;   //Pay Specification
			$tranx_id   		= $otp->tranx_id;
			$table_otp	   		= $otp->otp;
			$transaction_type 	= $otp->type;
			$active				= $otp->active;	
			$recharge_no 		= $otp->recharge_no;
			$operator_type 		= $otp->operator_type;
	     	$service_category   = $otp->service_category;
			$post_acc_no   = $otp->account_no;
			
			
		$user_otp = $this->input->post('otp');
//Very Important changing parties for send/receive based on Radio button selection		

			$pay_by = $paid_by;
			$pay_to = $paying_to;
		
//Checking OTP Authentication for the Transactions				
		if ($table_otp == $user_otp and $active == '0')
	{
/*-----------------------------------------------------------------------------------------------------*/		
		//$status = $this->billpay_model->process_recharge($pay_by, $user_otp);
		 
		 
			
		$myorderid = substr(number_format(time() * rand(),0,'',''),0,15);
		$opt = $operator_type; //$_POST['opt'];
		$mobile = $recharge_no; //$_POST['mobile'];
		$amount = $amount; //$_POST['amount'];
		
			$format='json';
			
		if ($pay_type == "70")
	//	if ($service_category == "recharge prepaid")
		{ 
		//	$mode='0';
		//	$key ='7add0404e7a711e6b49e04014a243c01';
			 // $key ='897158551373092';  //jolo
		//	$format='json';
			
					$ch = curl_init();
		            $timeout = 10; // set to zero for no timeout
					$std_code = '';
					
					$format='json';
				$myurl=file_get_contents('https://joloapi.com/api/cbill.php?mode=1&userid=anand12345&key=897158551373092&operator=$opt&service=$mobile&amount=$amount&std=$std_code&ca=$post_acc_no&orderid=$myorderid&type=json');
					
	$json = json_decode($myurl, true);
		$status=$json['status'];
			
			
					
	
$dt=date('Y-m-d h:m:i');

if ($status == 'SUCCESS' )  //die('Please Re-check the number details again and Try After 2 minutes...!');		
{		

		$new_satus 			 =  $json['status']; 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];  
		$new_operator 		 = $json['operator']; 
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'Recharge Successful';// $json['message'];
		$new_time 			 = $dt;
		$new_error_code 	 =  $json['error_code'];	
	
	}elseif($status == 'FAILED')
{		$new_satus 			 = $status; 		 
		$new_txnid 			 = 'NA'; 
		$new_usertxn 		 = 'NA'; 
		$new_operator_ref 	 = 'NA'; 
		$new_operator 		 = $opt; 
		$new_country		 = 'NA'; 
		$new_number 		 = $mobile; 
		$new_amount 		 = $amount; 
		$new_amount_deducted = 'NA'; 
		$new_message 		 = 'Not Recharged';// $json['message'];
		$new_time 			 = $dt;
		$new_error_code 	 = $json['error_code']; 	
	
}elseif($status == 'PENDING')
{		$new_satus 			 =  $json['status']; 	 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];   
		$new_operator 		 = $json['operator'];
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'Pending';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';
		
} elseif($status == 'REVERSED')
{		$new_satus 			 =  $json['status']; 	 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];   
		$new_operator 		 = $json['operator'];
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'REVERSED';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';
} elseif($status == 'DISPUTE')
{		$new_satus 			 =  $json['status']; 	 		 
		$new_txnid 			 = $json['txnid']; 
		$new_usertxn 		 = $json['txnid']; 
		$new_operator_ref 	 = $json['operator'];   
		$new_operator 		 = $json['operator'];
		$new_country		 = 91; 
		$new_number 		 = $mobile;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount; 
		$new_message 		 = 'DISPUTE';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';	
	
}

		
	   $billstatus = $this->billpay_model->billstatus($new_satus, $new_txnid, $new_usertxn, $new_operator_ref, $new_operator, $new_country, $new_number, $new_amount, $new_amount_deducted, $new_message,$new_time ,$new_error_code );
			
			

			
/*-----------------------------------------------------------------------------------------------------*/        
	if($status == 'SUCCESS' ) //or $status == 'PENDING')
		
	{
		$proceed = '01';
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
			
			$table_name = "users";			
			$where_array = array('referral_code' => $pay_to);      //Sponsorship fees Paying User 'pay_to'
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$pay_to_userID		  = $r->id;
					$pay_to_first_name    = $r->first_name;
					$pay_to_last_name     = $r->last_name;             
				    $pay_to_email         = $r->email;
					$pay_to_dob			  = $r->date_of_birth;
					$pay_to_adhaar_no     = $r->adhaar_no;
					$pay_to_account_no    = $r->account_no;
					$pay_to_rolename      = $r->rolename;
				    $pay_to_country       = $r->country;
				    $pay_to_country_id    = $r->country_id;			
					$pay_to_photoName     = $r->photo;
				}
			}
		
       $c_id = $pay_to_userID;
	   
       $customer_info = singleDbTableRow($c_id);

        
        //get customer referral Code
        $customer_referral_id = $customer_info->referral_code;
		$rolename 	  		  = $customer_info->rolename; //User type
		
        $customer_id = $customer_info->id;
		$account_no  = $customer_info->account_no;
		$role 		 = $customer_info->role;	
		
		
/****To create Invoice for Transactions*/

        //Get ID From currently logged in User
        $sales_by = $this->session->userdata('logged_user')['user_id'];
	
        $qty 			= '1'; 		//$this->input->post('qty');
        $productName 	= $tranx_id; //'Test Remarks' ; //$this->input->post('productName');
        $categories 	= $pay_type; //$this->input->post('categories');
        $itemCost 		= $amount; 	//$this->input->post('amount');

        $totalProduct = '1'; //count($qty);
		$itemPrice =  $itemCost  ;
		
        $invoiceData = [
            'total_product'         => $totalProduct,
			//'total_price'           => $itemPrice,			
            'customer_id'           => $customer_id,
            'customer_referral_id'  => $customer_referral_id,
            'sales_by'              => $pay_by_userID, //$sales_by,
            'created_at'            => time(),
            'modified_at'           => time(),
        ];

        $insertInvoice = $this->db->insert('invoice', $invoiceData);

        $invoice_id = $this->db->insert_id();

        // Get Each sales Item and insert to sales_item table

        $HTMLrow = '';

        for($i = 0; $i < $totalProduct; $i++)
        {
            $quantity = $qty[$i];


	        $categoryID 	= $categories;   	//payspecification ID
		    $product_name	= $productName;
            $price 			= $amount; 				//$itemPrice[$i] * $quantity;
            $total_price 	= $amount; 		//$price;


			$acct_id1 		= $pay_type; //$this->input->post('sub_account');
			$seller_info 	= $this->session->userdata('logged_user');
			$sellerID	 	= $pay_by_userID	; // 	$sales_by;
			$seller_role	= singleDbTableRow($sellerID)->rolename;
			
			$client_id 		= $pay_to_userID;
			$client_info 	= singleDbTableRow($client_id, 'users') ;		
						
			$client_role = $client_info->rolename;			
			
			$acct_id = $acct_id1;
			
		$commission_per1 = '0'; //$r->commission;
		$benefits_per1 = '0'; //$r->benefits;
			
			/*************************************************************************************/
            $sales_itemData = [
                'category_id'   => $acct_id,
                'product_name'  => $product_name,
                'invoice_id'    => $invoice_id,
                'qty'           => $quantity,
                'item_price'    => $price, //$itemPrice[$i],
                'price'         => $price,
				'commission'    => $commission_per1, //$commission,				
                'benefits'      => $benefits_per1,
                'created_at'    => time(),
                'modified_at'   => time(),
            ];

            $sales_itemInsert = $this->db->insert('sales_item', $sales_itemData);

			
            //HTML For Email
            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;">'.'1'.'</td>
                        <td style="padding:5px;text-align:center;">'.$product_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$amount.'</td>
                        <td style="padding:5px;text-align:center;">'.$quantity.'</td>
                        <td style="padding:5px;text-align:center;">'.$price.'</td>
                    </tr>';


        }
        //Anand Code starts here Section for Commision & Benefits
/**********************
 Table update Response To the Recieving Partner from the Money sender user
*************************/
		 $total_price = $amount; // array_sum($total_price);
			
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$sales_role =  $user['role'];	
		
		$referral_code = singleDbTableRow($pay_by_userID)->referral_code;
		$first_name1 = singleDbTableRow($pay_by_userID)->first_name;
		
		$c_account_no = singleDbTableRow($pay_to_userID)->account_no;
		
		$wallet_balance = $this->input->post('wallet_balance');
		
	
//Benefits details To the Recieving Partner for data retrival 

       // S E N D E R
//pay_by_userID is Seller/Current User who is sending money
		$pm_wallet 	   = 'wallet';		
		$acct_id 	   = $pay_type; //$this->input->post('sub_account');			
		$user_info 	   = $this->session->userdata('logged_user');
        $user_id 	   = $pay_by_userID;
		$email 		   = singleDbTableRow($pay_by_userID)->email;
		$currentUser   = singleDbTableRow($pay_by_userID)->role;
		$sel_ref_code  = singleDbTableRow($pay_by_userID)->referral_code;
		$sel_ref_by    = singleDbTableRow($pay_by_userID)->referredByCode;   //Key field to get 5 level Network
		$seller_role   = singleDbTableRow($pay_by_userID)->rolename;		
		
		$seller_rolename   = typeDbTableRow($seller_role)->rolename;     //Role Description
		$seller_account_no = singleDbTableRow($pay_by_userID)->account_no;	
		$seller_email      = singleDbTableRow($pay_by_userID)->email;	
		
		
		
		
		// R E C I E V E R
//pay_to_userID is Client/Beneficiary User	who is reciving money
		$client_id 		 = $pay_to_userID;
		$client_role  	 = singleDbTableRow($pay_to_userID)->rolename;	  // Role ID		
		$client_rolename = typeDbTableRow($client_role)->rolename;    //Role Description
		$client_email    = singleDbTableRow($pay_to_userID)->email;	
		$client_name  	 = singleDbTableRow($pay_to_userID)->first_name;	
		$clt_ref_code 	 = singleDbTableRow($pay_to_userID)->referral_code;	
		$clt_ref_by   	 = singleDbTableRow($pay_to_userID)->referredByCode; //Key field to get 5 level Network
		$agreed_per 	 = '0';
		$agreed_per      = singleDbTableRow($pay_to_userID)->agreed_per;
		
		
	// Insert data for Accounts-VPA debit "To the Recieving Partner"	
		$tranx_id1 		  = 'Paid by '.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id;

//Get Individual Account transactions series Id	
$acct_user 		= $c_id;
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 
{	foreach ($result_count->result() as $r)
	{       $value 		= $r->tran_count;  	
		    $tran_count = $value + 1;	
	}			
}if ($tran_count == null)
{	$tran_count = '1';}

//End of Individual Account transactions Id	
/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $c_id;
		$user_amount    = 0;
		$points_mode 	= $pm_wallet;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $total_price;
		
		
	
	//Recieving/Client/passive user
	   $accounts1 = [
            'user_id'      			=> $c_id,        //To the Recieving Partner  
			'email'         	    => $client_email,
			'account_no'         	=> $c_account_no,
            'rolename'  		    => $client_role,
			'paid_to'         		=> $user_id,      //From the Money sender user 
            'pay_type'         		=> $acct_id,      //Payspecification ID
			'debit'         		=> $total_price,
			'credit'         		=> '0',
			'amount'         		=> $user_amount, //$total_price,						
			'tranx_id'				=> $tranx_id1,
			'points_mode'           => $pm_wallet,
			'tran_count'			=> $tran_count,
			'used'					=> 'yes',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

	$this->db->insert('accounts', $accounts1);


	$tran = '1'; // 0- Credit 1- debit
	$sms_user = $c_id;
	$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
	
		
	//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
  
	$remarks1 = 'Ledger Update: Paid by'.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id;
		$ledger1 = [
            'user_id'         		=> $c_id,             	//To the Recieving Partner  
			'pay_type'				=> $acct_id, 			//Deduction Pay Specification	
			'account_no'         	=> $c_account_no,		//Member Account No
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
			'debit'         		=> $total_price,
			'credit'         		=> '0',
			'amount'         		=> $total_price,	
			'points_mode'           => $pm_wallet,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks1,             //Description
			'count'					=> 'yes',
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $this->db->insert('ledger', $ledger1);	
		
	
		
		$tranx_id2 = "Paid to '".$client_rolename.'-'.$client_name."' for the Invoice ID-".$invoice_id;
		
	//Sender/Seller/Active user
	
	
								$user_debit  	= $this->product_model->total_debit($userID, $points_mode);
								$user_credit  	= $this->product_model->total_credit($userID, $points_mode);
							
		
//Get Individual Account transactions Id
	
$acct_user 		= $user_id;		
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 
{	foreach ($result_count->result() as $r)
	{       $value 		= $r->tran_count;  					
			$tran_count = $value + 1;				
	}							
}
//End of Individual Account transactions Id	
		
/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $user_id;
		$user_amount    = 0;
		$points_mode 	= $pm_wallet;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $total_price;
		
	   $accounts2 = [
            'user_id'      			=> $user_id,        //From the Money sender user
			'email'         	    => $seller_email,
			'account_no'         	=> $seller_account_no,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,      // To the Recieving Partner  
            'pay_type'         		=> $acct_id,      //Payspecification ID
			'debit'         		=> '0',
			'credit'         		=> $total_price,
			'amount'         		=> $user_amount, //$total_price,						
			'tranx_id'				=> $tranx_id2,
			'points_mode'           => $pm_wallet,
			'tran_count'			=> $tran_count,
			'used'					=> 'yes',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

         $this->db->insert('accounts', $accounts2);
		
			$tran = '0'; // 0- Credit 1- debit
			$sms_user = $user_id;
			$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
			
	
	
		//Except Agent and Customer, recording rest of the transactions to Ledger
	if ($currentUser = 'admin' )	
	{   
		$remarks2 = "Ledger Update: Paid to '".$client_rolename.'-'.$client_name."' for the Invoice ID-".$invoice_id;
		$ledger2 = [
            'user_id'         		=> $user_id,             	//To the Recieving Partner  
			'pay_type'				=> $acct_id, 			    //Deduction Pay Specification	
			'account_no'         	=> $seller_account_no,		//Member Account No
			'email'					=> $seller_email,
			'rolename'  			=> $seller_role,
            'credit'         		=> $total_price,
			'debit'         		=> '0', 	
			'amount'         		=> $total_price, 
			'points_mode'           => 'wallet',
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks2,             //Description
			'count'					=> 'no',
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $this->db->insert('ledger', $ledger2);	
		
	}
	
/***********************************************************************************************/	
/* Updating OTP table as Data Processed													   */
/* 																							   */
/*																							   */
/***********************************************************************************************/
			 $data9 = [
           	'active'            => '1',            
            'modified_at'       => time()
        ];

       $query9 = $this->db->where('id', $id)->update('billpay_request', $data9);	
	   
/******Automatically Payspecification will be Identified and calculates the Percentage**************/	

		$table_name = "commissions";
			$where_array = array('sub_acct_id' =>$acct_id, 'from_role' =>$seller_role, 'to_role' =>$client_role, 'identity' =>'Commission');
			$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
		$points_mode    = $row->points_mode;
		$benefits_per   = $row->benefits;         
		$commission_per = $row->commission;      //Debit to Payspecification
		
		$deduction_paytype = $row->ded_paytype;		
		
		$profit_pm    	  = $row->profit_pm;
		$seller_profit    = $row->sender_profit;
		$client_profit    = $row->receiver_profit;
		
		$deduction_pm  	 = $row->deduction_pm;
		$seller_deduction = $row->sender_deduction;
		
		 if ($client_role == '13' && $agreed_per > 0 )
		 {
			 $client_deduction = $agreed_per;
		 }else{
			 $client_deduction = $row->receiver_deduction;
		 }
		
	//----------------------------------------------------------------------------------------------//
//*************************************//Profit to 'Seller'
		
        $seller_info = singleDbTableRow($pay_by_userID);
		$seller_account_no = $seller_info->account_no;  // $customer_info->referral_code;  
		$seller_benefits = (($total_price * $seller_profit) / '100' ) ; //Percentage value for Seller
		//Seller Loyality
		if ($seller_benefits != '0')
		{   $text5 = $seller_rolename.'- commission for Invoice ID-'.$invoice_id;
	
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_by_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_by_userID;
		$user_amount    = 0;
		$points_mode 	= $profit_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $seller_benefits;

										
	   $accounts5 = [
            'user_id'      			=> $pay_by_userID,          //From the Money sender user
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,           // To the Recieving Partner  
            'tranx_id'         		=> $text5,  	  //$pay_type,
			'credit'         		=> '0',
			'debit'         		=> $seller_benefits,
			'amount'         		=> $user_amount,	
			'points_mode'           => $profit_pm,
			'tran_count'			=> $tran_count,				
			'used'					=> 'no',
			'pay_type'				=> $acct_id,         //Debit from Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts5); 
		
		$sms_user = $pay_by_userID;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
		$sms_total = $seller_benefits;
		$pm_wallet = $profit_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );

						
		//Deduction of commission from Ledger Table with Respective Payspecification and passing the
		//same value to the respective Benefitiary
		   $remarks6 = $seller_rolename.'- commission for Invoice ID-'.$invoice_id;
        $data6 = [
            'user_id'         		=> $pay_by_userID,              //From the Money sender user
			'pay_type'				=> $deduction_paytype,   //Deduction from Pay Specification	
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
			'rolename'  			=> $seller_role,
            'credit'         		=> $seller_benefits,
			'debit'         		=> '0', 	
			'amount'         		=> $seller_benefits, 
			'points_mode'           => $profit_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks6,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data6);
		}
//----------------------------------------------------------------------------------------------//
//*************************************//Profit to 'Client'
	
	
	
	
	
	
//$deduction_paytype for Deduction
		$ded_payspec1 = "Commission Deducted from Pay Spec No -". $deduction_paytype ;
					
		
		$client_benefits = (($total_price * $client_profit) / '100' ) ; //Percentage value for Client
	if ($client_benefits != '0')	
	{	$tranx_id3 = $client_rolename.'- commission for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_to_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_to_userID;
		$user_amount    = 0;
		$points_mode 	= $profit_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $client_benefits;
		
	   $accounts3 = [
            'user_id'      			=> $pay_to_userID,          //To the Recieving Partner  
			'account_no'         	=> $c_account_no,
            'rolename'  			=> $client_role,
			'email'					=> $client_email,
			'paid_to'         		=> $userID,       //From the Money sender user 
            'tranx_id'         		=> $tranx_id3,
			'credit'         		=> '0',
			'debit'         		=> $client_benefits,
			'amount'         		=> $user_amount,	
			'points_mode'           => $profit_pm,	
			'tran_count'			=> $tran_count,
			'used'					=> 'no',
		    'pay_type'				=> $acct_id,         //Debit from Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts3); 
		$sms_user = $c_id;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
		$sms_total = $client_benefits;
		$pm_wallet = $profit_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
		
	//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
			$remarks4 = $client_rolename.'- commission for Invoice ID -'.$invoice_id; 
        $data4 = [
            'user_id'         		=> $pay_to_userID,             		//To the Recieving Partner  
			'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
			'account_no'         	=> $c_account_no,			//Member Account No
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
            'credit'         		=> $client_benefits,
			'debit'         		=> '0', 	
			'amount'         		=> $client_benefits, 
			'points_mode'           => $profit_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks4,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data4);
	}
//----------------------------------------------------------------------------------------------//	 
//*****************************/Commission from 'Sender'





        $seller_info = singleDbTableRow($pay_by_userID);
		$seller_account_no = $seller_info->account_no;  // $customer_info->referral_code;  
		$seller_commission = '0';
		$seller_commission = (($total_price * $seller_deduction) / '100' ) ; //Percentage value for Seller
	if($seller_commission  != '0')	
	{	//Seller Loyality
	   $text9 = 'Commission deducted from -'.$seller_rolename.'-for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_by_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_by_userID;
		$user_amount    = 0;
		$points_mode 	= $deduction_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $seller_commission;
		
	   $accounts9 = [
            'user_id'      			=> $pay_by_userID,          //From the Money sender user
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,           // To the Recieving Partner  
            'tranx_id'         		=> $text9,  	 
			'debit'         		=> '0',
			'credit'         		=> $seller_commission,
			'amount'         		=> $user_amount,	
			'points_mode'           => $deduction_pm,	
			'tran_count'			=> $tran_count,	
			'used'					=> 'yes',
			'pay_type'				=> $acct_id,		 //Deposit Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts9); 
		$sms_user = $pay_by_userID;								
		$tran = '0'; // "1" if 'Credit' == 0 & no amount value      -OR-                  *  "0" if 'debit' == 0 & no amount value 							
		$sms_total = $seller_commission;
		$pm_wallet = $deduction_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
						
		//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
		  $remarks10 = 'Commission deduction from -'.$seller_rolename.'-for Invoice ID -'.$invoice_id; 
        $data10 = [
            'user_id'         		=> $pay_by_userID,              //From the Money sender user
			'pay_type'				=> $acct_id,   //Deposit Pay Specification	
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
			'rolename' 			    => $seller_role,
            'debit'         		=> $seller_commission,
			'credit'         		=> '0', 	
			'amount'         		=> $seller_commission, 
			'points_mode'           => $deduction_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks10,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data10);	
	}	   
//----------------------------------------------------------------------------------------------//
//*****************************/Commission from 'Client' 





		$ded_payspec1 = "Benefits Deducted from Pay Spec No -". $acct_id ;
					
		$client_commission = '0';
		$client_commission = (($total_price * $client_deduction) / '100' ) ; //Percentage value for Client
		
	if($client_commission != '0')
	{	$tranx_id7 = 'Commission deduction from -'.$client_rolename.'-for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_to_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $pay_to_userID;
		$user_amount    = 0;
		$points_mode 	= $deduction_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $client_commission;
		
	   $accounts7 = [
            'user_id'      			=> $pay_to_userID,          //To the Recieving Partner  
			'account_no'         	=> $c_account_no,
            'rolename'  			=> $client_role,
			'email'					=> $client_email,
			'paid_to'         		=> $userID,       //From the Money sender user 
            'tranx_id'         		=> $tranx_id7,
			'debit'         		=> '0',
			'credit'         		=> $client_commission,
			'amount'         		=> $user_amount,	
			'points_mode'           => $deduction_pm,	
			'tran_count'			=> $tran_count,	
			'used'					=> 'yes',
		    'pay_type'				=> $acct_id, //Deposit Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts7); 
		$sms_user = $pay_to_userID;								
		$tran = '0'; // "1" if 'Credit' == 0 & no amount value      -OR-                  *  "0" if 'debit' == 0 & no amount value 							
		$sms_total = $client_commission;
		$pm_wallet = $deduction_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
			$remarks8 = 'Commission deduction from -'.$client_rolename.'-for Invoice ID -'.$invoice_id; 	
        $data8 = [
            'user_id'         		=> $pay_to_userID,             	 //To the Recieving Partner  
			'pay_type'				=> $acct_id, 			 //Deposit Pay Specification	
			'account_no'         	=> $c_account_no,
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
            'debit'         		=> $client_commission,
			'credit'         		=> '0', 	
			'amount'         		=> $client_commission, 
			'points_mode'           => $deduction_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks8,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data8);	


	}	
		$slr_ref_pm  	 = $row->slr_ref_pm;	
		$slr_ref_level1  = $row->slr_ref_level1;		
		$slr_ref_level2  = $row->slr_ref_level2;	
		$slr_ref_level3  = $row->slr_ref_level3;	
		$slr_ref_level4  = $row->slr_ref_level4;	
		$slr_ref_level5  = $row->slr_ref_level5;	
		
		$clt_ref_pm  	 = $row->clt_ref_pm;	
		$clt_ref_level1  = $row->clt_ref_level1;
		$clt_ref_level2  = $row->clt_ref_level2;	
		$clt_ref_level3  = $row->clt_ref_level3;	
		$clt_ref_level4  = $row->clt_ref_level4;	
		$clt_ref_level5  = $row->clt_ref_level5;
				
				
//Function to do multiple activity				
				
		$slr_ref_per_level1  = (($total_price * $slr_ref_level1) / '100' ) ; //Percentage value for slr_ref_level1	
		$slr_ref_per_level2  = (($total_price * $slr_ref_level2) / '100' ) ; //Percentage value for slr_ref_level2	
		$slr_ref_per_level3  = (($total_price * $slr_ref_level3) / '100' ) ; //Percentage value for slr_ref_level3	
		$slr_ref_per_level4  = (($total_price * $slr_ref_level4) / '100' ) ; //Percentage value for slr_ref_level4	
		$slr_ref_per_level5  = (($total_price * $slr_ref_level5) / '100' ) ; //Percentage value for slr_ref_level5	

		$clt_ref_per_level1  = (($total_price * $clt_ref_level1) / '100' ) ; //Percentage value for clt_ref_level1			
		$clt_ref_per_level2  = (($total_price * $clt_ref_level2) / '100' ) ; //Percentage value for clt_ref_level2			
		$clt_ref_per_level3  = (($total_price * $clt_ref_level3) / '100' ) ; //Percentage value for clt_ref_level3			
		$clt_ref_per_level4  = (($total_price * $clt_ref_level4) / '100' ) ; //Percentage value for clt_ref_level4			
		$clt_ref_per_level5  = (($total_price * $clt_ref_level5) / '100' ) ; //Percentage value for clt_ref_level5			


/*********   Begin of  'seller' Referrals Commision for Level 1        *********/

		$table_name = "users";
		$where_array = array('referral_code' =>$sel_ref_by, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id1 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_sl_ref2  =  $row->referredByCode;           // Next referral chain
				
				if($ref_id1!= 0)
				{
		   			if ($slr_ref_per_level1 != '0')
						{
								$text1 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ref_account_no = singleDbTableRow($ref_id1)->account_no;
								
								//Update Debit balance
								$userID = $ref_id1;	$user_amount = '0';	
								$points_mode = $slr_ref_pm;
								$user_debit  	= $this->product_model->total_debit($userID, $points_mode);
								$user_credit  	= $this->product_model->total_credit($userID, $points_mode);
								$user_balance = '0'; //$user_debit - $user_credit;
								$user_amount = $user_balance + $slr_ref_per_level1;
								
								//Get Individual Account transactions Id
								
								$acct_user 		= $ref_id1;		
								$result_count  	= $this->product_model->get_tran_count($acct_user);		
								if($result_count -> num_rows() > 0) 
								{	foreach ($result_count->result() as $r)
									{       $value 		= $r->tran_count;  					
											$tran_count = $value + 1;				
									}							
								}
								//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id1;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level1;
								$accounts_ref1 = [
									'user_id'      			=> $ref_id1,          //To the Recieving Partner  
									'account_no'         	=> $ref_account_no,									
									'rolename'  			=> $rolename,
									'email'					=> $email,
									'paid_to'         		=> $paid_to,       //From the Money sender user 
									'tranx_id'         		=> $text1,
									'credit'         		=> '0',
									'debit'         		=> $slr_ref_per_level1,
									'amount'         		=> $user_amount, //$slr_ref_per_level1,	
									'points_mode'           => $slr_ref_pm,	
									'tran_count'			=> $tran_count,	
									'used'					=> 'no',
									'pay_type'				=> $deduction_paytype, //$invoice_id,		
									'created_at'            => time(),
									'modified_at'           => time()
								];

								$this->db->insert('accounts', $accounts_ref1); 
								
								$sms_user = $ref_id1;								
								$tran = '1'; // 1 if 'Credit' == 0 and 0 if 'debit' == 0								
								$sms_total = $slr_ref_per_level1;
								$pm_wallet = $slr_ref_pm;
								$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
								
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ledger_ref1 = [
									'user_id'         		=> $ref_id1,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level1,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level1, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref1);
						}
				}
		
	/*********             Referrals Commision for Level 2                    *********/
					if( $next_sl_ref2!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_sl_ref2, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id2 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
								$next_sl_ref3  =  $row->referredByCode;   //Next referral chain
						     if($ref_id2!= 0)
								{
									if ($slr_ref_per_level2 != '0')
									{
										$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
										$ref_account_no = singleDbTableRow($ref_id2)->account_no;
										
									
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id2;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id2;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level2;
										$accounts_ref2 = [
											'user_id'      			=> $ref_id2,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $slr_ref_per_level2,
											'amount'         		=> $user_amount, //$slr_ref_per_level2,	
											'points_mode'           => $slr_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_ref2); 	
									
									$sms_user = $ref_id2;								
									$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
									$sms_total = $slr_ref_per_level2;
									$pm_wallet = $slr_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
									
									
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;
									$ledger_ref2 = [
									'user_id'         		=> $ref_id2,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level2,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level2, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref2);
									}
						        }
						
/*********             Referrals Commision for Level 3                    *********/
								if( $next_sl_ref3!= 0)     ////Next refferal is Available? Proceed
								{
										$table_name = "users";
											$where_array = array('referral_code' =>$next_sl_ref3, 'active' => '1');
											$query = $this->db->where($where_array )->get($table_name); 
											foreach ($query->result() as $row)
											{	
													$ref_id3 	= $row->id;		
													$rolename	= $row->rolename;
													$email      = $row->email;
													$paid_to	= $row->id;
													$next_sl_ref4  =  $row->referredByCode;   //Next refferall chain
												if($ref_id3!= 0)
												{
												if ($slr_ref_per_level3 != '0')
												{	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
													$ref_account_no = singleDbTableRow($ref_id3)->account_no;
													
													//Get Individual Account transactions Id
													
													$acct_user 		= $ref_id3;		
													$result_count  	= $this->product_model->get_tran_count($acct_user);		
													if($result_count -> num_rows() > 0) 
													{	foreach ($result_count->result() as $r)
														{       $value 		= $r->tran_count;  					
																$tran_count = $value + 1;				
														}							
													}
													//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id3;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level3;
													$accounts_ref3 = [
														'user_id'      			=> $ref_id3,          //To the Recieving Part	ner  
														'account_no'         	=> $ref_account_no,
														'rolename'  			=> $rolename,
														'email'					=> $email,
														'paid_to'         		=> $paid_to,       //From the Money sender 	user 
														'tranx_id'         		=> $text2,
														'credit'         		=>	 '0',
														'debit'         		=> $slr_ref_per_level3,
														'amount'         		=> $user_amount, //$slr_ref_per_level3,	
														'points_mode'           => $slr_ref_pm,
														'tran_count'			=> $tran_count,															
														'used'					=> 	'no',
														'pay_type'				=> $deduction_paytype, //$invoice_	id,		
														'created_at'            => time(),
														'modified_at'           => time()
													];

														$this->db->insert('accounts', $accounts_ref3); 
														$sms_user = $ref_id3;								
														$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
														$sms_total = $slr_ref_per_level3;
														$pm_wallet = $slr_ref_pm;
														$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
														$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
													$ledger_ref3 = [
														'user_id'         		=> $ref_id3,             		//To the Recieving Partner  
														'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
														'account_no'         	=> $ref_account_no,			//Member Account No
														'email'					=> $email,
														'rolename'  			=> $rolename,
														'credit'         		=> $slr_ref_per_level3,
														'debit'         		=> '0', 	
														'amount'         		=> $slr_ref_per_level3, 
														'points_mode'           => $slr_ref_pm,
														'invoice_id '  			=> $invoice_id,		
														'challan' 				=> 'no_invoice.jpg',			
														'remarks'         		=> $remarks,
														'start_date'         	=> time(),		
														'created_at'            => time(),
														'modified_at'           => time()
													];

												   $query = $this->db->insert('ledger', $ledger_ref1);
												}	//End of DB update					
											}		 //End of Next Ref ID Not Available
										
				
/*********             Referrals Commision for Level 4                    *********/
	if( $next_sl_ref4!= 0)     ////Next refferal is Available? Proceed
		{
		$table_name = "users";
		$where_array = array('referral_code' =>$next_sl_ref4, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id4 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_sl_ref5  =  $row->referredByCode;   //Next refferall chain
		
				if($ref_id4!= 0)
				{		
				if ($slr_ref_per_level4 != '0')
				   {	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
						$ref_account_no = singleDbTableRow($ref_id4)->account_no;
						//Get Individual Account transactions Id
						
						$acct_user 		= $ref_id4;		
						$result_count  	= $this->product_model->get_tran_count($acct_user);		
						if($result_count -> num_rows() > 0) 
						{	foreach ($result_count->result() as $r)
							{       $value 		= $r->tran_count;  					
									$tran_count = $value + 1;				
							}							
						}
						//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id4;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level4;
		
						$accounts_ref4 = [
							'user_id'      			=> $ref_id4,          //To the Recieving Partner  
							'account_no'         	=> $ref_account_no,
							'rolename'  			    => $rolename,
							'email'					=> $email,
							'paid_to'         		=> $paid_to,       //From the Money sender user 
							'tranx_id'         		=> $text2,
							'credit'         		=> '0',
							'debit'         		=> $slr_ref_per_level4,
							'amount'         		=> $user_amount,	
							'points_mode'           => $slr_ref_pm,	
							'tran_count'			=> $tran_count,	
							'used'					=> 'no',
							'pay_type'				=> $deduction_paytype, //$invoice_id,		
							'created_at'            => time(),
							'modified_at'           => time()
					];

					$this->db->insert('accounts', $accounts_ref4); 	

					$sms_user = $ref_id4;								
					$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
					$sms_total = $slr_ref_per_level4;
					$pm_wallet = $slr_ref_pm;
					$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
					$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
												
					$ledger_ref4 = [
									'user_id'         		=> $ref_id4,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level4,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level4, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref4);
					}	//End of DB update					
				}		 //End of Next Ref ID Not Available
/*********             Referrals Commision for Level 5                    *********/
				if( $next_sl_ref5!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_sl_ref5, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id5 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
							//	$next_sl_ref4  =  $row->referredByCode;   //No  Next refferall chain
						
							if($ref_id5!= 0)
							{		
									if ($slr_ref_per_level5 != '0')
									{
									$text2 = 'Referrals Business loyalty for Invoice ID-'.$invoice_id;
									$ref_account_no = singleDbTableRow($ref_id5)->account_no;
									//Get Individual Account transactions Id
									
									$acct_user 		= $ref_id5;		
									$result_count  	= $this->product_model->get_tran_count($acct_user);		
									if($result_count -> num_rows() > 0) 
									{	foreach ($result_count->result() as $r)
										{       $value 		= $r->tran_count;  					
												$tran_count = $value + 1;				
										}							
									}
									//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id5;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level5;								
										$accounts_ref5 = [
											'user_id'      			=> $ref_id5,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			    => $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $slr_ref_per_level5,
											'amount'         		=> $user_amount,	
											'points_mode'           => $slr_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_ref5); 	
									$sms_user = $ref_id5;								
									$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
									$sms_total = $slr_ref_per_level5;
									$pm_wallet = $slr_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );	
									
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
					
									$ledger_ref5 = [
									'user_id'         		=> $ref_id5,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level5,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level5, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

									$query = $this->db->insert('ledger', $ledger_ref1);
									}		
							}
	
						}
	
					}
					}
				}
				}
			}
			}
		}
	}
	
/*************************End of Seller Ref Profit sharing**************************************************/




/*********          Begin of Client Ref Profit sharing Referrals Commision for Level 1             *********/

		$table_name = "users";
		$where_array = array('referral_code' =>$clt_ref_by, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id1 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_cl_ref2  =  $row->referredByCode;           // Next referral chain
				
				if($ref_id1!= 0)
				{
		   			if ($clt_ref_per_level1 != '0')
						{
								$text1 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ref_account_no = singleDbTableRow($ref_id1)->account_no;
								//Get Individual Account transactions Id
								
								$acct_user 		= $ref_id1;		
								$result_count  	= $this->product_model->get_tran_count($acct_user);		
								if($result_count -> num_rows() > 0) 
								{	foreach ($result_count->result() as $r)
									{       $value 		= $r->tran_count;  					
											$tran_count = $value + 1;				
									}							
								}
								//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id1;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level1;
		
								$accounts_clr_ref1 = [
									'user_id'      			=> $ref_id1,          //To the Recieving Partner  
									'account_no'         	=> $ref_account_no,
									'rolename'  			=> $rolename,
									'email'					=> $email,
									'paid_to'         		=> $paid_to,       //From the Money sender user 
									'tranx_id'         		=> $text1,
									'credit'         		=> '0',
									'debit'         		=> $clt_ref_per_level1,
									'amount'         		=> $user_amount,	
									'points_mode'           => $clt_ref_pm,	
									'tran_count'			=> $tran_count,	
									'used'					=> 'no',
									'pay_type'				=> $deduction_paytype, //$invoice_id,		
									'created_at'            => time(),
									'modified_at'           => time()
								];
								
					
								$this->db->insert('accounts', $accounts_clr_ref1);
								
								$sms_user = $ref_id1;								
								$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
								$sms_total = $clt_ref_per_level1;
								$pm_wallet = $clt_ref_pm;
								$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );


								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref1 = [
									'user_id'         		=> $ref_id1,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level1,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level1, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
						}
				}
		
	/*********             Referrals Commision for Level 2                    *********/
					if( $next_cl_ref2!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_cl_ref2, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id2 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
								$next_cl_ref3  =  $row->referredByCode;   //Next referral chain
						     if($ref_id2!= 0)
								{
									if ($clt_ref_per_level2 != '0')
									{
										$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
										$ref_account_no = singleDbTableRow($ref_id2)->account_no;
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id2;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id2;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level2;
		
										$accounts_clr_ref2 = [
											'user_id'      			=> $ref_id2,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $clt_ref_per_level2,
											'amount'         		=> $user_amount,	
											'points_mode'           => $clt_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_clr_ref2); 	
									
									$sms_user = $ref_id2;								
									$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
									$sms_total = $clt_ref_per_level2;
									$pm_wallet = $clt_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
								
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;									
								$ledger_clr_ref3 = [
									'user_id'         		=> $ref_id2,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level3,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level3, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
									}
						        }
						
/*********             Referrals Commision for Level 3                    *********/
								if( $next_cl_ref3!= 0)     ////Next refferal is Available? Proceed
								{
										$table_name = "users";
											$where_array = array('referral_code' =>$next_cl_ref3, 'active' => '1');
											$query = $this->db->where($where_array )->get($table_name); 
											foreach ($query->result() as $row)
											{	
													$ref_id3 	= $row->id;		
													$rolename	= $row->rolename;
													$email      = $row->email;
													$paid_to	= $row->id;
													$next_cl_ref4  =  $row->referredByCode;   //Next refferall chain
												if($ref_id3!= 0)
												{
												if ($clt_ref_per_level3 != '0')
												{	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
													$ref_account_no = singleDbTableRow($ref_id3)->account_no;
													//Get Individual Account transactions Id
													

													$acct_user 		= $ref_id3;		
													$result_count  	= $this->product_model->get_tran_count($acct_user);		
													if($result_count -> num_rows() > 0) 
													{	foreach ($result_count->result() as $r)
														{       $value 		= $r->tran_count;  					
																$tran_count = $value + 1;				
														}							
													}
													//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id3;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level3;
		
													$accounts_clr_ref3 = [
														'user_id'      			=> $ref_id3,          //To the Recieving Part	ner  
														'account_no'         	=> $ref_account_no,
														'rolename'  			=> $rolename,
														'email'					=> $email,
														'paid_to'         		=> $paid_to,       //From the Money sender 	user 
														'tranx_id'         		=> $text2,
														'credit'         		=>	 '0',
														'debit'         		=> $clt_ref_per_level3,
														'amount'         		=> $user_amount,	
														'points_mode'           => $clt_ref_pm,	
														'tran_count'			=> $tran_count,	
														'used'					=> 	'no',
														'pay_type'				=> $deduction_paytype, //$invoice_	id,		
														'created_at'            => time(),
														'modified_at'           => time()
													];

														$this->db->insert('accounts', $accounts_clr_ref3); 
														
														$sms_user = $ref_id3;								
														$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
														$sms_total = $clt_ref_per_level3;
														$pm_wallet = $clt_ref_pm;
														$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );

									
													$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;		
													$ledger_clr_ref3 = [
														'user_id'         		=> $ref_id3,             		//To the Recieving Partner  
														'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
														'account_no'         	=> $ref_account_no,			    //Member Account No
														'email'					=> $email,
														'rolename'  			=> $rolename,
														'credit'         		=> $clt_ref_per_level3,
														'debit'         		=> '0', 	
														'amount'         		=> $clt_ref_per_level3, 
														'points_mode'           => $clt_ref_pm,
														'invoice_id '  			=> $invoice_id,		
														'challan' 				=> 'no_invoice.jpg',			
														'remarks'         		=> $remarks,
														'start_date'         	=> time(),		
														'created_at'            => time(),
														'modified_at'           => time()
													];

												   $query = $this->db->insert('ledger', $ledger_clr_ref1);														
												}	//End of DB update					
											}		 //End of Next Ref ID Not Available
										
				
/*********             Referrals Commision for Level 4                    *********/
	if( $next_cl_ref4!= 0)     ////Next refferal is Available? Proceed
		{
		$table_name = "users";
		$where_array = array('referral_code' =>$next_cl_ref4, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id4 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_cl_ref5  =  $row->referredByCode;   //Next refferall chain
		
				if($ref_id4!= 0)
				{		
				if ($clt_ref_per_level4 != '0')
				   {	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
						$ref_account_no = singleDbTableRow($ref_id4)->account_no;
						//Get Individual Account transactions Id
						
						$acct_user 		= $ref_id4;		
						$result_count  	= $this->product_model->get_tran_count($acct_user);		
						if($result_count -> num_rows() > 0) 
						{	foreach ($result_count->result() as $r)
							{       $value 		= $r->tran_count;  					
									$tran_count = $value + 1;				
							}							
						}
						//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id4;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level4;
		
						$accounts_clr_ref4 = [
							'user_id'      			=> $ref_id4,          //To the Recieving Partner  
							'account_no'         	=> $ref_account_no,
							'rolename'  			    => $rolename,
							'email'					=> $email,
							'paid_to'         		=> $paid_to,       //From the Money sender user 
							'tranx_id'         		=> $text2,
							'credit'         		=> '0',
							'debit'         		=> $clt_ref_per_level4,
							'amount'         		=> $user_amount,	
							'points_mode'           => $clt_ref_pm,	
							'tran_count'			=> $tran_count,	
							'used'					=> 'no',
							'pay_type'				=> $deduction_paytype, //$invoice_id,		
							'created_at'            => time(),
							'modified_at'           => time()
					];

					$this->db->insert('accounts', $accounts_clr_ref4);

					$sms_user = $ref_id3;								
					$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
					$sms_total = $clt_ref_per_level3;
					$pm_wallet = $clt_ref_pm;
					$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref4 = [
									'user_id'         		=> $ref_id4,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level4,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level4, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);					
					}	//End of DB update					
				}		 //End of Next Ref ID Not Available
/*********             Referrals Commision for Level 5                    *********/
				if( $next_cl_ref5!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_cl_ref5, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id5 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
							//	$next_cl_ref4  =  $row->referredByCode;   //No  Next refferall chain
						
							if($ref_id5!= 0)
							{		
									if ($clt_ref_per_level5 != '0')
									{
									$text2 = 'Referrals Business loyalty for Invoice ID-'.$invoice_id;
									$ref_account_no = singleDbTableRow($ref_id5)->account_no;
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id5;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id5;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level5;

		
										$accounts_clr_ref5 = [
											'user_id'      			=> $ref_id5,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $clt_ref_per_level5,
											'amount'         		=> $user_amount,	
											'points_mode'           => $clt_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_clr_ref5); 	
									
									$sms_user = $ref_id5;								
									$tran = '1'; // "1" if 'Credit' == 0 & no amount value -OR- "0" if 'debit' == 0 & no amount value 							
									$sms_total = $clt_ref_per_level5;
									$pm_wallet = $clt_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
					
					
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref5 = [
									'user_id'         		=> $ref_id5,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level5,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level5, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
									}		
							}
	
						}
	
					}
					}
				}
				}
			}
			}
		}
	}
	
	
	
/*************************End of Client Ref Profit sharing***************************************/	


	
/***************************************************************************************
Business/Payspecification Commision for the Transaction Turnover

*********/
//Final Balance update	
		//$led_rulets2 = ($wallet_balance + $commission);
		
		

      		}    
		
//**********************************************************************************************************//
        //Determine if invoice insert success
        if($insertInvoice)
        {

           /**
                     * Send Email to customer Now
                     */



            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;" colspan="4">Total Price</td>
                        <td style="padding:5px;text-align:center;">'.$total_price.'</td>
                    </tr>';

            $email_data = [
                'userData'     => $customer_info,
                'tableRow'      => $HTMLrow
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');
            $subject = 'Hi '.user_full_name($customer_info).', your Transaction details @'.date('d-m-Y h:i a');
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($customer_info->email);
          //  $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('product_sell_email_tpl',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
            //Email END:



            return $invoice_id;
        }
        
		
}


}
//else{

            //set error message and go back
 //           setFlashGoBack('errorMsg', 'This Transaction Is Already Processed...!!!');
       
}
}

}
/***************************/
 public function dth_billpay_request(){
		
        $user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code  = singleDbTableRow($user_user_id)->referral_code;			
		$user_rolename	     = singleDbTableRow($user_user_id)->rolename;	
		$acct_email	    	 = singleDbTableRow($user_user_id)->email;			
		$user_mobile         = singleDbTableRow($user_user_id)->contactno;
		$user_fname          = singleDbTableRow($user_user_id)->first_name;
		$user_account_no     = singleDbTableRow($user_user_id)->account_no; 
		
		$amount              = $this->input->post('dth_amount');
			
		$type = 'Recharge';	
	
		
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
	
		$otp  = $this->product_model->generatePIN();				   //4 digits Unique OTP_code
				
		$payee_referredCode = '1133331111'; //Bill Payments Reciever ID

	$payby_consumer_id 	= $user_referral_code;  //Payer's Account			
	$payto_consumer_id 	= $payee_referredCode;
	$payby_rolename = $user_rolename;	
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payto_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payee_user_id 		 = $r->id;
				$payee_rolename		 = $r->rolename;
				$payee_email		 = $r->email;
				$payee_name          = $r->first_name.' '.$r->last_name;
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
				$fname       = $payee_name;
				$pay_by		 = $payee_pay_by;
				$account_no  = $payee_account_no ; 

/******Automatically Payspecification will be Identified by two users **************/	

		$table_name = "commissions";
		$where_array = array('from_role' =>$payby_rolename, 'to_role' =>$payee_rolename, 'identity' =>'Commission');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
			
			
		$pay_type 			= $row->sub_acct_id;					//Ledger Deposit pay spec		
		$deduction_paytype	= $row->ded_paytype;		    //Ledger Deduction pay spec	
		$pay_from 			= $row->from_role;
		$pay_to 			= $row->to_role;
		
		}
	  
		if (($count == null)) 
					{ $count = '0';}
		$key_id = $count;
		
   
		$recharge_no  = $this->input->post('dth_no');
        $service_type = $this->input->post('service_type');
		$operator_id  = $this->input->post('dth_opt');
		$loc_id 	  = $this->input->post('dth_loc_id');
		
		
								/*$where_array = array('jolo_code' => $operator_id );
								$table = "services";
								$opt_type = $this->db->where($where_array)->get($table);
								foreach ($opt_type->result() as $r)
								{
									$service_category = $r->service_category;
								}*/	
								$service_category = 'DTH';
		
		//OTP transaction Table
        $data2 = [
			'active'				=> '0',
			'otp'					=> $otp,
			'type'					=> $type,
			'key_id'				=> $key_id,
			'pay_by'				=> $payby_consumer_id,  //Sender's ID
	    	'pay_type'         		=> '70',			                             //r
			'service_category'  	=> $service_category,									//r
			'recharge_no'  			=> $recharge_no,
			'operator_type'    		=> $operator_id,
			'location_id'   		=> $loc_id,
			'amount'         		=> $amount,			
			'ded_paytype'         	=> '70', //$deduction_paytype,										//r
            'company_name'			=> 'Recharge',
			'pay_to'				=> $payee_referredCode,  //Reciever's ID
			'payee_name'			=> $payee_name ,
			'payto_rolename'		=> $payee_rolename,
			'sms_no'				=> $user_mobile,
		//	'licence'				=> $company_licence,										//r
		//	'commission'       		=> $commission,  											//r	
            'created_at'            => time(), 
            'modified_at'           => time()
			
        ];
	
		
       $query2 = $this->db->insert('billpay_request', $data2);
	   
	   
        if($query2)
        {
            create_activity('Added '.$data['active'].' as payee payment'  ); //create an activity

            return true;
        }
        return false;

		}
	
	}
		
   
}
public function data_billpay_request(){
		
        $user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code  = singleDbTableRow($user_user_id)->referral_code;			
		$user_rolename	     = singleDbTableRow($user_user_id)->rolename;	
		$acct_email	    	 = singleDbTableRow($user_user_id)->email;			
		$user_mobile         = singleDbTableRow($user_user_id)->contactno;
		$user_fname          = singleDbTableRow($user_user_id)->first_name;
		$user_account_no     = singleDbTableRow($user_user_id)->account_no; 
		
		$amount              = $this->input->post('data_amount');
			
		$type = 'Recharge';	
	
		
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
	
		$otp  = $this->product_model->generatePIN();				   //4 digits Unique OTP_code
				
		$payee_referredCode = '1133331111'; //Bill Payments Reciever ID

	$payby_consumer_id 	= $user_referral_code;  //Payer's Account			
	$payto_consumer_id 	= $payee_referredCode;
	$payby_rolename = $user_rolename;	
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payto_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payee_user_id 		 = $r->id;
				$payee_rolename		 = $r->rolename;
				$payee_email		 = $r->email;
				$payee_name          = $r->first_name.' '.$r->last_name;
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
				$fname       = $payee_name;
				$pay_by		 = $payee_pay_by;
				$account_no  = $payee_account_no ; 

/******Automatically Payspecification will be Identified by two users **************/	

		$table_name = "commissions";
		$where_array = array('from_role' =>$payby_rolename, 'to_role' =>$payee_rolename, 'identity' =>'Commission');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
			
			
		$pay_type 			= $row->sub_acct_id;					//Ledger Deposit pay spec		
		$deduction_paytype	= $row->ded_paytype;		    //Ledger Deduction pay spec	
		$pay_from 			= $row->from_role;
		$pay_to 			= $row->to_role;
		
		}
	  
		if (($count == null)) 
					{ $count = '0';}
		$key_id = $count;
		
   
		$recharge_no  = $this->input->post('data_no');
        $service_type = $this->input->post('service_type');
		$operator_id  = $this->input->post('data_operator_id');
		$loc_id 	  = $this->input->post('data_loc_id');
		
		
								/*$where_array = array('jolo_code' => $operator_id );
								$table = "services";
								$opt_type = $this->db->where($where_array)->get($table);
								foreach ($opt_type->result() as $r)
								{
									$service_category = $r->service_category;
								}*/	
								$service_category = 'DATA CARD';
		
		//OTP transaction Table
        $data2 = [
			'active'				=> '0',
			'otp'					=> $otp,
			'type'					=> $type,
			'key_id'				=> $key_id,
			'pay_by'				=> $payby_consumer_id,  //Sender's ID
	    	'pay_type'         		=> '70',			                             //r
			'service_category'  	=> $service_category,									//r
			'recharge_no'  			=> $recharge_no,
			'operator_type'    		=> $operator_id,
			'location_id'   		=> $loc_id,
			'amount'         		=> $amount,			
			'ded_paytype'         	=> '70', //$deduction_paytype,										//r
            'company_name'			=> 'Recharge',
			'pay_to'				=> $payee_referredCode,  //Reciever's ID
			'payee_name'			=> $payee_name ,
			'payto_rolename'		=> $payee_rolename,
			'sms_no'				=> $user_mobile,
		//	'licence'				=> $company_licence,										//r
		//	'commission'       		=> $commission,  											//r	
            'created_at'            => time(), 
            'modified_at'           => time()
			
        ];
	
		
       $query2 = $this->db->insert('billpay_request', $data2);
	   
	   
        if($query2)
        {
            create_activity('Added '.$data['active'].' as payee payment'  ); //create an activity

            return true;
        }
        return false;

		}
	
	}
		
   
}
//
public function broad_billpay_request(){
		
        $user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code  = singleDbTableRow($user_user_id)->referral_code;			
		$user_rolename	     = singleDbTableRow($user_user_id)->rolename;	
		$acct_email	    	 = singleDbTableRow($user_user_id)->email;			
		$user_mobile         = singleDbTableRow($user_user_id)->contactno;
		$user_fname          = singleDbTableRow($user_user_id)->first_name;
		$user_account_no     = singleDbTableRow($user_user_id)->account_no; 
		
		$amount              = $this->input->post('broad_amount');
			
		$type = 'Recharge';	
	
		
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
	
		$otp  = $this->product_model->generatePIN();				   //4 digits Unique OTP_code
				
		$payee_referredCode = '1133331111'; //Bill Payments Reciever ID

	$payby_consumer_id 	= $user_referral_code;  //Payer's Account			
	$payto_consumer_id 	= $payee_referredCode;
	$payby_rolename = $user_rolename;	
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payto_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payee_user_id 		 = $r->id;
				$payee_rolename		 = $r->rolename;
				$payee_email		 = $r->email;
				$payee_name          = $r->first_name.' '.$r->last_name;
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
				$fname       = $payee_name;
				$pay_by		 = $payee_pay_by;
				$account_no  = $payee_account_no ; 

/******Automatically Payspecification will be Identified by two users **************/	

		$table_name = "commissions";
		$where_array = array('from_role' =>$payby_rolename, 'to_role' =>$payee_rolename, 'identity' =>'Commission');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
			
			
		$pay_type 			= $row->sub_acct_id;					//Ledger Deposit pay spec		
		$deduction_paytype	= $row->ded_paytype;		    //Ledger Deduction pay spec	
		$pay_from 			= $row->from_role;
		$pay_to 			= $row->to_role;
		
		}
	  
		if (($count == null)) 
					{ $count = '0';}
		$key_id = $count;
		
   
		$recharge_no  = $this->input->post('broad_no');
        $service_type = $this->input->post('service_type');
		$operator_id  = $this->input->post('broad_opt');
		$post_acc 	  = $this->input->post('broad_acc');
		
		
								/*$where_array = array('jolo_code' => $operator_id );
								$table = "services";
								$opt_type = $this->db->where($where_array)->get($table);
								foreach ($opt_type->result() as $r)
								{
									$service_category = $r->service_category;
								}*/	
								$service_category = 'BROADBAND';
		
		//OTP transaction Table
        $data2 = [
			'active'				=> '0',
			'otp'					=> $otp,
			'type'					=> $type,
			'key_id'				=> $key_id,
			'pay_by'				=> $payby_consumer_id,  //Sender's ID
	    	'pay_type'         		=> '70',			                             //r
			'service_category'  	=> $service_category,									//r
			'recharge_no'  			=> $recharge_no,
			'operator_type'    		=> $operator_id,
			'amount'         		=> $amount,			
			'ded_paytype'         	=> '70', //$deduction_paytype,										//r
            'company_name'			=> 'Recharge',
			'pay_to'				=> $payee_referredCode,  //Reciever's ID
			'payee_name'			=> $payee_name ,
			'payto_rolename'		=> $payee_rolename,
			'sms_no'				=> $user_mobile,
			'account_no'				=> $post_acc,
		//	'licence'				=> $company_licence,										//r
		//	'commission'       		=> $commission,  											//r	
            'created_at'            => time(), 
            'modified_at'           => time()
			
        ];
	
		
       $query2 = $this->db->insert('billpay_request', $data2);
	   
	   
        if($query2)
        {
            create_activity('Added '.$data['active'].' as payee payment'  ); //create an activity

            return true;
        }
        return false;

		}
	
	}
		
   
}
//
public function elec_billpay_request(){
		
        $user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code  = singleDbTableRow($user_user_id)->referral_code;			
		$user_rolename	     = singleDbTableRow($user_user_id)->rolename;	
		$acct_email	    	 = singleDbTableRow($user_user_id)->email;			
		$user_mobile         = singleDbTableRow($user_user_id)->contactno;
		$user_fname          = singleDbTableRow($user_user_id)->first_name;
		$user_account_no     = singleDbTableRow($user_user_id)->account_no; 
		
		$amount              = $this->input->post('elec_amount');
			
		$type = 'Recharge';	
	
		
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
	
		$otp  = $this->product_model->generatePIN();				   //4 digits Unique OTP_code
				
		$payee_referredCode = '1133331111'; //Bill Payments Reciever ID

	$payby_consumer_id 	= $user_referral_code;  //Payer's Account			
	$payto_consumer_id 	= $payee_referredCode;
	$payby_rolename = $user_rolename;	
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payto_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payee_user_id 		 = $r->id;
				$payee_rolename		 = $r->rolename;
				$payee_email		 = $r->email;
				$payee_name          = $r->first_name.' '.$r->last_name;
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
				$fname       = $payee_name;
				$pay_by		 = $payee_pay_by;
				$account_no  = $payee_account_no ; 

/******Automatically Payspecification will be Identified by two users **************/	

		$table_name = "commissions";
		$where_array = array('from_role' =>$payby_rolename, 'to_role' =>$payee_rolename, 'identity' =>'Commission');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
			
			
		$pay_type 			= $row->sub_acct_id;					//Ledger Deposit pay spec		
		$deduction_paytype	= $row->ded_paytype;		    //Ledger Deduction pay spec	
		$pay_from 			= $row->from_role;
		$pay_to 			= $row->to_role;
		
		}
	  
		if (($count == null)) 
					{ $count = '0';}
		$key_id = $count;
		
   
		$recharge_no  = $this->input->post('elec_no');
        $service_type = $this->input->post('service_type');
		$operator_id  = $this->input->post('elec_opt');
		
		
		
								/*$where_array = array('jolo_code' => $operator_id );
								$table = "services";
								$opt_type = $this->db->where($where_array)->get($table);
								foreach ($opt_type->result() as $r)
								{
									$service_category = $r->service_category;
								}*/	
								$service_category = 'ELECTRICITY';
		
		//OTP transaction Table
        $data2 = [
			'active'				=> '0',
			'otp'					=> $otp,
			'type'					=> $type,
			'key_id'				=> $key_id,
			'pay_by'				=> $payby_consumer_id,  //Sender's ID
	    	'pay_type'         		=> '70',			                             //r
			'service_category'  	=> $service_category,									//r
			'recharge_no'  			=> $recharge_no,
			'operator_type'    		=> $operator_id,
			'amount'         		=> $amount,			
			'ded_paytype'         	=> '70', //$deduction_paytype,										//r
            'company_name'			=> 'Recharge',
			'pay_to'				=> $payee_referredCode,  //Reciever's ID
			'payee_name'			=> $payee_name ,
			'payto_rolename'		=> $payee_rolename,
			'sms_no'				=> $user_mobile,
			
		//	'licence'				=> $company_licence,										//r
		//	'commission'       		=> $commission,  											//r	
            'created_at'            => time(), 
            'modified_at'           => time()
			
        ];
	
		
       $query2 = $this->db->insert('billpay_request', $data2);
	   
	   
        if($query2)
        {
            create_activity('Added '.$data['active'].' as payee payment'  ); //create an activity

            return true;
        }
        return false;

		}
	
	}
		
   
}
public function gas_billpay_request(){
		
        $user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code  = singleDbTableRow($user_user_id)->referral_code;			
		$user_rolename	     = singleDbTableRow($user_user_id)->rolename;	
		$acct_email	    	 = singleDbTableRow($user_user_id)->email;			
		$user_mobile         = singleDbTableRow($user_user_id)->contactno;
		$user_fname          = singleDbTableRow($user_user_id)->first_name;
		$user_account_no     = singleDbTableRow($user_user_id)->account_no; 
		
		$amount              = $this->input->post('gas_amount');
			
		$type = 'Recharge';	
	
		
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
	
		$otp  = $this->product_model->generatePIN();				   //4 digits Unique OTP_code
				
		$payee_referredCode = '1133331111'; //Bill Payments Reciever ID

	$payby_consumer_id 	= $user_referral_code;  //Payer's Account			
	$payto_consumer_id 	= $payee_referredCode;
	$payby_rolename = $user_rolename;	
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payto_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payee_user_id 		 = $r->id;
				$payee_rolename		 = $r->rolename;
				$payee_email		 = $r->email;
				$payee_name          = $r->first_name.' '.$r->last_name;
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
				$fname       = $payee_name;
				$pay_by		 = $payee_pay_by;
				$account_no  = $payee_account_no ; 

/******Automatically Payspecification will be Identified by two users **************/	

		$table_name = "commissions";
		$where_array = array('from_role' =>$payby_rolename, 'to_role' =>$payee_rolename, 'identity' =>'Commission');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
			
			
		$pay_type 			= $row->sub_acct_id;					//Ledger Deposit pay spec		
		$deduction_paytype	= $row->ded_paytype;		    //Ledger Deduction pay spec	
		$pay_from 			= $row->from_role;
		$pay_to 			= $row->to_role;
		
		}
	  
		if (($count == null)) 
					{ $count = '0';}
		$key_id = $count;
		
   
		$recharge_no  = $this->input->post('gas_no');
        $service_type = $this->input->post('service_type');
		$operator_id  = $this->input->post('gas_opt');
		
		
		
								/*$where_array = array('jolo_code' => $operator_id );
								$table = "services";
								$opt_type = $this->db->where($where_array)->get($table);
								foreach ($opt_type->result() as $r)
								{
									$service_category = $r->service_category;
								}*/	
								$service_category = 'GAS';
		
		//OTP transaction Table
        $data2 = [
			'active'				=> '0',
			'otp'					=> $otp,
			'type'					=> $type,
			'key_id'				=> $key_id,
			'pay_by'				=> $payby_consumer_id,  //Sender's ID
	    	'pay_type'         		=> '70',			                             //r
			'service_category'  	=> $service_category,									//r
			'recharge_no'  			=> $recharge_no,
			'operator_type'    		=> $operator_id,
			'amount'         		=> $amount,			
			'ded_paytype'         	=> '70', //$deduction_paytype,										//r
            'company_name'			=> 'Recharge',
			'pay_to'				=> $payee_referredCode,  //Reciever's ID
			'payee_name'			=> $payee_name ,
			'payto_rolename'		=> $payee_rolename,
			'sms_no'				=> $user_mobile,
			
		//	'licence'				=> $company_licence,										//r
		//	'commission'       		=> $commission,  											//r	
            'created_at'            => time(), 
            'modified_at'           => time()
			
        ];
	
		
       $query2 = $this->db->insert('billpay_request', $data2);
	   
	   
        if($query2)
        {
            create_activity('Added '.$data['active'].' as payee payment'  ); //create an activity

            return true;
        }
        return false;

		}
	
	}
		
   
}
//
public function post_billpay_request(){
		
        $user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code  = singleDbTableRow($user_user_id)->referral_code;			
		$user_rolename	     = singleDbTableRow($user_user_id)->rolename;	
		$acct_email	    	 = singleDbTableRow($user_user_id)->email;			
		$user_mobile         = singleDbTableRow($user_user_id)->contactno;
		$user_fname          = singleDbTableRow($user_user_id)->first_name;
		$user_account_no     = singleDbTableRow($user_user_id)->account_no; 
		
		$amount              = $this->input->post('post_amount');
			
		$type = 'Recharge';	
	
		
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
	
		$otp  = $this->product_model->generatePIN();				   //4 digits Unique OTP_code
				
		$payee_referredCode = '1133331111'; //Bill Payments Reciever ID

	$payby_consumer_id 	= $user_referral_code;  //Payer's Account			
	$payto_consumer_id 	= $payee_referredCode;
	$payby_rolename = $user_rolename;	
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payto_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payee_user_id 		 = $r->id;
				$payee_rolename		 = $r->rolename;
				$payee_email		 = $r->email;
				$payee_name          = $r->first_name.' '.$r->last_name;
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
				$fname       = $payee_name;
				$pay_by		 = $payee_pay_by;
				$account_no  = $payee_account_no ; 

/******Automatically Payspecification will be Identified by two users **************/	

		$table_name = "commissions";
		$where_array = array('from_role' =>$payby_rolename, 'to_role' =>$payee_rolename, 'identity' =>'Commission');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
			
			
		$pay_type 			= $row->sub_acct_id;					//Ledger Deposit pay spec		
		$deduction_paytype	= $row->ded_paytype;		    //Ledger Deduction pay spec	
		$pay_from 			= $row->from_role;
		$pay_to 			= $row->to_role;
		
		}
	  
		if (($count == null)) 
					{ $count = '0';}
		$key_id = $count;
		
   
		$recharge_no  = $this->input->post('post_no');
        $service_type = $this->input->post('service_type');
		$operator_id  = $this->input->post('post_opt');
		$post_acc 	  = $this->input->post('post_acc');
		
		
								/*$where_array = array('jolo_code' => $operator_id );
								$table = "services";
								$opt_type = $this->db->where($where_array)->get($table);
								foreach ($opt_type->result() as $r)
								{
									$service_category = $r->service_category;
								}*/	
								$service_category = 'POSTPAID';
		
		//OTP transaction Table
        $data2 = [
			'active'				=> '0',
			'otp'					=> $otp,
			'type'					=> $type,
			'key_id'				=> $key_id,
			'pay_by'				=> $payby_consumer_id,  //Sender's ID
	    	'pay_type'         		=> '70',			                             //r
			'service_category'  	=> $service_category,									//r
			'recharge_no'  			=> $recharge_no,
			'operator_type'    		=> $operator_id,
			'amount'         		=> $amount,			
			'ded_paytype'         	=> '70', //$deduction_paytype,										//r
            'company_name'			=> 'Recharge',
			'pay_to'				=> $payee_referredCode,  //Reciever's ID
			'payee_name'			=> $payee_name ,
			'payto_rolename'		=> $payee_rolename,
			'sms_no'				=> $user_mobile,
			'account_no'				=> $post_acc,
		//	'licence'				=> $company_licence,										//r
		//	'commission'       		=> $commission,  											//r	
            'created_at'            => time(), 
            'modified_at'           => time()
			
        ];
	
		
       $query2 = $this->db->insert('billpay_request', $data2);
	   
	   
        if($query2)
        {
            create_activity('Added '.$data['active'].' as payee payment'  ); //create an activity

            return true;
        }
        return false;

		}
	
	}
		
   
}
/////
//
public function land_billpay_request(){
		
        $user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code  = singleDbTableRow($user_user_id)->referral_code;			
		$user_rolename	     = singleDbTableRow($user_user_id)->rolename;	
		$acct_email	    	 = singleDbTableRow($user_user_id)->email;			
		$user_mobile         = singleDbTableRow($user_user_id)->contactno;
		$user_fname          = singleDbTableRow($user_user_id)->first_name;
		$user_account_no     = singleDbTableRow($user_user_id)->account_no; 
		
		$amount              = $this->input->post('land_amount');
			
		$type = 'Recharge';	
	
		
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
	
		$otp  = $this->product_model->generatePIN();				   //4 digits Unique OTP_code
				
		$payee_referredCode = '1133331111'; //Bill Payments Reciever ID

	$payby_consumer_id 	= $user_referral_code;  //Payer's Account			
	$payto_consumer_id 	= $payee_referredCode;
	$payby_rolename = $user_rolename;	
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payto_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payee_user_id 		 = $r->id;
				$payee_rolename		 = $r->rolename;
				$payee_email		 = $r->email;
				$payee_name          = $r->first_name.' '.$r->last_name;
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
				$fname       = $payee_name;
				$pay_by		 = $payee_pay_by;
				$account_no  = $payee_account_no ; 

/******Automatically Payspecification will be Identified by two users **************/	

		$table_name = "commissions";
		$where_array = array('from_role' =>$payby_rolename, 'to_role' =>$payee_rolename, 'identity' =>'Commission');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
			
			
		$pay_type 			= $row->sub_acct_id;					//Ledger Deposit pay spec		
		$deduction_paytype	= $row->ded_paytype;		    //Ledger Deduction pay spec	
		$pay_from 			= $row->from_role;
		$pay_to 			= $row->to_role;
		
		}
	  
		if (($count == null)) 
					{ $count = '0';}
		$key_id = $count;
		
   
		$recharge_no  = $this->input->post('land_no');
        $service_type = $this->input->post('service_type');
		$operator_id  = $this->input->post('land_opt');
		$land_acc 	  = $this->input->post('land_acc');
		$land_std 	  = $this->input->post('land_std');
		
		
								/*$where_array = array('jolo_code' => $operator_id );
								$table = "services";
								$opt_type = $this->db->where($where_array)->get($table);
								foreach ($opt_type->result() as $r)
								{
									$service_category = $r->service_category;
								}*/	
								$service_category = 'LANDLINE';
		
		//OTP transaction Table
        $data2 = [
			'active'				=> '0',
			'otp'					=> $otp,
			'type'					=> $type,
			'key_id'				=> $key_id,
			'pay_by'				=> $payby_consumer_id,  //Sender's ID
	    	'pay_type'         		=> '70',			                             //r
			'service_category'  	=> $service_category,									//r
			'recharge_no'  			=> $recharge_no,
			'operator_type'    		=> $operator_id,
			'amount'         		=> $amount,			
			'ded_paytype'         	=> '70', //$deduction_paytype,										//r
            'company_name'			=> 'Recharge',
			'pay_to'				=> $payee_referredCode,  //Reciever's ID
			'payee_name'			=> $payee_name ,
			'payto_rolename'		=> $payee_rolename,
			'sms_no'				=> $user_mobile,
			'account_no'				=> $land_acc,
			'std_code'				=> $land_std,
		//	'licence'				=> $company_licence,										//r
		//	'commission'       		=> $commission,  											//r	
            'created_at'            => time(), 
            'modified_at'           => time()
			
        ];
	
		
       $query2 = $this->db->insert('billpay_request', $data2);
	   
	   
        if($query2)
        {
            create_activity('Added '.$data['active'].' as payee payment'  ); //create an activity

            return true;
        }
        return false;

		}
	
	}
		
   
}
//
/**/

    public function billpay_request(){
		
        $user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code  = singleDbTableRow($user_user_id)->referral_code;			
		$user_rolename	     = singleDbTableRow($user_user_id)->rolename;	
		$acct_email	    	 = singleDbTableRow($user_user_id)->email;			
		$user_mobile         = singleDbTableRow($user_user_id)->contactno;
		$user_fname          = singleDbTableRow($user_user_id)->first_name;
		$user_account_no     = singleDbTableRow($user_user_id)->account_no; 
		
		$amount              = $this->input->post('amount');
			
		$type = 'Recharge';	
	
		
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
	
		$otp  = $this->product_model->generatePIN();				   //4 digits Unique OTP_code
				
		$payee_referredCode = '1133331111'; //Bill Payments Reciever ID

	$payby_consumer_id 	= $user_referral_code;  //Payer's Account			
	$payto_consumer_id 	= $payee_referredCode;
	$payby_rolename = $user_rolename;	
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payto_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payee_user_id 		 = $r->id;
				$payee_rolename		 = $r->rolename;
				$payee_email		 = $r->email;
				$payee_name          = $r->first_name.' '.$r->last_name;
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
				$fname       = $payee_name;
				$pay_by		 = $payee_pay_by;
				$account_no  = $payee_account_no ; 

/******Automatically Payspecification will be Identified by two users **************/	

		$table_name = "commissions";
		$where_array = array('from_role' =>$payby_rolename, 'to_role' =>$payee_rolename, 'identity' =>'Commission');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
			
			
		$pay_type 			= $row->sub_acct_id;					//Ledger Deposit pay spec		
		$deduction_paytype	= $row->ded_paytype;		    //Ledger Deduction pay spec	
		$pay_from 			= $row->from_role;
		$pay_to 			= $row->to_role;
		
		}
	  
		if (($count == null)) 
					{ $count = '0';}
		$key_id = $count;
		
   
		$recharge_no  = $this->input->post('recharge_no');
        $service_type = $this->input->post('service_type');
		$operator_id  = $this->input->post('operator_id');
		$loc_id 	  = $this->input->post('loc_id');
		
		
								/*$where_array = array('jolo_code' => $operator_id );
								$table = "services";
								$opt_type = $this->db->where($where_array)->get($table);
								foreach ($opt_type->result() as $r)
								{
									$service_category = $r->service_category;
								}*/	
								$service_category = 'Prepaid Mobile';
		
		//OTP transaction Table
        $data2 = [
			'active'				=> '0',
			'otp'					=> $otp,
			'type'					=> $type,
			'key_id'				=> $key_id,
			'pay_by'				=> $payby_consumer_id,  //Sender's ID
	    	'pay_type'         		=> '70',			                             //r
			'service_category'  	=> $service_category,									//r
			'recharge_no'  			=> $recharge_no,
			'operator_type'    		=> $operator_id,
			'location_id'   		=> $loc_id,
			'amount'         		=> $amount,			
			'ded_paytype'         	=> '70', //$deduction_paytype,										//r
            'company_name'			=> 'Recharge',
			'pay_to'				=> $payee_referredCode,  //Reciever's ID
			'payee_name'			=> $payee_name ,
			'payto_rolename'		=> $payee_rolename,
			'sms_no'				=> $user_mobile,
		//	'licence'				=> $company_licence,										//r
		//	'commission'       		=> $commission,  											//r	
            'created_at'            => time(), 
            'modified_at'           => time()
			
        ];
	
		
       $query2 = $this->db->insert('billpay_request', $data2);
	   
	   
        if($query2)
        {
            create_activity('Added '.$data['active'].' as payee payment'  ); //create an activity

            return true;
        }
        return false;

		}
	
	}
		
   
}
public function billstatus($new_satus, $new_txnid, $new_usertxn, $new_operator_ref, $new_operator, $new_country, $new_number, $new_amount, $new_amount_deducted, $new_message,$new_time, $new_error_code )
		
{ 

		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		if ($new_txnid == null)
		{ $new_txnid = "Please Wait for Some time" ;  }
		
  $billpay_data = [
                'status' 		  => $new_satus, 
			  	'txid'			  => $new_txnid, 
                'usertxn'  		  => $new_usertxn, 
				'operator_ref' 	  => $new_operator_ref, 
                'operator'     	  => $new_operator, 
                'country'    	  => $new_country,
				'number'    	  => $new_number, 			
                'amount'      	  => $new_amount, 
				'amount_deducted' => $new_amount_deducted, 
				'message' 		  => $new_message, 
				'time' 			  => time(),
				'user_id' 		  => $userID,
				'error_code' 	  => $new_error_code ,
                'created_at'      => time()
                
            ];
			

              $query2 = $this->db->insert('billpay_status', $billpay_data);
	   
	   
        if($query2)
        {
            create_activity('Added '.$billpay_data['status'].' as Bill Payment Status'  ); //create an activity

            return true;
        }
        return false;

	}				

/******************************************************************************************/
//Running CPA
//VPA Transfers     Payment     to     any      Partners
// 1st December 2016 -- Active Transaction --
//Anand 

/******************************************************************************************/
public function payee_transfer($id){
	
	$otp_data = $this->db->get_where('billpay_request', ['id' => $id]);
		foreach($otp_data->result() as $otp);
		
		{
			
			$paying_to  		= $otp->pay_to;		//Paying To Consumer ID
			$amount	    		= $otp->amount;		//Paying Amount	
			$paid_by			= $otp->pay_by;		//Paying By Consumer ID			
			$pay_type   		= $otp->pay_type;   //Pay Specification
			$tranx_id   		= $otp->tranx_id;
			$table_otp	   		= $otp->otp;
			$transaction_type 	= $otp->type;
			$active				= $otp->active;	
			$recharge_no 		= $otp->recharge_no;
			$operator_type 		= $otp->operator_type;
	     	$service_category   = $otp->service_category;
			
			
		$user_otp = $this->input->post('otp');
//Very Important changing parties for send/receive based on Radio button selection		

			$pay_by = $paid_by;
			$pay_to = $paying_to;
		
//Checking OTP Authentication for the Transactions				
		if ($table_otp == $user_otp and $active == '0')
	{
/*-----------------------------------------------------------------------------------------------------*/		
		//$status = $this->billpay_model->process_recharge($pay_by, $user_otp);
		 
		 
			
		$myorderid = substr(number_format(time() * rand(),0,'',''),0,15);
		$opt = $operator_type; //$_POST['opt'];
		$mobile = $recharge_no; //$_POST['mobile'];
		$amount = $amount; //$_POST['amount'];
		
			$format='json';
			
		if ($pay_type == "70")
	//	if ($service_category == "recharge prepaid")
		{ 
		//	$mode='0';
		//	$key ='7add0404e7a711e6b49e04014a243c01';
			 // $key ='897158551373092';  //jolo
		//	$format='json';
			
					$ch = curl_init();
		            $timeout = 10; // set to zero for no timeout
					
					
					
					
	$myurl ="http://joloapi.com/api/recharge.php?mode=1&userid=anand12345&key=897158551373092&operator=$opt&service=$mobile&amount=$amount&orderid=$myorderid&type=text";
	
			
			curl_setopt ($ch, CURLOPT_URL, $myurl);
					curl_setopt ($ch, CURLOPT_HEADER, 0);
					curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
					$file_contents = curl_exec($ch);
					$curl_error = curl_errno($ch);
					curl_close($ch);
					// lets extract data from output for display to user and for updating databse
					$maindata = explode(",", $file_contents);
					$countdatas = count($maindata);
					

			
			if($countdatas > 2)
		{
			//recharge is success
			$joloapiorderid = $maindata[0]; 
			//it is joloapi.com generated order id
			$status = $maindata[1]; //it is status of recharge SUCCESS,FAILED
			$re_operator= $maindata[2]; //operator code
			$service= $maindata[3]; //mobile number
			$re_amount= $maindata[4]; //amount
			$usertxn= $maindata[5]; //your website order id
			$errorcode= $maindata[6]; // api error code
			$txnid= $maindata[7]; //original operator transaction id
			$operator_ref=$maindata[7];//original operator transaction id
			$balance= $maindata[8]; //my joloapi.com remaining balance
			$myapiprofit= $maindata[9]; //my earning on this recharge
			$txntime= $maindata[10]; // recharge time
			$cntry=91;
			$amount_ded=$maindata[9];
			$message=0;
		}
		else
		{
			//recharge is failed
			$status = $maindata[0]; //it is status of recharge FAILED
			$errorcode = $maindata[1]; // api error code
			$message = 'jolo Recharge'; //$classObj->Get_Recharge_Error($errorcode);//error message
		}
		
		//if curl request timeouts
		
		if($curl_error=='28')
		{
			//Request timeout, consider recharge status as pending/success
			$status = "PENDING";
		}		


if ($status == 'SUCCESS' )  //die('Please Re-check the number details again and Try After 2 minutes...!');		
{		$new_satus 			 = $status; 		 
		$new_txnid 			 = $txnid; 
		$new_usertxn 		 = $usertxn; 
		$new_operator_ref 	 = $operator_ref;  
		$new_operator 		 = $re_operator; 
		$new_country		 = $cntry; 
		$new_number 		 = $service;
		$new_amount 		 = $re_amount;
		$new_amount_deducted = $amount_ded; 
		$new_message 		 = 'Recharge Successful';// $json['message'];
		$new_time 			 = $txntime;
		$new_error_code 	 =  $errorcode;	
	
	}elseif($status == 'FAILED')
{		$new_satus 			 = $status; 		 
		$new_txnid 			 = 'NA'; 
		$new_usertxn 		 = 'NA'; 
		$new_operator_ref 	 = 'NA'; 
		$new_operator 		 = $opt; 
		$new_country		 = 'NA'; 
		$new_number 		 = $mobile; 
		$new_amount 		 = $amount; 
		$new_amount_deducted = 'NA'; 
		$new_message 		 = 'Not Recharged';// $json['message'];
		$new_time 			 = $txntime;
		$new_error_code 	 = $errorcode; 	
	
}elseif($status == 'PENDING')
{		$new_satus 			 = $status; 		 
		$new_txnid 			 = $txnid; 
		$new_usertxn 		 = $usertxn; 
		$new_operator_ref 	 = $operator_ref;  
		$new_operator 		 = $operator; 
		$new_country		 = $country; 
		$new_number 		 = $number;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount_deducted; 
		$new_message 		 = 'Pending';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';
		
} elseif($status == 'REVERSED')
{		$new_satus 			 = $status; 		 
		$new_txnid 			 = $txnid; 
		$new_usertxn 		 = $usertxn; 
		$new_operator_ref 	 = $operator_ref;  
		$new_operator 		 = $operator; 
		$new_country		 = $country; 
		$new_number 		 = $number;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount_deducted; 
		$new_message 		 = 'REVERSED';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';
} elseif($status == 'DISPUTE')
{		$new_satus 			 = $status; 		 
		$new_txnid 			 = $txnid; 
		$new_usertxn 		 = $usertxn; 
		$new_operator_ref 	 = $operator_ref;  
		$new_operator 		 = $operator; 
		$new_country		 = $country; 
		$new_number 		 = $number;
		$new_amount 		 = $amount;
		$new_amount_deducted = $amount_deducted; 
		$new_message 		 = 'DISPUTE';
		$new_time 			 = 'NA';
		$new_error_code 	 = 'NA';	
	
}

		
	   $billstatus = $this->billpay_model->billstatus($new_satus, $new_txnid, $new_usertxn, $new_operator_ref, $new_operator, $new_country, $new_number, $new_amount, $new_amount_deducted, $new_message,$new_time ,$new_error_code );
			
			

			
/*-----------------------------------------------------------------------------------------------------*/        
	if($status == 'SUCCESS' ) //or $status == 'PENDING')
		
	{
		$proceed = '01';
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
			
			$table_name = "users";			
			$where_array = array('referral_code' => $pay_to);      //Sponsorship fees Paying User 'pay_to'
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$pay_to_userID		  = $r->id;
					$pay_to_first_name    = $r->first_name;
					$pay_to_last_name     = $r->last_name;             
				    $pay_to_email         = $r->email;
					$pay_to_dob			  = $r->date_of_birth;
					$pay_to_adhaar_no     = $r->adhaar_no;
					$pay_to_account_no    = $r->account_no;
					$pay_to_rolename      = $r->rolename;
				    $pay_to_country       = $r->country;
				    $pay_to_country_id    = $r->country_id;			
					$pay_to_photoName     = $r->photo;
				}
			}
		
       $c_id = $pay_to_userID;
	   
       $customer_info = singleDbTableRow($c_id);

        
        //get customer referral Code
        $customer_referral_id = $customer_info->referral_code;
		$rolename 	  		  = $customer_info->rolename; //User type
		
        $customer_id = $customer_info->id;
		$account_no  = $customer_info->account_no;
		$role 		 = $customer_info->role;	
		
		
/****To create Invoice for Transactions*/

        //Get ID From currently logged in User
        $sales_by = $this->session->userdata('logged_user')['user_id'];
	
        $qty 			= '1'; 		//$this->input->post('qty');
        $productName 	= $tranx_id; //'Test Remarks' ; //$this->input->post('productName');
        $categories 	= $pay_type; //$this->input->post('categories');
        $itemCost 		= $amount; 	//$this->input->post('amount');

        $totalProduct = '1'; //count($qty);
		$itemPrice =  $itemCost  ;
		
        $invoiceData = [
            'total_product'         => $totalProduct,
			//'total_price'           => $itemPrice,			
            'customer_id'           => $customer_id,
            'customer_referral_id'  => $customer_referral_id,
            'sales_by'              => $pay_by_userID, //$sales_by,
            'created_at'            => time(),
            'modified_at'           => time(),
        ];

        $insertInvoice = $this->db->insert('invoice', $invoiceData);

        $invoice_id = $this->db->insert_id();

        // Get Each sales Item and insert to sales_item table

        $HTMLrow = '';

        for($i = 0; $i < $totalProduct; $i++)
        {
            $quantity = $qty[$i];


	        $categoryID 	= $categories;   	//payspecification ID
		    $product_name	= $productName;
            $price 			= $amount; 				//$itemPrice[$i] * $quantity;
            $total_price 	= $amount; 		//$price;


			$acct_id1 		= $pay_type; //$this->input->post('sub_account');
			$seller_info 	= $this->session->userdata('logged_user');
			$sellerID	 	= $pay_by_userID	; // 	$sales_by;
			$seller_role	= singleDbTableRow($sellerID)->rolename;
			
			$client_id 		= $pay_to_userID;
			$client_info 	= singleDbTableRow($client_id, 'users') ;		
						
			$client_role = $client_info->rolename;			
			
			$acct_id = $acct_id1;
			
		$commission_per1 = '0'; //$r->commission;
		$benefits_per1 = '0'; //$r->benefits;
			
			/*************************************************************************************/
            $sales_itemData = [
                'category_id'   => $acct_id,
                'product_name'  => $product_name,
                'invoice_id'    => $invoice_id,
                'qty'           => $quantity,
                'item_price'    => $price, //$itemPrice[$i],
                'price'         => $price,
				'commission'    => $commission_per1, //$commission,				
                'benefits'      => $benefits_per1,
                'created_at'    => time(),
                'modified_at'   => time(),
            ];

            $sales_itemInsert = $this->db->insert('sales_item', $sales_itemData);

			
            //HTML For Email
            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;">'.'1'.'</td>
                        <td style="padding:5px;text-align:center;">'.$product_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$amount.'</td>
                        <td style="padding:5px;text-align:center;">'.$quantity.'</td>
                        <td style="padding:5px;text-align:center;">'.$price.'</td>
                    </tr>';


        }
        //Anand Code starts here Section for Commision & Benefits
/**********************
 Table update Response To the Recieving Partner from the Money sender user
*************************/
		 $total_price = $amount; // array_sum($total_price);
			
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$sales_role =  $user['role'];	
		
		$referral_code = singleDbTableRow($pay_by_userID)->referral_code;
		$first_name1 = singleDbTableRow($pay_by_userID)->first_name;
		
		$c_account_no = singleDbTableRow($pay_to_userID)->account_no;
		
		$wallet_balance = $this->input->post('wallet_balance');
		
	
//Benefits details To the Recieving Partner for data retrival 

       // S E N D E R
//pay_by_userID is Seller/Current User who is sending money
		$pm_wallet 	   = 'wallet';		
		$acct_id 	   = $pay_type; //$this->input->post('sub_account');			
		$user_info 	   = $this->session->userdata('logged_user');
        $user_id 	   = $pay_by_userID;
		$email 		   = singleDbTableRow($pay_by_userID)->email;
		$currentUser   = singleDbTableRow($pay_by_userID)->role;
		$sel_ref_code  = singleDbTableRow($pay_by_userID)->referral_code;
		$sel_ref_by    = singleDbTableRow($pay_by_userID)->referredByCode;   //Key field to get 5 level Network
		$seller_role   = singleDbTableRow($pay_by_userID)->rolename;		
		
		$seller_rolename   = typeDbTableRow($seller_role)->rolename;     //Role Description
		$seller_account_no = singleDbTableRow($pay_by_userID)->account_no;	
		$seller_email      = singleDbTableRow($pay_by_userID)->email;	
		
		
		
		
		// R E C I E V E R
//pay_to_userID is Client/Beneficiary User	who is reciving money
		$client_id 		 = $pay_to_userID;
		$client_role  	 = singleDbTableRow($pay_to_userID)->rolename;	  // Role ID		
		$client_rolename = typeDbTableRow($client_role)->rolename;    //Role Description
		$client_email    = singleDbTableRow($pay_to_userID)->email;	
		$client_name  	 = singleDbTableRow($pay_to_userID)->first_name;	
		$clt_ref_code 	 = singleDbTableRow($pay_to_userID)->referral_code;	
		$clt_ref_by   	 = singleDbTableRow($pay_to_userID)->referredByCode; //Key field to get 5 level Network
		$agreed_per 	 = '0';
		$agreed_per      = singleDbTableRow($pay_to_userID)->agreed_per;
		
		
	// Insert data for Accounts-VPA debit "To the Recieving Partner"	
		$tranx_id1 		  = 'Paid by '.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id;

//Get Individual Account transactions series Id	
$acct_user 		= $c_id;
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 
{	foreach ($result_count->result() as $r)
	{       $value 		= $r->tran_count;  	
		    $tran_count = $value + 1;	
	}			
}if ($tran_count == null)
{	$tran_count = '1';}

//End of Individual Account transactions Id	
/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $c_id;
		$user_amount    = 0;
		$points_mode 	= $pm_wallet;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $total_price;
		
		
	
	//Recieving/Client/passive user
	   $accounts1 = [
            'user_id'      			=> $c_id,        //To the Recieving Partner  
			'email'         	    => $client_email,
			'account_no'         	=> $c_account_no,
            'rolename'  		    => $client_role,
			'paid_to'         		=> $user_id,      //From the Money sender user 
            'pay_type'         		=> $acct_id,      //Payspecification ID
			'debit'         		=> $total_price,
			'credit'         		=> '0',
			'amount'         		=> $user_amount, //$total_price,						
			'tranx_id'				=> $tranx_id1,
			'points_mode'           => $pm_wallet,
			'tran_count'			=> $tran_count,
			'used'					=> 'yes',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

	$this->db->insert('accounts', $accounts1);


	$tran = '1'; // 0- Credit 1- debit
	$sms_user = $c_id;
	$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
	
		
	//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
  
	$remarks1 = 'Ledger Update: Paid by'.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id;
		$ledger1 = [
            'user_id'         		=> $c_id,             	//To the Recieving Partner  
			'pay_type'				=> $acct_id, 			//Deduction Pay Specification	
			'account_no'         	=> $c_account_no,		//Member Account No
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
			'debit'         		=> $total_price,
			'credit'         		=> '0',
			'amount'         		=> $total_price,	
			'points_mode'           => $pm_wallet,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks1,             //Description
			'count'					=> 'yes',
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $this->db->insert('ledger', $ledger1);	
		
	
		
		$tranx_id2 = "Paid to '".$client_rolename.'-'.$client_name."' for the Invoice ID-".$invoice_id;
		
	//Sender/Seller/Active user
	
	
								$user_debit  	= $this->product_model->total_debit($userID, $points_mode);
								$user_credit  	= $this->product_model->total_credit($userID, $points_mode);
							
		
//Get Individual Account transactions Id
	
$acct_user 		= $user_id;		
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 
{	foreach ($result_count->result() as $r)
	{       $value 		= $r->tran_count;  					
			$tran_count = $value + 1;				
	}							
}
//End of Individual Account transactions Id	
		
/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $user_id;
		$user_amount    = 0;
		$points_mode 	= $pm_wallet;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $total_price;
		
	   $accounts2 = [
            'user_id'      			=> $user_id,        //From the Money sender user
			'email'         	    => $seller_email,
			'account_no'         	=> $seller_account_no,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,      // To the Recieving Partner  
            'pay_type'         		=> $acct_id,      //Payspecification ID
			'debit'         		=> '0',
			'credit'         		=> $total_price,
			'amount'         		=> $user_amount, //$total_price,						
			'tranx_id'				=> $tranx_id2,
			'points_mode'           => $pm_wallet,
			'tran_count'			=> $tran_count,
			'used'					=> 'yes',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

         $this->db->insert('accounts', $accounts2);
		
			$tran = '0'; // 0- Credit 1- debit
			$sms_user = $user_id;
			$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
			
	
	
		//Except Agent and Customer, recording rest of the transactions to Ledger
	if ($currentUser = 'admin' )	
	{   
		$remarks2 = "Ledger Update: Paid to '".$client_rolename.'-'.$client_name."' for the Invoice ID-".$invoice_id;
		$ledger2 = [
            'user_id'         		=> $user_id,             	//To the Recieving Partner  
			'pay_type'				=> $acct_id, 			    //Deduction Pay Specification	
			'account_no'         	=> $seller_account_no,		//Member Account No
			'email'					=> $seller_email,
			'rolename'  			=> $seller_role,
            'credit'         		=> $total_price,
			'debit'         		=> '0', 	
			'amount'         		=> $total_price, 
			'points_mode'           => 'wallet',
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks2,             //Description
			'count'					=> 'no',
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $this->db->insert('ledger', $ledger2);	
		
	}
	
/***********************************************************************************************/	
/* Updating OTP table as Data Processed													   */
/* 																							   */
/*																							   */
/***********************************************************************************************/
			 $data9 = [
           	'active'            => '1',            
            'modified_at'       => time()
        ];

       $query9 = $this->db->where('id', $id)->update('billpay_request', $data9);	
	   
/******Automatically Payspecification will be Identified and calculates the Percentage**************/	

		$table_name = "commissions";
			$where_array = array('sub_acct_id' =>$acct_id, 'from_role' =>$seller_role, 'to_role' =>$client_role, 'identity' =>'Commission');
			$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
		$points_mode    = $row->points_mode;
		$benefits_per   = $row->benefits;         
		$commission_per = $row->commission;      //Debit to Payspecification
		
		$deduction_paytype = $row->ded_paytype;		
		
		$profit_pm    	  = $row->profit_pm;
		$seller_profit    = $row->sender_profit;
		$client_profit    = $row->receiver_profit;
		
		$deduction_pm  	 = $row->deduction_pm;
		$seller_deduction = $row->sender_deduction;
		
		 if ($client_role == '13' && $agreed_per > 0 )
		 {
			 $client_deduction = $agreed_per;
		 }else{
			 $client_deduction = $row->receiver_deduction;
		 }
		
	//----------------------------------------------------------------------------------------------//
//*************************************//Profit to 'Seller'
		
        $seller_info = singleDbTableRow($pay_by_userID);
		$seller_account_no = $seller_info->account_no;  // $customer_info->referral_code;  
		$seller_benefits = (($total_price * $seller_profit) / '100' ) ; //Percentage value for Seller
		//Seller Loyality
		if ($seller_benefits != '0')
		{   $text5 = $seller_rolename.'- commission for Invoice ID-'.$invoice_id;
	
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_by_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_by_userID;
		$user_amount    = 0;
		$points_mode 	= $profit_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $seller_benefits;

										
	   $accounts5 = [
            'user_id'      			=> $pay_by_userID,          //From the Money sender user
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,           // To the Recieving Partner  
            'tranx_id'         		=> $text5,  	  //$pay_type,
			'credit'         		=> '0',
			'debit'         		=> $seller_benefits,
			'amount'         		=> $user_amount,	
			'points_mode'           => $profit_pm,
			'tran_count'			=> $tran_count,				
			'used'					=> 'no',
			'pay_type'				=> $acct_id,         //Debit from Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts5); 
		
		$sms_user = $pay_by_userID;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
		$sms_total = $seller_benefits;
		$pm_wallet = $profit_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );

						
		//Deduction of commission from Ledger Table with Respective Payspecification and passing the
		//same value to the respective Benefitiary
		   $remarks6 = $seller_rolename.'- commission for Invoice ID-'.$invoice_id;
        $data6 = [
            'user_id'         		=> $pay_by_userID,              //From the Money sender user
			'pay_type'				=> $deduction_paytype,   //Deduction from Pay Specification	
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
			'rolename'  			=> $seller_role,
            'credit'         		=> $seller_benefits,
			'debit'         		=> '0', 	
			'amount'         		=> $seller_benefits, 
			'points_mode'           => $profit_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks6,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data6);
		}
//----------------------------------------------------------------------------------------------//
//*************************************//Profit to 'Client'
	
	
	
	
	
	
//$deduction_paytype for Deduction
		$ded_payspec1 = "Commission Deducted from Pay Spec No -". $deduction_paytype ;
					
		
		$client_benefits = (($total_price * $client_profit) / '100' ) ; //Percentage value for Client
	if ($client_benefits != '0')	
	{	$tranx_id3 = $client_rolename.'- commission for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_to_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_to_userID;
		$user_amount    = 0;
		$points_mode 	= $profit_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $client_benefits;
		
	   $accounts3 = [
            'user_id'      			=> $pay_to_userID,          //To the Recieving Partner  
			'account_no'         	=> $c_account_no,
            'rolename'  			=> $client_role,
			'email'					=> $client_email,
			'paid_to'         		=> $userID,       //From the Money sender user 
            'tranx_id'         		=> $tranx_id3,
			'credit'         		=> '0',
			'debit'         		=> $client_benefits,
			'amount'         		=> $user_amount,	
			'points_mode'           => $profit_pm,	
			'tran_count'			=> $tran_count,
			'used'					=> 'no',
		    'pay_type'				=> $acct_id,         //Debit from Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts3); 
		$sms_user = $c_id;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
		$sms_total = $client_benefits;
		$pm_wallet = $profit_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
		
	//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
			$remarks4 = $client_rolename.'- commission for Invoice ID -'.$invoice_id; 
        $data4 = [
            'user_id'         		=> $pay_to_userID,             		//To the Recieving Partner  
			'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
			'account_no'         	=> $c_account_no,			//Member Account No
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
            'credit'         		=> $client_benefits,
			'debit'         		=> '0', 	
			'amount'         		=> $client_benefits, 
			'points_mode'           => $profit_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks4,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data4);
	}
//----------------------------------------------------------------------------------------------//	 
//*****************************/Commission from 'Sender'





        $seller_info = singleDbTableRow($pay_by_userID);
		$seller_account_no = $seller_info->account_no;  // $customer_info->referral_code;  
		$seller_commission = '0';
		$seller_commission = (($total_price * $seller_deduction) / '100' ) ; //Percentage value for Seller
	if($seller_commission  != '0')	
	{	//Seller Loyality
	   $text9 = 'Commission deducted from -'.$seller_rolename.'-for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_by_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $pay_by_userID;
		$user_amount    = 0;
		$points_mode 	= $deduction_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $seller_commission;
		
	   $accounts9 = [
            'user_id'      			=> $pay_by_userID,          //From the Money sender user
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,           // To the Recieving Partner  
            'tranx_id'         		=> $text9,  	 
			'debit'         		=> '0',
			'credit'         		=> $seller_commission,
			'amount'         		=> $user_amount,	
			'points_mode'           => $deduction_pm,	
			'tran_count'			=> $tran_count,	
			'used'					=> 'yes',
			'pay_type'				=> $acct_id,		 //Deposit Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts9); 
		$sms_user = $pay_by_userID;								
		$tran = '0'; // "1" if 'Credit' == 0 & no amount value      -OR-                  *  "0" if 'debit' == 0 & no amount value 							
		$sms_total = $seller_commission;
		$pm_wallet = $deduction_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
						
		//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
		  $remarks10 = 'Commission deduction from -'.$seller_rolename.'-for Invoice ID -'.$invoice_id; 
        $data10 = [
            'user_id'         		=> $pay_by_userID,              //From the Money sender user
			'pay_type'				=> $acct_id,   //Deposit Pay Specification	
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
			'rolename' 			    => $seller_role,
            'debit'         		=> $seller_commission,
			'credit'         		=> '0', 	
			'amount'         		=> $seller_commission, 
			'points_mode'           => $deduction_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks10,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data10);	
	}	   
//----------------------------------------------------------------------------------------------//
//*****************************/Commission from 'Client' 





		$ded_payspec1 = "Benefits Deducted from Pay Spec No -". $acct_id ;
					
		$client_commission = '0';
		$client_commission = (($total_price * $client_deduction) / '100' ) ; //Percentage value for Client
		
	if($client_commission != '0')
	{	$tranx_id7 = 'Commission deduction from -'.$client_rolename.'-for Invoice ID -'.$invoice_id; 
		//Get Individual Account transactions Id
		
		$acct_user 		= $pay_to_userID;		
		$result_count  	= $this->product_model->get_tran_count($acct_user);		
		if($result_count -> num_rows() > 0) 
		{	foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  					
					$tran_count = $value + 1;				
			}							
		}else{
			$tran_count = 1;
		}
		//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $pay_to_userID;
		$user_amount    = 0;
		$points_mode 	= $deduction_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $client_commission;
		
	   $accounts7 = [
            'user_id'      			=> $pay_to_userID,          //To the Recieving Partner  
			'account_no'         	=> $c_account_no,
            'rolename'  			=> $client_role,
			'email'					=> $client_email,
			'paid_to'         		=> $userID,       //From the Money sender user 
            'tranx_id'         		=> $tranx_id7,
			'debit'         		=> '0',
			'credit'         		=> $client_commission,
			'amount'         		=> $user_amount,	
			'points_mode'           => $deduction_pm,	
			'tran_count'			=> $tran_count,	
			'used'					=> 'yes',
		    'pay_type'				=> $acct_id, //Deposit Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts7); 
		$sms_user = $pay_to_userID;								
		$tran = '0'; // "1" if 'Credit' == 0 & no amount value      -OR-                  *  "0" if 'debit' == 0 & no amount value 							
		$sms_total = $client_commission;
		$pm_wallet = $deduction_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
		
			$remarks8 = 'Commission deduction from -'.$client_rolename.'-for Invoice ID -'.$invoice_id; 	
        $data8 = [
            'user_id'         		=> $pay_to_userID,             	 //To the Recieving Partner  
			'pay_type'				=> $acct_id, 			 //Deposit Pay Specification	
			'account_no'         	=> $c_account_no,
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
            'debit'         		=> $client_commission,
			'credit'         		=> '0', 	
			'amount'         		=> $client_commission, 
			'points_mode'           => $deduction_pm,
            'invoice_id '  			=> $invoice_id,		
			'challan' 				=> 'no_invoice.jpg',			
			'remarks'         		=> $remarks8,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data8);	


	}	
		$slr_ref_pm  	 = $row->slr_ref_pm;	
		$slr_ref_level1  = $row->slr_ref_level1;		
		$slr_ref_level2  = $row->slr_ref_level2;	
		$slr_ref_level3  = $row->slr_ref_level3;	
		$slr_ref_level4  = $row->slr_ref_level4;	
		$slr_ref_level5  = $row->slr_ref_level5;	
		
		$clt_ref_pm  	 = $row->clt_ref_pm;	
		$clt_ref_level1  = $row->clt_ref_level1;
		$clt_ref_level2  = $row->clt_ref_level2;	
		$clt_ref_level3  = $row->clt_ref_level3;	
		$clt_ref_level4  = $row->clt_ref_level4;	
		$clt_ref_level5  = $row->clt_ref_level5;
				
				
//Function to do multiple activity				
				
		$slr_ref_per_level1  = (($total_price * $slr_ref_level1) / '100' ) ; //Percentage value for slr_ref_level1	
		$slr_ref_per_level2  = (($total_price * $slr_ref_level2) / '100' ) ; //Percentage value for slr_ref_level2	
		$slr_ref_per_level3  = (($total_price * $slr_ref_level3) / '100' ) ; //Percentage value for slr_ref_level3	
		$slr_ref_per_level4  = (($total_price * $slr_ref_level4) / '100' ) ; //Percentage value for slr_ref_level4	
		$slr_ref_per_level5  = (($total_price * $slr_ref_level5) / '100' ) ; //Percentage value for slr_ref_level5	

		$clt_ref_per_level1  = (($total_price * $clt_ref_level1) / '100' ) ; //Percentage value for clt_ref_level1			
		$clt_ref_per_level2  = (($total_price * $clt_ref_level2) / '100' ) ; //Percentage value for clt_ref_level2			
		$clt_ref_per_level3  = (($total_price * $clt_ref_level3) / '100' ) ; //Percentage value for clt_ref_level3			
		$clt_ref_per_level4  = (($total_price * $clt_ref_level4) / '100' ) ; //Percentage value for clt_ref_level4			
		$clt_ref_per_level5  = (($total_price * $clt_ref_level5) / '100' ) ; //Percentage value for clt_ref_level5			


/*********   Begin of  'seller' Referrals Commision for Level 1        *********/

		$table_name = "users";
		$where_array = array('referral_code' =>$sel_ref_by, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id1 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_sl_ref2  =  $row->referredByCode;           // Next referral chain
				
				if($ref_id1!= 0)
				{
		   			if ($slr_ref_per_level1 != '0')
						{
								$text1 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ref_account_no = singleDbTableRow($ref_id1)->account_no;
								
								//Update Debit balance
								$userID = $ref_id1;	$user_amount = '0';	
								$points_mode = $slr_ref_pm;
								$user_debit  	= $this->product_model->total_debit($userID, $points_mode);
								$user_credit  	= $this->product_model->total_credit($userID, $points_mode);
								$user_balance = '0'; //$user_debit - $user_credit;
								$user_amount = $user_balance + $slr_ref_per_level1;
								
								//Get Individual Account transactions Id
								
								$acct_user 		= $ref_id1;		
								$result_count  	= $this->product_model->get_tran_count($acct_user);		
								if($result_count -> num_rows() > 0) 
								{	foreach ($result_count->result() as $r)
									{       $value 		= $r->tran_count;  					
											$tran_count = $value + 1;				
									}							
								}
								//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id1;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level1;
								$accounts_ref1 = [
									'user_id'      			=> $ref_id1,          //To the Recieving Partner  
									'account_no'         	=> $ref_account_no,									
									'rolename'  			=> $rolename,
									'email'					=> $email,
									'paid_to'         		=> $paid_to,       //From the Money sender user 
									'tranx_id'         		=> $text1,
									'credit'         		=> '0',
									'debit'         		=> $slr_ref_per_level1,
									'amount'         		=> $user_amount, //$slr_ref_per_level1,	
									'points_mode'           => $slr_ref_pm,	
									'tran_count'			=> $tran_count,	
									'used'					=> 'no',
									'pay_type'				=> $deduction_paytype, //$invoice_id,		
									'created_at'            => time(),
									'modified_at'           => time()
								];

								$this->db->insert('accounts', $accounts_ref1); 
								
								$sms_user = $ref_id1;								
								$tran = '1'; // 1 if 'Credit' == 0 and 0 if 'debit' == 0								
								$sms_total = $slr_ref_per_level1;
								$pm_wallet = $slr_ref_pm;
								$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
								
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ledger_ref1 = [
									'user_id'         		=> $ref_id1,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level1,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level1, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref1);
						}
				}
		
	/*********             Referrals Commision for Level 2                    *********/
					if( $next_sl_ref2!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_sl_ref2, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id2 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
								$next_sl_ref3  =  $row->referredByCode;   //Next referral chain
						     if($ref_id2!= 0)
								{
									if ($slr_ref_per_level2 != '0')
									{
										$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
										$ref_account_no = singleDbTableRow($ref_id2)->account_no;
										
									
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id2;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id2;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level2;
										$accounts_ref2 = [
											'user_id'      			=> $ref_id2,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $slr_ref_per_level2,
											'amount'         		=> $user_amount, //$slr_ref_per_level2,	
											'points_mode'           => $slr_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_ref2); 	
									
									$sms_user = $ref_id2;								
									$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
									$sms_total = $slr_ref_per_level2;
									$pm_wallet = $slr_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
									
									
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;
									$ledger_ref2 = [
									'user_id'         		=> $ref_id2,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level2,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level2, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref2);
									}
						        }
						
/*********             Referrals Commision for Level 3                    *********/
								if( $next_sl_ref3!= 0)     ////Next refferal is Available? Proceed
								{
										$table_name = "users";
											$where_array = array('referral_code' =>$next_sl_ref3, 'active' => '1');
											$query = $this->db->where($where_array )->get($table_name); 
											foreach ($query->result() as $row)
											{	
													$ref_id3 	= $row->id;		
													$rolename	= $row->rolename;
													$email      = $row->email;
													$paid_to	= $row->id;
													$next_sl_ref4  =  $row->referredByCode;   //Next refferall chain
												if($ref_id3!= 0)
												{
												if ($slr_ref_per_level3 != '0')
												{	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
													$ref_account_no = singleDbTableRow($ref_id3)->account_no;
													
													//Get Individual Account transactions Id
													
													$acct_user 		= $ref_id3;		
													$result_count  	= $this->product_model->get_tran_count($acct_user);		
													if($result_count -> num_rows() > 0) 
													{	foreach ($result_count->result() as $r)
														{       $value 		= $r->tran_count;  					
																$tran_count = $value + 1;				
														}							
													}
													//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id3;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level3;
													$accounts_ref3 = [
														'user_id'      			=> $ref_id3,          //To the Recieving Part	ner  
														'account_no'         	=> $ref_account_no,
														'rolename'  			=> $rolename,
														'email'					=> $email,
														'paid_to'         		=> $paid_to,       //From the Money sender 	user 
														'tranx_id'         		=> $text2,
														'credit'         		=>	 '0',
														'debit'         		=> $slr_ref_per_level3,
														'amount'         		=> $user_amount, //$slr_ref_per_level3,	
														'points_mode'           => $slr_ref_pm,
														'tran_count'			=> $tran_count,															
														'used'					=> 	'no',
														'pay_type'				=> $deduction_paytype, //$invoice_	id,		
														'created_at'            => time(),
														'modified_at'           => time()
													];

														$this->db->insert('accounts', $accounts_ref3); 
														$sms_user = $ref_id3;								
														$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
														$sms_total = $slr_ref_per_level3;
														$pm_wallet = $slr_ref_pm;
														$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
														$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
													$ledger_ref3 = [
														'user_id'         		=> $ref_id3,             		//To the Recieving Partner  
														'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
														'account_no'         	=> $ref_account_no,			//Member Account No
														'email'					=> $email,
														'rolename'  			=> $rolename,
														'credit'         		=> $slr_ref_per_level3,
														'debit'         		=> '0', 	
														'amount'         		=> $slr_ref_per_level3, 
														'points_mode'           => $slr_ref_pm,
														'invoice_id '  			=> $invoice_id,		
														'challan' 				=> 'no_invoice.jpg',			
														'remarks'         		=> $remarks,
														'start_date'         	=> time(),		
														'created_at'            => time(),
														'modified_at'           => time()
													];

												   $query = $this->db->insert('ledger', $ledger_ref1);
												}	//End of DB update					
											}		 //End of Next Ref ID Not Available
										
				
/*********             Referrals Commision for Level 4                    *********/
	if( $next_sl_ref4!= 0)     ////Next refferal is Available? Proceed
		{
		$table_name = "users";
		$where_array = array('referral_code' =>$next_sl_ref4, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id4 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_sl_ref5  =  $row->referredByCode;   //Next refferall chain
		
				if($ref_id4!= 0)
				{		
				if ($slr_ref_per_level4 != '0')
				   {	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
						$ref_account_no = singleDbTableRow($ref_id4)->account_no;
						//Get Individual Account transactions Id
						
						$acct_user 		= $ref_id4;		
						$result_count  	= $this->product_model->get_tran_count($acct_user);		
						if($result_count -> num_rows() > 0) 
						{	foreach ($result_count->result() as $r)
							{       $value 		= $r->tran_count;  					
									$tran_count = $value + 1;				
							}							
						}
						//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id4;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level4;
		
						$accounts_ref4 = [
							'user_id'      			=> $ref_id4,          //To the Recieving Partner  
							'account_no'         	=> $ref_account_no,
							'rolename'  			    => $rolename,
							'email'					=> $email,
							'paid_to'         		=> $paid_to,       //From the Money sender user 
							'tranx_id'         		=> $text2,
							'credit'         		=> '0',
							'debit'         		=> $slr_ref_per_level4,
							'amount'         		=> $user_amount,	
							'points_mode'           => $slr_ref_pm,	
							'tran_count'			=> $tran_count,	
							'used'					=> 'no',
							'pay_type'				=> $deduction_paytype, //$invoice_id,		
							'created_at'            => time(),
							'modified_at'           => time()
					];

					$this->db->insert('accounts', $accounts_ref4); 	

					$sms_user = $ref_id4;								
					$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
					$sms_total = $slr_ref_per_level4;
					$pm_wallet = $slr_ref_pm;
					$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
					$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
												
					$ledger_ref4 = [
									'user_id'         		=> $ref_id4,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level4,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level4, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_ref4);
					}	//End of DB update					
				}		 //End of Next Ref ID Not Available
/*********             Referrals Commision for Level 5                    *********/
				if( $next_sl_ref5!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_sl_ref5, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id5 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
							//	$next_sl_ref4  =  $row->referredByCode;   //No  Next refferall chain
						
							if($ref_id5!= 0)
							{		
									if ($slr_ref_per_level5 != '0')
									{
									$text2 = 'Referrals Business loyalty for Invoice ID-'.$invoice_id;
									$ref_account_no = singleDbTableRow($ref_id5)->account_no;
									//Get Individual Account transactions Id
									
									$acct_user 		= $ref_id5;		
									$result_count  	= $this->product_model->get_tran_count($acct_user);		
									if($result_count -> num_rows() > 0) 
									{	foreach ($result_count->result() as $r)
										{       $value 		= $r->tran_count;  					
												$tran_count = $value + 1;				
										}							
									}
									//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id5;
		$user_amount    = 0;
		$points_mode 	= $slr_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $slr_ref_per_level5;								
										$accounts_ref5 = [
											'user_id'      			=> $ref_id5,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			    => $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $slr_ref_per_level5,
											'amount'         		=> $user_amount,	
											'points_mode'           => $slr_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_ref5); 	
									$sms_user = $ref_id5;								
									$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
									$sms_total = $slr_ref_per_level5;
									$pm_wallet = $slr_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );	
									
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
					
									$ledger_ref5 = [
									'user_id'         		=> $ref_id5,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	//Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			//Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $slr_ref_per_level5,
									'debit'         		=> '0', 	
									'amount'         		=> $slr_ref_per_level5, 
									'points_mode'           => $slr_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

									$query = $this->db->insert('ledger', $ledger_ref1);
									}		
							}
	
						}
	
					}
					}
				}
				}
			}
			}
		}
	}
	
/*************************End of Seller Ref Profit sharing**************************************************/




/*********          Begin of Client Ref Profit sharing Referrals Commision for Level 1             *********/

		$table_name = "users";
		$where_array = array('referral_code' =>$clt_ref_by, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id1 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_cl_ref2  =  $row->referredByCode;           // Next referral chain
				
				if($ref_id1!= 0)
				{
		   			if ($clt_ref_per_level1 != '0')
						{
								$text1 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
								$ref_account_no = singleDbTableRow($ref_id1)->account_no;
								//Get Individual Account transactions Id
								
								$acct_user 		= $ref_id1;		
								$result_count  	= $this->product_model->get_tran_count($acct_user);		
								if($result_count -> num_rows() > 0) 
								{	foreach ($result_count->result() as $r)
									{       $value 		= $r->tran_count;  					
											$tran_count = $value + 1;				
									}							
								}
								//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id1;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level1;
		
								$accounts_clr_ref1 = [
									'user_id'      			=> $ref_id1,          //To the Recieving Partner  
									'account_no'         	=> $ref_account_no,
									'rolename'  			=> $rolename,
									'email'					=> $email,
									'paid_to'         		=> $paid_to,       //From the Money sender user 
									'tranx_id'         		=> $text1,
									'credit'         		=> '0',
									'debit'         		=> $clt_ref_per_level1,
									'amount'         		=> $user_amount,	
									'points_mode'           => $clt_ref_pm,	
									'tran_count'			=> $tran_count,	
									'used'					=> 'no',
									'pay_type'				=> $deduction_paytype, //$invoice_id,		
									'created_at'            => time(),
									'modified_at'           => time()
								];
								
					
								$this->db->insert('accounts', $accounts_clr_ref1);
								
								$sms_user = $ref_id1;								
								$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
								$sms_total = $clt_ref_per_level1;
								$pm_wallet = $clt_ref_pm;
								$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );


								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref1 = [
									'user_id'         		=> $ref_id1,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level1,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level1, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
						}
				}
		
	/*********             Referrals Commision for Level 2                    *********/
					if( $next_cl_ref2!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_cl_ref2, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id2 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
								$next_cl_ref3  =  $row->referredByCode;   //Next referral chain
						     if($ref_id2!= 0)
								{
									if ($clt_ref_per_level2 != '0')
									{
										$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
										$ref_account_no = singleDbTableRow($ref_id2)->account_no;
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id2;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id2;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level2;
		
										$accounts_clr_ref2 = [
											'user_id'      			=> $ref_id2,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $clt_ref_per_level2,
											'amount'         		=> $user_amount,	
											'points_mode'           => $clt_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_clr_ref2); 	
									
									$sms_user = $ref_id2;								
									$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
									$sms_total = $clt_ref_per_level2;
									$pm_wallet = $clt_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
								
									$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;									
								$ledger_clr_ref3 = [
									'user_id'         		=> $ref_id2,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level3,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level3, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
									}
						        }
						
/*********             Referrals Commision for Level 3                    *********/
								if( $next_cl_ref3!= 0)     ////Next refferal is Available? Proceed
								{
										$table_name = "users";
											$where_array = array('referral_code' =>$next_cl_ref3, 'active' => '1');
											$query = $this->db->where($where_array )->get($table_name); 
											foreach ($query->result() as $row)
											{	
													$ref_id3 	= $row->id;		
													$rolename	= $row->rolename;
													$email      = $row->email;
													$paid_to	= $row->id;
													$next_cl_ref4  =  $row->referredByCode;   //Next refferall chain
												if($ref_id3!= 0)
												{
												if ($clt_ref_per_level3 != '0')
												{	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
													$ref_account_no = singleDbTableRow($ref_id3)->account_no;
													//Get Individual Account transactions Id
													
													$acct_user 		= $ref_id3;		
													$result_count  	= $this->product_model->get_tran_count($acct_user);		
													if($result_count -> num_rows() > 0) 
													{	foreach ($result_count->result() as $r)
														{       $value 		= $r->tran_count;  					
																$tran_count = $value + 1;				
														}							
													}
													//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id3;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level3;
		
													$accounts_clr_ref3 = [
														'user_id'      			=> $ref_id3,          //To the Recieving Part	ner  
														'account_no'         	=> $ref_account_no,
														'rolename'  			=> $rolename,
														'email'					=> $email,
														'paid_to'         		=> $paid_to,       //From the Money sender 	user 
														'tranx_id'         		=> $text2,
														'credit'         		=>	 '0',
														'debit'         		=> $clt_ref_per_level3,
														'amount'         		=> $user_amount,	
														'points_mode'           => $clt_ref_pm,	
														'tran_count'			=> $tran_count,	
														'used'					=> 	'no',
														'pay_type'				=> $deduction_paytype, //$invoice_	id,		
														'created_at'            => time(),
														'modified_at'           => time()
													];

														$this->db->insert('accounts', $accounts_clr_ref3); 
														
														$sms_user = $ref_id3;								
														$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
														$sms_total = $clt_ref_per_level3;
														$pm_wallet = $clt_ref_pm;
														$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );

									
													$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;		
													$ledger_clr_ref3 = [
														'user_id'         		=> $ref_id3,             		//To the Recieving Partner  
														'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
														'account_no'         	=> $ref_account_no,			    //Member Account No
														'email'					=> $email,
														'rolename'  			=> $rolename,
														'credit'         		=> $clt_ref_per_level3,
														'debit'         		=> '0', 	
														'amount'         		=> $clt_ref_per_level3, 
														'points_mode'           => $clt_ref_pm,
														'invoice_id '  			=> $invoice_id,		
														'challan' 				=> 'no_invoice.jpg',			
														'remarks'         		=> $remarks,
														'start_date'         	=> time(),		
														'created_at'            => time(),
														'modified_at'           => time()
													];

												   $query = $this->db->insert('ledger', $ledger_clr_ref1);														
												}	//End of DB update					
											}		 //End of Next Ref ID Not Available
										
				
/*********             Referrals Commision for Level 4                    *********/
	if( $next_cl_ref4!= 0)     ////Next refferal is Available? Proceed
		{
		$table_name = "users";
		$where_array = array('referral_code' =>$next_cl_ref4, 'active' => '1');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{	
				$ref_id4 	= $row->id;		
				$rolename	= $row->rolename;
				$email      = $row->email;
				$paid_to	= $row->id;
				$next_cl_ref5  =  $row->referredByCode;   //Next refferall chain
		
				if($ref_id4!= 0)
				{		
				if ($clt_ref_per_level4 != '0')
				   {	$text2 = 'Referrals Business benefits for Invoice ID-'.$invoice_id;
						$ref_account_no = singleDbTableRow($ref_id4)->account_no;
						//Get Individual Account transactions Id
						
						$acct_user 		= $ref_id4;		
						$result_count  	= $this->product_model->get_tran_count($acct_user);		
						if($result_count -> num_rows() > 0) 
						{	foreach ($result_count->result() as $r)
							{       $value 		= $r->tran_count;  					
									$tran_count = $value + 1;				
							}							
						}
						//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id4;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level4;
		
						$accounts_clr_ref4 = [
							'user_id'      			=> $ref_id4,          //To the Recieving Partner  
							'account_no'         	=> $ref_account_no,
							'rolename'  			    => $rolename,
							'email'					=> $email,
							'paid_to'         		=> $paid_to,       //From the Money sender user 
							'tranx_id'         		=> $text2,
							'credit'         		=> '0',
							'debit'         		=> $clt_ref_per_level4,
							'amount'         		=> $user_amount,	
							'points_mode'           => $clt_ref_pm,	
							'tran_count'			=> $tran_count,	
							'used'					=> 'no',
							'pay_type'				=> $deduction_paytype, //$invoice_id,		
							'created_at'            => time(),
							'modified_at'           => time()
					];

					$this->db->insert('accounts', $accounts_clr_ref4);

					$sms_user = $ref_id3;								
					$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
					$sms_total = $clt_ref_per_level3;
					$pm_wallet = $clt_ref_pm;
					$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
														
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref4 = [
									'user_id'         		=> $ref_id4,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level4,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level4, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);					
					}	//End of DB update					
				}		 //End of Next Ref ID Not Available
/*********             Referrals Commision for Level 5                    *********/
				if( $next_cl_ref5!= 0)     ////Next refferal is Available? Proceed
					{
						$table_name = "users";
						$where_array = array('referral_code' =>$next_cl_ref5, 'active' => '1');
						$query = $this->db->where($where_array )->get($table_name); 
						foreach ($query->result() as $row)
						{	
								$ref_id5 	= $row->id;		
								$rolename	= $row->rolename;
								$email      = $row->email;
								$paid_to	= $row->id;
							//	$next_cl_ref4  =  $row->referredByCode;   //No  Next refferall chain
						
							if($ref_id5!= 0)
							{		
									if ($clt_ref_per_level5 != '0')
									{
									$text2 = 'Referrals Business loyalty for Invoice ID-'.$invoice_id;
									$ref_account_no = singleDbTableRow($ref_id5)->account_no;
										//Get Individual Account transactions Id
										
										$acct_user 		= $ref_id5;		
										$result_count  	= $this->product_model->get_tran_count($acct_user);		
										if($result_count -> num_rows() > 0) 
										{	foreach ($result_count->result() as $r)
											{       $value 		= $r->tran_count;  					
													$tran_count = $value + 1;				
											}							
										}
										//End of Individual Account transactions Id	
		
		/*	Get user Balance and Update Final Amount */
		$bal_userID 		= $ref_id5;
		$user_amount    = 0;
		$points_mode 	= $clt_ref_pm;
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance + $clt_ref_per_level5;

		
										$accounts_clr_ref5 = [
											'user_id'      			=> $ref_id5,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $clt_ref_per_level5,
											'amount'         		=> $user_amount,	
											'points_mode'           => $clt_ref_pm,	
											'tran_count'			=> $tran_count,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_clr_ref5); 	
									
									$sms_user = $ref_id5;								
									$tran = '1'; // "1" if 'Credit' == 0 & no amount value -OR- "0" if 'debit' == 0 & no amount value 							
									$sms_total = $clt_ref_per_level5;
									$pm_wallet = $clt_ref_pm;
									$this->notification_model->sms_accounts($sms_user, $tran, $sms_total, $pm_wallet );
					
					
								$remarks = 'Ledger Update: Referrals Business benefits for Invoice ID-'.$invoice_id;	
								$ledger_clr_ref5 = [
									'user_id'         		=> $ref_id5,             		//To the Recieving Partner  
									'pay_type'				=> $deduction_paytype,  	    //Deduction Pay Specification	
									'account_no'         	=> $ref_account_no,			    //Member Account No
									'email'					=> $email,
									'rolename'  			=> $rolename,
									'credit'         		=> $clt_ref_per_level5,
									'debit'         		=> '0', 	
									'amount'         		=> $clt_ref_per_level5, 
									'points_mode'           => $clt_ref_pm,
									'invoice_id '  			=> $invoice_id,		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $remarks,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query = $this->db->insert('ledger', $ledger_clr_ref1);
									}		
							}
	
						}
	
					}
					}
				}
				}
			}
			}
		}
	}
	
	
	
/*************************End of Client Ref Profit sharing***************************************/	


	
/***************************************************************************************
Business/Payspecification Commision for the Transaction Turnover

*********/
//Final Balance update	
		//$led_rulets2 = ($wallet_balance + $commission);
		
		

      		}    
		
//**********************************************************************************************************//
        //Determine if invoice insert success
        if($insertInvoice)
        {

           /**
                     * Send Email to customer Now
                     */



            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;" colspan="4">Total Price</td>
                        <td style="padding:5px;text-align:center;">'.$total_price.'</td>
                    </tr>';

            $email_data = [
                'userData'     => $customer_info,
                'tableRow'      => $HTMLrow
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');
            $subject = 'Hi '.user_full_name($customer_info).', your Transaction details @'.date('d-m-Y h:i a');
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($customer_info->email);
          //  $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('product_sell_email_tpl',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
            //Email END:



            return $invoice_id;
        }
        
		
}


}
//else{

            //set error message and go back
 //           setFlashGoBack('errorMsg', 'This Transaction Is Already Processed...!!!');
       
}
}

}

/**********************************END OF PAYWALLET ********************************************************/

	 public function process_recharge($pay_by, $user_otp )
	{	
	/*
		$table = 'billpay_request';
		$where_array = array('pay_by' => $pay_by, 'otp'=>$user_otp, 'active' => '1');
		$recharge = $this->db->where($where_array)->get($table);
		foreach($recharge->result() as $res )
		{ $service_type = $res->service_type;
			$recharge_no = $res->recharge_no;
			$operator_type = $res->operator_type;
			$recharge_amt = $res->amount;
			
		$myorderid = substr(number_format(time() * rand(),0,'',''),0,15);
	//$myorderid = (rand(10,100));
	$opt = $operator_type; //$_POST['opt'];
	$mobile = $recharge_no; //$_POST['mobile'];
	$amount = $recharge_amt; //$_POST['amount'];
	$key ='7add0404e7a711e6b49e04014a243c01';
		$format='json';
		$url=file_get_contents('https://request.apihit.com/v2/recharge?key='.$key.'&operator='.$opt.'&amount='.$amount.'&country=91&number='.$mobile.'&usertxn='.$myorderid.'&format='.$format);
		$json = json_decode($url, true);
$status=$json['status'];
	
   
		} */
		
	} 
	
	/**
     * @return Referral Payments List
     */
	 //
	 public function landline_PaymentListCount(){
		$user = loggedInUserData();
	    $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       if ($role == 'admin')
       { 			
	   		$where_array = " type = 'Recharge' AND service_category = 'LANDLINE' ";
			$query = $this->db->where($where_array)->count_all_results('billpay_request');  //OTP type is Pay wallet related
	   }
	   else {
		   $where_array = " type = 'Recharge' AND service_category = 'LANDLINE' AND pay_by = ".$referral_code." ";
			$query = $this->db->where($where_array)->count_all_results('billpay_request');	 
		}

        return $query;
    }
	public function landline_PaymentList($limit = 0, $start = 0){
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       // $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'agent']);
				if ($role == 'admin')
			   { 					
						$table_name = "billpay_request";
						$where_array = array('active' => '0', 'type' => 'Recharge', 'service_category' => 'LANDLINE');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name);						
			   }else {
					
						$table_name = "billpay_request";						
						$where_array = array('pay_by'=>$referral_code, 'active' => '0', 'type' => 'Recharge', 'service_category' => 'LANDLINE');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);						
			}
			return $query;
	}	
	 //
	 //////
	 public function broadband_PaymentListCount(){
		$user = loggedInUserData();
	    $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       if ($role == 'admin')
       { 			
	   		$where_array = " type = 'Recharge' AND service_category = 'BROADBAND' ";
			$query = $this->db->where($where_array)->count_all_results('billpay_request');  //OTP type is Pay wallet related
	   }
	   else {
		   $where_array = " type = 'Recharge' AND service_category = 'BROADBAND' AND pay_by = ".$referral_code." ";
			$query = $this->db->where($where_array)->count_all_results('billpay_request');	 
		}

        return $query;
    }
	public function broadband_PaymentList($limit = 0, $start = 0){
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       // $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'agent']);
				if ($role == 'admin')
			   { 					
						$table_name = "billpay_request";
						$where_array = array('active' => '0', 'type' => 'Recharge', 'service_category' => 'BROADBAND');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name);						
			   }else {
					
						$table_name = "billpay_request";						
						$where_array = array('pay_by'=>$referral_code, 'active' => '0', 'type' => 'Recharge', 'service_category' => 'BROADBAND');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);						
			}
			return $query;
	}	
	public function electricity_PaymentListCount(){
		$user = loggedInUserData();
	    $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       if ($role == 'admin')
       { 			
	   		$where_array = " type = 'Recharge' AND service_category = 'ELECTRICITY' ";
			$query = $this->db->where($where_array)->count_all_results('billpay_request');  //OTP type is Pay wallet related
	   }
	   else {
		   $where_array = " type = 'Recharge' AND service_category = 'ELECTRICITY' AND pay_by = ".$referral_code." ";
			$query = $this->db->where($where_array)->count_all_results('billpay_request');	 
		}

        return $query;
    }
	public function electricity_PaymentList($limit = 0, $start = 0){
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       // $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'agent']);
				if ($role == 'admin')
			   { 					
						$table_name = "billpay_request";
						$where_array = array('active' => '0', 'type' => 'Recharge', 'service_category' => 'ELECTRICITY');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name);						
			   }else {
					
						$table_name = "billpay_request";						
						$where_array = array('pay_by'=>$referral_code, 'active' => '0', 'type' => 'Recharge', 'service_category' => 'ELECTRICITY');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);						
			}
			return $query;
	}	
	public function gas_PaymentListCount(){
		$user = loggedInUserData();
	    $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       if ($role == 'admin')
       { 			
	   		$where_array = " type = 'Recharge' AND service_category = 'GAS' ";
			$query = $this->db->where($where_array)->count_all_results('billpay_request');  //OTP type is Pay wallet related
	   }
	   else {
		   $where_array = " type = 'Recharge' AND service_category = 'GAS' AND pay_by = ".$referral_code." ";
			$query = $this->db->where($where_array)->count_all_results('billpay_request');	 
		}

        return $query;
    }
	public function gas_PaymentList($limit = 0, $start = 0){
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       // $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'agent']);
				if ($role == 'admin')
			   { 					
						$table_name = "billpay_request";
						$where_array = array('active' => '0', 'type' => 'Recharge', 'service_category' => 'GAS');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name);						
			   }else {
					
						$table_name = "billpay_request";						
						$where_array = array('pay_by'=>$referral_code, 'active' => '0', 'type' => 'Recharge', 'service_category' => 'GAS');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);						
			}
			return $query;
	}	
//
	  public function postpaid_PaymentListCount(){
		$user = loggedInUserData();
	    $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       if ($role == 'admin')
       { 			
	   		$where_array = " type = 'Recharge' AND service_category = 'POSTPAID' ";
			$query = $this->db->where($where_array)->count_all_results('billpay_request');  //OTP type is Pay wallet related
	   }
	   else {
		   $where_array = " type = 'Recharge' AND service_category = 'POSTPAID' AND pay_by = ".$referral_code." ";
			$query = $this->db->where($where_array)->count_all_results('billpay_request');	 
		}

        return $query;
    }
	public function postpaid_PaymentList($limit = 0, $start = 0){
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       // $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'agent']);
				if ($role == 'admin')
			   { 					
						$table_name = "billpay_request";
						$where_array = array('active' => '0', 'type' => 'Recharge', 'service_category' => 'POSTPAID');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name);						
			   }else {
					
						$table_name = "billpay_request";						
						$where_array = array('pay_by'=>$referral_code, 'active' => '0', 'type' => 'Recharge', 'service_category' => 'POSTPAID');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);						
			}
			return $query;
	}	
//
    public function recharge_PaymentListCount(){
		$user = loggedInUserData();
	    $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       if ($role == 'admin')
       { 			
			$query = $this->db->where( 'type' , 'Recharge')->count_all_results('billpay_request');  //OTP type is Pay wallet related
	   }
	   else {
			$query = $this->db->where('pay_by', $referral_code )->count_all_results('billpay_request');	 
		}

        return $query;
    }

    public function recharge_PaymentList($limit = 0, $start = 0){
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       // $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'agent']);
				if ($role == 'admin')
			   { 					
						$table_name = "billpay_request";
						$where_array = array('active' => '0', 'type' => 'Recharge');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name);						
			   }else {
					
						$table_name = "billpay_request";						
						$where_array = array('pay_by'=>$referral_code, 'active' => '0', 'type' => 'Recharge');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);						
			}
			return $query;
	}	
	
	/**
     * @return Referral Payments List
     */

    public function billpay_statusListCount(){
		$user = loggedInUserData();
	    $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
     if ($role == 'admin')
       { 			
			$query = $this->db->count_all_results('billpay_status');  //OTP type is Pay wallet related
	   }
	   else {
			$query = $this->db->where('user_id', $userID )->count_all_results('billpay_status');	 
		}

        return $query;
    }

    public function billpay_statusList($limit = 0, $start = 0){
		$search=$this->input->get('search');
		$searchValue=$search['value'];
		$searchByID = '';
		
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       	if ($role == 'admin')
			   { 	
						   if($searchValue != '')
							{
								//$searchByID = " WHERE invoice.id = '{$searchValue}'";
								$where_array = array('number'=> $searchValue);
							    $table_name = "billpay_status";								
								$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);	
							}else{					
								$table_name = "billpay_status";								
								$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name);	
							}								
			   }else {
					
					if($searchValue != '')
							{
								$table_name = "billpay_status";						
								$where_array = array('user_id' => $userID, 'number'=> $searchValue);
								$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);	
							}else{
											
								$table_name = "billpay_status";						
								$where_array = array('user_id' => $userID);
							    $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
							}						
			}
			return $query;
	}	
	
	
	}//Last Brace Required