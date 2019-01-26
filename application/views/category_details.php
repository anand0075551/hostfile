<?php 
	
	foreach($details_category->result() as $category); 
	
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
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
											<tr>
                                                <td>Category Name</td>
                                                <td><?php echo $category->category_name; ?></td>
                                            </tr>
											<tr>
                                                <td>Banner</td>
                                                <td><img src ="<?php echo profile_photo_url($category->banner); ?>" width="45" height="50" ></td>
                                            </tr>
											<tr>
                                                <td>Created By</td>
                                                <td><?php  
														$created_by = $category->created_by;
														$query = $this->db->get_where('users', ['id'=>$created_by]);	
														foreach($query->result() as $d)
														{
															echo $d->first_name.' '.$d->last_name;
														}
												
													?>
												</td>
                                            </tr>
											<tr>
                                                <td>Created At</td>
                                                 <td><?php echo date('d-M, Y', $category->created_at)." (".date('h:m A', $category->created_at).")"; ?></td>
                                            </tr>
											<tr>
                                                <td>Modified By</td>
                                                <td><?php  
														$created_by = $category->modified_by;
														$query = $this->db->get_where('users', ['id'=>$created_by]);	
														foreach($query->result() as $d)
														{
															echo $d->first_name.' '.$d->last_name;
														}
												
													?>
												</td>
                                            </tr>
											<tr>
                                                <td>Modified At</td>
												<td><?php
													if($category->modified_at != 0){
														echo date('d-M, Y', $category->modified_at)." (".date('h:m A', $category->modified_at).")"; 
													}
													else{
														echo "Not Modified Yet.";
													}
												?></td>
                                            </tr>
                                        </table>

                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
										<a href="<?php echo base_url('Smb_product/physical_product_category/'.$category->id) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                            </div><!-- /.box -->
						</div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
