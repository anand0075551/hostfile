<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_address_report extends CI_Controller {
function __construct(){
parent:: __construct();

	$this->load->model('user_address_report_model');

	check_auth(); //check is logged in.
	}
	
	
 public function view_user_address_list() {

//        theme('view_user_address_list');

 theme('Search_Near_by');
    }

 /*public function user_address_view($cid) {
 $data['user_address'] = $this->db->get_where('user_address',['cid'=> $cid]);
        theme('user_address_view', $data);
    }*/




	
public function search_user_address_ListJson()
	{
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
			
			if ($currentUser == 'admin')
			{
				$user_id = $_POST['user_id'];
				$rolename = $_POST['rolename'];
				$pincode = $_POST['pincode'];
				$state 	  = $_POST['state'];
				$district = $_POST['district'];
				$location_id = $_POST['location_id'];
				$sf_time = $_POST['sf_time'];
				$st_time = $_POST['st_time'];
			}
			else{
			$user_id = '';
			$rolename = '';
			$pincode = '';
			$state = '';
			$district = '';
			$location_id = '';
			$sf_time = '';
			$st_time = '';
			}
			
			$address_type = $_POST['address_type'];
			$pincode = $_POST['pincode'];
			
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');

	
		$queryCount = $this->user_address_report_model->search_user_address_ListCount($user_id,$address_type,$rolename,$pincode,$state,$district,$location_id,$sf_time,$st_time);
		

		$query = $this->user_address_report_model->search_user_address_List($limit, $start ,$user_id,$rolename,$address_type,$pincode,$state,$district,$location_id,$sf_time,$st_time);
		
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
			
			$query4 = $this->db->get_where('users', ['id' => $r->user_id]);

					if ($query4->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$user_id =  $row2->first_name.' '.$row2->last_name.'  ('.$row2->company_name.')';
					}
					} else {
					$user_id =  " ";
					}
			
			/*$query5 = $this->db->get_where('users', ['id' => $r->taluk]);

					if ($query5->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$contactno =  $row2->contactno;
					}
					} else {
					$contactno =  " ";
					}
			*/
			$query3 = $this->db->get_where('users', ['id' => $r->modified_by]);

					if ($query3->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$modified_by =  $row2->first_name;
					}
					} else {
					$modified_by =  " ";
					}
              
			  $query5 = $this->db->get_where('role', ['id' => $r->rolename]);

					if ($query5->num_rows() > 0) {
					foreach ($query5->result() as $row2) {
					$rolename =  $row2->rolename;
					}
					} else {
					$rolename =  " ";
					}
              
			  
			  $business_name ="";
			  if($r->business_name != ""){
				  $status =explode(",", $r->business_name);
				  foreach($status as $biz_id){
					  
					  $get_biz = $this->db->get_where('status', ['id' => $biz_id]);
					  foreach($get_biz->result() as $b);
					  
					  $business_name .= $b->status." ,";
				  }
			  }else{
				  $business_name="";
			  
			  }
			  
			  
			  
			    $button = '';
               /* $button.= '<a class="btn btn-primary editBtn" href="' . base_url('user_address_report/view_food_vch_rpt/'.$r->id) . '" data-toggle="tooltip" title="View">
					<i class="fa fa-eye"></i> </a>';*/
	if ($currentUser == 'admin')
			{
				$data['data'][] = array(
					//$button,
					$user_id,
					$business_name,
					$r->house_buildingno,
					
					$r->street_name,
					$r->location_id,
					$r->land_mark,
					$r->pincode,
					//$contactno,
					//$r->taluk,
					$r->district,
					$r->state,
					$r->country,
					$rolename,
				 
					date('d-m-Y H:i:s', $r->created_at),
					$created_by,
					date('d-m-Y H:i:s', $r->modified_at), 
					$modified_by
					);
			}			
					
					
	else{				
	if($r->rolename == 13 || $r->rolename == 41){
				 $data['data'][] = array(
					//$button,
					$user_id,
					$business_name,
					$r->house_buildingno,
					
					$r->street_name,
					$r->location_id,
					$r->land_mark,
					$r->pincode,
					//$contactno,
					//$r->taluk,
					//$r->district,
					//$r->state,
					//$r->country,
					$rolename,
				 
					date('d-m-Y H:i:s', $r->created_at),
					$created_by,
					date('d-m-Y H:i:s', $r->modified_at), 
					$modified_by
			);
			
		}	}	}
	}
		else{
			$data['data'][] = array(
				'Address not Available' , '', '','', '','','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}
	
}