
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
                    <h3 class="box-title">Edit Address</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">


                    <input type="hidden" name="ref_id" id="root_id" class="form-control" value="<?php echo $res->referral_code ?>">
                    <?php
                    $user_info = $this->session->userdata('logged_user');
                    $user_id = $user_info['user_id'];
                    if ($currentRolename == '13' || $currentRolename == '41') {
                        ?>

                        <div class="form-group <?php if (form_error('business_groups')) echo 'has-error'; ?>">
                             <label for="firstName" class="col-md-3">Business Name <p style="color:red;">[Please select 3 Business Services Only]</p></label>
                            <div class="col-md-9">
                                <select name="business_groups[]" multiple="multiple" id="userRequest_activity"  class="form-control">
                                    <?php
                                    if ($result->business_name != "") {
                                        $pincode_name = explode(",", $result->business_name);
                                        foreach ($pincode_name as $id) {
                                            $query = $this->db->get_where('status', ['id' => $id]);
                                            foreach ($query->result() as $d) {
                                                echo "<option value='" . $id . "' selected>" . $d->status . "</option>";
                                            }
                                        }
                                    } else {
                                        echo "<option value=''>Select option</option>";
                                    }
                                    if ($bg->num_rows() > 0) {
                                        foreach ($bg->result() as $c) {

                                            echo '<option value="' . $c->id . '"> ' . $c->status . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('business_groups') ?>
                            </div>
                        </div>

                    <?php } ?>
                    <div class="form-group <?php if (form_error('address_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Address Type
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="address_type" readonly class="form-control" value="<?php echo $result->address_type ?>" placeholder="Enter Land Mark ">
                            <?php echo form_error('address_type') ?>
                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('country')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Country <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="country" class="form-control" onchange="get_state(this.value)">
                                <option value=""> Select Country </option>
                                <?php
                                if ($country->num_rows() > 0) {
                                    foreach ($country->result() as $c) {
                                        //$selected = ($c->id == 105)? 'selected' : '';
                                        echo '<option value="' . $c->country . '"> ' . $c->country . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('country') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('state')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">State <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="state" id="state" class="form-control" onchange="get_district(this.value)">
                                <option value=""> Select State </option>

                            </select>
                            <?php echo form_error('state') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('district')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">District <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="district" id="district" class="form-control" onchange="get_location_id(this.value)">
                                <option value=""> Select District </option>

                            </select>
                            <?php echo form_error('district') ?>
                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('location_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Select Location<span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="location_id" id="location_id" class="form-control" onchange="get_pincode(this.value)">
                                <option value=""> Select location </option>

                            </select>
                            <?php echo form_error('location_id') ?>
                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('pincode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Pincode <span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="pincode" id="pincode" class="form-control">
                                <option value=""> Select Pincode </option>

                            </select>
                            <?php echo form_error('pincode') ?>
                        </div>
                    </div>



                    <div class="form-group <?php if (form_error('house_buildingno')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">House/Building No
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="house_buildingno" class="form-control" value="<?php echo set_value('house_buildingno'); ?>" placeholder="Enter House/Building No ">
                            <?php echo form_error('house_buildingno') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('street_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Street Name 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="street_name" class="form-control" value="<?php echo set_value('street_name'); ?>" placeholder="Enter Stree Name ">
                            <?php echo form_error('street_name') ?>
                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('land_mark')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Land Mark 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">
                            <input type="text" name="land_mark" class="form-control" value="<?php echo set_value('land_mark'); ?>" placeholder="Enter Land Mark ">
                            <?php echo form_error('land_mark') ?>
                        </div>
                    </div>


                </div>
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="saveAddress" class="btn btn-primary" id="addbtn">
                    <i class="fa fa-edit"></i> Save Address
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
                url: "<?php echo base_url('user_address/getstate') ?>",

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
                url: "<?php echo base_url('user_address/get_district') ?>",

                data: mydata,
                success: function (response) {
                    $("#district").html(response);
                    //alert(response);
                }
            });
        }

        function get_location_id(id)
        {  //   alert(id);
            var mydata = {"district": id};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('user_address/get_location_id') ?>",

                data: mydata,
                success: function (response) {
                    $("#location_id").html(response);
                }
            });
        }

        function get_pincode(id)
        {
            var mydata = {"location": id};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('user_address/get_pincode') ?>",

                data: mydata,
                success: function (response) {
                    $("#pincode").html(response);
                }
            });
        }

        function get_address_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "get_address_type",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("addbtn").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("addbtn").disabled = false;
                    }

                }
            });
        }



			$(document).ready(function() {

          var last_valid_selection = null;

          $('#userRequest_activity').change(function(event) {

            if ($(this).val().length > 3) {

              $(this).val(last_valid_selection);
			    window.location.reload();
            } else {
              last_valid_selection = $(this).val();
            }
          });
        });





    </script>
<?php } ?>

