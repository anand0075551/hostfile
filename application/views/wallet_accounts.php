<?php
foreach($earnings->result() as $earning);
foreach($referralEarnings->result() as $referralEarning);
foreach($total_liabilities->result() as $withdraws);  //cash 
foreach($total_wallet->result() as $wallet);  //total_wallet points

$totalEarning = $earning->cash; //cash for any user_id
$refEarning = $referralEarning->capital; //Capital
$liabilities = $withdraws->liabilities; //liabilities-cash 
$total_wallet = $wallet->cash; //total_wallet

$capital = $refEarning ;
$cash = $totalEarning ;
$liabilities = $withdraws ;
//$assets = ( $cash + $capital + $liabilities );
//$total_wallet = $refEarning ;

$wallet_balance = ( $cash - $total_wallet) ;
?>
<?php function page_css(){ ?>
 <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Wallet Accounts Summary </h3>
                </div><!-- /.box-header -->
				
				
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					<!--
                        <div class="form-group <?php if(form_error('capital')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Company capital
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="capital" step="0.1" min="1" class="form-control" value="<?php echo set_value('capital'); ?>" placeholder="Enter Capital Amount">
                                <?php echo form_error('capital') ?>
                            </div>
                        </div> -->
                     <table class="table table-bordered">
                        <tr>
                            <th>Total Wallet Pt</th>
                            <th>Used Wallet Pt</th>
                            <th>Balance Wallet Pt</th>
                        </tr>
                        <tr>
							<td> <?php  echo amountFormat($cash);  ?>            </td>
                            <td> <?php  echo amountFormat($total_wallet); ?>     </td>
                            <td> <?php  echo amountFormat($wallet_balance); ?>   </td>
						</tr>
					</table>  
						<!--		<table class="table table-bordered">
								   <tr><th> Total Cash					</th> <td> <?php  echo amountFormat($cash); 		     ?>	 </td></tr>
								   <tr><th> Total Wallet Points			</th> <td> <?php  echo amountFormat($total_wallet);   ?>	 </td></tr>
								   <tr><th>Eligible Wallet Points		</th> <td> <?php  echo amountFormat($wallet_balance); ?>	 </td></tr>
								   
								</table>	
						
						<div class="form-group">
								<label for="firstName" class="col-md-3">    Available Ledger Cash			</label>
								<div class="col-md-9">
									<?php  echo amountFormat($cash); ?>							
								</div>
						</div> 
						<div class="form-group">
								<label for="firstName" class="col-md-3">    Converted Wallet Points			</label>
								<div class="col-md-9">
									<?php  echo amountFormat($cash); ?>							
								</div>
						</div> 
						<div class="form-group">
								<label for="firstName" class="col-md-3">    Eligible Cash To Convert Wallet Points				</label>
								<div class="col-md-9">
									<?php  echo amountFormat($cash); ?>							
								</div>
						</div> 		-->				
						<hr />
						<div class="form-group <?php if(form_error('cash')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">    Wallet Convertable Cash 
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="number" name="cash" step="1" min="1" max="<?php  echo ($wallet_balance); ?>" class="form-control" value="<?php echo set_value('cash'); ?>" placeholder="Enter Cash">
									<?php echo form_error('cash') ?>
								</div>
						</div>
					
						
						<div class="form-group <?php if(form_error('pay_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Transfer Type
							<span class="text-red"></span></label>
                            <div class="col-md-9">    	
										<input type="radio" name="pay_type"  value="Credit" id="type_0" />Credit
										<input type="radio" name="pay_type" value="Debit" id="type_1" />Debit                      
                                <?php echo form_error('pay_type') ?>
                            </div>
                        </div> 
						
						
					    <div class="form-group <?php if(form_error('tranx_id')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Transaction Reciept No/Remarks
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="tranx_id" class="form-control" value="<?php echo set_value('tranx_id'); ?>" placeholder="Enter Transaction Reciept No">
									<?php echo form_error('tranx_id') ?>

								</div>
						</div> 

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
</table>
                    <div class="box-footer">
					
                        <button type="submit" name="submit" value="cash_2wallet" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Transfer
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
<!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            var oTable = $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url('vouchers/vouchersListJson'); ?>",
                    "data": function ( d ) {
                        d.dateRange = $('[name="searchByNameInput"]').val();
                    }
                }
            });

            $('button#searchByDateBtn').on('click', function(){
                oTable.fnDraw();
            });

        });

    </script>



    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- Page script -->
    <script type="text/javascript">
        $(function() {
            //Date range picker
            $('#reservation').daterangepicker({ format: 'YYYY-MM-DD' });
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        });
    </script>


<?php } ?>

