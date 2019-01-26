<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax_slab extends CI_Controller
 {

	function __construct(){
		parent:: __construct();
		$this->load->model('Tax_slab_model');

		check_auth(); //check is logged in.
	}

	/**
	 * home page of settings
	 */
	 
	public function tax_slab_index() {

        theme('tax_slab_index');
    }
	
	
	

	public function add_tax_slab(){
		//restricted this area, only for admin
		permittedArea();
    	
		/*$data['title'] 					= 		 $this->db->get('title');
		$data['content'] 	            = 		 $this->db->get('content');
		$data['status']          	    =        $this->db->get('status');*/
	   
		if($this->input->post())
		{
			if($this->input->post('submit') != 'Tax') die('Error! sorry');

			
			$this->form_validation->set_rules('tax_id', 'tax_id', 'required');
			$this->form_validation->set_rules('business', 'business', 'required');
			$this->form_validation->set_rules('tax_name', 'tax_name', 'required');
			$this->form_validation->set_rules('value', 'value', 'required');
			$this->form_validation->set_rules('sart_date', 'sart_date', 'required');
			$this->form_validation->set_rules('end_date', 'end_date', 'required');
			
			
			
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->Tax_slab_model->Tax_slab();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', ' Tax Successfully!');
					redirect(base_url('Tax_slab/tax_slab_index'));
				}

			}
		}
		
		theme('add_tax_slab');
	}
	
	
    public function tax_slabListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        //$rolename = singleDbTableRow($user_id)->rolename;
		
        $queryCount = $this->Tax_slab_model->tax_slabListCount();


        $query = $this->Tax_slab_model->tax_slabList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		
		
		foreach($query->result() as $r){
			$activeStatus = $r->active;
			//Status Button
			switch($activeStatus){
				case 0:
					$statusBtn = '<small class="label label-default"> Pending </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Approve" value="1">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
				case 1 :
					$statusBtn = '<small class="label label-success"> Active </small>';
					$blockUnblockBtn = '<button class="btn btn-warning blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Block" value="2">
						<i class="fa fa-lock"></i> </button>';
					break;
				case 2 :
					$statusBtn = '<small class="label label-danger"> Blocked </small>';
					$blockUnblockBtn = '<button class="btn btn-success blockUnblock" id="'.$r->id.'" data-toggle="tooltip" title="Unblock" value="1">
						<i class="fa fa-unlock-alt"></i> </button>';
					break;
			}
      

				
                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Tax_slab/view_tax_slab/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				if ($currentUser == 'admin')
				{
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}
              	$button .= $blockUnblockBtn;
				
				//----------------------------------------------------------
				
				 $get_tax_slab = $this->db->get_where('tax_id', ['id'=>$r->tax_id]);
					foreach($get_tax_slab->result() as $uu);
			     $tax_id = $uu->tax_idname; 
				 
				
				 
				 $query2 = $this->db->get_where('business_groups', ['id' => $r->business]);

					if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
					$business =  $row2->business_name;
					}
					} else {
					$business =  " ";
					} 
				
                $data['data'][] = array(
                    $button,
					$tax_id,
					$business,
					$r->tax_name,
					$r->value,
					$r->start_date,
					$r->end_date
					
                );
     
        }
        echo json_encode($data);
    }
	
		
   //view DASHBORD aLERT

    public function view_tax_slab($id) {
      
        $data['Tax'] = $this->db->get_where('tax_slabs', ['id' => $id]);
        theme('view_tax_slab', $data);
    }
	
	 public function deleteAjax() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'tax_slabs');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} tax_slabs");
        //Now delete permanently
        $this->db->where('id', $id)->delete('tax_slabs');
        return true;
    }
	
public function edit_tax_slab($id) {
      
      // permittedArea();
		//$data['status'] = $this->db->get('status');

        $data['tax_slabs'] = singleDbTableRow($id,'tax_slabs');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_transport')
                die('Error! sorry');
			
			
		    $this->form_validation->set_rules('tax_id', 'tax_id', 'trim|required'); 
			$this->form_validation->set_rules('business', 'business', 'trim|required'); 
			$this->form_validation->set_rules('tax_name', 'tax_name', 'trim|required');
			$this->form_validation->set_rules('value', 'value', 'trim|required');
			$this->form_validation->set_rules('sart_date', 'sart_date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'end_date', 'trim|required');
		
			
			
			  
			  

            if ($this->form_validation->run() == true) {
                $insert = $this->Tax_slab_model->edit_tax_slab($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Tax Updated Successfully...!!!');
                    redirect(base_url('Tax_slab/tax_slab_index'));
                }
            }
        }

        theme('edit_tax_slab', $data);
    }
	
  /* Set block or unblock through this api */
	 

public function setBlockUnblock(){
		$id = $this->input->post('id');
		$buttonValue = $this->input->post('buttonValue');
		$status = $this->input->post('status');

		//get deleted user info
		$userInfo = singleDbTableRow($id);
		$fullName = user_full_name($userInfo);
		// add a activity
		create_activity($status." {$fullName} from Agent");
		//Now delete permanently

		$this->db->where('id', $id)->update('tax_slabs', ['active' => $buttonValue]);
		return true;
	}
	
	
/*========================================Tax_idname===============================------------------ */

public function tax_idname_index() 
	{

        theme('tax_idname_index');
    }
	
	
	

	public function add_tax_idname()
	{
		//restricted this area, only for admin
		permittedArea();
    	
		/*$data['title'] 					= 		 $this->db->get('title');
		$data['content'] 	            = 		 $this->db->get('content');
		$data['status']          	    =        $this->db->get('status');*/
	   
		if($this->input->post())
		{
			if($this->input->post('submit') != 'Tax') die('Error! sorry');

			
			$this->form_validation->set_rules('tax_idname', 'tax_idname', 'required');
			
			
			
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->Tax_slab_model->Tax_idname();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', ' Tax Successfully!');
					redirect(base_url('Tax_slab/tax_idname_index'));
				}

			}
		}
		
		theme('add_tax_idname');
	}
	
	
    public function tax_idnameListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        //$rolename = singleDbTableRow($user_id)->rolename;
		
        $queryCount = $this->Tax_slab_model->tax_idnameListCount();


        $query = $this->Tax_slab_model->tax_idnameList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Tax_slab/view_tax_idname/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				if ($currentUser == 'admin')
				{
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}		
				
                $data['data'][] = array(
                    $button,
					$r->tax_idname,
                
                   
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Tax_idname list', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
		
   //view  aLERT

    public function view_tax_idname($id) 
	{
        //restricted this area, only for admin
        //permittedArea();
        $data['Tax'] = $this->db->get_where('tax_id', ['id' => $id]);
        theme('view_tax_idname', $data);
    }
	
	 public function deleteAjax2() 
	 {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'tax_id');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} tax_id");
        //Now delete permanently
        $this->db->where('id', $id)->delete('tax_id');
        return true;
    }
	
	  public function edit_tax_idname($id) 
	  {
      
      // permittedArea();
		//$data['status'] = $this->db->get('status');

        $data['tax_id'] = singleDbTableRow($id, 'tax_id');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_transport')
                die('Error! sorry');
			
			
			$this->form_validation->set_rules('tax_idname', 'tax_idname', 'trim|required');
		
			
			
			  
			  

            if ($this->form_validation->run() == true) {
                $insert = $this->Tax_slab_model->edit_tax_idname($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Tax Updated Successfully...!!!');
                    redirect(base_url('Tax_slab/tax_idname_index'));
                }
            }
        }

        theme('edit_tax_idname', $data);
    }
	
   
}
