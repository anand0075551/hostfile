<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Email_model');

        check_auth(); //check is logged in.
    }

   public function index() {

        theme('all_email');
    }

    public function add_email() {
        //permittedArea();

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_email')
                die('Error! sorry');


            $this->form_validation->set_rules('mediam_type', 'mediam type', 'trim|required');
            $this->form_validation->set_rules('template_name', 'template name', 'trim|required');
			$this->form_validation->set_rules('content_name', 'content name', 'trim|required');
           
			
			
            if ($this->form_validation->run() == true) {
                $insert = $this->Email_model->add_email();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'your activity Created Success');
					redirect(base_url('email'));
                }
            }
        }

        theme('add_email');
    }

    public function emailListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Email_model->emailListCount();


        $query = $this->Email_model->emailList($limit,$start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('email/view_email/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
							$user_info 	 = $this->session->userdata('logged_user');
							$user_id 	 = $user_info['user_id'];
							$currentUser = singleDbTableRow($user_id)->role;
							$rolename    = singleDbTableRow($user_id)->rolename;
							$email   	 = singleDbTableRow($user_id)->email;
							if ($currentUser == 'admin'){
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
							<i class="fa fa-trash"></i> </a>'; }




							
                $data['data'][] = array(
                    $button,
                    $r->mediam_type,
                    $r->template_name,
                    $r->content_name
                   
                );
            }
        } else {
            $data['data'][] = array(
                'You have no content name list', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
	
	
    public function deleteAjax() {
		
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'Content');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} Content");
        //Now delete permanently
        $this->db->where('id', $id)->delete('Content');
        return true;
    }
	
	

    //view support

   public function view_email($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['email_Details'] = $this->db->get_where('Content', ['id' => $id]);
        theme('view_email', $data);
    }
	
	

	
	


    public function edit_email($id) {

        // permittedArea();
		$data['Content'] = singleDbTableRow($id, 'content');
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_email')
                die('Error! sorry');


            $this->form_validation->set_rules('mediam_type', 'mediam type', 'trim|required');
            $this->form_validation->set_rules('template_name', 'template name', 'trim|required');

			
			if ($this->form_validation->run() == true) {
                $insert = $this->Email_model->edit_email($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Updated Successfully...!!!');
                    redirect(base_url('email'));
                }
            }
        }

        theme('edit_email', $data);
    }
	
			
	  public function consumer_email() {
        //permittedArea();
		
		$data['rolename'] = $this->db->get('role');
		
        if ($this->input->post()) {
            if ($this->input->post('submit') == 'consumer_email')
			{
				$this->form_validation->set_rules('role_id', 'role id', 'required|trim');
				$this->form_validation->set_rules('template_name', 'template_name', 'trim|required');
       
           
			
			
            if ($this->form_validation->run() == true) {
				
				{
					//EMAIL
					$as_name_id =  $this->input->post('user_id');
					$content =  $this->input->post('content_name');
					
					$as_name = singleDbTableRow($as_name_id)->first_name;
					$as_email = singleDbTableRow($as_name_id)->email;
					
					$HTMLrow = '';
					$HTMLrow .= '<table><tr><td>Hii '.$as_name.',<br> '.$content.' Please check the Email Team Cfirst </td>
                    </tr></table>';
					 
					$adminEmail = get_option('default_email');
					$subject = 'Information Email';
					$this->load->library('email');
					$this->email->set_mailtype("html");
					$this->email->from($adminEmail, get_option('company_name'));
					$this->email->to($as_email);
					$this->email->cc($adminEmail);
					$this->email->subject($subject);
					$message = $HTMLrow;
					$this->email->message($message);
					$this->email->send();
					$this->session->set_flashdata('successMsg', 'Email successfully sent');
					redirect(base_url('email'));
                }
            }
			}
			 elseif ($this->input->post('submit') == 'guest_email'){
				 
					$this->form_validation->set_rules('message', 'message', 'trim|required');
					$this->form_validation->set_rules('email', 'Email', 'trim|required');
       
           
			
			
            if ($this->form_validation->run() == true) {
				{
					$as_email = $this->input->post('email');
					$content =  $this->input->post('message');
					
					$HTMLrow = '';
					$HTMLrow .= '<table><tr><td>Hii,<br> '.$content.'<br> Please check the Email Team Cfirst </td>
                    </tr></table>';
					 
					$adminEmail = get_option('default_email');
					$subject = 'Information Email';
					$this->load->library('email');
					$this->email->set_mailtype("html");
					$this->email->from($adminEmail, get_option('company_name'));
					$this->email->to($as_email);
					$this->email->cc($adminEmail);
					$this->email->subject($subject);
					$message = $HTMLrow;
					$this->email->message($message);
					$this->email->send();
					$this->session->set_flashdata('successMsg', 'Email successfully sent');
					redirect(base_url('email'));
                   
                }
            }
				 
			 }
			
			else{
				die('Error! sorry');
			}
                


         
        }

		
		
        theme('consumer_email');
    }
	
	
	
	
	public function getname() {

        $id = $_POST['role'];
        
		$query = $this->db->get_where('users', ['rolename' => $id]);
        $data = '<option value=""> Choose option </option>';
        foreach ($query->result() as $st) {
            $data .= "<option value=" . $st->id . ">" .$st->referral_code."-". $st->first_name." ". $st->last_name. "</option>";
        }
        echo $data;
    }
	public function getemail() {

        $id = $_POST['role'];
        
		$query = $this->db->get_where('users', ['id' => $id]);
     
        
        foreach ($query->result() as $st) {
            $data = $st->email;
        }
        echo $data;
    }
	
	
	public function getno() {

        $id = $_POST['role'];
        $sql = "select contactno from users where id='$id'";
        $query = $this->db->query($sql);
        $name = $query->result();
        
        foreach ($name as $st) {
            $data = $st->contactno;
        }
        echo $data;
    }
	
	public function get_content() {

        $id = $_POST['id'];
		
        $sql = "select content_name from content where id='$id'";
        $query = $this->db->query($sql);
        $name = $query->result();
        
        foreach ($name as $st) {
            $data = $st->content_name;
        }
        echo $data;
    }
	

	
	
		
	  public function consumer_sms() {
        //permittedArea();
		
		$data['rolename'] = $this->db->get('role');
		
		
		if ($this->input->post()) {
            if ($this->input->post('consumer_sms') == 'consumer_sms'){
				
				
				$this->form_validation->set_rules('role_id', 'role id', 'required|trim');
				$this->form_validation->set_rules('user_id', 'user id', 'trim|required');
				$this->form_validation->set_rules('user_no', 'user no', 'trim|required');
				$this->form_validation->set_rules('template_name', 'template name', 'trim|required');
				$this->form_validation->set_rules('content_name', 'content name', 'trim|required');
				
				if ($this->form_validation->run() == true) {
					$result = $this->Email_model->consumer_sms();
					if ($result) {
						$this->session->set_flashdata('successMsg', 'message successfully sent');
						redirect(base_url('email'));
					}
					else{
						echo "error";
					}
				}
			}
			
			elseif ($this->input->post('guest_SMS') == 'guest_SMS'){
				
				$this->form_validation->set_rules('message', 'message', 'trim|required');
				$this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
				
				
				if ($this->form_validation->run() == true) {
					$insert = $this->Email_model->guest_SMS();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'message successfully sent');
						redirect(base_url('email'));
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
		theme('consumer_sms');
    }
	
	
}//last 
