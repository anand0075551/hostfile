

<?php function page_css(){ ?>
     <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	<!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
	
	<!-- CSV Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/csv_export/html5csv.js'); ?>"></script>
	
	<!-- Bar code -->	
	<script type="text/javascript" src="<?php echo base_url('assets/barcode/code39.js'); ?>" ></script>
   
	
<?php } ?>
<?php include('header.php'); ?>

<?php 
	
	foreach($stock->result() as $stock); 
	
?>



<?php
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
	$rolename    = singleDbTableRow($user_id)->rolename;
	
//stock Quantity
	if($rolename == 11){
		$chck_sts = $this->db->get_where('smb_stock', ['product'=>$stock->id])->num_rows();
		if($chck_sts>0){
			$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->id,'type'=>'add']);
			$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->id, 'type'=>'sold']);
			$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->id, 'type'=>'destroy']);
			$get_sale_price = $this->db->order_by('id', 'asc')->get_where('smb_stock', ['product'=>$stock->id,'type'=>'add']);
			
			foreach($get_added_stock->result() as $added_stock);
			$total_added = $added_stock->quantity;
			
			
			foreach($get_sold_stock->result() as $sold_stock);
			$total_sold = $sold_stock->quantity;
			
			if($total_sold == "")
			{
				$t_sold = 0;
			}
			else{
				$t_sold = $total_sold;
			}
			
			foreach($get_destroyed_stock->result() as $destroyed_stock);
			$total_destroyed = $destroyed_stock->quantity;
			
			if($total_destroyed == "")
			{
				$t_destroyed = 0;
			}
			else{
				$t_destroyed = $total_destroyed;
			}
			
			
			$av_stock = $total_added-($total_sold+$total_destroyed);
			
			//total Price
			
			$price = $t_sold*$stock->sale_price;
			
			
			foreach($get_sale_price->result() as $pr);
			$last_sale_price = $pr->sale_price;
		}
		else{
			$t_sold = 0;
			$total_added = 0;
			$t_destroyed = 0;
			$last_sale_price = 0;
			$av_stock = 0;
		}
		
	}
	else{
		$chck_sts = $this->db->get_where('smb_stock', ['product'=>$stock->id, 'added_by'=>$user_id])->num_rows();
		if($chck_sts>0){
			$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->id,'type'=>'add', 'added_by'=>$user_id]);
			$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->id, 'type'=>'sold', 'added_by'=>$user_id]);
			$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->id, 'type'=>'destroy', 'added_by'=>$user_id]);
			$get_sale_price = $this->db->order_by('id', 'asc')->get_where('smb_stock', ['product'=>$stock->id,'type'=>'add', 'added_by'=>$user_id]);
		
			foreach($get_added_stock->result() as $added_stock);
			$total_added = $added_stock->quantity;
			
			
			foreach($get_sold_stock->result() as $sold_stock);
			$total_sold = $sold_stock->quantity;
			
			if($total_sold == "")
			{
				$t_sold = 0;
			}
			else{
				$t_sold = $total_sold;
			}
			
			foreach($get_destroyed_stock->result() as $destroyed_stock);
			$total_destroyed = $destroyed_stock->quantity;
			
			if($total_destroyed == "")
			{
				$t_destroyed = 0;
			}
			else{
				$t_destroyed = $total_destroyed;
			}
			
			
			$av_stock = $total_added-($total_sold+$total_destroyed);
			
			//total Price
			
			$price = $t_sold*$stock->sale_price;
			
			
			foreach($get_sale_price->result() as $pr);
			$last_sale_price = $pr->sale_price;
		}
		else{
			$t_sold = 0;
			$total_added = 0;
			$t_destroyed = 0;
			$last_sale_price = 0;
			$av_stock = 0;
		}
	}
		
		$button1 = '<a class="btn btn-success btn-sm btn-flat" href="'.base_url('Smb_product/create_stock/'. $stock->id).'" data-toggle="modal" data-target="#create_stock" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-plus-circle "></i> Create Stock</a> &nbsp;';
				
		$button2 = '<a class="btn btn-danger btn-sm btn-flat" href="'.base_url('Smb_product/destroy_stock/'. $stock->id).'" data-toggle="modal" data-target="#destroy_stock" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-minus-circle"></i>  Destroy</a> '; 

?>


<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="box box-primary">
					<div class="box-header">
					</div><!-- /.box-header -->
			<div class="box-body">
				<div class="col-md-12">
				<!-- Bar code -->
					<div class="row">
						<div class="col-lg-2"><h4>Product Bar Code </h4></div>
						<div class="col-lg-5"> 
							<div id="externalbox" style="width:5in">
								<div id="inputdata">
									<?php 
										$product = $stock->id; 
										$query = $this->db->get_where('smb_product',['id'=>$product]);
										foreach($query->result() as $p);
										echo $p->product_code;
									?>
								</div>
							</div>
						</div>
						<div class="col-lg-5">
							<button  class="btn btn-primary btn-sm btn-flat" onclick="printContent('inputdata')" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-print" aria-hidden="true"></i> Print Bar Code </button>
						</div>
					</div>	
				<!--End  Bar Code -->
				<hr>
	<div class="row">
		<div class="col-md-3">
			<img src="<?php echo base_url('smb_uploads/'.singleDbTableRow($stock->id, 'smb_product')->main_image); ?>" class="img img-responsive" alt="Cfirst" style="height:100%; width:100%; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
		</div>
		<div class="col-md-9">
			<table class="table table-striped" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
				<tr>
					<td>Product Code</td>
					<td><?php 
							$product = $stock->id; 
							$query = $this->db->get_where('smb_product',['id'=>$product]);
							foreach($query->result() as $p);
							echo $p->product_code;
						?></td>
				</tr>
				<tr>
					<td>Product Name</td>
					<td><?php 
							$product = $stock->id; 
							$query = $this->db->get_where('smb_product',['id'=>$product]);
							foreach($query->result() as $p);
							echo $p->title;
						?></td>
				</tr>
				<tr>
					<td>Category</td>
					<td><?php 
						
							$category = $stock->category; 
							$query = $this->db->get_where('smb_category',['id'=>$category]);
							foreach($query->result() as $c);
							echo $c->category_name;
							
						?></td>
				</tr>
				<tr>
					<td>Sub Category</td>
					<td><?php 
						
							$sub_category = $stock->sub_category; 
							$query = $this->db->get_where('smb_sub_category',['id'=>$sub_category]);
							foreach($query->result() as $c);
							echo $c->sub_category_name;
							
						?></td>
				</tr>
				<tr>
					<td>Business Type</td>
					<td><?php 
							$b_id = $stock->business_types; 
							$query = $this->db->get_where('business_groups',['id'=>$b_id]);
							if($query->num_rows() > 0){
								foreach($query->result() as $b);
								echo $b->business_name;
							}
							
						?></td>
				</tr>
				<tr>
					<td>Price</td>
					<td><?php echo number_format($last_sale_price,2); ?></td>
				</tr>
				<tr>
					<td>Weight</td>
					<td><?php 
							 $product_id = $stock->id;
							 $get_weight = $this->db->get_where('smb_product',['id'=>$product_id]);
							 foreach($get_weight->result() as $w);
							 if($w->weight !="")
							 {
								 echo $w->weight.' Kg';
							 }
							 else{
								 echo "No weight";
							 }
							 
					?></td>
				</tr>
				<tr>
					<td>Volume</td>
					<td><?php 
							 $product_id = $stock->id;
							 $get_weight = $this->db->get_where('smb_product',['id'=>$product_id]);
							 foreach($get_weight->result() as $w);
							 if($w->weight !="")
							 {
								 echo $w->volume.' cm 3';
							 }
							 else{
								 echo "No volume";
							 }
							 
					?></td>
				</tr>
				<tr>
					<td>Total Uploaded</td>
					<td><?php echo $total_added; ?></td>
				</tr>
				<tr>
					<td>Total Sold</td>
					<td><?php echo $t_sold; ?></td>
				</tr>
				<tr>
					<td>Total Destroyed</td>
					<td><?php echo $t_destroyed; ?></td>
				</tr>
				<tr>
					<td>Avaibale Stock</td>
					<td><?php echo $av_stock; ?></td>
				</tr>
				<tr>
					<td>Total Weight </td>
					<td><?php 
							 $product_id = $stock->id;
							 $get_weight = $this->db->get_where('smb_product',['id'=>$product_id]);
							 foreach($get_weight->result() as $w);
							 if($w->weight !="")
							 {
								 echo $w->weight*$av_stock.' Kg';
							 }
							 else{
								 echo "No weight";
							 }
							 
					?></td>
				</tr>
				<tr>
					<td>Total Volume </td>
					<td><?php 
							 $product_id = $stock->id;
							 $get_weight = $this->db->get_where('smb_product',['id'=>$product_id]);
							 foreach($get_weight->result() as $w);
							 if($w->volume !="")
							 {
								 echo $w->volume*$av_stock.' (cm 3)';
							 }
							 else{
								 echo "No volume";
							 }
							 
					?></td>
				</tr>
			</table>
		</div>
	</div>
					
					<hr>
					<div class=" table-responsive ">
					<table class="table table-bordered table-striped table-hover">
						<tr>
							<th>location</th>
							<th>Total Uploaded</th>
							<th>Total Sold</th>
							<th>Total Destroyed</th>
							<th>Avaibale Stock</th>
						</tr>
						<?php
							
							//stock Quantity
							if($rolename == 11){
								$get_loc = $this->db->group_by('location')->get_where('smb_stock',['product'=>$product]);
								foreach($get_loc->result() as $p){
								
								$chck_sts = $this->db->get_where('smb_stock', ['product'=>$stock->id,'location'=>$p->location])->num_rows();
									if($chck_sts>0){
										$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->id,'type'=>'add', 'location'=>$p->location]);
										$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->id, 'type'=>'sold', 'location'=>$p->location]);
										$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->id, 'type'=>'destroy', 'location'=>$p->location]);
										$get_sale_price = $this->db->order_by('id', 'asc')->get_where('smb_stock', ['product'=>$stock->id,'type'=>'add', 'location'=>$p->location]);
									
										foreach($get_added_stock->result() as $added_stock);
										$total_added = $added_stock->quantity;
										
										
										foreach($get_sold_stock->result() as $sold_stock);
										$total_sold = $sold_stock->quantity;
										
										if($total_sold == "")
										{
											$t_sold = 0;
										}
										else{
											$t_sold = $total_sold;
										}
										
										foreach($get_destroyed_stock->result() as $destroyed_stock);
										$total_destroyed = $destroyed_stock->quantity;
										
										if($total_destroyed == "")
										{
											$t_destroyed = 0;
										}
										else{
											$t_destroyed = $total_destroyed;
										}
										
										
										$av_stock = $total_added-($total_sold+$total_destroyed);
										
										
									}
									else{
										$t_sold = 0;
										$total_added = 0;
										$t_destroyed = 0;
										$av_stock = 0;
									}
								
									echo "<tr>";
										echo "<td>".singleDbTableRow($p->location,'location_id')->location."</td>";
										echo "<td>".$total_added."</td>";
										echo "<td>".$t_sold."</td>";
										echo "<td>".$t_destroyed."</td>";
										echo "<td>".$av_stock."</td>";
									echo "</tr>";
									
								}
								
							}
							else{
								
							$get_loc = $this->db->group_by('location')->get_where('smb_stock',['product'=>$product,'added_by'=>$user_id]);
							foreach($get_loc->result() as $p){
								
									$chck_sts = $this->db->get_where('smb_stock', ['product'=>$stock->id, 'added_by'=>$user_id, 'location'=>$p->location])->num_rows();
									if($chck_sts>0){
										$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->id,'type'=>'add', 'added_by'=>$user_id, 'location'=>$p->location]);
										$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->id, 'type'=>'sold', 'added_by'=>$user_id, 'location'=>$p->location]);
										$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->id, 'type'=>'destroy', 'added_by'=>$user_id, 'location'=>$p->location]);
										$get_sale_price = $this->db->order_by('id', 'asc')->get_where('smb_stock', ['product'=>$stock->id,'type'=>'add', 'added_by'=>$user_id, 'location'=>$p->location]);
									
										foreach($get_added_stock->result() as $added_stock);
										$total_added = $added_stock->quantity;
										
										
										foreach($get_sold_stock->result() as $sold_stock);
										$total_sold = $sold_stock->quantity;
										
										if($total_sold == "")
										{
											$t_sold = 0;
										}
										else{
											$t_sold = $total_sold;
										}
										
										foreach($get_destroyed_stock->result() as $destroyed_stock);
										$total_destroyed = $destroyed_stock->quantity;
										
										if($total_destroyed == "")
										{
											$t_destroyed = 0;
										}
										else{
											$t_destroyed = $total_destroyed;
										}
										
										
										$av_stock = $total_added-($total_sold+$total_destroyed);
										
										
									}
									else{
										$t_sold = 0;
										$total_added = 0;
										$t_destroyed = 0;
										$av_stock = 0;
									}
								
								
								echo "<tr>";
										echo "<td>".singleDbTableRow($p->location,'location_id')->location."</td>";
										echo "<td>".$total_added."</td>";
										echo "<td>".$t_sold."</td>";
										echo "<td>".$t_destroyed."</td>";
										echo "<td>".$av_stock."</td>";
									echo "</tr>";
									
								}

							}
						?>
					</table>
					</div>
					<hr><br>
				</div><!-- /.box-body -->
				<br><br>
			</div><!-- /.box -->
			
					<div class="box-body">
						<div class="row">
							<div class="col-lg-6"  >
								<span id="test_div">
									<button type="button" class="btn btn-warning btn-sm btn-flat" onclick="update_stock()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
									<i class="fa fa-arrow-up"></i> Update Stock
									</button>
								</span>
								<span id="stock_div" style="display:none;">
									<?php 
									echo $button1." ".$button2;
								?>
								</span>
							</div>
							
							<div class="col-lg-6 text-right">
								<button type="button" class="btn btn-success btn-sm btn-flat" onclick="CSV.begin('#example').download('stock_details.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
								
								<a href="<?php echo base_url('smb_product/physical_products') ?>" class="btn btn-primary btn-sm btn-flat" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-arrow-left" ></i> Back</a>
								
								<a class="btn btn-danger deleteBtn" style="display:none" href="<?php echo base_url('Smb_product/stock_delete?id='.$stock->id) ?>" title="Delete"><i class="fa fa-trash"></i> </a>
							</div>
						</div>
						
					</div>
			
			 <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
							<th width="10%">Date</th>    
                            <th width="10%">Stock Type</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Price</th>                                
                            <th width="10%">Discount Price</th>                                
                            <th width="10%">Total</th>                                
                            <th width="10%">Discount</th>                                
                            <th width="10%">Product Tax(%)</th>                                
                            <th width="10%">Tax Value</th>                                
                            <th width="10%">Shipping Cost</th>                                
                            <th width="10%">Shipping Cost value</th>                                
                            <th width="10%">Location </th>                                
                            <th width="10%">Status </th>                                
                                                       
                        </tr>
                        </thead>
							<td><input type="hidden" value="<?php echo $stock->id; ?>" name="id" id="id"></td>
                        <tfoot>
                        <tr>
                           <th>Date</th>    
                            <th>Stock Type</th>
                            <th>Quantity</th>
                            <th>Price</th>                                
                            <th>Discount Price</th>                                
                            <th>Total</th>                                
                            <th>Discount</th>                                
                            <th>Product Tax(%)</th>                                
							<th>Tax Value</th>                               
                            <th>Shipping Cost</th>                                
                            <th>Shipping Cost value</th>                                
                            <th>Location </th>                                
                            <th>Status </th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
			
		</div><!--/.col (left) -->
	</div>  
</section><!-- /.content -->



<!----------------------------------------Create stock----------------------------------------------->
<div class="modal fade" id="create_stock" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:20px; margin-top:50px;">
 
		</div>
	</div>
</div>
<!-------------------------------------------End_create_stock --------------------------->

<!----------------------------------------Destroy Stock----------------------------------------------->
<div class="modal fade" id="destroy_stock" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:20px; margin-top:50px;">

		</div>
	</div>
</div>
<!-------------------------------------------End Destroy--------------------------->

<?php function page_js(){ ?>


<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
	$(function() {
   
	var id = $("#id").val();
	var mydata = {"id": id};
	
	$(function() {
		$("#example").dataTable({
			  "paging": true,
			  "ordering": true,
			  "ordering": true,
			  "destroy": true,
			   "info": true,
			"ajax": {
				"url": "<?php echo base_url('smb_product/stock_view_json'); ?>",
				"type":"POST",
				"data": mydata
			 }
		});
	});
	});
</script>

<script>
function update_stock(){
//	alert('k');
	$('#test_div').fadeOut();
	$('#stock_div').fadeIn(2800);
}
</script>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<script type="text/javascript">

function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}

</script>

<script type="text/javascript">

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

</script>	
	
	
<?php } ?>	