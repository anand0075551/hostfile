<?php include('header.php'); ?>
<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>
<?php
	$bg_color = $this->session->userdata('bg_color');
	$biz_id = $this->session->userdata('biz_id');
	
	$get_business_name  = $this->db->get_where('business_groups',['id'=>$biz_id]);
	foreach($get_business_name->result() as $b_name);
	if($b_name->search_box_color == ""){
		$search_box_color = $bg_color;
	}
	else{
		$search_box_color = $b_name->search_box_color;
	}
	
	$get_points_mode = $this->db->get_where('business_groups', ['id'=>$biz_id]);
	if($get_points_mode->num_rows() > 0){
		foreach($get_points_mode->result() as $p_mode);
		if($p_mode->points_mode != ''){
			if($p_mode->points_mode == 'wallet'){
				$points_mode = $p_mode->points_mode;
				$currency = "CPA";
			}
			if($p_mode->points_mode == 'loyality'){
				$points_mode = $p_mode->points_mode;
				$currency = "LPA";
			}
			if($p_mode->points_mode == 'voucher'){
				$points_mode = "wallet";
				$currency = "CPA";
			}
		}
		else{
			$points_mode = "wallet";
			$currency = "CPA";
		}
	}

	$user_info = $this->session->userdata('logged_user');
    $user_id = $user_info['user_id'];
		
    $user_data  	= $this->db->get_where('users',array('id'=>$user_id))->row(); 
    $first_name   	= $user_data->first_name;
    $last_name   	= $user_data->last_name;
    $last_name   	= $user_data->last_name;
	$name           = $first_name.''.$last_name;
    $email   		= $user_data->email;
    $contactno   	= $user_data->contactno;
    $street_address = $user_data->street_address;
    $area_name   	= $user_data->area_name;
    $postal_code   	= $user_data->postal_code;
	
    $account_no   	= $user_data->account_no;
	

?>
<!-- Main content -->

	<!-- /.box-header -->

<!---------------------------------Cart View------------------------------------>

<?php
 if($this->cart->contents()){
	$tax = 0;
	$shipping_cost = 0;
	$sub_total = 0;
	foreach ($this->cart->contents() as $items){
		$biz_id = $this->session->userdata('biz_id');
		if($items['biz_id'] == $biz_id){
			$tax			 = $tax + ($items['tax']*$items['qty']);
			$shipping_cost 	 = $shipping_cost + ($items['shipping_cost']*$items['qty']);
			$sub_total		 = $sub_total + ($items['price'] * $items['qty']);
		}
	}
	$total_test_amount = $sub_total+$tax+$shipping_cost; 
	if($total_test_amount != 0){
?>
<body onload="test()"></body>
<div class="well" style="background:<?php echo $bg_color; ?>">
<?php include('smb_header.php'); ?>
	<hr>
		<div class="row alert alert-info box-header" style="margin:auto; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
		 <i class="fa fa-arrow-down" aria-hidden="true"></i>
		 <span class="col-sm-4 text-left"><font size="4">ORDERS </font></span>
		 <span class="col-sm-8"><font size="4" color="indigo">Pay With Your Vouchers</font></span>
		</div>
	<div class="container">
		<div class="row" style="padding-top:15px;">
			<div class="col-md-7 well table-responsive" style="background:<?php echo $search_box_color; ?>; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
			<?php echo form_open('shopping_cart/cart_check_out') ?>
				<table class="table" style="background:none; border:none; "> 
					<tr style="background:lavender; border:1px solid lightgray;">
					    <th class="text-center" width="10%" style="border:none">Thumbnail</th>
						<th class="text-center" style="border:none">Item </th>
						<th class="text-center" style="border:none">Firm Name </th>
						<th class="text-center" width="5%" style="border:none"> QTY </th>
						<th class="text-center" style="border:none">Item Price</th>
						<th class="text-center" style="border:none">Tax</th>
						<th class="text-center" style="border:none">Shipping Cost</th>
						<th class="text-center" style="border:none">Sub-Total</th>
						<th class="text-center" style="border:none">Remove</th>
					</tr>

					<?php $i = 1; ?>
					<?php
						$tax = 0;
						$shipping_cost = 0;
						$sub_total = 0;
					?>
					<?php foreach ($this->cart->contents() as $items): ?>
					<?php 
				$biz_id = $this->session->userdata('biz_id');
				if($items['biz_id'] == $biz_id){	
			?>
						<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
						<tr>	
							<td style="border:1px solid lightgray;">
								<?php if (isset($items['thumb'])) {?>
							<!--	<a href="< ?php echo base_url('Smb_home/product_font_view?product='.$items['id']) ?>">-->
									<img src="<?php echo base_url('smb_uploads/'.$items['thumb']); ?>" alt="" style="width:80px; height:80px;"></a>
								<?php } else{ ?>
									<img src="<?php echo base_url() ?>assets/system/no_image.jpg" class="img-responsive" style="width:25px">
								<?php } ?>
							</td>
							<td style="border:1px solid lightgray;">
							<?php echo $items['name']; ?>

								<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

									<p>
										<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

											<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

										<?php endforeach; ?>
									</p>

								<?php endif; ?>

						    </td>
							
							<td style="border:1px solid lightgray;"><?php echo singleDbTableRow($items['vendor_id'])->company_name; ?></td>

						 
						 

						 <td width="5%" class="text-center" style="border:1px solid lightgray;">
							<div class="input-group">
								<div class="input-group-addon" style="padding:0px; background:#006dcc;">
                                  <a class="btn btn-xs btn-flat btn-primary" href="<?php echo base_url('shopping_cart/decrease_qty?product_id='.$items['product_id'].'&vendor_id='.$items['vendor_id'].'&qty='.$items['qty'])?>"> <i class="fa fa-minus"></i></a>
                                </div>
								
								<input type="text" value="<?php echo $items['qty'] ?>" readonly style="text-align:center; font-weight:bold; width:50px;">
								
								<div class="input-group-addon" style="padding:0px; background:#006dcc;">
                                  <a class="btn btn-xs btn-flat btn-primary" href="<?php echo base_url('shopping_cart/increase_qty?product_id='.$items['product_id'].'&vendor_id='.$items['vendor_id'])?>"> <i class="fa fa-plus"></i></a>
                                </div>
                                
                            </div>
						</td>				  
						   <td style="border:1px solid lightgray;"><?php echo $this->cart->format_number($items['price']); ?></td>
						   <td style="border:1px solid lightgray;"><?php echo $items['tax_percent']; ?>%</td>
						   <td style="border:1px solid lightgray;"><?php echo $this->cart->format_number($items['shipping_cost']); ?></td>
						  
						  <td style="border:1px solid lightgray;"><?php echo number_format(($items['price'] * $items['qty']), 2); ?></td>
						  <td align="center" style="border:1px solid lightgray;"><a href="<?php echo base_url('shopping_cart/del?id='.$items['rowid']) ?>"><i class="fa fa-trash text-red" aria-hidden="true"></i></a> </td>
						 <?php 
							
							$tax			 = $tax + ($items['tax']*$items['qty']);
							$shipping_cost 	 = $shipping_cost + ($items['shipping_cost']*$items['qty']);
							$sub_total		 = $sub_total + ($items['price'] * $items['qty']);
						?>
						</tr>

					<?php $i++; ?>
					<?php } ?>
					<?php endforeach; ?>
				</table>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-3 well" style="background:<?php echo $search_box_color; ?>; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
				<h4>SHOPPING CART______________</h4>
				<br>
				<table cellpadding="6" cellspacing="1" class="table table-hover" style="border:solid 1px lightgray">
					<tr>
					  <td width="60%"><strong>Sub-Total</strong></td>
					  <td class="text-right" width="40%"> <?php echo number_format($sub_total,2); ?> <?php echo $currency; ?></td>
					</tr>
					
					<tr>
					  <td width="60%"><strong>Tax</strong></td>
					  <td class="text-right" width="40%"> <?php echo number_format($tax,2); ?> <?php echo $currency; ?></td>
					</tr>
					
					<tr>
					  <td width="60%"><strong>Shipping Cost</strong></td>
					  <td class="text-right" width="40%"> <?php echo number_format($shipping_cost,2); ?> <?php echo $currency; ?></td>
					</tr>	
					
					<tr>
					  <td width="60%"><strong>Total</strong></td>
					  <td style="text-align:right"> 
<?php echo number_format(($sub_total+$tax+$shipping_cost),2); ?> <?php echo $currency; ?></td>
					</tr>	
					
					<tr>
					  <td width="60%"><strong>Voucher Discount</strong></td>
					  <td style="text-align:right"><input class="form-control" style="background:none;  border:none; text-align:right;" name="voucher_total_amount" id="total_amount" value="0" type="text" readonly /></td>
					</tr>
				
					<tr style="background:lavender; ">
					  
					  <td width="60%"><strong>Payable Amout</strong></td>
					  <td class="text-right" width="40%">
<input class="form-control" style="background:none; border:none; text-align:right;" name="paybal_amount" id="grand_total" type="text" value="" readonly />

<input id="my_total" type="hidden" value="<?php echo ($sub_total+$tax+$shipping_cost); ?>" readonly />

					  </td>
					</tr>
				</table>
				
<?php 
	$get_voc_permission = $this->db->get_where('business_groups', ['id'=>$biz_id]);
	if($get_voc_permission->num_rows() > 0){
		foreach($get_voc_permission->result() as $voc);
		if($voc->voc_permission != "no"){
			if($voc->voc_type != 0){ 
				$voc_type = $voc->voc_type; 
			}
			else{ 
				$voc_type = 24; 
			}
			if($voc->voc_limit != 0){ 
				$limit = $voc->voc_limit; 

				$today = time();
				$t_date = date("Y-m-d", $today);
				$t_date2 = date("Y-m-d", strtotime($t_date));
				$test_condition = " voucher_name = '".$voc_type."' AND reserved_by = '".$user_id."' AND DATE(FROM_UNIXTIME(reserved_at)) = '".$t_date2."' ";
				$get_voc_sts = $this->db->where($test_condition)->get('vouchers');
				
				if($get_voc_sts->num_rows()>0){ ?>
					<h4 class="text-center"> <font color="red"> Sorry ! You have exceeded your vouchers limit for today. </font> </h4><br>	
				<?php } else{ ?>
					<h4>Select Your Coupon Code If You Have One.</h4><br>
					<div class="row">
						<div class="col-md-12">
							<select class="form-control" name="voucher_id" id="voucher_id" style="width:100%" onchange="get_voucher_amount(this.value)" >
								<option value=""> Select Voucher </option>
								<?php

								$today_date = date("Y-m-d"); 
								$condition =" voucher_name = '".$voc_type."' AND used = 'no' AND reserved = '' AND user_id = '".$user_id."' AND  start_date <= '".$today_date."' AND  end_date >= '".$today_date."' AND amount != 0 ";
								$data = $this->db->order_by('amount','desc')->limit($limit,0)->where($condition)->get('vouchers');

								foreach($data->result() as $row1)
								{
									echo  "<option value='".$row1->voucher_id."'>".$row1->voucher_id." (".number_format($row1->amount,2)." CPA)</option>"; 
								}
								?>
							</select>
							<p id="voucher_status" style="color:red; display:none;"></p>
						</div>
						<center><br>
						<h5 class="text-center"><font color="red">You can use vouchers only once in a day.</font></h5>	
						<button type="button"  id="add_voucher" class="btn btn-primary" > Apply Coupon  </button></center>	
					</div>
					<?php

				}
			} else{?>
				<h4>Select Your Coupon Code If You Have One.</h4><br>
				<div class="row">
					<div class="col-md-12">
						<select class="form-control" name="voucher_id" id="voucher_id" style="width:100%" onchange="get_voucher_amount(this.value)" >
							<option value=""> Select Voucher </option>
							<?php

							$today_date = date("Y-m-d"); 
							$condition =" voucher_name = '".$voc_type."' AND used = 'no' AND reserved = '' AND user_id = '".$user_id."' AND  start_date <= '".$today_date."' AND  end_date >= '".$today_date."' AND amount != 0 ";
							$data = $this->db->order_by('amount','desc')->where($condition)->get('vouchers');

							foreach($data->result() as $row1)
							{
								echo  "<option value='".$row1->voucher_id."'>".$row1->voucher_id." (".number_format($row1->amount,2)." CPA)</option>"; 
							}
							?>
						</select>
						<p id="voucher_status" style="color:red; display:none;"></p>
					</div>
					<center><br><br>
					<button type="button"  id="add_voucher" class="btn btn-primary" > Apply Coupon  </button></center>	
				</div>
				<?php
			}
		} else{ ?>
			<h4 class="text-center"> <font color="red"> Voucher Payment is not Applicable For This Purchase. </font> </h4><br>	
		<?php }
	}
?>				
				
			<input type="hidden" class="form-control" id="all_vouchers" name="all_vouchers"   readonly  />	
			<input type="hidden" class="form-control" name="voucher_amount" id="voucher_amount" readonly />	
				
				
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<!--< ?php if( $this->cart->total() != 0 ){ ?> -->
		<a class="btn btn-primary disabled" id="next_address" onclick="get_address()"> Next </a>
		<!--< ?php } ?> -->
		
		 
		
		 <div class="box-header">
				<div class="row" id="shipping_address" style="display:none;">
				<br>
					<div class="alert alert-info box-header" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
					 <i class="fa fa-arrow-down" aria-hidden="true"></i>  <h4>ADDRESS</h4>
					</div><br>
					<?php 
						$query = $this->db->get_where('user_address',['user_id'=>$user_id, 'address_type'=>'Permanent']);
						if($query->num_rows() > 0)
						{
						foreach($query->result() as $address);
					?>
					<div class="row">
						<div class="col-md-12" >
							
							  <div class="tab-pane active" id="p_address" style="display:none;" style="border:1px solid indigo;">
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-3"><h6>First Name <span class="text-red">*</span></h6>
										<input type="text" class="form-control"  value="<?php echo $first_name; ?>" style="border:2px solid #e7e7e7;"  readonly required/></div>
										<div class="col-md-3"><h6>Last Name <span class="text-red">*</span></h6><input type="text" class="form-control" value="<?php echo $last_name; ?>" style="border:2px solid #e7e7e7;" readonly required/></div>
										<div class="col-md-3"><h6>Phone <span class="text-red">*</span></h6><input type="text" class="form-control" value="<?php echo $contactno; ?>" style="border:2px solid #e7e7e7;"  readonly  required/></div>
										<div class="col-md-1"></div>
									</div><br>
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-3"><h6>Email <span class="text-red">*</span></h6><input type="text" class="form-control" value="<?php echo $email;?>" style="border:2px solid #e7e7e7;"  readonly required/>
										</div>
										<div class="col-md-3"><h6>Pincode <span class="text-red">*</span></h6><input type="text" id="pincode2" class="form-control" value="<?php echo $address->pincode; ?>" style="border:2px solid #e7e7e7;" readonly required/></div>
										<div class="col-md-3"><h6>Area Name <span class="text-red">*</span></h6><input type="text" class="form-control" value="<?php echo $address->land_mark?>" style="border:2px solid #e7e7e7;" readonly required/></div>
										<div class="col-md-1"></div>
									</div><br>
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-9"><h6>Address <span class="text-red">*</span></h6><input id="address2" type="text" class="form-control" value="<?php echo $address->house_buildingno.', '.$address->street_name.', '.$address->location_id.', '.$address->land_mark.', '.$address->district.', '.$address->state.', '.$address->pincode?>" style="border:2px solid #e7e7e7;" readonly required/></div>
										<div class="col-md-2"></div>
									</div>
							  </div>
							  <div class="tab-pane" id="d_address">
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-3"><label>First Name <span class="text-red">*</span></label>
											<input type="text" class="form-control"  value="<?php echo $first_name; ?>" style="border:2px solid #e7e7e7;" name="first_name" id="first_name" readonly />
										</div>
										<div class="col-md-3"><label>Last Name <span class="text-red">*</span></label>
											<input type="text" class="form-control" value="<?php echo $last_name; ?>" style="border:2px solid #e7e7e7;" name="last_name" id="last_name" readonly />
										</div>
										<div class="col-md-3"><label>Phone <span class="text-red">*</span></label>
											<input type="text" class="form-control" value="<?php echo $contactno; ?>" style="border:2px solid #e7e7e7;" name="mobile" id="mobile" readonly />
										</div>
										<div class="col-md-1"></div>
									</div><br>
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-3"><label>Email <span class="text-red">*</span></label>
											<input type="text" class="form-control" value="<?php echo $email;?>" style="border:2px solid #e7e7e7;" name="email" id="email" readonly />
										</div>
										<div class="col-md-3"><label>Pincode <span class="text-red">*</span></label>
											<input type="text" id="pincode2" name="pincode" class="form-control" value="<?php echo $address->pincode; ?>" style="border:2px solid #e7e7e7;" readonly required/>
										</div>
										<div class="col-md-3"><label>Area Name <span class="text-red">*</span></label>
											<input type="text" class="form-control" value="<?php echo $address->land_mark?>" style="border:2px solid #e7e7e7;" name="location" id="location" readonly />	
										</div>
										<div class="col-md-1"></div>
									</div><br>
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-9"><label>Address <span class="text-red">*</span></label>
											<input type="text" class="form-control" value="<?php echo $address->house_buildingno.', '.$address->street_name.', '.$address->location_id.', '.$address->land_mark.', '.$address->district.', '.$address->state.', '.$address->pincode?>"  style="border:2px solid #e7e7e7;" name="address" id="address" readonly />
										</div>
										<div class="col-md-2"></div>
									</div>
							  </div>
						</div>
					</div>
					<br>
					<?php 
						}
						else
						{
						?>
						<div class="row">
							<div class="col-md-12 text-center" style="padding-right:30px;">
								<a href="<?php echo base_url('user_address/addAddress')?>" style=" box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2); " class="btn btn-danger btn-lg btn-flat" > Please Update Your Permanent Address @ My Profile </a>
							</div>
						 
						</div>
							
						<?php
							
						}
					?>
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-primary"  id="next_payment" onclick="get_payment_option()"> Next </a>
					<hr>
				</div>
				
				<div class="row" id="payment_option" style="display:none;">
				<br>
				<div class="alert alert-info box-header" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
				 <i class="fa fa-arrow-down" aria-hidden="true"></i>  <h4>PAYMENTS OPTIONS</h4>
				</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="cc-selector col-sm-4">
							<label class="drinkcard-cc" style="margin-bottom:0px; width:100%; overflow:hidden; height:200px;" for="visa" onclick="radio_check('visa')">
								<img src="<?php echo base_url(); ?>assets/payment_type/voucher.png" width="70%" height="70%" style=" text-align-last:center;" alt="..." class="img-thumbnail img-check" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);">
								<input type="radio" name="pay_type" value="LPA_Deduction" style="display:none;"   autocomplete="off" />
							</label>
						</div>
						<div class="col-md-7"></div>
					</div>
					<div class="row">
						<div class="col-md-12 text-right" id="complete_order_div" style="padding-right:30px;">
							<input type="hidden" name="user_balance" id="user_balance" value="<?php // echo $user_balance; ?>">
						
						 <button id="balance_check_btn" type="button" class="btn btn-primary" onclick="check_balace()"> Place Order </button> 
						
							<div class="row text-center" id="complete_order_btn_div" style="display:none;">
								<div class="col-md-4"></div>
								<div class="col-md-4">
									<input type="hidden" id="hidden_otp" class="form-control">
									<input type="number" id="otp" class="form-control" placeholder="Please Enter OTP" onkeyup="check_otp(this.value)">
								</div>
								<div class="col-md-4">
									<button id="complete_order_btn" type="submit"  onclick="clicked();"  name="submit" value="check_item"  class="btn btn-success disabled" > Complete Your Order By Using Vouchers </button>
								</div>
							</div>
						
						
						</div>
						
					</div>
					<div class="row text-center" id="warn_msg" style="font-size:18px; display:none;">
						<label>
							<font color="green">Thank You For Purchse!</font>
							<br>
							<font color="red">Please Do Not Reload The Page To Avoid Double Payment.</font>
						</label>
					</div>
					<br>
				<?php echo form_close() ?>
			 </div>
		</div>
</div>
<?php } else { ?>
<div class="well" style="background:<?php echo $bg_color; ?>">
	 <?php include('smb_header.php'); ?>
	<hr>
		<div class="row">
			<div class="text-center text-red">
				<center><img src="<?php echo base_url() ?>assets/img/cart_empty.png" class="img-responsive" ></center>
			</div>
			<div class="text-center text-blue">
				<h2 class="text-center">Your Shopping Cart Is Empty</h2>
			</div>
		</div>
	
</div>
<?php } 
} else { ?>
<div class="well" style="background:<?php echo $bg_color; ?>">
	 <?php include('smb_header.php'); ?>
	<br><!-- /.box-header -->
		<div class="row">
			<div class="text-center text-red">
				<center><img src="<?php echo base_url() ?>assets/img/cart_empty.png" class="img-responsive" ></center>
			</div>
			<div class="text-center text-blue">
				<h2 class="text-center">Your Shopping Cart Is Empty</h2>
			</div>
		</div>
	
</div>
<?php } ?>
<!---------------------------------Cart View------------------------------------>

<?php function page_js(){ ?>
<script>

	function test(){
		
		var grand_total = $('#my_total').val();
		var voc_discount = $('#total_amount').val();
		
		var payable_amount = grand_total-voc_discount;
		
		document.getElementById("grand_total").value = parseFloat(payable_amount, 10).toFixed(2);
		
		if(grand_total < payable_amount){
			$('#next_address').addClass('disabled');
		}
	}


	function get_address(){
		$("#shipping_address").slideDown();
	}
	function get_payment_option(){
		var first_name = $("#first_name").val().trim();
		var last_name = $("#last_name").val().trim();
		var mobile = $("#mobile").val().trim();
		var email = $("#email").val().trim();
		var pincode = $("#pincode2").val().trim();
		var location = $("#location").val().trim();
		var address = $("#address").val().trim();
		
		var sts = true;
		
		if(first_name==""){
			$("#first_name").css({"border":"2px solid red"});
			sts = false;
		}
		else{
			$("#first_name").css({"border":"2px solid #e7e7e7"});
			sts = true;
		}
		
		if(last_name==""){
			$("#last_name").css({"border":"2px solid red"});
			sts = false;
		}
		else{
			$("#last_name").css({"border":"2px solid #e7e7e7"});
			sts = true;
		}
		
		if(mobile==""){
			$("#mobile").css({"border":"2px solid red"});
			sts = false;
		}
		else{
			$("#mobile").css({"border":"2px solid #e7e7e7"});
			sts = true;
		}
		
		if(email==""){
			$("#email").css({"border":"2px solid red"});
			sts = false;
		}
		else{
			$("#email").css({"border":"2px solid #e7e7e7"});
			sts = true;
		}
		
		if(address==""){
			$("#address").css({"border":"2px solid red"});
			sts = false;
		}
		else{
			$("#address").css({"border":"2px solid #e7e7e7"});
			sts = true;
		}
		
		if(pincode==""){
			$("#pincode").css({"border":"2px solid red"});
			sts = false;
		}
		else{
			$("#pincode").css({"border":"2px solid #e7e7e7"});
			sts = true;
		}
		
		if(location==""){
			$("#location").css({"border":"2px solid red"});
			sts = false;
		}
		else{
			$("#location").css({"border":"2px solid #e7e7e7"});
			sts = true;
		}
		
		if(first_name!="" && last_name!="" && mobile!="" && email!="" && address!="" && pincode!="" && location!=""){
			$("#payment_option").slideDown();
		}
		
	}
</script>
<script>
$(document).ready(function(e){
    		$(".img-check").click(function(){
				$(this).toggleClass("check");
			});
	});
</script>

<script>
<!--Get Voucher Amount-->
function get_voucher_amount(amount)
{
	//alert(amount);
	var mydata = {"v_id":amount};
	$.ajax({
			type : "POST",
			url : "<?php echo base_url('Smb_home/get_voucher_amount') ?>",
			data : mydata,
			success : function(response){
				//document.getElementById("voucher_amount").value=response;
				$('#voucher_amount').val(response);
			}
		})
}


<!--Get Address If pincode is same-->
function get_add(pincode)
{
	//alert(pincode);
	var pin2 = $("#pincode2").val();
	var add2 = $("#address2").val();
	
	if(pin2 == pincode){
		$("#address").val(add2);
	}
	else{
		$("#address").val("");
	}
	
}

<!--Get Total Amount-->
$(document).ready(function(){	
		var arr = [];
     $("#add_voucher").click(function(){
		 
	var total = document.getElementById("grand_total").value;
	var paybal_amount = total-document.getElementById("voucher_amount").value;

		document.getElementById("grand_total").value = parseFloat(paybal_amount, 10).toFixed(2);
			 
		var amount = document.getElementById("voucher_amount").value;
		var amnt = Number(amount);
		arr.push(amnt);

		
		tot = arr.reduceRight(function(a,b){return a+b;});
		document.getElementById("total_amount").value=parseFloat(tot, 10).toFixed(2);
		document.getElementById("voucher_amount").value=0;
		
		
		var v_id = document.getElementById("voucher_id").value
		var voucher = document.getElementById("all_vouchers").value.trim();
		
	//	alert(v_id);
		if(amount==0)
		{
			document.getElementById("all_vouchers").value=voucher;
		}
		else{
			document.getElementById("all_vouchers").value=voucher+=","+v_id;
			$('#voucher_id option:selected').remove();
		}
	
	if(paybal_amount<=0){
	//	$("#voucher_status").html("Voucher limit exceeded..!");
	//	$("#voucher_status").fadeIn();
		document.getElementById("grand_total").value = 0;
		$("#next_address").removeClass('disabled');
		$("#add_voucher").addClass('disabled');
	}
    });
});

</script>

<script>
	function check_balace()
	{
		var mydata = {"data":1};
		$.ajax({
			type : "POST",
			url : "<?php echo base_url('Smb_home/send_otp') ?>",
			data : mydata,
			success : function(response){
				$('#hidden_otp').val(response);
			}
		})
		$("#balance_check_btn").hide();
		//$("#increase_balance_btn").hide();
		$("#complete_order_btn_div").fadeIn();
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

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>

<script type="text/javascript">
function clicked() {
	$("#complete_order_div").hide('fast');
	$("#warn_msg").fadeIn('fast');
	//alert('Please do not Reload the page or Click the Button again to Avoid Double Payment. Thank You!');
}
</script>
<?php } ?>