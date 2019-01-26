
<?php function page_css(){ ?>


<?php } ?>

<?php include('header.php'); ?>
<?php
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
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
                    <h3 class="box-title">Add Defects</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
						
		
                        <div class="form-group <?php if(form_error('invoice_id')) echo 'has-error'; ?>">
                            <label for="invoiceid" class="col-md-3">Invoice ID
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
								<select name="invoice_id" class="form-control" onchange="get_value(this.value)">
									<?php
										echo "<option value=''>Select Invoice</option>";
										
										// get email of the logged user from billpayment_database->users_table.
										$where_array1 = array('id' => $user_id );
										$user_table = "users";
										$query1 = $this->db->where($where_array1)->get($user_table);
										foreach($query1->result() as $res)
										{
											$email = $res->email;
										}
										
										// get id of the logged user from ecom_database->user_table.
										$where_array = array('email' => $email );
										$table = "user";
										$query = $ecom_db->where($where_array)->get($table);
										foreach($query->result() as $res)
										{
											$buyer_id = $res->user_id;
										}  
										
										// get invoces for the logged user from ecom_database->sale_table.
										$where_array2 = array('buyer' => $buyer_id );
										$table2 = "sale";
										$query2 = $ecom_db->where($where_array2)->get($table2);
										foreach($query2->result() as $res)
										{
											echo "<option value='$res->sale_code'>" .$res->sale_code."</option>";
										}
									?>
								</select>
                                <?php echo form_error('invoice_id') ?>
								
                            </div>
                        </div>
						
						
						 <div class="form-group <?php if(form_error('invoice_value')) echo 'has-error'; ?>">
                            <label for="invoiceid" class="col-md-3">Invoice Value
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="invoice_value">
									<input type="text" name="invoice_value" class="form-control" value="<?php echo set_value('invoice_value'); ?>" placeholder="Invoice Value" readonly>
								</div>
								<?php echo form_error('invoice_value') ?>
                            </div>
                        </div>
						
                    <div class="form-group <?php if(form_error('category')) echo 'has-error'; ?>">
                            <label for="invoiceid" class="col-md-3">Category
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                 <select name="category" class="form-control" id="category" onchange="get_subcategory(this.value)">
									<?php
										echo "<option value=''>Select Category</option>";
										$query = $ecom_db->get('category');
										foreach($query->result() as $res)
										{
											echo "<option value='$res->category_id'>" .$res->category_name."</option>";
										}
									?>
								</select>
                                <?php echo form_error('category') ?>
                            </div>
                        </div>

						<div class="form-group <?php if(form_error('subcategory')) echo 'has-error'; ?>">
                            <label for="invoiceid" class="col-md-3">Sub Category
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="sub_category">
									<select name="subcategory" class="form-control">
										<option value=""> Select Sub Category  </option>
									</select>	
								</div>
                                <?php echo form_error('subcategory') ?>
                            </div>
                        </div>
						
						
						<div class="form-group <?php if(form_error('return_product_value')) echo 'has-error'; ?>">
                            <label for="invoiceid" class="col-md-3">Return Product Value
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="return_product_value" class="form-control" value="<?php echo set_value('return_product_value'); ?>" placeholder="Enter Return Product Value">
                                <?php echo form_error('return_product_value') ?>
                            </div>
                        </div>
						
						
						<div class="form-group <?php if(form_error('defect_reason')) echo 'has-error'; ?>">
                <label for="firstName" class="col-md-3"> Defect Reason
                    <span class="text-red"></span>
                </label>
                    <div class="col-md-9">
                        <select name="defect_reason" class="form-control">
                            <?php
							echo "<option value=''>Select Reason</option>";
							$query = $this->db->get('smb_defect_type');
							foreach($query->result() as $res)
							{
								echo "<option value='".$res->defect_type."'>" .$res->defect_type."</option>";
							}
						?>
                        </select>
                        <?php echo form_error('defect_reason') ?>

                </div>
            </div>
						
						<div class="form-group <?php if(form_error('vendor_id')) echo 'has-error'; ?>">
                            <label for="invoiceid" class="col-md-3">Vendor ID
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="vendor_id" class="form-control" value="<?php echo set_value('vendor_id'); ?>" placeholder="Enter Vendor ID">
                                <?php echo form_error('vendor_id') ?>
                            </div>
                        </div>
						
					 <div class="form-group <?php if(form_error('comments')) echo 'has-error'; ?>">
                            <label for="invoiceid" class="col-md-3">Comments
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <textarea type="text" name="comments" class="form-control" value="<?php echo set_value('comments'); ?>" placeholder="Enter Comments" style="height:70px;"></textarea>
                                <?php echo form_error('comments') ?>
								
                            </div>
                        </div>
						
							
                <!--                        <div class="col-md-9">
                    <input type="text" name="profession" class="form-control" value="<-?php echo set_value('profession'); ?>" placeholder="Select the Member type">
                    <-?php echo form_error('profession') ?>
                </div>
                **********Profession and Role fields are considered same for time being/Sync with App\view\add_agent***********
                -->                    
            </div>
					


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_defect" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Request Return
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<?php } ?>


<script src="<?php echo base_url('assets/admin'); ?>js/plugins/jquery/jquery.min.js"></script>
<script>
	function get_value(id)
	{
		//var sale_id = id;
		//document.getElementById("invoice_value").innerHTML=sale_id;
		//$("#invoice_value").html(sale_id);
		
		var mydata = {"sale_code":id};
	   
	   $.ajax({
		   type:"POST",
		   url:"getvalue",
		   data:mydata,
		   success:function(response){
			 $("#invoice_value").html(response);
		   }
	   });
	}
	
	
	function get_subcategory(cat_id)
	{
		//alert (cat_id);
		//var sale_id = id;
		//document.getElementById("invoice_value").innerHTML=sale_id;
		//$("#invoice_value").html(sale_id);
		
		var mydata = {"cat_id":cat_id};
	   
		$.ajax({
		   type:"POST",
		   url:"getsubcategory",
		   data:mydata,
		   success:function(response){
			 $("#sub_category").html(response);
		   }
	   }); 
	}
	
	
</script>