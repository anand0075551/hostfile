<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	
	<!--  Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
	
	
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
					
					<?php 
						$user_info 	 = $this->session->userdata('logged_user');
						$user_id 	 = $user_info['user_id'];
						$role = singleDbTableRow($user_id)->rolename;
					
					?>
						<div class="col-sm-3">
							<p><label>Select Vendor</label></p>
							<select class="form-control" name="vendor" id="vendor" style=" width:100% auto; ">
								<option value="">Choose Vendor</option>
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
							<p><label style="color:white">Space</label></p>
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
							<button type="button" class="btn btn-success btn-sm btn-flat" onclick="CSV.begin('#example').download('vendor_payments.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i> Download CSV</button>
						</div>
					</div>
                </div><!-- /.box-header -->
				
                <div class="box-body">
                   
                    <table id="example" class="table table-bordered table-hover print_div" >
                        <thead>
                        <tr class="well">
							<th width="20%">Payment Date</th>  
							<th width="20%">Vendor</th>  
							<th width="20%">Invoice ID</th>
							<th width="20%">Vendor Invoice ID</th>
							<th width="20%">Paid Amount</th>                          
                            
                        </tr>
                        </thead>

                        <tfoot>
                        <tr class="well">
							<th width="20%">Payment Date</th>  
							<th width="20%">Vendor</th> 
							<th width="20%">Invoice ID</th>
							<th width="20%">Vendor Invoice ID</th>
							<th width="20%">Paid Amount</th> 
                        </tr>
                        </tfoot>
                    </table>
               
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->


<?php function page_js(){ ?>




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
			doc.save('sales_report.pdf');
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



    <!-- DATA TABLES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
	<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script> 
	
    <script type="text/javascript">
        $(function() {
            $("#example").dataTable({
                "paging": true,
				"ordering": true,
                "ajax": "<?php echo base_url('Smb_payments/all_vendor_payments_list'); ?>"
            });
        });

    </script>
	

<script type="text/javascript">
	function search_result()
	{
		var vendor = $("#vendor").val();
		
	
		var mydata = {"vendor": vendor};
		
		$(function() {
            $("#example").DataTable({
				 "paging": true,
				  "ordering": true,
				  "ordering": true,
				   "destroy": true,
				  "info": true,
				"ajax": {
            		"url": "<?php echo base_url('Smb_payments/vendor_payments_search_List'); ?>",
					"type":"POST",
					"data": mydata
       			 }
            });
        });
		
		
	
	}
	
	
</script>


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>



<?php } ?>

