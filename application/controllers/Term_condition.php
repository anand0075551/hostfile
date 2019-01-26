<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Term_condition extends CI_Controller 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('Term_condition_model');
		$this->load->model('ledger_model');
		$this->load->model('payment_model');
		$this->load->model('notification_model');
		
		check_auth(); //check is logged in.
	}
	public function check_exist()
     {
         $role=$_POST['role'];
         $query = $this->db->get_where('term_condition', ['role'=>$role]);
		 if($query ->num_rows() > 0)
		 {
			 echo 1;
		 }
		 else
		 {
			 echo 0;
		 }
         
     }
	/*upload*/
	public function term_condition_upload()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser != 11)
		{
			permittedArea();
		}
		else
		{
			$data['roles'] = $this->db->order_by('rolename', 'asc')->get('role');
			$data['term_status'] = $this->db->order_by('status', 'asc')->get_where('status', ['business_name'=>18]);
			
			if($this->input->post())
			{
				if($this->input->post('submit') != 'add') die('Error! sorry');
				$this->form_validation->set_rules('role','Role','required');
				$this->form_validation->set_rules('valid_from','Date','required');
				$this->form_validation->set_rules('fname','Name','required');
				$this->form_validation->set_rules('userfile','Content','required');
				$this->form_validation->set_rules('status','Status','required');
				
				if($this->form_validation->run() == true)
				{
					$create = $this->Term_condition_model->term_condition_upload();
					if($create)
					{
						$this->session->set_flashdata('successMsg', 'Uploaded  Successfully!');
						redirect(base_url('Term_condition/term_condition_list'));
					}
	
				}
			}
			theme('term_condition_upload',$data);
		}
	}
	/*/.upload*/
	/*list*/
	public function term_condition_list()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser != 11)
		{
			permittedArea();
		}
		else
		{
		theme('term_condition_list');
		}
	}
	public function ListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Term_condition_model->ListCount();
		$query = $this->Term_condition_model->term_condition_list($limit,$start);
		
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
				  
				$button .= '<a class="btn btn-primary editBtn" href="' . base_url('Term_condition/term_condition_view/' . $notes->id) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				
               $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Term_condition/term_condition_edit/' . $notes->id) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> </a> ';
			    $button .= '<a href="'.base_url('Term_condition/term_condition_pdf_export/'.$notes->id).'" class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> </a> ';
			   
               	 
				/*if ($currentUser == 'admin')
				{
          $button .= '<a class="btn btn-danger deleteBtn" id="' . $notes->id . '" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i> </a>';
				}*/
				if($notes->otp == 1)
				{
					$otp = 'Yes';
				}
				else
				{
					$otp = 'No';
				}
				
				
				$data['data'][] = array(
                    $button,
					$notes->term_ID,
					$notes->file_name,
					singleDbTableRow($notes->role, 'role')->rolename,
					$notes->valid_from,
					$notes->valid_to,
					singleDbTableRow($notes->status, 'status')->status,
					$otp,
					singleDbTableRow($notes->created_by, 'users')->first_name.' '.singleDbTableRow($notes->created_by, 'users')->last_name,
					date('y-m-d h:m:i',$notes->created_at)
                    
                );
				
			 }
		 }
		 else
		 {
			 $data['data'][] = array(
                'No results found', '', '', '', '', '', '', '', '', ''
            );
		 }
		  echo json_encode($data);
	}
	/*/.list*/
	/*view*/
	public function term_condition_view($id) 
	{
		
		$data['terms'] = $this->db->get_where('term_condition', ['id' => $id]);
		
		theme('term_condition_view', $data);
	}
	public function term_condition_track_view($id) 
	{
		
		$data['terms'] = $this->db->get_where('term_condition_track', ['id' => $id]);
		
		theme('term_condition_track_view', $data);
	}
	public function term_condition_pdf($id) 
	{
		$data['terms'] = $this->db->get_where('term_condition', ['id' => $id]);
		
		theme('term_condition_pdf',$data);
	}
	/***
	PDF
	***/
	public function term_condition_pdf_export($id)
	{
		
		$data['terms'] = $this->db->get_where('term_condition', ['id' => $id]);
		
		$this->load->library('pdf');
		$this->pdf->load_view('term_condition_pdf_export', $data);
		$this->pdf->render();
		$this->pdf->stream("Terms & Conditions-id-".$id."-at-".date('d-m-Y-h:i').".pdf");

	}
	/**/
	/**
	Print
	*/
	public function term_condition_print($id) 
	{
		$data['terms'] = $this->db->get_where('term_condition', ['id' => $id]);
		
		theme('term_condition_print',$data);
	}
	/**/
	public function term_condition_track_pdf($id) 
	{
		$data['terms'] = $this->db->get_where('term_condition_track', ['id' => $id]);
		
		theme('term_condition_track_pdf',$data);
	}
	/***
	PDF
	***/
	public function term_condition_track_pdf_export($id)
	{
		
		$data['terms'] = $this->db->get_where('term_condition_track', ['id' => $id]);
		
		$this->load->library('pdf');
		$this->pdf->load_view('term_condition_track_pdf_export', $data);
		$this->pdf->render();
		$this->pdf->stream("Terms & Conditions-id-".$id."-at-".date('d-m-Y-h:i').".pdf");

	}
	/**/
	/**
	Print
	*/
	public function term_condition_track_print($id) 
	{
		$data['terms'] = $this->db->get_where('term_condition_track', ['id' => $id]);
		
		theme('term_condition_track_print',$data);
	}
	/**/
	/*user*/
	public function term_condition_user_track_view($id) 
	{
		
		$data['terms'] = $this->db->get_where('term_condition_user_track', ['id' => $id]);
		
		theme('term_condition_user_track_view', $data);
	}
	public function term_condition_user_track_pdf($id) 
	{
		$data['terms'] = $this->db->get_where('term_condition_user_track', ['id' => $id]);
		
		theme('term_condition_user_track_pdf',$data);
	}
	public function term_condition_user_track_pdf_export($id)
	{
		
		$data['terms'] = $this->db->get_where('term_condition_user_track', ['id' => $id]);
		
		$this->load->library('pdf');
		$this->pdf->load_view('term_condition_user_track_pdf_export', $data);
		$this->pdf->render();
		$this->pdf->stream("Terms & Conditions-id-".$id."-at-".date('d-m-Y-h:i').".pdf");

	}
	public function term_condition_user_track_print($id) 
	{
		$data['terms'] = $this->db->get_where('term_condition_user_track', ['id' => $id]);
		
		theme('term_condition_user_track_print',$data);
	}
	/*/.view*/
	/*edit*/
	public function term_condition_edit($id) 
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser != 11)
		{
			permittedArea();
		}
		else
		{
			$data['terms'] = $this->db->get_where('term_condition', ['id' => $id]);
			$data['roles'] = $this->db->order_by('rolename', 'asc')->get('role');
			$data['term_status'] = $this->db->order_by('status', 'asc')->get_where('status', ['business_name'=>18]);
			if($this->input->post())
			{
				if($this->input->post('submit') != 'add') die('Error! sorry');
				$this->form_validation->set_rules('role','Role','required');
				$this->form_validation->set_rules('valid_from','Date','required');
				$this->form_validation->set_rules('fname','Name','required');
				$this->form_validation->set_rules('userfile','Content','required');
				$this->form_validation->set_rules('status','Status','required');
				
				if($this->form_validation->run() == true)
				{
					$create = $this->Term_condition_model->term_condition_edit($id);
					if($create)
					{
						$this->session->set_flashdata('successMsg', 'Updated  Successfully!');
						redirect(base_url('Term_condition/term_condition_list'));
					}
	
				}
			}
		
		theme('term_condition_edit', $data);
		}
	}
	/*/.edit*/
	/*Report*/
	public function term_condition_report()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser != 11)
		{
			permittedArea();
		}
		else
		{
			$data['tc'] = $this->db->order_by('id', 'asc')->get('term_condition');
			$data['roles'] = $this->db->order_by('rolename', 'asc')->get('role');
			$data['term_status'] = $this->db->order_by('status', 'asc')->get_where('status', ['business_name'=>18]);
			theme('term_condition_report',$data);
		}
	}
	
	public function search_report()
	{
		$tc=$_POST['tc'];
		$status=$_POST['status'];
		$otp=$_POST['otp'];
		$role=$_POST['role'];
		
		
		$rsf_time=$_POST['rsf_time'];
		$rst_time=$_POST['rst_time'];
		$ref_time=$_POST['ref_time'];
		$ret_time=$_POST['ret_time'];
		
		
		
		$limit = $this->input->POST('length');
		$start = $this->input->POST('start');
		
		//
		$queryCount = $this->Term_condition_model->term_search_count($tc,$status,$role,$rsf_time,$rst_time,$ref_time,$ret_time,$otp);

		
		$query = $this->Term_condition_model->term_report_search($limit, $start,$tc,$status,$role,$rsf_time,$rst_time,$ref_time,$ret_time,$otp);

		$draw = $this->input->POST('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		//
		
      if($query -> num_rows() > 0) 
			  {
				 
				
				foreach($query->result() as $r)
				{
				$button = '<a class="btn btn-primary editBtn" href="' . base_url('Term_condition/term_condition_report_view/' . $r->term_ID) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				$button .= '<a href="'.base_url('Term_condition/term_condition_pdf_export/'.$r->id).'" class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> </a> ';
				
				$where_array =" term_ID = '".$r->term_ID."' AND terms_read =1 ";
				$users_count = $this->db->where($where_array )->count_all_results('term_condition_user');
				
				if($r->otp == 1)
				{
					$otp1 = 'Yes';
				}
				else
				{
					$otp1 = 'No';
				}
				//
					$data['data'][] = array(
						$button,
						$r->term_ID,
						$r->file_name,
						singleDbTableRow($r->role, 'role')->rolename,
						$r->valid_from,
						$r->valid_to,	
						singleDbTableRow($r->status, 'status')->status,	
						$otp1,				
						$users_count	
								
				
					);
				}
		}else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','','','','','',''
			);
		}
				echo json_encode($data);

	}
	public function term_condition_report_view($term_id) 
	{
		
		$data['terms'] = $this->db->get_where('term_condition', ['term_ID' => $term_id]);
		$data['terms_track'] = $this->db->get_where('term_condition_track', ['term_ID' => $term_id]);
		$data['users_track'] = $this->db->get_where('term_condition_user_track', ['term_ID' => $term_id]);
		
		theme('term_condition_report_view', $data);
	}
	/*/.*/
	//
	public function accepted_term_condition()
	{
		theme('accepted_term_condition');
		
	}
	public function Accepted_Json() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Term_condition_model->Accepted_ListCount();
		$query = $this->Term_condition_model->accepted_list($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 foreach ($query->result() as $notes) 
			 {
				 $terms = $this->db->get_where('term_condition', ['term_ID' => $notes->term_ID]);
				 foreach ($terms->result() as $t)
					{
						$id =  $t->id;
						$totp =  $t->otp;
						$term_ID =  $t->term_ID;
						$file_name =  $t->file_name;
						$role =  $t->role;
						$valid_from =  $t->valid_from;
						$valid_to =  $t->valid_to;
						$status =  $t->status;
					}
				  $button = '';//Action Button
				  
				$button .= '<a class="btn btn-primary editBtn" href="' . base_url('Term_condition/term_condition_user_track_view/' . $notes->id) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				
              
               	 
				/*if ($currentUser == 'admin')
				{
          $button .= '<a class="btn btn-danger deleteBtn" id="' . $notes->id . '" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i> </a>';
				}*/
				if($totp == 1)
				{
					$otp = 'Yes';
				}
				else
				{
					$otp = 'No';
				}
				
				
				$data['data'][] = array(
                    $button,
					$term_ID,
					$notes->file_name,
					singleDbTableRow($role, 'role')->rolename,
					$valid_from,
					$valid_to,
					singleDbTableRow($status, 'status')->status,
					$notes->otp,
					$notes->read_at
                    
                );
				
			 }
		 }
		 else
		 {
			 $data['data'][] = array(
                'No results found', '', '', '', '', '','','',''
            );
		 }
		  echo json_encode($data);
	}
	//
}
?>