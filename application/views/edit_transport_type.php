


<?php

function page_css() { ?>
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
                    <h3 class="box-title">Vehicle Type</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				
				
				
				 <div class="form-group">
						<label for="firstName" class="col-md-3">Vehicle Brand
							<span class="text-red">*</span>
                        </label>
					   <div class="col-md-9">
						<select class="form-control" name="make_id" id="make_id" style=" width:100% auto; ">
							<option value=""></option>
							<?php 
								$get_users = $this->db->group_by('brands')->get_where('trp_vehicle_make');
								foreach($get_users->result() as $p){
									
									
									
									 echo "<option value=".$p->id.">".$p->brands."</option>";
								}
							?>
						</select>
						</div>
				</div>
					
					
					
					
					
					
					<div class="form-group">
						<label for="firstName" class="col-md-3">Vehicle Model
							<span class="text-red">*</span>
                        </label>
					   <div class="col-md-9">
						<select class="form-control" name="model_id" id="model_id" style=" width:100% auto; ">
							<option value=""></option>
							<?php 
								$get_users = $this->db->group_by('model')->get_where('trp_vehicle_model');
								foreach($get_users->result() as $p){
									
									
									
									 echo "<option value=".$p->id.">".$p->model."</option>";
								}
							?>
						</select>
						</div>
				    </div>

						<div class="form-group <?php if (form_error('version')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Version
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="version" id="version" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('version') ?>

                        </div>
			            </div>
						
						
      
			    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
				
                    <button type="submit" name="submit" value="edit_transport" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Update
                        
                    </button>
                </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->


    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php

function page_js() { ?>

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
        $(function () {
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
                    function (start, end) {
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

<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>



