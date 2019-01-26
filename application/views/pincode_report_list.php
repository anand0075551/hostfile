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
	
	
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/datatable.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/datatable_bootstrap.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/sort.js'); ?>"></script>
	
	
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
						<p><label>Select Visitor Name.</label></p>
						<select class="form-control" name="visitor" id="visitor" style=" width:100% auto; ">
							<option value="">Choose Visitor Name.</option>
							<option value="" >All</option>
							<?php 
								$get_name = $this->db->group_by('visitor_name')->get_where('visitors_details');
								foreach($get_name->result() as $p)
								{
									$name = $p->visitor_name;
									
									echo "<option value=".$name.">".$p->visitor_name."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3"> 
						<p><label>Type Of Entry.</label></p>
						<select class="form-control" name="type_of_entry" id="type_of_entry" style=" width:100% auto; ">
							<option value="">Choose Type Of Entry.</option>
							<option value="" >All</option>
							<option value="Inward" >Inward</option>
							<option value="Outward" >outward</option>
							<option value="Visitors" >Visitor</option>
							
						</select>
					</div>
				
					<div class="col-sm-3">
						<p><label>Select Mobile Number</label></p>
						<select class="form-control" name="mobile_no" id="mobile_no" style=" width:100% auto; ">
							<option value="">Choose Mobile Number</option>
							<option value="" >All</option>
							<?php 
							
								$get_users = $this->db->group_by('mobile_no')->order_by('mobile_no','asc')->get_where('visitors_details');
								foreach($get_users->result() as $p)
								{
									$name = $p->mobile_no;
									
									echo "<option value='".$name."'>".$p->mobile_no."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3">
						<p><label>Select Purpose</label></p>
						<select class="form-control" name="purpose" id="purpose" style=" width:100% auto; ">
							<option value="">Choose Purpose</option>
							<option value="" >All</option>
							<?php 
							
								$get_users = $this->db->group_by('purpose')->order_by('purpose','asc')->get_where('visitors_details');
								foreach($get_users->result() as $p)
								{
									$name = $p->purpose;
									
									echo "<option value='".$name."'>".$p->purpose."</option>";
								}
							?>
						</select>
					</div>
					
					
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
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example2').download('visitor_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
			<!-- Search table-->
			
			 
			<div class="box-body table-responsive " id="excel_table">
				
				<div class="box-body print_div" style="overflow-x:scroll">
					<div id="total"></div>
                    <h3 class="box-title ">Please select by above search criteria</h3>
					<table id="example2" class="table table-bordered table-striped table-hover " style="display:none">
					<thead>
						<tr>
								<th width="7%">Action</th>
								<th>Created Date</th>   
								<th>Type Of Selection</th> 
								<th>Invoice Id</th>  
								<th>Vsitor Name</th>								
								<th>Item Name</th>
								<th>purpose</th>
								<th>Email Id</th>
								<th>Mobile Number</th>
								<th>Typ Of Id</th>   
								<th>Type of Item</th>
								<th>Item Number</th>
								<th>Proof Number</th>
								<th>Item Value</th>
								<th>From Place</th>
								<th>To Receiver</th>
								<th>Refferer</th>
								<th>Whom To Meet</th>
								<th>To Whom</th>
								<th>From Whom </th>
								<th>From Sender</th>
								<th>Remarks</th>
								<th>Created By</th>
								<th>Modified At</th> 
								<th>Modified By</th>
								
                        </tr>	
						</thead>

						<tfoot>
							<tr>
								<th width="7%">Action</th>
								<th>Created Date</th>   
								<th>Type Of Selection</th> 
								<th>Invoice Id</th>  
								<th>Vsitor Name</th>								
								<th>Item Name</th>
								<th>purpose</th>
								<th>Email Id</th>
								<th>Mobile Number</th>
								<th>Typ Of Id</th>   
								<th>Type of Item</th>
								<th>Item Number</th>
								<th>Proof Number</th>
								<th>Item Value</th>
								<th>From Place</th>
								<th>To Receiver</th>
								<th>Refferer</th>
								<th>Whom To Meet</th>
								<th>To Whom</th>
								<th>From Whom </th>
								<th>From Sender</th>
								<th>Remarks</th>
								<th>Created By</th>
								<th>Modified At</th> 
								<th>Modified By</th>
                        </tr>
						</tfoot>

					
				</table>
				</div>
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


<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script type="text/javascript">
	function search_result()
	{
		$("#example2").show();
		var visitor      			= $("#visitor").val();
		var type_of_entry		 	= $("#type_of_entry").val();
		var mobile_no		 		= $("#mobile_no").val();
		var purpose		 			= $("#purpose").val();
		var sf_time=document.getElementById('some_class_1').value;
		var st_time=document.getElementById('some_class_2').value;
		
		var mydata = {"visitor": visitor,"type_of_entry": type_of_entry,"mobile_no": mobile_no,"purpose": purpose,"sf_time": sf_time,"st_time": st_time};
		
		$(function() {
            $("#example2").dataTable({
				"destroy": true,
                "processing": true,
                "serverSide": true,
				"ajax": {
            		"url": "<?php echo base_url('Visitor_entry/visitor_entry_search_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
               
            });
        });	
		
		/*$.ajax({
			type: "POST",
			url: "<?php echo base_url('vch_food_rpt/get_total') ?>", 
			data: mydata,
			success: function (response) {
				$("#total").html(response);
				
				
			}
		});*/
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
			doc.save('Visitor Report.pdf');
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

<?php } ?>

