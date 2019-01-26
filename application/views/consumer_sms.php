
<?php

function page_css() { ?>
	<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" /> 
    <!-- datatable css -->
   
<?php } ?>

<?php include('header.php'); ?>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-3 text-center">
			<button class="btn btn-info form-control " id="user_btn" onclick="get_user_form()">Consumer User SMS</button>
		</div>
		<div class="col-lg-3 text-center">
			<button class="btn btn-info form-control" id="guest_btn" onclick="get_guest_form()">Consumer Guest SMS</button>
		</div>
		<div class="col-lg-3"></div>
	</div>
	<hr>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12" id="user_form" >
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Consumer SMS System</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
					
					
					
				
				   
				<div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Role Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="role_id" id="role_id" class="form-control" onchange="get_userid(this.value)" style="width:100% auto">
                                <option value=""> Choose option </option>
                                 <?php
								$users = $this->db->get_where('role', ['id']);
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->rolename . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('rolename') ?>

                        </div>
                </div>
				
				
				<div class="form-group <?php if (form_error('user_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="user_id" id="user_id" class="form-control" onchange="getno(this.value)" style="width:100% auto">
                                <option value=""> Choose option </option>


                            </select>	                                
                            <?php echo form_error('user_id') ?>

                        </div>
                    </div> 
				
				
				
				
				
				<div class="form-group <?php if (form_error('user_no')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Mobile No</label>                         
                        <div class="col-md-9">
                            <input type="number" name="user_no" id="user_no" class="form-control" readonly value="<?php echo set_value('user_no'); ?>" placeholder="">
                            <?php echo form_error('user_no') ?>
                        </div>
				</div> 
				
					<div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Template Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="template_name" id="role_id" class="form-control"  onchange="get_content(this.value)" style="width:100% auto">
                                <option value=""> Choose option </option>
                                 <?php
								$users = $this->db->get_where('content', ['id']);
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->template_name . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('template_name') ?>

                        </div>
					</div>
				
				
					<div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Content Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="content_name" id="content_name" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('content_name') ?>

                        </div>
					</div>
					
					
			
		
					
           
			</div>	

			
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="consumer_sms" value="consumer_sms" class="btn btn-success">
                    <i class="fa fa-edit"></i>Submit
                </button>
				
				<div id="mydiv"></div>
            </div>
            </form>
			
			
			
			
        </div>
		
		
	   <div class="col-md-12" id="guest_form" style="display:none">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Guest SMS</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
					
	
				
				
			<div class="form-group <?php if(form_error('contactno')) echo 'has-error'; ?>">
				<label for="accno" class="col-md-3">Phone Number <span class="text-red">*</span></label>
					<div class="col-md-9">
							<span id="sprytf_mob">
                            <input type="number" name="mobile" class="form-control" value="<?php echo set_value('contactno'); ?>" placeholder="Contact No" >
						<span class="textfieldInvalidFormatMsg">Mobile Number must be Integer.</span>
							</span>
					</div>
			</div>
				
        
					
				<div class="form-group <?php if (form_error('message')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Message</label>                         
                        <div class="col-md-9">
                            <textarea name="message" class="form-control" value="" placeholder=""></textarea>
                            <?php echo form_error('message') ?>
                        </div>
				</div> 
					
           
			</div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="guest_SMS" value="guest_SMS" class="btn btn-success">
                    <i class="fa fa-edit"></i>Submit Now
                </button>
				
				<div id="mydiv"></div>
            </div>
            </form>
        </div><!-- /.box -->




    </div><!--/.col (left) -->
    <!-- right column -->

</div>   <!-- /.row -->






</section><!-- /.content -->
<script>
function get_userid(id)
{
	//alert(id);
	
	var mydata = {"role": id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Email/getname') ?>",
	//	url: "getname",
		data: mydata,
		success: function (response) {
			$("#user_id").html(response);
			//alert(response);
		}
	});	
}
function getno(id)
{
	//alert(id);
	
	var mydata = {"role": id};

	$.ajax({
		type: "POST",
		url: "<?php echo base_url('Email/getno') ?>",
		//url: "getno",
		data: mydata,
		success: function (response) {
			//document.getElementById("#user_no").value=response;
			$("#user_no").val(response);
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
		url: "<?php echo base_url('Email/get_content') ?>",
		//url: "get_content",
		data: mydata,
		success: function (response) {
			//document.getElementById("#user_no").value=response;
			$("#content_name").val(response);
			//alert(response);
		}
	});	
}



function get_user_form()
{
	$("#user_form").slideToggle(1000);
	$("#guest_form").slideUp(1000);
}
function get_guest_form()
{
	$("#guest_form").slideToggle(1000);
	$("#user_form").slideUp(1000);
}



</script>


  
	
			

<?php

function page_js() { ?>
   
	<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script> 
  

<?php } ?>
