<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Defect_product extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('defect_model');

		check_auth(); //check is logged in.
	}

	public function index()
	{
		//Visible only for Admin
		//permittedArea();

		theme('defect_Index');
	}

	
	public function add_defect()
	{
		//permittedArea();

		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_defect') die('Error! sorry');

			$this->form_validation->set_rules('invoice_id', 'Invoice Id', 'required|trim|numeric');
			$this->form_validation->set_rules('return_product_value', 'Product Return Value', 'numeric');
			$this->form_validation->set_rules('vendor_id', 'Vendor ID', 'numeric');


			if($this->form_validation->run() == true)
			{
				$insert = $this->defect_model->add_defect();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Product Defect Added Successfully');
					redirect(base_url('defect_product/add_defect'));
				}
			}
		}


		theme('return_product');
	}
	
	public function defectListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->defect_model->defectListJson();
		$query = $this->defect_model->defectlist($limit, $start);

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
			$button .= '<a class="btn btn-primary editBtn" href="'.base_url('defect_product/defect_view/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
			
		//	$button .= $blockUnblockBtn;
		//	$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
		//				<i class="fa fa-trash"></i> </a>';
			
		// linking SMB Database
		$ecom_db = $this->load->database('ecom', TRUE);
		
		// Get category Name
		$cat_id = $r->category;
		$where_array = array('category_id' => $cat_id );
		$table = "category";
		$query = $ecom_db->where($where_array)->get($table);
		foreach($query->result() as $res)
		{
			$category = $res->category_name;
		}
		
		// Get Sub_category Name
		$sub_cat_id = $r->sub_category;
		$where_array2 = array('sub_category_id' => $sub_cat_id );
		$table2 = "sub_category";
		$query2 = $ecom_db->where($where_array2)->get($table2);
		foreach($query2->result() as $res2)
		{
			$sub_category = $res2->sub_category_name;
		}
		
			$data['data'][] = array(
				$button,
				$r->invoice_id,
				$r->invoice_value,
				$category,
				$sub_category,
				$r->return_product_value,
				$r->defect_reason,
				$r->vendor_id,
				$r->comments
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

	
	public function defect_view($id){
		//restricted this area, only for admin
		permittedArea();

		$data['defect_Details'] = $this->db->get_where('smb_product_defects', ['id' => $id]);
	
	
		theme('defect_details', $data);
	}
	
	
	public function getvalue()
	{
		$ecom_db = $this->load->database('ecom', TRUE);
		$id = $_POST['sale_code'];
		if($id != "")
		{
			$where_array = array('sale_code' => $id );
			$table = "sale";
			$query = $ecom_db->where($where_array)->get($table);
			foreach($query->result() as $res)
			{
				echo '<input type="text" name="invoice_value" class="form-control" value="'.$res->grand_total.'" readonly>';
			}
		}
		else{
			echo '<input type="text" name="invoice_value" class="form-control" value="" placeholder="Invoice Value" readonly>';
		}
		
	}
	
	public function getsubcategory()
	{
		$ecom_db = $this->load->database('ecom', TRUE);
		$cat_id = $_POST['cat_id'];
		if($cat_id != "")
		{
			$where_array = array('category' => $cat_id );
			$table = "sub_category";
			$query = $ecom_db->where($where_array)->get($table);
			
			$data  = '<select name="subcategory" class="form-control">';
			$data .= '<option value=""> Select Sub Category  </option>';
			
			foreach($query->result() as $res)
			{
				$data .= '<option value="'.$res->sub_category_id.'">'.$res->sub_category_name.'</option>';
			}
			echo $data;
		}
		else{
			$data  = '<select name="subcategory" class="form-control">';
			$data .= '<option value=""> Select Sub Category  </option>';
			echo $data;
		}
		
	}


}
