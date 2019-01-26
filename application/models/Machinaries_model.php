<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Machinaries_model extends CI_Model {

    /**
     * @return bool
     */
    public function add_machinaries() {
        //$data['referral_code'] = $this->db->get('users');
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $root_id = singleDbTableRow($user_id)->referral_code;

        $data = [
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'bedin_date' => $this->input->post('bedin_date'),
            'end_date' => $this->input->post('end_date'),
            'current_status' => $this->input->post('current_status'),
            'hire_type' => $this->input->post('hire_type'),
            'vehicle_id' => $this->input->post('vehicle_id'),
            'created_by' => $user_id,
            'created_at' => time()
        ];

        $query = $this->db->insert('machinaries', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'machinaries'); //create an activity
            return true;
        }
        return false;
    }
	
	
	 public function copy_machinaries($id) {
        //$data['referral_code'] = $this->db->get('users');
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $root_id = singleDbTableRow($user_id)->referral_code;

        $data = [
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'bedin_date' => $this->input->post('bedin_date'),
            'end_date' => $this->input->post('end_date'),
            'current_status' => $this->input->post('current_status'),
            'hire_type' => $this->input->post('hire_type'),
            'vehicle_id' => $this->input->post('vehicle_id'),
            'created_by' => $user_id,
            'created_at' => time()
        ];

        $query = $this->db->insert('machinaries', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'machinaries'); //create an activity
            return true;
        }
        return false;
    }


    //transport module view

    public function machinariesListCount() {

        $query = $this->db->count_all_results('machinaries');
        return $query;
    }

    public function machinariesList($limit =0, $start = 0) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;

        if ($currentUser == 'admin') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('machinaries');
            return $query;
        } else {
            $table_name = 'machinaries';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }

    public function edit_machinaries($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $data = [
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'bedin_date' => $this->input->post('bedin_date'),
            'end_date' => $this->input->post('end_date'),
            'current_status' => $this->input->post('current_status'),
            'hire_type' => $this->input->post('hire_type'),
            'vehicle_id' => $this->input->post('vehicle_id'),
            'modified_by' => $user_id,
            'modified_at' => time()
        ];

        $query = $this->db->where('id', $id)->update('machinaries', $data);

        if ($query) {
            create_activity('Updated ' . $data['modified_by'] . 'machinaries'); //create an activity
            return true;
        }
        return false;
    }

		
/************************* Machinaries Report***************************/

//searching
	
	public function search_machinaries_listCount($name,$vehicle_id, $sf_time, $st_time)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		
	if($name !='')
		{
			if($condition != ""){
				$condition.=" AND name = '".$name."'";
			}
			else{
				$condition.="name = '".$name."'";
			}
		}
		
		if($vehicle_id !='')
		{
			if($condition != ""){
				$condition.=" AND vehicle_id = '".$vehicle_id."'";
			}
			else{
				$condition.="vehicle_id = '".$vehicle_id."'";
			}
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
			$query = $this->db->where($where_array)->count_all_results('machinaries');
			}
		
			else
			{
			$query = $this->db->count_all_results('machinaries');
			}
		}
		
		else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array."AND created_by = '".$user_id."'";
                $query = $this->db->where($where_array)->count_all_results('machinaries');
            }else
            {
            $where = array('created_by' => $user_id);
            $query = $this->db->where($where)->count_all_results('machinaries');
        }
        } 
		
        return $query;
		
    }

	
	public function search_machinaries_list($limit=10, $start=0,$name,$vehicle_id,$sf_time, $st_time){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
			
	if($name !='')
		{
			if($condition != ""){
				$condition.=" AND name = '".$name."'";
			}
			else{
				$condition.="name = '".$name."'";
			}
		}
		if($vehicle_id !='')
		{
			if($condition != ""){
				$condition.=" AND vehicle_id = '".$vehicle_id."'";
			}
			else{
				$condition.="vehicle_id = '".$vehicle_id."'";
			}
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
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('machinaries');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('machinaries');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('machinaries');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('machinaries');
        }
        } 
        return $query;
	}
	
}

//last brace required
	