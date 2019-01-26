
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
                            <td>Item Name</td>
                            <td><?php echo $profile->item_name; ?></td>
                        </tr>
						
									
									
									<tr>
										<td>Type Of item</td>
										<td><?php echo $profile->type_of_item; ?></td>
									</tr>
									
									<tr>
										<td>item Number</td>
										<td><?php echo $profile->item_number; ?></td>
									</tr>
                
						
							
									<tr>
										<td>Invoice Id</td>
										<td><?php echo $profile->invoice_id; ?></td>
									</tr>
									
									<tr>
										<td>Purpose</td>
										<td><?php echo $profile->purpose; ?></td>
									</tr>
									
									<tr>
										<td>Item Value</td>
										<td><?php echo $profile->item_value; ?></td>
									</tr>
									
									<tr>
										<td>From Place</td>
										<td><?php echo $profile->from_place; ?></td>
									</tr>
									
									<tr>
										<td>From Whom</td>
										<td><?php echo $profile->from_whom; ?></td>
									</tr>
									
									<tr>
										<td>To Reciever</td>
										<td><?php echo $profile->to_reciver; ?></td>
									</tr>
									<tr>
										<td>Mobile Number</td>
										<td><?php echo $profile->mobile_no; ?></td>
									</tr>
									
									<tr>
										<td>Remarks</td>
										<td><?php echo $profile->remarks; ?></td>
									</tr>
									
									<tr>
									<td>Inward Item Photo</t> </td>
										<td> 
										<!--   <img src="< ?php echo profile_photo_url($profile->photo,$c_user->email); ?>"  -->
										<img src="<?php echo profile_photo_url($profile->photo, $c_user->email); ?>" class="img-thubnail" id="my_img" width="30%" height="60%">
										</td>
									</tr>
						
						
						<?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $role = $user_info['role'];

                        if ($role == 'admin') {
                            ?>
							<tr>
                                <td>Created By</td>
                                <td><?php echo $fname = singleDbTableRow($profile->created_by)->first_name. ' ' . singleDbTableRow($profile->created_by)->last_name; ?></td>
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
                    <a href="<?php echo base_url('Visitor_entry/inward_list') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
					<?php  	$user_info 	 = $this->session->userdata('logged_user');
							$user_id 	 = $user_info['user_id'];
							$currentUser = singleDbTableRow($user_id)->role;
//							$rolename    = singleDbTableRow($user_id)->rolename;
							$email   	 = singleDbTableRow($user_id)->email;
		
		
						if ($currentUser == 'admin') { ?>
                    
				<a href="<?php echo base_url('Visitor_entry/edit_inward_items/' . $profile->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>
					
						<?php }  ?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
