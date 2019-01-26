<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_preparation extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Product_preparation_model');
        $this->load->model('Inventory_stocks_model');

        check_auth(); //check is logged in.
    }

    /**
     * Listing all transaction 
     */
    public function index() {

        theme('list_product_prep');
    }
	
	 public function list_product_ingredients() 
	 {
		 $data['product_name'] = $this->db->group_by('product_preparation')->get('product_ingredients');

        theme('list_product_ingredients',$data);
    }
   
    public function add_product_ingredients() {
        //restricted this area, only for admin
        permittedArea();
        
	$data['category_name'] = $this->db->get('smb_category');
	$data['product_name'] = $this->db->group_by('product_type')->get('product_preparation');
	$data['product'] = $this->db->get('product_preparation');
	$data['sub_category_name'] = $this->db->get('smb_sub_category');
	$data['title'] = $this->db->get(' smb_product');
	
        if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_product')
                die('Error! sorry');

            $this->form_validation->set_rules('product_type', 'Product Type', 'trim|required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
			$this->form_validation->set_rules('product_preparation', 'Product Preparation', 'trim|required');			
			$this->form_validation->set_rules('net_weight', 'Item Weight', 'trim|required');	
            
            if ($this->form_validation->run() == true) {
                $insert = $this->Product_preparation_model->add_product_ingredients();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Product Added Successfully');
                    redirect(base_url('Product_preparation/view_declared/'.$insert));
					//$this->view_declared($insert);
                }
            }
        }

        theme('add_product_ingredients', $data);
    }
	
	/*==================================*/
	 public function view_declared($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['view_assistant'] = $this->db->get_where('product_ingredients', ['product_preparation' => $id]);
     
       
        theme('view_declared_ingredients', $data);
    }
	/*==================================*/
	
	    public function add_product() {
        //restricted this area, only for admin
        permittedArea();
        
	if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_product')
                die('Error! sorry');

            $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
            $this->form_validation->set_rules('product_type', 'Product Type', 'trim|required');
           
		
            
            if ($this->form_validation->run() == true) {
                $insert = $this->Product_preparation_model->add_product();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Product Added Successfully');
                    redirect(base_url('Product_preparation/add_product_ingredients'));
                }
            }
        }

        theme('add_product');
    }
	
	  public function assistant_view_products() {
        //restricted this area, only for admin
		$data['category_name'] = $this->db->get('smb_category');
	$data['type'] = $this->db->group_by('product_type')->get('product_preparation');
	$data['product'] = $this->db->get('product_preparation');
	$data['sub_category_name'] = $this->db->get('smb_sub_category');
	$data['title'] = $this->db->get(' smb_product');
	
        $data['product_name'] = $this->db->group_by('product_preparation')->get('product_ingredients');
        
	if ($this->input->post()) {
            if ($this->input->post('submit') != 'select_product')
                die('Error! sorry');

            $this->form_validation->set_rules('product_preparation', 'product preparation', 'trim|required');
           
		
            
            if ($this->form_validation->run() == true) {
					
					$id = $this->input->post('product_preparation');
                   
                    redirect(base_url('Product_preparation/view_ingredients/'. $id));
                
            }
        }

        theme('assistant_view_products',$data);
    }
	
	
	
	
	 public function view_ingredients($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['view_assistant'] = $this->db->get_where('product_ingredients', ['product_preparation' => $id]);
        theme('view_ingredients', $data);
    }
	
	  public function detailed_list_products() {
        //restricted this area, only for admin
	
        $data['product_name'] = $this->db->group_by('product_preparation')->get('product_ingredients');
        
	if ($this->input->post()) {
            if ($this->input->post('submit') != 'select_product')
                die('Error! sorry');

            $this->form_validation->set_rules('product_preparation', 'product preparation', 'trim|required');
           
		
            
            if ($this->form_validation->run() == true) {
					
					$id = $this->input->post('product_preparation');
                   
                    redirect(base_url('Product_preparation/report_product_prepration/'. $id));
                
            }
        }

        theme('detailed_list_products',$data);
    }
	
	 public function report_product_prepration($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['view_assistant'] = $this->db->get_where('product_ingredients', ['product_preparation' => $id]);
     
       
        theme('report_product_prepration', $data);
    }
	
	    public function product_packaging() {
        //restricted this area, only for admin
        permittedArea();
		
		$data['product_name'] = $this->db->group_by('product_preparation')->get('product_ingredients');
		
        
	if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_packing')
                die('Error! sorry');

            $this->form_validation->set_rules('product_preparation', 'Product for Packing', 'trim|required');
            $this->form_validation->set_rules('prepaired_by', 'Assistant', 'trim|required');
           
		
            if ($this->form_validation->run() == true) {
           
                $insert = $this->Product_preparation_model->product_packaging();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Packing Saved Successfully');
                    redirect(base_url('Product_preparation/product_packaging'));
                }
			}
			 
        }

        theme('product_packaging', $data);
    }
	
	
	
	
	
	

        public function get_user()
     {
         $category=$_POST['category'];
         //echo $category;
         $query = $this->Product_preparation_model->get_user($category);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->id."'>".$r->sub_category_name."</option>";
         } 

     }
	
	 
	   public function get_assistant()
     {
         $category=$_POST['product'];
         echo $category;
         $query = $this->Product_preparation_model->get_assistant($category);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->id."'>".singleDbTableRow($r->created_by)->first_name.' '.singleDbTableRow($r->created_by)->last_name."</option>";
         } 

     }
	 
	 

	 
	    public function get_item()
     {
         $category=$_POST['category'];
         //echo $category;
         $query = $this->Product_preparation_model->get_item($category);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->id."'>".$r->title."</option>";
         } 

     }
	 
	   public function get_product_prepration()
     {
         $category=$_POST['id'];
         //echo $category;
         $query = $this->Product_preparation_model->get_product_prepration($category);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->id."'>".$r->product_name."</option>";
         } 

     }
	 
	 	

public function add_assistant()
		{
	       
		$used_weight=$_POST['used_weight'];
		$used_ingredeint=$_POST['used_ingredeint'];
		$product=$_POST['product'];
		$category=$_POST['category'];
	
		 $insert = $this->Product_preparation_model->add_assistant($used_weight,$used_ingredeint,$product,$category);
		if ($insert) 
		{
		echo 'Success';
		}
            

        
    }
	
	
	/*============================================================*/
	public function add_used_ingredients()
		{
	       
		$used_weight=$_POST['used_weight'];
		$used_ingredeint=$_POST['used_ingredeint'];
		$product=$_POST['product'];
		$category=$_POST['category'];
		$item=$_POST['item'];
		$total_output=$_POST['total_output'];
		
		
		
		
	
		 $insert = $this->Product_preparation_model->add_used_ingredients($used_weight,$used_ingredeint,$product,$category,$item,$total_output);
		  
		if ($insert) 
		{
		echo $insert;
		}
		/*if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Ingredients Added Successfully');
                    redirect(base_url('Product_preparation/view_used/'.$insert));
					//$this->view_declared($insert);
                } */
            
		
        
    }
	

	 
	/*===============================================================*/
	 public function view_used($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['view_assistant'] = $this->db->get_where('product_ingredients', ['product_preparation' => $id]);
        $data['used_assistant'] = $this->db->get_where('product_ingredients_used', ['product' => $id]);
     
       
        theme('view_used_ingredients', $data);
    }
	/*===============================================================*/
	  public function get_total_output()
     {
         $product1=$_POST['product'];
        
        $query = $this->Product_preparation_model->get_total_output($product1);
        
         foreach($query->result() as $r);
         
             echo $r->total_output; 
         

     }
	 
	 
	
	  public function get_ingredients_list()
     {
         $products=$_POST['product'];
        
         $query = $this->Product_preparation_model->get_ingredients_list($products);
         echo "<table class='table table-bordered table-striped table-hover dataTable'>
		 <tr>
		 <th>Sl No:</th>
		 <th>Category</th>
		 <th>Sub Category</th>
		 <th>Item</th>
		 <th>Declared Weights(Kg)</th>
		 <th>Used By</th>
		 <th>Used weight(Kg)</th>
		
		 </tr>
		 ";
		 $cnt=1;
		 $total_qty = 0 ;
		 $total_used = 0 ;
		 $sum_used = 0 ;
         foreach($query->result() as $r)
         {
			// $button = '';
             //   $button .= '<a class="btn btn-primary> </a>';
			 //
			$get_category_name = $this->db->get_where('smb_category', ['id'=>$r->category]);
			foreach($get_category_name->result() as $c);
			$category = $c->category_name;
			 //
			 $users = '';
			  $get_used_by = $this->db->get_where('product_ingredients_used', ['product'=>$products,'used_ingredeint'=>$r->ingredient]);
			foreach($get_used_by->result() as $u)
			{
			$used_by = $u->created_by;
				$get_user_name = $this->db->get_where('users', ['id'=>$used_by]);
				foreach($get_user_name->result() as $un);
				$user_name = $un->first_name." ".$un->last_name;
				$users = $user_name .' '.$users;
			}			
			 //
			$get_subcategory_name = $this->db->get_where('smb_sub_category', ['id'=>$r->sub_category]);
			foreach($get_subcategory_name->result() as $sc);
			$sub_category = $sc->sub_category_name;
			 //
			 //
			$get_prod_name = $this->db->get_where('smb_product', ['id'=>$r->item]);
			foreach($get_prod_name->result() as $p);
			$product = $p->title;
			//
	/*	$get_used_by = $this->db->get_where('product_ingredients_used', ['id'=>$r->created_by]);
			foreach($get_used_by->result() as $p);
			$used_by = $p->created_by;  
			*/
		//
			
//			
			echo "<input type='hidden' name='".$cnt."usedingr' id='".$cnt."usedingr' value='".$r->ingredient."'>";
			
			
			
			
			$used_ingredeint = " used_ingredeint = '".$r->ingredient."'  ";
        $query1 = $this->db->where($used_ingredeint )->get('product_ingredients_used');
        $sum = 0 ;
		
         if ($query1->num_rows() > 0)
        {
            foreach ($query1->result() as $re)
			if($re->category == 26)
            {
                $sum = $sum - $re->used_weight;
            }else
			{
				$sum = $sum + $re->used_weight;
			}
        }
			$query4 = $this->Product_preparation_model->get_ingredients_list($products);
			
			
			echo "<input type='hidden' name='".$cnt."product' id='".$cnt."product' value='".$products."'>";
			 //
			$qty = ($r->qty) ;
			$left = ($r->qty) - $sum;
			$total_qty =  $total_qty + $qty;
			$total_used =  $total_used + $left;
			$sum_used =  $sum_used + $sum;
			//$used_by =($r->created_by) ;
             echo "<tr>";
			 echo "<td>".$cnt."</td>";
			 echo "<td>".$category."</td>";
			 echo "<td>".$sub_category."</td>";
			 echo "<td>".$product."</td>";
			 echo "<td>".$qty."</td>";
			 echo "<td>".$users."</td>";
			  echo "<td>".$sum."</td>";
			
			 
			 echo "</tr>";
			 $cnt ++;
         } 
		/* $get_quantity = $this->db->get_where('product_preparation_tracking', ['id'=>$r->item]);
			foreach($get_quantity->result() as $p);
			$quantity = $p->quantity; */
		 $output = ($r->total_declared);
		 $total_left_weight = ($total_used) ;
		 $total_used_weight = ($sum_used) ;
		echo "
		<tr>
		<th></th><th>Quantity (Kg): ".$r->quantity."</th>
		 <th></th> <th></th> 
		 <th>Total Declared Weight (Kg): ".$output ."</th>
		<th></th>
		 <th>Total Output(Kg): ".$total_used_weight."</th>
		
		</tr>
		</table>";
		
		/*==============================================================================*/
	/*	        echo "<table class='table table-bordered table-striped table-hover dataTable'>
		 <tr>
		 
		 <th>Package Name</th>
		 <th>Quantity Per Box</th>
		 <th>No Of Pieces Packed</th>
		 <th>Packed By</th>
		
		
		 </tr>
		 ";
		
        
		
			 //
			 $users = '';
			  $get_used_by = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_used_by->result() as $u)
			{
			$used_by = $u->created_by;
				$get_user_name1 = $this->db->get_where('users', ['id'=>$used_by]);
				foreach($get_user_name1->result() as $un);
				$user_name1 = $un->first_name." ".$un->last_name;
				$users = $user_name .' '.$users;
			}			
			 //
			 
			  $get_package_name = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_package_name->result() as $u)
			{
			$package_name = $u->package_name_small;
				
				
			}			
			 //
			
			
			 //
			 
			  $get_quantity_small = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_quantity_small->result() as $u)
			{
			$quantity_small = $u->quantity_small;
				
				
			}	
			 //
			
			
			  $get_weight_small = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_weight_small->result() as $u)
			{
			$weight_small = $u->no_ofpiece_small;
				
				
			}	
				//	
            $get_package_name_medium = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_package_name_medium->result() as $u)
			{
			$package_name_medium = $u->package_name_medium;
				
				
			}	

 //
			 
			  $get_quantity_medium = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_quantity_medium->result() as $u)
			{
			$quantity_medium = $u->quantity_medium;
				
				
			}	
			 //			
			 
			 //
			   $get_weight_medium = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_weight_medium->result() as $u)
			{
			$weight_medium = $u->no_ofpiece_medium;
				
				
			}		
			 //
			 
			 		//	
            $get_package_name_large = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_package_name_large->result() as $u)
			{
			$package_name_large = $u->package_name_large;
				
				
			}	
			//
			 
			  $get_quantity_large = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_quantity_large->result() as $u)
			{
			$quantity_large = $u->quantity_large;
				
				
			}	
			 //			
			 
			 //
			   $get_weight_large = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_weight_large->result() as $u)
			{
			$weight_large = $u->no_ofpiece_large;
				
				
			}		
			 //
		
		
		 
			 		//	
            $get_package_name_family = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_package_name_family->result() as $u)
			{
			$package_name_family = $u->package_name_family;
				
				
			}	

				//
			 
			  $get_quantity_family = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_quantity_family->result() as $u)
			{
			$quantity_family= $u->quantity_family;
				
				
			}	
			 //			
			 
			 //
			   $get_weight_family = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_weight_family->result() as $u)
			{
			$weight_family = $u->no_ofpiece_family;
				
				
			}		
			 //
			
			 		//	
            $get_package_name_combo = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_package_name_combo->result() as $u)
			{
			$package_name_combo = $u->package_name_combo;
				
				
			}			

	//
			 
			  $get_quantity_combo = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_quantity_combo->result() as $u)
			{
			$quantity_combo= $u->quantity_combo;
				
				
			}	
			 //						
			 
			 //
			   $get_weight_combo = $this->db->get_where('product_packing', ['product'=>$products]);
			foreach($get_weight_combo->result() as $u)
			{
			$weight_combo = $u->no_ofpiece_combo;
				
				
			}		
			 //
			
			
			
//			
			echo "<input type='hidden' name='".$cnt."usedingr' id='".$cnt."usedingr' value='".$r->ingredient."'>";
			
			
			
			
			$used_ingredeint = " used_ingredeint = '".$r->ingredient."'  ";
        $query1 = $this->db->where($used_ingredeint )->get('product_ingredients_used');
        $sum = 0 ;
		
        if ($query1->num_rows() > 0)
        {
            foreach ($query1->result() as $re)
            {
                $sum = $sum + $re->used_weight;
            }

        }
			$query4 = $this->Product_preparation_model->get_ingredients_list($products);
			
			
			echo "<input type='hidden' name='".$cnt."product' id='".$cnt."product' value='".$products."'>";
			 //
			$qty = ($r->qty) ;
			$left = ($r->qty) - $sum;
			$total_qty =  $total_qty + $qty;
			$total_used =  $total_used + $left;
			$sum_used =  $sum_used + $sum;
			//$used_by =($r->created_by) ;
             echo "<tr>";
			
			 echo "<td>".$package_name."</td>";
			 echo "<td>".$quantity_small."</td>";
			 echo "<td>".$weight_small."</td>";
			 echo "<td>".$user_name1."</td>";
			
			
			 
			 echo "</tr>";
			 
			  echo "<tr>";
			
			 echo "<td>".$package_name_medium."</td>";
			  echo "<td>".$quantity_medium."</td>";
			 echo "<td>".$weight_medium."</td>";
			 echo "<td>".$user_name1."</td>";
			
			
			 
			 echo "</tr>";
			 
			   echo "<tr>";
			
			 echo "<td>".$package_name_large."</td>";
			  echo "<td>".$quantity_large."</td>";
			 echo "<td>".$weight_large."</td>";
			 echo "<td>".$user_name1."</td>";
			
			
			 
			 echo "</tr>";
			 
			 
			  echo "<tr>";
			
			 echo "<td>".$package_name_family."</td>";
			  echo "<td>".$quantity_family."</td>";
			 echo "<td>".$weight_family."</td>";
			 echo "<td>".$user_name1."</td>";
			
			
			 
			 echo "</tr>";
			 
			 
			 
			  echo "<tr>";
			
			 echo "<td>".$package_name_combo."</td>";
			  echo "<td>".$quantity_combo."</td>";
			 echo "<td>".$weight_combo."</td>";
			 echo "<td>".$user_name1."</td>";
			
			
			 
			 echo "</tr>";
			 
			 
         
		/* $get_quantity = $this->db->get_where('product_preparation_tracking', ['id'=>$r->item]);
			foreach($get_quantity->result() as $p);
			$quantity = $p->quantity; */
		 $output = ($r->total_declared);
		 $total_left_weight = ($total_used) ;
		 $total_used_weight = ($sum_used) ;
		echo "
		
		</table>";
		/*==============================================================================*/
		
     }
	 
	  public function product_prepration_report() {

        theme('product_prepration_report');
    }

	 
/*===============================================*/
  public function ingredientsListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Product_preparation_model->product_prepListCount();


        $query = $this->Product_preparation_model->product_prepList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_declared_ingredients/' . $r->product_preparation) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

               

		
		$get_category_name = $this->db->get_where('smb_category', ['id'=>$r->category]);
			foreach($get_category_name->result() as $c);
			$category = $c->category_name;
			
			$get_subcategory_name = $this->db->get_where('smb_sub_category', ['id'=>$r->sub_category]);
			foreach($get_subcategory_name->result() as $sc);
			$sub_category = $sc->sub_category_name;
			 //
			 //
			$get_prod_name = $this->db->get_where('smb_product', ['id'=>$r->item]);
			foreach($get_prod_name->result() as $p);
			$product = $p->title;
			
			$get_prod_name = $this->db->get_where('product_preparation', ['id'=>$r->product_preparation]);
			foreach($get_prod_name->result() as $p);
			$product_name = $p->product_name;
			
			$get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$declared_name = $p->first_name.' '.$p->last_name;
			
                $data['data'][] = array(
                    $button,
                   
                   $product_name,
                    $r->quantity,
                    $r->ingredient,
                    $category,
                    $sub_category,
                    $product,
                    $r->qty,
                    $r->total_declared,
                    date('d-m-Y', $r->created_at),
                   $declared_name
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Transaction list', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
/*===============================================*/
//searching
public function declared_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$product = $_POST['product'];
		$declared_by = $_POST['declared_by'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Product_preparation_model->product_prepListCount();
		
		$query = $this->Product_preparation_model->search_declared_list($limit, $start ,$product,$declared_by,$sf_time,$st_time);
		
		
		echo '<thead>
				<tr class="well">
					       
							<th>Action</th>
							<th>Product Preparation </th>
							<th>Quantity(Kg)</th>
							<th>Ingredient</th>
							<th>Category</th>
							<th>Sub Category</th>
							<th>Item</th>
							<th>Weight Of Each Item(kg)</th>
							<th>Total Declared Weight(kg)</th>
							<th>Creation Date</th>
							<th>Declared By</th>                   
				</tr>
				</thead>
				<tbody>';
		

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
	if($query ->num_rows() > 0) 
	  {
		  
		foreach($query->result() as $r){
			

			  //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_declared_ingredients/' . $r->product_preparation) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

               

		
		$get_category_name = $this->db->get_where('smb_category', ['id'=>$r->category]);
			foreach($get_category_name->result() as $c);
			$category = $c->category_name;
			
			$get_subcategory_name = $this->db->get_where('smb_sub_category', ['id'=>$r->sub_category]);
			foreach($get_subcategory_name->result() as $sc);
			$sub_category = $sc->sub_category_name;
			 //
			 //
			$get_prod_name = $this->db->get_where('smb_product', ['id'=>$r->item]);
			foreach($get_prod_name->result() as $p);
			$product = $p->title;
			
			$get_prod_name = $this->db->get_where('product_preparation', ['id'=>$r->product_preparation]);
			foreach($get_prod_name->result() as $p);
			$product_name = $p->product_name;
			
			$get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$declared_name = $p->first_name.' '.$p->last_name;
			
              
                  
				 echo '<tr>';    
                echo '<td>'.$button.'</td>';
                echo '<td>'.$product_name.'</td>';
                echo '<td>'.$r->quantity.'</td>';
                echo '<td>'.$r->ingredient.'</td>';
                echo '<td>'.$category.'</td>';
                echo '<td>'.$sub_category.'</td>';
                echo '<td>'.$product.'</td>';
                echo '<td>'.$r->qty.'</td>';
                echo '<td>'.$r->total_declared.'</td>';
                echo '<td>'.date('d-m-Y', $r->created_at).'</td>';
                echo '<td>'.$declared_name.'</td>';
                  echo '</tr>';  
				   
		
                
                
            }
			//echo json_encode($data);
		}
			else{
				  echo '<tr><td>No results found</td></tr>';
			}
		echo '</tbody>
			<tfoot>
				<tr class="well">
							<th>Action</th>
							<th>Product Preparation </th>
							<th>Quantity(Kg)</th>
							<th>Ingredient</th>
							<th>Category</th>
							<th>Sub Category</th>
							<th>Item</th>
							<th>Weight Of Each Item(kg)</th>
							<th>Total Declared Weight(kg)</th>
							<th>Creation Date</th>
							<th>Declared By</th>                   
				</tr>
				</tfoot>';	
	}
/*===============================================*/
 public function view_declared_ingredients($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['view_assistant'] = $this->db->get_where('product_ingredients', ['product_preparation' => $id]);
     
       
        theme('view_declared_ingredients', $data);
    }
	
/*===============================================*/
 public function view_used_ingredients($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['view_assistant'] = $this->db->get_where('product_ingredients', ['product_preparation' => $id]);
        $data['used_assistant'] = $this->db->get_where('product_ingredients_used', ['product' => $id]);
     
       
        theme('view_used_ingredients', $data);
    }
/*===============================================*/
  public function product_used_report() {

        theme('product_used_report');
    }
	
	/*==============*/
	//Used declaration Json listing
	
	 public function ingredients_used_ListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Product_preparation_model->product_used_prepListCount();


        $query = $this->Product_preparation_model->product_used_prepList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_used_ingredients/' . $r->product) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

						
			$get_prod_name = $this->db->get_where('product_preparation', ['id'=>$r->product]);
			foreach($get_prod_name->result() as $p);
			$product_name = $p->product_name;
			
			$get_category_name = $this->db->get_where('smb_category', ['id'=>$r->category]);
			foreach($get_category_name->result() as $c);
			$category = $c->category_name;
             
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$declared_name = $p->first_name.' '.$p->last_name;			 

			
		
		
                $data['data'][] = array(
                    $button,
                   
                  
                    $product_name,
                    $category,   
                    $r->used_ingredeint,
                    $r->used_weight,
                    $r->total_output,
                    $declared_name,
                    date('d-m-Y', $r->created_at)
                  
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Transaction list', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	/*==============*/
	
	//search used Products
	
	
public function usedProducts_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$product = $_POST['product'];
		$used_by = $_POST['used_by'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Product_preparation_model->product_used_prepListCount();
		
		$query = $this->Product_preparation_model->searchproduct_used_prepList($limit, $start ,$product,$used_by,$sf_time,$st_time);
		
		
		echo '<thead>
				<tr class="well">
					       
							<th  width="7%">Action</th>
							<th>product </th>
							<th>category</th>
							<th>used_ingredeint</th>
							<th>used_weight</th>
							<th>total_output</th>
							<th>Used By</th>
							<th>Creation Date</th>	
				</tr>
				</thead>
				<tbody>';
		

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
	if($query ->num_rows() > 0) 
	  {
		  
		foreach($query->result() as $r){
			

			  //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_used_ingredients/' . $r->product) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

               

		
		$get_prod_name = $this->db->get_where('product_preparation', ['id'=>$r->product]);
			foreach($get_prod_name->result() as $p);
			$product_name = $p->product_name;
			
			$get_category_name = $this->db->get_where('smb_category', ['id'=>$r->category]);
			foreach($get_category_name->result() as $c);
			$category = $c->category_name;
             
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$declared_name = $p->first_name.' '.$p->last_name;			 
			
              
                  
				 echo '<tr>';    
                echo '<td>'.$button.'</td>';
                echo '<td>'.$product_name.'</td>';
                echo '<td>'.$category.'</td>';
                echo '<td>'.$r->used_ingredeint.'</td>';
                echo '<td>'.$r->used_weight.'</td>';
                echo '<td>'.$r->total_output.'</td>';
                echo '<td>'.$declared_name.'</td>';
                echo '<td>'.date('d-m-Y', $r->created_at).'</td>';   
                  echo '</tr>';  
				   
		
                    
                
                
            }
			//echo json_encode($data);
		}
			else{
				  echo '<tr><td>No results found</td></tr>';
			}
		echo '</tbody>
			<tfoot>
				<tr class="well">
					
							<th  width="7%">Action</th>
							<th>product </th>
							<th>category</th>
							<th>used_ingredeint</th>
							<th>used_weight</th>
							<th>total_output</th>
							<th>Used By</th>
							<th>Creation Date</th>	
				</tr>
				</tfoot>';	
	}
	
	
/*===============================================*/
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



   

    public function view_product_prep($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['product_prep'] = $this->db->get_where('product_ingredients', ['id' => $id]);
        theme('view_product_prep', $data);
    }
	
	//

	
	
	
	
	
    public function deleteAjax() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'product_ingredients');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} product_ingredients");
        //Now delete permanently
        $this->db->where('id', $id)->delete('product_ingredients');
        return true;
    }

   
	public function test(){
		$created_by = $_GET['u'];
		$product = $_GET['p'];
		$data['test'] = $this->db->get_where('product_ingredients_used', ['created_by'=>$created_by, 'product'=>$product]);
		theme('used_weight',$data);
	}
	
  
  //Accounts starts Here
  


/*============================================*/
//Accounts Report 
 public function accounts_report() {

        theme('accounts_report');
    }
	
/*============================================*/


	//Accounts Json listing
	
	 public function accounts_ListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Product_preparation_model->accounts_ListCount();


        $query = $this->Product_preparation_model->accounts_List();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                
               $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/balancesheet_view/'.$r->id ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

						
			$get_user_id = $this->db->get_where('users', ['id'=>$r->user_id]);
			foreach($get_user_id->result() as $p);
			$user_id = $p->first_name.' '.$p->last_name;

			$get_rolename = $this->db->get_where('role', ['id'=>$r->rolename]);
			foreach($get_rolename->result() as $sc);
			$rolename = $sc->rolename;
			
			$get_pay_type = $this->db->get_where('acct_categories', ['id'=>$r->pay_type]);
			foreach($get_pay_type->result() as $sc);
			$pay_type = $sc->name;
			
			$get_paid_to = $this->db->get_where('users', ['id'=>$r->paid_to]);
			foreach($get_paid_to->result() as $p);
			$paid_to = $p->first_name.' '.$p->last_name;
		
		
                $data['data'][] = array(
					 $button,
					$user_id,
                    $r->email,    
                    $rolename,
                    $r->account_no,
                    $r->debit,
                    $r->credit,
                    $r->amount,
                    $r->points_mode,
                    $r->used,
                    $paid_to,
                    $pay_type,
                    $r->tranx_id,
                    $r->active,
					date('d-m-Y', $r->created_at),
                    $r->tran_count				
                   
                   
                  
                  
                  
                );
            }
        } else {
            $data['data'][] = array(
                'You Have No Accounts List', '', '', '', '','', '', '', '', '','', '', '', '', '',''
            );
        }
        echo json_encode($data);
    }
	
/*================================================*/
// Accounts view button file

 public function balancesheet_view($id) {
 $data['accounts'] =  singleDbTableRow($id, 'accounts');
        theme('balancesheet_view', $data);
    }
	
/*================================================*/
//Accounts Search

public function accounts_search_ListJson(){
		
		//$user_info = $this->session->userdata('logged_user');
		//$user_id = $user_info['user_id'];
	//	$role = singleDbTableRow($user_id)->rolename;
		//$currentUser   = singleDbTableRow($user_id)->role;
		
		$user_id = $_POST['user_id'];
		$rolename = $_POST['rolename'];
		$pay_type = $_POST['pay_type'];
		$points_mode = $_POST['points_mode'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Product_preparation_model->search_accounts_ListCount($user_id,$rolename,$pay_type,$points_mode,$sf_time,$st_time);
		 //$queryCount = $this->Product_preparation_model->accounts_ListCount();

		$query = $this->Product_preparation_model->search_account_List($limit, $start ,$user_id,$rolename,$pay_type,$points_mode,$sf_time,$st_time);
		
		
	
		

		$draw = $this->input->get('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
	if($query ->num_rows() > 0) 
	  {
		  
		foreach($query->result() as $r){
			

			  //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/balancesheet_view/'.$r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

               
			
						
			$get_user_id = $this->db->get_where('users', ['id'=>$r->user_id]);
			foreach($get_user_id->result() as $p);
			$user_id = $p->first_name.' '.$p->last_name;

			$get_rolename = $this->db->get_where('role', ['id'=>$r->rolename]);
			foreach($get_rolename->result() as $sc);
			$rolename = $sc->rolename;
			
			$get_pay_type = $this->db->get_where('acct_categories', ['id'=>$r->pay_type]);
			foreach($get_pay_type->result() as $sc);
			$pay_type = $sc->name;
			
			$get_paid_to = $this->db->get_where('users', ['id'=>$r->paid_to]);
			foreach($get_paid_to->result() as $p);
			$paid_to = $p->first_name.' '.$p->last_name;
              
                  
			   $data['data'][] = array(
					 $button,
					$user_id,
                    $r->email,    
                    $rolename,
                    $r->account_no,
                    $r->debit,
                    $r->credit,
                    $r->amount,
                    $r->points_mode,
                    $r->used,
                    $paid_to,
                    $pay_type,
                    $r->tranx_id,
                    $r->active,
					date('d-m-Y', $r->created_at),
                    $r->tran_count				
                   
                   
				            
                );
            }
        } else {
            $data['data'][] = array(
                'You Have No Accounts List', '', '', '', '','', '', '', '', '','', '', '', '', '',''
            );
        }
        echo json_encode($data);
    }
	




	
	
	
}
	
	/*================================================*/
	
//End
