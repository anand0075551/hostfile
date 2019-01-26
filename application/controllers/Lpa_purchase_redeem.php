<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lpa_purchase_redeem extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('vouchers_model');
		$this->load->model('product_model');
		$this->load->model('lpa_purchase_redeem_model');
		$this->load->model('ledger_model');
		$this->load->model('notification_model');
		check_auth(); //check is logged in.
	}

	
	public function uniqueReferralCodeApi(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_user_id = $user_info['user_id'];
		$user_referral_code = singleDbTableRow($user_user_id)->referral_code;	
		
		$referredByCode = $this->input->post('referredByCode');
		
		if ($referredByCode != $user_referral_code )	
		{
			$query = $this->db->get_where('users', ['referral_code' => $referredByCode,  'active' => '1', 'rolename'=>41]);
			if($query->num_rows() > 0 )
			{
				$return = 'true';
			}else{
				$return = 'false';
			}
		}
		echo $return;
	}
	
	public function index()
	{
		theme('lpa_purchase_invoice');
	}


	public function invoiceListJson(){

		$user = loggedInUserData();
		$userID = $user['user_id'];


		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$search = $this->input->get('search');
		$searchValue = $search['value'];

		$searchByID = '';


		$queryCount = $this->lpa_purchase_redeem_model->invoiceListCount();

		$query = $this->lpa_purchase_redeem_model->invoiceList($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;


		if($query -> num_rows() > 0) {
			foreach ($query->result() as $r) {

				//Action Button
				$button = '';
				$button .= '<a class="btn btn-info editBtn"  href="' . base_url('product/invoice/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>
						 <a href="'.base_url('product/pdf_invoice/'.$r->id).'" class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> </a>
						';

				$data['data'][] = array(
				    $button,
					$r->id,
					singleDbTableRow($r->customer_id)->first_name.' '.singleDbTableRow($r->customer_id)->last_name,
					singleDbTableRow($r->sales_by)->first_name.' '.singleDbTableRow($r->sales_by)->last_name,
					date('d/m/Y h:i A', $r->created_at)
					
				);
			}
		}
		else{
			$data['data'][] = array(
				'Your Invoice are Not Yet Generated' , '', '', '', '', '', ''
			);
		}

		echo json_encode($data);

	}

	
	
	public function reedem_invoice()
	{
	
		theme('lpa_redeem_invoice');
	}


	
	public function reedem_invoiceListJson(){

		$user = loggedInUserData();
		$userID = $user['user_id'];


		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$search = $this->input->get('search');
		$searchValue = $search['value'];

		$searchByID = '';


		$queryCount = $this->lpa_purchase_redeem_model->reedem_invoiceListCount();

		$query = $this->lpa_purchase_redeem_model->reedem_invoiceList($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;


		if($query -> num_rows() > 0) {
			foreach ($query->result() as $r) {

				//Action Button
				$button = '';
				$button .= '<a class="btn btn-info editBtn"  href="' . base_url('product/invoice/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>
						 <a href="'.base_url('product/pdf_invoice/'.$r->id).'" class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> </a>
						';

				$data['data'][] = array(
				    $button,
					$r->id,
					singleDbTableRow($r->customer_id)->first_name.' '.singleDbTableRow($r->customer_id)->last_name,
					singleDbTableRow($r->sales_by)->first_name.' '.singleDbTableRow($r->sales_by)->last_name,
					date('d/m/Y h:i A', $r->created_at)
					
				);
			}
		}
		else{
			$data['data'][] = array(
				'Your Invoice are Not Yet Generated' , '', '', '', '', '', ''
			);
		}

		echo json_encode($data);

	}
	
	
	public function get_user(){
		$ref_id = $_POST['ref_id'];
		//echo $ref_id;
		$data = $this->db->get_where('users', ['referral_code'=>$ref_id]);
		
		if($data->num_rows() > 0){
			foreach($data->result() as $row1)
			{
			$user = "<input type='hidden' name='user_id' id='user_id' value='".$row1->id."'>" ;
			}
			
			
			$user .= "<table class='table table-bordered'>";
			$user .= "<tbody>";
			
			foreach($data->result() as $row)
			{	if($row->company_name != ""){
					$user .="<tr><th>Payee Name</th><td>".$row->company_name."</td></tr>";
				}
				else{
					$user .="<tr><th>Payee Name</th><td>".$row->first_name." ".$row->last_name."</td></tr>";
				}
				$user .="<tr><th>Payee Email</th><td>".$row->email."</td></tr>";
			}
			$user .="</tbody></table>";
		}
		else{
			$user = "<font color='red'>Sorry ! User Doesn't Exit.</font>";
		}
		
		echo $user;
	}
	
	
	public function order_history(){
		theme('lpa_order_history');
	}
	
	public function saleListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->lpa_purchase_redeem_model->saleListCount();


        $query = $this->lpa_purchase_redeem_model->salelist();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
               
				$button .= '<a class="btn btn-primary editBtn btn-sm" href="' . base_url('lpa_purchase_redeem/order_details/' . $r->id) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a>';
				
				if($r->active == 0){
					
					$button .= '<a class="btn btn-warning editBtn btn-sm" href="'.base_url('lpa_purchase_redeem/redeem_products/'. $r->id).'" data-toggle="modal" data-target="#token_box" title="Redeem"><i class="fa fa-credit-card"></i> Redeem </a>';
					
					$delivery_status = "Pending";
				}
				else{
					$delivery_status = "Delivered";
				}
				
				$items = '';
				$products = unserialize($r->cart_data);
				
				foreach($products as $cart_item){
					$items .= $cart_item['name'].", ";
				}
				
				$data['data'][] = array(
                    $button,
                    $r->transaction_id,
					date('d M, Y', $r->ref_date),
					$items,
					$r->grand_total,
					$delivery_status
				);
            }
        } else {
            $data['data'][] = array(
                'You have no orders', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
	public function order_details($id){
		$lpa_db = $this->load->database('loyality_purchase',true);
		$data['invoiceQuery'] = $lpa_db->get_where('orders', ['id'=>$id]);
		theme('lpa_invoice', $data);
	}
	
	public function redeem_products($id){
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'receive_values') die('Error! sorry');
			
			
			$this->form_validation->set_rules('referredByCode', 'Consumer Code', 'required|trim');
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->lpa_purchase_redeem_model->retailer_payment();
				if($insert)
				{
					$lpa_db = $this->load->database('loyality_purchase',true);
					$lpa_db->where('id', $id)->update('orders', ['active'=>1]);
					
					$this->session->set_flashdata('successMsg', 'Redeem Completed Sucessfully...!');
					redirect(base_url('lpa_purchase_redeem/reedem_invoice'));
				}
				else{
					$this->session->set_flashdata('successMsg', 'Error Occured');
					redirect(base_url('lpa_purchase_redeem/redeem_values'));
				}
			}
		}
		
		$lpa_db = $this->load->database('loyality_purchase',true);
		$data['invoiceQuery'] = $lpa_db->get_where('orders', ['id'=>$id]);
		theme('loyality_purchase_redeem', $data);
	}
	
}//last brace required
?>