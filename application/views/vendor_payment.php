<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>

<?php include('header.php'); ?>
<?php 
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
	$rolename    = singleDbTableRow($user_id)->rolename;
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Pay To Vendor</h3>
                </div><!-- /.box-header -->
				
				
				<div class="row" style="padding:10px;">
				
					<div class="col-sm-3" id="vendor_div">
						<select class="form-control" name="vendor" id="vendor" style=" width:100% auto; ">
							<option value="">All Vendors</option>
							<?php 
								$get_vendors = $this->db->group_by('added_by')->get('smb_stock');
								
								foreach($get_vendors->result() as $v){
									if(singleDbTableRow($v->added_by)->company_name != ""){
										$vendor = singleDbTableRow($v->added_by)->company_name;
									}
									else{
										$vendor = singleDbTableRow($v->added_by)->first_name." ".singleDbTableRow($v->added_by)->last_name;
									}
									echo "<option value='".$v->added_by."'>".$vendor."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="col-sm-9 text-right">
							
						<button type="button" name="submit" value="search" class="btn btn-primary btn-sm btn-flat" onClick="search_result()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); height:27px; padding-top:3px;"><i class="fa fa-search"></i> Search </button>
						
						<button type="button" class="btn btn-danger btn-sm btn-flat" onClick="location.reload()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); height:27px; padding-top:3px;"><i class="fa fa-undo"></i> Reset </button>
					</div>
				</div>	
				<hr>
				<div class="box-body">
                <div id="excel_table" class="box-body table-responsive">
					<div id="status_div" class="text-center">
						<h3 class="text-blue" id="msg">Please Select a Vendor To Pay.</h3>
					</div>
					<div id="tab1" style="display:none;">
						<table id="example" class="table table-bordered table-striped table-hover">
							<thead>
							<tr>
								<th>Business Name</th>
								<th>Purchase Date</th>
								<th>Invoice ID</th>
								<th>Location</th>
								<th>Total Amount</th>
								<th>Vendor Pay Amount</th>
								<th>Pay</th>
							</tr>
							</thead>

							<tfoot>
							<tr> 
								<th>Business Name</th>
								<th>Purchase Date</th>
								<th>Invoice ID</th>
								<th>Location</th>
								<th>Total Amount</th>
								<th>Vendor Pay Amount</th>
								<th>Pay</th>
							</tr>
							</tfoot>
						</table>
					</div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</div>
</section><!-- /.content -->
<div class="box-footer" align="right">
<!--<button name="submit" class="btn btn-warning" value="export" onClick="excelData(this)">
<i class fa fa-credit-card"></i> Download  Details </button>
<br>
<br>
---->
</div>

<!-- Create Category -->

<!-------------------------------------------End Destroy--------------------------->



<!--End Create Category -->
<?php function page_js(){ ?>

<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>		
	function excelData() {
		alert("Download...?");
		var url = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#excel_table').html())
		location.href = url;
		return false;
	}
	
</script>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>





<script>
	
	function search_result()
	{
		var vendor	= $("#vendor").val();
		
		if(vendor == ""){
			$("#status_div").fadeIn();
			$("#tab1").slideUp();
			$("#msg").removeClass("text-blue");
			$("#msg").addClass("text-red");
		}
		else{
			$("#status_div").slideUp();
			$("#tab1").fadeIn();
			var mydata = {"vendor" : vendor};
			
			$(function() {
				$("#example").DataTable({
					 "paging": true,
					  "ordering": true,
					  "ordering": true,
					   "destroy": true,
					  "info": true,
					"ajax": {
						"url": "<?php echo base_url('smb_payments/payment_list'); ?>",
						"type":"POST",
						"data": mydata
					 }
				});
			});
		}
	}
</script>



<?php } ?>

