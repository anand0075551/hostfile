<?php

//check category/public function wallet_to_discount()

//foreach( $usedwallet->result() 		as $usedWallet);  //wallet points 

foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 
foreach( $loy_debit->result() 		as $loy_debit);
foreach( $loy_credit->result() 		as $loy_credit);
foreach( $dis_debit->result() 		as $dis_debit);
foreach( $dis_credit->result() 		as $dis_credit);
//foreach( $convertWallet->result() 	as $converWallet);  //Convert Wallet Ratio 

//$totalWallet  = $wallet->amount; 
//$usedwallet   = $usedWallet->amount;
$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;
$loy_debit			= $loy_debit->debit;
$loy_credit      	= $loy_credit->credit;
$dis_debit			= $dis_debit->debit;
$dis_credit      	= $dis_credit->credit;
/* Available Balance Wallet,loyality and Discount Points */

//$wallet  		= $totalWallet;
$wallet_balance    = ( $wal_debit - $wal_credit ) ;
$loyality_balance  = ( $loy_debit - $loy_credit ) ;
$discount_balance  = ( $dis_debit - $dis_credit ) ;

//Getting Ratio from Points Ratio Table
$ratio_wallet     = '1'; 
//$ratio_loyality   = $converWallet->alpha; 
//$ratio_discount   = $converWallet->beta;

/* Converting Wallet to loyality and Discount Points Ratio  */
//$loyality = (($ratio_loyality * $wallet_balance) ); 
//$discount = (($ratio_discount * $wallet_balance)); 

//$wallet_for_loyality = (($wallet_balance / $ratio_loyality)); 
//$wallet_for_discount = (($wallet_balance / $ratio_discount)); 
$user_info = $this->session->userdata('logged_user');
$user_user_id = $user_info['user_id'];
$user_account_no     = singleDbTableRow($user_user_id)->account_no;

?>
<?php function page_css(){ ?>
 <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
    
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header"></div><!-- /.box-header -->
            <table class="table table-bordered">
            <tr><th> CPA Values 		</th> <td> <?php echo amountFormat($wallet_balance); ?>	 </td></tr>
            </table>
				
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   		

							<!--RECHARGE -->
    <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">PREPAID MOBILE</a></li>
              <li><a href="#tab_2" data-toggle="tab">DTH</a></li>
              <li><a href="#tab_3" data-toggle="tab">DATACARD</a></li>
              <li><a href="#tab_4" data-toggle="tab">POSTPAID</a></li>
              <li><a href="#tab_5" data-toggle="tab">LANDLINE</a></li>
              <li><a href="#tab_6" data-toggle="tab">BROADBAND</a></li>
              <li><a href="#tab_7" data-toggle="tab">ELECTRICITY BILL</a></li>
              <li><a href="#tab_8" data-toggle="tab">GAS BILL</a></li>
              <li><a href="#tab_9" data-toggle="tab">INSURANCE</a></li>
            </ul>
            <div class="tab-content">
            <!--MOBILE -->
              <div class="tab-pane active" id="tab_1">
              
                  <section class="content">
                    <div class="row">
                    
                    <div class="col-md-3">
                    <!-- general form elements -->
                    <div class="box box-primary">
                    <div class="box-header"></div><!-- /.box-header -->
                    <div class="box-body">
                    <!-- no: -->
                    	<div class="form-group <?php if(form_error('recharge_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Enter Number
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="recharge_no" id="mobile" class="form-control" placeholder="Mobile No" onChange="check_mobile()"> 
                                <?php echo form_error('recharge_no') ?>
        
                            </div>
                        </div>
                        <!--Operator Location  PATH: //check: billpay/public function get_op_loc()-->
                        <div id="op_result"></div><!--DO NOT DELETE -->
                        <!--Amount -->
                        
                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">  Enter Amount
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="amount" id="mbl_amnt" step="1" min="1"  class="form-control" placeholder="Enter the Amount" max="<?php  echo ($wallet_balance); ?>" >
									<?php echo form_error('amount') ?>
								</div>
						</div>
                        <!--submit -->
                        <div class="box-footer">      <!-- PATH: //check billpay/public function recharge() -->
                        <button type="submit" name="submit"  value="recharge_mobile" class="btn btn-primary">
                            <i class="fa fa-money"></i> Recharge
                        </button>
                    </div>
                        <!-- -->
                    </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    </div><!--/.Custom labels -->
                    <!--OFFER -->
                    <div class="col-md-9">
                    <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                   		<div id="mbl_offer_result"></div><!--DO NOT DELETE -->
                    </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    </div>
                    <!--/.OFFER -->
                    
                    </div>
                 </section>
                
                
              </div>
              <!-- DTH -->
              <div class="tab-pane" id="tab_2">
                <!-- -->
                <section class="content">
                    <div class="row">
                    
                    <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary">
                    <div class="box-header"></div><!-- /.box-header -->
                    <div class="box-body">
                    <!-- no: -->
                    	<div class="form-group <?php if(form_error('recharge_no')) echo 'has-error'; ?>">
								<label for="nmbr" class="col-md-3">Enter Subscriber Number
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="number" name="dth_no" id="subsc_no" onChange="check_dth()" class="form-control" placeholder="Enter Subscriber No"> 
									<?php echo form_error('recharge_no') ?>

								</div>
						</div>
                        <!--Operator Location  PATH: //check: billpay/public function get_op_dth()-->
                        <div id="dth_result"></div><!--DO NOT DELETE -->
                        <!--Amount -->
                        
                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">  Enter Amount
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="dth_amount" id="dth_amount" step="1" min="1"  class="form-control" placeholder="Enter the Amount" max="<?php  echo ($wallet_balance); ?>" >
									<?php echo form_error('amount') ?>
								</div>
						</div>
                        <!--submit -->
                        <div class="box-footer">      <!-- PATH: //check billpay/public function recharge() -->
                        <button type="submit" name="submit"  value="recharge_dth" class="btn btn-primary">
                            <i class="fa fa-money"></i> Recharge
                        </button>
                    </div>
                        <!-- -->
                    </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    </div><!--/.Custom labels -->
                    <!--OFFER -->
                    <div class="col-md-6">
                        <div class="box box-primary">
                        <div class="box-header"></div>
                        <div class="box-body">
                        <div id="dth_offer_result"></div><!--DO NOT DELETE -->
                        </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                    <!--/.OFFER -->
                    
                    </div>
                 </section>
                <!-- -->
              </div>
              <!-- DATACARD -->
              <div class="tab-pane" id="tab_3">
                <!-- -->
                <section class="content">
                    <div class="row">
                    
                    <div class="col-md-3">
                    <!-- general form elements -->
                    <div class="box box-primary">
                    <div class="box-header"></div><!-- /.box-header -->
                    <div class="box-body">
                    <!-- no: -->
                    	<div class="form-group <?php if(form_error('recharge_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Enter Number
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="data_no" id="data_no" class="form-control" placeholder="Mobile No" onChange="check_data()"> 
                                <?php echo form_error('recharge_no') ?>
        
                            </div>
                        </div>
                        <!--Operator Location  PATH: //check: billpay/public function post_get_op_loc()-->
                        <div id="data_result"></div><!--DO NOT DELETE -->
                        <!--Amount -->
                        
                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">  Enter Amount
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="data_amount" id="data_amount" step="1" min="1"  class="form-control" placeholder="Enter the Amount" max="<?php  echo ($wallet_balance); ?>" >
									<?php echo form_error('amount') ?>
								</div>
						</div>
                        <!--submit -->
                        <div class="box-footer">      <!-- PATH: //check billpay/public function recharge() -->
                        <button type="submit" name="submit"  value="data_recharge" class="btn btn-primary">
                            <i class="fa fa-money"></i> Recharge
                        </button>
                    </div>
                        <!-- -->
                    </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    </div><!--/.Custom labels -->
                    <!--OFFER -->
                    <div class="col-md-9">
                    <!-- general form elements -->
                        <div class="box box-primary">
                        <div class="box-header"></div><!-- /.box-header -->
                        <div class="box-body">
                         <div id="data_offer_result"></div><!--DO NOT DELETE -->
                        </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                    <!--/.OFFER -->
                    
                    </div>
                 </section>
                <!-- -->
              </div>
              <!-- POSTPAID -->
              <div class="tab-pane" id="tab_4">
                <!-- -->
                <section class="content">
                    <div class="row">
                    
                    <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                    <div class="box-header"></div><!-- /.box-header -->
                    <div class="box-body">
                    <!-- no: -->
                    	<div class="form-group <?php if(form_error('Operator')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Operator
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="post_opt" id="post_opt" class="form-control">
                                 <option value="25">Airtel Postpaid</option>
                                 <option value="26">Idea Postpaid</option>
                                 <option value="27">Vodafone Postpaid</option>
                                 <option value="28">Reliance-GSM Postpaid</option>
                                 <option value="29">Reliance-CDMA Postpaid</option>
                                 <option value="30">BSNL Postpaid</option>
                                 <option value="31">Tata Docomo Postpaid</option>
                                 <option value="32">Tata Indicom Postpaid</option>
                                 <option value="33">Aircel Postpaid</option>
                                 <option value="34">MTS Postpaid</option>
                            </select>
        					</div>
                        </div>
                        
                        <!--Amount -->
                        <div class="form-group <?php if(form_error('post_no')) echo 'has-error'; ?>">
								<label for="post_no" class="col-md-3">  Enter Number
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="post_no"   class="form-control" placeholder="Enter the Number"  >
									<?php echo form_error('amount') ?>
								</div>
						</div>
                        <div class="form-group <?php if(form_error('post_acc')) echo 'has-error'; ?>">
								<label for="post_no" class="col-md-3">  Account Number
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="post_acc"   class="form-control" placeholder="Enter the Account Number"  value="<?php echo $user_account_no;?>">
									<?php echo form_error('post_acc') ?>
								</div>
						</div>
                        
                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">  Enter Amount
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="post_amount" step="1" min="1"  class="form-control" placeholder="Enter the Amount" max="<?php  echo ($wallet_balance); ?>" >
									<?php echo form_error('amount') ?>
								</div>
						</div>
                        <!--submit -->
                        <div class="box-footer">      <!-- PATH: //check billpay/public function recharge() -->
                        <button type="submit" name="submit"  value="post_recharge" class="btn btn-primary">
                            <i class="fa fa-money"></i> Recharge
                        </button>
                    </div>
                        <!-- -->
                    </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    </div><!--/.Custom labels -->
                    
                    </div>
                 </section>
                <!-- -->
              </div>
              <!-- LANDLINE -->
              <div class="tab-pane" id="tab_5">
                <!-- -->
                <section class="content">
                    <div class="row">
                    
                    <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                    <div class="box-header"></div><!-- /.box-header -->
                    <div class="box-body">
                    <!-- no: -->
                    	<div class="form-group <?php if(form_error('Operator')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Operator
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="land_opt" id="land_opt" class="form-control">
                                  <option value="41">BSNL Landline</option>
                                 <option value="42">Reliance Landline</option>
                                 <option value="43">Tata Docomo Landline</option>
                                 <option value="44">MTNL Delhi Landline</option>
                                 <option value="45">Airtel Landline</option>
                            </select>
        					</div>
                        </div>
                        
                        <!--Amount -->
                        <div class="form-group <?php if(form_error('post_no')) echo 'has-error'; ?>">
								<label for="post_no" class="col-md-3">  Enter Number
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="land_no"   class="form-control" placeholder="Enter the Number"  >
									<?php echo form_error('amount') ?>
								</div>
						</div>
                        <div class="form-group <?php if(form_error('post_acc')) echo 'has-error'; ?>">
								<label for="post_no" class="col-md-3">  Account Number
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="land_acc"   class="form-control" placeholder="Enter the Account Number"  value="<?php echo $user_account_no;?>">
									<?php echo form_error('post_acc') ?>
								</div>
						</div>
                        <div class="form-group <?php if(form_error('std')) echo 'has-error'; ?>">
								<label for="post_no" class="col-md-3"> STD Code
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="text" name="land_std"   class="form-control" placeholder="Enter the STD" >
									<?php echo form_error('post_acc') ?>
								</div>
						</div>
                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">  Enter Amount
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="land_amount" step="1" min="1"  class="form-control" placeholder="Enter the Amount" max="<?php  echo ($wallet_balance); ?>" >
									<?php echo form_error('amount') ?>
								</div>
						</div>
                        <!--submit -->
                        <div class="box-footer">      <!-- PATH: //check billpay/public function recharge() -->
                        <button type="submit" name="submit"  value="land_recharge" class="btn btn-primary">
                            <i class="fa fa-money"></i> Recharge
                        </button>
                    </div>
                        <!-- -->
                    </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    </div><!--/.Custom labels -->
                    
                    </div>
                 </section>
                <!-- -->
              </div>
              <!-- BROADBAND -->
              <div class="tab-pane" id="tab_6">
                <!-- -->
                <section class="content">
                    <div class="row">
                    
                    <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                    <div class="box-header"></div><!-- /.box-header -->
                    <div class="box-body">
                    <!-- no: -->
                    	<div class="form-group <?php if(form_error('Operator')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Operator
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="broad_opt" id="broad_opt" class="form-control">
                                 <option value="79">Tikona ISP Postpaid</option>
                            </select>
        					</div>
                        </div>
                        
                        <!--Amount -->
                        <div class="form-group <?php if(form_error('post_no')) echo 'has-error'; ?>">
								<label for="post_no" class="col-md-3">  Enter Number
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="broad_no"   class="form-control" placeholder="Enter the Number"  >
									<?php echo form_error('amount') ?>
								</div>
						</div>
                        <div class="form-group <?php if(form_error('post_acc')) echo 'has-error'; ?>">
								<label for="post_no" class="col-md-3">  Account Number
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="broad_acc"   class="form-control" placeholder="Enter the Account Number"  value="<?php echo $user_account_no;?>">
									<?php echo form_error('post_acc') ?>
								</div>
						</div>
                        
                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">  Enter Amount
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="broad_amount" step="1" min="1"  class="form-control" placeholder="Enter the Amount" max="<?php  echo ($wallet_balance); ?>" >
									<?php echo form_error('amount') ?>
								</div>
						</div>
                        <!--submit -->
                        <div class="box-footer">      <!-- PATH: //check billpay/public function recharge() -->
                        <button type="submit" name="submit"  value="broad_recharge" class="btn btn-primary">
                            <i class="fa fa-money"></i> Recharge
                        </button>
                    </div>
                        <!-- -->
                    </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    </div><!--/.Custom labels -->
                    
                    </div>
                 </section>
                <!-- -->
              </div>
              <!-- ELECTRICITY -->
              <div class="tab-pane" id="tab_7">
                <!-- -->
                <section class="content">
                    <div class="row">
                    
                    <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                    <div class="box-header"></div><!-- /.box-header -->
                    <div class="box-body">
                    <!-- no: -->
                    	<div class="form-group <?php if(form_error('Operator')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Operator
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="elec_opt" id="elec_opt" class="form-control">
                                <option value="46">BSES Rajdhani Power Delhi</option>
                                 <option value="47">BSES Yamuna Power Delhi</option>
                                 <option value="48">TPDDL/NDPL Delhi</option>
                                 <option value="49">Reliance Energy Mumbai</option>
                                 <option value="50">North Bihar Electricity</option>
                                 <option value="51">South Bihar Electricity</option>
                                 <option value="52">BEST Electricity</option>
                                 <option value="53">Ajmer Vidyut Vitran Nigam-Rajasthan</option>
                                 <option value="54">BESCOM Bengaluru</option>
                                 <option value="55">CESC West Bengal</option>
                                 <option value="56">CSEB Chhattisgarh</option>
                                 <option value="57">Jaipur Vidyut Vitran Nigam-Rajasthan</option>
                                 <option value="58">Jodhpur Vidyut Vitran Nigam-Rajasthan</option>
                                 <option value="59">Madhya Kshetra Vitaran-Madhya Pradesh</option>
                                 <option value="60">MSEDC-Maharashtra</option>
                                 <option value="61">Noida Power-Noida</option>
                                 <option value="62">Paschim Kshetra Vitaran-Madhya Pradesh</option>
                                 <option value="63">Andhra Pradesh-Southern Power</option>
                                 <option value="64">Andhra Pradesh-Central Power</option>
                                 <option value="65">Southern Power-Telangana</option>
                                 <option value="66">Torrent Power</option>
                                 <option value="67">Dakshin Gujrat VIJ Co. Ltd.</option>
                                 <option value="68">Madhya Gujrat VIJ Co. Ltd.</option>
                                 <option value="69">Uttar Gujrat VIJ Co. Ltd.</option>
                                 <option value="70">Paschim Gujrat VIJ Co. Ltd.</option>
                                 <option value="71">Uttar Pradesh Power Co. Ltd.</option>
                            </select>
        					</div>
                        </div>
                        
                        <!--Amount -->
                        
                        <div class="form-group <?php if(form_error('post_acc')) echo 'has-error'; ?>">
								<label for="post_no" class="col-md-3">  CA Number
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="elec_no"   class="form-control" placeholder="Enter CA Number"  value="<?php echo $user_account_no;?>">
									<?php echo form_error('post_acc') ?>
								</div>
						</div>
                        
                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">  Enter Amount
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="elec_amount" step="1" min="1"  class="form-control" placeholder="Enter the Amount" max="<?php  echo ($wallet_balance); ?>" >
									<?php echo form_error('amount') ?>
								</div>
						</div>
                        <!--submit -->
                        <div class="box-footer">      <!-- PATH: //check billpay/public function recharge() -->
                        <button type="submit" name="submit"  value="elec_recharge" class="btn btn-primary">
                            <i class="fa fa-money"></i> Recharge
                        </button>
                    </div>
                        <!-- -->
                    </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    </div><!--/.Custom labels -->
                    
                    </div>
                 </section>
                <!-- -->
              </div>
              <!-- GAS -->
              <div class="tab-pane" id="tab_8">
                 <!-- -->
                <section class="content">
                    <div class="row">
                    
                    <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                    <div class="box-header"></div><!-- /.box-header -->
                    <div class="box-body">
                    <!-- no: -->
                    	<div class="form-group <?php if(form_error('Operator')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Operator
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="gas_opt" id="gas_opt" class="form-control">
                                <option value="72">Mahanagar Gas</option>
                 <option value="73">Adani Gas</option>
                 <option value="74">Gujrat Gas</option>
                 <option value="75">Indraprastha Gas</option>
                            </select>
        					</div>
                        </div>
                        
                        <!--Amount -->
                        
                        <div class="form-group <?php if(form_error('post_acc')) echo 'has-error'; ?>">
								<label for="post_no" class="col-md-3">  CA Number
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="gas_no"   class="form-control" placeholder="Enter CA Number"  value="<?php echo $user_account_no;?>">
									<?php echo form_error('post_acc') ?>
								</div>
						</div>
                        
                        <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">  Enter Amount
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<input type="number" name="gas_amount" step="1" min="1"  class="form-control" placeholder="Enter the Amount" max="<?php  echo ($wallet_balance); ?>" >
									<?php echo form_error('amount') ?>
								</div>
						</div>
                        <!--submit -->
                        <div class="box-footer">      <!-- PATH: //check billpay/public function recharge() -->
                        <button type="submit" name="submit"  value="gas_recharge" class="btn btn-primary">
                            <i class="fa fa-money"></i> Recharge
                        </button>
                    </div>
                        <!-- -->
                    </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    </div><!--/.Custom labels -->
                    
                    </div>
                 </section>
                <!-- -->
              </div>
              <!-- INSURANCE -->
              <div class="tab-pane" id="tab_9">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
              </div>
             
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
    <!--/.RECHARGE-->

 
                </form>
            </div><!-- /.box -->


    </div>   <!-- /.row -->
</section><!-- /.content -->
<!--Get op and loc-->
<script type="text/javascript" language="javascript">
	function check_mobile() 
	{
		if(!(/^\d{10}$/.test(document.getElementById('mobile').value)))
		{
	
		 alert( "Enter Valid Phone Number." );
	
		 return false;
	
		}
		else
		{
			//alert(id);
			var mob = document.getElementById('mobile').value;
			var mydata = {"mob": mob};
		<!--TO GET LOCATION AND OPERATOR -->
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Billpay/get_op_loc') ?>",
				data: mydata,
				success: function (response) {
					$("#op_result").html(response);
				}
			});  
			<!--TO GET OFFERS -->
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Billpay/get_mbl_offer') ?>",
				data: mydata,
				success: function (response) {
					$("#mbl_offer_result").html(response);
				}
			});  
			
		}
	}
</script>
<!--Get op and loc-->
<script type="text/javascript" language="javascript">
	function check_dth() 
	{
		
		if(!(/^\d{10}$/.test(document.getElementById('subsc_no').value)))
		{
	
		 alert( "Enter Valid  Number." );
	
		 return false;
	
		}
		else
		{
			$.ajax({
            url: "<?php echo base_url('Billpay/get_op_dth') ?>", //This is the current doc
            type: "POST",
            data: ({mob: document.getElementById('subsc_no').value}),
            success: function(data){
             $("#dth_result").html(data);
            }
        }); 
		$.ajax({
            url: "<?php echo base_url('Billpay/get_dth_offer') ?>", //This is the current doc
            type: "POST",
            data: ({mob: document.getElementById('subsc_no').value}),
            success: function(data){
             $("#dth_offer_result").html(data);
            }
        }); 
			
		}
	}
	</script>
    <script type="text/javascript" language="javascript">
	function check_data() 
	{
		if(!(/^\d{10}$/.test(document.getElementById('data_no').value)))
		{
	
		 alert( "Enter Valid Phone Number." );
	
		 return false;
	
		}
		else
		{
			//alert(id);
			var mob = document.getElementById('data_no').value;
			var mydata = {"mob": mob};
		
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Billpay/data_get_op_loc') ?>",
				data: mydata,
				success: function (response) {
					$("#data_result").html(response);
				}
			}); 
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Billpay/data_offer') ?>",
				data: mydata,
				success: function (response) {
					$("#data_offer_result").html(response);
				}
			});  
			
		}
	}
</script>
<?php function page_js(){ ?>
<!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    



    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- Page script -->
    <script type="text/javascript">
        $(function() {
            //Date range picker
            $('#reservation').daterangepicker({ format: 'YYYY-MM-DD' });
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        });
    </script>
    <script>
	function get_mbl_offer(cnt) 
	{
		var amnt = document.getElementById('mbl'+cnt).value
		document.getElementById('mbl_amnt').value = amnt;
	}
	
	</script>
    <script>
	function get_dth_offer(cnt) 
	{
		var amnt = document.getElementById('dth'+cnt).value
		document.getElementById('dth_amount').value = amnt;
	}
	
	</script>
    <script>
	function get_data_offer(cnt) 
	{
		var amnt = document.getElementById('data'+cnt).value
		document.getElementById('data_amount').value = amnt;
	}
	
	</script>

<!--Anand J-query-->
	


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
</head>

<?php } ?>

