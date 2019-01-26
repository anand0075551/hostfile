
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
                    <h3 class="box-title">Create Points Mode Name:</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
		
                        
						<div class="form-group <?php if(form_error('pm_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Create Points Mode Name
							<span class="text-red">*</span>
							</label>
                            <div class="col-md-9">  								
                                    <input type="text" name="pm_name"  class="form-control" value="<?php echo set_value('pm_name'); ?>" placeholder="Enter Points Mode Name">                                
                                <?php echo form_error('pm_name') ?>
								
							</div>
                        </div>
				

						
						
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="create_points_mode" class="btn btn-primary">
                            <i class="fa fa-edit"></i>Create Points Mode Name
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->






<?php function page_js(){ ?>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    



   

	
	
	

<?php } ?>

