<?php

function page_css() { ?>
	<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" /> 
   

<?php } ?>

<?php include('header.php'); ?>
<!-- Main content -->
<section class="content">
    <div class="row">
	
		<div class="col-lg-2 text-center">
			<button class="btn btn-success form-control" id="user_btn"  onclick="get_make_form()">Personal Details</button>
		</div>
		<div class="col-lg-2 text-center">
			<button class="btn btn-info form-control" id="guest_btn" onclick="get_model_form()">Business Information</button>
		</div>
		<div class="col-lg-2 text-center">
			<button class="btn btn-primary form-control" id="guest_btn" onclick="get_type_form()">Utilities 1</button>
		</div>
		<div class="col-lg-2 text-center">
			<button class="btn btn-danger form-control" id="guest_btn" onclick="get_type_form2()">Utilities 2</button>
		</div>
		<div class="col-lg-2 text-center">
			<button class="btn btn-success form-control" id="guest_btn" onclick="get_medical()">Medical</button>
		</div>
		<div class="col-lg-2 text-center">
			<button class="btn btn-warning form-control" id="guest_btn" onclick="get_education()">Education</button>
		</div>
	</div>
	<br>
	 <div class="row">
		<div class="col-lg-2 text-center">
			<button class="btn btn-danger form-control" id="guest_btn" onclick="get_insurance()">Insurance Details</button>
		</div>
		
		<div class="col-lg-2 text-center">
			<button class="btn btn-warning form-control" id="guest_btn" onclick="get_hobbies()">Hobbies</button>
		</div>
		
			<div class="col-lg-2 text-center">
			<button class="btn btn-success form-control" id="guest_btn" onclick="get_family_nominee()">Family & Nominee</button>
		</div>
		
	 <div class="col-lg-2 text-center">
			<button class="btn btn-info form-control" id="guest_btn" onclick="get_pet_amimal()">Pet animal Details</button>
		</div>
		
		 <div class="col-lg-2 text-center">
			<button class="btn btn-primary form-control" id="guest_btn" onclick="get_alumni_info()">Alumni Informatio</button>
		</div>
		
		 <div class="col-lg-2 text-center">
			<button class="btn btn-danger form-control" id="guest_btn" onclick="get_sports_info()">Sports Information
</button>
		</div>
	</div>
	<br>
	 <div class="row">
	 <div class="col-lg-2 text-center">
			<button class="btn btn-primary form-control" id="guest_btn" onclick="get_arts_info()">Arts Information</button>
		</div>
		
		 <div class="col-lg-2 text-center">
			<button class="btn btn-info form-control" id="guest_btn" onclick="get_favourite_info()">Favourite Places</button>
		</div>
		<div class="col-lg-2 text-center">
			<button class="btn btn-danger form-control" id="guest_btn" onclick="get_food_habits()">Food Habits
</button>
		</div>
	 </div>
	
	
	
<br>
 <div class="row">
  <!-- left column -->
   <div class="col-md-12" id="make_form" >
            <!-- general form elements -->
            <div class="box box-success">
				<div class="box-header">
                    <h3 class="box-title">Personal Details</h3>
                </div><!-- /.box-header -->
		
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				
				<div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							<span class="text-red">*</span>
                        </label>
					     <div class="col-md-9">
						
				    <select name="type1" id="type1" class="form-control" style="width:100% auto;"  onchange="per_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
					</select>	                                
									<?php echo form_error('type1') ?>
						</div>
				</div>
				
				
				
				
				<div class="form-group <?php if (form_error('first_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">First Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="first_name" id="first_name" class="form-control" value="" placeholder="" onkeyup="add()">	                                
                            <?php echo form_error('first_name') ?>

                        </div>
			    </div>
				
				
					<div class="form-group <?php if (form_error('mid_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Mid Name
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="mid_name" id="brands" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('mid_name') ?>

                        </div>
			    </div>
				
					<div class="form-group <?php if (form_error('last_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Last Name
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="last_name" id="brands" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('last_name') ?>

                        </div>
			    </div>
				
				
					<div class="form-group <?php if (form_error('id_proof')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">ID Proof
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="id_proof" id="id_proof" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('id_proof') ?>

                        </div>
			    </div>
				
					<div class="form-group <?php if (form_error('aadhar_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Aadhar ID
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="aadhar_id" id="aadhar_id" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('aadhar_id') ?>

                        </div>
			    </div>
				
				
				<div class="form-group <?php if (form_error('pan_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">PAN  ID
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="pan_id" id="pan_id" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('pan_id') ?>

                        </div>
			    </div>
				
					<div class="form-group <?php if (form_error('voter_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Voter  ID
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="voter_id" id="voter_id" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('voter_id') ?>

                        </div>
			    </div>
				
				
					<div class="form-group <?php if (form_error('drv_lnc_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Driving Licence  ID
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="drv_lnc_id" id="drv_lnc_id" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('drv_lnc_id') ?>

                        </div>
			    </div>
				
				<div class="form-group <?php if (form_error('passport_no')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Passport  No
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="passport_no" id="passport_no" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('passport_no') ?>

                        </div>
			    </div>
				
				<div class="form-group <?php if (form_error('dob')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Date Of Birth
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="dob" id="dob" class="form-control" value="" placeholder="" onkeyup="add()">	                                
                            <?php echo form_error('dob') ?>

                        </div>
			    </div>
				
					<div class="form-group <?php if (form_error('dob_proof')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Date Of birth Proof
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="dob_proof" id="dob_proof" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('dob_proof') ?>

                        </div>
			    </div>
				
				
				<div class="form-group <?php if (form_error('age')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Age
                           
                        </label>
						
					<div class="col-md-9">  								
					 <input type="text" name="age" id="age" class="form-control" value="" placeholder="">	                                
						<?php echo form_error('age') ?>

					</div>
			    </div>
				
						
				
				<div class="form-group <?php if (form_error('email')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Email Address
                           
                        </label>
						
					<div class="col-md-9">  								
					 <input type="text" name="email" id="email" class="form-control" value="" placeholder="">	                                
						<?php echo form_error('email') ?>

					</div>
			    </div>
				
				<div class="form-group <?php if (form_error('sec_email')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Secondary Email Address
                           
                        </label>
						
					<div class="col-md-9">  								
					 <input type="text" name="sec_email" id="sec_email" class="form-control" value="" placeholder="">	                                
						<?php echo form_error('sec_email') ?>

					</div>
			    </div>
				
				<div class="form-group <?php if (form_error('permanent_cntno')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Permanent Contact Number
                           
                        </label>
						
					<div class="col-md-9">  								
					 <input type="text" name="permanent_cntno" id="permanent_cntno" class="form-control" value="" placeholder="">	                                
						<?php echo form_error('permanent_cntno') ?>

					</div>
			    </div>
				
					
				<div class="form-group <?php if (form_error('mob_no1')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Mobile No 1
                           
                        </label>
						
					<div class="col-md-9">  								
					 <input type="text" name="mob_no1" id="mob_no1" class="form-control" value="" placeholder="">	                                
						<?php echo form_error('mob_no1') ?>

					</div>
			    </div>
				
					<div class="form-group <?php if (form_error('mob_no2')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Mobile No 2
                           
                        </label>
						
					<div class="col-md-9">  								
					 <input type="text" name="mob_no2" id="mob_no2" class="form-control" value="" placeholder="">	                                
						<?php echo form_error('mob_no2') ?>

					</div>
			    </div>
				
					<div class="form-group <?php if (form_error('alt_cnt_no')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Alternate Contact Person
                           
                        </label>
						
					<div class="col-md-9">  								
					 <input type="text" name="alt_cnt_no" id="alt_cnt_no" class="form-control" value="" placeholder="">	                                
						<?php echo form_error('alt_cnt_no') ?>

					</div>
			    </div>
				
				<div class="form-group <?php if (form_error('native_place')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Native Place
                           
                        </label>
						
					<div class="col-md-9">  								
					 <input type="text" name="native_place" id="native_place" class="form-control" value="" placeholder="">	                                
						<?php echo form_error('native_place') ?>

					</div>
			    </div>
				
						<div class="form-group <?php if (form_error('resi_address')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Residential Address
                           
                        </label>
						
					<div class="col-md-9">  								
					 <input type="text" name="resi_address" id="resi_address" class="form-control" value="" placeholder="">	                                
						<?php echo form_error('resi_address') ?>

					</div>
			    </div>
				
				<div class="form-group <?php if (form_error('pincode1')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Pincode
                           
                        </label>
						
					<div class="col-md-9">  								
					 <input type="text" name="pincode1" id="pincode1" class="form-control" value="" placeholder="">	                                
						<?php echo form_error('pincode1') ?>

					</div>
			    </div>
				
					<div class="form-group <?php if (form_error('permanent_address')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Permanet Address (own/Rented/Non-Rented)
                           
                        </label>
						
					<div class="col-md-9">  								
					 <input type="text" name="permanent_address" id="permanent_address" class="form-control" value="" placeholder="">	                                
						<?php echo form_error('permanent_address') ?>

					</div>
			    </div>
				
					<div class="form-group <?php if (form_error('permanent_address_proof')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Permanet Address Proof
                           
                        </label>
						
					<div class="col-md-9">  								
					 <input type="text" name="permanent_address_proof" id="permanent_address_proof" class="form-control" value="" placeholder="">	                                
						<?php echo form_error('permanent_address_proof') ?>

					</div>
			       </div>
				   
				 <!--  <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload  Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                  </div>
						<br><br> -->
				<!------------end body---------------------------------->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" value="per_details" id="subadd" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Submit
                </button>
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
 </div><!--end  left column ==================================================================================================--->
		
		
		
		<div class="col-md-12" id="model_form" style="display:none" >
            <!-- general form elements -->
            <div class="box box-info">
				<div class="box-header">
                    <h3 class="box-title">Business Information</h3>
                </div><!-- /.box-header -->
		
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				
				<div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							<span class="text-red">*</span>
                        </label>
					     <div class="col-md-9">
						
				    <select name="type2"  class="form-control" style="width:100% auto;" id="type2" onchange="business_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
									</select>	                                
									<?php echo form_error('type2') ?>
						</div>
				</div><br><br>
				
			<div class="form-group <?php if (form_error('business_email')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Business Email
                         <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="business_email" id="business_email" class="form-control" value="" placeholder="" onkeyup="business()">	                                
                            <?php echo form_error('business_email') ?>

                        </div>
			    </div><br><br>
				
				
				
				
				
				
				<div class="form-group <?php if (form_error('business_cntno')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Business Contact No
                        <span class="text-red">*</span> 
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="business_cntno" id="business_cntno" class="form-control" value="" placeholder="" onkeyup="business()">	                                
                            <?php echo form_error('business_cntno') ?>

                        </div>
			    </div><br><br>
				
					<div class="form-group <?php if (form_error('bank_details')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Bank Details
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="bank_details" id="bank_details" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('bank_details') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('shelter_details')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Shelter Details
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="shelter_details" id="shelter_details" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('shelter_details') ?>

                        </div>
			    </div><br><br>
				
					<div class="form-group <?php if (form_error('renting_assets')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Renting Assets
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="renting_assets" id="renting_assets" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('renting_assets') ?>

                        </div>
			    </div><br><br>
				<div class="form-group <?php if (form_error('own_use_assets')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Own Use Assets
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="own_use_assets" id="own_use_assets" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('own_use_assets') ?>

                        </div>
			    </div><br><br>
				
				<!--  <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                  </div>
						<br><br>-->
				<!--end body---->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" value="business_info" id="subbus"class="btn btn-primary">
                    <i class="fa fa-edit"></i>Save
                </button>
			
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
 </div> <!-- column======================================================================================================-->
		
		
		
 
		<!-- right column -->
		  <div class="col-md-12" id="type_form" style="display:none">
            <!-- general form elements -->
            <div class="box box-primary">
				<div class="box-header">
                    <h3 class="box-title">Electricity/Water</h3>
                </div><!-- /.box-header -->
				<form>
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!--form body--->
				
				<div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							<span class="text-red">*</span>
                        </label>
					     <div class="col-md-9">
						
				    <select name="type3"  class="form-control" style="width:100% auto;" id="type3" onchange="water_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Electricity">1 - Electricity</option>
										<option value="Water">2 - Water</option>
										
									</select>	                                
									<?php echo form_error('type3') ?>
						</div>
				</div><br><br>
				<div class="form-group <?php if (form_error('rr_no')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">RR No
                        <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="rr_no" id="rr_no" class="form-control" value="" placeholder="" onkeyup="electricity()">	                                
                            <?php echo form_error('rr_no') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('account_number')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> A/C No.
                        <span class="text-red">*</span> 
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="account_number" id="account_number" class="form-control" value="" placeholder="" onkeyup="electricity()">	                                
                            <?php echo form_error('account_number') ?>

                        </div>
			    </div><br><br>
			
			
			
					<div class="form-group <?php if (form_error('address_details')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Current (own/rented/non-rented)


                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="address_details" id="address_details" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('address_details') ?>

                        </div>
			    </div><br><br>
				
				
				<div class="form-group <?php if (form_error('address')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Address


                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="address" id="address" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('address') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('pincode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Pincode


                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="pincode" id="pincode" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('pincode') ?>

                        </div>
			    </div><br><br>
				
				<!-- <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                  </div>
						<br><br>-->
				
			</div>
				<!---------end body-->
             
			<div class="box-footer">
                <button type="submit" name="submit" value="utl1" class="btn btn-primary" id="subele">
                    <i class="fa fa-edit"></i>Save
                </button>
				
				<div id="mydiv"></div>
            </div>
            </form>
			
	     </div>
        </div><!--end  cright column=========================================================================================== -->
		
		
		
		
		<div class="col-md-12" id="utility_2" style="display:none" >
            <!-- general form elements -->
            <div class="box box-danger">
				<div class="box-header">
                    <h3 class="box-title">Utility 2</h3>
                </div><!-- /.box-header -->
		
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				
				<div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							<span class="text-red">*</span>
                        </label>
					     <div class="col-md-9">
						
				    <select name="type4"  class="form-control" style="width:100% auto;" id="type4" onchange="Utility2_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="DTH">1 - DTH</option>
										<option value="Broad Band">2 - Broad Band</option>
										<option value="LL">3 - LL</option>
										<option value="PP">4 - PP</option>
										
									</select>	                                
									<?php echo form_error('type4') ?>
						</div>
				</div><br>
				<div class="form-group <?php if (form_error('servive_orerator')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Service Operator

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="servive_orerator" id="servive_orerator" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('servive_orerator') ?>

                        </div>
			    </div><br>
				
				<div class="form-group <?php if (form_error('account_number')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> A/C No.
                        <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="account_number" id="text91" class="form-control" value="" placeholder="" onkeyup="ut()">	                                
                            <?php echo form_error('account_number') ?>

                        </div>
			    </div><br>
			
			
			
					<div class="form-group <?php if (form_error('address_details')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Current (own/rented/non-rented)
						

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="address_details" id="address_details" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('address_details') ?>

                        </div>
			    </div><br>
				
				
				<div class="form-group <?php if (form_error('address')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Address


                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="address" id="address" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('address') ?>

                        </div>
			    </div><br>
				
				<div class="form-group <?php if (form_error('pincode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Pincode
						<span class="text-red">*</span>

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="pincode" id="text92" class="form-control" value="" placeholder=""onkeyup="ut()" >	                                
                            <?php echo form_error('pincode') ?>

                        </div>
			    </div><br>
				
				 <!--<div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                  </div>
						<br><br>-->
				
				
				<!--end body---->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" value="utility2" class="btn btn-primary" id="sub2">
                    <i class="fa fa-edit"></i>Save
                </button>
			
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
 </div> <!-- column======================-->
		
		
	<div class="col-md-12" id="medical" style="display:none" >
            <!-- general form elements -->
            <div class="box box-success">
				<div class="box-header">
                    <h3 class="box-title">Medical</h3>
                </div><!-- /.box-header -->
		
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				
				<div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							<span class="text-red">*</span>
                        </label>
					     <div class="col-md-9">
						
				    <select name="type5"  class="form-control" style="width:100% auto;" id="type5" onchange="medical_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4 ">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
									</select>	                                
									<?php echo form_error('type5') ?>
						</div>
				</div><br> <br>
				<div class="form-group <?php if (form_error('health_status')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Health Status
							<span class="text-red">*</span>

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="health_status" id="health_status" class="form-control" value="" placeholder="" onkeyup="medical()">	                                
                            <?php echo form_error('health_status') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('major_injuries')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Major Injuries

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="major_injuries" id="major_injuries" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('major_injuries') ?>

                        </div>
			    </div><br><br>
			
			
			
					<div class="form-group <?php if (form_error('major_diseases')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Major Diseases



                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="major_diseases" id="major_diseases" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('major_diseases') ?>

                        </div>
			    </div><br><br>
				
				
				<div class="form-group <?php if (form_error('blood_group')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Blood Group



                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="blood_group" id="blood_group" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('blood_group') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('pincode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Health Consultant



                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="hlth_cnslt" id="hlth_cnslt" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('pincode') ?>

                        </div>
			    </div><br><br>
				
					<div class="form-group <?php if (form_error('insurance')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Insurance




                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="insurance" id="ins" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('insurance') ?>

                        </div>
			    </div><br><br>
				
				<!-- <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                  </div>
						<br><br>-->
				
				
				<!--end body---->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" value="medical" id="submed"class="btn btn-primary">
                    <i class="fa fa-edit"></i>Save
                </button>
			
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
</div> <!-- column======================-->
		
		
	<div class="col-md-12" id="education" style="display:none" >
            <!-- general form elements -->
            <div class="box box-warning">
				<div class="box-header">
                    <h3 class="box-title">Education</h3>
                </div><!-- /.box-header -->
		
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				
				
				  <div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							<span class="text-red">*</span>
                        </label>
					     <div class="col-md-9">
					 <select name="type6"  class="form-control" style="width:100% auto;" id="type6" onchange="education_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4 ">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
					</select>	                                      
									<?php echo form_error('type6') ?>
						</div>
				</div><br> <br>
				<div class="form-group <?php if (form_error('qualification')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Qualification

                          <span class="text-red">*</span>

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="qualification" id="qual" class="form-control" value="" placeholder="" onkeyup="education()">	                                
                            <?php echo form_error('qualification') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('major_injuries')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3"> Certificate No.
						 <span class="text-red">*</span>

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="certificate_no" id="cert" class="form-control" value="" placeholder="" onkeyup="education()">	                                
                            <?php echo form_error('major_injuries') ?>

                        </div>
			    </div><br><br>
			
			
			
					<div class="form-group <?php if (form_error('occupation')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Occupation 



                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="occupation" id="occupation" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('occupation') ?>

                        </div>
			    </div><br><br>
				
				
				<div class="form-group <?php if (form_error('occ_document')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Occ. Document



                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="occ_document" id="occ_document" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('occ_document') ?>

                        </div>
			    </div><br><br>
				
				<!-- <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                  </div>
						<br><br>-->
				
				<!--end body---->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" value="education" class="btn btn-primary" id="subedu">
                    <i class="fa fa-edit"></i>Save
                </button>
			
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
 </div> <!-- column======================-->
		
		
		
 <div class="col-md-12" id="insurance_details" style="display:none" >
            <!-- general form elements -->
            <div class="box box-danger">
				<div class="box-header">
                    <h3 class="box-title">Insurance Details
                     </h3>
                </div><!-- /.box-header -->
		
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				
				
				  <div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							
                        </label>
					     <div class="col-md-9">
					 <select name="type7"  class="form-control" style="width:100% auto;" onchange="insurance_details_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4 ">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
									</select>	                                      
									<?php echo form_error('type7') ?>
						</div>
				</div><br> <br>
			<div class="form-group <?php if (form_error('insurance_type')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Type of Insurance


                          <span class="text-red">*</span>

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="insurance_type" id="ins" class="form-control" value="" placeholder="" onkeyup="insurance()">	                                
                            <?php echo form_error('insurance_type') ?>

                        </div>
			    </div><br><br>
				
				<!-- <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                  </div>
						<br><br>-->
				
				<!--end body---->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" value="insurance" class="btn btn-primary" id="subins">
                    <i class="fa fa-edit"></i>Save
                </button>
			
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
 </div> <!-- column======================-->
 
 		
 	<div class="col-md-12" id="hobbies" style="display:none" >
            <!-- general form elements -->
            <div class="box box-warning">
				<div class="box-header">
                    <h3 class="box-title">Hobbies
</h3>
                </div><!-- /.box-header -->
		
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				
				
				  <div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							<span class="text-red">*</span>
                        </label>
					     <div class="col-md-9">
					 <select name="type8"  class="form-control" style="width:100% auto;" id="type8" onchange="hobbies_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4 ">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
									</select>	                                      
									<?php echo form_error('type8') ?>
						</div>
				</div><br> <br>
				<div class="form-group <?php if (form_error('hobbie')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Hobbies


                          <span class="text-red">*</span>

                           
                        </label>
                        <div class="col-md-9">  			 					
						<textarea name="hobbie"  placeholder="Enter Your hobbies" id="hobbie"class="form-control" onkeyup="hobbies()"></textarea>                                 
                            <?php echo form_error('hobbie') ?>

                        </div>
			    </div><br><br>
				
				<!-- <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                  </div>
						<br><br>-->
				
				<!--end body---->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" id="subhobies" value="hobbies" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Save
                </button>
			
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
 </div> <!-- column======================-->
 
 
 
 		
 	 		
 	<div class="col-md-12" id="family_nominee" style="display:none" >
            <!-- general form elements -->
            <div class="box box-success">
				<div class="box-header">
                    <h3 class="box-title">Family & Nominee
</h3>
                </div><!-- /.box-header -->
		
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				
				
				<div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							
                        </label>
					     <div class="col-md-9">
					 <select name="type9"   class="form-control" style="width:100% auto;" id="text111" onchange="family_nominee_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4 ">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
									</select>	                                      
									<?php echo form_error('type9') ?>
						</div>
				</div><br> <br>
				<div class="form-group <?php if (form_error('nominee')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Nominee



                          <span class="text-red">*</span>

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="nominee" id="text112" class="form-control" value="" placeholder="" onkeyup="familyfun()">	                                
                            <?php echo form_error('nominee') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('proof_nominee')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Nominee/ proof

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="proof_nominee" id="proof_nominee" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('proof_nominee') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('marital_status')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Marital Status
						<span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="marital_status" id="text113" class="form-control" value="" placeholder="" onkeyup="familyfun()">	                                
                            <?php echo form_error('marital_status') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('marriage_date')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Marriage Date
						
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="marriage_date" id="marriage_date" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('marriage_date') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('family_member')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Family Mambers

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="family_member" id="family_member" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('family_member') ?>

                        </div>
			    </div><br><br>
				
			<div class="form-group <?php if (form_error('head_family')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Head of the Family


                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="head_family" id="head_family" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('head_family') ?>

                        </div>
			    </div><br><br>
				<div class="form-group <?php if (form_error('parents_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Parents Name


                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="parents_name" id="parents_name" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('parents_name') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('siblings_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Siblings Name


                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="siblings_name" id="siblings_name" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('siblings_name') ?>

                        </div>
			    </div><br><br>
				
				
				<div class="form-group <?php if (form_error('partners_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Partners Name



                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="partners_name" id="partners_name" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('partners_name') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('children_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Childrens Name



                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="children_name" id="children_name" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('children_name') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('dependents')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Dipendents (if any)




                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="dependents" id="dependents" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('dependents') ?>

                        </div>
			    </div><br><br>
				
				<!--  <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Family Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                    </div><br><br>-->
				
				<!--end body---->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" value="family_nominee" id="subfamily" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Save
                </button>
			
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
 </div> <!-- column======================-->
 
 
 	
		
 
		<!-- right column -->
		  <div class="col-md-12" id="pet_amimal" style="display:none">
            <!-- general form elements -->
            <div class="box box-info">
				<div class="box-header">
                    <h3 class="box-title">Pet animal Details</h3>
                </div><!-- /.box-header -->
				<form>
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!--form body--->
				<div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							
                        </label>
					     <div class="col-md-9">
					 <select name="type10"   class="form-control" style="width:100% auto;" id="text111" onchange="per_animal_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4 ">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
									</select>	                                      
									<?php echo form_error('type10') ?>
						</div>
				</div><br><br> 
				
				<div class="form-group <?php if (form_error('text1')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 1
						 <span class="text-red">*</span>
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text1" id="text21" class="form-control" value="" placeholder="" onkeyup="animal()">	                                
                            <?php echo form_error('text1') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('text2')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 2
						<span class="text-red">*</span>
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text2" id="text22" class="form-control" value="" placeholder="" onkeyup="animal()">	                                
                            <?php echo form_error('text2') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('text3')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 3

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text3" id="text3" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('text3') ?>

                        </div>
			    </div><br><br>
				  
                <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Pet animal Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                    </div><br><br>
				
			</div>
				<!---------end body-->
             
			<div class="box-footer">
                <button type="submit" name="submit" id="subanimal" value="pets" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Submit
                </button>
				
				<div id="mydiv"></div>
            </div>
            </form>
			
	     </div>
        </div><!--end  cright column=========================================================================================== -->
  	
 	<div class="col-md-12" id="alumni_info" style="display:none" >
            <!-- general form elements -->
            <div class="box box-primary">
				<div class="box-header">
                    <h3 class="box-title">Alumni Information</h3>
                </div><!-- /.box-header -->
		
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				<div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							
                        </label>
					     <div class="col-md-9">
					 <select name="type11"   class="form-control" style="width:100% auto;" id="" onchange="alumni_info_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4 ">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
					</select>	                                      
									<?php echo form_error('type11') ?>
						</div>
				</div><br> 
				
					<div class="form-group <?php if (form_error('text4')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 1
						<span class="text-red">*</span>
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text4" id="text4" class="form-control" value="" placeholder="" onkeyup="alumni()">	                                
                            <?php echo form_error('text4') ?>

                        </div>
			    </div>
				
					<div class="form-group <?php if (form_error('text5')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 2
						<span class="text-red">*</span>
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text5" id="text5" class="form-control" value="" placeholder="" onkeyup="alumni()">	                                
                            <?php echo form_error('text5') ?>

                        </div>
			    </div>
				
					<div class="form-group <?php if (form_error('text6')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 3

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text6" id="text6" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('text6') ?>

                        </div>
			    </div>
				<!--  <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Alumni Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                  </div>
						<br><br>-->
				
				<!--end body---->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" id="subalumni" value="alumni" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Save
                </button>
			
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
 </div> <!-- column======================-->	
 
 		
 
		<!-- right column -->
		  <div class="col-md-12" id="sports_info" style="display:none">
            <!-- general form elements -->
            <div class="box box-danger">
				<div class="box-header">
                    <h3 class="box-title">Sports Information</h3>
                </div><!-- /.box-header -->
				<form>
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!--form body--->
				
				<div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							
                        </label>
					     <div class="col-md-9">
					 <select name="type12"   class="form-control" style="width:100% auto;" id="" onchange="sports_info_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4 ">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
					</select>	                                      
									<?php echo form_error('type12') ?>
						</div>
				</div><br><br> 
				
				<div class="form-group <?php if (form_error('text1')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 1
						<span class="text-red">*</span>
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text1" id="text101" class="form-control" value="" placeholder="" onkeyup="sports()">	                                
                            <?php echo form_error('text1') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('text2')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 2
						<span class="text-red">*</span>
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text2" id="text201" class="form-control" value="" placeholder="" onkeyup="sports()">	                                
                            <?php echo form_error('text2') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('text3')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 3

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text3" id="text3" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('text3') ?>

                        </div>
			    </div><br><br>
					  <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Sports Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                  </div>
						<br><br>
				
			</div>
				<!---------end body-->
             
			<div class="box-footer">
                <button type="submit" name="submit" value="sports" id="subsport" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Save
                </button>
				
				<div id="mydiv"></div>
            </div>
            </form>
			
	     </div>
        </div><!--end  cright column=========================================================================================== -->
 
 
 	
 	<div class="col-md-12" id="arts_info" style="display:none" >
            <!-- general form elements -->
            <div class="box box-primary">
				<div class="box-header">
                    <h3 class="box-title">Arts Information</h3>

                </div><!-- /.box-header -->
		
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				
				<div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							
                        </label>
					     <div class="col-md-9">
					<select name="type13"   class="form-control" style="width:100% auto;" id="" onchange="arts_info_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4 ">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
					</select>	                                      
									<?php echo form_error('type13') ?>
						</div>
				</div><br><br> 
				<div class="form-group <?php if (form_error('text7')) echo 'has-error'; ?>" >
                        <label for="firstName" class="col-md-3">text 1
						<span class="text-red">*</span>

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text7" id="text7" class="form-control" value="" placeholder=""onkeyup="art()">	                                
                            <?php echo form_error('text7') ?>

                        </div>
			    </div>
				
					<div class="form-group <?php if (form_error('text8')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 2
						<span class="text-red">*</span>
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text8" id="text8" class="form-control" value="" placeholder="" onkeyup="art()">	                                
                            <?php echo form_error('text8') ?>

                        </div>
			    </div>
				
					<div class="form-group <?php if (form_error('text9')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 3

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text9" id="text9" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('text9') ?>

                        </div>
			    </div>
				
				<!-- <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Arts Information Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                  </div>
						<br><br>-->
				
				<!--end body---->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" value="arts" id="subart" class="btn btn-primary">
                    <i class="fa fa-edit"></i>Save
                </button>
			
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
 </div> <!-- column======================-->	
		
		 	<div class="col-md-12" id="favourite_info" style="display:none" >
            <!-- general form elements -->
            <div class="box box-info">
				<div class="box-header">
                    <h3 class="box-title">Favourite Places

                </div><!-- /.box-header -->
		
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				<div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							
                        </label>
					     <div class="col-md-9">
					 <select name="type14"   class="form-control" style="width:100% auto;" id="" onchange="favourite_info_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4 ">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
					</select>	                                      
									<?php echo form_error('type12') ?>
						</div>
				</div><br> 
				
				
				<div class="form-group <?php if (form_error('text10')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 1
						<span class="text-red">*</span>
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text10" id="text10" class="form-control" value="" placeholder="" onkeyup="place()">	                                
                            <?php echo form_error('text10') ?>

                        </div>
			    </div><br><br>
				
					<div class="form-group <?php if (form_error('text11')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 2
						<span class="text-red">*</span>
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text11" id="text11" class="form-control" value="" placeholder="" onkeyup="place()">	                                
                            <?php echo form_error('text11') ?>

                        </div>
			    </div><br><br>
				
					<div class="form-group <?php if (form_error('text12')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 3

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text12" id="text12" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('text12') ?>

                        </div>
			    </div><br><br>
				
				<!--   <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Favourite Places Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                  </div>
						<br><br>-->
				
				<!--end body---->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" value="favourite" class="btn btn-primary" id="subplace">
                    <i class="fa fa-edit"></i>Save
                </button>
			
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
 </div> <!-- column======================-->	
		
				
	<div class="col-md-12" id="food_habits" style="display:none" >
	<div id="urfrm">
            <!-- general form elements -->
            <div class="box box-danger">
				<div class="box-header">
                    <h3 class="box-title">Food Habits</h3>
                </div><!-- /.box-header -->
		        
				 <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">
				<!-------------form body------------------------------->
				<div class="form-group">
						<label for="firstName" class="col-md-3">Choose Type
							
                        </label>
					     <div class="col-md-9">
					 <select name="type15"   class="form-control" style="width:100% auto;" id="" onchange="food_habits_on_type(this.value)">
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4 ">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
					</select>	                                      
									<?php echo form_error('type15') ?>
						</div>
				</div><br><br> 
				
				<div class="form-group <?php if (form_error('text13')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 1
						<span class="text-red">*</span>
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text13" id="text13" class="form-control" value="" placeholder="" onkeyup="food()">	                                
                            <?php echo form_error('text13') ?>

                        </div>
			    </div><br><br>
				
				<div class="form-group <?php if (form_error('text14')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 2
						
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text14" id="text14" class="form-control" value="" placeholder="">	                                
                            <?php echo form_error('text14') ?>

                        </div>
			    </div><br><br>
				
					<div class="form-group <?php if (form_error('text15')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 3
						<span class="text-red">*</span>
                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text15" id="text15" class="form-control" value="" placeholder="" onkeyup="food()">	                                
                            <?php echo form_error('text15') ?>

                        </div>
			    </div><br><br>
				
				  <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Food Habits Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                  </div>
						<br><br>
				
				<!--end body---->
                </div>
			<div class="box-footer">
                <button type="submit" name="submit" id="sub" value="food_habits"  class="btn btn-primary">
                    <i class="fa fa-edit"></i>Save
                </button>
			
				
				<div id="mydiv"></div>
            </div>
			
	     </div>
	</div>
        </div> <!-- column======================-->	
		

	</div><!---row---->
</section><!-- /.content -->
<?php function page_js() { ?>
<script>
//---on change disable fun foe add info....//
   function per_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/per_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("subadd").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("subadd").disabled = false;
                    }
        
                }
            });
        }
		

  function business_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/business_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("subbus").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("subbus").disabled = false;
                    }
        
                }
            });
        }
		
		
	function water_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/water_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("subele").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("subele").disabled = false;
                    }
        
                }
            });
        }
		
	function Utility2_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/Utility2_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("sub2").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("sub2").disabled = false;
                    }
        
                }
            });
        }
		
	function medical_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/medical_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("submed").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("submed").disabled = false;
                    }
        
                }
            });
        }
	
function education_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/education_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("subedu").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("subedu").disabled = false;
                    }
        
                }
            });
        }
		
function insurance_details_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/insurance_details_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("subins").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("subins").disabled = false;
                    }
        
                }
            });
        }
		
function hobbies_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/hobbies_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("subhobies").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("subhobies").disabled = false;
                    }
        
                }
            });
        }
		
function family_nominee_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/family_nominee_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("subfamily").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("subfamily").disabled = false;
                    }
        
                }
            });
        }

function per_animal_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/per_animal_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("subanimal").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("subanimal").disabled = false;
                    }
        
                }
            });
        }

function alumni_info_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/alumni_info_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("subalumni").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("subalumni").disabled = false;
                    }
        
                }
            });
        }
		
function sports_info_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/sports_info_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("subsport").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("subsport").disabled = false;
                    }
        
                }
            });
        }

function arts_info_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/arts_info_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("subart").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("subart").disabled = false;
                    }
        
                }
            });
        }
		
function favourite_info_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/favourite_info_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("subplace").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("subplace").disabled = false;
                    }
        
                }
            });
        }
		
function food_habits_on_type(type)
        {

            var mydata = {"type": type};

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('personal_info/food_habits_on_type') ?>",
                data: mydata,
                success: function (response) {
                    //$("#address_type").html(response);
                    var result = response;
                    if (result == 0)
                    {
                        document.getElementById("sub").disabled = true;
                    } else if (result == 1)
                    {
                        document.getElementById("sub").disabled = false;
                    }
        
                }
            });
    }

</script>
<script>
// text on click block

function food(){
			
		//var text1 = $('#text13').val;
		var text1 = document.getElementById('text13').value;
		var text2 = document.getElementById('text15').value;
		
		if(text1 == "" || text2 =="")
		{
			$('#sub').addClass('disabled');
		}else{
			$('#sub').removeClass('disabled');
		}
			
			
		}
</script>
<script>		
function place(){
			
		
		var text11 = document.getElementById('text10').value;
		var text12 = document.getElementById('text11').value;
		
		if(text11 == "" || text12 == "")
		{
			$('#subplace').addClass('disabled');
		}else{
			$('#subplace').removeClass('disabled');
		}
			
			
		}
</script>
<script>	
function art(){
			
		//var text1 = $('#text13').val;
		var text1 = document.getElementById('text7').value;
		var text2 = document.getElementById('text8').value;
		
		if(text1 == "" || text2 =="")
		{
			$('#subart').addClass('disabled');
		}else{
			$('#subart').removeClass('disabled');
		}
			
			
		}
</script>
<script>		
function sports(){
			
		//var text1 = $('#text13').val;
		var text11 = document.getElementById('text101').value;
		var text12 = document.getElementById('text201').value;
		
		if(text11 == "" || text12 =="")
		{
			$('#subsport').addClass('disabled');
		}else{
			$('#subsport').removeClass('disabled');
		}
			
			
		}
		
</script>

<script>	
function alumni(){
			
		//var text1 = $('#text13').val;
		var text1 = document.getElementById('text4').value;
		var text2 = document.getElementById('text5').value;
		
		if(text1 == "" || text2 =="")
		{
			$('#subalumni').addClass('disabled');
		}else{
			$('#subalumni').removeClass('disabled');
		}
			
			
		}
</script>

<script>	
function animal(){
			
		//var text1 = $('#text13').val;
		var text1 = document.getElementById('text21').value;
		var text2 = document.getElementById('text22').value;
		
		if(text1 =="" || text2 =="")
		{
			$('#subanimal').addClass('disabled');
		}else{
			$('#subanimal').removeClass('disabled');
		}
			
			
		}
</script>

<script>	
function familyfun(){
			
		
	    var text1 = document.getElementById('text111').value;
		var text2 = document.getElementById('text112').value;
		var text3 = document.getElementById('text113').value;
		if(text1 =="" || text2 =="" || text3 =="")
		{
			$('#subfamily').addClass('disabled');
		}else{
			$('#subfamily').removeClass('disabled');
		}
			
			
		}
</script>

<script>	
function hobbies(){
			
		
		var text2 = document.getElementById('type8').value; 
		var text3 = document.getElementById('hobbie1').value;
		if(text2 =="" || text3 =="")
		{
			$('#subhobbies').addClass('disabled');
		}else{
			$('#subhobbies').removeClass('disabled');
		}
			
			
		}
</script>

<script>	
function add(){
			
		
		var text2 = document.getElementById('type1').value;
		var text3 = document.getElementById('first_name').value;
		var text4 = document.getElementById('aadhar_id').value;
		var text1 = document.getElementById('dob').value;
		if( text2 =="" || text3 =="" || text1 =="" || text4 =="")
		{
			$('#subadd').addClass('disabled');
		}else{
			$('#subadd').removeClass('disabled');
		}
			
			
		}
</script>

<script>	
function business(){
			
		
		var text2 = document.getElementById('type2').value;
		var text3 = document.getElementById('business_email').value;
		var text4 = document.getElementById('business_cntno').value;
		if( text2 =="" || text3 =="" || text4 =="")
		{
			$('#subbus').addClass('disabled');
		}else{
			$('#subbus').removeClass('disabled');
		}
			
			
		}
</script>



<script>	
function electricity(){
			
		
		var text2 = document.getElementById('type3').value;
		var text3 = document.getElementById('rr_no').value;
		var text4 = document.getElementById('account_number').value;
		if( text2 =="" || text3 =="" || text4 =="")
		{
			$('#subele').addClass('disabled');
		}else{
			$('#subele').removeClass('disabled');
		}
			
			
		}
</script>
<script>	
function ut(){
			
		
		var text2 = document.getElementById('type4').value;
		var text3 = document.getElementById('text91').value;
		var text4 = document.getElementById('text92').value;
		if( text2=="" || text3=="" ||text4 =="")
		{
			$('#sub2').addClass('disabled');
		}else{
			$('#sub2').removeClass('disabled');
		}
			
			
		}
</script>
 
<script>	
function medical(){
			
		
		var text2 = document.getElementById('type5').value;
		var text3 = document.getElementById('health_status').value;
		/* var text4 = document.getElementById('pincode').value; */
		if( text2 =="" || text3 =="")
		{
			$('#submed').addClass('disabled');
		}else{
			$('#submed').removeClass('disabled');
		}
			
			
		}
</script>

<script>	
function education(){
			
		
		var text2 = document.getElementById('type6').value;
		var text3 = document.getElementById('qual').value;
		var text4 = document.getElementById('cert').value; 
		if( text2 =="" || text3 =="" || text4 =="")
		{
			$('#subedu').addClass('disabled');
		}else{
			$('#subedu').removeClass('disabled');
		}
			
			
		}
</script>

<script>	
function insurance(){
			
		
		var text2 = document.getElementById('ins').value;
		
		if( text2 =="")
		{
			$('#subins').addClass('disabled');
		}else{
			$('#subins').removeClass('disabled');
		}
			
			
		}
</script>

<script>	
function hobbies(){
			
		
		var text2 = document.getElementById('hobbie').value;
		
		if( text2 =="")
		{
			$('#subhobies').addClass('disabled');
		}else{
			$('#subhobies').removeClass('disabled');
		}
			
			
		}
</script>




<script>
   
function get_userid(id)
{
	//alert(id);
	
	var mydata = {"role": id};

	$.ajax({
		type: "POST",
		url: "getname",
		data: mydata,
		success: function (response) {
			$("#user_id").html(response);
			//alert(response);
		}
	});	
}
function get_email(id)
{
	//alert(id);
	
	var mydata = {"role": id};

	$.ajax({
		type: "POST",
		url: "getemail",
		data: mydata,
		success: function (response) {
			//document.getElementById("#user_email").value=response;
			$("#user_email").val(response);
			//alert(response);
		}
	});	
}

function get_content(id)
{
	//alert(id);
	
	var mydata = {"id": id};

	$.ajax({
		type: "POST",
		url: "get_content",
		data: mydata,
		success: function (response) {
			//document.getElementById("#user_no").value=response;
			$("#content_name").val(response);
			//alert(response);
		}
	});	
}

function get_make_form()
{
	$("#make_form").slideToggle(1000);
	$("#model_form").slideUp(1000);
	$("#type_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#education").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}
function get_model_form()
{
	$("#model_form").slideToggle(1000);
	$("#make_form").slideUp(1000);
	$("#type_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#education").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}
function get_type_form()
{
	$("#type_form").slideToggle(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#education").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}


function get_type_form2()
{
	$("#utility_2").slideToggle(1000);
	$("#type_form").slideUp(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#education").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}

function get_medical()
{
	$("#medical").slideToggle(1000);
	$("#type_form").slideUp(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#education").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}

function get_education()
{
	$("#education").slideToggle(1000);
	$("#type_form").slideUp(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}

function get_insurance()
{
	$("#insurance_details").slideToggle(1000);
	$("#type_form").slideUp(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#education").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}


function get_hobbies()
{
	$("#hobbies").slideToggle(1000);
	$("#type_form").slideUp(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#education").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}

function get_family_nominee()
{
	$("#family_nominee").slideToggle(1000);
	$("#type_form").slideUp(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#education").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}

function get_pet_amimal()
{
	$("#pet_amimal").slideToggle(1000);
	$("#type_form").slideUp(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#education").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}

function get_alumni_info()
{
	$("#alumni_info").slideToggle(1000);
	$("#type_form").slideUp(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#education").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}

function get_sports_info()
{
	$("#sports_info").slideToggle(1000);
	$("#type_form").slideUp(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#education").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}

function get_arts_info()
{
	$("#arts_info").slideToggle(1000);
	$("#type_form").slideUp(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#education").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}

function get_favourite_info()
{
	$("#favourite_info").slideToggle(1000);
	$("#type_form").slideUp(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#education").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#food_habits").slideUp(1000);
}

function get_food_habits()
{
	$("#food_habits").slideToggle(1000);
	$("#type_form").slideUp(1000);
	$("#make_form").slideUp(1000);
	$("#model_form").slideUp(1000);
	$("#utility_2").slideUp(1000);
	$("#medical").slideUp(1000);
	$("#education").slideUp(1000);
	$("#insurance_details").slideUp(1000);
	$("#hobbies").slideUp(1000);
	$("#family_nominee").slideUp(1000);
	$("#pet_amimal").slideUp(1000);
	$("#alumni_info").slideUp(1000);
	$("#sports_info").slideUp(1000);
	$("#arts_info").slideUp(1000);
	$("#favourite_info").slideUp(1000);
}
</script>


<script>
                    function maxLengthCheck(object)
                    {
                    if (object.value.length > object.maxLength)
                            object.value = object.value.slice(0, object.maxLength)
                    }
</script>


<script type="text/javascript">
            $(function() {
            //Date range picker
            $('#reservation').daterangepicker({ format: 'YYYY-MM-DD' });
                    //Date range picker with time picker
                    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
            });</script>
 <!-- CREATE Ticket NO: -->
  




    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
  

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->

    <!-- Page script -->
	
	<script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script> 
	
	
<?php } ?>





