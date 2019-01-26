
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
                    <h3 class="box-title">Add New Sub Accounts Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->                
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-vertical']); ?>				
                    <div class="box-body">
					
	
<br><br>
                        <div class="form-group <?php if(form_error('category_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Accounts Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="category_name" class="form-control" 
								value="<?php echo set_value('category_name'); ?>" placeholder="Enter Sub-Accounts/Pay Specification">
                                <?php echo form_error('category_name') ?>
                            </div>
                        </div>	
						<br>	<br>	<br>
						 <div class="form-group <?php if(form_error('category_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Accounts Category Type</label>
                            <div class="col-md-9">
												<!-- info row -->
							  <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                                            
									<select required="required" name="category_type" class="form-control">
										<option value=""> Select Accounts Type </option>
												<?php foreach($ledger1->result() as $ledger){
													echo '<option value="'.$ledger->id.'">'.$ledger->name.'</option>';
												}                                        
												?>
										</select>
                                   </div>
                              </div><!-- /.row -->		
							      <?php echo form_error('category_type') ?>
							    </div>
                        </div> 
						<br>	<br>	<br>
						<div class="form-group <?php if(form_error('visible')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Accounts User Type/Rolename Group?</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                   
									<select type="number" name="visible" id="visible">
											<option value="0"> Company Ledger</option>
											<option value="1"> Agent Groups</option> 
											<option value="2"> Customer Groups</option> 
											</select>
                                    
                                </div>
                                <?php echo form_error('visible') ?>
                            </div>
                        </div> 
			
						
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- 		category/add_acct_sub_category	and	category_model->add_acct_sub_category-->
                        <button type="submit" name="submit" value="add_acct_sub_category" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Accounts Sub Category
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


