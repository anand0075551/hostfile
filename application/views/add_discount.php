
<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
	<!-- Data live search -->
    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css'); ?>" rel="stylesheet"/>

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
                    <h3 class="box-title">Add Food Voucher Details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body" id="actualprice">
						
						<div class="form-group <?php if(form_error('voucher_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Type
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="voucher_type" id="voucher_type" class="form-control" style="width:100% auto;" onchange="get_food_type(this.value)">
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
                                <?php echo form_error('voucher_type') ?>
                            </div>
                        </div>
						
                        <div class="form-group <?php if(form_error('food_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Voucher Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9" value="<?php echo set_value('food_type')?>">
								<select name="food_type"  id="food_type" class="form-control" onchange="get_coupon_value(this.value)" style="width:100% auto;">
                                <option value="">Choose option</option>
								</select>
                                <?php echo form_error('food_type') ?>

                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="firstName" class="col-md-3">Voucher Price
							 <span class="text-red"></span>
							</label>
                            <div class="col-md-9"> 
								<input type="number" name="actual_price" id="actual_price"  class="form-control" value="" placeholder="Voucher Price" readonly >
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="firstName" class="col-md-3">Ticket Range
							 <span class="text-red">*</span>
							</label>
                            <div class="col-md-4"> 
								<input type="number" name="from_no" min="0"  class="form-control" placeholder="Minimum">
                            </div>
							<div class="col-md-1 text-center" style="padding-top:7px;"> 
								<i class="fa fa-minus"></i>
                            </div>
							<div class="col-md-4"> 
								<input type="number" name="to_no" min="0" class="form-control" placeholder="Maximum">
                            </div>
                        </div>
						
                        <div class="form-group <?php if(form_error('discount_%')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Discount in %
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="discount_%"  id="discount_per" class="form-control" value="<?php echo set_value('discount_%'); ?>" placeholder="Enter discount percentage" onkeyup="abcd(this.value)">
                                <?php echo form_error('discount_%') ?>
                            </div>
                        </div>


                        <div class="form-group <?php if(form_error('discount_value')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Discount Value
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                 <input type="number" name="discount_value" id="discount_value" placeholder="Discount Value" class="form-control" value="<?php echo set_value('discountvalue'); ?>" placeholder="" readonly >
                                <?php echo form_error('discount_value') ?>

                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('price_discount')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Price After Discount
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="price_discount" placeholder="Price After Discount" id="price_discount" class="form-control"  value="<?php echo set_value('price_after_discount'); ?>" placeholder="" readonly>
                                <?php echo form_error('price_discount') ?>

                            </div>
                        </div>
				
                        <input type="hidden" id="to_role" name="to_role">
						
                    <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- Admin_settings/addAdmin && Settings_models/addAdmin -->
                        <button type="submit" name="submit" value="foodvoucher" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Voucher Discount
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
    function abcd()
{
		
		//	alert(id);
			
		var actualprice = Number($("#actual_price").val().trim());
        var discount_per = Number($("#discount_per").val().trim());
      
	//alert(actualprice);
	//alert(discount_per);  
	
    var discountvalue = (actualprice/100);
	 
	var discountvalue = discountvalue*discount_per;
	

    var price_after_discount = actualprice-discountvalue;
	
	//alert(discountvalue);
	//alert(price_after_discount);
	$("#discount_value").val(discountvalue);
	$("#price_discount").val(price_after_discount);
	
    
}
</script>

<script>
	function paytype(id)
{
    //alert(id);
    var mydata = {"parentid": id};

    $.ajax({
        type: "POST",
        url: "<?php echo base_url('Food_voucher/paytype') ?>",
        data: mydata,
        success: function (response) {
           $("#pay_type").html(response);
           // alert(response);
        }
    });
}
	
	</script>
<script type="text/javascript">
    function get_coupon_value(id)
	{       
	   var mydata = {"food_id":id};
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Food_voucher/get_coupon_value') ?>",
			data: mydata,
			success: function (response) {
				$("#actual_price").val(response);
				//alert(response);
			}
		});  
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('Food_voucher/get_to_role') ?>",
			data: mydata,
			success: function (response) {
				$("#to_role").val(response);
			}
		}); 
	}
</script>
<script>
	function get_user(id)
{
    //alert(id);
    var mydata = {"pay_to" : id };

    $.ajax({
        type: "POST",
        url:  "<?php echo base_url('Food_voucher/getuser') ?>",
        data: mydata,
        success: function (response) {
         $("#to_user").html(response);
            //alert(response);
        }
    });
}
</script>
	
<script>
	function get_food_type(id)
	{
		var mydata = {"voc_type" : id };

		$.ajax({
			type: "POST",
			url:  "<?php echo base_url('Food_voucher/get_food_type') ?>",
			data: mydata,
			success: function (response) {
			 $("#food_type").html(response);
			}
		});
	}
</script>
	
	<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js'); ?>"></script>
<script>
	$('select').select2();
</script>
<?php } ?>

