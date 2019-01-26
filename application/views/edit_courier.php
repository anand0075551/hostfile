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
	foreach($courier_Details->result() as $courier); 
 ?>
 
 
 
 
 
 
 
 
 
 		<?php
					$get = $this->db->get_where('cms_deliver', ['cid',$courier->cons_no])->num_rows();
					if($get > 0){
						foreach($get->reslut() as $role);
						$from_role = singleDbTableRow($role->assigned_by)->rolename;
						$to_role = singleDbTableRow($role->dbid)->rolename;
					}
					else{
						$currentAuthDta = loggedInUserData();
						$currentUser = $currentAuthDta['role'];
						$user_info = $this->session->userdata('logged_user');
						$user_id = $user_info['user_id'];
						$currentRolename = singleDbTableRow($user_id)->rolename;
						
						
						
						
						if($currentRolename == '27')
						{
						$from_role = '12';
						$to_role = '27';
						}
						
						else{
						$from_role = $currentRolename;
						$to_role = '12';
						}
						
					}
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
                    					<div class="col-md-12">
					                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">
                                       Courier  Details
                                    </h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">

                                        <table class="table table-striped">
											
											<tr>
                                                <td>Consignment No</td>
                                                <td><?php echo $courier->cons_no; ?></td>
                                            </tr>
											
											<tr>
                                                <td>Shipper Name</td>
                                                <td><?php 
												
											//	echo $courier->ship_name; 
								$query = $this->db->get_where('users',['id'=>$courier->ship_name]);
								if($query->num_rows()>0)
								{								
									foreach($query->result() as $d)
									{
									echo $user = $d->first_name.' '.$d->last_name;
									}
								}
								else 
								{
									echo $user =  " ";
								} 
												
												?></td>
                                            </tr>
											
											
											<tr>
                                                <td>Shipper Phone</td>
                                                <td><?php echo $courier->phone; ?></td>
                                            </tr>
											
											
                                        </table>

                                    </div><!-- /.box-body -->
</div>
						</div><!--/.col (left) -->		
					
					
					
					
					
					
					                    			
					
					
					<div class="box-body">
                        
                      
			<div class="box-body">
                        
						<div class="row">
							<div class="col-lg-12">
								<font size="5">  Shippment Info :  </font>
							</div>
						</div>
						<br>
                        
						
						

						
	<input type="hidden" name="shipper_phn" id="phone" class="form-control"  value="<?php echo $courier->phone; ?>">
	<input type="hidden" name="shipper_name" id="shipper_name" class="form-control"  value="<?php echo $courier->ship_name; ?>">
	<input type="hidden" name="from_role" class="form-control" id="from_role" value="<?php echo $from_role; ?>">
	<input type="hidden" name="to_role" class="form-control" id="to_role" value="<?php echo $to_role; ?>">
	<input type="hidden" name="cons_no" id="cons_no" class="form-control" value="<?php echo $courier->cons_no ?>">


	<input type="hidden" name="shipper_pincode" id="shipper_pincode" class="form-control" value="<?php echo $courier->shipper_pincode ?>">
	<input type="hidden" name="receiver_pincode" id="receiver_pincode" class="form-control" value="<?php echo $courier->receiver_pincode ?>">
	<input type="hidden" name="r_add" id="r_add" class="form-control" value="<?php echo $courier->r_add ?>">
	<input type="hidden" name="s_add" id="s_add" class="form-control" value="<?php echo $courier->s_add ?>">
<?php  if ($currentRolename != '12')  {     ?> 



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
                            <div class="col-md-3" >
                                <div id="quantity">
									<input type="text" name="quantity" class="form-control" id="qty" onkeyup="get_que2()"  value="" placeholder="Quantity">
								</div>
								<?php echo form_error('quantity') ?>
                            </div>
							<label for="quantity" class="col-md-3"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Weight/Quantity
                                <span class="text-red"></span>
                            </label>
							<div class="col-md-3" >
                                <div>
									<input type="text" name="weight2" id="weight" class="form-control" onkeyup="get_que2()" value="" placeholder="Weight (kg)">
								</div>
								<?php echo form_error('weight') ?>
                            </div>
                        </div>





						
						
												<div class="form-group <?php if(form_error('weight')) echo 'has-error'; ?>">
                            <label for="weight" class="col-md-3">Total Weight
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <div>
									<input type="text" name="weight" readonly id="total_weight" class="form-control" o value="" placeholder="Weight (kg)">
								</div>
								<?php echo form_error('weight') ?>
                            </div>
                        </div>
						
						
							<div class="form-group <?php if(form_error('shipping_cost')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Shippment Charge
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                 <input type="text" name="shipping_cost"  class="form-control" readonly id="ship_cost" value="">
                                <?php echo form_error('shipping_cost') ?>
						<p id="ship_cost_sts"></p>
                            </div>
							<p id="qty_sts" style="color:red"></p>
                        </div>
						
						<div class="form-group">
                                <label for="firstName" class="col-md-3">Length
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="number" name="length" value="0" id="length" class="form-control" min="0" onkeyup="calc()">
                                        <div class="input-group-addon" style="padding:0px;">
                                            <input type="text" readonly  value="cm" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-md-3">Breath
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="number" name="breath" value="0" id="breath" class="form-control" min="0" onkeyup="calc()">
                                        <div class="input-group-addon" style="padding:0px;">
                                            <input type="text" readonly  value="cm" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-md-3">height
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="number" name="height" value="0" id="height" class="form-control" min="0" onkeyup="calc()">
                                        <div class="input-group-addon" style="padding:0px;">
                                            <input type="text" readonly  value="cm" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-md-3">Volume
                                    <span class="text-red">*</span>
                                </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="number" readonly value="0" name="smb_volume" id="volume" class="form-control" min="0">
                                        <div class="input-group-addon" style="padding:0px;">
                                            <input type="text" readonly  value="cm 3" style="border:none; background:lavender; text-align:center; width:35px; height:30px;">
                                        </div>
                                    </div>
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
						 
			<button type="button" name="submit2" value="add_agent2" class="btn btn-success btn-block" onclick="sendopt()" >
                        <i class="fa fa-mobile"></i> Send OTP SMS     </button> 
						
						<hr>
						<div class="form-group <?php if(form_error('referredByCode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Enter OTP 
						<span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon referralFa">
                                    <i class="fa fa-warning"></i>
                                </div>
                                <input class="form-control" name="referredByCode2" id="referredByCode2" type="text" value="<?php echo set_value('referredByCode'); ?>" placeholder=" OTP " />
                            </div>
                            <p id="referralCodeStatus"></p>
                            <?php echo form_error('referredByCode') ?>
                        </div>
						</div>
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						
						
													<input type="hidden" name="cid" class="form-control" value="<?php echo $courier->cons_no ?>">
						
<?php  }  ?>
						
						
						

						
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_courier" id="others_btn" class="btn btn-primary disabled">
                            <i class="fa fa-edit"></i> Complete Task
                        </button>
						

						<a href="<?php echo base_url('courier/edit_receiver') ?>" align="left" class="btn btn-success btn-xs"><i class="fa fa-user"></i> Edit Receiver</a>
						<a href="<?php echo base_url('courier/delete_courier') ?>" align="left" class="btn btn-danger btn-xs"><i class="fa fa-cross"></i> Delete Courier On Request</a>
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
        $('input[name="referredByCode2"]').keyup(function(){
            var iSelector = $(this);
			var cons_no = $('#cons_no').val();
            var referredByCode2 = iSelector.val();
            $('.referralFa').html('<i class="fa fa-refresh fa-spin"></i>');

            $.ajax({
                type : "POST",
                url : "<?php echo base_url('courier/uniqueSmsCodeApi2'); ?>",
               data : { referredByCode2 : referredByCode2 , cons_no : cons_no }
            })
                .done(function(msg){
                    if(msg == 'true'){
                        $('.referralFa').html('<i class="fa fa-check"></i>');
                        iSelector.closest('.input-group').removeClass('has-error');
                        iSelector.closest('.input-group').addClass('has-success');
                        $('#referralCodeStatus').html('<span style="color: #3d9970"> OTP is valid</span>');
                        $('#others_btn').removeClass('disabled');
                    }else{
                        $('.referralFa').html('<i class="fa fa-ban"></i>');
                        iSelector.closest('.input-group').removeClass('has-success');
                        iSelector.closest('.input-group').addClass('has-error');
						$('#referralCodeStatus').html('<span style="color: red"> OTP is invalid</span>');
                        $('#others_btn').addClass('disabled');
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

<script>
	function get_que2()
	{
		

		var qty = $("#qty").val();
		var weight = $("#weight").val();
		var from_role = $("#from_role").val();
		var to_role = $("#to_role").val();

		if(weight!=""){
			var mydata = {"weight":weight,    "from_role":from_role, "to_role":to_role, "qty":qty};
	   
			$.ajax({
			   type:"POST",
			   url:"<?php echo base_url('courier/get_ship_cost'); ?>",
			   data:mydata,
			   success:function(response){
				 $("#ship_cost").val(response);
			//	 alert(response)
			   }
			});
			
			$.ajax({
			   type:"POST",
			   url:"<?php echo base_url('courier/get_ship_cost_sts'); ?>",
			   data:mydata,
			   success:function(response){
				 $("#ship_cost_sts").html(response);
			//	 alert(response)
			   }
			});
						var total_weight = qty * weight;
			 $("#total_weight").val(total_weight);
		}
		
		
	}
</script>
<script>
function calc() {
    var textValue1 = document.getElementById('length').value;
    var textValue2 = document.getElementById('breath').value;
    var textValue3 = document.getElementById('height').value;
    document.getElementById('volume').value = textValue1 * textValue2* textValue3 ;
}
</script>
<script>
function sendopt()
	{
		//alert('k');
		var cons_no = $("#cons_no").val();
		var phone = $("#phone").val();
		var ship_name = $("#shipper_name").val();
		
	
		

		var mydata = {"cons_no":cons_no, "phone":phone, "ship_name":ship_name };
		$.ajax({
			type:"POST",
			data:mydata,
			url: "<?php echo base_url('courier/save_otpauth'); ?>",
			
			success:function(response){
				alert(response);
			}
		})
	}
	
	
</script>