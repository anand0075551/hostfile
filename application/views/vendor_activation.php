<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	<!-- Date-Time Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
	<!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
	
	<!-- CSV Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/csv_export/html5csv.js'); ?>"></script>

<?php } ?>
<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
		<div class="box">
			<div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
				<div class="row" style="padding:10px;">
					<div class="col-sm-3">
						<p><label>Select Product</label></p>
						<select class="form-control" name="product" id="product" style=" width:100% auto; ">
							<option value="">Choose Product</option>
							<?php 
								$user_info = $this->session->userdata('logged_user');
								$user_id = $user_info['user_id'];
								
							
								$get_product = $this->db->group_by('product')->get('smb_stock');
								foreach($get_product->result() as $p){
									
									echo "<option value='".$p->product."'>".singleDbTableRow($p->product,'smb_product')->title."</option>";
								}
							?>
						</select>
					</div>
					<div class="col-sm-3">
						<p><label>Select Vendor</label></p>
						<select class="form-control" name="vendor" id="vendor" style=" width:100% auto; ">
							<option value="">Choose Vendor</option>
							<?php 
								$get_vendor = $this->db->group_by('added_by')->get('smb_stock');
								foreach($get_vendor->result() as $v){
									echo "<option value='".$v->added_by."'>".singleDbTableRow($v->added_by)->company_name."</option>";
								}
							?>
						</select>
					</div>
					<div class="col-sm-3">
						<p><label>Select Location</label></p>
						<select class="form-control" name="location" id="location" style=" width:100% auto; ">
							<option value="">Choose location</option>
							<?php 
								$get_vendor = $this->db->group_by('location')->get('smb_stock');
								foreach($get_vendor->result() as $v){
									echo "<option value='".$v->location."'>".singleDbTableRow($v->location,'location_id')->location."</option>";
								}
							?>
						</select>
					</div>
					<div class="col-sm-3">
						<p><label>Select Status</label></p>
						<select class="form-control" name="status" id="status" style=" width:100% auto; ">
							<option value="">Choose status</option>
							<option value="1">Active</option>
							<option value="0">Blocked</option>
						</select>
					</div>
				</div>
				<div class="row" style="padding:10px;">
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3 text-right">
						<button type="button" name="submit" value="search" class="btn btn-primary btn-sm btn-flat" onClick="search_result()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-search"></i> Search </button>
						<button type="button" class="btn btn-danger btn-sm btn-flat" onClick="location.reload()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-undo"></i> Reset </button>
					</div>
				</div>
				
			</div><!-- /.box-header -->
			<div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
				<div class="row" style="padding:10px;">
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-primary btn-sm btn-flat" id="create_pdf" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-pdf-o"></i> Download PDF</button>
						&nbsp;
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('vender_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
			
			<div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
				 <h3 class="box-title">Vendor Activation</h3>
			</div><!-- /.box-header -->
			
			<div class="box-body table-responsive">
				<div  id="excel_table" class="box-body" style="overflow-x:scroll">
					<table id="example" class="table table-bordered table-striped table-hover print_div">
						<thead>
						<tr>
							<th>Action</th>
							<th>Vendor</th>
							<th>Product </th>
							<th>Location</th>
							<th>Status</th>
							
						</tr>
						</thead>

						<tfoot>
						<tr> 
							<th>Action</th>
							<th>Vendor</th>
							<th>Product </th>
							<th>Location</th>
							<th>Status</th>
						</tr>
						</tfoot>

					</table>
				</div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</div>
</section>
</div>



<?php function page_js(){ ?>





<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$("#example").dataTable({
			"processing": true,
			"serverSide": true,	
			"ajax": "<?php echo base_url('smb_product/vendor_activation_list'); ?>"
		});
	});

</script>	


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
			doc.save('vender_report.pdf');
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

<script type="text/javascript">
	function search_result()
	{
		$("#example").show();
		var product	     = $("#product").val();
		var vendor	     = $("#vendor").val();
		var location	 = $("#location").val();
		var status	     = $("#status").val();
		
		var mydata = {"product": product,"vendor":vendor,"location":location,"status":status};
		$(function() {
            $("#example").dataTable({
				"destroy": true,
                "processing": true,
                "serverSide": true,
				"ajax": {
            		"url": "<?php echo base_url('smb_product/vendor_active_searchlist'); ?>",
					"type":"POST",
					"data": mydata
       			 }
            });
        });		
		
	}
</script>



<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>

