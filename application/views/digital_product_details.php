<?php 
	
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
									<td>Payment Type</td>
									<td><?php echo $category->payment_type; ?></td>
								</tr>
								<tr>
									<td>Vender Type</td>
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
								<tr>
									<td>To User</td>
									<td><?php 
											$to_user =  $category->to_user; 
											if($to_user !="0")
											{
												$query = $this->db->get_where('users' , ['id'=>$to_user]);
												foreach($query->result() as $user);
												echo $user->first_name.' '.$user->last_name;
											}
											else{
												echo "";
											}
										?></td>
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
									<td>Sale Prise</td>
									<td><?php echo $category->sale_price ." &#8377;/ ".$category->unit ; ?></td>
								</tr>
								<tr>
									<td>Purchase Prise</td>
									<td><?php echo $category->purchase_price ." &#8377;/ ".$category->unit ; ?></td>
								</tr>
								<tr>
									<td>Shipping Cost</td>
									<td><?php echo $category->shipping_cost ." &#8377;/ ".$category->unit ; ?></td>
								</tr>
								<tr>
									<td>Tax</td>
									<td><?php echo $category->tax  ?></td>
								</tr>
								<tr>
									<td>Discount</td>
									<td><?php echo $category->discount  ?></td>
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
							<a href="<?php echo base_url('Smb_product/all_digital_product/'.$category->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
				</div>
			</div><!-- /.box -->
		</div><!--/.col (left) -->
	</div>  
</section><!-- /.content -->
