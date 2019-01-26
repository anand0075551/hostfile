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

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
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
                </div><!-- /.box-body -->
            </div><!-- /.box -->
		
		
		
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Add Funds to Pay Specifications</h3>
                </div><!-- /.box-header -->
				
				
                <!-- form start -->
				
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>		
<div class="form-group <?php if(form_error('bal_cash')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Current Balance Cash With Organization
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
									<input type="number" name="bal_cash" readonly step="0.01" min="1" class="form-control" value="<?php echo $assets; ?>" placeholder="Enter Amount">
									<?php echo form_error('bal_cash') ?>

								</div>
						</div>	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					<div class="form-group <?php if(form_error('acct_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Main Account/Category Type</label>
                            <div class="col-md-9">
												<!-- info row -->
							  <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                                            
									<select name="acct_id" class="form-control">
										<option value=""> Select Main Account </option>
												<?php foreach($ledger1->result() as $ledger){
													echo '<option value="'.$ledger->id.'">'.$ledger->name.'</option>';
												}                                        
												?>
										</select>
                                   </div>
                              </div><!-- /.row -->		
							      <?php echo form_error('acct_id') ?>
							    </div>
                        </div>  						
						</table>
		
						
					<table id="deposit" class="table table-bordered table-striped table-hover">
					<div class="form-group <?php if(form_error('pay_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Sub-Account/Pay Specification</label>
                            <div class="col-md-9">
												<!-- info row -->
							  <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                                            
									<select name="pay_type" class="form-control">
										<option value=""> Select Sub-Account </option>
												<?php foreach($ledger2->result() as $ledger){
													echo '<option value="'.$ledger->id.'">'.$ledger->name.'</option>';
												}                                        
												?>
										</select>
                                   </div>
                              </div><!-- /.row -->		
							      <?php echo form_error('pay_type') ?>
							    </div>
                        </div>  						
						</table>					
					
						
						<div class="form-group <?php if(form_error('trans_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Transfer Type
							<span class="text-red"></span></label>
                            <div class="col-md-9">    	
										
										<input type="radio" name="trans_type" checked value="Debit" id="type_1" />Debit/Deposit to Account        
										<input type="radio" name="trans_type"  value="Credit" id="type_0" />Credit/Deduction from Account										
                                <?php echo form_error('trans_type') ?>
                            </div>
                        </div> 		 
						
						<div class="form-group <?php if(form_error('cash')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Amount
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">
									<input type="number" name="cash" step="0.01" min="1" class="form-control" value="<?php echo set_value('cash'); ?>" placeholder="Enter Amount">
									<?php echo form_error('cash') ?>

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
						 
						<div class="form-group <?php if(form_error('userfile')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Attach Transaction Reciept/Challan
                              <!--  <span class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</span> -->
                            </label>
                            <div class="col-md-9">
                                <input type="file" name="userfile" class="form-control" size="20" />
                                <?php echo form_error('userfile') ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                  


					
	


						</div><!-- /.box-body -->						
					</table>	
						
                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_ledger" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Ledger Details
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
                    "url": "<?php echo base_url('ledger/vouchersListJson'); ?>",
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

