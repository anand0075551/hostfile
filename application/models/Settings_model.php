<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    /**
     * @return default admin data...
     */

    public function adminSettings(){
        $query = $this->db->order_by('id','desc')->get('admin_settings', 1);
        return $query;
    }

    /**
     * Insert Settings Every Time
     */

    public function updateSettings(){
        $userInfo = loggedInUserData();
        $user_id = $userInfo['user_id'];

/*        $data = [
            'company_name' =>  $this->input->post('company_name'),
            'default_email' =>  $this->input->post('default_email'),
            'contact_address' =>  $this->input->post('contact_address'),
            'agent_commision' =>  $this->input->post('agent_commision'),
            'user_commision' =>  $this->input->post('user_commision'),
            'referral_commision' =>  $this->input->post('referral_commision'),
            'admin_commision' =>  $this->input->post('admin_commision'),
            'updated_by' =>  $user_id,
            'updated_at' =>  time(),
        ];

        if($this->db->insert('admin_settings', $data))
        {
            create_activity('Updated admin settings');
            $this->session->set_flashdata('successMsg', 'Settings updated');
            redirect($_SERVER['HTTP_REFERER']);
        }*/

       $data = array_diff_key($this->input->post(), ['_wysihtml5_mode', 'update']);

        foreach($data as $key => $value)
        {
            $this->db->where('option', $key)->update('options', ['value' => $value]);
        }

        create_activity('Updated admin settings');
        $this->session->set_flashdata('successMsg', 'Settings updated');
        redirect($_SERVER['HTTP_REFERER']);

    }

    public function addAdmin(){
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$referredByCode = singleDbTableRow($user_id)->referredByCode;
        $this->load->helper('string'); //load string helper

        $row_password   = $this->input->post('password');
        $password       = sha1($row_password);
		 $referral_code  = random_string('numeric',10);   //Modified to 10 digit
     //   $referral_code  = strtoupper(random_string());  //Used for Alphabets

/*		//check unique $account_no
        $getAccount_no = $this->db->get_where('users', ['account_no'=> $account_no]);
        if($getAccount_no -> num_rows() > 0)
        {
            for($i= 0; $getAccount_no -> num_rows() > 0; $i++){
                $account_no  = strtoupper(random_string());
                $getAccount_no = $this->db->get_where('users', ['account_no'=> $account_no]);
            }
        }
*/
        //check unique $referral_code

        $getReferral = $this->db->get_where('users', ['referral_code'=> $referral_code]);
        if($getReferral -> num_rows() > 0)
        {
            for($i= 0; $getReferral -> num_rows() > 0; $i++){
                $referral_code  = strtoupper(random_string());
                $getReferral = $this->db->get_where('users', ['referral_code'=> $referral_code]);
            }
        }

        $email    = $this->input->post('email');
		
        $country_id = '105'; //$this->input->post('country');		
		$postal_code = $this->input->post('postal_code');
		$rolename = $this->input->post('rolename');
		
        // get country name
        $country_query = $this->db->get_where('countries', ['id' => $country_id]);
        foreach($country_query->result() as $country);

		$account_no =  $country_id.$postal_code.$rolename.$referral_code;
        //set all data for inserting into database
        $data = [
            'first_name'        => $this->input->post('first_name'),
            'last_name'         => $this->input->post('last_name'),
            'password'          => $password,
            'email'             => $email,         
            'country'           => $country->country_name,
            'country_id'        => $country_id,
            'role'              => 'admin',
            'rolename'      	=> $this->input->post('rolename'),	
			'id_type'       	=> 'INTER',
            'adhaar_no' 	    => 'Employee',
			'account_no'		=> $account_no,
            'active'            => 1,
            'referral_code'     => $referral_code,
			'referredByCode'    => $referredByCode,
			'postal_code'	    => $postal_code,
            'created_by'        => $user_id,
            'created_at'        => time(),
            'modified_at'       => time()         
            
        ];

        $query = $this->db->insert('users', $data);

        if($query)
        {
            create_activity('Added '.$data['first_name'].' '. $data['last_name'].' as admin'); //create an activity

            $email_data = [
                'email'  => $email,
                'password'  => $row_password,
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');
            $subject = 'Congratulation '.$data['first_name'].' '. $data['last_name'];
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('email_template_password',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();

            return true;
        }
        return false;
    }

    public function adminSettingsLog(){
       // $query = $this->db->order_by('id', 'DESC')->join('users', 'comments.id = blogs.id')->get('admin_settings');
        $query = $this->db->query("select admin_settings.*, users.first_name, users.last_name
                from admin_settings
                LEFT JOIN users
                on admin_settings.updated_by = users.id
                ORDER BY admin_settings.id DESC ");

        return $query;
    }

	/* Add New User Roles to the system 
  public function add_roles(){
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

       
        $rolename = $this->input->post('rolename');
   
        //set all data for inserting into database
        $data = [
            'rolename'          => $rolename,
            'active'            => 1,
            'created_by'        => $user_id,
            'created_at'        => time(),
            'modified_at'       => time()
        ];

        $query = $this->db->insert('role', $data);

        if($query)
        {
            create_activity('Added '.$data['rolename'].' as User-Role'); //create an activity
			$email = 'anandsagar007@gmail.com';
			$row_password = 'test1234';
            $email_data = [
                'email'  => $email,
                'password'  => $row_password,
            ];

            //send email to new user
            //$settings = get_admin_settings();
            $adminEmail = get_option('default_email');
            $subject = 'Congratulation '.$data['rolename'].' '. $data['rolename'];
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from($adminEmail, get_option('company_name'));
            $this->email->to($email);
            $this->email->cc($adminEmail);
            $this->email->subject($subject);
            $message = $this->load->view('email_template_password',$email_data,TRUE);
            $this->email->message($message);
            $this->email->send();

            return true;
        }
        return false;
    }
*/
/**
     Generate User Profile Access Permissions
     */


    public function permissions(){ 

        $user_info 	   = $this->session->userdata('logged_user');
        $user_id 	   = $user_info['user_id'];
		$email 		   = $user_info['email'];
		$currentUser   = singleDbTableRow($user_id)->role;
		$referral_code = singleDbTableRow($user_id)->referral_code;
		
			$table_name = "authorizations";			
			$where_array = array('rolename' => '1');
			$query = $this->db->order_by('id', 'asc')->where($where_array )->get($table_name); 				
				
		return $query;
}
}