<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Get Commission</h3>
                </div><!-- /.box-header -->
                <div  id="excel_table" class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                            <tr>
                            	<th>Business Group</th>
                            	<th>Area</th>
                            	<th>From Role</th>
                                <th>No: of Users</th>
                                <th>From Date</th>
                                <th>To Date </th>
                                <th>Total Sale</th>
                                
                                <th>Total Commission</th>
                                <th>Get it</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            	<th>Business Group</th>
                            	<th>Area</th>
                            	<th>From Role</th>
                                <th>No: of Users</th>
                                <th>From Date</th>
                                <th>To Date </th>
                                <th>Total Sale</th>
                               
                                <th>Total Commission</th>
                                <th>Get it</th>
                            </tr>
                        </tfoot>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
<div class="box-footer" align="center">
   <!-- <button name="submit" class="btn btn-warning" value="export" onClick="excelData(this)">
        <i class fa fa-credit-card></i> Download Complaint </button>-->
        
    <br>
    <br>

</div>

<?php function page_js() { ?>



    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
            $(function () {
                $("#example").dataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "<?php echo base_url('Distributor_commission/my_commission'); ?>"
                });
            });

    </script>
    
 <script type="text/javascript">
       function get_commission(total_commission,cnt) 
	   {
		   alert('Please Wait transaction is processing....');
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
	});	
		}
</script>

<?php } ?>

