<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    /**
     * @return bool
     */

    public function add_category(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'name'       			=> $this->input->post('category_name'),
            'commission_percent'    => $this->input->post('commission_percent'),
            'added_by'              => $user_id,
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('categories', $data);

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


    public function edit_category($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'name'        			=> $this->input->post('category_name'),
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

  /**
     * @return Agent List
     * Agent List Query
     */

    public function categoryListCount(){
        $query = $this->db->count_all_results('categories');
        return $query;
    }

    public function categoryList($limit = 0, $start = 0){
        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->join('users', 'users.id = categories.added_by')->get('categories');
        return $query;
    }


  /**
     * Product sell method
     * insert invoice, individual product
    * @return bool
     */


    public function sell(){

        $c_id = $this->input->post('customerID');
        $customer_info = singleDbTableRow($c_id);

        //Redirect if user/customer not found..

        if( ! $customer_info)
        {
            //set error message and go back
            setFlashGoBack('errorMsg', 'Client Not Found!');
        }

        //get customer referral Code
        $customer_referral_id = $customer_info->referral_code;

        $customer_id = $customer_info->id;

        //$referral_id = singleDbTableRow($customer_info->referredByCode, 'users', 'referral_code')->id;

        //Get ID From currently logged in User
        $sales_by = $this->session->userdata('logged_user')['user_id'];


        $qty 			= $this->input->post('qty');
        $productName 	= $this->input->post('productName');
        $categories 	= $this->input->post('categories');
        $itemPrice 		= $this->input->post('price');

        $totalProduct = count($qty);

        $invoiceData = [
            'total_product'         => $totalProduct,
            'customer_id'           => $customer_id,
            'customer_referral_id'  => $customer_referral_id,
            'sales_by'              => $sales_by,
            'created_at'            => time(),
            'modified_at'           => time(),
        ];

        $insertInvoice = $this->db->insert('invoice', $invoiceData);

        $invoice_id = $this->db->insert_id();

        // Get Each sales Item and insert to sales_item table

        $HTMLrow = '';

        for($i = 0; $i < $totalProduct; $i++){

            $quantity = $qty[$i];

            $categoryID = $categories[$i];
            $product_name = $productName[$i];
            $price = $itemPrice[$i] * $quantity;
            $total_price[] = $price;

            $categoryCommission = singleDbTableRow($categoryID, 'categories')->commission_percent;

            // Get commission base on category
            $commission         = get_percent($price, $categoryCommission);
            $commissionArray[]  = $commission;

            $sales_itemData = [
                'category_id'   => $categoryID,
                'product_name'  => $product_name,
                'invoice_id'    => $invoice_id,
                'qty'           => $quantity,
                'item_price'    => $itemPrice[$i],
                'price'         => $price,
                'commission'    => $commission,
                'created_at'    => time(),
                'modified_at'   => time(),
            ];

            $sales_itemInsert = $this->db->insert('sales_item', $sales_itemData);

            //HTML For Email
            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;">'.$i.'</td>
                        <td style="padding:5px;text-align:center;">'.$product_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$itemPrice[$i].'</td>
                        <td style="padding:5px;text-align:center;">'.$quantity.'</td>
                        <td style="padding:5px;text-align:center;">'.$price.'</td>
                    </tr>';


        }

        //Calculate Commission for Admin, agent, and customer
        $totalCommission = array_sum($commissionArray);
        $total_price = array_sum($total_price);

        //Update Total Price in Invoice
        $this->db->where('id', $invoice_id)->update('invoice', ['total_price' => $total_price]);
        //Create activity about sell product
        create_activity('sell out product, amount : '. $total_price);

        //$settings = get_admin_settings();

        $agent_commision    = get_percent($totalCommission, get_option('agent_commision'));
        $user_commision     = get_percent($totalCommission, get_option('user_commision'));
        $referral_commision = get_percent($totalCommission, get_option('referral_commision'));
        $admin_commision    = get_percent($totalCommission, get_option('admin_commision'));

        // Insert data for Agent Earning

        $agentEarning = [
            'user_id'       => $sales_by,
            'amount'        => $agent_commision,
            'invoice_id'    => $invoice_id,
            'income_type'   => 'onSales',
            'income_for'    => 'agent',
            'created_at'    => time(),
            'modified_at'   => time(),
        ];

        $this->db->insert('earnings', $agentEarning);

        // Insert data for User Earning

        $userEarning = [
            'user_id'       => $customer_id,
            'amount'        => $user_commision,
            'invoice_id'    => $invoice_id,
            'income_type'   => 'onPurchase',
            'income_for'    => 'user', //client
            'created_at'    => time(),
            'modified_at'   => time(),
        ];

        $this->db->insert('earnings', $userEarning);

        // Insert data for Admin Earning

        $adminEarning = [
            'user_id'       => 1,
            'amount'        => $admin_commision,
            'invoice_id'    => $invoice_id,
            'income_type'   => 'admin',
            'income_for'    => 'admin', //client
            'created_at'    => time(),
            'modified_at'   => time(),
        ];

        $this->db->insert('earnings', $adminEarning);

        // Insert data for referral for This Customer

        $referralEarning = [
            'user_id'       => $c_id,
            'amount'        => $referral_commision,
            'invoice_id'    => $invoice_id,
            'income_type'   => 'referral',
            'income_for'    => 'referralUser', //client
            'created_at'    => time(),
            'modified_at'   => time(),
        ];

        $this->db->insert('earnings', $referralEarning);


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
            $subject = 'Hi '.user_full_name($customer_info).', your order details @'.date('d-m-Y h:i a');
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($customer_info->email);
            $this->email->cc($adminEmail);
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

    /**
     * @return Invoice counts
     */

    public function invoiceListCount(){
        $user = loggedInUserData();
        $userID = $user['user_id'];
        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            $query = $this->db->count_all_results('invoice');
        }
        elseif($user['role'] == 'agent'){
            $query = $this->db->where('sales_by', $userID)->count_all_results('invoice');
        }
        elseif($user['role'] == 'user'){
			//$where_array = array ('sales_by' => $userID, 'customer_id' => $userID);
            $query = $this->db->where('sales_by', $userID)->count_all_results('invoice');       
        }
        return $query;
    }
	
	
	/**
     * @return Invoice data
     */
 
		
    public function invoiceList($limit = 0, $start = 0 ){
		$user = loggedInUserData();
		$userID = $user['user_id'];
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$search = $this->input->get('search');
		$searchValue = $search['value'];

		$searchByID = '';
		//Get Decision who in online?
		if($user['role'] == 'admin')
		{
			if($searchValue != '')
			{
				$searchByID = " WHERE invoice.id = '{$searchValue}'";
			}

			$query = $this->db->query("select invoice.*, users.first_name as userFirstName,
				users.last_name as userLastName, users.street_address as userStreetAddress,
				agent.first_name as agentFirstName, agent.last_name as agentLastName,
				agent.street_address as agentStreetAddress
				from invoice LEFT JOIN users
				ON invoice.customer_id = users.id
				LEFT JOIN users AS agent ON invoice.sales_by = agent.id
				{$searchByID}
				ORDER BY invoice.id DESC Limit {$start}, {$limit}");
		}
		elseif($user['role'] == 'agent')
		{

			if($searchValue != '')
			{
				$searchByID = " AND invoice.id = '{$searchValue}'";
			}

			$query = $this->db->query("select invoice.*, users.first_name as userFirstName,
				users.last_name as userLastName, users.street_address as userStreetAddress,
				agent.first_name as agentFirstName, agent.last_name as agentLastName,
				agent.street_address as agentStreetAddress
				from invoice LEFT JOIN users
				ON invoice.customer_id = users.id
				LEFT JOIN users AS agent ON invoice.sales_by = agent.id
				WHERE invoice.sales_by = {$userID}  {$searchByID}
				ORDER BY invoice.id DESC Limit {$start}, {$limit}");

		}
		elseif($user['role'] == 'user')
		{
			if($searchValue != '')
			{
				$searchByID = " AND invoice.id = '{$searchValue}'";
			}

			$query = $this->db->query("select invoice.*, users.first_name as userFirstName,
				users.last_name as userLastName, users.street_address as userStreetAddress,
				agent.first_name as agentFirstName, agent.last_name as agentLastName,
				agent.street_address as agentStreetAddress
				from invoice LEFT JOIN users
				ON invoice.customer_id = users.id
				LEFT JOIN users AS agent ON invoice.sales_by = agent.id
				WHERE invoice.sales_by = {$userID}  {$searchByID}
				ORDER BY invoice.id DESC Limit {$start}, {$limit}");
		}
		
		return $query;
	}
	

    /**
     * @param int $id
     * @return mixed
     * Get invoice details
     *
     */

    public function getInvoiceDetails($id = 0){

        $query = $this->db->query("select invoice.*, users.first_name as userFirstName,
				users.last_name as userLastName,
				users.contactno as userContactNo, users.email as userEmail,
				users.street_address as userStreetAddress,

				agent.first_name as agentFirstName, agent.last_name as agentLastName,
				agent.contactno as agentContactNo, agent.email as agentEmail,
				agent.street_address as agentStreetAddress
				from invoice LEFT JOIN users
				ON invoice.customer_id = users.id
				LEFT JOIN users AS agent ON invoice.sales_by = agent.id WHERE invoice.id = {$id}");

        return $query;
    }

    /**
     * @param int $id
     * @return mixed
     * return all sales item by invoice id with category name
     */

    public function getAllItemByInvoice($id = 0){
        //$query = $this->db->get_where('sales_item', ['invoice_id' => $id]);

      /*  $query = $this->db->query("select sales_item.*, categories.name as categoryName
                from sales_item LEFT JOIN categories
                ON sales_item.category_id = categories.id
                WHERE sales_item.invoice_id = {$id}");
        return $query; */
		
        $query = $this->db->query("select sales_item.*, acct_categories.name as categoryName
                from sales_item LEFT JOIN acct_categories
                ON sales_item.category_id = acct_categories.id
                WHERE sales_item.invoice_id = {$id}");
        return $query;
		
    }
/******************************************************************************************/

				//Wallet     Payment     to     any      Partners

//Anand 

/******************************************************************************************/
public function pay_wallet(){
		
       $c_id = $this->input->post('customerID');
	   
       $customer_info = singleDbTableRow($c_id);

        //Redirect if user/customer not found..

        if( ! $customer_info)
        {
            //set error message and go back
            setFlashGoBack('errorMsg', 'Client Not Found!');
        }

        //get customer referral Code
        $customer_referral_id = $customer_info->referral_code;
		$rolename 	  		  = $customer_info->rolename; //User type
		
        $customer_id = $customer_info->id;
		$account_no  = $customer_info->account_no;
		$role 		 = $customer_info->role;	
		
		
/****To create Invoice for Transactions*/

        //Get ID From currently logged in User
        $sales_by = $this->session->userdata('logged_user')['user_id'];
	
        $qty 			= $this->input->post('qty');
        $productName 	= $this->input->post('productName');
        $categories 	= $this->input->post('categories');
        $itemCost 		= $this->input->post('price');

        $totalProduct = count($qty);
		$itemPrice =  $itemCost  ;
		
        $invoiceData = [
            'total_product'         => $totalProduct,
			//'total_price'           => $itemPrice,			
            'customer_id'           => $customer_id,
            'customer_referral_id'  => $customer_referral_id,
            'sales_by'              => $sales_by,
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
            $price = $itemPrice[$i] * $quantity;
            $total_price[] = $price;


			$acct_id1 = $this->input->post('sub_account');
			$seller_info = $this->session->userdata('logged_user');
			$sellerID = $seller_info['user_id']; // 	$sales_by;
			$seller_role = singleDbTableRow($sellerID)->rolename;
			
			$client_id = $customer_id;
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
                'item_price'    => $itemPrice[$i],
                'price'         => $price,
				'commission'    => $commission_per1, //$commission,				
                'benefits'      => $benefits_per1,
                'created_at'    => time(),
                'modified_at'   => time(),
            ];

            $sales_itemInsert = $this->db->insert('sales_item', $sales_itemData);

			
            //HTML For Email
            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;">'.$i.'</td>
                        <td style="padding:5px;text-align:center;">'.$product_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$itemPrice[$i].'</td>
                        <td style="padding:5px;text-align:center;">'.$quantity.'</td>
                        <td style="padding:5px;text-align:center;">'.$price.'</td>
                    </tr>';


        }
        //Anand Code starts here Section for Commision & Benefits
/**********************
 Table update Response To the Recieving Partner from the Money sender user
*************************/
		 $total_price = array_sum($total_price);
			
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$sales_role =  $user['role'];	
		
		$referral_code = singleDbTableRow($userID)->referral_code;
		$first_name1 = singleDbTableRow($userID)->first_name;
		
		$c_account_no = singleDbTableRow($c_id)->account_no;
		
		$wallet_balance = $this->input->post('wallet_balance');
		
	
//Benefits details To the Recieving Partner for data retrival 
		$pm_wallet = 'wallet';
		
		$acct_id = $this->input->post('sub_account');
			
		$user_info 	   = $this->session->userdata('logged_user');
        $user_id 	   = $user_info['user_id'];
		$email 		   = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		$sel_ref_code  = singleDbTableRow($user_id)->referral_code;
		$sel_ref_by    = singleDbTableRow($user_id)->referredByCode;   //Key field to get 5 level Network
		$seller_role   = singleDbTableRow($user_id)->rolename;		
		
		$seller_rolename = typeDbTableRow($seller_role)->rolename;     //Role Description
		$seller_account_no = singleDbTableRow($user_id)->account_no;	
		$seller_email      = singleDbTableRow($user_id)->email;			

		
		$client_id = $customer_id;
		$client_role  = singleDbTableRow($client_id)->rolename;		
		
		$client_rolename = typeDbTableRow($client_role)->rolename;    //Role Description
		$client_email    = singleDbTableRow($client_id)->email;	
		$client_name  = singleDbTableRow($client_id)->first_name;	
		$clt_ref_code = singleDbTableRow($client_id)->referral_code;	
		$clt_ref_by   = singleDbTableRow($client_id)->referredByCode; //Key field to get 5 level Network
		
//Get Individual Account transactions Id
		//'tran_count'			=> $tran_count,
		$acct_user = $c_id;
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

	// Insert data for Accounts-Wallet debit "To the Recieving Partner"
	
		$tranx_id1 = 'Paid by'.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id;
	//	$text1 = "Recieved wallet for Business/Payspecification ID -".$acct_id;
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
			'amount'         		=> $total_price,						
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
		$this->Notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
		
		
		
		
		
	//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
	if ($currentUser = 'admin' )	//Except Agent and Customer, recording rest of the transactions to Ledger
	{   
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
		
	}	
		
		$tranx_id2 = "Paid to '".$client_rolename.'-'.$client_name."' for the Invoice ID-".$invoice_id;
//Get Individual Account transactions Id
		//'tran_count'			=> $tran_count,
		$acct_user = $c_id;
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
	//Sender/Seller/Active user
	   $accounts2 = [
            'user_id'      			=> $user_id,        //From the Money sender user
			'email'         	    => $seller_email,
			'account_no'         	=> $seller_account_no,
            'rolename'  			=> $client_role,
			'paid_to'         		=> $c_id,      // To the Recieving Partner  
            'pay_type'         		=> $acct_id,      //Payspecification ID
			'debit'         		=> '0',
			'credit'         		=> $total_price,
			'amount'         		=> $total_price,						
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
		$this->Notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
		
	
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
/******Automatically Payspecification will be Identified and calculates the Percentage******
Reciever and client are same
Sender and Seller are same   ********/	
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
		$client_deduction = $row->receiver_deduction;
		
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


/*********   Begin of  'seller' Referrals Commision for Level 1                    *********/

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
								
								//Get Individual Account transactions Id
								//'tran_count'			=> $tran_count,
								$acct_user = $ref_id1;
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

								$accounts_ref1 = [
									'user_id'      			=> $ref_id1,          //To the Recieving Partner  
									'account_no'         	=> $ref_account_no,									
									'rolename'  			    => $rolename,
									'email'					=> $email,
									'paid_to'         		=> $paid_to,       //From the Money sender user 
									'tranx_id'         		=> $text1,
									'credit'         		=> '0',
									'debit'         		=> $slr_ref_per_level1,
									'amount'         		=> $slr_ref_per_level1,	
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
								$total_price = $slr_ref_per_level1;
								$pm_wallet = $slr_ref_pm;
								$this->Notification_model->sms_ref_accounts($sms_user, $tran, $total_price, $pm_wallet );
								
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
										//'tran_count'			=> $tran_count,
										$acct_user = $ref_id2;
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
										$accounts_ref2 = [
											'user_id'      			=> $ref_id2,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $slr_ref_per_level2,
											'amount'         		=> $slr_ref_per_level2,	
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
									$total_price = $slr_ref_per_level2;
									$pm_wallet = $slr_ref_pm;
									$this->notification_model->sms_ref_accounts($sms_user, $tran, $total_price, $pm_wallet );
									
									
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
													$accounts_ref3 = [
														'user_id'      			=> $ref_id3,          //To the Recieving Part	ner  
														'account_no'         	=> $ref_account_no,
														'rolename'  			=> $rolename,
														'email'					=> $email,
														'paid_to'         		=> $paid_to,       //From the Money sender 	user 
														'tranx_id'         		=> $text2,
														'credit'         		=>	 '0',
														'debit'         		=> $slr_ref_per_level3,
														'amount'         		=> $slr_ref_per_level3,	
														'points_mode'           => $slr_ref_pm,	
														'used'					=> 	'no',
														'pay_type'				=> $deduction_paytype, //$invoice_	id,		
														'created_at'            => time(),
														'modified_at'           => time()
													];

														$this->db->insert('accounts', $accounts_ref3); 
														$sms_user = $ref_id3;								
														$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
														$total_price = $slr_ref_per_level3;
														$pm_wallet = $slr_ref_pm;
														$this->notification_model->sms_ref_accounts($sms_user, $tran, $total_price, $pm_wallet );
														
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
						$accounts_ref4 = [
							'user_id'      			=> $ref_id4,          //To the Recieving Partner  
							'account_no'         	=> $ref_account_no,
							'rolename'  			    => $rolename,
							'email'					=> $email,
							'paid_to'         		=> $paid_to,       //From the Money sender user 
							'tranx_id'         		=> $text2,
							'credit'         		=> '0',
							'debit'         		=> $slr_ref_per_level4,
							'amount'         		=> $slr_ref_per_level4,	
							'points_mode'           => $slr_ref_pm,	
							'used'					=> 'no',
							'pay_type'				=> $deduction_paytype, //$invoice_id,		
							'created_at'            => time(),
							'modified_at'           => time()
					];

					$this->db->insert('accounts', $accounts_ref4); 	

					$sms_user = $ref_id4;								
					$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
					$total_price = $slr_ref_per_level4;
					$pm_wallet = $slr_ref_pm;
					$this->notification_model->sms_ref_accounts($sms_user, $tran, $total_price, $pm_wallet );
														
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
										$accounts_ref5 = [
											'user_id'      			=> $ref_id5,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			    => $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $slr_ref_per_level5,
											'amount'         		=> $slr_ref_per_level5,	
											'points_mode'           => $slr_ref_pm,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_ref5); 	
									$sms_user = $ref_id5;								
									$tran = '1'; // "1" if 'Credit' == 0                  -OR-                    "0" if 'debit' == 0								
									$total_price = $slr_ref_per_level5;
									$pm_wallet = $slr_ref_pm;
									$this->notification_model->sms_ref_accounts($sms_user, $tran, $total_price, $pm_wallet );	
									
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
								
								$accounts_clr_ref1 = [
									'user_id'      			=> $ref_id1,          //To the Recieving Partner  
									'account_no'         	=> $ref_account_no,
									'rolename'  			=> $rolename,
									'email'					=> $email,
									'paid_to'         		=> $paid_to,       //From the Money sender user 
									'tranx_id'         		=> $text1,
									'credit'         		=> '0',
									'debit'         		=> $clt_ref_per_level1,
									'amount'         		=> $clt_ref_per_level1,	
									'points_mode'           => $clt_ref_pm,	
									'used'					=> 'no',
									'pay_type'				=> $deduction_paytype, //$invoice_id,		
									'created_at'            => time(),
									'modified_at'           => time()
								];
								
					
								$this->db->insert('accounts', $accounts_clr_ref1);
								
								$sms_user = $ref_id1;								
								$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
								$total_price = $clt_ref_per_level1;
								$pm_wallet = $clt_ref_pm;
								$this->notification_model->sms_ref_accounts($sms_user, $tran, $total_price, $pm_wallet );


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
										$accounts_clr_ref2 = [
											'user_id'      			=> $ref_id2,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $clt_ref_per_level2,
											'amount'         		=> $clt_ref_per_level2,	
											'points_mode'           => $clt_ref_pm,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_clr_ref2); 	
									
									$sms_user = $ref_id2;								
									$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
									$total_price = $clt_ref_per_level2;
									$pm_wallet = $clt_ref_pm;
									$this->notification_model->sms_ref_accounts($sms_user, $tran, $total_price, $pm_wallet );
								
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
													$accounts_clr_ref3 = [
														'user_id'      			=> $ref_id3,          //To the Recieving Part	ner  
														'account_no'         	=> $ref_account_no,
														'rolename'  			=> $rolename,
														'email'					=> $email,
														'paid_to'         		=> $paid_to,       //From the Money sender 	user 
														'tranx_id'         		=> $text2,
														'credit'         		=>	 '0',
														'debit'         		=> $clt_ref_per_level3,
														'amount'         		=> $clt_ref_per_level3,	
														'points_mode'           => $clt_ref_pm,	
														'used'					=> 	'no',
														'pay_type'				=> $deduction_paytype, //$invoice_	id,		
														'created_at'            => time(),
														'modified_at'           => time()
													];

														$this->db->insert('accounts', $accounts_clr_ref3); 
														
														$sms_user = $ref_id3;								
														$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
														$total_price = $clt_ref_per_level3;
														$pm_wallet = $clt_ref_pm;
														$this->notification_model->sms_ref_accounts($sms_user, $tran, $total_price, $pm_wallet );

									
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
						$accounts_clr_ref4 = [
							'user_id'      			=> $ref_id4,          //To the Recieving Partner  
							'account_no'         	=> $ref_account_no,
							'rolename'  			    => $rolename,
							'email'					=> $email,
							'paid_to'         		=> $paid_to,       //From the Money sender user 
							'tranx_id'         		=> $text2,
							'credit'         		=> '0',
							'debit'         		=> $clt_ref_per_level4,
							'amount'         		=> $clt_ref_per_level4,	
							'points_mode'           => $clt_ref_pm,	
							'used'					=> 'no',
							'pay_type'				=> $deduction_paytype, //$invoice_id,		
							'created_at'            => time(),
							'modified_at'           => time()
					];

					$this->db->insert('accounts', $accounts_clr_ref4);

					$sms_user = $ref_id3;								
					$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
					$total_price = $clt_ref_per_level3;
					$pm_wallet = $clt_ref_pm;
					$this->notification_model->sms_ref_accounts($sms_user, $tran, $total_price, $pm_wallet );
														
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
										$accounts_clr_ref5 = [
											'user_id'      			=> $ref_id5,          //To the Recieving Partner  
											'account_no'         	=> $ref_account_no,
											'rolename'  			=> $rolename,
											'email'					=> $email,
											'paid_to'         		=> $paid_to,       //From the Money sender user 
											'tranx_id'         		=> $text2,
											'credit'         		=> '0',
											'debit'         		=> $clt_ref_per_level5,
											'amount'         		=> $clt_ref_per_level5,	
											'points_mode'           => $clt_ref_pm,	
											'used'					=> 'no',
											'pay_type'				=> $deduction_paytype, //$invoice_id,		
											'created_at'            => time(),
											'modified_at'           => time()
									];

									$this->db->insert('accounts', $accounts_clr_ref5); 	
									
									$sms_user = $ref_id5;								
									$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
									$total_price = $clt_ref_per_level5;
									$pm_wallet = $clt_ref_pm;
									$this->notification_model->sms_ref_accounts($sms_user, $tran, $total_price, $pm_wallet );
					
					
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
	
	
	
	
	
	
        $seller_info = singleDbTableRow($userID);
		$seller_account_no = $seller_info->account_no;  // $customer_info->referral_code;  
		$seller_benefits = (($total_price * $seller_profit) / '100' ) ; //Percentage value for Seller
		//Seller Loyality
	   $text5 = $seller_rolename.'- commission for Invoice ID-'.$invoice_id;
		
	   $accounts5 = [
            'user_id'      			=> $userID,          //From the Money sender user
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,           // To the Recieving Partner  
            'tranx_id'         		=> $text5,  	  //$pay_type,
			'credit'         		=> '0',
			'debit'         		=> $seller_benefits,
			'amount'         		=> $seller_benefits,	
			'points_mode'           => $profit_pm,	
			'used'					=> 'no',
			'pay_type'				=> $acct_id,         //Debit from Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts5); 
		
		$sms_user = $userID;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
		$total_price = $seller_benefits;
		$pm_wallet = $profit_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );

						
		//Deduction of commission from Ledger Table with Respective Payspecification and passing the
		//same value to the respective Benefitiary
		   $remarks6 = $seller_rolename.'- commission for Invoice ID-'.$invoice_id;
        $data6 = [
            'user_id'         		=> $userID,              //From the Money sender user
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
//----------------------------------------------------------------------------------------------//
//*************************************//Profit to 'Client'
	
	
	
	
	
	
//$deduction_paytype for Deduction
		$ded_payspec1 = "Commission Deducted from Pay Spec No -". $deduction_paytype ;
					
		
		$client_benefits = (($total_price * $client_profit) / '100' ) ; //Percentage value for Client
		
	//	$commission = (($total_price * $commission_per) / '100' ) ;  //Business Commission to Payspec
		
		//$benefits   =  $benefits_per ;
		$tranx_id3 = $client_rolename.'- commission for Invoice ID -'.$invoice_id; 
		
	   $accounts3 = [
            'user_id'      			=> $c_id,          //To the Recieving Partner  
			'account_no'         	=> $c_account_no,
            'rolename'  			=> $client_role,
			'email'					=> $client_email,
			'paid_to'         		=> $userID,       //From the Money sender user 
            'tranx_id'         		=> $tranx_id3,
			'credit'         		=> '0',
			'debit'         		=> $client_benefits,
			'amount'         		=> $client_benefits,	
			'points_mode'           => $profit_pm,	
			'used'					=> 'no',
		    'pay_type'				=> $acct_id,         //Debit from Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts3); 
		$sms_user = $c_id;								
		$tran = '1'; // "1" if 'Credit' == 0 & no amount value      -OR-                    "0" if 'debit' == 0 & no amount value 							
		$total_price = $client_benefits;
		$pm_wallet = $profit_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
		
		
	//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
			$remarks4 = $client_rolename.'- commission for Invoice ID -'.$invoice_id; 
        $data4 = [
            'user_id'         		=> $c_id,             		//To the Recieving Partner  
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

//----------------------------------------------------------------------------------------------//	 
//*****************************/Commission from 'Seller'





        $seller_info = singleDbTableRow($userID);
		$seller_account_no = $seller_info->account_no;  // $customer_info->referral_code;  
		$seller_commission = (($total_price * $seller_deduction) / '100' ) ; //Percentage value for Seller
		
		//Seller Loyality
	   $text9 = 'Commission deduction from -'.$seller_rolename.'-for Invoice ID -'.$invoice_id; 
		
	   $accounts9 = [
            'user_id'      			=> $userID,          //From the Money sender user
			'account_no'         	=> $seller_account_no,
			'email'					=> $seller_email,
            'rolename'  			=> $seller_role,
			'paid_to'         		=> $c_id,           // To the Recieving Partner  
            'tranx_id'         		=> $text9,  	 
			'debit'         		=> '0',
			'credit'         		=> $seller_commission,
			'amount'         		=> $seller_commission,	
			'points_mode'           => $deduction_pm,	
			'used'					=> 'yes',
			'pay_type'				=> $acct_id,		 //Deposit Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts9); 
		$sms_user = $userID;								
		$tran = '0'; // "1" if 'Credit' == 0 & no amount value      -OR-                  *  "0" if 'debit' == 0 & no amount value 							
		$total_price = $seller_commission;
		$pm_wallet = $deduction_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
		
						
		//Deduction of commission from Ledger Table with Respective Payspecification and passing the
	
		  $remarks10 = 'Commission deduction from -'.$seller_rolename.'-for Invoice ID -'.$invoice_id; 
        $data10 = [
            'user_id'         		=> $userID,              //From the Money sender user
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
//----------------------------------------------------------------------------------------------//
//*****************************/Commission from 'Client' 





		$ded_payspec1 = "Benefits Deducted from Pay Spec No -". $acct_id ;
					
		
		$client_commission = (($total_price * $client_deduction) / '100' ) ; //Percentage value for Client
		
		
		$tranx_id7 = 'Commission deduction from -'.$client_rolename.'-for Invoice ID -'.$invoice_id; 
		
	   $accounts7 = [
            'user_id'      			=> $c_id,          //To the Recieving Partner  
			'account_no'         	=> $c_account_no,
            'rolename'  			=> $client_role,
			'email'					=> $client_email,
			'paid_to'         		=> $userID,       //From the Money sender user 
            'tranx_id'         		=> $tranx_id7,
			'debit'         		=> '0',
			'credit'         		=> $client_commission,
			'amount'         		=> $client_commission,	
			'points_mode'           => $deduction_pm,	
			'used'					=> 'yes',
		    'pay_type'				=> $acct_id, //Deposit Pay Specification	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts7); 
		$sms_user = $c_id;								
		$tran = '0'; // "1" if 'Credit' == 0 & no amount value      -OR-                  *  "0" if 'debit' == 0 & no amount value 							
		$total_price = $client_commission;
		$pm_wallet = $deduction_pm;
		$this->notification_model->sms_accounts($sms_user, $tran, $total_price, $pm_wallet );
		
			$remarks8 = 'Commission deduction from -'.$client_rolename.'-for Invoice ID -'.$invoice_id; 	
        $data8 = [
            'user_id'         		=> $c_id,             	 //To the Recieving Partner  
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


/***********************************************************************************************/	
/* Profit Sharing For 5Level of Referrals 													   */
/* 																							   */
/*																							   */
/**********************************************************************************************
				
	
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
            $subject = 'Hi '.user_full_name($customer_info).', your order details @'.date('d-m-Y h:i a');
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($customer_info->email);
            $this->email->cc($adminEmail);
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
/**********************************END OF PAYWALLET ********************************************************/

//Wallet Recive and Transfer with Seller(Current User) and Buyer(Client)

//Anand 

/******************************************************************************************/
public function add_sales(){
		
       $c_id = $this->input->post('customerID');
	   
       $customer_info = singleDbTableRow($c_id);

        //Redirect if user/customer not found..

        if( ! $customer_info)
        {
            //set error message and go back
            setFlashGoBack('errorMsg', 'Client Not Found!');
        }

        //get customer referral Code
        $customer_referral_id = $customer_info->referral_code;
		$rolename 	  		  = $customer_info->rolename; //User type
		
        $customer_id = $customer_info->id;
		$account_no  = $customer_info->account_no;
		$role 		 = $customer_info->role;
		

        //$referral_id = singleDbTableRow($customer_info->referredByCode, 'users', 'referral_code')->id;

        //Get ID From currently logged in User
        $sales_by = $this->session->userdata('logged_user')['user_id'];
	
        $qty 			= $this->input->post('qty');
        $productName 	= $this->input->post('productName');
        $categories 	= $this->input->post('categories');
        $itemCost 		= $this->input->post('price');

        $totalProduct = count($qty);
		$itemPrice =  $itemCost  ;
		
        $invoiceData = [
            'total_product'         => $totalProduct,
			//'total_price'           => $itemPrice,			
            'customer_id'           => $customer_id,
            'customer_referral_id'  => $customer_referral_id,
            'sales_by'              => $sales_by,
            'created_at'            => time(),
            'modified_at'           => time(),
        ];

        $insertInvoice = $this->db->insert('invoice', $invoiceData);

        $invoice_id = $this->db->insert_id();

        // Get Each sales Item and insert to sales_item table

        $HTMLrow = '';

        for($i = 0; $i < $totalProduct; $i++){

            $quantity = $qty[$i];

//            $categoryID = $categories[$i];
           // $product_name = $productName[$i];
		   $categoryID = $categories;
		    $product_name = $productName;
            $price = $itemPrice[$i] * $quantity;
            $total_price[] = $price;


			/*************************************************************************************
			//Anand Adding New details
			Getting sub_acct_id-(Account), Seller Id(Commision%) and Cient ID(Benefits%) from Table:commissions
			By Providing 	$acct_id   = $categoryID;
							$seller_id = $sales_by;
							$client_id = $customer_id; inputs data.		
			
			/*************************************************************************************/
			//$acct_id   = $categoryID;
			$acct_id = $this->input->post('sub_account');
			$seller_info = $this->session->userdata('logged_user');
			$sellerID = $seller_info['user_id']; // 	$sales_by;
			$seller_role = singleDbTableRow($sellerID)->rolename;
			
			$client_id = $customer_id;
			$client_info = singleDbTableRow($client_id, 'users') ;		
						
			$client_role = $client_info->rolename;			
			
			$table_name = "commissions";
			//$where_array = array('sub_acct_id' =>$acct_id, 'from_role' =>$seller_role, 'to_role' =>$client_role, 'identity' =>'Commission');
			$where_array = array('sub_acct_id' => '19', 'from_role' =>'24', 'to_role' =>'22', 'identity' =>'Commission');
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$commission_per = $r->commission;
					$benefits_per = $r->benefits;
					$level1 = $r->level1;
					$level2 = $r->level2;
					$level3 = $r->level3;
					$level4 = $r->level4;
					$level5 = $r->level5;
				}
			}
		
			$commission_per = '0'; //$r->commission;
					$benefits_per = '0'; //$r->benefits;
			/*************************************************************************************/
            $sales_itemData = [
                'category_id'   => $acct_id,
                'product_name'  => $product_name,
                'invoice_id'    => $invoice_id,
                'qty'           => $quantity,
                'item_price'    => $itemPrice[$i],
                'price'         => $price,
				'commission'    => $commission_per, //$commission,				
                'benefits'      => $benefits_per,
                'created_at'    => time(),
                'modified_at'   => time(),
            ];

            $sales_itemInsert = $this->db->insert('sales_item', $sales_itemData);

			
            //HTML For Email
            $HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;">'.$i.'</td>
                        <td style="padding:5px;text-align:center;">'.$product_name.'</td>
                        <td style="padding:5px;text-align:center;">'.$itemPrice[$i].'</td>
                        <td style="padding:5px;text-align:center;">'.$quantity.'</td>
                        <td style="padding:5px;text-align:center;">'.$price.'</td>
                    </tr>';


        }
        //Anand Code starts here Section for Commision & Benefits

		 $total_price = array_sum($total_price);
			
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$sales_role =  $user['role'];		
		$c_account_no = singleDbTableRow($c_id)->account_no;
		$invoice = "Purchase Invoice ID -".$invoice_id;
		
	// Insert data for Accounts-Wallet deduction 'to' This Customer	
	//Passive user
	   $accounts1 = [
            'user_id'      			=> $c_id,        //From This Customer  
			'account_no'         	=> $c_account_no,
            'rolename'  			    => $role,
			'paid_to'         		=> $userID,      //To Sales Person 
            'pay_type'         		=> 'Purchase Transaction',
			'credit'         		=> $total_price,
			'debit'         		=> '0',
			'amount'         		=> $total_price,						
			'tranx_id'				=> $invoice,
			'points_mode'           => 'wallet',
			'used'					=> 'yes',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts1);
		
//Benefits details to Passive User
		//$query = $this->db->get_where('commissions', array('acct_id' => '24','from_role'=>'1', 'to_role'=>'1'));
		$table_name = "commissions";
			$where_array = array('sub_acct_id' =>$acct_id, 'from_role' =>$seller_role, 'to_role' =>$client_role, 'identity' =>'Commission');
			$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
		$benefits_per = $row->benefits;
		$commission_per =$row->commission;
		}
		$ded_payspec1 = "Benefits Deducted from Pay Spec No -". $acct_id ;
		//if ( $categoryID == $country->acc_id )
			
		$benefits = (($total_price * $benefits_per) / '100' ) ;
		$commission = (($total_price * $commission_per) / '100' ) ;
		$pay_type ="Benefits For The Purchase Invoice ID - $invoice_id "; 
		
		
	   $accounts2 = [
            'user_id'      			=> $c_id,        //From This Customer  
			'account_no'         	=> $c_account_no,
            'rolename'  			    => $role,
			'paid_to'         		=> $userID,      //To Sales Person 
            'tranx_id'         		=> $pay_type,
			'credit'         		=> '0',
			'debit'         		=> $benefits,
			'amount'         		=> $benefits,	
			'points_mode'           => 'wallet',
			'used'					=> 'no',
			'pay_type'				=> $ded_payspec1, //$invoice_id,		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts2); 
	//Deduction of Commision Points from pay Specification//	
		$table_name = "commissions";
			$where_array = array('sub_acct_id' =>$acct_id, 'from_role' =>$seller_role, 'to_role' =>$client_role, 'identity' =>'Commission');
			$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
		$benefits_per = $row->benefits;
		$commission_per =$row->commission;
		}
		$ded_payspec1 = "Benefits Deducted from Pay Spec No -". $acct_id ;
		//if ( $categoryID == $country->acc_id )
			
		$benefits = (($total_price * $benefits_per) / '100' ) ;
		$commission = (($total_price * $commission_per) / '100' ) ;
		$remarks2 = "Commission For Purchase of Invoice ID $invoice_id";
				
		//set all data for inserting into database From Pay Sub Accounts Type to Ledger
        $data5 = [
            'user_id'         		=> $c_id, 
			'pay_type'				=> $acct_id,
            'debit'         		=> '0',
			'credit'         		=> $commission, 	
			'amount'         		=> $commission, 
            'invoice_id '  			=> $invoice_id,			
			'remarks'         		=> $remarks2,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data5);
	   
	   //Deduction of beneifits Points from pay Specification//
	   		/*$res2 =  $this->db->get_where('ledger', [ 'pay_type' => $acct_id ]);		
		foreach($res2->result() as $ledger);
		$amount = $ledger->amount; */
		$remarks1 = "Benefits For Purchase of Invoice ID $invoice_id";
				
		//set all data for inserting into database From Pay Sub Accounts Type to Ledger
        $data1 = [
            'user_id'         		=> $c_id, 
			'pay_type'				=> $acct_id,
            'debit'         		=> '0',
			'credit'         		=> $benefits, 	
			'amount'         		=> $benefits, 
            'invoice_id '  			=> $invoice_id,			
			'remarks'         		=> $remarks1,
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data1);
		
//**********************
        // Insert data for Accounts-Wallet Paid back 'from' Customer to sales person
		 //get Seller Account no */

        $seller_info = singleDbTableRow($userID);
		$seller_account_no = $seller_info->account_no;  // $customer_info->referral_code;  
		$tranx_id1 = 'Purchase for Invoice ID - '. $invoice_id; 
		$pay_type1 = 'Pay Specification No - '.$acct_id;
	//current system access user

        $accounts3 = [
            'user_id'      			=> $userID,         //From Sales Person 
			'account_no'         	=> $seller_account_no,
            'rolename'  			    => $sales_role,		
			'paid_to'         		=> $c_id,			//To This Customer 
            'pay_type'         		=> $pay_type1, //Products Sold to customer and return back the points as currency transaction 
			'credit'         		=> '0',
			'debit'         		=> $total_price,
			'amount'         		=> $total_price,						
			'tranx_id'				=> $tranx_id1,	
			'points_mode'           => 'wallet',		
			'used'					=> 'no',
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts3);
		
	/* /Commision details only to Active User */
		$pay_type2 = 'Commision for Invoice ID - '. $invoice_id; 
		$ded_payspec2 = 'Commission Deducted from Pay Spec No -'. $acct_id ;
		
        $accounts4 = [
            'user_id'      			=> $userID,         //From Sales Person 
			'account_no'         	=> $seller_account_no,
            'rolename'  			    => $sales_role,		
			'paid_to'         		=> $c_id,			//To This Customer 
            'tranx_id'	         	=> $pay_type2, //Products Sold to customer and return back the points as currency transaction 
			'credit'         		=> '0',
			'debit'         		=> $commission,
			'amount'         		=> $commission,	
			'points_mode'           => 'wallet',		
			'used'					=> 'no',
			'pay_type'		 		=> $ded_payspec2, //'$invoice_id,		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $this->db->insert('accounts', $accounts4); 

/***********************************************************************************************/	
/* Profit Sharing For 5Level of Referrals 													   */
/* Profit Sharing For Referrals 															   */
/* Profit Sharing For Referrals 															   */
/***********************************************************************************************/
/*				
		$user = loggedInUserData();
		$userID = $user['user_id'];
		$sales_role =  $user['role'];		
		$c_account_no = singleDbTableRow($c_id)->account_no;
	        //get customer referral Code
        $customer_referral_id = $customer_info->referral_code;
		
		$referredByCode1 = singleDbTableRow($customer_referral_id)->referredByCode;
		$c1_account_no = singleDbTableRow($referredByCode1)->account_no;
		
		$referredByCode2 = singleDbTableRow($customer_referral_id)->referredByCode1;
		$referredByCode3 = singleDbTableRow($customer_referral_id)->referredByCode2;
		$referredByCode4 = singleDbTableRow($customer_referral_id)->referredByCode3;
		$referredByCode5 = singleDbTableRow($customer_referral_id)->referredByCode4;
		
		$pay_level1 = (($total_price * $level1) / '100' );
		$pay_level2 = (($total_price * $level2) / '100' );
		$pay_level3 = (($total_price * $level3) / '100' );
		$pay_level4 = (($total_price * $level4) / '100' );
		$pay_level5 = (($total_price * $level5) / '100' );
		$pay_type2 = 'Commision for Invoice ID - '. $invoice_id; 
		$ded_payspec2 = 'Commission Deducted from Pay Spec No -'. $acct_id ;
		
				
		//$no_levels = 5;
		//for ($x = 1; $x <= $no_levels; $x++) {
		//	{		
			$accounts5 = [
				'user_id'      			=> $referredByCode1,         //From Sales Person 
				'account_no'         	=> $c1_account_no,
				'rolename'  			    => $sales_role,		
				'paid_to'         		=> $c_id,			//To This Customer 
				'tranx_id'	         	=> $pay_type2, //Products Sold to customer and return back the points as currency transaction 
				'credit'         		=> '0',
				'debit'         		=> $commission,
				'amount'         		=> $commission,	
				'points_mode'           => 'wallet',		
				'used'					=> 'no',
				'pay_type'		 		=> 'Profit Model test',		
				'created_at'            => time(),
				'modified_at'           => time()
			];

			$this->db->insert('accounts', $accounts5); 
		//						}//End of Level Profit Update Settings
		
		
/***********************************************************************************************/
		
		
		//set all data for inserting into database From Pay Sub Accounts Type to Ledger
        $data2 = [
            'user_id'         		=> $userID, 
			'pay_type'				=> $acct_id,       
            'debit'         		=> '0',			
 			'credit'         		=> $commission, 	          
			'amount'         		=> $commission, 
			'invoice_id '  			=> $invoice_id,
			'remarks'         		=> 'Commision For Sales',	
			'start_date'         	=> time(),		
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data2);

          
		
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
            $subject = 'Hi '.user_full_name($customer_info).', your order details @'.date('d-m-Y h:i a');
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($customer_info->email);
            $this->email->cc($adminEmail);
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

	
	/**
     * Recharge Schemes
     * 
     */


    public function recharge_mobile(){ 
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$email = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		$account_no    = singleDbTableRow($user_id)->account_no;
		$to_role  	   = singleDbTableRow($user_id)->rolename;
		$acct_id       = '43';
		$sub_acct_id   = '13';
		$amount   	   = $this->input->post('amount');
		$recharge_type = $this->input->post('recharge_type');			
        $recharge_no   = $this->input->post('recharge_no');
		
		$pay_type = 'Charges for the '.$recharge_type.' type, No: '.$recharge_no.'';
	
$myorderid = substr(number_format(time() * rand(),0,'',''),0,15);
$opt = $this->input->post('operator');
$mobile = $recharge_no;
$amount = $amount;


	//RUN  API
$ch = curl_init();
$timeout = 300; // set to zero for no timeout
$myurl = "http://joloapi.com/api/recharge.php?mode=0&userid=USERID&key=APIKEY&operator=$opt&service=$mobile&amount=$amount&orderid=$myorderid";
curl_setopt ($ch, CURLOPT_URL, $myurl);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$file_contents = curl_exec($ch);
$curl_error = curl_errno($ch);
curl_close($ch);


echo"Output of API:<br/>";

echo"$file_contents";

$pay_type = $file_contents;



		//Accounts Database update
			   $data2 = [
					'user_id'         		=> $user_id, 
					'account_no'         	=> $account_no,
					'rolename'  			    => '11', //$to_role,
					'pay_type'         		=> $pay_type,
					'credit'         		=> $amount,
					'debit'         		=> '0',
					'amount'         		=> $amount,
					'points_mode' 			=> 'wallet',
					'used'					=> 'yes',
					'tranx_id'				=> $pay_type, //'test Invoice Id 332211', //$tranx_id, 
					'created_at'            => time(),
					'modified_at'           => time()
				];

			   $query2 = $this->db->insert('accounts', $data2);			
			
			
        //set all data for inserting into database
        $data = [
			'recharge_type'		    => $recharge_type,			
            'recharge_no'   		=> $recharge_no,         
			'recharge_date'       	=> '31-12-1999',
			'amount'    			=> $amount, 
			'user_id'   			=> $user_id,
			'account_no'	   		=> $account_no,
			'acct_id'   			=> $acct_id,
			'sub_acct_id'	   		=> $sub_acct_id,
			'to_role'   			=> '11', //$to_role,
            'created_by'            => $user_id,
            'created_at'            => time(),
			'email'           		=> $email, //$user_id,
            'modified_at'           => time()
        ];
		 
        $query = $this->db->insert('recharge', $data);

        if($query)
        {
            create_activity('Created'.$data['remarks'].'recharge'); 
//create an activity
            return true;
        }
        return false;	
	}
	
/*************************************************
     * All Services-Prepaid, PostPaid, Insurance
     * 
     ************************************************/


    public function services_prepaid(){ 
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$email = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		$account_no    = singleDbTableRow($user_id)->account_no;
		$to_role       = singleDbTableRow($user_id)->rolename;
		$acct_id       = '2';
		$sub_acct_id   = '4';
		$amount        = $this->input->post('amount');
		$recharge_type = $this->input->post('recharge_type');			
                $recharge_no   = $this->input->post('recharge_no');
		
		$pay_type = 'Charges for the '.$recharge_type.' type, No: '.$recharge_no.'';
	
$myorderid = substr(number_format(time() * rand(),0,'',''),0,15);
$operator = $this->input->post('operator');
$number= $recharge_no;
$amount = $amount;
$country = '91';
$usertxn = 'test tranx123';
$format = 'xml';
$key = '4538a2ca74a911e6bfda04014a243c01';

	//RUN  API
$ch = curl_init();
$timeout = 300; // set to zero for no timeout
//$myurl = "http://joloapi.com/api/recharge.php?mode=0&userid=USERID&key=APIKEY&operator=$opt&service=$mobile&amount=$amount&orderid=$myorderid";
/*
API: 4538a2ca74a911e6bfda04014a243c01
Server IP: 199.79.62.9
Reverse API Domain: http://myfairservice.com/recharge




$myurl = "https://request.apihit.com/v2/recharge?key=4538a2ca74a911e6bfda04014a243c01&operator=$opt&amount=$amount&number=$mobile&usertxn=1&format=json";
*/

$url='https://request.apihit.com/v2/recharge&key='.$key.'&operator='.$operator.'&amount='.$amount.'&country='.$country.'&number='.$number.'&usertxn='.$usertxn.'&format='.$format;

die($url);

//create a new cURL resource handle
$ch = curl_init();
// setting cURL options
curl_setopt_array(
$ch, array(
CURLOPT_URL => $url, // Set URL to request API Hit
CURLOPT_HEADER => false, // Include header in result?
CURLOPT_RETURNTRANSFER => true, // Should cURL return or print out thedata? (true = return, false = print)
CURLOPT_TIMEOUT => 100, // Timeout in seconds
CURLOPT_FAILONERROR => true, // generate cURL error on HTTP fail
CURLOPT_AUTOREFERER => true,
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_FOLLOWLOCATION => 1,
CURLOPT_VERBOSE => 1,
CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64)AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17',));
// requesting the API Hit API
$api_responce = curl_exec($ch);
// if some error occured
if(curl_error($ch)){
echo 'error:' . curl_error($ch);
die();
}
// closing cURL resource
curl_close($ch);
// in case of JSON responce ONLY
$json_responce = json_decode($api_responce);
// if request status is failed
if(strcasecmp($json_responce->status, 'failed') == 0)
{
	$responce['status'] = $json_responce->status;
	$responce['error_code'] = $json_responce->error_code;
	$responce['message'] = $json_responce->message;
}else{
	$responce['status'] = $json_responce->status;
	$responce['error_code'] = $json_responce->error_code;
	$responce['txnid'] = $json_responce->txnid;
	// if usertnx is present
	if($json_responce->usertnx){
	$responce['usertnx'] = $json_responce->usertnx;
	}
		$responce['operator_ref'] = $json_responce->operator_ref;
		$responce['operator'] = $json_responce->operator;
		/*
		'country' parameter in response is missing; */
		$response['country'] = $json_response->country;
		
		$responce['number'] = $json_responce->number;
		$responce['amount'] = $json_responce->amount;
		$responce['amount_deducted'] = $json_responce->amount_deducted;
		$responce['message'] = $json_responce->message;
		$responce['time'] = $json_responce->time;
	}
return $responce;

$pay_type = $responce->message;


/*
		//Accounts Database update
			   $data2 = [
					'user_id'         		=> $user_id, 
					'account_no'         	=> $account_no,
					'role '  				=> $to_role,
					'pay_type'         		=> $pay_type,
					'credit'         		=> $amount,
					'debit'         		=> '0',
					'amount'         		=> $amount,
					'points_mode' 			=> 'wallet',
					'used'					=> 'yes',
					'tranx_id'				=> $pay_type, //'test Invoice Id 332211', //$tranx_id, 
					'created_at'            => time(),
					'modified_at'           => time()
				];

			   $query2 = $this->db->insert('accounts', $data2);			
			
	*/		
        //set all data for inserting into database
        $data = [
			'recharge_type'		    => $recharge_type,			
            'recharge_no'   		=> $recharge_no,         
			'recharge_date'       	=> '31-12-1999',
			'amount'    			=> $amount, 
			'user_id'   			=> $user_id,
			'account_no'	   		=> $account_no,
			'acct_id'   			=> $acct_id,
			'sub_acct_id'	   		=> $sub_acct_id,
			'to_role'   			=> $to_role,
            'created_by'            => $user_id,
            'created_at'            => time(),
			'email'           		=> $email, //$user_id,
            'modified_at'           => time()
        ];
		 
        $query = $this->db->insert('recharge', $data);

        if($query)
        {
            create_activity('Created'.$data['remarks'].'recharge'); //create an activity
            return true;
        }
        return false;	
	}
	
	
	
	public function sms_pay_wallet( $key_id, $otp, $mobile, $fname)
	{	
	
			include 'sendsms.php';		
			$message=" Your OTP ".$otp." for the transaction with '".$fname."' sms reference Id is '".$key_id."'.  'Team Consumer1st'.";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');		
	}

		public function sms_accounts($user_id, $debit, $credit )
	{		
	
	
			if ($debit != '0')
			{
				$text = 'debited '.$debit;
			}else
			{
				$text = 'credited '.$credit;
			}
			
			$bal = '4500.00';
			$mobile = singleDbTableRow($user_id)->contactno;
			
			include 'sendsms.php';		
			$message=" Dear ".$user_id." Amount '".$text."'Total Bal:'.$bal  'Team Consumer1st'.";
			$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
			$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');		
	}

/****************************************************************************************************************
			* OTP for Generating Payment for Transfer/Recieve
			
*****************************************************************************************************************/

    public function otp_transactions(){
		
        $user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code   = singleDbTableRow($user_user_id)->referral_code;	
		
		$user_rolename	     = singleDbTableRow($user_user_id)->rolename;	
		$acct_email	    	 = singleDbTableRow($user_user_id)->email;			
		$user_mobile         = singleDbTableRow($user_user_id)->contactno;
		$user_fname          = singleDbTableRow($user_user_id)->first_name;
		$user_account_no     = singleDbTableRow($user_user_id)->account_no; 
		
		$tran_type = $this->input->post('transaction_type');	
	
		
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
	//   $otp  = random_string('numeric', 4);  //4 digits Unique OTP_code
		$otp  = $this->product_model->generatePIN();				   //4 digits Unique OTP_code
		
        //check unique OTP_code
/*
        $getOTP = $this->db->get_where('otp_transactions', ['otp'=> $otp]);
        if($getOTP -> num_rows() > 0)
        {
            for($i= 0; $getOTP->num_rows() > 0; $i++)
			{
			$otp  = strtoupper(random_string());              
			//  $otp  = strtoupper(increment());
                $getOTP = $this->db->get_where('otp_transactions', ['otp'=> $otp]);
            }
        } */
		
		$payee_referredCode = $this->input->post('referredByCode');

	if( $tran_type == 'Transfer' )  			//Recieve
	{
	$payby_consumer_id 	= $user_referral_code;  //Payer's Account			
	$payto_consumer_id 	= $this->input->post('referredByCode');
	$payby_rolename = $user_rolename;	
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payto_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payto_rolename		 = $r->rolename;	
			}
		}

	}else{
	$payby_consumer_id 	= $this->input->post('referredByCode');	 //Payer's Account	
	$payto_consumer_id 	= $user_referral_code;   	
	$payto_rolename = $user_rolename;
	
		$table_name = "users";			
		$where_array = array('referral_code' => $payby_consumer_id); 		
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{
				$payby_rolename		 = $r->rolename;	
			}
		}
	
}		
	
		
		
//*****************      //Payee's Consumer details    ***********************///		
		
		$table_name = "users";			
			$where_array = array('referral_code' => $payee_referredCode); 
		//	$where_array = array('referral_code' => $payto_userid); 
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$payee_user_id 		 = $r->id;
					$payee_rolename		 = $r->rolename;
					$payee_email		 = $r->email;
					$payee_first_name    = $r->first_name.' '.$r->last_name;
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
				$fname       = $payee_first_name;
				$pay_by		 = $payee_pay_by;
				$account_no  = $payee_account_no ; 

/******Automatically Payspecification will be Identified by two users **************/	

		$table_name = "commissions";
		$where_array = array('from_role' =>$payby_rolename, 'to_role' =>$payto_rolename, 'identity' =>'Commission');
		$query = $this->db->where($where_array )->get($table_name); 
		foreach ($query->result() as $row)
		{
			
			
		$pay_type 			= $row->sub_acct_id;					//Ledger Deposit pay spec		
		$deduction_paytype	= $row->ded_paytype;		    //Ledger Deduction pay spec	
		$pay_from 			= $row->from_role;
		$pay_to 			= $row->to_role;
		
		}
if ( $pay_from 	== 12 and $pay_to == 12)	
		  {
            //set error message and go back
            setFlashGoBack('errorMsg', 'No Permissions for Between Consumers Transactions...!');
        }


	  if( $pay_type == null )
        {
            //set error message and go back
            setFlashGoBack('errorMsg', 'Transaction Permission Is Not Available With The Specified User...!');
        }
		if (($count == null)) 
					{ $count = '0';}
		$key_id = $count;
		//OTP transaction Table
        $data1 = [
			'otp'					=> $otp,
			'key_id'				=> $key_id,
			'rolename'		        => $user_rolename,
		//  'sponsor_role'          => $this->input->post('sponsor_role'),
			'referredByCode'		=> $user_referral_code,
			'referral_code'			=> $payee_referredCode,
			'type'					=> 'pay_wallet',
			'transaction_type'		=> $this->input->post('transaction_type') ,			
        //  'company_name'			=> $company_name,
			'account_no'         	=> $user_account_no,
			'pay_by'				=> $payby_consumer_id,  //Payer's Account
			'payby_rolename'		=> $payby_rolename,
			'pay_to'				=> $payee_referredCode,  //Third party id
			'payto_rolename'		=> $payto_rolename,
		//	'commission'       		=> $commission,            
			'fname'         		=> $fname,			
			'amount'         		=> $this->input->post('amount'),
			'points_mode' 			=> 'wallet',			
		//	'licence'				=> $company_licence,
			'from_cell'             => $user_mobile,
			'sms_no'				=> $sms_no,
			'to_cell'				=> $sms_no,
			'used'					=> 'yes',			
			'pay_type'         		=> $pay_type,
			'ded_paytype'         	=> $deduction_paytype,
			'tranx_id'				=> $this->input->post('tranx_id'),	
            'created_at'            => time(), 
            'modified_at'           => time()
        ];
	
		
       $query1 = $this->db->insert('otp_transactions', $data1);
   
        
        if($query)
        {
           
            return true;
        }
        return false;

		}				
	}
		
   
}
/**
     * @return completed Payments List
     */

    public function completed_PaymentListCount(){
		$user = loggedInUserData();
	    $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       if ($role == 'admin')
       { 			
			$query = $this->db->where( 'type' , 'pay_wallet')->count_all_results('otp_transactions');  //OTP type is Pay wallet related
	   }
	   else {
			$query = $this->db->where('referredByCode', $referral_code )->count_all_results('otp_transactions');	 
		}

        return $query;
    }

    public function completed_PaymentList($limit = 0, $start = 0){
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       // $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'agent']);
				if ($role == 'admin')
			   { 					
						$table_name = "otp_transactions";
						$where_array = array('active' => '1', 'type' => 'pay_wallet');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name);						
			   }else {
					
						$table_name = "otp_transactions";						
						$where_array = array('referredByCode'=>$referral_code, 'active' => '1', 'type' => 'pay_wallet');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);						
			}
			return $query;
	}	
	
	
/**
     * @return Referral Payments List
     */

    public function payee_PaymentListCount(){
		$user = loggedInUserData();
	    $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       if ($role == 'admin')
       { 			
			$query = $this->db->where( 'type' , 'pay_wallet')->count_all_results('otp_transactions');  //OTP type is Pay wallet related
	   }
	   else {
			$query = $this->db->where('referredByCode', $referral_code )->count_all_results('otp_transactions');	 
		}

        return $query;
    }

    public function payee_PaymentList($limit = 0, $start = 0){
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
       // $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'agent']);
				if ($role == 'admin')
			   { 					
						$table_name = "otp_transactions";
						$where_array = array('active' => '0', 'type' => 'pay_wallet');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name);						
			   }else {
					
						$table_name = "otp_transactions";						
						$where_array = array('referredByCode'=>$referral_code, 'active' => '0', 'type' => 'pay_wallet');
						$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);						
			}
			return $query;
	}	
//OTP Recall
	public function otp_recall($limit = 0, $start = 0){
		$user = loggedInUserData();
        $userID = $user['user_id'];
		$referral_code = singleDbTableRow($userID)->referral_code;
		$role = singleDbTableRow($userID)->role;
		
      
			$table_name = "otp_transactions";						
			$where_array = array('referral_code'=>$referral_code);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name);						

			return $query;
	}
			
  /**
  Running
     * Transfer or Recieve payment from OTP Table
     */

    public function add_payee($id){
	$table_name = "otp_transactions";			
		$where_array = array('id' => $id);
		$query = $this->db->where($where_array )->get($table_name); 
		if($query -> num_rows() > 0) 
		{	
			foreach ($query->result() as $r)
			{		  
																	
					$key_id_old	  	  =  $r->key_id;
					$otp_old	 	  =  $r->otp;
					$company_role 	  =  $r->sponsor_role;
					$transaction_type =  $r->transaction_type;
					
					$key_id_new	= $this->input->post('key_id');
					$otp_new	= $this->input->post('otp');
					
			}
		}
	if 	( $otp_new == $otp_old ) 
	{
        $this->load->helper('string'); //load string helper

        $row_password   = $this->input->post('password');
        $password       = sha1($row_password);
        $referral_code  = random_string('numeric',10);  //10 digits Unique referral_code
	//	$account_no     = random_string('numeric',20);	//20 digits Account number	

        //check unique $referral_code

        $getReferral = $this->db->get_where('users', ['referral_code'=> $referral_code]);
        if($getReferral -> num_rows() > 0)
        {
            for($i= 0; $getReferral -> num_rows() > 0; $i++){
                $referral_code  = strtoupper(random_string());
                $getReferral = $this->db->get_where('users', ['referral_code'=> $referral_code]);
            }
        }
		//check unique $account_no

     /*   $getAccount_no = $this->db->get_where('users', ['account_no'=> $account_no]);
        if($getAccount_no -> num_rows() > 0)
        {
            for($i= 0; $getAccount_no -> num_rows() > 0; $i++){
                $account_no  = strtoupper(random_string());
                $getAccount_no = $this->db->get_where('users', ['account_no'=> $account_no]);
            }
        } */

//Referral Users data Input Fields		
		$user_info 			= $this->session->userdata('logged_user');
        $creater_id 		= $user_info['user_id'];
		
		$referrerCode 		= $this->input->post('consumerCode');
		$agentCode			= $this->input->post('agentCode');
		$company_name 		= $this->input->post('company_name');
		$company_licence	= $this->input->post('licence');	
		$amount 	  		= $this->input->post('amount');			//Deduction Amount
		$company_phone 		= $this->input->post('contactno');	    //Phone	
		$company_email 		= $this->input->post('email');		    //New Login ID
//Referral/Sponsorer Consumer Data	
	$table_name = "users";			
			$where_array = array('referral_code' => $referrerCode);
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{	
					$referrer_id		    = $r->id;
					$referrer_first_name    = $r->first_name;
					$referrer_last_name     = $r->last_name;             
				    $referrer_email         = $r->email;
					$referrer_dob			= $r->date_of_birth;
					$referrer_adhaar_no     = $r->adhaar_no;
					$referrer_rolename      = $r->rolename;
				    $referrer_country       = $r->country;
				    $referrer_country_id    = $r->country_id;	
					$referrer_account_no    = $r->account_no;					
				}	
			}		
					
//New Agents Consumer Data	
	$table_name = "users";			
			$where_array = array('referral_code' => $agentCode);
			$query = $this->db->where($where_array )->get($table_name); 
			if($query -> num_rows() > 0) 
			{	
				foreach ($query->result() as $r)
				{
					$agent_first_name    = $r->first_name;
					$agent_last_name     = $r->last_name;             
				    $agent_gender        = $r->gender;
					$agent_dob			 = $r->date_of_birth;
					$agent_adhaar_no     = $r->adhaar_no;
					$agent_account_no    = $r->account_no;
					$agent_city_id       = $r->city_id;
				    $agent_country       = $r->country;
				    $agent_country_id    = $r->country_id;		
					$agent_postal_code   = $r->postal_code;						
					$agent_photoName     = $r->photo;
				}
			}
			$account_no =  $agent_country_id.$agent_postal_code.$company_role.$referral_code;			
						 //set all data for inserting into User database as Agent Role
						 
							$data = [
								'first_name'        => $agent_first_name,
								'last_name'         => $agent_last_name,
								'password'          => $password,
								'row_pass'          => $row_password,
								'email'             => $company_email,
								'contactno'         => $company_phone,
								'gender'            => $agent_gender,
								'company_name'		=> $company_name,
								'licence'	        => $company_licence,
								'date_of_birth'     => $agent_dob,
								'adhaar_no'         => $agent_adhaar_no,
								'city_id'           => $agent_city_id,
								'country'           => $agent_country,
								'country_id'        => $agent_country_id,
								'postal_code'		=> $agent_postal_code,
								'role'              => 'agent', 
								'rolename'          => $company_role,
								'active'            => 1,
								'referral_code'     => $referral_code,   //New Agent Referral Code
								'account_no'        => $account_no,		 //New Agent Account No	
								'referredByCode'    => $referrerCode,
								'photo'             => $agent_photoName,
								'created_by'        => $creater_id,
								'created_at'        => time(),
								'modified_at'       => time()
							];

						   $query = $this->db->insert('users', $data);
	   

		
	
	//get OTP Data
	
	$otp_data = $this->db->get_where('otp_transactions', ['id' => $id]);
		foreach($otp_data->result() as $otp);
		
		{
			
			$commission 		= $otp->commission;		//Commission Value
			$amount				= $otp->amount;
			$account_no 		= $otp->account_no;
			$pay_by				= $otp->pay_by;
			$paytype_commission = $otp->ded_paytype;	 //For Commssion
			$paytype_collection = $otp->pay_type;       //Collect Fees
			$tran_count			= $otp->key_id;       //Collect Fees
		}
		
		
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
// Sponsorship Fees Deduction-----------------------------------
	$tranx_id1 = 'One time Sponsorship Charges Deduction';

//Get Individual Account transactions Id
// 	'tran_count' 			=> $tran_count,		
$acct_user = $pay_by_userID;		
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 			
{	foreach ($result_count->result() as $r)
	{
		$value = $r->tran_count;    
		$tran_count = $value + 1;
	}					
}
//End of Individual Account transactions Id
   

        $accounts1 = [
			'user_id'         		=> $pay_by_userID, 
			'account_no'         	=> $pay_by_account_no,
            'rolename'  			=> $pay_by_rolename,
			'email'					=> $pay_by_email,
			'debit'         		=> '0',            
			'credit'         		=> $amount	,			
			'amount'         		=> $amount	,	
			'points_mode' 			=> 'wallet',
			'tran_count' 			=> $tran_count,
			'used'					=> 'yes',
			'paid_to'				=> '00',
			'pay_type'         		=> $paytype_collection,  
			'tranx_id'				=> $tranx_id1,				
            'created_at'            => time(), 
            'modified_at'           => time()
        ];
       $query1 = $this->db->insert('accounts', $accounts1);
//Ledger Update Charges Collection
  
	    $today = date("Y/m/d");
		
	
        //set all data for inserting into database
        $ledger1 = [
            'user_id'         		=> $pay_by_userID,
            'invoice_id '  			=> 'Sponsorship',
			'account_no'         	=> $pay_by_account_no,
            'rolename'  			=> $pay_by_rolename,
			'email'					=> $pay_by_email,
            'credit'         		=> '0',
			'debit'         		=> $amount,
			'amount'         		=> $amount,	
			'points_mode' 			=> 'wallet',
            'count'         		=> 'yes',						
            'start_date'         	=> $today,					
			'pay_type'				=> $paytype_collection,
			'remarks'         		=> $tranx_id1,	
			'challan'				=> 'no_invoice.jpg',			
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query4 = $this->db->insert('ledger', $ledger1);	
//--------------------------------------------------------------

// Commission to Referrer    -----------------------------------
	$tranx_id2 = 'Sponsorship Commission';

//Get Individual Account transactions Id
// 	'tran_count' 			=> $tran_count,		
$acct_user = $referrer_id;		
$result_count  	= $this->product_model->get_tran_count($acct_user);		
if($result_count -> num_rows() > 0) 			
{	foreach ($result_count->result() as $r)
	{
		$value = $r->tran_count;    
		$tran_count = $value + 1;
	}					
}
//End of Individual Account transactions Id

        $accounts2 = [
			'user_id'         		=> $referrer_id, 
			'account_no'         	=> $referrer_account_no,
            'rolename'  			=> $referrer_rolename,
			'email'					=> $referrer_email,
			'debit'         		=> $commission,
			'credit'         		=> '0',            		
			'amount'         		=> $commission,	
			'points_mode' 			=> 'wallet',
			'tran_count' 			=> $tran_count,	
			'used'					=> 'no',
			'paid_to'				=> '00',
			'pay_type'         		=> $paytype_commission,  
			'tranx_id'				=> $tranx_id2,	
            'created_at'            => time(), 
            'modified_at'           => time()
        ];
       $query1 = $this->db->insert('accounts', $accounts2);
//Ledger Update Charges Collection
  
	    $today = date("Y/m/d");
		$remarks2 = 'Sponsorship Commission to Consumer';
	
        //set all data for inserting into database
        $ledger2 = [
            'user_id'         		=> $referrer_id,
            'invoice_id '  			=> 'Sponsorship Commission',
			'email'					=> $referrer_email,
			'account_no'         	=> $referrer_account_no,
            'rolename'  			=> $referrer_rolename,
            'credit'         		=> $commission,
			'debit'         		=> '0',
			'amount'         		=> $commission,	
			'points_mode' 			=> 'wallet',
            'count'         		=> 'yes',						
            'start_date'         	=> $today,					
			'pay_type'				=> $paytype_commission,
			'remarks'         		=> $remarks2,	
			'challan'				=> 'no_invoice.jpg',			
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query4 = $this->db->insert('ledger', $ledger2);	
//----------------------------------------------------------------  
      $data3 = [
           	'active'            => '1',            
            'modified_at'       => time()
        ];

       $query3 = $this->db->where('id', $id)->update('otp_transactions', $data3);

        if($query4)
        {
           

            $email_data = [
                'email'  => $email,
                'password'  => $row_password,
            ];

            //send email to new user
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

            return true;
        }
        return false;

						
	}
				
	}		
 

	


/******************************************************************************************/
//Running CPA
//VPA Transfers     Payment     to     any      Partners
// 1st December 2016 -- Active Transaction --
//Anand 

/******************************************************************************************/
public function payee_transfer($id){
	
	$otp_data = $this->db->get_where('otp_transactions', ['id' => $id]);
		foreach($otp_data->result() as $otp);
		
		{
			
			$paying_to  		= $otp->pay_to;		//Paying To Consumer ID
			$amount	    		= $otp->amount;		//Paying Amount	
			$paid_by			= $otp->pay_by;		//Paying By Consumer ID			
			$pay_type   		= $otp->pay_type;   //Pay Specification
			$tranx_id   		= $otp->tranx_id;
			$table_otp	   		= $otp->otp;
			$transaction_type 	= $otp->transaction_type;
			$active				= $otp->active;
			
		$user_otp = $this->input->post('otp');
//Very Important changing parties for send/receive based on Radio button selection		
		if ($transaction_type == 'Transfer')
		{	//for transfer payment.
			$pay_by = $paid_by;
			$pay_to = $paying_to;
		}else
		{	//for recive payment.
			$pay_by = $paying_to;
			$pay_to = $paid_by;
		}
		
//Checking OTP Authentication for the Transactions		
	if ($table_otp	== 	$user_otp and $active == '0')
	{
	
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
		
		$wallet_balance = $this->input->post('wallet_balance');
		
	
//Benefits details To the Recieving Partner for data retrival 

       // S E N D E R
//pay_by_userID is Seller/Current User who is sending money
		$pm_wallet = 'wallet';
		
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
		$tranx_id1 = 'Paid by '.$seller_rolename	.'-'.$first_name1.' for the Invoice ID-'.$invoice_id;




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
	
	if ($currentUser = 'admin' )	//Except Agent and Customer, recording rest of the transactions to Ledger
	{   
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
		
	}	
		
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

//Process for Voucher creation
if ($pay_type == '66')
{
	
	$voucher  	= $this->vouchers_model->get_voucher($user_id, $total_price, $pay_type);		
}	

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

       $query9 = $this->db->where('id', $id)->update('otp_transactions', $data9);	
	   
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
		
		if($seller_role != '14')
		{
				 if ($client_role == '13' or $client_role == '41' && $agreed_per > 0 )
				 {
					 $client_deduction = $agreed_per;
				 }else{
					 $client_deduction = $row->receiver_deduction;
				 }
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

}else{

            //set error message and go back
            setFlashGoBack('errorMsg', 'This Transaction Is Already Processed...!!!');
       
}
}}
/**********************************END OF PAYWALLET ********************************************************/

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

//Get Balance
	public function get_balance($acct_user, $pm_wallet, $operator, $value){
       
	  
		$userID = $acct_user;	
		$user_amount = '0';	
		$points_mode 	= $pm_wallet;
		
		
		$user_debit  	= $this->product_model->total_debit($userID, $points_mode);
		
			/*	if($user_debit-> num_rows() > 0) 
				{
					foreach ($user_debit->result() as $r1) 
					{
						$deducter_debit			= $r1->debit;
						
                    }
                     
				}
			
*/
				
				
		$user_credit  	= $this->product_model->total_credit($userID, $points_mode);
			/*	if($user_credit-> num_rows() > 0) 
				{
					foreach ($user_credit->result() as $r2) 
					{
						$deducter_credit			= $r2->credit;
					}
				}
			*/	
		
		$user_balance 	= '0'; //( $user_debit  - $user_credit );
		
		if ($operator == 'debit')
		{
			$user_amount 	= $user_balance + $value;
		}else{
			$user_amount 	= $user_balance - $value;	
		}
		
			return $user_amount;
		
    }

 /*	public function total_debit($userID, $points_mode){
       
			

		$table_name = "accounts";		
		$where_array = array('points_mode'=>$points_mode, 'account_no' =>$account_no);
	//	$query1 = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
	//	return $query1;
	//	return $query1->result();
			
		$data['user_debit']  	= $this->product_model->total_user_debit($userID, $points_mode);
		$data['user_credit']  	= $this->product_model->total_user_credit($userID, $points_mode);
		foreach( $user_debit->result() 		as $user_debit);
		foreach( $user_credit->result() 		as $user_credit);
		$user_debit			= $user_debit->debit;
		$user_credit      	= $user_credit->credit;
    		$user_balance    = ( $user_debit - $user_credit ) ;
		
		
	Test begin
				$result['debit']=array();
                                    $this->db->select_sum('debit');
                                    $this->db->from($table_name);
                                    $this->db->where($where_array);
                                    $query=$this->db->get();
									return  $query->result();
                                    

                                       
				//Test End 
				/ *	Get user Balance and Update Final Amount * /
		$userID = $user_id;
		$user_amount    = 0;
		$points_mode 	= $pm_wallet;
		$user_debit  	= $this->product_model->total_user_debit($userID, $points_mode);
		foreach( $user_debit->result() 		as $user_debit);
		$users_debit			= $user_debit->debit;
				
		$user_credit  	= $this->product_model->total_user_credit($userID, $points_mode);
		foreach( $user_credit->result() 	as $user_credit);		
		$users_credit      	= $user_credit->credit;
		
		$user_balance       = ( $users_debit - $users_credit ) ;
		
		//credit = '-' and debit = '+'
		$user_amount 		= $user_balance - $total_price;
		
    }*/
	
	
	public function total_user_debit($userID, $points_mode){
       
		
       $account_no = singleDbTableRow($userID)->account_no;
		
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
	
	public function total_user_credit($userID, $points_mode){
        
			$account_no = singleDbTableRow($userID)->account_no;
        
		$table_name = "accounts";		
		$where_array = array('points_mode'=>$points_mode, 'account_no' =>$account_no);
		$query = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
		return $query;
    }		
	
	//User Total Balance of Different Point Modes
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
	
	public function generatePIN($digits = 4){
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while($i < $digits){
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}


	 //check unique OTP_code
/*
        $getOTP = $this->db->get_where('otp_transactions', ['otp'=> $otp]);
        if($getOTP -> num_rows() > 0)
        {
            for($i= 0; $getOTP->num_rows() > 0; $i++)
			{
			$otp  = strtoupper(random_string());              
			//  $otp  = strtoupper(increment());
                $getOTP = $this->db->get_where('otp_transactions', ['otp'=> $otp]);
            }
        } */
		
/*		
//For Voucher Table generate List	
	public function get_voucher($user_id, $total_price, $pay_type, $paytype_to ){	
	$split_amt = ($total_price / 10);
	
	$today_date = date("Y-m-d"); 
	 $email = singleDbTableRow($user_id)->email;
	 $account_no = singleDbTableRow($user_id)->account_no;
	for($i=2; $i<=10; $i++)
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
							'voucher_name' 			=> 'SMB Voucher',
							'user_id'				=> $user_id,
							'account_no'			=> $account_no,
							'email'					=> $email,
							'voucher_id' 			=> $Epin,
							'pay_type' 				=> '66',
							'amount'   				=> $split_amt, 
							'points_mode' 			=> 'wallet',
							'used'      			=> 'no',
							'start_date'  			=>  $monthly,
							'end_date' 				=> '9999-12-31',
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
	} */
		
}//Last Brace Required