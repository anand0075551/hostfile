<?php foreach($country_Details->result() as $countries); ?>


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
                                       Country Details
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">											
											<tr>
                                                <td>Country Id</td>
                                                <td><?php echo $countries->id; ?></td>														
                                            </tr>										
											<tr>
                                                <td>Country Name</td>
                                                <td><?php echo $countries->country_name; ?></td>
                                            </tr>
											<tr>
                                                <td>Country Code</td>
                                                <td><?php echo $countries->country_code; ?></td>
                                            </tr>
											<tr>
                                                <td>Currency Code</td>
                                                <td><?php echo $countries->currency_code; ?></td>
                                            </tr>
											<tr>
                                                <td>Continent Name</td>
                                                <td><?php echo $countries->continent_name; ?></td>
                                            </tr>
											<tr>
                                                <td>Continent</td>
                                                <td><?php echo $countries->continent; ?></td>
                                            </tr>
											<tr>
                                                <td>Languages</td>
                                                <td><?php echo $countries->languages; ?></td>
                                            </tr>
                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <!--<a href="<?php echo base_url('location/edit_state/'.$state->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>-->
										<a href="<?php echo base_url('location/all_country/'.$countries->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                                      <!--  <a href="<?php echo base_url('user/log/'.$profile->id ) ?>" class="label label-warning"><i class="fa fa-bar-chart"></i> Log</a>
                                        <a href="<?php echo base_url('activity/users/'.$profile->id) ?>" class="label label-info"><i class="fa fa-check-square-o"></i> Activity</a>
                                        <a href="<?php echo base_url('account/invoice/'.$profile->id) ?>" class="label label-success"><i class="fa fa-money"></i> Earning Report</a>
                                    </div>-->
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
