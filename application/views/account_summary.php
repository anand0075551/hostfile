<?php
foreach($earnings->result() as $earning);
foreach($referralEarnings->result() as $referralEarning);
foreach($withdrawal->result() as $withdraws);

$totalEarning = $earning->amount;
$refEarning = $referralEarning->amount;
$withdraw = $withdraws->amount;

$rowEarning = $totalEarning - $refEarning;
$credit     = $totalEarning - $withdraw;
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
                    <h3 class="box-title">Company Ledger Accounts</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <table class="table table-bordered">
                        <tr>
                            <th> Company Assets </th>
                            <th> Capital </th>
                            <th> Liabilities </th>
                            <th> Cash </th>							
                            <th> wallets Points </th>

                        </tr>
                        <tr> 

                            <td>
                                <?php  echo amountFormat($rowEarning); ?>
                            </td>

                            <td>
                                <?php  echo amountFormat($refEarning); ?>
                            </td>

                            <td>
                                <?php  echo amountFormat($totalEarning); ?>
                            </td>
                            <td>
                                <?php  echo amountFormat($withdraw); ?>
                            </td>
                            <td>
                                <?php  echo "Pt.  ", ($credit); ?>
                            </td>

                        </tr>
                 
					</table>		
                        
			
					<!--		
                    <table id="example" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
								<th>Account Number</th>
                                <th>Payee Name</th>
                                <th>Amount</th>
                                <th>Paid by</th>
								<th>Transaction Summary</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
<!-- Data field reference from app\controller\Account.php Section public function showListJson(){ line 177->
                        <tfoot>
                            <tr>
								<th>Account Number</th>
                                <th>Payee Name</th>
                                <th>Amount</th>
                                <th>Paid by</th>
								<th>Transaction Summary</th>
                                <th>Date & Time</th>
                            </tr>
                        </tfoot>

                    </table> -->
					
					<table id="deposit" class="table table-bordered table-striped table-hover">
						<br> <br> 
						<div class="form-group <?php if(form_error('capital')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Company Capital
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
									<input type="text" name="capital" class="form-control" value="<?php echo set_value('capital'); ?>" placeholder="Enter New Value for Company Capital">
									<?php echo form_error('capital') ?>

								</div>
						</div>
						<br> <br> <br>
						<div class="form-group <?php if(form_error('liabilities')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Company Liabilities
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
									<input type="text" name="liabilities" class="form-control" value="<?php echo set_value('liabilities'); ?>" placeholder="Enter New Company Liabilities">
									<?php echo form_error('liabilities') ?>

								</div>
						</div>
						<br> <br> <br>
						<div class="form-group <?php if(form_error('cash')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Company Cash
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
									<input type="text" name="cash" class="form-control" value="<?php echo set_value('cash'); ?>" placeholder="Enter Cash">
									<?php echo form_error('cash') ?>

								</div>
						</div>
					
						
						<br> <br> <br>	
						<div class="form-group <-?php if(form_error('pay_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Payment Method</label>
                            <div class="col-md-9">
                                <select name="role" class="form-control">
                                    <option value=""> Select Payment Type </option>
									<option value="dd" <?php echo set_select('pay_type', 'deposit') ?>>Direct Deposit</option>
									<option value="ft" <?php echo set_select('pay_type', 'transfer') ?>>Fund Tranfer</option>                                
								</select>
                                <?php echo form_error('pay_type') ?>
                            </div>
                        </div>
						
						<br> <br> <br> 
					    <div class="form-group <?php if(form_error('deposit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Transaction Reciept No/Remarks
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="deposit" class="form-control" value="<?php echo set_value('deposit'); ?>" placeholder="Enter Transaction Reciept No">
									<?php echo form_error('deposit') ?>

								</div>
						</div> 
					
						<hr />	
						<br> <br> 
						<div class="form-group <?php // if(form_error('street_address')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Upload Challan
							<span class="text-aqua">(Challan Screenshot )</span>
                                <!--<span class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</span>-->
                            </label>
                            <div class="col-md-9">
                                <input type="file" name="userfile" class="form-control" size="20" />
                                <?php // echo form_error('street_address') ?>
                            </div>
                        </div>   
						
				  </table>
						
                </div><!-- /.box-body --><br> <br> 

					
				          <div class="box-footer">
					 <button type="submit" name="submit" value="ledger_details" class="btn btn-primary">
                            <i class="fa fa-key"></i> Add Ledger Details
                        </button>
                        <!--button type="submit" name="submit" value="make_payment" class="btn btn-primary">
                            <i class="fa fa-credit-card"></i> Transfer Payment
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
                "ajax": "<?php echo base_url('account/showBankListJson'); ?>"
            });
        });

    </script>

<?php } ?>

