<?php include('header.php'); ?>
<?php
foreach ($distributor_commission->result() as $profile);
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
					    <!--<tr>
                            <td>For Role</td>
                            <td>< ?php echo $distributor_commission->to_role; ?></td>
                        </tr> --> 
									<tr>
										<td>Bussiness group</td>
										<td style="text-transform:uppercase">
										<?php  
										$get_bg_name = $this->db->get_where('business_groups', ['id'=>$profile->business_group]);
										foreach($get_bg_name->result() as $bg)
										echo $bg->business_name;
										?>
										</td>
									</tr>
                                    
                                    <tr>
										<td>Area</td>
										<td style="text-transform:uppercase">
										<?php  
										$get_location = $this->db->get_where('area', ['id'=>$profile->area]);
										foreach($get_location->result() as $l);
										$location=$l->location;
										$get_location_name = $this->db->get_where('location_id', ['id'=>$location]);
										foreach($get_location_name->result() as $ln);
										echo $ln->location;
										?>
										</td>
									</tr> 
									
									<tr>
										<td>Form Role</td>
										<td style="text-transform:uppercase">
										<?php 
											$query1 = $this->db->get_where('role', ['id' => $profile->from_role,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->rolename;
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
										<td>For Role</td>
										<td style="text-transform:uppercase">
										<?php 
											$query1 = $this->db->get_where('role', ['id' => $profile->to_role,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->rolename;
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
										<td>For User</td>
										<td>
										<?php 
											$query1 = $this->db->get_where('users', ['id' => $profile->to_user,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->first_name.'.    .'.$row->last_name.'.....Referral Code:  '.$row->referral_code.' ....Conatct No:  '.$row->contactno;
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
                            <td>Percentage</td>
                            <td><?php echo $profile->percentage; ?></td>
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
                                        echo $name = 'No Entry';
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
                        <?php } ?>
                    </table>

                </div><!-- /.box-body -->

               <div class="box-footer">
                    <a href="<?php echo base_url('Distributor_commission/commission_index') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
					<?php  	$user_info 	 = $this->session->userdata('logged_user');
							$user_id 	 = $user_info['user_id'];
							$currentUser = singleDbTableRow($user_id)->role;
//							$rolename    = singleDbTableRow($user_id)->rolename;
							$email   	 = singleDbTableRow($user_id)->email;
		
		
						if ($currentUser == 'admin') { ?>
                    
				<a href="<?php echo base_url('Distributor_commission/edit_distributor_commission/' . $profile->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>
					
						<?php }  ?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
