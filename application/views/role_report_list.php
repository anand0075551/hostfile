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
			<div class="box-body">
				<div class="row" style="padding:10px;">
				
			
				
				
					<div class="col-sm-3"> 
						<p><label>Select Role Group</label></p>
							<select name="to_user1" id="to_user1" class="form-control" style="width:100% auto;"onchange="get_role(this.value)">
										<option value=""> Choose option </option>
										<option value="1"> Management </option>
										<option value="2"> Managers </option>
										<option value="3"> Business Agents </option>
										<option value="4"> Users </option>
										
									</select>	        
					</div>
			<div class="col-sm-3" id ="district_div1" style="display:none"> 
						<p><label>Select Role</label></p>
							<select name="assigned_role" id="assigned_role" class="form-control" style="width:100% auto;">
										<option value=""> Choose option </option>
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
				
				<div class="row" style="padding:10px;">
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-primary btn-sm btn-flat" id="create_pdf" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-pdf-o"></i> Download PDF</button>
						&nbsp;
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('accounts_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
				  </div>
				</div>
			  </div>
			</div>
			<div class="row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
		<a class="btn btn-warning btn-lg" href="<?php echo base_url('Role_report/add_role'); ?>" data-toggle="tooltip" title="Add New Roles">
					<i class="fa fa-plus"></i>Add New Roles </a>
					</div>
					</div>
			<!--Search result table -->
			 <div class="col-md-12">
               <div class="box">
                <div class="box-body print_div" style="overflow-x:scroll">
				<div id="total"></div>
					<table id="example" class="table table-bordered table-striped table-hover" style="display:none;">
						<thead>
						<tr>
								<th width="20%">Action</th>
								<th>Id</th>   
								<th>Rolename</th> 
								<th>Roleid</th>  							
								<th>Role Groups</th>
								<th>fees</th>
								<th>Dedfees Payspec</th>
								<th>Comfees Payspec</th>
								<th>Com Per</th>   
								<th>Parent</th>
								<th>Active</th>
								<th>Permission Id</th>
								<th>Type</th>
								<th>Edit</th>
								<th>Default</th>
								<th>Created By</th>
								<th>Created At</th>
								<th>Modified At</th>
								
								
                        </tr>	
						</thead>

						<tfoot>
							<tr>
								<th width="20%">Action</th>
								<th>Id</th>   
								<th>Rolename</th> 
								<th>Roleid</th>  							
								<th>Role Groups</th>
								<th>fees</th>
								<th>Dedfees Payspec</th>
								<th>Comfees Payspec</th>
								<th>Com Per</th>   
								<th>Parent</th>
								<th>Active</th>
								<th>Permission Id</th>
								<th>Type</th>
								<th>Edit</th>
								<th>Default</th>
								<th>Created By</th>
								<th>Created At</th>
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
		
		var assigned_role      			= $("#assigned_role").val();
		var to_user1      			    = $("#to_user1").val();
		
		var sf_time          =document.getElementById('some_class_1').value;
		var st_time          =document.getElementById('some_class_2').value;
		
		var mydata = {"assigned_role": assigned_role,"to_user1": to_user1,"sf_time": sf_time,"st_time": st_time};
		
		$(function() {
            $("#example").dataTable({
				"destroy": true,
                "processing": true,
                "serverSide": true,
				"ajax": {
            		"url": "<?php echo base_url('Role_report/Role_search_ListJson'); ?>",
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


<script>
	function get_role(id)
{
 // alert(id);
 if(id==""){
        $("#district_div1").fadeOut(1000);
    }
    else{ 
	var mydata = {"to_role": id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Role_report/get_user2') ?>",
		data: mydata,
		success: function (response) {
			$("#assigned_role").html(response);
		
		}
	});
	 $("#district_div1").fadeIn(1000); 
	}
}





</script>



<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>

<html><head></head><body></body></html>