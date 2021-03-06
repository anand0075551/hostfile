<?php
$profileInfo = get_profile_by_id($profile_id);
?>
<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>

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
                    <h3 class="box-title"><?php echo 'Consumer Name :'.$profileInfo->first_name.' '. $profileInfo->last_name; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                        <div class="form-group <?php if(form_error('first_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">First Name</label>
                            <div class="col-md-9">
                                <input type="text" name="first_name"  class="form-control" value="<?php echo $profileInfo->first_name; ?>" placeholder="Enter First Name">
                                <?php echo form_error('first_name') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('last_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Last Name</label>
                            <div class="col-md-9">
                                <input type="text" name="last_name"  class="form-control" value="<?php echo $profileInfo->last_name; ?>" placeholder="Enter Last Name">
                                <?php echo form_error('last_name') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('company_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Firm Name</label>
                            <div class="col-md-9">
                                <input type="text" name="company_name"  class="form-control" value="<?php echo $profileInfo->company_name; ?>" placeholder="Enter Firm Name">
                                <?php echo form_error('company_name') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('licence')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Licence No</label>
                            <div class="col-md-9">
                                <input type="text" name="licence"  class="form-control" value="<?php echo $profileInfo->licence; ?>" placeholder="Enter licence No">
                                <?php echo form_error('licence') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Email address</label>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control"  value="<?php echo $profileInfo->email; ?>" placeholder="Enter email">
                                <?php echo form_error('email') ?>

                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('contactno')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Contact No</label>
                            <div class="col-md-9">
                                <input type="text" name="contactno" class="form-control" value="<?php echo $profileInfo->contactno; ?>" placeholder="Contact No">
                                <?php echo form_error('contactno') ?>

                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('gender')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Gender</label>
                            <div class="col-md-9">
                                <select name="gender" class="form-control">
                                    <option value=""> Select Gender </option>
                                    <option value="male" <?php if($profileInfo->gender == 'male') echo 'selected'; ?>>Male</option>
                                    <option value="female" <?php if($profileInfo->gender == 'female') echo 'selected'; ?>>Fe-Male</option>

                                </select>
                                <?php echo form_error('gender') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('date_of_birth')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Date of birth</label>
                            <div class="col-md-9">

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control"  name="date_of_birth" type="text" value="<?php echo $profileInfo->date_of_birth; ?>" data-mask="" data-inputmask="'alias': 'yyyy-mm-dd'">
                                </div>
                                <?php echo form_error('date_of_birth') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('profession')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Profession</label>
                            <div class="col-md-9">
                                <input type="text" name="profession" class="form-control" value="<?php echo $profileInfo->profession; ?>" placeholder="Profession">
                                <?php echo form_error('profession') ?>
                            </div>
                        </div>
				
                        <div class="form-group <?php if(form_error('street_address')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Street Address</label>
                            <div class="col-md-9">
                                <input type="text" name="street_address" value="<?php echo $profileInfo->street_address; ?>" class="form-control" placeholder="Street Address">
                                <?php echo form_error('street_address') ?>
                            </div>
                        </div>						

                        <div class="form-group <?php if(form_error('city')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">City/Village Name</label>
                            <div class="col-md-9">
                                <input type="text" name="city" value="<?php echo $profileInfo->city; ?>" class="form-control" placeholder="City/Village Name">
                                <?php echo form_error('city') ?>
                            </div>
                        </div>

                        <div class="form-group <?php // if(form_error('street_address')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Photo
                                <span class="text-aqua">(Max size 2MB &amp; Width 1024px, Height 768px )</span>
                            </label>
                            <div class="col-md-9">
                                <input type="file" name="userfile" class="form-control" size="20" />
                                <?php // echo form_error('street_address') ?>
                            </div>
                        </div>


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!--  PATH:   USER/ public function Profile_edit and User_model->Profile_update -->
                        <button type="submit" name="update" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update Profile Details
                        </button>
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
    </script>

<?php } ?>

