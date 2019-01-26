<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Smb_payments extends CI_Controller {
	
	function __construct(){
		parent:: __construct();
		$this->load->model('smbpayments_model');
		$this->load->model('smb_payment_model');
		$this->load->model('notification_model');

		check_auth(); //check is logged in.
	}

	public function vendor_payment()
	{
		theme('vendor_payment');
	}	
	
	public function payment_list(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		
		$vendor   		= $_POST['vendor'];
		
		$limit       = $this->input->POST('length');
		$start       = $this->input->POST('start');


		$queryCount = $this->smbpayments_model->search_payment_ListCount($vendor);
		$query = $this->smbpayments_model->search_payment_List($limit, $start, $vendor);
		
		$draw = $this->input->POST('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		
				
	if($query ->num_rows() > 0) 
	  {
		  
		foreach($query->result() as $r){
			
		//Action Button
		$button = '';
			
		$product_details = json_decode($r->product_details, true);
		$product_price = 0;
		$tax = 0;
		$shipping = 0;
		$total = 0;
		
		foreach($product_details as $p){
			$location_id = $p['location'];
			$vendor_id = $p['vendor'];
			$product_id = $p['id'];
			
			if($vendor_id == $vendor){
				$product_price  += $p['subtotal'];
				$tax            += $p['tax'];
				$shipping       += $p['shipping_cost'];
			}
		}
		$total += $product_price + $tax + $shipping;
		

		
		$get_pay_sts = $this->db->get_where('smb_vendor_payment', ['sale_code'=>$r->sale_code, 'vendor_id'=>$vendor]);
		if($get_pay_sts->num_rows() > 0){
			foreach($get_pay_sts->result() as $v_paid);
			$pay_date = date('d M, Y ',$v_paid->created_at).', at '.date('h:i a',$v_paid->created_at);
			$button .=  '<button class="btn btn-xs btn-warning disabled">Paid On ('.$pay_date.')</button>';
		}
		else{
			$button .= '<a href="'.base_url('smb_payments/pay_to_vendor/?v='. $vendor.'&id='. $r->sale_code.'&amnt='. $product_price).'" class="btn btn-xs btn-success">Pay To Vendor</a>';
		}
		
		$get_loc = $this->db->get_where('location_id',['id'=>$location_id]);		
		if($get_loc->num_rows() > 0){
			foreach($get_loc->result() as $my_loc);
			$location = $my_loc->location;
		}			
		else{
			$location = "Not Mentioned";
		}
		
		
		$data['data'][] = array(
			singleDbTableRow($r->business, 'business_groups')->business_name,
			date('d-m-Y', $r->sale_datetime),
			$r->sale_code,
			$location,
			number_format($total,2),
			number_format($product_price,2),
			$button
		);
			
		     
          }
	  }
		else{
			$data['data'][] = array(
				'No Records Found' , '', '','', '', '', ''
			);
		
		}
		echo json_encode($data);
	}
	
	
	
	
	public function tax_payment()
	{
		// permittedArea();
		theme('tax_payment');
	}
	
	public function tax_payment_list()
	{
		$limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		
		/* months*/
		$today=date('Y-m-d');
		$year = date('Y');
		$year_start = "{$year}-01-01";
		$start    = (new DateTime($year_start))->modify('first day of this month');
		$end      = (new DateTime($today))->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);
		$cnt=1;
	
		foreach ($period as $dt) {
				$month1 = date_parse_from_format("Y-m-d", $dt->format("Y-m-d"));
				$month = $month1["month"];
				$month2 = date_parse_from_format("Y-m-d", $today);
				$current_month = $month2["month"];
				
				if($month == $current_month)
				{
					$last_day =$today;
				}
				else
				{
					$last_day = date('Y-m-t', strtotime($dt->format("Y-m-d")));
				}
				
				$total_sales = $this->smbpayments_model->total_sales($dt->format("Y-m-d"),$last_day);
				$total_tax = $this->smbpayments_model->total_tax($dt->format("Y-m-d"),$last_day);
				
				if($month == $current_month)
				{
					$button ="Please wait for the  month end";
				}
				else if($total_tax <=0)
				{
					$button = '<a class="btn btn-secondry editBtn" href="" title="Got it" disabled>
						<i class="fa fa-thumbs-down"> No sales</i> </a>';
				}
						
				$data['data'][] = array(
					
					$dt->format("Y-m-d").'<input type="hidden" id="'.$cnt.'from_date" value="'.$dt->format("Y-m-d").'">',
					$last_day.'<input type="hidden" id="'.$cnt.'end_date" value="'.$last_day.'">',
					number_format($total_sales,2),
					number_format($total_tax,2),
					$button
					
				);
			}
		
		echo json_encode($data);
		
	}
	
	public function pay_to_vendor(){
		$vendor = $_GET['v'];
		$amnt = $_GET['amnt'];
		$sale_code = $_GET['id'];
		
		
	
		$result_count  	= $this->db->get_where('smb_vendor_payment',['vendor_id'=>$vendor]);		
		if($result_count -> num_rows() > 0) 
		{
			foreach ($result_count->result() as $r)
			{       $value 		= $r->tran_count;  	
					$tran_count = $value + 1;	
			}			
		}
		else {	
			$tran_count = '1';
		}
		
		$vendor_invoice_no = $vendor."/".$sale_code."/".$tran_count;
		
		$pay_to_vendor = $this->smbpayments_model->pay_to_vendor($vendor, $amnt, $sale_code, $vendor_invoice_no, $tran_count);
		if($pay_to_vendor){
			$this->session->set_flashdata('successMsg', 'Paid To Vendor Successfully...!!!');
			redirect(base_url('smb_payments/all_vendor_payments'));
		}
		else{
			echo "PAYMENT FAILED..!";
		}
	}
	
	public function all_vendor_payments()
	{
		// permittedArea();
		theme('all_vendor_payments');
	}
	
	public function all_vendor_payments_list(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->smbpayments_model->all_vendor_payments_listcount();

		
		$query = $this->smbpayments_model->all_vendor_payments_list($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0){
		foreach($query->result() as $r){
				
			$data['data'][] = array(
				date('d M, Y ',$r->created_at).', at '.date('h:i a',$r->created_at),
				//date('d-m-Y', $r->created_at),
				singleDbTableRow($r->vendor_id)->company_name,
				$r->sale_code,
				$r->vendor_invoice_no,
				number_format($r->vendor_pay_amount,2)				
			);
			}
		}else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','',''
			);
		}
		echo json_encode($data);
	}
	
	public function vendor_payments_search_List(){
		
		$vendor   		= $_POST['vendor'];
		
		$limit = $this->input->POST('length');
		$start = $this->input->POST('start');


		$queryCount = $this->smbpayments_model->vendor_payments_search_Listcount($vendor);

		$query = $this->smbpayments_model->vendor_payments_search_List($limit, $start, $vendor);

		$draw = $this->input->POST('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0){
		foreach($query->result() as $r){
				
			$data['data'][] = array(
				date('d M, Y ',$r->created_at).', at '.date('h:i a',$r->created_at),
				//date('d-m-Y', $r->created_at),
				singleDbTableRow($r->vendor_id)->company_name,
				$r->sale_code,
				$r->vendor_invoice_no,
				number_format($r->vendor_pay_amount,2)				
			);
			}
		}else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','',''
			);
		}
		echo json_encode($data);
	}

}
?>