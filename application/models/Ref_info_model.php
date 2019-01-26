<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_info_model extends CI_Model {



	public function ref_listcount(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$current_ref = singleDbTableRow($user_id)->referral_code;
		$role = singleDbTableRow($user_id)->rolename;
		
		if($role == 11){
			$query = $this->db->order_by('id','desc')->count_all_results('users');
		}else{
			
			$query = $this->db->where('referredByCode',$current_ref)->order_by('id','desc')->count_all_results('users');
			
		}
		
        return $query;
    }

    public function all_ref_List($limit = 0, $start = 0){
	
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$current_ref = singleDbTableRow($user_id)->referral_code;
		$role = singleDbTableRow($user_id)->rolename;
		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];
		$searchByID = '';	
		
		
		if($role == 11){
		
			if($searchValue != '')																							
			{																												
				$table_name = "users";		
					
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name); 	
			}											
			else{										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('users');
			}
		
		}else{
			
			if($searchValue != '')																							
			{																												
				$table_name = "users";		
					
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name); 	
			}											
			else{										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users',['referredByCode'=>$current_ref]);
			}
			
		}	
		
		
        return $query;
    }
	 
    
	 public function assign_root_id()
	 {
		 
			$user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
						
				$update_to = $this->input->post('id');		
						
		 $data = [
				'role_name'     			 =>	$this->input->post('role_name'),
				'referral_id'     			 =>	$this->input->post('ref_id'),
				'user_name'     			 =>	$update_to,
				'contact_no'     			 =>	$this->input->post('contact_no'),
				'current_root_id'     		 =>	$this->input->post('c_root_id'),
				'assign_root_id'     		 =>	$this->input->post('new_root_id'),  
				'status'     				 =>	1,
				'updated_by'     			 =>	$user_id,
				'updated_to'     			 =>	$update_to,
				'created_by'          		 =>	$user_id,
				'created_at'           		 =>	time()
				]; 
			
		$data2 = [
				'root_id'     				 =>$this->input->post('new_root_id'),
				'modified_by'          		 =>$user_id,
				'modified_at'           	 =>time()
				]; 
			
       
		 $query = $this->db->insert('ref_change', $data);
		 
		 $query2 = $this->db->where('id', $update_to)->update('users', $data2);
		 
		 if($query && $query2)
        {
				create_activity('Added '.$data['role_name'].'ref_change'); 
			
				create_activity('Updated '.$data2['root_id'].'Rood Id');
            return true;
        }
		
        return false; 
						
    }
	
	
	
	public function assigned_listcount(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$current_ref = singleDbTableRow($user_id)->referral_code;
		$role = singleDbTableRow($user_id)->rolename;
		
		if($role == 11){
			
			$query = $this->db->order_by('id','desc')->count_all_results('ref_change');
			
		}else{
			
			$query = $this->db->where('updated_by',$user_id)->order_by('id','desc')->count_all_results('ref_change');
			
		}
        return $query;
		
    }

    public function all_assigned_List($limit = 0, $start = 0){
	
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$current_ref = singleDbTableRow($user_id)->referral_code;
		$role = singleDbTableRow($user_id)->rolename;
		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];
		$searchByID = '';	
		
		if($role == 11){
			
			if($searchValue != '')																							
				{																												
					$table_name = "ref_change";		
						
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name); 	
				}											
				else{										
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('ref_change');
				}
				
		}else{
			
			if($searchValue != '')																							
				{																												
					$table_name = "ref_change";		
						
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name); 	
				}											
				else{										
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('ref_change',['updated_by'=>$user_id]);
				}
						
		}
		
        return $query;
    }
	
//Search refferal list

	
public function search_ref_listcount($role_name,$user_name){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$current_ref = singleDbTableRow($user_id)->referral_code;
		$role = singleDbTableRow($user_id)->rolename;
		
		
		if($role == 11){
							
				$condition="";
				if($role_name !='')
				{	
					if($condition != ""){
					$condition.="rolename = '".$role_name."'";
					}
					else{
						$condition.="rolename = '".$role_name."'";
					}
				}	
				
				if($user_name !='')
				{	
					if($condition != ""){
					$condition.="AND id = '".$user_name."'";
					}
					else{
						$condition.="id = '".$user_name."'";
					}
				}	
							
							
				if($condition !='')
					{
						$where_array =$condition;
						$query = $this->db->where($where_array)->order_by('id','desc')->count_all_results('users');
					}
				
					else
					{
						$query = $this->db->count_all_results('users');
					}
			
		}else{
			
			$condition="";
			if($role_name !='')
			{	
				if($condition != ""){
				$condition.="rolename = '".$role_name."'";
				}
				else{
					$condition.="rolename = '".$role_name."'";
				}
			}
			
			if($current_ref !='')
			{	
				if($condition != ""){
				$condition.="AND referredByCode = '".$current_ref."'";
				}
				else{
					$condition.="referredByCode = '".$current_ref."'";
				}
			}
			
			if($user_name !='')
				{	
					if($condition != ""){
					$condition.="AND id = '".$user_name."'";
					}
					else{
						$condition.="id = '".$user_name."'";
					}
				}	
			
			if($condition !='')
					{
						$where_array =$condition;
						$query = $this->db->where($where_array)->order_by('id','desc')->count_all_results('users');
					}
				
					else
					{
						$query = $this->db->where('referredByCode',$current_ref)->order_by('id','desc')->count_all_results('users');
					}
					
		}
		
		
        return $query;
    }

public function refferal_List($limit = 0, $start = 0, $role_name, $user_name){

	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentUser = singleDbTableRow($user_id)->role;
	$current_ref = singleDbTableRow($user_id)->referral_code;
	$role = singleDbTableRow($user_id)->rolename;
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	$searchByID = '';	
	
		if($role == 11){	
			
				$condition="";
				if($role_name !='')
				{	
					if($condition != ""){
					$condition.="rolename = '".$role_name."'";
					}
					else{
						$condition.="rolename = '".$role_name."'";
					}
				}
				
				if($user_name !='')
				{	
					if($condition != ""){
					$condition.="AND id = '".$user_name."'";
					}
					else{
						$condition.="id = '".$user_name."'";
					}
				}	
				
			if($condition !='')
				{
					$where_array =$condition;
					$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->where($where_array)->get('users');
				}
				else
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->get('users');
				}
				
		}else{
			
			
			$condition="";
			if($role_name !='')
			{	
				if($condition != ""){
				$condition.="rolename = '".$role_name."'";
				}
				else{
					$condition.="rolename = '".$role_name."'";
				}
			}
				
			if($current_ref !='')
			{	
				if($condition != ""){
				$condition.="AND referredByCode = '".$current_ref."'";
				}
				else{
					$condition.="referredByCode = '".$current_ref."'";
				}
			}
				
			
			if($user_name !='')
				{	
					if($condition != ""){
					$condition.="AND id = '".$user_name."'";
					}
					else{
						$condition.="id = '".$user_name."'";
					}
				}	
				
			if($condition !='')
				{
					$where_array =$condition;
					$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->where($where_array)->get('users');
				}
				else
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->get('users');
				}
			
			
		}
		
		
	return $query;	
		
	
	}
 


 
 
 
 	
//Search Assined refferal list

	
public function search_new_ref_listcount($role_name,$user_name){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$current_ref = singleDbTableRow($user_id)->referral_code;
		$role = singleDbTableRow($user_id)->rolename;
		
		
		if($role == 11){
							
				$condition="";
				if($role_name !='')
				{	
					if($condition != ""){
					$condition.="role_name = '".$role_name."'";
					}
					else{
						$condition.="role_name = '".$role_name."'";
					}
				}	
				
				if($user_name !='')
				{	
					if($condition != ""){
					$condition.="AND user_name = '".$user_name."'";
					}
					else{
						$condition.="user_name = '".$user_name."'";
					}
				}	
							
							
				if($condition !='')
					{
						$where_array =$condition;
						$query = $this->db->where($where_array)->order_by('id','desc')->count_all_results('ref_change');
					}
				
					else
					{
						$query = $this->db->count_all_results('ref_change');
					}
			
		}else{
			
			$condition="";
			if($role_name !='')
			{	
				if($condition != ""){
				$condition.="role_name = '".$role_name."'";
				}
				else{
					$condition.="role_name = '".$role_name."'";
				}
			}
			
			
			if($user_name !='')
				{	
					if($condition != ""){
					$condition.="AND user_name = '".$user_name."'";
					}
					else{
						$condition.="user_name = '".$user_name."'";
					}
				}	
			
			if($condition !='')
					{
						$where_array =$condition;
						$query = $this->db->where($where_array)->order_by('id','desc')->count_all_results('ref_change');
					}
				
					else
					{
						$query = $this->db->where('updated_by',$user_id)->order_by('id','desc')->count_all_results('ref_change');
					}
					
		}
		
		
        return $query;
    }

public function assign_refferal_List($limit = 0, $start = 0, $role_name, $user_name){

	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentUser = singleDbTableRow($user_id)->role;
	$current_ref = singleDbTableRow($user_id)->referral_code;
	$role = singleDbTableRow($user_id)->rolename;
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	$searchByID = '';	
	
		if($role == 11){	
			
				$condition="";
				if($role_name !='')
				{	
					if($condition != ""){
					$condition.="role_name = '".$role_name."'";
					}
					else{
						$condition.="role_name = '".$role_name."'";
					}
				}
				
				if($user_name !='')
				{	
					if($condition != ""){
					$condition.="AND user_name = '".$user_name."'";
					}
					else{
						$condition.="user_name = '".$user_name."'";
					}
				}	
				
			if($condition !='')
				{
					$where_array =$condition;
					$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->where($where_array)->get('ref_change');
				}
				else
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->get('ref_change');
				}
				
		}else{
			
			
			$condition="";
			if($role_name !='')
			{	
				if($condition != ""){
				$condition.="role_name = '".$role_name."'";
				}
				else{
					$condition.="role_name = '".$role_name."'";
				}
			}
				
							
			
			if($user_name !='')
				{	
					if($condition != ""){
					$condition.="AND user_name = '".$user_name."'";
					}
					else{
						$condition.="user_name = '".$user_name."'";
					}
				}	
				
			if($condition !='')
				{
					$where_array =$condition;
					$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->where($where_array)->get('ref_change');
				}
				else
				{
					$query = $this->db->where('updated_by',$user_id)->order_by('id', 'desc')->limit($limit,$start)->get('ref_change');
				}
			
			
		}
		
		
	return $query;	
		
	
	}
 
 
//update status
public function update_sts($aid, $status)
	{
		/* update */
		$data2 = [
		
           	'active'        => $status,
			
        ];

        $query2 = $this->db->where('id', $aid)->update('users', $data2);
			if($query2)
			{
				return true;	
			}
			else
			{
				return false;
			}
			
	}
 
 
//role and referrals declaration add 
 
 public function role_referral_dec()
	 {
		 
			$user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
								
						
		 $data = [
				'activity_type'     		 =>	$this->input->post('activity_type'),
				'from_role'     			 =>	$this->input->post('f_role'),
				'to_role'     				 =>	$this->input->post('t_role'),
				'f_role_points'     		 =>	$this->input->post('points_f'),
				't_role_points'     		 =>	$this->input->post('points_t'), 
				'points_mode'     			 =>	$this->input->post('points_mode'), 
				'limit'   			  		 =>	$this->input->post('limit'), 
				'created_by'          		 =>	$user_id,
				'created_at'           		 =>	time()
				]; 
		
		 $query = $this->db->insert('role_refrral_declaration', $data);
		 
				 
		 if($query)
        {
				create_activity('Added '.$data['activity_type'].'role_refrral_declaration'); 
            return true;
        }
		
        return false; 
						
    }

	
//Role And Referral Declaration list
 
 public function role_referral_listcount(){
		
		$query = $this->db->order_by('id','desc')->count_all_results('role_refrral_declaration');
		
        return $query;
    }

public function role_referral_List($limit = 0, $start = 0){

		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];
		$searchByID = '';	
		
		
			if($searchValue != '')																							
			{																												
				$table_name = "role_refrral_declaration";		
					
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name); 	
			}											
			else{										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('role_refrral_declaration');
			}
		
			
        return $query;
    }
	
	
//role transfer listing

public function role_trans_listcount(){
		$user_info 			= $this->session->userdata('logged_user');
		$user_id 			= $user_info['user_id'];
		$current_ref 		= singleDbTableRow($user_id)->referral_code;
		$role 				= singleDbTableRow($user_id)->rolename;
		$root_id 			= singleDbTableRow($user_id)->root_id;
		
		if($role == 11){
			$query = $this->db->order_by('id','desc')->count_all_results('users');
		}else{
			
			$query = $this->db->where('root_id',$root_id)->order_by('id','desc')->count_all_results('users');
			
		}
		
        return $query;
    }

    public function role_trans_List($limit = 0, $start = 0){
	
		$user_info 			= $this->session->userdata('logged_user');
		$user_id 			= $user_info['user_id'];
		$currentUser 		= singleDbTableRow($user_id)->role;
		$current_ref	    = singleDbTableRow($user_id)->referral_code;
		$role 				= singleDbTableRow($user_id)->rolename;
		$root_id 			= singleDbTableRow($user_id)->root_id;
		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];
		$searchByID = '';	
		
		
		if($role == 11){
		
			if($searchValue != '')																							
			{																												
				$table_name = "users";		
					
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name); 	
			}											
			else{										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('users');
			}
		
		}else{
			
			if($searchValue != '')																							
			{																												
				$table_name = "users";		
					
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name); 	
			}											
			else{										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users',['root_id'=>$root_id]);
			}
			
		}	
		
		
        return $query;
    }

 
 
//Role And Referral transfer 
 
 public function role_trans()
	 {
		$user_info 			= $this->session->userdata('logged_user');
		$user_id 			= $user_info['user_id'];
		 		
		 $data = [
				'sender_id'     			 =>	$this->input->post('sender_id'),
				'role'     					 =>	$this->input->post('role_id'),
				'referral_code'     		 =>	$this->input->post('referredByCode'),
				'req_amount'     		 	 =>	$this->input->post('req_cost'),
				'chargeable_amt'     		 =>	$this->input->post('charge_amt'), 
				'points_mode'     			 =>	$this->input->post('points_mode'), 
				'created_by'          		 =>	$user_id,
				'created_at'           		 =>	time()
				]; 
		
		 $query = $this->db->insert('role_transfer', $data);
		 
		 //reciver sms process
		 $get_reciver = $this->db->get_where('users',['referral_code'=>$this->input->post('referredByCode')]);
		 foreach($get_reciver->result() as $user);
		 $user_name 	= $user->first_name;
		 $ph_no     	= $user->contactno;
		 $role_name	    = singleDbTableRow($this->input->post('role_id'),'role')->rolename;
		 $request_by    = singleDbTableRow($this->input->post('sender_id'))->first_name.' '.singleDbTableRow($this->input->post('sender_id'))->last_name;
		 
		 include_once('sendsms.php'); 
		 
         $message="Dear ".$user_name.", your got a request for ".$role_name." role . Requested by ".$request_by.". Please login and check it - Team Cfirst";
		 $sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
		 $sendsms->send_sms($ph_no, $message, 'http://www.consumer1st.in', 'xml');
		 
		 
		//Payment process
		
		$pay_by_referral_code     =     singleDbTableRow($this->input->post('sender_id'))->referral_code;
		$pay_to_referral_code     =     '6413502987'; // Business Role Change Request (pay_type->2) .
		$amount_to_pay       	  =     $this->input->post('req_cost');
		$pay_spec_type            =     '96';
		$transaction_remarks      =     "Creation of 25";
		$pm_mode                  =     "wallet";


		$make_my_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode); 
				 
				 
		 
		if($query)
        {
				create_activity('Added '.$data['sender_id'].'role_transfer'); 
            return true;
        }
		
        return false; 
						
    }
 
 
//Assigned Role 


public function assign_role_listcount(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$referral_code = singleDbTableRow($user_id)->referral_code;
		
		if($role == 11){
			
			$query = $this->db->order_by('id','desc')->count_all_results('role_transfer');
			
		}else{
			
			$query = $this->db->where('referral_code',$referral_code)->order_by('id','desc')->count_all_results('role_transfer');
			
		}	
		
        return $query;
    }

public function assign_role_List($limit = 0, $start = 0){

		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$referral_code = singleDbTableRow($user_id)->referral_code;
		
		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];
		$searchByID = '';	
		
		if($role == 11){
			
			if($searchValue != '')																							
			{																												
				$table_name = "role_transfer";		
					
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name); 	
			}											
			else{										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('role_transfer');
			}
			
		}else{
			
			if($searchValue != '')																							
				{																												
					$table_name = "role_transfer";		
						
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name); 	
				}											
				else{										
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('role_transfer',['referral_code'=>$referral_code]);
				}
		
		}
		
        return $query;
    }

	
	
	
//Update New Role
 
 public function update_user_role($id, $sender, $points_mode, $ch_amt)
	 {
		 $get_ref = $this->db->get_where('users',['id'=>$sender]);
		 foreach($get_ref->result() as $sen_ref);
		 
		 $sender_role	    = $sen_ref->referral_code;
		 		 
				 
		 //get referral_code 
		 $get_ref = $this->db->get_where('role_transfer',['id'=>$id]);
		 foreach($get_ref->result() as $ref);
		 	
		 $reciver_role		= $ref->referral_code;
		
		
		 //get root id
		 $get_root = $this->db->get_where('users',['referral_code'=>$ref->referral_code]);
		 foreach($get_root->result() as $root);
		
		 $data = [
				'status'   =>'1',
				]; 
		
		$data2 = [
				'root_id'   =>$root->root_id,
				]; 
		
		
		
		$query = $this->db->where('id', $id)->update('role_transfer', $data);
		
		
		$query2 = $this->db->where('id', $sender)->update('users', $data2);
		
		
		//Payment Process
		
		$pay_by_referral_code     =     '6413502987'; // Business Role Change Request (pay_type->2) .
		$pay_to_referral_code     =    	singleDbTableRow($sender)->root_id;
		$amount_to_pay       	  =     $ch_amt;
		$pay_spec_type            =     '96';
		$transaction_remarks      =     "Creation of 25";
		$pm_mode                  =     "wallet";


		$make_my_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode); 
		
		 
		if($query && $query2)
			{
				
				return true;
			}
		
        return false; 
						
    }
 
 
//Accept the  Role
 public function accept_role_m($id, $referral_code, $grand_total)
	 {
		
		$data = [
				'status'   =>'3',
				]; 
		
		
		$query = $this->db->where('id', $id)->update('role_transfer', $data);
		
		
		//Payment Process
		
		$pay_by_referral_code     =     $referral_code;
		$pay_to_referral_code     =     '6413502987'; // Business Role Change Request (pay_type->2) .
		$amount_to_pay       	  =     $grand_total;
		$pay_spec_type            =     '96';
		$transaction_remarks      =     "Creation of 25";
		$pm_mode                  =     "wallet";


		$make_my_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode); 
		
		
		
		
         if($query)
			{
				
				return true;
			}
		
        return false; 
						
    }
  
//Cancel Role
 public function cancel_role_m($id)
	 {
		
		$data = [
				'status'   =>'2',
				]; 
		
		
		$query = $this->db->where('id', $id)->update('role_transfer', $data);
				
          if($query)
        {
			
            return true;
        }
		
        return false; 
						
    }
 
 
 	
//Search Assined refferal Transfer

public function search_new_ref_transfer($role_name,$user_name){
		$user_info			= $this->session->userdata('logged_user');
		$user_id 			= $user_info['user_id'];
		$current_ref 		= singleDbTableRow($user_id)->referral_code;
		$role				= singleDbTableRow($user_id)->rolename;
		$root_id 			= singleDbTableRow($user_id)->root_id;
		
		if($role == 11)
		{
			$condition="";
			if($role_name !='')
			{	
				if($condition != ""){
				$condition.="AND rolename = '".$role_name."'";
				}
				else{
					$condition.="rolename = '".$role_name."'";
				}
			}	
			
			if($user_name !='')
			{	
				if($condition != ""){
				$condition.="AND id = '".$user_name."'";
				}
				else{
					$condition.="id = '".$user_name."'";
				}
			}	
						
						
			if($condition !='')
				{
					$where_array =$condition;
					$query = $this->db->where($where_array)->order_by('id','desc')->count_all_results('users');
				}
			
				else
				{
					$query = $this->db->count_all_results('users');
				}
			
		}else{
			
			$condition="";
			if($role_name !='')
			{	
				if($condition != ""){
				$condition.="AND rolename = '".$role_name."'";
				}
				else{
					$condition.="rolename = '".$role_name."'";
				}
			}	
			
			if($user_name !='')
			{	
				if($condition != ""){
				$condition.="AND id = '".$user_name."'";
				}
				else{
					$condition.="id = '".$user_name."'";
				}
			}	
			
			if($condition != ""){
			$condition.="AND root_id = '".$root_id."'";
			}
			else{
				$condition.="root_id = '".$root_id."'";
			}
									
						
			if($condition !='')
				{
					$where_array =$condition;
					$query = $this->db->where($where_array)->order_by('id','desc')->count_all_results('users');
				}
			
				else
				{
					$query = $this->db->count_all_results('users');
				}
		
		}
		
        return $query;
    }

public function ref_transfer_List($limit = 0, $start = 0, $role_name, $user_name){

	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentUser = singleDbTableRow($user_id)->role;
	$current_ref = singleDbTableRow($user_id)->referral_code;
	$role = singleDbTableRow($user_id)->rolename;
	$root_id 			= singleDbTableRow($user_id)->root_id;
	
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	$searchByID = '';		
			
		if($role == 11){
			
			$condition="";
			if($role_name !='')
			{	
				if($condition != ""){
				$condition.="AND rolename = '".$role_name."'";
				}
				else{
					$condition.="rolename = '".$role_name."'";
				}
			}
			
			if($user_name !='')
			{	
				if($condition != ""){
				$condition.="AND id = '".$user_name."'";
				}
				else{
					$condition.="id = '".$user_name."'";
				}
			}	
			
			if($condition !='')
				{
					$where_array =$condition;
					$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->where($where_array)->get('users');
				}
				else
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->get('users');
				}
				
			
		}else{
			
			$condition="";
				if($role_name !='')
				{	
					if($condition != ""){
					$condition.="AND rolename = '".$role_name."'";
					}
					else{
						$condition.="rolename = '".$role_name."'";
					}
				}
				
				if($user_name !='')
				{	
					if($condition != ""){
					$condition.="AND id = '".$user_name."'";
					}
					else{
						$condition.="id = '".$user_name."'";
					}
				}	
				
				if($condition != ""){
				$condition.="AND root_id = '".$root_id."'";
				}
				else{
					$condition.="root_id = '".$root_id."'";
				}
				
				
			if($condition !='')
				{
					$where_array =$condition;
					$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->where($where_array)->get('users');
				}
				else
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->get('users');
				}
					
			
			
		}
		
	return $query;	
		
	
}
 
 
 
 
	
}	