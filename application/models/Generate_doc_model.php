<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Generate_doc_model extends CI_Model {

    /**
     * @return bool
     */
    public function generate_doc() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];



        $data = [
            'role' => $this->input->post('role'),
            'file_name' => $this->input->post('fname'),
            'userfile' => $this->input->post('userfile'),
            'status' => $this->input->post('status'),
            'created_by' => $user_id,
            'created_at' => time()
        ];

        $query = $this->db->insert('generate_doc', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'generate_doc'); //create an activity
            return true;
        }
        return false;
    }

    //transport module view

    public function generateDocListCount() {

        $query = $this->db->count_all_results('dashbord');
        return $query;
    }

    public function generateDocList($limit = 10, $start = 0) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $currentRoleName = singleDbTableRow($user_id)->rolename;

        if ($currentUser == 'admin') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('generate_doc');
            return $query;
        } else {
            $table_name = 'generate_doc';
            $where_array = array('role' => $currentRoleName);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get_where('generate_doc',['status'=>'1']);
            return $query;
        }
    }

    public function edit_generated_doc($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
 $data = [
            'role' => $this->input->post('role'),
            'file_name' => $this->input->post('fname'),
            'userfile' => $this->input->post('userfile'),
            'status' => $this->input->post('status'),

            'modified_by' => $user_id,
            'modified_at' => time()
        ];

        $query = $this->db->where('id', $id)->update('generate_doc', $data);

        if ($query) {
            create_activity('Updated ' . $data['name'] . 'generate_doc'); //create an activity
            return true;
        }
        return false;
    }

	
	    public function pdf_doc($id) {

        $table_name = 'generate_doc';
            $where_array = array('role' => $currentRoleName);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('generate_doc');

        return $query;
    }
	
	
	
	
	
	
	
	
	
	
}

//last brace required
	