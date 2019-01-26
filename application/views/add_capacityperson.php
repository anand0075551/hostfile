
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
                    <h3 class="box-title">vehicle capacity</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                        <div class="form-group <?php if(form_error('capacityperson')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> Add vehicle capacity
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="capacityperson" class="form-control" value="<?php echo set_value('capacityperson'); ?>" placeholder="Enter vehicle capacity">
                                <?php echo form_error('capacityperson') ?>
                            </div>
                        </div>

                    <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- Admin_settings/addAdmin && Settings_models/addAdmin -->
                        <button type="submit" name="submit" value="capacityperson" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add capacity person
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

