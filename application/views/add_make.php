<?php

function page_css() { ?>
	<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" /> 
   

<?php } ?>

<?php include('header.php'); ?>
<!-- Main content -->
<section class="content">
    <div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-3 text-center">
			<button class="btn btn-success form-control" id="user_btn"  onclick="get_make_form()">Vehicle Make</button>
		</div>
		<div class="col-lg-3 text-center">
			<button class="btn btn-success form-control" id="guest_btn" onclick="get_model_form()">Vehicle Model</button>
		</div>
		<div class="col-lg-3 text-center">
			<button class="btn btn-success form-control" id="guest_btn" onclick="get_type_form()">Vehicle Type</button>
		</div>
		
		<div class="col-lg-1"></div>
	</div>
    <hr>
 <div class="row">
  <!-- left column -->
   <div class="col-md-12" id="make_form" >
            <!-- general form elements -->
            <div class="box box-primary">
				<div class="box-header">
                    <h3 class="box-title">Vehicle Make</h3>
                </div><!-- /.box-header -->
		
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				<div class="form-group <?php if (form_error('brands')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Vehicle Brand
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="brands" id="brands" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('brands') ?>

                        </div>
			    </div>
				
				<!------------end body---------------------------------->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" value="vehicle_make" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Submit
                </button>
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
 </div><!--end  left column ==================================================================================================--->
		
		
		
		<div class="col-md-12" id="model_form" style="display:none" >
            <!-- general form elements -->
            <div class="box box-primary">
				<div class="box-header">
                    <h3 class="box-title">Vehicle Model</h3>
                </div><!-- /.box-header -->
		
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				
			
				
				<div class="form-group">
						<label for="firstName" class="col-md-3">Vehicle Brand
							<span class="text-red">*</span>
                        </label>
					     <div class="col-md-9">
						<select class="form-control" name="m_id" id="m_id" style=" width:100% auto; ">
							<option value=""></option>
							<?php 
								$get_users1 = $this->db->group_by('brands')->get('trp_vehicle_make');
								foreach($get_users1->result() as $z){
									
									 echo "<option value=".$z->id.">".$z->brands."</option>";
								}
							?>
						</select>
						</div>
				</div><br>
				
				
				
				
				
				
				<div class="form-group <?php if (form_error('model')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Vehicle Model
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="model" id="model" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('model') ?>

                        </div>
			    </div>
				
				<!--end body---->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" value="vehicles" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Now
                </button>
			
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
 </div> <!-- column======================================================================================================-->
		
		
		
 
		<!-- right column -->
		  <div class="col-md-12" id="type_form" style="display:none">
            <!-- general form elements -->
            <div class="box box-primary">
				<div class="box-header">
                    <h3 class="box-title">Vehicle Type</h3>
                </div><!-- /.box-header -->
				<form>
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!--form body--->
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
				</div><br>
				
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
				</div><br>
				
				<div class="form-group <?php if (form_error('version')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Version
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="version" id="version" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('version') ?>

                        </div>
			    </div>
				
			
				
				<!------------end body-->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" value="vehicle_type" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Submit
                </button>
				
				<div id="mydiv"></div>
            </div>
            </form>
			
	     </div>
        </div><!--end  cright column=========================================================================================== -->
		
	</div><!---row---->
</section><!-- /.content -->
<?php function page_js() { ?>


<script>
function get_userid(id)
{
	//alert(id);
	
	var mydata = {"role": id};

	$.ajax({
		type: "POST",
		url: "getname",
		data: mydata,
		success: function (response) {
			$("#user_id").html(response);
			//alert(response);
		}
	});	
}
function get_email(id)
{
	//alert(id);
	
	var mydata = {"role": id};

	$.ajax({
		type: "POST",
		url: "getemail",
		data: mydata,
		success: function (response) {
			//document.getElementById("#user_email").value=response;
			$("#user_email").val(response);
			//alert(response);
		}
	});	
}

function get_content(id)
{
	//alert(id);
	
	var mydata = {"id": id};

	$.ajax({
		type: "POST",
		url: "get_content",
		data: mydata,
		success: function (response) {
			//document.getElementById("#user_no").value=response;
			$("#content_name").val(response);
			//alert(response);
		}
	});	
}

function get_make_form()
{
	$("#make_form").slideToggle(1000);
	$("#model_form").slideUp(1000);
	$("#type_form").slideUp(1000);
}
function get_model_form()
{
	$("#model_form").slideToggle(1000);
	$("#make_form").slideUp(1000);
	$("#type_form").slideUp(1000);
	
}
function get_type_form()
{
	$("#type_form").slideToggle(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	
}


</script>


<script>
                    function maxLengthCheck(object)
                    {
                    if (object.value.length > object.maxLength)
                            object.value = object.value.slice(0, object.maxLength)
                    }
</script>


<script type="text/javascript">
            $(function() {
            //Date range picker
            $('#reservation').daterangepicker({ format: 'YYYY-MM-DD' });
                    //Date range picker with time picker
                    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
            });</script>
 <!-- CREATE Ticket NO: -->
  




    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
  

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->

    <!-- Page script -->
	
	<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script> 

<?php } ?>





