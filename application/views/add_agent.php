
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
								   
								   <tr><th> Available Pre-paid Balance in CPA Points	</th> <td> <?php  echo  number_format($wallet_balance, 2);   ?> 	 </td></tr>
								   <hr />
								 </table>	
				                
            </div><!-- /.box-body -->
				
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Add New Agent Referral</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
				
			      
						<div class="form-group <?php if(form_error('consumerCode')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3"> Refferer ID
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="consumerCode" class="form-control" readonly value="<?php echo $users->referredByCode ; ?>" >
                                <?php echo form_error('consumerCode') ?>

                            </div>
                        </div>
						<div class="form-group">
                            <label for="exampleInputEmail1" class="col-md-3"> Refferer Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="consumerCode1" class="form-control" readonly value="<?php echo $users->fname ; ?>" >
                                

                            </div>
                        </div>
						<div class="form-group <?php if(form_error('agentCode')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3"> Your Referral ID
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="agentCode" class="form-control" readonly value="<?php echo $users->referral_code ; ?>" >
                                <?php echo form_error('agentCode') ?>

                            </div>
                        </div>
						
						
                        
						<div class="form-group <?php if(form_error('sponsor_role')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Sponsorship Role
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="sponsor_role" class="form-control" readonly value="<?php echo $role = typeDbTableRow($users->sponsor_role)->rolename; ?>" placeholder="Enter Firm's email">
                                <?php echo form_error('sponsor_role') ?>

                            </div>
                        </div>
						<div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Sponsorship fees Deduction points from your Account
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="amount" class="form-control" readonly value="<?php echo  $users->amount; ?>" placeholder="Enter Firm's email">
                                <?php echo form_error('amount') ?>

                            </div>
                        </div>
						
				<?php	if ($wallet_balance >= $users->amount)  //If Balance is Greater than Deduction, Below fields will visible.
						{   if($users->sponsor_role == 77)
							{?>
									<div class="form-group <?php if(form_error('company_name')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Student Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="company_name" class="form-control"  value="<?php echo $users->company_name ; ?>" >
                                <?php echo form_error('company_name') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('licence')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3"> Role No
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="licence" name="licence" class="form-control"  value="<?php echo $users->licence; ?>" placeholder="Enter School's Role Number">
                                <?php echo form_error('email') ?>

                            </div>
                        </div>
						<div class="form-group <?php if(form_error('contactno')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Parents Contact No
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="contactno"  class="form-control" readonly value="<?php echo $users->to_cell; ?>" placeholder="Firm Mobile Number">
                                <?php echo form_error('contactno') ?>

                            </div>
                        </div>    
						<div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Parents Email address
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control"  value="<?php echo $users->email; ?>" placeholder="Enter Parents Email address">
                                <?php echo form_error('email') ?>

                            </div>
                        </div>
					<!--	<div class="form-group <?php if(form_error('agreed_per')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Agreed Commission Percentage(%)
							<span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="agreed_per" class="form-control"  value="<?php echo $users->agreed_per; ?>" >
                                <?php echo form_error('agreed_per') ?>

                            </div>
                        </div>
					
					-->	
						
						
						
						
                        <div class="form-group <?php if(form_error('password')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Password
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                <?php echo form_error('password') ?>

                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('passconf')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Password Confirmation
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="password" name="passconf" class="form-control" placeholder="Enter Confirmation Password">
                                <?php echo form_error('passconf') ?>

                            </div>
                        </div>

                												
						<div class="form-group <?php if(form_error('otp')) echo 'has-error'; ?>"> 
                            <label for="firstName" class="col-md-3">Enter OTP password sent to your mobile<span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="otp" class="form-control" value="<?php echo set_value('otp'); ?>" placeholder="OTP Password">
                             	
                                <?php echo form_error('otp') ?>
                            </div>
                        </div>		
								
						<?php	}else{?>	
						
						<div class="form-group <?php if(form_error('company_name')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Firm/Organization Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="company_name" class="form-control"  value="<?php echo $users->company_name ; ?>" >
                                <?php echo form_error('company_name') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('licence')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Firm/Organization Valid Licence Number
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="licence" name="licence" class="form-control"  value="<?php echo $users->licence; ?>" placeholder="Enter Firm's Valid Licence Number">
                                <?php echo form_error('email') ?>

                            </div>
                        </div>
						<div class="form-group <?php if(form_error('contactno')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Firms Contact no for OTP SMS No
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="contactno"  class="form-control" readonly value="<?php echo $users->to_cell; ?>" placeholder="Firm Mobile Number">
                                <?php echo form_error('contactno') ?>

                            </div>
                        </div>    
						<div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Firm/Login Email address
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control"  value="<?php echo $users->email; ?>" placeholder="Enter Firm's email">
                                <?php echo form_error('email') ?>

                            </div>
                        </div>
						<div class="form-group <?php if(form_error('agreed_per')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Agreed Commission Percentage(%)
							<span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="agreed_per" class="form-control"  value="<?php echo $users->agreed_per; ?>" >
                                <?php echo form_error('agreed_per') ?>

                            </div>
                        </div>
						
						
						
						
						
						
                        <div class="form-group <?php if(form_error('password')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Password
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                <?php echo form_error('password') ?>

                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('passconf')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Password Confirmation
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="password" name="passconf" class="form-control" placeholder="Enter Confirmation Password">
                                <?php echo form_error('passconf') ?>

                            </div>
                        </div>

                												
						<div class="form-group <?php if(form_error('otp')) echo 'has-error'; ?>"> 
                            <label for="firstName" class="col-md-3">Enter OTP password sent to your mobile<span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="otp" class="form-control" value="<?php echo set_value('otp'); ?>" placeholder="OTP Password">
                             	
                                <?php echo form_error('otp') ?>
                            </div>
                        </div>						
	
						<?php } }?>


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- PATH: Agent/public function add_agent and agent_model->add_agent();-->
					
                     <?php	if ($wallet_balance >= $users->amount)  
						{?>     <button type="submit" name="submit1" value="add_agent1" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Accept Deduction for New Referral
                        </button>
					 <!-- 	 <button type="submit" name="submit2" value="add_agent2" class="btn btn-danger">
                          <i class="fa fa-edit"></i> Re-send OTP       </button> 	-->
						<button type="button" name="submit2" value="add_agent2" class="btn btn-danger" onclick="sendopt(<?php  echo $users->id; ?>)">
                        <i class="fa fa-edit"></i> Send OTP SMS     </button>  
                   <?php }else{ ?> 
				  <font color="red"><i><b> Kindly Increase Your 'Pre-paid Balance' To Proceed Transaction... Thank You.</b></i></font>
				   <?php } ?> </div>
				   
				  
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
		var url ="<?php echo base_url('agent/otp_tran_agent'); ?>?id="+id;
        xmlhttp.open("GET",url,true);
        xmlhttp.send();	

	}
</script>