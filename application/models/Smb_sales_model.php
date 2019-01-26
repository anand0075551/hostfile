<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smb_sales_model extends CI_Model {

    

  public function all_sales_ListCount(){
		
		$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;
		
		 if ($currentUser == 'admin')
		{
			$query = $this->db->count_all_results('smb_sale');
		}
		else{
			$query = $this->db->count_all_results('smb_sale');	
		}
        return $query;
    }
		
    public function sale_List($limit = 0, $start = 0)
	{		
		$search = $this->input->get('search');	
		$searchValue = $search['value'];

		$searchByID = '';				
		$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$currentUser = singleDbTableRow($user_id)->role;
		$rolename    = singleDbTableRow($user_id)->rolename;
		$email   	 = singleDbTableRow($user_id)->email;
		
		
		 if ($currentUser == 'admin')
		{
		if($searchValue != '')																							
			{																												
				$table_name = "smb_sale";	
				$where_array = array('sale_code' => $searchValue );					
				  $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->where($where_array )->get($table_name); 	
			}											
			else{										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_sale');
			}
		}
		else{
			if($searchValue != '')																							
			{					
			$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get_where('smb_sale', ['sale_code' => $searchValue]); 
			}											
			else{										
				$query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get('smb_sale'); 
			}
		}
		
		
        return $query;
    }
		
	public function add_shipment($id, $amnt, $qty, $weight , $volume){
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$vendor_id = $user_id;
					
		$query = $this->db->get_where('users',['id'=>$vendor_id]);
		foreach($query->result() as $user);
		
		
			// Shipper Informations
			$shipper_name	 	= $vendor_id;
			
			$get_shipper_info = $this->db->get_where('user_address',['user_id'=>$shipper_name, 'address_type'=>'Permanent']);
			if($get_shipper_info->num_rows() > 0){
				foreach($get_shipper_info->result() as $s);
					$shipper_pincode = $s->pincode;
					$shipper_address = $s->house_buildingno.', '.$s->street_name.', '.$s->location_id.', '.$s->district;
			}
			else{
				$shipper_pincode = '';
				$shipper_address = '';
			}
			
			$shipper_phone		= $user->contactno;
		
			if($shipper_pincode != ""){
				$query = $this->db->get_where('pincode', ['pincode'=>$shipper_pincode]);
				if($query->num_rows()>0){
					foreach($query->result() as $pin_id);
					$pin_id = $pin_id->id;
				}
				else{
					$pin_id = "";
				}
			}
			else{
				$pin_id = "";
			}
				
			// receiver Information
			$get_receiver = $this->db->get_where('smb_sale', ['sale_code'=>$id]);
			foreach($get_receiver->result() as $r);
			$receiver_id = $r->buyer;
			$biz_id = $r->business;
			
			
			$receiver_name		= singleDbTableRow($receiver_id)->first_name." ".singleDbTableRow($receiver_id)->last_name;
			$receiver_phone		= singleDbTableRow($receiver_id)->contactno;
			
			$get_receiver_info = $this->db->get_where('user_address',['user_id'=>$receiver_id, 'address_type'=>'Permanent']);
			if($get_receiver_info->num_rows() > 0){
				foreach($get_receiver_info->result() as $recv);
					$receiver_pincode = $recv->pincode;
					$receiver_address = $recv->house_buildingno.', '.$recv->street_name.', '.$recv->location_id.', '.$recv->district;
			}
			else{
				$receiver_pincode = '';
				$receiver_address = '';
			}
			
			if($receiver_pincode != ""){
				$query2 = $this->db->get_where('pincode', ['pincode'=>$receiver_pincode]);
				if($query2->num_rows()>0){
					foreach($query2->result() as $recv_pin_id);
					$receiver_pin_id = $recv_pin_id->id;
				}
				else{
					$receiver_pin_id = "";
				}
			}
			else{
				$receiver_pin_id = "";
			}
					
		
			$type = 'Parcel';
			$book_mode = 'Paid';
			$mode = 'Road';
			$cost = $amnt;
			$status = "18"; //Newly Added Shipment
			$book_date = date('Y-m-d');
			$created_by = $shipper_name; 
			
					
			
			$cons_no = 'SMB'.$vendor_id.$id;
			
			$my_coueier = [
				'cons_no'      			=> $cons_no,	// Consignment number : cancated string of SMB,vendor_id,sale_code
				'ship_name'      		=> $shipper_name,      
				'phone'      			=> $shipper_phone,      
				'shipper_pincode'      	=> $pin_id,      
				's_add'      			=> $shipper_address,      
				'rev_name'      		=> $receiver_name,      
				'r_phone'      			=> $receiver_phone,      
				'receiver_pincode'      => $receiver_pin_id,      
				'r_add'      			=> $receiver_address,      
				'type'      			=> $type,      
				'cost'      			=> $cost,      
				'weight'      			=> '0',      
				'smb_volume'      		=> $volume,      
				'smb_weight'      		=> $weight,      
				'invice_no'      		=> $id,      
				'qty'		      		=> $qty,      
				'book_mode'		      	=> $book_mode,      
				'freight'		      	=> '0',      
				'mode'		      		=> $mode,      
				'status'		      	=> $status,      
				'book_date'		      	=> $book_date,      
				'created_by'		    => $created_by,     
				'business_group'		=> $biz_id,  
			];

			$add_courier = $this->db->insert('cms_courier', $my_coueier);
				
				$my_coueier2 = [
					'cons_no'      			=> $cons_no,      
					'current_pincode'      	=> $pin_id,      
					'receiver_pincode'      => $receiver_pincode,      
					'current_location'     	=> $shipper_address,           
					'receiver_location'     => $receiver_address, 
					'status'				=> $status,
					'modified_at'			=> time(),
					'done_by'				=> $created_by,
				];

			$add_courier_status = $this->db->insert('cms_courier_status', $my_coueier2);
			
		if($add_courier && $add_courier_status){
			return $cons_no;
		}
		
	}
    
}