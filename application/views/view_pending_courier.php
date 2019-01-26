<!---
1. Below fields are Bank details input field to add Bank & Branch details through Admin.
2. Rules and form Data Validation through app\controllers\Bank.php\  public function add_bank
3. DB SQL Post happens through 			  app\models\Agent_model.php\public function add_bank






< ? php foreach($data->result() as $commissions); ?>-->

<?php
foreach ($Dashbord->result() as $profile);
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
                                        <!-- < ?php echo $commissions->remarks.' '. $commissions->remarks; ?>-->
										
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
										<tr>
                                                 <td>Cons No</td> 
												<td><?php echo $profile->cons_no; ?></td>
                                            </tr>
                                            <tr>
                                                 <th width="20%">Current Pinecode</th>
												 <td><?php echo $profile->current_pincode; ?></td> 
														                                                
                                            </tr>
                                            <tr>
                                                <td>Receiver Pinecode</td>
                                                <td><?php echo $profile->receiver_pincode; ?></td> 
											  
                                            </tr>	
											<tr>
                                                <td>Current Location</td>
                                                <td><?php echo $profile->current_location; ?></td> 
                                            </tr>   
											
                                             <tr>
                                                 <td>Receiver Location</td>
												<td><?php echo $profile->receiver_location; ?></td>	
													
												
														                                                
                                            </tr>										
											<tr>
                                                <td>Status</td>
                                                <td><?php echo $profile->status; ?></td> 
                                            </tr>
											
											<tr>
                                                <td> Modified At</td>
                                                <td><?php echo date('d/m/Y h:i A',$profile->modified_at); ?></td>
                                            </tr>
                                           
											<tr>
                                                <td>Comments</td>
                                                <td><?php echo $profile->comments; ?></td> 
                                            </tr>											
                                            
											
									<tr>
										<td>Done By</td>
										<td>
											<?php 
											$query1 = $this->db->get_where('users', ['id' => $profile->done_by]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->first_name.' '.$row->last_name;
												}
											} else 
											{
												 echo  "";
											}
											?>
										</td>
									</tr>											
																	
										
														               
                                        </table>
								

                                    <div class="box-footer">
									
	
		<a href="<?php echo base_url('Courier_report_detials/report_pending_courier_list' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>	
	
	  
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
