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
						<p><label>Ticket NO </label></p>
						<select class="form-control" name="ticket_no" id="ticket_no" style=" width:100% auto; ">
							<option value="">Ticket No Serch </option>
							<?php 
								$get_users = $this->db->group_by('ticket_no')->get_where('ticket_list');
								foreach($get_users->result() as $p){
									
									echo "<option value=".$p->ticket_no.">".$p->ticket_no."</option>";
								}
							?>
						</select>
				     </div>
					
						
					<div class="col-sm-3">
						<p><label>Business Name </label></p>
						<select class="form-control" name="business_id" id="business_id" style=" width:100% auto; ">
							<option value="">Business Name Search</option>
							<?php 
								$get_users = $this->db->group_by('business_id')->get('ticket_list');
								foreach($get_users->result() as $p){
									
									
									
									 echo "<option value=".$p->business_id.">".singleDbTableRow($p->business_id, 'business_groups')->business_name."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3">
						<p><label>Current Status </label></p>
						<select class="form-control" name="current_status" id="current_status" style=" width:100% auto; ">
							<option value="">Current Status Search</option>
							<?php 
								$get_users = $this->db->group_by('current_status')->get('ticket_list');
								foreach($get_users->result() as $p){
									
									echo "<option value=".$p->current_status.">".singleDbTableRow($p->current_status, 'status')->status."</option>";
								}
							?>
						</select>
					</div>
					
				<div class="col-sm-3">
						<p><label>Resolved By </label></p>
						<select class="form-control" name="modified_by" id="modified_by" style=" width:100% auto; ">
							<option value="">Resolved By Search</option>
							
						
							<?php 
								$get_users = $this->db->group_by('modified_by')->get_where('ticket_list', ['current_status'=>5]);
								foreach($get_users->result() as $p){
									
									echo "<option value=".$p->modified_by.">".singleDbTableRow($p->modified_by)->first_name." ".singleDbTableRow($p->modified_by)->last_name,"</option>";
								}
							?>
						</select>
					</div>
					
				<div class="col-sm-3">
				
						<p><label>Created By </label></p>
						<select class="form-control" name="created_by" id="created_by" style=" width:100% auto; ">
							<option value="">Created By Search</option>
							
							<?php 
								 
								 $get_users = $this->db->group_by('created_by')->get('ticket_list');
								foreach($get_users->result() as $p){
									echo "<option value=".$p->created_by.">".singleDbTableRow($p->created_by)->first_name." ".singleDbTableRow($p->created_by)->last_name,"</option>";
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
						<button type="button" class="btn warning" onClick="location.reload()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-undo"></i> Reset </button>
					</div>
				</div>
				
			</div><!-- /.box-header -->
			<div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
				<div class="row" style="padding:10px;">
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-success btn-sm btn-flat" id="create_pdf" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-pdf-o"></i> Download PDF</button>
						&nbsp;
						<button type="button" class="btn btn-warning btn-sm btn-flat" onclick="CSV.begin('#example').download('support_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			  <div  id="excel_table" class="box-body" style="overflow-x:scroll">
				<h3 class="box-title ">Please select by above search criteria</h3>
				     
                
					<table id="example" class="table table-bordered table-striped table-hover print_div" style="display:none;">
				
						<thead>
						<tr>
							    <th width="12%">Action</th>
								
								<th>Business Name</th>
								<th>Issue Type </th>
								<th>Ticket Number</th>
								<th>Currently With</th>
								<th>Issue Details</th>
								<th>Current Status</th>
								<th>Comments</th>
								<th>Created By</th>
								<th>Created At</th>
								<th>Modified By</th>
								<th>Modified At</th>
								
								
                        </tr>
						</thead>

						<tfoot>
							<tr>  <th width="12%">Action</th>
								
								<th>Business Name</th>
								<th>Issue Type </th>
								<th>Ticket Number</th>
								<th>Currently With</th>
								<th>Issue Details</th>
								<th>Current Status</th>
								<th>Comments</th>
								<th>Created By</th>
								<th>Created At</th>
								<th>Modified By</th>
								<th>Modified At</th>
								
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

<div class="container">
 
  
  

 
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Error</h4>
        </div>
        <div class="modal-body">
          <p>Slow Internet please wait.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
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
		$("#example").show();
		var ticket_no        = $("#ticket_no").val();
		var business_id		 = $("#business_id").val();
		var current_status	= $("#current_status").val();
		var modified_by	= $("#modified_by").val();
		var created_by	= $("#created_by").val();
	
		
		
		
		var sf_time=document.getElementById('some_class_1').value;
		var st_time=document.getElementById('some_class_2').value;
		
		var mydata = {"ticket_no": ticket_no,"business_id": business_id,"current_status": current_status,"modified_by": modified_by,"created_by": created_by,"sf_time": sf_time,"st_time": st_time};
		$(function() {
            $("#example").dataTable({
				"destroy": true,
                "processing": true,
                "serverSide": true,
				"ajax": {
            		"url": "<?php echo base_url('Support_report/assined_search_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
               
            });
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
			doc.save('support_reports.pdf');
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

