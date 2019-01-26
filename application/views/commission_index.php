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

 $debits = $totalDebits	;
$credits = $totalCredits;
$wallet  = $totalWallet;
$usedwallet = $usedwallet ;
$balancecash = $wallet  - $usedwallet ;
 $assets = ($debits - $credits) ;
 $wealth = ($debits + $credits) ;
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
                        <tr>
                            <th>Total Assets</th>
                            <th>Total Debits</th>
                            <th>Total Credits</th>
                            <th>Company Wealth</th>							
                            <th>Company Cash</th>
                            <th>Utilized Cash</th>
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
                                <?php  echo amountFormat($wealth); ?>
                            </td>
                            <td>
                                <?php  echo amountFormat($balancecash); ?>
                            </td>							
                            <td>
                                <?php  echo amountFormat($usedwallet ); ?>
                            </td>

						</tr>
						</table>                  
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Commission Index List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				   <div class="col-md-12">  
                    <table id="example" class="table table-bordered table-striped table-hover">

                        <thead>
                        <tr>
                          <!--  <th width="20%">Action</th>  -->
						    <th>Action</th> 
                            <th>Pay Specs</th>
                            <th>Sender </th>	
                            <th>Receiver </th>
                            <th>Deduction Payspec</th>	
													
                            					
                            
							
                        </tr>
                        </thead>
<!-- Data is fetching from	app/controller/ledger.php 
public function commissionListJson()-->
                        <tfoot>
                        <tr>
                             <th>Action</th> 
                            <th>Pay Specs</th>
                            <th>Sender </th>	
                            <th>Receiver </th>
                            <th>Deduction Payspec</th>	
							
                            
							
                        </tr>
                        </tfoot>

                    </table>
					</div>
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
                "ajax": "<?php echo base_url('ledger/commissionListJson'); ?>"
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
                url: "<?php echo base_url('ledger/deleteCommission') ?>",
                data: {id: agentId},
            })
            .done(function (msg) {
                currentItem.closest('tr').hide('slow');
            });
        }
    });

</script>


<?php } ?>

