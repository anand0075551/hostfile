<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Machinaries extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Machinaries_model');

        check_auth(); //check is logged in.
    }

    public function machinaries_Index() {
        theme('machinaries_Index');
    }

    // *** Adding Machinaries *** //

    public function add_machinaries() {

        //restricted this area, only for admin
       // permittedArea();
        //$data['role']            =        $this->db->get('role');


        $data['transport_module'] = $this->db->get('trp_vehicles');


        if ($this->input->post()) {
            if ($this->input->post('submit') != 'machinaries')
                die('Error! sorry');
            $this->form_validation->set_rules('type', 'type', 'required', 'required');
            $this->form_validation->set_rules('name', 'name', 'required', 'required');
            $this->form_validation->set_rules('bedin_date', 'bedin_date', 'required');
            $this->form_validation->set_rules('end_date', 'end_date', 'required');
            $this->form_validation->set_rules('current_status', 'current_status', 'required');
            $this->form_validation->set_rules('hire_type', 'hire_type', 'required');
            $this->form_validation->set_rules('vehicle_id', 'vehicle_id', 'required');

            if ($this->form_validation->run() == true) {
                $insert = $this->Machinaries_model->add_machinaries();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'New Machinaries Added Successfully!');
                    redirect(base_url('Machinaries/machinaries_Index'));
                }
            }
        }

        theme('add_machinaries', $data);
    }
	
	
	    public function copy_machinaries($id) {

        //restricted this area, only for admin
       // permittedArea();
        //$data['role']            =        $this->db->get('role');

		$data['first_name'] = $this->db->get('users');
        $data['role'] = singleDbTableRow($id, 'role');
        $data['machinaries'] = singleDbTableRow($id, 'machinaries');
        $data['transport_module'] = $this->db->get('trp_vehicles');


        if ($this->input->post()) {
            if ($this->input->post('submit') != 'copy_machinaries')
                die('Error! sorry');
            $this->form_validation->set_rules('type', 'type', 'required', 'required');
            $this->form_validation->set_rules('name', 'name', 'required', 'required');
            $this->form_validation->set_rules('bedin_date', 'bedin_date', 'required');
            $this->form_validation->set_rules('end_date', 'end_date', 'required');
            $this->form_validation->set_rules('current_status', 'current_status', 'required');
            $this->form_validation->set_rules('hire_type', 'hire_type', 'required');
            $this->form_validation->set_rules('vehicle_id', 'vehicle_id', 'required');

            if ($this->form_validation->run() == true) {
                $insert = $this->Machinaries_model->copy_machinaries();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'New Machinaries Added Successfully!');
                    redirect(base_url('Machinaries/machinaries_Index'));
                }
            }
        }

        theme('copy_machinaries', $data);
    }
	

    public function machinariesListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');


        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;

        $queryCount = $this->Machinaries_model->machinariesListCount();


        $query = $this->Machinaries_model->machinariesList($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {

				



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-info editBtn" href="' . base_url('Machinaries/view_machinaries/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
				$button .= '<a class="btn btn-warning" href="' . base_url('Machinaries/copy_machinaries/' . $r->id) . '" data-toggle="tooltip" title="copy">
						<i class="fa fa-align-justify"></i> copy</a>';
						
						
						
				$user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;
                //if ($rolename == '11' || $rolename == '36' ) { 


                if ($currentUser == 'admin') {
                    $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
							<i class="fa fa-trash"></i> </a>';
                }
            


                $data['data'][] = array(
                    $button,
                    $r->type,
                    $r->name,
                    $r->bedin_date,
                    $r->end_date,
                    $r->current_status,
                    $r->hire_type,
                    $r->vehicle_id
					
                );
            }
        } else {
            $data['data'][] = array(
                'no data', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }

    public function view_machinaries($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['machinaries'] = $this->db->get_where('machinaries', ['id' => $id]);
        theme('view_machinaries', $data);
    }

    public function deleteAjax() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'machinaries');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} machinaries");
        //Now delete permanently
        $this->db->where('id', $id)->delete('machinaries');
        return true;
    }

    public function edit_machinaries($id) {


        // permittedArea();
        //$data['rolename'] = $this->db->get('role');
        $data['first_name'] = $this->db->get('users');
        $data['role'] = singleDbTableRow($id, 'role');
        $data['machinaries'] = singleDbTableRow($id, 'machinaries');
        $data['transport_module'] = $this->db->get('trp_vehicles');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_machinaries')
                die('Error! sorry');

            $this->form_validation->set_rules('type', 'type', 'required', 'required');
            $this->form_validation->set_rules('name', 'name', 'required', 'required');
            $this->form_validation->set_rules('bedin_date', 'bedin_date', 'required');
            $this->form_validation->set_rules('end_date', 'end_date', 'required');
            $this->form_validation->set_rules('current_status', 'current_status', 'required');
            $this->form_validation->set_rules('hire_type', 'hire_type', 'required');
            $this->form_validation->set_rules('vehicle_id', 'vehicle_id', 'required');


            if ($this->form_validation->run() == true) {
                $insert = $this->Machinaries_model->edit_machinaries($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Machinaries  Updated Successfully...!!!');
                    redirect(base_url('Machinaries/machinaries_Index'));
                }
            }
        }

        theme('edit_machinaries', $data);
    }
/********************************************************Reporting***********************************************************************/
//searching


 public function machinaries_report() {
        theme('machinaries_report');
    }
public function machinaries_search_ListJson(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = singleDbTableRow($user_id)->rolename;
        $currentUser   = singleDbTableRow($user_id)->role;

        $name = $_POST['name'];
		$vehicle_id = $_POST['vehicle_id'];

        $sf_time = $_POST['sf_time'];
        $st_time = $_POST['st_time'];



        $limit = $this->input->post('length');
        $start = $this->input->post('start');


        $queryCount = $this->Machinaries_model->search_machinaries_listCount($name,$vehicle_id,$sf_time,$st_time);


        $query = $this->Machinaries_model->search_machinaries_list($limit, $start ,$name,$vehicle_id,$sf_time,$st_time);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

    if($query -> num_rows() > 0)
      {
        foreach($query->result() as $r){

			

                           


									

            //Action Button
            $button = '';
           $button .= '<a class="btn btn-info editBtn" href="' . base_url('Machinaries/view_machinaries/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
				$button .= '<a class="btn btn-warning" href="' . base_url('Machinaries/copy_machinaries/' . $r->id) . '" data-toggle="tooltip" title="copy">
						<i class="fa fa-align-justify"></i> copy</a>';
						
						
				 $user_info = $this->session->userdata('logged_user');
                $user_id = $user_info['user_id'];
                $currentUser = singleDbTableRow($user_id)->role;
                $rolename = singleDbTableRow($user_id)->rolename;
                $email = singleDbTableRow($user_id)->email;
                //if ($rolename == '11' || $rolename == '36' ) { 


                if ($currentUser == 'admin') {
                    $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
							<i class="fa fa-trash"></i> </a>';
                }

            $data['data'][] = array(
                $button,

                $r->type,
                $r->name,
                $r->bedin_date,
                $r->end_date,
                $r->current_status,
                $r->hire_type,
                
                $r->vehicle_id
                 


            );
        }
}
        else{
            $data['data'][] = array(
                'no data' , '', '','', '','','',''
            );

        }
        echo json_encode($data);

    }

}
