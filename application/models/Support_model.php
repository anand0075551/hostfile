<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Support_model extends CI_Model {

    public function add_support() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

		 $photoName = '';
        //check user is selected photo

        if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './uploads/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir);     //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['width'] 		  = 200;
            $config['height'] 		  = 200;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            //unlink($photo); // delete original photo

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $photo = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        }
		
        //set all data for inserting into database
        $data = [
            'business_id' => $this->input->post('business_id'),
            'issue_details' => $this->input->post('issue_details'),
            'ticket_no' => $this->input->post('ticket_no'),
            'issue_type' => $this->input->post('issue_type'),
            'comments' => $this->input->post('comments'),
            'photo' => $photoName,
            'created_by' => $user_id,
            'created_at' => time()
        ];

        $data1 = [
            'ticket_no' => $this->input->post('ticket_no'),
            'business_id' => $this->input->post('business_id'),
            'issue' => $this->input->post('issue_type'),
            'created_by' => $user_id,
            'created_at' => time()
        ];

        $query = $this->db->insert('ticket_list', $data);

        $query1 = $this->db->insert('support_track', $data1);

        if ($query && $query1) {
            create_activity('Added ' . $data['created_by'] . 'ticket_list'); //create an activity
            return true;
        }



        return false;
    }

    //view supportList
    public function supportListCount() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        if ($currentUser == 'admin') {
            $query = $this->db->count_all_results('ticket_list');
        } else {
            $query = $this->db->where('created_by ', $user_id)->count_all_results('ticket_list');
        }
        return $query;
    }

    public function supportList($limit = 0, $start = 0) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        $search = $this->input->get('search');
        $searchValue = $search['value'];

        $searchByID = '';
        if ($rolename == '11') {
            if ($searchValue != '') {
                $table_name = "ticket_list";
                //$where_array = array('ticket_no' => $searchValue);
				$where_array = "ticket_no LIKE '%".$searchValue."%' "; 
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            } else {
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('ticket_list');
            }
        } else {
            if ($searchValue != '') {
                $table_name = "ticket_list";
                $where_array = "ticket_no LIKE '%".$searchValue."%' AND created_by = '".$user_id."' "; 
              //  $where_array = array('ticket_no' => $searchValue, 'created_by' => $user_id);
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            } else {
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('ticket_list', ['created_by' => $user_id]);
            }
        }
        return $query;
    }

    public function completesupportListCount() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        if ($rolename == '11') {
            $query = $this->db->count_all_results('ticket_list');
        } else {
            $query = $this->db->where('created_by ', $user_id)->count_all_results('ticket_list');
        }
        return $query;
    }

    public function completesupportList($limit = 0, $start = 0) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        $search = $this->input->get('search');
        $searchValue = $search['value'];

        $searchByID = '';

        if ($rolename == '11') {
            if ($searchValue != '') {
                $table_name = "ticket_list";
                //$where_array = array('ticket_no' => $searchValue);
				$where_array = "ticket_no LIKE '%".$searchValue."%' "; 
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            } else {

                $table_name = "ticket_list";
                $where_array = array('current_status' => '33');
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
                //$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('ticket_list');
            }
        } else {
            if ($searchValue != '') {
                $table_name = "ticket_list";
                $where_array = array('ticket_no' => $searchValue, 'created_by' => $user_id);
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            } else {

                $table_name = "ticket_list";
                $where_array = array('current_status' => '33', 'created_by' => $user_id);
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
                //$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('ticket_list');
            }
        }
        return $query;
    }

    public function assignedListCount() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        if ($rolename == '11') {
            $query = $this->db->count_all_results('ticket_list');
        } else {
            $query = $this->db->where('assigned_to ', $user_id)->count_all_results('ticket_list');
        }
        return $query;
    }

    public function assignedList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        if ($rolename == '11') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('ticket_list');
        } else {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('ticket_list', ['assigned_to' => $user_id]);
        }
        return $query;
    }

    public function notcompleteListCount() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        if ($currentUser == 'admin') {
            $query = $this->db->count_all_results('ticket_list');
        } else {
            $query = $this->db->where('created_by ', $user_id)->count_all_results('ticket_list');
        }
        return $query;
    }

    public function notcompleteList($limit = 0, $start = 0) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        $search = $this->input->get('search');
        $searchValue = $search['value'];

        $searchByID = '';

        if ($currentUser == 'admin') {
            if ($searchValue != '') {
                $table_name = "ticket_list";
                $where_array = array('ticket_no' => $searchValue);
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            } else {

                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('ticket_list');
            }
        } else {
            if ($searchValue != '') {
                $table_name = "ticket_list";
                $where_array = array('ticket_no' => $searchValue, 'created_by' => $user_id);
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            } else {
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('ticket_list', ['created_by' => $user_id]);
            }
        }
        return $query;
    }

    public function edit_support() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $biz_id = $this->input->post('business_id');
        $query = $this->db->get_where('business_groups', ['business_name' => $biz_id]);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $business_id = $row->id;
            }
        } else {
            $business_id = "";
        }

        $data = [
            'ticket_no' => $this->input->post('ticket_no'),
            'business_id' => $business_id,
            'raised_by' => $this->input->post('raised_by'),
            'issue' => $this->input->post('issue'),
            'comments' => $this->input->post('comments'),
            'consumer_id' => $this->input->post('consumer_id'),
            'assigned_to' => $this->input->post('assigned_to'),
            //'role_id' 	 	 => $this->input->post('role_id'),
            'current_status' => $this->input->post('current_status'),
            'created_by' => $user_id,
            'created_at' => time()
        ];

        $query = $this->db->insert('support_track', $data);

        $ticket_no = $this->input->post('ticket_no');
        $data2 = [
            'assigned_to' => $this->input->post('assigned_to'),
            'current_status' => $this->input->post('current_status'),
            'modified_by' => $user_id,
            'modified_at' => time()
        ];

        $query2 = $this->db->where('ticket_no', $ticket_no)->update('ticket_list', $data2);


        $dbid = $this->input->post('assigned_to');
        $get = $this->db->get_where('users', ['id' => $dbid]);
        foreach ($get->result() as $d) {
            $cs_phone = $d->contactno;
            $cs_name = $d->first_name . '  ' . $d->last_name;
			$user_email = $d->email;
        } 

        if ($query) {
			
	//	 Commet by Anand 
			//EMAIL
					$HTMLrow = '';
					$HTMLrow .= '<table><tr><td>Hii '.$cs_name.',Please check the assigned Ticket Team Cfirst </td>
                    </tr></table>';
					
	$email_data = 
			[
                'userData' => $cs_name,
                'tableRow' => $HTMLrow,
                'ticket' => singleDbTableRow($id, 'ticket_list')
            ];
					 
				/*	$adminEmail = get_option('default_email');
				$subject = 'assigned  ticket';
				$this->load->library('email');
				$this->email->set_mailtype("html");
				$this->email->from($adminEmail, get_option('company_name'));
				$this->email->to($cs_name);
				$this->email->cc($adminEmail);
				$this->email->subject($subject);
				$message = $this->load->view('consumer_support_email',$email_data,TRUE);
				$this->email->message($message);
				$this->email->send();
				
				*/
				
				
			
				$adminEmail = get_option('default_email');
				$subject = 'assigned  ticket';
				$this->load->library('email');
				$this->email->set_mailtype("html");
				$this->email->from($adminEmail, get_option('company_name'));
				$this->email->to($as_email);
				$this->email->cc($adminEmail);
				$this->email->subject($subject);
				$html2 = $this->load->view('consumer_support_email',$email_data,TRUE);
				$message = $HTMLrow;
				$message = $html2;
				$this->email->message($message);
				$this->email->send();
			
           /* $mobile_no = $sms_mn;
            $fname = singleDbTableRow($raised_by)->first_name;
            $message = "Dear " .$fname . ", There is an update for your Request. Please Check Your ticket Status  - Team Cfirst";
            $sendsms = new sendsms("http://alerts.solutionsinfini.com/api/v3", 'sms', "Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
            $sendsms->send_sms($mobile_no, $message, 'http://www.consumer1st.in', 'xml');*/

            create_activity('Added ' . $data['created_by'] . 'support_track'); //create an activity
            return true;
        }
        return false;
    }

    public function add_cs_comment($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $biz_id = $this->input->post('business_id');
        $query = $this->db->get_where('business_groups', ['business_name' => $biz_id]);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $business_id = $row->id;
            }
        } else {
            $business_id = "";
        }





        $data = [
            'ticket_no' => $this->input->post('ticket_no'),
            'business_id' => $business_id,
            'raised_by' => $this->input->post('raised_by'),
            'current_status' => $this->input->post('current_status'),
            'issue' => $this->input->post('issue'),
            'assigned_to' => $this->input->post('assigned_to'),
            'comments' => $this->input->post('comments'),
            'consumer_id' => $this->input->post('consumer_id'),
            'created_by' => $user_id,
            'created_at' => time()
        ];

        $query = $this->db->insert('support_track', $data);

        $ticket_no = $this->input->post('ticket_no');

        $data2 = [
            'assigned_to' => $this->input->post('assigned_to'),
            'current_status' => $this->input->post('current_status'),
            'modified_by' => $user_id,
            'modified_at' => time()
        ];

        $query2 = $this->db->where('ticket_no', $ticket_no)->update('ticket_list', $data2);


        $dbid = $this->input->post('assigned_to');
        $get = $this->db->get_where('users', ['id' => $dbid]);
        if($get->num_rows() > 0){
            foreach ($get->result() as $d) {
                $as_phone = $d->contactno;
                $as_name = $d->first_name . '  ' . $d->last_name;
    			$as_email = $d->email;
    			$as_consu_id = $d->referral_code;
    			$as_role = $d->role;
            }
        }
        

     

        if ($get->num_rows() > 0) {
			// $data['ticket'] = singleDbTableRow($id, 'ticket_list');
			
		//EMAIL
				$HTMLrow = '';
					$HTMLrow .= '<table><tr><td>Hii '.$as_name.',Please check the assigned Ticket Team Cfirst </td>
                    </tr></table>';
					
	$email_data = 
			[
                'userData' => $as_name,
                'tableRow' => $HTMLrow,
                'ticket' => singleDbTableRow($id, 'ticket_list')
            ];
					 
			/*		$adminEmail = get_option('default_email');
				$subject = 'assigned  ticket';
				$this->load->library('email');
				$this->email->set_mailtype("html");
				$this->email->from($adminEmail, get_option('company_name'));
				$this->email->to($as_name);
				$this->email->cc($adminEmail);
				$this->email->subject($subject);
				$message = $this->load->view('consumer_support_email',$email_data,TRUE);
				$this->email->message($message);
				$this->email->send(); */
				
				
			
				$adminEmail = get_option('default_email');
				$subject = 'assigned  ticket';
				$this->load->library('email');
				$this->email->set_mailtype("html");
				$this->email->from($adminEmail, get_option('company_name'));
				$this->email->to($as_email);
				$this->email->cc($adminEmail);
				$this->email->subject($subject);
				$html2 = $this->load->view('consumer_support_email',$email_data,TRUE);
				$message = $HTMLrow;
				$message = $html2;
				$this->email->message($message);
				$this->email->send();
				
				
           // include_once('sendsms.php');

           /* $mobile = $as_phone;
            $uname = $as_name;
            $message = "Dear " . $uname . ", There is an update for your Request. Please Check Your ticket Status  - Team Cfirst";
            $sendsms = new sendsms("http://alerts.solutionsinfini.com/api/v3", 'sms', "Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
            $sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');*/
			
			/*$mobile_no = $numbr;
            $fname = singleDbTableRow($raised_by)->first_name;
            $message = "Dear " .$fname . ", There is an update for your Request. Please Check Your ticket Status  - Team Cfirst";
            $sendsms = new sendsms("http://alerts.solutionsinfini.com/api/v3", 'sms', "Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
            $sendsms->send_sms($mobile_no, $message, 'http://www.consumer1st.in', 'xml');*/

           
        }
        
        if($query){
            create_activity('Added ' . $data['created_by'] . 'support_track'); //create an activity
            return true;
        }
        
        return false;
    }
	
	
	
	

}

//last 
