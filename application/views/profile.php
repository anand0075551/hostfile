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
                                        <?php echo 'Consumer Name :'.$c_user->first_name.' '. $c_user->last_name; ?>
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
										
							<?php	if ($c_user->role != 'agent')	{?>	
                                            <tr>
                                                <th>Full Name</th>
                                                <th><?php echo $c_user->first_name.' '. $c_user->last_name; ?></th>
                                            </tr>
											<tr>
                                                <td>Gender</td>
                                                <td><?php echo $c_user->gender; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Date of birth</td>
                                                <td><?php echo $c_user->date_of_birth; ?></td>
                                            </tr>
							
							
							
							
							<?php }else{ ?>	
											<tr>
                                                <th>Firm's Name</th>
                                                <th><?php echo $c_user->company_name; ?></th>
                                            </tr>
											<tr>
                                                <th>Licence No</th>
                                                <th><?php echo $c_user->licence; ?></th>
                                            </tr>
							<?php }?>
                                            <tr>
                                                <td>Consumer1st Account No</td>
                                                <td><?php echo $c_user->account_no; ?></td>
                                            </tr>
                                            											
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $c_user->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Contact No.</td>
                                                <td><?php echo $c_user->contactno; ?></td>
                                            </tr>
											<tr>
                                               <th>User Type/Role Name</th>
                                                <th><?php 	if($c_user->rolename != '')
												{  $roleName = typeDbTableRow($c_user->rolename)->rolename;
												}else{
													$roleName = 'User type/Role name not yet assigned';
												}
												echo $roleName ;?></th>
                                            </tr>
                                            
                                            <tr>
                                                <td>Profession</td>
                                                <td><?php echo $c_user->profession; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Street Address</td>
                                                <td><?php echo $c_user->street_address; ?></td>
                                            </tr>
                                           
                                            <tr>
                                                <td>City/Village Name</td>
                                                <td><?php echo $c_user->city; ?></td>
                                            </tr>
                                            <tr>											
                                                <td>Country</td>
                                                <td><?php echo $c_user->country; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Postal Code</td>
                                                <td><?php echo $c_user->postal_code; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Referral Code</td>
                                                <td><?php echo $c_user->referral_code; ?></td>
                                            </tr>
											<tr>
                                                <td>User Last Login</td> 
                                                <td><?php echo date('d/m/Y h:i A',$c_user->user_lastlogin); ?></td>
                                            </tr>
                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('user/profile_edit') ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit Profile</a>
                                        <a href="<?php echo base_url('user/log') ?>" class="label label-warning"><i class="fa fa-bar-chart"></i> Log</a>
                                        <a href="<?php echo base_url('activity') ?>" class="label label-info"><i class="fa fa-check-square-o"></i> Activity</a>

                                    </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
