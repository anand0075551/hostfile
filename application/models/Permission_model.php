<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_model extends CI_Model {

	
	
	  
	    public function edit_bg($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './assets/theme/img/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types']   = 'gif|jpg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
			//set all data for inserting into database
			$data = [
				'business_name'     => $this->input->post('business_name'),
				'pay_type'          => $this->input->post('sub_acct_id'),
				'payment_reciever'	=> $this->input->post('recv_user'),
				'points_mode'       => $this->input->post('points_mode'),
				'voc_permission'    => $this->input->post('voc_permission'),
				'voc_type'       	=> $this->input->post('voc_type'),
				'voc_limit'       	=> $this->input->post('voc_limit'),
				'vendor_role'       => $this->input->post('vendor_role'),
				'search_type'       => $this->input->post('search_type'),
				'bg_color'       	=> $this->input->post('bg_color'),
				'search_box_color'  => $this->input->post('search_box_color'),
				'image'       		=> $photoName,
				'created_by'        => $user_id,
				'created_at'        => time()
			];
        }
		else{
			$data = [
				'business_name'     => $this->input->post('business_name'),
				'pay_type'          => $this->input->post('sub_acct_id'),
				'payment_reciever'	=> $this->input->post('recv_user'),
				'points_mode'       => $this->input->post('points_mode'),
				'voc_permission'    => $this->input->post('voc_permission'),
				'voc_type'       	=> $this->input->post('voc_type'),
				'voc_limit'       	=> $this->input->post('voc_limit'),
				'vendor_role'       => $this->input->post('vendor_role'),
				'search_type'       => $this->input->post('search_type'),
				'bg_color'       	=> $this->input->post('bg_color'),
				'search_box_color'  => $this->input->post('search_box_color'),
				'created_by'        => $user_id,
				'created_at'        => time()
			];
		}

        $query = $this->db->where('id', $id)->update('business_groups', $data);

        if($query)
        {
            create_activity('Updated '.$data['business_name'].'In Business Groups'); //create an activity
            return true;
        }
        return false;

    }
	
	

	
	
	
	    public function create_groups(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

		if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './assets/theme/img/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types']   = 'gif|jpg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
			//set all data for inserting into database
			$data = [
				'business_name'     => $this->input->post('business_name'),
				'pay_type'          => $this->input->post('sub_acct_id'),
				'payment_reciever'	=> $this->input->post('recv_user'),
				'points_mode'       => $this->input->post('points_mode'),
				'voc_permission'    => $this->input->post('voc_permission'),
				'voc_type'       	=> $this->input->post('voc_type'),
				'voc_limit'       	=> $this->input->post('voc_limit'),
				'vendor_role'       => $this->input->post('vendor_role'),
				'search_type'       => $this->input->post('search_type'),
				'bg_color'       	=> $this->input->post('bg_color'),
				'search_box_color'  => $this->input->post('search_box_color'),
				'image'       		=> $photoName,
				'created_by'        => $user_id,
				'created_at'        => time()
			];
        }
		else{
			$data = [
				'business_name'     => $this->input->post('business_name'),
				'pay_type'          => $this->input->post('sub_acct_id'),
				'payment_reciever'	=> $this->input->post('recv_user'),
				'points_mode'       => $this->input->post('points_mode'),
				'voc_permission'    => $this->input->post('voc_permission'),
				'voc_type'       	=> $this->input->post('voc_type'),
				'voc_limit'       	=> $this->input->post('voc_limit'),
				'vendor_role'       => $this->input->post('vendor_role'),
				'search_type'       => $this->input->post('search_type'),
				'bg_color'       	=> $this->input->post('bg_color'),
				'search_box_color'  => $this->input->post('search_box_color'),
				'image'       		=> 'no_image.jpg',
				'created_by'        => $user_id,
				'created_at'        => time()
			];
		}
		
		
		
		
		
		
		
		
		
		
		
		
        //set all data for inserting into database
        

       $query = $this->db->insert('business_groups', $data);

        if($query)
        {
            create_activity('Added '.$data['business_name'].'To Business Groups'); //create an activity
            return true;
        }
        return false;

    }
	   
	public function copy_bg(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        if ($_FILES['userfile']['name'] != '') {
            $upload_dir = './assets/theme/img/'; //Upload directory
            if (!file_exists($upload_dir))
                mkdir($upload_dir); //create directory if not found.
            $config['upload_path'] = $upload_dir;
            $config['allowed_types']   = 'gif|jpg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $errorData = implode('<br />', $error);
                $this->session->set_flashdata('errorMsg', $errorData); //set uploading error into flash
                redirect($_SERVER['HTTP_REFERER']); // redirect with error
            } else {
                $upload_data = $this->upload->data(); //all uploaded data store in variable
                $photoName = $upload_data['raw_name'] . $upload_data['file_ext'];
                $fullPhoto = $upload_dir . $upload_data['file_name'];
                // $this->photoResize($fullPhoto); // resize now
            }
			//set all data for inserting into database
			$data = [
				'business_name'     => $this->input->post('business_name'),
				'pay_type'          => $this->input->post('sub_acct_id'),
				'payment_reciever'	=> $this->input->post('recv_user'),
				'points_mode'       => $this->input->post('points_mode'),
				'voc_permission'    => $this->input->post('voc_permission'),
				'voc_type'       	=> $this->input->post('voc_type'),
				'voc_limit'       	=> $this->input->post('voc_limit'),
				'vendor_role'       => $this->input->post('vendor_role'),
				'search_type'       => $this->input->post('search_type'),
				'bg_color'       	=> $this->input->post('bg_color'),
				'search_box_color'  => $this->input->post('search_box_color'),
				'image'       		=> $photoName,
				'created_by'        => $user_id,
				'created_at'        => time()
			];
        }
		else{
			$data = [
				'business_name'     => $this->input->post('business_name'),
				'pay_type'          => $this->input->post('sub_acct_id'),
				'payment_reciever'	=> $this->input->post('recv_user'),
				'points_mode'       => $this->input->post('points_mode'),
				'voc_permission'    => $this->input->post('voc_permission'),
				'voc_type'       	=> $this->input->post('voc_type'),
				'voc_limit'       	=> $this->input->post('voc_limit'),
				'vendor_role'       => $this->input->post('vendor_role'),
				'search_type'       => $this->input->post('search_type'),
				'bg_color'       	=> $this->input->post('bg_color'),
				'search_box_color'  => $this->input->post('search_box_color'),
				'image'       		=> 'no_image.jpg',
				'created_by'        => $user_id,
				'created_at'        => time()
			];
		}

       $query = $this->db->insert('business_groups', $data);

        if($query)
        {
            create_activity('Added '.$data['business_name'].'To Business Groups'); //create an activity
            return true;
        }
        return false;

    }   
	   
	   

	       public function add_menu_label(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'bussiness_name'            => $this->input->post('bussiness_name'),
			'comments'            => $this->input->post('comments')

        ];

       $query = $this->db->insert('business_label', $data);

        if($query)
        {
            create_activity('Added '.$data['name'].' Groups'); //create an activity
            return true;
        }
        return false;

    }
	
   public function add_menu_permission(){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'roleid'                         => $this->input->post('userrole'),
            'business_name'                  => $this->input->post('business_name'),
            'status'        				 => $this->input->post('status')	
     //       'created_at'       		     => time(),
      //      'modified_at'         	     => time()
        ];

       $query = $this->db->insert('menu_permission', $data);

        if($query)
        {
            create_activity('Added '.$data['name'].' Role'); //create an activity
            return true;
        }
        return false;

    }
   

   	 public function edit_permission($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];


        //set all data for inserting into database
        $data = [
            'roleid'                         => $this->input->post('userrole'),
            'business_name'                => $this->input->post('business_name'),
            'status'        				 => $this->input->post('status')	
     //       'created_at'       		     => time(),
      //      'modified_at'         	     => time()
        ];

        $query = $this->db->where('id', $id)->update('menu_permission', $data);

        if ($query) {
            create_activity('Updated ' . $data['name'] . 'points_mode'); //create an activity
            return true;
        }
        return false;
    }
	
   public function edit_label($id) {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];


        //set all data for inserting into database
        $data = [
            'bussiness_name'            => $this->input->post('bussiness_name'),
			'comments'            => $this->input->post('comments')
        ];

        $query = $this->db->where('id', $id)->update('business_label', $data);

        if ($query) {
            create_activity('Updated ' . $data['name'] . 'points_mode'); //create an activity
            return true;
        }
        return false;
    }  
    
 
  
  
       public function labelListCount(){
        $query = $this->db->count_all_results('business_label');
        return $query;
    }

    public function labelList($limit = 0, $start = 0){
        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('business_label');
        return $query;
    }
    
    
    

       public function bgListCount(){
        $query = $this->db->count_all_results('business_groups');
        return $query;
    }

    public function bgList($limit = 0, $start = 0){
        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('business_groups');
        return $query;
    }
	
	
       public function menuListCount(){
        $query = $this->db->count_all_results('menu_permission');
        return $query;
    }


    public function menuList($limit = 0, $start = 0){
		
        
		$search = $this->input->get('search');
		$searchValue = $search['value'];

		$searchByID = '';
		//Get Decision who in online?
		
			if($searchValue != '')
			{
				//$searchByID = " WHERE invoice.id = '{$searchValue}'";
				$where_array = array('roleid'=> $searchValue);
				$table = "menu_permission";
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('menu_permission');
			}
			else{
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('menu_permission');
			}
        return $query;
    }	
	
	public function block_sale($id){
		$query = $this->db->where('id', $id)->update('business_groups', ['sale_status'=>0]);

        if ($query) {
            return true;
        }
        return false;
	}
	
	public function active_sale($id){
		$query = $this->db->where('id', $id)->update('business_groups', ['sale_status'=>1]);

        if ($query) {
            return true;
        }
        return false;
	}
	
}