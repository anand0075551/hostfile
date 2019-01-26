<html>
    <head>
        <meta charset="UTF-8">
        <title><?php if(isset($title)) echo $title.' | '; ?> Chaitanya Foundations Registration </title>
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
         <!--amit--------------------------------->
		 
		

	
    
<script type="text/javascript">
  
		  
function ShowHide(id) {
		
				if (id != ""){
				$("#dvcont").slideDown();
						$("#lname").val("");
				}
				else{
				$("#dvcont").slideUp();
						$("#lname").val("");
				}
			}
			
			
function Showlast(id) {
		
				if (id != ""){
				$("#dvcontpin").slideDown();
						$("#contactno").val("");
				}
				else{
				$("#dvcontpin").slideUp();
						$("#contactno").val("");
				}
			}
function Showpin(id) {
		
				if (id != ""){
				$("#dvcont1").slideDown();
						$("#postal_code").val("");
				}
				else{
				$("#dvcont1").slideUp();
						$("#postal_code").val("");
				}
			}
			
			
function Show(id) {
		
				if (id != ""){
				$("#dvemail").slideDown();
						$("#edv").val("");
				}
				else{
				$("#dvemail").slideUp();
						$("#edv").val("");
				}
			}
 
			
 function ShowHideDiv() 
		{
        var chkYes = document.getElementById("chkYes");
		
        var dvPassport = document.getElementById("dvPassport");
        dvPassport.style.display = chkYes.checked ? "block" : "none";
        }
function ShowHideDiv1() 
		{
        var chkNo = document.getElementById("chkNo");
        var contactno = $("#contactno").val();

		var dvPassport1 = document.getElementById("dvPassport");
        dvPassport.style.display = chkNo.checked ? "block" : "none";
	
		$("#email").val(contactno + '@cfirst.co.in');
		}
	
		
		
     
function fun(){
		  
		var contactno = document.getElementById("contactno").value;
		
		if(contactno == "")
		{
			
		}
		else
		{
			alert("The given informatin is currect then click ok!!!!!!");
		}
	}
  
</script>



<style>
.dot{color:red;}

</style>
	   
	   
    </head>
   
	<body style="background-color:rgb(138,184,57)">
	<div class="container">
		<div class="row">
		<div class="col-sm-12">
					<div class="col-sm-2"></div>
		<div class="col-sm-8">
	
			
		<div class="well"style="margin-top:129px;border:1px solid #f33434;">
			
				
			
			
			 <?php echo form_open('', ['class' => 'form-horizontal']); ?>
			 
                <form action="http://localhost:8080/chaitanya/index.php" method="post" class="form-horizontal;">	
			
			     <h2 style="text-align:center;">Chaitanya Registrations</h2>
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

					
				<div class="form-group <?php if(form_error('first_name')) echo 'has-error'; ?>">
					<label class="control-label col-sm-2" for="firstName">First Name:<label class="dot">*</label></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" placeholder="Enter First Name" name="first_name" onKeyUp="ShowHide()">
						<?php echo form_error('first_name') ?>
					</div>
				</div>
				
				
				<div class="form-group <?php if(form_error('last_name')) echo 'has-error'; ?>" id="dvcont" style="display:none">
					<label class="control-label col-sm-2" for="last_name">Last Name:<label class="dot">*</label></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="last_name" onKeyUp="Showlast()">
						<?php echo form_error('last_name') ?>
					</div>
				</div>
				
				
				<div class="form-group <?php if(form_error('contactno')) echo 'has-error'; ?>" id="dvcontpin" style="display:none">
						<label class="control-label col-sm-2">Contact No:<label class="dot">*</label></label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="contactno" maxlength="10" placeholder="Enter Contact" name="contactno"  onkeyup="Showpin()">
							 <?php echo form_error('contactno') ?>

						</div>
				</div>
				
			<div class="form-group <?php if(form_error('postal_code')) echo 'has-error'; ?>" id="dvcont1" style="display:none">
						<label class="control-label col-sm-2">Postal Code:<label class="dot">*</label></label>
						<div class="col-sm-10">
							  <input type="text"  min="6"  name="postal_code" maxlength="6"  placeholder="Enter postal code" name="postal_code"  >
							 <?php echo form_error('postal_code') ?>

						</div>
			</div>
				
				
			<div class="form-group" id="dvemail" >
				<label class="control-label col-sm-2" >Do you have Email Id:<label class="dot">*</label></label>
			<div class="col-sm-10">
				<label for="chkYes">
					<input type="radio" id="chkYes" name="chkPassPort" value="1"  onclick="ShowHideDiv()" />
				Yes
				</label>
				<label for="chkNo">
					<input type="radio" id="chkNo" name="chkPassPort" value="2" onClick="ShowHideDiv1()" />
				No
				</label>

			<div id="dvPassport" style="display: none">
   
				<input type="text" class="form-control" id="email" placeholder="Enter Email Id" name="email">
			</div>
			
			 
			</div>
			</div>
			
				<div class="clearfix"></div>


                </div>
                <div class="footer">
                
				<button type="submit" name="submit" value="userRegistration" class="btn bg-olive btn-block"> 
                        <i class="fa fa-edit"></i> Register
                </button><br>
                <a href="http://chaitanyafoundations.org/"><Label name="button" value="" class="btn bg-olive btn-block"> 
                        <i class="fa fa-edit"></i>Return Home
                </Label ></a>
                    

                </div>
				

        </form>

        </div>

		</div>
		<div class="col-sm-2"></div>
        </div>
		</div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>



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
        </script>

    </div> <!--container-->


    </body>
</html>
