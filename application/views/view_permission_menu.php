<?php foreach($menu_Details->result() as $role); ?>


<?php include('header.php'); ?>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">
                                       Role Details
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
											<tr>
                                                <td>Role Name</td>
                                                <td><?php 
												
											//	echo $role->roleid; 
							$query = $this->db->get_where('role', ['id' => $role->roleid]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo $row->rolename ;
									}
								} else {
                                    echo "Data Doesnot Exist";
                                }
												?></td>
                                            </tr>
											<tr>
                                                <td>Business Name</td>
                                                <td><?php 
												
									//			echo $role->business_name;
								$query = $this->db->get_where('business_label', ['id' => $role->business_name]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo $row->bussiness_name ;
									}
								} else {
                                    echo "Data Doesnot Exist";
                                }
												?></td>
                                            </tr>
											<tr>
                                                <td>Status</td>
                                                <td>
												
												<?php
														if($role->status == 1 )
														{
															echo 'ACTIVE';  
														}
														else{
															echo 'IN-ACTIVE'; 
														} 
														?>

												</td>
                                            </tr>
											
										
                                              
		

                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('permission/edit_permission/'.$role->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>

                                      
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
