<?php 
	foreach($invoiceQuery ->result() as $invoice); 
	$user_info 	 = $this->session->userdata('logged_user');
	$user_id 	 = $user_info['user_id'];
	$currentUser = singleDbTableRow($user_id)->role;
	$rolename    = singleDbTableRow($user_id)->rolename;
	$email   	 = singleDbTableRow($user_id)->email;
	$tin_no   	 = singleDbTableRow($user_id)->licence;
	$company_name  = singleDbTableRow($user_id)->company_name;
	$contact_no  = singleDbTableRow($user_id)->contactno;
	
?>
<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>Consumer1st SMB Invoice </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

	<!-- PDF Export -->
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jspdf.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/html2canvas.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/jspdf/jquery.min.js'); ?>"></script>
    
</head>
<!-- Main content -->
<section class="content" style="border:1px solid gray;" >
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                
                <div class="box-body" id="print_div" >
                    <!-- Main content -->
                    <section class="content invoice">
                        <!-- title row -->
                        <div class="row" style="padding-left:25px; padding-right:25px; margin:auto;">
							<?php
								$sale_code = $invoice->sale_code; 
								$business = $invoice->business; 
								$query = $this->db->get_where('invoice_display', ['business_type'=>$business]);
								if($query->num_rows() > 0){
									foreach($query->result() as $business_type);
									$heading = $business_type->heading;
									$sub_heading1 = $business_type->sub_heading1;
									$sub_heading2 = $business_type->sub_heading2;
								}
								else{
									$heading = "SMB Invoice";
									$sub_heading1 = "Billed To";
									$sub_heading2 = "Shipped To";
								}
								
							?>
							<div class="col-md-4">
								<img src="<?php echo base_url('assets/img')?>/cfirst_logo.jpg" height="100px" width="170px">
							</div>
							<div class="col-md-4"><h2><?php echo $heading; ?></h2></div>
							<div class="col-md-4">
							
							<?php if($rolename == 11) { ?>
								<p><b>TIN 29401381945<br>
								CONSUMERFIRST TECHNOSERVICES PVT LTD.<br>
								#418, 6th B cross, 6th Block<br>
								KORAMANGALA, BANGLORE-95<br>
								Ph : 080-335-8384</b></p>
							<?php } else {?>
								<p><b><?php echo $tin_no; ?><br>
								<?php echo $company_name; ?><br>
								<?php
									$query = $this->db->get_where('user_address', ['user_id'=>$user_id]);
									if($query->num_rows() > 0){
										foreach($query->result() as $add);
										echo $add->house_buildingno.','.$add->street_name.','.$add->land_mark.'<br>'.$add->location_id.'<br>';
									}
									else{
										echo "";
									}
									
								?>
								Ph : <?php echo $contact_no; ?></b></p>
							<?php } ?>
							
							<p> <b>Invoice ID # : </b><?php echo $sale_code; ?> </p></div>
						</div>
						<hr>
                        <!-- info row -->
                        <div class="row invoice-info" style="padding-left:20px; padding-right:20px;">
                            <div class="col-sm-6 invoice-col">
								<div class="row table-responsive" style="padding:25px; border:1px solid gray; margin:auto; min-height:236px;">
									<p><font size="3"><b><?php echo $sub_heading1.':'; ?></b></font></p>
									<?php 
									if($invoice->shipping_address!="")
									{
										$add = $invoice->shipping_address;
										
										list($f_name, $l_name, $phone, $zip , $email , $location) = explode(",", $add);
										
										list($f_1,$f_2) = explode(":", $f_name);
										$fname = trim($f_2,'"'); // first name
										
										list($l_1,$l_2) = explode(":", $l_name);
										$lname = trim($l_2,'"'); // last name
										
										list($p1,$p2) = explode(":", $phone);
										$c_phone = trim($p2,'"'); // Phone
										
										list($z1,$z2) = explode(":", $zip);
										$zip = trim($z2,'"'); // zip code
										
										list($e1,$e2) = explode(":", $email);
										$c_email = trim($e2,'"'); // Email
										
										list($l1,$l2) = explode(":", $location);
										$loc = trim($l2,'"'); // location
										
																			
									}
									else{
										$fname = "  "; // first name
										$lname = "  "; // last name
										$c_email = "  "; // Email
										$c_phone = "  "; // Phone
										$zip = "  "; // zip code
									}
										
										$shipping_add = json_decode($invoice->shipping_address, true);
										foreach ($shipping_add as $s) {
											$address = $s['address'];
										}
										
									?>
									
									<b>First Name : </b> <?php echo $fname ?> <br>
									<b>Last Name : </b> <?php echo $lname ?> <br>
									<b>Addess :</b>
									<?php 
										echo  	"<br>". $address." <br>
											<b>Zip    : </b>". $zip."<br>
											<b>Phone  : </b>". $c_phone ."<br>
											<b>E-mail : </b>". $c_email;
									?>
								</div>
                            </div><!-- /.col -->
							
							<div class="col-sm-6 invoice-col">
								
								<div class="row table-responsive" style="padding:25px; border:1px solid gray; margin:auto;">
									<div class="col-sm-12 invoice-col">
									   <p><font size="3"><b>Payment Details :</b></font></p>
																		
										<b> Payment Status : </b>  <i> <?php echo $invoice->payment_status ?> </i> <br>
										<b> Payment Method : </b> <?php echo $invoice->payment_type; ?>
									</div>
								</div>
								
								<?php 
									if($invoice->payment_type == 'LPA Deduction'){
										$currency = "LPA";
									}
									if($invoice->payment_type == 'CPA Deduction'){
										$currency = "CPA";
									}
									else{
										$currency = "";
									}
								?>
								
								<div class="row table-responsive" style="padding:25px; border:1px solid gray; margin:auto;">
									<div class="col-md-6">
										<p><b>Order Date :</b></p>
										<p><?php echo date('d M, Y',$invoice->sale_datetime); ?></p>
									</div>
									<div class="col-md-6">
										<p><b>Bill Generated Date :</b></p>
										<p><?php echo date("d M, Y"); ?></p>
									</div>
								</div>
								
							</div>
							
							
                        </div><!-- /.row -->
						<br>
						
						<?php if($rolename == 11) { ?>
						<div class="row invoice-info" style="padding-left:20px; padding-right:20px;">
							<div class="col-sm-12 invoice-col">
								<div class="row table-responsive" style="border:1px solid gray; border-radius:5px 5px 0px 0px; margin:auto;">
									<table class="table table-responsive table-bordered table-hover" style="border-radius:7px 7px 0px 0px;">
										<thead>
											<tr style="background:lavender; font-size:18px;">
												<th colspan="8">Order Details</th>
											</tr>
										</thead>
										<thead>
											<tr class="well">
												<th>#</th>
												<th>Item</th>
												<th>Firm Name</th>
												<th>HSN Code</th>
												<th>Quantity</th>
												<th class="text-right">Unit Cost</th>
												<th class="text-right">Unit Tax(%)</th>
												<th class="text-right">Unit Shipping Cost</th>
												<th class="text-right">Total</th>
											</tr>
										</thead>
										<tbody>
											 <?php
													
													if($invoice->product_details!="")
													{
													$product_details = json_decode($invoice->product_details, true);
													$i =0;
													$total = 0;
													foreach ($product_details as $row1) {
														$i++;
												?>
												<tr>
													<td><?php echo $i; ?></td>
													<td>
													<?php 
														echo $row1['name']."<br>"; 
														$name = $row1['name'];
													?>
													<?php
													$product = $row1['id'];
													
													$query = $this->db->get_where('custom_sales', ['product'=>$product, 'sale_code'=>$sale_code]);
													
													foreach($query->result() as $res)
														{
															echo $res->custom_1."<br>";
															echo $res->custom_2."<br>";
															echo $res->custom_3;
														}
													?>
													</td>
													<td>
														<?php 
															$location = $row1['location'];
															$vendor_id = $row1['vendor'];		
															$get_product = $this->db->get_where('users', ['id'=>$vendor_id]);
															foreach($get_product->result() as $res)
															{
																$vendor = $res->company_name;
															}
															echo $vendor;
														?>
													</td> 
													<td><?php 
														$pro = "product_id";
														$condition = " id = '".$invoice->id."' AND product_details LIKE '%".$pro."%' ";
														$get_sts = $this->db->where($condition)->get('smb_sale');
														if($get_sts->num_rows() > 0){
															echo singleDbTableRow($row1['id'],'smb_stock')->hsn_code;
														}
														else{
															echo singleDbTableRow($row1['id'],'smb_product')->hsn_code;
														}
														 
													?></td>
													<td><?php echo $row1['qty']; ?></td>
													<td class="text-right">
														<?php echo number_format($row1['price'],2); ?> <?php echo $currency; ?>
													</td>
													<td class="text-right">
														<?php 
															$get_product_id = $this->db->get_where('smb_product', ['title'=>$name]);
															foreach($get_product_id->result() as $pr);
														
															$get_details = $this->db->order_by('id','asc')->get_where('smb_stock', ['product'=>$pr->id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor_id]);
															foreach($get_details->result() as $v);
															if($v->tax !=""){
																	echo $v->tax;
																}
																else{
																	echo "0";
																} 
															?> %
													</td>
													<td class="text-right">
														<?php 
															$ship_cost = $row1['shipping_cost']/$row1['qty'];
															echo number_format($ship_cost,2); 
														?> <?php echo $currency; ?>
													</td>
													<td class="text-right">
														<?php echo number_format($row1['subtotal']+$row1['tax'],2); 
															$total += $row1['subtotal']; 
														?> <?php echo $currency; ?>
													</td>
												</tr>
												<?php
													}
													}
												?>
												<?php 
													$get_vouchers = $this->db->order_by('voucher_id', 'asc')->get_where('vouchers', ['used_for'=>$sale_code]);
													if($get_vouchers->num_rows() > 0){
												?>
												<tr><td colspan="8"></td></tr>
												<tr>
													<th></th>
													<th>Used Vouchers</th>
													<td colspan="6">
														<?php
															foreach($get_vouchers->result() as $voc){
																echo $voc->voucher_id.", ";
															}
														?>
													</td>
												</tr>
												<?php } ?>
										</tbody>
									</table>
								</div>
								
								<div class="row table-responsive" style="border:1px solid gray; border-top:none; padding:20px; margin:auto;">
									<div class="col-md-7"></div>
									<div class="col-md-5 text-right">
										<table class="table well">
											<tbody>
											
<?php 
	$product_details = json_decode($invoice->product_details, true);
	
	$cgst_ar1 = array();
	$cgst_ar2 = array();
	$cgst_ar3 = array();
	
	$sgst_ar1 = array();
	$sgst_ar2 = array();
	$sgst_ar3 = array();

	foreach ($product_details as $row1) {
		
		array_push($cgst_ar1, singleDbTableRow($row1['id'], 'smb_stock')->sp_tax1);
	
		array_push($cgst_ar2, singleDbTableRow($row1['id'], 'smb_stock')->sp_tax1);

		array_push($cgst_ar3, (($row1['tax']/singleDbTableRow($row1['id'], 'smb_stock')->tax)*singleDbTableRow($row1['id'], 'smb_stock')->sp_tax1));
		
		array_push($sgst_ar1, singleDbTableRow($row1['id'], 'smb_stock')->sp_tax2);
	
		array_push($sgst_ar2, singleDbTableRow($row1['id'], 'smb_stock')->sp_tax2);

		array_push($sgst_ar3, (($row1['tax']/singleDbTableRow($row1['id'], 'smb_stock')->tax)*singleDbTableRow($row1['id'], 'smb_stock')->sp_tax2));
		
	}
	$cgst_val = 0;
	$sgst_val = 0;

	$cgst_tax1 = "";
	$cgst_tax2 = "";
	$sgst_tax1 = "";
	$sgst_tax2 = "";

	for($j=0; $j<count($cgst_ar1); $j++){
		for($k=0; $k<count($cgst_ar1); $k++){
			if($cgst_ar1[$j] != $cgst_ar2[$k]){
				$cgst_tax1 .= '<tr>
				<td><b>CGST ('.$cgst_ar1[$k].'%)</b></td>
				<td>:</td>
				<td class="text-right">'.number_format($cgst_ar3[$k],2).'</td>
				</tr>';
			}
			else{
				$cgst_val += $cgst_ar3[$k];
				$cgst_tax2 = '<tr>
				<td><b>CGST ('.$cgst_ar1[$k].'%)</b></td>
				<td>:</td>
				<td class="text-right">'.number_format($cgst_val,2).'</td>
				</tr>';
			}
		}break;
	}
	
	for($p=0; $p<count($sgst_ar1); $p++){
		for($q=0; $q<count($sgst_ar1); $q++){
			if($sgst_ar1[$p] != $sgst_ar2[$q]){
				$sgst_tax1 .= '<tr>
				<td><b>SGST ('.$sgst_ar1[$q].'%)</b></td>
				<td>:</td>
				<td class="text-right">'.number_format($sgst_ar3[$q],2).'</td>
				</tr>';
			}
			else{
				$sgst_val += $sgst_ar3[$q];
				$sgst_tax2 = '<tr>
				<td><b>SGST ('.$sgst_ar1[$q].'%)</b></td>
				<td>:</td>
				<td class="text-right">'.number_format($sgst_val,2).'</td>
				</tr>';
			}
		}break;
	}
	
	//echo $cgst_tax2;
	//echo $cgst_tax1;
	//echo $sgst_tax2;
	//echo $sgst_tax1;

?>
											
												<tr>
												<td width="50%"><b>Sub Total Amount</b></td>
												<td>:</td>
												<td class="text-right"><?php echo number_format($total,2); ?> <?php echo $currency; ?></td>
												</tr>
												
												<tr>
												<th colspan="3" class="text-center">TAX DETAILS</th>
												</tr>
												
												<?php 
													echo $cgst_tax2;
													echo $cgst_tax1;
												?>
												
												<tr>
												<th colspan="3" class="text-center"></th>
												</tr>
												
												<?php 
													echo $sgst_tax2;
													echo $sgst_tax1;
												?>
												
												<tr>
												<th colspan="3" class="text-center"></th>
												</tr>
												
												<tr>
												<td><b>Total Tax</b></td>
												<td>:</td>
												<td class="text-right"><?php echo number_format($invoice->vat,2); ?> <?php echo $currency; ?></td>
												</tr>
												
												<tr>
												<td><b>Shipping</b></td>
												<td>:</td>
												<td class="text-right"><?php echo number_format($invoice->shipping,2); ?> <?php echo $currency; ?></td>
												</tr>

												<tr>										
												<td><b>Grand Total</b></td>
												<td>:</td>
												<td class="text-right"><?php echo number_format($invoice->grand_total,2); ?> <?php echo $currency; ?></td>
												</tr>
												
												<tr>
												<td><b>Vouchers Value</b></td>
												<td>:</td>
												<td class="text-right"><?php echo number_format($invoice->voucher_amount,2); ?> <?php echo $currency; ?></td>
												</tr>
												
												<tr style="font-size:18px;">
												<td><b>Paid Values </b></td>
												<td>:</td>
												<td class="text-right"><?php echo $invoice->paybal_amount; ?> <?php echo $currency; ?></td>
												</tr>
										</tbody>
									</table>
									</div>
								</div>
							</div>
						</div>
					
						<?php } else {?>
							
							<div class="row invoice-info" style="padding-left:20px; padding-right:20px;">
							<div class="col-sm-12 invoice-col">
								<div class="row table-responsive" style="border:1px solid gray; border-radius:5px 5px 0px 0px; margin:auto;">
									<table class="table table-responsive table-bordered table-hover" style="border-radius:7px 7px 0px 0px;">
										<thead>
											<tr style="background:lavender; font-size:18px;">
												<th colspan="9">Order Details</th>
											</tr>
										</thead>
										<thead>
											<tr class="well">
												<th>#</th>
												<th>Item</th>
												<th>Firm Name</th>
												<th>HSN Code</th>
												<th>Quantity</th>
												<th class="text-right">Unit Cost</th>
												<th class="text-right">Unit Tax(%)</th>
												<th class="text-right">Unit Shipping Cost</th>
												<th class="text-right">Total</th>
											</tr>
										</thead>

										<tbody>
											 <?php
													
													if($invoice->product_details!="")
													{
													$product_details = json_decode($invoice->product_details, true);
													$i =0;
													$total = 0;
													$vat = 0;
													$shipping = 0;
													foreach ($product_details as $row1) {
														$vendor_id = $row1['vendor'];	
														if($vendor_id==$user_id){
														$i++;
												?>
												<tr>
													<td><?php echo $i; ?></td>
													<td>
													<?php 
														echo $row1['name']."<br>"; 
														$name = $row1['name'];
													?>
													<?php
													$product = $row1['id'];
													
													$query = $this->db->get_where('custom_sales', ['product'=>$product, 'sale_code'=>$sale_code]);
													
													foreach($query->result() as $res)
														{
															echo $res->custom_1."<br>";
															echo $res->custom_2."<br>";
															echo $res->custom_3;
														}
													?>
													</td>
													<td>
														<?php 
															$location = $row1['location'];
															$vendor_id = $row1['vendor'];		
															$get_product = $this->db->get_where('users', ['id'=>$vendor_id]);
															foreach($get_product->result() as $res)
															{
																$vendor = $res->company_name;
															}
															echo $vendor;
														?>
													</td> 
													<td><?php 
														$pro = "product_id";
														$condition = " id = '".$invoice->id."' AND product_details LIKE '%".$pro."%' ";
														$get_sts = $this->db->where($condition)->get('smb_sale');
														if($get_sts->num_rows() > 0){
															echo singleDbTableRow($row1['id'],'smb_stock')->hsn_code;
														}
														else{
															echo singleDbTableRow($row1['id'],'smb_product')->hsn_code;
														}
														 
													?></td>
													<td><?php echo $row1['qty']; ?></td>
													<td class="text-right">
														<?php echo number_format($row1['price'],2); ?> <?php echo $currency; ?>
													</td>
													<td class="text-right">
														<?php 
															$get_product_id = $this->db->get_where('smb_product', ['title'=>$name]);
															foreach($get_product_id->result() as $pr);
														
															$get_details = $this->db->order_by('id','asc')->get_where('smb_stock', ['product'=>$pr->id, 'location'=>$location, 'type'=>'add', 'added_by'=>$vendor_id]);
															foreach($get_details->result() as $v);
															if($v->tax !=""){
																echo $v->tax;
															}
															else{
																echo "0";
															}
															 ?> %
													</td>
													<td class="text-right">
														<?php 
															$ship_cost = $row1['shipping_cost']/$row1['qty'];
															echo number_format($ship_cost,2); 
														?> <?php echo $currency; ?>
													</td>
													<td class="text-right">
														<?php echo number_format($row1['subtotal']+$row1['tax'],2); 
															$total += $row1['subtotal']; 
														?> <?php echo $currency; ?>
													</td>
												</tr>
												<?php
													$vat += $row1['tax'];
													$shipping += $row1['shipping_cost'];
													}
													}
													}
												?>
												<?php 
													$get_vouchers = $this->db->order_by('voucher_id', 'asc')->get_where('vouchers', ['used_for'=>$sale_code]);
													if($get_vouchers->num_rows() > 0){
												?>
												<tr><td colspan="9"></td></tr>
												<tr>
													<th></th>
													<th>Used Vouchers</th>
													<td colspan="7">
														<?php
															foreach($get_vouchers->result() as $voc){
																echo $voc->voucher_id.", ";
															}
														?>
													</td>
												</tr>
												<?php } ?>
										</tbody>
									</table>
								</div>
								
								<div class="row table-responsive" style="border:1px solid gray; border-top:none; padding:20px; margin:auto;">
									<div class="col-md-7"></div>
									<div class="col-md-5 text-right">
										<table class="table well">
											<tbody>
										
<?php 
	$product_details = json_decode($invoice->product_details, true);
	
	$cgst_ar1 = array();
	$cgst_ar2 = array();
	$cgst_ar3 = array();
	
	$sgst_ar1 = array();
	$sgst_ar2 = array();
	$sgst_ar3 = array();

	foreach ($product_details as $row1) {
		$vendor_id = $row1['vendor'];	
		if($vendor_id==$user_id){
			array_push($cgst_ar1, singleDbTableRow($row1['id'], 'smb_stock')->sp_tax1);
		
			array_push($cgst_ar2, singleDbTableRow($row1['id'], 'smb_stock')->sp_tax1);

			array_push($cgst_ar3, (($row1['tax']/singleDbTableRow($row1['id'], 'smb_stock')->tax)*singleDbTableRow($row1['id'], 'smb_stock')->sp_tax1));
			
			array_push($sgst_ar1, singleDbTableRow($row1['id'], 'smb_stock')->sp_tax2);
		
			array_push($sgst_ar2, singleDbTableRow($row1['id'], 'smb_stock')->sp_tax2);

			array_push($sgst_ar3, (($row1['tax']/singleDbTableRow($row1['id'], 'smb_stock')->tax)*singleDbTableRow($row1['id'], 'smb_stock')->sp_tax2));
		}
	}
	$cgst_val = 0;
	$sgst_val = 0;

	$cgst_tax1 = "";
	$cgst_tax2 = "";
	$sgst_tax1 = "";
	$sgst_tax2 = "";

	for($j=0; $j<count($cgst_ar1); $j++){
		for($k=0; $k<count($cgst_ar1); $k++){
			if($cgst_ar1[$j] != $cgst_ar2[$k]){
				$cgst_tax1 .= '<tr>
				<td><b>CGST ('.$cgst_ar1[$k].'%)</b></td>
				<td>:</td>
				<td class="text-right">'.number_format($cgst_ar3[$k],2).'</td>
				</tr>';
			}
			else{
				$cgst_val += $cgst_ar3[$k];
				$cgst_tax2 = '<tr>
				<td><b>CGST ('.$cgst_ar1[$k].'%)</b></td>
				<td>:</td>
				<td class="text-right">'.number_format($cgst_val,2).'</td>
				</tr>';
			}
		}break;
	}
	
	for($p=0; $p<count($sgst_ar1); $p++){
		for($q=0; $q<count($sgst_ar1); $q++){
			if($sgst_ar1[$p] != $sgst_ar2[$q]){
				$sgst_tax1 .= '<tr>
				<td><b>SGST ('.$sgst_ar1[$q].'%)</b></td>
				<td>:</td>
				<td class="text-right">'.number_format($sgst_ar3[$q],2).'</td>
				</tr>';
			}
			else{
				$sgst_val += $sgst_ar3[$q];
				$sgst_tax2 = '<tr>
				<td><b>SGST ('.$sgst_ar1[$q].'%)</b></td>
				<td>:</td>
				<td class="text-right">'.number_format($sgst_val,2).'</td>
				</tr>';
			}
		}break;
	}
	
	//echo $cgst_tax2;
	//echo $cgst_tax1;
	//echo $sgst_tax2;
	//echo $sgst_tax1;

?>
												<tr>
												<td width="50%"><b>Sub Total Amount</b></td>
												<td>:</td>
												<td class="text-right"><?php echo number_format($total,2); ?> <?php echo $currency; ?></td>
												</tr>
												
												<tr>
												<th colspan="3" class="text-center">TAX DETAILS</th>
												</tr>
												
												<?php 
													echo $cgst_tax2;
													echo $cgst_tax1;
												?>
												
												<tr>
												<th colspan="3" class="text-center"></th>
												</tr>
												
												<?php 
													echo $sgst_tax2;
													echo $sgst_tax1;
												?>
												
												<tr>
												<th colspan="3" class="text-center"></th>
												</tr>
												<tr>
												
												<td><b>Total Tax</b></td>
												<td>:</td>
												<td class="text-right"><?php echo number_format($vat,2); ?> <?php echo $currency; ?></td>
												</tr>
												
												<tr>
												<td><b>Shipping</b></td>
												<td>:</td>
												<td class="text-right"><?php echo number_format($shipping,2); ?> <?php echo $currency; ?></td>
												</tr>

												<tr>										
												<td><b>Grand Total</b></td>
												<td>:</td>
												<td class="text-right"><?php echo number_format($total+$vat+$shipping,2); ?> <?php echo $currency; ?></td>
												</tr>
												
										</tbody>
									</table>
									</div>
								</div>
							</div>
						</div>
							
						<?php } ?>
						 
						<br>
					     
                    </section><!-- /.content -->
                </div><!-- /.box-body -->
				<?php
					$biz_id   = $this->session->userdata('biz_id');
					$location = $this->session->userdata('location');
					
					$button = '<a class="btn btn-info btn-sm" href="'.base_url('smb_sales/vendor_invoice/'. $invoice->id).'" data-toggle="tooltip" title="Sales Invoice"><i class="fa fa-file-text"></i> Sales Invoice </a> ';
					
					$button .= '<a class="btn btn-info btn-sm" href="'.base_url('smb_product/vendor_service_invoice/'. $invoice->id).'" data-toggle="tooltip" title="Service Invoice"><i class="fa fa-file-text"></i> Service Invoice </a> ';
					
					$button .= '<a class="btn btn-warning btn-sm" href="'.base_url('smb_sales/thermal_invoice/'. $invoice->id).'" data-toggle="tooltip" title="Mobile Print (Sale Invoice)"><i class="fa fa-mobile"></i> Mobile Print(Sale) </a> ';
					
					$button .= '<a class="btn btn-warning btn-sm" href="'.base_url('smb_product/service_vendor_thermal_invoice/'. $invoice->id).'" data-toggle="tooltip" title="Mobile Print (Service Invoice)"><i class="fa fa-mobile"></i> Mobile Print(Service) </a>';
					
				?>
				<div class="row no-print" style="padding-left:70px; padding-right:70px; padding-bottom:20px;">
                            <div class="col-md-6">
								<a href="<?php echo base_url('smb_sales/index') ?>" class="btn btn-primary btn-sm" ><i class="fa fa-arrow-left"></i> Order History</a>
								<button class="btn btn-default btn-sm" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
								<button class="btn btn-primary btn-sm" id="create_pdf"><i class="fa fa-file-pdf-o"></i>  Download PDF</button>
                            </div>
							<div class="col-md-6 text-right">
								
								<?php echo $button; ?>
								
                            </div>
                </div>
            </div><!-- /.box -->
			
        </div>
    </div>
 
</section><!-- /.content -->

</body>
</html>

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

<?php } ?>