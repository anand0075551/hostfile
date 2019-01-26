<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Smb_reports extends CI_Controller {
	
	function __construct(){
		parent:: __construct();
		$this->load->model('smb_report_model');

		check_auth(); //check is logged in.
	}

	public function sales_report()
	{
	//	permittedArea();
		theme('sales_report');
	}
	
	
public function smb_search_ListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
	    $role = singleDbTableRow($user_id)->rolename;
		$currentUser   = singleDbTableRow($user_id)->role;
		
		$sale_code	 = $_POST['sale_code'];
		
		$buyer 		 = $_POST['buyer'];
		$sf_date     = $_POST['sf_date'];
		$st_date     = $_POST['st_date'];
				
		/*if($currentUser == 'admin')
			{
				$vendor1 = $_POST['vendor1'];
			}
		else
			{	
				$vendor1 = $user_id;
			}
			*/
			
		$limit = $this->input->POST('length');
		$start = $this->input->POST('start');


		$queryCount = $this->smb_report_model->accounts_ListCount($sale_code, $buyer, $sf_date, $st_date);
		 

		$query = $this->smb_report_model->search_account_List($limit, $start , $sale_code, $buyer, $sf_date, $st_date);
		
			
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
			
			$products = "";
			$quantity = "";
			$sale_price = "";
			$tax_amnt = "";
			$shipping_amnt = "";
			
			
			$query1 = $this->db->get_where('users', ['id'=>$r->buyer]);	
			foreach($query1->result() as $d);
			
				$buyer_name = $d->first_name." ".$d->last_name;
				$buyer_ph = $d->contactno;
				
				
			$product_details = json_decode($r->product_details, true);
			$product_price = 0;
			$tax = 0;
			$shipping = 0;
			$total = 0;
				
			foreach($product_details as $p){
					$product_price  += $p['subtotal'];
					$tax            += $p['tax'];
					$shipping       += $p['shipping_cost'];
					
					
					$location        = $p['location'];
					$product_p	     = $p['subtotal'];
					$vendor_id       = $p['vendor'];
					$product_name	 = $p['name'].", <hr>";
					$quantity 		 = $p['qty'].", <hr>";
					$sale_price 	 = number_format($p['subtotal'],2).", <hr>";
					$tax_amnt        = number_format($p['tax'],2).", <hr>";
					$shipping_amt    = number_format($p['shipping_cost'],2)." <hr>";
			}
					$total  = $product_price+$tax+$shipping;
			
					//for location name
					$get_loc = $this->db->get_where('location_id', ['id'=>$location]);
					foreach($get_loc->result() as $l);
					$location_name = $l->location;
					
				
				$data['data'][] = array(
					$button,
					date('d-m-Y', $r->sale_datetime),					
					$r->sale_code,
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
				'You have no Data' , '', '','', '','','','','','','','',''
			);
		
		}
		echo json_encode($data);

	}

//stock Report---------------------------------------------------------------------------
	
public function stock_report()
{
	
	
	theme('stock_report');
}
	

//view Stock Details	
public function stock_details()
	{
		
		$id   = $_GET['id'];
		$v_id = $_GET['v_id'];
		
		$data['stock_details'] = $this->db->get_where('smb_stock', ['id' => $id, 'added_by' => $v_id]);

		theme('stock_view', $data);	
		
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


		$queryCount = $this->smb_report_model->stock_listcount($product, $f_date, $t_date,$vendor);
		
		$query = $this->smb_report_model->search_stock_list($limit, $start ,$product, $f_date, $t_date, $vendor);
		

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
				
				$button .= '<a class="btn btn-primary editBtn" href="'.base_url('Smb_reports/stock_details/?id='.$r->id.'&v_id='.$r->added_by ).'" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a> &nbsp;';
										
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
}
?>