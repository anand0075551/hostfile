
<?php include('header.php'); ?>
<?php
foreach ($support_Details->result() as $profile);
?>

<?php 
	$user_id = $profile->created_by;
	$user = $this->db->get_where('users', ['id' => $user_id]);
	foreach($user->result() as $u)
	{
		
		$ref_id = $u->referral_code;
		$email = $u->email;
		$phone = $u->contactno;
		$role = $u->rolename;
	}
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
							<td>Consumer ID</td>
							<td><?php echo $ref_id; ?></td>
					</tr>
					<tr>
							<td>Consumer Email</td>
							<td><?php echo $email; ?></td>
					</tr>
					<tr>
							<td>Contact Number</td>
							<td><?php echo $phone; ?></td>
					</tr>
					  <tr>
                            <td>Role Name</td>
                            <td><?php
                              
							   $query = $this->db->get_where('role', ['roleid' => $role]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo $row->rolename;
									}
								} else {
                                    echo "";
                                }
								 
								
                            
                                ?></td>
                        </tr>
					
					
					<tr>
                            <td>Ticket no</td>
                            <td><?php  if ($profile->ticket_no !="") {
								
							echo $profile->ticket_no;
							}
							else {
								echo("");
							}?></td>
                    </tr>
					
					
					
                        <tr>
                            <td>Business Name</td>
                             <td><?php
                              
							   $query = $this->db->get_where('business_groups', ['id' => $profile->business_id]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo $row->business_name;
									}
								} else {
                                    echo "Main Category Doesnot Exist";
                                }
								 
								
                            
                                ?></td>
                        </tr>
						
						
						
							
						<tr>
                            <td>Type of Issue</td>
                            <td><?php echo $profile->issue_type; ?></td>
                        </tr>
						
						
						<tr>
                            <td>Current Status</td>
                            <td><?php $query1 = $this->db->get_where('status', ['id' => $profile->current_status,]);
								
								if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row) {
                                        echo  $row->status;
									}
								} else {
                                     echo  "Not Assigned Yet";
                                }?></td>
						</tr>
						
						
							
						<!--<tr>
                            <td>assigned To</td>
                            <td><?php $query2 = $this->db->get_where('users', ['id' => $profile->assigned_to,]);
								
								if ($query2->num_rows() > 0) {
                                    foreach ($query2->result() as $row) {
                                        echo  $row->first_name.'  '.$row->last_name;
									}
								} else {
                                     echo  "";
                                }?></td>
						</tr>-->
						
                 
                        <tr>
                            <td>Issue Details</td>
                            <td><?php echo $profile->issue_details; ?></td>
                        </tr>
       
                        <tr>
                            <td>Comments</td>
                            <td><?php echo $profile->comments; ?></td>
                        </tr>
				
                        <tr>
                            <td>File</td>
                            <td>

                                <img id="my_img" src="<?php echo profile_photo_url($profile->photo, $c_user->email); ?>" class="img-thumbnail"  width="30%" height="60%">
                        </tr>

                        <?php
                        $user_info = $this->session->userdata('logged_user');
                        $user_id = $user_info['user_id'];
                        $role = $user_info['role'];

                        if ($role == 'admin') {
                            ?>
                            <tr>
                                <td>Ticket Created By</td>
                                <td><?php echo $fname = singleDbTableRow($profile->created_by)->first_name . ' ' . singleDbTableRow($profile->created_by)->last_name; ?></td>
                            </tr>
							
						<tr>
                            <td>Ticket Created Time</td>
                            <td><?php echo date("h:i:sa") ?></td> 
                        </tr>
							
                        <tr>
                                <td>Ticket Created Date</td>
                                <td><?php echo date("d-m-y", $profile->created_at); ?></td>
                        </tr>
							
					
							
                            <tr>
                                <td>Ticket Modified By</td>
                                <td><?php
                                    if ($profile->modified_by == '0') {
                                        echo $name = 'New Entry';
                                    } else {
                                        echo $fname = singleDbTableRow($profile->modified_by)->first_name . ' ' . singleDbTableRow($profile->modified_by)->last_name;
                                    }
                                    ?></td>
                            </tr>
							
									
							 <tr>
                                <td>Modified Time</td>
								
                                <td><?php
                                    if ($profile->modified_at == '0') {
                                        echo $name = 'No Modified time';
                                    } else {
                                        echo date("h:i:sa", $profile->modified_at);
                                        ;
                                    }
                                    ?></td>
                            </tr>
							
							
							
							
							
                            <tr>
                                <td>Modified At</td>
                                <td><?php
                                    if ($profile->modified_at == '0') {
                                        echo $name = 'No Modified time';
                                    } else {
                                        echo date("d-m-y", $profile->modified_at);
                                        ;
                                    }
                                    ?></td>
                            </tr>
                        <?php } ?>
                    </table>

                </div><!-- /.box-body -->

				<div class="box-footer">
							<?php $user_info  = $this->session->userdata('logged_user');
							$user_id 	      = $user_info['user_id'];
							$currentUser      = singleDbTableRow($user_id)->role;
							$rolename         = singleDbTableRow($user_id)->rolename;
							$email   	      = singleDbTableRow($user_id)->email;
				if ($rolename == '36') { ?>
				
				 <a href="<?php echo base_url('support/assigned_list') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
				
					<?php 
				}	
				elseif ($rolename == '11'|| '12'||'76') { ?>
				
                    <a href="<?php echo base_url('support') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
					
					<?php } ?>
					
					
					
					
					
					
					<?php  	
							//if ( $rolename != '12' && $profile->current_status!='33' ) { 
					if (($profile->current_status != '33' && $rolename == '36') || ($profile->current_status != '33' && $rolename == '76')) {
							  ?>
							  
							  
                    
				<a href="<?php echo base_url('support/edit_support/' . $profile->id) ?>" class="btn btn-warning"><i class="fa fa-arrow-edit"></i>Edit</a>
					<?php  	
							if (  $rolename == '11') { 
							  ?>
				<a href="<?php echo base_url('support/view_support_status/' . $profile->ticket_no) ?>" class="btn btn-success"><i class="fa fa-arrow-edit"></i>Track</a>
			
				
					
							<?php } }elseif( $rolename == '11' && $profile->current_status=='33'){
								?>
								<a href="<?php echo base_url('support/view_support_status/' . $profile->ticket_no) ?>" class="btn btn-success"><i class="fa fa-arrow-edit"></i>Track</a>
								<?php
							}?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
