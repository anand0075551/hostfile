<?php foreach($role_Details->result() as $role); ?>


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
                                       Role Details
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
										<tr>
                                                <td>Role Groups</td>
                                                <td><?php 
												
												if( $role->role_groups == 1)
			{
				$role_groups = 'Management';
			}elseif( $role->role_groups == 2)
			{
				$role_groups = 'Managers';
			}elseif( $role->role_groups == 3)
			{
				$role_groups = 'Agents';
			}elseif( $role->role_groups == 4)
			{
				$role_groups = 'Users';
			}echo $role_groups  ; ?></td>
                                            </tr>
											<tr>
                                                <td>Role Name</td>
                                                <td><?php echo $role->rolename; ?></td>
                                            </tr>
											<tr>
                                                <td>Rolename Id</td>
                                                <td><?php echo $role->id; ?></td>
                                            </tr>
											<tr>
                                                <td>Registration Fees</td>
                                                <td><?php echo $role->fees; ?></td>
                                            </tr>
											<tr>
                                                <td>Payspec for Registration Fees Collection </td>
                                                <td><?php if ($role->dedfees_payspec > 0)
												{ echo $role->dedfees_payspec.'-'.$name1 = ledgerDbTableRow($role->dedfees_payspec)->name; 
												}else{
													echo $role->dedfees_payspec.'-Not Assigned';
												}
												?></td>
                                            </tr>
											<tr>
                                                <td>Payspec for Sponsorship offers for the commission %</td>
                                                <td><?php  if ($role->comfees_payspec > 0)
												{ 
												echo  $role->comfees_payspec.'-'.$name2 = ledgerDbTableRow($role->comfees_payspec)->name; 
												}else{
													echo $role->comfees_payspec.'-Not Assigned';
												}												?></td>
                                            </tr>
											<tr>
                                                <td>Commission Percentage from this Role</td>
                                                <td><?php echo $role->com_per; ?></td>
                                            </tr>
										<!--	<tr>
                                                <td>Parent</td>
                                                <td>< ?php echo $role->parent; ?></td>
                                            </tr>
										<tr>
                                                <td>Role Status/Active</td>
                                                <td><?php echo $role->active; ?></td>
                                            </tr>
											-->	<tr>
                                                <td>Available for Referral ?</td>
                                                <td><?php if($role->permission_id == '1')
															{ $res = 'YES'; 
															}else{ 
															$res = 'NO' ;
															}
																echo $res; ?></td>
                                            </tr>
											<tr>
                                                <td>Role Type</td>
                                                <td><?php echo $role->type; ?></td>
                                            </tr>
											<tr>
                                                <td>Created By</td>
                                                <td><?php echo $users = singleDbTableRow($role->created_by)->first_name.' '.singleDbTableRow($role->created_by)->last_name; ?></td>
                                            </tr>
											<tr>
                                                <td>Created At</td>
                                                <td><?php echo date("Y-m-d h:i:sa", $role->created_at);?></td>
                                             </tr>       
                                               <tr>
                                                <td>Modified By</td>
                                                <td><?php if($role->edit == '0')
												{ echo $name = 'New Entry'; }
											else{
												echo $users = singleDbTableRow($role->edit)->first_name.' '.singleDbTableRow($role->created_by)->last_name;
											}?></td>
                                            </tr>   
											<tr>
                                                <td>Modified At</td>
                                                <td><?php if($role->modified_at == '0')
												{ echo $name = 'No Modified time'; }
											else{
												echo  date("Y-m-d h:i:s a",$role->modified_at);;
											}?></td>
                                             </tr>    
		

                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('Role_report/edit_role/'.$role->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
										<a href="<?php echo base_url('Role_report/role_report_list/'.$role->id) ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back To Report List</a>
                                      
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
