<!---
1. Below fields are Bank details input field to add Bank & Branch details through Admin.
2. Rules and form Data Validation through app\controllers\Bank.php\  public function add_bank
3. DB SQL Post happens through 			  app\models\Agent_model.php\public function add_bank






-->
<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>


<?php foreach($defect_Details->result() as $defect); ?>
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
                                       <?php echo "Invoice ID : ".$defect->invoice_id ?>
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
                                            <tr>
                                                <th width="20%">Invoice ID</th>
                                                <th><?php echo $defect->invoice_id ?></th> 
                                            </tr>
											<tr>
                                                <td>Invoice Value</td>
                                                <td><?php echo $defect->invoice_value; ?></td>
                                            </tr>
											<tr>
                                                <td>Product Category</td>
                                                <td><?php echo $defect->category; ?></td>
                                            </tr>
                                         
                                            <tr>
												<td>Sub Category</td>
                                                <td><?php echo $defect->sub_category; ?></td>
                                            </tr>
											<tr>
												<td>Return Product Value</td>
                                                <td><?php echo $defect->return_product_value; ?></td>
                                            </tr>
											<tr>
												<td>Defect Reason</td>
                                                <td><?php echo $defect->defect_reason; ?></td>
                                            </tr>
											<tr>
												<td>Vendor ID</td>
                                                <td><?php echo $defect->vendor_id; ?></td>
                                            </tr>
											<tr>
												<td>Comments</td>
                                                <td><?php echo $defect->comments; ?></td>
                                            </tr>
											
                                       </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
								   </div>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
