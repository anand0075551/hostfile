<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Billpayment_Status extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Billpayment_Status_model');
        //$this->load->model('Inventory_stocks_model');

        check_auth(); //check is logged in.
    }


/*============================================*/
//Billpayment Status Report 
 public function report_billpayment_status() {

        theme('report_billpayment_status');
    }
	
/*============================================*/


	
/*================================================*/
// Billpayment Status view button file


	
	 public function view_billpayment_status($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['Dashbord'] = $this->db->get_where('billpay_status', ['id' => $id]);
        theme('view_billpayment_status', $data);
    }
/*================================================*/
//Billpayment Status Search
public function billpayment_search_ListJson(){
	$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$status = $_POST['status'];
		$usertxn = $_POST['usertxn'];
		$operator = $_POST['operator'];
		$txid = $_POST['txid'];
		$number = $_POST['number'];
		$sf_time       = $_POST['sf_time'];
		$st_time       = $_POST['st_time'];
		
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
						

		$queryCount = $this->Billpayment_Status_model->search_billpayment_listCount($status,$usertxn,$operator,$txid,$number,$sf_time,$st_time);
		
		$query = $this->Billpayment_Status_model->search_billpayment_list($limit, $start,$status,$usertxn,$operator,$txid,$number,$sf_time,$st_time );
		

			$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
							
									
									  
						

			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Billpayment_Status/view_billpayment_Status/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						
						$get_user_id = $this->db->get_where('users', ['id'=>$r->user_id]);
			foreach($get_user_id->result() as $p);
			$user_id = $p->first_name.' '.$p->last_name;	
			
					$query2 = $this->db->get_where('services', ['jolo_code' => $r->operator]);

					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$operator =  $row2->opt_name;
					}
					} else {
					$operator =  " ";
					}
		
							$query1 = $this->db->get_where('error_table', ['id' => $r->error_code]);

					if ($query1->num_rows() > 0) {
					foreach ($query1->result() as $row1) {
					$error =  $row1->details;
					}
					} else {
					$error =  " ";
					}

			$data['data'][] = array(
				$button,
				$r->status,
				$r->usertxn,
				$operator,
				$r->amount,
				$r->txid,
				$r->operator_ref,
				$r->country,
				$r->number,
				$r->amount_deducted,
				$r->message,
				date("Y-m-d H:i:s",$r->time),
				$user_id,
				date("Y-m-d H:i:s",$r->created_at),
				$error
				);
		}
}
		else{
			$data['data'][] = array(
				'Records are not Available' , '', '','', '','','','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}
	
	
	public function get_billpay_total(){
	$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		$status = $_POST['status'];
		$usertxn = $_POST['usertxn'];
		$operator = $_POST['operator'];
		$txid = $_POST['txid'];
		$number = $_POST['number'];
		
		$sf_time       = $_POST['sf_time'];
		$st_time       = $_POST['st_time'];
		
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
						

		$query = $this->Billpayment_Status_model->get_billpay_total($status,$usertxn,$operator,$txid,$number,$sf_time,$st_time);
		
				if($query -> num_rows() > 0) 
	  {
		  $amounts = 0;
		 foreach($query->result() as $r)
		{
			$amounts = $amounts + $r->amount;
		}
	  }
	  else
	  {
		  $amounts = 0;
	  }
	  
	  	if($query -> num_rows() > 0) 
	  {
		  $amount_deduct = 0;
		 foreach($query->result() as $r)
		{
			$amount_deduct = $amount_deduct + $r->amount_deducted;
		}
	  }
	  else
	  {
		  $amount_deduct = 0;
	  }
	  
	  	if($query -> num_rows() > 0) 
	  {
		  $balance = 0;
		 foreach($query->result() as $r)
		{
			$balance = $amounts - $amount_deduct;
		}
	  }
	  else
	  {
		  $balance = 0;
	  }
	  
	   echo "<table class='table table-striped'>
	  <tr>
	  
	  <th>Total No.of recharge done :</th>
	  <td> ".$query -> num_rows()."</td>
	  </tr>
	  <tr>
	  <th>Total Amount:</th>
	  <td>".$amounts."</td>
	  </tr>
	  <tr>
	    <th>Amount Deducted:</th>
		<td>".number_format($amount_deduct)."</td>
		</tr>
	  <tr>
		  <th>balance:</th>
		  <td>".number_format($balance)."</td>
		  </tr>
	  
	  </table> <br><br>
	  ";
	}
	
}