
<?php function page_css(){ ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- Date-Time Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
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
                    
                </div><!-- /.box-header -->
				
				
				<?php 
					$user_info = $this->session->userdata('logged_user');
					$user_id = $user_info['user_id'];
					$query = $this->db->get_where('vouchers', ['user_id' => $user_id, 'paid_to' => $user_id]);
					if($query->num_rows() > 0){
				?>
					<div class="row" style="padding:20px; margin:auto; border-bottom:1px solid lightgray; border-radius:0px 0px 30px 30px;">
						<div class="col-md-12">
							<div class="row">
								<div class="col-sm-3" style="margin-top:10px;">
									<select class="form-control" name="consumer" id="consumer" style=" width:100% auto; ">
										<option value="">Consumer Name</option>
										<?php
											$get_consumer = $this->db->group_by('paid_by')->get_where('vouchers', ['user_id' => $user_id, 'paid_to' => $user_id]);
											foreach($get_consumer->result() as $user){
												echo "<option value='".$user->paid_by."'>".singleDbTableRow($user->paid_by)->referral_code."-".singleDbTableRow($user->paid_by)->first_name." ".singleDbTableRow($user->paid_by)->last_name."</option>";
											}
										?>
									</select>
								</div>
								<div class="col-sm-2" style="margin-top:10px;">
									<select class="form-control" name="token_no" id="token_no" style=" width:100% auto; ">
										<option value="">Token Number</option>
										<?php
											$get_tokens = $this->db->group_by('token_no')->order_by('token_no','asc')->get_where('vouchers', ['user_id' => $user_id, 'paid_to' => $user_id]);
											foreach($get_tokens->result() as $token){
												echo "<option value='".$token->token_no."'>".$token->token_no."</option>";
											}
										?>
									</select>
								</div>
								<div class="col-sm-2" style="margin-top:10px;">
									<input type="text" class="some_class form-control" value="" id="on_date" placeholder="On Date" style="height:27px;">
								</div>
								<div class="col-sm-2" style="margin-top:10px;">
									<input type="text" class="some_class form-control" value="" id="from_date" placeholder="From Date" style="height:27px;">
								</div>
								<div class="col-sm-2" style="margin-top:10px;">
									<input type="text" class="some_class form-control" value="" id="to_date" placeholder="To Date" style="height:27px;">
								</div>
								<div class="col-sm-1 text-center" style="margin-top:10px;">
									<button type="button" name="submit" value="search" class="btn btn-primary btn-sm btn-flat" onClick="search_result()" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); height:27px; padding-top:3px;"><i class="fa fa-search"></i> Search </button>
								</div>	
							</div>
							<div class="row" id="search_sts" style="display:none; padding-top:10px;">
								<div class="col-sm-12 text-center">
									<font color="red"><label id="search_msg">Please Select Any Criteria To Refine Record!</label></font>
								</div>
							</div>
						</div>	
					</div>
					
					<div class="row" style="padding:20px;">
						<div class="col-sm-12 text-right">
							<button class="btn btn-success" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);" onclick="location.reload();"><i class="fa fa-gift"></i> New Tokens </button>
							<a class="btn btn-danger" href="<?php echo base_url('voucher_redeem/reset_token');?>" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-undo" aria-hidden="true"></i> Reset Token Number </a>
						</div>
					</div>
				<?php
					}
				?>
				
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
								<th>Paid By</th>
								<th>Service Type</th>
								<th>Table No</th>
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
								<th>Paid By</th>
								<th>Service Type</th>
								<th>Table No</th>
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
			"ajax": "<?php echo base_url('voucher_redeem/vendor_receive_payments_list'); ?>"
		});
	});

	

function search_result()
	{
		var consumer     = $("#consumer").val();
		var token_no	 = $("#token_no").val();
		var from_date	 = $("#from_date").val();
		var to_date	 	 = $("#to_date").val();
		var on_date	 	 = $("#on_date").val();
		
	//	alert(from_date);
	//	alert(to_date);
		
		if(consumer == "" && token_no == "" && from_date == "" && to_date == "" && on_date == ""){
			$('#search_sts').fadeIn();
		}
		else if(consumer != "" || token_no != "" || from_date != "" || to_date != "" || on_date != ""){
			$('#search_sts').slideUp(500);
			
			var mydata = {"consumer" : consumer, "token_no" : token_no, "from_date" : from_date, "to_date" : to_date, "on_date" : on_date};
		
			$(function() {
				$("#example").dataTable({
					"destroy": true,
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "<?php echo base_url('voucher_redeem/token_search_ListJson'); ?>",
						"type":"POST",
						"data": mydata
					 }
				});
			});
		}
	
	}


</script>


<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>
   
	
    <script>/*
window.onerror = function(errorMsg) {
    $('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

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
    //defaultDate:'8.12.1986', // it's my birthday
    defaultDate:'+03.01.1970', // it's my birthday
    defaultTime:'10:00',
    timepickerScrollbar:false
});




</script>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>


<script>
	function get_vouchers(voc_type){
		//alert(voc_type);
		var mydata = {"voc_type" : voc_type};
		$.ajax({
			type 	: "POST",
			url  	: "<?php echo base_url('voucher_redeem/get_vouchers'); ?>",
			data 	: mydata,
			success : function(response){
				$("#voucher_id").html(response);
			}
		})
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
                url : "<?php echo base_url('welcome/uniqueReferralCodeApi'); ?>",
                data : { referredByCode : payee_consumer_id }
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


<?php } ?>

