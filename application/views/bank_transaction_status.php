
<?php

function page_css() { ?>
   <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	<!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/csv_export/html5csv.js'); ?>"></script>
<?php } ?>

<!-- PDF Export -->
	

<?php include('header.php'); 


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
                 <input type="hidden" name="balance" id="balance" value="">
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
					<div class="row" style="padding:10px;">
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3 text-right">
					<a href="<?php echo base_url('Bank_transaction/all_bank_transaction') ?>" class="btn btn-warning btn-sm btn-flat" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-plus"></i>report</a>
					<button type="button" class="btn btn-primary btn-sm btn-flat" onclick="CSV.begin('#example').download('Bank_transaction_status.csv').go()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-file-excel-o"></i>CSV</button>
						<button type="button" class="btn btn-danger btn-sm btn-flat" onClick="location.reload()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); "><i class="fa fa-undo"></i> Reset </button>
					</div>
					
				</div>



<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                
                <div class="box-body print_div table-responsive" style="overflow-x:scroll">
               
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                                <th width="10%">Branch code</th>
                                <th>Bank IFSC no.</th>
                                <th>Transaction Date</th>
                                <th>Value Date</th>
                                <th>Mode of Transfer</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                                <th width="5">status</th>
								
                               
                               
                             </tr>
                        </thead>
                       

                    </table>
                     </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
<div class="box-footer" align="center">
    
</div>

<?php

function page_js() { ?>


<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.min.js" ></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
            $(function () {
                $("#example").dataTable({
                  "paging": true,
                  "ordering": true,
                  "info": true,				  
				  "destroy": true,
                    "ajax": "<?php echo base_url('Bank_transaction/accountStatusListJson'); ?>"
                });
            });

    </script>

<script>
function change_status(cnt)
{
    var status = document.getElementById(cnt+'status').value;
    var aid = document.getElementById(cnt+'aid').value;
	var mydata = {"status": status,"aid": aid};
    	$.ajax({
		type: "POST",
		url: "account_status_update",
		data: mydata,
		success: function (response) {
			location.reload(); 
		//	alert(response);
		}
	});
}
</script>

<?php } ?>

