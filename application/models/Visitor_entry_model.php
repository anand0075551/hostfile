<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor_entry_model extends CI_Model 
	{

    /**
     * @return bool
     */

public function add_visitors()
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
			  	if($photoName == null)
		{
			$photoName = 'Chrysanthemum.jpg';
		}
		
			$data = [
           
			'visitor_name'          		=> $this->input->post('visitor_name'),
			'type_of_selection'				=> 'Visitors',
			'type_of_id'   					=> $this->input->post('type_of_id'),
			'proof_number'   				=> $this->input->post('proof_number'),
            'email_id'        				=> $this->input->post('email_id'),
			'purpose'         	    		=> $this->input->post('purpose'),
			'from_place'      				=> $this->input->post('from_place'),
            'refferer'        				=> $this->input->post('refferer'),
			'whom_to_meet'             		=> $this->input->post('whom_to_meet'),
			'mobile_no'         			=> $this->input->post('mobile_no'),
			'remarks'         				=> $this->input->post('remarks'),
			'photo' 						=> $this->input->post('photo'),
            'photo' 						=> $photoName,
			'custom1'         				=> $this->input->post('custom1'),
			'custom2'         				=> $this->input->post('custom2'),
			'custom3'         				=> $this->input->post('custom3'),
			'custom4'         				=> $this->input->post('custom1'),
			'custom5'         				=> $this->input->post('custom5'),
			'created_by'    	   			=> $user_id,
			'created_at'    	    		=> time()
			
			
			];
				
		$query = $this->db->insert('visitors_details', $data);

        if($query)
        {
           // create_activity('Added '.$data['created_by'].'visitors_details'); //create an activity
            return true;
        }
	}
	
      
	
   public function visitor_entryListCount() {
		
			$query = $this->db->count_all_results('visitors_details');
			return $query; 
		
    }	
	
	public function visitor_entryList($limit = 10, $start = 0) {
           
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
				if ($currentUser == 'admin')
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('visitors_details');
					return $query;
				}
				else
				{  
					$table_name = 'visitors_details';
					$where_array = array('created_by' => $user_id);
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
					return $query;
				}

	}

	
	
	public function edit_visitor_entry($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		
          
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
			
			
				if($photoName == null)
		{
			$photoName = 'Chrysanthemum.jpg';
		}
		
		 
          $data = [
           
			'visitor_name'          		=> $this->input->post('visitor_name'),
			'type_of_id'   					=> $this->input->post('type_of_id'),
			'proof_number'   				=> $this->input->post('proof_number'),
            'email_id'        				=> $this->input->post('email_id'),
			'purpose'         	    		=> $this->input->post('purpose'),
			'from_place'      				=> $this->input->post('from_place'),
            'refferer'        				=> $this->input->post('refferer'),
			'whom_to_meet'             		=> $this->input->post('whom_to_meet'),
			'mobile_no'         			=> $this->input->post('mobile_no'),
			'remarks'         				=> $this->input->post('remarks'),
			'photo' 						=> $this->input->post('photo'),
            'photo' 						=> $photoName,
			'custom1'         				=> $this->input->post('custom1'),
			'custom2'         				=> $this->input->post('custom2'),
			'custom3'         				=> $this->input->post('custom3'),
			'custom4'         				=> $this->input->post('custom1'),
			'custom5'         				=> $this->input->post('custom5'),		
            'modified_by' 					=> $user_id,
            'modified_at' 					=> time()
        ];

        $query = $this->db->where('id', $id)->update('visitors_details', $data);

        if ($query) {
            //create_activity('Updated ' . $data['name'] . 'visitors_details'); //create an activity
            return true;
        }
        return false;
    }
	
	
	public function copy_visitor($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		
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
			
		 
		 	if($photoName == null)
		{
			$photoName = 'Chrysanthemum.jpg';
		}
		
          $data = [
           
			'visitor_name'          		=> $this->input->post('visitor_name'),
			'type_of_id'   					=> $this->input->post('type_of_id'),
			'proof_number'   				=> $this->input->post('proof_number'),
            'email_id'        				=> $this->input->post('email_id'),
			'purpose'         	    		=> $this->input->post('purpose'),
			'from_place'      				=> $this->input->post('from_place'),
            'refferer'        				=> $this->input->post('refferer'),
			'whom_to_meet'             		=> $this->input->post('whom_to_meet'),
			'mobile_no'         			=> $this->input->post('mobile_no'),
			'remarks'         				=> $this->input->post('remarks'),		
			'photo' 						=> $this->input->post('photo'),
			'photo' 						=> $photoName,
			'custom1'         				=> $this->input->post('custom1'),
			'custom2'         				=> $this->input->post('custom2'),
			'custom3'         				=> $this->input->post('custom3'),
			'custom4'         				=> $this->input->post('custom1'),
			'custom5'         				=> $this->input->post('custom5'),		
            'modified_by' 					=> $user_id,
            'modified_at' 					=> time()
        ];

        $query = $this->db->where('id', $id)->insert('visitors_details', $data);

        if ($query) {
            //create_activity('Updated ' . $data['name'] . 'visitors_details'); //create an activity
            return true;
        }
        return false;
    }
	
	
	
	public function add_inward_items()
	{
		 $user_info = $this->session->userdata('logged_user');
		 $user_id = $user_info['user_id'];
		 
		 	 
	
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
			
				if($photoName == null)
		{
			$photoName = 'Chrysanthemum.jpg';
		}
		
		 
		 
		 $data = [
			'item_name'  		=> $this->input->post('item_name'),
			'type_of_selection'				=> 'Inward',
			'type_of_item'  	=> $this->input->post('type_of_item'),
			'item_number'  		=> $this->input->post('item_number'),
			'invoice_id'  		=> $this->input->post('invoice_id'),
			'purpose'  			=> $this->input->post('purpose'),
			'item_value'  		=> $this->input->post('item_value'),
			'from_place'  		=> $this->input->post('from_place'),
			'from_whom'  		=> $this->input->post('from_whom'),
			'to_reciver'  		=> $this->input->post('to_reciver'),
			'mobile_no'  		=> $this->input->post('mobile_no'),
			'remarks'  			=> $this->input->post('remarks'),
			'photo'  			=> $this->input->post('photo'),
			'photo'				=> $photoName,
			'created_by'    	=> $user_id,
			'created_at'    	=> time()
			
			];
			
		$query = $this->db->insert('visitors_details', $data);

        if($query)
        {
           // create_activity('Added '.$data['name'].' visitors_details'); //create an activity
            return true;
        }
        return false;
	}
	
	 public function inward_itemListCount() {
		
			$query = $this->db->count_all_results('visitors_details');
			return $query; 
		
    }	
	
	public function inward_itemList($limit = 10, $start = 0) {
           
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
				if ($currentUser == 'admin')
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('visitors_details', ['type_of_selection'=>'Inward']);
					return $query;
				}
				else
				{  
					$table_name = 'visitors_details';
					$where_array = array('created_by' => $user_id);
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
					return $query;
				}

	}
	
	public function edit_inward_items($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		
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
			
			
				if($photoName == null)
		{
			$photoName = 'Chrysanthemum.jpg';
		}
		
		 
          $data = [
         'item_name'  		=> $this->input->post('item_name'),
			'type_of_item'  	=> $this->input->post('type_of_item'),
			'item_number'  		=> $this->input->post('item_number'),
			'invoice_id'  		=> $this->input->post('invoice_id'),
			'purpose'  			=> $this->input->post('purpose'),
			'item_value'  		=> $this->input->post('item_value'),
			'from_place'  		=> $this->input->post('from_place'),
			'from_whom'  		=> $this->input->post('from_whom'),
			'to_reciver'  		=> $this->input->post('to_reciver'),
			'mobile_no'  		=> $this->input->post('mobile_no'),
			'remarks'  			=> $this->input->post('remarks'),
			'photo' 			=> $this->input->post('photo'),
            'photo' 			=> $photoName,
            'modified_by' 					=> $user_id,
            'modified_at' 					=> time()
        ];

        $query = $this->db->where('id', $id)->update('visitors_details', $data);

        if ($query) {
            //create_activity('Updated ' . $data['name'] . 'visitors_details'); //create an activity
            return true;
        }
        return false;
    }
	
	public function copy_inward_items($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 	 
		
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
		
			if($photoName == null)
		{
			$photoName = 'Chrysanthemum.jpg';
		}
		
			
		 
          $data = [
         'item_name'  		=> $this->input->post('item_name'),
			'type_of_item'  	=> $this->input->post('type_of_item'),
			'type_of_selection'				=> 'Inward',
			'item_number'  		=> $this->input->post('item_number'),
			'invoice_id'  		=> $this->input->post('invoice_id'),
			'purpose'  			=> $this->input->post('purpose'),
			'item_value'  		=> $this->input->post('item_value'),
			'from_place'  		=> $this->input->post('from_place'),
			'from_whom'  		=> $this->input->post('from_whom'),
			'to_reciver'  		=> $this->input->post('to_reciver'),
			'mobile_no'  		=> $this->input->post('mobile_no'),
			'remarks'  			=> $this->input->post('remarks'),
			'photo' 			=> $this->input->post('photo'),
            'photo' 			=> $photoName,
            'created_at' 		=> time(),
            'created_by' 		=> $user_id
        ];

       $query = $this->db->insert('visitors_details', $data);

        if ($query) {
            //create_activity('Updated ' . $data['name'] . 'visitors_details'); //create an activity
            return true;
        }
        return false;
    }
	
	/* Outward Item Model functuion */
	
	
	public function add_outward_items()
	{
		 $user_info = $this->session->userdata('logged_user');
		 $user_id = $user_info['user_id'];
		 
		 		 	 
		
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
			
				if($photoName == null)
		{
			$photoName = 'Chrysanthemum.jpg';
		}
		
		 
		 
		 $data = [
			'item_name'  		=> $this->input->post('item_name'),
			'type_of_selection'				=> 'Outward',
			'type_of_item'  	=> $this->input->post('type_of_item'),
			'item_number'  		=> $this->input->post('item_number'),
			'invoice_id'  		=> $this->input->post('invoice_id'),
			'purpose'  			=> $this->input->post('purpose'),
			'item_value'  		=> $this->input->post('item_value'),
			'from_place'  		=> $this->input->post('from_place'),
			'to_whom'  			=> $this->input->post('to_whom'),
			'from_sender'  		=> $this->input->post('from_sender'),
			'mobile_no'  		=> $this->input->post('mobile_no'),
			'remarks'  			=> $this->input->post('remarks'),
			'photo' 			=> $this->input->post('photo'),
            'photo' 			=> $photoName,
			'created_by' 					=> $user_id,
            'created_at' 					=> time()
			
			];
			
		$query = $this->db->insert('visitors_details', $data);

        if($query)
        {
           // create_activity('Added '.$data['name'].' visitors_details'); //create an activity
            return true;
        }
        return false;
	}
	
	 public function outward_itemListCount() {
		
			$query = $this->db->count_all_results('visitors_details');
			return $query; 
			
    }	
	
	public function outward_itemList($limit = 10, $start = 0) {
           
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
				if ($currentUser == 'admin')
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('visitors_details');
					return $query;
				}
				else
				{  
					$table_name = 'visitors_details';
					$where_array = array('created_by' => $user_id);
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get_where('visitors_details', ['type_of_selection'=>'Outward']);
					return $query;
				}

	}
	
	public function edit_outward_items($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		 	 
		
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
		
			if($photoName == null)
		{
			$photoName = 'Chrysanthemum.jpg';
		}
		
			
		 
          $data = [
         'item_name'  			=> $this->input->post('item_name'),
			'type_of_item'  	=> $this->input->post('type_of_item'),
			'item_number'  		=> $this->input->post('item_number'),
			'invoice_id'  		=> $this->input->post('invoice_id'),
			'purpose'  			=> $this->input->post('purpose'),
			'item_value'  		=> $this->input->post('item_value'),
			'from_place'  		=> $this->input->post('from_place'),
			'to_whom'  			=> $this->input->post('to_whom'),
			'from_sender'  		=> $this->input->post('from_sender'),
			'mobile_no'  		=> $this->input->post('mobile_no'),
			'remarks'  			=> $this->input->post('remarks'),
			'photo' 			=> $this->input->post('photo'),
            'photo' 			=> $photoName,
            'modified_by' 					=> $user_id,
            'modified_at' 					=> time()
        ];

        $query = $this->db->where('id', $id)->update('visitors_details', $data);

        if ($query) {
            //create_activity('Updated ' . $data['name'] . 'visitors_details'); //create an activity
            return true;
        }
        return false;
    }
	
	public function copy_outward_items($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 	 
		
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
			
				if($photoName == null)
		{
			$photoName = 'Chrysanthemum.jpg';
		}
		
		 
          $data = [
         'item_name'  			=> $this->input->post('item_name'),
			'type_of_item'  	=> $this->input->post('type_of_item'),
			'item_number'  		=> $this->input->post('item_number'),
			'invoice_id'  		=> $this->input->post('invoice_id'),
			'purpose'  			=> $this->input->post('purpose'),
			'item_value'  		=> $this->input->post('item_value'),
			'from_place'  		=> $this->input->post('from_place'),
			'to_whom'  			=> $this->input->post('to_whom'),
			'from_sender'  		=> $this->input->post('from_sender'),
			'mobile_no'  		=> $this->input->post('mobile_no'),
			'remarks'  			=> $this->input->post('remarks'),
			'photo' 			=> $this->input->post('photo'),
            'photo' 			=> $photoName,
            'created_at' 		=> time(),
            'created_by' 		=> $user_id
        ];

        $query = $this->db->where('id', $id)->insert('visitors_details', $data);

        if ($query) {
            //create_activity('Updated ' . $data['name'] . 'visitors_details'); //create an activity
            return true;
        }
        return false;
    }
	
	
	public function search_visitor_ListCount($visitor,$type_of_entry,$mobile_no,$purpose,$sf_time,$st_time)
	{
		
		/*$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;*/
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		if($visitor !='')
		{	
			if($condition != ""){
			$condition.="visitor_name = ".$visitor." ";
			}
			else{
				$condition.="visitor_name = '".$visitor."'";
			}
		}
		
		if($type_of_entry !='')
		{
			if($condition != ""){
				$condition.=" AND type_of_selection = '".$type_of_entry."'";
			}
			else{
				$condition.="type_of_selection = '".$type_of_entry."'";
			}
		}
		if($mobile_no !='')
		{
			if($condition != ""){
				$condition.=" AND mobile_no = '".$mobile_no."'";
			}
			else{
				$condition.="mobile_no = '".$mobile_no."'";
			}
		}
		if($purpose !='')
		{
			if($condition != ""){
				$condition.=" AND purpose = '".$purpose."'";
			}
			else{
				$condition.="purpose = '".$purpose."'";
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
			$query = $this->db->where($where_array)->count_all_results('visitors_details');
		}
		else
		{
			$query = $this->db->count_all_results('visitors_details');
		}
		
        return $query;
	
	}
	
	public function search_visitor_List($limit=10, $start=0 ,$visitor,$type_of_entry,$mobile_no,$purpose,$sf_time,$st_time){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		//$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		$search = $this->input->get('search');	
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
			$condition="";
		if($visitor !='')
		{	
			if($condition != ""){
			$condition.="visitor_name = ".$visitor." ";
			}
			else{
				$condition.="visitor_name = '".$visitor."'";
			}
		}
		
		if($type_of_entry !='')
		{
			if($condition != ""){
				$condition.=" AND type_of_selection = '".$type_of_entry."'";
			}
			else{
				$condition.="type_of_selection = '".$type_of_entry."'";
			}
		}
		if($mobile_no !='')
		{
			if($condition != ""){
				$condition.=" AND mobile_no = '".$mobile_no."'";
			}
			else{
				$condition.="mobile_no = '".$mobile_no."'";
			}
		}
		if($purpose !='')
		{
			if($condition != ""){
				$condition.=" AND purpose = '".$purpose."'";
			}
			else{
				$condition.="purpose = '".$purpose."'";
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
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('visitors_details');
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('visitors_details');
		}
        return $query;
	
	}
	
	
	public function copy_visitor_report($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		
            if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/visitor'; //Upload directory
			//./uploads/cfirst_bannersrestoo.jpg
            if (!file_exists($upload_dir))
            mkdir($upload_dir);                 //create directory if not found.
            $config['upload_path']             = $upload_dir;
            $config['allowed_types']        = 'gif|jpg|png';
            $config['image_library']         = 'gd2';
            $config['maintain_ratio']        = TRUE;
            $config['width']                 = 1600;
            $config['height']                  = 500;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        unlink($photo); // delete original photo

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        }
		 
          $data = [
           
			'visitor_name'          		=> $this->input->post('visitor_name'),
			'item_name'          			=> $this->input->post('item_name'),
			'type_of_id'   					=> $this->input->post('type_of_id'),
			'type_of_item'   				=> $this->input->post('type_of_item'),
			'item_number'   				=> $this->input->post('item_number'),
			'invoice_id'   					=> $this->input->post('invoice_id'),
			'proof_number'   				=> $this->input->post('proof_number'),
            'email_id'        				=> $this->input->post('email_id'),
			'purpose'         	    		=> $this->input->post('purpose'),
			'item_value'         	    	=> $this->input->post('item_value'),
			'from_place'      				=> $this->input->post('from_place'),
			'to_reciver'      				=> $this->input->post('to_reciver'),
            'refferer'        				=> $this->input->post('refferer'),
			'whom_to_meet'             		=> $this->input->post('whom_to_meet'),
			'to_whom'             			=> $this->input->post('to_whom'),
			'from_whom'             		=> $this->input->post('from_whom'),
			'from_sender'             		=> $this->input->post('from_sender'),
			'mobile_no'         			=> $this->input->post('mobile_no'),
			'remarks'         				=> $this->input->post('remarks'),
			'photo'				 		=> $photoName,
			'photo'						=> $fullPhoto,
            'modified_by' 					=> $user_id,
            'modified_at' 					=> time()
        ];

        $query = $this->db->where('id', $id)->insert('visitors_details', $data);

        if ($query) {
            //create_activity('Updated ' . $data['name'] . 'visitors_details'); //create an activity
            return true;
        }
        return false;
    }
	
	
	public function add_assigned_to()
	{
		 $user_info = $this->session->userdata('logged_user');
		 $user_id = $user_info['user_id'];	
		 
		 $data = [
			'role'  						=> $this->input->post('role'),
			'visitor_id'  					=> $this->input->post('visitor_id'),
			'user'  						=> $this->input->post('user'),
			'start_date'  					=> $this->input->post('start_date'),
			'end_date'  					=> $this->input->post('end_date'),
			'cost_value_of_asset'   		=> $this->input->post('cost_value_of_asset'),
			'condition_of_asset'   			=> $this->input->post('condition_of_asset'),
			'next_renewal_date'   			=> $this->input->post('next_renewal_date'),
			
			'created_by' 					=> $user_id,
			'assigned_to' 					=> $user_id,
            'created_at' 					=> time()
			];
			
			
		$query = $this->db->insert('assests_history', $data);

        if($query)
        {
            //create_activity('Added '.$data['created_by'].' visitors_details'); //create an activity
            return true;
        }
        return false;
	}
	
		
	public function search_asset_ListCount($user,$role,$sf_time,$st_time)
	{
		
		/*$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;*/
		$search = $this->input->get('search');	
		
		$searchByID = '';
		$condition="";
		if($user !='')
		{	
			if($condition != ""){
			$condition.="user = ".$user." ";
			}
			else{
				$condition.="user = '".$user."'";
			}
		}
		
		if($role !='')
		{
			if($condition != ""){
				$condition.=" AND role = '".$role."'";
			}
			else{
				$condition.="role = '".$role."'";
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
			$query = $this->db->where($where_array)->count_all_results('assests_history');
		}
		else
		{
			$query = $this->db->count_all_results('assests_history');
		}
		
        return $query;
	
	}
	
	public function search_asset_List($limit=10, $start=0 ,$user,$role,$sf_time,$st_time){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		//$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		$search = $this->input->get('search');	
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$searchByID = '';
			$condition="";
		if($user !='')
		{	
			if($condition != ""){
			$condition.="user = ".$user." ";
			}
			else{
				$condition.="user = '".$user."'";
			}
		}
		
		if($role !='')
		{
			if($condition != ""){
				$condition.=" AND role = '".$role."'";
			}
			else{
				$condition.="role = '".$role."'";
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
			$where_array = $condition;
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('assests_history');
		}
		else
		{
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('assests_history');
		}
        return $query;
	
	}
	
	
	public function copy_asset_report($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
          $data = [
           
			'visitor_id'          		=> $this->input->post('visitor_id'),
			'role'          			=> $this->input->post('role'),
			'user'   					=> $this->input->post('user'),
			'status'   					=> '0',
			'start_date'   				=> $this->input->post('start_date'),
			'end_date'   				=> $this->input->post('end_date'),
			'cost_value_of_asset'   	=> $this->input->post('cost_value_of_asset'),
			'condition_of_asset'   		=> $this->input->post('condition_of_asset'),
			'next_renewal_date'   		=> $this->input->post('next_renewal_date'),
            'modified_by' 				=> $user_id,
			'assigned_to'				=> $user_id,
			'created_at' 				=> time(),
            'created_by' 				=> $user_id
        ];

        $query = $this->db->where('id', $id)->insert('assests_history', $data);

        if ($query) {
           // create_activity('Updated ' . $data['created_by'] . 'assests_history'); //create an activity
            return true;
        }
        return false;
    }
	
}//last brace required