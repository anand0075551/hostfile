<?PHP


//foreach( $convertWallet->result() 	as $converWallet);  //Convert Wallet Ratio 
//ratio_loyality   = $converWallet->loyality;
//$ratio_discount   = $converWallet->discount;

?>
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
                    <h3 class="box-title">Update Points Conversion Ratio Table</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
										
						<hr />
                        <div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="remarks" class="form-control" value="<?php echo $points_ratio->remarks; ?>" placeholder="Enter Description for change Ratio">
                                <?php echo form_error('remarks') ?>
                            </div>
                        </div>
						<hr />
						 <div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Select the Effective Start Date:
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>												
								   <input type="date" class="form-control" id="start_date" name="start_date"  value="<?php echo $points_ratio->start_date; ?>" >								 
									<?php echo form_error('start_date') ?>
								</div>
							</div>
						</div>
									
						<hr />
						<div class="form-group <?php if(form_error('alpha')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Alpha
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
							<div class="input-group">
							<div class="input-group-addon"> 1 : </div>
                                <input type="number" name="alpha" step="0.1" min="0.1"  class="form-control" value="<?php echo $points_ratio->alpha; ?>" placeholder="Enter Ratio for Loyality Points">
                                <?php echo form_error('alpha') ?>
                            </div>
								</div>
                        </div>
						<hr />				
						
						
						<div class="form-group <?php if(form_error('beta')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Beta
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> 1 :  </div>
									<input type="number" name="beta" step="0.1" min="0.1" class="form-control" value="<?php  echo $points_ratio->beta; ?>"  placeholder="Enter Ratio for Discount Points">
									<?php echo form_error('beta') ?>
								</div>
								</div>
						</div>			


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_ratio" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Points Ratio
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
    <!-- Page script -->
    
<?php } ?>

