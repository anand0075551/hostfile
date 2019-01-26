<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Support_model');

        check_auth(); //check is logged in.
    }

    public function index() {

        theme('all_support');
    }

    public function add_support() {
        //permittedArea();
        $data['business_name'] = $this->db->get('business_groups');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_support')
                die('Error! sorry');


            $this->form_validation->set_rules('business_id', 'business name', 'trim|required');
            $this->form_validation->set_rules('issue_details', 'issue details', 'trim|required');
            $this->form_validation->set_rules('issue_type', 'Issue type', 'trim|required');
            $this->form_validation->set_rules('ticket_no', 'ticket no', 'trim|required');


            if ($this->form_validation->run() == true) {
                $insert = $this->Support_model->add_support();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'your ticket Created Success');
                    redirect(base_url('support'));
                }
            }
        }

        theme('add_support', $data);
    }

    public function supportListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Support_model->supportListCount();


        $query = $this->Support_model->supportList($limit,$start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('support/view_support/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;
                //if ($rolename == '11' || $rolename == '36' ) { 


                if ($currentUser == 'admin') {
                    $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
							<i class="fa fa-trash"></i> </a>';
                }

                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;

                if ($rolename != '11') {

                    $button .= '<a class="btn btn-success editBtn" href="' . base_url('support/view_support_status/' . $r->ticket_no) . '" data-toggle="modal" data-target="#myModal" title="View">
				<i class="fa fa-eye" aria-hidden="true"></i>track</a>';
                }
                if ($rolename == '36' || '12' && $rolename != '11') {

                    $button .= '<a class="btn btn-warning editBtn" href="' . base_url('support/add_cs_comment/' . $r->id) . '"  data-toggle="modal" data-target="#myModal"  title="View">
						<i class="fa fa-edit"></i>comment</a>';
                }
                if ($rolename == '11') {

                    $button .= '<a class="btn btn-success editBtn" href="' . base_url('support/add_cs_comment/' . $r->id) . '"  data-toggle="modal" data-target="#myModal"  title="View">
						<i class="fa fa-edit"></i>track</a>';
                }


                $query = $this->db->get_where('business_groups', ['id' => $r->business_id,]);

                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        $biz_name = $row->business_name;
                    }
                } else {
                    $biz_name = " ";
                }

                $query1 = $this->db->get_where('status', ['id' => $r->current_status,]);
				
				
				
                if ($query1->num_rows() > 0) {
                    foreach ($query1->result() as $row) {
                        if ($row->status == 'Working In Progress') {
							
                            $currnt_status = "<font size='3'><div class='label label-primary'>$row->status</div></font>";
                        } else if ($row->status == 'Pending') {
							
                            $currnt_status = "<font size='3'><div class='label label-success'>$row->status</div></font>";
                        } else if ($row->status == 'Hold') {
							
                            $currnt_status = "<font size='3'><div class='label label-danger'>$row->status</div></font>";
                        } else if ($row->status == 'Active') {
							
                            $currnt_status = "<font size='3'><div class='label label-default'>$row->status</div></font>";
                        } else if ($row->status == 'Inactive') {
							
                            $currnt_status = "<font size='3'><div class='label label-info'>$row->status</div></font>";
                        }
						else if ($row->status == 'Completed') {
                            $currnt_status = "<font size='3'><div class='label label-info'>$row->status</div></font>";
                        }
						else if ($row->status == 'New Ticket') {
							
                            $currnt_status = "<font size='3'><div class='label label-info'>$row->status</div></font>";
                        }
                    }
                } else {
                    $currnt_status = "waiting for status";
                }
				
				$role = singleDbTableRow($r->created_by)->rolename;
				

                $data['data'][] = array(
                    $button,
                    $r->ticket_no,
                    $biz_name,
                    $r->issue_type,
                    $currnt_status,
					singleDbTableRow($r->created_by)->first_name." ".singleDbTableRow($r->created_by)->last_name,
					singleDbTableRow($role, 'role')->rolename
                );
            }
        } else {
            $data['data'][] = array(
                'You have no support list', '', '', '', '','',''
            );
        }
        echo json_encode($data);
    }

    public function assigned_list() {

        theme('assigned_list');
    }

    public function assignedListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Support_model->assignedListCount();


        $query = $this->Support_model->assignedList($limit,$start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-info primary" href="' . base_url('support/view_support/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;

                /*   if ($currentUser == 'admin'){
                  $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
                  <i class="fa fa-trash"></i> </a>';

                  } */


                if ($rolename == '36' || $rolename == '11') {

                    $button .= '<a class="btn btn-success editBtn" href="' . base_url('support/add_cs_comment/' . $r->id) . '"  data-toggle="modal" data-target="#myModal"  title="View">
						<i class="fa fa-edit"></i>comment</a>';
                }



                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;

                if ($rolename != '11') {


                    $button .= '<a class="btn btn-primary editBtn" href="' . base_url('support/view_support_status/' . $r->ticket_no) . '" data-toggle="modal" data-target="#myModal" title="View">
				
						<i class="glyphicon glyphicon-eye-open"></i>Track</a>';
                }

                $query = $this->db->get_where('business_groups', ['id' => $r->business_id,]);

                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        $biz_name = $row->business_name;
                    }
                } else {
                    $biz_name = " ";
                }



                $query1 = $this->db->get_where('status', ['id' => $r->current_status,]);

               if ($query1->num_rows() > 0) {
                    foreach ($query1->result() as $row) {
                        if ($row->status == 'Working In Progress') {
							
                            $currnt_status = "<font size='3'><div class='label label-primary'>$row->status</div></font>";
                        } else if ($row->status == 'Pending') {
							
                            $currnt_status = "<font size='3'><div class='label label-success'>$row->status</div></font>";
                        } else if ($row->status == 'Hold') {
							
                            $currnt_status = "<font size='3'><div class='label label-danger'>$row->status</div></font>";
                        } else if ($row->status == 'Active') {
							
                            $currnt_status = "<font size='3'><div class='label label-default'>$row->status</div></font>";
                        } else if ($row->status == 'Inactive') {
							
                            $currnt_status = "<font size='3'><div class='label label-info'>$row->status</div></font>";
                        }
						else if ($row->status == 'Completed') {
                            $currnt_status = "<font size='3'><div class='label label-info'>$row->status</div></font>";
                        }
						else if ($row->status == 'New Ticket') {
							
                            $currnt_status = "<font size='3'><div class='label label-info'>$row->status</div></font>";
                        }
                    }
                } else {
                    $currnt_status = "waiting for status";
                }
				
					
				//$role = singleDbTableRow($r->created_by)->rolename;
				
                $data['data'][] = array(
                    $button,
                    $r->ticket_no,
                    $biz_name,
                    $r->issue_type,
                    $currnt_status,
					singleDbTableRow($r->created_by)->first_name." ".singleDbTableRow($r->created_by)->last_name
					//singleDbTableRow($role, 'role')->rolename
					
                );

                /* 	else {
                  $data['data'][] = array(
                  'You have no support list', '', '', '', ''
                  );
                  } */
            }
        } else {
            $data['data'][] = array(
                'You have no support list', '', '', '', '',''
            );
        }
        echo json_encode($data);
    }

    //view support

    public function view_support($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['support_Details'] = $this->db->get_where('ticket_list', ['id' => $id]);
        theme('view_support', $data);
    }

    public function view_support_status($id) {

        $data['tid'] = $this->db->get_where('ticket_list', ['ticket_no' => $id]);

        theme('support_status', $data);
    }

    public function complete_support() {


        theme('complete_support');
    }

    public function completesupportListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Support_model->completesupportListCount();


        $query = $this->Support_model->completesupportList($limit,$start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('support/view_support/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;
                //if ($rolename == '11' || $rolename == '36' ) { 
                if ($currentUser == 'admin') {
                    $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
							<i class="fa fa-trash"></i> </a>';
                }


                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;

                if ($rolename != '11') {

                    $button .= '<a class="btn btn-success editBtn" href="' . base_url('support/view_support_status/' . $r->ticket_no) . '" data-toggle="modal" data-target="#myModal" title="View">
						<i class="glyphicon glyphicon-eye-open"></i> Track</a>';
                }

                $query = $this->db->get_where('business_groups', ['id' => $r->business_id,]);

                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        $biz_name = $row->business_name;
                    }
                } else {
                    $biz_name = " ";
                }
                $query1 = $this->db->get_where('status', ['id' => $r->current_status,]);

               if ($query1->num_rows() > 0) {
                    foreach ($query1->result() as $row) {
                        if ($row->status == 'Working In Progress') {
							
                            $currnt_status = "<font size='3'><div class='label label-primary'>$row->status</div></font>";
                        } else if ($row->status == 'Pending') {
							
                            $currnt_status = "<font size='3'><div class='label label-success'>$row->status</div></font>";
                        } else if ($row->status == 'Hold') {
							
                            $currnt_status = "<font size='3'><div class='label label-danger'>$row->status</div></font>";
                        } else if ($row->status == 'Active') {
							
                            $currnt_status = "<font size='3'><div class='label label-default'>$row->status</div></font>";
                        } else if ($row->status == 'Inactive') {
							
                            $currnt_status = "<font size='3'><div class='label label-info'>$row->status</div></font>";
                        }
						else if ($row->status == 'Completed') {
                            $currnt_status = "<font size='3'><div class='label label-info'>$row->status</div></font>";
                        }
						else if ($row->status == 'New Ticket') {
							
                            $currnt_status = "<font size='3'><div class='label label-info'>$row->status</div></font>";
                        }
                    }
                } else {
                    $currnt_status = "waiting for status";
                }
				
				$role = singleDbTableRow($r->created_by)->rolename;

                $data['data'][] = array(
                    $button,
                    $r->ticket_no,
                    $biz_name,
                    $r->issue_type,
                    $currnt_status,
					singleDbTableRow($r->created_by)->first_name." ".singleDbTableRow($r->created_by)->last_name,
					singleDbTableRow($role, 'role')->rolename
                );
            }
        } else {
            $data['data'][] = array(
                'You have no support list', '', '', '', '','',''
            );
        }
        echo json_encode($data);
    }

    public function not_complete() {


        theme('not_complete');
    }

    public function notcompleteListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Support_model->notcompleteListCount();


        $query = $this->Support_model->notcompleteList($limit,$start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-info editBtn" href="' . base_url('support/view_support/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;
                //if ($rolename == '11' || $rolename == '36' ) { 
                if ($currentUser == 'admin') {
                    $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
							<i class="fa fa-trash"></i> </a>';
                }

                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;

                if ($rolename != '11') {

                    $button .= '<a class="btn btn-success editBtn" href="' . base_url('support/view_support_status/' . $r->ticket_no) . '" data-toggle="modal" data-target="#myModal" title="View">
						<i class="glyphicon glyphicon-eye-open"></i> Track</a>';
                }


                if ($r->current_status != "33") {
                    $query = $this->db->get_where('business_groups', ['id' => $r->business_id,]);

                    if ($query->num_rows() > 0) {
                        foreach ($query->result() as $row) {
                            $biz_name = $row->business_name;
                        }
                    } else {
                        $biz_name = " ";
                    }

                    $query1 = $this->db->get_where('status', ['id' => $r->current_status,]);

                  if ($query1->num_rows() > 0) {
                    foreach ($query1->result() as $row) {
                        if ($row->status == 'Working In Progress') {
							
                            $currnt_status = "<font size='3'><div class='label label-primary'>$row->status</div></font>";
                        } else if ($row->status == 'Pending') {
							
                            $currnt_status = "<font size='3'><div class='label label-info'>$row->status</div></font>";
                        } else if ($row->status == 'Hold') {
							
                            $currnt_status = "<font size='3'><div class='label label-default'>$row->status</div></font>";
                        } else if ($row->status == 'Active') {
							
                            $currnt_status = "<font size='3'><div class='label label-danger'>$row->status</div></font>";
                        } else if ($row->status == 'Inactive') {
							
                            $currnt_status = "<font size='3'><div class='label label-info' >$row->status</div></font>";
                        }
						else if ($row->status == 'Completed') {
                            $currnt_status = "<font size='3'><div class='label label-success'>$row->status</div></font>";
                        }
						else if ($row->status == 'New Ticket') {
							
                            $currnt_status = "<font size='3'><div class='label label-warning'>$row->status</div></font>";
                        }
                    }
                } else {
                        $currnt_status = "waiting for status";
                    }
						$role = singleDbTableRow($r->created_by)->rolename;

                    $data['data'][] = array(
                        $button,
                        $r->ticket_no,
						$biz_name,
						$r->issue_type,
						$currnt_status,
						singleDbTableRow($r->created_by)->first_name." ".singleDbTableRow($r->created_by)->last_name,
						singleDbTableRow($role, 'role')->rolename
                    );
                }
            }
        } else {
            $data['data'][] = array(
                'You have no support list', '', '', '', '','',''
            );
        }
        echo json_encode($data);
    }

    public function deleteAjax() {

        $id = $_GET['id'];
        $this->db->where('id', $id)->delete('ticket_list');
        $this->session->set_flashdata('successMsg', 'your ticket delete successfully');
        redirect(base_url('support'));
        //theme('support');
    }

    public function deleteAjax2() {

        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'ticket_list');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} ticket_list");
        //Now delete permanently
        $this->db->where('id', $id)->delete('ticket_list');
        return true;
    }

    public function deleteAjax3() {

        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'ticket_list');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} ticket_list");
        //Now delete permanently
        $this->db->where('id', $id)->delete('ticket_list');
        return true;
    }

    //$string='fggf456';$int = intval(preg_replace('/[^0-9]+/', '', $string), 10); echo $int;

    public function get_ticket_no() {
        $business_name = $_POST['business_name'];
        $issue_type = $_POST['issue_type'];
        $bid = $_POST['bid'];
        $query = $this->db->get_where('ticket_list', ['business_id' => $bid, 'issue_type' => $issue_type]);
        $result = $query->result();
        if ($result) {
            foreach ($result as $rt) {
                $t = $rt->ticket_no;
            }
            $int = intval(preg_replace('/[^0-9]+/', '', $t), 10);
            $tckt = $int + 1;
            $ticket = strtoupper(substr($business_name, 0, 3)) . strtoupper(substr($issue_type, 0, 3)) . $tckt;
        } else {
            $ticket = strtoupper(substr($business_name, 0, 3)) . strtoupper(substr($issue_type, 0, 3)) . mt_rand(100, 999);
        }


        echo '<input type="text" id="ticket" name="ticket_no" class="form-control" readonly value=' . $ticket . ' placeholder="Ticket Number">';
    }

    public function getname() {

        $id = $_POST['role'];
        $query = $this->db->get_where('users', ['rolename' => $id]);
        $name = $query->result();
        $data = '<option value=""> Choose option </option>';
        foreach ($name as $st) {
            $data .= "<option value=" . $st->id . ">" . $st->first_name . " " . $st->last_name . "</option>";
        }
        echo $data;
    }

    public function edit_support($id) {

        // permittedArea();


        $data['ticket_list'] = singleDbTableRow($id, 'ticket_list');
        $data['status'] = $this->db->get_where('status', ['business_name' => 17]);
        $data['id'] = $this->db->get('users');
        $data['referral_code'] = $this->db->get('users');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_support')
                die('Error! sorry');


            // $this->form_validation->set_rules('role_id', 'role id', 'trim|required');
            $this->form_validation->set_rules('business_id', 'business id', 'trim|required');
            //$this->form_validation->set_rules('assigned_to', 'assigned  to', 'trim|required');/\
            $this->form_validation->set_rules('current_status', 'current status', 'trim|required');


            $user_info = $this->session->userdata('logged_user');
            $user_id = $user_info['user_id'];
            $currentUser = singleDbTableRow($user_id)->role;
            $rolename = singleDbTableRow($user_id)->rolename;
            $email = singleDbTableRow($user_id)->email;

            if ($this->form_validation->run() == true) {
                $insert = $this->Support_model->edit_support($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'support Updated Successfully...!!!');
                    if ($rolename == '36' OR '76') {
                        redirect(base_url('support/assigned_list'));
                    } elseif ($rolename == '11') {
                        redirect(base_url('support'));
                    }
                }
            }
        }

        theme('edit_support', $data);
    }
	
	public function dashboard()

	{

        theme('dashboard_status');
    }

    public function add_cs_comment($id) {

        // permittedArea();


        $data['ticket_list'] = singleDbTableRow($id, 'ticket_list');
        $data['status'] = $this->db->get_where('status', ['business_name' => 17]);
        $data['id'] = $this->db->get('users');
        $data['referral_code'] = $this->db->get('users');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_cs_comment')
                die('Error! sorry');


           
            $this->form_validation->set_rules('ticket_no', 'ticket_no', 'trim|required');
            
            $user_info = $this->session->userdata('logged_user');
            $user_id = $user_info['user_id'];
            $currentUser = singleDbTableRow($user_id)->role;
            $rolename = singleDbTableRow($user_id)->rolename;
            $email = singleDbTableRow($user_id)->email;




            if ($this->form_validation->run() == true) {
                $insert = $this->Support_model->add_cs_comment($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'support Updated Successfully...!!!');
                    if ($rolename == '36' OR '76') {
                        redirect(base_url('support/assigned_list'));
                    } elseif ($rolename == '11') {
                        redirect(base_url('support'));
                    }
                    redirect(base_url('support'));
                }
            }
        }

        theme('add_cs_comment', $data);
    }

    public function get_business_name() {
        $biz_id = $_POST['biz_id'];
        $query = $this->db->get_where('business_groups', ['id' => $biz_id]);
        foreach ($query->result() as $biz) {
            echo "<input type='hidden' id='biz_name' value='" . $biz->business_name . "'>";
        }
    }
	

	

}

//last 
