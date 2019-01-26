<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Date-Time Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>

<?php include('header.php'); ?>
<?php 
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];	
	$rolename    = singleDbTableRow($user_id)->rolename;
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Voucher Payments</h3>
                </div><!-- /.box-header -->
				
				<div class="row" style="padding:10px;">
					<div class="col-lg-12 text-right" style="padding-right:40px;">
						<a class="btn btn-success" href="#" data-toggle="modal" data-target="#create" data-toggle="modal" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-money" aria-hidden="true"></i> Make New Payment </a>
					</div>
				</div>
				
					
				
				
				<div class="box-body">
                <div id="excel_table" class="box-body table-responsive">
					<div id="tab1">
						<table id="example" class="table table-bordered table-striped table-hover">
							<thead>
							<tr>
								<th width="20%">Action</th>
								<th>Date</th>
								<th>Token No</th>
						<!--	<th>Vouchers</th>	-->
								<th>Used For</th>
								<th>Amount</th>
								<th>Paid To</th>
								<th>Order Status</th>
								<th>Payment Status</th>
							</tr>
							</thead>

							<tfoot>
							<tr> 
								<th>Action</th>
								<th>Date</th>
								<th>Token No</th>
						<!--	<th>Vouchers</th>	-->
								<th>Used For</th>
								<th>Amount</th>
								<th>Paid To</th>
								<th>Order Status</th>
								<th>Payment Status</th>
							</tr>
							</tfoot>
						</table>
					</div>
					
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</div>
</section><!-- /.content -->
<div class="box-footer" align="right">

</div>

<!-- Create Category -->
<div class="modal fade" id="create" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding:30px;">
			<div class="row">
				<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-primary" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
				<div class="box-header">
					<h3 class="box-title"> Make Payment </h3>
				</div><!-- /.box-header -->
				<hr>
				<!-- form start -->
				<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
					<div class="box-body">
						
						<div class="form-group">
							<label for="firstName" class="col-md-4">Enter Payee ID(Reciever ID)
								<span class="text-red">*</span>
							</label>
							<div class="col-md-8">
								<div class="input-group">
									<div class="input-group-addon" style="padding:1px;">
									   <button type="button" style="width:100%; height:30px;" value="show" id="show"><i class="fa fa-search"></i></button>
									</div>
									<div class="input-group-addon referralFa">
										<i class="fa fa-warning"></i>
									</div>
									
									<input class="form-control" name="payee_consumer_id" id="payee_consumer_id" type="text" value="<?php echo set_value('payee_consumer_id'); ?>" placeholder="Reciever Code Excluding Alphabets" />
								</div>
								<p id="referralCodeStatus"></p>
								<div id="users" style="display:none" class="table-responsive"></div>
								<?php echo form_error('payee_consumer_id') ?>
							</div>
						</div>
						
						<div class="form-group <?php if(form_error('voucher_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-4">Voucher Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-8">
                                <select name="voucher_type" id="voucher_type" class="form-control" style="width:100% auto;" onchange="get_voc_type(this.value)">
									<option value=""> Choose option </option>
									
								</select>
                                <?php echo form_error('voucher_type') ?>
                            </div>
                        </div>
						
						<div class="form-group">
							<label for="firstName" class="col-md-4">Voucher Name
								<span class="text-red"></span>
							</label>
							<div class="col-md-8">
								<select class="form-control" id="voc_type" name="voc_type" style="width: 100% auto;" onchange="get_vouchers(this.value)">
									<?php 
										echo "<option value=''>Choose option</option>";
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="firstName" class="col-md-4">Vouchers
								<span class="text-red"></span>
							</label>
							<div class="col-md-8">
								<select class="form-control" name="voucher_id" id="voucher_id" style="width: 100% auto;" onchange="get_voucher_amount(this.value)">
									<option value="">Choose Option</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="voc_amount" class="col-md-4">Voucher Amount
								<span class="text-red"></span>
							</label>
							<div class="col-md-8">
								<div class="input-group">
									<input class="form-control" name="voc_amount" id="voc_amount" type="text" value="<?php echo set_value('voc_amount'); ?>" placeholder="Voucher Amount" readonly />
									
									<div class="input-group-addon" style="padding:1px;">
									   <button type="button" id="add_voucher" style="width:100%; height:30px; padding:2px; color:green"><i class="fa fa-credit-card"></i> Use Voucher </button>
									</div>
								</div>
								<?php echo form_error('voc_amount') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="total_voc_amount" class="col-md-4">Total Voucher Amount
								<span class="text-red"></span>
							</label>
							<div class="col-md-8">
								<input class="form-control" name="total_voc_amount" id="total_voc_amount" type="text" value="<?php echo set_value('total_voc_amount'); ?>" placeholder="Total Voucher Amount" readonly />
								<?php echo form_error('total_voc_amount') ?>
							</div>
						</div>
						<div class="form-group">
							<label for="service_type" class="col-md-4">Service Type
								<span class="text-red"></span>
							</label>
							<div class="col-md-8">
								<select class="form-control" name="service_type" style="width: 100% auto;" onchange="get_table(this.value)">
									<option value="">Choose Service Type</option>
									<option value="Take Away">Take Away</option>
									<option value="Counter Service">Counter Service</option>
									<option value="Table Service">Table Service</option>
								</select>
								<?php echo form_error('service_type') ?>
							</div>
						</div>
						<div class="form-group" id="table_no_div" style="display:none;">
							<label for="table_no" class="col-md-4">Table Number
								<span class="text-red"></span>
							</label>
							<div class="col-md-8">
								<input class="form-control" name="table_no" id="table_no" min="0" type="number" value="0" placeholder="Table Number" />
								<?php echo form_error('table_no') ?>
							</div>
						</div>
						<hr>
						<textarea class="form-control" id="all_vouchers" name="all_vouchers" value="" style="display:none" readonly  />	</textarea>
					</div><!--End box body----->
					<!---------------Footer------------>
					<div class="box-footer text-right">
						<button type="submit" name="submit" value="pay" id="proceed_payment" class="btn btn-success btn-sm disabled">
							<i class="fa fa-money"></i> Proceed payment
						</button>
						<span id="warn_msg" style="display:none; font-weight:bold;"><font color="red">Please Do Not Reload The Page To Avoid Double Payment.</font></span>
						<a type="button" class="btn btn-danger btn-sm" href="<?php echo base_url('voucher_redeem/make_payment')  ?>">Cancel</a>
					</div>
				</form>
			</div><!-- /.box -->
		</div>
			</div> 
		</div>
	</div>
	</div>
</div>


<!---------------------------------------- Token ----------------------------------------------->
<div class="modal fade" id="token_box" role="dialog">
    <div class="modal-dialog">
		<!-- Modal content -->
		<div class="modal-content" id="my_modal" style="padding-bottom:15px; padding-top:25px; padding-left:25px; padding-right:25px; border-radius:10px; background-image: url(<?php echo base_url('uploads/my_coupon.png'); ?>); background-size: cover;background-repeat: no-repeat; background-size: 100% 100%; margin-top:50px;">
		</div>
	</div>
</div>
<!------------------------------------------- Token --------------------------->

<!--End Create Category -->
<?php function page_js(){ ?>

<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script type="text/javascript">
	$(function() {
		$("#example").dataTable({
			"processing": true,
			"serverSide": true,	
			"ajax": "<?php echo base_url('voucher_redeem/user_payments_list'); ?>"
		});
	});

</script>

<script>
	function get_voc_type(id)
	{
		var payee_id = $('#payee_consumer_id').val().trim();
		if(payee_id != ""){
			var mydata = {"voc_type" : id , "payee_id" : payee_id};

			$.ajax({
				type: "POST",
				url:  "<?php echo base_url('voucher_redeem/get_voc_type') ?>",
				data: mydata,
				success: function (response) {
				 $("#voc_type").html(response);
				}
			});
		}
		else{
			$('#referralCodeStatus').html('<span style="color: red">Please Enter Payee ID!</span>');
		}
		
	}
</script>	




<script>
	function get_vouchers(voc_type){
		var payee_id = $('#payee_consumer_id').val().trim();
		
		if(payee_id != ""){
			var mydata = {"voc_type" : voc_type , "payee_id" : payee_id};

			$.ajax({
				type 	: "POST",
				url  	: "<?php echo base_url('voucher_redeem/get_payable_vouchers'); ?>",
				data 	: mydata,
				success : function(response){
					$("#voucher_id").html(response);
				}
			})
		}
		else{
			$('#referralCodeStatus').html('<span style="color: red">Please Enter Payee ID!</span>');
		}
	}
</script>

<script>
    $(function(){
        $('input[name="payee_consumer_id"]').keyup(function(){
            var iSelector = $(this);
            var payee_consumer_id = iSelector.val();
            $('.referralFa').html('<i class="fa fa-refresh fa-spin"></i>');

            $.ajax({
                type : "POST",
                url : "<?php echo base_url('voucher_redeem/uniqueReferralCodeApi'); ?>",
                data : { referredByCode : payee_consumer_id }
            })
			.done(function(msg){
				if(msg == 'true'){
					$('.referralFa').html('<i class="fa fa-check"></i>');
					iSelector.closest('.input-group').removeClass('has-error');
					iSelector.closest('.input-group').addClass('has-success');
					$('#referralCodeStatus').html('<span style="color: #3d9970">Referral code is valid</span>');
					
					$.ajax({
						type : "POST",
						url : "<?php echo base_url('voucher_redeem/get_payble_voucher_type'); ?>",
						data : { referredByCode : payee_consumer_id },
						success : function(response){
							if(response != "fail"){
								$("#voucher_type").html(response);
								$('#proceed_payment').removeClass('disabled');
							}
							else{
								$('.referralFa').html('<i class="fa fa-ban"></i>');
								iSelector.closest('.input-group').removeClass('has-success');
								iSelector.closest('.input-group').addClass('has-error');
								$('#referralCodeStatus').html('<span style="color: red">Sorry! Voucher Payment is Not Permitted For This ID.</span>');
								$('#proceed_payment').addClass('disabled');
							}
						}
					})
					
				}else{
					$('.referralFa').html('<i class="fa fa-ban"></i>');
					iSelector.closest('.input-group').removeClass('has-success');
					iSelector.closest('.input-group').addClass('has-error');
					$('#referralCodeStatus').html('<span style="color: #ff0000">Referral code is Invalid/Inactive</span>');
					$('#proceed_payment').addClass('disabled');
				}
				//alert(msg);
			});


        });
    });
	
	$(document).ready(function(){
		$("#show").click(function(){
			var ref_id = $("#payee_consumer_id").val();
			if (ref_id!=""){
				var mydata = {"ref_id":ref_id};
				$.ajax({
						type : "POST",
						url : "<?php echo base_url('voucher_redeem/get_payee'); ?>",
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
	
	
	function get_voucher_amount(amount)
	{
		var mydata = {"v_id":amount};
		$.ajax({
				type : "POST",
				url : "<?php echo base_url('voucher_redeem/get_voucher_amount'); ?>",
				data : mydata,
				success : function(response){
					$("#voc_amount").val(response);
				}
			})
	}
	
	$(document).ready(function(){
		var arr = [];
		$("#add_voucher").click(function(){
		var amount = document.getElementById("voc_amount").value;
		var amnt = Number(amount);
		arr.push(amnt);
		
		tot = arr.reduceRight(function(a,b){return a+b;});
		document.getElementById("total_voc_amount").value=tot;
		document.getElementById("voc_amount").value=0;
		
		var v_id = document.getElementById("voucher_id").value
		var voucher = document.getElementById("all_vouchers").value.trim();
		
		if(amount==0)
		{
			document.getElementById("all_vouchers").value=voucher;
		}
		else{
			document.getElementById("all_vouchers").value=voucher+=","+v_id;
		}
		
		//$("#all_vouchers").slideDown(1000);
		$('#voucher_id option:selected').remove();
		});
	});
</script>

<script>
	function get_table(type){
		if(type == "Table Service"){
			$('#table_no_div').slideDown();
			$('#table_no').val('');
		}
		else{
			$('#table_no_div').slideUp();
			$('#table_no').val(0);
		}
	}
</script>

<script type="text/javascript">
function clicked() {
	$('#proceed_payment').slideUp('fast');
	$("#warn_msg").fadeIn();
}
</script>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<?php } ?>

