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
                                                 <td>User ID</td> 
												<td><?php 
											$query3 = $this->db->get_where('users', ['id' => $profile->user_id,]);
											
											if ($query3->num_rows() > 0) 
											{
												foreach ($query3->result() as $row) 
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
                                                 <td>Email</td>
												 <td><?php echo $profile->email; ?></td> 
														                                                
                                            </tr>
                                            <tr>
                                                <td>Pay type</td>
                                                <td> <?php $query8 = $this->db->get_where('acct_categories', ['id' => $profile->pay_type,]);
											
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
                                                <td>Account No</td>
                                                <td><?php echo $profile->account_no; ?></td> 
                                            </tr>   
											
                                             <tr>
                                                 <td>Rolename</td>
												<td> <?php $query1 = $this->db->get_where('role', ['id' => $profile->rolename,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
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
                                                <td>Debit</td>
                                                <td><?php echo $profile->debit; ?></td> 
                                            </tr>
                                           	<tr>
                                                <td>Credit</td>
                                                <td><?php echo $profile->credit; ?></td> 
                                            </tr>
											<tr>
                                                <td>Amount</td>
                                                <td><?php echo $profile->amount; ?></td> 
                                            </tr>											
                                            
                                            <tr>
                                                 <td>Points Mode</td> 
												<td><?php echo $profile->points_mode; ?></td>
                                            </tr>									
											 <tr>
                                                 <td>Capital</td> 
												<td><?php echo $profile->capital; ?></td>
                                            </tr>	
											 <tr>
											   <td>Count</td> 
												<td><?php echo $profile->count; ?></td>
                                                
                                            </tr>							
											<tr>
                                                <td>Cash</td> 	
                                                <td><?php echo $profile->cash; ?></td>
                                            </tr>

												<tr>
                                                <td>Invoice ID</td> 	
                                                <td><?php echo $profile->invoice_id; ?></td>
                                            </tr>
											<tr>
                                                <td>Remarks</td> 	
                                                <td><?php echo $profile->remarks; ?></td>
                                            </tr>
											<tr>
                                                <td>Transaction</td> 	
                                                <td><?php echo $profile->transaction; ?></td>
                                            </tr>
											
											<tr>
                                                <td>Start date</td> 	
                                                <td><?php echo $profile->start_date; ?></td>
                                            </tr>
											<tr>
                                                <td>Created at</td>
                                                <td><?php echo date('d/m/Y h:i A',$profile->created_at); ?></td>
                                            </tr>
											<tr>
                                                <td> Modified at</td>
                                                <td><?php echo date('d/m/Y h:i A',$profile->modified_at); ?></td>
                                            </tr>

											<tr>
                                                <td>Modified By</td>
                                                <td><?php $query2 = $this->db->get_where('users', ['id' => $profile->modified_by]);
											
											if ($query2->num_rows() > 0) 
											{
												foreach ($query2->result() as $row) 
												{
													echo  $row->first_name.' '.$row->last_name;
												}
											} 
											 ?></td>
                                            </tr>
                                            
														               
                                        </table>
								

                                    <div class="box-footer">
	
		<a href="<?php echo base_url('Ledgcomrpt/view_ledger_report' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>		
	
	  
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
