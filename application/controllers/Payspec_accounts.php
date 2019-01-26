<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payspec_accounts extends CI_Controller {

	function __construct(){
		parent:: __construct();
	//	$this->load->model('Payspec_accounts_model');

		check_auth(); //check is logged in.
	}
	
	public function index(){
		//restricted this area, only for admin
		permittedArea();

		theme('transaction_index');
	}
	
	public function get_sub_account()
	{
		$id = $_POST['parent_id'];
		$query = $this->db->get_where('acct_categories', ['parentid' => $id]);
		$data = '<option value="">Withdraw Sub-Accounts Type </option>';
		foreach($query->result() as $sub_account){
			$data.= '<option value="'.$sub_account->id.'">'.$sub_account->id.'-'.$sub_account->name.'</option>';
		}
		echo $data;
	}
	
	public function sub_account_transactions()
	{
		$pay_type = $_POST['acct_id'];
		if($pay_type != ""){
			$get_acct_name = $this->db->get_where('acct_categories', ['id'=>$pay_type]);
			foreach($get_acct_name->result() as $acct);
			$acct_name = $acct->name;
			
			$cpa_user_credit = $this->db->select_sum('credit')->get_where('accounts', ['points_mode'=>'wallet', 'pay_type' =>$pay_type]);
			foreach( $cpa_user_credit->result() as $cpa_user_credit);		
			$cpa_user_credit = $cpa_user_credit->credit;
			
			$total_credit = '<table class="table table-bordered table-responsive" style="background:white;">
								<tr>
									<th width="60%">'.$acct_name.'</th>
									<th width="40%" class="text-right"> '.number_format($cpa_user_credit,2).'</th>
								</tr>
							</table>';
		}
		else{
			$total_credit = " ";
		}
		echo $total_credit;	
	}
	
	public function get_total_amount()
	{
		$pay_type	 = $_POST['acct_id'];
		$amount		 = $_POST['amount'];
		$cpa_user_credit = $this->db->select_sum('credit')->get_where('accounts', ['points_mode'=>'wallet', 'pay_type' =>$pay_type]);
		foreach( $cpa_user_credit->result() as $cpa_user_credit);		
		$cpa_user_credit = $cpa_user_credit->credit;
		
	
		$total_credit = $cpa_user_credit + $amount;
		
		echo $total_credit;	
	}
	
	public function get_visible_amount()
	{
		$pay_type	 = $_POST['acct_id'];
		$amount		 = $_POST['amount'];
		$cpa_user_credit = $this->db->select_sum('credit')->get_where('accounts', ['points_mode'=>'wallet', 'pay_type' =>$pay_type]);
		foreach( $cpa_user_credit->result() as $cpa_user_credit);		
		$cpa_user_credit = $cpa_user_credit->credit;
		
	
		$total_credit = $cpa_user_credit + $amount;
		
		echo number_format($total_credit,2);	
	}
	
	public function main_account_transactions()
	{
		$pay_type = $_POST['acct_id'];
		$get_main_acct_name = $this->db->get_where('acct_categories', ['id'=>$pay_type]);
		foreach($get_main_acct_name->result() as $acct);
		$main_acct = $acct->name;
		$total_credit = '<table class="table table-bordered table-responsive well">
							<tr style="border-bottom:3px solid lightgray; font-size:16px;">
								<th>Main Account : '.$main_acct.'</th>
							</tr>
						</table>';
		
		$total_credit .= '<table class="table table-bordered table-responsive table-hover" style="background:white;">
		
						<tr class="well">
							<th>Sub Account Name</th>
							<th>Total CPA Transaction</th>
						</tr>';
		
		$cpa_total_credit = 0;
		
		
		$get_accts = $this->db->get_where('acct_categories', ['parentid'=>$pay_type]);
		foreach($get_accts->result() as $p){
			$total_credit .= '<tr>';
			$total_credit .= '<td>'.$p->name.'</td>';
			
			$cpa_user_credit = $this->db->select_sum('credit')->get_where('accounts', ['points_mode'=>'wallet', 'pay_type' =>$p->id]);
			foreach( $cpa_user_credit->result() as $cpa_user_credit);		
			$cpa_user_credit = $cpa_user_credit->credit;
			$total_credit .= '<td class="text-right">'.number_format($cpa_user_credit,2).'</td>';
			
			$cpa_total_credit = $cpa_total_credit + $cpa_user_credit;
			
			$total_credit .= '</tr>';
		}		
		$total_credit .= '</table>';
		
		echo $total_credit;
	}
	
	public function get_total_amount_main()
	{
		$pay_type = $_POST['acct_id'];
		//echo $pay_type;
		$cpa_total_credit = 0;
		$get_accts = $this->db->get_where('acct_categories', ['parentid'=>$pay_type]);
		foreach($get_accts->result() as $p){
			$cpa_user_credit = $this->db->select_sum('credit')->get_where('accounts', ['points_mode'=>'wallet', 'pay_type' =>$p->id]);
			foreach( $cpa_user_credit->result() as $cpa_user_credit);		
			$cpa_user_credit = $cpa_user_credit->credit;
			$cpa_total_credit = $cpa_total_credit + $cpa_user_credit;
		}		
		
		
		echo number_format($cpa_total_credit,2);	
	}
	
	public function pdf_invoice(){
	//	if($id == 0) setFlashGoBack('successMsg', 'Insufficient parameter');

	//	$data['invoiceQuery'] = $this->product_model->getInvoiceDetails($id);
	//	$data['invoiceItem'] = $this->product_model->getAllItemByInvoice($id);

		$this->load->library('pdf');
		$this->pdf->load_view('transaction_index');
		$this->pdf->render();
		$this->pdf->stream("invoice-id-".$id."-at-".date('d-m-Y-h:i').".pdf");

	}

	
}
?>