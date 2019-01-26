<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Business_status_model extends CI_Model {

    public function add_business_status() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$bs = implode(",", $this->input->post('to_role'));
        if ($bs == '') {
            $bs = 0;
        }
        //set all data for inserting into database
        $data = [
            'status' => $this->input->post('status'),
            'business_name' => $this->input->post('business_name'),
            'to_role' => $bs,
            'lang_en' => $this->input->post('language_en'),
            'created_by' => $user_id,
            'created_at' => time(),
        ];

        $query = $this->db->insert('status', $data);

        if ($query) {
            create_activity('Added ' . $data['business_name'] . ' status'); //create an activity
            return true;
        }
        return false;
    }

    public function edit_business_status($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$bs = implode(",", $this->input->post('to_role'));
        if ($bs == '') {
            $bs = 0;
        }
        //set all data for inserting into database
        $data = [
            'status' => $this->input->post('status'),
            'business_name' => $this->input->post('business_name'),
            'to_role' => $bs,
            'lang_en' => $this->input->post('language_en'),
            'modified_by' => $user_id,
            'modified_at' => time()
        ];

        $query = $this->db->where('id', $id)->update('status', $data);

        if ($query) {
            create_activity('Updated ' . $data['business_name'] . ' status'); //create an activity
            return true;
        }
        return false;
    }

    public function statusListCount() {
        $query = $this->db->count_all_results('status');
        return $query;
    }

    public function statusList($limit = 0, $start = 0) {
        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('status');
        return $query;
    }

}
