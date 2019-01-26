
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
                    <h3 class="box-title">Points Conversion Ratio Table</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">										
						<div class="form-group <?php if(form_error('identity_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Select Convertion Ratio Type
							<span class="text-red"></span></label>
                            <div class="col-md-9">    
							
							<input type="radio" name="identity_id"  <?php if (isset($identity_id) && $identity_id=="wallet") ;?> value="wallet" checked id="wallet" />   Wallet/Cash 		 
							<input type="radio" name="identity_id"  <?php if (isset($identity_id) && $identity_id=="loyality") ;?> value="loyality"  	  id="loyality"/> Loyality        
							<input type="radio" name="identity_id"  <?php if (isset($identity_id) && $identity_id=="discount") ;?> value="discount" 	  id="discount"/> Discount 
							<input type="radio" name="identity_id"  <?php if (isset($identity_id) && $identity_id=="bonus") ;?> value="bonus" 		  	  id="bonus" />   Bonus 
							
							
                             <?php echo form_error('identity_id') ?>
                            </div>							
                        </div>	
						
						
						<div class="form-group <?php if(form_error('alpha')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> Alpha
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
							<div class="input-group">
							<div class="input-group-addon"> 1 : </div>
                                <input type="number" name="alpha" step="0.1" min="0.1"  class="form-control" value="<?php echo set_value('alpha'); ?>" placeholder="Enter Ratio for Alpha">
                                <?php echo form_error('alpha') ?>
                            </div>
								</div>
                        </div>
						
						<div class="form-group <?php if(form_error('beta')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> Beta
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> 1 :  </div>
									<input type="number" name="beta" step="0.1" min="0.1" class="form-control" value="<?php echo set_value('beta'); ?>"  placeholder="Enter Ratio for Beta">
									<?php echo form_error('beta') ?>
								</div>
								</div>
						</div>			
						
						<div class="form-group <?php if(form_error('gamma')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> Gamma
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
							<div class="input-group">
							<div class="input-group-addon"> 1 : </div>
                                <input type="number" name="gamma" step="0.1" min="0.1"  class="form-control" value="<?php echo set_value('gamma'); ?>" placeholder="Enter Ratio for Gamma">
                                <?php echo form_error('gamma') ?>
                            </div>
								</div>
                        </div>
						
						<div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Select the Effective Start Date:
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>												
								   <input type="date" class="form-control" id="start_date" name="start_date">								 
									<?php echo form_error('start_date') ?>
								</div>
							</div>
						</div>
									
						<hr />
						<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Comments for Editing this Page
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="remarks" class="form-control" value="<?php echo set_value('remarks'); ?>" placeholder="Enter Description for change Ratio">
                                <?php echo form_error('remarks') ?>
                            </div>
                        </div>
						
				<!--		<div class="form-group <?php if(form_error('discount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loyality To Discount
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> 1 :  </div>
									<input type="number" name="discount" step="0.1" min="0.1" class="form-control" value="<?php echo set_value('discount'); ?>"  placeholder="Enter Ratio for Loyality To Discount Points">
									<?php echo form_error('discount') ?>
								</div>
								</div>
						</div>			
						<hr />
						<div class="form-group <?php if(form_error('loyality')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Discount To Wallet 
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
							<div class="input-group">
							<div class="input-group-addon"> 1 : </div>
                                <input type="number" name="loyality" step="0.1" min="0.1"  class="form-control" value="<?php echo set_value('loyality'); ?>" placeholder="Enter Ratio for Discount To Wallet/Cash ">
                                <?php echo form_error('loyality') ?>
                            </div>
								</div>
                        </div>
						
						<div class="form-group <?php if(form_error('discount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Discount To Loyality
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> 1 :  </div>
									<input type="number" name="discount" step="0.1" min="0.1" class="form-control" value="<?php echo set_value('discount'); ?>"  placeholder="Enter Ratio for Discount To Loyality Points">
									<?php echo form_error('discount') ?>
								</div>
								</div>
						</div>			
								
-->
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">    <!-- PATH: Category/points_ratio-->
                        <button type="submit" name="submit" value="points_ratio" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Create New Points Ratio
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

