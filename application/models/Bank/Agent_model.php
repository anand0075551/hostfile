<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_model extends CI_Model {

   /**
     * @return bool
     */

   
/**
     * @return Bank List
     * BankList Query
     */

    public function bankListCount(){
//        $query = $this->db->where( 'role' , 'agent')->count_all_results('users');
        $query = $this->db->where( 'active' , '1')->count_all_results('bank');
        return $query;
    }

    public function bankList($limit = 0, $start = 0){
//        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'agent']);
		 $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('bank', ['active' => '1']);
        return $query;
    }



    /**
     * @param string $photo
     * Photo Resize
     */

    public function photoResize($photo = ''){
        $config['image_library'] = 'gd2';
        $config['source_image'] = $photo;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = 20000;
        $config['height']       = 20000;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        unlink($photo); // delete original photo
    }

    public function add_bank(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $this->load->helper('string'); //load string helper

        $row_password   = $this->input->post('password');
        $password       = sha1($row_password);
       // $referral_code  = random_string('numeric',6);
		$bank_account_no     =  $this->input->post('account_no');	
		$IFSC_area_name		 =  $this->input->post('area_name');
		$bank_postal_code	 =  $this->input->post('postal_code');
        
        $email = $this->input->post('email');
        $country_id = $this->input->post('country');
        // get country name
        $country_query = $this->db->get_where('countries', ['id' => $country_id]);
        foreach($country_query->result() as $country);

        $photoName = '';

        //check user is selected photo
        if($_FILES['userfile']['name'] != '')
        {
            $upload_dir = './uploads/'; //Upload directory
            if( ! file_exists($upload_dir)) mkdir($upload_dir); //create directory if not found.
            $config['upload_path']          = $upload_dir;
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            }else
            {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'].'_thumb'.$upload_data['file_ext'];
                $fullPhoto = $upload_dir.$upload_data['file_name'];
                $this->photoResize($fullPhoto); // resize now
            }
        }

        //set all data for inserting into database
        $data = [
            'first_name'        => $this->input->post('first_name'),
            'last_name'         => $this->input->post('last_name'),
            'password'          => $password,
            'row_pass'          => $row_password,
            'email'             => $email,
            'contactno'         => $this->input->post('contactno'),
            'gender'            => $this->input->post('gender'),
            'date_of_birth'     => $this->input->post('date_of_birth'),
            'profession'        => $this->input->post('profession'),
            'street_address'    => $this->input->post('street_address'),
            'country'           => $country->country_name,
            'country_id'        => $country_id,
            'role'              => 'agent', 
//			'role'              => $this->input->post('role'),
            'active'            => 1,
//            'referral_code'     => $referral_code,
			'account_no'        => $bank_account_no,			
			'area_name'   		=> $IFSC_area_name, 
			'postal_code'   	=> $bank_postal_code,			
            'photo'             => $photoName,
            'created_by'        => $user_id,
            'created_at'        => time(),
            'modified_at'       => time()
        ];

       $query = $this->db->insert('bank', $data);

        if($query)
        {
            create_activity('Added '.$data['first_name'].' '. $data['last_name'].' as agent'); //create an activity

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
            $this->email->from($adminEmail,  get_option('company_name'));
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
	
	 
}