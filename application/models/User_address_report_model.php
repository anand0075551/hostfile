<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class user_address_report_model extends CI_Model {

	function __construct(){
	parent:: __construct();
	
	check_auth(); //check is logged in.
	
	}
	
	
	
	public function search_user_address_ListCount($userid,$rolename,$address_type,$pincode,$state,$district,$location_id,$sf_time,$st_time)
	{
		$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$search = $this->input->get('search');	
		$currentUser = singleDbTableRow($user_id)->role;
		
		$search = $this->input->post('search');	
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		

		
		$searchByID = '';
		$condition="";
		
		
			if($userid !='')
			{	
				if($condition != ""){
				$condition.="user_id = '".$userid."'";
				}
				else{
					$condition.="user_id = '".$userid."'";
				}
			}
			
			if($sf_time !='' && $st_time !='')
			{
				$start_fdt = new DateTime($sf_time);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_time);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_time !='' && $st_time !=''){
			if($condition != ""){
				
			$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
		
		if($rolename !='')
		{	
			if($condition != ""){
			$condition.="AND rolename = '".$rolename."'";
			}
			else{
				$condition.="rolename = '".$rolename."'";
			}
		}
		
		if($address_type !='')
		{	
			if($condition != ""){
			$condition.="AND business_name LIKE '%$address_type%' ";
			}
			else{
				$condition.="business_name LIKE '%$address_type%'";
			}
		}
		
		
		if($pincode !='')
		{
			if($condition != ""){
				$condition.=" AND pincode = '".$pincode."'";
			}
			else{
				$condition.="pincode = '".$pincode."'";
			}
		}
		
		if($state !='')
		{
			if($condition != ""){
				$condition.=" AND state = '".$state."'";
			}
			else{
				$condition.="state = '".$state."'";
			}
		}
		if($district !='')
		{
			if($condition != ""){
				$condition.=" AND district = '".$district."'";
			}
			else{
				$condition.="district = '".$district."'";
			}
		}
		if($location_id !='')
		{
			if($condition != ""){
				$condition.=" AND location_id = '".$location_id."'";
			}
			else{
				$condition.="location_id = '".$location_id."'";
			}
		}
	
			if($condition !='')
			{
				$where_array = $condition;
				$query = $this->db->where($where_array)->count_all_results('user_address');
			}
		
			else
			{
				$query = $this->db->count_all_results('user_address');
			}
		
        return $query;
	}
	
	public function search_user_address_List($limit=10, $start=0,$userid,$rolename,$address_type,$pincode,$state,$district,$location_id,$sf_time,$st_time){
		
		$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$search = $this->input->get('search');	
		$currentUser = singleDbTableRow($user_id)->role;
		
		$search = $this->input->post('search');	
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
	
		
			
				if($userid !='')
				{	
					if($condition != ""){
					$condition.="user_id = '".$userid."'";
					}
					else{
						$condition.="user_id = '".$userid."'";
					}
				}
				
				if($sf_time !='' && $st_time !='')
			{
				$start_fdt = new DateTime($sf_time);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_time);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_time !='' && $st_time !=''){
			if($condition != ""){
				
			$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
		
		
		if($rolename !='')
		{	
			if($condition != ""){
			$condition.="AND rolename = '".$rolename."'";
			}
			else{
				$condition.="rolename = '".$rolename."'";
			}
		}
		
		if($address_type !='')
		{	
			if($condition != ""){
			$condition.="AND business_name LIKE '%".$address_type."%' ";
			}
			else{
				$condition.="business_name LIKE '%".$address_type."%'";
			}
		}
		
		if($pincode !='')
		{
			if($condition != ""){
				$condition.=" AND pincode = '".$pincode."'";
			}
			else{
				$condition.="pincode = '".$pincode."'";
			}
		}
		
		if($state !='')
		{
			if($condition != ""){
				$condition.=" AND state = '".$state."'";
			}
			else{
				$condition.="state = '".$state."'";
			}
		}
		if($district !='')
		{
			if($condition != ""){
				$condition.=" AND district = '".$district."'";
			}
			else{
				$condition.="district = '".$district."'";
			}
		}
		if($location_id !='')
		{
			if($condition != ""){
				$condition.=" AND location_id = '".$location_id."'";
			}
			else{
				$condition.="location_id = '".$location_id."'";
			}
		}
		
		if ($currentUser == 'admin')
		{

			if($condition !='')
			{
				$where_array = $condition;
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('user_address');
			}
		
			else
			{
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('user_address');
			}
		}
		else{
			
			
			
			
			if($condition !='')
			{
				$where_array = $condition;
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('user_address');
			}
		
			else
			{
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('user_address');
			}
		}
	
		return $query;
	
	}
}
	