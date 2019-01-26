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
	

<?php } ?>



<?php 
foreach($invoiceQuery->result() as $v); 

$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];

?>


<!-- Main content -->

    <div class="row">
        <!-- left column -->
		<div class="col-md-12">
	
				
            <!-- general form elements -->
            <div class="box box-primary" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); ">
                <div class="box-header">
                    <h3 class="box-title">Verify Payee to Recieve Values</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
								
					<div class="form-group <?php if(form_error('referredByCode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-4">Enter Payee ID(Consumer ID)
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-group">
								<div class="input-group-addon" id="show_btn_div" style="padding:0px; display:none;">
                                   <button type="button" value="show" id="show" style="width:100%; height:30px;"><i class="fa fa-search"></i></button>
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
					<div class="form-group <?php if(form_error('voucher_code')) echo 'has-error'; ?>">
                        <label for="voucher_code" class="col-md-4">LPA Voucher Code
                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-8">
							<input class="form-control" name="voucher_code" id="voucher_code" type="text" value="<?php echo $v->transaction_id; ?>" readonly />
							
                            <?php echo form_error('voucher_code') ?>
                        </div>
                    </div>
					
					<div class="form-group">
                        <div class="col-md-12">
							<table class="table table-bordered table-hover">
								<thead>
									<tr style="background:lavender; font-size:16px">
										<th colspan="3">Order Details</th>
									</tr>
									<tr>
										<th>Product</th>
										<th>Quantity</th>
										<th>CPA Value</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$lpa_db = $this->load->database('loyality_purchase',true);
										$query = $lpa_db->get_where('orders', ['id' => $v->id]);
										if($query->num_rows() > 0){
											$total_cpa = 0;
											$items = '';
											foreach($query->result() as $order);
											$cart_data = unserialize($order->cart_data);
											foreach($cart_data as $cart_item){
												$items .= $cart_item['name'].", ";
												$p_id = $cart_item['id'];
												echo "<tr>";
												echo "<td>".$cart_item['name']."</td>";
												echo "<td>".$cart_item['qty']."</td>";
												$get_cpa = $lpa_db->get_where('products', ['id'=>$p_id]);
												foreach($get_cpa->result() as $cpa){
													$total_cpa = $total_cpa+($cart_item['qty']*$cpa->cpa);
													echo "<td>".$cart_item['qty']*$cpa->cpa."</td>";
												}
												echo "</tr>";
											}
										}
									?>
									<tr style="background:lavender;">
										<th colspan="2">Total CPA Value</th>
										<th><?php echo $total_cpa; ?></th>
									</tr>
								</tbody>
							</table>
                        </div>
                    </div>
					
					
					
					
					<div class="form-group <?php if(form_error('cpa_amount')) echo 'has-error'; ?>" style="display:none">
                        <label for="cpa_amount" class="col-md-4">Total CPA Amount
                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-8">
                            <div class="input-group">
								
                                <div class="input-group-addon">
                                    <i class="fa fa-money"></i>
                                </div>
								
                                <input class="form-control" name="cpa_amount" id="cpa_amount" type="text" value="<?php echo $total_cpa; ?>" readonly />
                            </div>
                            <?php echo form_error('cpa_amount') ?>
                        </div>
                    </div>
					
				
						
						<div class="form-group <?php if(form_error('tranx_id')) echo 'has-error'; ?>" style="display:none;">
                            <label for="exampleInputEmail1" class="col-md-4">All Products
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-8">
								 <div class="input-group">
								
								<div class="input-group-addon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                  <input type="text" name="tranx_id" id="tranx_id" class="form-control" value="<?php echo $items; ?>" placeholder="All Products" readonly >
								</div>
								
                              
                                <?php echo form_error('tranx_id') ?>

                            </div>
                        </div>	
					
					
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer text-right">
					<!-- PATH: Product/public function verify_payee and product_model->otp_transactions();-->
						
						<button type="submit" name="submit" id="complete_order_btn" value="receive_values" class="btn btn-sm btn-success disabled" onclick="clicked();">
                            <i class="fa fa-money"></i> Submit
						</button>
						<span id="warn_msg" style="display:none; font-weight:bold;"><font color="red">Please Do Not Reload The Page To Avoid Double Payment.</font></span>
						<a type="button" class="btn btn-danger btn-sm" href="<?php echo base_url('lpa_purchase_redeem/order_history')  ?>">Cancel</a>
						
						
				  </div>
				  
				  
				  
				  
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
<!-- /.content -->

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
					url : "<?php echo base_url('lpa_purchase_redeem/get_user'); ?>",
					data : mydata,
					success : function(response){
						$("#users").html(response);
					}
				})
		}
		else{
			$("#users").html("<font color='red'>Please Enter Referral ID..!</font>");
		}
		
		$("#users").slideDown();
	});
});

<!--Get voucher details by voucher code-->

$(document).ready(function(){
     $("#lpa_voucher").click(function(){
		var lpa_voucher = $("#voucher_code").val();
		if (lpa_voucher!=""){
			var mydata = {"lpa_voucher":lpa_voucher};
			$.ajax({
					type : "POST",
					url : "<?php echo base_url('lpa_purchase_redeem/get_voucher_details'); ?>",
					data : mydata,
					success : function(response){
						$("#voucher_details").html(response);
					}
				})
		}
		else{
			$("#voucher_details").html("<font color='red'>Please Enter Voucher Code..!</font>");
		}
		
		$("#voucher_details").slideToggle();
	});
});


$(document).ready(function(){
    $("#get_amount").click(function(){
		var amount = $("#amount").val();
		$("#cpa_amount").val(amount);
	});
	$("#get_products").click(function(){
		var products = $("#products").val();
		$("#tranx_id").val(products);
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
                url : "<?php echo base_url('lpa_purchase_redeem/uniqueReferralCodeApi'); ?>",
                data : { referredByCode : referredByCode }
            })
                .done(function(msg){
                    if(msg == 'true'){
                        $('.referralFa').html('<i class="fa fa-check"></i>');
                        iSelector.closest('.input-group').removeClass('has-error');
                        iSelector.closest('.input-group').addClass('has-success');
                        $('#referralCodeStatus').html('<span style="color: #3d9970">Referral code is valid</span>');
						$('#show_btn_div').show();
						$("#complete_order_btn").removeClass('disabled');
                    }else{
                        $('.referralFa').html('<i class="fa fa-ban"></i>');
                        iSelector.closest('.input-group').removeClass('has-success');
                        iSelector.closest('.input-group').addClass('has-error');
                        $('#referralCodeStatus').html('<span style="color: #ff0000">Referral code is Invalid/Inactive</span>');
						$('#show_btn_div').hide();
						$("#complete_order_btn").addClass('disabled');
                    }
                    //alert(msg);
                });


        });
    });
	
	
</script>


<script>
    $(function(){
        $('input[name="voucher_code"]').keyup(function(){
            var iSelector = $(this);
            var voucher_code = iSelector.val();
			var ref_id = $("#referredByCode").val();
            $('.voucherFa').html('<i class="fa fa-refresh fa-spin"></i>');

            $.ajax({
                type : "POST",
                url : "<?php echo base_url('lpa_purchase_redeem/uniqueLpaVoucherCodeApi'); ?>",
                data : { voucher_code : voucher_code, ref_id : ref_id }
            })
                .done(function(msg){
                    if(msg == 'true'){
                        $('.voucherFa').html('<i class="fa fa-check"></i>');
                        iSelector.closest('.input-group').removeClass('has-error');
                        iSelector.closest('.input-group').addClass('has-success');
                        $('#voucher_Status').html('<span style="color: #3d9970">Voucher code is valid</span>');
						$('#show_btn_div').fadeIn();
						
                    }else{
                        $('.voucherFa').html('<i class="fa fa-ban"></i>');
                        iSelector.closest('.input-group').removeClass('has-success');
                        iSelector.closest('.input-group').addClass('has-error');
                        $('#voucher_Status').html('<span style="color: #ff0000">Voucher code is Invalid</span>');
						$('#show_btn_div').fadeOut();
						
                    }
                    //alert(msg);
                });


        });
    });
	
	
</script>

<script>
	function get_details(id){
		//alert(id);
		var lpa_voucher = $("#voucher_code").val();
		if (lpa_voucher!=""){
			var mydata = {"lpa_voucher":lpa_voucher};
			$.ajax({
					type : "POST",
					url : "<?php echo base_url('lpa_purchase_redeem/get_voucher_details'); ?>",
					data : mydata,
					success : function(response){
						$("#voucher_details").html(response);
						var amount = $("#amount").val();
						$("#cpa_amount").val(amount);
						var products = $("#products").val();
						$("#tranx_id").val(products);
						$("#complete_order_btn").removeClass('disabled');
					}
				})
			
		}
		else{
			$("#voucher_details").html("<font color='red'>Please Enter Voucher Code..!</font>");
			$("#cpa_amount").val('');
			$("#tranx_id").val('');
			$("#complete_order_btn").addClass('disabled');
		}
		
		$("#voucher_details").fadeOut();
		$("#voucher_details").fadeIn();
	}
</script>

<script type="text/javascript">
function clicked() {
	$("#complete_order_btn").hide('fast');
	$("#warn_msg").show();
}
</script>


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>
	



<?php } ?>

