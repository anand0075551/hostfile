<?php function page_css(){ ?>
 <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
	
	<!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
	
<?php } ?>
<?php include('header.php'); ?>
                <!-- Main content -->
<section class="content">
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header">
					
				</div><!-- /.box-header -->
				
				<div class="box-body" style="min-height:450px;">
					<br>
				
					<div class="row no-print" style="margin-bottom:20px;">
						<label for="from_pay_type" class="col-md-3">Label</label>
						<div class="col-md-9" >
							<select class="form-control" style="width:100%" id="label">
								<option value="">Choose Options</option>
								<option value="label1">Personal A/C</option>
								<option value="label2">Real A/C</option>
								<option value="label3">Nominal A/C</option>
							</select>
							<p id="label_sts"></p>
						</div>
					</div>
					
					<div class="row no-print" style="margin-bottom:20px;">
						<label class="col-lg-3">
							Account Type
						</label>
						<div class="col-lg-9">
							<button id="tab1_main_ac" style="background:none; border:none;"><i class="fa fa-circle-o" ></i></button> Main Account
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<button id="tab1_sub_ac" style="background:none; border:none;"><i class="fa fa-check-circle-o" id="tab1_sub_ac"></button></i> Sub Account
						</div>
					</div>
					<div class="no-print" id="main_acct_tab" style="display:none;">
						<div class="row no-print" style="margin-bottom:20px;">
							<label for="from_pay_type" class="col-md-3">Credit/withdraw Accounts Type</label>
							<div class="col-md-9" >
								<select class="form-control" style="width:100%" onchange="get_tab1_sub_account(this.value)" id="main_acct_id1">
									<option value="">Withdraw Accounts Type</option>
									<?php
										$query = $this->db->get_where('acct_categories', ['parentid' => '0']);
										foreach($query->result() as $account){
											echo '<option value="'.$account->id.'">'.$account->id.'-'.$account->name.'</option>';
										}
									?>
								</select>
								<p id="main_acct_sts"></p>
							</div>
						</div>
					</div>
					<div class="no-print" id="sub_acct_tab">
						<div class="row no-print" style="margin-bottom:20px;">
							<label for="from_pay_type" class="col-md-3">Credit/withdraw Accounts Type</label>
							<div class="col-md-9" >
								<select class="form-control" style="width:100%" onchange="get_tab1_sub_account(this.value)" id="main_acct_id">
									<option value="">Withdraw Accounts Type</option>
									<?php
										$query = $this->db->get_where('acct_categories', ['parentid' => '0']);
										foreach($query->result() as $account){
											echo '<option value="'.$account->id.'">'.$account->id.'-'.$account->name.'</option>';
										}
									?>
								</select>
								<p id="main_acct_sts"></p>
							</div>
						</div>
						
						<div class="row no-print" style="margin-bottom:20px;">
							<label for="from_pay_type" class="col-md-3" style="margin-bottom:20px;">Credit/withdraw Sub-Account Type</label>
							<div class="col-md-9" >
								<select class="form-control" style="width:100%" id="tab1_sub_acct_id">
									<option value="">Withdraw Sub-Accounts Type</option>
								</select>
								<p id="sub_acct_sts"></p>
							</div>
						</div>
					</div>
					<div class="row no-print" style="margin-bottom:20px;">
						<div class="col-md-12" >
							<button type="button" name="tab1_sub_transaction" id="sub_transaction" class="btn btn-primary">
								<i class="fa fa-money"> </i> Get Total Transaction
							</button>
						</div>
					</div>
					<hr>
					<div class="row no-print text-right" id="tab1_print" style=" padding-right: 25px; display:none">
				<!--	<button type="button" class="btn btn-primary print-btn" onclick="window.print()"><i class="fa fa-print"></i> Print</button>	-->
						<button type="button" class="btn btn-primary btn-sm print-btn" id="create_pdf"><i class="fa fa-file-pdf-o"></i> Download PDF</button>
					</div>
					<br>
					<div class="row container" id="main_div" style="margin-bottom:20px; display:none" align="center">
						<div class="col-lg-12" id="print_div" style="width:93%; margin-left:15px">
						<div class="row">
							<div class="col-md-4 well" id="sub_label1">
								<font size="4">Personal A/C</font>
								<hr>
								<div id="sub_acc_label1"></div>
								<table class="table table-bordered table-responsive well" style="border-top:2px solid gray;">
									<tr>
										<th width="60%">Total</th>
										<th width="40%" class="text-right">
											<input id="label1_total_amount" style="background:none; border:none;" type="hidden" value="0" readonly>
											<input id="label1_visible_amount" style="background:none; border:none; width:70px;" type="text" readonly>
										</th>
									</tr>
								</table>
								<hr>
							</div>
							
							<div class="col-md-4 well" id="sub_label2">
								<font size="4">Real A/C</font>
								<hr>
								<div id="sub_acc_label2"></div>
								<table class="table table-bordered table-responsive well" style="border-top:2px solid gray;">
									<tr>
										<th width="60%">Total</th>
										<th width="40%" class="text-right">
											<input id="label2_total_amount" style="background:none; border:none;" type="hidden" value="0" readonly>
											<input id="label2_visible_amount" style="background:none; border:none; width:70px;" type="text" readonly>
										</th>
									</tr>
								</table>
								<hr>
							</div>
							
							<div class="col-md-4 well" id="sub_label3">
								<font size="4">Nominal A/C</font>
								<hr>
								<div id="sub_acc_label3"></div>
								<table class="table table-bordered table-responsive well" style="border-top:2px solid gray;">
									<tr>
										<th width="60%">Total</th>
										<th width="40%" class="text-right">
											<input id="label3_total_amount" style="background:none; border:none;" type="hidden" value="0" readonly>
											<input id="label3_visible_amount" style="background:none; border:none; width:70px;" type="text" readonly>
										</th>
									</tr>
								</table>
								<hr>
							</div>
						</div>
						</div>
						
					</div>
					
				</div><!-- /.box-body -->

				<div class="box-footer text-right">	
					Company Balance Sheet Report
				</div>
			</div><!-- /.box -->


		</div><!--/.col (left) -->
	</div>   <!-- /.row -->
</section><!-- /.content -->

 
<?php function page_js(){ ?>

<script>
	$(document).ready(function(){
	var form = $('#print_div'),
	//	cache_width = form.width(),
		a4  =[ 830,  841.89];  // for a4 size paper width and height

	$('#create_pdf').on('click',function(){
		//$('body').scrollTop(0);
		createPDF();
	});
	//create pdf
	function createPDF(){
		getCanvas().then(function(canvas){
			var 
			img = canvas.toDataURL("image/png"),
			doc = new jsPDF({
			  unit:'px', 
			  format:'a3'
			});     
			doc.addImage(img, 'JPEG', 20, 20);
			doc.save('account_statement.pdf');
			//form.width(cache_width);
		});
	}

	// create canvas object
	function getCanvas(){
		form.width((a4[0]*1.33333) -80).css('max-width','none');
		return html2canvas(form,{
			imageTimeout:2000,
			removeContainer:true
		});	
	}

	});
</script>


<script>
$(document).ready(function(){
    $("#tab1_main_ac").click(function(){
		$('#tab1_sub_ac').html('<i class="fa fa-circle-o"></i>');
		$('#tab1_main_ac').html('<i class="fa fa-check-circle-o"></i>');
		$('#sub_acct_tab').slideUp();
		$('#main_acct_tab').slideDown();
    });
	
	$("#tab1_sub_ac").click(function(){
		$('#tab1_sub_ac').html('<i class="fa fa-check-circle-o"></i>');
		$('#tab1_main_ac').html('<i class="fa fa-circle-o"></i>');
		$('#main_acct_tab').slideUp();
		$('#sub_acct_tab').slideDown();
    });
});
</script>

<script>
	function get_tab1_sub_account(id)
	{
		var parent_id = id;
		var mydata = {"parent_id":parent_id};
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('payspec_accounts/get_sub_account');?>",
			data:mydata,
			success:function(response){
				$("#tab1_sub_acct_id").html(response);
			}
		});	
	}
</script>


<script>
	$(document).ready(function(){
		$("#sub_transaction").click(function(){
			var label = $("#label").val();
			var main_acct_id1 = $("#main_acct_id1").val();
			var main_acct_id = $("#main_acct_id").val();
			var sub_acct_id = $("#tab1_sub_acct_id").val();
			var status = true;
			
			if(main_acct_id1 != ""){
				if(label==""){
					$("#label_sts").fadeIn();
					$("#label_sts").html("<font color='red'>Please Select an Option</font>");
					status = false;
				}
				else{
					$("#label_sts").fadeOut();
					status = true;
				}
				
				if(status==true){
					if(label=="label1"){
						var mydata = {"acct_id":main_acct_id1};
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/main_account_transactions');?>",
							data:mydata,
							success:function(response){
								$("#sub_acc_label1").html(response);
							}
						});
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/get_total_amount_main');?>",
							data:mydata,
							success:function(response){
								$("#label1_visible_amount").val(response);
							}
						});
					}
					if(label=="label2"){
						var mydata = {"acct_id":main_acct_id1};
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/main_account_transactions');?>",
							data:mydata,
							success:function(response){
								$("#sub_acc_label2").html(response);
							}
						});
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/get_total_amount_main');?>",
							data:mydata,
							success:function(response){
								$("#label2_visible_amount").val(response);
							}
						});
					}
					if(label=="label3"){
						var mydata = {"acct_id":main_acct_id1};
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/main_account_transactions');?>",
							data:mydata,
							success:function(response){
								$("#sub_acc_label3").html(response);
							}
						});
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/get_total_amount_main');?>",
							data:mydata,
							success:function(response){
								$("#label3_visible_amount").val(response);
							}
						});
					}
					$("#main_div").slideDown();
					$("#tab1_print").fadeIn();
				}
				$('#main_acct_id1 option:selected').remove();
			}
			
			else{
				if(label==""){
					$("#label_sts").fadeIn();
					$("#label_sts").html("<font color='red'>Please Select an Option</font>");
					status = false;
				}
				else{
					$("#label_sts").fadeOut();
					status = true;
				}
				
				if(main_acct_id==""){
					$("#main_acct_sts").fadeIn();
					$("#main_acct_sts").html("<font color='red'>Please Select an Option</font>");
					status = false;
				}
				else{
					$("#main_acct_sts").fadeOut();
					status = true;
				}
				
				if(sub_acct_id==""){
					$("#sub_acct_sts").fadeIn();
					$("#sub_acct_sts").html("<font color='red'>Please Select an Option</font>");
					status = false;
				}
				else{
					$("#sub_acct_sts").fadeOut();
					status = true;
				}
				
				var label1_data = $("#sub_acc_label1").html();
				var label2_data = $("#sub_acc_label2").html();
				var label3_data = $("#sub_acc_label3").html();
				
				var label1_total_amount = $("#label1_total_amount").val();
				var label2_total_amount = $("#label2_total_amount").val();
				var label3_total_amount = $("#label3_total_amount").val();
				
				if(status==true){
					if(label=="label1"){
						var mydata = {"acct_id":sub_acct_id};
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/sub_account_transactions');?>",
							data:mydata,
							success:function(response){
								$("#sub_acc_label1").html(label1_data+response);
							}
						});
						var mydata2 = {"acct_id":sub_acct_id, "amount":label1_total_amount};
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/get_total_amount');?>",
							data:mydata2,
							success:function(response){
								$("#label1_total_amount").val(response);
							}
						});
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/get_visible_amount');?>",
							data:mydata2,
							success:function(response){
								$("#label1_visible_amount").val(response);
							}
						});
					}
					if(label=="label2"){
						var mydata = {"acct_id":sub_acct_id};
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/sub_account_transactions');?>",
							data:mydata,
							success:function(response){
								$("#sub_acc_label2").html(label2_data+response);
							}
						});
						var mydata2 = {"acct_id":sub_acct_id, "amount":label2_total_amount};
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/get_total_amount');?>",
							data:mydata2,
							success:function(response){
								$("#label2_total_amount").val(response);
							}
						});
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/get_visible_amount');?>",
							data:mydata2,
							success:function(response){
								$("#label2_visible_amount").val(response);
							}
						});
					}
					if(label=="label3"){
						var mydata = {"acct_id":sub_acct_id};
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/sub_account_transactions');?>",
							data:mydata,
							success:function(response){
								$("#sub_acc_label3").html(label3_data+response);
							}
						});
						var mydata2 = {"acct_id":sub_acct_id, "amount":label3_total_amount};
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/get_total_amount');?>",
							data:mydata2,
							success:function(response){
								$("#label3_total_amount").val(response);
							}
						});
						$.ajax({
							type:"POST",
							url:"<?php echo base_url('payspec_accounts/get_visible_amount');?>",
							data:mydata2,
							success:function(response){
								$("#label3_visible_amount").val(response);
							}
						});
					}
					$("#main_div").slideDown();
					$("#tab1_print").fadeIn();
				}
				$('#main_acct_id option:selected').remove();
				$('#tab1_sub_acct_id option:selected').remove();
			}
		});
	});
</script>


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>
<?php } ?>