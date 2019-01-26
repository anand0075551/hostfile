
<?php function page_css(){ ?>
<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>


<?php } ?>

<?php include('header.php'); ?>
<body onload="openCity(event, 'product')">
<!-- Main content -->
<section>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary col-md-12"><br>
				
                <!-- form start -->
                    <div class="box-body">
						<div class="tab" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
							<button class="tablinks active" onclick="openCity(event, 'product')">Product Details</button>
							<button class="tablinks" onclick="openCity(event, 'business')">Business Details</button>
							<button class="tablinks" onclick="openCity(event, 'custom')">Custom Details</button>
						</div>
						 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
						<div id="product" class="tabcontent" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); padding-top:15px;">
							<div class="form-group">
								<label for="firstName" class="col-md-3">Business Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9"> 
											<?php
												$business_types = $product->business_types;
												$pay_type = $product->payment_type;
											?>
									<select name="business_types" class="form-control" style="width:100%;">
										<option value="<?php echo $business_types; ?>">
											<?php 
												if($business_types != "")
												{
													$query = $this->db->get_where('business_groups',['id'=>$business_types]);
													foreach($query->result() as $b);
													echo $b->business_name;
												}
												else{
													echo "";
												}
											?>
										</option>
										<?php
											$query = $this->db->order_by('business_name','asc')->get('business_groups');
												foreach($query->result() as $res)
												{
													echo "<option value='$res->id'>" .$res->business_name."</option>";
												}
										?>
									</select>
								</div>
							</div>
							<div class="form-group <?php if(form_error('title')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Product Title
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="title" class="form-control"  value="<?php echo $product->title; ?>" placeholder=" Product Name">
                                <?php echo form_error('title') ?>
                            </div>
							</div>
							<div class="form-group">
								<label for="invoiceid" class="col-md-3">Category
									<span class="text-red">*</span>
								</label>							
								<div class="col-md-9">
								<?php 
									$featured = $product->featured;
									
									$category_id = $product->category;
									$sub_category_id = $product->sub_category;
									$get_category = $this->db->get_where('smb_category', ['id' => $category_id]);
									foreach($get_category->result() as $c){
										$category_name = $c->category_name;
									}
								?>
									<select name="category_id" class="form-control" style="width:100%;" onchange="get_sub_category(this.value)">
										<option value="<?php echo $category_id;?>"><?php
																	$get_category = $this->db->get_where('smb_category', ['id' => $category_id]);
																	foreach($get_category->result() as $c)
																	{
																	echo $c->category_name;
																	}
																	?></option>
										<?php
											$query = $this->db->order_by('category_name','asc')->get_where('smb_category',['digital'=>'no']);
												foreach($query->result() as $res)
												{
													echo "<option value='$res->id'>" .$res->category_name."</option>";
												}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="invoiceid" class="col-md-3">Sub Category
									<span class="text-red">*</span>
								</label>							
								<div class="col-md-9">
									<select name="sub_category" id="sub_category" style="width:100%;" class="form-control">
										<option value="<?php echo $sub_category_id; ?>"><?php
																$get_sub_category = $this->db->get_where('smb_sub_category',['id'=>$sub_category_id]);
																foreach($get_sub_category->result() as $c)
																	{
																	echo $c->sub_category_name;
																	}
															?></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Unit
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text"  readonly class="form-control"  value="<?php echo $product->unit; ?>" >
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Unit Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<select name="unit_type" id="unit" class="form-control" style="width:100%;" onchange="get_unit(this.value)">
										<option value="<?php echo $product->unit_value; ?>"> <?php echo $product->unit; ?> </option>
										<option value="0.000001"> Milli_Grams </option>
										<option value="0.001"> Grams </option>
										<option value="1"> Kilogram</option>
										<option value="100"> Quintol</option>
										<option value="1000"> Ton</option>
										<option value="10000"> Metric_Ton</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3"> Units Value
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="unit_value" id="unit_value" min="1" class="form-control"  placeholder="Product Units" onkeyup="get_con_value(this.value)" value="<?php if($product->unit_value != "" || $product->unit_value != 0){ echo $product->weight/$product->unit_value; } ?>">
								</div>	
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-3">Weight
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" name="weight"  id="con_value"  value="<?php echo $product->weight; ?>" readonly class="form-control">
										<div class="input-group-addon" style="padding:0px;">
											<input type="text" readonly name="con_unit" value="kg" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-3">Grade
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<select name="grade" id="grade" class="form-control" style="width:100% auto;" onchange="get_grade_status()">
										<option value='<?php echo $product->grade; ?>'>Grade <?php echo $product->grade; ?></option>
										<option value='A'>Grade A</option>
										<option value='B'>Grade B</option>
										<option value='C'>Grade C</option>
										<option value='D'>Grade D</option>
										<option value='E'>Grade E</option>
										<option value='F'>Grade F</option>
										<option value='G'>Grade G</option>
									</select>
									<p id="product_status"></p>
								</div>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-3">Length
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="number" name="length" id="length" value="<?php echo $product->length; ?>" class="form-control" min="1" onkeyup="calc()">
										<div class="input-group-addon" style="padding:0px;">
											<input type="text" readonly  value="cm" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Breath
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="number" name="breath" id="breath" value="<?php echo $product->breath; ?>" class="form-control" min="1" onkeyup="calc()">
										<div class="input-group-addon" style="padding:0px;">
											<input type="text" readonly  value="cm" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">height
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="number" name="height" id="height" value="<?php echo $product->height; ?>" class="form-control" min="1" onkeyup="calc()">
										<div class="input-group-addon" style="padding:0px;">
											<input type="text" readonly  value="cm" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Volume
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="number" name="volume" id="volume" value="<?php echo $product->volume; ?>" class="form-control" min="1">
										<div class="input-group-addon" style="padding:0px;">
											<input type="text" readonly  value="cm 3" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Tags
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="tag" class="form-control"  value="<?php echo $product->tag; ?>" placeholder="tags">
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Featured
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<select name="featured" class="form-control" style="width:100%;">
										<option value="<?php echo $featured; ?>"><?php echo $featured; ?></option>
										<option value='yes'>Yes</option>
										<option value='no'>No</option>
									</select>
								</div>
							</div>
							<div class="form-group ">
								<label for="firstName" class="col-md-3">Product Image
								  <span class="text-red">*</span>
									<span class="text-aqua">(Max size 2MB )</span>
								</label>
								<div class="col-md-2">
									<img src ="<?php echo base_url('smb_uploads/'.$product->main_image); ?>"  class="img-thumbnail" alt="Cinque Terre" width="160" height="120" >	
								</div>
								<div class="col-md-7">
									<input type="file" name="userfile" class="form-control"  size="20" />
								</div>
							</div>
							<div class="form-group  <?php if(form_error('description')) echo 'has-error'; ?> ">
								<label for="firstName" class="col-md-3">Description
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<textarea type="text" rows="5" cols="10" name="description" class="form-control"  placeholder="Description"><?php echo $product->description; ?></textarea>
									
									 <?php echo form_error('description') ?>
								</div>
							</div>
						</div><!---- end -Product Details------------->

						<div id="business" class="tabcontent" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); padding-top:15px;">
							
							<div class="form-group">
								<label for="firstName" class="col-md-3 ">Payment Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<select name="pay_type" class="form-control" style="width:100%">
										<option value="<?php echo $pay_type; ?>"><?php echo $pay_type; ?></option>
										<option value='CPA Deduction'>CPA</option>
									</select>
									  <?php echo form_error('pay_type') ?>
								</div>
							</div>
							
							<div class="form-group">
								<label for="invoiceid" class="col-md-3">Stock Creator Role
									<span class="text-red">*</span>
								</label>							
								<div class="col-md-9">
									<?php
										if($product->from_role != 0){
											$query  = $this->db->get_where('role', ['id'=>$product->from_role]);
											foreach($query->result() as $role_name);
											$role = $role_name->id;
											$rolename = $role_name->rolename;
										}
										else{
											$role = "";
											$rolename = "";
										}
									?>
									<select name="from_role[]"  class="form-control" style="width:100%; auto" multiple="">
										<option value="<?php 
															$role = explode("," , $product->from_role);
																foreach($role as $role_id){
																	echo $role_id; 
																
														?>">
														<?php  $query = $this->db->get_where('role', ['id'=>$role_id]);
															foreach($query->result() as $r)
															{
															echo "<option value='".$r->id."' selected>".$role_id.'-'.$r->rolename."</option>";
															}
															}
														?>
										</option>
										<?php 
											$query = $this->db->get('role');
											foreach ($query->result() as $c) {
												
											   echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->rolename.'</option>';
											}
										?>
									</select>	          
								</div>
							</div>
							
							<div class="form-group">
								<label for="invoiceid" class="col-md-3">Purchaser Role 
									<span class="text-red">*</span>
								</label>							
								<div class="col-md-9">
									<?php
										if($product->to_role != 0){
											$query  = $this->db->get_where('role', ['id'=>$product->to_role]);
											foreach($query->result() as $role_name);
											$role = $role_name->id;
											$rolename = $role_name->rolename;
										}
										else{
											$role = "";
											$rolename = "";
										}
									?>
									<select name="role[]"  class="form-control" onchange="get_user(this.value)" style="width:100%;" multiple="">
										<option value="<?php 
															$role = explode("," , $product->to_role);
																foreach($role as $role_id){
																	echo $role_id; 
																
														?>">
														<?php  $query = $this->db->get_where('role', ['id'=>$role_id]);
															foreach($query->result() as $r)
															{
															echo "<option value='".$r->id."' selected>".$role_id.'-'.$r->rolename."</option>";
															}
															}
														?>
										</option>
										<?php 
											$query = $this->db->get('role');
											foreach ($query->result() as $c) {
												
											   echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->rolename.'</option>';
											}
										?>
									</select>	          
								</div>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-3">HSN Code
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="hsn_code" class="form-control" value="<?php echo $product->hsn_code; ?>"  placeholder="HSN Code">
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">SAC Code
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="sac_code" class="form-control" value="<?php echo $product->sac_code; ?>"  placeholder="SAC Code">
								</div>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-3">Display Vender Name
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<?php 
									$comm1 = $product->display_vender; 
								?>
									 <label class="checkbox-inline"><input type="radio" name="display_name" <?php if($comm1=="Yes"){ ?> checked <?php } ?> value="Yes"> Yes</label>
									 <label class="checkbox-inline"><input type="radio" name="display_name" <?php if($comm1=="No"){ ?> checked <?php } ?> value="No"> No</label>
								</div>
							</div><hr>	
							<!----Dillip----->
							<?php
								$get_tax_slabs = $this->db->order_by('value', 'asc')->get('tax_slabs');
								$option = '';
								if($get_tax_slabs->num_rows() > 0){
									foreach($get_tax_slabs->result() as $tax_slab){
										$option .= '<option value="'.$tax_slab->value.'">'.$tax_slab->tax_name.'</option>';
									}
								}
							?>
							<div class="form-group">
								<label for="firstName" class="col-md-12 text-center">Purchase Tax</label>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-3">Purchase Price Tax1
								</label>
								<div class="col-md-9">
									<select class="form-control" name="pp_tax1" id="pp_tax1" style="width:100% auto;">
										<option value="<?php echo $product->pp_tax1; ?>"><?php echo $product->pp_tax1; ?></option>
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Purchase Price Tax2
								</label>
								<div class="col-md-9">
									<select class="form-control" name="pp_tax2" id="pp_tax2" style="width:100% auto;">
										<option value="<?php echo $product->pp_tax2; ?>"><?php echo $product->pp_tax2; ?></option>
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Purchase Price Tax3
								</label>
								<div class="col-md-9">
									<select class="form-control" name="pp_tax3" id="pp_tax3" style="width:100% auto;">
										<option value="<?php echo $product->pp_tax3; ?>"><?php echo $product->pp_tax3; ?></option>
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Purchase Price Tax4
								</label>
								<div class="col-md-9">
									<select class="form-control" name="pp_tax4" id="pp_tax4" style="width:100% auto;">
										<option value="<?php echo $product->pp_tax4; ?>"><?php echo $product->pp_tax4; ?></option>
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Purchase Price Tax5
								</label>
								<div class="col-md-9">
									<select class="form-control" name="pp_tax5" id="pp_tax5" style="width:100% auto;">
										<option value="<?php echo $product->pp_tax5; ?>"><?php echo $product->pp_tax5; ?></option>
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-12 text-center">Sale Tax</label>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-3">Sale Price Tax1
								<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<select class="form-control" name="sp_tax1" id="sp_tax1" style="width:100% auto;" onchange="sp_tax()">
										<option value="<?php echo $product->sp_tax1; ?>"><?php echo $product->sp_tax1; ?></option>
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Sale Price Tax2
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<select class="form-control" name="sp_tax2" id="sp_tax2" style="width:100% auto;" onchange="sp_tax()">
										<option value="<?php echo $product->sp_tax2; ?>"><?php echo $product->sp_tax2; ?></option>
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Sale Price Tax3
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<select class="form-control" name="sp_tax3" id="sp_tax3" style="width:100% auto;" onchange="sp_tax()">
										<option value="<?php echo $product->sp_tax3; ?>"><?php echo $product->sp_tax3; ?></option>
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Sale Price Tax4
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<select class="form-control" name="sp_tax4" id="sp_tax4" style="width:100% auto;" onchange="sp_tax()">
										<option value="<?php echo $product->sp_tax4; ?>"><?php echo $product->sp_tax4; ?></option>
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Sale Price Tax5
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<select class="form-control" name="sp_tax5" id="sp_tax5" style="width:100% auto;" onchange="sp_tax()">
										<option value="<?php echo $product->sp_tax5; ?>"><?php echo $product->sp_tax5; ?></option>
										<?php echo $option; ?>
									</select>
								</div>
							</div>
							
							<div class="form-group" id="tax_dis">
								<label for="firstName" class="col-md-3">Product Tax
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="number" readonly name="tax" class="form-control" id="tax" min="0" value="<?php echo $product->tax; ?>" placeholder="Product Tax" step="0.01" min="0.00" max="30.00" >
										<div class="input-group-addon" style="padding:0px;">
											<input type="hidden" name="tax_type" value="percent" >
											<input type="text" readonly name="tax_type" value="%" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-3">Shipping Cost
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="number" name="shipping_cost" id="s_cost" class="form-control" min="0" value="<?php echo $product->shipping_cost; ?>" placeholder="Shipping Cost">
										<div class="input-group-addon">&#8377;/</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-3">Tax Paid By 
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<select name="tax_piad" id="tax_piad" class="form-control" style="width:100%;" onchange="get_details(this.value)" >
										<option value='<?php echo $product->paid_by; ?>'><?php 
																							if($product->paid_by == 1){
																								echo "Company";
																							}else{
																								echo "Vendor";
																							}
																						?></option>
										<option value='1'>Company</option>
										<option value='2'>Vendor</option>
									</select> 
								</div>
							</div>
							
							<div id="div" style="display:none;">
							<div class="form-group">
								<label for="firstName" class="col-md-3">Sale Price
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="number" name="sale_price" id="rate" class="form-control" min="0" value="<?php echo $product->sale_price; ?>"   placeholder="Sale Price">
										<div class="input-group-addon">&#8377;/</div>
									</div>
								</div>
							</div>
							
							
							<div class="form-group ">
								<label for="firstName" class="col-md-3">Purchase Price
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="number" name="purchase_price" id="p_price" class="form-control" min="0" value="<?php echo $product->purchase_price; ?>"  placeholder="Purchase Price">
										<div class="input-group-addon">&#8377;/</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-3">Product Discount
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="number" name="discount" class="form-control" id="discount" min="0" value="<?php echo $product->discount; ?>" placeholder="Product Discount">
										<div class="input-group-addon" style="padding:0px;">
											<select name="discount_type" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
												<option value='<?php echo $product->discount_type; ?>'><?php
																											if($product->discount_type == "percent"){
																												echo "%";
																											}
																											else{
																												echo "&#8377;" ;
																											}	
																										?></option>
												<option value='percent'>%</option>
												<option value='rupee'>&#8377;</option>
											</select>
										</div>
									</div>
								</div>
							</div>	
							</div>
							<!----Dillip----->
						</div><!----- End Business Details------------->
						
						<div id="custom" class="tabcontent" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); padding-top:15px;">
							<div class="form-group">
								<label for="firstName" class="col-md-3">Custom 1
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="c1" class="form-control"  value="<?php echo $product->custom1; ?>" placeholder="Custom 1">
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Custom 2
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="c2" class="form-control"  value="<?php echo $product->custom2; ?>" placeholder="Custom 2">
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Custom 3
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="c3" class="form-control"  value="<?php echo $product->custom3; ?>" placeholder="Custom 3">
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Custom 4
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="c4" class="form-control"  value="<?php echo $product->custom4; ?>" placeholder="Custom 4">
								</div>
							</div>
							<div class="form-group">
								<label for="firstName" class="col-md-3">Custom 5
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="c5" class="form-control"  value="<?php echo $product->custom5; ?>" placeholder="Custom 5">
								</div>
							</div>		
						</div><!-----custom Details------------->

					
					<div class="box-footer text-right"><br>
						<button type="submit" name="submit" value="update_product" class="btn btn-primary">
							<i class="fa fa-edit"></i> Submit
						</button>
						<a href="<?php echo base_url('Smb_product/physical_products') ?>" class="btn btn-primary">Cancel</a>
					</div>	
                </form>
            </div><!-- /.box -->
        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

</body>



<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>

<style>
body {font-family: "Lato", sans-serif;}

/* Style the tab */
div.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
div.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>


<?php function page_js(){ ?>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>


<script>
	function get_sub_category(cat_id)
	{
		var mydata = {"cat_id":cat_id};
	   
		$.ajax({
		   type:"POST",
		   url:"<?php echo base_url('Smb_product/getsubcategory') ?>",
		   data:mydata,
		   success:function(response){
			 //alert(response);
			 $("#sub_category").html(response);
		   }
	   }); 
	}
</script>


<script>
function get_user(id)
	{
		var mydata = {"to_role": id};

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('smb_product/get_user') ?>",
			data: mydata,
			success: function (response) {
				$("#to_user").html(response);
			}
		});
	}
</script>

<script>
	function get_details(id)
	{
		//alert(id); 	
		if(id == 1)
		{
			$("#div").slideDown(1000);
		}
		if(id == 2)
		{
			$("#div").slideUp(1000);
			 $("#rate").val("");
			 $("#p_price").val("");
			// $("#tax").val("");
			//$("#s_cost").val("");
			 $("#discount").val("");
		}
	}
</script>

<script>
	function get_con_value()
	{		
		var unit_value = $("#unit_value").val();
		var unit = $("#unit").val();
		var total_con = unit_value*unit;
		 $("#con_value").val(total_con);
	}
</script>

<script>
function get_unit(unit)
	{
		
		var unit_value = $("#unit_value").val();
		var total_con = unit_value*unit;
		 $("#con_value").val(total_con);
		
	}
</script>


<script>
function calc() {
    var textValue1 = document.getElementById('length').value;
    var textValue2 = document.getElementById('breath').value;
    var textValue3 = document.getElementById('height').value;
    document.getElementById('volume').value = textValue1 * textValue2* textValue3 ;
}
</script>  

<script>
	function sp_tax()
	{
		var sp_tax1 = $("#sp_tax1").val();
		var sp_tax2 = $("#sp_tax2").val();
		var sp_tax3 = $("#sp_tax3").val();
		var sp_tax4 = $("#sp_tax4").val();
		var sp_tax5 = $("#sp_tax5").val();
		
		var total_tax= parseFloat(sp_tax1) + parseFloat(sp_tax2) + parseFloat(sp_tax3) + parseFloat (sp_tax4) + parseFloat(sp_tax5);
		
		
		 $("#tax").val(total_tax);
	}
</script>


<?php } 