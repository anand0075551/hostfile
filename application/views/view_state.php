<?php foreach($state_Details->result() as $state); ?>


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
                                       State Details
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
											
											
											
											<tr>
                                                <td>Country</td>
                                                <td><?php  $state->country; 
												 
												$table_name = 'state';
												$where_array = array('statename' => $state->statename);
												$query1 = $this->db->where($where_array)->get($table_name);
												if ($query1->num_rows() > 0)
												{	foreach($query1->result() as $row1)
														{
															$country_id = $row1->country;
															
															$table_name = 'countries';
															$where_array = array('id' => $country_id);
															$query2 = $this->db->where($where_array)->get($table_name);
															foreach($query2->result() as $row2)
															{
																$country_name = $row2->country_name;
															}
														}
														
															echo $country_name; 
												}
												else{
													echo "State Doesnot Exist";
												 }
														?></td>
                                            </tr>
										
											<tr>
                                                <td>State Name</td>
                                                <td><?php echo $state->statename; ?></td>
                                            </tr>
											<tr>
                                                <td>Created By</td>
                                                <td><?php echo $users = singleDbTableRow($state->created_by)->first_name; ?></td>
                                            </tr>
											<tr>
                                                <td>Created At</td>
                                                <td><?php echo date("Y-m-d h:i:sa", $state->created_at);?></td>
                                             </tr>       
                                               <tr>
                                                <td>Modified By</td>
                                                <td><?php if($state->modified_by == '0')
												{ echo $name = 'New Entry'; }
											else{
												echo $users = singleDbTableRow($state->modified_by)->first_name;
											}?></td>
                                            </tr>   
											<tr>
                                                <td>Modified At</td>
                                                <td><?php if($state->modified_at == '0')
												{ echo $name = 'No Modified time'; }
											else{
												echo  date("Y-m-d h:i:s a",$state->modified_at);;
											}?></td>
                                             </tr>    
													



												
                                           


                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('location/edit_state/'.$state->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
										<a href="<?php echo base_url('location/all_state/'.$state->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Back</a>
                                      <!--  <a href="<?php echo base_url('user/log/'.$profile->id ) ?>" class="label label-warning"><i class="fa fa-bar-chart"></i> Log</a>
                                        <a href="<?php echo base_url('activity/users/'.$profile->id) ?>" class="label label-info"><i class="fa fa-check-square-o"></i> Activity</a>
                                        <a href="<?php echo base_url('account/invoice/'.$profile->id) ?>" class="label label-success"><i class="fa fa-money"></i> Earning Report</a>
                                    </div>-->
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
