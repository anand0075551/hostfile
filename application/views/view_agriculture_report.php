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
                                                 <td>Id activity</td> 
												<td><?php echo $profile->id_activity; ?></td>
                                            </tr>
                                            <tr>
                                                 <th width="20%">Crop</th>
												 <td><?php echo $profile->crop; ?></td> 
														                                                
                                            </tr>
                                            <tr>
                                                <td>Activity type</td>
                                                <td><?php echo $profile->activity_type; ?></td> 
											  
                                            </tr>	
											<tr>
                                                <td>Activity</td>
                                                <td><?php echo $profile->activity; ?></td> 
                                            </tr>   
											
                                             <tr>
                                                 <td>Begin Date</td>
												<td><?php echo $profile->begin_date; ?></td>				                                                
                                            </tr>										
											<tr>
                                                <td>End Date</td>
                                                <td><?php echo $profile->end_date; ?></td> 
                                            </tr>
                                           	<tr>
                                                <td>Expected hours</td>
                                                <td><?php echo $profile->expected_hours; ?></td> 
                                            </tr>
											<tr>
                                                <td>per person time</td>
                                                <td><?php echo $profile->per_person_time; ?></td> 
                                            </tr>											
                                            
                                            <tr>
                                                 <td>Labour Role</td> 
												<td><?php echo $profile->labour_role; ?></td>
                                            </tr>									
											 <tr>
                                                 <td>Labour User</td> 
												<td><?php echo $profile->labour_user; ?></td>
                                            </tr>	
											 <tr>
                                                 <td>Person No.</td> 
												<td><?php echo $profile->person_no; ?> </td>
                                            </tr>							
											<tr>
                                                <td>Price per Person</td> 	
												<td><?php echo $profile->price_per_person; ?> </td>
                                                
                                            </tr>
											<tr>
                                                 <td>Calculated Price</td> 
												<td><?php echo $profile->calculated_price; ?> </td>
                                            </tr>
											 <tr>
                                                 <td>Expected Price</td> 
												<td><?php echo $profile->expected_price; ?> </td>
                                            </tr>
											 <tr>
                                                 <td>Difference</td> 
												<td><?php echo $profile->difference; ?> </td>
                                            </tr>
											 <tr>
                                                <td>Created_at</td>
                                                <td><?php echo date('d/m/Y h:i A',$profile->created_at); ?></td>
                                            </tr>
											
											<tr>
                                                <td>Created_by</td>
                                               <td><?php $query1 = $this->db->get_where('users', ['id' => $profile->created_by]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->first_name.' '.$row->last_name;
												}
											}  ?></td>
                                            </tr>
											<tr>
                                                <td>Modified by</td>
                                               <td><?php $query2 = $this->db->get_where('users', ['id' => $profile->modified_by]);
											
											if ($query2->num_rows() > 0) 
											{
												foreach ($query2->result() as $row) 
												{
													echo  $row->first_name.' '.$row->last_name;
												}
											}  ?></td>
                                            </tr>
											
											<tr>
                                                <td>Modified at</td>
                                                <td><?php echo date('d/m/Y h:i A',$profile->modified_at); ?></td>
                                            </tr>											
                                           
														               
                                        </table>
								

                                    <div class="box-footer">
	
		<a href="<?php echo base_url('Agriculture/view_report_agriculture' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>		
	
	  
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
