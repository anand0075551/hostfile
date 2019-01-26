
<?php include('header.php'); ?>

<?php
foreach ($transport_Details->result() as $profile)
    ;
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <table class="table table-striped">
						<tr>
										<td>Main Category.</td>
										<td><?php 
										
											$query1 = $this->db->get_where('trp_vehicle_types', ['id' => $profile->main_category,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->category_name;
												}
											} 
											else
												{
												 echo  "";
												}
										?>
										
										</td>
						</tr>
						<tr>
										<td>Sub Category.</td>
										<td><?php 
										
											$query1 = $this->db->get_where('trp_vehicle_types', ['id' => $profile->sub_category,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->category_name;
												}
											} 
											else
												{
												 echo  "";
												}
										?>
										
										</td>
						</tr>
					
						<tr>
										<td>Year manufacturing.</td>
										<td><?php echo $profile->yrmaning; ?></td>
						</tr>
					
						<tr>
										<td>Make.</td>
										<td><?php 
									//	echo $profile->make; 
							$query1 = $this->db->get_where('trp_vehicle_make', ['id' => $profile->make,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->brands;
												}
											} 
											else
												{
												 echo  "";
												}
										?></td>
						</tr>
					
					
											<tr>
										<td>Model.</td>
										<td><?php 
									//	echo $profile->make; 
							$query1 = $this->db->get_where(' trp_vehicle_model', ['id' => $profile->model,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->model;
												}
											} 
											else
												{
												 echo  "";
												}
										?></td>
						</tr>
					
															<tr>
										<td>Version.</td>
										<td><?php 
									//	echo $profile->make; 
							$query1 = $this->db->get_where(' trp_vehicle_version', ['id' => $profile->version,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->version;
												}
											} 
											else
												{
												 echo  "";
												}
										?></td>
						</tr>
					
					
						<tr>
										<td>Number Of Owners.</td>
										<td><?php echo $profile->owners_number; ?></td>
						</tr>
					
					
											<tr>
										<td>Kms Driven.</td>
										<td><?php echo $profile->kms_driven; ?></td>
						</tr>
					
					
																				<tr>
										<td>Capacity Number.</td>
										<td><?php 
									//	echo $profile->make; 
							$query1 = $this->db->get_where('trp_capicity_person', ['id' => $profile->capacityperson,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->capacityperson;
												}
											} 
											else
												{
												 echo  "";
												}
										?></td>
						</tr>
					
																									<tr>
										<td>Capacity Load.</td>
										<td><?php 
									//	echo $profile->make; 
							$query1 = $this->db->get_where('trp_capicity_load', ['id' => $profile->	cap_load,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->	capacityload;
												}
											} 
											else
												{
												 echo  "";
												}
										?></td>
						</tr>
					
					
					    <tr>
                            <td>Registration number</td>
                            <td  style="text-transform:uppercase"><?php echo $profile->reg_num; ?></td>
                        </tr>
					
											<tr>
										<td>Reg. Date</td>
										<td><?php echo $profile->reg_date; ?></td>
						</tr>
					
																<tr>
										<td>Chassis.No. </td>
										<td><?php echo $profile->chassis_no; ?></td>
						</tr>
					
					
					<tr>
										<td>Engine.No.</td>
										<td><?php echo $profile->engine_no; ?></td>
						</tr>
						<tr>
										<td>Organization Name</td>
										<td><?php echo $profile->org_name; ?></td>
						</tr>
					
					
						<tr>
										<td>Owner Name.</td>
										<td><?php echo $profile->owner_name; ?></td>
						</tr>
												<tr>
										<td>Owner Address & other Details</td>
										<td><?php echo $profile->address_details; ?></td>
						</tr>
						
					<tr>
										<td>Model no.</td>
										<td><?php echo $profile->model_no; ?></td>
						</tr>
							<tr>
										<td>Fule Type</td>
										<td><?php echo $profile->fule_type; ?></td>
						</tr>
						
													<tr>
										<td>Insurence Start Date </td>
										<td><?php echo $profile->insurence_startdate; ?></td>
						</tr>
																			<tr>
										<td>Insurence End Date </td>
										<td><?php echo $profile->insurece_enddate; ?></td>
						</tr>
						
																			<tr>
										<td>Fitness certificate Begin Date</td>
										<td><?php echo $profile->fitness_cer_begin; ?></td>
						</tr>
																			<tr>
										<td>Fitness certificate End Date </td>
										<td><?php echo $profile->fitness_cer_end; ?></td>
						</tr>
						
						
						<tr>
										<td>Pollution Certificate(Begin Date)  </td>
										<td><?php echo $profile->pollution_cer_begin; ?></td>
						</tr>
						
						
					<tr>
										<td>Pollution Certificate(End Date)  </td>
										<td><?php echo $profile->pollution_cer_end; ?></td>
						</tr>
						
					<tr>
										<td>Passing Certificate(PERMIT) Start Date  </td>
										<td><?php echo $profile->passing_cer_start; ?></td>
						</tr>
						
						
						<tr>
										<td>Passing Certificate(PERMIT) End Date </td>
										<td><?php echo $profile->passing_cer_end; ?></td>
						</tr>
						
						<tr>
										<td>RC Book No</td>
										<td><?php echo $profile->rc_book; ?></td>
						</tr>
						
						<tr>
										<td>Insurence Policy</td>
										<td><?php echo $profile->insurence_Policy; ?></td>
						</tr>
						<tr>
										<td>Pollution Certificate No</td>
										<td><?php echo $profile->pollution_certifi; ?></td>
						</tr>
										<tr>
										<td>Tyre Condition </td>
										<td><?php echo $profile->tyre_cond; ?></td>
						</tr>	
						
						
						
						
						

								
				


						
						

                        <tr>
                            <td>Engine Condition</td>
                            <td><?php echo $profile->engine_cond; ?></td>
                        </tr>
						
						 
						
						<?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $role = $user_info['role'];

                        if ($role == 'admin') {
                            ?>
                            <tr>
                                <td>Created By</td>
                                <td><?php echo $fname = singleDbTableRow($profile->created_by)->first_name . ' ' . singleDbTableRow($profile->created_by)->last_name; ?></td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td><?php echo date("Y-m-d", $profile->created_at); ?></td>
                            </tr>
                            <tr>
                                <td>Modified By</td>
                                <td><?php
                                    if ($profile->modified_by == '0') {
                                        echo $name = 'New Entry';
                                    } else {
                                        echo $fname = singleDbTableRow($profile->modified_by)->first_name . ' ' . singleDbTableRow($profile->modified_by)->last_name;
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Modified At</td>
                                <td><?php
                                    if ($profile->modified_at == '0') {
                                        echo $name = 'No Modified time';
                                    } else {
                                        echo date("Y-m-d", $profile->modified_at);
                                        ;
                                    }
                                    ?></td>
                            </tr>
							
							<tr>
                            <td>File</td>
                            <td>

                                <img id="my_img" src="<?php echo profile_photo_url($profile->photo, $c_user->email); ?>" class="img-thumbnail"  width="30%" height="60%">
                        </tr>
                        <?php } ?>
                    </table>

                </div><!-- /.box-body -->

               <div class="box-footer">
                    <a href="<?php echo base_url('transport/transport_index') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
					<?php  	$user_info 	 = $this->session->userdata('logged_user');
							$user_id 	 = $user_info['user_id'];
							$currentUser = singleDbTableRow($user_id)->role;
//							$rolename    = singleDbTableRow($user_id)->rolename;
							$email   	 = singleDbTableRow($user_id)->email;
		
		
						if ($currentUser == 'admin') { ?>
                    
				<a href="<?php echo base_url('transport/edit_transport/' . $profile->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>
					
						<?php }  ?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
