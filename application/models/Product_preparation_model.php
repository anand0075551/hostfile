<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_preparation_model extends CI_Model {

    public function add_product_ingredients() {

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
						'unit'                              => 'Kg',
						'total_declared'                    => $total_declared,
						'quantity'                          => $quantity,
						'ingredient'                        => $ing,
						'category'                          => $categ,
						'sub_category'                      => $sub_categ,
						'item'                              => $citem,
						'qty'                               => $weight,
						'created_by'                        => $user_id,
						'created_at'                        => time(),
					    'modified_at'                      => time(),
						'modified_by'                   => $user_id
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

	 public function add_product() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $count = $this->db->count_all_results('product_preparation');
        $p_count = $count + 1;
        $prod = 'PRO'.strtoupper(substr($this->input->post('product_name'),0,5)).$p_count;



        //set all data for inserting into database
        $data = [
            'product_name' => $this->input->post('product_name'),			
            'product_type' => $this->input->post('product_type'),			
            'product' => $prod,			
            
            'created_by' => $user_id,
             'created_at' => time()
            
           
        ];

        $query = $this->db->insert('product_preparation', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . ' product_preparation'); //create an activity
            return true;
        }
        return false;
    }
	
	//
	
	
	 public function add_product_assign() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
     



        //set all data for inserting into database
        $data = [
            'declared_by'          => $this->input->post('declared_by'),			
            'product_id'           => $this->input->post('product_id'),			
            'product_type'         => $this->input->post('prod_type'),			
            'assigned_role'        => $this->input->post('assigned_role'),			
            'assigned_to_name'     => $this->input->post('assigned_to_name'),			
            'store_id'             => $this->input->post('store_id'),			
           		
            'created_by'           => $user_id,
            'created_at'          => time(),
            'modified_at'          => time(),
            'modified_by'          => $user_id
             
           
        ];

        $query = $this->db->insert('product_assign', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . ' product_assign'); //create an activity
            return true;
        }
        return false;
    }
	
	// Assign Packing
	
	 public function add_product_packing_assign() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
     



        //set all data for inserting into database
        $data = [
            'prepaired_by'       => $this->input->post('unique_prep'),			
            'product_id'         => $this->input->post('product_id'),			     	
            'unique_prep'        => $this->input->post('prepaired_by'),			     	
            'assigned_role'      => $this->input->post('assigned_role'),			
            'assigned_to_name'   => $this->input->post('assigned_to_name'),			
      	
            'created_by'          => $user_id,
             'created_at'         => time(),
            'modified_at'         => time(),
            'modified_by'         => $user_id
            
           
        ];

        $query = $this->db->insert('product_assign_packing', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . ' product_assign_packing'); //create an activity
            return true;
        }
        return false;
    }
	
	//
	 public function pack_now() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
     
	 $product_id = $this->input->post('product_prep');
	 $prepaired_by = $this->input->post('prepaired_by');
       

		 $where_array = array( 'product' => $product_id , 'prepaired_by' =>$prepaired_by );
		 $table_name="product_packing";
		 
		 $query = $this->db->where($where_array )->get($table_name);
        

         return $query;
		 
       
    }
	//
	
	
	
		 public function product_packaging() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       
     $product_preparation =$this->input->post('product_preparation');
	 
     $product_name =$this->input->post('product_name');
	 $product       = $this->input->post('product_prep');
	 
	 $get_prod_name = $this->db->get_where('product_preparation',['id'=>$product  ]);
	 foreach($get_prod_name->result () as $p_name)
	 {
	 $prod_name = $p_name->product_name;
	 }
	 // Unique package name
	 
	        $count = $this->db->count_all_results('product_packing');
			$p_count = $count + 1;
			$unique_small  = 'BATCH-'.strtoupper(substr($prod_name,0,5)).$p_count;
			$unique_medium = 0; //'MED'.strtoupper(substr($product_name,0,6)).$p_count;
			$unique_large  = 0; //'LRG'.strtoupper(substr($product_name,0,6)).$p_count;
			$unique_family = 0; //'FML'.strtoupper(substr($product_name,0,6)).$p_count;
			$unique_combo  = 0; //'CMB'.strtoupper(substr($product_name,0,6)).$p_count;
	 //
	 $unique_prep   = $this->input->post('Unique');
	
	 $weight_small  = $this->input->post('weight_small');
	 $weight_medium = $this->input->post('weight_medium');
	 $weight_large  = $this->input->post('weight_large');
	 $weight_family = $this->input->post('weight_family');
	 $weight_combo  = $this->input->post('weight_combo');
	  
	 
	 $packed_weight1  	= $this->Product_preparation_model->packed_weight($unique_prep  );
	 
	 $packed_weight = ($packed_weight1 + $weight_small + $weight_medium + $weight_large + $weight_family + $weight_combo  );
	 
		
        //set all data for inserting into database
        $data = [
		    'product'             => $product,
		    'status'              => $this->input->post('status'),
		    'prepaired_by'        => $this->input->post('prep_by'),
		    'unique_small'        => $unique_small,
		    'unique_medium'       => $unique_medium,
		    'unique_large'        => $unique_large,
		    'unique_family'       => $unique_family,
		    'unique_combo'        => $unique_combo,
		    'unique_preparation'  => $unique_prep,	
            'quantity_small'      => $this->input->post('pre_def_small'),			
            'weight_small'        => $weight_small,			
            'package_name_small'  => $this->input->post('package_name_small'),
            'no_ofpiece_small'    => $this->input->post('pieces_small'),
            'wastage_small'       => $this->input->post('wastage_small'),
            'total_weight'        => $this->input->post('total_weight'),
            'packed_weight'        =>$packed_weight,
            'balance_weight'      => $this->input->post('balance_weight'),
			
			'quantity_large'      => $this->input->post('pre_def_large'),			
            'weight_large'        => $weight_large,			
            'package_name_large'  => $this->input->post('package_name_large'),
            'no_ofpiece_large'    => $this->input->post('pieces_large'),
            'wastage_large'       => $this->input->post('wastage_large'),
			
			'quantity_medium'     => $this->input->post('pre_def_medium'),			
            'weight_medium'       => $weight_medium,			
            'package_name_medium' => $this->input->post('package_name_medium'),
            'no_ofpiece_medium'   => $this->input->post('pieces_medium'),
            'wastage_medium'      => $this->input->post('wastage_medium'),
			
			'quantity_family'     => $this->input->post('pre_def_family'),			
            'weight_family'       =>  $weight_family,			
            'package_name_family' => $this->input->post('package_name_family'),
            'no_ofpiece_family'   => $this->input->post('pieces_family'),
            'wastage_family'      => $this->input->post('wastage_family'),
			
			'quantity_combo'      => $this->input->post('pre_def_combo'),			
            'weight_combo'        => $weight_combo,			
            'package_name_combo'  => $this->input->post('package_name_combo'),
            'no_ofpiece_combo'    => $this->input->post('pieces_combo'),
            'wastage_combo'       => $this->input->post('wastage_combo'),
           
           
            'created_by'          => $user_id,
             'created_at'         => time(),
            'modified_at'         => time(),
            'modified_by'         => $user_id
        ];

        $query = $this->db->insert('product_packing', $data);

        if ($query) {
           // create_activity('Added ' . $data['name'] . 'product_packing'); //create an activity
            return $product;
        }
       
    }
	//
	
	public function packed_weight($unique_prep  ){
       	
		$table_name = "product_packing";		 
		$where_array = array('unique_preparation'=> $unique_prep);
		$wht_small = $this->db->select_sum('weight_small')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $wht_small->result() 		as $small);
		$Total_small	= $small->weight_small;
		
		$table_name = "product_packing";		 
		$where_array = array('unique_preparation'=>$unique_prep);
		$wht_medium = $this->db->select_sum('weight_medium')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $wht_medium->result() 		as $medium);
		$Total_medium			= $medium->weight_medium;
		
		//large
		$table_name = "product_packing";		 
		$where_array = array('unique_preparation'=>$unique_prep);
		$wht_large = $this->db->select_sum('weight_large')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $wht_large->result() 		as $large);
		$Total_large			= $large->weight_large;
		
		//family
		$table_name = "product_packing";		 
		$where_array = array('unique_preparation'=>$unique_prep);
		$wht_family = $this->db->select_sum('weight_family')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $wht_family->result() 		as $family);
		$Total_family			= $family->weight_family;
		//combo
		
		$table_name = "product_packing";		 
		$where_array = array('unique_preparation'=>$unique_prep);
		$wht_combo = $this->db->select_sum('weight_combo')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $wht_combo->result() 		as $combo);
		$Total_combo			= $combo->weight_combo;
		
		
	 $packed_weight       = ( $Total_small + $Total_medium + $Total_large + $Total_family + $Total_combo ) ;
		
		return $packed_weight;
		
	
		
    }
	
	//
	
	//
	//Packing  Listing
	/*=============================================*/
	  public function packing_ListCount() {
        $query = $this->db->count_all_results('product_packing');
        return $query;
    }

    public function packing_List($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('product_packing');
            return $query;
        } else {
            $table_name = 'product_packing';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	/*================*/
	 public function get_total_list() {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = $user_info['role'];

		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		
        if ($role == 'admin') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('product_packing');
            return $query;
        } else {
            $table_name = 'product_packing';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->where($where_array)->get($table_name);
            return $query;
        }
    }
	/*================*/
	
	//packing searching
	
	
	public function search_packing_ListCount($limit = 0, $start = 0,$product_name,$prepaired_by,$packed_by,$status,$sf_time,$st_time)
	{
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
	$condition="";
		if($product_name !='')
		{
			$condition.="product = ".$product_name." ";
		}
		
		if($prepaired_by !='')
		{
			if($condition != ""){
				$condition.=" AND prepaired_by = '".$prepaired_by."'";
			}
			else{
				$condition.="prepaired_by = '".$prepaired_by."'";
			}
		}
		
		if($packed_by !='')
		{
			if($condition != ""){
				$condition.=" AND created_by = '".$packed_by."'";
			}
			else{
				$condition.="created_by = '".$packed_by."'";
			}
		}
		
		if($status !='')
		{
			if($condition != ""){
				$condition.=" AND status = '".$status."'";
			}
			else{
				$condition.="status = '".$status."'";
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
		//$query = $this->db->where($where_array )->get('accounts'); 
		
		 $query = $this->db->where($where_array )->count_all_results('product_packing');
        return $query;
    }
	
	
	
	
	
	
	
	public function search_packing_List($limit = 0, $start = 0,$product_name,$prepaired_by,$packed_by,$status,$sf_time,$st_time){
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
		$condition="";
		if($product_name !='')
		{
			$condition.="product = ".$product_name." ";
		}
		
		if($prepaired_by !='')
		{
			if($condition != ""){
				$condition.=" AND prepaired_by = '".$prepaired_by."'";
			}
			else{
				$condition.="prepaired_by = '".$prepaired_by."'";
			}
		}
		
		if($packed_by !='')
		{
			if($condition != ""){
				$condition.=" AND created_by = '".$packed_by."'";
			}
			else{
				$condition.="created_by = '".$packed_by."'";
			}
		}
		
		if($status !='')
		{
			if($condition != ""){
				$condition.=" AND status = '".$status."'";
			}
			else{
				$condition.="status = '".$status."'";
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
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('product_packing'); 
		//$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('accounts');
        return $query;
	}
	
	/*================*/
	function get_total($product_name,$prepaired_by,$packed_by,$status,$sf_time,$st_time)
    {
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
		$condition="";
		if($product_name !='')
		{
			$condition.="product = ".$product_name." ";
		}
		
		if($prepaired_by !='')
		{
			if($condition != ""){
				$condition.=" AND prepaired_by = '".$prepaired_by."'";
			}
			else{
				$condition.="prepaired_by = '".$prepaired_by."'";
			}
		}
		
		if($packed_by !='')
		{
			if($condition != ""){
				$condition.=" AND created_by = '".$packed_by."'";
			}
			else{
				$condition.="created_by = '".$packed_by."'";
			}
		}
		
		if($status !='')
		{
			if($condition != ""){
				$condition.=" AND status = '".$status."'";
			}
			else{
				$condition.="status = '".$status."'";
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
		$query = $this->db->order_by('id', 'desc')->where($where_array)->get('product_packing'); 
		//$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('accounts');
        return $query;
	}
	/*================*/
	
	//
	
	/* public function add_product_packaging() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $count = $this->db->count_all_results('product_preparation');
        $p_count = $count + 1;
        $prod = 'PRO'.strtoupper(substr($this->input->post('product_name'),0,5)).$p_count;



        //set all data for inserting into database
        $data = [
            'product_name' => $this->input->post('product_name'),			
            'product' => $prod,			
            
            'created_by' => $user_id,
             'created_at' => time()
            
           
        ];

        $query = $this->db->insert('product_preparation', $data);

        if ($query) {
            create_activity('Added ' . $data['name'] . ' product_preparation'); //create an activity
            return true;
        }
        return false;
    }
	*/
	
	
	 function get_total_output($product1)
    {
		
      $where_array = array( 'unique_preparation' => $product1 );
      $table_name="product_ingredients_used";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	 function get_balance($product1,$unique)
    {
		
      $where_array = array( 'unique_preparation' => $product1 );
      $table_name="product_packing";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	//
	 function to_pack($product1,$unique)
    {
		
      $where_array = array( 'unique_preparation' => $product1 );
      $table_name="product_packing";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	//
	
	
	
	 function get_prep_by($product1)
    {
		
      $where_array = array( 'unique_preparation' => $product1 );
      $table_name="product_ingredients_used";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 

 function product_name($product1)
    {
		
      $where_array = array( 'product' => $product1 );
      $table_name="product_ingredients_used";
       $query = $this->db->group_by('product')->where($where_array )->get($table_name);
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
	
	
	  function get_product($pro)
    {
      $where_array = array( 'created_by' => $pro );
      $table_name="product_ingredients_used";
       $query = $this->db->order_by('product', 'asc')->group_by('product')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	//
	  function get_unique($prod)
    {
      $where_array = array( 'product' => $prod );
      $table_name="product_ingredients_used";
       $query = $this->db->group_by('unique_preparation')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 
	
		 // Assign movement unique pack
		 
	  function get_unique_pack($prod)
   {
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
      $where_array = array( 'product_id' => $prod,'type' => 2,'created_by' => $user_id );
      $table_name="inventory_stocks";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	
	 function get_unique_pack11($prod)
    {
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
      $where_array = array( 'product' => $prod,'type' => 2,'created_by' => $user_id );
      $table_name="inventory_movement";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	// For Packing screen

	  function get_unique1($prod)

	
	  {
		  
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
      //$where_array = array( 'product_id' => $category );
      //$table_name=" product_assign";
       $query = $this->db->group_by('unique_prep')->get_where('product_assign_packing', ['product_id' => $prod, 'assigned_to_name' => $user_id] );
       
            //$result = $query->result_array();
            return $query;
    } 	
	
	
	
//	
/*	 function wastage($total_wastage)
    {
      $where_array = array( 'total_wastage' => $total_wastage );
      $table_name="smb_sub_category";
       $query = $this->db->order_by('sub_category_name', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	*/
	
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
	
	//head chef
	
	function get_product_prepration_hchef($category)
    {
      $where_array = array( 'product_type' => $category );
      $table_name=" product_preparation";
       $query = $this->db->order_by('product_name', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	//
	
	function get_product_prepration($category)
    {
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
      //$where_array = array( 'product_id' => $category );
      //$table_name=" product_assign";
       $query = $this->db->group_by('product_id')->get_where('product_assign', ['product_type' => $category, 'assigned_to_name' => $user_id] );
       
            //$result = $query->result_array();
            return $query;
        
    } 	
	
	//
	
	function get_status($product_id,$Unique)
    {
      $where_array = array( 'product' => $product_id,'unique_preparation' => $Unique);
      $table_name=" product_packing";
       $query = $this->db->order_by('product', 'asc')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	//
	
	
	
	

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
	
  
  
	 public function add_used_ingredients($used_weight,$prod_id,$sub_category,$product,$category,$total_output,$exp_date,$store_id_assigned) 
	{
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        //set all data for inserting into database
		//echo $used_weight;
		 $count_my = $this->db->count_all_results('product_ingredients_used');
		//$product1
        $p_count = $count_my + 1;
		
       $prod = 'PREP'.$p_count;
		
	

		
		
		$product1 		  = explode(',',$product);		
		$category1 		  = explode(',',$category);
		$sub_category1    = explode(',',$sub_category);
		$prod_id1 		  = explode(',',$prod_id);		
		$used_weight1     = explode(',',$used_weight);		
		//$used_ingredeint1 = explode(',',$used_ingredeint);
	
		
		$inward 					 =0;
		$type 						 =2;

		$count =count($used_weight1);
		$cnt=$count-1;
		for($i=0; $i<$cnt; $i++)
		{
			
	/*	$table_name = "inventory_stocks";		 
		$where_array = array('product'=>$prod_id1[$i], 'added_by' =>$user_id);
		$stock_inward = $this->db->select_sum('inward')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $stock_inward->result() 		as $stock_inward);
		$Total_Inward			= $stock_inward->inward;
		
		$table_name = "inventory_stocks";		 
		$where_array = array('product'=>$prod_id1[$i], 'added_by' =>$user_id);
		$stock_outward = $this->db->select_sum('outward')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $stock_outward->result() 		as $stock_outward);
		$Total_outward			= $stock_outward->outward;
		
		$balance_qty1       = ( $Total_Inward - $Total_outward ) ;	*/
		
		$get_qty = $this->db->order_by('id', 'asc')->get_where('inventory_stocks',['product'=>$prod_id1[$i], 'store_id' => $store_id_assigned]);
		foreach($get_qty->result() as $q);
			
		$balance_qty				 =$q->balance_qty-$used_weight1[$i];	
		$exp_date1				     =$q->exp_date;
		$remarks				     =$q->remarks;
		$brand				         =$q->brand;
		$product_unique_code	     =$q->product_unique_code;
		$product_manufacturing_date	 =$q->product_manufacturing_date;
		$price_per_unit				 =$q->price_per_unit;
		$quantity				     =$q->quantity;
		$weight_per_piece			 =$q->weight_per_piece;
		$tax1_per_unit				 =$q->tax1_per_unit;
		$tax2_per_unit				 =$q->tax2_per_unit;
		$tax3_per_unit				 =$q->tax3_per_unit;
		$shipping1_per_unit			 =$q->shipping1_per_unit;
		$shipping2_per_unit		     =$q->shipping2_per_unit;
		$shipping3_per_unit		     =$q->shipping3_per_unit;
		$sub_total_price		     =$q->sub_total_price;
		$grand_total				 =$q->grand_total;
		$area_location_name			 =$q->area_location_name;
		$pincode				     =$q->pincode;
		$state				         =$q->state;
		$district				     =$q->district;
		$supplier_name				 =$q->supplier_name;
		$supplier_id				 =$q->supplier_id;
		$supplier_invoice_no		 =$q->supplier_invoice_no;
		$compartment1				 =$q->compartment1;
		$compartment2				 =$q->compartment2;
		$compartment3				 =$q->compartment3;
		$compartment4				 =$q->compartment4;
		$compartment5				 =$q->compartment5;
		
		
		
        $data = [
            'used_weight'            => $used_weight1[$i],					
            'product'                => $product1[$i],
            'category'               => $category1[$i],
            'sub_category'           => $sub_category1[$i],
            'item'                   => $prod_id1[$i],
            'total_output'           => $total_output,   
            'exp_date'               => $exp_date,   
            'unique_preparation'     => $prod,   
            'created_by'             => $user_id,
            'created_at'             => time(),
            'modified_at'            => time(),
            'modified_by'            => $user_id,
        ];
		
	  $query = $this->db->insert('product_ingredients_used', $data);
	  
	
	  if($category1[$i] !=26 && $used_weight1[$i] !=0)
		{
	  
	  
	  
//Inventory stock update as Outword		
		 $data2 = [
            'outward'                   => $used_weight1[$i],
            'inward'                    => $inward,
            'type'                      => '2', //$type,
			'product'                   => $prod_id1[$i],//$used_ingredeint1[$i],		
            'remarks' 	                => $remarks, //$remarks,				
            'category'	                => $category1[$i],			
            'sub_category'	            => $sub_category1[$i],		         
            'brand'                     => $brand,
			'store_id'	                => $store_id_assigned,	
            'product_unique_code'       => $product_unique_code,
            'product_manufacturing_date'=> $product_manufacturing_date,
            'exp_date'                  => $exp_date1,
            'price_per_unit'            => $price_per_unit,
            'quantity'                  => $quantity,
			'balance_qty'		        => $balance_qty,
            'weight_per_piece'          => $weight_per_piece,
            'tax1_per_unit'             => $tax1_per_unit,
            'tax2_per_unit'             => $tax2_per_unit,
            'tax3_per_unit'             => $tax3_per_unit,
            'shipping1_per_unit'        => $shipping1_per_unit,
            'shipping2_per_unit'        => $shipping2_per_unit,
            'shipping3_per_unit'        => $shipping3_per_unit,
            'sub_total_price'           => $sub_total_price,
            'grand_total'               => $grand_total,
            'area_location_name'        => $area_location_name,
            'pincode'                   => $pincode,
            'state'                   	=> $state,
            'district'                  => $district,
            'supplier_name'             => $supplier_name,
            'supplier_id'               => $supplier_id,
            'supplier_invoice_no'       => $supplier_invoice_no,
            'compartment1'              => $compartment1,
            'compartment2'              => $compartment2,
            'compartment3'              => $compartment3,
            'compartment4'              => $compartment4,
            'compartment5'              => $compartment5,
			
            'added_by'                  => $user_id,
           
            'created_by'                => $user_id,
            'created_at'                => time(),
            'modified_at'               => time(),
            'modified_by'               => $user_id,
        ];

      
		
		$insert_id = $this->db->insert_id();
		
        $query2 = $this->db->insert('inventory_stocks', $data2);
		}

	}
        if ($query && $query2) {
            
           return  $product1[0];
        }
       return false;
    }

	
	
		/*=================================================*/

		
		/*public function balance_qty($item1 , $user_id ){
       	
		$table_name = "inventory_stocks";		 
		$where_array = array('product'=>$item1, 'added_by' =>$user_id);
		$stock_inward = $this->db->select_sum('inward')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $stock_inward->result() 		as $stock_inward);
		$Total_Inward			= $stock_inward->inward;
		
		$table_name = "inventory_stocks";		 
		$where_array = array('product'=>$item1, 'added_by' =>$user_id);
		$stock_outward = $this->db->select_sum('outward')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $stock_outward->result() 		as $stock_outward);
		$Total_outward			= $stock_outward->outward;
		
		$balance_qty       = ( $Total_Inward - $Total_outward ) ;
		
		return $balance_qty;
		
	
		
    }
		*/
		/*=================================================*/

	
   
    public function product_prepListCount() {
        $query = $this->db->count_all_results('product_ingredients');
        return $query;
    }

    public function product_prepList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        
		$currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82') {

       
            $query = $this->db->order_by('id', 'desc')->group_by('product_preparation', 'desc')->limit($limit, $start)->get('product_ingredients');
            return $query;
        } else {
            $table_name = 'product_ingredients';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->group_by('product_preparation', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }

	
	/*=============================================*/
	//searching List	
	public function search_declared_list($limit = 10, $start = 0 ,$product,$declared_by,$sf_time,$st_time){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		
		$condition="";
		if($product !='')
		{
			$condition.=" product_preparation = ".$product." ";
		}
		
		if($declared_by !='')
		{
			if($condition != ""){
				$condition.=" AND created_by = '".$declared_by."'";
			}
			else{
				$condition.="created_by = '".$declared_by."'";
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
		$query = $this->db->order_by('id', 'desc')->group_by('product_preparation', 'desc')->limit($limit, $start)->where($where_array )->get('product_ingredients'); 
		
        return $query;
	}
	
	
	//
	
	//Assigned PAcking 
	
	 public function assigned_packListCount() {
        $query = $this->db->count_all_results('product_assign_packing');
        return $query;
    }

    public function assigned_packList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       
		$currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83'|| $currentUser == '85') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('product_assign_packing');
            return $query;
        } else {
            $table_name = 'product_assign_packing';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }

	// assigned Packing Search
	
		public function assigned_packing_list($limit = 0, $start = 0 ,$product,$declared_by){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		
		$condition="";
		if($product !='')
		{
			$condition.=" product_id  = ".$product." ";
		}
		
		if($declared_by !='')
		{
			if($condition != ""){
				$condition.=" AND assigned_to_name = '".$declared_by."'";
			}
			else{
				$condition.="assigned_to_name = '".$declared_by."'";
			}
		}
	
					
		if($condition !='')
		{
			$where_array =$condition;
		}
		//$where_array =" product_preparation = 1";
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('product_assign_packing'); 
		
        return $query;
	}
	
	
	
	/*==========Assigned products search ===================================*/
	public function assigned_product_list($limit = 0, $start = 0 ,$product,$declared_by){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		
		$condition="";
		if($product !='')
		{
			$condition.=" product_id  = ".$product." ";
		}
		
		if($declared_by !='')
		{
			if($condition != ""){
				$condition.=" AND store_id = '".$declared_by."'";
			}
			else{
				$condition.="store_id = '".$declared_by."'";
			}
		}
	
					
		if($condition !='')
		{
			$where_array =$condition;
		}
		//$where_array =" product_preparation = 1";
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get('product_assign'); 
		
        return $query;
	}
	
	/*=============================================*/
	//used product Ingredients
	/*=============================================*/
	  public function product_used_prepListCount() {
        $query = $this->db->count_all_results('product_ingredients_used');
        return $query;
    }

    public function product_used_prepList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = $user_info['role'];

		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		$rolename   = singleDbTableRow($user_id)->rolename;
		
		
        if ($rolename == '11' OR $rolename == '82' OR $rolename == '83' OR $rolename == '84') {	
		
            $query = $this->db->order_by('id', 'desc')->group_by('unique_preparation', 'desc')->limit($limit, $start)->get('product_ingredients_used');
            return $query;
        } else {
            $table_name = 'product_ingredients_used';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->group_by('unique_preparation', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }

	// Assigned products
	
	
		  public function product_assignedListCount() {
        $query = $this->db->count_all_results('product_assign');
        return $query;
    }

    public function product_assignedList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('product_assign');
            return $query;
        } else {
            $table_name = 'product_assign';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }

	
	
	/*=============================================*/
	//searching used Products
		public function searchproduct_used_prepListcount($product,$used_by,$sf_time,$st_time,$sf_time1,$st_time1)
	{
		
			$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
		
		
		
		$condition="";
		if($product !='')
		{
			$condition.=" product = ".$product." ";
		}
		
		if($used_by !='')
		{
			if($condition != ""){
				$condition.=" AND created_by = '".$used_by."'";
			}
			else{
				$condition.="created_by = '".$used_by."'";
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
				
				$condition.=" AND DATE(exp_date) >= '".$start_from."' AND DATE(exp_date) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(exp_date) >= '".$start_from."' AND DATE(exp_date) <= '".$start_to."'";
			}
		}
		
		/*  manufacturing date */
			if($sf_time1 !='' && $st_time1 !='')
			{
				$start_fdt1 = new DateTime($sf_time1);
				$start_from1 = $start_fdt1->format('Y-m-d');
				
				$start_tdt1 = new DateTime($st_time1);
				$start_to1 = $start_tdt1->format('Y-m-d');
			}
		
		if($sf_time1 !='' && $st_time1 !=''){
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from1."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to1."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) >= '".$start_from1."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to1."'";
			}
		}
				
		/*  manufacturing date */
		
		
				
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->where($where_array)->count_all_results('product_ingredients_used');
		}
		else
		{
			$query = $this->db->count_all_results('product_ingredients_used');
		}
		
        return $query;
	
	}
	//searching List	
	public function searchproduct_used_prepList($limit=10, $start=0,$product,$used_by,$sf_time,$st_time,$sf_time1,$st_time1){
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
		$email   = singleDbTableRow($user_id)->email;
		$currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

     
		$condition="";
		if($product !='')
		{
			$condition.=" product = ".$product." ";
		}
		
		if($used_by !='')
		{
			if($condition != ""){
				$condition.=" AND created_by = '".$used_by."'";
			}
			else{
				$condition.="created_by = '".$used_by."'";
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
				
				$condition.=" AND DATE(exp_date) >= '".$start_from."' AND DATE(exp_date) <= '".$start_to."'";
			}
			else{
				$condition.="DATE(exp_date) >= '".$start_from."' AND DATE(exp_date) <= '".$start_to."'";
			}
		}
		
		/*  manufacturing date */
			if($sf_time1 !='' && $st_time1 !='')
			{
				$start_fdt1 = new DateTime($sf_time1);
				$start_from1 = $start_fdt1->format('Y-m-d');
				
				$start_tdt1 = new DateTime($st_time1);
				$start_to1 = $start_tdt1->format('Y-m-d');
			}
		
		if($sf_time1 !='' && $st_time1 !=''){
			if($condition != ""){
				
				$condition.=" AND DATE(FROM_UNIXTIME(created_at)) >= '".$start_from1."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to1."'";
			}
			else{
				$condition.="DATE(FROM_UNIXTIME(created_at)) >= '".$start_from1."' AND DATE(FROM_UNIXTIME(created_at)) <= '".$start_to1."'";
			}
		}
				
		/*  manufacturing date */
		   if ($currentUser == '11'OR $currentUser == '82') {			
		if($condition !='')
		{
			$where_array =$condition;
			$query = $this->db->order_by('id', 'desc')->group_by('unique_preparation', 'desc')->limit($limit, $start)->where($where_array )->get('product_ingredients_used'); 
		}
		   }else{
		//$where_array =" product_preparation = 1";
		$query = $this->db->order_by('id', 'desc')->group_by('unique_preparation', 'desc')->limit($limit, $start)->get('product_ingredients_used'); 
		}
        return $query;
	}
	
    
	
	

	
	
   /*=============================================*/
	//Accounts Listing
	/*=============================================*/
	  public function accounts_ListCount() {
        $query = $this->db->count_all_results('accounts');
        return $query;
    }

    public function accounts_List($limit = 10, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
        $role = $user_info['role'];

		$limit = $this->input->get('length');
		$start = $this->input->get('start');
		
        if ($role == 'admin') {
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('accounts');
            return $query;
        } else {
            $table_name = 'accounts';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	/*================*/
	//account searching
	/*================*/
	
	public function search_accounts_ListCount($limit = 0, $start = 0,$user_id1,$rolename1,$pay_type,$points_mode,$sf_time,$st_time)
	{
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
	$condition="";
		if($user_id1 !='')
		{
			$condition.="user_id = ".$user_id1." ";
		}
		
		if($rolename1 !='')
		{
			if($condition != ""){
				$condition.=" AND rolename = '".$rolename1."'";
			}
			else{
				$condition.="rolename = '".$rolename1."'";
			}
		}
		
		if($pay_type !='')
		{
			if($condition != ""){
				$condition.=" AND pay_type = '".$pay_type."'";
			}
			else{
				$condition.="pay_type = '".$pay_type."'";
			}
		}
		
		if($points_mode !='')
		{
			if($condition != ""){
				$condition.=" AND points_mode = '".$points_mode."'";
			}
			else{
				$condition.="points_mode = '".$points_mode."'";
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
		//$query = $this->db->where($where_array )->get('accounts'); 
		
		 $query = $this->db->where($where_array )->count_all_results('accounts');
        return $query;
    }
	
	
	
	
	
	
	
	public function search_account_List($limit = 0, $start = 0,$user_id1,$rolename1,$pay_type,$points_mode,$sf_time,$st_time){
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$rolename      = singleDbTableRow($user_id)->rolename;
		$email   = singleDbTableRow($user_id)->email;
		
		$condition="";
		if($user_id1 !='')
		{
			$condition.="user_id = ".$user_id1." ";
		}
		
		if($rolename1 !='')
		{
			if($condition != ""){
				$condition.=" AND rolename = '".$rolename1."'";
			}
			else{
				$condition.="rolename = '".$rolename1."'";
			}
		}
		
		if($pay_type !='')
		{
			if($condition != ""){
				$condition.=" AND pay_type = '".$pay_type."'";
			}
			else{
				$condition.="pay_type = '".$pay_type."'";
			}
		}
		
		if($points_mode !='')
		{
			if($condition != ""){
				$condition.=" AND points_mode = '".$points_mode."'";
			}
			else{
				$condition.="points_mode = '".$points_mode."'";
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
		$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array)->get('accounts'); 
		//$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('accounts');
        return $query;
	}
	
	/*================*/
	
	 function get_product_name($category)
    {
      $where_array = array( 'created_by' => $category );
      $table_name="product_ingredients";
       $query = $this->db->group_by('product_preparation')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	

	
	function Prod_type($category)
    {
      $where_array = array( 'id' => $category );
      $table_name="product_preparation";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	
	function get_unk_prep($prod_id)
    {
      $where_array = array( 'unique_preparation' => $prod_id );
      $table_name="product_ingredients_used";
       $query = $this->db->group_by('created_by')->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	
	
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
	

	  /* public function total_packs(){
        $user = loggedInUserData();
        $userID = $user['user_id'];

        //Get Decision who in online?
        if($user['role'] == 'admin')
        {
            $query = $this->db->select_sum('no_ofpiece_small')->get('product_packing'); 
			// $query = $this->db->select_sum('cash')->where('pay_type', 'transfer')->get('ledger'); 
        }
        else
        {
           // $query = $this->db->select_sum('amount')->get_where('earnings', ['user_id' => $userID]); 
			$query = $this->db->select_sum('amount')->get_where('accounts', ['user_id' => $userID]); 
        }

        return $query;
    }
	*/
	// Assign Packing
	
	 public function assign_movement_products() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
     



        //set all data for inserting into database
        $data = [
            'unique_batch'       => $this->input->post('unique_batch'),			
            'product_id'         => $this->input->post('product_id'),			     		     	
            'assigned_role'      => $this->input->post('assigned_role'),			
            'assigned_to_name'   => $this->input->post('assigned_to_name'),			
           
           
		   
            		
            'created_by'          => $user_id,
             'created_at'         => time(),
            'modified_at'         => time(),
            'modified_by'         => $user_id
            
           
        ];

        $query = $this->db->insert('product_movement_assigned', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'product_movement_assigned'); //create an activity
            return true;
        }
        return false;
    }

	  function get_packs($pro)
    {
      $where_array = array( 'packing_category_id' => $pro );
      $table_name="pro_weight_category";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 	
	
	  function get_pack_weight($pro)
    {
      $where_array = array( 'id' => $pro );
      $table_name="pro_weight_category";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	
	
	//Listing Assigned Movement
	
		  public function movementListCount() {
        $query = $this->db->count_all_results('product_movement_assigned');
        return $query;
    }

    public function movementList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' || $currentUser == '83' || $currentUser == '84') {
            $query = $this->db->limit($limit, $start)->get('product_movement_assigned');
            return $query;
        } else {
            $table_name = 'product_movement_assigned';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	
	
	
	//report ware house
	
	
		  public function rep_warehouseListCount() {
        $query = $this->db->count_all_results('inventory_movement');
        return $query;
    }

    public function rep_warehouseList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' ) {
            $query = $this->db->order_by('id','desc')->limit($limit, $start)->get('inventory_movement');
            return $query;
        } else {
            $table_name = 'inventory_movement';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id','desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	
	//listing assigned warehouse
	
	
		  public function warehouseListCount() {
        $query = $this->db->count_all_results('product_warehouse_assigned');
        return $query;
    }

    public function warehouseList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11') {
            $query = $this->db->limit($limit, $start)->get('product_warehouse_assigned');
            return $query;
        } else {
            $table_name = 'product_warehouse_assigned';
            $where_array = array('assigned_to_name' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	
	 function get_mfr_date($pro)
    {
      $where_array = array( 'unique_small' => $pro );
      $table_name="product_packing";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	
	
	function get_quantity($pro)
    {
      $where_array = array( 'unique_small' => $pro );
      $table_name="product_packing";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	
	function get_weight_per_piece($pro)
    {
      $where_array = array( 'unique_small' => $pro );
      $table_name="product_packing";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	
	function get_unique_code($pro)
    {
      $where_array = array( 'unique_small' => $pro );
      $table_name="product_packing";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	
	function get_assigned_by($pro)
    {
      $where_array = array( 'unique_batch' => $pro );
      $table_name="product_movement_assigned";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	
	function get_assigned_by1($pro)
    {
      $where_array = array( 'unique_batch' => $pro );
      $table_name="product_warehouse_assigned";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	
	function get_assigned_to($pro)
    {
      $where_array = array( 'unique_batch' => $pro );
      $table_name="product_movement_assigned";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    }
	
	 public function assign_to_warehouse() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
     



        //set all data for inserting into database
        $data = [
            'unique_batch'       => $this->input->post('unique_batch'),			
            'product_id'         => $this->input->post('product_id'),			     		     	
            'assigned_role'      => $this->input->post('assigned_role'),			
            'assigned_to_name'   => $this->input->post('assigned_to_name'),			
           
           
		   
            		
            'created_by'          => $user_id,
             'created_at'         => time(),
            'modified_at'         => time(),
            'modified_by'         => $user_id
            
           
        ];

        $query = $this->db->insert('product_warehouse_assigned', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'product_warehouse_assigned'); //create an activity
            return true;
        }
        return false;
    }
	
	
	
		 public function assign_to_other_warehouse() {

        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
     



        //set all data for inserting into database
        $data = [
            'unique_batch'       => $this->input->post('unique_batch'),			
            'product_id'         => $this->input->post('product_id'),			     		     	
            'assigned_role'      => $this->input->post('assigned_role'),			
            'assigned_to_name'   => $this->input->post('assigned_to_name'),			
           
           
		   
            		
            'created_by'          => $user_id,
             'created_at'         => time(),
            'modified_at'         => time(),
            'modified_by'         => $user_id
            
           
        ];

        $query = $this->db->insert('product_other_warehouse_assigned', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'product_other_warehouse_assigned'); //create an activity
            return true;
        }
        return false;
    }
	
		    public function add_inventory_movement11() {

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
		$batch_no     = $this->input->post('product_unique_code');
		
	
		
		if  ( $type == 1){
			
		
		$count        = $this->db->count_all_results('inventory_movement');		 
	    $p_count      = $count + 1;
		$sub_batch    = $batch_no.$p_count;
		
		
		}elseif($type == 2)
		{
		
		$sub_batch = $this->input->post('serial_no');

		}
		
			$common_serial     = $sub_batch;
		 
		 	$balance_qty1  	= $this->Product_preparation_model->balance_qty($item , $store_id );
	    
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
            'pieces' 		            => $this->input->post('quantity1'),
            'left_pieces' 		        => $this->input->post('balance_pieces'),
            'weight_pieces' 		    => $this->input->post('net_weight'),
            'brand'                     => $this->input->post('brand'),
            'product_unique_code'       => $batch_no,
            'sub_batchno'               =>$sub_batch,
            'common_serial'             =>$common_serial,
            'product_manufacturing_date'=> $this->input->post('product_manufacturing_date'),
            'exp_date'                  => $this->input->post('product_expiry_date'),
            'price_per_unit'            => $this->input->post('price_per_unit'),
            'quantity'                  => $this->input->post('quantity'),
            'price_of_pieces'           => $this->input->post('price_pieces'),
            //'volume'                  => $this->input->post('volume'),
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
			
            'added_by'                  => $user_id,
            'created_by'                => $user_id,
             'created_at'               => time(),
            'modified_at'               => time(),
            'modified_by'               => $user_id
        ];

        $query = $this->db->insert('inventory_movement', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'inventory_movement'); //create an activity
            return true;
        }
        return false;
    }
	
	
	
	
	
	
	
	
	
	
		
	    public function add_inventory_movement() {

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
		$batch_no     = $this->input->post('product_unique_code');
		
	
		
		if  ( $type == 1){
			
		
		$count        = $this->db->count_all_results('inventory_movement');		 
	    $p_count      = $count + 1;
		$sub_batch    = $batch_no.$p_count;
		
		
		}elseif($type == 2)
		{
		
		$sub_batch = $this->input->post('serial_no');

		}
		
			$common_serial     = $this->input->post('serial_no');
		 
		 	$balance_qty1  	= $this->Product_preparation_model->balance_qty($item , $store_id );
	    
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
            'pieces' 		            => $this->input->post('quantity1'),
            'left_pieces' 		        => $this->input->post('balance_pieces'),
            'weight_pieces' 		    => $this->input->post('net_weight'),
            'brand'                     => $this->input->post('brand'),
            'product_unique_code'       => $batch_no,
            'sub_batchno'               =>$sub_batch,
            'common_serial'             =>$common_serial,
            'product_manufacturing_date'=> $this->input->post('product_manufacturing_date'),
            'exp_date'                  => $this->input->post('product_expiry_date'),
            'price_per_unit'            => $this->input->post('price_per_unit'),
            'quantity'                  => $this->input->post('quantity'),
            'price_of_pieces'           => $this->input->post('price_of_pieces'),
            //'volume'                  => $this->input->post('volume'),
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

        $query = $this->db->insert('inventory_movement', $data);

        if ($query) {
            create_activity('Added ' . $data['created_by'] . 'inventory_movement'); //create an activity
            return true;
        }
        return false;
    }
	
		//Total Balance of Different Stocks By Users
	public function balance_qty($item , $store_id ){
       	
		$table_name = "inventory_movement";		 
		$where_array = array('product'=>$item, 'store_id' =>$store_id);
		$stock_inward = $this->db->select_sum('inward')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $stock_inward->result() 		as $stock_inward);
		$Total_Inward			= $stock_inward->inward;
		
		$table_name = "inventory_movement";		 
		$where_array = array('product'=>$item, 'store_id' =>$store_id);
		$stock_outward = $this->db->select_sum('outward')->where($where_array )->get($table_name); 
			//return $query;
		foreach( $stock_outward->result() 		as $stock_outward);
		$Total_outward			= $stock_outward->outward;
		
		$balance_qty       = ( $Total_Inward - $Total_outward ) ;
		
		return $balance_qty;
		
	
		
    }
	
	//listing assigned warehouse
	
	
		  public function otherwarehouseListCount() {
        $query = $this->db->count_all_results('product_other_warehouse_assigned');
        return $query;
    }

    public function otherwarehouseList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11') {
            $query = $this->db->limit($limit, $start)->get('product_other_warehouse_assigned');
            return $query;
        } else {
            $table_name = 'product_other_warehouse_assigned';
            $where_array = array('assigned_to_name' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	
	
	 function get_button_disabled($batch) {
		 
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        $where_array = array( 'unique_batch' => $batch);
        $table_name = "product_movement_assigned";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return true;
        } else {
            return false;
        }
    }
	
	
	//disable button assigned to main ware house
	
	 function get_button_disabled_asg_main_ware($batch) {
		 
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        $where_array = array( 'unique_batch' => $batch);
        $table_name = "product_warehouse_assigned";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return true;
        } else {
            return false;
        }
    }
	
	//disable button assigned to Other warehouse
	
	 function get_button_disabled_asg_Other_ware($batch) {
		 
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        $where_array = array( 'unique_batch' => $batch);
        $table_name = "product_other_warehouse_assigned";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return true;
        } else {
            return false;
        }
    }
	
	function get_dis_reassign($batch) {
		 
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		
        $where_array = array( 'product_unique_code' => $batch);
        $table_name = "inventory_stocks";
        $query = $this->db->where($where_array)->get($table_name);
        if ($query->num_rows() > 0) {
            //$result = $query->result_array();
            return true;
        } else {
            return false;
        }
    }
	
	//stock available inventory
	
		  public function available_stock_inventoryListCount() {
        $query = $this->db->count_all_results('inventory_stocks');
        return $query;
    }

    public function available_stock_inventoryList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11'|| $currentUser == '82' ) {
            $query = $this->db->order_by('id','desc')->limit($limit, $start)->get('inventory_stocks');
            return $query;
        } else {
            $table_name = 'inventory_stocks';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->order_by('id','desc')->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	
		  function get_assign_movement($prod)
    {
      $where_array = array( 'product' => $prod );
      $table_name="product_packing";
       $query = $this->db->where($where_array )->get($table_name);
        if($query->num_rows() > 0){
            //$result = $query->result_array();
            return $query;
        }else{
            return false;
        }
    } 
	
	 public function mainwarehouseListCount() {
        $query = $this->db->count_all_results('product_warehouse_assigned');
        return $query;
    }

    public function mainwarehouseList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11') {
            $query = $this->db->limit($limit, $start)->get('product_warehouse_assigned');
            return $query;
        } else {
            $table_name = 'product_warehouse_assigned';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	
	
	
	//other warehouse List
	 public function other1warehouseListCount() {
        $query = $this->db->count_all_results('product_other_warehouse_assigned');
        return $query;
    }

    public function other1warehouseList($limit = 0, $start = 0) {
        $user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
       $currentUser   = singleDbTableRow($user_id)->rolename;
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');

        if ($currentUser == '11') {
            $query = $this->db->limit($limit, $start)->get('product_other_warehouse_assigned');
            return $query;
        } else {
            $table_name = 'product_other_warehouse_assigned';
            $where_array = array('created_by' => $user_id);
            $query = $this->db->limit($limit, $start)->where($where_array)->get($table_name);
            return $query;
        }
    }
	
		//add to inventory release stock to main warehouse
	
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
            'product_id' 	                => $this->input->post('product_id'),			
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
	
	
	
	
	
}//last
