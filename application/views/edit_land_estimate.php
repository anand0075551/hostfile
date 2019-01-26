
<?php

function page_css() { ?>

    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
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
                    <h3 class="box-title">Agriculture land Estimated</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">



                    <div class="form-group <?php if (form_error('working_days')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">All Working Days
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="working_days" class="form-control" value="<?php echo $agr_estimate->working_days; ?>" placeholder="">
                            <?php echo form_error('working_days') ?>
                        </div>
                    </div>




                    <div class="form-group <?php if (form_error('working_hours')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">All Working hours
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="working_hours" class="form-control" value="<?php echo $agr_estimate->working_hours; ?>" placeholder=" ">
                            <?php echo form_error('working_hours') ?>
                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('start_breaktm')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Start Break time
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="start_breaktm" class="form-control" value="<?php echo $agr_estimate->start_breaktm; ?>" placeholder=" ">
                            <?php echo form_error('start_breaktm') ?>
                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('end_breaktm')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">End Break time
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="end_breaktm" class="form-control" value="<?php echo $agr_estimate->end_breaktm; ?>" placeholder=" ">
                            <?php echo form_error('end_breaktm') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('work_startdt')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Start working Date
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input  class="form-control some_class"  name="work_startdt" type="text" value="<?php echo $agr_estimate->work_startdt; ?>" data-mask="" data-inputmask="'alias': 'yyyy-mm-dd'">
                            </div>
                            <?php echo form_error('work_startdt') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('work_enddt')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">End working Date
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input  class="form-control some_class"  name="work_enddt" type="text" value="<?php echo $agr_estimate->work_enddt; ?>" data-mask="" data-inputmask="'alias': 'yyyy-mm-dd'">
                            </div>
                            <?php echo form_error('work_enddt') ?>
                        </div>
                    </div>






                    <div class="form-group <?php if (form_error('total_work')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Total Work
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="total_work" class="form-control" value="<?php echo $agr_estimate->work_enddt; ?>" placeholder=" ">
                            <?php echo form_error('total_work') ?>
                        </div>
                    </div>



                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="edit_land_estimate" class="btn btn-primary">
                        <i class="fa fa-edit"></i>Submit Now
                    </button>



                </div>

                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>


<script>/*
 window.onerror = function(errorMsg) {
 $('#console').html($('#console').html()+'<br>'+errorMsg)
 }*/

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




</script>

<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "dd MM yyyy - hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: "2013-02-14 10:00",
        minuteStep: 10
    });
</script>          


<?php

function page_js() { ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<?php } ?>

