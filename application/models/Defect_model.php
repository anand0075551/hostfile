<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Defect_model extends CI_Model {

    /**
     * @return bool
     */

    public function add_defect(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'invoice_id'                => $this->input->post('invoice_id'),
            'invoice_value'                => $this->input->post('invoice_value'),
            'category'                  => $this->input->post('category'),
            'sub_category'        		=> $this->input->post('subcategory'),
            'return_product_value'       => $this->input->post('return_product_value'),
			'defect_reason'     	     => $this->input->post('defect_reason'),
			'vendor_id'    	    		 => $this->input->post('vendor_id'),
			'comments'        			 => $this->input->post('comments'),
			'created_at'	=> time(),
            'created_by'	=> $user_id
        ];

       $query = $this->db->insert('smb_product_defects', $data);

        if($query)
        {
            create_activity('Added '.$data['name'].' Role'); //create an activity
            return true;
        }
        return false;

    }
	
	
	/**
     * @return Agent List
     * Agent List Query
     */

    public function defectListJson(){
		
		$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;
		
		 if ($currentUser == 'admin')
		{
			$query = $this->db->count_all_results('smb_product_defects');
		}else{
			$query = $this->db->where( 'created_by ' , $user_id  )->count_all_results('smb_product_defects');	
		}
			return $query; 
		
		//$query = $this->db->count_all_results('smb_product_defects');
        //return $query;
    }

    public function defectlist($limit = 0, $start = 0){
        
		$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;
		
		
		 if ($currentUser == 'admin')
		{		
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_product_defects');
		}else{
			//$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_product_defects');
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('smb_product_defects', ['created_by' =>$user_id]); 
		}
        return $query; 
		
		
		
		
		//$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_product_defects');
        //return $query;
    }
	
	
	
  
   /**
     * @param $id
     * @return bool
     * Update Category
     */


    public function edit_role($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'rolename'        	 => $this->input->post('role_name'),
            'roleid'        	 => $this->input->post('role_id'),
			'fees'        		 => $this->input->post('fee'),
			'dedfees_payspec'    => $this->input->post('DedFees'),
			'comfees_payspec'    => $this->input->post('comfees'),
			'com_per'         	 => $this->input->post('comper'),
			'parent'        	 => $this->input->post('Parent'),
			'active'       	 	 => $this->input->post('Active'),
			'permission_id'      => $this->input->post('permissionid'),
			'type'         		 => $this->input->post('Type'),
			'edit'         		 => $this->input->post('Edit'),
            'created_at'         => time(),
            'modified_at'        => time()
               ];

        $query = $this->db->where('id', $id)->update('role', $data);

        if($query)
        {
            create_activity('Updated '.$data['name'].' role'); //create an activity
            return true;
        }
        return false;

    }





  
	
  /**
     * @return menu List
     * role menu List Query
     */

    public function addusersmenuListCount(){
        $query = $this->db->count_all_results('role');
        return $query;
    }



}