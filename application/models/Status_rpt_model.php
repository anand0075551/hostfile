<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Status_rpt_model extends CI_Model {

   
	/*************************Report***************************/


 public function copy_business_status($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$bs = implode(",", $this->input->post('to_role'));
        if ($bs == '') {
            $bs = 0;
        }
        //set all data for inserting into database
        $data = [
            'status' => $this->input->post('status'),
            'business_name' => $this->input->post('business_name'),
            'to_role' => $bs,
            'lang_en' => $this->input->post('language_en'),
            'modified_by' => $user_id,
            'modified_at' => time()
        ];

        $query = $this->db->where('id', $id)->insert('status', $data);

        if ($query) {
            create_activity('Updated ' . $data['status'] . ' status'); //create an activity
            return true;
        }
        return false;
    }

//searching
	
	public function search_status_report_listCount($status,$business_name,$lang_en,$sf_time,$st_time)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		if($status !='')
		{
		 $condition.="status = '".$status."'";
			
		}
		
		if($business_name !='')
		{
			if($condition != ""){
				$condition.=" AND business_name = '".$business_name."'";
			}
			else{
				$condition.="business_name = '".$business_name."'";
			}
		}
		
		if($lang_en !='')
		{
			if($condition != ""){
				$condition.=" AND lang_en = '".$lang_en."'";
			}
			else{
				$condition.="lang_en = '".$lang_en."'";
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
		if($currentUser=='admin')
		{
			if($condition !='')
			{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('status');
			}
		
			else
			{
			$query = $this->db->count_all_results('status');
			}
		}
		
		else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array."AND created_by = '".$user_id."'";
                $query = $this->db->where($where_array)->count_all_results('status');
            }else
            {
            $where = array('created_by' => $user_id);
            $query = $this->db->where($where)->count_all_results('status');
        }
        } 
		
        return $query;
		
    }

	
	public function search_status_report_list($limit=10, $start=0,$status,$business_name,$lang_en,$sf_time, $st_time){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		
		$searchByID = '';
		$condition="";
		if($status !='')
		{
		 $condition.="status = '".$status."'";
			
		}
		
		if($business_name !='')
		{
			if($condition != ""){
				$condition.=" AND business_name = '".$business_name."'";
			}
			else{
				$condition.="business_name = '".$business_name."'";
			}
		}
		
		if($lang_en !='')
		{
			if($condition != ""){
				$condition.=" AND lang_en = '".$lang_en."'";
			}
			else{
				$condition.="lang_en = '".$lang_en."'";
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
				$condition.=" DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
		
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('status');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('status');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('status');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('status');
        }
        } 
        return $query;
	}
	

}

//last brace required
	