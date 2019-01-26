
<?php function page_css(){ ?>
<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>

<?php } ?>

<?php include('header.php'); ?>
<?php
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
	$currentUser = singleDbTableRow($user_id)->role;
	$rolename    = singleDbTableRow($user_id)->rolename;
	$email   	 = singleDbTableRow($user_id)->email;
	//echo $email;
?>
<?php $ecom_db = $this->load->database('ecom', TRUE); ?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Add Customization</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
						
		
                        <div class="form-group <?php if(form_error('invoice_id')) echo 'has-error'; ?>">
                            <label for="invoiceid" class="col-md-3">Invoice ID
                                <span class="text-red">*</span>
                            </label>
							
							<?php 
								 if ($currentUser == 'admin')
								{	?>
							
								<div class="col-md-9">
									<select name="invoice_id" class="form-control" onchange="get_value(this.value)">
										<?php
											echo "<option value=''>Select Invoice</option>";
											
											// Get Invoice ID
												$table = "sale";
												$query = $ecom_db->order_by('sale_code','desc')->get($table);
												foreach($query->result() as $res)
												{
													echo "<option value='$res->sale_code'>" .$res->sale_code."</option>";
												}
										?>
									</select>
                                <?php echo form_error('invoice_id') ?>
								</div>
							
							<?php	
								}
								else{
							?>
							
								 <div class="col-md-9">
									<select name="invoice_id" class="form-control" onchange="get_value(this.value)">
									<?php
										echo "<option value=''>Select Invoice</option>";
										
										// Get Invoice ID
											$table = "sale";
											$query = $ecom_db->order_by('sale_code','desc')->get($table);
											foreach($query->result() as $res)
											{
												$vendor = json_decode($res->payment_status, true);
												foreach($vendor as $vid){
													$vendor_id = $vid['vendor'];
													$get_v = $ecom_db->get_where('vendor', ['vendor_id'=>$vendor_id]);
													foreach($get_v->result() as $v)
													{
														$vendor_email = $v->email;
														if($vendor_email=="$email")
														{
															echo "<option value='$res->sale_code'>" .$res->sale_code."</option>";
														}	
													}													
												}
											}
									?>
								</select>
									<?php echo form_error('invoice_id') ?>
									
								</div>
							
							<?php	
								}
							?>
							
                           
                        </div>
						
						
						<div class="form-group <?php if(form_error('product_name')) echo 'has-error'; ?>">
                            <label for="product_name" class="col-md-3">Product Name
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="product_name">
									<select name="product" id="products" class="form-control">
										<option value=""> Select Product  </option>
									</select>	
								</div>
								<?php echo form_error('product_name') ?>
                            </div>
                        </div>
						<div class="form-group <?php if(form_error('custom_one')) echo 'has-error'; ?>">
                            <label for="custom_one" class="col-md-3">Custom One
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="custom_one">
									<input type="text" name="custom_one" class="form-control" value="<?php echo set_value('custom_one'); ?>" placeholder="Custom One">
								</div>
								<?php echo form_error('custom_one') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('custom_two')) echo 'has-error'; ?>">
                            <label for="custom_two" class="col-md-3">Custom Two
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="custom_two">
									<input type="text" name="custom_two" class="form-control" value="<?php echo set_value('custom_two'); ?>" placeholder="Custom Two">
								</div>
								<?php echo form_error('custom_two') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('custom_three')) echo 'has-error'; ?>">
                            <label for="custom_three" class="col-md-3">Custom Three
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="custom_three">
									<input type="text" name="custom_three" class="form-control" value="<?php echo set_value('custom_three'); ?>" placeholder="Custom Three">
								</div>
								<?php echo form_error('custom_two') ?>
                            </div>
                        </div>
						<div class="form-group <?php if(form_error('comments')) echo 'has-error'; ?>">
                            <label for="comments" class="col-md-3">Comments
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="comments">
									<textarea name="comments" class="form-control" value="<?php echo set_value('comments'); ?>" placeholder="Comments"></textarea>
								</div>
								<?php echo form_error('custom_two') ?>
                            </div>
                        </div>
						                   
            </div>
					


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_custom" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Custom
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>



<script>
	
	function get_value(invoice_id)
	{
		//alert (invoice_id);
		
		var mydata = {"invoice_id":invoice_id};
	   
		$.ajax({
		   type:"POST",
		   url:"index.php/custom_sales/get_product",
		   data:mydata,
		   success:function(response){
			 $("#products").html(response);
		   }
	   }); 
	}
	
	
	
	
	
</script>