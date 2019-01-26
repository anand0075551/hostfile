<?php foreach($area_Details->result() as $area); ?>


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
                                       Area Details
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
											
											<tr>
                                                <td width="30%">Area Location</td>
                                                <td><?php  $area->location; 
												 
												$table_name = 'area';
												$where_array = array('location' => $area->location);
												$query1 = $this->db->where($where_array)->get($table_name);
												if ($query1->num_rows() > 0)
												{	foreach($query1->result() as $row1)
														{
															$locid_id = $row1->location;
															
															$table_name = 'location_id';
															$where_array = array('id' => $locid_id);
															$query2 = $this->db->where($where_array)->get($table_name);
															foreach($query2->result() as $row2)
															{
																$locid_name = $row2->location;
															}
														}
														
															echo $locid_name; 
												}
												else{
													echo "Area Doesnot Exist";
												 }
														?></td>
                                            </tr>
											
			
											
					<tr>
                            <td>Business Name</td>
                            <td><?php $query1 = $this->db->get_where('business_groups', ['id' => $area->business_name,]);
								
								if ($query1->num_rows() > 0) {
                                    foreach ($query1->result() as $row) {
                                        echo  $row->business_name;
									}
								} else {
                                     echo  "no data";
                                }?></td>
                     
                 
                        </tr>						
											
																			<tr>
                                                <td>Type</td>
                                                <td><?php 
												if( $area->type == '1'){echo "For Sale";} else{echo"For Purchase";}
												 
												 ?></td>
                                            </tr>			
											
											
											
											
											<tr>
                                                <td>Pincode</td>
                                                <td><?php 
												
											//	echo $area->pincode; 
											
						$pincode="";
						if($area->pincode!=""){
							$pincode_name = explode("," , $area->pincode);
							foreach($pincode_name as $pincode_id){
								
									$pincode.= $pincode_id.", ";
									
								
							}
						}
						else{
							$pincode = "Pincode Doesnot Exist";
							
						}
						echo $pincode;
												// $query = $this->db->get_where('pincode', ['id' => $area->pincode]);
								
												?> </td>
                                            </tr>
											
											<tr>
                                                <td>Created By</td>
                                                <td><?php echo $users = singleDbTableRow($area->created_by)->first_name; ?></td>
                                            </tr>
											<tr>
                                                <td>Created At</td>
                                                <td><?php echo date("Y-m-d h:i:sa", $area->created_at);?></td>
                                             </tr>       
                                               <tr>
                                                <td>Modified By</td>
                                                <td><?php if($area->modified_by == '0')
												{ echo $name = 'New Entry'; }
											else{
												echo $users = singleDbTableRow($area->modified_by)->first_name;
											}?></td>
                                            </tr>   
											<tr>
                                                <td>Modified At</td>
                                                <td><?php if($area->modified_at == '0')
												{ echo $name = 'No Modified time'; }
											else{
												echo  date("Y-m-d h:i:s a",$area->modified_at);;
											}?></td>
                                             </tr>    
										
											

                                        </table>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="<?php echo base_url('location/edit_area/'.$area->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
										<a href="<?php echo base_url('location/all_area/'.$area->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Back</a>
                                      <!--  <a href="<?php echo base_url('user/log/'.$profile->id ) ?>" class="label label-warning"><i class="fa fa-bar-chart"></i> Log</a>
                                        <a href="<?php echo base_url('activity/users/'.$profile->id) ?>" class="label label-info"><i class="fa fa-check-square-o"></i> Activity</a>
                                        <a href="<?php echo base_url('account/invoice/'.$profile->id) ?>" class="label label-success"><i class="fa fa-money"></i> Earning Report</a>
                                    </div>-->
                            </div><!-- /.box -->


                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
