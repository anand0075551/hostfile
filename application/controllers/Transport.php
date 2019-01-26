<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transport extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('transport_model');

		check_auth(); //check is logged in.
	}

	/**
	 * home page of settings
	 */
	 
	public function transport_index() {

        theme('transport_index');
    }
	
	public function all_vehicletypes() {

        theme('all_vehicletypes');
    }
	

	public function add_transportmodule(){
		//restricted this area, only for admin
		
		$where_array1 = array('parent_id' => '0');
		$data['category_name'] = $this->db->where($where_array1)->get('trp_vehicle_types');
		//permittedArea();
		
		
		//$data['category_name']     	=        	 $this->db->get('trp_vehicle_types');
		$data['add_vehicle_brand']     	=        $this->db->get('trp_vehicle_make');
		$data['state'] 					= 		 $this->db->get('trp_states');
		$data['add_vehicle']          	=        $this->db->get('trp_vehicles_reg');
	    $data['add_capacityperson']   	=        $this->db->get('trp_capicity_person');
		$data['add_capacityload']     	=        $this->db->get('trp_capicity_load');
		if($this->input->post())
		{
			if($this->input->post('submit') != 'vechileid') die('Error! sorry');
		
	
			$this->form_validation->set_rules('address_details', 'address_details');
			$this->form_validation->set_rules('model_no', 'model no');
			$this->form_validation->set_rules('fule_type', 'fule type');
			$this->form_validation->set_rules('reg_date', 'reg date','required');
			$this->form_validation->set_rules('owner_name', 'owner name','required');
			$this->form_validation->set_rules('engine_no', 'engine_no','required');
			$this->form_validation->set_rules('insurence_startdate', 'insurence_startdate');
			$this->form_validation->set_rules('insurece_enddate', 'insurece_enddate');
			$this->form_validation->set_rules('capacityperson', 'Capacity_person', 'required');
			$this->form_validation->set_rules('cap_load', 'load', 'required');
			$this->form_validation->set_rules('yrmaning', 'Year_manufacturing', 'required');			
			$this->form_validation->set_rules('rc_book', 'RC book', 'required');			
			$this->form_validation->set_rules('tyre_cond', 'Tyre Conditions', 'required');			
			$this->form_validation->set_rules('engine_cond', 'Engine Conditions', 'required');		
			$this->form_validation->set_rules('insurence_Policy', 'insurence Policy ', 'required');		
			$this->form_validation->set_rules('pollution_certifi', 'pollution certifi  ', 'required');		
			
						
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->transport_model->transport();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Vehicle Created Successfully!');
					redirect(base_url('transport/transport_index'));
				}

			}
		}
		
		theme('add_transportmodule',$data);
	}

	
    public function transportListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        //$rolename = singleDbTableRow($user_id)->rolename;
		
        $queryCount = $this->transport_model->transportListCount();


        $query = $this->transport_model->transportList($limit,$start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('transport/view_transportmodule/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				if ($currentUser == 'admin')
				{
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}		
						
			/*	$get_pay_type1 = $this->db->get_where('trp_vehicles_reg', ['id'=>$r->type]);
					foreach($get_pay_type1->result() as $p);
				$type = $p->vehicle_type;
				*/
				$get_pay_type = $this->db->get_where('trp_capicity_load', ['id'=>$r->cap_load]);
					foreach($get_pay_type->result() as $p);
				$cap_load = $p->capacityload;
	
                $data['data'][] = array(
                    $button,
					$r->reg_num,
             
					$r->insurence_startdate,
					$r->insurece_enddate,
                    $cap_load,
                    $r->yrmaning,
                    $r->tyre_cond,
                    $r->engine_cond
                );
            }
        } else {
            $data['data'][] = array(
                'You have no data', '', '', '', '','','',''
            );
        }
        echo json_encode($data);
    }
	
   //view transportmodule

    public function view_transportmodule($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['transport_Details'] = $this->db->get_where('trp_vehicles', ['id' => $id]);
        theme('view_transportmodule', $data);
    }

    public function transport_list() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'trp_vehicles');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} trp_vehicles");
        //Now delete permanently
        $this->db->where('id', $id)->delete('trp_vehicles');
        return true;
    }

  


  public function edit_transport($id) {
      
		permittedArea();
		$where_array1 = array('parent_id' => '0');
		$data['category_name'] = $this->db->where($where_array1)->get('trp_vehicle_types');
		//$data['add_vehicle_type']     	=        $this->db->group_by('main_category')->get('trp_vehicle_types');
		$data['add_vehicle_brand']     	=        $this->db->get('trp_vehicle_make');
		$data['state'] 					= 		 $this->db->get('trp_states');
		$data['add_vehicle']          	=        $this->db->get('trp_vehicles_reg');
	    $data['add_capacityperson']   	=        $this->db->get('trp_capicity_person');
		$data['add_capacityload']     	=        $this->db->get('trp_capicity_load');

		$data['transport_module'] = singleDbTableRow($id, 'trp_vehicles');

        if ($this->input->post()) {
            if ($this->input->post('submit') == 'edit_transport')
                die('Error! sorry');
			
			$this->form_validation->set_rules('engine_cond', 'engine cond ', 'trim|required');
			$this->form_validation->set_rules('fule_type', 'fule type ', 'trim|required');
			  
			  

            if ($this->form_validation->run() == true) {
                $insert = $this->transport_model->edit_transport($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Transport Updated Successfully...!!!');
                    redirect(base_url('transport/transport_index'));
                }
            }
        }

        theme('edit_transport', $data);
    }
	
	//Add vehicle starts here
	
	public function vehicle_index()
	{
		theme('vehicle_index');
	}
	
	public function add_vehicletype()
	{
		//restricted this area, only for admin
		permittedArea();
    	
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'vechiletype') die('Error! sorry');

			$this->form_validation->set_rules('vehicle_type', 'Add vehicle type', 'required|trim');
						
			if($this->form_validation->run() == true)
			{
				$insert = $this->transport_model->add_vehicletype();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', ' Created Successfully!');
					redirect(base_url('transport/vehicle_index'));
				}

			}
		}
		
		theme('add_vehicletype');
	}	
	
    
    public function vehicleListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->transport_model->vehicleListCount();


        $query = $this->transport_model->vehicleList($limit,$start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
				
				 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('transport/view_vehical_type/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

                $data['data'][] = array(
                    $button,
                    $r->vehicle_type,
                );
            }
        } else {
            $data['data'][] = array(
                'You have no list', ''
            );
        }
        echo json_encode($data);
	}
	
	public function view_vehical_type($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['vehical_Details'] = $this->db->get_where('trp_vehicles_reg', ['id' => $id]);
        theme('view_vehical_type', $data);
    }
	
	 public function edit_vehical($id) {
      
      // permittedArea();
		//$data['status'] = $this->db->get('status');

        $data['add_vehicle'] = singleDbTableRow($id, 'trp_vehicles_reg');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_vehicle')
                die('Error! sorry');
			
			
			$this->form_validation->set_rules('vehicle_type', 'Add vehicle type', 'required|trim');
			

            if ($this->form_validation->run() == true) {
                $insert = $this->transport_model->edit_vehical($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Vehical Type  Updated Successfully...!!!');
                    redirect(base_url('transport/vehicle_index'));
                }
            }
        }

        theme('edit_vehical', $data);
    }
	
	
	 public function deletevehicletype() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'trp_vehicles_reg');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} trp_vehicles_reg");
        //Now delete permanently
        $this->db->where('id', $id)->delete('trp_vehicles_reg');
        return true;
    }
	
	
	//Add capacity persons here
	
	public function capacityperson_index()
	{
		theme('capacityperson_index');
	}
	
	public function add_capacityperson()
	{
		//restricted this area, only for admin
		permittedArea();
    	
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'capacityperson') die('Error! sorry');

			$this->form_validation->set_rules('capacityperson', 'Add capacity person', 'required|trim');
						
			if($this->form_validation->run() == true)
			{
				$insert = $this->transport_model->add_capacityperson();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'New Created Successfully!');
					redirect(base_url('transport/capacityperson_index'));
				}

			}
		}
		
		theme('add_capacityperson');
	}	
	
    
    public function capacitypersonListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->transport_model->capacitypersonListCount();


        $query = $this->transport_model->capacitypersonList($limit,$start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
				
				 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('transport/view_person_capacity/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				
				
                $data['data'][] = array(
                    $button,
                    $r->capacityperson
					
                );
            }
        } else {
            $data['data'][] = array(
                'You have no list', ''
            );
        }
        echo json_encode($data);
	}
	
	 
	 public function view_person_capacity($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['person_Details'] = $this->db->get_where('trp_capicity_person', ['id' => $id]);
        theme('view_person_capacity', $data);
    }
	
	 public function edit_person_capacity($id) {
      
      // permittedArea();
		//$data['type'] = $this->db->get('add_vehicle');

        $data['add_capacityperson'] = singleDbTableRow($id, 'trp_capicity_person');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_person')
                die('Error! sorry');
			
			
		$this->form_validation->set_rules('capacityperson', 'Add capacity person', 'required|trim');
			

            if ($this->form_validation->run() == true) {
                $insert = $this->transport_model->edit_person_capacity($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Vehical Type  Updated Successfully...!!!');
                    redirect(base_url('transport/capacityperson_index'));
                }
            }
        }

        theme('edit_person_capacity', $data);
    }
	
	
	 public function deletecapacityperson() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'trp_capicity_person');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} trp_capicity_person");
        //Now delete permanently
        $this->db->where('id', $id)->delete('trp_capicity_person');
        return true;
    }
	
	// capacityload starts here
	
		public function capacityload_index()
	{
		theme('capacityload_index');
	}
	
	public function add_capacityload()
	{
		//restricted this area, only for admin
		permittedArea();
    	
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'capacityload') die('Error! sorry');
			//if($this->input->post('submit') != 'capcityload') die('Error! sorry');
			$this->form_validation->set_rules('capacityload', ' Capacity Load', 'required|trim');
						
			if($this->form_validation->run() == true)
			{
				$insert = $this->transport_model->add_capacityload();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'New Capacity Added Successfully!');
					redirect(base_url('transport/capacityload_index'));
				}

			}
		}
		
		theme('add_capacityload');
	}	
	
	
	
    
    public function capacityloadListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->transport_model->capacityloadListCount();


        $query = $this->transport_model->capacityloadList($limit,$start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
				 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('transport/view_capacity_load/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

                $data['data'][] = array(
                    $button,
                    $r->capacityload
					
                );
            }
        } else {
            $data['data'][] = array(
                'You have no transport list', ''
            );
        }
        echo json_encode($data);
	}
	
	 public function view_capacity_load($id) {
        //restricted this area, only for admin
        permittedArea();
        $data['capacityload_Details'] = $this->db->get_where('trp_capicity_load', ['id' => $id]);
        theme('view_capacity_load', $data);
    }
	
	 public function edit_capacityload($id) {
      
       permittedArea();
		//$data['status'] = $this->db->get('status');

        $data['add_capacityload'] = singleDbTableRow($id, 'trp_capicity_load');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_capacityload')
                die('Error! sorry');
			
			
		$this->form_validation->set_rules('capacityload', ' Capacity Load', 'required|trim');

            if ($this->form_validation->run() == true) {
                $insert = $this->transport_model->edit_capacityload($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Capacity Load Updated Successfully...!!!');
                    redirect(base_url('transport/capacityload_index'));
                }
            }
        }

        theme('edit_capacityload', $data);
    }
	
	
	 public function deletecapacityload() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'trp_capicity_load');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} trp_capicity_load");
        //Now delete permanently
        $this->db->where('id', $id)->delete('trp_capicity_load');
        return true;
    }
	
//--======================================== AMIT_---- Transport=================================================================--//
//-- add transport add_make----	

    public function add_make() {
        
		
		
		
		if ($this->input->post()) {
            if ($this->input->post('submit') == 'vehicle_make'){
				
				
				$this->form_validation->set_rules('brands', 'brands', 'required|trim');
				
				
				if ($this->form_validation->run() == true) {
					$result = $this->transport_model->vehicle_make();
					if ($result) {
						$this->session->set_flashdata('successMsg', 'message successfully sent');
						// redirect(base_url('transport/make_transport_index'));
						
					}
					else{
						echo "error";
					}
				}
			}
			
			elseif ($this->input->post('submit') == 'vehicles'){
				
				 $this->form_validation->set_rules('model', 'model', 'trim|required');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->transport_model->vehicles();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'message successfully sent');
						 //redirect(base_url('transport/model_transport_index'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			
		elseif ($this->input->post('submit') == 'vehicle_type'){
				
				$this->form_validation->set_rules('version', 'version', 'trim|required');
				
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->transport_model->vehicle_type();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'message successfully sent');
						//redirect(base_url('transport/types_transport_index'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			else{
				die('Error! sorry');
			}
		} 
		theme('add_make');
    }
	
	
	

  //===================listing jsn for make_transport ============================================================    

    public function make_transport_index() {

        theme('make_transport_index');
    }
	
	  

     public function make_ListJson() 
	{
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
		
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        //$rolename = singleDbTableRow($user_id)->rolename;
		
        $queryCount = $this->transport_model->make_ListCount();


        $query = $this->transport_model->make_List();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {

					$get_user = $this->db->get_where('users', ['id'=>$r->created_by]);
					foreach($get_user->result() as $uu);
			     $created_by = $uu->first_name. ' ' .$uu->last_name;  
				 
				 $get_user1 = $this->db->get_where('users', ['id'=>$r->modified_by]);
					foreach($get_user1->result() as $uu);
			     $modified_by = $uu->first_name. ' ' .$uu->last_name; 


                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Transport/view_transport_make/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				if ($currentUser == 'admin')
				{
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}		
				
                $data['data'][] = array(
                    $button,
					$r->brands,
					//date('d-m-Y', $r->created_at),
					$created_by,
					//date('d-m-Y', $r->modified_at),	
					$modified_by
					
                
                   
                );
            }
        } else {
            $data['data'][] = array(
                'You have no list', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	 //----view--------------- 
  public function view_transport_make($id) {
      
        $data['Tax'] = $this->db->get_where('trp_vehicle_make', ['id' => $id]);
        theme('view_transport_make', $data);
    }
    //----delete---------------
	
   public function deleteAjax2() 
	 {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'trp_vehicle_make');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} trp_vehicle_make");
        //Now delete permanently
        $this->db->where('id', $id)->delete('trp_vehicle_make');
        return true;
    }
//----edit-------------------------
  public function edit_transport_make($id) 
	  {
    
		 $data['make_transport_index'] = singleDbTableRow($id, 'trp_vehicle_make');
        //$data['make_transport_index'] = singleDbTableRow($id, 'trp_vehicle_make');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_transport')
                die('Error! sorry');
			
			
			$this->form_validation->set_rules('brands', 'brands', 'trim|required');
		
			
			
			  
			  

            if ($this->form_validation->run() == true) {
                $insert = $this->transport_model->edit_transport_make($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Tax Updated Successfully...!!!');
                   redirect(base_url('Transport/make_transport_index'));
                }
            }
        }

        theme('edit_transport_make', $data);
    }
	
	
	
//===================listing jsn for model_transport ============================================================ 	
  public function model_transport_index() {

        theme('model_transport_index');
    }
	
	  

     public function model_ListJson() 
	{
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
		
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        //$rolename = singleDbTableRow($user_id)->rolename;
		
        $queryCount = $this->transport_model->model_ListCount();


        $query = $this->transport_model->model_List();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {

				$get_user = $this->db->get_where('users', ['id'=>$r->created_by]);
					foreach($get_user->result() as $uu);
			     $created_by = $uu->first_name. ' ' .$uu->last_name;  
				 
				$get_user1 = $this->db->get_where('users', ['id'=>$r->modified_by]);
					foreach($get_user1->result() as $uu);
			     $modified_by = $uu->first_name. ' ' .$uu->last_name; 
				 
				
				 
                 $query2 = $this->db->get_where('trp_vehicle_make', ['id' => $r->make_id]);

					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$make_id =  $row2->brands;
					}
					} else {
					$make_id =  " ";
					} 

                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Transport/view_transport_model/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				if ($currentUser == 'admin')
				{
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}		
				
                $data['data'][] = array(
                    $button,
					$make_id,
					$r->model,
					date('d-m-Y', $r->created_at),
					$created_by,
					date('d-m-Y', $r->modified_at),	
					$modified_by,
					
                
                   
                );
            }
        } else {
            $data['data'][] = array(
                'You have no list', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	 //----view--------------- 
  public function view_transport_model($id) {
      
        $data['Tax'] = $this->db->get_where('trp_vehicle_model', ['id' => $id]);
        theme('view_transport_model', $data);
    }
    //----delete---------------
	
   public function deleteAjax3() 
	 {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'trp_vehicle_model');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} trp_vehicle_model");
        //Now delete permanently
        $this->db->where('id', $id)->delete('trp_vehicle_model');
        return true;
    }
//----edit-------------------------
  public function edit_transport_model($id) 
	  {
    

        $data['model_transport_index'] = singleDbTableRow($id, 'trp_vehicle_model');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_transport')
                die('Error! sorry');
			
			
			$this->form_validation->set_rules('make_id', 'make_id', 'trim|required');
		    $this->form_validation->set_rules('model', 'model', 'trim|required');
			
			
			  
			  

            if ($this->form_validation->run() == true) {
                $insert = $this->transport_model->edit_transport_model($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', ' Updated Successfully...!!!');
                    //redirect(base_url('Transport/model_transport_index'));
                }
            }
        }

        theme('edit_transport_model', $data);
    }
	
	
	
	
	
//===================listing jsn for types_transport ============================================================ 
 public function types_transport_index() {

        theme('types_transport_index');
    }
	
	  

     public function type_ListJson() 
	{
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
		
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        //$rolename = singleDbTableRow($user_id)->rolename;
		
        $queryCount = $this->transport_model->type_ListCount();


        $query = $this->transport_model->type_List();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {

			$get_user = $this->db->get_where('users', ['id'=>$r->created_by]);
					foreach($get_user->result() as $uu);
			     $created_by = $uu->first_name. ' ' .$uu->last_name;  
				 
			$get_user1 = $this->db->get_where('users', ['id'=>$r->modified_by]);
					foreach($get_user1->result() as $uu);
			     $modified_by = $uu->first_name. ' ' .$uu->last_name; 
				 
				
				 
            $query2 = $this->db->get_where('trp_vehicle_make', ['id' => $r->make_id]);

					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$make_id =  $row2->brands;
					}
					} else {
					$make_id =  " ";
					}
					
		 	$query3 = $this->db->get_where('trp_vehicle_model', ['id' => $r->model_id]);

					if ($query3->num_rows() > 0) {
					foreach ($query3->result() as $row2) {
					$model_id =  $row2->model;
					}
					} else {
					$model_id =  " ";
					} 		  
					
			

                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Transport/view_transport_type/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				if ($currentUser == 'admin')
				{
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}		
				
                $data['data'][] = array(
                    $button,
					$make_id,
					$model_id,
					$r->version,
					date('d-m-Y', $r->created_at),
					$created_by,
					date('d-m-Y', $r->modified_at),	
					$modified_by
			 
                );
            }
        } else {
            $data['data'][] = array(
                'You have no list', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
	}
		
	 //----view--------------- 
  public function view_transport_type($id) {
      
        $data['Tax'] = $this->db->get_where('trp_vehicle_version', ['id' => $id]);
        theme('view_transport_type', $data);
    }
    //----delete---------------
	
   public function deleteAjax4() 
	 {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'trp_vehicle_version');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} trp_vehicle_version");
        //Now delete permanently
        $this->db->where('id', $id)->delete('trp_vehicle_version');
        return true;
    }
//----edit-------------------------
  public function edit_transport_type($id) 
	  {
    

        $data['types_transport_index'] = singleDbTableRow($id, 'trp_vehicle_version');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_transport')
                die('Error! sorry');
			
			
			$this->form_validation->set_rules('make_id', 'make_id', 'trim|required');
		    $this->form_validation->set_rules('model_id', 'model_id', 'trim|required');
			 $this->form_validation->set_rules('version', 'version', 'trim|required');
			
			  
			  

            if ($this->form_validation->run() == true) {
                $insert = $this->transport_model->edit_transport_type($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', ' Updated Successfully...!!!');
                    redirect(base_url('Transport/types_transport_index'));
                }
            }
        }

        theme('edit_transport_type', $data);
    }
	
	
	   /* public function getsub() {
        $category_name = $_POST['category_name'];
        //   echo $country;
        $query = $this->transport_model->state($category_name);
        echo "<option value=''>-Select-</option>";
        foreach ($query->result() as $r) {
            echo "<option value='" . $r->id . "'>" . $r->category_type . "</option>";
        }
    }*/
	
	
	
    public function get_sub_category() {

        $id = $_POST['parent_id'];
        $query =$this->db->get_where('trp_vehicle_types', ['parent_id' => $id]);
        $data = '<option value=""> Choose option </option>';
        foreach ($query->result() as $st) {
            $data .= "<option value=" . $st->id . ">" . $st->category_name . "</option>";
        }
        echo $data;
    }
	
	
	
		public function getmodel() {
        $brands = $_POST['brands'];
        //   echo $brands;
        $query = $this->transport_model->getmodel($brands);
        echo "<option value=''>-Select-</option>";
        foreach ($query->result() as $r) {
            echo "<option value='" . $r->id . "'>" . $r->model . "</option>";
        }
    }
	
	
		public function getversion() {
        $model = $_POST['model'];
        //   echo $brands;
        $query = $this->transport_model->getversion($model);
        echo "<option value=''>-Select-</option>";
        foreach ($query->result() as $r) {
            echo "<option value='" . $r->id . "'>" . $r->version . "</option>";
        }
    }
	
}

