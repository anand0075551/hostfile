<?php function page_css(){ ?>	
	<!-- CSV Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/csv_export/html5csv.js'); ?>"></script>
<?php } ?>	

<?php 
	
	foreach($stock_details->result() as $stock); 
	
?>
<?php include('header.php'); ?>


<?php
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
	$rolename    = singleDbTableRow($user_id)->rolename;
	
//stock Quantity
	$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->product,'type'=>'add','added_by' => $stock->added_by]);
	$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->product, 'type'=>'sold','added_by' => $stock->added_by]);
	$get_sale_price = $this->db->order_by('id', 'asc')->get_where('smb_stock', ['product'=>$stock->product,'type'=>'add','added_by' => $stock->added_by]);

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
		
		$av_stock = $total_added-$total_sold;
		
		//total Price
		
		$price = $t_sold*$stock->sale_price;
		
		
		foreach($get_sale_price->result() as $pr);
		$last_sale_price = $pr->sale_price;

?>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="box box-primary">
					<div class="box-header">
					</div><!-- /.box-header -->
			<div class="box-body">
				<div class="col-md-12">
				<!-- general form elements -->
					<table class="table table-striped">
						<tr>
							<th>Vendor Name</th>
							<th><?php 
									$add_by = $stock->added_by; 
									//Vendor  Name
									$get_vendor = $this->db->get_where('users', ['id'=>$add_by]);
									foreach($get_vendor->result() as $vendor);
									echo $vendor->company_name;
								?></th>
						</tr>
						<tr>
							<td>Product Name</td>
							<td><?php 
									$product = $stock->product; 
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
							<td>Price</td>
							<td><?php echo number_format($last_sale_price,2); ?></td>
						</tr>
						<tr>
							<td>Total Uploaded</td>
							<td><?php echo $total_added; ?></td>
						</tr>
						<tr>
							<td>Total Sold</td>
							<td><?php echo $total_sold; ?></td>
						</tr>
				<!--	<tr>
							<td>Sold Price</td>
							<td>< ?php echo $price; ?></td>
						</tr>	-->
						<tr>
							<td>Avaibale Stock</td>
							<td><?php echo $av_stock; ?></td>
						</tr>
						
						
					</table>
				</div><!-- /.box-body -->
					<div class="box-footer text-right">
						<a href="<?php echo base_url('Smb_reports/stock_report') ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
						<a class="btn btn-danger deleteBtn" style="display:none" href="<?php echo base_url('Smb_product/stock_delete?id='.$stock->id) ?>" title="Delete"><i class="fa fa-trash"></i> </a>
					</div>
			</div><!-- /.box -->
			
			<div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
				<div class="row" style="padding:10px;">
					<div class="col-sm-12 text-left">
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('sales_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
			<br>
			 <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
							<th>Date</th>    
                            <th>Stock Type</th>
                            <th>Quantity</th>
                            <th>Price</th>                                
                            <th>Total</th>                                
                            <th>Shipping Cost</th>                                
                            <th>Product Tax </th>                                
                            <th>Location</th>                                
                                                       
                        </tr>
                        </thead>
							<tbody>
								<?php
								$query = $this->db->order_by('id','desc')->get_where('smb_stock', ['product'=>$stock->product,'added_by'=>$stock->added_by]);
									
									foreach($query->result() as $p)
									{
										echo "<tr>";
											if($p->type == "add")
											{
												echo "<td>".date('d-m-Y', $p->created_at)."</td>";
											}
											else{
												echo "<td>".date('d-m-Y', $p->modified_at)."</td>";
											}
											echo "<td>".$p->type."</td>";
											echo "<td>".$p->quantity."</td>";
											echo "<td>".$p->sale_price."</td>";
											echo "<td>".$p->total."</td>";
											echo "<td>".$p->shipping_cost."</td>";
											echo "<td>".$p->tax."</td>";
											
											$location_id = $p->location;
											
											if($location_id !="")
											{
												$get_loc_name = $this->db->get_where('location_id', ['id'=>$location_id]);
												if($get_loc_name->num_rows() >0 ){
													foreach($get_loc_name->result() as $loc_name);
												
													echo "<td>".$loc_name->location."</td>";
												}
												else{
													echo "<td>Not Available</td>";
												}
												
											}
											else{
												echo "<td>Not Available</td>";
											}
											
										echo "</tr>";
									}
								?>
							</tbody>
                        <tfoot>
                        <tr>
                           <th>Date</th>    
                            <th>Stock Type</th>
                            <th>Quantity</th>
                            <th>Price</th>                                
                            <th>Total</th>                                
                            <th>Shipping Cost</th>                                
                            <th>Product Tax </th>                                
                            <th>Location</th>                                
                            
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
			
		</div><!--/.col (left) -->
	</div>  
</section><!-- /.content -->

