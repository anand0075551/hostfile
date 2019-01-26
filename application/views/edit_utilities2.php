
<?php

function page_css() { ?>
    <!-- datatable css -->
<link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />

<?php } ?>

<?php include('header.php'); ?>

<?php foreach($utilities3->result() as $utilities2)  ?>


<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Utilities2 Details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

                    

					<div class="form-group <?php if (form_error('type')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Choose Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="type4" id="type" class="form-control" >
										<option value="<?php echo $utilities2->type;?>">
										
										<?php 
										/* $get = $this->db->group_by('type')->get_where('per_utl2',['id'=> $utilities2->id]); */
										$get = $this->db->get_where('per_utl2',['type'=> $utilities2->type]);
										foreach($get->result() as $ac);
										echo $ac->type;
									?> 
										
										
										</option>
										<option value=""> Choose Type </option>								
										<option value="DTH">1 - DTH</option>
										<option value="Broad Band">2 - Broad Band</option>
										<option value="LL">3 - LL</option>
										<option value="PP">4 - PP</option>
									</select>	                                
									<?php echo form_error('type') ?>

								</div>
					</div> 
							
					
					 <div class="form-group <?php if (form_error('servive_orerator')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">RR No.
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="servive_orerator" class="form-control" value="<?php echo $utilities2->servive_orerator;?>" placeholder="Enter Service operator.">                                
                            <?php echo form_error('servive_orerator') ?>

                        </div>
                    </div>
					
					
					
				 <div class="form-group <?php if (form_error('account_number')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Account No.
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="account_number" class="form-control" value="<?php echo $utilities2-> 	account_number;?>" placeholder="Enter account no..">                                
                            <?php echo form_error('account_number') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('address_details')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Address Details
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="address_details" class="form-control" value="<?php echo $utilities2->address_details;?>" placeholder="Enter Address Details.">                                
                            <?php echo form_error('address_details') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('address')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Address
                          
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="address" class="form-control" value="<?php echo $utilities2->address;?>" placeholder="Enter address.">                                
                            <?php echo form_error('address') ?>

                        </div>
                    </div>
                    
                    
                    
                    	
                    
                    	 <div class="form-group <?php if (form_error('pincode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">pincode
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="pincode" class="form-control" value="<?php echo $utilities2->pincode;?>" placeholder="Enter pincode.">                                
                            <?php echo form_error('pincode') ?>

                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Utilities Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                    </div>
	
                </div>											                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="edit_utilities2" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Update
                </button>
                 <button type="submit" name="submit" value="copy_utilities2" class="btn btn-warning">
                    <i class="fa fa-copy"></i> Copy
                </button>
                  <a href="<?php echo base_url('Personal_info/list_utilities2') ?>" class="btn btn-success"><i class="fa fa-arrow-left"></i>Back</a>
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

