<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Refer_model extends CI_Model {

    public function search_user_listCount($contactno, $rolename, $email, $active,$assigned_to_name, $referral_code, $referredByCode, $sf_time, $st_time, $dob1, $dob2)
	{
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		if($contactno !='')
		{
		 $condition.="contactno = '".$contactno."'";
			
		}
		
		if($assigned_to_name !='')
		{
			if($condition != ""){
				$condition.=" AND id = '".$assigned_to_name."'";
			}
			else{
				$condition.="id = '".$assigned_to_name."'";
			}
		}
		
	
		
		if($rolename !='')
		{
			if($condition != ""){
				$condition.=" AND rolename = '".$rolename."'";
			}
			else{
				$condition.="rolename = '".$rolename."'";
			}
		}
		if($referral_code !='')
		{   
			if($condition != "")
			{
			$condition.="AND referral_code = '".$referral_code."'";
			}
			else
			{
				$condition.="referral_code = '".$referral_code."'";
			}
		}
		if($email !='')
		{
			if($condition != ""){
				$condition.=" AND email = '".$email."'";
			}
			else{
				$condition.="email = '".$email."'";
			}
		}
		if($active !='')
		{
			if($condition != ""){
				$condition.=" AND active = '".$active."'";
			}
			else{
				$condition.="active = '".$active."'";
			}
		}
		if($referredByCode !='')
		{
			if($condition != ""){
				$condition.=" AND referredByCode = '".$referredByCode."'";
			}
			else{
				$condition.="referredByCode = '".$referredByCode."'";
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
			if($dob1 !='' && $dob2 !='')
			{
				$start_fdt = new DateTime($dob1);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($dob2);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($dob1 !='' && $dob2 !=''){
			if($condition != ""){
				
			$condition.=" AND DATE(date_of_birth) >= '".$start_from."' AND DATE(date_of_birth) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(date_of_birth) >= '".$start_from."' AND DATE(date_of_birth) <= '".$start_to."'";
			}
		}
		
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('users');
		}
		else
		{
			$query = $this->db->count_all_results('users');
		}
		
        return $query;
    }

	
	public function search_user_list($limit=10, $start=0,$contactno, $rolename, $email, $active,$assigned_to_name, $referral_code, $referredByCode, $sf_time, $st_time, $dob1, $dob2){
		
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		if($contactno !='')
		{
		 $condition.="contactno = '".$contactno."'";
			
		}
		
		if($assigned_to_name !='')
		{
			if($condition != ""){
				$condition.=" AND id = '".$assigned_to_name."'";
			}
			else{
				$condition.="id = '".$assigned_to_name."'";
			}
		}
		
		
		
		if($rolename !='')
		{
			if($condition != ""){
				$condition.=" AND rolename = '".$rolename."'";
			}
			else{
				$condition.="rolename = '".$rolename."'";
			}
		}
		if($referral_code !='')
		{   
			if($condition != "")
			{
			$condition.="AND referral_code = '".$referral_code."'";
			}
			else
			{
				$condition.="referral_code = '".$referral_code."'";
			}
		}
		if($email !='')
		{
			if($condition != ""){
				$condition.=" AND email = '".$email."'";
			}
			else{
				$condition.="email = '".$email."'";
			}
		}
		if($active !='')
		{
			if($condition != ""){
				$condition.=" AND active = '".$active."'";
			}
			else{
				$condition.="active = '".$active."'";
			}
		}
		if($referredByCode !='')
		{
			if($condition != ""){
				$condition.=" AND referredByCode = '".$referredByCode."'";
			}
			else{
				$condition.="referredByCode = '".$referredByCode."'";
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

			if($dob1 !='' && $dob2 !='')
			{
				$start_fdt = new DateTime($dob1);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($dob2);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($dob1 !='' && $dob2 !=''){
			if($condition != ""){
				
			$condition.=" AND DATE(date_of_birth) >= '".$start_from."' AND DATE(date_of_birth) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(date_of_birth) >= '".$start_from."' AND DATE(date_of_birth) <= '".$start_to."'";
			}
		}
	
		if($condition !='')
		{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('users');
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('users');
		}
        return $query;
	}
	


    public function userTrackListCount() {
        $user = loggedInUserData();
        $userID = $user['user_id'];
        $role = singleDbTableRow($userID)->role;
        {
            $query = $this->db->count_all_results('user_track');
        }
        return $query;
    }

	// get role name
	//
  function get_user2($to_role)
    {
      $where_array = array( 'role_groups' => $to_role );
      $table_name="role";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
//
  function get_user1($to_role)
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
//
    public function userTrackList($limit = 0, $start = 0) {
        $user = loggedInUserData();
        $userID = $user['user_id'];
        $role = singleDbTableRow($userID)->role;


        $table_name = "user_track";
        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($table_name);

        return $query;
    }

    public function edit_referral_tree($id) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $rolename = singleDbTableRow($id)->rolename;
        $data1 = [
            'referral_code' => $this->input->post('referral_code'),
            'active' => $this->input->post('status'),
            'modified_by' => $user_id,
            'modified_at' => time()
        ];

        $query1 = $this->db->where('id', $id)->update('users', $data1);

        $data2 = [
            'user_id' => $id,
            'rolename' => $rolename,
            'referral_code' => $this->input->post('referral_code'),
            'status' => $this->input->post('status'),
            'action_by' => $user_id,
            'action_at' => time()
        ];
        $query2 = $this->db->insert('user_track', $data2);
        if ($query1 & $query2) {
            return true;
        }
        return false;
    }

    public function search_user_report_ListCount($user_id, $rolename, $status, $referral_code, $sf_time, $st_time) {

        $search = $this->input->get('search');
        $searchValue = $search['value'];

        $searchByID = '';
        $condition = "";
        if ($user_id != '') {
            $condition .= "user_id = '" . $user_id . "'";
        }
        if ($rolename != '') {
            if ($condition != "") {
                $condition .= " AND rolename = '" . $rolename . "'";
            } else {
                $condition .= "rolename = '" . $rolename . "'";
            }
        }
        if ($referral_code != '') {
            if ($condition != "") {
                $condition .= "AND referral_code = '" . $referral_code . "'";
            } else {
                $condition .= "referral_code = '" . $referral_code . "'";
            }
        }
        if ($status != '') {
            if ($condition != "") {
                $condition .= " AND status = '" . $status . "'";
            } else {
                $condition .= "status = '" . $status . "'";
            }
        }
        if ($sf_time != '' && $st_time != '') {
            $start_fdt = new DateTime($sf_time);
            $start_from = $start_fdt->format('Y-m-d');

            $start_tdt = new DateTime($st_time);
            $start_to = $start_tdt->format('Y-m-d');
        }

        if ($sf_time != '' && $st_time != '') {
            if ($condition != "") {

                $condition .= " AND DATE(FROM_UNIXTIME(action_at)) >= '" . $start_from . "' AND DATE(FROM_UNIXTIME(action_at)) <= '" . $start_to . "'";
            } else {
                $condition .= "DATE(FROM_UNIXTIME(action_at)) >= '" . $start_from . "' AND DATE(FROM_UNIXTIME(action_at)) <= '" . $start_to . "'";
            }
        }

        if ($condition != '') {
            $where_array = $condition;
        }


        if ($searchValue != '') {
            $where_array = $where_array . " AND user_id like '%" . $searchValue . "%' OR rolename like '%" . $searchValue . "%'OR status like '%" . $searchValue . "%'OR referral_code like '%" . $searchValue . "%'OR action_at like '%" . $searchValue . "%'";
            $query = $this->db->where($where_array)->count_all_results('user_track');
        } else {
            $query = $this->db->where($where_array)->count_all_results('user_track');
        }
        return $query;
    }

//searching List	
    public function search_user_report_List($limit, $user_id, $rolename, $status, $start, $referral_code, $sf_time, $st_time) {

        $search = $this->input->get('search');
        $searchValue = $search['value'];

        $searchByID = '';
        $condition = "";
        if ($user_id != '') {
            $condition .= "user_id = '" . $user_id . "'";
        }
        if ($rolename != '') {
            if ($condition != "") {
                $condition .= " AND rolename = '" . $rolename . "'";
            } else {
                $condition .= "rolename = '" . $rolename . "'";
            }
        }
        if ($referral_code != '') {
            if ($condition != "") {
                $condition .= "AND referral_code = '" . $referral_code . "'";
            } else {
                $condition .= "referral_code = '" . $referral_code . "'";
            }
        }
        if ($status != '') {
            if ($condition != "") {
                $condition .= " AND status = '" . $status . "'";
            } else {
                $condition .= "status = '" . $status . "'";
            }
        }
        if ($sf_time != '' && $st_time != '') {
            $start_fdt = new DateTime($sf_time);
            $start_from = $start_fdt->format('Y-m-d');

            $start_tdt = new DateTime($st_time);
            $start_to = $start_tdt->format('Y-m-d');
        }

        if ($sf_time != '' && $st_time != '') {
            if ($condition != "") {

                $condition .= " AND DATE(FROM_UNIXTIME(action_at)) >= '" . $start_from . "' AND DATE(FROM_UNIXTIME(action_at)) <= '" . $start_to . "'";
            } else {
                $condition .= "DATE(FROM_UNIXTIME(action_at)) >= '" . $start_from . "' AND DATE(FROM_UNIXTIME(action_at)) <= '" . $start_to . "'";
            }
        }

        if ($condition != '') {
            $where_array = $condition;
        }


        if ($searchValue != '') {
            $where_array = $where_array . " AND user_id like '%" . $searchValue . "%' OR rolename like '%" . $searchValue . "%'OR status like '%" . $searchValue . "%'OR referral_code like '%" . $searchValue . "%'OR action_at like '%" . $searchValue . "%'";

            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('user_track');
        } else {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('user_track');
        }

        return $query;
    }

}

?>