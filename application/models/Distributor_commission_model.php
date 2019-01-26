<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor_commission_model extends CI_Model {

    /**
     * @return bool
     */

public function add_distributor_commission()
	{		
				//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			 $currentUser = singleDbTableRow($user_id)->role;
			 
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 $data['rolename'] = $this->db->get('role');
			 $data['first_name'] = $this->db->get('users');
			 
			 
			$data = [
			'business_group'        => $this->input->post('business_group'),
			'pay_type'        => $this->input->post('pay_type'),
			'area'            		=> $this->input->post('area'),
			'from_role'             => $this->input->post('from_role'),
            'to_role'               => $this->input->post('to_role'),
			'to_user'         		=> $this->input->post('to_user'),
			'percentage'			=> $this->input->post('percentage'),
			'created_by'    	    => $user_id,
			'created_at'    	    => time()
			//'modified_at'			=> time()
			//'modified_by'			=> $user_id,
			];
				
		$query = $this->db->insert('distributor_commission', $data);

        if($query)
        {
            create_activity('Added '.$data['name'].'distributor_commission'); //create an activity
            return true;
        }
        return false;
	}
	public function copy_distributor_commission()
	{		
				//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			 $currentUser = singleDbTableRow($user_id)->role;
			 
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 $data['rolename'] = $this->db->get('role');
			 $data['first_name'] = $this->db->get('users');
			 
			 
			$data = [
			'business_group'        => $this->input->post('business_group'),
			'pay_type'        => $this->input->post('pay_type'),
			'area'            		=> $this->input->post('area'),
			'from_role'             => $this->input->post('from_role'),
            'to_role'               => $this->input->post('to_role'),
			'to_user'         		=> $this->input->post('to_user'),
			'percentage'			=> $this->input->post('percentage'),
			'created_by'    	    => $user_id,
			'created_at'    	    => time()
			//'modified_at'			=> time()
			//'modified_by'			=> $user_id,
			];
				
		$query = $this->db->insert('distributor_commission', $data);

        if($query)
        {
            create_activity('Added '.$data['name'].'distributor_commission'); //create an activity
            return true;
        }
        return false;
	}
	public function get_pay_type($acc_cat)
    {
      $where_array = array( 'parentid' => $acc_cat, 'category_type' => 'sub');
      $table_name="acct_categories";
       $query = $this->db->order_by('id', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 
	public function get_user($to_role)
    {
      $where_array = array( 'rolename' => $to_role );
      $table_name="users";
       $query = $this->db->order_by('first_name', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	public function get_area($bg_id)
    {
      $where_array = array( 'business_name' => $bg_id );
      $table_name="area";
       $query = $this->db->order_by('id', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 

	public function commissionListCount() {
		
			$query = $this->db->count_all_results('distributor_commission');
			return $query; 
		
    }	
	
	public function commissionList($limit = 10, $start = 0) {
           
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
				if ($currentUser == 'admin')
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('distributor_commission');
					return $query;
				}
				else
				{  
					$table_name = 'distributor_commission';
					$where_array = array('created_by' => $user_id);
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
					return $query;
				}

	}
	
	public function edit_distributor_commission($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 
          $data = [
           	'business_group'               => $this->input->post('business_group'),
			'from_role'               => $this->input->post('from_role'),
			'to_role'               => $this->input->post('to_role'),
			'area'               => $this->input->post('area'),
			'to_user'         		=> $this->input->post('to_user'),
			'percentage'			=> $this->input->post('percentage'),
           
            'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query = $this->db->where('id', $id)->update('distributor_commission', $data);

        if ($query) {
            create_activity('Updated ' . $data['name'] . 'distributor_commission'); //create an activity
            return true;
        }
        return false;
    }
/*--------------------Get Commission --------------------- */

	public function Check_upper_commission($from_role,$from_date,$end_date,$business_group) 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		
		$where_array = array( 'to_role' => $currentUser,'from_role' => $from_role,'from_date' =>$from_date,'end_date' =>$end_date,'to_user' =>$user_id,'business_group'=>$business_group);
		$query = $this->db->where($where_array)->get('upper_commission');
		return $query;
	}
	public function Insert_upper_commission($business_group,$total_users,$total_sales,$total_commission,$from_role,$to_role,$first_day,$last_day)
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$Userreferral_code = singleDbTableRow($user_id)->referral_code;
		$data = [
			'created_by' 	=> $user_id,
			'created_at' 	=> time(),
			'total_commission' 			=> $total_commission,
			'no_of_users' 			=> $total_users,
			'business_group' 			=> $business_group,
			'total_sales' 			=> $total_sales,
            'status'      => 0,
			'to_role'  		=> $to_role,
			'to_user'  		=> $user_id,
			'from_role'  		=> $from_role,
			'from_date'  		=> $first_day,
			'end_date'  		=> $last_day,
			'root_id'  		=> $Userreferral_code
			];
			$query = $this->db->insert('upper_commission', $data);
			if($query)
			{
				return true;	
			}
	}


	public function mycommissionListCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		$where_array = " to_role = ".$currentUser." ";
		$query = $this->db->where($where_array )->count_all_results('distributor_commission');
		//$query = $this->db->where('to_role' == $currentUser)->count_all_results('distributor_commission');
		return $query; 
	}	
	public function check_commission($limit = 0, $start = 0) 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		
		$where_array = array( 'to_role' => $currentUser,'to_user' =>$user_id );
		 
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('distributor_commission');
		return $query;
	}
	public function User_credit($user_id, $from_date, $end_date,$pay_type) 
	{
		//$where_array = array( 'user_id' => $user_id);
		if($pay_type !=0)
		{
			$where_array=" user_id=".$user_id." AND pay_type=".$pay_type." AND DATE(FROM_UNIXTIME(created_at)) BETWEEN '".$from_date."' AND '".$end_date."'" ;
		}
		else
		{
			$where_array=" user_id=".$user_id." AND DATE(FROM_UNIXTIME(created_at)) BETWEEN '".$from_date."' AND '".$end_date."'" ;
		}
		
		 
		$query = $this->db->select_sum('credit')->where($where_array)->get('accounts');
		if($query -> num_rows() > 0) 
		{
			foreach ($query->result() as $credit) 
			{
				$user_credit = $credit->credit;
			}
			return $user_credit;
		}
		else
		{
			return 0;
		}
	}
	public function Total_sales($area, $from_role, $from_date, $end_date,$pay_type) 
	{
		/* Area pincodes*/
		$get_pincode = $this->db->get_where('area', ['id'=>$area]);
		foreach($get_pincode->result() as $p);
		$pincodes=$p->pincode;
		/* */
		$where_array = " postal_code IN (".$pincodes.") AND rolename = ".$from_role." ";
		//$where_array = array( 'postal_code' => $user_pincode, 'rolename' => $from_role );
		
		$query = $this->db->order_by('id', 'desc')->where($where_array)->get('users');
		$total_users = $query -> num_rows();
		if($query -> num_rows() > 0) 
		{
			$total_credits=0;
			foreach ($query->result() as $users) 
			{
				$id=$users->id;
				$user_credit=$this->User_credit($id, $from_date, $end_date,$pay_type);
				$total_credits = $total_credits + $user_credit;
			}
			return array($total_credits,$total_users);
		}
		else
		{
			return array(0,0);
		}
	}
	public function Check_paid($from_role,$from_date,$end_date,$business_group) 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		
		$where_array = array( 'to_role' => $currentUser,'from_role' => $from_role,'status' => 1,'from_date' =>$from_date,'end_date' =>$end_date,'to_user' =>$user_id,'business_group'=>$business_group);
		$query = $this->db->where($where_array)->get('upper_commission');
		if($query -> num_rows() > 0) 
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	public function Get_commission($amount,$from_date,$end_date,$from_role) 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		$Userreferral_code = singleDbTableRow($user_id)->referral_code;
		$user_pincode = singleDbTableRow($user_id)->postal_code;
		/* transaction*/
		$pay_by_referral_code 	= 	'5382610497';	// SMb Fin Manager Sender's referral_code, ex : 5559990001
		$pay_to_referral_code 	= 	$Userreferral_code;// Receiver's referral_code, ex : 5164830972
		$amount_to_pay		  	=	$amount;			// Total amont to pay (or) transfer, ex : 100
		$pay_spec_type			=	66;				// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
		$transaction_remarks	=	'Distributor Commission';	// remarks to insert into invoice table, ex : "Transfer Values";
		$pm_mode				=	'wallet';			// points_mode, ex : wallet, loyality, discount.
		
		
		$insert = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);
		/* insert */
		/*$data = [
			'created_by' 	=> $user_id,
			'created_at' 	=> time(),
			'total_commission' 			=> $amount,
            'status'      => 1,
			'to_role'  		=> $currentUser,
			'to_user'  		=> $user_id,
			'from_role'  		=> $from_role,
			'from_date'  		=> $from_date,
			'end_date'  		=> $end_date,
			'root_id'  		=> $Userreferral_code
			];
			$query = $this->db->insert('upper_commission', $data);*/
			$data = [
			'modified_by' 	=> $user_id,
			'modified_at' 	=> time(),
			'status'      => 1
			];
			$where_array = " to_role = ".$currentUser." AND to_user = ".$user_id." AND from_role = ".$from_role." AND from_date = '".$from_date."' AND end_date = '".$end_date."' ";
			$query = $this->db->where($where_array)->update('upper_commission', $data);
			if($query)
			{
				return true;	
			}
			else
			{
				return false;
			}
	}
/*--------------------/Get Commission --------------------- */
	
}