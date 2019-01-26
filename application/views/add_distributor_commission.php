
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
                    <h3 class="box-title">Distribute Commissions</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
					
                    		<div class="form-group <?php if (form_error('business_group')) echo 'has-error'; ?>">
								<label for="business_groups" class="col-md-3">Business Group
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="business_group" id="business_group" class="form-control" onchange="get_area(this.value)">
										<option value=""> Choose option </option>
										<?php
										if ($business_groups->num_rows() > 0) {
											foreach ($business_groups->result() as $bg) {

											   echo '<option value="'.$bg->id.'"> '.$bg->id.'-'.$bg->business_name.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('business_group') ?>

								</div>
							</div>
                            <div class="form-group <?php if (form_error('acc_cat')) echo 'has-error'; ?>">
								<label for="acc_cat" class="col-md-3">Account Type
									
								</label>
								<div class="col-md-9">  								

									<select name="acc_cat" id="acc_cat" class="form-control" onChange="get_pay_type(this.value)" >
										<option value=""> Choose option </option>
										<?php
										if ($acct_categories->num_rows() > 0) {
											foreach ($acct_categories->result() as $pt) {

											   echo '<option value="'.$pt->id.'"> '.$pt->id.'-'.$pt->name.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('acc_cat') ?>

								</div>
							</div>
                            <div class="form-group <?php if (form_error('pay_type')) echo 'has-error'; ?>">
								<label for="pay_type" class="col-md-3">Pay Type
									
								</label>
								<div class="col-md-9">  								

									<select name="pay_type" id="pay_type" class="form-control" >
										<option value=""> Choose Account Type First </option>
										
									</select>	                                
									<?php echo form_error('pay_type') ?>

								</div>
							</div>
							<div class="form-group <?php if (form_error('from_role')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">From Role
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="from_role" id="from_role" class="form-control" onchange="get_user(this.value)">
										<option value=""> Choose option </option>
										<?php
										if ($rolename->num_rows() > 0) {
											foreach ($rolename->result() as $c) {

											   echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->rolename.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('from_role') ?>

								</div>
							</div>

								
							<div class="form-group <?php if (form_error('to_role')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">To Role
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="to_role"  class="form-control" onchange="get_user(this.value)">
										<option value=""> Choose option </option>
										<?php
										if ($rolename->num_rows() > 0) {
											foreach ($rolename->result() as $c) {

											   echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->rolename.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('to_role') ?>

								</div>
							</div>

							
							 <div class="form-group <?php if (form_error('to_user')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">To User
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="to_user" id="to_user" class="form-control">
										<option value=""> Choose option </option>
										
									</select>	                                
									<?php echo form_error('to_user') ?>

								</div>
							</div>
							<div class="form-group <?php if (form_error('area')) echo 'has-error'; ?>">
								<label for="area" class="col-md-3">Area
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="area" id="area" class="form-control" onChange="check_exist()">
										<option value=""> Choose option </option>
										
									</select>	                                
									<?php echo form_error('area') ?>

								</div>
							</div>
						
						<div class="form-group <?php if(form_error('percentage')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Commission Precentage
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="percentage" id="percentage" class="form-control"  value="<?php echo set_value('percentage'); ?>" placeholder="Enter percentage" onChange="check_value(this.value)">
                                <?php echo form_error('percentage') ?>
                            </div>
                        </div>
						
                    <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- Admin_settings/addAdmin && Settings_models/addAdmin -->
                        <button type="submit" name="submit" value="commission" class="btn btn-primary" >
                            <i class="fa fa-edit"></i> Add Distributor Commission
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
	<script>
	function get_pay_type(acc_cat)
{
	//alert(id);
	var mydata = {"acc_cat": acc_cat};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('distributor_commission/get_pay_type') ?>",
		data: mydata,
		success: function (response) {
			$("#pay_type").html(response);
			//alert(response);
		}
	});   
}

</script>
<script>
	function get_user(id)
{
	//alert(id);
	var mydata = {"to_role": id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('distributor_commission/get_user') ?>",
		data: mydata,
		success: function (response) {
			$("#to_user").html(response);
			//alert(response);
		}
	});   
}

</script>
<script>
	function get_area(bg_id)
{
	//alert(id);
	var mydata = {"bg_id": bg_id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('distributor_commission/get_area') ?>",
		data: mydata,
		success: function (response) {
			$("#area").html(response);
			//alert(response);
		}
	});   
}

</script>
<script>
function check_value(perc)
{
	
	 if (/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
      .test(perc))
	  {
		  if(perc <= 0)
		{
			alert('please enter a valid value');
			document.getElementById('percentage').value ='';
			return false;
		}
	  }
	  else
	  {
		   alert('Please input numeric characters only');
		  document.getElementById('percentage').value ='';  
		  return false;
	  }
      
}
</script>
<script>
	function check_exist()
	{
		var area = document.getElementById('area').value;
		var from_role = document.getElementById('from_role').value;
		var business_group = document.getElementById('business_group').value;
		var to_user = document.getElementById('to_user').value;
		if(from_role == '')
		{
			document.getElementById('area').value ='';
			alert('Please select from role');
			return false
		}
		else
		{
			var mydata = {"area": area,"from_role": from_role, "business_group": business_group, "to_user":to_user };

			$.ajax({
			type: "POST",
			url: "<?php echo base_url('distributor_commission/check_exist') ?>",
			data: mydata,
			success: function (response) {
				if(response == 1)
				{
					alert('Already exist');
					location.reload(); 
				}
				
			}
			});   
		}
	
	
	}
</script>
</script>
	
	 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	
<?php } ?>

