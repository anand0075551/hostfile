<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Smb_allreports extends CI_Controller {
	
	function __construct(){
		parent:: __construct();
		$this->load->model('Smb_allreports_model');

		check_auth(); //check is logged in.
	}
	
	

public function smb_sales_report()
{
	theme('smb_sales_report');
}
	
public function smb_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
	    $role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$sale_code	 = $_POST['sale_code'];
		$sf_date     = $_POST['sf_date'];
		$st_date     = $_POST['st_date'];
		$product 	 = $_POST['product'];
		$location 	 = $_POST['location'];
		
		
		if($currentUser == 'admin')
			{
				$vendor = $_POST['vendor'];
			}
		else
			{	
				$vendor = $user_id;
			}
			
		$limit = $this->input->POST('length');
		$start = $this->input->POST('start');


		$queryCount = $this->Smb_allreports_model->accounts_ListCount($sale_code, $sf_date, $st_date, $product, $location,$vendor);
		 

		$query = $this->Smb_allreports_model->search_account_List($limit, $start , $sale_code, $sf_date, $st_date, $product, $location,$vendor);
		
			
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
	
			$button = '';
			$button .= '<a class="btn btn-primary btn-sm" href="'.base_url('smb_sales/vendor_invoice/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
				
				
				//json decode part
				$vendor_id		     = "";	
				$location			 = "";	
				$product_name		 = "";	
				$quantity		     = "";	
				$sale_price		     = "";	
				$tax_amnt		     = "";	
				$shipping_amt		 = "";	
					
				$product_details = json_decode($r->product_details, true);
					$product_price = 0;
					$tax = 0;
					$total = 0;
					$shipping = 0;
					
				foreach($product_details as $p){
					
					$vendor_id       .= $p['vendor'].", ";
					$location         = $p['location'].", ";
					$product_name	 .= $p['name'].", <hr>";
					$quantity 		 .= $p['qty'].", <hr>";
					$sale_price 	 .= number_format($p['subtotal'],2).", <hr>";
					$tax_amnt        .= number_format($p['tax'],2).", <hr>";
				    $shipping_amt    .= $p['shipping_cost']."<hr>";
					
					$product_price  += $p['subtotal'];
					$tax            += $p['tax'];
					$shipping       += $p['shipping_cost'];
				}
				
				$total  = $product_price+$tax+$shipping;
				
				//vender firm name
				$vendor="";
				if($vendor_id !=""){
					$vendor_name = explode("," , $vendor_id);
					foreach($vendor_name as $v_id){
						$query3 = $this->db->order_by('company_name')->get_where('users', ['id'=>$v_id]);	
						foreach($query3->result() as $vr)
						{
							$vendor.= $vr->company_name.", <hr>";
						}	
					}
				}
				else{
					$vendor = "";
				}
				
				//for location name
				$get_loc = $this->db->get_where('location_id', ['id'=>$location]);
				foreach($get_loc->result() as $l);
				$location_name = $l->location;
				
				
				$query1 = $this->db->get_where('users', ['id'=>$r->buyer]);	
				foreach($query1->result() as $d);
				$buyer_name = $d->first_name." ".$d->last_name;
				$buyer_ph = $d->contactno;
				
				
				$data['data'][] = array(
					$button,
					date('d-m-Y', $r->sale_datetime),					
					$r->sale_code,
					$vendor,
					$location_name,
					$buyer_ph,
					$buyer_name,
					$product_name,
					$quantity,
					$sale_price,
					$tax_amnt,
					$shipping_amt,
					number_format($product_price,2),
					number_format($total,2)
				);
			
        }
		
	  }
		
		else{
			$data['data'][] = array(
				'You have no Data' , '','','','','','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}
	
	
//stock Report---------------
	
public function smb_stock_report()
{
	
	
	theme('smb_stock_report');
}
	

//view Stock Details	
public function stock_details()
	{
		
		$id   = $_GET['id'];
		$v_id = $_GET['v_id'];
		
		$data['stock_details'] = $this->db->get_where('smb_stock', ['id' => $id, 'added_by' => $v_id]);

		theme('smb_stock_view', $data);	
		
	}	


//searching
public function stock_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$product = $_POST['product'];
		$f_date = $_POST['sf_time'];
		$t_date = $_POST['st_time'];
		
		
		if($currentUser == 'admin')
			{
				$vendor = $_POST['vendor'];
			}
		else
			{	
				$vendor = $user_id;
			}
			
		
		
		$limit = $this->input->POST('length');
		$start = $this->input->POST('start');


		$queryCount = $this->Smb_allreports_model->stock_listcount($product, $f_date, $t_date,$vendor);
		
		$query = $this->Smb_allreports_model->search_stock_list($limit, $start ,$product, $f_date, $t_date, $vendor);
		

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
										
					$category_id = $r->category;
					$get_category = $this->db->get_where('smb_category', ['id'=>$category_id]);
					foreach($get_category->result() as $c);
					$category_name	 = 	$c->category_name;	

					$sub_category_id = $r->sub_category;
					$get_sub_category = $this->db->get_where('smb_sub_category', ['id'=>$sub_category_id]);
					foreach($get_sub_category->result() as $s);
					$sub_category_name	 = 	$s->sub_category_name;	
				
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
					
					
						$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$r->product,'type'=>'add','added_by'=>$r->added_by]);
						foreach($get_added_stock->result() as $added_stock);
						$total_added = $added_stock->quantity;
						
						$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$r->product, 'type'=>'sold','added_by'=>$r->added_by]);
						foreach($get_sold_stock->result() as $sold_stock);
						$total_sold = $sold_stock->quantity;
						
						if($total_sold == "")
						{
							$t_sold = 0;
						}
						else{
							$t_sold = $total_sold;
						}
						
						$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$r->product, 'type'=>'destroy','added_by' => $r->added_by]);
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
					
					
					//last Sale price 
					$get_sale_price = $this->db->order_by('id', 'asc')->get_where('smb_stock', ['product'=>$r->product,'type'=>'add','added_by'=>$r->added_by]);
					foreach($get_sale_price->result() as $pr);
					$last_sale_price = $pr->sale_price;
				
					$product_id = $r->product;
						
					//Business Type
					$product_id = $r->product;
					$get_bus_type = $this->db->get_where('smb_product', ['id'=>$product_id]);
					foreach($get_bus_type->result() as $b_id);
				
					//Business Name
					$get_b_name = $this->db->get_where('business_groups', ['id'=>$b_id->business_types]);
					foreach($get_b_name->result() as $b_name);
					
					//Vendor  Name
					$vendor_name = $r->added_by;
					$get_vendor = $this->db->get_where('users', ['id'=>$vendor_name]);
					foreach($get_vendor->result() as $vendor);					
									
									
					$data['data'][] = array(
							$button,
							$b_name->business_name,
							$vendor->company_name,
							$category_name,
							$sub_category_name,
							$product_title,	
							$last_sale_price,
							$total_added,					
							$t_sold,					
							$t_destroyed,					
							$av_stock					
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
	
	//listing after stock view
	public function stock_list_json()
	{
		$id                = $_POST['id'];
		$product           = $_POST['product'];
		$added_by          = $_POST['added_by'];
		
		$limit       = $this->input->POST('length');
		$start       = $this->input->POST('start');
		
		$queryCount  = $this->Smb_allreports_model->view_stock_ListCount($id,$product,$added_by);
		$query       = $this->Smb_allreports_model->view_stock_List($limit, $start ,$id,$product,$added_by);
		

		$draw = $this->input->POST('draw');

		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
	if($query ->num_rows() > 0) 
	   {
		  
			foreach($query->result() as $r){
										 
					if($r->type == "add")
						{
							$date = date('d-m-Y', $r->created_at);
						}
						else{
							$date = date('d-m-Y', $r->modified_at);
						}		

					$location_id = $r->location;
					if($location_id !="")
						{
							$get_loc_name = $this->db->get_where('location_id', ['id'=>$location_id]);
							if($get_loc_name->num_rows() >0 ){
								foreach($get_loc_name->result() as $loc_name);
							
								$loc_name = $loc_name->location ;
							}
							else{
								$loc_name = "Not Available" ;
							}
							
						}
						else{
							$loc_name = "Not Available ";
						}
				$data['data'][] = array(	
						$date,
						$r->type,
						$r->quantity,
						$r->sale_price,
						$r->total,
						$r->shipping_cost,
						$r->tax,
						$loc_name
						);
		     }
       }
			
		else{
			$data['data'][] = array(
				'Accounts are not Available' , '','','','','','',''
			);
		
		}
		echo json_encode($data);
	}

	
	
//Total amount $ total tax reports-----


public function smb_tax_report()
{
//    permittedArea();
	theme('smb_tax_report');
}


public function smb_tax_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
	    $role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$sale_code	 = $_POST['sale_code'];
		$sf_date     = $_POST['sf_date'];
		$st_date     = $_POST['st_date'];
		$product 	 = $_POST['product'];
		$location 	 = $_POST['location'];
		$business 	 = $_POST['business'];
		
		
		if($currentUser == 'admin')
			{
				$vendor = $_POST['vendor'];
			}
		else
			{	
				$vendor = $user_id;
			}
			
		$limit = $this->input->POST('length');
		$start = $this->input->POST('start');


		$queryCount = $this->Smb_allreports_model->tax_report_ListCount($sale_code, $sf_date, $st_date, $product, $location,$vendor,$business);
		 

		$query = $this->Smb_allreports_model->tax_report_List($limit, $start , $sale_code, $sf_date, $st_date, $product, $location,$vendor,$business);
		
			
		$draw = $this->input->get('draw');
		$data = [];
		$data['draw'] = $draw;
		$data['recordsTotal'] = $queryCount;
		$data['recordsFiltered'] = $queryCount;
		
		
	if($query -> num_rows() > 0) 
	  {
		foreach($query->result() as $r){
	
			$button = '';
			$button .= '<a class="btn btn-primary btn-sm" href="'.base_url('smb_sales/vendor_invoice/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-eye"></i> </a>';
		
			
			$index_id    = "";
			$pp_tax1 = 0;
			$pp_tax2 = 0;
			$pp_tax3 = 0;
			$pp_tax4 = 0;
			$pp_tax5 = 0;

			$sp_tax1 = 0;			
			$sp_tax2 = 0;			
			$sp_tax3 = 0;			
			$sp_tax4 = 0;			
			$sp_tax5 = 0;			
				
			$product_details = json_decode($r->product_details, true);
			$product_price  = 0;
			$tax      	 	= 0;
			$shipping 		= 0;
			$total 			= 0;
			
				
			foreach($product_details as $p){
				$index_id	     = $p['id'];
				$product_price  += $p['subtotal'];
				$tax            += $p['tax'];
				$shipping       += $p['shipping_cost'];
				
				$get_pp_tax = $this->db->get_where("smb_stock",['id'=>$index_id]);
				foreach($get_pp_tax->result() as $t);
				
				$pp_tax1  += $t->pp_tax1;
				$pp_tax2  += $t->pp_tax2;
				$pp_tax3  += $t->pp_tax3;
				$pp_tax4  += $t->pp_tax4;
				$pp_tax5  += $t->pp_tax5;
				
				$sp_tax1  += $t->sp_tax1;
				$sp_tax2  += $t->sp_tax2;
				$sp_tax3  += $t->sp_tax3;
				$sp_tax4  += $t->sp_tax4;
				$sp_tax5  += $t->sp_tax5;
				
			}
								
				$total  = $product_price+$tax+$shipping;
				
				//$tax_p = $sp_tax1+$sp_tax2+$sp_tax3+$sp_tax4+$sp_tax5;
				
			
					$data['data'][] = array(
						$button,
						date('d-m-Y', $r->sale_datetime),					
						$r->sale_code,
						number_format($total,2),
						$pp_tax1,
						$pp_tax2,
						$pp_tax3,
						$pp_tax4,
						$pp_tax5,
						$sp_tax1,
						$sp_tax2,
						$sp_tax3,
						$sp_tax4,
						$sp_tax5,
						$r->shipping,
						$r->vat
					);
				
        }
		
	  }
		
		else{
			$data['data'][] = array(
				'You have no Data' , '', '','', '','','','','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}
	
//product tax reports-----	
	
public function smb_product_tax_report()
{
	theme('smb_product_tax_report');
}

	
	
	

//searching
public function tax_product_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		$role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$product = $_POST['product'];
		$f_date = $_POST['sf_time'];
		$t_date = $_POST['st_time'];
		
		
		$sp_tax1 = $_POST['sp_tax1'];
		$sp_tax2 = $_POST['sp_tax2'];
		$sp_tax3 = $_POST['sp_tax3'];
		$sp_tax4 = $_POST['sp_tax4'];
		$sp_tax5 = $_POST['sp_tax5'];
		
		$pp_tax1 = $_POST['pp_tax1'];
		$pp_tax2 = $_POST['pp_tax2'];
		$pp_tax3 = $_POST['pp_tax3'];
		$pp_tax4 = $_POST['pp_tax4'];
		$pp_tax5 = $_POST['pp_tax5'];
		
		
		if($currentUser == 'admin')
			{
				$vendor = $_POST['vendor'];
			}
		else
			{	
				$vendor = $user_id;
			}
			
		
		
		$limit = $this->input->POST('length');
		$start = $this->input->POST('start');


		$queryCount = $this->Smb_allreports_model->product_tax_listcount($product, $f_date, $t_date,$vendor,$sp_tax1,$sp_tax2,$sp_tax3,$sp_tax4,$sp_tax5,$pp_tax1,$pp_tax2,$pp_tax3,$pp_tax4,$pp_tax5);
		
		$query = $this->Smb_allreports_model->product_tax_list($limit, $start ,$product, $f_date, $t_date, $vendor,$sp_tax1,$sp_tax2,$sp_tax3,$sp_tax4,$sp_tax5,$pp_tax1,$pp_tax2,$pp_tax3,$pp_tax4,$pp_tax5);
		

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
				
				//product name	
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
				
									
					$data['data'][] = array(
							$product_title,	
							$r->sp_tax1,
							$r->sp_tax2,
							$r->sp_tax3,
							$r->sp_tax4,
							$r->sp_tax5,
							$r->pp_tax1,
							$r->pp_tax2,
							$r->pp_tax3,
							$r->pp_tax4,
							$r->pp_tax5,
							$r->tax,
							$r->tax_value
						);
				}
		}
			else{
				   $data['data'][]=array(
					 'You have no Data' ,'','','','','','','','','','','',''
				);
			}
					echo json_encode($data);  
			
	}
	
	
	
	
}
?>