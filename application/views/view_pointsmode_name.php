<?php foreach ($support_Details->result() as $points_mode); ?>


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
                                       Points Mode
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
											<tr>
                                                <td>Points Mode Name</td>
                                                <td><?php echo $points_mode->pm_name; ?></td>
                                            </tr>
											
											 <tr>
                                <td>Created By</td>
                                <td><?php echo $fname = singleDbTableRow($points_mode->created_by)->first_name . ' ' . singleDbTableRow($points_mode->created_by)->last_name; ?></td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td><?php echo date("Y-m-d", $points_mode->created_at); ?></td>
                            </tr>
                            <tr>
                                <td>Modified By</td>
                                <td><?php
                                    if ($points_mode->modified_by == '0') {
                                        echo $name = 'New Entry';
                                    } else {
                                        echo $fname = singleDbTableRow($points_mode->modified_by)->first_name . ' ' . singleDbTableRow($points_mode->modified_by)->last_name;
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td>Modified At</td>
                                <td><?php
                                    if ($points_mode->modified_at == '0') {
                                        echo $name = 'No Modified time';
                                    } else {
                                        echo date("Y-m-d", $points_mode->modified_at);
                                        ;
                                    }
                                    ?></td>
                            </tr>
		

                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('points_mode/points_mode_edit/'.$points_mode->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
										<a href="<?php echo base_url('points_mode/points_mode/'.$points_mode->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                                      
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
