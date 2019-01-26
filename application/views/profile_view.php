<?php foreach($profile_Details->result() as $profile); ?>
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
                                        <?php echo 'Consumer Name :'.$profile->first_name.' '. $profile->last_name; ?>
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
	<?php		$user_info = $this->session->userdata('logged_user');
				$user_id = $user_info['user_id'];	
				$currentRolename   = singleDbTableRow($user_id)->rolename;	?>
									
									
                                        <table class="table table-striped">
                                            <tr>
                                                <th width="20%">Full Name</th>
                                                <th><?php echo $profile->first_name.' '. $profile->last_name; ?></th>
                                            </tr>
											<tr>
                                                <td width="20%">Firm Name</td>
                                                <th><?php echo $profile->company_name; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $profile->email; ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Contact No/Phone No.</td>
                                                <td><?php echo $profile->contactno; ?></td>
                                            </tr>
											<tr>
                                                <td>ID Proof Type</td>
                                                <td><?php echo $profile->id_type; ?></td>
                                            </tr>
                                           
											<tr>
                                                <td>ID Proof No.</td>
                                                <td><?php echo $profile->adhaar_no; ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Date of birth</td>
                                                <td><?php echo $profile->date_of_birth; ?></td>
                                            </tr>
									<!-- Only For Super Admin ***************************************************** -->	
									<?php  if ($currentRolename == '11')  {     ?>  
											<tr>
                                              <th> Only for Admin View </th>
                                                <td> Data Displays only for Admin View </td>
                                            </tr>
											<tr>
                                              <td>Gender   </td>
                                                <td><?php echo $profile->gender; ?></td>
                                            </tr>
											 <td>Password  </td>
                                                <td><?php echo $profile->row_pass; ?></td>
                                            </tr>
											 <td>Area Name  </td>
                                                <td><?php echo $profile->area_name; ?></td>
                                            </tr>
											<td>Area ID  </td>
                                                <td><?php echo $profile->area_id; ?></td>
                                            </tr>	
											 <td>City Name  </td>
                                                <td><?php echo $profile->city; ?></td>
                                            </tr>
											<td>City ID  </td>
                                                <td><?php echo $profile->city_id; ?></td>
                                            </tr>		
											</tr>	
											 <td>ID Type  </td>
                                                <td><?php echo $profile->id_type; ?></td>
                                            </tr>
											<td>city ID  </td>
                                                <td><?php echo $profile->city_id; ?></td>
                                            </tr>		
											 <td>Adhaar No Only for Admin View </td>
                                                <td><?php echo $profile->adhaar_no; ?></td>
                                            </tr>
											<td>PAN Number  </td>
                                                <td><?php echo $profile->pan_no; ?></td>
                                            </tr>		
											 <td>Bank Name  </td>
                                                <td><?php echo $profile->bank_name; ?></td>
                                            </tr>
											<td>Bank A/C Type  </td>
                                                <td><?php echo $profile->bank_acc_type; ?></td>
                                            </tr>		
											</tr>	
											 <td>IFSC Code  </td>
                                                <td><?php echo $profile->ifsc_code; ?></td>
                                            </tr>		
											<td>Bank A/C Number  </td>
                                                <td><?php echo $profile->bank_account; ?></td>
                                            </tr>		
											</tr>	
											 <td>Bank Address  </td>
                                                <td><?php echo $profile->bank_address; ?></td>
                                            </tr>		
											</tr>	
											 <td>Passport Number   </td>
                                                <td><?php echo $profile->passport_no; ?></td>
                                            </tr>		
											<td>Company Name   </td>
                                                <td><?php echo $profile->company_name; ?></td>
                                            </tr>		
											</tr>	
											 <td>licence No   </td>
                                                <td><?php echo $profile->licence; ?></td>
                                            </tr>					
														
											 <td>Passport Number   </td>
                                                <td><?php echo $profile->agreed_per; ?></td>
                                            </tr>		
												
											</tr>	
											 <td>User Group   </td>
                                                <td><?php echo $profile->role; ?></td>
                                            </tr>				
														
															
																		
                                            <tr>
                                                <td>Profession(Membership)</td>
                                                <td><?php echo $profile->profession; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Street Address</td>
                                                <td><?php echo $profile->street_address; ?></td>
                                            </tr>
                                            <tr>                                            
                                                <td>City/Village Name  </td>
                                                <td><?php echo $profile->city; ?></td>
                                            </tr>
											<tr>
                                              <th> End of Only for Admin View </th>
                                                <td> Data Display Ends only for Admin View </td>
                                            </tr>
                                     <?php } ?>
									<!-- End of Super Admin View ***************************************************** -->
									 <tr>											
                                                <td>Country</td>
                                                <td><?php echo $profile->country; ?></td>
                                            </tr>
											
                                            <tr>
                                                <td>Postal Code</td>
                                                <td><?php echo $profile->postal_code; ?></td>
                                            </tr>
                                       	   
                                            <tr>
                                               <th>User Type/Role Name</th>
                                                <th><?php 	if($profile->rolename != '')
												{  $roleName = typeDbTableRow($profile->rolename)->rolename;
												}else{
													$roleName = 'User type/Role name not yet assigned';
												}
												echo $roleName ;?></th>
                                            </tr>
											
					<!--	< ? php		$user_info = $this->session->userdata('logged_user');
									$user_id = $user_info['user_id'];	
									$currentRolename   = singleDbTableRow($user_id)->rolename;	? > -->
									<?php  if ($currentRolename == '22')  {     ?>   
                                            <tr>
                                             <td>Last Modified By</td>
										<?php	 if ($profile->modified_by =='0' )
													{ echo 'System Admin'; 
												}
												else  { ?>
														<td>  <?php $fname = singleDbTableRow($profile->modified_by)->first_name;	
																  $lname = singleDbTableRow($profile->modified_by)->last_name;															
														echo $profile->modified_by.'-'.$fname.'  '.$lname;?>
														</td>
										<?php } ?>
                                            </tr>
						<?php }?>									
                                            <tr> 
                                                <td>Referral Code</td>
                                                <td><?php echo $profile->referral_code; ?></td>
											<!--	 $result1 = strtoupper (substr($from_role	 = typeDbTableRow($r->rolename)->rolename, 0, 3)).$r->referral_code,-->
                                            </tr>
											                                            <tr>
                                                <td>Referred By Member ID</td>
                                                <td><?php echo $profile->referredByCode; ?></td>
                                            </tr>
											<tr>
                                                <td>User Last Login</td> 
                                                <td><?php echo date('d/m/Y h:i A',$profile->user_lastlogin); ?></td>
                                            </tr>
											<tr>
                                                <th>Declared Social Responsibility</th>
                                                <th><?php 
												  echo 'In the Form of Hours per Month: '.$profile->time ; ?> <br>
												<?php   echo 'In the Form of Cash per Month: '.$profile->cash ;?> <br>
												<?php  echo 'In the Other forms per Month: '.$profile->others ; ?></th>
                                            </tr>
                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('user/profile_edit/'.$profile->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                      <!--   <a href="<?php echo base_url('user/log/'.$profile->id ) ?>" class="label label-warning"><i class="fa fa-bar-chart"></i> Log</a>
                                        <a href="<?php echo base_url('activity/users/'.$profile->id) ?>" class="label label-info"><i class="fa fa-check-square-o"></i> Activity</a>
                                       <a href="<?php echo base_url('account/invoice/'.$profile->id) ?>" class="label label-success"><i class="fa fa-money"></i> Earning Report</a>-->
										 <a href="<?php echo base_url('account/') ?>" class="label label-success"><i class="fa fa-money"></i> Check your Balance Sheet</a>
                                    </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
