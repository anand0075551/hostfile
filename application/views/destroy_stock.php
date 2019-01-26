<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>

<?php 
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	
	foreach($destroy_stock->result() as $stock); 
	$get_loct = $this->db->get_where('smb_stock', ['product'=>$stock->id, 'type'=>'add', 'added_by'=>$user_id]); 
	if($get_loct->num_rows() > 0){
?>
<div class="row">
	<!-- left column -->
	<div class="col-md-12">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"> Destroy Product Entry </h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
				<div class="box-body">
					<div class="form-group">
						<label for="firstName" class="col-md-4">Business Type
						</label>
						<div class="col-md-2"></div>
						<div class="col-md-4">
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
						<label for="firstName" class="col-md-4">Location/Area
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<select name="location" class="form-control" onchange="get_avstock(this.value)" style="width:100%;">
								<?php 
								echo "<option value=''>Choose Location</option>";
								$get_loc = $this->db->group_by('location')->get_where('smb_stock', ['product'=>$stock->id, 'type'=>'add', 'added_by'=>$user_id]); 
								if($get_loc->num_rows() > 0){
									foreach($get_loc->result() as $s){
									
									//Location Name
									$location_name  = $s->location;
									$get_location_name = $this->db->get_where('location_id', ['id'=>$location_name]);
									foreach($get_location_name->result() as $loc_name);
									
						echo "<option value='".$s->location."'>".$loc_name->location."</option>";
								}
								}
							?>
							</select>
						</div>
					</div>
				<div class="form-group" style="display:none;">
						<label for="firstName" class="col-md-4">Pincode
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<select name="pincode" id="pincode1" class="form-control" style="width:100%;">
							<option value='' class="form-control">Choose Pincode</option>
								
							</select>
						</div>
					</div>
					<div class="form-group <?php if(form_error('category_name')) echo 'has-error'; ?>">
						<label for="invoiceid" class="col-md-4">Category
							<span class="text-red">*</span>
						</label>							
						<div class="col-md-8">
							<input type="hidden" class="form-control" name="category_name" value="<?php echo $stock->category; ?>" readonly>
							<input type="text" class="form-control" value="<?php
										$cat_id = $stock->category;
										$query = $this->db->get_where('smb_category', ['id'=>$cat_id]);
										foreach($query->result() as $c);
										echo $c->category_name;
									?>" readonly>
					
							<?php echo form_error('category_name') ?>
						</div>
					</div>
					<div class="form-group <?php if(form_error('sub_category')) echo 'has-error'; ?>">
							<label for="invoiceid" class="col-md-4">Sub-Category
								<span class="text-red">*</span>
							</label>							
								<div class="col-md-8">
									<input type="hidden" class="form-control" name="sub_category" value="<?php echo $stock->sub_category; ?>" readonly>
							<input type="text" class="form-control" value="<?php
												$sub_id = $stock->sub_category;
												$query = $this->db->get_where('smb_sub_category', ['id'=>$sub_id]);
												foreach($query->result() as $s);
												echo $s->sub_category_name;
											?>" readonly>
									<?php echo form_error('sub_category') ?>
								</div>
					</div>
					<div class="form-group <?php if(form_error('product')) echo 'has-error'; ?>">
							<label for="invoiceid" class="col-md-4">Product
								<span class="text-red">*</span>
							</label>							
								<div class="col-md-8">
									<input type="hidden" class="form-control" name="product" id="product_id" value="<?php echo $stock->id; ?>" readonly>
							<input type="text" class="form-control" value="<?php
												echo $stock->title;
											?>" readonly>
						
									<?php echo form_error('product') ?>
									<input type="hidden" id="product_price" value="">
								</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Avaiable Quantity
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							
							<input type="number" id="avi_stock" class="form-control" value=""  readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Quantity
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<input type="number" name="quantity" id="quantity1" min="0" onkeyup="get_que(this.value)" class="form-control">
							<p id="qty_sts" style="color:red"></p>
						</div>
					</div>
					<div class="form-group">
						<label for="firstName" class="col-md-4">Reason Note
							<span class="text-red">*</span>
						</label>
						<div class="col-md-8">
							<textarea type="text" name="note" class="form-control" rows="3" cols="6"></textarea>
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
					<button type="submit" name="submit" id="save" value="destroy_stock" class="btn btn-primary">
						<i class="fa fa-edit"></i> Save
					</button>
					<button type="button" class="btn btn-drack" data-dismiss="modal" onClick="window.location.reload();" >Cancel</button>
				</div>
			</form>
		</div><!-- /.box -->
	</div><!--/.col (left) -->
	<!-- right column -->
</div> 

<?php } else{?>
	<div class="row">
	<!-- left column -->
	<div class="col-md-12 text-center">
		<h4 class="text-red">Sorry..! You Don't Have Created Any Stock For This Product Yet.</h4>
	</div><!--/.col (left) -->
	<!-- right column -->
</div> 
<?php } ?>

<?php function page_js(){ ?>


<script>
	function get_avstock(loc_id)
	{
		var product_id = $("#product_id").val();
		var mydata = {"loc_id":loc_id,"product_id":product_id};
		
	  // alert(product_id);
	  // alert(loc_id);
	  
		$.ajax({
		   type:"POST",
		   url:"<?php echo base_url('Smb_product/get_stock') ?>",
		   data:mydata,
		   success:function(response){
			 //alert(response);
			 $("#avi_stock").val(response);
		   }
	   }); 
	   
	}
</script>

<script>
	function get_que(qty)
	{
		//alert(qty);
		var av_qty = $("#avi_stock").val();
		//alert(av_qty);
		
		var av_qty = parseInt(av_qty);
		var qty = parseInt(qty);
		
		if(av_qty<qty){
			$('#save').addClass('disabled');
			$('#qty_sts').html('Quantity should not exceed available quantity..!');
		}
		else{
			$('#save').removeClass('disabled');
			$('#qty_sts').html('');
		}
	}
</script>


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>


<?php } ?>