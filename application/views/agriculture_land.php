
<?php

function page_css() { ?>

    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
<?php } ?>

<?php include('header.php');
?>


<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Agriculture Land</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">


                    <div class="form-group <?php if (form_error('survey_no')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Survey no</label>                         
                        <div class="col-md-9">
                            <input type="text" name="survey_no" class="form-control" value="<?php echo set_value('survey_no'); ?>" placeholder="Enter survey_no">
                            <?php echo form_error('survey_no') ?>
                        </div>
                    </div> 


                    <div class="form-group <?php if (form_error('land_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Land ID & Refernce Name </label>                         
                        <div class="col-md-9">
                            <input type="input" name="land_id" class="form-control" value="<?php echo set_value('land_id'); ?>" placeholder="Enter land_id">
                            <?php echo form_error('land_id') ?>
                        </div>
                    </div> 



                    <div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Land Usuage type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="usuage_type" id="usuage_type" class="form-control" style="width:100%;" onchange "get_userid(this.value)">
                                    <option value=""> Choose option </option>
                                        <?php
                                        $users = $this->db->get_where('agri_use_type', ['id']);
                                        if ($users->num_rows() > 0) {
                                            foreach ($users->result() as $c) {

                                                echo "<option value=" . $c->id . ">" . $c->usage_type . "</option>";
                                            }
                                        }
                                        ?>
                            </select>	                                
                            <?php echo form_error('status') ?>

                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('land_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Land Type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="land_type" id="land_type" class="form-control" style="width:100%;">
                                <option value=""> Choose option </option>
                                <?php
                                $users = $this->db->get_where('agri_land_type', ['id']);
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->land_type . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('land_type') ?>

                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('soil_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Soil Type

                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="soil_type" id="soil_type" style="width:100%;" class="form-control >
                                    <option value="> Choose option </option>
                                <option value="Red ">Red</option>
                                <option value="Black">Black</option>
                                <option value="white">white</option>
                            </select>	
                            <?php echo form_error('soil_type') ?>
                            <div id="output" >
                            </div>
                        </div>	
                    </div>

                    <div class="form-group <?php if (form_error('start_date')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Available Form</label>
                        <div class="col-md-9">

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input  class="form-control some_class"  name="start_date" type="text" value="" data-mask="" data-inputmask="'alias': 'yyyy-mm-dd'">
                            </div>
                            <?php echo form_error('start_date') ?>
                        </div>
                    </div>




                    <div class="form-group <?php if (form_error('start_date')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Available To</label>
                        <div class="col-md-9">

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input  class="form-control some_class"  name="end_date" type="text" value="" data-mask="" data-inputmask="'alias': 'yyyy-mm-dd'">
                            </div>
                            <?php echo form_error('start_date') ?>
                        </div>
                    </div>





                    <div class="form-group <?php if (form_error('land_verified')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Land verified

                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="land_verified" id="land_verified" class="form-control"  style="width:100%;">
                                <option value=""> Choose option </option>
                                <option value="yes"> yes </option>
                                <option value="no">no</option>
                            </select>	
                            <?php echo form_error('land_verified') ?>
                            <div id="output" >
                            </div>
                        </div>	
                    </div>	






                    <div class="form-group <?php if (form_error('fertility_level')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Fertility level
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="fertility_level" id="fertility_level" class="form-control" style="width:100%;">
                                <option value=""> Choose option </option>
                                <option value="level 1"> level 1 </option>
                                <option value="level 2">level 2</option>
                            </select>	
                            <?php echo form_error('fertility_level') ?>
                            <div id="output" >
                            </div>
                        </div>	
                    </div>




                    <div class="form-group <?php if (form_error('weather_map')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Weather
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="weather_map" id="weather_map" class="form-control" style="width:100%;">
                                <option value=""> Choose option </option>
                                <?php
                                $users = $this->db->get_where('agri_weather', ['id']);
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->weather_type . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('land_type') ?>

                        </div>
                    </div>






                    <div class="form-group <?php if (form_error('country_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Country
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <select name="country" class="form-control" onchange="get_state(this.value)" style="width:100% auto">
                                <option value=""> Choose option </option>
                                <?php
                                if ($country_name->num_rows() > 0) {
                                    foreach ($country_name->result() as $c) {

                                        echo "<option value=" . $c->country . ">" . $c->country . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('country_name') ?>

                        </div>
                    </div>





                    <div class="form-group <?php if (form_error('state')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">State <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="state" id="state" class="form-control" onchange="get_district(this.value)" style="width:100% auto">
                                <option value=""> Select State </option>

                            </select>
                            <?php echo form_error('state') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('district')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">District <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="district" id="district" class="form-control" onchange="get_taluk(this.value)" style="width:100% auto">
                                <option value=""> Select District </option>

                            </select>
                            <?php echo form_error('district') ?>
                        </div>
                    </div>




                    <div class="form-group <?php if (form_error('taluk')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Taluk <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="taluk" id="taluk" class="form-control" onchange="get_location_id(this.value)" style="width:100% auto">
                                <option value=""> Select Taluk </option>

                            </select>
                            <?php echo form_error('taluk') ?>
                        </div>
                    </div>





                    <div class="form-group <?php if (form_error('location_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Location<span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="city" id="location_id" class="form-control" onchange="get_pincode(this.value)" style="width:100% auto">
                                <option value=""> Select location </option>

                            </select>
                            <?php echo form_error('location_id') ?>
                        </div>
                    </div>




                    <div class="form-group <?php if (form_error('pincode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Pincode <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="pincode" id="pincode" class="form-control" style="width:100% auto">
                                <option value=""> Select Pincode </option>

                            </select>
                            <?php echo form_error('pincode') ?>
                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('bus_distance')) echo 'has-error'; ?>">
                        <label for="bus_distance" class="col-md-3">Distance from Bus stand

                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9" >
                            <div id="bus_distance">
                                <input type="number" id="bus_distance" name="bus_distance" class="form-control" value="<?php echo set_value('bus_distance'); ?>" placeholder="km">
                            </div>
                            <?php echo form_error('bus_distance') ?>
                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('holdings')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Holdings
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="holdings" id="holdings" class="form-control" style="width:100%;">
                                <option value=""> Choose option </option>
                                <?php
                                $users = $this->db->get_where('agri_holdings', ['id']);
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->holdings . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('holdings') ?>

                        </div>
                    </div>






                    <div class="form-group <?php if (form_error('size_gutas')) echo 'has-error'; ?>">
                        <label for="size_gutas" class="col-md-3">size in Gutas




                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9" >
                            <div id="size_gutas">
                                <input type="text"  name="size_gutas" class="form-control" value="<?php echo set_value('size_gutas'); ?>" placeholder="">
                            </div>
                            <?php echo form_error('size_gutas') ?>
                        </div>
                    </div>






                    <div class="box-footer">
                        <button type="submit" name="submit" value="agriculture_land" class="btn btn-success">
                            <i class="fa fa-edit"></i>add
                        </button>
                        <a href="<?php echo base_url('Agriculture/all_agriculture_land') ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Back</a>



                    </div>
                    </form>
                </div><!-- /.box -->



            </div><!--/.col (left) -->
            <!-- right column -->

        </div>   <!-- /.row -->
</section><!-- /.content -->

<?php

function page_js() { ?>
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
        /*******************get taluk***************************************************/
        function get_taluk(id)
        {
            //   alert(id);
            var mydata = {"district": id};

            $.ajax({
                type: "POST",
                url: "get_taluk",
                data: mydata,
                success: function (response) {
                    $("#taluk").html(response);
                    // alert(response);
                }
            });
        }
        /**************************************************************************************/
        function get_location_id(id)
        {  //   alert(id);
            var mydata = {"taluk": id};

            $.ajax({
                type: "POST",
                url: "get_location_id",
                data: mydata,
                success: function (response) {
                    $("#location_id").html(response);
                    //alert(response);
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
        }


    </script>
    <!-- InputMask -->
    <script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>


    <script>
    

        $.datetimepicker.setLocale('en');

        $('#datetimepicker_format').datetimepicker({value: '2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
        console.log($('#datetimepicker_format').datetimepicker('getValue'));

        $("#datetimepicker_format_change").on("click", function (e) {
            $("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
        });
        $("#datetimepicker_format_locale").on("change", function (e) {
            $.datetimepicker.setLocale($(e.currentTarget).val());
        });

        $('#datetimepicker').datetimepicker({
            dayOfWeekStart: 1,
            lang: 'en',
            disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
            startDate: '1986/01/05'
        });
        $('#datetimepicker').datetimepicker({value: '2015/04/15 05:03', step: 10});


        var startdate = $("#txtstartdate").val();
        $('.some_class').datetimepicker({minDate: startdate});

        $('#default_datetimepicker').datetimepicker({
            formatTime: 'H:i',
            formatDate: 'd.m.Y',
            defaultDate: '+03.01.1970', // it's my birthday
            defaultTime: '10:00',
            timepickerScrollbar: false
        });

    </script>

    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();

    </script>
<?php } ?>


