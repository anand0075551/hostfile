<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_sales extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('custom_sales_model');

		check_auth(); //check is logged in.
	}

	public function index()
	{
		//Visible only for Admin
		//permittedArea();

		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_custom') die('Error! sorry');

			$this->form_validation->set_rules('invoice_id', 'Invoice Id', 'required|trim|numeric');
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->custom_sales_model->add_custom();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Customizations Added Successfully');
					redirect(base_url('custom_sales/custom_sales_list'));
				}
				else{
					$this->session->set_flashdata('successMsg', 'Error Occured');
					redirect(base_url('custom_sales'));
				}
			}
		}


		theme('add_custom');
	}
	
	public function custom_sales_list()
	{
		theme ('custom_sales');
	}
	
	public function customListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->custom_sales_model->customListJson();
		$query = $this->custom_sales_model->customlist($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
if($query -> num_rows() > 0) 
{	foreach($query->result() as $r){
		
			//Status Button


			//Action Button
			$button = '';
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('custom_sales/custom_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			
		//	$button .= $blockUnblockBtn;
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
			
		// linking SMB Database
		$ecom_db = $this->load->database('ecom', TRUE);
		
		// Get product Name
		$product_id = $r->product;
		$where_array3 = array('product_id' => $product_id );
		$table3 = "product";
		$query3 = $ecom_db->where($where_array3)->get($table3);
		foreach($query3->result() as $res3)
		{
			$product = $res3->title;
		}
		
			$data['data'][] = array(
				$button,
				$r->sale_code,
				$product,
				$r->custom_1,
				$r->custom_2,
				$r->custom_3
			);
		}
}
		else{
			$data['data'][] = array(
				'Reports are not Available' , '', '','', '','',''
			);
		
		}
		echo json_encode($data);

	}
	
	public function custom_view($id){
		//restricted this area, only for admin
		//permittedArea();
		$ecom_db = $this->load->database('ecom', TRUE);
		$data['custom_Details'] = $this->db->get_where('custom_sales', ['id' => $id]);
	
	
		theme('custom_details', $data);
	}
	
	public function edit_custom($id){
		//restricted this area, only for admin
		//permittedArea();
		$data['custom'] = singleDbTableRow($id,'custom_sales');
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_custom') die('Error! sorry');
            $this->form_validation->set_rules('invoice_id', 'Invoice Id', 'required|trim|numeric');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->custom_sales_model->edit_custom($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Customization Updated Successfully...!!!');
					redirect(base_url('custom_sales/custom_sales_list'));
				}
			}
		}

		theme('edit_custom', $data);
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
