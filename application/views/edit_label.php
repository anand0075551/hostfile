
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
                    <h3 class="box-title">Edit Label</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        

                        <div class="form-group <?php if(form_error('bussiness_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Business Group Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="bussiness_name" class="form-control" value="<?php echo $business_label->bussiness_name; ?>" placeholder="Enter Business Group Name">
                                <?php echo form_error('bussiness_name') ?>
                            </div>
                        </div>

 													<div class="form-group <?php if(form_error('comments')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Enter Comments</label>
                            <div class="col-md-9">
                                <input type="text"  name="comments"  class="form-control" value="<?php echo $business_label->comments; ?>" placeholder="Enter Comments ">
                                <?php echo form_error('comments') ?>
                            </div>
                        </div>
					


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_label" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Business Label
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

