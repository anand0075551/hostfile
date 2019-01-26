

	<?php function page_css(){ ?>
		
		
		
	<?php } ?>

	<?php 
		
		foreach($voucher->result() as $v); 
		
	?>
<body style="">		
	<div class="row" style="background:none;">
		<!-- left column -->
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);  border-radius:10px; border:1px solid brown; background:none;">
				
				<!-- form start -->
				<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
					<div class="box-body" style="padding-top:0px;">
						
						<div class="row" style="margin:20px auto;">
							<h4 class="text-right" style="font-weight:bold;">
								Date : <?php echo date('d-M, Y', $v->created_at); ?>
							</h4>
							<h3 class="text-center" style="background: rgba(255, 0, 0, 0.5); color:white; padding:10px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); border-radius:100px; border:2px solid brown;"> <b>
								<?php
									if(singleDbTableRow($v->paid_to)->company_name != ""){
										echo singleDbTableRow($v->paid_to)->company_name;
									}
									else{
										echo singleDbTableRow($v->paid_to)->first_name." ".singleDbTableRow($v->paid_to)->last_name;
									}
									
								?>
							</b></h3>
							<div class="row text-center" style="padding-left:20px; padding-right:20px;">
								<div class="col-md-4"></div>
								<div class="col-md-4" style="border:2px solid brown; padding:0px; border-radius:4px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); background:#FFE4B5;">
									<p style="border-bottom : 2px solid maroon; color:maroon; font-weight:bold; font-size:28px;"> Token </p>
								<p style="font-size:75px; color:maroon; font-weight:bold;"> <?php echo $v->token_no; ?> </p>
								</div>
								<div class="col-md-4"></div>
							</div>
						</div>
						
						
						<div class="row table-responsive" style="margin:25px auto; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); background:	#FFF8DC; border-radius:10px;">
							
							<div class="col-md-12 text-center" >
								<table class="table" align="center" style="border-bottom:1px solid lightgray; color:maroon;">
									<tr>
										<th width="30%">Consumer</th>
										<th width="10%">:</th>
										<th width="60%"><?php 
											echo singleDbTableRow($v->paid_by)->first_name." ".singleDbTableRow($v->paid_by)->last_name; 
										?></th>
									</tr>
									<tr>
										<th>Vouchers</th>
										<th>:</th>
										<th><?php 
											$voucher_id = "";
											$test = explode(',' , $v->voucher_id);
											foreach($test as $test2)
											{
												$voucher_id .= $test2." | ";
											}
											echo $voucher_id; 
										?></th>
									</tr>
									<tr>
										<th>Paying For</th>
										<th>:</th>
										<th><?php 
											echo $v->voucher_description; 
										?></th>
									</tr>
									<tr>
										<th>Amount</th>
										<th>:</th>
										<th><?php 
											echo number_format($v->amount,2); 
										?></th>
									</tr>
									<?php if($v->service_type != ""){ ?>
										<tr>
											<th>Service Type</th>
											<th>:</th>
											<th><?php echo $v->service_type; ?></th>
										</tr>
									<?php if($v->service_type == "Table Service"){ ?>
										<tr>
											<th>Table Number</th>
											<th>:</th>
											<th><?php echo $v->table_no; ?></th>
										</tr>
									<?php } }?>
									
								</table>
							</div>
							
						</div>
						
						<div class="row text-center" style="background:none;">
							<?php 
								$user_info = $this->session->userdata('logged_user');
								$user_id = $user_info['user_id'];	
								if($user_id == $v->paid_to && $v->used == "no"){
							?>
							
							<?php 
								if($v->modified_by != ""){
									if($v->modified_by == $v->paid_by){
										echo ' <a class="btn btn-danger disabled" href="#" title="Cancle"><i class="fa fa-cutlery" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"></i> Cancled </a> ';
									}
									elseif($v->modified_by == $v->paid_to){
										echo ' <a class="btn btn-danger disabled" href="#" title="Cancle"><i class="fa fa-cutlery" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"></i> Rejected </a> ';
									}
								}
								else{
									echo ' <a class="btn btn-success" href="'.base_url('voucher_redeem/accept_payment/'. $v->id).'" title="Accept" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-money"></i> Accept Payment </a> ';
									
									echo ' <a class="btn btn-danger" href="'.base_url('voucher_redeem/reject_order/'. $v->id).'" title="Reject" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-cutlery"></i> Reject Order</a> ';
								}
							?>
							
							
							
							
							<!--
							
								<a type="submit" name="submit" value="transfer" class="btn btn-success" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);" href="< ?php echo base_url('voucher_redeem/accept_payment/'. $v->id); ?>"><i class="fa fa-money"></i> Accept Payment
								</a>
								<a class="btn btn-danger" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);" href="< ?php echo base_url('voucher_redeem/reject_order/'. $v->id); ?>"><i class="fa fa-cutlery"></i> Reject Order
								</a>	-->
							<?php 
								} if(($user_id == $v->paid_to && $v->used == "yes") || ($user_id == $v->paid_by && $v->used == "yes")){
							?>
								<label style="margin-bottom:5px; color:green; font-size:18px;">Payment Accepted.</label><br>
							<?php
								} if($user_id == $v->paid_by && $v->used == "no"){
							?>
								<label style="margin-bottom:5px; color:red; font-size:18px;">Payment Not Accepted.</label><br>
								
							<?php
								if($v->modified_by != ""){
									if($v->modified_by == $v->paid_by){
										echo '<a class="btn btn-danger disabled" href="#" title="Cancled"><i class="fa fa-cutlery" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"></i> Cancled </a> ';
									}
									elseif($v->modified_by == $v->paid_to){
										echo ' <a class="btn btn-danger disabled" href="#" title="Rejected"><i class="fa fa-cutlery" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"></i> Rejected </a> ';
									}
								}
								else{
									echo ' <a class="btn btn-danger" href="'.base_url('voucher_redeem/cancle_order/'. $v->id).'" title="Cancle" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);"><i class="fa fa-cutlery"></i> Cancle Order</a> ';
								}
							?>	
								
							<!--
								<a class="btn btn-danger" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);" href="< ?php echo base_url('voucher_redeem/cancle_order/'. $v->id); ?>"><i class="fa fa-cutlery"></i> Cancle Order
								</a>	-->
							<?php
								}
							?>
							
								
								<button type="button" class="btn btn-default" onclick="location.reload()" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">OK</button>
						</div>
						
					
						
					</div><!--End box body----->
					<!---------------Footer------------>
					
				</form>
			</div><!-- /.box -->
		</div><!--/.col (left) -->
		<!-- right column -->
	</div>
<body>

	<?php function page_js(){ ?>

	
	<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
	<script>
		$('select').select2();
	</script>





	<?php } ?>