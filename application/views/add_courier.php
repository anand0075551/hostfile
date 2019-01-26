<?php
/**Earnings**/
foreach($earnings->result() as $earning);
foreach($referralEarnings->result() as $referralEarning);
foreach($withdrawal->result() as $withdraws);
$totalEarning = $earning->amount;
//$refEarning = $referralEarning->amount;
$withdraw = $withdraws->amount;
//$rowEarning = $totalEarning - $refEarning;
$credit     = $totalEarning - $withdraw;
/**Accounts**/
foreach( $assets->result() as $assets);
foreach( $debits->result() as $debits);
foreach($credits->result() as $credits);
foreach($wallet->result() as $wallet);
foreach( $usedwallet->result() as $usedWallet);  //wallet_converted
$totalAssets = $assets->amount;
$totalDebits = $debits->debit;
$totalCredits = $credits->credit;
$totalWallet  = $wallet->amount;
$usedwallet   = $usedWallet->amount;
/* Data is fetching from    app/controller/ledger.php
public function userAccountListJson()*/
/* Standard data Retrieval*/
foreach( $wal_debit->result()       as $wal_debit);
foreach( $wal_credit->result()      as $wal_credit);
foreach( $loy_debit->result()       as $loy_debit);
foreach( $loy_credit->result()      as $loy_credit);
foreach( $dis_debit->result()       as $dis_debit);
foreach( $dis_credit->result()      as $dis_credit);
$wal_debit          = $wal_debit->debit;
$wal_credit         = $wal_credit->credit;
$loy_debit          = $loy_debit->debit;
$loy_credit         = $loy_credit->credit;
$dis_debit          = $dis_debit->debit;
$dis_credit         = $dis_credit->credit;
/* Available Balance Wallet,loyality and Discount Points */
$wallet_balance    = ( $wal_debit - $wal_credit ) ;
$loyality_balance  = ( $loy_debit - $loy_credit ) ;
$discount_balance  = ( $dis_debit - $dis_credit ) ;
?>
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
$user_info = $this->session->userdata('logged_user');
$user_id = $user_info['user_id'];
$currentRolename   = singleDbTableRow($user_id)->rolename;
$first_name   = singleDbTableRow($user_id)->first_name;
$last_name   = singleDbTableRow($user_id)->last_name;
$referral_code   = singleDbTableRow($user_id)->referral_code;
foreach($user_Details->result() as $courier);
?>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Courier</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th> CPA Values </th>
                                <th> Total CPA Debits  </th>
                                <th> Total CPA Credits </th>
                                <th> Loyality Values </th>
                                <th> Discount Values</th>
                            </tr>
                            <tr>
                                <td>
                                    <?php  echo amountFormat($wallet_balance); ?>
                                </td>
                                <td>
                                    <?php  echo amountFormat($wal_debit); ?>
                                </td>
                                <td>
                                    <?php  echo amountFormat($wal_credit); ?>
                                </td>
                                <td>
                                    <?php  echo ($loyality_balance); ?>
                                </td>
                                <td>
                                    <?php  echo ($discount_balance); ?>
                                </td>
                            </tr>
                            
                        </table>
						 <div style="display:none;" class="form-group <?php if(form_error('bg_name')) echo 'has-error'; ?>">
                            <label for="bg_name" class="col-md-3">Business Group
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="bg_name">
                                    <input type="text" name="business_group" class="form-control" value="5" placeholder="bg_name" readonly>
                                </div>
                                <?php echo form_error('bg_name') ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-lg-12">
							
                                <font size="5">  Shipper Info :  </font>
                            </div>
                        </div>
                        <br>
                        <input type="hidden" name="referral_code" id="referral_code" class="form-control" value="<?php echo $courier->referral_code ?>">
                        
                        
                        <?php  if ($currentRolename == '11' || $currentRolename == '27')  {     ?>
                        <div class="form-group <?php if(form_error('shipper_name')) echo 'has-error'; ?>">
                            <label for="user_Details" class="col-md-3">Shipper Name <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="shipper_name" class="form-control" >
                                    <option value="<?php echo $courier->first_name.' '. $courier->last_name; ?>"> Select Shipper Name </option>
                                    <?php
                                    if($user_Details->num_rows() > 0)
                                    {
                                    foreach($user_Details->result() as $c){
                                    // $selected = ($c->id == 105)? 'selected' : '';
                                    echo '<option value="'.$c->id.'">'.$c->referral_code.'-'.$c->first_name.'-'.$c->last_name.'</option>';
                                    }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('shipper_name') ?>
                            </div>
                        </div>
                        <?php } ?>
                        <?php  if ($currentRolename != '11' || $currentRolename == '27')  {     ?>
                        <div class="form-group <?php if(form_error('shipper_name')) echo 'has-error'; ?>">
                            <label for="user_Details" class="col-md-3">Shipper Name <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="shipper_name" class="form-control" >
                                    <?php
                                    echo '<option value="'.$user_id.'">'.$referral_code.'-'.$first_name.'-'.$last_name.'</option>';
                                    ?>
                                </select>
                                <?php echo form_error('shipper_name') ?>
                            </div>
                        </div>
                        
                        <?php } ?>
                        <div class="form-group <?php if(form_error('shipper_phone')) echo 'has-error'; ?>">
                            <label for="shipper_phone" class="col-md-3">Phone Number
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="shipper_phone">
                                    <input type="text" name="shipper_phone" class="form-control" value="" placeholder="Phone Number">
                                </div>
                                <?php echo form_error('shipper_phone') ?>
                            </div>
                        </div>
                        
                        
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <font size="3">  Full Address :  </font>
                            </div>
                        </div>
                        <br>

                        <div class="form-group <?php if(form_error('country')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Country <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="country" class="form-control" onchange="get_state(this.value)">
                                    <option value=""> Select Country </option>
                                    <?php
                                    if($country->num_rows() > 0)
                                    {
                                    foreach($country->result() as $c){
                                    //$selected = ($c->id == 105)? 'selected' : '';
                                    echo '<option value="'.$c->country.'"> '.$c->country.'</option>';
                                    }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('country') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('state')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">State <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="shipper_state" id="state" class="form-control" onchange="get_district(this.value)">
                                    <option value=""> Select State </option>
                                    
                                </select>
                                <?php echo form_error('state') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('district')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">District <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="shipper_district" id="district" class="form-control" onchange="get_location_id(this.value)">
                                    <option value=""> Select District </option>
                                    
                                </select>
                                <?php echo form_error('district') ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('location_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Select Location<span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="location_id" id="location_id" class="form-control" onchange="get_pincode(this.value)">
                                    <option value=""> Select location </option>
                                    
                                </select>
                                <?php echo form_error('location_id') ?>
                            </div>
                        </div>
                        
                        
                        <div class="form-group <?php if(form_error('pincode')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Pincode <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="shipper_pincode" id="pincode" class="form-control">
                                    <option value=""> Select Pincode </option>
                                    
                                </select>
                                <?php echo form_error('pincode') ?>
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="form-group <?php if(form_error('shipper_location')) echo 'has-error'; ?>">
                            <label for="shipper_location" class="col-md-3">Complete Address
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="shipper_location">
                                    <input type="text" name="shipper_location" id="location" class="form-control" value="<?php echo set_value('shipper_location'); ?>" placeholder="Location">
                                </div>
                                <?php echo form_error('shipper_location') ?>
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
                                    <input type="text" name="reciever_name" id="name" class="form-control"  value="" placeholder="">
                                    <?php echo form_error('reciever_name') ?>
                                </div>
                                
                            </div>
                            
                            
                            <div class="form-group <?php if(form_error('reciever_phone')) echo 'has-error'; ?>">
                                <label for="reciever_phone" class="col-md-3">Phone Number
                                    <span class="text-red"></span>
                                </label>
                                <div class="col-md-9" >
                                    <div id="reciever_phone">
                                        <input type="text" name="reciever_phone" class="form-control" value="<?php echo set_value('reciever_phone'); ?>" placeholder="Phone Number">
                                    </div>
                                    <?php echo form_error('reciever_phone') ?>
                                </div>
                            </div>
                            
                            
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <font size="3">  Full Address :  </font>
                                </div>
                            </div>
                            <br>
                            
                            <div class="form-group <?php if(form_error('country')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3">Country <span class="text-red">*</span></label>
                                <div class="col-md-9">
                                    <select name="country" class="form-control" onchange="get_state2(this.value)">
                                        <option value=""> Select Country </option>
                                        <?php
                                        if($country->num_rows() > 0)
                                        {
                                        foreach($country->result() as $c){
                                        //$selected = ($c->id == 105)? 'selected' : '';
                                        echo '<option value="'.$c->country.'"> '.$c->country.'</option>';
                                        }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('country') ?>
                                </div>
                            </div>
                            
                            <div class="form-group <?php if(form_error('state')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3">State <span class="text-red">*</span></label>
                                <div class="col-md-9">
                                    <select name="reciever_state" id="state2" class="form-control" onchange="get_district2(this.value)">
                                        <option value=""> Select State </option>
                                        
                                    </select>
                                    <?php echo form_error('state') ?>
                                </div>
                            </div>
                            
                            <div class="form-group <?php if(form_error('district')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3">District <span class="text-red">*</span></label>
                                <div class="col-md-9">
                                    <select name="reciever_district" id="district2" class="form-control" onchange="get_location_id2(this.value)">
                                        <option value=""> Select District </option>
                                        
                                    </select>
                                    <?php echo form_error('district') ?>
                                </div>
                            </div>
                            
                            <div class="form-group <?php if(form_error('location_id')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3">Select Location<span class="text-red">*</span></label>
                                <div class="col-md-9">
                                    <select name="location_id" id="location_id2" class="form-control" onchange="get_pincode2(this.value)">
                                        <option value=""> Select location </option>
                                        
                                    </select>
                                    <?php echo form_error('location_id') ?>
                                </div>
                            </div>
                            
                            
                            <div class="form-group <?php if(form_error('pincode')) echo 'has-error'; ?>">
                                <label for="firstName" class="col-md-3">Pincode <span class="text-red">*</span></label>
                                <div class="col-md-9">
                                    <select name="reciever_pincode" id="pincode2" class="form-control">
                                        <option value=""> Select Pincode </option>
                                        
                                    </select>
                                    <?php echo form_error('pincode') ?>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            <div class="form-group <?php if(form_error('reciever_location')) echo 'has-error'; ?>">
                                <label for="reciever_location" class="col-md-3">Complete Address
                                    <span class="text-red"></span>
                                </label>
                                <div class="col-md-9" >
                                    <div id="reciever_location">
                                        <input type="text" name="reciever_location" id="location2" class="form-control" value="<?php echo set_value('reciever_location'); ?>" placeholder="Location">
                                    </div>
                                    <?php echo form_error('reciever_location') ?>
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
                                        <input type="text" id="ConsignmentNo"  name="consignment_no" class="form-control" readonly value="<?php echo set_value('consignment_no'); ?>" placeholder="Consignment Number">
                                    </div>
                                    <?php echo form_error('consignment_no') ?>
                                </div>
                            </div>
                            
							
						 <div class="form-group <?php if(form_error('delivery_type')) echo 'has-error'; ?>">
                                <label for="delivery_type" class="col-md-3">Delivery Option
                                    <span class="text-red"></span>
                                </label>
                                <div class="col-md-9" >
                                    <select name="delivery_type" class="form-control">
                                        <option value="">-Select Type of Delivery-</option>
                                        <option value="Send Pickup">Send Pickup</option>
                                        <option value="Visiting Delivery Center">Visiting Delivery Center</option>
                                    </select>
                                    <?php echo form_error('delivery_type') ?>
                                </div>
                            </div>
							
							<?php  if ($currentRolename == '11' && $currentRolename == '27')  {     ?>
							
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
                                        <input type="text" name="weight" class="form-control" value="" placeholder="Weight (kg)">
                                    </div>
                                    <?php echo form_error('weight') ?>
                                </div>
                            </div>
						 <div style="display:none;" class="form-group  <?php if(form_error('weight')) echo 'has-error'; ?> ">
                                <label for="weight" class="col-md-3"> Business Products Weight
                                    <span class="text-red"></span>
                                </label>
                                <div class="col-md-9" >
                                    <div id="weight">
                                        <input type="text" name="smb_weight" class="form-control" value="" placeholder="Weight (kg)">
                                    </div>
                                    <?php echo form_error('weight') ?>
                                </div>
                            </div>
							
                            <div style="display:none;" class="form-group <?php if(form_error('volume')) echo 'has-error'; ?>">
                            <label for="volume" class="col-md-3">Business Products Volume
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div id="volume">
                                    <input type="text" name="smb_volume" class="form-control" value="" placeholder="volume">
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
                                        <input type="text" name="invoice_no" class="form-control" value="<?php echo set_value('invoice_no'); ?>" placeholder="Invoice Number">
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
                                        <input type="text" name="quantity" class="form-control" value="<?php echo set_value('quantity'); ?>" placeholder="Quantity">
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
                                        <option value="18">Newly Added Shipment</option>
                                    </select>
                                    <?php echo form_error('status') ?>
                                </div>
                            </div>
                            
                            
                            
                            <?php  }  ?>
                            
                            
                            
                            
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
                        alert (shipper_pin);
                        
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
                        <script>
                        function get_state(id)
                        {
                        //   alert(id);
                        var mydata = {"country": id};
                        $.ajax({
                        type: "POST",
                        url: "getstate",
                        data: mydata,
                        success: function (response) {
                        $("#state").html(response);
                        //alert(response);
                        }
                        });
                        }
                        function get_district(id)
                        {
                        //   alert(id);
                        var mydata = {"state": id};
                        $.ajax({
                        type: "POST",
                        url: "get_district",
                        data: mydata,
                        success: function (response) {
                        $("#district").html(response);
                        //alert(response);
                        }
                        });
                        }
                        function get_location_id(id)
                        {  //   alert(id);
                        var mydata = {"district": id};
                        $.ajax({
                        type: "POST",
                        url: "get_location_id",
                        data: mydata,
                        success: function (response) {
                        $("#location_id").html(response);
                        }
                        });
                        }
                        function get_pincode(id)
                        {
                        var mydata = {"location": id};
                        $.ajax({
                        type: "POST",
                        url: "get_pincode",
                        data: mydata,
                        success: function (response) {
                        $("#pincode").html(response);
                        }
                        });
                        
                        $('#location').val(id);
                        }
                        function get_address_type(type)
                        {
                        
                        var mydata = {"type": type};
                        $.ajax({
                        type: "POST",
                        url: "get_address_type",
                        data: mydata,
                        success: function (response) {
                        //$("#address_type").html(response);
                        var result = response;
                        if(result ==0)
                        {
                        document.getElementById("addbtn").disabled = true;
                        }
                        else if(result ==1)
                        {
                        document.getElementById("addbtn").disabled = false;
                        }
                        
                        }
                        });
                        }
                        </script>
                        <!-- -->
                        
                        <script>
                        function get_state2(id)
                        {
                        //   alert(id);
                        var mydata = {"country": id};
                        $.ajax({
                        type: "POST",
                        url: "getstate",
                        data: mydata,
                        success: function (response) {
                        $("#state2").html(response);
                        //alert(response);
                        }
                        });
                        }
                        function get_district2(id)
                        {
                        //   alert(id);
                        var mydata = {"state": id};
                        $.ajax({
                        type: "POST",
                        url: "get_district",
                        data: mydata,
                        success: function (response) {
                        $("#district2").html(response);
                        //alert(response);
                        }
                        });
                        }
                        function get_location_id2(id)
                        {  //   alert(id);
                        var mydata = {"district": id};
                        $.ajax({
                        type: "POST",
                        url: "get_location_id",
                        data: mydata,
                        success: function (response) {
                        $("#location_id2").html(response);
                        }
                        });
                        }
                        function get_pincode2(id)
                        {
                        var mydata = {"location": id};
                        $.ajax({
                        type: "POST",
                        url: "get_pincode",
                        data: mydata,
                        success: function (response) {
                        $("#pincode2").html(response);
                        }
                        });
                        
                        $('#location2').val(id);
                        }
                        function get_address_type2(type)
                        {
                        
                        var mydata = {"type": type};
                        $.ajax({
                        type: "POST",
                        url: "get_address_type",
                        data: mydata,
                        success: function (response) {
                        //$("#address_type").html(response);
                        var result = response;
                        if(result ==0)
                        {
                        document.getElementById("addbtn").disabled = true;
                        }
                        else if(result ==1)
                        {
                        document.getElementById("addbtn").disabled = false;
                        }
                        
                        }
                        });
                        }
                        </script>