
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

                                        <table class="table table-striped">

                                            <tr>
                                                <th width="20%">Voucher Name</th>
                                                <th><?php echo $vouchers->voucher_name; ?></th> 
                                            </tr>
											<tr>
                                                <td width="20%">Voucher Description</td>
                                                <td><?php echo $vouchers->voucher_description; ?></td> 
                                            </tr>
                                            <tr>
                                                <td>Voucher ID</td>
                                                <td><?php echo $vouchers->voucher_id; ?></td> 
                                            </tr>	
											                                            <tr>
                                                <td>Voucher Points</td>
                                                <td><?php echo number_format($vouchers->amount, 2); ?></td> 
                                            </tr>
											</tr>	
											                                            <tr>
                                                <td>Is Voucher Elgible..?</td>
                                                <td><?php echo $vouchers->used; ?></td> 
                                            </tr>
											<tr>
                                                <td>Voucher Owner</td>
                                                <td><?php echo singleDbTableRow($vouchers->user_id)->first_name." ".singleDbTableRow($vouchers->user_id)->last_name; ?></td> 
                                            </tr>
											<tr>
                                                <td>User Email</td>
                                                <td><?php echo $vouchers->email; ?></td> 
                                            </tr>
                                            <tr>
                                                <td>User Account No</td>
                                                <td><?php echo $vouchers->account_no; ?></td> 
                                            </tr>											
                                            <tr>
                                                <td>Start Date</td>
                                                <td><?php echo $vouchers->start_date; ?></td>
                                            </tr>
                                            <tr>
                                                <td>End Date</td>
                                                <td><?php echo $vouchers->end_date; ?></td>
                                            </tr>
                                            <tr>
                                                 <td>Transferrable</td> 
												<td><?php echo $vouchers->transferrable; ?></td>
                                            </tr>									
											
											<?php if($vouchers->transferrable == 'yes'){ ?>
												<tr>
													<td>Transferred To</td> 
													<td><?php 
														if($vouchers->transferred_to != 0){
															echo singleDbTableRow($vouchers->transferred_to)->first_name." ".singleDbTableRow($vouchers->transferred_to)->last_name;	
														}
														else{
															echo "Not Transferred Yet.";
														}
														
													?></td>
												</tr>
											<?php } ?>
											
											<tr>
                                                 <td>Used</td> 
												<td><?php echo $vouchers->used; ?></td>
                                            </tr>
											
											<?php if($vouchers->used == 'yes'){ ?>
												<tr>
													<td>Used By</td> 
													<td><?php 
														if($vouchers->used_by != 0){
															echo singleDbTableRow($vouchers->used_by)->first_name." ".singleDbTableRow($vouchers->used_by)->last_name;	
														}
														else{
															if($vouchers->transferred_to != 0){
																if(singleDbTableRow($vouchers->transferred_to)->gender == 'male'){
																	echo "Transferred to ".singleDbTableRow($vouchers->transferred_to)->first_name." ".singleDbTableRow($vouchers->transferred_to)->last_name.", But not used by him yet.";
																}
																elseif(singleDbTableRow($vouchers->transferred_to)->gender == 'female'){
																	echo "Transferred to ".singleDbTableRow($vouchers->transferred_to)->first_name." ".singleDbTableRow($vouchers->transferred_to)->last_name.", But not used by her yet.";
																}
																else{
																	echo "Transferred to ".singleDbTableRow($vouchers->transferred_to)->first_name." ".singleDbTableRow($vouchers->transferred_to)->last_name.", But not used yet.";
																}
															}
															echo "";
														}
														
													?></td>
												</tr>
											<?php } ?>
											
											<tr>
                                                <td>Generated On</td> 	
                                                <td><?php echo date('d/m/Y h:i A',$vouchers->created_at); ?></td>
                                            </tr>										
											<tr>
                                                <td>Last modified ON</td>
                                                <td><?php echo date('d/m/Y h:i A',$vouchers->modified_at); ?></td>
                                            </tr>										
                                            <tr>     
                                            </tr>
										<!--	<tr>
                                                <td>Last modified BY</td>
												< ?php $fname = singleDbTableRow($vouchers->modified_by)->first_name;	
													$lname = singleDbTableRow($vouchers->modified_by)->last_name;
												?>
													<td>< ?php  echo $fname.' '.$lname; ?></td>												
                                            </tr>	
-->					 <tr>
                                                 <td>Followed By Current Terms and Conditions at the time Voucher usage</td> 
						<td><?php echo 'Yes' ?></td>
                                            </tr>						
                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
	<!--	<a href="<?php echo base_url('vouchers/edit/'.$vouchers->id) ?>" 			  class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a> 
		<a href="<?php echo base_url('vouchers/check_pin_status' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>		
	
	  -->
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
