<?php

foreach( $roleDebit->result()  as $roleDebit);
$totaldebit = $roleDebit->debit; 

foreach( $roleCredit->result() as $roleCredit);
$totalcredit = $roleCredit->credit; 

$profit = $totaldebit - $totalcredit;

?>
<?php function page_css(){ ?>
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
                    <h3 class="box-title">Rolewise Accounts Head Consolidated List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <table class="table table-bordered">
					<div class="col-md-12">
                        <tr>
                            <th>Profit/Loss </th>
                            <th>Total Recieved</th>
                            <th>Total Spent</th>
							
                            
                        </tr>
                        <tr>
                          <td>
                              <?php  echo number_format($profit, 2); ?>
                            </td>

                            <td>
                                <?php  echo number_format($totaldebit, 2); ?>
                            </td>

                            <td>
                                <?php  echo number_format($totalcredit, 2); ?>
                            </td>
                           

							</tr>
							</div>
						</table>                  
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

		 <!-- form start -->
				
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>		

						
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

		<input type="button" value="export" onClick="excelData()"/>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Rolewise Pay Specifications Accounts Transaction</h3>
                </div><!-- /.box-header -->
                <div id="excel_table" class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">
						<div class="row">
							<div class="col-md-12">
								<thead> <div class="col-md-12">
									<tr>
										
									<th>Role Name</th>                              
									<th>Recieved</th>
									<th>Spent</th>											
									<th>Profit/Loss </th>														
									<!-- 		<th>Remarks</th>  -->
										
									</tr> </div>
								</thead>
							</div>
						</div>
<!-- Data is fetching from	app/controller/ledger.php 
public function payspecListJson()-->
						<div class="row">
							<div class="col-md-12">
                        <tfoot><div class="col-md-12">
									<tr>
									
										<th>Role Name</th>                           
										<th>Recieved</th>
								    	<th>Spent</th>											
										<th>Profit/Loss </th>														
										<!-- <th>Remarks</th>  -->
									</tr></div>
                        </tfoot>
						</div>
						</div>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

<?php function page_js(){ ?>



    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#example").dataTable({
                "processing": true,
                "serverSide": true,
              //  "ajax": "<?php echo base_url('ledger/ledgerListJson'); ?>"
				"ajax": "<?php echo base_url('ledger/rolewise_payspecListJson'); ?>"
            });
        });

    </script>

<script>

    $('body').on('click', 'a.deleteBtn', function () {
        var agentId = $(this).attr('id');
        var currentItem = $(this);
        var verifyConfirm = confirm('Are you sure?'); //confirm

        if(verifyConfirm) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('ledger/deleteAjax') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });
	
	function excelData() {
		alert("hi");
                                                var url = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#excel_table').html())
                                                location.href = url;
                                                return false;
                                            }

</script>


<?php } ?>

