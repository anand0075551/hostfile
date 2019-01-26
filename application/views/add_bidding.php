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



<?php
foreach( $wal_debit->result() 		as $wal_debit);
foreach( $wal_credit->result() 		as $wal_credit); 
$wal_debit			= $wal_debit->debit;
$wal_credit      	= $wal_credit->credit;
$wallet_balance    = ( $wal_debit - $wal_credit ) ;
$balance=$wallet_balance;
//echo $balance;

?>
<!-- Main content -->
<section class="content">
    <div class="row">
    <!-- Select -->
    <div class="col-md-12">
      <div class="box box-primary">
		<div class="box-body">
                <div class="col-lg-3 text-center">
                <input type="button" name="bidding_select" id="s1" onClick="get_add_form()" class="btn btn-primary form-control" value="I Want To Sell">
                </div>
                <div class="col-lg-3 text-center">
                <input type="button" name="bidding_select" id="s2" onClick="get_register_form()" class="btn btn-primary form-control" value="I Want To Buy">
          		</div>
                
          <div class="clearfix"></div>
         </div><!-- /.box-body -->
		 </div><!-- /.box -->
	</div>
    <!-- /Select -->
        <!-- Add My Stock-->
        <div class="col-md-12" id="add_form" style="display:none;">
            <!-- general form elements -->

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">Add My Stock</h3>
                </div><!-- /.box-header -->
                <!-- Add My Stock form start -->
                <?php echo form_open_multipart('', ['add' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
                    
                    <div class="form-group <?php if (form_error('location')) echo 'has-error'; ?>">
								<label for="country" class="col-md-3">Country
									<span class="text-red">*</span>
								</label>
                                <div class="col-md-9" >  
                                	<select name="country" id="country" class="form-control" onChange="get_state(this.value)" >
										<option value=""> Choose country </option>
										<?php
										if ($countrys->num_rows() > 0) 
										{
											foreach ($countrys->result() as $country) 
											{
												echo '<option value="'.$country->country.'"> '.$country->country.'</option>';
											}
										}
										?>
									</select>	
                                                                 
									<?php echo form_error('location') ?>

								</div>
						</div>
                        <div class="form-group <?php if (form_error('location')) echo 'has-error'; ?>">
								<label for="state" class="col-md-3">State
									<span class="text-red">*</span>
								</label>
                                <div class="col-md-9" >  
                                	<select name="state" id="state" class="form-control" onChange="get_district(this.value)" >
										<option value=""> Choose country First</option>
										
									</select>	
                                                                 
									<?php echo form_error('location') ?>

								</div>
						</div>
                        <div class="form-group <?php if (form_error('location')) echo 'has-error'; ?>">
								<label for="district" class="col-md-3">District
									<span class="text-red">*</span>
								</label>
                                <div class="col-md-9">  
                                	<select name="district" id="district" class="form-control" onChange="get_location(this.value)">
										<option value=""> Choose country First</option>
										
									</select>	
                                                                 
									<?php echo form_error('location') ?>

								</div>
						</div>
                        <div class="form-group <?php if (form_error('location')) echo 'has-error'; ?>">
								<label for="location" class="col-md-3">Location
									<span class="text-red">*</span>
								</label>
                                <div class="col-md-9" id="elocation" >  
                                	<select name="location" id="location" class="form-control">
										<option value=""> Choose Event location </option>
										<?php
										/*if ($locations->num_rows() > 0) 
										{
											foreach ($locations->result() as $location) 
											{
												echo '<option value="'.$location->id.'"> '.$location->pincode.'-'.$location->location.'</option>';
											}
										}*/
										?>
									</select>	
                                                                 
									<?php echo form_error('location') ?>

								</div>
						</div>
                    

                        <div class="form-group <?php if(form_error('category')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Category
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="category" id="category" class="form-control" onchange="get_subcateg(this.value)">
                                <option value=""> Choose option </option>
                                 <?php if(!empty($category)): foreach($category as $categ): ?>
                                <option value="<?php echo $categ['id']; ?>"><?php echo $categ['category_name']; ?></option>
                            	<?php endforeach; endif; ?>
                            </select>
                                <?php echo form_error('category') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if (form_error('sub_cat')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Sub Category
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="sub_cat_id" id="sub_cat_id" class="form-control" onchange="get_product(this.value)">
                                <option value=""> Choose option </option>


                            </select>	                                
                            <?php echo form_error('sub_cat') ?>

                        </div>
                    </div>

                        <div class="form-group <?php if (form_error('product')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Product
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="product_id" id="product_id" class="form-control">
                                <option value=""> Choose option </option>


                            </select>	                                
                            <?php echo form_error('product') ?>

                        </div>
                    </div>
                    <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Amount
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="amount" id="amount" placeholder="Enter Amount">
                                <!--< ?php echo form_error('amount') ?>
                                Per:  <input type="text" name="amount_no" placeholder="Enter Number">
                                <select name="amount_measure" id="amount_measure">
                                <option value="Piece" >Piece</option>
                                <option value="pack" >Packs</option>
                                <option value="kg" >kilo gram</option>
                                <option value="g" >Gram</option>
                                <option value="ltr" >Litre</option>
                                <option value="ml" >Milli Litre</option>
                                </select>-->
                            </div>
                        </div>
                        <div class="form-group <?php if(form_error('quantity')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Total Quantity
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="quantity"  id="quantity" placeholder="Enter Quantity" onChange="get_total(this.value)">
                                <!--< ?php echo form_error('quantity') ?>
                                <select name="measure" id="measure">
                                <option value="Piece" >Piece</option>
                                <option value="pack" >Packs</option>
                                <option value="kg" >kilo gram</option>
                                <option value="g" >Gram</option>
                                <option value="ltr" >Litre</option>
                                <option value="ml" >Milli Litre</option>
                                </select>-->
                                <div id="total" style="color:#090;"></div>
                            </div>
                           
                        </div>
						<div class="form-group <?php if(form_error('fee')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Reg.fee
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                            <!-- Bidding Fees for Seller -Anand -->
                                <input type="text" name="fee" class="form-control" value="1" readonly>
                                
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                    <input type="hidden" value="<?php echo $balance;?>" name="balance">
                        <button type="submit" name="submit" value="stock_add" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
        <!-- Register-->
        <div class="col-md-12" id="register_form" style="display:none">
            <!-- general form elements -->
<div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">Register to Bidding Event</h3>
                </div><!-- /.box-header -->
                <!-- Register form start -->
                <?php echo form_open_multipart('', ['register' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">

                        <div class="form-group <?php if(form_error('category')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Category
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <select name="reg_category" id="reg_category" class="form-control" onchange="get_reg_subcateg(this.value)">
                                <option value=""> Choose option </option>
                                 <?php if(!empty($category)): foreach($category as $categ): ?>
                                <option value="<?php echo $categ['id']; ?>"><?php echo $categ['category_name']; ?></option>
                            	<?php endforeach; endif; ?>
                            </select>
                                <?php echo form_error('rcategory') ?>
                            </div>
                        </div>

                        <div class="form-group <?php if (form_error('sub_cat')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Sub Category
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="reg_sub_cat_id" id="reg_sub_cat_id" class="form-control" onchange="get_reg_product(this.value)">
                                <option value=""> Choose option </option>


                            </select>	                                
                            <?php echo form_error('rsub_cat') ?>

                        </div>
                    </div>

                        <div class="form-group <?php if (form_error('product')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Product
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="reg_product_id" id="reg_product_id" class="form-control">
                                <option value=""> Choose option </option>


                            </select>	                                
                            <?php echo form_error('rproduct') ?>

                        </div>
                    </div>
                    <div class="form-group <?php if(form_error('amount')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Amount
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                               Min: <input type="text" name="reg_amount_min" placeholder="Enter Amount">  
                               Max: <input type="text" name="reg_amount_max" placeholder="Enter Amount">
                                <?php echo form_error('ramount') ?>
                                
                            </div>
                        </div>
                        
						<div class="form-group <?php if(form_error('fee')) echo 'has-error'; ?>">
                            <label for="exampleInputEmail1" class="col-md-3">Reg.fee
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                              <!-- Bidding Fees for Buyer -Anand -->
                                <input type="text" name="fee" class="form-control" value="2" readonly>
                                
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                    <input type="hidden" value="<?php echo $balance;?>" name="balance">
                        <button type="submit" name="reg" value="reg_bidding" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Register
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->


        </div>
        

    </div>   <!-- /.row -->
</section><!-- /.content -->
<script>
function get_register_form()
{
	
	$("#register_form").slideToggle(1000);
	$("#add_form").slideUp(1000);
	/* $("#register_form").show();
	 $("#add_form").hide();*/
	
}
function get_add_form()
{
	$("#add_form").slideToggle(1000);
	$("#register_form").slideUp(1000);
	/*$("#add_form").show();
	$("#register_form").hide();*/
}
function get_subcateg(id)
{
	//alert(id);
	var mydata = {"categ": id};

	$.ajax({
		type: "POST",
		url: "getsubcat",
		data: mydata,
		success: function (response) {
			$("#sub_cat_id").html(response);
			//alert(response);
		}
	});	
}
function get_product(id)
{
	//alert(id);
	
	var mydata = {"subcateg": id};

	$.ajax({
		type: "POST",
		url: "getproduct",
		data: mydata,
		success: function (response) {
			$("#product_id").html(response);
			//alert(response);
		}
	});	
}
function get_reg_subcateg(id)
{
	//alert(id);
	var mydata = {"categ": id};

	$.ajax({
		type: "POST",
		url: "getsubcat",
		data: mydata,
		success: function (response) {
			$("#reg_sub_cat_id").html(response);
			//alert(response);
		}
	});	
}
function get_reg_product(id)
{
	//alert(id);
	
	var mydata = {"subcateg": id};

	$.ajax({
		type: "POST",
		url: "getproduct",
		data: mydata,
		success: function (response) {
			$("#reg_product_id").html(response);
			//alert(response);
		}
	});	
}

</script>
 <script>
	function get_state(country)
{
	//alert(id);
	var mydata = {"country": country};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Bidding/get_state') ?>",
		data: mydata,
		success: function (response) {
			$("#state").html(response);
			//alert(response);
		}
	});   
}

</script>
 <script>
	function get_district(state)
{
	//alert(id);
	var mydata = {"state": state};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Bidding/get_district') ?>",
		data: mydata,
		success: function (response) {
			$("#district").html(response);
			//alert(response);
		}
	});   
}

</script>
<script>
	function get_location(district)
{
	//alert(id);
	var mydata = {"district": district};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Bidding/get_location') ?>",
		data: mydata,
		success: function (response) {
			$("#location").html(response);
			//alert(response);
		}
	});   
}

</script>
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
	function get_total(q)
	{
		var result = isNaN(q);
		var amount = document.getElementById("amount").value;
            if (!result) 
			{
				var total = "Total Amount is Rs: " + q * amount ;
				 $('#total').html(total);
            } else {
                alert("Please enter a valid number");
            }
		
  	}
 
	</script>

<?php } ?>


