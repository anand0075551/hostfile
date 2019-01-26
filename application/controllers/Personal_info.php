<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal_info extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Personal_info_model');

		check_auth(); //check is logged in.
	}
	
	
	 public function list_education()
	
	{
		
		
	 theme('list_education');
    }
	
	
	
    public function add_personal_info()
	
	{
     
		if ($this->input->post()) 
		{
            if ($this->input->post('submit') == 'per_details'){
				
				
				$this->form_validation->set_rules('aadhar_id', 'aadhar_id', 'required|trim');
				
				
				if ($this->form_validation->run() == true) {
					$result = $this->Personal_info_model->personal_details();
					if ($result) {
						$this->session->set_flashdata('successMsg', 'Personal Details Saved successfully');
						 redirect(base_url('Personal_info/list_personal_info'));
						
					}
					else{
						echo "error";
					}
				}
			}
			
			elseif ($this->input->post('submit') == 'business_info'){
				
				 $this->form_validation->set_rules('bank_details', 'bank_details', 'trim|required');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->business_details();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Business Details Saved Successfully');
						 redirect(base_url('Personal_info/list_business_info'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			
		 elseif ($this->input->post('submit') == 'utl1'){
				
				$this->form_validation->set_rules('account_number', 'account_number', 'trim|required');
				
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->utility1();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Utility1 Saved Successfully ');
						redirect(base_url('Personal_info/list_utilities1'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			
			
			
			
				 elseif ($this->input->post('submit') == 'utility2'){
				
				$this->form_validation->set_rules('pincode', 'pincode', 'trim|required');
				
				
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->utility2();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Utility2 Saved Successfully ');
						redirect(base_url('Personal_info/list_utilities2'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			
				elseif ($this->input->post('submit') == 'medical'){
				
				 $this->form_validation->set_rules('blood_group', 'blood_group', 'trim|required');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->medical();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Medical Details Saved Successfully');
						 redirect(base_url('Personal_info/list_medical'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			
				elseif ($this->input->post('submit') == 'education'){
				
				 $this->form_validation->set_rules('qualification', 'qualification', 'trim|required');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->education();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Education Details Saved Successfully');
						 redirect(base_url('Personal_info/list_education'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			
			elseif ($this->input->post('submit') == 'insurance'){
				
				 $this->form_validation->set_rules('insurance_type', 'insurance_type', 'trim|required');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->insurance();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Insurance Details Saved Successfully');
						 redirect(base_url('Personal_info/list_insurance'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			
				elseif ($this->input->post('submit') == 'hobbies'){
				
				 $this->form_validation->set_rules('hobbie', 'hobbie', 'trim|required');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->hobbies();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Hobbies Saved Successfully');
						 redirect(base_url('Personal_info/list_hobbies'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			
				elseif ($this->input->post('submit') == 'family_nominee'){
				
				 $this->form_validation->set_rules('marital_status', 'marital_status', 'trim|required');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->family_nominee();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Family Nominee Saved Successfully');
						 redirect(base_url('Personal_info/add_personal_info'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			
			elseif ($this->input->post('submit') == 'pets')
			{
				
				 $this->form_validation->set_rules('text3', 'text3', 'trim|required');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->pet();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Pet Details Saved Successfully');
						 redirect(base_url('Personal_info/add_personal_info'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			
			elseif ($this->input->post('submit') == 'alumni')
			{
				
				 $this->form_validation->set_rules('text5', 'text5', 'trim|required');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->alumniq();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Alumni Details Saved Successfully');
						 redirect(base_url('Personal_info/add_personal_info'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			
			
			elseif ($this->input->post('submit') == 'sports')
			{
				
				 $this->form_validation->set_rules('text1', 'text1', 'trim|required');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->sports();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Sports Details Saved Successfully');
						 redirect(base_url('Personal_info/add_personal_info'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			elseif ($this->input->post('submit') == 'arts')
			{
				
				 $this->form_validation->set_rules('text7', 'text7', 'trim|required');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->arts();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Art Details Saved Successfully');
						 redirect(base_url('Personal_info/add_personal_info'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			
			elseif ($this->input->post('submit') == 'favourite')
			{
				
				 $this->form_validation->set_rules('text11', 'text11', 'trim|required');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->favourite();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Your Favourite Places Saved Successfully');
						 redirect(base_url('Personal_info/add_personal_info'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
			
			elseif ($this->input->post('submit') == 'food_habits')
			{
				
				 $this->form_validation->set_rules('text14', 'text14', 'trim|required');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->food_habits();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Your Food Habits Saved Successfully');
						 redirect(base_url('Personal_info/add_personal_info'));
						//redirect(base_url('dashboard'));
					}
					else{
						echo "error";
					}
				}
			}
	
		} //
		theme('add_personal_info');
    }
	/***************************List Education*****************************/
	// View Education Details
	
	public function view_education_details($id) {
        //restricted this area, only for admin
      
        
        $data['education'] = $this->db->get_where('per_education', ['id' => $id]);
     
       
        theme('view_education_details', $data);
    }
	
	
	//listing Education
	
	 public function education_ListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Personal_info_model->educationListCount();


        $query = $this->Personal_info_model->educationList($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Personal_info/view_education_details/' . $r->id ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

				  $button .= '<a class="btn btn-warning editBtn" href="' . base_url('Personal_info/edit_education_details/' . $r->id ) . '" data-toggle="tooltip" title="edit">
						<i class="fa fa-edit"></i> </a>';
			 
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$created_by = $p->first_name.' '.$p->last_name;			 

	        $get_modified_by = $this->db->get_where('users', ['id'=>$r->modified_by]);
			foreach($get_modified_by->result() as $p);
			$modified_by = $p->first_name.' '.$p->last_name;	
		
		
                $data['data'][] = array(
                    $button,             
                    $r->id,
                    $r->type,
                    $r->qualification,
                    $r->certificate_no,
                    $r->occupation,
                    $r->occ_document,
                    date('d/m/Y h:i A', $r->created_at),
                    $created_by,
				
                  
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Assigned List', '', '', '', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
	
	
		//edit Education Details

	
public function edit_education_details($id){
		//restricted this area, only for admin
		permittedArea();
		 $data['education1'] = $this->db->get('per_education');
		//$data['education'] = singleDbTableRow($id,'per_education');
		$data['get_edu'] = $this->db->get('per_education');
		if($this->input->post())
		{
			if($this->input->post('submit') == 'edit_education'){
       
            $this->form_validation->set_rules('qualification', 'qualification', 'trim|required');	

			if($this->form_validation->run() == true)
			{
				$insert = $this->Personal_info_model->edit_education_details($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Education Details Updated Successfully...!!!');
					redirect(base_url('Personal_info/list_education'));
				}
			}
			}
				
	elseif ($this->input->post('submit') == 'copy_education'){
				
			   $this->form_validation->set_rules('qualification', 'qualification', 'trim|required');	

				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->copy_education($id);
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Education  Info Details Saved Successfully');
						 redirect(base_url('Personal_info/list_education'));
						
					}
					
				}
					
	
			}
			
		}
		theme('edit_education_details', $data);
	}
			
	
	/*********************************Personal Info Listing***************************************************************/
	
		
	public function view_personal_info($id) {
        //restricted this area, only for admin
      
        
        $data['personal'] = $this->db->get_where('per_details', ['id' => $id]);
     
       
        theme('view_personal_info', $data);
    }
	
	/****listing***/
	 public function list_personal_info()
	
	{
		
		
	 theme('list_personal_info');
    }
	
//listing Personal Info
	
	 public function personal_info_ListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Personal_info_model->personal_info_ListCount();


        $query = $this->Personal_info_model->personal_info_List($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Personal_info/view_personal_info/' . $r->id ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

				  $button .= '<a class="btn btn-warning editBtn" href="' . base_url('Personal_info/edit_personal_info/' . $r->id ) . '" data-toggle="tooltip" title="edit">
						<i class="fa fa-edit"></i> </a>';
			 
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$created_by = $p->first_name.' '.$p->last_name;			 

	    
                $data['data'][] = array(
                    $button,             
                    $r->type,
                    $r->first_name,
                    $r->mid_name,
                    $r->last_name,
                    $r->id_proof,
                    $r->aadhar_id,
					$r->pan_id,
                    $r->voter_id,
                    $r->drv_lnc_id,
                    $r->passport_no,
                    $r->dob,
                    $r->dob_proof,
					$r->age,
                    $r->email,
                    $r->sec_email,
                    $r->permanent_cntno,
                    $r->mob_no1,
                    $r-> mob_no2,
					$r-> alt_cnt_no,
                    $r-> native_place,
                    $r->resi_address,
                    $r->pincode,
                    $r->permanent_address,
                    $r->permanent_address_proof,
                    date('d/m/Y h:i A', $r->created_at),
                    $created_by
				
                  
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Assigned List', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
//edit personal info Details
		

public function edit_personal_info($id){
		//restricted this area, only for admin
		permittedArea();

		//$data['personal'] = singleDbTableRow($id,'per_details');
	    $data['personal1'] = $this->db->get('per_details');
		$data['get_edu'] = $this->db->get('per_details');
		if($this->input->post())
		{
			if($this->input->post('submit') == 'edit_personal_info'){
       	
		    $this->form_validation->set_rules('aadhar_id', 'aadhar_id', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Personal_info_model->edit_personal_info($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Personal Info Details Updated Successfully...!!!');
					redirect(base_url('Personal_info/list_personal_info'));
				}
			}
			}
				
	elseif ($this->input->post('submit') == 'copy_personal_info'){
				
			    $this->form_validation->set_rules('aadhar_id', 'aadhar_id', 'required|trim');
				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->copy_personal_info($id);
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Personal Info Details Saved Successfully');
						 redirect(base_url('Personal_info/list_personal_info'));
						
					}
					
				}
					
	
			}
			
		}
		theme('edit_personal_info', $data);
	}
			
	
	/*********************************Business Info Listing***************************************************************/
	
		
	public function view_business_info($id) {
        //restricted this area, only for admin
      
        
        $data['business'] = $this->db->get_where('per_business', ['id' => $id]);
     
       
        theme('view_business_info', $data);
    }
	
	/****listing***/
	 public function list_business_info()
	
	{
		
		
	 theme('list_business_info');
    }
	
//listing Business Info
	
	 public function business_info_ListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Personal_info_model->business_info_ListCount();


        $query = $this->Personal_info_model->business_info_List($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Personal_info/view_business_info/' . $r->id ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

				  $button .= '<a class="btn btn-warning editBtn" href="' . base_url('Personal_info/edit_business_info/' . $r->id ) . '" data-toggle="tooltip" title="edit">
						<i class="fa fa-edit"></i> </a>';
			 
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$created_by = $p->first_name.' '.$p->last_name;			 

	    
                $data['data'][] = array(
                    $button,             
                    $r->type,
                    $r->business_email,
                    $r->business_cntno,
                    $r->bank_details,
                    $r->shelter_details,
                    $r->renting_assets,
					$r->own_use_assets,
                  
                  
                    date('d/m/Y h:i A', $r->created_at),
                    $created_by
				
                  
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Assigned List', '', '', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
//edit business info Details
		



public function edit_business_info($id){
		//restricted this area, only for admin
		permittedArea();
		 $data['business1'] = $this->db->get('per_business');
		//$data['business'] = singleDbTableRow($id,'per_business');
		$data['get_edu'] = $this->db->get('per_business');
		if($this->input->post())
		{
			if($this->input->post('submit') == 'edit_business_info'){
       	
			 $this->form_validation->set_rules('bank_details', 'bank_details', 'trim|required');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Personal_info_model->edit_business_info($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Business Info Details Updated Successfully...!!!');
					redirect(base_url('Personal_info/list_business_info'));
				}
			}
			}
				
	elseif ($this->input->post('submit') == 'copy_business_info'){
				
				$this->form_validation->set_rules('bank_details', 'bank_details', 'trim|required');

				 
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Personal_info_model->copy_business_info($id);
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Business Info Details Saved Successfully');
						 redirect(base_url('Personal_info/list_business_info'));
						
					}
					
				}
					
	
			}
			
		}
		theme('edit_business_info', $data);
	}






}//last