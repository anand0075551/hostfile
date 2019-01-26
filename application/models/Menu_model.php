<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	
	public function add_left_menu(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
		
		
			'business_name'        	 => $this->input->post('left_menu_name'),
			'created_by'    	     => $user_id,	
			'created_at'    	     => time(),	
            
			
        ];

       $query = $this->db->insert('menu_business_groups', $data);

        if($query)
        {
            create_activity('Added '.$data['business_name'].'business_name'); //create an activity
            return true;
        }
        return false;

    }

	public function allLeftMenu_ListCount(){
            $query = $this->db->count_all_results('menu_business_groups');

        return $query;
    }
	
		

    

    public function allLeftMenu_List($limit = 0, $start = 0){

		$search = $this->input->get('search');	
		$searchValue = $search['value'];

		$searchByID = '';				
		
		if($searchValue != '')																							
			{																												
				$table_name = "menu_business_groups";	
				$where_array = array('business_name' => $searchValue );					
				  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
			}											
			else{										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('menu_business_groups');
			}
		
        return $query;
    }
	
	
	
		public function edit_left_menu($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
		
			'business_name'        	 	=> $this->input->post('left_menu_name'),	
			'modified_by'    	     => $user_id,	
			'modified_at'    	     => time(),	
            
			
        ];

        $query = $this->db->where('id', $id)->update('menu_business_groups', $data);

        if($query)
        {
            create_activity('Updated '.$data['business_name'].' menu_business_groups'); //create an activity
            return true;
        }
        return false;

    }
	
	
	
	
	
	
	public function add_business_form(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
		
		//	'menu'        	 	=> 'menu',
		//	'menu_controller'        	 	=> 'dashboard',
			'bg_id'        	 	=> $this->input->post('bg_id'),
			'category_name'        	 	=> $this->input->post('category_name'),
	//		'sub_category'        	 	=> $this->input->post('sub_category'),
			'displayform_name'        	 	=> $this->input->post('displayform_name'),
			'font'        	 			=> $this->input->post('font'),
			'controller'        	 	=> $this->input->post('controller'),
			'phpfile_name'        	 	=> $this->input->post('phpfile_name'),
			
			'created_by'    	     => $user_id,	
			'created_at'    	     => time(),	
            
			
        ];

       $query = $this->db->insert('menu_bg_forms', $data);

        if($query)
        {
           
            return true;
        }
        return false;

    }
		public function allLeftForms_ListCount(){
            $query = $this->db->count_all_results('menu_bg_forms');

        return $query;
    }
	
		

    

    public function allLeftForms_List($limit = 0, $start = 0){

		$search = $this->input->get('search');	
		$searchValue = $search['value'];

		$searchByID = '';				
		
		if($searchValue != '')																							
			{																												
				$table_name = "menu_bg_forms";	
				$where_array = array('bg_id' => $searchValue );					
				  $query = $this->db->order_by('bgform_id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
			}											
			else{										
				$query = $this->db->order_by('bgform_id', 'desc')->limit($limit, $start)->get('menu_bg_forms');
			}
		
        return $query;
    }
			public function edit_business_form($bgform_id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
		
		//	'menu'        	 	=> 'menu',
		//	'menu_controller'        	 	=> 'dashboard',
			'bg_id'        	 	=> $this->input->post('bg_id'),
			'category_name'        	 	=> $this->input->post('category_name'),
		//	'sub_category'        	 	=> $this->input->post('sub_category'),
			'font'        	 			=> $this->input->post('font'),
			'displayform_name'        	 	=> $this->input->post('displayform_name'),
			'controller'        	 	=> $this->input->post('controller'),
			'phpfile_name'        	 	=> $this->input->post('phpfile_name'),	
			'modified_by'    	     => $user_id,	
			'modified_at'    	     => time(),	
            
			
        ];

        $query = $this->db->where('bgform_id', $bgform_id)->update('menu_bg_forms', $data);

        if($query)
        {
           
            return true;
        }
        return false;

    }
	
	
	
	public function assign_menu(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
			'role_id'        	 	=> $this->input->post('role_id'),
			'bg_id'        	 	    => $this->input->post('bg_id'),
			'active_status'        	=> 1,
			
			'created_by'    	     => $user_id,	
			'created_at'    	     => time(),	
            
			
        ];

       $query = $this->db->insert('menu_bg_assignment', $data);

        if($query)
        {
         
            return true;
        }
        return false;

    }

public function allAssigneMenus_ListCount(){
            $query = $this->db->count_all_results('menu_bg_assignment');

        return $query;
    }
	
		

    

    public function allAssigneMenus_List($limit = 0, $start = 0){

		$search = $this->input->get('search');	
		$searchValue = $search['value'];

		$searchByID = '';				
		
		if($searchValue != '')																							
			{																												
				$table_name = "menu_bg_assignment";	
				$where_array = array('role_id' => $searchValue );					
				  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
			}											
			else{										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('menu_bg_assignment');
			}
		
        return $query;
    }	
	
	
	public function assign_forms(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		
		$bgform_id        	 	= implode(",", $this->input->post('bgform_id'));
		
		$test = explode(',' , $bgform_id);
        foreach($test as $test2)
        {
        //set all data for inserting into database
        $data = [
			'role_id'        	 	=> $this->input->post('role_id'),
			'bg_id'        	 		=> $this->input->post('bg_id'),
			'bgform_id'        	 	=> $test2,
			'permission'        	=> 1,
			
			'created_by'    	    => $user_id,	
			'created_at'    	    => time(),		
        ];
       
	 //  $bgform_id        	 	= $this->input->post('bgform_id');
        
       $query = $this->db->insert('menu_role_permission', $data);
} 
        if($query)
        {
          
            return true;
        }
        return false;

    }
	
public function allAssigneForms_ListCount(){
            $query = $this->db->count_all_results('menu_role_permission');

        return $query;
    }
	
		

    

    public function allAssigneForms_List($limit = 0, $start = 0){

		$search = $this->input->get('search');	
		$searchValue = $search['value'];

		$searchByID = '';				
		
		if($searchValue != '')																							
			{																												
				$table_name = "menu_role_permission";	
				$where_array = array('role_id' => $searchValue );					
				  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
			}											
			else{										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('menu_role_permission');
			}
		
        return $query;
    }	
	
	
	    function forms($forms)
    {
      $where_array = array( 'bd_id' => $forms );
      $table_name="menu_bg_forms";
       $query = $this->db->order_by('bgform_id', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 
	
		

	
		
/*************************** Menu Reporting*******************************************/

public function search_leftmenu_listCount($bg_id,$role_id)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		
		if($bg_id !='')
		{	
			
			$condition.="bg_id = ".$bg_id." ";
			
		}
		
		if($role_id!='')
		{	
			if($condition != ""){
			$condition.="AND role_id = ".$role_id." ";
			}
			else{
				$condition.="role_id = '".$role_id."'";
			}
		}
		
		if($currentUser=='admin')
		{
			if($condition !='')
			{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('menu_bg_assignment');
			}
		
			else
			{
			$query = $this->db->count_all_results('menu_bg_assignment');
			}
		}
		
		else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array."AND created_by = '".$user_id."'";
                $query = $this->db->where($where_array)->count_all_results('menu_bg_assignment');
            }else
            {
            $where = array('created_by' => $user_id);
            $query = $this->db->where($where)->count_all_results('menu_bg_assignment');
        }
        } 
		
        return $query;
		
    }

	
	public function search_leftmenu_list($limit=10, $start=0,$bg_id,$role_id){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		
		
		if($bg_id !='')
		{	
			
			$condition.="bg_id = ".$bg_id." ";
			
			
		}
		
		if($role_id!='')
		{	
			if($condition != ""){
			$condition.="AND role_id = ".$role_id." ";
			}
			else{
				$condition.="role_id = '".$role_id."'";
			}
		}
		
		
		
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('menu_bg_assignment');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('menu_bg_assignment');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('menu_bg_assignment');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('menu_bg_assignment');
        }
        } 
        return $query;
	}
	
/*****************************************forms reporting**********************************************************/

public function search_leftmenuform_listCount($bg_id,$role_id,$bgform_id)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		
		if($bg_id !='')
		{
			if($condition != ""){
				$condition.="bg_id = '".$bg_id."'";
			}
			else{
				$condition.="bg_id = '".$bg_id."'";
			}
		}
		
		
			if($bgform_id !='')
		{
			if($condition != ""){
				$condition.=" AND bgform_id = '".$bgform_id."'";
			}
			else{
				$condition.="bgform_id = '".$bgform_id."'";
			}
		}
		
		if($role_id!='')
		{	
			if($condition != ""){
			$condition.=" AND role_id = ".$role_id." ";
			}
			else{
				$condition.="role_id = '".$role_id."'";
			}
		}
		
		
		

		if($currentUser=='admin')
		{
			if($condition !='')
			{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('menu_role_permission');
			}
		
			else
			{
			$query = $this->db->count_all_results('menu_role_permission');
			}
		}
		
		else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array."AND created_by = '".$user_id."'";
                $query = $this->db->where($where_array)->count_all_results('menu_role_permission');
            }else
            {
            $where = array('created_by' => $user_id);
            $query = $this->db->where($where)->count_all_results('menu_role_permission');
        }
        } 
		
        return $query;
		
    }

	
	public function search_leftmenuform_list($limit=10, $start=0,$bg_id,$role_id,$bgform_id){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		if($bg_id !='')
		{
			if($condition != ""){
				$condition.=" bg_id = '".$bg_id."'";
			}
			else{
				$condition.="bg_id = '".$bg_id."'";
			}
		}
		
		
			if($bgform_id !='')
		{
			if($condition != ""){
				$condition.=" AND bgform_id = '".$bgform_id."'";
			}
			else{
				$condition.="bgform_id = '".$bgform_id."'";
			}
		}
		
		
		
		if($role_id!='')
		{	
			if($condition != ""){
			$condition.="AND role_id = ".$role_id." ";
			}
			else{
				$condition.="role_id = '".$role_id."'";
			}
		}
		
		
		
	
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('menu_role_permission');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('menu_role_permission');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('menu_role_permission');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('menu_role_permission');
        }
        } 
        return $query;
	}
	
	



/*****************************************all menu reporting************************************************/

public function search_allmenu_listCount($business_name)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		
		if($business_name !='')
		{	
			if($condition != ""){
			$condition.="business_name = ".$business_name." ";
			}
			else{
				$condition.="business_name = '".$business_name."'";
			}
		}
		
			
		if($currentUser=='admin')
		{
			if($condition !='')
			{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('menu_business_groups');
			}
		
			else
			{
			$query = $this->db->count_all_results('menu_business_groups');
			}
		}
		
		else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array."AND created_by = '".$user_id."'";
                $query = $this->db->where($where_array)->count_all_results('menu_business_groups');
            }else
            {
            $where = array('created_by' => $user_id);
            $query = $this->db->where($where)->count_all_results('menu_business_groups');
        }
        } 
		
        return $query;
		
    }

	
	public function search_allmenu_list($limit=10, $start=0,$business_name){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		
		
		if($business_name !='')
		{	
			if($condition != ""){
			$condition.="business_name = ".$business_name." ";
			}
			else{
				$condition.="business_name = '".$business_name."'";
			}
		}
		
		
	
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('menu_business_groups');
			}
			else
			{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('menu_business_groups');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('menu_business_groups');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('menu_business_groups');
        }
        } 
        return $query;
	}
	
		/*=====================*/
		
/*******************************all business forms reporting************************************************/

public function search_allform_listCount($bg_id)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		
		if($bg_id !='')
		{
			if($condition != ""){
				$condition.="bg_id = '".$bg_id."'";
			}
			else{
				$condition.="bg_id = '".$bg_id."'";
			}
		}
		
		
			
		if($currentUser=='admin')
		{
			if($condition !='')
			{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('menu_bg_forms');
			}
		
			else
			{
			$query = $this->db->count_all_results('menu_bg_forms');
			}
		}
		
		else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array."AND created_by = '".$user_id."'";
                $query = $this->db->where($where_array)->count_all_results('menu_bg_forms');
            }else
            {
            $where = array('created_by' => $user_id);
            $query = $this->db->where($where)->count_all_results('menu_bg_forms');
        }
        } 
		
        return $query;
		
    }

	
	public function search_allform_list($limit=10, $start=0,$bg_id){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		$search = $this->input->get('search');
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
		$condition="";
		if($bg_id !='')
		{
			if($condition != ""){
				$condition.="bg_id = '".$bg_id."'";
			}
			else{
				$condition.="bg_id = '".$bg_id."'";
			}
		}
		
		
	
		if($currentUser =='admin')
		{
			if($condition !='')
			{
			$where_array = $condition;
			$query = $this->db->order_by('bgform_id', 'desc')->limit($limit, $start)->where($where_array )->get('menu_bg_forms');
			}
			else
			{
			$query = $this->db->order_by('bgform_id', 'desc')->limit($limit, $start)->get('menu_bg_forms');
			}
		}
		
		 else
        {
            if($condition !='')
            {
                $where_array= $condition;
                $where_array= $where_array." AND created_by = ".$user_id." ";
				$query = $this->db->order_by('bgform_id', 'desc')->limit($limit, $start)->where($where_array )->get('menu_bg_forms');
            }else
            {
            $where_array = array('created_by' => $user_id);
			$query = $this->db->order_by('bgform_id', 'desc')->limit($limit, $start)->where($where_array )->get('menu_bg_forms');
        }
        } 
        return $query;
	}
	

}
	



