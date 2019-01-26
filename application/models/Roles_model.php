<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {

    /**
     * @return bool
     */

 	/* Add New User Roles to the system */
  public function add_roles(){
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$active = $this->input->post('active');
		if ($active != '1')
		{
			$active = '0';
		}
       
	   $permission_id = $this->input->post('permission_id');
		if ($permission_id != '1')
		{
			$permission_id = '0';
		}
		
		
		$type= $this->input->post('type');
		
		$edit = $this->input->post('edit');
		if ($edit != '1')
		{
			$edit = '0';
		}
       
        $rolename = $this->input->post('rolename');
   
        //set all data for inserting into database
        $data = [
            'rolename'          => $rolename,
			'fees'				=> $this->input->post('fees'),
			'dedfees_payspec'	=> $this->input->post('dedfees_payspec'),
			'comfees_payspec'	=> $this->input->post('comfees_payspec'),
			'com_per'			=> $this->input->post('com_per'),			
            'active'            => $active,
			'permission_id'		=> $permission_id,
			'type'				=> $type,
			'edit'				=> $edit,
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
/**
     * @return Agent List
     * Private Voucher List Query
     */

    public function authorizationsListCount(){
      	$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];	
            $queryCount = $this->db->count_all_results('authorizations');
			return $queryCount;		
        
    }     
           
	   public function authorizationsList($limit = 0, $start = 0){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];		
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('authorizations', ['created_by' =>$user_id]); 						
			 return $query;
	
   }
   /**  Create Authorizations  */
 
  public function create_authorizations(){
  
    $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		$identity_id = $this->input->post('identity_id');
		

        //set all data for inserting into database
        $data = [
            'identity_id'       => $this->input->post('identity_id'),
			'rolename'         	=> $this->input->post('rolename'),			
            'usertype'         	=> $this->input->post('usertype'),	
			'view'         		=> $this->input->post('ledg_01'),
            'edit'   			=> $this->input->post('ledg_02'), 
			'no_access'   		=> $this->input->post('ledg_03'), 	
			'created_by'	    => $user_id,			
            'modified_by'	    => $user_id,
            'modified_at'       => time()
        ];

         $query = $this->db->insert('authorizations', $data);

        if($query)
        {
            create_activity('Updated '.$data['id'].' authorizations'); //create an activity
            return true;
        }
        return false; 
   
   
  }
  
 /**  edit_authorizations  */
 
  public function edit_authorizations($id){
  
    $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'identity_id'       => $this->input->post('identity_id'),
			//'user'         		=> $this->input->post('user'),			
            'usertype'         	=> $this->input->post('usertype'),	
		//	'yes'         		=> $this->input->post('yes'),
         //   'no'   				=> $this->input->post('no'),           
            'modified_by'	    => $user_id,
            'modified_at'       => time()
        ];

        $query = $this->db->where('id', $id)->update('authorizations', $data);

        if($query)
        {
            create_activity('Updated '.$data['id'].' authorizations'); //create an activity
            return true;
        }
        return false; 
   
   
  }

     
 	/* Update User Roles and Authorizations in the system */
  public function update_authorizations(){
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$active = $this->input->post('active');
		
       
		$ledg_01 = $this->input->post('ledg_01');       
        $ledg_01 = $this->input->post('ledg_01');
   
        //set all data for inserting into database
        $data = [
            'identity_id'       => $rolename,
            'user'            	=> $active,
			'usertype'			=> $type,
			'yes'				=> $edit,
			'no'				=> $edit,
            'created_by'        => $user_id,
            'created_at'        => time(),
            'modified_at'       => time(),
			'modified_by'       => time()
        ];

        $query = $this->db->insert('authorizations', $data);
		
		if($query)
        {
            create_activity('Updated '.$data['name'].'authorizations'); //create an activity
            return true;
        }
        return false;
    }
   /**
     * @param $id
     * @return bool
     * Update Category
     */


    public function edit_roles($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'name'        			=> $this->input->post('vouchers_name'),
			'amount'         		=> $this->input->post('amount'),			
            'start_date'         	=> $this->input->post('start_date'),	
			'end_date'         		=> $this->input->post('end_date'),
        //    'commission_percent'    => $this->input->post('commission_percent'),
            'added_by'              => $user_id,
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $query = $this->db->where('id', $id)->update('vouchers', $data);

        if($query)
        {
            create_activity('Updated '.$data['name'].' Vouchers'); //create an activity
            return true;
        }
        return false;

    }
/**
	 * @all_Roles List
	 */

	public function all_roles(){
		//restricted this area, only for admin
		permittedArea();

		//$data['adminList'] = $this->db->order_by('id', 'DESC')->get_where('users', ['role' => 'admin']);
		$data['role_List'] = $this->db->order_by('id', 'DESC')->get_where('role', ['parent' => '0']);
		theme('all_roles', $data);
	}
	




  /**
     * @return Agent List
     * Agent List Query
     */

    public function rolesListCount(){
        $query = $this->db->count_all_results('role');
        return $query;
    }

    //public function rolesList($limit = 0, $start = 0){
		 public function rolesList(){
        //$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->join('users', 'users.id = role.added_by')->get('role');
	//	 $query = $this->db->order_by('id', 'desc')->get('role');
	   $query = $this->db->get_where('role', ['parent'=> '0']);
        return $query;
    }
  /**
     * Ledger Account Details
     * 
     */
    public function add_ledger(){
 $this->load->helper('string'); //load string helper
 
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
	
		
        //set all data for inserting into database
        $data = [
            'user_id'         		=> $user_id, // $this->input->post('vouchers_name'),
            'invoice_id '  			=> 'test123',
            'amount'         		=> $this->input->post('capital'),
            'capital'         		=> $this->input->post('capital'),
			'liabilities'         	=> $this->input->post('liabilities'),
            'cash'         			=> $this->input->post('cash'),						
            'start_date'         	=> '2010-01-01',					
			'pay_type'				=> 'transfer',
			'remarks'         		=> $this->input->post('remarks'),	
            'created_at'            => time(),
            'modified_at'           => time()
        ];

       $query = $this->db->insert('ledger', $data);

        if($query)
        {
            create_activity('Added '.$data['remarks'].' ledger'); //create an activity
            return true;
        }
        return false;

    }


   /**
     * @param $id
     * @return bool
     * Update Category
     */


    public function edit_ledger($id){

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];

        //set all data for inserting into database
        $data = [
            'capital'        			=> $this->input->post('capital'),
			'amount'         		=> $this->input->post('amount'),			
            'start_date'         	=> $this->input->post('start_date'),	
			'end_date'         		=> $this->input->post('end_date'),
        //    'commission_percent'    => $this->input->post('commission_percent'),
            'added_by'              => $user_id,
            'created_at'            => time(),
            'modified_at'           => time()
        ];

        $query = $this->db->where('id', $id)->update('ledger', $data);

        if($query)
        {
            create_activity('Updated '.$data['name'].' ledger'); //create an activity
            return true;
        }
        return false;

    }





  /**
     * @return Agent List
     * Agent List Query
     */

    public function ledgerListCount(){
        $query = $this->db->count_all_results('ledger');
        return $query;
    }

    public function ledgerList($limit = 0, $start = 0){
        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->join('users', 'users.id = ledger.added_by')->get('ledger');
        return $query;
    }


}