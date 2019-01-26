<?php include('header.php'); ?>
<?php
foreach ($generate->result() as $doc);
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
                            <td>For Role</td>
                            <td><?php 
							//echo $doc->role; 
							$query1 = $this->db->get_where('role', ['id' => $doc->role,]);

                                if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row) {
                                        echo $row->rolename;
                                    }
                                } else {
                                    echo "no data";
                                }
							
							
							?></td>
                        </tr>
												<tr>
                            <td>File Name</td>
                            <td><?php echo $doc->file_name; ?></td>
                        </tr>
	<?php 
	$currentAuthDta = loggedInUserData();
	$currentUser = $currentAuthDta['role'];
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentRolename = singleDbTableRow($user_id)->rolename;
	
	$name = singleDbTableRow($user_id)->first_name.' '.singleDbTableRow($user_id)->last_name;
	$email = singleDbTableRow($user_id)->email;
	$mobile = singleDbTableRow($user_id)->contactno;
	?><?php
	
	  $doc2 = $this->db->order_by('id', 'asc')->get('generate_doc');
  if($doc2->num_rows() >0)
   {
	  foreach ($doc2->result() as $t);
	    $userfile = $t->userfile;
		{
	?>

  
						<tr>
                            <td>Content</td>
                            <td> <?php  
							$str      =	$doc->userfile;
							$replace  = array($name,$email,$mobile);	
							$find     = array('$name','$email','$mobile');
							$string   = str_replace($find,$replace,$str);
							echo $string;
					?></td>
                        </tr>
						
   <?php } }?>
						
																		<tr>
                            <td>Status</td>
                            <td><?php 
							if($doc->status == 1)
							{
							echo "Active"; 
							}
							else{
								echo "Inactive"; 
							}
							?></td>
                        </tr>
						
						
						
                        <?php
                        $role = $user_info['role'];
                        if ($role == 'admin') {
                            ?>
                            <tr>
                                <td>Created By</td>
                                <td><?php echo $fname = singleDbTableRow($doc->created_by)->first_name . ' ' . singleDbTableRow($doc->created_by)->last_name; ?></td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td><?php echo date('Y-m-d',$doc->created_at); ?></td>
                            </tr>
                            <tr>
                                <td>Modified By</td>
                                <td><?php
                                    if ($doc->modified_by == '0')
									{
                                        echo $name = 'New Entry';
                                    }
									else 
									{
                                        echo $fname = singleDbTableRow($doc->modified_by)->first_name . ' ' . singleDbTableRow($doc->modified_by)->last_name;
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Modified At</td>
                                <td><?php
                                    if ($doc->modified_at == '') 
									{
                                        echo $name = 'No Modified time';
                                    }
									else 
									{
                                        echo date('Y-m-d',$doc->modified_at);
                                    }
                                    ?>
									</td>
                            </tr>
                        <?php } ?>
                    </table>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="<?php echo base_url('Generate_doc/generated_doc_list/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>
				<a href="<?php echo base_url('Generate_doc/edit_generated_doc/' . $doc->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Edit</a>
                </div>
            </div><!-- /.box -->
        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
