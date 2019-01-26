<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Business_status extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Business_status_model');

        check_auth(); //check is logged in.
    }

    public function add_business_status() {
        //restricted this area, only for admin
        permittedArea();
        $data['business_name'] = $this->db->get('business_groups');
        $data['role'] = $this->db->get('role');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_business_status')
                die('Error! sorry');


            $this->form_validation->set_rules('status', 'Status ', 'required|trim');
            $this->form_validation->set_rules('business_name', 'Business Name ', 'required|trim');

            if ($this->form_validation->run() == true) {
                $insert = $this->Business_status_model->add_business_status();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Business Status Created Successfully');
                    redirect(base_url('business_status/all_business_status'));
                }
            }
        }
        theme('add_business_status', $data);
    }

    public function all_business_status() {
        //restricted this area, only for admin
        permittedArea();

        theme('all_business_status');
    }

    public function edit_business_status($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['status'] = singleDbTableRow($id, 'status');
       // $data['rolename'] =   singleDbTableRow($id, 'role');
        $data['business_name'] = $this->db->get('business_groups');
        $data['role'] = $this->db->get('role');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_business_status')
                die('Error! sorry');
            //if($this->input->post('back') != 'all_status') die('Error! sorry');
            $this->form_validation->set_rules('status', 'Status ', 'required|trim');
            //	$this->form_validation->set_rules('business_category', 'Business Category ', 'required|trim');

            if ($this->form_validation->run() == true) {
                $insert = $this->Business_status_model->edit_business_status($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Status Updated Successfully...!!!');
                    redirect(base_url('business_status/all_business_status'));
                }
            }
        }

        theme('edit_business_status', $data);
    }

    public function deleteAjax5() {
        $id = $this->input->post('id');

        //get deleted user info
        $userInfo = singleDbTableRow($id, 'status');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} Status");
        //Now delete permanently
        $this->db->where('id', $id)->delete('status');
        return true;
    }

    public function statusListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $queryCount = $this->Business_status_model->statusListCount();


        $query = $this->Business_status_model->statusList($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        foreach ($query->result() as $r) {

            $activeStatus = $r->view_status;
            //Status Button
            switch ($activeStatus) {
                case 0:
                    $statusBtn = '<small class="label label-default"> Pending </small>';
                    $blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="' . $r->id . '" data-toggle="tooltip" title="Unblock" value="1" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
                    break;
                case 1 :
                    $statusBtn = '<small class="label label-success"> Active </small>';
                    $blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="' . $r->id . '" data-toggle="tooltip" title="Block" value="2" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-lock" ></i> </button>';
                    break;
                case 2 :
                    $statusBtn = '<small class="label label-danger"> Blocked </small>';
                    $blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="' . $r->id . '" data-toggle="tooltip" title="Unblock" value="1" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
                    break;

                case 3 :

                    $statusBtn = '<small class="label label-danger"> Deactivated By Admin </small>';
                    $blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="' . $r->id . '" data-toggle="tooltip" title="Deactivate" value="0" value="Refresh Page" onClick="window.location.reload()">
						<i class="fa fa-unlock-alt"></i> </button>';
                    break;
            }
            $business_groups_id = $r->business_name;

            $table_name = 'business_groups';
            $where_array = array('id' => $business_groups_id);
            $query2 = $this->db->where($where_array)->get($table_name);
            foreach ($query2->result() as $r2) {
                $business_groups_name = $r2->business_name;
            }
          $query0 = $this->db->get_where('role', ['id' => $r->to_role,]);
            if ($query0->num_rows() > 0) {
                foreach ($query0->result() as $row0) {
                    $un = $row0->rolename;
                }
            } else {
                $un = " ";
            }
            //Action Button
            $button = '';
            $button .= '<a class="btn btn-primary editBtn" href="' . base_url('business_status/view_business_status/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
            /* $button .= '<a class="btn btn-info editBtn"  href="'.base_url('add_shipment/edit_shipment/'. $r->id).'" data-toggle="tooltip" title="Edit">
              <i class="fa fa-edit"></i> </a>'; */
            $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
            $button .= $blockUnblockBtn;
			
			
		$to_role = "";
                                if ($r->to_role != 0) 
								{
                                    $pincode_name = explode(",", $r->to_role);
                                    foreach ($pincode_name as $pincode_id) 
									{

                                        $query = $this->db->get_where('role', ['id' => $pincode_id]);
										foreach ($query->result() as $d) 
										{
											$ra = $d->rolename; 
										} 
									
									 $to_role .= $ra . ", ";
                                    }
									$to = $to_role;
                                } else 
								{
                                    $to = "to_role Doesnot Exist";
                                }	
            $data['data'][] = array(
                $button,
                $r->id,
                $r->status,
                $business_groups_name,
                $to,
                $r->lang_en,
                $statusBtn
            );
        }

        echo json_encode($data);
    }

    public function setBlockUnblock() {
        $id = $this->input->post('id');
        $buttonValue = $this->input->post('buttonValue');
        $status = $this->input->post('status');

        //get deleted user info
        $userInfo = singleDbTableRow($id);
        $fullName = user_full_name($userInfo);
        // add a activity
        create_activity($status . " {$fullName} from Agent");
        //Now delete permanently

        $this->db->where('id', $id)->update('status', ['view_status' => $buttonValue]);
        return true;
    }

    public function view_business_status($id) {
        //restricted this area, only for admin
        permittedArea();
        $data['business_name'] = $this->db->get('business_groups');
        $data['status_Details'] = $this->db->get_where('status', ['id' => $id]);



        theme('view_business_status', $data);
    }

    public function view_business_state($id) {

        permittedArea();

        $data['state_Details'] = $this->db->get_where('state', ['id' => $id]);



        theme('view_business_state', $data);
    }

}
