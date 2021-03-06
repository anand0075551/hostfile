<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


    /**
     *  Authonication check here
     * @return bool
     */


	 /**
     *  Bank Account Update
     * @return bool
     */
/*
public function bank_update($profile_id = 0){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //re-assign if pass a $profile_id
        if($profile_id != 0){
            $user_id = $profile_id;
        }

        $user_info = $this->db->get_where('bank', ['id' => $user_id]);
        foreach($user_info->result() as $user_r);


      //  $photoName = $user_r->photo;

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


        $data = [
            'first_name'  	 	=> $this->input->post('first_name'),
            'last_name'   		=> $this->input->post('last_name'),
            'profession'   	 	=> $this->input->post('profession'), //Name of Bank	
			'area_name'    		=> $this->input->post('area_name'),	 //IFSC Code
            'contactno'   		=> $this->input->post('contactno'),
			'account_no'   		=> $this->input->post('account_no'), //Account Number			
            'gender'    		=> $this->input->post('gender'),	 //Account Type
            'date_of_birth'     => $this->input->post('date_of_birth'), //Account Opened Date
            'street_address'    => $this->input->post('street_address'),
            'postal_code'    	=> $this->input->post('postal_code'),				
            'city'    			=> $this->input->post('city'),			
            'photo'        	 	=> $photoName,
            'modified_at'   	=> time()
        ];

        $query = $this->db->where('id', $user_id)->update('bank', $data);

        if($query) return true;
        return false;

    }
*/
//**************************Bank Acct Update End***************************


    public function changePassword(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        $oldPassword = singleDbTableRow($user_id)->password;

        if($oldPassword != sha1($this->input->post('old_password')))
        {
            $this->session->set_flashdata('errorMsg', 'Old password Incorrect');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $row_password   = $this->input->post('password');
        $password       = sha1($row_password);

        //set all data for inserting into database
        $data = [
            'password'          => $password,
            'row_pass'          => $row_password,
        ];

        $query = $this->db->where('id', $user_id)->update('users', $data);

        if($query)
        {
            return true;
        }
        return false;
    }



    /**
     * @param int $user_id
     * @return mixed
     * return last 20 Login log
     */

    public function get_log($user_id = 0){
        $user_info = $this->session->userdata('logged_user');

        if($user_id != 0)
        {
            $user_id = $user_id;
        }else{
            $user_id = $user_info['user_id'];
        }

        $query = $this->db->order_by('id', 'desc')->get_where('log', ['user_id' => $user_id], 20);
        return $query;
    }




    /***************************************************************************************************************************
     * @return Bank List
     * Bank List Query
     */

    public function bankListCount(){
        $query = $this->db->where( 'role' , 'user')->count_all_results('bank');
//       $query = $this->db->where( 'created_by' , '0')->count_all_results('users');
        return $query;
    }

    public function bankList($limit = 0, $start = 0){
//        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('users', ['role' => 'user']);
//<!--  Below line is customized to see all type of users for Approver in Cutomer list section(All users) Tab -->
                $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('bank', ['created_by' != '0']);
		return $query;
    }
	/***************************************************************************************************************************/
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




}