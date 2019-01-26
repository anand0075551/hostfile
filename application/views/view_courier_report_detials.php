<?php function page_css(){ ?>
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
	<link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	
	
	
<?php } ?>
<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
		<div class="box">
			<div class="box-header"  style=" background-image: url(<?php echo base_url('uploads/rep/cms5.jpg')  ?>);">
				<div class="row" style="padding:10px;">
					
					<div class="col-sm-3">
						<p><label>Select Consignment No</label></p>
						<select class="form-control" name="cons_no" id="cons_no" style=" width:100% auto; ">
							<option value="">Choose Consignment Number</option>
							<option value="">All</option>
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
							<option value="">All</option>
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
							<option value="">All</option>
							<?php 
								$get_users = $this->db->group_by('shipper_pincode')->order_by('shipper_pincode','asc')->get_where('cms_courier');
								foreach($get_users->result() as $p){
									
									
									$name = $p->shipper_pincode;
													$query2 = $this->db->get_where('pincode', ['id' => $name,]);
				if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $row2) {
						$pincode = $row2->pincode;
				}
				} else {
					$pincode =  " ";
				}
										echo "<option value='".$p->shipper_pincode."'>".$pincode."</option>";
								}
							?>
						</select>
					</div>	
					
					<div class="col-sm-3">
						<p><label>Select Business Name</label></p>
						<select class="form-control" name="business_group" id="business_group" style=" width:100% auto; ">
							<option value="">Choose Business Name</option>
							<option value="">All</option>
							<?php 
								$get_paytype = $this->db->order_by('business_name','asc')->get_where('business_groups');
								foreach($get_paytype->result() as $p){
									$user_id = $p->id;
									$name = $p->business_name;
									$id= $p->id;
									
									echo "<option value='".$user_id."'>".$id."-".$name."</option>";
								}
							?>
						</select>
					</div>
						
					
					
					
				</div>
			
					<div class="row" style="padding:10px;">
					
					<div class="col-sm-3">
						<p><label>Shipper Name & Number</label></p>
						<select class="form-control" name="number" id="number" style=" width:100% auto; ">
							<option value="">Choose Shipper Name & Number</option>
							<option value="">All</option>
							

							
							<?php 
								$get_users = $this->db->group_by('phone')->get_where('cms_courier');
								foreach($get_users->result() as $p){
									$ship_name = $this->db->group_by('first_name')->get_where('users');
									foreach($ship_name->result() as $q)
									{
									$name = $p->phone."-".$q->first_name. ' ' .$q->last_name;
									
									echo "<option value='".$p->phone."'>".$name."</option>";
								}
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3">
						<p><label>Recevier Name & Number</label></p>
						<select class="form-control" name="rnumber" id="rnumber" style=" width:100% auto; ">
							<option value="">Choose Receiver Name & Number</option>
							<option value="">All</option>
							
							<?php 
								$get_paytype = $this->db->order_by('r_phone','asc')->get_where('cms_courier');
								foreach($get_paytype->result() as $p){
									$user_id = $p->rev_name;
									$name = $p->r_phone;
									$id= $p->rev_name;
									
									echo "<option value='".$p->r_phone."'>".$id."-".$name."</option>";
								}
							?>
						</select>
					</div>
					
				
					
					<div class="col-sm-3">
						<p><label>From Date</label></p>
						<input type="text" class="some_class form-control" style="height:30px;" value="" id="some_class_1" name="sf_time"  placeholder="From Date"/>
					</div>
					
					<div class="col-sm-3">
						<p><label>To Date</label></p>
						<input type="text" class="some_class form-control" style="height:30px;" value="" id="some_class_2" name="st_time"  placeholder="To Date"/>
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
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example2').download('courier_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
				<div  id="excel_table" class="box-body" style="overflow-x:scroll">
				<div id="total" class="table-bordered"></div>
				 <h3 class="box-title ">Please select by above search criteria</h3>
					<table id="example2" class="table table-bordered table-striped table-hover print_div" style="display:none;">
						<thead>
						<tr>
							 <tr>
						    <th width="10%">Action</th>
                            <th>Consignment No</th>
							<th>Shipper Info</th>
							<th>Receiver Info</th>
							
							
						
							
							<th>Type</th>
							<th>Cost</th>
							<th>Weight</th>
							<th>SMB Weight(Kg)</th>
							<th>SMB Volume(cm^3)</th>
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
							<th>Shipper Info</th>
							<th>Receiver Info</th>
							
							<th>Type</th>
							<th>Cost</th>
							<th>Weight</th>
						    <th>SMB Weight(Kg)</th>
							<th>SMB Volume(cm^3)</th>
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

<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>


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
	function search_result()
	{
                  
		$("#example2").show();
		var cons_no      		 = $("#cons_no").val();
		var status		 		 = $("#status").val();
		
		var shipper_pincode		 = $("#shipper_pincode").val();
		var business_group		 = $("#business_group").val();
		var number				 = $("#number").val();
		var rnumber				 = $("#rnumber").val();
			var sf_time=document.getElementById('some_class_1').value;
			var st_time=document.getElementById('some_class_2').value;
		
		
		var mydata = {"cons_no": cons_no,"status": status,"shipper_pincode": shipper_pincode,"business_group": business_group,"number":number,"rnumber":rnumber, "sf_time": sf_time,"st_time": st_time};
		$(function() {
            $("#example2").dataTable({
                  "destroy": true,
                  "paging": true,
                  "ordering": true,
                  "info": true,
				"ajax": {
            		"url": "<?php echo base_url('Courier_report_detials/courier_search_ListJson4'); ?>",
					"type":"POST",
					"data": mydata
       			 }
               
            });
        });	

			$.ajax({
			type: "POST",
			url: "<?php echo base_url('Courier_report_detials/get_total') ?>", 
			data: mydata,
			success: function (response) {
				$("#total").html(response);
			}
		});
	}
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

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>
<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>



<?php } ?>

