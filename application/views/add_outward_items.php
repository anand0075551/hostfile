
<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
	
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
                    <h3 class="box-title"> Outward Items</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
			
                      
						
						<div class="form-group <?php if(form_error('item_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Item Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="item_name" class="form-control"  value="<?php echo set_value('item_name'); ?>" placeholder="Enter Item Name">
                                <?php echo form_error('item_name') ?>

                            </div>
                        </div>
						
						
						<div class="form-group <?php if(form_error('type_of_item')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Type of Item
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="type_of_item" class="form-control"  value="<?php echo set_value('type_of_item'); ?>" placeholder="Enter Type Of Item">
                                <?php echo form_error('type_of_item') ?>

                            </div>
                        </div>
                     
					 
						<div class="form-group <?php if(form_error('item_number')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Item Number
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="item_number" class="form-control"  value="<?php echo set_value('item_number'); ?>" placeholder="Enter Item Numer">
                                <?php echo form_error('item_number') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('invoice_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Invoice Id

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="invoice_id" class="form-control"  value="<?php echo set_value('invoice_id'); ?>" placeholder="Enter invoice Id">
                                <?php echo form_error('invoice_id') ?>

                            </div>
                        </div>
						
						
						<div class="form-group <?php if(form_error('purpose')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Purpose <span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="purpose" class="form-control" >
                                    <option value=""> Select Purpose </option>
                                    <option value ="interview"> Interview </option>
									 <option value ="buisiness proposal"> Buisiness Proposal </option>
									  <option value ="advertisement"> Advertisement </option>
									   <option value ="stock inward"> Stock Inward </option>
									    <option value ="stock outward"> Stock outward </option>

                                </select>
                                <?php echo form_error('purpose') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('item_value')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> Item Value

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="item_value" class="form-control"  value="<?php echo set_value('item_value'); ?>" placeholder="Enter Item value">
                                <?php echo form_error('item_value') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('from_place')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">From Place

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="from_place" class="form-control"  value="<?php echo set_value('from_place'); ?>" placeholder="Enter from Place">
                                <?php echo form_error('from_place') ?>

                            </div>
                        </div>
						
						
						<div class="form-group <?php if(form_error('to_whom')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">To Whom



                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="to_whom" class="form-control"  value="<?php echo set_value('to_whom'); ?>" placeholder="Enter To Whom">
                                <?php echo form_error('to_whom') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('from_sender')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">From Sender

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="from_sender" class="form-control"  value="<?php echo set_value('from_sender'); ?>" placeholder="Enter To reciver">
                                <?php echo form_error('from_sender') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('mobile_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Moile Number


                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="mobile_no" class="form-control"  value="<?php echo set_value('mobile_no'); ?>" placeholder="Enter Mobile No">
                                <?php echo form_error('mobile_no') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Remarks

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="remarks" class="form-control"  value="<?php echo set_value('remarks'); ?>" placeholder="Enter Remarks">
                                <?php echo form_error('remarks') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php // if(form_error('street_address')) echo 'has-error';   ?>">
                        <label for="firstName" class="col-md-3">Upload Outward Item Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            <?php // echo form_error('street_address') ?>
                        </div>
                    </div>
						
						
                    <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- Admin_settings/addAdmin && Settings_models/addAdmin -->
                        <button type="submit" name="submit" value="outward" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Outward Items

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
	
	 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	
<?php } ?>