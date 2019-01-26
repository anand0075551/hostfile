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
                <div class="box-header">
                    <h3 class="box-title">Recharge Pre-paid Mobile</h3>
                </div><!-- /.box-header -->
				
				
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                   	
					<table id="deposit" class="table table-bordered table-striped table-hover">
					 
								<table class="table table-bordered">
									 <h4 class="box-title" color="red" >Available Balance </h4>									
								   <tr><th> CPA Values 		</th> <td> <?php echo amountFormat($wallet_balance); ?>	 </td></tr>
							<!--	   <tr><th> Loyality Points		</th> <td> <?php echo ($loyality_balance); ?>	 </td></tr>
								   <tr><th> Discount Points		</th> <td> <?php echo ($discount_balance); ?>	 </td></tr>
							-->	   
								</table>	

							

 <!--
                  <div class="form-group <?php if(form_error('service_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Type of Service
                            <span class="text-red">*</span>
                        </label>
						<div class="col-md-9">
                        
							<input type="radio" name="service_type"  value="mobile" checked id="mobile" /> Mobile        
							<input type="radio" name="service_type"  value="dth" 			id="dth" /> DTH
							<input type="radio" name="service_type"  value="datacard" 		id="datacard" /> Data Card 
							
                            <?php echo form_error('service_type') ?>
                        </div>
                    </div>
					
					 <div class="form-group <?php if(form_error('operator')) echo 'has-error'; ?>">
						<label for="firstName" class="col-md-3">Type of Service
							<span class="text-red">*</span></label>
								<div class="col-md-9">
								

									<select name="operator">
												 <option value="AT">Airtel</option>
												 <option value="VF">Vodafone</option>
												 <option value="BS">BSNL</option>
												 <option value="BSS">BSNL Special/Validity</option>
												 <option value="IDX">Idea</option>
												 <option value="TD">Docomo GSM</option>
												 <option value="TDS">Docomo Special GSM</option>
												 <option value="TI">Docomo CDMA</option>
												 <option value="RG">Reliance GSM</option>
												 <option value="RL">Reliance CDMA</option>
												 <option value="MS">MTS</option>
												 <option value="AL">Aircel</option>
												 <option value="UN">Uninor</option>
												 <option value="UNS">Uninor Special</option>
												 <option value="VD">Videocon</option>
												 <option value="VDS">Videocon Special</option>
												 <option value="MTD">MTNL Delhi</option>
												 <option value="MTDS">MTNL Delhi Special</option>
												 <option value="MTM">MTNL Mumbai</option>
												 <option value="MTMS">MTNL Mumbai Special</option>
												 <option value="TW">Tata Walky</option>
									</select>
									<br/><br/>	 
									<?php echo form_error('operator') ?>
									</div>
						</div> -->

					
				
					    <div class="form-group <?php if(form_error('recharge_no')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Enter Number
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="number" name="recharge_no" class="form-control" placeholder="Enter Account/Mobile No"> 
									<?php echo form_error('recharge_no') ?>

								</div>
						</div> 
						
						 <div class="form-group <?php if(form_error('operator_id')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Operator Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								
									 <select name="operator_id" class="form-control">

                                        <option value=""> Select Operator</option>
                                        <?php foreach($users->result() as $user){
                                            echo '<option value="'.$user->jolo_code.'"> '.$user->opt_name.' </option>';
											//echo '<option value="'.$user->id.'"> '.$user->first_name.' </option>';
                                        }?>

                                    </select>
									<?php echo form_error('operator_id') ?>

								</div>
						</div> 
						
						<div class="form-group <?php if(form_error('loc_id')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Operator Circle/Location
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
								<!-- <input type="number" name="loc_name" id="loc_name" class="form-control"> -->
									<select name="loc_id" class="form-control">

                                        <option value=""> Select Circle  </option>
                                        <?php foreach($circle->result() as $user){
                                            echo '<option value="'.$user->c_code.'"> '.$user->circle.' </option>';
											//echo '<option value="'.$user->id.'"> '.$user->first_name.' </option>';
                                        }
                                        ?>

                                    </select>
									<?php echo form_error('loc_id') ?>

								</div>
						</div> 
						
						
						<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">  Enter Amount
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<input type="number" name="amount" step="1" min="1"  class="form-control" placeholder="Enter the Amount" max="<?php  echo ($wallet_balance); ?>" >
									<?php echo form_error('amount') ?>
								</div>
						</div>

 
     					

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
</table>
                  <div class="box-footer">      <!-- PATH: //check billpay/public function recharge_mobile() -->
                        <button type="submit" name="submit"  value="recharge_mobile" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Recharge
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->

<!-- $data['users'] = singleDbTableRow($id, 'billpay_request'); 
$table = 'billpay_request';
$where_array = array('recharge_no' => recharge_no, 'amount' => $amount, 'pay_by' => 'logged_user', 'active' => '0');
$query = $this->db->where($where_array)->get($table);
foreach($query->result() as $users)
{
	  $pay_to 	= $users->pay_to; 		//Beneficiary Id 
	$payee_name = $users->payee_name; 	//Bill Payments Reciever 
	$amount = $users->amount; 				//amount
	$amount = $users->sms_no;
	$pay_type = $users->pay_type;
	$recharge_no = $users->recharge_no;
	$operator_type = $users->operator_type;
		
	$otp = $users->otp;
}
	
	<div class="form-group < ?php if(form_error('otp')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">OTP Number to Complete Transaction
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="otp" readonly class="form-control" value="<?php echo $users->otp; ?>" >
                                < ?php echo form_error('otp') ?>

                            </div>
                        </div>   
	
	
	
	



-->

        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>
<!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            var oTable = $("#example").dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url('category/categoryListJson'); ?>",
                    "data": function ( d ) {
                        d.dateRange = $('[name="searchByNameInput"]').val();
                    }
                }
            });

            $('button#searchByDateBtn').on('click', function(){
                oTable.fnDraw();
            });

        });

    </script>



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

<!--Anand J-query-->
	
<script>
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
</head>

<?php } ?>

