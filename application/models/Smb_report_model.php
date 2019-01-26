<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smb_report_model extends CI_Model {

  
public function accounts_ListCount($sale_code, $buyer, $sf_date, $st_date)
	{
	 $user_info   = $this->session->userdata('logged_user');
     $user_id     = $user_info['user_id'];
	 $rolename    = singleDbTableRow($user_id)->rolename;
	 $email       = singleDbTableRow($user_id)->email;
		
	 $search      = $this->input->get('search');
     $searchValue = $search['value'];

        $searchByID = '';
		
		
		
		$condition="";
		if($sale_code !='')
		{	
			if($condition != ""){
			$condition.="sale_code = ".$sale_code." ";
			}
			else{
				$condition.="sale_code = '".$sale_code."'";
			}
		}
		
		if($buyer !='')
		{
			if($condition != ""){
				$condition.=" AND buyer = '".$buyer."'";
			}
			else{
				$condition.="buyer = '".$buyer."'";
			}
		}
		
	
		if($sf_date !='' && $st_date !='')
			{
				$start_fdt = new DateTime($sf_date);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_date);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_date !='' && $st_date !=''){
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(sale_datetime)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(sale_datetime)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(sale_datetime)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(sale_datetime)) <= '".$start_to."'";
			}
		}
		
		/*
		if($vendor1 !='')
		{
			if($condition != ""){
				$condition.=" AND added_by = '".$vendor1."'";
			}
			else{
				$condition.="added_by = '".$vendor1."'";
			}
		}
		
		
		if($shipping_address !='')
		{
			if($condition != ""){
				$condition.=" AND shipping_address = '".$shipping_address."'";
			}
			else{
				$condition.="shipping_address = '".$shipping_address."'";
			}
		}
		
		if($product !='')
		{
			if($condition != ""){
				$condition.=" AND product_details = '".$product."'";
			}
			else{
				$condition.="product_details = '".$product."'";
			}
		}
		
		
	*/
					
	if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('smb_sale');
		}
	
			else
		{
			$query = $this->db->count_all_results('smb_sale');
		}
		
        return $query;
	}
	
/*========sale report========*/
public function search_account_List($limit = 10, $start = 0 , $sale_code, $buyer, $sf_date, $st_date)
	{
	 $user_info = $this->session->userdata('logged_user');
     $user_id = $user_info['user_id'];
	 $rolename      = singleDbTableRow($user_id)->rolename;
	 $email   = singleDbTableRow($user_id)->email;
		
	  $search = $this->input->get('search');
        $searchValue = $search['value'];

        $searchByID = '';
		
		
		
		$condition="";
		if($sale_code !='')
		{	
			if($condition != ""){
			$condition.="sale_code = ".$sale_code." ";
			}
			else{
				$condition.="sale_code = '".$sale_code."'";
			}
		}
		
		if($buyer !='')
		{
			if($condition != ""){
				$condition.=" AND buyer = '".$buyer."'";
			}
			else{
				$condition.="buyer = '".$buyer."'";
			}
		}
		
		if($sf_date !='' && $st_date !='')
			{
				$start_fdt = new DateTime($sf_date);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_date);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_date !='' && $st_date !=''){
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(sale_datetime)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(sale_datetime)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(sale_datetime)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(sale_datetime)) <= '".$start_to."'";
			}
		}
				
	if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('smb_sale');
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_sale');
		}
        return $query;
	
	}


//Stock Report------------------------------------------------------------------------------------------

//Counting 
	 public function stock_listcount($product, $f_date, $t_date, $vendor){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
		$condition="";
		
		if($product !='')
		{
			$condition.="product = '".$product."'";
		}
		
		
		
		if($f_date !='' && $t_date !='')
			{
				$start_fdt = new DateTime($f_date);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($t_date);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($f_date !='' && $t_date !=''){
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(datetime)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(datetime)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(datetime)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(datetime)) <= '".$start_to."'";
			}
		}
		
		if($vendor !='')
		{
			if($condition != ""){
				$condition.="AND added_by = '".$vendor."'";
			}
			else{
				$condition.="added_by = '".$vendor."'";
			}
		}
		
		
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array )->count_all_results('smb_stock');
		}
	
			else
		{
			$query = $this->db->count_all_results('smb_stock');
		}
		
        return $query;
    }
	
//searching List	
	public function search_stock_list($limit = 10, $start = 0 , $product, $f_date, $t_date, $vendor){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
		$condition="";
		
		
		if($product !='')
		{
			$condition.="product = '".$product."'";
		}
		
		
		if($f_date !='' && $t_date !='')
			{
				$start_fdt = new DateTime($f_date);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($t_date);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($f_date !='' && $t_date !=''){
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(datetime)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(datetime)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(datetime)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(datetime)) <= '".$start_to."'";
			}
		}
		
		
		if($vendor !='')
		{
			if($condition != ""){
				$condition.="AND added_by = '".$vendor."'";
			}
			else{
				$condition.="added_by = '".$vendor."'";
			}
		}
		

					
		if($condition !='')
		{
			$where_array =$condition;
		}
		
		
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->order_by('id', 'desc')->group_by('product')->group_by('added_by')->limit($limit, $start)->where($where_array )->get('smb_stock'); 
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->group_by('product')->group_by('added_by')->limit($limit, $start)->get('smb_stock'); 
		}
		
		return $query;
	}
	
}