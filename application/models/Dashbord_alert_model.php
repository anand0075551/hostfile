<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashbord_alert_model extends CI_Model 
	{

    /**
     * @return bool
     */

		
			
	public function Dashbord_alert()
	{		
			
			//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			$data = [
           
			'color'     => $this->input->post('color'),
			'templet_name'     => $this->input->post('templet_name'),
			'title'     		=> $this->input->post('title'),
			'content'   		=> $this->input->post('content'),
			'status'   			=> $this->input->post('status'),
           
			
			'created_by'    	    => $user_id,
			//'modified_by'			=> $user_id,
			'created_at'    	    => time()
			//'modified_at'			=> time()
			//'root_id'               => $getreferral
			];
				
		$query = $this->db->insert('dashbord', $data);

        if($query)
        {
            create_activity('Added '.$data['name'].'Dashbord_alert'); //create an activity
            return true;
        }
        return false;
	}
	
       //transport module view
	
   public function dashbord_alertListCount()
   {
		
			$query = $this->db->count_all_results('dashbord');
			return $query; 
		
    }	
	
	public function dashbord_alertList($limit = 10, $start = 0) 
	{
           
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
				if ($currentUser == 'admin')
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('dashbord');
					return $query;
				}
				else
				{  
					$table_name = 'dashbord';
					$where_array = array('created_by' => $user_id);
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
					return $query;
				}

	}

	
	
	public function edit_dashbord_alert($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 
          $data = [
		  'color'     => $this->input->post('color'),
           'templet_name'     => $this->input->post('templet_name'),
			'title' 		    	=> $this->input->post('title'),
            'content' 		        => $this->input->post('content'),
			'status' 	            => $this->input->post('status'),
			
		
            'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query = $this->db->where('id', $id)->update('dashbord', $data);

        if ($query) {
            create_activity('Updated ' . $data['name'] . 'Dashbord_alert'); //create an activity
            return true;
        }
        return false;
    }
	
	
	
	
	
	}//last brace required
	