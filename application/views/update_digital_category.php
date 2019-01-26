
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
                    <h3 class="box-title"> Edit Category ( Digital Product )</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                        <div class="form-group <?php if(form_error('category_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Category Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
								<input type="text" name="category_name" class="form-control" value="<?php echo $category->category_name; ?>" placeholder="Enter Category Name">
                                <?php echo form_error('category_name') ?>
                            </div>
                        </div>
						
					<div class="form-group <?php // if(form_error('street_address')) echo 'has-error';     ?>">
                        <label for="firstName" class="col-md-3">Photo
                            <span class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</span>
                        </label>
						<div class="col-md-2">
							<img src ="<?php echo profile_photo_url($category->banner); ?>" width="100" height="80" >
						</div>
                        <div class="col-md-7">
									<input type="file" name="userfile" class="form-control" size="20" />
                        </div>
                    </div> 
					
                    <div class="box-footer">
                        <button type="submit" name="submit" value="update_digital_category" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Category
                        </button>
						<a href="<?php echo base_url('Smb_product/digital_product_category/') ?>" class="btn btn-primary">Cancel</a>
                    </div>
                </form>
            </div><!-- /.box -->
        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<?php } 