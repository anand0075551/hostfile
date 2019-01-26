<?php
//authorizations.php
//check category/public function wallet_to_discount()


?>
<?php function page_css(){ ?>
 <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

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
                    <h3 class="box-title">Viwe Permissions</h3>
                </div><!-- /.box-header -->
				
				
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					 
								<table class="table table-bordered">
									 <h4 class="box-title" color="red" >Balance Account Sheet </h4>									
								   <tr><th> Admin		</th> <td> Full Access </td></tr>
								   <tr><th> Agent	</th> <td> Retailor/Reseller, Distributor-Agents </td></tr>
								   <tr><th> User		</th> <td> Customer	 </td></tr>
								   
								</table>	

								<hr />

 			
<!--    A D M I N I S T R A T O R < ?php $permissions->role; ?> -->		

							
							 
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Administartor 
											<h4 class="box-title" color="red" ><i>Ledger Accounts </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="01" value="1"> Ledger Overview
												<br>	<input type="checkbox" name="02" value="1"> Maintain Ledger Accounts 
												<br>	<input type="checkbox" name="03" value="1"> Transfer Accounts with one another
												<br>	<input type="checkbox" name="04" value="1"> Add Accounts Category
												<br>	<input type="checkbox" name="05" value="1"> Add Sub-Accounts
												<br>	<input type="checkbox" name="06" value="1"> Create Commisions & Benefits
												<br>	<input type="checkbox" name="07" value="1"> View/Edit Commisions & Benefits
 					
													<?php echo form_error('profession') ?>
											</div>
								</div>
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Administartor
											<h4 class="box-title" color="red" ><i>Sales Transactions </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="08" value="1"> Recieve Fund
												<br>	<input type="checkbox" name="09" value="1"> Recharge Mobile 
												<br>	<input type="checkbox" name="10" value="1"> Book Bus
												<br>	<input type="checkbox" name="11" value="1"> Book Train
												<br>	<input type="checkbox" name="12" value="1"> Book Flight
													
													<?php echo form_error('profession') ?>
											</div>
								</div>
								
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Administartor
											<h4 class="box-title" color="red" ><i>Wallet Conversions </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="13" value="1"> Wallet Ratio
												<br>	<input type="checkbox" name="14" value="1"> Create Wallet Ratio
												<br>	<input type="checkbox" name="15" value="1"> Convert/Exchange Wallet Points
												
													<?php echo form_error('profession') ?>
											</div>
								</div>
								
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Administartor
											<h4 class="box-title" color="red" ><i>Generate Voucher PIN's  </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="16" value="1"> Your Private Vouchers
												<br>	<input type="checkbox" name="17" value="1"> Company Vouchers List 
												<br>	<input type="checkbox" name="18" value="1"> Add Business Voucher
												
													<?php echo form_error('profession') ?>
											</div>
								</div>
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Administartor
											<h4 class="box-title" color="red" ><i>Bank Details</i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="19" value="1"> Approve Deposited Amount
												<br>	<input type="checkbox" name="20" value="1"> Deposit Online
												<br>	<input type="checkbox" name="21" value="1"> Deposit Bank/Offline
												<br>	<input type="checkbox" name="22" value="1"> View Loan Schemes
												<br>	<input type="checkbox" name="23" value="1"> Create Loan Schemes
												<br>	<input type="checkbox" name="24" value="1"> Repayment Status
												
													<?php echo form_error('profession') ?>
											</div>
								</div>

								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Administartor
											<h4 class="box-title" color="red" ><i>Channel Partners(Agents) </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="25" value="1"> All Partners
												<br>	<input type="checkbox" name="26" value="1"> Add New Channel Partners 
													<?php echo form_error('profession') ?>
											</div>
								</div>

								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Administartor
											<h4 class="box-title" color="red" ><i>Customers(User) </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="27" value="1"> All user
												<br>	<input type="checkbox" name="28" value="1"> Profile
												<br>	<input type="checkbox" name="29" value="1"> Change Password
													<?php echo form_error('profession') ?>
											</div>
								</div>

								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Administartor
											<h4 class="box-title" color="red" ><i>Administartor Settings </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="30" value="1"> Benefits Settings
												<br>	<input type="checkbox" name="31" value="1"> Settings Changed Log 
												<br>	<input type="checkbox" name="32" value="1"> Add Admin
												<br>	<input type="checkbox" name="33" value="1"> Admin List
												<br>	<input type="checkbox" name="34" value="1"> List of User Roles
												<br>	<input type="checkbox" name="35" value="1"> Check Permissions
													<?php echo form_error('profession') ?>
											</div>
								</div>

								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Administartor
											<h4 class="box-title" color="red" ><i>Wallet Accounts/Permissions </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="36" value="1"> All Company Account Transactions
												<br>	<input type="checkbox" name="37" value="1"> My Account
												<br>	<input type="checkbox" name="38" value="1"> My Referrals
												<br>	<input type="checkbox" name="39" value="1"> User Transactions Commissions
												<br>	<input type="checkbox" name="40" value="1"> Amount Transferred
												<br>	<input type="checkbox" name="41" value="1"> Recieved Payments
												<br>	<input type="checkbox" name="42" value="1"> Requested Payment List
													<?php echo form_error('profession') ?>
											</div>
								</div>
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Administartor
											<h4 class="box-title" color="red" ><i>User Roles</i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="43" value="1"> Authorizations List
												<br>	<input type="checkbox" name="44" value="1"> Create Authorizations
												<br>	<input type="checkbox" name="45" value="1"> List of User Roles
												<br>	<input type="checkbox" name="46" value="1"> Create Permission Group
												<br>	<input type="checkbox" name="47" value="1"> Add Roles To Permission Group
												
													<?php echo form_error('profession') ?>
											</div>
								</div>
																<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Administartor
											<h4 class="box-title" color="red" ><i>Reports </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="48" value="1"> Commissions Updated Log
												<br>	<input type="checkbox" name="49" value="1"> Geonology report
												<br>	<input type="checkbox" name="50" value="1"> Reports List
												<br>	<input type="checkbox" name="51" value="1"> C & F Admin\'s Sales
													<?php echo form_error('profession') ?>
											</div>
								</div>
								
								
								
								<hr />	
<!--    A G E N T S -->										
								
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Agent
											<h4 class="box-title" color="red" ><i>Ledger Accounts </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Ledger Overview
												<br>	<input type="checkbox" name="ledg_02" value="1"> Maintain Ledger Accounts 
												<br>	<input type="checkbox" name="ledg_03" value="1"> Transfer Accounts with one another
												<br>	<input type="checkbox" name="ledg_04" value="1"> Add Accounts Category
												<br>	<input type="checkbox" name="ledg_05" value="1"> Add Sub-Accounts
												<br>	<input type="checkbox" name="ledg_06" value="1"> Create Commisions & Benefits
												<br>	<input type="checkbox" name="ledg_07" value="1"> View/Edit Commisions & Benefits
 					
													<?php echo form_error('profession') ?>
											</div>
								</div>
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Agent
											<h4 class="box-title" color="red" ><i>Sales Transactions </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Recieve Fund
												<br>	<input type="checkbox" name="ledg_02" value="1"> Recharge Mobile 
												<br>	<input type="checkbox" name="ledg_03" value="1"> Book Bus
												<br>	<input type="checkbox" name="ledg_04" value="1"> Book Train
												<br>	<input type="checkbox" name="ledg_05" value="1"> Book Flight
													
													<?php echo form_error('profession') ?>
											</div>
								</div>
								
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Agent
											<h4 class="box-title" color="red" ><i>Wallet Conversions </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Wallet Ratio
												<br>	<input type="checkbox" name="ledg_02" value="1"> Create Wallet Ratio
												<br>	<input type="checkbox" name="ledg_03" value="1"> Convert/Exchange Wallet Points
												
													<?php echo form_error('profession') ?>
											</div>
								</div>
								
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Agent
											<h4 class="box-title" color="red" ><i>Generate Voucher PIN's  </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Your Private Vouchers
												<br>	<input type="checkbox" name="ledg_02" value="1"> Company Vouchers List 
												<br>	<input type="checkbox" name="ledg_03" value="1"> Add Business Voucher
												
													<?php echo form_error('profession') ?>
											</div>
								</div>
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Agent
											<h4 class="box-title" color="red" ><i>Bank Details</i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Approve Deposited Amount
												<br>	<input type="checkbox" name="ledg_02" value="1"> Deposit Online
												<br>	<input type="checkbox" name="ledg_03" value="1"> Deposit Bank/Offline
												<br>	<input type="checkbox" name="ledg_04" value="1"> View Loan Schemes
												<br>	<input type="checkbox" name="ledg_05" value="1"> Create Loan Schemes
												<br>	<input type="checkbox" name="ledg_06" value="1"> Repayment Status
												
													<?php echo form_error('profession') ?>
											</div>
								</div>

								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Agent
											<h4 class="box-title" color="red" ><i>Channel Partners(Agents) </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> All Partners
												<br>	<input type="checkbox" name="ledg_02" value="1"> Add New Channel Partners 
													<?php echo form_error('profession') ?>
											</div>
								</div>

								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Agent
											<h4 class="box-title" color="red" ><i>Customers(User) </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> All user
												<br>	<input type="checkbox" name="ledg_02" value="1"> Profile
												<br>	<input type="checkbox" name="ledg_03" value="1"> Change Password
													<?php echo form_error('profession') ?>
											</div>
								</div>

								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Agent
											<h4 class="box-title" color="red" ><i>Administartor Settings </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Benefits Settings
												<br>	<input type="checkbox" name="ledg_02" value="1"> Settings Changed Log 
												<br>	<input type="checkbox" name="ledg_03" value="1"> Add Admin
												<br>	<input type="checkbox" name="ledg_04" value="1"> Admin List
												<br>	<input type="checkbox" name="ledg_05" value="1"> List of User Roles
												<br>	<input type="checkbox" name="ledg_06" value="1"> Check Permissions
													<?php echo form_error('profession') ?>
											</div>
								</div>

								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Agent
											<h4 class="box-title" color="red" ><i>Wallet Accounts/Permissions </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> All Company Account Transactions
												<br>	<input type="checkbox" name="ledg_02" value="1"> My Account
												<br>	<input type="checkbox" name="ledg_03" value="1"> My Referrals
												<br>	<input type="checkbox" name="ledg_04" value="1"> User Transactions Commissions
												<br>	<input type="checkbox" name="ledg_05" value="1"> Amount Transferred
												<br>	<input type="checkbox" name="ledg_06" value="1"> Recieved Payments
												<br>	<input type="checkbox" name="ledg_07" value="1"> Requested Payment List
													<?php echo form_error('profession') ?>
											</div>
								</div>
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Agent
											<h4 class="box-title" color="red" ><i>User Roles</i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Authorizations List
												<br>	<input type="checkbox" name="ledg_02" value="1"> Create Authorizations
												<br>	<input type="checkbox" name="ledg_03" value="1"> List of User Roles
												<br>	<input type="checkbox" name="ledg_04" value="1"> Create Permission Group
												<br>	<input type="checkbox" name="ledg_05" value="1"> Add Roles To Permission Group
												
													<?php echo form_error('profession') ?>
											</div>
								</div>
																<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Agent
											<h4 class="box-title" color="red" ><i>Reports </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Commissions Updated Log
												<br>	<input type="checkbox" name="ledg_02" value="1"> Geonology report
												<br>	<input type="checkbox" name="ledg_03" value="1"> Reports List
												<br>	<input type="checkbox" name="ledg_04" value="1"> C & F Admin\'s Sales
													<?php echo form_error('profession') ?>
											</div>
								</div>
								
								<hr />		
<!--    C U S T O M E R -->							
							 
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Customer
											<h4 class="box-title" color="red" ><i>Ledger Accounts </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Ledger Overview
												<br>	<input type="checkbox" name="ledg_02" value="1"> Maintain Ledger Accounts 
												<br>	<input type="checkbox" name="ledg_03" value="1"> Transfer Accounts with one another
												<br>	<input type="checkbox" name="ledg_04" value="1"> Add Accounts Category
												<br>	<input type="checkbox" name="ledg_05" value="1"> Add Sub-Accounts
												<br>	<input type="checkbox" name="ledg_06" value="1"> Create Commisions & Benefits
												<br>	<input type="checkbox" name="ledg_07" value="1"> View/Edit Commisions & Benefits
 					
													<?php echo form_error('profession') ?>
											</div>
								</div>
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Customer
											<h4 class="box-title" color="red" ><i>Sales Transactions </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Recieve Fund
												<br>	<input type="checkbox" name="ledg_02" value="1"> Recharge Mobile 
												<br>	<input type="checkbox" name="ledg_03" value="1"> Book Bus
												<br>	<input type="checkbox" name="ledg_04" value="1"> Book Train
												<br>	<input type="checkbox" name="ledg_05" value="1"> Book Flight
													
													<?php echo form_error('profession') ?>
											</div>
								</div>
								
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Customer
											<h4 class="box-title" color="red" ><i>Wallet Conversions </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Wallet Ratio
												<br>	<input type="checkbox" name="ledg_02" value="1"> Create Wallet Ratio
												<br>	<input type="checkbox" name="ledg_03" value="1"> Convert/Exchange Wallet Points
												
													<?php echo form_error('profession') ?>
											</div>
								</div>
								
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Customer
											<h4 class="box-title" color="red" ><i>Generate Voucher PIN's  </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Your Private Vouchers
												<br>	<input type="checkbox" name="ledg_02" value="1"> Company Vouchers List 
												<br>	<input type="checkbox" name="ledg_03" value="1"> Add Business Voucher
												
													<?php echo form_error('profession') ?>
											</div>
								</div>
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Customer
											<h4 class="box-title" color="red" ><i>Bank Details</i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Approve Deposited Amount
												<br>	<input type="checkbox" name="ledg_02" value="1"> Deposit Online
												<br>	<input type="checkbox" name="ledg_03" value="1"> Deposit Bank/Offline
												<br>	<input type="checkbox" name="ledg_04" value="1"> View Loan Schemes
												<br>	<input type="checkbox" name="ledg_05" value="1"> Create Loan Schemes
												<br>	<input type="checkbox" name="ledg_06" value="1"> Repayment Status
												
													<?php echo form_error('profession') ?>
											</div>
								</div>

								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Customer
											<h4 class="box-title" color="red" ><i>Channel Partners(Agents) </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> All Partners
												<br>	<input type="checkbox" name="ledg_02" value="1"> Add New Channel Partners 
													<?php echo form_error('profession') ?>
											</div>
								</div>

								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Customer
											<h4 class="box-title" color="red" ><i>Customers(User) </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> All user
												<br>	<input type="checkbox" name="ledg_02" value="1"> Profile
												<br>	<input type="checkbox" name="ledg_03" value="1"> Change Password
													<?php echo form_error('profession') ?>
											</div>
								</div>

								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Customer
											<h4 class="box-title" color="red" ><i>Administartor Settings </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Benefits Settings
												<br>	<input type="checkbox" name="ledg_02" value="1"> Settings Changed Log 
												<br>	<input type="checkbox" name="ledg_03" value="1"> Add Admin
												<br>	<input type="checkbox" name="ledg_04" value="1"> Admin List
												<br>	<input type="checkbox" name="ledg_05" value="1"> List of User Roles
												<br>	<input type="checkbox" name="ledg_06" value="1"> Check Permissions
													<?php echo form_error('profession') ?>
											</div>
								</div>

								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Customer
											<h4 class="box-title" color="red" ><i>Wallet Accounts/Permissions </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> All Company Account Transactions
												<br>	<input type="checkbox" name="ledg_02" value="1"> My Account
												<br>	<input type="checkbox" name="ledg_03" value="1"> My Referrals
												<br>	<input type="checkbox" name="ledg_04" value="1"> User Transactions Commissions
												<br>	<input type="checkbox" name="ledg_05" value="1"> Amount Transferred
												<br>	<input type="checkbox" name="ledg_06" value="1"> Recieved Payments
												<br>	<input type="checkbox" name="ledg_07" value="1"> Requested Payment List
													<?php echo form_error('profession') ?>
											</div>
								</div>
								<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Customer
											<h4 class="box-title" color="red" ><i>User Roles</i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Authorizations List
												<br>	<input type="checkbox" name="ledg_02" value="1"> Create Authorizations
												<br>	<input type="checkbox" name="ledg_03" value="1"> List of User Roles
												<br>	<input type="checkbox" name="ledg_04" value="1"> Create Permission Group
												<br>	<input type="checkbox" name="ledg_05" value="1"> Add Roles To Permission Group
												
													<?php echo form_error('profession') ?>
											</div>
								</div>
																<div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">								
									<label for="firstName" class="col-md-3">Customer
											<h4 class="box-title" color="red" ><i>Reports </i></h4>
									</label>
										
											<div class="col-md-9">									   
														<input type="checkbox" name="ledg_01" value="1"> Commissions Updated Log
												<br>	<input type="checkbox" name="ledg_02" value="1"> Geonology report
												<br>	<input type="checkbox" name="ledg_03" value="1"> Reports List
												<br>	<input type="checkbox" name="ledg_04" value="1"> C & F Admin\'s Sales
													<?php echo form_error('profession') ?>
											</div>
								</div>
								
								
								<hr />										
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
</table>

                    <div class="box-footer">      <!-- PATH: //check category/public function wallet_to_discount() -->
                        <button type="submit" name="submit" value="update_authorizations" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Save Authorizations Settings
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
<!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            var oTable = $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url('category/categoryListJson'); ?>",
                    "data": function ( d ) {
                        d.dateRange = $('[name="searchByNameInput"]').val();
                    }
                }
            });

            $('button#searchByDateBtn').on('click', function(){
                oTable.fnDraw();
            });

        });

    </script>



    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- Page script -->
    <script type="text/javascript">
        $(function() {
            //Date range picker
            $('#reservation').daterangepicker({ format: 'YYYY-MM-DD' });
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        });
    </script>

<!--Anand J-query-->
	
<script>
<!-- For Convertion Ratio Flip View -->
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});




$(document).ready(function(){
    $("#hide").click(function(){
        $("#div1").hide();
		// alert("The paragraph is now hidden");
    });
    $("#show").click(function(){
        $("#div1").show();
		// alert("The paragraph is now Showing");
    });
});

$(document).ready(function(){
    $("#hide").click(function(){
        $("#div2").hide();
		// alert("The paragraph is now hidden");
    });
    $("#show").click(function(){
        $("#div2").show();
		// alert("The paragraph is now Showing");
    });
});
$(document).ready(function(){
     $("button").click(function(){
        $("#div1").fadeIn();
        $("#div2").fadeIn("slow");
        $("#div3").fadeIn(3000);
    });
});


</script>

<style>
#panel, #flip {
    padding: 5px;
    text-align: center;
    background-color: #e5eecc;
    border: solid 1px #c3c3c3;
}

#panel {
    padding: 50px;
    display: none;
}
</style>
</head>

<?php } ?>

