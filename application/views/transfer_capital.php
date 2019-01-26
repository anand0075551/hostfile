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
 
 foreach( $totalPay_spec->result() as $totalPay_spec);
 $totalPay_spec = $totalPay_spec->debit; 
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
                            <th>Available Cash</th>
                          
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
						</table>       

 
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->
<!-- Main Transfer content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Transfer Capital to Cash </h3>
                </div><!-- /.box-header -->
				
				
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					
								
					<table id="deposit" class="table table-bordered table-striped table-hover">			
					
						<div class="form-group <?php if(form_error('to_pay_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">From Sub-Account Type</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									<select name="to_pay_type" class="form-control">
										<option value="">From Sub-Accounts Type </option>
										<?php foreach($users->result() as $user){
                                            echo '<option value="'.$user->id.'">'.$user->name.'</option>';
											}					
										?>
										 
									</select>		         
							   </div>
                                <?php echo form_error('to_pay_type') ?>
                            </div>
                        </div>

				<table id="deposit" class="table table-bordered table-striped table-hover">
					
						<div class="form-group <?php if(form_error('from_pay_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">To Sub-Account Type</label>
                            <div class="col-md-9">
                                <div class="input-group">                          
									
									 <select name="from_pay_type" class="form-control">
                                        <option value="">To Sub-Account Type</option>
                                        <?php foreach($users->result() as $user){
                                            echo '<option value="'.$user->id.'">'.$user->name.'</option>';
                                        }
                                        
										?>
									
                                    </select>
										         
							   </div>
                                <?php echo form_error('from_pay_type') ?>
                            </div>
                        </div>					
						</table>		
					</table>		
								
					<hr />
						<div class="form-group <?php if(form_error('conv_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Conversion Type
							<span class="text-red"></span></label>
                            <div class="col-md-9">    	
										<input type="radio" name="conv_type"  value="credit"  id="type_0" />Credit
										<input type="radio" name="conv_type" value="debit" checked id="type_1" />Debit                     
                                <?php echo form_error('conv_type') ?>
                            </div>
                        </div> 
								
								
					<table id="deposit" class="table table-bordered table-striped table-hover">		
						
						<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">    Transferrable Amount
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="number" name="amount" step="0.1" min="1" class="form-control" value="<?php echo set_value('amount'); ?>" placeholder="Enter Amount">
									<?php echo form_error('amount') ?>

								</div>
						</div>
					
					
						
						
					    <div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Transaction Reciept No/Remarks
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="remarks" class="form-control" value="<?php echo set_value('remarks'); ?>" placeholder="Enter Transaction Reciept No">
									<?php echo form_error('remarks') ?>

								</div>
						</div> 

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
</table>
                    <div class="box-footer">   <!-- PATH: Ledger/transfer_capital -->
                        <button type="submit" name="submit" value="transfer_capital" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Fund Transfer
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

