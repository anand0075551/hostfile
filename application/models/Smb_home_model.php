<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smb_home_model extends CI_Model {
	
//	$this->load->model('payment_model');
//	$this->load->model('notification_model');

    /**
     * @return bool
     */	

   public function cart_finish(){

		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
   
			
		//Shipping Address
		$shipping_address=array(
				'first_name'	    => $this->input->post('first_name'),
				'last_name'	   		=> $this->input->post('last_name'),
				'mobile'	  	    => $this->input->post('mobile'),
				'zip'	  	    	=> $this->input->post('pincode'),
				'email'	            => $this->input->post('email'),
				'location'	        => $this->input->post('location'),
				'address'	        => $this->input->post('address'),
				'payment_type'	    => 'CPA Deduction',
			);
			
		$cart['items'] = array();
		
		$shipping_cost = 0;
		$tax = 0;
		$sub_total = 0;
		$biz_id = $this->session->userdata('biz_id');
		
		$items = $this->cart->contents();
		
		foreach ($items as $key => $item)
		{
			if($item['biz_id'] == $biz_id){
			//edit by dillip
				$get_weight = $this->db->get_where('smb_product', ['id'=>$item['product_id']]);
				foreach($get_weight->result() as $w);
				
				$total_weight = $w->weight* $item['qty'];
				$total_volume = $w->volume* $item['qty'];
				
				array_push($cart['items'], array(
					'id' 			 => $item['id'],
					'product_id'     => $item['product_id'],
					'name' 			 => $item['name'],
					'qty' 			 => $item['qty'],
					'price' 		 => $item['price'],
					'subtotal'		 => $item['price']*$item['qty'],
					'shipping_cost'  => $item['shipping_cost']*$item['qty'],
					'weight' 		 => $total_weight,
					'volume' 		 => $total_volume,
					'tax'			 => $item['tax']*$item['qty'],
					'rowid'			 => $item['rowid'],
					'vendor'		 => $item['vendor_id'],
					'location'		 => $this->session->userdata('location')
				));
				
			
				$tax			 = $tax + ($item['tax'] * $item['qty']);
				$shipping_cost 	 = $shipping_cost + ($item['shipping_cost'] * $item['qty']);			
				$sub_total 		 = $sub_total + ($item['price'] * $item['qty']);			
			}
		}
		
		$cart['shopping_cart'] = array(
			'items'	 		   => $cart['items'],
			'shipping_cost'    => $shipping_cost,
			'tax' 			   =>$tax,
		);

		$cart['shopping_cart']['subtotal'] = $sub_total;
		
		$cart['shopping_cart']['grand_total'] =
			$cart['shopping_cart']['subtotal'] +
			$cart['shopping_cart']['shipping_cost'] +
			$cart['shopping_cart']['tax'];
		
		
		
		$get_points_mode = $this->db->get_where('business_groups', ['id'=>$biz_id]);
		if($get_points_mode->num_rows() > 0){
			foreach($get_points_mode->result() as $p_mode);
			if($p_mode->points_mode != ''){
				if($p_mode->points_mode == 'wallet'){
					$points_mode = $p_mode->points_mode;
					$currency = "CPA Deduction";
				}
				if($p_mode->points_mode == 'loyality'){
					$points_mode = $p_mode->points_mode;
					$currency = "LPA Deduction";
				}
				if($p_mode->points_mode == 'voucher'){
					$points_mode = "wallet";
					$currency = "Voucher Payment";
				}
			}
			else{
				$points_mode = "wallet";
				$currency = "CPA Deduction";
			}
		}
		
		
        //set all data for inserting into database
        $data = [
			'product_details'			=> json_encode($cart['items']),
            'shipping_address'          => "[".json_encode($shipping_address)."]",
            'vat'         			    => $cart['shopping_cart']['tax'],
            'vat_percent'         		=> " ",
            'shipping'         			=> $cart['shopping_cart']['shipping_cost'],
            'payment_type'         		=> $currency,
            'voucher_amount'         	=> number_format($this->input->post('voucher_total_amount'),2),
            'paybal_amount'         	=> number_format($this->input->post('paybal_amount'),2),
            'payment_details'         	=> ' ',
            'grand_total'         		=> $cart['shopping_cart']['grand_total'],
            'buyer'          	        => $user_id,
            'business'          	    => $biz_id,
            'sale_datetime'             => time()
			];
		
	
		
        $query = $this->db->insert('smb_sale', $data);
		
		$sale_id = $this->db->insert_id();
		
		
		$data['sale_code'] = date('Ym', $data['sale_datetime']) . $sale_id;
		$consignment_no = date('Ym', $data['sale_datetime']) . $sale_id;
		$data['delivery_status'] = 'pending';
		$data['payment_status'] = 'paid';
		$this->db->where('id', $sale_id);
		$this->db->update('smb_sale', $data);

		
			
		
		
		$this->session->set_userdata('id', $sale_id);
		
		$location = $this->session->userdata('location');
		
	    $items = $this->cart->contents();
		
		$all_products = "";
		
		foreach ($items as $key => $item)
		{
			if($item['biz_id'] == $biz_id){
				$price = $item['price'];
				$total = $item['qty'] * $item['price'];
				
				$query = $this->db->get_where('smb_product',['id'=>$item['product_id']]);
				foreach($query->result() as $p){
					$category = $p->category;
					$sub_category = $p->sub_category;
				}
				
				$get_tax = $this->db->get_where('smb_stock',['product'=>$item['product_id'], 'type'=>'add']);
				foreach($get_tax->result() as $t);
				
				$product 	= $item['product_id'];
				$vendor 	= $item['vendor_id'];
				$location 	= $location;
				$qty		= $item['qty'];
				
				$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$product, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor]);
				foreach($get_added_stock->result() as $added_stock);
				$total_added = $added_stock->quantity;
			
				$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$product, 'location'=>$location, 'type'=>'sold', 'added_by'=>$vendor]);
				foreach($get_sold_stock->result() as $sold_stock);
				$total_sold = $sold_stock->quantity;
			
				$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$product, 'location'=>$location, 'type'=>'destroy', 'added_by'=>$vendor]);
				foreach($get_destroyed_stock->result() as $destroyed_stock);
				$total_destroyed = $destroyed_stock->quantity;
			
				$av_stock1 = $total_added-($total_sold+$total_destroyed);
				
				$current_stock1 = $av_stock1 - $qty;
				
				$all_products .= $item['name'].", ";
				
				$query2=$this->db->insert('smb_stock', array(
						'active' 		 => '1',
						'product' 		 => $item['product_id'],
						'sale_price' 	 => $price,
						'total' 		 => $total,
						'sp_tax1' 		 => $t->sp_tax1,
						'sp_tax2' 		 => $t->sp_tax2,
						'sp_tax3' 		 => $t->sp_tax3,
						'sp_tax4' 		 => $t->sp_tax4,
						'sp_tax5' 		 => $t->sp_tax5,
						'pp_tax1' 		 => $t->pp_tax1,
						'pp_tax2' 		 => $t->pp_tax2,
						'pp_tax3' 		 => $t->pp_tax3,
						'pp_tax4' 		 => $t->pp_tax4,
						'pp_tax5' 		 => $t->pp_tax5,
						'shipping_cost'  => $item['shipping_cost'],
						'tax'  			 => $item['tax_percent'],
						'tax_value'  	 => $item['tax'],
						'category' 		 => $category,
						'sub_category' 	 => $sub_category,
						'type' 			 => 'sold',
						'quantity' 		 => $item['qty'],
						'current_stock'  =>	$current_stock1,
						'added_by' 		 => $item['vendor_id'],
						'location' 		 => $location,
						'business_types' =>	$biz_id,
						'datetime' 	 	 => time(),
						'modified_at' 	 => time(),
						'modified_by' 	 => $user_id
					));
				$this->db->where(['product'=>$product, 'location'=>$location, 'added_by'=>$vendor, 'type'=>'add'])->update('smb_stock', ['current_stock'=>$current_stock1]);
			}
		}
		
		//get pay_type
		$get_pay_type = $this->db->get_where('business_groups', ['id'=>$biz_id]);
		if($get_pay_type->num_rows() > 0){
			foreach($get_pay_type->result() as $p);
			$payment_reciever = $p->payment_reciever;
			$pay_acc_type = $p->pay_type;
		}
		else{
			$payment_reciever = "5382610497";
			$pay_acc_type = "66";
		}
		
		$tranx_remark = "For Sale Code-".$data['sale_code'];
		
		$grand_total = $this->input->post('paybal_amount');
		//loged user details
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$user_data 				 = $this->db->get_where('users',array('id'=>$user_id))->row(); 
		$referral_code   		 = $user_data->referral_code;
		
		//payment_model
		
		if($currency != "Voucher Payment"){
			$pay_by_referral_code 	= 	$referral_code ;		// Sender's referral_code, ex : 5559990001
			$pay_to_referral_code 	= 	$payment_reciever;			// Receiver's referral_code, ex : 5164830972
			$amount_to_pay		  	=	$grand_total;			// Total amont to pay (or) transfer, ex : 100
			$pay_spec_type			=	$pay_acc_type;			// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
			$transaction_remarks	=	'Purchase of Products From <b>'.singleDbTableRow($biz_id, 'business_groups')->business_name.'</b><br><b>Products</b> : '.$all_products.'<br><b>Vouchers Used</b> : '.$this->input->post('all_vouchers');	
			$pm_mode				=	$points_mode;				// points_mode, ex : wallet, loyality, discount.
			
			
			$insert = $this->smb_payment_model->make_my_payment($pay_by_referral_code, $pay_to_referral_code, $amount_to_pay, $pay_spec_type, $transaction_remarks, $pm_mode,$tranx_remark);
		}
		
		$total_voucher_amount = $this->input->post('voucher_total_amount');
		
		//Voucher payment_model
		$pay_by_referral_code_v 	= 	'5917428036' ;			// Sender's referral_code, ex : 5917428036
		$pay_to_referral_code_v 	= 	$payment_reciever;			// Receiver's referral_code, ex : 5164830972
		$amount_to_pay_v		  	=	$total_voucher_amount;	// Total voucher amont to pay (or) transfer, ex : 100
		$pay_spec_type_v			=	$pay_acc_type;			// Pay Type, ex : 66(SMB Consumer to Company), 73("CMS" Consumer to Company)
		$transaction_remarks_v 		=	'Purchase of Products From <b>'.singleDbTableRow($biz_id, 'business_groups')->business_name.'</b><br><b>Products</b> : '.$all_products.'<br><b>Vouchers Used</b> : '.$this->input->post('all_vouchers');	
		$pm_mode_v					=	$points_mode;				// points_mode, ex : wallet, loyality, discount.
		
		
		$insert2 = $this->smb_payment_model->make_my_payment($pay_by_referral_code_v, $pay_to_referral_code_v, $amount_to_pay_v, $pay_spec_type_v, $transaction_remarks_v, $pm_mode_v,$tranx_remark);
		
		$get_voc_user = $this->db->get_where('users', ['referral_code'=>$payment_reciever]);
		if($get_voc_user->num_rows() > 0){
			foreach($get_voc_user->result() as $vu);
			$voc_user = $vu->id;
		}
		
		$data2 = [
				'used'					=> 'yes',
				'used_by'				=> $voc_user,
				'used_for'				=> $data['sale_code'],
				'reserved'				=> 'yes',
				'reserved_at'           => time(), 
				'reserved_by'           => $user_id
				];
			$voucher_id   = $this->input->post('all_vouchers');

			$test = explode(',' , $voucher_id);
			foreach($test as $test2)
			{
			$query3 = $this->db->where('voucher_id', $test2)->update('vouchers', $data2);
			}
		
		
	
			
				
        if($query && $query2 && $query3 && $insert2)
        {
			foreach ($items as $key => $item){
				if($item['biz_id'] == $biz_id){
					$this->cart->update(array('rowid' => $item['rowid'] , 'qty' => 0));
				}
			}
			
			$this->session->set_flashdata('successMsg', 'Thank You For Purchase');
			redirect(base_url('shopping_cart/full_invoice/'.$sale_id));
            return true;
        }
        return false;	
	}
}