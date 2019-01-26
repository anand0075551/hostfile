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

	//Total Added
	$get_added_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->product,'type'=>'add','added_by' => $stock->added_by]);
	
	foreach($get_added_stock->result() as $added_stock);
		$total_added = $added_stock->quantity;
	
	//Total sold
	$get_sold_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->product, 'type'=>'sold','added_by' => $stock->added_by]);
	
	foreach($get_sold_stock->result() as $sold_stock);
		$total_sold = $sold_stock->quantity;
		
		if($total_sold == "")
		{
			$t_sold = 0;
		}
		else{
			$t_sold = $total_sold;
		}
	//Total destroyed
	$get_destroyed_stock = $this->db->select_sum('quantity')->get_where('smb_stock', ['product'=>$stock->product, 'type'=>'destroy', 'added_by' => $stock->added_by]);
	foreach($get_destroyed_stock->result() as $destroyed_stock);
	$total_destroyed = $destroyed_stock->quantity;
	
	if($total_destroyed == "")
	{
		$t_destroyed = 0;
	}
	else{
		$t_destroyed = $total_destroyed;
	}
	
	$get_sale_price = $this->db->order_by('id', 'asc')->get_where('smb_stock', ['product'=>$stock->product,'type'=>'add','added_by' => $stock->added_by]);
		
		$av_stock = $total_added-($total_sold+$total_destroyed);
		
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
						<tr>
							<td>Total Destroyed</td>
							<td><?php echo $t_destroyed; ?></td>
						</tr>
						<tr>
							<td>Avaibale Stock</td>
							<td><?php echo $av_stock; ?></td>
						</tr>
						
						
					</table>
				</div><!-- /.box-body -->
					<div class="box-footer text-right">
						<a href="<?php echo base_url('Smb_allreports/smb_stock_report') ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
						<a class="btn btn-danger deleteBtn" style="display:none" href="<?php echo base_url('Smb_product/stock_delete?id='.$stock->id) ?>" title="Delete"><i class="fa fa-trash"></i> </a>
					</div>
			</div><!-- /.box -->
			
			<div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
				<div class="row" style="padding:10px;">
					<div class="col-sm-12 text-left">
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('stock_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
			<br>
			<div class="box-body table-responsive">
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
							<td><input type="hidden" value="<?php echo $stock->id; ?>" name="id" id="id"></td>
							<td><input type="hidden" value="<?php echo $stock->product; ?>" name="product" id="product"></td>
							<td><input type="hidden" value="<?php echo $stock->added_by; ?>" name="added_by" id="added_by"></td>
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
<!-- PDF Export -->
	<?php function page_js(){ ?>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
    <script type="text/javascript">
     $(function() {
      
		var id = $("#id").val();
		var product = $("#product").val();
		var added_by = $("#added_by").val();
		var mydata = {"id": id,"product":product,"added_by":added_by};
		
		$(function() {
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,
				"ajax": {
            		"url": "<?php echo base_url('Smb_allreports/stock_list_json'); ?>",
					"type":"POST",
					"data": mydata
       			 }
            });
        });
		});
    </script>
	<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
	var form = $('.print_div'),
	//	cache_width = form.width(),
		a4  =[ 868,  841.89];  // for a4 size paper width and height

	$('#create_pdf').on('click',function(){
		//$('body').scrollTop(0);
		createPDF();
	});
	//create pdf
	function createPDF(){
		getCanvas().then(function(canvas){
			var 
			img = canvas.toDataURL("image/png"),
			doc = new jsPDF({
			  unit:'px', 
			  format:'a3'
			});     
			doc.addImage(img, 'JPEG', 20, 20);
			doc.save('accounts_report.pdf');
			//form.width(cache_width);
		});
	}

	// create canvas object
	function getCanvas(){
		form.width((a4[0]*1.33333) -80).css('max-width','none');
		return html2canvas(form,{
			imageTimeout:2000,
			removeContainer:true
		});	
	}

	});
</script>
<?php } ?>	
