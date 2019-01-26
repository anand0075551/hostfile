<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {
	
	
	public function add_role(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		//check unique $account_no
       
		

        //set all data for inserting into database
        $data = [
            'rolename'        	 		=> $this->input->post('rolename'),
			'role_groups'        	 	=> $this->input->post('role_groups'),
			'fees'        	     		=> $this->input->post('fees'),
			'dedfees_payspec'        	=> $this->input->post('dedfees_payspec'),
			'comfees_payspec'        	=> $this->input->post('comfees_payspec'),
			'com_per'        	        => $this->input->post('com_per'),
		//	'parent'        	        => $this->input->post('parent'),
			'active'        	        => $this->input->post('active'),
			'permission_id'        	    => $this->input->post('permission_id'),
			'type'        	            => $this->input->post('type'),
			'created_by'    	        => $user_id,	
			'created_at'    	        => time(),	
			
        ];		
       $query = $this->db->insert('role', $data);

        if($query)
        {
            create_activity('Added '.$data['rolename'].'role'); //create an activity
            return true;
        }
        return false;

    }
	
	public function roleListCount(){
        $query = $this->db->count_all_results('role');
        return $query;
    }

    public function roleList($limit = 0, $start = 0){
        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('role');
        return $query;
    }
	
	public function edit_role($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        //set all data for inserting into database
        $data = [
			'rolename'        	 		=> $this->input->post('rolename'),
		//	'roleid'        	 		=> $this->input->post('roleid'),
			'fees'        	     		=> $this->input->post('fees'),
			'dedfees_payspec'        	=> $this->input->post('dedfees_payspec'),
			'comfees_payspec'        	=> $this->input->post('comfees_payspec'),
			'com_per'        	        => $this->input->post('com_per'),
		//	'parent'        	        => $this->input->post('parent'),
			'active'        	        => $this->input->post('active'),
			'permission_id'        	    => $this->input->post('permission_id'),
			//'type'        	            => $this->input->post('type'),
			'edit'                      => $user_id,
            'modified_at'               => time()
		
        ];

        $query = $this->db->where('id', $id)->update('role', $data);

        if($query)
        {
            create_activity('Updated '.$data['rolename'].' role'); //create an activity
            return true;
        }
        return false;

    }
	
	

}
?>