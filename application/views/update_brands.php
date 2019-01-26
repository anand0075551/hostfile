
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
                    <h3 class="box-title">Edit Brand ( Physical Product )</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                        <div class="form-group <?php if(form_error('brands_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Brand Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
								<input type="text" name="brands_name" class="form-control" value="<?php echo $brands->name; ?>" placeholder="Enter Brand Name">
                                <?php echo form_error('brands_name') ?>
                            </div>
                        </div>
						
					<div class="form-group <?php // if(form_error('street_address')) echo 'has-error';     ?>">
                        <label for="firstName" class="col-md-3">Logo
                            <span class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</span>
                        </label>
						<div class="col-md-2">
							<img src ="<?php echo base_url('smb_uploads/'.$brands->logo); ?>" width="100" height="80" >
						</div>
                        <div class="col-md-7">
									<input type="file" name="userfile" class="form-control" size="20" />
                        </div>
                    </div> 
					
                    <div class="box-footer">
                        <button type="submit" name="submit" value="update_brands" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Brands
                        </button>
						<a href="<?php echo base_url('Smb_product/physical_product_brands/') ?>" class="btn btn-primary">Cancel</a>
                    </div>
                </form>
            </div><!-- /.box -->
        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<?php } 