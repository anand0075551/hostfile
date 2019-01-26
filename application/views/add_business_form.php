
<?php

function page_css() { ?>

	<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" /> 

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
                    <h3 class="box-title">Add Business Form</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">


                <div class="form-group <?php if (form_error('bg_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Business Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="bg_id"  class="form-control">
                                <option value=""> Choose option </option>
                                <?php
                                if ($business_name->num_rows() > 0) {
                                    foreach ($business_name->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->business_name . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('bg_id') ?>

                        </div>
                </div>
				
				
				
				                <div class="form-group <?php if (form_error('category_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Category Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="category_name"  class="form-control">
                                <option value=""> Choose option </option>
                                <?php
                                if ($business_name->num_rows() > 0) {
                                    foreach ($business_name->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->business_name . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('category_name') ?>

                        </div>
                </div>
					
			<!--		        <div class="form-group  < ?php if(form_error('sub_category')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Sub Category Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="sub_category" class="form-control" value="< ?php echo set_value('sub_category'); ?>" placeholder="Enter Sub Category Name">
                                < ?php echo form_error('sub_category') ?>
                            </div>
                        </div>
		-->				
						<div class="form-group <?php if(form_error('font')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Font
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="font" class="form-control" value="<?php echo set_value('font'); ?>" placeholder="Enter Fonts Eg:  'fa fa-user' ">
                                <?php echo form_error('font') ?>
                            </div>
                        </div>
						
						
		<div class="form-group <?php if(form_error('displayform_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Display Form Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="displayform_name" class="form-control" value="<?php echo set_value('displayform_name'); ?>" placeholder="Enter Display Form Name">
                                <?php echo form_error('displayform_name') ?>
                            </div>
                        </div>
					                        <div class="form-group <?php if(form_error('controller')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Controller
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="controller" class="form-control" value="<?php echo set_value('controller'); ?>" placeholder="Enter Controller Name">
                                <?php echo form_error('controller') ?>
                            </div>
                        </div>
					
										                        <div class="form-group <?php if(form_error('phpfile_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">PHP File Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="phpfile_name" class="form-control" value="<?php echo set_value('phpfile_name'); ?>" placeholder="Enter PHP File Name ">
                                <?php echo form_error('phpfile_name') ?>
                            </div>
                        </div>

		
		
					

                </div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="add_business_form" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Add Form 
                </button>
				<a href="<?php echo base_url('menu/all_business_forms') ?>" class="btn btn-info"><i class="fa fa-arrow-edit"></i>Back</a>
				
				<div id="mydiv"></div>
            </div>
            </form>
        </div><!-- /.box -->



    </div><!--/.col (left) -->
    <!-- right column -->

</div>   <!-- /.row -->






</section><!-- /.content -->






<!-- Validation -->





<?php function page_js() { ?>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
<script>
        $('select').select2();
    </script> 

<?php } ?>

