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
	
	<!--<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel = "stylesheet" type = "text/css"/>
	<link href = "https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel = "stylesheet" type = "text/css"/>-->
	
	
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
						<p><label>Select Consignment No</label></p>
						<select class="form-control" name="cons_no" id="cons_no" style=" width:100% auto; ">
							<option value="">Choose Number</option>
							<?php 
								$get_cons_no = $this->db->group_by('cons_no')->order_by('cons_no','asc')->get_where('cms_courier');
								foreach($get_cons_no->result() as $p){
							
									echo "<option value='".$p->cons_no."'>".$p->cons_no."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3">
						<p><label>Select Status</label></p>
						<select class="form-control" name="status" id="status" style=" width:100% auto; ">
							<option value="">Choose Status</option>
							<?php 
								$get_users = $this->db->group_by('status')->order_by('status','asc')->get_where('cms_courier');
								foreach($get_users->result() as $p){
									
									$name = $p->status;
									
										echo "<option value='".$p->status."'>".$name."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3">
						<p><label>Shipper Pincode</label></p>
						<select class="form-control" name="shipper_pincode" id="shipper_pincode" style=" width:100% auto; ">
							<option value="">Choose pincode</option>
							<?php 
								$get_users = $this->db->group_by('shipper_pincode')->order_by('shipper_pincode','asc')->get_where('cms_courier');
								foreach($get_users->result() as $p){
									
									$name = $p->shipper_pincode;
									
										echo "<option value='".$p->shipper_pincode."'>".$name."</option>";
								}
							?>
						</select>
					</div>	
						
					<div class="col-sm-3">
						<p><label>Business Type</label></p>
						<select class="form-control" name="business_group" id="business_group" style=" width:100% auto; ">
							<option value="">Choose Business Type</option>
							

							
							<?php 
								$get_users = $this->db->group_by('business_group')->get_where('cms_courier');
								foreach($get_users->result() as $p){
									
									$name = $p->business_group;
								
									echo "<option value='".$p->business_group."'>".$name."</option>";
								}
							?>
						</select>
					</div>
					
					
					
				</div>
			
					<div class="row" style="padding:10px;">
					
					<div class="col-sm-3">
						<p><label>From Date</label></p>
						<input type="text" class="some_class form-control" style="height:30px;" value="" id="some_class_1" name="sf_time"  placeholder="From"/>
					</div>
					
					<div class="col-sm-3">
						<p><label>To Date</label></p>
						<input type="text" class="some_class form-control" style="height:30px;" value="" id="some_class_2" name="st_time"  placeholder="To"/>
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
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('courier_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
				<div  id="excel_table" class="box-body">
					<table id="example" class="table table-bordered table-striped table-hover print_div">
						<thead>
						<tr>
							 <tr>
						    <th width="10%">Action</th>
                            <th>Consignment No</th>
							<th>Shipper Name</th>
							<th>Phone</th>
							<th>Shipper Pincode</th>
							<th>Shipper Address</th>
							<th>Revevier Name</th>
							<th>Receiver Phone</th>
							<th>Receiver Pincode</th>
							<th>Receiver Address</th>
							<th>Type</th>
							<th>Cost</th>
							<th>Weight</th>
							<th>Invoice Number</th>
							<th>Quantity</th>
							<th>Book Mode</th>
							<th>freight</th>
							<th>Mode</th>
							<th>Pick Date</th>
							<th>Pick Time</th>
							<th>Status</th>
							<th>Comments</th>
                            <th>Book Date</th>
							<th>created_by</th>
							<th>Assigned To</th>
							<th>Business  Group	</th>
							
						</tr>
						</thead>

						<tfoot>
							 <tr>
						    <th width="10%">Action</th>
                            <th>Consignment No</th>
							<th>Shipper Name</th>
							<th>Phone</th>
							<th>Shipper Pincode</th>
							<th>Shipper Address</th>
							<th>Revevier Name</th>
							<th>Receiver Phone</th>
							<th>Receiver Pincode</th>
							<th>Receiver Address</th>
							<th>Type</th>
							<th>Cost</th>
							<th>Weight</th>
							<th>Invoice Number</th>
							<th>Quantity</th>
							<th>Book Mode</th>
							<th>freight</th>
							<th>Mode</th>
							<th>Pick Date</th>
							<th>Pick Time</th>
							<th>Status</th>
							<th>Comments</th>
                            <th>Book Date</th>
							<th>created_by</th>
							<th>Assigned To</th>
							<th>Business  Group	</th>
							
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


<!----Datepiker SCRIPT  Files---->
<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>

<!-- Hide And Show -->
	
	
	
	<!--<script src = "//code.jquery.com/jquery-1.12.4.js " type="text/javascript"> </script>
	<script src = "https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js " type = "text/javascript"> </script>
	<script src = "https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js" type = "text/javascript"> </script>
	<script src = "//cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js" type =" text/javascript " > </script>-->


<script>

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});

$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});
</script>

<script type="text/javascript">
	$(function() {
		$("#example").dataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "< ?php echo base_url('Courier/courier_ListJson4'); ?>"
		});
	});

</script>

<script type="text/javascript">
	function search_result()
	{
		var cons_no      		 = $("#cons_no").val();
		var status		 		 = $("#status").val();
		var shipper_pincode		 = $("#shipper_pincode").val();
		var business_group		 = $("#business_group").val();
			var sf_time=document.getElementById('some_class_1').value;
			var st_time=document.getElementById('some_class_2').value;
		
		
		var mydata = {"cons_no": cons_no,"status": status,"shipper_pincode": shipper_pincode,"business_group": business_group,"sf_time": sf_time,"st_time": st_time};
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Courier/courier_search_ListJson4'); ?>",
			data: mydata,
			success: function (response) 
				{
					$("#example").html(response);
					//alert(response);
				}
		});			
	}
</script>

<!-- DATA TABES SCRIPT -->
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
			doc.save('courier_report.pdf');
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
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'colvis'
        ]
    } );
} );
</script>
<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>

