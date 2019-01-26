
<?php function page_css(){ ?>
<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />	
<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
<?php } ?>

<?php include('header.php'); ?>
	

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Assign Movement Of Products</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
			 	<div class="form-group <?php if (form_error('product_id')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Choose Product To Move
								<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
							
							
									<select name="product_id" id="product_prep" style="width:100% auto;" onchange="get_unique_pack(this.value)" class="form-control">
										<option value=""> Choose Product </option>
										<?php 
								$get_product1 = $this->db->group_by('product')->get_where('product_packing');
								foreach($get_product1->result() as $p){
									$user_name = $p->product;
								$get_declared_name = $this->db->get_where('product_preparation', ['id'=>$user_name]);
									foreach($get_declared_name->result() as $p);
									$declared_name = $p->product_name;
									
									echo "<option value='".$p->id."'>".$declared_name."</option>";
								}
							?>
									</select>

								                         
									<?php echo form_error('product_id') ?>

								</div>
							</div>
							
								<div class="form-group <?php if (form_error('unique_batch')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Choose Batch
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
							
							<!--===================--
							onchange="get_total_output(this.value)"
							<!--===================-->							
							<select class="form-control" name="unique_batch" onchange="get_unk_prep(this.value)" id="pack_weights"  style=" width:100% auto; ">
							<option value="">Choose Batch</option>
							
						</select>   
									<?php echo form_error('unique_batch') ?>

								</div>
							</div>
							
							
							<input type="hidden" name ="unique_prep" id ="unique_prep">
					
							
							<input type ="hidden" name="prod_type" id="prod_type">
							
							<div class="form-group <?php if (form_error('assigned_role')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">role
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="assigned_role"  class="form-control" style="width:100% auto;"onchange="get_user1(this.value)">
										<option value=""> Choose option </option>								
										<!--<option value="82"> Master Chef </option>
										<option value="83"> Main Chef </option>
										<option value="84"> Assistant Chef </option>
										<option value="85"> Packers(Resto) </option>-->
										<option value="88"> Main Store Keeper </option>
									</select>	                           
									<?php echo form_error('assigned_role') ?>

								</div>
							</div> 
							
						<!--	<div class="form-group <?php if (form_error('assigned_role')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">role
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="assigned_role"  class="form-control" style="width:100% auto;"onchange="get_user1(this.value)">
										<option value=""> Choose option </option>
										<?php
										if ($rolename->num_rows() > 0) {
											foreach ($rolename->result() as $c) {

											   echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->rolename.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('assigned_role') ?>

								</div>
							</div>  -->
							
							
				 <div class="form-group <?php if (form_error('assigned_to_name')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Assistant Name
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="assigned_to_name" style="width:100% auto;"id="to_user1" class="form-control">
										<option value=""> Choose option </option>
										
									</select>	                                
									<?php echo form_error('assigned_to_name') ?>

								</div>
							</div>

								<div class="row text-center" id="warn_msg" style="font-size:18px; display:none;">
						<label>
							<font color="red">Batch Already Assigned.</font>
							<br>
							<font color="red">Please Select Other Batch.</font><br>
							<font color="red">Thank You.</font>
						</label>
					</div>
						<!--	 <div class="form-group <?php if (form_error('store_id')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Store Name
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
							
							
									<select name="store_id" id="product_prep" style="width:100% auto;" class="form-control">
										<option value="">Choose Store Name </option>
										<?php /*
								$get_product1 = $this->db->group_by('store_name')->get_where('inventory_store_id');
								foreach($get_product1->result() as $p){
									$store_name = $p->store_name;
								
									
									echo "<option value='".$p->id."'>".$p->id.'-'.$store_name.' - '.$p->area."</option>";
								}*/
							?>
									</select>

								                          
									<?php echo form_error('store_id') ?>

								</div>
							</div> -->
							
							
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
						<button type="submit" name="submit" id="submit" value="assign_packing" class="btn btn-primary">
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

<script>
	function get_unique_pack(id)

	{
		//alert(id);
		
		var mydata = {"product":id};
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Product_preparation/get_assign_movement') ?>",
			data:mydata,
			success:function(response){
			 //alert(response);
			$("#pack_weights").html(response);
			}
		});	
		
}

</script>

<script>
	function get_product_name(id)
{
	alert(id);

	var mydata = {"created_by" : id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('product_preparation/get_product_name') ?>",
		data: mydata,
		success: function (response) {
			$("#product_id").html(response);
			//alert(response);
		}
	});
}





</script>

<script>
	function get_unk_prep(id)
{
	//alert(id);
	
	var mydata = {"unique_preparation" : id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('product_preparation/get_unk_prep') ?>",
		data: mydata,
		success: function (response) {
			$("#unique_prep").val(response);
			//alert(response);
		}
	});
	
	 $.ajax({
                type: "POST",
				url: "<?php echo base_url('product_preparation/get_button_disabled') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
						$("#warn_msg").fadeIn('slow');
                        document.getElementById("submit").disabled = true;
                    } else if (result == 1)
                    {
						$("#warn_msg").hide('slow');
                        document.getElementById("submit").disabled = false;
                    }

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
	
 

<!--This Code Is Given By Akhil-->

	

 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	