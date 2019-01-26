<!---
1. Below fields are Bank details input field to add Bank & Branch details through Admin.
2. Rules and form Data Validation through app\controllers\Bank.php\  public function add_bank
3. DB SQL Post happens through 			  app\models\Agent_model.php\public function add_bank







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
                                                <th width="20%">Recharge Type</th>
                                                <th><?php echo $recharge->recharge_type; ?></th> 
                                            </tr>
                                            <tr>
                                                <td>Recharge/Pay Account Number</td>
                                                <td><?php echo $recharge->recharge_no; ?></td> 
                                            </tr>	
											<tr>
                                                <td>Transaction Date</td> 	
                                                <td><?php echo date('d/m/Y h:i A',$recharge->created_at); ?></td>
                                            </tr>
											 <tr>
                                                <td>Deducted Amount </td>
                                                <td><?php echo $recharge->amount; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Amount deducted from Account No</td>
                                                <td><?php echo $recharge->account_no; ?></td> 
                                            </tr>											
                                           
                                            
											<tr>
                                                <td>Transaction By</td>
												<?php $fname = singleDbTableRow($recharge->created_by)->first_name;	
													$lname = singleDbTableRow($recharge->created_by)->last_name;
												?> 
											
													<td><?php  echo $fname.' '.$lname; ?></td>	                                                
                                            </tr>								
																					
											
															               
                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
	<!--	<a href="<?php echo base_url('vouchers/edit/'.$vouchers->id) ?>" 			  class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a> -->
		<a href="<?php echo base_url('account/services_transaction' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>		
	
	  
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
