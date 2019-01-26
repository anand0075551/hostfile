<?php foreach($menu->result() as $left); ?>


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
                                        Forms Details
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
											
                                            <tr>
                                                <th width="20%">Role</th>
                                                <th><?php 
											//	echo $left->role_id;
														$query = $this->db->get_where('role', ['id' => $left->role_id]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo   $row->rolename;
									}
								} else {
                                    echo "Role Name Doesnot Exist";
                                }
												?></th>
                                            </tr><tr>
                                                <th width="20%">Left Menu </th>
                                                <th><?php 
											//	echo $left->bg_id;
								$query = $this->db->get_where('menu_business_groups', ['id' => $left->bg_id]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo   $row->business_name;
									}
								} else {
                                    echo "Left Menu Name Doesnot Exist";
                                }


												?></th>
                                            </tr><tr>
                                                <th width="20%">Form Name</th>
                                                <th><?php 
											//	echo $left->bgform_id; 
							$query = $this->db->get_where('menu_bg_forms', ['bgform_id' => $left->bgform_id]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo   $row->displayform_name;
									}
								} else {
                                    echo "Left Menu Name Doesnot Exist";
                                }
												
												
												?></th>
                                            </tr><tr>
                                                <th width="20%">Permission</th>
                                                <th><?php
													if($left->permission == 1 ){echo "Active" ; }else{echo "InActive" ;}
												
												
												?></th>
                                            </tr>
                                            

											
			
											
						
											
											
											
											
											
											

											
											<tr>
                                                <td>Created By</td>
                                                <td><?php echo  singleDbTableRow($left->created_by)->first_name." ".singleDbTableRow($left->created_by)->last_name; ?></td>
                                            </tr>
											<tr>
                                                <td>Created At</td>
                                                <td><?php echo date("Y-m-d h:i:sa", $left->created_at);?></td>
                                             </tr>       
                                               <tr>
                                                <td>Modified By</td>
                                                <td><?php if($left->modified_by == '0')
												{ echo $name = 'New Entry'; }
											else{
												echo $users = singleDbTableRow($left->modified_by)->first_name;
											}?></td>
                                            </tr>   
											<tr>
                                                <td>Modified At</td>
                                                <td><?php if($left->modified_at == '0')
												{ echo $name = 'No Modified time'; }
											else{
												echo  date("Y-m-d h:i:s a",$left->modified_at);;
											}?></td>
                                             </tr>    
										
											

                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                   <!--     <a href="< ?php echo base_url('menu/edit_assigned_menu/'.$left->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>-->
										<a href="<?php echo base_url('menu/assigned_forms/'.$left->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Back</a>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
