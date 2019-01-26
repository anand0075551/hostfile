<!---
1. Below fields are Bank details input field to add Bank & Branch details through Admin.
2. Rules and form Data Validation through app\controllers\Bank.php\  public function add_bank
3. DB SQL Post happens through 			  app\models\Agent_model.php\public function add_bank


status
txid
usertxn
operator_ref
operator
country
number
amount
amount_deducted
message
time
user_id
created_at
error_code



< ? php foreach($data->result() as $commissions); ?>-->
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
                                                <th width="20%">Recharge Status</th>
												<th><?php 
												if ( $billpay->error_code == 0)
												{ 
													echo $billpay->status ; 
												}else{
														echo $billpay->status.' : Details  ->     '.$name = billpayDbTableRow('11')->details;
												}
												 ?></th>
                                             
                                            </tr>
											
                                            <tr>
                                                <td>Recharge Transaction ID</td>
                                                <td><?php echo $billpay->txid; ?></td> 
                                            </tr>	
											<tr>
                                                <td>Recharged On</th>
                                                  <td><?php echo date('d/m/Y h:i A',$billpay->created_at); ?></td> 
                                            </tr>	
										
											 
                                            <tr>
                                                <td>Operator Reference ID</td>
                                                <td><?php echo $billpay->operator_ref; ?></td> 
                                            </tr>	
											     <tr>
                                                <th width="20%">Paid to Operator Name</th>
                                                <th><?php
														$table_name = "services";
														$where_array = array('jolo_code' =>$billpay->operator);
														$query = $this->db->where($where_array )->get($table_name); 
													foreach($query->result() as $r)
													{
														echo $billpay->operator.': '.$r->opt_name;
													}
												 ?></th> 
                                            </tr>
                                            <tr>
                                                <td>Country ID</td>
                                                <td><?php echo $billpay->country; ?></td> 
                                            </tr>	
											     <tr>
                                                <td width="20%">Recharge Account Number</td>
                                                <td><?php echo $billpay->number; ?></td> 
                                            </tr>
                                            <tr>

                                                <td>Recharge Amount</td>
                                                <td><?php echo $billpay->amount; ?></td> 
                                            </tr>	
											<!--     <tr>
                                                <th width="20%">Recharge Amount Deducted</th>
                                                <th><?php echo $billpay->amount_deducted; ?></th> 
                                            </tr> -->
                                            <tr>
                                                <td>Recharge Message</td>
                                                <td><?php echo $billpay->message; ?></td> 
                                            </tr>	
											     <tr>
                                                <td width="20%">Recharged On Time</td>
                                                <td><?php echo date('d/m/Y h:i A',$billpay->time); ?></td> 
                                            </tr>
                                            <tr>
                                                <td>Recharged By</td>
                                                <td><?php $fname = singleDbTableRow($billpay->user_id)->first_name; 
												 $lname = singleDbTableRow($billpay->user_id)->last_name; 
												  $ref_id = singleDbTableRow($billpay->user_id)->referral_code; 
												  $mobile = singleDbTableRow($billpay->user_id)->contactno; 
												
												echo $fname. ' '.$lname.'(ID - : '.$ref_id.', and Mobile - : '.$mobile.')'?></td> 
                                            </tr>	
											   <tr>
                                                <td width="20%">User Transaction ID</td>
                                                <td><?php echo $billpay->usertxn; ?></td> 
                                            </tr>   
                                             
																				
																				
                                            
                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
	<!--	<a href="<?php echo base_url('vouchers/edit/'.$vouchers->id) ?>" 			  class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a> 
		<a href="<?php echo base_url('vouchers/check_pin_status' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>		
	
	  -->
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
