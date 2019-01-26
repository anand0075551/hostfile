<!---
1. Below fields are Bank details input field to add Bank & Branch details through Admin.
2. Rules and form Data Validation through app\controllers\Bank.php\  public function add_bank
3. DB SQL Post happens through 			  app\models\Agent_model.php\public function add_bank






-->

<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

<?php } ?>
<?php

/**Accounts*** Standard data Retrieval*/
foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 

$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;

/* Available Balance Wallet,loyality and Discount Points */

$wallet_balance    = ( $wal_debit - $wal_credit ) ;


?>
<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Cash or Reimbursement Request </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
						
						<div class="col-sm-12">
							<div class="panel-heading">					
								<div class="row">
							
								
								<div class="col-sm-12">
									<h3 class="text-green">Consumer1st Account Details</h3>
									 <h4  class="text-blue"> <b><?php echo $users->first_name.' '.$users->last_name ?></b></h4><h4 class="text-red">Pre-paid Balance = <?php echo number_format($wallet_balance, 2) ?></h4>
<?php	 if ($users->role == 'agent') {?>
									 <h4 class="text-blue">Firm Name: = <?php echo  $users->company_name; ?></h4>
								<?php } ?>									
									<ul>	
											<li>Consumer1st Account No: <?php echo $users->account_no ?>  </li>
											<li>User Role: <?php echo typeDbTableRow($users->rolename)->rolename; ?></li>
											<li>Email: <?php echo $users->email ?>, Phone: <?php echo $users->contactno ?></li>
											<li> PIN Code: <?php echo $users->postal_code ?>,  Adhaar no: <?php echo $users->adhaar_no ?></li>
									</ul>
								</div>
								
								<div class="col-sm-12">
									<h3 class="text-green">Bank Account Details</h3>
									 <h4  class="text-blue"> <b><?php echo $users->first_name.' '.$users->last_name ?></b></h4>
								<?php	 if ($users->role == 'agent') {?>
									 <h4 class="text-blue">Firm Name: = <?php echo  $users->company_name; ?></h4>
								<?php } ?>
										<ul>
											<li>Bank Name: <?php echo $users->bank_name ?>  </li>										
											<li>Bank Account Type: <?php if ($users->bank_acc_type == '01') 
																		{ echo 'Savings Account';
																	    }else{ echo 'Current Account'; } ?>  </li>
											<li>Bank Account No: <?php echo $users->bank_account ?>  </li>	
											<li>Bank IFS Code: <?php echo $users->ifsc_code ?>  </li>												
											<li>Bank Branch & Address: <?php echo $users->bank_address ?>  </li>
											
											<li>Email: <?php echo $users->email ?>, Phone: <?php echo $users->contactno ?></li>
											<li> PAN No: <?php echo $users->pan_no ?>,  Adhaar no: <?php echo $users->adhaar_no ?></li>
									</ul>
								</div>
								
								</div>							
							</div>
						</div>
						
						 <div class="form-group <?php if(form_error('bank_account')) echo 'has-error'; ?>">
							<label for="firstName" class="col-md-3">Bank Account Number
								<span class="text-red">*</span>
							</label>
								<div class="col-md-9">
									<input type="number" name="bank_account" readonly value="<?php  echo ($users->bank_account); ?>" class="form-control" placeholder="Enter Amount">
									<?php echo form_error('bank_account') ?>
								</div>
						</div>	
					
						 <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
							<label for="firstName" class="col-md-3">Amount
								<span class="text-red">*</span>
							</label>
								<div class="col-md-9">
									<input type="number" name="amount" min="1" max="<?php  echo ($wallet_balance); ?>" class="form-control" placeholder="Enter Amount">
									<?php echo form_error('amount') ?>
								</div>
						</div>						

						
                        <div class="form-group <?php if(form_error('tranx_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Transaction Remarks
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="tranx_id" class="form-control" value="<?php echo set_value('tranx_id'); ?>" placeholder="Enter Reason">
                                <?php echo form_error('tranx_id') ?>
                         </div>
						 </div> 
					


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!--PATH: Bank/ public function cash_withdrawl() && $insert = $this->Bank_model->cash_withdrawl(); -->
				<?php if	($users->bank_name != '') {?>
                        <button type="submit" name="submit" value="cash_withdrawl" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Submit Cash Withdrawl Request </button>
				<?php }else { ?>
				 <font color="red"><i><b> Kindly Verify/Update Bank Account at Section 'Bank Details'->Self Bank Details.</b></i></font>
				<?php } ?>       
                    </div>
                </form>
            </div><!-- /.box -->

        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

    <!-- InputMask -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- Page script -->
    <script type="text/javascript">
        $(function() {
            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
            //Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
            //Money Euro
            $("[data-mask]").inputmask();

            //Date range picker
            $('#reservation').daterangepicker();
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
            //Date range as a button
            $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                        'Last 7 Days': [moment().subtract('days', 6), moment()],
                        'Last 30 Days': [moment().subtract('days', 29), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                    },
                    startDate: moment().subtract('days', 29),
                    endDate: moment()
                },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
            );

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal',
                radioClass: 'iradio_minimal'
            });
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-red',
                radioClass: 'iradio_flat-red'
            });

            //Colorpicker
            $(".my-colorpicker1").colorpicker();
            //color picker with addon
            $(".my-colorpicker2").colorpicker();

            //Timepicker
            $(".timepicker").timepicker({
                showInputs: false
            });
        });
    </script>

<?php } ?>

