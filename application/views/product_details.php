<?php 
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
	foreach($product->result() as $category); 
	
?>
<?php include('header.php'); ?>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="box box-primary">
					<div class="box-header">
					</div><!-- /.box-header -->
						<div class="box-body">
					<div class="col-md-3">
						<img src ="<?php echo profile_photo_url($category->main_image); ?>" width="250" height="240" >
					</div>
					<div class="col-md-9">
					<!-- general form elements -->
							<table class="table table-striped">
								<tr>
									<td>Product Name</td>
									<td><?php echo $category->title; ?></td>
								</tr>
								<tr>
									<td>Location</td>
									<td><?php 
											//echo $category->id; 
											$get_loc = $this->db->order_by('id','desc')->get_where('smb_stock', ['product'=>$category->id, 'added_by'=>$user_id]);
											if($get_loc->num_rows()>0){
											foreach($get_loc->result() as $loc);
											$get_loc_name = $this->db->get_where('location_id', ['id'=>$loc->location]);
											if($get_loc_name->num_rows() > 0){
											foreach($get_loc_name->result() as $loc_name);
											$get_pin = $this->db->get_where('area', ['location'=>$loc_name->id]);
											if($get_pin->num_rows() > 0){
											foreach($get_pin->result() as $pin);
											$pins = $pin->pincode;
											echo $loc_name->location;
											}
											}
											}
										?>
									</td>
								</tr>
								<tr>
									<td>Payment Type</td>
									<td><?php echo $category->payment_type; ?></td>
								</tr>
								<tr>
									<td>Vendor Type</td>
									<td><?php echo $category->vender_type; ?></td>
								</tr>
								<tr>
									<td>Business Type</td>
									<td><?php 
											$business_name =  $category->business_types; 
											if($business_name != "")
											{
												$query = $this->db->get_where('business_groups' , ['id'=>$business_name]);
												foreach($query->result() as $business);
												echo $business->business_name;
											}
											else{
												echo " ";
											}
										?></td>
								</tr>
								
								<tr>
									<td>From Role</td>
									<td><?php 
									
											$role="";
											if($category->from_role !=""){
												$role_name = explode("," , $category->from_role);
												foreach($role_name as $role_id){
													$query = $this->db->get_where('role', ['id'=>$role_id]);	
													foreach($query->result() as $r)
													{
														$role.= $r->rolename.", ";
													}	
												}
											}
											else{
												$role = "";
											}
											echo $role;
										?>
									</td>
								</tr>
								
								<tr>
									<td>To Role</td>
									<td><?php 
									
											$role="";
											if($category->to_role !=""){
												$role_name = explode("," , $category->to_role);
												foreach($role_name as $role_id){
													$query = $this->db->get_where('role', ['id'=>$role_id]);	
													foreach($query->result() as $r)
													{
														$role.= $r->rolename.", ";
													}	
												}
											}
											else{
												$role = "";
											}
											echo $role;
										?>
									</td>
								</tr>
									
								<tr>
									<td>Category</td>
									<td><?php  
											$category_name = $category->category;
											$query = $this->db->get_where('smb_category', ['id'=>$category_name]);	
												foreach($query->result() as $d)
												{
													echo $d->category_name;
												}
										?>
									</td>
								</tr>
								<tr>
									<td>Sub-Category</td>
									<td><?php 
											$sub_category = $category->sub_category;	
											$query = $this->db->get_where('smb_sub_category', ['id'=>$sub_category]);	
												foreach($query->result() as $sub)
												{
													echo $sub->sub_category_name;
												}
										?>
									</td>
								</tr>
								<tr>
									<td>Brand</td>
									<td><?php 
									
											$brand="";
											if($category->brand!=""){
												$brand_name = explode("," , $category->brand);
												foreach($brand_name as $brand_id){
													$query = $this->db->get_where('smb_brand', ['id'=>$brand_id]);	
													foreach($query->result() as $d)
													{
														$brand.= $d->name.", ";
													}	
												}
											}
											else{
												$brand = "";
											}
											echo $brand;
										?>
								</td>
								</tr>
								<tr>
									<td>Unit</td>
									<td><?php echo $category->unit; ?></td>
								</tr>
								<tr>
									<td>Sale Price</td>
									<td><?php
										$get_sale_price = $this->db->order_by('id','desc')->get_where('smb_stock', ['product'=>$category->id, 'added_by'=>$user_id]);
										if($get_sale_price->num_rows()>0){
											foreach($get_sale_price->result() as $sale_price);
											
											echo number_format($sale_price->sale_price,2);
										}
										
									?></td>
								</tr>
								<tr>
									<td>Purchase Price</td>
									<td><?php 
										$get_purchase_price = $this->db->order_by('id','desc')->get_where('smb_stock', ['product'=>$category->id, 'added_by'=>$user_id]);
										if($get_purchase_price->num_rows()>0){
											foreach($get_purchase_price->result() as $purchase_price);
											
											echo number_format($purchase_price->purchase_price,2);
										}
									
									?></td>
								</tr>
								<tr>
									<td>Shipping Cost</td>
									<td><?php 
										$get_shipping = $this->db->order_by('id','desc')->get_where('smb_stock', ['product'=>$category->id, 'added_by'=>$user_id]);
										if($get_shipping->num_rows()>0){
											foreach($get_shipping->result() as $shipping);
											
											echo number_format($shipping->shipping_cost,2);
										}
									?></td>
								</tr>
								<tr>
									<td>Tax</td>
									<td><?php 
										$get_tax = $this->db->order_by('id','desc')->get_where('smb_stock', ['product'=>$category->id, 'added_by'=>$user_id]);
										if($get_tax->num_rows()>0){
											foreach($get_tax->result() as $tax);
											if($tax->tax_type == "percent"){
												$tax_type = "%";
											}
											else{
												$tax_type = "&#8377;";
											}
											echo $tax->tax." ".$tax_type;
										} 
									?></td>
								</tr>
								<tr>
									<td>Discount</td>
									<td><?php
										$get_discount = $this->db->order_by('id','desc')->get_where('smb_stock', ['product'=>$category->id, 'added_by'=>$user_id]);
										if($get_discount->num_rows()>0){
											foreach($get_discount->result() as $discount);
											if($discount->discount_type == "percent"){
												$discount_type = "%";
											}
											else{
												$discount_type = "&#8377;";
											}
											echo $discount->discount." ".$discount_type;
										} 
									?></td>
								</tr>
								<tr>
									<td>Featured</td>
									<td><?php echo $category->featured; ?></td>
								</tr>
								<tr>
									<td>Tag</td>
									<td><?php echo $category->tag; ?></td>
								</tr>
								<tr>
									<td>Status</td>
									<td><?php echo $category->status; ?></td>
								</tr>
								
								<tr>
									<td>Created By</td>
									<td><?php  
											$created_by = $category->created_by;
											$query = $this->db->get_where('users', ['id'=>$created_by]);	
											foreach($query->result() as $d)
											{
												echo $d->first_name.' '.$d->last_name;
											}
										?>
									</td>
								</tr>
								<tr>
									<td>Created At</td>
									 <td><?php echo date('d-M, Y', $category->created_at)." (".date('h:m A', $category->created_at).")"; ?></td>
								</tr>
								<tr>
									<td>Modified By</td>
									<td><?php  
											$created_by = $category->modified_by;
											$query = $this->db->get_where('users', ['id'=>$created_by]);	
											foreach($query->result() as $d)
											{
												echo $d->first_name.' '.$d->last_name;
											}
									
										?>
									</td>
								</tr>
								<tr>
									<td> Modified At</td>
									 <td><?php
										if($category->modified_at != 0){
											echo date('d-M, Y', $category->modified_at)." (".date('h:m A', $category->modified_at).")"; 
										}
										else{
											echo "Not Modified Yet.";
										}
									?></td>
								</tr>
							</table>

						</div><!-- /.box-body -->
						<div class="box-footer">
							<a href="<?php echo base_url('Smb_product/physical_products/'.$category->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
				</div>
			</div><!-- /.box -->
		</div><!--/.col (left) -->
	</div>  
</section><!-- /.content -->
