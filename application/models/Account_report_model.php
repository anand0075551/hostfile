<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_report_model extends CI_Model {
	
	public function search_account_ListCount($user_id,$rolename,$pay_type,$points_mode,$sf_time,$st_time)
	{
		
		$user_info = $this->session->userdata('logged_user');
		
		$condition="";
		if($user_id !='')
		{
			$condition.="user_id = ".$user_id." ";
		}
		
		if($rolename !='')
		{
			if($condition != ""){
				$condition.=" AND rolename = '".$rolename."'";
			}
			else{
				$condition.="rolename = '".$rolename."'";
			}
		}
		
		if($pay_type !='')
		{
			if($condition != ""){
				$condition.=" AND pay_type = '".$pay_type."'";
			}
			else{
				$condition.="pay_type = '".$pay_type."'";
			}
		}
		
		if($points_mode !='')
		{
			if($condition != ""){
				$condition.=" AND points_mode = '".$points_mode."'";
			}
			else{
				$condition.="points_mode = '".$points_mode."'";
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
					
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array )->count_all_results('accounts'); 
		}
		else
		{
			$query = $this->db->count_all_results('accounts'); 
		}
        return $query;
	}


	
	public function search_account_List($limit, $start ,$user_id,$rolename,$pay_type,$points_mode,$sf_time,$st_time){
		
		$user_info = $this->session->userdata('logged_user');
		
		$condition="";
		if($user_id !='')
		{
			$condition.="user_id = ".$user_id." ";
		}
		
		if($rolename !='')
		{
			if($condition != ""){
				$condition.=" AND rolename = '".$rolename."'";
			}
			else{
				$condition.="rolename = '".$rolename."'";
			}
		}
		
		if($pay_type !='')
		{
			if($condition != ""){
				$condition.=" AND pay_type = '".$pay_type."'";
			}
			else{
				$condition.="pay_type = '".$pay_type."'";
			}
		}
		
		if($points_mode !='')
		{
			if($condition != ""){
				$condition.=" AND points_mode = '".$points_mode."'";
			}
			else{
				$condition.="points_mode = '".$points_mode."'";
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
					
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->group_by('user_id')->where($where_array )->get('accounts'); 
		}
		else
		{
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->group_by('user_id')->get('accounts');	
		}
        return $query;
	}
	
	function get_total($user_id,$rolename,$pay_type,$points_mode,$sf_time,$st_time)
    {
		$user_info = $this->session->userdata('logged_user');
		
		$condition="";
		if($user_id !='')
		{
			$condition.="user_id = ".$user_id." ";
		}
		
		if($rolename !='')
		{
			if($condition != ""){
				$condition.=" AND rolename = '".$rolename."'";
			}
			else{
				$condition.="rolename = '".$rolename."'";
			}
		}
		
		if($pay_type !='')
		{
			if($condition != ""){
				$condition.=" AND pay_type = '".$pay_type."'";
			}
			else{
				$condition.="pay_type = '".$pay_type."'";
			}
		}
		
		if($points_mode !='')
		{
			if($condition != ""){
				$condition.=" AND points_mode = '".$points_mode."'";
			}
			else{
				$condition.="points_mode = '".$points_mode."'";
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
					
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->order_by('id', 'desc')->where($where_array )->get('accounts'); 
		}
		else
		{
		$query = $this->db->order_by('id', 'desc')->get('accounts');	
		}
        return $query;
    }
	public function view_account_ListCount($id)
	{
		$query = $this->db->where('user_id',$id)->count_all_results('accounts'); 
        return $query;
	}
	public function view_account_List($limit=10, $start=0, $id)
	{
		$query = $this->db->order_by('tran_count','desc')->limit($limit,$start)->where('user_id',$id)->get('accounts'); 
        return $query;
	}
}