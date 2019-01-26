<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_model extends CI_Model {

   /**
     * @return bool
     */

   
/**
     * @return Bank List
     * BankList Query
     */

    public function bankListCount(){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$referral_code = singleDbTableRow($user_id)->referral_code;
		$currentUser   = singleDbTableRow($user_id)->role;
		
       
		    if($currentUser == 'admin'){
          $query = $this->db->count_all_results('bank');
		 
		//	$query = $this->db->where( 'active' , '1')->count_all_results('bank');
			
				}
			else{
				//$where_array = array ('user_id'=>$user_id, 'paid_to'=>$user_id);
			// $query = $this->db->where('user_id',$user_id )->count_all_results('accounts');	
			 $query = $this->db->where('created_by' , $user_id)->count_all_results('bank');
			}
        return $query;
		
		
//        $query = $this->db->where( 'role' , 'agent')->count_all_results('users');
//        $query = $this->db->where( 'active' , '1')->count_all_results('bank');
//        return $query;
    }

    public function bankList($limit = 0, $start = 0){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

			$referral_code = singleDbTableRow($user_id)->referral_code;		 
		 	$currentUser   = singleDbTableRow($user_id)->role;
			$rolename      = singleDbTableRow($user_id)->rolename;
       
	    if($rolename  == 11 ){ //Get All Data for Admin
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('bank');
		}elseif($rolename  == 22 and $referral_code == 2380617495) { 
			$where_array = array('ifsc_code' =>'payumoney' );		//Get Only Payumoney data
			 $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('bank');
		}elseif($rolename  == 22 and $referral_code == 5794120836) {
			$where_array = array('ifsc_code' =>'SBIN0016336' );     //Get Only SBI data
			 $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('bank');
		}elseif($rolename  == 24 ) {
			$where_array = array('transaction_type' =>'withdrawl' );     //Get Only Withdrawl request
			 $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('bank');			 
		}elseif($rolename  != 11 or $rolename  != 22) {				//All Users Deposit and Withdrawl request
			 $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('bank', ['created_by' => $user_id]);
			}
        return $query;
		

    }



    /**
     * @om string $photo
     * Photo Resize
     */

    public function photoResize($photo = ''){
        $config['image_library'] = 'gd2';
        $config['source_image'] = $photo;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 200;
        $config['height']       = 200;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        unlink($photo); // delete original photo
    }

    public function add_bankdeposit(){

        $user_info 			= $this->session->userdata('logged_user');
        $userId 			= $user_info['user_id'];
		$rolename 			= singleDbTableRow($userId)->rolename;
		$account_no			= singleDbTableRow($userId)->account_no;
		$first_name 		= singleDbTableRow($userId)->first_name;
		$last_name 			= singleDbTableRow($userId)->last_name;
		$email 				= singleDbTableRow($userId)->email;
		$referral_code 		= singleDbTableRow($userId)->referral_code;
		$referredByCode 	= singleDbTableRow($userId)->referredByCode;
		$adhaar_no 			= singleDbTableRow($userId)->adhaar_no;
		
		$postal_code 		= singleDbTableRow($userId)->postal_code;
		
		$ref_count = $this->ledger_model->referralListCount();



        $this->load->helper('string'); //load string helper											
										
		$bank_account_no     =  $this->input->post('account_no');	
		$userfile 			= $this->input->post('userfile');	
		$tranx_id = $this->input->post('tranx_id');
       

        $photoName = '';

        //check user is selected photo
        if($_FILES['userfile']['name'] != '')
        {
            $upload_dir = './uploads/'; //Upload directory -Added ledger folder for separate storage
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
		$actual_amount = $this->input->post('amount');
		
		$ifsc_code =  $this->input->post('ifsc_code');
		if ($ifsc_code == 'payumoney')
		{
			$charges = (($actual_amount * 2.5) /100 );
			$amount  = $actual_amount - $charges;
		}else{
			$charges = 0;
			$amount  = $actual_amount;
		}
		
        //set all data for inserting into database
        $data = [
            'first_name'        => $first_name,
            'last_name'         => $last_name,
			'email' 			=> $email,
			'tranx_id'          => $tranx_id,
            'ifsc_code'         => $ifsc_code ,
			'transaction_type'  => 'deposit',
            'transaction_date'  => $this->input->post('transaction_date'),
			'postal_code'   	=> $postal_code,	
			'adhaar_no'			=> $adhaar_no,
		//	'passport_no'       => $passport_no,
			'rolename'          => $rolename,
			'active'            => 'Pending for Approval',
			'referral_code'     => $referral_code,
			'account_no'        => $account_no,
			'amount'       		=> $amount,
			'charges'           => $charges ,
			'referredByCode'    => $referredByCode,					
            'challan'           => $photoName,
            'created_by'        => $userId,
            'created_at'        => time(),
            'modified_at'       => time()
        ];

       $query = $this->db->insert('bank', $data);
		
		$sms_user = $userId;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value  -OR-  "0" if 'debit' == 0 & no amount value 							
		$total_price = $amount;
		$pm_wallet = 'wallet';
		$this->notification_model->sms_user_deposit($sms_user, $tran, $total_price, $pm_wallet );
		
        if($query)
        {
            create_activity('Added '.$data['transaction_type'].' from user'); //create an activity

           /* $email_data = [
                'email'  => $email,
                'password'  => $row_password,
            ]; */

          /*  //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');
            $subject = 'Congratulation '.$data['first_name'].' '. $data['last_name'];
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail,  get_option('company_name'));
            $this->email->to($email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('email_template_password',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
			*/
            return true;
        }
        return false;

    }

//Cash Withdrawl

    public function cash_withdrawl(){

        $user_info 			= $this->session->userdata('logged_user');
        $userId 			= $user_info['user_id'];
		$rolename 			= singleDbTableRow($userId)->rolename;
		$account_no			= singleDbTableRow($userId)->account_no;
		$contactno			= singleDbTableRow($userId)->contactno;
		$first_name 		= singleDbTableRow($userId)->first_name;
		$last_name 			= singleDbTableRow($userId)->last_name;
		$email 				= singleDbTableRow($userId)->email;
		$referral_code 		= singleDbTableRow($userId)->referral_code;
		$referredByCode 	= singleDbTableRow($userId)->referredByCode;
		$adhaar_no 			= singleDbTableRow($userId)->adhaar_no;		
		$postal_code 		= singleDbTableRow($userId)->postal_code;		
		$company_name 		= singleDbTableRow($userId)->company_name;	
		$bank_name	 		= singleDbTableRow($userId)->bank_name;	
		$bank_acc_type 		= singleDbTableRow($userId)->bank_acc_type;	
		$bank_account 		= singleDbTableRow($userId)->bank_account;	
		$bank_address 		= singleDbTableRow($userId)->bank_address;	
		$pan_no 			= singleDbTableRow($userId)->pan_no;
		$ifsc_code 			= singleDbTableRow($userId)->ifsc_code;	

		$amount     		= $this->input->post('amount');
		
		if ($company_name == '')
		{
			$company_name = 'Not Available';
		}


        //set all data for inserting into database
        $data = [
            'first_name'        => $first_name,
            'last_name'         => $last_name,
			'email' 			=> $email,
			'tranx_id'          => $this->input->post('tranx_id'),
            'ifsc_code'         => $ifsc_code,
		    'transaction_type'  => 'withdrawl',
            'transaction_date'  => time(),
			'postal_code'   	=> $postal_code,	
			'adhaar_no'			=> $adhaar_no,
			'contactno	'       => $contactno,
			'rolename'          => $rolename,
			'active'            => 'Pending for Approval',
			'referral_code'     => $referral_code,
			'account_no'        => $account_no,
			'amount'       		=> $amount,
			'referredByCode'    => $referredByCode,		

			'company_name' 		=> $company_name,
			'bank_name' 		=> $bank_name	,
			'bank_acc_type' 	=> $bank_acc_type,	
			'bank_account' 		=> $this->input->post('bank_account'),
			'bank_address' 		=> $bank_address,	
			'pan_no' 			=> $pan_no,
			'bank_ifscode'			=> $ifsc_code,

		
            'challan'           => 'no_invoice.jpg',
            'created_by'        => $userId,
            'created_at'        => time(),
            'modified_at'       => time()
        ];

       $query = $this->db->insert('bank', $data);
		
		$sms_user = $userId;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value  -OR-  "0" if 'debit' == 0 & no amount value 							
		$total_price = $amount;
		$pm_wallet = 'wallet';
		$this->notification_model->sms_user_withdrawal($sms_user, $tran, $total_price, $pm_wallet );
		
		
        if($query)
        {
            create_activity('Added '.$data['first_name'].' '. $data['last_name'].' as agent'); //create an activity


            return true;
        }
        return false;

    }

//Cash Reimbursement

    public function cash_reimbursement(){

        $user_info 			= $this->session->userdata('logged_user');
        $userId 			= $user_info['user_id'];
		$rolename 			= singleDbTableRow($userId)->rolename;
		$account_no			= singleDbTableRow($userId)->account_no;
		$first_name 		= singleDbTableRow($userId)->first_name;
		$last_name 			= singleDbTableRow($userId)->last_name;
		$email 				= singleDbTableRow($userId)->email;
		$referral_code 		= singleDbTableRow($userId)->referral_code;
		$referredByCode 	= singleDbTableRow($userId)->referredByCode;
		$adhaar_no 			= singleDbTableRow($userId)->adhaar_no;		
		$postal_code 		= singleDbTableRow($userId)->postal_code;
		
		$reimb_type = $this->input->post('reimbursement');
		$reimb_text = typeDbTableRow($reimb_type)->name;
		
		$remarks    =  $this->input->post('tranx_id');
		
		$tranx_id = "'Reimbursement Type-'.$reimb_text'Reason: '.$remarks";

        //set all data for inserting into database
        $data = [
            'first_name'        => $first_name,
            'last_name'         => $last_name,
			'email' 			=> $email,
			'tranx_id'          => $tranx_id,
		    'transaction_type'  => 'Reimbursement',
            'transaction_date'  => time(),
			'postal_code'   	=> $postal_code,	
			'adhaar_no'			=> $adhaar_no,
		//	'passport_no'       => $passport_no,
			'rolename'          => $rolename,
			'active'            => 'Pending for Approval',
			'referral_code'     => $referral_code,
			'account_no'        => $account_no,
			'amount'       		=> $this->input->post('amount'),
			'referredByCode'    => $referredByCode,					
            'challan'           => 'no_invoice.jpg',
            'created_by'        => $userId,
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
	public function online_payment(){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
	    $account_no = singleDbTableRow($user_id)->account_no;
		$currentUser   = singleDbTableRow($user_id)->role;
        
		
		 //set all data for inserting into database
        $data = [
            'user_id'         		=> $user_id, 
			'account_no'         	=> $account_no,
            'role '  			    => $currentUser,
            'pay_type'         		=> 'Online Transfer' ,
			'credit'         		=> '0',
			'debit'         		=> $this->input->post('amount'),
			'amount'         		=> $this->input->post('amount'),	
			'points_mode' 			=> 'wallet',
			'used'					=> 'no',
			'active'          		=> '0',
			'tranx_id'				=> 'PayUmoney', //$this->input->post('tranx_id'),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('bank', $data);

        if($query)
        {
            create_activity('Added '.$data['tranx_id'].' accounts'); //create an activity
            return true;
        }
        return false;
		
		
	
	}
/**************************************************************************************************/
//For Role Account_Assistance Role 9 and Agent - 24	
	
	//Clients Deposit/Withdrawl/Reimbursement Amount , By Account Dispatcher
	
	
/**************************************************************************************************/	
	
	public function addbank_balance($id){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$trans_type = $this->input->post('trans_type');
	    $seller_account_no = singleDbTableRow($user_id)->account_no;
		$currentUser   = singleDbTableRow($user_id)->role;
		$currentUser_Email   = singleDbTableRow($user_id)->email;
		$to_role = singleDbTableRow($user_id)->rolename;
		
		$amount = $this->input->post('amount');
		$invoice_id = $this->input->post('invoice_id');
		$remarks = $this->input->post('remarks');
        $challan = 'No Challan';
		$transaction_type = $this->input->post('transaction_type');
		
		$ifsc_code = $this->input->post('ifsc_code');
		$charges   = $this->input->post('ded_amt');
		
		
		  //Beneficiary Account Update 
			
		$client_account_no = 	$this->input->post('account_no');
		$table_name = "users";
		$where_array = array('account_no'=>$client_account_no);
		$client_user = $this->db->where($where_array )->get($table_name); 
		foreach ($client_user->result() as $user)
		{		
				$client_userID = $user->id;
				$clientRole = $user->rolename;
				$clientEmail = $user->email;
		}
		
		
		if ($transaction_type == 'deposit' )	
		{
			
			if ($ifsc_code == 'payumoney' )
			{
				$credit = '0';
			    $debit = $amount;
				$pay_type = '25'; //PayUmoney
			}else{
				$credit = '0';
			    $debit = $amount;
				$pay_type = '24'; //SBI-HAL Account Transactions
			}
			
			$tranx_id1 = "Transactions Type .$transaction_type for the remarks'.$remarks'";
			
			
		}elseif ($transaction_type == 'withdrawl' )	
		{
			$credit = $amount;
			$debit = '0';
			$pay_type = '29'; //SBI-HAL Account Cash Withdrawl
			$tranx_id1 = "Cash Deposited Bank Reference ID'.$remarks'";
			
		
		}elseif ($transaction_type == 'Reimbursement' )	
		{	
				if( $currentUser == 'agent')      //Agent Group
				{
					$credit = '0';
					$debit = $amount;
					$pay_type = '46'; //SBI-HAL Account Transactions
					$tranx_id1 = "Reimbursement Request for the remarks'.$remarks'";
				}elseif( $currentUser == 'user')  //consumer
				{
					$credit = '0';
					$debit = $amount;
					$pay_type = '45'; //SBI-HAL Account Transactions
					$tranx_id1 = "Reimbursement Request for the remarks'.$remarks'";
				}
		
		}
		

//Get Individual Account transactions Id
		//'tran_count'			=> $tran_count,
		$acct_user = $user_id;
		$result_count  	= $this->product_model->get_tran_count($acct_user);
		if($result_count -> num_rows() > 0) 
			{	
				foreach ($result_count->result() as $r)
				{
					$value 		= $r->tran_count;    
					$tran_count = $value + 1;
					$value 		= '0';
				}					
			}
//End of Individual Account transactions Id	
	if ($tran_count == null)
	{ 	$tran_count = 1;
    }
		 //Account Dispatcher data into database
	if ($amount != '0'){
			
				$data1 = [
					'user_id'         		=> $user_id, 
					'account_no'         	=> $seller_account_no, //Account Dispatcher Deduction Account Number
					'email'					=> $currentUser_Email,
					'rolename'  			=> $to_role,
					'pay_type'         		=> $pay_type,
					'credit'         		=> $debit,
					'debit'         		=> $credit,           //Amount deduction from Approve 'catch'
					'amount'         		=> $amount,	
					'challan'				=> $challan,
					'points_mode' 			=> 'wallet',
					'tran_count'			=> $tran_count,
					'used'					=> 'yes',
					'paid_to'         		=> $client_userID,       //From the Money sender user 
					'tranx_id'				=> $tranx_id1,		
					'created_at'            => time(),
					'modified_at'           => time()
				];
		
       $query1 = $this->db->insert('accounts', $data1);
	 } 

	   
			
			
            
				
			
		   	
            

	   
	
		
	//	$tranx_id2 = "Transactions Type .$transaction_type for the remarks'.$invoice_id'";
	//Get Individual Account transactions Id
		//'tran_count'			=> $tran_count,
		$acct_user = $client_userID;
		$result_count  	= $this->product_model->get_tran_count($acct_user);
		if($result_count -> num_rows() > 0) 
			{	
				foreach ($result_count->result() as $r)
				{
					$value 		= $r->tran_count;    
					$tran_count9 = $value + 1;
					$value 		= '0';
				}					
			}
			if ($tran_count9 == null)
			{
				$tran_count9 = 1;
			}
//End of Individual Account transactions Id		
	
	   //set all data for inserting into database
	   if ($amount != '0'){	
        $data2 = [
            'user_id'         		=> $client_userID, 
			'account_no'         	=> $client_account_no, //Clients Deposit Account Number
            'rolename'  			=> $clientRole,
			'email'  		    	=> $clientEmail,
            'pay_type'         		=> $pay_type ,
			'credit'         		=> $credit,
			'debit'         		=> $debit,
			'amount'         		=> $amount,		
			'points_mode' 			=> 'wallet',
			'tran_count'			=> $tran_count9,
			'challan'				=> $challan,
			'used'					=> 'no',
		    'paid_to'         		=> $user_id, 
			'tranx_id'				=> $tranx_id1,	
            'created_at'            => time(),
            'modified_at'           => time()
        ];
		$query2 = $this->db->insert('accounts', $data2);
	}		
	
	 
		$transaction    = "Transactions Type .$transaction_type to Pay Spec by A/C No $client_account_no";
		// 'To The Company ' Pay Specification Accounts Type
		if ($amount != '0'){	
        $data3 = [
            'user_id'         		=> $user_id, 
			'pay_type'				=> $pay_type,   //Pay spec
			'credit'         		=> $credit,
			'debit'         		=> $debit,
			'amount'         		=> $amount,	
			'points_mode'           => 'wallet',				
            'start_date'         	=> time(),				
            'invoice_id '  			=> $invoice_id,            			
			'remarks'         		=> $tranx_id1,	
			'transaction'			=> $transaction,
			'start_date'			=> time(),
            'created_at'            => time(),
            'modified_at'           => time(),
			'modified_by'			=> $user_id,
			'challan'				=> $challan,
			'count'       		    => 'yes'
        ];

       $query3 = $this->db->insert('ledger', $data3);
		}

			if ($ifsc_code == 'payumoney' ) //For Pay u Money new insert
			{
				//Get Individual Account transactions Id
		//'tran_count'			=> $tran_count,
		$acct_user = $client_userID;
		$result_count  	= $this->product_model->get_tran_count($acct_user);
		if($result_count -> num_rows() > 0) 
			{	
				foreach ($result_count->result() as $r)
				{
					$value 		= $r->tran_count;    
					$tran_count = $value + 1;
					$value 		= '0';
				}					
			}
//End of Individual Account transactions Id	
/*	Get user Balance and Update Final Amount */
		$bal_userID 	= $client_userID;
		$user_amount    = 0;
		$points_mode 	= 'wallet';
		$user_balance  	= $this->product_model->user_balance($bal_userID, $points_mode);
				
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $charges ;		
	   //set all data for inserting into database
	   if ($amount != '0'){	
        $data2 = [
            'user_id'         		=> $client_userID, 
			'account_no'         	=> $client_account_no, //Clients /Deposit reciever
			'email'					=> $currentUser_Email,
            'rolename'  			=> $clientRole,
            'pay_type'         		=> $pay_type ,
			'credit'         		=> $charges ,
			'debit'         		=> 0,
			'amount'         		=> $user_amount,		
			'points_mode' 			=> 'wallet',
			'tran_count'			=> $tran_count,
			'challan'				=> $challan,
			  'paid_to'         	=> $user_id, 
			'used'					=> 'no',
			//'active'          		=> '0',
			'tranx_id'				=> 'Online payment service Charges',	
            'created_at'            => time(),
            'modified_at'           => time()
        ];
		$query2 = $this->db->insert('accounts', $data2);
	}		
	
	 
		$transaction4    = "Online payment service Charges";
		// 'To The Company ' Pay Specification Accounts Type
		if ($amount != '0'){	
        $data3 = [
            'user_id'         		=> $user_id, 
			'pay_type'				=> $pay_type,   //Pay spec
			'credit'         		=> $credit,
			'debit'         		=> $debit,
			'amount'         		=> $amount,	
			'points_mode'           => 'wallet',				
            'start_date'         	=> time(),				
            'invoice_id '  			=> $invoice_id,            			
			'remarks'         		=> $tranx_id1,	
			'transaction'			=> $transaction4,
			'start_date'			=> time(),
            'created_at'            => time(),
            'modified_at'           => time(),
			'modified_by'			=> $user_id,
			'challan'				=> $challan,
			'count'       		    => 'yes'
        ];

       $query3 = $this->db->insert('ledger', $data3);
		}
			}

//set all data for inserting into database
        $data8 = [
           	'active'            => 'Approved',            
            'modified_at'       => time()
        ];

       $query8 = $this->db->where('id', $id)->update('bank', $data8);
	  
        if($query8)
        {
            create_activity('Added '.$data8['active'].' ledger'); //create an activity
            return true;
        }
        return false;
	
				
       
	}

/* ************************Loan Scheme ****************************************************************/


	
	public function create_loans(){
	
	$this->load->helper('string'); //load string helper
 
       $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$epin  = random_string('numeric',10);
		
		
	/* 	$fromDate = date('Y-m-d').' 00:00:00';
		$toDate = date('Y-m-d').' 23:59:59';
		
		if($this->input->get('dateRange') != '')
		{
			$dateRange = $this->input->get('dateRange');
			$dateRange = explode(' - ', $dateRange);
			$fromDate = $dateRange[0].' 00:00:00';
			$toDate = $dateRange[1].' 23:59:59';

		}	*/	
		
		//check unique $epin
        $getEpin = $this->db->get_where('commissions', ['identity_id'=> $epin]);
        if($getEpin -> num_rows() > 0)
        {
            for($i= 0; $getEpin -> num_rows() > 0; $i++){
                $epin  = strtoupper(random_string());
                $getEpin = $this->db->get_where('commissions', ['identity_id'=> $epin]);
            }
        }
		 
		$identity_id = "LOAN_".$epin;
		//$identity_id = $epin;
		
        //set all data for inserting into database
        $data = [
			'identity' 		  => 'Loans',
			'identity_id'	  => $identity_id,
			'type'			  => $this->input->post('loan_type'),
            'remarks'         => $this->input->post('loan_name'),
			'amount'          => $this->input->post('amount'),
			'loy_amt'         => '0',
			'dis_amt'         => '0',
			'acct_id'         => $this->input->post('acct_id'),
			'sub_acct_id'     => $this->input->post('sub_acct_id'),			
			'start_date'      => $this->input->post('start_date'),
            'end_date'   	  => $this->input->post('end_date'),
			'from_role'       => $user_id,			
			'to_role'     	  => $this->input->post('to_role'),
			'commission'      => '0', //$this->input->post('commission'),
			'benefits'    	  => '0', //$this->input->post('benefits'),
			'transferrable'   => 'no',
			'period'   		  => $this->input->post('period'),
			'tenure'   		  => $this->input->post('tenure'),
			'created_by'	  => $user_id,
			'modified_by'	  => 'Administrator',
            'created_at'      => time(),
            'modified_at'     => time()
        ];

       $query = $this->db->insert('commissions', $data);

        if($query)
        {
            create_activity('Added '.$data['remarks'].' commissions'); //create an activity
            return true;
        }
        return false;
}

	/**
     * @return Loan Count and Data Lists    
     */

    public function businessLoansListCount(){
      /*  $queryCount = $this->db->count_all_results('vouchers');
        return $queryCount;
    }*/
	
	$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$referral_code = singleDbTableRow($user_id)->referral_code;
		$currentUser   = singleDbTableRow($user_id)->role;
		
       
		 if($currentUser == 'admin'){
            $queryCount = $this->db->where('identity', 'Loans')->count_all_results('commissions');
			return $queryCount;		
				}
		elseif($currentUser == 'agent'){ 
			$queryCount = $this->db->where('identity', 'Loans')->count_all_results('commissions');			
			
			return $queryCount;
				}
		elseif($currentUser == 'user'){ 
			$queryCount = $this->db->where( 'identity', 'Loans' )->count_all_results('commissions');			
			
			return $queryCount;
				}       
    }     	

   public function businessLoansList($limit = 0, $start = 0){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$table_name = "commissions";
			$referral_code = singleDbTableRow($user_id)->referral_code;		 
		 	$currentUser   = singleDbTableRow($user_id)->role;
			
			if($currentUser == 'admin'){
           
				 
			
			$where_array = array('identity' => 'Loans');
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 				
						
			 return $query;
				}
				elseif($currentUser == 'agent'){ 
	
			$where_array = array('identity' => 'Loans');
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 				
						
			 return $query;
				}
			elseif($currentUser == 'user'){ 
		
				
			$where_array = array('identity' => 'Loans');
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 				
						
			 return $query;
		}
	
   }  


  /**
     * Editing Loans and its Schemes
     * 
     */


    public function edit_loan_schemes($id){ 

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$email = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		
        //set all data for inserting into database
        $data = [
			'remarks'		       	=> $this->input->post('remarks'),			
          //  'acct_id'   		 	=> $this->input->post('acct_id'),
          //  'sub_acct_id'       	=> $this->input->post('sub_acct_id'),
            'amount'    			=> $this->input->post('amount'),
			'start_date'       		=> $this->input->post('start_date'),
            'end_date'   		 	=> $this->input->post('end_date'),
            'tenure'       			=> $this->input->post('tenure'),
         //   'benefits'    			=> $this->input->post('benefits'),
		//	'to_role'       		=> $this->input->post('to_role'),
           // 'epin'    			=> $this->input->post('epin'),
			//'transferrable'    		=> $this->input->post('transferrable'),
            'created_by'            => $user_id,
            'created_at'            => time(),
			'modified_by'           => $email, //$user_id,
            'modified_at'           => time()
        ];
		 
        $query = $this->db->where('id', $id)->update('commissions', $data);

        if($query)
        {
            create_activity('Updated '.$data['remarks'].' commissions'); //create an activity
            return true;
        }
        return false;

    }
/**
     Generate Loan Category assigning to User
     */


    public function generate_loans($id){ 

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$email = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$customerID 	= $this->input->post('customerID');
		$account_no     = singleDbTableRow($customerID)->account_no;
		$amount			= $this->input->post('amount');       // Loan Amount
		$loan_id       	= $this->input->post('identity_id');  // Loan ID
		$period      	= $this->input->post('period');		  // Time Tenure
		$tenure     	= $this->input->post('tenure');  	  // Total Tenure of Repayment
		//	$tenure     	= '60';  	  // Total No of repetative records Temporary
		$start_date     = $this->input->post('start_date');   // Loan Start date
		
		//commissionDbTableRow
		$where_array = array('identity_id' => $loan_id, 'identity' => 'Loans');
		$query = $this->db->where($where_array)->get('commissions');
		foreach($query->result() as $r)
		{	
			$acct_id 	 = $r->acct_id;
			$sub_acct_id = $r->sub_acct_id;
		}
						
	
		
			/* Loan Scheme EMI update to Loans  Table for the Assigned role and respective user after loan Approval. */
							//   $start = date('d-m-Y');
							   $start = $start_date;
								if 		($period == '1')	//daily repayment
								{ 	$z = 'day';	 
								}elseif ($period == '7')    //weekly repayent
								{	$z = 'week';
								}elseif ($period == '30')   //monthly repayment
								{	$z = 'month';									
								}
								
								
								$tenure_bal = 0;
								$i = 1;
							//	$tenure = $tenure - 1;	
								for ($x = 1; $x <= $tenure; $x++) {
														
									$date=new DateTime($start);
									$date->modify('+'.$x.$z);								
									
									$tenure_amt = ($amount / $tenure);
									if ($tenure_bal == null)
									{
										$tenure_bal = 0;
									}	
									
									$tenure_bal = $tenure_bal  + $tenure_amt;
									$balance_amt = ($amount - $tenure_bal);
									$deduct_date = 	$date->format('d-m-Y') ;
		//set all data for inserting into database
					 $data = [
							'loan_name'       		=> 'Loan EMI test', //$this->input->post('remarks'),
							'identity_id'       	=> $this->input->post('identity_id'),
							'user_id'				=> $this->input->post('customerID'),
							'account_no'       		=> $account_no,			
							'acct_id'       		=> $acct_id,
							'sub_acct_id'          	=> $sub_acct_id,         
							'amount'         		=> $tenure_bal,
							'emi'					=> $i,
							'deduct_date'			=> $deduct_date,
							'bal_amt'				=> $balance_amt,
							'paid'					=> 'no',
							'start_date'         	=> $this->input->post('start_date'),	
							'end_date'         		=> $this->input->post('end_date'),	
							'tenure'       			=> $tenure,
							'period'       			=> $period,
							'to_role'       		=> $this->input->post('to_role'),				
							'created_by'            => $user_id,
							'created_at'            => time(),
							'modified_at'           => time(),
							'modified_by'           => $user_id
						
						   
							
						];

					   $query = $this->db->insert('loans', $data);		
		/*	Temporary Data for Multiple data Creation
			 $data = [
							'role'       		=> 'admin', //$this->input->post('remarks'),
							'rolename'       	=> '1',
							'page_id'           => $i,
							'access'			=> '1',											
							'created_by'        => $user_id,
							'created_at'        => time(),
							'modified_at'       => time(),
							'modified_by'       => $user_id
										   
							
						];

					   $query = $this->db->insert('authorizations', $data);	*/
		$i++; 
		}												
								
        if($query)
        {
            create_activity('Added '.$data['loan_name'].'loans'); //create an activity
            return true;
        }
        return false;
    }

   
	
	/*================*/
	//Bank details searching
	/*================*/

	public function search_bank_ListCount($contactno,$transaction_type,$ifsc_code,$rolename,$referredByCode,$bank_ifscode,$sf_time,$st_time){
		
		/*$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;*/
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		if($contactno !='')
		{	
			if($condition != ""){
			$condition.="contactno = ".$contactno." ";
			}
			else{
				$condition.="contactno = '".$contactno."'";
			}
		}
		
		if($transaction_type !='')
		{
			if($condition != ""){
				$condition.=" AND transaction_type = '".$transaction_type."'";
			}
			else{
				$condition.="transaction_type = '".$transaction_type."'";
			}
		}
		
		if($ifsc_code !='')
		{
			if($condition != ""){
				$condition.=" AND ifsc_code = '".$ifsc_code."'";
			}
			else{
				$condition.="ifsc_code = '".$ifsc_code."'";
			}
		}
		
		if($rolename !='')
		{
			if($condition != ""){
				$condition.=" AND rolename = '".$rolename."'";
			}
			else{
				$condition.="rolename = '".$rolename."'";
			}
		}
		
		
		if($referredByCode !='')
		{
			if($condition != ""){
				$condition.=" AND referredByCode = '".$referredByCode."'";
			}
			else{
				$condition.="referredByCode = '".$referredByCode."'";
			}
		}
		
		if($bank_ifscode !='')
		{
			if($condition != ""){
				$condition.=" AND bank_ifscode = '".$bank_ifscode."'";
			}
			else{
				$condition.="bank_ifscode = '".$bank_ifscode."'";
			}
		}
		
		
		
	if($sf_time !='' && $st_time !='')
			{
				$start_fdt = new DateTime($sf_time);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_time);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_time !='' && $st_time !=''){
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
			$query = $this->db->where($where_array)->count_all_results('bank');
		}
		else
		{
			$query = $this->db->count_all_results('bank');
		}
		
        return $query;
	
	}
	
	
	
	
	public function search_bank_List($limit=10, $start=0 ,$contactno,$transaction_type,$ifsc_code,$rolename,$referredByCode,$bank_ifscode,$sf_time,$st_time){
		
		/*$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;*/
		$search = $this->input->get('search');	
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		if($contactno !='')
		{	
			if($condition != ""){
			$condition.="contactno = ".$contactno." ";
			}
			else{
				$condition.="contactno = '".$contactno."'";
			}
		}
		
		if($transaction_type !='')
		{
			if($condition != ""){
				$condition.=" AND transaction_type = '".$transaction_type."'";
			}
			else{
				$condition.="transaction_type = '".$transaction_type."'";
			}
		}
		
		if($ifsc_code !='')
		{
			if($condition != ""){
				$condition.=" AND ifsc_code = '".$ifsc_code."'";
			}
			else{
				$condition.="ifsc_code = '".$ifsc_code."'";
			}
		}
		
		if($rolename !='')
		{
			if($condition != ""){
				$condition.=" AND rolename = '".$rolename."'";
			}
			else{
				$condition.="rolename = '".$rolename."'";
			}
		}
		
		
		if($referredByCode !='')
		{
			if($condition != ""){
				$condition.=" AND referredByCode = '".$referredByCode."'";
			}
			else{
				$condition.="referredByCode = '".$referredByCode."'";
			}
		}
		
		if($bank_ifscode !='')
		{
			if($condition != ""){
				$condition.=" AND bank_ifscode = '".$bank_ifscode."'";
			}
			else{
				$condition.="bank_ifscode = '".$bank_ifscode."'";
			}
		}
		
		
		
	if($sf_time !='' && $st_time !='')
			{
				$start_fdt = new DateTime($sf_time);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_time);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_time !='' && $st_time !=''){
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
					
		if($condition !='')
		{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('bank');
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('bank');
		}
        return $query;
	
	}
	
	
	public function get_total_amount($contactno,$transaction_type,$ifsc_code,$rolename,$referredByCode,$bank_ifscode,$sf_time,$st_time){
		
		/*$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;*/
		$search = $this->input->get('search');	
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		if($contactno !='')
		{	
			if($condition != ""){
			$condition.="contactno = ".$contactno." ";
			}
			else{
				$condition.="contactno = '".$contactno."'";
			}
		}
		
		if($transaction_type !='')
		{
			if($condition != ""){
				$condition.=" AND transaction_type = '".$transaction_type."'";
			}
			else{
				$condition.="transaction_type = '".$transaction_type."'";
			}
		}
		
		if($ifsc_code !='')
		{
			if($condition != ""){
				$condition.=" AND ifsc_code = '".$ifsc_code."'";
			}
			else{
				$condition.="ifsc_code = '".$ifsc_code."'";
			}
		}
		
		if($rolename !='')
		{
			if($condition != ""){
				$condition.=" AND rolename = '".$rolename."'";
			}
			else{
				$condition.="rolename = '".$rolename."'";
			}
		}
		
		
		if($referredByCode !='')
		{
			if($condition != ""){
				$condition.=" AND referredByCode = '".$referredByCode."'";
			}
			else{
				$condition.="referredByCode = '".$referredByCode."'";
			}
		}
		
		if($bank_ifscode !='')
		{
			if($condition != ""){
				$condition.=" AND bank_ifscode = '".$bank_ifscode."'";
			}
			else{
				$condition.="bank_ifscode = '".$bank_ifscode."'";
			}
		}
		
		
		
	if($sf_time !='' && $st_time !='')
			{
				$start_fdt = new DateTime($sf_time);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_time);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_time !='' && $st_time !=''){
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
					
		if($condition !='')
		{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->where($where_array )->get('bank');
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->get('bank');
		}
        return $query;
       
	
	}
	
	/*================*/
	
	
	
}