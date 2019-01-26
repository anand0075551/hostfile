<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_stocks_model extends CI_Model {
	//Add Inventory Stock
	
	
	
	    public function add_inventory_stocks() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       
        $type	     =  $this->input->post('type');		 
		$inward	 =  $this->input->post('inward1');
		$outward	 =  $this->input->post('outward1');
		
		$store_id = $this->input->post('store_id');	

        $category	  = $this->input->post('category');		
        $sub_category = $this->input->post('sub_category');
        $item 		  = $this->input->post('item');
        $brand        = $this->input->post('brand');

		 
		 
		 	$balance_qty1  	= $this->Inventory_stocks_model->balance_qty($item , $store_id );
	    
				if ( $type == 1)
				{
						 $balance_qty =  $balance_qty1 + $inward	;
				}elseif($type == 2)
				{
					 $balance_qty =  $balance_qty1 - $outward;
				}

        //set all data for inserting into database
        $data = [
            'inward' 	                => $this->input->post('inward1'),			
            'outward' 	                => $this->input->post('outward1'),			
            'store_id' 	                => $store_id,			
            'remarks' 	                => $this->input->post('remarks'),			
            'type'		                => $type,			
            'category'	                => $this->input->post('category'),			
            'sub_category'              => $this->input->post('sub_category'),
            'product' 		            => $this->input->post('item'),
            'assigned_by' 		        => $this->input->post('assigned_by'),
            'assigned_to' 		        => $this->input->post('assigned_to'),
            'brand'                     => $this->input->post('brand'),
            'product_unique_code'       => $this->input->post('product_unique_code'),
            'product_manufacturing_date'=> $this->input->post('product_manufacturing_date'),
            'exp_date'                  => $this->input->post('product_expiry_date'),
            'price_per_unit'            => $this->input->post('price_per_unit'),
            'quantity'                  => $this->input->post('quantity'),
            //'volume'                    => $this->input->post('volume'),
			'balance_qty'		        => $balance_qty,
            'weight_per_piece'          => $this->input->post('weight_per_piece'),
            'tax1_per_unit'             => $this->input->post('tax1_per_unit'),
            'tax2_per_unit'             => $this->input->post('tax2_per_unit'),
            'tax3_per_unit'             => $this->input->post('tax3_per_unit'),
            'shipping1_per_unit'        => $this->input->post('shipping1_per_unit'),
            'shipping2_per_unit'        => $this->input->post('shipping2_per_unit'),
            'shipping3_per_unit'        => $this->input->post('shipping3_per_unit'),
            'sub_total_price'           => $this->input->post('sub_total_price'),
            'grand_total'               => $this->input->post('grand_total'),
            'area_location_name'        => $this->input->post('area_location_name'),
            'pincode'                   => $this->input->post('location_pincode'),
            'state'                   	=> $this->input->post('state'),
            'district'                  => $this->input->post('district'),
            'supplier_name'             => $this->input->post('supplier_name'),
            'supplier_id'               => $this->input->post('supplier_id'),
            'supplier_invoice_no'       => $this->input->post('supplier_invoice_no'),
            'compartment1'              => $this->input->post('compartment1'),
            'compartment2'              => $this->input->post('compartment2'),
            'compartment3'              => $this->input->post('compartment3'),
            'compartment4'              => $this->input->post('compartment4'),
            'compartment5'              => $this->input->post('compartment5'),
			
            'added_by' => $user_id,
            'created_by' => $user_id,
             'created_at' => time(),
            'modified_at' => time(),
            'modified_by' => $user_id
        ];

        $query = $this->db->insert('inventory_stocks', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'inventory_stocks'); //create an activity
            return true;
        }
        return false;
    }
	
	// Add inventory New
	
	    public function add_inventory_new() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       //set all data for inserting into database
	   //
   if(!empty($_POST['categ']))
	{
			
		foreach($_POST['categ'] as $cnt => $categ)
		{
			$sub_categ = $_POST['sub_categ'][$cnt];
			$citem = $_POST['citem'][$cnt];
			$weight = $_POST['weight'][$cnt];
			//
			$count = $this->db->count_all_results('product_ingredients');
			$p_count = $count + 1;
			$ing = 'ING'.strtoupper(substr($citem,0,4)).$p_count;
			//
			
			
			$product_preparation =$this->input->post('product_preparation');
			$quantity =$this->input->post('quantity');
			$total_declared =$this->input->post('total_declared');
			
			$total_output =$this->input->post('total_output');

			$data = [
						'product_preparation'               => $product_preparation,
						'unit'               => 'Kg',
						'total_declared'               => $total_declared,
						'quantity'               => $quantity,
						'ingredient'             => $ing,
						
						'category'               => $categ,
						'sub_category'         => $sub_categ,
						'item'               => $citem,
						'qty'              => $weight,
						'created_by'          => $user_id,
						'created_at'          => time(),
						 'modified_at' => time(),
							'modified_by' => $user_id
					];
			$query = $this->db->insert('product_ingredients', $data);
			
			 $insert_id = $this->db->insert_id();

				
			
			$query2 = $this->db->insert('product_preparation_tracking', $data);
			
		}
		
	}
	   

        if ($query && $query2) {
            //create_activity('Added ' . $data['name'] . 'product_ingredients'); //create an activity
            return  $product_preparation;
        }
        return false;
    }

	//
	
	//Listing Inventory
	
	 public function Inventory_ListCount() {
        $query = $this->db->count_all_results('inventory_stocks');
        return $query;
    }

    public function Inventory_List($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = $user_info['role'];

        if ($role == 'admin') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('inventory_stocks');
            return $query;
        } else {
            $table_name = 'inventory_stocks';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	// searching Inventory
	public function search_inventory_list($limit, $start ,$product,$category,$sub_categoty,$sf_time,$st_time){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
		$condition="";
		if($product !='')
		{
			$condition.=" product = ".$product." ";
		}
		
		if($category !='')
		{
			if($condition != ""){
				$condition.=" AND category = '".$category."'";
			}
			else{
				$condition.="category = '".$category."'";
			}
		}
		
		if($sub_categoty !='')
		{
			if($condition != ""){
				$condition.=" AND sub_category = '".$sub_categoty."'";
			}
			else{
				$condition.="sub_category = '".$sub_categoty."'";
			}
		}
	if($sf_time !='' && $st_time !='')
			{
				$start_fdt = new DateTime($sf_time);
				$start_from = $start_fdt->format('Y-m-d');
				
				$start_tdt = new DateTime($st_time);
				$start_to = $start_tdt->format('Y-m-d');
			}
		
		if($sf_time !='' && $st_time !=''){
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) >= '".$start_from."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to."'";
			}
		}
					
		if($condition !='')
		{
			$where_array =$condition;
		}
		//$where_array =" product_preparation = 1";
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('inventory_stocks'); 
		
        return $query;
	}
	
	/*=======================*/
	
	//Edit inventory stocks
	
	  public function edit_inventory_stocks($id){ 

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		 $category	 =  $this->input->post('category');		 
		 $inward	 =  $this->input->post('inward');
		 $quantity   =  $this->input->post('quantity');
		$balance_qty =  $quantity;
		
        $data = [
			
            'inward'		                 => $this->input->post('inward'),			
            'category'		                 => $this->input->post('category'),			
            'sub_category'                   => $this->input->post('sub_category'),
            'product'                        => $this->input->post('item'),
            'brand'                          => $this->input->post('brand'),
            'product_unique_code'            => $this->input->post('product_unique_code'),
            'product_manufacturing_date'     => $this->input->post('product_manufacturing_date'),
            'product_expiry_date'            => $this->input->post('product_expiry_date'),
            'price_per_unit'                 => $this->input->post('price_per_unit'),
            'quantity' 			             => $quantity,	
            'weight_per_piece'               => $this->input->post('weight_per_piece'),
            'tax1_per_unit'                  => $this->input->post('tax1_per_unit'),
            'tax2_per_unit'                  => $this->input->post('tax2_per_unit'),
            'tax3_per_unit'                  => $this->input->post('tax3_per_unit'),
            'shipping1_per_unit'             => $this->input->post('shipping1_per_unit'),
            'shipping2_per_unit'             => $this->input->post('shipping2_per_unit'),
            'shipping3_per_unit'             => $this->input->post('shipping3_per_unit'),
            'sub_total_price'                => $this->input->post('sub_total_price'),
            'grand_total'                    => $this->input->post('grand_total'),
            'area_location_name'             => $this->input->post('area_location_name'),
            'location_pincode'               => $this->input->post('location_pincode'),
            'supplier_name'                  => $this->input->post('supplier_name'),
            'supplier_id'                    => $this->input->post('supplier_id'),
            'supplier_invoice_no'            => $this->input->post('supplier_invoice_no'),
            'compartment1' 			         => $this->input->post('compartment1'),
            'compartment2'			         => $this->input->post('compartment2'),
            'compartment3'			         => $this->input->post('compartment3'),
            'compartment4' 		             => $this->input->post('compartment4'),
            'compartment5'		             => $this->input->post('compartment5'),
			
            'created_by'  => $user_id,
            'created_at' => time(),
            'modified_at' => time(),
            'modified_by' => $user_id
        ];
		
		
        $query = $this->db->where('id', $id)->update('inventory_stocks', $data);

        if($query)
        {
            create_activity('Updated '.$data['modified_by'].'inventory_stocks'); //create an activity
            return true;
        }
        return false;

    }
	
	
	
	
	
	/*=====================*/
	
	 function district($state)
    {
      $where_array = array( 'state' => $state );
      $table_name="pincode";
       $query = $this->db->group_by('district')->order_by('district', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	function location($district)
    {
      $where_array = array( 'district' => $district );
      $table_name="pincode";
       $query = $this->db->order_by('location', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	
   function pincode($location)
    {
      $where_array = array( 'location' => $location );
      $table_name="pincode";
       $query = $this->db->order_by('pincode', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }		
// get user on change role

	  function get_user1($to_role)
    {
      $where_array = array( 'rolename' => $to_role );
      $table_name="users";
       $query = $this->db->order_by('first_name', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
   
	//get item weight_per_piece
	
	  function get_wght($to_role)
    {
      $where_array = array( 'id' => $to_role );
      $table_name="smb_product";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	// get volume

		  function get_wght1($to_role)
    {
      $where_array = array( 'id' => $to_role );
      $table_name="smb_product";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	
	
	
	
	/*
    Get state
    */
    function get_user($category)
    {
      $where_array = array( 'category' => $category );
      $table_name="smb_sub_category";
       $query = $this->db->order_by('sub_category_name', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	/*==========================*/
	//get_area_pincode

    function get_area_pincode($location)
    {
		
      $where_array = array( 'location' => $location );
      $table_name="pincode";
       $query = $this->db->order_by('pincode','asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	/*===========================*/
	
	
	  function get_assistant($category)
    {
      $where_array = array( 'product' => $category );
      $table_name="product_ingredients_used";
       $query = $this->db->order_by('created_by', 'asc')->group_by('created_by')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	

	
	function get_item($category)
    {
      $where_array = array( 'sub_category' => $category );
      $table_name=" smb_product";
       $query = $this->db->order_by('title', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	//Total Balance of Different Stocks By Users
	public function balance_qty($item , $store_id ){
       	
		$table_name = "inventory_stocks";		 
		$where_array = array('product'=>$item, 'store_id' =>$store_id);
		$stock_inward = $this->db->select_sum('inward')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $stock_inward->result() 		as $stock_inward);
		$Total_Inward			= $stock_inward->inward;
		
		$table_name = "inventory_stocks";		 
		$where_array = array('product'=>$item, 'store_id' =>$store_id);
		$stock_outward = $this->db->select_sum('outward')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $stock_outward->result() 		as $stock_outward);
		$Total_outward			= $stock_outward->outward;
		
		$balance_qty       = ( $Total_Inward - $Total_outward ) ;
		
		return $balance_qty;
		
	
		
    }
	

	function get_ingredient($product)
    {
      $where_array = array( 'product_preparation' => $product );
      $table_name="product_ingredients";
       $query = $this->db->order_by('id', 'desc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 
	
  //
 
  //
  
   
	
	


}
