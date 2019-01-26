
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
                <h4>Note: Check A List of User-Roles Already Created In The System.(Un-Necessary New Roles Creation is not Suggestable)</h4>
            </div>

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">Add New Permission Group</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

					
                        <div class="form-group <?php if(form_error('permission_id ')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Permission Group
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="permission_id " class="form-control" value="<?php echo set_value('rolename'); ?>" placeholder="Select Permission Group">
                                <?php echo form_error('permission_id ') ?>
								<div class="col-md-9">
                            <select name="permission_id" class="form-control">
                                <option value=""> Select Permission Type </option>
								<option value="customer" 	<?php echo set_select('profession', 'customer')    ?>>Customer</option>
								<option value="agent" 	 	<?php echo set_select('profession', 'agent') 	   ?>>Agent</option>                                
                                <option value="retailor" 	<?php echo set_select('profession', 'retailor')    ?>>Retailor</option>
                                <option value="distributor" <?php echo set_select('profession', 'distributor') ?>>Distributor</option>
								<option value="outlets" 	<?php echo set_select('profession', 'pos_outlets') ?>>POS(Outlets)</option>
								<option value="stockpoints" <?php echo set_select('profession', 'stockpoints') ?>>Stock Points</option>
								<option value="warehouse" 	<?php echo set_select('profession', 'warehouse')   ?>>Warehousing</option>	
								<option value="processing_units" <?php echo set_select('profession', 'processing_units') ?>>Processing Units</option>
								<option value="supplier" 		 <?php echo set_select('profession', 'supplier') ?>>Supplier</option>
                                							
                            </select>
                            <?php echo form_error('profession') ?>
                        </div>
                            </div>
                        </div>               
                        <div class="form-group <?php if(form_error('view')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Menu Sections
                                <span class="text-red">*</span>
                            </label>


                            <div class="col-md-9">
                                
								<input type="checkbox" name="rolename[]" value="Dash" id="rolename_0" />Dashboard <br>
								<input type="checkbox" name="rolename[]" value="us" id="rolename_1" />Business Category <br>
								<input type="checkbox" name="rolename[]" value="Resseler" id="rolename_2" />Company Ledger Accounts <br>
								<input type="checkbox" name="rolename[]" value="Warehouse" id="rolename_3" />Vouchers  <br>
								<input type="checkbox" name="rolename[]" value="Outlet" id="rolename_4" />Detailed Reports <br>
								<input type="checkbox" name="rolename[]" value="Agent" id="rolename_5" />Products <br>
								<input type="checkbox" name="rolename[]" value="Customer" id="rolename_6" />Bank Details <br>
								<input type="checkbox" name="rolename[]" value="Accountant" id="rolename_7" />Account/MyWallet <br>
								<input type="checkbox" name="rolename[]" value="Agent" id="rolename_8" /> Ceation of Channel Partners(Agents) <br>
								<input type="checkbox" name="rolename[]" value="Agent" id="rolename_8" /> Ceation of Customers(User) <br>
                                <?php echo form_error('view') ?>
                            </div>
                        </div>             



                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="add_roles" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Approve
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

