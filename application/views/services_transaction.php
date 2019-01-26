<?php


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
                    <h3 class="box-title">Accounts Balance Sheet</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <table class="table table-bordered">
                        <tr>
                            <th> Cash/Wallet </th>
                            <th> Total Debits  </th>
                            <th> Total Credits </th>	
							<th> Loyality Points </th>
                            <th> Discount Points</th>
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
                        
			
					<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Services Transaction Statement</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                        <tr>
                            <th>Date & Time </th>                           
                            <th>Type</th>
                            <th>A/C Number</th>	
                            <th>Amount</th>
							<th>MyFair's Account No</th>								
                            <th>Action</th>                            
                        </tr>
                        </thead>
<!-- Data is fetching from	app/controller/ledger.php 
public function userAccountListJson()-->
                        <tfoot>
                        <tr>
                            <th>Date & Time </th>                           
                            <th>Type</th>
                            <th>A/C Number</th>	
                            <th>Amount</th>
							<th>MyFair's Account No</th>                            								
                            <th>Action</th>  
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
											         
					
                        <button  name="submit"  class="btn btn-primary">
                            <i class="fa fa-credit-card"></i> Download Statement
                        </button>
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
                "ajax": "<?php echo base_url('ledger/services_transactionListJson'); ?>"
			//	"ajax": "<?php echo base_url('account/ledgerListJson'); ?>"
            });
        });

    </script>

<?php } ?>

