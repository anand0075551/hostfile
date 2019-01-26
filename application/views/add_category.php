<!--/*************************************************** Not Using Currently ****************************************/--->
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
                    <h3 class="box-title">Create gory catBusiness Vouchers</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					<!--	
<!--/*************************************************** Not Using Currently ****************************************/--->
						<div class="form-group <?php if(form_error('acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Accounts Type</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<select name="acct_id" class="form-control">
										<option value="">Accounts Type </option>
										<?php 
										$conn = mysqli_connect("localhost","root","", "wallet");
										$data = array();
										$res = mysqli_query($conn,"select * from acct_categories where parentid ='0'");
										while($row = mysqli_fetch_object($res))
										{
											echo "<option value=".$row->id.">".$row->name."</option>";					
										}
										?>
											
<!--/*************************************************** Not Using Currently ****************************************/--->				
				
									</select>		         
							   </div>
                                <?php echo form_error('acct_id') ?>
                            </div>
                        </div>		-->				
						
						<div class="form-group <?php if(form_error('sub_acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Sub-Account Type</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<select name="sub_acct_id" class="form-control">
										<option value="">Sub-Accounts Type </option>
										<?php 
										$conn = mysqli_connect("localhost","root","", "wallet");
										$data = array();
										$res = mysqli_query($conn,"select * from acct_categories where parentid !='0'");
										while($row = mysqli_fetch_object($res))
										{
											echo "<option value=".$row->id.">".$row->name."</option>";
										}
										?>
									</select>		         
							   </div>
                                <?php echo form_error('sub_acct_id') ?>
                            </div>
                        </div>
						<hr />
				<!--	<div class="box-body">
							<div class="col-md-9">
							<label>Select the Date range:</label>
								<div class="form-inline">
									<div class="form-group">
										<label class="sr-only" for="exampleInputAmount">Amount (in Rupees)</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control" id="reservation" name="searchByNameInput" placeholder="Search within date range">
										</div>
									</div>
								   <!-- <button type="submit" id="searchByDateBtn" value="add_vouchers"  class="btn btn-primary">Add Voucher</button> - ->
								</div>
							</div>
						</div> -->
						<div class="form-group <?php if(form_error('to_role')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Client Type</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<select name="to_role" class="form-control">
										<option value=""> Client - Role Type </option>
										<?php 
										$conn = mysqli_connect("localhost","root","", "wallet");
										$data = array();
										$res = mysqli_query($conn,"select * from role where id !='0' and type = 'role_name'");
										while($row = mysqli_fetch_object($res))
										{
											echo "<option value=".$row->id.">".$row->rolename."</option>";
										}
										?>
									</select>		         
							   </div>
                                <?php echo form_error('to_role') ?>
                            </div>
                        </div>						
						<hr />
                        <div class="form-group <?php if(form_error('voucher_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="voucher_name" class="form-control" value="<?php echo set_value('voucher_name'); ?>" placeholder="Enter Coupon/Voucher Name">
                                <?php echo form_error('voucher_name') ?>
                            </div>
                        </div>
						<hr />
						 <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Amount
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="amount" class="form-control" value="<?php echo set_value('amount'); ?>" placeholder="Enter Amount Name">
                                <?php echo form_error('amount') ?>
                            </div>
                        </div>
						<hr />
							 <div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Select the Date range:
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
							<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											
                               <input type="date" class="form-control" id="start_date" name="start_date">
							   <input type="date" class="form-control" id="end_date" name="end_date">
                                <?php echo form_error('start_date') ?>
                            </div>
                        </div>
						</div>
									
						<hr />
						
						 <div class="form-group <?php if(form_error('transferrable')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="transferrable" class="form-control">
                                <option value=""> Select Type </option>
                                <option value="yes" <?php echo set_select('type', 'Transferrable') ?>>Transferrable</option>
                                <option value="no" <?php echo set_select('type', 'Non-Transferrable') ?>>Non-Transferrable</option>
                            </select>
                                <?php echo form_error('transferrable') ?>
                            </div>
                        </div> 
						<hr />
						<div class="form-group <?php if(form_error('commission')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Set Commisions to 'Seller'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="commission" step="0.1" min="0.1" class="form-control" value="<?php echo set_value('commission'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('commission') ?>
								</div>
								</div>
						</div>
						<div class="form-group <?php if(form_error('benefits')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Set Benefits to 'Client'
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
								<div class="input-group">
								 <div class="input-group-addon"> % </div>
									<input type="number" name="benefits" step="0.1" min="0.1" class="form-control" value="<?php echo set_value('benefits'); ?>" placeholder="Enter Percentage Value">
									<?php echo form_error('benefits') ?>
								</div>
								</div>
						</div>			


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_category" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Category
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->


<!--/*************************************************** Not Using Currently ****************************************/--->
        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
    <!-- Page script -->
    
<?php } ?>

