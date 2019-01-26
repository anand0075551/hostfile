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
                                                 <td>Status</td> 
												<td><?php echo $profile->status; ?></td>
                                            </tr>
                                            <tr>
                                                 <th width="20%">Recharge/Account No</th>
												 <td><?php echo $profile->usertxn; ?></td> 
														                                                
                                            </tr>
                                            <tr>
                                                <td>Operator Name</td>
                                                <td><?php $query1 = $this->db->get_where('services', ['jolo_code' => $profile->operator,]);
								
								if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row) {
                                        echo  $row->opt_name;
									}
								} else {
                                     echo  "no data";
                                }		?></td> 
											  
                                            </tr>	
											<tr>
                                                <td>Amount</td>
                                                <td><?php echo $profile->amount; ?></td> 
                                            </tr>   
											
                                             <tr>
                                                 <td>Unique Transaction Id</td>
												<td><?php echo $profile->txid; ?></td>	
													
												
														                                                
                                            </tr>										
											<tr>
                                                <td>Operator Reference ID</td>
                                                <td><?php echo $profile->operator_ref; ?></td> 
                                            </tr>
                                           	<tr>
                                                <td>Country</td>
                                                <td><?php echo $profile->country; ?></td> 
                                            </tr>
											<tr>
                                                <td>Number</td>
                                                <td><?php echo $profile->number; ?></td> 
                                            </tr>											
                                            
                                            <tr>
                                                 <td>Amount_deducted</td> 
												<td><?php echo $profile->amount_deducted; ?></td>
                                            </tr>									
											 <tr>
                                                 <td>Message</td> 
												<td><?php echo $profile->message; ?></td>
                                            </tr>	
											 <tr>
                                                 <td>Time</td> 
												<td><?php echo date(' H:i:s A',$profile->time);?> </td>
                                            </tr>							
											<tr>
                                                <td>User ID</td> 	
                                                <td><?php 
											$query1 = $this->db->get_where('users', ['id' => $profile->user_id,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->first_name.' '.$row->last_name;
												}
											} 
											else
												{
												 echo  "";
												}
										?></td>
                                            </tr>										
											<tr>
                                                <td>Created_at</td>
                                                <td><?php echo date('d/m/Y h:i A',$profile->created_at); ?></td>
                                            </tr>										
                                           <tr>
                                                <td>Error_code</td>
												<td><?php //	echo $profile->error_code; 
												$query1 = $this->db->get_where('error_table', ['id' => $profile->error_code,]);
								
								if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row) {
                                        echo  $row->details;
									}
								} else {
                                     echo  "no data";
                                }		 ?></td>
																								
										    </tr> 
														               
                                        </table>
								

                                    <div class="box-footer">
	
		<a href="<?php echo base_url('Billpayment_Status/report_billpayment_status' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>		
	
	  
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
