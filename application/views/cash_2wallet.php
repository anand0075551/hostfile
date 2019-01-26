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


/*
foreach( $usedwallet->result() as $usedWallet);  //wallet_converted 
foreach($wallet->result() as $wallet);


$totalWallet  = $wallet->amount; 
$usedwallet   = $usedWallet->amount;


$wallet  = $totalWallet;
$usedwallet = $usedwallet ;
*/
 
$wallet_balance = ( $wallet  - $usedwallet ) ; 
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
                    <h3 class="box-title">Temp Cash to Wallet --------------Transfer Liabilities to Cash </h3>
                </div><!-- /.box-header -->
				
 <div class="box-body">

                    <table class="table table-bordered">
					<div class="col-md-12">
                        <tr>
                            <th>Company Wealth</th>
                            <th>Total Debits</th>
                            <th>Total Credits</th>
							<th>Total Assets</th>
                           
                        </tr>
                        <tr>
                          <td>
                              <?php  echo amountFormat($balancecash); ?>
                            </td>

                            <td>
                                <?php  echo amountFormat($debits); ?>
                            </td>

                            <td>
                                <?php  echo amountFormat($credits); ?>
                            </td>
                            <td>
                                 <?php  echo amountFormat($assets); ?> 
                            </td>
                            

							</tr>
							</div>
						</table>                  
                </div><!-- /.box-body -->				
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
								   <tr><th> Total Cash/Wallet 				</th> <td> <?php  echo amountFormat($wallet); 	?>	 </td></tr>
								   <tr><th> Converted Wallet			</th> <td> <?php  echo amountFormat($usedwallet);   ?>	 </td></tr>
								   <tr><th> Balance Wallet Points		</th> <td> <?php  echo ($wallet_balance); ?>	 </td></tr>
								   
								</table>	
						
						<div class="form-group">
								<label for="firstName" class="col-md-3">    Available Ledger Cash			</label>
								<div class="col-md-9">
									<?php  echo amountFormat($wallet_balance); ?>							
								</div>
						</div> 
						<div class="form-group">
								<label for="firstName" class="col-md-3">    Converted Wallet Points			</label>
								<div class="col-md-9">
									<?php  echo amountFormat($wallet_balance); ?>							
								</div>
						</div> 
						<div class="form-group">
								<label for="firstName" class="col-md-3">    Eligible Cash To Convert Wallet Points				</label>
								<div class="col-md-9">
									<?php  echo amountFormat($wallet_balance); ?>							
								</div>
						</div> 					
						<hr />
						<div class="form-group <?php if(form_error('conv_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Conversion Type
							<span class="text-red"></span></label>
                            <div class="col-md-9">    	
										<input type="radio" name="conv_type"  value="wallet" checked id="type_0" />Cash To Wallet
										<input type="radio" name="conv_type" value="cash" id="type_1" />Wallet To Cash                      
                                <?php echo form_error('conv_type') ?>
                            </div>
                        </div> 
						<div class="form-group <?php if(form_error('cash')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">    Cash to Wallet Points 
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="number" name="cash" step="1" min="0" max="<?php  echo ($wallet); ?>" class="form-control" value="<?php echo set_value('$wallet'); ?>" placeholder="Enter Cash">
									<?php echo form_error('cash') ?>
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

						    <div class="form-group <?php if(form_error('tranx_id')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Enter OTP to proceed transaction
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="tranx_id" class="form-control" value="<?php echo set_value('tranx_id'); ?>" placeholder="6 digit OTP/SMS password">
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

