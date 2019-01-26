<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashbord_alert extends CI_Controller
 {

	function __construct(){
		parent:: __construct();
		$this->load->model('Dashbord_alert_model');

		check_auth(); //check is logged in.
	}

	/**
	 * home page of settings
	 */
	 
	public function dashbord_alert_index() {

        theme('dashbord_alert_index');
    }
	
	
	

	public function add_dashbord_alert(){
		//restricted this area, only for admin
		permittedArea();
    	
		/*$data['title'] 					= 		 $this->db->get('title');
		$data['content'] 	            = 		 $this->db->get('content');
		$data['status']          	    =        $this->db->get('status');*/
	   
		if($this->input->post())
		{
			if($this->input->post('submit') != 'Dashbord') die('Error! sorry');

			
			$this->form_validation->set_rules('templet_name', 'templete name', 'required');
			$this->form_validation->set_rules('title', 'title', 'required');
			$this->form_validation->set_rules('content', 'content', 'required');
			$this->form_validation->set_rules('status', 'status', 'required');
			
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->Dashbord_alert_model->Dashbord_alert();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'New Dashbord Created Successfully!');
					redirect(base_url('Dashbord_alert/dashbord_alert_index'));
				}

			}
		}
		
		theme('add_dashbord_alert');
	}
	
	
    public function dashbord_alertListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        //$rolename = singleDbTableRow($user_id)->rolename;
		
        $queryCount = $this->Dashbord_alert_model->dashbord_alertListCount();


        $query = $this->Dashbord_alert_model->dashbord_alertList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Dashbord_alert/view_dashbord_alert/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				if ($currentUser == 'admin')
				{
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}		
				
                $data['data'][] = array(
                    $button,
					$r->templet_name,
					$r->color,
					$r->title,
                   
					$r->content,
					$r->status,
                   
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Dahbord_alert list', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
		
   //view DASHBORD aLERT

    public function view_dashbord_alert($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['Dashbord'] = $this->db->get_where('dashbord', ['id' => $id]);
        theme('view_dashbord_alert', $data);
    }
	
	 public function deleteAjax() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'dashbord');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} dashbord");
        //Now delete permanently
        $this->db->where('id', $id)->delete('dashbord');
        return true;
    }
	
	  public function edit_dashbord_alert($id) {
      
      // permittedArea();
		//$data['status'] = $this->db->get('status');

        $data['dashbord'] = singleDbTableRow($id, 'dashbord');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_transport')
                die('Error! sorry');
			
			
			$this->form_validation->set_rules('title', 'title', 'trim|required');
			$this->form_validation->set_rules('content', 'content', 'trim|required');
			$this->form_validation->set_rules('status', 'status', 'trim|required');
			
			  
			  

            if ($this->form_validation->run() == true) {
                $insert = $this->Dashbord_alert_model->edit_dashbord_alert($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Dashbord Alert Updated Successfully...!!!');
                    redirect(base_url('Dashbord_alert/Dashbord_alert_index'));
                }
            }
        }

        theme('edit_dashbord_alert', $data);
    }
	

	
   
}
