<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model {


    /**
     *  Authonication check here
     * @return bool
     */

    public function authonication(){

        $this->load->library('user_agent');

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $password = sha1($password);

        $credential = [
            'email' => $email,
            'password' => $password,
        ];

        $query = $this->db->get_where('users', $credential);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r);

            if($r->active == 0)
            {
                $this->session->set_flashdata('loggedIn_fail', 'Account is not active yet !');
                return false;
            }elseif($r->active == 2){
                $this->session->set_flashdata('loggedIn_fail', 'An error occur with your account !');
                return false;
            }elseif ($r->active == 3) {
                $this->session->set_flashdata('loggedIn_fail', 'Your account is Blocked by Administrator !');
                return false;
            }

            /**
             * data for store in session
             */

            $user_data = [
                'email' => $email,
                'user_id' => $r->id,
                'role' => $r->role,
                'logged_in' => true,
            ];

            // set user status = online
            $login_update = [
                'online_status' => 1,
                'user_lastlogin' => time()
            ];
            $this->db->where('id', $r->id)->update('users', $login_update);

            //store login info in session
            $this->session->set_userdata('logged_user', $user_data);

            // insert user agent and ip into log
            $user_agent = $this->agent->agent_string();

            $user_device_info = [
                'user_id' => $r->id,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'device_info' => $user_agent,
                'created_at' => time()
            ];

            $this->db->insert('log', $user_device_info);

            return true;
        } else {
            $this->session->set_flashdata('loggedIn_fail', 'Wrong email or password !');
            return false;
        }
    }


   /**
     * registerUser() method
     *
     * @return bool
     */

    public function registerUser(){

        $this->load->helper('string'); //load string helper
		
		$postal_code    = $this->input->post('postal_code');
        $row_password   = $this->input->post('password');
        $password       = sha1($row_password);
       // $referral_code  = random_string('numeric',6);
		 $referral_code  = random_string('numeric',10);   //Modified to 10 digit
	//	$account_no     = random_string('numeric',17);
		
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
		
	
        $email = $this->input->post('email');
        $country_id = '105'; //$this->input->post('country');
		
        // get country name
        $country_query = $this->db->get_where('countries', ['id' => $country_id]);
        foreach($country_query->result() as $country);

        $photoName = '';

        //check user is selected photo
        if(isset($_FILES['userfile']))
        {
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
        }
$rolename = '12'; //$this->input->post('rolename'); //Consumer/Volunteer
$referredByCode = $this->input->post('referredByCode');
$fname = $this->input->post('first_name');


$account_no =  $country_id.$postal_code.$rolename.$referral_code;

        //set all data for inserting into database
        $data = [
            'root_id'			=> $referral_code,
            'first_name'        => ucfirst ($this->input->post('first_name')),
            'last_name'         => ucfirst ($this->input->post('last_name')),
            'password'          => $password,
            'row_pass'          => $row_password,
            'email'             => strtolower($email),
            'contactno'         => $this->input->post('contactno'),
        //   'gender'            => $this->input->post('gender'),
        //   'date_of_birth'     => $this->input->post('date_of_birth'),
		//	'street_address'    => $this->input->post('street_address'),
        //    'time'      		=> $this->input->post('time'),
		//	'cash'      		=> $this->input->post('cash'),
		//	'others'       		=> $this->input->post('others'),
			'id_type'       	=> $this->input->post('id_type'),
            'adhaar_no' 	    => $this->input->post('adhaar_no'),
			'postal_code' 	    => $this->input->post('postal_code'),
            'country'           => $country->country_name,
            'country_id'        => $country_id,
            'role'              => 'user',
            'rolename'          => $rolename,
            'active'            => 0,
            'referral_code'     => $referral_code,
			'account_no'        => $account_no,			
            'referredByCode'    => $referredByCode,
         //   'photo'             => $photoName,
            'created_by'        => '01', //Auto Register
            'created_at'        => time(),
            'modified_at'       => time()
        ];

        $query  = $this->db->insert('users', $data);
        

        //check and Add Balance
	
//Inserting Min Bal into Accounts database for MyFair's Account Balance	

		   $debit1 = '0';
		   $credit1 = '0';
           $pay_type = '3';   //Pay Specification 2-New member welcome offer
                 
       		
			$text8 = 'Welcome Offer'; 
			$table_name = "users";			
			$where_array = array('referral_code' => $referral_code);
			$query11 = $this->db->where($where_array )->get($table_name); 
			if($query11 -> num_rows() > 0) 
			{	
				foreach ($query11->result() as $r)
				{
					$c_id 		 = $r->id;				
			
			$accounts3 = [
					'user_id'      			=> $c_id,          //New Member ID  
					'account_no'         	=> $account_no,
					'rolename'              => $rolename,
					'email'                 => $email,
					'paid_to'         		=> '00',      //From the Money sender user 
					'tranx_id'         		=> $text8,
					'credit'         		=> '0',
					'debit'         		=> $debit1,
					'amount'         		=> $debit1,	
					'points_mode'           => 'wallet',	
'tran_count'			=> '1',	
					'used'					=> 'no',
					'pay_type'				=> $pay_type, //Deduction Pay Specification	
					'created_at'            => time(),
					'modified_at'           => time()
				];

				$query3 = $this->db->insert('accounts', $accounts3); 
		  				}
			}
			
			//welcome SMS
			$sms_user = $c_id;
			$this->notification_model->sms_new_consumer($sms_user);
			
			
			//Welcome offer A/C debit SMS
					$tran = '1'; // "$tran = 1" if 'Credit' == 0 & no amount value -OR- "$tran = 0" if 'debit' == 0 & no amount value 
					$sms_user = $c_id;
					$total_price = $debit1;
					$pm_wallet = 'wallet';
					$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
				  
							//Deduction of commission from Ledger Table with Respective Payspecification and passing the
							
								
								$data4 = [
									'user_id'         		=> $c_id,             	//New Member ID   
									'pay_type'				=> $pay_type,  			//Deduction Pay Specification	
									'account_no'         	=> $account_no,
									'rolename'              => $rolename,
									'email'                 => $email,
									'credit'         		=> $debit1, 	
									'debit'         		=> '0',
									'amount'         		=> $debit1, 
									'points_mode'           => 'wallet',
									'invoice_id '  			=> '00',		
									'challan' 				=> 'no_invoice.jpg',			
									'remarks'         		=> $text8,
									'start_date'         	=> time(),		
									'created_at'            => time(),
									'modified_at'           => time()
								];

							   $query4 = $this->db->insert('ledger', $data4);
	 
// Reffered By Customer's Benefits for Reffering New member welcome offer	
		$table_name = "users";
				$where_array = array( 'referral_code' => $referredByCode );
				$query = $this->db->where($where_array )->get($table_name); 
				foreach($query->result() as $r)		
				
				{	
					$spon_id		= $r->id;
					$spon_firstname = $r->first_name;
					$spon_account_no = $r->account_no;
					$spon_rolename = $r->rolename;
					$spon_email = $r->email;
					$spon_mobile = $r->contactno;
		
						   $debit2 = '0';
						   $credit2 = '0';
						   $pay_type = '2';   //Pay Specification 2-New member welcome offer
									
							
					 $text9 = "Referral offer"; 
	//Get Individual Account transactions Id		
		$acct_user = $spon_id;
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
							
							 $accounts5 = [
							'user_id'      			=> $spon_id,          //Spon Member ID  
							'account_no'         	=> $spon_account_no,
							'rolename'              => $spon_rolename,
							'email'					=> $spon_email,
							'paid_to'         		=> '00',      //From the Money sender user 
							'tranx_id'         		=> $text9,
							'credit'         		=> '0',
							'debit'         		=> $debit2,
							'amount'         		=> $debit2,	
							'points_mode'           => 'wallet',	
'tran_count'			=> $tran_count,
							'used'					=> 'no',
							'pay_type'				=> $pay_type, //Deduction Pay Specification	
							'created_at'            => time(),
							'modified_at'           => time()
						];

					$query5 = $this->db->insert('accounts', $accounts5); 
					
					$tran = '1'; // "$tran = 1" if 'Credit' == 0 & no amount value -OR- "$tran = 0" if 'debit' == 0 & no amount value 
					$sms_user = $spon_id;
					$total_price = $debit2;
					$pm_wallet = 'wallet';
					$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
				
						
					//Deduction of commission from Ledger Table with Respective Payspecification and passing the
					
						
						$ledger5 = [
							'user_id'         		=> $spon_id,            //New Member ID   
							'pay_type'				=> $pay_type,  			//Deduction Pay Specification	
							'account_no'         	=> $spon_account_no,
							'rolename'              => $spon_rolename,
							'email'					=> $spon_email,
							'credit'         		=> $debit2, 	
							'debit'         		=> '0',
							'amount'         		=> $debit2, 
							'points_mode'           => 'wallet',
							'invoice_id '  			=> '00',		
							'challan' 				=> 'no_invoice.jpg',			
							'remarks'         		=> $text9,
							'start_date'         	=> time(),		
							'created_at'            => time(),
							'modified_at'           => time()
						];

					   $query6 = $this->db->insert('ledger', $ledger5);
				
			
} 
//Adding into terms_codition Table
		$get_term_ID = $this->db->get_where('term_condition', ['role'=>12]);
		foreach($get_term_ID->result() as $l);
		 $term_ID = $l->term_ID;
					$terms = [
							'term_ID'               =>$term_ID,
							'user_id'         		=> $c_id,              
							'role'				    => 12,  			
							'terms_read'         	=> 1,
							'read_at'         	    => date('Y/m/d H:m'),
							'created_at'            => time(),
							'created_by'            => $c_id
						];

					   $query7 = $this->db->insert('term_condition_user', $terms);
					   $query8 = $this->db->insert('term_condition_user_track', $terms);
					   
					   

		if($query6)
		{
					return true;
		}
		return false;
		
		
        if($query)
        {

            $email_data = [
                'email'     => $email,
                'password'  => $row_password,
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');

            $subject = 'Hi '.$data['first_name'].' '. $data['last_name'].', Thank you for registration @'.date('d-m-Y h:i a');
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('email_template_password',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
        		
            return true;	
        }
       return false;
							
			
	}


    public function forgotPassword()
    {

        $email = $this->input->post('email');

        $credential = [
            'email' => $email
        ];

        $query = $this->db->get_where('users', $credential);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r);

            $email_data = [
                'email'     => $email,
                'password'  => $r->row_pass,
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');

            $subject = 'Hi '.$r->first_name.' '. $r->last_name.', here your login details @'.date('d-m-Y h:i a');
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('email_template_password',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();

            $this->session->set_flashdata('successMsg', 'Password has been sent successfully, pleas check your email ');
            return true;
        } else {
            $this->session->set_flashdata('errorMsg', 'Sorry! we found no account associate with this email');
            return false;
        }
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

   /**
     * @return bool
    * set user online status = 0
     */

    public function set_user_offline(){
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $query = $this->db->where('id', $user_id)->update('users', ['online_status' => 0]);
        if($query)
        {
            return true;
        }
        return false;

    }
	
	// Accounts Update SMS for user Accounts	
//for All transactions
	public function sms_accounts($sms_user, $tran, $total_price, $pm_wallet )
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
				
		
		/* Available Balance Wallet,loyality and Discount Points */

		$wallet_balance    = ( $wal_debit - $wal_credit ) ;
	
			$fname = singleDbTableRow($sms_user)->first_name; 
			if ($tran == 1)
			{
				$text = 'deposited with '.$total_price.' '.$pm_wallet;
			}else
			{
				$text = 'withdrawn with '.$total_price.' '.$pm_wallet;
			}
			

			
			$bal = $wallet_balance;
			$mobile = singleDbTableRow($sms_user)->contactno;
			
			include_once ('sendsms.php');		
			$message=" Dear ".$fname.", your account is ".$text.". A/c Balance :".$bal.' '.$pm_wallet." points.  'Team Consumer1st'.";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aaf4c7aeba262de430024464073430ce6", "ICAMPS");
			$sendsms->send_sms($mobile, $message, 'http://www.gyanguidecrm.com/fmd/QuickSms.php?branchid=12', 'xml');		
	}
	



public function switch_user($user_id){
		
		$this->load->library('user_agent');
		$query = $this->db->get_where('users', ['id'=>$user_id]);
		if($query->num_rows() > 0) {
		foreach ($query->result() as $r);
		$user_data = [
			'email' => $r->email,
			'user_id' => $user_id,
			'role' => $r->role,
			'logged_in' => true,
		];
		
		// set user status = online
		$login_update = [
			'online_status' => 1,
			'user_lastlogin' => time()
		];
		$this->db->where('id', $user_id)->update('users', $login_update);
		
		// store login info in session
		$this->session->set_userdata('logged_user', $user_data);
		
		// insert user agent and ip into log
		$user_agent = $this->agent->agent_string();

		$user_device_info = [
			'user_id' => $r->id,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'device_info' => $user_agent,
			'created_at' => time()
		];

		$this->db->insert('log', $user_device_info);

		
		return true;
		}
		else {
            return false;
        }
		
	}
	
	
	//-------------------------------------registerUser_chaitanya_amit--------------------------------------------------------// 

 public function registerUser_chaitanya()
 {

        $this->load->helper('string'); //load string helper
		
		$postal_code    = $this->input->post('postal_code');
        $row_password   = 'farmer'; //$this->input->post('password');
        $password       = sha1($row_password);      
		 $referral_code  = random_string('numeric',10);   //Modified to 10 digit
	
		
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
		
	
        $email = $this->input->post('email');
        $country_id = '105'; //$this->input->post('country');		
        // get country name
        $country_query = $this->db->get_where('countries', ['id' => $country_id]);
        foreach($country_query->result() as $country);
        $photoName = '';       
		$rolename = '86';  //Volunteer
		$referredByCode = '1234512345'; //$this->input->post('referredByCode');
		$fname = $this->input->post('first_name');
		$email = strtolower($email);

		$account_no =  $country_id.$postal_code.$rolename.$referral_code;
		$fname = ucfirst ($this->input->post('first_name'));
		$lname = ucfirst ($this->input->post('last_name'));
		$mobile = $this->input->post('contactno');
		
		$company_name = $fname.' '.$lname;
		
        //set all data for inserting into database
        $data9 = [
            'first_name'        => $fname,
            'last_name'         => $lname,
            'password'          => $password,
            'row_pass'          => $row_password,
            'email'             => $email,
            'contactno'         => $mobile,     
			'postal_code' 	    => $this->input->post('postal_code'),
            'country'           => $country->country_name,
            'country_id'        => $country_id,
            'role'              => 'agent',
            'rolename'          => $rolename,
            'active'            => '1',
            'referral_code'     => $referral_code,
			'account_no'        => $account_no,			
            'referredByCode'    => $referredByCode,
            'company_name'      => $company_name,
            'created_by'        => '1', //Auto Register
            'created_at'        => time(),
            'modified_at'       => time()
        ];

        $query9  = $this->db->insert('users', $data9);

	
     //welcome SMS
	if($query9)		
	{	$mobile = $mobile;
		$fname = $fname;
		$referral_code = $referral_code;
		$login_name = $email;
		$password = $row_password;
		
		$this->notification_model->sms_new_volunteer($mobile, $fname, $referral_code, $login_name, $password);
	}

}

}