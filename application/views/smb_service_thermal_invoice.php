<?php 
	foreach($invoiceQuery ->result() as $invoice); 
	$user_info 	 = $this->session->userdata('logged_user');
	$user_id 	 = $user_info['user_id'];
	$currentUser = singleDbTableRow($user_id)->role;
	$rolename    = singleDbTableRow($user_id)->rolename;
	$email   	 = singleDbTableRow($user_id)->email;
	
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
<section class="content" style="border:none;">
    <div class="row">
        <div class="col-md-12">

            <div class="box" style="border:none;">
                
                <div class="box-body" style="border:none;" id="print_div" >
                    <!-- Main content -->
                    <section class="content invoice">
                        <!-- title row -->
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
						
						<div class="row invoice-info">
							<div class="col-md-4"></div>
							<div class="col-sm-3 invoice-col"  >
								<div class="row" style=" margin:auto;">
									<img src="<?php echo base_url('assets/img')?>/cfirst_logo.jpg" height="50px" width="90px">
								</div>
							</div>
						</div>
						
						<div class="row invoice-info">
							<div class="col-md-4"></div>
							<div class="col-sm-3 invoice-col"  >
								<div class="row" style=" margin:auto;">
									<h3><?php echo $heading; ?></h3>
								</div>
							</div>
						</div>
						
						<div class="row invoice-info">
							<div class="col-md-4"></div>
							<div class="col-sm-3 invoice-col">
								<div class="row" style="margin:auto;">
									<p><b>TIN 29401381945<br>
										CONSUMERFIRST TECHNOSERVICES PVT LTD.<br>
										#418, 6th B cross, 6th Block<br>
										KORAMANGALA, BANGLORE-95<br>
										Ph : 080-335-8384</b></p>
									
									<b>Invoice ID # : </b><?php echo $sale_code; ?> 
								</div>
							</div>
						</div>
						
						
						
						
                        <!-- info row -->
                        <div class="row invoice-info">
							<div class="col-md-4"></div>
                            <div class="col-sm-3 invoice-col">
								<div class="row" style=" margin:auto; min-height:236px;">
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
						</div>
						<div class="row invoice-info">
							<div class="col-md-4"></div>
							<div class="col-sm-3 invoice-col">
								
								<div class="row" style="margin:auto;">
									
									   <p><font size="3"><b>Payment Details :</b></font></p>
																		
										<b> Payment Status : </b>  <i> <?php echo $invoice->payment_status ?> </i> <br>
										<b> Payment Method : </b> <?php echo $invoice->payment_type; ?>
									
								</div>
								
								<div class="row" style=" margin:auto;">
									
										<p><b>Order Date :</b></p>
										<p><?php echo date('d M, Y',$invoice->sale_datetime); ?></p>
										<p><b>Bill Generated Date :</b></p>
										<p><?php echo date("d M, Y"); ?></p>
									
								</div>
								
							</div>
						</div><!-- /.row -->
						
						
						<div class="row invoice-info">
							<div class="col-md-4"></div>
							<div class="col-sm-3 invoice-col">
								<div class="row" style="margin:auto;">
									<table class="table">
										<thead>
											<tr style="background:lavender;">
												<th colspan="3">Order Details</th>
											</tr>
										</thead>
										<thead>
											<tr class="well">
												<th>Item</th>
												<th>Qty</th>
												<th class="text-right">Amount</th>
											</tr>
										</thead>
										<tbody>
											 <?php
													if($invoice->product_details!="")
													{
													$product_details = json_decode($invoice->product_details, true);
													$i =0;
													$total = 0;
													$sub_total = 0;
													foreach ($product_details as $row1) {
														$i++;
												?>
												<tr>
													<td>
													<?php 
														echo $row1['name']."<br>"; 
														
														if(singleDbTableRow($row1['id'],'smb_stock')->sac_code != ""){
															echo "SAC Code : ".singleDbTableRow($row1['id'],'smb_stock')->sac_code;
														}
															
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
													 
													<td><?php echo $row1['qty']; ?></td>
													
													<td class="text-right">
														<?php echo number_format($row1['subtotal'],2); ?> 
													</td>
												</tr>
												<?php
													$sub_total += $row1['subtotal'];
													}
													}
												?>
												<tr style="background:lavender; border-bottom:1px solid gray;">
													<th colspan="2" width="70%">Sub Total</th>
													<th class="text-right" width="30%"><?php echo number_format($sub_total,2); ?></th>
												</tr>
										</tbody>
									</table>
								</div>
								
								<div class="row" style=" margin:auto;">
									<table class="table">
										<thead>
											<tr style="background:lavender;">
												<th colspan="2">Service Charges</th>
											</tr>
										</thead>
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
				<td class="text-right">'.number_format($cgst_ar3[$k],2).'</td>
				</tr>';
			}
			else{
				$cgst_val += $cgst_ar3[$k];
				$cgst_tax2 = '<tr>
				<td><b>CGST ('.$cgst_ar1[$k].'%)</b></td>
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
				<td class="text-right">'.number_format($sgst_ar3[$q],2).'</td>
				</tr>';
			}
			else{
				$sgst_val += $sgst_ar3[$q];
				$sgst_tax2 = '<tr>
				<td><b>SGST ('.$sgst_ar1[$q].'%)</b></td>
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
										<tbody>
											<?php
												echo $cgst_tax2;
												echo $cgst_tax1;
												echo $sgst_tax2;
												echo $sgst_tax1;
											?>
											<tr style="background:lavender">
												<th>Total Tax</th>
												<th class="text-right"><?php echo number_format($invoice->vat,2); ?></th>
											</tr>
										</tbody>
										<tbody>
											<?php
												$total_shipping = 0;
												foreach ($product_details as $pro) {
											?>
												<tr>
													<td width="70%">
													<?php 
														echo "Shipping <b>".number_format($pro['shipping_cost'],2)."</b> on ".$pro['name'];
													?>
													</td>
													<td width="30%" class="text-right">
														<?php echo number_format(($pro['qty']*$pro['shipping_cost']),2); ?>
													</td>
												</tr>
											<?php
												$total_shipping += ($pro['qty']*$pro['shipping_cost']);
												}
											?>
											<tr style="background:lavender">
												<th>Total Shipping</th>
												<th class="text-right"><?php echo number_format($total_shipping,2); ?></th>
											</tr>
											
											<tr style="background:lavender; border-top:2px solid black;  border-bottom:2px solid black;">
												<th>Total</th>
												<th class="text-right"><?php echo number_format($invoice->grand_total,2); ?></th>
											</tr>
										</tbody>
									</table>
								</div>
								
							</div>
						</div>
						
						
                    </section><!-- /.content -->
                </div><!-- /.box-body -->
				<?php
					$biz_id   = $this->session->userdata('biz_id');
					$location = $this->session->userdata('location');
					
					$button = '<a class="btn btn-info btn-sm" href="'.base_url('smb_product/full_invoice/'. $invoice->id).'" data-toggle="tooltip" title="Sales Invoice"><i class="fa fa-file-text"></i> Sales Invoice </a> ';
					
					$button .= '<a class="btn btn-info btn-sm" href="'.base_url('smb_product/service_invoice/'. $invoice->id).'" data-toggle="tooltip" title="Service Invoice"><i class="fa fa-file-text"></i> Service Invoice </a> ';
					
					$button .= '<a class="btn btn-warning btn-sm" href="'.base_url('smb_product/thermal_invoice/'. $invoice->id).'" data-toggle="tooltip" title="Mobile Print (Sale Invoice)"><i class="fa fa-mobile"></i> Mobile Print(Sale) </a> ';
					
					$button .= '<a class="btn btn-warning btn-sm" href="'.base_url('smb_product/service_thermal_invoice/'. $invoice->id).'" data-toggle="tooltip" title="Mobile Print (Service Invoice)"><i class="fa fa-mobile"></i> Mobile Print(Service) </a>';
				?>
				
				<div class="row no-print" style="padding-bottom:20px;">
                   
					<div class="col-sm-12 text-center invoice-col">
						<a href="<?php echo base_url('smb_product/order_history') ?>" class="btn btn-primary btn-sm" ><i class="fa fa-arrow-left"></i> Order History</a> 
						<button class="btn btn-primary btn-sm" title="Print" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
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