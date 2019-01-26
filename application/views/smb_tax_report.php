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
		<div class="box">
			<div class="box-header" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
				<div class="row" style="padding:10px;">
			
					<div class="col-sm-3">
						<p><label>Invoice </label></p>
						<select class="form-control" name="sale_code" id="sale_code" style=" width:100% auto; ">
							<option value="">Choose Invoice</option>
							<?php 
								$user_info 	 = $this->session->userdata('logged_user');
								$user_id 	 = $user_info['user_id'];
								$role = singleDbTableRow($user_id)->rolename;
								if($role == 11)
								{
									$get_users = $this->db->order_by('id','desc')->group_by('sale_code')->get('smb_sale');
									foreach($get_users->result() as $p)
										{
											echo "<option value=".$p->sale_code.">".$p->sale_code."</option>";
										}
								}
								else{
										$get = $this->db->get('smb_sale');
										foreach($get->result() as $r){
											$product_details = json_decode($r->product_details, true);
										
											foreach($product_details as $v){
													
												$vendor_id = $v['vendor'];
												if($user_id == $vendor_id){
													echo "<option value=".$r->sale_code.">".$r->sale_code."</option>";
												}
												break;
											}
										}
								}
							?>
						</select>
					</div>
					<div class="col-sm-3">
						<p><label>Business Type </label></p>
						<select class="form-control" name="business" id="business" style=" width:100% auto; ">
							<option value="">Choose Business</option>
							<?php 
								$user_info 	 = $this->session->userdata('logged_user');
								$user_id 	 = $user_info['user_id'];
								$role = singleDbTableRow($user_id)->rolename;
								
								$get_bus = $this->db->order_by('id','desc')->group_by('business')->get('smb_sale');
								foreach($get_bus->result() as $b)
									{
										echo "<option value=".$b->business.">". singleDbTableRow($b->business,'business_groups')->business_name."</option>";
									}
							?>
						</select>
					</div>
					<div class="col-sm-3">
						<p><label>Select Product</label></p>
						<select class="form-control" name="product" id="product" style=" width:100% auto; ">
							<option value="">Choose Product</option>
							<?php 
								$get_product = $this->db->order_by('title', 'asc')->get('smb_product');
								foreach($get_product->result() as $p){
									echo "<option value='".$p->title."'>".$p->title."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-3">
						<p><label>Select Location</label></p>
						<select class="form-control" name="location" id="location" style=" width:100% auto; ">
							<option value="">Choose Location</option>
							<?php 
								$get_location = $this->db->order_by('location', 'asc')->get('location_id');
								foreach($get_location->result() as $l){
									echo "<option value='".$l->id."'>".$l->location."</option>";
								}
							?>
						</select>
					</div>
					<?php 
								$user_info 	 = $this->session->userdata('logged_user');
								$user_id 	 = $user_info['user_id'];
								$role = singleDbTableRow($user_id)->rolename;
									if($role == 11)
									{?>
					
							<?php
									}
								?>	
					<?php
						$user_info = $this->session->userdata('logged_user');
						$user_id = $user_info['user_id'];
						$currentUser = singleDbTableRow($user_id)->role;
								
						if($currentUser == 'admin'){
					?>
					<div class="col-sm-3">
						<p><label>Select Vendor</label></p>
						<select class="form-control" name="vendor" id="vendor" style=" width:100% auto; ">
							<option value="">Choose Vendor</option>
							<?php 
								$get_vendor = $this->db->order_by('company_name')->get_where('users', ['role'=>'agent']);
								foreach($get_vendor->result() as $v){
									echo "<option value='".$v->id."'>".$v->company_name."</option>";
								}
							?>
						</select>
					</div>
					<?php } else {?>
					
					<?php } ?>
					
					<div class="row" style="padding:10px;">
						<div class="col-sm-3">
							<p><label>From Date</label></p>
							<input type="text" class="some_class form-control" style="height:30px;" value="" id="f_date" name="sf_time"  placeholder="From"/>
						</div>
						
						<div class="col-sm-3">
							<p><label>To Date</label></p>
							<input type="text" class="some_class form-control" style="height:30px;" value="" id="t_date" name="st_time"  placeholder="To"/>
						</div>
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
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('accounts_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
			   <div  id="excel_table" class="box-body" style="overflow-x:scroll">
				 <h3 align="center" class="box-title">Please select by above search criteria</h3>	
                
					<table id="example" class="table table-bordered table-striped table-hover print_div" style="display:none;">
						<thead>
						<tr>
							<th width="7%">Action</th>
							<th width="10%">Purchase Date</th>
							<th width="10%">Invoice ID</th>
							<th width="10%">Total Amount</th>
							<th width="10%">pp Tax1</th> 
							<th width="10%">pp Tax2</th> 
							<th width="10%">pp Tax3</th> 
							<th width="10%">pp Tax4</th> 
							<th width="10%">pp Tax5</th> 
							<th width="10%">sp Tax1</th> 
							<th width="10%">sp Tax2</th> 
							<th width="10%">sp Tax3</th> 
							<th width="10%">sp Tax4</th> 
							<th width="10%">sp Tax5</th> 
							<th width="10%">Total Shipping</th>                            
							<th width="10%">Total Tax</th> 
                        </tr>
						</thead>

						<tfoot>
							<tr>
								<th width="7%">Action</th>
								<th width="10%">Purchase Date</th>
								<th width="10%">Invoice ID</th>
								<th width="10%">Total Amount</th>
								<th width="10%">pp Tax1</th> 
								<th width="10%">pp Tax2</th> 
								<th width="10%">pp Tax3</th> 
								<th width="10%">pp Tax4</th> 
								<th width="10%">pp Tax5</th> 
								<th width="10%">sp Tax1</th> 
								<th width="10%">sp Tax2</th> 
								<th width="10%">sp Tax3</th> 
								<th width="10%">sp Tax4</th> 
								<th width="10%">sp Tax5</th> 
								<th width="10%">Total Shipping</th> 
								<th width="10%">Total Tax</th> 
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


<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>



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
		var sale_code       = $("#sale_code").val();
		var vendor  	    = $("#vendor").val();
		var business     	= $("#business").val();
		var product  	    = $("#product").val();
		var location  	    = $("#location").val();
		
		var sf_date=document.getElementById('f_date').value;
		var st_date=document.getElementById('t_date').value;
		
		
		
		var mydata = {"sale_code": sale_code,"sf_date":sf_date,"st_date":st_date,"product":product,"location":location,"vendor":vendor, "business":business};
		$(function() {	
            $("#example").dataTable({
				  "paging": true,
				  "ordering": true,
				  "ordering": true,
				  "destroy": true,
				"ajax": {
            		"url": "<?php echo base_url('Smb_allreports/smb_tax_ListJson'); ?>",
					"type":"POST",
					"data": mydata
       			 }
            });
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
			doc.save('smb_tax_report.pdf');
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

