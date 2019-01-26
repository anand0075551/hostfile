<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Food_voucher_model extends CI_Model {

    /**
     * @return bool
     */

public function add_foodvoucher()
	{		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id']; 
		
		$data = [
			'voucher_type'          => $this->input->post('voucher_type'),
			'food_type'            	=> $this->input->post('food_type'),
			'actual_value'         	=> $this->input->post('actual_price'),
			'pay_type'             	=> $this->input->post('pay_type'),
			'paytype_to'            => $this->input->post('pay_type_to'),
			'pay_to_role' 		   	=> $this->input->post('to_role'),
			'pay_to_user'          	=> $this->input->post('to_user'),
			'receiver_role'         => $this->input->post('receiver_role'),
			'transferrable'        	=> $this->input->post('transferrable'),
			'period' 				=> $this->input->post('voc_type'),
			'validity' 				=> $this->input->post('hrs_gap'),
			'created_by'    	    => $user_id,
			'created_at'    	    => time()
			];
		
		    $query = $this->db->insert('food_voucher_scheme',$data);
			
		 if($query)
        {
            create_activity('Added '.$data['created_by'].'food_voucher_scheme'); //create an activity
            return true;
        }
        return false;
	}
	
	
	
	public function add_discount()
	{		
			$user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
		
		
		$data = [
			'voucher_type'          => $this->input->post('voucher_type'),
			'food_type'            => $this->input->post('food_type'),
			'to_role'            => $this->input->post('to_role'),
			'actual_value'         => $this->input->post('actual_price'),
			'tickent_no_from'         => $this->input->post('from_no'),
			'tickent_no_to'         => $this->input->post('to_no'),
			'discount_in_per'      => $this->input->post('discount_%'),
			'discount_value'       => $this->input->post('discount_value'),
			'price_after_discount' => $this->input->post('price_discount'),
			
			'created_by'    	    => $user_id,
			'created_at'    	    => time()
			
			
			];
		
		    $query = $this->db->insert('food_voucher_discount',$data);
			
		if($query)
        {
            return true;
        }
        return false;
	}
	
	
	
	
   public function get_user($pay_to)
   {
	  $query = $this->db->get_where('users', ['rolename'=>$pay_to]);
	  if($query->num_rows()>0)
	  {
		  return $query;
	  }
	  else
	  {
		  return false;
	  }
   }
   
   public function FoodvoucherListCount() {
		
			$query = $this->db->count_all_results('food_voucher_scheme');
			return $query; 
		
    }	
	
	public function Foodvoucherlist($limit = 10, $start = 0) {
           
		
		
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('food_voucher_scheme'); 
		
        return $query; 
    }
	
	
	public function edit_foodvoucher($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		 
          $data = [
			'voucher_type'          => $this->input->post('voucher_type'),
			'food_type' 		  	=> $this->input->post('food_type'),
            'actual_value' 		    => $this->input->post('actual_price'),
            'pay_type' 		        => $this->input->post('pay_type'),
			'paytype_to'            => $this->input->post('pay_type_to'),
            'pay_to_role'			=> $this->input->post('to_role'),
            'pay_to_user' 		    => $this->input->post('to_user'),
			'receiver_role'         => $this->input->post('receiver_role'),
			'transferrable'        	=> $this->input->post('transferrable'),
			'period' 				=> $this->input->post('voc_type'),
			'validity' 				=> $this->input->post('hrs_gap'),
            'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query = $this->db->where('id', $id)->update('food_voucher_scheme', $data);

        if ($query) {
            create_activity('Updated ' . $data['food_type'] . 'food_voucher_scheme'); //create an activity
            return true;
        }
        return false;
    }

	
	public function edit_foodvoucher_discount($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 
          $data = [
			'voucher_type'          => $this->input->post('voucher_type'),
			'food_type'            => $this->input->post('food_type'),
			'actual_value'         => $this->input->post('actual_price'),
			'tickent_no_from'         => $this->input->post('from_no'),
			'tickent_no_to'         => $this->input->post('to_no'),
			'discount_in_per'      => $this->input->post('discount_%'),
			'discount_value'       => $this->input->post('discount_value'),
			'price_after_discount' => $this->input->post('price_discount'),
			
			'modified_by'    	    => $user_id,
			'modified_at'    	    => time()
			
			
			];

        $query = $this->db->where('id', $id)->update('food_voucher_discount', $data);

        if ($query) {
            create_activity('Updated ' . $data['voucher_type'] . 'food_voucher_scheme'); //create an activity
            return true;
        }
        return false;
    }
	
	public function create_food_voucher()
	{
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
			
		$email   	 	 = singleDbTableRow($user_id)->email;
		$user_acc_no   	 = singleDbTableRow($user_id)->account_no;
		
		$splits  		= $this->input->post('num_tickets');
		$amount 		= $this->input->post('voucher_amount');
	//	$pay_type 		= $this->input->post('pay_type');
		$start_date 	= $this->input->post('start_date');
		$voc_food_type  = $this->input->post('food_type');
		if($this->input->post('transferrable') != ""){
			$transferrable  = $this->input->post('transferrable');
		}
		else{
			$transferrable  = "no";
		}
		
		$voc_type = $this->input->post('voc_period');
		if($voc_type != ""){
			$voucher_type = $voc_type;
		}
		else{
			$voucher_type = "month";
		}
		
		
		$get_food = $this->db->get_where('food_voucher_scheme', ['id'=>$voc_food_type]);
		foreach($get_food->result() as $f);
	//	$voc_type = $f->voucher_type;
		$voc_description = $f->food_type;
		$to_role = $f->receiver_role;
		
		if($f->pay_type != 0){
			$pay_type = $f->pay_type;
		}
		else{
			$pay_type = 95;
		}
		
		if($f->paytype_to != 0){
			$paytype_to = $f->paytype_to;
		}
		else{
			$paytype_to = 96;
		}
		
		$test_date = strtotime($start_date);
		$today_date = date("Y-m-d", $test_date); 
		
		$hrs_gap = $this->input->post('voc_validity');
		
		if($hrs_gap != 0){
			$days = ceil($hrs_gap/24);
		
			$date = strtotime("+".$days." days", strtotime($start_date));
			
			$end_date = date("Y-m-d", $date);
		}
		else{
			$end_date = '2020-12-31';
		}
		
		
		for($i=0; $i<$splits; $i++){
			
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
			$monthlyDate = strtotime("+".$i.$voucher_type.$today_date);
			$monthly = date("Y-m-d", $monthlyDate);
			
			//Voucher End Date
			$new_end_date = $end_date;
			$end_monthlyDate = strtotime("+".$i.$voucher_type.$end_date);
			$end_monthly = date("Y-m-d", $end_monthlyDate);
			
			$data = [
					'voucher_name' 			=> $this->input->post('voucher_type'),
					'voucher_description' 	=> $voc_description,
					'user_id'				=> $user_id,
					'account_no'			=> $user_acc_no,
					'email'					=> $email,
					'voucher_id' 			=> $Epin,
					'pay_type' 				=> $pay_type,
					'paytype_to' 			=> $paytype_to,
					'amount'   				=> $amount, 
					'points_mode' 			=> 'wallet',	//points_mode
					'used'      			=> 'no',
					'start_date'  			=> $monthly,
					'end_date' 				=> $end_monthly,
					'commission'  			=> '0',
					'benefits' 				=> '0',
					'to_role' 				=> $to_role,							
					'created_by' 			=> $user_id,							
					'transferrable'			=> $transferrable,
					'created_at'            => time(),
					'modified_at'           => time()
					];
		
			$query5 = $this->db->insert('vouchers', $data);
		}	
		 if($query5)
        {
            create_activity('Added '.$data['voucher_name'].'vouchers'); //create an activity
            return true;
        }
        return false;
	}
	
	
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
			$where_array = array('email'=>$email);
			$queryCount = $this->db->where($where_array)->count_all_results('vouchers');			
			
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
           
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('vouchers'); 		
						
			 return $query;
				}
			else{ 
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('vouchers', ['email' =>$email]); 
				
			 return $query;
		}
	
   }
   
   
   
    public function voucher_discounts_ListCount() {
		
			$query = $this->db->count_all_results('food_voucher_discount');
		
			return $query; 
		
    }	
	
	public function voucher_discounts_list($limit = 10, $start = 0) {
           
		
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('food_voucher_discount'); 
		
        return $query; 
    }
	
	public function voucher_report_ListCount($voucher_type, $voc_type, $usage, $transfarable, $from_date, $to_date){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$condition = "user_id = '".$user_id."' ";
		
		if($voucher_type !='')
		{
			$condition.=" AND voucher_name = '".$voucher_type."'";
		}
		
		if($voc_type !='')
		{
			if($condition != ""){
				$condition.=" AND voucher_description = '".$voc_type."'";
			}
			else{
				$condition.=" voucher_description = '".$voc_type."'";
			}
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
		
		if($from_date !='' && $to_date !=''){
			if($condition != ""){
				$condition.=" AND start_date >= '".$from_date."' AND start_date <= '".$to_date."'";
			}
			else{
				$condition.=" start_date >= '".$from_date."' AND start_date <= '".$to_date."'";
			}
		}
		
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('vouchers'); 
		}
		else
		{
			$query = $this->db->count_all_results('vouchers'); 
		}
        return $query;
	}
	
	
	public function voucher_report_List($limit, $start, $voucher_type, $voc_type, $usage, $transfarable, $from_date, $to_date){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$condition = "user_id = '".$user_id."'  ";
		
		if($voucher_type !='')
		{
			$condition.=" AND voucher_name = '".$voucher_type."'";
		}
		
		if($voc_type !='')
		{
			if($condition != ""){
				$condition.=" AND voucher_description = '".$voc_type."'";
			}
			else{
				$condition.=" voucher_description = '".$voc_type."'";
			}
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
		
		if($from_date !='' && $to_date !=''){
			if($condition != ""){
				$condition.=" AND start_date >= '".$from_date."' AND start_date <= '".$to_date."'";
			}
			else{
				$condition.=" start_date >= '".$from_date."' AND start_date <= '".$to_date."'";
			}
		}
		
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('vouchers'); 
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('vouchers');	
		}
        return $query;
	}
	
	
}//last brace required