
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
				<div class="table-responsive">
 <table class="table table-bordered table-striped ">
 <tr>
 <th> Used Ingredients</th>
 <th> Used Weights</th>
 </tr>
						 	<?php
										$cnt =1;
										$t_cnt = $used_assistant->num_rows();
										
foreach ($used_assistant->result() as $profile)
{
?>
						
					  
						
						
						<tr>
                           <td><?php 
											$query1 = $this->db->get_where('product_ingredients', ['item' => $profile->item]);
											
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row);
														$query2 = $this->db->get_where('smb_product', ['id' => $row->item]);
														foreach ($query2->result()as $r);
														echo $r->title;
													
												} else {
													 echo  "no data";
												}?></td>
                            
							 <td> <?php echo $profile->used_weight; ?></td>
							
                             
			
					
                       
                        <?php  $cnt++; }?>
						</tr>
						  </table>
						  <?php 
											$query1 = $this->db->group_by('created_by')->get_where('product_ingredients', ['product_preparation' => $profile->product,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														
													}
												} else {
													 echo  "no data";
												}?>
						  
						  <table class="table table-bordered table-striped ">
						 <tr>
						 <th><h4><b>Declared By : </b> <?php echo $fname = singleDbTableRow($row->created_by)->first_name . ' ' . singleDbTableRow($row->created_by)->last_name; ?></h4></th>
						
						   <th><h4><b>Prepaired By : </b> <?php echo $fname = singleDbTableRow($profile->created_by)->first_name . ' ' . singleDbTableRow($profile->created_by)->last_name; ?></h4></th>
						   
						
					
						<th><h4><b>Total Output(Kg): </b> <?php echo $profile->total_output;?></h4></th>
					
						</tr>
						
						<tr>
						<th><h4><b>Declaration Date :</b> <?php echo date('d-m-Y h:i A', $row->created_at)?></h4></th>
						<th><h4><b>Preparation Date :</b><?php echo date('d/m/Y h:i A', $profile->created_at); ?></h4></th>
						
						
						</tr>
						
						
						</table>
						</div>
						<br>
						<br>
					<!--echo $u->created_by."<br>";-->
					
				
					
						  <div class="box-footer">
		<!--	<button type="button" name="submit"  value="submit" class="btn btn-primary" onclick="Used_weight(<?php echo $t_cnt;?>)" ></i>Submit</button>-->
               
            </div>
<!--<button type="button" id="btn" onclick="get_total()">click</button> -->
                </div><!-- /.box-body -->

              
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->


