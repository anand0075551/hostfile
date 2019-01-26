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
                                                 <td>First Name</td> 
												<td><?php echo $profile->first_name; ?></td>
                                            </tr>
                                            <tr>
                                                 <th width="20%">Last Name</th>
												 <td><?php echo $profile->last_name; ?></td> 
														                                                
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $profile->email; ?></td> 
											  
                                            </tr>	
											<tr>
                                                <td>Contact No</td>
                                                <td><?php echo $profile->contactno; ?></td> 
                                            </tr>   
											
                                             <tr>
                                                 <td>Transaction ID</td>
												<td><?php echo $profile->tranx_id; ?></td>				                                                
                                            </tr>										
											<tr>
                                                <td>Transaction Type</td>
                                                <td><?php echo $profile->transaction_type; ?></td> 
                                            </tr>
                                           	<tr>
                                                <td>IFSC Code</td>
                                                <td><?php echo $profile->ifsc_code; ?></td> 
                                            </tr>
											<tr>
                                                <td>Transaction Date</td>
                                                <td><?php echo $profile->transaction_date; ?></td> 
                                            </tr>											
                                            
                                            <tr>
                                                 <td>Postal Code</td> 
												<td><?php echo $profile->postal_code; ?></td>
                                            </tr>									
											 <tr>
                                                 <td>Aadhaar No.</td> 
												<td><?php echo $profile->adhaar_no; ?></td>
                                            </tr>	
											 <tr>
                                                 <td>Passport No.</td> 
												<td><?php echo $profile->passport_no; ?> </td>
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
                                                 <td>Active</td> 
												<td><?php echo $profile->active; ?> </td>
                                            </tr>
											 <tr>
                                                 <td>Referral Code</td> 
												<td><?php echo $profile->referral_code; ?> </td>
                                            </tr>
											 <tr>
                                                 <td>Account no.</td> 
												<td><?php echo $profile->account_no; ?> </td>
                                            </tr>
											 
											 <tr>
                                                 <td>Amount</td> 
												<td><?php echo $profile->amount; ?></td>
                                            </tr>
											 <tr>
                                                 <td>Referredby Code</td> 
												<td><?php echo $profile->referredByCode; ?> </td>
                                            </tr>
											 <tr>
                                                 <td>Challan</td> 
												<td><?php echo $profile->challan; ?> </td>
                                            </tr>
											 <tr>
                                                 <td>Company Name</td> 
												<td><?php echo $profile->company_name; ?> </td>
                                            </tr>
											 <tr>
                                                 <td>Bank Name</td> 
												<td><?php echo $profile->bank_name; ?> </td>
                                            </tr>
											<tr>
                                                 <td>Bank Account Type</td> 
												<td><?php echo $profile->bank_acc_type; ?> </td>
                                            </tr>
											<tr>
                                                 <td>Bank Account</td> 
												<td><?php echo $profile->bank_account; ?> </td>
                                            </tr>
											<tr>
                                                 <td>Bank Address</td> 
												<td><?php echo $profile->bank_address; ?> </td>
                                            </tr>
											<tr>
                                                 <td>Pan No.</td> 
												<td><?php echo $profile->pan_no; ?> </td>
                                            </tr>
											<tr>
                                                 <td>Bank ISFCode</td> 
												<td><?php echo $profile->bank_ifscode; ?> </td>
                                            </tr>
											
											<tr>
                                                <td>Created_by</td>
                                               <td><?php $query3 = $this->db->get_where('users', ['id' => $profile->created_by]);
											
											if ($query3->num_rows() > 0) 
											{
												foreach ($query3->result() as $row) 
												{
													echo  $row->first_name.' '.$row->last_name;
												}
											}  ?>
											 </td>
                                            </tr>	
											<tr>
                                                <td>Created_at</td>
                                                <td><?php echo date('d/m/Y h:i A',$profile->created_at); ?></td>
                                            </tr>
											<tr>
                                                <td>Modified at</td>
                                                <td><?php echo date('d/m/Y h:i A',$profile->modified_at); ?></td>
                                            </tr>											
                                           
														               
                                        </table>
								

                                    <div class="box-footer">
	
		<a href="<?php echo base_url('Bank/report_bank' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>		
	
	  
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
