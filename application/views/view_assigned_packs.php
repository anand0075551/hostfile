
<?php include('header.php'); ?>
<?php
foreach ($assigned_packs->result() as $profile);
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
                            <td>Prepaired By</td>
                            <td><?php echo $fname = singleDbTableRow($profile->prepaired_by)->first_name . ' ' . singleDbTableRow($profile->prepaired_by)->last_name; ?></td>
                        </tr>
						
						<tr>
                            <td>Assigned Role</td>
                            <td><?php 
											$query1 = $this->db->get_where('role', ['id' => $profile->assigned_role,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo    $row->rolename;
													}
												} else {
													 echo  "no data";
												}?></td>
                        </tr>
						
						<tr>
                            <td>Assigned Name</td>
                             <td><?php echo $fname = singleDbTableRow($profile->assigned_to_name)->first_name . ' ' . singleDbTableRow($profile->assigned_to_name)->last_name; ?></td>
                        </tr>
						<tr>
                            <td>Unique Preparation</td>
                            <td><?php echo $profile->unique_prep; ?></td>
                        </tr>
						
						<tr>
                            <td>Product </td>
                             <td><?php 
											$query1 = $this->db->get_where('product_preparation', ['id' => $profile->product_id,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo    $row->id.'-'.$row->product_name;
													}
												} else {
													 echo  "no data";
												}?></td>
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
                    <a href="<?php echo base_url('Product_preparation/list_assigned_packs') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
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
