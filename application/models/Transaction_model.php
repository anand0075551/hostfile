<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {

    public function add_transaction() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        //check user is selected photo
        if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = '*';
            $config['max_size'] = 2048;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        }



        //set all data for inserting into database
        $data = [
            'transaction_mode' => $this->input->post('transaction_mode'),
            'main_category' => $this->input->post('main_category'),
            'business_name' => $this->input->post('business_name'),
            'reporting_manager' => $this->input->post('reporting_manager'),
            'trans_date' => $this->input->post('trans_date'),
            'trans_time' => $this->input->post('trans_time'),
            'amount' => $this->input->post('amount'),
            'comments' => $this->input->post('comments'),
            'receiver_name' => $this->input->post('receiver_name'),
            'sancatie_by' => $this->input->post('sancatie_by'),
            'photo' => $photoName,
            'created_by' => $user_id,
            'created_at' => time()
        ];

        $query = $this->db->insert('regular_transaction', $data);

        if ($query) {
            create_activity('Added ' . $data['name'] . 'regular_transaction'); //create an activity
            return true;
        }
        return false;
    }

    //view transaction
    public function transactionListCount() {
        $query = $this->db->count_all_results('regular_transaction');
        return $query;
    }

    public function transactionList($limit = 10, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = $user_info['role'];

        if ($role == 'admin') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('regular_transaction');
            return $query;
        } else {
            $table_name = 'regular_transaction';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }

    public function edit_transaction($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        if ($_FILES['userfile']['name'] != '') {

            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2048;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        }

        //set all data for inserting into database
        $data = [
            'transaction_mode' => $this->input->post('transaction_mode'),
            //'main_category'           => $this->input->post('main_category'),
            // 'business_name'           => $this->input->post('business_name'),
            'reporting_manager' => $this->input->post('reporting_manager'),
            'trans_date' => $this->input->post('trans_date'),
            //'trans_time' => $this->input->post('trans_time'),
            'amount' => $this->input->post('amount'),
            'comments' => $this->input->post('comments'),
            'receiver_name' => $this->input->post('receiver_name'),
            'sancatie_by' => $this->input->post('sancatie_by'),
            'photo' => $photoName,
            'modified_by' => $user_id,
            'modified_at' => time()
        ];

        $query = $this->db->where('id', $id)->update('regular_transaction', $data);

        if ($query) {
            create_activity('Updated ' . $data['name'] . 'regular_transaction'); //create an activity
            return true;
        }
        return false;
    }

}
