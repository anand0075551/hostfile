
<?php function page_css(){ ?>
<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />	
<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
<?php } ?>

<?php include('header.php'); ?>
	
<?php 
	foreach($inventory_stocks->result() as $inventory_stocks);
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"> Ware House</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
					
					<input type="hidden" name="serial_no" value="<?php echo $inventory_stocks->sub_batchno;?>">
                      <div class="row" style="padding:10px;">   
					  
		                  <div  <?php if (form_error('type')) echo 'has-error'; ?>>
								
 								<div class="col-md-4">  
                               						
                                  <p><label for="firstName" >Type <span class="text-red">*</span>		</label></p>
									<select name="type"  id="type" class="form-control" style="width:100% auto;" >
										<option value=""> Choose Type  
										
										
									
										</option>
								<?php 
										$get_product = $this->db->get_where('inventory_inward_outward');
										foreach($get_product->result() as $p){
											echo "<option value='".$p->id."'>".$p->id.'-'.$p->inward_outward."</option>";
										}
							      ?>
									  
									</select>	                                
									<?php echo form_error('type') ?>

								</div>
							</div>
		
                        
					<div  <?php if (form_error('store_id')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  								
                                       <p><label>Store ID <span class="text-red">*</span></label></p>
									<select name="store_id"  class="form-control" style="width:100% auto;" onchange="get_mf(this.value)" >
										<option value=""> Choose Store
										
										

										</option>
										<?php
										$store_id= $this->db->get_where('inventory_store_id');
										foreach($store_id->result() as $t)
										{
											 echo '<option value="'.$t->id.'"> '.$t->id.'-'.$t->store_name.' '.$t->area.'</option>';
										}
										?>
									</select>	                                
									<?php echo form_error('store_id') ?>

								</div>
							</div>
						
						<input type="hidden" name="price_of_pieces" value="<?php echo $inventory_stocks->price_of_pieces;?>">
						
					<div  <?php if (form_error('item')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  								
                          <p><label>Batch No</label></p>
									<select name="aa"  class="form-control" style="width:100% auto;" onchange="get_mfr_date(this.value)">
										<option value="<?php echo $inventory_stocks->product_unique_code;?>" >
										
										<?php
											$get = $this->db->get_where('inventory_stocks', ['product_unique_code'=>$inventory_stocks->product_unique_code]);
											foreach($get->result() as $ac);
											echo $ac->product_unique_code;
										
										?>


										</option>
										<?php
											$user_info = $this->session->userdata('logged_user');
                                        $user_id = $user_info['user_id'];
										
										$store_id= $this->db->get_where('product_movement_assigned',['assigned_to_name' => $user_id]);
										foreach($store_id->result() as $t)
										{
											$prod_name=$t->product_id;
											$unique_batch=$t->unique_batch;
											
						$prod= $this->db->get_where('product_preparation',['id'=>$prod_name]);
						
						  foreach($prod->result() as $f)
						$prod_name  = $f->product_name;
											
					echo '<option value="'.$t->unique_batch.'"> '.$unique_batch.' - '.$prod_name.'</option>';
										}
										?>
									</select>	                                
									<?php echo form_error('item') ?>

								</div>
							</div>
				
						</div><!-- Sec 1 !-->
						
						<div class="row" style="padding:10px;" >   
						<div <?php if (form_error('category')) echo 'has-error'; ?>>
								
								<div class="col-md-4" >  								
                 <p><label> Category</label></p>
									<select name="category" id="gg" class="form-control" style="width:100% auto;"onchange="get_user(this.value)"readonly>
										<option value="<?php echo $inventory_stocks->category;?>"> 
									<?php
										$get = $this->db->get_where('smb_category', ['id'=>$inventory_stocks->category]);
										foreach($get->result() as $ac);
										echo $ac->id."-".$ac->category_name;
										
									?>
										</option>
										<?php
										if ($category_name->num_rows() > 0) {
											foreach ($category_name->result() as $c) {

											   echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->category_name.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('category') ?>

								</div>
							</div>
							
							<div  <?php if (form_error('sub_category')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  								
                           <p><label>Sub Category</label></p>
									<select name="sub_category" id="to_user" style="width:100% auto;"class="form-control" onchange="get_item(this.value)">
										<option value="<?php echo $inventory_stocks->sub_category;?>"> 
										
										
										<?php
										$get = $this->db->get_where('smb_sub_category', ['id'=>$inventory_stocks->sub_category]);
										foreach($get->result() as $ac);
										echo $ac->id."-".$ac->sub_category_name;
										
										?>
										
										
										</option>
										
									</select>	                                
									<?php echo form_error('sub_category') ?>

								</div>
							</div>
							
							 <div <?php if (form_error('aa')) echo 'has-error'; ?> >
								
								<div class="col-md-4">  								
                       <p><label>Item Name</label></p>
									<select name="item" id="items" style="width:100% auto;" class="form-control"style="display:none"  >
										<option value="<?php echo $inventory_stocks->product;?>">
										
										<?php
											$get = $this->db->get_where('smb_product', ['id'=>$inventory_stocks->product]);
											foreach($get->result() as $ac);
											echo $ac->id."-".$ac->title;
										
										?>


										</option>
										
									</select>	                                
									<?php echo form_error('aa') ?>

								</div>
							</div>
							</div><!-- Sec 1 !-->
							
							<div class="row" style="padding:10px;">   
							<!--This Code Is Given By Akhil-->
							
							
							<?php    
							
							$get_status = $this->db->get_where('inventory_movement', ['id'=>$inventory_stocks->id]);
			
			                   if($get_status->num_rows() > 0)
			               {
							   foreach ($get_status->result() as $weight){
				               $final = $weight->pieces;
							   }
			                    }
								 else{
										
										$final =$inventory_stocks->quantity;
									}
							
							
							?>
							
								<div <?php if (form_error('quantity')) echo 'has-error'; ?>>
								
								<div class="col-md-4"> 
                 <p><label>Quantity(Pieces)</label></p> 	 								
									<input type="text" name="quantity" onkeyup="get_total()" id="quantity" class="form-control"  value="<?php echo $final;?>" placeholder="Enter No. Of Pieces" readonly>                                
									<?php echo form_error('quantity') ?>

								</div>
							</div>
							
							<div <?php if (form_error('quantity')) echo 'has-error'; ?>>
								
								<div class="col-md-4"> 
                 <p><label>Add Pieces</label></p> 	 								
									<input type="text" name="quantity1" onkeyup="get_total()" id="quantity1"   class="form-control" placeholder="Enter Pieces to add">                                 
									<?php echo form_error('quantity') ?>

								</div>
							</div>
							
							
				<div <?php if (form_error('quantity')) echo 'has-error'; ?>>
								
								<div class="col-md-4"> 
                 <p><label>Left Pieces</label></p> 	 								
									<input type="text" name="balance_pieces"  class="form-control" onkeyup="get_total()" id="balance_pieces"  placeholder="Balance Pieces" readonly>                             
									<?php echo form_error('quantity') ?>

			 					</div>
			    </div>
			<!---=============================
							
			<input type="text" name="quantity1" onkeyup="get_total()" id="quantity1"  placeholder="Enter No. Of Pieces"> 
							
							
			<input type="text" name="balance_pieces" onkeyup="get_total()" id="balance_pieces"  placeholder="Balance Pieces">
							
							
			<!---=============================-->
							<div class="col-md-4"> 
                 <p><label>Added Weight</label></p> 	 								
									<input type="text" name="net_weight"  class="form-control" onkeyup="get_total()" id="net_weight"  placeholder="Added Weight" readonly>                             
									<?php echo form_error('quantity') ?>

			 					</div>
							
							
							
							<div  <?php if (form_error('product_unique_code')) echo 'has-error'; ?>>
								
								<div class="col-md-4"> 
                                     <p><label> Product Unique Code</label></p> 								
									<input type="text" name="product_unique_code" id="product_unique_code" class="form-control" value="<?php echo $inventory_stocks->product_unique_code;?>" placeholder="Unique Code."readonly>                                
									<?php echo form_error('product_unique_code') ?>

								</div>
							</div>
							
							<div  <?php if (form_error('product_manufacturing_date')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
								 <p><label>Product Manufacturing Date</label></p> 	
									<input type="text" name="product_manufacturing_date" id="product_manufacturing_date" class="form-control"placeholder="Choose Date."readonly value="<?php echo $inventory_stocks->product_manufacturing_date;?>" >                                
									<?php echo form_error('product_manufacturing_date') ?>

								</div>
							</div>
							
							</div><!-- Sec 1 !-->
							
							 <div class="row" style="padding:10px;"> 					
					
								<div  <?php if (form_error('weight_per_piece')) echo 'has-error'; ?>>
								<?php  
								
								$weight_piece = $this->db->get_where('product_packing',['unique_small'=>$inventory_stocks->product_unique_code]);
								foreach ($weight_piece->result () as $per_weight){
									$per_weight->quantity_small;
								}
								
								
								?>
								<div class="col-md-4">  
                        <p><label>weight (Kg)</label></p> 									
									<input type="text" name="weight_per_piece" onkeyup="get_total()" id="weight_per_piece" class="form-control" placeholder="Enter Weight Per Piece"  value="<?php echo $per_weight->quantity_small;?>"readonly>                                
									<?php echo form_error('weight_per_piece') ?>

								</div>
							</div>
							
								<div  <?php if (form_error('sub_total_price')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                   <p><label>Sub Total Price</label></p> 								
									<input type="text" name="sub_total_price" id="sub_total_price" class="form-control" value="<?php echo $inventory_stocks->sub_total_price;?>" readonly >                                
									<?php echo form_error('sub_total_price') ?>

								</div>
							</div>
							
								<div  <?php if (form_error('grand_total')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                           <p><label>Grand Total Price</label></p> 								
									<input type="text" name="grand_total" id="grand_total" class="form-control" value="<?php echo $inventory_stocks->grand_total;?>" readonly>                                
									<?php echo form_error('grand_total') ?>

								</div>
							</div>
							
					</div><!-- Sec 1 !-->	
							
							<div class="row" style="padding:10px;"> 
							
								
							<div  <?php if (form_error('items')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  								
                      <p><label>Brand</label></p>
									<select name="brand" id="brand" style="width:100% auto;" class="form-control" >
										<option value="<?php echo $inventory_stocks->brand;?>">
										
										<?php
											$get = $this->db->get_where('inventory_stocks', ['product_unique_code'=>$inventory_stocks->product_unique_code]);
											foreach($get->result() as $ac);
											echo $ac->brand;
										
										?>


										</option>
										<option value="cfirst"> Cfirst </option>
										<option value="cfirst"> smb </option>
										
										
									</select>	                                
									<?php echo form_error('items') ?>

								</div>
							</div>
							
							
							
								
							<div <?php if (form_error('price_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                                    <p><label>Price Per Unit</label></p> 								
									<input type="text" name="price_per_unit" onkeyup="get_total()" id="price_per_unit" class="form-control" value="<?php echo $inventory_stocks->price_per_unit;?>"  readonly>                                
									<?php echo form_error('price_per_unit') ?>

								</div>
							</div>
							
							
					<div  <?php if (form_error('product_expiry_date')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                                        <p><label>Product Expiry Date</label></p> 									
									<input type="text" name="product_expiry_date" id="product_expiry_date" class="some_class form-control"  value="<?php echo $inventory_stocks->exp_date;?>" readonly>                                
									<?php echo form_error('product_expiry_date') ?>

								</div>
							</div>
							
							
							</div><!-- Sec 1 !-->
							
							
					<div class="row" style="padding:10px;"> 
					
							<input type="hidden" name="inward1" id="inward1" value="0">
							<input type="hidden" name="outward1" id="outward1" value="0">
							
								<div  <?php if (form_error('tax1_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                           <p><label>Tax 1 Per Unit</label></p> 									
									<input type="text" name="tax1_per_unit" onkeyup="get_total()" id="tax1_per_unit" class="form-control" value="0" value="<?php echo $inventory_stocks->tax1_per_unit;?>"  readonly>                              
									<?php echo form_error('tax1_per_unit') ?>

								</div>
							</div>
							
								<div  <?php if (form_error('tax2_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                                  <p><label>Tax 2 Per Unit</label></p> 								
									<input type="text" name="tax2_per_unit" onkeyup="get_total()" id="tax2_per_unit" class="form-control" value="0" value="<?php echo $inventory_stocks->tax2_per_unit;?>"  readonly>                               
									<?php echo form_error('tax2_per_unit') ?>

								</div>
							</div>
							
								<div  <?php if (form_error('tax3_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                             <p><label>Tax 3 Per Unit</label></p> 								
									<input type="text" name="tax3_per_unit" value="0" onkeyup="get_total()" id="tax3_per_unit" class="form-control" value="<?php echo $inventory_stocks->tax3_per_unit;?>"  readonly>                               
									<?php echo form_error('tax3_per_unit') ?>

								</div>
							</div>
							
					</div><!-- Sec 1 !-->
							
							
					<div class="row" style="padding:10px;"> 
								
						
							
							<div  <?php if (form_error('shipping1_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  

                                    <p><label>shipping1 Per Unit</label></p> 								
									<input type="text" name="shipping1_per_unit" value="0" onkeyup="get_total()" id="shipping1_per_unit" class="form-control"value="<?php echo $inventory_stocks->shipping1_per_unit;?>"  readonly>                                
									<?php echo form_error('shipping1_per_unit') ?>

								</div>
							</div>
							
							<div <?php if (form_error('supplier_name')) echo 'has-error'; ?>>
							
								<div class="col-md-4">  
                            <p><label>Supplier Name</label></p> 									

									<select name="supplier_name"  class="form-control" style="width:100% auto;"onchange="get_user1(this.value)" >
										<option value="<?php echo $inventory_stocks->supplier_name;?>"> 

<?php 
										$get = $this->db->get_where('role', ['id'=>$inventory_stocks->supplier_name]);
										foreach($get->result() as $ac);
										echo $ac->id."-".$ac->rolename;
									?> 


										</option>
										<?php
										if ($rolename->num_rows() > 0) {
											foreach ($rolename->result() as $c) {

											   echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->rolename.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('supplier_name') ?>

								</div>
							</div>

							
							 <div  <?php if (form_error('supplier_id')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  	
                                 <p><label>Supplier Id</label></p> 									

									<select name="supplier_id" style="width:100% auto;"id="to_user1" class="form-control" >
										<option value="<?php echo $inventory_stocks->supplier_id;?>"> 
										
										
										<?php 
										$get = $this->db->get_where('users', ['id'=>$inventory_stocks->supplier_id]);
										foreach($get->result() as $ac);
										echo $ac->id."-".$ac->first_name.' '.$ac->last_name;
									?> 
										
										
										</option>
										
									</select>	                                
									<?php echo form_error('supplier_id') ?>

								</div>
							</div>
							
							
							
							
							
							
							
							
						</div><!-- Sec 1 !-->	
					
                    
					
					
			 
			 
			 	
					 
					  <div class="row" style="padding:10px;"> 	
					  
								<div  <?php if (form_error('supplier_invoice_no')) echo 'has-error'; ?>>
							
								<div class="col-md-4">  
                            <p><label>Supplier Invoice No</label></p> 											
									<input type="text" name="supplier_invoice_no" id="supplier_invoice_no" class="form-control"value="<?php echo $inventory_stocks->supplier_invoice_no;?>" readonly>                         
									<?php echo form_error('supplier_invoice_no') ?>

								</div>
							</div>
							
							
							
								<div  <?php if (form_error('compartment1')) echo 'has-error'; ?>>
							
								<div class="col-md-4">  	
                           <p><label>Compartment 1</label></p> 									
									<input type="text" name="compartment1" id="compartment1" class="form-control"  >                                 
									<?php echo form_error('compartment1') ?>

								</div>
							</div>
							
							<div  <?php if (form_error('compartment2')) echo 'has-error'; ?>>
								
								<div class="col-md-4"> 
								        <p><label>Compartment 2</label></p> 	
 								
									<input type="text" name="compartment2" id="compartment2" class="form-control">                                   
									<?php echo form_error('compartment2') ?>

								</div>
							</div>
					</div><!-- Sec 1 !-->	
					
                <div class="row" style="padding:10px;"> 						
							<div  <?php if (form_error('compartment3')) echo 'has-error'; ?>>
								
								<div class="col-md-4"> 
                  <p><label>Compartment 3</label></p> 	 								
									<input type="text" name="compartment3" id="compartment3" class="form-control" >                             
									<?php echo form_error('compartment3') ?>

								</div>
							</div>
							
							<div  <?php if (form_error('compartment4')) echo 'has-error'; ?>>
							
								<div class="col-md-4">  
                                     <p><label>Compartment 4</label></p> 	 									
									<input type="text" name="compartment4" id="compartment4" class="form-control" >                              
									<?php echo form_error('compartment4') ?>

								</div>
							</div>
							
							<div  <?php if (form_error('compartment5')) echo 'has-error'; ?>>
								
								<div class="col-md-4" >  
                                    <p><label>Compartmsent 5</label></p> 
									
									<input type="text" name="compartment5" id="compartment5" class="form-control" placeholder="For storage">                                
									<?php echo form_error('compartment5') ?>

								</div>
							</div>
							
								<div  <?php if (form_error('remarks')) echo 'has-error'; ?>>
								
								<div class="col-md-4">  
                               <p><label>Remarks</label></p> 								
									<textarea name="remarks" id="remarks" placeholder="Enter Your Remarks" class="form-control"></textarea>                         
									<?php echo form_error('remarks') ?>

								</div>
							</div>
				</div><!-- Sec 1 !-->				
							
						 <div class="row" style="padding:10px;"style="display:none"> 	
						<div  <?php if(form_error('state')) echo 'has-error'; ?>>
						
                           
                            <div class="col-md-4" style="display:none">
							          <p><label>State</label></p> 	
                                <select name="state" id="state" style="width:100% auto;" class="form-control" onchange="get_district(this.value)">
                                    <option value="0"> Select State </option>
                                      <?php
                                    if($country->num_rows() > 0)
                                    {
                                        foreach($country->result() as $c){
                                            //$selected = ($c->id == 105)? 'selected' : '';
                                            echo '<option value="'.$c->state.'"> '.$c->state.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('state') ?>
                            </div>
                       </div>
						
						<div <?php if(form_error('district')) echo 'has-error'; ?>>
                           
                            <div class="col-md-4"style="display:none">
							
							<p><label>District</label></p> 	
                                <select name="district" id="district" style="width:100% auto;" class="form-control" onchange="get_location_id(this.value)">
                                    <option value="0"> Select District </option>
                                    
                                </select>
                                <?php echo form_error('district') ?>
                            </div>
                        </div>


		
						<div  <?php if(form_error('area_location_name')) echo 'has-error'; ?>>
                            
                            <div class="col-md-4"style="display:none">
							<p><label>Select Location</label></p> 	
                                <select name="area_location_name" style="width:100% auto;" id="location_id" class="form-control" onchange="get_pincode(this.value)">
                                    <option value="0"> Select location </option>
                                   
                                </select>
                                <?php echo form_error('area_location_name') ?>
                            </div>
                        </div>

		
			 </div><!-- Sec 1 !-->
							
						 <div class="row" style="padding:10px;"style="display:none"> 	
						<div  <?php if(form_error('location_pincode')) echo 'has-error'; ?>>
                          
                            <div class="col-md-4"style="display:none">
							<p><label>Pincode</label></p> 	
                                <select name="location_pincode" style="width:100% auto;" id="pincode" class="form-control">
                                    <option value="0"> Select Pincode </option>
                                    
                                </select>
                                <?php echo form_error('location_pincode') ?>
                            </div>
                        </div>
							
							
							
							<div  <?php if (form_error('shipping2_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4"style="display:none">  
                               <p><label>shipping2 Per Unit</label></p> 									
									<input type="text" name="shipping2_per_unit" value="0" onkeyup="get_total()" id="shipping2_per_unit" class="form-control" placeholder="Enter shipping cost Per Unit">                                
									<?php echo form_error('shipping2_per_unit') ?>

								</div>
							</div>
							
							<div  <?php if (form_error('shipping3_per_unit')) echo 'has-error'; ?>>
								
								<div class="col-md-4"style="display:none">  
                     <p><label>shipping3 Per Unit</label></p> 									
									<input type="text" name="shipping3_per_unit" value="0" onkeyup="get_total()" id="shipping3_per_unit" class="form-control" placeholder="Enter shipping cost Per Unit">                                
									<?php echo form_error('shipping3_per_unit') ?>

								</div>
							</div>

					 </div><!-- Sec 1 !-->		
							
							 	<?php 
										$getassigned_by = $this->db->get_where('product_warehouse_assigned',['unique_batch'=>$inventory_stocks->product_unique_code]);
										{
										foreach($get->result() as $ac);
										 $ac->created_by;
										}
										
									?> 
					<?php 
	foreach($product_warehouse_assigned->result() as $product_warehouse_assigned);
?>		
							<input type="hidden" name="assigned_by"  id="assigned_by" value="1">
							
							<input type="hidden" name="assigned_to" value="1" id="assigned_to">
							
							</div>
							
							
							
							
							
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
						<button type="submit" name="submit" id="submit" value="add_warehouse" class="btn btn-primary">
							<i class="fa fa-edit"></i>Submit
						</button>
					</div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<!--This Code Is Given By Akhil-->
<!----Datepiker SCRIPT  Files---->
<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>
<script>

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});

$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});
</script>
<script>
	function get_product_prepration(id)
{
	//alert(id);
	var mydata = {"id" : id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('product_preparation/get_product_prepration') ?>",
		data: mydata,
		success: function (response) {
			$("#to_product_prepration").html(response);
			//alert(response);
		}
	});
}





</script>
	<script>
	function get_item(id)
{
	//alert(id);
	var mydata = {"category" : id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('product_preparation/get_item') ?>",
		data: mydata,
		success: function (response) {
			$("#items").html(response);
			//alert(response);
		}
	});
}





</script>

<script>
	function get_user(id)
{
	//alert(id);
	var mydata = {"category" : id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('product_preparation/get_user') ?>",
		data: mydata,
		success: function (response) {
			$("#to_user").html(response);
			//alert(response);
		}
	});
}





</script>

<script>
function get_district(id)
{
//   alert(id);
    var mydata = {"state": id};

    $.ajax({
        type: "POST",
       
			url: "<?php echo base_url('Inventory_stocks/get_district') ?>",
        data: mydata,
        success: function (response) {
            $("#district").html(response);
            //alert(response);
        }
    });
}

function get_location_id(id)
{  //   alert(id);
    var mydata = {"district": id};

    $.ajax({
        type: "POST",
      
		url: "<?php echo base_url('Inventory_stocks/get_location_id') ?>",
        data: mydata,
        success: function (response) {
			$("#location_id").html(response);
        }
    });
}

function get_pincode(id)
{
    var mydata = {"location": id};

    $.ajax({
        type: "POST",
       
		url: "<?php echo base_url('Inventory_stocks/get_pincode') ?>",
        data: mydata,
        success: function (response) {
			$("#pincode").html(response);
        }
    });
}


</script>
<script>
	function get_user1(id)
{
	//alert(id);
	var mydata = {"to_role": id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Inventory_stocks/get_user1') ?>",
		data: mydata,
		success: function (response) {
			$("#to_user1").html(response);
			//alert(response);
		}
	});
}





</script>



<script>
	function get_mfr_date(id)
{
	//alert(id);
	var mydata = {"unique_batch": id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_mfr_date') ?>",
		data: mydata,
		success: function (response) {
			$("#product_manufacturing_date").val(response);
			//alert(response);
		}
	});
	
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_quantity') ?>",
		data: mydata,
		success: function (response) {
			$("#quantity").val(response);
			//alert(response);
		}
	});
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_weight_per_piece') ?>",
		data: mydata,
		success: function (response) {
			$("#weight_per_piece").val(response);
			//alert(response);
		}
	});
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_unique_code') ?>",
		data: mydata,
		success: function (response) {
			$("#product_unique_code").val(response);
			//alert(response);
		}
	});
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_assigned_by') ?>",
		data: mydata,
		success: function (response) {
			$("#assigned_by").val(response);
			//alert(response);
		}
	});
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_assigned_to') ?>",
		data: mydata,
		success: function (response) {
			$("#assigned_to").val(response);
			//alert(response);
		}
	});
	
}





</script>
	<script>
	//$('#submit').attr("disabled", true); 
	</script>
	<script>
	function get_total(){
		
		    
	
		var quantity = $("#quantity").val();
		var quantity1 = $("#quantity1").val();
		
		var balance_pieces = $("#balance_pieces").val();
		
		
		var tax1_per_unit = $("#tax1_per_unit").val();
		var tax2_per_unit = $("#tax2_per_unit").val();
		var tax3_per_unit = $("#tax3_per_unit").val();
		
		var type = $("#type").val();
		
		
		
		var shipping1_per_unit = $("#shipping1_per_unit").val();
		var shipping2_per_unit = $("#shipping2_per_unit").val();
		var shipping3_per_unit = $("#shipping3_per_unit").val();

		
		var action = $("#action").val();
	
		
		var weight_per_piece = $("#weight_per_piece").val() ;
		
		var price_per_unit = $("#price_per_unit").val() * $("#quantity").val();
		
		var inward1 = $("#inward1").val();
		
		var outward1 = $("#outward1").val();
		
		
		 
	var type1 = parseFloat(type,10);
	 var Remaining_total = parseFloat(weight_per_piece,10);
	 var pieces1 = parseFloat(quantity1,10);
	 var pieces = parseFloat(quantity,10);
	 
	 var left_pieces = parseFloat(quantity,10) - parseFloat(quantity1,10);
	 
	 
	var  net_weight =  parseFloat(weight_per_piece,10) * parseFloat(quantity1,10);
	 
	 var sub_total = parseFloat(price_per_unit,10);
	 
	 var grand_total1 = parseFloat(price_per_unit,10)+parseFloat(tax1_per_unit,10)+parseFloat(tax2_per_unit,10)+parseFloat(tax3_per_unit,10)+parseFloat(shipping1_per_unit,10)+parseFloat(shipping2_per_unit,10)+parseFloat(shipping3_per_unit,10);
	 
	  $("#sub_total_price").val(sub_total);
		 $("#grand_total").val(grand_total1);
	 if(pieces1 > pieces){
		 alert('Pieces Can Not Exceed Available Pieces\n\nPlease Re-Enter Pices.\n\nThank You. !!!');
				$('#submit').addClass('disabled');
				 return false;
		 
	 }else{
		 $('#submit').removeClass('disabled');
	 if(type1 == 1)
	 { 
		 $("#inward1").val(pieces1);
		 $("#outward1").val();
		  $("#balance_pieces").val(left_pieces); 
		  $("#net_weight").val(net_weight.toFixed(2)); 
		  
		
	 }if(type1 == 2)
	 {
		 $("#inward1").val();
		 $("#outward1").val(pieces1);
		  $("#balance_pieces").val(left_pieces); 
		    $("#net_weight").val(net_weight.toFixed(2)); 
	 }
	 return true;
		 
		
		
	 } 
		 
		 

		
		
	}
</script>
<script>
	function get_mf(id)
{
	//alert(id);
	var mydata = {"unique_batch": id};
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_assigned_by1') ?>",
		data: mydata,
		success: function (response) {
			$("#assigned_by").val(response);
			alert(response);
		}
	});
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Product_preparation/get_assigned_to') ?>",
		data: mydata,
		success: function (response) {
			$("#assigned_to").val(response);
			//alert(response);
		}
	});
	
}





</script>
 <script>
/*	function fff(id)
{
	//alert(id);
	var quantity = $("#quantity").val();
	var quantity = parseFloat(quantity,10);
	
	var weight_per_piece = $("#weight_per_piece").val();
	var type = $("#type").val();
	var type1 = parseFloat(type,10);
	if(type1== 1){
	
	
	
			$("#inward1").val(quantity);
			//alert(response);
	}else{
		$("#outward1").val(quantity);
	}
}



*/

</script>
<script>
	function get_pieces(cnt){
		
		
		
	
		var i =1
		var sum = 0;
		
		for(i=1; i<=cnt; i++)
		{
				used_weight = document.getElementById(i+'usedweight').value ;
				balance_qty = document.getElementById(i+'balance_qty').value ;
				category = document.getElementById(i+'category').value ;
				
				
			
				
				if( parseFloat(used_weight,10) > parseFloat(balance_qty,10) && category != 26 )
				{
                alert('Weight Can Not Be Greater Than Available Stock.\n\nPlease Re-Enter weight.\n\nThank You. !!!');
				$('#submit').addClass('disabled');
				 return false;
            }
			else{
				$('#submit').removeClass('disabled');
				
				if(category == 26)
            {
                sum=parseFloat(sum,10)-parseFloat(used_weight,10);
            }else
			{
				sum=parseFloat(used_weight,10)+parseFloat(sum,10);
			}
				
				//sum=parseInt(used_weight,10)+parseInt(sum,10);
		}
		}
		document.getElementById('total_output').value =sum
		
	}
</script>
<!--This Code Is Given By Akhil-->

	<script src="<?php echo base_url('assets'); ?>/jquery.min.js" type="text/javascript"></script>

 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	