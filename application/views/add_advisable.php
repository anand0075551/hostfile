
<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/css/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css">


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
                    <h3 class="box-title">Add Agricultural Input Materials</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

                    <div class="form-group <?php if (form_error('soil_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Type Of Soil
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="soil_type" id="soil_type" class="form-control" >
                                <option value=""> Choose option </option>
                                <option value="Red"> Red </option>
                                <option value="black"> Black </option>


                            </select>	                                
                            <?php echo form_error('soil_type') ?>

                        </div>
                    </div> 


                    <div class="form-group <?php if (form_error('soil_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Weather Table Id
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="weather_tableid" id="weather_tableid" class="form-control" >
                                <option value=""> Choose option </option>
                                <option value="1"> 1 </option>
                                <option value="2"> 2</option>
                                <option value="2"> 3</option>
                                <option value="2"> 4</option>
                                <option value="2"> 5</option>
                                <option value="2"> 6</option>
                                <option value="2"> 7</option>


                            </select>	                                
                            <?php echo form_error('soil_type') ?>

                        </div>
                    </div> 




                    <div class="form-group <?php if (form_error('crop')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">crop
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="text" name="crop" class="form-control" value="<?php echo set_value('crop'); ?>" placeholder="Enter Crop Name.">                                
                            <?php echo form_error('crop') ?>

                        </div>
                    </div>






                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="add_advisable" class="btn btn-primary">
                        <i class="fa fa-edit"></i>Submit
                    </button>
                </div>
                </form>
            </div><!-- /.box -->

        </div><!--col md 12-->

    </div><!--Row -->
    <!-- right column -->


</section><!-- /.content -->

<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>

<!--for multiplication-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
<script>
    $('select').select2();
</script>

