<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor_commission extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Distributor_commission_model');
		$this->load->model('payment_model');
		$this->load->model('notification_model');
		check_auth(); //check is logged in.
	}

	public function commission_index()
	{
		theme('distributor_commission_index');
	}
	// *** Adding Distributer Commission *** //
	
	public function add_distributor_commission(){
		
		//restricted this area, only for admin
		permittedArea();
    	//$data['role']            =        $this->db->get('role');
		
		$data['business_groups'] = $this->db->get('business_groups');
		$type='main';
		$data['acct_categories'] = $this->db->get_where('acct_categories', ['category_type'=>$type]);
		$data['rolename'] = $this->db->get('role');
		$data['first_name'] = $this->db->get('users');
	   
		if($this->input->post())
		{
			if($this->input->post('submit') != 'commission') die('Error! sorry');
			$this->form_validation->set_rules('business_group','business_group','required');
			$this->form_validation->set_rules('acc_cat','acc_cat','required');
			$this->form_validation->set_rules('pay_type','pay_type','required');
			$this->form_validation->set_rules('from_role','from_role','required');
			$this->form_validation->set_rules('to_role', 'to_role','required');
			$this->form_validation->set_rules('to_user', 'to_user');
			$this->form_validation->set_rules('area', 'area','required');
			$this->form_validation->set_rules('percentage', 'percentage', 'required');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Distributor_commission_model->add_distributor_commission();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'New Distributor_commission Added Successfully!');
					redirect(base_url('Distributor_commission/commission_index'));
				}

			}
		}
		
		theme('add_distributor_commission',$data);
	}
	public function get_pay_type()
     {
         $acc_cat=$_POST['acc_cat'];
         $query = $this->Distributor_commission_model->get_pay_type($acc_cat);
         $user = "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             $user .= "<option value='".$r->id."'>".$r->id."-".$r->name."</option>";
         } 
		echo $user;
     }
	
	public function get_user()
     {
         $to_role=$_POST['to_role'];
         echo $to_role;
         $query = $this->Distributor_commission_model->get_user($to_role);
         $user = "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             $user .= "<option value='".$r->id."'>".$r->contactno."-".$r->first_name." ".$r->last_name."</option>";
         } 
		echo $user;
     }
	public function get_area()
     {
         $bg_id=$_POST['bg_id'];
         
         $query = $this->Distributor_commission_model->get_area($bg_id);
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

	 public function check_exist()
     {
         $area=$_POST['area'];
		 $from_role=$_POST['from_role'];
		 $business_group=$_POST['business_group'];
		 $to_user=$_POST['to_user'];
         $query = $this->db->get_where('distributor_commission', ['area'=>$area,'business_group'=>$business_group,'from_role'=>$from_role,'to_user'=>$to_user]);
         if($query->num_rows() > 0)
		 {
			 echo  1;
		 }
		 else
		 {
			 echo  0;
		 }
     }
	 
	public function commissionListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $currentUser = singleDbTableRow($user_id)->role;
        //$rolename = singleDbTableRow($user_id)->rolename;
		
        $queryCount = $this->Distributor_commission_model->commissionListCount();


        $query = $this->Distributor_commission_model->commissionList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
               	 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Distributor_commission/view_distributor_commission/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				
				if ($currentUser == 'admin')
				{
                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				}		
					 $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Distributor_commission/copy_distributor_commission/' . $r->id) . '" data-toggle="tooltip" title="Copy">
						<i class="fa fa-list"></i> </a>';	
				$get_pay_type = $this->db->get_where('role', ['id'=>$r->from_role]);
					foreach($get_pay_type->result() as $p);
				$from_role = $p->rolename;
				
				$get_pay_type = $this->db->get_where('role', ['id'=>$r->to_role]);
					foreach($get_pay_type->result() as $p);
				$to_role = $p->rolename;
				/* area */
				$get_location = $this->db->get_where('area', ['id'=>$r->area]);
				foreach($get_location->result() as $l);
				$location=$l->location;
				$get_location_name = $this->db->get_where('location_id', ['id'=>$location]);
				foreach($get_location_name->result() as $ln);
				/* /area */
				/* BG */
				$get_bg_name = $this->db->get_where('business_groups', ['id'=>$r->business_group]);
				foreach($get_bg_name->result() as $bg)
				/* /BG */
				$to_user = $r->to_user;
				
				if($to_user != "")
				{
					$get_pay_type = $this->db->get_where('users', ['id'=>$r->to_user]);
					foreach($get_pay_type->result() as $p);
					 $user = $p->first_name;
				}
				else{
					$user = "";
				}
				
				
                $data['data'][] = array(
                    $button,
					
                   	$bg->business_name,
					$ln->location,
					$from_role,
                    $to_role,
                    $user,
                    $r->percentage
                    
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Commission list', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
	 public function view_distributor_commission($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['distributor_commission'] = $this->db->get_where('distributor_commission', ['id' => $id]);
        theme('view_distributor_commission', $data);
    }
	
	
	public function deleteAjax() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'distributor_commission');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} distributor_commission");
        //Now delete permanently
        $this->db->where('id', $id)->delete('distributor_commission');
        return true;
    }
	
	 public function edit_distributor_commission($id) {
		 
		
      // permittedArea();
		$data['business_groups'] = $this->db->get('business_groups');
		$data['rolename'] = $this->db->get('role');
		$data['first_name'] = $this->db->get('users');
        $data['role'] = singleDbTableRow($id, 'role');
		$data['distributor_commission'] = singleDbTableRow($id, 'distributor_commission');
		

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_commission')
                die('Error! sorry');
			$this->form_validation->set_rules('business_group', 'business_group role', 'required|trim');
			$this->form_validation->set_rules('from_role', 'from role', 'required|trim');
			$this->form_validation->set_rules('to_role', 'to role', 'required|trim');
			$this->form_validation->set_rules('to_user', 'to user');
			$this->form_validation->set_rules('area', 'area', 'required|trim');
			$this->form_validation->set_rules('percentage', 'percentage', 'required|trim');

            if ($this->form_validation->run() == true) {
                $insert = $this->Distributor_commission_model->edit_distributor_commission($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Vehical Type  Updated Successfully...!!!');
                    redirect(base_url('Distributor_commission/commission_index'));
                }
            }
        }

        theme('edit_distributor_commission', $data);
    }
	public function copy_distributor_commission($id) {
		 
		
      // permittedArea();
		$data['business_groups'] = $this->db->get('business_groups');
		$data['rolename'] = $this->db->get('role');
		$data['first_name'] = $this->db->get('users');
        $data['role'] = singleDbTableRow($id, 'role');
		$data['distributor_commission'] = singleDbTableRow($id, 'distributor_commission');
		$type='main';
		$data['acct_categories'] = $this->db->get_where('acct_categories', ['category_type'=>$type]);

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_commission')
                die('Error! sorry');
			$this->form_validation->set_rules('business_group', 'business_group role', 'required|trim');
			$this->form_validation->set_rules('from_role', 'from role', 'required|trim');
			$this->form_validation->set_rules('to_role', 'to role', 'required|trim');
			$this->form_validation->set_rules('to_user', 'to user', 'required|trim');
			$this->form_validation->set_rules('area', 'area', 'required|trim');
			$this->form_validation->set_rules('percentage', 'percentage', 'required|trim');

            if ($this->form_validation->run() == true) {
                $insert = $this->Distributor_commission_model->copy_distributor_commission();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Added Successfully...!!!');
                    redirect(base_url('Distributor_commission/commission_index'));
                }
            }
        }

        theme('copy_distributor_commission', $data);
    }
	/*--------------------Get Commission --------------------- */
	public function distributor_get_commission()
	{
		theme('distributor_get_commission');
	}
	public function my_commission()
	{
		$limit = $this->input->get('length');
        $start = $this->input->get('start');
		
		$queryCount = $this->Distributor_commission_model->mycommissionListCount();
		$commission = $this->Distributor_commission_model->check_commission($limit, $start);
		
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($commission -> num_rows() > 0) 
		{
			/* commission info*/
			foreach ($commission->result() as $commissions) 
			{
				$percentage=$commissions->percentage;
				$from_role=$commissions->from_role;
				$to_role=$commissions->to_role;
				$area=$commissions->area;
				$pay_type=$commissions->pay_type;
				$business_group = $commissions->business_group;
			}
			/* distributor details*/
			$user_info = $this->session->userdata('logged_user');
			$user_id = $user_info['user_id'];
			$user_pincode = singleDbTableRow($user_id)->postal_code;
			$user_created_at = singleDbTableRow($user_id)->created_at;
			$user_created_date = date('Y-m-d',$user_created_at);
			$month3 = date_parse_from_format("Y-m-d", $user_created_date);
			$user_created_month = $month3["month"];
			
			/* months*/
			$today=date('Y-m-d');
			$year = date('Y');
			$year_start = "{$year}-01-01";
			$start    = (new DateTime($year_start))->modify('first day of this month');
			$end      = (new DateTime($today))->modify('first day of next month');
			$interval = DateInterval::createFromDateString('1 month');
			$period   = new DatePeriod($start, $interval, $end);
			$cnt=1;
			foreach ($period as $dt) {
				$month1 = date_parse_from_format("Y-m-d", $dt->format("Y-m-d"));
				$month = $month1["month"];
				$month2 = date_parse_from_format("Y-m-d", $today);
				$current_month = $month2["month"];
				/*check first day*/
				if($month == $user_created_month)
				{
					$first_day = $user_created_date;
					
				}
				else
				{
					$first_day = $dt->format("Y-m-d");
				}
				/*check last day*/
				if($month == $current_month)
				{
					$last_day =$today;
				}
				else
				{
					$last_day = date('Y-m-t', strtotime($dt->format("Y-m-d")));
				}
				//
				if($month < $user_created_month)
				{
					/*check paid */
					$check_paid = '';
					/*Total Sale */
					$total_sales = 0;
					/*Total Sale */
					$total_commission = 0;
					
					$total_users =0;
				}
				else if($month == $current_month)
				{
					/*check paid */
					$check_paid = $this->Distributor_commission_model->Check_paid($from_role,$first_day,$last_day);
					/*Total Sale */
					$total = $this->Distributor_commission_model->Total_sales($area, $from_role,$first_day,$last_day,$pay_type);
					$total_sales =$total[0];
					$total_users =$total[1];
					/*Total Sale */
					$total_commission = ($percentage/100) * $total_sales;
				}
				else
				{
					/* check upper commission table*/
					$check = $this->Distributor_commission_model->Check_upper_commission($from_role,$first_day,$last_day);
					if($check -> num_rows() > 0) 
					{
						foreach($check->result() as $details);
						$total_sales = $details->total_sales;
						$total_users = $details->no_of_users;
						$total_commission = $details->total_commission;
						$status = $details->status;
						if($status == 1)
						{
							$check_paid =1;
						}
						else
						{
							$check_paid =0;
						}
					}
					else
					{
						/*check paid */
						$check_paid = $this->Distributor_commission_model->Check_paid($from_role,$first_day,$last_day);
						/*Total Sale */
						$total = $this->Distributor_commission_model->Total_sales($area, $from_role,$first_day,$last_day,$pay_type);
						$total_sales =$total[0];
						$total_users =$total[1];
						/*Total Sale */
						$total_commission = ($percentage/100) * $total_sales;
				$insert = $this->Distributor_commission_model->Insert_upper_commission($business_group,$total_users,$total_sales,$total_commission,$from_role,$to_role,$first_day,$last_day);
					}
				}
				
				/* button*/
				if($month < $user_created_month)
				{
					$button = '<a class="btn btn-primary editBtn"  title="Get it" disabled>
						<i class="fa fa-money"> Get it</i> </a>';
				}
				else if($month == $current_month)
				{
					$button ="Please wait for the  month end";
				}
				else if($total_commission <=0)
				{
					$button = '<a class="btn btn-secondry editBtn" href="" title="Got it" disabled>
						<i class="fa fa-thumbs-down"> No sales</i> </a>';
				}
				else if($check_paid==1)
				{
					$button = '<a class="btn btn-warning editBtn" href="" title="Got it" disabled>
						<i class="fa fa-thumbs-up"> Got it</i> </a>';
				}
				else
				{
					$button = '<a class="btn btn-primary editBtn" onClick="get_commission('.$total_commission.','.$cnt.')" title="Get it" >
						<i class="fa fa-money"> Get it</i> </a>';
				}
				
				$data['data'][] = array(
						singleDbTableRow($business_group, 'business_groups')->business_name,
						$total_users,
						$first_day.'<input type="hidden" id="'.$cnt.'from_date" value="'.$first_day.'">',
						$last_day.'<input type="hidden" id="'.$cnt.'end_date" value="'.$last_day.'">',
						$total_sales.'<input type="hidden" id="from_role" value="'.$from_role.'">',						
						//$percentage,
						$total_commission,				
						$button				
					);
				$cnt++;
			}
			
		}
		else
		{
			   $data['data'][]=array(
				 'You have no Data' ,'','','','',''
			);
		}
		echo json_encode($data);
		
	}
	public function Get_commission()
    {
		 $amount=$_POST['total_commission'];
		 $from_date=$_POST['from_date'];
		 $end_date=$_POST['end_date'];
		 $from_role=$_POST['from_role'];
		 
		$get=$this->Distributor_commission_model->Get_commission($amount,$from_date,$end_date,$from_role);
		if($get)
		{
			$this->session->set_flashdata('successMsg', 'commission transfered to your account');
			redirect(base_url('Distributor_commission/distributor_get_commission'));
		}
		else
		{
			$this->session->set_flashdata('errorMsg', 'sorry');
			redirect(base_url('Distributor_commission/distributor_get_commission'));
		}
	}
	/*--------------------/Get Commission --------------------- */
	
	
}