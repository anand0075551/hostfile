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
                                       Left Menu Details
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
											
                                            <tr>
                                                <th width="20%">Business Group Name</th>
                                                <th><?php echo $left->business_name; ?></th>
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
                                        <a href="<?php echo base_url('menu/edit_left_menu/'.$left->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
										<a href="<?php echo base_url('menu/all_left_menu/'.$left->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Back</a>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
