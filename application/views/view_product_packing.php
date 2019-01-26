
<?php include('header.php'); ?>
<?php function page_css(){ ?>
  

    <!-- Bar code -->
    <script type="text/javascript" src="<?php echo base_url('assets/code39.js'); ?>" ></script>


<?php } ?>

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
<?php foreach ($view_packing->result() as $profile)  ?>	
<div class="row">		
<div class="col-sm-12">	
				        <div class="col-md-6">
          
                <div class="box-header">
                    <h3 class="box-title" style="color:red;">
                    Batch No. Barcode
                    </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped" >
						
                            <td><b> Batch No. Barcode</b></td>
											<tr>
                                                
                                                <td><div id="externalbox">
												<div id="inputdata" style="color:red;" ><?php echo $profile->unique_small; ?></div>
												
												
												</div>
											</td>
                                            </tr>                            
                        </table>
                        </div><!-- /.box-body -->
                   
                    </div><!--/.col (left) -->
					
					
					 <div class="col-md-6">
					 <div class="box-header">
                    <h3 class="box-title" style="color:red;">
                    Batch No. QR Code
                    </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped" >
						
                            <td><b>  Batch No. QR Code</b></td>
						<input id="text"  type="text" value="<?php echo $profile->unique_small; ?>" style="display:none;" />
											<tr>
                                                
                                                <td align="center"><div id="externalbox">
												<div  id="qrcode"  style="height:100px;width:100px;color:red;" ></div>
												
												</td>
                                            </tr>  
												
												</div>
											                          
                        </table>
                        </div><!-- /.box-body -->
                   
                    </div><!--/.col (left) -->
		</div>
		</div>
                <div class="box-body table-responsive">
     
                    <table class="table table-striped table-hover">
					
					<tr><h2><b>Packed Product</h2></b></tr>
							<tr>
                           <th><b><h4>Package No</b></h4></th>
							<th><b><h4>Package Name</b></h4></th>
							<th><b><h4>Unique Name</b></h4></th>
							<th><b><h4>Quantity (Kg)</b></h4></th>
							<th><b><h4>No of Pieces</b></h4></th>		
							<th><b><h4>Weight(Kg)</b></h4></th>	
							
							
                            
                           
                           
                            
                        </tr>
					
										<?php
										$cnt =1;
										$t_cnt = $view_packing->num_rows();
										

                      
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
							 <?php 	echo $profile->package_name_small; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->unique_small; ?>
							
						</td>
						
						
						<td>
							 <?php 	echo $profile->quantity_small; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->no_ofpiece_small; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->weight_small; ?>
							
						</td>
						
						
					</tr>
					
				<!--	<tr>
						<td>
							 <?php 	echo '2' ?>
							
						</td>
						<td>
							 <?php 	echo $profile->package_name_medium; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->unique_medium; ?>
							
						</td>
						<td>
							<div id="inputdata1">
								<?php
								   

									echo $profile->unique_medium;
								?>
							</div>							
						</td>
						<td>
							 <?php 	echo $profile->quantity_medium; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->no_ofpiece_medium; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->weight_medium; ?>
							
						</td>
						
					</tr>
					
					<tr>
						<td>
							 <?php 	echo '3' ?>
							
						</td>
						<td>
							 <?php 	echo $profile->package_name_large; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->unique_large; ?>
							
						</td>
						<td>
							<div id="inputdata2">
								<?php
								   

									echo $profile->unique_large;
								?>
							</div>							
						</td>
						<td>
							 <?php 	echo $profile->quantity_large; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->no_ofpiece_large; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->weight_large; ?>
							
						</td>
						
					</tr>
					
					<tr>
						<td>
							 <?php 	echo '4' ?>
							
						</td>
						<td>
							 <?php 	echo $profile->package_name_family; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->unique_family; ?>
							
						</td>
						<td>
							<div id="inputdata3">
								<?php
								   

									echo $profile->unique_family;
								?>
							</div>	
                        </td>							
						<td>
							 <?php 	echo $profile->quantity_family; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->no_ofpiece_family ;?>
							
						</td>
						<td>
							 <?php 	echo $profile->weight_family; ?>
							
						</td>
						
					</tr>
					
					<tr>
						<td>
							 <?php 	echo '5' ?>
							
						</td>
						<td>
							 <?php 	echo $profile->package_name_combo; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->unique_combo; ?>
							
						</td>
						<td>
							<div id="inputdata4">
								<?php
								   

									echo $profile->unique_combo;
								?>
							</div>	
                        </td>		
						<td>
							 <?php 	echo $profile->quantity_combo; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->no_ofpiece_combo; ?>
							
						</td>
						<td>
							 <?php 	echo $profile->weight_combo; ?>
							
						</td>
						
					</tr>-->
					<tr>
					
					<th><h4><b> Total Prepaired Weight (Kg)   :</b></h4><?php echo $profile->total_weight ?> </th>
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
					<th></th>
					</tr>
						  </table>
						
						
					<!--echo $u->created_by."<br>";-->
					
				
					
		
<!--<button type="button" id="btn" onclick="get_total()">click</button> -->
                </div><!-- /.box-body -->

              
            </div><!-- /.box -->


        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

<script type="text/javascript">


<script src="<?php echo base_url('assets/barcode/code39.js') ?>"></script>
<script>
/* <![CDATA[ */
  function get_object(id) {
   var object = null;
   if (document.layers) {
    object = document.layers[id];
   } else if (document.all) {
    object = document.all[id];
   } else if (document.getElementById) {
    object = document.getElementById(id);
   }
   return object;
  }
get_object("inputdata").innerHTML=DrawCode39Barcode(get_object("inputdata").innerHTML,1);
/* ]]> */
</script>
<script src="<?php echo base_url('assets/barcode/qr.js') ?>"></script>
    <script>
	var qrcode = new QRCode("qrcode");

function makeCode () {		
	var elText = document.getElementById("text");
	
	if (!elText.value) {
		alert("Input a text");
		elText.focus();
		return;
	}
	
	qrcode.makeCode(elText.value);
}

makeCode();

$("#text").
	on("blur", function () {
		makeCode();
	}).
	on("keydown", function (e) {
		if (e.keyCode == 13) {
			makeCode();
		}
	});
	</script>
<?php } ?>
