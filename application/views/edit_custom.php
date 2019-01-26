
<?php function page_css(){ ?>


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
                    <h3 class="box-title">Edit Customization</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
						
		
                        <div class="form-group <?php if(form_error('invoice_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Invoice ID
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="invoice_id" class="form-control" value="<?php echo $custom->sale_code; ?>" readonly>
                                <?php echo form_error('invoice_id') ?>
                            </div>
                        </div>
						<div class="form-group <?php if(form_error('product_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Product Name
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="product_name" class="form-control" value="<?php echo $custom->product; ?>" readonly>
                                <?php echo form_error('product_name') ?>
                            </div>
                        </div>
						<div class="form-group <?php if(form_error('custom_one')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Custom One
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="custom_one" class="form-control" value="<?php echo $custom->custom_1; ?>">
                                <?php echo form_error('custom_one') ?>
                            </div>
                        </div>
						<div class="form-group <?php if(form_error('custom_two')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Custom Two
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="custom_two" class="form-control" value="<?php echo $custom->custom_2; ?>">
                                <?php echo form_error('custom_two') ?>
                            </div>
                        </div>
						<div class="form-group <?php if(form_error('custom_three')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Custom Three
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="custom_three" class="form-control" value="<?php echo $custom->custom_3; ?>">
                                <?php echo form_error('custom_three') ?>
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
								<?php echo form_error('comments') ?>
                            </div>
                        </div>
            
					


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_custom" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update </button>
						<a href="<?php echo base_url('custom_sales/custom_view/'.$custom->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Cancel</a>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<?php } ?>

