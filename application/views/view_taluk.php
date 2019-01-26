<?php foreach($taluk_Details->result() as $taluk); ?>


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
                                       Taluk Details
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
											
											
											<tr>
                                                <td>District Name</td>
                                                <td><?php  $taluk->districtname; 
												 												 
												$table_name = 'taluk';
												$where_array = array('talukname' => $taluk->talukname);
												$query1 = $this->db->where($where_array)->get($table_name);
												if ($query1->num_rows() > 0)
												{	foreach($query1->result() as $row1)
														{
															$district_id = $row1->districtname;
															
															$table_name = 'district';
															$where_array = array('id' => $district_id);
															$query2 = $this->db->where($where_array)->get($table_name);
															foreach($query2->result() as $row2)
															{
																$district_name = $row2->districtname;
																
															}
														}
														
															echo $district_name; 
												}
												else{
													echo "State Doesnot Exist";
												 }
														?></td>
                                            </tr>
										
											<tr>
                                                <td>Taluk Name</td>
                                                <td><?php echo $taluk->talukname; ?></td>
                                            </tr>
											
											<tr>
                                                <td>Created By</td>
                                                <td><?php echo $users = singleDbTableRow($taluk->created_by)->first_name; ?></td>
                                            </tr>
											<tr>
                                                <td>Created At</td>
                                                <td><?php echo date("Y-m-d h:i:sa", $taluk->created_at);?></td>
                                             </tr>       
                                               <tr>
                                                <td>Modified By</td>
                                                <td><?php if($taluk->modified_by == '0')
												{ echo $name = 'New Entry'; }
											else{
												echo $users = singleDbTableRow($taluk->modified_by)->first_name;
											}?></td>
                                            </tr>   
											<tr>
                                                <td>Modified At</td>
                                                <td><?php if($taluk->modified_at == '0')
												{ echo $name = 'No Modified time'; }
											else{
												echo  date("Y-m-d h:i:s a",$taluk->modified_at);;
											}?></td>
                                             </tr>    

                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('location/edit_taluk/'.$taluk->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
										<a href="<?php echo base_url('location/all_taluk/'.$taluk->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                                      <!--  <a href="<?php echo base_url('user/log/'.$profile->id ) ?>" class="label label-warning"><i class="fa fa-bar-chart"></i> Log</a>
                                        <a href="<?php echo base_url('activity/users/'.$profile->id) ?>" class="label label-info"><i class="fa fa-check-square-o"></i> Activity</a>
                                        <a href="<?php echo base_url('account/invoice/'.$profile->id) ?>" class="label label-success"><i class="fa fa-money"></i> Earning Report</a>
                                    </div>-->
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
