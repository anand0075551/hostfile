
<?php function page_css(){ ?>
    <!-- daterange picker -->
	
	<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />
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
                    <h3 class="box-title">Vechile Registration</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                    <div class="box-body">
					
				<div class="form-group <?php if(form_error('main_category')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Main Category<span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="main_category" id="main_category" class="form-control" style="width:100% auto" onchange="get_sub(this.value)">
                                    <option value="">select Main Category  </option>
                                    <?php
                                    if($category_name->num_rows() > 0)
                                    {
                                        foreach($category_name->result() as $c){
                                            echo '<option value="'.$c->id.'"> '.$c->category_name.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('main_category') ?>
                            </div>
                </div>

				<div class="form-group <?php if(form_error('sub_category')) echo 'has-error'; ?>">
                            <label for="firstName" class="col-md-3">Sub Category<span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="sub_category" class="form-control" style="width:100% auto" id="sub_category" onchange="get_manu(this.value)">
                                    <option value="">Select sub category  </option>
                                   
                                </select>
                                <?php echo form_error('sub_category') ?>
                            </div>
                </div>

				<div id="manufacturing" class="form-group <?php if(form_error('yrmaning')) echo 'has-error'; ?>" style="display:none">
					<label for="firstName" class="col-md-3">Year of manufacturing
						<span class="text-red">*</span>
					</label>
					<div class="col-md-9">
						<input type="text"  id="yrmaning" name="yrmaning" class="form-control some_class"  value="<?php echo set_value('yrmaning'); ?>" placeholder="Enter Manufacturing year" onchange="get_make(this.value)">
						<?php echo form_error('yrmaning') ?>

					</div>
				</div>
				<div id="make_div" class="form-group <?php if(form_error('make')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Make<span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="make" class="form-control" style="width:100% auto"  id="make" onchange="get_model(this.value)">
                                    <option value="">Select Make  </option>
                                    <?php
                                    if($add_vehicle_brand->num_rows() > 0)
                                    {
                                        foreach($add_vehicle_brand->result() as $c){
                                            echo '<option value="'.$c->id.'"> '.$c->brands.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('make') ?>
                            </div>
                </div>
				<div id="model_div" class="form-group <?php if(form_error('model')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Select Model<span class="text-red">*</span></label>
                            <div class="col-md-9">
                                <select name="model" class="form-control" style="width:100% auto" id="model" onchange="get_version(this.value)">
                                    <option value="">Select Model </option>
                                   
                                </select>
                                <?php echo form_error('model') ?>
                            </div>
                </div>
				<div id="version_div" class="form-group <?php if(form_error('version')) echo 'has-error'; ?>" style="display:none">
					<label for="firstName" class="col-md-3">Select Version<span class="text-red">*</span></label>
					<div class="col-md-9">
						<select name="version" class="form-control" style="width:100% auto" id="version" onchange="get_owners(this.value)">
							<option value="">Select Version </option>
						   
						</select>
						<?php echo form_error('version') ?>
					</div>
                </div>
				<div id="owner_div" class="form-group <?php if (form_error('owners_number')) echo 'has-error'; ?>" style="display:none">
					<label for="owners_number" class="col-md-3">No. Of Owners
						<span class="text-red"></span>
					</label>
					<div class="col-md-9" >
						<select name="owners_number" style="width:100% auto" class="form-control" id="Shiptype" onchange="get_driven(this.value)">
							<option value="">-Select No. Of Owners-</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4 & More">4 & More</option>

						</select>
						<?php echo form_error('owners_number') ?>
					</div>
				</div>
				<div id="driven_div" class="form-group <?php if(form_error('kms_driven')) echo 'has-error'; ?>" style="display:none">
					<label for="firstName" class="col-md-3">KMs Driven
						<span class="text-red">*</span>
					</label>
					<div class="col-md-9">
						<input type="number" name="kms_driven" class="form-control" id="driven" value="<?php echo set_value('kms_driven'); ?>" placeholder="Enter KMs." onchange="get_person(this.value)">
						<?php echo form_error('kms_driven') ?>

					</div>
				</div>
				<div id="person_div" class="form-group <?php if(form_error('capacityperson')) echo 'has-error'; ?>" style="display:none">
					<label for="firstName" class="col-md-3">Capacity Person <span class="text-red">*</span></label>
					<div class="col-md-9">
						<select name="capacityperson" class="form-control" id="person" style="width:100% auto" onchange="get_load(this.value)" >
							<option value=""> Select Capacity Person </option>
							<?php
							if($add_capacityperson->num_rows() > 0)
							{
								foreach($add_capacityperson->result() as $c){
									echo '<option value="'.$c->id.'"> '.$c->capacityperson	.'</option>';
								}
							}
							?>
						</select>
						<?php echo form_error('capacityperson') ?>
					</div>
				</div>
				<div id= "load_div" class="form-group <?php if(form_error('cap_load')) echo 'has-error'; ?>" style="display:none">
					<label for="firstName" class="col-md-3">Capacity Load <span class="text-red">*</span></label>
					<div class="col-md-9">
						<select name="cap_load" class="form-control" id="load" style="width:100% auto" onchange="get_reg(this.value)">
							<option value=""> Select Capacity Load </option>
							<?php
							if($add_capacityload->num_rows() > 0)
							{
								foreach($add_capacityload->result() as $c){
									//$selected = ($c->id == 105)? 'selected' : '';
									echo '<option value="'.$c->id.'"> '.$c->capacityload	.'</option>';
								}
							}
							?>
						</select>
						<?php echo form_error('cap_load') ?>
					</div>
				</div>
				<div id="reg_div"class="form-group <?php if(form_error('reg_num')) echo 'has-error'; ?>" style="display:none">
						<label for="firstName" class="col-md-3">Registration no
							<span class="text-red">*</span>
						</label>
					   
						<div class="form-group <?php if(form_error('state_code')) echo 'has-error'; ?>">
							
							<div class="col-md-2">
								<select name="state_code" class="form-control" style="width:100% auto" onchange="get_reg_date(this.value)">
									<option value=""> Select State Code </option>
									<?php
									if($state->num_rows() > 0)
									{
										foreach($state->result() as $c){
											echo '<option value="'.$c->state_code.'" '.$selected.'> '.$c->state_code.'</option>';
										}
									}
									?>
								</select>
								<?php echo form_error('state_code') ?>
							</div>
							
							
						<div class="col-md-2">
								<input type="text" name="code_num" class="form-control" style="width:100% auto"  value="<?php echo set_value('number'); ?>" placeholder="Please enter Dist Code" maxlength="4">
								<?php echo form_error('code_num') ?>

							</div>
							
							<div class="col-md-2">
								<input type="text" name="abc" class="form-control"  style="width:100% auto" value="<?php echo set_value('abc'); ?>" placeholder="Enter alphabet series" maxlength="2" style="text-transform:uppercase">
								<?php echo form_error('abc') ?>

							</div>
							
							<div class="col-md-2">
								<input type="text" name="number"  class="form-control" style="width:100% auto"  value="<?php echo set_value('number'); ?>" placeholder="Enter Number" maxlength="4">
								<?php echo form_error('number') ?>

							</div>
							
						</div>			
				</div>	
				<div id="reg_date_div"class="form-group <?php if(form_error('reg_date')) echo 'has-error'; ?>" style="display:none">
						<label for="firstName" class="col-md-3">REG.DATE
							<span class="text-red">*</span>
						</label>
						<div class="col-md-9">
							<input type="text" name="reg_date" class="form-control some_class" id="reg_date" value="<?php echo set_value('reg_date'); ?>" placeholder="Enter reg. date" onchange="get_ch_no(this.value)">
							<?php echo form_error('reg_date') ?>

						</div>
				 </div>		
				 <div id="ch_no_div" class="form-group <?php if(form_error('chassis_no')) echo 'has-error'; ?>" style="display:none">
						<label for="firstName" class="col-md-3">Chassis.No.
							<span class="text-red">*</span>
						</label>
						<div class="col-md-9">
							<input type="text" name="chassis_no" class="form-control" id="ch_no" value="<?php echo set_value('chassis_no'); ?>" placeholder="Enter Chassis.No." onchange="get_en_no(this.value)">
							<?php echo form_error('chassis_no') ?>

						</div>
				 </div> 
				<div id="en_no_div" class="form-group <?php if(form_error('engine_no')) echo 'has-error'; ?>" style="display:none">
						<label for="firstName" class="col-md-3">Engine.No.
							<span class="text-red">*</span>
						</label>
						<div class="col-md-9">
							<input type="text" name="engine_no" class="form-control"  value="<?php echo set_value('engine_no'); ?>" placeholder="Enter engine_no." id="en_no" onchange="get_org_name(this.value)">
							<?php echo form_error('engine_no') ?>

						</div>
				</div>
					
				<div id="org_name_div" class="form-group <?php if(form_error('org_name')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Organization Name
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="org_name" id="org_name" class="form-control"  value="<?php echo set_value('org_name'); ?>" placeholder="Enter Organization Name." onchange="get_owner_name(this.value)">
                                <?php echo form_error('org_name') ?>

                            </div>
                </div>
				<div id="owner_name_div" class="form-group <?php if(form_error('owner_name')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Owner Name.
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="owner_name" id="owner_name" class="form-control"  value="<?php echo set_value('owner_name'); ?>" placeholder="Enter name." onchange="get_rc_book(this.value)">
                                <?php echo form_error('owner_name') ?>

                            </div>
                </div>
				
				<div id="rc_book_div" class="form-group <?php if(form_error('rc_book')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">RC Book No
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="rc_book" id="rc_book" class="form-control"  value="<?php echo set_value('rc_book'); ?>" placeholder="Enter Rc Book No." onchange="get_address_det(this.value)">
                                <?php echo form_error('rc_book') ?>
                            </div>
                </div>
				
				<div id="address_details_div" class="form-group <?php if (form_error('address_details')) echo 'has-error'; ?>" style="display:none">
                        <label for="firstName" class="col-md-3">Owner Address & other Details
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                            <textarea name="address_details" id="address_details" class="form-control" style="width:100% auto" value="<?php echo set_value('address_details'); ?>" placeholder="" onchange="get_mobile_no(this.value)"></textarea>                               
                            <?php echo form_error('address_details') ?>

                        </div>
                </div>
				
				
			  <div id="mobile_no_div" class="form-group <?php if(form_error('model_no')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Model no.
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="model_no" id="mobile_no" class="form-control"  value="<?php echo set_value('model_no'); ?>" placeholder="Enter model no." onchange="get_fule(this.value)">
                                <?php echo form_error('model_no') ?>

                            </div>
             </div>
			 
			 <div id="fule_div" class="form-group <?php if(form_error('fule_type')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Fule
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
							<select name="fule_type" class="form-control" id="fule" style="width:100% auto" onchange="get_ins_policy(this.value)">
                                <option value="">Select fuel </option>
                                <option value="diesel">Diesel</option>
                                <option value="patrol">Patrol </option>
                                <option value="cng">Cng</option>
                                <option value="lpg">Lpg</option>
                            </select>
                    </div>
             </div>
					
			<div id="ins_policy_div" class="form-group <?php if(form_error('insurence_p_no')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Insurance Policy No
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="insurence_Policy" id="insurence_p_no" class="form-control "  value="<?php echo set_value('insurence_p_no'); ?>" placeholder="Enter Insurence Policy Number" onchange="get_ins_date(this.value)">
                                <?php echo form_error('insurence_p_no') ?>

                            </div>
			</div>
					
						
			<div id="ins_date_div" class="form-group <?php if(form_error('insurence_startdate')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Insurence Start Date
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="insurence_startdate" id="ins_date" class="form-control some_class"  value="<?php echo set_value('insurence_startdate'); ?>" placeholder="Enter Insurence Start Date" onchange="get_ins_end_date(this.value)">
                                <?php echo form_error('insurence_startdate') ?>

                            </div>
			</div>
						
						
						 <div id="ins_end_date_div" class="form-group <?php if(form_error('insurece_enddate')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Insurence End Date
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="insurece_enddate" class="form-control some_class" id="ins_end_date"value="<?php echo set_value('insurece_enddate'); ?>" placeholder="Enter Insurence End Date" onchange="get_fit_date(this.value)">
                                <?php echo form_error('insurece_enddate') ?>

                            </div>
                        </div>
					
						<div id="fit_date_div" class="form-group <?php if(form_error('fitness_cer_begin')) echo 'has-error'; ?>" style="display:none">
							<label for="firstName" class="col-md-3">Fitness certificate Begin Date
								<span class="text-red">*</span>
							</label>
							<div class="col-md-9">
								<input type="text" name="fitness_cer_begin" id="fit_date" class="form-control some_class"  value="<?php echo set_value('fitness_cer_begin'); ?>" placeholder="Enter Fitness certificate Begin Date" onchange="get_fit_end_date(this.value)">
								<?php echo form_error('fitness_cer_begin') ?>

							</div>
						 </div>

						<div id="fit_end_date_div" class="form-group <?php if(form_error('fitness_cer_end')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Fitness certificate End Date
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="fitness_cer_end" id="fit_end_date" class="form-control some_class"  value="<?php echo set_value('fitness_cer_end'); ?>" placeholder="Enter Fitness certificate End Date" onchange="get_poll_date(this.value)">
                                <?php echo form_error('fitness_cer_end') ?>

                            </div>
						 </div>
						 
						 
						 <div id="pol_certifi_div" class="form-group <?php if(form_error('pollution_cer_begin')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Pollution Certificate No
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="pollution_certifi" name="pollution_certifi" class="form-control "  value="<?php echo set_value('pollution_cer_begin'); ?>" placeholder="Enter Pollution Certificate No" onchange="get_pol_certifi(this.value)">
                                <?php echo form_error('pollution_cer_begin') ?>

                            </div>
						 </div>
						 
						 
						 
						<div id="poll_date_div" class="form-group <?php if(form_error('pollution_cer_begin')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Pollution Certificate(Begin Date)
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="poll_date" name="pollution_cer_begin" class="form-control some_class"  value="<?php echo set_value('pollution_cer_begin'); ?>" placeholder="Enter Insurence Start Date" onchange="get_poll_end_date(this.value)">
                                <?php echo form_error('pollution_cer_begin') ?>

                            </div>
						 </div>
						 
						 
						 

				<div id="poll_date_end_div" class="form-group <?php if(form_error('pollution_cer_end')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Pollution Certificate(End Date)
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="poll_end_date" name="pollution_cer_end" class="form-control some_class"  value="<?php echo set_value('pollution_cer_end'); ?>" placeholder="Enter Insurence Start Date" onchange="get_pass_date(this.value)">
                                <?php echo form_error('pollution_cer_end') ?>

                            </div>
						 </div>
						<div id="pass_date_div" class="form-group <?php if(form_error('passing_cer_start')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" id="pass_date" class="col-md-3">Passing Certificate(PERMIT) Start Date
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" name="passing_cer_start" class="form-control some_class"  value="<?php echo set_value('passing_cer_start'); ?>" placeholder="Passing Certificate(PERMIT) Start Date" onchange="get_pass_end_date(this.value)">
                                <?php echo form_error('passing_cer_start') ?>

                            </div>
						 </div>

					<div id="pass_date_end_div" class="form-group <?php if(form_error('passing_cer_end')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Passing Certificate(PERMIT) End Date
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" id="pass_end_date" name="passing_cer_end" class="form-control some_class"  value="<?php echo set_value('passing_cer_end'); ?>" placeholder="Enter Passing Certificate(PERMIT) End Date" onchange="get_ty_con(this.value)">
                                <?php echo form_error('passing_cer_end') ?>

                            </div>
						 </div>

						

						
						<div id="ty_con_div" class="form-group <?php if(form_error('tyre_cond')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Tyre Conditions
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
								<select name="tyre_cond" class="form-control" id="ty_con" style="width:100% auto" onchange="get_en_con(this.value)" >
                                <option value="">Select Tyre Conditions </option>
                                <option value="new">new</option>
                                <option value="used">used </option>
								</select>
							</div>
						</div>
						
						
						<div id="ty_con_div2" class="form-group <?php if(form_error('root_id')) echo 'has-error'; ?>" >
                            <div class="col-md-9">
                                <input type="hidden" name="root_id" maxlength="6"  value="<?php echo set_value('root_id'); ?>" placeholder="Enter tyre condition" id="ty_con2" class="form-control" onchange="get_en_con(this.value)">
                                <?php echo form_error('root_id') ?>
                            </div>
                        </div>
						
						<div id="en_con_div" class="form-group <?php if(form_error('engine_cond')) echo 'has-error'; ?>" style="display:none">
                            <label for="firstName" class="col-md-3">Engine Conditions
                                <span class="text-red">*</span>
                            </label>
                            <div class="col-md-9">
								<select name="engine_cond" class="form-control" id="en_con" style="width:100% auto" onchange="get_upload(this.value)" >
                                <option value="">Select engine Conditions </option>
                                <option value="new">new</option>
                                <option value="used">used </option>
								</select>
							</div>
						</div>
						
						
						
						
						<!-- Upload file -->
						
					<div id="upload_div" class="form-group <?php // if(form_error('street_address')) echo 'has-error';   ?>" style="display:none">
                        <label for="firstName" class="col-md-3">Upload File
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" id="upload" class="form-control" size="20" type="multipart/form-data"/>
                            <?php // echo form_error('street_address') ?>
                        </div>
                    </div>
                        
						
                    <div class="clearfix"></div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
					<!-- Admin_settings/addAdmin && Settings_models/addAdmin -->
                        <button type="submit" name="submit" id="submit" value="vechileid" class="btn btn-primary" style="display:none;">
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
				  //alert(id);
			var mydata = {"parent_id": id};

			 $.ajax({
					type: "POST",
					url: "<?php echo base_url('transport/get_sub_category') ?>",
					data: mydata,
					success: function (response)
					{
					$("#sub_category").html(response);
						//alert(response);
					}
				});
			}


</script>
	<script>
			function get_manu(id) {
		
				if (id != ""){
				$("#manufacturing").slideDown();
						$("#yrmaning").val("");
				}
				else{
				$("#manufacturing").slideUp();
						$("#yrmaning").val("");
				}
			}
    </script>
	<script>
			function get_make(id) {
		
				if (id != ""){
				$("#make_div").slideDown();
						$("#make").val("");
				}
				else{
				$("#make_div").slideUp();
						$("#make").val("");
				}
			}
    </script>
	<script>
		function get_model(id)
        {
    //   alert(id);
            var mydata = {"brands": id};

            $.ajax({
                type: "POST",
                //url: "getmodel",
				url: "<?php echo base_url('transport/getmodel') ?>",
                data: mydata,
                success: function (response) {
                    $("#model").html(response);
                //    alert(response);
                }
            });
		
		if (id != ""){
				$("#model_div").slideDown();
						$("#model").val("");
				}
				else{
				$("#model_div").slideUp();
						$("#model").val("");
				}
        }
	</script>
	<script>
		function get_version(id)
        {
    //   alert(id);
            var mydata = {"model": id};

            $.ajax({
                type: "POST",
               // url: "getversion",
				url: "<?php echo base_url('transport/getversion') ?>",
                data: mydata,
                success: function (response) {
                    $("#version").html(response);
                 //   alert(response);
                }
            });
			
		if (id != ""){
				$("#version_div").slideDown();
						$("#version").val("");
				}
				else{
				$("#make_div").slideUp();
						$("#version").val("");
				}
		
        }
	</script>
	<script>
			function get_owners(id) {
		
				if (id != ""){
				$("#owner_div").slideDown();
						$("#Shiptype").val("");
				}
				else{
				$("#owner_div").slideUp();
						$("#Shiptype").val("");
				}
			}
    </script>
	<script>
			function get_driven(id) {
		
				if (id != ""){
				$("#driven_div").slideDown();
						$("#driven").val("");
				}
				else{
				$("#driven_div").slideUp();
						$("#driven").val("");
				}
			}
    </script>
	<script>
			function get_person(id) {
		
				if (id != ""){
				$("#person_div").slideDown();
						$("#person").val("");
				}
				else{
				$("#person_div").slideUp();
						$("#person").val("");
				}
			}
    </script>
	<script>
			function get_load(id) {
		
				if (id != ""){
				$("#load_div").slideDown();
						$("#load").val("");
				}
				else{
				$("#load_div").slideUp();
						$("#load").val("");
				}
			}
    </script>
	<script>
			function get_reg(id) {
		
				if (id != ""){
				$("#reg_div").slideDown();
						$("#reg").val("");
				}
				else{
				$("#reg_div").slideUp();
						$("#reg").val("");
				}
			}
    </script>
	<script>
			function get_reg_date(id) {
		
				if (id != ""){
				$("#reg_date_div").slideDown();
						$("#reg_date").val("");
				}
				else{
				$("#reg_date_div").slideUp();
						$("#reg_date").val("");
				}
			}
    </script>
	<script>
			function get_ch_no(id) {
		
				if (id != ""){
				$("#ch_no_div").slideDown();
						$("#ch_no").val("");
				}
				else{
				$("#ch_no_div").slideUp();
						$("#ch_no").val("");
				}
			}
    </script>
	<script>
			function get_en_no(id) {
		
				if (id != ""){
				$("#en_no_div").slideDown();
						$("#en_no").val("");
				}
				else{
				$("#en_no_div").slideUp();
						$("#en_no").val("");
				}
			}
    </script>
	<script>
			function get_org_name(id) {
		
				if (id != ""){
				$("#org_name_div").slideDown();
						$("#org_name").val("");
				}
				else{
				$("#org_name_div").slideUp();
						$("#org_name").val("");
				}
			}
    </script>
	<script>
			function get_owner_name(id) {
		
				if (id != ""){
				$("#owner_name_div").slideDown();
						$("#owner_name").val("");
				}
				else{
				$("#owner_name_div").slideUp();
						$("#owner_name").val("");
				}
			}
    </script>
	
	<script>
			function get_rc_book(id) {
		
				if (id != ""){
				$("#rc_book_div").slideDown();
						$("#rc_book").val("");
				}
				else{
				$("#rc_book_div").slideUp();
						$("#rc_book").val("");
				}
			}
    </script>
	
	<script>
			function get_address_det(id) {
		
				if (id != ""){
				$("#address_details_div").slideDown();
						$("#address_details").val("");
				}
				else{
				$("#address_details_div").slideUp();
						$("#address_details").val("");
				}
			}
    </script>
	<script>
			function get_mobile_no(id) {
		
				if (id != ""){
				$("#mobile_no_div").slideDown();
						$("#mobile_no").val("");
				}
				else{
				$("#mobile_no_div").slideUp();
						$("#mobile_no").val("");
				}
			}
    </script>
	<script>
			function get_fule(id) {
		
				if (id != ""){
				$("#fule_div").slideDown();
						$("#fule").val("");
				}
				else{
				$("#fule_div").slideUp();
						$("#fule").val("");
				}
			}
    </script>
	<script>
			function get_ins_date(id) {
		
				if (id != ""){
				$("#ins_date_div").slideDown();
						$("#ins_date").val("");
				}
				else{
				$("#ins_date_div").slideUp();
						$("#ins_date").val("");
				}
			}
    </script>
	<script>
			function get_ins_policy(id) {
		
				if (id != ""){
				$("#ins_policy_div").slideDown();
						$("#insurence_p_no").val("");
				}
				else{
				$("#ins_policy_div").slideUp();
						$("#insurence_p_no").val("");
				}
			}
    </script>
	<script>
			function get_ins_end_date(id) {
		
				if (id != ""){
				$("#ins_end_date_div").slideDown();
						$("#ins_end_date").val("");
				}
				else{
				$("#ins_end_date_div").slideUp();
						$("#ins_end_date").val("");
				}
			}
    </script>
	<script>
			function get_fit_date(id) {
		
				if (id != ""){
				$("#fit_date_div").slideDown();
						$("#fit_date").val("");
				}
				else{
				$("#fit_date_div").slideUp();
						$("#fit_date").val("");
				}
			}
    </script>
	<script>
			function get_fit_end_date(id) {
		
				if (id != ""){
				$("#fit_end_date_div").slideDown();
						$("#fit_end_date").val("");
				}
				else{
				$("#fit_end_date_div").slideUp();
						$("#fit_end_date").val("");
				}
			}
    </script>
	<script>
			function get_pol_certifi(id) {
		
				if (id != ""){
				$("#poll_date_div").slideDown();
						$("#poll_date").val("");
				}
				else{
				$("#poll_date_div").slideUp();
						$("#poll_date").val("");
				}
			}
    </script>
	
	
	<script>
			function get_poll_date(id) {
		
				if (id != ""){
				$("#pol_certifi_div").slideDown();
						$("#pollution_certifi").val("");
				}
				else{
				$("#pol_certifi_div").slideUp();
						$("#pollution_certifi").val("");
				}
			}
    </script>
	
	
	<script>
			function get_poll_end_date(id) {
		
				if (id != ""){
				$("#poll_date_end_div").slideDown();
						$("#poll_end_date").val("");
				}
				else{
				$("#poll_date_end_div").slideUp();
						$("#poll_end_date").val("");
				}
			}
    </script>
	<script>
			function get_pass_date(id) {
		
				if (id != ""){
				$("#pass_date_div").slideDown();
						$("#pass_date").val("");
				}
				else{
				$("#pass_date_div").slideUp();
						$("#pass_date").val("");
				}
			}
    </script>
	<script>
			function get_pass_end_date(id) {
		
				if (id != ""){
				$("#pass_date_end_div").slideDown();
						$("#pass_end_date").val("");
				}
				else{
				$("#pass_date_end_div").slideUp();
						$("#pass_end_date").val("");
				}
			}
    </script>
	<script>
			function get_ty_con(id) {
		
				if (id != ""){
				$("#ty_con_div").slideDown();
						$("#ty_con").val("");
				}
				else{
				$("#ty_con_div").slideUp();
						$("#ty_con").val("");
				}
			}
    </script>
	<script>
			function get_ty_con2(id) {
		
				if (id != ""){
				$("#ty_con_div2").slideDown();
						$("#ty_con2").val("");
				}
				else{
				$("#ty_con_div2").slideUp();
						$("#ty_con2").val("");
				}
			}
    </script>
	<script>
			function get_en_con(id) {
		
				if (id != ""){
				$("#en_con_div").slideDown();
						$("#en_con").val("");
				}
				else{
				$("#en_con_div").slideUp();
						$("#en_con").val("");
				}
			}
    </script>
	<script>
			function get_upload(id) {
		
				if (id != ""){
				$("#upload_div").slideDown();
						$("#submit").show();
						$("#upload").val("");
				}
				else{
				$("#upload_div").slideUp();
						$("#upload").val("");
				}
			}
    </script>
	
	
	 <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
	
<?php } ?>

