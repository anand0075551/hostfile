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
											<td>Identity</td>
											<td><?php echo $profile->identity; ?></td>
										</tr>
										<tr>
											<td>Identity ID</td>
											<td><?php echo $profile->identity_id; ?></td>
										</tr>
										<tr>
											<td>Type</td>
											<td><?php echo $profile->type; ?></td>
										</tr>
										<tr>
											<td>Remarks</td>
											<td><?php echo $profile->remarks; ?></td>
										</tr>
								
										<tr>
											<td>Start Date</td>
											<td><?php echo $profile->start_date; ?></td>
										</tr>
										<tr>
											<td>End Date</td> 
												<td><?php echo $profile->end_date; ?></td>								
										</tr>
								
										<tr>
											<td>Account ID</td>
											<td><?php echo $profile->acct_id; ?></td>
										</tr>
										<tr>
											<td>Sub Account ID</td>  
												<td> <?php $query8 = $this->db->get_where('acct_categories', ['id' => $profile->sub_acct_id,]);
											
											if ($query8->num_rows() > 0) 
											{
												foreach ($query8->result() as $row) 
												{
													echo  $row->name;
												}
											} 
											else
												{
												 echo  "";
												}
												 ?></td>
										</tr>
										<tr>
												<td>Deducted Paytype</td>
												<td><?php echo $profile->ded_paytype; ?></td>
										</tr>
										<tr>
											<td>Amount</td> 
											<td><?php echo $profile->amount; ?></td>									
												</tr>
										<tr>
											<td>Loyality Amount</td>
											<td><?php echo $profile->loy_amt; ?></td>
										</tr>
										<tr>
											<td>Discount Amount</td> 
											<td><?php echo $profile->dis_amt; ?></td>								
										</tr>
								
										<tr>
											<td>From Role</td>
											<td><?php $query6 = $this->db->get_where('role', ['id' => $profile->from_role,]);
											
											if ($query6->num_rows() > 0) 
											{
												foreach ($query6->result() as $row) 
												{
													echo  $row->rolename;
												}
											} 
											else
												{
												 echo  "";
												}
												 ?></td>
										</tr>
											<tr>
												<td>To Role</td> 
												<td><?php $query4 = $this->db->get_where('role', ['id' => $profile->to_role,]);
											
											if ($query4->num_rows() > 0) 
											{
												foreach ($query4->result() as $row) 
												{
													echo  $row->rolename;
												}
											} 
											else
												{
												 echo  "";
												}
												 ?></td>
											</tr>
										<tr>
											<td>Comission</td>
											<td><?php echo $profile->commission; ?></td>
										</tr>
										<tr>
										<td>Benefits</td> 
										<td><?php echo $profile->benefits; ?></td>								
										</tr>
										<tr>
												<td>slr_ref_pm</td>
											<td><?php echo $profile->slr_ref_pm; ?></td>
										</tr>
										<tr>
												<td>slr_ref_level1</td>
												<td><?php echo $profile->slr_ref_level1; ?></td>									
										</tr>
											<tr>
													<td>slr_ref_level2</td>
													<td><?php echo $profile->slr_ref_level2; ?></td>
												</tr>
											<tr>
													<td>slr_ref_level3</td>  
													<td><?php echo $profile->slr_ref_level3; ?></td>								
												</tr>
										<tr>
											<td>slr_ref_level4</td>
											<td><?php echo $profile->slr_ref_level4; ?></td>
										</tr>
										<tr>
											<td>slr_ref_level5</td>
											<td><?php echo $profile->slr_ref_level5; ?></td>									
										</tr>
										<tr>
								
										<td>clt_ref_pm</td>	
										<td><?php echo $profile->clt_ref_pm; ?></td>
							
										</tr>
										<tr>
											<td>clt_ref_level1</td>   
											<td><?php echo $profile->clt_ref_level1; ?></td>
										</tr>
										<tr>
										<td>clt_ref_level2</td>
										<td><?php echo $profile->clt_ref_level2; ?></td>
									</tr>
										<tr>
										<td>clt_ref_level3</td> 
										<td><?php echo $profile->clt_ref_level3; ?></td>								
										</tr>
										<tr>
											<td>clt_ref_level4</td>
										<td><?php echo $profile->clt_ref_level4; ?></td>
										</tr>
								<tr>
									<td>clt_ref_level5</td>   
									<td><?php echo $profile->clt_ref_level5; ?></td>
								</tr>
								<tr>
									<td>points_mode</td>
									<td><?php echo $profile->points_mode; ?></td>
								</tr>
								<tr>
									<td>profit_pm</td> 
									<td><?php echo $profile->profit_pm; ?></td>
								</tr>
								<tr>
									<td>sender_profit</td>
									<td><?php echo $profile->sender_profit; ?></td>
								</tr>
								<tr>
									<td>receiver_profit</td> 
									<td><?php echo $profile->receiver_profit; ?></td>								
								</tr>
								<tr>
									<td>deduction_pm</td>
									<td><?php echo $profile->deduction_pm; ?></td>
								</tr>
								<tr>
										<td>sender_deduction</td> 
										<td><?php echo $profile->sender_deduction; ?></td>								
								</tr>
								<tr>
									<td>receiver_deduction</td>
									<td><?php echo $profile->receiver_deduction; ?></td>
								</tr>
								<tr>
									<td>transferrable</td>  
									<td><?php echo $profile->transferrable; ?></td>								
								</tr>
								<tr>
									<td>period</td>
									<td><?php echo $profile->period; ?></td>
								</tr>
								<tr>
									<td>tenure</td> 
									<td><?php echo $profile->tenure; ?></td>
								</tr>
								<tr>
								<td>Modified by</td>
								<td><?php $query3 = $this->db->get_where('users', ['id' => $profile->modified_by]);
											
											if ($query3->num_rows() > 0) 
											{
												foreach ($query3->result() as $row) 
												{
													echo  $row->first_name.' '.$row->last_name;
												}
											}  ?></td>
								</tr>
								<tr>
								<td>Modified at</td>
								<td><?php echo date('d/m/Y h:i A',$profile->modified_at);?></td>
								</tr>
								<tr>
								<td>Created at</td>
								<td><?php echo date('d/m/Y h:i A',$profile->created_at);?></td>
								</tr>
								<tr>
								<td>Created by</td>
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
									<td>visible</td>
									<td><?php echo $profile->visible; ?></td>
								
								</tr>
														               
                                 </table>
								

                                    <div class="box-footer">
	
		<a href="<?php echo base_url('Ledgcomrpt/view_comissions_report' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>		
	
	  
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
