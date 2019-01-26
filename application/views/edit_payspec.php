
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
                    <h3 class="box-title">Update/Edit Sub Accounts/Pay Specification Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->                
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-vertical']); ?>				
                    <div class="box-body">
					
	
<br><br>
                        <div class="form-group <?php if(form_error('category_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Payspecification/ Sub-Account
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="category_name" class="form-control" 
								value="<?php echo $category->name; ?>" placeholder="Enter Sub-Accounts/Pay Specification">
                                <?php echo form_error('category_name') ?>
                            </div>
                        </div>	
						<br>	<br>	
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
					<!-- 		category/edit_payspec	and	category_model->edit_payspec-->
                        <button type="submit" name="submit" value="edit_payspec" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Sub-Account Category
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


