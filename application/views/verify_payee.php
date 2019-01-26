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


<!-- Legder Accounts -->
<?php 
/**Accounts**/

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
<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		<div class="box-body">

                <table class="table table-bordered">
						<div class="col-md-12">
							
								
						</div>
				</table>                  
            </div><!-- /.box-body -->
				
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Verify Payee to Transfer Values</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
								<table class="table table-bordered">
								   
								   <tr><th> Available VPA Values			</th> <td> <?php  echo amountFormat($wallet_balance);   ?> 	 </td></tr>
								    <input type="text" hidden name="wallet_balance" value="<?php echo set_value($wallet_balance); ?>" />
								   
								</table>	
								<hr />
				
			        <div class="form-group <?php if(form_error('referredByCode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Enter Payee ID(Consumer ID)
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon referralFa">
                                    <i class="fa fa-warning"></i>
                                </div>
                                <input class="form-control" name="referredByCode" type="text" value="<?php echo set_value('referredByCode'); ?>" placeholder="Consumer Code Excluding Alphabets" />
                            </div>
                            <p id="referralCodeStatus"></p>
                            <?php echo form_error('referredByCode') ?>
                        </div>
                    </div>
				
						
			
					<!--
						<div class="form-group < ?php if(form_error('pay_type')) echo 'has-error'; ?>">
							<label for="firstName" class="col-md-3">Business Pay Category</label>
							<div class="col-md-9">
								 <select name="pay_type" class="form-control">
												<option  value="">Select Payment Specifications</option>
												< ?php
                                                    if($sub_account -> num_rows() > 0 )
                                                    {
                                                     		foreach($sub_account->result() as $account){
															echo '<option value="'.$account->id.'">'.$account->name.'</option>';
													} 
												}                                   
										?>	
										</select>
								 <!-- <input type="text" name="pay_type" class="form-control" value="< ?php echo set_value('pay_type'); ?>" >
							- ->	< ?php echo form_error('pay_type') ?>
							</div>
						</div>
						-->	
						<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Enter Amount to pay
							<span class="text-blue">*</span>
                            </label>
                           <div class="col-md-9">
                            <!--    <input type="text" name="amount" readonly class="form-control" value="<?php echo amountFormat($wallet_balance); ?>" > -->
							 <input type="number" class="form-control individualPrice" name="amount" step="0.01"  min="0" max="<?php  echo ($wallet_balance); ?>" required="" style="width: 100px;" />
                                         	  
                                <?php echo form_error('amount') ?>

                            </div>
                        </div>	
						<hr />
						<div class="form-group <?php if(form_error('transaction_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Transfer or Recieve Payment
							<span class="text-red"></span></label>
                            <div class="col-md-9">    	
										<input type="radio" readonly name="transaction_type" value="Transfer" checked id="type_1" />Transfer  
																			
                                <?php echo form_error('transaction_type') ?>
                            </div>
                        </div> 
						<hr />
						<div class="form-group <?php if(form_error('tranx_id')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Transaction Remarks
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="tranx_id" class="form-control" value="<?php echo set_value('tranx_id'); ?>" placeholder="Enter remarks">
                                <?php echo form_error('tranx_id') ?>

                            </div>
                        </div>						
				<!--			
						<div class="form-group < ?php if(form_error('key_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Please Enter Your Key Code(Any two digits Number/Name) for SMS Authentication
							<span class="text-blue">*</span>
                            </label>
                           <div class="col-md-9">
                                <input type="text" name="key_id"  class="form-control" value="< ?php echo set_value('key_id'); ?>" placeholder="Eg: 25 " >
                                < ?php echo form_error('key_id') ?>

                            </div>
                        </div>	
			-->

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- PATH: Product/public function verify_payee and product_model->otp_transactions();-->
				      <button type="submit" name="submit" value="verify_payee" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Confirm and Proceed to Verify ConsumerID to Transfer Values
							</button>
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
		
<!--Anand J-query-->
	

<!-- For Convertion Ratio Flip View -->
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});

$(document).ready(function(){
    $("#hide").click(function(){
        $("#div1").hide();
		// alert("The paragraph is now hidden");
    });
    $("#show").click(function(){
        $("#div1").show();
		// alert("The paragraph is now Showing");
    });
});

$(document).ready(function(){
    $("#hide").click(function(){
        $("#div2").hide();
		// alert("The paragraph is now hidden");
    });
    $("#show").click(function(){
        $("#div2").show();
		// alert("The paragraph is now Showing");
    });
});
$(document).ready(function(){
     $("button").click(function(){
        $("#div1").fadeIn();
        $("#div2").fadeIn("slow");
        $("#div3").fadeIn(3000);
    });
});


</script>

<style>
#panel, #flip {
    padding: 5px;
    text-align: center;
    background-color: #e5eecc;
    border: solid 1px #c3c3c3;
}

#panel {
    padding: 50px;
    display: none;
}
</style>
<script>
    $(function(){
        $('input[name="referredByCode"]').keyup(function(){
            var iSelector = $(this);
            var referredByCode = iSelector.val();
            $('.referralFa').html('<i class="fa fa-refresh fa-spin"></i>');

            $.ajax({
                type : "POST",
                url : "<?php echo base_url('product/uniqueReferralCodeApi2'); ?>",
                data : { referredByCode : referredByCode }
            })
                .done(function(msg){
                    if(msg == 'true'){
                        $('.referralFa').html('<i class="fa fa-check"></i>');
                        iSelector.closest('.input-group').removeClass('has-error');
                        iSelector.closest('.input-group').addClass('has-success');
                        $('#referralCodeStatus').html('<span style="color: #3d9970">Referral code is valid</span>');
                    }else{
                        $('.referralFa').html('<i class="fa fa-ban"></i>');
                        iSelector.closest('.input-group').removeClass('has-success');
                        iSelector.closest('.input-group').addClass('has-error');
                        $('#referralCodeStatus').html('<span style="color: #ff0000">Referral code is Invalid/Inactive</span>');
                    }
                    //alert(msg);
                });


        });
    });
</script>
<?php } ?>

