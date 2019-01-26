<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Agriculture_model extends CI_Model {

    public function agriculture_land() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'land_id' 		  => $this->input->post('land_id'),
            'usuage_type' 	  => $this->input->post('usuage_type'),
            'land_type' 	  => $this->input->post('land_type'),
            'soil_type' 	  => $this->input->post('soil_type'),
            'start_date' 	  => $this->input->post('start_date'),
            'end_date' 		  => $this->input->post('end_date'),
            'land_verified'   => $this->input->post('land_verified'),
            'survey_no' 	  => $this->input->post('survey_no'),
            'fertility_level' => $this->input->post('fertility_level'),
            'weather_map'	  => $this->input->post('weather_map'),
            'bus_distance'	  => $this->input->post('bus_distance'),
            'city'			  => $this->input->post('city'),
            'pincode' 		  => $this->input->post('pincode'),
            'holdings' 		  => $this->input->post('holdings'),
            'size_gutas' 	  => $this->input->post('size_gutas'),
            'created_by'	  => $user_id,
            'created_at' 	  => time()
        ];

        $query = $this->db->insert('agr_landid', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'agr_landid'); //create an activity
            return true;
        }
        return false;
    }

    //view supportList

    public function agriculture_land_ListCount() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        if ($currentUser == 'admin') {
            $query = $this->db->count_all_results('agr_landid');
        } else {
            $query = $this->db->where('created_by ', $user_id)->count_all_results('agr_landid');
        }
        return $query;
    }

    public function agriculturet_land_List($limit = 0, $start = 0) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        $search = $this->input->get('search');
        $searchValue = $search['value'];

        $searchByID = '';
        if ($rolename == '11') {
            if ($searchValue != '') {
                $table_name = "agr_landid";
                $where_array = array('land_type' => $searchValue);
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            } else {
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('agr_landid');
            }
        } else {
            if ($searchValue != '') {
                $table_name = "agr_landid";
                $where_array = array('land_type' => $searchValue, 'created_by' => $user_id);
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            } else {
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('agr_landid', ['created_by' => $user_id]);
            }
        }
        return $query;
    }
	

    public function edit_agriculture_land($id) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        //set all data for inserting into database
        $data = [
            'usuage_type' => $this->input->post('usuage_type'),
            'land_type'   => $this->input->post('land_type'),
            'soil_type' => $this->input->post('soil_type'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'land_verified' => $this->input->post('land_verified'),
            'survey_no' => $this->input->post('survey_no'),
            'fertility_level' => $this->input->post('fertility_level'),
            'weather_map' => $this->input->post('weather_map'),
            'bus_distance' => $this->input->post('bus_distance'),
            'city' => $this->input->post('city'),
            'pincode' => $this->input->post('pincode'),
            'holdings' => $this->input->post('holdings'),
            'size_gutas' => $this->input->post('size_gutas'),
            'modified_by' => $user_id,
            'modified_at' => time()
        ];

        $query = $this->db->where('id', $id)->update('agr_landid', $data);

        if ($query) {
            create_activity('Updated ' . $data['modified_by'] . 'agr_landid'); //create an activity
            return true;
        }
        return false;
    }

    public function add_land_estimated() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'working_days'  => $this->input->post('working_days'),
            'working_hours' => $this->input->post('working_hours'),
            'start_breaktm' => $this->input->post('start_breaktm'),
            'end_breaktm'   => $this->input->post('end_breaktm'),
            //'work_startdt'  => $this->input->post('work_startdt'),
            //'work_enddt' 	=> $this->input->post('work_enddt'),
            'total_work' 	=> $this->input->post('total_work'),
            'created_by' 	=> $user_id,
            'created_at' 	=> time()
        ];

        $query = $this->db->insert('agr_estimate', $data);

        if ($query) {
            create_activity('Added ' . $data['working_days'] . 'agr_estimate'); //create an activity
            return true;
        }
        return false;
    }

    //view supportList

    public function estimateListCount() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        if ($currentUser == 'admin') {
            $query = $this->db->count_all_results('agr_estimate');
        } else {
            $query = $this->db->where('created_by ', $user_id)->count_all_results('agr_estimate');
        }
        return $query;
    }

    public function estimateList($limit = 0, $start = 0) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        $search = $this->input->get('search');
        $searchValue = $search['value'];

        $searchByID = '';
        if ($rolename == '11') {
            if ($searchValue != '') {
                $table_name = "agr_estimate";
                $where_array = array('working_days' => $searchValue);
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            } else {
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('agr_estimate');
            }
        } else {
            if ($searchValue != '') {
                $table_name = "agr_estimate";
                $where_array = array('working_days' => $searchValue, 'created_by' => $user_id);
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            } else {
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('agr_estimate', ['created_by' => $user_id]);
            }
        }
        return $query;
    }

    public function edit_land_estimate($id) {


        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        //set all data for inserting into database


        $data = [
            'working_days' => $this->input->post('working_days'),
            'working_hours' => $this->input->post('working_hours'),
            'start_breaktm' => $this->input->post('start_breaktm'),
            'end_breaktm' => $this->input->post('end_breaktm'),
            'work_startdt' => $this->input->post('work_startdt'),
            'work_enddt' => $this->input->post('work_enddt'),
            'total_work' => $this->input->post('total_work'),
            'modified_by' => $user_id,
            'modified_at' => time()
        ];

        $query = $this->db->where('id', $id)->update('agr_estimate', $data);

        if ($query) {
            create_activity('Updated ' . $data['working_days'] . 'agr_estimate'); //create an activity
            return true;
        }
        return false;
    }










//======================================================base metrial=============================================================//
    public function add_base_materials() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

//set all data for inserting into database
        $data = [
            'type' => $this->input->post('type'),
            'seed_name' => $this->input->post('seed_name'),
            'location' => $this->input->post('location'),
            'quantity' => $this->input->post('quantity'),
            'created_by' => $user_id,
            'created_at' => time()
        ];
        $query = $this->db->insert('agri_base_materials', $data);
        if ($query) {
            create_activity('Added ' . $data['type'] . 'agri_base_materials'); //create an activity
            return true;
        }
        return false;
    }

    public function BaseMaterialListCount() {
        $query = $this->db->count_all_results('agri_base_materials');
        return $query;
    }

    public function BaseMaterialList($limit = 10, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = $user_info['role'];
        if ($role == 'admin') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('agri_base_materials');
            return $query;
        } else {
            $table_name = 'agri_base_materials';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }

    public function edit_base_material($id) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $data = [
            'type' => $this->input->post('type'),
            'seed_name' => $this->input->post('seed_name'),
            'location' => $this->input->post('location'),
            'quantity' => $this->input->post('quantity'),
            'modified_at' => time(),
            'modified_by' => $user_id
        ];


        $query = $this->db->where('id', $id)->update('agri_base_materials', $data);
        if ($query) {
            create_activity('Updated ' . $data['modified_by'] . ' agri_base_materials'); //create an activity
            return true;
        }
        return false;
    }

//=======================================================end base metrial=====================================================//
//=======================================================add land_type=========================================================//
//<-----------Add Labour Type------------->

    public function add_labour_type() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

//set all data for inserting into database
        $data = [
            'job_type' => $this->input->post('job_type'),
            'skill_level' => $this->input->post('skill_level'),
            'sector_type' => $this->input->post('sector_type'),
            'payment' => $this->input->post('payment'),
            'zone' => $this->input->post('zone'),
            'payment_per_hour' => $this->input->post('payment_per_hour'),
            'half_day_payment' => $this->input->post('half_day_payment'),
            'full_day_payment' => $this->input->post('full_day_payment'),
            'overtime_payment' => $this->input->post('overtime_payment'),
            'fixed_monthly_pay' => $this->input->post('fixed_monthly_pay'),
            'incentive' => $this->input->post('incentive'),
            'bonus' => $this->input->post('bonus'),
            'created_by' => $user_id,
            'created_at' => time()
        ];
        $query = $this->db->insert('agri_labour_type', $data);
        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'labour Type'); //create an activity
            return true;
        }
        return false;
    }

//<------------List Labour Type--------------->

    public function labourTypeListCount() {
        $query = $this->db->count_all_results('agri_labour_type');
        return $query;
    }

    public function labourTypeList($limit = 10, $start = 0) {

        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('agri_labour_type');
        return $query;
    }

//<!----------Edit Advisable------------->

    public function edit_labour_type($id) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $data = [
            'job_type' => $this->input->post('job_type'),
            'skill_level' => $this->input->post('skill_level'),
            'sector_type' => $this->input->post('sector_type'),
            'payment' => $this->input->post('payment'),
            'zone' => $this->input->post('zone'),
            'payment_per_hour' => $this->input->post('payment_per_hour'),
            'half_day_payment' => $this->input->post('half_day_payment'),
            'full_day_payment' => $this->input->post('full_day_payment'),
            'overtime_payment' => $this->input->post('overtime_payment'),
            'fixed_monthly_pay' => $this->input->post('fixed_monthly_pay'),
            'incentive' => $this->input->post('incentive'),
            'bonus' => $this->input->post('bonus'),
            'modified_at' => time(),
            'modified_by' => $user_id
        ];


        $query = $this->db->where('id', $id)->update('agri_labour_type', $data);
        if ($query) {
            create_activity('Updated ' . $data['modified_by'] . ' agri_labour_type'); //create an activity
            return true;
        }
        return false;
    }

    function job_type($job_type) {
        $where_array = array('job_type' => $job_type);
        $table_name = "agri_labour_type";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

//=====================================add_labour_account===========pending=========================================================================//

    public function add_Agriculture_input_materials() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
//set all data for inserting into database
        $data = [
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'created_by' => $user_id,
            'created_at' => time(),
            'modified_at' => time(),
            'modified_by' => $user_id
        ];
        $query = $this->db->insert('agri_input_materials', $data);
        if ($query) {
            create_activity('Added ' . $data['modified_by'] . 'agri_input_materials'); //create an activity
            return true;
        }
        return false;
    }

//editAgriculture_input_materials

    public function editAgriculture_input_materials($id) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $data = [
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'created_by' => $user_id,
            'created_at' => time(),
            'modified_at' => time(),
            'modified_by' => $user_id
        ];


        $query = $this->db->where('id', $id)->update('agri_input_materials', $data);
        if ($query) {
            create_activity('Updated ' . $data['name'] . ' agri_input_materials'); //create an activity
            return true;
        }
        return false;
    }

//view AgricultureListCount
    public function Agri_input_ListCount() {
        $query = $this->db->count_all_results('agri_input_materials');
        return $query;
    }

    public function Agri_input_List($limit = 10, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = $user_info['role'];
        if ($role == 'admin') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('agri_input_materials');
            return $query;
        } else {
            $table_name = 'agri_input_materials';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }

    function get_user($to_role) {
        $where_array = array('rolename' => $to_role);
        $table_name = "users";
        $query = $this->db->order_by('first_name', 'asc')->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
//$result = $query->result_array();
            return $query;
        } else {
            return false;
        }
    }

//==========================================================================================adviser=======================================================//

    public function add_advisable() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];




        //set all data for inserting into database
        $data = [
            'soil_type' => $this->input->post('soil_type'),
            'weather_tableid' => $this->input->post('weather_tableid'),
            'crop' => $this->input->post('crop'),
            'created_by' => $user_id,
            'created_at' => time(),
            'modified_at' => time(),
            'modified_by' => $user_id
        ];

        $query = $this->db->insert('agri_advisable', $data);

        if ($query) {
            create_activity('Added ' . $data['modified_by'] . 'agri_advisable'); //create an activity
            return true;
        }
        return false;
    }

    //<------------List Advisable--------------->

    public function advisableListCount() {
        $query = $this->db->count_all_results('agri_advisable');
        return $query;
    }

    public function advisableList($limit = 10, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = $user_info['role'];

        if ($role == 'admin') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('agri_advisable');
            return $query;
        } else {
            $table_name = 'agri_advisable';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }

    //<!----------Edit Advisable------------->

    public function edit_agri_advisable($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $data = [
            'soil_type' => $this->input->post('soil_type'),
            'weather_tableid' => $this->input->post('weather_tableid'),
            'crop' => $this->input->post('crop'),
            'created_by' => $user_id,
            'created_at' => time(),
            'modified_at' => time(),
            'modified_by' => $user_id
        ];


        $query = $this->db->where('id', $id)->update('agri_advisable', $data);

        if ($query) {
            create_activity('Updated ' . $data['soil_type'] . ' agri_advisable'); //create an activity
            return true;
        }
        return false;
    }

//==============================================labour accounts==========================================================================================//
    public function labour_account() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'main_power' => $this->input->post('main_power'),
            'zone' => $this->input->post('zone'),
            'land_id' => $this->input->post('land_id'),
            'created_by' => $user_id,
            'created_at' => time()
        ];

        $query = $this->db->insert('agri_labour_accounts', $data);

        if ($query) {
            create_activity('Added ' . $data['main_power'] . 'agri_labour_accounts'); //create an activity
            return true;
        }
        return false;
    }

    public function labour_accountListCount() {
        $query = $this->db->count_all_results('agri_labour_accounts');
        return $query;
    }

    public function labour_accountList($limit = 10, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = $user_info['role'];

        if ($role == 'admin') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('agri_labour_accounts');
            return $query;
        } else {
            $table_name = 'agri_labour_accounts';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }

//======================================================for onchange function=========naveen=========================================// 

    function state($country) {
        $where_array = array('country' => $country);
        $table_name = "pincode";
        $query = $this->db->group_by('state')->where($where_array)->get($table_name);


        return $query;
    }

    function district($state) {
        $where_array = array('state' => $state);
        $table_name = "pincode";
        $query = $this->db->group_by('district')->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {

            return $query;
        } else {
            return false;
        }
    }

    function taluk($district) {
        $where_array = array('district' => $district);
        $table_name = "pincode";
        $query = $this->db->group_by('taluk')->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {

            return $query;
        } else {
            return false;
        }
    }

    function location($taluk) {
        $where_array = array('taluk' => $taluk);
        $table_name = "pincode";
        $query = $this->db->order_by('location', 'asc')->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return $query;
        } else {
            return false;
        }
    }

    function pincode($location) {
        $where_array = array('location' => $location);
        $table_name = "pincode";
        $query = $this->db->order_by('pincode', 'asc')->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return $query;
        } else {
            return false;
        }
    }

//===============================================================add project==========================================================//
    public function crate_project() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
		
            'land_id' 		=> $this->input->post('land_id'),
            //'country'		=> $this->input->post('country'),
            //'state' 		=> $this->input->post('state'),
           //'district'	=> $this->input->post('district'),
            //'taluk' 		=> $this->input->post('taluk'),
           // 'location_id' => $this->input->post('location_id'),
            //'pincode' 	=> $this->input->post('pincode'),
            'usuage_type'   => $this->input->post('usuage_type'),
            'land_type' 	=> $this->input->post('land_type'),
            'project_name'  => $this->input->post('project_name'),
            'village_name'  => $this->input->post('village_name'),
            'created_by' 	=> $user_id,
            'created_at' 	=> time()
        ];

        $query = $this->db->insert('add__agri_project', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'add__agri_project'); //create an activity
            return true;
        }
        return false;
    }

    public function agriculture_projectListCount() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        if ($currentUser == 'admin') {
            $query = $this->db->count_all_results('add__agri_project');
        } else {
            $query = $this->db->where('created_by ', $user_id)->count_all_results('add__agri_project');
        }
        return $query;
    }

    public function agriculture_projecteList($limit = 0, $start = 0) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        $search = $this->input->get('search');
        $searchValue = $search['value'];

        $searchByID = '';
        if ($rolename == '11') {
            if ($searchValue != '') {
                $table_name = "add__agri_project";
                $where_array = array('project_name' => $searchValue);
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            } else {
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('add__agri_project');
            }
        } else {
            if ($searchValue != '') {
                $table_name = "add__agri_project";
                $where_array = array('project_name' => $searchValue, 'created_by' => $user_id);
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            } else {
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('add__agri_project', ['created_by' => $user_id]);
            }
        }
        return $query;
    }

    public function edit_project($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $data = [
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'district' => $this->input->post('district'),
            'taluk' => $this->input->post('taluk'),
            'location_id' => $this->input->post('location_id'),
            'pincode' => $this->input->post('pincode'),
            'project_name' => $this->input->post('project_name'),
            'village_name' => $this->input->post('village_name'),
            'modified_at' => time(),
            'modified_by' => $user_id
        ];


        $query = $this->db->where('id', $id)->update('add__agri_project', $data);

        if ($query) {
            create_activity('Updated ' . $data['modified_by'] . ' add__agri_project'); //create an activity
            return true;
        }
        return false;
    }
	//====================================================add ====================================================================//
	//Farm maintenance
	
//	    public function farm_maitenance2() {
		public function view_crop_project() {	

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       //set all data for inserting into database
	   //
   if(!empty($_POST['acti']))
	{
			
			
		foreach($_POST['acti'] as $cnt => $acti)
		{
			
			
			$acti 			= $_POST['acti'][$cnt];
			
			$activity			= $_POST['activity'][$cnt];
			$start_Date			= $_POST['start_Date'][$cnt];
			$end_Date			= $_POST['end_Date'][$cnt];
			$activity_type		= $_POST['activity_type'][$cnt];
			$no_labours			= $_POST['no_labours'][$cnt];
			$labours_id			= $_POST['labours_id'][$cnt];
			$avg_wrk_lbr		= $_POST['avg_wrk_lbr'][$cnt];
			$wages_per_labour	= $_POST['wages_per_labour'][$cnt];
			$area_per_labour	= $_POST['area_per_labour'][$cnt];
			$total_labour		= $_POST['total_labour'][$cnt];
			$machinary			= $_POST['machinary'][$cnt];
			$tool			    = $_POST['tool'][$cnt];
			$mch_chg_hrs		= $_POST['mch_chg_hrs'][$cnt];
			$tool_chg_hrs		= $_POST['tool_chg_hrs'][$cnt];
			$trnp_cost			= $_POST['trnp_cost'][$cnt];
			$food_cost			= $_POST['food_cost'][$cnt];			
			$used_inputs		= $_POST['used_inputs'][$cnt];
			$inputs_qty			= $_POST['inputs_qty'][$cnt];
			$inputs_cost		= $_POST['inputs_cost'][$cnt];
			$used_pesticides	= $_POST['used_pesticides'][$cnt];
			$pesticides_qty		= $_POST['pesticides_qty'][$cnt];
			$pesticides_cost	= $_POST['pesticides_cost'][$cnt];
			$total_exp_day		= $_POST['total_exp_day'][$cnt]; 
			
			$count = $this->db->count_all_results('agri_crop_maint');
			$p_count = $count + 1;
			
			$id_activity = $this->input->post('acti_id');
			

			$data = [
			
			


						'id_activity'       => $id_activity,
						'start_Date'        => $start_Date,
						'end_Date'          => $end_Date,
						'activity_type'     => $activity_type,
						'activity'          => $acti,
						'no_labours'        => $no_labours,
						'labours_id'        => $labours_id,		
						'avg_wrk_lbr'       => $avg_wrk_lbr,
						'wages_per_labour'  => $wages_per_labour,
						'area_per_labour'   => $area_per_labour,
						'total_labour'      => $total_labour,
						'machinary'    		=> $machinary,	
						'tool'    			=> $tool,
						'mch_chg_hrs'       => $mch_chg_hrs,
						'tool_chg_hrs'      => $tool_chg_hrs,
						'trnp_cost'         => $trnp_cost,
						'food_cost'         => $food_cost,
						'used_inputs'       => $used_inputs,
						'inputs_qty'        => $inputs_qty,
						'inputs_cost'       => $inputs_cost,
						'used_pesticides'   => $used_pesticides,
						'pesticides_qty'    => $pesticides_qty,
						'pesticides_cost'   => $pesticides_cost,
						'total_exp_day'     => $total_exp_day,

						
						'created_at'          => time(),
						'created_by'          => $user_id,
						'modified_at'         => time(),
						'modified_by'         => $user_id
					];
			$query = $this->db->insert('agri_crop_maint', $data);
			
			 $insert_id = $this->db->insert_id();
			
		}
		
	}
	   

        if ($query ) {
           create_activity('Added ' . $data['created_by'] . 'product_ingredients'); //create an activity
            return  $id_activity;
        }
        return false;
    }

	
	/*****************************************dashboard***********************************************8*/
public function count_all_agriland()
{
	$query = $this->db->count_all_results('agr_landid');
	return $query;
}
public function count_all_agriproject()
{
	$query = $this->db->count_all_results('add__agri_project');
	return $query;
}
public function count_all_landestimate()
{
	$query = $this->db->count_all_results('agr_estimate');
	return $query;
}
public function count_all_labouraccount()
{
	$query = $this->db->count_all_results('agri_labour_accounts');
	return $query;
}


public function count_all_labourtype()
{
	$query = $this->db->count_all_results('agri_labour_type');
	return $query;
}


public function count_all_basematrials()
{
	$query = $this->db->count_all_results('agri_base_materials');
	return $query;
}



public function count_all_inputmatrials()
{
	$query = $this->db->count_all_results('agri_land_type');
	return $query;
}

public function count_all_agriadvisable()
{
	$query = $this->db->count_all_results('agri_advisable');
	return $query;
}


/************************************dashboard**********************************************/



//searching
	
	public function search_agriculture_listCount($id_activity, $sf_time, $st_time)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		if($id_activity !='')
		{
		 $condition.="id_activity = '".$id_activity."'";
			
		}
		
			if($sf_time !='' && $st_time !='')
			{
				$start_fdt = new DateTime($sf_time);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_time);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_time !='' && $st_time !=''){
			if($condition != ""){
				
			$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
		if($currentUser=='admin')
		{
			if($condition !='')
			{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('farm_maintenance');
			}
		
			else
			{
			$query = $this->db->count_all_results('farm_maintenance');
			}
		}
		
		else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array."AND created_by = '".$user_id."'";
                $query = $this->db->where($where_array)->count_all_results('farm_maintenance');
            }else
            {
            $where = array('created_by' => $user_id);
            $query = $this->db->where($where)->count_all_results('farm_maintenance');
        }
        } 
		
        return $query;
		
    }

	
	public function search_agriculture_list($limit=10, $start=0,$id_activity,$sf_time, $st_time){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		if($id_activity !='')
		{
		 $condition.=" id_activity = '".$id_activity."'";
			
		}
		
		
		if($sf_time !='' && $st_time !='')
			{
				$start_fdt = new DateTime($sf_time);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_time);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_time !='' && $st_time !=''){
			if($condition != ""){
				
			$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.=" DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
		
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('farm_maintenance');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('farm_maintenance');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('farm_maintenance');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('farm_maintenance');
        }
        } 
        return $query;
	}
	
	public function get_total_budget($id_activity,$sf_time, $st_time){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		if($id_activity !='')
		{
		 $condition.=" id_activity = '".$id_activity."'";
			
		}
		
		
		if($sf_time !='' && $st_time !='')
			{
				$start_fdt = new DateTime($sf_time);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_time);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_time !='' && $st_time !=''){
			if($condition != ""){
				
			$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.=" DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
		
		
		
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('farm_maintenance');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('farm_maintenance');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('farm_maintenance');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('farm_maintenance');
        }
        } 
        return $query;
	}
	
	
	
/************************* Agriculture land Report***************************/

//searching
	
	public function search_agriculture_land_listCount($land_id, $sf_time, $st_time)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		if($land_id !='')
		{
		 $condition.="land_id = '".$land_id."'";
			
		}
		
			if($sf_time !='' && $st_time !='')
			{
				$start_fdt = new DateTime($sf_time);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_time);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_time !='' && $st_time !=''){
			if($condition != ""){
				
			$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
		if($currentUser=='admin')
		{
			if($condition !='')
			{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('agr_landid');
			}
		
			else
			{
			$query = $this->db->count_all_results('agr_landid');
			}
		}
		
		else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array."AND created_by = '".$user_id."'";
                $query = $this->db->where($where_array)->count_all_results('agr_landid');
            }else
            {
            $where = array('created_by' => $user_id);
            $query = $this->db->where($where)->count_all_results('agr_landid');
        }
        } 
		
        return $query;
		
    }

	
	public function search_agriculture_land_list($limit=10, $start=0,$land_id,$sf_time, $st_time){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		if($land_id !='')
		{
		 $condition.=" land_id = '".$land_id."'";
			
		}
		
		
		if($sf_time !='' && $st_time !='')
			{
				$start_fdt = new DateTime($sf_time);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_time);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_time !='' && $st_time !=''){
			if($condition != ""){
				
			$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.=" DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
		
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('agr_landid');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('agr_landid');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('agr_landid');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('agr_landid');
        }
        } 
        return $query;
	}
	
}//last Brase Required


