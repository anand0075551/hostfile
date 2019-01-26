<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


    /**
     *  Authonication check here
     * @return bool
     */

   public function profile_update($profile_id = 0){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //re-assign if pass a $profile_id
        if($profile_id != 0){
            $user_id = $profile_id;
        }

        $user_info = $this->db->get_where('users', ['id' => $user_id]);
        foreach($user_info->result() as $user_r);


        $photoName = $user_r->photo;

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


        $data = [
            'first_name'      => $this->input->post('first_name'),
            'last_name'    	  => $this->input->post('last_name'),
            'contactno'   	  => $this->input->post('contactno'),
			'company_name'    => $this->input->post('company_name'),
            'licence'   	  => $this->input->post('licence'),
			'agreed_per'   	  => $this->input->post('agreed_per'),
            'gender'   		  => $this->input->post('gender'),
			'city'   		  => $this->input->post('city'),
            'date_of_birth'   => $this->input->post('date_of_birth'),
            'profession'      => $this->input->post('profession'),
            'street_address'  => $this->input->post('street_address'),
			//'rolename' 		  => $this->input->post('rolename'),
            'photo'           => $photoName,
            'modified_at'     => time()
        ];

        $query = $this->db->where('id', $user_id)->update('users', $data);

        if($query) 
		{ return true; }
        return false;

    }

	 /**
     *  Bank Account Update
     * @return bool
     */

public function bank_update($profile_id = 0){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //re-assign if pass a $profile_id
        if($profile_id != 0){
            $user_id = $profile_id;
        }

        
        $data = [
            'bank_name'  		=> $this->input->post('bank_name'),        //Name of Bank	
			'bank_address'  	=> $this->input->post('bank_address'),     //Branch and Address
			'contactno'  	    => $this->input->post('contactno'),        //Bank Registered Mobile No
			'bank_acc_type'   	=> $this->input->post('bank_acc_type'),    //Account Number			
            'bank_account'   	=> $this->input->post('bank_account'),     //Account Number
            'ifsc_code'   	 	=> $this->input->post('ifsc_code'),   	   //IFSC Code
			'pan_no'    		=> $this->input->post('pan_no'),	             	
          //  'photo'        	 	=> $photoName,
            'modified_at'   	=> time()
        ];

        $query = $this->db->where('id', $user_id)->update('users', $data);

        if($query) return true;
        return false;

    }

//**************************Bank Acct Update End***************************


    public function changePassword(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $oldPassword = singleDbTableRow($user_id)->password;

        if($oldPassword != sha1($this->input->post('old_password')))
        {
            $this->session->set_flashdata('errorMsg', 'Old password Incorrect');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $row_password   = $this->input->post('password');
        $password       = sha1($row_password);

        //set all data for inserting into database
        $data = [
            'password'          => $password,
            'row_pass'          => $row_password,
        ];

        $query = $this->db->where('id', $user_id)->update('users', $data);

        if($query)
        {
            return true;
        }
        return false;
    }



    /**
     * @param int $user_id
     * @return mixed
     * return last 20 Login log
     */

    public function get_log($user_id = 0){
        $user_info = $this->session->userdata('logged_user');

        if($user_id != 0)
        {
            $user_id = $user_id;
        }else{
            $user_id = $user_info['user_id'];
        }

        $query = $this->db->order_by('id', 'desc')->get_where('log', ['user_id' => $user_id], 20);
        return $query;
    }

    /**
     * @return Agent List
     * Agent List Query
     */

    public function userListCount(){
        $query = $this->db->where( 'role' , 'user')->count_all_results('users');
  //     $query = $this->db->where( 'city_id' , '0')->count_all_results('users');
        return $query;
    }

    public function userList($limit = 0, $start = 0){
		
		$search=$this->input->get('search');
		$searchValue=$search['value'];
		$searchByID = '';
		//if($searchValue != ''){
		//	$were_array = array();
		//}
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];		
		$currentUser = singleDbTableRow($user_id)->role;
		$referral_code    = singleDbTableRow($user_id)->referral_code;
		$referredByCode   = singleDbTableRow($user_id)->referredByCode;
      //  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'user']);
		
		
		if ($currentUser == 'admin')
		{	
		
			
			if($searchValue != '')
			{
				//$searchByID = " WHERE invoice.id = '{$searchValue}'";
				$where_array = array('referral_code'=> $searchValue);
				$table_name = "users";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
				
								
			}
			else{
				$table_name = "users";			
				$where_array = array( 'role' => 'user' );
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
			}
       }else{
				if($searchValue != '')
			{
				//$searchByID = " WHERE invoice.id = '{$searchValue}'";
				$where_array = array('referral_code'=> $searchValu, 'referredByCode' =>$referral_code );
				$table_name = "users";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
				
								
			}else{
			 
				$table_name = "users";
				$where_array = array( 'referredByCode' =>$referral_code );
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);
			}
	   }
		
		
	return $query;
    }

    /**
     * @return Agent List
     * Agent List Query
     */

    public function agentListCount(){
       $query = $this->db->where( 'role' , 'agent')->count_all_results('users');
  //      $query = $this->db->where( 'city_id' , '0')->count_all_results('users');
        return $query;
    }

    public function agentList($limit = 0, $start = 0){
//        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'user']);
//<!--  Below line is customized to see all type of users for Approver in Cutomer list section(All users) Tab -->
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'agent']);
		return $query;
    }
	
	public function activityList_user($limit = 0, $start = 0){
		$query = $this->db->query("select activities.*, users.first_name, users.last_name
				from activities
				LEFT JOIN users on activities.user_id = users.id
				ORDER BY activities.id DESC limit $start, $limit");
				return $query;
	}
	public function activityList_alluser($limit = 0, $start = 0){
		$showFor = $this->input->get('showFor');
		$query = $this->db->query("select activities.*, users.first_name, users.last_name
				from activities
				LEFT JOIN users on activities.user_id = users.id
				WHERE activities.user_id = '$showFor'
				ORDER BY activities.id DESC limit $start, $limit");
				return $query;
	}	
		public function activityList_session_user($limit = 0, $start = 0){
		$user_data = loggedInUserData();
		$session_user_id = $user_data['user_id'];
		$query = $this->db->query("select activities.*, users.first_name, users.last_name
				from activities
				LEFT JOIN users on activities.user_id = users.id
				WHERE activities.user_id = '$session_user_id'
				ORDER BY activities.id DESC limit $start, $limit");
				return $query;
	}	
    /***************************************************************************************************************************
     * @return Bank List
     * Bank List Query
     */

    public function bankListCount(){
        $query = $this->db->where( 'role' , 'user')->count_all_results('bank');
//       $query = $this->db->where( 'created_by' , '0')->count_all_results('users');
        return $query;
    }

    public function bankList($limit = 0, $start = 0){
//        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'user']);
//<!--  Below line is customized to see all type of users for Approver in Cutomer list section(All users) Tab -->
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('bank', ['created_by' => '0']);
		return $query;
    }
	/***************************************************************************************************************************/
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
$email     = $_GET['email'] ;
$amount    = $_GET['amount'] ;
$pay_spec_id  = $_GET['pay_spec'] ;
//$pay_to    = 'anandsagar007@gmail.com'; //$_GET['pay_to'] ;
$pay_to    = $_GET['pay_to'] ;

//$categoryCommission = singleDbTableRow($categoryID, 'categories')->commission_percent;

$pay_spec = singleDbTableRow($pay_spec_id, 'acct_categories')->name;

$table_name = "users";
			$where_array = array('email' => $email);
			$query1 = $this->db->where($where_array )->get($table_name); 

if($query1 -> num_rows() > 0) 
			{	
				foreach ($query1->result() as $r)
				{
					$account_no1 = $r->account_no;
					$role1 = $r->role;
					$userID1 = $r->id;
					
				}
			}


$paid_to    = "Merchant User ID -".$pay_to ;
$tranx_id   = "Payment for '".$pay_spec."' -Transferred Wallet to -".$pay_to ;
$credit      = $amount ;

$pay_type   = 'Tranx ID 123' ;

		
        $data1 = [
            'user_id'      		=> $userID1,         //From Sales Person 
	    'account_no'         	=> $account_no1,
            'role '  			=> $role1,		
	    'paid_to'         		=> $paid_to,	   //To This Customer 
            'tranx_id'	         	=> $tranx_id,  
            'credit'         		=> $credit,
	    'debit'         		=> '0',
	    'amount'         		=> $amount,	
	    'points_mode'               => 'wallet',		
	    'used'			=> 'yes',
	    'pay_type'		 	=> $pay_type, 		
            'created_at'                => time(),
            'modified_at'               => time()
        ];

        $this->db->insert('accounts', $data1); 
        
        
   //Transaction for Merchant Recieving wallet points    


$table_name = "users";
			$where_array = array('email' =>$pay_to);
			$query2 = $this->db->where($where_array )->get($table_name); 

if($query2 -> num_rows() > 0) 
			{	
				foreach ($query2->result() as $r)
				{
					$account_no2 = $r->account_no;
					$role2 = $r->role;
					$userID2 = $r->id;
					
				}
			}



$paid_by    = "Customer User ID -".$email;
$tranx_id   = "Payment for '".$pay_spec."' -Recieved Wallet from -".$email ;
$debit      = $amount ;

$pay_type   = 'Tranx ID 123' ;

		
        $data2 = [
            'user_id'      		=> $userID2,         //From Sales Person 
	    'account_no'         	=> $account_no2,
            'role '  			=> $role2,		
	    'paid_to'         		=> $paid_by,	   //To This Customer 
            'tranx_id'	         	=> $tranx_id,  
            'credit'         		=> '0',
	    'debit'         		=> $debit,
	    'amount'         		=> $amount,	
	    'points_mode'               => 'wallet',		
	    'used'			=> 'no',
	    'pay_type'		 	=> $pay_type, 		
            'created_at'                => time(),
            'modified_at'               => time()
        ];

        $this->db->insert('accounts', $data2); 
            

        if($query2)
        {
            return true;
        }
        return false;
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
    
    
    }// End of Main call
