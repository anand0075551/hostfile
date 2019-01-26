<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal_info_model extends CI_Model 
	{


//---------person details	
		public function personal_details()
	{		
			
			//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName1 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
			 
			$data = [
           
			'type'     			    => $this->input->post('type1'),
			'first_name'     	    => $this->input->post('first_name'),
			'mid_name'     			=> $this->input->post('mid_name'),
			'last_name'     		=> $this->input->post('last_name'),
			'id_proof'     			=> $this->input->post('id_proof'),
			'aadhar_id'     		=> $this->input->post('aadhar_id'),
			'pan_id'     			=> $this->input->post('pan_id'),
			'voter_id'     			=> $this->input->post('voter_id'),
			'drv_lnc_id'     		=> $this->input->post('drv_lnc_id'),
			'passport_no'     		=> $this->input->post('passport_no'),
			'dob'     		      	=> $this->input->post('dob'),
			'dob_proof'     		=> $this->input->post('dob_proof'),
			'age'     			    => $this->input->post('age'),
			'email'     			=> $this->input->post('email'),
			'sec_email'     		=> $this->input->post('sec_email'),
			'permanent_cntno'     	=> $this->input->post('permanent_cntno'),
			'mob_no1'     			=> $this->input->post('mob_no1'),
			'mob_no2'     			=> $this->input->post('mob_no2'),
			'alt_cnt_no'     		=> $this->input->post('alt_cnt_no'),
			'native_place'     		=> $this->input->post('native_place'),
			'resi_address'     		=> $this->input->post('resi_address'),
			'pincode'     		    => $this->input->post('pincode1'),
			'permanent_address'     => $this->input->post('permanent_address'),
			'permanent_address_proof' => $this->input->post('permanent_address_proof'),
			
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName1,
			
			'created_by'    	    => $user_id,
			'modified_by'			=> $user_id,
			'created_at'    	    => time(),
			'modified_at'			=> time()
			
			];
				
		$query = $this->db->insert('per_details', $data);

        if($query)
        {
           // create_activity('Added '.$data['name'].'Transport'); //create an activity
            return true;
        }
        return false;
	}
		
		
		
		
	
//*********************************** Personal Info Listing***************************************/
	
		//Listing Personal Info
	
		  public function personal_info_ListCount() {
        $query = $this->db->count_all_results('per_details');
        return $query;
    }

    public function personal_info_List($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_details');
            return $query;
        } else {
            $table_name = 'per_details';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
 
 
//Edit Personal Info
  
  public function edit_personal_info($id){ 

    
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			 
		
			 
			$data = [
           
			'type'                    => $this->input->post('type1'),
			'first_name'          	 => $this->input->post('first_name'),
			'mid_name'         		 => $this->input->post('mid_name'),
			'last_name'              => $this->input->post('last_name'),
			'id_proof'            	=> $this->input->post('id_proof'),
			'aadhar_id'             => $this->input->post('aadhar_id'),
			'pan_id'          		 => $this->input->post('pan_id'),
			'voter_id'          	=> $this->input->post('voter_id'),
			'drv_lnc_id'             => $this->input->post('occupation'),
			'passport_no'            => $this->input->post('passport_no'),
			'dob'                    => $this->input->post('dob'),
			'dob_proof'          	 => $this->input->post('dob_proof'),
			'age'          			=> $this->input->post('age'),
			'email'              	=> $this->input->post('email'),
			'sec_email'            	=> $this->input->post('sec_email'),
			'permanent_cntno'       => $this->input->post('permanent_cntno'),
			'mob_no1'           	=> $this->input->post('mob_no1'),
			'mob_no2'          		=> $this->input->post('mob_no2'),
			'alt_cnt_no'            => $this->input->post('alt_cnt_no'),
			'native_place'          => $this->input->post('native_place'),
			'resi_address'          => $this->input->post('resi_address'),
			'pincode'          		=> $this->input->post('pincode'),
			'permanent_address'     => $this->input->post('permanent_address'),
			'permanent_address_proof' => $this->input->post('permanent_address_proof'),
			
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			
		
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_details', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_details'); //create an activity
            return true;
        }
        return false;

    }
	
	
	
//copy Personal Info
  
     public function copy_personal_info($id){ 

     
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 	 	 	//---uplod photo
						
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			 
			 
		
			 
			$data = [
           
			'type'                    => $this->input->post('type1'),
			'first_name'          	 => $this->input->post('first_name'),
			'mid_name'         		 => $this->input->post('mid_name'),
			'last_name'              => $this->input->post('last_name'),
			'id_proof'            	=> $this->input->post('id_proof'),
			'aadhar_id'             => $this->input->post('aadhar_id'),
			'pan_id'          		 => $this->input->post('pan_id'),
			'voter_id'          	=> $this->input->post('voter_id'),
			'drv_lnc_id'             => $this->input->post('drv_lnc_id'),
			'passport_no'            => $this->input->post('passport_no'),
			'dob'                    => $this->input->post('dob'),
			'dob_proof'          	 => $this->input->post('dob_proof'),
			'age'          			=> $this->input->post('age'),
			'email'              	=> $this->input->post('email'),
			'sec_email'            	=> $this->input->post('sec_email'),
			'permanent_cntno'       => $this->input->post('permanent_cntno'),
			'mob_no1'           	=> $this->input->post('mob_no1'),
			'mob_no2'          		=> $this->input->post('mob_no2'),
			'alt_cnt_no'            => $this->input->post('alt_cnt_no'),
			'native_place'          => $this->input->post('native_place'),
			'resi_address'          => $this->input->post('resi_address'),
			'pincode'          		=> $this->input->post('pincode'),
			'permanent_address'     => $this->input->post('permanent_address'),
			'permanent_address_proof' => $this->input->post('permanent_address_proof'),
			
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			
		
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->insert('per_details', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_details'); //create an activity
            return true;
        }
        return false;

    }

//------------------unable disable drop dwn optn for add info------------------------//			 
	
	function per_type($type) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        $where_array = array('created_by' => $user_id, 'type' => $type);
        $table_name = "per_details";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return true;
        } else {
            return false;
        }
    }
	

//*********************************business***************************
		
		 public function business_details()
	{		
			
			//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName2 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
			
					
					
		
			
			$data = [
           
			'type'     			            => $this->input->post('type2'),
			'business_email'     			=> $this->input->post('business_email'),
			'business_cntno'     			=> $this->input->post('business_cntno'),
			'bank_details'     			    => $this->input->post('bank_details'),
			'shelter_details'     			=> $this->input->post('shelter_details'),
			'renting_assets'     			=> $this->input->post('renting_assets'),
			'own_use_assets'     			=> $this->input->post('own_use_assets'),
			
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName2,
					
			'created_by'    	            => $user_id,
			'modified_by'    	            => $user_id,
			'created_at'    	            => time(),
			'modified_at'    	            => time()
			];
				
		$query = $this->db->insert('per_business', $data);

        if($query)
        {
          
            return true;
        }
        return false;
	}
	
		
	/***********************************Business Info Listing***************************************/
	
		//Listing Business Info
	
		  public function business_info_ListCount() {
        $query = $this->db->count_all_results('per_business');
        return $query;
    }

    public function business_info_List($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_business');
            return $query;
        } else {
            $table_name = 'per_business';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
 
 
  //Edit business Info
  
     public function edit_business_info($id){ 

    
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
		
			$data = [
           
			'type'                    => $this->input->post('type2'),
			'business_email'          => $this->input->post('business_email'),
			'business_cntno'          => $this->input->post('business_cntno'),
			'bank_details'            => $this->input->post('bank_details'),
			'shelter_details'         => $this->input->post('shelter_details'),
			'renting_assets'          => $this->input->post('renting_assets'),
			'own_use_assets'          => $this->input->post('own_use_assets'),
			
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_business', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_business'); //create an activity
            return true;
        }
        return false;

    }
	
	
	
	
  //Copy business Info
  
     public function copy_business_info($id){ 

    
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			 	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			 
		
			$data = [
           
			'type'                    => $this->input->post('type2'),
			'business_email'          => $this->input->post('business_email'),
			'business_cntno'          => $this->input->post('business_cntno'),
			'bank_details'            => $this->input->post('bank_details'),
			'shelter_details'         => $this->input->post('shelter_details'),
			'renting_assets'          => $this->input->post('renting_assets'),
			'own_use_assets'          => $this->input->post('own_use_assets'),
			
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->insert('per_business', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_business'); //create an activity
            return true;
        }
        return false;

    }
	
	//------------------unable disable drop ------------------------//			 
	
	function business_on_type($type) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        $where_array = array('created_by' => $user_id, 'type' => $type);
        $table_name = "per_business";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return true;
        } else {
            return false;
        }
    }

//=========================================utility================================================================

public function utility1()
	{		
			
			//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName3 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
			 
			 
			$data = [
           
			'type'                   => $this->input->post('type3'),
			'rr_no'                  => $this->input->post('rr_no'),
			'account_number'         => $this->input->post('account_number'),
			'address_details'        => $this->input->post('address_details'),
			'address'                => $this->input->post('address'),
			'pincode'                => $this->input->post('pincode'),
			
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName3,
			
			'created_by'    	     => $user_id,
			'modified_by'			 => $user_id,
			'created_at'    	     => time(),
			'modified_at'			 => time()
			
			];
				
		$query = $this->db->insert('per_utl1', $data);

        if($query)
        {
          
            return true;
        }
        return false;
	}
		
		
		
/***********************************Utilities 1 Listing***************************************/
	
		//Listing Utilities 1
		
		  public function utilities1_ListCount() {
        $query = $this->db->count_all_results('per_utl1');
        return $query;
    }

    public function utilities1_List($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_utl1');
            return $query;
        } else {
            $table_name = 'per_utl1';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
 
 
  //Edit Personal Info
  
     public function edit_utilities1($id){ 

    
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
			 
			 
			 
		
			$data = [
           
			'type'                    => $this->input->post('type3'),
			'rr_no'          			=> $this->input->post('rr_no'),
			'account_number'          => $this->input->post('account_number'),
			'address_details'            => $this->input->post('address_details'),
			'address'         			=> $this->input->post('address'),
			'pincode'          		=> $this->input->post('pincode'),
			
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_utl1', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_utl1'); //create an activity
            return true;
        }
        return false;

    }
	
	
	public function copy_utilities($id){ 

     
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
			
			 
			 
			
			
			$data = [
           
			'type'                    => $this->input->post('type3'),
			'rr_no'          			=> $this->input->post('rr_no'),
			'account_number'          => $this->input->post('account_number'),
			'address_details'            => $this->input->post('address_details'),
			'address'         			=> $this->input->post('address'),
			'pincode'          		=> $this->input->post('pincode'),
			
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->insert('per_utl1', $data);

        if($query)
        {
            create_activity('Inserted '.$data['modified_by'].' per_utl1'); //create an activity
            return true;
        }
        return false;

    }
//------------------unable disable drop ------------------------//			 
	
	function water_on_type($type) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        $where_array = array('created_by' => $user_id, 'type' => $type);
        $table_name = "per_utl1";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return true;
        } else {
            return false;
        }
    }

	
///*****************utility 2  add***********************************/
		
		public function utility2()
	{		
			
			//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName4 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
			
			 
			 
		
		
			$data = [
           
			'type'                   => $this->input->post('type4'),
			'servive_orerator'       => $this->input->post('servive_orerator'),
			'account_number'         => $this->input->post('account_number'),
			'address_details'        => $this->input->post('address_details'),
			'address'                => $this->input->post('address'),
			'pincode'                => $this->input->post('pincode'),
			
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName4,
		
			'created_by'    	     => $user_id,
			'modified_by'			 => $user_id,
			'created_at'    	     => time(),
			'modified_at'			 => time()
			
			];
				
		$query = $this->db->insert('per_utl2',$data);

        if($query)
        {
          
            return true;
        }
        return false;
	}
	
		
	
/***********************************Utilities 2 Listing***************************************/
	
		//Listing Utilities 2
		
		  public function utilities2_ListCount() {
        $query = $this->db->count_all_results('per_utl2');
        return $query;
    }

    public function utilities2_List($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_utl2');
            return $query;
        } else {
            $table_name = 'per_utl2';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
 
 
  //Edit Utilities 2
  
     public function edit_utilities2($id){ 

      //$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
			 
			 
			
			 
			$data = [
           
			'type'                    => $this->input->post('type4'),
			'servive_orerator'        => $this->input->post('servive_orerator'),
			'account_number'          => $this->input->post('account_number'),
			'address_details'            => $this->input->post('address_details'),
			'address'         			=> $this->input->post('address'),
			'pincode'          		=> $this->input->post('pincode'),
			
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
		
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_utl2', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_utl2'); //create an activity
            return true;
        }
        return false;

    }
	
	
	
	
  //Copy Utilities 2
  
     public function copy_utilities2($id){ 

      //$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
		
			$data = [
           
			'type'                    => $this->input->post('type4'),
			'servive_orerator'        => $this->input->post('servive_orerator'),
			'account_number'          => $this->input->post('account_number'),
			'address_details'            => $this->input->post('address_details'),
			'address'         			=> $this->input->post('address'),
			'pincode'          		=> $this->input->post('pincode'),
			
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
		
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->insert('per_utl2', $data);

        if($query)
        {
            create_activity('Inserted '.$data['modified_by'].' per_utl2'); //create an activity
            return true;
        }
        return false;

    }
	
//------------------unable disable drop ------------------------//			 
	
	function Utility2_on_type($type) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        $where_array = array('created_by' => $user_id, 'type' => $type);
        $table_name = "per_utl2";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return true;
        } else {
            return false;
        }
    }
	
		
// Medical add--------------------------------------------
			public function medical()
	{		
			
			//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName5 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
			 
		
			$data = [
           
			'type'                    => $this->input->post('type5'),
			'health_status'           => $this->input->post('health_status'),
			'major_injuries'          => $this->input->post('major_injuries'),
			'major_diseases'          => $this->input->post('major_diseases'),
			'blood_group'             => $this->input->post('blood_group'),
			'hlth_cnslt'              => $this->input->post('hlth_cnslt'),
			'insurance'               => $this->input->post('insurance'),
			
		    'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName5,
			
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
				
		$query = $this->db->insert('per_medical',$data);

        if($query)
        {
          
            return true;
        }
        return false;
	}
		
				
/***********************************Medical Listing***************************************/
	
		//Listing Medical
		
		  public function medical_ListCount() {
        $query = $this->db->count_all_results('per_medical');
        return $query;
    }

    public function medical_List($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_medical');
            return $query;
        } else {
            $table_name = 'per_medical';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
 
 
  //Edit medical
  
     public function edit_medical($id){ 

      //$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
			 
			
			$data = [
           
			'type'                    => $this->input->post('type5'),
			'health_status'        => $this->input->post('health_status'),
			'major_injuries'          => $this->input->post('major_injuries'),
			'major_diseases'            => $this->input->post('major_diseases'),
			'blood_group'         			=> $this->input->post('blood_group'),
			'hlth_cnslt'          		=> $this->input->post('hlth_cnslt'),
			'insurance'          		=> $this->input->post('insurance'),
			
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_medical', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_medical'); //create an activity
            return true;
        }
        return false;

    }
	
	
	
	  //Copy medical
  
     public function copy_medical($id){ 

      //$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
			 
			 
			
			$data = [
           
			'type'                    => $this->input->post('type5'),
			'health_status'        => $this->input->post('health_status'),
			'major_injuries'          => $this->input->post('major_injuries'),
			'major_diseases'            => $this->input->post('major_diseases'),
			'blood_group'         			=> $this->input->post('blood_group'),
			'hlth_cnslt'          		=> $this->input->post('hlth_cnslt'),
			'insurance'          		=> $this->input->post('insurance'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->insert('per_medical', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_medical'); //create an activity
            return true;
        }
        return false;

    }
	
	//------------------unable disable drop ------------------------//			 
	
	function medical_on_type($type) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        $where_array = array('created_by' => $user_id, 'type' => $type);
        $table_name = "per_medical";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return true;
        } else {
            return false;
        }
    }	
		
// Add  Education================================================================
			public function education()
	{		
		
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName6 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
	
			 
		
			
			 
			$data = [
           
			'type'                    => $this->input->post('type6'),
			'qualification'           => $this->input->post('qualification'),
			'certificate_no'          => $this->input->post('certificate_no'),
			'occupation'          => $this->input->post('occupation'),
			'occ_document'             => $this->input->post('occ_document'),
			'attachments'  			=> $this->input->post('attachments'), 
			 'attachments'				=> $photoName6, 
		
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
				
		$query = $this->db->insert('per_education',$data);

        if($query)
        {
          
            return true;
        }
        return false;
	}
		
		
			
	
//Listing Education
	
	public function educationListCount() {
        $query = $this->db->count_all_results('per_education');
        return $query;
    }

    public function educationList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_education');
            return $query;
        } else {
            $table_name = 'per_education';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }

	

    //edit education
  
     public function edit_education($id){ 

   
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
			 
			 
			
			$data = [
           
			'type'                    => $this->input->post('type6'),
			'qualification'           => $this->input->post('qualification'),
			'certificate_no'          => $this->input->post('certificate_no'),
			'occupation'              => $this->input->post('occupation'),
			'occ_document'            => $this->input->post('occ_document'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_education', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_education'); //create an activity
            return true;
        }
        return false;

    }
	
	
	  //Copy Education
  
     public function copy_education($id){ 

      //$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
			
			 
			 
			
			$data = [
           
			'type'                    => $this->input->post('type6'),
			'qualification'           => $this->input->post('qualification'),
			'certificate_no'          => $this->input->post('certificate_no'),
			'occupation'              => $this->input->post('occupation'),
			'occ_document'            => $this->input->post('occ_document'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->insert('per_education', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_education'); //create an activity
            return true;
        }
        return false;

    }
	//------------------unable disable drop ------------------------//			 
	
	function education_on_type($type) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        $where_array = array('created_by' => $user_id, 'type' => $type);
        $table_name = "per_education";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return true;
        } else {
            return false;
        }
    }	
//-----Add Insurance--------------------------------------------
			public function insurance()
	{		
			
		
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName7 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
			 
			
			$data = [
           
			'type'                    => $this->input->post('type7'),
			'insurance_type'           => $this->input->post('insurance_type'),
		    'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName7,
		
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
				
		$query = $this->db->insert('per_insurance_details',$data);

        if($query)
        {
          
            return true;
        }
        return false;
	}	
	
	
	
		
/**********************************Insurance Listing***************************************/
	
//Listing Insurance
		
		  public function insurance_ListCount() {
        $query = $this->db->count_all_results('per_insurance_details');
        return $query;
    }

    public function insurance_List($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_insurance_details');
            return $query;
        } else {
            $table_name = 'per_insurance_details';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
 
 
  //Edit 
  
     public function edit_insurance($id){ 


			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
				
			 $data = [
           
			'type'                    => $this->input->post('type7'),
			'insurance_type'        => $this->input->post('insurance_type'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_insurance_details', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_insurance_details'); //create an activity
            return true;
        }
        return false;

    }
	
	
	
	//Copy insurance
  
     public function copy_insurance($id){ 

  
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			  	 	 	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			
				
			 
			 
	
			$data = [
           
			'type'                    => $this->input->post('type7'),
			'insurance_type'           => $this->input->post('insurance_type'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
      $query = $this->db->where('id', $id)->insert('per_insurance_details', $data);
        if($query)
        {
            create_activity('Inserted '.$data['modified_by'].' per_insurance_details'); //create an activity
            return true;
        }
        return false;

    }
	
	//------------------unable disable drop ------------------------//			 
	
	function insurance_details_on_type($type) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        $where_array = array('created_by' => $user_id, 'type' => $type);
        $table_name = "per_insurance_details";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
          
            return true;
        } else {
            return false;
        }
    }	
		
// hobbie-----------------------------------	
			public function hobbies()
					{		
			
		
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
		 if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
          

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName8 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
              
            }
        } 
			 
		
				
			
			
			  
		
			$data = [
           
			'type'                    => $this->input->post('type8'),
			'hobbie'           => $this->input->post('hobbie'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName8,
			
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
				
		$query = $this->db->insert('per_hobbies',$data);

        if($query)
        {
          
            return true;
        }
        return false;
	}	
		


		
/**********************************Hobbies Listing***************************************/
	
		//Listing Hobbies
		
		  public function hobbies_ListCount() {
        $query = $this->db->count_all_results('per_hobbies');
        return $query;
    }

    public function hobbies_List($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_hobbies');
            return $query;
        } else {
            $table_name = 'per_hobbies';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
 
 
  //Edit hobbies
  
     public function edit_hobbies($id){ 

      
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			 
		if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
              
            }
        } 
			 
			
			$data = [
           
			'type'                    => $this->input->post('type8'),
			'hobbie'                  => $this->input->post('hobbie'),
		    'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_hobbies', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_hobbies'); //create an activity
            return true;
        }
        return false;

    }
	
	
	
	  //Copy hobbies
  
     public function copy_hobbies($id){ 

      //$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			    if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            //unlink($photo); // delete original photo

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        } 
			 
			 
			
			$data = [
           
			'type'                    => $this->input->post('type8'),
			'hobbie'        => $this->input->post('hobbie'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
      $query = $this->db->where('id', $id)->insert('per_hobbies', $data);
        if($query)
        {
            create_activity('Inserted '.$data['modified_by'].' per_hobbies'); //create an activity
            return true;
        }
        return false;

    }
	
	//------------------unable disable drop ------------------------//			 
	
	function hobbies_on_type($type) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        $where_array = array('created_by' => $user_id, 'type' => $type);
        $table_name = "per_hobbies";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
          
            return true;
        } else {
            return false;
        }
    }	
		
	
// family_nominee ADD==amit===================================================================
			public function family_nominee()
	{		
			
			
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			  //photo
			 
			  	if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
         

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName9 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
               
            }
        } 
			 
			
			 
			 
			 
			 
			 
			$data = [
           
			'type'                        => $this->input->post('type9'),
			'nominee'                     => $this->input->post('nominee'),
			'proof_nominee'               => $this->input->post('proof_nominee'),
			'marital_status'              => $this->input->post('marital_status'),
			'marriage_date'               => $this->input->post('marriage_date'),
			'family_member'               => $this->input->post('family_member'),
			'head_family'                 => $this->input->post('head_family'),
			'parents_name'                => $this->input->post('parents_name'),
			'siblings_name'               => $this->input->post('siblings_name'),
			'partners_name'               => $this->input->post('partners_name'),
			'children_name'               => $this->input->post('children_name'),
			'dependents'                  => $this->input->post('dependents'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'			=> $photoName9,	
		
					
			'created_by'    	          => $user_id,
			'modified_by'			      => $user_id,
			'created_at'    	          => time(),
			'modified_at'			      => time()
			
			];
				
		$query = $this->db->insert('per_family_nominee',$data);

        if($query)
        {
          
            return true;
        }
        return false;
	}	
	
//----listing family---------------------
public function familyListCount() 
{
        $query = $this->db->count_all_results('per_family_nominee');
        return $query;
    }

public function familyList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_family_nominee');
            return $query;
        } else {
            $table_name = 'per_family_nominee';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
//-----------edit family

 public function edit_family_nominee($id){ 

    
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
		
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
       

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
             
            }
        } 
			
			 
			$data = [
           
			'type'                    => $this->input->post('type9'),
			'nominee'           => $this->input->post('nominee'),
			'proof_nominee'          => $this->input->post('proof_nominee'),
			'marital_status'              => $this->input->post('marital_status'),
			'marriage_date'            => $this->input->post('marriage_date'),
			'family_member'            => $this->input->post('family_member'),
			'head_family'            => $this->input->post('head_family'),
			'parents_name'            => $this->input->post('parents_name'),
			'children_name'            => $this->input->post('children_name'),
			'dependents'            => $this->input->post('dependents'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_family_nominee', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_family_nominee'); //create an activity
            return true;
        }
        return false;

    }
	
//-----------edit famil

 public function copy_family_nominee($id){ 

      //$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			   if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            //unlink($photo); // delete original photo

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        } 
		
		
			 
			$data = [
           
			'type'                    => $this->input->post('type9'),
			'nominee'           => $this->input->post('nominee'),
			'proof_nominee'          => $this->input->post('proof_nominee'),
			'marital_status'              => $this->input->post('marital_status'),
			'marriage_date'            => $this->input->post('marriage_date'),
			'family_member'            => $this->input->post('family_member'),
			'head_family'            => $this->input->post('head_family'),
			'parents_name'            => $this->input->post('parents_name'),
			'children_name'            => $this->input->post('children_name'),
			'dependents'            => $this->input->post('dependents'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->insert('per_family_nominee', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_family_nominee'); //create an activity
            return true;
        }
        return false;

    }
	
	//------------------unable disable drop ------------------------//			 
	
	function family_nominee_on_type($type) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        $where_array = array('created_by' => $user_id, 'type' => $type);
        $table_name = "per_family_nominee";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
          
            return true;
        } else {
            return false;
        }
    }	
		
	
//----------------------animal-------------------------------------------------------------------
// pet add-----
			public function pet()
	{		
			
			
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			 	  //photo
			 
			  	if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
        

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName10 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
               
            }
        } 
			
			 
		
			 
		
			
			 
			$data = [
           
			'text1'                        => $this->input->post('text1'),
			'text2'                        => $this->input->post('text2'),
			'text3'                        => $this->input->post('text3'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'			=> $photoName10,	
		
			
			'created_by'    	          => $user_id,
			'modified_by'			      => $user_id,
			'created_at'    	          => time(),
			'modified_at'			      => time()
			
			];
				
		$query = $this->db->insert('per_pet_details',$data);

        if($query)
        {
          
            return true;
        }
        return false;
	}	
	
	
	
	//----lising animal-----------------
	public function petListCount() 
       {
        $query = $this->db->count_all_results('per_pet_details');
        return $query;
    }

    public function petList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_pet_details');
            return $query;
        } else {
            $table_name = 'per_pet_details';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	
//-----------edit animal------------------------------//

 public function edit_pet_animal($id){ 

    
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;

			   if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
       

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
             
            }
        } 
			 
			$data = [
           
			'text1'                    => $this->input->post('text1'),
			'text2'           => $this->input->post('text2'),
			'text3'          => $this->input->post('text3'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			         
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_pet_details', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_pet_details'); //create an activity
            return true;
        }
        return false;

    }
	
//-----------copy animal------------------------------//

 public function copy_pet_animal($id){ 

     
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			 
			   if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
         

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
             
            }
        } 
	
			 
			$data = [
           
			'text1'                    => $this->input->post('text1'),
			'text2'           => $this->input->post('text2'),
			'text3'          => $this->input->post('text3'),
		    'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->insert('per_pet_details', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_pet_details'); //create an activity
            return true;
        }
        return false;

    }
	
//----------------------alumni-------------------------------------------------------------------
// alumniadd
			public function alumniq()
	{		
			
			//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			 //photo
			 
			  	if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            //unlink($photo); // delete original photo

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName11 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        } 
			
			 
			$data = [
           
			'text1'                        => $this->input->post('text4'),
			'text2'                        => $this->input->post('text5'),
			'text3'                        => $this->input->post('text6'),
			
			'attachments'  			       => $this->input->post('attachments'), 
			'attachments'			       => $photoName11,	
			
			'created_by'    	          => $user_id,
			'modified_by'			      => $user_id,
			'created_at'    	          => time(),
			'modified_at'			      => time()
			
			];
				
		$query = $this->db->insert('per_alumni_details',$data);

        if($query)
        {
          
            return true;
        }
        return false;
	}	
	
//----lising alumni-----------------
	public function alumniListCount() 
       {
        $query = $this->db->count_all_results('per_alumni_details');
        return $query;
    }

    public function alumniList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_alumni_details');
            return $query;
        } else {
            $table_name = 'per_alumni_details';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	
//-----------edit alumni

 public function edit_alumni_information($id){ 

			$user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
		if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
         

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
             
            }
        } 
			$data = [
           
			'text1'          => $this->input->post('text4'),
			'text2'          => $this->input->post('text5'),
			'text3'          => $this->input->post('text6'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'			=> $photoName,
			         
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_alumni_details', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_alumni_details'); //create an activity
            return true;
        }
        return false;

    }
	
//-----------copy alumni
	public function copy_alumni_information($id){ 

    
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 //---uplod photo
	if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
          
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
               
            }
        } 
		
	
	
			$data = [
           
			'text1'          => $this->input->post('text4'),
			'text2'          => $this->input->post('text5'),
			'text3'          => $this->input->post('text6'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'			=> $photoName,
			         
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->insert('per_alumni_details', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_alumni_details'); //create an activity
            return true;
        }
        return false;

    }
	
//----------------------sports------------------------------------------------------------------
// Sports add----
		public function sports()
	{		
			
			
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
		if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
         

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName12 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
           
            }
        } 
			
			 
			$data = [
           
			'text1'                        => $this->input->post('text1'),
			'text2'                        => $this->input->post('text2'),
			'text3'                        => $this->input->post('text3'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'			=> $photoName12,	
			
			'created_by'    	          => $user_id,
			'modified_by'			      => $user_id,
			'created_at'    	          => time(),
			'modified_at'			      => time()
			
			];
				
		$query = $this->db->insert('per_sports_details',$data);

        if($query)
        {
          
            return true;
        }
        return false;
	}	
	
//----lising sports-----------------
	public function sportsListCount() 
       {
        $query = $this->db->count_all_results('per_sports_details');
        return $query;
    }

    public function sportsList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_sports_details');
            return $query;
        } else {
            $table_name = 'per_sports_details';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	
//-----------edit sports

 public function edit_sports_information($id){ 

     
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 	 //---uplod photo
	
	if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
    

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
              
            }
        } 
			 
			$data = [
           
			'text1'          => $this->input->post('text1'),
			'text2'          => $this->input->post('text2'),
			'text3'          => $this->input->post('text3'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'			=> $photoName,
			         
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_sports_details', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_sports_details'); //create an activity
            return true;
        }
        return false;

    }
	
//-----------copy sports

 public function copy_sport_information($id){ 

      
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			//---uplod photo
	if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
         

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
              
            }
        } 
	
			 
			$data = [
           
			'text1'          => $this->input->post('text1'),
			'text2'          => $this->input->post('text2'),
			'text3'          => $this->input->post('text3'),
			'attachments'  			    => $this->input->post('attachments'),
			'attachments'				=> $photoName,
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->insert('per_sports_details', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_sports_details'); //create an activity
            return true;
        }
        return false;

    }
	
	
//----------------------Arts-------------------------------------------------------------------
// Arts add----//
		public function arts()
	{		
			
			
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			 //---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName13 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                
            }
        } 
			 
			
		
			 
			 
			$data = [
           
			'text1'                        => $this->input->post('text7'),
			'text2'                        => $this->input->post('text8'),
			'text3'                        => $this->input->post('text9'),
		//	'attachments'  			=> $this->input->post('attachments'),
		//	'attachments'			=> $photoName13,	
			
			'created_by'    	          => $user_id,
			'modified_by'			      => $user_id,
			'created_at'    	          => time(),
			'modified_at'			      => time()
			
			];
				
		$query = $this->db->insert('per_art_details',$data);

        if($query)
        {
          
            return true;
        }
        return false;
	}
		
//----lising arts-----------------
	public function artsListCount() 
       {
        $query = $this->db->count_all_results('per_art_details');
        return $query;
    }

    public function artsList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_art_details');
            return $query;
        } else {
            $table_name = 'per_art_details';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	
//-----------edit arts------------------------------//

 public function edit_arts_information($id){ 

      
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			 	 //---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            //unlink($photo); // delete original photo

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        } 
			
			 
			 
			$data = [
           
			'text1'          => $this->input->post('text7'),
			'text2'          => $this->input->post('text8'),
			'text3'          => $this->input->post('text9'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'			=> $photoName,	
			         
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_art_details', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_art_details'); //create an activity
            return true;
        }
        return false;

    }
	
//-----------copy arts------------------------------//

 public function copy_arts_information($id){ 

      //$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			 //---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            //unlink($photo); // delete original photo

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        } 
		
			 
			 
			$data = [
           
			'text1'          => $this->input->post('text7'),
			'text2'          => $this->input->post('text8'),
			'text3'          => $this->input->post('text9'),
		    'attachments'  			=> $this->input->post('attachments'),
			'attachments'			=> $photoName,	
			         
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_art_details', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_art_details'); //create an activity
            return true;
        }
        return false;

    } 
//----------------------places-------------------------------------------------------------------------

// favourite add-----
	
		public function favourite()
	{		
			
			
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			 		 
	//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName14 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
               
            }
        } 
	
			 
			$data = [
           
			'text1'                        => $this->input->post('text10'),
			'text2'                        => $this->input->post('text11'),
			'text3'                        => $this->input->post('text12'),
		    'attachments'  			=> $this->input->post('attachments'),
			'attachments'			=> $photoName14,	
			
			'created_by'    	          => $user_id,
			'modified_by'			      => $user_id,
			'created_at'    	          => time(),
			'modified_at'			      => time()
			
			];
				
		$query = $this->db->insert('per_favourite_places',$data);

        if($query)
        {
          
            return true;
        }
        return false;
	}	
	
	
//----lising places-----------------
public function favoutiteListCount() 
       {
        $query = $this->db->count_all_results('per_favourite_places');
        return $query;
    }

public function favoutiteList($limit = 0, $start = 0) 
{
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_favourite_places');
            return $query;
        } else {
            $table_name = 'per_favourite_places';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	
//-----------edit places------------------------------//

 public function edit_favourite_places($id)
 { 

      //$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			 
			 
				if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            //unlink($photo); // delete original photo

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        } 
		
			$data = [
           
			'text1'          => $this->input->post('text10'),
			'text2'          => $this->input->post('text11'),
			'text3'          => $this->input->post('text12'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_favourite_places', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_favourite_places'); //create an activity
            return true;
        }
        return false;

    }
	
//-----------copy places------------------------------//

 public function copy_favourite_places($id){ 

      //$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            //unlink($photo); // delete original photo

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        } 
		
		
			 
			$data = [
           
			'text1'          => $this->input->post('text10'),
			'text2'          => $this->input->post('text11'),
			'text3'          => $this->input->post('text12'),
		    'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			         
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->insert('per_favourite_places', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_favourite_places'); //create an activity
            return true;
        }
        return false;

    }
	
//----------------------food habits-------------------------------------------------------------------
// Food Habit ADD----------------
		public function food_habits()
	{		
			
			
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
		//---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
           
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName15 = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
               
            }
        } 
	
			 
			$data = [
           
			'text1'                        => $this->input->post('text13'),
			'text2'                        => $this->input->post('text14'),
			'text3'                        => $this->input->post('text15'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'			=> $photoName15,	
			
			'created_by'    	          => $user_id,
			'modified_by'			      => $user_id,
			'created_at'    	          => time(),
			'modified_at'			      => time()
			
			];
				
		$query = $this->db->insert('per_food_habits',$data);

        if($query)
        {
          
            return true;
        }
        return false;
	}
//----lising food-----------------
public function foodListCount() 
       {
        $query = $this->db->count_all_results('per_food_habits');
        return $query;
    }

public function foodList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('per_food_habits');
            return $query;
        } else {
            $table_name = 'per_food_habits';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
//-----------edit food ------------------------------//

 public function edit_food_habits($id){ 

      //$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			 //---uplod photo
			if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            //unlink($photo); // delete original photo

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        } 
			 
			$data = [
           
			'text1'          => $this->input->post('text13'),
			'text2'          => $this->input->post('text14'),
			'text3'          => $this->input->post('text15'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			         
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->update('per_food_habits', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_food_habits'); //create an activity
            return true;
        }
        return false;

    }
//--copy food
	public function copy_food_habits($id){ 

      //$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
//---uplod photo
	if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 200;
            $config['height'] = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            //unlink($photo); // delete original photo

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        } 
		
			$data = [
           
			'text1'          => $this->input->post('text13'),
			'text2'          => $this->input->post('text14'),
			'text3'          => $this->input->post('text15'),
			'attachments'  			=> $this->input->post('attachments'),
			'attachments'				=> $photoName,
			         
			'created_by'    	      => $user_id,
			'modified_by'			  => $user_id,
			'created_at'    	      => time(),
			'modified_at'			  => time()
			
			];
		
		
        $query = $this->db->where('id', $id)->insert('per_food_habits', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' per_food_habits'); //create an activity
            return true;
        }
        return false;

    }


	
	}//last brace 