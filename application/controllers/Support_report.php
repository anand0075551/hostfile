<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Support_report extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Support_model_report');

        check_auth(); //check is logged in.
    }

   public function assigned_list_report() {

        theme('assigned_list_report');
    }
	
	
	
/*===============view_support=============================*/

	 public function view_support($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['support_Details'] = $this->db->get_where('ticket_list', ['id' => $id]);
        theme('view_support', $data);
    }

	
	
//=================================assined support Status Search=============================================================

public function assined_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
	    $role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$ticket_no = $_POST['ticket_no'];
		$business_id = $_POST['business_id'];
		$current_status = $_POST['current_status'];
		$modified_by = $_POST['modified_by'];
		$created_by = $_POST['created_by'];
		
		
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');


		$queryCount = $this->Support_model_report->assigned_ListCount($ticket_no,$business_id,$current_status,$modified_by,$created_by,$sf_time, $st_time);
		 

		$query = $this->Support_model_report->search_assigned_List($limit, $start ,$ticket_no,$business_id,$current_status,$modified_by,$created_by,$sf_time, $st_time);
		
			
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
	
              
	
						
			
                //Action Button
                $button = '';
               
			    $button .= '<a class="btn btn-primary editBtn" href="' . base_url('support/view_support/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
				$button .= '<a class="btn btn-success editBtn" href="' . base_url('support/add_cs_comment/' . $r->id) . '"  data-toggle="modal" data-target="#myModal"  title="View">
						<i class="fa fa-edit"></i>track</a>';
			   
			   
                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;

/* 
                if ($rolename == '36' || $rolename == '11') {

                    $button .= '<a class="btn btn-success editBtn" href="' . base_url('support/add_cs_comment/' . $r->id) . '"  data-toggle="modal" data-target="#myModal"  title="View">
						<i class="fa fa-edit"></i>comment</a>';
                } */



                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;

              
				
		    $query = $this->db->get_where('business_groups', ['id' => $r->business_id,]);

                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        $business_id = $row->business_name;
                    }
                } else {
                    $business_id = " ";
                }
				
			$query = $this->db->get_where('status', ['id' => $r->current_status,]);

                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        $current_status = $row->status;
                    }
                } else {
                    $current_status = " ";
                }
				
			$query1 = $this->db->get_where('users', ['id' => $r->created_by,]);

                if ($query1->num_rows() > 0) {
                    foreach ($query1->result() as $row) {
                        $created_by = $row->first_name.' '.$row->last_name;
                    }
                } else {
                    $created_by = " ";
                }
			//
			$query2 = $this->db->get_where('users', ['id' => $r->modified_by,]);

                if ($query2->num_rows() > 0) {
                    foreach ($query2->result() as $row) {
                        $modified_by = $row->first_name.' '.$row->last_name;
                    }
                } else {
                    $modified_by = " ";
                }
				
			// Anand Begin
			 $query3 = $this->db->get_where('users', ['id' => $r->assigned_to,]);

                if ($query3->num_rows() > 0) {
                    foreach ($query3->result() as $row) {
                        $assigned_to = $row->first_name;
                    }
                } else {
                    $assigned_to = " ";
                } 
				//Anand End
				
				    $data['data'][] = array(
					$button,
					
                    $business_id,
                    $r->issue_type,
					$r->ticket_no,
					$assigned_to,  //Anand
					$r->issue_details,
					$current_status,
					$r->comments,
					$created_by,
				    date('d-m-Y', $r->created_at),
					$modified_by,
					date('d-m-Y', $r->modified_at)
					
					
                  
				
            	   );
        } 
	  }
		  

			
		else{
			$data['data'][] = array(
				'Consumers are not Available' , '', '','', '', '', '','', '', '', ''
			);
		
		}
		echo json_encode($data);

	}
	
	
//==============================end of assinded serch_support=================================================================	
	

}

//last 
