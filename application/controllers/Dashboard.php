<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('login');
		$this->load->model('product_model');
		$this->load->model('earning_model');
		$this->load->model('notification_model');
		$this->load->model('agent_model');
		$this->load->model('user_model');
		$this->load->model('vouchers_model');
		$this->load->model('ledger_model');
		check_auth();
	}

	public function index()
	{   

		$data['assets']  = $this->ledger_model->totalAssets();
				
		$data['earnings'] = $this->earning_model->totalEarning();
		$data['referralEarnings'] = $this->earning_model->referralEarnings();
		$data['withdrawal'] = $this->earning_model->withdrawal();
		
		$data['totalAgent'] = $this->agent_model->agentListCount();
		$data['totalUser'] = $this->user_model->userListCount(); 
	 //restricted this area, only for admin
	//permittedArea();	
		$data['debits']  = $this->ledger_model->totalDebits();	
		$data['credits'] = $this->ledger_model->totalCredits();
		$data['wallet']  = $this->ledger_model->totalWallet();
		$data['usedwallet']  = $this->ledger_model->usedWallet();
		$data['totalInvoice'] = $this->product_model->invoiceListCount();

		//Wallet*****Loyality*****Discount*****Points///		
		$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();
		$data['loy_debit']  	= $this->ledger_model->total_loyality_debit();
		$data['loy_credit']  	= $this->ledger_model->total_loyality_credit();
		$data['dis_debit']  	= $this->ledger_model->total_discount_debit();
		$data['dis_credit']  	= $this->ledger_model->total_discount_credit();	
		
		$data['deposit']  		= $this->ledger_model->total_dep_cpa();
		$data['deposit2']  		= $this->ledger_model->total_dep_cpa2();
		$data['deposit3']  		= $this->ledger_model->total_dep_cpa3();		
		$data['deposit4']  		= $this->ledger_model->total_dep_cpa4();
		$data['deposit5']  		= $this->ledger_model->total_dep_cpa5();
		$data['smb_deposit']  		= $this->ledger_model->total_dep_smb();
		$data['restro_deposit']  		= $this->ledger_model->total_dep_restro();
		$data['billpay_deposit']  		= $this->ledger_model->total_dep_billpay();
		$data['consumer_sponsorship']  		= $this->ledger_model->consumer_sponsorship();
		$data['joining_offers']  		= $this->ledger_model->joining_offers();
///End of Admin*/
		$year = date('Y');
		
		$querySales = $this->earning_model->salesAmount();
	/*	$querySales = $this->db->query("SELECT MONTHNAME(FROM_UNIXTIME(created_at)) as m,
						sum(invoice.total_price) as amount
						FROM invoice
						WHERE YEAR(FROM_UNIXTIME(created_at)) = {$year}
						GROUP BY MONTH(FROM_UNIXTIME(created_at))");
*/

		//print_r($querySales->num_rows());

		$data['salesGraphJson'] = json_encode($querySales->result_array());

		theme('dashboard', $data);
	}


/*Terms & conditions */
	public function accept_terms()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$user_role = singleDbTableRow($user_id)->rolename;
		
		$get_term_ID = $this->db->get_where('term_condition', ['role'=>$user_role]);
		foreach($get_term_ID->result() as $l);
		 $term_ID = $l->term_ID;
		  $term_name = $l->file_name;
		  $term_otp = $l->otp;
		
	$where_array2 = " user_id = ".$user_id." AND role = ".$user_role." ";
  	  $user_terms = $this->db->order_by('id', 'asc')->where($where_array2)->get('term_condition_user');
	  if($user_terms->num_rows() >0)
	  {
		  foreach ($user_terms->result() as $t);
	  	  $t_id = $t->id;
		  $terms = [
		  			'term_ID'               =>$term_ID,
					'file_name'             =>$term_name,
					'user_id'         		=> $user_id,              
					'role'				    => $user_role,  			
					'terms_read'         	=> 1,
					'read_at'         	    => date('Y/m/d H:m'),
					'modified_at'            => time(),
					'modified_by'            => $user_id
				];
		$query7 = $this->db->where('id', $t_id)->update('term_condition_user', $terms);
		
	  }
	  else
	  {
		$terms = [
					'term_ID'               =>$term_ID,
					'file_name'             =>$term_name,
					'user_id'         		=> $user_id,              
					'role'				    => $user_role,  			
					'terms_read'         	=> 1,
					'read_at'         	    => date('Y/m/d H:m'),
					'created_at'            => time(),
					'created_by'            => $user_id
				];

		$query7 = $this->db->insert('term_condition_user', $terms);
	  }
		if($query7)
		{
			
			/*Get last track id*/
				$where_array4 = " term_ID = '".$term_ID."'  AND role = ".$user_role." ";
				$get_track_id = $this->db->where($where_array4)->get('term_condition_track');
				foreach($get_track_id->result() as $tt);
			 	$track_id = $tt->id;
			/*Get last OTP*/
			if($term_otp == 1)
			{
				$where_array3 = " term_ID = '".$term_ID."' AND user_id = ".$user_id." AND role = ".$user_role." ";
				$get_otp = $this->db->where($where_array3)->get('term_condition_otp');
				foreach($get_otp->result() as $o);
			 	$otp = $o->otp;
			}
			else
			{
				$otp = '';
			}
			
			/*insert into tracking table*/
			$terms = [
					'term_ID'               =>$term_ID,
					'track_id'              =>$track_id,
					'otp'                   =>$otp,
					'file_name'             =>$term_name,
					'user_id'         		=> $user_id,              
					'role'				    => $user_role,  			
					'terms_read'         	=> 1,
					'read_at'         	    => date('Y/m/d H:m'),
					'created_at'            => time(),
					'created_by'            => $user_id
				];

		$query8 = $this->db->insert('term_condition_user_track', $terms);
			//
			return true;
		}
	}
	public function send_otp()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$user_phn = singleDbTableRow($user_id, 'users')->contactno;
		$user_role = singleDbTableRow($user_id, 'users')->rolename;
		$first_name = singleDbTableRow($user_id, 'users')->first_name;
		$last_name = singleDbTableRow($user_id, 'users')->last_name;
		
		$get_term_ID = $this->db->get_where('term_condition', ['role'=>$user_role]);
		foreach($get_term_ID->result() as $l);
		 $term_ID = $l->term_ID;
		 
		 $otp = mt_rand(1000, 9999);
		 
		$data = [
					'term_ID'               => $term_ID,
					'user_id'         		=> $user_id,              
					'role'				    => $user_role,  			
					'otp'         	        => $otp,
					'created_at'            => time(),
					'created_by'            => $user_id
				];

		$query = $this->db->insert('term_condition_otp', $data);
		if($query)
		{
			 $send_now = $this->notification_model->Term_OTP($term_ID,$user_phn,$otp,$first_name,$last_name);
			 return true;
		}
	}
	public function check_otp()
	{
		$enter_otp=$_POST['otp'];
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$user_role = singleDbTableRow($user_id)->rolename;
		
		$where_array =" user_id = ".$user_id." AND role = ".$user_role." ";
		$get_otp = $this->db->where($where_array)->get('term_condition_otp');
		foreach($get_otp->result() as $l);
		 $otp = $l->otp;
		 if($otp == $enter_otp)
		 {
			 echo 1;
		 }
		 else
		 {
			 echo 0;
		 }
	}
/*/.Terms & conditions*/


	/**
	 * Log out now
	 */

	public function logout(){
		$this->login->set_user_offline();
		$this->session->unset_userdata('logged_user'); // unset logged_user
		$this->cart->destroy();
		redirect(base_url());
	}
	
	
}
