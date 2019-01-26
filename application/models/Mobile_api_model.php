	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Mobile_api_model extends CI_Model {

	function __construct(){
	parent:: __construct();
	
	//check_auth(); //check is logged in.
	
	}
	
		
//For the Total Debits	
     public function total_wallet_debit($email = 0)
     {
      
		
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
	
	// User Login Api
	
	public function login($email,$row_pass)
	{
       
		$table_name = "users";		 
		$where_array =array('active'=>1,'email' => $email , 'row_pass' => $row_pass);
		$query1 = $this->db->where($where_array)->get_where($table_name); 
		return $query1;
		
    }
	
	
	/* public function photo_fetch($id)
	{
		
		$query3 = $this->db->select('photo')->get_where('users', ['id'=>$id]);
		//$filename1= base64_encode($query3);
     
		  return $query3;	
    }
	 */
	// Account Balance Api
	
	public function check_balance($user_id)
	{
		
		$query3 = $this->db->select('amount')->order_by('tran_count', 'desc')->get_where('accounts', ['user_id'=>$user_id]);
     
		  return $query3;	
    }
	
	// user Register Api
public function userregister()
	{
		$this->load->helper('string'); //load string helper
	 $first_name 		= $_GET['fname'];	
	 $last_name  		= $_GET['lname'];
	 $email 	 		= $_GET['email'];
	 $user_photo   	    = $_GET['user_photo']; //ovr
	 $password   		= $_GET['password'];
	 $contactno  		= $_GET['contactno'];
	 $id_type	 		= $_GET['id_type'];
	 $adhaar_no	 		= $_GET['adhaar_no'];
	 $date_of_birth	 	= $_GET['dob'];  //new
	 $referredByCode 	= $_GET['referredByCode'];	
	 $postal_code		= $_GET['pincode']; 
	 $gender            = $_GET['gender'];
	 //$photo     		= $_GET['photo'];
	 
	 
	 /*$postal_code		= $_GET['profession']; 
	 $street_address	= $_GET['street_address']; 
	 $area_name			= $_GET['area_name']; 
	 $city				= $_GET['city']; 
	 $country			= $_GET['country']; 
	 $ifsc_code			= $_GET['ifsc_code']; 
	 $passport_no		= $_GET['passport_no']; 
	 $company_name		= $_GET['company_name']; 
	 $licence			= $_GET['licence']; 
	 $role				= $_GET['role']; 
	 $cash				= $_GET['cash']; 
	 $account_no		= $_GET['account_no'];*/ 
	 
	 
	 $row_pass = $password ;
	 $password = sha1($password);
	
 
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
		
		  // get country name
		$country_id = '105';
        $country_query = $this->db->get_where('countries', ['id' => $country_id]);
        foreach($country_query->result() as $country);
	
		$rolename = '12'; //$this->input->post('rolename'); //Consumer/Volunteer

		$first_name  = ucfirst($first_name);
		$last_name  = ucfirst($last_name);
		$company_name = $first_name.' '. $last_name;

		$account_no =  $country_id.$postal_code.$rolename.$referral_code;
        $data = [
			'referral_code'		=> $referral_code,
            'first_name'        => $first_name,
            'last_name'    		=> $last_name,
            'email'    			=> strtolower($email),
            'password' 	  		=> $password,
			'row_pass'			=> $row_pass,
			'contactno'			=> $contactno,
			'id_type'			=> $id_type,
			'referredByCode'	=> $referredByCode,
			'date_of_birth'		=> $date_of_birth,			
            'gender'            => $gender ,
            'photo'            => $user_photo ,
        //   'date_of_birth'     => $this->input->post('date_of_birth'),
		//	'street_address'    => $this->input->post('street_address'),
        //    'time'      		=> $this->input->post('time'),
		//	'cash'      		=> $this->input->post('cash'),
		//	'others'       		=> $this->input->post('others'),
			
            'adhaar_no' 	    => $adhaar_no,
			'postal_code' 	    => $postal_code,
            'country'           => $country->country_name,
            'country_id'        => $country_id,
            'role'              => 'user',
            'rolename'          => $rolename,
            'active'            => '1',     //Temporary
            'referral_code'     => $referral_code,
			'account_no'        => $account_no,			
            'referredByCode'    => $referredByCode,
            'company_name'      => $company_name,
            //'photo'      		=> $user_photo,
            'created_by'        => '1', //Auto Register
            'created_at'        => time(),
            'modified_at'       => time()
		];
		
			/* $user_photo = pathinfo($user_photo, PATHINFO_EXTENTION);
			$image = base64_encode($user_photo);
			$iamge = chunk_split($image, 76, "\r\n"); */
		
        $query = $this->db->insert('users',$data);
       
        if($query)
        {
			
            return true;
        }
        return false;
    }
	
	
	
	public function account_statement($user_id)
	{
		
		$query4 = $this->db->order_by('tran_count','DESC')->get_where('accounts',['user_id'=>$user_id]);
		
		
		
		return $query4;	
    }
	
	public function vouchers($id)
	{
		
		$query4 = $this->db->get_where('vouchers',['id'=>$id]);
		
		
		
		return $query4;	
    }
	
	public function states($id)
	{
		
		$query4 = $this->db->get_where('status',['id'=>$id]);
		
		
		
		return $query4;	
    }
	
	public function acc_balance($index_id)
	{
		
		$query4 = $this->db->get_where('accounts',['id'=>$index_id]);
		
		return $query4;	
    }
	
}