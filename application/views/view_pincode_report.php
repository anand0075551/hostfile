
<?php include('header.php'); ?>
<?php
foreach ($pincode->result() as $profile);
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
                            <td>ID</td>
                            <td><?php echo $profile->id; ?></td>
                        </tr>
						
						<tr>
                            <td>Pincode</td>
                            <td><?php echo $profile->pincode; ?></td>
                        </tr>
						<tr>
                            <td>Location</td>
                            <td><?php echo $profile->location; ?></td>
                        </tr>
								
						<tr>
							<td>Taluk</td>
							<td><?php echo $profile->taluk; ?></td>
						</tr>
						
						<tr>
							<td>District</td>
							<td><?php echo $profile->district; ?></td>
				        </tr>
									
						<tr>
							<td>Postal Division</td>
							<td><?php echo $profile->postal_division; ?></td>
						</tr>
									
						<tr>
							<td>Postal Region</td>
							<td><?php echo $profile->postal_region; ?></td>
						</tr>
                
						
							
					<tr>
						<td>State</td>
						<td><?php echo $profile->state; ?></td>
					</tr>
									
					<tr>
						<td>Country</td>
						<td><?php echo $profile->country; ?></td>
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
                    <a href="<?php echo base_url('Pincodes/pincodes_report_list') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
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
