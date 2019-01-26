
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


                    <div class="form-group <?php if (form_error('usuage_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Land Usuage type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="usuage_type" id="usuage_type" class="form-control">

                                <?php
                                if ($agr_landid->usuage_type != '') {
                                    ?> <option value="<?php echo $agr_landid->usuage_type; ?>"> <?php
                                        $agr_landid->usuage_type;
                                        $table_name = 'agr_landid';
                                        $where_array = array('usuage_type' => $agr_landid->usuage_type);
                                        $query1 = $this->db->where($where_array)->get($table_name);
                                        if ($query1->num_rows() > 0) {
                                            foreach ($query1->result() as $row1) {
                                                $vehicle = $row1->usuage_type;

                                                $table_name = 'agri_use_type';
                                                $where_array = array('id' => $vehicle);
                                                $query2 = $this->db->where($where_array)->get($table_name);
                                                foreach ($query2->result() as $row2) {
                                                    $vehicle = $row2->usage_type;
                                                }
                                            }

                                            echo $vehicle;
                                        } else {
                                            echo "not exit";
                                        }
                                        ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value=""> Choose option </option>
                                <?php } ?>

                                <option value=" "> Choose option </option>

                                <?php
                                if ($usage_type->num_rows() > 0) {
                                    foreach ($usage_type->result() as $c) {
                                        echo '<option value="' . $c->id . '"> ' . $c->usage_type . '</option>';
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('vehicle_type') ?>

                        </div>
                    </div> 


                    <div class="form-group <?php if (form_error('land_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Land Type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="land_type" id="land_type" class="form-control">

                                <?php
                                if ($agr_landid->land_type != '') {
                                    ?> <option value="<?php echo $agr_landid->land_type; ?>"> <?php
                                        $agr_landid->land_type;
                                        $table_name = 'agr_landid';
                                        $where_array = array('land_type' => $agr_landid->land_type);
                                        $query1 = $this->db->where($where_array)->get($table_name);
                                        if ($query1->num_rows() > 0) {
                                            foreach ($query1->result() as $row1) {
                                                $vehicle = $row1->land_type;

                                                $table_name = 'agri_land_type';
                                                $where_array = array('id' => $vehicle);
                                                $query2 = $this->db->where($where_array)->get($table_name);
                                                foreach ($query2->result() as $row2) {
                                                    $vehicle = $row2->land_type;
                                                }
                                            }

                                            echo $vehicle;
                                        } else {
                                            echo "not exit";
                                        }
                                        ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value=""> Choose option </option>
                                <?php } ?>

                                <option value=" "> Choose option </option>

                                <?php
                                if ($land_type->num_rows() > 0) {
                                    foreach ($land_type->result() as $c) {
                                        echo '<option value="' . $c->id . '"> ' . $c->land_type . '</option>';
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
                            <select name="soil_type" id="soil_type" class="form-control" onChange="get_ticket_no()">
                                <option value=""> Choose option </option>
                                <option value="Red" <?php if ($agr_landid->soil_type == 'Red') echo 'selected'; ?>>Red</option>
                                <option value="Black" <?php if ($agr_landid->soil_type == 'Black') echo 'selected'; ?>>Black</option>
                                <option value="white" <?php if ($agr_landid->soil_type == 'white') echo 'selected'; ?>>white</option>
                            </select>	
                            <?php echo form_error('soil_type') ?>
                            <div id="output" >
                            </div>
                        </div>	
                    </div>

                    <div class="form-group <?php if (form_error('start_date')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Start date & Time</label>
                        <div class="col-md-9">

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input  class="form-control some_class"  name="start_date" type="text" value="<?php echo $agr_landid->start_date; ?>" data-mask="" data-inputmask="'alias': 'yyyy-mm-dd'">
                            </div>
                            <?php echo form_error('start_date') ?>
                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('end_date')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">End date & Time</label>
                        <div class="col-md-9">

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input  class="form-control some_class"  name="end_date" type="text" value="<?php echo $agr_landid->end_date; ?>" data-mask="" data-inputmask="'alias': 'yyyy-mm-dd'">
                            </div>
                            <?php echo form_error('end_date') ?>
                        </div>
                    </div>
                    <div class="form-group <?php if (form_error('land_verified')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Land verified

                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="land_verified" id="land_verified" class="form-control" onChange="get_ticket_no()">
                                <option value=""> Choose option </option>
                                <option value="Yes" <?php if ($agr_landid->land_verified == 'Yes') echo 'selected'; ?>>Yes</option>
                                <option value="No" <?php if ($agr_landid->land_verified == 'No') echo 'selected'; ?>>No</option>


                            </select>	
                            <?php echo form_error('land_verified') ?>
                            <div id="output" >
                            </div>
                        </div>	
                    </div>	




                    <div class="form-group <?php if (form_error('survey_no')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Survey no</label>                         
                        <div class="col-md-9">
                            <input type="text" name="survey_no" class="form-control" value="<?php echo $agr_landid->survey_no; ?>" placeholder="Enter survey_no">
                            <?php echo form_error('survey_no') ?>
                        </div>
                    </div> 
					 <div class="form-group <?php if (form_error('survey_no')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Land ID</label>                         
                        <div class="col-md-9">
                            <input type="text" name="survey_no" class="form-control" readonly  value="<?php echo $agr_landid->land_id; ?>" placeholder="Enter survey_no">
                            <?php echo form_error('survey_no') ?>
                        </div>
                    </div> 

                    <div class="form-group <?php if (form_error('fertility_level')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Fertility level
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="fertility_level" id="fertility_level" class="form-control" onChange="get_ticket_no()">
                                <option value=""> Choose option </option>
                                <option value="level1" <?php if ($agr_landid->fertility_level == 'level1') echo 'selected'; ?>>level 1</option>
                                <option value="level2" <?php if ($agr_landid->fertility_level == 'level2') echo 'selected'; ?>>level 2</option>
                            </select>	
                            <?php echo form_error('fertility_level') ?>
                            <div id="output" >
                            </div>
                        </div>	
                    </div>




                    <div class="form-group <?php if (form_error('land_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">weather Type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="weather_map" id="weather_map" class="form-control">

                                <?php
                                if ($agr_landid->weather_map != '') {
                                    ?> <option value="<?php echo $agr_landid->weather_map; ?>"> <?php
                                        $agr_landid->weather_map;
                                        $table_name = 'agr_landid';
                                        $where_array = array('weather_map' => $agr_landid->weather_map);
                                        $query1 = $this->db->where($where_array)->get($table_name);
                                        if ($query1->num_rows() > 0) {
                                            foreach ($query1->result() as $row1) {
                                                $vehicle = $row1->weather_map;

                                                $table_name = 'agri_weather';
                                                $where_array = array('id' => $vehicle);
                                                $query2 = $this->db->where($where_array)->get($table_name);
                                                foreach ($query2->result() as $row2) {
                                                    $vehicle = $row2->weather_type;
                                                }
                                            }

                                            echo $vehicle;
                                        } else {
                                            echo "not exit";
                                        }
                                        ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value=""> Choose option </option>
                                <?php } ?>

                                <option value=" "> Choose option </option>

                                <?php
                                if ($weather_type->num_rows() > 0) {
                                    foreach ($weather_type->result() as $c) {
                                        echo '<option value="' . $c->id . '"> ' . $c->weather_type . '</option>';
                                    }
                                }
                                ?>
                            </select>                             
                            <?php echo form_error('weather_type') ?>

                        </div>
                    </div>







                    <div class="form-group <?php if (form_error('bus_distance')) echo 'has-error'; ?>">
                        <label for="bus_distance" class="col-md-3">Distance from Bus stand

                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9" >
                            <div id="bus_distance">
                                <input type="text" id="bus_distance" name="bus_distance" class="form-control" value="<?php echo $agr_landid->bus_distance; ?>" placeholder="distance from Bus stand">
                            </div>
                            <?php echo form_error('bus_distance') ?>
                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('city')) echo 'has-error'; ?>">
                        <label for="city" class="col-md-3">City


                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9" >
                            <div id="city">
                                <input type="text" id="city" readonly name="city" class="form-control" value="<?php echo $agr_landid->city; ?>" placeholder="">
                            </div>
                            <?php echo form_error('city') ?>
                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('pincode')) echo 'has-error'; ?>">
                        <label for="pincode" class="col-md-3">Pincode



                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9" >
                            <div id="pincode">
                                <input type="text" id="pincode" readonly name="pincode" class="form-control" value="<?php echo $agr_landid->pincode; ?>" placeholder="">
                            </div>
                            <?php echo form_error('pincode') ?>
                        </div>
                    </div>





                    <div class="form-group <?php if (form_error('ticket_no')) echo 'has-error'; ?>">
                        <label for="ticket_no" class="col-md-3">Holdings




                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9" >
                            <div id="holdings">
                                <input type="text" id="holdings" name="holdings" class="form-control" value="<?php echo $agr_landid->holdings; ?>" placeholder="">
                            </div>
                            <?php echo form_error('holdings') ?>
                        </div>
                    </div>




                    <div class="form-group <?php if (form_error('size_gutas')) echo 'has-error'; ?>">
                        <label for="size_gutas" class="col-md-3">size in Gutas




                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9" >
                            <div id="size_gutas">
                                <input type="text" id="size_gutas" name="size_gutas" class="form-control" value="<?php echo $agr_landid->size_gutas; ?>" placeholder="">
                            </div>
                            <?php echo form_error('size_gutas') ?>
                        </div>
                    </div>






                    <div class="box-footer">
                        <button type="submit" name="submit" value="edit_agriculture_land" class="btn btn-success">
                            <i class="fa fa-edit"></i>Submit Now
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
                                        
                                        defaultDate: '+03.01.1970',
                                        defaultTime: '10:00',
                                        timepickerScrollbar: false
                                    });




    </script>

    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
                                    $('select').select2();
    </script>

<?php } ?>

