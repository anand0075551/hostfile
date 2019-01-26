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
                                      
										
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
                                            <tr>
                                                <th width="20%">User Type</th>
                                                <th><?php echo $authorizations->id; ?></th> 
                                            </tr>
                                            <tr>
                                                <td>Private Voucher ID</td>
                                                <td><?php echo $authorizations->identity_id; ?></td> 
                                            </tr>	
											                                           
                                            
											<tr>
                                                <td>Created BY</td>
												<?php $fname = singleDbTableRow($authorizations->created_by)->first_name;	
													$lname = singleDbTableRow($authorizations->created_by)->last_name;
												?>
													<td><?php  echo $fname.' '.$lname; ?></td>	                                                
                                            </tr>								
											<tr>
                                                <td>Generated On</td> 	
                                                <td><?php echo date('d/m/Y h:i A',$authorizations->created_at); ?></td>
                                            </tr>										
											<tr>
                                                <td>Last modified ON</td>
                                                <td><?php echo date('d/m/Y h:i A',$authorizations->modified_at); ?></td>
                                            </tr>										
                                            <tr>     
                                            </tr>
											<tr>
                                                <td>Last modified BY</td>
												<?php $fname = singleDbTableRow($authorizations->modified_by)->first_name;	
													$lname = singleDbTableRow($authorizations->modified_by)->last_name;
												?>
													<td><?php  echo $fname.' '.$lname; ?></td>												
                                            </tr>				               
                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
	    <a href="<?php echo base_url('roles/edit_authorizations/'.$authorizations->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
		<a href="<?php echo base_url('roles/' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>		
	
	  
                                          </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
