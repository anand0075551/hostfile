
<?php

function page_css() { ?>


    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />

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
                    <h3 class="box-title">Machinaries</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">



                    <div class="form-group <?php if (form_error('type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Machinaries Type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="type" class="form-control" id="Shipttypeype" style="width:100% auto" >
                                <option value="">-Select Type-</option>
                                <option value="Immovable">Immovable</option>
                                <option value="Hand_Equipments">Hand Equipments</option>
                                <option value="Movble">Movble</option>
                            </select>
                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Machinaries Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="name" class="form-control" id="Shipttypeype" style="width:100% auto" >
                                <option value="">-Select Type-</option>
                                <option value="water_pump">water pump</option>
                                <option value="chopping_machine">chopping machine</option>
                                <option value="harvesting">harvesting</option>
                                <option value="Tractor">Tractor</option>
                                <option value="Tiller">Tiller</option>
                                <option value="JCB">JCB</option>
                            </select>
                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('bedin_date')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Available Start Date
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="bedin_date" class="form-control some_class"  value="<?php echo set_value('bedin_date'); ?>" placeholder="Enter start Date">
                            <?php echo form_error('bedin_date') ?>

                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('end_date')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Available End Date
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="end_date" class="form-control some_class"  value="<?php echo set_value('end_date'); ?>" placeholder="Enter End Date">
                            <?php echo form_error('end_date') ?>

                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('current_status')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Machinaries Status
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="current_status" class="form-control" id="Shipttypeype" style="width:100% auto" >
                                <option value="">-Select Type-</option>
                                <option value="Available">Available</option>
                                <option value="Not_Available">Not Available</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('hire_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Machinaries Hire Type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <select name="hire_type" class="form-control" id="Shipttypeype" style="width:100% auto" >
                                <option value="">-Select Type-</option>
                                <option value="own">own</option>
                                <option value="Rent">Rent</option>
                                <option value="Lease">Lease</option>
                                <option value="sharing">sharing</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('vehicle_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">vehicle_id/Details<span class="text-red">*</span></label>
                        <div class="col-md-9">
						
    					<input type="text" name="vehicle_id" class="form-control" value="<?php echo set_value('vehicle_id'); ?>" placeholder="Enter vehicle_id/Details.">
                            <?php echo form_error('vehicle_id') ?>
                        </div>
                    </div>


                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <!-- Admin_settings/addAdmin && Settings_models/addAdmin -->
                    <button type="submit" name="submit" value="machinaries" class="btn btn-info">
                        <i class="fa fa-plus"></i> Add
                    </button>
                    <a href="<?php echo base_url('Machinaries/machinaries_Index') ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Back</a>
                </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->



<?php

function page_js() { ?>
    <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet"/>
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
            //defaultDate:'8.12.1986', // it's my birthday
            defaultDate: '+03.01.1970', // it's my birthday
            defaultTime: '10:00',
            timepickerScrollbar: false
        });






        $('select').select2();

    </script> 


    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>


    <script>

        $('select').select2();

    </script>	

<?php } ?>
					






