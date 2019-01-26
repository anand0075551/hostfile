<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax_slab_model extends CI_Model 
	{

    /**
     * @return bool
     */

		
			
	public function Tax_slab()
	{		
			
			//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			$data = [
           
			'tax_id'     => $this->input->post('tax_id'),
			'business'     => $this->input->post('business'),
			'tax_name'     => $this->input->post('tax_name'),
			'value'     => $this->input->post('value'),
			'start_date'     => $this->input->post('sart_date'),
			'end_date'     => $this->input->post('end_date'),
			
			
           
			
			'created_by'    	    => $user_id,
			//'modified_by'			=> $user_id,
			'created_at'    	    => time()
			//'modified_at'			=> time()
			//'root_id'               => $getreferral
			];
				
		$query = $this->db->insert('tax_slabs', $data);

        if($query)
        {
            create_activity('Added '.$data['created_by'].'Tax_slab'); //create an activity
            return true;
        }
        return false;
	}
	
       //tax module view
	
   public function tax_slabListCount()
   {
		
			$query = $this->db->count_all_results('tax_slabs');
			return $query; 
		
    }	
	
	public function tax_slabList($limit = 10, $start = 0) 
	{
           
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
				if ($currentUser == 'admin')
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('tax_slabs');
					return $query;
				}
				else
				{  
					$table_name = 'tax_slabs';
					$where_array = array('created_by' => $user_id);
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
					return $query;
				}

	}

	
	
	public function edit_tax_slab($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 
          $data = [
           
			'tax_id' 		    	=> $this->input->post('tax_id'),
			'business' 		    	=> $this->input->post('business'),
            'tax_name' 		    	=> $this->input->post('tax_name'),
			'value' 		    	=> $this->input->post('value'),
			'start_date' 		    	=> $this->input->post('sart_date'),
			'end_date' 		    	=> $this->input->post('end_date'),
			
			'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query = $this->db->where('id', $id)->update('tax_slabs', $data);

        if ($query) {
            create_activity('Updated ' . $data['tax_name'] . 'Tax_slab'); //create an activity
            return true;
        }
        return false;
    }
	
	
/*========================================Tax_idname_models===============================------------------ */	
	public function Tax_idname()
	{		
			
			//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			$data = [
           
			'tax_idname'     => $this->input->post('tax_idname'),
			
			
           
			
			'created_by'    	    => $user_id,
			//'modified_by'			=> $user_id,
			'created_at'    	    => time()
			//'modified_at'			=> time()
			//'root_id'               => $getreferral
			];
				
		$query = $this->db->insert('tax_id', $data);

        if($query)
        {
            create_activity('Added '.$data['created_by'].'Tax_idname'); //create an activity
            return true;
        }
        return false;
	}
	
       //transport module view
	
   public function tax_idnameListCount()
   {
		
			$query = $this->db->count_all_results('tax_id');
			return $query; 
		
    }	
	
	public function tax_idnameList($limit = 10, $start = 0) 
	{
           
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
				if ($currentUser == 'admin')
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('tax_id');
					return $query;
				}
				else
				{  
					$table_name = 'tax_id';
					$where_array = array('created_by' => $user_id);
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
					return $query;
				}

	}

	
	
	public function edit_tax_idname($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 
          $data = [
           
			'tax_idname' 		    	=> $this->input->post('tax_idname'),
          
			
			'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query = $this->db->where('id', $id)->update('tax_id', $data);

        if ($query) {
            create_activity('Updated ' . $data['tax_idname'] . 'Dashbord_alert'); //create an activity
            return true;
        }
        return false;
    }
	
	
	
	}//last brace required
	