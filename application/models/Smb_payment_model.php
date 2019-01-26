<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smb_payment_model extends CI_Model {

	public function total_debit($userID, $points_mode){
       
		$account_no = singleDbTableRow($userID)->account_no;
 
		$table_name = "accounts";		
		$where_array = array('points_mode'=>$points_mode, 'account_no' =>$account_no);
		$query1 = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
	//	return $query2;
		return $query1->result();
		
    }

	public function total_credit($userID, $points_mode){
       
		$account_no = singleDbTableRow($userID)->account_no;
 
		$table_name = "accounts";		
		$where_array = array('points_mode'=>$points_mode, 'account_no' =>$account_no);
		$query2 = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
	//	return $query2;
		return $query2->result();
		
    }
	
//For Transaction Series	
	public function get_tran_count($acct_user){
       
		$account_no = singleDbTableRow($acct_user)->account_no;
		$limit = '1';	
		$start = '0';	
 
		$table_name = "accounts";		
		$where_array = array('account_no' =>$account_no);	
		$result_count = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);		
		return $result_count;
		
    }

	public function user_balance($bal_userID, $points_mode){
       
		
       $account_no = singleDbTableRow($bal_userID)->account_no;
		
		$table_name = "accounts";		 
		$where_array = array('points_mode'=>$points_mode, 'account_no' =>$account_no);
		$user_debit = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $user_debit->result() 		as $user_debit);
		$users_debit			= $user_debit->debit;
		
		$table_name = "accounts";		
		$where_array = array('points_mode'=>$points_mode, 'account_no' =>$account_no);
		$user_credit = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
		// return $query;
		foreach( $user_credit->result() 	as $user_credit);		
		$users_credit      	= $user_credit->credit;
		
		$user_balance       = ( $users_debit - $users_credit ) ;
		
		return $user_balance;
		
	
		
    }
	
	public function make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode, $tranx_remark){
	
		$pay_by = $pay_by_referral_code;
		$pay_to = $pay_to_referral_code;
		
		$amount	    		= $amount_to_pay;		//Paying Amount	
		$pay_type   		= $pay_spec_type;   //Pay Specification
		$tranx_id   		= $transaction_remarks;
		$payment_type		= $pm_mode;
		
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

        //Redirect if user/customer not found..
/*
        if( ! $customer_info)
        {
            //set error message and go back
            setFlashGoBack('errorMsg', 'Client Not Found!');
        }
*/
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


	        $categoryID = $categories;   //payspecification ID
		    $product_name = $productName;
            $price = $amount; //$itemPrice[$i] * $quantity;
            $total_price = $amount; //$price;


			$acct_id1 = $pay_type; //$this->input->post('sub_account');
			$seller_info = $this->session->userdata('logged_user');
			$sellerID = $pay_by_userID	; // 	$sales_by;
			$seller_role = singleDbTableRow($sellerID)->rolename;
			
			$client_id = $pay_to_userID;
			$client_info = singleDbTableRow($client_id, 'users') ;		
						
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
		
	//	$wallet_balance = $this->input->post('wallet_balance');
		
	
//Benefits details To the Recieving Partner for data retrival 

       // S E N D E R
//pay_by_userID is Seller/Current User who is sending money
		$pm_wallet = $payment_type;
		
		$acct_id = $pay_type; //$this->input->post('sub_account');
			
		$user_info 	   = $this->session->userdata('logged_user');
        $user_id 	   = $pay_by_userID;
		$email 		   = singleDbTableRow($pay_by_userID)->email;
		$currentUser   = singleDbTableRow($pay_by_userID)->role;
		$sel_ref_code  = singleDbTableRow($pay_by_userID)->referral_code;
		$sel_ref_by    = singleDbTableRow($pay_by_userID)->referredByCode;   //Key field to get 5 level Network
		$seller_role   = singleDbTableRow($pay_by_userID)->rolename;		
		
		$seller_rolename = typeDbTableRow($seller_role)->rolename;     //Role Description
		$seller_account_no = singleDbTableRow($pay_by_userID)->account_no;	
		$seller_email      = singleDbTableRow($pay_by_userID)->email;	
		
		$voucher_to_role = $seller_role;
		
		
		// R E C I E V E R
//pay_to_userID is Client/Beneficiary User	who is reciving money
		$client_id = $pay_to_userID;
		$client_role  = singleDbTableRow($pay_to_userID)->rolename;	  // Role ID		
		$client_rolename = typeDbTableRow($client_role)->rolename;    //Role Description
		$client_email    = singleDbTableRow($pay_to_userID)->email;	
		$client_name  = singleDbTableRow($pay_to_userID)->first_name;	
		$clt_ref_code = singleDbTableRow($pay_to_userID)->referral_code;	
		$clt_ref_by   = singleDbTableRow($pay_to_userID)->referredByCode; //Key field to get 5 level Network
		$agreed_per = '0';
		$agreed_per   = singleDbTableRow($pay_to_userID)->agreed_per;
		
		
	// Insert data for Accounts-VPA debit "To the Recieving Partner"	
		$tranx_id1 = 'Paid by '.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id.', '.$tranx_remark;




//Get Individual Account transactions series Id	
$acct_user 		= $c_id;
$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
	
	if ($currentUser = 'admin' )	//Except Agent and Customer, recording rest of the transactions to Ledger
	{   
	$remarks1 = 'Ledger Update: Paid by'.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id.', '.$tranx_remark;
		$ledger1 = [
            'user_id'         		=> $c_id,             	//To the Recieving Partner  
			'pay_type'				=> $acct_id, 			//Deduction Pay Specification	
			'account_no'         	=> $c_account_no,		//Member Account No
			'email'					=> $client_email,
			'rolename'  			=> $client_role,
			'debit'         		=> '0',
			'credit'         		=> $total_price,
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
		
	}	
		
		$tranx_id2 = "Paid to '".$client_rolename.'-'.$client_name."' for the Invoice ID-".$invoice_id.', '.$tranx_remark;
		
	//Sender/Seller/Active user
	
	
								$user_debit  	= $this->smb_payment_model->total_debit($userID, $points_mode);
								$user_credit  	= $this->smb_payment_model->total_credit($userID, $points_mode);
							
		
//Get Individual Account transactions Id
	
$acct_user 		= $user_id;		
$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
		$remarks2 = "Ledger Update: Paid to '".$client_rolename.'-'.$client_name."' for the Invoice ID-".$invoice_id.', '.$tranx_remark;
		$ledger2 = [
            'user_id'         		=> $user_id,             	//To the Recieving Partner  
			'pay_type'				=> $acct_id, 			    //Deduction Pay Specification	
			'account_no'         	=> $seller_account_no,		//Member Account No
			'email'					=> $seller_email,
			'rolename'  			=> $seller_role,
            'credit'         		=> '0',
			'debit'         		=> $total_price, 	
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
								$user_debit  	= $this->smb_payment_model->total_debit($userID, $points_mode);
								$user_credit  	= $this->smb_payment_model->total_credit($userID, $points_mode);
								$user_balance = '0'; //$user_debit - $user_credit;
								$user_amount = $user_balance + $slr_ref_per_level1;
								
								//Get Individual Account transactions Id
								
								$acct_user 		= $ref_id1;		
								$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
										$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
													$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
						$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
									$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
								$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
										$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
													$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
						$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
										$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
		$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
		$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
		$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
		$result_count  	= $this->smb_payment_model->get_tran_count($acct_user);		
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
		$user_balance  	= $this->smb_payment_model->user_balance($bal_userID, $points_mode);
				
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
	
/***************************************************************************************
Business/Payspecification Commision for the Transaction Turnover

*********/
//Final Balance update	
		//$led_rulets2 = ($wallet_balance + $commission);
		
		

      		}    
		
//**********************************************************************************************************//

//Voucher_generation Starts Here..............
	$get_voucher_permission = $this->db->get_where('voc_generate', ['pay_type'=>$pay_type, 'to_role'=>$voucher_to_role]);
	if($get_voucher_permission->num_rows()>0){
		foreach($get_voucher_permission->result() as $v){
			$voucher_name = $v->voc_name;
			$percentage = $v->percentage;
			$splits = $v->no_of_split;
			$pay_type_to = $v->paytype_to;
		}
		
		$split_amt = ((($amount * $percentage )/ 100) / $splits);
		$today_date = date("Y-m-d"); 
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
			$monthlyDate = strtotime("+".$i." month".$today_date);
			$monthly = date("Y-m-d", $monthlyDate);
			
			$datav = [
				'voucher_name' 			=> $voucher_name,
				'user_id'				=> $user_id,
				'account_no'			=> $seller_account_no,
				'email'					=> $seller_email,
				'voucher_id' 			=> $Epin,
				'pay_type' 				=> $pay_type,
				'paytype_to' 			=> $pay_type_to,
				'amount'   				=> $split_amt, 
				'points_mode' 			=> $payment_type,	//points_mode
				'used'      			=> 'no',
				'start_date'  			=>  $monthly,
				'end_date' 				=> '2020-12-31',
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
			if ($pay_type = '66')
         {   $this->email->cc('status@cfirst.co.in');	 }
            $this->email->subject($subject);
            $message = $this->load->view('product_sell_email_tpl',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
            //Email END:



            return $invoice_id;
        }
        else{
            return false;
        }


	}

}//Last Brace Required