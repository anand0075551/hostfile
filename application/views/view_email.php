
<?php include('header.php'); ?>
<?php
foreach ($email_Details->result() as $profile)
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
					
					
					<tr>
                            <td>Mediam Type</td>
                            <td><?php  if ($profile->mediam_type !="") {
								
							echo $profile->mediam_type;
							}
							else {
								echo("");
							}?></td>
                    </tr>
					
					
					<tr>
                            <td>Template Name</td>
                            <td><?php  if ($profile->template_name !="") {
								
							echo $profile->template_name;
							}
							else {
								echo("");
							}?></td>
                    </tr>
					
					
					<tr>
                            <td>Content Name</td>
                            <td><?php  if ($profile->content_name !="") {
								
							echo $profile->content_name;
							}
							else {
								echo("");
							}?></td>
                    </tr>
					
							
					
			
		
        
<?php	$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];
		$role = $user_info['role'];
		
				if ($role == 'admin') {?>
							<tr>
                                <td>Created By</td>
                                <td><?php echo $fname = singleDbTableRow($profile->created_by)->first_name . ' ' . singleDbTableRow($profile->created_by)->last_name; ?></td>
                            </tr>
							
						<tr>
                            <td>Created Time</td>
                            <td><?php echo date("h:i:sa") ?></td> 
                        </tr>
							
                        <tr>
                                <td>Created Date</td>
                                <td><?php echo date("d-m-y", $profile->created_at); ?></td>
                        </tr>
							
					
							
                            <tr>
                                <td>Modified By</td>
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
                                        echo $name = 'No Modified date';
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
                    <a href="<?php echo base_url('email') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
					<?php  	$user_info 	 = $this->session->userdata('logged_user');
							$user_id 	 = $user_info['user_id'];
							$currentUser = singleDbTableRow($user_id)->role;
							$rolename    = singleDbTableRow($user_id)->rolename;
							$email   	 = singleDbTableRow($user_id)->email;
							 { ?>
                    
					<a href="<?php echo base_url('email/edit_email/'.$profile->id) ?>" class="btn btn-warning"><i class="fa fa-arrow-edit"></i>Edit</a>
			
				
					
						<?php } ?>
                </div>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
