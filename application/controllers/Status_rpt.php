<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Status_rpt extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Status_rpt_model');

        check_auth(); //check is logged in.
    }

    public function status_report_index() {
        theme('status_report_index');
    }

   

    public function view_business_status($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['status_Details'] = $this->db->get_where('status', ['id' => $id]);
        theme('view_business_status', $data);
    }

    public function deleteAjax() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'status');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} status");
        //Now delete permanently
        $this->db->where('id', $id)->delete('status');
        return true;
    }
	
 
    public function copy_business_status($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['status'] = singleDbTableRow($id, 'status');
       // $data['rolename'] =   singleDbTableRow($id, 'role');
        $data['business_name'] = $this->db->get('business_groups');
        $data['role'] = $this->db->get('role');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'copy_business_status')
                die('Error! sorry');
            //if($this->input->post('back') != 'all_status') die('Error! sorry');
            $this->form_validation->set_rules('status', 'Status ', 'required|trim');
            //	$this->form_validation->set_rules('business_category', 'Business Category ', 'required|trim');

            if ($this->form_validation->run() == true) {
                $insert = $this->Status_rpt_model->copy_business_status($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Status Updated Successfully...!!!');
                    redirect(base_url('Status_rpt/status_report_index'));
                }
            }
        }

        theme('copy_business_status', $data);
    }
  
   


/*****************************Reporting*******************************/

public function status_rpt_search_ListJson(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = singleDbTableRow($user_id)->rolename;
        $currentUser   = singleDbTableRow($user_id)->role;

        $status = $_POST['status'];
		$business_name = $_POST['business_name'];
		$lang_en = $_POST['lang_en'];
        $sf_time = $_POST['sf_time'];
        $st_time = $_POST['st_time'];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');


        $queryCount = $this->Status_rpt_model->search_status_report_listCount($status,$business_name,$lang_en,$sf_time,$st_time);


        $query = $this->Status_rpt_model->search_status_report_list($limit, $start ,$status,$business_name,$lang_en,$sf_time,$st_time);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {
				
								$sud = $this->db->get_where('users', ['id' => $r->created_by]);

                                if ($sud->num_rows() > 0) 
								{
                                foreach ($sud->result() as $row) 
								{
                                        $created_by = $row->first_name.' '.$row->last_name;
                                }
                                } else
								{
                                     $created_by =  "";
								}
								
								$md = $this->db->get_where('users', ['id' => $r->modified_by]);

                                if ($md->num_rows() > 0) 
								{
                                foreach ($md->result() as $row) 
								{
                                        $modified_by = $row->first_name.' '.$row->last_name;
                                }
                                } else
								{
                                     $modified_by =  "";
								}
						
								
								$query4 = $this->db->get_where('role', ['id' => $r->to_role]);

                                if ($query4->num_rows() > 0) 
								{
                                foreach ($query4->result() as $row) 
								{
                                        $to_role = $row->rolename;
                                }
                                } else
								{
                                     $to_role =  "";
								}
								
								$query5 = $this->db->get_where('business_groups', ['id' => $r->business_name]);

                                if ($query5->num_rows() > 0) 
								{
                                foreach ($query5->result() as $row) 
								{
                                        $business_name = $row->business_name;
                                }
                                } else
								{
                                     $business_name =  "";
								}
							
							
				
								
							


				
				 //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Status_rpt/view_business_status/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
						$button .= '<a class="btn btn-warning" href="' . base_url('Status_rpt/copy_business_status/' . $r->id) . '" data-toggle="tooltip" title="copy">
						<i class="fa fa-align-justify"></i> copy</a>';
				  if ($currentUser == 'admin') {
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
						 }
				

                $data['data'][] = array(
                    $button,
                    $r->status,
                    $business_name,
                    $to_role,
                    $r->view_status,
					$r->lang_en,
                   date("Y-m-d H:i:s",$r->created_at),
					 $created_by,
					  date("Y-m-d H:i:s",$r->modified_at),
                    $modified_by
                    
                   
                );
            }
		}
         else {
            $data['data'][] = array(
                'Records not found', '', '', '', '', '', '', '', '',''
            );
        }
        echo json_encode($data);
    }



}
