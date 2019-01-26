	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distribution_comissions_rpt_model extends CI_Model 
	{

    /**
     * @return bool
     */

	 
	
		/*************************Comissions Report*************************/
	
	public function search_distribution_comissions_listCount($business_group,$from_role,$to_user,$status,$sf_time, $st_time)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		
		if($business_group !='')
		{	
			if($condition != ""){
			$condition.="business_group = ".$business_group." ";
			}
			else{
				$condition.="business_group = '".$business_group."'";
			}
		}
		
		
		
		if($from_role !='')
		{
			if($condition != ""){
				$condition.=" AND from_role = '".$from_role."'";
			}
			else{
				$condition.="from_role = '".$from_role."'";
			}
		}
		
		if($to_user !='')
		{
			if($condition != ""){
				$condition.=" AND to_user = '".$to_user."'";
			}
			else{
				$condition.="to_user = '".$to_user."'";
			}
		}
		
		if($status !='')
		{
			if($condition != ""){
				$condition.=" AND status = '".$status."'";
			}
			else{
				$condition.="status = '".$status."'";
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
				
			$condition.=" AND DATE(from_date) >= '".$start_from."' AND DATE(from_date) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(from_date) >= '".$start_from."' AND DATE(from_date)<= '".$start_to."'";
			}
		}
		if($currentUser=='admin')
		{
			if($condition !='')
			{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('upper_commission');
			}
		
			else
			{
			$query = $this->db->count_all_results('upper_commission');
			}
		}
		
		else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array."AND created_by = '".$user_id."'";
                $query = $this->db->where($where_array)->count_all_results('upper_commission');
            }else
            {
            $where = array('created_by' => $user_id);
            $query = $this->db->where($where)->count_all_results('upper_commission');
        }
        } 
		
        return $query;
		
    }

	
	public function search_distribution_comissions_list($limit=10, $start=0,$business_group,$from_role,$to_user,$status,$sf_time, $st_time){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		
		
		if($business_group !='')
		{	
			if($condition != ""){
			$condition.="business_group = ".$business_group." ";
			}
			else{
				$condition.="business_group = '".$business_group."'";
			}
		}
		
		
		
		if($from_role !='')
		{
			if($condition != ""){
				$condition.=" AND from_role = '".$from_role."'";
			}
			else{
				$condition.="from_role = '".$from_role."'";
			}
		}
		
		if($to_user !='')
		{
			if($condition != ""){
				$condition.=" AND to_user = '".$to_user."'";
			}
			else{
				$condition.="to_user = '".$to_user."'";
			}
		}
		
		if($status !='')
		{
			if($condition != ""){
				$condition.=" AND status = '".$status."'";
			}
			else{
				$condition.="status = '".$status."'";
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
				
			$condition.=" AND DATE(from_date) >= '".$start_from."' AND DATE(from_date) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(from_date) >= '".$start_from."' AND DATE(from_date) <= '".$start_to."'";
			}
		}
	
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('upper_commission');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('upper_commission');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('upper_commission');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('upper_commission');
        }
        } 
        return $query;
	}
	
		/*=====================*/
	
	
}//last brace required