<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Generate_doc extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Generate_doc_model');

        check_auth(); //check is logged in.
    }

    /**
     * home page of settings
     */
    public function generated_doc_list() {

        theme('generated_doc_list');
    }

    public function generate_doc() {
        //restricted this area, only for admin
        permittedArea();

         $data['roles'] 					= 		 $this->db->get('role');
        if ($this->input->post()) {
            if ($this->input->post('submit') == 'generate_doc')
                die('Error! sorry');


            $this->form_validation->set_rules('role', 'role', 'required');
            $this->form_validation->set_rules('fname', 'file name', 'required');
            $this->form_validation->set_rules('userfile', 'userfile', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');


            if ($this->form_validation->run() == true) {
                $insert = $this->Generate_doc_model->generate_doc();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Document uploaded successful!');
                    redirect(base_url('generate_doc/generated_doc_list'));
                }
            }
        }

        theme('generate_doc',$data);
    }

    public function generateDocListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');


        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        //$rolename = singleDbTableRow($user_id)->rolename;

        $queryCount = $this->Generate_doc_model->generateDocListCount();


        $query = $this->Generate_doc_model->generateDocList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Generate_doc/view_generated_doc/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				$button .= '<a class="btn btn-info editBtn" href="' . base_url('Generate_doc/pdf_doc/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-file-pdf-o"></i> </a>';
                if ($currentUser == 'admin') {
                    $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
                }
	                $query2 = $this->db->get_where('role', ['id' => $r->role,]);
                if ($query2->num_rows() > 0) {
                    foreach ($query2->result() as $row2) {
                        $role_name = $row2->rolename;
                    }
                } else {
                    $role_name = " ";
                }
                $data['data'][] = array(
                    $button,
                    $role_name,
                    $r->file_name,
                    $r->userfile,
                    $r->status,
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Doc list', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
	
	 public function view_generated_doc($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['generate'] = $this->db->get_where('generate_doc', ['id' => $id]);
        theme('view_generated_doc', $data);
    }


	 public function deletedocAjax() 
	{
        $id = $this->input->post('id');
        $userInfo = singleDbTableRow($id, 'generate_doc');
        $categoryName = $userInfo->name;
        $this->db->where('id', $id)->delete('generate_doc');
        return true;
    
    }
    /**
     * @param int $id
     *
     * Make invoice pdf
     */
    public function pdf_doc($id) {
        if ($id == 0)
            setFlashGoBack('successMsg', 'Insufficient parameter');
		$data['docQuery'] = $this->db->get_where('generate_doc', ['id' => $id]);
       // $data['docQuery'] = $this->Generate_doc_model->pdf_doc($id);

        $this->load->library('pdf');
        $this->pdf->load_view('pdf_doc', $data);
        $this->pdf->render();
        $this->pdf->stream("User-" . "-document-" . date('d-m-Y-h:i') . ".pdf");
    }
	
	
    public function edit_generated_doc($id) {

        permittedArea();
               $data['roles'] 					= 		 $this->db->get('role');

        $data['generate_doc'] = singleDbTableRow($id, 'generate_doc');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_generated_doc')
                die('Error! sorry');


           
            $this->form_validation->set_rules('role', 'role', 'required');
            $this->form_validation->set_rules('fname', 'file name', 'required');
            $this->form_validation->set_rules('userfile', 'userfile', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');




            if ($this->form_validation->run() == true) {
                $insert = $this->Generate_doc_model->edit_generated_doc($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Successfully Edited the document...!!!');
                    redirect(base_url('generate_doc/generated_doc_list'));
                }
            }
        }

        theme('edit_generated_doc', $data);
    }

}
