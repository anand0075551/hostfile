
<?php include('header.php'); ?>
<?php
foreach ($visitor->result() as $profile);
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
                            <td>Visitor Name</td>
                            <td><?php echo $profile->visitor_name; ?></td>
                        </tr>
						
									
									
									<tr>
										<td>Type Of Id</td>
										<td><?php echo $profile->type_of_id; ?></td>
									</tr>
									
									<tr>
										<td>Proof Number</td>
										<td><?php echo $profile->proof_number; ?></td>
									</tr>
                
						
							
									<tr>
										<td>Email Id</td>
										<td><?php echo $profile->email_id; ?></td>
									</tr>
									
									<tr>
										<td>Purpose</td>
										<td><?php echo $profile->purpose; ?></td>
									</tr>
									
									<tr>
										<td>From Place</td>
										<td><?php echo $profile->from_place; ?></td>
									</tr>
									
									<tr>
										<td>Refferer</td>
										<td><?php echo $profile->refferer; ?></td>
									</tr>
									
									<tr>
										<td>Whom to Meet</td>
										<td><?php echo $profile->whom_to_meet; ?></td>
									</tr>
									<tr>
										<td>Mobile Number</td>
										<td><?php echo $profile->mobile_no; ?></td>
									</tr>
									
									<tr>
										<td>Remarks</td>
										<td><?php echo $profile->remarks; ?></td>
									</tr>
									
									<td>Visitor Photo</td>
									
									
                           
                            <td>

                                <img id="my_img" src="<?php echo profile_photo_url($profile->photo, $c_user->email); ?>" class="img-thumbnail"  width="30%" height="60%"> 
									
									<!--<td>Visitor Photo</t> </td>
										<td> 
										<!--   <img src="< ?php echo profile_photo_url($profile->photo,$c_user->email); ?>"  -->
										<!--<img src="< ?php echo profile_photo_url($profile->photo, $c_user->email); ?>" width="10%" height="50%">
										</td>
									</tr>-->
									
									<!--<tr>
										<td>Custom1</td>
										<td>< ?php echo $profile->custom1; ?></td>
									</tr>
									
									<tr>
										<td>custom2</td>
										<td>< ?php echo $profile->custom2; ?></td>
									</tr>
									<tr>
										<td>custom3</td>
										<td>< ?php echo $profile->custom3; ?></td>
									</tr>
									<tr>
										<td>custom4</td>
										<td>< ?php echo $profile->custom4; ?></td>
									</tr>
									<tr>
										<td>custom5</td>
										<td>< ?php echo $profile->custom5; ?></td>
									</tr>-->
									
						
						
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
                    <a href="<?php echo base_url('Visitor_entry/visitor_index') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
					<?php  	$user_info 	 = $this->session->userdata('logged_user');
							$user_id 	 = $user_info['user_id'];
							$currentUser = singleDbTableRow($user_id)->role;
//							$rolename    = singleDbTableRow($user_id)->rolename;
							$email   	 = singleDbTableRow($user_id)->email;
		
		
						if ($currentUser == 'admin') { ?>
                    
				<a href="<?php echo base_url('Visitor_entry/edit_visitor_entry/' . $profile->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>
					
						<?php }  ?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
