
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
                    <h3 class="box-title"><?php echo $c_user->first_name.' '. $c_user->last_name; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
			<?php if ( $c_user->role == 'agent') {?>
			<div class="form-group <?php if(form_error('company_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Company Name</label>
                            <div class="col-md-9">
                                <input type="text" name="company_name" readonly class="form-control" value="<?php echo $c_user->company_name; ?>" placeholder="Enter Company Name">
                                <?php echo form_error('company_name') ?>
                            </div>
                        </div>
			<?php }	else{ ?>
			
                        <div class="form-group <?php if(form_error('first_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">First Name</label>
                            <div class="col-md-9">
                                <input type="text" name="first_name" readonly class="form-control" value="<?php echo $c_user->first_name; ?>" placeholder="Enter First Name">
                                <?php echo form_error('first_name') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('last_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Last Name</label>
                            <div class="col-md-9">
                                <input type="text" name="last_name" readonly class="form-control" value="<?php echo $c_user->last_name; ?>" placeholder="Enter Last Name">
                                <?php echo form_error('last_name') ?>
                            </div>
                        </div>
<?php } ?>
                        <div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Email address</label>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control" readonly value="<?php echo $c_user->email; ?>" placeholder="Enter email">
                                <?php echo form_error('email') ?>

                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('contactno')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Bank A/C Registered Mobile No</label>
                            <div class="col-md-9">
                                <input type="text" name="contactno" class="form-control"  value="<?php echo $c_user->contactno; ?>" placeholder="Contact No">
                                <?php echo form_error('contactno') ?>
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('bank_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Bank Name</label>
                            <div class="col-md-9">
                                <input type="text" name="bank_name" class="form-control" value="<?php echo $c_user->bank_name; ?>" placeholder="Bank Name">
                                <?php echo form_error('bank_name') ?>
                            </div>
                        </div>
						<div class="form-group <?php if(form_error('bank_address')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Bank Branch & Complete Address as per Bank Passbook with PINCODE(Mandatory)</label>
                            <div class="col-md-9">
						<!--	<textarea type="text" name="bank_address" class="form-control" value="<?php echo $c_user->bank_address; ?>" placeholder="Bank Branch & Complete Address as per Bank Passbook with PINCODE"/></textarea>
                          -->                                   
							  <input type="text" name="bank_address" class="form-control" value="<?php echo $c_user->bank_address; ?>" placeholder="Bank Branch & Complete Address as per Bank Passbook with PINCODE"/>
                                <?php echo form_error('bank_address') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('bank_acc_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Bank Account Type</label>
                            <div class="col-md-9">
                             <!--   <input type="number" name="bank_acc_type" class="form-control" value="<?php echo $c_user->bank_acc_type; ?>" placeholder="Eg: Savings or Current">
                             -->    <select name="bank_acc_type" class="form-control">
                                    <option value=""> Select Bank Account Type</option>
                                   
									<option value="01" <?php if($c_user->bank_acc_type == '01') echo 'selected'; ?>>Savings Account</option>
									<option value="02" <?php if($c_user->bank_acc_type == '02') echo 'selected'; ?>>Current Account</option>
                                    

                                </select>
								<?php echo form_error('bank_acc_type') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('bank_account')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Bank Account No</label>
                            <div class="col-md-9">
                                <input type="password" name="bank_account" class="form-control" value="<?php echo $c_user->bank_account; ?>" placeholder="Valid Bank Account No">
                                <?php echo form_error('bank_account') ?>
                            </div>
                        </div>
						<div class="form-group <?php if(form_error('bankconf')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Re-Enter Bank Account No</label>
                            <div class="col-md-9">
                                <input type="text" name="bankconf" class="form-control" value="<?php echo $c_user->bank_account; ?>" placeholder="Repeate Bank Account No">
                                <?php echo form_error('bankconf') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('ifsc_code')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">IFS Code  (Indian Financial System Code)</label>
                            <div class="col-md-9">
                                <input type="text" name="ifsc_code" class="form-control" value="<?php echo $c_user->ifsc_code; ?>" placeholder="Valid IFSCode as per passbook">
                                <?php echo form_error('ifsc_code') ?>
                            </div>
                        </div>
						
                       <div class="form-group <?php if(form_error('pan_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">PAN Number</label>
                            <div class="col-md-9">
                                <input type="text" name="pan_no" class="form-control" value="<?php echo $c_user->pan_no; ?>" placeholder="Valid PAN number">
                                <?php echo form_error('pan_no') ?>
                            </div>
                        </div>
                                           

                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					
                        <button type="submit" name="update" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Update
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

