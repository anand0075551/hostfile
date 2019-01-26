
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
                    <h3 class="box-title">Create Business Loans/Schemes Applicable to Wallet/Loyality/Discount Points</h3> 
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					
<br><br>
						<div class="form-group <?php if(form_error('loan_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loan Type</label>
                            <div class="input-group">  
								<select name="loan_type" class="form-control">
										<option value="">Select Loan Account </option>
																			
										<?php foreach($loan_type->result() as $loan){
													echo '<option value="'.$loan->id.'">'.$loan->rolename.'</option>';
												}                                        
										?>						
									</select>
							</div>	
						<br>
							<label for="firstName" class="col-md-3">Points Mode</label>
                            <div class="col-md-9">
                                <div class="input-group">   
							
							<input type="radio" name="points_mode"   value="wallet" checked id="wallet" /> Wallet/Cash
						<br>	<input type="radio" name="points_mode"   value="loyality" id="loyality" /> Loyality
						<br>	<input type="radio" name="points_mode"   value="discount" id="discount" /> Discount
													
							<br><br>
								</div>
							</div>	
						</div>	
						<div class="form-group <?php if(form_error('acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loan Accounts Type</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<select name="acct_id" class="form-control">
										<option value="">Accounts Type </option>
																			
										<?php foreach($main_account->result() as $account){
													echo '<option value="'.$account->id.'">'.$account->name.'</option>';
												}                                        
										?>		
											
				
				
									</select>		         
							   </div>
                                <?php echo form_error('acct_id') ?>
                            </div>
                        </div>						
						
						<div class="form-group <?php if(form_error('sub_acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loan Sub-Account Type</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<select name="sub_acct_id" class="form-control">
										<option value="">Sub-Accounts Type </option>
										<?php foreach($sub_account->result() as $account){
													echo '<option value="'.$account->id.'">'.$account->name.'</option>';
												}                                        
										?>
									</select>		         
							   </div>
                                <?php echo form_error('sub_acct_id') ?>
                            </div>
                        </div>
						<hr />

						
							<div class="form-group <?php if(form_error('to_role')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Beneficiary/Client User Type</label>
                            <div class="col-md-9">
							
									<select name="to_role" class="form-control">
										<option value=""> Client - Role Type </option>
											<?php foreach($roles->result() as $role){
													echo '<option value="'.$role->id.'">'.$role->rolename.'</option>';
												}                                        
										?>	
									</select>		         
							   </div>
                                <?php echo form_error('to_role') ?>
                            </div>
                        </div>						
						<hr />
                        <div class="form-group <?php if(form_error('loan_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Loan Scheme Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="loan_name" class="form-control" value="<?php echo set_value('loan_name'); ?>" placeholder="Enter Loan Scheme Name">
                                <?php echo form_error('loan_name') ?>
                            </div>
                        </div>
						<hr />
                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> Sanction Amount/Value
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="amount" class="form-control" value="<?php echo set_value('amount'); ?>" placeholder="Enter Value">
                                <?php echo form_error('amount') ?>
                            </div>
                        </div>
						<hr />						  
						
						 <div  class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Select the Date range:
                                <span class="text-red"></span>
                            </label>                           
                            <div class="col-md-9">
								<div class="input-group">
								Start Date 	<input type="date" id="start_date" name="start_date" value="<?php echo date('Y-m-d'); ?>" >
								End   Date    <input type="date" id="end_date"   name="end_date"   value="<?php echo '9999-12-31'; ?>"> 
									<?php echo form_error('start_date') ?>
								</div>
							</div>
						</div>
<hr />
						<div  class="form-group <?php if(form_error('tenure')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Select The Repayment Tenures</label>
								 <select name="tenure" class="input-group">
										<option value=""> Select No of EMI Tenures </option>
										<option value="1" <?php echo set_select('tenure', '1')  ?>>01</option>
										<option value="2" <?php echo set_select('tenure', '2') 	 ?>>02</option>
										<option value="3" <?php echo set_select('tenure', '3') ?>>03</option>
										<option value="4" <?php echo set_select('tenure', '4') ?>>04</option>										
										<option value="5" <?php echo set_select('tenure', '5') ?>>05</option>
										<option value="6" <?php echo set_select('tenure', '6') ?>>06</option>
										<option value="7" <?php echo set_select('tenure', '7') ?>>07</option>										
										<option value="8" <?php echo set_select('tenure', '8') ?>>08</option>
										<option value="9" <?php echo set_select('tenure', '9') ?>>09</option>
										<option value="10" <?php echo set_select('tenure', '10') ?>>10</option>
										<option value="20" <?php echo set_select('tenure', '20') ?>>20</option>
										<option value="30" <?php echo set_select('tenure', '30') ?>>30</option>										
										
								 </select>

						</div>
					<hr />
						<div  class="form-group <?php if(form_error('period')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Select The Repayment Periods</label>
								 <select name="period" class="input-group">
										<option value=""> Select Period </option>
										<option value="1" <?php echo set_select('period', '1') 	 ?>>Daily  / 1 Day</option>
										<option value="7" <?php echo set_select('period', '7') 	 ?>>07 Days / 1 Week</option>									
										<option value="30" <?php echo set_select('period', '30') ?>>30 Days / 1 Month</option>										
																			
										
								 </select>

						</div>
<hr />
			

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">    <!-- PATH: Bank/create_loans -->
                        <button type="submit" name="submit" value="create_loans" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Create Loans/Schemes
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

