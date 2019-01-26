
<?php include('header.php'); ?>
<?php
foreach ($personal->result() as $profile);
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
									<td>Personal Info Photo</t> </td>
										<td> 
										
										<img   id="my_img" src="<?php echo profile_photo_url($profile->attachments)?>" class="img-thubnail" width="30%" height="60%">
										</td>
									</tr>
			
					    <tr>
                            <td>Type</td>
                            <td><?php echo $profile->type; ?></td>
                        </tr>
						 <tr>
                            <td>First Name</td>
                            <td><?php echo $profile->first_name; ?></td>
                        </tr>
						 <tr>
                            <td>Middle Name</td>
                            <td><?php echo $profile->mid_name; ?></td>
                        </tr>
						 <tr>
                            <td>Last Name</td>
                            <td><?php echo $profile->last_name; ?></td>
                        </tr>
						 <tr>
                            <td>ID Proof</td>
                            <td><?php echo $profile->id_proof; ?></td>
                        </tr>
						<tr>
                            <td>Aadhar ID</td>
                            <td><?php echo $profile->aadhar_id; ?></td>
                        </tr>
						
                        <tr>
                            <td> Pan ID</td>
                            <td><?php echo $profile->pan_id; ?></td>
                        </tr>
						 <tr>
                            <td>Voter ID</td>
                            <td><?php echo $profile->voter_id; ?></td>
                        </tr>
						 <tr>
                            <td>Driving Lincense ID</td>
                            <td><?php echo $profile->drv_lnc_id; ?></td>
                        </tr>
						 <tr>
                            <td>Passport No.</td>
                            <td><?php echo $profile->passport_no; ?></td>
                        </tr>
						 <tr>
                            <td>DOB</td>
                            <td><?php echo $profile->dob; ?></td>
                        </tr>
						<tr>
                            <td>Dob Proof</td>
                            <td><?php echo $profile->dob_proof; ?></td>
                        </tr>
						
                        <tr>
                            <td>Age</td>
                            <td><?php echo $profile->age; ?></td>
                        </tr>
						 <tr>
                            <td>Email</td>
                            <td><?php echo $profile->email; ?></td>
                        </tr>
						 <tr>
                            <td>Alternative Email</td>
                            <td><?php echo $profile->sec_email; ?></td>
                        </tr>
						 <tr>
                            <td>Permanent Contact No.</td>
                            <td><?php echo $profile->permanent_cntno; ?></td>
                        </tr>
						 <tr>
                            <td>Mobile No. 1</td>
                            <td><?php echo $profile->mob_no1; ?></td>
                        </tr>
						<tr>
                            <td>Mobile No.2</td>
                            <td><?php echo $profile->mob_no2; ?></td>
                        </tr>
                        
                         <tr>
                            <td>Alternate Contact No.</td>
                            <td><?php echo $profile->alt_cnt_no; ?></td>
                        </tr>
						 <tr>
                            <td>Native Place</td>
                            <td><?php echo $profile->native_place; ?></td>
                        </tr>
						 <tr>
                            <td>Resident Address</td>
                            <td><?php echo $profile->resi_address; ?></td>
                        </tr>
						 <tr>
                            <td>pincode</td>
                            <td><?php echo $profile->pincode; ?></td>
                        </tr>
						 <tr>
                            <td>Permanent Address</td>
                            <td><?php echo $profile-> permanent_address; ?></td>
                        </tr>
						<tr>
                            <td>Permanent Address Proof</td>
                            <td><?php echo $profile->permanent_address_proof; ?></td>
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
                    <a href="<?php echo base_url('Personal_info/list_personal_info') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
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
