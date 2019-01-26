<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class shopping_cart extends CI_Controller {
		
	function __construct(){
		parent:: __construct();
		$this->load->model('Smb_home_model');
		$this->load->model('smb_payment_model');
		$this->load->model('notification_model');

		check_auth(); //check is logged in.
	}

	//Prduct Added to the cart 
	public function add_to_cart()
	{
		$biz_id = $this->session->userdata('biz_id');
		$location = $this->session->userdata('location');
		
		$id = $this->input->post('id');
		$vendor = $this->input->post('vendor');
		
		$get_stock_index = $this->db->order_by('id','desc')->limit(1,0)->get_where('smb_stock',['product'=>$id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor]);
		if($get_stock_index->num_rows() > 0){
			foreach($get_stock_index->result() as $s){
				$index_id = $s->id;
			}
		}
		$title = $this->input->post('title');
		$data = array(
               'id'      			=> $index_id,
			   'product_id'      	=> $id,
			   'biz_id'				=> $biz_id,
               'qty'    			=> $this->input->post('quantity'),
               'price'   			=> $this->input->post('sale_price'),
			   'stock'			   	=> $this->input->post('current_stock'),
               'tax'   				=> $this->input->post('tax'),
			   'tax_percent'   		=> $this->input->post('tax_percent'),
               'shipping_cost'   	=> $this->input->post('shipping_cost'),
               'thumb'   			=> $this->input->post('thumb'),
               'vendor_id'   		=> $vendor,
               'name'    			=> $this->input->post('title')
            );
		$this->cart->insert($data);
		$this->session->set_flashdata('successMsg', ''.$title.' Added To Your Cart.');
		redirect(base_url('smb_home/product_font_view?product='.$id.'&vendor_id='.$vendor));
	}
		
	//Cart Checkout View Page
	public function cart_check_out()
	{
		if($this->input->post())
		{
			
			if($this->input->post('submit') != 'check_item') die('Error! sorry');
			
			
				$this->Smb_home_model->cart_finish();
			
		}
		
		$this->data['cart'] = $this->session->userdata('shopping_cart');
		
		$biz_id = $this->session->userdata('biz_id');
		$get_points_mode = $this->db->get_where('business_groups', ['id'=>$biz_id]);
		
		if($get_points_mode->num_rows() > 0){
			foreach($get_points_mode->result() as $p_mode);
			if($p_mode->points_mode == 'voucher'){
				theme('express_checkout', $this->data);
			}
			else{
				theme('cart_check_out', $this->data);
			}
		}
		else{
			theme('cart_check_out', $this->data);
		}
		
		
		
	}
	//Product Remove
	public function del()
	{
		$id = $_GET['id'];
		
		$this->cart->update(array('rowid' => $id , 'qty' => 0));
		redirect(base_url('shopping_cart/cart_check_out'));
	}
	
	//add to cart for front view product
	public function front_to_cart()
	{
		
		$location = $this->session->userdata('location');
		
		$biz_id = $this->session->userdata('biz_id');
				
		$product_id 	= $_GET['product_id'];
		$vendor_id 		= $_GET['vendor_id'];
		$category 		= $_GET['category'];
		$sub_category 	= $_GET['sub_category'];
		$tag 			= $_GET['tag'];
		$price_range	= $_GET['price_range'];
		$page 			= $_GET['p'];
		$pincode 		= $_GET['pincode'];
		$vendor 		= $_GET['vendor'];
		
		$get_stock_index = $this->db->order_by('id','desc')->limit(1,0)->get_where('smb_stock',['product'=>$product_id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor_id]);
		if($get_stock_index->num_rows() > 0){
			foreach($get_stock_index->result() as $s){
				$index_id = $s->id;
			}
		}
		
		$data = $this->db->get_where('smb_product', ['id' => $product_id]);
		foreach($data->result() as $p){
			$id = $p->id;
			$title = $p->title;
			$thumb = $p->main_image;
			$quantity = 1;
			
			$get_details = $this->db->order_by('id','asc')->get_where('smb_stock', ['product'=>$id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor_id]);
			foreach($get_details->result() as $v);
			
			$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor_id]);
			foreach($get_added_stock->result() as $added_stock);
			$total_added = $added_stock->quantity;
			
			$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$id, 'location'=>$location, 'type'=>'sold', 'added_by'=>$vendor_id]);
			foreach($get_sold_stock->result() as $sold_stock);
			$total_sold = $sold_stock->quantity;
			
			
			$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$id, 'location'=>$location, 'type'=>'destroy', 'added_by'=>$vendor_id]);
			foreach($get_destroyed_stock->result() as $destroyed_stock);
			$total_destroyed = $destroyed_stock->quantity;
			
			$av_stock = $total_added-($total_sold+$total_destroyed);
			
			if($this->cart->contents()){
				foreach ($this->cart->contents() as $items){
					if($index_id==$items['id']){
						$current_qty = $items['qty'];
					}
					else{
						$current_qty = 0;
					}
				}
			}
			else{
				$current_qty = 0;
			}
			
			$stock = $av_stock-$current_qty;
			if($stock>0){
				$new_qty = 1;
			}
			else{
				$new_qty = 0;
				$this->session->set_flashdata('errorMsg', 'Sorry..! This Product is Out of Stock.');
			}
			
			
			$shipping_cost	= $v->shipping_cost;
			//$current_stock	= $v->current_stock;
			
			
			$tax_rupee = $v->tax_type;//tax with rupee
			$tax_discount = ($v->sale_price/100)*$v->tax;//tax with rupee
			$tax_percent = $v->tax;
			if($tax_rupee == "rupee")
			{
				$tax = $v->tax;
			}
			else
			{
				$tax = $tax_discount;
			}
			
			$type=$v->discount_type;
			$rupee= $v->sale_price - $v->discount;//with Rupee
			$discount=($v->sale_price/100)*$v->discount;// with Discount
			if($type == "rupee")
			{
				$sale_price = $rupee;
			}
			else
			{
				$sale_price = $v->sale_price - $discount;
			}
			
			//$tax = $p->tax;
		}
		
		
		$data = array(
               'id'      			=> $index_id,
               'product_id'      	=> $product_id,
			   'biz_id'				=> $biz_id,
               'qty'    			=> $new_qty,
               'price'   			=> $sale_price,
             // 'stock'			   	=> $current_stock,
               'tax'   				=> $tax,
               'tax_percent'   		=> $tax_percent,
               'shipping_cost'   	=> $shipping_cost,
               'thumb'   			=> $thumb,
               'vendor_id'   		=> $vendor_id,
               'name'    			=> $title
            );
			
		$this->cart->insert($data);
		$this->session->set_flashdata('successMsg', ''.$title.' Added To Your Cart.');
		redirect(base_url('smb_home?p='.$page.'&location='.$location.'&biz_id='.$biz_id.'&category='.$category.'&sub_category='.$sub_category.'&tag='.$tag.'&price_range='.$price_range.'&pincode='.$pincode.'&vendor='.$vendor));
	}
	
	public function full_invoice($id){
		
		//$sale_id = $_GET['id'];
	
		$data['invoiceQuery'] = $this->db->get_where('smb_sale', ['id' => $id]);
		theme('smb_full_invoice', $data);
	}
	
	
	//Increase Product Quantity In Stock
	public function increase_qty()
	{
		
		$location = $this->session->userdata('location');
		
		$biz_id = $this->session->userdata('biz_id');
				
		$product_id = $_GET['product_id'];
		$vendor_id = $_GET['vendor_id'];
		
		
		$get_stock_index = $this->db->order_by('id','desc')->limit(1,0)->get_where('smb_stock',['product'=>$product_id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor_id]);
		if($get_stock_index->num_rows() > 0){
			foreach($get_stock_index->result() as $s){
				$index_id = $s->id;
			}
		}
		
		$data = $this->db->get_where('smb_product', ['id' => $product_id]);
		foreach($data->result() as $p){
			$id = $p->id;
			$title = $p->title;
			$thumb = $p->main_image;
			$quantity = 1;
			
			$get_details = $this->db->order_by('id','asc')->get_where('smb_stock', ['product'=>$id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor_id]);
			foreach($get_details->result() as $v);
			
			
			$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor_id]);
			foreach($get_added_stock->result() as $added_stock);
			$total_added = $added_stock->quantity;
			
			$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$id, 'location'=>$location, 'type'=>'sold', 'added_by'=>$vendor_id]);
			foreach($get_sold_stock->result() as $sold_stock);
			$total_sold = $sold_stock->quantity;
			
			
			$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$id, 'location'=>$location, 'type'=>'destroy', 'added_by'=>$vendor_id]);
			foreach($get_destroyed_stock->result() as $destroyed_stock);
			$total_destroyed = $destroyed_stock->quantity;
			
			$av_stock = $total_added-($total_sold+$total_destroyed);
			if($this->cart->contents()){
				foreach ($this->cart->contents() as $items){
					if($index_id==$items['id']){
						$current_qty = $items['qty'];
					}
					else{
						$current_qty = 0;
					}
				}
			}
			else{
				$current_qty = 0;
			}
			$stock = $av_stock-$current_qty;
			if($stock>0){
				$new_qty = 1;
			}
			else{
				$new_qty = 0;
				$this->session->set_flashdata('errorMsg', 'Sorry..! This Product is Out of Stock.');
			}
			
			
			
			$shipping_cost	= $v->shipping_cost;
			//$current_stock	= $v->current_stock;
			
			
			$tax_rupee = $v->tax_type;//tax with rupee
			$tax_discount = ($v->sale_price/100)*$v->tax;//tax with rupee
			$tax_percent = $v->tax;
			if($tax_rupee == "rupee")
			{
				$tax = $tax_rupee;
			}
			else
			{
				$tax = $tax_discount;
			}
			
			$type=$v->discount_type;
			$rupee= $v->sale_price - $v->discount;//with Rupee
			$discount=($v->sale_price/100)*$v->discount;// with Discount
			if($type == "rupee")
			{
				$sale_price = $rupee;
			}
			else
			{
				$sale_price = $v->sale_price - $discount;
			}
			
			//$tax = $p->tax;
		}
		
		
		$data = array(
               'id'      			=> $index_id,
               'product_id'      	=> $product_id,
			   'biz_id'				=> $biz_id,
               'qty'    			=> $new_qty,
               'price'   			=> $sale_price,
            // 'stock'			   	=> $current_stock,
               'tax'   				=> $tax,
			   'tax_percent'   		=> $tax_percent,
               'shipping_cost'   	=> $shipping_cost,
               'thumb'   			=> $thumb,
               'vendor_id'   		=> $vendor_id,
               'name'    			=> $title
            );
			
		$this->cart->insert($data);
		
		redirect(base_url('shopping_cart/cart_check_out'));
	}
	
	//Decrease Product Quantity In Stock
	public function decrease_qty()
	{
		
		$location = $this->session->userdata('location');
		
		$biz_id = $this->session->userdata('biz_id');
				
		$product_id = $_GET['product_id'];
		$vendor_id = $_GET['vendor_id'];
		
		$old_qty = $_GET['qty'];
		if($old_qty==1){
			$new_qty = 0;
		}
		else{
			$new_qty = -1;
		}
		
		
		$get_stock_index = $this->db->order_by('id','desc')->limit(1,0)->get_where('smb_stock',['product'=>$product_id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor_id]);
		if($get_stock_index->num_rows() > 0){
			foreach($get_stock_index->result() as $s){
				$index_id = $s->id;
			}
		}
		
		$data = $this->db->get_where('smb_product', ['id' => $product_id]);
		foreach($data->result() as $p){
			$id = $p->id;
			$title = $p->title;
			$thumb = $p->main_image;
			$quantity = 1;
			
			$get_details = $this->db->order_by('id','asc')->get_where('smb_stock', ['product'=>$id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor_id]);
			foreach($get_details->result() as $v);
			
			$shipping_cost	= $v->shipping_cost;
			//$current_stock	= $v->current_stock;
			
			
			$tax_rupee = $v->tax_type;//tax with rupee
			$tax_discount = ($v->sale_price/100)*$v->tax;//tax with rupee
			$tax_percent = $v->tax;
			if($tax_rupee == "rupee")
			{
				$tax = $tax_rupee;
			}
			else
			{
				$tax = $tax_discount;
			}
			
			$type=$v->discount_type;
			$rupee= $v->sale_price - $v->discount;//with Rupee
			$discount=($v->sale_price/100)*$v->discount;// with Discount
			
			if($type == "rupee")
			{
				$sale_price = $rupee;
			}
			else
			{
				$sale_price = $v->sale_price - $discount;
			}
			
			//$tax = $p->tax;
		}
		
		
		$data = array(
               'id'      			=> $index_id,
               'product_id'      	=> $product_id,
			   'biz_id'				=> $biz_id,
               'qty'    			=> $new_qty,
               'price'   			=> $sale_price,
              //'stock'			   	=> $current_stock,
               'tax'   				=> $tax,
			   'tax_percent'   		=> $tax_percent,
               'shipping_cost'   	=> $shipping_cost,
               'thumb'   			=> $thumb,
               'vendor_id'   		=> $vendor_id,
               'name'    			=> $title
            );
			
		$this->cart->insert($data);
		
		redirect(base_url('shopping_cart/cart_check_out'));
	}
}