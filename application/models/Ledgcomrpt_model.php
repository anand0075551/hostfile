<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledgcomrpt_model extends CI_Model 
	{


	    function forms($forms)
    {
      $where_array = array( 'rolename' => $forms );
      $table_name="accounts";
       $query = $this->db->order_by('user_id', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 
	
		

	
		/*************************Ledger Report***************************/
	
	public function search_ledger_listCount($pay_type,$account_no,$rolename,$points_mode,$sf_time,$st_time)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		
		if($pay_type !='')
		{
			if($condition != ""){
				$condition.=" AND pay_type = '".$pay_type."'";
			}
			else{
				$condition.="pay_type = '".$pay_type."'";
			}
		}
		
		if($account_no !='')
		{	
			if($condition != ""){
			$condition.=" AND account_no = '".$account_no."'";
			}
			else{
				$condition.="account_no = '".$account_no."'";
			}
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
		if($currentUser=='admin')
		{
			if($condition !='')
			{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('accounts');
			}
		
			else
			{
			$query = $this->db->count_all_results('accounts');
			}
		}
		
		else
        {
           if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array."AND created_by = '".$user_id."'";
                $query = $this->db->where($where_array)->count_all_results('accounts');
            }else
            {
            $where = array('created_by' => $user_id);
            $query = $this->db->where($where)->count_all_results('accounts');
        }
        } 
		
        return $query;
		
    }

	
	public function search_ledger_list($limit, $start,$pay_type,$account_no,$rolename,$points_mode,$sf_time,$st_time){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		
		
		if($pay_type !='')
		{
			if($condition != ""){
				$condition.=" AND pay_type = '".$pay_type."'";
			}
			else{
				$condition.="pay_type = '".$pay_type."'";
			}
		}
		
		if($account_no !='')
		{	
			if($condition != ""){
			$condition.=" AND account_no = '".$account_no."'";
			}
			else{
				$condition.="account_no = '".$account_no."'";
			}
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
				$condition.=" DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
		
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('accounts');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('accounts');
			}
		}
		
		 else
        {
          if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('accounts');
            }else
            {
				
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('accounts');
       }
        } 
        return $query;
	}
		
		
		public function get_ledger_total($pay_type,$account_no,$rolename,$points_mode,$sf_time, $st_time){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		
		
		if($pay_type !='')
		{
			if($condition != ""){
				$condition.=" AND pay_type = '".$pay_type."'";
			}
			else{
				$condition.="pay_type = '".$pay_type."'";
			}
		}
		
		if($account_no !='')
		{	
			if($condition != ""){
			$condition.=" AND account_no = '".$account_no."' ";
			}
			else{
				$condition.="account_no = '".$account_no."'";
			}
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
				$condition.=" DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
		
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('accounts');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('accounts');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('accounts');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('accounts');
        }
        } 
        return $query;
	}
	
	
	
	
		/*************************Comissions Report***************************/
	
	public function search_comissions_listCount($identity,$acct_id,$from_role,$to_role, $sf_time, $st_time)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		
		if($identity !='')
		{
			if($condition != ""){
				$condition.=" AND identity = '".$identity."'";
			}
			else{
				$condition.="identity = '".$identity."'";
			}
		}
		
		if($acct_id !='')
		{	
			if($condition != ""){
			$condition.="acct_id = ".$acct_id." ";
			}
			else{
				$condition.="acct_id = '".$acct_id."'";
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
		
		if($to_role !='')
		{
			if($condition != ""){
				$condition.=" AND to_role = '".$to_role."'";
			}
			else{
				$condition.="to_role = '".$to_role."'";
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
			$query = $this->db->where($where_array)->count_all_results('commissions');
			}
		
			else
			{
			$query = $this->db->count_all_results('commissions');
			}
		}
		
		else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array."AND created_by = '".$user_id."'";
                $query = $this->db->where($where_array)->count_all_results('commissions');
            }else
            {
            $where = array('created_by' => $user_id);
            $query = $this->db->where($where)->count_all_results('commissions');
        }
        } 
		
        return $query;
		
    }

	
	public function search_comissions_list($limit=10, $start=0,$identity,$acct_id,$from_role,$to_role,$sf_time, $st_time){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		
		
		if($identity !='')
		{
			if($condition != ""){
				$condition.=" AND identity = '".$identity."'";
			}
			else{
				$condition.="identity = '".$identity."'";
			}
		}
		
		if($acct_id !='')
		{	
			if($condition != ""){
			$condition.="acct_id = ".$acct_id." ";
			}
			else{
				$condition.="acct_id = '".$acct_id."'";
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
		
		if($to_role !='')
		{
			if($condition != ""){
				$condition.=" AND to_role = '".$to_role."'";
			}
			else{
				$condition.="to_role = '".$to_role."'";
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
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('commissions');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('commissions');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('commissions');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('commissions');
        }
        } 
        return $query;
	}
		
		
		public function get_comissions_total($identity,$acct_id,$from_role,$to_role,$sf_time, $st_time){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		
		
		if($identity !='')
		{
			if($condition != ""){
				$condition.=" AND identity = '".$identity."'";
			}
			else{
				$condition.="identity = '".$identity."'";
			}
		}
		
		if($acct_id !='')
		{	
			if($condition != ""){
			$condition.="acct_id = ".$acct_id." ";
			}
			else{
				$condition.="acct_id = '".$acct_id."'";
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
		
		if($to_role !='')
		{
			if($condition != ""){
				$condition.=" AND to_role = '".$to_role."'";
			}
			else{
				$condition.="to_role = '".$to_role."'";
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
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('commissions');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('commissions');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('commissions');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('commissions');
        }
        } 
        return $query;
	}
	
	}//last brace required