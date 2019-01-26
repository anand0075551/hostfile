<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitors_model extends CI_Model 
	{

    /**
     * @return bool
     */

		
			
	public function Visitors()
	{		
			
			//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			$data = [
           
			'name'     => $this->input->post('name'),
			'lname'     => $this->input->post('lname'),
			'email'   => $this->input->post('email'),
			'phone'   	=> $this->input->post('phone'),
			
			'message'     => $this->input->post('message'),
			'template_name'   => $this->input->post('template_name'),
			
           
			
			//'created_by'    	    => $user_id,*/
			'modified_by'			=> $user_id,
			'created_at'    	    => time(),
			'modified_at'			=> time()
			
			];
				
		$query = $this->db->insert('website_visitors', $data);

        if($query)
        {
            create_activity('Added '.$data['name'].'Visitors'); //create an activity
            return true;
        }
        return false;
	}
	
       //transport module view
	
   public function VisitorsListCount()
   {
		
			$query = $this->db->count_all_results('website_visitors');
			return $query; 
		
    }	
	
	public function VisitorsList($limit = 10, $start = 0) 
	{
           
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
				if ($currentUser == 'admin')
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('website_visitors');
					return $query;
				}
				else
				{  
					$table_name = 'website_visitors';
				//	$where_array = array('created_by' => $user_id);
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
					return $query;
				}

	}
	
	
	public function edit_Visitors($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 
          $data = [
           
			'name' 		    	=> $this->input->post('name'),
            'lname' 		        => $this->input->post('lname'),
			'email' 	            => $this->input->post('email'),
			'phone' 		    	=> $this->input->post('phone'),
            'message' 		        => $this->input->post('message'),
			//'template_name' 	            => $this->input->post(' template_name'),
			
		
            'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query = $this->db->where('id', $id)->update('website_visitors', $data);

        if ($query) {
            create_activity('Updated ' . $data['name'] . 'Visitors'); //create an activity
            return true;
        }
        return false;
    }

		/*************************Visitors Report***************************/
	
	public function search_visitors_listCount($template_name, $sf_time, $st_time)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		
		if($template_name !='')
		{
			if($condition != ""){
				$condition.=" AND template_name = '".$template_name."'";
			}
			else{
				$condition.="template_name = '".$template_name."'";
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
			$query = $this->db->where($where_array)->count_all_results('website_visitors');
			}
		
			else
			{
			$query = $this->db->count_all_results('website_visitors');
			}
		}
		
		else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array."AND created_by = '".$user_id."'";
                $query = $this->db->where($where_array)->count_all_results('website_visitors');
            }else
            {
            $where = array('created_by' => $user_id);
            $query = $this->db->where($where)->count_all_results('website_visitors');
        }
        } 
		
        return $query;
		
    }

	
	public function search_visitors_list($limit=10, $start=0,$template_name,$sf_time, $st_time){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		
		
		if($template_name !='')
		{
			if($condition != ""){
				$condition.=" AND template_name = '".$template_name."'";
			}
			else{
				$condition.="template_name = '".$template_name."'";
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
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('website_visitors');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('website_visitors');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('website_visitors');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('website_visitors');
        }
        } 
        return $query;
	}
		
	
	
	
	}//last brace required
	
	
	