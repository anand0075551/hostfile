<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Personal_note extends CI_Controller 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('Personal_note_model');
		$this->load->model('ledger_model');
		$this->load->model('payment_model');
		$this->load->model('notification_model');
		
		check_auth(); //check is logged in.
	}
	/*create*/
	public function personal_note_create()
	{
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add') die('Error! sorry');
			$this->form_validation->set_rules('p_date','Date','required');
			$this->form_validation->set_rules('title','Title','required');
			$this->form_validation->set_rules('description','Description','required');
			if($this->form_validation->run() == true)
			{
				$create = $this->Personal_note_model->personal_note_create();
				if($create)
				{
					$this->session->set_flashdata('successMsg', 'New Note created Successfully!');
					redirect(base_url('Personal_note/personal_note_list'));
				}

			}
		}
		theme('personal_note_create');
	}
	/*/.create*/
	/*list*/
	public function personal_note_list()
	{
		theme('personal_note_list');
	}
	public function NoteListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Personal_note_model->NoteListCount();
		$query = $this->Personal_note_model->NoteList($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 foreach ($query->result() as $notes) 
			 {
				  $button = '';//Action Button
				  
				$button .= '<a class="btn btn-primary editBtn" href="' . base_url('Personal_note/personal_note_view/' . $notes->id) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				
           /*    $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Personal_note/personal_note_edit/' . $notes->id) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> </a> ';
               	 
				if ($currentUser == 'admin')
				{
          $button .= '<a class="btn btn-danger deleteBtn" id="' . $notes->id . '" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i> </a>';
				}*/
				
				
				$data['data'][] = array(
                    $button,
					$notes->p_date,
					$notes->title,
					substr($notes->description, 0, 25).'....',
                    substr($notes->note1, 0, 25).'....',
                    substr($notes->note2, 0, 25).'....',
					substr($notes->note3, 0, 25).'....',
					substr($notes->note4, 0, 25).'....',
					substr($notes->note5, 0, 25).'....',
					singleDbTableRow($notes->created_by, 'users')->first_name.' '.singleDbTableRow($notes->created_by, 'users')->last_name,
					date('y-m-d h:m:i',$notes->created_at)
                    
                );
				
			 }
		 }
		 else
		 {
			 $data['data'][] = array(
                'No results found', '', '', '', '','' , '', '', '', '', ''
            );
		 }
		  echo json_encode($data);
	}
	/*/.list*/
	/*view*/
	public function personal_note_view($id) 
	{
		
		$data['notes'] = $this->db->get_where('personal_note', ['id' => $id]);
		
		theme('personal_note_view', $data);
	}
	/*/.view*/
	/*Edit*/
	/*view*/
	public function personal_note_edit($id) 
	{
		
		$data['notes'] = $this->db->get_where('personal_note', ['id' => $id]);
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit') die('Error! sorry');
			$this->form_validation->set_rules('p_date','Date','required');
			$this->form_validation->set_rules('title','Title','required');
			$this->form_validation->set_rules('description','Description','required');
			if($this->form_validation->run() == true)
			{
				$create = $this->Personal_note_model->personal_note_edit($id);
				if($create)
				{
					$this->session->set_flashdata('successMsg', ' Note Updated Successfully!');
					redirect(base_url('Personal_note/personal_note_list'));
				}

			}
		}
		
		theme('personal_note_edit', $data);
	}
	/*/.edit*/
}