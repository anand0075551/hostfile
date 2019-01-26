<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher_permission_model extends CI_Model {

    public function add_voucher_permission() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       
		$hrs_gap = $this->input->post('hrs_gap');
		
		$start_date = $this->input->post('start_date');

		if($hrs_gap != ""){
			$days = number_format($hrs_gap/24);
		
			$date = strtotime("+".$days." days", strtotime($start_date));
			
			$end_date = date("Y-m-d", $date);
		}
		else{
			$end_date = '2020-12-31';
		}
		
		
		


        //set all data for inserting into database
        $data = [
            'voc_name' => $this->input->post('voc_name'),			
            'business_name' => $this->input->post('business_name'),			
            'pay_type' => $this->input->post('pay_type'),
            'paytype_to' => $this->input->post('paytype_to'),
            'to_role' => $this->input->post('to_role'),
            'to_user' => $this->input->post('to_user'),
            'percentage' => $this->input->post('percentage'),
            'no_of_split' => $this->input->post('no_of_split'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $end_date,
            'voc_type' => $this->input->post('voc_type'),
            'created_by' => $user_id,
            'created_at' => time(),
            'modified_at' => time(),
            'modified_by' => $user_id
        ];

        $query = $this->db->insert('voc_generate', $data);

        if ($query) {
            create_activity('Added ' . $data['voc_name'] . 'in voucher permission'); //create an activity
            return true;
        }
        return false;
    }

	/*
    Get state
    */
    function get_user($to_role)
    {
      $where_array = array( 'rolename' => $to_role );
      $table_name="users";
       $query = $this->db->order_by('first_name', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	

  //Edit_Voucher
  
     public function edit_voucher($id){ 

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       
		$hrs_gap = $this->input->post('hrs_gap');
		
		$start_date = $this->input->post('start_date');

		if($hrs_gap != ""){
			$days = number_format($hrs_gap/24);
		
			$date = strtotime("+".$days." days", strtotime($start_date));
			
			$end_date = date("Y-m-d", $date);
		}
		else{
			$end_date = '2020-12-31';
		}
		
        $data = [
			
			'voc_name' => $this->input->post('voc_name'),
			'business_name' => $this->input->post('business_name'),
            'pay_type' => $this->input->post('pay_type'),
			'paytype_to' => $this->input->post('paytype_to'),
            'to_role' => $this->input->post('to_role'),
            'to_user' => $this->input->post('to_user'),
            'percentage' => $this->input->post('percentage'),
            'no_of_split' => $this->input->post('no_of_split'),
			'start_date' => $this->input->post('start_date'),
            'end_date' => $end_date,
            'voc_type' => $this->input->post('voc_type'),
            'created_by' => $user_id,
            'created_at' => time(),
            'modified_at' => time(),
            'modified_by' => $user_id
        ];
		
		
        $query = $this->db->where('id', $id)->update('voc_generate', $data);

        if($query)
        {
            create_activity('Updated '.$data['voc_name'].' in voucher permission'); //create an activity
            return true;
        }
        return false;

    }

	
    public function VoucherListCount() {
        $query = $this->db->count_all_results('voc_generate');
        return $query;
    }

    public function VoucherList($limit = 10, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = $user_info['role'];

        if ($role == 'admin') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('voc_generate');
            return $query;
        } else {
            $table_name = 'voc_generate';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }

   

}
