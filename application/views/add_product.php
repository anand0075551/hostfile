
<?php

function page_css() { ?>
<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />	
    <!-- datatable css -->
   
 
 

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
                    <h3 class="box-title">Add Product</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
				 <div class="box-body">
							
							  <div class="form-group <?php if(form_error('product_type')) echo 'has-error'; ?>">
										<label for="firstName" class="col-md-3">Product Type
											<span class="text-red">*</span>
										</label>
									
										<div class="col-md-9">
											<select name="product_type" id="product_type" style="width:100% auto;" class="form-control">
										<option value=""> Choose Type </option>
										<option value="Fast Food"> Fast Food </option>
										<option value="The Recipe"> The Recipe</option>
										<option value=" Charts"> Charts</option>
										<option value="Dessert"> Dessert</option>
										<option value="Salad"> Salad</option>
										<option value="Mixed Fruits"> Mixed Fruits</option>
										
										
									</select>	                 
										</div>
							 </div>
									
						
					</div>						
                <div class="box-body">
				
				  <div class="form-group <?php if(form_error('product_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Product Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="product_name" class="form-control" value="<?php echo set_value('product_name'); ?>" placeholder="Enter Product Name">
                                <?php echo form_error('product_name') ?>
                            </div>
                        </div>
						
						
           
           
                    
                </div>			


			             	
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="add_product" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Submit Now
                </button>
            </div>
            </form>
        </div><!-- /.box -->



    </div><!--/.col (left) -->
    <!-- right column -->


</section><!-- /.content -->





<?php

function page_js() { ?>


    <!--for multiplication-->


 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
   

<?php } ?>

