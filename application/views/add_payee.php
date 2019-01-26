<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

<?php } ?>


<!-- Legder Accounts -->
<?php 

foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 

$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;
/* Available Balance Wallet,loyality and Discount Points */

$wallet_balance    = ( $wal_debit - $wal_credit ) ;

//checking Deducter's Balance Amount.
	
	$user_data = $this->db->get_where('users', ['referral_code' => $users->pay_to]);
	foreach($user_data->result() as $deducter);
		
		{			
			$deducter_id  = $deducter->id;	
		}		
			$sms_user = $deducter_id;
			$pm_wallet 	= 'wallet';
			$query1  	= $this->notification_model->total_debit($sms_user, $pm_wallet);	
			if($query1-> num_rows() > 0) 
				{
					foreach ($query1->result() as $r1) 
					{
						$deducter_debit			= $r1->debit;
					}
				}
					$query2    	= $this->notification_model->total_credit($sms_user, $pm_wallet);		
				if($query2-> num_rows() > 0) 
				{
					foreach ($query2->result() as $r2) 
					{
						$deducter_credit			= $r2->credit;
					}
				}
						
				
				/* Available Balance Wallet,loyality and Discount Points */

				$deducter_balance    = ( $deducter_debit - $deducter_credit ) ;	

?>
<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
		<div class="box-body">
 <h3 class="box-title">Account Details</h3>
                <table class="table table-bordered">					
								   
								   <tr><th> Available Pre-paid Balance			</th> <td> <?php  echo amountFormat($wallet_balance);   ?> 	 </td></tr>
								   <hr />
								 </table>	
				                
            </div><!-- /.box-body -->
				
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Consumer Payment</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
	<?php		$user_info = $this->session->userdata('logged_user');
				$user_id = $user_info['user_id'];	
				$currentRolename   = singleDbTableRow($user_id)->rolename;	?>
				
			      
						<div class="form-group <?php if(form_error('fname')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Beneficiary Id
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="fname" class="form-control" readonly value="<?php echo $users->pay_to ; ?>" >
                                <?php echo form_error('fname') ?>

                            </div>
                        </div>
						<div class="form-group <?php if(form_error('fname')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Beneficiary  First Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="fname" class="form-control" readonly value="<?php echo $users->fname ; ?>" >
                                <?php echo form_error('fname') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Amount
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="amount" class="form-control" readonly value="<?php echo  $users->amount; ?>" placeholder="Enter Company's email">
                                <?php echo form_error('amount') ?>

                            </div>
                        </div>
<?php if($users->pay_type == '66') {?>
						<div class="form-group <?php if(form_error('to_cell')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">OTP SMS Number
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="to_cell" readonly class="form-control" value="<?php echo $users->from_cell; ?>" >
                                <?php echo form_error('to_cell') ?>

                            </div>
                        </div>  
<?php }else{?>
<div class="form-group <?php if(form_error('to_cell')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">OTP SMS Number
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="to_cell" readonly class="form-control" value="<?php echo $users->to_cell; ?>" >
                                <?php echo form_error('to_cell') ?>

                            </div>
                        </div>  
<?php }		?>

				
						<div class="form-group <?php if(form_error('transaction_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> Tranaction Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="transaction_type" readonly class="form-control" value="<?php echo $users->transaction_type; ?>" >
                                <?php echo form_error('transaction_type') ?>

                            </div>
                        </div>   
				<?php  if ($currentRolename == '11')  {     ?>  
						<div class="form-group <?php if(form_error('to_cell')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">OTP Number [Only for Admin - No Amount Limit]
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="to_cell" readonly class="form-control" value="<?php echo $users->otp; ?>" >
                                <?php echo form_error('to_cell') ?>

                            </div>
                        </div>   
				<?php } ?>
				
				<?php  if ($users->amount <= '5000' and $users->transaction_type == 'Transfer')  {     ?>  
						<div class="form-group <?php if(form_error('to_cell')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">OTP Number to Complete Transaction
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="to_cell" readonly class="form-control" value="<?php echo $users->otp; ?>" >
                                <?php echo form_error('to_cell') ?>

                            </div>
                        </div>   
				<?php } ?>
						
	<!-- ******************** T R A N S F E R ******************** -->							
				<?php	if ( ($wallet_balance >= $users->amount ) && ($users->transaction_type == 'Transfer'))  //If Balance is Greater than Deduction, Below fields will visible.
						{?>	
                       <!--
                     	<div class="form-group <?php if(form_error('key_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">SMS Key Reference Code<span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="key_id" class="form-control" readonly value="<?php echo $users->key_id; ?>" >
                             	
                                <?php echo form_error('key_id') ?>
                            </div>
                        </div>	                   
				-->
					<?php	if ( $users->active != '1')
							{  ?>
												
						<div class="form-group <?php if(form_error('otp')) echo 'has-error'; ?>"> 
                            <label for="firstName" class="col-md-3">Enter OTP password sent to your mobile<span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="otp" class="form-control" value="<?php echo set_value('otp'); ?>" placeholder="OTP Password">
                             	
                                <?php echo form_error('otp') ?>
                            </div>
                        </div>				
							<?php } ?>
							
							
							
							
	<!-- ******************** R E C I E V E ******************** -->					
						<?php	}elseif ( $users->transaction_type == 'Recieve')  //If Balance is lesser than Deduction and type is credit/recive, Below fields will visible.
						{ ?>
						
						<!--
						<div class="form-group <?php if(form_error('key_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">SMS Key Reference Code<span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="key_id" class="form-control" readonly value="<?php echo $users->key_id; ?>" >
                             	
                                <?php echo form_error('key_id') ?>
                            </div>
                        </div>	                   
				-->
							<?php	if ( $users->active != '1')
							{	 	if	($deducter_balance > $users->amount	)	{   ?> 
														
								<div class="form-group <?php if(form_error('otp')) echo 'has-error'; ?>"> 
									<label for="firstName" class="col-md-3">Enter OTP password sent to your mobile<span class="text-red">*</span>
									</label>
									<div class="col-md-9">
										<input type="text" name="otp" class="form-control" value="<?php echo set_value('otp'); ?>" placeholder="OTP Password">
										
										<?php echo form_error('otp') ?>
									</div>
								</div>	
							 <?php }
							} ?> 	
										
						
					<?php } ?>


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- PATH: Agent/public function add_agent and agent_model->add_agent();-->
					
					
					
					
					
					
					
					
					
<?php if ($users->transaction_type == 'Transfer')					
		{   if	(($wallet_balance >= $users->amount ))	
			{   if ( $users->active == 0)  
				{?>    	
			
			<?php  if ($users->amount >= '5000')  {     ?> 
						<button type="button" name="submit2" value="add_agent2" class="btn btn-danger" onclick="sendopt(<?php  echo $users->id; ?>)">
                        <i class="fa fa-edit"></i> Send OTP SMS     </button>  
			<?php } ?>			
						<button type="submit" name="submit1" value="add_agent1" class="btn btn-primary" onclick="lockoutSubmit(this)"> 
                        <i class="fa fa-edit"></i> Accepting My Deduction Amount  </button>
          <?php }elseif ($wallet_balance < $users->amount )
				{ ?> 
				  <font color="red"><i><b> Kindly Increase Your 'Pre-paid Balance' To Proceed Transaction... Thank You.</b></i></font>			   
				   
		  <?php }elseif ( $users->active != 0)
				{ ?> 
				  <font color="red"><i><b> This Transaction is Already Processed... Thank You.</b></i></font>
		  <?php } 
		  }
		}?>
		 
	<?php if ($users->transaction_type == 'Recieve')					
		{   if	(($deducter_balance > $users->amount ))	
			{   if ( $users->active == 0)  
				{ ?>     
							
						<button type="button" name="submit2" value="add_agent2" class="btn btn-danger" onclick="sendopt(<?php  echo $users->id; ?>)">
                        <i class="fa fa-edit"></i> Send OTP SMS     </button>  	
					
						<button type="submit" name="submit1" value="add_agent1" class="btn btn-primary" onclick="lockoutSubmit"> 
                        <i class="fa fa-edit"></i> Accepting Partner's Deduction Amount  </button>						
				  
		  <?php }		elseif ( $users->active != 0)
						{ ?> 
						  <font color="red"><i><b> This Transaction is Already Processed... Thank You.</b></i></font>
				  <?php } ?> 
	  <?php }     elseif ($deducter_balance < $users->amount )
						{ ?> 
						  <font color="red"><i><b> Always Check Your Partner 'Pre-paid Balance' for Recieving Transaction.</b></i></font>			   
					 <?php } 
		}  ?>	 
	 
			
						
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
                url : "<?php echo base_url('welcome/validateReferralCodeApi'); ?>",
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
                        $('#referralCodeStatus').html('<span style="color: #ff0000">Referral code is invalid</span>');
                    }
                    //alert(msg);
                });


        });
    });
	
			
				
				
				
</script>
<?php } ?>

<script>
<!-- JavaScript Function to call SMS on Screen -->
	function sendopt(id)
	{
		
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
            }
        };
		var url ="<?php echo base_url('product/otp_tran'); ?>?id="+id;
        xmlhttp.open("GET",url,true);
        xmlhttp.send();	

	}
	
	<!-- JavaScript Function to call SMS on Screen -->
	function proceed()
	{
		alert("Please wait to complete the Transaction. Don not click  on Back/Refresh button till the Invoice Generates...!");
	
	}

	<!-- Action for Please Wait Button.... -->
	function lockoutSubmit() {
     alert("Please wait to complete the Transaction. Do not click on Back/Refresh button until the Invoice Generates...!");
}
</script>

