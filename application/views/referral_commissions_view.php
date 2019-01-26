<!---
Referral Commissions View Page






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
												<?php $pay_spec = ledgerDbTableRow($commissions->sub_acct_id)->name; 													  
												 if ($pay_spec == 'NULL') {$pay_spec = 'Not Available';} ?>
                                                <th><?php echo $pay_spec; ?></th> 
                                            </tr>	
											 <tr>
                                                <td>Seller - Role Type</td>
                                                <td><?php 
												$userInfo = singleDbTableRow($commissions->from_role, 'role');
												$roleName = $userInfo->rolename;
												echo $roleName;  ?></td>
                                            </tr>
                                            <tr>
                                                <td>Client - Role Type</td>
												<td><?php 
												$userInfo = singleDbTableRow($commissions->to_role, 'role');
												$roleName = $userInfo->rolename;
												echo $roleName;  ?></td>
                                            </tr>
											<tr>
                                                <td>Referral Commission for 'Level 1'</td>
                                                <td><?php echo $commissions->level1; ?></td>
                                            </tr>
											<tr>
                                                <td>Referral Commission for 'Level 2'</td>
                                                <td><?php echo $commissions->level2; ?></td>
                                            </tr>
											<tr>
                                                <td>Referral Commission for 'Level 3'</td>
                                                <td><?php echo $commissions->level3; ?></td>
                                            </tr>
											<tr>
                                                <td>Referral Commission for 'Level 4'</td>
                                                <td><?php echo $commissions->level4; ?></td>
                                            </tr>
											<tr>
                                                <td>Referral Commission for 'Level 5'</td>
                                                <td><?php echo $commissions->level5; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Commissions to 'Seller'</td>
                                                <td><?php echo $commissions->commission; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Benefits to 'Client'</td>
                                                <td><?php echo $commissions->benefits; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Loyality to 'Seller'</td>
                                                <td><?php echo $commissions->seller_loyality; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Loyality to 'Client'</td>
                                                <td><?php echo $commissions->client_loyality; ?></td>
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
		<a href="<?php echo base_url('account/referral_balance_sheet/' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>		
	
	  
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
