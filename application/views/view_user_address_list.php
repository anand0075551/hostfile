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
					<?php 
					$user_info = $this->session->userdata('logged_user');
					$user_id = $user_info['user_id'];
					$currentUser = singleDbTableRow($user_id)->role;
					if ($currentUser == 'admin')
					{
					 ?>
					<div class="col-sm-3">
						<p><label>Select User Id</label></p>
						<select class="form-control" name="user_id" id="user_id" style=" width:100% auto; ">
							<option value="">Choose User</option>
							<option value="">All</option>
							<?php 
								$get_users = $this->db->order_by('first_name','asc')->get('users');
								foreach($get_users->result() as $p){
									
									$name = $p->first_name.' '.$p->last_name;
									echo "<option value='".$p->id."'>".$name."</option>";
								}
							?>
						</select>
					</div>
					
					
						
					
					<div class="col-sm-3">
						<p><label>Select Address Type</label></p>
						<select class="form-control" name="address_type" id="address_type" style=" width:100% auto; ">
							<option value="">Choose Addres Type</option>
							<?php 
							
								$pincode = $this->db->get('status');
								foreach($pincode->result() as $p){
								
									
									echo "<option value='".$p->id."'>".$p->status."</option>";
								}
							?>
						
							
						</select>
					</div>
						
					<div class="col-sm-3">
						<p><label>Select Role Name</label></p>
						<select class="form-control" name="rolename" id="rolename" style=" width:100% auto; ">
							<option value="">Choose Role Name</option>
							<option value="">All</option>
							<?php 
								$get_users = $this->db->order_by('id','asc')->get('role');
								foreach($get_users->result() as $p){
									
									$name = $p->rolename;
									echo "<option value='".$p->id."'>".$name."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3">
						<p><label>Select District</label></p>
						<select class="form-control" name="district" id="district" style=" width:100% auto; ">
							<option value="">Choose District</option>
							<option value="">All</option>
							<?php 
								$pincode = $this->db->group_by('district')->get('user_address');
								foreach($pincode->result() as $p){
									
										echo "<option value='".$p->district."'>".$p->district."</option>";
								}
							?>
						</select>
						</div>	
						
						<div class="col-sm-3">
						<p><label>Select Location </label></p>
						<select class="form-control" name="location_id" id="location_id" style=" width:100% auto; ">
							<option value="">Choose Location</option>
							<option value="">All</option>
							<?php 
								$pincode = $this->db->group_by('location_id')->get('user_address');
								foreach($pincode->result() as $p){
									
										echo "<option value='".$p->location_id."'>".$p->location_id."</option>";
								}
							?>
						</select>
					</div>
						
					
					<div class="col-sm-3">
						<p><label>Select Pincode</label></p>
						<select class="form-control" name="pincode" id="pincode" style=" width:100% auto; ">
							<option value="">Choose pincode</option>
							<option value="">All</option>
							<?php 
								$pincode = $this->db->group_by('pincode')->get('user_address');
								foreach($pincode->result() as $p){
									
										echo "<option value='".$p->pincode."'>".$p->pincode."</option>";
								}
							?>
						</select>
					</div>	
					
					<div class="col-sm-3">
						<p><label>Select State</label></p>
						<select class="form-control" name="state" id="state" style=" width:100% auto; ">
							<option value="">Choose state</option>
							<option value="">All</option>
							<?php 
								$pincode = $this->db->group_by('state')->get('user_address');
								foreach($pincode->result() as $p){
									
										echo "<option value='".$p->state."'>".$p->state."</option>";
								}
							?>
						</select>
					</div>	
					
					
					
						<div class="col-sm-3">
								<p><label>From Date</label></p>
								<input type="text"  class="some_class form-control" style="height:30px;" value="" id="some_class_1" name="sf_time"  placeholder="From"/>
						</div>
							
						<div class="col-sm-3">
							<p><label>To Date</label></p>
							<input type="text"  class="some_class form-control" style="height:30px;" value="" id="some_class_2" name="st_time"  placeholder="To"/>
						</div>
					
					<?php
					}
					  else { ?>
					
					
					<div class="col-sm-3">
						<p><label>Search By Business</label></p>
						<select  class="form-control" name="address_type" id="address_type" style=" width:100% auto; ">
							<option value="">Choose Business Type</option>
							<?php 
							
								$pincode = $this->db->get_where('status', ['business_name'=>19]);
								foreach($pincode->result() as $p){
								
									
									echo "<option value='".$p->id."'>".$p->status."</option>";
								}
							?>
						
							
						</select>
					</div>
					
					
						<div class="col-sm-3">
								<p><label>Search By Pincode</label></p>
								<input type="number"  class="form-control" style="height:30px;" value="" id="pincode" name="pincode"  placeholder="Search Address By Pincode"/>
						</div>
					
					
					<?php } ?>
				<div class="row" style="padding:10px;">
					
					

					
					
					<div class="col-sm-3">
							<!--<p><label>From Date</label></p>-->
							<input type="hidden" id="rolename" class="some_class form-control" style="height:30px;" value="" id="some_class_1" name="sf_time"  placeholder="From"/>
					</div>
					
				
				</div>
			
					<div class="row" style="padding:10px;">
					
						<div class="col-sm-3">
							<!--<p><label>From Date</label></p>-->
							<input type="hidden"  class="some_class form-control" style="height:30px;" value="" id="some_class_1" name="sf_time"  placeholder="From"/>
					</div>
						
						<div class="col-sm-3">
							<!--<p><label>To Date</label></p>-->
							<input type="hidden"  class="some_class form-control" style="height:30px;" value="" id="some_class_2" name="st_time"  placeholder="To"/>
						</div>

					</div>
				
				<div class="row" style="padding:10px;">
					<div class="col-sm-3"></div>
					<div class="col-sm-3"><label class="text-red" id="status" style="display:none">Enter Your Area PINCODE !</label></div>
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
				
				 <h3 class="box-title ">Please select by above search criteria</h3> <br> <br> <br>
					<table id="example2" class="table table-bordered table-striped table-hover print_div" style="display:none;">
						<thead>
						<tr>
							 
						    <!--<th width="10%">Action</th>-->
                            <th>Firm Name</th>
                            <th>Business Name</th>
							
							<th>House Building Number</th>
							<th>Street Name</th>
							<th>Location Name</th>
							<th>Land Mark</th>
							<th> Pincode </th>
							<?php if($currentUser == 'admin') {?>
							<!--<th> Phone Number </th>-->
							<!--<th>Taluk</th>-->
							<th>District</th>
							<th>State</th>
							<th>Country</th>
					
							<th> Role Name </th>
							<th>Created Date</th>
							<th>Created By</th>
							<th>Modified Date</th>
							<th>Modified By</th>
					<?php } ?>
						</tr>
						</thead>

						

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
		var user_id      		 = $("#user_id").val();
		var pincode		 		 = $("#pincode").val();
		var state				 = $("#state").val();
		var district			 = $("#district").val();
		var location_id			 = $("#location_id").val();
		var rolename			 = $("#rolename").val();
		var address_type		 = $("#address_type").val();
		var sf_time=document.getElementById('some_class_1').value;
		var st_time=document.getElementById('some_class_2').value;

		var sts = true;
		
		if(pincode == "" ){
			$("#status").fadeIn();
		}
		
		
		else if(pincode != "" ){
			$("#status").fadeOut();
			var mydata = {"user_id": user_id,"pincode": pincode,"state":state, "district":district, "location_id":location_id,"rolename":rolename,"address_type":address_type, "sf_time": sf_time,"st_time": st_time};
			$(function() {
				$("#example2").dataTable({
					"destroy": true,
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "<?php echo base_url('User_address_report/search_user_address_ListJson'); ?>",
						"type":"POST",
						"data": mydata
					 }
				   
				});
			});	
		}
			
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
<!--
<script>
document.getElementById("required").attributes["required"] = "";
</script>	-->

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>

