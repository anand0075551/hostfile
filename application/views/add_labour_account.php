
<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/css/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css">


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
                    <h3 class="box-title">Add Labour account</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

                    <div class="form-group <?php if (form_error('main_power')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Man Power Type 
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="main_power" id="main_power" class="form-control" style="width:100% auto">
                                <option value=""> Choose option </option>
                                <?php
                                $users = $this->db->get_where('agri_labour_type', ['id']);
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->job_type . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('main_power') ?>

                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('agri_labour_type')) echo 'has-error'; ?>">
                        <label for="zone" class="col-md-3">Zone<span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="zone" id="zone" class="form-control" style="width:100% auto">
                                <option value="1"> Choose option </option>
                                <option value="2"> South A Zone </option>
                                <option value="3"> South B Zone </option>
                                <option value="4"> South C Zone </option>
                                <option value="5"> South D Zone </option>

                            </select>
                            <?php echo form_error('agri_labour_type') ?>
                        </div>
                    </div>
                    <div class="form-group <?php if (form_error('land_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Land ID
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="land_id" id="land_id" class="form-control" style="width:100% auto">
                                <option value=""> Choose option </option>
                                <?php
                                $users = $this->db->get_where('agr_landid', ['id']);
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->land_id . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('land_id') ?>

                        </div>
                    </div>




                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="labour_account" value="labour_account" class="btn btn-primary">
                        <i class="fa fa-edit"></i>add
                    </button>
					
			<a href="<?php echo base_url('Agriculture/all_agriculture_project') ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Back</a>
                </div>
                </form>
            </div><!-- /.box -->

        </div><!--col md 12-->

    </div><!--Row -->
    <!-- right column -->

</section><!-- /.content -->

<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
<script>
    $('select').select2();
</script>
<script>
    function get_zone(id)
    {
        //  alert(id);
        var mydata = {"job_type": id};

        $.ajax({
            type: "POST",
            url: "get_zone",
            data: mydata,
            success: function (response) {
                $("#zone").html(response);
                //    alert(response);
            }
        });
    }
</script>
