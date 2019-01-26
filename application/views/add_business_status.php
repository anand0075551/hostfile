

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
                    <h3 class="box-title">Add Status:</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">





                    <div class="form-group <?php if (form_error('status')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Status
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <input type="text" name="status" class="form-control" value="<?php echo set_value('status'); ?>" placeholder="Enter Status">                                
                            <?php echo form_error('status') ?>

                        </div>
                    </div>


                    <div class="form-group <?php if (form_error('business_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Business Name<span class="text-red">*</span></label>
                        <div class="col-md-9">
                            <select name="business_name" id="business_name" class="form-control">
                                <option value=""> Choose option </option>
                                <?php
                                if ($business_name->num_rows() > 0) {
                                    foreach ($business_name->result() as $c) {
                                        // $selected = ($c->id == 105)? 'selected' : '';
                                        //echo '<option value="'.$c->id.'" '.$selected.'> '.$c->consignment_no.'</option>';
                                        echo "<option value=" . $c->id . ">" . $c->business_name . "</option>";
                                    }
                                }
                                ?>
                            </select>	
                            <?php echo form_error('business_name') ?>                       
                        </div>				
                    </div>

                    <div class="form-group <?php if (form_error('role')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">To Role</label>
                        <div class="col-md-9">
                            <select name="to_role[]" multiple id="role" class="form-control">
                                <option value=""> Choose option </option>
                                <?php
                                if ($role->num_rows() > 0) {
                                    foreach ($role->result() as $c) {
                                        // $selected = ($c->id == 105)? 'selected' : '';
                                        //echo '<option value="'.$c->id.'" '.$selected.'> '.$c->consignment_no.'</option>';
                                        echo "<option value=" . $c->id . ">" . $c->rolename . "</option>";
                                    }
                                }
                                ?>
                            </select>	
                            <?php echo form_error('role') ?>                       
                        </div>				
                    </div>				                        

				                        
                        <div class="form-group <?php if (form_error('language_en')) echo 'has-error'; ?>">
                            <label for="language_en" class="col-md-3">Language
                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9" >
                                <select name="language_en" class="form-control">
                                    <option value="">-Select Type of Language-</option>
                                    <option value="en">English</option>
                                   
                                </select>
                                <?php echo form_error('shipment_type') ?>
                            </div>
                        </div>


                    <div class="clearfix"></div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="add_business_status" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Add Status
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

    <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>

<?php } ?>

