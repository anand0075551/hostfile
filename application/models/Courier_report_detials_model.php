	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Courier_report_detials_model extends CI_Model {

	function __construct(){
	parent:: __construct();
	
	check_auth(); //check is logged in.
	}
	
		/*  ======== Amith Courier Status Model statr =====*/
	
	public function accounts_ListCount($cons_no,$status,$sf_time,$st_time)
	{
	
		$user_info = $this->session->userdata('logged_user');
      $user_id = $user_info['user_id'];
	$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
	$search = $this->input->get('search');
       $searchValue = $search['value'];

      $searchByID = '';
		
		$condition="";
		if($cons_no !='')
		{	
			if($condition != ""){
			$condition.="cons_no = ".$cons_no." ";
			}
			else{
				$condition.="cons_no = '".$cons_no."'";
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
				
				$condition.=" AND DATE(FROM_UNIXTIME(modified_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(modified_at)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(modified_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(modified_at)) <= '".$start_to."'";
			}
		}
					
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('cms_courier_status');
		}
		else
		{
			$query = $this->db->count_all_results('cms_courier_status');
		}
		
        return $query;
	}
	
	public function search_account_List($limit = 10, $start = 0 ,$cons_no,$status,$sf_time,$st_time)
	{
	
		$user_info = $this->session->userdata('logged_user');
      $user_id = $user_info['user_id'];
	$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
	$search = $this->input->get('search');
       $searchValue = $search['value'];

      $searchByID = '';
		
		$condition="";
		if($cons_no !='')
		{	
			if($condition != ""){
			$condition.="cons_no = ".$cons_no." ";
			}
			else{
				$condition.="cons_no = '".$cons_no."'";
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
				
				$condition.=" AND DATE(FROM_UNIXTIME(modified_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(modified_at)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(modified_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(modified_at)) <= '".$start_to."'";
			}
		}
					
		if($condition !='')
		{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('cms_courier_status');
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('cms_courier_status');
		}
        return $query;
	
	}
		
	
		/* ======= Amith courier Status  Model End =====*/
		
		
		/* ====== Lokesh Corier report ====*/
	
	
	//corier Listing
	
   
	/*================*/
	//courier searching
	/*================*/
	public function search_courier_ListCount4($cons_no,$status,$shipper_pincode,$business_group,$sf_time, $st_time)
	{
		$user_info = $this->session->userdata('logged_user');
      $user_id = $user_info['user_id'];
	$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
	$search = $this->input->get('search');
       $searchValue = $search['value'];

      $searchByID = '';
      
		$condition="";
		if($cons_no !='')
		{
				$condition.="cons_no = '".$cons_no."'";
			
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
		
		if($shipper_pincode !='')
		{
			if($condition != ""){
				$condition.=" AND shipper_pincode = '".$shipper_pincode."'";
			}
			else{
				$condition.="shipper_pincode = '".$shipper_pincode."'";
			}
		}
		
		if($business_group !='')
		{
			if($condition != ""){
				$condition.=" AND business_group = '".$business_group."'";
			}
			else{
				$condition.="business_group = '".$business_group."'";
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
			$query = $this->db->where($where_array)->count_all_results('cms_courier');
		}
		else
		{
			$query = $this->db->count_all_results('cms_courier');
		}
		
        return $query;
	
	}
	public function search_courier_List4($limit=10, $start=0 ,$cons_no,$status,$shipper_pincode,$business_group,$sf_time, $st_time){
		  $limit = $this->input->post('length');
        $start = $this->input->post('start');
		$user_info = $this->session->userdata('logged_user');
      $user_id = $user_info['user_id'];
	$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
	$search = $this->input->get('search');
       $searchValue = $search['value'];

      $searchByID = '';
      
		$condition="";
		if($cons_no !='')
		{
				$condition.="cons_no = '".$cons_no."'";
			
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
		
		if($shipper_pincode !='')
		{
			if($condition != ""){
				$condition.=" AND shipper_pincode = '".$shipper_pincode."'";
			}
			else{
				$condition.="shipper_pincode = '".$shipper_pincode."'";
			}
		}
		
		if($business_group !='')
		{
			if($condition != ""){
				$condition.=" AND business_group = '".$business_group."'";
			}
			else{
				$condition.="business_group = '".$business_group."'";
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
			$where_array = $condition;
			$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get('cms_courier');
		}
		else
		{
			$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get('cms_courier');
		}
        return $query;
	}
	
	public function get_total($cons_no,$status,$shipper_pincode,$business_group,$sf_time, $st_time){
		  $limit = $this->input->post('length');
        $start = $this->input->post('start');
		$user_info = $this->session->userdata('logged_user');
      $user_id = $user_info['user_id'];
	$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
	$search = $this->input->get('search');
       $searchValue = $search['value'];

      $searchByID = '';
      
		$condition="";
		if($cons_no !='')
		{
				$condition.="cons_no = '".$cons_no."'";
			
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
		
		if($shipper_pincode !='')
		{
			if($condition != ""){
				$condition.=" AND shipper_pincode = '".$shipper_pincode."'";
			}
			else{
				$condition.="shipper_pincode = '".$shipper_pincode."'";
			}
		}
		
		if($business_group !='')
		{
			if($condition != ""){
				$condition.=" AND business_group = '".$business_group."'";
			}
			else{
				$condition.="business_group = '".$business_group."'";
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
			$where_array = $condition;
			$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->where($where_array )->get('cms_courier');
		}
		else
		{
			$query = $this->db->order_by('cid', 'desc')->limit($limit, $start)->get('cms_courier');
		}
        return $query;
	}
	
	
	
	
	
}