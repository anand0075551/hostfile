<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledger_model extends CI_Model {

    /**
     * @return bool
     */

  
  /**
     * Add Ledger Account Details
     * 
     */
    public function add_ledger(){ 
 $this->load->helper('string'); //load string helper
 
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

     	$pay_type       = $this->input->post('pay_type');
		$trans_type		= $this->input->post('trans_type');
        $userfile        = $this->input->post('userfile');
		$remarks       = $this->input->post('remarks');
        $cash       = $this->input->post('cash');    //$cash is actual Input Amount
	
		
	if ($trans_type == 'Credit')	
	{
		$credit = $cash ;
		$debit  = '0' ;
		$amount =  ($bal_cash - $credit);
	}
	else{
		$credit = '0' ;
		$debit = $cash ;
		$amount =  ($bal_cash + $debit);
	}
		
	//	$amount 		=  $bal_cash ( $debit + $credit );
		//check user is selected photo
        if($_FILES['userfile']['name'] != '')
        {
            $upload_dir = './uploads/'; //Upload directory
            if( ! file_exists($upload_dir)) mkdir($upload_dir); //create directory if not found.
            $config['upload_path']          = $upload_dir;
            $config['allowed_types']        = 'gif|jpg|png|bmp';
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
		$today = date("Y/m/d");
        //set all data for inserting into database
        $data = [
            'user_id'         		=> $user_id, // $this->input->post('vouchers_name'),
            'invoice_id '  			=> $remarks,
            'amount'         		=> $amount, //$this->input->post('capital'),
            'debit'         		=> $debit,// $this->input->post('capital'),
			'credit'         		=> $credit, //$this->input->post('liabilities'),
			'points_mode'           => 'wallet',
            'count'         		=> 'yes',						
            'start_date'         	=> $today,					
			'pay_type'				=> $pay_type,
			'remarks'         		=> $this->input->post('remarks'),	
			'challan'				=> $photoName,			
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
	 public function photoResize($photo = ''){
        $config['image_library'] = 'gd2';
        $config['source_image'] = $photo;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 300;
        $config['height']       = 300;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        unlink($photo); // delete original photo
    }
	
	
	
/**
     * Account New Category
     */

    public function add_acct_category(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		
        //set all data for inserting into database
        $data = [
            'name'         			=> $this->input->post('category_name'),
			'visible'  				=> $this->input->post('visible'),
            'category_type'   		=> 'main',
            'added_by'              => $user_id,
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('acct_categories', $data);

        if($query)
        {
            create_activity('Added '.$data['name'].' acct_categories'); //create an activity
            return true;
        }
        return false;

    }

    /**
     * Sub-Accounts Category Type
     */

    public function add_acct_sub_category(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'name'         			=> $this->input->post('category_name'),
            'parentid'   			=> $this->input->post('category_type'),
			'parentid'   			=> $this->input->post('category_type'),
			'category_type'   		=> 'sub',
            'added_by'              => $user_id,
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('acct_categories', $data);

        if($query)
        {
            create_activity('Added '.$data['name'].' Category'); //create an activity
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
		
		$pay_type       = $this->input->post('pay_type');
		
		
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
			'pay_type'				=> $pay_type,
			'liabilities'         	=> $liabilities, //$this->input->post('liabilities'),
            'cash'         			=> $cash  , //$this->input->post('cash'),			
            'user_id'               => $user_id,
			'challan'				=> $challan, //$photoName,		
            'created_at'            => $today,
            'modified_at'           => time()
        ];

        $query = $this->db->where('id', $id)->update('ledger', $data);

        if($query)
        {
            create_activity('Updated '.$data['cash'].' ledger'); //create an activity
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

    public function ledgerList($start = 0, $limit = 0){
      //  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->join('users', 'users.id = ledger.added_by')->get('ledger');
		
	/*	$query = $this->db->query("select ledger.*, users.first_name, users.last_name
				from ledger LEFT JOIN users
				ON ledger.user_id = users.id ORDER BY ledger.id DESC Limit {$start}, {$limit}");  
	*/		
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('ledger');
				
		return $query;			 
	
    }
	
	/**
     * @return Pay Spec wise 
     */

    public function pay_Count(){
        $query = $this->db->count_all_results('acct_categories');
        return $query;
    } 

    public function pay_List($start = 0, $limit = 0){
      //  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->join('users', 'users.id = ledger.added_by')->get('ledger');
		
	/*	$query = $this->db->query("select ledger.*, users.first_name, users.last_name
				from ledger LEFT JOIN users
				ON ledger.user_id = users.id ORDER BY ledger.id DESC Limit {$start}, {$limit}");  
	*/		$where_array = array ('points_mode' => 'wallet', 'category_type' => 'sub');
				$query = $this->db->order_by('id', 'asc')->limit(0, 10)->get('acct_categories');
				
		return $query;			 
	
    }
	
/**
     * @return Rolename wise 
     */

    public function role_Count(){
        $query = $this->db->count_all_results('role');
        return $query;
    } 

    public function role_List($start = 0, $limit = 0){
      $search = $this->input->get('search');
		$searchValue = $search['value'];

		$searchByID = '';
		//Get Decision who in online?
		
			if($searchValue != '')
			{
				//$searchByID = " WHERE invoice.id = '{$searchValue}'";
				$where_array = array('roleid'=> $searchValue);
				
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('role');
				
				
				
			}
			else{
				$where_array = array ('type' => 'role_name');
				$query = $this->db->order_by('id', 'asc')->limit($limit, $start)->get('role');
			}
       
		
		
				
		return $query;			 
	
    }

	/**
     * @return User wise 
     */

    public function user_Count(){
        $query = $this->db->count_all_results('users');
        return $query;
    } 

    public function user_List($start = 0, $limit = 10){
      
		$where_array = array ('type' => 'role_name');
				$query = $this->db->order_by('id', 'asc')->limit(0, 10)->get('users');
				
		return $query;			 
	
    }
	
  /**
     *Userwise Account statement for CPA
     */

    public function userAccountListCount(){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$referral_code = singleDbTableRow($user_id)->referral_code;
		$currentUser   = singleDbTableRow($user_id)->role;
		$account_no   = singleDbTableRow($user_id)->account_no;
		
       
		    if($currentUser == 'admin'){
            $query = $this->db->count_all_results('accounts');
			
				}
			else{
				//$where_array = array ('user_id'=>$user_id, 'paid_to'=>$user_id);
			 //$query = $this->db->where('user_id',$user_id )->count_all_results('accounts');	
			 $query = $this->db->where('account_no',$account_no )->count_all_results('accounts');	
			}
        return $query;
    } 
	
				
    public function userAccountList($limit = 10, $start = 0){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
			$referral_code = singleDbTableRow($user_id)->referral_code;		 
		 	$currentUser   = singleDbTableRow($user_id)->role;
			$currentRolename   = singleDbTableRow($user_id)->rolename;
			$account_no   = singleDbTableRow($user_id)->account_no;
       
	    if($currentUser == 'admin' && $currentRolename != '9'){
	/*  $query = $this->db->query("select accounts.*, users.first_name, users.last_name
				from accounts  LEFT JOIN users
				ON accounts.user_id = users.id ORDER BY accounts.id DESC Limit {$start}, {$limit}"); */
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('accounts');	
}
			else{
				
			/*	 $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where('user_id', $user_id )->get('accounts');	 */
			//	$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('accounts',['account_no'=>$account_no]);	

			$table_name = "accounts";
			$where_array = array('account_no' =>$account_no);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 				
			}
        return $query;
    }
	
	 /**
     *Userwise Account statement for Offers
     */

    public function userAccountListCount2(){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$referral_code = singleDbTableRow($user_id)->referral_code;
		$currentUser   = singleDbTableRow($user_id)->role;
		$account_no   = singleDbTableRow($user_id)->account_no;
		
       
		    if($currentUser == 'admin'){
            $query = $this->db->count_all_results('accounts');
			
				}
			else{
				//$where_array = array ('user_id'=>$user_id, 'paid_to'=>$user_id);
			 //$query = $this->db->where('user_id',$user_id )->count_all_results('accounts');	
			 $query = $this->db->where('account_no',$account_no )->count_all_results('accounts');	
			}
        return $query;
    } 
	
				
    public function userAccountList2($limit = 0, $start = 0){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
			$referral_code = singleDbTableRow($user_id)->referral_code;		 
		 	$currentUser   = singleDbTableRow($user_id)->role;
			$currentRolename   = singleDbTableRow($user_id)->rolename;
			$account_no   = singleDbTableRow($user_id)->account_no;
       
	    if($currentUser == 'admin' && $currentRolename != '9'){
	/*  $query = $this->db->query("select accounts.*, users.first_name, users.last_name
				from accounts  LEFT JOIN users
				ON accounts.user_id = users.id ORDER BY accounts.id DESC Limit {$start}, {$limit}"); */
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('accounts');	
}
			else{
				
			/*	 $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where('user_id', $user_id )->get('accounts');	 */
			//	$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('accounts',['account_no'=>$account_no]);	

			$table_name = "accounts";
			$where_array = array('account_no' =>$account_no, 'points_mode' => 'loyality');
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 				
			}
        return $query;
    }
 /**
     * Cash to Wallet Ledger Account Details
     * 
     */
    public function cash_2wallet(){
		
		$this->load->helper('string'); 
        $user_info 		= $this->session->userdata('logged_user');
        $user_id 		= $user_info['user_id'];
		$role		    = $user_info['role']; //'wallet';
		$account_no     =  singleDbTableRow($user_id)->account_no; 
		$rolename       =  singleDbTableRow($user_id)->rolename; 
		$conv_type       = $this->input->post('conv_type');
		
		if ( $conv_type == 'wallet')
		{			
		        $debit			= 	$this->input->post('cash');	
				$credit         = '0';
				$amount			=  $debit + $credit;
				$pay_type       = '66';   //Cash to Wallet Conversions
				$points_mode    = 'wallet';
		}else{		
				$debit          =  '0';
				$credit			= 	$this->input->post('cash');	
				$amount			=  $debit + $credit;	
				$pay_type       = '65';	  //Wallet to Cash Conversions 	
				$points_mode    = 'cash';

		}
        //set all data for inserting into database
        $data1 = [
            'user_id'         		=> $user_id, 
			'account_no'         	=> $account_no,
            'rolename'  		    => $rolename,
            'pay_type'         		=> $pay_type ,
			'credit'         		=> $credit,
			'debit'         		=> $debit,
			'amount'         		=> $amount,	
			'points_mode' 			=> $points_mode,
			'used'					=> 'yes',
			'tranx_id'				=> $this->input->post('tranx_id'),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query1 = $this->db->insert('accounts', $data1);

	   $today = date("Y/m/d");
        //set all data for inserting into database
        $data2 = [
            'user_id'         		=> $user_id,
            'invoice_id '  			=> 'test123',
            'credit'         		=> $credit,
			'debit'         		=> $debit,
			'amount'         		=> $amount,	
			'points_mode'           => 'wallet',
            'count'         		=> 'no',						
            'start_date'         	=> $today,					
			'pay_type'				=> $pay_type,
			'remarks'         		=> $this->input->post('tranx_id'),	
			'challan'				=> 'test image', //$photoName,			
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query2 = $this->db->insert('ledger', $data2);

       

        if($query1)
        {
            create_activity('Added '.$data1['invoice_id'].' accounts'); //create an activity
            return true;
        }
        return false;

    }

	    public function total_liabilities($userID = 0){
        $user = loggedInUserData();

        if($userID == 0) {
            $userID = $user['user_id'];
        }

       // $query = $this->db->select_sum('amount')->get_where('payment', ['payee_id' => $userID]);
$query = $this->db->select_sum('liabilities')->where('pay_type', 'transfer')->get('ledger'); //temp_delete
        return $query;
    }
/*********************************************************************************************************/	
    public function total_wallet($userID = 0){
        $user = loggedInUserData();
		$role =  $user['role'];
		
        if($userID == 0) {
            $userID = $user['user_id'];
        }
				
		//sum of total wallets available with Cash Dispatch-Role Name 'Wallet'
		
		
	//	$where = array (user_id = $userID AND cash_mode ='Discount' AND used ='No' );
		//$query = $this->db->select_sum('amount')->get_where('accounts', array (  ['used' => 'Yes'] AND ['user_id' => $userID] AND ['cash_mode' => 'Discount'] ) );				 
				// $this->db->where('cash_mode', 'Discount');
				// $this->db->where('used', 'No'); 

		
		
		$query = $this->db->select_sum('amount')->where('user_id', $userID )->get('accounts'); 
        return $query;
    }
//SBI Balance
// Paytype:24 Deposit to SBI Basava Nagar B'lore Branch-SBIN0016336
// Paytype:29 Cash Withdrawal at SBI HAL Branch IFSCode-SBIN016336

//Total Deposit- SBI Balance
	public function total_dep_cpa(){       
	
	$table_name = "accounts";
		$where_array = array('pay_type' => '24', 'credit' => '0');    
		$query = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
		return $query;
	/*		
	$table_name = "bank";
		$where_array = array('transaction_type'=>'deposit'); 
		$query = $this->db->select_sum('amount')->where($where_array )->get($table_name); 
		return $query;
		*/
    }
	
//Total Withdrawal	
		public function total_dep_cpa2(){       
	
		$table_name = "accounts";
		$where_array = array('pay_type' => '29', 'credit' => '0');    
		$query = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
		return $query;
		/*	
	$table_name = "bank";
		$where_array = array('transaction_type'=>'withdrawl'); 
		$query = $this->db->select_sum('amount')->where($where_array )->get($table_name); 
		return $query;	
		
		return $query;
		*/
    }

	
//Users Not used CPA
	public function total_dep_cpa3(){       
		
		$table_name = "accounts";
		$where_array = array( 'used' => 'no', 'pay_type' != '24');    
		$query = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
		return $query;
		
    }


//Spent Promotional Offers-Joining Offers(Consumers)	
	public function total_dep_cpa4(){       
		
		$table_name = "accounts";
		$where_array = array('points_mode'=>'wallet', 'pay_type' => '3');   
		$query = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
		return $query;
		
    }
	
//Distributor Commission


	public function total_dep_cpa5(){       
		
		$table_name = "accounts";
		$where_array = array('points_mode'=>'wallet',  'pay_type' => '13');   
		$query = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
		return $query;
		
    }
	

//SMB Consumer Payment to Company 


	public function total_dep_smb(){       
		
		$table_name = "accounts";
		$where_array = array('points_mode'=>'wallet',  'pay_type' => '66');   
		$query = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
		return $query;
		
    }

	//Customer/Volunteer Sponsorships from Company 
	public function total_dep_restro(){       
		
		$table_name = "accounts";
		$where_array = array('points_mode'=>'wallet',  'pay_type' => '78');   
		$query = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
		return $query;
	}
	//Prepaid Consumer Payment to Company 
	public function total_dep_billpay(){       
		
		$table_name = "accounts";
		$where_array = array('points_mode'=>'wallet',  'pay_type' => '70');   
		$query = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
		return $query;	
    }
	//consumer_sponsorship 
	public function consumer_sponsorship(){       
		
		$table_name = "accounts";
		$where_array = array('points_mode'=>'wallet',  'pay_type' => '2');   
		$query = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
		return $query;	
    }
	
	
		//joining_offers
	public function joining_offers(){       
		
		$table_name = "accounts";
		$where_array = array('points_mode'=>'wallet',  'pay_type' => '3');   
		$query = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
		return $query;	
    }
	
	
	
	public function total_wallet_debit($userID = 0){
        $user = loggedInUserData();
		$role =  $user['role'];
		
        if($userID == 0) {
            $userID = $user['user_id'];
			$account_no = singleDbTableRow($userID)->account_no;
        }
		//sum of total wallets available with Cash Dispatch-Role Name 'Wallet'
		
		$table_name = "accounts";
		//$limit = '10';
		//$offset = '0'; 
		$where_array = array('points_mode'=>'wallet', 'account_no' =>$account_no);
		$query = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
		return $query;
		
    }
	
	public function total_wallet_credit($userID = 0){
        $user = loggedInUserData();
		$role =  $user['role'];
		
        if($userID == 0) {
            $userID = $user['user_id'];
			$account_no = singleDbTableRow($userID)->account_no;
        }
		//sum of total wallets available with Cash Dispatch-Role Name 'Wallet'
		$table_name = "accounts";
		$limit = '10';
		$offset = '0'; 
		$where_array = array('points_mode'=>'wallet', 'account_no' =>$account_no);
		$query = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
		return $query;
    }
	
	public function total_loyality_debit($userID = 0){
        $user = loggedInUserData();
		$role =  $user['role'];
		
        if($userID == 0) {
            $userID = $user['user_id'];
			$account_no = singleDbTableRow($userID)->account_no;
        }
			$table_name = "accounts";
		//$limit = '10';
		//$offset = '0'; 
		$where_array = array('points_mode'=>'loyality', 'account_no' =>$account_no);
		$query = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
		//$query = $this->db->select_sum('debit')->where('points_mode', 'loyality' )->get('accounts'); 
				
        return $query;
    }
	
	public function total_loyality_credit($userID = 0){
        $user = loggedInUserData();
		$role =  $user['role'];
		
        if($userID == 0) {
           $userID = $user['user_id'];
			$account_no = singleDbTableRow($userID)->account_no;
        }
		//$query = $this->db->select_sum('credit')->where('points_mode', 'loyality' )->get('accounts'); 
		$table_name = "accounts";
		$limit = '10';
		$offset = '0'; 
		$where_array = array('points_mode'=>'loyality', 'account_no' =>$account_no);
		$query = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
				
        return $query;
    }
	
		public function total_discount_debit($userID = 0){
        $user = loggedInUserData();
		$role =  $user['role'];
		
        if($userID == 0) {
            $userID = $user['user_id'];
			$account_no = singleDbTableRow($userID)->account_no;
        }
		
	//	$query = $this->db->select_sum('debit')->where('points_mode', 'discount' )->get('accounts'); 
		$table_name = "accounts";
		//$limit = '10';
		//$offset = '0'; 
		$where_array = array('points_mode'=>'discount', 'account_no' =>$account_no);
		$query = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
				
        return $query;
    }
	
	public function total_discount_credit($userID = 0){
        $user = loggedInUserData();
		$role =  $user['role'];
		
        if($userID == 0) {
           $userID = $user['user_id'];
			$account_no = singleDbTableRow($userID)->account_no;
        }
		//$query = $this->db->select_sum('credit')->where('points_mode', 'discount' )->get('accounts'); 
		$table_name = "accounts";
		$limit = '10';
		$offset = '0'; 
		$where_array = array('points_mode'=>'discount', 'account_no' =>$account_no);
		$query = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
				
        return $query;
    }
	// V O U C H E R
			public function total_voucher_debit($userID = 0){
        $user = loggedInUserData();
		$role =  $user['role'];
		
        if($userID == 0) {
            $userID = $user['user_id'];
			$account_no = singleDbTableRow($userID)->account_no;
        }
		
		//$query = $this->db->select_sum('debit')->where('points_mode', 'voucher' )->get('accounts'); 
		$table_name = "accounts";
		$limit = '10';
		$offset = '0'; 
		$where_array = array('points_mode'=>'voucher', 'account_no' =>$account_no);
		$query = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
				
        return $query;
    }
	
	public function total_voucher_credit($userID = 0){
        $user = loggedInUserData();
		$role =  $user['role'];
		
        if($userID == 0) {
           $userID = $user['user_id'];
			$account_no = singleDbTableRow($userID)->account_no;
        }
		//$query = $this->db->select_sum('credit')->where('points_mode', 'voucher' )->get('accounts'); 
		$table_name = "accounts";
		$limit = '10';
		$offset = '0'; 
		$where_array = array('points_mode'=>'voucher', 'account_no' =>$account_no);
		$query = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
				
        return $query;
    }

// L E D G E R -  A C C O U N T S	
			public function total_ledger_debit($userID = 0){
        $user = loggedInUserData();
		$role =  $user['role'];
		
        if($userID == 0) {
            $userID = $user['user_id'];
			$account_no = singleDbTableRow($userID)->account_no;
        }
				
		$table_name = "accounts";
		$limit = '10';
		$offset = '0'; 
		$where_array = array('points_mode'=>'voucher', 'account_no' =>$account_no);
		$query = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
				
        return $query;
    }
	
	public function total_ledger_credit($userID = 0){
        $user = loggedInUserData();
		$role =  $user['role'];
		
        if($userID == 0) {
           $userID = $user['user_id'];
			$account_no = singleDbTableRow($userID)->account_no;
        }
		$table_name = "accounts";
		$limit = '10';
		$offset = '0'; 
		$where_array = array('points_mode'=>'voucher', 'account_no' =>$account_no);
		$query = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
				
        return $query;
    }
/*********************************************************************************************************/	
    public function referralEarnings($userID = 0){
        $user = loggedInUserData();

        if($userID == 0) {
            $userID = $user['user_id'];
			
        }

        //$query = $this->db->select_sum('amount')->get_where('earnings', ['income_for' => 'referralUser', 'user_id' => $userID]);
			$query = $this->db->select_sum('capital')->where('pay_type', 'transfer')->get('ledger'); //temp_delete
        return $query;
    }
	

    public function totalAssets(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            //$query = $this->db->select_sum('amount')->where('income_for', 'admin')->get('earnings'); 
			 $query = $this->db->select_sum('amount')->where('count', 'yes')->get('ledger'); //temp_delete
        }
        elseif($user['role'] == 'agent' )
        {
            $query = $this->db->select_sum('amount')->get_where('accounts', ['user_id' => $userID]);
		  // $query = $this->db->select_sum('amount')->where('user_id', '473519' )->get('accounts');
        }
		  elseif ($user['role'] == 'user')
        {
            $query = $this->db->select_sum('amount')->get_where('accounts', ['user_id' => $userID]);
		  // $query = $this->db->select_sum('amount')->where('user_id', '473519' )->get('accounts');
        }

        return $query;
    }
	 public function totalDebits(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            //$query = $this->db->select_sum('amount')->where('income_for', 'admin')->get('earnings'); 
			 $query = $this->db->select_sum('debit')->where('count', 'yes')->get('ledger'); 
        }
        elseif($user['role'] == 'agent' )
       
        {
            //$query = $this->db->select_sum('amount')->where('income_for', 'admin')->get('earnings'); 
			 $query = $this->db->select_sum('debit')->where('user_id', $userID)->get('ledger'); 
        }       
		 elseif($user['role'] == 'user' )
        {
            //$query = $this->db->select_sum('amount')->where('income_for', 'admin')->get('earnings'); 
			 $query = $this->db->select_sum('debit')->where('user_id', $userID)->get('ledger'); 
        }

        return $query;
    }
	
	public function totalPay_spec(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            //$query = $this->db->select_sum('amount')->where('income_for', 'admin')->get('earnings'); 
			 $query = $this->db->select_sum('debit')->where('pay_type', '9')->get('ledger'); 
        }
        elseif($user['role'] == 'agent' )
       
        {
            //$query = $this->db->select_sum('amount')->where('income_for', 'admin')->get('earnings'); 
			 $query = $this->db->select_sum('debit')->where('user_id', $userID)->get('accounts'); 
        }       
		 elseif($user['role'] == 'user' )
        {
            //$query = $this->db->select_sum('amount')->where('income_for', 'admin')->get('earnings'); 
			 $query = $this->db->select_sum('debit')->where('user_id', $userID)->get('accounts'); 
        }

        return $query;
    }
/**************************Payspec Debit***************************************************************/	
	public function payspec_totaldebit($id){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            
			 $query = $this->db->select_sum('debit')->where('pay_type', '14')->get('ledger'); 
        }
        

        return $query;
    }
/**************************Payspec Credit***************************************************************/	
//Total Cash/Ledger with in the Company
	 public function cpaDebit(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
           	$query1 = $this->db->select_sum('debit')->where('points_mode', 'wallet')->get('accounts');
				return $query1;			
        }
    }
	
 public function cpaCredit(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
           $query2 = $this->db->select_sum('credit')->where('points_mode', 'wallet')->get('accounts');
				return $query2;			
        }
    }
	
//Rolewise payspec Account 
		 public function roleDebit(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
           	$query1 = $this->db->select_sum('debit')->where('points_mode', 'wallet')->get('accounts');
				return $query1;			
        }
    }
	
 public function roleCredit(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
           $query2 = $this->db->select_sum('credit')->where('points_mode', 'wallet')->get('accounts');
				return $query2;			
        }
    }
	
//Userwise payspec Account 
		 public function userDebit(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
           	$query1 = $this->db->select_sum('debit')->where('points_mode', 'wallet')->get('accounts');
				return $query1;			
        }
    }
	
 public function userCredit(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
           $query2 = $this->db->select_sum('credit')->where('points_mode', 'wallet')->get('accounts');
				return $query2;			
        }
    }


	
public function payspec_totalcredit($id){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            
			 $query = $this->db->select_sum('credit')->where('pay_type', '14')->get('ledger'); 
        }
        

        return $query;
    }


	
	public function totalCredits(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            //$query = $this->db->select_sum('amount')->where('income_for', 'admin')->get('earnings'); 
			 $query = $this->db->select_sum('credit')->where('count', 'yes')->get('ledger'); //temp_delete
        }
        elseif($user['role'] == 'agent')
        {
          //  $query = $this->db->select_sum('amount')->get_where('accounts', ['user_id' => $userID]);
		  $query = $this->db->select_sum('credit')->where('user_id', $userID)->get('accounts'); 
        }
		  elseif($user['role'] == 'user')
        {
            //$query = $this->db->select_sum('amount')->where('income_for', 'admin')->get('earnings'); 
			 $query = $this->db->select_sum('credit')->where('user_id', $userID)->get('accounts'); 
        }
        return $query;
    }

//Total Cash/Ledger with in the Company
	 public function ledgerDebit(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
           	$query1 = $this->db->select_sum('debit')->where('count', 'yes')->get('ledger');
				return $query1;			
        }
    }
	
 public function ledgerCredit(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
           $query2 = $this->db->select_sum('credit')->where('count', 'yes')->get('ledger');
				return $query2;			
        }
    }
	
	//Total Cash/Wallet with in the Company
	 public function totalWallet(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            //$query = $this->db->select_sum('amount')->where('income_for', 'admin')->get('earnings'); 
			 $query = $this->db->select_sum('amount')->where('pay_type', '3')->get('ledger'); //temp_delete
        }
        elseif($user['role'] == 'agent')
        {
            $query = $this->db->select_sum('amount')->get_where('accounts', ['user_id' => $userID]);
		  // $query = $this->db->select_sum('amount')->where('user_id', '473519' )->get('accounts');
        }
       elseif($user['role'] == 'user')
        {
          //  $query = $this->db->select_sum('amount')->get_where('accounts', ['user_id' => $userID]);
		  $query = $this->db->select_sum('amount')->where('user_id', $userID)->get('accounts'); 
        }
        return $query;
    }
	//Used Wallet 
	 public function usedWallet(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
		$role 	= $user['role'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            //$query = $this->db->select_sum('amount')->where('income_for', 'admin')->get('earnings'); 
			 $query = $this->db->select_sum('amount')->where('pay_type', 'wallet_Converted')->get('accounts'); //temp_delete
        }
        elseif($user['role'] == 'agent')
        {
           // $query = $this->db->select_sum('amount')->get_where('accounts', ['user_id' => $userID]);
		   $query = $this->db->select_sum('amount')->where('pay_type', 'wallet_Converted')->get('accounts');
        }
       elseif($user['role'] == 'user')
        {
           // $query = $this->db->select_sum('amount')->get_where('accounts', ['user_id' => $userID]);
		   $query = $this->db->select_sum('amount')->where('pay_type', 'wallet_Converted')->get('accounts');
        }
        return $query;
    }
	
	//Wallet Conversion Ratio 
	 public function convertWallet(){
       $limit = '0';
	   $start = '0';
             //$query = $this->db->select_sum('amount')->where('income_for', 'admin')->get('earnings'); 
			// $query = $this->db->where('end_date', '9999-13-31')->get('points_ratio'); 
			//  $query = $this->db->get_where('points_ratio', ['end_date' => '9999-13-31']); 
			   $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('points_ratio');	 

        
        return $query;
    }
	  /**
     * Ledger Account Details
     * Transferring Funds between Pay Specifications
     */
    public function transfer_capital(){
		
		$this->load->helper('string'); //load string helper
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

     	$from_pay_type  = $this->input->post('from_pay_type');
		$to_pay_type  = $this->input->post('to_pay_type');
		$trans_type		= $this->input->post('trans_type');
        $conv_type        	= $this->input->post('conv_type');
		$amount        	= $this->input->post('amount');		
		
	if ($conv_type == 'credit')	
	{
		$credit = $amount  ;
		$debit = '0' ;
		$count = 'yes';
	}
	else{
		$credit = '0' ;
		$debit = $amount  ;
		$count = 'no';
	}
		
		$amount1 		=  ( $debit + $credit );
		//set all data for inserting into database 'To' Pay Sub Accounts Type
        $data2 = [
            'user_id'         		=> $user_id, 
            'invoice_id '  			=> 'test123',
            'amount'         		=> $amount1, 
            'debit'         		=> $credit,
			'credit'         		=> $debit,		
			'points_mode'           => 'wallet',			
            'start_date'         	=> time(),				
			'pay_type'				=> $to_pay_type,
			'remarks'         		=> $this->input->post('remarks'),	
            'created_at'            => time(),
            'modified_at'           => time(),
			'count'       		    => $count
        ];

       $query2 = $this->db->insert('ledger', $data2);

  		
       //set all data for inserting into database 'From' Pay Sub Accounts Type
        $data = [
            'user_id'         		=> $user_id, 
            'invoice_id '  			=> 'test123',
            'amount'         		=> $amount1, 
            'debit'         		=> $debit,
			'credit'         		=> $credit, 	
			'points_mode'           => 'wallet',				
            'start_date'         	=> time(),				
			'pay_type'				=> $from_pay_type,
			'remarks'         		=> $this->input->post('remarks'),	
            'created_at'            => time(),
            'modified_at'           => time(),
			'count'       		    => $count
        ];

       $query = $this->db->insert('ledger', $data);   
	

		
        if($query)
        {
            create_activity('Added '.$data['remarks'].' ledger'); //create an activity
            return true;
        }
        return false; 	
	
    }  ///End of Transfer Capital
	
	 /*********************************************************************
     * Commission Set Up for Roles and Accounts
     *  
     **********************************************************************/
    public function add_commission(){
		$this->load->helper('string'); //load string helper 
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
	
        //set all data for inserting into database
        $data = [		
			'identity' 		  => 'Commission',
			'start_date'      => $this->input->post('start_date'),
            'end_date'   	  => $this->input->post('end_date'),
			'acct_id'         => $this->input->post('acct_id'),
			'sub_acct_id'     => $this->input->post('sub_acct_id'),		
			'ded_paytype'     => $this->input->post('ded_paytype'),			
			'from_role'       => $this->input->post('from_role'),
			'to_role'     	  => $this->input->post('to_role'),
			'ded_paytype'     => $this->input->post('ded_paytype'),
			
			'slr_ref_pm'	  => $this->input->post('slr_ref_pm'),
			'slr_ref_level1'  => $this->input->post('slr_ref_level1'),	
			'slr_ref_level2'  => $this->input->post('slr_ref_level2'),	
			'slr_ref_level3'  => $this->input->post('slr_ref_level3'),	
			'slr_ref_level4'  => $this->input->post('slr_ref_level4'),	
			'slr_ref_level5'  => $this->input->post('slr_ref_level5'),
			
			'clt_ref_pm'	  => $this->input->post('clt_ref_pm'),			
			'clt_ref_level1'  => $this->input->post('clt_ref_level1'),			
			'clt_ref_level2'  => $this->input->post('clt_ref_level2'),	
			'clt_ref_level3'  => $this->input->post('clt_ref_level3'),	
			'clt_ref_level4'  => $this->input->post('clt_ref_level4'),	
			'clt_ref_level5'  => $this->input->post('clt_ref_level5'),

			'points_mode' 	  => $this->input->post('points_mode'),			
			'commission'      => $this->input->post('commission'),
			'benefits'    	  => $this->input->post('benefits'),
			
			'profit_pm' 	  => $this->input->post('profit_pm'),			
			'sender_profit'   => $this->input->post('sender_profit'),
			'receiver_profit'   => $this->input->post('receiver_profit'),
			
			'deduction_pm' 	  => $this->input->post('deduction_pm'),			
			'sender_deduction' => $this->input->post('sender_deduction'),
			'receiver_deduction' => $this->input->post('receiver_deduction'),
			'remarks'     	  => $this->input->post('remarks'),
			'created_by'	  => $user_id,
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
	/* Edit Commissions*/
	
	   public function edit_commissions($id){ 

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$email = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		
        //set all data for inserting into database
        $data = [
			'identity' 		  => 'Commission',
			'start_date'      => $this->input->post('start_date'),
            'end_date'   	  => $this->input->post('end_date'),	
			
			'slr_ref_pm'	  => $this->input->post('slr_ref_pm'),
			'slr_ref_level1'  => $this->input->post('slr_ref_level1'),	
			'slr_ref_level2'  => $this->input->post('slr_ref_level2'),	
			'slr_ref_level3'  => $this->input->post('slr_ref_level3'),	
			'slr_ref_level4'  => $this->input->post('slr_ref_level4'),	
			'slr_ref_level5'  => $this->input->post('slr_ref_level5'),
			
			'clt_ref_pm'	  => $this->input->post('clt_ref_pm'),			
			'clt_ref_level1'  => $this->input->post('clt_ref_level1'),			
			'clt_ref_level2'  => $this->input->post('clt_ref_level2'),	
			'clt_ref_level3'  => $this->input->post('clt_ref_level3'),	
			'clt_ref_level4'  => $this->input->post('clt_ref_level4'),	
			'clt_ref_level5'  => $this->input->post('clt_ref_level5'),	
			
			'points_mode' 	  => $this->input->post('points_mode'),			
			'commission'      => $this->input->post('commission'),
			'benefits'    	  => $this->input->post('benefits'),
			
			'profit_pm' 	  => $this->input->post('profit_pm'),			
			'sender_profit'   => $this->input->post('sender_profit'),
			'receiver_profit' => $this->input->post('receiver_profit'),
			
			'deduction_pm' 	     => $this->input->post('deduction_pm'),			
			'sender_deduction'   => $this->input->post('sender_deduction'),
			'receiver_deduction' => $this->input->post('receiver_deduction'),
			
			'remarks'     	  => $this->input->post('remarks'),		
			'created_by'	  => $user_id,
            'created_at'      => time(),
			'modified_by'     => $user_id,
            'modified_at'     => time()	
			
        ];
			

        $query = $this->db->where('id', $id)->update('commissions', $data);

        if($query)
        {
            create_activity('Updated '.$data['remarks'].' commissions'); //create an activity
            return true;
        }
        return false;

    }
	/*********************************************************************************/
					//Commission for Transaction Seller and Client
	/*********************************************************************************/
	public function commissionListCount(){
        $queryCount = $this->db->where('identity', 'Commission')->count_all_results('commissions');
        return $queryCount;
		
		
    }
	
	 public function commissionList($limit = 0, $start = 0){
		
		/*	$query = $this->db->query("select commissions.*, users.first_name, users.last_name
						from commissions LEFT JOIN users
						ON commissions.created_by = users.id ORDER BY commissions.id DESC Limit {$start}, {$limit}");
						
			 $query = $this->db->where('identity', 'Commission')->get('commissions');	
*/			$table_name = "commissions";
			$where_array = array('identity' => 'Commission');
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 				
						 
			 return $query;
			 
	}


	/*********************************************************************************/
					//Reffered by User List and commision from referred Candidates
	/*********************************************************************************/
		public function referralListCount(){
			
		$table_name = "users";
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$email = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		$referral_code = singleDbTableRow($user_id)->referral_code;
		
			if ($currentUser == 'admin'){
				$queryCount = $this->db->where('active', '1')->count_all_results('users');
				
							
			}else{
			$where_array = array('referredByCode' =>$referral_code);
			//$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 
			
				$queryCount = $this->db->where($where_array)->count_all_results('users');
			}
        return $queryCount;
		
		
    }
	
	 public function referralList($limit = 0, $start = 0){
		$user_info 	   = $this->session->userdata('logged_user');
        $user_id 	   = $user_info['user_id'];
		$email 		   = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		$referral_code = singleDbTableRow($user_id)->referral_code;
		/* Search Model */
		  $search = $this->input->get('search');
		$searchValue = $search['value'];

		$searchByID = '';
				
			if($searchValue != '')
			{
				//$searchByID = " WHERE invoice.id = '{$searchValue}'";
				$where_array = array('referredByCode'=> $searchValue);				
				$table_name = "users";		
			    $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 		
				
			}else{
				$table_name = "users";			
				$where_array = array( 'referredByCode' =>$referral_code);
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 				
			}
			 return $query;
			 
	}	
	/*********************************************************************************/
					//Reffered by user Account Statements to Referrer
	/*********************************************************************************/
		public function referralUserCommissionListCount(){
       
		$table_name = "accounts";		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$email = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		$account_no = singleDbTableRow($user_id)->account_no;
		
			if ($currentUser == 'admin'){
				$where_array = array('points_mode' => 'wallet');
				$queryCount = $this->db->where($where_array )->count_all_results('accounts');
				
			}elseif ($currentUser == 'agent'){
				
				$queryCount = $this->db->where('active', '1')->count_all_results('accounts');
				
			}elseif ($currentUser == 'user'){
				$where_array = array('points_mode' => 'wallet');
				$queryCount = $this->db->where($where_array )->count_all_results('accounts');
			}
        return $queryCount;
		
		
    }
	
	 public function referralUserCommissionList($limit = 0, $start = 0){
		$user_info 	   = $this->session->userdata('logged_user');
        $user_id 	   = $user_info['user_id'];
		$email 		   = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		$referral_code = singleDbTableRow($user_id)->referral_code;
		
		 $table_name = "accounts";
			
			$where_array = array('points_mode' => 'wallet');
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 				
				
		return $query;
			 
	}	
	
	 /**
     * Services Transaction Lists
     */

    public function services_transactiontListCount(){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$referral_code = singleDbTableRow($user_id)->referral_code;
		$currentUser   = singleDbTableRow($user_id)->role;
		
       
		    if($currentUser == 'admin'){
            $query = $this->db->count_all_results('recharge');
			
				}
			else{
				//$where_array = array ('user_id'=>$user_id, 'paid_to'=>$user_id);
			 $query = $this->db->where('user_id',$user_id )->count_all_results('recharge');	
			}
        return $query;
    } 
	
				
    public function services_transactionList($limit = 0, $start = 0){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
			$referral_code = singleDbTableRow($user_id)->referral_code;		 
		 	$currentUser   = singleDbTableRow($user_id)->role;
			$account_no   = singleDbTableRow($user_id)->account_no;
       
	    if($currentUser == 'admin'){
	/*  $query = $this->db->query("select accounts.*, users.first_name, users.last_name
				from accounts  LEFT JOIN users
				ON accounts.user_id = users.id ORDER BY accounts.id DESC Limit {$start}, {$limit}"); */
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('accounts');	
}
			else{
				
			/*	 $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where('user_id', $user_id )->get('accounts');	 */
			//	$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('accounts',['account_no'=>$account_no]);	

			$table_name = "recharge";
			$where_array = array('account_no' =>$account_no, 'user_id' =>$user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 				
			}
        return $query;
    }
	
	 /***********************************************************************************************************************/
     /* Pay Spec's Account Details fetch
     /* 
     /***********************************************************************************************************************/
    public function payspec_accounts(){ 
		$this->load->helper('string'); //load string helper 
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

     	$pay_type       = $this->input->post('pay_type');
		$trans_type		= $this->input->post('trans_type');
        $challan        = $this->input->post('challan');
	//	$liabilities    = $this->input->post('liabilities');
        $cash         	= $this->input->post('cash');	
		
	if ($trans_type == 'Credit')	
	{
		$credit = $cash ;
		$debit = '0' ;
	}
	else{
		$credit = '0' ;
		$debit = $cash ;
	}
		
		$amount 		=  ( $debit + $credit );
		//check user is selected photo
        if($_FILES['userfile']['name'] != '')
        {
            $upload_dir = './uploads/'; //Upload directory
            if( ! file_exists($upload_dir)) mkdir($upload_dir); //create directory if not found.
            $config['upload_path']          = $upload_dir;
            $config['allowed_types']        = 'gif|jpg|png|bmp';
            $config['max_size']             = 50000;
            $config['max_width']            = 50000;
            $config['max_height']           = 50000;

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
		$today = date("Y/m/d");
        //set all data for inserting into database
        $data = [
            'user_id'         		=> $user_id, // $this->input->post('vouchers_name'),
            'invoice_id '  			=> 'test123',
            'amount'         		=> $amount, //$this->input->post('capital'),
            'debit'         		=> $debit,// $this->input->post('capital'),
			'credit'         		=> $credit, //$this->input->post('liabilities'),
			'points_mode'           => 'wallet',				
            'count'         		=> 'yes',						
            'start_date'         	=> $today,					
			'pay_type'				=> $pay_type,
			'remarks'         		=> $this->input->post('remarks'),	
			'challan'				=> $photoName,			
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
	
  	
	
}