<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
	
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	
	<!-- Data Libe Search 
    <link href="< ?php echo base_url('assets/data_live_search'); ?>/bootstrap-select.css" rel="stylesheet" type="text/css" />
    <link href="< ?php echo base_url('assets/data_live_search'); ?>/bootstrap.css" rel="stylesheet" type="text/css" />
	<script src="< ?php echo base_url('assets/data_live_search'); ?>/jquery.js"></script>
	<script src="< ?php echo base_url('assets/data_live_search'); ?>/bootstrap.js"></script>
	<script src="< ?php echo base_url('assets/data_live_search'); ?>/bootstrap-select.js"></script>	 -->

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
<?php

$user_info 	 = $this->session->userdata('logged_user');
        $user_id 	 = $user_info['user_id'];
		$rolename    = singleDbTableRow($user_id)->rolename;
		
		

?>
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
                    <h3 class="box-title">Verify Payee to Recieve Values</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
								<table class="table table-bordered">
								   
								   <tr><th> Available CPA Values	</th> <td> <?php  echo amountFormat($wallet_balance);   ?> 	 </td></tr>
								    <input type="text" hidden name="wallet_balance" value="<?php echo set_value($wallet_balance); ?>" />
								   
								</table>	
								<hr />
				
			        <div class="form-group <?php if(form_error('referredByCode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Enter Payee ID(Consumer ID)
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group">
								<div class="input-group-addon" style="padding:1px;">
                                   <button type="button" style="width:100%; height:30px;" value="show" id="show"><i class="fa fa-search"></i></button>
                                </div>
                                <div class="input-group-addon referralFa">
                                    <i class="fa fa-warning"></i>
                                </div>
								
                                <input class="form-control" name="referredByCode" id="referredByCode" type="text" value="<?php echo set_value('referredByCode'); ?>" placeholder="Consumer Code Excluding Alphabets" />
                            </div>
							<p id="referralCodeStatus"></p>
                            <div id="users" style="display:none"></div>
                            <?php echo form_error('referredByCode') ?>
                        </div>
                    </div>
					<hr>
					<div class="form-group <?php if(form_error('voucher_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Voucher Type
                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9">
								<div id="test_voc">
                                <select class="form-control" id="voucher_type" value="<?php echo set_value('voucher_type'); ?>" >
									
									<?php 
										if ($rolename == '11')
										{
											echo "<option value=''>Voucher Type</option>";
											$get_voucher_type = $this->db->group_by('voucher_name')->get('vouchers');
											foreach($get_voucher_type->result() as $v_type){
												echo "<option value='".$v_type->voucher_name."'>".$v_type->voucher_name."</option>";
											}
										}
										elseif($rolename == '33'){
											echo "<option value=''>Voucher Type</option>";
											echo "<option value='Food Coupon'>Food Coupon</option>";
										}
									?>
								</select>
								</div>
								<p> Please Click On Voucher Redeem To Get New Voucher Type </p>
								<div id="voc_check" style="display:none"></div>
                           
                            <?php echo form_error('voucher_type') ?>
                        </div>
                    </div>
					<div class="form-group <?php if(form_error('voucher_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Add Vouchers<br>
                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-4">
                            <div class="input-group">
								
                               <div class="input-group-addon" style="padding:0px;">
                                   <button type="button" value="get_voucher" id="get_voucher"><i  class="fa fa-chevron-right"></i> Click here </button>
                                </div>
								<div class="input-group-addon">
								<select style="width:200px;" name="voucher_id" id="voucher_id" value="<?php echo set_value('voucher_id'); ?>" onchange="get_voucher_amount(this.value)">
									<option value=""> Vouchers List</option>
								</select>
								
								</div>
                                
							 </div>
						
                            <?php echo form_error('voucher_id') ?>
                        </div>
						<div class="col-md-4">
                            <div class="input-group">
								 <div class="input-group-addon">
                                   <i class="fa fa-credit-card"></i>
                                </div>
								<input class="form-control" value="selected Vouchers" readonly />
								</div>
								<textarea class="form-control" id="all_vouchers" name="all_vouchers" value="" style="display:none" readonly  />	</textarea>
							<?php echo form_error('voucher_id') ?>
                        </div>
						
						
                    </div>
					
					<div class="row">
					<label for="firstName" class="col-md-3">click on <i class="fa fa-plus" style="border:1px solid black; padding-left:3px; padding-right:3px;"></i> to use voucher<br>
                            <span class="text-red"></span>
                        </label>
						<div class="col-md-4">
							<div class="input-group">
							<div class="input-group-addon" style="padding:1px;">
                                   <button type="button" value="add_voucher" id="add_voucher" style="width:100%; height:30px;"><i class="fa fa-plus"></i></button>
                                </div>
								<input class="form-control" name="voucher_amount" id="voucher_amount" type="text" value="<?php echo set_value('voucher_amount'); ?>" placeholder="Voucher Amount" readonly />
                            </div>
						</div>
						
						<div class="col-md-4">
							<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
								<input class="form-control" name="total_amount" id="total_amount" type="text" value="<?php echo set_value('total_amount'); ?>" placeholder="Total Amount" readonly />
                            </div>
						</div>
					</div>
					
					
					
					
					
					<hr>
				
						<div class="form-group <?php if(form_error('transaction_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Transfer or Recieve Payment
							<span class="text-red"></span></label>
                            <div class="col-md-9">    	
										<input type="radio" readonly name="transaction_type" value="Recieve" checked id="type_1" />Recieve 
																			
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
					
					
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- PATH: Product/public function verify_payee and product_model->otp_transactions();-->
				      <button type="submit" name="submit" value="receive_values" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Confirm and Proceed to Verify ConsumerID to Recieve Values
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


<!--Get user details by refferal code-->
	
$(document).ready(function(){
     $("#show").click(function(){
		var ref_id = $("#referredByCode").val();
		if (ref_id!=""){
			var mydata = {"ref_id":ref_id};
			$.ajax({
					type : "POST",
					url : "get_user",
					data : mydata,
					success : function(response){
						$("#users").html(response);
					}
				})
		}
		else{
			$("#users").html("<font color='red'>Please Enter Consumer ID..!</font>");
		}
		
		$("#users").slideToggle();
	});
});
	
<!--Get Vouchers-->


	

$(document).ready(function(){
     $("#get_voucher").click(function(){
		 //alert('k');
	var ref_id = $("#referredByCode").val();
	var voucher_type = $("#voucher_type").val();
	//alert(voucher_type);
		if (ref_id=="" || voucher_type==""){
			$("#users").html("<font color='red'>Please Enter Consumer ID..!</font>");
			$("#voc_check").html("<font color='red'>Please Select Voucher Type..!</font>");
			$("#users").slideToggle();	 
			$("#voc_check").slideToggle();	 
		}
		else{
			var user_id = $("#user_id").val();
			var mydata = {"user_id":user_id, "voucher_type":voucher_type};
			$.ajax({
			type : "POST",
			url : "get_voucher",
			data : mydata,
			success : function(response){
				//alert(response);
				$("#voucher_id").html(response);
				$('#get_voucher').hide();
				$('#test_voc').html('<input type="text" name="voucher_type" class="form-control" value="'+voucher_type+'" readonly >');
			}
		})
		}
	});
});

<!--Get Vouchers Amount-->

function get_voucher_amount(amount)
{
	//alert(amount);
	var mydata = {"v_id":amount};
	$.ajax({
			type : "POST",
			url : "get_voucher_amount",
			data : mydata,
			success : function(response){
				//alert(response);
				document.getElementById("voucher_amount").value=response;
				//$("#voucher_id").html(response);
			}
		})
	
	//document.getElementById("voucher_amount").value=amount;
}


<!--Get Total Amount-->
	
	$(document).ready(function(){
		var arr = [];
     $("#add_voucher").click(function(){
	var amount = document.getElementById("voucher_amount").value;
	var amnt = Number(amount);
	arr.push(amnt);
	
	tot = arr.reduceRight(function(a,b){return a+b;});
	document.getElementById("total_amount").value=tot;
	document.getElementById("voucher_amount").value=0;
	
	var v_id = document.getElementById("voucher_id").value
	var voucher = document.getElementById("all_vouchers").value.trim();
	
	if(amount==0)
	{
		document.getElementById("all_vouchers").value=voucher;
	}
	else{
		document.getElementById("all_vouchers").value=voucher+=","+v_id;
	}
	
	$("#all_vouchers").slideDown(1000);
	$('#voucher_id option:selected').remove();
    });
});
	
	

	
	
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
                url : "<?php echo base_url('welcome/uniqueReferralCodeApi'); ?>",
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

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>
	



<?php } ?>

