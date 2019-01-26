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
						<p><label>Mobile No.</label></p>
						<select class="form-control" name="contactno" id="contactno" style=" width:100% auto; ">
							<option value="">Choose Mobile No.</option>
							<option value="" >All</option>
							<?php 
								$get_users = $this->db->group_by('contactno')->get_where('bank');
								foreach($get_users->result() as $p){
									
									
									
									echo "<option value=".$p->contactno.">".$p->contactno."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3">
						<p><label>Transaction Type</label></p>
						<select class="form-control" name="transaction_type" id="transaction_type" style=" width:100% auto; ">
							<option value="">Choose Transaction Type</option>
							<option value="" >All</option>
							<?php 
								$get_users = $this->db->group_by('transaction_type')->get_where('bank');
								foreach($get_users->result() as $p){
									
									
									
									echo "<option value=".$p->transaction_type.">".$p->transaction_type."</option>";
								}
							?>
						</select>
					</div>
					
					
					<div class="col-sm-3">
						<p><label>Cfirst Account</label></p>
						<select class="form-control" name="ifsc_code" id="ifsc_code" style=" width:100% auto; ">
							<option value="">Choose Cfirst Account IFSC</option>
							<option value="" >All</option>
							<?php 
								$get_users = $this->db->group_by('ifsc_code')->get_where('bank');
								foreach($get_users->result() as $p){
									
									
									
									echo "<option value=".$p->ifsc_code.">".$p->ifsc_code."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3">
						<p><label>Select Rolename</label></p>
						<select class="form-control" name="rolename" id="rolename" style=" width:100% auto; ">
							<option value="">Choose Rolename</option>
							<option value="" >All</option>
							<?php 
								$get_users = $this->db->order_by('rolename','asc')->get_where('role');
								foreach($get_users->result() as $p){
									$user_id = $p->id;
									$name = $p->rolename;
									$id = $p->id;
								
									
									echo "<option value='".$user_id."'>".$id." - ".$name."</option>";
								}
							?>
						</select>
					</div>
					
					</div>
					
					<div class="row" style="padding:10px;">
					
						<div class="col-sm-3">
						<p><label>Referredby Code</label></p>
						<select class="form-control" name="referredByCode" id="referredByCode" style=" width:100% auto; ">
							<option value="">Choose Referredby Code </option>
							<option value="" >All</option>
							<?php 
								$get_users = $this->db->group_by('referredByCode')->get_where('bank');
								foreach($get_users->result() as $p){
									
									
									
									echo "<option value=".$p->referredByCode.">".$p->referredByCode."</option>";
								}
							?>
						</select>
					</div>
					
						
					
					
						<div class="col-sm-3">
						<p><label>Receiver's IFSC</label></p>
						<select class="form-control" name="bank_ifscode" id="bank_ifscode" style=" width:100% auto; ">
							<option value="">Choose Receiver's IFSC</option>
							<option value="" >All</option>
							<?php 
								$get_users = $this->db->group_by('bank_ifscode')->get_where('bank');
								foreach($get_users->result() as $p){
									
									
									
									echo "<option value=".$p->bank_ifscode.">".$p->bank_ifscode."</option>";
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
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example2').download('bank_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
			<!-- Search table-->
			
			 
			<div class="box-body table-responsive " id="excel_table">
				
				<div class="box-body print_div" style="overflow-x:scroll">
                    <h3 class="box-title ">Please select by above search criteria</h3>
					<div id="total_amount"></div>
					<table id="example2" class="table table-bordered table-striped table-hover " style="display:none">
					<thead>
						<tr>
								<th width="7%">Action</th>
									<th>First Name</th>
								<th>Last Name</th>  
								<th>Email</th>
								<th>Contact No</th>   
								<th>Transaction ID</th>
								<th>Transaction Type</th>     
								<th>IFSC Code</th>
								<th>Transaction Date</th>  
								<th>Postal Code</th>
								<th>Aadhaar No.</th>   
								<th>Passport No.</th>
								<th>Rolename</th> 
								<th>Active</th>
								<th>Referral code</th>
								<th>Account no.</th>
								<th>Amount</th>   
								<th>Referredby Code</th>
								<th>Challan</th>     
								<th>Company Name</th>
								<th>Bank Name</th>  
								<th>Bank Account Type</th>
								<th>Bank Account</th>   
								<th>Bank Address</th>
								<th>Pan No.</th> 
								<th>Bank ISFCode</th>
								<th>Created By</th>
								 <th>Created at</th>
								<th>Modified at</th>
                        </tr>
						</thead>

						<tfoot>
							<tr>
								<th width="7%">Action</th>
								<th>First Name</th>
								<th>Last Name</th>  
								<th>Email</th>
								<th>Contact No</th>   
								<th>Transaction ID</th>
								<th>Transaction Type</th>     
								<th>IFSC Code</th>
								<th>Transaction Date</th>  
								<th>Postal Code</th>
								<th>Aadhaar No.</th>   
								<th>Passport No.</th>
								<th>Rolename</th> 
								<th>Active</th>
								<th>Referral code</th>
								<th>Account no.</th>
								<th>Amount</th>   
								<th>Referredby Code</th>
								<th>Challan</th>     
								<th>Company Name</th>
								<th>Bank Name</th>  
								<th>Bank Account Type</th>
								<th>Bank Account</th>   
								<th>Bank Address</th>
								<th>Pan No.</th> 
								<th>Bank ISFCode</th>
								<th>Created By</th>
								 <th>Created at</th>
								<th>Modified at</th>
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
		var contactno      = $("#contactno").val();
		var transaction_type = $("#transaction_type").val();
		var ifsc_code		 = $("#ifsc_code").val();
		var rolename		 = $("#rolename").val();
		var referredByCode		 = $("#referredByCode").val();
		var bank_ifscode		 = $("#bank_ifscode").val();
		var sf_time=document.getElementById('some_class_1').value;
		var st_time=document.getElementById('some_class_2').value;
		
		var mydata = {"contactno": contactno,"transaction_type": transaction_type,"ifsc_code": ifsc_code,"rolename": rolename,"referredByCode": referredByCode,"bank_ifscode": bank_ifscode,"sf_time": sf_time,"st_time": st_time};
		
		$(function() {
            $("#example2").dataTable({
				"destroy": true,
                "processing": true,
                "serverSide": true,
				"ajax": {
            		"url": "<?php echo base_url('Bank/bank_search_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
               
            });
        });	
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Bank/get_total_amount') ?>", 
			data: mydata,
			success: function (response) {
				$("#total_amount").html(response);
				
				
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
			doc.save('bank details.pdf');
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

