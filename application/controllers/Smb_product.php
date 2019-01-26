<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smb_product extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('Smb_product_model');


		check_auth(); //check is logged in.
	}

	
		/**
	 * Category add method
	 *
	 */

public function smb_dashboard()
	{
		
		theme('smb_dashboard');
	}	
	 
 public function smb_dashboard2()
	{
		
		theme('shop_my_basket_dashboard');
	}	
	 
	 
//--------------------Physical product category---------------------------
	 public function physical_product_category()
	{
		
		permittedArea();
		
		//add new category
		if($this->input->post())
		{
			if($this->input->post('submit') != 'create_category') die('Error! sorry');

			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->add_category();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Category Created Successfully');
					redirect(base_url('Smb_product/physical_product_category'));
				}
			}
		}
		theme('physical_product_category');
	}
//listing
	public function categoryListJson(){
		
		permittedArea();
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Smb_product_model->phy_product_category_listcount();

		
		$query = $this->Smb_product_model->phy_product_category_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
		  {
			foreach($query->result() as $r){
					
				
				//Action Button
				$button = '';
						$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Smb_product/category_details/'. $r->id).'" data-toggle="tooltip" title="View">
							<i class="fa fa-eye"></i> </a> &nbsp;';
				$button .= '<a class="btn btn-info editBtn"  href="'.base_url('Smb_product/update_category/'. $r->id).'" data-toggle="tooltip" title="Update Status">
							<i class="fa fa-edit"></i> </a> &nbsp;';
				$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
					<i class="fa fa-trash"></i> </a> &nbsp;'; 
				$photo =' <img src ="'.base_url('smb_uploads/'.$r->banner).'" width="45" height="50" >';	
				$data['data'][] = array(
					$button,
					$r->category_name,					
					$photo,					
					date('d-M, Y', $r->created_at)		
				);
					
			}
		}
		else{
			   $data['data'][]=array(
				 'You have no Data' ,'','',''
				);
			}
			echo json_encode($data);
	}
	
//view category
	
	public function category_details($id){
		//restricted this area, only for admin
		permittedArea();
		
		$data['details_category'] = $this->db->get_where('smb_category', ['id' => $id]);
		
		theme('category_details', $data);	
	}
	
//delete category	
	public function deleteAjax(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'smb_category');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$categoryName} smb_category");
		//Now delete permanently
		$this->db->where('id', $id)->delete('smb_category');
		return true;
	}
	
//update category
	public function update_category($id){
		//restricted this area, only for admin
		permittedArea();
		
		$data['category'] = singleDbTableRow($id,'smb_category');
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'update_category') die('Error! sorry');
			
           $this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->update_category($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Category Updated Successfully...!!!');
					redirect(base_url('Smb_product/physical_product_category'));
				}
			}
		}
		theme('update_category', $data);
	}
//------------------------------End-----------------------------------------

//--------------------physical product brands -------------------------------

	public function physical_product_brands()
	{
		
		permittedArea();
		//add new brand
		if($this->input->post())
		{
			if($this->input->post('submit') != 'create_brands') die('Error! sorry');

			$this->form_validation->set_rules('brands_name', 'Created Brands', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->add_brands();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Brand Created Successfully');
					redirect(base_url('Smb_product/physical_product_brands'));
				}
			}
		}
		theme('physical_product_brands');
	}
//listing brand	
	public function physical_product_brands_list(){
		
		permittedArea();
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Smb_product_model->brands_ListCount();

		
		$query = $this->Smb_product_model->brands_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			

			//Action Button
			$button = '';
					$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Smb_product/brands_details/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a> &nbsp;';
			$button .= '<a class="btn btn-info editBtn"  href="'.base_url('Smb_product/update_brands/'. $r->id).'" data-toggle="tooltip" title="Update Status">
						<i class="fa fa-edit"></i> </a> &nbsp;';
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
				<i class="fa fa-trash"></i> </a> &nbsp;'; 
			$photo =' <img src ="'.base_url('smb_uploads/'.$r->logo).'" width="45" height="50" >';		
			$data['data'][] = array(
				$button,
				$photo,	
				$r->name		
			);
		}
			}else{
				   $data['data'][]=array(
					 'You have no Data' ,'',''
				);
			}
					echo json_encode($data);
	}
//delete brand
	public function deletebrands(){
		$id = $this->input->post('id');

		//get deleted user info
		$userInfo = singleDbTableRow($id,'smb_brand');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$categoryName} smb_brand");
		//Now delete permanently
		$this->db->where('id', $id)->delete('smb_brand');
		return true;
	}
//view brand	
	public function brands_details($id){
				//restricted this area, only for admin
				permittedArea();
				
				$data['brands'] = $this->db->get_where('smb_brand', ['id' => $id]);
				
				theme('brands_details', $data);	
			}
//update brand	
	public function update_brands($id){
		//restricted this area, only for admin
		permittedArea();
		
		$data['brands'] = singleDbTableRow($id,'smb_brand');
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'update_brands') die('Error! sorry');
			
           $this->form_validation->set_rules('brands_name', 'Brands Name', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->update_brands($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Category Updated Successfully...!!!');
					redirect(base_url('Smb_product/physical_product_brands'));
				}
			}
		}
		theme('update_brands', $data);
	}
	
//------------------------------End -----------------------------------------

//--------------------physical prouct sub_category --------------------------

	 public function physical_product_subcategory()
	{
		permittedArea();
		
		if($this->input->post())
		{
			//add new sub_category
			if($this->input->post('submit') != 'create_sub_category') die('Error! sorry');

			$this->form_validation->set_rules('category_name', 'Sub Category Name', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->add_subcategory();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Sub Category Created Successfully');
					redirect(base_url('Smb_product/physical_product_subcategory'));
				}
			}
		}
		theme('physical_product_subcategory');
	}
//listing sub_category	
	public function subcategory_ListJson(){
		
		permittedArea();
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Smb_product_model->sub_ListCount();

		
		$query = $this->Smb_product_model->sub_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
		
				//Action Button
				$button = '';
						$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Smb_product/sub_category_details/'. $r->id).'" data-toggle="tooltip" title="View">
							<i class="fa fa-eye"></i> </a> &nbsp;';
				$button .= '<a class="btn btn-info editBtn"  href="'.base_url('Smb_product/update_subcategory/'. $r->id).'" data-toggle="tooltip" title="Update Status">
							<i class="fa fa-edit"></i> </a> &nbsp;';
				$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
					<i class="fa fa-trash"></i> </a> &nbsp;'; 
				
				$photo =' <img src ="'.base_url('smb_uploads/'.$r->banner).'" width="45" height="50" >';		
					
					$category = $r->category;
						$query = $this->db->get_where('smb_category', ['id'=>$category]);	
						foreach($query->result() as $d)
						{
							$category_name = $d->category_name;
						}
						$brand="";
						if($r->brand!=""){
							$brand_name = explode("," , $r->brand);
							foreach($brand_name as $brand_id){
								$query = $this->db->get_where('smb_brand', ['id'=>$brand_id]);	
								foreach($query->result() as $d)
								{
									$brand.= $d->name.", ";
								}	
							}
						}
						else{
							$brand = "";
						}
				$data['data'][] = array(
				$button,
					$r->sub_category_name,	
					$photo,
					$category_name
				);
		}
			}else{
				   $data['data'][]=array(
					 'You have no Data' ,'','',''
				);
			}
					echo json_encode($data);
	}
	
//delete sub_category
	
	public function sub_deleteAjax(){
		$id = $this->input->post('id');
		//get deleted user info
		$userInfo = singleDbTableRow($id,'smb_sub_category');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$categoryName} smb_sub_category");
		//Now delete permanently
		$this->db->where('id', $id)->delete('smb_sub_category');
		return true;
	}
	
//view sub_category	
	public function sub_category_details($id){
				//restricted this area, only for admin
				permittedArea();
				
				$data['sub_category'] = $this->db->get_where('smb_sub_category', ['id' => $id]);
				
				theme('sub_category_details', $data);	
			}
	
//update sub_category	
	public function update_subcategory($id){
		//restricted this area, only for admin
		permittedArea();
		
		$data['sub_category'] = singleDbTableRow($id,'smb_sub_category');
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'update_subcategory') die('Error! sorry');
			
		   $this->form_validation->set_rules('category_name', 'Sub Category Name', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->update_subcategory($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Sub Category Updated Successfully...!!!');
					redirect(base_url('Smb_product/physical_product_subcategory'));
				}
			}
		}
		theme('update_subcategory', $data);
	}
		
//------------------------------End -----------------------------------------

//--------------------------Physical product----------------------------------
  public function physical_products()
	{
		if($this->input->post())
		{
			//add new products
			if($this->input->post('submit') != 'create_product') die('Error! sorry');

			$this->form_validation->set_rules('product_title', 'Product Name', 'required|trim');
			
			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->add_product();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Product Created Successfully');
					redirect(base_url('Smb_product/physical_products'));
				}
			}
		}
		theme('physical_products');
	}
//listing product	
 public function product_ListJson(){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];	
		$rolename    = singleDbTableRow($user_id)->rolename;
	 
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Smb_product_model->product_ListCount();
		
		$query = $this->Smb_product_model->product_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			

			//Action Button
			$button = '';
					$button .= '<a class="btn btn-primary editBtn btn-sm" href="'.base_url('Smb_product/stock_details/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a> ';
				if($rolename == 11){		
					$button .= '<a class="btn btn-warning editBtn btn-sm"  href="'.base_url('Smb_product/update_product/'. $r->id).'" data-toggle="tooltip" title="Update Product">
					<i class="fa fa-edit"></i> </a> ';
					
					$button .= '<a class="btn btn-info editBtn btn-sm"  href="'.base_url('Smb_product/copy_product/'. $r->id).'" data-toggle="tooltip" title="Copy Product">
					<i class="fa fa-copy"></i> </a> ';
					
					$button .= '<a class="btn btn-danger deleteBtn btn-sm" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a> '; 
				}	
					$button .= '<a class="btn btn-primary btn-sm" href="'.base_url('Smb_product/create_stock/'. $r->id).'" data-toggle="modal" data-target="#create_stock" ><i class="fa fa-plus-circle "></i> Create Stock</a> ';
				
					$button .= '<a class="btn btn-primary btn-sm" href="'.base_url('Smb_product/destroy_stock/'. $r->id).'" data-toggle="modal" data-target="#destroy_stock" ><i class="fa fa-minus-circle"></i>  Destroy</a> '; 
					

			$photo =' <img src ="'.base_url('smb_uploads/'.$r->main_image).'" width="45" height="50" >';
			
			//cattegory
			$cat = $r->category;
			$query = $this->db->get_where('smb_category', ['id'=>$cat]);
			foreach($query->result() as $c);
			$category = $c->category_name;
			
			//sub_category
			$sub_cat = $r->sub_category;
			$query = $this->db->get_where('smb_sub_category', ['id'=>$sub_cat]);
			foreach($query->result() as $s);
			$sub_category = $s->sub_category_name;
				
			//business_groups
			$query = $this->db->get_where('business_groups', ['id'=>$r->business_types]);
			if($query->num_rows() > 0){
				foreach($query->result() as $s);
				$biz_type = $s->business_name;
			}
			else{
				$biz_type = "";
			}
			
			$data['data'][] = array(
				$button,
				$photo,
				$r->title,	
				$category,
				$sub_category,
				$biz_type
			);
			
		} }else{
				   $data['data'][]=array(
					 'You have no Data' ,'','','','',''
				);
			}
					echo json_encode($data);
	}
//delete product	
public function product_delete(){
		$id = $this->input->post('id');
		echo $id;
		//get deleted user info
		$userInfo = singleDbTableRow($id,'smb_product');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$categoryName} smb_product");
		//Now delete permanently
		$this->db->where('id', $id)->delete('smb_product');
		return true;
	}
//view product	
public function product_details($id){
				//restricted this area, only for admin
				
				
				$data['product'] = $this->db->get_where('smb_product', ['id' => $id]);
				
				theme('product_details', $data);	
			}
//update product

	public function update_product($id){
		
		$data['product'] = singleDbTableRow($id,'smb_product');
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'update_product') die('Error! sorry');
			
		   $this->form_validation->set_rules('title', 'Sub Category Name', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->update_product($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Product Updated Successfully...!!!');
					redirect(base_url('Smb_product/physical_products'));
				}
			}
		}
		theme('update_product', $data);
	}


//------------------------------End -----------------------------------------

//Copy product

	public function copy_product($id){
		
		$data['product'] = singleDbTableRow($id,'smb_product');
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'update_product') die('Error! sorry');
			
		   $this->form_validation->set_rules('title', 'Sub Category Name', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->copy_product();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Product Coppied Successfully...!!!');
					redirect(base_url('Smb_product/physical_products'));
				}
			}
		}
		theme('update_product', $data);
	}


//------------------------------End -----------------------------------------

//-----------------	 product stock-----------------------------------

	public function physical_product_stock()
		{
			
			theme('manage_product_stock');
		}
		
//listing
	public function physical_stock_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

		$queryCount = $this->Smb_product_model->physical_stock_listcount();

		
		$query = $this->Smb_product_model->physical_stock_list($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
				//Action Button
				$button = '';
				
				$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Smb_product/stock_details/'. $r->product).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a> &nbsp;';
										
				
					$product_title = $r->product;
					if($product_title != ""){
						$query = $this->db->get_where('smb_product', ['id'=>$product_title]);	
						foreach($query->result() as $t)
						{
							$product_title = $t->title;
						}
					}
					else{
						$product_title = "";
					}
					if($role == 11){
						$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$r->product,'type'=>'add']);
						foreach($get_added_stock->result() as $added_stock);
						$total_added = $added_stock->quantity;
						
						$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$r->product, 'type'=>'sold']);
						foreach($get_sold_stock->result() as $sold_stock);
						$total_sold = $sold_stock->quantity;
						
						if($total_sold == "")
						{
							$t_sold = 0;
						}
						else{
							$t_sold = $total_sold;
						}
						
						$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$r->product, 'type'=>'destroy']);
						foreach($get_destroyed_stock->result() as $destroyed_stock);
						$total_destroyed = $destroyed_stock->quantity;
						
						if($total_destroyed == "")
						{
							$t_destroyed = 0;
						}
						else{
							$t_destroyed = $total_destroyed;
						}
						
						$av_stock = $total_added-($total_sold+$total_destroyed);
					}
					else{
						$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$r->product,'type'=>'add','added_by'=>$user_id]);
						foreach($get_added_stock->result() as $added_stock);
						$total_added = $added_stock->quantity;
						
						$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$r->product, 'type'=>'sold','added_by'=>$user_id]);
						foreach($get_sold_stock->result() as $sold_stock);
						$total_sold = $sold_stock->quantity;
						
						if($total_sold == "")
						{
							$t_sold = 0;
						}
						else{
							$t_sold = $total_sold;
						}
						
						$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$r->product, 'type'=>'destroy','added_by'=>$user_id]);
						foreach($get_destroyed_stock->result() as $destroyed_stock);
						$total_destroyed = $destroyed_stock->quantity;
						
						if($total_destroyed == "")
						{
							$t_destroyed = 0;
						}
						else{
							$t_destroyed = $total_destroyed;
						}
						
						$av_stock = $total_added-($total_sold+$total_destroyed);
					}
					
					
					
				$data['data'][] = array(
				$button,
					$product_title,					
					$total_added,					
					$t_sold,					
					$t_destroyed,					
					$av_stock					
				);
		}
			}else{
				   $data['data'][]=array(
					 'You have no Data' ,'','','','',''
				);
			}
					echo json_encode($data);    
	}

//view product	
public function stock_details($id)
	{
		$data['stock'] = $this->db->get_where('smb_product', ['id' => $id]);

		theme('stock_details', $data);	
	}	
	

	
//create stock	
public function create_stock($id)
	{
		//create stock
			if($this->input->post('submit') == 'stock_create') {

				$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');

				if($this->form_validation->run() == true)
				{
					$insert = $this->Smb_product_model->add_stock();	
					if($insert)
					{
						$id= $this->input->post('product');
						$this->session->set_flashdata('successMsg', 'Stock Created Successfully');
						redirect(base_url('Smb_product/stock_details/'.$id));
					}	
				}
			}
			
		$data['create_stock'] = $this->db->get_where('smb_product', ['id' => $id]);

		theme('create_stock', $data);	
	}	
	
//Destory Stock
public function destroy_stock($id)
	{
		if($this->input->post('submit') == 'destroy_stock')
		{
			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->destroy_stock();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Stock Destory Successfully');
					redirect(base_url('Smb_product/stock_details/'.$id));
				}	
			}
		}
		
		$data['destroy_stock'] = $this->db->get_where('smb_product', ['id' => $id]);

		theme('destroy_stock', $data);		
	}	

//delete product	
		public function stock_delete(){
		$id = $_GET['id'];
		
		//Now delete permanently
		$this->db->where('id', $id)->delete('smb_stock');
		$this->session->set_flashdata('successMsg', 'Stock Destory Successfully');
		theme('manage_product_stock');
	}

//get pincode auto	
	public function getpincode()
    {
        $pin = $_POST['pin'];

        if($pin != "")
        {
            $where_array = array('location' => $pin );
            $table = "area";
            $query = $this->db->where($where_array)->get($table);

            $data = '<option value=""> Choose Pincode </option>';

            foreach($query->result() as $res);

                $pincode = $res->pincode;
                $test = explode(",", $pincode);
                foreach($test as $pin){
                    $data .= '<option value="'.$pin.'">'.$pin.'</option>';
                }

            echo $data;
        }
        else{
            $data = '<option value=""> Choose Pincode </option>';
            echo $data;
        }
    } 

//get sub_category auto
	public function getsubcategory()
	{
		$cat_id = $_POST['cat_id'];
		
		if($cat_id != "")
		{
			$where_array = array('category' => $cat_id );
			$table = "smb_sub_category";
			$query = $this->db->where($where_array)->get($table);
			
			$data = '<option value=""> Choose One  </option>';
			
			foreach($query->result() as $res)
			{
				$data .= '<option value="'.$res->id.'">'.$res->sub_category_name.'</option>';
			}
			echo $data;
		}
		else{
			$data = '<option value=""> Choose One  </option>';
			echo $data;
		}
		
		
	}
	
//get product auto	
	public function get_product()
	{
		$p_id = $_POST['p_id'];
		
		if($p_id != "")
		{
			$where_array = array('sub_category' => $p_id );
			$table = "smb_product";
			$query = $this->db->where($where_array)->get($table);
			
			$data = '<option value=""> Choose One  </option>';
			
			foreach($query->result() as $res)
			{
				$data .= '<option value="'.$res->id.'">'.$res->title.'</option>';
			}
			echo $data;
		}
		else{
			$data = '<option value=""> Choose One  </option>';
			echo $data;
		}
	}

//get product price auto	
	public function get_product_price()
	{
		$p_id = $_POST['p_id'];
		
		if($p_id != "")
		{
			$where_array = array('id' => $p_id );
			$table = "smb_product";
			$query = $this->db->where($where_array)->get($table);
			
			foreach($query->result() as $res)
			{
				$data = $res->sale_price;
			}
			echo $data;
		}
		else{
			$data = ' ';
			echo $data;
		}
	}
	
	
//------------------------------End -----------------------------------------


//-----------------	digital product  categgory-------------------------------
	
 public function digital_product_category()
	{
		//add new digital category
		if($this->input->post())
		{
			if($this->input->post('submit') != 'digital_category') die('Error! sorry');

			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->add_digital_product_category();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Sub Category Created Successfully');
					redirect(base_url('Smb_product/digital_product_category'));
				}
			}
		}
		theme('digital_product_category');
	}
	
//listing
	public function digital_product_list(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Smb_product_model->digital_product_category_listcount();

		
		$query = $this->Smb_product_model->digital_product_category_list($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
			
				//Action Button
				$button = '';
						$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Smb_product/digital_category_details/'. $r->id).'" data-toggle="tooltip" title="View">
							<i class="fa fa-eye"></i> </a> &nbsp;';
				$button .= '<a class="btn btn-info editBtn"  href="'.base_url('Smb_product/update_digital_category/'. $r->id).'" data-toggle="tooltip" title="Update Status">
							<i class="fa fa-edit"></i> </a> &nbsp;';
				$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
					<i class="fa fa-trash"></i> </a> &nbsp;'; 
				$photo =' <img src ="'.profile_photo_url($r->banner).'" width="45" height="50" >';
					
				$data['data'][] = array(
				$button,
					$r->category_name,					
					$photo,					
					date('d-M, Y', $r->created_at)		
				);
		}
			}else{
				   $data['data'][]=array(
					 'You have no Data' ,'','',''
				);
			}
					echo json_encode($data);
	}

//view digital category
	public function digital_category_details($id){
		//restricted this area, only for admin
		
		
		$data['digital_categgory'] = $this->db->get_where('smb_category', ['id' => $id]);
		
		theme('digital_category_details', $data);	
	}

//update digital categorry	
	public function update_digital_category($id){
		
		$data['category'] = singleDbTableRow($id,'smb_category');
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'update_digital_category') die('Error! sorry');
			
           $this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->update_digital_category($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Digital Category Updated Successfully...!!!');
					redirect(base_url('Smb_product/digital_product_category'));
				}
			}
		}
		theme('update_digital_category', $data);
	}
	 
//------------------------------End -----------------------------------------	
	
//--------------------Digital procuct sub_category --------------------------

	 public function digital_product_subcategory()
	{
		if($this->input->post())
		{
			//add new sub_category
			if($this->input->post('submit') != 'digital_sub_category') die('Error! sorry');

			$this->form_validation->set_rules('category_name', 'Sub Category Name', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->add_digital_subcategory();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Sub Category Created Successfully');
					redirect(base_url('Smb_product/digital_product_subcategory'));
				}
			}
		}
		theme('digital_product_sub_category');
	}
//listing sub_category	
	public function digital_subcategory_ListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Smb_product_model->digital_subcategory_ListCount();
		
		$query = $this->Smb_product_model->digital_subcategory_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
			
					//Action Button
					$button = '';
							$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Smb_product/digital_sub_category_details/'. $r->id).'" data-toggle="tooltip" title="View">
								<i class="fa fa-eye"></i> </a> &nbsp;';
					$button .= '<a class="btn btn-info editBtn"  href="'.base_url('Smb_product/update_digital_subcategory/'. $r->id).'" data-toggle="tooltip" title="Update Status">
								<i class="fa fa-edit"></i> </a> &nbsp;';
					$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a> &nbsp;'; 
					$photo =' <img src ="'.profile_photo_url($r->banner).'" width="45" height="50" >';
						
						
						$category = $r->category;
							$query = $this->db->get_where('smb_category', ['id'=>$category]);	
							foreach($query->result() as $d)
							{
								$category_name = $d->category_name;
							}
						
					$data['data'][] = array(
					$button,
						$r->sub_category_name,	
						$photo,
						$category_name
					);
		}
			}else{
				   $data['data'][]=array(
					 'You have no Data' ,'','','',''
				);
			}
					echo json_encode($data);
	}
	
//delete sub_category
	
	public function delete_digital_sub_category(){
		$id = $this->input->post('id');
		//get deleted user info
		$userInfo = singleDbTableRow($id,'smb_sub_category');
		$categoryName = $userInfo->name;
		// add a activity
		create_activity("Deleted {$categoryName} smb_sub_category");
		//Now delete permanently
		$this->db->where('id', $id)->delete('smb_sub_category');
		return true;
	}
	
//view sub_category	
	public function digital_sub_category_details($id){
				//restricted this area, only for admin
				
				
				$data['sub_category'] = $this->db->get_where('smb_sub_category', ['id' => $id]);
				
				theme('digital_sub_category_details', $data);	
			}
	
//update sub_category
	public function update_digital_subcategory($id){
		//restricted this area, only for admin
		
		$data['sub_category'] = singleDbTableRow($id,'smb_sub_category');
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'update_digital_sub_category') die('Error! sorry');
			
		   $this->form_validation->set_rules('category_name', 'Sub Category Name', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->update_digital_subcategory($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Sub Category Updated Successfully...!!!');
					redirect(base_url('Smb_product/digital_product_subcategory'));
				}
			}
		}
		theme('update_digital_subcategory', $data);
	}
		
//------------------------------End -----------------------------------------



//------------------------------All Digital Product  -----------------------------------------

public function all_digital_product()
	{
		if($this->input->post())
		{
			//add new products
			if($this->input->post('submit') != 'digital_create_product') die('Error! sorry');

			$this->form_validation->set_rules('product_title', 'Product Name', 'required|trim');
			

			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->add_digital_product();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Product Created Successfully');
					redirect(base_url('Smb_product/all_digital_product'));
				}
			}
		}
				
		theme('digital_product');
	}

//listing product	
 public function digital_product_ListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Smb_product_model->digital_product_ListCount();
		
		$query = $this->Smb_product_model->digital_product_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			

			//Action Button
			$button = '';
					$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Smb_product/digital_product_details/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a> &nbsp;';
			$button .= '<a class="btn btn-info editBtn"  href="'.base_url('Smb_product/update_digital_product/'. $r->id).'" data-toggle="tooltip" title="Update Status">
			<i class="fa fa-edit"></i> </a> &nbsp;';
			
			$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
				<i class="fa fa-trash"></i> </a> &nbsp;'; 
				
			$button .= '<a class="btn btn-primary" href="'.base_url('Smb_product/create_stock/'. $r->id).'" data-toggle="modal" data-target="#create_stock" ><i class="fa fa-plus-circle "></i> Create Stock</a> &nbsp;';
				
			$button .= '<a class="btn btn-primary" href="'.base_url('Smb_product/destroy_stock/'. $r->id).'" data-toggle="modal" data-target="#destroy_stock" ><i class="fa fa-minus-circle"></i>  Destroy</a> '; 
				
				
			$photo =' <img src ="'.profile_photo_url($r->main_image).'" width="45" height="50" >';
			
			//cattegory
			$cat = $r->category;
			$query = $this->db->get_where('smb_category', ['id'=>$cat]);
			foreach($query->result() as $c);
			$category = $c->category_name;
			
			//sub_category
			$sub_cat = $r->sub_category;
			$query = $this->db->get_where('smb_sub_category', ['id'=>$sub_cat]);
			foreach($query->result() as $s);
			$sub_category = $s->sub_category_name;
				
			$data['data'][] = array(
			$button,
				$photo,
				$r->title,
				$category,
				$sub_category
			);
		}
			}else{
				   $data['data'][]=array(
					 'You have no Data' ,'','','',''
				);
			}
					echo json_encode($data);
	}
	
//update product

	public function update_digital_product($id){
		
		$data['product'] = singleDbTableRow($id,'smb_product');
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'update_digital_product') die('Error! sorry');
			
		   $this->form_validation->set_rules('title', 'Sub Category Name', 'required|trim');
		   $this->form_validation->set_rules('pay_type', 'Payment Type', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->update_digital_product($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Product Updated Successfully...!!!');
					redirect(base_url('Smb_product/all_digital_product'));
				}
			}
		}
		theme('update_digital_product', $data);
	}

	
//view product	
	public function digital_product_details($id){
		
		$data['product'] = $this->db->get_where('smb_product', ['id' => $id]);
		
		theme('digital_product_details', $data);	
	}
//------------------------------End -----------------------------------------

//----------------------------Smb Sales -------------------------------------

public function order_history()
	{
		theme('order_history');
	}
		
	public function saleListJson(){
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Smb_product_model->all_sales_ListCount();
		
		$query = $this->Smb_product_model->sale_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			

			//Action Button
			$button = '';
			
				
			$button .= '<a class="btn btn-primary btn-sm" href="'.base_url('smb_product/full_invoice/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-file-text"></i> Order Details </a>';
						
			$buyer = $r->buyer;
							$query = $this->db->get_where('users', ['id'=>$buyer]);	
							foreach($query->result() as $d)
							{
								$buyer_name = $d->first_name." ".$d->last_name;
							}
			
			$data['data'][] = array(
				$button,
				$r->sale_code,
				$buyer_name,
				date('d-m-Y', $r->sale_datetime),
				'&#8377;'.number_format($r->grand_total,2),
				$r->delivery_status,
				$r->payment_status
			);
		}
			}else{
				   $data['data'][]=array(
					 'You have no Data' ,'','','','','',''
				);
			}
		echo json_encode($data);
	}

	public function full_invoice($id){
		
		$data['invoiceQuery'] = $this->db->get_where('smb_sale', ['id' => $id]);
		theme('smb_full_invoice', $data);
	}
	
	public function service_invoice($id){
		
		$data['invoiceQuery'] = $this->db->get_where('smb_sale', ['id' => $id]);
		theme('smb_service_invoice', $data);
	}
	
	public function vendor_service_invoice($id){
		
		$data['invoiceQuery'] = $this->db->get_where('smb_sale', ['id' => $id]);
		theme('smb_vendor_service_invoice', $data);
	}
//------------------------------End -----------------------------------------
		
		
	public function get_user()
     {
         $to_role=$_POST['to_role'];
		 
         $query = $this->Smb_product_model->get_user($to_role);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->id."'>".$r->first_name." ".$r->last_name."</option>";
         } 

     }
//Vendor Products Activation

public function vendor_activation()
	{
		permittedArea();
		
		theme('vendor_activation');
	}
	
	public function vendor_activation_list(){
		permittedArea();
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Smb_product_model->vendor_activation_listCount();
		
		$query = $this->Smb_product_model->vendor_activation_list($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
			
			$get_sts = $this->db->order_by('id','asc')->get_where('smb_stock', ['product'=>$r->product, 'added_by'=>$r->added_by, 'location'=>$r->location]);
			foreach($get_sts->result() as $s);
				$activeStatus = $s->active;
			
			//Status Button
			switch($activeStatus){
				case 0:
					$sts = '<small class="label label-danger"> Blocked </small>';
					$blockUnblockBtn = '<a class="btn btn-success blockUnblock" href="'.base_url('smb_product/approve_vendor/?p_id='.$r->product.'&v_id='.$r->added_by.'&loc='.$r->location ).'" data-toggle="tooltip" title="Approve"><i class="fa fa-unlock-alt"></i>  </a>';
					break;
				case 1 :
					$sts = '<small class="label label-success"> Active </small>';
					$blockUnblockBtn = '<a class="btn btn-warning blockUnblock" href="'.base_url('smb_product/block_vendor/?p_id='.$r->product.'&v_id='.$r->added_by.'&loc='.$r->location ).'" data-toggle="tooltip" title="Block"><i class="fa fa-lock"></i> </a>';
					break;
			}
			
			if(singleDbTableRow($r->added_by)->company_name !="")
			{
					$cname = singleDbTableRow($r->added_by)->company_name;
			}
			else
			{
				$cname = singleDbTableRow($r->added_by)->first_name.' '.singleDbTableRow($r->added_by)->last_name;
			}
			

			//Action Button
			$button = '';
			
				$button .= $blockUnblockBtn;
						
			$data['data'][] = array(
				$button,
				$cname,
				singleDbTableRow($r->product,'smb_product')->title,
				singleDbTableRow($r->location,'location_id')->location,
				$sts
			);
		}
			}else{
				   $data['data'][]=array(
					 'You have no Data' ,'','','',''
				);
			}
		echo json_encode($data);
	}
	
	public function block_vendor()
	{
		
		permittedArea();
		
		$product  	 = $_GET['p_id'];
		$vendor		 = $_GET['v_id'];
		$location	 = $_GET['loc'];
		
		$insert = $this->Smb_product_model->block_vendor($product, $vendor, $location);
		if($insert)
		{
		//	$this->session->set_flashdata('successMsg', 'Product Updated Successfully...!!!');
			redirect(base_url('smb_product/vendor_activation'));
		}
		
	}	
	
	public function approve_vendor()
	{
		
		permittedArea();
		
		$product  	 = $_GET['p_id'];
		$vendor		 = $_GET['v_id'];
		$location	 = $_GET['loc'];
		
		$insert = $this->Smb_product_model->approve_vendor($product, $vendor, $location);
		if($insert)
		{
		//	$this->session->set_flashdata('successMsg', 'Product Updated Successfully...!!!');
			redirect(base_url('smb_product/vendor_activation'));
		}
		
	}
	
	
//------------------------------Dynamic SMB -----------------------------------------
		
	public function dynamic_smb()
	{
		
		permittedArea();
		
		//add new category
		if($this->input->post())
		{
			if($this->input->post('submit') != 'dynamic_data') die('Error! sorry');

			$this->form_validation->set_rules('business_types', 'Business Type', 'required|trim');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->add_dynamic_label();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Labels Created Successfully');
					redirect(base_url('Smb_product/dynamic_smb'));
				}
			}
		}
		theme('dynamic_labels');
	}
	
	
//listing
	public function dynamic_smb_ListJson(){
		
		permittedArea();
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Smb_product_model->dynamic_smb_listcount();

		
		$query = $this->Smb_product_model->dynamic_smb_List($limit, $start);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
		  {
			foreach($query->result() as $r){
					
				
				//Action Button
				$button = '';
												
						$button .= '<a class="btn btn-info editBtn"  href="'.base_url('Smb_product/update_dynamic_labels/'. $r->id).'" data-toggle="tooltip" title="Update Status"><i class="fa fa-edit"></i> </a> &nbsp;';
						
				$query1 = $this->db->get_where('business_groups',['id'=>$r->business_type]);
				foreach($query1->result() as $res);
				
				$buss_name = $res->business_name;
				
					
				$data['data'][] = array(
				$button,
					$buss_name,	
					$r->sold_by,	
					$r->price,	
					$r->currency_value,	
					$r->add_to_cart,	
					$r->items,		
					$r->invoice_heading,		
					$r->invoice_sub_heading1,		
					$r->invoice_sub_heading2,
					$r->available

	
				);
			}
		}
		else{
			   $data['data'][]=array(
				 'You have no Data' ,'','','','','','','','','',''
				);
			}
			echo json_encode($data);
	}
	
//update product
	public function update_dynamic_labels($id){
		
		$data['update_labels'] = singleDbTableRow($id,'dynamic_labels');
		
		if($this->input->post())
		{
			if($this->input->post('submit') != 'dynamic_update') die('Error! sorry');
			
		   $this->form_validation->set_rules('business_types', 'Business', 'required|trim');
		
			if($this->form_validation->run() == true)
			{
				$insert = $this->Smb_product_model->update_dynamic_label($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Labels Updated Successfully...!!!');
					redirect(base_url('Smb_product/dynamic_smb'));
				}
			}
		}
		theme('update_dynamic_label', $data);
	}

//get aviable stock
	public function get_stock()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		
		$loc_id = $_POST['loc_id'];
		$product_id = $_POST['product_id'];
		
		if($loc_id != "")
		{
			$query2 = $this->db->get_where('smb_stock', ['product'=>$product_id]);
			if($query2->num_rows() > 0){
			foreach($query2->result() as $a);
			
			$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$a->product,'type'=>'add','added_by'=>$user_id, 'location'=>$loc_id]);
			foreach($get_added_stock->result() as $added_stock);
			$total_added = $added_stock->quantity;
			
			$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$a->product, 'type'=>'sold','added_by'=>$user_id,'location'=>$loc_id]);
			foreach($get_sold_stock->result() as $sold_stock);
			$total_sold = $sold_stock->quantity;
			
			$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$a->product, 'type'=>'destroy','added_by'=>$user_id,'location'=>$loc_id]);
			foreach($get_destroyed_stock->result() as $destroyed_stock);
			$total_destroyed = $destroyed_stock->quantity;
			
			$av_stock = $total_added-($total_sold+$total_destroyed);
			}
			else{
				$av_stock = "0";
			}
			
			
			
		}
		echo $av_stock;
		
		
	}	

	public function stock_view_json()
	{
		$id          = $_POST['id'];
		$limit       = $this->input->POST('length');
		$start       = $this->input->POST('start');
		$queryCount  = $this->Smb_product_model->view_stock_ListCount($id);
		$query       = $this->Smb_product_model->view_stock_List($limit, $start ,$id);
		

		$draw = $this->input->POST('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
	if($query ->num_rows() > 0) 
	  {
		  
		foreach($query->result() as $p){
			
			//date
			if($p->type == "add" || $p->type == "destroy")
			{
				$date = date('d-m-Y', $p->created_at);
			}
			else{
				$date = date('d-m-Y', $p->modified_at);
			}
			
			//shipping cost
			if($p->shipping_cost != ""){
				$shipping_cost = $p->shipping_cost;
			}
			else{
				$shipping_cost = 0;
			}
			
			//add price
			if($p->type == "add")
			{
				$add_price = $p->sale_price;
			}
			else{
				$add_price = 0;
			}
			
			//sold price
			if($p->type == "sold")
			{
				$sold_price = $p->sale_price;
			}
			else{
				$sold_price = 0;
			}
			
			//discount
			if($p->discount != "")
			{
				$discount = $p->discount;
			}
			else{
				$discount = 0;
			}
			
			//tax
			if($p->tax != ""){
				$tax = $p->tax;
			}
			else{
				$tax = 0;
			}
			
			//tax value
			if($p->tax_value != ""){
				$tax_value = $p->tax_value;
			}
			else{
				$tax_value = $p->tax;
			}
			
			
			$activeStatus = $p->active;
			
			if($activeStatus !="")
			{
				//Status Button
				switch($activeStatus){
						case 0:
							$sts = '<small class="label label-danger"> Blocked </small>';
							break;
						case 1 :
							$sts = '<small class="label label-success"> Active </small>';
							break;
					}	
			}
			else{
				$sts = "Not Defined";
			}
			
			
		$data['data'][] = array(	
				$date,
				$p->type,
                $p->quantity,
				$add_price,
                $sold_price,
				$p->total,
				$discount.' '.$p->discount_type,
				$tax,
				$tax_value,
				$shipping_cost,
                $shipping_cost*$p->quantity,
				singleDbTableRow($p->location, 'location_id')->location,
				$sts				
				);
		     }
          }
			
		else{
			$data['data'][] = array(
				'Stock is not created yet.' , '','','','','','','','','','','',''
			);
		
		}
		echo json_encode($data);
	}
	
	public function get_sub_category(){
		$category = $_POST['category'];
		
		$get_sub_catg = $this->db->get_where('smb_sub_category', ['category'=>$category]);
		if($get_sub_catg->num_rows() > 0){
			echo "<option value=''>Choose Sub-Category</option>";
			foreach($get_sub_catg->result() as $c){
				echo "<option value='".$c->id."'>".$c->sub_category_name."</option>";
			}
		}
	}
	
	public function get_products(){
		$sub_catg = $_POST['sub_catg'];
		
		$get_product = $this->db->get_where('smb_product', ['sub_category'=>$sub_catg]);
		if($get_product->num_rows() > 0){
			echo "<option value=''>Products</option>";
			foreach($get_product->result() as $c){
				echo "<option value='".$c->id."'>".$c->title."</option>";
			}
		}
	}
	
	public function product_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		
		$biz_type   	= $_POST['biz_type'];
		$category   	= $_POST['category'];
		$sub_category   = $_POST['sub_category'];
		$product   		= $_POST['product'];
		
		$limit       = $this->input->POST('length');
		$start       = $this->input->POST('start');


		$queryCount = $this->Smb_product_model->search_product_ListCount($biz_type, $category, $sub_category, $product);
		$query = $this->Smb_product_model->search_product_List($limit, $start, $biz_type, $category,  $sub_category, $product);
		
		$draw = $this->input->POST('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		
				
	if($query ->num_rows() > 0) 
	  {
		  
		foreach($query->result() as $r){
			
		//Action Button
		$button = '';
				$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Smb_product/stock_details/'. $r->id).'" data-toggle="tooltip" title="View">
					<i class="fa fa-eye"></i> </a> &nbsp;';
			if($role == 11){		
				$button .= '<a class="btn btn-info editBtn"  href="'.base_url('Smb_product/update_product/'. $r->id).'" data-toggle="tooltip" title="Update Status">
				<i class="fa fa-edit"></i> </a> &nbsp;';
				
				$button .= '<a class="btn btn-danger deleteBtn" id="'.$r->id.'" data-toggle="tooltip" title="Delete">
					<i class="fa fa-trash"></i> </a> &nbsp;'; 
			}	
				$button .= '<a class="btn btn-primary" href="'.base_url('Smb_product/create_stock/'. $r->id).'" data-toggle="modal" data-target="#create_stock" ><i class="fa fa-plus-circle "></i> Create Stock</a> &nbsp;';
			
				$button .= '<a class="btn btn-primary" href="'.base_url('Smb_product/destroy_stock/'. $r->id).'" data-toggle="modal" data-target="#destroy_stock" ><i class="fa fa-minus-circle"></i>  Destroy</a> '; 
				

		$photo =' <img src ="'.profile_photo_url($r->main_image).'" width="45" height="50" >';
		
		//cattegory
		$cat = $r->category;
		$query = $this->db->get_where('smb_category', ['id'=>$cat]);
		foreach($query->result() as $c);
		$category = $c->category_name;
		
		//sub_category
		$sub_cat = $r->sub_category;
		$query = $this->db->get_where('smb_sub_category', ['id'=>$sub_cat]);
		foreach($query->result() as $s);
		$sub_category = $s->sub_category_name;	
		
		//business_groups
			$query = $this->db->get_where('business_groups', ['id'=>$r->business_types]);
			if($query->num_rows() > 0){
				foreach($query->result() as $s);
				$biz_type = $s->business_name;
			}
			else{
				$biz_type = "";
			}
			
			$data['data'][] = array(
				$button,
				$photo,
				$r->title,	
				$category,
				$sub_category,
				$biz_type
			);
			
		     
          }
	  }
		else{
			$data['data'][] = array(
				'Products are not Available' , '', '','', '', ''
			);
		
		}
		echo json_encode($data);
	  }
	//vendor activation search list :: Dillip
	
	public function vendor_active_searchlist(){
		permittedArea();
		
		$limit = $this->input->POST('length');
		$start = $this->input->POST('start');

		$product 	 = $_POST['product'];
		$vendor  	 = $_POST['vendor'];
		$location    = $_POST['location'];
		$status      = $_POST['status'];

		$queryCount = $this->Smb_product_model->vendor_activation_searchlistCount($product,$vendor,$location,$status);
		
		$query = $this->Smb_product_model->vendor_activation_searchlist($limit, $start, $product,$vendor,$location,$status);

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
			
			
			$get_sts = $this->db->order_by('id','asc')->get_where('smb_stock', ['product'=>$r->product, 'added_by'=>$r->added_by, 'location'=>$r->location]);
			foreach($get_sts->result() as $s);
				$activeStatus = $s->active;
			
			//Status Button
			switch($activeStatus){
				case 0:
					$sts = '<small class="label label-danger"> Blocked </small>';
					$blockUnblockBtn = '<a class="btn btn-success blockUnblock" href="'.base_url('smb_product/approve_vendor/?p_id='.$r->product.'&v_id='.$r->added_by.'&loc='.$r->location ).'" data-toggle="tooltip" title="Approve"><i class="fa fa-unlock-alt"></i>  </a>';
					break;
				case 1 :
					$sts = '<small class="label label-success"> Active </small>';
					$blockUnblockBtn = '<a class="btn btn-warning blockUnblock" href="'.base_url('smb_product/block_vendor/?p_id='.$r->product.'&v_id='.$r->added_by.'&loc='.$r->location ).'" data-toggle="tooltip" title="Block"><i class="fa fa-lock"></i> </a>';
					break;
			}
			
			if(singleDbTableRow($r->added_by)->company_name !="")
			{
				$cname = singleDbTableRow($r->added_by)->company_name;
			}
			else
			{
				$cname = singleDbTableRow($r->added_by)->first_name.' '.singleDbTableRow($r->added_by)->last_name;
			}
			
			//Action Button
			$button = '';
			
				$button .= $blockUnblockBtn;
						
			$data['data'][] = array(
				$button,
				$cname,
				singleDbTableRow($r->product,'smb_product')->title,
				singleDbTableRow($r->location,'location_id')->location,
				$sts
			);
		}
			}else{
				   $data['data'][]=array(
					 'You have no Data' ,'','','',''
				);
			}
		echo json_encode($data);
	}
	
	public function thermal_invoice($id){
		
		$data['invoiceQuery'] = $this->db->get_where('smb_sale', ['id' => $id]);
		theme('smb_thermal_invoice', $data);
	}
	
	public function service_thermal_invoice($id){
		
		$data['invoiceQuery'] = $this->db->get_where('smb_sale', ['id' => $id]);
		theme('smb_service_thermal_invoice', $data);
	}
	
	public function service_vendor_thermal_invoice($id){
		
		$data['invoiceQuery'] = $this->db->get_where('smb_sale', ['id' => $id]);
		theme('service_vendor_thermal_invoice', $data);
	}
	
	public function	get_pincodes(){
		$location = $_POST['location'];
		$get_pincodes = $this->db->get_where('area', ['location'=>$location]);
		echo "<option value=''>Choose Pincodes</option>";
		if($get_pincodes->num_rows() > 0){
			foreach($get_pincodes->result() as $pin);
			$pincodes = explode(',', $pin->pincode);
			foreach($pincodes as $my_pin){
				echo "<option value='".$my_pin."'>".$my_pin."</option>";
			}
		}
	}
	
	public function get_grade_status(){
		$grade = $_POST['grade'];
		$product = $_POST['product'];
		$weight = $_POST['weight'];
		$get_sts = $this->db->get_where('smb_product', ['title'=>$product, 'grade'=>$grade, 'weight'=>$weight]);
		if($get_sts->num_rows() > 0){
			echo "<font color='red' size='3'><b>".$product."</b> Grade-".$grade.", ".$weight." KG Already Exist</font>";
		}
		else{
			echo "true";
		}
	}
	
}
	