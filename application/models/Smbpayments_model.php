<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smbpayments_model extends CI_Model {

     public function tax_payment_listcount(){
		
		$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;
		
		
			$query = $this->db->count_all_results('smb_sale');
		
        return $query;
    }
		
    public function tax_payment_list($limit = 0, $start = 0)
	{		
										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_sale');
		
		
		
        return $query;
    }
	
	
	
	public function pay_to_vendor($vendor, $amnt, $sale_code, $vendor_invoice_no, $tran_count){
		
		$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		
		$pay_data = [
            'vendor_id'         	=> $vendor,
            'vendor_invoice_no'     => $vendor_invoice_no,
            'sale_code'         	=> $sale_code,
            'vendor_pay_amount'     => $amnt,
            'tran_count'         	=> $tran_count,
			'status'				=> 'paid',
            'created_at'            => time(),
            'created_by'            => $user_id,
            'modified_at'           => time(),
        ];
		
		$query = $this->db->insert('smb_vendor_payment', $pay_data);
		
		
		$tranx_remark = "For Sale Code-".$sale_code." And For Vendor Invoice No-".$vendor_invoice_no;
		
		$grand_total = $this->input->post('paybal_amount');
		//loged user details
		$payment_reciever       = singleDbTableRow($vendor)->referral_code;
		
		//get_pay_type
		$get_biz = $this->db->get_where('smb_sale',['sale_code'=>$sale_code]);
		foreach($get_biz->result() as $biz);
		$biz_id = $biz->business;
		
		$pay_type = singleDbTableRow($biz_id, 'business_groups')->pay_type;
		
		
		//payment_model
		$pay_by_referral_code 	= 	'5382610497' ;		
		$pay_to_referral_code 	= 	$payment_reciever;		
		$amount_to_pay		  	=	$amnt;			
		$pay_spec_type			=	$pay_type;			
		$transaction_remarks	=	'Vendor Payment Processed.<br>For Sale Code-'.$sale_code.' And For Vendor Invoice No-'.$vendor_invoice_no;	
		$pm_mode				=	'wallet';				
		
		
		$insert = $this->smb_payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode,$tranx_remark);
		
		
		if($query && $insert){
			return true;
		}
		return false;
	}
	
	
	public function all_vendor_payments_listcount(){
        $query = $this->db->count_all_results('smb_vendor_payment');
        return $query;
    }

    public function all_vendor_payments_list($limit = 0, $start = 0){
        $query = $this->db->order_by('created_at', 'desc')->limit($limit, $start)->get('smb_vendor_payment');
        return $query;
    }
	
	
	
	public function vendor_payments_search_Listcount($vendor){
		
		$condition = "";
		
		if($vendor != ""){
			if($condition != ""){
				$condition.=" AND vendor_id = '".$vendor."'";
			}
			else{
				$condition.="vendor_id = '".$vendor."'";
			}
		}
		
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('smb_vendor_payment'); 
		}
		else
		{
			$query = $this->db->count_all_results('smb_vendor_payment'); 
		}
        return $query;
		
	}
	
	
	public function vendor_payments_search_List($limit, $start, $vendor){
		
		$condition = "";
		
		if($vendor != ""){
			if($condition != ""){
				$condition.=" AND vendor_id = '".$vendor."'";
			}
			else{
				$condition.="vendor_id = '".$vendor."'";
			}
		}
		
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('smb_vendor_payment'); 
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_vendor_payment');	
		}
		
		return $query;
	}
	
	
	
	public function search_payment_ListCount($vendor){
		$condition = "";
		
		if($vendor != ""){
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
	
	public function search_payment_List($limit, $start, $vendor){
		$condition = "";
		
		if($vendor != ""){
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
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('smb_sale'); 
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_sale');	
		}
        
        return $query;
	}
	
	
}