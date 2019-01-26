
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
                    <h3 class="box-title">Edit Labour Type</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">


                    <div class="form-group <?php if (form_error('job_type')) echo 'has-error'; ?>">
                        <label for="job_type" class="col-md-3">Job Type 
                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9" >
                            <select name="job_type" class="form-control" style="width:100% auto" >
                                <option value="">-Select Joy Type-</option>
                                <option value="Permanent">Permanent</option>
                                <option value="Contract">Contract</option>
                                <option value="Temporary">Temporary</option>
                                <option value="Volunteer">Volunteer</option>
                            </select>
                            <?php echo form_error('job_type') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('skill_level')) echo 'has-error'; ?>">
                        <label for="skill_level" class="col-md-3">Skill Level
                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9" >
                            <select name="skill_level" class="form-control" style="width:100% auto" >
                                <option value="">-Select Skill Level-</option>
                                <option value="Skilled">Skilled</option>
                                <option value="Semi-skilled">Semi-skilled</option>
                                <option value="Un-skilled">Un-skilled</option>
                            </select>
                            <?php echo form_error('skill_level') ?>
                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('sector_type')) echo 'has-error'; ?>">
                        <label for="sector_type" class="col-md-3">Sector Type
                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9" >
                            <select name="sector_type" class="form-control" style="width:100% auto" >
                                <option value="">-Select Sector Type-</option>
                                <option value="Agriculture">Agriculture</option>
                                <option value="Education">Education</option>
                                <option value="Engineering">Engineering</option>
                                <option value="Mechanical">Mechanical</option>
                                <option value="Automobile">Automobile</option>
                            </select>
                            <?php echo form_error('sector_type') ?>
                        </div>
                    </div>





                    <div class="form-group <?php if (form_error('payment')) echo 'has-error'; ?>">
                        <label for="payment" class="col-md-3">Payment
                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9" >
                            <select name="payment" class="form-control" style="width:100% auto" >
                                <option value="">-Select Payment Status-</option>
                                <option value="Paid">Paid</option>
                                <option value="Not-paid">Not Paid</option>
                            </select>
                            <?php echo form_error('payment') ?>
                        </div>
                    </div>





                    <div class="form-group <?php if (form_error('zone')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Zone
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="text" name="zone" class="form-control" value="<?php echo $labour->zone; ?>" placeholder="Enter Zone Name.">                                
                            <?php echo form_error('zone') ?>

                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('payment_per_hour')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Payment per hour
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="number" name="payment_per_hour" class="form-control" value="<?php echo $labour->payment; ?>" placeholder="Enter Payment per hour.">                                
                            <?php echo form_error('payment_per_hour') ?>

                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('half_day_payment')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Half Day Payment
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="number" name="half_day_payment" class="form-control" value="<?php echo $labour->half_day_payment; ?>" placeholder="Enter Half Day Payment.">                                
                            <?php echo form_error('half_day_payment') ?>

                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('full_day_payment')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Full Day Payment
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="number" name="full_day_payment" class="form-control" value="<?php echo $labour->full_day_payment; ?>" placeholder="Enter Full Day Payment.">                                
                            <?php echo form_error('full_day_payment') ?>

                        </div>
                    </div>
                    <div class="form-group <?php if (form_error('overtime_payment')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Overtime Payment
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="number" name="overtime_payment" class="form-control" value="<?php echo $labour->overtime_payment; ?>" placeholder="Enter Overtime Payment.">                                
                            <?php echo form_error('overtime_payment') ?>

                        </div>
                    </div>
                    <div class="form-group <?php if (form_error('fixed_monthly_pay')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Fixed Monthly Pay
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="number" name="fixed_monthly_pay" class="form-control" value="<?php echo $labour->fixed_monthly_pay; ?>" placeholder="Enter Fixed Monthly Pay.">                                
                            <?php echo form_error('fixed_monthly_pay') ?>

                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('incentive')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Incentive
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="number" name="incentive" class="form-control" value="<?php echo $labour->incentive; ?>" placeholder="Enter Incentive.">                                
                            <?php echo form_error('incentive') ?>

                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('bonus')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Bonus
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="number" name="bonus" class="form-control" value="<?php echo $labour->bonus; ?>" placeholder="Enter bonus.">                                
                            <?php echo form_error('bonus') ?>

                        </div>
                    </div>												   
                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="edit_labour_type" class="btn btn-primary">
                        <i class="fa fa-edit"></i>Submit
                    </button>
                    <a href="<?php echo base_url('Agriculture/list_labour_type') ?>" class="btn btn-danger"><i class="fa fa-times "></i>Cancel</a>
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

