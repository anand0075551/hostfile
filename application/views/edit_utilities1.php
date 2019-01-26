
<?php

function page_css() { ?>
    <!-- datatable css -->
<link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />

<?php } ?>

<?php include('header.php'); ?>

<?php foreach($utilities4->result() as $utilities1)  ?>


<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Utilities1 Details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

                    

					<div class="form-group <?php if (form_error('type')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Choose Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="type3" id="type" class="form-control" >
										<option value="<?php echo $utilities1->type;?>">
										
										<?php 
										/* $get = $this->db->get_where('per_utl1',['id'=> $utilities1->id]); */
										$get = $this->db->get_where('per_utl1',['type'=> $utilities1->type]);
										foreach($get->result() as $ac);
										echo $ac->type;
									?> 
										
										
										</option>
										<option value=""> Choose Type </option>								
										<option value="Electricity">1 - Electricity</option>
										<option value="Water">2 - Water</option>
										
										
									</select>	                                
									<?php echo form_error('type') ?>

								</div>
					</div> 
							
					
					 <div class="form-group <?php if (form_error('rr_no')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">RR No.
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="rr_no" class="form-control" value="<?php echo $utilities1->rr_no;?>" placeholder="Enter RR No..">                                
                            <?php echo form_error('rr_no') ?>

                        </div>
                    </div>
					
					
					
				 <div class="form-group <?php if (form_error('account_number')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Account No.
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="account_number" class="form-control" value="<?php echo $utilities1-> 	account_number;?>" placeholder="Enter account no..">                                
                            <?php echo form_error('account_number') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('address_details')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Address Details
                           
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="address_details" class="form-control" value="<?php echo $utilities1->address_details;?>" placeholder="Enter Address Details.">                                
                            <?php echo form_error('address_details') ?>

                        </div>
                    </div>
					
					 <div class="form-group <?php if (form_error('address')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">Address
                          
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="address" class="form-control" value="<?php echo $utilities1->address;?>" placeholder="Enter address.">                                
                            <?php echo form_error('address') ?>

                        </div>
                    </div>
                    
                    
                    
                    	
                    
                    	 <div class="form-group <?php if (form_error('pincode')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">pincode
                            <span class="text-red">*</span>
                        </label>
                        <div class="col-md-9">  								
                        <input type="text" name="pincode" class="form-control" value="<?php echo $utilities1->pincode;?>" placeholder="Enter pincode.">                                
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
                <button type="submit" name="submit" value="edit_utilities1" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Update
                </button>
                
                <button type="submit" name="submit" value="copy_utilities" class="btn btn-warning">
                    <i class="fa fa-copy"></i> Copy
                </button>
                  <a href="<?php echo base_url('Personal_info/list_utilities1') ?>" class="btn btn-success"><i class="fa fa-arrow-left"></i>Back</a>
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

