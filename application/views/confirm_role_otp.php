<?php function page_css(){ ?>
   
	<!-- Date-Time Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
	  <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php } ?>


<?php 
	$user_info = $this->session->userdata('logged_user');
	$user_id = $user_info['user_id'];
	$currentUser = singleDbTableRow($user_id)->role;
	$role = singleDbTableRow($user_id)->rolename;
	$referral_code = singleDbTableRow($user_id)->referral_code;
	
	//role_transfer table
	foreach($transfer_id->result() as $id); 
	
	
	//user table
	foreach($accept_otp->result() as $accept); 
	
?>

<div class="row">
<div class="text-right">
	<button type="button" class=" btn btn-circle btn-warning"  id="cancel_btn" data-dismiss="modal" onClick="window.location.reload();" ><i class="fa fa-times" aria-hidden="true"></i> </button>
</div>
	<!-- left column -->
	<div class="col-md-12">
		<!-- general form elements -->
		<div class="box box-primary">
		<input type="hidden" id="sen_id" value="<?php echo $id->id; ?>" />
			<div class="box-header"> 
				<h3 class="box-title"> Accepted  Role </h3>
			</div><!-- /.box-header -->
				<div class="box-body">
				<div class="text-center" id="my_box">
						<div class="row">
							<div class="col-md-4"><b>Name</b></div>
							<div class="col-md-8">
								<input type="hidden" name="referral_code" id="referral_code" value="<?php echo $accept->referral_code ?>" />
								<input type="hidden" name="ph_no" id="ph_no" value="<?php echo $accept->contactno ?>" />
								
								<input class="form-control" name="name" id="name" type="text" value="<?php echo $accept->first_name.' '.$accept->last_name; ?>" placeholder="Name" readonly />
							</div>
						</div>
						<div class="row" style="padding-top: 10px; padding-bottom: 10px;">
							<div class="col-md-4"><b>Email</b></div>
							<div class="col-md-8">
								<input class="form-control" name="email" id="email" type="text" value="<?php echo $accept->email; ?>" placeholder="Email" readonly />
							</div>
						</div>
						<div class="row" style="padding-top: 10px; padding-bottom: 10px;">
							<?php
								$pay_mode = $id->points_mode;
									if($pay_mode == 'CPA')
									{
										$pay_type = 'CPA';
										
									}else{
	
										$pay_type = 'LPA';
									}						
							?>
							<div class="col-md-4"><b>Available <?php echo $pay_type; ?> Values</b></div>
							<div class="col-md-8">
								<?php				
									
									$p_mode = $id->points_mode;
									if($p_mode == 'CPA')
									{
										$points_mode = 'wallet';
										
									}else{
	
										$points_mode = 'loyality';
									}
								
									$table_name = "accounts";		 
									$where_array = array('points_mode'=>'wallet', 'account_no' =>$accept->account_no);
									$user_debit = $this->db->select_sum('debit')->where($where_array )->get($table_name); 
										
									foreach( $user_debit->result() 		as $user_debit);
									$users_debit = $user_debit->debit;
									
									$table_name = "accounts";		
									$where_array = array('points_mode'=>'wallet', 'account_no' =>$accept->account_no);
									$user_credit = $this->db->select_sum('credit')->where($where_array )->get($table_name); 
									
									foreach( $user_credit->result() 	as $user_credit);		
									$users_credit      	= $user_credit->credit;
									
									$balance       = ( $users_debit - $users_credit ) ;							
								?>
								
								<input type="hidden" name="points_mode" value="<?php echo $points_mode; ?>" />
								<input class="form-control" name="balance" id="balance" type="text" value="<?php echo $balance; ?>" readonly />
							</div>
						</div>
						<div class="row" style="padding-top: 10px; padding-bottom: 10px;">
							<div class="col-md-4"><b>Grand Total</b></div>
							<div class="col-md-8">
								<?php
									$get_amt = $this->db->get_where('role_transfer',['referral_code'=>$accept->referral_code]);
									foreach($get_amt->result() as $amount);
								?>
								<input class="form-control" name="grand-total" id="grand_total"  type="text" readOnly value="<?php echo $amount->chargeable_amt;?>" />
								
							</div>
						</div>
						<font color="red"><h4> <p align="center" id="msg">  </p></h4></font>
						<div class="row" id="otp_div" style="padding-top: 10px; padding-bottom: 10px; display:none;">
							<div class="col-md-4"><b>OTP</b></div>
							<div class="col-md-8">
								<input class="form-control" type="text" id="ch_otp" value="" placeholder="Enter OTP" onkeyup="check_otp(this.value)" required/>
								<input type="hidden" id="otp_value" class="from-control" / >
							</div>
						</div>
					</div><!--End box body----->
					<div class="box-footer text-right" id="button_div" style="display:none;">
						<button type="button" name="otp" id="otp" class="btn btn-success" onclick="get_otp()">
							<i class="fa fa-edit"></i> Get OTP
						</button>
						
						<h4><div id="counter"></div></h4>
						<button type="button" id="accept" style="display:none;" value="role_transfer" class="btn btn-primary disabled" onclick="accept_role()">
							<i class="fa fa-edit"></i> Submit
						</button>
					</div>
				</div>
			</form>
		</div><!-- /.box -->
	</div><!--/.col (left) -->
	<!-- right column -->
</div>


<?php function page_js(){ ?>

<script>

	var balance 		= $("#balance").val();
	var grand_total 	= $("#grand_total").val();
if(balance > grand_total)
{	

	$("#button_div").fadeIn();
		
}else if(balance < grand_total){
	
	$("#button_div").fadeOut();
	$("#msg").html('Your Balance Is Low...!');	
	
}

function get_otp(){

	var name 	= $("#name").val();
	var ph_no 	= $("#ph_no").val();
		
	var mydata = {"name":name, "ph_no":ph_no};
	$.ajax({
			type : "POST",
			url : "<?php echo base_url('Ref_info/send_otp'); ?>",
			data : mydata,
			success : function(response){
				$("#otp_value").val(response);
			}
		})		
	$("#otp_div").fadeIn();
	$("#accept").fadeIn();
	$("#otp").fadeOut();
	$("#counter").fadeIn();
	
//Timer For otp	
	var seconds = 60;
	function tick() {
		var counter = document.getElementById("counter");
				
		seconds--;
		counter.innerHTML = "<i class='fa fa-clock-o' aria-hidden='true'></i> 0:" + (seconds < 10 ? "0" : "") + String(seconds);
		if( seconds > 0 ) {
			setTimeout(tick, 1000);
		} 
		else {
			$("#counter").fadeOut();
			$("#accept").fadeOut();
			$("#otp").fadeIn();
		}
	}
	tick();

	countdown();
	
}

function check_otp(otp){
	var otp_value 	= $("#otp_value").val();
	if(otp == otp_value)
	{
		$("#accept").removeClass('disabled');
		$("#counter").fadeOut();
				
	}else{
		
		$("#accept").addClass('disabled');
		
	}
	
}

</script>

<script>


function accept_role(){

	var sen_id 			= $("#sen_id").val();
	var referral_code 	= $("#referral_code").val();
	var grand_total 	= $("#grand_total").val();
	
		
	var mydata = {"sen_id":sen_id, "referral_code":referral_code, "grand_total":grand_total};
	$.ajax({
			type : "POST",
			url : "<?php echo base_url('Ref_info/accept_role'); ?>",
			data : mydata,
			success : function(response){
				$('#my_box').html('Thank You For Accepting The Role.');
				$("#accept").addClass('disabled');
				$("#accept").fadeOut();
			}
		})		
	
}

</script>

<?php } ?>