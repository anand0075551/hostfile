<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    /**
     * @return bool
     */

    public function add_category(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'name'       			=> $this->input->post('name'),			
        
            'epin'    				=> $this->input->post('epin'),
			//'transferrable'    		=> $this->input->post('transferrable'),
            'added_by'              => $user_id,
            'created_at'            => time(),
			'modified_by'           => 'Administrator', //$user_id,
            'modified_at'           => time()
        ];

       $query = $this->db->insert('categories', $data);
	   // $query = $this->db->insert('vouchers', $data);

        if($query)
        {
		//		  create_activity('Added '.$data['voucher_name'].' vouchers'); //create an activity
	            create_activity('Added '.$data['name'].' Category'); //create an activity
            return true;
        }
        return false;

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
            'category_type'   		=> 'main',
			'ledger_type'			=>  $this->input->post('ledger_type'),
			'visible'  				=> '0',
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
     * Sub-Accounts Category Type
     */

    public function add_acct_sub_category(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$visible = $this->input->post('visible');
		
		$parentid = $this->input->post('category_type');
		
		
		$query1 = $this->db->get_where('acct_categories', ['id' => $parentid]);
		if($query1->num_rows() > 0)
		{
			foreach($query1->result() as $r);
			{
				$ledger_type = $r->ledger_type;
		
        //set all data for inserting into database
        $data = [
            'name'         			=> $this->input->post('category_name'),
			'category_type'   		=> 'sub',
            'parentid'   			=> $parentid,
			'ledger_type'			=> $ledger_type,
			'visible'  				=> $visible,
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
    }
	}
   /**
     * @param $id
     * @return bool
     * Update Category
     */


    public function edit_category($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'name'         			=> $this->input->post('category_name'),
            'commission_percent'    => $this->input->post('commission_percent'),
            'added_by'              => $user_id,
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $query = $this->db->where('id', $id)->update('categories', $data);

        if($query)
        {
            create_activity('Updated '.$data['name'].' Category'); //create an activity
            return true;
        }
        return false;

    }
    
// Edit Pay Specification/Sub-Accounts

    public function edit_payspec($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$visible = $this->input->post('visible');
		
		

        //set all data for inserting into database
        $data = [
            'name'         			=> $this->input->post('category_name'),			
           
			'visible'  				=> $visible,
            'added_by'              => $user_id,
            'created_at'            => time(),
            'modified_at'           => time()
        ];


        $query = $this->db->where('id', $id)->update('acct_categories', $data);

        if($query)
        {
            create_activity('Updated '.$data['name'].' acct_categories'); //create an activity
            return true;
        }
        return false;

    }
   /**
     * 
     * Updating Ratio Table
     */


    public function edit_ratio($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
		$data = [
			//'identity'			=> 'Wallet Conversion',	       
			//'identity_id'			=> 'wal_cov',	       
            'remarks'       		=> $this->input->post('remarks'),	         
			'start_date'       		=> $this->input->post('start_date'),
           // 'end_date'   		 	=> '9999-12-31',
            'alpha'       			=> $this->input->post('alpha'),
            'beta'    				=> $this->input->post('beta'),			
			'gamma'    				=> $this->input->post('gamma'),	          
			'modified_by'           => $user_id, 
            'modified_at'           => time()
        ];

        $query = $this->db->where('id', $id)->update('points_ratio', $data);

        if($query)
        {
            create_activity('Updated '.$data['remarks'].'points_ratio'); //create an activity
            return true;
        }
        return false;

    }



  /**
     * @return Agent List
     * Agent List Query
     */

    public function categoryListCount(){
//        $queryCount = $this->db->count_all_results('categories'); 
			$queryCount = $this->db->count_all_results('points_ratio'); 
        return $queryCount;
    }

    public function categoryList(){
		$limit = '0';
		$start = '0';
      //  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->join('users', 'users.id = categories.added_by')->get('categories');
	//	$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('points_ratio');	 

		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('points_ratio');
				
        return $query;
    }
	
	public function getmainCat()
	{
		$conn = mysqli_connect("localhost","root","", "sams");
		$data = array();
		$res = mysqli_query($conn,"select * from acct_categories where parentid='0'");
		while($row = mysqli_fetch_object($res))
		{
			array_push($data, $row);
		}
		return $data;
	}

	 /**
     * Updating Ratio Table
     */

    public function points_ratio(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
			'identity'				=> 'Ratio Conversions',	       
			'identity_id'			=> $this->input->post('identity_id'),	       
            'remarks'       		=> $this->input->post('remarks'),	         
			'start_date'       		=> $this->input->post('start_date'),
            'end_date'   		 	=> '9999-12-31',
            'alpha'       			=> $this->input->post('alpha'),
            'beta'    				=> $this->input->post('beta'),			
			'gamma'    				=> $this->input->post('gamma'),
            'created_by'            => $user_id,
            'created_at'            => time(),
			'modified_by'           => 'Administrator', //$user_id,
            'modified_at'           => time()
        ];

       $query = $this->db->insert('points_ratio', $data);

        if($query)
        {
		
	            create_activity('Added '.$data['remarks'].' points_ratio'); //create an activity
            return true;
        }
        return false;

    }
 /**
     * Coverting Wallet to Discount
     */

    public function wallet_to_discount(){ 
	
	
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$account_no = singleDbTableRow($user_id)->account_no;
		$role  		= singleDbTableRow($user_id)->role;
		$email  	= singleDbTableRow($user_id)->email;
		$rolename   = singleDbTableRow($user_id)->rolename;
		
		$conv_type 	= $this->input->post('conv_type');		//From Conversion		
		$trans_type = $this->input->post('trans_type');		//To Conversion
		
	//Getting Ratio from Points Ratio Table	
			$table_name = "points_ratio";
			$where_array = array('end_date' =>'9999-12-31', 'identity' =>'Ratio Conversions');
			$query = $this->db->where($where_array )->get($table_name); 
			
		foreach ($query->result() as $convert)
		{
			if($convert->identity_id == $conv_type ){
			$ratio_loyality   = $convert->alpha; 
			$ratio_discount   = $convert->beta; }
		}
		
		
		
		$wallet 	= $this->input->post('wallet');
		$loyality 	= $this->input->post('loyality');
		$discount 	= $this->input->post('discount');
		
		$tranx_id = $this->input->post('tranx_id');
		
		
		if ($conv_type == 'wallet')
			{  
				if ($trans_type == 'loyality')
				{	
					$input_amt 	= $this->input->post('amount');
					$credit = (($ratio_loyality * $input_amt)); 
					$amount1 = $input_amt;  	//User Entered Amount to Convert * 
					$amount2 = $credit;     	// Loyality % value Debit/converted
					$pay_type =  '48'; 			//'VPA to Loyality Values';
					$payspec_return = '55'; 	//VPA - Return Values
				}
				elseif($trans_type == 'discount')
				{
					$input_amt 	= $this->input->post('amount');
					$credit = (($ratio_discount * $input_amt)); 
					$amount1 = $input_amt;
					$amount2 = $credit;
					$pay_type =  '49'; 			//'VPA to Discount Values';		
					$payspec_return = '55'; 	//VPA - Return Values					
				}
				elseif($trans_type == 'wallet')
				{
					$amount1 = '0';
					$amount2 = '0';
				}
				
			}
		elseif($conv_type == 'loyality')
			{
				if ($trans_type == 'wallet')
				{	
					$input_amt 	= $this->input->post('amount');
					$credit = ($input_amt / $ratio_loyality );	
					$amount1 = $input_amt;
					$amount2 = $credit;
					$pay_type =  '50'; //'Loyality to VPA Values';
					$payspec_return = '56'; 	//Loyality - Return Values	
				}
				elseif($trans_type == 'discount')
				{
					$input_amt 	= $this->input->post('amount');
					$credit = (($ratio_discount * $input_amt)); 
					$amount1 = $input_amt;
					$amount2 = $credit;
					$pay_type =  '51'; //'Loyality to Discount Values';
					$payspec_return = '56'; 	//Loyality - Return Values
					
				}
				elseif($trans_type == 'loyality')
				{
					$amount1 = '0';
					$amount2 = '0';
				}
				
			}
		elseif($conv_type == 'discount')
			{
				if ($trans_type == 'wallet')
				{	
					$input_amt 	= $this->input->post('amount');
					$credit = ($input_amt / $ratio_discount );	
					$amount1 = $input_amt;
					$amount2 = $credit;
					$pay_type =  '52'; //'Discount to VPA Values';
					$payspec_return = '57'; 	//Discount - Return Values
					
				}
				if ($trans_type == 'loyality')
				{	
					$input_amt 	= $this->input->post('amount');
					$credit = (($ratio_loyality * $input_amt)); 
					$amount1 = $input_amt;
					$amount2 = $credit;
					$pay_type =  '53'; //'Discount to Loyality Values';
					$payspec_return = '57'; 	//Discount - Return Values
				}
				elseif($trans_type == 'discount')
				{
					$amount1 = '0';
					$amount2 = '0';
				}				
			}
			
		if ($amount1	!= '0' )//set all data for inserting into database
			{	
			   $data1 = [
							'user_id'      			=> $user_id,          //New Member ID  
							'account_no'         	=> $account_no,
							'rolename'              => $rolename,
							'email'					=> $email,
							'paid_to'         		=> '00',          
							'tranx_id'         		=> $tranx_id,
							'credit'         		=> $amount1,
							'debit'         		=> '0',
							'amount'         		=> $amount1,
							'points_mode'           => $conv_type,	
							'used'					=> 'yes',
							'pay_type'				=> $pay_type, // Pay Specification	
							'created_at'            => time(),
							'modified_at'           => time()
						];

			   $query1 = $this->db->insert('accounts', $data1);
				
				$pay_type2 = 'Converted cash to '.$trans_type.' points';
			   //set all data for inserting into database
			   $data2 = [
			   
							'user_id'      			=> $user_id,          //New Member ID  
							'account_no'         	=> $account_no,
							'rolename'              => $rolename,
							'email'					=> $email,
							'paid_to'         		=> '00',          
							'tranx_id'         		=> $tranx_id,
							'credit'         		=> '0',
							'debit'         		=> $amount2,
							'amount'         		=> $amount2,
							'points_mode'           => $trans_type,	
							'used'					=> 'no',
							'pay_type'				=> $pay_type, // Pay Specification	
							'created_at'            => time(),
							'modified_at'           => time()
			   			];

			   $query2 = $this->db->insert('accounts', $data2);
			
//Ledger Update for accounts

$today = date("Y/m/d");
		
	$pay_recieve = '';
        //set all data for inserting into database
        $ledger1 = [
            'user_id'         		=> $user_id,
            'invoice_id '  			=> 'Points_convertion',
			'account_no'         	=> $account_no,
            'rolename'  			=> $rolename,
			'email'					=> $email,
            'credit'         		=> '0',
			'debit'         		=> $amount1,
			'amount'         		=> $amount1,			
			'points_mode' 			=> $conv_type,
            'count'         		=> 'yes',						
            'start_date'         	=> $today,					
			'pay_type'				=> $payspec_return,
			'remarks'         		=> $tranx_id,	
			'challan'				=> 'no_invoice.jpg',			
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query3 = $this->db->insert('ledger', $ledger1);	
		
 //set all data for inserting into database
        $ledger2 = [
            'user_id'         		=> $user_id,
            'invoice_id '  			=> 'Points_convertion',
			'account_no'         	=> $account_no,
            'rolename'  			=> $rolename,
			'email'					=> $email,
            'credit'         		=> $amount2,
			'debit'         		=> '0',
			'amount'         		=> $amount2,
			'points_mode' 			=> $trans_type,
            'count'         		=> 'yes',						
            'start_date'         	=> $today,					
			'pay_type'				=> $pay_type,
			'remarks'         		=> $tranx_id,	
			'challan'				=> 'no_invoice.jpg',			
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query4 = $this->db->insert('ledger', $ledger2);	
					
				if($query2)
				{
				
						create_activity('Added '.$data['pay_type'].' accounts'); //create an activity
					return true;
				}
				return false;
			}
    }

	/**
     * @return Agent List
     * Agent List Query
     */

    public function payspec_ListCount(){
        $query = $this->db->where('category_type','sub')->count_all_results('acct_categories');
        return $query;
    } 

    public function payspec_List($start = 0, $limit = 0){
      //  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->join('users', 'users.id = ledger.added_by')->get('ledger');
		
	/*	$query = $this->db->query("select ledger.*, users.first_name, users.last_name
				from ledger LEFT JOIN users
				ON ledger.user_id = users.id ORDER BY ledger.id DESC Limit {$start}, {$limit}");  
	*/		
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('acct_categories');
				
		return $query;			 
	
    }
}
 