
<?php

function page_css() { ?>
    <!-- datatable css -->

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
                    <h3 class="box-title">Copy Vehicle</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">


					
					 <div class="form-group <?php if(form_error('type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Vehicle Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
							<select name="type" class="form-control" id="type" style="width:100% auto" >
                                <option value="">--Select--</option>
                                <option value="Immovable" <?php if ($machinaries->type == 'Immovable') echo 'selected'; ?>>Immovable</option>
                                <option value="Hand_Equipments" <?php if ($machinaries->type == 'Hand_Equipments') echo 'selected'; ?>>Hand Equipments</option>
                                <option value="Movble" <?php if ($machinaries->type == 'Movble') echo 'selected'; ?>>Movble</option>
                               

                            </select>
							</div>
					</div>
					
					
					 <div class="form-group <?php if(form_error('name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Machinaries Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
							<select name="name" class="form-control" id="type" style="width:100% auto" >
                                <option value="">--Select--</option>
                                <option value="water_pump" <?php if ($machinaries->name == 'water_pump') echo 'selected'; ?>>water pump</option>
                                <option value="chopping_machine" <?php if ($machinaries->name == 'chopping_machine') echo 'selected'; ?>>chopping machine</option>
                                <option value="harvesting" <?php if ($machinaries->name == 'harvesting') echo 'selected'; ?>>Harvesting</option>
                                <option value="Tractor" <?php if ($machinaries->name == 'Tractor') echo 'selected'; ?>>Tractor</option>
                                <option value="Tiller" <?php if ($machinaries->name == 'Tiller') echo 'selected'; ?>>Tiller</option>
                                <option value="jcb" <?php if ($machinaries->name == 'jcb') echo 'selected'; ?>>jcb</option>
                               

                            </select>
							</div>
					</div>
					


                    <div class="form-group <?php if (form_error('bedin_date')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Start Date
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="bedin_date" class="form-control some_class"  value="<?php echo $machinaries->bedin_date; ?>" placeholder="Enter Bedin Date">
                            <?php echo form_error('bedin_date') ?>

                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('end_date')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">End Date
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="end_date" class="form-control some_class"  value="<?php echo $machinaries->end_date; ?>" placeholder="">
                            <?php echo form_error('end_date') ?>

                        </div>
                    </div>


					
					 <div class="form-group <?php if(form_error('current_status')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Vehicle Status 
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
							<select name="current_status" class="form-control" id="current_status" style="width:100% auto" >
                                <option value="">--Select--</option>
                                <option value="Available" <?php if ($machinaries->current_status == 'Available') echo 'selected'; ?>>Available</option>
                                <option value="Not_Available" <?php if ($machinaries->current_status == 'Not_Available') echo 'selected'; ?>>Not Available</option>
                               

                            </select>
							</div>
					</div>
					


					 <div class="form-group <?php if(form_error('hire_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Vehicle Hire Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
							<select name="hire_type" class="form-control" id="hire_type" style="width:100% auto" >
                                <option value="">--Select--</option>
                                <option value="own" <?php if ($machinaries->hire_type == 'own') echo 'selected'; ?>>Own</option>
                                <option value="lease" <?php if ($machinaries->hire_type == 'lease') echo 'selected'; ?>>lease</option>
                                <option value="rant" <?php if ($machinaries->hire_type == 'rant') echo 'selected'; ?>>Rant</option>
                                <option value="sharing" <?php if ($machinaries->hire_type == 'sharing') echo 'selected'; ?>>sharing</option>
                               

                            </select>
							</div>
					</div>



					<div class="form-group <?php if (form_error('vehicle_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Vehicle Id
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="vehicle_id"  value="<?php echo $machinaries->vehicle_id; ?>" placeholder="" class="form-control">
                            <?php echo form_error('vehicle_id') ?>

                        </div>
                    </div>	



              


                </div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="copy_machinaries" class="btn btn-primary">
                    <i class="fa fa-plus"></i>Add
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

