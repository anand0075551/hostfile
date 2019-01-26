<?php function page_css(){ ?>
    <!-- datatable css -->
   <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
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
		<div class="box box-primary">
			<div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
				
			
				
			</div><!-- /.box-header -->
			<div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
				<div class="row" style="padding:10px;">
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-primary btn-sm btn-flat" id="create_pdf" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-pdf-o"></i> Download PDF</button>
						&nbsp;
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('Education Details.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
	
			<div class="box-body table-responsive">
				<div  id="excel_table" class="box-body">
					<table id="example" class="table table-bordered table-striped table-hover print_div">
						<thead>
						 <tr>
                                <th width="20%">Action</th>                         
                                <th>id</th>                            
                                <th>Type</th>                            
                                <th>Store Id</th>                            
                                <th>item</th>                            
                                <th>category</th>
                                <th>sub_category</th>
                                <th>brand</th>
                                <th>product_unique_code</th>
							    <th>inward</th>
                                <th>Outward</th>
                                <th>Assigned By</th>
                                <th>Assigned To</th>
								<th>balance_qty_in_stock</th>
                                <th>product_manufacturing_date</th>
                                <th>Product_expiry_date</th>                            
                                <th>Weight</th>
                                <th>quantity</th>
                               
                                <th>price_per_unit</th>	
                                <th>tax1_per_unit</th>
                                <th>tax2_per_unit</th>
                                <th>tax3_per_unit</th>
                                <th>shipping1_per_unit</th>
                                <th>shipping2_per_unit</th>
                                <th>shipping3_per_unit</th>
                                <th>sub_total_price</th>
                                <th>grand_total</th>
                                <th>area_location_name</th>
                                <th>location_pincode</th>
                                <th>supplier_name</th>
                                <th>supplier_id</th>
                                <th>supplier_invoice_no</th>
                                <th>compartment1</th>
                                <th>compartment2</th>
                                <th>compartment3</th>
                                <th>compartment4</th>
                                <th>compartment5</th>
                                <th>added By</th>
                                <th>Creation Date</th>
                                
                               

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
	$(function() {
		$("#example").dataTable({
			
			 "paging": true,
                  "ordering": true,
                  "info": true,				  
				  "destroy": true,
			"ajax": "<?php echo base_url('Product_preparation/available_stock_inventory_ListJson'); ?>"
		});
	});

</script>


<script type="text/javascript">
	function search_result()
	{
		var product          = $("#product").val();
		
		var declared_by		 = $("#declared_by").val();
		
		
		var mydata = {"product": product,"declared_by": declared_by};
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Product_preparation/assigned_product_search_ListJson'); ?>",
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
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>


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
			doc.save('Education Details.pdf');
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

