<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model 
{
/* Create Events */
//
public function event_category()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		
		/* */
		$data = [
			'name'                => $this->input->post('name'),
			'category_type'       =>'main',
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_category', $data);
			
		/* */
		if($query)
        {
			
            return true;
        }
        return false;
	}
//
//
public function event_sub_category()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		
		/* */
		$data = [
			'name'                => $this->input->post('name'),
			'parent_id'           => $this->input->post('categ'),
			'category_type'       =>'sub',
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_category', $data);
			
		/* */
		if($query)
        {
			
            return true;
        }
        return false;
	}
//
public function event_seat_category()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		
		/* */
		$data = [
			'name'                => $this->input->post('name'),
			'category_type'       =>'main',
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_seat_category', $data);
			
		/* */
		if($query)
        {
			
            return true;
        }
        return false;
	}
	public function event_seat_sub_category()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		
		/* */
		$data = [
			'name'                => $this->input->post('name'),
			'parent_id'           => $this->input->post('categ'),
			'category_type'       =>'sub',
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_seat_category', $data);
			
		/* */
		if($query)
        {
			
            return true;
        }
        return false;
	}
	public function get_sub_categ($category)
    {
      $where_array = array( 'parent_id' => $category);
      $table_name="em_category";
       $query = $this->db->group_by('name')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	public function get_seat_sub_categ($category)
    {
      $where_array = array( 'parent_id' => $category);
      $table_name="em_seat_category";
       $query = $this->db->group_by('name')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 
	public function get_state($country)
    {
      $where_array = array( 'country' => $country);
      $table_name="pincode";
       $query = $this->db->group_by('state')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 
	public function get_district($state)
    {
      $where_array = array( 'state' => $state);
      $table_name="pincode";
       $query = $this->db->group_by('district')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 
	public function get_location($district)
    {
      $where_array = array( 'district' => $district);
      $table_name="pincode";
       $query = $this->db->order_by('id')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 
	public function get_user_by_role($role)
    {
      $where_array = array( 'rolename' => $role);
      $table_name="users";
       $query = $this->db->order_by('id')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	public function get_area($bg_id)
    {
      $where_array = array( 'business_name' => $bg_id );
      $table_name="area";
       $query = $this->db->order_by('id', 'asc')->where($where_array )->get($table_name);
       
            //$result = $query->result_array();
            return $query;
        
    }
	public function event_create()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		/*check user is selected photo*/
		 if ($_FILES['userfile']['name'] != '') {
			//$upload_dir = './uploads/invitation/';;
			$upload_dir = './uploads/invitation/';
            if (!file_exists($upload_dir))
            mkdir($upload_dir); 				//create directory if not found.
            $config['upload_path'] 			= $upload_dir;
            $config['allowed_types']        = 'gif|jpg|png';
			$config['image_library'] 		= 'gd2';
			$config['maintain_ratio']	    = TRUE;
			$config['width']         		= 200;
			$config['height']      		    = 200;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
        	//unlink($photo); // delete original photo
			$this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) 
			{
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else 
			{
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        }
		else
		{
			$photoName ='';
		}
		//
		/*event count */
		$count = $this->db->count_all_results('em_events');
		$em_count = $count+1;
		//
		/*if($this->input->post('open_to_all'))
		{
			$open = 1;
		}
		else
		{
			$open = 0;
		}*/
		//
		//
		$categ = $this->input->post('categ');
		 $get_categ_name = $this->db->get_where('em_category', ['id'=>$categ]);
		foreach($get_categ_name->result() as $h);
		$categ_name = $h->name;
		//
		$event ='EVE'.strtoupper(substr($categ_name,0,3)).$em_count;
		//
		if($this->input->post('select_users') == 1)
		{
			$s_users = $this->input->post('my_users');
			if(count($s_users) > 0)
			{
				$selected_users ='';
				$send_now = '';
				$event_name=$this->input->post('name');
				foreach($s_users as $s_user)
				{
					$selected_users = $s_user.','.$selected_users;
					//
					$get_phn = $this->db->get_where('users', ['id'=>$s_user]);
					foreach($get_phn->result() as $nm);
					$sms_numbers = $nm->contactno.','.$sms_numbers;
					//
					$send_now = $this->notification_model->EM_invite($event,$event_name,$sms_numbers);
				}
			}
			else
			{
				$selected_users = '';
			}
			$open = 0;
			$selected_bg = 0;
			$selected_roles = 0;
			$selected_area = 0;
			
		}
		else 
		{
			$selected_users = '';
			$open = 1;
			//
			$selected_bg = '';
			$selected_area = '';
			if(!empty($_POST['sbg'])) 
			{
				$event_name=$this->input->post('name');
				foreach($_POST['sbg'] as $cnt => $sbg) 
				{
					$selected_bg = $sbg.','.$selected_bg;
					/*sms*/
					$pin = singleDbTableRow($_POST['sarea'][$cnt], 'area')->pincode;
					$where_array = " pincode IN (".$pin.") ";
					$query = $this->db->order_by('id', 'desc')->where($where_array )->get('user_address');
					if ($query->num_rows() > 0) 
					{
						$uphn = '';
						foreach ($query->result() as $r)
						{
							$uphn = singleDbTableRow($r->user_id, 'users')->contactno.','.$uphn;
						}
						$send_now = $this->notification_model->EM_invite($event,$event_name,$uphn);
					}
					/**/
					$selected_area = $_POST['sarea'][$cnt].','.$selected_area;
					
				}
			}
			//
			$open_role = $this->input->post('open_role');
			if(count($open_role) > 0)
			{
				$selected_roles ='';
				foreach($open_role as $role)
				{
					$selected_roles = $role.','.$selected_roles;
				}
			}
			else
			{
				$selected_roles = '';
			}
		}
		//
		
		if($this->input->post('send_sms'))
		{
			$sms_numbers = $this->input->post('send_sms');
			$get_event_name = $this->db->get_where('em_events', ['event'=>$event]);
			foreach($get_event_name->result() as $ev);
			$event_name = $ev->name;
			$send_now = $this->notification_model->EM_invite($event,$event_name,$sms_numbers);
			
		}
		//
		/* set reg_fee=1 if */
		if(!empty($_POST['seatfrom'])) 
		{
			$reg_fee =1;
		}
		else
		{
			$reg_fee =0;
		}
		$stdate = $this->input->post('f_time');
		$enddate =  $this->input->post('t_time');
		/* $selected_bg = 0;
			$selected_roles = 0;
			$selected_area = 0;*/
		$data = [
			'event'               => $event,
			'budget'              => $this->input->post('budget'),
			'reg_fee'             => $reg_fee,
			'name'                => $this->input->post('name'),
			'category'            => $this->input->post('categ'),
			'subcategory'         => $this->input->post('sub_categ'),
			'seat_category'       => $this->input->post('seat_categ'),
			'seat_subcategory'    => $this->input->post('seat_sub_categ'),
			'selected_users'      => $selected_users,
			'selected_bg'         => $selected_bg,
			'selected_roles'      => $selected_roles,
			'selected_area'       => $selected_area,
			'sms_numbers'         =>$this->input->post('send_sms'),
			'location'            => $this->input->post('location'),
			'venue'               => $this->input->post('venue'),
			'open_to_all'         => $open,
			'regstart_date'       => $this->input->post('rf_time'),
            'regend_date'         => $this->input->post('rt_time'),
			'start_date'          => $this->input->post('f_time'),
            'end_date'            => $this->input->post('t_time'),
			'host'         		  => $this->input->post('host'),
			'organiser'		      => $this->input->post('organiser'),
			'guest'		          => $this->input->post('guest'),
			'additional_guests'	  => $this->input->post('add_guest'),
			'participants'		  => $this->input->post('participants'),
			'status'		      => $this->input->post('status'),
			'approved'		      => 1,
			'invitation'		  => $photoName,
			'organised_by'    	  => $user_id,
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_events', $data);
			$query1 = $this->db->insert('em_track', $data);
		/* */
		if($query)
        {
			/* adding labels into em_labels table*/
			if(!empty($_POST['label'])) 
			{
				foreach($_POST['label'] as $cnt => $label) 
				{
					$data2 = [
								'event'               => $event,
								'e_label'             => $label,
								'created_by'    	  => $user_id,
								'created_at'    	  => time()
							];
					$query2 = $this->db->insert('em_labels', $data2);
					
				}
			}
			/* adding sponsorship into em_sponsorship table */
			if(!empty($_POST['sfor'])) 
			{
				foreach($_POST['sfor'] as $cnt => $sfor) 
				{
					$sponsorship = $event.strtoupper( substr($sfor, 0, 4 ) );
					$charge = $_POST['scharge'][$cnt];
					$to = $_POST['sto'][$cnt];
					
					$data3 = [
								'event'               => $event,
								'sponsorship'         => $sponsorship,
								'title'               => $sfor,
								'charge'              => $charge,
								'give_to'              => $to,
								'created_by'    	  => $user_id,
								'created_at'    	  => time()
							];
					$query3 = $this->db->insert('em_sponsorship', $data3);
					//EMAIL
					$user_info = singleDbTableRow($to);
		$HTMLrow = '';
		$HTMLrow .= '<table><tr>
                        <td style="padding:5px;text-align:center;">Event : '.$event.'</td>
                        <td style="padding:5px;text-align:center;">Event Start date '.$stdate.'</td>
                        <td style="padding:5px;text-align:center;">Event End date '.$enddate.'</td>
						<td style="padding:5px;text-align:center;">Contract For '.$sfor.'</td>
						<td style="padding:5px;text-align:center;">Amount '.$charge.'</td>
                    </tr></table>';
					 
			$adminEmail = get_option('default_email');
            $subject = 'Hi '.user_full_name($user_info).', your order registered successfully';
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($user_info->email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $HTMLrow;
            $this->email->message($message);
            $this->email->send();
			//
				}
			}
			/* adding seats and reg fee into em_seats table */
			if(!empty($_POST['seatfrom'])) 
			{
				foreach($_POST['seatfrom'] as $cnt => $seatfrom) 
				{
					/*seat count */
					$Scount = $this->db->count_all_results('em_seats');
					$st_count = $Scount+1;
					$seat = strtoupper($_POST['seatname'][$cnt]);
					$seatto = $_POST['seatto'][$cnt];
					$seatfee = $_POST['seatfee'][$cnt];
					$refund_perc = $_POST['seatrefund'][$cnt];
					
					$data4 = [
								'event'               => $event,
								'seat'                => $seat,
								'seat_from'           => $seatfrom,
								'seat_to'             => $seatto,
								'reg_fee'             => $seatfee,
								'refund_perc'         => $refund_perc,
								'created_by'    	  => $user_id,
								'created_at'    	  => time()
							];
					$query4 = $this->db->insert('em_seats', $data4);
				}
			}		
            //create_activity('Added '.$data['name'].'distributor_commission'); //create an activity
            return true;
        }
        return false;
	}
/* /Create Events */
/*edit*/
public function event_edit($event)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		/*event count */
		$count = $this->db->count_all_results('em_events');
		$em_count = $count+1;
		//
		/*if($this->input->post('open_to_all'))
		{
			$open = 1;
		}
		else
		{
			$open = 0;
		}*/
		if($this->input->post('select_users') == 1)
		{
			$s_users = $this->input->post('my_users');
			if(count($s_users) > 0)
			{
				$selected_users ='';
				foreach($s_users as $s_user)
				{
					$selected_users = $s_user.','.$selected_users;
				}
			}
			else
			{
				$selected_users = '';
			}
			$open = 0;
			$selected_bg = 0;
			$selected_roles = 0;
			$selected_area = 0;
			
		}
		else 
		{
			$selected_users = '';
			$open = 1;
			//
			$selected_bg = '';
			$selected_area = '';
			if(!empty($_POST['sbg'])) 
			{
				foreach($_POST['sbg'] as $cnt => $sbg) 
				{
					$selected_bg = $sbg.','.$selected_bg;
					$selected_area = $_POST['sarea'][$cnt].','.$selected_area;
					
				}
			}
			//
			$open_role = $this->input->post('open_role');
			if(count($open_role) > 0)
			{
				$selected_roles ='';
				foreach($open_role as $role)
				{
					$selected_roles = $role.','.$selected_roles;
				}
			}
			else
			{
				$selected_roles = '';
			}
		}
		//
		
		/* set reg_fee=1 if */
		if(!empty($_POST['seatfrom'])) 
		{
			$reg_fee =1;
		}
		else
		{
			$reg_fee =0;
		}
		$stdate = $this->input->post('f_time');
		$enddate =  $this->input->post('t_time');
		/* */
		$data = [
			'budget'              => $this->input->post('budget'),
			'reg_fee'             => $reg_fee,
			'name'                => $this->input->post('name'),
			'category'            => $this->input->post('categ'),
			'subcategory'        => $this->input->post('sub_categ'),
			'selected_users'      => $selected_users,
			'selected_bg'         => $selected_bg,
			'selected_roles'      => $selected_roles,
			'selected_area'       => $selected_area,
			'sms_numbers'         =>$this->input->post('send_sms'),
			'location'            => $this->input->post('location'),
			'venue'               => $this->input->post('venue'),
			'open_to_all'         => $open,
			'regstart_date'       => $this->input->post('rf_time'),
            'regend_date'         => $this->input->post('rt_time'),
			'start_date'          => $this->input->post('f_time'),
            'end_date'            => $this->input->post('t_time'),
			'host'         		  => $this->input->post('host'),
			'organiser'		      => $this->input->post('organiser'),
			'guest'		          => $this->input->post('guest'),
			'additional_guests'	  => $this->input->post('add_guest'),
			'participants'		  => $this->input->post('participants'),
			'status'		      => $this->input->post('status'),
			'modified_by'    	  => $user_id,
			'modified_at'    	  => time()
			];
			$query = $this->db->where('event', $event)->update('em_events', $data);
			$query1 = $this->db->insert('em_track', $data);
		/* */
		if($query)
        {
			/* adding labels into em_labels table*/
			/*if(!empty($_POST['label'])) 
			{
				foreach($_POST['label'] as $cnt => $label) 
				{
					$data2 = [
								'event'               => $event,
								'e_label'             => $label,
								'created_by'    	  => $user_id,
								'created_at'    	  => time()
							];
					$query2 = $this->db->insert('em_labels', $data2);
					
				}
			}*/
			/* adding sponsorship into em_sponsorship table */
			if(!empty($_POST['sfor'])) 
			{
				//
				$where_array = " event = '".$event."' ";
				$query = $this->db->where($where_array )->count_all_results('em_sponsorship');
				if($query >0)
				{
					$this->db->where('event', $event)->delete('em_sponsorship');
				}
				//
				foreach($_POST['sfor'] as $cnt => $sfor) 
				{
					$sponsorship = $event.strtoupper( substr($sfor, 0, 4 ) );
					$charge = $_POST['scharge'][$cnt];
					$to = $_POST['sto'][$cnt];
					
					$data3 = [
								'event'               => $event,
								'sponsorship'         => $sponsorship,
								'title'               => $sfor,
								'charge'              => $charge,
								'give_to'              => $to,
								'created_by'    	  => $user_id,
								'created_at'    	  => time()
							];
					$query3 = $this->db->insert('em_sponsorship', $data3);
					//EMAIL
					$user_info = singleDbTableRow($to);
		$HTMLrow = '';
		$HTMLrow .= '<table><tr>
                        <td style="padding:5px;text-align:center;">Event : '.$event.'</td>
                        <td style="padding:5px;text-align:center;">Event Start date '.$stdate.'</td>
                        <td style="padding:5px;text-align:center;">Event End date '.$enddate.'</td>
						<td style="padding:5px;text-align:center;">Contract For '.$sfor.'</td>
						<td style="padding:5px;text-align:center;">Amount '.$charge.'</td>
                    </tr></table>';
					 
			$adminEmail = get_option('default_email');
            $subject = 'Hi '.user_full_name($user_info).', your order registered successfully';
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($user_info->email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $HTMLrow;
            $this->email->message($message);
            $this->email->send();
			//
				}
			}
			/* adding seats and reg fee into em_seats table */
			if(!empty($_POST['seatfrom'])) 
			{
				//
				$where_array = " event = '".$event."' ";
				$query = $this->db->where($where_array )->count_all_results('em_seats');
				if($query >0)
				{
					$this->db->where('event', $event)->delete('em_seats');
				}
				//
				foreach($_POST['seatfrom'] as $cnt => $seatfrom) 
				{
					/*seat count */
					$Scount = $this->db->count_all_results('em_seats');
					$st_count = $Scount+1;
					$seat = strtoupper($_POST['seatname'][$cnt]);
					$seatto = $_POST['seatto'][$cnt];
					$seatfee = $_POST['seatfee'][$cnt];
					$refund_perc = $_POST['seatrefund'][$cnt];
					
					$data4 = [
								'event'               => $event,
								'seat'                => $seat,
								'seat_from'           => $seatfrom,
								'seat_to'             => $seatto,
								'reg_fee'             => $seatfee,
								'refund_perc'         => $refund_perc,
								'created_by'    	  => $user_id,
								'created_at'    	  => time()
							];
					$query4 = $this->db->insert('em_seats', $data4);
				}
			}		
            //create_activity('Added '.$data['name'].'distributor_commission'); //create an activity
            return true;
        }
        return false;
	}
//
/*Invitation*/
	public function send_invitation()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$event = $this->input->post('event');
		/*check user is selected photo*/
		 if ($_FILES['userfile']['name'] != '') {
			$upload_dir = './uploads/invitation/';;
            if (!file_exists($upload_dir))
            mkdir($upload_dir); 				//create directory if not found.
            $config['upload_path'] 			= $upload_dir;
            $config['allowed_types']        = 'gif|jpg|png';
			$config['image_library'] 		= 'gd2';
			$config['maintain_ratio']	    = TRUE;
			$config['width']         		= 200;
			$config['height']      		    = 200;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
        	//unlink($photo); // delete original photo
			$this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) 
			{
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else 
			{
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
				//update status 
							$data = [
							'invitation'               => $photoName,
							'modified_by'               => $user_id,
							'modified_at'               => time()
						];
				
						$query = $this->db->where('event', $event)->update('em_events', $data);
						if($query)
						{
							return true;
						}
						else
						{
							return false;
						}
                // $this->photoResize($fullPhoto); // resize now
            }
        }
		else
		{
			return false;
		}
		//
	}
	public function send_invitation_sms() 
	{
		$event = $this->input->post('sms_event');
		$joined = $this->input->post('sms_joined');
		/*$selected = $this->input->post('sms_selected');*/
		$sms = $this->input->post('sms_sms');
		$sms_msg = $this->input->post('sms_msg');
		
		$get_event_name = $this->db->get_where('em_events', ['event'=>$event]);
        foreach($get_event_name->result() as $ev);
		$event_name = $ev->name;
		
		$send_now = $this->notification_model->EM_send_invitation_sms($event,$event_name,$joined,$sms,$sms_msg);
		return true;
	}
	public function send_invitation_email() 
	{
		$event = $this->input->post('email_event');
		$joined = $this->input->post('email_joined');
		$selected = $this->input->post('email_selected');
		$email_msg = $this->input->post('email_msg');
		
		$event_details = $this->db->get_where('em_events', ['event' => $event]);
		 foreach ($event_details->result() as $ev);
		 $start = $ev->start_date;
		 $end = $ev->end_date;
		 $event_name = $ev->name;
		 
		$send_now = $this->notification_model->EM_send_invitation_email($event,$joined,$selected,$start,$end,$email_msg,$event_name);
		return true;
	}
//
/* List */
	public function Seat_count($event) 
	{
		$query = $this->db->get_where('em_users', ['event'=>$event]);
		if($query->num_rows() > 0)
		{
			$count = 0;
			foreach($query->result() as $re)
			{
				$count = $count + ($re->no_of_seats);
			}
			return $count;
		}
		else
		{
			return 0;
		}
	}
	public function Reg_count($event) 
	{
		$where_array = " event = '".$event."'  ";
		$query = $this->db->where($where_array )->count_all_results('em_users');
		return $query;
	}
	public function Sponsorship_count($event) 
	{
		$where_array = " event = '".$event."'  ";
		$query = $this->db->where($where_array )->count_all_results('em_user_sponsorship');
		return $query;
	}
	public function Request_count($event) 
	{
		$where_array = " event = '".$event."'  ";
		$query = $this->db->where($where_array )->count_all_results('em_user_requests');
		return $query;
	}
	public function Total_contribution($event) 
	{
		$where_array = " event = '".$event."'  ";
		$query = $this->db->where($where_array )->get('em_user_sponsorship');
		$sum = 0 ;
		if ($query->num_rows() > 0) 
		{
			foreach ($query->result() as $r)
			{
				$sum = $sum + $r->amount;
			}
			
		}
		
		return $sum;
	}
	public function Total_registration($event) 
	{
		$where_array = " event = '".$event."'  ";
		$query = $this->db->where($where_array )->get('em_user_seats');
		$sum = 0 ;
		if ($query->num_rows() > 0) 
		{
			foreach ($query->result() as $seats) 
			 {
				 $sum = $sum + $seats->reg_fee;
			 }
		}
		
		return $sum;
	}
	public function SendListCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser == 11 || $currentUser == 39)
		{
			$where_array = " status=1 ";
			$query = $this->db->where($where_array )->count_all_results('em_events');
		}else
		{
			$where_array = " created_by = ".$user_id." AND status=1 ";
			$query = $this->db->where($where_array )->count_all_results('em_events');
		}
		
		return $query;
	}
	public function SendList($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$rolename = singleDbTableRow($user_id)->rolename;
	
	
	if ($rolename == '11' || $rolename == '39') 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "em_events";	
			$where_array = " event like '%".$searchValue."%' AND status=1 ";														
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{		
			$where_array = " status=1 ";								
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('em_events');
		}
	}
	else 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "em_events";	
			$where_array = " created_by = ".$user_id." AND event like '%".$searchValue."%' AND status=1 ";	
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{	
			$table_name = "em_events";	
			$where_array = " created_by = ".$user_id." AND status=1 ";								
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 
		}
	}
	return $query;
	}
	/* Contractor */
	public function C_Payment_listCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$where_array = " give_to = ".$user_id." ";
		$query = $this->db->where($where_array )->count_all_results('em_sponsorship');
		return $query;
	}
	public function C_Payments($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	
		if($searchValue != '')																							
		{																												
			$table_name = "em_sponsorship";	
			$where_array = " give_to = ".$user_id." AND title like '%".$searchValue."%' ";	
			$query = $this->db->group_by('event')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{	
			$table_name = "em_sponsorship";	
			$where_array = " give_to = ".$user_id."";								
			$query = $this->db->group_by('event')->limit($limit, $start)->where($where_array )->get($table_name); 
		}
	
	return $query;
	}
	public function contractor_amount_request()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$data = [
			'event'               => $this->input->post('r_event'),
			'sponsorship'         => $this->input->post('r_sponsor'),
			'type'                => 'amount',
			'amount'              => $this->input->post('r_amount'),
			'contractor'		  => 1,
			'description'         => $this->input->post('r_desc'),
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_contractor_request', $data);
			if($query)
			{
				return true;
			}
			else
			{
				return false;
            }
        
	}
	public function contractor_message_send()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$data = [
			'event'               => $this->input->post('r_event'),
			'sponsorship'         => $this->input->post('r_sponsor'),
			'type'                => 'message',
			'contractor'		  => 1,
			'description'         => $this->input->post('m_msg'),
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_contractor_request', $data);
			if($query)
			{
				return true;
			}
			else
			{
				return false;
            }
        
	}
	public function contractor_send_receipt()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		/*check user is selected photo*/
		 if ($_FILES['userfile']['name'] != '') {
			$upload_dir = './uploads/invitation/';;
            if (!file_exists($upload_dir))
            mkdir($upload_dir); 				//create directory if not found.
            $config['upload_path'] 			= $upload_dir;
            $config['allowed_types']        = 'gif|jpg|png';
			$config['image_library'] 		= 'gd2';
			$config['maintain_ratio']	    = TRUE;
			$config['width']         		= 200;
			$config['height']      		    = 200;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
        	//unlink($photo); // delete original photo
			$this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) 
			{
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else 
			{
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
				
						$data = [
			'event'               => $this->input->post('r_event'),
			'sponsorship'         => $this->input->post('r_sponsor'),
			'type'                => 'receipt',
			'contractor'		  => 1,
			'receipt_img'         => $photoName,
			'description'         => $this->input->post('re_desc'),
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_contractor_request', $data);
						
						if($query)
						{
							return true;
						}
						else
						{
							return false;
						}
                // $this->photoResize($fullPhoto); // resize now
            }
        }
		else
		{
			return false;
		}
		//
	}
	public function Contractor_message_outbox($event,$sponsorship)
    {
		$user_info = $this->session->userdata('logged_user');
       	$user_id = $user_info['user_id'];
		
      $where_array =" event = '".$event."' AND sponsorship = '".$sponsorship."' AND contractor = 1 AND created_by = ".$user_id." AND type = 'message'";
      $table_name="em_contractor_request";
      $query = $this->db->where($where_array )->get($table_name);
        
      return $query;
        
    }
	public function Contractor_receipt_outbox($event,$sponsorship)
    {
		$user_info = $this->session->userdata('logged_user');
       	$user_id = $user_info['user_id'];
		
      $where_array =" event = '".$event."' AND sponsorship = '".$sponsorship."' AND contractor = 1 AND created_by = ".$user_id." AND type = 'receipt'";
      $table_name="em_contractor_request";
      $query = $this->db->where($where_array )->get($table_name);
        
      return $query;
        
    }
	public function Contractor_request_outbox($event,$sponsorship)
    {
		$user_info = $this->session->userdata('logged_user');
       	$user_id = $user_info['user_id'];
		
      $where_array =" event = '".$event."' AND sponsorship = '".$sponsorship."' AND contractor = 1 AND created_by = ".$user_id." AND type = 'amount'";
      $table_name="em_contractor_request";
      $query = $this->db->where($where_array )->get($table_name);
        
      return $query;
        
    }
	public function Contractor_message_inbox($event,$sponsorship)
    {
		$user_info = $this->session->userdata('logged_user');
       	$user_id = $user_info['user_id'];
		
      $where_array =" event = '".$event."' AND sponsorship = '".$sponsorship."' AND contractor = 0  AND type = 'message'";
      $table_name="em_contractor_request";
      $query = $this->db->where($where_array )->get($table_name);
        
      return $query;
        
    }
	public function Contractor_receipt_inbox($event,$sponsorship)
    {
		$user_info = $this->session->userdata('logged_user');
       	$user_id = $user_info['user_id'];
		
      $where_array =" event = '".$event."' AND sponsorship = '".$sponsorship."' AND contractor = 0 AND   type = 'receipt'";
      $table_name="em_contractor_request";
      $query = $this->db->where($where_array )->get($table_name);
        
      return $query;
        
    }
	public function Contractor_request_inbox($event,$sponsorship)
    {
		$user_info = $this->session->userdata('logged_user');
       	$user_id = $user_info['user_id'];
		
      $where_array =" event = '".$event."' AND sponsorship = '".$sponsorship."' AND contractor = 0  AND type = 'amount'";
      $table_name="em_contractor_request";
      $query = $this->db->where($where_array )->get($table_name);
        
      return $query;
        
    }
	/* \Contractor */
	//
	public function organiser_amount_request()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$data = [
			'event'               => $this->input->post('r_event'),
			'sponsorship'         => $this->input->post('r_sponsor'),
			'type'                => 'amount',
			'amount'              => $this->input->post('r_amount'),
			'contractor'		  => 0,
			'description'         => $this->input->post('r_desc'),
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_contractor_request', $data);
			if($query)
			{
				return true;
			}
			else
			{
				return false;
            }
        
	}
	public function organiser_message_send()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$data = [
			'event'               => $this->input->post('r_event'),
			'sponsorship'         => $this->input->post('r_sponsor'),
			'type'                => 'message',
			'contractor'		  => 0,
			'description'         => $this->input->post('m_msg'),
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_contractor_request', $data);
			if($query)
			{
				return true;
			}
			else
			{
				return false;
            }
        
	}
	public function organiser_send_receipt()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		/*check user is selected photo*/
		 if ($_FILES['userfile']['name'] != '') {
			$upload_dir = './uploads/invitation/';;
            if (!file_exists($upload_dir))
            mkdir($upload_dir); 				//create directory if not found.
            $config['upload_path'] 			= $upload_dir;
            $config['allowed_types']        = 'gif|jpg|png';
			$config['image_library'] 		= 'gd2';
			$config['maintain_ratio']	    = TRUE;
			$config['width']         		= 200;
			$config['height']      		    = 200;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
        	//unlink($photo); // delete original photo
			$this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) 
			{
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else 
			{
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
				
						$data = [
			'event'               => $this->input->post('r_event'),
			'sponsorship'         => $this->input->post('r_sponsor'),
			'type'                => 'receipt',
			'contractor'		  => 0,
			'receipt_img'         => $photoName,
			'description'         => $this->input->post('re_desc'),
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_contractor_request', $data);
						
						if($query)
						{
							return true;
						}
						else
						{
							return false;
						}
                // $this->photoResize($fullPhoto); // resize now
            }
        }
		else
		{
			return false;
		}
		//
	}
	public function organiser_message_outbox($event,$sponsorship)
    {
		$user_info = $this->session->userdata('logged_user');
       	$user_id = $user_info['user_id'];
		
      $where_array =" event = '".$event."' AND sponsorship = '".$sponsorship."' AND contractor = 0 AND created_by = ".$user_id." AND type = 'message'";
      $table_name="em_contractor_request";
      $query = $this->db->where($where_array )->get($table_name);
        
      return $query;
        
    }
	public function organiser_receipt_outbox($event,$sponsorship)
    {
		$user_info = $this->session->userdata('logged_user');
       	$user_id = $user_info['user_id'];
		
      $where_array =" event = '".$event."' AND sponsorship = '".$sponsorship."' AND contractor = 0 AND created_by = ".$user_id." AND type = 'receipt'";
      $table_name="em_contractor_request";
      $query = $this->db->where($where_array )->get($table_name);
        
      return $query;
        
    }
	public function organiser_request_outbox($event,$sponsorship)
    {
		$user_info = $this->session->userdata('logged_user');
       	$user_id = $user_info['user_id'];
		
      $where_array =" event = '".$event."' AND sponsorship = '".$sponsorship."' AND contractor = 0 AND created_by = ".$user_id." AND type = 'amount'";
      $table_name="em_contractor_request";
      $query = $this->db->where($where_array )->get($table_name);
        
      return $query;
        
    }
	public function organiser_message_inbox($event,$sponsorship)
    {
		$user_info = $this->session->userdata('logged_user');
       	$user_id = $user_info['user_id'];
		
      $where_array =" event = '".$event."' AND sponsorship = '".$sponsorship."' AND contractor = 1  AND type = 'message'";
      $table_name="em_contractor_request";
      $query = $this->db->where($where_array )->get($table_name);
        
      return $query;
        
    }
	public function organiser_receipt_inbox($event,$sponsorship)
    {
		$user_info = $this->session->userdata('logged_user');
       	$user_id = $user_info['user_id'];
		
      $where_array =" event = '".$event."' AND sponsorship = '".$sponsorship."' AND contractor = 1  AND type = 'receipt'";
      $table_name="em_contractor_request";
      $query = $this->db->where($where_array )->get($table_name);
        
      return $query;
        
    }
	public function organiser_request_inbox($event,$sponsorship)
    {
		$user_info = $this->session->userdata('logged_user');
       	$user_id = $user_info['user_id'];
		
      $where_array =" event = '".$event."' AND sponsorship = '".$sponsorship."' AND contractor = 1   AND type = 'amount'";
      $table_name="em_contractor_request";
      $query = $this->db->where($where_array )->get($table_name);
        
      return $query;
        
    }
	//
	/* my contributions */
	public function my_c_listCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$where_array = " user = ".$user_id." ";
		$query = $this->db->where($where_array )->count_all_results('em_user_sponsorship');
		return $query;
	}
	public function my_contributions($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	
		if($searchValue != '')																							
		{																												
			$table_name = "em_user_sponsorship";	
			$where_array = " user = ".$user_id." AND event like '%".$searchValue."%' ";	
			$query = $this->db->group_by('event')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{	
			$table_name = "em_user_sponsorship";	
			$where_array = " user = ".$user_id."";								
			$query = $this->db->group_by('event')->limit($limit, $start)->where($where_array )->get($table_name); 
		}
	
	return $query;
	}
	//
	/* joined events */
	public function joined_listCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$where_array = " user = ".$user_id." ";
		$query = $this->db->where($where_array )->count_all_results('em_users');
		return $query;
	}
	public function joined_events($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	
		if($searchValue != '')																							
		{																												
			$table_name = "em_users";	
			$where_array = " user = ".$user_id." AND event like '%".$searchValue."%' ";	
			$query = $this->db->group_by('event')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{	
			$table_name = "em_users";	
			$where_array = " user = ".$user_id."";								
			$query = $this->db->group_by('event')->limit($limit, $start)->where($where_array )->get($table_name); 
		}
	
	return $query;
	}
	//
	//
	public function event_create_mine()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		/*check user is selected photo*/
		 if ($_FILES['userfile']['name'] != '') {
			$upload_dir = './uploads/invitation/';;
            if (!file_exists($upload_dir))
            mkdir($upload_dir); 				//create directory if not found.
            $config['upload_path'] 			= $upload_dir;
            $config['allowed_types']        = 'gif|jpg|png';
			$config['image_library'] 		= 'gd2';
			$config['maintain_ratio']	    = TRUE;
			$config['width']         		= 200;
			$config['height']      		    = 200;

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
        	//unlink($photo); // delete original photo
			$this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) 
			{
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else 
			{
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
        }
		else
		{
			$photoName ='';
		}
		//
		/*event count */
		$count = $this->db->count_all_results('em_events');
		$em_count = $count+1;
		
		/*if($this->input->post('open_to_all'))
		{
			$open = 1;
		}
		else
		{
			$open = 0;
		}*/
		//
		if($this->input->post('select_users') == 1)
		{
			$s_users = $this->input->post('my_users');
			if(count($s_users) > 0)
			{
				$selected_users ='';
				
				foreach($s_users as $s_user)
				{
					$selected_users = $s_user.','.$selected_users;
					
				}
			}
			else
			{
				$selected_users = '';
			}
			$open = 0;
			$selected_bg = 0;
			$selected_roles = 0;
			$selected_area = 0;
			
		}
		else 
		{
			$selected_users = '';
			$open = 1;
			//
			$selected_bg = '';
			$selected_area = '';
			if(!empty($_POST['sbg'])) 
			{
				foreach($_POST['sbg'] as $cnt => $sbg) 
				{
					$selected_bg = $sbg.','.$selected_bg;
					$selected_area = $_POST['sarea'][$cnt].','.$selected_area;
					
				}
			}
			//
			$open_role = $this->input->post('open_role');
			if(count($open_role) > 0)
			{
				$selected_roles ='';
				foreach($open_role as $role)
				{
					$selected_roles = $role.','.$selected_roles;
				}
			}
			else
			{
				$selected_roles = '';
			}
		}
		//
		
		$categ = $this->input->post('categ');
		 $get_categ_name = $this->db->get_where('em_category', ['id'=>$categ]);
		foreach($get_categ_name->result() as $h);
		$categ_name = $h->name;
		//
		$event ='EVE'.strtoupper(substr($categ_name,0,3)).$em_count;
		//
		if($this->input->post('send_sms'))
		{
			$sms_numbers = $this->input->post('send_sms');
			
			/*$sms_number = explode(',',$sms_numbers);
			foreach($sms_number as $number)
			{
				$send_now = $this->notification_model->EM_invite($event,$number);
			}*/
			
		}
		//
		/* set reg_fee=1 if */
		if(!empty($_POST['seatfrom'])) 
		{
			$reg_fee =1;
		}
		else
		{
			$reg_fee =0;
		}
		/* */
		$data = [
			'event'               => $event,
			'budget'              => $this->input->post('budget'),
			'reg_fee'             => $reg_fee,
			'name'                => $this->input->post('name'),
			'category'            => $this->input->post('categ'),
			'subcategory'        => $this->input->post('sub_categ'),
			'seat_category'       => $this->input->post('seat_categ'),
			'seat_subcategory'    => $this->input->post('seat_sub_categ'),
			'selected_users'      => $selected_users,
			'selected_bg'         => $selected_bg,
			'selected_roles'      => $selected_roles,
			'selected_area'       => $selected_area,
			'sms_numbers'         =>$this->input->post('send_sms'),
			'location'            => $this->input->post('location'),
			'venue'               => $this->input->post('venue'),
			'open_to_all'         => $open,
			'regstart_date'       => $this->input->post('rf_time'),
            'regend_date'         => $this->input->post('rt_time'),
			'start_date'          => $this->input->post('f_time'),
            'end_date'            => $this->input->post('t_time'),
			'host'         		  => $this->input->post('host'),
			'organiser'		      => $user_id,
			'guest'		          => $this->input->post('guest'),
			'additional_guests'	  => $this->input->post('add_guest'),
			'participants'		  => $this->input->post('participants'),
			'status'		      => 0,
			'approved'		      => 0,
			'invitation'		  => $photoName,
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_events', $data);
			$query1 = $this->db->insert('em_track', $data);
		/* */
		if($query)
        {
			/* adding labels into em_labels table*/
			if(!empty($_POST['label'])) 
			{
				foreach($_POST['label'] as $cnt => $label) 
				{
					$data2 = [
								'event'               => $event,
								'e_label'             => $label,
								'created_by'    	  => $user_id,
								'created_at'    	  => time()
							];
					$query2 = $this->db->insert('em_labels', $data2);
					
				}
			}
			
			/* adding seats and reg fee into em_seats table */
			if(!empty($_POST['seatfrom'])) 
			{
				foreach($_POST['seatfrom'] as $cnt => $seatfrom) 
				{
					/*seat count */
					$Scount = $this->db->count_all_results('em_seats');
					$st_count = $Scount+1;
					$seat = strtoupper($_POST['seatname'][$cnt]);
					$seatto = $_POST['seatto'][$cnt];
					$seatfee = $_POST['seatfee'][$cnt];
					$refund_perc = $_POST['seatrefund'][$cnt];
					
					$data4 = [
								'event'               => $event,
								'seat'                => $seat,
								'seat_from'           => $seatfrom,
								'seat_to'             => $seatto,
								'reg_fee'             => $seatfee,
								'refund_perc'         => $refund_perc,
								'created_by'    	  => $user_id,
								'created_at'    	  => time()
							];
					$query4 = $this->db->insert('em_seats', $data4);
				}
			}		
            //create_activity('Added '.$data['name'].'distributor_commission'); //create an activity
            return true;
        }
        return false;
	}
	//
	//
	public function Event_requestListCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		
			$where_array = " approved = 0 ";
			$query = $this->db->where($where_array )->count_all_results('em_events');
		
		return $query;
	}
	public function Event_requestList($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$rolename = singleDbTableRow($user_id)->rolename;
	
		if($searchValue != '')																							
		{																												
			$table_name = "em_events";	
			$where_array = " approved = 0 AND event like '%".$searchValue."%'";	
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{	
			$table_name = "em_events";	
			$where_array = " approved = 0  ";								
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 
		}
	
	return $query;
	}
	//
	public function event_accept_request($event)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		//
		$receiver_referral_code = singleDbTableRow($user_id)->referral_code;
		//
		 $get_sender = $this->db->get_where('em_events', ['event'=>$event]);
		foreach($get_sender->result() as $sc);
		 $sender = $sc->created_by;
		 $amount = $sc->budget;
		 $sender_referral_code = singleDbTableRow($sender)->referral_code;
		//
		//
		if($this->input->post('select_users') == 1)
		{
			$s_users = $this->input->post('my_users');
			if(count($s_users) > 0)
			{
				$selected_users ='';
				$send_now = '';
				$event_name=$this->input->post('name');
				foreach($s_users as $s_user)
				{
					$selected_users = $s_user.','.$selected_users;
					//
					$get_phn = $this->db->get_where('users', ['id'=>$s_user]);
					foreach($get_phn->result() as $nm);
					$sms_numbers = $nm->contactno.','.$sms_numbers;
					//
					$send_now = $this->notification_model->EM_invite($event,$event,$sms_numbers);
				}
			}
			else
			{
				$selected_users = '';
			}
			$open = 0;
			$selected_bg = 0;
			$selected_roles = 0;
			$selected_area = 0;
			
		}
		else 
		{
			$selected_users = '';
			$open = 1;
			//
			$selected_bg = '';
			$selected_area = '';
			if(!empty($_POST['sbg'])) 
			{
				foreach($_POST['sbg'] as $cnt => $sbg) 
				{
					$selected_bg = $sbg.','.$selected_bg;
					/*sms*/
					$pin = singleDbTableRow($_POST['sarea'][$cnt], 'area')->pincode;
					$where_array = " pincode IN (".$pin.") ";
					$query = $this->db->order_by('id', 'desc')->where($where_array )->get('user_address');
					if ($query->num_rows() > 0) 
					{
						$uphn = '';
						foreach ($query->result() as $r)
						{
							$uphn = singleDbTableRow($r->user_id, 'users')->contactno.','.$uphn;
						}
						$send_now = $this->notification_model->EM_invite($event,$event,$uphn);
					}
					/**/
					$selected_area = $_POST['sarea'][$cnt].','.$selected_area;
					
				}
			}
		}
		//
		//
		
		if($this->input->post('send_sms'))
		{
			$sms_numbers = $this->input->post('send_sms');
			$get_event_name = $this->db->get_where('em_events', ['event'=>$event]);
			foreach($get_event_name->result() as $ev);
			$event_name = $ev->name;
			$send_now = $this->notification_model->EM_invite($event,$event,$sms_numbers);
			
		}
		//
		
		$data = [
			'event'               => $event,
			'status'		      => $this->input->post('status'),
			'approved'		      => 1,
			'organised_by'    	  => $user_id,
			'modified_by'    	  => $user_id,
			'modified_at'    	  => time()
			];
			$query = $this->db->where('event', $event)->update('em_events', $data);
			$query1 = $this->db->where('event', $event)->update('em_track', $data);
		/* */
		if($query)
        {
			/* paytype*/$get_paytype = $this->db->get_where('business_groups', ['id'=>23]);
				foreach($get_paytype->result() as $p);
				 $pay = $p->pay_type;/* */
			/*payment*/
				$pay_by_referral_code 	= 	$sender_referral_code;	// Sender's referral_code, ex : 5559990001
				$pay_to_referral_code 	= 	 $receiver_referral_code;// Receiver's referral_code, ex : 5164830972
				$amount_to_pay		  	=	$amount;			// Total amont to pay (or) transfer, ex : 100
				$pay_spec_type			=	$pay;				// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
				$transaction_remarks	=	'Event Management ';	// remarks to insert into invoice table, ex : "Transfer Values";
				$pm_mode				=	'wallet';			// points_mode, ex : wallet, loyality, discount.
				
				
				$insert = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);
			//
			/* adding sponsorship into em_sponsorship table */
			if(!empty($_POST['sfor'])) 
			{
				foreach($_POST['sfor'] as $cnt => $sfor) 
				{
					$sponsorship = $event.strtoupper( substr($sfor, 0, 4 ) );
					$charge = $_POST['scharge'][$cnt];
					$to = $_POST['sto'][$cnt];
					
					$data3 = [
								'event'               => $event,
								'sponsorship'         => $sponsorship,
								'title'               => $sfor,
								'charge'              => $charge,
								'give_to'              => $to,
								'created_by'    	  => $user_id,
								'created_at'    	  => time()
							];
					$query3 = $this->db->insert('em_sponsorship', $data3);
				}
			}
			return true;
		}		
          else
		  {
           	return false; 
        	}
       
	}
	/*category*/
	public function CategoryListCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser == 11 || $currentUser == 39)
		{
			$where_array = " category_type ='main'  ";
			$query = $this->db->where($where_array )->count_all_results('em_category');
		}else
		{
			$where_array = " created_by = ".$user_id." AND category_type ='main' ";
			$query = $this->db->where($where_array )->count_all_results('em_category');
		}
		
		return $query;
	}
	public function CategoryList($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$rolename = singleDbTableRow($user_id)->rolename;
	
	
	if ($rolename == '11' || $rolename == '39') 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "em_category";	
			$where_array = " name like '%".$searchValue."%'  AND category_type = 'main'";														
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{										
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where('category_type', 'main')->get('em_category');
		}
	}
	else 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "em_category";	
			$where_array = " created_by = ".$user_id." AND name like '%".$searchValue."%' AND category_type = 'main'";	
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{	
			$table_name = "em_category";	
			$where_array = " created_by = ".$user_id."  AND category_type = 'main' ";								
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 
		}
	}
	return $query;
	}
	public function Sub_CategoryListCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser == 11 || $currentUser == 39)
		{
			$where_array = " category_type ='sub' ";
			$query = $this->db->where($where_array )->count_all_results('em_category');
		}else
		{
			$where_array = " created_by = ".$user_id." AND category_type ='sub' ";
			$query = $this->db->where($where_array )->count_all_results('em_category');
		}
		
		return $query;
	}
	public function Sub_CategoryList($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$rolename = singleDbTableRow($user_id)->rolename;
	
	
	if ($rolename == '11' || $rolename == '39') 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "em_category";	
			$where_array = " name like '%".$searchValue."%'  AND category_type = 'sub'";														
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{										
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where('category_type', 'sub')->get('em_category');
		}
	}
	else 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "em_category";	
			$where_array = " created_by = ".$user_id." AND name like '%".$searchValue."%' AND category_type = 'sub'";	
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{	
			$table_name = "em_category";	
			$where_array = " created_by = ".$user_id."  AND category_type = 'sub' ";								
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 
		}
	}
	return $query;
	}
	//
	public function SeatcategoryListCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser == 11 || $currentUser == 39)
		{
			$where_array = " category_type ='main'  ";
			$query = $this->db->where($where_array )->count_all_results('em_seat_category');
		}else
		{
			$where_array = " created_by = ".$user_id." AND category_type ='main' ";
			$query = $this->db->where($where_array )->count_all_results('em_seat_category');
		}
		
		return $query;
	}
	public function SeatcategoryList($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$rolename = singleDbTableRow($user_id)->rolename;
	
	
	if ($rolename == '11' || $rolename == '39') 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "em_seat_category";	
			$where_array = " name like '%".$searchValue."%'  AND category_type = 'main'";														
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{										
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where('category_type', 'main')->get('em_seat_category');
		}
	}
	else 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "em_seat_category";	
			$where_array = " created_by = ".$user_id." AND name like '%".$searchValue."%' AND category_type = 'main'";	
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{	
			$table_name = "em_seat_category";	
			$where_array = " created_by = ".$user_id."  AND category_type = 'main' ";								
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 
		}
	}
	return $query;
	}
	public function Seatsub_CategoryListCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser == 11 || $currentUser == 39)
		{
			$where_array = " category_type ='sub' ";
			$query = $this->db->where($where_array )->count_all_results('em_seat_category');
		}else
		{
			$where_array = " created_by = ".$user_id." AND category_type ='sub' ";
			$query = $this->db->where($where_array )->count_all_results('em_seat_category');
		}
		
		return $query;
	}
	public function Seatsub_CategoryList($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$rolename = singleDbTableRow($user_id)->rolename;
	
	
	if ($rolename == '11' || $rolename == '39') 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "em_seat_category";	
			$where_array = " name like '%".$searchValue."%'  AND category_type = 'sub'";														
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{										
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where('category_type', 'sub')->get('em_seat_category');
		}
	}
	else 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "em_seat_category";	
			$where_array = " created_by = ".$user_id." AND name like '%".$searchValue."%' AND category_type = 'sub'";	
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{	
			$table_name = "em_seat_category";	
			$where_array = " created_by = ".$user_id."  AND category_type = 'sub' ";								
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 
		}
	}
	return $query;
	}
	//
	public function EventListCount() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser == 11 || $currentUser == 39)
		{
			$query = $this->db->count_all_results('em_events');
		}else
		{
			$where_array = " created_by = ".$user_id."  ";
			$query = $this->db->where($where_array )->count_all_results('em_events');
		}
		
		return $query;
	}
	public function EventList($limit = 0, $start = 0)
	{
	
	$search = $this->input->get('search');	
	$searchValue = $search['value'];
	
	$searchByID = '';				
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$rolename = singleDbTableRow($user_id)->rolename;
	
	
	if ($rolename == '11' || $rolename == '39') 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "em_events";	
			$where_array = " event like '%".$searchValue."%'";														
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{										
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('em_events');
		}
	}
	else 
	{
		if($searchValue != '')																							
		{																												
			$table_name = "em_events";	
			$where_array = " created_by = ".$user_id." AND event like '%".$searchValue."%'";	
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
		}											
		else{	
			$table_name = "em_events";	
			$where_array = " created_by = ".$user_id."  ";								
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 
		}
	}
	return $query;
	}
	//
	public function Export_to_pdf()
	{
	
					
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$rolename = singleDbTableRow($user_id)->rolename;
	
	
	if ($rolename == '11' || $rolename == '39') 
	{
												
			$query = $this->db->order_by('id', 'desc')->get('em_events');
		
	}
	else 
	{
			
			$table_name = "em_events";	
			$where_array = " created_by = ".$user_id."  ";								
			$query = $this->db->order_by('id', 'desc')->where($where_array )->get($table_name); 
		
	}
	return $query;
	}
/* ends */
//fund details
public function get_fund_details($sponsorship)
{
	
  $where_array =" sponsorship = '".$sponsorship."'";
  $table_name="em_fund_transfer";
   $query = $this->db->order_by('id')->where($where_array )->get($table_name);
   return $query;
	
} 
/* Users event List */
	public function User_location() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$get_postal_code = $this->db->get_where('user_address', ['user_id'=>$user_id]);
		if($get_postal_code ->num_rows() >0)
		{
			foreach($get_postal_code->result() as $p);
			$postal_code = $p->pincode;
			$table_name = "area";	
			$where_array = "find_in_set('".$postal_code."',pincode) <> 0  ";								
			$query = $this->db->group_by('location', 'desc')->where($where_array )->get($table_name);
			if ($query->num_rows() > 0) 
			{
				/*foreach ($query->result() as $r)
				{
					$locations[] = $r->location;
				}
				$location = implode(',',$locations);
				return $location;*/
				foreach ($query->result() as $r);
				$area = $r->id;
				return $area;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	public function User_events() 
	{
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$user_role = singleDbTableRow($user_id)->rolename;
		$locations = $this ->User_location();
		if($locations)
		{
			//$where_array = " location IN (".$locations.") OR open_to_all = 1 OR find_in_set(".$user_id.",selected_users) <> 0 AND approved =1";
			//$where_array = " selected_area = ".$locations." AND  find_in_set(".$user_role.",selected_roles) <> 0 OR find_in_set(".$user_id.",selected_users) <> 0 AND approved =1";
			$where_array = " find_in_set(".$locations.",selected_area) <> 0 AND  find_in_set(".$user_role.",selected_roles) <> 0 OR find_in_set(".$user_id.",selected_users) <> 0 AND approved =1";
		}
		else
		{
			$where_array = "  find_in_set(".$user_id.",selected_users) <> 0 AND approved =1";
		}
			$table_name = "em_events";	
											
			$query = $this->db->order_by('id', 'desc')->where($where_array )->get($table_name);
			if ($query->num_rows() > 0) 
			{
				foreach ($query->result() as $r)
				{
					$events[] = $r->event;
				}
				$event = implode(',',$events);
				return $event;
			}
			else
			{
				return false;
			}
		
	}
	public function UserEventListCount() 
	{
		$events = $this->User_events();
		if($events)
		{
			return count($events);
		}
		else
		{
			return 0;
		}
	}
	public function UserEventList()
	{
		$events = $this->User_events();
		if($events)
		{
			return $events;
		}
		else
		{
			 return false;
		}
	}
/* ends */
/* user join */
	public function user_join($event,$seats)
    {
      	/*logged user details*/
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$sender_referral_code = singleDbTableRow($user_id)->referral_code;
		//
		/*event creator details*/
		 $get_receiver = $this->db->get_where('em_events', ['event'=>$event]);
		foreach($get_receiver->result() as $rc);
		 $receiver = $rc->created_by;
		 $receiver_referral_code = singleDbTableRow($receiver)->referral_code;
		//
		$seat = explode(',',$seats);
		$fee =0;
		$j =count($seat)-1;
		/* Insert into em_user_seats*/
		for($i=0;$i<$j;$i++)
		{
			$st = $seat[$i];
			$where_array = " event = '".$event."' AND seat_from <= ".$st." AND seat_to >= ".$st." ";
     		$table_name="em_seats";
       		$query = $this->db->where($where_array )->get($table_name);
			if($query->num_rows() > 0)
			{
				 foreach($query->result() as $re);
				 $fee =$fee + $re->reg_fee;
				 $seat_name = $re->seat;
				 $seat_no = $st;
				 $data = [
			'event'               => $event,
			'seat'                => $seat_name,
			'seat_no'             => $seat_no,
			'reg_fee'             => $re->reg_fee,
			'user'                => $user_id,
			'status'              => 1,
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query1 = $this->db->insert('em_user_seats', $data);
			
			}
		}
		return $event;
		
    } 
	public function event_user_seats($event)
    {
      	/*logged user details*/
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$sender_referral_code = singleDbTableRow($user_id)->referral_code;
		//
		/*event creator details*/
		 $get_receiver = $this->db->get_where('em_events', ['event'=>$event]);
		foreach($get_receiver->result() as $rc);
		 $receiver = $rc->organised_by;
		 $receiver_referral_code = singleDbTableRow($receiver)->referral_code;
		//
		$fee =0;
		/*Update with holder name*/
		$seats = $this->db->get_where('em_user_seats', ['event'=>$event,'user' => $user_id]);
		$seat_count = $seats->num_rows();
		foreach($seats->result() as $st)
		{
			$seat_holder_name =$this->input->post($st->id);
			$fee = $fee + $st->reg_fee;
			$data2 = [
							'seat_holder_name'        => $seat_holder_name,
							'modified_by'               => $user_id,
							'modified_at'               => time()
						];
				
						$query2 = $this->db->where('id', $st->id)->update('em_user_seats', $data2);
		}
		//
		/*insert into em_users*/
		$data2 = [
			'event'               => $event,
			'user'                => $user_id,
			'no_of_seats'         =>$seat_count,
			'accept'              => 1,
			'sponsored'           => 0,
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query2 = $this->db->insert('em_users', $data2);
			if($query2)
			{
				/* paytype*/$get_paytype = $this->db->get_where('business_groups', ['id'=>23]);
				foreach($get_paytype->result() as $p);
				 $pay = $p->pay_type;/* */
				 
				$pay_by_referral_code 	= 	$sender_referral_code;	// Sender's referral_code, ex : 5559990001
				$pay_to_referral_code 	= 	 $receiver_referral_code;// Receiver's referral_code, ex : 5164830972
				$amount_to_pay		  	=	$fee;			// Total amont to pay (or) transfer, ex : 100
				$pay_spec_type			=	$pay;				// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
				$transaction_remarks	=	'Event Management Registration';	// remarks to insert into invoice table, ex : "Transfer Values";
				$pm_mode				=	'wallet';			// points_mode, ex : wallet, loyality, discount.
				
				
				$insert = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);

				return true;
			}
			else
			{
				return false;
			}
    } 
	public function event_join($event)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$sender_referral_code = singleDbTableRow($user_id)->referral_code;
		$data = [
			'event'               => $event,
			'user'                => $user_id,
			'accept'              => 1,
			'sponsored'           => 0,
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_users', $data);
			if($query)
			{
				/* paytype*/$get_paytype = $this->db->get_where('business_groups', ['id'=>23]);
				foreach($get_paytype->result() as $p);
				 $pay = $p->pay_type;/* */
				$pay_by_referral_code 	= 	$sender_referral_code;	// Sender's referral_code, ex : 5559990001
				$pay_to_referral_code 	= 	'ADMIN1001';// Receiver's referral_code, ex : 5164830972
				$amount_to_pay		  	=	100;			// Total amont to pay (or) transfer, ex : 100
				$pay_spec_type			=	$pay;				// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
				$transaction_remarks	=	'Event Management';	// remarks to insert into invoice table, ex : "Transfer Values";
				$pm_mode				=	'wallet';			// points_mode, ex : wallet, loyality, discount.
				
				
				$insert = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);

				return true;
			}
			else
			{
				return false;
			}
	}
	/* ends */
	/* user event_request */
	public function event_request($event)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$sender_referral_code = singleDbTableRow($user_id)->referral_code;
		$data = [
			'event'               => $event,
			'requested_by'                => $user_id,
			'requested_at'              => time(),
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_user_requests', $data);
			if($query)
			{
				return true;
			}
			else
			{
				return false;
			}
	}
	/* ends */
	/* user contribution */
	public function pay_now($amount,$sponsorID,$event)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$sender_referral_code = singleDbTableRow($user_id)->referral_code;
		//
		 $get_receiver = $this->db->get_where('em_events', ['event'=>$event]);
		foreach($get_receiver->result() as $rc);
		 $receiver = $rc->organised_by;
		 $receiver_referral_code = singleDbTableRow($receiver)->referral_code;
		//
		$data = [
			'event'               => $event,
			'user'                => $user_id,
			'amount'              => $amount,
			'sponsorship'         => $sponsorID,
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_user_sponsorship', $data);
			//update table 
			$data2 = [
           	'sponsored'               => 1,
			'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query2 = $this->db->where('event', $event,'user',$user_id)->update('em_users', $data2);
			if($query &&  $query2)
			{
				/* paytype*/$get_paytype = $this->db->get_where('business_groups', ['id'=>23]);
				foreach($get_paytype->result() as $p);
				 $pay = $p->pay_type;/* */
				 
				$pay_by_referral_code 	= 	$sender_referral_code;	// Sender's referral_code, ex : 5559990001
				$pay_to_referral_code 	= 	 $receiver_referral_code;// Receiver's referral_code, ex : 5164830972
				$amount_to_pay		  	=	$amount;			// Total amont to pay (or) transfer, ex : 100
				$pay_spec_type			=	$pay;				// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
				$transaction_remarks	=	'Event Management Contribution';	// remarks to insert into invoice table, ex : "Transfer Values";
				$pm_mode				=	'wallet';			// points_mode, ex : wallet, loyality, discount.
				
				
				$insert = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);

				return true;
			}
			else
			{
				return false;
			}
	}
	/* ends */
	
	/* fund Transfer */
	public function transfer_now($amount,$sponsorID,$event,$give_to)
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		//
		$receiver_referral_code = singleDbTableRow($give_to)->referral_code;
		//
		 $get_sender = $this->db->get_where('em_events', ['event'=>$event]);
		foreach($get_sender->result() as $sc);
		 $sender = $sc->organised_by;
		 $sender_referral_code = singleDbTableRow($sender)->referral_code;
		//
		$data = [
			'event'               => $event,
			'sponsorship'         => $sponsorID,
			'transferred_to'      => $give_to,
			'transferred_by'      => $user_id,
			'transferred_amount'  => $amount,
			'transferred_at'      => time(),
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query = $this->db->insert('em_fund_transfer', $data);
			//update table 
			$data2 = [
           	'transfer'               => 1,
			'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];
			$where_array = " event='".$event."' AND sponsorship = '".$sponsorID."' AND give_to=".$give_to."";
        $query2 = $this->db->where($where_array)->update('em_sponsorship', $data2);
			if($query &&  $query2)
			{
				/* paytype*/$get_paytype = $this->db->get_where('business_groups', ['id'=>23]);
				foreach($get_paytype->result() as $p);
				 $pay = $p->pay_type;/* */
				 
				$pay_by_referral_code 	= 	$sender_referral_code;	// Sender's referral_code, ex : 5559990001
				$pay_to_referral_code 	= 	 $receiver_referral_code;// Receiver's referral_code, ex : 5164830972
				$amount_to_pay		  	=	$amount;			// Total amont to pay (or) transfer, ex : 100
				$pay_spec_type			=	$pay;				// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
				$transaction_remarks	=	'Event Management Contribution';	// remarks to insert into invoice table, ex : "Transfer Values";
				$pm_mode				=	'wallet';			// points_mode, ex : wallet, loyality, discount.
				
				
				$insert = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);

				return true;
			}
			else
			{
				return false;
			}
	}
	/* ends */
	/* update */
	public function event_update()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$event_details = $this->db->get_where('em_events', ['event' => $this->input->post('event')]);
		foreach ($event_details->result() as $e)
		{
			$name = $e->name;
			$host = $e->host;
			$organiser = $e->organiser;
			$guest = $e->guest;
			$additional_guests = $e->additional_guests;
		}
		$data1 = [
			'name'                => $name,
			'host'                => $host,
			'organiser'           => $organiser,
			'guest'               => $guest,
			'additional_guests'   => $additional_guests,
			'event'               => $this->input->post('event'),
			'budget'              => $this->input->post('budget'),
			'location'            => $this->input->post('location'),
			'start_date'          => $this->input->post('f_time'),
            'end_date'            => $this->input->post('t_time'),
			'participants'		  => $this->input->post('participants'),
			'status'		      => $this->input->post('status'),
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
	$data2 = [
			'event'               => $this->input->post('event'),
			'budget'              => $this->input->post('budget'),
			'location'            => $this->input->post('location'),
			'start_date'          => $this->input->post('f_time'),
            'end_date'            => $this->input->post('t_time'),
			'participants'		  => $this->input->post('participants'),
			'status'		      => $this->input->post('status'),
			'modified_by'    	  => $user_id,
			'modified_at'    	  => time()
			];
			$query1 = $this->db->insert('em_track', $data1);
			$query2 = $this->db->where('event', $this->input->post('event'))->update('em_events', $data2);
			if($query1 && $query2 )
			{
				return $this->input->post('event');
			}
			else
			{
				return false;
			}
	}
	/* ends */
	/* CSV */
	public function export_to_csv($eve)
	{
			$event = $this->db->get_where('em_events', ['event' => $eve]);
			$labels = $this->db->get_where('em_labels', ['event' => $eve]);
			$sponsors = $this->db->get_where('em_sponsorship', ['event' => $eve]);
			$contribution = $this->db->get_where('em_user_sponsorship', ['event' => $eve]);
			
			$reg_count = $this->Reg_count($eve);
			$sponsorship_count =  $this->Sponsorship_count($eve);
			$request_count = $this->Request_count($eve);
			$contributions = $this->Total_contribution($eve);
			$filename='events'.time().'.csv';
			foreach ($event->result() as $e)
			{
				/* location*/ $get_location_name = $this->db->get_where('pincode', ['id'=>$e->location]);
				foreach($get_location_name->result() as $l);
				$location = $l->location;/* */
				/* host*/$get_host_name = $this->db->get_where('users', ['id'=>$e->host]);
				foreach($get_host_name->result() as $h);
				$host = $h->first_name.' '.$h->last_name;/* */
				/* organiser*/$get_org_name = $this->db->get_where('users', ['id'=>$e->organiser]);
				foreach($get_org_name->result() as $og);
				 $organiser = $og->first_name.' '.$og->last_name;/* */
				 /* guest*/$get_guest_name = $this->db->get_where('users', ['id'=>$e->guest]);
				foreach($get_guest_name->result() as $g);
				$guest = $g->first_name.' '.$g->last_name;/* */
				
			$csv= "Event :,".$e->name."\n";
			
			$csv .= "Name,Budget,Location,Start date,End Date,Host, Organiser,Guest, Additional Guest,Participants\n";
			$csv .= $e->name.",".$e->budget.",".$location.",".$e->start_date.",".$e->end_date.",".$host.",". $organiser.",".$guest.",".$e->additional_guests.",".$e->participants."\n";
			}
			$csv .= "\n";
			$csv .= "Regitration,Sponsors,Requets\n";
			$csv .= $reg_count.",".$sponsorship_count.",".$request_count."\n";
			$csv .= "\n";
			if (!empty($labels) && $labels->num_rows() > 0) {
				$csv .= "Custom labels\n";
				foreach ($labels->result() as $l)
				{
					$csv .= $l->e_label."\n";
				}
			}
			$csv .= "\n";
			if (!empty($sponsors) && $sponsors->num_rows() > 0)
			{
				$csv .= "Sponsor/Contribute\n";
				$csv .= "For,Charge,Sponsored Amount,Required Amount\n";
				foreach ($sponsors->result() as $s)
				{
					//
					$table_name = "em_user_sponsorship";	
					$where_array = " event ='". $e->event."' AND sponsorship = '".$s->sponsorship."' ";								
					$query = $this->db->where($where_array )->get($table_name);
					$sum = 0 ;
					if ($query->num_rows() > 0) 
					{
						foreach ($query->result() as $r)
						{
							$sum = $sum + $r->amount;
						}
						$required = ($s->charge) - $sum;
						
					}
					else
					{
						$required = $s->charge ;
					}
					//
					$csv .= $s->charge.",".$sum.",".$required."\n";
				}
			}
			$csv .= "\n";
			if (!empty($contribution) && $contribution->num_rows() > 0) 
			{
				$csv .= "Contributions\n";
				$csv .= "Sponsored For,Sponsored By,Sponsored Amount\n";
				foreach ($contribution->result() as $cn)
				{
					$get_sponsor_name = $this->db->get_where('users', ['id'=>$cn->user]);
					foreach($get_sponsor_name->result() as $sp);
					$spn = $sp->first_name.' '.$sp->last_name;
					$get_title = $this->db->get_where('em_sponsorship', ['sponsorship'=>$cn->sponsorship]);
					foreach($get_title->result() as $st);
					$title = $st->title;
					$csv .= $title.",".$spn.",".$cn->amount."\n";
				}
			}
			$csv .= "\n";
			$csv .= "Sponsor/Contribute\n";
			$csv .= "Report\n";
			$csv .= "Actual Budget,Contributions,Balance,Excess\n";
			if($contributions < $e->budget)
			{
				 $balance = ($e->budget) - $contributions ;
				
			}
			else
			{
				echo $balance = 0 ;
			}
			if($contributions > $e->budget)
			{
				 $excess =   $contributions - ($e->budget);
				
			}
			else
			{
				echo $excess = 0;
			}
			$csv .= $e->budget.",".$contributions.",".$balance.",".$excess."\n";
			
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$filename);
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$csv";
	exit;
			
			
	}
	/* ends */
	public function events_csv()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$rolename = singleDbTableRow($user_id)->rolename;
		
		
		if ($rolename == '11' || $rolename == '39') 
		{
													
				$query = $this->db->order_by('id', 'desc')->get('em_events');
			
		}
		else 
		{
				
				$table_name = "em_events";	
				$where_array = " created_by = ".$user_id."  ";								
				$query = $this->db->order_by('id', 'desc')->where($where_array )->get($table_name); 
			
		}
			$filename='events.csv';
		if (!empty($query) && $query->num_rows() > 0) 
		{
			$csv= "Events \n";
			
			$csv .= "Event,Name,Budget,Location,Start date,End Date,Host, Organiser,Guest, Additional Guest,Participants\n";
			foreach ($query->result() as $e)
			{
			/* location*/ $get_location_name = $this->db->get_where('pincode', ['id'=>$e->location]);
				foreach($get_location_name->result() as $l);
				$location = $l->location;/* */
				/* host*/$get_host_name = $this->db->get_where('users', ['id'=>$e->host]);
				foreach($get_host_name->result() as $h);
				$host = $h->first_name.' '.$h->last_name;/* */
				/* organiser*/$get_org_name = $this->db->get_where('users', ['id'=>$e->organiser]);
				foreach($get_org_name->result() as $og);
				 $organiser = $og->first_name.' '.$og->last_name;/* */
				 /* guest*/$get_guest_name = $this->db->get_where('users', ['id'=>$e->guest]);
				foreach($get_guest_name->result() as $g);
				$guest = $g->first_name.' '.$g->last_name;/* */
			$csv .= $e->event.",".$e->name.",".$e->budget.",".$location.",".$e->start_date.",".$e->end_date.",".$host.",". $organiser.",".$guest.",".$e->additional_guests.",".$e->participants."\n";
			}
			
			
			
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$filename);
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$csv";
	exit;
}
	else
	{
		return false ;
	}
	}
	//
	/* Send Email Notifications*/
	public function send_notification()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$table_name = "em_events";	
		$where_array = " end_date <= (now() + INTERVAL 1 DAY) AND send_notify = 0 ";	
		$query = $this->db->where($where_array )->get($table_name); 
		if (!empty($query) && $query->num_rows() > 0) 
		{
			
			foreach($query->result() as $r)
			{
				$EM_event = $r->event;
				/* event details*/
				$event_details = $this->db->get_where('em_events', ['event' => $EM_event]);
				foreach ($event_details->result() as $e)
				{
					$name = $e->name;
					$start_date = $e->start_date;
					$end_date = $e->end_date;
					
				}
				/* */
				/* users email */
				$table_name2 = "em_users";	
				$where_array2 = " event = '".$EM_event."' ";	
				$query2 = $this->db->where($where_array2 )->get($table_name2);
				$emails = '';
				foreach($query2->result() as $r2)
				{ 
				$user = $r2->user;
				$user_info = singleDbTableRow($user);
				$user_email = $user_info->email;
				$emails = $user_email.','.$emails;
				}
				/* */
				/*EMAIL */
			$HTMLrow = '';
		$HTMLrow .= '<tr>
                        <td style="padding:5px;text-align:center;">'.$name.'</td>
                        <td style="padding:5px;text-align:center;">'.$start_date.'</td>
                        <td style="padding:5px;text-align:center;">'.$end_date.'</td>
                        
                    </tr>';
					 $email_data = [
               
                'tableRow'      => $HTMLrow
            ];
			$adminEmail = get_option('default_email');
            $subject = 'Event Notification';
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($user_info->email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('event_notification_email',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();
				//update table 
			$data3 = [
           	'send_notify'               => 1,
			'modified_by' 			=> $user_id,
            'modified_at' 			=> time()
        ];

        $query3 = $this->db->where('event', $EM_event)->update('em_events', $data3);
				
			/* */
			}
			return true;	
		}
		else
		{
			return false;
		}
		
	}
/* ends*/
/*Report*/
public function event_search_count($location,$status,$created_by,$organised_by,$rsf_time,$rst_time,$ref_time,$ret_time,$esf_time,$est_time,$eef_time,$eet_time,$min_budget,$max_budget)
	{
		if($rsf_time !='' && $rst_time !='')
		{
		$start_fdt = new DateTime($rsf_time);
		$regstart_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($rst_time);
		$regstart_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($ref_time !='' && $ret_time !='')
		{
		$end_fdt = new DateTime($ref_time);
		$regend_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($ret_time);
		$regend_to = $end_tdt->format('Y/m/d');
		}
		
		if($esf_time !='' && $est_time !='')
		{
		$start_fdt = new DateTime($esf_time);
		$evstart_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($est_time);
		$evstart_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($eef_time !='' && $eet_time !='')
		{
		$end_fdt = new DateTime($eef_time);
		$evend_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($eet_time);
		$evend_to = $end_tdt->format('Y/m/d');
		}
		
		/* CONDITIONS */
		$condition="";
		
		if($location !='')
		{
			$condition.="location = '".$location."'";
		}
		
		if($status !='')
		{
			$condition.=($condition !='' ) ?" AND status = ".$status."" : " status = ".$status."" ;
		}
		if($created_by !='')
		{
			$condition.=($condition !='' ) ?" AND created_by = ".$created_by."" : " created_by = ".$created_by."" ;
		}
		if($organised_by !='')
		{
			$condition.=($condition !='' ) ?" AND organised_by = ".$organised_by."" : " organised_by = ".$organised_by."" ;
		}
		if($rsf_time !='' && $rst_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(regstart_date) BETWEEN '".$regstart_from."' AND '".$regstart_to."') " : " (DATE(regstart_date) BETWEEN '".$regstart_from."' AND '".$regstart_to."')" ;
		}
		if($ref_time !='' && $ret_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(regend_date) BETWEEN '".$regend_from."' AND '".$regend_to."') " : " (DATE(regend_date) BETWEEN '".$regend_from."' AND '".$regend_to."')" ;
		}
		
		if($esf_time !='' && $est_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(start_date) BETWEEN '".$evstart_from."' AND '".$evstart_to."') " : " (DATE(start_date) BETWEEN '".$evstart_from."' AND '".$evstart_to."')" ;
		}
		if($eef_time !='' && $eet_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(end_date) BETWEEN '".$evend_from."' AND '".$evend_to."') " : " (DATE(end_date) BETWEEN '".$evend_from."' AND '".$evend_to."')" ;
		}
		if($min_budget !='' && $max_budget !='')
		{
			$condition.=($condition !='' ) ?" AND (budget BETWEEN  ".$min_budget." AND ".$max_budget.")" : " (budget BETWEEN  ".$min_budget." AND ".$max_budget.")" ;
		}
		/* */
		
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array )->count_all_results('em_events');
		}
		else
		{
		$query = $this->db->count_all_results('em_events');
		}
        
        return $query;
    }
	function event_report_search($limit, $start,$location,$status,$created_by,$organised_by,$rsf_time,$rst_time,$ref_time,$ret_time,$esf_time,$est_time,$eef_time,$eet_time,$min_budget,$max_budget)
    {
		$search = $this->input->POST('search');	
		$searchValue = $search['value'];
		
		$searchByID = '';
		
		if($rsf_time !='' && $rst_time !='')
		{
		$start_fdt = new DateTime($rsf_time);
		$regstart_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($rst_time);
		$regstart_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($ref_time !='' && $ret_time !='')
		{
		$end_fdt = new DateTime($ref_time);
		$regend_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($ret_time);
		$regend_to = $end_tdt->format('Y/m/d');
		}
		
		if($esf_time !='' && $est_time !='')
		{
		$start_fdt = new DateTime($esf_time);
		$evstart_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($est_time);
		$evstart_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($eef_time !='' && $eet_time !='')
		{
		$end_fdt = new DateTime($eef_time);
		$evend_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($eet_time);
		$evend_to = $end_tdt->format('Y/m/d');
		}
		
		/* CONDITIONS */
		$condition="";
		
		if($location !='')
		{
			$condition.="location = '".$location."'";
		}
		
		if($status !='')
		{
			$condition.=($condition !='' ) ?" AND status = ".$status."" : " status = ".$status."" ;
		}
		if($created_by !='')
		{
			$condition.=($condition !='' ) ?" AND created_by = ".$created_by."" : " created_by = ".$created_by."" ;
		}
		if($organised_by !='')
		{
			$condition.=($condition !='' ) ?" AND organised_by = ".$organised_by."" : " organised_by = ".$organised_by."" ;
		}
		if($rsf_time !='' && $rst_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(regstart_date) BETWEEN '".$regstart_from."' AND '".$regstart_to."') " : " (DATE(regstart_date) BETWEEN '".$regstart_from."' AND '".$regstart_to."')" ;
		}
		if($ref_time !='' && $ret_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(regend_date) BETWEEN '".$regend_from."' AND '".$regend_to."') " : " (DATE(regend_date) BETWEEN '".$regend_from."' AND '".$regend_to."')" ;
		}
		
		if($esf_time !='' && $est_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(start_date) BETWEEN '".$evstart_from."' AND '".$evstart_to."') " : " (DATE(start_date) BETWEEN '".$evstart_from."' AND '".$evstart_to."')" ;
		}
		if($eef_time !='' && $eet_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(end_date) BETWEEN '".$evend_from."' AND '".$evend_to."') " : " (DATE(end_date) BETWEEN '".$evend_from."' AND '".$evend_to."')" ;
		}
		if($min_budget !='' && $max_budget !='')
		{
			$condition.=($condition !='' ) ?" AND (budget BETWEEN  ".$min_budget." AND ".$max_budget.")" : " (budget BETWEEN  ".$min_budget." AND ".$max_budget.")" ;
		}
		/* */
		
		if($condition !='')
		{
			$where_array =$condition;
			if($searchValue != '')																							
			{																												
				$where_array = $where_array. " AND event like '%".$searchValue."%' OR location like '%".$searchValue."%'";//array('event_no' => $searchValue );															
				
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('em_events'); 	
			}											
			else
			{
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('em_events'); 
			}
		}
		else
		{
			if($searchValue != '')																							
			{																												
				$where_array = "  event like '%".$searchValue."%' OR location like '%".$searchValue."%'";//array('event_no' => $searchValue );															
				
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('em_events'); 	
			}											
			else
			{
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('em_events'); 
			}
		}
		
		
		
		
        return $query;
    }
	function get_total_budget($location,$status,$created_by,$organised_by,$rsf_time,$rst_time,$ref_time,$ret_time,$esf_time,$est_time,$eef_time,$eet_time,$min_budget,$max_budget)
    {
		
		
		if($rsf_time !='' && $rst_time !='')
		{
		$start_fdt = new DateTime($rsf_time);
		$regstart_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($rst_time);
		$regstart_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($ref_time !='' && $ret_time !='')
		{
		$end_fdt = new DateTime($ref_time);
		$regend_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($ret_time);
		$regend_to = $end_tdt->format('Y/m/d');
		}
		
		if($esf_time !='' && $est_time !='')
		{
		$start_fdt = new DateTime($esf_time);
		$evstart_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($est_time);
		$evstart_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($eef_time !='' && $eet_time !='')
		{
		$end_fdt = new DateTime($eef_time);
		$evend_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($eet_time);
		$evend_to = $end_tdt->format('Y/m/d');
		}
		
		/* CONDITIONS */
		$condition="";
		
		if($location !='')
		{
			$condition.="location = '".$location."'";
		}
		
		if($status !='')
		{
			$condition.=($condition !='' ) ?" AND status = ".$status."" : " status = ".$status."" ;
		}
		if($created_by !='')
		{
			$condition.=($condition !='' ) ?" AND created_by = ".$created_by."" : " created_by = ".$created_by."" ;
		}
		if($organised_by !='')
		{
			$condition.=($condition !='' ) ?" AND organised_by = ".$organised_by."" : " organised_by = ".$organised_by."" ;
		}
		if($rsf_time !='' && $rst_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(regstart_date) BETWEEN '".$regstart_from."' AND '".$regstart_to."') " : " (DATE(regstart_date) BETWEEN '".$regstart_from."' AND '".$regstart_to."')" ;
		}
		if($ref_time !='' && $ret_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(regend_date) BETWEEN '".$regend_from."' AND '".$regend_to."') " : " (DATE(regend_date) BETWEEN '".$regend_from."' AND '".$regend_to."')" ;
		}
		
		if($esf_time !='' && $est_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(start_date) BETWEEN '".$evstart_from."' AND '".$evstart_to."') " : " (DATE(start_date) BETWEEN '".$evstart_from."' AND '".$evstart_to."')" ;
		}
		if($eef_time !='' && $eet_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(end_date) BETWEEN '".$evend_from."' AND '".$evend_to."') " : " (DATE(end_date) BETWEEN '".$evend_from."' AND '".$evend_to."')" ;
		}
		if($min_budget !='' && $max_budget !='')
		{
			$condition.=($condition !='' ) ?" AND (budget BETWEEN  ".$min_budget." AND ".$max_budget.")" : " (budget BETWEEN  ".$min_budget." AND ".$max_budget.")" ;
		}
		/* */
		
		if($condition !='')
		{
			$where_array =$condition;
			
				$query = $this->db->order_by('id', 'desc')->where($where_array )->get('em_events'); 
			
		}
		else
		{
			
				$query = $this->db->order_by('id', 'desc')->get('em_events'); 
			
		}
		
		
		
		
        return $query;
    }
//
/*dashboard*/
public function count_all_events()
{
	//$query = $this->db->where($where_array )->count_all_results('em_events');
	$query = $this->db->count_all_results('em_events');
	return $query;
}
public function count_active_events()
{
	$where_array = "status = 1";
	$query = $this->db->where($where_array)->count_all_results('em_events');
	return $query;
}
public function count_inactive_events()
{
	$where_array = "status = 0";
	$query = $this->db->where($where_array)->count_all_results('em_events');
	return $query;
}
public function count_closed_events()
{
	$where_array = "status = 2";
	$query = $this->db->where($where_array)->count_all_results('em_events');
	return $query;
}
//
/*csv*/
public function events_report_csv()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$rolename = singleDbTableRow($user_id)->rolename;
		
		//
		$location = $this->input->post('location');
		$status = $this->input->post('status');
		$created_by = $this->input->post('created_by');
		$organised_by = $this->input->post('organised_by');
		$rsf_time = $this->input->post('rsf_time');
		$rst_time = $this->input->post('rst_time');
		$ref_time = $this->input->post('ref_time');
		$ret_time = $this->input->post('ret_time');
		$esf_time = $this->input->post('esf_time');
		$est_time = $this->input->post('est_time');
		$eef_time = $this->input->post('eef_time');
		$eet_time = $this->input->post('eet_time');
		$min_budget = $this->input->post('min_budget');
		$max_budget = $this->input->post('max_budget');
		
		if($rsf_time !='' && $rst_time !='')
		{
		$start_fdt = new DateTime($rsf_time);
		$regstart_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($rst_time);
		$regstart_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($ref_time !='' && $ret_time !='')
		{
		$end_fdt = new DateTime($ref_time);
		$regend_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($ret_time);
		$regend_to = $end_tdt->format('Y/m/d');
		}
		
		if($esf_time !='' && $est_time !='')
		{
		$start_fdt = new DateTime($esf_time);
		$evstart_from = $start_fdt->format('Y/m/d');
		$start_tdt = new DateTime($est_time);
		$evstart_to = $start_tdt->format('Y/m/d');
		}
		
		
		
		if($eef_time !='' && $eet_time !='')
		{
		$end_fdt = new DateTime($eef_time);
		$evend_from = $end_fdt->format('Y/m/d');
		$end_tdt = new DateTime($eet_time);
		$evend_to = $end_tdt->format('Y/m/d');
		}
		
		/* CONDITIONS */
		$condition="";
		
		if($location !='')
		{
			$condition.="location = '".$location."'";
		}
		
		if($status !='')
		{
			$condition.=($condition !='' ) ?" AND status = ".$status."" : " status = ".$status."" ;
		}
		if($created_by !='')
		{
			$condition.=($condition !='' ) ?" AND created_by = ".$created_by."" : " created_by = ".$created_by."" ;
		}
		if($organised_by !='')
		{
			$condition.=($condition !='' ) ?" AND organised_by = ".$organised_by."" : " organised_by = ".$organised_by."" ;
		}
		if($rsf_time !='' && $rst_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(regstart_date) BETWEEN '".$regstart_from."' AND '".$regstart_to."') " : " (DATE(regstart_date) BETWEEN '".$regstart_from."' AND '".$regstart_to."')" ;
		}
		if($ref_time !='' && $ret_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(regend_date) BETWEEN '".$regend_from."' AND '".$regend_to."') " : " (DATE(regend_date) BETWEEN '".$regend_from."' AND '".$regend_to."')" ;
		}
		
		if($esf_time !='' && $est_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(start_date) BETWEEN '".$evstart_from."' AND '".$evstart_to."') " : " (DATE(start_date) BETWEEN '".$evstart_from."' AND '".$evstart_to."')" ;
		}
		if($eef_time !='' && $eet_time !='')
		{
			$condition.=($condition !='' ) ? " AND (DATE(end_date) BETWEEN '".$evend_from."' AND '".$evend_to."') " : " (DATE(end_date) BETWEEN '".$evend_from."' AND '".$evend_to."')" ;
		}
		if($min_budget !='' && $max_budget !='')
		{
			$condition.=($condition !='' ) ?" AND (budget BETWEEN  ".$min_budget." AND ".$max_budget.")" : " (budget BETWEEN  ".$min_budget." AND ".$max_budget.")" ;
		}
		/* */
		
		if($condition !='')
		{
			$where_array =$condition;
			
				$query = $this->db->order_by('id', 'desc')->where($where_array )->get('em_events'); 
			
		}
		else
		{
			
				$query = $this->db->order_by('id', 'desc')->get('em_events'); 
			
		}
		//
		
			$filename='events_report.csv';
		if (!empty($query) && $query->num_rows() > 0) 
		{
			$csv= "Event Report \n";
			
			$csv .= "Event ID,Budget,Location,Registration Received,Contribution Received,Contractors Total,Contractors Balance\n";
			 $budget = 0;
			foreach ($query->result() as $r)
			{
				/*total*/
				$budget = $budget + $r->budget;
				//
				//
				$contributions = $this->Total_contribution($r->event);
				$registrations = $this->Total_registration($r->event);
				/*contractors*/
				$sponsors = $this->db->get_where('em_sponsorship', ['event' => $r->event]);
				$charge = 0;
				if (!empty($sponsors) && $sponsors->num_rows() > 0)
				{
					 
					$count = 1;
						 foreach ($sponsors->result() as $s)
						 {
							$charge = $charge + $s->charge;
							//
							$where_array6 =" sponsorship = '".$s->sponsorship."'";
							    $table_name6="em_fund_transfer";
							   $query6 = $this->db->order_by('id')->where($where_array6 )->get($table_name6);
							   $tm = 0;
							   if($query6 -> num_rows() > 0) 
								{
									$tamnt = 0;
									foreach ($query6->result() as $tamount) 
									{
										$tamnt = $tamnt + $tamount->transferred_amount;
									}
									
								}
								else
								{
									$tamnt = 0;
								}
								$tm =$tm + $tamnt;
						 }
					$balance = 	 $charge - $tm;
				}
				else
				{
					$charge = 0;
					$balance = 0;
				}
				//
			$csv .= $r->event.",".$r->budget.",".singleDbTableRow($r->location, 'pincode')->location.",".$registrations.",".$contributions.",".$charge.",".$balance."\n";
			}
			$csv .="Total events,Total Budget\n";
			$csv .= $query->num_rows().",".$budget."\n";
			
			
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$filename);
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$csv";
	exit;
}
	else
	{
		return false ;
	}
	}
//
}
?>