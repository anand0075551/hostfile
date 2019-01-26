<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Points_mode_model extends CI_Model {

    public function create_points_mode() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //check unique $account_no
        //set all data for inserting into database
        $data = [
            'pm_name' => $this->input->post('pm_name'),
            'created_by' => $user_id,
            'created_at' => time()
        ];
        $query = $this->db->insert('points_mode', $data);

        if ($query) {
            create_activity('Added ' . $data['name'] . 'points_mode'); //create an activity
            return true;
        }
        return false;
    }

   

    public function points_modeListCount() {
//        $queryCount = $this->db->count_all_results('categories'); 
        $queryCount = $this->db->count_all_results('points_mode');
        return $queryCount;
    }

    public function points_modeList() {
        $limit = '0';
        $start = '0';

        $search = $this->input->get('search');
        $searchValue = $search['value'];

        $searchByID = '';
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;


        if ($searchValue != '') {
            $table_name = "points_mode";
            $where_array = array('pm_name' => $searchValue);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
        } else {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('points_mode');
        }

        return $query;
    }

    public function points_mode_edit($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];


        //set all data for inserting into database
        $data = [
            'pm_name' => $this->input->post('pm_name'),
            'modified_by' => $user_id,
            'modified_at' => time()
        ];

        $query = $this->db->where('id', $id)->update('points_mode', $data);

        if ($query) {
            create_activity('Updated ' . $data['name'] . 'points_mode'); //create an activity
            return true;
        }
        return false;
    }

    

}

?>