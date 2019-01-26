
<?php function page_css(){ ?>

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
                    <h3 class="box-title">Add Pincode:</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                        
		



		

						

					<div class="form-group <?php if (form_error('country')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Country
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="country" class="form-control" value="<?php echo $pincode->country;?>" placeholder="Enter Country.">                                
									<?php echo form_error('country') ?>

								</div>
					</div>

					 					<div class="form-group <?php if (form_error('state')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">State
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="state" class="form-control" value="<?php echo $pincode->state;?>" placeholder="Enter State.">                                
									<?php echo form_error('state') ?>

								</div>
					</div>
					<div class="form-group <?php if (form_error('postal_region')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Postal Region
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="postal_region" class="form-control" value="<?php echo $pincode->postal_region;?>" placeholder="Enter Postal Region.">                                
									<?php echo form_error('postal_region') ?>

								</div>
					</div>

					<div class="form-group <?php if (form_error('postal_division')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Postal Division
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="postal_division" class="form-control" value="<?php echo $pincode->postal_division;?>" placeholder="Enter Postal Division.">                                
									<?php echo form_error('postal_division') ?>

								</div>
					</div>
						<div class="form-group <?php if (form_error('district')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">District
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="district" class="form-control" value="<?php echo $pincode->district;?>" placeholder="Enter District.">                                
									<?php echo form_error('district') ?>

								</div>
					</div>
								<div class="form-group <?php if (form_error('taluk')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Taluk
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="taluk" class="form-control" value="<?php echo $pincode->taluk;?>" placeholder="Enter taluk.">                                
									<?php echo form_error('taluk') ?>

								</div>
					</div>
					
				<div class="form-group <?php if (form_error('location')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Location
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="location" class="form-control" value="<?php echo $pincode->location;?>" placeholder="Enter location.">                                
									<?php echo form_error('location') ?>

								</div>
					</div>
					                               

					<div class="form-group <?php if (form_error('pincode')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Pincode
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="text" name="pincode" class="form-control" value="<?php echo $pincode->pincode;?>" placeholder="Enter Pincode.">                                
									<?php echo form_error('pincode') ?>

								</div>
					</div>


		                 
           

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_pincode" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Edit Pincode
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



	

	    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	
<?php } ?>

