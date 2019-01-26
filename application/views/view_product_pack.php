
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
                <div class="box-body table-responsive">

                    <table class="table table-striped table-hover">
					
					
					<tr><h2><b>Packed Product</h2></b></tr>
							<tr>
                           <th><b><h4>Package No</b></h4></th>
							<th><b><h4>Package Name</b></h4></th>
							<th><b><h4>Quantity (Kg)</b></h4></th>
							<th><b><h4>No of Pieces</b></h4></th>		
							<th><b><h4>Weight(Kg)</b></h4></th>	
							
							
                            
                           
                           
                            
                        </tr>
					
										<?php
										$cnt =1;
										$t_cnt = $view_packing->num_rows();
										
foreach ($view_packing->result() as $profile)
{
?>
						
					
					  
					  
						
						
					
					
						
						
					
                       
                        <?php  $cnt++; }?>
						
						<h2><?php 
											$query1 = $this->db->get_where('product_preparation', ['id' => $profile->product,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo  $row->product_name;
													}
												} else {
													 echo  "no data";
												}?></h2>
					<tr>
						<td>
							 <?php 	echo '1' ?>
							
						</td>
						<td>
							 <?php 	echo $profile->package_name_small ?>
							
						</td>
						<td>
							 <?php 	echo $profile->quantity_small ?>
							
						</td>
						<td>
							 <?php 	echo $profile->no_ofpiece_small ?>
							
						</td>
						<td>
							 <?php 	echo $profile->weight_small ?>
							
						</td>
						
						
					</tr>
					
					<tr>
						<td>
							 <?php 	echo '2' ?>
							
						</td>
						<td>
							 <?php 	echo $profile->package_name_medium ?>
							
						</td>
						<td>
							 <?php 	echo $profile->quantity_medium ?>
							
						</td>
						<td>
							 <?php 	echo $profile->no_ofpiece_medium ?>
							
						</td>
						<td>
							 <?php 	echo $profile->weight_medium ?>
							
						</td>
						
					</tr>
					
					<tr>
						<td>
							 <?php 	echo '3' ?>
							
						</td>
						<td>
							 <?php 	echo $profile->package_name_large ?>
							
						</td>
						<td>
							 <?php 	echo $profile->quantity_large ?>
							
						</td>
						<td>
							 <?php 	echo $profile->no_ofpiece_large ?>
							
						</td>
						<td>
							 <?php 	echo $profile->weight_large ?>
							
						</td>
						
					</tr>
					
					<tr>
						<td>
							 <?php 	echo '4' ?>
							
						</td>
						<td>
							 <?php 	echo $profile->package_name_family ?>
							
						</td>
						<td>
							 <?php 	echo $profile->quantity_family ?>
							
						</td>
						<td>
							 <?php 	echo $profile->no_ofpiece_family ?>
							
						</td>
						<td>
							 <?php 	echo $profile->weight_family ?>
							
						</td>
						
					</tr>
					
					<tr>
						<td>
							 <?php 	echo '5' ?>
							
						</td>
						<td>
							 <?php 	echo $profile->package_name_combo ?>
							
						</td>
						<td>
							 <?php 	echo $profile->quantity_combo ?>
							
						</td>
						<td>
							 <?php 	echo $profile->no_ofpiece_combo ?>
							
						</td>
						<td>
							 <?php 	echo $profile->weight_combo ?>
							
						</td>
						
					</tr>
					<tr>
					
					<th><h4><b> Packed Weight (Kg)   :</b></h4><?php echo $profile->total_weight ?> </th>
					<th><b><h4>Packed By</b></h4><?php echo $fname = singleDbTableRow($profile->created_by)->first_name . ' ' . singleDbTableRow($profile->created_by)->last_name; ?></th>
											 <th><b><h4>Packing Date</b></h4><?php echo date('d/m/Y h:i A', $profile->created_at); ?></th>
											 
											 <th><b><h4>Prepaired By</b></h4><?php echo $fname = singleDbTableRow($profile->prepaired_by)->first_name . ' ' . singleDbTableRow($profile->prepaired_by)->last_name; ?></th> 
											 
											 <th><b><h4>Declared By</b></h4><?php echo $fname = singleDbTableRow($row->created_by)->first_name . ' ' . singleDbTableRow($row->created_by)->last_name; ?></th>
											
											 
											 
											 <?php 
											$query1 = $this->db->group_by('created_by')->get_where('product_ingredients', ['product_preparation' => $profile->product,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														
													}
												} else {
													 echo  "no data";
												}?>
					</tr>
					
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th><?php echo date('d-m-Y h:i A', $profile->created_at)?></th>
					<th> <?php echo date('d-m-Y h:i A', $row->created_at)?></th>
					
					</tr>
						  </table>
						
						
					<!--echo $u->created_by."<br>";-->
					
				
					
		
<!--<button type="button" id="btn" onclick="get_total()">click</button> -->
                </div><!-- /.box-body -->

              
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->


