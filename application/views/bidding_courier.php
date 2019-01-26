<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
<?php } ?>
<?php include('header.php'); ?>
<?php  
/*DETAILS */
if(!empty($details)): foreach($details as $edetails):
	$ev=$edetails['event_no'];
	$confirmed_amount=$edetails['confirmed_amount'];
	$confirmed_quantity=$edetails['confirmed_quantity'];
	$product=$edetails['title'];
	$created_at=date('d/m/Y h:i A',$edetails['created_at']);
	$quantity = intval(preg_replace('/[^0-9]+/', '', $confirmed_quantity), 10);
	$a=explode('/',$confirmed_amount);
	$amount = $a[0];
	$total_amount=$amount * $quantity;
	
endforeach; endif;
/* SELLER/SHIPPER */
if(!empty($seller)): foreach($seller as $sellers):
	
	$seller_id= $sellers['id'];
	$seller_referral_code= $sellers['referral_code'];
	$seller_name= $sellers['first_name'].' '.$sellers['last_name'];
	$seller_email= $sellers['email'];
	$seller_contactno= $sellers['contactno'];
	$seller_postalcode= $sellers['postal_code'];
	$seller_location= $sellers['location'];
	$seller_district= $sellers['district'];
	$seller_state= $sellers['state'];
	$seller_country= $sellers['country_name'];
	
endforeach; endif;
	/* BALANCE*/
	$seller_account_no = singleDbTableRow($seller_id)->account_no;//sum of total wallets available with Cash Dispatch-Role Name 'Wallet'
	$where_array1 = array('points_mode'=>'wallet', 'account_no' =>$seller_account_no);
	$query1 = $this->db->select_sum('debit')->where($where_array1 )->get("accounts"); 
	foreach( $query1->result() as $wal_debit);
	$wal_debit			= $wal_debit->debit;
	
	$query2 = $this->db->select_sum('credit')->where($where_array1 )->get("accounts"); 
	foreach( $query2->result() 		as $wal_credit); 
	$wal_credit      	= $wal_credit->credit;
	
	$seller_balance= ( $wal_debit - $wal_credit ) ;
	
/* BUYER/RECEIVER */
if(!empty($buyer)): foreach($buyer as $buyers):
	
	$buyer_id= $buyers['id'];
	$buyer_referral_code= $buyers['referral_code'];
	$buyer_name= $buyers['first_name'].' '.$buyers['last_name'];
	$buyer_email= $buyers['email'];
	$buyer_contactno= $buyers['contactno'];
	$buyer_postalcode= $buyers['postal_code'];
	$buyer_location= $buyers['location'];
	$buyer_district= $buyers['district'];
	$buyer_state= $buyers['state'];
	$buyer_country= $buyers['country_name'];

endforeach; endif;
/* BALANCE*/
	$buyer_account_no = singleDbTableRow($buyer_id)->account_no;//sum of total wallets available with Cash Dispatch-Role Name 'Wallet'
	$where_array2 = array('points_mode'=>'wallet', 'account_no' =>$buyer_account_no);
	$query3 = $this->db->select_sum('debit')->where($where_array2 )->get("accounts"); 
	foreach( $query3->result() as $wal_debit2);
	$wal_debit2			= $wal_debit2->debit;
	
	$query4 = $this->db->select_sum('credit')->where($where_array2 )->get("accounts"); 
	foreach( $query4->result() 		as $wal_credit2); 
	$wal_credit2      	= $wal_credit2->credit;
	
	$buyer_balance= ( $wal_debit2 - $wal_credit2 ) ;
/*BALANCE */
/*$seller_balance=file_get_contents('http://www.consumer1st.in/pay_test/index.php/api/check_bal?email='.$seller_email);
$buyer_balance=file_get_contents('http://www.consumer1st.in/pay_test/index.php/api/check_bal?email='.$buyer_email);*/
?>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Bidding</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    
					<div class="box-body">
                   <table class="table table-bordered">
                        <tr>
                              <th> Event </th>
                            <th> Product  </th>
                            <th> Buyer </th>	
							<th> Seller </th>
                            <th> Confirmed Amount</th>
                             <th> Confirmed Quantity</th>
                             <th> Total Amount</th>
                             <th> Seller CPA Balance</th>
                             <th> Buyer CPA Balance</th>
                             <th> Created At</th>
                        </tr>
                        <tr> 
                            <td>
                                <?php  echo $ev; ?>
                            </td>
                            <td>
                               <?php  echo $product; ?>  
                            </td>
                            <td>
                               <?php  echo $buyer_name; ?>
                            </td>							
                            <td>
                                <?php  echo $seller_name; ?>
                            </td>
                            <td>
                                <?php  echo $confirmed_amount; ?>
                            </td>
                            <td>
                                <?php  echo $confirmed_quantity; ?>
                            </td>
                            <td>
                                <?php  echo $total_amount; ?>
                            </td>
                            <td>
                                <?php  echo $seller_balance; ?>
                            </td>
                            <td>
                                <?php  echo $buyer_balance; ?>
                            </td>
                            <td>
                                <?php  echo $created_at; ?>
                            </td>
                        </tr>
                 
					</table>
						<div class="row">
							<div class="col-lg-12">
								<font size="5">  Shipper Info :  </font>
							</div>
						</div>
						<br>
						 
                       <div class="form-group <?php if (form_error('shipper_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Shipper Name.
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                        <select name="shipper_name" class="form-control" onchange="get_shipper_location(this.value)">
                                    <?php
										echo '<option value="'.$seller_id.'">'.$seller_referral_code.'-'.$seller_name.'</option>';
                                    ?>
                                </select>
                            <?php echo form_error('shipper_name') ?>
                        </div>
						
                    </div>
						
						
						 <div class="form-group <?php if(form_error('shipper_phone')) echo 'has-error'; ?>">
                            <label for="shipper_phone" class="col-md-3">Phone Number
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="shipper_phone">
									<input type="text" name="shipper_phone" class="form-control" value="<?php echo $seller_contactno; ?>" placeholder="Phone Number">
								</div>
								<?php echo form_error('shipper_phone') ?>
                            </div>
                        </div>
						
                        <div class="form-group <?php if(form_error('shipper_pincode')) echo 'has-error'; ?>">
                            <label for="pincode" class="col-md-3">Pincode <span class="text-red">*</span></label>
                            <div class="col-md-9">
                            <input type="text" name="shipper_pincode" class="form-control" value="<?php echo $seller_postalcode;?>">
                            <input type="text" class="form-control" value="<?php echo $seller_location;?>">
                                <!--<select name="shipper_pincode" class="form-control" >
                                    
                                    < ?php
                                    if($pincode->num_rows() > 0)
                                    {
										echo '<option value="'.$seller_postalcode.'" >'.$seller_postalcode.'-'.$seller_location.'</option>';
                                        foreach($pincode->result() as $c){ ?>
                                          
                                           <option value="< ?php echo $c->id;?>">< ?php echo $c->pincode.'-'.$c->location;?></option>
                                       < ?php  }
                                    }
                                    ?>
                                </select>-->
                                <?php echo form_error('shipper_pincode') ?>
                            </div>
                        </div>
					
					
					<div class="row">
						<div class="col-lg-12">
							<font size="3">  Full Address :  </font>
						</div>
					</div>
					<br>
					
					
					<div id="shipper_address">
					
						<div class="form-group <?php if(form_error('shipper_location')) echo 'has-error'; ?>">
                            <label for="shipper_location" class="col-md-3">Location
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="shipper_location">
									<input type="text" name="shipper_location" id="location" class="form-control" value="<?php echo $seller_location; ?>" placeholder="Location">
								</div>
								<?php echo form_error('shipper_location') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('shipper_district')) echo 'has-error'; ?>">
						<label for="shipper_district" class="col-md-3">District
							<span class="text-red"></span>
						</label>
						<div class="col-md-9" >
							<div id="shipper_district">
								<input type="text" name="shipper_district" id="district" class="form-control" value="<?php echo $seller_district; ?>" placeholder="District">
							</div>
								<?php echo form_error('shipper_district') ?>
							</div>
						</div>
						
						<div class="form-group <?php if(form_error('shipper_state')) echo 'has-error'; ?>">
                            <label for="shipper_state" class="col-md-3">State
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="shipper_state">
									<input type="text" name="shipper_state" class="form-control" value="<?php echo $seller_state; ?>" placeholder="State">
								</div>
								<?php echo form_error('shipper_state') ?>
                            </div>
                        </div>
						
					</div>
					
					</div>
						
											
			
			
			<div class="box-body">
                        
						<div class="row">
							<div class="col-lg-12">
								<font size="5">  Reciever Info :  </font>
							</div>
						</div>
						<br>
                                                                   <div class="form-group <?php if (form_error('receiver_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Receiver Name.
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                        <input type="hidden" name="buyer" value="<?php echo $buyer_id;?>">
                            <input type="text" name="reciever_name" id="name" class="form-control"  value="<?php echo $buyer_referral_code.'-'.$buyer_name; ?>" placeholder="">
                            
                        </div>
						<?php echo form_error('receiver_name') ?>
                    </div>
						
						
						 <div class="form-group <?php if(form_error('reciever_phone')) echo 'has-error'; ?>">
                            <label for="reciever_phone" class="col-md-3">Phone Number
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="reciever_phone">
									<input type="text" name="reciever_phone" class="form-control" value="<?php echo $buyer_contactno; ?>" placeholder="Phone Number">
								</div>
								<?php echo form_error('reciever_phone') ?>
                            </div>
                        </div>
						
                        <div class="form-group <?php if(form_error('reciever_pincode')) echo 'has-error'; ?>">
                            <label for="reciever_pincode" class="col-md-3">Pincode <span class="text-red">*</span></label>
                            <div class="col-md-9">
                            <input type="text" name="reciever_pincode" class="form-control" value="<?php echo $buyer_postalcode;?>">
                            <input type="text" class="form-control" value="<?php echo $buyer_location;?>">
                                <!--<select name="reciever_pincode" class="form-control">
                                    < ?php
                                    if($pincode->num_rows() > 0)
                                    {
										echo '<option value="'.$buyer_postalcode.'" >'.$buyer_postalcode.'-'.$buyer_location.'</option>';
                                        foreach($pincode->result() as $c){
                                           
                                            echo '<option value="'.$c->id.'"> '.$c->pincode.'-'.$c->location.'</option>';
                                        }
                                    }
                                    ?>
                                </select>-->
                                <?php echo form_error('reciever_pincode') ?>
                            </div>
                        </div>
					
					
					<div class="row">
						<div class="col-lg-12">
							<font size="3">  Full Address :  </font>

						</div>
					</div>
					<br>
					
					<div id="receiver_address">
						<div class="form-group <?php if(form_error('reciever_location')) echo 'has-error'; ?>">
                            <label for="reciever_location" class="col-md-3">Location
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="reciever_location">
									<input type="text" name="reciever_location" class="form-control" value="<?php echo $buyer_location; ?>" placeholder="Location">
								</div>
								<?php echo form_error('reciever_location') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('reciever_district')) echo 'has-error'; ?>">
						<label for="reciever_district" class="col-md-3">District
							<span class="text-red"></span>
						</label>
						<div class="col-md-9" >
							<div id="reciever_district">
								<input type="text" name="reciever_district" class="form-control" value="<?php echo $buyer_district; ?>" placeholder="District">
							</div>
								<?php echo form_error('reciever_district') ?>
							</div>
						</div>
						
						<div class="form-group <?php if(form_error('reciever_state')) echo 'has-error'; ?>">
                            <label for="reciever_state" class="col-md-3">State
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="reciever_state">
									<input type="text" name="reciever_state" class="form-control" value="<?php echo $buyer_state; ?>" placeholder="State">
								</div>
								<?php echo form_error('reciever_state') ?>
                            </div>
                        </div>
						
						</div>
						
						
					</div>
			
			
			<hr>
			
			
			<div class="box-body">
                        
						<div class="row">
							<div class="col-lg-12">
								<font size="5">  Shippment Info :  </font>
							</div>
						</div>
						<br>
                        
						
						
						 <div class="form-group <?php if(form_error('shipment_type')) echo 'has-error'; ?>">
                            <label for="shipment_type" class="col-md-3">Type of Shipment
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <select name="shipment_type" class="form-control" id="Shiptype" onChange="get_cons_no()">
									<option value="">-Select Type of Shipment-</option>
									<option value="Documents">Documents</option>
									<option value="Parcel">Parcel</option>
									<option value="Food Items">Food Items</option>
									<option value="Medicines">Medicines</option>
									<option value="Goods">Goods</option>
									<option value="Natural Products">Natural Products</option>
									<option value="Chemical Products">Chemical Products</option>
									<option value="Carton Box">Carton Box</option>
								</select>
								<?php echo form_error('shipment_type') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('consignment_no')) echo 'has-error'; ?>">
                            <label for="consignment_no" class="col-md-3">Consignment No
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="consignment_no">
									<input type="text" id="ConsignmentNo"  name="consignment_no" class="form-control" readonly value="" placeholder="Consignment Number">
								</div>
								<?php echo form_error('consignment_no') ?>
                            </div>
                        </div>
					
                        <div class="form-group <?php if(form_error('cost')) echo 'has-error'; ?>">
                            <label for="cost" class="col-md-3"> <span class="text-red"> Weight/Amount Deduction (Rs.) *</span></label>
                            <div class="col-md-9">
                                <select name="cost" class="form-control">
                                    <option value="" > Please select Appropriate Courier Weight to avoid Rejection </option>
                                    <?php
                                    if($shipment_cost->num_rows() > 0)
                                    {
                                        foreach($shipment_cost->result() as $c){
                                           
                                            echo '<option value="'.$c->amount.'">For Weight '.$c->weight.'    Amount ='.$c->amount.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('cost') ?>
                            </div>
                        </div>
				<div class="form-group <?php if(form_error('weight')) echo 'has-error'; ?>">
                            <label for="weight" class="col-md-3">Weight
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="weight">
									<input type="text" name="smb_weight" class="form-control" value="<?php echo singleDbTableRow($edetails['product'], 'smb_product')->weight; ?>" placeholder="Weight (kg)">
								</div>
								<?php echo form_error('weight') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('volume')) echo 'has-error'; ?>">
                            <label for="volume" class="col-md-3">Volume
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="volume">
									<input type="text" name="smb_volume" class="form-control" value="<?php echo singleDbTableRow($edetails['product'], 'smb_product')->volume; ?>" placeholder="volume">
								</div>
								<?php echo form_error('volume') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('bg_name')) echo 'has-error'; ?>">
                            <label for="bg_name" class="col-md-3">Business Group
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="volume">
									<input type="text" name="business_group" class="form-control" value="24" placeholder="bg_name" readonly>
								</div>
								<?php echo form_error('volume') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('invoice_no')) echo 'has-error'; ?>">
                            <label for="invoice_no" class="col-md-3">Invoice Number
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="invoice_no">
									<input type="text" name="invoice_no" class="form-control" value="" placeholder="Invoice Number">
								</div>
								<?php echo form_error('invoice_no') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('quantity')) echo 'has-error'; ?>">
                            <label for="quantity" class="col-md-3">Quantity
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="quantity">
									<input type="text" name="quantity" class="form-control" value="<?php echo $confirmed_quantity; ?>" placeholder="Quantity" readonly>
								</div>
								<?php echo form_error('quantity') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('booking_mode')) echo 'has-error'; ?>">
                            <label for="booking_mode" class="col-md-3">Booking Mode
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <select name="booking_mode" class="form-control" id="booking_mode">
									<option value="">-Select Booking Mode-</option>
									<option value="Paid">Paid</option>
									<option value="Not Paid">Not Paid(Pending)</option>
									<option value="On Cash">On Cash</option>
								</select>
								<?php echo form_error('booking_mode') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('mode')) echo 'has-error'; ?>">
                            <label for="mode" class="col-md-3">Mode
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <select name="mode" class="form-control" id="mode">
									<option value="">-Select Mode-</option>
									<option value="Air">Air</option>
									<option value="Road">Road</option>
									<option value="Train">Train</option>
									<option value="Sea">Sea</option>
								</select>
								<?php echo form_error('mode') ?>
                            </div>
                        </div>
		
						<div class="form-group <?php if(form_error('status')) echo 'has-error'; ?>">
                            <label for="status" class="col-md-3">Status
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <select name="status" class="form-control" id="status">
									<option value="">-Select Status-</option>
									<option value="In Transit">In Transit</option>
									<option value="Dispatched">Dispatched</option>
									<option value="Recieved">Recieved</option>
									<option value="On Travelling">On Travelling</option>
									<option value="On Hold">On Hold</option>
									<option value="Destroyed">Destroyed</option>
									<option value="Delivered">Delivered</option>
									<option value="Transefer To Delivery Boy">Transefer To Delivery Boy</option>
									<option value="Transefer To Receiver">Transefer To Receiver</option>
									<option value="Transefer To Sender">Transefer To Sender</option>
								</select>
								<?php echo form_error('status') ?>
                            </div>
                        </div>
					<div class="form-group <?php if(form_error('comments')) echo 'has-error'; ?>">
                            <label for="invoiceid" class="col-md-3">Comments
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <textarea type="text" name="comments" class="form-control" value="<?php echo set_value('comments'); ?>" placeholder="Enter Comments" style="height:100px;"></textarea>
                                <?php echo form_error('comments') ?>
								
                            </div>
                        </div>
						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                    <input type="hidden" name="total_amount" value="<?php echo $total_amount;?>">
                    <input type="hidden" name="buyer_blnc" value="<?php echo $buyer_balance;?>">
                    <input type="hidden" name="seller_blnc" value="<?php echo $seller_balance;?>">
                        <button type="submit" name="submit" value="add_courier" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Courier
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

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
                url : "<?php echo base_url('welcome/uniqueReferralCodeApi'); ?>",
                data : { referredByCode : referredByCode }
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
</script>
    <!-- CREATE CONSIGNMENT NO: -->
    <script type="text/javascript" language="javascript">
	function get_cons_no() 
	{
		
		var district = document.getElementById("district").value;
		var location = document.getElementById("location").value;
		var Shiptype = document.getElementById("Shiptype").value;
		var district1 = district.substring(0, 3).toUpperCase();  
		//var location1 = location.substring(0, 3).toUpperCase();; 
		var Shiptype1 = Shiptype.substring(0, 3).toUpperCase();;
		var rand1=Math.floor((Math.random() * 1000000) + 1); 
		var cons_no=district1.concat(Shiptype1,rand1); 
		document.getElementById("ConsignmentNo").value=cons_no;
	}
	</script>
		    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
<?php } ?>


<script>

	function get_shipper_location(shipper_pin)
	{
		//alert (shipper_pin);
		
		var mydata = {"shipper_pin":shipper_pin};
	   
		$.ajax({
		   type:"POST",
		   url:"get_shipper_location",
		   data:mydata,
		   success:function(response){
			 $("#shipper_address").html(response);
		   }
		});
		
		
	}
	
	
	
	function get_receiver_location(receiver_pin)
	{
		//alert (receiver_pin);
		
		var mydata = {"receiver_pin":receiver_pin};
	   
		$.ajax({
		   type:"POST",
		   url:"get_receiver_location",
		   data:mydata,
		   success:function(response){
			 $("#receiver_address").html(response);
		   }
		});
	}

</script>

