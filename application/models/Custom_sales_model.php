<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_sales_model extends CI_Model {

    /**
     * @return bool
     */
	
	 


    public function add_custom(){

		$ecom_db = $this->load->database('ecom', TRUE);
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'sale_code'                => $this->input->post('invoice_id'),
            'product'                => $this->input->post('product'),
            'custom_1'       => $this->input->post('custom_one'),
			'custom_2'     	     => $this->input->post('custom_two'),
			'custom_3'    	    		 => $this->input->post('custom_three'),
			'comments'    	    => $this->input->post('comments'),
			'created_at'	=> time(),
            'created_by'	=> $user_id
        ];

       $query = $this->db->insert('custom_sales', $data);

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

    public function customListJson(){
		
	//	$ecom_db = $this->load->database('ecom', TRUE);
		
		$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;
		
		 if ($currentUser == 'admin')
		{
			$query = $this->db->count_all_results('custom_sales');
		}else{
			$query = $this->db->where( 'created_by ' , $user_id  )->count_all_results('custom_sales');	
		}
			return $query; 
		
		//$query = $this->db->count_all_results('smb_product_defects');
        //return $query;
    }

    public function customlist($limit = 0, $start = 0){
        
	//	$ecom_db = $this->load->database('ecom', TRUE);
		
		$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;
		
		
		 if ($currentUser == 'admin')
		{		
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('custom_sales');
		}else{
			//$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_product_defects');
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('custom_sales', ['created_by' =>$user_id]); 
		}
        return $query; 
		
		
		
		
		//$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_product_defects');
        //return $query;
    }
	
	
	public function edit_custom($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        //set all data for inserting into database
        $data = [
			'custom_1'       	=> $this->input->post('custom_one'),
			'custom_2'     	    => $this->input->post('custom_two'),
			'custom_3'    	    => $this->input->post('custom_three'),
			'comments'    	    => $this->input->post('comments'),
			'modified_by'       => $user_id,
            'modified_at'       => time()
		
        ];

        $query = $this->db->where('id', $id)->update('custom_sales', $data);

        if($query)
        {
            create_activity('Updated '.$data['name'].' role'); //create an activity
            return true;
        }
        return false;

    }
	
	



}