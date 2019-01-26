<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Event_management extends CI_Controller 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('Event_model');
		$this->load->model('ledger_model');
		$this->load->model('payment_model');
		$this->load->model('notification_model');
		
		check_auth(); //check is logged in.
	}
/* Create Events */
	public function event_category()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser !=39 && $currentUser != 11)
		{
			permittedArea();
		}
		else
		{
			if($this->input->post())
			{
				if($this->input->post('submit') != 'create_categ') die('Error! sorry');
				$this->form_validation->set_rules('name','name','required');
				
				if($this->form_validation->run() == true)
				{
					$create = $this->Event_model->event_category();
					if($create)
					{
						$this->session->set_flashdata('successMsg', 'New category added Successfully!');
						redirect(base_url('Event_management/event_category_list'));
					}
	
				}
			}
			theme('event_category');
		}
	}
	public function event_sub_category()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser !=39 && $currentUser != 11)
		{
			permittedArea();
		}
		else
		{
			$data['category'] = $this->db->order_by('name', 'asc')->get_where('em_category', ['category_type'=>'main']);
			if($this->input->post())
			{
				if($this->input->post('submit') != 'create_subcateg') die('Error! sorry');
				
				$this->form_validation->set_rules('categ','category','required');
				$this->form_validation->set_rules('name','name','required');
				
				if($this->form_validation->run() == true)
				{
					$create = $this->Event_model->event_sub_category();
					if($create)
					{
						$this->session->set_flashdata('successMsg', 'New Sub-category added Successfully!');
						redirect(base_url('Event_management/event_sub_category_list'));
					}
	
				}
			}
			theme('event_sub_category',$data);
		}
	}
	public function event_seat_category()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser !=39 && $currentUser != 11)
		{
			permittedArea();
		}
		else
		{
			if($this->input->post())
			{
				if($this->input->post('submit') != 'create_categ') die('Error! sorry');
				$this->form_validation->set_rules('name','name','required');
				
				if($this->form_validation->run() == true)
				{
					$create = $this->Event_model->event_seat_category();
					if($create)
					{
						$this->session->set_flashdata('successMsg', 'New category added Successfully!');
						redirect(base_url('Event_management/event_seat_category_list'));
					}
	
				}
			}
			theme('event_seat_category');
		}
	}
	public function event_seat_sub_category()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser !=39 && $currentUser != 11)
		{
			permittedArea();
		}
		else
		{
			$data['category'] = $this->db->order_by('name', 'asc')->get_where('em_seat_category', ['category_type'=>'main']);
			if($this->input->post())
			{
				if($this->input->post('submit') != 'create_subcateg') die('Error! sorry');
				
				$this->form_validation->set_rules('categ','category','required');
				$this->form_validation->set_rules('name','name','required');
				
				if($this->form_validation->run() == true)
				{
					$create = $this->Event_model->event_seat_sub_category();
					if($create)
					{
						$this->session->set_flashdata('successMsg', 'New Sub-category added Successfully!');
						redirect(base_url('Event_management/event_seat_sub_category_list'));
					}
	
				}
			}
			theme('event_seat_sub_category',$data);
		}
	}
	public function get_sub_categ()
     {
         $category=$_POST['category'];
         $query = $this->Event_model->get_sub_categ($category);
         $state = "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             $state .= "<option value='".$r->id."'>".$r->name."</option>";
         } 
		echo $state;
     }
	 public function get_seat_sub_categ()
     {
         $category=$_POST['category'];
         $query = $this->Event_model->get_seat_sub_categ($category);
         $state = "";
         foreach($query->result() as $r)
         {
             //$state .= "<option value='".$r->id."'>".$r->name."</option>";
			 $state .= "<input type='radio' name='seat_sub_categ' value='".$r->id."' onClick='show_dynamic_seat(this.value);'>&nbsp;".$r->name."&nbsp;&nbsp;";
         } 
		echo $state;
     }
	 public function show_dynamic_seat()
     {
         $id = $_POST['id'];
		 $seat_num = $_POST['seat_num'];
		 /*SEMI SLEEPER*/
		 if($id == 3)
		 {
			 theme('event_semi_sleeper_view');
		 }
		
		
		 /* SLEEPER*/
		 else if($id == 2)
		 {
			 theme('event_sleeper_view');
		 }
		 
		 /* SEATER & SLEEPER*/
		else if($id == 4)
		 {
			 theme('event_seater_sleeper_view');
		 }
		 
		 /* Aud:Squar*/
		else if($id == 7)
		 {
			 $data['num'] = $seat_num;
			 theme('event_sqr_aud_view',$data);
		 }
		 else
		 {
			 echo 'hi';
		 }
		 /*echo '<div class="form-group">
               <div class="col-md-9">Seats : ';
			   $get_main = $this->db->get_where('em_seat_category', ['id'=>$id]);
				foreach($get_main->result() as $m);
				 $main = $m->parent_id;
				 if($main = 1)
				 {
					 echo ' <input type="text" name="participants" id="participants" class="form-control" value=53>';
				 }
				 else
				 {
					 echo '<input type="text" name="participants" id="participants" class="form-control" placeholder="Enter Number of seats">';
				 }
			  echo ' </div>
               </div>';
			   echo '<div class="form-group">
                            <div class="col-md-9" id="seats">
                             <strong>Seat Name : </strong><input type="text" name="seat_name" class="form-control"/> <br>
							<strong>Seat From : </strong><input type="text" name="seat_from" class="form-control"/> <br>
                           <strong> Seat To :</strong> <input type="text" name="seat_to"  class="form-control"/> <br>
                           <strong> Reg.Fee :</strong><input type="text" name="seat_fee"  class="form-control"/><br><br>
                            <strong> Refund deduction % :</strong><input type="text" name="seat_refund"  class="form-control"/><br><br>
                            <input onClick="addseatsRow(this.form);" type="button" value="Add" class="btn btn-warning"/> 
                            (This row will not be saved unless you click on "Add" first)
                                
                            </div>
                            
                        </div>
			   ';*/
			    
         
     }
	public function get_state()
     {
         $country=$_POST['country'];
         $query = $this->Event_model->get_state($country);
         $state = "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             $state .= "<option value='".$r->state."'>".$r->state."</option>";
         } 
		echo $state;
     }
	 public function get_district()
     {
         $state=$_POST['state'];
         $query = $this->Event_model->get_district($state);
         $state = "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             $state .= "<option value='".$r->district."'>".$r->district."</option>";
         } 
		echo $state;
     }
	 public function get_location()
     {
         $district=$_POST['district'];
         $query = $this->Event_model->get_location($district);
         $state = "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             $state .= "<option value='".$r->id."'>".$r->pincode."-".$r->location."</option>";
         } 
		echo $state;
     }
	 
	 public function get_user_by_role()
     {
         $role=$_POST['role'];
         $query = $this->Event_model->get_user_by_role($role);
         $users = "<option value=''>-Select Now-</option>";
         foreach($query->result() as $r)
         {
			 $users .= '<option value="'.$r->id.'"> '.$r->contactno.'-'.$r->first_name.' '.$r->last_name.'</option>';
             
         } 
		echo $users;
     }
	 public function get_area()
     {
         $bg=$_POST['bg'];
         $query = $this->Event_model->get_area($bg);
         $user = "<option value=''>-Select-</option>";
		 if($query->num_rows() > 0)
		 {
         foreach($query->result() as $a)
         {
			 $get_location_name = $this->db->get_where('location_id', ['id'=>$a->location]);
			foreach($get_location_name->result() as $l);
				
             $user .= "<option value='".$a->id."'>".$a->id." ".$l->location."</option>";
         } 
		 }
		 
		echo $user;
     }
	public function event_create()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser !=39 && $currentUser != 11)
		{
			permittedArea();
		}
		else
		{
			//$data['locations'] = $this->db->order_by('location', 'asc')->get('pincode');
			$data['seat_category'] = $this->db->order_by('name', 'asc')->get_where('em_seat_category', ['category_type'=>'main']);
			$data['category'] = $this->db->order_by('name', 'asc')->get_where('em_category', ['category_type'=>'main']);
			$data['countrys'] = $this->db->group_by('country')->get('pincode');
			$data['users'] = $this->db->order_by('first_name', 'asc')->get_where('users', ['rolename'=>12]);
			$data['roles'] = $this->db->order_by('rolename', 'asc')->get('role');
			$data['bgs'] = $this->db->order_by('business_name', 'asc')->get('business_groups');
			if($this->input->post())
			{
				if($this->input->post('submit') != 'create_event') die('Error! sorry');
				$this->form_validation->set_rules('categ','category','required');
				$this->form_validation->set_rules('budget','budget','required');
				$this->form_validation->set_rules('name','name','required');
				$this->form_validation->set_rules('location','location','required');
				$this->form_validation->set_rules('venue','venue','required');
				$this->form_validation->set_rules('rf_time','rf_time','required');
				$this->form_validation->set_rules('f_time','f_time','required');
				$this->form_validation->set_rules('status','status','required');
				
				if($this->form_validation->run() == true)
				{
					$create = $this->Event_model->event_create();
					if($create)
					{
						$this->session->set_flashdata('successMsg', 'New Event created Successfully!');
						redirect(base_url('Event_management/event_list'));
					}
	
				}
			}
			theme('event_create',$data);
		}
	}
/* /Create Events */
/* send invitation */
	public function event_send_invitation()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser !=39 && $currentUser != 11)
		{
			permittedArea();
		}
		else
		{
			if($this->input->post())
			{
				/*image upload*/
				if($this->input->post('submit') == 'upload_img')
				{
					$this->form_validation->set_rules('userfile','userfile','required');
					
						$send = $this->Event_model->send_invitation();
						if($send)
						{
							$this->session->set_flashdata('successMsg', 'Uploaded Successfully!');
							redirect(base_url('Event_management/event_send_invitation'));
						}
						else
						{
							$this->session->set_flashdata('errorMsg', 'Error !');
							redirect(base_url('Event_management/event_send_invitation'));
						}
					
				}
				/*SMS*/
				if($this->input->post('submit') == 'send_sms')
				{
					
					
						$send = $this->Event_model->send_invitation_sms();
						if($send)
						{
							$this->session->set_flashdata('successMsg', 'SMS sent Successfully!');
							redirect(base_url('Event_management/event_send_invitation'));
						}
						else
						{
							$this->session->set_flashdata('errorMsg', 'Error !');
							redirect(base_url('Event_management/event_send_invitation'));
						}
					
				}
				/*SMS*/
				if($this->input->post('submit') == 'send_email')
				{
					
					
						$send = $this->Event_model->send_invitation_email();
						if($send)
						{
							$this->session->set_flashdata('successMsg', 'EMAIL sent Successfully!');
							redirect(base_url('Event_management/event_send_invitation'));
						}
						else
						{
							$this->session->set_flashdata('errorMsg', 'Error !');
							redirect(base_url('Event_management/event_send_invitation'));
						}
					
				}
			}
			theme('event_send_invitation');
		}
	}
	public function show_invitation_sms_form()
     {
         $event=$_POST['event'];
		 $joined_users = $this->db->get_where('em_users', ['event' => $event]);
		 $joined_user_phn ='';
		 $user_name = '';
		 if ($joined_users->num_rows() > 0) 
		 {
			 foreach ($joined_users->result() as $ju)
			 {
				 $user_info = singleDbTableRow($ju->user);
				 $joined_user_phn = $user_info->contactno.','.$joined_user_phn;
				 $user_name = $user_info->first_name.' '. $user_info->last_name.','.$user_name;
			 }
		 }
		 $selected_users = $this->db->get_where('em_events', ['event' => $event]);
		 foreach ($selected_users->result() as $su);
		 $selected = rtrim($su ->selected_users,", ");
		 $selected_user_phn = '';
		 $selected_user_name = '';
		 if($selected !='')
		 {
			 $explode_user = explode(',',$selected);
			 foreach($explode_user as $euser)
			 {
				 
				$user_info1 = singleDbTableRow($euser);
				 $selected_user_phn = $user_info1->contactno.','.$selected_user_phn;
				 $selected_user_name = $user_info1->first_name.' '. $user_info1->last_name.','.$selected_user_name; 
			 }
		 }
         
		echo '<div class="form-group">
                            <label for="event" class="col-md-3">Event
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="sms_event" id="sms_event" class="form-control" readonly value='.$event.'>
                            </div>
                        </div>';
		echo '<div class="form-group">
			<label for="venue" class="col-md-3">Joined/Registered users
				<span class="text-red">*</span>
			</label>
			<div class="col-md-9">
			'.$user_name.'
				<textarea name="sms_joined" id="sms_joined" class="form-control">'.$joined_user_phn.'</textarea>
			   
			</div>
		</div>';
		/*echo '<div class="form-group">
			<label for="venue" class="col-md-3">Selected users
				<span class="text-red">*</span>
			</label>
			<div class="col-md-9">
			$selected_user_name
				<textarea name="sms_selected" id="sms_selected" class="form-control">$selected_user_phn</textarea>
			   
			</div>
		</div>';*/
		echo '<div class="form-group">
			<label for="venue" class="col-md-3">SMS users
				<span class="text-red">*</span>
			</label>
			<div class="col-md-9">
			
				<textarea name="sms_sms" id="sms_sms" class="form-control">'.$su ->sms_numbers.'</textarea>
			   
			</div>
		</div>';
		echo '<div class="form-group">
			<label for="venue" class="col-md-3">Message
				<span class="text-red">*</span>
			</label>
			<div class="col-md-9">
			
				<textarea name="sms_msg" id="sms_msg" class="form-control"></textarea>
			   
			</div>
		</div>';
     }
	 public function show_invitation_email_form()
     {
         $event=$_POST['event'];
		 $joined_users = $this->db->get_where('em_users', ['event' => $event]);
		 $joined_user_phn ='';
		 $user_name = '';
		 if ($joined_users->num_rows() > 0) 
		 {
			 foreach ($joined_users->result() as $ju)
			 {
				 $user_info = singleDbTableRow($ju->user);
				 $joined_user_phn = $user_info->email.','.$joined_user_phn;
				 $user_name = $user_info->first_name.' '. $user_info->last_name.','.$user_name;
			 }
		 }
		 $selected_users = $this->db->get_where('em_events', ['event' => $event]);
		 foreach ($selected_users->result() as $su);
		 $selected = rtrim($su ->selected_users,", ");
		 $selected_user_phn = '';
		 $selected_user_name = '';
		 if($selected !='')
		 {
			 $explode_user = explode(',',$selected);
			 foreach($explode_user as $euser)
			 {
				 
				$user_info1 = singleDbTableRow($euser);
				 $selected_user_phn = $user_info1->email.','.$selected_user_phn;
				 $selected_user_name = $user_info1->first_name.' '. $user_info1->last_name.','.$selected_user_name; 
			 }
		 }
         
		echo '<div class="form-group">
                            <label for="event" class="col-md-3">Event
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="email_event" id="email_event" class="form-control" readonly value='.$event.'>
                            </div>
                        </div>';
		echo '<div class="form-group">
			<label for="venue" class="col-md-3">Joined/Registered users
				<span class="text-red">*</span>
			</label>
			<div class="col-md-9">
			'.$user_name.'
				<textarea name="email_joined" id="email_joined" class="form-control">'.$joined_user_phn.'</textarea>
			   
			</div>
		</div>';
		echo '<div class="form-group">
			<label for="venue" class="col-md-3">Selected users
				<span class="text-red">*</span>
			</label>
			<div class="col-md-9">
			'.$selected_user_name.'
				<textarea name="email_selected" id="email_selected" class="form-control">'.$selected_user_phn.'</textarea>
			   
			</div>
		</div>';
		echo '<div class="form-group">
			<label for="venue" class="col-md-3">Message
				<span class="text-red">*</span>
			</label>
			<div class="col-md-9">
			
				<textarea name="email_msg" id="email_msg" class="form-control"></textarea>
			   
			</div>
		</div>';
		
     }
	//
	public function SendListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Event_model->SendListCount();
		$query = $this->Event_model->SendList($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 foreach ($query->result() as $events) 
			 {
				 //no of registration
				 $reg_count = $this->Event_model->Reg_count($events->event);
				 
				 //Action Button
				  $button = '';
				 /* date check */
					$end_date =$events->end_date;
					$now= date('Y/m/d H:i');
					if($end_date < $now )
					{
						//update status 
							$data6 = [
							'status'               => 0
						];
				
						$query6 = $this->db->where('event', $events->event)->update('em_events', $data6);
						$query7 = $this->db->where('event', $events->event)->update('em_track', $data6);
						//$button .= '<font color="#FF0000"><strong> Expired <strong><font>';
					}
               if($events->invitation !='') 
			   {
				   $img = '<a href="' . base_url('Event_management/event_invitation/'.$events->invitation) . '" data-toggle="modal" data-target="#myModal" title="View"><img src="'.profile_photo_url('/invitation/'.$events->invitation).'" / width="45" height="45"> </a> ';
			   }
			   else
			   {
				   $img ='No image found';
			   }
			   $button .='<input type="radio" name="send_now" value="'.$events->event.'" onclick="show_form(this.value)";> ';
               	 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Event_management/event_view/' . $events->event) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				  
				 
				$get_location_name = $this->db->get_where('pincode', ['id'=>$events->location]);
					foreach($get_location_name->result() as $l);
				$location = $l->location;
				
				//
				if($events->status == 1)
				{
					$status = '<font color="#00CC00">Active</font>';
				}
				else if($events->status == 0)
				{
					$status = '<font color="#CC0000">Inactive</font>';
				}
				else if($events->status == 2)
				{
					$status = '<font color="#FF6600">Closed</font>';
				}
				//
				
				$data['data'][] = array(
                    $button,
					$events->event,
					$events->name,
					$events->budget,
                    $location,
                    $events->start_date,
                    $events->end_date,
					$reg_count,
					$img
					
                );
				
			 }
		 }
		 else
		 {
			 $data['data'][] = array(
                'No results found', '', '', '', '','' , '', '', ''
            );
		 }
		  echo json_encode($data);
	}
/*ends */
/*category*/
	public function event_category_list()
	{
		
		theme('event_category_list');
		
	}
	public function CategoryListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Event_model->CategoryListCount();
		$query = $this->Event_model->CategoryList($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 foreach ($query->result() as $categ) 
			 {
				 
				 //Action Button
				  $button = '';
				
               	 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Event_management/event_category_view/' . $categ->id) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				
				$get_user_name = $this->db->get_where('users', ['id'=>$categ->created_by]);
					foreach($get_user_name->result() as $l);
				$user = $l->first_name.' '.$l->last_name ;
				
				
				
				$data['data'][] = array(
                    $button,
					$categ->name,
					$user,
					date('Y-m-d h:m:i' ,$categ->created_at)
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
	public function event_sub_category_list()
	{
		
		theme('event_sub_category_list');
		
	}
	public function Sub_CategoryListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Event_model->Sub_CategoryListCount();
		$query = $this->Event_model->Sub_CategoryList($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 foreach ($query->result() as $categ) 
			 {
				 
				 //Action Button
				  $button = '';
				
               	 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Event_management/event_sub_category_view/' . $categ->id) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				
				$get_user_name = $this->db->get_where('users', ['id'=>$categ->created_by]);
					foreach($get_user_name->result() as $l);
				$user = $l->first_name.' '.$l->last_name ;
				
				$get_categ_name = $this->db->get_where('em_category', ['id'=>$categ->parent_id]);
					foreach($get_categ_name->result() as $l);
				$pcateg = $l->name;
				
				
				
				$data['data'][] = array(
                    $button,
					$categ->name,
					$pcateg,
					$user,
					date('Y-m-d h:m:i' ,$categ->created_at)
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
	public function event_seat_category_list()
	{
		
		theme('event_seat_category_list');
		
	}
	public function SeatcategoryListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Event_model->SeatcategoryListCount();
		$query = $this->Event_model->SeatcategoryList($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 foreach ($query->result() as $categ) 
			 {
				 
				 //Action Button
				  $button = '';
				
               	 $button .= '<a class="btn btn-primary editBtn" href="#" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				
				$get_user_name = $this->db->get_where('users', ['id'=>$categ->created_by]);
					foreach($get_user_name->result() as $l);
				$user = $l->first_name.' '.$l->last_name ;
				
				
				
				$data['data'][] = array(
                    $button,
					$categ->name,
					$user,
					date('Y-m-d h:m:i' ,$categ->created_at)
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
	public function event_seat_sub_category_list()
	{
		
		theme('event_seat_sub_category_list');
		
	}
	public function Sub_SeatcategoryListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Event_model->Seatsub_CategoryListCount();
		$query = $this->Event_model->Seatsub_CategoryList($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 foreach ($query->result() as $categ) 
			 {
				 
				 //Action Button
				  $button = '';
				
               	 $button .= '<a class="btn btn-primary editBtn" href="#" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				
				$get_user_name = $this->db->get_where('users', ['id'=>$categ->created_by]);
					foreach($get_user_name->result() as $l);
				$user = $l->first_name.' '.$l->last_name ;
				
				$get_categ_name = $this->db->get_where('em_seat_category', ['id'=>$categ->parent_id]);
					foreach($get_categ_name->result() as $l);
				$pcateg = $l->name;
				
				
				
				$data['data'][] = array(
                    $button,
					$categ->name,
					$pcateg,
					$user,
					date('Y-m-d h:m:i' ,$categ->created_at)
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
/*ends*/
/* event lists */
	public function event_list()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		
			if($this->input->post())
			{
				if($this->input->post('submit') == 'csv')
			{
				$data['events'] = $this->Event_model->events_csv();
			}
			else if($this->input->post('submit') == 'pdf')
			{
				$data['event'] = $this->Event_model->Export_to_pdf();
				
				$this->load->library('pdf');
				$this->pdf->load_view('events_pdf', $data);
				$this->pdf->render();
				$this->pdf->stream("Events-at-".date('d-m-Y-h:i').".pdf");
			}
				
			}
			
			theme('event_list');
		
	}
	public function EventListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Event_model->EventListCount();
		$query = $this->Event_model->EventList($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 foreach ($query->result() as $events) 
			 {
				 //no of registration
				 $reg_count = $this->Event_model->Reg_count($events->event);
				 //no of sponsorship
				 $sponsorship_count = $this->Event_model->Sponsorship_count($events->event);
				 //no of requests
				 $request_count = $this->Event_model->Request_count($events->event);
				 //Action Button
				  $button = '';
				 /* date check */
					$end_date =$events->end_date;
					$now= date('Y/m/d H:i');
					if($end_date < $now )
					{
						//update status 
							$data6 = [
							'status'               => 2
						];
				
						$query6 = $this->db->where('event', $events->event)->update('em_events', $data6);
						$query7 = $this->db->where('event', $events->event)->update('em_track', $data6);
						//$button .= '<font color="#FF0000"><strong> Expired <strong><font>';
					}
               $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Event_management/event_edit/' . $events->event) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> </a> ';
               	 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Event_management/event_view/' . $events->event) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				 $button .= '<a class="btn btn-warning" href="' . base_url('Event_management/event_report/' . $events->event) . '" data-toggle="tooltip" title="Report"><i class="fa fa-list"></i> </a>';
				if ($currentUser == 'admin')
				{
          $button .= '<a class="btn btn-danger deleteBtn" id="' . $events->event . '" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i> </a>';
				}
				$get_location_name = $this->db->get_where('pincode', ['id'=>$events->location]);
					foreach($get_location_name->result() as $l);
				$location = $l->location;
				
				//
				if($events->status == 1)
				{
					$status = '<font color="#00CC00">Active</font>';
				}
				else if($events->status == 0)
				{
					$status = '<font color="#CC0000">Inactive</font>';
				}
				else if($events->status == 2)
				{
					$status = '<font color="#FF6600">Closed</font>';
				}
				//
				
				$data['data'][] = array(
                    $button,
					$status,
					$events->event,
					$events->name,
					$events->budget,
                    $location,
                    $events->start_date,
                    $events->end_date,
					$reg_count,
					$sponsorship_count,
					$request_count
                    
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
/* ends */
/*edit*/
public function event_edit($event) 
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
			$data['event'] = $this->db->get_where('em_events', ['event' => $event]);
			$data['labels'] = $this->db->get_where('em_labels', ['event' => $event]);
			$data['sponsorships'] = $this->db->get_where('em_sponsorship', ['event' => $event]);
			$data['seats'] = $this->db->get_where('em_seats', ['event' => $event]);
			$data['users'] = $this->db->order_by('first_name', 'asc')->get_where('users', ['rolename'=>12]);
			$data['category'] = $this->db->order_by('name', 'asc')->get_where('em_category', ['category_type'=>'main']);
			$data['roles'] = $this->db->order_by('rolename', 'asc')->get('role');
			$data['bgs'] = $this->db->order_by('business_name', 'asc')->get('business_groups');
			if($this->input->post())
			{
				if($this->input->post('submit') != 'edit') die('Error! sorry');
				
				$this->form_validation->set_rules('status','status','required');
				
				if($this->form_validation->run() == true)
				{
					$create = $this->Event_model->event_edit($event);
					if($create)
					{
						$this->session->set_flashdata('successMsg', 'Updated Successfully!');
						redirect(base_url('Event_management/event_list'));
					}
	
				}
			}
			theme('event_edit', $data);
	}
//
/* event request lists */
	public function event_requests()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		theme('event_requests');
		
	}
	public function Event_requestListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Event_model->Event_requestListCount();
		$query = $this->Event_model->Event_requestList($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 foreach ($query->result() as $events) 
			 {
				 //no of registration
				 $reg_count = $this->Event_model->Reg_count($events->event);
				 //no of sponsorship
				 $sponsorship_count = $this->Event_model->Sponsorship_count($events->event);
				 //no of requests
				 $request_count = $this->Event_model->Request_count($events->event);
				 //Action Button
				  $button = '';
				 /* date check */
					$end_date =$events->end_date;
					$now= date('Y/m/d H:i');
					if($end_date < $now )
					{
						//update status 
							$data6 = [
							'status'               => 2
						];
				
						$query6 = $this->db->where('event', $events->event)->update('em_events', $data6);
						$query7 = $this->db->where('event', $events->event)->update('em_track', $data6);
						//$button .= '<font color="#FF0000"><strong> Expired <strong><font>';
					}
               
               	 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Event_management/event_view/' . $events->event) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				 $button .= '<a class="btn btn-warning" href="' . base_url('Event_management/event_accept_request/' . $events->event) . '" data-toggle="tooltip" title="Accept Now"><i class="fa fa-thumbs-up"></i> </a>';
				
				$get_location_name = $this->db->get_where('pincode', ['id'=>$events->location]);
					foreach($get_location_name->result() as $l);
				$location = $l->location;
				
				//
				if($events->status == 1)
				{
					$status = '<font color="#00CC00">Active</font>';
				}
				else if($events->status == 0)
				{
					$status = '<font color="#CC0000">Inactive</font>';
				}
				else if($events->status == 2)
				{
					$status = '<font color="#FF6600">Closed</font>';
				}
				//
				//
				$get_created_by = $this->db->get_where('users', ['id'=> $events->created_by]);
				foreach($get_created_by->result() as $g);
				 $created_by = $g->first_name.' '.$g->last_name;
				//
				$data['data'][] = array(
                    $button,
					$status,
					$events->event,
					$events->name,
					$events->budget,
                    $location,
                    $events->start_date,
                    $events->end_date,
					$created_by,
					date('Y-m-d H:m:i',$events->created_at)
					
                    
                );
				
			 }
		 }
		 else
		 {
			 $data['data'][] = array(
                'No results found', '', '', '', '','' , '', '', '', ''
            );
		 }
		  echo json_encode($data);
	}
/* ends */
//
/* view */
	public function event_category_view($categ) 
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
			$data['category'] = $this->db->get_where('em_category', ['id' => $categ]);
			$data['events'] = $this->db->get_where('em_events', ['category' => $categ]);
			
			theme('event_category_view', $data);
	}
	public function event_sub_category_view($subcateg) 
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
			$data['category'] = $this->db->get_where('em_category', ['id' => $subcateg]);
			$data['events'] = $this->db->get_where('em_events', ['subcategory' => $subcateg]);
			
			theme('event_sub_category_view', $data);
	}
	public function event_invitation($invitation)
	{
		$data['invitation']  	= $invitation;
		theme('event_invitation',$data);
	}
	public function event_view($event) 
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
			$data['event'] = $this->db->get_where('em_events', ['event' => $event]);
			$data['labels'] = $this->db->get_where('em_labels', ['event' => $event]);
			$data['sponsors'] = $this->db->get_where('em_sponsorship', ['event' => $event]);
			$data['contributions'] = $this->db->get_where('em_user_sponsorship', ['event' => $event]);
			$data['my_contributions'] = $this->db->get_where('em_user_sponsorship', ['event' => $event,'user' => $user_id]);
			$data['joined_users'] = $this->db->get_where('em_users', ['event' => $event]);
			$data['seats'] = $this->db->get_where('em_seats', ['event' => $event]);
			theme('event_view', $data);
	}
/* ends */
/* report */
	public function event_report($event) 
	{
			$data['event'] = $this->db->get_where('em_events', ['event' => $event]);
			$data['labels'] = $this->db->get_where('em_labels', ['event' => $event]);
			$data['sponsors'] = $this->db->get_where('em_sponsorship', ['event' => $event]);
			$data['contribution'] = $this->db->get_where('em_user_sponsorship', ['event' => $event]);
			$data['joined_users'] = $this->db->get_where('em_users', ['event' => $event]);
			$data['seats'] = $this->db->get_where('em_seats', ['event' => $event]);
			$data['seat_cancel'] = $this->db->get_where('em_seat_cancel', ['event' => $event]);
			
			$data['reg_count'] = $this->Event_model->Reg_count($event);
			$data['seat_count'] = $this->Event_model->Seat_count($event);
			$data['sponsorship_count'] =  $this->Event_model->Sponsorship_count($event);
			$data['request_count'] = $this->Event_model->Request_count($event);
			$data['contributions'] = $this->Event_model->Total_contribution($event);
			$data['registrations'] = $this->Event_model->Total_registration($event);
			
			//$data['locations'] = $this->db->order_by('location', 'asc')->get('pincode');
			$data['users'] = $this->db->order_by('first_name', 'asc')->get_where('users', ['rolename'=>12]);
			if($this->input->post())
			{
				if($this->input->post('submit') == 'update_event') 
				{
					$this->form_validation->set_rules('budget','budget','required');
					$this->form_validation->set_rules('location','location','required');
					$this->form_validation->set_rules('f_time','f_time','required');
					$this->form_validation->set_rules('status','status','required');
					
					if($this->form_validation->run() == true)
					{
						$update = $this->Event_model->event_update();
						if($update)
						{
							$this->session->set_flashdata('successMsg', 'Event Updated Successfully!');
							//redirect(base_url('Event_management/event_report',$update));
						}
					}
				}
				else if($this->input->post('submit') == 'pdf')
				{
					
					$this->load->library('pdf');
					$this->pdf->load_view('event_pdf', $data);
					$this->pdf->render();
					$this->pdf->stream("Events-at-".date('d-m-Y-h:i').".pdf");
				}
				else if($this->input->post('submit') == 'csv')
				{
					$this->Event_model->export_to_csv($event);
				}
			}
			
			theme('event_report', $data);
	}
/* ends */
/* Event Payments */
	public function event_payments()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->rolename;
		if($currentUser !=39 && $currentUser != 11)
		{
			permittedArea();
		}
		else
		{
			theme('event_payments');
		}
	}
	public function PaymentListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Event_model->SendListCount();
		$query = $this->Event_model->SendList($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 foreach ($query->result() as $events) 
			 {
				 //no of registration
				 $reg_count = $this->Event_model->Reg_count($events->event);
				 
				 //Action Button
				  $button = '';
				 /* date check */
					$end_date =$events->end_date;
					$now= date('Y/m/d H:i');
					if($end_date < $now )
					{
						//update status 
							$data6 = [
							'status'               => 0
						];
				
						$query6 = $this->db->where('event', $events->event)->update('em_events', $data6);
						$query7 = $this->db->where('event', $events->event)->update('em_track', $data6);
						//$button .= '<font color="#FF0000"><strong> Expired <strong><font>';
					}
              
			  
               	 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Event_management/event_payment_view/' . $events->event) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				  
				 
				$get_location_name = $this->db->get_where('pincode', ['id'=>$events->location]);
					foreach($get_location_name->result() as $l);
				$location = $l->location;
				
				//
				if($events->status == 1)
				{
					$status = '<font color="#00CC00">Active</font>';
				}
				else if($events->status == 0)
				{
					$status = '<font color="#CC0000">Inactive</font>';
				}
				else if($events->status == 2)
				{
					$status = '<font color="#FF6600">Closed</font>';
				}
				//
				
				$data['data'][] = array(
                    $button,
					$events->event,
					$events->name,
					$events->budget,
                    $location,
                    $events->start_date,
                    $events->end_date
					
                );
				
			 }
		 }
		 else
		 {
			 $data['data'][] = array(
                'No results found', '', '', '', '','' , '', '', ''
            );
		 }
		  echo json_encode($data);
	}
/*ends */
/* event_payment_details */
	public function event_payment_view($event) 
	{
			$data['event'] = $this->db->get_where('em_events', ['event' => $event]);
			$data['sponsors'] = $this->db->get_where('em_sponsorship', ['event' => $event]);
			$data['contribution'] = $this->db->get_where('em_user_sponsorship', ['event' => $event]);
			
			
			$data['reg_count'] = $this->Event_model->Reg_count($event);
			$data['sponsorship_count'] =  $this->Event_model->Sponsorship_count($event);
			$data['request_count'] = $this->Event_model->Request_count($event);
			$data['contributions'] = $this->Event_model->Total_contribution($event);
			$data['registrations'] = $this->Event_model->Total_registration($event);
			
			
			if($this->input->post())
			{
				if($this->input->post('send_request') == 'send_request') 
				{
					$this->form_validation->set_rules('r_amount','r_amount','required');
					$this->form_validation->set_rules('r_event','r_event','required');
					$this->form_validation->set_rules('r_sponsor','r_sponsor','required');
					
					if($this->form_validation->run() == true)
					{
						$update = $this->Event_model->organiser_amount_request();
						if($update)
						{
							$this->session->set_flashdata('successMsg', 'Request sent Successfully!');
						}
					}
				}
				else if($this->input->post('send_message') == 'send_message') 
				{
					$this->form_validation->set_rules('m_msg','m_msg','required');
					if($this->form_validation->run() == true)
					{
						$update = $this->Event_model->organiser_message_send();
						if($update)
						{
							$this->session->set_flashdata('successMsg', 'Message sent Successfully!');
						}
					}
				}
				else if($this->input->post('upload_img') == 'upload_img')
				{
					$this->form_validation->set_rules('userfile','userfile','required');
					
						$send = $this->Event_model->organiser_send_receipt();
						if($send)
						{
							$this->session->set_flashdata('successMsg', 'Uploaded Successfully!');
							//redirect(base_url('Event_management/event_send_invitation'));
						}
						else
						{
							$this->session->set_flashdata('errorMsg', 'Error !');
							//redirect(base_url('Event_management/event_send_invitation'));
						}
					
				}
				 
			}
			
			theme('event_payment_view', $data);
	}

public function payment_details()
     {
         $sponsorship=$_POST['sponsorship'];
		 $event=$_POST['event'];
		 
		 echo '<div class="col-md-12" id="p_details">';
			 echo '<div class="box box-primary">';
			 /* Payment Details */
			 echo'<div class="col-md-6">';
			 echo '<div class="box-header">
                    <h3 class="box-title" style="color:#03F">Payment Details</h3>
                </div>';
				$query = $this->Event_model->get_fund_details($sponsorship);
				
				if($query->num_rows() > 0)
				{
					echo '<table class="table table-striped">
					<tr>
					<th>Transferred To</th>
					<th>Transferred By</th>
					<th>Transferred Amount</th>
					<th>Transferred Date</th>
					</tr>';
					foreach($query->result() as $r)
         			{
						$get_name_to = $this->db->get_where('users', ['id'=>$r->transferred_to]);
						foreach($get_name_to->result() as $nt);
						 $transferred_to = $nt->first_name.' '.$nt->last_name;
						
						$get_name_by = $this->db->get_where('users', ['id'=>$r->transferred_by]);
						foreach($get_name_by->result() as $nb);
						 $transferred_by = $nb->first_name.' '.$nb->last_name;
						echo '<tr>';
						echo '<td>'.$transferred_to.'</td>';
						echo '<td>'.$transferred_by.'</td>';
						echo '<td>'.$r->transferred_amount.'</td>';
						echo '<td>'.date('Y-m-d H:m:i',$r->transferred_at).'</td>';
						echo '</tr>';
					}
					echo '</table>';
				}
				else
				{
					echo 'Not transferred yet..';
				}
			 	
			 echo '</div>';
			  /*Inbox */
			 echo'<div class="col-md-6">';
			 echo '<div class="box-header">
                    <h3 class="box-title" style="color:#03F">Chat Box</h3>
                </div>';
				echo '<input type="hidden" name="re_event" id="re_event" value="'.$event.'">
					<input type="hidden" name="re_sponsor" id="re_sponsor" value="'.$sponsorship.'">';
			 	echo ' <button type="button" align="center" class="btn btn-primary" onclick="show_send_request();" ><i class="fa fa-money"></i> Send_request</button>';
				echo ' <button type="button" align="center" class="btn btn-primary" onclick="show_upload_receipt();" ><i class="fa fa-upload"></i> Upload Receipt</button>';
				echo ' <button type="button" align="center" class="btn btn-primary" onclick="show_send_message();" ><i class="fa fa-edit"></i> Send Message</button>';
				echo ' <button type="button" align="center" class="btn btn-primary" onclick="show_inbox();" ><i class="fa fa-download"></i> Inbox</button><br><br>';
				echo ' <button type="button" align="center" class="btn btn-primary" onclick="show_outbox();" ><i class="fa fa-list"></i> OutBox</button>';
			 echo '</div>';
			 echo'</div>';
		 echo '</div>';
         
		
     }
	 //
	 public function organiser_message_outbox()
	 {
		 $event=$_POST['event'];
		 $sponsorship=$_POST['sponsorship'];
		
		 $query = $this->Event_model->organiser_message_outbox($event,$sponsorship);
		 echo '<h4>Messages</h4>';
			 
		 if($query ->num_rows() > 0)
		 {
			 echo '<table class="table table-striped"><tr><th>Sl:No</th><th>Message</th><th>Date</th></tr>';
			 $cnt =1;
			foreach($query->result() as $r)
			{
				echo '<tr>';
				echo '<td>'.$cnt.'</td>';
				echo '<td>'.$r->description.'</td>';
				echo '<td>'.date('Y-m-d h:m:i',$r->created_at).'</td>';
				echo '</tr>';
				$cnt ++;
			}
			echo '</table>';
		 }
		 else
		 {
			 echo 'No Results';
		 }
		 
	 }
	 public function organiser_receipt_outbox()
	 {
		 $event=$_POST['event'];
		 $sponsorship=$_POST['sponsorship'];
		
		 $query = $this->Event_model->organiser_receipt_outbox($event,$sponsorship);
		 echo '<h4>Receipts</h4>';
			 
		 if($query ->num_rows() > 0)
		 {
			 echo '<table class="table table-striped"><tr><th>Sl:No</th><th>Image</th><th>Description</th><th>Date</th></tr>';
			 $cnt =1;
			foreach($query->result() as $r)
			{
				echo '<tr>';
				echo '<td>'.$cnt.'</td>';
				echo '<td>'.$r->receipt_img.'</td>';
				echo '<td>'.$r->description.'</td>';
				echo '<td>'.date('Y-m-d h:m:i',$r->created_at).'</td>';
				echo '</tr>';
				$cnt ++;
			}
			echo '</table>';
		 }
		 else
		 {
			 echo 'No Results';
		 }
		 
	 }
	 public function organiser_request_outbox()
	 {
		 $event=$_POST['event'];
		 $sponsorship=$_POST['sponsorship'];
		
		 $query = $this->Event_model->organiser_request_outbox($event,$sponsorship);
		 echo '<h4>Amount Requests</h4>';
			 
		 if($query ->num_rows() > 0)
		 {
			 echo '<table class="table table-striped"><tr><th>Sl:No</th><th>Amount</th><th>Description</th><th>Date</th><th>Transferred?</th></tr>';
			 $cnt =1;
			foreach($query->result() as $r)
			{
				echo '<tr>';
				echo '<td>'.$cnt.'</td>';
				echo '<td>'.$r->amount.'</td>';
				echo '<td>'.$r->description.'</td>';
				echo '<td>'.date('Y-m-d h:m:i',$r->created_at).'</td>';
				if($r->transfer == 1)
				{
					$transfer = 'Yes';
				}
				else
				{
					$transfer = 'No';
				}
				echo '<td>'.$transfer.'</td>';
				echo '</tr>';
				$cnt ++;
			}
			echo '</table>';
		 }
		 else
		 {
			 echo 'No Results';
		 }
		 
	 }
	 public function organiser_message_inbox()
	 {
		 $event=$_POST['event'];
		 $sponsorship=$_POST['sponsorship'];
		
		 $query = $this->Event_model->organiser_message_inbox($event,$sponsorship);
		 echo '<h4>Messages</h4>';
			 
		 if($query ->num_rows() > 0)
		 {
			 echo '<table class="table table-striped"><tr><th>Sl:No</th><th>Message</th><th>Date</th></tr>';
			 $cnt =1;
			foreach($query->result() as $r)
			{
				echo '<tr>';
				echo '<td>'.$cnt.'</td>';
				echo '<td>'.$r->description.'</td>';
				echo '<td>'.date('Y-m-d h:m:i',$r->created_at).'</td>';
				echo '</tr>';
				$cnt ++;
			}
			echo '</table>';
		 }
		 else
		 {
			 echo 'No Results';
		 }
		 
	 }
	 public function organiser_receipt_inbox()
	 {
		 $event=$_POST['event'];
		 $sponsorship=$_POST['sponsorship'];
		
		 $query = $this->Event_model->organiser_receipt_inbox($event,$sponsorship);
		 echo '<h4>Receipts</h4>';
			 
		 if($query ->num_rows() > 0)
		 {
			 echo '<table class="table table-striped"><tr><th>Sl:No</th><th>Image</th><th>Description</th><th>Date</th></tr>';
			 $cnt =1;
			foreach($query->result() as $r)
			{
				echo '<tr>';
				echo '<td>'.$cnt.'</td>';
				echo '<td>'.$r->receipt_img.'</td>';
				echo '<td>'.$r->description.'</td>';
				echo '<td>'.date('Y-m-d h:m:i',$r->created_at).'</td>';
				echo '</tr>';
				$cnt ++;
			}
			echo '</table>';
		 }
		 else
		 {
			 echo 'No Results';
		 }
		 
	 }
	 public function organiser_request_inbox()
	 {
		 $event=$_POST['event'];
		 $sponsorship=$_POST['sponsorship'];
		
		 $query = $this->Event_model->organiser_request_inbox($event,$sponsorship);
		 echo '<h4>Amount Requests</h4>';
			 
		 if($query ->num_rows() > 0)
		 {
			 echo '<table class="table table-striped"><tr><th>Sl:No</th><th>Amount</th><th>Description</th><th>Date</th><th>Transferred?</th></tr>';
			 $cnt =1;
			foreach($query->result() as $r)
			{
				echo '<tr>';
				echo '<td>'.$cnt.'</td>';
				echo '<td>'.$r->amount.'</td>';
				echo '<td>'.$r->description.'</td>';
				echo '<td>'.date('Y-m-d h:m:i',$r->created_at).'</td>';
				if($r->transfer == 1)
				{
					$transfer = 'Yes';
				}
				else
				{
					$transfer = 'No';
				}
				echo '<td>'.$transfer.'</td>';
				echo '</tr>';
				$cnt ++;
			}
			echo '</table>';
		 }
		 else
		 {
			 echo 'No Results';
		 }
		 
	 }
	 //
	 /* ends */
	 /* Event Contractor  Payments */
	public function event_contractor_payments()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$events = $this->db->get_where('em_sponsorship', ['give_to' => $user_id]);
		
		if($events->num_rows() > 0)
		{
			
			theme('event_contractor_payments');
			
		}
		else
		{
			permittedArea();
		}
	}
	public function Contractor_PaymentListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Event_model->C_Payment_listCount();
		$query = $this->Event_model->C_Payments($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 foreach ($query->result() as $sponsorships) 
			 {
				 
				 //Action Button
				  $button = '';
				 
              
			  
               	 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Event_management/event_Contractor_view/' . $sponsorships->event) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				  
				 
				$get_event_details = $this->db->get_where('em_events', ['event'=>$sponsorships->event]);
					foreach($get_event_details->result() as $ev);
					$event = $ev->event;
					$ename = $ev->name;
					$budget = $ev->budget;
					$elocation = $ev->location;
					$start_date = $ev->start_date;
					$end_date = $ev->end_date;
				
				
				//
				
				$data['data'][] = array(
                    $button,
					$event,
					$ename,
					$budget,
                    $elocation,
                    $start_date,
                    $end_date
					
                );
				
			 }
		 }
		 else
		 {
			 $data['data'][] = array(
                'No results found', '', '', '', '','' , '', '', ''
            );
		 }
		  echo json_encode($data);
	}
	/* event_payment_details */
	public function event_Contractor_view($event) 
	{
			$user_info = $this->session->userdata('logged_user');
       		 $user_id = $user_info['user_id'] ;
			 
			$data['event'] = $this->db->get_where('em_events', ['event' => $event]);
			$data['reg_count'] = $this->Event_model->Reg_count($event);
			$data['sponsorship_count'] =  $this->Event_model->Sponsorship_count($event);
			$data['request_count'] = $this->Event_model->Request_count($event);
			$data['sponsors'] = $this->db->get_where('em_sponsorship', ['event' => $event , 'give_to' =>$user_id ]);
			if($this->input->post())
			{
				if($this->input->post('send_request') == 'send_request') 
				{
					$this->form_validation->set_rules('r_amount','r_amount','required');
					$this->form_validation->set_rules('r_event','r_event','required');
					$this->form_validation->set_rules('r_sponsor','r_sponsor','required');
					
					if($this->form_validation->run() == true)
					{
						$update = $this->Event_model->contractor_amount_request();
						if($update)
						{
							$this->session->set_flashdata('successMsg', 'Request sent Successfully!');
						}
					}
				}
				else if($this->input->post('send_message') == 'send_message') 
				{
					$this->form_validation->set_rules('m_msg','m_msg','required');
					if($this->form_validation->run() == true)
					{
						$update = $this->Event_model->contractor_message_send();
						if($update)
						{
							$this->session->set_flashdata('successMsg', 'Message sent Successfully!');
						}
					}
				}
				else if($this->input->post('upload_img') == 'upload_img')
				{
					$this->form_validation->set_rules('userfile','userfile','required');
					
						$send = $this->Event_model->contractor_send_receipt();
						if($send)
						{
							$this->session->set_flashdata('successMsg', 'Uploaded Successfully!');
							//redirect(base_url('Event_management/event_send_invitation'));
						}
						else
						{
							$this->session->set_flashdata('errorMsg', 'Error !');
							//redirect(base_url('Event_management/event_send_invitation'));
						}
					
				}
				 
			}
			
			theme('event_Contractor_view', $data);
	}
	public function Contractor_payment_details()
     {
         $sponsorship=$_POST['sponsorship'];
		 $event=$_POST['event'];
		 
		 echo '<div class="col-md-12" id="p_details">';
			 echo '<div class="box box-primary">';
			 /* Payment Details */
			 echo'<div class="col-md-6">';
			 echo '<div class="box-header">
                    <h3 class="box-title" style="color:#03F">Payment Details</h3>
                </div>';
				$query = $this->Event_model->get_fund_details($sponsorship);
				
				if($query->num_rows() > 0)
				{
					echo '<table class="table table-striped">
					<tr>
					<th>Transferred By</th>
					<th>Transferred Amount</th>
					<th>Transferred Date</th>
					</tr>';
					foreach($query->result() as $r)
         			{
						
						
						$get_name_by = $this->db->get_where('users', ['id'=>$r->transferred_by]);
						foreach($get_name_by->result() as $nb);
						 $transferred_by = $nb->first_name.' '.$nb->last_name;
						echo '<tr>';
						echo '<td>'.$transferred_by.'</td>';
						echo '<td>'.$r->transferred_amount.'</td>';
						echo '<td>'.date('Y-m-d H:m:i',$r->transferred_at).'</td>';
						echo '</tr>';
					}
					echo '</table>';
				}
				else
				{
					echo 'Not transferred yet..';
				}
			 	
			 echo '</div>';
			 /*Inbox */
			 echo'<div class="col-md-6">';
			 echo '<div class="box-header">
                    <h3 class="box-title" style="color:#03F">Chat Box</h3>
                </div>';
				echo '<input type="hidden" name="re_event" id="re_event" value="'.$event.'">
					<input type="hidden" name="re_sponsor" id="re_sponsor" value="'.$sponsorship.'">';
			 	echo ' <button type="button" align="center" class="btn btn-primary" onclick="show_send_request();" ><i class="fa fa-money"></i> Send_request</button>';
				echo ' <button type="button" align="center" class="btn btn-primary" onclick="show_upload_receipt();" ><i class="fa fa-upload"></i> Upload Receipt</button>';
				echo ' <button type="button" align="center" class="btn btn-primary" onclick="show_send_message();" ><i class="fa fa-edit"></i> Send Message</button>';
				echo ' <button type="button" align="center" class="btn btn-primary" onclick="show_inbox();"><i class="fa fa-download"></i> Inbox</button><br><br>';
				echo ' <button type="button" align="center" class="btn btn-primary" onclick="show_outbox();" ><i class="fa fa-list"></i> OutBox</button>';
			 echo '</div>';
			 echo'</div>';
		 echo '</div>';
         
		
     }
	 public function Contractor_message_outbox()
	 {
		 $event=$_POST['event'];
		 $sponsorship=$_POST['sponsorship'];
		
		 $query = $this->Event_model->Contractor_message_outbox($event,$sponsorship);
		 echo '<h4>Messages</h4>';
			 
		 if($query ->num_rows() > 0)
		 {
			 echo '<table class="table table-striped"><tr><th>Sl:No</th><th>Message</th><th>Date</th></tr>';
			 $cnt =1;
			foreach($query->result() as $r)
			{
				echo '<tr>';
				echo '<td>'.$cnt.'</td>';
				echo '<td>'.$r->description.'</td>';
				echo '<td>'.date('Y-m-d h:m:i',$r->created_at).'</td>';
				echo '</tr>';
				$cnt ++;
			}
			echo '</table>';
		 }
		 else
		 {
			 echo 'No Results';
		 }
		 
	 }
	 public function Contractor_receipt_outbox()
	 {
		 $event=$_POST['event'];
		 $sponsorship=$_POST['sponsorship'];
		
		 $query = $this->Event_model->Contractor_receipt_outbox($event,$sponsorship);
		 echo '<h4>Receipts</h4>';
			 
		 if($query ->num_rows() > 0)
		 {
			 echo '<table class="table table-striped"><tr><th>Sl:No</th><th>Image</th><th>Description</th><th>Date</th></tr>';
			 $cnt =1;
			foreach($query->result() as $r)
			{
				echo '<tr>';
				echo '<td>'.$cnt.'</td>';
				echo '<td>'.$r->receipt_img.'</td>';
				echo '<td>'.$r->description.'</td>';
				echo '<td>'.date('Y-m-d h:m:i',$r->created_at).'</td>';
				echo '</tr>';
				$cnt ++;
			}
			echo '</table>';
		 }
		 else
		 {
			 echo 'No Results';
		 }
		 
	 }
	 public function Contractor_request_outbox()
	 {
		 $event=$_POST['event'];
		 $sponsorship=$_POST['sponsorship'];
		
		 $query = $this->Event_model->Contractor_request_outbox($event,$sponsorship);
		 echo '<h4>Amount Requests</h4>';
			 
		 if($query ->num_rows() > 0)
		 {
			 echo '<table class="table table-striped"><tr><th>Sl:No</th><th>Amount</th><th>Description</th><th>Date</th><th>Transferred?</th></tr>';
			 $cnt =1;
			foreach($query->result() as $r)
			{
				echo '<tr>';
				echo '<td>'.$cnt.'</td>';
				echo '<td>'.$r->amount.'</td>';
				echo '<td>'.$r->description.'</td>';
				echo '<td>'.date('Y-m-d h:m:i',$r->created_at).'</td>';
				if($r->transfer == 1)
				{
					$transfer = 'Yes';
				}
				else
				{
					$transfer = 'No';
				}
				echo '<td>'.$transfer.'</td>';
				echo '</tr>';
				$cnt ++;
			}
			echo '</table>';
		 }
		 else
		 {
			 echo 'No Results';
		 }
		 
	 }
	 public function Contractor_message_inbox()
	 {
		 $event=$_POST['event'];
		 $sponsorship=$_POST['sponsorship'];
		
		 $query = $this->Event_model->Contractor_message_inbox($event,$sponsorship);
		 echo '<h4>Messages</h4>';
			 
		 if($query ->num_rows() > 0)
		 {
			 echo '<table class="table table-striped"><tr><th>Sl:No</th><th>Message</th><th>Date</th></tr>';
			 $cnt =1;
			foreach($query->result() as $r)
			{
				echo '<tr>';
				echo '<td>'.$cnt.'</td>';
				echo '<td>'.$r->description.'</td>';
				echo '<td>'.date('Y-m-d h:m:i',$r->created_at).'</td>';
				echo '</tr>';
				$cnt ++;
			}
			echo '</table>';
		 }
		 else
		 {
			 echo 'No Results';
		 }
		 
	 }
	 public function Contractor_receipt_inbox()
	 {
		 $event=$_POST['event'];
		 $sponsorship=$_POST['sponsorship'];
		
		 $query = $this->Event_model->Contractor_receipt_inbox($event,$sponsorship);
		 echo '<h4>Receipts</h4>';
			 
		 if($query ->num_rows() > 0)
		 {
			 echo '<table class="table table-striped"><tr><th>Sl:No</th><th>Image</th><th>Description</th><th>Date</th></tr>';
			 $cnt =1;
			foreach($query->result() as $r)
			{
				echo '<tr>';
				echo '<td>'.$cnt.'</td>';
				echo '<td>'.$r->receipt_img.'</td>';
				echo '<td>'.$r->description.'</td>';
				echo '<td>'.date('Y-m-d h:m:i',$r->created_at).'</td>';
				echo '</tr>';
				$cnt ++;
			}
			echo '</table>';
		 }
		 else
		 {
			 echo 'No Results';
		 }
		 
	 }
	 public function Contractor_request_inbox()
	 {
		 $event=$_POST['event'];
		 $sponsorship=$_POST['sponsorship'];
		
		 $query = $this->Event_model->Contractor_request_inbox($event,$sponsorship);
		 echo '<h4>Amount Requests</h4>';
			 
		 if($query ->num_rows() > 0)
		 {
			 echo '<table class="table table-striped"><tr><th>Sl:No</th><th>Amount</th><th>Description</th><th>Date</th><th>Transferred?</th></tr>';
			 $cnt =1;
			foreach($query->result() as $r)
			{
				echo '<tr>';
				echo '<td>'.$cnt.'</td>';
				echo '<td>'.$r->amount.'</td>';
				echo '<td>'.$r->description.'</td>';
				echo '<td>'.date('Y-m-d h:m:i',$r->created_at).'</td>';
				if($r->transfer == 1)
				{
					$transfer = 'Yes';
				}
				else
				{
					$transfer = 'No';
				}
				echo '<td>'.$transfer.'</td>';
				echo '</tr>';
				$cnt ++;
			}
			echo '</table>';
		 }
		 else
		 {
			 echo 'No Results';
		 }
		 
	 }
	/* ends */
/* user event lists */
	public function events()
	{
		/*$data['wal_debit']  	= $this->ledger_model->total_wallet_debit();
		$data['wal_credit']  	= $this->ledger_model->total_wallet_credit();*/
		//$data['p']  	= $this->Event_model->UserEventList();
		theme('events');
	}
	public function UserEventListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		//
		$wal_debit	= $this->ledger_model->total_wallet_debit();
		$wal_credit	= $this->ledger_model->total_wallet_credit();
		foreach( $wal_debit->result() 		as $wal_debit);
		foreach( $wal_credit->result() 		as $wal_credit); 
		$wal_debit			= $wal_debit->debit;
		$wal_credit      	= $wal_credit->credit;
		$wallet_balance    = ( $wal_debit - $wal_credit ) ;
		$balance=$wallet_balance;
		//
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
		
		$queryCount = $this->Event_model->UserEventListCount();
		$query = $this->Event_model->UserEventList();
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query) 
		 {
			 $result = explode(',',$query);
			 foreach ($result as $result_event) 
			 {
				 /*check user already join or not */
				 $user_event = $this->db->get_where('em_users', ['event' => $result_event,'user' => $user_id,'accept' =>1 ]);
				 $user_event_count=$user_event->num_rows();
				 /*./ends */
				 /*check user seats */
				 $user_seat = $this->db->get_where('em_user_seats', ['event' => $result_event,'user' => $user_id ]);
				 $user_seat_count=$user_seat->num_rows();
				 /*./ends */
				 /*check user already sent request or not */
				 $user_event_req = $this->db->get_where('em_user_requests', ['event' => $result_event,'requested_by' => $user_id ]);
				 $user_event_req_count=$user_event_req->num_rows();
				 /*./ends */
				 $event = $this->db->get_where('em_events', ['event' => $result_event]);
				 foreach ($event->result() as $events)
				{
					//Action Button
                $button = '';
				$button .= '<a class="btn btn-primary editBtn" href="' . base_url('Event_management/event_view/' . $events->event) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
					/* date check */
					/*$end_date =$events->end_date;
					$now= date('Y/m/d H:i');
					if($end_date < $now )
					{
						//update status 
							$data6 = [
							'status'               => 0
						];
				
						$query6 = $this->db->where('event', $events->event)->update('em_events', $data6);
						$query7 = $this->db->where('event', $events->event)->update('em_track', $data6);
						$button .= '<font color="#FF0000"><strong> Expired <strong><font>';
					}*/
					$end_date =$events->regend_date;
					$now= date('Y/m/d H:i');
					if($end_date < $now )
					{
						/*//update status 
							$data6 = [
							'status'               => 0
						];
				
						$query6 = $this->db->where('event', $events->event)->update('em_events', $data6);
						$query7 = $this->db->where('event', $events->event)->update('em_track', $data6);*/
						//$button .= '<font color="#FF0000"><strong> Expired <strong><font>';
					}
					else
					{
					/* */
				 
               	 
					if ($events->participants > 0 && $user_event_count ==0)
					{
			  $button .= '<a class="btn btn-warning " href="' . base_url('Event_management/event_join/' . $events->event) . '" data-toggle="tooltip"  title="Join"><i class="fa fa-thumbs-up"></i> </a> ';
			  
					}
					else if ($user_event_req_count ==0 && $user_event_count ==0)
					{
						 $button .= '<a class="btn btn-warning " href="' . base_url('Event_management/event_request/' . $events->event) . '" data-toggle="tooltip" title="Send Request"><i class="fa fa-user"></i> </a> ';
					}
			   }
			   if ($user_seat_count >0)
					{
						 $button .= '<a class="btn btn-warning " href="' . base_url('Event_management/event_seats/' . $events->event) . '" data-toggle="tooltip" title="Seats"><i class="fa fa-list"></i> </a> ';
					}
			   $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Event_management/event_sponsor/' . $events->event) . '"  title="Contribute"><i class="fa fa-money"></i> </a> ';
				$get_location_name = $this->db->get_where('pincode', ['id'=>$events->location]);
					foreach($get_location_name->result() as $l);
				$location = $l->location;
				
				$data['data'][] = array(
                    $button,
					$events->event,
					$events->name,
					$events->budget,
                    $location,
                    $events->start_date,
                    $events->end_date
                    
                );
				
			 }
			 }
		 }
		 else
		 {
			 $data['data'][] = array(
                'No results found', '', '', '', '','' , ''
            );
		 }
		  echo json_encode($data);
	}
/* end */
 /* Event user contributions */
	public function event_my_contributions()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		theme('event_my_contributions');
		
	}
	public function my_contributionsListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        
		
		$queryCount = $this->Event_model->my_c_listCount();
		$query = $this->Event_model->my_contributions($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 foreach ($query->result() as $sponsorships) 
			 {
				 
				 //Action Button
				  $button = '';
				 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Event_management/event_view/' . $sponsorships->event) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				  
				 /* event details*/
				$get_event_details = $this->db->get_where('em_events', ['event'=>$sponsorships->event]);
					foreach($get_event_details->result() as $ev);
					$event = $ev->event;
					$ename = $ev->name;
					 /* sponsorship details*/
				$get_spon_details = $this->db->get_where('em_sponsorship', ['sponsorship'=>$sponsorships->sponsorship]);
					foreach($get_spon_details->result() as $sp);
					$for = $sp->title;
					
				//
				
				$data['data'][] = array(
                    $button,
					$ename,
					$for,
					$sponsorships->amount,
                    date('Y-m-d H:m:i',$sponsorships->created_at)
					
                );
				
			 }
		 }
		 else
		 {
			 $data['data'][] = array(
                'No results found', '', '', '', ''
            );
		 }
		  echo json_encode($data);
	}
	/* Event user joined */
	public function event_joined_events()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		theme('event_joined_events');
		
	}
	public function joined_eventsListJson() 
	{
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        
		
		$queryCount = $this->Event_model->joined_listCount();
		$query = $this->Event_model->joined_events($limit,$start);
		
		$draw = $this->input->get('draw');
		$data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;
		
		 if ($query->num_rows() > 0) 
		 {
			 foreach ($query->result() as $sponsorships) 
			 {
				 
				 //Action Button
				  $button = '';
				 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Event_management/event_view/' . $sponsorships->event) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				  
				 /* event details*/
				$get_event_details = $this->db->get_where('em_events', ['event'=>$sponsorships->event]);
					foreach($get_event_details->result() as $ev);
					$event = $ev->event;
					$ename = $ev->name;
					$dt =  $ev->start_date. ' - '. $ev->end_date;
					$get_location_name = $this->db->get_where('pincode', ['id'=>$ev->location]);
					foreach($get_location_name->result() as $l);
					$location = $l->location;
					/* date check */
					$end_date =$ev->end_date;
					$now= date('Y/m/d H:i');
					if($end_date < $now )
					{
						//update status 
							$data6 = [
							'status'               => 2
						];
				
						$query6 = $this->db->where('event', $ev->event)->update('em_events', $data6);
						$query7 = $this->db->where('event', $ev->event)->update('em_track', $data6);
						//$button .= '<font color="#FF0000"><strong> Expired <strong><font>';
					}
                    //
					if($ev->status == 1)
				{
					$status = '<font color="#00CC00">Active</font>';
				}
				else if($ev->status == 0)
				{
					$status = '<font color="#CC0000">Inactive</font>';
				}
				else if($ev->status == 2)
				{
					$status = '<font color="#FF6600">Closed</font>';
				}
				if($sponsorships->sponsored == 1)
				{
					$sponsored = 'Yes';
				}
				else
				{
					$sponsored = 'No';
				}
					 /* seat details*/
				$seats = $this->db->get_where('em_user_seats', ['event'=>$sponsorships->event,'user'=>$user_id]);
					 if ( $seats->num_rows() > 0) {
						 $user_seats ='';
						foreach ($seats->result() as $st)
						{
							$user_seats = 'Seat<strong>'.$st->seat_no.'</strong> , '.$user_seats;
							
						}
					 }
					
				//
				
				$data['data'][] = array(
                    $button,
					$ename,
					$location,
					$dt,
					$status,
					$user_seats,
					$sponsored,
					date('Y-m-d H:m:i',$sponsorships->created_at)
				);
				
			 }
		 }
		 else
		 {
			 $data['data'][] = array(
                'No results found', '', '', '', '','' , '', ''
            );
		 }
		  echo json_encode($data);
	}
	//
	public function event_create_mine()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
			//$data['locations'] = $this->db->order_by('location', 'asc')->get('pincode');
			$data['seat_category'] = $this->db->order_by('name', 'asc')->get_where('em_seat_category', ['category_type'=>'main']);
			$data['category'] = $this->db->order_by('name', 'asc')->get_where('em_category', ['category_type'=>'main']);
			$data['countrys'] = $this->db->group_by('country')->get('pincode');
			$data['users'] = $this->db->order_by('first_name', 'asc')->get_where('users', ['rolename'=>12]);
			$data['roles'] = $this->db->order_by('rolename', 'asc')->get('role');
			$data['bgs'] = $this->db->order_by('business_name', 'asc')->get('business_groups');
			if($this->input->post())
			{
				if($this->input->post('submit') != 'create_event') die('Error! sorry');
				$this->form_validation->set_rules('budget','budget','required');
				$this->form_validation->set_rules('name','name','required');
				$this->form_validation->set_rules('location','location','required');
				$this->form_validation->set_rules('venue','venue','required');
				$this->form_validation->set_rules('rf_time','rf_time','required');
				$this->form_validation->set_rules('f_time','f_time','required');
				
				
				if($this->form_validation->run() == true)
				{
					$create = $this->Event_model->event_create_mine();
					if($create)
					{
						$this->session->set_flashdata('successMsg', 'New Event created Successfully!');
						redirect(base_url('Event_management/event_list'));
					}
	
				}
			}
			theme('event_create_mine',$data);
	}
	//
	//
	public function send_sms()
     {
         $event=$_POST['event'];
		 $phn=$_POST['phn'];
		 $budget=$_POST['budget'];
		 $name=$_POST['name'];
		 $send_now = $this->notification_model->EM_organiser($event,$phn,$budget,$name);
		 echo "SMS sent successfully";
	}
	public function event_accept_request($event) 
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
			$data['event'] = $this->db->get_where('em_events', ['event' => $event]);
			$data['labels'] = $this->db->get_where('em_labels', ['event' => $event]);
			$data['seats'] = $this->db->get_where('em_seats', ['event' => $event]);
			$data['users'] = $this->db->order_by('first_name', 'asc')->get_where('users', ['rolename'=>12]);
			$data['category'] = $this->db->order_by('name', 'asc')->get_where('em_category', ['category_type'=>'main']);
			$data['roles'] = $this->db->order_by('rolename', 'asc')->get('role');
			$data['bgs'] = $this->db->order_by('business_name', 'asc')->get('business_groups');
			if($this->input->post())
			{
				if($this->input->post('submit') != 'accept_now') die('Error! sorry');
				
				$this->form_validation->set_rules('status','status','required');
				
				if($this->form_validation->run() == true)
				{
					$create = $this->Event_model->event_accept_request($event);
					if($create)
					{
						$this->session->set_flashdata('successMsg', 'Approved Successfully!');
						redirect(base_url('Event_management/event_list'));
					}
	
				}
			}
			theme('event_accept_request', $data);
	}
/* user joining */
	public function event_join($event) 
	{
		$data['seats'] = $this->db->get_where('em_seats', ['event' => $event]);
		$data['event'] = $event;
		theme('event_join',$data);
		/*$join = $this->Event_model->event_join($event);
		if($join)
		{
			$this->session->set_flashdata('successMsg', ' Success');
			redirect(base_url('Event_management/events'));
		}*/
	}
	public function user_join() 
	{
		/*User balance*/
		$wal_debit	= $this->ledger_model->total_wallet_debit();
		$wal_credit	= $this->ledger_model->total_wallet_credit();
		foreach( $wal_debit->result() 		as $wal_debit);
		foreach( $wal_credit->result() 		as $wal_credit); 
		$wal_debit			= $wal_debit->debit;
		$wal_credit      	= $wal_credit->credit;
		$wallet_balance    = ( $wal_debit - $wal_credit ) ;
		$balance=$wallet_balance;
		//
		$event=$_POST['event'];
		$seats=$_POST['seats'];
		$seat = explode(',',$seats);
		$fee =0;
		$j =count($seat)-1;
		/* Calculate total fee*/
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
			}
		}
		//
		if($balance < $fee)
		{
			echo 0;
		}
		else
		{
			//echo $event;
			$join = $this->Event_model->user_join($event,$seats);
			
			if($join)
			{
				echo $join;
			}
			
		}
		
	}
	public function event_user_seats($event) 
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$data['seats'] = $this->db->get_where('em_user_seats', ['event' => $event,'user' => $user_id]);
		$data['event'] = $this->db->get_where('em_events', ['event' => $event]);
		if($this->input->post())
			{
				if($this->input->post('submit') != 'pay_now') die('Error! sorry');
				
				//
				$seats = $this->db->get_where('em_user_seats', ['event'=>$event,'user' => $user_id]);
				foreach($seats->result() as $st)
				{
					
					$this->form_validation->set_rules($st->id,$st->id,'required');
				}
				 
				//
				
				if($this->form_validation->run() == true)
				{
					
					$pay = $this->Event_model->event_user_seats($event);
					if($pay)
					{
						$this->session->set_flashdata('successMsg', 'You have joined Successfully!');
						redirect(base_url('Event_management/event_seats/'.$event));
					}
					else
					{
						$this->session->set_flashdata('errorMsg', 'You have joined Successfully!');
					}
	
				}
			}
		theme('event_user_seats',$data);
		
		/*$join = $this->Event_model->event_join($event);
		if($join)
		{
			$this->session->set_flashdata('successMsg', ' Success');
			redirect(base_url('Event_management/events'));
		}*/
	}
	//
	public function user_seat_cancel() 
	{
		$event=$_POST['event'];
		$seats=$_POST['seats'];
		$deduction=$_POST['deduction'];
		$total=$_POST['total'];
		$refund = $total - $deduction;
		$seat = explode(',',$seats);
		
		$fee =0;
		$j =count($seat)-1;
		/*logged user details*/
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$receiver_referral_code = singleDbTableRow($user_id)->referral_code;
		/*event creator details*/
		 $get_receiver = $this->db->get_where('em_events', ['event'=>$event]);
		foreach($get_receiver->result() as $rc);
		 $receiver = $rc->created_by;
		 $sender_referral_code = singleDbTableRow($receiver)->referral_code;
		//
		
		/* delete*/
		for($i=0;$i<$j;$i++)
		{
			$st = $seat[$i];
			/* seat_no*/$get_seat_no = $this->db->get_where('em_user_seats', ['id'=>$st]);
				foreach($get_seat_no->result() as $p);
				 $seat_no = $p->seat_no;/* */
			/*Insert into em_seat_cancel*/
			$data = [
			'event'               => $event,
			'seat_id'             => $st,
			'seat_no'             => $seat_no,
			'created_by'    	  => $user_id,
			'created_at'    	  => time()
			];
			$query1 = $this->db->insert('em_seat_cancel', $data);
			/*Now delete permanently*/
			$this->db->where('id',$st,'event', $event)->delete('em_user_seats');
     		
		}
		/*check in em_users table*/
		$get_details = $this->db->get_where('em_users', ['event' => $event,'user' => $user_id]);
		foreach($get_details->result() as $de);
		 $st_no = $de->no_of_seats;
		 $st_bl = $st_no - $j;
		 if($st_bl <=0)
		 {
			 $this->db->where('user',$user_id,'event', $event)->delete('em_users');
		 }
		 else
		 {
			 $data2 = [
							'no_of_seats'               => $st_bl,
							'modified_by'               => $user_id,
							'modified_at'               => time()
						];
				
						$query2 = $this->db->where('user',$user_id,'event', $event)->update('em_users', $data2);
		 }
		 /*Refund*/
		/* paytype*/$get_paytype = $this->db->get_where('business_groups', ['id'=>23]);
				foreach($get_paytype->result() as $p);
				 $pay = $p->pay_type;/* */
			 	$pay_by_referral_code 	= 	$sender_referral_code;	// Sender's referral_code, ex : 5559990001
				$pay_to_referral_code 	= 	 $receiver_referral_code;// Receiver's referral_code, ex : 5164830972
				$amount_to_pay		  	=	$refund;			// Total amont to pay (or) transfer, ex : 100
				$pay_spec_type			=	$pay;				// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
				$transaction_remarks	=	'Event Management Seat Cancellation';	// remarks to insert into invoice table, ex : "Transfer Values";
				$pm_mode				=	'wallet';			// points_mode, ex : wallet, loyality, discount.
				
				
				$insert = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);

				echo 'success';
		 
		
	}
	//
	public function event_seats($event) 
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$data['seats'] = $this->db->get_where('em_user_seats', ['event' => $event,'user' => $user_id]);
		$data['event'] = $this->db->get_where('em_events', ['event' => $event]);
		
		theme('event_seats',$data);
		
	}
/* ends */
/* user event_request */
	public function event_request($event) 
	{
		$join = $this->Event_model->event_request($event);
		if($join)
		{
			$this->session->set_flashdata('successMsg', ' request sent Successfully');
			redirect(base_url('Event_management/events'));
		}
	}
/* ends */
/* user event_request */
	public function event_sponsor($event)
	{
		//$data['sponsor']  	= $this->Event_model->event_sponsor($event);
		$data['sponsors'] = $this->db->get_where('em_sponsorship', ['event' => $event]);
		$data['event']  	= $event;
		theme('event_sponsor',$data);
	}
/* ends */
/* PAY */
	public function pay_now() 
	{
		$amount = $_POST['amount'];
		$sponsorID = $_POST['sponsor'];
		$event = $_POST['event'];
		//
		$wal_debit	= $this->ledger_model->total_wallet_debit();
		$wal_credit	= $this->ledger_model->total_wallet_credit();
		foreach( $wal_debit->result() 		as $wal_debit);
		foreach( $wal_credit->result() 		as $wal_credit); 
		$wal_debit			= $wal_debit->debit;
		$wal_credit      	= $wal_credit->credit;
		$wallet_balance    = ( $wal_debit - $wal_credit ) ;
		$balance=$wallet_balance;
		//
		if($balance < $amount)
		{
			echo "You have only ".round($balance ,3)." rupees.Please increase your CPA balance";
		}
		else
		{
			$pay = $this->Event_model->pay_now($amount,$sponsorID,$event);
			if($pay)
			{
				echo "Thank you for your contribution...";
			}
		}
		
	}
/* ends */
/* transfer */
public function transfer_now() 
	{
		$amount = $_POST['amount'];
		$sponsorID = $_POST['sponsor'];
		$event = $_POST['event'];
		$give_to = $_POST['give_to'];
		/* get event manager balance*/
		$get_sender = $this->db->get_where('em_events', ['event'=>$event]);
		foreach($get_sender->result() as $sc);
		 $sender = $sc->organised_by;
		 $user_acc_no = singleDbTableRow($sender)->account_no;
		
				$user_debit = $this->db->select_sum('debit')->get_where('accounts', ['points_mode'=>'wallet', 'account_no' =>$user_acc_no]); 
				foreach( $user_debit->result() 		as $user_debit);
				$users_debit			= $user_debit->debit;
				// sum of credit
				$user_credit = $this->db->select_sum('credit')->get_where('accounts', ['points_mode'=>'wallet', 'account_no' =>$user_acc_no]);; 
				foreach( $user_credit->result() 	as $user_credit);		
				$users_credit      	= $user_credit->credit;
				
				$user_balance       = ( $users_debit - $users_credit ) ; //Available balance
		//
		if($user_balance >= $amount)
		{
			$transfer = $this->Event_model->transfer_now($amount,$sponsorID,$event,$give_to);
			if($transfer)
			{
				echo "Transferred Successfully...";
			}
			else
			{
				echo "Sorry...";
			}
		}
		else
		{
			echo "Sorry..Insufficient balance";
		}
		
	}
/* ends */
/* Send Email Notifications*/
	public function send_notification()
	{
		$notify = $this->Event_model->send_notification();
		if($notify)
		{
			$this->session->set_flashdata('successMsg', ' Email sent Successfully');
			redirect(base_url('Event_management/events'));
		}
		else
		{
			$this->session->set_flashdata('errorMsg', ' Errors ');
			redirect(base_url('Event_management/events'));
		}
		
	}
/* ends*/
/*Report*/
public function event_search_report()
	{
		$data['location'] = $this->db->group_by('location')->get('em_events');
		$data['created_by'] = $this->db->group_by('created_by')->get('em_events');
		$data['organised_by'] = $this->db->group_by('organised_by')->get('em_events');
		if($this->input->post())
			{
				if($this->input->post('submit') == 'csv')
			{
				$data['events'] = $this->Event_model->events_report_csv();
			}
			}
		theme('event_search_report',$data);
	}
	public function search_report()
	{
		$location=$_POST['location'];
		$status=$_POST['status'];
		$created_by=$_POST['created_by'];
		$organised_by=$_POST['organised_by'];
		
		$rsf_time=$_POST['rsf_time'];
		$rst_time=$_POST['rst_time'];
		$ref_time=$_POST['ref_time'];
		$ret_time=$_POST['ret_time'];
		
		$esf_time=$_POST['esf_time'];
		$est_time=$_POST['est_time'];
		$eef_time=$_POST['eef_time'];
		$eet_time=$_POST['eet_time'];
		
		$min_budget=$_POST['min_budget'];
		$max_budget=$_POST['max_budget'];
		
		$limit = $this->input->POST('length');
		$start = $this->input->POST('start');
		
		//
		$queryCount = $this->Event_model->event_search_count($location,$status,$created_by,$organised_by,$rsf_time,$rst_time,$ref_time,$ret_time,$esf_time,$est_time,$eef_time,$eet_time,$min_budget,$max_budget);

		
		$query = $this->Event_model->event_report_search($limit, $start,$location,$status,$created_by,$organised_by,$rsf_time,$rst_time,$ref_time,$ret_time,$esf_time,$est_time,$eef_time,$eet_time,$min_budget,$max_budget);

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
				$button = '<a class="btn btn-primary editBtn" href="' . base_url('Event_management/event_view/' . $r->event) . '" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> ';
				$button .= '<a class="btn btn-warning" href="' . base_url('Event_management/event_report/' . $r->event) . '" data-toggle="tooltip" title="Report"><i class="fa fa-list"></i> </a>';
				
				$contributions = $this->Event_model->Total_contribution($r->event);
				$registrations = $this->Event_model->Total_registration($r->event);
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
					$data['data'][] = array(
						$button,
						$r->event,
						$r->budget,
						singleDbTableRow($r->location, 'pincode')->location,					
						$registrations,
						$contributions,			
						$charge,										
						$balance	
								
				
					);
				}
		}else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','','','','',''
			);
		}
				echo json_encode($data);

	}
	public function get_total_budget()
	{
		$location=$_POST['location'];
		$status=$_POST['status'];
		$created_by=$_POST['created_by'];
		$organised_by=$_POST['organised_by'];
		
		$rsf_time=$_POST['rsf_time'];
		$rst_time=$_POST['rst_time'];
		$ref_time=$_POST['ref_time'];
		$ret_time=$_POST['ret_time'];
		
		$esf_time=$_POST['esf_time'];
		$est_time=$_POST['est_time'];
		$eef_time=$_POST['eef_time'];
		$eet_time=$_POST['eet_time'];
		
		$min_budget=$_POST['min_budget'];
		$max_budget=$_POST['max_budget'];
		
		$query = $this->Event_model->get_total_budget($location,$status,$created_by,$organised_by,$rsf_time,$rst_time,$ref_time,$ret_time,$esf_time,$est_time,$eef_time,$eet_time,$min_budget,$max_budget);
		if($query -> num_rows() > 0) 
	  {
		  $budget = 0;
		 foreach($query->result() as $r)
		{
			$budget = $budget + $r->budget;
		}
	  }
	  else
	  {
		  $budget = 0;
	  }
	  echo "<table class='table table-striped'>
	  <tr>
	  <th></th>
	  <th></th>
	  <th>Total Events : ".$query -> num_rows()."</th>
	  <th>Total Budget : ".$budget."</th>
	  </tr>
	  </table>
	  ";
	}
//
/*dashboard*/
	public function event_dashboard()
	{
		$data['all_events'] =$this->Event_model->count_all_events();
		$data['active_events'] =$this->Event_model->count_active_events();
		$data['inactive_events'] =$this->Event_model->count_inactive_events();
		$data['closed_events'] =$this->Event_model->count_closed_events();
		theme('event_dashboard',$data);
	}
//
}
?>