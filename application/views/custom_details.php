<!---
1. Below fields are Bank details input field to add Bank & Branch details through Admin.
2. Rules and form Data Validation through app\controllers\Bank.php\  public function add_bank
3. DB SQL Post happens through 			  app\models\Agent_model.php\public function add_bank






-->
<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php $ecom_db = $this->load->database('ecom', TRUE); ?>
<?php foreach($custom_Details->result() as $custom); ?>
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
                                       <?php echo "Invoice ID : ".$custom->sale_code ?>
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
                                            <tr>
                                                <th width="20%">Invoice ID</th>
                                                <th><?php echo $custom->sale_code ?></th> 
                                            </tr>
											<tr>
                                                <td>Product</td>
                                                <td>
													<?php 
														// Get product Name
														$product_id = $custom->product;
														$where_array3 = array('product_id' => $product_id );
														$table3 = "product";
														$query3 = $ecom_db->where($where_array3)->get($table3);
														foreach($query3->result() as $res3)
														{
															$product = $res3->title;
														}
														echo $product;
													?>
												</td>
                                            </tr>
											
											<tr>
												<td>Custom_1</td>
                                                <td><?php echo $custom->custom_1; ?></td>
                                            </tr>
											<tr>
												<td>Custom_2</td>
                                                <td><?php echo $custom->custom_2; ?></td>
                                            </tr>
											<tr>
												<td>Custom_3</td>
                                                <td><?php echo $custom->custom_3; ?></td>
                                            </tr>
											<tr>
												<td>Comments</td>
                                                <td><?php
												if($custom->comments!="")
												{
													echo $custom->comments;
												}
												else{
													echo "No Comments";
												}
												 ?></td>
                                            </tr>
											<tr>
												<td>Created At</td>
                                                <td><?php echo date("d M, Y", $custom->created_at); ?></td>
                                            </tr>
											<tr>
												<td>Created By</td>
                                                <td>
												<?php 
												$c_by = $custom->created_by; 
												$get_c = $this->db->get_where('users', ['id'=>$c_by]);
												foreach($get_c->result() as $c)
												{
													$role = $c->rolename;
													if($role==11 || $role==12)
													{
														echo $c->first_name." ".$c->last_name;
													}
													else
													{
														echo $c->company_name;
													}
													
												}
												?></td>
                                            </tr>
											<tr>
												<td>Modified At</td>
                                                <td>
												<?php 
													if($custom->modified_at!="0")
													{
														echo date("d M, Y", $custom->modified_at); 
													}
													else{
														echo "Not Modified.";
													}
													
												?>
												</td>
                                            </tr>
											<tr>
												<td>Modified By</td>
                                                <td>
												<?php 
												$m_by = $custom->modified_by; 
												if($m_by!="0")
												{
													$get_m = $this->db->get_where('users', ['id'=>$m_by]);
													foreach($get_m->result() as $m)
													{
														$m_role = $m->rolename;
														if($m_role==11 || $m_role==12)
														{
															echo $m->first_name." ".$m->last_name;
														}
														else
														{
															echo $m->company_name;
														}
														
													}
												}
												else{
													echo "Not Modified.";
												}
												?></td>
                                            </tr>
											
                                       </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
									
								   </div>
                            </div><!-- /.box -->
<div class="box-footer">
<a href="<?php echo base_url('custom_sales/edit_custom/'.$custom->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
	<a href="<?php echo base_url('custom_sales/custom_sales_list') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
  
</div>

                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
