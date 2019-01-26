<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Support_model_report extends CI_Model {
	
//=========================assined list searching model-----------------------------------------------------------------
	
	
  public function assigned_ListCount($ticket_no,$business_id,$current_status,$modified_by,$created_by,$sf_time, $st_time)
	{
	 $user_info = $this->session->userdata('logged_user');
     $user_id = $user_info['user_id'];
	 $rolename      = singleDbTableRow($user_id)->rolename;
	 $email   = singleDbTableRow($user_id)->email;
		
	  $search = $this->input->get('search');
        $searchValue = $search['value'];

        $searchByID = '';
		
		
		
		$condition="";
		if($ticket_no !='')
		{	
			if($condition != ""){
			$condition.="ticket_no = ".$ticket_no." ";
			}
			else{
				$condition.="ticket_no = '".$ticket_no."'";
			}
		}
		
		if($business_id !='')
		{
			if($condition != ""){
				$condition.=" AND business_id = '".$business_id."'";
			}
			else{
				$condition.="business_id = '".$business_id."'";
			}
		}
		if($current_status !='')
		{
			if($condition != ""){
				$condition.=" AND current_status = '".$current_status."'";
			}
			else{
				$condition.="current_status = '".$current_status."'";
			}
		}
		if($modified_by !='')
		{
			if($condition != ""){
				$condition.=" AND modified_by = '".$modified_by."'";
			}
			else{
				$condition.="modified_by = '".$modified_by."'";
			}
		}
		if($created_by !='')
		{
			if($condition != ""){
				$condition.=" AND created_by = '".$created_by."'";
			}
			else{
				$condition.="created_by = '".$created_by."'";
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
			$query = $this->db->where($where_array)->count_all_results('ticket_list');
		}
	
			else
		{
			$query = $this->db->count_all_results('ticket_list');
		}
		
        return $query;
	}
	
	/*================ ----*/
		public function search_assigned_List($limit = 10, $start = 0 ,$ticket_no,$business_id,$current_status,$modified_by,$created_by,$sf_time, $st_time)
	{
	 $user_info = $this->session->userdata('logged_user');
     $user_id = $user_info['user_id'];
	 $rolename      = singleDbTableRow($user_id)->rolename;
	 $email   = singleDbTableRow($user_id)->email;
		
	  $search = $this->input->get('search');
        $searchValue = $search['value'];

        $searchByID = '';
		
		
		
		$condition="";
		if($ticket_no !='')
		{	
			if($condition != ""){
			$condition.="ticket_no = ".$ticket_no." ";
			}
			else{
				$condition.="ticket_no = '".$ticket_no."'";
			}
		}
		
	 if($business_id !='')
		{
			if($condition != ""){
				$condition.=" AND business_id = '".$business_id."'";
			}
			else{
				$condition.="business_id = '".$business_id."'";
			}
		}
	if($current_status !='')
		{
			if($condition != ""){
				$condition.=" AND current_status = '".$current_status."'";
			}
			else{
				$condition.="current_status = '".$current_status."'";
			}
		}
		
	if($modified_by !='')
		{
			if($condition != ""){
				$condition.=" AND modified_by = '".$modified_by."'";
			}
			else{
				$condition.="modified_by = '".$modified_by."'";
			}
		}
		if($created_by !='')
		{
			if($condition != ""){
				$condition.=" AND created_by = '".$created_by."'";
			}
			else{
				$condition.="created_by = '".$created_by."'";
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
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('ticket_list');
		}
	
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('ticket_list');
		}
        return $query;
	
	}
//=========================end of-assined list searching model-----------------------------------------------------
	
		
	
	
	
	
	
	
	
	
}
