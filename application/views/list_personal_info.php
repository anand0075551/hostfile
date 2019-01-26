<?php function page_css(){ ?>
    <!-- datatable css -->
   <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	
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
						<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('Personal Info.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
					</div>
				</div>
			</div><!-- /.box-header -->
	
			<div class="box-body table-responsive">
				<div  id="excel_table" class="box-body">
					<table id="example" class="table table-bordered table-striped table-hover print_div">
						<thead>
						<tr>
							<th  width="7%">Action</th>
                             <th>Type</th>
							<th>First Name</th>
                            <th>Middle Name</th>
							<th>Last Name</th>
							<th>ID Proof</th>
							<th>Aadhar ID</th>	
							<th>Pan Id</th>	
							<th>Voter Id</th>	
							<th>Driving License Id</th>	
							<th>Passport No.</th>	
                            <th>DOB</th>
							<th>Dob Proof</th>
							<th>Age</th>
							<th>Email</th>	
							<th>Secondary Email</th>	
							<th>Permanent Contact No.</th>	
							<th>Mobile Number 1</th>	
							<th>Mobile Number 2</th>	 
							<th>Alternate Contact No.</th>
							<th>Native Place</th>
							<th>Resident Address</th>
							<th>Pincode</th>	
							<th>Permanent Address</th>	
							<th>Permanent Address Proof</th>	
							<th>Created At</th>	
							<th>Created By</th>	
							
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



<script type="text/javascript">
	$(function() {
		$("#example").dataTable({
			
			  "paging": true,
                  "ordering": true,
                  "ordering": true,
                  "info": true,				  
				"destroy": true,
			"ajax": "<?php echo base_url('Personal_info/personal_info_ListJson'); ?>"
		});
	});

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
			doc.save('Personal Info.pdf');
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

