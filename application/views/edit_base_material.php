
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
                    <h3 class="box-title">Add Agricultural Input Materials</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

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
                            <input type="text" name="seed_name" class="form-control" value="<?php echo $edit_agri->seed_name; ?>" placeholder="Enter Seed Name.">                                
                            <?php echo form_error('name') ?>

                        </div>
                    </div>

                    <div class="form-group <?php if (form_error('location')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Location Name</label>
                        <div class="col-md-9">
                            <select name="location" id="location" class="form-control" style="width:100% auto">
                                <option value=""> Choose option </option>
                                <?php
                                if ($location->num_rows() > 0) {
                                    foreach ($location->result() as $c) {
                                        echo "<option value=" . $c->id . ">" . $c->location . "</option>";
                                    }
                                }
                                ?>
                            </select>	
                            <?php echo form_error('location') ?>                       
                        </div>				
                    </div>

                    <div class="form-group <?php if (form_error('name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Quantity
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="number" name="quantity" class="form-control" value="<?php echo $edit_agri->quantity; ?>" placeholder="Enter Quantity.">                                
                            <?php echo form_error('name') ?>

                        </div>
                    </div>






                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="edit_base_material" class="btn btn-primary">
                        <i class="fa fa-edit"></i>Submit
                    </button>
                </div>
                </form>
            </div><!-- /.box -->

        </div><!--col md 12-->

    </div><!--Row -->
    <!-- right column -->


</section><!-- /.content -->

<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>

<!--for multiplication-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
<script>
    $('select').select2();
</script>

