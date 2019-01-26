<?php
foreach( $assets->result() as $assets);
foreach( $debits->result() as $debits);
foreach($credits->result() as $credits);
foreach($wallet->result() as $wallet);
foreach($payspec_totaldebit->result() as $payspec_totaldebit);
foreach($payspec_totalcredit->result() as $payspec_totalcredit);
foreach( $usedwallet->result() as $usedWallet);  //wallet_converted 

 $totalAssets = $assets->amount; 
 $totalDebits = $debits->debit; 
$totalCredits = $credits->credit; 
$totalWallet  = $wallet->amount; 
$usedwallet   = $usedWallet->amount;  

$payspec_debit = $payspec_totaldebit->debit;
$payspec_credit = $payspec_totalcredit->credit;

$total = $payspec_debit - $payspec_credit ;

 $debits = $totalDebits	;   //Total Debits
 $credits = $totalCredits;  //Total Credits
 $assets = ($debits - $credits) ; //Total Assets = Total Debits - Total Credits
$wallet  = $totalWallet;   //Company Wealth - Available cash funds
$usedwallet = $wallet  - $usedwallet ; //Cash Points = Company Wealth - Converted wallet ;
//$balancecash = $wallet  - $usedwallet ; //Cash Points = Company Wealth - Converted wallet
$balancecash = ($debits + $credits) ; //Cash Points = Company Wealth - Converted wallet



//$payspec = $ledger->pay_type;
//$data['paytype_credit']  = $this->ledger_model->payspec_totalcredit($payspec);
//foreach($paytype_credit->result() as $paytype_credit);
//$paytype_credit = $payspec_totalcredit->credit;
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
                                        <?php echo 'Pay Specifications Accounts Ledger View '; ?>
										
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
<!-- Main content -->

   <!--
           
                    <table class="table table-bordered">
					<div class="col-md-12">
                        <tr>
                            <th>Company Wealth</th>
                            <th>Total Debits</th>
                            <th>Total Credits</th>
							<th>Total Assets</th>
                            <th> Cash/wallet</th>
                        </tr>
                        <tr>
                          <td>
                              <?php  echo amountFormat($balancecash); ?>
                            </td>

                            <td>
                                <?php  echo amountFormat($debits); ?>
                            </td>

                            <td>
                                <?php  echo amountFormat($credits); ?>
                            </td>
                            <td>
                                 <?php  echo amountFormat($assets); ?> 
                            </td>
                            <td>
                                <?php  echo amountFormat($usedwallet ); ?>
                            </td>

							</tr>
							</div>
						</table>    -->              
           
        </div>
    </div>

                                        <table class="table table-striped">
										
                                            <tr>
                                              <th width="20%">Sub-Account / Pay Specifications</th> 
												 <?php $pay_spec = ledgerDbTableRow($ledger->id)->name; 													  
												 if ($pay_spec == 'NULL') {$pay_spec = 'Not Available';} ?>
                                                <th><?php echo $ledger->id.'-'.$pay_spec; ?></th> 
                                            </tr>
								<!--Wallet-->		
                                            <tr>
                                                <td>Total CPA Recieved</td>
                                                <td><?php 
												$where_array = array( 'pay_type' => $ledger->id, 'points_mode' => 'wallet');
		   									    $query = $this->db->select_sum('debit')->where($where_array)->get('ledger'); 
												 if($query -> num_rows() > 0) 
													{		
														foreach($query->result() as $r)
														{   $payspec_wal_debit = $r->debit;
															echo number_format($payspec_wal_debit, 2);}
													}
												 ?></td> 
												
                                            </tr>											
                                            <tr>
                                                <td>Total CPA Spent</td>
                                                <td><?php 
												 $where_array = array( 'pay_type' => $ledger->id, 'points_mode' => 'wallet');
		   									    $query = $this->db->select_sum('credit')->where($where_array)->get('ledger'); 
												 if($query -> num_rows() > 0) 
													{		
														foreach($query->result() as $r)
														{   $payspec_wal_credit = $r->credit;
															echo number_format($payspec_wal_credit, 2);}
													}
												 ?></td> 
                                            </tr>
                                            <tr>
                                                <th>Balance CPA Value </th>
                                                <th color="red" ><?php 
												$total_wal =  $payspec_wal_debit - $payspec_wal_credit;
												echo number_format($total_wal, 2); ?></th>
                                            </tr>
											
								<!--Loyality-->		
                                                <tr>
                                                <td>Total Loyality Debits</td>
                                                <td><?php 
												$where_array = array( 'pay_type' => $ledger->id, 'points_mode' => 'loyality');
		   									    $query = $this->db->select_sum('debit')->where($where_array)->get('ledger'); 
												 if($query -> num_rows() > 0) 
													{		
														foreach($query->result() as $r)
														{   $payspec_loy_debit = $r->debit;
															echo number_format($payspec_loy_debit, 2);}
													}
												 ?></td> 
												
                                            </tr>											
                                            <tr>
                                                <td>Total Loyality Credits</td>
                                                <td><?php 
												 $where_array = array( 'pay_type' => $ledger->id, 'points_mode' => 'loyality');
		   									    $query = $this->db->select_sum('credit')->where($where_array)->get('ledger'); 
												 if($query -> num_rows() > 0) 
													{		
														foreach($query->result() as $r)
														{   $payspec_loy_credit = $r->credit;
															echo number_format($payspec_loy_credit, 2);}
													}
												 ?></td> 
                                            </tr>
                                            <tr>
                                                <th color="red" >Balance Loyality Values </th>
                                                <th><?php 
												$total_loy =  $payspec_loy_debit - $payspec_loy_credit;
												echo number_format($total_loy, 2); ?></th>
                                            </tr>
											
								<!--Discount-->		
                                           <tr>
                                                <td>Total Discount Debits</td>
                                                <td><?php 
												$where_array = array( 'pay_type' => $ledger->id, 'points_mode' => 'discount');
		   									    $query = $this->db->select_sum('debit')->where($where_array)->get('ledger'); 
												 if($query -> num_rows() > 0) 
													{		
														foreach($query->result() as $r)
														{   $payspec_dis_debit = $r->debit;
															echo number_format($payspec_dis_debit, 2);}
													}
												 ?></td> 
												
                                            </tr>											
                                            <tr>
                                                <td>Total Discount Credits</td>
                                                <td><?php 
												 $where_array = array( 'pay_type' => $ledger->id, 'points_mode' => 'discount');
		   									    $query = $this->db->select_sum('credit')->where($where_array)->get('ledger'); 
												 if($query -> num_rows() > 0) 
													{		
														foreach($query->result() as $r)
														{   $payspec_dis_credit = $r->credit;
															echo number_format($payspec_dis_credit, 2);}
													}
												 ?></td> 
                                            </tr>
                                            <tr>
                                                <th color="red" >Balance Discount Values </th>
                                                <th><?php 
												$total_dis =  $payspec_dis_debit - $payspec_dis_credit;
												echo number_format($total_dis, 2); ?></th>
                                            </tr>
                        <!--                    <tr>
												<td>Remarks</td>
                                                <td><?php echo $ledger->remarks; ?></td>
                                            </tr>
                                            
										<!--	<tr>
                                                <td>Sub Account Id.</td>
                                                <th><?php echo $ledger->sub_acct_id; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Assigned Role Name</td>
                                                <td><?php echo $ledger->to_role; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Commission</td>
                                                <td><?php echo $ledger->commission; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Benefits</td>
                                                <td><?php echo $ledger->benefits; ?></td>
                                            </tr>
                                            
                                            
                                           <tr>
                                                <td>Created BY</td>
												<?php $fname = singleDbTableRow($ledger->user_id)->first_name;	
													$lname = singleDbTableRow($ledger->user_id)->last_name;
												?>
													<td><?php  echo $fname.' '.$lname; ?></td>	                                                
                                            </tr>								
											<tr>											
                                                <td>Invoice Id</td>
                                                <td><?php echo $ledger->invoice_id; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Transaction Date</td>
                                              
												<td><?php echo date('d/m/Y h:i A',$ledger->created_at); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Challan</td>
										<th>	<?PHP	echo "<img src='C:\xampp\htdocs\A\sams_02\uploads".$ledger->challan."' height='100' width='100'>
																			<br> 
																																						
																			</div>"; ?>
                                                <td><?php echo ucwords($ledger->challan); ?></td>
												
                                            </tr> 
                                            
-->

                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('ledger/payspec_accounts/') ?>" class="btn btn-primary"><i class="fa fa-edit"></i>Back</a>
                                      
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
