<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model {

    public function add_email() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        //set all data for inserting into database
        $data = [
            'mediam_type'         => $this->input->post('mediam_type'),
            'template_name'       => $this->input->post('template_name'),
            'content_name'        => $this->input->post('content_name'),
			'created_by'    	  => $user_id,	
			'created_at'    	  => time()	
			
        ];

       $query = $this->db->insert('content', $data);

        if($query)
        {
            create_activity('Added '.$data['created_by'].' content'); //create an activity
            return true;
        }
        return false;
	}
		
		
	


    //view emailList
    public function emailListCount() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

        if ($currentUser == 'admin') {
            $query = $this->db->count_all_results('content');
        } else {
            $query = $this->db->where('created_by ', $user_id)->count_all_results('content');
        }
        return $query;
    }

    public function emailList($limit = 0, $start = 0) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        $rolename = singleDbTableRow($user_id)->rolename;
        $email = singleDbTableRow($user_id)->email;

		$search = $this->input->get('search');	
		$searchValue = $search['value'];

		$searchByID = '';	

        if ($currentUser == 'admin') {
			if($searchValue != '')																								
			{																													
				$table_name = "content";																					
				$where_array = array( 'mediam_type' => $searchValue );															
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 		
			}																												
			else{																											
				 $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('content');
			}
			
			
           
        } 
		else {
			if($searchValue != '')																								
			{																													
				$table_name = "content";																					
				$where_array = array( 'mediam_type' => $searchValue ,'created_by' => $user_id );															
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 		
			}																												
			else
			{																											
				  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('content', ['created_by' => $user_id]);
			}
			
			
           
        }
        return $query;
     
    }

  


	
	
	   public function edit_email($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];		
      
        $data = [
          	'mediam_type'         => $this->input->post('mediam_type'),
            'template_name'       => $this->input->post('template_name'),
            'content_name'       => $this->input->post('content_name'),
			'modified_by'         => $user_id,
            'modified_at'         => time()
        ];
		 $query = $this->db->where('id', $id)->update('content', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].' content'); //create an activity
            return true;
        }
        return false;

      
    }
	public function user_name($id) 
	{
		$query1 = $this->db->get_where('users', ['id' => $id]);
								
								if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row) {
                                        $name =  $row->first_name.' '.$row->last_name;
									}
									return $name;
								} else {
                                    $name = "";
                                }
								
								
		
	}
	
	   public function consumer_sms() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		$mobile=$this->input->post('user_no');
		$msg=$this->input->post('content_name');
		$userid=$this->input->post('user_id');
		$uname=$this->user_name($userid);

		

	include_once('sendsms.php');
	
	$message="Dear ".$uname.",".$msg." ";
	$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
    $sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');
	return true;

	}
	
	
	
 public function guest_SMS() {

    include_once('sendsms.php');   
	$mobile=$this->input->post('mobile');
	$msg=$this->input->post('message');

	$message="Dear , ".$msg." we confirm the delivery of the Order No  with reciever name   by Our representitive  -Team Cfirst";

    $sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
    $sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');
	return true;

	}
	
	
	

	
	
	
   
   
	

	

}//last 
