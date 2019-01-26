
<?php include('header.php'); ?>
<?php
foreach ($medical->result() as $profile);
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
                            <td>Type</td>
                            <td><?php echo $profile->type; ?></td>
                        </tr>
                        
                         <tr>
							<td>Medical Photo</t> </td>
										<td> 
								
										<img id="my_img" src="<?php echo profile_photo_url($profile->attachments); ?>" class="img-thubnail" width="30%" height="60%">
										</td>
									</tr>
						 <tr>
                            <td>Health Status</td>
                            <td><?php echo $profile->health_status; ?></td>
                        </tr>
						 <tr>
                            <td>Major Injuries</td>
                            <td><?php echo $profile->major_injuries; ?></td>
                        </tr>
						 <tr>
                            <td>Major Diseases </td>
                            <td><?php echo $profile->major_diseases; ?></td>
                        </tr>
						 <tr>
                            <td>Blood Group </td>
                            <td><?php echo $profile->blood_group; ?></td>
                        </tr>
						<tr>
                            <td>Health Consultant</td>
                            <td><?php echo $profile->hlth_cnslt; ?></td>
                        </tr>
                        
                        <tr>
                            <td>Insurance</td>
                            <td><?php echo $profile->insurance; ?></td>
                        </tr>
						
						<tr>
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
                                <td><?php echo date("Y-m-d h:i:s", $profile->created_at); ?></td>
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
                                        echo date("Y-m-d h:i:s", $profile->modified_at);
                                        ;
                                    }
                                    ?></td>
                            </tr>
                        <?php } ?>
                    </table>

                </div><!-- /.box-body -->

               <div class="box-footer">
                    <a href="<?php echo base_url('Personal_info/list_medical') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
					<?php  	$user_info 	 = $this->session->userdata('logged_user');
							$user_id 	 = $user_info['user_id'];
							$currentUser = singleDbTableRow($user_id)->role;
//							$rolename    = singleDbTableRow($user_id)->rolename;
							$email   	 = singleDbTableRow($user_id)->email;
		
		
						if ($currentUser == 'admin') { ?>
                    
				
						<?php }  ?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
