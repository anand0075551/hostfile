
<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<!-- PDF Export -->
	

<?php include('header.php'); 
foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 
$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;
$wallet_balance    = ( $wal_debit - $wal_credit ) ;
$balance=$wallet_balance;

?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="color:#03F"><strong>Upload CSV</strong></h3>
                </div><!-- /.box-header -->
                 <?php echo form_open_multipart('', ['create' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>
                 <input type="hidden" name="balance" id="balance" value="<?php echo $balance;?>">
                 <div class="box-body">
                    <div class="form-group <?php if(form_error('fileToUpload')) echo 'has-error'; ?>">
                            <label for="budget" class="col-md-3">Upload
                                <span class="text-red">Only .csv file is allowed.</span>
                            </label>
                            <div class="col-md-9">
                            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                               <?php echo form_error('fileToUpload') ?>
                            </div>
                        </div>
                 </div><!-- /.box-header -->
                 <div class="box-footer">
                  		<button type="submit" name="submit" value="import_data" class="btn btn-primary">
                            <i class="fa fa-arrow-up"></i> Import Data
                        </button>
                    </div>
                 </form>
            </div><!-- /.box -->
    
    
        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                
                 <table class="table table-bordered table-striped table-hover">
					<thead>
                    	<tr>
                            <th>Total Amount</th>
                            <th>Total Earning</th>
                            <th>Total Refund</th>
                            <th>Total Paid </th>
                        </tr> 
                	</thead>
                    <tbody>
                    	<tr>
                            <td><?php echo $total_amount;?></td>
                            <td><?php echo $total_earning;?></td>
                            <td><?php echo $total_refund;?></td>
                            <td><?php echo $total_paid;?> </td>
                        </tr> 
                	</tbody>
                 </table>
            </div><!-- /.box -->
    
    
        </div><!--/.col (left) -->
    </div>   <!-- /.row -->
</section><!-- /.content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                
                <div  id="excel_table" class="box-body">
                <div  id="print_div" >
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Transaction ID</th>
                                <th>Transaction Time</th>
                                <th>Name </th>
								 <th>Referral Code</th>
                                 <th>Amount</th>
                                <th>Earning</th>
                                <th>Refund Amount</th>
                                <th>Pay</th>
                             </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Order ID</th>
                                <th>Transaction ID</th>
                                <th>Transaction Time</th>
                                <th>Name </th>
								 <th>Referral Code</th>
                                 <th>Amount</th>
                                <th>Earning</th>
                                <th>Refund Amount</th>
                                <th>Pay</th>
                            </tr>
                        </tfoot>

                    </table>
                     </div>
                     <button type="button" class="btn btn-warning " id="create_pdf"><i class="fa fa-file-pdf-o"></i> Export to PDF</button>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
<div class="box-footer" align="center">
    
</div>

<?php

function page_js() { ?>

<script>
	$(document).ready(function(){
	var form = $('#print_div'),
	//	cache_width = form.width(),
		a4  =[ 830,  841.89];  // for a4 size paper width and height

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
			doc.save('events_report.pdf');
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

    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
            $(function () {
                $("#example").dataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "<?php echo base_url('Bill_pay_refund/RefundListJson'); ?>"
                });
            });

    </script>
 <script type="text/javascript">
       function pay_now(cnt,refund,referral_code,id) 
	   {
		   
		  var balance = document.getElementById('balance').value;
		 
		  if(balance < refund)
		  {
			  alert('Sorry.... Low Balance');
			  return false;
		  }
		  else
		  {
			  alert('Please Wait transaction is processing....');
			  var mydata = {"refund": refund,"referral_code": referral_code,"id": id};
			  $.ajax({
						type: "POST",
						url: "Pay_now",
						data: mydata,
						success: function (response) {
							alert(response);
							location.reload(); 
							
						}
					});
		  }
		   /*alert('Please Wait transaction is processing....');
		   var from_date = document.getElementById(cnt+'from_date').value;
		   var end_date = document.getElementById(cnt+'end_date').value;
		   var from_role = document.getElementById('from_role').value;
		 
				var mydata = {"total_commission": total_commission,"from_date": from_date,"end_date": end_date,"from_role": from_role};

	$.ajax({
		type: "POST",
		url: "Get_commission",
		data: mydata,
		success: function (response) {
			location.reload(); 
			//alert(response);
		}
	});	*/
		}
</script>

<?php } ?>

