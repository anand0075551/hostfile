<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Role_report_model extends CI_Model 
	{

    /**
     * @return bool
     */
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
	 
	 // Edit role
	 
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
	 
	 //
// Role function 

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
	
	public function search_role_ListCount($assigned_role,$to_user1,$sf_time,$st_time)
	{
		
		$user_info = $this->session->userdata('logged_user');
		
		$condition="";
		if($to_user1 !='')
		{
			$condition.="role_groups = ".$to_user1." ";
		}
		
		if($assigned_role !='')
		{
			if($condition != ""){
				$condition.=" AND id = '".$assigned_role."'";
			}
			else{
				$condition.="id = '".$assigned_role."'";
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
					
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array )->count_all_results('role'); 
		}
		else
		{
			$query = $this->db->count_all_results('role'); 
		}
        return $query;
	
	}
	
	public function search_role_List($limit=10, $start=0,$assigned_role,$to_user1,$sf_time,$st_time){
		
		$user_info = $this->session->userdata('logged_user');
		
		$condition="";
		if($to_user1 !='')
		{
			$condition.="role_groups = ".$to_user1." ";
		}
		
		if($assigned_role !='')
		{
			if($condition != ""){
				$condition.=" AND id = '".$assigned_role."'";
			}
			else{
				$condition.="id = '".$assigned_role."'";
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
					
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->limit($limit, $start)->where($where_array )->get('role'); 
		}
		else
		{
		$query = $this->db->limit($limit, $start)->get('role');	
		}
        return $query;
	
	}
	
	
}//last brace required