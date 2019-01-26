	
<?php function page_css(){ ?>
    <!-- daterange picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
	
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
                    <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
			
                      
						
						<div class="form-group <?php if(form_error('visitor_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Visitor Name

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="visitor_name" class="form-control"  value="<?php echo set_value('visitor_name'); ?>" placeholder="Enter Visitor Name">
                                <?php echo form_error('visitor_name') ?>

                            </div>
                        </div>
						
						
						<div class="form-group <?php if(form_error('type_of_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> <span>Type Of Id*</span></label>
                            <div class="col-md-9"> 
                                <select name="type_of_id" class="form-control" >
                                    <option value=""> Select Type Of Id </option>
									<option value =" Aadhar Card"> Aadhar Card </option>
									<option value ="advertisement"> PAN Number </option>
									<option value ="Driving License"> Driving License </option>	
									<option value ="Passport"> Passport </option>
									<option value ="Voter's Id"> Voter's Id</option>

										
                                </select>
                                <?php echo form_error('type_of_id') ?>
                            </div>
                        </div>
						
						<!--<div class="form-group < ?php if(form_error('type_of_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Type of Id
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="type_of_id" class="form-control"  value="< ?php echo set_value('type_of_id'); ?>" placeholder="Enter Type of Id">
                                < ?php echo form_error('type_of_id') ?>

                            </div>
                        </div>-->
                     
					 
						<div class="form-group <?php if(form_error('proof_number')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Proof Numer
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="proof_number" class="form-control"  value="<?php echo set_value('proof_number'); ?>" placeholder="Enter proof number">
                                <?php echo form_error('proof_number') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('email_id')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Communication Id/Email

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="email" name="email_id" class="form-control"  value="<?php echo set_value('email_id'); ?>" placeholder="Enter communication_id or email">
                                <?php echo form_error('email_id') ?>

                            </div>
                        </div>
						
						
						<div class="form-group <?php if(form_error('purpose')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> <span>Purpose*</span></label>
                            <div class="col-md-9"> 
                                <select name="purpose" class="form-control" >
                                    <option value=""> Select Purpose </option>
                                    <option value ="interview"> Interview </option>
									 <option value ="buisiness proposal"> Buisiness Proposal </option>
									  <option value ="advertisement"> Advertisement </option>
									   <option value ="stock inward"> Stock Inward </option>	
									    <option value ="stock outward"> Stock outward </option>

                                </select>
                                <?php echo form_error('purpose') ?>
                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('from_place')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3"> From Place

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="from_place" class="form-control"  value="<?php echo set_value('from_place'); ?>" placeholder="Enter from place">
                                <?php echo form_error('from_place') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('refferer')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Refferer

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="refferer" class="form-control"  value="<?php echo set_value('refferer'); ?>" placeholder="Enter refferer">
                                <?php echo form_error('refferer') ?>

                            </div>
                        </div>
						
						
						<div class="form-group <?php if(form_error('whom_to_meet')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Whom To Meet


                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="whom_to_meet" class="form-control"  value="<?php echo set_value('whom_to_meet'); ?>" placeholder="Enter whom to meet">
                                <?php echo form_error('whom_to_meet') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('mobile_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Moile Number


                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="mobile_no" class="form-control"  value="<?php echo set_value('mobile_no'); ?>" placeholder="Enter Mobile No">
                                <?php echo form_error('mobile_no') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('remarks')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Remarks

                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="remarks" class="form-control"  value="<?php echo set_value('remarks'); ?>" placeholder="Enter Remarks">
                                <?php echo form_error('remarks') ?>

                            </div>
                        </div>
					<div class="form-group <?php // if(form_error('street_address')) echo 'has-error';   ?>">
                        <label for="firstName" class="col-md-3">Upload Visitor Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            <?php // echo form_error('street_address') ?>
                        </div>
                    </div>
						
						<div class="form-group <?php if(form_error('custom1')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Custom1

                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="custom1" class="form-control"  value="<?php echo set_value('custom1'); ?>" placeholder="Enter custom1">
                                <?php echo form_error('custom1') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('custom2')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">custom2

                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="custom2" class="form-control"  value="<?php echo set_value('custom2'); ?>" placeholder="Enter custom2">
                                <?php echo form_error('custom2') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('custom3')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Custom1

                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="custom3" class="form-control"  value="<?php echo set_value('custom3'); ?>" placeholder="Enter custom3">
                                <?php echo form_error('custom3') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('custom4')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Custom4

                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="custom4" class="form-control"  value="<?php echo set_value('custom4'); ?>" placeholder="Enter custom4">
                                <?php echo form_error('custom4') ?>

                            </div>
                        </div>
					
						
						<div class="form-group <?php if(form_error('custom5')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Custom5

                                <span class="text-red"></span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="custom5" class="form-control"  value="<?php echo set_value('custom5'); ?>" placeholder="Enter custom5">
                                <?php echo form_error('custom5') ?>

                            </div>
                        </div>
					
                        
						
                    <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- Admin_settings/addAdmin && Settings_models/addAdmin -->
                        <button type="submit" name="submit" value="visitor" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Visitor
                        </button>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

   
	
	 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	
<?php } ?>