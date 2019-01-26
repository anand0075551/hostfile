<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill_pay_refund_model extends CI_Model 
{
/* Create Events */
	public function import_data($order_id,$usertxn,$username,$amount,$status,$txn_time,$earning)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$data = [
			'order_ID'            => $order_id,
			'usertxn'             => $usertxn,
			'username'            => $username,
			'amount'              => $amount,
			'status'              => $status,
			'txn_time'            => $txn_time,
            'earning'             => $earning,
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('bill_pay_refund', $data);
			
		/* */
		if($query)
        {
			return true;
        }
        return false;
	}
/* /Create Events */
/* List */
	public function total_amount()
	{
		$get_amount = $this->db->get('bill_pay_refund');
		if($get_amount -> num_rows()>0)
		{
			$sum = 0;
			foreach($get_amount->result() as $a)
			{
				$amount = $a->amount;
				$sum = $sum + $amount;
			}
			return $sum;
		}
		else
		{
			return 0;
		}
	}
	public function total_earning()
	{
		$get_earning = $this->db->get('bill_pay_refund');
		if($get_earning -> num_rows()>0)
		{
			$sum = 0;
			foreach($get_earning->result() as $e)
			{
				$earning = str_replace( "'", "", $e->earning );
				$sum = $sum + $earning;
			}
			return $sum;
		}
		else
		{
			return 0;
		}
	}
	public function total_refund()
	{
		$amount = $this ->total_amount();
		$earning = $this ->total_earning();
		$refund = $amount - $earning;
		return $refund;
	}
	public function total_paid()
	{
		$get_paid = $this->db->get_where('bill_pay_refund', ['paid'=>1]);
		if($get_paid -> num_rows()>0)
		{
			$sum = 0;
			foreach($get_paid->result() as $p)
			{
				$paid = $p->amount ;
				$sum = $sum + $paid;
			}
			return $sum;
		}
		else
		{
			return 0;
		}
	}
	public function RefundListCount() 
	{
		
		$query = $this->db->count_all_results('bill_pay_refund');
		
		return $query;
	}
	public function RefundList($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	
	
	if($searchValue != '')																							
		{																												
			$table_name = "bill_pay_refund";	
			$where_array = " usertxn like '%".$searchValue."%'";														
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{										
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('bill_pay_refund');
		}
	
	return $query;
	}
/*ends */	
public function Pay_now($refund_amount,$receiver_referral_code,$refund_id) 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		$sender_referral_code = singleDbTableRow($user_id)->referral_code;
		/* transaction*/
		$pay_by_referral_code 	= 	$sender_referral_code;	// Sender's referral_code, ex : 5559990001
		$pay_to_referral_code 	= 	$receiver_referral_code;// Receiver's referral_code, ex : 5164830972
		$amount_to_pay		  	=	$refund_amount;			// Total amont to pay (or) transfer, ex : 100
		$pay_spec_type			=	70;				// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
		$transaction_remarks	=	'Bill Pay Refund';	// remarks to insert into invoice table, ex : "Transfer Values";
		$pm_mode				=	'wallet';			// points_mode, ex : wallet, loyality, discount.
		
		
		$insert = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);
		/* update */
		$data2 = [
           	'paid'               => 1,
			'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query2 = $this->db->where('id', $refund_id)->update('bill_pay_refund', $data2);
			if($query2)
			{
				return true;	
			}
			else
			{
				return false;
			}
	}
}
?>