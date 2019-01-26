
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
                    <h3 class="box-title">Product Assign</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
	
								<div class="form-group <?php if (form_error('declared_by')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Declared By Head Chef
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="declared_by"  class="form-control" style="width:100% auto;"onchange="get_product_name(this.value)">
										<option value=""> Choose option </option>
										<?php
										if ($product_assign->num_rows() > 0) {
											foreach ($product_assign->result() as $c) {

												$created_by_id =$c->created_by;
										
										$get_name = $this->db->get_where('users',['id'=>$created_by_id]);
										
										foreach ($get_name->result() as $name)
												
											
											
											
											   echo '<option value="'.$created_by_id.'"> '.$c->id.'-'.$name->first_name.' '.$name->last_name.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('declared_by') ?>

								</div>
							</div>
							
							
							
							<div class="form-group <?php if (form_error('product_id')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Product
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="product_id" id="product_id" style="width:100% auto;"class="form-control" onchange="get_prod_type(this.value)">
										<option value=""> Choose option </option>
										
									</select>	                                
									<?php echo form_error('product_id') ?>

								</div>
							</div>
							
							<input type ="hidden" name="prod_type" id="prod_type">
							
							<div class="form-group <?php if (form_error('assigned_role')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">role
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="assigned_role"  class="form-control" style="width:100% auto;"onchange="get_user1(this.value)">
										<option value=""> Choose option </option>								
										<option value="82"> Master Chef </option>
										<option value="83"> Main Chef </option>
										<option value="84"> Assistant Chef </option>
										<option value="85"> Packers(Resto) </option>
									</select>	                                
									<?php echo form_error('assigned_role') ?>

								</div>
							</div>
							
							
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

							
							 <div class="form-group <?php if (form_error('store_id')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Store Name
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
							
							
									<select name="store_id" id="product_prep" style="width:100% auto;" class="form-control">
										<option value="">Choose Store Name </option>
										<?php 
								$get_product1 = $this->db->group_by('store_name')->get_where('inventory_store_id');
								foreach($get_product1->result() as $p){
									$store_name = $p->store_name;
								
									
									echo "<option value='".$p->id."'>".$p->id.'-'.$store_name.' - '.$p->area."</option>";
								}
							?>
									</select>

								                          
									<?php echo form_error('store_id') ?>

								</div>
							</div>
							
							
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
						<button type="submit" name="submit" value="add_product_assign" class="btn btn-primary">
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
	function get_product_name(id)
{
	//alert(id);
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
	function get_prod_type(id)
{
	//alert(id);
	var mydata = {"id" : id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('product_preparation/prod_type') ?>",
		data: mydata,
		success: function (response) {
			$("#prod_type").val(response);
			//alert(response);
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
	