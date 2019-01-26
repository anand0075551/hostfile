
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
                    <h3 class="box-title">Assign Menu To Role</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">


                <div class="form-group <?php if (form_error('role')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Role
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								

                            <select name="role_id"  class="form-control">
                                <option value=""> Choose Role </option>
                                <?php
                                if ($rolename->num_rows() > 0) {
                                    foreach ($rolename->result() as $c) {

                                        echo "<option value=" . $c->id . ">" . $c->id . "--" . $c->rolename . "</option>";
                                    }
                                }
                                ?>
                            </select>	                                
                            <?php echo form_error('role') ?>

                        </div>
                </div>
				

				



		
		
					

                </div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="assign_clocking_to_role" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Assign Clocking
                </button>
				<a href="<?php echo base_url('welcome/role_clocking') ?>" class="btn btn-info"><i class="fa fa-arrow-edit"></i>Back</a>
				
				<div id="mydiv"></div>
            </div>
            </form>
        </div><!-- /.box -->



    </div><!--/.col (left) -->
    <!-- right column -->

</div>   <!-- /.row -->






</section><!-- /.content -->






<!-- Validation -->





<?php function page_js() { ?>

<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
<script>
        $('select').select2();
    </script> 

<?php } ?>

