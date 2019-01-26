
<?php include('header.php'); ?>
<?php
foreach ($business->result() as $profile);
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
							<td>Business Info Photo</t> </td>
										<td> 
								
										<img id="my_img" src="<?php echo profile_photo_url($profile->attachments); ?>" class="img-thubnail" width="30%" height="60%">
										</td>
									</tr>
					    <tr>
                            <td>Type</td>
                            <td><?php echo $profile->type; ?></td>
                        </tr>
						 <tr>
                            <td>Business Email</td>
                            <td><?php echo $profile->business_email; ?></td>
                        </tr>
						 <tr>
                            <td>Business Contact No.</td>
                            <td><?php echo $profile->business_cntno; ?></td>
                        </tr>
						 <tr>
                            <td>Bank Details</td>
                            <td><?php echo $profile->bank_details; ?></td>
                        </tr>
						 <tr>
                            <td>Shelter Details</td>
                            <td><?php echo $profile->shelter_details; ?></td>
                        </tr>
						<tr>
                            <td>Renting Assests</td>
                            <td><?php echo $profile->renting_assets; ?></td>
                        </tr>
						
                        <tr>
                            <td>Own Use Assests</td>
                            <td><?php echo $profile->own_use_assets; ?></td>
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
                    <a href="<?php echo base_url('Personal_info/list_business_info') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
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
