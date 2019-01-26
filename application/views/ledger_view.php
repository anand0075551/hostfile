
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
                                        <?php echo 'Accounts Ledger View '; ?>
										
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
										<!--      <tr>                                             
												 <td>Main Account</td>
												 <?php $parent_id = ledgerDbTableRow($ledger->pay_type)->parentid; 
													   $pay_master = ledgerDbTableRow($parent_id )->name;
												 if ($parent_id == '0') {$pay_master = 'Main Account';} ?>
                                                <th><?php echo $pay_master; ?></th> 
                                            </tr>	
                                            <tr>
                                              <th width="20%">Pay Specifications</th> -->
												 <td>Sub-Account / Pay Specifications</td>
												 <?php $pay_spec = ledgerDbTableRow($ledger->pay_type)->name; 													  
												 if ($pay_spec == 'NULL') {$pay_spec = 'Not Available';} ?>
                                                <th><?php echo $ledger->pay_type.'-'.$pay_spec; ?></th> 
                                            </tr>
										
                                            <tr>
                                                <td>Debits</td>
                                                <td><?php echo number_format($ledger->debit, 2); ?></td> 
                                            </tr>											
                                            <tr>
                                                <td>Credits</td>
                                                <td><?php echo number_format($ledger->credit, 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Amount</td>
                                                <td><?php echo number_format($ledger->amount, 2);  ?></td>
                                            </tr>                                                                                     
											<!-- <tr>
                                                <td>Points Mode</td>
                                                <th>< ?php echo $ledger->points_mode; ?></th>
                                            </tr>
											-->
											 <tr>
                                                 <td>Values Type</td> 
												<td><?php if ($ledger->points_mode == 'wallet')
												{ $values = ' VPA ';
												}else {
													$values = $ledger->points_mode;
													}
													echo $values; ?></td>
                                            </tr>		
											
											
											<tr>
												<td>Remarks</td>
                                                <td><?php echo $ledger->remarks; ?></td>
                                            </tr>
                                         <!--   <tr>
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
                                            
                                     -->      
                                           <tr>
                                                <td>Created BY</td>
											<?php	if ($ledger->user_id != 0)
													{ 	$fname = singleDbTableRow($ledger->user_id)->first_name;	
														$lname = singleDbTableRow($ledger->user_id)->last_name;
													}else
													{
														$fname = 'System';
														$lname = 'Automated';
													}
												?>
													<td><?php  echo $fname.' '.$lname; ?></td>	                                                
                                            </tr>		 						
											<tr>											
                                                <td>Invoice/Transaction Id</td>
                                                <td><?php echo $ledger->invoice_id; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Transaction Date</td>
                                              
												<td><?php echo date('d/m/Y h:i A',$ledger->created_at); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Challan/Transaction Reciept</td>																							
										    </tr>  </table>
										<th> <img src="<?php echo ledger_photo_url($ledger->challan, $ledger->challan); ?>"  height='400' width='600'/>	</th>	

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                 <!--       <a href="<?php echo base_url('ledger/edit_ledger/'.$ledger->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                  -->    
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
