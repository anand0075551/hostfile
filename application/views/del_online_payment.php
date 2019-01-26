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

<?php include('header.php'); ?>
<?php

/**Accounts*** Standard data Retrieval*/
foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 

$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;

/* Available Balance Wallet,loyality and Discount Points */

$wallet_balance    = ( $wal_debit - $wal_credit ) ;


?>



<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Rupees to Rulets</h3>
                </div><!-- /.box-header -->
                <!-- form start -- >
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
						
<!--**************************************************************************************************************************************  -->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
<meta name="author" content="Coderthemes">
<title>Rupees to Rulets Conversion</title>


  <link href="<?php echo base_url('assets/admin'); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url('assets/admin'); ?>/css/core.css" rel="stylesheet" type="text/css"/>
<link href="https://apihit.com/assets/css/components.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url('assets/admin'); ?>/css/icons.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url('assets/admin'); ?>/css/pages.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url('assets/admin'); ?>/css/responsive.css" rel="stylesheet" type="text/css"/>
<script src="https://apihit.com/assets/js/modernizr.min.js"></script>
</head>

			<div class="row">
			<div class="col-sm-6">

			<div class="panel-heading">
			<h3 class="panel-title">Rulets Credit Request Form "1 Rupee = 1 Rulets" </h3>

			<div class="panel-body">
			<div class="col-sm-10">

			<div class="form-group">
			<label for="bank">Bank</label>
			<select name="bank" id="bank" class="form-control" required>
			<option value="">Select Bank</option>
			<option value="SBI">SBI Bank</option>

			</select>
			</div>
			<div class="form-group">
			<label for="deposit_type">Deposit Type</label>
			<select name="deposit_type" id="deposit_type" class="form-control" required>
			<option value="">Select Deposit Type</option>
			<option value="NEFT">NEFT</option>
			<option value="RTGS">RTGS</option>
			<option value="IMPS-IFSC">IMPS-IFSC</option>
			</select>
			</div>
<div class="form-group">
<label for="bank_transaction_id">Bank Transaction ID</label>
<input type="text" class="form-control" id="bank_transaction_id" name="bank_transaction_id" placeholder="Transaction ID" required>
</div>
						<div class="form-group">
						<label for="amount">Amount</label>
						<input type="number" class="form-control" id="amount" name="amount" placeholder=" Enter Amount" required>
						</div>
						
						
<div class="form-group">
<label for="datepicker">Date</label>
<div class="input-group">
<input type="text" class="form-control" placeholder="yyyy/mm/dd" id="datepicker" name="transfer_date" required>
<span class="input-group-addon bg-custom b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
</div>
</div>

<!-- <button type="submit" class="btn btn-success waves-effect waves-dark">Submit</button> Please verify your details for Payment Transfer to your MyFair's Account No -->

</form>
</div>
</div>
</div>
</div>
<div class="col-sm-6">

<div class="panel-heading">
<h3 class="panel-title">Bank Accounts</h3>

<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<h3 class="text-purple">State Bank Of India</h3>
<ul>
<li>Account Name: Consumerfirst Technoservices Pvt Ltd</li>
<li>Account Number: 36050981021</li>
<li>IFSC Code: SBIN0016336</li>
<li>Branch: Vibhutipura, Basava Nagar</li>
<li>State: Bengaluru, Karnataka - 560037</li>
</ul>

</div>
</div>
</div>
</div>
</div>

<div class="col-sm-6">
<div class="panel panel-color panel-purple">
<div class="panel-heading">
<h3 class="panel-title">MyFair's Account Details</h3>
</div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<h3 class="text-black"><?php echo $users->first_name.' '.$users->last_name ?> </h3><h4 class="text-red">Balance Rulets = <?php echo $wallet_balance ?></h4>
<ul>
<li>MyFair's Account No: <?php echo $users->account_no ?>  </li>
<li>User Role: <?php echo $users->rolename ?></li>
<li>Email: <?php echo $users->email ?>, Phone: <?php echo $users->contactno ?></li>
<li> Branch ID: <?php echo $users->city_id ?>,  Pincode: <?php echo $users->postal_code ?></li>

</ul>

</div>
</div>
</div>
</div>
</div>


</div> <!--
<div class="row">
<div class="col-sm-12">
<div class="panel panel-color panel-purple">
<div class="panel-heading">
<h3 class="panel-title">Recent Credit Requests</h3>
</div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<table id="credit-request-list" class="table table-striped table-bordered">
<thead>
<tr>
<th>Request ID</th>
<th>Request On</th>
<th>Bank</th>
<th>Deposit Type</th>
<th>Transaction ID</th>
<th>Transfer Date</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<tr>
<td>13</td>
<td>06 Oct 2016</td>
<td>ICICI</td>
<td>NEFT</td>
<td>1055920046</td>
<td>2016-10-06</td>
<td><span class="text-success">Allotted</span></td>
</tr> 
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div> 
</div>
</div>

</div>
</div>
</div></div>

-->



<!--*************************************************************************************************************************************	- ->				
					
                        <div class="form-group <?php if(form_error('first_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">First Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="first_name" disabled class="form-control" value="<?php echo $users->first_name ?>" placeholder="Enter First Name">
                                <?php echo form_error('first_name') ?>
                            </div>
                        </div>
                       <div class="form-group <?php if(form_error('last_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Last Name</label>
                            <div class="col-md-9">
                                <input type="text" name="last_name" disabled  class="form-control" value="<?php echo $users->last_name ?>" placeholder="Enter Last Name">
                                <?php echo form_error('last_name') ?>
                            </div>
                        </div>                  
						                      

                        <div class="form-group <?php if(form_error('wallet_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Wallet Account Number
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="wallet_no" disabled  value="<?php echo $users->account_no ?>" class="form-control" ">
                                <?php echo form_error('wallet_no') ?>
                            </div>
                        </div>
						 <div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Email address
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="email" name="email" disabled  class="form-control" value="<?php echo $users->email ?>" placeholder="Enter Your Bank associated email">
                                <?php echo form_error('email') ?>
                            </div>
                        </div>

						
                        <div class="form-group <?php if(form_error('contactno')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Contact No
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="contactno" disabled  class="form-control" value="<?php echo $users->contactno ?>" placeholder="Mobile No">
                                <?php echo form_error('contactno') ?>
                         </div>
						 </div>
						 <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
							<label for="firstName" class="col-md-3">Amount
								<span class="text-red">*</span>
							</label>
								<div class="col-md-9">
									<input type="number" name="amount" min="1" class="form-control" placeholder="Enter Amount">
									<?php echo form_error('amount') ?>
								</div>
						</div> -->
                        
                       <div class="box-footer">
                        <button  name="submit"  value="online_payment"  class="btn btn-primary">						
                            <i class="fa fa-edit"></i> Initiate Rupees to Rulets 
                        </button> <font size="3"><span class="text-red">"Please verify AMOUNT before Initiating Rupees to Rulets"</span></font>
                    </div>
                       

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    
              <!--  </form>
            </div><!-- /.box -->

        </div><!--/.col (left) -->
        <!-- right column -- >

    </div>   <!-- /.row -->
</section><!-- /.content -->


</body>
</html>
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

