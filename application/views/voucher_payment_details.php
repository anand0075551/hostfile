
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
                                                <th width="30%">Voucher Name</th>
                                                <th>:</th>
                                                <th><?php echo $vouchers->voucher_name; ?></th> 
                                            </tr>
											<tr>
                                                <td>Voucher Description</td>
												<td>:</td>
                                                <td><?php echo $vouchers->voucher_description; ?></td> 
                                            </tr>
                                            <tr>
                                                <td>Vouchers Used</td>
												<td>:</td>
                                                <td><?php echo $vouchers->voucher_id; ?></td> 
                                            </tr>	
											<tr>
                                                <td>Voucher Amount</td>
												<td>:</td>
                                                <td><?php echo number_format($vouchers->amount, 2); ?></td> 
                                            </tr>
											<tr>
                                                <td>Token Number</td>
												<td>:</td>
                                                <td><?php echo $vouchers->token_no; ?></td> 
                                            </tr>
											<tr>
                                                <td>Voucher Amount</td>
												<td>:</td>
                                                <td><?php echo number_format($vouchers->amount, 2); ?></td> 
                                            </tr>
											<?php if($vouchers->service_type != ""){ ?>
											<tr>
												<td>Service Type</td>
												<td>:</td>
												<td><?php echo $vouchers->service_type; ?></td>
											</tr>
											<?php if($vouchers->service_type == "Table Service"){ ?>
												<tr>
													<td>Table Number</td>
													<td>:</td>
													<td><?php echo $vouchers->table_no; ?></td>
												</tr>
											<?php } }?>
											<tr>
                                                <td>Paid By</td>
												<td>:</td>
                                                <td><?php echo singleDbTableRow($vouchers->paid_by)->first_name." ".singleDbTableRow($vouchers->paid_by)->last_name; ?></td> 
                                            </tr>
											<tr>
                                                <td>Paid To</td>
												<td>:</td>
                                                <td>
												<?php
												if(singleDbTableRow($vouchers->paid_to)->company_name != ""){
													echo singleDbTableRow($vouchers->paid_to)->company_name;
												}
												else{
													echo singleDbTableRow($vouchers->paid_to)->first_name." ".singleDbTableRow($vouchers->paid_to)->last_name;
												}
												?>
												</td> 
                                            </tr>
											<tr>
                                                <td>Paid For</td>
												<td>:</td>
                                                <td><?php echo $vouchers->voucher_description; ?></td> 
                                            </tr>
											<tr>
                                                <td>Paid At</td>
												<td>:</td>
                                                <td><?php echo date("d-M, Y", $vouchers->created_at); ?></td> 
                                            </tr>
											<tr>
                                                <td>Payment Accepted At</td>
												<td>:</td>
                                                <td><?php 
													if($vouchers->modified_at != 0){
														echo date("d-M, Y", $vouchers->modified_at); 
													}
													else{
														echo "Payment Not Accepted Yet.";
													}
												?></td> 
                                            </tr>
												
											                                            
				 <tr>
                                                 <td>Followed By Current Terms and Conditions at the time Voucher usage</td>
												 <td>:</td>
												<td><?php echo 'Yes' ?></td>
                                            </tr>						
                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
	<?php
		$user_info = $this->session->userdata('logged_user');
		$user_id = $user_info['user_id'];
		if($user_id == $vouchers->paid_by){
	?>
		<a href="<?php echo base_url('voucher_redeem/make_payment' ) ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back </a>
	<?php
		} else{
	?>
		<a href="<?php echo base_url('voucher_redeem/accept_voucher_payment' ) ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back </a>
	<?php
		}
	?>
				
	
	 
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
