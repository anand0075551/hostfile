<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vouchers_model extends CI_Model {

    /**
     * @return bool
     */

	 //For Voucher Table generate List	
	public function get_voucher($user_id, $total_price, $pay_type, $paytype_to ){	
	$split_amt = ((($total_price * 30 )/ 100) / 10);
	
	$today_date = date("Y-m-d"); 
	 $email = singleDbTableRow($user_id)->email;
	 $account_no = singleDbTableRow($user_id)->account_no;
	for($i=1; $i<=10; $i++)
	{
		$this->load->helper('string'); //load string helper	
	//	$Epin  = random_string('alphanumeric',12);   //Modified to 10 digit	
		$Epin  = strtoupper(random_string())	;	
        //check unique $referral_code
        $getEpin = $this->db->get_where('vouchers', ['voucher_id'=> $Epin]);
        if($getEpin -> num_rows() > 0)
        {
            for($i= 0; $getEpin -> num_rows() > 0; $i++){
                $Epin  = strtoupper(random_string(10)); //comment next line for integer only
				//$Epin .= mt_rand(0, 9);
                $getEpin = $this->db->get_where('vouchers', ['voucher_id'=> $Epin]);
            }
        }

		$new_date = $today_date;
		$monthlyDate = strtotime("+".$i." month".$today_date);
		$monthly = date("Y-m-d", $monthlyDate);
	//echo $monthly;		
		$otp  = $this->product_model->generatePIN();	
		$datav = [
							'voucher_name' 			=> '24',  //Value is from Staus Table All Vouchers Business Groups
							'user_id'				=> $user_id,
							'account_no'			=> $account_no,
							'email'					=> $email,
							'voucher_id' 			=> $Epin,
							'pay_type' 				=> '66',
							'amount'   				=> $split_amt, 
							'points_mode' 			=> 'wallet',
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

						$this->db->insert('vouchers', $datav);	
		}
	}
	
//Event Manager Action For Voucher Table generate List 	
	public function get_voucher_event($c_id, $total_price, $pay_type ){	
	
	$user_id = $c_id;
	$split_amt = ((($total_price * 50 )/ 100) / 10);
	
	$today_date = date("Y-m-d"); 
	 $email = singleDbTableRow($user_id)->email;
	 $account_no = singleDbTableRow($user_id)->account_no;
	for($i=1; $i<=10; $i++)
	{
		$this->load->helper('string'); //load string helper	
	//	$Epin  = random_string('alphanumeric',12);   //Modified to 10 digit	
		$Epin  = strtoupper(random_string())	;	
        //check unique $referral_code
        $getEpin = $this->db->get_where('vouchers', ['voucher_id'=> $Epin]);
        if($getEpin -> num_rows() > 0)
        {
            for($i= 0; $getEpin -> num_rows() > 0; $i++){
                $Epin  = strtoupper(random_string(10)); //comment next line for integer only
				//$Epin .= mt_rand(0, 9);
                $getEpin = $this->db->get_where('vouchers', ['voucher_id'=> $Epin]);
            }
        }

		$new_date = $today_date;
		$monthlyDate = strtotime("+".$i." month".$today_date);
		$monthly = date("Y-m-d", $monthlyDate);
	//echo $monthly;		
		$otp  = $this->product_model->generatePIN();	
		$datav = [
							'voucher_name' 			=> '136',   //Value is from Staus Table All Vouchers Business Groups
							'user_id'				=> $user_id,
							'account_no'			=> $account_no,
							'email'					=> $email,
							'voucher_id' 			=> $Epin,
							'pay_type' 				=> '66',
							'amount'   				=> $split_amt, 
							'points_mode' 			=> 'wallet',
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

						$this->db->insert('vouchers', $datav);	
		}
	}	
	
    public function add_vouchers(){
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
		 
		$identity_id = "VOC_".$epin;
		//$identity_id = $epin;
		
        //set all data for inserting into database
        $data = [
			'identity' 		  => 'Voucher',
			'identity_id'	  => $identity_id,
			'type'			  => $this->input->post('voc_type'),
            'remarks'         => $this->input->post('voucher_name'),
			'amount'          => $this->input->post('amount'),
			'loy_amt'         => $this->input->post('loy_amt'),
			'dis_amt'         => $this->input->post('dis_amt'),
			'acct_id'         => $this->input->post('acct_id'),
			'sub_acct_id'     => $this->input->post('sub_acct_id'),
			'from_role'       => $this->input->post('from_role'),
			'start_date'      => $this->input->post('start_date'),
            'end_date'   	  => $this->input->post('end_date'),
			'from_role'       => $user_id,			
			'to_role'     	  => $this->input->post('to_role'),
			'commission'      => '0', //$this->input->post('commission'),
			'benefits'    	  => '0', //$this->input->post('benefits'),
			'transferrable'   => $this->input->post('transferrable'),
			'created_by'	  => $user_id,
			'modified_by'	  => $user_id,
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
     * Insert Splitting Vouchers
     */

    public function split_vouchers(){
		
		$this->load->helper('string'); //load string helper
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$epin  = random_string('numeric',10);
		
		//check unique $epin
        $getEpin = $this->db->get_where('commissions', ['identity_id'=> $epin]);
        if($getEpin -> num_rows() > 0)
        {
            for($i= 0; $getEpin -> num_rows() > 0; $i++){
                $epin  = strtoupper(random_string());
                $getEpin = $this->db->get_where('commissions', ['identity_id'=> $epin]);
            }
        }
		 
		$identity_id = "VOC_".$epin;
		//$identity_id = $epin;
		
// Voucher Selection Type for Self or Other
		$beneficiary = $this->input->post('beneficiary');
		if ($beneficiary == 'self')
		{
			$to_role = $user_id;
		}else{
			$to_role = $beneficiary;
		}
// Amount selected for Points Mode
		$points_mode = $this->input->post('conv_type');
		if ($points_mode = 'wallet' )
		{
			$amount   = $this->input->post('amount');
			$discount = '0';
		}else{
			$amount   ='0';
			$discount = $this->input->post('amount');
		}
		
        //set all data for inserting into database
        $data = [
			'identity' 		  => 'Split_Voucher',
			'identity_id'	  => $identity_id,
            'remarks'         => $this->input->post('voucher_name'),
			'start_date'      => $this->input->post('start_date'),
            'end_date'   	  => '9999-31-12', //Assuming Unlimited Validity

			'acct_id'         => $this->input->post('acct_id'),
			'sub_acct_id'     => $this->input->post('sub_acct_id'),
			'amount'          => $amount,
			'loy_amt'         => '0', //WE DO NOT CONSIDER IN THIS EXECUTION
			'dis_amt'         => $discount,			
			
			'from_role'       => $user_id,			
			'to_role'     	  => $to_role,  //Self or other selected User
			'commission'      => '0', //$this->input->post('commission'),
			'benefits'    	  => '0', //$this->input->post('benefits'),
			'seller_loyality' => '0',
			'client_loyality' => '0',
			'transferrable'   => $this->input->post('transferrable'),
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
	
	//Create Private PIN and update in Vouchers Table
		
		public function create_vouchers($id){
		
	   $this->load->helper('string'); //load string helper
 
       $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$epin  = random_string('alphanumeric',20);
		
		
		$currentUser   = singleDbTableRow($user_id)->role;
		$account_no    = singleDbTableRow($user_id)->account_no;
		$rolename   = singleDbTableRow($user_id)->rolename;		
		$email   	= singleDbTableRow($user_id)->email;
					
	   	$this->load->helper('string'); 
        $user_info 		= $this->session->userdata('logged_user');
        $user_id 		= $user_info['user_id'];
		$role		    = $currentUser;
		
		$voucher_name   = $this->input->post('voucher_name');
		$voucher_type   = $this->input->post('voucher_type');
		$points_mode    = $this->input->post('trans_type');		
		$voucher_id     = $this->input->post('voucher_id');
		$tranx_id1       = "Deduction for the ID: ". $voucher_id;
	
	//Based on the User's Purchase Mode selection, Respective points will be effective.			
		if ($points_mode == 'wallet')
		{	$credit		= 	$this->input->post('amount');
		}elseif ($points_mode == 'loyality')
		{	$credit		= 	$this->input->post('loy_amt');
		}elseif ($points_mode == 'discount')
		{	$credit		= 	$this->input->post('dis_amt');
		}
 $pay_type = '84'; //Vouchers Points Deduction
	//set all data for inserting into database
        $data1 = [
            'user_id'         		=> $user_id, 
			'account_no'         	=> $account_no,			
            'rolename'				=> $rolename,
			'email'					=> $email,	
			'debit'         		=> '0',            
			'credit'         		=> $credit,			
			'amount'         		=> $credit,	
			'points_mode' 			=> $points_mode,
			'used'					=> 'yes',
			'paid_to'				=> '00',
			'pay_type'         		=> $pay_type,
			'tranx_id'				=> $tranx_id1,	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query1 = $this->db->insert('accounts', $data1);
	   
	   
	   $tranx_id2       = "Purchase for the ID: ". $voucher_id;
	//Based on the User's Purchase Mode selection, Respective points will be effective.	
      	if ($points_mode == 'wallet')
		{	$debit		= 	$this->input->post('amount');
		}elseif ($points_mode == 'loyality')
		{	$debit		= 	$this->input->post('loy_amt');
		}elseif ($points_mode == 'discount')
		{	$debit		= 	$this->input->post('dis_amt');	
		}
        //set all data for inserting into database
        $data2 = [
            'user_id'         		=> $user_id, 
			'account_no'         	=> $account_no,			
            'rolename'				=> $rolename,
			'email'					=> $email,	
			'debit'         		=> $debit,            
			'credit'         		=> '0',			
			'amount'         		=> $debit,	
			'points_mode' 			=> 'voucher',
			'used'					=> 'no',
			'paid_to'				=> '00',
			'pay_type'         		=> $pay_type,
			'tranx_id'				=> $tranx_id2,	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query2 = $this->db->insert('accounts', $data2);
	   
	   //check unique $epin
        $getEpin = $this->db->get_where('vouchers', ['epin'=> $epin]);
        if($getEpin -> num_rows() > 0)
        {
            for($i= 0; $getEpin -> num_rows() > 0; $i++){
                $epin  = strtoupper(random_string());
                $getEpin = $this->db->get_where('Vouchers', ['epin'=> $epin]);
            }
        }
		$voucher_name = $this->input->post('voucher_name');
		$voucher_id = $this->input->post('voucher_id');
		
		$query3 = $this->db->get_where('commissions', ['identity_id'=> $voucher_id]);
		foreach($query3->result() as $r)			
		 $remarks		= $r->remarks;	
		 $start_date    = $r->start_date;
		 $end_date      = $r->end_date;
		 $to_role    	= $r->to_role;
		if ($to_role == NULL)
		{ $to_role 	= $this->input->post('to_role');
		}
	//Based on the User's Purchase Mode selection, Respective points will be effective.	
		if ($points_mode == 'wallet')
		{	$amount		= 	$this->input->post('amount');
		}elseif ($points_mode == 'loyality')
		{	$amount		= 	$this->input->post('loy_amt');
		}elseif ($points_mode == 'discount')
		{	$amount		= 	$this->input->post('dis_amt');	
		}
		
        //set all data for inserting into database
      $data3 = [
            'voucher_name'       	=> $voucher_name,
			'identity_id'			=> $voucher_id,
			'type'					=> $voucher_type,
			'account_no'       		=> $account_no,
			'amount'         		=> $amount,			
			'points_mode'			=> $points_mode,
			'to_role'       		=> $to_role,				
            'start_date'         	=> $start_date,	
			'end_date'         		=> $end_date,		 	
			'used'					=> 'no',			
			'epin'         			=> $epin,			
            'created_by'            => $user_id,
			'modified_by'           => $user_id,
			'transferrable'       	=> 'no',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query3 = $this->db->insert('vouchers', $data3);

        if($query3)
        {
            create_activity('Transaction of  '.$data['voucher_name'].' vouchers'); //create an activity
            return true;
        }
        return false;   

    }
	
	//Create Private PIN By USERs/Agents and update in accounts Table
		public function private_vouchers(){
		
	   $this->load->helper('string'); //load string helper
 
       $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$epin  = random_string('alphanumeric',20);
		
		
		$currentUser   = singleDbTableRow($user_id)->role;
		$rolename   = singleDbTableRow($user_id)->rolename;
		$account_no    = singleDbTableRow($user_id)->account_no;
		
	   	$this->load->helper('string'); 
        $user_info 		= $this->session->userdata('logged_user');
        $user_id 		= $user_info['user_id'];
		$role		    = $currentUser;
		
		$voucher_name   = $this->input->post('voucher_name');
		$points_mode    = $this->input->post('trans_type');
		
		
	/*	$query = $this->db->get_where('commissions', ['identity_id' => $voucher_name]);
		foreach($query->result() as $r)			
		 $voucher_id    = $r->identity_id;  */
		 $pay_type       = '84';
		

		$credit		= 	$this->input->post('amount');			
 
	//set all data for inserting into database
        $data1 = [
            'user_id'         		=> $user_id, 
			'account_no'         	=> $account_no,
            'role '  			    => $role,
			'debit'         		=> '0',            
			'credit'         		=> $credit,			
			'amount'         		=> $credit,	
			'points_mode' 			=> $points_mode,
			'used'					=> 'yes',
			'paid_to'				=> '00',
			'pay_type'         		=> $pay_type,
			'tranx_id'				=> 'Vocuher Transaction' ,	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query1 = $this->db->insert('accounts', $data1);

      //check unique $epin
	  
        $getEpin = $this->db->get_where('vouchers', ['epin'=> $epin]);
        if($getEpin -> num_rows() > 0)
        {
            for($i= 0; $getEpin -> num_rows() > 0; $i++)
			{
                $epin  = strtoupper(random_string());
                $getEpin = $this->db->get_where('Vouchers', ['epin'=> $epin]);
            }        
		}
				
		$data['commissions'] = singleDbTableRow($id,'commissions');
		
		$identity_id = commissionDbTableRow($id)->identity_id;
		
        //set all data for inserting into database
      $data2 = [
            'voucher_name'       	=> $this->input->post('voucher_name'),
			'account_no'       		=> $account_no,
			'amount'         		=> $this->input->post('amount'),			
			'identity_id'       	=> $identity_id,
		/*	'sub_acct_id'          	=> $this->input->post('sub_acct_id'),  
			'commission'       		=> $this->input->post('commission'),
			'benefits'       		=> $this->input->post('benefits'),	*/ 	      
			'to_role'       		=> $this->input->post('to_role'),	
			
            'start_date'         	=> $start_date,	
			'end_date'         		=> $end_date,			
			'used'					=> 'no',			
			'epin'         			=> $epin,			
            'added_by'              => $user_id,
			'modified_by'           => $user_id,
			'transferrable'       	=> 'no',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query2 = $this->db->insert('vouchers', $data2);

        if($query2)
        {
            create_activity('Transaction of  '.$data['pay_type'].' vouchers'); //create an activity
            return true;
        }
        return false;
    }
	
		
   /**
     * @param $id
     * @return bool
     * Update Vouchers/Category
     */


    public function edit_vouchers($id){ 

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$email = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		 if($currentUser == 'admin'){
        //set all data for inserting into database
        $data = [
			'remarks'		       	=> $this->input->post('voucher_name'),			
          //  'acct_id'   		 	=> $this->input->post('acct_id'),
          //  'sub_acct_id'       	=> $this->input->post('sub_acct_id'),
            'amount'    			=> $this->input->post('amount'),
			'start_date'       		=> $this->input->post('start_date'),
            'end_date'   		 	=> $this->input->post('end_date'),
            'commission'       		=> $this->input->post('commission'),
            'benefits'    			=> $this->input->post('benefits'),
		//	'to_role'       		=> $this->input->post('to_role'),
           // 'epin'    			=> $this->input->post('epin'),
			'transferrable'    		=> $this->input->post('transferrable'),
            'created_by'            => $user_id,
            'created_at'            => time(),
			'modified_by'           => $user_id,
            'modified_at'           => time()
        ];
		 }
		else{
			 //set all data for inserting into database
        $data = [
			'remarks'	        	=> $this->input->post('voucher_name'),			
         //   'acct_id'   		 	=> $this->input->post('acct_id'),
         //   'sub_acct_id'       	=> $this->input->post('sub_acct_id'),
            'amount'    			=> $this->input->post('amount'),
			'start_date'       		=> $this->input->post('start_date'),
            'end_date'   		 	=> $this->input->post('end_date'),
            'commission'       		=> $this->input->post('commission'),
            'benefits'    			=> $this->input->post('benefits'),
		//	'to_role'       		=> $this->input->post('to_role'),
         //   'epin'    				=> $this->input->post('epin'),
			'transferrable'    		=> $this->input->post('transferrable'),
            'created_by'            => $user_id,
            'created_at'            => time(),
			'modified_by'           => $email,
            'modified_at'           => time()
        ];
		}
        $query = $this->db->where('id', $id)->update('commissions', $data);

        if($query)
        {
            create_activity('Updated '.$data['remarks'].' commissions'); //create an activity
            return true;
        }
        return false;

    }


/**
     * @param $id
     * @return bool
     * Update Category
     */


    public function generate_vouchers($id){ 

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$email = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		$rolename 	   = singleDbTableRow($user_id)->rolename;
		$account_no    = singleDbTableRow($user_id)->account_no;
					
					//load string helper
		$this->load->helper('string'); 
		$epin  = random_string('alphanumeric',20);
					//check unique $epin
        $getEpin = $this->db->get_where('vouchers', ['epin'=> $epin]);
        if($getEpin -> num_rows() > 0)
        {
            for($i= 0; $getEpin -> num_rows() > 0; $i++){
                $epin  = strtoupper(random_string());
                $getEpin = $this->db->get_where('Vouchers', ['epin'=> $epin]);
            }
        }
		
        //set all data for inserting into database
         $data = [
            'voucher_name'       	=> $this->input->post('voucher_name'),
			'identity_id'       	=> $this->input->post('identity_id'),
			'account_no'       		=> $account_no,			
			'acct_id'       		=> $this->input->post('acct_id'),
			'sub_acct_id'          	=> $this->input->post('sub_acct_id'),         
            'amount'         		=> $this->input->post('amount'),
            'start_date'         	=> $this->input->post('start_date'),	
			'end_date'         		=> $this->input->post('end_date'),	
			'commission'       		=> $this->input->post('commission'),
			'benefits'       		=> $this->input->post('benefits'),
			'to_role'       		=> $this->input->post('to_role'),
			'epin'         			=> $epin,			
            'added_by'              => $user_id,
			'modified_by'           => $user_id,
			'transferrable'       	=> $this->input->post('transferrable'),
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('Vouchers', $data);

        if($query)
        {
            create_activity('Added '.$data['voucher_name'].'Vouchers'); //create an activity
            return true;
        }
        return false;
    }


  /**
     * @return Agent List
     * Private Voucher List Query
     */

    public function vouchersListCount(){
      /*  $queryCount = $this->db->count_all_results('vouchers');
        return $queryCount;
    }*/
	
	$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$referral_code = singleDbTableRow($user_id)->referral_code;
		$currentUser   = singleDbTableRow($user_id)->role;
		$rolename      = singleDbTableRow($user_id)->rolename;
			$email   = singleDbTableRow($user_id)->email;
       
		 if($currentUser == 'admin'){
            $queryCount = $this->db->count_all_results('vouchers');
			return $queryCount;		
				}
		
		else{ 
			$queryCount = $this->db->where( 'email' , $email )->count_all_results('vouchers');			
			// $queryCount = $this->db->count_all_results('vouchers');
			return $queryCount;
				}
        
    }     
           
				
			
	

   public function vouchersList($limit = 0, $start = 0){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
			$referral_code = singleDbTableRow($user_id)->referral_code;		 
		 	$currentUser   = singleDbTableRow($user_id)->role;
			$email   = singleDbTableRow($user_id)->email;
			
			if($currentUser == 'admin'){
           
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('vouchers', ['user_id' =>$user_id]); 		
						
			 return $query;
				}
			else{ 
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('vouchers', ['email' =>$email]); 
				
			 return $query;
		}
	
   }
   

 /**
     * @return Agent List
     * Business Voucher List Query
     */

    public function businessVouchersListCount(){
      /*  $queryCount = $this->db->count_all_results('vouchers');
        return $queryCount;
    }*/
	
	$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$referral_code = singleDbTableRow($user_id)->referral_code;
		$currentUser   = singleDbTableRow($user_id)->role;
		
       
		 if($currentUser == 'admin'){
            $queryCount = $this->db->where('identity', 'Voucher')->count_all_results('commissions');
			return $queryCount;		
				}
		elseif($currentUser == 'agent'){ 
			$queryCount = $this->db->where('identity', 'Voucher')->count_all_results('commissions');			
			// $queryCount = $this->db->count_all_results('vouchers');
			return $queryCount;
				}
		elseif($currentUser == 'user'){ 
			$queryCount = $this->db->where( 'identity', 'Voucher' )->count_all_results('commissions');			
			// $queryCount = $this->db->count_all_results('vouchers');
			return $queryCount;
				}       
    }     	

   public function businessVouchersList($limit = 0, $start = 0){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
			$referral_code = singleDbTableRow($user_id)->referral_code;		 
		 	$currentUser   = singleDbTableRow($user_id)->role;
			$rolename      = singleDbTableRow($user_id)->rolename;
			
			if($currentUser == 'admin')
			{
           		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('commissions', ['identity' =>'Voucher']); 		
			 
			 }elseif($rolename == '24'){ //'24'- Agent Role Name
			$table_name = "commissions";
			$where_array = array('identity' =>'Voucher', 'to_role' =>'24');
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 
				 		
			 }elseif($rolename == '23'){ //'23'- Customer Role Name
			$table_name = "commissions";
			$where_array = array('identity' =>'Voucher', 'to_role' =>'23');
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}
	return $query;
   }   
   
   
   /**
     * 	//Voucher PINlist from Vouchers Table
     */

    public function vouchersPINListCount(){
     
	
	$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$referral_code = singleDbTableRow($user_id)->referral_code;
		$currentUser   = singleDbTableRow($user_id)->role;
		
       
		 if($currentUser == 'admin'){
            $queryCount = $this->db->where('identity', 'Voucher')->count_all_results('vouchers');
			return $queryCount;		
				}
		elseif($currentUser == 'agent'){ 
			$queryCount = $this->db->where('to_role' , '24')->count_all_results('vouchers');			
			
			return $queryCount;
				}
		elseif($currentUser == 'user'){ 
			$queryCount = $this->db->where( 'to_role' , '22' )->count_all_results('vouchers');			
			
			return $queryCount;
				}
        
    }     
           			
			
	//Voucher PINlist from Vouchers Table

   public function vouchersPINList($limit = 0, $start = 0){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
			$referral_code = singleDbTableRow($user_id)->referral_code;		 
		 	$currentUser   = singleDbTableRow($user_id)->role;
			
			if($currentUser == 'admin'){
           
				$query = $this->db->query("select commissions.*, users.first_name, users.last_name
						from commissions LEFT JOIN users
						ON commissions.created_by = users.id ORDER BY commissions.id DESC Limit {$start}, {$limit}");
			 return $query;
				}
				elseif($currentUser == 'agent'){ 
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('vouchers', ['to_role' => '24']); 
			
			 return $query;
				}
			elseif($currentUser == 'user'){ 
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('vouchers', ['to_role' => '22']); 
				
			 return $query;
		}
	
   }
  /**
     * Ledger Account Details
     * 
     */
    public function add_ledger(){
 $this->load->helper('string'); //load string helper
 
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename   = singleDbTableRow($user_id)->rolename;
		$account_no	= singleDbTableRow($user_id)->account_no;
		$email   	= singleDbTableRow($user_id)->email;
	
		
        //set all data for inserting into database
        $data = [
            'user_id'         		=> $user_id, // $this->input->post('vouchers_name'),
            'invoice_id '  			=> 'add_ledger',
			'rolename'				=> $rolename,
			'account_no'			=> $account_no,
			'email'					=> $email,
            'amount'         		=> $this->input->post('capital'),
            'capital'         		=> $this->input->post('capital'),
			'liabilities'         	=> $this->input->post('liabilities'),
            'cash'         			=> $this->input->post('cash'),						
            'start_date'         	=> '2010-01-01',					
			'pay_type'				=> 'transfer',
			'remarks'         		=> $this->input->post('remarks'),	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data);

        if($query)
        {
            create_activity('Added '.$data['remarks'].' ledger'); //create an activity
            return true;
        }
        return false;

    }


   /**
     * @param $id
     * @return bool
     * Update Category
     */


    public function edit_ledger($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'capital'        			=> $this->input->post('capital'),
			'amount'         		=> $this->input->post('amount'),			
            'start_date'         	=> $this->input->post('start_date'),	
			'end_date'         		=> $this->input->post('end_date'),
        //    'commission_percent'    => $this->input->post('commission_percent'),
            'added_by'              => $user_id,
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $query = $this->db->where('id', $id)->update('ledger', $data);

        if($query)
        {
            create_activity('Updated '.$data['capital'].' ledger'); //create an activity
            return true;
        }
        return false;

    }





  /**
     * @return Agent List
     * Agent List Query
     */

    public function ledgerListCount(){
        $query = $this->db->count_all_results('ledger');
        return $query;
    }

    public function ledgerList($limit = 0, $start = 0){
        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->join('users', 'users.id = ledger.added_by')->get('ledger');
        return $query;
    }


// Transfer Vouchers..	
	

 public function transferrable_vouchers_ListCount(){
     
	
	$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$referral_code = singleDbTableRow($user_id)->referral_code;
		$currentUser   = singleDbTableRow($user_id)->role;
		$rolename      = singleDbTableRow($user_id)->rolename;
			$email   = singleDbTableRow($user_id)->email;
       
		 if($currentUser == 'admin'){
            $queryCount = $this->db->count_all_results('vouchers');
			return $queryCount;		
				}
		
		else{ 
			$query = $this->db->get_where('vouchers',['email' =>$email, 'transferrable'=>'yes', 'transferred_to'=>'0'] );		
			$queryCount = $query->num_rows();
			return $queryCount;
				}
        
    }     
           
				
			
	

   public function transferrable_vouchers_List($limit = 0, $start = 0){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
			$referral_code = singleDbTableRow($user_id)->referral_code;		 
		 	$currentUser   = singleDbTableRow($user_id)->role;
			$email   = singleDbTableRow($user_id)->email;
			
			if($currentUser == 'admin'){
           
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('vouchers', ['user_id' =>$user_id, 'transferrable'=>'yes', 'transferred_to'=>'0']); 		
						
			 return $query;
				}
			else{ 
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('vouchers', ['email' =>$email, 'transferrable'=>'yes', 'transferred_to'=>'0']); 
				
			 return $query;
		}
	
   }
	
	 public function transfer_voucher(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

		$to_user =  $this->input->post('to_user');
		$to_user_email = singleDbTableRow($to_user)->email;
		$to_user_acc_no = singleDbTableRow($to_user)->account_no;
		
		$voucher_id =  implode("," ,$this->input->post('voucher_id'));
		
		$vouchers = explode("," , $voucher_id);
		
		foreach($vouchers as $voc){
			//set all data for inserting into database
			$data = [
				'voucher_name'        		=> singleDbTableRow($voc, 'vouchers')->voucher_name,
				'voucher_description'       => singleDbTableRow($voc, 'vouchers')->voucher_description,
				'voucher_id'      			=> singleDbTableRow($voc, 'vouchers')->voucher_id,
				'user_id'      				=> $to_user,
				'email'      				=> $to_user_email,
				'pay_type'      			=> singleDbTableRow($voc, 'vouchers')->pay_type,
				'paytype_to'      			=> singleDbTableRow($voc, 'vouchers')->paytype_to,
				'account_no'      			=> $to_user_acc_no,
				'amount'      				=> singleDbTableRow($voc, 'vouchers')->amount,
				'points_mode'      			=> singleDbTableRow($voc, 'vouchers')->points_mode,
				'loy_amt'      				=> singleDbTableRow($voc, 'vouchers')->loy_amt,
				'dis_amt'      				=> singleDbTableRow($voc, 'vouchers')->dis_amt,
				'used'      				=> 'no',
				'used_by'      				=> '0',
				'reserved'      			=> '',
				'reserved_at'      			=> '0',
				'reserved_by'      			=> '0',
				'start_date'      			=> singleDbTableRow($voc, 'vouchers')->start_date,
				'end_date'      			=> singleDbTableRow($voc, 'vouchers')->end_date,
				'commission'      			=> singleDbTableRow($voc, 'vouchers')->commission,
				'benefits'      			=> singleDbTableRow($voc, 'vouchers')->benefits,
				'to_role'      				=> singleDbTableRow($voc, 'vouchers')->to_role,
				'created_by'      			=> $user_id,
				'created_at'      			=> time(),
				'transferrable'      		=> 'no',
				'transferred_by'      		=> $user_id,
				'transferred_to'      		=> $to_user,
			];

			$data2 = [
				'used'      				=> 'yes',
				'used_by'      				=> '0',
				'reserved'      			=> 'yes',
				'reserved_at'      			=> time(),
				'reserved_by'      			=> '0',
				'modified_at'      			=> time(),
				'modified_by'      			=> $user_id,
				'transferred_by'      		=> $user_id,
				'transferred_to'      		=> $to_user,
			];
			
		
			
			$query = $this->db->insert('vouchers', $data);
			
			$where_array = array('id' => $voc, 'user_id' =>$user_id);
			
			$query2 = $this->db->where($where_array)->update('vouchers', $data2);
		
		}
		
        if($query && $query2)
        {
            create_activity('Transferd '.$data['voucher_description'].' Voucher'); //create an activity
            return true;
        }
        return false;

    }
	
	
	 public function transferred_vouchers_ListCount(){
      /*  $queryCount = $this->db->count_all_results('vouchers');
        return $queryCount;
    }*/
	
	$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$referral_code = singleDbTableRow($user_id)->referral_code;
		$currentUser   = singleDbTableRow($user_id)->role;
		$rolename      = singleDbTableRow($user_id)->rolename;
			$email   = singleDbTableRow($user_id)->email;
       
		 if($currentUser == 'admin'){
            $queryCount = $this->db->count_all_results('vouchers');
			return $queryCount;		
				}
		
		else{ 
			$condition = " email = '".$email."' AND transferred_by = '".$user_id."' AND modified_by ='".$user_id."' ";
			$query = $this->db->where($condition)->get('vouchers');		
			$queryCount = $query->num_rows();
			return $queryCount;
				}
        
    }     
           
	public function transferred_vouchers_List($limit = 0, $start = 0){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
			$referral_code = singleDbTableRow($user_id)->referral_code;		 
		 	$currentUser   = singleDbTableRow($user_id)->role;
			$email   = singleDbTableRow($user_id)->email;
			
			if($currentUser == 'admin'){
           
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('vouchers', ['user_id' =>$user_id]); 		
						
			 return $query;
				}
			else{ 
				$condition = " email = '".$email."' AND transferred_by = '".$user_id."' AND modified_by ='".$user_id."' ";
				$query = $this->db->order_by('modified_at', 'desc')->limit($limit, $start)->where($condition)->get('vouchers'); 
				
			 return $query;
		}
	
   }
	
// Vouchers Report.............
	 public function all_vouchers_ListCount(){
   
	$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$referral_code = singleDbTableRow($user_id)->referral_code;
		$currentUser   = singleDbTableRow($user_id)->role;
		$rolename      = singleDbTableRow($user_id)->rolename;
			$email   = singleDbTableRow($user_id)->email;
       
		 if($currentUser == 'admin'){
            $queryCount = $this->db->count_all_results('vouchers');
			return $queryCount;		
			}
		
		else{ 
			$queryCount = $this->db->where( 'email' , $email )->count_all_results('vouchers');	
			return $queryCount;
			}
        
    }     
           
	public function all_vouchers_List($limit = 0, $start = 0){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
			$referral_code = singleDbTableRow($user_id)->referral_code;		 
		 	$currentUser   = singleDbTableRow($user_id)->role;
			$email   = singleDbTableRow($user_id)->email;
			
			if($currentUser == 'admin'){
           
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('vouchers'); 		
						
			 return $query;
				}
			else{ 
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('vouchers', ['email' =>$email, 'used'=>'yes']); 
				
			 return $query;
		}
	
   }
	
	
	public function voucher_search($limit, $start, $voc_type, $maturation_type, $usage, $transfarable, $from_date, $to_date){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
	
			$condition="";
		
		
		
		if($voc_type !='')
		{
			$condition.=" voucher_name = '".$voc_type."'";
		}
		
		if($usage !='')
		{
			$condition.=($condition !='' ) ? " AND used = '".$usage."' " : " used = '".$usage."'" ;
		}
		
		if($transfarable !='')
		{
			if($condition != ""){
				$condition.=" AND transferrable = '".$transfarable."'";
			}
			else{
				$condition.=" transferrable = '".$transfarable."'";
			}
		}
		
		$today = date("Y-m-d"); 
		if($maturation_type !='')
		{
			if($maturation_type =='matured')
			{
				if($condition != ""){
					$condition.=" AND start_date <= '".$today."'";
				}
				else{
					$condition.=" start_date <= '".$today."'";
				}
			}
			if($maturation_type =='not_matured')
			{
				if($condition != ""){
					$condition.=" AND start_date > '".$today."'";
				}
				else{
					$condition.=" start_date > '".$today."'";
				}
				
			}
		}
		
		
		if($from_date !='' && $to_date !=''){
			if($condition != ""){
				$condition.=" AND start_date >= '".$from_date."' AND start_date <= '".$to_date."'";
			}
			else{
				$condition.=" start_date >= '".$from_date."' AND start_date <= '".$to_date."'";
			}
		}
		
		
		if($rolename != 11){
			if($condition != ""){
				$condition.=" AND email = '".$email."' AND used = 'yes' ";
			}
			else{
				$condition.=" email = '".$email."' AND used = 'yes' ";
			}
		}
		
		if($condition !='')
		{
			$where_array =$condition;
		}
		
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('vouchers'); 
		
        return $query;
	}
	

}