<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Courier_report_detials extends CI_Controller {
function __construct(){
parent:: __construct();

$this->load->model('Courier_report_detials_model');

check_auth(); //check is logged in.
}

		
    /* Amith Report --- Courier Pending Rport */
	/* ==============================================*/ 
	
public function report_pending_courier_list() {

        theme('report_pending_courier_list');
    }
	
	/*============================================*/
	
public function accounts_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$cons_no = $_POST['cons_no'];
		$status = $_POST['status'];
		
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');


		$queryCount = $this->Courier_report_detials_model->accounts_ListCount($cons_no,$status,$sf_time,$st_time);
		
		$query = $this->Courier_report_detials_model->search_account_List($limit, $start ,$cons_no,$status,$sf_time,$st_time);
		
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
		   
			  $button = '';
					$button .= '<a class="btn btn-primary editBtn" href="' . base_url('Courier_report_detials/view_pending_courier/'.$r->id ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

				
                $get_pay_type = $this->db->get_where('users', ['id'=>$r->done_by]);
					foreach($get_pay_type->result() as $p);
				$done_by = $p->first_name." ".$p->last_name;
					 
				$query2 = $this->db->get_where('pincode', ['id' => $r->current_pincode,]);
				if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
						$pincode = $row2->pincode;
				}
				} else {
					$pincode =  " ";
				}		

				$query3 = $this->db->get_where('pincode', ['id' => $r->receiver_pincode,]);
				if ($query3->num_rows() > 0) {
					foreach ($query3->result() as $row3) {
						$receiver_pincode = $row3->pincode;
				}
				} else {
					$receiver_pincode =  " ";
				}					
			
		            $data['data'][] = array(
					 $button,
					$r->cons_no,
                    $pincode,    
                    $receiver_pincode,
                    $r->current_location,
                    $r->receiver_location,
                    $r->status,
                    date('d-m-Y', $r->modified_at),
                    $r->comments,
                    $done_by,
               );
		}
}
		else{
			$data['data'][] = array(
				'Consumers are not Available' , '', '','', '','','','','',''
			);
		
		}
		echo json_encode($data);

	}
	
	/* =========================================*/
	//pendingcourier Json listing

/*================================================*/
	
	// Pending_Courier Status view button file


	
	 public function view_pending_courier($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['Dashbord'] = $this->db->get_where('cms_courier_status', ['id' => $id]);
        theme('view_pending_courier', $data);
    }
	/*=====================  Amith pending courier End =========================*/	
		
		
	
		
	
		
    /******** Lokesh  --- Courier Rport************/
	
//Courier Report 
 public function view_courier_report_detials() {

        theme('view_courier_report_detials');
    }

// Corier view button file

 public function view_rpt_courier($cid) {
 $data['cms_courier'] = $this->db->get_where('cms_courier',['cid'=> $cid]);
        theme('view_rpt_courier', $data);
    }
		
public function courier_search_ListJson4(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$cons_no = $_POST['cons_no'];
		$status = $_POST['status'];
		$shipper_pincode = $_POST['shipper_pincode'];
		$business_group = $_POST['business_group'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');


		$queryCount = $this->Courier_report_detials_model->search_courier_ListCount4($cons_no,$status,$shipper_pincode,$business_group,$sf_time, $st_time);
		
		$query = $this->Courier_report_detials_model->search_courier_List4($limit, $start ,$cons_no,$status,$shipper_pincode,$business_group,$sf_time, $st_time);
		
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
	
			$query2 = $this->db->get_where('users', ['id' => $r->created_by]);

					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$created_by =  $row2->first_name;
					}
					} else {
					$created_by =  " ";
					}
              
			  $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Courier_report_detials/view_rpt_courier/'.$r->cid ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

			$get_pay_type = $this->db->get_where('users', ['id'=>$r->ship_name]);
					foreach($get_pay_type->result() as $p);
				$ship_name = $p->first_name." ".$p->last_name;
				
			$get_pay_type = $this->db->get_where('users', ['id'=>$r->assigned_to]);
					foreach($get_pay_type->result() as $p);
				$assigned_to = $p->first_name." ".$p->last_name;
				
			$get_pay_type = $this->db->get_where('users', ['id'=>$r->created_by]);
					foreach($get_pay_type->result() as $p);
				$created_by = $p->first_name." ".$p->last_name;
			
			/*$get_pay_type = $this->db->get_where('business_groups', ['id'=>$r->business_group]);
					foreach($get_pay_type->result() as $p);
				$business_group = $p->business_name;	*/
								$query2 = $this->db->get_where('pincode', ['id' => $r->shipper_pincode,]);
				if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
						$pincode = $row2->pincode;
				}
				} else {
					$pincode =  " ";
				}		

				$query3 = $this->db->get_where('pincode', ['id' => $r->receiver_pincode,]);
				if ($query3->num_rows() > 0) {
					foreach ($query3->result() as $row3) {
						$receiver_pincode = $row3->pincode;
				}
				} else {
					$receiver_pincode =  " ";
				}	
				
				$query4 = $this->db->get_where('business_groups', ['id' => $r->business_group,]);
				if ($query4->num_rows() > 0) {
					foreach ($query4->result() as $row4) {
						$business_group = $row4->business_name;
				}
				} else {
					$business_group =  " ";
				}
				
				
                $data['data'][] = array(
					 $button,
					$r->cons_no,
					'<b>Name:</b>'.$ship_name.'<br><b>Number:</b>'.$r->phone.'<br><b>Address:</b>'.$r->s_add.'<br><b>Pincode:</b>'.$pincode,
					'<b>Name:</b>'.$r->rev_name.'<br><b>Number:</b>'.$r->r_phone.'<br><b>Address:</b>'.$r->r_add.'<br><b>Pincode:</b>'.$receiver_pincode,
					$r->type,
					$r->cost,
					$r->weight,
					$r->smb_weight,
					$r->smb_volume,
					$r->invice_no,
					$r->qty,
					$r->book_mode,
					$r->freight,
					$r->mode,
					$r->pick_date,
					$r->pick_time,
					$r->status,
					$r->comments,
					$r->book_date,
					$created_by,
					$assigned_to,
					$business_group
               );
		}
}
		else{
			$data['data'][] = array(
				'Consumers are not Available' , '', '','', '','','','','','','','','','','','','','','','','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}
	
		  
public function get_total()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$cons_no = $_POST['cons_no'];
		$status = $_POST['status'];
		$shipper_pincode = $_POST['shipper_pincode'];
		$business_group = $_POST['business_group'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
	
		
		$query = $this->Courier_report_detials_model->get_total($cons_no,$status,$shipper_pincode,$business_group,$sf_time, $st_time);
		if($query -> num_rows() > 0) 
	  {
		  $weight = 0;
		  $qty = 0;
		  $cost = 0;
		 foreach($query->result() as $r)
		{
			$weight   = $weight + $r->weight;
			$qty  = $qty + $r->qty;
			$cost = $cost + $r->cost;
		}
	  }
	  else
	  {
		  $weight = 0;
		  $qty = 0;
		  $cost = 0;
	  }
	  echo "<table class='table table-striped table-bordered'>
				<tr>
				<th	>Total weight:</th>
				<td>".$weight."</td>	
				<th>Total Quantity:</th>
				<td>".$qty."</td>
				<th> Total Cost:</th>
				<td>".$cost."</td>
				</tr>
				</table>";
	}
}