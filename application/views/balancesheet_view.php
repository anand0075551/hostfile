<!---
1. Below fields are Bank details input field to add Bank & Branch details through Admin.
2. Rules and form Data Validation through app\controllers\Bank.php\  public function add_bank
3. DB SQL Post happens through 			  app\models\Agent_model.php\public function add_bank







< ? php foreach($data->result() as $commissions); ?>-->
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
                                                 <td>Transaction Series</td> 
												<td><?php echo $accounts->tran_count; ?></td>
                                            </tr>
                                            <tr>
                                                 <th width="20%">Account Holder's Name</th>
												<?php $fname = singleDbTableRow($accounts->user_id)->first_name;	
													$lname = singleDbTableRow($accounts->user_id)->last_name;
												?>
													<td><?php  echo $accounts->user_id.'-'.$fname.' '.$lname; ?></td>	                                                
                                            </tr>
                                            <tr>
                                                <td>Role Name</td>
                                               
											<td><?php echo $role = typeDbTableRow($accounts->rolename)->rolename; ?></td>  
                                            </tr>	
											<tr>
                                                <td>User Account No</td>
                                                <td><?php echo $accounts->account_no; ?></td> 
                                            </tr>   
											
                                             <tr>
                                                 <th width="20%">User Email/Login ID</th>
												<?php $email = singleDbTableRow($accounts->user_id)->email;	
													
												?>
													<td><?php  echo $email; ?></td>	                                                
                                            </tr>										
											<tr>
                                                <td>Deposit/Addition to Account</td>
                                                <td><?php echo $accounts->debit; ?></td> 
                                            </tr>
                                           	<tr>
                                                <td>Deduction from Account</td>
                                                <td><?php echo $accounts->credit; ?></td> 
                                            </tr>
											<tr>
                                                <td>Values</td>
                                                <td><?php echo $accounts->amount; ?></td> 
                                            </tr>											
                                            
                                            <tr>
                                                 <td>Values Type</td> 
												<td><?php if ($accounts->points_mode == 'wallet')
												{ $values = ' CPA ';
												}else {
													$values = $accounts->points_mode;
													}
													echo $values; ?></td>
                                            </tr>									
																						 <tr>
                                                 <td>Payment Type</td> 
												<td><?php 
												 $payType = ledgerDbTableRow($accounts->pay_type)->name;
												if($payType == null)
												{
													 $payType = 'Pay type is Null';
												}	echo $accounts->pay_type.'-'.$payType ;										?></td>
                                            </tr>		
											 <tr>
                                                 <td>Transaction ID</td> 
												<td><?php echo $accounts->tranx_id; ?></td>
                                            </tr>							
											<tr>
                                                <td>Generated On</td> 	
                                                <td><?php echo date('d/m/Y h:i A',$accounts->created_at); ?></td>
                                            </tr>										
											<tr>
                                                <td>Last modified ON</td>
                                                <td><?php echo date('d/m/Y h:i A',$accounts->modified_at); ?></td>
                                            </tr>										
                                           <tr>
                                                <td>Challan/Transaction Reciept</td>
																								
										    </tr> 
														               
                                        </table>
								<th> <img src="<?php echo ledger_photo_url($accounts->challan); ?>"  height='400' width='600'/>	</th>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
	<!--	<a href="<?php echo base_url('accounts/edit/'.$accounts->id) ?>" 			  class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a> -->
		<a href="<?php echo base_url('account/' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>		
	
	  
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
