<?php 
	
	foreach($cost->result() as $courier); 
	
?>
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
                                       View Shipment Cost
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
											
											<tr>
                                                <td>Weight</td>
                                                <td><?php echo $courier->weight; ?></td>
                                            </tr>
											<tr>
                                                <td>From Pin</td>
                                                <td><?php

											//	echo $courier->from_pin; 
												  $query = $this->db->get_where('pincode', ['id' => $courier->from_pin]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo $row->pincode;
									}
								} else {
                                    echo "Pincode Doesnot Exist";
                                }
												?></td>
                                            </tr>
											<tr>
                                                <td>To Pin</td>
                                                <td><?php 
												
												//echo $courier->to_pin; 
									 $query = $this->db->get_where('pincode', ['id' => $courier->to_pin]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo $row->pincode;
									}
								} else {
                                    echo "Pincode Doesnot Exist";
                                }
												
												?></td>
                                            </tr>
											<tr>
                                                <td>Amount</td>
                                                <td><?php echo $courier->amount; ?></td>
                                            </tr>
											

											
											
                                        </table>

                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
								<?php	$currentAuthDta = loggedInUserData();
$currentUser = $currentAuthDta['role'];

$user_info = $this->session->userdata('logged_user');
        $user_id = $user_info['user_id'];	
		$currentRolename   = singleDbTableRow($user_id)->rolename;
		
		  if($currentUser == 'admin'){   
?>
                                      <a href="<?php echo base_url('courier/edit_courier_cost/'.$courier->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
		<?php } ?>
									  
										<a href="<?php echo base_url('cms/delivery_status/'.$courier->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                                     
                            </div><!-- /.box -->
						</div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
