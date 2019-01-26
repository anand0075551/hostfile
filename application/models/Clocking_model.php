<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clocking_model extends CI_Model {

	
	public function accept_clocking($currentRolename, $user_id)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		

		$data = [
		'accepted'                   => '1',
		'ip'                         => $_SERVER['REMOTE_ADDR'],
		'role_name'                  => $currentRolename,
		'role_id'                    => $user_id,	
		'created_at'                 => time(),
		'created_by'                 => $user_id
		];


		$query = $this->db->insert('clocking_user', $data);
		
		if($query){
		return true;
		}

		}
			
			
			public function clock_in($currentRolename, $user_id)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$data1 = [
		
		
		'status'                     => '1',	
		'clock_in'                   => time(),		
		'ip'                         => $_SERVER['REMOTE_ADDR'],

		'modified_at'                => time(),
		'modified_by'                => $user_id
		];
		$data2 = [
		'ip'                         => $_SERVER['REMOTE_ADDR'],
		'role_name'                  => $currentRolename,
		'role_id'                    => $user_id,
		'status'                     => '1',	
		'clock_in'                   => time(),	
		'created_at'                 => time(),
		'created_by'                 => $user_id
		];

		$query1 = $this->db->where('role_id', $user_id)->update('clocking_user', $data1);
		$query2 = $this->db->insert('clocking_track', $data2);
		
		if($query1 && $query2){
		return true;
		}

		}
			
			
			
	public function clock_out($currentRolename, $user_id)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$data1 = [
		
		'ip'                         => $_SERVER['REMOTE_ADDR'],		
		'status'                    => '0',	
		'clock_out'                   => time(),		

		'modified_at'                => time(),
		'modified_by'                => $user_id
		];
		$data2 = [
		'ip'                         => $_SERVER['REMOTE_ADDR'],
		'role_name'                  => $currentRolename,
		'role_id'                    => $user_id,
		'status'                    => '0',	
		'clock_out'                   => time(),	
		'modified_at'                => time(),
		'modified_by'                => $user_id
		];

		$query1 = $this->db->where('role_id', $user_id)->update('clocking_user', $data1);
		$query2 = $this->db->where('role_id', $user_id)->update('clocking_track', $data2);
	
		
		if($query1 && $query2){
		return true;
		}

		}		
	
	
	
	
			public function clocking_ListCount(){

				$user_info = $this->session->userdata('logged_user');
				$user_id = $user_info['user_id'];
				$currentUser = singleDbTableRow($user_id)->role;
				$rolename = singleDbTableRow($user_id)->rolename;
				$email = singleDbTableRow($user_id)->email;
				if ($rolename == '11') {
					$query = $this->db->count_all_results('clocking_track');
					} else {
						$query = $this->db->where('role_id', $user_id)->count_all_results('clocking_track');
					}
						return $query;
			}


			// $query = $this->db->count_all_results('courier');
			// return $query;

			public function clocking_List($limit = 0, $start = 0){
				$user_info = $this->session->userdata('logged_user');
				$user_id = $user_info['user_id'];
				$currentUser = singleDbTableRow($user_id)->role;
				$rolename = singleDbTableRow($user_id)->rolename;
				$email = singleDbTableRow($user_id)->email;
				if ($rolename == '11') {
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('clocking_track');
				} else {
						$query = $this->db->order_by('id', 'desc')->where('role_id', $user_id)->limit($limit, $start)->get('clocking_track');
				}
				return $query;
			}

	
	    public function roleListCount() {
        $query = $this->db->count_all_results('clocking_role');
        return $query;
    }

    public function roleList($limit = 0, $start = 0) {
        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('clocking_role');
        return $query;
    }
	
	    public function deleteAjax() {
        $id = $this->input->post('id');

        //get deleted user info
        $userInfo = singleDbTableRow($id, 'clocking_role');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} Role");
        //Now delete permanently
        $this->db->where('id', $id)->delete('rolename');
        return true;
    }
	
	
	
		public function assign_clocking_to_role(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
			'rolename'        	 	=> $this->input->post('role_id'),
			'status'        	 	=> '1',
			'created_by'    	     => $user_id,	
			'created_at'    	     => time()
        ];

       $query = $this->db->insert('clocking_role', $data);

        if($query)
        {
            create_activity('Added '.$data['created_by'].'clocking_role'); //create an activity
            return true;
        }
        return false;

    }

}
