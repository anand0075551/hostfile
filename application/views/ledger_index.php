<?php
foreach( $assets->result() as $assets);
foreach( $debits->result() as $debits);
foreach($credits->result() as $credits);
foreach($wallet->result() as $wallet);
foreach( $usedwallet->result() as $usedWallet);  //wallet_converted 

 $totalAssets = $assets->amount; 
 $totalDebits = $debits->debit; 
$totalCredits = $credits->credit; 
$totalWallet  = $wallet->amount; 
$usedwallet   = $usedWallet->amount;  

 $debits = $totalDebits	;   //Total Debits
 $credits = $totalCredits;  //Total Credits
 $assets = ($debits - $credits) ; //Total Assets = Total Debits - Total Credits
$wallet  = $totalWallet;   //Company Wealth - Available cash funds
$usedwallet = $wallet  - $usedwallet ; //Cash Points = Company Wealth - Converted wallet ;
//$balancecash = $wallet  - $usedwallet ; //Cash Points = Company Wealth - Converted wallet
$balancecash = ($debits + $credits) ; //Cash Points = Company Wealth - Converted wallet
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
                    <h3 class="box-title">Transaction List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <table class="table table-bordered">
					<div class="col-md-12">
                        <tr>
                            <th>Company Wealth</th>
                            <th>Total Debits</th>
                            <th>Total Credits</th>
							<th>Overall Transactions</th>
                          
                        </tr>
                        <tr>
                          <td>
                              <?php  echo amountFormat($assets); ?>
                            </td>

                            <td>
                                <?php  echo amountFormat($debits); ?>
                            </td>

                            <td>
                                <?php  echo amountFormat($credits); ?>
                            </td>
                            <td>
                                 <?php  echo amountFormat($balancecash); ?> 
                            </td>
                            

							</tr>
							</div>
						</table>                  
               




					<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
<!--  <input type="button" value="export" onClick="excelData()"/> -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Ledger Accounts Transaction</h3>
                </div><!-- /.box-header -->
                <div id="excel_table" class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">
						 <thead>
                        <tr>
										<th>Action</th>
										<th>Pay Spec's</th>                           
										<th>Debit</th>
										<th>Credit</th>		
										<th>Values Type</th>											
										<th>Remarks</th>
										
							</tr>
                        </thead>
<!-- Data is fetching from	app/controller/ledger.php 
public function ledgerListJson()-->
						<tfoot>
                        <tr>
										<th>Action</th>
										<th>Pay Spec's</th>                           
										<th>Debit</th>
										<th>Credit</th>		
									    <th>Values Type</th>											
										<th>Remarks</th>
										
						</tr>
                        </tfoot>
                     </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
						
                </div><!-- /.box-body --><br> <br> 
				<div class="box-footer">
						
					<a href="<?php echo base_url('ledger/payspec_accounts') ?>"   
					class="btn btn-primary"><i class="fa fa-edit"></i> Check Pay Specification Accounts</a>		
					
					<button  name="submit"  class="btn btn-warning" value="export" onClick="excelData()" >
                            <i class="fa fa-credit-card"></i> Download Ledger Statement as XL Sheet    </button>
                    </div>
					
					
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
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
                "ajax": "<?php echo base_url('ledger/ledgerListJson'); ?>"
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
		alert("Download Ledger Accounts XLS Sheet?");
        var url = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#excel_table').html())
        location.href = url;
        return false;
                        }

</script>


<?php } ?>
