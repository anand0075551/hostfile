<!---
Commissions View Page






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
                                                <th width="20%">Main Accounts / Business Specifications</th>
												<?php $bus_spec = ledgerDbTableRow($commissions->acct_id)->name; 													  
												 if ($bus_spec == 'NULL') {$bus_spec = 'Not Available';} ?>
                                                <th><?php echo $bus_spec; ?></th> 
                                            </tr>
                                            <tr>
                                                <td>Sub-Account / Pay Specifications</td>       
 <!-- Ex:  <option value="male" <?php if($c_user->gender == 'male') echo 'selected'; ?>>Male</option>	 -->											
												<?php $pay_spec = ledgerDbTableRow($commissions->sub_acct_id)->name; 													  
												 if ($pay_spec == 'NULL') {$pay_spec = 'Not Available';} ?>
                                                <th><?php echo $commissions->sub_acct_id.'-'.$pay_spec; ?></th> 
                                            </tr>	
											 <tr>
                                                <td>Sender - Role Type</td>
                                                <td><?php 
												$userInfo = singleDbTableRow($commissions->from_role, 'role');
												$roleName = $userInfo->rolename;
												echo $roleName;  ?></td>
                                            </tr>
                                            <tr>
                                                <td>Receiver - Role Type</td>
												<td><?php 
												$userInfo = singleDbTableRow($commissions->to_role, 'role');
												$roleName = $userInfo->rolename;
												echo $roleName;  ?></td>
                                            </tr>
											<tr>
                                                <td>Deduction Pay Specifications</td>       
 <!-- Ex:  <option value="male" <?php if($c_user->gender == 'male') echo 'selected'; ?>>Male</option>	 -->											
												<?php $pay_spec = ledgerDbTableRow($commissions->ded_paytype)->name; 													  
												 if ($pay_spec == 'NULL') {$pay_spec = 'Not Available';} ?>
                                                <th><?php echo $commissions->ded_paytype.'-'.$pay_spec; ?></th> 
                                            </tr>
											<tr>
                                                <td>Sender's Referral Points Mode</td>
                                                <td><?php echo $commissions->slr_ref_pm; ?></td>
                                            </tr>
											<tr>
                                                <td>Sender Referral Commission for 'Level 1'</td>
                                                <td><?php echo $commissions->slr_ref_level1; ?></td>
                                            </tr>
											<tr>
                                                <td>Sender Referral Commission for 'Level 2'</td>
                                                <td><?php echo $commissions->slr_ref_level2; ?></td>
                                            </tr>
											<tr>
                                                <td>Sender Referral Commission for 'Level 3'</td>
                                                <td><?php echo $commissions->slr_ref_level3; ?></td>
                                            </tr>
											<tr>
                                                <td>Sender Referral Commission for 'Level 4'</td>
                                                <td><?php echo $commissions->slr_ref_level4; ?></td>
                                            </tr>
											<tr>
                                                <td>Sender Referral Commission for 'Level 5'</td>
                                                <td><?php echo $commissions->slr_ref_level5; ?></td>
                                            </tr>
											<tr>
                                                <td>Receiver's Referral Points Mode</td>
                                                <td><?php echo $commissions->clt_ref_pm; ?></td>
                                            </tr>
											<tr>
                                                <td>Receiver Referral Commission for 'Level 1'</td>
                                                <td><?php echo $commissions->clt_ref_level1; ?></td>
                                            </tr>
											<tr>
                                                <td>Receiver Referral Commission for 'Level 2'</td>
                                                <td><?php echo $commissions->clt_ref_level2; ?></td>
                                            </tr>
											<tr>
                                                <td>Receiver Referral Commission for 'Level 3'</td>
                                                <td><?php echo $commissions->clt_ref_level3; ?></td>
                                            </tr>
											<tr>
                                                <td>Receiver Referral Commission for 'Level 4'</td>
                                                <td><?php echo $commissions->clt_ref_level4; ?></td>
                                            </tr>
											<tr>
                                                <td>Receiver Referral Commission for 'Level 5'</td>
                                                <td><?php echo $commissions->clt_ref_level5; ?></td>
                                            </tr>
											<tr>
                                                <td>Business Points Mode</td>
                                                <td><?php echo $commissions->points_mode; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Business 'VAT/Commisions' to Organization</td>
                                                <td><?php echo $commissions->commission; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Business 'Tax/Benefits' to Organization</td>
                                                <td><?php echo $commissions->benefits; ?></td>
                                            </tr>
											
											<tr>
                                                <td>Profit's Points Mode</td>
                                                <td><?php echo $commissions->profit_pm; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Profit to 'Sender'</td>
                                                <td><?php echo $commissions->sender_profit; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Profit to 'Receiver'</td>
                                                <td><?php echo $commissions->receiver_profit; ?></td>
                                            </tr>	
											
											<tr>
                                                <td>Deduction's Points Mode</td>
                                                <td><?php echo $commissions->deduction_pm; ?></td>
                                            </tr>
											<tr>
                                                <td>Deduction from 'Sender'</td>
                                                <td><?php echo $commissions->sender_deduction; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Deduction from  'Receiver'</td>
                                                <td><?php echo $commissions->receiver_deduction; ?></td>
                                            </tr>												
                                            <tr>
                                                 <td>Start Date</td> 
												<td><?php echo $commissions->start_date; ?></td>
                                            </tr>									
											<tr>
                                                <td>End Date</td>
                                                <td><?php echo $commissions->end_date; ?></td>
                                            </tr>
											<tr>
                                                <td>Comments/Remarks</td>
												<td><?php echo $commissions->remarks; ?></td>                                              
                                            </tr>											
											<tr>
                                                <td>Created BY</td>
												<?php $fname = singleDbTableRow($commissions->created_by)->first_name;	
													$lname = singleDbTableRow($commissions->created_by)->last_name;
												?>
													<td><?php  echo $fname.' '.$lname; ?></td>	                                                
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
												               
                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
		<a href="<?php echo base_url('ledger/edit_commissions/'.$commissions->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
		<a href="<?php echo base_url('ledger/commission_index' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>		
	
	  
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
