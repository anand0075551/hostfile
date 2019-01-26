<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dynamic_invoice extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('dynamic_invoice_model');

		check_auth(); //check is logged in.
	}

	public function index()
	{
		//Visible only for Admin
		//permittedArea();

		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_template') die('Error! sorry');

			$this->form_validation->set_rules('template_name', 'Template Name', 'required|trim');
			$this->form_validation->set_rules('pay_type', 'Pay Type', 'required|trim|is_unique[dynamic_invoice.pay_type]');
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->dynamic_invoice_model->add_template();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Template Created Successfully.');
					redirect(base_url('dynamic_invoice/all_templates'));
				}
				else{
					$this->session->set_flashdata('erroeMsg', 'Error Occured.');
					redirect(base_url('dynamic_invoice/all_templates'));
				}
			}
		}


		theme('create_template');
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
	
	public function get_temp_name(){
		$id = $_POST['temp_id'];
		$query = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		foreach($query->result() as $title);
			
		echo $title->template_name;
	}
	
	public function get_title(){
		$id = $_POST['temp_id'];
		$query = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		foreach($query->result() as $title);
			
		echo $title->title;
	}
	
	public function get_date_label(){
		$id = $_POST['temp_id'];
		$query = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		foreach($query->result() as $title);
			
		echo $title->date;
	}
	
	public function get_sender_label(){
		$id = $_POST['temp_id'];
		$query = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		foreach($query->result() as $title);
			
		echo $title->sender_name;
	}
	
	public function get_receiver_label(){
		$id = $_POST['temp_id'];
		$query = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		foreach($query->result() as $title);
			
		echo $title->receiver_name;
	}
	
	public function get_invoice_no_label(){
		$id = $_POST['temp_id'];
		$query = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		foreach($query->result() as $title);
			
		echo $title->invoice_no;
	}
	
	public function get_qty_label(){
		$id = $_POST['temp_id'];
		$query = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		foreach($query->result() as $title);
			
		echo $title->sl_no;
	}
	
	public function get_trans_remark_label(){
		$id = $_POST['temp_id'];
		$query = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		foreach($query->result() as $title);
			
		echo $title->transaction_remarks;
	}
	
	public function get_biz_catg_label(){
		$id = $_POST['temp_id'];
		$query = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		foreach($query->result() as $title);
			
		echo $title->business_category;
	}
	
	public function get_price_label(){
		$id = $_POST['temp_id'];
		$query = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		foreach($query->result() as $title);
			
		echo $title->price;
	}
	
	public function get_subtotal_label(){
		$id = $_POST['temp_id'];
		$query = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		foreach($query->result() as $title);
			
		echo $title->sub_total;
	}
	
	public function get_total_label(){
		$id = $_POST['temp_id'];
		$query = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		foreach($query->result() as $title);
			
		echo $title->total;
	}
	
	
	
	
	
	public function all_templates()
	{
		theme ('all_templates');
	}
	
	public function templateListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->dynamic_invoice_model->templateListcount();
		$query = $this->dynamic_invoice_model->templateList($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		if($query -> num_rows() > 0) {	
			foreach($query->result() as $r){
		
				//Action Button
				$button = '';
				$button .= '<a class="btn btn-primary btn-sm editBtn" href="'.base_url('dynamic_invoice/template_view/'. $r->id).'" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a>';
				
				
				$data['data'][] = array(
					$button,
					$r->template_name,
					$r->title,
					$r->pay_type."-".singleDbTableRow($r->pay_type, 'acct_categories')->name
				);
		
			}
		}
		else{
			$data['data'][] = array(
				'No Templates Available' , '', '', ''
			);
		
		}
		echo json_encode($data);

	}
	
	public function template_view($id){
		
		$data['template_details'] = $this->db->get_where('dynamic_invoice', ['id' => $id]);
	
	
		theme('template_view', $data);
	}
	
	public function edit_template($id){
		//restricted this area, only for admin
		//permittedArea();
		$data['template_details'] = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_template') die('Error! sorry');
            $this->form_validation->set_rules('template_name', 'Template Name', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->dynamic_invoice_model->edit_template($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Template Updated Successfully.');
					redirect(base_url('dynamic_invoice/all_templates'));
				}
			}
		}

		theme('edit_template', $data);
	}
	
	public function copy_template($id){
		//restricted this area, only for admin
		//permittedArea();
		$data['template_details'] = $this->db->get_where('dynamic_invoice', ['id' => $id]);
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'copy_template') die('Error! sorry');
            $this->form_validation->set_rules('template_name', 'Template Name', 'required|trim');
			$this->form_validation->set_rules('pay_type', 'Pay Type', 'required|trim|is_unique[dynamic_invoice.pay_type]');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->dynamic_invoice_model->copy_template();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Template Copied Successfully.');
					redirect(base_url('dynamic_invoice/all_templates'));
				}
			}
		}

		theme('copy_template', $data);
	}
	
	
	
	
	
	
	
	
	
	
	public function get_product()
	{
		$ecom_db = $this->load->database('ecom', TRUE);
		$invoice_id = $_POST['invoice_id'];
		
		$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;
		
		if ($currentUser == 'admin')
		{		
			if($invoice_id != "")
			{
				$where_array = array('sale_code' => $invoice_id );
				$table = "sale";
				$query = $ecom_db->where($where_array)->get($table);
				
				$data = '<option value=""> Select Product  </option>';
				
				foreach($query->result() as $res)
				{
					$product_details = json_decode($res->product_details, true);
					foreach ($product_details as $row) {
					$data .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
					}
					echo $data;	
				}
			}
			else{
				$data = '<option value=""> Select Product  </option>';
				echo $data;
			}
		}
		
		else
		{		
			if($invoice_id != "")
			{
				$where_array = array('sale_code' => $invoice_id );
				$table = "sale";
				$query = $ecom_db->where($where_array)->get($table);
				
				$data = '<option value=""> Select Product  </option>';
				
				foreach($query->result() as $res)
				{
					$product_details = json_decode($res->product_details, true);
					foreach ($product_details as $row1) {
						$p_id = $row1['id'];
						$where_array2 = array('product_id' => $p_id );
						$table2 = "product";
						$query2 = $ecom_db->where($where_array2)->get($table2);
						
						foreach($query2->result() as $res2){
						$v1 = $res2->added_by; 
							list($type, $id) = explode(",", $v1);
							list($i1, $i2) = explode(":", $id);
							list($i3, $i4) = explode("}", $i2);
							$v_id = trim($i3,'"');
							$query4 = $ecom_db->get_where('vendor', ['vendor_id'=>$v_id]);
							foreach($query4->result() as $res4){
								$v_email = $res4->email;
								if($v_email==$email ){
									$data .= '<option value="'.$row1['id'].'">'.$row1['name'].'</option>';
								}
							}
						}
					}
					echo $data;	
				}
			}
			else{
				$data = '<option value=""> Select Product  </option>';
				echo $data;
			}
		}
	}
	
}
