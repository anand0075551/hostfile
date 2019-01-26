<?php ob_start(); defined('BASEPATH') OR exit('No direct script access allowed');
class Smb_sales extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('smb_sales_model');
		check_auth(); //check is logged in.
	}

	public function index()
	{
		theme('all_sales');
	}
	
	public function vendor_invoice($id){
		
		$data['invoiceQuery'] = $this->db->get_where('smb_sale', ['id' => $id]);
		theme('smb_vendor_invoice', $data);
	}
	
	public function saleListJson(){
		
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');


		$queryCount = $this->smb_sales_model->all_sales_ListCount();
		
		$query = $this->smb_sales_model->sale_List($limit, $start);

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
			
				
			$button .= '<a class="btn btn-primary btn-sm" href="'.base_url('smb_sales/vendor_invoice/'. $r->id).'" data-toggle="tooltip" title="View">
						<i class="fa fa-file-text"></i> Order Details </a>';
						
			
			$buyer = $r->buyer;
							$query = $this->db->get_where('users', ['id'=>$buyer]);	
							foreach($query->result() as $d)
							{
								$buyer_name = $d->first_name." ".$d->last_name;
							}
			
			
			$currentUser = singleDbTableRow($user_id)->role;
		
			if ($currentUser == 'admin')
			{
				$tax1 = 0;
				$product_details = json_decode($r->product_details, true);
				foreach($product_details as $p){
					if($p['tax'] != 0){
						$tax1 += number_format((100/$p['subtotal'])*($p['tax']));
					}
				}
				
				$data['data'][] = array(
					$button,
					$r->sale_code,
					$buyer_name,
					date('d-m-Y', $r->sale_datetime),
					number_format($r->grand_total,2)."CPA",
					$tax1,
					number_format($r->shipping,2)."CPA",
					$r->delivery_status,
					$r->payment_status
				);
			}else{
							
				
				$condition =" product_details LIKE '%weight%' AND sale_code = '".$r->sale_code."' ";
				
				$get_product = $this->db->where($condition)->get('smb_sale');
				
				if($get_product->num_rows() > 0){
					foreach($get_product->result() as $w);
					$product_details = json_decode($w->product_details, true);
					$product_price = 0;
					$tax = 0;
					$shipping = 0;
					$total = 0;
					$qty = 0;
					$weight = 0;
					$volume = 0;
					$tax1 = 0;
					
					foreach($product_details as $p){
						$vendor_id = $p['vendor'];	
						
							if($vendor_id==$user_id){
								$product_price  += $p['subtotal'];
								$tax            += $p['tax'];
								$shipping       += $p['shipping_cost'];
								$qty      		+= $p['qty'];
								$weight         += $p['weight'];
								$volume         += $p['volume'];
								if($p['tax'] != 0){
									$tax1 += number_format((100/$p['subtotal'])*($p['tax']));
								}
							}	
					}
				}
				else{
					
					$product_details = json_decode($r->product_details, true);
					$product_price = 0;
					$tax = 0;
					$shipping = 0;
					$total = 0;
					$qty = 0;
					$weight = 0;
					$volume = 0;
					$tax1 = 0;
					
					foreach($product_details as $p){
						$vendor_id = $p['vendor'];	
						
							if($vendor_id==$user_id){
								$product_price  += $p['subtotal'];
								$tax            += $p['tax'];
								$shipping       += $p['shipping_cost'];
								$qty      		+= $p['qty'];
								$weight         += 0;
								$volume         += 0;
								if($p['tax'] != 0){
									$tax1 += number_format((100/$p['subtotal'])*($p['tax']));
								}
							}
						
					}
					
				}
				
				
				$total += $product_price+$tax+$shipping;
								
				
				foreach($product_details as $p)
				{
					
					$vendor_id = $p['vendor'];	
					
						if($vendor_id==$user_id){
							
						$query2 = $this->db->get_where('user_address',['user_id'=>$user_id, 'address_type'=>'Permanent']);
						if($query2->num_rows() > 0)
						{
							//30th	1496168908
							//31st	1496255328
							if($r->sale_datetime>1496168908){
								$get_shipment_sts = $this->db->get_where('cms_courier', ['invice_no'=>$r->sale_code, 'ship_name'=>$user_id]);
								if($get_shipment_sts->num_rows() > 0){
									$shipment_button = '<button class="btn btn-xs btn-warning disabled"> <i class="fa fa-truck"></i> Shipment Added</button>';
									foreach($get_shipment_sts->result() as $sts);
									$delivery_sts = singleDbTableRow($sts->status,'status')->status;
								}
								
								else{
									$shipment_button = '<a class="btn btn-success btn-xs" href="'.base_url('smb_sales/add_shipment/?s='. $shipping.'&id='. $r->sale_code.'&qty='. $qty.'&weight='. $weight.'&volume='. $volume).'" data-toggle="tooltip" title="Add Shipment">
											<i class="fa fa-truck"></i> Add Shipment </a>';
									$delivery_sts = 'Shipment not added yet.';
								}
							}
							else{
								$shipment_button = '<button class="btn btn-xs btn-warning disabled"> <i class="fa fa-truck"></i> Shipment Added</button>';
								
								$delivery_sts = 'Shippmet Added';
							}
							
							
							
							
							
						}
						else{
							$shipment_button = '<button class="btn btn-xs btn-danger disabled"> <i class="fa fa-address-card-o"></i> Add Your Address</button>';
							$delivery_sts = 'Shipment not added yet.';
						}
							
							
						$data['data'][] = array(
							$button,
							$r->sale_code,
							$buyer_name,
							date('d-m-Y', $r->sale_datetime),
							number_format($total,2)."CPA",
							$tax1,
							number_format($shipping,2)."CPA",
							$delivery_sts,
							$r->payment_status,
							$shipment_button 
						);
						break;
						}
						
				}
			}
		}
			}else{
				   $data['data'][]=array(
					 'You have no Data' ,'','','',''
				);
			}
		echo json_encode($data);
	}
	
	public function add_shipment(){
		
		$amnt		 = $_GET['s'];
		$id 		 = $_GET['id'];
		$qty		 = $_GET['qty'];
		$weight		 = $_GET['weight'];
		$volume		 = $_GET['volume'];
		
		
		$insert = $this->smb_sales_model->add_shipment($id, $amnt, $qty , $weight , $volume);
		
			$get_id = $this->db->get_where('cms_courier',['cons_no'=>$insert]);
			foreach($get_id->result() as $i);
			$id = $i->cid;
			$this->session->set_flashdata('successMsg', 'Shipment Added Successfully..!');
			redirect(base_url('courier/view_couriers/'.$id));
	}
	
	public function thermal_invoice($id){
		
		$data['invoiceQuery'] = $this->db->get_where('smb_sale', ['id' => $id]);
		theme('smb_vendor_thermal_invoice', $data);
	}
} 
 ob_end_clean(); ?>