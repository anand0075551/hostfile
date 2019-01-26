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
						<p><label>Status</label></p>
						<select class="form-control" name="status" id="status" style=" width:100% auto; ">
							<option value="">Choose Status</option>
							<option value="" >All</option>
							<?php 
								$get_users = $this->db->group_by('status')->get_where('billpay_status');
								foreach($get_users->result() as $p){
									
									
									
									echo "<option value=".$p->status.">".$p->status."</option>";
								}
							?>
						</select>
				</div>
					
						
					<div class="col-sm-3">
						<p><label>Account No</label></p>
						<select class="form-control" name="usertxn" id="usertxn" style=" width:100% auto; ">
							<option value="">Choose Account No</option>
							<option value="" >All</option>
							<?php 
								$get_users = $this->db->group_by('usertxn')->get_where('billpay_status');
								foreach($get_users->result() as $p){
									
									$name = $p->usertxn;
									
								
									
									echo "<option value=".$name.">".$name."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3">
						<p><label>Operator</label></p>
						<select class="form-control" name="operator" id="operator" style=" width:100% auto; ">
							<option value="">Choose Operator</option>
							<option value="" >All</option>
							<?php 
				$get_users = $this->db->get_where('services');
								
								
								foreach($get_users->result() as $p){
									
									echo "<option value=".$p->jolo_code.">".$p->jolo_code.'--'.$p->opt_name."</option>";
									
								}
							?>
						</select>
					</div>
					
						
					<div class="col-sm-3">
						<p><label>Transaction ID</label></p>
						<select class="form-control" name="txid" id="txid" style=" width:100% auto; ">
							<option value="">Choose Transaction ID</option>
							<option value="" >All</option>
							<?php 
								$get_users = $this->db->group_by('txid')->get_where('billpay_status');
								foreach($get_users->result() as $p){
									
									$name = $p->txid;
									
								
									
									echo "<option value=".$name.">".$name."</option>";
								}
							?>
						</select>
					</div>
					
					
					
					
					
					</div>
					
					<div class="row" style="padding:10px;">
					
					<div class="col-sm-3">
						<p><label>Mobile Number</label></p>
						<select class="form-control" name="number" id="number" style=" width:100% auto; ">
							<option value="">Choose Mobile No.</option>
							<option value="" >All</option>
							<?php 
								$get_users = $this->db->group_by('number')->get_where('billpay_status');
								foreach($get_users->result() as $p){
									
									$name = $p->number;
									
								
									
									echo "<option value=".$name.">".$name."</option>";
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
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example2').download('billpay_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
			
				<div class="box-body table-responsive " id="excel_table">
				
				<div class="box-body print_div" style="overflow-x:scroll">
                    <h3 class="box-title ">Please select by above search criteria</h3>
                    <div id="total_bill"></div>
					<table id="example2" class="table table-bordered table-striped table-hover" style="display:none">
				
                        <thead>
                        <tr>
						    <th width="7%">Action</th>
								<th>Status</th>  
								<th>Transaction ID</th>  
								<th>Operator Name</th>
								<th>Amount</th>   
								<th>Unique Transaction Id</th>
								<th>Operator Reference ID </th>     
								<th>Country</th>
								<th>Number</th>  
								<th>Amount_deducted</th>
								<th>Message</th>   
								<th>Time</th>
							    <th>Recharge Done By</th> 
								<th>Created_at</th>
							    <th>Error_code</th>
                        </tr>
                        </thead>
<!-- ListJson -->
                        <tfoot>
                        <tr>
						   <th width="7%">Action</th>
								<th>Status</th>  
								<th>Transaction ID</th>  
								<th>Operator Name</th>
								<th>Amount</th>   
								<th>Unique Transaction Id</th>
								<th>Operator Reference ID </th>     
								<th>Country</th>
								<th>Number</th>  
								<th>Amount_deducted</th>
								<th>Message</th>   
								<th>Time</th>
							    <th>Recharge Done By</th> 
								<th>Created_at</th>
							    <th>Error_code</th>
                        </tr>
                        </tfoot>

                    </table>
                  </div>
                  </div>
                  </div>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
			
    </div>
</div>
</section>
</div>

<?php function page_js(){ ?>

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
		var status      = $("#status").val();
		var usertxn		 = $("#usertxn").val();
		var operator		 = $("#operator").val();
		var txid		 = $("#txid").val();
		var number		 = $("#number").val();
		var sf_time=document.getElementById('some_class_1').value;
		var st_time=document.getElementById('some_class_2').value;
		
		var mydata = {"status": status,"usertxn": usertxn,"operator": operator,"txid": txid,"number": number,"sf_time": sf_time,"st_time": st_time};
		
		$(function() {
            $("#example2").dataTable({
				 "paging": true,
                  "ordering": true,
                  "destroy": true,
                  "info": true,
				"ajax": {
            		"url": "<?php echo base_url('Billpayment_Status/billpayment_search_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
               
            });
        });	
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Billpayment_Status/get_billpay_total') ?>", 
			data: mydata,
			success: function (response) {
				$("#total_bill").html(response);
				
				
			}
		});	
	}
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
			doc.save('billpayment status_reports.pdf');
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

