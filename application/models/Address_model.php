<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Address_model extends CI_Model {

    public function addAddress() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];



        $bg = implode(",", $this->input->post('business_groups'));
        if ($bg == '') {
            $bg = 0;
        }
		$rolename = singleDbTableRow($user_id)->rolename;
        //set all data for inserting into database
        $data = [
			'rolename' 			=> $rolename,
            'business_name'	    => $bg,
            'user_id' 			=> $user_id,
            'root_id' 			=> $this->input->post('ref_id'),
            'address_type'	    => $this->input->post('address_type'),
            'country' 			=> $this->input->post('country'),
            'state' 			=> $this->input->post('state'),
            'district'		    => $this->input->post('district'),
            'location_id'	    => $this->input->post('location_id'),
            'pincode' 			=> $this->input->post('pincode'),
            'house_buildingno'  => $this->input->post('house_buildingno'),
            'street_name' 		=> $this->input->post('street_name'),
            'land_mark' 		=> $this->input->post('land_mark'),
            'created_by' 		=> $user_id,
            'created_at' 		=> time(),
        ];

        $query = $this->db->insert('user_address', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'user_address'); //create an activity
            return true;
        }
        return false;
    }

    public function addressListCount() {
        $query = $this->db->count_all_results('user_address');
        return $query;
    }

    public function addressList($limit = 0, $start = 0) {

        $search = $this->input->get('search');
        $searchValue = $search['value'];
        $searchByID = '';


        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        if ($rolename == '11') {
            if ($searchValue != '') {
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('user_address', ['root_id' => $searchValue]);
            } else {
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('user_address');
            }
        } else {
            $query = $this->db->where('created_by', $user_id)->get('user_address');
        }
        return $query;
    }

    public function edit_address($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
      //  $bg = implode(",", $this->input->post('business_groups'));
		$rolename = singleDbTableRow($user_id)->rolename;
        //set all data for inserting into database
		        $bg = implode(",", $this->input->post('business_groups'));
        if ($bg == '') {
            $bg = 0;
        }
        $data = [
			'rolename'    			=> $rolename,
			'business_name'	   	    => $bg,
            'user_id' 				=> $user_id,
            'address_type'		    => $this->input->post('address_type'),
            'country' 				=> $this->input->post('country'),
            'state' 				=> $this->input->post('state'),
            'district' 				=> $this->input->post('district'),
            'location_id'		    => $this->input->post('location_id'),
            'pincode' 				=> $this->input->post('pincode'),
            'house_buildingno' 		=> $this->input->post('house_buildingno'),
            'street_name'		    => $this->input->post('street_name'),
            'land_mark' 			=> $this->input->post('land_mark'),
            'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query = $this->db->where('id', $id)->update('user_address', $data);

        if ($query) {
            create_activity('Updated ' . $data['modified_by'] . 'user_address'); //create an activity
            return true;
        }
        return false;
    }

    /*
      Get state
     */

    function state($country) {
        $where_array = array('country' => $country);
        $table_name = "pincode";
        $query = $this->db->group_by('state')->order_by('state', 'asc')->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function district($state) {
        $where_array = array('state' => $state);
        $table_name = "pincode";
        $query = $this->db->group_by('district')->order_by('district', 'asc')->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return $query;
        } else {
            return false;
        }
    }

    function location($district) {
        $where_array = array('district' => $district);
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

    function area($location_id) {
        $where_array = array('location' => $location_id);
        $table_name = "area";
        $query = $this->db->group_by('location')->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return $query;
        } else {
            return false;
        }
    }

    function address_type($address_type) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $where_array = array('user_id' => $user_id, 'address_type' => $address_type);
        $table_name = "user_address";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return true;
        } else {
            return false;
        }
    }

}
