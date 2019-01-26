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
						<p><label>Select Category</label></p>
						<select class="form-control" name="category" id="category" style=" width:100% auto; ">
							<option value="">Choose Category</option>
							<?php 
								$get_product = $this->db->get_where('smb_category');
								foreach($get_product->result() as $p){
									echo "<option value='".$p->id."'>".$p->category_name."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3">
						<p><label>Sub Category</label></p>
						<select class="form-control" name="sub_categoty" id="sub_categoty" style=" width:100% auto; ">
							<option value="">Choose Product</option>
							<?php 
								$get_product = $this->db->get_where('smb_sub_category');
								foreach($get_product->result() as $p){
									echo "<option value='".$p->id."'>".$p->sub_category_name."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3">
						<p><label>Select Product</label></p>
						<select class="form-control" name="product" id="product" style=" width:100% auto; ">
							<option value="">Choose Product</option>
							<?php 
								$get_product = $this->db->get_where('smb_product');
								foreach($get_product->result() as $p){
									echo "<option value='".$p->id."'>".$p->title."</option>";
								}
							?>
						</select>
					</div>
					
			<!--		<div class="col-sm-3">
						<p><label>Type</label></p>
						<select class="form-control" name="type" id="type" style=" width:100% auto; ">
							<option value="">Choose Product</option>
							<?php 
								$get_product = $this->db->get_where('inventory_inward_outward');
								foreach($get_product->result() as $p){
									echo "<option value='".$p->id."'>".$p->inward_outward."</option>";
								}
							?>
						</select>
					</div>
					-->
		
		
		
				
					<?php
						$user_info = $this->session->userdata('logged_user');
						$user_id = $user_info['user_id'];
						$currentUser = singleDbTableRow($user_id)->role;
								
						if($currentUser == 'admin'){
					?>
				
					<?php } else {?>
					
					<?php } ?>
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
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('inventory_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
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
                                <th>Store Id</th>                            
                                <th>item</th>                            
                                <th>category</th>
                                <th>sub_category</th>
                                <th>brand</th>
                                <th>product_unique_code</th>
                                <th>product_manufacturing_date</th>
                                <th>Product_expiry_date</th>
                                <th>inward</th>
                                <th>Outward</th>
                                <th>weight_per_piece</th>
                                <th>quantity</th>
                                <th>balance_qty_in_stock</th>
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

						<tfoot>
						 <tr>
                                <th width="20%">Action</th>                         
                                <th>id</th> 
                                <th>Store Id</th>      								
                                <th>item</th>                            
                                <th>category</th>
                                <th>sub_category</th>
                                <th>brand</th>
                                <th>product_unique_code</th>
                                <th>product_manufacturing_date</th>
                                <th>Product_expiry_date</th>
                                <th>inward</th>
								<th>Outward</th>
                                <th>weight_per_piece</th>
                                <th>quantity</th>
                                <th>balance_qty_in_stock</th>
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
			"ajax": "<?php echo base_url('Inventory_stocks/Inventory_stocks_ListJson'); ?>"
		});
	});

</script>

<script type="text/javascript">
	function search_result()
	{
		var product      = $("#product").val();
		
		var category		 = $("#category").val();
		var sub_categoty		 = $("#sub_categoty").val();
		var sf_time=document.getElementById('some_class_1').value;
		var st_time=document.getElementById('some_class_2').value;
		
		var mydata = {"product": product,"category": category,"sub_categoty": sub_categoty,"sf_time": sf_time,"st_time": st_time};
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Inventory_stocks/inventory_search_ListJson'); ?>",
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
			doc.save('inventory_report.pdf');
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

        $('body').on('click', 'a.deleteBtn', function () {
            var agentId = $(this).attr('id');
            var currentItem = $(this);
            var verifyConfirm = confirm('Are you sure?'); //confirm

            if (verifyConfirm) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Inventory_stocks/deleteAjax') ?>",
                    data: {id: agentId},
                })
                        .done(function (msg) {
                            currentItem.closest('tr').hide('slow');
                        });
            }
        });

    </script>



<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>

