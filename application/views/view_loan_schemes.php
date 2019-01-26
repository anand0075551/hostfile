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

                                        <table class="table table-striped">
											<tr>
                                                <th width="20%">Business Loan (Types/Schemes)</th>
                                                <th><?php echo $loan_type = typeDbTablerow($commissions->type)->rolename; 
												?></th> 
                                            </tr>										
                                            <tr>
                                                <th width="20%">Loan Name</th>
                                                <th><?php echo $commissions->remarks; ?></th> 
                                            </tr>
                                            										
											<tr>
                                                <td>Business Loan ID</td>
                                                <td><?php echo $commissions->identity_id; ?></td> 
                                            </tr>											
                                            <tr>
                                                <td>Loan Amount/Value</td>
                                                <td><?php echo $commissions->amount; ?></td> 
                                            </tr>											                                           
                                            <tr>
                                                <td>Loans Valid From</td>
                                                <td><?php echo $commissions->start_date; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Loans Valid Till</th>
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
                                                <td>Business  Created By</td>
                                                <?php $fname = singleDbTableRow($commissions->created_by)->first_name;	
													$lname = singleDbTableRow($commissions->created_by)->last_name;
												?>
													<td><?php  echo $fname.' '.$lname; ?></td>
                                            </tr>							
									
                                            <tr>
                                                <td>Business Loan Assigned to Role Name</td> 
                                               <td><?php 
												$userInfo = singleDbTableRow($commissions->to_role, 'role');
												$roleName = $userInfo->rolename;
												echo $roleName;  ?></td>
												
                                            </tr>
											
											<?php	} ?>
											
									
											<tr>
                                                <th width="20%">EMI Start Date</th>
                                                <th><?php echo $commissions->start_date; ?></th>
                                            </tr>
														
											<tr>
                                                <th width="20%">EMI Tenures</th>
                                                <th><?php echo $commissions->tenure; ?></th> 
                                            </tr>
<tr>
                                                <th width="20%">EMI Period in days</th>
                                                <th><?php echo $commissions->period; ?></th> 
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
												<td><?php echo $commissions->modified_by ; ?></td>
											
                                            </tr>	                                            
                                          
                                     


                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
								<?php	if ( $currentUser == 'admin')  { ?>
		 <a href="<?php echo base_url('bank/edit_loan_schemes/'.$commissions->id) ?>"   class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a> 
	<?php }?>
	
		<a href="<?php echo base_url('bank/generate_loans/'.$commissions->id ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Verify Loans Specifications to Generate</a>
	
		<a href="<?php echo base_url('bank/business_Loans_index/') ?>"   class="btn btn-primary"><i class="fa fa-edit"></i> Back </a>
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
