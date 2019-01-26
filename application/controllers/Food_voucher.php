<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Food_voucher extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Food_voucher_model');
		$this->load->model('payment_model');
		$this->load->model('notification_model');

		check_auth(); //check is logged in.
	}

	/**
	 * home page of settings
	 */
	 
	public function index()
	{
		theme('all_food_voucher');
	}
	 
	public function add_food_voucher()
	{
		//restricted this area, only for admin
		permittedArea();
		$data['acct_categories'] = $this->db->get_where('acct_categories', ['parentid'=>'0']);
		
		$data['rolename'] = $this->db->get('role');
		$data['first_name'] = $this->db->get('users');
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'foodvoucher') die('Error! sorry');

			$this->form_validation->set_rules('food_type', 'food_type','required');
			$this->form_validation->set_rules('actual_price', 'actual_price','required');
			$this->form_validation->set_rules('mainbussiness_type', 'mainbussiness_type', 'required');
			$this->form_validation->set_rules('pay_type', 'pay_type', 'required');
			$this->form_validation->set_rules('transferrable', 'transferrable', 'required');
			
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->Food_voucher_model->add_foodvoucher();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Voucher Permission Created Successfully!');
					redirect(base_url('Food_voucher/index'));
				}

			}
		}
		theme('add_food_voucher',$data);
	}

	
	
    
	public function paytype()
	{
		  $mainbussiness_type = $_POST['parentid'];
		  
      //   echo  $mainbussiness_type;
    
		$data = "<option value=''>-Select-</option>";
	$query = $this->db->get_where('acct_categories', ['parentid'=>$mainbussiness_type]);
	foreach($query->result() as $r)
         {
             $data.= "<option value='".$r->id."'>".$r->id."-".$r->name."</option>";
			 
         }
		echo $data;
	
}

	public function getuser()
	{
		$pay_to = $_POST['pay_to'];
		
	//	echo $pay_to;
		
		$query = $this->db->get_where('users', ['rolename'=>$pay_to]);
		$user = "<option value=''>Choose Option</option>";
		foreach($query->result() as $r)
		{
			$user.= "<option value='".$r->id."'>".$r->first_name." ".$r->last_name."</option>";
        
	   }
	   echo $user;
	
	}
	 
    public function foodvoucherListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Food_voucher_model->FoodvoucherListCount();


        $query = $this->Food_voucher_model->Foodvoucherlist();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Food_voucher/View_Food_voucher_generation/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				
				$get_biz = $this->db->get_where('acct_categories', ['id'=>$r->pay_type]);
				foreach($get_biz->result() as $biz);
				$business_type = $biz->name;
				
				$get_role = $this->db->get_where('role', ['roleid'=>$r->pay_to_role]);
				foreach($get_role->result() as $role);
				$for_role = $role->rolename;
				
				if($r->receiver_role != 0){
					$receiver_role = singleDbTableRow($r->receiver_role, 'role')->rolename;
				}
				else{
					$receiver_role = "Not Mentioned";
				}
				
				if($r->period != ""){
					$period = $r->period."ly";
				}
				else{
					$period = "monthly";
				}
				
				if($r->validity != 0){
					$validity = ceil($r->validity/24)." Day (".$r->validity." Hours)";
				}
				else{
					$validity = "Not Mentioned";
				}
				
				if($r->voucher_type != 0){
					$voucher_type = singleDbTableRow($r->voucher_type, 'status')->status;
				}
				else{
					$voucher_type = "Not Mentioned";
				}
				
				if($r->paytype_to != 0){
					$paytype_to = singleDbTableRow($r->paytype_to, 'acct_categories')->name;
				}
				else{
					$paytype_to = "Not Mentioned";
				}
				
                $data['data'][] = array(
                    $button,
                    $voucher_type,
                    $r->food_type,
                    number_format($r->actual_value,2),
					$business_type,
					$paytype_to,
                    $for_role,
                    $receiver_role,
					$period,
					$validity
				);
            }
        } else {
            $data['data'][] = array(
                'You have no transport list', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
   //view transportmodule

    public function View_Food_voucher_generation($id) {
        //restricted this area, only for admin
        permittedArea();
        $data['foodvoucher_Details'] = $this->db->get_where('food_voucher_scheme', ['id' => $id]);
        theme('food_voucher_details', $data);
    }
	
	 public function deleteAjax() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'food_voucher_scheme');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} food_voucher_scheme");
        //Now delete permanently
        $this->db->where('id', $id)->delete('food_voucher_scheme');
        return true;
    }
	
	public function edit_food_voucher($id)
	{   
		$data['foodvoucher_Details'] = $this->db->get_where('food_voucher_scheme', ['id' => $id]);
		$data['food_voucher_scheme'] = singleDbTableRow($id,'food_voucher_scheme');
		$data['acct_categories'] = $this->db->get_where('acct_categories', ['parentid'=>'0']);
		
		$data['rolename'] = $this->db->get('role');
		$data['first_name'] = $this->db->get('users');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'edit_foodvoucher')
                die('Error! sorry');
			
			
			$this->form_validation->set_rules('food_type', 'food_type', 'trim|required');
			$this->form_validation->set_rules('actual_price', 'actual_price', 'trim|required');
			$this->form_validation->set_rules('pay_type', 'pay_type');
            $this->form_validation->set_rules('to_role', 'to_role');
			$this->form_validation->set_rules('transferrable', 'transferrable', 'required');
           
			  

            if ($this->form_validation->run() == true) {
                $insert = $this->Food_voucher_model->edit_foodvoucher($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Voucher Permission Updated Successfully...!!!');
                    redirect(base_url('Food_voucher'));
                }
            }
        }

        theme('edit_food_voucher', $data);
    }
	
   // user food voucher starts here
   
	public function my_food_coupons()
	{
		theme('food_coupons');
	}

	public function create_food_voucher()
	{
		
		$data['food_type'] = $this->db->get_where('food_voucher_scheme', ['food_type']);
		
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'userfoodvoucher') die('Error! sorry');

			$this->form_validation->set_rules('food_type', 'food_type','required');
			$this->form_validation->set_rules('num_tickets', 'num_tickets','required');
			$this->form_validation->set_rules('ticket_values', 'ticket_values', 'required');
			$this->form_validation->set_rules('actual_values', 'actual_values', 'required');
			$this->form_validation->set_rules('start_date', 'start_date','required');

			
			if($this->form_validation->run() == true)
			{
				$user_info = $this->session->userdata('logged_user');
				$user_id = $user_info['user_id'];
				$sender_referral_code   = singleDbTableRow($user_id)->referral_code;
				
					$pay_by_referral_code 	= 	$sender_referral_code;	
					$pay_to_referral_code 	= 	'5917428036'; // redeem_voucher
					$amount_to_pay		  	=	$this->input->post('ticket_values');		
					$pay_spec_type			=	'96';				
					$transaction_remarks	=	"Creation of Coupons";	
					$pm_mode				=	"wallet";			
					
					
					$make_my_payment = $this->payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode);
					
					$insert = $this->Food_voucher_model->create_food_voucher();
					if($insert && $make_my_payment)
					{
						$this->session->set_flashdata('successMsg', 'Your Vouchers Created Successfully!');
						redirect(base_url('Food_voucher/my_food_coupons'));
					}
				
				
			}
		}
		
		theme('create_food_voucher',$data);

	}
	
	
	public function vouchersListJson(){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->Food_voucher_model->vouchersListCount();
		$query = $this->Food_voucher_model->vouchersList($limit, $start);
	

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		if ($query -> num_rows() > '0' )
		{
		foreach($query->result() as $r){
		$today_date = date("Y-m-d"); 
			
			if($r->transferred_to != 0){
				if($r->paid_to != 0){
					if(singleDbTableRow($r->paid_to)->company_name != ""){
						$transferred_to = "Paid To ".singleDbTableRow($r->paid_to)->company_name;
					}
					else{
						$transferred_to = "Paid To ".singleDbTableRow($r->paid_to)->first_name." ".singleDbTableRow($r->paid_to)->last_name;
					}
				}
				else{
					if($r->transferred_to == $user_id){
						$transferred_to = "Transferred By ".singleDbTableRow($r->transferred_by)->first_name." ".singleDbTableRow($r->transferred_by)->last_name;
					}
					else{
						$transferred_to = "Transferred To ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name;
					}
				}
			}
			else{
				$transferred_to = "Not Transferred/Paid Yet.";
			}
			
			if($r->used_by != 0){
				$used_by = singleDbTableRow($r->used_by)->first_name." ".singleDbTableRow($r->used_by)->last_name;	
			}
			else{
				if($r->transferred_to != 0 && $r->transferred_by == $user_id){
					if(singleDbTableRow($r->transferred_to)->gender == 'male'){
						$used_by = "Transferred to ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name.",<br> But not used by him yet.";
					}
					elseif(singleDbTableRow($r->transferred_to)->gender == 'female'){
						$used_by = "Transferred to ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name.",<br> But not used by her yet.";
					}
					else{
						$used_by = "Transferred to ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name.",<br> But not used yet.";
					}
				}
				else{
					$used_by = "Not Used Yet";
				}
				
			}
			
			
			if($r->voucher_name != 0){
				$voucher_type = singleDbTableRow($r->voucher_name, 'status')->status;
			}
			else{
				$voucher_type = "Not Mentioned";
			}
			
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('vouchers/voucher_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
		
			$data['data'][] = array(
				$button,
				$voucher_type,
				$r->voucher_description,
				$r->voucher_id,
				number_format($r->amount, 2) ,
				$r->start_date,						
				$r->end_date,
				$r->transferrable,	
				$transferred_to,	
				$r->used,	
				$used_by
			);
				
		}
	}
		else{
			$data['data'][] = array(
			'Vouchers are not available as on Today' , '', '','', '','','', '','','',''
			);
		}

		echo json_encode($data);

	}
	
	
	public function get_coupon_value(){
		$food_id = $_POST['food_id'];
		//echo $food_id;
		$get_actual_value = $this->db->get_where('food_voucher_scheme', ['id'=>$food_id]);
		
			foreach($get_actual_value->result() as $f){
			$amount = $f->actual_value;
			
			}
		echo $amount;
	}
	
	public function get_coupon_period(){
		$food_id = $_POST['food_id'];
		//echo $food_id;
		$get_validity = $this->db->get_where('food_voucher_scheme', ['id'=>$food_id]);
		
		foreach($get_validity->result() as $f);
		if($f->period != ""){
			$period = $f->period."ly";
			$period_val = $f->period;
		}
		else{
			$period = "monthly";
			$period_val = "month";
		}
		
		echo '<input type="text" class="form-control" value="'.$period.'" readonly >';
		echo '<input type="hidden" name="voc_period" class="form-control" value="'.$period_val.'" readonly >';
		
		//echo $validity;
	}
	
	public function get_coupon_validity(){
		$food_id = $_POST['food_id'];
		//echo $food_id;
		$get_validity = $this->db->get_where('food_voucher_scheme', ['id'=>$food_id]);
		
		foreach($get_validity->result() as $f);
		if($f->validity != 0){
			$validity = ceil($f->validity/24)." Day (".$f->validity." Hours)";
			$validity_val = $f->validity;
		}
		else{
			$validity = "Not Mentioned";
			$validity_val = 0;
		}
		
		echo '<input type="text" class="form-control" value="'.$validity.'" readonly >';
		echo '<input type="hidden" name="voc_validity" class="form-control" value="'.$validity_val.'" readonly >';
	}
	
	public function get_to_role(){
		$food_id = $_POST['food_id'];
		//echo $food_id;
		$get_actual_value = $this->db->get_where('food_voucher_scheme', ['id'=>$food_id]);
		
			foreach($get_actual_value->result() as $f){
			$to_role = $f->pay_to_role;
			
			}
		echo $to_role;
	}
	
	public function get_ticket_values(){
		
		$food 	  = $_POST['food'];
		$tickets  = $_POST['tickets'];
		
		$get_actual_value = $this->db->get_where('food_voucher_discount', ['food_type'=>$food]);
		foreach($get_actual_value->result() as $f){
			if($f->tickent_no_from <= $tickets && $f->tickent_no_to >= $tickets){
				$actual_value 	 = $f->actual_value;
				$discount_value  = $f->discount_value;
			
		
		$actualvalues 	= $actual_value*$tickets;
		
		$ticketvalues 	= $actualvalues-($discount_value*$tickets);
		
		$yousaved 		= $actualvalues-$ticketvalues ;
		
		echo '
			<div class="form-group">
				<label for="firstName" class="col-md-3">Discount Per Plate
				 <span class="text-red">*</span>
				</label>
				<div class="col-md-9">						
					<input type="number" name="actual_values" id="actual_values" class="form-control" value="'.$discount_value.'" placeholder="" readonly>
				   
				</div>
			</div>
			
			<div class="form-group">
				<label for="firstName" class="col-md-3">Actual values
				 <span class="text-red">*</span>
				</label>
				<div class="col-md-9">						
					<input type="number" name="actual_values" id="actual_values" class="form-control" value="'.$actualvalues.'" placeholder="" readonly>
				   
				</div>
			</div>
		
		<div class="form-group">
			<label for="firstName" class="col-md-3">Coupon values
			 <span class="text-red">*</span>
			</label>
			<div class="col-md-9">						
				<input type="number" name="ticket_values" id="ticket_values" class="form-control" value="'.$ticketvalues.'" placeholder="" readonly>
			</div>
		</div>
		<div class="form-group">
			<label for="firstName" class="col-md-3">You Saved
			 <span class="text-red">*</span>
			</label>
			<div class="col-md-9">						
				<input type="number" name="you_saved" id="you_saved" class="form-control" value="'.$yousaved.'" placeholder="" readonly>
			</div>
		</div>
		<input type="hidden" name="voucher_amount" id="voucher_amount" class="form-control" value="'.$actual_value.'" placeholder="" readonly>
		';
		}
		else{
			echo "";
		}
	
		
		}
	}
	
	public function get_business_details(){
		
		$food = $_POST['food_id'];
		$get_actual_value = $this->db->get_where('food_voucher_scheme', ['id'=>$food]);
		foreach($get_actual_value->result() as $f){
			$transferrable	 = $f->transferrable;
			$pay_type 		 = $f->pay_type;
			$pay_to_role 	 = $f->pay_to_role;
			$pay_to_user 	 = $f->pay_to_user;
		}
		
		
		echo '<input type="hidden" name="pay_type" id="pay_type" class="form-control" value="'.$pay_type.'" placeholder="" readonly>
		
		<input type="hidden" name="transferrable" id="transferrable" class="form-control" value="'.$transferrable.'" placeholder="" readonly>
						
		<input type="hidden" name="to_role" id="to_role" class="form-control" value="'.$pay_to_role.'" placeholder="" readonly>
					
		<input type="hidden" name="to_user" id="to_user" class="form-control" value="'.$pay_to_user.'" placeholder="" readonly>';
	}
	
	public function add_discount()
	{
		//restricted this area, only for admin
		//permittedArea();
		$data['food_type'] = $this->db->get_where('food_voucher_scheme', ['food_type']);
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'foodvoucher') die('Error! sorry');

			$this->form_validation->set_rules('food_type', 'food_type','required');
			$this->form_validation->set_rules('actual_price', 'actual_price','required');
			$this->form_validation->set_rules('from_no', 'from_no','required');
			$this->form_validation->set_rules('to_no', 'to_no','required');
			$this->form_validation->set_rules('discount_%', 'discount_%', 'required');
			$this->form_validation->set_rules('discount_value', 'discount_value');
			$this->form_validation->set_rules('price_discount', 'price_discount');
			
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->Food_voucher_model->add_discount();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Voucher Discount Added Successfully!');
					redirect(base_url('Food_voucher/voucher_discounts'));
				}

			}
		}
		theme('add_discount',$data);
	}
	
	
	public function voucher_discounts()
	{
		theme('food_voucher_discounts');
	}
	
	public function voucher_discounts_ListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Food_voucher_model->voucher_discounts_ListCount();


        $query = $this->Food_voucher_model->voucher_discounts_list();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Food_voucher/View_Food_voucher_discount/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';
				
				$get_food_type = $this->db->get_where('food_voucher_scheme', ['id'=>$r->food_type]);
				foreach($get_food_type->result() as $food);
				$food_type = $food->food_type;
				
				if($r->voucher_type != 0){
					$voucher_type = singleDbTableRow($r->voucher_type, 'status')->status;
				}
				else{
					$voucher_type = "Not Mentioned";
				}
				
                $data['data'][] = array(
                    $button,
                    $voucher_type,
                    $food_type,
                    number_format($r->actual_value,2),
                    $r->tickent_no_from." to ".$r->tickent_no_to,
                    $r->discount_in_per
				);
            }
        } else {
            $data['data'][] = array(
                'You have no transport list', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
	public function View_Food_voucher_discount($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['foodvoucher_Details'] = $this->db->get_where('food_voucher_discount', ['id' => $id]);
        theme('food_voucher_discount_details', $data);
    }
	
	public function edit_food_voucher_discount($id)
	{   
		
		$data['foodvoucher_Details'] = $this->db->get_where('food_voucher_discount', ['id' => $id]);
		$data['food_voucher_scheme'] = singleDbTableRow($id,'food_voucher_discount');
		$data['acct_categories'] = $this->db->get_where('acct_categories', ['parentid'=>'0']);
		
		$data['rolename'] = $this->db->get('role');
		$data['first_name'] = $this->db->get('users');

        if ($this->input->post()) {
            if ($this->input->post('submit') != 'foodvoucher')
                die('Error! sorry');
			
			
			$this->form_validation->set_rules('food_type', 'food_type', 'trim|required');
			$this->form_validation->set_rules('actual_price', 'actual_price', 'trim|required');
			$this->form_validation->set_rules('discount_%', 'discount_%');
			$this->form_validation->set_rules('discount_value', 'discount_value');
			$this->form_validation->set_rules('price_discount', 'price_discount');
			
			  
			  

            if ($this->form_validation->run() == true) {
                $insert = $this->Food_voucher_model->edit_foodvoucher_discount($id);
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Voucher Discount Updated Successfully...!!!');
                    redirect(base_url('Food_voucher/voucher_discounts'));
                }
            }
        }

        theme('edit_food_voucher_discount', $data);
    }
	
	 public function deletediscount() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'food_voucher_discount');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} food_voucher_discount");
        //Now delete permanently
        $this->db->where('id', $id)->delete('food_voucher_discount');
        return true;
    }

	public function voucher_report_ListJson(){
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$voucher_type = $_POST['voucher_type'];
		$voc_type = $_POST['voc_type'];
		$usage = $_POST['usage'];
		$transfarable = $_POST['transfarable'];
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];
		
		
		$limit = $this->input->POST('length');
		$start = $this->input->POST('start');

		$queryCount = $this->Food_voucher_model->voucher_report_ListCount($voucher_type, $voc_type, $usage, $transfarable, $from_date, $to_date);
		$query = $this->Food_voucher_model->voucher_report_List($limit, $start, $voucher_type, $voc_type, $usage, $transfarable, $from_date, $to_date);
	

		$draw = $this->input->POST('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		if ($query -> num_rows() > 0 )
		{
		foreach($query->result() as $r){
		$today_date = date("Y-m-d"); 
			
			if($r->transferred_to != 0){
				if($r->paid_to != 0){
					if(singleDbTableRow($r->paid_to)->company_name != ""){
						$transferred_to = "Paid To ".singleDbTableRow($r->paid_to)->company_name;
					}
					else{
						$transferred_to = "Paid To ".singleDbTableRow($r->paid_to)->first_name." ".singleDbTableRow($r->paid_to)->last_name;
					}
				}
				else{
					if($r->transferred_to == $user_id){
						$transferred_to = "Transferred By ".singleDbTableRow($r->transferred_by)->first_name." ".singleDbTableRow($r->transferred_by)->last_name;
					}
					else{
						$transferred_to = "Transferred To ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name;
					}
				}
			}
			else{
				$transferred_to = "Not Transferred/Paid Yet.";
			}
			
			if($r->used_by != 0){
				$used_by = singleDbTableRow($r->used_by)->first_name." ".singleDbTableRow($r->used_by)->last_name;	
			}
			else{
				if($r->transferred_to != 0){
					if(singleDbTableRow($r->transferred_to)->gender == 'male'){
						$used_by = "Transferred to ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name.",<br> But not used by him yet.";
					}
					elseif(singleDbTableRow($r->transferred_to)->gender == 'female'){
						$used_by = "Transferred to ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name.",<br> But not used by her yet.";
					}
					else{
						$used_by = "Transferred to ".singleDbTableRow($r->transferred_to)->first_name." ".singleDbTableRow($r->transferred_to)->last_name.",<br> But not used yet.";
					}
				}
				else{
					$used_by = "Not Used Yet";
				}
				
			}
			
			if($r->voucher_name != 0){
				$voucher_type = singleDbTableRow($r->voucher_name, 'status')->status;
			}
			else{
				$voucher_type = "Not Mentioned";
			}
			
			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('vouchers/voucher_view/'. $r->id).'" data-toggle="tooltip" title="View"> <i class="fa fa-eye"></i> </a>';
		
			$data['data'][] = array(
				$button,
				$voucher_type,
				$r->voucher_description,
				$r->voucher_id,
				number_format($r->amount, 2) ,
				$r->start_date,						
				$r->end_date,
				$r->transferrable,	
				$transferred_to,	
				$r->used,	
				$used_by
			);
				
		}
	}
		else{
			$data['data'][] = array(
			'Vouchers are not available as on Today' , '', '','', '','','', '','','',''
			);
		}

		echo json_encode($data);
		
	}
	
	
	public function get_food_type()
	{
		$voc_type = $_POST['voc_type'];
		
		$query = $this->db->get_where('food_voucher_scheme', ['voucher_type'=>$voc_type]);
		$user = "<option value=''>Choose Option</option>";
		foreach($query->result() as $r)
		{
			$user.= "<option value='".$r->id."'>".$r->food_type."</option>";
        }
	   echo $user;
	}
	
	public function get_voch_type()
	{
		$voc_type = $_POST['voc_type'];
		
		$query = $this->db->group_by('voucher_description')->get_where('vouchers', ['voucher_name'=>$voc_type]);
		$user = "<option value=''>Choose Option</option>";
		foreach($query->result() as $r)
		{
			$user.= "<option value='".$r->voucher_description."'>".$r->voucher_description."</option>";
        }
	   echo $user;
	}
	
	public function get_sub_food_type()
	{
		$voc_type = $_POST['voc_type'];
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename   = singleDbTableRow($user_id)->rolename;
		
		$query = $this->db->group_by('food_type')->get_where('food_voucher_discount', ['to_role'=>$rolename, 'voucher_type'=>$voc_type]);
		$user = "<option value=''>Choose Option</option>";
		foreach($query->result() as $r)
		{
			$user.= "<option value='".$r->food_type."'>".singleDbTableRow($r->food_type, 'food_voucher_scheme')->food_type."</option>";
        }
	   echo $user;
	}
	
		public function send_otp(){
		$this->load->helper('string');
		$otp = random_string('numeric', 5);
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		include_once('sendsms.php');
		$mobile  =  singleDbTableRow($user_id)->contactno;
		$msg = $otp ;
		$uname = singleDbTableRow($user_id)->first_name;
		
		$message="Dear ".$uname.", please share the OTP ".$otp." with us to complete your order -Team Cfirst";
		$sendsms=new sendsms("http://alerts.solutionsinfini.com/api/v3",'sms',"Aa505b0f65c9f5714d91b8c19d2a5f53f", "CFIRST");
		$sendsms->send_sms($mobile, $message, 'http://www.consumer1st.in', 'xml');
		
		echo $otp;
	}
}
