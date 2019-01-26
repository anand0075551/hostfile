<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Agriculture extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Agriculture_model');

        check_auth(); //check is logged in.
    }

    public function agriculture_land() {
    //    permittedArea();


        $data['agr_landid'] = $this->db->get('agr_landid');
         $data['country_name'] = $this->db->group_by('country')->get('pincode');


        if ($this->input->post()) {
            if ($this->input->post('submit') != 'agriculture_land')
                die('Error! sorry');


            $this->form_validation->set_rules('usuage_type', 'usuage type', 'trim|required');


            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->agriculture_land();
                if ($insert) {
$this->session->set_flashdata('successMsg', 'your land Created Success');
                    // redirect(base_url('Agriculture'));
redirect(base_url('Agriculture/all_agriculture_land'));
                }
            }
        }

        theme('agriculture_land', $data);
    }

    public function all_agriculture_land() {

        theme('all_agriculture_land');
    }

    public function agricultureListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Agriculture_model->agriculture_land_ListCount();


        $query = $this->Agriculture_model->agriculturet_land_List($limit,$start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';

                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Agriculture/view_agriculture_land/' . $r->id) . '" data-toggle="tooltip" title="View">
                        <i class="fa fa-eye"></i> </a>';

                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role; $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;

                if ($rolename == '11') {

                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
                        <i class="fa fa-trash"></i> </a>';
                    }

                $query = $this->db->get_where('agri_use_type', ['id' => $r->usuage_type,]);

                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        $usuage_type = $row->usage_type;
                    }
                } else {
                    $usuage_type = " ";
                }



                $query1 = $this->db->get_where('agri_land_type', ['id' => $r->land_type,]);

                if ($query1->num_rows() > 0) {
                    foreach ($query1->result() as $row) {
                        $land_type = $row->land_type;
                    }
                } else {
                    $land_type = " ";
                }





                $data['data'][] = array(
                    $button,
                    $r->city,
                    $r->land_id,
                    $r->pincode,
                    $usuage_type,
                    $land_type,
                    $r->soil_type,
singleDbTableRow($r->created_by)->first_name." ".singleDbTableRow($r->created_by)->last_name,
					$r->created_at,
                    $r->modified_by,
					 $r->modified_at
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Land list', '', '', '', '','','','','','',''
            );
        }
        echo json_encode($data);
    }

    public function view_agriculture_land($id) {
        //restricted this area, only for admin
    //    permittedArea();
        $data['agr_landid'] = $this->db->get_where('agr_landid', ['id' => $id]);
        theme('view_agriculture_land', $data);
    }

    public function deleteAjax() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'agr_landid');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} agr_landid");
        //Now delete permanently
        $this->db->where('id', $id)->delete('agr_landid');
        return true;
    }

    public function edit_agriculture_land($id) {
        //restricted this area, only for admin
    //   permittedArea();



        $data['agr_landid'] = singleDbTableRow($id, 'agr_landid');
        $data['usage_type'] = $this->db->get('agri_use_type');
        $data['land_type'] = $this->db->get('agri_land_type');
        $data['weather_type'] = $this->db->get('agri_weather');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_agriculture_land')
                die('Error! sorry');


            $this->form_validation->set_rules('usuage_type', 'usuage type', 'trim|required');


            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->edit_agriculture_land($id);
                if ($insert) {
$this->session->set_flashdata('successMsg', 'land Updated Successfully...!!!');
redirect(base_url('Agriculture/all_agriculture_land'));
                }
            }
        }

        theme('edit_agriculture_land', $data);
    }
//===================================add land estimate=============================================naveen======================//
    public function add_land_estimated() {
        //permittedArea();

        $data['country_name'] = $this->db->group_by('country')->get('pincode');
        $data['agr_landid'] = $this->db->get('agr_landid');
        $data['seed_name'] = $this->db->get('agri_base_materials');


        if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_land_estimated')
                die('Error! sorry');


$this->form_validation->set_rules('working_days', 'working days', 'trim|required');


            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->add_land_estimated();
                if ($insert) {
$this->session->set_flashdata('successMsg', 'your land Created Success');
redirect(base_url('Agriculture/all_land_estimate'));
                }
            }
        }

        theme('add_land_estimated', $data);
    }

    public function all_land_estimate() {

        theme('all_land_estimate');
    }

    public function estimateListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Agriculture_model->estimateListCount();


        $query = $this->Agriculture_model->estimateList($limit,$start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
               $button = '';
               $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Agriculture/view_land_estimate/' . $r->id) . '" data-toggle="tooltip" title="View">

                        <i class="fa fa-eye"></i> </a>';

                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role; $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;

                if ($rolename == '11') {

                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
                        <i class="fa fa-trash"></i> </a>';
                }


                $data['data'][] = array(
                    $button,
                    //$r->id,
                    $r->working_days,
                    $r->working_hours,
                    $r->start_breaktm,
                    $r->end_breaktm
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Land list', '', '', '', ''
            );
        }
        echo json_encode($data);
    }

    public function deleteAjax2() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'agr_estimate');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} agr_estimate");
        //Now delete permanently
        $this->db->where('id', $id)->delete('agr_estimate');
        return true;
    }

    public function view_land_estimate($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['agr_estimate'] = $this->db->get_where('agr_estimate', ['id' => $id]);
        theme('view_land_estimate', $data);
    }

    public function edit_land_estimate($id) {
        //permittedArea();
        //$data['agr_estimate'] = $this->db->get('agr_estimate');
        $data['agr_estimate'] = singleDbTableRow($id, 'agr_estimate');


        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_land_estimate')
                die('Error! sorry');


$this->form_validation->set_rules('working_days', 'working days', 'trim|required');


            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->edit_land_estimate($id);
                if ($insert) {
$this->session->set_flashdata('successMsg', 'your land estimate update Success');
redirect(base_url('Agriculture/all_land_estimate/'));
                }
            }
        }

        theme('edit_land_estimate', $data);
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

//==============================================base_material start==naveen==========================================//
    public function add_base_materials() {
//restricted this area, only for admin
        permittedArea();
       // $data['location'] = $this->db->get('pincode');
        $data['country_name'] = $this->db->group_by('country')->get('pincode');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_base_materials')
                die('Error! sorry');

            $this->form_validation->set_rules('type', 'Base Material Type', 'trim|required');
            $this->form_validation->set_rules('seed_name', 'Seed Name', 'trim|required');
            $this->form_validation->set_rules('location', 'Location', 'trim|required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->add_base_materials();
                if ($insert) {
$this->session->set_flashdata('successMsg', 'Base Material added Successfully');
redirect(base_url('Agriculture/list_base_materials'));
                }
            }
        }
        theme('add_base_materials', $data);
    }

    public function list_base_materials() {
        theme('list_base_materials');
    }

//<-----------------List Base Materials---------------->
    public function AgricultureBaseMaterialListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $queryCount = $this->Agriculture_model->BaseMaterialListCount();
        $query = $this->Agriculture_model->BaseMaterialList($limit,$start);
        $draw = $this->input->get('draw');
        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {
//Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Agriculture/view_base_material/' . $r->id) . '" data-toggle="tooltip" title="View">
                <i class="fa fa-eye"></i> </a>';

                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role; $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;

                if ($rolename == '11') {
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
                <i class="fa fa-trash"></i> </a>';
                }

                $data['data'][] = array(
                    $button,
                    $r->type,
                    $r->seed_name,
                    $r->location,
                    $r->quantity
                );
            }
        } else {
            $data['data'][] = array(
                'You have no  list', '', '', '', ''
            );
        }
        echo json_encode($data);
    }

    public function view_base_material($id) {
//restricted this area, only for admin
//permittedArea();
        $data['Agri_Details'] = $this->db->get_where('agri_base_materials', ['id' => $id]);
        theme('view_base_material', $data);
    }

    public function deleteAjax5() {
        $id = $this->input->post('id');
//get deleted user info
        $userInfo = singleDbTableRow($id, 'agri_base_materials');
        $categoryName = $userInfo->name;
// add a activity
        create_activity("Deleted {$categoryName} agri_base_materials");
//Now delete permanently
        $this->db->where('id', $id)->delete('agri_base_materials');
        return true;
    }

//<-------------Edit Base Material-------------->

    public function edit_base_material($id) {
//restricted this area, only for admin
        permittedArea();
        $data['location'] = $this->db->get('pincode');
        $data['edit_agri'] = singleDbTableRow($id, 'agri_base_materials');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_base_material')
                die('Error! sorry');
            $this->form_validation->set_rules('type', 'Base Material Type', 'trim|required');
            $this->form_validation->set_rules('seed_name', 'Seed Name', 'trim|required');
            $this->form_validation->set_rules('location', 'Location', 'trim|required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->edit_base_material($id);
                if ($insert) {
$this->session->set_flashdata('successMsg', 'Base Materials Updated Successfully...!!!');
redirect(base_url('Agriculture/list_base_materials'));
                }
            }
        }
        theme('edit_base_material', $data);
    }

//===========================================End base_material====== naveen====================================================//
//===========================================start labour type====== naveen====================================================//


    public function add_labour_type() {
//restricted this area, only for admin
        permittedArea();
        $data['location'] = $this->db->get('pincode');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_labour_type')
                die('Error! sorry');

            $this->form_validation->set_rules('job_type', 'Job Type', 'trim|required');
            $this->form_validation->set_rules('skill_level', 'SKill', 'trim|required');
            $this->form_validation->set_rules('sector_type', 'Sector Type', 'trim|required');
            $this->form_validation->set_rules('payment', 'Payment', 'trim|required');
            $this->form_validation->set_rules('zone', 'Zone', 'trim|required');
$this->form_validation->set_rules('payment_per_hour', 'Payment Per Hour', 'trim|required');
$this->form_validation->set_rules('half_day_payment', 'Half Day Payment', 'trim|required');
$this->form_validation->set_rules('full_day_payment', 'Full Day Payment', 'trim|required');
$this->form_validation->set_rules('overtime_payment', 'Overtime Payment', 'trim|required');
$this->form_validation->set_rules('fixed_monthly_pay', 'Fixed Monthly Payment', 'trim|required');
            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->add_labour_type();
                if ($insert) {
$this->session->set_flashdata('successMsg', 'Labour Type added Successfully');
redirect(base_url('Agriculture/list_labour_type'));
                }
            }
        }
        theme('add_labour_type', $data);
    }

    public function list_labour_type() {
        theme('list_labour_type');
    }

//<-----------------List Base Materials---------------->
    public function labourTypeListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $queryCount = $this->Agriculture_model->labourTypeListCount();
        $query = $this->Agriculture_model->labourTypeList($limit,$start);
        $draw = $this->input->get('draw');
        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {
//Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Agriculture/view_labour_type/' . $r->id) . '" data-toggle="tooltip" title="View">
                <i class="fa fa-eye"></i> </a>';
                            $user_info = $this->session->userdata('logged_user');
                            $user_id = $user_info['user_id'];
                            $currentUser = singleDbTableRow($user_id)->role; $user_info = $this->session->userdata('logged_user');
                            $user_id = $user_info['user_id'];
                            $currentUser = singleDbTableRow($user_id)->role;
                            $rolename = singleDbTableRow($user_id)->rolename;

                if ($rolename == '11') {

                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
                <i class="fa fa-trash"></i> </a>';
                                    }



                $data['data'][] = array(
                    $button,
                    $r->job_type,
                    $r->skill_level,
                    $r->sector_type,
                    $r->payment,
                    $r->zone,
                    $r->payment_per_hour,
                    $r->half_day_payment,
                    $r->full_day_payment,
                    $r->overtime_payment,
                    $r->fixed_monthly_pay
                );
            }
        } else {
            $data['data'][] = array(
                'You have no  list', '', '', '', '','','','','','',''
            );
        }
        echo json_encode($data);
    }

//<------------------View Labour Type-------------------->

    public function view_labour_type($id) {
//restricted this area, only for admin
//permittedArea();
        $data['Agri_Details'] = $this->db->get_where('agri_labour_type', ['id' => $id]);
        theme('view_labour_type', $data);
    }

//<-------------Edit Labour Type-------------->

    public function edit_labour_type($id) {
//restricted this area, only for admin
        permittedArea();
        $data['labour'] = singleDbTableRow($id, 'agri_labour_type');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_labour_type')
                die('Error! sorry');
            $this->form_validation->set_rules('job_type', 'Job Type', 'trim|required');
            $this->form_validation->set_rules('skill_level', 'SKill', 'trim|required');
            $this->form_validation->set_rules('sector_type', 'Sector Type', 'trim|required');
            $this->form_validation->set_rules('payment', 'Payment', 'trim|required');
            $this->form_validation->set_rules('zone', 'Zone', 'trim|required');
$this->form_validation->set_rules('payment_per_hour', 'Payment Per Hour', 'trim|required');
$this->form_validation->set_rules('half_day_payment', 'Half Day Payment', 'trim|required');
$this->form_validation->set_rules('full_day_payment', 'Full Day Payment', 'trim|required');
$this->form_validation->set_rules('overtime_payment', 'Overtime Payment', 'trim|required');
$this->form_validation->set_rules('fixed_monthly_pay', 'Fixed Monthly Payment', 'trim|required');
            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->edit_labour_type($id);
                if ($insert) {
$this->session->set_flashdata('successMsg', 'Labour Type Updated Successfully...!!!');
redirect(base_url('Agriculture/list_labour_type'));
                }
            }
        }
        theme('edit_labour_type', $data);
    }

    public function deletelabourTypeListJson() {
        $id = $this->input->post('id');
//get deleted user info
        $userInfo = singleDbTableRow($id, 'agri_labour_type');
        $categoryName = $userInfo->name;
// add a activity
        create_activity("Deleted {$categoryName} agri_labour_type");
//Now delete permanently
        $this->db->where('id', $id)->delete('agri_labour_type');
        return true;
    }

//======================================starting labour account===============================================================//


    public function add_labour_account() {
        permittedArea();


        // $data['job_type'] = $this->db->get('agri_labour_type');


        if ($this->input->post()) {
            if ($this->input->post('submit') == 'labour_account')
                die('Error! sorry');


            $this->form_validation->set_rules('main_power', 'main power', 'trim|required');


            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->labour_account();
                if ($insert) {
$this->session->set_flashdata('successMsg', 'your labouraccount Created Success');
redirect(base_url('Agriculture/all_labour_account'));
                }
            }
        }

        theme('add_labour_account');
    }

    public function all_labour_account() {
        theme('all_labour_account');
    }

    public function labour_accountListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $queryCount = $this->Agriculture_model->labour_accountListCount();
        $query = $this->Agriculture_model->labour_accountList($limit,$start);
        $draw = $this->input->get('draw');
        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {
//Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Agriculture/view__labour_account/' . $r->id) . '" data-toggle="tooltip" title="View">
                <i class="fa fa-eye"></i> </a>';


                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role; $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;

                if ($rolename == '11') {
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
                <i class="fa fa-trash"></i> </a>';
                                        }
                $data['data'][] = array(
                    $button,
                    $r->main_power,
                    $r->zone,
                    $r->land_id
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Data', '', '', ''
            );
        }
        echo json_encode($data);
    }

    public function labour_account() {
        $id = $this->input->post('id');
//get deleted user info
        $userInfo = singleDbTableRow($id, 'agri_labour_accounts');
        $categoryName = $userInfo->name;
// add a activity
        create_activity("Deleted {$categoryName} agri_labour_accounts");
//Now delete permanently
        $this->db->where('id', $id)->delete('agri_labour_accounts');
        return true;
    }

    public function view__labour_account($id) {
//restricted this area, only for admin
//permittedArea();
        $data['lab_accnt'] = $this->db->get_where('agri_labour_accounts', ['id' => $id]);
        theme('view__labour_account', $data);
    }

//=========================================add_Agriculture_input_materials====================================================//



    public function add_Agriculture_input_materials() {
//restricted this area, only for admin
//   permittedArea();
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_Agriculture_input_materials')
                die('Error! sorry');
//$this->form_validation->set_rules('business_name', 'business Name ', 'required|trim');
            $this->form_validation->set_rules('type', 'Type', 'trim|required');
            $this->form_validation->set_rules('name', 'name', 'trim|required');

            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->add_Agriculture_input_materials();
                if ($insert) {
$this->session->set_flashdata('successMsg', 'Input Materials added Successfully');
redirect(base_url('Agriculture/list_Agriculture_input_materials'));
                }
            }
        }
        theme('add_Agriculture_input_materials');
    }

    public function list_Agriculture_input_materials() {


        theme('list_Agriculture_input_materials');
    }

//List


    public function Agri_input_ListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $queryCount = $this->Agriculture_model->Agri_input_ListCount();
        $query = $this->Agriculture_model->Agri_input_List($limit,$start);
        $draw = $this->input->get('draw');
        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {
//Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Agriculture/view_Agriculture_input_materials/' . $r->id) . '" data-toggle="tooltip" title="View">
<i class="fa fa-eye"></i> </a>';

                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role; $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;

                if ($rolename == '11') {
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
                <i class="fa fa-trash"></i> </a>';
                                    }
                $data['data'][] = array(
                    $button,
                    $r->type,
                    $r->name,
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Data', '', ''
            );
        }
        echo json_encode($data);
    }

//<----------View Input Material Type------------->
    public function view_Agriculture_input_materials($id) {
//restricted this area, only for admin
//permittedArea();
        $data['Agri_Details'] = $this->db->get_where('agri_input_materials', ['id' => $id]);
        theme('view_Agriculture_input_materials', $data);
    }

//edit Agriculture
    public function editAgriculture_input_materials($id) {
//restricted this area, only for admin
        permittedArea();
        $data['edit_agri'] = singleDbTableRow($id, 'agri_input_materials');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_agri')
                die('Error! sorry');
            $this->form_validation->set_rules('type', 'Type', 'trim|required');
            $this->form_validation->set_rules('name', 'name', 'trim|required');

            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->editAgriculture_input_materials($id);
                if ($insert) {
$this->session->set_flashdata('successMsg', 'Materials Updated Successfully...!!!');
redirect(base_url('Agriculture/list_Agriculture_input_materials'));
                }
            }
        }
        theme('edit_agriculture', $data);
    }

    public function deleteAjax6() {
        $id = $this->input->post('id');
//get deleted user info
        $userInfo = singleDbTableRow($id, 'agri_base_materials');
        $categoryName = $userInfo->name;
// add a activity
        create_activity("Deleted {$categoryName} agri_base_materials");
//Now delete permanently
        $this->db->where('id', $id)->delete('agri_base_materials');
        return true;
    }

//=====================================================add advisable===================================================//
    //function list_agri_advisable

    public function list_agri_advisable() {

        theme('list_agri_advisable');
    }

    //<-----Add Advisables------------->

    public function add_advisable() {
        //restricted this area, only for admin
        permittedArea();




        if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_advisable')
                die('Error! sorry');


            $this->form_validation->set_rules('soil_type', 'Soil Type', 'trim|required');
$this->form_validation->set_rules('weather_tableid', 'Weather Table Id', 'trim|required');
            $this->form_validation->set_rules('crop', 'Crop', 'trim|required');



            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->add_advisable();
                if ($insert) {
$this->session->set_flashdata('successMsg', 'Advisable added Successfully');
redirect(base_url('Agriculture/list_agri_advisable'));
                }
            }
        }

        theme('add_advisable');
    }

    //<-----------------List Advisables---------------->

    public function advisableListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Agriculture_model->advisableListCount();


        $query = $this->Agriculture_model->advisableList($limit,$start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Agriculture/view_agri_advisable/' . $r->id) . '" data-toggle="tooltip" title="View">
                        <i class="fa fa-eye"></i> </a>';


                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role; $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;

                if ($rolename == '11') {
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
                        <i class="fa fa-trash"></i> </a>';
                }




                $data['data'][] = array(
                    $button,
                    $r->soil_type,
                    $r->weather_tableid,
                    $r->crop
                );
            }
        } else {
            $data['data'][] = array(
                'You have no advisable list', '', '', ''
            );
        }
        echo json_encode($data);
    }

    //<------------------View Advisables-------------------->

    public function view_agri_advisable($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['Agri_Details'] = $this->db->get_where('agri_advisable', ['id' => $id]);
        theme('view_agri_advisable', $data);
    }

    //<-------------Edit Advisables-------------->

    public function edit_agri_advisable($id) {
        //restricted this area, only for admin
        permittedArea();

        $data['edit_agri'] = singleDbTableRow($id, 'agri_advisable');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_advisable')
                die('Error! sorry');

            $this->form_validation->set_rules('soil_type', 'Soil Type', 'trim|required');
$this->form_validation->set_rules('weather_tableid', 'Weather Table Id', 'trim|required');
            $this->form_validation->set_rules('crop', 'Crop', 'trim|required');

            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->edit_agri_advisable($id);
                if ($insert) {
$this->session->set_flashdata('successMsg', 'Advisables Updated Successfully...!!!');
redirect(base_url('Agriculture/list_agri_advisable'));
                }
            }
        }

        theme('edit_agri_advisable', $data);
    }

    public function deleteAjax8() {
        $id = $this->input->post('id');
//get deleted user info
        $userInfo = singleDbTableRow($id, 'agri_advisable');
        $categoryName = $userInfo->name;
// add a activity
        create_activity("Deleted {$categoryName} agri_advisable");
//Now delete permanently
        $this->db->where('id', $id)->delete('agri_advisable');
        return true;
    }

//=============================================start create Agricultureproject========naveen=========================//

    public function add_agriculture_project() {
        //permittedArea();

        //Get Decision who in online?
        $user = loggedInUserData();
        $userID = $user['user_id'];
        $user['role'] == 'admin';
        $rolename = singleDbTableRow($userID)->rolename;


       $data['country_name'] = $this->db->group_by('country')->get('pincode');

        if ($this->input->post()) {
            if ($this->input->post('submit') == 'crate_project')
                die('Error! sorry');


           $this->form_validation->set_rules('village_name', 'village_name', 'trim|required');
           $this->form_validation->set_rules('land_id', 'land_id', 'trim|required');
           $this->form_validation->set_rules('land_type', 'land type', 'trim|required');
           $this->form_validation->set_rules('usuage_type', 'usuage type', 'trim|required');
           $this->form_validation->set_rules('project_name', 'project name', 'trim|required');

           //Get Decision who in online?
        $user = loggedInUserData();
        $userID = $user['user_id'];
        $user['role'] == 'admin';

        $rolename = singleDbTableRow($userID)->rolename;
          if($rolename != 11)
        {
            $data['users'] = $this->db->get('agr_landid');

        }else{
            $where_array = array ('created_by' => $userID);
             $data['users'] = $this->db->where($where_array )->get('agr_landid');
        }




            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->crate_project();
                if ($insert) {
$this->session->set_flashdata('successMsg', 'your project Created Success');
redirect(base_url('Agriculture/all_agriculture_project'));
                }
            }
        }

        theme('add_agriculture_project', $data);
    }

    public function all_agriculture_project() {

        theme('all_agriculture_project');
    }

    public function agriculture_projectListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Agriculture_model->agriculture_projectListCount();


        $query = $this->Agriculture_model->agriculture_projecteList($limit,$start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';


                         $button .= '<a class="btn btn-warning editBtn" href="' . base_url('Agriculture/view_crop_project/' . $r->land_id) . '" data-toggle="tooltip" title="add">
                        <i class="fa fa-plus"></i> </a>';


                $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role; $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;

                if ($rolename == '11') {
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
                        <i class="fa fa-trash"></i> </a>';
                                        }

                $query5 = $this->db->get_where('agri_use_type', ['id' => $r->usuage_type,]);

                if ($query5->num_rows() > 0) {
                    foreach ($query5->result() as $row) {
                        $usuage_type = $row->usage_type;
                    }
                } else {
                    $usuage_type = " ";
                }



                $query6 = $this->db->get_where('agri_land_type', ['id' => $r->land_type,]);

                if ($query6->num_rows() > 0) {
                    foreach ($query6->result() as $row) {
                        $land_type = $row->land_type;
                    }
                } else {
                    $land_type = " ";
                }


                $data['data'][] = array(
                    $button,

                    $usuage_type,
                    $land_type ,
                    $r->project_name,
                    $r->village_name,
                    $r->land_id,
                    //$created_by
singleDbTableRow($r->created_by)->first_name." ".singleDbTableRow($r->created_by)->last_name
                );
            }
        } else {
            $data['data'][] = array(
                'You have no project list', '', '', '', '','',''
            );
        }
        echo json_encode($data);
    }

    public function all_agri_project_list() {
        $id = $this->input->post('id');
//get deleted user info
        $userInfo = singleDbTableRow($id, 'add__agri_project');
        $categoryName = $userInfo->name;
// add a activity
        create_activity("Deleted {$categoryName} add__agri_project");
//Now delete permanently
        $this->db->where('id', $id)->delete('add__agri_project');
        return true;
    }

    public function view_agriculture_project($id) {
        //restricted this area, only for admin
       // permittedArea();
        $data['add__agri'] = $this->db->get_where('add__agri_project', ['id' => $id]);
        theme('view_agriculture_project', $data);
    }

    public function edit_agriculture_project($id) {
        //restricted this area, only for admin
       // permittedArea();
        $data['country_name'] = $this->db->group_by('country')->get('pincode');
        $data['edit_agri'] = singleDbTableRow($id, 'add__agri_project');

        if ($this->input->post()) {
            if ($this->input->post('submit') == 'edit_project')
                die('Error! sorry');


            $this->form_validation->set_rules('country', 'country', 'trim|required');

            if ($this->form_validation->run() == true) {
                $insert = $this->Agriculture_model->edit_project($id);
                if ($insert) {
$this->session->set_flashdata('successMsg', 'your project Updated Successfully...!!!');
redirect(base_url('Agriculture/all_agriculture_project'));
                }
            }
        }

        theme('edit_agriculture_project', $data);
    }

//=============================================end create Agriculture project====================================================//

    public function getstate() {
        $country = $_POST['country'];
        //  echo $country;
        $query = $this->Agriculture_model->state($country);
        if ($query->num_rows() > 0) {
            echo "<option value=''>-Select-</option>";
            foreach ($query->result() as $r) {
                echo "<option value='" . $r->state . "'>" . $r->state . "</option>";
            }
        } else {
            echo "<option value=''>-No Data-</option>";
        }
    }

    public function get_district() {
        $state = $_POST['state'];

        $query = $this->Agriculture_model->district($state);
        if ($query->num_rows() > 0) {
            echo "<option value=''>-Select-</option>";
            foreach ($query->result() as $r) {
                echo "<option value='" . $r->district . "'>" . $r->district . "</option>";
            }
        } else {
            echo "<option value=''>---No Data---</option>";
        }
    }

    public function get_taluk() {
        $district = $_POST['district'];

        $query = $this->Agriculture_model->taluk($district);
        if ($query->num_rows() > 0) {
            echo "<option value=''>-Select-</option>";
            foreach ($query->result() as $r) {
                echo "<option value='" . $r->taluk . "'>" . $r->taluk . "</option>";
            }
        } else {
            echo "<option value=''>---No Data---</option>";
        }
    }

    public function get_location_id() {
        $taluk = $_POST['taluk'];

        $query = $this->Agriculture_model->location($taluk);
        echo "<option value=''>-Select-</option>";
        foreach ($query->result() as $r) {
            echo "<option value='" . $r->location . "'>" . $r->location . "--" . $r->pincode . "</option>";
        }
    }

    public function get_pincode() {
        $location = $_POST['location'];

        $query = $this->Agriculture_model->pincode($location);
        echo "<option value=''>-Select-</option>";
        foreach ($query->result() as $r) {
            echo "<option value='" . $r->pincode . "'>" . $r->pincode . "</option>";

        }
    }



         public function view_crop_project($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['add__agri_project'] = $this->db->get('add__agri_project');
        $data['category_name'] = $this->db->get('farm_activity');
        $data['id_activity'] = $this->db->get('agr_landid');
        $data['crop'] = $this->db->get('agri_advisable');
        $data['aid'] = $id;

    if ($this->input->post()) {
            if ($this->input->post('submit') != 'farm')
                die('Error! sorry');


                $insert = $this->Agriculture_model->view_crop_project();
                if ($insert) {
$this->session->set_flashdata('successMsg', 'Farm Maitenance Added Successfully. ');



redirect(base_url('Agriculture/view_farm_maitenance/'.$id));
                }


        }
        theme('view_crop_project',$data);
    }

    public function view_farm_maitenance($id) {
        //restricted this area, only for admin
       // permittedArea();
        $data['aid'] = $id;

        $data['view_farm_maintenance'] = $this->db->order_by('id', 'ASC')->get_where('agri_crop_maint', ['id_activity' => $id]);

        theme('view_farm_maitenance', $data);
    }





/*****************************************dashborad************************************************************/

    public function agriculture_dashboard()
    {
        $data['all_agriculture_land'] =$this->Agriculture_model->count_all_agriland();
        $data['all_agriculture_project'] =$this->Agriculture_model->count_all_agriproject();
        $data['all_land_estimate'] =$this->Agriculture_model->count_all_landestimate();
        $data['all_labour_account'] =$this->Agriculture_model->count_all_labouraccount();
        $data['list_labour_type'] =$this->Agriculture_model->count_all_labourtype();
        $data['list_base_materials'] =$this->Agriculture_model->count_all_basematrials();
        $data['list_Agriculture_input_materials'] =$this->Agriculture_model->count_all_inputmatrials();
        $data['list_agri_advisable'] =$this->Agriculture_model->count_all_agriadvisable();
        theme('agriculture_dashboard',$data);

    }

/********************************************************************************************************************/


    /*******************************/


/*============================================*/
//Agriculture Report
public function view_report_agriculture(){
        theme('view_report_agriculture');
    }

/*============================================*/


// Agriculture view button file



     public function view_agriculture_report($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['Dashbord'] = $this->db->get_where('farm_maintenance', ['id' => $id]);
        theme('view_agriculture_report', $data);
    }

    //Searching



public function agriculture_search_ListJson(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = singleDbTableRow($user_id)->rolename;
        $currentUser   = singleDbTableRow($user_id)->role;

        $id_activity = $_POST['id_activity'];

        $sf_time = $_POST['sf_time'];
        $st_time = $_POST['st_time'];



        $limit = $this->input->post('length');
        $start = $this->input->post('start');


        $queryCount = $this->Agriculture_model->search_agriculture_listCount($id_activity,$sf_time,$st_time);


        $query = $this->Agriculture_model->search_agriculture_list($limit, $start ,$id_activity,$sf_time,$st_time);

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
                                        foreach ($query2->result() as $row) {
                                            $created_by = $row->first_name.' '.$row->last_name;
                                        }
                                    } else {
                                         $created_by = $row->first_name.' '.$row->last_name;
                                    }


                            $query3 = $this->db->get_where('users', ['id' => $r->modified_by]);

                                    if ($query3->num_rows() > 0) {
                                        foreach ($query3->result() as $row) {
                                            $modified_by = $row->first_name.' '.$row->last_name;
                                        }
                                    } else {
                                         $modified_by = $row->first_name.' '.$row->last_name;
                                    }




            //Action Button
            $button = '';
            $button .= '<a class="btn btn-primary editBtn" href="'.base_url('Agriculture/view_agriculture_report/'. $r->id).'" data-toggle="tooltip" title="View">
                        <i class="fa fa-eye"></i> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

            $data['data'][] = array(
                $button,

                $r->id_activity,
                $r->crop,
                $r->activity_type,
                $r->activity,
                $r->begin_date,
                $r->end_date,
                $r->expected_hours,
                $r->per_person_time,
                $r->labour_role,
                $r->labour_user,
                $r->person_no,

                $r->price_per_person,
                $r->calculated_price,

                $r->expected_price,
                $r->difference,


                date("Y-m-d H:i:s",$r->created_at),
                $created_by,
                $modified_by,
                date("Y-m-d H:i:s",$r->modified_at)


            );
        }
}
        else{
            $data['data'][] = array(
                'Records are not Available' , '', '','', '','','','','','','','','','','','','','','',''
            );

        }
        echo json_encode($data);

    }

    public function get_total_budget(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = singleDbTableRow($user_id)->rolename;
        $currentUser   = singleDbTableRow($user_id)->role;

        $id_activity = $_POST['id_activity'];

        $sf_time = $_POST['sf_time'];
        $st_time = $_POST['st_time'];


        $query = $this->Agriculture_model->get_total_budget($id_activity,$sf_time,$st_time);

        if($query -> num_rows() > 0)
      {
          $expected = 0;
         foreach($query->result() as $r)
        {
            $expected = $expected + $r->expected_hours;
        }
      }
      else
      {
          $expected = 0;
      }

          if($query -> num_rows() > 0)
      {
          $persons = 0;
         foreach($query->result() as $r)
        {
            $persons = $persons + $r->person_no;
        }
      }
      else
      {
          $persons = 0;
      }

          if($query -> num_rows() > 0)
      {
          $calculatedprice = 0;
         foreach($query->result() as $r)
        {
            $calculatedprice = $calculatedprice + $r->calculated_price;
        }
      }
      else
      {
          $calculatedprice = 0;
      }

          if($query -> num_rows() > 0)
      {
          $expectedprice = 0;
         foreach($query->result() as $r)
        {
            $expectedprice = $expectedprice + $r->expected_price;
        }
      }
      else
      {
          $expectedprice = 0;
      }

          if($query -> num_rows() > 0)
      {
          $difference = 0;
         foreach($query->result() as $r)
        {
            $difference = $difference + $r->difference;
        }
      }
      else
      {
          $difference = 0;
      }
      echo "<table class='table table-striped'>
      <tr>

      <th>Farm maintenance Steps:</th>
      <td> ".$query -> num_rows()."</td>
      </tr>
      <tr>
      <th>Expected Hours:</th>
      <td>".$expected."</td>
      </tr>
      <tr>
      <th>No.of Persons:</th>
      <td>".$persons."</td>
      </tr>
      <tr>
        <th>Calculated Price:</th>
        <td>".number_format($calculatedprice)."</td>
        </tr>
      <tr>
          <th>Expected Price:</th>
          <td>".number_format($expectedprice)."</td>
          </tr>
      <tr>
            <th>Difference:</th>
            <td>".$difference."</td>
      </tr>
      </table> <br><br>
      ";
    }


	

/*==================AGRICULTURE LAND REPORT ==========================*/





    //Searching



public function agriculture_land_search_ListJson(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = singleDbTableRow($user_id)->rolename;
        $currentUser   = singleDbTableRow($user_id)->role;

        $land_id = $_POST['land_id'];

        $sf_time = $_POST['sf_time'];
        $st_time = $_POST['st_time'];



        $limit = $this->input->post('length');
        $start = $this->input->post('start');


        $queryCount = $this->Agriculture_model->search_agriculture_land_listCount($land_id,$sf_time,$st_time);


        $query = $this->Agriculture_model->search_agriculture_land_list($limit, $start ,$land_id,$sf_time,$st_time);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

    if($query -> num_rows() > 0)
      {
        foreach($query->result() as $r){

							    
			$get_landtype = $this->db->get_where('agri_land_type', ['id'=>$r->land_type]);
			foreach($get_landtype->result() as $sc);
			$land_type = $sc->land_type;
			
			$query4 = $this->db->get_where('agri_use_type', ['id' => $r->usuage_type]);

                                    if ($query4->num_rows() > 0) {
                                        foreach ($query4->result() as $row) {
                                            $usuage_type = $row->usage_type;
                                        }
                                    } else {
                                         $usuage_type = $row->usage_type;
                                    }


                            $query2 = $this->db->get_where('users', ['id' => $r->created_by]);

                                    if ($query2->num_rows() > 0) {
                                        foreach ($query2->result() as $row) {
                                            $created_by = $row->first_name.' '.$row->last_name;
                                        }
                                    } else {
                                         $created_by = $row->first_name.' '.$row->last_name;
                                    }


                            $query3 = $this->db->get_where('users', ['id' => $r->modified_by]);

                                    if ($query3->num_rows() > 0) {
                                        foreach ($query3->result() as $row) {
                                            $modified_by = $row->first_name.' '.$row->last_name;
                                        }
                                    } else {
                                         $modified_by = $row->first_name.' '.$row->last_name;
                                    }


									

            //Action Button
            $button = '';
            $button .= '<a class="btn btn-primary editBtn" href="'.base_url('Agriculture/view_agriculture_land/'. $r->id).'" data-toggle="tooltip" title="View">
                        <i class="fa fa-eye"></i> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

            $data['data'][] = array(
                $button,

                $r->city,
                $r->land_id,
                $r->pincode,
                $usuage_type,
                $land_type,
                $r->soil_type,
                 $created_by,
                date("Y-m-d H:i:s",$r->created_at),
                $modified_by,
                date("Y-m-d H:i:s",$r->modified_at)


            );
        }
}
        else{
            $data['data'][] = array(
                'Records are not Available' , '', '','', '','','','','','',''
            );

        }
        echo json_encode($data);

    }

}//Last Brace Required



