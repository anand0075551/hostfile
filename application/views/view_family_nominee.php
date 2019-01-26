<?php include('header.php'); ?>
<?php
foreach ($education->result() as $profile);
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
									<td>Family Photo</t> </td>
										<td> 
										
										<img   id="my_img" src="<?php echo profile_photo_url($profile->attachments)?>" class="img-thubnail" width="30%" height="60%">
										</td>
							</tr>
					
					
					    <tr>
                            <td>ID</td>
                            <td><?php echo $profile->id; ?></td>
                        </tr>
						 <tr>
                            <td>Type</td>
                            <td><?php echo $profile->type; ?></td>
                        </tr>
						<tr>
                            <td>Nomlnee</td>
                            <td><?php echo $profile->nominee; ?></td>
                        </tr>
						 <tr>
                            <td>Proff Nomlnee</td>
                            <td><?php echo $profile->proof_nominee; ?></td>
                        </tr>
						 <tr>
                            <td>Marital Status</td>
                            <td><?php echo $profile->marital_status; ?></td>
                        </tr>
						<tr>
                            <td>Family Member</td>
                            <td><?php echo $profile->family_member; ?></td>
                        </tr>
							<tr>
                            <td>Head Family</td>
                            <td><?php echo $profile->head_family; ?></td>
                        </tr>
					    	<tr>
                            <td>Parents Name</td>
                            <td><?php echo $profile->parents_name; ?></td>
                        </tr>
			            	<tr>
                            <td>Siblings Name</td>
                            <td><?php echo $profile->siblings_name; ?></td>
                        </tr>
						
				        	<tr>
                            <td>Partners name</td>
                            <td><?php echo $profile->partners_name; ?></td>
                        </tr>
				
									
						<tr>
                            <td>Children Name</td>
                            <td><?php echo $profile->children_name; ?></td>
                        </tr>			
									
						<tr>
                            <td>CDependents</td>
                            <td><?php echo $profile->dependents; ?></td>
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
                    <a href="<?php echo base_url('Personal_info/list_family_nominee') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
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
