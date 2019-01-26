
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
					
					
					<tr><h2><b>Declared Ingredients</h2></b></tr>
							<tr>
                            <td><h4><b>Categaory</b></h4></td>
                            <td><h4><b>Sub category</b></h4></td>
                            <td><b><h4>Items</b></h4></td>
                            <td><b><h4>Declared Weights(Kg)</b></h4></td>
                           
                           
                            
                        </tr>
					
										<?php
										$cnt =1;
										$t_cnt = $view_assistant->num_rows();
										
foreach ($view_assistant->result() as $profile)
{
?>
						
					  

						<tr>
                           
                            
							 <td><?php 
											$query1 = $this->db->get_where('smb_category', ['id' => $profile->category,]);
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row) {
														echo  $row->category_name;
													}
												} else {
													 echo  "error";
												}?></td>
							 <td><?php 
											$query2 = $this->db->get_where('smb_sub_category', ['id' => $profile->sub_category,]);
												
												if ($query2->num_rows() > 0) {
													foreach ($query2->result() as $row2) {
														echo  $row2->sub_category_name;
													}
												} else {
													 echo  "error";
												}?></td>
							 <td><?php 
											$query3 = $this->db->get_where('smb_product', ['id' => $profile->item,]);
												
												if ($query3->num_rows() > 0) {
													foreach ($query3->result() as $row3) {
														echo  $row3->title;
													}
												} else {
													 echo  "error";
												}?></td>
							 <td><?php echo $profile->qty; ?></td>
							 <?php //$cnt=1;?>
							 
							
							 
                        </tr> 
						
					
					
						
						
					
                       
                        <?php  $cnt++; }?>
						
					<tr>
						<th></th><th></th><th></th>
						<th><b><h4>Total Declared Weight(Kg):    <?php 
											 echo $profile->total_declared?></b></h4></th>
						
						</tr>
					
						  </table>
						  <table class="table table-striped table-hover">
						  <tr>
						  <th><h4><b>Used Item</h4></b></th>
						  <th><h4><b>Used weight(Kg)</h4></b></th>
						  <th><h4><b>Used By</h4></b></th>
						 
						  
						  </tr>
						 	<?php
										$cnt =1;
										$t_cnt = $view_assistant->num_rows();
										
foreach ($used_assistant->result() as $profile)
{
?>
						
					  

						<tr>
                           <td><?php 
											$query1 = $this->db->get_where('product_ingredients', ['ingredient' => $profile->used_ingredeint]);
											
												
												if ($query1->num_rows() > 0) {
													foreach ($query1->result() as $row);
														$query2 = $this->db->get_where('smb_product', ['id' => $row->item]);
														foreach ($query2->result()as $r);
														echo $r->title;
													
												} else {
													 echo  "no data";
												}?></td>
                            
							 <td> <?php echo $profile->used_weight; ?></td>
							
                                <td><?php echo $fname = singleDbTableRow($profile->created_by)->first_name . ' ' . singleDbTableRow($profile->created_by)->last_name; ?></td>
							 
							
							 
							
							 
                        </tr> 
						
					
					
						
						
					
                       
                        <?php  $cnt++; }?>
						<th></th>
					
						<th><h4><b>Total Output(Kg):  <?php echo $profile->total_output;?></h4></b></th>
						<th></th>
						
						  </table>
						
						
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


