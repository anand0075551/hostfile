<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php if(isset($title)) echo $title.' | '; ?> MyFair's Wallet System (My Wallet) </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />


        <!-- daterange picker -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-white">

        <div class="form-box" id="login-box">
            <div class="header"><i class="fa fa-eye"> Chaitany Foundations ***Registration_Portal*** </i> </div>
			<div class="text-red"><i class="fa fa-cog fa-spinner fa-spin"></i><i>Invalid details will leads to Inactive your Referral Code Anytime </i></div>
			<div class="text-blue"><i class="fa fa-cog fa-spin "></i><i><b>Use Latest Google Chrome Browser</b></i></div>
			
            <?php echo form_open('', ['class' => 'form-horizontal']); ?>
                <div class="body bg-gray">

                    <div class="form-group">

                        <?php echo flash_msg(); ?>

                        <?php if($this->session->flashdata('loggedIn_fail')){ ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-ban"></i>
                            <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                            <b>Alert!</b> <?php echo $this->session->flashdata('loggedIn_fail'); ?>
                        </div>
                        <?php } ?>

                        <?php if(validation_errors()){
                            echo '<div class="alert alert-danger" style="margin-left: 0;"> '.validation_errors().' </div>';
                        } ?>

                    </div>

                    <div class="form-group <?php if(form_error('referredByCode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Referral Code(Excluding first 3 Alphabet)
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon referralFa">
                                    <i class="fa fa-warning"></i>
                                </div>
                                <input class="form-control" name="referredByCode" type="text" value="<?php echo set_value('referredByCode'); ?>" placeholder="EX: 9777555123" />
                            </div>
                            <p id="referralCodeStatus"></p>
                            <?php echo form_error('referredByCode') ?>
                        </div>
                    </div>


                    <div class="form-group <?php if(form_error('first_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">First Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="first_name" class="form-control" value="<?php echo set_value('first_name'); ?>" placeholder="Enter First Name">
                            <?php echo form_error('first_name') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('last_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Enter Last Name">
                            <?php echo form_error('last_name') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
                        <label for="exampleInputEmail1" class="col-md-3">Email
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Enter email">
                            <?php echo form_error('email') ?>

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

                    <div class="form-group <?php if(form_error('contactno')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Mobile/Contact No
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="contactno" class="form-control" value="<?php echo set_value('contactno'); ?>" placeholder="Contact No / Mobile No">
                            <?php echo form_error('contactno') ?>

                        </div>
                    </div>
<!--
                    <div class="form-group <?php if(form_error('gender')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Gender <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="gender" class="form-control">
                                <option value=""> Select Gender </option>
                                <option value="male" <?php echo set_select('gender', 'male') ?>>Male</option>
                                <option value="female" <?php echo set_select('gender', 'female') ?>>Fe-Male</option>
                            </select>
                            <?php echo form_error('gender') ?>
                        </div>
                    </div>
-->
                    
                    <div class="form-group <?php if(form_error('date_of_birth')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Date of birth
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" name="date_of_birth" type="text" value="<?php echo set_value('date_of_birth'); ?>" data-mask="" data-inputmask="'alias': 'yyyy-mm-dd'">
                            </div>
                            <?php echo form_error('date_of_birth') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('rolename')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Membership Type 
                            <span class="text-red">*</span>
                        </label>
<!--                        <div class="col-md-9">
                            <input type="text" name="profession" class="form-control" value="<-?php echo set_value('profession'); ?>" placeholder="Select the Member type">
                            <-?php echo form_error('profession') ?>
                        </div>  
						**********Profession and Role fields are considered same for time being/Sync with App\view\add_agent***********
-->						<div class="col-md-9">
                            <select name="rolename" class="form-control">
                                <option value=""> Select The Type OF Membership </option>
								<option value="5" 	<?php echo set_select('rolename', 'customer')    ?>>Volunteer/Consumer</option>								
                                							
                            </select>
                            <?php echo form_error('rolename') ?>
                        </div>
                    </div>



                    <div class="form-group <?php if(form_error('adhaar_no')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Aadhaar Number        
						<span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="number" name="adhaar_no" value="<?php echo set_value('adhaar_no'); ?>" class="form-control" placeholder="Account will not 'Activate' for Invalid No">
                            <?php echo form_error('adhaar_no') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('time')) echo 'has-error'; ?>">
                        <label class="text-blue for="firstName" class="col-md-3">Declare your Social Responsibility
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="time" value="<?php echo set_value('time'); ?>" class="form-control" placeholder="In the Form of Hours per Month. Ex: 10">
							<input type="text" name="cash" value="<?php echo set_value('cash'); ?>" class="form-control" placeholder="In the Form of Cash per Month. Ex:500">
							  <input type="text" name="others" value="<?php echo set_value('others'); ?>" class="form-control" placeholder="In the Other forms per Month. Ex: Food, Cloths">
                            <?php echo form_error('time') ?>
                        </div>
                    </div>
					                  				
                    
					
					<div class="form-group <?php if(form_error('postal_code')) echo 'has-error'; ?>">
                        <label class="text-red" for="firstName" class="col-md-3">Postal Pin/ZIP Code (As per Govt ID Should be 6 digits)
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="number"   name="postal_code" min="6"  value="<?php echo set_value('postal_code'); ?>" class="form-control" placeholder="PIN Code">
                            <?php echo form_error('postal_code') ?>
                        </div>
                    </div>
	<div class="form-group <?php if(form_error('country')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Country</label>
                        <div class="col-md-9">
                            <select name="country" class="form-control">
                                <option value=""> Select Country </option>
                                <?php
                                if($countries->num_rows() > 0)
                                {
                                    foreach($countries->result() as $c){
                                        $selected = ($c->id == 105)? 'selected' : '';
                                        echo '<option value="'.$c->id.'" '.$selected.'> '.$c->country_name.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('country') ?>
                        </div>
                    </div>
		
		
		
		

                    <div class="form-group <?php // if(form_error('street_address')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Photo
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" size="20" />
                            <p class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</p>

                            <?php // echo form_error('street_address') ?>
                        </div>
                    </div>



                <div class="clearfix"></div>


                </div>
                <div class="footer">
                    <button type="submit" name="submit" value="userRegistration" class="btn bg-olive btn-block">
                        <i class="fa fa-edit"></i> Sign up
                    </button>

                    <p><a class="text-center" href="<?php echo base_url(); ?>"><i class="fa fa-info-circle"></i> I already have a membership</a></p>

                </div>
				
            </form>

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

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
		

		<!-- Page script for Country -->
	<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/countries.js"></script> 
	<script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/bundles/jquery"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/bundles/bootstrap"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/bundles/modernizr"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/scripts/CookieManager.js"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/scripts/MPD/Common/ga-events.js"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/bundles/jqueryval"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/scripts/postcode-validation.js"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/scripts/required-phone-validation.js"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/scripts/address-entry.js"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/scripts/signup.js"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/scripts/pop-up-window.js"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/scripts/placeholder-shim.js"></script>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/scripts/trimFields.js"></script>
	 <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/content/cssefe4.css" rel="stylesheet"/>
	 <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/styles/address-details.css" rel="stylesheet" />
     <link href="<?php echo base_url('assets/admin'); ?>/js/plugins/country/deprixa_components/styles/signup.css" rel="stylesheet" />
	
	
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
        </script>




    </body>
</html>
