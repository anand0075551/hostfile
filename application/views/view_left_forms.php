<?php foreach($menu->result() as $left); ?>


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
                                       Left Forms Details
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
											

											
											<tr>
                                                <th width="20%">Business Group</th>
                                                <th><?php

											//	echo $left->bg_id;
												 $query = $this->db->get_where('menu_business_groups', ['id' => $left->bg_id]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo   $row->business_name;
									}
								} else {
                                    echo "Business Name Doesnot Exist";
                                }



												?></th>
                                            </tr><tr>
                                                <th width="20%">Category Name</th>
                                                <th><?php
												
												//echo $left->category_name;
												 $query = $this->db->get_where('menu_business_groups', ['id' => $left->category_name]);
								
								if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        echo   $row->business_name;
									}
								} else {
                                    echo "Category Doesnot Exist";
                                }
												?></th>
                                   <!--         </tr><tr>
                                                <th width="20%">Sub Category</th>
                                                <th>< ?php echo $left->sub_category; ?></th>
                                            </tr>
									-->		
																							<tr>
                                                <th width="20%">Font Awesome</th>
                                                <th><?php echo $left->font; ?></th>
                                            </tr>
											
											<tr>
                                                <th width="20%">Controller</th>
                                                <th><?php echo $left->controller; ?></th>
                                            </tr><tr>
                                                <th width="20%">PHP File Name</th>
                                                <th><?php echo $left->phpfile_name; ?></th>
                                            </tr><tr>
                                                <th width="20%">Display Form Name</th>
                                                <th><?php echo $left->displayform_name; ?></th>
                                            </tr>
											
			
											
						
											
											
											
											
											
											

											
											<tr>
                                                <td>Created By</td>
                                                <td><?php echo  singleDbTableRow($left->created_by)->first_name." ".singleDbTableRow($left->created_by)->last_name; ?></td>
                                            </tr>
											<tr>
                                                <td>Created At</td>
                                                <td><?php echo date("Y-m-d h:i:sa", $left->created_at);?></td>
                                             </tr>       
                                               <tr>
                                                <td>Modified By</td>
                                                <td><?php if($left->modified_by == '0')
												{ echo $name = 'New Entry'; }
											else{
												echo $users = singleDbTableRow($left->modified_by)->first_name;
											}?></td>
                                            </tr>   
											<tr>
                                                <td>Modified At</td>
                                                <td><?php if($left->modified_at == '0')
												{ echo $name = 'No Modified time'; }
											else{
												echo  date("Y-m-d h:i:s a",$left->modified_at);;
											}?></td>
                                             </tr>    
										
											

                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('menu/edit_business_form/'.$left->bgform_id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
										<a href="<?php echo base_url('menu/all_business_forms') ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Back</a>
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
