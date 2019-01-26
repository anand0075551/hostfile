
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
                    <h3 class="box-title">Edit Template & Content</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
					
					
				<div class="form-group <?php if(form_error('mediam_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Select mediam</label>
                            <div class="col-md-9">
                                <select name="mediam_type" class="form-control">
                                    <option value=""> Select </option>
                                    <option value="SMS" <?php if($Content->mediam_type == 'SMS') { ?>selected<?php } ?>>SMS</option>
                                    <option value="Email" <?php if($Content->mediam_type == 'Email') { ?>selected<?php } ?>>Email</option>
                                    <option value="popup" <?php if($Content->mediam_type == 'popup') { ?>selected<?php } ?>>popup</option>

                                </select>
                                <?php echo form_error('mediam_type') ?>
                            </div>
                </div>

        

             

						<div class="form-group <?php if(form_error('template_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Template Name
                                <span class="text-red">*</span>
                            </label>
							
							<div class="col-md-9">
                                <input type="text" name="template_name" class="form-control" value="<?php echo $Content->template_name; ?>" placeholder="">
                                <?php echo form_error('template_name') ?>
                            </div>
                        </div>
						
						
						<div class="form-group <?php if(form_error('content_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Content Name
                                <span class="text-red">*</span>
                            </label>
							
							<div class="col-md-9">
                                <input type="text" name="content_name" class="form-control" value="<?php echo $Content->content_name; ?>" placeholder="">
                                <?php echo form_error('content_name') ?>
                            </div>
                        </div>
					
                        

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_email" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Update
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

