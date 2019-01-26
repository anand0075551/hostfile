<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transport_model extends CI_Model 
	{

    /**
     * @return bool
     */

	public function transport()
	{		
			
			
			
			$state_code			= $this->input->post('state_code');
			$code_num			= $this->input->post('code_num');
			$abc            	= $this->input->post('abc');
			$number            	= $this->input->post('number');
			$reg_num = $state_code."-" .$code_num. "-" .$abc. "-" .$number;
			
			
			//********* uplode files ******
			
		if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/vehicle'; //Upload directory
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
				//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			$data = [
			
            'user_id'               => $user_id,
			'root_id'         		=> $root_id,
			'main_category'         => $this->input->post('main_category'),
			'sub_category'          => $this->input->post('sub_category'),
			'yrmaning'      		=> $this->input->post('yrmaning'),
			'make'      			=> $this->input->post('make'),
			'model'      			=> $this->input->post('model'),
			'version'      			=> $this->input->post('version'),
			'owners_number'      	=> $this->input->post('owners_number'),
			'kms_driven'      		=> $this->input->post('kms_driven'),
			'capacityperson'        => $this->input->post('capacityperson'),
			'cap_load'         	    => $this->input->post('cap_load'),
			'reg_num'               => $reg_num,
			'reg_date'          	=> $this->input->post('reg_date'),
			'chassis_no'          	=> $this->input->post('chassis_no'),
			'engine_no'          	=> $this->input->post('engine_no'),
			'org_name'          	=> $this->input->post('org_name'),
			'owner_name'          	=> $this->input->post('owner_name'),
			'address_details'       => $this->input->post('address_details'),
			'model_no'       		=> $this->input->post('model_no'),
			'fule_type'       		=> $this->input->post('fule_type'),
			'insurence_startdate'   => $this->input->post('insurence_startdate'),
			'insurece_enddate'   	=> $this->input->post('insurece_enddate'),	
			'fitness_cer_begin'   	=> $this->input->post('fitness_cer_begin'),
			'fitness_cer_end'   	=> $this->input->post('fitness_cer_end'),
			'pollution_cer_begin'   => $this->input->post('pollution_cer_begin'),
			'pollution_cer_end'   	=> $this->input->post('pollution_cer_end'),
			'passing_cer_start'   	=> $this->input->post('passing_cer_start'),
			'passing_cer_end'   	=> $this->input->post('passing_cer_end'),
			'tyre_cond'             => $this->input->post('tyre_cond'),
			'engine_cond'         	=> $this->input->post('engine_cond'),
			'rc_book'         		=> $this->input->post('rc_book'),
			'insurence_Policy'      => $this->input->post('insurence_Policy'),
			'pollution_certifi'     => $this->input->post('pollution_certifi'),
			'photo'				 	=> $photoName,
			'created_by'    	    => $user_id,
			'created_at'    	    => time()
			];
				
		$query = $this->db->insert('trp_vehicles', $data);

        if($query)
        {
            create_activity('Added '.$data['created_by'].'user_address'); //create an activity
            return true;
        }
        return false;
	}
	
       //transport module view
	
   public function transportListCount() {
		
			$query = $this->db->count_all_results('trp_vehicles');
			return $query; 
		
    }	
	
	public function transportlist($limit = 10, $start = 0) {
           
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
				if ($currentUser == 'admin')
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('trp_vehicles');
					return $query;
				}
				else
				{  
					$table_name = 'trp_vehicles';
					$where_array = array('created_by' => $user_id);
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
					return $query;
				}

	}

	
	
	public function edit_transport($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 
          $data = [
           
			'user_id'               => $user_id,
			'root_id'         		=> $root_id,
/****************************************************************************/
			//'main_category'         => $this->input->post('main_category'),
			//'sub_category'          => $this->input->post('sub_category'),
			//'tyre_cond'             => $this->input->post('tyre_cond'),
			//'make'      			  => $this->input->post('make'),
			//'model'      			  => $this->input->post('model'),
			//'version'      		  => $this->input->post('version'),
			//'owners_number'      	  => $this->input->post('owners_number'),
			//'capacityperson'        => $this->input->post('capacityperson'),
			//'cap_load'         	  => $this->input->post('cap_load'),
			//'reg_num'               => $reg_num,
			//	'photo'				  => $photoName,
			//	'photo'				  => $fullPhoto,
/****************************************************************************/
			'user_id'               => $user_id,
			'root_id'         		=> $root_id,
			'yrmaning'      		=> $this->input->post('yrmaning'),
			'kms_driven'      		=> $this->input->post('kms_driven'),
			'reg_date'          	=> $this->input->post('reg_date'),
			'chassis_no'          	=> $this->input->post('chassis_no'),
			'engine_no'          	=> $this->input->post('engine_no'),
			'org_name'          	=> $this->input->post('org_name'),
			'owner_name'          	=> $this->input->post('owner_name'),
			'address_details'       => $this->input->post('address_details'),
			'model_no'       		=> $this->input->post('model_no'),
			'fule_type'       		=> $this->input->post('fule_type'),
			'insurence_startdate'   => $this->input->post('insurence_startdate'),
			'insurece_enddate'   	=> $this->input->post('insurece_enddate'),	
			'fitness_cer_begin'   	=> $this->input->post('fitness_cer_begin'),
			'fitness_cer_end'   	=> $this->input->post('fitness_cer_end'),
			'pollution_cer_begin'   => $this->input->post('pollution_cer_begin'),
			'pollution_cer_end'   	=> $this->input->post('pollution_cer_end'),
			'passing_cer_start'   	=> $this->input->post('passing_cer_start'),
			'passing_cer_end'   	=> $this->input->post('passing_cer_end'),
			'engine_cond'         	=> $this->input->post('engine_cond'),
            'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query = $this->db->where('id', $id)->update('trp_vehicles', $data);

        if ($query) {
            create_activity('Updated ' . $data['modified_by'] . 'trp_vehicles'); //create an activity
            return true;
        }
        return false;
    }
	//Add vehicle starts here
	
	public function add_vehicletype()
	{
		 $user_info = $this->session->userdata('logged_user');
		 $user_id = $user_info['user_id'];
		 $data = [
			
			'vehicle_type'  => $this->input->post('vehicle_type'),
			'created_by'    	    => $user_id,
			//'modified_by'			=> $user_id,
			'created_at'    	    => time()
			
			];
			
		$query = $this->db->insert('trp_vehicles_reg', $data);

        if($query)
        {
            create_activity('Added '.$data['created_by'].'trp_vehicles_reg'); //create an activity
            return true;
        }
        return false;
	}
	
	  public function vehicleListCount() {
		/*$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;
		
		 if ($currentUser == 'admin')
		{*/
			$query = $this->db->count_all_results('trp_vehicles_reg');
		/*}else{
			$query = $this->db->where( 'created_by ' , $user_id  )->count_all_results('trp_vehicles');	
		}*/
			return $query; 
		
    }	
	
	public function vehicleList($limit = 10, $start = 0) {
           
		//$user_info 	 = $this->session->userdata('logged_user');
        //$user_id 	 = $user_info['user_id'];
		/*$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;*/
		
		
		
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('trp_vehicles_reg'); 
		
        return $query; 
    }
	
	public function edit_vehical($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 
          $data = [
           
				'vehicle_type'  => $this->input->post('vehicle_type'),
				'modified_by' 		=> $user_id,
				'modified_at' 		=> time()
    
				];

        $query = $this->db->where('id', $id)->update('trp_vehicles_reg', $data);

        if ($query) {
            create_activity('Updated ' . $data['name'] . 'trp_vehicles_reg'); //create an activity  
            return true;
        }
        return false;
    }
	
	//Add capacityperson starts here
	
	public function add_capacityperson()
	{	
		 $user_info = $this->session->userdata('logged_user');
         $user_id = $user_info['user_id'];
		 
		 $data = [
			
			'capacityperson'  => $this->input->post('capacityperson'),
			'created_by'    	    => $user_id,
			//'modified_by'			=> $user_id,
			'created_at'    	    => time()
		
			];
			
		$query = $this->db->insert('trp_capicity_person', $data);

        if($query)
        {
            create_activity('Added '.$data['created_by'].'trp_capicity_person'); //create an activity
            return true;
        }
        return false;
	}
	
	  public function capacitypersonListCount() {
		/*$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;*/
		
		 /*if ($currentUser == 'admin')
		{*/
			$query = $this->db->count_all_results('trp_capicity_person');
		/*}else{
			$query = $this->db->where( 'created_by ' , $user_id  )->count_all_results('add_capacityperson');	
		}*/
			return $query; 
		
    }	
	
	public function capacitypersonList($limit = 10, $start = 0) {
           
		/*$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;*/
		
		
		
			$query = $this->db->order_by('id', 'asce')->limit($limit, $start)->get('trp_capicity_person'); 
		
        return $query; 
    }
	
	public function edit_person_capacity($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 
          $data = [
           
				'capacityperson'  => $this->input->post('capacityperson'),
					'modified_by' 		=> $user_id,
					'modified_at' 		=> time()
				];

        $query = $this->db->where('id', $id)->update('trp_capicity_person', $data);

        if ($query) {
            create_activity('Updated ' . $data['modified_by'] . 'trp_capicity_person'); //create an activity  
            return true;
        }
        return false;
    }
	
	
	
	// capacity load starts here
	
	public function add_capacityload()
	{
			$user_info = $this->session->userdata('logged_user');
		 	$user_id = $user_info['user_id'];
		
		 $data = [
			
					'capacityload'  => $this->input->post('capacityload'),
					'created_by'    	    => $user_id,
					//'modified_by'			=> $user_id,
					'created_at'    	    => time()
			
				];
			
		 //$query = $this->db->insert('add_capacityload', $data);
		 $query = $this->db->insert('trp_capicity_load', $data);

        if($query)
        {
            create_activity('Added '.$data['created_by'].'trp_capicity_load'); //create an activity
            return true;
        }
        return false;
	}
	
	  public function capacityloadListCount() {
		/*$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;*/
		
		 /*if ($currentUser == 'admin')
		{*/
			$query = $this->db->count_all_results('trp_capicity_load');
		/*}else{
			$query = $this->db->where( 'created_by ' , $user_id  )->count_all_results('add_capacityperson');	
		}*/
			return $query; 
		
    }	
	
	public function capacityloadList($limit = 10, $start = 0) {
           
		/*$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;*/
		
		
		
			$query = $this->db->order_by('id', 'asce')->limit($limit, $start)->get('trp_capicity_load'); 
		
        return $query; 
    }
	public function edit_capacityload($id) 
		{

			$user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
			 
			   $data = [
			
							'capacityload'      => $this->input->post('capacityload'),
							'modified_by' 		=> $user_id,
							'modified_at' 		=> time()
			
					  ];

			$query = $this->db->where('id', $id)->update('trp_capicity_load', $data);

			if ($query) {
				create_activity('Updated ' . $data['modified_by'] . 'trp_capicity_load'); //create an activity  
				return true;
			}
			return false;
		}

	

			    function getmodel($brands){
        $where_array = array('make_id' => $brands);
        $table_name = "trp_vehicle_model";
        $query = $this->db->order_by('id', 'asc')->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }

			}
			
			
		function getversion($model){
        $where_array = array('model_id' => $model);
        $table_name = "trp_vehicle_version";
        $query = $this->db->order_by('id', 'asc')->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return $query;
        } else {
            return false;
        }

			}
			
//=========================================amit transport==========================================================================>
	public function vehicle_make()
	{		
			
			//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			$data = [
           
			'brands'     			=> $this->input->post('brands'),
			'created_by'    	    => $user_id,
			//'modified_by'			=> $user_id,
			'created_at'    	    => time()
			//'modified_at'			=> time()
			//'root_id'               => $getreferral
			];
				
		$query = $this->db->insert('trp_vehicle_make', $data);

        if($query)
        {
           // create_activity('Added '.$data['name'].'Transport'); //create an activity
            return true;
        }
        return false;
	}
	
    
	//================================================================================================

    public function vehicles()
	{		
			
			//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
					
			
			$data = [
           
			'make_id'     			=> $this->input->post('m_id'),
			'model'     			=> $this->input->post('model'),
			'created_by'    	    => $user_id,
			'created_at'    	    => time()
			];
				
		$query = $this->db->insert('trp_vehicle_model', $data);

        if($query)
        {
          
            return true;
        }
        return false;
	}
	
	//=========================================================================================================

public function vehicle_type()
	{		
			
			//$data['referral_code'] = $this->db->get('users');
			 $user_info = $this->session->userdata('logged_user');
			 $user_id = $user_info['user_id'];
			
			 $currentUser = singleDbTableRow($user_id)->role;
			 $rolename    = singleDbTableRow($user_id)->rolename;
			 $root_id     = singleDbTableRow($user_id)->referral_code;
			 
			$data = [
           
			'make_id'     => $this->input->post('make_id'),
			'model_id'     => $this->input->post('model_id'),
			'version'     => $this->input->post('version'),
			
			
           
			
			'created_by'    	    => $user_id,
			//'modified_by'			=> $user_id,
			'created_at'    	    => time()
			//'modified_at'			=> time()
			//'root_id'               => $getreferral
			];
				
		$query = $this->db->insert('trp_vehicle_version', $data);

        if($query)
        {
          
            return true;
        }
        return false;
	}
//===================================== make_transport listing===========================================================
 public function make_ListCount()
   {
		
			$query = $this->db->count_all_results('trp_vehicle_make');
			return $query; 
		
    }	
	
	public function make_List($limit = 10, $start = 0) 
	{
           
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
				if ($currentUser == 'admin')
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('trp_vehicle_make');
					return $query;
				}
				else
				{  
					$table_name = 'trp_vehicle_make';
					$where_array = array('created_by' => $user_id);
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
					return $query;
				}

	}
	//---edit----
	public function edit_transport_make($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 
          $data = [
           
			'brands' 		    	=> $this->input->post('brands'),
          
			
			'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query = $this->db->where('id', $id)->update('trp_vehicle_make', $data);

        if ($query) {
            create_activity('Updated ' . $data['modified_by'] . 'Dashbord_alert'); //create an activity
            return true;
        }
        return false;
    }
//===================================== model_transport listing===========================================================	
	public function model_ListCount()
   {
		
			$query = $this->db->count_all_results('trp_vehicle_model');
			return $query; 
		
    }	
	
	public function model_List($limit = 10, $start = 0) 
	{
           
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
				if ($currentUser == 'admin')
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('trp_vehicle_model');
					return $query;
				}
				else
				{  
					$table_name = 'trp_vehicle_model';
					$where_array = array('created_by' => $user_id);
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
					return $query;
				}

	}
	//---edit----
	public function edit_transport_model($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 
          $data = [
           
			'make_id' 		    	=> $this->input->post('make_id'),
			'model' 		    	=> $this->input->post('model'),
          
			
			'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query = $this->db->where('id', $id)->update('trp_vehicle_model', $data);

        if ($query) {
            create_activity('Updated ' . $data['modified_by'] . 'Dashbord_alert'); //create an activity
            return true;
        }
        return false;
    }		
	
//===================================== type_transport listing===========================================================	
	public function type_ListCount()
   {
		
			$query = $this->db->count_all_results('trp_vehicle_version');
			return $query; 
		
    }	
	
	public function type_List($limit = 10, $start = 0) 
	{
           
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		
				if ($currentUser == 'admin')
				{
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('trp_vehicle_version');
					return $query;
				}
				else
				{  
					$table_name = 'trp_vehicle_version';
					$where_array = array('created_by' => $user_id);
					$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
					return $query;
				}

	}
	//---edit----
	public function edit_transport_type($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		 
          $data = [
           
			'make_id' 		    	=> $this->input->post('make_id'),
			'model_id' 		    	=> $this->input->post('model_id'),
           'version' 		    	=> $this->input->post('version'),
			
			'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query = $this->db->where('id', $id)->update('trp_vehicle_version', $data);

        if ($query) {
            create_activity('Updated ' . $data['modified_by'] . 'Dashbord_alert'); //create an activity
            return true;
        }
        return false;
    }		
	}//last brace required