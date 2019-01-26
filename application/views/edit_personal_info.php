<?php

function page_css() { ?>
    <!-- datatable css -->
<link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />

<?php } ?>

<?php include('header.php'); ?>


<?php foreach($personal1->result() as $personal)  ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Personal Info Details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

                    

					<div class="form-group <?php if (form_error('type')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Choose Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="type1" id="type" class="form-control" >
										<option value="<?php echo $personal->type;?>">
										
									<?php 
										$get = $this->db->get_where('per_details',['type'=> $personal->type]);
										foreach($get->result() as $ac);
										echo $ac->type;
									?> 
										
										
										</option>
										<option value=""> Choose Type </option>								
										<option value="Self">1 - Self</option>
										<option value="Spouce">2 - Spouce</option>
										<option value="Other 1">3 - Other 1 </option>
										<option value="Other 2">4 - Other 2  </option>
										<option value="Other 3">5 - Other 3  </option>
										<option value="Other 4">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
									</select>	                                
									<?php echo form_error('type') ?>

								</div>
					</div> 
							
					
					 <div class="form-group <?php if (form_error('first_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">First Name
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="first_name" class="form-control" value="<?php echo $personal->first_name;?>" placeholder="Enter first name.">                                
                            <?php echo form_error('first_name') ?>

                        </div>
                    </div>
					
					
					
				 <div class="form-group <?php if (form_error('mid_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Middle Name
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="mid_name" class="form-control" value="<?php echo $personal->mid_name;?>" placeholder="Enter Middle name.">                                
                            <?php echo form_error('mid_name') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('last_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Last Name
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="last_name" class="form-control" value="<?php echo $personal->last_name;?>" placeholder="Enter last name.">                                
                            <?php echo form_error('last_name') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('id_proof')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">ID Proof
                          
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="id_proof" class="form-control" value="<?php echo $personal->id_proof;?>" placeholder="Enter id proof.">                                
                            <?php echo form_error('id_proof') ?>

                        </div>
                    </div>
                    
                    
                    
                    	
                    
                    	 <div class="form-group <?php if (form_error('aadhar_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Aadhar ID
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="aadhar_id" class="form-control" value="<?php echo $personal->aadhar_id;?>" placeholder="Enter aadhar id.">                                
                            <?php echo form_error('aadhar_id') ?>

                        </div>
                    </div>
					
					
					
				 <div class="form-group <?php if (form_error('pan_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Pan ID
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="pan_id" class="form-control" value="<?php echo $personal->pan_id;?>" placeholder="Enter pan id.">                                
                            <?php echo form_error('pan_id') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('voter_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Voter ID
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="voter_id" class="form-control" value="<?php echo $personal->voter_id;?>" placeholder="Enter voter id.">                                
                            <?php echo form_error('voter_id') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('drv_lnc_id')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Driving License ID
                          
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="drv_lnc_id" class="form-control" value="<?php echo $personal->drv_lnc_id;?>" placeholder="Enter driving license id.">                                
                            <?php echo form_error('drv_lnc_id') ?>

                        </div>
                    </div>
                    
                    
                    	 <div class="form-group <?php if (form_error('passport_no')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Passport No.
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="passport_no" class="form-control" value="<?php echo $personal->passport_no;?>" placeholder="Enter passport No..">                                
                            <?php echo form_error('passport_no') ?>

                        </div>
                    </div>
					
					
					
				 <div class="form-group <?php if (form_error('dob')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Date of Birth
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="dob" class="form-control" value="<?php echo $personal->dob;?>" placeholder="Enter dob.">                                
                            <?php echo form_error('dob') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('dob_proof')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">DOB Proof
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="dob_proof" class="form-control" value="<?php echo $personal->dob_proof;?>" placeholder="Enter dob proof.">                                
                            <?php echo form_error('dob_proof') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('age')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Age
                          
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="age" class="form-control" value="<?php echo $personal->age;?>" placeholder="Enter age.">                                
                            <?php echo form_error('age') ?>

                        </div>
                    </div>
                    
                    
                     <div class="form-group <?php if (form_error('email')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Email
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="email" class="form-control" value="<?php echo $personal->email;?>" placeholder="Enter email.">                                
                            <?php echo form_error('email') ?>

                        </div>
                    </div>
					
					
					
				 <div class="form-group <?php if (form_error('sec_email')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Alternate Email
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="sec_email" class="form-control" value="<?php echo $personal->sec_email;?>" placeholder="Enter alternate email.">                                
                            <?php echo form_error('sec_email') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('permanent_cntno')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Permanent Contact No.
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="permanent_cntno" class="form-control" value="<?php echo $personal->permanent_cntno;?>" placeholder="Enter Permanent contact No.">                                
                            <?php echo form_error('permanent_cntno') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('mob_no1')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Mobile No. 1
                          
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="mob_no1" class="form-control" value="<?php echo $personal->mob_no1;?>" placeholder="Enter Mobile No.1.">                                
                            <?php echo form_error('mob_no1') ?>

                        </div>
                    </div>
                    
                    
                    	
				 <div class="form-group <?php if (form_error('mob_no2')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Mobile No. 2
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name=" mob_no2" class="form-control" value="<?php echo $personal-> mob_no2;?>" placeholder="Enter mobile No.2.">                                
                            <?php echo form_error('mob_no2') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('alt_cnt_no')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Alternative Contact No.
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="alt_cnt_no" class="form-control" value="<?php echo $personal->alt_cnt_no;?>" placeholder="Enter alternate contact.">                                
                            <?php echo form_error('alt_cnt_no') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('native_place')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Native
                          
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="native_place" class="form-control" value="<?php echo $personal->native_place;?>" placeholder="Enter native place.">                                
                            <?php echo form_error('native_place') ?>

                        </div>
                    </div>
                    
                    
                     <div class="form-group <?php if (form_error('resi_address')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Resident Address
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="resi_address" class="form-control" value="<?php echo $personal->resi_address;?>" placeholder="Enter resident address.">                                
                            <?php echo form_error('resi_address') ?>

                        </div>
                    </div>
					
					
					
				 <div class="form-group <?php if (form_error('pincode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Pincode
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="pincode" class="form-control" value="<?php echo $personal->pincode;?>" placeholder="Enter pincode.">                                
                            <?php echo form_error('pincode') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('permanent_address')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Permanent Contact No.
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="permanent_address" class="form-control" value="<?php echo $personal-> 	permanent_address;?>" placeholder="Enter Permanent address.">                                
                            <?php echo form_error('permanent_address') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('permanent_address_proof')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Permanent Address Proof
                          
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="permanent_address_proof" class="form-control" value="<?php echo $personal->permanent_address_proof;?>" placeholder="Enter Permanent address Proof.">                                
                            <?php echo form_error('permanent_address_proof') ?>

                        </div>
                    </div>
                    
                    	
						<div class="form-group <?php // if(form_error('street_address')) echo 'has-error';   ?>">
                        <label for="firstName" class="col-md-3">Upload Personal Info Photo
                            <span class="text-aqua">(No Max Size Limit)</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="personal" id="personal" class="form-control" type="multipart/form-data" />
                            <?php // echo form_error('street_address') ?>
                        </div>
                    </div>
                    

                </div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="edit_personal_info" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Update
                </button>
                 <button type="submit" name="submit" value="copy_personal_info" class="btn btn-warning">
                    <i class="fa fa-copy"></i> Copy
                </button>
                  <a href="<?php echo base_url('Personal_info/list_personal_info') ?>" class="btn btn-success"><i class="fa fa-arrow-left"></i>Back</a>
            </div>
            </form>
        </div><!-- /.box -->



    </div><!--/.col (left) -->
    <!-- right column -->


</section><!-- /.content -->

<script src="<?php echo base_url('assets'); ?>/js/jquery.min.js" type="text/javascript"></script>

<?php

function page_js() { ?>
    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/jquery.dataTables.1.10.7.js" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/admin'); ?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    
  
	
	   <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
<?php } ?>

