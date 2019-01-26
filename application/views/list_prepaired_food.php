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
				<div  id="excel_table" class="box-body">
					<table id="example" class="table table-bordered table-striped table-hover print_div">
						<thead>
						<tr>
							<th  width="7%">Action</th>
							<th>Product </th>
							<th>Expiry Date</th>
							<th>Total Output</th>
							<th>Unique Preparation</th>	
							<th>Prepaired By</th>
							<th>Declared By</th>
							<th>Creation Date</th>	
						</tr>
						</thead>

						<tfoot>
						<tr>
							<th  width="7%">Action</th>
							<th>Product </th>
							<th>Expiry Date</th>
							<th>Total Output</th>
							<th>Unique Preparation</th>	
							<th>Prepaired By</th>
							<th>Declared By</th>
							<th>Creation Date</th>	
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
	$(function() {
		$("#example").dataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "<?php echo base_url('Product_preparation/ingredients_used_ListJson'); ?>"
		});
	});

</script>

<script type="text/javascript">
	function search_result()
	{
		var product      = $("#product").val();
		var used_by		 = $("#used_by").val();
		var sf_time=document.getElementById('some_class_1').value;
		var st_time=document.getElementById('some_class_2').value;
		
		var mydata = {"product": product,"used_by": used_by,"sf_time": sf_time,"st_time": st_time};
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Product_preparation/usedProducts_search_ListJson'); ?>",
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
			doc.save('used_ingredients.pdf');
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

