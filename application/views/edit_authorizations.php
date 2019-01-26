
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
                    <h3 class="box-title">Edit Authotization for UserType</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					
				        <div class="form-group <?php if(form_error('identity_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Identity
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="identity_id" class="form-control" value="<?php echo $authorizations->identity_id; ?>" readonly >
                                <?php echo form_error('identity_id') ?>
                            </div>
                        </div>
						
				        <div class="form-group <?php if(form_error('usertype')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">User Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="usertype" class="form-control" value="<?php echo $authorizations->usertype; ?>" placeholder="Update UserType">
                                <?php echo form_error('usertype') ?>
                            </div>
                        </div>						

                       
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_authorizations" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Authotizations
           </button>

	<a href="<?php echo base_url('roles/authorizations_index/') ?>"  class="btn btn-warning"><i class="fa fa-bar-return"></i> Back </a>
	             
                    </div>
                </form>
            </div><!-- /.box -->

        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<?php } ?>

