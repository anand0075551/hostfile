<?php include('header.php'); ?>
<?php function page_css(){ ?>
       <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	<!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
	
	<!-- CSV Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/csv_export/html5csv.js'); ?>"></script>
<?php } 
$id = $_GET['id'];

?>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                         <div class="col-md-12">
               <div class="box">
                <div class="box-body print_div" style="overflow-x:scroll">
				<div id="total"></div>
										<table id="example" class="table table-bordered table-striped table-hover">
											<thead>
											<tr>
												<th  width="7%">Action</th>
												<th>User Name</th>
												<th>Email</th>
												<th>Rolename</th>
												<th>Account No</th>
												<th>Debit</th>
												<th>Credit</th>
												<th>Amount</th>
												<th>Points Mode</th>
												<th>Challan</th>
												<th>Used</th>
												<th>Paid To</th>
												<th>Pay Type</th>
												<th>Tranx Id</th>
												<th>Active</th>
												<th>Date</th>
												<th>Tran Count</th>
												
											</tr>
											</thead>
											<td><input type="hidden" value="<?php echo $id; ?>" name="id" id="id"></td>
											<tfoot>
											<tr>
												<th  width="7%">Action</th>
												<th>User Name</th>
												<th>Email</th>
												<th>Rolename</th>
												<th>Account No</th>
												<th>Debit</th>
												<th>Credit</th>
												<th>Amount</th>
												<th>Points Mode</th>
												<th>Challan</th>
												<th>Used</th>
												<th>Paid To</th>
												<th>Pay Type</th>
												<th>Tranx Id</th>
												<th>Active</th>
												<th>Date</th>
												<th>Tran Count</th>
											</tr>
											</tfoot>

										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
                           </div>
								 <div class="box-footer">
								 <div class="row" style="padding:10px;">
									<div class="col-sm-12 text-right">
										<button type="button" class="btn btn-primary btn-sm btn-flat" id="create_pdf" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-pdf-o"></i> Download PDF</button>
										&nbsp;
										<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('accounts_report.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
								  </div>
								</div>
									<a href="<?php echo base_url('Account_report/accounts_report' ) ?>" class="btn btn-warning"><i class="fa fa-bar-chart"></i> Back </a>	
                                  </div>
                        </div><!--/.col (left) -->
                    </div>   <!-- /.row -->
				</div>
              </section><!-- /.content -->
	<!-- PDF Export -->
	<?php function page_js(){ ?>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
    <script type="text/javascript">
        $(function() {
       
		var id = $("#id").val();
		var mydata = {"id": id};
		
		$(function() {
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,
				"ajax": {
            		"url": "<?php echo base_url('Account_report/account_view_json'); ?>",
					"type":"POST",
					"data": mydata
       			 }
            });
        });
		});
    </script>
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
<?php } ?>	
<!-- CSV Export -->
<script type="text/javascript" src="<?php echo base_url('assets/csv_export/html5csv.js'); ?>"></script>
