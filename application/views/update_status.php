<?php

function page_css() { ?>
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
foreach ($cid->result() as $sts)
    ;
$pin = $sts->current_pincode;
$get_pin = $this->db->get_where('pincode', ['id' => $pin]);
foreach ($get_pin->result() as $p)
    ;
$new_pin = $p->pincode;
$address = $sts->current_location;
list($location, $district, $state) = explode(",", $address);
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box-body">

                <table class="table table-bordered">
                    <div class="col-md-12">


                    </div>
                </table>                  
            </div><!-- /.box-body -->

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Update Current Status- New Location </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">




                    <div class="row">
                        <div class="col-lg-12">
                            <font size="3"> <b> Previous Shipment Location :</b>  </font>
                        </div>
                    </div>
                    <br>

                    <div class="form-group <?php if (form_error('state')) echo 'has-error'; ?>">
                        <label for="exampleInputEmail1" class="col-md-3">State
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="state" class="form-control" readonly  placeholder="State" value=" <?php echo $state; ?>" >
                            <?php echo form_error('state') ?>

                        </div>
                    </div>
                    <div class="form-group <?php if (form_error('district')) echo 'has-error'; ?>">
                        <label for="exampleInputEmail1" class="col-md-3">District
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="district" class="form-control" readonly placeholder="District" value=" <?php echo $district; ?>" >
                            <?php echo form_error('district') ?>

                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('location')) echo 'has-error'; ?>">
                        <label for="exampleInputEmail1" class="col-md-3">Location
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="location" class="form-control" readonly placeholder="Location" value=" <?php echo $location; ?>" >
                            <?php echo form_error('location') ?>

                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('pincode')) echo 'has-error'; ?>">
                        <label for="exampleInputEmail1" class="col-md-3">Pincode
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" readonly  value=" <?php echo $new_pin; ?>" >
                            <?php echo form_error('pincode') ?>

                        </div>
                    </div>





                    <hr>




                    <div class="row">
                        <div class="col-lg-12">
                            <font size="3"><b>  Update To New Location : </b> </font>
                        </div>
                    </div>
                    <br>

                    <div class="form-group <?php if (form_error('country')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Country <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="country" class="form-control" onchange="get_state(this.value)">
                                <option value=""> Select Country </option>
                                <?php
                                if ($country->num_rows() > 0) {
                                    foreach ($country->result() as $c) {
                                        //$selected = ($c->id == 105)? 'selected' : '';
                                        echo '<option value="' . $c->country . '"> ' . $c->country . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('country') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('state')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">State <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="state" id="state" class="form-control" onchange="get_district(this.value)">
                                <option value=""> Select State </option>

                            </select>
                            <?php echo form_error('state') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('district')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">District <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="district" id="district" class="form-control" onchange="get_location_id(this.value)">
                                <option value=""> Select District </option>

                            </select>
                            <?php echo form_error('district') ?>
                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('location_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Select Location<span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="location" id="location_id" class="form-control" onchange="get_pincode(this.value)">
                                <option value=""> Select location </option>

                            </select>
                            <?php echo form_error('location_id') ?>
                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('pincode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Pincode <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="pincode" id="pincode" class="form-control">
                                <option value=""> Select Pincode </option>

                            </select>
                            <?php echo form_error('pincode') ?>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <font size="3"><b>  Change Status: </b> </font>
                        </div>
                    </div>
                    <br>

                    <?php
                    $user_info = $this->session->userdata('logged_user');
                    $user_id = $user_info['user_id'];
                    $currentUser = singleDbTableRow($user_id)->role;
                    $rolename = singleDbTableRow($user_id)->rolename;
                    if ($rolename != 26) {
                        ?>


  							 <div class="form-group <?php if(form_error('new_status')) echo 'has-error'; ?>">
                            <label for="first_name" class="col-md-3">New Status
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" >
									<select class="form-control" name="new_status" id="new_status" style=" width:100% auto; ">
							<option value="<?php echo $sts->status; ?>"> <?php 
							
					
							$query = $this->db->get_where('status', ['id' => $sts->status,]);
				if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
			echo	$status = $row->status;
				}
				} else {
			echo	$status =  "No Data";
				}
							?> </option>
							<?php 
									$query1 = $this->db->get_where('status', ['business_name' => '5']);
										foreach ($query1->result() as $row) 
										{
									echo "<option value='".$row->id."'>".$row->status."</option>";
										}
								
							?>
						</select>
                        </div>
                        </div>
                    <?php } else { ?>
                        <div class="form-group <?php if (form_error('new_status')) echo 'has-error'; ?>">
                            <label for="new_status" class="col-md-3">New Status
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <select name="new_status" class="form-control" id="new_status" >
                                    <option value="<?php echo $sts->status; ?>"> <?php echo $sts->status; ?> </option>

                                    <option value="13">Transefer To Delivery Executive </option>
                                </select>
                                <?php echo form_error('new_status') ?>
                            </div>
                        </div>	<?php } ?>

                    <div class="form-group <?php if (form_error('comment')) echo 'has-error'; ?>">
                        <label for="exampleInputEmail1" class="col-md-3">Remarks
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="comment" class="form-control"  value="" placeholder="Enter remarks">
                            <?php echo form_error('comment') ?>

                        </div>
                    </div>

                    <input type="hidden" name="receiver_pincode" class="form-control" value="<?php echo $sts->receiver_pincode ?>">
                    <input type="hidden" name="cid" class="form-control" value="<?php echo $sts->cons_no ?>">
                    <input type="hidden" name="r_add" class="form-control" value="<?php echo $sts->receiver_location ?>">


                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <!-- PATH: Product/public function verify_payee and product_model->otp_transactions();-->
                    <button type="submit" name="submit" value="update_status" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Update New Status
                    </button>
                </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php

function page_js() { ?>

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
                                    $(function () {
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
                                            function (start, end) {
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


    <!-- For Convertion Ratio Flip Vi    ew -->
                                    $(document).ready(function () {
                                    $("#flip").click(function () {
                                    $("#panel").slideToggle("slow");
                                    });
                                    });
                                    $(document).ready(function () {
                                    $("#hide").click(function () {
                                    $("#div1").hide();
                                    // alert("The paragraph is now hidden");
                                    });
                                    $("#show").click(function () {
                                    $("#div1").show();
                                    // alert("The paragraph is now     Showi    ng");
                                    });
                                    });
                                    $(document).ready(function () {
                                    $("#hide").click(function () {
                                    $("#div2").hide();
                                    // alert("The paragraph is now hidden");
                                    });
                                    $("#show").click(function () {
                                    $("#div2").show();
                                    // alert("The paragraph    is     now Showing");
                                    });
                                    });
                                    $(document).ready(function () {
                                    $("button").click(function () {
                                    $("#div1").fadeIn();
                                    $("#div2").fadeIn("slow");
                                    $("#div3").fade    In(3000);
                                    });
                                    });
        </script>

        <style>
                #panel,    #flip {
                    padding: 5px;
             text-align: center;
             background    -color: #e5eecc;
                    border: solid 1px #c3c3c3;
                }

                #panel {
                    padding: 50px;
                    display: none;
                }
            </style>
            <script>
                $(function () {
                $('input[name="referredByCode"]').keyup(function () {
                var iSelector = $(this);
                var referredByCode = iSelector.val();
                $('.referralFa').html('<i class="fa fa-refresh fa-spin"></i>');
                $.ajax({
                type: "POST",
                        url: "<?php echo base_url('welcome/uniqueReferralCodeApi'); ?>",
                        data: {referredByCode: referredByCode}
                })
                        .done(function (msg) {
                        if (msg == 'true') {
                        $('.referralFa').html('<i class="fa fa-check"></i>');
                        iSelector.closest('.input-group').removeClass('has-error');
                        iSelector.closest('.input-group').addClass('has-success');
                        $('#referralCodeStatus').html('<span style="color: #3d9970">Referral code is valid</span>');
                        } else {
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

           <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
            <script>
            $('select').select2();
        </script>

<?php } ?>

    <script>
            function get_location(shipper_pin)
            {
            //alert (shipper_pin);

            var mydata = {"shipper_pin": shipper_pin};
            $.ajax({
            type: "POST",
                    url: "<?php echo base_url('courier/get_location'); ?>",
                    data: mydata,
                    success: function (response) {
                    //   alert(response);
                    $("#address").html(response);
                    }
            });
            }
</script>
<script>
                    function get_state(id)
                    {
                    //   alert(id);
                    var mydata = {"country": id}
                    ;
                    $.ajax({
                    type: "POST",
                            url:"<?php echo base_url('courier/getstate'); ?>",
                            //  url: "getstate",
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
                    url: "<?php echo base_url('courier/get_district'); ?>",
                    //  url: "get_district",
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
                    url: "<?php echo base_url('courier/get_location_id'); ?>",
                    //  url: "get_location_id",
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
                    url: "<?php echo base_url('courier/get_pincode'); ?>",
                    //   url: "get_pincode",
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
                    if (result == 0)
                    {
                    document.getElementById("addbtn").disabled = true;
                    } else if (result == 1)
                    {
                    document.getElementById("addbtn").disabled = false;
                    }

                    }
            });
            }







</script>