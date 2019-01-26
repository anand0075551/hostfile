<?php
/**Earnings**/
foreach($earnings->result() as $earning);
foreach($referralEarnings->result() as $referralEarning);
foreach($withdrawal->result() as $withdraws);

$totalEarning = $earning->amount;
//$refEarning = $referralEarning->amount;
$withdraw = $withdraws->amount;

//$rowEarning = $totalEarning - $refEarning;
$credit     = $totalEarning - $withdraw;


/**Accounts**/
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

/* Data is fetching from	app/controller/ledger.php 
public function userAccountListJson()*/

/* Standard data Retrieval*/
foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 
foreach( $loy_debit->result() 		as $loy_debit);
foreach( $loy_credit->result() 		as $loy_credit);
foreach( $dis_debit->result() 		as $dis_debit);
foreach( $dis_credit->result() 		as $dis_credit);

$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;
$loy_debit			= $loy_debit->debit;
$loy_credit      	= $loy_credit->credit;
$dis_debit			= $dis_debit->debit;
$dis_credit      	= $dis_credit->credit;
/* Available Balance Wallet,loyality and Discount Points */

$wallet_balance    = ( $wal_debit - $wal_credit ) ;
$loyality_balance  = ( $loy_debit - $loy_credit ) ;
$discount_balance  = ( $dis_debit - $dis_credit ) ;

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
                    <h3 class="box-title">Offers Accounts Balance Sheet</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th> CPA Values </th>
                            <th> Total CPA Debits  </th>
                            <th> Total CPA Credits </th>	
							<th> Loyality Values </th>
                            <th> Discount Values</th>
                        </tr>
                        <tr> 
                            <td>
                                <?php  echo amountFormat($wallet_balance); ?>
                            </td>
                            <td>
                               <?php  echo amountFormat($wal_debit); ?>  
                            </td>
                            <td>
                               <?php  echo amountFormat($wal_credit); ?>
                            </td>							
                            <td>
                                <?php  echo ($loyality_balance); ?>
                            </td>
                            <td>
                                <?php  echo ($discount_balance); ?>
                            </td>
                        </tr>
                 
					</table>		
                     </div>   
			
					<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
    <!-- <input type="button" value="export" onClick="excelData()"/> -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">My Accounts Transaction</h3>
                </div><!-- /.box-header -->
                  <div id="excel_table" class="box-body  table-responsive">
                    <table id="example" class="table table-bordered table-striped table-hover">


                        <thead>
                        <tr>
							<th>Action</th>
<th>Transaction Series </th>
                            <th>Date & Time </th>                           
                            <th>Deposit</th>	
						    <th>Deduction</th>	
                            <th>Values </th>							
                            <th>Values Type</th>								
                            <th>Transaction Remarks</th>    
															
                        </tr>
                        </thead>
<!-- Data is fetching from	app/controller/ledger.php 
public function userAccountListJson()-->
                        <tfoot>
                        <tr>
                            <th>Action</th>
<th>Transaction Series </th>
                            <th>Date & Time </th>	
							<th>Deposit</th>	
						    <th>Deduction</th>	
                            <th>Values </th>								
                           <th>Values Type</th>								
                            <th>Transaction Remarks</th>														
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
						
					<a href="<?php echo base_url('vouchers/') ?>"   class="btn btn-primary"><i class="fa fa-edit"></i> Convert Voucher Points</a>		
					
					<button  name="submit"  class="btn btn-warning" value="export" onClick="excelData()" >
                            <i class="fa fa-credit-card"></i> Download Statement as XL Sheet    </button>
                    </div>
					
					
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
                "ajax": "<?php echo base_url('ledger/userAccountListJson2'); ?>"
			//	"ajax": "<?php echo base_url('account/ledgerListJson'); ?>"
            });
        });
	function excelData() {
		alert("Download Accounts Summary XLS Sheet?");
        var url = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#excel_table').html())
        location.href = url;
        return false;
                        }
    </script>

<?php } ?>

