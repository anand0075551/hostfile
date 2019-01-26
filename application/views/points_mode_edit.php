


<?php

function page_css() { ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

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
                    <h3 class="box-title">Edit Points Mode Name</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

                    <div class="form-group <?php if (form_error('pm_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Points Mode Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="pm_name" class="form-control" value="<?php echo $points_mode->pm_name; ?>" placeholder="">
                            <?php echo form_error('pm_name') ?>
                        </div>
                    </div>



                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">

                    <button type="submit" name="submit" value="points_mode_edit" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Update Name
                    </button>
                </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->


    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php

function page_js() { ?>


  
<?php } ?>

<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>



