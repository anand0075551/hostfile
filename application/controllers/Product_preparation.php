<?php defined('BASEPATH') OR exit('No direct script access allowed');


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
	
	
	  public function product_prep_dashboard() {
		  
		//  $data['assets']  = $this->Product_preparation_model->total_packs();

        theme('product_prep_dashboard');
    }
	
	  public function dashboard_inventory() {
		  
		 

        theme('dashboard_inventory');
    }
	 public function list_product_ingredients() 
	 {
		 $data['product_name'] = $this->db->group_by('product_preparation')->get('product_ingredients');

        theme('list_product_ingredients',$data);
    }
   
    public function add_product_ingredients() {
        //restricted this area, only for admin
        
        
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
       
        $data['view_assistant'] = $this->db->get_where('product_ingredients', ['product_preparation' => $id]);
     
       
        theme('view_declared_ingredients', $data);
    }
	/*==================================*/
	
	    public function add_product() {
        //restricted this area, only for admin
     
        
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
	
	// add product Assign
	
	
	public function add_product_assign() {
        $data['product_assign'] = $this->db->group_by('created_by')->get('product_ingredients');
      $data['rolename'] = $this->db->order_by('id','desc')->get('role');
        
	if ($this->input->post()) {
            if ($this->input->post('submit') != 'add_product_assign')
                die('Error! sorry');

            $this->form_validation->set_rules('declared_by', 'Declared By', 'trim|required');
            $this->form_validation->set_rules('product_id', 'product_id', 'trim|required');
            $this->form_validation->set_rules('assigned_role', 'assigned_role', 'trim|required');
            $this->form_validation->set_rules('assigned_to_name', 'assigned_to_name', 'trim|required');
            $this->form_validation->set_rules('store_id', 'store_id', 'trim|required');
           
		
            
            if ($this->form_validation->run() == true) {
                $insert = $this->Product_preparation_model->add_product_assign();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Products Assigned  Successfully');
                    redirect(base_url('Product_preparation/list_assigned_products'));
                }
            }
        }

        theme('product_assign',$data);
    }
	 
	// Packing Assign
	
	public function add_product_packing_assign() {
        $data['product_assign'] = $this->db->group_by('created_by')->get('product_ingredients');
      $data['rolename'] = $this->db->order_by('id','desc')->get('role');
        
	if ($this->input->post()) {
            if ($this->input->post('submit') != 'assign_packing')
                die('Error! sorry');

            $this->form_validation->set_rules('prepaired_by', 'Prepaired By', 'trim|required');
            $this->form_validation->set_rules('product_id', 'product_id', 'trim|required');
            $this->form_validation->set_rules('assigned_role', 'assigned_role', 'trim|required');
            $this->form_validation->set_rules('assigned_to_name', 'assigned_to_name', 'trim|required');
           
           
		
            
            if ($this->form_validation->run() == true) {
                $insert = $this->Product_preparation_model->add_product_packing_assign();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Products Assigned  Successfully');
                    redirect(base_url('Product_preparation/list_assigned_packs'));
                }
            }
        }

        theme('assign_packing',$data);
    }
	// report assigned Packing
	
		public function list_assigned_packs()
	{
		
		 theme('list_assigned_packs');
	}
	
	  public function assigned_packingListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Product_preparation_model->assigned_packListCount();


        $query = $this->Product_preparation_model->assigned_packList();

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_assigned_packs/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

						
		    $get_product_name = $this->db->get_where('product_preparation', ['id'=>$r->product_id]);
			foreach($get_product_name->result() as $p);
			$product_name = $p->product_name;	
			//
			$get_assigned_to = $this->db->get_where('users', ['id'=>$r->assigned_to_name]);
			foreach($get_assigned_to->result() as $p);
			$assigned_to = $p->first_name.' '.$p->last_name;	
			//
			  $get_assigned_role = $this->db->get_where('role', ['id'=>$r->assigned_role]);
			foreach($get_assigned_role->result() as $p);
			$assigned_role_name = $p->rolename;	
			
			//
			 $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$created_by = $p->first_name.' '.$p->last_name;	
			
			//
               
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->prepaired_by]);
			foreach($get_declared_name->result() as $p);
			$declared_by = $p->first_name.' '.$p->last_name;	

			//
          		
             
			
			 
			 
		
           				
			 
           		 
		
		  
			
                $data['data'][] = array(
                    $button,
                    $r->id,
                    $declared_by,
                    $assigned_role_name,
                    $assigned_to,
                    $r->unique_prep,
                    $product_name,                   
                    date('d/m/Y h:i A', $r->created_at),
					$created_by
                    
                );
            }
        } else {
            $data['data'][] = array(
                'You Have Not Assigned Packs', '', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
	
	//search assigned Packing
	public function assigned_packing_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$product = $_POST['product'];
		$declared_by = $_POST['declared_by'];
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Product_preparation_model->assigned_packListCount();
		
		$query = $this->Product_preparation_model->assigned_packing_list($limit, $start ,$product,$declared_by);
		
		
		echo '<thead>
				<tr class="well">
					       
							<th  width="7%">Action</th>
							<th>Id</th>
							<th>Prepaired By</th>
							<th>Assigned Role</th>
							<th>Assigned To</th>
							<th>Unique Preparation</th>
							<th>Product</th>
							<th>Created By</th>
							<th>Created At</th>
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
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_assigned_packs/' . $r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

               
   $get_product_name = $this->db->get_where('product_preparation', ['id'=>$r->product_id]);
			foreach($get_product_name->result() as $p);
			$product_name = $p->product_name;	
			//
			$get_assigned_to = $this->db->get_where('users', ['id'=>$r->assigned_to_name]);
			foreach($get_assigned_to->result() as $p);
			$assigned_to = $p->first_name.' '.$p->last_name;	
			//
			  $get_assigned_role = $this->db->get_where('role', ['id'=>$r->assigned_role]);
			foreach($get_assigned_role->result() as $p);
			$assigned_role_name = $p->rolename;	
			
			//
			 $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$created_by = $p->first_name.' '.$p->last_name;	
			
			//
               
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->prepaired_by]);
			foreach($get_declared_name->result() as $p);
			$declared_by = $p->first_name.' '.$p->last_name;	

			//
          		
		
	 
			
              
                  
				 echo '<tr>';    
                echo '<td>'.$button.'</td>';
                echo '<td>'.$r->id.'</td>';
                echo '<td>'.$declared_by.'</td>';
                echo '<td>'.$assigned_role_name.'</td>';
                echo '<td>'.$assigned_to.'</td>';
                echo '<td>'.$r->unique_prep.'</td>';
                echo '<td>'.$product_name.'</td>';
                echo '<td>'.date('d/m/Y h:i A', $r->created_at).'</td>';
                echo '<td>'.$created_by.'</td>';
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
							<th>Id</th>
							<th>Prepaired By</th>
							<th>Assigned Role</th>
							<th>Assigned To</th>
							<th>Unique Preparation</th>
							<th>Product</th>
							<th>Created By</th>
							<th>Created At</th>   
				</tr>
				</tfoot>';	
	}
	
	// Assigned Products Search
	
	public function assigned_product_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$product = $_POST['product'];
		$declared_by = $_POST['declared_by'];
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Product_preparation_model->product_assignedListCount();
		
		$query = $this->Product_preparation_model->assigned_product_list($limit, $start ,$product,$declared_by);
		
		
		echo '<thead>
				<tr class="well">
					       
							<th  width="7%">Action</th>
							<th>id </th>
							<th>Declared By</th>
							<th>Assigned Role</th>
							<th>Assigned To Name</th>	
							<th>Status</th>	
							<th>Store Id</th>	
							<th>Product Id</th>	
							<th>Created At</th>	
							<th>Created By</th>	
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
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_assigned_products/' . $r->id ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

                $get_declared_name = $this->db->get_where('users', ['id'=>$r->declared_by]);
			foreach($get_declared_name->result() as $p);
			$declared_by = $p->first_name.' '.$p->last_name;	

            $get_assigned_role = $this->db->get_where('role', ['id'=>$r->assigned_role]);
			foreach($get_assigned_role->result() as $p);
			$assigned_role_name = $p->rolename;			
             
			$get_assigned_to = $this->db->get_where('users', ['id'=>$r->assigned_to_name]);
			foreach($get_assigned_to->result() as $p);
			$assigned_to = $p->first_name.' '.$p->last_name;	
			 
			 
			 $get_store_id = $this->db->get_where('inventory_store_id', ['id'=>$r->store_id]);
			foreach($get_store_id->result() as $p);
			$store_name = $p->store_name;	

            $get_product_name = $this->db->get_where('product_preparation', ['id'=>$r->product_id]);
			foreach($get_product_name->result() as $p);
			$product_name = $p->product_name;					
			 
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$created_by = $p->first_name.' '.$p->last_name;			 

			$get_status = $this->db->get_where('product_ingredients_used', ['product'=>$r->product_id, 'created_by'=>$r->assigned_to_name]);
			
			 if($get_status->num_rows() > 0)
			 {
				$Status = 'Prepared'; 
				  
			 }
			 else{
					
					$Status ='Not Prepaired';
				}
			
              
                  
				echo '<tr>';    
                echo '<td>'.$button.'</td>';
                echo '<td>'.$r->id.'</td>';
                echo '<td>'.$declared_by.'</td>';
                echo '<td>'.$assigned_role_name.'</td>';
                echo '<td>'.$assigned_to.'</td>';
                echo '<td>'.$Status.'</td>';
                echo '<td>'.$store_name.'</td>';
                echo '<td>'.$product_name.'</td>';
                echo '<td>'.date('d/m/Y h:i A', $r->created_at).'</td>';
                echo '<td>'.$created_by.'</td>';
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
							<th>id </th>
							<th>Declared By</th>
							<th>Assigned Role</th>
							<th>Assigned To Name</th>	
							<th>Status</th>	
							<th>Store Id</th>	
							<th>Product Id</th>	
							<th>Created At</th>	
							<th>Created By</th>	
				</tr>
				</tfoot>';	
	}
	
	
	// Report Product assigned_role
	
	
	public function list_assigned_products()
	{
		
		 theme('list_assigned_products');
	}
	
	
	 public function product_assigned_ListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Product_preparation_model->product_assignedListCount();


        $query = $this->Product_preparation_model->product_assignedList($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_assigned_products/' . $r->id ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

		   $get_declared_name = $this->db->get_where('users', ['id'=>$r->declared_by]);
			foreach($get_declared_name->result() as $p);
			$declared_by = $p->first_name.' '.$p->last_name;	

            $get_assigned_role = $this->db->get_where('role', ['id'=>$r->assigned_role]);
			foreach($get_assigned_role->result() as $p);
			$assigned_role_name = $p->rolename;			
             
			$get_assigned_to = $this->db->get_where('users', ['id'=>$r->assigned_to_name]);
			foreach($get_assigned_to->result() as $p);
			$assigned_to = $p->first_name.' '.$p->last_name;	
			 
			 
			 $get_store_id = $this->db->get_where('inventory_store_id', ['id'=>$r->store_id]);
			foreach($get_store_id->result() as $p);
			$store_name = $p->store_name;	

            $get_product_name = $this->db->get_where('product_preparation', ['id'=>$r->product_id]);
			foreach($get_product_name->result() as $p);
			$product_name = $p->product_name;					
			 
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$created_by = $p->first_name.' '.$p->last_name;			 

			//
			$get_status = $this->db->get_where('product_ingredients_used', ['product'=>$r->product_id, 'created_by'=>$r->assigned_to_name]);
			
			 if($get_status->num_rows() > 0)
			 {
				$Status = 'Prepared'; 
				  
			 }
			 else{
					
					$Status ='Not Prepared';
				}
       //       
		
		
                $data['data'][] = array(
                    $button,             
                    $r->id,
                    $declared_by,
                    $assigned_role_name,
                    $assigned_to,
                    $Status ,
                    $store_name,
                    $product_name,
                    date('d/m/Y h:i A', $r->created_at),
                    $created_by
                  
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Assigned List', '', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	/*==============*/
	
	// 07-06-2013
	  public function get_user1()
     {
         $to_role=$_POST['to_role'];
         //echo $to_role;
         $query = $this->Product_preparation_model->get_user1($to_role);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->id."'>".$r->first_name.' '.$r->last_name."</option>";
         } 

     }
	//
	
	  public function assistant_view_products() {
        //restricted this area, only for admin
		 $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$data['category_name'] = $this->db->get('smb_category');
	$data['type'] = $this->db->order_by('product_id','desc')->group_by('product_id')->get_where('product_assign',['assigned_to_name' => $user_id ]);
	//$data['product'] = $this->db->get('product_preparation');
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
       
        $data['view_assistant'] = $this->db->get_where('product_ingredients', ['product_preparation' => $id]);
     
       
        theme('report_product_prepration', $data);
    }
	
	// pack products starts here
	
	    public function product_packaging() 
		{		//restricted this area, only for admin
				
				
				$data['product_name'] = $this->db->group_by('created_by')->get('product_ingredients_used');
				
				
			if ($this->input->post()) {
					if ($this->input->post('submit') == 'add_packing')
			{

				//$this->form_validation->set_rules('prepaired_by', 'Assistant Name', 'trim|required');
				$this->form_validation->set_rules('product_prep', 'Product', 'trim|required');
			   
			
				if ($this->form_validation->run() == true) {
			   
					$insert = $this->Product_preparation_model->product_packaging();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Packing Saved Successfully');
						redirect(base_url('Product_preparation/view_product_packing1'));
					}
				}
			} 
			
				/*elseif ($this->input->post('submit') == 'pack_now')
				{
					
					$this->form_validation->set_rules('prepaired_by', 'Assistant Name', 'trim|required');
					$this->form_validation->set_rules('product_prep', 'Product', 'trim|required');
				   
				
					if ($this->form_validation->run() == true) 
					{
					   
					$data['pack_now'] = $this->Product_preparation_model->pack_now();
						
						theme('product_packaging', $data);
					}
				
					}*/

				
			}
			theme('product_packaging', $data);
		}
	
	
		/*==================================*/
		
	 public function view_product_packing($id) {
        //restricted this area, only for admin
       
        $data['view_packing'] = $this->db->get_where('product_packing',['id'=>$id]);
     
       
        theme('view_product_packing', $data);
    }
	/*==================================*/
	 public function view_product_packing1() {
        //restricted this area, only for admin
       
        $data['view_packing'] = $this->db->get_where('product_packing');
     
       
        theme('view_product_pack', $data);
    }
	// report Product Packing
	
	public function report_product_packing() {

        theme('report_product_packing');
    }
	
	
	

	/*==================================*/
		 public function packing_ListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Product_preparation_model->packing_ListCount();


        $query = $this->Product_preparation_model->packing_List($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                
               $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_product_packing/'.$r->id) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

						
			$get_product = $this->db->get_where('product_preparation', ['id'=>$r->product]);
			foreach($get_product->result() as $p);
			$product = $p->product_name;

			$get_prepaired_by = $this->db->get_where('users', ['id'=>$r->prepaired_by]);
			foreach($get_prepaired_by->result() as $sc);
			$prepaired_by = $sc->first_name.' '.$sc->last_name;
			
			
			$get_packed_by = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_packed_by->result() as $p);
			$packed_by = $p->first_name.' '.$p->last_name;
		
		//
			$get_product = $this->db->get_where('product_preparation', ['id'=>$r->product]);
			foreach($get_product->result() as $p)
			{
			$created_by = $p->created_by;
			$get_declared_name = $this->db->get_where('users', ['id'=>$created_by]);
			
			foreach($get_declared_name->result() as $p)
			
				$declared_name = $p->first_name.' '.$p->last_name;
			}
			
       //       			
			$get_package_name = $this->db->get_where('pro_weight_category', ['id'=>$r->package_name_small]);
			foreach($get_package_name->result() as $p);
			$pack_type = $p->pack_type;
			
			$get_pack_category = $this->db->get_where('pro_weight_category', ['id'=>$r->package_name_small]);
			foreach($get_pack_category->result() as $p);
			$packing_category = $p->packing_category;
		
                $data['data'][] = array(
					$button,
					$product,    
					$r->unique_preparation,   
                    $declared_name,					
                    $prepaired_by,
					$packed_by,
                    $r->status,
                    $r->total_weight,
					$packing_category,
                    $pack_type,
					$r->no_ofpiece_small,
                    $r->balance_weight,
                    $r->packed_weight,
                    $r->unique_small,
                   
					
					date('d/m/Y h:i A', $r->created_at)
               
                   
                  
                  
                  
                );
            }
        } else {
            $data['data'][] = array(
                 'You Have No Packing List', '', '', '', '','', '', '', '', '','', '','','','','','','','',''
            );
        }
        echo json_encode($data);
    }
	
	/*==================================*/
	public function get_total_list()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		
	
		
		$query = $this->Product_preparation_model->get_total_list();
		if($query -> num_rows() > 0) 
	  {
		  $pieces_small  = 0;
		  $pieces_medium = 0;
		  $pieces_large  = 0;
		  $pieces_family = 0;
		  $pieces_combo  = 0;
		
		 foreach($query->result() as $r)
		{
			$pieces_small    = $pieces_small + $r->no_ofpiece_small;
			$pieces_medium   = $pieces_medium + $r->no_ofpiece_medium;
			$pieces_large    = $pieces_large + $r->no_ofpiece_large;
			$pieces_family   = $pieces_family + $r->no_ofpiece_family;
			$pieces_combo    = $pieces_combo + $r->no_ofpiece_combo;
			
		}
	  }
	  else
	  {
		  $pieces_small = 0;
		  $pieces_medium = 0;
		  $pieces_large  = 0;
		  $pieces_family = 0;
		  $pieces_combo  = 0;
		
	  }
	  echo "<table  class='table table-striped'>
				<tr>
				<th>Total Pieces Packed Small:</th>
				<td> ".$pieces_small."</th></td>
				</tr>
				<tr>
				<th>Total Pieces Packed Medium:</th>  
				<td>".$pieces_medium."</td>
				</tr>
				<tr>
				<th>Total Pieces Packed Large:</th> 
				<td> ".$pieces_large."</td>
				</tr>
				<tr>
				<th>Total Pieces Packed Family: </th> 
				<td>".$pieces_family."</td>
				</tr>
				<tr>
				<th>Total Pieces Packed Combo: </th> 
				<td>".$pieces_combo."</td>
				</tr>
				</table>";
	}
	/*==================================*/
	//Packing  Search

public function packing_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
	$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$limit = $this->input->post('length');
        $start = $this->input->post('start');
		
		$product_name = $_POST['product_name'];
		$prepaired_by = $_POST['prepaired_by'];
		$packed_by = $_POST['packed_by'];
		$status = $_POST['status'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		
		


		$queryCount = $this->Product_preparation_model->search_packing_ListCount($limit, $start ,$product_name,$prepaired_by,$packed_by,$status,$sf_time,$st_time);
		 //$queryCount = $this->Product_preparation_model->accounts_ListCount();

		$query = $this->Product_preparation_model->search_packing_List($limit, $start ,$product_name,$prepaired_by,$packed_by,$status,$sf_time,$st_time);
		
		
	
		

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
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_product_packing/'.$r->id ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

						
			$get_product = $this->db->get_where('product_preparation', ['id'=>$r->product]);
			foreach($get_product->result() as $p);
			$product = $p->product_name;

			$get_prepaired_by = $this->db->get_where('users', ['id'=>$r->prepaired_by]);
			foreach($get_prepaired_by->result() as $sc);
			$prepaired_by = $sc->first_name.' '.$sc->last_name;
			
			
			$get_packed_by = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_packed_by->result() as $p);
			$packed_by = $p->first_name.' '.$p->last_name;
			
			//
			$get_product = $this->db->get_where('product_preparation', ['id'=>$r->product]);
			foreach($get_product->result() as $p)
			{
			$created_by = $p->created_by;
			$get_declared_name = $this->db->get_where('users', ['id'=>$created_by]);
			
			foreach($get_declared_name->result() as $p)
			
				$declared_name = $p->first_name.' '.$p->last_name;
			}
			
            $get_package_name = $this->db->get_where('pro_weight_category', ['id'=>$r->package_name_small]);
			foreach($get_package_name->result() as $p);
			$pack_type = $p->pack_type;
			
			
			$get_pack_category = $this->db->get_where('pro_weight_category', ['id'=>$r->package_name_small]);
			foreach($get_pack_category->result() as $p);
			$packing_category = $p->packing_category;
		
                $data['data'][] = array(
					$button,
					$product,    
					$r->unique_preparation,   
                    $declared_name,					
                    $prepaired_by,
					$packed_by,
                    $r->status,
                    $r->total_weight,
					$packing_category,
                    $pack_type,
					$r->no_ofpiece_small,
                    $r->balance_weight,
                    $r->packed_weight,
                    $r->unique_small,
                   
					
					date('d/m/Y h:i A', $r->created_at)
               
                   
                   
				            
                );
            }
        } else {
            $data['data'][] = array(
                'You Have No Packing List', '', '', '', '','', '', '', '', '','', '','','','','','','','',''
            );
        }
        echo json_encode($data);
    }
	
	/*==================================*/
	
	// Get total for search
	
	public function get_total()
	{
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$product_name = $_POST['product_name'];
		$prepaired_by = $_POST['prepaired_by'];
		$packed_by = $_POST['packed_by'];
		$status = $_POST['status'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
	
		
		$query = $this->Product_preparation_model->get_total($product_name,$prepaired_by,$packed_by,$status,$sf_time,$st_time);
		if($query -> num_rows() > 0) 
	  {
		  $pieces_small  = 0;
		  $pieces_medium = 0;
		  $pieces_large  = 0;
		  $pieces_family = 0;
		  $pieces_combo  = 0;
		
		 foreach($query->result() as $r)
		{
			$pieces_small    = $pieces_small + $r->no_ofpiece_small;
			$pieces_medium   = $pieces_medium + $r->no_ofpiece_medium;
			$pieces_large    = $pieces_large + $r->no_ofpiece_large;
			$pieces_family   = $pieces_family + $r->no_ofpiece_family;
			$pieces_combo    = $pieces_combo + $r->no_ofpiece_combo;
			
		}
	  }
	  else
	  {
		  $pieces_small  = 0;
		  $pieces_medium = 0;
		  $pieces_large  = 0;
		  $pieces_family = 0;
		  $pieces_combo  = 0;
		
	  }
	 echo "<table  class='table table-striped'>
				<tr>
				<th>Total Pieces Packed Small:</th>
				<td> ".$pieces_small."</th></td>
				</tr>
				<tr>
				<th>Total Pieces Packed Medium:</th>  
				<td>".$pieces_medium."</td>
				</tr>
				<tr>
				<th>Total Pieces Packed Large:</th> 
				<td> ".$pieces_large."</td>
				</tr>
				<tr>
				<th>Total Pieces Packed Family: </th> 
				<td>".$pieces_family."</td>
				</tr>
				<tr>
				<th>Total Pieces Packed Combo: </th> 
				<td>".$pieces_combo."</td>
				</tr>
				</table>";
	}
	/*==================================*/
	
	
	

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
	
	 
	   public function get_product()
     {
         $pro=$_POST['product'];
       // echo $pro;
       $query = $this->Product_preparation_model->get_product($pro);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
            //echo "<option value='".$r->product."'>".$r->product."</option>";
			$product_name = $r->product;
			$get_declared_name = $this->db->get_where('product_preparation', ['id'=>$product_name]);
			
			foreach($get_declared_name->result() as $p);
			
				$declared_name = $p->product_name;
			
			echo "<option value='".$product_name."'>".$declared_name."</option>";
		}
         } 
		 
		 
		 //
		    public function get_unique()
     {
         $pro=$_POST['product'];
       //echo $pro;
       $query = $this->Product_preparation_model->get_unique($pro);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
            //echo "<option value='".$r->product."'>".$r->product."</option>";
			$product_name = $r->unique_preparation;
			$prepaired_by = $r->created_by;
			$created_at = $r->created_at;
			
			
			$get_declared_name = $this->db->get_where('users', ['id'=>$prepaired_by,]);
			
			foreach($get_declared_name->result() as $p);
			
				$declared_name = $p->first_name;
				$declared_last_name = $p->last_name;
				
			
			echo "<option value='".$product_name."'>".$declared_name.' '.$declared_last_name.' '.date('d/m/Y h:i A', $r->created_at)."</option>";
			
			
			
			
			//echo "<option value='".$r->unique_preparation."'>".$product_name.'-'.$prepaired_by.'-'.$r->product."</option>";
		}
         } 
		 //
		 // get unique pack
		 
		 	    public function get_unique_pack()
     {
         $pro=$_POST['product'];
       //echo $pro;
       $query = $this->Product_preparation_model->get_unique_pack($pro);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
            //echo "<option value='".$r->product."'>".$r->product."</option>";
			$product_name = $r->product;
			$unique_prep = $r->unique_preparation;
			$packed_by  = $r->created_by;
			$created_at = $r->created_at;
			$pieces_small = $r->no_ofpiece_small .'  pieces';
			$unique_small = $r->unique_small;
			$package_name = $r->package_name_small;
			$weight_small = $r->weight_small . ' Kg';
			
			//$get_declared_name = $this->db->get_where('users', ['id'=>$prepaired_by,]);
			
		/*	foreach($get_declared_name->result() as $p);
			
				$declared_name = $p->first_name;
				$declared_last_name = $p->last_name;*/
				
			
			echo "<option value='".$unique_small."'>".$unique_small.'-'.$package_name.' - '.$pieces_small.'-'.$weight_small."</option>";
			
			
			
			
			//echo "<option value='".$r->unique_preparation."'>".$product_name.'-'.$prepaired_by.'-'.$r->product."</option>";
		}
         }
		 
		 //for packing screen
		 
		 	    public function get_unique1()
     {
         $pro=$_POST['unique_prep'];
         //$unique_prep=$_POST['unique_prep'];
      // echo $pro;
       $query = $this->Product_preparation_model->get_unique1($pro);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
            //echo "<option value='".$r->product."'>".$r->product."</option>";
			$product_name = $r->unique_prep;
			$prepaired_by = $r->prepaired_by;
			$created_at = $r->created_at;
			
			
			$get_declared_name = $this->db->get_where('users', ['id'=>$prepaired_by,]);
			
			foreach($get_declared_name->result() as $p);
			
				$declared_name = $p->first_name;
				$declared_last_name = $p->last_name;
				
				//
				$get_created_at = $this->db->get_where('product_ingredients_used', ['unique_preparation'=>$product_name,]);
				foreach($get_created_at->result() as $t);
				//
			
			echo "<option value='".$product_name."'>".$product_name.'-'.$declared_name.' '.$declared_last_name.' '.date('d/m/Y h:i A', $t->created_at)."</option>";
			
			
			
			
			//echo "<option value='".$r->unique_preparation."'>".$product_name.'-'.$prepaired_by.'-'.$r->product."</option>";
		}
         } 
		 
		 
		 
		 //
		 
		 
		 
     
	 
        public function get_status()
     {

         $product_id=$_POST['product_id'];
         $Unique=$_POST['Unique'];
         //echo $product_id;
         $query = $this->Product_preparation_model->get_status($product_id,$Unique);
        if($query)
		{
			foreach($query->result() as $r)
         {
			 $status =$r->status;
		 }
		}else{
			$status ='Not Packed';
		}
echo $status;
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
	 
	 // for head chef
	 
	    public function get_product_prepration_hchef()
     {
         $category=$_POST['id'];
         //echo $category;
         $query = $this->Product_preparation_model->get_product_prepration_hchef($category);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
             echo "<option value='".$r->id."'>".$r->product_name."</option>";
         } 

     }
	 
	 //
	 
	 
	   public function get_product_prepration()
     {
         $category=$_POST['id'];
         //echo $category;
         $query = $this->Product_preparation_model->get_product_prepration($category);
         echo "<option value=''>-Select-</option>";
		 if($query->num_rows() > 0){
         foreach($query->result() as $r)
         {
			 $product_id= $r->product_id;
			 $get_product_name= $this->db->get_where('product_preparation',['id'=> $product_id]);
			 
			 foreach ( $get_product_name->result() as $name)
			 
			 $product_name= $name->product_name;
			  
             echo "<option value='".$product_id."'>".$product_name."</option>";
         } 
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
		//$used_ingredeint=$_POST['used_ingredeint'];
		$product=$_POST['product'];
		$category=$_POST['category'];
		$prod_id=$_POST['prod_id'];
		$sub_category=$_POST['sub_category'];
		$total_output=$_POST['total_output'];
		$exp_date=$_POST['exp_date'];
		$store_id_assigned=$_POST['store_id_assigned'];
		
		
		
		
	
		 $insert = $this->Product_preparation_model->add_used_ingredients($used_weight,$prod_id,$sub_category,$product,$category,$total_output,$exp_date,$store_id_assigned);
		  
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

	
	 public function list_prepaired_food() {

        theme('list_prepaired_food');
    }
	
	/*===============================================================*/
	 public function view_used($id) {
        //restricted this area, only for admin
      
       // $data['view_assistant'] = $this->db->get_where('product_ingredients', ['product_preparation' => $id]);
        $data['used_assistant'] = $this->db->get_where('product_ingredients_used', ['product' => $id]);
     
       
        theme('view_used_ingredients', $data);
    }
	/*===============================================================*/
	  public function get_total_output()
     {
         $product1=$_POST['product'];
        // echo $product1;
       $query = $this->Product_preparation_model->get_total_output($product1);
        
         foreach($query->result() as $r);
         
             echo $r->total_output; 
         

     }
	 
	  public function get_prep_by()
     {
         $product1=$_POST['product'];
        // echo $product1;
       $query = $this->Product_preparation_model->get_prep_by($product1);
        
         foreach($query->result() as $r);
         
             echo $r->created_by; 
         

     }
	 
	 
	   public function get_balance()
     {
         $product1=$_POST['product'];
         $unique=$_POST['Unique'];
        // echo $product1;
       $query = $this->Product_preparation_model->get_balance($product1,$unique);
        
         //foreach($query->result() as $r);
         
             //echo $r->packed_weight; 
			  if($query)
		{
			foreach($query->result() as $r)
         {
			 $status =$r->packed_weight;
		 }
		}else{
			$status ='0';
		}
echo $status;
			 
         

     }
	 
	 //to Pack
	   public function to_pack()
     {
         $product1=$_POST['product'];
         $unique=$_POST['Unique'];
        // echo $product1;
       
	    $where_array = array( 'unique_preparation' => $product1 );
      $table_name="product_packing";
       $query = $this->db->where($where_array )->get($table_name);
	   if($query->num_rows()>0){
		   foreach ($query->result() as $packed);
	   
		   $packed_weight = $packed->packed_weight;
		   $unique_preparation = $packed->unique_preparation;
		   
		   $get_total_weight = $this->db->get_where('product_ingredients_used', ['unique_preparation'=>$unique_preparation,]);
		   
		    foreach ($get_total_weight->result() as $weight)
			
			$total_weight = $weight->total_output;	
			
			$result = $total_weight - $packed_weight;
	   }
	   else{
		   
        // echo $product1;
       $query = $this->Product_preparation_model->get_total_output($product1);
        
         foreach($query->result() as $r);
         
            
		  $result = $r->total_output; 
		  //$result=$total_weight;
	   }
	   
			
			echo $result;
		   
		   
	   
	   
	   }
        
         //foreach($query->result() as $r);
         
             //echo $r->packed_weight; 
		//	  if($query)
	//{
		//	foreach($query->result() as $r)
       ////  {
		//	 $status =$r->balance_weight;
		// }
		//}else{
			//$status ='0';

         

  
	 
	 //
	 
	 
	  public function product_name()
     {
         $product1=$_POST['product'];
        // echo $product1;
       $query = $this->Product_preparation_model->product_name($product1);
        
         foreach($query->result() as $r)
         {
             $product_id = $r->product; 
			 
         $get_prod_name = $this->db->group_by('product_name')->get_where('product_preparation',['id'=>$product_id]);
		 
		 foreach($get_prod_name->result() as $name);
		 echo $name->product_name;
		 }
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
                    date('d/m/Y h:i A', $r->created_at),
                    $declared_name
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Declared Ingredients  list', '', '', '', '', '', '', '', '', '', ''
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
                echo '<td>'.date('d/m/Y h:i A', $r->created_at).'</td>';
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
      
        $data['view_assistant'] = $this->db->get_where('product_ingredients', ['product_preparation' => $id]);
     
       
        theme('view_declared_ingredients', $data);
    }
	
/*===============================================*/
 public function view_used_ingredients($id) {
        //restricted this area, only for admin
       
        $data['view_assistant'] = $this->db->get_where('product_ingredients', ['product_preparation' => $id]);
        $data['used_assistant'] = $this->db->get_where('product_ingredients_used', ['product' => $id]);
     
       
        theme('view_used_ingredients', $data);
    }
/*===============================================*/

public function view_prepaired_food($id) {
        //restricted this area, only for admin
       
        
        $data['used_assistant'] = $this->db->get_where('product_ingredients_used', ['unique_preparation' => $id]);
     
       
        theme('view_prepared_food', $data);
    }

/*===============================================*/
public function view_assigned_products($id) {
        //restricted this area, only for admin
      
        
        $data['assigned_products'] = $this->db->get_where('product_assign', ['id' => $id]);
     
       
        theme('view_assigned_products', $data);
    }

	
	public function view_assigned_packs($id) {
        //restricted this area, only for admin
       
        
        $data['assigned_packs'] = $this->db->get_where('product_assign_packing', ['id' => $id]);
     
       
        theme('view_assigned_packs', $data);
    }

  public function product_prepared_report() {

        theme('product_prepared_report');
    }
	
	/*==============*/
	//Used declaration Json listing
	
	 public function ingredients_used_ListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Product_preparation_model->product_used_prepListCount();


        $query = $this->Product_preparation_model->product_used_prepList($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_prepaired_food/' . $r->unique_preparation ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

						
			$get_prod_name = $this->db->get_where('product_preparation', ['id'=>$r->product]);
			foreach($get_prod_name->result() as $p);
			$product_name = $p->product_name;
			
			$get_category_name = $this->db->get_where('smb_category', ['id'=>$r->category]);
			foreach($get_category_name->result() as $c);
			$category = $c->category_name;
             
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$prepaired_by = $p->first_name.' '.$p->last_name;			 

			//
			$get_product = $this->db->get_where('product_preparation', ['id'=>$r->product]);
			foreach($get_product->result() as $p)
			{
			$created_by = $p->created_by;
			$get_declared_name = $this->db->get_where('users', ['id'=>$created_by]);
			
			foreach($get_declared_name->result() as $p)
			
				$declared_name = $p->first_name.' '.$p->last_name;
			}
			
       //       
		
		
                $data['data'][] = array(
                    $button,             
                    $product_name, 
                    $r->exp_date,
                    $r->total_output,
                    $r->unique_preparation,
                    $prepaired_by,
                    $declared_name,
                    date('d-m-Y h:i A', $r->created_at)
                  
                );
            }
        } else {
            $data['data'][] = array(
                'You have no used ingredient list', '', '', '', '', '', '', ''
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
		
		$sf_time1 = $_POST['sf_time1'];
		$st_time1 = $_POST['st_time1'];
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->Product_preparation_model->searchproduct_used_prepListcount($product,$used_by,$sf_time,$st_time,$sf_time1,$st_time1);
		
		$query = $this->Product_preparation_model->searchproduct_used_prepList($limit, $start ,$product,$used_by,$sf_time,$st_time,$sf_time1,$st_time1);
		
		
		echo '<thead>
				<tr class="well">
					       
							<th  width="7%">Action</th>
							<th>product </th>
							<th>Expiry Date </th>
							<th>Total Output(Kg)</th>
							<th>Unique Preparation</th>
							<th>Prepared By</th>
							<th>Declared By</th>
							<th>Manufacturing Date</th>	
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
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_prepaired_food/' . $r->unique_preparation ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

               

		
		    $get_prod_name = $this->db->get_where('product_preparation', ['id'=>$r->product]);
			foreach($get_prod_name->result() as $p);
			$product_name = $p->product_name;
			
			$get_category_name = $this->db->get_where('smb_category', ['id'=>$r->category]);
			foreach($get_category_name->result() as $c);
			$category = $c->category_name;
             
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$prepaired_by = $p->first_name.' '.$p->last_name;			 
			
             	//
			$get_product = $this->db->get_where('product_preparation', ['id'=>$r->product]);
			foreach($get_product->result() as $p)
			{
			$created_by = $p->created_by;
			$get_declared_name = $this->db->get_where('users', ['id'=>$created_by]);
			
			foreach($get_declared_name->result() as $p)
			
				$declared_name = $p->first_name.' '.$p->last_name;
			}
			
       //        
			  
			  
                  
				echo '<tr>';    
                echo '<td>'.$button.'</td>';
                echo '<td>'.$product_name.'</td>';
                echo '<td>'.$r->exp_date.'</td>';
                echo '<td>'.$r->total_output.'</td>';
                //echo '<td>'.$r->used_ingredeint.'</td>';
                echo '<td>'.$r->unique_preparation.'</td>';
                echo '<td>'.$prepaired_by.'</td>';
                echo '<td>'.$declared_name.'</td>';
                echo '<td>'.date('d/m/Y h:i A', $r->created_at).'</td>';   
                echo '</tr>';  
				   
		
                    
                
                
            }
			//echo json_encode($data);
		}
			else{
				  echo '<tr><td>No results found</td></tr>';
			}
		echo '</tbody>
			';	
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


        $query = $this->Product_preparation_model->accounts_List($limit, $start);

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
					date('d/m/Y h:i A', $r->created_at),
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
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
	$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$limit = $this->input->post('length');
        $start = $this->input->post('start');
		
		$user_id1 = $_POST['user_id1'];
		$rolename1 = $_POST['rolename1'];
		$pay_type = $_POST['pay_type'];
		$points_mode = $_POST['points_mode'];
		$sf_time = $_POST['sf_time'];
		$st_time = $_POST['st_time'];
		
		


		$queryCount = $this->Product_preparation_model->search_accounts_ListCount($limit, $start ,$user_id1,$rolename1,$pay_type,$points_mode,$sf_time,$st_time);
		 //$queryCount = $this->Product_preparation_model->accounts_ListCount();

		$query = $this->Product_preparation_model->search_account_List($limit, $start ,$user_id1,$rolename1,$pay_type,$points_mode,$sf_time,$st_time);
		
		
	
		

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
					date('d/m/Y h:i A', $r->created_at),
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
	
	public function get_all_catg(){
		$get_catg = $this->db->get('smb_category');
		echo "<option value=''>Choose Option</option>";
		if($get_catg->num_rows()>0){
			foreach($get_catg->result() as $catg){
				echo "<option value='".$catg->id."'>".$catg->category_name."</option>";
			}
		}
	}


  public function get_product_name()
     {
         $category=$_POST['created_by'];
        // echo $category;
         $query = $this->Product_preparation_model->get_product_name($category);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
			 
			 $product_name = $r->product_preparation;
			 
            
			 $get_product_name = $this->db->get_where('product_preparation',['id'=>$product_name]);
			 foreach($get_product_name->result() as $p)
			  echo "<option value='".$r->product_preparation."'>".$p->product_name."</option>";
         } 

     }

	 
	  public function Prod_type()
     {
         $category=$_POST['id'];
        // echo $category;
         $query = $this->Product_preparation_model->Prod_type($category);
        
         foreach($query->result() as $r)
         {
			 
			
			 echo $r->id;
         } 

     }

	 
	  public function get_unk_prep()
     {
         $prod_id=$_POST['unique_preparation'];
       // echo $prod_id;
        $query = $this->Product_preparation_model->get_unk_prep($prod_id);
        
         foreach($query->result() as $r)
         {
			 
			
			 echo $r->created_by;
         } 

     }
	
	
	 
	
	public function assign_movement_products() {
        $data['product_assign'] = $this->db->group_by('created_by')->get('product_ingredients');
      $data['rolename'] = $this->db->order_by('id','desc')->get('role');
        
	if ($this->input->post()) {
            if ($this->input->post('submit') != 'assign_packing')
                die('Error! sorry');

            $this->form_validation->set_rules('unique_batch', 'Batch', 'trim|required');
            $this->form_validation->set_rules('product_id', 'Product id', 'trim|required');
            $this->form_validation->set_rules('assigned_role', 'Role', 'trim|required');
            $this->form_validation->set_rules('assigned_to_name', 'Assistant Name', 'trim|required');
           
           
		
            
            if ($this->form_validation->run() == true) {
                $insert = $this->Product_preparation_model->assign_movement_products();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Movement  Assigned  Successfully');
                    redirect(base_url('Product_preparation/list_assigned_movement'));
                }
            }
        }

        theme('assign_movement_products',$data);
    }
	
	 
	 // packing_advancestarts here
	
	    public function packing_advance() 
		{		//restricted this area, only for admin
				
				
				$data['product_name'] = $this->db->group_by('created_by')->get('product_ingredients_used');
				
				$data['packing_categ'] = $this->db->order_by('packing_category','asc')->group_by('packing_category')->get('pro_weight_category');
				
			if ($this->input->post()) {
					if ($this->input->post('submit') == 'add_advance_packing')
			{

				//$this->form_validation->set_rules('prepaired_by', 'Assistant Name', 'trim|required');
				$this->form_validation->set_rules('product_prep', 'Product', 'trim|required');
			   
			
				if ($this->form_validation->run() == true) {
			   
					$insert = $this->Product_preparation_model->product_packaging();
					if ($insert) {
						$this->session->set_flashdata('successMsg', 'Packing Saved Successfully');
						redirect(base_url('Product_preparation/view_product_packing1'));
					}
				}
			} 
			
				
				
			}
			theme('packing_advance', $data);
		}
	 
	 
	    public function get_packs()
     {
         $pro=$_POST['packing_category_id'];
       // echo $pro;
       $query = $this->Product_preparation_model->get_packs($pro);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
         
			
	$weight = $r->weight_kg .'kg';
			
			echo "<option value='".$r->id."'>".$r->pack_type.' - '.$weight."</option>";
		}
         } 
	 
	 
	   public function get_pack_weight()
     {
         $pro=$_POST['id'];
       //echo $pro;
       $query = $this->Product_preparation_model->get_pack_weight($pro);
       //  echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
         
			echo $r->weight_kg;
	
			
			//echo "<option value='".$r->id."'>".$r->weight_kg."</option>";
		}
         } 
	 
	 
	  
	   public function list_assigned_movement()
     {
	 
	 
	 	 theme('list_assigned_movement');
     }
	 
	 //List Assigned Movements
	
	 public function prod_movement_ListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Product_preparation_model->movementListCount();


        $query = $this->Product_preparation_model->movementList($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_movement_assigned/' . $r->id ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

				
			 
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$created_by = $p->first_name.' '.$p->last_name;			 

	        $get_modified_by = $this->db->get_where('users', ['id'=>$r->modified_by]);
			foreach($get_modified_by->result() as $p);
			$modified_by = $p->first_name.' '.$p->last_name;	
			
			  $get_product_id = $this->db->get_where('product_preparation', ['id'=>$r->product_id]);
			foreach($get_product_id->result() as $p);
			$product_name = $p->product_name;	
		
		
		    $get_assigned_role = $this->db->get_where('role', ['id'=>$r->assigned_role]);
			foreach($get_assigned_role->result() as $p);
			$assigned_role = $p->rolename;	
			
			 $get_assigned_role1 = $this->db->get_where('users', ['id'=>$r->assigned_to_name]);
			foreach($get_assigned_role1->result() as $p);
			$assigned_role1 = $p->first_name.' '.$p->last_name;		
			
			
			$get_status = $this->db->get_where('inventory_stocks', ['product_unique_code'=>$r->unique_batch, 'created_by'=>$r->assigned_to_name]);
			
			 if($get_status->num_rows() > 0)
			 {
				$Status = 'Dispached
'; 
				  
			 }
			 else{
					
					$Status ='Pending';
				}
		
                $data['data'][] = array(
                    $button,             
                   $product_name,
                    $r->unique_batch,
					$Status,
                    $assigned_role,
                    $assigned_role1,
                    $created_by,
                    date('d/m/Y h:i A', $r->created_at)
                   
				
                  
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Assigned List', '', '', '', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	 
	 
	 //list assigned warehouse
	 
	 
	  public function warehouse_ListJson() {
		  
		  $user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Product_preparation_model->warehouseListCount();


        $query = $this->Product_preparation_model->warehouseList($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/view_warehouse_assigned/' . $r->id ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

				  $button .= '<a class="btn btn-warning editBtn" href="' . base_url('Product_preparation/aad_to_warehouse/' . $r->unique_batch ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-plus-circle"></i> </a>';
			 
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$created_by = $p->first_name.' '.$p->last_name;			 

	        $get_modified_by = $this->db->get_where('users', ['id'=>$r->modified_by]);
			foreach($get_modified_by->result() as $p);
			$modified_by = $p->first_name.' '.$p->last_name;	
			
			  $get_product_id = $this->db->get_where('product_preparation', ['id'=>$r->product_id]);
			foreach($get_product_id->result() as $p);
			$product_name = $p->product_name;	
		
		
		    $get_assigned_role = $this->db->get_where('role', ['id'=>$r->assigned_role]);
			foreach($get_assigned_role->result() as $p);
			$assigned_role = $p->rolename;	
			
			 $get_assigned_role1 = $this->db->get_where('users', ['id'=>$r->assigned_to_name]);
			foreach($get_assigned_role1->result() as $p);
			$assigned_role1 = $p->first_name.' '.$p->last_name;		
		
                $data['data'][] = array(
                    $button,             
                    $product_name,
                    $r->unique_batch,
                    $assigned_role,
                    $assigned_role1,
                    $created_by,
                    date('d/m/Y h:i A', $r->created_at)
                   
				
                  
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Assigned List', '', '', '', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	  
	
	  public function add_moved_to_inventory() {
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
            $this->form_validation->set_rules('type', 'type', 'trim|required');
            $this->form_validation->set_rules('store_id', 'store_id', 'trim|required');
			
			

            if ($this->form_validation->run() == true) {
                $insert = $this->Inventory_stocks_model->add_inventory_stocks();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Stocks Added Successfully');
                    redirect(base_url('Inventory_stocks/report_inventory_stocks'));
                }
            }
        } 

        theme('add_moved_to_inventory', $data);
    }
	

   public function get_mfr_date()
     {
         $pro=$_POST['unique_batch'];
       //echo $pro;
       $query = $this->Product_preparation_model->get_mfr_date($pro);
       //  echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
         
			echo  date('d/m/Y h:i A', $r->created_at);
	
			
			//echo "<option value='".$r->id."'>".$r->weight_kg."</option>";
		}
         } 

	
	 public function get_quantity()
     {
         $pro=$_POST['unique_batch'];
       //echo $pro;
       $query = $this->Product_preparation_model->get_quantity($pro);
       //  echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
         
			echo  $r->no_ofpiece_small;
	
			
			//echo "<option value='".$r->id."'>".$r->weight_kg."</option>";
		}
         } 
	
	 public function get_weight_per_piece()
     {
         $pro=$_POST['unique_batch'];
       //echo $pro;
       $query = $this->Product_preparation_model->get_weight_per_piece($pro);
       //  echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
         
			echo  $r->weight_small;
	
			
			//echo "<option value='".$r->id."'>".$r->weight_kg."</option>";
		}
         } 
	
	
	 public function get_unique_code()
     {
         $pro=$_POST['unique_batch'];
       //echo $pro;
       $query = $this->Product_preparation_model->get_unique_code($pro);
       //  echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
         
			echo  $r->unique_small;
	
			
			//echo "<option value='".$r->id."'>".$r->weight_kg."</option>";
		}
         }


	 

 public function view_movement_assigned($id) {
        //restricted this area, only for admin
       
        $data['movement'] = $this->db->get_where('product_movement_assigned', ['id' => $id]);
     
       
        theme('view_movement_assigned', $data);
    }
	
	 public function get_assigned_by()
     {
         $pro=$_POST['unique_batch'];
       //echo $pro;
       $query = $this->Product_preparation_model->get_assigned_by($pro);
       //  echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
         
			echo $r->created_by;
	
			
			//echo "<option value='".$r->id."'>".$r->weight_kg."</option>";
		}
         } 
	
	 public function get_assigned_by1()
     {
         $pro=$_POST['unique_batch'];
       echo $pro;
       $query = $this->Product_preparation_model->get_assigned_by1($pro);
       //  echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
         
			echo $r->created_by;
	
			
			//echo "<option value='".$r->id."'>".$r->weight_kg."</option>";
		}
         } 
	 public function get_assigned_to()
     {
         $pro=$_POST['unique_batch'];
       //echo $pro;
       $query = $this->Product_preparation_model->get_assigned_to($pro);
       //  echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
         
			echo $r->assigned_to_name;
	
			
			//echo "<option value='".$r->id."'>".$r->weight_kg."</option>";
		}
         } 
		 
		 
	
   
   
   public function aad_to_warehouse($id){
		//restricted this area, only for admin
		

		$data['category_name'] = $this->db->get('smb_category');
	$data['product_name'] = $this->db->group_by('product_type')->get('product_preparation');
	$data['product'] = $this->db->get('product_preparation');
	$data['sub_category_name'] = $this->db->get('smb_sub_category');
	$data['title'] = $this->db->get(' smb_product');
	$data['country'] = $this->db->group_by('state')->get('pincode');
	$data['rolename'] = $this->db->get('role');
	$data['first_name'] = $this->db->get('users');
	
	//$data['inventory'] = $this->db->get('inventory_stocks',['product_unique_code'=>$id]);
	
	$data['inventory_stocks'] = $this->db->get_where('inventory_stocks',['product_unique_code'=>$id]);
	$data['product_warehouse_assigned'] = $this->db->get_where('product_warehouse_assigned',['unique_batch'=>$id]);
	//$data['product_warehouse_assigned'] = singleDbTableRow($id,'product_warehouse_assigned');
	
	
	
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_warehouse') die('Error! sorry');

		 
            $this->form_validation->set_rules('type', 'type', 'trim|required');	

			if($this->form_validation->run() == true)
			{
				 $insert = $this->Product_preparation_model->add_inventory_movement11();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Added To Warehouse...!!!');
					 redirect(base_url('Product_preparation/report_warehouse'));
				}
			}
		}

		theme('aad_to_warehouse', $data);
	}
	
	 
	 
	 	public function assign_to_warehouse() {
        $data['product_assign'] = $this->db->group_by('created_by')->get('product_ingredients');
      $data['rolename'] = $this->db->order_by('id','desc')->get('role');
        
	if ($this->input->post()) {
            if ($this->input->post('submit') != 'assign_packing')
                die('Error! sorry');

            $this->form_validation->set_rules('unique_batch', 'Batch', 'trim|required');
            $this->form_validation->set_rules('product_id', 'Product id', 'trim|required');
            $this->form_validation->set_rules('assigned_role', 'Role', 'trim|required');
            $this->form_validation->set_rules('assigned_to_name', 'Assistant Name', 'trim|required');
           
           
		
            
            if ($this->form_validation->run() == true) 
                $insert = $this->Product_preparation_model->assign_to_warehouse();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Warehouse Assigned  Successfully');
                    redirect(base_url('Product_preparation/list_assigned_warehouse'));
                }
            }
        

      
		theme('assign_to_warehouse',$data);
		}
    
	 public function list_assigned_warehouse()
     {
	
	 
	 	 theme('list_assigned_warehouse');
     } 
	
	
	public function view_warehouse_assigned($id) {
        //restricted this area, only for admin
       
        $data['movement'] = $this->db->get_where('product_movement_assigned', ['id' => $id]);
     
       
        theme('view_warehouse_assigned', $data);
    }
	
	 public function report_warehouse()
     {
	
	 
	 	 theme('report_warehouse');
     } 
	 
	  //report warehouse
	
	 public function report_warehouse_ListJson() {
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Product_preparation_model->rep_warehouseListCount();


        $query = $this->Product_preparation_model->rep_warehouseList($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/report_warehouse/' . $r->id ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
						
						  $button .= '<a class="btn btn-info editBtn" href="' . base_url('Product_preparation/release_stock_to_other_warehouse/' . $r->id ) . '" data-toggle="tooltip" title="Release stock">
						<i class="fa fa-plane"></i> </a>';

			$get_category_name = $this->db->get_where('smb_category', ['id'=>$r->category]);
			foreach($get_category_name->result() as $c);
			$category = $c->category_name;
			
			$get_store_name = $this->db->get_where('inventory_store_id', ['id'=>$r->store_id]);
			foreach($get_store_name->result() as $c);
			$store_name = $c->id.'-'.$c->store_name.'-'.$c->area;
			
			$get_subcategory_name = $this->db->get_where('smb_sub_category', ['id'=>$r->sub_category]);
			foreach($get_subcategory_name->result() as $sc);
			$sub_category = $sc->sub_category_name;
			 //
			 //
			$get_prod_name = $this->db->get_where('smb_product', ['id'=>$r->product]);
			foreach($get_prod_name->result() as $p);
			$product = $p->title;

			$get_assigned_by = $this->db->get_where('users', ['id'=>$r->assigned_by]);
			foreach($get_assigned_by->result() as $p);
			$assigned_by = $p->first_name.' '.$p->last_name;
			
			$get_assigned_to = $this->db->get_where('users', ['id'=>$r->assigned_to]);
			foreach($get_assigned_to->result() as $p);
			$assigned_to = $p->first_name.' '.$p->last_name;
			
			$get_prod_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_prod_name->result() as $p);
			$created_by = $p->first_name.' '.$p->last_name;
		
                $data['data'][] = array(
                    $button,             
                   
                    $r->id,
                    $r->type,
                    $store_name,
				    $r->product_unique_code,
				    $r->sub_batchno,
                    $product,  
                    $r->inward,
                    $r->outward,
                    $r->pieces,
                    $r->left_pieces,
                    $r->weight_pieces,
                    $r->balance_qty,
                    $r->price_per_unit,
					$assigned_by,
                    $assigned_to,
                    $r->product_manufacturing_date,					
                    $r->exp_date,
                    $category,
                    $sub_category,					
                    $created_by,
                    date('d/m/Y h:i A', $r->created_at)
                   
				
                  
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Ware house List', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	 
	 
	
	 	 	public function assign_to_other_warehouse() {
        $data['product_assign'] = $this->db->group_by('created_by')->get('product_ingredients');
      $data['rolename'] = $this->db->order_by('id','desc')->get('role');
        
	if ($this->input->post()) {
            if ($this->input->post('submit') != 'othr_ware')
                die('Error! sorry');

            $this->form_validation->set_rules('unique_batch', 'Batch', 'trim|required');
            $this->form_validation->set_rules('product_id', 'Product id', 'trim|required');
            $this->form_validation->set_rules('assigned_role', 'Role', 'trim|required');
            $this->form_validation->set_rules('assigned_to_name', 'Assistant Name', 'trim|required');
           
           
		
            
            if ($this->form_validation->run() == true) 
                $insert = $this->Product_preparation_model->assign_to_other_warehouse();
                if ($insert) {
                    $this->session->set_flashdata('successMsg', 'Warehouse Assigned  Successfully');
                    redirect(base_url('Product_preparation/list_assigned_warehouse'));
                }
            }
        

      
		theme('assign_to_other_warehouse',$data);
		}
		
		
		
		    public function get_unique_pack11()
     {
         $pro=$_POST['product'];
       //echo $pro;
       $query = $this->Product_preparation_model->get_unique_pack11($pro);
         echo "<option value=''>-Select-</option>";
         foreach($query->result() as $r)
         {
            //echo "<option value='".$r->product."'>".$r->product."</option>";
			$product_name = $r->product;
			
			$pieces_small = $r->pieces .'  pieces';
			$unique_small = $r->product_unique_code;
			$unique_id = $r->sub_batchno;
			
			$weight_small = $r->weight_pieces . ' Kg';
			
			//$get_declared_name = $this->db->get_where('users', ['id'=>$prepaired_by,]);
			
		/*	foreach($get_declared_name->result() as $p);
			
				$declared_name = $p->first_name;
				$declared_last_name = $p->last_name;*/
				
			
			echo "<option value='".$unique_id."'>".$unique_small.' - '.$pieces_small.'-'.$weight_small."</option>";
			
			
			
			
			//echo "<option value='".$r->unique_preparation."'>".$product_name.'-'.$prepaired_by.'-'.$r->product."</option>";
		}
         }
	
	
	 public function list_assigned_other_warehouse()
     {
	
	 
	 	 theme('list_assigned_other_warehouse');
     } 
	
	//list assigned Other warehouse
	 
	 
	  public function otherwarehouse_ListJson() {
		  
		  $user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
        $limit = $this->input->get('length');
        $start = $this->input->get('start');

        $queryCount = $this->Product_preparation_model->otherwarehouseListCount();


        $query = $this->Product_preparation_model->otherwarehouseList($limit, $start);

        $draw = $this->input->get('draw');

        $data = [];
        $data['draw'] = $draw;
        $data['recordsTotal'] = $queryCount;
        $data['recordsFiltered'] = $queryCount;

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $r) {



                //Action Button
                $button = '';
                $button .= '<a class="btn btn-primary editBtn" href="' . base_url('Product_preparation/list_assigned_other_warehouse/' . $r->id ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';

				  $button .= '<a class="btn btn-warning editBtn" href="' . base_url('Product_preparation/add_to_other_warehouse/' . $r->unique_batch ) . '" data-toggle="tooltip" title="View">
						<i class="fa fa-plus-circle"></i> </a>';
			 
            $get_declared_name = $this->db->get_where('users', ['id'=>$r->created_by]);
			foreach($get_declared_name->result() as $p);
			$created_by = $p->first_name.' '.$p->last_name;			 

	     
			
			  $get_product_id = $this->db->get_where('smb_product', ['id'=>$r->product_id]);
			foreach($get_product_id->result() as $p);
			$product_name = $p->title;	
		
		
		    $get_assigned_role = $this->db->get_where('role', ['id'=>$r->assigned_role]);
			foreach($get_assigned_role->result() as $p);
			$assigned_role = $p->rolename;	
			
			 $get_assigned_role1 = $this->db->get_where('users', ['id'=>$r->assigned_to_name]);
			foreach($get_assigned_role1->result() as $p);
			$assigned_role1 = $p->first_name.' '.$p->last_name;		
		
                $data['data'][] = array(
                    $button,             
                    $product_name,
                    $r->unique_batch,
                    $assigned_role,
                    $assigned_role1,
                    $created_by,
                    date('d/m/Y h:i A', $r->created_at)
                   
				
                  
                );
            }
        } else {
            $data['data'][] = array(
                'You have no Assigned List', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''
            );
        }
        echo json_encode($data);
    }
	
	
	   public function add_to_other_warehouse($id){
		//restricted this area, only for admin
		

		$data['category_name'] = $this->db->get('smb_category');
	$data['product_name'] = $this->db->group_by('product_type')->get('product_preparation');
	$data['product'] = $this->db->get('product_preparation');
	$data['sub_category_name'] = $this->db->get('smb_sub_category');
	$data['title'] = $this->db->get(' smb_product');
	$data['country'] = $this->db->group_by('state')->get('pincode');
	$data['rolename'] = $this->db->get('role');
	$data['first_name'] = $this->db->get('users');
	
	//$data['inventory'] = $this->db->get('inventory_stocks',['product_unique_code'=>$id]);
	
	$data['inventory_stocks'] = $this->db->get_where('inventory_movement',['sub_batchno'=>$id]);
	$data['product_warehouse_assigned'] = $this->db->get_where('product_other_warehouse_assigned',['unique_batch'=>$id]);
	//$data['product_warehouse_assigned'] = singleDbTableRow($id,'product_warehouse_assigned');
	
	
	
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_warehouse') die('Error! sorry');

		 
            $this->form_validation->set_rules('type', 'type', 'trim|required');	

			if($this->form_validation->run() == true)
			{
				 $insert = $this->Product_preparation_model->add_inventory_movement();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Added To Warehouse...!!!');
					 redirect(base_url('Product_preparation/report_warehouse'));
				}
			}
		}

		theme('add_to_other_warehouse', $data);
	}
	
	
	
	
	 public function release_stock_to_other_warehouse($id){
		//restricted this area, only for admin
		

		$data['category_name'] = $this->db->get('smb_category');
	$data['product_name'] = $this->db->group_by('product_type')->get('product_preparation');
	$data['product'] = $this->db->get('product_preparation');
	$data['sub_category_name'] = $this->db->get('smb_sub_category');
	$data['title'] = $this->db->get(' smb_product');
	$data['country'] = $this->db->group_by('state')->get('pincode');
	$data['rolename'] = $this->db->get('role');
	$data['first_name'] = $this->db->get('users');
	
	//$data['inventory'] = $this->db->get('inventory_stocks',['product_unique_code'=>$id]);
	
	$data['inventory_stocks'] = $this->db->get_where('inventory_movement',['id'=>$id]);
	$data['product_warehouse_assigned'] = $this->db->get_where('product_other_warehouse_assigned',['unique_batch'=>$id]);
	//$data['product_warehouse_assigned'] = singleDbTableRow($id,'product_warehouse_assigned');
	
	
	
		if($this->input->post())
		{
			if($this->input->post('submit') != 'add_warehouse') die('Error! sorry');

		 
            $this->form_validation->set_rules('type', 'type', 'trim|required');	

			if($this->form_validation->run() == true)
			{
				 $insert = $this->Product_preparation_model->add_inventory_movement();
				if($insert)
				{
					$this->session->set_flashdata('successMsg', 'Stock Moved Out Successfull...!!!');
					 redirect(base_url('Product_preparation/report_warehouse'));
				}
			}
		}

		theme('release_stock_to_other_warehouse', $data);
	}
	
}//last 
	
	/*================================================*/
	
//End
