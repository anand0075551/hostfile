<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Billpayment_Status_model extends CI_Model {

   

	
	
  
	/*================*/
	//Billpayment Status searching
	/*================*/

	public function search_billpayment_listCount($status,$usertxn,$operator,$txid,$number,$sf_time,$st_time){
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		
		$condition="";
		if($status !='')
		{	
			if($condition != ""){
			$condition.="status = ".$status." ";
			}
			else{
				$condition.="status = '".$status."'";
			}
		}
		
		if($usertxn !='')
		{
			if($condition != ""){
				$condition.=" AND usertxn = '".$usertxn."'";
			}
			else{
				$condition.="usertxn = '".$usertxn."'";
			}
		}
		
		if($operator !='')
		{
			if($condition != ""){
				$condition.=" AND operator = '".$operator."'";
			}
			else{
				$condition.="operator = '".$operator."'";
			}
		}
		
		if($txid !='')
		{
			if($condition != ""){
				$condition.=" AND txid = '".$txid."'";
			}
			else{
				$condition.="txid = '".$txid."'";
			}
		}
		
		
		if($number !='')
		{
			if($condition != ""){
				$condition.=" AND number = '".$number."'";
			}
			else{
				$condition.="number = '".$number."'";
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
			$query = $this->db->where($where_array)->count_all_results('billpay_status');
		}
		else
		{
			$query = $this->db->count_all_results('billpay_status');
		}
		
        return $query;
		
	}
	
	
	
	
	public function search_billpayment_list($limit=10, $start=0 ,$status,$usertxn,$operator,$txid,$number,$sf_time,$st_time){
		
				
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		
		if($status !='')
		{	
			if($condition != ""){
			$condition.="status = ".$status." ";
			
			}
			else{
				$condition.="status = '".$status."'";
			}
		}
		
		if($usertxn !='')
		{
			if($condition != ""){
				$condition.=" AND usertxn = '".$usertxn."'";
			}
			else{
				$condition.="usertxn = '".$usertxn."'";
			}
		}
		
		if($operator !='')
		{
			if($condition != ""){
				$condition.=" AND operator = '".$operator."'";
			}
			else{
				$condition.="operator = '".$operator."'";
			}
		}
		
		if($txid !='')
		{
			if($condition != ""){
				$condition.=" AND txid = '".$txid."'";
			}
			else{
				$condition.="txid = '".$txid."'";
			}
		}
		
		
		if($number !='')
		{
			if($condition != ""){
				$condition.=" AND number = '".$number."'";
			}
			else{
				$condition.="number = '".$number."'";
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
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('billpay_status');
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('billpay_status');
		}
        return $query;
	}
	
	/*================*/
	
		public function get_billpay_total($status,$usertxn,$operator,$txid,$number,$sf_time,$st_time){
		
				
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		
		if($status !='')
		{	
			if($condition != ""){
			$condition.="status = ".$status." ";
			
			}
			else{
				$condition.="status = '".$status."'";
			}
		}
		
		if($usertxn !='')
		{
			if($condition != ""){
				$condition.=" AND usertxn = '".$usertxn."'";
			}
			else{
				$condition.="usertxn = '".$usertxn."'";
			}
		}
		
		if($operator !='')
		{
			if($condition != ""){
				$condition.=" AND operator = '".$operator."'";
			}
			else{
				$condition.="operator = '".$operator."'";
			}
		}
		
		if($txid !='')
		{
			if($condition != ""){
				$condition.=" AND txid = '".$txid."'";
			}
			else{
				$condition.="txid = '".$txid."'";
			}
		}
		
		
		if($number !='')
		{
			if($condition != ""){
				$condition.=" AND number = '".$number."'";
			}
			else{
				$condition.="number = '".$number."'";
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
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('billpay_status');
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('billpay_status');
		}
        return $query;
	}


}
