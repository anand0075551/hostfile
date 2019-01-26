<?php foreach($pincode->result() as $pincode); ?>


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
                                      Pincode Details
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
											
											
											<tr>
                                                <td>Country</td>
                                                <td><?php echo $pincode->country; ?></td>
                                            </tr>											<tr>
                                                <td>State</td>
                                                <td><?php echo $pincode->state; ?></td>
                                            </tr>	
                                           											<tr>
                                                <td>Postal Region</td>
                                                <td><?php echo $pincode->postal_region; ?></td>
                                            </tr>	
											
											<tr>
                                                <td>Postal Division</td>
                                                <td><?php echo $pincode->postal_division; ?></td> 
												</tr>
												
												
											<tr>
                                                <td>District</td>
                                                <td><?php echo $pincode->district; ?></td>
                                            </tr>											<tr>
                                                <td>Taluk</td>
                                                <td><?php echo $pincode->taluk; ?></td>
                                            </tr>											
										<tr>
                                                <td>Location</td>
                                                <td><?php echo $pincode->location; ?></td>
                                            </tr>											<tr>
                                                <td>Pincode</td>
                                                <td><?php echo $pincode->pincode; ?></td>
                                            </tr>											

											
											
											
											
											
											
											
											
											
											<tr>
                                                <td>Created By</td>
                                                <td><?php echo $users = singleDbTableRow($pincode->created_by)->first_name; ?></td>
                                            </tr>
											<tr>
                                                <td>Created At</td>
                                                <td><?php echo date("Y-m-d h:i:sa", $pincode->created_at);?></td>
                                             </tr>       
                                               <tr>
                                                <td>Modified By</td>
                                                <td><?php if($pincode->modified_by == '0')
												{ echo $name = 'New Entry'; }
											else{
												echo $users = singleDbTableRow($pincode->modified_by)->first_name;
											}?></td>
                                            </tr>   
											<tr>
                                                <td>Modified At</td>
                                                <td><?php if($pincode->modified_at == '0')
												{ echo $name = 'No Modified time'; }
											else{
												echo  date("Y-m-d h:i:s a",$pincode->modified_at);;
											}?></td>
                                             </tr>    

                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('location/edit_pincode/'.$pincode->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
										<a href="<?php echo base_url('location/all_pincodes/'.$pincode->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Back</a>
                                      <!--  <a href="<?php echo base_url('user/log/'.$profile->id ) ?>" class="label label-warning"><i class="fa fa-bar-chart"></i> Log</a>
                                        <a href="<?php echo base_url('activity/users/'.$profile->id) ?>" class="label label-info"><i class="fa fa-check-square-o"></i> Activity</a>
                                        <a href="<?php echo base_url('account/invoice/'.$profile->id) ?>" class="label label-success"><i class="fa fa-money"></i> Earning Report</a>
                                    </div>-->
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
