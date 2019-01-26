 <?php
	foreach($total_wallet->result() as $wallet);  //total_wallet points calc from Ledgr_Model/PF $total_wallet
	foreach($total_wallet_debit->result() as $debit);
	foreach($total_wallet_credit->result() as $credit);
 
$total_wallet 		 = $wallet->amount; //total_wallet
$total_wallet_debit  = $debit->debit;
$total_wallet_credit = $credit->credit;

foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 
foreach( $loy_debit->result() 		as $loy_debit);
foreach( $loy_credit->result() 		as $loy_credit);
foreach( $dis_debit->result() 		as $dis_debit);
foreach( $dis_credit->result() 		as $dis_credit);

$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;
$loy_debit			= $loy_debit->debit;
$loy_credit      	= $loy_credit->credit;
$dis_debit			= $dis_debit->debit;
$dis_credit      	= $dis_credit->credit;
/* Available Balance Wallet,loyality and Discount Points */

//$wallet  		= $totalWallet;
$wallet_balance    = ( $wal_debit - $wal_credit ) ;
$loyality_balance  = ( $loy_debit - $loy_credit ) ;
$discount_balance  = ( $dis_debit - $dis_credit ) ;


?>
<?php
$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$referral_code = singleDbTableRow($user_id)->referral_code;		 
		$currentUser   = singleDbTableRow($user_id)->role;
?>
<?php include('header.php'); ?>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        <!-- < ?php echo $commissions->remarks.' '. $commissions->remarks; ?>-->
										
                                    </h3>
                                </div><!-- /.box-header -->
								
									<div class="box-body">
					<h4 class="box-title">Available Balance as on <?php echo date('F j, Y, g:i a') ?> to Generate/Purchase Vouchers</h4>
				<!--	<h4 class="box-title">Available Balance as on <?php echo date('Y-m-d h-i-s') ?> to Generate/Purchase Vouchers</h4>	 -->		
								
						<table class="table table-bordered">
						
							<tr><th> Cash/Wallet 	  </th> <td> <?php echo amountFormat($wallet_balance );   ?> 	 </td></tr>
							<tr><th> Loyality Points  </th> <td> <?php echo ($loyality_balance); ?>	 </td></tr>
							<tr><th> Discount Points  </th> <td> <?php echo ($discount_balance); ?>	 </td></tr>
						</table>	
								
					</div>	
					
                                    <div class="box-body">

                                        <table class="table table-striped">
											<tr>
                                                <th width="20%">Business Voucher Type</th>
                                                <th><?php echo $commissions->type; ?></th> 
                                            </tr>										
                                            <tr>
                                                <th width="20%">Voucher Name</th>
                                                <th><?php echo $commissions->remarks; ?></th> 
                                            </tr>
											<tr>
                                                <td>Business Voucher ID</td>
                                                <td><?php echo $commissions->identity_id; ?></td> 
                                            </tr>											
                                            <tr>
                                                <td>Voucher Face Value</td>
                                                <td><?php echo $commissions->amount; ?></td> 
                                            </tr>
											                                            <tr>
                                                <td>Voucher Purchase Value(Loyality)</td>
                                                <td><?php echo $commissions->loy_amt; ?></td> 
                                            </tr>
                                            <tr>
                                                <td>Voucher Purchase Value(Discount)</td>
                                                <td><?php echo $commissions->dis_amt; ?></td> 
                                            </tr>												                                            
											<tr>
                                                <td>Voucher Purchase Value(Wallet)</td>
                                                <td><?php echo $commissions->amount; ?></td> 
                                            </tr>
                                            <tr>
                                                <td>Voucher Valid From</td>
                                                <td><?php echo $commissions->start_date; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Voucher Valid Till</th>
                                                <th><?php echo $commissions->end_date; ?></th>
                                            </tr>
									
									<?php 	$user_info = $this->session->userdata('logged_user');
									$user_id = $user_info['user_id'];									
									$currentUser   = singleDbTableRow($user_id)->role;
									 if($currentUser == 'admin')  { ?>
                                            
											<tr>
                                                <th>Main Accounts / Business Specifications</th>
												<?php $bus_spec = ledgerDbTableRow($commissions->acct_id)->name; 													  
												 if ($bus_spec == 'NULL') {$bus_spec = 'Not Available';} ?>
                                                <th><?php echo $bus_spec; ?></th> 
                                            </tr>
                                            <tr>
                                                <td>Sub-Account / Pay Specifications</td>                                         
												<?php $pay_spec = ledgerDbTableRow($commissions->sub_acct_id)->name; 													  
												 if ($pay_spec == 'NULL') {$pay_spec = 'Not Available';} ?>
                                                <th><?php echo $pay_spec; ?></th> 
                                            </tr>	                                            
											
											  <tr>
                                                <td>Business Voucher Created By</td>
                                                <?php $fname = singleDbTableRow($commissions->created_by)->first_name;	
													$lname = singleDbTableRow($commissions->created_by)->last_name;
												?>
													<td><?php  echo $fname.' '.$lname; ?></td>
                                            </tr>							
									
                                            <tr>
                                                <td>Business Voucher Assigned to Role Name</td> 
                                               <td><?php 
												$userInfo = singleDbTableRow($commissions->to_role, 'role');
												$roleName = $userInfo->rolename;
												echo $roleName;  ?></td>
												
                                            </tr>
											
											<?php	} ?>
                                     <!--       <tr>
                                                <td>Percentage(%) Commission to You</td>
                                                <td><?php echo $commissions->commission; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Percentage(%) Benefits to Reciever</td>
                                                <td><?php echo $commissions->benefits; ?></td>
                                            </tr>
                                     -->       <tr>
                                                <td>Transferrable</td>
                                                <td><?php echo $commissions->transferrable; ?></td>
                                            </tr>
																		
											<tr>
                                                <td>Generated On</td> 	
                                                <td><?php echo date('d/m/Y h:i A',$commissions->created_at); ?></td>
                                            </tr>										
											<tr>
                                                <td>Last modified ON</td>
                                                <td><?php echo date('d/m/Y h:i A',$commissions->modified_at); ?></td>
                                            </tr>										
                                            <tr>     
                                            </tr>
											<tr>
                                                <td>Last modified BY</td>
												<td><?php $fname = singleDbTableRow($commissions->modified_by)->first_name ;
														  $lname = singleDbTableRow($commissions->modified_by)->last_name ;												
												echo $fname.' '.$lname ?></td>
											
                                            </tr>	                                            
                                          
                                     


                                        </table>

                                    </div><!-- /.box-body -->
<!-- For Admin to Edit Business Voucher view page data -->
                                    <div class="box-footer">
								<?php	if ( $currentUser == 'admin')  { ?>
		 <a href="<?php echo base_url('vouchers/edit/'.$commissions->id) ?>"   class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>  
	<?php }?>
	
	
	
	
	
	<?php	if ( $commissions->type == 'Private')  
			{	if ($wallet_balance > $commissions->amount) { ?>		
				<a href="<?php echo base_url('vouchers/create_vouchers/'.$commissions->id ) ?>" class="btn btn-danger"><i class="fa fa-bar-chart">
				</i> Verify Private Wallet Voucher to Generate</a>
				<?php } ?>
	
				<?php if ($loyality_balance > $commissions->loy_amt && $commissions->loy_amt > '0') { ?>		
				<a href="<?php echo base_url('vouchers/create_vouchers/'.$commissions->id ) ?>" class="btn btn-primary"><i class="fa fa-bar-chart">
				</i> Verify Private Loyality Voucher to Generate</a>
				<?php } ?>
				
				<?php if ($discount_balance > $commissions->dis_amt && $commissions->dis_amt > '0') { ?>		
				<a href="<?php echo base_url('vouchers/create_vouchers/'.$commissions->id ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart">
				</i> Verify Private Discount Voucher to Generate</a>
				<?php } ?>
	
	
	<?php }elseif ( $commissions->type == 'Split')
			{ 	if ($wallet_balance > $commissions->amount) { ?>		
				<a href="<?php echo base_url('vouchers/split_vouchers/'.$commissions->id ) ?>" class="btn btn-danger"><i class="fa fa-bar-chart">
				</i> Verify Split Wallet Voucher to Generate</a>
				<?php } ?>
	
				<?php if ($loyality_balance > $commissions->loy_amt && $commissions->loy_amt > '0') { ?>		
				<a href="<?php echo base_url('vouchers/split_vouchers/'.$commissions->id ) ?>" class="btn btn-primary"><i class="fa fa-bar-chart">
				</i> Verify Split Loyality Voucher to Generate</a>
				<?php } ?>
				
				<?php if ($discount_balance > $commissions->dis_amt && $commissions->dis_amt > '0') { ?>		
				<a href="<?php echo base_url('vouchers/split_vouchers/'.$commissions->id ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart">
				</i> Verify Split Discount Voucher to Generate</a>
				<?php } ?>
	
		
	
	
	
	
	
	
	
	<?php }elseif ( $commissions->type == 'Advance_trading')
	
	{ 	if ($wallet_balance > $commissions->amount) { ?>		
				<a href="<?php echo base_url('vouchers/create_vouchers/'.$commissions->id ) ?>" class="btn btn-danger"><i class="fa fa-bar-chart">
				</i> Verify Advance Trading Wallet Voucher to Generate</a>
				<?php } ?>
	
				<?php if ($loyality_balance > $commissions->loy_amt && $commissions->loy_amt > '0') { ?>		
				<a href="<?php echo base_url('vouchers/create_vouchers/'.$commissions->id ) ?>" class="btn btn-primary"><i class="fa fa-bar-chart">
				</i> Verify Advance Trading Loyality Voucher to Generate</a>
				<?php } ?>
				
				<?php if ($discount_balance > $commissions->dis_amt && $commissions->dis_amt > '0') { ?>		
				<a href="<?php echo base_url('vouchers/create_vouchers/'.$commissions->id ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart">
				</i> Verify Advance Trading Discount Voucher to Generate</a>
				<?php } ?>
	
	
	
		<!-- <a href="<?php echo base_url('vouchers/create_vouchers/'.$commissions->id ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Verify Advance Trading Voucher to Generate</a>
-->	<?php } ?>
		<a href="<?php echo base_url('vouchers/business_voucher_index/') ?>"   class="btn btn-primary"><i class="fa fa-edit"></i> Back </a>
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
