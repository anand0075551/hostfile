
<?php include('header.php'); ?>
<?php
foreach ($Tax->result() as $profile)
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
									<!--view tax id----------------------------------->
									  
									       <tr>
                                                <td>Vehicle Brand</td>
                                                 <td> <?php $query1 = $this->db->get_where('trp_vehicle_make', ['id' => $profile->make_id,]);
											
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
                                                <td>Vehicle Model</td>
                                                 <td> <?php $query1 = $this->db->get_where('trp_vehicle_model', ['id' => $profile->model_id,]);
											
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
					    
								    <!------------------------------------------------>
										
					    
								    <!------------------------------------------------>
									<tr>
										<td>Version</td>
										<td><?php echo $profile->version; ?></td>
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
                    <a href="<?php echo base_url('Transport/types_transport_index') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
					<?php  	$user_info 	 = $this->session->userdata('logged_user');
							$user_id 	 = $user_info['user_id'];
							$currentUser = singleDbTableRow($user_id)->role;
						$rolename    = singleDbTableRow($user_id)->rolename;
							$email   	 = singleDbTableRow($user_id)->email;
		
		
						if ($currentUser == 'admin') { ?>
                    
				<a href="<?php echo base_url('Transport/edit_transport_type/' . $profile->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>
					
						<?php }  ?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
