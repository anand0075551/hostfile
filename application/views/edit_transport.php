
<?php function page_css(){ ?>
    <!-- daterange picker -->
	
	<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
	 <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin'); ?>/css/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
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
                    <h3 class="box-title">Transport Module</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
					
                   <div class="form-group <?php if(form_error('reg_num')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">main category
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control" value="<?php echo $transport_module->main_category; ?>" placeholder="" readonly>
                                <?php echo form_error('reg_num') ?>
                            </div>
                        </div>

                   <div class="form-group <?php if(form_error('reg_num')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Sub Category
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control" value="<?php
                            $query = $this->db->get_where('trp_vehicle_types', ['id' => $transport_module->sub_category]);

                            if ($query->num_rows() > 0) {
                                foreach ($query->result() as $row) {
                                    echo $row->sub_category;
                                }
                            } else {
                                echo "sub category not Exist";
                            }
                            ?>" placeholder="" readonly>
                                <?php echo form_error('reg_num') ?>
                            </div>
                        </div>

				        <div class="form-group <?php if(form_error('yrmaning')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Year manufacturing
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="yrmaning" class="form-control some_class"  value="<?php echo $transport_module->yrmaning; ?>" placeholder="Enter Manufacturing year">
                                <?php echo form_error('yrmaning') ?>

                            </div>
                        </div>

						
						                   <div class="form-group <?php if(form_error('reg_num')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Make
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control" value="<?php 
									//	echo $profile->make; 
							$query1 = $this->db->get_where('trp_vehicle_make', ['id' => $transport_module->make,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->brands;
												}
											} 
											else
												{
												 echo  "";
												}
										?>" placeholder="" readonly>
                                <?php echo form_error('reg_num') ?>
                            </div>
                        </div>
									 <div class="form-group <?php if(form_error('reg_num')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Model
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control" value="<?php 
									//	echo $profile->make; 
							$query1 = $this->db->get_where(' trp_vehicle_model', ['id' => $transport_module->model,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->model;
												}
											} 
											else
												{
												 echo  "";
												}
										?>" placeholder="" readonly>
                                <?php echo form_error('reg_num') ?>
                            </div>
                        </div>
			 <div class="form-group <?php if(form_error('reg_num')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Version
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control" value="<?php 
									//	echo $profile->make; 
							$query1 = $this->db->get_where(' trp_vehicle_version', ['id' => $transport_module->version,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->version;
												}
											} 
											else
												{
												 echo  "";
												}
										?>" placeholder="" readonly>
                                <?php echo form_error('reg_num') ?>
                            </div>
                        </div>
						
					 <div class="form-group <?php if(form_error('reg_num')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">No. Of Owners
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control" value="<?php echo $transport_module->owners_number; ?>" placeholder="" readonly>
                                <?php echo form_error('reg_num') ?>
                            </div>
                        </div>

											 <div class="form-group <?php if(form_error('kms_driven')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">KMs Driven
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="kms_driven" class="form-control"  value="<?php echo $transport_module->kms_driven; ?>" placeholder="Enter KMs.">
                                <?php echo form_error('kms_driven') ?>

                            </div>
                     </div>
					 
					 
											 <div class="form-group <?php if(form_error('kms_driven')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Capacity Person
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="" readonly class="form-control"  value="<?php 
									//	echo $profile->make; 
							$query1 = $this->db->get_where('trp_capicity_person', ['id' => $transport_module->capacityperson,]);
											
											if ($query1->num_rows() > 0) 
											{
												foreach ($query1->result() as $row) 
												{
													echo  $row->capacityperson;
												}
											} 
											else
												{
												 echo  "";
												}
										?>" placeholder="Enter KMs.">
                                <?php echo form_error('kms_driven') ?>

                            </div>
                     </div>
					<div class="form-group <?php if(form_error('kms_driven')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Capacity Load
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="number" name="" readonly class="form-control"  value="<?php echo $transport_module->cap_load; ?>" placeholder="Enter KMs.">
                                <?php echo form_error('kms_driven') ?>

                            </div>
                     </div>

				<div class="form-group <?php if(form_error('reg_num')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Registration_no
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control" value="<?php echo $transport_module->reg_num; ?>" placeholder="" readonly>
                                <?php echo form_error('reg_num') ?>
                            </div>
                        </div>
						
						
					<div class="form-group <?php if(form_error('reg_date')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">REG.DATE
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="reg_date" class="form-control some_class"  value="<?php echo $transport_module->reg_date; ?>" placeholder="Enter reg. date">
                                <?php echo form_error('reg_date') ?>

                            </div>
                     </div>	
						
					 <div class="form-group <?php if(form_error('chassis_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Chassis.No.
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="chassis_no" class="form-control"  value="<?php echo $transport_module->chassis_no; ?>" placeholder="Enter Chassis.No.">
                                <?php echo form_error('chassis_no') ?>

                            </div>
                     </div>
					 
					 
					<div class="form-group <?php if(form_error('engine_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Engine.No.
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="engine_no" class="form-control"  value="<?php echo $transport_module->engine_no; ?>" placeholder="Enter engine_no.">
                                <?php echo form_error('engine_no') ?>

                            </div>
                    </div>
					
					
									<div class="form-group <?php if(form_error('org_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Organization Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="org_name" class="form-control"  value="<?php echo $transport_module->org_name; ?>" placeholder="Enter Organization Name.">
                                <?php echo form_error('org_name') ?>

                            </div>
                </div>
				<div class="form-group <?php if(form_error('owner_name')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Owner Name.
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="owner_name" class="form-control"  value="<?php echo $transport_module->owner_name; ?>" placeholder="Enter name.">
                                <?php echo form_error('owner_name') ?>

                            </div>
                </div>
				
				<div class="form-group <?php if (form_error('address_details')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Owner Address & other Details
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <textarea name="address_details" class="form-control" style="width:100% auto" value="<?php echo set_value('address_details'); ?>" placeholder=""><?php echo $transport_module->address_details; ?></textarea>                               
                            <?php echo form_error('address_details') ?>

                        </div>
                </div>
				
				
			  <div class="form-group <?php if(form_error('model_no')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Model no.
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="model_no" class="form-control"  value="<?php echo $transport_module->model_no; ?>" placeholder="Enter model no.">
                                <?php echo form_error('model_no') ?>

                            </div>
             </div>
			 
			 <div class="form-group <?php if(form_error('fule_type')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Fule
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
							<select name="fule_type" class="form-control" id="fule_type" style="width:100% auto" >
                                <option value="">Select fuel </option>
                                <option value="diesel">diesel</option>
                                <option value="patrol">patrol </option>
                                <option value="cng">cng</option>
                                <option value="JCB">lpg</option>
                            </select>
                    </div>
             </div>
					

					
						
				 <div class="form-group <?php if(form_error('insurence_startdate')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Insurence Start Date
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="insurence_startdate" class="form-control some_class"  value="<?php echo $transport_module->insurence_startdate; ?>" placeholder="Enter Insurence Start Date">
                                <?php echo form_error('insurence_startdate') ?>

                            </div>
						 </div>
						
						
						 <div class="form-group <?php if(form_error('insurece_enddate')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Insurence End Date
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="insurece_enddate" class="form-control some_class"  value="<?php echo $transport_module->insurece_enddate; ?>" placeholder="Enter Insurence End Date">
                                <?php echo form_error('insurece_enddate') ?>

                            </div>
                        </div>
					
							<div class="form-group <?php if(form_error('fitness_cer_begin')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Fitness certificate Begin Date
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="fitness_cer_begin" class="form-control some_class"  value="<?php echo $transport_module->fitness_cer_begin; ?>" placeholder="Enter Fitness certificate Begin Date">
                                <?php echo form_error('fitness_cer_begin') ?>

                            </div>
						 </div>

						<div class="form-group <?php if(form_error('fitness_cer_end')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Fitness certificate End Date
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="fitness_cer_end" class="form-control some_class"  value="<?php echo $transport_module->fitness_cer_end; ?>" placeholder="Enter Fitness certificate End Date">
                                <?php echo form_error('fitness_cer_end') ?>

                            </div>
						 </div>
 <div class="form-group <?php if(form_error('pollution_cer_begin')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Pollution Certificate(Begin Date)
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="pollution_cer_begin" class="form-control some_class"  value="<?php echo $transport_module->pollution_cer_begin; ?>" placeholder="Enter Insurence Start Date">
                                <?php echo form_error('pollution_cer_begin') ?>

                            </div>
						 </div>

				<div class="form-group <?php if(form_error('pollution_cer_end')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Pollution Certificate(End Date)
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="pollution_cer_end" class="form-control some_class"  value="<?php echo $transport_module->pollution_cer_end; ?>" placeholder="Enter Insurence Start Date">
                                <?php echo form_error('pollution_cer_end') ?>

                            </div>
						 </div>
 <div class="form-group <?php if(form_error('passing_cer_start')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Passing Certificate(PERMIT) Start Date
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="passing_cer_start" class="form-control some_class"  value="<?php echo $transport_module->passing_cer_start; ?>" placeholder="Passing Certificate(PERMIT) Start Date">
                                <?php echo form_error('passing_cer_start') ?>

                            </div>
						 </div>

					<div class="form-group <?php if(form_error('passing_cer_end')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Passing Certificate(PERMIT) End Date
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="passing_cer_end" class="form-control some_class"  value="<?php echo $transport_module->passing_cer_end; ?>" placeholder="Enter Passing Certificate(PERMIT) End Date">
                                <?php echo form_error('passing_cer_end') ?>

                            </div>
						 </div>

						

						
					<div class="form-group <?php if(form_error('passing_cer_end')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Tyre Condition
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="" class="form-control some_class"  value="<?php echo $transport_module->tyre_cond; ?>" readonly>
                                <?php echo form_error('passing_cer_end') ?>

                            </div>
						 </div>
						
						
						<div class="form-group <?php if(form_error('root_id')) echo 'has-error'; ?>">
                            <div class="col-md-9">
                                <input type="hidden" name="root_id" maxlength="6"  value="<?php echo $transport_module->tyre_cond; ?>" placeholder="Enter tyre condition" class="form-control">
                                <?php echo form_error('root_id') ?>

                            </div>
                        </div>
						
						<div class="form-group <?php if(form_error('engine_cond')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Engine Conditions
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
								<select name="engine_cond" class="form-control" id="engine_cond" style="width:100% auto" >
                                <option value="">Select engine Conditions </option>
                                <option value="new">new</option>
                                <option value="used">used </option>
								</select>
							</div>
						</div>
						
						
	
                        
						
                    <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- Admin_settings/addAdmin && Settings_models/addAdmin -->
                        <button type="submit" name="submit" value="vechileid" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Add Vechile
                        </button>
						
				<a href="<?php echo base_url('transport/transport_index') ?>" class="btn btn-primary"><i class="fa fa-arrow-edit"></i>Back</a>
                    </div>
                </form>
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->

    </div>   <!-- /.row -->
</section><!-- /.content -->

<?php function page_js(){ ?>

    
		<script src="<?php echo base_url('assets/admin'); ?>/js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>


    <script>
    

        $.datetimepicker.setLocale('en');

        $('#datetimepicker_format').datetimepicker({value: '2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
        console.log($('#datetimepicker_format').datetimepicker('getValue'));

        $("#datetimepicker_format_change").on("click", function (e) {
            $("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
        });
        $("#datetimepicker_format_locale").on("change", function (e) {
            $.datetimepicker.setLocale($(e.currentTarget).val());
        });

        $('#datetimepicker').datetimepicker({
            dayOfWeekStart: 1,
            lang: 'en',
            disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
            startDate: '1986/01/05'
        });
        $('#datetimepicker').datetimepicker({value: '2015/04/15 05:03', step: 10});


        var startdate = $("#txtstartdate").val();
        $('.some_class').datetimepicker({minDate: startdate});

        $('#default_datetimepicker').datetimepicker({
            formatTime: 'H:i',
            formatDate: 'd.m.Y',
            //defaultDate:'8.12.1986', // it's my birthday
            defaultDate: '+03.01.1970', // it's my birthday
            defaultTime: '10:00',
            timepickerScrollbar: false
        });

    </script>
	    <script>
        function get_sub(id)
        {
    //   alert(id);
            var mydata = {"main_category": id};

            $.ajax({
                type: "POST",
                url: "getsub",
                data: mydata,
                success: function (response) {
                    $("#sub_category").html(response);
                    //alert(response);
                }
            });
        }
		
		
		
		        function get_model(id)
        {
    //   alert(id);
            var mydata = {"brands": id};

            $.ajax({
                type: "POST",
                url: "getmodel",
                data: mydata,
                success: function (response) {
                    $("#model").html(response);
                //    alert(response);
                }
            });
        }
		
				        function get_version(id)
        {
    //   alert(id);
            var mydata = {"model": id};

            $.ajax({
                type: "POST",
                url: "getversion",
                data: mydata,
                success: function (response) {
                    $("#version").html(response);
                 //   alert(response);
                }
            });
        }
		</script>
	 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	
<?php } ?>

