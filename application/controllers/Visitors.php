<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitors extends CI_Controller
 {

	function __construct(){
		parent:: __construct();
		$this->load->model('Visitors_model');

		check_auth(); //check is logged in.
	}

	/**
	 * home page of settings
	 */
	 
	public function Visitors_index() {

        theme('Visitors_index');
    }
	
		public function view_visitors_index_report() {

        theme('view_visitors_index_report');
    }
	
	
	
	
    public function VisitorsListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        //$rolename = singleDbTableRow($user_id)->rolename;
		
        $queryCount = $this->Visitors_model->VisitorsListCount();


        $query = $this->Visitors_model->VisitorsList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Visitors/view_Visitors/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				if ($currentUser == 'admin')
				{
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}		
				
                $data['data'][] = array(
                    $button,
					$r->name,
                   $r->lname,
					$r->email,
					$r->phone,
                   $r->message,
					$r->template_name,
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Dahbord_alert list', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
		
   //view DASHBORD aLERT

    public function view_Visitors($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['Dashbord'] = $this->db->get_where('website_visitors', ['id' => $id]);
        theme('view_Visitors', $data);
    }
	
	 public function deleteAjax() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'website_visitors');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} website_visitors");
        //Now delete permanently
        $this->db->where('id', $id)->delete('website_visitors');
        return true;
    }
	
	 public function edit_Visitors($id) {
      
      // permittedArea();
		//$data['status'] = $this->db->get('status');

        $data['website_visitors'] = singleDbTableRow($id, 'website_visitors');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_Visitors')
                die('Error! sorry');
			
			
			$this->form_validation->set_rules('name', 'name', 'trim|required');
			$this->form_validation->set_rules('lname', 'lname', 'trim');
			$this->form_validation->set_rules('email', 'email', 'trim|required');
			$this->form_validation->set_rules('phone', 'phone', 'trim|required');
			$this->form_validation->set_rules('message', 'message', 'trim|required');
			//$this->form_validation->set_rules('template_name', 'template_name', 'trim|required');
			
			  
			  

            if ($this->form_validation->run() == true) {
                $insert = $this->Visitors_model->edit_Visitors($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Visitors Updated Successfully...!!!');
                    redirect(base_url('Visitors/Visitors_index'));
                }
            }
        }

        theme('edit_Visitors', $data);
    }

/***************************************searching***********************************/


  public function visitors_search_ListJson() {
        
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
		
		$template_name = $_POST['template_name'];

		$sf_time       = $_POST['sf_time'];
		$st_time       = $_POST['st_time'];
				$limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		
        $queryCount = $this->Visitors_model->search_visitors_listCount($template_name,$sf_time,$st_time);


        $query = $this->Visitors_model->search_visitors_list($limit, $start,$template_name,$sf_time,$st_time);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {

			
			
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Visitors/view_Visitors/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						
							$data['data'][] = array(
				$button,
				$r->name,
				$r->lname,
				$r->email,
				$r->phone,
				$r->message,
				$r->template_name,
				$r->created_at,
				$r->modified_by,
				$r->modified_at
		
			
			
			

				);
		}
}
		else{
			$data['data'][] = array(
				'Records are not Available' , '', '','', '','','','','',''
			);
		
		}
		echo json_encode($data);
	
   
}
 }