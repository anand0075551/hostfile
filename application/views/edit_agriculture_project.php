
<?php

function page_css() { ?>

    <link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
<?php } ?>

<?php include('header.php');
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->


            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">Create Agriculture Projects</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
                    <div class="form-group <?php if (form_error('country_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Country
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <select name="country" class="form-control" onchange="get_state(this.value)" style="width:100% auto">
                                <option value=""> Choose option </option>
                                <?php
                                if ($country_name->num_rows() > 0) {
                                    foreach ($country_name->result() as $c) {

                                        echo "<option value=" . $c->country . ">" . $c->country . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('country_name') ?>

                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('state')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">State <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="state" id="state" class="form-control" onchange="get_district(this.value)" style="width:100% auto">
                                <option value=""> Select State </option>

                            </select>
                            <?php echo form_error('state') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('district')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">District <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="district" id="district" class="form-control" onchange="get_taluk(this.value)" style="width:100% auto">
                                <option value=""> Select District </option>

                            </select>
                            <?php echo form_error('district') ?>
                        </div>
                    </div>
					
					
					
					
				 <div class="form-group <?php if (form_error('taluk')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Taluk <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="taluk" id="taluk" class="form-control" onchange="get_location_id(this.value)" style="width:100% auto">
                                <option value=""> Select Taluk </option>

                            </select>
                            <?php echo form_error('taluk') ?>
                        </div>
                    </div>
					
					
			


                    <div class="form-group <?php if (form_error('location_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Location<span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="location_id" id="location_id" class="form-control" onchange="get_pincode(this.value)" style="width:100% auto">
                                <option value=""> Select location </option>

                            </select>
                            <?php echo form_error('location_id') ?>
                        </div>
                    </div>
					
					
			

				<div class="form-group <?php if (form_error('pincode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Pincode <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="pincode" id="pincode" class="form-control" style="width:100% auto">
                                <option value=""> Select Pincode </option>

                            </select>
                            <?php echo form_error('pincode') ?>
                        </div>
                </div>
				
				
				
				<div class="form-group <?php if (form_error('project_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Project Name 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="project_name" class="form-control" value="<?php echo set_value('project_name'); ?>" placeholder="">
                            <?php echo form_error('project_name') ?>
                        </div>
                </div>
				
				
				<div class="form-group <?php if (form_error('village_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Village Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="village_name" class="form-control" value="<?php echo set_value('village_name'); ?>" placeholder="">
                            <?php echo form_error('village_name') ?>
                        </div>
                </div>



                </div>
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="edit_project" value="edit_project" class="btn btn-success">
                    <i class="fa fa-edit"></i> Edit project
                </button>
            </div>
            </form>
        </div><!-- /.box -->



    </div><!--/.col (left) -->
    <!-- right column -->

</div>   <!-- /.row -->
</section><!-- /.content -->

<?php

function page_js() { ?>
<!-- InputMask -->
<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
                                $('select').select2();
    </script>

	<script>
        function get_state(id)
        {
            //   alert(id);
            var mydata = {"country": id};

            $.ajax({
                type: "POST",
                url: "getstate",
                data: mydata,
                success: function (response) {
                    $("#state").html(response);
                    //alert(response);
                }
            });
        }




        function get_district(id)
        {
            //   alert(id);
            var mydata = {"state": id};

            $.ajax({
                type: "POST",
                url: "get_district",
                data: mydata,
                success: function (response) {
                    $("#district").html(response);
                    //alert(response);
                }
            });
        }
/*******************get taluk***************************************************/
		  function get_taluk(id)
        {
            //   alert(id);
            var mydata = {"district": id};

            $.ajax({
                type: "POST",
                url: "get_taluk",
                data: mydata,
                success: function (response) {
                    $("#taluk").html(response);
                   // alert(response);
                }
            });
        }
/**************************************************************************************/
        function get_location_id(id)
        {  //   alert(id);
            var mydata = {"taluk": id};

            $.ajax({
                type: "POST",
                url: "get_location_id",
                data: mydata,
                success: function (response) {
                    $("#location_id").html(response);
					//alert(response);
                }
            });
        }

        function get_pincode(id)
        {
            var mydata = {"location": id};

            $.ajax({
                type: "POST",
                url: "get_pincode",
                data: mydata,
                success: function (response) {
                    $("#pincode").html(response);
                }
            });
        }

     






    </script>
<?php } ?>

