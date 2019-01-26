<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pincodes extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Pincodes_model');

		check_auth(); //check is logged in.
	}

	

 public function view_pincode_report($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['pincode'] = $this->db->get_where('pincode', ['id' => $id]);
        theme('view_pincode_report', $data);
    }
	
	public function pincodes_report_list()
	{
		$data['country'] = $this->db->group_by('state')->get('pincode');
		theme('pincodes_report_list', $data);
	}
	
	
	// add pincode form_validation-
	
	 public function add_pincode() {
//restricted this area, only for admin
//permittedArea();
        $data['country'] = $this->db->group_by('country')->get('pincode');
        $data['location'] = $this->db->get('location_id');
        $data['business_name'] = $this->db->get('business_groups');
        $data['pincode'] = $this->db->group_by('pincode')->where('state', 'KARNATAKA')->get('pincode');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_pincode')
                die('Error! sorry');

            $this->form_validation->set_rules('country', 'Country ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('state', 'State ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('postal_region', 'Postal Region ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('postal_division', 'Postal Division ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('district', 'District ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('taluk', 'Taluk ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('location', 'Location ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('pincode', 'Pincode ', 'required|trim|strtoupper');




            if ($this->form_validation->run() == true) {
                $insert = $this->Pincodes_model->add_pincode();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Pincode Created Successfully');
                    redirect(base_url('Pincodes/pincodes_report_list'));
                } else {
                   $this->session->set_flashdata('errorMsg', 'Please Enter Valid Details');
                    redirect(base_url('Pincodes/add_pincode'));
                }
            }
        }


        theme('add_pincode', $data);
    }
	
	//
	// copy function
	
	
	 public function copy_pincodes($id) {
//restricted this area, only for admin
//permittedArea();
        $data['country'] = $this->db->get('pincode');
        $data['location'] = $this->db->get('location_id');
        $data['business_name'] = $this->db->get('business_groups');
        $data['pincode'] = $this->db->group_by('pincode')->where('state', 'KARNATAKA')->get('pincode');
		$data['pincodes'] = singleDbTableRow($id,'pincode');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'coppy_pincode')
                die('Error! sorry');

            $this->form_validation->set_rules('country', 'Country ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('state', 'State ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('postal_region', 'Postal Region ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('postal_division', 'Postal Division ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('district', 'District ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('taluk', 'Taluk ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('location', 'Location ', 'required|trim|strtoupper');
            $this->form_validation->set_rules('pincode', 'Pincode ', 'required|trim|strtoupper');




            if ($this->form_validation->run() == true) {
                $insert = $this->Pincodes_model->copy_pincodes();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Pincode Created Successfully');
                    redirect(base_url('Pincodes/pincodes_report_list'));
                } else {
                    $this->session->set_flashdata('errorMsg', 'Please Enter Valid Details');
                    redirect(base_url('Pincodes/copy_pincodes'));
                }
            }
        }


        theme('copy_pincodes', $data);
    }
	//
	
	
	
	
public function Pincodes_search_ListJson()
	{
	
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$pincode = $_POST['pincode'];
		$location_id = $_POST['location_id'];
		$taluk = $_POST['taluk'];
		$district = $_POST['district'];
		$state = $_POST['state'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');


		$queryCount = $this->Pincodes_model->search_pincodes_ListCount($pincode,$location_id,$taluk,$district,$state,$sf_time,$st_time);
		

		$query = $this->Pincodes_model->search_pincode_List($limit, $start,$pincode,$location_id,$taluk,$district,$state,$sf_time,$st_time);
		
		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
	if($query -> num_rows() > 0) 
	{
		foreach($query->result() as $r){
		  
				
			$query2 = $this->db->get_where('users', ['id' => $r->created_by]);

					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$created_by =  $row2->first_name.' '.$row2->last_name;
					}
					} else {
					$created_by =  " ";
					}
			$query3 = $this->db->get_where('users', ['id' => $r->modified_by]);

					if ($query3->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$modified_by =  $row2->first_name.' '.$row2->last_name;
					}
					} else {
					$modified_by =  " ";
					}
              
			   $button = '';
                $button.= '<a class="btn btn-primary editBtn" href="' . base_url('Pincodes/view_pincode_report/'.$r->id) . '" data-toggle="tooltip" title="View">
					<i class="fa fa-eye"></i> </a>';
					
					$button.= '<a class="btn btn-primary editBtn" href="' . base_url('Pincodes/copy_pincodes/'.$r->id) . '" data-toggle="tooltip" title="View">
					<i class="fa fa-copy"></i> </a>';
					
					
				 $data['data'][] = array(
					$button,
					$r->id,
					$r->pincode,
				    $r->location,
					$r->taluk,
					$r->district,
					$r->postal_division,
					$r->postal_region,
					$r->state,
					$r->country,
					date('d-m-Y H:i:s', $r->created_at), 
					$created_by,					
					date('d-m-Y H:i:s', $r->modified_at), 
					$modified_by
					
			);
		}
	}
		else{
			$data['data'][] = array(
				'No Pincode List Available' , '', '','', '','','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}

	 public function get_district()
     {
         $state=$_POST['state'];
        
         $query = $this->Pincodes_model->district($state);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->district."'>".$r->district."</option>";
         }

     }
	 
	      public function get_taluk()
     {
         $district=$_POST['district'];
        
         $query = $this->Pincodes_model->get_taluk($district);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->taluk."'>".$r->taluk."</option>";
         }

     }
	 
    public function get_location_id()
     {
         $district=$_POST['taluk'];
        
         $query = $this->Pincodes_model->location($district);
         echo "<option value=''>-Select-</option>";
		 
         foreach($query->result() as $r)
         {
              echo "<option value='".$r->location."'>".$r->location."--".$r->pincode."</option>";
         }

     }
	  
	 
	  public function get_pincode()
     {
         $location=$_POST['taluk'];
        
         $query = $this->Pincodes_model->pincode($location);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->pincode."'>".$r->pincode."</option>";
         }

     }
	
}