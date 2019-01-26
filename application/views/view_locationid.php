<?php foreach($location_Details->result() as $locid); ?>


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
                                       Location Details
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
											
											
											<tr>
                                                <td>Area Location</td>
                                                <td><?php echo $locid->location; ?></td>
                                            </tr>											<tr>
                                                <td>Taluk</td>
                                                <td><?php 
												if($locid->taluk != ''){
												echo $locid->taluk; 
												}
								 else {
                                    echo "Taluk Doesnot Exist";
                                }
												
												?></td>
                                            </tr>

											
											<tr>
                                                <td>Created By</td>
                                                <td><?php echo $users = singleDbTableRow($locid->created_by)->first_name; ?></td>
                                            </tr>
											<tr>
                                                <td>Created At</td>
                                                <td><?php echo date("Y-m-d h:i:sa", $locid->created_at);?></td>
                                             </tr>       
                                               <tr>
                                                <td>Modified By</td>
                                                <td><?php if($locid->modified_by == '0')
												{ echo $name = 'New Entry'; }
											else{
												echo $users = singleDbTableRow($locid->modified_by)->first_name;
											}?></td>
                                            </tr>   
											<tr>
                                                <td>Modified At</td>
                                                <td><?php if($locid->modified_at == '0')
												{ echo $name = 'No Modified time'; }
											else{
												echo  date("Y-m-d h:i:s a",$locid->modified_at);;
											}?></td>
                                             </tr>    

                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('location/edit_locationid/'.$locid->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
										<a href="<?php echo base_url('location/all_locationid/'.$locid->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Back</a>
                                      <!--  <a href="<?php echo base_url('user/log/'.$profile->id ) ?>" class="label label-warning"><i class="fa fa-bar-chart"></i> Log</a>
                                        <a href="<?php echo base_url('activity/users/'.$profile->id) ?>" class="label label-info"><i class="fa fa-check-square-o"></i> Activity</a>
                                        <a href="<?php echo base_url('account/invoice/'.$profile->id) ?>" class="label label-success"><i class="fa fa-money"></i> Earning Report</a>
                                    </div>-->
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
