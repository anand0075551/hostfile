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
                                        <?php echo 'Consumer Name:' .$c_user->first_name.' '. $c_user->last_name; ?>
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
<?php if ( $c_user->role == 'agent') {?>    
											<tr>
                                                <th>Company Name</th>
                                                <th><?php echo $c_user->company_name; ?></th>
                                            </tr>                                    
<?php }	else{ ?>							
										<tr>
                                                <th>Full Name</th>
                                                <th><?php echo $c_user->first_name.' '. $c_user->last_name; ?></th>
                                            </tr>
					<?php } ?>		
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $c_user->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Contact No.</td>
                                                <td><?php echo $c_user->contactno; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Bank Name </td>
                                                <td><?php echo $c_user->bank_name; ?></td>
                                            </tr>
                                       
											<tr>
                                                <td>Branch & Complete Address</td>
                                                <td><?php echo $c_user->bank_address; ?></td>
                                            </tr>
											<tr>
                                                <td>Bank Account Type</td>
                                                <td><?php if ($c_user->bank_acc_type == '02')
																echo 'Current Account';
															else{
																echo 'Savings Account';
															}?></td>
                                            </tr>
											<tr>
                                                <td>Bank Account No</td>
                                                <td><?php echo $c_user->bank_account; ?></td>
                                            </tr>
                                            <tr>
                                                <td>IFS Code (Indian Financial System Code)</td>
                                                <td><?php echo $c_user->ifsc_code; ?></td>
                                            </tr>
                                            <tr>
                                                <td>PAN No</td>
                                                <td><?php echo $c_user->pan_no; ?></td>
                                            </tr>
                                            
                                           
                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('bank/bank_edit') ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="<?php echo base_url('user/log') ?>" class="label label-warning"><i class="fa fa-bar-chart"></i> Log</a>
                                        <a href="<?php echo base_url('activity') ?>" class="label label-info"><i class="fa fa-check-square-o"></i> Activity</a>

                                    </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
