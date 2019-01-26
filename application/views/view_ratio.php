
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
                                        <?php echo 'Wallet Convertion Ratio View '; ?>
										
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
                                            
                                             <!--   <th width="20%">Pay Specifications</th> -->
											<tr>
												<th>Convertion For </th>
                                                <th><?php echo $points_ratio->identity_id; ?></th>
                                            </tr>
                                            <tr>
                                                <td>Alpha</td>
                                                <td><?php echo $points_ratio->alpha; ?></td> 
                                            </tr>											
                                            <tr>
                                                <td>Beta</td>
                                                <td><?php echo $points_ratio->beta; ?></td>
                                            </tr>   
											<tr>
												<td>Gamma</td>
                                                <td><?php echo $points_ratio->gamma; ?></td>
                                            </tr> 
											<tr>
												<td>Description</td>
                                                <td><?php echo $points_ratio->remarks; ?></td> 
                                            </tr>                                           
											 <tr>
                                                <td>Created By</td>                                               
												<?php $fname = singleDbTableRow($points_ratio->created_by)->first_name;	
													$lname = singleDbTableRow($points_ratio->created_by)->last_name;
												?>
													<td><?php  echo $fname.' '.$lname; ?></td>	
                                            </tr>
                                            								
                                            
                                            <tr>
                                                <td>Last Modified By</td>
                                                <td><?php echo $points_ratio->modified_by; ?></td>
                                            </tr>
                                         
                                       
                                            


                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('category/edit_ratio/'.$points_ratio->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="<?php echo base_url('category/index/') ?>" class="btn btn-warning"><i class="fa fa-road"></i> Back</a>
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
