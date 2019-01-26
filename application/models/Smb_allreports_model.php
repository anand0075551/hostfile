<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smb_allreports_model extends CI_Model {

  
//sale report  
  
    
public function accounts_ListCount($sale_code, $sf_date, $st_date, $product, $location,$vendor)
	{
	 $user_info   = $this->session->userdata('logged_user');
     $user_id     = $user_info['user_id'];
	 $rolename    = singleDbTableRow($user_id)->rolename;
	 $email       = singleDbTableRow($user_id)->email;
		
	 $search      = $this->input->get('search');
     $searchValue = $search['value'];

       	
		
		$condition="";
		if($sale_code !='')
		{	
			if($condition != ""){
			$condition.="sale_code = '".$sale_code."'";
			}
			else{
				$condition.="sale_code = '".$sale_code."'";
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
		
		if($product != "")
			{
				$pro = '"name":"'.$product.'"';
				if($condition != ""){
					$condition.=" AND product_details LIKE '%$pro%'";
				}
				else{
					$condition.="product_details LIKE '%$pro%'";
				}
			}
		
		if($location != "")
			{	//"location":"1"
				$loc = '"location":"'.$location.'"';
				if($condition != ""){
					$condition.=" AND product_details LIKE '%$loc%'";
				}
				else{
					$condition.="product_details LIKE '%$loc%'";
				}
			}
		if($vendor != "")
			{
				$ven = '"vendor":"'.$vendor.'"';
				if($condition != ""){
					$condition.=" AND product_details LIKE '%$ven%'";
				}
				else{
					$condition.="product_details LIKE '%$ven%'";
				}
			}
		
					
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
public function search_account_List($limit = 10, $start = 0 , $sale_code, $sf_date, $st_date, $product, $location,$vendor)
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
			$condition.="sale_code = '".$sale_code."'";
			}
			else{
				$condition.="sale_code = '".$sale_code."'";
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
		
		if($product != "")
			{
				if($condition != ""){
					$condition.=" AND product_details LIKE '%$product%'";
				}
				else{
					$condition.="product_details LIKE '%$product%'";
				}
			}
		
		if($location != "")
			{	//"location":"1"
				$loc = '"location":"'.$location.'"';
				if($condition != ""){
					$condition.=" AND product_details LIKE '%$loc%'";
				}
				else{
					$condition.="product_details LIKE '%$loc%'";
				}
			}
		if($vendor != "")
			{
				$ven = '"vendor":"'.$vendor.'"';
				if($condition != ""){
					$condition.=" AND product_details LIKE '%$ven%'";
				}
				else{
					$condition.="product_details LIKE '%$ven%'";
				}
			}
			
	if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->where($where_array)->get('smb_sale');
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->get('smb_sale');
		}
        return $query;
	
	}

  
//Stock Report-----------------------

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
		
		
		
		if($rolename == 11){
			$condition="";
		}
		else{
			$condition =" added_by = '".$user_id."'";
		}
		
		if($product !='')
		{
			if($condition != ""){
				$condition.=" AND product = '".$product."'";
			}
			else{
				$condition.=" product = '".$product."'";
			}
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
	
	//listing stock after view
	public function view_stock_ListCount($id,$product,$added_by)
	{
		$query = $this->db->where('product',$product,'added_by',$added_by)->count_all_results('smb_stock'); 
		
        return $query;
	}
	public function view_stock_List($limit=10, $start=0, $id, $product, $added_by)
	{
	$query = $this->db->order_by('id','desc')->limit($limit,$start)->get_where('smb_stock', ['product'=>$product,'added_by'=>$added_by]); 
        return $query;
	}

//tax reports


  
public function tax_report_ListCount($sale_code, $sf_date, $st_date, $product, $location,$vendor,$business)
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
			$condition.="sale_code = '".$sale_code."'";
			}
			else{
				$condition.="sale_code = '".$sale_code."'";
			}
		}
		
		if($business !='')
		{	
			if($condition != ""){
			$condition.="business = '".$business."'";
			}
			else{
				$condition.="business = '".$business."'";
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
		
		if($product != "")
			{
				$pro = '"name":"'.$product.'"';
				if($condition != ""){
					$condition.=" AND product_details LIKE '%$pro%'";
				}
				else{
					$condition.="product_details LIKE '%$pro%'";
				}
			}
		
		if($location != "")
			{	//"location":"1"
				$loc = '"location":"'.$location.'"';
				if($condition != ""){
					$condition.=" AND product_details LIKE '%$loc%'";
				}
				else{
					$condition.="product_details LIKE '%$loc%'";
				}
			}
		if($vendor != "")
			{
				$ven = '"vendor":"'.$vendor.'"';
				if($condition != ""){
					$condition.=" AND product_details LIKE '%$ven%'";
				}
				else{
					$condition.="product_details LIKE '%$ven%'";
				}
			}
		
					
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
	
/*========tax report========*/
public function tax_report_List($limit = 10, $start = 0 , $sale_code, $sf_date, $st_date, $product, $location,$vendor,$business)
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
			$condition.="sale_code = '".$sale_code."'";
			}
			else{
				$condition.="sale_code = '".$sale_code."'";
			}
		}
		
		if($business !='')
		{	
			if($condition != ""){
			$condition.="business = '".$business."'";
			}
			else{
				$condition.="business = '".$business."'";
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
		
		if($product != "")
			{
				if($condition != ""){
					$condition.=" AND product_details LIKE '%$product%'";
				}
				else{
					$condition.="product_details LIKE '%$product%'";
				}
			}
		
		if($location != "")
			{	//"location":"1"
				$loc = '"location":"'.$location.'"';
				if($condition != ""){
					$condition.=" AND product_details LIKE '%$loc%'";
				}
				else{
					$condition.="product_details LIKE '%$loc%'";
				}
			}
		if($vendor != "")
			{
				$ven = '"vendor":"'.$vendor.'"';
				if($condition != ""){
					$condition.=" AND product_details LIKE '%$ven%'";
				}
				else{
					$condition.="product_details LIKE '%$ven%'";
				}
			}
			
	if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->where($where_array)->get('smb_sale');
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit,$start)->get('smb_sale');
		}
        return $query;
	
	}

	
//tax product report 
	
	
//Counting 
	 public function product_tax_listcount($product, $f_date, $t_date, $vendor, $sp_tax1,$sp_tax2,$sp_tax3,$sp_tax4,$sp_tax5,$pp_tax1,$pp_tax2,$pp_tax3,$pp_tax4,$pp_tax5){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
		$condition="";
		
		if($product !='')
		{
			$condition.="product = '".$product."'";
		}
		
		if($sp_tax1 !='')
		{
			if($condition != ""){
				$condition.="AND sp_tax1 = '".$sp_tax1."'";
			}
			else{
				$condition.="sp_tax1 = '".$sp_tax1."'";
			}
		}
		if($sp_tax2 !='')
		{
			if($condition != ""){
				$condition.="AND sp_tax2 = '".$sp_tax2."'";
			}
			else{
				$condition.="sp_tax2 = '".$sp_tax2."'";
			}
		}
		if($sp_tax3 !='')
		{
			if($condition != ""){
				$condition.="AND sp_tax3 = '".$sp_tax3."'";
			}
			else{
				$condition.="sp_tax3 = '".$sp_tax3."'";
			}
		}
		if($sp_tax4 !='')
		{
			if($condition != ""){
				$condition.="AND sp_tax4 = '".$sp_tax4."'";
			}
			else{
				$condition.="sp_tax4 = '".$sp_tax4."'";
			}
		}
		if($sp_tax5 !='')
		{
			if($condition != ""){
				$condition.="AND sp_tax5 = '".$sp_tax5."'";
			}
			else{
				$condition.="sp_tax5 = '".$sp_tax5."'";
			}
		}
		
		if($pp_tax1 !='')
		{
			if($condition != ""){
				$condition.="AND pp_tax1 = '".$pp_tax1."'";
			}
			else{
				$condition.="pp_tax1 = '".$pp_tax1."'";
			}
		}
		if($pp_tax2 !='')
		{
			if($condition != ""){
				$condition.="AND pp_tax2 = '".$pp_tax2."'";
			}
			else{
				$condition.="pp_tax2 = '".$pp_tax2."'";
			}
		}
		
		if($pp_tax3 !='')
		{
			if($condition != ""){
				$condition.="AND pp_tax3 = '".$pp_tax3."'";
			}
			else{
				$condition.="pp_tax3 = '".$pp_tax3."'";
			}
		}
		
		if($pp_tax4 !='')
		{
			if($condition != ""){
				$condition.="AND pp_tax4 = '".$pp_tax4."'";
			}
			else{
				$condition.="pp_tax4 = '".$pp_tax4."'";
			}
		}
		if($pp_tax5 !='')
		{
			if($condition != ""){
				$condition.="AND pp_tax5 = '".$pp_tax5."'";
			}
			else{
				$condition.="pp_tax5 = '".$pp_tax5."'";
			}
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
	public function product_tax_list($limit = 10, $start = 0 , $product, $f_date, $t_date, $vendor, $sp_tax1,$sp_tax2,$sp_tax3,$sp_tax4,$sp_tax5,$pp_tax1,$pp_tax2,$pp_tax3,$pp_tax4,$pp_tax5){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
		
		
		if($rolename == 11){
			$condition="type = 'sold'";
		}
		else{
			$condition =" added_by = '".$user_id."' AND type = 'sold' ";
		}
		
		if($product !='')
		{
			if($condition != ""){
				$condition.=" AND product = '".$product."'";
			}
			else{
				$condition.=" product = '".$product."'";
			}
		}
		
		if($sp_tax1 !='')
		{
			if($condition != ""){
				$condition.="AND sp_tax1 = '".$sp_tax1."'";
			}
			else{
				$condition.="sp_tax1 = '".$sp_tax1."'";
			}
		}
		if($sp_tax2 !='')
		{
			if($condition != ""){
				$condition.="AND sp_tax2 = '".$sp_tax2."'";
			}
			else{
				$condition.="sp_tax2 = '".$sp_tax2."'";
			}
		}
		if($sp_tax3 !='')
		{
			if($condition != ""){
				$condition.="AND sp_tax3 = '".$sp_tax3."'";
			}
			else{
				$condition.="sp_tax3 = '".$sp_tax3."'";
			}
		}
		if($sp_tax4 !='')
		{
			if($condition != ""){
				$condition.="AND sp_tax4 = '".$sp_tax4."'";
			}
			else{
				$condition.="sp_tax4 = '".$sp_tax4."'";
			}
		}
		if($sp_tax5 !='')
		{
			if($condition != ""){
				$condition.="AND sp_tax5 = '".$sp_tax5."'";
			}
			else{
				$condition.="sp_tax5 = '".$sp_tax5."'";
			}
		}
		
		if($pp_tax1 !='')
		{
			if($condition != ""){
				$condition.="AND pp_tax1 = '".$pp_tax1."'";
			}
			else{
				$condition.="pp_tax1 = '".$pp_tax1."'";
			}
		}
		if($pp_tax2 !='')
		{
			if($condition != ""){
				$condition.="AND pp_tax2 = '".$pp_tax2."'";
			}
			else{
				$condition.="pp_tax2 = '".$pp_tax2."'";
			}
		}
		
		if($pp_tax3 !='')
		{
			if($condition != ""){
				$condition.="AND pp_tax3 = '".$pp_tax3."'";
			}
			else{
				$condition.="pp_tax3 = '".$pp_tax3."'";
			}
		}
		
		if($pp_tax4 !='')
		{
			if($condition != ""){
				$condition.="AND pp_tax4 = '".$pp_tax4."'";
			}
			else{
				$condition.="pp_tax4 = '".$pp_tax4."'";
			}
		}
		if($pp_tax5 !='')
		{
			if($condition != ""){
				$condition.="AND pp_tax5 = '".$pp_tax5."'";
			}
			else{
				$condition.="pp_tax5 = '".$pp_tax5."'";
			}
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
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('smb_stock'); 
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_stock'); 
		}
		
		return $query;
	}
  



	
}