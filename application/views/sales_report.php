<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	
	<!--  Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
	
	
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
					
					<?php 
						$user_info 	 = $this->session->userdata('logged_user');
						$user_id 	 = $user_info['user_id'];
						$role = singleDbTableRow($user_id)->rolename;
						if($role == 11){
					?>
						<div class="col-sm-3">
							<p><label>Select Vendor</label></p>
							<select class="form-control" name="vendor" id="vendor" style=" width:100% auto; ">
								<option value="">Choose Vendor</option>
								<?php 
									$get_vendor = $this->db->order_by('company_name', 'asc')->get_where('users', ['rolename'=>'26']);
									foreach($get_vendor->result() as $v){
										echo "<option value='".$v->id."'>".$v->company_name."</option>";
									}
								?>
							</select>
						</div>
					<?php } ?>
						<div class="col-sm-3">
							<p><label>Select Product</label></p>
							<select class="form-control" name="product" id="product" style=" width:100% auto; ">
								<option value="">Choose Product</option>
								<?php 
									$get_product = $this->db->order_by('title', 'asc')->get('smb_product');
									foreach($get_product->result() as $p){
										echo "<option value='".$p->id."'>".$p->title."</option>";
									}
								?>
							</select>
						</div>
						<div class="col-sm-3">
							<p><label>Select Location</label></p>
							<select class="form-control" name="location" id="location" style=" width:100% auto; ">
								<option value="">Choose Location</option>
								<?php 
									$get_location = $this->db->order_by('location', 'asc')->get('location_id');
									foreach($get_location->result() as $l){
										echo "<option value='".$l->id."'>".$l->location."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="row" style="padding:10px;">
						<div class="col-sm-3">
							
						</div>
						<div class="col-sm-3">
							
						</div>
						<div class="col-sm-3">
							
						</div>
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
							<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('sales_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
						</div>
					</div>
                </div><!-- /.box-header -->
				
                <div class="box-body">
                    <table id="example" class="table table-bordered table-hover print_div" >
                        
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

<?php function page_js(){ ?>

<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.js" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>
 



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
			doc.save('sales_report.pdf');
			//form.width(cache_width);
		});
	}

	

	});
</script>



  

<script type="text/javascript">
	function search_result()
	{
		var vendor = $("#vendor").val();
		var product = $("#product").val();
		var location = $("#location").val();
		
	
		var mydata = {"vendor": vendor, "product": product, "location": location};
		$.ajax({
		type: "POST",
		url: "<?php echo base_url('smb_reports/search_ListJson'); ?>",
		data: mydata,
		success: function (response) {
			$("#example").html(response);
			//alert(response);
		}
	});	
	
		
	}
</script>


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>



<?php } ?>

