<!---
1. Below fields are Bank details input field to add Bank & Branch details through Admin.
2. Rules and form Data Validation through app\controllers\Bank.php\  public function add_bank
3. DB SQL Post happens through 			  app\models\Agent_model.php\public function add_bank






-->
<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>


<?php foreach($profile_Details->result() as $profile); ?>
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
                                        <?php echo $profile->first_name.' '. $profile->last_name; ?>
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
                                            <tr>
                                                <th width="20%">Full Name</th>
                                                <th><?php echo $profile->first_name.'  '.$profile->last_name;; ?></th> 
                                            </tr>
																						
											<tr>
                                               <th>User Type/Role Name</th>
                                                <th><?php 	if($profile->rolename != '')
												{  $roleName = typeDbTableRow($profile->rolename)->rolename;
												}else{
													$roleName = 'User type/Role name not yet assigned';
												}
												echo $roleName ;?></th>
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
												<td>PAN No.</td>
                                                <td><?php echo $profile->pan_no; ?></td>
                                            </tr>
                                           
											<tr>
                                                <th> <font size="3" color="red">Account No.</th>
                                                <th><font size="3" color="red"><?php echo $profile->account_no; ?></th>
                                            </tr>
											 <tr>
												<th width="20%"> <font size="3" color="red">Approval Amount</th>
                                                <th width="20%"> <font size="3" color="red"> <?php echo amountFormat ($profile->amount); ?></th>
                                            </tr>
											<tr>
												<th width="20%"> <font size="3" color="red">Services Charges</th>
                                                <th width="20%"> <font size="3" color="red"> <?php echo amountFormat ($profile->charges); ?></th>
                                            </tr>
                                            <tr>
                                                <td>Bank IFSC Code</td>
                                                <td><?php echo ($profile->bank_ifscode); ?></td>
                                            </tr>
                                           
											<tr>
                                                <td>Bank Account Type</td>
                                                <td><?php if ($profile->bank_acc_type == '02')
																echo 'Current Account';
															else{
																echo 'Savings Account';
															}?></td>
                                            </tr>
                                            <tr> 
                                                <td>Bank Name</td>
                                                <td><?php echo $profile->bank_name; ?></td>
                                            </tr>
											<tr>
                                                <td>Bank Account No</td>
                                                <td><?php echo $profile->bank_account; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Bank Branch & Address</td>
                                                <td><?php echo $profile->bank_address; ?></td>
                                            </tr>
                                            
                                            
											  <tr>
                                                <td>Adhaar No</td>
                                                <th><?php echo $profile->adhaar_no; ?></th>
                                            </tr>
                                          <tr>											
                                                <td>Status</td>
                                                <td><?php echo $profile->active; ?></td>
                                            </tr>
											<tr>											
                                                <td>Reciept Number/Transaction ID</td>
                                                <td><?php echo $profile->tranx_id; ?></td>
                                            </tr>
											<tr>											
                                                <td>Requested on </td>
                                                <td><?php echo date('d/m/Y h:i A', $profile->created_at); ?></td>
                                            </tr>
											<tr>											
                                                <td>Approved on </td>
                                                <td><?php echo date('d/m/Y h:i A', $profile->modified_at); ?></td>
                                            </tr>
																				
										<tr>
                                                <td>Challan/Transaction Reciept</td> 
												<th> <img src="<?php echo ledger_photo_url($profile->challan); ?>"  height='400' width='600'/>	</th>												
										 </tr>  
										<tr>											
                                                <td>File Name:</td>
                                                <td><?php echo $profile->challan; ?></td>
                                            </tr>	
											
											
                                       </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									<?php if ($profile->active != 'Approved') { ?> 
                                        <a href="<?php echo base_url('bank/bank_edit/'.$profile->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                     	<a href="<?php echo base_url('account/addbank_balance/'.$profile->id) ?>" class="label label-success"><i class="fa fa-money"></i> Proceed for Transaction</a>										
									<?php }?>
								   </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
