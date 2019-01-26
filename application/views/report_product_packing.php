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
						<p><label>Product Name</label></p>
						<select class="form-control" name="product_name" id="product_name" style=" width:100% auto; ">
							<option value="">Choose product</option>
							<?php 
								$get_users = $this->db->get_where('product_preparation');
								foreach($get_users->result() as $p){
									
									$name = $p->product_name;
									$id = $p->id;
								
									
									echo "<option value='".$id."'>".$id." - ".$name."</option>";
								}
							?>
						</select>
					</div>
					
					
					<div class="col-sm-3">
						<p><label>Prepaired By</label></p>
						<select class="form-control" name="prepaired_by" id="prepaired_by" style=" width:100% auto; ">
							<option value="">Choose Assistant</option>
							<?php 
								$get_users = $this->db->group_by('prepaired_by')->get_where('product_packing');
								foreach($get_users->result() as $p){
									
									$name = $p->prepaired_by;
									$id = $p->id;
									$get_name = $this->db->get_where('users',['id'=>$name]);
								foreach ($get_name->result() as $u)
								
								$fname = $u->first_name.' '.$u->last_name;
									
									echo "<option value='".$name."'> ".$fname."</option>";
								}
							?>
						</select>
					</div>
				
					
						
				<div class="col-sm-3">
						<p><label>Packed By</label></p>
						<select class="form-control" name="packed_by" id="packed_by" style=" width:100% auto; ">
							<option value="">Choose Assistant</option>
							<?php 
								$get_users = $this->db->group_by('created_by')->get('product_packing');
								foreach($get_users->result() as $p){
									
									$name = $p->created_by;
									$id = $p->id;
									$get_name = $this->db->get_where('users',['id'=>$name]);
								foreach ($get_name->result() as $u)
								
								$fname = $u->first_name.' '.$u->last_name;
									
									echo "<option value='".$name."'> ".$fname."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3">
						<p><label>Status</label></p>
						<select class="form-control" name="status" id="status" style=" width:100% auto; ">
							<option value="">Choose status</option>
							<?php 
								$get_users = $this->db->group_by('status')->get_where('product_packing');
								foreach($get_users->result() as $p){
									
									$name = $p->status;
									$id = $p->id;
								
									
									echo "<option value='".$name."'>".$name."</option>";
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
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('packing_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
				<div  class="box-body print_div" style="overflow-x:scroll">
				
				
				
				 <table id="example2" class="table table-bordered table-striped table-hover" style="display:none;">
						
						<div id="total"></div>
                        <thead>
                   <tr>
							<th  width="7%">Action</th>
							<th>Product</th>
							<th>Unique Preparation</th>
							<th>Prepaired By</th>
							<th>Status</th>
							<th>Packed By</th>	
							<th>Declared By</th>	
							<th>Declared Weight</th>
							<th>Weight Left For Packing</th>
							<th>Packed Weight</th>
                            <th>Unique Small</th>							
							<th>Pieces Packed Small</th>
							 <th>Unique Medium</th>
							<th>Pieces Packed Medium</th>
							<th>Unique Large</th>
							<th>Pieces Packed Large</th>
							<th>Unique Family</th>
							<th>Pieces Packed Family</th>
							<th>Unique Combo</th>
							<th>Pieces Packed Combo</th>
							<th>Packed Date</th>
							
						</tr>
                        </thead>
<!-- ListJson -->
                        <tfoot>
                      <tr>
							<th  width="7%">Action</th>
							<th>Product</th>
							<th>Unique Preparation</th>
							<th>Prepaired By</th>
							<th>Status</th>
							<th>Packed By</th>	
							<th>Declared By</th>	
							<th>Declared Weight</th>
							<th>Weight Left For Packing</th>
							<th>Packed Weight</th>
                            <th>Unique Small</th>							
							<th>Pieces Packed Small</th>
							 <th>Unique Medium</th>
							<th>Pieces Packed Medium</th>
							<th>Unique Large</th>
							<th>Pieces Packed Large</th>
							<th>Unique Family</th>
							<th>Pieces Packed Family</th>
							<th>Unique Combo</th>
							<th>Pieces Packed Combo</th>
							<th>Packed Date</th>
							
						</tr>
                        </tfoot>

                    </table>
				
				
				
				
				
				
				
				<div id="total_list"></div>
				
					<table id="example" class="table table-bordered table-striped table-hover print_div">
						<thead>
						<tr>
							<th  width="7%">Action</th>
							<th>Product</th>
							<th>Unique Preparation</th>
							<th>Prepaired By</th>
							<th>Status</th>
							<th>Packed By</th>	
							<th>Declared By</th>	
							<th>Declared Weight</th>
							<th>Weight Left For Packing</th>
							<th>Packed Weight</th>
                            <th>Unique Small</th>							
							<th>Pieces Packed Small</th>
							 <th>Unique Medium</th>
							<th>Pieces Packed Medium</th>
							<th>Unique Large</th>
							<th>Pieces Packed Large</th>
							<th>Unique Family</th>
							<th>Pieces Packed Family</th>
							<th>Unique Combo</th>
							<th>Pieces Packed Combo</th>
							<th>Packed Date</th>
							
						</tr>
						</thead>

						<tfoot>
							<tr>
						<th  width="7%">Action</th>
							<th>Product</th>
							<th>Unique Preparation</th>
							<th>Prepaired By</th>
							<th>Status</th>
							<th>Packed By</th>	
							<th>Declared By</th>	
							<th>Declared Weight</th>
							<th>Weight Left For Packing</th>
							<th>Packed Weight</th>
                            <th>Unique Small</th>							
							<th>Pieces Packed Small</th>
							 <th>Unique Medium</th>
							<th>Pieces Packed Medium</th>
							<th>Unique Large</th>
							<th>Pieces Packed Large</th>
							<th>Unique Family</th>
							<th>Pieces Packed Family</th>
							<th>Unique Combo</th>
							<th>Pieces Packed Combo</th>
							<th>Packed Date</th>
							
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

<script type="text/javascript">
	$(function() {
		$("#example").dataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "<?php echo base_url('Product_preparation/packing_ListJson'); ?>"
		});
	
	
	$.ajax({
			
			url: "<?php echo base_url('Product_preparation/get_total_list') ?>", 
			
			success: function (response) {
				//alert(ok);
				$("#total_list").html(response);
				
				
			}
		});	
	
	});
</script>

<script type="text/javascript">
	function search_result()
	{
		$("#example2").show();
		
		var product_name     = $("#product_name").val();
		var prepaired_by		 = $("#prepaired_by").val();
		var packed_by		 = $("#packed_by").val();
		var status		 = $("#status").val();
		var sf_time=document.getElementById('some_class_1').value;
		var st_time=document.getElementById('some_class_2').value;
		
		var mydata = {"product_name": product_name,"prepaired_by": prepaired_by,"packed_by": packed_by,"status": status,"sf_time": sf_time,"st_time": st_time};
		$(function() {
            $("#example2").dataTable({
				 "destroy": true,
                "processing": true,
                "serverSide": true,
		"ajax": {
			
			"url": "<?php echo base_url('Product_preparation/packing_search_ListJson'); ?>",
			"type":"POST",
			"data": mydata
		}
		});
		 });
		 
		$('#example').parents('div.dataTables_wrapper').first().hide();
		
		
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Product_preparation/get_total') ?>", 
			data: mydata,
			success: function (response) {
				//alert(ok);
				$("#total").html(response);
				
				
			}
		});	
		
		$('#total_list').hide();
		
		
		
			
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
			doc.save('packing_report.pdf');
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

