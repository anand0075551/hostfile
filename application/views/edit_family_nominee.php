<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

   
<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />

<?php } ?>

<?php include('header.php'); ?>

<?php foreach($family1->result() as $family)  ?>



<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Family & Nominee</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

                    

					<div class="form-group <?php if (form_error('business_name')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Choose Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="type9" id="type" class="form-control" >
										<option value="<?php echo $family->type;?>">
										
										<?php 
										$get = $this->db->group_by('type')->get_where('per_family_nominee');
										$get = $this->db->get_where('per_family_nominee',['type'=> $family->type]);
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
									<?php echo form_error('business_name') ?>

								</div>
					</div> 
							
					
					 <div class="form-group <?php if (form_error('nominee')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Nominee
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="nominee" class="form-control" value="<?php echo $family->nominee;?>" placeholder="Enter Nominee name.">                                
                            <?php echo form_error('nominee') ?>

                        </div>
                    </div>
					
					
					
				 <div class="form-group <?php if (form_error('proof_nominee')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Nominee/ proof
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="proof_nominee" class="form-control" value="<?php echo $family->proof_nominee;?>" placeholder="Enter Nominee/ proof.">                                
                            <?php echo form_error('proof_nominee') ?>

                        </div>
                 </div>
				 
				<div class="form-group <?php if (form_error('marital_status')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Marital Status

                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="marital_status" id="marital_status" class="form-control" value="<?php echo $family->proof_nominee;?>" placeholder="Enter Marital Status">	                                
                            <?php echo form_error('marital_status') ?>

                        </div>
			    </div>
				
				<div class="form-group <?php if (form_error('marriage_date')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Marriage Date

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="marriage_date" id="marriage_date" class="form-control" value="<?php echo $family->marriage_date;?>" placeholder="Enter Marital date">	                                
                            <?php echo form_error('marriage_date') ?>

                        </div>
			    </div>
				<div class="form-group <?php if (form_error('family_member')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Family Mambers

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="family_member" id="family_member" class="form-control" value="<?php echo $family->family_member;?>" placeholder="Enter Family Mambers">	                                
                            <?php echo form_error('family_member') ?>

                        </div>
			    </div>
				<div class="form-group <?php if (form_error('head_family')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Head of the Family


                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="head_family" id="head_family" class="form-control" value="<?php echo $family->head_family;?>" placeholder="Enter Head of the Family">	                                
                            <?php echo form_error('head_family') ?>

                        </div>
			    </div>
				
				<div class="form-group <?php if (form_error('parents_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Parents Name


                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="parents_name" id="parents_name" class="form-control" value="<?php echo $family->parents_name;?>" placeholder="Enter Parents Name">	                                
                            <?php echo form_error('parents_name') ?>

                        </div>
			    </div>
				<div class="form-group <?php if (form_error('children_name')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Childrens Name



                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="children_name" id="children_name" class="form-control" value="<?php echo $family->children_name;?>" placeholder="Enter Childrens Name">	                                
                            <?php echo form_error('children_name') ?>

                        </div>
			    </div>
				
				<div class="form-group <?php if (form_error('dependents')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Dipenden
						
						</label>
                        <div class="col-md-9">  								
						<input type="text" name="dependents" id="dependents" class="form-control" value="<?php echo $family->dependents;?>" placeholder="Enter Dipenden">	                                
                            <?php echo form_error('dependents') ?>

                        </div>
			    </div>
				
				<div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Family Photo
                            <span class="text-aqua">(No Max Size Limit)</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                </div>
					
				
					
					

                										                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="edit_family" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Update
                </button>
					<button type="submit" name="submit" value="copy_family" class="btn btn-primary">
                    <i class="fa fa-copy"></i> Copy
                </button> 
				
			 <a href="<?php echo base_url('Personal_info/list_family_nominee') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>	
            </div>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	
	   <script src="<?php echo base_url('assets/select2-4.0.0/js/select2.min.js') ?>"></script>
    <script>
        $('select').select2();
    </script>
<?php } ?>

