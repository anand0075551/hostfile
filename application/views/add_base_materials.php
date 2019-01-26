
<?php

function page_css() { ?>

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
                    <h3 class="box-title">Add Agricultural Base Materials</h3>
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
                            <select name="location" id="pincode" class="form-control" style="width:100% auto">
                                <option value=""> Select Pincode </option>

                            </select>
                            <?php echo form_error('pincode') ?>
                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('type')) echo 'has-error'; ?>">
                        <label for="type" class="col-md-3">Type 
                            <span class="text-red"></span>
                        </label>
                        <div class="col-md-9" >
                            <select name="type" class="form-control" id="Shiptype" style="width:100% auto" >
                                <option value="">-Select Type-</option>
                                <option value="Seeds">Seeds</option>
                                <option value="Seedlings">Seedlings(madi)</option>
                                <option value="Saplings">Saplings(sasi)</option>
                                <option value="Sprouts">Sprouts(molake)</option>
                            </select>
                            <?php echo form_error('type') ?>
                        </div>
                    </div>




                    <div class="form-group <?php if (form_error('name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Seed Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="text" name="seed_name" class="form-control" value="<?php echo set_value('name'); ?>" placeholder="Enter Seed Name.">                                
                            <?php echo form_error('name') ?>

                        </div>
                    </div>

					
					<!--<div class="form-group <?php if (form_error('city')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Location Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">  								

                                <select name="location" id="location_id" class="form-control" onchange="get_pincode(this.value)" style="width:100% auto">
                                    <option value=""> Choose option </option>
                                    <?php
                                    $users = $this->db->group_by('location')->get_where('pincode',['district'=>'BANGALORE']);
                                    if ($users->num_rows() > 0) {
                                        foreach ($users->result() as $c) {

                                            echo "<option value=" . $c->location . ">" . $c->location . "</option>";
                                        }
                                    }
                                    ?>
                                </select>	                                
                                <?php echo form_error('city') ?>

                            </div>
                        </div>-->

                    <div class="form-group <?php if (form_error('name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Quantity In Kg
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="number" name="quantity" class="form-control" value="<?php echo set_value('name'); ?>" placeholder="Enter Quantity.">                                
                            <?php echo form_error('name') ?>

                        </div>
                    </div>


                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="add_base_materials" class="btn btn-primary">
                        <i class="fa fa-edit"></i>add
                    </button>
					
				<a href="<?php echo base_url('Agriculture/list_base_materials') ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Back</a>
                </div>
                </form>
            </div><!-- /.box -->

        </div><!--col md 12-->

    </div><!--Row -->
    <!-- right column -->


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


