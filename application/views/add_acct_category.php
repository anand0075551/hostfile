
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
                    <h3 class="box-title">Add New Accounts Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-vertical']); ?>
                    <div class="box-body">

                        <div class="form-group <?php if(form_error('category_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Accounts Category Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="category_name" class="form-control" value="<?php echo set_value('category_name'); ?>" placeholder="Enter New Accounts Category Name">
                                <?php echo form_error('category_name') ?>
                            </div>
                        </div>
	

<!--						
<br><br>
                  <div class="form-group < ?php if(form_error('visible')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Visbile To Agent and Customer ?</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                   
									<select name="visible" id="visible">
											<option value="1"> Yes </option>
											<option value="0"> No </option> 
											
											</select>
                                    
                                </div>
                                < ?php echo form_error('visible') ?>
                            </div>
                        </div> 
						-->
<br><br>
                  <div class="form-group <?php if(form_error('ledger_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Ledger Type</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                   
									<select name="ledger_type" id="ledger_type">
											<option value="0"> Incoming </option>
											<option value="1"> Outgoing </option> 
											
											</select>
                                    
                                </div>
                                <?php echo form_error('ledger_type') ?>
                            </div>
                        </div> 


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- 		Ledger/add_acct_category	and	Ledger_model->add_acct_category-->
                        <button type="submit" name="submit" value="add_acct_category" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Accounts Category
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

