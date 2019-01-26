
<?php function page_css(){ ?>
<!-- Data live search -->
   <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	
  <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />

<?php } ?>

<?php include('header.php'); ?>

<?php
	$user_info = $this->session->userdata('logged_user');
    $user_id = $user_info['user_id'];
		
	$rolename    = singleDbTableRow($user_id)->rolename;
		
    $user_data  	= $this->db->get_where('users',array('id'=>$user_id))->row(); 
    
    $account_no   	= $user_data->account_no;
	
	
	$user_debit = $this->db->select_sum('debit')->get_where('accounts', ['points_mode'=>'wallet', 'account_no' =>$account_no]); 
	
	foreach( $user_debit->result() 		as $user_debit);
	$users_debit			= $user_debit->debit;
	
	$user_credit = $this->db->select_sum('credit')->get_where('accounts', ['points_mode'=>'wallet', 'account_no' =>$account_no]); 
	
	foreach( $user_credit->result() 	as $user_credit);		
	$users_credit      	= $user_credit->credit;
	
	$user_balance       = ( $users_debit - $users_credit ) ;
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
       

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title"Create Food Coupon</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body" id="actualprice">
						
						<div class="form-group <?php if(form_error('voucher_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="voucher_type" id="voucher_type" class="form-control" style="width:100% auto;" onchange="get_food_type(this.value)">
									<option value=""> Choose option </option>
									<?php 
									$get_voc = $this->db->group_by('voucher_type')->get_where('food_voucher_discount', ['to_role'=>$rolename]);
									if ($get_voc->num_rows() > 0) {
										foreach ($get_voc->result() as $v) {

											echo '<option value="'.$v->voucher_type.'"> '.singleDbTableRow($v->voucher_type, 'status')->status.'</option>';
										}
									}
									?>
								</select>
                                <?php echo form_error('voucher_type') ?>
                            </div>
                        </div>
						
                       <div class="form-group <?php if(form_error('food_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" value="<?php echo set_value('food_type')?>">
								<select name="food_type" id="food_type" style="width:100% auto;" class="form-control" onchange="get_coupon_value(this.value)">
                                <option value="">Choose option</option>
								<?php
								$get_food_type = $this->db->group_by('food_type')->get_where('food_voucher_discount', ['to_role'=>$rolename]);
								if($get_food_type->num_rows()>0)
								{
									foreach ($get_food_type->result() as $c) {
										$get_food = $this->db->get_where('food_voucher_scheme', ['id'=>$c->food_type]);
										foreach($get_food->result() as $food);
										$food_type = $food->food_type;
                                        echo '<option value="' . $c->food_type . '">' .$food_type . '</option>';
                                    }
								}
								?>
								</select>
								<p style="display:none; color:red" id="cupon_type_sts">
									Please Select a Voucher Name.
								</p>
                                <?php echo form_error('food_type') ?>

                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="firstName" class="col-md-3">Price Per Voucher
							 <span class="text-red"></span>
							</label>
                            <div class="col-md-9"> 
								<input type="number" id="price_per_plate" class="form-control" value="" placeholder="Price Per Coupon" readonly >
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="firstName" class="col-md-3">Voucher Period
							 <span class="text-red"></span>
							</label>
                            <div class="col-md-9" id="voc_period"> 
								<input type="text" class="form-control" value="" placeholder="Voucher Period" readonly >
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="firstName" class="col-md-3">Validity
							 <span class="text-red"></span>
							</label>
                            <div class="col-md-9"  id="voc_validity"> 
								<input type="text" class="form-control" value="" placeholder="Voucher Validity" readonly >
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('num_tickets')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">No of Vouchers
							 <span class="text-red">*</span>
							</label>
                            <div class="col-md-9"> 
								<input type="number" name="num_tickets" id="num_tickets" class="form-control" value="<?php echo set_value('num_tickets');; ?>" placeholder="Enter Number of Coupons " min="0"  onkeyup="actualvalues(this.value)" >
								<p style="display:none; color:red" id="cupon_no_sts">
									Please Enter Number Of Vouchers You Want To Create.
								</p>
                                <?php echo form_error('num_tickets') ?>
                            </div>
                        </div>
						<div id="voucher_amount_details">
						<div class="form-group">
                            <label for="firstName" class="col-md-3">Discount Per Voucher
							 <span class="text-red"></span>
							</label>
                            <div class="col-md-9"> 
								<input type="number" class="form-control" value="" placeholder="Discount Per Voucher" readonly >
                            </div>
                        </div>
						
					
                        <div class="form-group <?php if(form_error('actual_values')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Actual values
							 <span class="text-red">*</span>
							</label>
                            <div class="col-md-9">						
								<input type="number" name="actual_values" id="actual_values" class="form-control" value="<?php echo set_value('actual_values'); ?>" placeholder="Actual Value for Total Vouchers" readonly>
                                <?php echo form_error('actual_values') ?>
                            </div>
                        </div>
						<div class="form-group <?php if(form_error('ticket_values')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Values
							 <span class="text-red">*</span>
							</label>
                            <div class="col-md-9">						
								<input type="number" name="ticket_values" id="ticket_values" class="form-control" value="<?php echo set_value('ticket_values'); ?>" placeholder="Value for Total Vouchers After Discount" readonly>
                                <?php echo form_error('ticket_values') ?>
                            </div>
                        </div>
                        

                        <div class="form-group <?php if(form_error('you_saved')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">You Saved
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                 <input type="number" name="you_saved" id="you_saved" class="form-control" value="<?php echo set_value('you_saved'); ?>" placeholder="You saved" readonly >
                                <?php echo form_error('you_saved') ?>

                            </div>
                        </div>
                       </div>
					 <div id="business_details"></div>
					 <div id="submit_div">
						<div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Start Date
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                 <input type="text" name="start_date" id="datepicker" class="form-control some_class" value="<?php echo set_value('start_date'); ?>" placeholder="Select Start Date">
								 <p style="display:none; color:red" id="date_sts">
									Please Select a Start Date.
								</p>
                                <?php echo form_error('start_date') ?>

                            </div>
                        </div>
						
						<div class="form-group">
                            
                        <div class="col-md-12" id="complete_order_div">
							<input type="hidden" name="user_balance" id="user_balance" value="<?php echo $user_balance; ?>">
						
							<button id="balance_check_btn" type="button" class="btn btn-primary" onclick="check_balace()"> <i class="fa fa-gift"></i> Create Vouchers </button> 
							
							<div class="row" id="complete_order_btn_div" style="display:none;">
								<label for="firstName" class="col-md-3">OTP
									 <span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="hidden" id="hidden_otp" class="form-control">
									<input type="number" id="otp" class="form-control" placeholder="Please Enter OTP" onkeyup="check_otp(this.value)">
								</div>
								<div class="col-md-4" style="padding-top:15px">
									<button type="submit" name="submit" id="complete_order_btn" value="userfoodvoucher" class="btn btn-success disabled" onclick="clicked();">
									 <i class="fa fa-money"></i>  Create Vouchers By Deducting Your Balance
									</button>
								</div>
							</div>
							
							
							
							
							
						
						 
							<a href="<?php echo base_url('bank/add_bankdeposit')?>" id="increase_balance_btn" class="btn btn-danger" style="display:none;"> <i class="fa fa-money"></i> Insufficient Balance..! Please Increase Your CPA Balance </a>
						</div>
						
                        </div>
						<div class="row" id="warn_msg" style="font-size:16px; padding-left:20px; display:none;">
							<label>
								<font color="red">Please Do Not Reload The Page To Avoid Double Payment.</font>
							</label>
						</div>
						</div>
		            <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- Admin_settings/addAdmin && Settings_models/addAdmin -->
                       
						
						
                    </div>
                </form>
            </div><!-- /.box -->

<input type="hidden" id="txtstartdate" value="<?php echo date('Y-m-d') ?>">
  

        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

    <!-- InputMask -->

  <script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>
   
	
    <script>

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
    $("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
    $.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:    '1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});


var startdate = $("#txtstartdate").val();
$('.some_class').datetimepicker({ minDate: startdate });

$('#default_datetimepicker').datetimepicker({
    formatTime:'H:i',
    formatDate:'d.m.Y',
    defaultDate:'+03.01.1970', // it's my birthday
    defaultTime:'10:00',
    timepickerScrollbar:false
});




</script>
	
<script type="text/javascript">
function actualvalues(id)
{       
//alert(id);
var food = $("#food_type").val().trim();
//alert(food);
if(food==""){
	$("#cupon_type_sts").fadeIn();
}
else{
	$("#cupon_type_sts").fadeOut();
var mydata = {"food":food, "tickets":id};
 $.ajax({
		type: "POST",
		url: "<?php echo base_url('Food_voucher/get_ticket_values') ?>",
		data: mydata,
		success: function (response) {
		 $("#voucher_amount_details").html(response);
		 if(response==""){
			$("#submit_div").hide();
		 }
		 else{
			$("#submit_div").show();
		 }
		}
	}); 
	
}
}
</script>

<script type="text/javascript">
    function get_coupon_value(id)
{       
       //alert(id);
	  
		var mydata = {"food_id":id};
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Food_voucher/get_coupon_value') ?>",
			data: mydata,
			success: function (response) {
				$("#price_per_plate").val(response);
			}
		});  
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Food_voucher/get_coupon_period') ?>",
			data: mydata,
			success: function (response) {
				$("#voc_period").html(response);
			}
		});
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Food_voucher/get_coupon_validity') ?>",
			data: mydata,
			success: function (response) {
				$("#voc_validity").html(response);
			}
		}); 
			
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Food_voucher/get_business_details') ?>",
			data: mydata,
			success: function (response) {
			 $("#business_details").html(response);
			}
		}); 
}
</script>

<script>
	function check_balace()
	{
		var user_balance = $("#user_balance").val();
		var payable_amount = $("#ticket_values").val();
		var date = $("#datepicker").val();
	
		var check = true;
		
		if(payable_amount == ""){
			var check = false;
			$("#cupon_no_sts").fadeIn();
		}
		else{
			var check = true;
			$("#cupon_no_sts").fadeOut();
		}
		
		if(date == ""){
			var check = false;
			$("#date_sts").fadeIn();
		}
		else{
			var check = true;
			$("#date_sts").fadeOut();
		}
		
		var sts = user_balance-payable_amount;
		
		if(check == true){
			if(sts>0){
				var mydata = {"data":sts};
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('Smb_home/send_otp') ?>",
					data : mydata,
					success : function(response){
						$('#hidden_otp').val(response);
					}
				})
				$("#balance_check_btn").hide();
				$("#increase_balance_btn").hide();
				$("#complete_order_btn_div").fadeIn();
			}
			else{
				$("#balance_check_btn").hide();
				$("#complete_order_btn").hide();
				$("#increase_balance_btn").fadeIn();
			}
		}
	}
	
	function check_otp(otp){
		var hidden_otp = $('#hidden_otp').val();
		if(otp == hidden_otp){
			$('#complete_order_btn').removeClass('disabled');
		}
		else{
			$('#complete_order_btn').addClass('disabled');
		}
	}
</script>

<script>
	function get_food_type(id)
	{
		var mydata = {"voc_type" : id };

		$.ajax({
			type: "POST",
			url:  "<?php echo base_url('Food_voucher/get_sub_food_type') ?>",
			data: mydata,
			success: function (response) {
				$("#food_type").html(response);
			}
		});
	}
</script>

<script type="text/javascript">
function clicked() {
	$("#complete_order_div").fadeOut('fast');
	$("#warn_msg").fadeIn();
}
</script>

	<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>
<?php } ?>

