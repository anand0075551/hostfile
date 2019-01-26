
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
                    <h3 class="box-title">Create Business Vouchers Applicable to Wallet/Loaylity/Discount Points</h3> 
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					
<br><br>
						<div class="form-group <?php if(form_error('to_role')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Type</label>
                            <div class="input-group">  
								<div class="col-md-12">                                 
								<input type="radio" name="voc_type"  <?php if (isset($voc_type) && $voc_type=="Private") ;?> value="Private" checked id="Private" /> Private Voucher 
						<br>	<input type="radio" name="voc_type"  <?php if (isset($voc_type) && $voc_type=="Split") ;?> value="Split" id="Split" /> Splitting Vouchers(No loyality Points)
						<br>	<input type="radio" name="voc_type"  <?php if (isset($voc_type) && $voc_type=="Advance_trading") ;?> value="Advance_trading" id="Advance_trading" /> Trading/Reserve Ticket							
							
								</div>
							</div>	
						
							<label for="firstName" class="col-md-3">Transferrable Type?</label>
                            <div class="col-md-9">
                                <div class="input-group">   
							
						<br>	<input type="radio" name="transferrable"  <?php if (isset($transferrable) && $transferrable=="yes") ;?> value="yes" id="yes" /> Yes
						<br>	<input type="radio" name="transferrable"  <?php if (isset($transferrable) && $transferrable=="no") ;?> value="no" checked id="no" /> No							
							<br><br>
								</div>
							</div>	
						</div>	
						<div class="form-group <?php if(form_error('acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Accounts Type</label>
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
                            <label for="firstName" class="col-md-3">Voucher Sub-Account Type</label>
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

						
							<div class="form-group <?php if(form_error('sub_acct_id')) echo 'has-error'; ?>">
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
						    <div class="col-md-12"><h4> Purchase Type and Amount </h4></div> <br>
                            <label for="firstName" class="col-md-3"> Wallet Purchase Cash Value
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
										 <input type="checkbox" name="face_value" id="face_value" value="face_value" checked> Face Value of Cash/Wallet  
										 <input type="number" name="amount"   value="<?php echo set_value('amount'); ?>" placeholder="Enter Cash Value">  
										 <br><br>
							
							<input type="checkbox" name="offer_price" id="offer_price" value="offer_price" checked> Offer Price 
							 <input type="number" name="amount"   value="<?php echo set_value('per'); ?>" placeholder="Enter Percentager"> 
							 <br> <br>
							 
							 
							 <select name="sub_acct_id" class="form-control">
										<option value="">Select 'Pay Specification' For Offer Price Deduction To Maintain Wallet Cost </option>
										<?php foreach($sub_account->result() as $account){
													echo '<option value="'.$account->id.'">'.$account->name.'</option>';
												}                                        
										?>
									</select>	<br>
								Customer Purchase Value of Cash/Wallet  
							 <input type="number" name="amount"   value="<?php echo set_value('amount'); ?>" disabled placeholder="System Generates Face Value">  <br>
						 </div>
						 </div>
						<hr />	 
						<div class="col-md-12">
						 <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
						                             <label for="firstName" class="col-md-3">Loyality Purchase Points
                                <span class="text-red"></span>
                            </label>
							<br> <input type="checkbox" name="loyality" value="loyality"> Loyality Points <input type="number" name="loy_amt" value="<?php echo set_value('loy_amt'); ?>" placeholder="Enter Loyality Points Value"><br>
					 </div><hr />
							</div>	
						<div class="col-md-12"> 
							<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
							                            <label for="firstName" class="col-md-3">Discount Purchase Points
                                <span class="text-red"></span>
                            </label>
						
							<br> <input type="checkbox" name="discount" value="discount"> Discount Points <input type="number" name="dis_amt" value="<?php echo set_value('dis_amt'); ?>" placeholder="Enter Discount Points Value"><br>
                                
                                <?php echo form_error('amount') ?>
                            </div><hr />
							</div>
                        
						
							 <div  <?php if(form_error('start_date')) echo 'has-error'; ?>">
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

					<br><br>					
						<div class="form-group <?php if(form_error('sub_acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Product IDs from POS System</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<select name="sub_acct_id" class="form-control">
										<option value="">Select Products or Services </option>
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
			

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">    <!-- PATH: Vouchers/add_vouchers -->
                        <button type="submit" name="submit" value="add_vouchers" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Voucher
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

