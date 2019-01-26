<?php

function page_css() { ?>
    <!-- datatable css -->
    <link href="<?php echo base_url('assets/admin'); ?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

   
<link href="<?php echo base_url('assets/select2-4.0.0/css/select2.min.css') ?>" rel="stylesheet" />

<?php } ?>

<?php include('header.php'); ?>

<?php foreach($food1->result() as $food)  ?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Food Habits</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart('', ['role' => 'form', 'class' => 'form-horizontal']); ?>
                <div class="box-body">

                 <div class="form-group <?php if (form_error('business_name')) echo 'has-error'; ?>">
								<label for="firstName" class="col-md-3">Choose Type
									<span class="text-red">*</span>
								</label>
								<div class="col-md-9">  								

									<select name="type15" id="type" class="form-control" >
										<option value="<?php echo $food->type;?>">
										
										<?php 
										$get = $this->db->group_by('type')->get_where('per_food_habits');
										$get = $this->db->get_where('per_food_habits',['type'=> $food->type]);
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
							      

				
							
					
				<div class="form-group <?php if (form_error('text13')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 1

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text13" id="text13" class="form-control" value="<?php echo $food->text1;?>" placeholder="Enter Text1">	                                
                            <?php echo form_error('text13') ?>

                        </div>
			    </div>
				
				<div class="form-group <?php if (form_error('text14')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 2

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text14" id="text14" class="form-control" value="<?php echo $food->text2;?>" placeholder="Enter Text2">	                                
                            <?php echo form_error('text14') ?>

                        </div>
			    </div>
				
				<div class="form-group <?php if (form_error('text15')) echo 'has-error'; ?>">
                        <label for="firstName" class="col-md-3">text 3

                           
                        </label>
                        <div class="col-md-9">  								
						<input type="text" name="text15" id="text15" class="form-control" value="<?php echo $food->text3;?>" placeholder="Enter Text3">	                                
                            <?php echo form_error('text15') ?>

                        </div>
			    </div>
				
				 <div class="form-group">
                        <label for="firstName" class="col-md-3">Upload Food Habits Photo
                            <span class="text-aqua">(No Max Size Limit  )</span>
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="userfile" class="form-control" type="multipart/form-data" />
                            
                        </div>
                 </div>
					
				
			                       
                <div class="clearfix"></div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" value="edit_food" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Update
                </button>
				<button type="submit" name="submit" value="copy_food" class="btn btn-primary">
                    <i class="fa fa-copy"></i> Copy
                </button> 
				
			 <a href="<?php echo base_url('Personal_info/list_food_habits') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Back</a>	
				
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

