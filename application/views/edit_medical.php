
<?php

function page_css() { ?>
    <!-- datatable css -->
<link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />

<?php } ?>

<?php include('header.php'); ?>

<?php foreach($medical1->result() as $medical)  ?>


<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Medical Details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

                    

					<div class="form-group <?php if (form_error('type')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Choose Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="type5" id="type" class="form-control" >
										<option value="<?php echo $medical->type;?>">
										
										<?php 
										/* $get = $this->db->group_by('type')->get_where('per_medical',['id'=> $medical->id]); */
										$get = $this->db->get_where('per_medical',['type'=> $medical->type]);
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
										<option value="Other 4 ">6 - Other 4  </option>
										<option value="Other 5">7 - Other 5  </option>
									</select>	                                
									<?php echo form_error('type') ?>

								</div>
					</div> 
							
					
					 <div class="form-group <?php if (form_error('health_status')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Health Status
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="health_status" class="form-control" value="<?php echo $medical-> 	health_status;?>" placeholder="Enter health status.">                                
                            <?php echo form_error('health_status') ?>

                        </div>
                    </div>
					
					
					
				 <div class="form-group <?php if (form_error('major_injuries')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Account No.
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="major_injuries" class="form-control" value="<?php echo $medical-> 	major_injuries;?>" placeholder="Enter major injuries">                                
                            <?php echo form_error('major_injuries') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('major_diseases')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">major diseases
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="major_diseases" class="form-control" value="<?php echo $medical->major_diseases;?>" placeholder="Enter major diseases.">                                
                            <?php echo form_error('major_diseases') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('blood_group')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">blood group
                          
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="blood_group" class="form-control" value="<?php echo $medical->blood_group;?>" placeholder="Enter blood group.">                                
                            <?php echo form_error('blood_group') ?>

                        </div>
                    </div>
                    
                    
                    
                    	
                    
                    	 <div class="form-group <?php if (form_error('hlth_cnslt')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Health  Consultant
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="hlth_cnslt" class="form-control" value="<?php echo $medical->hlth_cnslt;?>" placeholder="Enter Health consultant">                                
                            <?php echo form_error('hlth_cnslt') ?>

                        </div>
                    </div>
	
    
     <div class="form-group <?php if (form_error('insurance')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">insurance
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="insurance" class="form-control" value="<?php echo $medical->insurance;?>" placeholder="Enter Insurance">                                
                            <?php echo form_error('insurance') ?>

                        </div>
                    </div>
                    
                    <div class="form-group <?php // if(form_error('street_address')) echo 'has-error';   ?>">
                        <label for="firstName" class="col-md-3">Upload Medical Photo
                            <span class="text-aqua">(No Max Size Limit)</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            <?php // echo form_error('street_address') ?>
                        </div>
                    </div>
	
                </div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="edit_medical" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Update
                </button>
                <button type="submit" name="submit" value="copy_medical" class="btn btn-warning">
                    <i class="fa fa-copy"></i> Copy
                </button>
                  <a href="<?php echo base_url('Personal_info/list_medical') ?>" class="btn btn-success"><i class="fa fa-arrow-left"></i>Back</a>
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

