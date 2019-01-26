<?php function page_css(){ ?>
   
	<!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>

<?php 
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	
	foreach($create_stock->result() as $stock); 
	
	$product_id = $stock->id;
	$product = $stock->title;
	
	$category_id = $stock->category;
	$category 	 = singleDbTableRow($stock->category, 'smb_category')->category_name;
	
	$sub_category_id = $stock->sub_category;
	$sub_category 	 = singleDbTableRow($stock->category, 'smb_sub_category')->sub_category_name;
	
	if($stock->paid_by == 1){
		$sale_tax = $stock->tax;
		$sp_tax1  = $stock->sp_tax1;
		$sp_tax2  = $stock->sp_tax2;
		$sp_tax3  = $stock->sp_tax3;
		$sp_tax4  = $stock->sp_tax4;
		$sp_tax5  = $stock->sp_tax5;
		
		$pp_tax1  = $stock->pp_tax1;
		$pp_tax2  = $stock->pp_tax2;
		$pp_tax3  = $stock->pp_tax3;
		$pp_tax4  = $stock->pp_tax4;
		$pp_tax5  = $stock->pp_tax5;
		
		$sale_price      = $stock->sale_price;
		$purchase_price  = $stock->purchase_price;
		$shipping_cost   = $stock->shipping_cost;
		$discount   	 = $stock->discount;
		$quantity   	 = "";
		$total   	 	 = "";
		$reason_note   	 = "";
		
		if($stock->discount_type == "percent"){
			$discount_type = "percent";
			$dis_type = "%";
		}
		else{
			$discount_type = "rupee";
			$dis_type = "&#8377;";
		}
		
		$location_id	 = "";
		$location		 = "Choose Location";
		$pin_id			 = "";
		$pincode	 	 = "Choose Pincode";
	}
	else{
		$check_stock = $this->db->get_where('smb_stock', ['product'=>$stock->id, 'type'=>'add', 'added_by'=>$user_id]);
		if($check_stock->num_rows() > 0){
			foreach($check_stock->result() as $s);
			
			$location_id	 = $s->location;
			$location		 = singleDbTableRow($s->location, 'location_id')->location;
			
			$pin_id			 = $s->pincode;
			if($s->pincode  != 0){
				$pincode	 = $s->pincode;
			}
			else{
				$pincode	 = "Choose Pincode";
			}
			
			$sale_price      = $s->sale_price;
			$purchase_price  = $s->purchase_price;
			$shipping_cost   = $stock->shipping_cost;
			$discount   	 = $s->discount;
			$quantity   	 = $s->quantity;
			$total   	 	 = $s->total;
			$reason_note   	 = $s->reason_note;
			
			if($s->discount_type == "percent"){
				$discount_type = "percent";
				$dis_type = "%";
			}
			else{
				$discount_type = "rupee";
				$dis_type = "&#8377;";
			}
			
			$sale_tax = $stock->tax;
			$sp_tax1  = $stock->sp_tax1;
			$sp_tax2  = $stock->sp_tax2;
			$sp_tax3  = $stock->sp_tax3;
			$sp_tax4  = $stock->sp_tax4;
			$sp_tax5  = $stock->sp_tax5;
			
			$pp_tax1  = $stock->pp_tax1;
			$pp_tax2  = $stock->pp_tax2;
			$pp_tax3  = $stock->pp_tax3;
			$pp_tax4  = $stock->pp_tax4;
			$pp_tax5  = $stock->pp_tax5;
		}
		else{
			$location_id	 = "";
			$location		 = "Choose Location";
			
			$pin_id			 = "";
			$pincode	 	 = "Choose Pincode";
			
			$discount_type   = "percent";
			$dis_type 		 = "%";
			
			$sale_price      = "";
			$purchase_price  = "";
			$shipping_cost   = $stock->shipping_cost;;
			$discount   	 = "";
			$quantity   	 = "";
			$total   	 	 = "";
			$reason_note   	 = "";
			
			$sale_tax = $stock->tax;
			$sp_tax1  = $stock->sp_tax1;
			$sp_tax2  = $stock->sp_tax2;
			$sp_tax3  = $stock->sp_tax3;
			$sp_tax4  = $stock->sp_tax4;
			$sp_tax5  = $stock->sp_tax5;
			
			$pp_tax1  = $stock->pp_tax1;
			$pp_tax2  = $stock->pp_tax2;
			$pp_tax3  = $stock->pp_tax3;
			$pp_tax4  = $stock->pp_tax4;
			$pp_tax5  = $stock->pp_tax5;
			
		}
	}
	
	
?>
		
<div class="row">
	<!-- left column -->
	<div class="col-md-12">
		<!-- general form elements -->
		<div class="box box-primary">
		
			<div class="box-header">
				<h3 class="box-title"> Add Product Stock </h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
				<div class="box-body">
					<div class="form-group">
						<label for="firstName" class="col-md-4">Business Type
						</label>
						<div class="col-md-8 text-center" style="font-size:15px; font-weight:bold;">
							<?php 
								$b_id = $stock->business_types; 
								$query = $this->db->get_where('business_groups',['id'=>$b_id]);
								foreach($query->result() as $b);
								echo $b->business_name;
							?>
							
						</div>
						<div class="col-md-2"></div>
					</div>					
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Location
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<select name="location" id="location" class="form-control" style="width:100% auto;" onchange="get_pincode(this.value)">
								<option value='<?php echo $location_id; ?>'> <?php echo $location; ?></option>
								<?php
									$get_all_location = $this->db->group_by('location')->get_where('area', ['business_name'=>$stock->business_types]);
									if($get_all_location->num_rows() > 0){
										foreach($get_all_location->result() as $loc){
											echo "<option value='".$loc->location."'>".singleDbTableRow($loc->location, 'location_id')->location."</option>";
										}
									}
								?>
							</select>
							<p class="text-red" id="location_sts"></p>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Pincode
							<span class="text-red"></span>
						</label>
						<div class="col-md-8">
							<select name="pincode" id="pincode" class="form-control" style="width:100% auto;">
								<option value='<?php echo $pin_id; ?>'> <?php echo $pincode; ?></option>
								
							</select>
						</div>
					</div>
					
					<div class="form-group <?php if(form_error('product')) echo 'has-error'; ?>">
						<label for="invoiceid" class="col-md-4">Product
							<span class="text-red"></span>
						</label>							
						<div class="col-md-8">
							<input type="hidden" class="form-control" name="product" value="<?php echo $product_id; ?>" readonly>
							<input type="text" class="form-control" value="<?php echo $product; ?>" readonly>
							<?php echo form_error('product') ?>
							<input type="hidden" id="product_price" value="">
						</div>
					</div>
					
					<div class="form-group <?php if(form_error('category_name')) echo 'has-error'; ?>">
						<label for="invoiceid" class="col-md-4">Category
							<span class="text-red"></span>
						</label>							
						<div class="col-md-8">
							<input type="hidden" class="form-control" name="category_name" value="<?php echo $category_id; ?>" readonly>
							<input type="text" class="form-control" value="<?php echo $category; ?>" readonly>
					
							<?php echo form_error('category_name') ?>
						</div>
					</div>
					
					<div class="form-group <?php if(form_error('sub_category')) echo 'has-error'; ?>">
						<label for="invoiceid" class="col-md-4">Sub-Category
							<span class="text-red"></span>
						</label>							
						<div class="col-md-8">
							<input type="hidden" class="form-control" name="sub_category" value="<?php echo $sub_category_id; ?>" readonly>
							<input type="text" class="form-control" value="<?php echo $sub_category; ?>" readonly>
							<?php echo form_error('sub_category') ?>
						</div>
					</div>
					<hr>
				<!-- Purchase Price -->
					<div class="form-group ">
						<label for="firstName" class="col-md-4">Purchase Price
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="purchase_price" class="form-control" min="0" value="<?php echo $purchase_price; ?>" placeholder="Purchase Price" <?php if($stock->paid_by == 1){ echo "readonly"; } ?> onkeyup="location_sts()">
								<div class="input-group-addon">&#8377;/</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Purchase Price Tax1
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="pp_tax1" id="pp_tax1" class="form-control" min="0" value="<?php echo $pp_tax1; ?>" placeholder="Purchase Price Tax1" step="0.01" min="0.00" max="30.00" readonly >
								<div class="input-group-addon">%</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Purchase Price Tax2
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="pp_tax2" id="pp_tax2" class="form-control" min="0" value="<?php echo $pp_tax2; ?>" placeholder="Purchase Price Tax2" step="0.01" min="0.00" max="30.00" readonly >
								<div class="input-group-addon">%</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Purchase Price Tax3
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="pp_tax3" id="pp_tax3" class="form-control" min="0" value="<?php echo $pp_tax3; ?>" placeholder="Purchase Price Tax3" step="0.01" min="0.00" max="30.00" readonly >
								<div class="input-group-addon">%</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Purchase Price Tax4
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="pp_tax4" id="pp_tax4" class="form-control" min="0" value="<?php echo $pp_tax4; ?>"placeholder="Purchase Price Tax4" step="0.01" min="0.00" max="30.00" readonly >
								<div class="input-group-addon">%</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Purchase Price Tax5
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="pp_tax5" id="pp_tax5" class="form-control" min="0" value="<?php echo $pp_tax5; ?>"placeholder="Purchase Price Tax5" step="0.01" min="0.00" max="30.00" readonly >
								<div class="input-group-addon">%</div>
							</div>
						</div>
					</div>
					
					<!-- Sale Price -->
					<hr>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Sale Price
							<span class="text-red"></span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="rate" id="rate" class="form-control" min="0" value="<?php echo $sale_price; ?>" placeholder="Sale Price" <?php if($stock->paid_by == 1){ echo "readonly"; } ?> onkeyup="location_sts()">
								<div class="input-group-addon">&#8377;/</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Sale Price Tax1
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="sp_tax1" id="sp_tax1" class="form-control" min="0" value="<?php echo $sp_tax1; ?>" placeholder="Sale Price Tax1" step="0.01" min="0.00" max="30.00" onkeyup="total_sp_tax()" readonly >
								<div class="input-group-addon">%</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Sale Price Tax2
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="sp_tax2" id="sp_tax2" class="form-control" min="0" value="<?php echo $sp_tax2; ?>" placeholder="Sale Price Tax2" step="0.01" min="0.00" max="30.00" onkeyup="total_sp_tax()" readonly>
								<div class="input-group-addon">%</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Sale Price Tax3
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="sp_tax3" id="sp_tax3" class="form-control" min="0" value="<?php echo $sp_tax3; ?>" placeholder="Sale Price Tax3" step="0.01" min="0.00" max="30.00" onkeyup="total_sp_tax()" readonly >
								<div class="input-group-addon">%</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Sale Price Tax4
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="sp_tax4" id="sp_tax4" class="form-control" min="0" value="<?php echo $sp_tax4; ?>" placeholder="Sale Price Tax4" step="0.01" min="0.00" max="30.00" onkeyup="total_sp_tax()" readonly >
								<div class="input-group-addon">%</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Sale Price Tax5
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="sp_tax5" id="sp_tax5" class="form-control" min="0" value="<?php echo $sp_tax5; ?>" placeholder="Sale Price Tax5" step="0.01" min="0.00" max="30.00" onkeyup="total_sp_tax()" readonly >
								<div class="input-group-addon">%</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Product Tax
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" id="tax" name="tax" class="form-control" min="0" value="<?php echo $sale_tax; ?>" placeholder="Product Tax" step="0.01" min="0.00" max="30.00" readonly >
								<div class="input-group-addon" style="padding:0px;">
								<input type="hidden" name="tax_type" value="percent" >
								<input type="text" readonly name="tax_type" value="%" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Shipping Cost
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="shipping_cost" class="form-control" min="0"  value="<?php echo $shipping_cost; ?>" placeholder="Shipping Cost" readonly>
								<div class="input-group-addon">&#8377;/</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Product Discount
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<div class="input-group">
								<input type="number" name="discount" class="form-control" min="0" value="<?php echo $discount; ?>"  placeholder="Product Discount">
								<div class="input-group-addon" style="padding:0px;">
									<select name="discount_type" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
										<option value='<?php echo $discount_type; ?>'><?php echo $dis_type; ?></option>
										<option value='percent'>%</option>
										<option value='rupee'>&#8377;</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Quantity
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="number" name="quantity" id="quantity" class="form-control" min="0" placeholder="Quantity" value="0" onkeyup="get_total_price(this.value)">
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Total Sale Price
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="number" name="total" id="total" placeholder="Total Sale Price" value="0" class="form-control" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label for="firstName" class="col-md-4">Reason Note
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<textarea type="text" name="note" class="form-control" rows="3" cols="6" placeholder="Reason Note"><?php echo $reason_note; ?></textarea>
						</div>
					</div>
					
					<input type="hidden" name="business_types" value="<?php echo $stock->business_types; ?>">
					<input type="hidden" name="to_role" value="<?php echo $stock->to_role; ?>">
					<input type="hidden" name="tag" value="<?php echo $stock->tag; ?>">
					<input type="hidden" name="hsn_code" value="<?php echo $stock->hsn_code; ?>">
					<input type="hidden" name="sac_code" value="<?php echo $stock->sac_code; ?>">
					
				</div><!--End box body----->
				<!---------------Footer------------>
				<div class="box-footer text-right">
					<button type="submit" name="submit" value="stock_create" class="btn btn-primary">
						<i class="fa fa-edit"></i> Save
					</button>
					<button type="button" class="btn btn-drack" data-dismiss="modal" onClick="window.location.reload();">Cancel</button>
				</div>
			</form>
		</div><!-- /.box -->
	</div><!--/.col (left) -->
	<!-- right column -->
</div>


<?php function page_js(){ ?>



<!----Datepiker SCRIPT  Files---->


<script>
	function location_sts()
	{
		var location = $("#location").val().trim();
		if(location==""){
			$("#location_sts").html("Please Select a Locaton..!");
		}
		else{
			$("#location_sts").hide();
		}
	}
	
	function get_pincode(id){
		
		var biz_id = $("#business_types").val().trim();
		
		var mydata = {"location": id};
			$.ajax({
			type: "POST",
			url: "<?php echo base_url('smb_product/get_pincodes'); ?>",
			data: mydata,
			success: function (response) {
				$("#pincode").html(response);
			}
		});	
	}
</script>

<script>
	function get_total_price()
	{
		var location = $("#location").val().trim();
		if(location==""){
			$("#location_sts").html("Please Select a Locaton..!");
		}
		else{
			$("#location_sts").hide();
		}
		var price = $("#rate").val();
		var quantity = $("#quantity").val();
		var total_price = price*quantity;
		 $("#total").val(total_price);
	}
</script>

<script>
	function total_sp_tax()
	{
		//alert('5');
		var sp_tax1 = $("#sp_tax1").val().trim();
		var sp_tax2 = $("#sp_tax2").val().trim();
		var sp_tax3 = $("#sp_tax3").val().trim();
		var sp_tax4 = $("#sp_tax4").val().trim();
		var sp_tax5 = $("#sp_tax5").val().trim();
		
		if(sp_tax1 != ""){
			tax1 = sp_tax1;
		}
		else{
			tax1 = 0;
		}
		
		if(sp_tax2 != ""){
			tax2 = sp_tax2;
		}
		else{
			tax2 = 0;
		}
		
		if(sp_tax3 != ""){
			tax3 = sp_tax3;
		}
		else{
			tax3 = 0;
		}
		
		if(sp_tax4 != ""){
			tax4 = sp_tax4;
		}
		else{
			tax4 = 0;
		}
		
		if(sp_tax5 != ""){
			tax5 = sp_tax5;
		}
		else{
			tax5 = 0;
		}
		
		var total_tax = parseFloat(tax1) + parseFloat(tax2) + parseFloat(tax3) + parseFloat(tax4) + parseFloat(tax5);
		
		
		 $("#tax").val(total_tax);
	}
</script>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>


<?php } ?>