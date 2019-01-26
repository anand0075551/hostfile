
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
            <div class="callout callout-info">
                <h4>Note: Check A List of User-Roles Already Created In The System.(Un-Necessary New Roles Creation is not Suggestable...!!!)</h4>
            </div>

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">Add Activity/Role Type</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

					     <div class="form-group <?php if(form_error('type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Activity Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="type" class="form-control">
                                <option value=""> Select Activity Type </option>
                                                          
								<option value="loan_type" 	 <?php echo set_select('type', 'Loan Type') 	?>>	Loan Type	</option>								
								<option value="account_type" <?php echo set_select('type', 'Account Type')  ?>>	Account Type </option>
								<option value="voucher_type" <?php echo set_select('type', 'Voucher Type') 	?>>	Voucher Type	</option>
								<option value="role_name" 	 <?php echo set_select('type', 'Role Name') 	?>>	Role/User Type	</option>   
								<option value="withdraw" 	 <?php echo set_select('type', 'withdraw') 		?>>	Withdraw	</option>   				
								<option value="reimbursement" 	 <?php echo set_select('type', 'reimbursement') 	?>>	Reimbursement	</option>   												
                            </select>
                                <?php echo form_error('type') ?>
                            </div>
                        </div> 
						
                        <div class="form-group <?php if(form_error('rolename')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Activity Type Description
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="rolename" class="form-control" value="<?php echo set_value('rolename'); ?>" placeholder="Enter Description Name In Brief">
                                <?php echo form_error('rolename') ?>
                            </div>
                        </div>  
                        <div class="form-group <?php if(form_error('fees')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Registration Fees/Fixed Budget
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="fees" class="form-control" value="<?php echo set_value('fees'); ?>" placeholder="Enter Budget Amount">
                                <?php echo form_error('fees') ?>
                            </div>
                        </div>		
                        <div class="form-group <?php if(form_error('dedfees_payspec')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Registration Fees Depositing: Payspec ID
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="dedfees_payspec" class="form-control" value="<?php echo set_value('dedfees_payspec'); ?>" placeholder="Fees Deduction Pay Spec ID">
                                <?php echo form_error('dedfees_payspec') ?>
                            </div>
                        </div>	
						<div class="form-group <?php if(form_error('comfees_payspec')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Sponsorship offer to Referrer: Payspec ID
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="comfees_payspec" class="form-control" value="<?php echo set_value('comfees_payspec'); ?>" placeholder="Commission Pay Spec ID">
                                <?php echo form_error('comfees_payspec') ?>
                            </div>
                        </div>	
                        <div class="form-group <?php if(form_error('com_per')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Sponsorship offer in % to Referrer: Value
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="com_per" class="form-control" value="<?php echo set_value('com_per'); ?>" placeholder="Commission in %">
                                <?php echo form_error('com_per') ?>
                            </div>
                        </div>							
						<div class="form-group < ?php if(form_error('active')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Type Status(Check '✓' to Activate)
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="checkbox" name="active" class="form-control" value='1' placeholder="Select Edit Permission">
                                <?php echo form_error('active') ?>
                            </div>
                        </div>  						
                                
                       
				   		<div class="form-group <?php if(form_error('permission_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Public Role..? 
                                <span class="text-red">*</span>
                            </label>
							
                            <div class="col-md-9">
                               
								 <input type="checkbox" name="permission_id" class="form-control" value='1' placeholder="Select Edit Permission">
                                <?php echo form_error('permission_id ') ?>
                            </div>
                        </div> 						
                    <!--      <div class="form-group <?php if(form_error('edit')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Edit Permission
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="checkbox" name="edit" class="form-control" value='1' placeholder="Select Edit Permission">
                                <?php echo form_error('edit') ?>
                            </div>
                        </div>   -->


                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- PATH: Roles/add_roles and Roles_model->add_roles-->
                        <button type="submit" name="submit" value="add_roles" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Create Types
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

