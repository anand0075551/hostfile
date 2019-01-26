<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_stocks extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Inventory_stocks_model');

        check_auth(); //check is logged in.
    }

    /**
     * Listing all transaction 
     */
    public function add_inventory_stocks() {
		$data['category_name'] = $this->db->get('smb_category');
	$data['product_name'] = $this->db->group_by('product_type')->get('product_preparation');
	$data['product'] = $this->db->get('product_preparation');
	$data['sub_category_name'] = $this->db->get('smb_sub_category');
	$data['title'] = $this->db->get(' smb_product');
	$data['country'] = $this->db->group_by('state')->get('pincode');
		$data['rolename'] = $this->db->get('role');
	$data['first_name'] = $this->db->get('users');
	
	
		if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_product')
                die('Error! sorry');

            //$this->form_validation->set_rules('business_name', 'business Name ', 'required|trim');
            $this->form_validation->set_rules('category', 'category', 'trim|required');
            $this->form_validation->set_rules('sub_category', 'sub_category', 'trim|required');
			
			

            if ($this->form_validation->run() == true) {
                $insert = $this->Inventory_stocks_model->add_inventory_stocks();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Stocks Added Successfully');
                    redirect(base_url('Inventory_stocks/report_inventory_stocks'));
                }
            }
        } 

        theme('add_inventory_stocks', $data);
    }
	
	//view Inventory
	
	   public function view_inventory_stocks($id) {
        //restricted this area, only for admin
        //permittedArea();
        $data['inventory_stock'] = $this->db->get_where('inventory_stocks', ['id' => $id]);
        theme('view_inventory_stocks', $data);
    }
	
	/*============================*/
	
	//List Inventory Stocks
	  public function list_inventory_stocks() {

        theme('list_inventory_stocks');
    }
	
	  public function report_inventory_stocks() {

        theme('report_inventory_stocks');
    }
	
	public function Inventory_stocks_ListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Inventory_stocks_model->Inventory_ListCount();


        $query = $this->Inventory_stocks_model->Inventory_List();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Inventory_stocks/view_inventory_stocks/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

                $button .= '<a class="btn btn-danger deleteBtn" id="' . $r->id . '" data-toggle="tooltip" title="Delete">
						<i class="fa fa-trash"></i> </a>';

				/*$button .= '<a class="btn btn-info editBtn"  href="'.base_url('voucher/edit_voucher/'. $r->id).'" data-toggle="tooltip" title="Edit">
					<i class="fa fa-edit"></i> </a>';*/
			
			$get_category_name = $this->db->get_where('smb_category', ['id'=>$r->category]);
			foreach($get_category_name->result() as $c);
			$category = $c->category_name;
			
			$get_subcategory_name = $this->db->get_where('smb_sub_category', ['id'=>$r->sub_category]);
			foreach($get_subcategory_name->result() as $sc);
			$sub_category = $sc->sub_category_name;
			 //
			 //
			$get_prod_name = $this->db->get_where('smb_product', ['id'=>$r->product]);
			foreach($get_prod_name->result() as $p);
			$product = $p->title;
			
			$get_prod_name = $this->db->get_where('role', ['id'=>$r->supplier_name]);
			foreach($get_prod_name->result() as $p);
			$suplier_name = $p->rolename;
			
			$get_prod_name = $this->db->get_where('users', ['id'=>$r->supplier_id]);
			foreach($get_prod_name->result() as $p);
			$suplier_id = $p->first_name.' '.$p->last_name;
			
			$get_prod_name = $this->db->get_where('users', ['id'=>$r->added_by]);
			foreach($get_prod_name->result() as $p);
			$added_by = $p->first_name.' '.$p->last_name;
		
			
			
                $data['data'][] = array(
                    $button,
                   
                    $r->id,
                    $product,
                    $category,
                    $sub_category,
                    $r->brand,
                    $r->product_unique_code,
                    $r->product_manufacturing_date,
                    $r->exp_date,
                    $r->inward,
                    $r->weight_per_piece,
                    $r->quantity,
                    $r->balance_qty,
                    $r->price_per_unit,
                    $r->tax1_per_unit,
                    $r->tax2_per_unit,
                    $r->tax3_per_unit,
                    $r->shipping1_per_unit,
                    $r->shipping2_per_unit,
                    $r->shipping3_per_unit,
                    $r->sub_total_price,
                    $r->grand_total,
                    $r->area_location_name,
                    $r->pincode,
                    $suplier_name,
                    $suplier_id,
                    $r->supplier_invoice_no,
                    $r->compartment1,
                    $r->compartment2,
                    $r->compartment3,
                    $r->compartment4,
                    $r->compartment5,		
                    $added_by,		
                    date('d-m-Y', $r->created_at)
                  
                   
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Inventory List', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
	//Search Inventory Stocks
	
	public function inventory_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$product = $_POST['product'];
		$category = $_POST['category'];
		$sub_categoty = $_POST['sub_categoty'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Inventory_stocks_model->Inventory_ListCount();
		
		$query = $this->Inventory_stocks_model->search_inventory_list($limit, $start ,$product,$category,$sub_categoty,$sf_time,$st_time);
		
		
		echo '<thead>
				<tr class="well">
					       
							<th width="20%">Action</th>                         
                                <th>id</th>                            
                                <th>item</th>                            
                                <th>category</th>
                                <th>sub_category</th>
                                <th>brand</th>
                                <th>product_unique_code</th>
                                <th>product_manufacturing_date</th>
                                <th>Product_expiry_date</th>
                                <th>inward</th>
                                <th>weight_per_piece</th>
                                <th>quantity</th>
                                <th>balance_qty_in_stock</th>
                                <th>price_per_unit</th>	
                                <th>tax1_per_unit</th>
                                <th>tax2_per_unit</th>
                                <th>tax3_per_unit</th>
                                <th>shipping1_per_unit</th>
                                <th>shipping2_per_unit</th>
                                <th>shipping3_per_unit</th>
                                <th>sub_total_price</th>
                                <th>grand_total</th>
                                <th>area_location_name</th>
                                <th>location_pincode</th>
                                <th>supplier_name</th>
                                <th>supplier_id</th>
                                <th>supplier_invoice_no</th>
                                <th>compartment1</th>
                                <th>compartment2</th>
                                <th>compartment3</th>
                                <th>compartment4</th>
                                <th>compartment5</th>
                                <th>Added By</th>
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
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Inventory_stocks/view_inventory_stocks/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

               

		
		$get_category_name = $this->db->get_where('smb_category', ['id'=>$r->category]);
			foreach($get_category_name->result() as $c);
			$category = $c->category_name;
			
			$get_subcategory_name = $this->db->get_where('smb_sub_category', ['id'=>$r->sub_category]);
			foreach($get_subcategory_name->result() as $sc);
			$sub_category = $sc->sub_category_name;
			 //
			 //
			$get_prod_name = $this->db->get_where('smb_product', ['id'=>$r->product]);
			foreach($get_prod_name->result() as $p);
			$product = $p->title;
			
			$get_prod_name = $this->db->get_where('role', ['id'=>$r->supplier_name]);
			foreach($get_prod_name->result() as $p);
			$suplier_name = $p->rolename;
			
			$get_prod_name = $this->db->get_where('users', ['id'=>$r->supplier_id]);
			foreach($get_prod_name->result() as $p);
			$suplier_id = $p->first_name.' '.$p->last_name;
			
            $get_prod_name = $this->db->get_where('users', ['id'=>$r->added_by]);
			foreach($get_prod_name->result() as $p);
			$added_by = $p->first_name.' '.$p->last_name;  
			  
			  
                  
				echo '<tr>';    
                echo '<td>'.$button.'</td>';
				echo '<td>'.$r->id.'</td>';
                echo '<td>'.$product.'</td>';
                echo '<td>'.$category.'</td>';
				echo '<td>'.$sub_category.'</td>';
                echo '<td>'.$r->brand.'</td>';
                echo '<td>'.$r->product_unique_code.'</td>';
                echo '<td>'.$r->product_manufacturing_date.'</td>';
                echo '<td>'.$r->exp_date.'</td>';
                echo '<td>'.$r->inward.'</td>';
                echo '<td>'.$r->weight_per_piece.'</td>';
                echo '<td>'.$r->quantity.'</td>';
                echo '<td>'.$r->balance_qty.'</td>';
                echo '<td>'.$r->price_per_unit.'</td>';
                echo '<td>'.$r->tax1_per_unit.'</td>';
                echo '<td>'.$r->tax2_per_unit.'</td>';
                echo '<td>'.$r->tax3_per_unit.'</td>';
                echo '<td>'.$r->shipping1_per_unit.'</td>';
                echo '<td>'.$r->shipping2_per_unit.'</td>';
                echo '<td>'.$r->shipping3_per_unit.'</td>';
                echo '<td>'.$r->sub_total_price.'</td>';
                echo '<td>'.$r->grand_total.'</td>';
                echo '<td>'.$r->area_location_name.'</td>';
                echo '<td>'.$r->pincode.'</td>';				
                echo '<td>'.$suplier_name.'</td>';
                echo '<td>'.$suplier_id.'</td>';
                echo '<td>'.$r->supplier_invoice_no.'</td>';				
                echo '<td>'.$r->compartment1.'</td>';
                echo '<td>'.$r->compartment2.'</td>';
                echo '<td>'.$r->compartment3.'</td>';
                echo '<td>'.$r->compartment4.'</td>';
                echo '<td>'.$r->compartment5.'</td>';
				 echo '<td>'.$added_by.'</td>';
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
							<th width="20%">Action</th>                         
                                <th>id</th>                            
                                <th>item</th>                            
                                <th>category</th>
                                <th>sub_category</th>
                                <th>brand</th>
                                <th>product_unique_code</th>
                                <th>product_manufacturing_date</th>
                                <th>Product_expiry_date</th>
                                <th>inward</th>
                                <th>weight_per_piece</th>
                                <th>quantity</th>
                                <th>balance_qty_in_stock</th>
                                <th>price_per_unit</th>	
                                <th>tax1_per_unit</th>
                                <th>tax2_per_unit</th>
                                <th>tax3_per_unit</th>
                                <th>shipping1_per_unit</th>
                                <th>shipping2_per_unit</th>
                                <th>shipping3_per_unit</th>
                                <th>sub_total_price</th>
                                <th>grand_total</th>
                                <th>area_location_name</th>
                                <th>location_pincode</th>
                                <th>supplier_name</th>
                                <th>supplier_id</th>
                                <th>supplier_invoice_no</th>
                                <th>compartment1</th>
                                <th>compartment2</th>
                                <th>compartment3</th>
                                <th>compartment4</th>
                                <th>compartment5</th>
								 <th>Added By</th>
                                <th>Creation Date</th>
                               
				</tr>
				</tfoot>';	
	}
	
	
	//==================================*/
	
	//Edit inventery stocks
	
	public function edit_inventory_stocks($id){
		//restricted this area, only for admin
		permittedArea();
	$data['category_name'] = $this->db->get('smb_category');
	$data['product_name'] = $this->db->group_by('product_type')->get('product_preparation');
	$data['product'] = $this->db->get('product_preparation');
	$data['sub_category_name'] = $this->db->get('smb_sub_category');
	$data['title'] = $this->db->get('smb_product');
	$data['country'] = $this->db->group_by('state')->get('pincode');
		$data['rolename'] = $this->db->get('role');
	$data['first_name'] = $this->db->get('users');
	
	$data['inventory_stocks'] = singleDbTableRow($id,'inventory_stocks');

		if($this->input->post())
		{
			if($this->input->post('submit') != 'edit_inventory') die('Error! sorry');

		  $this->form_validation->set_rules('category', 'category', 'trim|required');
            $this->form_validation->set_rules('sub_category', 'sub_category', 'trim|required');

			if($this->form_validation->run() == true)
			{
				$insert = $this->Inventory_stocks_model->edit_inventory_stocks($id);
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'InVentory Updated Successfully...!!!');
					redirect(base_url('Inventory_stocks/report_inventory_stocks'));
				}
			}
		}

		theme('edit_inventory_stocks', $data);
	}
	
	/*======================================================================*/
	
	
	
	
	
	
	
	
	
	
	 public function get_district()
     {
         $state=$_POST['state'];
        
         $query = $this->Inventory_stocks_model->district($state);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->district."'>".$r->district."</option>";
         }

     }
	 
	      public function get_location_id()
     {
         $district=$_POST['district'];
        
         $query = $this->Inventory_stocks_model->location($district);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->location."'>".$r->location."--".$r->pincode."</option>";
         }

     }
	 

	  
	 
	  public function get_pincode()
     {
         $location=$_POST['location'];
        
         $query = $this->Inventory_stocks_model->pincode($location);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->pincode."'>".$r->pincode."</option>";
         }

     }
	 //get user on change role
	 
	    public function get_user1()
     {
         $to_role=$_POST['to_role'];
         //echo $to_role;
         $query = $this->Inventory_stocks_model->get_user1($to_role);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->id."'>".$r->first_name."</option>";
         } 

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
	 
	 /*================*/
	 //get_area_pincode
	 

      public function get_area_pincode()
     {
         $location=$_POST['location'];
      //  echo $location;
        $query = $this->Inventory_stocks_model->get_area_pincode($location);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r);

         {
              echo "<option value='".$r->location."'>".$r->pincode."</option>";
         }

     }
	 
	 /*================*/
	
	 
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



   

   
	//

	
	
	
	
	
    public function deleteAjax() {
        $id = $this->input->post('id');
        //get deleted user info
        $userInfo = singleDbTableRow($id, 'inventory_stocks');
        $categoryName = $userInfo->name;
        // add a activity
        create_activity("Deleted {$categoryName} inventory_stocks");
        //Now delete permanently
        $this->db->where('id', $id)->delete('inventory_stocks');
        return true;
    }

   
	
  
  
	




	
	
	
}
	
	/*================================================*/
	
//End
