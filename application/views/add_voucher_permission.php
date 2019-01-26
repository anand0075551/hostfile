
<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	
	<!-- Date Picker -->
	<link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />


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
							<h3 class="box-title">Add Voucher Permission</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
						<div class="box-body">

							 <div class="form-group <?php if (form_error('voc_name')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Voucher Name
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  	
							
									<select name="voc_name" id="voc_name" class="form-control" style="width:100% auto;">
										<option value=""> Choose option </option>
										<?php
										$get_voc = $this->db->get_where('status', ['business_name'=>20]);
										if ($get_voc->num_rows() > 0) {
											foreach ($get_voc->result() as $v) {

												echo '<option value="'.$v->id.'"> '.$v->status.'</option>';
											}
										}
										?>
									</select>
							                          
									<?php echo form_error('voc_name') ?>

								</div>
							</div>
							
									
							<div class="form-group <?php if (form_error('business_name')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Business Name
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="business_name" id="business_name" class="form-control" style="width:100% auto;">
										<option value=""> Choose option </option>
										<?php
										if ($business_name->num_rows() > 0) {
											foreach ($business_name->result() as $c) {

												echo '<option value="'.$c->id.'"> '.$c->id.'-'.$c->business_name.'</option>';
											}
										}
										?>
									</select>	                                
									<?php echo form_error('business_name') ?>

								</div>
							</div> 
							
							
							
								
							<div class="form-group <?php if(form_error('from_pay_type')) echo 'has-error'; ?>">
								<label for="from_pay_type" class="col-md-3">Main Pay Type
									<span class="text-red"></span>
								</label>
								<div class="col-md-9" >
									<select class="form-control" onchange="get_sub_account(this.value)" style="width:100% auto;">
										<option value="">Choose Option</option>
										<?php
											$query = $this->db->get_where('acct_categories', ['parentid' => '0']);
											foreach($query->result() as $account){
												echo '<option value="'.$account->id.'">'.$account->id.'-'.$account->name.'</option>';
											}
										?>
									</select>	
									
									<?php echo form_error('from_pay_type') ?>
								</div>
							</div>
								
							<div class="form-group <?php if (form_error('pay_type')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Pay Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="pay_type" id="pay_type" class="form-control" style="width:100% auto;">
										<option value=""> Choose option </option>
										
									</select>	                                
									<?php echo form_error('pay_type') ?>

								</div>
							</div> 
							
						   	<div class="form-group <?php if(form_error('from_pay_type')) echo 'has-error'; ?>">
									<label for="from_pay_type" class="col-md-3">Main Pay Type To
										<span class="text-red"></span>
									</label>
									<div class="col-md-9" >
										<select name="business_type" id="business_type" class="form-control" onchange="get_account(this.value)" style="width:100% auto;">
											<option value="">Choose Option</option>
											<?php
												$query = $this->db->get_where('acct_categories', ['parentid' => '0']);
												foreach($query->result() as $account){
													echo '<option value="'.$account->id.'">'.$account->id.'-'.$account->name.'</option>';
												}
											?>
										</select>	
										
										<?php echo form_error('from_pay_type') ?>
									</div>
							</div>

							<div class="form-group <?php if (form_error('paytype_to')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Pay Type to
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="paytype_to" id="paytype_to" class="form-control" style="width:100% auto;">
										<option value=""> Choose option </option>
										
									</select>	                                
									<?php echo form_error('paytype_to') ?>

								</div>
							</div> 

							<div class="form-group <?php if (form_error('to_role')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">For Role
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="to_role"  class="form-control" onchange="get_user(this.value)" style="width:100% auto;">
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

							<div class="form-group <?php if (form_error('to_user')) echo 'has-error'; ?>" style="display:none;">
								<label for="firstName" class="col-md-3">To User
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">  								

									<select name="to_user" id="to_user" class="form-control" style="width:100% auto;">
										<option value=""> Choose option </option>
										
									</select>	                                
									<?php echo form_error('to_user') ?>

								</div>
							</div>
							
							<div class="form-group <?php if (form_error('percentage')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Percentage
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="number" name="percentage" class="form-control" value="<?php echo set_value('percentage'); ?>" placeholder="Enter percentage.">                                
									<?php echo form_error('percentage') ?>

								</div>
							</div>
							
							<div class="form-group <?php if (form_error('no_of_split')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Number of Splits
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								
									<input type="number" name="no_of_split" class="form-control" value="<?php echo set_value('no_of_split'); ?>" placeholder="Enter number split.">                                
									<?php echo form_error('no_of_split') ?>

								</div>
							</div>
							
							<div class="form-group <?php if(form_error('start_date')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Start Date
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									 <input type="text" name="start_date" id="start_date" class="form-control some_class" value="<?php echo set_value('start_date'); ?>" placeholder="Select Start Date">
									<?php echo form_error('start_date') ?>

								</div>
							</div>
							
							<div class="form-group">
								<label for="firstName" class="col-md-3">Define End Date
									<span class="text-red"></span>
								</label>
								<div class="col-md-9">  								
									<select name="end_date_opt" id="end_date_opt" onchange="get_end_date_opt(this.value)" class="form-control" style="width:100% auto;">
										<option value=""> Choose option </option>
										<option value="1"> Yes </option>
										<option value="0"> No </option>
									</select>	                                
								</div>
							</div>
							
							<div class="form-group" id="hrs_gap_div" style="display:none">
								<label for="firstName" class="col-md-3">Hours Gap From Start Date
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">
									<select name="hrs_gap" id="hrs_gap" class="form-control" style="width:100% auto;">
										<option value="0"> 	  Choose option 	   </option>
										<option value="24">    1 Day (24 Hours)    </option>
										<option value="48">    2 Day (48 Hours)    </option>
										<option value="72">    3 Day (72 Hours)    </option>
										<option value="96">    4 Day (96 Hours)    </option>
										<option value="120">   5 Day (120 Hours)   </option>
										<option value="144">   6 Day (144 Hours)   </option>
										<option value="168">   7 Day (168 Hours)   </option>
										<option value="192">   8 Day (192 Hours)   </option>
										<option value="216">   9 Day (216 Hours)   </option>
										<option value="240">   10 Day (240 Hours)  </option>
										<option value="360">   15 Day (360 Hours)  </option>
										<option value="720">   30 Day (1 Month)    </option>
										<option value="1440">  60 Day (2 Month)    </option>
										<option value="2160">  90 Day (3 Month)    </option>
										<option value="2880">  120 Day (4 Month)   </option>
										<option value="3600">  150 Day (5 Month)   </option>
										<option value="4320">  180 Day (6 Month)   </option>
										<option value="8760">  12 Month (1 Year)   </option>
									</select>
								</div>
							</div>
							
							<div class="form-group <?php if(form_error('voc_type')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Voucher Type
									<span class="text-red">*</span>
								</label>
								<label class="col-md-2"><input type="radio" name="voc_type" value="month"> Monthly </label>
								<label class="col-md-2"><input type="radio" name="voc_type" value="week"> Weekly </label>
								<label class="col-md-2"><input type="radio" name="voc_type" value="day"> Daily </label> &nbsp;&nbsp;
								<?php echo form_error('voc_type') ?>
							</div>
							
						<div class="clearfix"></div>
					</div><!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" name="submit" value="add_voucher_permission" class="btn btn-primary">
							<i class="fa fa-edit"></i>Submit
						</button>
					</div>
					</form>
				</div><!-- /.box -->

			</div><!--col md 12-->

     </div><!--Row -->
    <!-- right column -->


	</section><!-- /.content -->

<input type="hidden" id="txtstartdate" value="<?php echo date('Y-m-d') ?>">




<?php

function page_js() { ?>


  <!-- InputMask -->

  <script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>
   
	
    <script>

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
    $("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
    $.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:    '1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});


var startdate = $("#txtstartdate").val();
$('.some_class').datetimepicker({ minDate: startdate });

$('#default_datetimepicker').datetimepicker({
    formatTime:'H:i',
    formatDate:'d.m.Y',
    //defaultDate:'8.12.1986', // it's my birthday
    defaultDate:'+03.01.1970', // it's my birthday
    defaultTime:'10:00',
    timepickerScrollbar:false
});




</script>
	

<script>
	function get_user(id)
{
	//alert(id);
	var mydata = {"to_role": id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Voucher_permission/get_user') ?>",
		data: mydata,
		success: function (response) {
			$("#to_user").html(response);
		}
	});
}

</script>

<script>
	function get_sub_account(id)
	{
		var parent_id = id;
		var mydata = {"parent_id":parent_id};
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Voucher_permission/get_sub_account') ?>",
			data:mydata,
			success:function(response){
				$("#pay_type").html(response);
			}
		});
	}
</script>

<script>
	function get_account(id)
	{
		var parent_id = id;
		var mydata = {"parent_id":parent_id};
		$.ajax({
			type:"POST",
			url:"<?php echo base_url('Voucher_permission/get_sub_account') ?>",
			data:mydata,
			success:function(response){
				$("#paytype_to").html(response);
			}
		});
	}
</script>

<script>
	function get_end_date_opt(id)
	{
		if(id == 1){
			$('#hrs_gap_div').slideDown();
		}
		else{
			$('#hrs_gap_div').slideUp();
		}
	}
</script>
    


	
	<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
<?php } ?>

