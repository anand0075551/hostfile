<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher_permission extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Voucher_permission_model');

        check_auth(); //check is logged in.
    }

    /**
     * Listing all transaction 
     */
    public function index() {

        theme('all_voucher_permission');
    }
    public function all_voucher_permission() {

        theme('all_voucher_permission');
    }

    public function add_voucher_permission() {
        //restricted this area, only for admin
        permittedArea();
        //$data['pay_type'] = $this->db->get('accounts');
	//$data['name'] = $this->db->get_where('acct_categories',['category_type'=>'sub']);
	$data['name'] = $this->db->get_where('acct_categories', ['parentid'=>'0']);
	$data['rolename'] = $this->db->get('role');
	$data['first_name'] = $this->db->get('users');
	$data['business_name'] = $this->db->get('business_groups');
	
        $where_array1 = array('parentid' => '');
        $data['main_category'] = $this->db->where($where_array1)->get('acct_categories');

        //$where_array2 = array('parentid' =>'7');
        //$data['business_name'] = $this->db->where($where_array2)->get('acct_categories');
        $data['rolename'] = $this->db->get('role');


        if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_voucher_permission')
                die('Error! sorry');

            //$this->form_validation->set_rules('business_name', 'business Name ', 'required|trim');
            $this->form_validation->set_rules('voc_name', 'Voucher Name', 'trim|required');
            $this->form_validation->set_rules('business_name', 'Business Name', 'trim|required');
			$this->form_validation->set_rules('pay_type', 'Pay Type', 'trim|required');		
            $this->form_validation->set_rules('paytype_to', 'Pay Type To', 'trim|required');		
            $this->form_validation->set_rules('to_role', 'To Role', 'trim|required');
        //    $this->form_validation->set_rules('to_user', 'To User', 'trim|required');
            $this->form_validation->set_rules('percentage', 'Percentage', 'trim|required');  
            $this->form_validation->set_rules('no_of_split', 'Number Split', 'trim|required');


            if ($this->form_validation->run() == true) {
                $insert = $this->Voucher_permission_model->add_voucher_permission();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Voucher Added Successfully');
                    redirect(base_url('Voucher_permission/all_voucher_permission'));
                }
            }
        }

        theme('add_voucher_permission', $data);
    }

        public function get_user()
     {
         $to_role=$_POST['to_role'];
         //echo $to_role;
         $query = $this->Voucher_permission_model->get_user($to_role);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->id."'>".$r->first_name."</option>";
         } 

     }

 public function get_sub_account()
	{
		$id = $_POST['parent_id'];
		$query = $this->db->get_where('acct_categories', ['parentid' => $id]);
		$data = '<option value="">Deposit Sub-Accounts Type </option>';
		foreach($query->result() as $sub_account){
			$data.= '<option value="'.$sub_account->id.'">'.$sub_account->id.'-'.$sub_account->name.'</option>';
		}
		echo $data;
	}

    //add transaction
    public function VoucherListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Voucher_permission_model->VoucherListCount();


        $query = $this->Voucher_permission_model->VoucherList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary btn-sm editBtn" href="' . base_url('Voucher_permission/view_voucher/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

                $button .= '<a class="btn btn-danger btn-sm deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

				
			
			$get_business_name = $this->db->get_where('business_groups', ['id'=>$r->business_name]);
			foreach($get_business_name->result() as $p);
			$business_name = $p->business_name;
			
			
			$get_pay_type = $this->db->get_where('acct_categories', ['id'=>$r->pay_type]);
			foreach($get_pay_type->result() as $p);
			$pay_type = $p->name;
			
			$get_paytype_to = $this->db->get_where('acct_categories', ['id'=>$r->paytype_to]);
			foreach($get_paytype_to->result() as $p);
			$paytype_to = $p->name;
			
		   $get_to_role = $this->db->get_where('role', ['id'=>$r->to_role]);
			foreach($get_to_role->result() as $ro);
			$to_role = $ro->rolename;
			
			if($r->to_user != 0){
				$get_to_user = $this->db->get_where('users', ['id'=>$r->to_user]);
				foreach($get_to_user->result() as $t);
				$to_user = $t->first_name." ".$t->last_name;
			}
			else{
				$to_user = "Not Applicable";
			}
			
			if($r->voc_type != ""){
				$voc_type = $r->voc_type."ly";
			}
			else{
				$voc_type = "Not Mentioned.";
			}
			
			if($r->start_date != "0000-00-00"){
				$start_date = $r->start_date;
			}
			else{
				$start_date = "Not Mentioned.";
			}
			
			if($r->end_date != "0000-00-00"){
				$end_date = $r->end_date;
			}
			else{
				$end_date = "Not Mentioned.";
			}
			
				$data['data'][] = array(
                    $button,
                    $r->voc_name,
					$business_name,
					$pay_type,
                    $paytype_to,
                    $to_role,
					$to_user,
                    $r->percentage,
                    $r->no_of_split,
                    $voc_type,
                    $start_date,
                    $end_date
                );
            }
        } else {
            $data['data'][] = array(
                'No Records Found', '', '', '', '', '', '', '', '','', '', ''
            );
        }
        echo json_encode($data);
    }

    //view transaction

    public function view_voucher($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['transaction_Details'] = $this->db->get_where('voc_generate', ['id' => $id]);
        theme('view_voucher_permission', $data);
    }
	
	//edit voucher
		public function edit_voucher($id){
		//restricted this area, only for admin
		permittedArea();
$data['name'] = $this->db->get_where('acct_categories',['category_type'=>'sub']);
$data['rolename'] = $this->db->get('role');
	$data['first_name'] = $this->db->get('users');
	$data['business_name'] = $this->db->get('business_groups');
	
		$data['voc_generate'] = singleDbTableRow($id,'voc_generate');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_voucher') die('Error! sorry');

		  $this->form_validation->set_rules('voc_name', 'Voucher Name', 'trim|required');
			$this->form_validation->set_rules('pay_type', 'Pay Type', 'trim|required');		
            $this->form_validation->set_rules('paytype_to', 'Pay Type To', 'trim|required');		
            $this->form_validation->set_rules('to_role', 'To Role', 'trim|required');
        //    $this->form_validation->set_rules('to_user', 'To User', 'trim|required');
            $this->form_validation->set_rules('percentage', 'Percentage', 'trim|required');  
            $this->form_validation->set_rules('no_of_split', 'Number Split', 'trim|required');	

			if($this->form_validation->run() == true)
			{
				$insert = $this->Voucher_permission_model->edit_voucher($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Vouchers Updated Successfully...!!!');
					redirect(base_url('Voucher_permission/all_voucher_permission'));
				}
			}
		}

		theme('edit_voucher_permission', $data);
	}
	
	
	
	
	
	
    public function deleteAjax() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'voc_generate');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} voc_generate");
        //Now delete permanently
        $this->db->where('id', $id)->delete('voc_generate');
        return true;
    }

    //<!-----edit transaction------------->


   
}

//last 
