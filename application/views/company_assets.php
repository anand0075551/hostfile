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
                    <h3 class="box-title">Account Summary</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <table class="table table-bordered">
                        <tr>
							<th>Cash Balance</th>
                            <th>Earnings</th>
                            <th>Referral Earnings</th>
                            <th>Total Earnings</th>
                            <th>Recieved Payements(Withdrawl)</th>
                            <th>Credit</th>
                        </tr>
                        <tr> 
						<td>
                                <?php  echo amountFormat($credit); ?>
                            </td>
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
                                <?php  echo amountFormat($credit); ?>
                            </td>

                        </tr>
                 
 </table>		
                        
					  
						<hr />	
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
				
						<div class="form-group <?php if(form_error('deposit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Company Assets
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="deposit" class="form-control" value="<?php echo set_value('deposit'); ?>" placeholder="Deposit Amount">
									<?php echo form_error('deposit') ?>

								</div>
						</div>
					<div class="form-group <?php if(form_error('deposit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Company Liabilities
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="deposit" class="form-control" value="<?php echo set_value('deposit'); ?>" placeholder="Deposit Amount">
									<?php echo form_error('deposit') ?>

								</div>
						</div>
					<div class="form-group <?php if(form_error('deposit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Wallet/Cash
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="deposit" class="form-control" value="<?php echo set_value('deposit'); ?>" placeholder="Deposit Amount">
									<?php echo form_error('deposit') ?>

								</div>
						</div>
					
						
							
						<div class="form-group <-?php if(form_error('deposit')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Add Balance Type</label>
                            <div class="col-md-9">
                                <select name="role" class="form-control">
                                    <option value=""> Select Payment Type </option>
									<option value="deposit" <?php echo set_select('profession', 'deposit') ?>>Manual Deposit to Direct Bank Account</option>
									<option value="transfer" <?php echo set_select('profession', 'transfer') ?>>Fund Tranfer From Own Account</option>                                
								</select>
                                <?php echo form_error('deposit') ?>
                            </div>
                        </div>
						
					    <div class="form-group <?php if(form_error('deposit')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Deposit Amount
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="text" name="deposit" class="form-control" value="<?php echo set_value('deposit'); ?>" placeholder="Deposit Amount">
									<?php echo form_error('deposit') ?>

								</div>
						</div>
					
						<hr />	
						<div class="form-group <?php // if(form_error('street_address')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Upload Challan
							<span class="text-aqua">(Bank Deposited Challan )</span>
                                <!--<span class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</span>-->
                            </label>
                            <div class="col-md-9">
                                <input type="file" name="userfile" class="form-control" size="20" />
                                <?php // echo form_error('street_address') ?>
                            </div>
                        </div>   
						
				  </table>
						
                </div><!-- /.box-body -->
				<table id="main_account" class="table table-bordered table-striped table-hover">
				<tfoot>
                            <tr>
						<div class="col-md-9">
								<th>Bank Name</th>
							    <th>Payee Name</th>
								<th>Account Number</th>
								<th>Branch Details</th>
                                <th>IFSC Code</th>
                                <th>MIRC Code</th>
								
					</div>
					 
					       
                        </thead>

                            <tr>
							<?php
								//foreach ($users as $row) 
							{
								
								echo"<td>ICICI Bank</td>";
								echo"<td>MyFair Service</td>";
								echo"<td>111555999</td>";
								echo"<td>MG Road, Bengaluru</td>";
								echo"<td>ICIC0000009</td>";
								echo"<td>56712837465</td>";
								
							    	//echo"<td>".$row['status']."</td>";		
									//echo"<td>".$row['logdate']."</td>";
									//echo"<td> <a href='acc_no?id=".$row['acc_no']."'> Click Here </a> </td>";									
									//echo"<td> <a href='acc_edit?id=".$row['id']."'> Edit </a> </td>";
									//echo"<td> <a href='acc_delete?id=".$row['id']."'> Delete </a> </td>";
								}
								?>
                            </tr>
                        </tfoot>

				</table>
					
				          <div class="box-footer">
					 <button type="submit" name="submit" value="initiate_payment" class="btn btn-primary">
                            <i class="fa fa-key"></i> Initiate Fund Transfer Notification
                        </button>
                        <button type="submit" name="submit" value="make_payment" class="btn btn-primary">
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

